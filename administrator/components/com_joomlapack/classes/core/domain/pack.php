<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		$Id$
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @since		1.2.1
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

$config =& JoomlapackConfiguration::getInstance();
define('JPMaxFragmentSize', $config->get('mnMaxFragmentSize'));	// Maximum bytes a fragment can have (default: 1Mb)
define('JPMaxFragmentFiles', $config->get('mnMaxFragmentFiles'));		// Maximum number of files a fragment can have (default: 50 files)

/**
 * Packing engine. Takes care of putting gathered files (the file list) into
 * an archive.
 */
class JoomlapackDomainPack extends JoomlapackEngineParts {
	/**
     * @var array Directories to exclude
     */
	var $_ExcludeDirs;
	
	/**
	 * @var array Files to exclude
	 */
	var $_ExcludeFiles;

	/**
	 * @var array Directories left to be scanned
	 */
	var $_directoryList;
	
	/**
	 * @var array Files left to be put into the archive
	 */
	var $_fileList;
	
	/**
	 * Operation toggle. When it is true, files are added in the archive. When it is off, the
	 * directories are scanned for files.
	 *
	 * @var bool
	 */
	var $_doneScanning = false;
	
	// ============================================================================================
	// IMPLEMENTATION OF JoomlapackEngineParts METHODS
	// ============================================================================================
	/**
	 * Public constructor of the class
	 *
	 * @return JoomlapackDomainPack
	 */
	function JoomlapackDomainPack(){
		$this->_DomainName = "Packing";
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: new instance");
	}
	
	/**
	 * Implements the _prepare() abstract method
	 *
	 */
	function _prepare()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Starting _prepare()");
		
		// Get the directory exclusion filters - this only needs to be done once
		$this->_loadAndCacheFilters();
		if($this->hasError()) return false;
		
		// FIX 1.1.0 $mosConfig_absolute_path may contain trailing slashes or backslashes incompatible with exclusion filters
		// FIX 1.2.2 Some hosts yield an empty string on realpath(JPATH_SITE) 
		if(trim(realpath(JPATH_SITE)) == '')
		{
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "The normalized path to your site's root seems to be an empty string; I will attempt a workaround");
			$this->_directoryList[] = JPATH_SITE; // Start scanning from Joomla! root (workaround mode)
		}
		else
		{
			$this->_directoryList[] = realpath(JPATH_SITE); // Start scanning from Joomla! root (normal mode)
		}
		$this->_doneScanning = false; // Instruct the class to scan for files
		
		$this->_isPrepared = true;

		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: prepared");
	}
	
	function _run()
	{
		if ($this->_hasRan) {
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Already finished");
			$this->_isRunning = false;
			$this->_Step = "-";
			$this->_Substep = "";
		}
		else
		{
			if($this->_doneScanning)
			{
				$this->_packSomeFiles();
				if($this->hasError()) return false;
			}
			else
			{
				$result = $this->_scanNextDirectory();
				if($this->hasError()) return false;
				if(!$result)
				{
					$this->_isRunning = false;
					$this->_hasRan = true;
				}
			}
		}
	}
	
	/**
	 * Implements the _finalize() abstract method
	 *
	 */
	function _finalize()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Finalizing archive");
		$cube =& JoomlapackCUBE::getInstance();
		$archive =& $cube->getArchiverEngine();
		$archive->finalize();
		// Error propagation
		if($archive->hasError())
		{
			$this->setError($archive->getError(), true);
			return false;
		}
		// Warning propagation
		if($archive->hasWarning())
		{
			foreach($archive->getWarning() as $warning)
			{
				$this->setWarning($warning, true);
			}
		}
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Archive is finalized");
		$this->_isFinished = true;
	}
	
	// ============================================================================================
	// PRIVATE METHODS
	// ============================================================================================
	
	/**
	* Loads the exclusion filters off the db and caches them inside the object
	*/
	function _loadAndCacheFilters() {
		jpimport('classes.core.utility.filtermanager');

		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Initializing filter manager");
		$filterManager = new JoomlapackFilterManager();
		$filterManager->init();
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Getting DEF");
		$this->_ExcludeDirs = $filterManager->getFilters('folder');
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Getting SFF");
		$this->_ExcludeFiles = $filterManager->getFilters('singlefile');

		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainPack :: Done with filter manager");
		unset($filterManager);
	}	
	
	/**
	 * Scans a directory for files and directories, updating the _directoryList and _fileList
	 * private fields
	 *
	 * @return bool True if more work has to be done, false if the dirextory stack is empty
	 */
	function _scanNextDirectory( )
	{
		// Are we supposed to scan for more files?
		if( $this->_doneScanning ) return true;
		// Get the next directory to scan
		if( count($this->_directoryList) == 0 )
		{
			// No directories left to scan
			return false; 
		}
		else
		{
			// Get and remove the last entry from the $_directoryList array
			$dirName = array_pop($this->_directoryList);
			$this->_Step = $dirName;
		}
		
		$cube =& JoomlapackCUBE::getInstance();
		$engine = & $cube->getListerEngine();
		
		// Apply DEF (directory exclusion filters)
		if (in_array( $dirName, $this->_ExcludeDirs )) {
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Skipping directory $dirName");
			return true;
		}
		
		// Get directory listing
		$fileList =& $engine->getDirContents( $dirName );
		// Error propagation
		if($engine->hasError())
		{
			$this->setError($engine->getError(), true);
			return false;
		}
		// Warning propagation
		if($engine->hasWarning())
		{
			foreach($engine->getWarning() as $warning)
			{
				$this->setWarning($warning, true);
			}
		}
		
		$processedFiles = 0;
		
		if ($fileList === false) {
			// A non-browsable directory; however, it seems that I never get FALSE reported here?!
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "Unreadable directory $dirName. Check permissions.");
		}
		else
		{
			// Scan all directory entries
			foreach($fileList as $fileName) {
				if( is_dir($fileName) )
				{
					// A new directory found. Mark it for recursion
					if (!( ( substr($fileName, -1, 1) == "." ) || ( substr($fileName, -1, 2) == ".." ) )) {
						$this->_directoryList[] = $fileName;
						$processedFiles++;
						JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Adding directory " . $fileName);
					} // end if not . or ..
				}
				elseif (is_file($fileName))
				{
					// Just a file... process it.
					$skipThisFile = is_array($this->_ExcludeFiles) ? in_array( $fileName, $this->_ExcludeFiles ) : false;
					if ($skipThisFile) {
						JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Skipping file $fileName");
					} else {
						$this->_fileList[] = $fileName;
						$processedFiles++;
					}
				}
			} // end foreach
		} // end filelist not false
		
		// Check to see if there were no contents of this directory added to our search list
		if ( $processedFiles == 0 ) {
			$archiver =& $cube->getArchiverEngine();
			$archiver->addFile($dirName, JPATH_SITE);
			// Error propagation
			if($archiver->hasError())
			{
				$this->setError($archiver->getError(), true);
				return false;
			}
			// Warning propagation
			if($archiver->hasWarning())
			{
				foreach($archiver->getWarning() as $warning)
				{
					$this->setWarning($warning, true);
				}
			}
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Empty directory $dirName");
			unset($archiver);
			$this->_doneScanning = false; // Because it was an empty dir $_fileList is empty and we have to scan for more files
		}
		else
		{
			// Next up, add the files to the archive!
			$this->_doneScanning = true;
		}
		
		// We're done listing the contents of this directory
		unset($engine);
		unset($cube);
		
		return true;
	}
	
	/**
	 * Try to pack some files in the $_fileList, restraining ourselves not to reach the max
	 * number of files or max fragment size while doing so. If this process is over and we are
	 * left without any more files, reset $_doneScanning to false in order to instruct the class
	 * to scan for more files.
	 *
	 * @return bool True if there were files packed, false otherwise (empty filelist)
	 */
	function _packSomeFiles()
	{
		if( count($this->_fileList) == 0 )
		{
			// No files left to pack -- This should never happen! We catch this condition at the end of this method!
			$this->_doneScanning = false;
			return false;
		}
		else
		{
			$packedSize = 0;
			$numberOfFiles = 0;

			$cube =& JoomlapackCUBE::getInstance();
			$archiver =& $cube->getArchiverEngine();
			
			while( (count($this->_fileList) > 0) && ($packedSize <= JPMaxFragmentSize) && ($numberOfFiles <= JPMaxFragmentFiles) )
			{
				$file = @array_shift($this->_fileList);
				$size = @filesize($file);
				$packedSize += $size;
				$numberOfFiles++;
				$archiver->addFile($file, JPATH_SITE);
				// Error propagation
				if($archiver->hasError())
				{
					$this->setError($archiver->getError(), true);
					return false;
				}
				// Warning propagation
				if($archiver->hasWarning())
				{
					foreach($archiver->getWarning() as $warning)
					{
						$this->setWarning($warning, true);
					}
				}
			}
			
			$this->_doneScanning = count($this->_fileList) > 0;
			return true;
		}
	}

}
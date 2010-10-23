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
define("_JoomlapackPackerZIP_FORCE_FOPEN", $config->get('mnZIPForceOpen')); // Don't force use of fopen() to read uncompressed data in memory
define("_JoomlapackPackerZIP_COMPRESSION_THRESHOLD", $config->get('mnZIPCompressionThreshold')); // Don't compress files over this size
define("_JoomlapackPackerZIP_DIRECTORY_READ_CHUNK", $config->get('mnZIPDirReadChunk')); // How much data to read at once when finalizing ZIP archives

define( '_JPA_MAJOR', 1 ); // JPA Format major version number
define( '_JPA_MINOR', 0 ); // JPA Format minor version number

/**
 * JoomlaPack Archive creation class
 * 
 * JPA Format 1.0 implemented, minus BZip2 compression support
 */
class JoomlapackPackerJPA extends JoomlapackArchiver
{
	/**
	 * How many files are contained in the archive
	 *
	 * @var integer
	 */
	var $_fileCount = 0;
	
	/**
	 * The total size of files contained in the archive as they are stored (it is smaller than the
	 * archive's file size due to the existence of header data)
	 *
	 * @var integer
	 */
	var $_compressedSize = 0;
	
	/**
	 * The total size of files contained in the archive when they are extracted to disk.
	 *
	 * @var integer
	 */
	var $_uncompressedSize = 0;

    /**
     * The name of the file holding the ZIP's data, which becomes the final archive
     *
     * @var string
     */
	var $_dataFileName;

    /**
     * Beginning of central directory record.
     *
     * @var string
     */
    var $_ctrlDirHeader = "\x4A\x50\x41";	// Standard Header signature
	
    /**
     * Beginning of file contents.
     *
     * @var string
     */
    var $_fileHeader = "\x4A\x50\x46";	// Entity Block signature
    
	// ------------------------------------------------------------------------
	// Implementation of abstract methods
	// ------------------------------------------------------------------------
	
/**
	 * Initialises the archiver class, creating the archive from an existent
	 * installer's JPA archive. 
	 *
	 * @param string $sourceJPAPath Absolute path to an installer's JPA archive
	 * @param string $targetArchivePath Absolute path to the generated archive 
	 * @param array $options A named key array of options (optional)
	 * @access public
	 */
	function initialize( $sourceJPAPath, $targetArchivePath, $options = array() )
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerJPA :: new instance - archive $targetArchivePath");
		$this->_dataFileName = $targetArchivePath;
		
		// Try to kill the archive if it exists
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerJPA :: Killing old archive");
		$fp = @fopen( $this->_dataFileName, "wb" );
		if (!($fp === false)) {
			@ftruncate( $fp,0 );
			@fclose( $fp );
		} else {
			if( file_exists($this->_dataFileName) ) @unlink( $this->_dataFileName );
			@touch( $this->_dataFileName );
		}
		
		// Write the initial instance of the archive header
		$this->_writeArchiveHeader();
		if($this->hasError()) return;
		
		// Seed the archive
		$this->transformJPA($sourceJPAPath);
		if($this->hasError()) return;
	}
	
	/**
	 * Updates the Standard Header with current information
	 */
	function finalize()
	{
		$this->_writeArchiveHeader();
		if($this->hasError()) return;
	}
	
	/**
	 * The most basic file transaction: add a single entry (file or directory) to
	 * the archive.
	 *
	 * @param bool $isVirtual If true, the next parameter contains file data instead of a file name
	 * @param string $sourceNameOrData Absolute file name to read data from or the file data itself is $isVirtual is true
	 * @param string $targetName The (relative) file name under which to store the file in the archive
	 * @return True on success, false otherwise
	 * @since 1.2.1
	 * @access protected
	 * @abstract 
	 */
	function _addFile( $isVirtual, &$sourceNameOrData, $targetName )
	{
		// See if it's a directory
		$isDir = $isVirtual ? false : is_dir($sourceNameOrData);

		// Get real size before compression
		if($isVirtual)
		{
			$fileSize = strlen($sourceNameOrData);
		}
		else
		{
			$fileSize = $isDir ? 0 : filesize($sourceNameOrData);			
		}

		// Decide if we will compress
		if ($isDir) {
			$compressionMethod = 0; // don't compress directories...
		} else {
			// Do we have plenty of memory left?
			$memLimit = ini_get("memory_limit");
			if( is_numeric($memLimit) && ($memLimit < 0) ) $memLimit = ""; // 1.2a3 -- Rare case with memory_limit < 0, e.g. -1Mb!
			if (($memLimit == "") || ($fileSize >= _JoomlapackPackerZIP_COMPRESSION_THRESHOLD)) {
				// No memory limit, or over 1Mb files => always compress up to 1Mb files (otherwise it times out)
				$compressionMethod = ($fileSize <= _JoomlapackPackerZIP_COMPRESSION_THRESHOLD) ? 1 : 0;
			} elseif ( function_exists("memory_get_usage") ) {
				// PHP can report memory usage, see if there's enough available memory; Joomla! alone eats about 5-6Mb! This code is called on files <= 1Mb
				$memLimit = $this->_return_bytes( $memLimit );
				$availableRAM = $memLimit - memory_get_usage();
				$compressionMethod = (($availableRAM / 2.5) >= $fileSize) ? 1 : 0;
			} else {
				// PHP can't report memory usage, compress only files up to 512Kb (conservative approach) and hope it doesn't break
				$compressionMethod = ($fileSize <= 524288) ? 1 : 0;
			}
		}

		$compressionMethod = function_exists("gzcompress") ? $compressionMethod : 0;

		$storedName = $targetName;
		
        /* "Entity Description BLock" segment. */
        $unc_len = &$fileSize; // File size
        $storedName .= ($isDir) ? "/" : "";

		if ($compressionMethod == 1) {
			if($isVirtual)
			{
				$udata =& $sourceNameOrData;
			}
			else
			{
			// Get uncompressed data
				if( function_exists("file_get_contents") && (_JoomlapackPackerZIP_FORCE_FOPEN == false) ) {
					$udata = @file_get_contents( $sourceNameOrData ); // PHP > 4.3.0 saves us the trouble
				} else {
					// Argh... the hard way!
					$udatafp = @fopen( $sourceNameOrData, "rb" );
					if( !($udatafp === false) ) {
						$udata = "";
						while( !feof($udatafp) ) {
							$udata .= fread($udatafp, 524288);
						}
						fclose( $udatafp );
					} else {
						$udata = false;
					}
				}
			}
			
			if ($udata === FALSE) {
				// Unreadable file, skip it.
				$this->setWarning('Unreadable file '.$sourceNameOrData);
				return false;
			} else {
				// Proceed with compression
				$zdata   = @gzcompress($udata);
				if ($zdata === false) {
					// If compression fails, let it behave like no compression was available
					$c_len = &$unc_len;
					$compressionMethod = 0;
				} else {
					unset( $udata );
					$zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
					$c_len   = strlen($zdata);
				}
			}
		} else {
			$c_len = $unc_len;
		}

		$this->_compressedSize += $c_len; // Update global data
		$this->_uncompressedSize += $fileSize; // Update global data
		$this->_fileCount++;
		
		// Get file permissions
		$perms = $isVirtual ? 0777 : @fileperms( $sourceNameOrData );
		
		// Calculate Entity Description Block length
		$blockLength = 21 + strlen($storedName) ;
		
        // Open data file for output
		$fp = @fopen( $this->_dataFileName, "ab");
		if ($fp === false)
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR, "Could not open archive file {$this->_dataFileName} for append!");
		$this->_fwrite( $fp, $this->_fileHeader ); // Entity Description Block header
		if($this->hasError()) return;
		$this->_fwrite( $fp, pack('v', $blockLength) ); // Entity Description Block header length
		$this->_fwrite( $fp, pack('v', strlen($storedName) ) ); // Length of entity path
		$this->_fwrite( $fp, $storedName ); // Entity path
		$this->_fwrite( $fp, pack('C', ($isDir ? 0 : 1) ) ); // Entity type
		$this->_fwrite( $fp, pack('C', $compressionMethod ) ); // Compression method
		$this->_fwrite( $fp, pack('V', $c_len ) ); // Compressed size
		$this->_fwrite( $fp, pack('V', $unc_len ) ); // Uncompressed size
		$this->_fwrite( $fp, pack('V', $perms ) ); // Entity permissions

		/* "File data" segment. */
		if ($compressionMethod == 1) {
			// Just dump the compressed data
			$this->_fwrite( $fp, $zdata );
			if($this->hasError()) return;
			unset( $zdata );
		} elseif (!$isDir) {
			if($isVirtual)
			{
				$this->_fwrite( $fp, $sourceNameOrData );
				if($this->hasError()) return;				
			}
			else
			{
				// Copy the file contents, ignore directories
				$zdatafp = @fopen( $sourceNameOrData, "rb" );
				while( !feof($zdatafp) ) {
					$zdata = fread($zdatafp, 524288);
					$this->_fwrite( $fp, $zdata );
					if($this->hasError()) return;
				}
				fclose( $zdatafp );
			}
		}

		fclose( $fp );
		
		// ... and return TRUE = success
		return TRUE;
	}
	
	
	// ------------------------------------------------------------------------
	// Archiver-specific utility functions
	// ------------------------------------------------------------------------
	/**
	 * Outputs a Standard Header at the top of the file
	 *
	 */
	function _writeArchiveHeader()
	{
		$fp = @fopen( $this->_dataFileName, 'r+' );
		if($fp === false)
		{
			$this->setError('Could not open '.$this->_dataFileName.' for writing. Check permissions and open_basedir restrictions.');
			return;
		}
		$this->_fwrite( $fp, $this->_ctrlDirHeader );					// ID string (JPA)
		if($this->hasError()) return;
		$this->_fwrite( $fp, pack('v', 19) );							// Header length; fixed to 19 bytes
		$this->_fwrite( $fp, pack('C', _JPA_MAJOR ) );					// Major version
		$this->_fwrite( $fp, pack('C', _JPA_MINOR ) );					// Minor version
		$this->_fwrite( $fp, pack('V', $this->_fileCount ) );			// File count
		$this->_fwrite( $fp, pack('V', $this->_uncompressedSize ) );	// Size of files when extracted
		$this->_fwrite( $fp, pack('V', $this->_compressedSize ) );		// Size of files when stored
		@fclose( $fp );
	}

}
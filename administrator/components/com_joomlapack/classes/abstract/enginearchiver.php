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

// Ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

/**
 * Abstract class all archiver engines must implement
 * 
 * @abstract 
 */
class JoomlapackArchiver extends JoomlapackObject
{
	/**
	 * JPA transformation source archive absoluet file name
	 *
	 * @var integer
	 */
	var $_xform_source;
	
	/**
	 * File pointer to installer JPA package
	 *
	 * @var handle
	 */
	var $_xform_fp;
	
	// ------------------------- Final Methods -------------------------
	
	/**
	 * Adds a list of files into the archive, removing $removePath from the
	 * file names and adding $addPath to them.
	 *
	 * @param array $fileList A simple string array of filepaths to include
	 * @param string $removePath Paths to remove from the filepaths
	 * @param string $addPath Paths to add in front of the filepaths
	 * @final
	 * @access public
	 */
	function addFileList( &$fileList, $removePath = '', $addPath = '' )
	{
		if( !is_array($fileList) ) {
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, __CLASS__ . " :: addFileList called without a file list array");
			return false;
		}

		foreach( $fileList as $file ) {
			$storedName = $this->_addRemovePaths( $file, $removePath, $addPath );
			$ret = $this->_addFile( false, $file, $storedName );
			if( $ret === false ) {
				JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "Unreadable file $file. Check permissions.");
			}
		}

		return true;
	}
	
	/**
	 * Adds a single file in the archive
	 *
	 * @param string $file The absolute path to the file to add
	 * @param string $removePath Path to remove from $file
	 * @param string $addPath Path to prepend to $file
	 */
	function addFile( $file, $removePath = '', $addPath = '' )
	{
		$storedName = $this->_addRemovePaths( $file, $removePath, $addPath );
		$ret = $this->_addFile( false, $file, $storedName );
		if( $ret === false ) {
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "Unreadable file $file. Check permissions.");
		}
	}
	
	/**
	 * Adds a file to the archive, with a name that's different from the source
	 * filename
	 *
	 * @param string $sourceFile Absolute path to the source file
	 * @param string $targetFile Relative filename to store in archive
	 * @final
	 * @access public
	 */
	function addFileRenamed( $sourceFile, $targetFile )
	{
		$ret = $this->_addFile(false, $sourceFile, $targetFile);
		if( $ret === false ) {
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "Unreadable file $file. Check permissions.");
		}
		return $ret;		
	}
	
	/**
	 * Adds a file to the archive, given the stored name and its contents
	 *
	 * @param string $fileName The base file name
	 * @param string $addPath The relative path to prepend to file name
	 * @param string $virtualContent The contents of the file to be archived
	 * @final
	 * @access public
	 */
	function addVirtualFile( $fileName, $addPath = '', &$virtualContent )
	{
		$storedName = $this->_addRemovePaths( $fileName, '', $addPath );
		$ret = $this->_addFile( true, $virtualContent, $storedName );
		return $ret;
	}
	
	// ------------------------- Abstract Methods -------------------------
	// The derived classes only have to implement the methods below in order
	// to work correctly.
	
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
		
	}
	
	/**
	 * Makes whatever finalization is needed for the archive to be considered
	 * complete and usefull (or, generally, clean up)
	 * @abstract
	 * @access public
	 */
	function finalize()
	{
		
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
		
	}
	
	// ------------------------- Helper methods -------------------------
	/**
	 * Write to file, defeating magic_quotes_runtime settings (pure binary write)
	 * @param handle $fp Handle to a file
	 * @param string $data The data to write to the file 
	 * @access protected
	 */
	function _fwrite( $fp, $data )
	{
		$len = strlen( $data );
		fwrite( $fp, $data, $len );
	}
	
	/**
	 * Converts a human formatted size to integer representation of bytes,
	 * e.g. 1M to 1024768
	 *
	 * @param string $val
	 * @return integer
	 * @access protected
	 */
	function _return_bytes($val) {
		$val = trim($val);
		$last = strtolower($val{strlen($val)-1});
		switch($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

		return $val;
	}
	
	/**
	* Removes the $p_remove_dir from $p_filename, while prepending it with $p_add_dir.
	* Largely based on code from the pclZip library.
	* @access private
	*/
	function _addRemovePaths( $p_filename, $p_remove_dir, $p_add_dir ) {
		$p_filename = JoomlapackAbstraction::TranslateWinPath( $p_filename );
		$p_remove_dir = ($p_remove_dir == '') ? '' : JoomlapackAbstraction::TranslateWinPath( $p_remove_dir ); //should fix corrupt backups, fix by nicholas
		
		if( !($p_remove_dir == "") ) {
			if (substr($p_remove_dir, -1) != '/')
				$p_remove_dir .= "/";

			if ((substr($p_filename, 0, 2) == "./") || (substr($p_remove_dir, 0, 2) == "./"))
			{
				if ((substr($p_filename, 0, 2) == "./") && (substr($p_remove_dir, 0, 2) != "./"))
					$p_remove_dir = "./".$p_remove_dir;
				if ((substr($p_filename, 0, 2) != "./") && (substr($p_remove_dir, 0, 2) == "./"))
					$p_remove_dir = substr($p_remove_dir, 2);
			}

			$v_compare = $this->_PathInclusion($p_remove_dir, $p_filename);
			if ($v_compare > 0)
			{
				if ($v_compare == 2) {
					$v_stored_filename = "";
				}
				else {
					$v_stored_filename = substr($p_filename, strlen($p_remove_dir));
				}
			}
		} else {
			$v_stored_filename = $p_filename;
		}

		if( !($p_add_dir == "") ) {
			if (substr($p_add_dir, -1) == "/")
				$v_stored_filename = $p_add_dir.$v_stored_filename;
			else
				$v_stored_filename = $p_add_dir."/".$v_stored_filename;
		}

		return $v_stored_filename;
	}

	/**
	* This function indicates if the path $p_path is under the $p_dir tree. Or,
	* said in an other way, if the file or sub-dir $p_path is inside the dir
	* $p_dir.
	* The function indicates also if the path is exactly the same as the dir.
	* This function supports path with duplicated '/' like '//', but does not
	* support '.' or '..' statements.
	*
	* Copied verbatim from pclZip library
	*
	* @return integer 	0 if $p_path is not inside directory $p_dir,
	* 					1 if $p_path is inside directory $p_dir
	*					2 if $p_path is exactly the same as $p_dir
	*/
	function _PathInclusion($p_dir, $p_path)
	{
		$v_result = 1;

		// ----- Explode dir and path by directory separator
		$v_list_dir = explode("/", $p_dir);
		$v_list_dir_size = sizeof($v_list_dir);
		$v_list_path = explode("/", $p_path);
		$v_list_path_size = sizeof($v_list_path);

		// ----- Study directories paths
		$i = 0;
		$j = 0;
		while (($i < $v_list_dir_size) && ($j < $v_list_path_size) && ($v_result)) {
			// ----- Look for empty dir (path reduction)
			if ($v_list_dir[$i] == '') {
				$i++;
				continue;
			}
			if ($v_list_path[$j] == '') {
				$j++;
				continue;
			}

			// ----- Compare the items
			if (($v_list_dir[$i] != $v_list_path[$j]) && ($v_list_dir[$i] != '') && ( $v_list_path[$j] != ''))  {
				$v_result = 0;
			}

			// ----- Next items
			$i++;
			$j++;
		}

		// ----- Look if everything seems to be the same
		if ($v_result) {
			// ----- Skip all the empty items
			while (($j < $v_list_path_size) && ($v_list_path[$j] == '')) $j++;
			while (($i < $v_list_dir_size) && ($v_list_dir[$i] == '')) $i++;

			if (($i >= $v_list_dir_size) && ($j >= $v_list_path_size)) {
				// ----- There are exactly the same
				$v_result = 2;
			}
			else if ($i < $v_list_dir_size) {
				// ----- The path is shorter than the dir
				$v_result = 0;
			}
		}

		// ----- Return
		return $v_result;
	}

	// ------------------------- JPA inclusion methods -------------------------
	
	/**
	 * Transforms a JPA archive (containing an installer) to the native archive format
	 * of the class. It actually extracts the source JPA in memory and instructs the
	 * class to include each extracted file. 
	 *
	 * @param string $fileName The source JPA archive's filename
	 * @return boolean False if an error occured, true otherwise
	 * @access protected
	 */
	function transformJPA( $fileName )
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, 'Initializing with JPA package '.$fileName);
		
		// Try opening the file
		$this->_xform_source = $fileName;
		if( file_exists($this->_xform_source) )
		{
			$this->_xform_fp = @fopen( $this->_xform_source, 'r');
			if( $this->_xform_fp === false )
			{
				JoomlapackLogger::WriteLog(_JP_LOG_ERROR , __CLASS__ . ":: Can't seed archive with installer package ".$this->_xform_source);
				return false; 
			}
		} else {
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR , __CLASS__ . ":: Installer package ".$this->_xform_source." does not exist!");
			return false;
		}
		
		// Skip over the header and check no problem exists
		$offset = $this->_xformReadHeader();
		if($offset === false)
		{
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, 'JPA package file was not read');
			return false; // Oops! The package file doesn't exist or is corrupt
		}
		
		do
		{
			$ret =& $this->_xformExtract($offset);
			if(is_array($ret))
			{
				$offset = $ret['offset'];
				if(!$ret['skip'] && !$ret['done'])
				{
					JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, '  Adding '.$ret['filename'] . '; Next offset:'.$offset);
					$this->addVirtualFile($ret['filename'], '', $ret['data']);
				}
				else
				{
					$reason = $ret['done'] ? 'Done' : '  Skipping '.$ret['filename'];
					JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, $reason);
				}
			}
			else
			{
				JoomlapackLogger::WriteLog(_JP_LOG_WARNING, 'JPA extraction returned FALSE');
			}
		} while ( !($ret === false) && (!$ret['done']) );
		
		// Close the file
		fclose($this->_xform_fp);
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, 'Initializing with JPA package has finished');
		return true;
	}
	
	/**
	 * Extracts a file from the JPA archive and returns an in-memory array containing it
	 * and its file data. The data returned is an array, consisting of the following keys:
	 * "filename" => relative file path stored in the archive
	 * "data"     => file data
	 * "offset"   => next offset to use
	 * "skip"     => if this is not a file, just skip it...
	 * "done"     => No more files left in archive
	 *
	 * @param integer $offset The absolute data offset from archive's header
	 * @return array See description for more information
	 */
	function &_xformExtract( $offset )
	{
		$false = false; // Used to return false values in case an error occurs
		
		// Generate a return array
		$retArray = array(
			"filename"			=> '',		// File name extracted
			"data"				=> '',		// File data
			"offset"			=> 0,		// Offset in ZIP file
			"skip"              => false,   // Skip this?
			"done"				=> false	// Are we done yet?
		);
	
		// If we can't open the file, return an error condition
		if( $this->_xform_fp === false ) return $false;
		
		// Go to the offset specified
		fseek( $this->_xform_fp, $offset );
		
		// Get and decode Entity Description Block
		$signature = fread($this->_xform_fp, 3);

		// Check signature
		if( $signature == 'JPF' )
		{
			// This a JPA Entity Block. Process the header.
			
			// Read length of EDB and of the Entity Path Data
			$length_array = unpack('vblocksize/vpathsize', fread($this->_xform_fp, 4));
			// Read the path data
			$file = fread( $this->_xform_fp, $length_array['pathsize'] );
			// Read and parse the known data portion
			$bin_data = fread( $this->_xform_fp, 14 );
			$header_data = unpack('Ctype/Ccompression/Vcompsize/Vuncompsize/Vperms', $bin_data);
			// Read any unknwon data
			$restBytes = $length_array['blocksize'] - (21 + $length_array['pathsize']);
			if( $restBytes > 0 ) $junk = fread($this->_xform_fp, $restBytes);
			
			$compressionType = $header_data['compression'];
			
			// Populate the return array
			$retArray['filename'] = $file;
			$retArray['skip'] = ( $header_data['compsize'] == 0 ); // Skip over directories

			switch( $header_data['type'] )
			{
				case 0:
					// directory
					break;
					
				case 1:
					// file
					switch( $compressionType )
					{
						case 0: // No compression
							if( $header_data['compsize'] > 0 ) // 0 byte files do not have data to be read
							{
								$retArray['data'] = fread( $this->_xform_fp, $header_data['compsize'] );
							}
							break;
							
						case 1: // GZip compression
							$zipData = fread( $this->_xform_fp, $header_data['compsize'] );
							$retArray['data'] = gzinflate( $zipData );
							break;
							
						case 2: // BZip2 compression
							$zipData = fread( $this->_xform_fp, $header_data['compsize'] );
							$retArray['data'] = bzdecompress( $zipData );
							break;
					}
					break;
			}
			$retArray['offset'] = ftell( $this->_xform_fp );
			return $retArray;
		} else {
			// This is not a file header. This means we are done.
			$retArray['done'] = true;
			return $retArray;
		}
	}
	
	/**
	 * Skips over the JPA header entry and returns the offset file data starts from
	 *
	 * @return boolean|integer False on failure, offset otherwise
	 */
	function _xformReadHeader()
	{
		// Fail for unreadable files
		if( $this->_xform_fp === false ) return false;

		// Go to the beggining of the file
		rewind( $this->_xform_fp );
		
		// Read the signature
		$sig = fread( $this->_xform_fp, 3 );
		
		if ($sig != 'JPA') return false; // Not a JoomlaPack Archive?
		
		// Read and parse header length
		$header_length_array = unpack( 'v', fread( $this->_xform_fp, 2 ) );
		$header_length = $header_length_array[1];
		
		// Read and parse the known portion of header data (14 bytes)
		$bin_data = fread($this->_xform_fp, 14);
		$header_data = unpack('Cmajor/Cminor/Vcount/Vuncsize/Vcsize', $bin_data);
		
		// Load any remaining header data (forward compatibility)
		$rest_length = $header_length - 19;
		if( $rest_length > 0 ) $junk = fread($this->_xform_fp, $rest_length);
		
		return ftell( $this->_xform_fp );
	}
}
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
* 
* ZIP Creation Module
*
* Creates a ZIP file based on the contents of a given file list.
* Based upon the Compress library of the Horde Project [http://www.horde.org],
* modified to fit JoomlaPack needs. This class is safe to serialize and deserialize
* between subsequent calls.
*
* JoomlaPack modifications : eficiently read data from files, selective compression,
* defensive memory management to avoid memory exhaustion errors, separated central
* directory and data section creation
*
* ----------------------------------------------------------------------------
*
* Original code credits, from Horde library:
*
* The ZIP compression code is partially based on code from:
*   Eric Mueller <eric@themepark.com>
*   http://www.zend.com/codex.php?id=535&single=1
*
*   Deins125 <webmaster@atlant.ru>
*   http://www.zend.com/codex.php?id=470&single=1
*
* The ZIP compression date code is partially based on code from
*   Peter Listiak <mlady@users.sourceforge.net>
*
* Copyright 2000-2006 Chuck Hagenbuch <chuck@horde.org>
* Copyright 2002-2006 Michael Cochrane <mike@graftonhall.co.nz>
* Copyright 2003-2006 Michael Slusarz <slusarz@horde.org>
*
* Additional Credits:
*
* Contains code from pclZip library [http://www.phpconcept.net/pclzip/index.en.php]
*
* Modifications for JoomlaPack:
* Copyright 2007-2008 Nicholas K. Dionysopoulos <nikosdion@gmail.com>
*/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

$config =& JoomlapackConfiguration::getInstance();
define("_JoomlapackPackerZIP_FORCE_FOPEN", $config->get('mnZIPForceOpen')); // Don't force use of fopen() to read uncompressed data in memory
define("_JoomlapackPackerZIP_COMPRESSION_THRESHOLD", $config->get('mnZIPCompressionThreshold')); // Don't compress files over this size
define("_JoomlapackPackerZIP_DIRECTORY_READ_CHUNK", $config->get('mnZIPDirReadChunk')); // How much data to read at once when finalizing ZIP archives

class JoomlapackPackerZIP extends JoomlapackArchiver {
    /**
     * ZIP compression methods. JoomlaPack supports 0x0 (none) and 0x8 (deflated)
     *
     * @var array
     */
    var $_methods = array(
        0x0 => 'None',
        0x1 => 'Shrunk',
        0x2 => 'Super Fast',
        0x3 => 'Fast',
        0x4 => 'Normal',
        0x5 => 'Maximum',
        0x6 => 'Imploded',
        0x8 => 'Deflated'
    );

    /**
     * Beginning of central directory record.
     *
     * @var string
     */
    var $_ctrlDirHeader = "\x50\x4b\x01\x02";

    /**
     * End of central directory record.
     *
     * @var string
     */
    var $_ctrlDirEnd = "\x50\x4b\x05\x06\x00\x00\x00\x00";

    /**
     * Beginning of file contents.
     *
     * @var string
     */
    var $_fileHeader = "\x50\x4b\x03\x04";

    /**
     * The name of the temporary file holding the ZIP's Central Directory
     *
     * @var string
     */
	var $_ctrlDirFileName;

    /**
     * The name of the file holding the ZIP's data, which becomes the final archive
     *
     * @var string
     */
	var $_dataFileName;

    /**
     * The total number of files and directories stored in the ZIP archive
     *
     * @var integer
     */
	var $_totalFileEntries;

    /**
     * The chunk size for CRC32 calculations
     *
     * @var integer
     */
	var $JoomlapackPackerZIP_CHUNK_SIZE;
	
	// ------------------------------------------------------------------------
	// Implementation of abstract methods
	// ------------------------------------------------------------------------

    /**
     * Class constructor - initializes internal operating parameters
     * 
     * @return JoomlapackPackerZIP The class instance
     */
	function JoomlapackPackerZIP()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerZIP :: New instance");
		// Try to use as much memory as it's possible for CRC32 calculation
		$memLimit = ini_get("memory_limit");
		if( is_numeric($memLimit) && ($memLimit < 0) ) $memLimit = ""; // 1.2a3 -- Rare case with memory_limit < 0, e.g. -1Mb!
		if ( ($memLimit == "") ) {
			// No memory limit, use 2Mb chunks (fairly large, right?)
			$this->JoomlapackPackerZIP_CHUNK_SIZE = 2097152;
		} elseif ( function_exists("memory_get_usage") ) {
			// PHP can report memory usage, see if there's enough available memory; Joomla! alone eats about 5-6Mb! This code is called on files <= 1Mb
			$memLimit = $this->_return_bytes( $memLimit );
			$availableRAM = $memLimit - memory_get_usage();

			if ($availableRAM <= 0) {
				// Some PHP implemenations also return the size of the httpd footprint!
				if ( ($memLimit - 6291456) > 0 ) {
					$this->JoomlapackPackerZIP_CHUNK_SIZE = $memLimit - 6291456;
				} else {
					$this->JoomlapackPackerZIP_CHUNK_SIZE = 2097152;
				}
			} else {
					$this->JoomlapackPackerZIP_CHUNK_SIZE = $availableRAM * 0.5;
			}
		} else {
			// PHP can't report memory usage, use a conservative 512Kb
			$this->JoomlapackPackerZIP_CHUNK_SIZE = 524288;
		}
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Chunk size for CRC is now " . $this->JoomlapackPackerZIP_CHUNK_SIZE . " bytes");
	}
	
	/**
	 * Initialises the archiver class, creating the archive from an existent
	 * installer's JPA archive. 
	 *
	 * @param string $sourceJPAPath Absolute path to an installer's JPA archive
	 * @param string $targetArchivePath Absolute path to the generated archive 
	 * @param array $options A named key array of options (optional). This is currently not supported
	 * @access public
	 */
	function initialize( $sourceJPAPath, $targetArchivePath, $options = array() )
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerZIP :: initialize - archive $targetArchivePath");
		
		// Get names of temporary files
		$configuration =& JoomlapackConfiguration::getInstance();
		$this->_ctrlDirFileName = tempnam( $configuration->get('TempDirectory'), 'jpzcd' );
		$this->_dataFileName = $targetArchivePath;

		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerZIP :: CntDir Tempfile = " . $this->_ctrlDirFileName);

		// Create temporary file
		touch( $this->_ctrlDirFileName );

		// Try to kill the archive if it exists
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackPackerZIP :: Killing old archive");
		$fp = fopen( $this->_dataFileName, "wb" );
		if (!($fp === false)) {
			ftruncate( $fp,0 );
			fclose( $fp );
		} else {
			@unlink( $this->_dataFileName );
		}
		touch( $this->_dataFileName );

		// Seed the archive
		$this->transformJPA($sourceJPAPath);
	}

    /**
     * Creates the ZIP file out of its pieces.
     * Official ZIP file format: http://www.pkware.com/appnote.txt
     *
     * @return boolean TRUE on success, FALSE on failure
     */
    function finalize()
    {
    	// 1. Get size of central directory
    	clearstatcache();
    	$cdSize = filesize( $this->_ctrlDirFileName );

    	// 2. Append Central Directory to data file and remove the CD temp file afterwards
    	$dataFP = fopen( $this->_dataFileName, "ab" );
    	$cdFP = fopen( $this->_ctrlDirFileName, "rb" );

    	if( $dataFP === false )
    	{
    		$this->setError('Could not open ZIP data file '.$this->_dataFileName.' for reading');
    		return false;
    	}
    	
    	if ( $cdFP === false ) {
    		// Already glued, return
			fclose( $dataFP );
			return false;
    	}

    	while( !feof($cdFP) )
    	{
    		$chunk = fread( $cdFP, _JoomlapackPackerZIP_DIRECTORY_READ_CHUNK );
    		$this->_fwrite( $dataFP, $chunk );
    		if($this->hasError()) return;
    	}
    	unset( $chunk );
    	fclose( $cdFP );

    	@unlink( $this->_ctrlDirFileName );

    	// 3. Write the rest of headers to the end of the ZIP file
    	fclose( $dataFP );
    	clearstatcache();
    	$dataSize = filesize( $this->_dataFileName ) - $cdSize;
    	$dataFP = fopen( $this->_dataFileName, "ab" );
		if($dataFP === false)
		{
			$this->setError('Could not open '.$this->_dataFileName.' for append');
			return false;
		}
    	$this->_fwrite( $dataFP, $this->_ctrlDirEnd );
    	if($this->hasError()) return;
    	$this->_fwrite( $dataFP, pack('v', $this->_totalFileEntries) ); /* Total # of entries "on this disk". */
    	$this->_fwrite( $dataFP, pack('v', $this->_totalFileEntries) ); /* Total # of entries overall. */
    	$this->_fwrite( $dataFP, pack('V', $cdSize) ); /* Size of central directory. */
    	$this->_fwrite( $dataFP, pack('V', $dataSize) ); /* Offset to start of central dir. */
    	$this->_fwrite( $dataFP, "\x00\x00" ); /* ZIP file comment length. */
    	fclose( $dataFP );
		//sleep(2);
    	return true;
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
		} else {
			$fileSize = $isDir ? 0 : filesize($sourceNameOrData);		
		}
		
		// Get last modification time to store in archive
		$ftime = $isVirtual ? time() : filemtime( $sourceNameOrData );

		// Decide if we will compress
		if ($isDir) {
			$compressionMethod = 0; // don't compress directories...
		} else {
			// Do we have plenty of memory left?
			$memLimit = ini_get("memory_limit");
			if (($memLimit == "") || ($fileSize >= _JoomlapackPackerZIP_COMPRESSION_THRESHOLD)) {
				// No memory limit, or over 1Mb files => always compress up to 1Mb files (otherwise it times out)
				$compressionMethod = ($fileSize <= _JoomlapackPackerZIP_COMPRESSION_THRESHOLD) ? 8 : 0;
			} elseif ( function_exists("memory_get_usage") ) {
				// PHP can report memory usage, see if there's enough available memory; Joomla! alone eats about 5-6Mb! This code is called on files <= 1Mb
				$memLimit = $this->_return_bytes( $memLimit );
				$availableRAM = $memLimit - memory_get_usage();
				$compressionMethod = (($availableRAM / 2.5) >= $fileSize) ? 8 : 0;
			} else {
				// PHP can't report memory usage, compress only files up to 512Kb (conservative approach) and hope it doesn't break
				$compressionMethod = ($fileSize <= 524288) ? 8 : 0;;
			}
		}

		$compressionMethod = function_exists("gzcompress") ? $compressionMethod : 0;

		$storedName = $targetName;
		
		if($isVirtual) JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, '  Virtual add:'.$storedName.' ('.$fileSize.') - '.$compressionMethod);

        /* "Local file header" segment. */
        $unc_len = &$fileSize; // File size

        if (!$isDir) {
        	// Get CRC for regular files, not dirs
        	if($isVirtual)
        	{
        		$crc = crc32($sourceNameOrData);
        	}
        	else
        	{
	        	$crcCalculator = new CRC32CalcClass;
				$crc     = $crcCalculator->crc32_file( $sourceNameOrData, $this->JoomlapackPackerZIP_CHUNK_SIZE ); // This is supposed to be the fast way to calculate CRC32 of a (large) file.
				unset( $crcCalculator );
	
				// If the file was unreadable, $crc will be false, so we skip the file
				if ($crc === false) {
					$this->setWarning('Could not calculate CRC32 for '.$sourceNameOrData);
					return false;
				}
        	}
		} else {
			// Dummy CRC for dirs
			$crc = 0;
			$storedName .= "/";
			$unc_len = 0;
		}


		// If we have to compress, read the data in memory and compress it
		if ($compressionMethod == 8) {
			// Get uncompressed data
			if( $isVirtual )
			{
				$udata =& $sourceNameOrData;
			}
			else
			{
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
				// Unreadable file, skip it. Normally, we should have exited on CRC code above
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

        /* Get the hex time. */
        $dtime    = dechex($this->_unix2DosTime($ftime));
        $hexdtime = chr(hexdec($dtime[6] . $dtime[7])) .
                    chr(hexdec($dtime[4] . $dtime[5])) .
                    chr(hexdec($dtime[2] . $dtime[3])) .
                    chr(hexdec($dtime[0] . $dtime[1]));

        // Get current data file size
        clearstatcache();
        $old_offset = filesize( $this->_dataFileName );

        // Open data file for output
        $fp = @fopen( $this->_dataFileName, "ab");
        if ($fp === false)
        {
			$this->setError("Could not open archive file {$this->_dataFileName} for append!");
			return false;
        }
        $this->_fwrite( $fp, $this->_fileHeader );									/* Begin creating the ZIP data. */
        $this->_fwrite( $fp, "\x14\x00" );					/* Version needed to extract. */
        $this->_fwrite( $fp, "\x00\x00" ); 											/* General purpose bit flag. */
        $this->_fwrite( $fp, ($compressionMethod == 8) ? "\x08\x00" : "\x00\x00" );	/* Compression method. */
        $this->_fwrite( $fp, $hexdtime );											/* Last modification time/date. */
        $this->_fwrite( $fp, pack('V', $crc) );            /* CRC 32 information. */
        $this->_fwrite( $fp, pack('V', $c_len) );          /* Compressed filesize. */
        $this->_fwrite( $fp, pack('V', $unc_len) );        /* Uncompressed filesize. */
        $this->_fwrite( $fp, pack('v', strlen($storedName)) );   /* Length of filename. */
        $this->_fwrite( $fp, pack('v', 0) );               /* Extra field length. */
        $this->_fwrite( $fp, $storedName );                      /* File name. */

		/* "File data" segment. */
		if ($compressionMethod == 8) {
			// Just dump the compressed data
			$this->_fwrite( $fp, $zdata );
			if($this->hasError()) return;
			unset( $zdata );
		} elseif (!$isDir) {
			if( $isVirtual )
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

        // Done with data file.
        fclose( $fp );

        // Open the central directory file for append
        $fp = @fopen( $this->_ctrlDirFileName, "ab");
        if ($fp === false)
        {
        	$this->setError("Could not open Central Directory temporary file for append!");
        	return false;
        }
        $this->_fwrite( $fp, $this->_ctrlDirHeader );
        $this->_fwrite( $fp, "\x00\x00" );                /* Version made by. */
		$this->_fwrite( $fp, "\x14\x00" );					/* Version needed to extract */
        $this->_fwrite( $fp, "\x00\x00" );                /* General purpose bit flag */
        $this->_fwrite( $fp, ($compressionMethod == 8) ? "\x08\x00" : "\x00\x00" );	/* Compression method. */
        $this->_fwrite( $fp, $hexdtime );                 /* Last mod time/date. */
        $this->_fwrite( $fp, pack('V', $crc) );           /* CRC 32 information. */
        $this->_fwrite( $fp, pack('V', $c_len) );         /* Compressed filesize. */
        $this->_fwrite( $fp, pack('V', $unc_len) );       /* Uncompressed filesize. */
        $this->_fwrite( $fp, pack('v', strlen($storedName)) );  /* Length of filename. */
        $this->_fwrite( $fp, pack('v', 0 ) );             /* Extra field length. */
        $this->_fwrite( $fp, pack('v', 0 ) );             /* File comment length. */
        $this->_fwrite( $fp, pack('v', 0 ) );             /* Disk number start. */
        $this->_fwrite( $fp, pack('v', 0 ) );             /* Internal file attributes. */
        $this->_fwrite( $fp, pack('V', $isDir ? 0x41FF0010 : 0xFE49FFE0) ); /* External file attributes -   'archive' bit set. */
        $this->_fwrite( $fp, pack('V', $old_offset) );    /* Relative offset of local
                                                header. */
        $this->_fwrite( $fp, $storedName );                     /* File name. */
        /* Optional extra field, file comment goes here. */

        // Finished with Central Directory
        fclose( $fp );

        // Finaly, increase the file counter by one
        $this->_totalFileEntries++;

        // ... and return TRUE = success
        return TRUE;
	}
    
	// ------------------------------------------------------------------------
	// Archiver-specific utility functions
	// ------------------------------------------------------------------------

    /**
     * Converts a UNIX timestamp to a 4-byte DOS date and time format
     * (date in high 2-bytes, time in low 2-bytes allowing magnitude
     * comparison).
     *
     * @access private
     *
     * @param integer $unixtime  The current UNIX timestamp.
     *
     * @return integer  The current date in a 4-byte DOS format.
     */
    function _unix2DOSTime($unixtime = null)
    {
        $timearray = (is_null($unixtime)) ? getdate() : getdate($unixtime);

        if ($timearray['year'] < 1980) {
            $timearray['year']    = 1980;
            $timearray['mon']     = 1;
            $timearray['mday']    = 1;
            $timearray['hours']   = 0;
            $timearray['minutes'] = 0;
            $timearray['seconds'] = 0;
        }

        return (($timearray['year'] - 1980) << 25) |
                ($timearray['mon'] << 21) |
                ($timearray['mday'] << 16) |
                ($timearray['hours'] << 11) |
                ($timearray['minutes'] << 5) |
                ($timearray['seconds'] >> 1);
    }    
}

// ===================================================================================================

/**
 * A handy class to abstract the calculation of CRC32 of files under various
 * server conditions and versions of PHP.
 * @access private
 */
class CRC32CalcClass
{
	/**
	 * Returns the CRC32 of a file, selecting the more appropriate algorithm.
	 *
	 * @param string $filename Absolute path to the file being processed
	 * @param integer $JoomlapackPackerZIP_CHUNK_SIZE Obsoleted
	 * @return integer The CRC32 in numerical form
	 */
	function crc32_file( $filename, $JoomlapackPackerZIP_CHUNK_SIZE )
	{
		if( function_exists("hash_file") )
		{
			$res = $this->crc32_file_php512( $filename );
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "File $filename - CRC32 = " . dechex($res) . " [PHP512]" );
		}
		else if ( function_exists("file_get_contents") && ( filesize($filename) <= $JoomlapackPackerZIP_CHUNK_SIZE ) ) {
			$res = $this->crc32_file_getcontents( $filename );
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "File $filename - CRC32 = " . dechex($res) . " [GETCONTENTS]" );
		} else {
			$res = $this->crc32_file_php4($filename, $JoomlapackPackerZIP_CHUNK_SIZE);
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "File $filename - CRC32 = " . dechex($res) . " [PHP4]" );
		}

		if ($res === FALSE) {
			JoomlapackLogger::WriteLog(_JP_LOG_WARNING, "File $filename - NOT READABLE: CRC32 IS WRONG!" );
		}
		return $res;
	}

	/**
	 * Very efficient CRC32 calculation for PHP 5.1.2 and greater, requiring
	 * the 'hash' PECL extension
	 *
	 * @param string $filename Absolute filepath
	 * @return integer The CRC32
	 * @access private
	 */
	function crc32_file_php512($filename)
	{
		$res = @hash_file('crc32b', $filename, false );
		// It returns something like 04030201 when we should get 01020304. Duh!
		$res = substr($res,6,2) . substr($res,4,2) . substr($res,2,2) . substr($res,0,2);
		$res = hexdec( $res );
		return $res;
	}

	/**
	 * A compatible CRC32 calculation using file_get_contents, utilizing immense
	 * ammounts of RAM
	 *
	 * @param string $filename
	 * @return integer
	 * @access private
	 */
	function crc32_file_getcontents($filename)
	{
		return crc32( @file_get_contents($filename) );
	}

	/**
	 * There used to be a workaround for large files under PHP4. However, it never
	 * really worked, so it is removed and a warning is posted instead.
	 *
	 * @param string $filename
	 * @param integer $JoomlapackPackerZIP_CHUNK_SIZE
	 * @return integer
	 */
	function crc32_file_php4($filename, $JoomlapackPackerZIP_CHUNK_SIZE)
	{
		JoomlapackLogger::WriteLog( _JP_LOG_WARNING, "Function hash_file not detected processing the 'large'' file $filename; it will appear as seemingly corrupt in the archive. Only the CRC32 is invalid, though. Please read our forum announcement for explanation of this message." );
		return 0;
	}
}
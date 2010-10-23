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

/**
 * Default File Lister Engine, a.k.a. "Pure PHP File Lister Engine"
 * Formerly known as the Filesystem Abstraction Module. Provides pure PHP filesystem scanner
 * functionality in a compatible manner, depending on server's capabilities.
 */
class JoomlapackListerAbstraction extends JoomlapackObject {

	/**
	 * Should we use glob() ?
	 * @var boolean
	*/
	var $_globEnable;

	/**
	 * Public constructor for JoomlapackListerAbstraction class. Does some heuristics to figure out the
	 * server capabilities and setup internal variables
	 */
	function JoomlapackListerAbstraction()
	{
		// Don't use glob if it's disabled or if opendir is available
		$this->_globEnable = function_exists('glob');
		if( function_exists('opendir') && function_exists('readdir') && function_exists('closedir') )
			$this->_globEnable = false;
	}

	/**
	 * Searches the given directory $dirName for files and folders and returns a multidimensional array.
	 * If the directory is not accessible, returns FALSE
	 * 
	 * @param string $dirName
	 * @param string $shellFilter
	 * @return array See function description for details
	 */
	function &getDirContents( $dirName, $shellFilter = null )
	{
		if ($this->_globEnable) {
			return $this->_getDirContents_glob( $dirName, $shellFilter );
		} else {
			return $this->_getDirContents_opendir( $dirName, $shellFilter );
		}
	}

	// ============================================================================
	// PRIVATE SECTION
	// ============================================================================

	/**
	 * Searches the given directory $dirName for files and folders and returns a multidimensional array.
	 * If the directory is not accessible, returns FALSE. This function uses the PHP glob() function.
	 * @return array See function description for details
	 */
	function _getDirContents_glob( $dirName, $shellFilter = null )
	{
		if (is_null($shellFilter)) {
			// Get folder contents
			$allFilesAndDirs1 = @glob($dirName . "/*"); // regular files
			$allFilesAndDirs2 = @glob($dirName . "/.*"); // *nix hidden files

			// Try to merge the arrays
			if ($allFilesAndDirs1 === false) {
				if ($allFilesAndDirs2 === false) {
					$allFilesAndDirs = false;
				} else {
					$allFilesAndDirs = $allFilesAndDirs2;
				}
			} elseif ($allFilesAndDirs2 === false) {
				$allFilesAndDirs = $allFilesAndDirs1;
			} else {
				$allFilesAndDirs = @array_merge($allFilesAndDirs1, $allFilesAndDirs2);
			}

			// Free unused arrays
			unset($allFilesAndDirs1);
			unset($allFilesAndDirs2);

		} else {
			$allFilesAndDirs = @glob($dirName . "/$shellFilter"); // filtered files
		}

		// Check for unreadable directories
		if ( $allFilesAndDirs === FALSE ) {
			$false = false;
			return $false;
		}

		// Populate return array
		$retArray = array();

		foreach($allFilesAndDirs as $filename) {
			$retArray[] = JoomlapackAbstraction::TranslateWinPath( $filename );
		}

		return $retArray;
	}

	function _getDirContents_opendir( $dirName, $shellFilter = null )
	{
		$handle = @opendir( $dirName );

		// If directory is not accessible, just return FALSE
		if ($handle === FALSE) {
			$this->setWarning('Unreadable directory '.$dirName);
			$false = false;
			return $false;
		}

		// Initialize return array
		$retArray = array();

		// FIX 1.2.1 -- Remove trailing slash
		if( (substr($dirName,-1,1) == '/') || (substr($dirName,-1,1) == '\\')) $dirName = substr($dirName,0,strlen($dirName)-1);
		
		while( !( ( $filename = readdir($handle) ) === false) ) {
			$match = is_null( $shellFilter );
			$match = (!$match) ? fnmatch($shellFilter, $filename) : true;
			if ($match) {
				$filename = JoomlapackAbstraction::TranslateWinPath( $dirName . DIRECTORY_SEPARATOR . $filename );
				$retArray[] = $filename;
			}
		}

		@closedir($handle);
		return $retArray;
	}
}

// FIX 1.1.0 -- fnmatch not available on non-POSIX systems
// Thanks to soywiz@php.net for this usefull alternative function [http://gr2.php.net/fnmatch]
if (!function_exists('fnmatch')) {
	function fnmatch($pattern, $string) {
		return @preg_match(
			'/^' . strtr(addcslashes($pattern, '/\\.+^$(){}=!<>|'),
			array('*' => '.*', '?' => '.?')) . '$/i', $string
		);
	}
}
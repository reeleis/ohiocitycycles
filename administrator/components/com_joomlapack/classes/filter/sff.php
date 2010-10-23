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

class JoomlapackFilterSFF extends JoomlapackFilter {
	
	var $_filterClass = 'sff';
	
	/**
	 * Loads the file filters off the database and stores them in the _singleFileFilters array
	 *
	 */
	function init()
	{
		$this->_singleFileFilters = JoomlapackHelperFiltertable::getExclusionList($this->_filterClass);
	}
	
	/**
	 * Gets the contents of a directory and flags excluded files
	 *
	 * @param string $root The directory to scan
	 * @return array An associative array of associative arrays (use the code, Luke!)
	 */
	function getDirectory( $root )
	{
		// If there's no root directory specified, use the site's root
		$root = is_null($root) ? JPATH_SITE : $root ;
		
		$isSiteRoot = JoomlapackAbstraction::TranslateWinPath($root) == JoomlapackAbstraction::TranslateWinPath(JPATH_SITE);

		// Initialize filter list
		$this->init();
		
		// Initialize the two arrays to be returned
		$arDirs = array();
		$arFiles = array();
		
		// Get directory's contents
		jpimport('classes.engine.lister.default');
		$FS = new JoomlapackListerAbstraction();
		
		$allFilesAndDirs = $FS->getDirContents( $root );
		
		if (!($allFilesAndDirs === false)) {
			foreach($allFilesAndDirs as $fileName) {
				//$fileName = basename($fileName);
				if(is_dir($fileName))
				{
					$fileName = basename($fileName);
					if( $isSiteRoot && (($fileName == '.') || ($fileName == '..')) || ($fileName == '.') )
					{
						// Don't include . and .. for site's root, or . for all dirs							
					} else {
						if( $fileName != '.' ) {
							$arDirs[] = $fileName;	
						}						
					}	
				}
				elseif( is_file($fileName))
				{
					$fileName = basename($fileName);
					$excluded = is_array($this->_singleFileFilters) ? in_array( JoomlapackAbstraction::TranslateWinPath($root.DS.$fileName) , $this->_singleFileFilters) : false;
					$arFiles[$fileName] = $excluded; 
				}
			}
		}
		
		sort($arDirs);
		$ret['folders'] = $arDirs;
		unset($arDirs);
		$ret['files'] = $arFiles;
		unset($arFiles);
		return $ret;
	}
	
	/**
	 * Modifies a filter
	 *
	 * @param string $root Folder where the file exists
	 * @param string $file The file for which the filter is about
	 * @param mixed $checked If set to on, yes or checked then the filter is activated, otherwise deactivated
	 */
	function modifyFilter($root, $file, $checked)
	{
		$value = JoomlapackAbstraction::TranslateWinPath($root . "/" . $file);
		if(($checked == "on") || ($checked == "yes") || ($checked == "checked"))
		{
			// Enable the filter
			JoomlapackHelperFiltertable::addExclusionFilter($this->_filterClass, $value);
		}
		else
		{
			// Disable the filter
			JoomlapackHelperFiltertable::deleteExclusionFilter($this->_filterClass, $value);
		}
	}
}
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

class JoomlapackFilterDEF extends JoomlapackFilter {

	var $_filterClass = 'def';
	
	/**
	 * Implements the init method of JoomlapackFilter
	 *
	 */
	function init()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		$this->_folderFilters = JoomlapackHelperFiltertable::getExclusionList($this->_filterClass);

		// Add output, temporary and installation directory to exclusion filters
		$this->_folderFilters[] = JoomlapackAbstraction::TranslateWinPath($configuration->get('OutputDirectory'));
		$this->_folderFilters[] = JoomlapackAbstraction::TranslateWinPath($configuration->get('TempDirectory'));
		$this->_folderFilters[] = JoomlapackAbstraction::TranslateWinPath(JPATH_SITE.DS.'installation');
	}

	/**
	* Returns the contents of a directory and their exclusion status
	* @param $root string Start from this folder
	* @return array Directories and their status
	*/
	function getDirectory( $root ){
		// If there's no root directory specified, use the site's root
		$root = is_null($root) ? JPATH_SITE : $root ;

		// Initialize filter list
		$this->init();

		// Initialize directories array
		$arDirs = array();

		// Get subfolders
		jpimport('classes.engine.lister.default');
		$FS = new JoomlapackListerAbstraction();

		$allFilesAndDirs = $FS->getDirContents( $root );

		if (!($allFilesAndDirs === false)) {
			foreach($allFilesAndDirs as $fileName) {
				if (is_dir($fileName)) {
					$fileName = basename( $fileName );
					if ((JoomlapackAbstraction::TranslateWinPath($root) == JoomlapackAbstraction::TranslateWinPath(JPATH_SITE)) && ( ($fileName == ".") || ($fileName == "..") )) {
					} else {
						if ($this->_folderFilters == "") {
							$arDirs[$fileName] = false;
						} else {
							$arDirs[$fileName] = in_array(JoomlapackAbstraction::TranslateWinPath($root.DS.$fileName), $this->_folderFilters);
						}
					}
				} // if
			} // foreach
		} // if

		ksort($arDirs);
		return $arDirs;
	}

	/**
	 * Modifies a filter
	 *
	 * @param string $root Root folder where $dir is located
	 * @param string $dir The directory's name (relative path to $root)
	 * @param string $checked If it's "on", "yes" or "checked" the filter is activated, else deactivated 
	 */
	function modifyFilter($root, $dir, $checked){
		$value = JoomlapackAbstraction::TranslateWinPath($root . "/" . $dir); 
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
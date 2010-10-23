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

// Include the filter helper class
jpimport('helpers.filtertable');


/**
 * Represent a class which returns a filter, inclusion or exclusion, for
 * any domain required (be it directories, database or mixed)
 * @abstract
 */
class JoomlapackFilter extends JoomlapackObject
{
	/**
	 * A simple array of the folder names to exclude (absolute paths)
	 *
	 * @var array
	 * @access protected
	 */
	var $_folderFilters;
	
	/**
	 * A simple array of single files to be excluded (absolute paths)
	 * 
	 * @var array
	 * @access protected
	 */
	var $_singleFileFilters;
	
	/**
	 * A simple array of database table names to exclude
	 *
	 * @var array
	 * @access protected
	 */
	var $_databaseFilters;
	
	/**
	 * A simple array of folders to forcibly include in the backup (absolute paths)
	 *
	 * @var array
	 * @access protected
	 */
	var $_includeFolderFilters;

	/**
	 * Initializes the filters arrays, e.g. load settings of the database or a file
	 * @abstract
	 */
	function init()
	{
		
	}
	
	/**
	 * Gets the filters of the relevant category
	 *
	 * @param string $predicate It's "singlefile", "folder", "includefolder" or
	 * 				 "database", depending on the filter type you want to retreive
	 * @return array
	 * @final
	 */
	function getFilters( $predicate )
	{
		switch( $predicate )
		{
			case "singlefile": // Single File Filters
				return $this->_singleFileFilters;
				break;
			case "folder": // Directory Exclusion Filters
				return $this->_folderFilters;
				break;
			case "database": // Database Table Filters
				return $this->_databaseFilters;
				break;
			case "includefolder": // (reserved for future use)
				return $this->_includeFolderFilters;
				break;
			default:
				return array();
				break;
		}
	}
}
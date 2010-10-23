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


class JoomlapackFilterDBEF extends JoomlapackFilter
{
	var $_filterClass = 'dbef';
	
	/**
	 * Implements the abstract init method
	 *
	 */
	function init()
	{
		// Initialize with existing filters
		$this->_databaseFilters = JoomlapackHelperFiltertable::getExclusionList($this->_filterClass);
	}
	
	/**
	 * Modifies a table exclusion status
	 *
	 * @param string $table The table's abstract name, e.g. #__content for jos_content
	 * @param string $checked Set to TRUE, on or checked to enable filter. Anything else disables it.
	 * @return boolean Always true
	 */
	function modifyFilter( $table, $checked )
	{
		if( ($checked == 'on') || ($checked == 'checked') || ($checked === true) )
		{
			// Enable the filter
			JoomlapackHelperFiltertable::addExclusionFilter($this->_filterClass, $table);
		}
		else
		{
			// Disable the filter
			JoomlapackHelperFiltertable::deleteExclusionFilter($this->_filterClass, $table);
		}
		
		return true;
	}

	/**
	 * Removes all filters
	 */
	function ResetDBFilters()
	{
		JoomlapackHelperFiltertable::resetExclusionList($this->_filterClass);
	}
	
	/**
	 * Adds all non-Joomla tables to the exclusion filters
	 */
	function ExcludeNonJoomla()
	{
		// Get all tables
		$db = JoomlapackAbstraction::getDatabase();
		$sql = "SHOW TABLES";
		$db->setQuery($sql);
		$tables = $db->loadRowList();

		// Get prefix
		$prefix = JoomlapackAbstraction::getDBPrefix();
		
		// Loop tables
		foreach( $tables as $row )
		{
			$table = $row[0];
			$abstractTable = str_replace($prefix, '#__', $table);
			if( $table == $abstractTable )
			{
				// Filter only non-Joomla tables
				$this->modifyFilter($abstractTable, true);
			}
		}
	}

}
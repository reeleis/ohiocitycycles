<?php
/**
 * @version 0.9 $Id: eventlist_categories.php 507 2008-01-03 15:48:34Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');

/**
 * EventList categories Model class
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class eventlist_categories extends JTable
{
	/**
	 * Primary Key
	 * @var int
	 */
	var $id 				= null;
	/** @var int */
	var $parent_id			= 0;
	/** @var string */
	var $catname 			= '';
	/** @var string */
	var $alias	 			= '';
	/** @var string */
	var $catdescription 	= null;
	/** @var string */
	var $meta_description 	= null;
	/** @var string */
	var $meta_keywords		= null;
	/** @var string */
	var $image 				= '';
	/** @var int */
	var $published			= null;
	/** @var int */
	var $checked_out 		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	/** @var int */
	var $access 			= 0;
	/** @var int */
	var $groupid 			= 0;
	/** @var string */
	var $maintainers		= null;
	/** @var int */
	var $ordering 			= null;

	/**
	* @param database A database connector object
	*/
	function eventlist_categories(& $db) {
		parent::__construct('#__eventlist_categories', 'id', $db);
	}

	// overloaded check function
	function check()
	{
		// Not typed in a category name?
		if (trim( $this->catname ) == '') {
			$this->_error = JText::_( 'ADD NAME CATEGORY' );
			JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
			return false;
		}

		$alias = JFilterOutput::stringURLSafe($this->catname);

		if(empty($this->alias) || $this->alias === $alias ) {
			$this->alias = $alias;
		}

		/** check for existing name */
		$query = 'SELECT id FROM #__eventlist_categories WHERE catname = '.$this->_db->Quote($this->catname);
		$this->_db->setQuery($query);

		$xid = intval($this->_db->loadResult());
		if ($xid && $xid != intval($this->id)) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::sprintf('CATEGORY NAME ALREADY EXIST', $this->catname));
			return false;
		}

		return true;
	}
}
?>
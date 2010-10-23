<?php
/**
 * @version 0.9 $Id: eventlist_events.php 507 2008-01-03 15:48:34Z schlu $
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
 * EventList events Model class
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class eventlist_events extends JTable
{
	/**
	 * Primary Key
	 * @var int
	 */
	var $id 				= null;
	/** @var int */
	var $locid 				= null;
	/** @var int */
	var $catsid 			= null;
	/** @var date */
	var $dates 				= null;
	/** @var date */
	var $enddates 			= null;
	/** @var date */
	var $times 				= null;
	/** @var date */
	var $endtimes 			= null;
	/** @var string */
	var $title 				= '';
	/** @var string */
	var $alias	 			= '';
	/** @var int */
	var $created_by			= null;
	/** @var int */
	var $modified 			= 0;
	/** @var int */
	var $modified_by 		= null;
	/** @var string */
	var $datdescription 	= null;
	/** @var string */
	var $meta_description 	= null;
	/** @var string */
	var $meta_keywords		= null;
	/** @var int */
	var $recurrence_number	= 0;
	/** @var int */
	var $recurrence_type	= 0;
	/** @var date */
	var $recurrence_counter = null;
	/** @var string */
	var $datimage 			= '';
	/** @var string */
	var $author_ip 			= null;
	/** @var date */
	var $created	 		= null;
	/** @var int */
	var $published 			= null;
	/** @var int */
	var $registra 			= null;
	/** @var int */
	var $unregistra 		= null;
	/** @var int */
	var $checked_out 		= null;
	/** @var date */
	var $checked_out_time 	= 0;

	function eventlist_events(& $db) {
		parent::__construct('#__eventlist_events', 'id', $db);
	}

	// overloaded check function
	function check($elsettings)
	{
		// Check fields
		if (empty($this->enddates)) {
			$this->enddates = NULL;
		}

		if (empty($this->times)) {
			$this->times = NULL;
		}

		if (empty($this->endtimes)) {
			$this->endtimes = NULL;
		}

		$this->title = strip_tags(trim($this->title));
		$titlelength = JString::strlen($this->title);

		if ( $this->title == '' ) {
			$this->_error = JText::_( 'ADD TITLE' );
      		JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      		return false;
		}

		if ( $titlelength > 100 ) {
      		$this->_error = JText::_( 'ERROR TITLE LONG' );
      		JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      		return false;
		}

		$alias = JFilterOutput::stringURLSafe($this->title);

		if(empty($this->alias) || $this->alias === $alias ) {
			$this->alias = $alias;
		}

		if (!preg_match("/^[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]$/", $this->dates)) {
	      	$this->_error = JText::_( 'DATE WRONG' );
	      	JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
	      	return false;
		}

		if (isset($this->enddates)) {
			if (!preg_match("/^[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]$/", $this->enddates)) {
				$this->_error = JText::_( 'ENDDATE WRONG FORMAT');
				JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
				return false;
			}
		}

		if (isset($this->recurrence_counter)) {
			if (!preg_match("/^[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]$/", $this->recurrence_counter)) {
	 		     	$this->_error = JText::_( 'DATE WRONG' );
	 		     	JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
	 		     	return false;
			}
		}

		if (isset($this->times)) {
   			if (!preg_match("/^[0-2][0-9]:[0-5][0-9]$/", $this->times)) {
      			$this->_error = JText::_( 'TIME WRONG' );
      			JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      			return false;
	  		}
		}

		if (isset($this->endtimes)) {
   			if (!preg_match("/^[0-2][0-9]:[0-5][0-9]$/", $this->endtimes)) {
      			$this->_error = JText::_( 'TIME WRONG' );
      			JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      			return false;
	  		}
		}

		//No venue or category choosen?
		if($this->locid == '') {
			$this->_error = JText::_( 'VENUE EMPTY');
			JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
			return false;
		}

		if($this->catsid == 0) {
			$this->_error = JText::_( 'CATEGORY EMPTY');
			JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
			return false;
		}

		return true;
	}
}
?>
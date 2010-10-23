<?php
/**
 * @version 0.9 $Id: day.php 507 2008-01-03 15:48:34Z schlu $
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

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * EventList Component Day Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelDay extends JModel
{
	/**
	 * Events data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Events total
	 *
	 * @var integer
	 */
	var $_total = null;
	
	/**
	 * Date
	 *
	 * @var string
	 */
	var $_date = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe;

		// Get the paramaters of the active menu item
		$params 	= & $mainframe->getParams('com_eventlist');

		//get the number of events from database
		$limit       	= $mainframe->getUserStateFromRequest('com_eventlist.eventlist.limit', 'limit', $params->def('display_num', 0), 'int');
		$limitstart		= JRequest::getInt('limitstart');

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

		// Get the filter request variables
		$this->setState('filter_order', JRequest::getCmd('filter_order', 'a.dates'));
		$this->setState('filter_order_dir', JRequest::getCmd('filter_order_Dir', 'ASC'));
			
		$rawday = JRequest::getInt('id', 0, 'request');
		$this->setDate($rawday);
	}

	/**
	 * Method to set the date
	 *
	 * @access	public
	 * @param	string
	 */
	function setDate($date)
	{
		global $mainframe;

		// Get the paramaters of the active menu item
		$params 	= & $mainframe->getParams('com_eventlist');
		
		//0 means we have a direct request from a menuitem and without any parameters (eg: calendar module)
		if ($date == 0) {
			
			$dayoffset	= $params->get('days');
			$timestamp	= mktime(0, 0, 0, date("m"), date("d") + $dayoffset, date("Y"));
			$date		= strftime('%Y-%m-%d', $timestamp);
			
		//a valid date  has 8 characters
		} elseif (strlen($date) == 8) {
			
			$year 	= substr($date, 0, -4);
			$month	= substr($date, 4, -2);
			$tag	= substr($date, 6);
			
			//check if date is valid
			if (checkdate($month, $tag, $year)) {
				
				$date = $year.'-'.$month.'-'.$tag;
				
			} else {
				
				//date isn't valid raise notice and use current date
				$date = date('Ymd');
				JError::raiseNotice( 'SOME_ERROR_CODE', JText::_('INVALID DATE REQUESTED USING CURRENT') );
				
			}
			
		} else {
			//date isn't valid raise notice and use current date
			$date = date('Ymd');
			JError::raiseNotice( 'SOME_ERROR_CODE', JText::_('INVALID DATE REQUESTED USING CURRENT') );
			
		}

		$this->_date = $date;
	}

	/**
	 * Method to get the Events
	 *
	 * @access public
	 * @return array
	 */
	function &getData( )
	{
		$pop	= JRequest::getBool('pop');

		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();

			if ($pop) {
				$this->_data = $this->_getList( $query );
			} else {
				$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
			}
		}

		return $this->_data;
	}

	/**
	 * Total nr of events
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the total nr if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the events
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Build the query
	 *
	 * @access private
	 * @return string
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildEventListWhere();
		$orderby	= $this->_buildEventListOrderBy();

		//Get Events from Database
		$query = 'SELECT a.id, a.dates, a.enddates, a.times, a.endtimes, a.title, a.created, a.locid, a.datdescription,'
				. ' l.venue, l.city, l.state, l.url,'
				. ' c.catname, c.id AS catid,'
				. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug,'
				. ' CASE WHEN CHAR_LENGTH(l.alias) THEN CONCAT_WS(\':\', a.locid, l.alias) ELSE a.locid END as venueslug,'
				. ' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as categoryslug'
				. ' FROM #__eventlist_events AS a'
				. ' LEFT JOIN #__eventlist_venues AS l ON l.id = a.locid'
				. ' LEFT JOIN #__eventlist_categories AS c ON c.id = a.catsid'
				. $where
				. $orderby
				;

		return $query;
	}

	/**
	 * Build the order clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildEventListOrderBy()
	{
		$filter_order		= $this->getState('filter_order');
		$filter_order_dir	= $this->getState('filter_order_dir');

		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_dir.', a.dates, a.times';

		return $orderby;
	}

	/**
	 * Build the where clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildEventListWhere()
	{
		global $mainframe;

		$user		= & JFactory::getUser();
		$gid		= (int) $user->get('aid');
		$nulldate 	= '0000-00-00';

		// Get the paramaters of the active menu item
		$params 	= & $mainframe->getParams();

		// First thing we need to do is to select only published events
		$where = ' WHERE a.published = 1';

		// Second is to only select events assigned to category the user has access to
		$where .= ' AND c.access <= '.$gid;
		
		// Third is to only select events of the specified day
		//$where .= ' AND \''.$day.'\' = a.dates';
		$where .= ' AND DAYOFMONTH(\''.$this->_date.'\') BETWEEN DAYOFMONTH(a.dates) AND (IF (a.enddates >= DAYOFMONTH(now()), DAYOFMONTH(a.enddates), \''.$nulldate.'\')) OR \''.$this->_date.'\' = a.dates';

		/*
		 * If we have a filter, and this is enabled... lets tack the AND clause
		 * for the filter onto the WHERE clause of the content item query.
		 */
		if ($params->get('filter'))
		{
			$filter 		= JRequest::getString('filter', '', 'request');
			$filter_type 	= JRequest::getWord('filter_type', '', 'request');

			if ($filter)
			{
				// clean filter variables
				$filter			= $this->_db->getEscaped( trim(JString::strtolower( $filter ) ) );
				$filter_type 	= JString::strtolower($filter_type);

				switch ($filter_type)
				{
					case 'title' :
						$where .= ' AND LOWER( a.title ) LIKE "%'.$filter.'%"';
						break;

					case 'venue' :
						$where .= ' AND LOWER( l.venue ) LIKE "%'.$filter.'%"';
						break;

					case 'city' :
						$where .= ' AND LOWER( l.city ) LIKE "%'.$filter.'%"';
						break;
				}
			}
		}
		return $where;
	}
	
	/**
	 * Return date
	 *
	 * @access public
	 * @return string
	 */
	function getDay()
	{
		return $this->_date;
	}
}
?>
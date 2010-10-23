<?php
/**
 * @version 0.9 $Id: categoriesdetailed.php 507 2008-01-03 15:48:34Z schlu $
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
 * EventList Component Categoriesdetailed Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelCategoriesdetailed extends JModel
{
	/**
	 * Event data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Categories total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Categories data array
	 *
	 * @var integer
	 */
	var $_categories = null;

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
		$limit			= JRequest::getInt('limit', $params->get('cat_num'));
		$limitstart		= JRequest::getInt('limitstart');

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get the Categories
	 *
	 * @access public
	 * @return array
	 */
	function &getData( )
	{
		global $mainframe;

		$params 	= & $mainframe->getParams();
		$elsettings = ELHelper::config();

		// Lets load the content if it doesn't already exist
		if (empty($this->_categories))
		{
			$query = $this->_buildQuery();
			$this->_categories = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );

			$k = 0;
			$count = count($this->_categories);
			for($i = 0; $i < $count; $i++)
			{
				$category =& $this->_categories[$i];

				//Generate description
				if (empty ($category->catdescription)) {
					$category->catdescription = JText::_( 'NO DESCRIPTION' );
				} else {
					//execute plugins
					$category->text		= $category->catdescription;
					$category->title 	= $category->catname;
					JPluginHelper::importPlugin('content');
					$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$category, &$params, 0 ));
					$category->catdescription = $category->text;
				}

				if ($category->image != '') {

					$attribs['width'] = $elsettings->imagewidth;
					$attribs['height'] = $elsettings->imagehight;
					$attribs['border'] = 0;

					$category->image = JHTML::image('images/stories/'.$category->image, $category->catname, $attribs);
				} else {
					$category->image = JHTML::image('components/com_eventlist/assets/images/noimage.png', $category->catname);
				}

				//Get total of assigned events of each venue
				$category->assignedevents = $this->_assignedevents( $category->id );

				$k = 1 - $k;
			}

		}

		return $this->_categories;
	}

	/**
	 * Total nr of Categories
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
	 * Method to get the Categories events
	 *
	 * @access public
	 * @return array
	 */
	function &getEventdata( $id )
	{
		global $mainframe;

		$params 	= & $mainframe->getParams('com_eventlist');

		// Lets load the content
		$query = $this->_buildDataQuery( $id );
		$this->_data = $this->_getList( $query, 0, $params->get('detcat_nr') );

		return $this->_data;
	}

	/**
	 * Method get the event query
	 *
	 * @access private
	 * @return array
	 */
	function _buildDataQuery( $id )
	{
		$user		= & JFactory::getUser();
		$aid		= (int) $user->get('aid');
		$id			= (int) $id;

		//Get Events from Category
		$query = 'SELECT a.*, l.venue, l.city, l.state, l.url, c.catname, c.id AS catid,'
				. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug,'
				. ' CASE WHEN CHAR_LENGTH(l.alias) THEN CONCAT_WS(\':\', a.locid, l.alias) ELSE a.locid END as venueslug,'
				. ' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as categoryslug'
				. ' FROM #__eventlist_events AS a'
				. ' LEFT JOIN #__eventlist_venues AS l ON l.id = a.locid'
				. ' LEFT JOIN #__eventlist_categories AS c ON c.id = a.catsid'
				. ' WHERE a.published = 1 && a.catsid = '.$id
				. ' AND c.access <= '.$aid
				. ' ORDER BY a.dates, a.times'
				;

		return $query;
	}

	/**
	 * Method get the categories query
	 *
	 * @access private
	 * @return array
	 */
	function _buildQuery( )
	{
		global $mainframe;

		$user		= & JFactory::getUser();
		$gid 		= (int) $user->get('aid');

		// Get the paramaters of the active menu item
		$params 	= & $mainframe->getParams('com_eventlist');

		// show/hide empty categories
		$empty 	= null;
		$publ	= null;
		if (!$params->get('empty_cat'))
		{
			$empty 	= ' HAVING COUNT( a.id ) > 0';
			$publ	= ' AND a.published = 1';
		}

		//Get Categories
		$query = 'SELECT c.*,'
				. ' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as slug'
				. ' FROM #__eventlist_categories AS c'
				. ' LEFT JOIN #__eventlist_events AS a ON a.catsid = c.id'
				. ' WHERE c.published = 1'
				. ' AND c.access <= '.$gid
				. $publ
				. ' GROUP BY c.id '.$empty
				. ' ORDER BY c.ordering'
				;

		return $query;
	}

	/**
	 * Method to get the total number
	 *
	 * @access private
	 * @return integer
	 */
	function _assignedevents( $id )
	{
		$user		= & JFactory::getUser();
		$gid 		= (int) $user->get('aid');
		$id			= (int) $id;

		//Count Events
		$query = 'SELECT COUNT(a.id)'
				. ' FROM #__eventlist_events AS a'
				. ' LEFT JOIN #__eventlist_categories AS c ON c.id = a.catsid'
				. ' WHERE a.published = 1 && a.catsid = '.$id
				. ' AND c.access <= '.$gid
				;
		$this->_db->setQuery( $query );

		return $this->_db->loadResult();
	}
}
?>
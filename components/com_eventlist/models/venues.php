<?php
/**
 * @version 0.9 $Id: venuesview.php 396 2007-09-15 23:26:07Z schlu $
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
 * EventList Component Venues Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelVenues extends JModel
{
	/**
	 * Venues data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Venues total
	 *
	 * @var integer
	 */
	var $_total = null;

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
		$limit			= JRequest::getInt('limit', $params->get('display_venues_num'));
		$limitstart		= JRequest::getInt('limitstart');

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get the Venues
	 *
	 * @access public
	 * @return array
	 */
	function &getData( )
	{
		global $mainframe;

		$menu		=& JSite::getMenu();
		$item    	= $menu->getActive();
		$params		=& $menu->getParams($item->id);

		$elsettings 	=  ELHelper::config();

		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );

			$k = 0;
			for($i = 0; $i <  count($this->_data); $i++)
			{
				$venue =& $this->_data[$i];

				//Create image information
				$venue->limage = ELImage::flyercreator($venue->locimage, $elsettings);

				//Generate Venuedescription
				if (empty ($venue->locdescription)) {
					$venue->locdescription = JText::_( 'NO DESCRIPTION' );
				} else {
					//execute plugins
					$venue->text	= $venue->locdescription;
					$venue->title 	= $venue->venue;
					JPluginHelper::importPlugin('content');
					$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$venue, &$params, 0 ));
					$venue->locdescription = $venue->text;
				}

				//build the url
				if(!empty($venue->url) && strtolower(substr($venue->url, 0, 7)) != "http://") {
					$venue->url = 'http://'.$venue->url;
    		    }

				//prepare the url for output
				if (strlen(htmlspecialchars($venue->url, ENT_QUOTES)) > 35) {
					$venue->urlclean = substr( htmlspecialchars($venue->url, ENT_QUOTES), 0 , 35).'...';
				} else {
					$venue->urlclean = htmlspecialchars($venue->url, ENT_QUOTES);
				}

    		    //create flag
				if ($venue->country) {
					$venue->countryimg = ELOutput::getFlag( $venue->country );
				}

				//Get total of assigned events of each venue
				$venue->assignedevents = $this->_assignedevents( $venue->id );

			$k = 1 - $k;
			}

		}

		return $this->_data;
	}

	/**
	 * Total nr of Venues
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
		//get categories
		$query = 'SELECT *,'
				. ' CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(\':\', id, alias) ELSE id END as slug'
				. ' FROM #__eventlist_venues'
				. ' WHERE published = 1'
				. ' ORDER BY venue'
				;

		return $query;
	}

	/**
	 * Method to get the total number
	 *
	 * @access public
	 * @return integer
	 */
	function _assignedevents( $id )
	{
		$id 	= (int) $id;

		$query = 'SELECT COUNT(a.id)'
		. ' FROM #__eventlist_events AS a'
		. ' LEFT JOIN #__eventlist_venues AS v ON v.id = a.locid'
		. ' WHERE a.published = 1 && a.locid = '.$id
		;
		$this->_db->setQuery( $query );

		return $this->_db->loadResult();
	}
}
?>
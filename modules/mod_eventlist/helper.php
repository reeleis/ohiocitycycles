<?php
/**
 * @version 0.9 $Id: helper.php 524 2008-01-21 14:34:33Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENCE.php
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

class_exists('EventListHelperRoute') || require_once(JPATH_SITE.DS.'components'.DS.'com_eventlist'.DS.'helpers'.DS.'route.php');

/**
 * EventList Module helper
 *
 * @package Joomla
 * @subpackage EventList Module
 * @since		0.9
 */
class modEventListHelper
{

	/**
	 * Method to get the events
	 *
	 * @access public
	 * @return array
	 */
	function getList(&$params)
	{
		global $mainframe;

		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$user_gid	= (int) $user->get('aid');

		if ($params->get( 'type', '0' ) == 0) {
			$where = ' WHERE a.published = 1';
			$order = ' ORDER BY a.dates, a.times';
		} else {
			$where = ' WHERE a.published = -1';
			$order = ' ORDER BY a.dates DESC, a.times DESC';
		}

		$catid 	= trim( $params->get('catid') );
		$venid 	= trim( $params->get('venid') );

		if ($catid)
		{
			$ids = explode( ',', $catid );
			JArrayHelper::toInteger( $ids );
			$categories = ' AND (c.id=' . implode( ' OR c.id=', $ids ) . ')';
		}
		if ($venid)
		{
			$ids = explode( ',', $venid );
			JArrayHelper::toInteger( $ids );
			$venues = ' AND (l.id=' . implode( ' OR l.id=', $ids ) . ')';
		}

		//get $params->get( 'count', '2' ) nr of datasets
		$query = 'SELECT a.*, l.venue, l.city, l.url,'
				.' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug'
				.' FROM #__eventlist_events AS a'
				.' LEFT JOIN #__eventlist_venues AS l ON l.id = a.locid'
				.' LEFT JOIN #__eventlist_categories AS c ON c.id = a.catsid'
				. $where
				.' AND c.access <= '.$user_gid
				.($catid ? $categories : '')
				.($venid ? $venues : '')
				. $order
				.' LIMIT '.(int)$params->get( 'count', '2' )
				;

		$db->setQuery($query);
		$rows = $db->loadObjectList();

		$i		= 0;
		$lists	= array();
		foreach ( $rows as $row )
		{
			//cut titel
			$length = strlen(htmlspecialchars( $row->title ));

			if ($length > $params->get('cuttitle', '18')) {
				$row->titel = substr($row->title, 0, $params->get('cuttitle', '18'));
				$row->titel = htmlspecialchars( $row->title.'...');
			}

			$lists[$i]->link	= JRoute::_( EventListHelperRoute::getRoute($row->slug) );
			$lists[$i]->dateinfo = modEventListHelper::_builddateinfo($row->dates, $row->enddates, $row->times, $params);
			$lists[$i]->text	= $params->get('showtitloc', 0 ) ? $row->title : htmlspecialchars( $row->venue );
			$lists[$i]->city	= htmlspecialchars( $row->city );
			$lists[$i]->venueurl = !empty( $row->url ) ? modEventListHelper::_format_url($row->url) : null;
			$i++;
		}

		return $lists;
	}

	/**
	 * Method to a formated and structured string of date infos
	 *
	 * @access public
	 * @return string
	 */
	function _builddateinfo($date, $enddate, $time, &$params)
	{
		$date 		= modEventListHelper::_format_date($date, $params);
		$enddate 	= !empty($enddate) ? modEventListHelper::_format_date($enddate, $params) : null;
		$time		= !empty($time) ? modEventListHelper::_format_time($time, $params) : null;
		$dateinfo	= $date;

		if ( isset($enddate) ) {
			$dateinfo .= ' - '.$enddate;
		}

		if ( isset($time) ) {
			$dateinfo .= ' | '.$time;
		}

		return $dateinfo;
	}

	/**
	 * Method to get a valid url
	 *
	 * @access public
	 * @return string
	 */
	function _format_url($url)
	{
		if(!empty($url) && strtolower(substr($url, 0, 7)) != "http://") {
        	$url = 'http://'.$url;
        }
		return $url;
	}

	/**
	 * Method to format date information
	 *
	 * @access public
	 * @return string
	 */
	function _format_date($date, &$params)
	{
		//format date
		$date = strftime($params->get('formatdate', '%d.%m.%Y'), strtotime( $date ));

		return $date;
	}

	/**
	 * Method to format time information
	 *
	 * @access public
	 * @return string
	 */
	function _format_time($time, &$params)
	{
		$time = strftime( $params->get('formattime', '%H:%M'), strtotime( $time ));

		return $time;
	}
}

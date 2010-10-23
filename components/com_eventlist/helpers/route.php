<?php
/**
 * @version 0.9 $Id: route.php 507 2008-01-03 15:48:34Z schlu $
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

// Component Helper
jimport('joomla.application.component.helper');

/**
 * EventList Component Route Helper
 * based on Joomla ContentHelperRoute
 *
 * @static
 * @package		Joomla
 * @subpackage	EventList
 * @since 1.5
 */
class EventListHelperRoute
{
	/**
	 * Determines an EventList Link
	 *
	 * @param int The id of an EventList item
	 * @param string The view
	 * @since 0.9
	 *
	 * @return string determined Link
	 */
	function getRoute($id, $view = 'details')
	{
		//Not needed currently but kept because of a possible hierarchic link structure in future
		$needles = array(
			$view  => (int) $id
		);

		//Create the link
		$link = 'index.php?option=com_eventlist&view='.$view.'&id='. $id;

		if($item = EventListHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		};

		return $link;
	}

	/**
	 * Determines the Itemid
	 *
	 * searches if a menuitem for this item exists
	 * if not the first match will be returned
	 *
	 * @param array The id and view
	 * @since 0.9
	 *
	 * @return int Itemid
	 */
	function _findItem($needles)
	{
		$component =& JComponentHelper::getComponent('com_eventlist');

		$menus	= & JSite::getMenu();
		$items	= $menus->getItems('componentid', $component->id);
		$user 	= & JFactory::getUser();
		$access = (int)$user->get('aid');

		//Not needed currently but kept because of a possible hierarchic link structure in future
		foreach($needles as $needle => $id)
		{
			foreach($items as $item)
			{

				if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id) && ($item->published == 1) && ($item->access <= $access)) {
					return $item;
				}
			}

			//no menuitem exists -> return first possible match
			foreach($items as $item)
			{
				if ($item->published == 1 && $item->access <= $access) {
					return $item;
				}
			}

		}

		return false;
	}
}
?>
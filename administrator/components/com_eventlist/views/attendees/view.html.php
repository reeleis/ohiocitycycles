<?php
/**
 * @version 0.9 $Id: view.html.php 507 2008-01-03 15:48:34Z schlu $
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

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * View class for the EventList attendees screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewAttendees extends JView {

	function display($tpl = null)
	{
		global $mainframe, $option;

		if($this->getLayout() == 'print') {
			$this->_displayprint($tpl);
			return;
		}

		//initialise variables
		$db			= & JFactory::getDBO();
		$elsettings = ELAdmin::config();
		$document	= & JFactory::getDocument();
		$user		= & JFactory::getUser();

		//get vars
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.attendees.filter_order', 'filter_order', 'u.username', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.attendees.filter_order_Dir',	'filter_order_Dir',	'', 'word' );
		$filter 			= $mainframe->getUserStateFromRequest( $option.'.attendees.filter', 'filter', '', 'int' );
		$search 			= $mainframe->getUserStateFromRequest( $option.'.attendees.search', 'search', '', 'string' );
		$search 			= $db->getEscaped( trim(JString::strtolower( $search ) ) );

		//add css and submenu to document
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//Create Submenu
		JSubMenuHelper::addEntry( JText::_( 'EVENTLIST' ), 'index.php?option=com_eventlist');
		JSubMenuHelper::addEntry( JText::_( 'EVENTS' ), 'index.php?option=com_eventlist&view=events');
		JSubMenuHelper::addEntry( JText::_( 'VENUES' ), 'index.php?option=com_eventlist&view=venues');
		JSubMenuHelper::addEntry( JText::_( 'CATEGORIES' ), 'index.php?option=com_eventlist&view=categories');
		JSubMenuHelper::addEntry( JText::_( 'ARCHIVE' ), 'index.php?option=com_eventlist&view=archive');
		JSubMenuHelper::addEntry( JText::_( 'GROUPS' ), 'index.php?option=com_eventlist&view=groups');
		JSubMenuHelper::addEntry( JText::_( 'HELP' ), 'index.php?option=com_eventlist&view=help');
		if ($user->get('gid') > 24) {
			JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
		}

		//add toolbar
		JToolBarHelper::title( JText::_( 'REGISTERED USERS' ), 'users' );
		JToolBarHelper::deleteList();
		JToolBarHelper::spacer();
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.registereduser', true );

		// Get data from the model
		$rows      	= & $this->get( 'Data');
		$pageNav 	= & $this->get( 'Pagination' );
		$event 		= & $this->get( 'Event' );

		$event->dates = strftime($elsettings->formatdate, strtotime( $event->dates ));

		//build filter selectlist
		$filters = array();
		$filters[] = JHTML::_('select.option', '1', JText::_( 'NAME' ) );
		$filters[] = JHTML::_('select.option', '2', JText::_( 'USERNAME' ) );
		$lists['filter'] = JHTML::_('select.genericlist', $filters, 'filter', 'size="1" class="inputbox"', 'value', 'text', $filter );

		// search filter
		$lists['search'] = $search;

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order']		= $filter_order;

		//assign to template
		$this->assignRef('lists'      	, $lists);
		$this->assignRef('rows'      	, $rows);
		$this->assignRef('pageNav' 		, $pageNav);
		$this->assignRef('event'		, $event);

		parent::display($tpl);
	}

	/**
	 * Prepares the print screen
	 *
	 * @param $tpl
	 *
	 * @since 0.9
	 */
	function _displayprint($tpl = null)
	{
		$elsettings = ELAdmin::config();
		$document	= & JFactory::getDocument();
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		$rows      	= & $this->get( 'Data');
		$event 		= & $this->get( 'Event' );

		$event->dates = strftime($elsettings->formatdate, strtotime( $event->dates ));

		//assign data to template
		$this->assignRef('rows'      	, $rows);
		$this->assignRef('event'		, $event);

		parent::display($tpl);
	}
}
?>
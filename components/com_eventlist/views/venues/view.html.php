<?php
/**
 * @version 0.9 $Id: view.html.php 407 2007-09-21 16:03:39Z schlu $
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
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Venues View
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewVenues extends JView
{
	/**
	 * Creates the Venuesview
	 *
	 * @since 0.9
	 */
	function display( $tpl = null )
	{
		global $mainframe;

		$document 	= & JFactory::getDocument();
		$elsettings = ELHelper::config();

		//get menu information
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams();

		//cleanup events
		ELHelper::cleanevents( $elsettings->lastupdate );

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		// Request variables
		$limitstart		= JRequest::getInt('limitstart');
		$limit			= JRequest::getVar('limit', $params->get('display_num'), '', 'int');
		$pop			= JRequest::getBool('pop', 0, '', 'int');

		$rows 		= & $this->get('Data');
		$total 		= & $this->get('Total');

		//Add needed scripts if the lightbox effect is enabled
		if ($elsettings->lightbox == 1) {
  			JHTML::_('behavior.modal');
		}

		//add alternate feed link
		$link    = 'index.php?option=com_eventlist&view=venues&format=feed';
		$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
		$document->addHeadLink(JRoute::_($link.'&type=rss'), 'alternate', 'rel', $attribs);
		$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
		$document->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);

		$params->def( 'page_title', $item->name);

		//set Page title
		$document->setTitle( $params->get('page_title') );
		$document->setMetadata('keywords', $params->get('page_title') );

		//pathway
		$pathway 	= & $mainframe->getPathWay();
		$pathway->setItemName(1, $item->name);


		//Printfunction
		$params->def( 'print', !$mainframe->getCfg( 'hidePrint' ) );
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );

		if ($params->def('page_title', 1)) {
			$params->def('header', $item->name);
		}

		if ( $pop ) {
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_('index.php?view=venues&pop=1&tmpl=component');

		//Check if the user has access to the form
		$maintainer = ELUser::ismaintainer();
		$genaccess 	= ELUser::validate_user( $elsettings->evdelrec, $elsettings->delivereventsyes );

		if ($maintainer || $genaccess ) $dellink = 1;

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		$link = 'index.php?option=com_eventlist&view=venues';

		$this->assignRef('rows' , 					$rows);
		$this->assignRef('print_link' , 			$print_link);
		$this->assignRef('params' , 				$params);
		$this->assignRef('dellink' , 				$dellink);
		$this->assignRef('link' , 					$link);
		$this->assignRef('pageNav' , 				$pageNav);
		$this->assignRef('limit' , 					$limit);
		$this->assignRef('total' , 					$total);
		$this->assignRef('item' , 					$item);
		$this->assignRef('elsettings' , 			$elsettings);

		parent::display($tpl);
	}
}
?>
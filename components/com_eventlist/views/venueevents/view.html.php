<?php
/**
 * @version 0.9 $Id: view.html.php 521 2008-01-13 21:36:31Z schlu $
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
 * HTML View class for the Venueevents View
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewVenueevents extends JView
{
	/**
	 * Creates the Venueevents View
	 *
	 * @since 0.9
	 */
	function display( $tpl = null )
	{
		global $mainframe, $option;

		//initialize variables
		$document 	= & JFactory::getDocument();
		$menu		= & JSite::getMenu();
		$elsettings = ELHelper::config();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams('com_eventlist');

		//cleanup events
		ELHelper::cleanevents( $elsettings->lastupdate );

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		// Request variables
		$limitstart		= JRequest::getInt('limitstart');
		$limit       	= $mainframe->getUserStateFromRequest('com_eventlist.venueevents.limit', 'limit', $params->def('display_num', 0), 'int');
		$pop			= JRequest::getBool('pop');

		//get data from model
		$rows 		= & $this->get('Data');
		$venue	 	= & $this->get('Venue');
		$total 		= & $this->get('Total');

		//does the venue exist?
		if ($venue->id == 0)
		{
			return JError::raiseError( 404, JText::sprintf( 'Venue #%d not found', $venue->id ) );
		}

		//are events available?
		if (!$rows) {
			$noevents = 1;
		} else {
			$noevents = 0;
		}

		// Add needed scripts if the lightbox effect is enabled
		if ($elsettings->lightbox == 1) {
			JHTML::_('behavior.modal');
		}

		//Get image
		$limage = ELImage::flyercreator($venue->locimage, $elsettings);

		//add alternate feed link
		$link    = 'index.php?option=com_eventlist&view=venueevents&format=feed&id='.$venue->id;
		$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
		$document->addHeadLink(JRoute::_($link.'&type=rss'), 'alternate', 'rel', $attribs);
		$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
		$document->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);

		//set Page title
		$document->setTitle( $item->name.' - '.$venue->venue );
		$document->setMetadata('keywords', $venue->meta_keywords );
		$document->setDescription( strip_tags($venue->meta_description) );

		//pathway
		$pathway 	= & $mainframe->getPathWay();
		$pathway->setItemName(1, $item->name);
		$pathway->addItem( $venue->venue, JRoute::_('index.php?option='.$option.'&view=venueevents&id='.$venue->id));

		//Printfunction
		$params->def( 'print', !$mainframe->getCfg( 'hidePrint' ) );
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );

		if ( $pop ) {
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_('index.php?option=com_eventlist&view=venueevents&id='. $venue->id .'&pop=1&tmpl=component');

		//Check if the user has access to the form
		$maintainer = ELUser::ismaintainer();
		$genaccess 	= ELUser::validate_user( $elsettings->evdelrec, $elsettings->delivereventsyes );

		if ($maintainer || $genaccess ) $dellink = 1;

		//Generate Venuedescription
		if (empty ($venue->locdescription)) {
			$venuedescription = JText::_( 'NO DESCRIPTION' );
		} else {
			//execute plugins
			$venue->text	= $venue->locdescription;
			$venue->title 	= $venue->venue;
			JPluginHelper::importPlugin('content');
			$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$venue, &$params, 0 ));
			$venuedescription = $venue->text;
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

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		//create select lists
		$lists	= $this->_buildSortLists();
		$this->assign('lists'     , $lists);

		$this->assignRef('rows' , 					$rows);
		$this->assignRef('noevents' , 				$noevents);
		$this->assignRef('venue' , 					$venue);
		$this->assignRef('print_link' , 			$print_link);
		$this->assignRef('params' , 				$params);
		$this->assignRef('dellink' , 				$dellink);
		$this->assignRef('limage' , 				$limage);
		$this->assignRef('venuedescription' , 		$venuedescription);
		$this->assignRef('pageNav' , 				$pageNav);
		$this->assignRef('elsettings' , 			$elsettings);
		$this->assignRef('item' , 					$item);


		parent::display($tpl);
	}

	/**
	 * Manipulate Data
	 *
	 * @since 0.9
	 */
	function &getRows()
	{
		global $mainframe;

		$count = count($this->rows);

		if (!$count) {
			return;
		}

		$k = 0;
		for($i = 0; $i < $count; $i++)
		{
			//initialise
			$displaydate = null;
			$displaytime = null;

			$row =& $this->rows[$i];

			//Format date
			$date = strftime( $this->elsettings->formatdate, strtotime( $row->dates ));
			if (!$row->enddates) {
				$displaydate = $date;
			} else {
				$enddate 	= strftime( $this->elsettings->formatdate, strtotime( $row->enddates ));
				$displaydate = $date.' - '.$enddate;
			}

			//Format time
			if ($this->elsettings->showtime == 1) {
				if ($row->times) {
					$time = strftime( $this->elsettings->formattime, strtotime( $row->times ));
					$time = $time.' '.$this->elsettings->timename;
					$displaytime = '<br />'.$time;

				}
				if ($row->endtimes) {
					$endtime = strftime( $this->elsettings->formattime, strtotime( $row->endtimes ));
					$endtime = $endtime.' '.$this->elsettings->timename;
					$displaytime = '<br />'.$time.' - '.$endtime;

				}
			}

			if ($displaytime) {
				$row->displaytime = $displaytime;
			} else {
				$row->displaytime = '<br />-';
				$row->displaytime = '';
			}

			$row->displaydate = $displaydate;
			$row->odd   = $k;
			$k = 1 - $k;
		}

		return $this->rows;
	}

	function _buildSortLists()
	{
		// Table ordering values
		$filter_order		= JRequest::getCmd('filter_order', 'a.dates');
		$filter_order_Dir	= JRequest::getWord('filter_order_Dir', 'ASC');

		$filter				= JRequest::getString('filter');
		//$filter_type		= JRequest::getString('filter_type');

		$html= '';

		$lists['order_Dir'] 	= $filter_order_Dir;
		$lists['order'] 		= $filter_order;
		$lists['filter'] 		= $filter;
		$lists['filter_type'] 	= $html;

		return $lists;
	}
}
?>
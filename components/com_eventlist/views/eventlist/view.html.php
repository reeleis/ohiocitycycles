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
 * HTML View class for the EventList View
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEventList extends JView
{
	/**
	 * Creates the Simple List View
	 *
	 * @since 0.9
	 */
	function display( $tpl = null )
	{
		global $mainframe;

		//initialize variables
		$document 	= & JFactory::getDocument();
		$elsettings = ELHelper::config();
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams();

		//print_r($params);
		//$mainframe->close();

		//cleanup events
		ELHelper::cleanevents( $elsettings->lastupdate );

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		// get variables
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		$limit		= JRequest::getVar('limit', $params->get('display_num'), '', 'int');

		$pop			= JRequest::getBool('pop');
		$pathway 		= & $mainframe->getPathWay();

		//get data from model
		$rows 	= & $this->get('Data');
		$total 	= & $this->get('Total');

		//are events available?
		if (!$rows) {
			$noevents = 1;
		} else {
			$noevents = 0;
		}

		//params
		$params->def( 'page_title', $item->name);

		if ( $pop ) {//If printpopup set true
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_('index.php?view=eventlist&tmpl=component&pop=1');

		//pathway
		$pathway->setItemName( 1, $item->name );

		//Set Page title
		if (!$item->name) {
			$document->setTitle($params->get('page_title'));
			$document->setMetadata( 'keywords' , $params->get('page_title') );
		}

		//Check if the user has access to the form
		$maintainer = ELUser::ismaintainer();
		$genaccess 	= ELUser::validate_user( $elsettings->evdelrec, $elsettings->delivereventsyes );

		if ($maintainer || $genaccess ) $dellink = 1;

		//add alternate feed link
		$link    = 'index.php?option=com_eventlist&view=eventlist&format=feed';
		$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
		$document->addHeadLink(JRoute::_($link.'&type=rss'), 'alternate', 'rel', $attribs);
		$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
		$document->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		//create select lists
		$lists	= $this->_buildSortLists($elsettings);

		$this->assign('lists' , 					$lists);

		$this->assignRef('rows' , 					$rows);
		$this->assignRef('noevents' , 				$noevents);
		$this->assignRef('print_link' , 			$print_link);
		$this->assignRef('params' , 				$params);
		$this->assignRef('dellink' , 				$dellink);
		$this->assignRef('pageNav' , 				$pageNav);
		$this->assignRef('elsettings' , 			$elsettings);
		$this->assignRef('lists' , 					$lists);

		parent::display($tpl);

	}//function ListEvents end

	/**
	 * Manipulate Data
	 *
	 * @access public
	 * @return object $rows
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
				//$row->displaytime = '<br />-';
				$row->displaytime = '';
			}

			$row->displaydate = $displaydate;
			$row->odd   = $k;
			$k = 1 - $k;
		}

		return $this->rows;
	}

	/**
	 * Method to build the sortlists
	 *
	 * @access private
	 * @return array
	 * @since 0.9
	 */
	function _buildSortLists($elsettings)
	{
		$filter_order		= JRequest::getCmd('filter_order', 'a.dates');
		$filter_order_Dir	= JRequest::getWord('filter_order_Dir', 'ASC');

		$filter				= JRequest::getString('filter');
		$filter_type		= JRequest::getString('filter_type');

		$sortselects = array();
		$sortselects[]	= JHTML::_('select.option', 'title', $elsettings->titlename );
		$sortselects[] 	= JHTML::_('select.option', 'venue', $elsettings->locationname );
		$sortselects[] 	= JHTML::_('select.option', 'city', $elsettings->cityname );
		if ($elsettings->showcat) {
			$sortselects[] 	= JHTML::_('select.option', 'type', $elsettings->catfroname );
		}
		$sortselect 	= JHTML::_('select.genericlist', $sortselects, 'filter_type', 'size="1" class="inputbox"', 'value', 'text', $filter_type );

		$lists['order_Dir'] 	= $filter_order_Dir;
		$lists['order'] 		= $filter_order;
		$lists['filter'] 		= $filter;
		$lists['filter_type'] 	= $sortselect;

		return $lists;
	}
}
?>
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
 * HTML View class for the Categoriesdetailed View
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewCategoriesdetailed extends JView
{
	/**
	 * Creates the Categoriesdetailed View
	 *
	 * @since 0.9
	 */
	function display( $tpl = null )
	{
		global $mainframe;

		//initialise variables
		$document 	= & JFactory::getDocument();
		$elsettings = ELHelper::config();
		$model 		= $this->getModel();
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams();

		//get vars
		$limitstart		= JRequest::getInt('limitstart');
		$limit			= JRequest::getInt('limit', $params->get('cat_num'));
		$pathway 		= & $mainframe->getPathWay();
		$pop			= JRequest::getBool('pop');

		//Get data from the model
		$categories	= & $this->get('Data');
		$total 		= & $this->get('Total');

		//cleanup events
		ELHelper::cleanevents( $elsettings->lastupdate );

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		$params->def( 'page_title', $item->name);

		//pathway
		$pathway->setItemName(1, $item->name);

		//set Page title
		$mainframe->setPageTitle( $params->get('page_title') );
		$mainframe->addMetaTag( 'title' , $params->get('page_title') );
		$document->setMetadata( 'keywords' , $params->get('page_title') );

		//Print
		$params->def( 'print', !$mainframe->getCfg( 'hidePrint' ) );
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );

		if ( $pop ) {
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_( 'index.php?option=com_eventlist&view=categoriesdetailed&pop=1&tmpl=component' );

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

		$link = 'index.php?option=com_eventlist&Itemid='.$item->id.'&view=categoriesdetailed';

		$this->assignRef('categories' , 			$categories);
		$this->assignRef('print_link' , 			$print_link);
		$this->assignRef('params' , 				$params);
		$this->assignRef('dellink' , 				$dellink);
		$this->assignRef('item' , 					$item);
		$this->assignRef('model' , 					$model);
		$this->assignRef('pageNav' , 				$pageNav);
		$this->assignRef('link' , 					$link);
		$this->assignRef('elsettings' , 			$elsettings);

		parent::display($tpl);

	}//function end

	/**
	 * Manipulate Data
	 *
	 * @since 0.9
	 */
	function getRows()
	{
		global $mainframe;

		if (!count( $this->rows ) ) {
			return;
		}

		$k = 0;
		for($i = 0; $i <  count($this->rows); $i++)
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
}
?>
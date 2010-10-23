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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML Details View class of the EventList component
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewDetails extends JView
{
	/**
	 * Creates the output for the details view
	 *
 	 * @since 0.9
	 */
	function display($tpl = null)
	{
		global $mainframe;

		$document 	= & JFactory::getDocument();
		$user		= & JFactory::getUser();
		$elsettings = ELHelper::config();

		$row		= & $this->get('Details');
		$registers	= & $this->get('Registers');
		$regcheck	= & $this->get('Usercheck');

		//cleanup events
		ELHelper::cleanevents( $elsettings->lastupdate );

		//get menu information
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams('com_eventlist');

		//Check if the id exists
		if ($row->did == 0)
		{
			return JError::raiseError( 404, JText::sprintf( 'Event #%d not found', $row->did ) );
		}

		//Check if user has access to the details
		if ($elsettings->showdetails == 0) {
			return JError::raiseError( 403, JText::_( 'NO ACCESS' ) );
		}

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		//Print
		$pop	= JRequest::getBool('pop');

		$params->def( 'page_title', JText::_( 'DETAILS' ));

		if ( $pop ) {
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_('index.php?view=details&id='.$row->slug.'&pop=1&tmpl=component');

		//pathway
		$pathway 	= & $mainframe->getPathWay();
		$pathway->addItem( JText::_( 'DETAILS' ). ' - '.$row->title, JRoute::_('index.php?view=details&id='.$row->slug));

		//Get images
		$dimage = ELImage::flyercreator($row->datimage, $elsettings, 'event');
		$limage = ELImage::flyercreator($row->locimage, $elsettings);

		//Check user if he can edit
		$allowedtoeditevent = ELUser::editaccess($elsettings->eventowner, $row->created_by, $elsettings->eventeditrec, $elsettings->eventedit);
		$allowedtoeditvenue = ELUser::editaccess($elsettings->venueowner, $row->venueowner, $elsettings->venueeditrec, $elsettings->venueedit);

		//Generate Date
		$date 	= strftime( $elsettings->formatdate ,strtotime( $row->dates ));

		if ($row->times) {
			$time 	= strftime( $elsettings->formattime ,strtotime( $row->times ));
		}

		if (!$row->enddates) {
			$displaydate = $date.'<br />';
		} else {
			$enddate 	= strftime( $elsettings->formatdate, strtotime( $row->enddates ));
			$displaydate = $date.' - '.$enddate.'<br />';
		}

		//Generate Time
		if (( $elsettings->showtimedetails == 1 ) && ($row->times)) {
			$starttime = $time.' '.$elsettings->timename;

			if ($row->endtimes) {
				$endtime = strftime( $elsettings->formattime ,strtotime( $row->endtimes ));
				$endtime = ' - '.$endtime.' '.$elsettings->timename;
				$displaytime = $starttime.$endtime;
			} else {
				$displaytime = $starttime;
			}
		}

		//Timecheck for registration
		$jetzt = date("Y-m-d");
		$now = strtotime($jetzt);
		$date = strtotime($row->dates);
		$timecheck = $now - $date;

		//let's build the registration handling
		$formhandler  = 0;

		//is the user allready registered at the event
		if ( $regcheck ) {
			$formhandler = 3;
		} else {
			//no, he isn't
			$formhandler = 4;
		}

		//check if it is too late to register and overwrite $formhandler
		if ( $timecheck > 0 ) {
			$formhandler = 1;
		}

		//is the user registered at joomla and overwrite $formhandler if not
		if ( !$user->get('id') ) {
			$formhandler = 2;
		}

		//Generate Eventdescription
		if (($row->datdescription == '') || ($row->datdescription == '<br />')) {
			$eventdescription = JText::_( 'NO DESCRIPTION' ) ;
		} else {
			//Execute Plugins
			$row->text	= $row->datdescription;
			//$row->title = $row->title;
			JPluginHelper::importPlugin('content');
			$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$row, &$params, 0 ));
			$eventdescription = $row->text;
		}

		//Generate Venuedescription
		if (empty ($row->locdescription)) {
			$venuedescription = JText::_( 'NO DESCRIPTION' );
		} else {
			//execute plugins
			$row->text	=	$row->locdescription;
			//$row->title = $row->venue;
			JPluginHelper::importPlugin('content');
			$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$row, &$params, 0 ));
			$venuedescription = $row->text;
		}

		// generate Metatags
		$meta_keywords_content = "";
		if (!empty($row->meta_keywords)) {
			$keywords = explode(",",$row->meta_keywords);
			foreach($keywords as $keyword) {
				if ($meta_keywords_content != "") {
					$meta_keywords_content .= ", ";
				}
				if (ereg("[/[/]",$keyword)) {
					$keyword = trim(str_replace("[","",str_replace("]","",$keyword)));
					$meta_keywords_content .= $this->keyword_switcher($keyword, $row, $elsettings->formattime, $elsettings->formatdate);
				} else {
					$meta_keywords_content .= $keyword;
				}

			}
		}
		if (!empty($row->meta_description)) {
			$description = explode("[",$row->meta_description);
			$description_content = "";
			foreach($description as $desc) {
					$keyword = substr($desc, 0, strpos($desc,"]",0));
					if ($keyword != "") {
						$description_content .= $this->keyword_switcher($keyword, $row, $elsettings->formattime, $elsettings->formatdate);
						$description_content .= substr($desc, strpos($desc,"]",0)+1);
					} else {
						$description_content .= $desc;
					}

			}
		} else {
			$description_content = "";
		}

		//set page title and meta stuff
		$document->setTitle( $item->name.' - '.$row->title );
        $document->setMetadata('keywords', $meta_keywords_content );
        $document->setDescription( strip_tags($description_content) );

        //build the url
        if(!empty($row->url) && strtolower(substr($row->url, 0, 7)) != "http://") {
        	$row->url = 'http://'.$row->url;
        }

        //create flag
        if ($row->country) {
        	$row->countryimg = ELOutput::getFlag( $row->country );
        }

		//assign vars to jview
		$this->assignRef('row', 					$row);
		$this->assignRef('params' , 				$params);
		$this->assignRef('allowedtoeditevent' , 	$allowedtoeditevent);
		$this->assignRef('allowedtoeditvenue' , 	$allowedtoeditvenue);
		$this->assignRef('dimage' , 				$dimage);
		$this->assignRef('limage' , 				$limage);
		$this->assignRef('displaytime' , 			$displaytime);
		$this->assignRef('displaydate' , 			$displaydate);
		$this->assignRef('print_link' , 			$print_link);
		$this->assignRef('eventdescription' , 		$eventdescription);
		$this->assignRef('venuedescription' , 		$venuedescription);
		$this->assignRef('registers' , 				$registers);
		$this->assignRef('formhandler',				$formhandler);
		$this->assignRef('elsettings' , 			$elsettings);
		$this->assignRef('item' , 					$item);

		parent::display($tpl);
	}

	/**
	 * structures the keywords
	 *
 	 * @since 0.9
	 */
	function keyword_switcher($keyword, $row, $formattime, $formatdate) {
		switch ($keyword) {
			case "catsid":
				$content = $row->catname;
				break;
			case "a_name":
				$content = $row->venue;
				break;
			case "times":
			case "endtimes":
				if ($row->$keyword) {
					$content = strftime( $formattime ,strtotime( $row->$keyword ) );
				} else {
					$content = '';
				}
				break;
			case "dates":
			case "enddates":
				$content = strftime( $formatdate ,strtotime( $row->$keyword ) );
				break;
			default:
				$content = $row->$keyword;
				break;
		}
		return $content;
	}
}
?>
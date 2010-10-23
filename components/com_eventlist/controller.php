<?php
/**
 * @version 0.9 $Id: controller.php 517 2008-01-10 21:00:49Z schlu $
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

jimport('joomla.application.component.controller');

/**
 * EventList Component Controller
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListController extends JController
{
	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		//register extratasks
		$this->registerTask( 'ical', 		'vcal' );
	}

	/**
	 * Display the view
	 * 
	 * @since 0.9
	 */
	function display()
	{
		parent::display();
	}

	/**
	 * Logic for canceling an event edit task
	 * 
	 * @since 0.9
	 */
	function cancelevent()
	{
		$user	= & JFactory::getUser();

		$view	= JRequest::getWord( 'returnview' );
		$id		= JRequest::getInt( 'id');

		// Must be logged in
		if ($user->get('id') < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		if ($id) {
			// Create and load a events table
			$row =& JTable::getInstance('eventlist_events', '');

			$row->load($id);
			$row->checkin();

			$this->setRedirect( JRoute::_('index.php?view=details&id='.$id, false ) );

		} else {
			$this->setRedirect( JRoute::_('index.php?view='.$view, false ) );
		}
	}

	/**
	 * Logic for canceling an event and proceed to add a venue
	 * 
	 * @since 0.9
	 */
	function addvenue()
	{
		$user	= & JFactory::getUser();

		$view	= JRequest::getWord( 'returnview' );
		$id		= JRequest::getInt( 'id');

		// Must be logged in
		if ($user->get('id') < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		if ($id) {
			// Create and load a events table
			$row =& JTable::getInstance('eventlist_events', '');

			$row->load($id);
			$row->checkin();
		}

		$this->setRedirect( JRoute::_('index.php?view=editvenue&returnview='.$view, false ) );
	}

	/**
	 * Logic for canceling a venue edit task
	 *
	 * @since 0.9
	 */
	function cancelvenue()
	{
		$user	= & JFactory::getUser();

		$view	= JRequest::getWord( 'returnview' );
		$id		= JRequest::getInt( 'id' );

		// Must be logged in
		if ($user->get('id') < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		if ($id) {
			// Create and load a venues table
			$row =& JTable::getInstance('eventlist_venues', '');

			$row->load($id);
			$row->checkin();

			$this->setRedirect( JRoute::_('index.php?view=venueevents&id='.$id, false) );

		} else {
			$this->setRedirect( JRoute::_('index.php?view='.$view, false) );
		}
	}

	/**
	 * Saves the submitted venue to the database
	 *
	 * @since 0.5
	 */
	function savevenue()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		//Sanitize
		$post = JRequest::get( 'post' );
		$post['locdescription'] = JRequest::getVar( 'locdescription', '', 'post', 'string', JREQUEST_ALLOWRAW );

		$file 		= JRequest::getVar( 'userfile', '', 'files', 'array' );

		$model = $this->getModel('editvenue');

		if ($returnid = $model->store($post, $file)) {

			$msg 	= JText::_( 'VENUE SAVED' );
			$link 	= JRoute::_('index.php?view=venueevents&id='.$returnid, false) ;

			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();

		} else {

			$msg 		= '';
			$returnview	= JRequest::getVar('returnview', '', '', 'string');
			$link 		= JRoute::_('index.php?view='.$returnview, false) ;

			JError::raiseWarning('SOME_ERROR_CODE', $model->getError() );
		}

		$model->checkin();

		$this->setRedirect($link, $msg );
	}

	/**
	 * Cleanes and saves the submitted event to the database
	 *
	 * TODO: Check if the user is allowed to post events assigned to this category/venue
	 *
	 * @since 0.4
	 */
	function saveevent()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		//get image
		$file 		= JRequest::getVar( 'userfile', '', 'files', 'array' );
		$post 		= JRequest::get( 'post' );

		$model = $this->getModel('editevent');

		if ($returnid = $model->store($post, $file)) {

			$msg 	= JText::_( 'EVENT SAVED' );
			$link 	= JRoute::_('index.php?view=details&id='.$returnid, false) ;

			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();

		} else {

			$msg 		= '';
			$returnview	= JRequest::getVar('returnview', '', '', 'string');
			$link 		= JRoute::_('index.php?view='.$returnview, false) ;

			JError::raiseWarning('SOME_ERROR_CODE', $model->getError() );
		}

		$model->checkin();

		$this->setRedirect($link, $msg );
	}

	/**
	 * Saves the registration to the database
	 *
	 * @since 0.7
	 */
	function userregister()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		$id 	= JRequest::getInt( 'rdid', 0, 'post' );

		// Get the model
		$model = & $this->getModel('Details', 'EventListModel');

		$model->setId($id);
		$model->userregister();

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$msg = JText::_( 'REGISTERED SUCCESSFULL' );

		$this->setRedirect(JRoute::_('index.php?view=details&id='.$id, false), $msg );
	}

	/**
	 * Deletes a registered user
	 *
	 * @since 0.7
	 */
	function delreguser()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		$id 	= JRequest::getInt( 'rdid', 0, 'post' );

		// Get/Create the model
		$model = & $this->getModel('Details', 'EventListModel');

		$model->setId($id);
		$model->delreguser();

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$msg = JText::_( 'UNREGISTERED SUCCESSFULL' );
		$this->setRedirect( JRoute::_('index.php?view=details&id='.$id, false), $msg );
	}

	/**
	 * Display the select venue modal popup
	 *
	 * @since 0.9
	 */
	function selectvenue()
	{
		JRequest::setVar('view', 'editevent');
		JRequest::setVar('layout', 'selectvenue');

		parent::display();
	}

	/**
	 * offers the vcal/ical functonality
	 * 
	 * @todo Not yet working
	 *
	 * @author Lybegard Karl-Olof
	 * @since 0.9
	 */
	function vcal()
	{
		global $mainframe;

		$task 			= JRequest::getWord( 'task' );
		$id 			= JRequest::getInt( 'id' );
		$user_offset 	= $mainframe->getCfg( 'offset_user' );

		//get Data from model
		$model = & $this->getModel('Details', 'EventListModel');
		$model->setId((int)$id);

		$row = $model->getDetails();

		$Start = mktime(strftime('%H', strtotime($row->times)),
				strftime('%M', strtotime($row->times)),
				strftime('%S', strtotime($row->times)),
				strftime('%m', strtotime($row->dates)),
				strftime('%d', strtotime($row->dates)),
				strftime('%Y', strtotime($row->dates)),0);

		$End   = mktime(strftime('%H', strtotime($row->endtimes)),
				strftime('%M', strtotime($row->endtimes)),
				strftime('%S', strtotime($row->endtimes)),
				strftime('%m', strtotime($row->enddates)),
				strftime('%d', strtotime($row->enddates)),
				strftime('%Y', strtotime($row->enddates)),0);

		require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'vcal.class.php');

		$v = new vCal();

		$v->setTimeZone($user_offset);
		$v->setSummary($row->venue.'-'.$row->catname.'-'.$row->title);
		$v->setDescription($row->datdescription);
		$v->setStartDate($Start);
		$v->setEndDate($End);
		$v->setLocation($row->street.', '.$row->plz.', '.$row->city.', '.$row->country);
		$v->setFilename((int)$row->did);

		if ($task == 'vcal') {
			$v->generateHTMLvCal();
		} else {
			$v->generateHTMLiCal();
		}

	}
}
?>
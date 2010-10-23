<?php
/**
 * @version 0.9 $Id: editevent.php 507 2008-01-03 15:48:34Z schlu $
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
 * EventList Component Editevent Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelEditevent extends JModel
{
	/**
	 * Event data in Event array
	 *
	 * @var array
	 */
	var $_event = null;

	/**
	 * Category data in category array
	 *
	 * @var array
	 */
	var $_categories = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		$id = JRequest::getInt('id');
		$this->setId($id);
	}

	/**
	 * Method to set the event id
	 *
	 * @access	public Event
	 */
	function setId($id)
	{
		// Set new event ID
		$this->_id = $id;
	}

	/**
	 * logic to get the event
	 *
	 * @access public
	 * @since	0.9
	 * @return array
	 */
	function &getEvent(  )
	{
		global $mainframe;

		// Initialize variables
		$user		= & JFactory::getUser();
		$elsettings = ELHelper::config();

		$view		= JRequest::getWord('view');

		/*
		* If Id exists we will do the edit stuff
		*/
		if ($this->_id) {

			/*
			* Load the Event data
			*/
			$this->_loadEvent();

			/*
			* Error if allready checked out otherwise check event out
			*/
			if ($this->isCheckedOut( $user->get('id') )) {
				$mainframe->redirect( 'index.php?view='.$view, JText::_( 'THE EVENT' ).': '.$this->_event->title.' '.JText::_( 'EDITED BY ANOTHER ADMIN' ) );
			} else {
				$this->checkout( $user->get('id') );
			}

			/*
			* access check
			*/
			$owner = $this->getOwner();
			$editaccess	= ELUser::editaccess($elsettings->eventowner, $owner->created_by, $elsettings->eventeditrec, $elsettings->eventedit);			
			$maintainer = ELUser::ismaintainer();

			if ($maintainer || $editaccess ) $allowedtoeditevent = 1;

			if ($allowedtoeditevent == 0) {

				JError::raiseError( 403, JText::_( 'NO ACCESS' ) );

			}

			/*
			* If no Id exists we will do the add event stuff
			*/
		} else {

			//Check if the user has access to the form
			$maintainer = ELUser::ismaintainer();
			$genaccess 	= ELUser::validate_user( $elsettings->evdelrec, $elsettings->delivereventsyes );

			if ($maintainer || $genaccess ) $dellink = 1;

			if ($dellink == 0) {

				JError::raiseError( 403, JText::_( 'NO ACCESS' ) );

			}

			//prepare output
			$this->_event->id				= 0;
			$this->_event->locid			= '';
			$this->_event->catsid			= 0;
			$this->_event->dates			= '';
			$this->_event->enddates			= null;
			$this->_event->title			= '';
			$this->_event->times			= null;
			$this->_event->endtimes			= null;
			$this->_event->created			= null;
			$this->_event->author_ip		= null;
			$this->_event->created_by		= null;
			$this->_event->datdescription	= '';
			$this->_event->registra			= 0;
			$this->_event->unregistra		= 0;
			$this->_event->recurrence_number	= 0;
			$this->_event->recurrence_type		= 0;
			$this->_event->recurrence_counter	= '0000-00-00';
			$this->_event->sendername		= '';
			$this->_event->sendermail		= '';
			$this->_event->datimage			= '';
			$this->_event->venue			= JText::_('SELECTVENUE');

		}

		return $this->_event;

	}

	/**
	 * logic to get the event
	 *
	 * @access private
	 * @return array
	 */
	function _loadEvent(  )
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_event))
		{
			$query = 'SELECT e.*, v.venue'
					. ' FROM #__eventlist_events AS e'
					. ' LEFT JOIN #__eventlist_venues AS v ON v.id = e.locid'
					. ' WHERE e.id = '.(int)$this->_id
					;
			$this->_db->setQuery($query);
			$this->_event = $this->_db->loadObject();

			return (boolean) $this->_event;
		}
		return true;
	}

	/**
	 * logic to get the categories
	 *
	 * @access public
	 * @return array
	 */
	function getCategories( )
	{
		$user		= & JFactory::getUser();
		$elsettings = ELHelper::config();
		$userid		= (int) $user->get('id');
		$gid		= (int) $user->get('aid');
		$superuser	= ELUser::superuser();

		$where = ' WHERE c.published = 1 AND c.access <= '.$gid;

		//only check for maintainers if we don't have an edit action
		if(!$this->_id) {
			//get the ids of the categories the user maintaines
			$query = 'SELECT g.group_id'
					. ' FROM #__eventlist_groupmembers AS g'
					. ' WHERE g.member = '.$userid
					;
			$this->_db->setQuery( $query );
			$catids = $this->_db->loadResultArray();

			$categories = implode(' OR c.groupid = ', $catids);

			//build ids query
			if ($categories) {
				if (ELUser::validate_user($elsettings->evdelrec, $elsettings->delivereventsyes)) {
					$where .= ' AND c.groupid = 0 OR c.groupid = '.$categories;
				} else {
					$where .= ' AND c.groupid = '.$categories;
				}
			} else {
				$where .= ' AND c.groupid = 0';
			}

		}

		//administrators or superadministrators have access to all categories, also maintained ones
		if($superuser) {
			$where = ' WHERE c.published = 1';
		}

		//get the maintained categories and the categories whithout any group
		//or just get all if somebody have edit rights
		$query = 'SELECT c.id AS value, c.catname AS text, c.groupid'
				. ' FROM #__eventlist_categories AS c'
				. $where
				. ' ORDER BY c.ordering'
				;
		$this->_db->setQuery( $query );

		$this->_category = array();
		$this->_category[] = JHTML::_('select.option', '0', JText::_( 'SELECT CATEGORY' ) );
		$this->_categories = array_merge( $this->_category, $this->_db->loadObjectList() );

		return $this->_categories;
	}

	/**
	 * logic to get the owner
	 *
	 * @access public
	 * @return integer
	 */
	function getOwner( )
	{
		$query = 'SELECT a.created_by'
				. ' FROM #__eventlist_events AS a'
				. ' WHERE a.id = '.(int)$this->_id
				;
		$this->_db->setQuery( $query );

		return $this->_db->loadObject();
	}

	/**
	 * logic to get the venueslist
	 *
	 * @access public
	 * @return array
	 */
	function getVenues( )
	{
		$where		= $this->_buildVenuesWhere(  );
		$orderby	= $this->_buildVenuesOrderBy(  );

		$limit			= JRequest::getInt('limit');
		$limitstart		= JRequest::getInt('limitstart');

		$query = 'SELECT l.id, l.venue, l.city, l.country, l.published'
				.' FROM #__eventlist_venues AS l'
				. $where
				. $orderby
				;

		$this->_db->setQuery( $query, $limitstart, $limit );
		$rows = $this->_db->loadObjectList();

		return $rows;
	}

	/**
	 * Method to build the ordering
	 *
	 * @access private
	 * @return array
	 */
	function _buildVenuesOrderBy( )
	{

		$filter_order		= JRequest::getCmd('filter_order');
		$filter_order_Dir	= JRequest::getCmd('filter_order_Dir');

		$orderby = ' ORDER BY ';

		if ($filter_order && $filter_order_Dir)
		{
			$orderby .= $filter_order.' '.$filter_order_Dir.', ';
		}

		$orderby .= 'l.ordering';

		return $orderby;
	}

	/**
	 * Method to build the WHERE clause
	 *
	 * @access private
	 * @return array
	 */
	function _buildVenuesWhere(  )
	{

		$filter_type		= JRequest::getInt('filter_type');
		$filter 			= JRequest::getString('filter');
		$filter 			= $this->_db->getEscaped( trim(JString::strtolower( $filter ) ) );

		$where = array();

		if ($filter && $filter_type == 1) {
			$where[] = 'LOWER(l.venue) LIKE "%'.$filter.'%"';
		}

		if ($filter && $filter_type == 2) {
			$where[] = 'LOWER(l.city) LIKE "%'.$filter.'%"';
		}

		$where = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '');

		return $where;
	}

	/**
	 * Method to get the total number
	 *
	 * @access public
	 * @return integer
	 */
	function getCountitems ()
	{
		// Initialize variables
		$where		= $this->_buildVenuesWhere(  );

		$query = 'SELECT count(*)'
				. ' FROM #__eventlist_venues AS l'
				. $where
				;
		$this->_db->SetQuery($query);

  		return $this->_db->loadResult();
	}

	/**
	 * Method to checkin/unlock the item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkin()
	{
		if ($this->_id)
		{
			$item = & $this->getTable('eventlist_events', '');
			if(! $item->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}

		/**
	 * Method to checkout/lock the item
	 *
	 * @access	public
	 * @param	int	$uid	User ID of the user checking the item out
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			// Make sure we have a user id to checkout the article with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$item = & $this->getTable('eventlist_events', '');
			if(!$item->checkout($uid, $this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			return true;
		}
		return false;
	}

	/**
	 * Tests if the event is checked out
	 *
	 * @access	public
	 * @param	int	A user id
	 * @return	boolean	True if checked out
	 * @since	0.9
	 */
	function isCheckedOut( $uid=0 )
	{
		if ($this->_loadEvent())
		{
			if ($uid) {
				return ($this->_event->checked_out && $this->_event->checked_out != $uid);
			} else {
				return $this->_event->checked_out;
			}
		}
	}

	/**
	 * Method to store the event
	 *
	 * @access	public
	 * @return	id
	 * @since	0.9
	 */
	function store($data, $file)
	{
		global $mainframe;

		jimport('joomla.utilities.date');

		$user 		= & JFactory::getUser();
		$elsettings = ELHelper::config();

		//Get mailinformation
		$SiteName 		= $mainframe->getCfg('sitename');
		$MailFrom	 	= $mainframe->getCfg('mailfrom');
		$FromName 		= $mainframe->getCfg('fromname');
		$tzoffset 		= $mainframe->getCfg('offset');

		$row 	= & JTable::getInstance('eventlist_events', '');

		//Sanitize
		$data['datdescription'] = JRequest::getVar( 'datdescription', '', 'post','string', JREQUEST_ALLOWRAW );

		//include the metatags
		$data['meta_description'] = addslashes(htmlspecialchars(trim($elsettings->meta_description)));
		if (strlen($data['meta_description']) > 255) {
			$data['meta_description'] = substr($data['meta_description'],0,254);
		}
		$data['meta_keywords'] = addslashes(htmlspecialchars(trim($elsettings->meta_keywords)));
		if (strlen($data['meta_keywords']) > 200) {
			$data['meta_keywords'] = substr($data['meta_keywords'],0,199);
		}

		//bind it to the table
		if (!$row->bind($data)) {
			JError::raiseError( 500, $this->_db->stderr() );
			return false;
		}

		//Are we saving from an item edit?
		if ($row->id) {

			//check if user is allowed to edit events
			$owner = ELUser::isOwner($row->id, 'events');
			$editaccess	= & ELUser::editaccess($elsettings->eventowner, $owner, $elsettings->eventeditrec, $elsettings->eventedit);
			$maintainer = ELUser::ismaintainer();

			if ($maintainer || $editaccess ) $allowedtoeditevent = 1;

			if ($allowedtoeditevent == 0) {
				JError::raiseError( 403, JText::_( 'NO ACCESS' ) );
			}

			$date 				= new JDate($row->modified, $tzoffset);
			$row->modified 		= $date->toMySQL();
			$row->modified_by 	= $user->get('id');

			/*
			* Is editor the owner of the event
			* This extra Check is needed to make it possible
			* that the venue is published after an edit from an owner
			*/
			if ($elsettings->venueowner == 1 && $owner == $user->get('id')) {
				$owneredit = 1;
			} else {
				$owneredit = 0;
			}

		} else {

			//check if user is allowed to submit new events
			$maintainer = ELUser::ismaintainer();
			$genaccess 	= ELUser::validate_user( $elsettings->evdelrec, $elsettings->delivereventsyes );

			if ($maintainer || $genaccess ) $dellink = 1;

			if ($dellink == 0){
				JError::raiseError( 403, JText::_( 'NO ACCESS' ) );
			}

			//get IP, time and userid
			$date 				= new JDate($row->created, $tzoffset);
			$row->created 		= $date->toMySQL();

			$row->author_ip 	= $elsettings->storeip ? getenv('REMOTE_ADDR') : 'DISABLED';
			$row->created_by 	= $user->get('id');

			//Set owneredit to false
			$owneredit = 0;
		}

		/*
		* Autopublish
		* check if the user has the required rank for autopublish
		*/
		$autopubev = ELUser::validate_user( $elsettings->evpubrec, $elsettings->autopubl );
		if ($autopubev || $owneredit) {
				$row->published = 1 ;
			} else {
				$row->published = 0 ;
		}

		//Image upload

		//If image upload is required we will stop here if no file was attached
		if ( empty($file['name']) && $elsettings->imageenabled == 2 ) {

			$this->setError( JText::_( 'IMAGE EMPTY' ) );
			return false;
		}

		if ( ( $elsettings->imageenabled == 2 || $elsettings->imageenabled == 1 ) && ( !empty($file['name'])  ) )  {

			jimport('joomla.filesystem.file');

			$base_Dir 		= JPATH_SITE.'/images/eventlist/events/';

			//check the image
			$check = ELImage::check($file, $elsettings);

			if ($check === false) {
				$mainframe->redirect($_SERVER['HTTP_REFERER']);
			}

			//sanitize the image filename
			$filename = ELImage::sanitize($base_Dir, $file['name']);
			$filepath = $base_Dir . $filename;

			if (!JFile::upload($file['tmp_name'], $filepath)) {
				$this->setError( JText::_( 'UPLOAD FAILED' ) );
				return false;
			} else {
				$row->datimage = $filename;
			}
		} else {
			//keep image if edited and left blank
			$row->datimage = $row->curimage;
		}//end image if

		$editoruser = ELUser::editoruser();

		if (!$editoruser) {
			//check datdescription --> wipe out code
			$row->datdescription = strip_tags($row->datdescription, '<br />');

			//convert the linux \n (Mac \r, Win \r\n) to <br /> linebreaks
			$row->datdescription = str_replace(array("\r\n", "\r", "\n"), "<br />", $row->datdescription);

			// cut too long words
			$row->datdescription = wordwrap($row->datdescription, 75, ' ', 1);

			//check length
			$length = JString::strlen($row->datdescription);
			if ($length > $elsettings->datdesclimit) {
				//too long then shorten datdescription
				$row->datdescription = JString::substr($row->datdescription, 0, $elsettings->datdesclimit);
				//add ...
				$row->datdescription = $row->datdescription.'...';
			}
		}

		$row->title = trim( JFilterOutput::ampReplace( $row->title ) );

		//set registration regarding the el settings
		switch ($elsettings->showfroregistra) {
			case 0:
				$row->registra = 0;
			break;

			case 1:
				$row->registra = 1;
			break;

			case 2:
				$row->registra =  $row->registra ;
			break;
		}

		switch ($elsettings->showfrounregistra) {
			case 0:
				$row->unregistra = 0;
			break;

			case 1:
				$row->unregistra = 1;
			break;

			case 2:
				if ($elsettings->showfroregistra >= 1) {
					$row->unregistra = $row->unregistra;
				} else {
					$row->unregistra = 0;
				}
			break;
		}


		//Make sure the table is valid
		if (!$row->check($elsettings)) {
			$this->setError($row->getError());
			return false;
		}

		//is this an edited event or not?
		//after store we allways have an id
		$edited = $row->id ? $row->id : false;

		//store it in the db
		if (!$row->store(true)) {
			JError::raiseError( 500, $this->_db->stderr() );
			return false;
		}

		$this->_db->setQuery('SELECT * FROM #__eventlist_venues WHERE id = '.(int)$row->locid);
		$rowloc = $this->_db->loadObject();

		jimport('joomla.utilities.mail');

		$link 	= JURI::base().JRoute::_('index.php?view=details&id='.$row->id, false);

		//create the mail for the site owner
		if (($elsettings->mailinform == 1) || ($elsettings->mailinform == 3)) {

			$mail = JFactory::getMailer();

			$state 	= $row->published ? JText::sprintf('MAIL EVENT PUBLISHED', $link) : JText::_('MAIL EVENT UNPUBLISHED');

			if ($edited) {

				$modified_ip 	= getenv('REMOTE_ADDR');
				$edited 		= JHTML::Date( $row->modified, JText::_( 'DATE_FORMAT_LC2' ) );
				$mailbody 		= JText::sprintf('MAIL EDIT EVENT', $user->name, $user->username, $user->email, $modified_ip, $edited, $row->title, $row->dates, $row->times, $rowloc->venue, $rowloc->city, $row->datdescription, $state);
				$mail->setSubject( $SiteName.JText::_( 'EDIT EVENT MAIL' ) );

			} else {

				$created 	= JHTML::Date( $row->created, JText::_( 'DATE_FORMAT_LC2' ) );
				$mailbody 	= JText::sprintf('MAIL NEW EVENT', $user->name, $user->username, $user->email, $row->author_ip, $created, $row->title, $row->dates, $row->times, $rowloc->venue, $rowloc->city, $row->datdescription, $state);
				$mail->setSubject( $SiteName.JText::_( 'NEW EVENT MAIL' ) );

			}

			$receivers = explode( ',', trim($elsettings->mailinformrec));

			$mail->addRecipient( $receivers );
			$mail->setSender( array( $MailFrom, $FromName ) );
			$mail->setBody( $mailbody );

			$sent = $mail->Send();

		}//mail end

		//create the mail for the user
		if (($elsettings->mailinformuser == 1) || ($elsettings->mailinformuser == 3)) {

			$usermail = JFactory::getMailer();

			$state 	= $row->published ? JText::sprintf('USER MAIL EVENT PUBLISHED', $link) : JText::_('USER MAIL EVENT UNPUBLISHED');

			if ($edited) {

				$edited 		= JHTML::Date( $row->modified, JText::_( 'DATE_FORMAT_LC2' ) );
				$mailbody 		= JText::sprintf('USER MAIL EDIT EVENT', $user->name, $user->username, $edited, $row->title, $row->dates, $row->times, $rowloc->venue, $rowloc->city, $row->datdescription, $state);
				$usermail->setSubject( $SiteName.JText::_( 'EDIT USER EVENT MAIL' ) );

			} else {

				$created 	= JHTML::Date( $row->created, JText::_( 'DATE_FORMAT_LC2' ) );
				$mailbody 	= JText::sprintf('USER MAIL NEW EVENT', $user->name, $user->username, $created, $row->title, $row->dates, $row->times, $rowloc->venue, $rowloc->city, $row->datdescription, $state);
				$usermail->setSubject( $SiteName.JText::_( 'NEW USER EVENT MAIL' ) );

			}

			$usermail->addRecipient( $user->email );
			$usermail->setSender( array( $MailFrom, $FromName ) );
			$usermail->setBody( $mailbody );

			$sent = $usermail->Send();
		}

		return $row->id;
	}
}
?>
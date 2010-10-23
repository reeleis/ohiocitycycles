<?php
/**
 * @version 0.9 $Id: venue.php 507 2008-01-03 15:48:34Z schlu $
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
 * EventList Component Venue Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelVenue extends JModel
{
	/**
	 * venue id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * venue data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the identifier
	 *
	 * @access	public
	 * @param	int event identifier
	 */
	function setId($id)
	{
		// Set venue id and wipe data
		$this->_id	    = $id;
		$this->_data	= null;
	}

	/**
	 * Logic for the event edit screen
	 *
	 * @access public
	 * @return array
	 * @since 0.9
	 */
	function &getData()
	{
		if ($this->_loadData())
		{

		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to load content event data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = 'SELECT *'
					. ' FROM #__eventlist_venues'
					. ' WHERE id = '.$this->_id
					;

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the venue data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$venue = new stdClass();
			$venue->id					= 0;
			$venue->venue				= null;
			$venue->alias				= null;
			$venue->url					= null;
			$venue->street				= null;
			$venue->city				= null;
			$venue->plz					= null;
			$venue->state				= null;
			$venue->country				= null;
			$venue->locimage			= JText::_('SELECTIMAGE');
			$venue->map					= 1;
			$venue->published			= 1;
			$venue->locdescription		= null;
			$venue->meta_keywords		= null;
			$venue->meta_description	= null;
			$venue->created				= null;
			$venue->author_ip			= null;
			$venue->created_by			= null;
			$this->_data				= $venue;
			return (boolean) $this->_data;
		}
		return true;
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
			$venue = & JTable::getInstance('eventlist_venues', '');
			return $venue->checkin($this->_id);
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
			// Make sure we have a user id to checkout the venue with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$venue = & JTable::getInstance('eventlist_venues', '');
			return $venue->checkout($uid, $this->_id);
		}
		return false;
	}

	/**
	 * Tests if the venue is checked out
	 *
	 * @access	public
	 * @param	int	A user id
	 * @return	boolean	True if checked out
	 * @since	0.9
	 */
	function isCheckedOut( $uid=0 )
	{
		if ($this->_loadData())
		{
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		} elseif ($this->_id < 1) {
			return false;
		} else {
			JError::raiseWarning( 0, 'Unable to Load Data');
			return false;
		}
	}

	/**
	 * Method to store the venue
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$elsettings = ELAdmin::config();
		$user		= & JFactory::getUser();
		$config 	= & JFactory::getConfig();

		$tzoffset 	= $config->getValue('config.offset');

		jimport('joomla.utilities.date');

		$row  =& $this->getTable('eventlist_venues', '');

		// bind it to the table
		if (!$row->bind($data)) {
			JError::raiseError(500, $this->_db->getErrorMsg() );
			return false;
		}

		// Check if image was selected
		jimport('joomla.filesystem.file');
		$format 	= JFile::getExt(JPATH_SITE.'/images/eventlist/venues/'.$row->locimage);

		$allowable 	= array ('gif', 'jpg', 'png');
		if (in_array($format, $allowable)) {
			$row->locimage = $row->locimage;
		} else {
			$row->locimage = '';
		}

		// sanitise id field
		$row->id = (int) $row->id;

		$nullDate	= $this->_db->getNullDate();

		// Are we saving from an item edit?
		if ($row->id) {
			$date 				= new JDate($row->modified, $tzoffset);
			$row->modified 		= $date->toMySQL();
			$row->modified_by 	= $user->get('id');
		} else {
			$row->modified 		= $nullDate;
			$row->modified_by 	= '';

			//get IP, time and userid
			$date 					= new JDate($row->created, $tzoffset);
			$row->created 			= $date->toMySQL();

			$row->author_ip 		= $elsettings->storeip ? getenv('REMOTE_ADDR') : 'DISABLED';
			$row->created_by		= $user->get('id');
		}

		//uppercase needed by mapservices
		if ($row->country) {
			$row->country = JString::strtoupper($row->country);
		}

		//update item order
		if (!$row->id) {
			$row->ordering = $row->getNextOrder();
		}

		// Make sure the data is valid
		if (!$row->check($elsettings)) {
			$this->setError($row->getError());
			return false;
		}

		// Store it in the db
		if (!$row->store()) {
			JError::raiseError(500, $this->_db->getErrorMsg() );
			return false;
		}

		return $row->id;
	}
}
?>
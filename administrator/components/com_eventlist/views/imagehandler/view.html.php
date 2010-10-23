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
 * View class for the EventList imageselect screen
 * Based on the Joomla! media component
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewImagehandler extends JView  {

	/**
	 * Image selection List
	 *
	 * @since 0.9
	 */
	function display($tpl = null)
	{
		$document =& JFactory::getDocument();

		if($this->getLayout() == 'uploadimage') {
			$this->_displayuploadimage($tpl);
			return;
		}

		//get vars
		$task = JRequest::getVar( 'task' );

		//set variables
		if ($task == 'selecteventimg') {
			$folder = 'events';
			$task 	= 'eventimg';
		} else {
			$folder	= 'venues';
			$task	= 'venueimg';
		}
		JRequest::setVar( 'folder', $folder );

		// Do not allow cache
		JResponse::allowCache(false);

		//add css
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//get images
		$images = $this->get('images');

		if (count($images) > 0 ) {
			$this->assignRef('images', $images);
			$this->assignRef('folder', $folder);
			$this->assignRef('state', $this->get('state'));
			parent::display($tpl);
		} else {
			//no images in the folder, redirect to uploadscreen and raise notice
			JError::raiseNotice('SOME_ERROR_CODE', JText::_('NO IMAGES AVAILABLE'));
			$this->setLayout('uploadimage');
			JRequest::setVar( 'task', $task );
			$this->_displayuploadimage($tpl);
			return;
		}
	}

	function setImage($index = 0)
	{
		if (isset($this->images[$index])) {
			$this->_tmp_img = &$this->images[$index];
		} else {
			$this->_tmp_img = new JObject;
		}
	}

	/**
	 * Prepares the upload image screen
	 *
	 * @param $tpl
	 *
	 * @since 0.9
	 */
	function _displayuploadimage($tpl = null)
	{
		//initialise variables
		$document	= & JFactory::getDocument();
		$uri 		= & JFactory::getURI();
		$elsettings = ELAdmin::config();

		//get vars
		$task 		= JRequest::getVar( 'task' );

		//add css
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');
		
		jimport('joomla.client.helper');
		$ftp =& JClientHelper::setCredentialsFromRequest('ftp');

		//assign data to template
		$this->assignRef('task'      	, $task);
		$this->assignRef('elsettings'  	, $elsettings);
		$this->assignRef('request_url'	, $uri->toString());
		$this->assignRef('ftp'			, $ftp);

		parent::display($tpl);
	}
}
?>
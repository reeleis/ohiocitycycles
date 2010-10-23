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
 * View class for the EventList CSS edit screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEditcss extends JView {

	function display($tpl = null) {

		global $mainframe;

		//initialise variables
		$document	= & JFactory::getDocument();
		$user 		= & JFactory::getUser();
		
		//only admins have access to this view
		if ($user->get('gid') < 24) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'ALERTNOTAUTH'));
			$mainframe->redirect( 'index.php?option=com_eventlist&view=eventlist' );
		}

		//get vars
		$option		= JRequest::getVar('option');
		$filename	= 'eventlist.css';
		$path		= JPATH_SITE.DS.'components'.DS.'com_eventlist'.DS.'assets'.DS.'css';
		$css_path	= $path.DS.$filename;

		//create the toolbar
		JToolBarHelper::title( JText::_( 'EDIT CSS' ), 'cssedit' );
		JToolBarHelper::apply( 'applycss' );
		JToolBarHelper::spacer();
		JToolBarHelper::save( 'savecss' );
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.editcss', true );
		
		JRequest::setVar( 'hidemainmenu', 1 );

		//add css to document
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//read the the stylesheet
		jimport('joomla.filesystem.file');
		$content = JFile::read($css_path);
		
		jimport('joomla.client.helper');
		$ftp =& JClientHelper::setCredentialsFromRequest('ftp');

		if ($content !== false)
		{
			$content = htmlspecialchars($content, ENT_COMPAT, 'UTF-8');
		}
		else
		{
			$msg = JText::sprintf('FAILED TO OPEN FILE FOR WRITING', $css_path);
			$mainframe->redirect('index.php?option='.$option, $msg);
		}

		//assign data to template
		$this->assignRef('css_path'		, $css_path);
		$this->assignRef('content'		, $content);
		$this->assignRef('filename'		, $filename);
		$this->assignRef('ftp'			, $ftp);
		

		parent::display($tpl);
	}
}
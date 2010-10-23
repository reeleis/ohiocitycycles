<?php
/**
 * @version 0.9 $Id: eventlist.php 507 2008-01-03 15:48:34Z schlu $
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

//Require helperfile
require_once (JPATH_COMPONENT_SITE.DS.'helpers'.DS.'helper.php');
require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'user.class.php');
require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'image.class.php');
require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'output.class.php');

// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

//pull the setings data out of database and put it in the session
$session =& JFactory::getSession();
if (!$session->has('elsettings')) {
	$elsettings = ELHelper::elconfig();
	$session->set('elsettings', $elsettings);
}

// Require the controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Create the controller
$classname  = 'EventListController';
$controller = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getVar('task', null, 'default', 'cmd') );

// Redirect if set by the controller
$controller->redirect();
?>
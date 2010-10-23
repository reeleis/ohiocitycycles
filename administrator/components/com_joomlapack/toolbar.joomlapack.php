<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		$Id$
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @since		1.2.1
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

// handle the task
$act = JoomlapackAbstraction::getParam('act', '');
$task = JoomlapackAbstraction::getParam('task','');

switch ($act){
	case "config":
		switch( $task ) {
			case "save":
				break;
			case "apply":
				TOOLBAR_jpack::_CONFIG();
				break;
			case "":
				TOOLBAR_jpack::_CONFIG();
				break;
			default:
				break;
		}
		break;
		
	case "multidb":
		switch( $task ) {
			case 'edit':
			case 'new':
				TOOLBAR_jpack::MULTI_EDIT();
				break;
			case 'save':
			case 'view':
			default:
				TOOLBAR_jpack::MULTI_VIEW();
				break;
		}
		break;
		
	default:
		break;
}
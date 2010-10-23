<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		1.1.1b2
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* 
**/

/**
 * Frontend part
 */

(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

// 1.1.1b2 - Use constants with absolute paths
global $option;
if( !defined('_JEXEC') )
{
	$option	= mosGetParam( $_REQUEST, 'option',	'com_jpack' );
	if ( array_key_exists('mosConfig_asbolute_path', $_REQUEST ) )
	{
		die('Hacking attempt');
	} else {
		global $mosConfig_absolute_path;
		$myBase = $mosConfig_absolute_path;
	}
} else {
	$option	= JRequest::getCmd('option','com_joomlapack');
	$myBase = JPATH_SITE;
}

if (DIRECTORY_SEPARATOR == '\\'){
	// Change potential windows directory separator
	if ((strpos($myBase, '\\') > 0) || (substr($myBase, 0, 1) == '\\')){
		$myBase = strtr($myBase, '\\', '/');
	}
}

// 1.2.1 - Emulate Joomla! 1.5.x JPATH defines for absolute filenames
if( !defined('_JEXEC') ) {
	$myBase = (realpath($myBase) == '') ? $myBase : realpath($myBase); // 1.2a3 -- Rare case when $myBase == '/'
	define( 'DS', DIRECTORY_SEPARATOR );
	define( 'JPATH_SITE', realpath( $myBase ) );
	define( 'JPATH_COMPONENT_ADMINISTRATOR', $myBase.DS.'administrator'.DS.'components'.DS.$option );
	define( 'JPATH_COMPONENT', $myBase.DS.'components'.DS.$option );		
}

// Include Joomla! Version Abstraction Layer
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'frameworkabstraction.php' );

// Include abstract classes definitions
jpimport('classes.abstract.object');
jpimport('classes.abstract.filter');
jpimport('classes.abstract.enginearchiver');
jpimport('classes.abstract.engineparts');

// Always populate basic Joomla! page parameters and make them global
global $act, $task;

// Get the parameters from the request
$act	= JoomlapackAbstraction::getParam('act',	'default');
$task	= JoomlapackAbstraction::getParam('task',	'');

// Load language definitions
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'lang.php' );

switch( $act )
{
	case "fullbackup":
		require_once( JPATH_COMPONENT . '/includes/CFullBackup.php' );
		$tickableObject =& CFullBackup::getInstance();
		$tickableObject->tick();
		break;
		
	default:
		echo JoomlapackLangManager::_('FRONTEND_ACCESSDENIED');
		break;
}
?>
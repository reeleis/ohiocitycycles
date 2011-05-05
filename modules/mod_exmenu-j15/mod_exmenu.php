<?php
/**
* @version $Id:$
* @author Daniel Ecer
* @package exmenu
* @copyright (C) 2005-2009 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Notice: some parts are based on the default mainmenu module.
* Beside this it were havily redesigned to separate module from view.
*/

if ((!defined('_VALID_MOS')) && (!defined('_JEXEC'))) {
	if (isset($_POST['url'])) {
		// redirect to url (used for select list)
		$url	= $_POST['url'];
		if (get_magic_quotes_gpc()) {
			$url = stripslashes($url);
		}

		if ($url != '') {
			if (headers_sent()) {
				echo '<script>document.location.href=\''.$url.'\';</script>'."\n";
			} else {
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: '.$url);
			}
			exit();
		}
	}

	/** ensure this file is being included by a parent file */
	die('Restricted access.');
}

// requested module allows to include other modules without immediately displaying them
if (!isset($requestedModule)) {
	$requestedModule	= 'exmenu';
}

if (!defined( '_EXTENDED_MENU_INCLUDED_' )) {
	/** ensure that functions are declared only once */
	define( '_EXTENDED_MENU_INCLUDED_', 1 );

	if (!defined('EXTENDED_MENU_HOME')) {
		define('EXTENDED_MENU_HOME', dirname(__FILE__).'/exmenu');
	}
	require_once(constant('EXTENDED_MENU_HOME').'/exmenu.class.php');
}

if ((isset($params)) && ($requestedModule == 'exmenu')) {
	if ((isset($module)) && (is_object($module)) && (isset($module->title))) {
		$params->def('title', $module->title);
	}
	ExtendedMenuModule::showModule($params);
}

?>
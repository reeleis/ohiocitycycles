<?php
/**
* @version $Id:$
* @author Daniel Ecer
* @package exmenu
* @copyright (C) 2005-2009 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
if (!defined('EXTENDED_MENU_HOME')) {
	die('Restricted access');
}

/**
 * @since 1.0.0
 */
class ExtendedMenuLoaderFactory {
	
	function &getNewMenuLoader($type) {
		require_once(EXTENDED_MENU_HOME.'/util/databasehelper.class.php');
		require_once(EXTENDED_MENU_HOME.'/loader/menucache.class.php');
		require_once(EXTENDED_MENU_HOME.'/loader/menuloader.class.php');
		switch($type) {
			case 'section':
				require_once(EXTENDED_MENU_HOME.'/loader/section.menuloader.class.php');
				$menuLoader						=& new SectionExtendedMenuLoader();
				break;
			case 'category':
				require_once(EXTENDED_MENU_HOME.'/loader/category.menuloader.class.php');
				$menuLoader						=& new CategoryExtendedMenuLoader();
				break;
			case 'content_item':
				require_once(EXTENDED_MENU_HOME.'/loader/contentitem.menuloader.class.php');
				$menuLoader						=& new ContentItemExtendedMenuLoader();
				break;
			case 'menu_auto_expanded':
				require_once(EXTENDED_MENU_HOME.'/loader/autoexpandedmenu.menuloader.class.php');
				$menuLoader						=& new AutoExpandedExtendedMenuLoader();
				break;
			case 'plugin':
				require_once(EXTENDED_MENU_HOME.'/loader/plugin.menuloader.class.php');
				$menuLoader						=& new PluginExtendedMenuLoader();
				break;
			default:
				require_once(EXTENDED_MENU_HOME.'/loader/menu.menuloader.class.php');
				$menuLoader						=& new ExtendedMenuLoader();
		}
		return $menuLoader;
	}
}

?>
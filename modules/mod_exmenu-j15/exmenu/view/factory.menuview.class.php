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

require_once(EXTENDED_MENU_HOME.'/view/menuview.class.php');

/**
 * @since 1.0.0
 */
class ExtendedMenuViewFactory {

	function &getNewMenuView($type) {
		$maxDepth = FALSE;
		switch ($type) {
			case 'patTemplate':
				// not choosen directly by the user
				include_once(constant('EXTENDED_MENU_HOME').'/view/pattemplate.menuview.class.php');
				$view					=& new PatTemplateExtendedMenuView();
				break;
			case 'list_flat':
				$maxDepth				= 0;
			case 'list_tree':
				include_once(constant('EXTENDED_MENU_HOME').'/view/list.menuview.class.php');
				$view					=& new ListExtendedMenuView();
				break;
			case 'horiz_flat':
				include_once(constant('EXTENDED_MENU_HOME').'/view/horizontal.menuview.class.php');
				$view					=& new HorizontalExtendedMenuView();
				$maxDepth				= 0;
				break;
			case 'html_tree':
				include_once(constant('EXTENDED_MENU_HOME').'/view/htmltree.menuview.class.php');
				$view					=& new HtmlTreeExtendedMenuView();
				break;
			case 'css_tree':
				include_once(constant('EXTENDED_MENU_HOME').'/view/csstree.menuview.class.php');
				$view					=& new CssTreeExtendedMenuView();
				break;
			case 'select_tree':
				include_once(constant('EXTENDED_MENU_HOME').'/view/selectlist.menuview.class.php');
				$view					=& new SelectListExtendedMenuView();
				break;
			case 'plugin':
				include_once(constant('EXTENDED_MENU_HOME').'/view/plugin.menuview.class.php');
				$view					=& new PluginExtendedMenuView();
				break;
			default:
				include_once(constant('EXTENDED_MENU_HOME').'/view/verticaltable.menuview.class.php');
				$view					=& new VerticalTableExtendedMenuView();
				break;
		}
		if ($maxDepth !== FALSE) {
			$view->maxDepth = $maxDepth;
		}
		return $view;
	}
}

?>
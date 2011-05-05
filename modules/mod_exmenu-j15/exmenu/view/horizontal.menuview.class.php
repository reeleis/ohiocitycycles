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
 * This Menu View is used for menu style "Horizontal"
 */
class HorizontalExtendedMenuView extends AbstractExtendedMenuView {
	
	function renderAsString(&$menuNodeList, $level = 0) {
		return $this->_renderMenuNodeList($menuNodeList, $level, $this->menuHierarchy);
	}
	
	function _renderMenuNodeList(&$menuNodeList, $level = 0, $hierarchy = array()) {
		$params		= $this->params;
		$menuclass	= 'mainlevel'.$this->classSuffix;
		$result	= '';
		if ($level == 0) {
			$result	.= '<table width="100%" border="0" cellpadding="0" cellspacing="1"><tr><td nowrap="nowrap">';
			$result	.= '<span class="'.$menuclass.'"> '.$params->get('end_spacer').'</span>';
		} else {
			return '';	// horizontal menu has no sub menus
		}
		$index	= 0;
		foreach(array_keys($menuNodeList) as $id) {
			$menuNode	=& $menuNodeList[$id];
			$itemHierarchy		= $hierarchy;
			$itemHierarchy[]	= (1 + $index);
			if ($index > 0) {
				$result	.= '<span class="'. $menuclass .'"> '.$params->get('spacer').' </span>';
			}
			$linkOutput	= $this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy);
			$result	.= $linkOutput;
			$index++;
		}
		$result	.= '<span class="'. $menuclass .'"> '.$params->get('end_spacer').' </span>';
		$result	.= '</td></tr></table>';
		return $result;
	}
}

?>
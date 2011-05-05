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
 * This Menu View is used for menu style "Select List"
 */
class SelectListExtendedMenuView extends AbstractExtendedMenuView {

	function renderAsString(&$menuNodeList, $level = 0) {
		$siteHelper =& $this->getSiteHelper();
		$action	= FALSE;
		if (function_exists('jimport')) {
			$action	= $siteHelper->getUri('modules/mod_exmenu-j15/mod_exmenu.php');
		} else {
			$action	= $siteHelper->getUri('modules/mod_exmenu.php');
		}
		$result		= '';
		$params		=& $this->params;
		$autoHideSelectButton	= ($params->def('select_list_submit_hide', '0') == 'autohide');
		if ($autoHideSelectButton) {
			$key		= '$$$EXTENDED_MENU_SELECT_LIST_JS_PLACED_BY_CLASS_SUFFIX';
			if (!isset($GLOBALS[$key])) {
				$GLOBALS[$key]						= array();
			}
			if ((!isset($GLOBALS[$key][$this->classSuffix])) || (!$GLOBALS[$key][$this->classSuffix])) {
				$GLOBALS[$key][$this->classSuffix]	= TRUE;
				$result		.= '<script type="text/javascript" language="JavaScript">
<!--

document.write(\'\n<style type="text/css">\n\n.menu-form-submit-autohide { display: none }\n\n</style>\n\');

//-->
</script>
';
			}
		}
		$result		.= '<form class="menu-form'.$this->classSuffix.'" method="post" action="'.$action.'">';
		$result		.= '<select name="url" size="1" onchange="location.href=form.url.options[form.url.selectedIndex].value;">';
		$result		.= $this->_renderMenuNodeList($menuNodeList, $level, $this->menuHierarchy);
		$result		.= '</select>';
		$result		.= '<input name="submit" type="submit" value="'.$params->get('select_list_submit_text', 'Go').'"';
		$result		.= ' class="menu-form-submit'.($autoHideSelectButton ? '-autohide' : '').$this->classSuffix.'"';
		$result		.= ' />';
		$result		.= '</form>';
		return $result;
	}

	function _renderMenuNodeList(&$menuNodeList, $level = 0, $hierarchy = array(), $indent = '') {
		$result	= '';
		$index	= 0;
		$prefix	= $indent;
		if ($level > 0) {
			$prefix	.= '- ';
			$indent	.= '&nbsp;&nbsp;';
		}
		foreach(array_keys($menuNodeList) as $id) {
			$menuNode			=& $menuNodeList[$id];
			$itemHierarchy		= $hierarchy;
			$itemHierarchy[]	= (1 + $index);
			$linkOutput	= $this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy);
			$href		= $this->getExtractedHref($linkOutput);
			$result	.= '<option';
			if ($this->activeMenuClassContainer) {
				$result	.= ' class="'.$this->getContainerMenuClassName($menuNode, $level).'"';
			}
			if ($this->hierarchyBasedIds) {
				$result	.= ' id="menuitem_'.$this->getHierarchyString($itemHierarchy).$this->idSuffix.'"';
			}
			$result	.= ' value="'.$href.'"';
			if ($menuNode->isCurrent()) {
				$result	.= ' selected="selected"';
			}
			if ($href == '') {
				$result	.= ' disabled="disabled"';
			}
			$result	.= '>';
			$result .= $prefix.$menuNode->name;
			$result	.= '</option>';
			if (($level < $this->maxDepth) && ($menuNode->isExpanded())) {
				$subMenuNodeList	=& $menuNode->getChildNodeList();
				if (count($subMenuNodeList) > 0) {
					$result	.= $this->_renderMenuNodeList($subMenuNodeList, $level+1, $itemHierarchy, $indent);
				}
			}
			$index++;
		}
		return $result;
	}
}
?>
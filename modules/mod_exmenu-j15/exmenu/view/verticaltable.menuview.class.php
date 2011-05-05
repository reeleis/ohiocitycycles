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
 * This Menu View is used for menu style "Vertical"
 */
class VerticalTableExtendedMenuView extends AbstractExtendedMenuView {

	function renderAsString(&$menuNodeList, $level = 0) {
		return $this->_renderMenuNodeList($menuNodeList, $level, $this->menuHierarchy);
	}

	function _renderMenuNodeList(&$menuNodeList, $level = 0, $hierarchy = array()) {
		$siteHelper =& $this->getSiteHelper();
		$img	= NULL;
		$params	= $this->params;
		// indent icons
		if (($level >= 1) && ($level <= 7)) {
			switch ($params->get('indent_image')) {
				case '1':
					// Default images
					$imgpath	= $siteHelper->getUri('images/M_images');
					$img		= '<img src="'.$imgpath.'/indent'.$level.'.png" alt="" />';
					break;
				case '2':
					// Use Params
					$imgpath = $siteHelper->getUri('images/M_images');
					if ($params->get('indent_image'.$level) != '-1') {
						$img	= '<img src="'.$imgpath.'/'.$params->get('indent_image'.$level).'" alt="" />';
					}
					break;
				case '3':
					// None
					break;
				default:
					// Template
					$imgpath	= $siteHelper->getSiteTemplateUri('images');
					$img		= '<img src="'.$imgpath.'/indent'.$level.'.png" alt="" />';
					break;
			}
		}

		$result	= '';
		if ($level == 0) {
			$result	.= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		}
		$index	= 0;
		foreach(array_keys($menuNodeList) as $id) {
			$menuNode	=& $menuNodeList[$id];
			$itemHierarchy		= $hierarchy;
			$itemHierarchy[]	= (1 + $index);

			$elementAttributes	= '';
			if ($this->hierarchyBasedIds) {
				$elementAttributes	.= ' id="menuitem_'.$this->getHierarchyString($itemHierarchy).$this->idSuffix.'"';
			}
			$levelValue		= '';
			if ($level == 0) {
				if ($this->mainlevelClasses) {
					$levelValue	= 'mainlevel';
				}
			} else {
				if ($this->sublevelClasses) {
					$levelValue	= 'sublevel';
				}
			}
			if ($levelValue != '') {
				if ($this->activeMenuClassContainer) {
					$levelValue	= $this->getContainerMenuClassName($menuNode, $level);
				}
				$elementAttributes	.= ' class="'.$levelValue.$this->classSuffix.'"';
			}


			if ($level == 0) {
				$result	.= '<tr align="left"><td'.$elementAttributes.'>';
			} else {
				$result	.= '<div style="padding-left: '.(4 * $level).'px"'.$elementAttributes.'>'.$img;
			}
			$linkOutput	= $this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy);
			$result	.= $linkOutput;
			if (($level < $this->maxDepth) && ($menuNode->isExpanded())) {
				$subMenuNodeList	=& $menuNode->getChildNodeList();
				if (count($subMenuNodeList) > 0) {
					$result	.= $this->_renderMenuNodeList($subMenuNodeList, $level+1, $itemHierarchy);
				}
			}
			if ($level == 0) {
				$result	.= '</td></tr>';
			} else {
				$result	.= '</div>';
			}
			$index++;
		}
		if ($level == 0) {
			$result	.= '</table>';
		}
		return $result;
	}

}
?>
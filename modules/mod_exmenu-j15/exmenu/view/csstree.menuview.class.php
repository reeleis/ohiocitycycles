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
 * This Menu View is used for menu style "CSS Tree"
 */
class CssTreeExtendedMenuView extends AbstractExtendedMenuView {

	function getImageHtml($name) {
		return '<span class="'.$name.$this->classSuffix.'"></span>';
	}

	function renderAsString(&$menuNodeList, $level = 0) {
		return $this->_renderMenuNodeList($menuNodeList, $level, $this->menuHierarchy);
	}

	function _renderMenuNodeList(&$menuNodeList, $level = 0, $hierarchy = array(), $noLineMap = NULL) {
		$siteHelper =& $this->getSiteHelper();
		if (!is_array($noLineMap)) {
			$noLineMap	= array();
		}
		$imagePath	= $siteHelper->getSiteTemplateUri('images/');
		$result	= '';
		if ($level == 0) {
			$result	.= '<div class="tree'.$this->classSuffix.'">';
			$result	.= '<div class="start'.$this->classSuffix.'">';
			$result	.= '</div>';
		} else {
		}
		$keys	= array_keys($menuNodeList);
		$count	= count($keys);
		$iItem		= 0;
		$result	.= '<ul>';
		foreach($keys as $id) {
			$iItem++;
			$isLast	= ($iItem == $count);
			$lastSuffix	= ($isLast ? '_last' : '');
			$menuNode	=& $menuNodeList[$id];
			$result	.= '<li';
			if ($this->activeMenuClassContainer) {
				$result	.= ' class="'.$this->getContainerMenuClassName($menuNode, $level).'"';
			}
			$result	.= '>';
			$itemHierarchy		= $hierarchy;
			$itemHierarchy[]	= $iItem;
			$hasSubMenuItems	= ($menuNode->hasChildren());
			$subMenuNodeList	=& $menuNode->getChildNodeList();
			$openSubMenuItems	= (($hasSubMenuItems) && ($level < $this->maxDepth) && ($menuNode->isExpanded()));
			if ($menuNode->type	== 'separator') {
				$linkOutput			= $menuNode->name;
			} else {
				$linkOutput			= trim($this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy));
			}
			$href				= $this->getExtractedHref($linkOutput);
			for($i = 0; $i < $level; $i++) {
				if (isset($noLineMap[$i])) {
					$result	.= $this->getImageHtml('noline');
				} else {
					$result	.= $this->getImageHtml('line');
				}
			}
			if ($hasSubMenuItems) {
				if ($openSubMenuItems) {
					$result	.= $this->getImageHtml('minus'.$lastSuffix);
					$result	.= $this->getImageHtml('folder_open');
				} else {
					if ($href != '') {
						$result	.= '<a class="plus'.$this->classSuffix.'" href="'.$href.'">';
					}
					$result	.= $this->getImageHtml('plus');
					if ($href != '') {
						$result	.= '</a>';
					}
					$result	.= $this->getImageHtml('folder');
				}
			} else {
				if ($linkOutput == '') {
					$result	.= $this->getImageHtml('line');
				} else {
					$result	.= $this->getImageHtml('join'.$lastSuffix);
					if ($menuNode->isActive()) {
						$result	.= $this->getImageHtml('document_open');
					} else {
						$result	.= $this->getImageHtml('document');
					}
				}
			}
			$result	.= $linkOutput;
			if ($isLast) {
				$noLineMap[$level]	= TRUE;
			}
			if ($openSubMenuItems) {
				$result	.= $this->_renderMenuNodeList($subMenuNodeList, $level+1, $itemHierarchy, $noLineMap);
			}
			unset($noLineMap[$level]);
			$result	.= '</li>';
		}
		$result	.= '</ul>';
		if ($level == 0) {
			$result	.= '</div>';
		} else {
		}
		return $result;
	}
}
?>
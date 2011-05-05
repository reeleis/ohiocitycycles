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
 * This Menu View is used for patTemplate template files
 */
class PatTemplateExtendedMenuView extends AbstractExtendedMenuView {

	var $patTemplateSiteHome	= '';
	var $patTemplateDirectory	= '';
	var $patTemplateFile		= '';
	var $title;
	var $imagesEnabled			= FALSE;

	function renderAsString(&$menuNodeList, $level = 0) {
		$siteHelper =& $this->getSiteHelper();
		$absolutePath = $siteHelper->getAbsolutePath();
		if (!class_exists('patTemplate')) {
			if (function_exists('jimport')) {
				jimport('pattemplate.patTemplate');
			} else {
				require_once($absolutePath.'/includes/patTemplate/patTemplate.php');
			}
		}
		$params			=& $this->params;
		$this->title	= $params->get('title', '');
		$tmpl   =& new patTemplate();
		$tmpl->setBasedir($this->patTemplateDirectory);
		$tmpl->readTemplatesFromFile($this->patTemplateFile);
		$this->patTemplateSiteHome	= $this->patTemplateDirectory;
		if ((strlen($this->patTemplateSiteHome) >= strlen($absolutePath)) &&
			(substr($this->patTemplateSiteHome, 0, strlen($absolutePath)) == $absolutePath)) {
				$this->patTemplateSiteHome	= $siteHelper->getUri(
						substr($this->patTemplateSiteHome, strlen($absolutePath) + 1));
		}
		$menuListContent	= $this->processMenuNodeList($tmpl, $menuNodeList);
		$this->resetTemplate($tmpl, 'menu', $this->menuLevel);
		$tmpl->addVar('menu', 'MENU_LIST', $menuListContent);
		return $tmpl->getParsedTemplate('menu');
	}

	function resetTemplate(&$tmpl, $name, $level = 0, $hierarchy = '') {
		$siteHelper =& $this->getSiteHelper();
		$tmpl->clearTemplate($name);
		$tmpl->addVar($name, 'TITLE', $this->title);
		$tmpl->addVar($name, 'LEVEL', $level);
		$tmpl->addVar($name, 'MENU_LEVEL', $this->menuLevel);
		$tmpl->addVar($name, 'CLASS_SUFFIX', $this->classSuffix);
		$tmpl->addVar($name, 'LIVE_SITE', substr($siteHelper->getUri(), 0, -1));
		$tmpl->addVar($name, 'SITE_TEMPLATE', $siteHelper->getSiteTemplateName());
		$tmpl->addVar($name, 'TEMPLATE_HOME', $this->patTemplateSiteHome);
	}

	function processMenuNodeList(&$tmpl, &$menuNodeList, $level = 0, $hierarchy = array()) {
		$siteHelper =& $this->getSiteHelper();
		$keys	= array_keys($menuNodeList);
		$count	= count($keys);
		if ($count == 0) {
			return '';
		}
		$itemTemplateName	= 'menu_item';
		$listTemplateName	= 'menu_list';
		$menuItemsContent	= '';
		$index	= 0;
		$hierarchyString			= $this->getHierarchyString(array_merge($this->menuHierarchy, $hierarchy));
		$relativeHierarchyString	= $this->getHierarchyString($hierarchy);
		foreach($keys as $id) {
			$menuNode	=& $menuNodeList[$id];
			$hasSubMenuItems	= ($menuNode->hasChildren());
			$subMenuNodeList	=& $menuNode->getChildNodeList();
			$openSubMenuItems	= (($hasSubMenuItems) && ($level < $this->maxDepth) && ($menuNode->isExpanded()));
			$itemHierarchy		= $hierarchy;
			$itemHierarchy[]	= (1+$index);
			$subMenuItemsContent	= '';
			if ($openSubMenuItems) {
				$subMenuItemsContent	= $this->processMenuNodeList($tmpl, $subMenuNodeList, $level+1,
					$itemHierarchy);
			}
			$linkOutput			= trim($this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy));
			$image				= '';
			if ($this->imageEnabled) {
				$menu_params 	=& $this->getParsedParameters($menuNode->params);
				$menu_image		= $menu_params->def('menu_image', -1);
				if (($menu_image <> '-1') && ($menu_image)) {
					$image			= $this->getUri('images/stories/'.$menu_image);
				}
			}
			$itemId = $id;
			if ((isset($menuNode->id)) && ($menuNode->id > 0)) {
				$itemId = $menuNode->id;
			}
			$this->resetTemplate($tmpl, $itemTemplateName, $level);
			$tmpl->addVar($itemTemplateName, 'CAPTION', $menuNode->name);
			$tmpl->addVar($itemTemplateName, 'URL', $this->getExtractedHref($linkOutput));
			$tmpl->addVar($itemTemplateName, 'TARGET', $this->getExtractedTarget($linkOutput));
			$tmpl->addVar($itemTemplateName, 'ONCLICK', $this->getExtractedOnClick($linkOutput));
			$tmpl->addVar($itemTemplateName, 'TYPE', $menuNode->type);
			$tmpl->addVar($itemTemplateName, 'ACCESS_KEY', (isset($menuNode->accessKey) ? $menuNode->accessKey : ''));
			$tmpl->addVar($itemTemplateName, 'LINK', $linkOutput);
			$tmpl->addVar($itemTemplateName, 'LINK_OPEN', $this->lastLinkBegin);
			$tmpl->addVar($itemTemplateName, 'LINK_CLOSE', $this->lastLinkEnd);
			$tmpl->addVar($itemTemplateName, 'SUB_MENU_ITEMS', $subMenuItemsContent);
			$tmpl->addVar($itemTemplateName, 'ITEM_ID', $itemId);
			$tmpl->addVar($itemTemplateName, 'INDEX', 1+$index);
			$tmpl->addVar($itemTemplateName, 'COUNT', $count);
			$tmpl->addVar($itemTemplateName, 'IS_FIRST', $index == 0);
			$tmpl->addVar($itemTemplateName, 'IS_LAST', (1+$index) == $count);
			$tmpl->addVar($itemTemplateName, 'IS_EVEN', ($index % 2) == 0);
			$tmpl->addVar($itemTemplateName, 'PARENT_HIERARCHY', $hierarchyString);
			$tmpl->addVar($listTemplateName, 'RELATIVE_PARENT_HIERARCHY', $relativeHierarchyString);
			$tmpl->addVar($itemTemplateName, 'HIERARCHY', $this->getHierarchyString(array_merge($this->menuHierarchy, $itemHierarchy)));
			$tmpl->addVar($itemTemplateName, 'RELATIVE_HIERARCHY', $this->getHierarchyString($itemHierarchy));
			$tmpl->addVar($itemTemplateName, 'IS_CURRENT', $menuNode->isCurrent());
			$tmpl->addVar($itemTemplateName, 'IS_ACTIVE', $menuNode->isActive());
			$tmpl->addVar($itemTemplateName, 'IS_EXPANDED', $menuNode->isExpanded());
			$tmpl->addVar($itemTemplateName, 'IS_SEPARATOR', $menuNode->isSeparator());
			$tmpl->addVar($itemTemplateName, 'HAS_SUB_MENU_ITEMS', $hasSubMenuItems);
			$tmpl->addVar($itemTemplateName, 'IMAGE', $image);
			$menuItemsContent	.= trim($tmpl->getParsedTemplate($itemTemplateName));
			$index++;
		}
		$this->resetTemplate($tmpl, $listTemplateName, $level);
		$tmpl->addVar($listTemplateName, 'MENU_ITEMS', $menuItemsContent);
		$tmpl->addVar($listTemplateName, 'HIERARCHY', $hierarchyString);
		$tmpl->addVar($listTemplateName, 'RELATIVE_HIERARCHY', $relativeHierarchyString);
		$result	= trim($tmpl->getParsedTemplate($listTemplateName));
		return $result;
	}
}
?>
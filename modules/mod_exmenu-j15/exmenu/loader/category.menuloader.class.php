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

require_once(EXTENDED_MENU_HOME.'/loader/contentitem.menuloader.class.php');

/**
 * @since 1.0.0
 */
class CategoryExtendedMenuLoader extends ContentItemExtendedMenuLoader {

	var $categoryCache	= NULL;

	function &getCategoryCache() {
		if (!is_object($this->categoryCache)) {
			$this->categoryCache		=& ExtendedMenuCacheFactory::getNewInstance('category');
			$cache					=& $this->categoryCache;
			$cache->order			= $this->categoryOrder;
			$cache->sectionOrder		= $this->sectionOrder;	// TODO may get removed
		}
		return $this->categoryCache;
	}

	function loadBySourceValues($sourceValues) {
		return $this->loadByCategoryIds($sourceValues, $this->categoryVisible, $this->contentItemVisible);
	}

	function loadByCategoryIds($ids, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		$this->resolveTableIds($ids, '#__categories', array('name', 'title'), 'id', FALSE, array('published = 1', 'section NOT LIKE \'%com_%\''));
//		echo 'ids=['.print_r($ids, TRUE).', contentItemVisible=['.$contentItemVisible.']]<br/>';
		if ($categoryVisible) {
			$categoryCache		=& $this->getCategoryCache();
			$categoryCache->loadByCategoryIds($ids);
		}
		if ($contentItemVisible) {
			$contentItemCache	=& $this->getContentItemCache();
			$contentItemCache->loadByCategoryIds($ids, $categoryVisible);
		}
		$rootMenuNode	=& $this->getRootMenuNode();
		if ($categoryVisible) {
			$categoryCache		=& $this->getCategoryCache();
			$categoryList		=& $categoryCache->getCategoryList();
			$this->addCategoryMenuNodes($rootMenuNode, $categoryList, $categoryVisible, $contentItemVisible);
		} else if ($contentItemVisible) {
			$contentItemCache	=& $this->getContentItemCache();
			$contentItemList		=& $contentItemCache->getContentItemList();
			$this->addContentItemMenuNodes($rootMenuNode, $contentItemList, $contentItemVisible);
		}
		return TRUE;
	}

	function applyCategoryLink(&$menuNode, $categoryId) {
		$menuNode->type			= $this->categoryLinkType;
		if ($this->isJoomla15()) {
			$menuNode->link			= 'index.php?option=com_content&view='.$this->getTaskByLinkType($this->categoryLinkType).'&id='.$categoryId;
		} else {
			$menuNode->link			= 'index.php?option=com_content&task='.$this->getTaskByLinkType($this->categoryLinkType).'&id='.$categoryId;
		}
		if ($this->defaultCategoryItemid != '') {
			$menuNode->link		.= '&Itemid='.$this->defaultCategoryItemid;
		} else {
			$menuNode->link		.= '&Itemid='.$this->currentItemid;
		}
	}

	function &getNewCategoryMenuNode(&$category) {
		$menuNode				=& $this->getEmptyMenuNode();
		$menuNode->name			= $category->title;
		if ($this->isCurrentCategory($category->id)) {
			$menuNode->setCurrent(TRUE);
			$menuNode->setExpanded(TRUE);
		} else if ($this->isActiveCategory($category->id)) {
			$menuNode->setActive(TRUE);
			$menuNode->setExpanded(TRUE);
		}
		if (!$this->openActiveOnly) {
			$menuNode->setExpanded(TRUE);
		}
		if ($this->categoryLinkEnabled) {
			$this->applyCategoryLink($menuNode, $category->id);
		}
		return $menuNode;
	}

	function addCategoryMenuNode(&$parentMenuNode, &$category, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		if ($categoryVisible) {
			$menuNode				=& $this->getNewCategoryMenuNode($category);
			if ($contentItemVisible) {
				$contentItemCache		=& $this->getContentItemCache();
				$contentItemList			=& $contentItemCache->getContentListByCategoryId($category->id);
				$this->addContentItemMenuNodes($menuNode, $contentItemList, $contentItemVisible);
			}
			$this->addMenuNode($parentMenuNode, $menuNode);
		} else {
			if ($contentItemVisible) {
				$contentItemCache		=& $this-getContentItemCache();
				$contentItemList			=& $contentItemCache->getContentListByCategoryId($category->id);
				$this->addContentItemMenuNodes($parentMenuNode, $contentItemList, $contentItemVisible);
			}
		}
	}

	function addCategoryMenuNodes(&$parentMenuNode, &$categoryList, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		$titleArray		= array();
		foreach(array_keys($categoryList) as $key) {
			$category				=& $categoryList[$key];
			$this->addCategoryMenuNode($parentMenuNode, $category, $categoryVisible, $contentItemVisible);
			$titleArray[]	= $category->title;
		}
		if (!$parentMenuNode->hasCaption()) {
			$parentMenuNode->setCaption(implode(', ', $titleArray));
		}
	}
}

?>
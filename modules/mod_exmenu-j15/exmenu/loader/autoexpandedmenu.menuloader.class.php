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

require_once(EXTENDED_MENU_HOME.'/loader/section.menuloader.class.php');

/**
 * @since 1.0.0
 */
class AutoExpandedExtendedMenuLoader extends SectionExtendedMenuLoader {

	var $sectionMenuNodeList		= array();
	var $categoryMenuNodeList	= array();

	function &copyArrayFlat(&$a) {
		$result		= array();
		foreach(array_keys($a) as $key) {
			$value			=& $a[$key];
			$result[$key]	=& $value;
		}
		return $result;
	}

	function loadBySourceValues($sourceValues) {
		$result	= $this->loadMenuItems($sourceValues);
		$rootMenuNode	=& $this->getRootMenuNode();
		$menuNodeList	=& $rootMenuNode->getChildNodeList();
		$this->findAutoExpandableMenuNodes($menuNodeList);
		$sectionMenuNodeList		=& $this->sectionMenuNodeList;
		$categoryMenuNodeList	=& $this->categoryMenuNodeList;
		$sectionVisible			= $this->sectionVisible;
		$categoryVisible			= $this->categoryVisible;
		$contentItemVisible		= $this->contentItemVisible;
		if (count($sectionMenuNodeList) > 0) {
			$menuNodeListBySectionId		= array();	// we use a list for each id to avoid problems in case there are multiple links to the same section
			foreach(array_keys($sectionMenuNodeList) as $key) {
				$menuNode	=& $sectionMenuNodeList[$key];
				$id			= $this->getIdByUrl($menuNode->link);
				if ($id > 0) {
					if (!isset($menuNodeListBySectionId[$id])) {
						$menuNodeListBySectionId[$id]	= array();
					}
					$menuNodeListBySectionId[$id][]	=& $menuNode;
				} else {
					$params			=& $this->getParsedParameters($menuNode->params);
					$ids			= explode(',', $params->get('sectionid', 0));
					foreach($ids as $id) {
						$id		= intval(trim($id));
						if (!isset($menuNodeListBySectionId[$id])) {
							$menuNodeListBySectionId[$id]	= array();
						}
						$menuNodeListBySectionId[$id][]	=& $menuNode;
					}
				}
			}
			$sectionIds			= array_keys($menuNodeListBySectionId);
			$sectionCache		=& $this->getSectionCache();
			$sectionCache->loadBySectionIds($sectionIds);
			$sectionList			=& $sectionCache->getSectionList();
			if ($categoryVisible) {
				$categoryCache		=& $this->getCategoryCache();
				$categoryCache->loadBySectionIds($sectionIds);
			}
			if ($contentItemVisible) {
				$contentItemCache	=& $this->getContentItemCache();
				$contentItemCache->loadBySectionIds($sectionIds);
			}
			foreach(array_keys($menuNodeListBySectionId) as $id) {
				$menuNodeList	=& $menuNodeListBySectionId[$id];
				$section			=& $sectionCache->getSectionById($id);
				if (is_object($section)) {
					if ($categoryVisible) {
						$categoryCache			=& $this->getCategoryCache();
						$categoryList			=& $categoryCache->getCategoryListBySectionId($section->id);
						foreach(array_keys($menuNodeList) as $key) {
							$menuNode	=& $menuNodeList[$key];
							$this->addCategoryMenuNodes($menuNode, $categoryList, $categoryVisible, $contentItemVisible);
						}
					} else {
						if ($contentItemVisible) {
							$contentItemCache		=& $this->getContentItemCache();
							$contentItemList			=& $contentItemCache->getContentListBySectionId($section->id);
							foreach(array_keys($menuNodeList) as $key) {
								$menuNode	=& $menuNodeList[$key];
								$this->addContentItemMenuNodes($menuNode, $contentItemList, $contentItemVisible);
							}
						}
					}
				}
			}
			if ($this->sectionHidden) {
				foreach(array_keys($sectionMenuNodeList) as $key) {
					$this->replaceMenuNodesByChildren($sectionMenuNodeList[$key]);
				}
			}
		}
		if (count($categoryMenuNodeList) > 0) {
			$menuNodeListByCategoryId		= array();	// we use a list for each id to avoid problems in case there are multiple links to the same category
			foreach(array_keys($categoryMenuNodeList) as $key) {
				$menuNode	=& $categoryMenuNodeList[$key];
				$id			= $this->getIdByUrl($menuNode->link);
				if ($id > 0) {
					if (!isset($menuNodeListByCategoryId[$id])) {
						$menuNodeListByCategoryId[$id]	= array();
					}
					$menuNodeListByCategoryId[$id][]	=& $menuNode;
				} else {
					$params			=& $this->getParsedParameters($menuNode->params);
					$ids			= explode(',', $params->get('categoryid', 0));
					foreach($ids as $id) {
						$id		= intval(trim($id));
						if (!isset($menuNodeListByCategoryId[$id])) {
							$menuNodeListByCategoryId[$id]	= array();
						}
						$menuNodeListByCategoryId[$id][]	=& $menuNode;
					}
				}
			}
			$categoryIds			= array_keys($menuNodeListByCategoryId);
			$categoryCache		=& $this->getCategoryCache();
			$categoryCache->loadByCategoryIds($categoryIds);
			if ($contentItemVisible) {
				$contentItemCache	=& $this->getContentItemCache();
				$contentItemCache->loadByCategoryIds($categoryIds);
			}
			foreach(array_keys($menuNodeListByCategoryId) as $id) {
				$menuNodeList	=& $menuNodeListByCategoryId[$id];
				$category		=& $categoryCache->getCategoryById($id);
				if (is_object($category)) {
					if ($contentItemVisible) {
						$contentItemCache		=& $this->getContentItemCache();
						$contentItemList			=& $contentItemCache->getContentListByCategoryId($category->id);
						foreach(array_keys($menuNodeList) as $key) {
							$menuNode	=& $menuNodeList[$key];
							$this->addContentItemMenuNodes($menuNode, $contentItemList, $contentItemVisible);
						}
					}
				}
			}
			if ($this->categoryHidden) {
				foreach(array_keys($categoryMenuNodeList) as $key) {
					$this->replaceMenuNodesByChildren($categoryMenuNodeList[$key]);
				}
			}
		}
		return $result;
	}

	function replaceMenuNodesByChildren(&$menuNode) {
		$menuNodeList		=& $menuNode->getChildNodeList();
		$parentMenuNode		=& $menuNode->getParent();
		$oldMenuNodeList		= array();
		$oldMenuNodeList[]	=& $menuNode;
		$newMenuNodeList		= $this->copyArrayFlat($menuNodeList);
		if (is_object($parentMenuNode)) {
			$this->replaceMenuNodes($parentMenuNode, $oldMenuNodeList, $newMenuNodeList);
		} else {
			trigger_error('No parent for the menu node found.', E_USER_NOTICE);
		}
	}

	function findAutoExpandableMenuNodes(&$menuNodeList, $level = 0) {
		$categoryVisible			= $this->categoryVisible;
		$contentItemVisible		= $this->contentItemVisible;
		foreach(array_keys($menuNodeList) as $key) {
			$menuNode	=& $menuNodeList[$key];
			$type = $this->getLinkTypeByMenuNode($menuNode);
			switch($type) {
				case 'content_category':
				case 'content_blog_category':
				case 'content_archive_category':
					if ($contentItemVisible) {
						$this->categoryMenuNodeList[]	=& $menuNode;
					}
					break;
				case 'content_section':
				case 'content_blog_section':
				case 'content_archive_section':
					if (($categoryVisible) || ($contentItemVisible)) {
						$this->sectionMenuNodeList[]		=& $menuNode;
					}
					break;
			}
			if ($menuNode->hasChildren()) {
				$childMenuNodeList		=& $menuNode->getChildNodeList();
				$this->findAutoExpandableMenuNodes($childMenuNodeList, $level + 1);
			}
		}
	}

}

?>
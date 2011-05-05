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
 * Loads a menu but does not render it.
 * (Formaly known as MenuManager)
 *
 * @since 0.2.0
 */
class AbstractExtendedMenuLoader extends AbstractExtendedMenuDatabaseHelper {

	var $siteHelper = NULL;
	var $menutype				= '';
	var $activeMenuId			= -1;
	var $openActiveOnly			= FALSE;
	var $loadActiveOnly			= FALSE;
	var $maxDepth				= 0;
	var $minExpand				= 0;
	var $parseAccessKey			= 0;
	var $cacheEnabled			= TRUE;
	var $activeIds				= array();
	var $menuNodeByIdMap			= array();
	var $menuNodeByNameMap		= array();
	var $rootMenuNode			= NULL;
	var $menuNodeList			= array();
	var $currentItemid			= FALSE;
	var $defaultSectionItemid	= '';
	var $defaultCategoryItemid	= '';
	var $defaultContentItemid	= '';
	var $sectionLinkEnabled		= TRUE;
	var $categoryLinkEnabled		= TRUE;
	var $contentItemLinkEnabled	= TRUE;
	var $sectionVisible			= TRUE;
	var $categoryVisible			= TRUE;
	var $contentItemVisible		= TRUE;
	var $sectionHidden			= FALSE;
	var $categoryHidden			= FALSE;
	var $contentItemHidden		= FALSE;
	var $sectionLinkType			= 'content_section';
	var $categoryLinkType		= 'content_category';
	var $contentItemLinkType		= 'content_item_link';
	var $smartItemidEnabled		= TRUE;
	var $ignoreItemidEnabled		= FALSE;
	var $exactAccessLevel		= FALSE;

	function MenuLoader() {
	}

	function showDebug($msg) {
		global $mosConfig_debug;
		if ($mosConfig_debug) {
			echo '<span class="debug">'.htmlspecialchars($msg).'</span>';
		}
	}

	/**
	 * @since 1.1.0
	 */
	function &getSiteHelper() {
		return $this->siteHelper;
	}


	function &getEmptyMenuNode() {
		$menuNode				=& new MenuNode();
		$menuNode->id			= FALSE;
		$menuNode->type			= 'separator';
		$menuNode->link			= '';
		$menuNode->name			= '';
		$menuNode->browserNav	= '';
		return $menuNode;
	}

	/**
	 * @since 1.0.0
	 */
	function &getRootMenuNode() {
		if (!is_object($this->rootMenuNode)) {
			$this->rootMenuNode		=& $this->getEmptyMenuNode();
		}
		return $this->rootMenuNode;
	}


	/**
	 * @since 1.0.6
	 */
	function isJoomla15() {
		$siteHelper =& $this->siteHelper;
		return $siteHelper->isJoomla15();
	}


	/**
	 * @since 1.0.5
	 */
	function &getParsedParameters($text) {
		$result = NULL;
		if (class_exists('JParameter')) {
			$result =& new JParameter($text);
		} else {
			$result =& new mosParameters($text);
		}
		return $result;
	}


	/**
	 * @since 1.0.0
	 */
	function getTaskByLinkType($linkType) {
		return str_replace('_', '', str_replace('content_', '', $linkType));
	}

	function isAnyActiveByMenuNodeList(&$menuNodeList) {
		foreach(array_keys($menuNodeList) as $key) {
			$menuNode	=& $menuNodeList[$key];
			if ($menuNode->active) {
				return TRUE;
			}
		}
		return FALSE;
	}

	function resolveTableIds(&$ids, $tableName, $identifierField, $idField = 'id', $skipNumbers = TRUE, $additionalWhere = FALSE) {
		$database =& $this->getDatabase();
		if (count($ids) == 0) {
			$ids[]	= '*';
		}
		if (!is_array($identifierField)) {
			$identifierField		= array($identifierField);
		}
		$resolvingIds	= array();
		foreach($ids as $k => $id) {
			if ((!$skipNumbers) || (''.intval($id) != $id)) {
				$resolvingIds[$k]	= $id;
			}
		}
		if (count($resolvingIds) > 0) {
			// it is faster to resolve all ids at once
			$where				= array();
			$findAll				= FALSE;
			$includesQuoted		= array();
			$excludesQuoted		= array();
			$includeIds			= array();
			$excludeIds			= array();
			$includesLike		= array();
			$excludesLike		= array();
			foreach($resolvingIds as $identifier) {
				$identifier		= trim($identifier);
				if ($identifier == '') {
					// ignore empty
				} else if (($identifier == '*') || ($identifier == '+*')) {
					$findAll		= TRUE;
				} else {
					$include				= TRUE;
					$s					= $identifier;
					if (substr($identifier, 0, 1) == '-') {
						$s					= substr($identifier, 1);
						$include				= FALSE;
					} else if (substr($identifier, 0, 1) == '+') {
						$s					= substr($identifier, 1);
					} else {
					}
					if ($include) {
						if (''.intval($s) == $s) {
							$includeIds[]		= intval($s);
						} else {
							if (strpos($s, '*') !== FALSE) {
								$includesLike[]		= $this->getSqlLike($identifierField, $s, FALSE);
							} else {
								$includesQuoted[]	= $this->getSqlQuote($s);
							}
						}
					} else {
						if (''.intval($s) == $s) {
							$excludeIds[]		= intval($s);
						} else {
							if (strpos($s, '*') !== FALSE) {
								$excludesLike[]		= $this->getSqlLike($identifierField, $s, TRUE);
							} else {
								$excludesQuoted[]	= $this->getSqlQuote($s);
							}
						}
					}
				}
			}
			$includes		= array();
			$excludes		= array();
			if ($findAll) {
			} else {
				if (count($includeIds) > 0) {
					$includes[]		= $idField.' IN ('.implode(',', $includeIds).')';
				}
				if (count($includesQuoted) > 0) {
					foreach($identifierField as $fieldName) {
						$includes[]		= $fieldName.' IN ('.implode(',', $includesQuoted).')';
					}
				}
				if (count($includesLike) > 0) {
					$includes		= array_merge($includes, $includesLike);
				}
			}

			if (count($excludeIds) > 0) {
				$excludes[]		= $idField.' NOT IN ('.implode(',', $excludeIds).')';
			}
			if (count($excludesQuoted) > 0) {
				foreach($identifierField as $fieldName) {
					$excludes[]		= $fieldName.' NOT IN ('.implode(',', $excludesQuoted).')';
				}
			}
			if (count($excludesLike) > 0) {
				$excludes		= array_merge($excludes, $excludesLike);
			}

			if (count($includes) > 0) {
				$where[]			= '('.implode(' OR ', $includes).')';
			}
			if (count($excludes) > 0) {
				$where[]			= '('.implode(' AND ', $excludes).')';
			}
			if ((is_array($additionalWhere)) && (count($additionalWhere) > 0)) {
				$where	= array_merge($where, $additionalWhere);
			}
			$sql	= 'SELECT '.$idField.', '.$identifierField[0].' FROM '.$tableName;
			if (count($where) > 0) {
				$sql		.= ' WHERE '.implode(' AND ', $where);
			}
			$database->setQuery($sql);
			// workaround for joomla bug artf1597 (we would call loadAssocList($identifierField) instead)
			// compatibility with Mambo 4.5.1... use loadObjectList instead
			$resolvedIds	= $database->loadObjectList();
			if ($this->checkDatabaseError()) {
			}
			if (!is_array($resolvedIds)) {
				$resolvedIds	= array();
			}
			$resolvedIdByIdentiferMap		= array();
			foreach($resolvedIds as $row) {
				$fieldName	= $identifierField[0];
				if ($row->$fieldName != '') {
					$resolvedIdByIdentiferMap[$row->$fieldName]	= $row->$idField;
				} else {
					$resolvedIdByIdentiferMap[]	= $row->$idField;
				}
			}
			foreach($resolvingIds as $k => $identifier) {
				if (!isset($resolvedIdByIdentiferMap[$identifier])) {
					unset($ids[$k]);	// not found
				} else {
					$ids[$k]	= $resolvedIdByIdentiferMap[$identifier];
				}
			}
			foreach($resolvedIdByIdentiferMap as $identifier => $id) {
				if (!in_array($id, $ids)) {
					$ids[]	= $id;
				}
			}
		}
	}

	function getSectionIdByContentId($id) {
		$database =& $this->getDatabase();
		$database->setQuery('SELECT sectionid FROM #__content WHERE id = '.intval($id));
		return $database->loadResult();
	}

	function getSectionIdByCategoryId($id) {
		$database =& $this->getDatabase();
		$database->setQuery('SELECT section FROM #__categories WHERE id = '.intval($id));
		return $database->loadResult();
	}

	function getCategoryIdByContentId($id) {
		$database =& $this->getDatabase();
		$database->setQuery('SELECT catid FROM #__content WHERE id = '.intval($id));
		return $database->loadResult();
	}

	function getRequestParameter($name, $defaultValue = NULL) {
		return (isset($_REQUEST[$name]) ? $_REQUEST[$name] : $defaultValue);
	}

	function getOptionParameter() {
		if (isset($GLOBALS['option'])) {
			return $GLOBALS['option'];
		} else {
			return getRequestParameter('option');
		}
	}

	function getItemidParameter() {
		$siteHelper =& $this->getSiteHelper();
		return $siteHelper->getCurrentMenuId();
	}

	function getCurrentContentId($cache = TRUE) {
		$key	= '$$$CURRENT_CONTENT_ID';
		if (($cache) && (isset($GLOBALS[$key]))) {
			return $GLOBALS[$key];
		}
		$task 		= $this->getRequestParameter('task', '');
		$view		= '';
		if ($task == '') {
			$view 		= $this->getRequestParameter('view', '');
		}
		$id			= intval($this->getRequestParameter('id', '0'));
		$result		= 0;
		$option		= $this->getOptionParameter();
		switch($option) {
			case 'com_content':
				switch($task) {
					case 'view':
					case 'edit':
					case 'cancel':
						$result	= $id;
						break;
				}
				switch($view) {
					case 'article':
						$result	= $id;
						break;
				}
				break;
		}
		if ($cache) {
			$GLOBALS[$key]	= $result;
		}
		return $result;
	}

	function isCurrentContentItem($id, $cache = TRUE) {
		return ($id > 0) && ($this->getCurrentContentId($cache) == $id);
	}

	function getActiveContentId($cache = TRUE) {
		return $this->getCurrentContentId($cache);
	}

	function isActiveContentItem($id, $cache = TRUE) {
		return ($id > 0) && ($this->getActiveContentId($cache) == $id);
	}

	function getCurrentCategoryId($cache = TRUE) {
		$key	= '$$$CURRENT_CATEGORY_ID';
		if (($cache) && (isset($GLOBALS[$key]))) {
			return $GLOBALS[$key];
		}
		$task 		= $this->getRequestParameter('task', '');
		$view		= '';
		if ($task == '') {
			$view 		= $this->getRequestParameter('view', '');
		}
		$id			= intval($this->getRequestParameter('id', 0));
		$result		= 0;
		$option = $this->getOptionParameter();
		switch($option) {
			case 'com_content':
				switch($task) {
					case 'category':
					case 'blogcategory':
					case 'blogcategorymulti':
					case 'archivecategory':
						$result	= $id;
						break;
				}
				switch($view) {
					case 'category':
						$result	= $id;
						break;
				}
				break;
		}

		if ($cache) {
			$GLOBALS[$key]	= $result;
		}
		return $result;
	}

	function isCurrentCategory($id, $cache = TRUE) {
		return ($id > 0) && ($this->getCurrentCategoryId($cache) == $id);
	}

	function getActiveCategoryId($cache = TRUE) {
		$key	= '$$$ACTIVE_CATEGORY_ID';
		if (($cache) && (isset($GLOBALS[$key]))) {
			return $GLOBALS[$key];
		}
		$result		= $this->getCurrentCategoryId($cache);
		if ($result <= 0) {
			$contentId	= $this->getCurrentContentId($cache);
			if ($contentId > 0) {
				$result	= $this->getCategoryIdByContentId($contentId);
			}
		}

		if ($cache) {
			$GLOBALS[$key]	= $result;
		}
		return $result;
	}

	function isActiveCategory($id, $cache = TRUE) {
		if (is_array($id)) {
			return (count($id) > 0) && (in_array($this->getActiveCategoryId($cache), $id));
		} else {
			return ($id > 0) && ($this->getActiveCategoryId($cache) == $id);
		}
	}

	function getCurrentSectionId($cache = TRUE) {
		$key	= '$$$CURRENT_SECTION_ID';
		if (($cache) && (isset($GLOBALS[$key]))) {
			return $GLOBALS[$key];
		}
		$task 		= $this->getRequestParameter('task', '');
		$view		= '';
		if ($task == '') {
			$view 		= $this->getRequestParameter('view', '');
		}
		$id			= intval($this->getRequestParameter('id', 0 ));
		$result		= 0;
		$contentId	= $this->getCurrentContentId($cache);
		if ($contentId > 0) {
			$result	= $this->getSectionIdByContentId($id);
		} else {
		}
		$option = $this->getOptionParameter();
		switch($option) {
			case 'com_content':
				switch($task) {
					case 'section':
					case 'blogsection':
					case 'archivesection':
						$result	= $id;
						break;
				}
				switch($view) {
					case 'section':
						$result	= $id;
						break;
				}
				break;
		}
		if ($cache) {
			$GLOBALS[$key]	= $result;
		}
		return $result;
	}

	function isCurrentSection($id, $cache = TRUE) {
		return ($id > 0) && ($this->getCurrentSectionId($cache) == $id);
	}

	function getActiveSectionId($cache = TRUE) {
		$key	= '$$$ACTIVE_SECTION_ID';
		if (($cache) && (isset($GLOBALS[$key]))) {
			return $GLOBALS[$key];
		}
		$result		= $this->getCurrentSectionId($cache);
		if ($result <= 0) {
			$contentId	= $this->getCurrentContentId($cache);
			if ($contentId > 0) {
				$result	= $this->getSectionIdByContentId($contentId);
			} else {
				$categoryId	= $this->getCurrentCategoryId($cache);
				if ($categoryId > 0) {
					$result	= $this->getSectionIdByCategoryId($categoryId);
				}
			}
		}
		if ($cache) {
			$GLOBALS[$key]	= $result;
		}
		return $result;
	}

	function isActiveSection($id, $cache = TRUE) {
		if (is_array($id)) {
			return (count($id) > 0) && (in_array($this->getActiveSectionId($cache), $id));
		} else {
			return ($id > 0) && ($this->getActiveSectionId($cache) == $id);
		}
	}

	/**
	 * Parses the name parameter for access keys and uses the parseAccessKeys setting. The name parameter may be changed while the access key is returned.
	 */
	function parseAccessKey(&$name, $parseAccessKeys) {
		$accessKey	= '';
		if ($parseAccessKeys > 0) {
			$i	= strpos($name, '[');
			if ($i !== FALSE) {
				$j	= strpos($name, ']', $i + 1);
				if ($j !== FALSE) {
					$accessKey	= strtolower(trim(substr($name, $i + 1, $j - $i - 1)));
					if (($accessKey != '') && (substr($accessKey, 0, 1) == '-')) {
						$accessKey			= substr($accessKey, 1, strlen($accessKey) - 1);
						$parseAccessKeys	= constant('EXTENDED_MENU_ACCESS_KEYS_STRIP');
					}
					if ($parseAccessKeys == constant('EXTENDED_MENU_ACCESS_KEYS_STRIP')) {
						$name			= substr($name, 0, $i).substr($name, $j + 1, strlen($name) - $j - 1);
					} else if ($parseAccessKeys == constant('EXTENDED_MENU_ACCESS_KEYS_STRIP_MARKUP')) {
						$name			= substr($name, 0, $i).substr($name, $i + 1, $j - $i - 1).substr($name, $j + 1, strlen($name) - $j - 1);
					} else if ($parseAccessKeys == constant('EXTENDED_MENU_ACCESS_KEYS_STRIP_AND_EMPHASE')) {
						$name			= substr($name, 0, $i).'<em>'.substr($name, $i + 1, $j - $i - 1).'</em>'.substr($name, $j + 1, strlen($name) - $j - 1);
					}
				}
			}
		}
		return $accessKey;
	}

	function _addHierarchy(&$hierarchy, &$menuNodeList, $depthIndex) {
		if ($depthIndex <= 0) {
			return TRUE;
		}
		$index	= 0;
		foreach(array_keys($menuNodeList) as $k) {
			$menuNode	=& $menuNodeList[$k];
			if (in_array($menuNode->id, $this->activeIds)) {
				$hierarchy[]	= (1+$index);
				if ($depthIndex > 0) {
					$subMenuNodeList	=& $menuNode->getChildNodeList();
					$this->_addHierarchy($hierarchy, $subMenuNodeList, $depthIndex - 1);
				}
				break;
			}
			$index++;
		}
	}

	/**
	 * Returns the hierarchy array for the given depth/level.
	 */
	function getHierarchy($depthIndex) {
		$hierarchy	= array();
		$this->_addHierarchy($hierarchy, $this->menuNodeList, $depthIndex);
		return $hierarchy;
	}

	function registerMenuNode(&$menuNode) {
		if ($menuNode->id > 0) {
			if (!isset($this->menuNodeByIdMap[$menuNode->name])) {
				$this->menuNodeByIdMap[$menuNode->id]		=& $menuNode;
			}
		}
		if ($menuNode->name != '') {
			if (!isset($this->menuNodeByNameMap[$menuNode->name])) {
				$this->menuNodeByNameMap[$menuNode->name]	=& $menuNode;
			}
		}
	}

	function unregisterMenuNode(&$menuNode) {
		if ($menuNode->id > 0) {
			if ($menuNode->equals($this->menuNodeByIdMap[$menuNode->id])) {
				unset($this->menuNodeByIdMap[$menuNode->id]);
			}
		}
		if ($menuNode->name != '') {
			if ($menuNode->equals($this->menuNodeByNameMap[$menuNode->id])) {
				unset($this->menuNodeByNameMap[$menuNode->name]);
			}
		}
	}

	function addMenuNode(&$parentMenuNode, &$menuNode) {
		$parentMenuNode->addChildNode($menuNode);
		$this->registerMenuNode($menuNode);
	}

	function replaceMenuNodes(&$parentMenuNode, &$oldMenuNodeList, &$newMenuNodeList) {
		$parentMenuNode->replaceChildNodes($oldMenuNodeList, $newMenuNodeList);
		foreach(array_keys($oldMenuNodeList) as $key) {
			$this->unregisterMenuNode($oldMenuNodeList[$key]);
		}
		foreach(array_keys($newMenuNodeList) as $key) {
			$this->registerMenuNode($newMenuNodeList[$key]);
		}
	}

	function &getMenuItemById($id) {
		if (isset($this->menuNodeByIdMap[$id])) {
			return $this->menuNodeByIdMap[$id];
		} else {
			$result		= NULL;
			return $result;
		}
	}

	function &getMenuItemByName($id) {
		if (isset($this->menuNodeByNameMap[$id])) {
			return $this->menuNodeByNameMap[$id];
		} else {
			$result		= NULL;
			return $result;
		}
	}

	function getLevelByMenuItem(&$menuNode) {
		$rootMenuNode	=& $this->getRootMenuNode();
		$parentMenuNode	=& $this->getParent();
		if (is_null($parentMenuNode)) {
			return 0;
		}
		if ($rootMenuNode->equals($parentMenuNode)) {
			return 0;
		}
		return 1 + $this->getLevelByMenuItem($parentMenuNode);
	}

	function &getMenuItemByLevel($level) {
		$rootMenuNode	=& $this->getRootMenuNode();
		$menuNode		=& $this->getMenuItemByMenuNodeAndLevel($rootMenuNode, $level);
		return $menuNode;
	}

	function &getMenuItemByMenuNodeAndLevel(&$menuNode, $level) {
		$result			= NULL;
		if (is_null($menuNode)) {
			return $result;
		}
		if ($level < 0) {
			$parentMenuNode	=& $menuNode->getParent();
			if (!is_null($parentMenuNode)) {
				$result			=& $this->getMenuItemByMenuNodeAndLevel($parentMenuNode, $level + 1);
			}
			return $result;
		}
		if ($level == 0) {
			return $menuNode;
		}
		$children		=& $menuNode->getChildNodeList();
		foreach(array_keys($children) as $key) {
			$child			=& $children[$key];
			if ($child->isActive()) {
				if ($level == 1) {
					return $child;
				}
				$result		=& $this->getMenuItemByMenuNodeAndLevel($child, $level - 1);
			}
		}
		return $result;
	}

	function &getMenuNodeList() {
		$rootMenuNode	=& $this->getRootMenuNode();
		$menuNodeList	=& $rootMenuNode->getChildNodeList();
		return $menuNodeList;
	}

	function checkCurrentItemDuplicates($convertToActive = TRUE) {
		$rootMenuNode	=& $this->getRootMenuNode();
		return $this->checkCurrentItemDuplicatesByMenuNode($rootMenuNode, $convertToActive);
	}

	function checkCurrentItemDuplicatesByMenuNode(&$parentMenuNode, $convertToActive = TRUE, $ignoreFirst = TRUE) {
		$result			= 0;
		$menuNodeList	=& $parentMenuNode->getChildNodeList();
		foreach(array_keys($menuNodeList) as $key) {
			$menuNode		=& $menuNodeList[$key];
			if ($menuNode->isCurrent()) {
				if (!$ignoreFirst) {
					$menuNode->setCurrent(FALSE);
					if ($convertToActive) {
						$menuNode->setActive(TRUE);
					} else {
						$menuNode->setActive(FALSE);
					}
				} else {
					$ignoreFirst		= FALSE;
				}
				$result	+= 1;
			} else if ($menuNode->isActive()) {
				$count		= $this->checkCurrentItemDuplicatesByMenuNode($menuNode, $convertToActive, $ignoreFirst);
				if ($count > 0) {
					if (!$ignoreFirst) {
						if (!$convertToActive) {
							$menuNode->setActive(FALSE);
						}
					} else {
						$ignoreFirst		= FALSE;
					}
				}
				$result	+= $count;
			}
		}
		return $result;
	}

	/**
	 * Cleans memory of the menu nodes and current status as much as possible.
	 *
	 * @see AbstractNode#freeAll()
	 * @since 1.0.4
	 */
	function freeAll() {
		if ((isset($this->rootMenuNode)) && (is_object($this->rootMenuNode))) {
			$this->rootMenuNode->freeAll();
			unset($this->rootMenuNode);
		}
		unset($this->menuNodeByIdMap);
		unset($this->menuNodeByNameMap);
	}

}

?>
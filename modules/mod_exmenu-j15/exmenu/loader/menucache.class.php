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
class AbstractExtendedMenuCache extends AbstractExtendedMenuDatabaseHelper {

	var $order;

	function getOrderBy($order, $namePrefix = '') {
		$orderBy		= array();
		switch($order) {
			case 'ordering':
				$orderBy[]	= $namePrefix.'ordering';
				break;
			case 'ordering_desc':
				$orderBy[]	= $namePrefix.'ordering DESC';
				break;
			case 'title':
				$orderBy[]	= $namePrefix.'title';
				break;
			case 'title_desc':
				$orderBy[]	= $namePrefix.'title DESC';
				break;
			case 'time':
				$orderBy		= $this->getOrderBy('title', $namePrefix);
				break;
			case 'time_desc':
				$orderBy		= $this->getOrderBy('title_desc', $namePrefix);
				break;
		}
		$orderBy[]	= $namePrefix.'id';
		return $orderBy;
	}

	function &getFilteredListByProperty(&$list, $propertyName, $value) {
		$result	= array();
		foreach(array_keys($list) as $key) {
			$obj		=& $list[$key];
			if ($obj->$propertyName == $value) {
				$result[]	=& $obj;
			}
		}
		return $result;
	}

	function getUserAccessId() {
		$result = 0;
		if (class_exists('JFactory')) {
			$user =& JFactory::getUser();
			if (is_object($user)) {
				$result = intval($user->get('aid'));
			}
		} else if (isset($GLOBALS['my'])) {
			$user =& $GLOBALS['my'];
			if (is_object($user)) {
				$result = intval($user->gid);
			}
		}
		return $result;
	}

}

/**
 * @since 1.0.0
 */
class SectionExtendedMenuCache extends AbstractExtendedMenuCache {

	var $sectionList		= array();

	function loadBySectionIds($ids) {
		$database =& $this->getDatabase();
		$sql			= 'SELECT * FROM #__sections WHERE '.$this->getSqlIdEquals('id', $ids);
		$orderBy		= $this->getSectionOrderBy('');
		if (count($orderBy) > 0) {
			$sql			.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$sectionList			= $database->loadObjectList('id');
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->sectionList	=& $sectionList;
		return TRUE;
	}

	function &getSectionList() {
		return $this->sectionList;
	}

	function &getSectionById($id) {
		if (isset($this->sectionList[$id])) {
			return $this->sectionList[$id];
		} else {
			$result		= NULL;
			return $result;
		}
	}

	function getSectionOrderBy($namePrefix = '') {
		$orderBy		= $this->getOrderBy($this->order, $namePrefix);
		return $orderBy;
	}

}

/**
 * @since 1.0.0
 */
class CategoryExtendedMenuCache extends AbstractExtendedMenuCache {

	var $categoryList		= array();
	var $sectionOrder;

	function loadBySectionIds($ids, $orderBySection = TRUE) {
		$database =& $this->getDatabase();
		$select		= array();
		$select[]	= 'cat.*';
		$from		= array();
		$from[]		= '#__categories AS cat';
		$where		= array();
		$where[]		= $this->getSqlIdEquals('section', $ids);
		if ($orderBySection) {
			$from[]		= '#__sections AS sect';
			$where[]		= 'cat.section = sect.id';
			$orderBy		= array_merge($this->getSectionOrderBy('sect.'), $this->getCategoryOrderBy('cat.'));
		} else {
			$orderBy		= $this->getCategoryOrderBy('cat.');
		}
		$where[]		= 'cat.published = 1'; // #4260 hide unpublished categories
		$sql			= 'SELECT '.implode(', ', $select).' FROM '.implode(', ', $from);
		if (count($where) > 0) {
			$sql			.= ' WHERE '.implode(' AND ', $where);
		}
		$orderBy		= $this->getCategoryOrderBy('');
		if (count($orderBy) > 0) {
			$sql			.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$categoryList			= $database->loadObjectList('id');
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->categoryList	=& $categoryList;
		return TRUE;
	}

	function loadByCategoryIds($ids) {
		$database =& $this->getDatabase();
		$sql			= 'SELECT * FROM #__categories WHERE '.$this->getSqlIdEquals('id', $ids);
		$orderBy		= $this->getCategoryOrderBy('');
		if (count($orderBy) > 0) {
			$sql			.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$categoryList			= $database->loadObjectList('id');
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->categoryList	=& $categoryList;
		return TRUE;
	}

	function &getCategoryById($id) {
		if (isset($this->categoryList[$id])) {
			return $this->categoryList[$id];
		} else {
			$result		= NULL;
			return $result;
		}
	}

	function &getCategoryList() {
		return $this->categoryList;
	}

	function &getCategoryListBySectionId($id) {
		$categoryList			=& $this->getFilteredListByProperty($this->categoryList, 'section', $id);
		return $categoryList;
	}

	function getCategoryOrderBy($namePrefix = '') {
		$orderBy		= $this->getOrderBy($this->order, $namePrefix);
		return $orderBy;
	}

	function getSectionOrderBy($namePrefix = '') {
		$orderBy		= $this->getOrderBy($this->sectionOrder, $namePrefix);
		return $orderBy;
	}

}

/**
 * @since 1.0.0
 */
class ContentItemExtendedMenuCache extends AbstractExtendedMenuCache {

	var $contentItemList		= array();
	var $categoryOrder;

	function loadBySectionIds($ids, $orderByCategory = TRUE) {
		global $mosConfig_shownoauth;
		$database =& $this->getDatabase();
		$nullDate	= $this->getSqlNullDate();
		$now			= $this->getSqlNow();
		$sql	= 'SELECT c.id, c.title, c.catid, c.sectionid, cat.ordering AS cat_ordering FROM #__content AS c, #__categories AS cat WHERE '.
			$this->getSqlIdEquals('sectionid', $ids).' AND c.catid = cat.id';
		if (!$mosConfig_shownoauth) {
			$sql		.= ' AND c.access <= '.$this->getUserAccessId();
		}
		$sql		.= ' AND c.state = 1'.
			' AND (c.publish_up = \''.$nullDate.'\' OR c.publish_up <= \''.$now.'\')'.
			' AND (c.publish_down = \''.$nullDate.'\' OR c.publish_down >= \''.$now.'\')';
		if ($orderByCategory) {
			$orderBy		= array_merge($this->getCategoryOrderBy('cat.'), $this->getContentItemOrderBy('c.'));
		} else {
			$orderBy		= $this->getContentItemOrderBy('c.');
		}
		if (count($orderBy) > 0) {
			$sql		.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$contentItemList		= $database->loadObjectList('id');
//		echo 'sql=['.$sql.']<br/>';
//		echo 'contentItemList=['.print_r($contentItemList, TRUE).']<br/>';
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->contentItemList		=& $contentItemList;
		return TRUE;
	}

	function loadBySectionId($id, $orderByCategory = TRUE) {
		return $this->loadBySectionIds($id, $orderByCategory);
	}

	function loadByCategoryIds($ids) {
		global $mosConfig_shownoauth;
		$database =& $this->getDatabase();
		$nullDate	= $this->getSqlNullDate();
		$now			= $this->getSqlNow();
		$sql	= 'SELECT c.id, c.title, c.catid FROM #__content AS c WHERE '.$this->getSqlIdEquals('catid', $ids);
		if (!$mosConfig_shownoauth) {
			$sql	.= ' AND access <= '.$this->getUserAccessId();
		}
		$sql	.= ' AND state = 1'.
			' AND (publish_up = \''.$nullDate.'\' OR publish_up <= \''.$now.'\')'.
			' AND (publish_down = \''.$nullDate.'\' OR publish_down >= \''.$now.'\')';
		$orderBy		= $this->getContentItemOrderBy('c.');
		if (count($orderBy) > 0) {
			$sql		.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$contentItemList		= $database->loadObjectList('id');
//		echo 'sql=['.$sql.']<br/>';
//		echo 'contentItemList=['.print_r($contentItemList, TRUE).']<br/>';
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->contentItemList		=& $contentItemList;
		return TRUE;
	}

	function loadByCategoryId($id) {
		return $this->loadByCategoryIds($id);
	}

	function loadByContentItemIds($ids) {
		global $mosConfig_shownoauth;
		$database =& $this->getDatabase();
		$nullDate	= $this->getSqlNullDate();
		$now			= $this->getSqlNow();
		$sql		= 'SELECT c.id, c.title, c.catid FROM #__content AS c WHERE '.$this->getSqlIdEquals('id', $ids);
		if (!$mosConfig_shownoauth) {
			$sql		.= ' AND access <= '.$this->getUserAccessId();
		}
		$sql		.= ' AND state = 1'.
			' AND (publish_up = \''.$nullDate.'\' OR publish_up <= \''.$now.'\')'.
			' AND (publish_down = \''.$nullDate.'\' OR publish_down >= \''.$now.'\')';
		$orderBy		= $this->getContentItemOrderBy('c.');
		if (count($orderBy) > 0) {
			$sql		.= ' ORDER BY '.implode(', ', $orderBy);
		}
		$database->setQuery($sql);
		$contentItemList		= $database->loadObjectList('id');
		if ($this->checkDatabaseError()) {
			return FALSE;
		}
		$this->contentItemList		=& $contentItemList;
		return TRUE;
	}

	function &getContentItemList() {
		return $this->contentItemList;
	}

	function &getContentListBySectionId($id) {
		$contentItemList			=& $this->getFilteredListByProperty($this->contentItemList, 'sectionid', $id);
		return $contentItemList;
	}

	function &getContentListByCategoryId($id) {
		$contentItemList			=& $this->getFilteredListByProperty($this->contentItemList, 'catid', $id);
		return $contentItemList;
	}

	function getContentItemOrderBy($namePrefix = '') {
		$orderBy		= array();
		switch($this->order) {
			case 'time':
				$orderBy[]	= $namePrefix.'modified';
				$orderBy[]	= $namePrefix.'created';
				$orderBy[]	= $namePrefix.'ordering';
				break;
			case 'time_desc':
				$orderBy[]	= $namePrefix.'modified DESC';
				$orderBy[]	= $namePrefix.'created DESC';
				$orderBy[]	= $namePrefix.'ordering';
				break;
			default:
				$orderBy		= $this->getOrderBy($this->order, $namePrefix);
		}
		return $orderBy;
	}

	function getCategoryOrderBy($namePrefix = '') {
		$orderBy		= $this->getOrderBy($this->order, $namePrefix);
		return $orderBy;
	}

}

class ExtendedMenuCacheFactory {

	function &getNewInstance($cacheType = '') {
		$result		= NULL;
		switch($cacheType) {
			case 'section':
				$result		=& new SectionExtendedMenuCache();
				break;
			case 'category':
				$result		=& new CategoryExtendedMenuCache();
				break;
			case 'content':
			case 'content_item':
				$result		=& new ContentItemExtendedMenuCache();
				break;
			default:
				break;
		}
		return $result;
	}
}

?>
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
 * Abstract class for nodes... may be used for other kind of nodes than just menu nodes.
 */
class AbstractNode {
	var $childList		= array();
	var $hasChildren		= FALSE;
	var $_objectId		= NULL;

	function AbstractNode() {
		static $idCounter	= 0;
		$idCounter++;
		$this->_objectId		= $idCounter;
	}

	function addChildNode(&$child, $offset = FALSE) {
		if ((!is_object($child)) || (is_null($child))) {
			trigger_error('Attempt to add a non-object.', E_USER_NOTICE);
			return FALSE;
		}
		$result	= count($this->childList);
		if (($offset !== FALSE) && ($offset < $result)) {
			$a		= array();
			$a[]		=& $child;
			array_splice($this->childList, $offset, 0, $a);
//			$this->childList[]	=& $child;	// TODO fix this
		} else {
			$this->childList[]	=& $child;
		}
		$this->hasChildren	= TRUE;
		$child->setParent($this);
		return $result;
	}

	function removeChildNode(&$child) {
		$offset	= 0;
		foreach(array_keys($this->childList) as $key) {
			if ($child->equals($this->childList[$key])) {
				array_splice($this->childList, $offset, 1);
				break;
			}
			$offset++;
		}
		$this->hasChildren	= (count($this->childList) > 0);
		$nullMenuNode	= NULL;
		$child->setParent($nullMenuNode);
		return TRUE;
	}

	function addChildNodes(&$children, $offset = FALSE) {
		$result	= FALSE;
		foreach(array_keys($children) as $key) {
			$i	= $this->addChildNode($children[$key], $offset);
			if ($result === FALSE) {
				$result		= $i;
			}
			if ($offset !== FALSE) {
				$offset++;
			}
		}
		/*
		foreach(array_keys($children) as $key) {
			$child				=& $children[$key];
			$this->childList[]	=& $child;
			$child->setParent($this);
		}
		$this->hasChildren	= TRUE;
		*/
		return $result;
	}

	function replaceChildNodes(&$oldMenuNodeList, &$newMenuNodeList) {
		if (count($oldMenuNodeList) <= 0) {
			foreach(array_keys($newMenuNodeList) as $k) {
				$this->addChildNode($newMenuNodeList[$k]);
			}
		} else {
			$children		=& $this->getChildNodeList();
			$offset			= FALSE;
			$i				= 0;
			foreach(array_keys($children) as $k1) {
				$child	=& $children[$k1];
				if (!is_object($child)) {
					var_dump($child);
				}
				foreach(array_keys($oldMenuNodeList) as $k2) {
					$child2	=& $oldMenuNodeList[$k2];
					if ($child->equals($child2)) {
						$offset	= $i;
						break;
					}
				}
				if ($offset !== FALSE) {
					break;
				}

				$i++;
			}
			$this->removeChildNodes($oldMenuNodeList);
			if ($offset !== FALSE) {
				$this->addChildNodes($newMenuNodeList, $offset);
			}
		}
	}

	function removeChildNodes(&$children) {
		$result		= TRUE;
		foreach(array_keys($children) as $key) {
			$result		= (($this->removeChildNode($children[$key]) && ($result)));
		}
		return $result;
	}

	function &getChildNodeList() {
		return $this->childList;
	}

	function hasChildren() {
		return $this->hasChildren;
	}


	/**
	 * @since 1.0.0
	 */
	function setParent(&$menuNode) {
		$this->_parent		=& $menuNode;
	}

	/**
	 * @since 1.0.0
	 */
	function &getParent() {
		return $this->_parent;
	}

	/**
	 * @since 1.0.0
	 */
	function getObjectId() {
		return $this->_objectId;
	}

	/**
	 * @since 1.0.0
	 */
	function equals(&$menuNode) {
		return ($this->_objectId == $menuNode->_objectId);
	}


	/**
	 * Cleans memory of this node and the children as much as possible.
	 *
	 * @since 1.0.4
	 */
	function freeAll() {
		static $nullValue	= null;
		if (isset($this->childList)) {
			if ((isset($this->childList)) && (is_array($this->childList))) {
				$children	=& $this->childList;
				foreach(array_keys($children) as $key) {
					$children[$key]->freeAll();
					unset($children[$key]);
				}
				array_splice($this->childList, 0);
				unset($this->childList);
			}

			if (isset($this->hasChildren)) {
				unset($this->hasChildren);
			}

			if ((isset($this->_parent)) && (is_object($this->_parent))) {
				$this->_parent	=& $nullValue;
				unset($this->_parent);
			}

			if (isset($this->_objectId)) {
				unset($this->_objectId);
			}
		}
	}
}


/**
 * Class for menu nodes.
 */
class MenuNode extends AbstractNode {
	var $current		= FALSE;
	var $active		= FALSE;
	var $expanded	= FALSE;
	var $accessKey	= '';

	function isCurrent() {
		return $this->current;
	}

	function isActive() {
		return ($this->current) || ($this->active);
	}

	function isExpanded() {
		return $this->expanded;
	}

	function isSeparator() {
		return $this->type == 'separator';
	}

	function setExpanded($expanded = TRUE) {
		$this->expanded	= $expanded;
	}

	/**
	 * @since 1.0.0
	 */
	function setCurrent($current = TRUE) {
		$this->current	= $current;
	}

	/**
	 * @since 1.0.0
	 */
	function setActive($active = TRUE) {
		$this->active	= $active;
	}

	/**
	 * @since 1.0.0
	 */
	function hasCaption() {
		return $this->name != '';
	}

	/**
	 * @since 1.0.0
	 */
	function getCaption() {
		return $this->name;
	}

	/**
	 * @since 1.0.0
	 */
	function setCaption($caption) {
		$this->name	= $caption;
	}


	/**
	 * @since 1.0.4
	 */
	function getCategoryId() {
		return (isset($this->categoryId) ? $this->categoryId : 0);
	}

	/**
	 * @since 1.0.4
	 */
	function setCategoryId($categoryId) {
		$this->categoryId	= $categoryId;
	}


	/**
	 * @since 1.0.4
	 */
	function getSectionId() {
		return (isset($this->sectionId) ? $this->sectionId : 0);
	}

	/**
	 * @since 1.0.4
	 */
	function setSectionId($sectionId) {
		$this->sectionId	= $sectionId;
	}


	function expand($level = 1) {
		if ($level < 1) {
			return FALSE;
		}
		$this->setExpanded(TRUE);
		if ($level > 1) {
			$children	=& $this->getChildNodeList();
			foreach(array_keys($children) as $k) {
				$menuNode	=& $children[$k];
				$menuNode->expand($level - 1);
			}
		}
	}

	function addChildNode(&$child, $offset = FALSE) {
		if ($child->isActive()) {
			$this->setCurrent(FALSE);
			$this->setActive(TRUE);
			$this->setExpanded(TRUE);	// TODO remove this
		}
		return parent::addChildNode($child, $offset);
	}

}

?>
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
 * Abstract class for all menu nodes.
 */
class AbstractExtendedMenuView {

	var $siteHelper = NULL;
	var $classSuffix;
	var $idSuffix;
	var $maxDepth					= 10;
	var $openActiveOnly				= TRUE;
	var $menuLevel					= 0;
	var $activeMenuClassLink			= FALSE;
	var $activeMenuClassContainer	= FALSE;
	var $titleAttribute				= FALSE;
	var $hierarchyBasedIds			= FALSE;
	var $sublevelClasses				= FALSE;
	var $mainlevelClasses			= FALSE;
	var $callGetItemid				= TRUE;
	var $menuHierarchy				= array();
	var $imageEnabled				= FALSE;
	var $imageAlignment				= '';
	var $lastLinkBegin				= '';
	var $lastLinkEnd					= '';
	var $addUrlItemidMode			= 'local';
	var $params;

	/**
	 * @since 1.1.0
	 */
	function &getSiteHelper() {
		return $this->siteHelper;
	}


	function getAbsolutePath($name = '') {
		$siteHelper =& $this->getSiteHelper();
		return $siteHelper->getAbsolutePath($name);
	}


	function getUri($name = FALSE) {
		$siteHelper =& $this->getSiteHelper();
		return $siteHelper->getUri($name);
	}


	function getSiteTemplateName() {
		$siteHelper =& $this->getSiteHelper();
		return $siteHelper->getSiteTemplateName();
	}


	function getSiteTemplateUri($name = FALSE) {
		$siteHelper =& $this->getSiteHelper();
		return $siteHelper->getSiteTemplateUri($name);
	}


	function getExtractedAttribute($html, $attributeName) {
		$s	= $attributeName.'="';
		$i	= strpos($html, $s);
		if ($i !== FALSE) {
			$i	+= strlen($s);
			$j	= strpos($html, '"', $i);
			if ($j !== FALSE) {
				return substr($html, $i, $j - $i);
			}
		}
		return '';
	}

	function getExtractedHref($html) {
		return $this->getExtractedAttribute($html, 'href');
	}

	function getExtractedOnClick($html) {
		return $this->getExtractedAttribute($html, 'onclick');
	}

	function getExtractedTarget($html) {
		return $this->getExtractedAttribute($html, 'target');
	}

	function getHierarchyString($hierarchy) {
		$result	= implode('_', $hierarchy);
		if ($result == '') {
			$result	= 'root';
		}
		return $result;
	}

	/**
	 * @since version 0.3.0
	 */
	function getMenuClassName(&$menuNode, $level = 0, $activeMenuClass = FALSE) {
		if ($level > 0) {
			$menuClass = 'sublevel';
		} else {
			$menuClass = 'mainlevel';
		}
		if (($activeMenuClass) && ($menuNode->isActive())) {
			if ($menuNode->isCurrent()) {
				$menuClass	.= '_current';
			} else {
				$menuClass	.= '_active';
			}
		}
		$menuClass	.= $this->classSuffix;
		return $menuClass;
	}

	/**
	 * @since version 0.3.0
	 */
	function getLinkMenuClassName(&$menuNode, $level = 0) {
		return $this->getMenuClassName($menuNode, $level, $this->activeMenuClassLink);
	}

	/**
	 * @since version 0.3.0
	 */
	function getContainerMenuClassName(&$menuNode, $level = 0) {
		return $this->getMenuClassName($menuNode, $level, $this->activeMenuClassContainer);
	}

	function getMenuLink(&$menuNode, $level = 0, $itemHierarchy = NULL) {
		if (!is_array($itemHierarchy)) {
			$itemHierarchy		= array();
		}
		return trim($this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy));
	}

	function hasItemid($url) {
		return (strpos($url, '&Itemid=') !== FALSE) || (strpos($url, '?Itemid=') !== FALSE);
	}

	function addItemid($url, $Itemid) {
		if (($Itemid) && (!$this->hasItemid($url))) {
			$url .= (strpos($url, '?') === FALSE ? '?' : '&').'Itemid='. $Itemid;
		}
		return $url;
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
	* Utility function for writing a menu link
	* (modification of the original menu module mosGetMenuLink function)
	*/
	function mosGetMenuLink($menuNode, $level=0, &$params, $itemHierarchy) {
		global $Itemid, $mainframe; // only used if it is not Joomla 1.5+

		$siteHelper =& $this->getSiteHelper();

		$menuItemParametersString = (isset($menuNode->params) ? $menuNode->params : '');
		$menuItemParameters = FALSE;

		$txt = '';

		$gotFinalLink = FALSE;

		switch ($menuNode->type) {
			case 'separator':
				$menuNode->browserNav	= 3;
				break;
			case 'component_item_link':
				break;
			case 'content_item_link':
				if (!$this->hasItemid($menuNode->link)) {
					$temp = split('&task=view&id=', $menuNode->link);
					if (count($temp) != 2) {
						$temp = split('&view=article&id=', $menuNode->link);
					}
					if ((($this->callGetItemid) || ($menuNode->id === FALSE)) &&
							(count($temp) == 2)) {
						$contentId = $temp[1];
						if (function_exists('jimport')) {
							require_once(JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
							$menuNode->link = ContentHelperRoute::getArticleRoute(
									$contentId, $menuNode->getCategoryId(), $menuNode->getSectionId());
							$gotFinalLink = FALSE;
							$id = FALSE;
						} else if ($menuNode->id !== FALSE) {
							$_Itemid	= $Itemid;
							$Itemid		= $menuNode->id;	// getItemid uses the global variable as a default value... use the id of the menu item instead
							$id			= $mainframe->getItemid($temp[1]);
							$Itemid		= $_Itemid;
						} else {
							$id			= $mainframe->getItemid($temp[1]);
						}
					} else {
						$id	= $menuNode->id;
					}
					if ($id > 0) {
						$menuNode->link .= '&Itemid='.$id;
					}
				}
				break;
			case 'url':
				switch($this->addUrlItemidMode) {
					case 'local':
						$rootUri = $siteHelper->getUri();
						if ((strpos(strtolower($menuNode->link), 'index.php?') !== FALSE) &&
								(($rootUri == '') || (strpos($menuNode->link, ':') === FALSE) ||
										(strpos($menuNode->link, $rootUri) === 0))) {
							$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
						}
						break;
					case 'default':
					default:
						if (strpos(strtolower($menuNode->link), 'index.php?') !== FALSE) {
							$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
						}
				}
				break;
			case 'content_typed':
			default:
				$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
				break;
		}

		// Active Menu highlighting
		// why reading the request parameter when there is a global variable?
//			$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );

		$title	= strip_tags($menuNode->name);

		// use a more meaningful name than "id": elementParameters
		$elementParameters	= '';
		if (($this->hierarchyBasedIds) && (count($itemHierarchy) > 0)) {
			$elementParameters	.= ' id="menulink_'.$this->getHierarchyString($itemHierarchy).$this->idSuffix.'"';
		} else if ($menuNode->isCurrent()) {
			$elementParameters	.= ' id="active_menu'.$this->idSuffix.'"';
		}
		if ((isset($menuNode->accessKey)) && ($menuNode->accessKey != '')) {
			$elementParameters	.= ' accesskey="'.$menuNode->accessKey.'"';
			$title	.= ' ['.strtoupper($menuNode->accessKey).']';
		}

		if ($this->titleAttribute) {
			$elementParameters	.= ' title="'.$title.'"';
		}

		if (!$gotFinalLink) {
			$shouldSefLink = ((strcasecmp(substr($menuNode->link, 0, 4), 'http') != 0) &&
					(strcasecmp(substr($menuNode->link, 0, 1), '#') != 0));
			if (class_exists('JRoute')) {
				if ($shouldSefLink) {
					if (!is_object($menuItemParameters)) {
						$menuItemParameters =& $this->getParsedParameters($menuItemParametersString);
					}
					$secure = $menuItemParameters->def('secure', 0);
					$menuNode->link = JRoute::_($menuNode->link, true, $secure);
				} else {
					$menuNode->link = ampReplace($menuNode->link);
				}
			} else {
				$menuNode->link = ampReplace($menuNode->link);
				if ($shouldSefLink) {
					// no secure link support for older versions
					$menuNode->link = sefRelToAbs($menuNode->link);
				}
			}
		}

		$menuclass	= $this->getLinkMenuClassName($menuNode, $level);

		$linkBegin	= '';
		$linkText	= $menuNode->name;
		$linkEnd	= '';

		switch ($menuNode->browserNav) {
			// cases are slightly different
			case 1:
				// open in a new window
				$linkBegin	= '<a href="'. $menuNode->link .'" target="_blank" class="'. $menuclass .'"'. $elementParameters .'>';
				$linkEnd	= '</a>';
//					$txt = '<a href="'. $menuNode->link .'" target="_blank" class="'. $menuclass .'"'. $elementParameters .'>'. $menuNode->name .'</a>';
				break;

			case 2:
				// open in a popup window
				$linkBegin	= "<a href=\"#\" onclick=\"javascript: window.open('". $menuNode->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\"". $elementParameters .">";
				$linkEnd	= "</a>\n";
//					$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $menuNode->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\"". $elementParameters .">". $menuNode->name ."</a>\n";
				break;

			case 3:
				// don't link it
				$linkBegin	= '<span class="'. $menuclass .'"'. $elementParameters .'>';
				$linkText	= ($menuNode->name != '' ? $menuNode->name : '&nbsp;');
				$linkEnd	= '</span>';
//					$txt = '<span class="'. $menuclass .'"'. $elementParameters .'>'. ($menuNode->name != '' ? $menuNode->name : '&nbsp;') .'</span>';
				break;

			default:	// formerly case 2
				// open in parent window
				$linkBegin	= '<a href="'. $menuNode->link .'" class="'. $menuclass .'"'. $elementParameters .'>';
				$linkEnd	= '</a>';
//					$txt = '<a href="'. $menuNode->link .'" class="'. $menuclass .'"'. $elementParameters .'>'. $menuNode->name .'</a>';
				break;
		}

		$txt	= $linkBegin.$linkText.$linkEnd;

		if ($this->imageEnabled) {
			if (!is_object($menuItemParameters)) {
				$menuItemParameters =& $this->getParsedParameters($menuItemParametersString);
			}
			$menu_image = $menuItemParameters->def('menu_image', -1);
			if ( ( $menu_image <> '-1' ) && $menu_image ) {
				$image = '<img src="'.$siteHelper->getUri('images/stories/'.$menu_image).'" border="0" alt="'. $menuNode->name .'"/>';
				switch($this->imageAlignment) {
					case 'image_only':	// does not really make sense
						$txt	= $image;
						break;
					case 'image_only_linked':
						$txt	= $linkBegin.$image.$linkEnd;
						break;
					case 'right':
						$txt	= $txt.' '.$image;
						break;
					case 'right_linked':
						$txt	= $linkBegin.$linkText.' '.$image.$linkEnd;
						break;
					case 'left_linked':
						$txt	= $linkBegin.$image.' '.$linkText.$linkEnd;
						break;
					case 'left':
					default:
						$txt	= $image.' '.$txt;
				}
			}
		}

		$this->lastLinkBegin	= $linkBegin;
		$this->lastLinkEnd		= $linkEnd;

		return $txt;
	}
}

?>
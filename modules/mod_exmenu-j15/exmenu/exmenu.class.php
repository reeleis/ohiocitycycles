<?php
/**
* @version $Id:$
* @author Daniel Ecer
* @package exmenu
* @copyright (C) 2005-2009 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined('_VALID_MOS') or defined('_JEXEC') or die('Restricted access.');

if (!defined('EXTENDED_MENU_HOME')) {
	define('EXTENDED_MENU_HOME', dirname(__FILE__));
}

define('EXTENDED_MENU_ACCESS_KEYS_NONE', 0);
define('EXTENDED_MENU_ACCESS_KEYS_PARSE', 1);
define('EXTENDED_MENU_ACCESS_KEYS_STRIP', 2);
define('EXTENDED_MENU_ACCESS_KEYS_STRIP_MARKUP', 3);
define('EXTENDED_MENU_ACCESS_KEYS_STRIP_AND_EMPHASE', 4);

if (!function_exists('ampReplace')) {
	function ampReplace( $text ) {
		$text = str_replace( '&#', '*-*', $text );
		$text = str_replace( '&', '&amp;', $text );
		$text = str_replace( '&amp;amp;', '&amp;', $text );
		$text = str_replace( '*-*', '&#', $text );

		return $text;
	}
}

require_once(EXTENDED_MENU_HOME.'/util/sitehelper.class.php');
require_once(EXTENDED_MENU_HOME.'/model/menunode.class.php');
require_once(EXTENDED_MENU_HOME.'/loader/factory.menuloader.class.php');
require_once(EXTENDED_MENU_HOME.'/view/factory.menuview.class.php');


class ExtendedMenuModule {

	var $params;
	var $patTemplateDirectory				= '';
	var $patTemplateFile					= '';
	var $patTemplateConfigFile				= '';
	var $siteHelper = NULL;

	function cloneObject($object) {
		if (version_compare(phpversion(), '5.0') < 0) {
			return $object;
		} else {
			return clone($object);
		}
	}

	function showModule(&$params) {
		$module				=& new ExtendedMenuModule();
		$module->params		=& $params;
		$module->render();
	}

	function initDefaultParameters(&$params) {
		$params->def( 'menutype', 'mainmenu' );
		$params->def( 'class_sfx', '' );
		$params->def( 'menu_images', 0 );
		$params->def( 'expand_menu', 0 );
		$params->def( 'indent_image', 0 );
		$params->def( 'indent_image1', 'indent1.png' );
		$params->def( 'indent_image2', 'indent2.png' );
		$params->def( 'indent_image3', 'indent3.png' );
		$params->def( 'indent_image4', 'indent4.png' );
		$params->def( 'indent_image5', 'indent5.png' );
		$params->def( 'indent_image6', 'indent.png' );
		$params->def( 'spacer', '' );
		$params->def( 'end_spacer', '' );

		$params->def('expand_min', '');
		$params->def('max_depth', 10);
		$params->def('hide_first', 0);

		$params->def('current_level_begin', 0);
		$params->def('level_begin', 0);
		$params->def('split_menu', 0);
		$params->def('menu_count', 1);
		$params->def('query_cache', 0 );

		$params->def('parse_access_key', 3);
		$params->def('title_attribute', 0);
		$params->def('level_class', 0);
		$params->def('active_menu_class', 0);
		$params->def('element_id', 0);
		$params->def('menu_template', 0);
		$params->def('menu_template_name', '');
	}

	function removeFileExtension($fileName) {
		$i	= strrpos($fileName, '.');
		if (($i !== FALSE) && ($i > 0)) {
			$j		= strrpos($fileName, '/');
			$k		= strrpos($fileName, '\\');
			if ((($j === FALSE) || ($i > $j)) && (($k === FALSE) || ($i > $k))) {
				$fileName			= substr($fileName, 0, $i);
			}
		}
		return $fileName;
	}

	function initMenuTemplate(&$params) {
		$siteHelper =& $this->siteHelper;
		$absolutePath = $siteHelper->getAbsolutePath();
		$siteTemplate = $siteHelper->getSiteTemplateName();

		$menuTemplate					= intval($params->get('menu_template'));
		$patTemplateFile				= trim($params->get('menu_template_name'));
		$patTemplateConfigFile			= $this->removeFileExtension($patTemplateFile).'.ini';

		// check for the patTemplate file (need to be done before reading the other module parameters)
		$patTemplateDirectory			= $absolutePath.'/templates/'.$siteTemplate;
		if (($menuTemplate > 0) && ($patTemplateFile != '')) {
			if ((substr($patTemplateFile, 0, 1) == '/') || (strpos($patTemplateFile, ':') !== FALSE)) {
				if ((file_exists($absolutePath.$patTemplateFile)) ||
						(file_exists($absolutePath.$patTemplateConfigFile))) {
					$patTemplateDirectory			= dirname($absolutePath.$patTemplateFile);
					$patTemplateFile					= basename($patTemplateFile);
				} else if ((file_exists($patTemplateFile)) ||
						(file_exists($patTemplateConfigFile))) {
					$patTemplateDirectory			= dirname($patTemplateFile);
					$patTemplateFile					= basename($patTemplateFile);
				}
			} else if ((file_exists($patTemplateDirectory.'/'.$patTemplateFile)) ||
					(file_exists($patTemplateDirectory.'/'.$patTemplateConfigFile))) {
			} else if ((file_exists($patTemplateDirectory.'/tmpl/'.$patTemplateFile)) ||
					(file_exists($patTemplateDirectory.'/tmpl/'.$patTemplateConfigFile))) {
				$patTemplateDirectory				= $patTemplateDirectory.'/tmpl';
			} else {
				return FALSE;
			}

			// normalize template directory/file
			$patTemplateFile						= $patTemplateDirectory.'/'.$patTemplateFile;
			$patTemplateDirectory				= dirname($patTemplateFile);
			$patTemplateFile						= basename($patTemplateFile);
			$patTemplateConfigFile				= basename($patTemplateConfigFile);

			if (($patTemplateFile != $patTemplateConfigFile) && (file_exists($patTemplateDirectory.'/'.$patTemplateFile))) {
				$params->set('menu_style', 'patTemplate');
			}

			// read configuration file (if present)
			if (file_exists($patTemplateDirectory.'/'.$patTemplateConfigFile)) {
				$lines	= file($patTemplateDirectory.'/'.$patTemplateConfigFile);
				foreach($lines as $line) {
					$line	= trim($line);
					if ($line == '') {
						continue;
					}
					switch(substr($line, 0, 1)) {
						case '/':
						case '#':
						case ';':
							break;
						case '[':
							break;
						default:
							$i		= strpos($line, '=');
							if ($i !== FALSE) {
								$params->set(trim(substr($line, 0, $i)), trim(substr($line, $i+1)));
							}
					}
				}
			}
			$this->patTemplateDirectory		= $patTemplateDirectory;
			$this->patTemplateFile			= $patTemplateFile;
			$this->patTemplateConfigFile		= $patTemplateConfigFile;
			return TRUE;
		}
		return FALSE;
	}

	function applyAccessKeys(&$menuLoader, &$menuNodeList, $accessKeys) {
		if (!is_array($accessKeys)) {
			$accessKeys		= explode(',', $accessKeys);
		}
		if (count($accessKeys) > 0) {
			$iAccessKey			= 0;
			$menuItemListKeys	= array_keys($menuNodeList);
			foreach($accessKeys as $accessKeyStr) {
				$i	= strpos($accessKeyStr, '=');
				if ($i !== FALSE) {
					$id			= trim(substr($accessKeyStr, 0, $i));
					$accessKey	= trim(substr($accessKeyStr, $i + 1));
					$menuNode	=& $menuLoader->getMenuItemById((is_numeric($id) ?intval($id) : $id));
					if (!is_object($menuNode)) {
						$menuNode	=& $menuLoader->getMenuItemByName($id);
					}
				} else {
					if (!isset($menuNodeList[$menuItemListKeys[$iAccessKey]])) {
						continue;
					}
					$menuNode	=& $menuNodeList[$menuItemListKeys[$iAccessKey]];
					$accessKey	= trim($accessKeyStr);
				}
				if ((is_object($menuNode)) && ($accessKey != '')) {
					$menuNode->accessKey		= $accessKey;
				}
				$iAccessKey++;
			}
		}
	}

	function render() {
		$params		=& $this->params;

		if ((isset($GLOBALS['EXTENDED_MENU_OVERRIDE']) && (is_array($GLOBALS['EXTENDED_MENU_OVERRIDE'])))) {
			foreach($GLOBALS['EXTENDED_MENU_OVERRIDE'] as $k => $v) {
				$params->set($k, $v);
			}
		}

		$this->siteHelper =& new de_siteof_exmenu_SiteHelper();
		$siteHelper =& $this->siteHelper;

		$this->initDefaultParameters($params);
		$this->initMenuTemplate($params);

		$currentItemid = $siteHelper->getCurrentMenuId();

		$menu_style							= $params->get( 'menu_style', 'vert_indent' );

		$menutype							= $params->get('menutype');
		$menu_source_type					= $params->get('menu_source_type', 'menu');
		$menu_source_value					= trim($params->get('menu_source_value', ''));
		$menu_source_show_section			= $params->get('menu_source_show_section', 'default');
		$menu_source_show_category			= $params->get('menu_source_show_category', 'default');
		$menu_source_show_content_item		= $params->get('menu_source_show_content_item', 'default');
		$menu_source_order					= $params->get('menu_source_order', 'ordering');
		$defaultContentItemid				= $params->get('default_content_itemid', '');

		$maxDepth							= intval($params->get('max_depth')) - 1;
		$minExpand							= intval($params->get('expand_min'));
		$hideFirst							= intval($params->get('hide_first'));
		$showParent							= intval($params->get('show_parent')) == 1;
		$openActiveOnly						= !$params->get('expand_menu');
		$menuImages							= $params->get('menu_images', 0);

		$parentMenuItem						= trim($params->get('parent_item'));
		$currentLevelBegin					= intval($params->get('current_level_begin')) == 1;
		$depthIndex							= intval($params->get('level_begin'));
		$splitMenu							= intval($params->get('split_menu'));
		$menuCount							= intval($params->get('menu_count'));
		$queryCache							= intval($params->get('query_cache'));

		$parseAccessKey						= intval($params->get('parse_access_key'));
		$titleAttribute						= intval($params->get('title_attribute'));
		$levelClass							= intval($params->get('level_class'));
		$activeMenuClass						= intval($params->get('active_menu_class'));
		$elementId							= intval($params->get('element_id'));

		$callGetItemid						= intval($params->get('call_getitemid', '1')) == 1;
		$currentItem							= trim($params->get('current_item', 'smart'));
		$currentItemDuplicates				= trim($params->get('current_item_duplicates', 'convert_active'));
		$accessKeys							= trim($params->get('access_keys', ''));
		$exactAccessLevel					= intval($params->get('exact_access_level', '')) == 1;

		if ($menuCount > 1) {
			$splitMenu	= max(1, $splitMenu);
		}
		$view								=& ExtendedMenuViewFactory::getNewMenuView($menu_style);
		if ($view->maxDepth === 0) {
			// the factory limited the max depth of the view
			$maxDepth = 0;
		}
		if ($menu_style == 'patTemplate') {
			$view->patTemplateDirectory			= $this->patTemplateDirectory;
			$view->patTemplateFile				= $this->patTemplateFile;
		}

		// load the menu...
		$menuLoader							=& ExtendedMenuLoaderFactory::getNewMenuLoader($menu_source_type);
		$menuLoader->siteHelper =& $this->siteHelper;
		$menuLoader->loadFirstLevelOnly	= ($maxDepth <= 0) && ($activeMenuClass <= 0) && ($queryCache <= 0) &&
			($depthIndex == 0) && ($menuCount <= 1) && ($parentMenuItem == '') && (!$currentLevelBegin);
		$menuLoader->menutype				= $menutype;
		$menuLoader->activeMenuId			= $currentItemid;
		$menuLoader->openActiveOnly			= $openActiveOnly;
		$menuLoader->loadActiveOnly			= $openActiveOnly && ($parentMenuItem == '');
		$menuLoader->maxDepth				= $maxDepth;
		$menuLoader->minExpand				= $minExpand;
		$menuLoader->parseAccessKey			= $parseAccessKey;
		$menuLoader->cacheEnabled			= ($queryCache > 0);
		$menuLoader->currentItemid			= $currentItemid;
		$menuLoader->defaultSectionItemid	= $defaultContentItemid;
		$menuLoader->defaultCategoryItemid	= $defaultContentItemid;
		$menuLoader->defaultContentItemid	= $defaultContentItemid;
		$menuLoader->sectionOrder			= $menu_source_order;
		$menuLoader->categoryOrder			= $menu_source_order;
		$menuLoader->contentItemOrder		= $menu_source_order;
		$menuLoader->sectionLinkEnabled		= ($menu_source_show_section != 'label');
		$menuLoader->categoryLinkEnabled	= ($menu_source_show_category != 'label');
		$menuLoader->contentItemLinkEnabled	= ($menu_source_show_content_item != 'label');
		$menuLoader->sectionVisible			= (($menu_source_show_section != 'hide') && ($menu_source_show_section != 'default'));
		$menuLoader->categoryVisible		= (($menu_source_show_category != 'hide') && ($menu_source_show_category != 'default'));
		$menuLoader->contentItemVisible		= ($menu_source_show_content_item != 'hide');
		$menuLoader->sectionHidden			= ($menu_source_show_section == 'hide');
		$menuLoader->categoryHidden			= ($menu_source_show_category == 'hide');
		$menuLoader->contentItemHidden		= ($menu_source_show_content_item == 'hide');
		$menuLoader->smartItemidEnabled		= ($currentItem == 'smart');
		$menuLoader->ignoreItemidEnabled	= ($currentItem == 'ignore_itemid');
		$menuLoader->exactAccessLevel		= $exactAccessLevel;

		$menuSourceShowExceptions			= array('default', 'hide', 'label');
		if (!in_array($menu_source_show_section, $menuSourceShowExceptions)) {
			$menuLoader->sectionLinkType			= $menu_source_show_section;
		}
		if (!in_array($menu_source_show_category, $menuSourceShowExceptions)) {
			$menuLoader->categoryLinkType		= $menu_source_show_category;
		}
		if (!in_array($menu_source_show_content_item, $menuSourceShowExceptions)) {
			$menuLoader->contentItemLinkType		= $menu_source_show_content_item;
		}

		$menuSourceValues					= ($menu_source_value != '' ? explode(',', $menu_source_value) : array());
		foreach(array_keys($menuSourceValues) as $key) {
			$menuSourceValues[$key]		= trim($menuSourceValues[$key]);
		}
		$menuLoader->loadBySourceValues($menuSourceValues);
		switch($currentItemDuplicates) {
			case 'convert_active':
				$menuLoader->checkCurrentItemDuplicates(TRUE);
				break;
			case 'convert_normal':
				$menuLoader->checkCurrentItemDuplicates(FALSE);
				break;
		}

		// initialize the menu view...
		$view->siteHelper =& $this->siteHelper;
		$view->params						=& $params;
		$view->classSuffix					= $params->get('class_suffix', $params->get('class_sfx'));
		$view->idSuffix						= $params->get('id_suffix', $view->classSuffix);
		$view->imageEnabled					= ($menuImages != '0') && ($menuImages != '');
		if ($view->imageEnabled) {
			$view->imageAlignment				= $menuImages;
		}
		$view->openActiveOnly				= $openActiveOnly;
		$view->titleAttribute				= $titleAttribute > 0;
		$view->mainlevelClass				= $levelClass > 0;
		$view->sublevelClass					= $levelClass > 0;
		$view->activeMenuClassLink			= $activeMenuClass & 1;
		$view->activeMenuClassContainer		= $activeMenuClass & 2;
		$view->hierarchyBasedIds				= $elementId > 0;
		$view->callGetItemid					= $callGetItemid;

		if ($currentLevelBegin) {
			$depthIndex	+= max(0, count($menuLoader->activeIds) - 1);
		}

		static $nullMenuNode						= NULL;
		static $nullMenuNodeList					= NULL;

		$isFirst								= TRUE;

		for ($iMenu = 0; $iMenu < $menuCount; $iMenu++) {
			if ($splitMenu > 0) {
				$view->maxDepth			= $splitMenu - 1;
			} else {
				$view->maxDepth			= $maxDepth;
			}
			$menuNode	=& $nullMenuNode;
			if ($parentMenuItem != '') {
				if (''.intval($parentMenuItem) == $parentMenuItem) {
					$parentMenuItem	= intval($parentMenuItem);
					$menuNode		=& $menuLoader->getMenuItemById($parentMenuItem);
				} else {
					$menuNode		=& $menuLoader->getMenuItemByName($parentMenuItem);
				}
				if (!is_null($menuNode)) {
					if ($depthIndex > 0) {
						$tempMenuNode	=& $menuLoader->getMenuItemByMenuNodeAndLevel($menuNode, $depthIndex);
						$menuNode		=& $tempMenuNode;
					}
					if (is_null($menuNode)) {
						break;	// no more menu items
					}
					$menuNodeList					=& $menuNode->getChildNodeList();
				} else {
					echo 'parent menu item not found: &quot;'.$parentMenuItem.'&quot;';
					$menuNodeList					=& $nullMenuNodeList;
				}
			} else if ($depthIndex > 0) {
				$menuNode		=& $menuLoader->getMenuItemByLevel($depthIndex);
				if (is_null($menuNode)) {
					break;	// no more menu items
				}
				$menuNodeList					=& $menuNode->getChildNodeList();
			} else {
				$menuNodeList					=& $menuLoader->getMenuNodeList();
			}

			if ($showParent) {
				$view->maxDepth++;
				$list	= array();
				if (!is_null($menuNode)) {
					$list[]				=& $menuNode;
				} else {
					$rootMenuNode		=& $menuLoader->getRootMenuNode();
					$node				=& $menuLoader->getEmptyMenuNode();
					$node->setCaption($rootMenuNode->name);
					$node->addChildNodes($menuNodeList);
					$node->setExpanded(TRUE);
					$list[]				=& $node;
				}
				$menuNodeList					=& $list;
			}

			if (count($menuNodeList) == 0) {
//				echo 'menu list empty';
				break;
			}
			$view->menuHierarchy	= $menuLoader->getHierarchy($depthIndex);
			$view->menuLevel		= $depthIndex;
			if (($hideFirst == 1) && ($iMenu == 0)) {
				$menuNodeList2	= $menuNodeList;
				array_shift($menuNodeList2);
				$menuNodeList	=& $menuNodeList2;
			}

			if ($isFirst) {
				$this->applyAccessKeys($menuLoader, $menuNodeList, $accessKeys);
				$isFirst		= FALSE;
			}

			echo $view->renderAsString($menuNodeList, 0);
			$depthIndex				+= $view->maxDepth + 1;
			if ($showParent) {
				$depthIndex--;
			}
		}

		$menuLoader->freeAll();
	}

}
?>
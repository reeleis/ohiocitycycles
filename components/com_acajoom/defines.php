<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
if (!defined('DS'))  define( 'DS', DIRECTORY_SEPARATOR );
if (!defined('JPATH_ROOT')) define( 'JPATH_ROOT', $GLOBALS['mosConfig_absolute_path']);
if (!defined('JPATH_BASE')) define( 'JPATH_BASE', $GLOBALS['mosConfig_absolute_path']);
if (!defined('JPATH_LIVE')) define( 'JPATH_LIVE' , $GLOBALS['mosConfig_live_site'] );
define( 'ACA_OPTION', 'com_acajoom' );
define('ACA', 'aca_');
define( 'WPATH_ADMIN' , JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . ACA_OPTION . DS );
define( 'WPATH_FRONT' , JPATH_ROOT . DS . 'components' . DS . ACA_OPTION . DS );
define( 'WPATH_CLASS', WPATH_ADMIN  . 'classes' .DS );
define( 'WJ_ADMIN_IMG', JPATH_LIVE .DS . 'administrator' . DS .'images'. DS );
define( 'WCOMP_AIMG', JPATH_LIVE .DS . 'administrator' . DS . 'components' . DS . ACA_OPTION . DS .'images'. DS );
define( 'ACA_PATH_LANG', WPATH_ADMIN .'language' .DS );
if (!defined('_MOS_NOTRIM')) define( '_MOS_NOTRIM', 0x0001 );
if (!defined('_MOS_ALLOWHTML')) define( '_MOS_ALLOWHTML', 0x0002 );
if (!defined('_MOS_ALLOWRAW')) define( '_MOS_ALLOWRAW', 0x0004 );
if(!defined('_BUTTON_LOGIN') and defined('BUTTON_LOGIN')) define('_BUTTON_LOGIN',BUTTON_LOGIN);
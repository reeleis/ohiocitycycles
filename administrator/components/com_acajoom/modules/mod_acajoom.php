<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

if (file_exists($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php')) {
	require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
} else {
	die ("Acajoom Module\n<br />This module needs the Acajoom component.");
}

$acaModule = new aca_module();
echo $acaModule->normal($params);

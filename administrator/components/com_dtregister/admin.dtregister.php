<?php

/**
* @version 2.7.1
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 defined( 'JPATH_BASE' ) or die( 'Direct Access to this location is not allowed.' );

 if (!defined("DT_COM_COMPONENT")){

	define("DT_COM_COMPONENT","com_dtregister");

	define("DT_COMPONENT",str_replace("com_","",DT_COM_COMPONENT));

}

include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'defines.php');

if ($controller = JRequest::getWord('controller','cpanel')) {
    
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

	if (file_exists($path)) {

		require_once $path;

	} else {

	    $controller = 'cpanel';

	    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

		require_once $path;

	}

}

$classname	= ucfirst(DT_COMPONENT)."Controller".ucfirst($controller);

$controller	= new $classname();

// Perform the Request task

$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller

$controller->redirect();

?> 
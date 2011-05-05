<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/
global $mainframe;
defined( 'JPATH_BASE' ) or die( 'Direct Access to this location is not allowed.' );
if (!defined("DT_COM_COMPONENT")){

	define("DT_COM_COMPONENT","com_dtregister");

	define("DT_COMPONENT",str_replace("com_","",DT_COM_COMPONENT));

}

if(isset($_REQUEST['cdcaptcha']) && $_REQUEST['cdcaptcha']== 'getScript'){
		
		exit;
}
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'defines.php');

require_once (JPATH_ADMINISTRATOR.DS.'includes'.DS.'toolbar.php'); 

if($controller = JRequest::getWord('controller','event')) {

	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

	if (file_exists($path)) {

		require_once $path;

	} else {

	    $controller = 'event';

	    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

		require_once $path;

	}

}

$classname	= ucfirst(DT_COMPONENT)."Controller".ucfirst($controller);
$task = JRequest::getVar( 'task' );
$cart = JRequest::getVar('cart','');
$controllerObj	= new $classname();

// Perform the Request task

$controllerObj->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller

$controllerObj->redirect();

if(!(isset($_REQUEST['tmpl']) || isset($_REQUEST['no_html']) || isset($_REQUEST['format']))){
	 // pr($_SESSION);
}
?>
<?php
defined('_JEXEC') or die;

// Define absolute paths
define( 'linkrAdminPath', JURI::root() .'administrator/' );
define( 'linkrAssetsPath', linkrAdminPath .'components/com_linkr/assets/' );

// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
if($controller = JRequest::getVar( 'controller' )) {
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );
}

// Create the controller
$classname	= 'LinkrController'.$controller;
$controller = new $classname;

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();

?>

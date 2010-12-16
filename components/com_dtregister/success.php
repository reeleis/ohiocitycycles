<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

// http://dthdevelopment.com/joomla15/components/com_dtregister/success.php?return=35&Itemid=0
ob_start();
define( '_JEXEC', 1 );
global $oldpath ;
$oldpath = getcwd();
chdir('../../');
define('JPATH_BASE', getcwd() );
define( 'DS', DIRECTORY_SEPARATOR );

function myErrorHandler($errno, $errstr, $errfile, $errline) {
	$log = false;
    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $errors = "Notice";
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $errors = "Warning";
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $errors = "Fatal Error";
			$log = true;
            break;
        default:
		    $log = true;
            $errors = "Unknown";
            break;
        }

      $debug = sprintf ("<br />\n<b>%s</b>: %s in <b>%s</b> on line <b>%d</b><br /><br />\n", $errors, $errstr, $errfile, $errline);
   
      $debug .= sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline);
		//$debug = ob_get_clean();
	  $path = JPATH_BASE."/components/com_dtregister/lib/payment/ipnlog.html" ;
	  //if($log)
	  file_put_contents($path,$debug,FILE_APPEND);
     
    return true;
}

// set to the user defined error handler

require_once("configuration.php");
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
JPluginHelper::importPlugin('system');
$lang =& JFactory::getLanguage();
$lang->load('com_dtregister');
JRequest::setVar('controller','payment');
if(!isset($_REQUEST['task'])){
   $_REQUEST['task'] = 'restore';
}
set_error_handler("myErrorHandler");
echo "<pre>";
print_r($_REQUEST);
$mainframe->dispatch('com_dtregister');
if($_REQUEST['task']=="cancel"){
	$mainframe->redirect('../../index.php?option=com_dtregister&task=cancel&controller=payment&Itemid='.$Itemid);
}
//chdir($oldpath);

die();
?>
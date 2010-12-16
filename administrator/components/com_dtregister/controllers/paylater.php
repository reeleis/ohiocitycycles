<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterControllerPaylater extends DtrController {

  var $name ='paylater';
  
   function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'paylater', 'html' );

		 $this->view->setModel($this->getModel('paylater'),true);

		 $this->registerDefaultTask("validate");

		 JToolBarHelper::title(  JText::_( 'DT_PAYMENT_MANAGEMENT'), 'dtregister' );

	}
	
	function validate(){
	  
	   $tfee = $this->getModel('fee')->table;
	   $data = $tfee->find('payment_method='.JRequest::getVar('value',0));
	   ob_clean();
	   echo ($data)?'false':'true';
	   die;
	   
	}

}
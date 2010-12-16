<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerFeeorder extends DtrController {
	
	var $name ='feeorder';
	function __construct($config = array()){
		  parent::__construct($config);
		  $this->view = & $this->getView( 'feeorder', 'html' );
		  $this->view->setModel($this->getModel('feeorder'));
		  $this->view->setModel($this->getModel( 'event' ));
		 
		 $this->registerDefaultTask("view");
	}
	
	function order(){
	   
	  $feeorderTable = $this->getModel('feeorder')->table;
	  
	  if (is_array($_REQUEST['ordering'])) 
	  foreach($_REQUEST['ordering'] as $key=>$order){
	       $feeorderTable->load( (int) $order );
           $feeorderTable->ordering = $key + 1;
		   $feeorderTable->store();
		 
	  }
	   
	   	die;
    }
	function view(){
		 $feeorderTable = $this->getModel('feeorder')->table ;
		 $feeorders = $feeorderTable->find('  eventId = '.JRequest::getVar('eventId',0),'ordering');
		 
		 if (is_array($feeorders)) 
		 foreach($feeorders as &$feeorder){
			
			switch(trim($feeorder->type)){
			   case 'discountcode':
			      $feeorderTable->TableDiscountcode->load($feeorder->reference_id);
				 
				  $feeorder->title = $feeorderTable->TableDiscountcode->name;
			   break;
			   case 'field':
			       $feeorderTable->TableField->load($feeorder->reference_id);
				   $feeorder->title = $feeorderTable->TableField->name;
			   break;			   
			   
		    }			
			
		 }
		 
		 $this->view->assign('feeorders' , $feeorders);
		 $this->view->setLayout('view');
	     $this->view->display();
	}
	
}
?>
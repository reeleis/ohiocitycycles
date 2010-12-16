<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterControllerWaiting extends DtrController {
   
   var $name ='waiting';
   function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'waiting', 'html' );  
		 $this->view->setModel($this->getModel('waiting'),true);
		 
		 
		
		 $this->registerDefaultTask("add");
	

	}
	
	function add(){
	   
	   
	   $this->display();	
	}
}
?>
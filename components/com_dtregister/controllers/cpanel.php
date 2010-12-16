<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterControllerCPanel extends DtrController {
    
	var $name ='cpanel';
    
	function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'cpanel', 'html' );
		
		 $this->registerDefaultTask("index");
		 JToolBarHelper::title(  JText::_( 'DT_CONTROL_PANEL'), 'dtregister' );

	}
	
	function index(){
	   
	   $this->display();	
	}

}
?>
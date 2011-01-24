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
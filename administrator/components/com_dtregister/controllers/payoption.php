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
class DtregisterControllerPayoption extends DtrController {
  
  var $name ='payoption';
   function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'payoption', 'html' );
		 $this->view->setModel($this->getModel('payoption'),true);
		 $this->registerTask( 'new', 'add' );
		 $this->registerDefaultTask("payments");
		 JToolBarHelper::title(  JText::_( 'DT_PAYMENT_MANAGEMENT'), 'dtregister' );
		
	}
	
	function payments(){
		
	    JToolBarHelper::deleteList(JText::_( 'DT_DELETE_PAYMENT'),'delete');

        JToolBarHelper::divider();

        JToolBarHelper::editList('edit', JText::_( 'DT_EDIT') );

	    JToolBarHelper::divider();

        JToolBarHelper::addNew('add',JText::_( 'DT_NEW_PAYMENT'));
		$this->view->setLayout('list');
	    $this->view->display();
		
	}
	
	function add(){
	    
		JToolBarHelper::cancel('cancel');
        JToolBarHelper::save('save');
		$this->view->setLayout('add');
	    $this->view->display();
	   
	}
	
   function save(){
	   global $mainframe;

       $row = $this->getModel('payoption')->table;
         
	   $row->save(JRequest::getVar('data'));
    // prd(JRequest::getVar('data'));
	$mainframe->redirect( "index2.php?option=com_dtregister&controller=payoption" ,JText::_( 'DT_PAYMENT_SAVED') );
	}
	
	function edit(){
	   JToolBarHelper::cancel('cancel');
       JToolBarHelper::save('save');
	   $row = $this->getModel('payoption')->table ;
	   $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	 
	   JRequest::setVar('id',$cid[0]); 
	   $id = JRequest::getVar('id',0);
	   $row->load($id);
	   $this->view->assign('row',$row);
	   $this->view->setLayout('edit');
	   $this->view->display();	
	}
	
	function delete(){
	   global $mainframe;
	   $row = $this->getModel('payoption')->table;
	   $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	 
	   JRequest::setVar('id',$cid[0]); 
	   
	   $row->load(JRequest::getVar('id',0));
	   
	   $row->delete();
	   $mainframe->redirect("index.php?option=com_dtregister&controller=payoption");
	}
	
	function makedefault(){
	   global $mainframe ;
	   $row = $this->getModel('payoption')->table;
	   $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	   $row->rawquery("update #__dtregister_payment set `default`=0");
	  
	   JRequest::setVar('id',$cid[0]); 
	   $row->load(JRequest::getVar('id',0));
	   $row->default = 1;
	   $row->store();
	  
	   $mainframe->redirect("index.php?option=com_dtregister&controller=payoption");
	   
	   
			
    }
    
	function deselectdefault(){
	   
	   global $mainframe ;
	   $row = $this->getModel('payoption')->table;
	   $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	   JRequest::setVar('id',$cid[0]); 
	   $row->load(JRequest::getVar('id',0));
	   $row->default = 0;
	   $row->store();
	  
	   $mainframe->redirect("index.php?option=com_dtregister&controller=payoption");
	}
	
}
?>
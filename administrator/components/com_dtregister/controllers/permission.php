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

class DtregisterControllerPermission extends DtrController { 

   var $name ='permission';

   function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'permission', 'html' );  

		 $this->view->setModel($this->getModel('permission'),true);

		 $this->view->setModel($this->getModel('aro'));

		 $this->view->setModel($this->getModel('aco'));

		 $this->registerDefaultTask("index");

		 JToolBarHelper::title(  JText::_( 'DT_PERMISSION_MANAGEMENT'), 'dtregister' );
		 
		  $user	=& JFactory::getUser();
		  global $mainframe;
		  if($user->gid !=25){
			  $mainframe->redirect("index.php?option=com_dtregister&controller=authorize&task=auth");
		  }
		  //pr($user);


	}

	function index(){

		// $acl	=& JFactory::getACL();

		JToolBarHelper::save('update',JText::_( 'DT_SAVE'));

		$mPermission = $this->getModel('permission');

		$matrix = $mPermission->table->getmatrix();

		$this->view->assign('matrix',$matrix);
        $this->view->setLayout('matrix');
		$this->view->display();
	    //$this->display();

   }

   function update(){

	  global $mainframe;
	
	  $data = JRequest::getVar('data');

	  $tableRows = array();

	  if (is_array($data['permission'])) 
	  foreach($data['permission'] as $key => $permission){

		 foreach($permission as $name =>$val){

			 $tableRows[] = array('aro_id'=>$key,'group'=>$name);

		  }

	  } 

	  $mPermission = $this->getModel('permission');

	  $matrix = $mPermission->table->update($tableRows);
		   $mainframe->redirect("index.php?option=com_dtregister&controller=permission",JText::_('DT_PERMISSIONS_SAVED'));

   }

}

?>
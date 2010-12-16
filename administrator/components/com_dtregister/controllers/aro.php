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

class DtregisterControllerAro extends DtrController {

	var $name ='aro';

	 function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'aro', 'html' );  

		 $this->view->setModel($this->getModel('aro'));

		 $this->view->setModel($this->getModel('user'));
		 $this->getModel('permission') ;

		 $this->registerDefaultTask("add");

	}

	function add(){

	   global $mainframe;

	   if(isset($_POST['formsubmit'])){

			 $data =  JRequest::getVar('Aro');
             
			 $data['type'] = 'joomlaUser';

			 $this->getModel('aro')->table->save($data);
			 
			 $mainframe->enqueueMessage(JText::_('DT_ARO_ADDED'), 'message');
			 $session =& JFactory::getSession();
			 $session->set('application.queue', $mainframe->_messageQueue);
             //echo JText::_('DT_ARO_ADDED');
			 ?>
              <script type="text/javascript">
			   parent.window.location.reload();
			  </script>
             <?php
			 die;
			// $mainframe->redirect("index.php?option=com_dtregister&controller=permission");

	   }

	   

	   $this->view->assign('tAro',$this->getModel('aro')->table);

	  

	   $this->view->setLayout('add');

	   $this->view->display();	

	}
	
	function delete(){
	   
	    global $mainframe ;
	    $cid  = JRequest::getVar( 'cid', array(0), 'request', 'array' );
		$tAro = $this->getModel('aro')->table;
		$tAro->delete($cid[0]);
		$mainframe->redirect("index.php?option=com_dtregister&controller=permission");
	   	
	}

	

}

?>
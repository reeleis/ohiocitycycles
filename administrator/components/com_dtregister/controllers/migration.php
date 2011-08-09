<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterControllerMigration extends DtrController {

	var $name = "migration";
	 function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'migration', 'html' );  

		 $this->view->setModel($this->getModel('migration'));
		 $this->view->setModel($this->getModel('dtregister'));
         $this->registerDefaultTask("index");
		 JToolBarHelper::title( JText::_( 'DT_MIGRATE'), 'dtregister' );
     }
	
	function index(){

	   global $mainframe;	   
	   $this->display();

	}
	
	function process(){
		global $mainframe;
		$migrate = $this->getModel('migration');
		
		$dtreg = $this->getModel('dtregister');
		if($dtreg->migrated){
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_ALREADY_MIGRATED'));
		}else{
		    $migrate->event();
			$migrate->usertable();
			$dtreg->setmigrated(1);
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_MIGRATION_SUCCESSFUL'));	
		}
		
	}
	
	function test(){
		global $mainframe;
		$migrate = $this->getModel('migration');
		$migrate->event();
	}
	
	function migrate(){
		global $mainframe;
		$mainframe->redirect("index.php?option=com_dtregister&controller=cpanel");
		$dtreg = $this->getModel('dtregister');
        
		if($dtreg->migrated){
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_ALREADY_MIGRATED'));
		}else{
			$migrate = $this->getModel('migration');
			$migrate->backupForRollback();
			$migrate->event();
			$migrate->usertable();
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_MIGRATION_SUCCESSFUL'));
		}
	}
	
	function nojeventSync() {
	
		global $mainframe;
		$database = &JFactory::getDBO();
		if(isset($_REQUEST['remove'])){
			$sql = "update #__dtregister_group_event set eventId=0";
		    $database->setQuery($sql);
		    $database->query();
	        $mainframe->redirect("index.php?option=com_dtregister&controller=cpanel" , JText::_('DT_JEVENT_SYNC_REMOVED'));	
		}
		$this->view->setLayout('nojeventsync');
		$this->view->display();
	}
	
	function rollback(){ 
	    global $mainframe;
		$mainframe->redirect("index.php?option=com_dtregister&controller=cpanel");
		$dtreg = $this->getModel('dtregister');
		$migrate = $this->getModel('migration');
		if(!$dtreg->migrated){
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_NOT_MIGRATED'));
		}else{
			
			$migrate->rollback();
			$mainframe->redirect("index.php?option=com_dtregister&controller=migration",JText::_('DT_ROLLBACK_SUCCESSFULL'));
		}
	}
}
?>
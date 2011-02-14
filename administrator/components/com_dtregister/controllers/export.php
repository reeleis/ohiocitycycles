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

class DtregisterControllerExport extends DtrController {

   var $name ='export';

   function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'export', 'html' );  

		 $this->view->setModel($this->getModel('export'),true);

		 $this->view->setModel($this->getModel('event'));
		 $this->view->setModel($this->getModel('field'));
		 $this->view->setModel($this->getModel('user'));

		 

		

		 $this->registerDefaultTask("eventlist");

		 

         JToolBarHelper::title(  JText::_( 'DT_CSV_EXPORT_UTILITY'), 'dtregister' );


	}
	
	function downloadfile(){
    	$tExport = $this->getModel('export')->table;
		
		$tExport->filename = JRequest::getVar('filename');
		
		$tExport->output();
	}
	
	function fieldlist(){
	   global $mainframe ;
	   $tExport = $this->getModel('export')->table;
	   if(isset($_POST['formsubmit'])){
		  
		  
		  $general_export_fields = JRequest::getVar('general_export_fields',array(),null,'array');
		  $individual_export_fields = JRequest::getVar('individual_export_fields',array(),null,'array');
		  $group_export_fields = JRequest::getVar('group_export_fields',array(),null,'array');
		  
	
		  
		  $tExport->saveFields($general_export_fields,$individual_export_fields,$group_export_fields);
		  
		  $tExport->doexport($_REQUEST['datefrom'],$_REQUEST['dateto'],JRequest::getVar('page',0));
		//  $mainframe->redirect('index.php?option=com_dtregister&controller=export&task=fieldlist');
		  
	   }
	    JToolBarHelper::addNew('eventlist',JText::_( 'DT_BACK'));
        JToolBarHelper::spacer();
        JToolBarHelper::addNew('fieldlist',JText::_( 'DT_CREATE_EXPORT'));

	   $tExport->loadfirstRow();
	   
	   $this->view->assign('group_export_fields',$tExport->group_export_fields);
	   $this->view->assign('individual_export_fields',$tExport->individual_export_fields );
	   $this->view->assign('general_export_fields',$tExport->general_export_fields );
	   $this->view->assign('tExport',$tExport);
	   $this->display();	
	}
	
	function eventlist(){
		global $mainframe ;
		$tExport = $this->getModel('export')->table;
		if(isset($_POST['formsubmit']) && isset($_POST['export_events'])){
		   
			$events = JRequest::getVar('export_events',array(),null,'array');
			
			
			$tExport->saveEvents($events);
			$mainframe->redirect('index.php?option=com_dtregister&controller=export&task=fieldlist');
		}
		$tExport->loadfirstRow();
		JToolBarHelper::addNew('eventlist',JText::_( 'DT_NEXT'));

		$tEvent = $this->getModel('event')->table ;
		
		$events = $tEvent->find('archive = 0');
		
		$this->view->assign('events',$events);
		
		$this->view->assign('expevents',$tExport->events);
		
		$this->display();
	}

}

?>
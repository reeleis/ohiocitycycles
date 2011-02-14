<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterControllerMessage extends DtrController {
   
   var $name ='message';
   function __construct($config = array()){
	   
	   parent::__construct($config);
	   $this->view = & $this->getView( 'message', 'html' );  
	   $this->registerDefaultTask("index");	
	
   }
   
   function prequisite() {
	    global $prerequisite_event_msg;
	    $eventTable = $this->getModel('event')->table;
		$eventTable->load(JRequest::getVar('eventId'));
		$selection =  array();
	    foreach($eventTable->prerequisite as $prerequisite){
			     
			$data = $eventTable->find('slabId = '.$prerequisite);
			if($data){
				$data = $data[0];
				$selection[] = $data->title;
			}
			    
		}
	  if(count($selection)){
		  $prerequisite = "<ul><li>".implode("</li><li>",$selection)."</li></ul>";	
	  }else{
	      $prerequisite = "";
	  }
	  
	  $prerequisite_event_msg =  str_replace("[PREREQ_CATEGORY]",'',$prerequisite_event_msg); 
	  echo str_replace("[PREREQ_EVENTS]",$prerequisite,$prerequisite_event_msg);   
   }
   
   function prequisitecat(){
	    global $prerequisite_event_msg;
	    $eventTable = $this->getModel('event')->table;
		$cat = $this->getModel('category')->table;
		$eventTable->load(JRequest::getVar('eventId'));
		$selection =  array();
		$events = array();
	    foreach($eventTable->prerequisitecategory as $prerequisite){
			     
			$data = $cat->find('categoryId = '.$prerequisite);
			$evts  = array();
			if($data){
				$data = $data[0];
				$selection[] = $data->categoryName;
				$evts = $eventTable->find('category ='.$prerequisite);
				foreach($evts as $event){
					$events[] = $event->title;
				}
			}
	    
		}
	  
	   if(count($events)){
		  $prerequisiteEvt = "<ul><li>".implode("</li><li>",$events)."</li></ul>";	
	  }else{
	      $prerequisiteEvt = "";
	  }
	  $prerequisiteEvt = "";
	  if(count($selection)){
		  $prerequisite = "<ul><li>".implode("</li><li>",$selection)."</li></ul>";	
	  }else{
	      $prerequisite = "";
	  }
	  $prerequisite_event_msg = str_replace("[PREREQ_EVENTS]",$prerequisiteEvt,$prerequisite_event_msg);
	  echo str_replace("[PREREQ_CATEGORY]",$prerequisite,$prerequisite_event_msg);   
   }
   
   function privatevent(){
	   global $private_event_msg;

		echo stripslashes($private_event_msg);
   }
   
   function change(){
	  global $mainframe, $Itemid;
	   JText::_('DT_REGISTRATION_MODIFIED');
	  
	  DT_Session::clearAll();
	  $mainframe->redirect('index.php?option=com_dtregister&controller=user&Itemid='.$Itemid ,JText::_( 'DT_RECORD_CHANGE_SUCCESSFUL'));
   }
   
    function cancel(){
	   global $mainframe, $Itemid;
	   JText::_('DT_CANCEL_SUCCESSFUL');
	   DT_Session::clearAll();
	   
	   $mainframe->redirect('index.php?option=com_dtregister&controller=user&Itemid='.$Itemid ,JText::_( 'DT_CANCEL_SUCCESSFUL') );
	  
   }
   
   function duepayment(){
		global $mainframe, $Itemid;
		DT_Session::clearAll();
		$mainframe->redirect('index.php?option=com_dtregister&controller=user&Itemid='.$Itemid ,JText::_( 'DT_PAYMENT_SUCCESSFUL' ) );
   }
   
   function index(){
	   
	   // payment thanks 
	   // prd("index");
	   DT_Session::clearAll();
	   global $mainframe ;
	   
   }
   function waiting(){
	   
	   global $full_message;
	   
	   echo $full_message;
   }
   
   function waiting_msg(){
	     global $waiting_msg;
	   
	   echo $waiting_msg;
   }
   
   function paylater(){
	   global $pay_later_thk_msg;
	  
	   $userTable = $this->getModel('user')->table;
	   $TableEvent = $this->getMOdel('event')->table;
	   $messages = array();
	  
	   $Tagparser = new Tagparser();
	   // prd(DT_Session::get('register.User'));
	   
	   if(is_array(DT_Session::get('register.User')))
	
	   foreach(DT_Session::get('register.User') as $key => $user){
		    
		    if (isset($user)) {
				
				$userTable->load($user['userId']);
				$TableEvent->load($user['eventId']);
				$tokenmessage = ($TableEvent->pay_later_thk_msg_set)?$TableEvent->pay_later_thk_msg:$pay_later_thk_msg;
				
				$messages[] = $Tagparser->parsetags($tokenmessage,$userTable);
			
			}
			 
	   }
	   
	   $this->view->assign('messages',$messages);
	   $this->view->display();
	   
	  DT_Session::clearAll();
   }
   function thanks(){
	   global $thanksmsg;
	   //thanksmsg_set
	   
	   $userTable = $this->getModel('user')->table;
	   $TableEvent = $this->getMOdel('event')->table;
	   $Tagparser = new Tagparser();
	   $messages = array();
	   foreach(DT_Session::get('register.User') as $key => $user){
		    
		    $userTable->load($user['userId']);
			$TableEvent->load($user['eventId']);
			$tokenmessage = ($TableEvent->thanksmsg_set)?$TableEvent->thanksmsg:$thanksmsg;
			$messages[] = $Tagparser->parsetags($tokenmessage,$userTable);
			 
	   }
	   
	   $this->view->assign('messages',$messages);
	   $this->view->display();
	   DT_Session::clearAll();
		
   }
   
   function freethanks(){
	   global $thanksmsg;
	   
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   $user = DT_Session::get('register.User.'.$userIndex);
	   $userTable = $this->getModel('user')->table;
	   $TableEvent = $this->getMOdel('event')->table;
	   $Tagparser = new Tagparser();
	   $messages = array();
	   
		    $userTable->load($user['userId']);
			$TableEvent->load($user['eventId']);
			$tokenmessage = ($TableEvent->thanksmsg_set)?$TableEvent->thanksmsg:$thanksmsg;
			$messages[] = $Tagparser->parsetags($tokenmessage,$userTable);
			 
	    $this->view->setLayout('freethanks');
	    $this->view->assign('messages',$messages);
		$this->view->display();
		
	  DT_Session::clearAll();
   }
}
?>
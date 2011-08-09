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
class DtregisterControllerRegistrantemail extends DtrController {
    
	var $name ='registrantemail';
    
	function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'registrantemail', 'html' );  
		 $this->view->setModel($this->getModel('event'),true);
		 $this->view->setModel($this->getModel('user'),true);
		 $this->registerDefaultTask("index");
		 
	}
	
	function index(){
	   	JToolBarHelper::title(  JText::_( 'DT_EMAIL_REGISTRANTS'), 'dtregister' );

        JToolBarHelper::back();

		JToolBarHelper::divider();

		JToolBarHelper::addNew('send',JText::_( 'DT_SEND_EMAIL'));
		
		$this->display();
	}
	
	function send(){
		global $mosConfig_fromname,$mosConfig_mailfrom;
		
		$config =& JFactory::getConfig();

	    $eventId=JRequest::getInt( 'event_id', 0, 'post' );

	    $subject=JRequest::getString( 'subject' );

	    $message=JRequest::get( null ,JREQUEST_ALLOWRAW );

	    $message=$message['content'];
        $fromName=JRequest::getString( 'from_name');
	
		$fromEmail=JRequest::getVar( 'from_email');
	
		if(!$fromName) {	
			$fromName=$mosConfig_fromname;
		}
	
		if(!$fromEmail) {
			$fromEmail=$mosConfig_mailfrom;
		}
		$this->TableEvent = $this->getModel('event')->table;
		$this->TableEvent->load($this->eventId);      
		if($this->TableEvent->event_admin_email_set){
			$fromEmail = $this->TableEvent->event_admin_email_from_email;
			$fromName = $this->TableEvent->event_admin_email_from_name;
		}
        $bcc = JRequest::getVar( 'bcc', array(), 'post' );
	
	    $bcc = explode(";",$bcc);
		
		if (is_array($bcc)) 
		foreach($bcc as $bccemail){
			if($bccemail !="" && $message != "") {
				JUTility::sendMail( $fromEmail, $fromName,$bccemail,$subject,$message,1);
			}
		}
		
		
		$mUser = $this->getModel('user');
        // $users = $mUser->table->find("eventId=".$eventId);
		$search_params = array();
		
		if(isset($_REQUEST['search']['status'])){
			$search_params['status'] = $_REQUEST['search']['status'];
		}
		
		if(isset($_REQUEST['search']['attend']) && in_array($_REQUEST['search']['attend'],array(0,1))){
			
			$search_params['attend'] = $_REQUEST['search']['attend'];
		}
		if(isset($_REQUEST['search']['fee_status'])){
			if($_REQUEST['search']['fee_status'] ==1){
			   $search_params['condition'] = " f.status=1 ";
			}elseif($_REQUEST['search']['fee_status'] == 0){
				$search_params['condition'] = " f.status=0 ";
			}elseif($_REQUEST['search']['fee_status']==2){
				$search_params['condition'] = " (f.status=0 or  f.status=1) ";
			}
			
		}
		
		if(isset($_REQUEST['search']['free'])){
			
			$search_params['condition'] = "( ".$search_params['condition']." or f.fee=0  )";
			
		}else{
		    
			$search_params['condition'] = "( ".$search_params['condition']." and f.fee <> 0  )";
			
		}
		
		$search_params['eventId'] = $eventId;
		
		$users = $mUser->getUsers($search_params,$filter_order=" name ",$filter_order_Dir=" asc ",null,null);
		
		if($users){
		    
			$Tagparser = new Tagparser();
		   	
			if (is_array($users)) 
			foreach($users as $user){
			   $mUser->table->load($user->userId);
			   $email = $mUser->table->getFieldByName('email');
			   $content = $Tagparser->parsetags($message,$mUser->table);
			   $mailsubject = $Tagparser->parsetags($subject,$mUser->table);
			   if($email !="" && $content != ""){
		         JUTility::sendMail( $fromEmail, $fromName,$email,$mailsubject,$content,1);
			   }
			   if($mUser->table->type == 'G'){
				     
					 if (is_array($this->members)) 
					 foreach($this->members as $member){
						 if(!isset($member->email) || $member->email == ""){
							 continue;
						 }
						  $content =  $Tagparser->parsetags($message,$member);
						  JUTility::sendMail( $DT_mailfrom, $DT_fromname,$member->email,$mailsubject,$content,1);
						 
					}
				      
			   }
			   
			}
		}
		global $mainframe;
		$mainframe->redirect("index.php?option=com_dtregister&controller=registrantemail",JText::_("DT_ALERT_EMAIL_SENT"));
	   	
	}
   
}
?>
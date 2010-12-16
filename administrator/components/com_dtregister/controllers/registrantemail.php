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
class DtregisterControllerRegistrantemail extends DtrController {
    
	var $name ='registrantemail';
    
	function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'registrantemail', 'html' );  
		 $this->view->setModel($this->getModel('event'),true);
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
		global $mosConfig_fromname , $mosConfig_mailfrom;
		$config =& JFactory::getConfig();

	    $eventId=JRequest::getInt( 'event_id', 0, 'post' );

	    $subject=JRequest::getString( 'subject' );

	    $message=JRequest::get( null ,JREQUEST_ALLOWRAW );

	    $message=$message['content'];
        $fromName=JRequest::getString( 'from_name');
	
		$fromEmail=JRequest::getVar( 'from_email');
	
		if(!$fromName)
	
		{
	
			$fromName=$mosConfig_fromname;
	
		}
	
		if(!$fromEmail)
	
		{
	
			$fromEmail=$mosConfig_mailfrom;
	
		}
        $bcc = JRequest::getVar( 'bcc', array(), 'post' );
	
	     $bcc = explode(";",$bcc);
		
		if (is_array($bcc)) 
		foreach($bcc as $bccemail){
		   if($bccemail !="" && $message != "")
		   JUTility::sendMail( $fromEmail, $fromName,$bccemail,$subject,$message,1);
		}
		
		$mUser = $this->getModel('user');
        $users = $mUser->table->find("eventId=".$eventId);
		if($users){
		    
			$Tagparser =  new Tagparser() ;
		   	
			if (is_array($users)) 
			foreach($users as $user){
			   $mUser->table->load($user->userId);
			   $email = $mUser->table->getFieldByName('email') ;
			   $content =   $Tagparser->parsetags($message,$mUser->table);
			   $mailsubject =   $Tagparser->parsetags($subject,$mUser->table);
			   if($email !="" && $content != ""){
		         JUTility::sendMail( $fromEmail, $fromName,$email,$mailsubject,$content,1);
			   }
			   if($mUser->table->type == 'G'){
				     
					 if (is_array($this->members)) 
					 foreach($this->members as $member){
						 if(!isset($member->email) || $member->email == ""){
							 continue ;
						 }
						  $content =  $Tagparser->parsetags($message,$member);
						  JUTility::sendMail( $DT_mailfrom, $DT_fromname,$member->email,$mailsubject,$content,1);
						 
					}
				      
			   }
			   
			}
		}
		global $mainframe ;
		$mainframe->redirect("index.php?option=com_dtregister&controller=registrantemail",JText::_("DT_EMAIL_SENT"));
	   	
	}
    

}
?>
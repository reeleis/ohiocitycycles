<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerEvent extends DtrController {
    
	var $name ='event';
	
	function __construct($config = array()){
		  parent::__construct($config);
		  $this->view = & $this->getView( 'event', 'html' );
		  $this->view->setModel($this->getModel('event'),true);
		  $this->view->setModel($this->getModel( 'location' ));
		  $this->view->setModel($this->getModel( 'user' ));
		  $this->view->setModel($this->getModel( 'member' ));
		  $this->view->setModel($this->getModel( 'field' ));
		   $this->view->setModel($this->getModel( 'fieldtype' ));
		  $this->view->setModel($this->getModel( 'discountcode' ),false);
		  $this->view->setModel($this->getModel( 'file' ),false);
		  $this->view->setModel($this->getModel( 'category' ),false);
		  $this->view->setModel($this->getModel( 'section' ),false);
		  $this->registerTask( 'new',  'add' );
		  $this->registerTask( 'category',  'events' );
		  $this->registerDefaultTask("events");
		  
	}
	function checkpermission(){
		
		true;	
	}
	function events(){
		$cart =  JRequest::getVar('cart','');
		if(DT_Session::get('register.User.userId') !== false && DT_Session::get('register.User.userId') > 0){
		  	 DT_Session::clearAll('');
		}
		if($cart != 'continue'){
		    
		}else{
		   DT_Session::set('register.Setting.cart','yes');
		   	
		}
	   
	    $this->view->setModel($this->getModel('category'));
	    $this->view->setLayout('list');
		$this->view->display();
	}
	
	function cut_off(){
	   
	   $this->display();
	   	
	}
	
	function register(){
	   
	   global $mainframe,$xhtml,$Itemid,$now;
	   
	   if(false === DT_Session::get('register.Setting.cart')){
		   
		   if(DT_Session::get('register.User')!==false){
	        
			  $userIndex = count(DT_Session::get('register.User'));
			  $userIndex-- ;
			   
		       DT_Session::clear('register.User.'.$userIndex);
			  // pr(DT_Session::get('register.User.'.$userIndex));
			   //pr(DT_Session::get('register.User'));
			  // prd($userIndex);
	        }else{
			   DT_Session::clearAll('');
	           $userIndex = 0;
	         }
		   
		   
	       
	   }else{
		  // DT_Session::clear('register.Setting.cart');
	   }
	   
	   $type =  JRequest::getVar('type');
	   $eventId = JRequest::getVar('eventId',0);
	   $tEvent = $this->getModel('event')->table;
	   $tUser = $this->getModel('user')->table;
	   $tEvent->load($eventId);
	   $tEvent->is_registerable($tUser);
	   if($type=="options"){
	       $mainframe->redirect(JRoute::_("index.php?option=com_dtregister&controller=event&task=options&Itemid=".$Itemid."&eventId=".$eventId,$xhtml));
	   }else{
	       $mainframe->redirect(JRoute::_("index.php?option=com_dtregister&controller=event&task=options&Itemid=".$Itemid."&eventId=".$eventId,$xhtml));
	   }
	   $event = $this->getModel('event')->table;
	   $event->load($eventId);
	   $this->view->assign('header_eventId',$eventId);

	}
	
	function options(){
	  
	  global $mainframe ,$Itemid , $xhtml;
	  
	  
	  $eventId = JRequest::getVar('eventId',0);
	  DT_Session::set('register.Event.eventId', $eventId);
	  
	  if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	  }
	  
	  if(false === DT_Session::get('register.Setting.cart')){
		   
		   if(DT_Session::get('register.User')!==false){
	        
			  $userIndex = count(DT_Session::get('register.User'));
			  $userIndex-- ;
			   
		       DT_Session::clear('register.User.'.$userIndex);
			  // pr(DT_Session::get('register.User.'.$userIndex));
			   //pr(DT_Session::get('register.User'));
			  // prd($userIndex);
	        }elseif(DT_Session::get('register.Event.eventId') === false || DT_Session::get('register.Event.eventId') == 0){
			
			   DT_Session::clearAll('');
	           $userIndex = 0;
	         }
		   
		   
	       
	   }else{
		   DT_Session::clear('register.Setting.cart');
	   }
	  $tEvent = $this->getModel('event')->table;
	  
	  $tEvent->load($eventId);
	  $my = &JFactory::getUser();
	
	  $tUser = $this->getModel('user')->table;
		
	  $tEvent->is_registerable($tUser);
	 
	  if(DT_Session::get('register.User')!==false){
	        
			$userIndex = count(DT_Session::get('register.User'));
		    			
	   }else{
	        $userIndex = 0;
	   }
	   
	   DT_Session::set('register.Setting.current.userIndex',$userIndex) ;
	   DT_Session::set('register.User.'.$userIndex.'.eventId',$eventId) ;
	   $registered =  $tEvent->getTotalregistered($tEvent->slabId);

	   if (isset($tEvent->max_registrations) && $tEvent->max_registrations > 0) {
		if($tEvent->max_registrations <= $registered){
		   	if($tEvent->waiting_list){
			     DT_Session::set('register.User.'.$userIndex.'.status',-2) ;
			}
		}
	    }


	   if($tEvent->registration_type=="individual"){
		     if(isset($_REQUEST['back'])){
			    $mainframe->redirect('index.php?option=com_dtregister&Itemid='.$Itemid);
			 }else{
		        $mainframe->redirect('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=individualRegister');
			 }
	   }elseif($tEvent->registration_type=="group"){
		   
 $mainframe->redirect('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=groupNum');
	   }
	    $this->view->assign('header_eventId',$eventId);
	   $this->view->assign('tEvent',$tEvent);
	   $this->view->setLayout('options');
	   $this->view->display();
	    
	}
	
	function confirm(){
		global $mainframe ,$Itemid , $xhtml;
		if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   global $Itemid,$mainframe,$xhtml_url;
	   $this->view->setModel($this->getModel( 'field' ));
	   $this->view->setModel($this->getModel( 'fieldtype' ));
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');

	  
	   $step = JRequest::getVar('step',0);
	   $my = &JFactory::getUser();
	   if($step ==="confirm"){
	      
		   $paying_amount = JRequest::getVar('paying_amount',0);
		   DT_Session::clear('register.User.process');
		   DT_Session::set('register.User.'.$userIndex.'.fee.paid_amount',$paying_amount);
		   DT_Session::set('register.User.'.$userIndex.'.fee.paying_amount',$paying_amount);
           
		   DT_Session::set('register.User.'.$userIndex.'.confirmed',1);
		   
		   if($my->id){
			    DT_Session::set('register.User.'.$userIndex.'.user_id', $my->id);
		     
		   }
		   $tableUser = $this->getModel('user')->table;
		   DT_Session::set('register.User.'.$userIndex.'.confirmNum',$tableUser->generateconfirmNum());
		   $status = DT_Session::get('register.User.'.$userIndex.'.status');
			
			
		   if($status == -2){ // free or waiting $paying_amount <= 0 
			   if($status == -2){
				   DT_Session::set('register.User.'.$userIndex.'.fee.paid_amount',0);
		           DT_Session::set('register.User.'.$userIndex.'.fee.paying_amount',0);
				   $task = "waiting_msg";
			   }else{
				   $task = "freethanks";
			   }
			   
			   $tableUser->register(DT_Session::get('register.User.'.$userIndex));
			   DT_Session::set('register.User.'.$userIndex.'.userId',$tableUser->userId);
			   		   
			    
			   $mainframe->redirect("index.php?option=com_dtregister&controller=message&task=$task&Itemid=".$Itemid);
		   }else{
			   $mainframe->redirect("index.php?option=com_dtregister&controller=event&task=viewCart&Itemid=".$Itemid);
		   }

	   }
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.Event.eventId'));
	   
	   $event = & DtrTable::getInstance('Event','Table');
	   $event->load($eventId );
	   
	   if(isset($_REQUEST['Field'])){
	     // pr('register.User.'.$userIndex.'.fields') ;
	     DT_Session::set('register.User.'.$userIndex.'.fields', $_REQUEST['Field']);
		 if(isset($_REQUEST['username'])){
		   DT_Session::set('register.User.'.$userIndex.'.username', $_REQUEST['username']);
		   DT_Session::set('register.User.'.$userIndex.'.password', $_REQUEST['password']);
		 }
		if(isset($_REQUEST['discount_code']) && $_REQUEST['discount_code'] != ""){
			
			$discount_code_id = $event->validate_code($_REQUEST['discount_code']); 
			if($discount_code_id !== false){
			   DT_Session::set('register.User.'.$userIndex.'.discount_code_id', $discount_code_id );
			}else{
			   DT_Session::set('register.User.'.$userIndex.'.discount_code_id', false );
			  $this->view->assign('discountCodeError',$event->TableEventdiscountcode->TableDiscountcode->error );
			  
			}
			
		}
	   }
	   
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   DT_Session::set('register.User.'.$userIndex.'.eventId', $eventId);
	   $fieldtype =$this->getModel( 'fieldtype' );
	   $viewMemFields = "";
	   if(DT_Session::get('register.User.'.$userIndex.'.type')=='G'){
	      $back = JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=billinginfo&back=1", $xhtml_url);
		  $type = 'B';
		   $members = DT_Session::get('register.User.'.$userIndex.'.members');
		   if($members)
		   foreach($members as $key => $member){
		      $viewMemFields .= "<tr><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'><u>".JText::_( 'DT_MEMBER' ).($key+1)." </u></td></tr>";
		      $viewMemFields .= $event->viewFields('M',DT_Session::get('register.User.'.$userIndex.'.members.'.$key),false,'frmcart',false);
		   }
	   }else{
	      $back = JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=individualRegister&back=1", $xhtml_url);
		  $type = 'I';
	   }
	   
	   $TableUser  =& DtrTable::getInstance('Duser','Table');
	   $TableUser->create(DT_Session::get('register.User.'.$userIndex));
	   $feeObj = new DT_Fee($event,$TableUser);
	   $feeObj->getFee($my->id);
	   $feesession = $feeObj;
	   unset($feesession->TableEvent);
	   unset($feesession->TableUser);
	   
	   if($event->is_waiting()){
	      
		  DT_Session::set('register.User.'.$userIndex.'.status',-2);
		  $this->view->assign('paying_amount',0);
		  
	   }else{
		     
		   $this->view->assign('paying_amount',$feeObj->paid_fee);
		}
	   DT_Session::set('register.User.'.$userIndex.'.fee',DTrCommon::objectToArray($feesession));
	   
	   $this->view->assign('feeObj',$feeObj);
	   $this->view->assign('back',$back);
	   $this->view->assign('eventId',$eventId);
	   $this->view->assign('header_eventId',$eventId);
	   //$event->load($eventId);
	  
	   $this->view->assign( 'viewFields' ,$event->viewFields($type,DT_Session::get('register.User.'.$userIndex),false,'frmcart',false));
	   $this->view->assign( 'viewMemFields',$viewMemFields);
	   $this->view->assign( 'event',$event);
	   $this->view->setLayout('confirm');
	   $this->view->display();
	   $db = &JFactory::getDBO();
	   $db->profileData = array();

	}
	
	function viewCart(){
		DT_Session::clear('register.User.process');
		global $mainframe, $Itemid, $disable_cart;
		global $xhtml;
		if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   global $mainframe, $Itemid, $disable_cart;
	   if ($disable_cart == 0) {
			$mainframe->redirect('index.php?option=com_dtregister&controller=payment&task=methods&Itemid='.$Itemid);
	   }	   
	   $this->view->setLayout('viewcart');
	   $this->view->display();
	   
	}
	
	function groupNum(){
	   
	   global $mainframe ,$Itemid , $xhtml;
		if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.Event.eventId'));
	   $tEvent = $this->getModel('event')->table;
	   $tUser = $this->getModel('user')->table;
	   $tEvent->load($eventId);
	   $tEvent->is_registerable($tUser);
	   if(isset($_POST['memtot'])){
	       DT_Session::clear('register.User.'.$userIndex.'.members');
		   DT_Session::set('register.User.'.$userIndex.'.memtot',$_POST['memtot']);
		   DT_Session::set('register.Setting.current.memberIndex',0);
		   $eventTaable = $this->getModel('event')->table;
		   $eventTaable->load($eventId);
		   
		   if($eventTaable->group_registration_type !="detail"){
			  $mainframe->redirect('index.php?option=com_dtregister&controller=event&task=billinginfo&Itemid='.$Itemid);
		   }else{
		     $mainframe->redirect("index.php?option=com_dtregister&controller=event&task=memberdata&Itemid=".$Itemid);
		   }
	   }
	   
	   // echo '<pre>'; print_r($tEvent->max_group_size);
	   
	   DT_Session::set('register.User.'.$userIndex.'.type','G');
	   $this->view->assign('header_eventId',$eventId);
	   $this->view->setLayout('groupNum');
	   $this->view->assign('tEvent',$tEvent);
	   $this->view->display();
	   
	}
	
	function memberdata(){
	   global $mainframe ,$Itemid , $xhtml;
		if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   $this->view->setModel($this->getModel( 'field' ));
	   $this->view->setModel($this->getModel( 'fieldtype' ));
	   $field = $this->getModel( 'field' )->table;
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.Event.eventId'));
	   $fieldtype =$this->getModel( 'fieldtype' );
	   $event = $this->getModel('event')->table;
	   $event->load($eventId);
	   
	   if(isset($_POST['memberIndex'])){
	       $memberIndex = JRequest::getVar('memberIndex',DT_Session::get('register.Setting.current.memberIndex'));
	       DT_Session::set('register.User.'.$userIndex.'.members.'.$memberIndex .'.fields', $_REQUEST['Field']);
	       $event->addUsageToSession($_REQUEST['Field']);
		   if(!(($memberIndex+1) < DT_Session::get('register.User.'.$userIndex.'.memtot'))){
		      $mainframe->redirect('index.php?option=com_dtregister&controller=event&task=billinginfo&Itemid='.$Itemid);
		   }
		   $memberIndex++;
		   DT_Session::set('register.Setting.current.memberIndex',$memberIndex);
	      
	   }else{
		 $memberIndex = JRequest::getVar('memberIndex',DT_Session::get('register.Setting.current.memberIndex'));
	     DT_Session::set('register.Setting.current.memberIndex',$memberIndex);
	   }
	   if($memberIndex == 0 ){
	      $back =  JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=options&back=1");
	   }else{
	      $back =  JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=memberdata&back=1&memberIndex=".(DT_Session::get('register.Setting.current.memberIndex')-1));
	   }
	   if(JRequest::getVar('back',0)){
	        $dec_memberIndex = $memberIndex - 1;

	   }
	   $this->view->assign('back',$back);
	  
	   $this->view->assign('memberIndex',DT_Session::get('register.Setting.current.memberIndex'));
	   $this->view->assign( 'form' ,$event->form('M',(array)DT_Session::get('register.User.'.$userIndex.'.members.'.DT_Session::get('register.Setting.current.memberIndex')),false,'frmcart',false));
	   $this->view->setLayout('memberdata');
	   $this->view->assign('header_eventId',$eventId);
	   $this->view->assign('tEvent',$event);
	   $this->view->display();

	}
	
	function billinginfo(){
	   global $mainframe ,$Itemid , $xhtml;
		if(false === DT_Session::get('register.Event.eventId') || DT_Session::get('register.Event.eventId') == 0){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.User.'.$userIndex.'.eventId'));
	   $fieldtype =$this->getModel( 'fieldtype' );
	   $event = $this->getModel('event')->table;
	   $event->load($eventId);
	   $this->loadprofile();
	   $this->view->assign( 'form' ,$event->form('B',(array)DT_Session::get('register.User.'.$userIndex),false,'frmcart',false));
	   
	   // pr($_SESSION['DTregister']);
	   
	   $this->view->setLayout('individualRegister');
	   if($event->group_registration_type !="detail"){
		    $back =  JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=groupNum');
	   }else{
		    $back =  JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=memberdata&back=1&memberIndex=".DT_Session::get('register.Setting.current.memberIndex'));
	   }
	   $this->view->assign('pageTile',JText::_( 'DT_BILLING_INFORMATION'));
	   $this->view->assign('task','confirm');
	   $this->view->assign('back',$back);
	   $this->view->assign('tEvent',$event) ;
	   $this->view->assign('eventId',$eventId);
	   $this->view->assign('header_eventId',$eventId);
	   $this->view->display();
	   
	}
	
	function terms(){
		$eventId = JRequest::getVar('eventId',0);
		$event = $this->getModel('event')->table;
	    $event->load($eventId);
		if($event->terms_conditions_set == 1){
			$terms = $event->terms_conditions_msg;
		}else{
			$terms = $this->config->getGlobal('terms_conditions_msg','') ;
		}
		$this->view->assign('terms',$terms);
		$this->view->setLayout('terms');
		$this->view->display();
		
	}
	
	function cartRemove(){
	   global $mainframe ,$Itemid;
	   $userIndex = JRequest::getVar('userIndex');
	   
	   // pr($userIndex);
	   
	   DT_Session::clear('register.User.'.$userIndex);
	   
	   // prd(DT_Session::get('register.User'));
	   // prd($_SESSION);
	   
	   $mainframe->redirect('index.php?option=com_dtregister&controller=event&task=viewCart&Itemid='.$Itemid);	   
	}
	
	function loadprofile(){
	   $user = JFactory::getUser();
	   $muser = $this->getModel('user');
       $tuser = $muser->table;
       $profile = $tuser->TableJUser;
       $user_id = $user->id;
       $userdata = $profile->getProfile($user_id);
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   
	   if (is_array($userdata)) 
	   foreach($userdata as $field_id => $val){
		   if($field_id != "" && isset($userdata[$field_id])){
			     $currentval = DT_Session::get('register.User.'.$userIndex.'.fields.'.$field_id);
				 if($currentval === false){
				    DT_Session::set('register.User.'.$userIndex.'.fields.'.$field_id,$userdata[$field_id]);
				 }
	    
		   }
	   }
	   
	}
	function individualRegister(){
	   global $mainframe ,$Itemid , $xhtml;
	   
	   $eventId = JRequest::getVar('eventId');
	   if (isset($eventId) && $eventId > 0) DT_Session::set('register.Event.eventId', $eventId);
	   
		if(false === DT_Session::get('register.Event.eventId')){
		   
		   $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
	   }
	   $userIndex = DT_Session::get('register.Setting.current.userIndex');
	   DT_Session::set('register.User.'.$userIndex.'.memtot',1);
	   DT_Session::set('register.User.'.$userIndex.'.type','I');
	   $this->view->setModel($this->getModel( 'field' ));
	   $this->view->setModel($this->getModel( 'fieldtype' ));
	   $field = $this->getModel( 'field' )->table;
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.User.'.$userIndex.'.eventId'));
	   $fieldtype =$this->getModel( 'fieldtype' );
	   $event = $this->getModel('event')->table;
	   $event->load($eventId);
	   
	   $tUser = $this->getModel('user')->table;
	   
	   $event->is_registerable($tUser);
	   $this->loadprofile();
	   $this->view->assign( 'form' ,$event->form('I',(array)DT_Session::get('register.User.'.$userIndex),false,'frmcart',false));
	   $this->view->setLayout('individualRegister');
	  
	  //  pr((array)DT_Session::get('register.User.'.$userIndex));
	    //pr($_SESSION['DTregister']);
	 
	  $back =  JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=event&task=options&back=1") ;
	  $this->view->assign('pageTile', JText::_( 'USER_INFORMATION' ));
	  $this->view->assign('task','confirm');
	  $this->view->assign('back',$back);
	  $this->view->assign('tEvent',$event);
	  $this->view->assign('eventId',$eventId);
	  $this->view->assign('header_eventId',$eventId);
	  $this->view->display();
	   
	}
	
	function price_header(){
	$layout = JRequest::getVar('dttmpl','price_header');
	   if(isset($_REQUEST['Field'])){
		   $userIndex = DT_Session::get('register.Setting.current.userIndex');
		   if(isset($_REQUEST['memberIndex'])){
			  $memberIndex = JRequest::getVar('memberIndex',0);
	          DT_Session::set('register.User.'.$userIndex.'.members.'.$memberIndex .'.fields', $_REQUEST['Field']);
		   }else{
			   
			   DT_Session::set('register.User.'.$userIndex.'.fields', $_REQUEST['Field']);
			   if(isset($_REQUEST['username'])){
				   DT_Session::set('register.User.'.$userIndex.'.username', $_REQUEST['username']);
				   DT_Session::set('register.User.'.$userIndex.'.password', $_REQUEST['password']);
			   }
			  if(isset($_REQUEST['discount_code']) && $_REQUEST['discount_code'] != ""){
				  $eventId = JRequest::getVar('eventId',DT_Session::get('register.Event.eventId'));
				  $event = $this->getModel('event')->table ;
	              $event->load($eventId);
				  $discount_code_id = $event->validate_code($_REQUEST['discount_code']); 
				  if($discount_code_id !== false){
					  DT_Session::set('register.User.'.$userIndex.'.discount_code_id', $discount_code_id );
				  }else{
					  DT_Session::set('register.User.'.$userIndex.'.discount_code_id', false );
					  $this->view->assign('discountCodeError',$event->TableEventdiscountcode->TableDiscountcode->error );
					
				  }
				  
			  }else{
				   DT_Session::set('register.User.'.$userIndex.'.discount_code_id', 0 );
			  }
		   }
	   }
	   $this->view->setLayout($layout );
	   $this->view->display();
	   die;
	}
	
	function registrant(){
		global $mainframe , $registrant_list;
	    $mUser = $this->getModel( 'user' );
		$order = JRequest::getVar('filter_order','name');
		$dir = JRequest::getVar('filter_order_Dir','asc');
		
		jimport('joomla.html.pagination');

	    $listLimit = $mainframe->getCfg( 'list_limit', 10 );
        $limit=JRequest::getInt('limit',$listLimit);

	    $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		
		$searchtxt = JRequest::getVar( 'search' ,'' );
		$users = $mUser->getUsers(array('eventId'=>JRequest::getVar('eventId'),'query'=>$searchtxt,'status'=>array(0,1)),$order,$dir,$limitstart,$limit);
		$total = $mUser->table->getLastCount();
		
		$pageNav = new JPagination( $total, $limitstart, $limit );
		
		
		//if(!$registrant_list){
	
			$my = &JFactory::getUser();
	
			if($registrant_list <= $my->aid){
	
			}else{
	
				echo JText::_( 'DT_LOGIN_REQUIRED');
	
				return;
	
			}
	
		//}
		$this->view->assign('users',$users);
		$this->view->assign('pageNav',$pageNav);
		
		$this->display();
	}

	function getjevent(){
	   
	   $jevt = $this->getModel('event')->tableJevt;
	   $data = $jevt->find(' evdet_id='.JRequest::getVar('eventId',0));
	   $rep = $jevt->parserule(JRequest::getVar('eventId',0));
	  
	 //  prd($jevt->getObjData());
	   ob_clean();
	  	
	//   prd(json_encode($repjson));
	   if($data){
	      $data = $data[0];
	   if($rep)
	      $data->reprules = $jevt->getObjData();
	   echo json_encode($data);
	   
	   }else{
	      $array = array('error'=>'No event');
		  echo json_encode($array);
	   }
	   
	   die;
	}

}
?>
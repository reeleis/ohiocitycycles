<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerUser extends DtrController {

   var $name = "User";

    function __construct($config = array()){
          global $mainframe ;
		  parent::__construct($config);
          
		  $user =  JFactory::getUser();
		  if(!$user->id){
		  	  
			  JRequest::setVar('task','auth');
			  
		  }
		  $this->view = & $this->getView( 'User', 'html' );

		  $this->view->setModel($this->getModel('event'));

		  $this->view->setModel($this->getModel( 'location' ));

		  $this->view->setModel($this->getModel( 'user' ));

		  $this->view->setModel($this->getModel( 'member' ));

		  $this->view->setModel($this->getModel( 'field' ));
		
		  $this->view->setModel($this->getModel('field'));
		  
		 $this->registerDefaultTask("index");

		 $this->user = &JFactory::getUser();

	}

	function index(){

	   global $mainframe;
       
       DT_Session::clearAll();
		
	   $mUser = $this->getModel( 'user' );

	   $order = JRequest::getVar('filter_order','register_date');

	   $dir = JRequest::getVar('filter_order_Dir','desc');

		jimport('joomla.html.pagination');

	    $listLimit = $mainframe->getCfg( 'list_limit', 10 );

        $limit=JRequest::getInt('limit',$listLimit);

	    $limitstart  = JRequest::getVar('limitstart', 0, '', 'int');

		$users = $mUser->getUsers(array('user_id'=>$this->user->id),$order,$dir,$limitstart,$limit);

		$total = $mUser->table->getLastCount();	

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$this->view->assign('users',$users);

		$this->view->assign('pageNav',$pageNav);

	   $this->display();

	}

	function due(){

	    global $mainframe,$Itemid;

	    $mUser = $this->getModel('user');

	    $tUser = $mUser->table;

	    $userId=JRequest::getVar('userId',0);

	    $tUser->load($userId);

	    $userObj = $tUser->getObjData();
        
	    $user = DTrCommon::objectToArray($userObj);

		$user['process'] = 'duepayment';

		DT_Session::set('register.User',$user);

		DT_Session::set('register.User.process','duepayment');
		
		$mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid."&controller=user&task=confirm");

	}

	function cancel(){

		global $mainframe,$Itemid;

	    $mUser = $this->getModel('user');

	    $tUser = $mUser->table;

	    $userId=JRequest::getVar('userId',0);

	    $tUser->load($userId);

	    $userObj = $tUser->getObjData();

	    $user = DTrCommon::objectToArray($userObj);

		$user['process'] = 'cancel';

		DT_Session::set('register.User',$user);

		DT_Session::set('register.User.process','cancel');

		$mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid."&controller=user&task=confirm");

	}

	function edit(){

	    global $mainframe,$Itemid;

	    $mUser = $this->getModel('user');

	    $tUser = $mUser->table;

	    $userId=JRequest::getVar('userId',0);

	    $tUser->load($userId);
        DT_Session::set('register.Event.eventId',$tUser->eventId);
	    $userObj = $tUser->getObjData();
		$user = DTrCommon::objectToArray($userObj);
		$user['process'] = 'change';
		
       if(isset($_POST['formsubmit']) ){

			$data = $_POST['User'];
            $memtot = DTrCommon::cntMemtotInSession( DT_Session::get('register.User.members'));

			$user['fields'] = $_POST['Field'];

			$user['memtot'] = $memtot;

			if(DT_Session::get('register.User.members')){

				$temp =  array();

			    foreach(DT_Session::get('register.User.members') as $key => $member){

			     if(isset($member['remove']) && $member['remove']){

				  }else{

					 $temp[$key] = $member;

				  } 

		        }

				$user['members'] = $temp;

		    }
            
			DT_Session::set('register.User',$user);

			DT_Session::set('register.User.process','change');

			//unset($_SESSION['DTregister']['register']['members']);
       	$mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid."&controller=user&task=confirm");

			pr($_POST);

			prd($user);

		}else{
			if(!DT_Session::get('register.User')){
		   	   DT_Session::set('register.User',$user);
			   DT_Session::set('register.Event.eventId',$tUser->eventId);
			}
		}
       
	   $eventId = $tUser->eventId;

	   $this->view->assign('header_eventId',$eventId);

	 //  pr(DTrCommon::objectToArray($userObj));

	   $type = ($tUser->type=='I')?'I':'B' ;
       $tUser->TableEvent->duplicate_check = false ;
	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,(array)$tUser,false,'frmcart',true));
       $tUser->TableEvent->load($eventId) ;
       $this->view->assign('tEvent',$tUser->TableEvent);
	   $this->view->assign('mUser',$mUser);
	   $this->display();

	}
    
	function price_header(){
	   
	   $layout = JRequest::getVar('dttmpl','price_header');
	   $this->getModel('field');
	   if(isset($_REQUEST['Field'])){
		   //$userIndex = DT_Session::get('register.Setting.current.userIndex');
		   if(isset($_REQUEST['key'])){
			   if($_REQUEST['key'] != ""){
				   $key = JRequest::getVar('key',0);
	               DT_Session::set('register.User.members.'.$key .'.fields', $_REQUEST['Field']);
			   }
			  
		   }else{
			   
			   DT_Session::set('register.User.fields', $_REQUEST['Field']);	  
			 
		   }
	   }
	   $this->view->setLayout($layout );
	   $this->view->display();	
	   die;
	   	
	}
	
	function confirm(){

	   global $Itemid,$mainframe,$xhtml,$xhtml_url;

	   $this->view->setModel($this->getModel( 'field' ));

	   $this->view->setModel($this->getModel( 'fieldtype' ));
	   
	   $step = JRequest::getVar('step',0);
	   
	   if($step ==="confirm"){
           if(isset($_REQUEST['partial_payment'])){
			    if($_REQUEST['partial_payment'] == 'full'){
					$paying_amount = JRequest::getVar('paying_amount',0);
				}else{
					$paying_amount = JRequest::getVar('partial_payment_amount',0);
				}
		   }else{
		   	    $paying_amount = JRequest::getVar('paying_amount',0);
		   }
		   
           if($paying_amount >0 ){
			   $paid_amount = DT_Session::get('register.User.fee.paid_amount') + $paying_amount;
		   }else{
			   $paid_amount = DT_Session::get('register.User.fee.paid_amount');
		   }

		   if(DT_Session::get('register.User.0') === false){
			   DT_Session::set('register.User.fee.paying_amount',$paying_amount);

		       DT_Session::set('register.User.fee.paid_amount',$paid_amount);
			   $user = DT_Session::get('register.User');
		       DT_Session::clear('register.User');
			    DT_Session::set('register.User.process',$user['process']);
		       unset($user['process']);
		  
		       DT_Session::set('register.User.0',$user);
		   
		   }else{
			   
		   }

		   $paymethod = DT_Session::get('register.payment.method');
		   
		   if($paying_amount <= 0){
			  $function =  DT_Session::get('register.User.process');
			 
			  $tableUser = $this->getModel('user')->table;
			 
			  $tableUser->{$function}(DT_Session::get('register'));
			  
			  $messageTask = $function;

 $mainframe->redirect("index.php?option=com_dtregister&controller=message&Itemid=$Itemid&task=".$messageTask);
		    }else{
			
               $mainframe->redirect(JRoute::_("index.php?option=com_dtregister&controller=payment&task=methods",$xhtml_url));
			}

	   }

	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.User.eventId'));

	   $this->view->assign('header_eventId',$eventId);

	   $event = & DtrTable::getInstance('Event','Table');

	   $event->load($eventId );

	   $fieldtype =$this->getModel( 'fieldtype' );

	   $viewMemFields = "";

	   if(DT_Session::get('register.User.type')=='G'){

	     $back = JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=user&task=edit&back=1&userId=".DT_Session::get('register.User.userId'));

		  $type = 'B';

		   $members = DT_Session::get('register.User.members');
		    
		   $i = 0;
           if (is_array($members)) 
		   foreach($members as $key => $member){

		      $viewMemFields .= "<tr><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'><u>".JText::_( 'DT_MEMBER' ).($i+1)." </u></td></tr>";

		      $viewMemFields .= $event->viewFields('M',DT_Session::get('register.User.members.'.$key),false,'frmcart',false); 
			  $i++;

		   }

	   }else{

	      $back = JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&eventId=".$eventId."&controller=user&task=edit&back=1&userId=".DT_Session::get('register.User.userId'));

		  $type = 'I';

	   }

	   $TableUser =& DtrTable::getInstance('Duser','Table');

	   $TableUser->create(DT_Session::get('register.User'));

	   $feeObj = new DT_Fee($event,$TableUser);
       
	   $feeObj->setPaidAmount(DT_Session::get('register.User.fee.paid_amount'));

	   $feeObj->getFee(false);

	   $feesession = $feeObj;

	   unset($feesession->TableEvent);

	   unset($feesession->TableUser);
       

	   DT_Session::set('register.User.fee',(array)$feesession);
       
	   $this->view->assign('feeObj',$feeObj);

	   $this->view->assign('back',$back);

	   $this->view->assign('eventId',$eventId);

	   $event->load($eventId);

	   $this->view->assign( 'viewFields' ,$event->viewFields($type,DT_Session::get('register.User'),false,'frmcart',false));

	   $this->view->assign( 'viewMemFields',$viewMemFields);
	   
	   $this->view->assign( 'partial_payment_enable', $event->partial_payment_enable);

	   $this->display();	

	}

}

?>
<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class DtrController extends JController {

	 function __construct($config = array()){

		$this->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');

		parent::__construct($config);
        if(isset($config['task_map'])){
		  	foreach($config['task_map'] as $task=>$map){
				$this->registerTask( $task, $map );	
			}
		}
		$view = & $this->getView( $this->name, 'html' );
        $this->getModel('payoption');
		$this->config =  $this->getModel('config');

		$this->config->setGlobal();

		  global $sign_up_redirect,$Itemid,$private_event_notification,$private_event_redirect; 

		if($private_event_notification=='redirect'){

		   $sign_up_redirect = $private_event_redirect;

		}else{

		   $sign_up_redirect = "index.php?option=com_dtregister&controller=content&Itemid=$Itemid&task=sign_up";

		}

        $view->setModel($this->getModel('dtregister'),false);

		$view->setModel($this->getModel('config'),false);

		$view->setModel($this->getModel( 'Currency' ),false);

		$view->setModel($this->getModel( 'jomsocial' ),false);

		$view->setModel($this->getModel( 'cbprofiler' ),false);

		$view->setModel($this->getModel( 'buttoncolor' ),false);

		$view->setModel($this->getModel( 'dateformat' ),false);

		$view->setModel($this->getModel( 'paymentmethod' ),false);

		$view->setModel($this->getModel( 'cardtype' ),false);

		$view->setModel($this->getModel( 'paylater' ),false);	

		$view->setModel($this->getModel( 'country' ),false);

		$view->setModel($this->getModel( 'barcode' ),false);	

		$view->setModel($this->getModel( 'aro' ),false);	

		$view->setModel($this->getModel( 'permission' ),false);

		$view->setModel($this->getModel( 'aco' ),false);
		
		$this->getModel('field');

		$eventId = DT_Session::get('register.Event.eventId');
        
		if($this->checkpermission() === false){

			JRequest::setVar('task','auth');

	    }elseif($eventId ){
		   	$evtTable = $this->getModel('event')->table;
			$evtTable->load($eventId);
			$user	= & JFactory::getUser();
			if($evtTable->title !==""){
			  if((!($evtTable->TableCategory->access <=$user->get('aid')) || $evtTable->TableCategory->published == 0)&&$evtTable->TableCategory->categoryId > 0){
			   	 JRequest::setVar('task','auth');
			  }
			}
			
		}

	}

	function cbtest(){
		$model = $this->getModel('user');
		$table = $model->table;
		$table->load(53);
		$table->createCbUser();
   }

  function auth(){

	   $view = & $this->getView('authorize', 'html' );

	   $view->display();

  }

  function display() {

  //prd($this);

   $this->view->setLayout($this->_doTask);

   $this->view->display();

   //parent::display();

  }

  function checkpermission(){
     $user = &JFactory::getUser();
	 $aro = $this->getModel( 'aro' )->table->findaroByUser($user);
	 //$acoController = JRequest::getWord('controller');
	
	 $acoController = str_replace("dtregistercontroller",'',strtolower(get_class($this)));
	 $map = array('eventmanage' => 'event');
	 if(isset($map[$acoController])){
		$acoController =  $map[$acoController];
	 }
	
	 if(in_array(JRequest::getVar('task',$this->_taskMap['__default']),$this->_taskMap)){
		$task = JRequest::getVar('task',$this->_taskMap['__default']);
	 }else{
	 	$task = $this->_taskMap['__default'];
	 }
	
	 if($task == $this->_taskMap['__default'] && $task != 'eventlist' && $task !="index"){
	 	 $editaco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="edit" ');
		 $addaco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="add" ');
		 if(isset($editaco[0]) && isset($addaco[0])){
			 $editaco = $editaco[0];
			 $addaco = $addaco[0];
			 
			 $function = $editaco->type."Check";
			 
		     $edit_permission = $this->{$function}($editaco,$aro);
			 $function = $addaco->type."Check";
			 
		     $add_permission = $this->{$function}($addaco,$aro);
			
			 if($add_permission && $edit_permission){
				 return true;
			 }else{
				 return false;
			 }
			 
		 }
		 
	 }else{
	   
	   $aco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="'.$task.'" ');
	   $index = 0;
	   if($acoController == 'event' || $acoController == 'eventmanage' ) {
	   		if($task == 'publish' || $task == 'unpublish') {
				foreach($aco as $acodata) {
					if($acodata->type == "action") {
						$actionaco = $acodata;
					} else{
					    $sessionaco = $acodata;
					}
				}
				if($this->actionCheck($actionaco,$aro)) {
					return $this->sessionUserCheck($sessionaco,$aro);
				} else {
					return false;
				}
			}
	   }
	 
	   if(isset($aco[$index])){
		  
		   $aco = $aco[$index];
		   $function = $aco->type."Check";
		   return $this->{$function}($aco,$aro);
  
	   }
	 }
	 //die ;
	 return true;

  }
  function sessionUserCheck($aco,$aro){
	 
	 $user = &JFactory::getUser();
	  
	  if($aro !== false){
		 $permission = $this->getModel( 'permission' )->table->find('aro_id='.$aro->id.' and aco_id = '.$aco->id);
		
	     if($permission){
		    $cid = JRequest::getVar( 'cid', array(), 'request', 'array' );
			
		    if($cid){
		        $rowKey = $cid[0];
				$model = $this->getModel( $aco->controller );
				$table = $model->table;
				
				$data = $table->find(' user_id = '.$user->id.' and '.$table->_tbl_key.' = '.$rowKey);
				
				if($data){
					$return = true;
				}else{
					$return = false;
				}
				//$return = ($data)?true:false;
				
				return ($return);
				
	         }else{
			    return true;	 
			 }
	      }else{
			  
			 return true;  
		  }
		  return true;
	  }
	  
	 return false;
		
        //return ($permission);

  }
  
  function actionCheck($aco,$aro){

	  if($aro !== false){

			$permission = $this->getModel( 'permission' )->table->find('aro_id='.$aro->id.' and aco_id = '.$aco->id);

			 return ((boolean)$permission);

		}
		return true;
	  
  }
  
  function testemail(){
		global $subthanksemail,$thanksemail,$DT_mailfrom,$DT_fromname,$admin_registrationemail;
		
	   $Tagparser = new Tagparser();
	   //$Tagparser->getTagcontent('GROUP_MEMBER',$thanksemail);
	  // $Tagparser->replaceTagContent('GROUP_MEMBER',$thanksemail);
       $user = $this->getModel('user')->table;
	   $user->load(541);
	  // $user->TableEvent->load($user->eventId);
	  if($user->TableEvent->thksmsg_set){

		  $thkmsg = $user->TableEvent->thksmsg;   

	  }else{

		  $thkmsg = $thanksemail;

	  }
	  $subject = $Tagparser->parsetags($subthanksemail,$user);
	  echo "<br /><b>Subject : </b>".$subject."<br />";
	  $groupmsg = $Tagparser->getTagcontent('GROUP_MEMBER',$thkmsg);
	  
	  $memberdata = "" ;
	  if($user->type == 'G')
	   foreach($user->members as $member){
           
		//   pr($member);
	      // pr($groupmsg);
		   
		   $memberdata .= $Tagparser->parsetags($groupmsg,$member);	 	 

		}
		
		 $usermsg = $Tagparser->replaceTagContent('GROUP_MEMBER',$thkmsg,$memberdata);
		
          echo  $Tagparser->parsetags($usermsg,$user);
	  
	  echo "<br /> <b><<<<======================Admin Email=============================///>>></b>";
	  
	   pr($admin_registrationemail);
	  
	  $groupmsg = $Tagparser->getTagcontent('GROUP_MEMBER',$admin_registrationemail);
	  $usermsg = $Tagparser->replaceTagContent('GROUP_MEMBER',$admin_registrationemail);
	 
	   echo  $Tagparser->parsetags($usermsg,$user);
	   if($user->type == 'G')
	   foreach($user->members as $member){

		    echo  $Tagparser->parsetags($groupmsg,$member);   

		}
	   die;
	   
	 /* require_once(JPATH_SITE."/components/com_dtregister/views/email/view.html.php");

	  $emailview = new DtregisterViewEmail(array());

	  $emailview->assign('user',$user);

	  $emailview->assign('userdata', $Tagparser->userdata($user->userId));

	  $emailview->assign('paymentmethods',$Tagparser->paymentmethods);

	  $emailview->setLayout('registrationadmin');

	  $adminemails=$user->TableEvent->email;

	  $adminemails = explode(";",$adminemails);

	  ob_start();

	  $emailview->display();

	  echo $adminmsg = ob_get_clean();*/
  }
  
  
  function test2(){
	  
	  $user = $this->getModel('user')->table;
	  $user->eventId = 3;
	  $user->load(0);
	  $user->TableEvent->overrideGlobal($user->TableEvent->slabId);
	   global $DT_mailfrom,$DT_fromname;
	   global $currency_code,$email_cancel_confirm,$upsubcancelemail;
      $Tagparser = new Tagparser();
	  $msg = "";
	  $msg .= '<p>[EVENT_NAME] [LASTNAME]</p>';
	  
	  pr($msg) ;
	  $msg = $Tagparser->parsetags($msg,$user);
	  prd($msg);
	
	  
  }
  function testcancel(){
	   
	   $user = $this->getModel('user')->table;
	   $user->load(540);
	   $user->TableEvent->overrideGlobal($user->TableEvent->slabId);
	   global $DT_mailfrom,$DT_fromname;
	   global $currency_code,$email_cancel_confirm,$upsubcancelemail;
      $Tagparser = new Tagparser();
	  $msg = "";
	  $msg .= '<p>[FIRSTNAME] [LASTNAME] '.JText::_('DT_ADMIN_MSG_CANCEL').' [EVENT_NAME]</p>';
	  $msg .= '<table class="message">';
		
	  $msg.="<tr><td>".JText::_('DT_CONFIRMATION_NUMBER').": </td><td>[CONFIRM_NUM]</td></tr>";
	  $msg.="<tr><td>".JText::_('DT_REGISTRATION_FEE').": </td><td>[AMOUNT]</td></tr>";
	  $msg.="<tr><td>".JText::_('DT_AMOUNT_PAID').": </td><td>[AMOUNT_PAID] </td></tr>";
	  $msg.="<tr><td>".JText::_('DT_PAYMENT_TYPE').": </td><td>[PAYMENT_TYPE]</td></tr>";
	 
      if( $user->TableFee->cancelfee > 0 ){
     
		$msg.="<tr><td>".JText::_('DT_CANCEL_FEE').": </td><td>[CANCEL_FEE]</td></tr>";
		$amount_due = $user->TableFee->fee -  $user->TableFee->paid_amount;
		if($amount_due > 0){  
		   $label = JText::_('DT_AMOUNT_DUE');
		}else{
		   $label = JText::_('DT_REFUND_DUE');
		}
		
		$msg.="<tr><td>".$label.": </td><td>[AMOUNT_DUE]</td></tr>";
	   
     }
  
     $msg .="</table>";
	 
	 $msg = $Tagparser->parsetags($msg,$user);
  	 $adminemails=$user->TableEvent->email;
     $adminemails = explode(";",$adminemails);
     $conf = &JFactory::getConfig();
     if($DT_mailfrom == ""){
        $DT_mailfrom = $conf->_registry['config']['data']->mailfrom;
     }
     if($DT_fromname==""){
        $DT_fromname =$conf->_registry['config']['data']->fromname;
     }
 // $mosConfig_mailfrom = $conf->_registry['config']['data']->mailfrom;
 // $mosConfig_fromname =$conf->_registry['config']['data']->fromname;
   echo "<br />".$msg;
    foreach($adminemails as $email){
   
      // JUTility::sendMail( $DT_mailfrom, $DT_fromname,$email,JText::_('DT_ADMIN_SUBJECT_CANCEL'),$msg,1,null,null);
    }
	
   $message = $Tagparser->parsetags($email_cancel_confirm,$user);
   $subject = $Tagparser->parsetags($upsubcancelemail,$user);
   
   $email = $user->getFieldByName('email');
    
   echo "<br /><b>Subject </b> : ".$subject;
   echo "<br />".$message;
	  
  }
  
  function testcontroller(){
	  // is_anyregistration  is fine .
      $eventTable = $this->getModel('event')->table;
	  $eventTable->load(101);
	  $oldrepetitions = $eventTable->getrepetions();
	 $data = array (
  'data' => 
  array (
    'event' => 
    array (
      'user_id' => '',
      'title' => 'Testing Still',
      'category' => '',
      'location_id' => '',
      'publish' => '0',
      'timeformat' => '1',
      'dtstart' => '2011-03-31',
      'dtstarttime' => '09:28 PM',
      'dtend' => '2011-03-31',
      'dtendtime' => '10:28 PM',
      'email' => 'dthdev@dthdevelopment.com',
      'repeatType' => 'weekly',
      'rpinterval' => '1',
      'countselector' => 'count',
      'rpcount' => '3',
      'rpuntil' => '',
      'weekdays' => 
      array (
        0 => '3',
      ),
      'monthdays' => '',
      'monthdayselector' => 'monthweekdays',
      'registration_type' => 'individual',
      'group_registration_type' => 'detail',
      'public' => '1',
      'max_registrations' => '0',
      'min_group_size' => '2',
      'max_group_size' => '0',
      'startdate' => '0000-00-00',
      'starttime' => '12:00 AM',
      'cut_off_date' => '0000-00-00',
      'cut_off_time' => '12:00 AM',
      'waiting_list' => '0',
      'article_id' => '',
      'detail_itemid' => '0',
      'detail_link_show' => '0',
      'show_registrant' => '0',
      'prevent_duplication' => '1',
      'usetimecheck' => '0',
      'excludeoverlap' => '0',
      'usercreation' => '0',
      'imagepath' => '',
      'payment_id' => '1',
      'partial_payment' => '0',
      'partial_amount' => '',
      'partial_minimum_amount' => '',
      'tax_enable' => '0',
      'tax_amount' => '0.00',
      'discount_type' => '0',
      'discount_amount' => '0.00',
      'bird_discount_type' => '0',
      'bird_discount_amount' => '',
      'bird_discount_date' => '0000-00-00',
      'bird_discount_time' => '12:00 AM',
      'latefee' => '0.00',
      'latefeedate' => '0000-00-00',
      'latefeetime' => '12:00 AM',
      'use_discountcode' => '0',
      'topmsg' => '',
      'event_describe_set' => '0',
      'event_describe' => '',
      'thanksmsg_set' => '0',
      'thanksmsg' => '',
      'pay_later_thk_msg_set' => '0',
      'pay_later_thk_msg' => '',
      'terms_conditions_set' => '0',
      'terms_conditions_msg' => '',
      'thksmsg_set' => '0',
      'thksmsg' => '',
      'admin_notification_set' => '0',
      'admin_notification' => '',
      'partial_payment_enable' => '0',
      'cancel_refund_status' => '0',
      'edit_fee' => '0',
      'change_date' => '',
      'change_time' => '12:00 AM',
      'cancel_enable' => '0',
      'cancel_date' => '',
      'cancel_time' => '12:00 AM',
      'changefee_enable' => '0',
      'changefee_type' => '1',
      'changefee' => '0.00',
      'cancelfee_enable' => '0',
      'cancelfee_type' => '1',
      'cancelfee' => '0.00',
      'slabId' => '101',
    ),
    'group' => 
    array (
      0 => 
      array (
        'member' => '1',
        'amount' => '0.00',
      ),
      1 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      2 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      3 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      4 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      5 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      6 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      7 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      8 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      9 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      10 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      11 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      12 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      13 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      14 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      15 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      16 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      17 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      18 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      19 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      20 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      21 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      22 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      23 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      24 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      25 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      26 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      27 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      28 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      29 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
      30 => 
      array (
        'member' => '0',
        'type' => 'per_person',
        'amount' => '0.00',
      ),
    ),
    'discountcode' => 
    array (
      0 => '3',
      1 => '4',
    ),
    'field' => 
    array (
      1 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '2',
      ),
      2 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '3',
      ),
      3 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '3',
      ),
      13 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '1',
      ),
      12 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '1',
      ),
      4 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      5 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      6 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '3',
      ),
      7 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '3',
      ),
      8 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      9 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '2',
      ),
      10 => 
      array (
        'showed' => '-1',
        'required' => '1',
        'group_behave' => '3',
      ),
      11 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '3',
      ),
      21 => 
      array (
        'showed' => '-1',
        'required' => '0',
      ),
      20 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      17 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      27 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      32 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      33 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
      34 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '2',
      ),
      42 => 
      array (
        'showed' => '-1',
        'required' => '0',
      ),
      38 => 
      array (
        'showed' => '-1',
        'required' => '0',
        'group_behave' => '1',
      ),
    ),
  ),
  'articlesection' => '',
  'articlecategory' => '',
  'option' => 'com_dtregister',
  'controller' => 'event',
  'task' => 'save',
);
$data = $data['data'];
	  prd($eventTable->validDateChange($data));
	  //$this->validDateChange();
	  //prd($eventTable->is_anyregistration($oldrepetitions));
  }

}

?>
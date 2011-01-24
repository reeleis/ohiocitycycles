<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

class DtregisterControllerValidate extends DtrController {

   var $name = "Validate";

    function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'Validate', 'html' ); 

	}

   function discountcode(){
	   
	   //$userIndex = DT_Session::get('register.Setting.current.userIndex');
	   $eventId = JRequest::getVar('eventId',DT_Session::get('register.Event.eventId'));
	   $event = & DtrTable::getInstance('Event','Table');
	   $event->load($eventId );
	   $error = true;
	   if(isset($_REQUEST['discount_code']) && $_REQUEST['discount_code'] != ""){
			
			 $discount_code_id = $event->validate_code($_REQUEST['discount_code']); 
			if($discount_code_id !== false){
			   $error = false ;	
			  // DT_Session::set('register.User.'.$userIndex.'.discount_code_id', $discount_code_id );
			}else{
			  // DT_Session::set('register.User.'.$userIndex.'.discount_code_id', false );
			   $error = true ;	
			  $this->view->assign('discountCodeError',$event->TableEventdiscountcode->TableDiscountcode->error );
			    $event->TableEventdiscountcode->TableDiscountcode->error ;
			}
			
		}
		///ob_clean();
		echo ($error)?'false':'true';
		die;
	      
   }

	function captcha(){

	    $database = &JFactory::getDBO();

		$code=JRequest::getVar('captcha','');

		$userIp=$_SERVER['REMOTE_ADDR'];

		//Check database

		$sql="Select count(*) From #__dtregister_captcha where user_ip='$userIp' and code='$code'";

		$database->setQuery($sql);

		$total=$database->loadResult();

		//$_SESSION['register']['secCheck'] = $total;

		if($total){

			echo "true";

		}else{

			echo "false";

		}

die;

	}

	function email(){

	    global $usercreation;

		$database = &JFactory::getDBO();

		ob_clean();

		$sql="Select config_value From #__dtregister_config where config_key = 'prevent_duplication'";

		$database->setQuery($sql);

		$prevent_duplication=$database->loadResult();
		
		$eventId=$_GET['eventId'];
		
		$sql="Select config_value From #__dtregister_config where config_key = 'prevent_duplication'";

		$database->setQuery($sql);

		$prevent_duplication=$database->loadResult();

		$global_prevent_duplication = $prevent_duplication;

		$eventTable =& DtrTable::getInstance('Event','Table');

		$eventTable->load($eventId);

		$eventTable->overrideGlobal($eventId);
		
		$usercreation = $eventTable->usercreation;
		 $my = &JFactory::getUser();
		
		$field_id = key($_REQUEST['Field']);
		$email=array_pop($_REQUEST['Field']);
		
		if(!$my->id &&  $usercreation > 0){

			$sql="SELECT COUNT(*) FROM #__users WHERE email='$email' ";

			$database->setQuery($sql);

			$total=$database->loadResult();

			if($total){

				echo JText::_( 'DT_JOOMLA_EMAIL_EXISTS' );

			}else{

			    echo "true";	

			}
			
			die ;
		}

		if($prevent_duplication==1){

		  $prevent_duplication = $global_prevent_duplication;

		}else{

		  $prevent_duplication = 0;

		}
		
		if(!$prevent_duplication || isset($_REQUEST['dup_check'])){

			echo "true";	

		}else{
            
			$sql="SELECT COUNT(*) FROM #__dtregister_user u inner join #__dtregister_user_field_values v on u.userId  = v.user_id   WHERE eventId='$eventId'  AND v.field_id = $field_id  and v.`value` = '$email' and u.cancel <> 1";

			$database->setQuery($sql);

			$total=$database->loadResult();

			if($total){

				echo JText::_('DT_ALREADY_REGISTERED');

			}else{

				echo "true";

			}

		}

die;

    }

	function uniqueUser(){

	    $my = &JFactory::getUser();

		$database = &JFactory::getDBO();

		if(isset($_GET['username'])){

		   $username = $_GET['username'];

		   $where = " username='".$username."' ";

		}else{

		   $email=array_pop($_GET['Field']);

		   $where = " email='".$email."' ";

		}

		$sql="SELECT COUNT(*) FROM #__users WHERE $where ";

		$database->setQuery($sql);

		$total=$database->loadResult();

		if($total){

			echo JText::_( 'DT_JOOMLA_USERNAME_EXISTS' );

		}else{

		   echo "true";

		}
	
die;

	}	

}

?>
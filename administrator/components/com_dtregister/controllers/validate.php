<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerValidate extends DtrController {
   
   var $name = "Validate";
   
    function __construct($config = array()){
		 
		 parent::__construct($config);
		 $this->view = & $this->getView( 'Validate', 'html' );
		
	}
	
   function paymentName(){
	   $name=JRequest::getVar('data','');
	   $name = $name['payment']['name'];
	   $database = &JFactory::getDBO();
	   $query = "select count(*) from #__dtregister_payment where name='".$name."'";
	   $database->setQuery($query);
	   $total=$database->loadResult();
	   echo ($total)?'false':'true';
	      	
	}
	
	function captcha(){
	   
	   $database = &JFactory::getDBO();

		 $code=JRequest::getVar('captcha','');
	
		$userIp=$_SERVER['REMOTE_ADDR'];
	
		//Check database
	
		$sql="Select count(*) From #__dtregister_captcha where user_ip='$userIp' and code='$code'";
	
		$database->setQuery($sql);
	
		$total=$database->loadResult();
	
		$_SESSION['register']['secCheck'] = $total;
		
		if($total){
	
			echo "true";
	
		}else{
	
			echo "false";
	
		}
		   
	}
	
	function email(){
	    global $usercreation;
		$database = &JFactory::getDBO();
		ob_clean();
		$sql="Select config_value From #__dtregister_config where config_key = 'prevent_duplication'";
		$database->setQuery($sql);
		$prevent_duplication=$database->loadResult();
		$global_prevent_duplication = $prevent_duplication;
		$eventTable  =& DtrTable::getInstance('Event','Table');
		$eventId=$_GET['eventId'];
			
		$eventTable->overrideGlobal($eventId);
		 $my = &JFactory::getUser();
		if(!$my->id &&  $usercreation==1){
			
			$email=array_pop($_GET['Field']);
		
			
			$sql="SELECT COUNT(*) FROM #__users WHERE email='$email' ";
	
			$database->setQuery($sql);
	
			$total=$database->loadResult();
			
			if($total){
	
				echo "false";
			
			}else{
			    echo "true";	
			}
			
		}
		if($prevent_duplication==1){
		  $prevent_duplication = $global_prevent_duplication;
		}else{
		  $prevent_duplication = 0;
		}
		
		if(!$prevent_duplication){
	
			echo "true";	
	
		}else{
	
			$email=array_pop($_GET['Field']);
	        $field_id = key($_GET['Field']);
			$sql="SELECT COUNT(*) FROM #__dtregister_user u inner join #__dtregister_user_field_values v u.userId  = v.user_id on  WHERE eventId='$eventId'  AND userEmail='$email' and u.cancel <> 1";
	
			$database->setQuery($sql);
	
			$total=$database->loadResult();
	
			if($total){
	
				echo "false";
	
			}else{
	
				echo "true";
	
			}
	
		}

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

			echo "false";

		}else{
		   echo "true";
		}
	   
	}
	
}
	
?>
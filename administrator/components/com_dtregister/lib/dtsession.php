<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DT_Session{

   function restore(){
	    //  need changes in set function 
	   $session =& JFactory::getSession();
	   if($session->has('DTH','dtregister')){
	     if($session->has('DTH','dtregisterdup')){
			 $DTregisterdup = & $session->get('DTH','null','dtregisterdup');
		 }else{
			  return;
	     }
		 $DTregister = & $session->get('DTH','null','dtregister');
		 $DTregister = $DTregisterdup;
	   }else{
		   $session->set('DTH',array(),'dtregister');
		   
		   if($session->has('DTH','dtregisterdup')){
			 $DTregisterdup = & $session->get('DTH','null','dtregisterdup');
		   }else{
			  return;
	       }
		   $DTregister = & $session->get('DTH','null','dtregister');
		   $DTregister = $DTregisterdup;
	   }
   }   

   function set($path='',$value=""){
    
      $session =& JFactory::getSession();
	  
      if($session->has('DTH','dtregister')){

	     $DTregister = & $session->get('DTH','null','dtregister');	
         
	  }else{
		  
		 $session->set('DTH',array(),'dtregister');
         
	     //$DTregister = $_SESSION['DTregister'] = array();
		 
		 $DTregister = & $session->get('DTH','null','dtregister');
		  
	  }
      
	  if($path!=""){

	     $depth = explode('.',$path);
		 
         $str = "";
		 foreach($depth as $key=>$e){
			  
				$str .="['".$e."']";
			
		 }

		   $eval = "\$DTregister$str = \$value;";
		   if(!(isset($_REQUEST['tmpl']) || isset($_REQUEST['no_html']) || isset($_REQUEST['format']))){
		     //pr($eval);
		   }
		   eval($eval);

		 if($session->has('DTH','dtregisterdup')){
			 
		 }else{
			  $session->set('DTH',array(),'dtregisterdup');
	     }
		 $_SESSION['__dtregister']['DTH'] = $DTregister;
		 $DTregisterdup = & $session->get('DTH','null','dtregisterdup');
		 
		 $DTregisterdup = $DTregister;
	
	  }
	  //die;

   }

   function get($path=""){
      
      $session =& JFactory::getSession();
	  if($path!=""){

	    $pathElements = explode(".", $path);
        $DTregister =& $session->get('DTH',null,'dtregister');
		$pathdata = $DTregister;
        $emptyResponse = false;
		$str = "";
		foreach($pathElements as $key=>$e){
			  
				$str .="['".$e."']";
				
				if(!isset($pathdata[$e])){
				   	return false;
			    }
				if ($pathdata[$e] === "") return $emptyResponse;
			    $pathdata = $pathdata[$e];	
			 
		}
		unset($pathdata);
		$pathdata = $DTregister;

		   $eval = "\$value = \$pathdata$str;";
		   if(!(isset($_REQUEST['tmpl']) || isset($_REQUEST['no_html']) || isset($_REQUEST['format']))){
  		      //pr($eval);
		   }
		   eval($eval);
		   return $value;
		$emptyResponse = false;

		// Go through path elements

		foreach ($pathElements as $e) {

			// Check set

			if (!isset($pathdata[$e])) return $emptyResponse;

			// Check empty

			if ($pathdata[$e] === "") return $emptyResponse;

			// Update path

			$pathdata =& $pathdata[$e];

		  }

		 return $pathdata;

      }else{
		  
	  }

  }
  
  function clear($path){
	   $session =& JFactory::getSession();
	   $DTregister = & $session->get('DTH','null','dtregister');
	   $namespace = "__default";
	   if($path!=""){
		   $pathElements = explode(".", $path);
		   $pathdata =  $DTregister;
		   $str = "['__default']['DTH']";
		   $str = "";
		  
		   if($pathdata == "" || $pathdata == "null") return; 
		   foreach($pathElements as $key=>$e){
			   
			    if(!isset($pathdata[$e])){
					 //$eval = "unset(\$DTregister$str);";
		            
		             //eval($eval);
				   	return;
			    }
				if($pathdata[$e] === ""){ prd('good');
				    return;	
				}
				
				 $pathdata = $pathdata[$e];	
				 $str .="['".$e."']";

		   }
		  // unset(${'DTregister'.$str});
		   $eval = "unset(\$DTregister$str);";
		   
		   eval($eval);
		  
	   }else{
		  //pr('session cleared');
		  //$session->clear('DTH','dtregisterdup');
		  
	   }
  }

  function clearAll(){
	  //echo "<pre>";
	  //debug_print_backtrace();
	  //prd('clear');
	
	  $session =& JFactory::getSession();
	  $session->clear('DTH','dtregister');
  }
  
  function restoreFromPayment($paypal_session_id = 0){
	 $database = &JFactory::getDBO();
		
	    $sql  = "select * from #__dtregister_session where id=$paypal_session_id";
        $database->setQuery($sql);
        $database->query();
       // echo $database->getQuery();
		$row = $database->loadObjectList();
		
        $data = unserialize($row[0]->data);
        $dt_userId = $row[0]->user_id;
		$session =& JFactory::getSession();
		
		
		DT_Session::set('register.restore.userId',$dt_userId);
		DT_Session::set('register.restore.processed',$row[0]->processed);
		DT_Session::set('register.restore.id',$paypal_session_id);
		
		$session->getToken(true); 
		//$session->fork();
		$_SESSION = $data;
		$session->set('session.timer.start',strtotime('now'));
		$session->set('session.counter',1);
		
		$session->set('session.timer.last',(strtotime('now')));
		$session->set('session.timer.now',(strtotime('now')));  
		
		$session->set('__dtregister',$data['__dtregister']);
		$_SESSION['__dtregister'] = $data['__dtregister'];
		//pr($session->getExpire());
		//pr($session->getStores());
		//pr($session->getState());
		//pr($session);
		
  }
  
}

?>
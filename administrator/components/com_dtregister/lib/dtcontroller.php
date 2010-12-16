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
        $this->getModel('payoption') ;
		$this->config =  $this->getModel('config');

		$this->config->setGlobal();

		  global $sign_up_redirect , $Itemid , $private_event_notification , $private_event_redirect; 

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
	
	 $acoController = str_replace("dtregistercontroller",'',strtolower(get_class($this))) ;
	 $map = array('eventmanage' => 'event');
	 if(isset($map[$acoController])){
		$acoController =  $map[$acoController];
	 }
	
	 if(in_array(JRequest::getVar('task',$this->_taskMap['__default']),$this->_taskMap)){
		$task =  JRequest::getVar('task',$this->_taskMap['__default']) ;
	 }else{
	 	$task =  $this->_taskMap['__default'] ;
	 }
	 
	 if($task == $this->_taskMap['__default'] ){ 
	 	 $editaco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="edit" ');
		 $addaco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="add" ');
		 if(isset($editaco[0]) && isset($addaco[0])){
			 $editaco = $editaco[0] ;
			 $addaco = $addaco[0] ;
			 
			 $function = $editaco->type."Check";
			 
		     $edit_permission = $this->{$function}($editaco,$aro);
			 $function = $addaco->type."Check";
			 
		     $add_permission = $this->{$function}($addaco,$aro);
			
			 if($add_permission && $edit_permission){
				 return true ;
			 }else{
				 return false ;
			 }
			 
		 }
		 
	 }else{
	   
	   $aco = $this->getModel( 'aco' )->table->find(' controller="'.$acoController.'" and task="'.$task.'" ');
	   
	   if(isset($aco[0])){
		  
		   $aco = $aco[0];
		   $function = $aco->type."Check";
		   return $this->{$function}($aco,$aro);
  
	   }
	 }
	 
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
	   global $subthanksemail , $thanksemail ,$DT_mailfrom ,$DT_fromname,$admin_registrationemail;
	   
	   $Tagparser =  new Tagparser();
	   //$Tagparser->getTagcontent('GROUP_MEMBER',$thanksemail);
	  // $Tagparser->replaceTagContent('GROUP_MEMBER',$thanksemail);
       $user = $this->getModel('user')->table;
	   $user->load(75);
	   
	    if($user->TableEvent->thksmsg_set){

		  $thkmsg = $user->TableEvent->thksmsg;   

	  }else{

		  $thkmsg = $thanksemail;

	  }
	 // $subject = $Tagparser->parsetags($subthanksemail,$user);
	  echo "<br /><b>Subject : </b>".$subject."<br />";
	  //$groupmsg = $Tagparser->getTagcontent('GROUP_MEMBER',$thkmsg);
	 // $usermsg = $Tagparser->replaceTagContent('GROUP_MEMBER',$thkmsg);
     // echo  $Tagparser->parsetags($usermsg,$user);
	  if($user->type == 'G')
	   foreach($user->members as $member){

		   // echo  $Tagparser->parsetags($groupmsg,$member);	 	 

		}
	  
	  echo "<br /> <b><<<<======================Admin Email=============================///>>></b>";
	  
	  $groupmsg = $Tagparser->getTagcontent('GROUP_MEMBER',$admin_registrationemail);
	  $usermsg = $Tagparser->replaceTagContent('GROUP_MEMBER',$admin_registrationemail);
	 
	   echo  $Tagparser->parsetags($admin_registrationemail,$user);
	   if($user->type == 'G')
	   foreach($user->members as $member){

		    echo  $Tagparser->parsetags($groupmsg,$member);   

		}
	   
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

}

?>
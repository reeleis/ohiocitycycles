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

class DtregisterControllerUser extends DtrController {

   var $name ='user';

   function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'user', 'html' );  

		 $this->view->setModel($this->getModel('user'),true);

		 $this->view->setModel($this->getModel('paymentmethod'));

         $this->view->setModel($this->getModel('event'));
		 
		 $this->registerTask( 'new', 'add' );

		 $this->registerDefaultTask("index");

		 JToolBarHelper::title(  JText::_( 'DT_REGISTRATION_RECORDS'), 'dtregister' );

	}

   function delete(){
	   
	   global $mainframe;
	   $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	   
	    $mUser =$this->getModel( 'user' );
		
		if (is_array($cid)) 
		foreach($cid  as $userId){
			$mUser->table->delete($userId);
		}
	   	 $mainframe->redirect( "index2.php?option=".DTR_COM_COMPONENT."&controller=user" );
	}

   function resendthkemail(){
	   
	    global $mainframe;
	    $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	   
	    $mUser =$this->getModel( 'user' );
		
		if (is_array($cid)) 
		foreach($cid as $userId){
			$mUser->table->load($userId);
			$mUser->table->registrantemail();
		}
	   	 $mainframe->redirect( "index2.php?option=".DTR_COM_COMPONENT."&controller=user" );
	      
   }
   
   function order($inc){

       global $mainframe;

	   $row = $this->getModel('field')->table;

       $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	   $uid = $cid[0];

	   $row->load( (int)$uid );

	   $row->reorder();

	   $row->move( $inc, true );

	 $mainframe->redirect( "index2.php?option=".DTR_COM_COMPONENT."&controller=field" );

   }

   function index(){

   	   JToolBarHelper::title(  JText::_( 'DT_REGISTRATION_RECORDS'), 'dtregister' );

	   JToolBarHelper::addNew('group_registration',JText::_( 'DT_GROUP_REGISTRATION'));

       JToolBarHelper::divider();

	   JToolBarHelper::addNew('new',JText::_( 'DT_INDIVIDUAL_REGISTRATION'));

       JToolBarHelper::divider();

	   JToolBarHelper::editList('edit');

	   JToolBarHelper::divider();
	   
	   JToolBarHelper::deleteList(JText::_("DT_DELETE_USER"),'delete');

	   JToolBarHelper::divider();
	   
	   JToolBarHelper::assign('resendthkemail',JText::_('DT_RESEND_THANKS_EMAIL'));
	   
	   JToolBarHelper::divider();
	   
	   JToolBarHelper::assign('attend',JText::_('DT_ATTENDED'));

	global $mainframe;

	 $option = DTR_COM_COMPONENT;

	jimport('joomla.html.pagination');

	$listLimit = $mainframe->getCfg( 'list_limit', 10 );

    $limit = intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $listLimit ) );

    $limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );

	$limitstart = intval( $mainframe->getUserStateFromRequest( "viewuser{$option}limitstart", 'limitstart', 0 ) );

	$search = $mainframe->getUserStateFromRequest( 'dtreg_user_search.search', 'search', array(),'array'  );
	$filter_order = $mainframe->getUserStateFromRequest( 'dtreg_user_order.filter_order', 'filter_order', 'date'  );
	
	$filter_order_Dir = $mainframe->getUserStateFromRequest( 'dtreg_user_dir.filter_order_Dir', 'filter_order_Dir', 'desc'  );
	
	$where = array();

	$mUser = $this->getModel('user');

	$tUser = $mUser->table;

	$fieldSelectQuery = $tUser->TableUserfield->pivotFields();

    $query = "Select SQL_CALC_FOUND_ROWS u.*, f.* ,f.status fee_status , u.status user_status , e.title , d.code , e.dtstart , e.slabId  from #__dtregister_user u 

	           left join #__dtregister_group_event e on u.eventId = e.slabId  

			   left join #__dtregister_fee f on f.user_id = u.userId

			   left join #__dtregister_codes d on d.id = u.discount_code_id 

			   ";
	
    $Andwhere =  array();
	if (isset($search['eventId']) && $search['eventId']!="") {

      $Andwhere[] = "e.slabId=".$search['eventId'];

	}

	if (isset($search['fee_status']) &&  $search['fee_status']!="") {

        if($search['fee_status'] == 1){

		   	$Andwhere[] = "f.status=0 and f.payment_method='authorizenet'";

		}else{

			$Andwhere[] = '((f.payment_method  is null || f.payment_method != "authorizenet") || (f.status=1 and f.payment_method="authorizenet"))';

		}

	}

	if (isset($search['attend']) && $search['attend']!="" && $search['attend']!=-1) {

		$Andwhere[] = "u.attend=".$search['attend'];

	}

    if (isset($search['status']) && $search['status']!="") {

		$Andwhere[] = "u.status=".$search['status'];

	}

	 if (isset($search['event_archive']) && $search['event_archive']!="" && $search['event_archive']!=-1) {

		$Andwhere[] = "e.archive=".$search['event_archive'];

	}elseif(!isset($search['event_archive'])|| $search['event_archive'] !=-1 ){
	   	$Andwhere[] = " e.archive= 0";
	}

	$grpByHaving = "";

	if (isset($search['query']) && $search['query']!="") {

		if (get_magic_quotes_gpc()) {

		    $search['query'] = stripslashes( $search['query']);

	    }

		$searchQuery = $tUser->_db->getEscaped( trim( strtolower( $search['query'] ) ) );

		$searchJoinSql = " inner join ( select distinct user_id from #__dtregister_user_field_values where value like '%".$searchQuery."%' ) searchable on u.userId = searchable.user_id ";

		$query .= $searchJoinSql;

        $Orwhere = array();

		if (get_magic_quotes_gpc()) {

		    $search['query'] = stripslashes( $search['query']);

	    }

		$grpByHaving = " having ";

		$grpByHaving .= $mUser->searchQuery('u',$searchQuery);

	}

		$mUser->orderBYPivot($query,$filter_order);

	  
	$where = (count($Andwhere)>0)?" where ".implode(' and ', $Andwhere):'';

	//$query .= " $where group  by u.userId ".$grpByHaving;

	$query .= " $where ";

	
	
	$query .= $mUser->orderBy($filter_order,$filter_order_Dir);

// pr($query);

	$rows = $tUser->query($query,$limitstart,$limit);

	$total = $tUser->getLastCount();

	$pageNav = new JPagination( $total, $limitstart, $limit  );

    $this->view->assign('rows',$rows);

	$this->view->assign('mUser',$mUser);

	$this->view->assign('pageNav',$pageNav);

	$this->view->assign('search',$search);

    $this->view->setLayout('list');

	$this->view->assign('eventId',(isset($search['eventId']))?$search['eventId']:'');

	$this->view->display();

   }

   function add(){

		global $mainframe,$now;

		if(isset($_POST['formsubmit'])){

			$data = JRequest::getVar('User',array(),null,'array');
	
			$data['fields'] = JRequest::getVar('Field',array(),null,'array');
	
			$eventId = $data['eventId'];
	
			$event = & DtrTable::getInstance('Event','Table');
	
			$event->load($eventId );
	
			if(isset($data['discount_code']) && $data['discount_code']!=""){	
	
				$discount_code_id = $event->validate_code($data['discount_code']); 
	
				unset($data['discount_code']);
	
				if($discount_code_id !== false){
	
					$data['discount_code_id'] = $discount_code_id;
	
				} else {
	
					$data['discount_code_id'] = false;
	
	$this->view->assign('discountCodeError',$event->TableEventdiscountcode->TableDiscountcode->error );
	
				}
	
			}
	
			$TableUser =& DtrTable::getInstance('Duser','Table');

			$confirmNum = $TableUser->generateconfirmNum();
			
			$data['confirmNum'] = $confirmNum;
			$data['register_date'] = $now->toMySQL(true);
			
			$TableUser->create($data);

			$feeObj = new DT_Fee($event,$TableUser);
	
			$feeObj->getFee(($data['user_id']=="")?false:true);
	
			$feeObj->setPaidMethod($data['Fee']['payment_method']);
	
			$feeObj->setPaidAmount($data['Fee']['paid_amount']);
	
			$feeObj->setPaidStatus($data['Fee']['status']);
	
			$fee = $feeObj;
	
			unset($fee->TableEvent);
	
			unset($fee->TableUser);
	
			$data['fee'] = (array)$fee;
			
			if(isset($_POST['sendemail'])){
				$TableUser->sendemail = true; 
			} else {
				$TableUser->sendemail = false;
			}
			if($data['Fee']['payment_method'] == 'offline_payment') {
				
				DT_Session::set('register.payment.offline_process',true);
				DT_Session::set('register.payment.billing', $_POST['billing']);
				
			}
			$TableUser->register($data);
			DT_Session::clear('register.payment.offline_process');
			DT_Session::clear('register.payment.billing');
			
			$mainframe->redirect("index.php?option=com_dtregister&controller=user&task=index");

		}

		JToolBarHelper::save('add',JText::_( 'DT_SAVE'));
		JToolBarHelper::divider();
		JToolBarHelper::cancel( 'cancel', JText::_( 'DT_CLOSE') );
		
		$cid = JRequest::getVar('cid',array(),null,'array');
		
		$mUser = $this->getModel('user');
		$tUser = $mUser->table;
		$tUser->type = 'I';
		$search = JRequest::getVar('search');
		$eventId = $search['eventId'];
		$tUser->TableEvent->load($eventId);
		$type = ($tUser->type=='I')?'I':'B';
		$memtot = ($tUser->type=='I')?1:2;	
		
		// Check for capacity registration for a particular event		
		
		$eventTable = $this->getModel('event')->table;
		$eventTable->load($eventId);
		$registered = $eventTable->getTotalregistered($eventId);
		$max_registrations = $eventTable->max_registrations;
		
		if ($max_registrations > $registered) {
			$availableSpots = $max_registrations - $registered;
		} elseif($max_registrations !=0 ){
			
		$mainframe->redirect("index.php?option=com_dtregister&controller=user",JText::_('DT_ALERT_FULL_EVENT'));
			exit;
		}

		$this->view->assign( 'form' ,$tUser->TableEvent->form($type,(array)$tUser,false,'adminForm',false));
		$this->view->assign('mUser',$mUser);
		$this->view->assign('eventId',$eventId);
		$this->view->assign('type',$type);
		$this->view->assign('memtot',$memtot);
		$this->view->setLayout('add');	
		$this->display();

   }
   
   function event_full() {
		global $mainframe,$now;
						
		$this->view->setLayout('event_full');		
		$this->display();
   
   }

   function edit(){

	    global $mainframe;

	    $mUser = $this->getModel('user');

	   $tUser = $mUser->table;

	   if(isset($_POST['formsubmit']) && $_POST['formsubmit']=='edit'){

		    $tUser->load($_POST['User']['userId']);

			$data = $_POST['User'];

			// $data['memtot'] = $tUser->memtot;

			$data['fields'] = JRequest::getVar('Field',array(),null,'array');

			$data['members'] = $tUser->members;

			$data['discount_code_id'] = $tUser->discount_code_id;

	        $eventId = $data['eventId'];

	        $event = & DtrTable::getInstance('Event','Table');

	        $event->load($eventId );

			if($data['discount_code_id']!=""){

			 $event->loadDiscountCode($data['discount_code_id']);

			}

			$TableUser =& DtrTable::getInstance('Duser','Table');

	        $TableUser->create($data);

			$feeObj = new DT_Fee($event,$TableUser);

		    $feeObj->getFee(($data['user_id']=="")?false:true);

		    $feeObj->setPaidMethod($data['Fee']['payment_method']);

		    $feeObj->setPaidAmount($data['Fee']['paid_amount']);

			$feeObj->setPaidStatus($data['Fee']['status']);

		    $fee = $feeObj;
			$fee->fee = $_POST['User']['Fee']['fee'];
			
		    unset($fee->TableEvent);

		    unset($fee->TableUser);

			unset($data['members']);

		    $data['fee'] = (array)$fee;

			$data['fee']['id'] = $tUser->TableFee->id;

			unset($data['discount_code']);

			//prd($data);
			$paid_status_change = false;
		    if($tUser->TableFee->status != $data['Fee']['status']){
				$paid_status_change = true;
			}
			$status_change = false;
			if($tUser->status != $data['status']){
				$status_change = true;
			}
			if($data['Fee']['payment_method'] == 'offline_payment') {
				
				DT_Session::set('register.payment.offline_process',true);
				DT_Session::set('register.payment.billing', $_POST['billing']);
				
			}
			$TableUser->save($data);
			DT_Session::clear('register.payment.offline_process');
			DT_Session::clear('register.payment.billing');
			$tUser->load($_POST['User']['userId']);
			
			if($status_change){
				
				$tUser->status_change_email();
			}

			if($paid_status_change){
     			$tUser->TableFee->status = $data['Fee']['status'];
     			$tUser->fee_status_change_email();
   			}
			
			$mainframe->redirect("index.php?option=com_dtregister&controller=user");

			die;

	   }

       JToolBarHelper::save('edit',JText::_( 'DT_SAVE'));

       JToolBarHelper::divider();

       JToolBarHelper::cancel( 'cancel', JText::_( 'DT_CLOSE') );

	   $cid=JRequest::getVar('cid',array(),null,'array');

	   $tUser->load($cid[0]);

	   $type = ($tUser->type=='I')?'I':'B';

	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,(array)$tUser,false,'adminForm',true));

	   $this->view->assign('mUser',$mUser);
	   
	   $this->view->setLayout('edit');

	   $this->view->display();

   }
   
   function attend(){

	   global $mainframe;

      $mUser = $this->getModel('user');

	  $tUser = $mUser->table;
      foreach($_POST['cid'] as $userId){
	  	 $tUser->load($userId);

	 	 $tUser->attend = 1;
		 pr($tUser);
	  	 $tUser->store();
	  }

	  $mainframe->redirect("index.php?option=com_dtregister&controller=user");

   }

   function fee_status(){
     
	  global $mainframe;

	  $mUser = $this->getModel('user');

	  $tUser = $mUser->table;

	  $tUser->load($_POST['cid'][0]);

	  $tUser->TableFee->load($tUser->fee->id);

	  $tUser->TableFee->status = 1;

	  $tUser->TableFee->store();

	  $tUser->fee_status_change_email();

	  $mainframe->redirect("index.php?option=com_dtregister&controller=user");

   }
   
   function unfee_status(){

	  global $mainframe;

	  $mUser = $this->getModel('user');

	  $tUser = $mUser->table;

	  $tUser->load($_POST['cid'][0]);

	  $tUser->TableFee->load($tUser->fee->id);

	  $tUser->TableFee->status = 0;

	  $tUser->TableFee->store();

	  $tUser->fee_status_change_email();

	  $mainframe->redirect("index.php?option=com_dtregister&controller=user");

   }

   function unattend(){

	  global $mainframe;

      $mUser = $this->getModel('user');

	  $tUser = $mUser->table;

	  $tUser->load($_POST['cid'][0]);

	  $tUser->attend = 0;

	  $tUser->store();

	  $mainframe->redirect("index.php?option=com_dtregister&controller=user");

   }
   
   function billing(){

	   global $mainframe;

	    if(isset($_POST['formsubmit'])){

		$data = JRequest::getVar('User',array(),null,'array');

	   $data['fields'] = JRequest::getVar('Field',array(),null,'array');

	   $eventId = $data['eventId'];

	   $event = & DtrTable::getInstance('Event','Table');

	   $event->load($eventId );

	   if(isset($data['discount_code']) && $data['discount_code']!=""){

			$discount_code_id = $event->validate_code($data['discount_code']); 

			unset($data['discount_code']);

			if($discount_code_id !== false){

			   $data['discount_code_id'] = $discount_code_id;

			}else{

			   $data['discount_code_id'] = false;

			  $this->view->assign('discountCodeError',$event->TableEventdiscountcode->TableDiscountcode->error );

			}	

		}

		$data = array_merge(DT_Session::get('register.User'),array_filter($data));

       $TableUser =& DtrTable::getInstance('Duser','Table');

	   $TableUser->create($data);

	   $feeObj = new DT_Fee($event,$TableUser);

	   $feeObj->getFee(($data['user_id']=="")?false:true);

       $feeObj->setPaidMethod($data['Fee']['payment_method']);

	   $feeObj->setPaidAmount($data['Fee']['paid_amount']);

	   $feeObj->setPaidStatus($data['Fee']['status']);

	   $fee = $feeObj;

       unset($fee->TableEvent);

	   unset($fee->TableUser);

	   $data['fee'] = (array)$fee;

	   $confirmNum = $TableUser->generateconfirmNum();
			
	   $data['confirmNum'] = $confirmNum;

	   $TableUser->register($data);

       DT_Session::clear('register');
	   $mainframe->redirect("index.php?option=com_dtregister&controller=user&task=index");

	   }

	   JToolBarHelper::save('billing',JText::_( 'DT_SAVE'));

	   $mUser = $this->getModel('user');

	   $tUser = $mUser->table;

	   $eventId = DT_Session::get('register.User.eventId');

	   $memtot = DT_Session::get('register.User.memtot');

	   $tUser->TableEvent->load($eventId);

	   $this->view->assign( 'form' ,$tUser->TableEvent->form('B',array(),false,'adminForm',false));

	   $this->view->assign('mUser',$mUser);

	   $this->view->assign('eventId',$eventId);

	   $this->view->assign('type','G');

	   $this->view->assign('memtot',$memtot);

	   $this->view->setLayout('add');

	   $this->view->display();

   }

   function member(){

	   global $mainframe;

	   if(isset($_POST['formsubmit'])){

		   $data = JRequest::getVar('Field',array(),null,'array');

		   $memberIndex = count(DT_Session::get('register.User.members'));

		   DT_Session::set('register.User.members.'.$memberIndex .'.fields', $data);

		   $memtot = DT_Session::get('register.User.memtot');

		   $currentCount = count(DT_Session::get('register.User.members'));

		   if($memtot <= $currentCount){

			   $mainframe->redirect("index.php?option=com_dtregister&controller=user&task=billing");

		   }else{

				$mainframe->redirect("index.php?option=com_dtregister&controller=user&task=member");

		   }

	   }else{

	   }

	   JToolBarHelper::save('member',JText::_( 'DT_NEXT_STEP'));

	   $eventId = DT_Session::get('register.User.eventId');

	   $event = $this->getModel('event')->table;

	   $event->load($eventId);

	   $currentCount = count(DT_Session::get('register.User.members'));

	   $this->view->assign('currentMember',++$currentCount);

	   $this->view->assign( 'form',$event->form('M',array(),false,'adminForm',false));

	   $this->view->setLayout('memberadd');

	   $this->view->display();   

   }
   
   function group_registration(){

	   global $mainframe;

	   if(isset($_POST['formsubmit'])){

		     DT_Session::set('register.User.memtot', JRequest::getVar('memtot',1) );
			 $eventId = DT_Session::get('register.User.eventId');

	   		 $event = $this->getModel('event')->table;

	         $event->load($eventId);
			 if($event->group_registration_type !="detail"){
			 	$mainframe->redirect("index.php?option=com_dtregister&controller=user&task=billing");
			 }else{
			    $mainframe->redirect("index.php?option=com_dtregister&controller=user&task=member");
			 }

			 //prd($_SESSION);

	   }else{
		 
          DT_Session::clear('register');
		  $search = JRequest::getVar('search');

	      $eventId = $search['eventId'];

		  DT_Session::set('register.User.type', 'G' );

		  DT_Session::set('register.User.eventId', $eventId );

		  DT_Session::set('register.User.members', array() );

	   }
	   
		// Check for capacity registration for a particular event		
		
		$eventTable = $this->getModel('event')->table;
		$eventTable->load($eventId);
		$registered = $eventTable->getTotalregistered($eventId);
		$max_registrations = $eventTable->max_registrations;
		
		if ($max_registrations > $registered) {
			
			$availableSpots = $max_registrations - $registered;
		
		} elseif($max_registrations !=0 ){
			
			$mainframe->redirect("index.php?option=com_dtregister&controller=user",JText::_('DT_ALERT_FULL_EVENT'));
			exit;
		}

	   JToolBarHelper::save('group_registration',JText::_( 'DT_NEXT_STEP'));
	   
	   $this->view->assign('eventId',$eventId);

	   $this->view->setLayout('memtotform');

	   $this->view->display();   

   }

   function loadprofile(){

	   $muser = $this->getModel('user');

	   $tuser = $muser->table;

	   $profile = $tuser->TableJUser;

	   $user_id = JRequest::getVar('id',0);

	   $userdata = $profile->getProfile($user_id);

	   echo json_encode($userdata);

	   die;   

   }

   function options(){

       $this->view->setLayout('options');

	   $this->view->display();

   }
 
}

?>
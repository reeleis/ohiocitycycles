<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterControllerMember extends DtrController { 

	var $name = "member";

	 function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'member', 'html' );  

		 $this->view->setModel($this->getModel('member'),true);

		 $this->view->setModel($this->getModel('field'));
		 $this->view->setModel($this->getModel('fieldtype'));
		 $this->view->setModel($this->getModel('event'));

		 $this->registerTask( 'new', 'add' );

		 $this->registerTask( 'remove', 'delete' );

		 $this->registerDefaultTask("index");

	}

	function edit(){

		global $mainframe,$Itemid;

		$mMember = $this->getModel('member');

	    $tMember = $mMember->table;

	    $tUser = $this->getModel('user')->table;
        $key = JRequest::getVar('key') ;
		if(isset($_POST['formsubmit']) && $_POST['formsubmit']=='edit'){

		    $tUser->load($_POST['Member']['groupUserId']);
            $tUser->members[$_POST['Member']['groupMemberId']]->fields =  JRequest::getVar('Field',array(),null,'array');
            $data = $_POST['Member'];

			$data['fields'] = JRequest::getVar('Field',array(),null,'array');
            DT_Session::set('register.User.members.'.$key,$data);
			
	$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$tUser->userId."&Itemid=".$Itemid);

			pr($tUser->TableFee);

			prd($fee);

			die;

	   }
	     
	   $member = DT_Session::get('register.User.members.'.$key );
	   if(DT_Session::get('register.User.members.'.$key.'.groupMemberId')){
	   		$groupMemberId=DT_Session::get('register.User.members.'.$key.'.groupMemberId');
	   
            $tMember->load($groupMemberId);
            
	   }
	 
	   $tUser->load(DT_Session::get('register.User.members.'.$key.'.groupUserId'));
	   $type = 'M';

	   $eventId = $tUser->eventId;

       $this->view->assign('key',$key);
	   
	   $this->view->assign('header_eventId',$eventId);

	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,$member ,false,'frmcart',true));

	   $this->view->assign('mMember',$mMember);

	   $this->display();	

	}

	function index(){

	  global $mainframe;

	  $mMember = $this->getModel('member');

	  $tMember = $mMember->table;

	  $userId = JRequest::getVar('userId',0);

	  $members = $tMember->find(' groupUserId = '.$userId);

	   $temp =  array();

	   if(DT_Session::get('register.User.members')=== false || count(DT_Session::get('register.User.members')) < 1){

		 if (is_array($members)) 
		 foreach($members as  $key => &$member){

		   $tMember->load($member->groupMemberId);

		   $temp[$member->groupMemberId] = $tMember->getObjData();

	     }

		 DT_Session::set('register.User.members',DTrCommon::objectToArray($temp));

	   }else{

		   if (is_array(DT_Session::get('register.User.members'))) 
		   foreach(DT_Session::get('register.User.members') as $key => $member){

			     if(isset($member['remove']) && $member['remove']){

				  }else{

					 $temp[$key] = $member;

				  } 

		   }

	   }
        $mUser = $this->getModel('user');

	    $tUser = $mUser->table;

	    $tUser->load($userId);
	    
      $eventId = $tUser->eventId;

	  $this->view->assign('header_eventId',$eventId);

	  $this->view->assign('members',$temp);

	  $this->view->assign('userId',$userId);

	   $this->view->setLayout('list');

	   $this->view->display();	

	}

	function delete(){

	  global $mainframe,$Itemid;

	  $key = JRequest::getVar('key');

	   $userId = DT_Session::get('register.User.members.'.$key.'.groupUserId');

	  $memtot = DTrCommon::cntMemtotInSession( DT_Session::get('register.User.members'));
       
	   $tUser = $this->getModel('user')->table;
	   $tUser->load($userId);
	   $tEvt = $this->getModel('event')->table;
	   $tEvt->load($tUser->eventId);
	   $min = ($tEvt->min_group_size=="")?2:$tEvt->min_group_size;
	  if( $memtot <= $min){

 $mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$userId."&Itemid=".$Itemid,JText::_( 'DT_MEMBER_REMOVE_ERROR' ));

      }

      $memtot = DT_Session::get('register.User.memtot');
	  $memtot-- ;
	  DT_Session::set('register.User.memtot',$memtot);
	  DT_Session::set('register.User.members.'.$key.'.remove',true);

 $mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$userId."&Itemid=".$Itemid);

    }

    function add(){

		global $mainframe,$Itemid,$now;

		$userId = JRequest::getVar('userId',0);

		$mMember = $this->getModel('member');	

	    $tMember = $mMember->table;

	    $tUser = $this->getModel('user')->table;
        $tUser->load($userId);
	    $tEvt = $this->getModel('event')->table;
	    $tEvt->load($tUser->eventId);
		$eventId = $tUser->eventId;
        $memtot = DT_Session::get('register.User.memtot');
		if($memtot >= $tEvt->max_group_size){
			$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$userId."&Itemid=".$Itemid,JText::_('DT_MAX_GROUP_SIZE_REACHED'));
	    }
		if(isset($_POST['formsubmit']) ){
	       
            $min = ($tEvt->min_group_size=="")?2:$tEvt->min_group_size;

			$data = $_POST['Member'];

			$data['fields'] = JRequest::getVar('Field',array(),null,'array');

			$data['created'] = $now->toMySQL();

			$members = DT_Session::get('register.User.members');

			$members[] = $data;

			DT_Session::set('register.User.members',$members);
            $memtot = DT_Session::get('register.User.memtot');
	        $memtot++;
	        DT_Session::set('register.User.memtot',$memtot);
			$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$userId."&Itemid=".$Itemid);

			pr($tUser->TableFee);

			prd($fee);

			die;

		}

	    $type = 'M';

	   $this->view->assign('header_eventId',$eventId);

	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,array(),false,'frmcart',false));

	   $this->view->assign('userId',$userId);

	    $this->display();

    }

}

?>
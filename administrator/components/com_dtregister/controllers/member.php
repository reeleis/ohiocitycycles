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
class DtregisterControllerMember extends DtrController { 
    
	var $name = "member";
	 function __construct($config = array()){
		 parent::__construct($config);
		 $this->view = & $this->getView( 'member', 'html' );  
		 $this->view->setModel($this->getModel('member'),true);
		 $this->view->setModel($this->getModel('field'),true);
		 $this->view->setModel($this->getModel('fieldtype'),true);
		 $this->registerTask( 'new',  'add' );
		 $this->registerDefaultTask("index");
		 JToolBarHelper::title(  JText::_( 'DT_MEMBER_MANAGEMENT'), 'dtregister' );

	}
	function edit(){
	    
		global $mainframe ;
		
		$mMember = $this->getModel('member') ;
	    $tMember = $mMember->table ;
	    $tUser = $this->getModel('user')->table ;
		if(isset($_POST['formsubmit']) && $_POST['formsubmit']=='edit'){
		    $tUser->load($_POST['Member']['groupUserId']);
			
			$fee = $tUser->calculateFee();
			
			$tUser->members[$_POST['Member']['groupMemberId']]->fields =  JRequest::getVar('Field',array(),null,'array');
			
			
			$fee = $tUser->calculateFee();
			$fee->paid_amount = $tUser->TableFee->paid_amount ;
			$tUser->TableFee->save((array)$fee);
			
			$data = $_POST['Member'] ;
			$data['fields'] = JRequest::getVar('Field',array(),null,'array');
			$tMember->save($data);
			$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$_POST['Member']['groupUserId']);
			pr($tUser->TableFee);
			prd($fee);
			die ;
			
	   }
		  $cid=JRequest::getVar('cid',array(),null,'array');

	     JToolBarHelper::save('edit',JText::_( 'DT_SAVE'));

       JToolBarHelper::divider();
       JToolBarHelper::cancel( 'cancel', JText::_( 'DT_CLOSE') );
	   
	   $tMember->load($cid[0]);
	   
	   $tUser->load($tMember->groupUserId);
	   $type = 'M' ;
	   
	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,(array)$tMember,false,'adminForm',false));
	   $this->view->assign('mMember',$mMember);
		$this->display();
			
	}
	
	function cancel(){
	    global $mainframe ;
		
		$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$_POST['Member']['groupUserId']);
	   
	   	
	}
	
	function userindex(){
	   global $mainframe ;
	   
	   $mainframe->redirect('index.php?option=com_dtregister&controller=user');
	}
	function index(){
	   
	   global $mainframe ;
	  
	  JToolBarHelper :: custom( 'userindex', 'back.png', 'back.png', JText::_('DT_BACK'), false, false );
      
      JToolBarHelper::divider();
	  JToolBarHelper::deleteList(JText::_( 'DT_DELETE_GROUP_MEMBER'),'delete');
      JToolBarHelper::divider();
	  JToolBarHelper::editList('edit');
	  JToolBarHelper::divider();
	  JToolBarHelper::addNew('add',JText::_( 'DT_ADD_MEMBER'));
	  $mMember = $this->getModel('member');
	   $tMember = $mMember->table ;
	   $userId = JRequest::getVar('userId',0);
	   
	   $members = $tMember->find(' groupUserId = '.$userId);
	   $temp =  array();
	   
	   if (is_array($members)) 
	   foreach($members as  $key => &$member){
		   $tMember->load($member->groupMemberId);
		   $member = (object)(array)$tMember ;
		   
	   }
	  
	  $this->view->assign('members',$members);
	  $this->view->assign('userId',$userId);
	   
	   $this->view->setLayout('list');
	   $this->view->display();	
	}
	
	function delete(){
	    
		
		global $mainframe;
	  $database = &JFactory::getDBO();
	  $mMember = $this->getModel('member') ;
	  $tMember = $mMember->table ;
	  $tUser = $this->getModel('user')->table ;
	  $deleted = 0 ;
	  $cid = JRequest::getVar('cid',array(),null,'array');
	  for ($i=0,$n=count($cid);$i<$n;$i++){
		 
		 $memberId=$cid[$i];
		 
		 $tMember->load($memberId);
		 
		 $tUser->load($tMember->groupUserId);
		 
		
		 if(($tUser->memtot - count($cid) + $deleted) >= 2){
			$tMember->delete($memberId,$tUser);
			$deleted++ ;
		  
		 }else{
		  
		 }
		 
	  }
	 	 
	  $mainframe->redirect("index2.php?option=com_dtregister&controller=member&userId=".$tMember->groupUserId);
			
    }
	
    function add(){
	    
		global $mainframe ;
		
		$userId = JRequest::getVar('userId',0);
		$mMember = $this->getModel('member') ;	
		
	    $tMember = $mMember->table ;
	    $tUser = $this->getModel('user')->table ;
		
		if(isset($_POST['formsubmit']) ){
	        
		    
			$data = $_POST['Member'] ;
			$data['fields'] = JRequest::getVar('Field',array(),null,'array');

			$tMember->save($data);
			
			$tUser->load($userId);
			$tUser->memtot++ ;
			$tUser->save_field('memtot',$tUser->memtot);
			
			$fee = $tUser->calculateFee();
			$fee->paid_amount = $tUser->TableFee->paid_amount ;
			$tUser->TableFee->save((array)$fee);
			$mainframe->redirect("index.php?option=com_dtregister&controller=member&userId=".$userId);
			pr($tUser->TableFee);
			prd($fee);
			die ;
			
		}
		$tUser->load($userId);
	    $type = 'M' ;
	   JToolBarHelper::save('add',JText::_( 'DT_SAVE'));
        JToolBarHelper::divider();
        JToolBarHelper::cancel( 'cancel', JText::_( 'DT_CLOSE') );
	   $this->view->assign( 'form' ,$tUser->TableEvent->form($type,array(),false,'adminForm',false));
	   $this->view->assign('userId',$userId);
	   
	    $this->display();
		
			
    }
}
?>
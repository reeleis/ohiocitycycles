<?php

/**
* @version 2.7.1
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterControllerEventmanage extends DtrController {    

	var $name ='eventmanage';

	function __construct($config = array()){
		 
		 $config = array('default_task'=>'events','task_map'=>array('new'=>'add'));
		 parent::__construct($config);

		 $this->view = & $this->getView( 'eventmanage', 'html' );  

		 $this->view->setModel($this->getModel('event'),true);

		 $this->view->setModel($this->getModel( 'category' ),false);

		 $this->view->setModel($this->getModel( 'location' ),false);

		 $this->view->setModel($this->getModel( 'section' ),false);

		 $this->view->setModel($this->getModel( 'discountcode' ),false);

		 $this->view->setModel($this->getModel( 'file' ),false);

		 $this->view->setModel($this->getModel( 'field' ),false);
		 $this->view->setModel($this->getModel( 'user' ),false);
         
		 $this->view->setModel($this->getModel( 'payoption' ),false);
		 //$this->registerTask( 'new',  'add' );

		 //$this->registerDefaultTask("events");

		 JToolBarHelper::title(  JText::_( 'DT_EVENT_MANAGEMENT'), 'dtregister' );

	}

  function getcategory(){

	$database = &JFactory::getDBO();

	$sectionId = $_REQUEST['sectionId'];

	$options=array();

				$options[]=JHTML::_('select.option',"",JText::_('DT_SELECT_CATEGORY'));

				$query = "Select * from #__categories where section='".$sectionId ."'";

				$database->setQuery($query);

				$sections = $database->loadObjectList();

				if (is_array($sections)) 
				foreach($sections as $section){

					$options[]=JHTML::_('select.option',$section->id,$section->title);

				}

			echo $section_html = JHTML::_('select.genericlist', $options,"articlecategory","","value","text");

			?>

			<?php

			exit;

}

function getarticle(){

	$database = &JFactory::getDBO();

	$categoryId = $_REQUEST['categoryId'];

	$options=array();

				$options[]=JHTML::_('select.option',"","Select Article");

				$query = "Select c.* from #__content c  where c.catid='".$categoryId ."'";

				$database->setQuery($query);

				$sections = $database->loadObjectList();

				if (is_array($sections)) 
				foreach($sections as $section){

					$options[]=JHTML::_('select.option',$section->id,$section->title);

				}

			echo $section_html =  JHTML::_('select.genericlist', $options,"data[event][article_id]","","value","text");

			?>

			<?php

			exit;

}

	function copy(){

      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	 
	  JRequest::setVar('slabId',$cid[0]); 

	  $this->view->assign('copy',true);

	  $this->add();

   }

  function publish(){

      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $event = $this->getModel('event')->table;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $event->load($id);

		  $event->publish = 1;

		  $event->store();      

	  }

	  $this->events();
	   
   }

   function unpublish(){

      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $event = $this->getModel('event')->table;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $event->load($id);

		  $event->publish = 0;

		  $event->store();      

	  }

	  $this->events();

   }

    function archive(){

      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $event = $this->getModel('event')->table;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $event->load($id);

		  $event->archive = 1;

		  $event->store();  
		  
		  $query = "update #__dtregister_group_event set archive = ".$event->archive." where parent_id=".$id; 
		  $event->rawquery($query);   

	  }

	  $this->events();   

   }

   function remove(){

      global $mainframe,$Itemid,$DT_mailfrom,$DT_fromname;

	  $event = $this->getModel('event')->table;

	  $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  if (is_array($cid)) 
	  foreach($cid as $id){

	      $event->load($id);

		  $event->delete($id);      

	  }

      $subject = JText::_('DT_EVENT_DELETE_SUBJECT');
	  $message = JText::_('DT_EVENT_DELETE_MESSAGE');
	  $email = $frontendEventNotification;
	  JUTility::sendMail($DT_mailfrom,$DT_fromname,$email,$subject,$message,1);

	 $mainframe->redirect( "index.php?option=".DTR_COM_COMPONENT."&controller=eventmanage&Itemid=$Itemid" );

   }

   function unarchive(){

      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $event = $this->getModel('event')->table;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $event->load($id);

		  $event->archive = 0;

		  $event->store();      
		  $query = "update #__dtregister_group_event set archive = ".$event->archive." where parent_id=".$id; 
		  $event->rawquery($query);   

	  }

	  $this->events();

   }

	function events(){

       $archive = JRequest::getVar('archive',-1);

		if($archive==1){

		   JToolBarHelper::unarchiveList('unarchive');

		}else{

		  JToolBarHelper::archiveList('archive');

		}

        JToolBarHelper::divider();

        JToolBarHelper::publishList('publish');

    	JToolBarHelper::divider();

		JToolBarHelper::unpublishList('unpublish');

        JToolBarHelper::divider();

        JToolBarHelper::editList();

	    JToolBarHelper::divider();

        JToolBarHelper::addNew();

        JToolBarHelper::divider();

	    JToolBarHelper::editList('copy', JText::_( 'DT_COPY_EVENT') );

	    JToolBarHelper::divider();

	    JToolBarHelper::divider();

        JToolBarHelper::deleteList();

	    $this->view->setLayout('list');

		$this->view->display();

	}

	function edit(){

	   JToolBarHelper::apply('apply');
       JToolBarHelper::divider();
       JToolBarHelper::save();
       JToolBarHelper::divider();
       JToolBarHelper::cancel('cancel');
       $row =  $this->getModel('event')->table;
       $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
       JRequest::setVar('slabId',$cid[0]); 
       $slabId = JRequest::getVar('slabId',0);
       $row->load($slabId);
	   $layout = 'add';
       $this->view->assign('row',$row);
       $this->view->setLayout($layout);
       $this->view->display();
       
	}

	function add(){
        JToolBarHelper::apply('apply');
        JToolBarHelper::divider();
        JToolBarHelper::save();
	    JToolBarHelper::divider();
        JToolBarHelper::cancel('cancel');
        $row =  $this->getModel('event')->table;

	    $slabId = JRequest::getVar('slabId',0);

	    $row->load($slabId);

		$row->slabId = "";

	    $this->view->assign('row',$row);

	    $this->view->setLayout('add');

		$this->view->display();

	}

	function apply(){

	  global $mainframe,$Itemid,$frontendEventNotification,$DT_mailfrom,$DT_fromname;

	  $row = $this->getModel('event')->table;

	  if($row->save(JRequest::getVar('data'))){

	      $subject = JText::_('DT_EVENT_EDIT_SUBJECT');
		  $message = JText::_('DT_EVENT_EDIT_MESSAGE');
		  $email = $frontendEventNotification ;
		  JUTility::sendMail($DT_mailfrom, $DT_fromname,$email,$subject,$message,1);

	  }else{
	  $mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid&task=edit&cid[]=".$row->slabId,$row->error);   

	  }
	
 $mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid&&task=edit&cid[]=".$row->slabId);

	}

	function editconfirm(){
	    global $mainframe ,$Itemid;
	   	$data =  DT_Session::get('event.data');
		$files = DT_Session::get('event.event_files');
		JRequest::setVar('event_files', $files, 'files');
		DT_Session::clear('event');
		$row = $this->getModel('event')->table;
		if($row->save($data) !== false){
			
		}else{
			 $mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid&task=edit&cid[]=".$row->slabId,$row->error);
		}
		$mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid");
	}
	
	function editcancel(){
	   global $mainframe , $Itemid;
	   DT_Session::clear('event');
	   $mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid");
	}

	function save(){

	  global $mainframe,$Itemid,$DT_mailfrom,$DT_fromname;

	  $row = $this->getModel('event')->table;

	  $data =  JRequest::getVar('data');
	  $error = false ;
	  if($data['event']['slabId']!=""){
		   $row->load($data['event']['slabId']);
		  
		   if(!$row->validDateChange($data)){

			   $this->error = JText::_("DT_REPTITIONS_NOT_VALID");

			   $error = true;

		   }
		  
	  }
	  
	  if($error){
		   DT_Session::set('event.data',$data);
		   $files =  JRequest::getVar('event_files', null, 'files', 'array');
		   DT_Session::set('event.event_files',$files);
		   $this->view->setLayout('warning');
		   $this->view->assign('message',JText::_("DT_REPEAT_DELETE_WARNING"));
		   $this->view->display();
	  }else{

		if($row->save($data) !== false){
		   
           global $eventListOrder;
		   $conf  = DtrModel::getInstance('config','DtregisterModel');
		   $conf->updateEventorder($eventListOrder);
            
		   $subject = JText::_('DT_EVENT_EDIT_SUBJECT');
		   $message = JText::_('DT_EVENT_EDIT_MESSAGE');
		   $email = $frontendEventNotification;
		   JUTility::sendMail($DT_mailfrom, $DT_fromname,$email,$subject,$message,1);
		}else{
		$mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid&task=edit&cid[]=".$row->slabId,$row->error);
  
		}
  
		$mainframe->redirect("index.php?option=com_dtregister&controller=eventmanage&Itemid=$Itemid");

	  }

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

	  function orderup(){ 

	  $this->order(-1);

   }

     function orderdown(){

	  $this->order(1);

   }

	 function order($inc){

       global $mainframe ,$Itemid;

	   $row = $this->getModel('event')->table;

       $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	   $uid = $cid[0];

	   $row->load( (int)$uid );

	   $row->reorder(' category = "'.$row->category.'" and parent_id=0');

	   $row->move( $inc, ' category = "'.$row->category.'" and parent_id=0' );     

	//$row->updateOrder();

	  $mainframe->redirect( "index.php?option=".DTR_COM_COMPONENT."&controller=eventmanage&Itemid=$Itemid" );

   }

     function saveorder(){

      global $mainframe,$Itemid;

	  $row = $this->getModel('event')->table;

	  $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $order = JRequest::getVar( 'order', array(0), '', 'array' );

	  $total = count( $cid );
      pr($order);
	  
	  if (is_array($order)) 
	  foreach( $order as $slabId => $ordering ) {

		$row->load( $slabId );

       if ($row->ordering != $ordering && $row->parent_id==0) {

			$row->ordering = $ordering;

           // prd($row->store());
           unset($row->repetition);
		   $row->store();
           
			if ($row->getError() !="") {

               JError::raiseError(500, $row->getError() );

				prd($row);

				exit();

			} 

		}

	 }

   $mainframe->redirect( "index.php?option=".DTR_COM_COMPONENT."&controller=eventmanage&Itemid=$Itemid" );

   }
    function removeimage(){
	   
	    $event = $this->getModel('event')->table;
		
		$slabId = JRequest::getVar('eventId',0);

		$event->slabId = $slabId;
		$event->removeImage();
		
   }

}
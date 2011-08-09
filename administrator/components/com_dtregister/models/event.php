<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

JLoader::register('DtrModel' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtmodel.php');
JLoader::register('DtrTable' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dttable.php');
include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'category.php');
class DtregisterModelEvent extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table = new TableEvent($this->getDBO());

	   $this->tableJevt = new TableJevent($this->getDBO());

   }

   function listingQuery($daterange=array(),$cat='all'){

	  global $now;

	  $where = array();

	  $where[] = "b.publish=1";
	  $user = JFactory::getUser();
	  $where[] = "( ( c.published=1 and c.access <= ".$user->get('aid')." ) || c.categoryId is  null)";

	  if(isset($daterange['startdate'])){

		   $start_date = new JDate($daterange['startdate']);
           $where[] = " b.dtstart > '".($start_date->toFormat('%Y-%m-%d'))."' ";

	  }
      if(isset($daterange['enddate'])){

		   $end_date = new JDate($daterange['enddate']);
           $where[] = " b.dtstart < '".($end_date->toFormat('%Y-%m-%d'))."' ";
      }
      if($cat != 'all'){
		  // $where[] = " b.category = $cat";
		  $where[] = " c.categoryId = $cat or c.parent_id = $cat";
	  }
	  
	  $where = implode(' and ',array_filter($where));

	  $query = "SELECT DISTINCT(b.slabId), c.*,b.* , if(concat(b.startdate,' ',b.starttime) >= '". $now->toMySQL(true) ."' and b.startdate is not null,'y','n') as future_event , l.name as loc_name

		FROM 

		#__dtregister_group_event as b

		left join #__dtregister_categories as c on c.categoryId = b.category 

        left join #__dtregister_locations as l on l.id = b.location_id 

		 where   $where  order by dtstart , dtstarttime ";

	  return $query;  

   }

}

class TableRepetition extends DtrTable{

   var $id;

   var $eventId;

   var $repeatType;

   var $rpcount;

   var $rpuntil;

   var $weekdays;

   var $monthdays;

   var $monthweekdays;

   var $monthweeks;

   var $yeardays;

   var $rpinterval;

   var $countselector; 

   var $monthdayselector;

   function __construct( &$db = null ) {

	  $db = &JFactory::getDBO();

	  parent::__construct( '#__dtregister_repetitions', 'id', $db );

	  $this->displayTxt =  array(

	                             'norepeat' => JText::_( 'DT_NO_REPEAT' ), 

							     'daily'    => JText::_( 'DT_DAILY' ),

							     'weekly'   => JText::_( 'DT_WEEKLY' ),

								 'monthly'  => JText::_( 'DT_MONTHLY' ),

								 'yearly'   => JText::_( 'DT_YEARLY' )

						   );   

   }

   function removeByeventId($eventId){

	   $query = "delete from #__dtregister_repetitions where eventId=".$eventId;

	   $this->_db->setQuery($query);

       $this->_db->query();

   }  

   function save($data){

		 if(isset($data['weekdays']) && is_array($data['weekdays'])){

			 $data['weekdays'] = implode(",",$data['weekdays']);

		 }

		 if(isset($data['monthweekdays']) && is_array($data['monthweekdays'])){	   	 

			 $data['monthweekdays'] = implode(",",$data['monthweekdays']);

		 }

		 if(isset($data['monthweeks']) && is_array($data['monthweeks'])){

			 $data['monthweeks'] = implode(",",$data['monthweeks']);

		 }

		return parent::save($data);

   }

   function load($id){

		parent::load($id);

		$this->weekdays = explode(",",$this->weekdays);

		$this->monthweekdays = explode(",",$this->monthweekdays);

		$this->monthweeks = explode(",",$this->monthweeks);

		$this->monthdays = explode(",",$this->monthdays);

		$this->yeardays = explode(",",$this->yeardays);

   }

   function findbyeventId($eventId){

      unset($data);        

	   $data = $this->find(' eventId = '.$eventId);

	   if($data){

		   $data = $data[0];
           
		    if(!is_array($data->weekdays)){
			     $data->weekdays = (trim($data->weekdays)!="")?explode(",",$data->weekdays):array();
		    }
         
		   if(!is_array($data->monthweekdays)){
			      $data->monthweekdays = (trim($data->monthweekdays)!="")?explode(",",$data->monthweekdays):array();
		   }
		    if(!is_array($data->monthweeks)){
			       $data->monthweeks = (trim($data->monthweeks)!="")?explode(",",$data->monthweeks):array();
		    }
			
			if(!is_array($data->monthdays)){
			        $data->monthdays = (trim($data->monthdays)!="")?explode(",",$data->monthdays):array();
		    }
			if(!is_array($data->yeardays)){
			        $data->yeardays = (trim($data->yeardays)!="")?explode(",",$data->yeardays):array();

		    }
		 
	   }

	   return $data;

   }

}

class TableEvent extends DtrTable {

     var $slabId;

	 var $eventId;

	 var $memberTotal;

	 var $regGroupRate;

	 var $regGroupPerRate;

	 var $registerAmountIndividual;

	 var $latefee;

	 var $latefeedate;
	 
	 var $email;

	 var $max_registrations;

	 var $registration_type;

	 var $topmsg;

	 var $cut_off_date;

	 var $discount_type;

	 var $discount_amount;

	 var $event_admin_email_set;
	 
	 var $event_admin_email_from_name;
	 
	 var $event_admin_email_from_email;

	 var $thksmsg;

	 var $thksmsg_set;
	 
	 var $admin_notification;
	 
	 var $admin_notification_set;

	 var $event_describe;

	 var $event_describe_set;

	 var $terms_conditions_set;

	 var $terms_conditions_msg;

	 var $category;

	 var $ordering;

	 var $max_group_size;

	 var $waiting_list;

	 var $public = 1;

	 var $export;

	 var $use_discountcode;

	 var $article_id;

	 var $detail_link_show = 0;

	 var $show_registrant = 0;

	 var $publish = 0;

	 var $startdate;

	 var $bird_discount_type;

	 var $bird_discount_amount;

	 var $bird_discount_date;

	 var $payment_option;

	 var $location_id;

	 var $partial_payment = 0;

	 var $archive;

	 var $partial_amount;

	 var $partial_minimum_amount;

	 var $edit_fee;

	 var $cancelfee_enable = 0;
     
	 var $cancel_enable = 0;
	 
	 var $cancel_date;

	 var $partial_payment_enable = 0;
	 
	 var $cancel_refund_status = 0;

	 var $excludeoverlap = 0;
	 
	 var $prevent_duplication = 1;

	 var $pay_later_thk_msg_set;

	 var $pay_later_thk_msg;

	 var $thanksmsg_set;

	 var $thanksmsg;

	 var $change_date;

	 var $detail_itemid;

	 var $title = "";

	 var $dtstart = "";

	 var $dtend = "";

	 var $dtstarttime = ""; 

	 var $dtendtime = "";

	 var $tax_enable = 0;

	 var $tax_amount = 0;

	 var $payment_id;

	 var $repetition_id;

	 var $parent_id = 0;
	 
	 var $usercreation = 0;
	 var $imagepath = "";
	 
	 var $timeformat = 1;
	 
	 var $latefeetime;
	 var $bird_discount_time;
	 
	 var $starttime;
	 var $cut_off_time;
	 
	 var $change_time;
	 var $cancel_time;
	 var $user_id;
	 
	 var $changefee_enable = 0;
	 var $changefee_type = 1;
	 
	 var $changefee = "";
	 
	 var $cancelfee_type = 1;
	 var $cancelfee = "";
	 var $usetimecheck = 0;
	 	  
	 var $group_registration_type = 'detail';
	 var $min_group_size = 2;
	 
	 var $thanks_redirection = 1;
	 
	 var $thanks_redirect_url ="";
	 
	 var $pay_later_redirection = 1;
	 
	 var $pay_later_redirect_url ="";
	 

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

	    $this->displayField = 'title';

		$this->db =&$db;

	    $this->TableGroup =& DtrTable::getInstance('Group','Dtable');
		
		$this->TableCategory =& DtrTable::getInstance('Category','Table');

		//$this->TableEventconfig =& DtrTable::getInstance('Eventconfig','Table');

		$this->TableEventdiscountcode =& DtrTable::getInstance('Eventdiscountcode','Table');

		$this->TablePrerequisitecategory =& DtrTable::getInstance('Prerequisitecategory','Table');

		$this->TablePrerequisite =& DtrTable::getInstance('Prerequisite','Table');

		$this->TableEventfield =& DtrTable::getInstance('Eventfield','Table');

		$this->TableEventfile =& DtrTable::getInstance('File','Table');

		$this->TableEventfeeorder =& DtrTable::getInstance('Feeorder','Table');

		$this->TableField =& DtrTable::getInstance('Field','Table');

		$this->TablePayoption =& DtrTable::getInstance('Payoption','Table');

		$this->TableLocation =& DtrTable::getInstance('location','Table');

		$this->TableRepetition =& DtrTable::getInstance('repetition','Table');

		parent::__construct( '#__dtregister_group_event', 'slabId', $db );

        $this->repeatFields = array('slabId','dtstart','dtstarttime','dtend','dtendtime',
	                               'publish','cut_off_date','cut_off_time',
								   'startdate','starttime','topmsg','event_describe');
  }
  
  function load($id){

      parent::load($id);

	  $this->formatTimeproperty($this->dtendtime);
	  $this->formatTimeproperty($this->dtstarttime);
	  
	  $this->formatTimeproperty($this->latefeetime);
	  $this->formatTimeproperty($this->bird_discount_time);
	  
	  $this->formatTimeproperty($this->starttime);
	  $this->formatTimeproperty($this->cut_off_time);
	  
	  $this->formatTimeproperty($this->change_time);
	  $this->formatTimeproperty($this->cancel_time);

	  $this->group = $this->getGroup();

	  //$this->config = $this->getConfig();

	  $this->discountcode = $this->getDiscountcode();

	  $this->prerequisitecategory = $this->getPrerequisitecategory();

	  $this->prerequisite = $this->getPrerequisite();

	  $this->field = $this->getField();

	  $this->file = $this->getFile();

	  $this->feeorder = $this->getFeeorder();

	  $this->TableLocation->load($this->location_id);
      $this->TableCategory->load($this->category);
	  if($this->parent_id == 0 && $this->repetition_id > 0 ){

	    $this->repetition = $this->TableRepetition->findbyeventId($this->slabId);

	  }else{

	    $this->repetition = false;
	  }

  }

    function formatTimeproperty(&$attr = null){
	    if($attr != ""){
			//if($this->timeformat == 2){
				$temp = explode(":",$attr);
			    $attr = $temp[0].":".$temp[1];
			//}else{
			  // 	$attr = strftime('%H:%M %p',strtotime(date('Y-m-d')." ".$attr)) ;
			//}
		   	
		}
	}
    function displaydate(){
        global $date_format;
		return JFactory::getDate($this->dtstart)->toFormat($date_format);
		return $this->dtstart;

	}
	
	function addUsageToSession($fields = array()){
		
		$data = $this->TableEventfield->TableField->find('id in('.implode(",",array_keys($fields)).')');
		$temp = array();
		if(is_array($data))
		foreach($data as $field ){
			
			if(in_array($field->type,array(1,3,4))){
				 
				 if(isset($fields[$field->id])){
					 if(is_array($fields[$field->id])){  
						  
						  foreach($fields[$field->id] as $value){
						  	    if($value==""){
									continue;
								}
								if(!isset($_SESSION['__dtregister']['option_used'][$field->id][$value])){
								   $_SESSION['__dtregister']['option_used'][$field->id][$value] = 1;
								}else{
									$_SESSION['__dtregister']['option_used'][$field->id][$value]++;
								}
							
						  }
						    
					 }else{
					 	   if($fields[$field->id]==""){
								continue;
						   }
							if(!isset($_SESSION['__dtregister']['option_used'][$field->id][$fields[$field->id]])){
							   $_SESSION['__dtregister']['option_used'][$field->id][$fields[$field->id]] = 1;
							}else{
								$_SESSION['__dtregister']['option_used'][$field->id][$fields[$field->id]]++;
							}
						  
					 }
				 }
					 
			}
			
		}
		
	}
	
	function displaydatecolumn($separator="<br />"){
	   	
		global $date_format,$displaytime;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
		
		if($displaytime){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay || $this->dtend=="" ||$this->dtend=="0000-00-00"){
	       $htmlrow1 ='<span>'.$start_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime)));
		}else{
		   $htmlrow1 ='<span>'.$start_date.' - '.$end_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}
		
		return $html = implode($separator,array_filter(array($htmlrow1,$htmlrow2)));
		
    }
	
	function displaydateheader($separator="<br />"){
	   	
		global $date_format,$displaytime;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
		
		if($displaytime){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay || $this->dtend=="" ||$this->dtend=="0000-00-00"){
	       $htmlrow1 ='<span>'.$start_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}else{
		   
		   $htmlrow1 ='<span>'.$start_date.' '.$startTime.' - '.$end_date.' '.$endTime.'</span>';
		   //$htmlrow2 = implode(" - ",array($startTime,$endTime)); 
		   $htmlrow2 = "";
		}
		
		return $html = implode($separator,array_filter(array($htmlrow1,$htmlrow2)));
		
    }
	
	function displaydatecolumnonly($separator="<br />"){
	   	
		global $date_format , $displaytime;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
		
		if($displaytime){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay || $this->dtend=="" ||$this->dtend=="0000-00-00"){
	       $htmlrow1 ='<span>'.$start_date.'</span>';
		   //$htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}else{
		   $htmlrow1 ='<span>'.$start_date.' - '.$end_date.'</span>';
		  // $htmlrow2 = implode(" - ",array($startTime,$endTime)); 
		}
		
		return $html = implode($separator,array_filter(array($htmlrow1,$htmlrow2)));
		
    }
	
	function displaydatecolumn_no_html($separator=" "){
	   	
		global $date_format,$displaytime;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
		
		if($displaytime){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay || $this->dtend=="" ||$this->dtend=="0000-00-00"){
	       $htmlrow1 = $start_date;
		   //$htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}else{
		   $htmlrow1 = $start_date.' - '.$end_date;
		  // $htmlrow2 = implode(" - ",array($startTime,$endTime)); 
		}
		
		return $html = implode($separator,array_filter(array($htmlrow1,$htmlrow2)));
		
    }
	
	function displaytimecolumn($separator="<br />"){
	   	
		global $date_format,$displaytime;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
			
		//if($displaytime){
		if(1){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay){
	      // $htmlrow1 ='<span>'.$start_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}else{
		  // $htmlrow1 ='<span>'.$start_date.' - '.$end_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}
		
		return $html = implode($separator,array_filter(array($htmlrow1,$htmlrow2)));
		
    }

  	function get_article(){

        if(!isset($this->article_id) || $this->article_id==""){

			return false;

		}

		$query = "select id , catid , sectionid from #__content where id=".$this->article_id;

		$this->db->setQuery($query);

		return $this->db->loadObject();

	}

	function overlap(){

	   global $overlap_event_msg;

	   echo $overlap_event_msg;	

	}

	function is_registerable($tUser=null){
         global $now,$Itemid,$private_event_notification,$private_event_redirect;
	     global $mainframe,$sign_up_redirect,$timecheck,$Itemid,$prerequisite_paid,$prerequisite_attend;
		
		  $my = &JFactory::getUser();
		// prd($my);
		 if($this->public != 1 && !$my->id ){ // private event requires to login
			// prd(JText::_('DT_ERROR_PRIVATE_EVENT_SIGN'));
			if($private_event_notification=='onscreen'){
				$mainframe->redirect("index.php?option=com_dtregister&controller=message&Itemid=$Itemid&task=privatevent");
			} else {
				
				$mainframe->redirect( $sign_up_redirect);
			}
		    
	     }
		 
		 if($this->is_cutoff($this)){
		 	$mainframe->redirect("index.php?option=com_dtregister&controller=event&task=cut_off");
		 }
         
		 if(strtotime($this->dtend." ".$this->dtendtime) < $now->toUnix(true)){
			 $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
		   
		 }
		 
		 if($this->startdate != "" && $this->startdate != "0000-00-00"){
			 if($this->starttime !=""){
			    $starttime = strtotime($this->startdate." ".$this->starttime);
			 }else{
				$starttime = strtotime($this->starttime);
			 }
			 if($starttime > $now->toUnix(true)){
				 $mainframe->redirect("index.php?option=com_dtregister&Itemid=".$Itemid);
			 }
	     }

		 if(!$this->usetimecheck && $my->id && $timecheck){

		       if($return = $this->is_overlapped($tUser)){

				     $url="index.php?option=com_dtregister&Itemid=$Itemid&task=overlap&controller=message";

					 $mainframe->redirect($url);

			   }

		 }else if(!$my->id && $timecheck && !$this->usetimecheck){
		 	
		   if($private_event_notification=='onscreen'){
				$mainframe->redirect("index.php?option=com_dtregister&controller=message&Itemid=$Itemid&task=privatevent");
			} else {
				
				$mainframe->redirect( $sign_up_redirect);
			}
			
		 }

		  $this->prerequisite;

		 if(is_array($this->prerequisite) && count($this->prerequisite)){

			  if(!$my->id){
                  
				 if($private_event_notification=='onscreen'){
					$mainframe->redirect("index.php?option=com_dtregister&controller=message&Itemid=$Itemid&task=privatevent");
				} else {
					
					$mainframe->redirect( $sign_up_redirect);
				}

			  }else{

				 if(!$this->is_reg_prequisite($tUser)){
                      $url="index.php?option=com_dtregister&Itemid=$Itemid&task=prequisite&controller=message&eventId=".$this->slabId;

					 $mainframe->redirect($url);
					
				 }

			  }

		 }

		 if(is_array($this->prerequisitecategory) && count($this->prerequisitecategory) > 0 ){     

			  if(!$my->id){

				  if($private_event_notification=='onscreen'){
					$mainframe->redirect("index.php?option=com_dtregister&controller=message&Itemid=$Itemid&task=privatevent");
				} else {
					
					$mainframe->redirect( $sign_up_redirect);
				}

			  }else{

				   if(!$this->is_reg_prequisite_cat($tUser)){

					 $url="index.php?option=com_dtregister&Itemid=$Itemid&task=prequisitecat&controller=message&eventId=".$this->slabId;

					 $mainframe->redirect($url);
                     
				 }	   

			  }

		 }

        $registered = $this->getTotalregistered($this->slabId);
		
		if($this->max_registrations <= $registered && $this->max_registrations != 0 && $this->max_registrations !=""){
		   	if(!($this->waiting_list)){
			     $mainframe->redirect('index.php?option=com_dtregister&controller=message&task=waiting');
			}
			
	    }

	}

	function check_registerable($tUser=null){

	     global $mainframe,$sign_up_redirect,$timecheck,$Itemid,$prerequisite_paid,$prerequisite_attend,$now;

		  $my = &JFactory::getUser();

		 if($this->public != 1 && !$my->id ){ // private event requires to login

		   return false;

	     }

         if(strtotime($this->dtend." ".$this->dtendtime) < $now->toUnix(true)){
		    return false;
		 }		 
		 
		 if($this->startdate != "" && $this->startdate != "0000-00-00"){
			 if($this->starttime !=""){
			    $starttime = strtotime($this->startdate." ".$this->starttime);
			 }else{
				$starttime = strtotime($this->starttime);
			 }
			 if($starttime > $now->toUnix(true)){
				return false;
			 }
	     }
		 
		 if($this->usetimecheck && $my->id){

		       if($this->is_overlapped($tUser)){

				     $url="index.php?option=com_dtregister&Itemid=$Itemid&task=overlap&controlller=event";

					return false;

			   }	

		 }

		  $this->prerequisite;

		 if(is_array($this->prerequisite) && count($this->prerequisite)){

			  if(!$my->id){

				  return false;

			  }else{

				 if(!$this->is_reg_prequisite($tUser)){

					return false;			  

				 }

			  }

		 }

		 if(is_array($this->prerequisitecategory) && count($this->prerequisitecategory) > 0 ){

			  if(!$my->id){

				 return false;

			  }else{

				   if(!$this->is_reg_prequisite_cat($tUser)){

					return false;	  

				 }   

			  }

		 }
         
		 $registered = $this->getTotalregistered($this->slabId);
		
		if($this->max_registrations <= $registered && $this->max_registrations != 0 && $this->max_registrations !=""){
		   	if(!($this->waiting_list)){
			     return false;
			}
			
	    }
		 
        return true;

	}
	
	function plugin_registerable($tUser=null){

	     global $mainframe,$sign_up_redirect,$timecheck,$Itemid,$prerequisite_paid,$prerequisite_attend,$now;

		  $my = &JFactory::getUser();
         if(!$this->publish){
		 	return false;
		 }
		 if($this->public != 1 && !$my->id ){ // private event requires to login

		  // return false;

	     }
		 
		 if($this->is_cutoff($this)){
		 	return false;
		 }

         if(strtotime($this->dtend." ".$this->dtendtime) < $now->toUnix(true)){
		    return false;
		 }		 
		 
		 if($this->startdate != "" && $this->startdate != "0000-00-00"){
			 if($this->starttime !=""){
			    $starttime = strtotime($this->startdate." ".$this->starttime);
			 }else{
				$starttime = strtotime($this->starttime);
			 }
			 if($starttime > $now->toUnix(true)){
				return false;
			 }
	     }
		 
		 if($this->usetimecheck && $my->id){

		       if($this->is_overlapped($tUser)){

				     $url="index.php?option=com_dtregister&Itemid=$Itemid&task=overlap&controlller=event";

					return false;

			   }	

		 }

		  $this->prerequisite;

		 if(is_array($this->prerequisite) && count($this->prerequisite)){

			  if(!$my->id){

				 // return false;

			  }else{

				 if(!$this->is_reg_prequisite($tUser)){

					//return false;			  

				 }

			  }

		 }

		 if(is_array($this->prerequisitecategory) && count($this->prerequisitecategory) > 0 ){

			  if(!$my->id){

				// return false;

			  }else{

				   if(!$this->is_reg_prequisite_cat($tUser)){

					//return false;	  

				 }   

			  }

		 }
         
		 $registered = $this->getTotalregistered($this->slabId);
		
		if($this->max_registrations <= $registered && $this->max_registrations != 0 && $this->max_registrations !=""){
		   	if(!($this->waiting_list)){
			     return false;
			}
			
	    }
		 
        return true;

	}

	function is_reg_prequisite_cat($tUser){

		 global $prerequisite_paid,$prerequisite_attend;

	   $my = &JFactory::getUser();

	   $query = "select * from #__dtregister_user u inner join #__dtregister_fee f on u.userId = f.user_id "; 

	   $where =  array();
	   $where[] = ' u.status in(1,0) ';
        if($my->id){
		   $where[] = " u.user_id =  ".$my->id;
	   }
	   if($prerequisite_paid==1){

		   $where[] = " f.status=1 ";

	   }

	   if($prerequisite_attend==1){

		   $where[] = " u.attend=1 ";

	   }

	   $where = (count($where))?' where '.implode(' and ',$where):'';

	   $query .= $where;

	   $regs = $this->query($query);

	   $prerequisite_id = array();

	 $prerequisites = $this->prerequisitecategory;

     if(is_array($prerequisites))

		foreach($prerequisites as $prerequisite){

		   $prerequisite_id[$prerequisite] = $prerequisite;

		}

		$return = false;

		$testEvt = new TableEvent($this->db);

		foreach($regs as $reg){

		   $testEvt->load($reg->eventId);
             
		   if(in_array($testEvt->category,$prerequisite_id)){

		     $return = true;

			 break;

		   }

	    }

		return $return;

	}

	function is_reg_prequisite($tUser){
       
	   global $prerequisite_paid,$prerequisite_attend;

	   $my = &JFactory::getUser();

	   $query = "select * from #__dtregister_user u inner join #__dtregister_fee f on u.userId = f.user_id  "; 

	   $where =  array();
       $where[] = ' u.status in(1,0) ';
	   if($my->id){
		   $where[] = " u.user_id =  ".$my->id;
	   }
	   
	   if($prerequisite_paid==1){

		   $where[] = " f.status=1 ";

	   }

	   if($prerequisite_attend==1){

		   $where[] = " u.attend=1 ";

	   }

	   $where = (count($where))?' where '.implode(' and ',$where):'';

	   $query .= $where;

	   $regs = $this->query($query);

	   $prerequisites = $this->prerequisite;

	   $prerequisite_id = array();

       if(is_array($prerequisites))

	   foreach($prerequisites as $prerequisite){

		    $prerequisite_id[$prerequisite] = $prerequisite;

	   }
	
	   if(is_array($regs))

	   foreach($regs as $reg){

	       if(isset($prerequisite_id[$reg->eventId])){

		     unset($prerequisite_id[$reg->eventId]);

		   }

	   }

	   return (count($prerequisite_id)==0);

	}

	function is_overlapped($tUser){

	   	$my = &JFactory::getUser();

		if (isset($my->id)) {
			$regs = self::query(" select * from #__dtregister_user where user_id={$my->id} and status<> -1",null,null);
		} else {
			$regs = self::query(" select * from #__dtregister_user where  1=1 and status<> -1",null,null);
		}

		$overlap = false;

		$testEvt = new TableEvent($this->db);
		if(DT_Session::get('register.User')) {
			
			foreach(DT_Session::get('register.User') as $user) {
				
				$testEvt->load($user['eventId']);
				if(isset($user['fields'])) {
				  $rstart1 = strtotime($testEvt->dtstart.' '.$testEvt->dtstarttime);
				  $rend1   = strtotime( $testEvt->dtend.' '.$testEvt->dtendtime);
				  $rstart2 = strtotime($this->dtstart.' '.$this->dtstarttime);
				  $rend2   = strtotime( $this->dtend.' '.$this->dtendtime);
				  
				  if(intersects($rstart1,$rend1,$rstart2,$rend2)) {
						pr($user);
		      			$overlap = true;
						break;

		  			}
				}
				
			}
			
		}
		if(!$overlap)
		foreach($regs as $reg){

		   	if($this->excludeoverlap){

		   	   continue;

		    }

			$testEvt->load($reg->eventId);

		  $rstart1 = strtotime($testEvt->dtstart.' '.$testEvt->dtstarttime);
		  $rend1   = strtotime( $testEvt->dtend.' '.$testEvt->dtendtime);
		  $rstart2 = strtotime($this->dtstart.' '.$this->dtstarttime);
		  $rend2   = strtotime( $this->dtend.' '.$this->dtendtime);
          if(intersects($rstart1,$rend1,$rstart2,$rend2)) {
			  
		      $overlap = true;

			  break;

		  }

		}
        
	   return $overlap;

	}

     function get_prerequisite(){

	   $sql = "select * from #__dtregister_prerequisite where slabId = ".$this->slabId;

	   $this->db->setQuery($sql);

	   return $this->db->loadObjectList();

	}

    function get_article_Item($article){

		if($this->detail_itemid !="" && $this->detail_itemid !='0'){

		   return $this->detail_itemid;

		}

		$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=article%' and  link like '%id=".$this->article_id."%' ";

		$this->db->setQuery($query);

		$this->db->query();

		if($this->db->getNumRows()>0){

			$menu = $this->db->loadObject();

			return $menu->id; 

		}else{

			$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=category%' and  link like '%id=".$article->catid."%' ";

			$this->db->setQuery($query);

			$this->db->query();

			if($this->db->getNumRows()>0){

				$menu = $this->db->loadObject();

				return $menu->id; 

			}else{

				$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=section%' and  link like '%id=".$article->sectionid."%' ";

				$this->db->setQuery($query);

				$this->db->query();

				if($this->db->getNumRows()>0){

					$menu = $this->db->loadObject();

					return $menu->id; 

				}else{

					return 0;

				}

			}

		}

	}

  function displayTime(){

	  return $this->dtstarttime;  

  }

  function displayTitle(){

	  global $event_show_date,$date_format;
	  
	  if($this->slabId==""){
		  return "";
	  }
      if($event_show_date){
		   $start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		   return $this->title." (".$start_date.")";
	  }else{
		  
	  }
	  return $this->title;  

   }
   
     function plugin_displayTitle($event_show_date = false){

	  global $date_format;
	  
	  if($this->slabId==""){
		  return "";
	  }
      if($event_show_date){
		   $start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		   return $this->title." (".$start_date." ".$this->plugin_displaytimecolumn(' ').")";
	  }else{
		   $start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		   return $this->title." (".$start_date.")";
	  }
	  return $this->title;  

   }
   
   function plugin_displaytimecolumn($separator="<br />",$displaytime = true){
	   	
		global $date_format;
		$start_date = JFactory::getDate($this->dtstart)->toFormat($date_format);
		$end_date = JFactory::getDate($this->dtend)->toFormat($date_format);
		$isSameDay = false;
		if($start_date == $end_date){
		   	$isSameDay = true;
		}
		if($this->timeformat==1){
  
		  $timeformat = "%I:%M %p";
  
	    }else{
  
		  $timeformat = "%H:%M";
  
	    }
			
		//if($displaytime){
		if(1){
			$startTime = JFactory::getDate($this->dtstart." ".$this->dtstarttime)->toFormat($timeformat);
			if($displaytime==1){
			   	$endTime = "";
			}else{
		       $endTime = JFactory::getDate($this->dtend." ".$this->dtendtime)->toFormat($timeformat);
			}
		}else{
		   $startTime ="";
		   $endTime = "";
		}
		$html = "";
		$htmlrow1 = "";
		$htmlrow2 ="";
		if($isSameDay){
	      // $htmlrow1 ='<span>'.$start_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}else{
		  // $htmlrow1 ='<span>'.$start_date.' - '.$end_date.'</span>';
		   $htmlrow2 = implode(" - ",array_filter(array($startTime,$endTime))); 
		}
		
		return $html = trim(implode($separator,array_filter(array($htmlrow1,$htmlrow2))));
		
    }
   
    function optionslist(){
        
		 global $event_show_date,$date_format;     

		 $data = $this->find(' 1=1 and archive=0 ',' dtstart desc ');

		 $list = array();

		 foreach($data as $value){
            $title = $value->title;
		    if($event_show_date){
		         $start_date = JFactory::getDate($value->dtstart)->toFormat($date_format);
		         $title = $value->title." (".$start_date.")";
	        }

			$list[$value->slabId] = $title;

		 }

		 return $list;

	  }
   
  function validate_code($code,$date=null){

            global $now;

			if($code==""){

			  return false;

			}

			$dt_code =& $this->TableEventdiscountcode->TableDiscountcode;

			$code = $dt_code->find('code="'.$code.'"');

            if(!isset($code[0]->id)){

			   $dt_code->error = JText::_( 'DT_CODE_INCORRECT' );

			   return false;

			}else if($code[0]->publish != 1){

			    $dt_code->error = JText::_( 'DT_CODE_NOT_AVAILABLE' );

			   	return false;

			}
           
			 $dt_code->load($code[0]->id);
   
			if($dt_code->limit > 0 && ($dt_code->limit <= $dt_code->used())){

			   $dt_code->error = JText::_( 'DT_CODE_NOT_AVAILABLE' );

			   return false;

			}

			if(!in_array($code[0]->id,$this->discountcode)){

				 $dt_code->error = JText::_( 'DT_CODE_NOT_AVAILABLE_FOR_EVENT' );

				 return false;

			}

			$expired = $dt_code->is_expired($date);

			if($expired === false){

			   	return false;

			}else{

			   	return $expired;

			}

	}

  function loadDiscountCode($discount_code_id=0){

	  $dt_code =& $this->TableEventdiscountcode->TableDiscountcode;

	  $dt_code->load($discount_code_id);

  }

  function getSlab($memtol=1){

	 $this->TableGroup->slabId = $this->slabId;

	 return $this->TableGroup->getSlab($memtol);

  }

  function getFeeorder(){

	  $temp = array();

	 $data =  $this->TableEventfeeorder->find(' eventId = "'.$this->slabId.'"',' ordering asc ');
     if($data){
	    foreach($data as $row){

	       $temp[$row->id] = $row;

	    }
     }

	 return $temp;

  }

  function getGroup($where = ""){
	  if(!$this->slabId){
	  	 return array();
	  }
	  if($where !=""){

	     $where = " and ".$where;

	  }
$data = $this->TableGroup->find(' slabId = "'.$this->slabId.'" '.$where.' ', ' id ',' member ');

return $data;
  }

  function getConfig(){  

     $temp = array();

	 $data = $this->TableEventconfig->find(' eventId = '.$this->slabId);

	 $config_array = array(

	                             'paymentmethod',

								 'cardtype',

								 'pay_later_options',

								 'cardtype'

	                           );

	 foreach($data as $val){

	   if(in_array($val->key,$config_array)){

	      $val->value = explode(",",$val->value);

	   }

	   $temp[$val->key] = $val->value;

	 }

	 return $temp;

  }

  function getDiscountcode(){

      $temp = array();

	 $data = $this->TableEventdiscountcode->find(' event_id = "'.$this->slabId.'"');
     if(is_array($data))
	 foreach($data as $val){

	     $temp[] = $val->discount_code_id;

	  }

	  return $temp;

  }

  function getPrerequisitecategory(){

     $temp = array();

	 $data = $this->TablePrerequisitecategory->find(' event_id = "'.$this->slabId.'"');
 	  if(is_array($data))
	  foreach($data as $val){

	     $temp[] = $val->prerequisite_id;

	  }

	 return $temp;

  }

  function getPrerequisite(){

     $temp = array();

	 $data = $this->TablePrerequisite->find(' event_id = "'.$this->slabId.'"');
     if(is_array($data))
	 foreach($data as $val){

	     $temp[] = $val->prerequisite_id;

	  }

	 return $temp;

  }

   function getFeeField(){

	  $fields = array();

	  $this->TableField->findtreeByEvent($this->slabId,0,$fields );

	  $feefields = array();

	  foreach($fields as $field){

		   if($field->fee_field){

			   $feefields[$field->id] = $field;    

		   }

	  }

	   return $feefields;

   }

   function getField(){

     $temp = array();

	 $data = $this->TableEventfield->find(' event_id = "'.$this->slabId.'"');
     if(is_array($data))
	 foreach($data as $row){

	    $temp[$row->field_id] = $row;

	 }

	 return $temp;

  }

   function getFile(){

	 return $this->TableEventfile->find(' event_id = "'.$this->slabId.'"');

  }
  
  function convertTimeFormat($format,&$time){
	  
	  if($time !="" && $format == 1){
		   
		   $time = strftime('%H:%M',strtotime(date('Y-m-d')." ".$time));
		   
	  }
	  
  }
  
  function save($data){
	  
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['dtstarttime']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['dtendtime']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['latefeetime']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['bird_discount_time']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['starttime']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['cut_off_time']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['change_time']);
	 $this->convertTimeFormat($data['event']['timeformat'],$data['event']['cancel_time']);
      
	 static $secondpass = 0;
	 $create_new_repeats = true;
	 $repeat_changed =  true;
	 if($data['event']['slabId']!=""){
       
		$this->load($data['event']['slabId']);

		if(isset($this->repetition) && count($this->repetition) && $this->repetition !== false 
		 && !intval($this->parent_id)){
           
		   if(!$this->validDateChange($data)){

		         $error = JText::_("DT_REPTITIONS_NOT_VALID");
				 $error = JText::_('DT_REGISTRATION_EXISTS');
                 
			     $create_new_repeats = true;
				 //pr($create_new_repeats);

		   }else{

		   }
		   
		   $repeat_changed = true;
		   pr($this->comparerepeat($data));
		   if($this->comparerepeat($data)){
		      $repeat_changed = false;
		   }else{
		   
		   }

		}

	    $created = false;

	 }else{
        $my = &JFactory::getUser();
		$data['event']['ordering'] = $this->getNextOrder();
        //$data['event']['user_id'] = $my->id;
	    $created = true;

	 }
//echo "<pre>";
//var_export($_POST);
	//$this->bind($data['event']); 
	
  //prd($data['event']);
	 unset($this->repetition);
	unset($this->error);
	 parent::save($data['event']);
	 if(isset($error))
     $this->error = $error;
	 $this->TablePrerequisitecategory->event_id = $this->slabId;

	 $this->removeprequisitecategory();
     if(isset($data['prerequisite_category'])){
	   $this->TablePrerequisitecategory->saveAll($data['prerequisite_category']);
	 }

	 $this->TablePrerequisite->event_id = $this->slabId;

	 $this->removeprequisite();
     if(isset($data['prerequisite'])){
	   $this->TablePrerequisite->saveAll($data['prerequisite']);
	 }
	 
	 $this->TableGroup->slabId = $this->slabId;

	 $this->removegroups();
     
	 $this->TableGroup->saveAll($data['group']);

	 $this->TableEventdiscountcode->event_id =  $this->slabId;
     if(isset($data['discountcode'])){
	   $this->removediscountcode();

	   $this->TableEventdiscountcode->saveAll($data['discountcode']);
	 }

	 $this->TableEventfield->event_id = $this->slabId;

	 $this->removefields();

	 $this->TableEventfield->saveAll($data['field']);

	 $this->TableEventfile->event_id = $this->slabId;

	 $this->save_files();

	 $this->copy_files();

	 $this->TableEventfeeorder->eventId = $this->slabId; 

	 $this->TableEventfeeorder->savebasictypes();

	 if(!isset($this->parent_slabId)){
	   $this->parent_slabId = $this->slabId;
	 }
     // create repeats
	 if(!$create_new_repeats){
	     $secondpass = 1;
	 }
	 pr($data['event']['repeatType']);
	 pr($secondpass);
	 pr($create_new_repeats);
	 pr($repeat_changed);
	 if(isset($data['event']['repeatType']) && $data['event']['repeatType'] !='norepeat' && $secondpass === 0 && $create_new_repeats && $repeat_changed &&!intval($this->parent_id) ){
		 $data['event']['slabId'] =  "";
		 if(!isset($this->parent_dtstart)){
           $this->parent_dtstart = $this->dtstart;
		 }
	     $secondpass = 1;

		 $repetitions = $this->createRepetitions($data);
          pr($this->slabId);
		 $data['event']['parent_id'] = $this->slabId;
		 $repetitionGroup[] = $this->slabId;
         $this->removeRepetitions();

		 //prd($data);
		 
         $this->slabId = "";
		 
		 foreach($repetitions as $repetition){
             
			 $repeatevent = new TableEvent($this->_db);
			 $data['event']['dtstart'] = $repetition['dtstart'];
             $repeatdata = $data;
			 $this->shiftDates($repeatdata['event']);
			 $repeatdata['event']['repeatType'] = 'norepeat';
			 $repeatevent->save($repeatdata);
			 $repetitionGroup[] = $repeatevent->slabId;
			 unset($repeatdata);
			 unset($repeatevent);
		 }
         $this->grouprepetitions($repetitionGroup,$data['event']);

	  }
	 
	  if(!$created){
		$this->slabId = $this->parent_slabId;
		$this->setChilds();
		 
		if(is_array($this->childs) && count($this->childs) &&!intval($this->parent_id)){
			 foreach($this->childs as $child){
				  
				  $repeatupdate = new TableEvent($this->_db);
				  $repeatupdate->slabId = $child->slabId;
				  foreach($this->repeatFields as $field){
					 
					 $data['event'][$field] = $child->$field;
				  }
				  
				  $repeatupdate->save($data);
				  $arr[] = $repeatupdate->slabId;
				  unset($repeatupdate);
			 }
			 
		}
	  }
	  
       return true;

  }

  function shiftDates(&$data){
	  
	  $this->dtstart;
	  $startdate = new JDate($this->parent_dtstart);
	  $newstartdate = new JDate($data['dtstart']);
	  
	  $startdate_offset = $newstartdate->toUnix() - $startdate->toUnix();
	  $arrDates = array('startdate','cut_off_date','bird_discount_date','latefeedate','change_date','cancel_date','dtend');
	  foreach($arrDates as $name){
		   if(isset($data[$name]) && $data[$name] !="" && $data[$name] !="0000-00-00"){
			    $diff_offset = (strtotime($data[$name]) - $startdate->toUnix(false) + $startdate_offset)/3600;
				$startdate->setoffset($diff_offset);
                $data[$name] = $startdate->toFormat('%Y-%m-%d');

		   }else{
		       $data[$name] = "";
		   }
	  }

  }

  function removeRepetitions(){

	 $delEvent = new TableEvent($this->db);

	 $repetitions = $this->getrepetions();

	 if($repetitions)

	   foreach($repetitions as $repetition){

	   	 $delEvent->delete($repetition->slabId);

       }

  }

  function delete($id){

	 parent::delete($id);
     $this->slabId = $id;
	 $this->setChilds();
	 
	 if($this->childs){
	     foreach($this->childs as $child){
				  
				  $removeEvent = new TableEvent($this->_db);
				  $removeEvent->delete($child->slabId);
				  unset($removeEvent);
		  }
		 	 
	 }

	 $this->TablePrerequisitecategory->event_id = $id;

	 $this->removeprequisitecategory();

	 $this->TablePrerequisite->event_id = $id;

	 $this->removeprequisite();
     
	 $this->TableGroup->slabId = $id;

	 $this->removegroups();
     
	 $this->TableEventdiscountcode->event_id = $id;

	 $this->removediscountcode();

	 $this->TableEventfield->event_id = $id;

	 $this->removefields();
	 
	 $this->TableEventfeeorder->removeByeventId($id);
	 $this->TableEventfile->removeByevent_id($id);
	 $user = DtrModel::getInstance('user','DtregisterModel');
	 
	 $tUser = $user->table;
	 $tUser->removeByeventId($id);

  }

  function validDateChange($data){

	 $newrepetitions = $this->createRepetitions($data);
//pr($newrepetitions);
	 $oldrepetitions = $this->getrepetions();
//pr($oldrepetitions);
	 $checkregs = true;
	 if($this->repetition === false){
		 
		 return true;
		 
	 }
    // pr($data['event']['dtstart']);
	//pr($this->dtstart);
	// pr($data['event']['dtend']);
	// pr($this->dtend);
	//pr($data['event']['rpinterval']);
	//pr($this->repetition->rpinterval);
	 
	// pr($data['event']['countselector']);
	// pr($this->repetition->countselector);
	 
	 // pr($data['event']['rpinterval']);
	 //pr($this->repetition->rpinterval);
	 if($data['event']['dtstart'] == $this->dtstart){

	     if($data['event']['dtend'] == $this->dtend){	 

			 if($data['event']['rpinterval'] == $this->repetition->rpinterval){

			     if($data['event']['countselector'] == $this->repetition->countselector){

					if($data['event']['countselector'] == $this->repetition->countselector){

					 if($this->comparerepeat($data)){//  repeates are same

					      $checkregs = true;

					 }else{// day selection settings changed

					 }

				 }else{// change count to until or vice versa

				 }

			  }else{// interval changed

			  }	 

			 }else{// freq not match

			 }

		 }else{// end date does not match

		 }

	 }else{// start date does not match
          
		  return false;
	 }
     
	 if($checkregs){

	    $regs = $this->is_anyregistration($oldrepetitions);
//pr( $regs);
		 if($regs && count($regs)){

			$this->error = JText::_('DT_REGISTRATION_EXISTS');
//pr('false');
			return false;

		 }else{
//pr('true');
			return true; 	 

		 }

     }else{

	    return true;

	 }

  }

  function comparerepeat($data){
     // pr($data['event']['repeatType']);
	//  pr($this->repetition->repeatType);
	 // pr($data['event']['weekdays']);
	//  pr($this->repetition->weekdays);
	  switch($data['event']['repeatType']){

		   case 'daily':

		      return true;

		   break;

		   case 'weekly':
		  
			if($data['event']['countselector'] != $this->repetition->countselector) {
				return false;
			}
			if($data['event']['countselector'] == 'count'){
   				if($this->repetition->rpcount != $data['event']['rpcount']){
					return false;
			    }
			}
			
			if($data['event']['countselector'] != 'count'){
   				if($this->repetition->rpuntil != $data['event']['rpuntil']){
					return false;
			    }
			}
			 
              if(count($this->repetition->weekdays) != count($data['event']['weekdays'])){
			     return false;
			  }else{
			  
			  }
		      return !(count(array_diff($this->repetition->weekdays,$data['event']['weekdays'])));

		   break;

		   case 'monthly':

		       if($this->repetition->monthdayselector == $data['event']['monthdayselector']){

				     if($this->repetition->monthdayselector == "monthdays"){
					   
					   if(count($this->repetition->monthdays) != count(array_filter(explode(",",trim($data['event']['yeardays']))))){
			     			return false;
			  			}else{
			  
			  			}
					   
					   return !(count(array_diff($this->repetition->monthdays,array_filter(explode(",",trim($data['event']['yeardays']))))));

				     }else{
						 if(count($this->repetition->weekdays) != count($data['event']['monthweeks'])){
							 return false;
						  }else{
						  
						  }
						if(!(count(array_diff($this->repetition->weekdays,$data['event']['monthweeks'])))){
							 if(count($this->repetition->weekdays) != count($data['event']['monthweekdays'])){
							 	return false;
						  	}else{
						  
						    }
							return !(count(array_diff($this->repetition->weekdays,$data['event']['monthweekdays'])));

					    }else{ // weeks do not match 

							return false;

					    }

				     }

			   }else{// month selector not matched 

				   return false;

			   }

		   break;

		   case 'yearly':

		      return !(count(array_diff($this->repetition->yeardays,array_filter(explode(",",trim($data['event']['yeardays']))))));

		   break;

	  }

  }

  function is_anyregistration($events=array()){

	 $eventIds[] = $this->slabId;

	 foreach($events as $event){

	    $eventIds[] = $event->slabId;	 

     }

	 $tUser =& DtrTable::getInstance('Duser','Table');

	 $regs = $tUser->find(" eventId in(".implode(',',array_filter($eventIds)).")");

	 return $regs;

  }

  function grouprepetitions($events=array(),$event){

	  $data['eventId'] = $event['parent_id'];

	  $data['repeatType'] = $event['repeatType'];

	  $data['rpcount'] = $event['rpcount'];

	  $data['rpuntil'] = $event['rpuntil'];

	  $data['weekdays'] = isset($event['weekdays'])?$event['weekdays']:'';

	  $data['monthdays'] = isset($event['monthdays'])?$event['monthdays']:'';

	  $data['monthweekdays'] = isset($event['monthweekdays'])?$event['monthweekdays']:'';

	  $data['monthweeks'] = isset($event['monthweeks'])?$event['monthweeks']:'';

	  $data['yeardays'] = isset($event['yeardays'])?$event['yeardays']:'';

	  $data['countselector'] = isset($event['countselector'])?$event['countselector']:'';

	  $data['monthdayselector'] = isset($event['monthdayselector'])?$event['monthdayselector']:'';

	  $data['rpinterval'] = $event['rpinterval'];

	  $this->TableRepetition->removeByeventId($data['eventId']);

	  $this->TableRepetition->save($data); 

	  $query = "update ".$this->getTableName()." set repetition_id=".$this->TableRepetition->id." where slabId in(".implode(',',array_filter($events)).")";

	  $this->rawquery($query);

	  return $this->TableRepetition->id;

  }

  function getrepetions(){

	  if($this->slabId == ""){

		  return false;

	  }
     $repevents = $this->find(' parent_id = '.$this->slabId,'dtstart');
	 
	 return $repevents;

  }

  function copy_files(){

	 $files = JRequest::getVar('copy_files',array());

     $dt_file = $this->TableEventfile;

	 foreach($files as $key => $file){

		 $dt_file->path = $file;

         $dt_file->save($evt->id);

         unset($dt_file->path);

		 unset($dt_file->id);

	 }

  }

  function save_files(){

     $files = JRequest::getVar('event_files', null, 'files', 'array');

		if(!isset($files['name'][1])){

		}else{

			$file = array();

            $dt_file = $this->TableEventfile;

			for($i=1;$i<count($files['name']);$i++){

				$file['name'] = $files['name'][$i];

				$file['type'] = $files['type'][$i];

				$file['tmp_name'] = $files['tmp_name'][$i];

				$file['size'] = $files['size'][$i];

				$file['error'] = $files['error'][$i];

				if($dt_file->upload($file)){

					$dt_file->save(array('path'=>$dt_file->path));

				}

				unset($dt_file->path);

				unset($dt_file->id);

			}

		}

  }

  function removegroups(){

	 $query = "delete from ".$this->TableGroup->getTableName()." where slabId = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

   function removeconfig(){

	 $query = "delete from ".$this->TableEventconfig->getTableName()." where eventId = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

   function removediscountcode(){

	 $query = "delete from ".$this->TableEventdiscountcode->getTableName()." where event_id = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

   function removeprequisite(){

	 $query = "delete from ".$this->TablePrerequisite->getTableName()." where event_id = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

  function removeprequisitecategory(){

	 $query = "delete from ".$this->TablePrerequisitecategory->getTableName()." where event_id = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

  function removefields(){

	 $query = "delete from ".$this->TableEventfield->getTableName()." where event_id = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }
  
  function removeImage(){
	    
	  $query = "delete from ".$this->getTableName()." where slabId = ".$this->db->Quote($this->slabId)." or parent_id = ".$this->db->Quote($this->slabId)." ";

	 $this->db->setQuery($query);

	 $this->db->query();
  }

  function findalldetail($condition, $ordering, $limitstart, $limit){
     
	 /*  to show own events 
	  $aro = $this->getModel( 'aro' );
   $user = &JFactory::getUser();
   $aro = $this->getModel( 'aro' )->table->findaroByUser($user);
   $aro_id = $aro->id ;
   $aco_id = $this->getModel( 'aco' )->table->getAcoIdbyTypeControllerTask('sessionUser','event','edit','DT_EDIT_OWN_EVENT');
   $permission = $this->getModel( 'permission' )->table->find('aro_id='.$aro_id.' and aco_id = '.$aco_id);
   if($permission){
  	 $where[]= " a.user_id = ".$user->id;
   }
	 */
	 
	 $sql = "Select SQL_CALC_FOUND_ROWS * , a.parent_id as event_parent from #__dtregister_group_event a LEFT JOIN #__dtregister_categories c ON a.category = c.categoryId

       "; // left join #__dtregister_event_detail d on d.slabId = a.slabId

	  if($condition!=""){

	     $sql .= " where ".$condition;

	  }

	  if($ordering != ""){

	     $sql .= " order by ".$ordering;

	  }

	   $this->db->setQuery($sql,$limitstart,$limit);   

	   $data = $this->db->loadObjectList(); 

	   return $data;

  }

  function setChilds(){

	  $this->childs = $this->find(" parent_id =  ".$this->slabId);

//	  prd($this->childs);

	  return (is_array($this->childs) && count($this->childs));

  }

  function findByCategory($categoryId=0,$where = "", $ordering=""){

     global $now;

	 $condition[] = $where;

	 $condition[] = " b.publish=1 "; //  a.state=1  jevent variable

	 if($categoryId==0){

		$condition[] = " c.categoryId IS NULL ";

	 }else{

		 $condition[] = " b.category= ".$categoryId;

	 }

	 $condition = array_filter($condition);

	 $where = (count($condition)>0)?' where '.implode(' and ',$condition) :'';

	 $ordering = ($ordering !="")?' order by '.$ordering : '';

     $sql = "SELECT DISTINCT(b.slabId), c.*,b.*,  if(concat(b.startdate,' ',b.starttime) >= '". $now->toMySQL(true) ."' and b.startdate is not null,'y','n') as future_event ,

        if(cut_off_date = 0000-00-00,'n',if('". $now->toMySQL(true)."'> concat(cut_off_date,' ',cut_off_time),'y','n')) as cut_off ,

		if('".$now->toMySQL(true)."' < concat(bird_discount_date,' ',bird_discount_time) and bird_discount_type<>0 and bird_discount_type <> 3,'y','n') as bird

		FROM 

		#__dtregister_group_event as b 

		left join #__dtregister_categories as c on c.categoryId = b.category 

        left join #__dtregister_locations as l on l.id = b.location_id 

		   ".$where."

		".$ordering." ";

		  $this->db->setQuery($sql);

	     // pr($this->db->getQuery());

	   $data = $this->db->loadObjectList(); 

	   foreach($data as $key => $row){

	      $data[$key]->registered = $this->getTotalregistered($row->slabId);

	   }

		return $data;
		
  }
  
  function findAllByCategory($categories,$where="",$ordering=""){

     $this->events = array();

	 $rows = $this->findByCategory(0,$where,$ordering);

	 $this->events = array_merge($this->events ,$rows);
     if(isset($categories[0]) && is_array($categories[0]))
	 foreach($categories[0] as $pcategory){

		 $rows = array();

		 $rows = $this->findByCategory($pcategory->categoryId,$where,$ordering);

		 $this->events = array_merge($this->events ,$rows);

		 $rows = array();

	     if(isset($categories[$pcategory->categoryId])){

		       foreach($categories[$pcategory->categoryId] as $childcat){ 

			     	 $rows = $this->findByCategory($childcat->categoryId,$where,$ordering);

					  $this->events = array_merge($this->events ,$rows);

			   }

		 }

	}

	return $this->events;

  }
  
  function findByCategoryTree($categoryId=0,$where = "", $ordering=""){

     global $now;

	 $condition[] = $where;
	 
	 $condition[] = " b.publish=1 "; //  a.state=1  jevent variable

	 if($categoryId==0){

		$condition[] = " c.categoryId IS NULL ";

	 } else {

		 $condition[] = " b.category= ".$categoryId;
		 // $condition[] = " c.categoryId = ".$categoryId." or c.parent_id = ".$categoryId;

	 }

	 $condition = array_filter($condition);

	 $where = (count($condition)>0)?' where '.implode(' and ',$condition) :'';

	 $ordering = ($ordering !="")?' order by '.$ordering : '';

     $sql = "SELECT DISTINCT(b.slabId), c.*,b.*,  if(concat(b.startdate,' ',b.starttime) >= '". $now->toMySQL(true) ."' and b.startdate is not null,'y','n') as future_event ,

        if(cut_off_date = 0000-00-00,'n',if('". $now->toMySQL(true)."'> concat(cut_off_date,' ',cut_off_time),'y','n')) as cut_off ,

		if('".$now->toMySQL(true)."' < concat(bird_discount_date,' ',bird_discount_time) and bird_discount_type<>0 and bird_discount_type <> 3,'y','n') as bird

		FROM 

		#__dtregister_group_event as b 

		left join #__dtregister_categories as c on c.categoryId = b.category 

        left join #__dtregister_locations as l on l.id = b.location_id 

		   ".$where."

		".$ordering." ";

		  $this->db->setQuery($sql);

	      // pr($this->db->getQuery());

	   $data =  $this->db->loadObjectList(); 

	   foreach($data as  $key => $row){

	      $data[$key]->registered = $this->getTotalregistered($row->slabId);

	   }

		return $data;
		
  }

  function findAllByCategoryTree($categories,$where="",$ordering=""){

     $this->events = array();

	 $rows = $this->findByCategoryTree(0,$where,$ordering);

	 $this->events = array_merge($this->events ,$rows);
     if(isset($categories[0]) && is_array($categories[0]))
	 foreach($categories[0] as $pcategory){

		 $rows = array();

		 $rows = $this->findByCategoryTree($pcategory->categoryId,$where,$ordering);

		 $this->events = array_merge($this->events ,$rows);

		 $rows = array();

	     if(isset($categories[$pcategory->categoryId])){

		       foreach($categories[$pcategory->categoryId] as $childcat){ 

			     	 $rows = $this->findByCategoryTree($childcat->categoryId,$where,$ordering);

					 $this->events = array_merge($this->events ,$rows);

			   }

		 }

	}

	return $this->events;

  }

  function getTotalregistered($eventId=0){

      global $queryResults;

	  $sql="SELECT SUM(a.memtot) FROM #__dtregister_user AS a	WHERE a.eventId=$eventId and a.status IN (0,1) 				  GROUP BY a.eventId	";

	  $this->db->setQuery($sql);

	  $key = md5(str_replace(" ","",$this->db->getQuery()));

	  if(isset($queryResults[str_replace(" ","",$this->db->getQuery())])){

		  $data = $queryResults[str_replace(" ","",$this->db->getQuery())];

	  }else{

		 $data = $this->db->loadResult();

		 if(!$data){

		     $data = 0;

		 }

		 $queryResults[$key] = $data;

	  }

		return $data;

  }

  function is_cutoff($row){

      global $now;

	  if($row->cut_off_date == '0000-00-00'){

	     return false;

	  }

	  if(strtotime($now->toMySQL(true)) > strtotime($row->cut_off_date.' '.$row->cut_off_time)){

		 return true;

	  }else{

	     return false;

	  }  

  }

  function is_full($row){

	  if(!isset($row->registered))

       $row->registered = $this->getTotalregistered($row->slabId);  

	   return ($row->registered >= $row->max_registrations )&&($row->max_registrations)&&($row->waiting_list=='0');

  }

  function is_waiting($row=null){

	 if($row==null){

	   $row = $this;	  

	 }
   
	 if(!isset($row->registered))

    $row->registered = $this->getTotalregistered($row->slabId);

	return ($row->registered>=$row->max_registrations)&&($row->max_registrations)&&($row->waiting_list=='1');

  }

  function getTask($row,$showpast = false){

        if($row->future_event=='y' && $showpast){

		   $task="cut_off";

		} else 	if($this->is_cutoff($row))

			$task="cut_off";

		elseif($this->is_full($row))

			$task="full";

		elseif($this->is_waiting($row))

      		$task="waiting";

      	else{

      		$task="register";

		}

	    return $task;

  }

  function getArticle($articleId){

	 $query = "select * from #__content where id=".$articleId;

		$this->db->setQuery($query);

		return $this->db->loadObject();

  }

  function getArticleItemid($article){

		if($this->detail_itemid !="" && $this->detail_itemid !='0'){

		   return $this->detail_itemid;

		}

		$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=article%' and  link like '%id=".$this->article_id."%' ";

		$this->db->setQuery($query);

		$this->db->query();

		if($this->db->getNumRows()>0){

			$menu = $this->db->loadObject();

			return $menu->id; 

		}elseif($article){

			$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=category%' and  link like '%id=".$article->catid."%' ";

			$this->db->setQuery($query);

			$this->db->query();

			if($this->db->getNumRows()>0){

				$menu = $this->db->loadObject();

				return $menu->id; 

			}else{

				$query = "select * from #__menu where link like '%option=com_content%' and link like '%view=section%' and  link like '%id=".$article->sectionid."%' ";

				$this->db->setQuery($query);

				$this->db->query();

				if($this->db->getNumRows()>0){

					$menu = $this->db->loadObject();

					return $menu->id; 

				}else{

					return 0;

				}

			}

		}

  }

  function getJeventdetailId($id){

	   $query = "select r.rp_id from #__jevents_repetition r where r.eventdetail_id = ".$id;

       $this->db->setQuery($query);

	   return $this->db->loadResult();

  }

  function overrideGlobal($id){

        global $DT_config;

		$this->load($id);

		$this->TablePayoption->id = $this->payment_id;

        $data = $this->TablePayoption->getConfig();

		if($data && is_array($data))

		foreach($data as $key=>$value){

		  $name = $key;

		  $str = " global \$".$name.";";

		  eval($str);

		  $$name = $value;

		  $this->$name = $value;

		   $$name;

		}

  }

  function resumeGlobal($id=""){

     $this->slabId = $id;

	 global $DT_config;

	 foreach($DT_config as $key=>$value){

	      $name = $key;

          $str = " global \$".$name.";";

		  $$name = $value; 

	 }

  }

  function is_passed(){

	  global $now;

	   if($this->slabId == ""){

		   return true;

	   }

	   return (strtotime($this->dtstart.' '.$this->dtstarttime) < $now->toUnix(true));

  }

  function getIndividualRate($row=null){

      $this->slabId = (!$row)?$this->slabId:$row->slabId;

	  $groups = $this->getGroup(' member=1 ');

	  $amount = (isset($groups[0]))?$groups[0]->amount:0;

	  if(isset($row->bird) && $row->bird=='y'){

	    $amount = DTrCommon::birdDiscountCalc($row->bird_discount_type,$row->bird_discount_amount,$amount);

	  }

	  return $amount;

  }

  function get_individual_custom_field($showHidden=false){

    $hidden_sql = ($showHidden)?'':' and df.hidden=0 ';

    $sql="Select fe.id as key1,   fe.* , df.id as key2 , df.* , if(fe.showed =-1, fe.showed,fe.showed) as showed , if(fe.showed =-1, fe.required,fe.required) as required ,if(fe.showed =-1, fe.group_behave ,fe.group_behave ) as group_behave From #__dtregister_fields as df inner join #__dtregister_field_event as fe on fe.field_id = df.id

			where fe.event_id=".$this->slabId." and (fe.showed in(1,3) or (fe.showed =-1 and df.showed in(1,3))) and df.published=1 ".$hidden_sql." order by ordering ";

		$this->db->setQuery($sql);

		$rowCustoms=$this->db->loadObjectList();
		
echo $this->db->getErrorMsg();
		return $rowCustoms;

  }

   function get_billing_custom_field($showHidden=false){

      $field =& DtrTable::getInstance('Field','Table');

      $rowCustoms = $field->findall($this->slabId,'B',$showHidden,0);

      return $rowCustoms;

  }

   function get_group_custom_field($showHidden=false){

      $field =& DtrTable::getInstance('Field','Table');

      $rowCustoms = $field->findall($this->slabId,'M',$showHidden,0);

      return $rowCustoms;

  }

  function form($type='I',$obj,$showHidden=false,$form='frmcart',$overlimitdisable=false){
      global $mainframe;
	  
	  if($mainframe->isAdmin()){
		  $showHidden = true;
	  }
	  
      $fieldTable = DtrTable::getInstance('field','Table');

	  $fieldType = DtrModel::getInstance('Fieldtype','DtregisterModel');

	  $fieldTypes = $fieldType->getTypes();

	  if($type=="I"){

	      $fields = $this->get_individual_custom_field($showHidden);

	   }elseif($type=="B"){

	      $fields = $this->get_billing_custom_field($showHidden);

	   }else{

	      $fields = $this->get_group_custom_field($showHidden);

	   }

	   require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
      
	  $emailConfirmation = ($type!='M')?true:false;
	  
	  $fieldView = new DtregisterViewField(array());

	   foreach($fieldView->_path['template'] as $path){

	      if(file_exists($path)){

		     $basepath = $path;

			 break;

		  }

	   }

	  $html = "";

	  foreach($fields as $field){
		
		  $class = "Field_".$fieldTypes[$field->type];

		  $fieldTable = new $class();

		  $fieldTable->load($field->id);
		  
		  if(isset($this->duplicate_check) && !$this->duplicate_check ){
			  $fieldTable->duplicate_check = $this->duplicate_check;
		  }
		  if($fieldTypes[$field->type] == "Email"){
			$fieldTable->emailConfirmation = $emailConfirmation;  
		  }

		  if($fieldTable->parent_id){

		     continue;

		  }

		  if($fieldTable->hidden && !$mainframe->isAdmin()){

		     continue;   

		  }

		  $file = $basepath."field_".$fieldTypes[$field->type].".php";

		  if (!file_exists($file)) {

		     $file = $basepath."default.php";

		  }

		    $field->label = stripslashes($field->label).":";

		  if($field->required){

		    $field->label = $field->label." <span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";

			$fieldTable->required = true;

		  }else{
		  	$fieldTable->required = false;
		  }

		  $tpl = file_get_contents($file);

		  $constants = array('[label]','[value]','[description]');

		  $description =  (trim($fieldTable->description)!="")?JHTML::tooltip($fieldTable->description, '', 'tooltip.png', '', ''):'';

		  $replace  = array($field->label,$fieldTable->formhtml($obj,$this,$form,$overlimitdisable,$type),$description); 

		  if($field->required){

		     $this->javavalidation .= $fieldTable->requiredJs;

			 $document =& JFactory::getDocument();
             $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');
	         $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/validate.js");

			 $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/validationmethods.js"); 	 

		  }

		  $this->javavalidation .= $fieldTable->addChildValidation($obj,$this,$form,$overlimitdisable);

		  $this->javavalidation .= $fieldTable->javascript_valid_data;

	      $html .= str_replace($constants,$replace,$tpl);

	  }

      return $html;

  }

  function viewFields($type='I',$obj,$showHidden=false,$form='frmcart',$overlimitdisable=false){
	  
	  $fieldTable = DtrTable::getInstance('field','Table');

	  $fieldType = DtrModel::getInstance('Fieldtype','DtregisterModel');

	  $fieldTypes = $fieldType->getTypes();

	  $fieldTable->getAllFields($this,$type,$showHidden,0,$fields);

	   require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");

	  $fieldView = new DtregisterViewField(array());

	   foreach($fieldView->_path['template'] as $path){

	      if(file_exists($path)){

		     $basepath = $path;

			 break;

		  }

	   }

	  $html = "";

      if(is_array($fields))

	  foreach($fields as $field){

		  $class = "Field_".$fieldTypes[$field->type];

		  $fieldTable = new $class();

		  $fieldTable->load($field->id);
		  
          if($fieldTable->type==6 && $fieldTable->textualdisplay == 1){
			   
			   $show_field = false;
			   if(isset($obj['fields'][$fieldTable->parent_id])){
				   
				   if(is_array($fieldTable->selection_values)){
					   
					   if(!is_array($obj['fields'][$fieldTable->parent_id])
					       && in_array($obj['fields'][$fieldTable->parent_id],$fieldTable->selection_values)){
						   
						   $show_field = true;
						    
					   }elseif(is_array($obj['fields'][$fieldTable->parent_id])){
						    	
							foreach($obj['fields'][$fieldTable->parent_id]  as $parent_value){
								if(in_array($parent_value,$fieldTable->selection_values)){
								   $show_field = true;
								   break;	
							    }
						    }
							
					   }
					   					      
				   }else{
					   if($obj['fields'][$fieldTable->parent_id] == $fieldTable->selection_values){
						   $show_field = true;
					   }  
				   }
				  		  
			   }
			    if(!$show_field){
				   continue;   		
				}
		  }elseif($fieldTable->type==6 && $fieldTable->textualdisplay == 0){
			   continue;
		  }
		  if($showHidden){
			 
		     continue;   

		  }
          
		  $file = $basepath."field_".$fieldTypes[$field->type].".php";

		  if (!file_exists($file)) {

		     $file = $basepath."default.php";

		  }

		  $field->label = stripslashes($fieldTable->label).":";

		  $tpl = file_get_contents($file);

		  $constants = array('[label]','[value]','[description]');
          
		  $value = $fieldTable->viewHtml($obj,$this,$form,$overlimitdisable);
           
		 
		  if($value){

			   $replace = array($field->label,$value,''); 

		       $html .= str_replace($constants,$replace,$tpl);

		  }

	  }

	  return $html;

  }

  function createRepetitions($data){

	   $eventdata = $data['event'];

	   $function = "make".$eventdata['repeatType']."repeat";

	   if(isset($eventdata['countselector']) && $eventdata['countselector']=='count'){		

	   }

	  return  $this->{$function}($eventdata); 

  }

  function makerepeat(){
	 
	 return array();  
  }

  function makenorepeatrepeat(){
	  return array();  
  }
  function makemonthlyrepeat($event){

	  global $now;

	  $repetitions = array();

	  $dayseconds = 86400/3600;

	  $weekseconds = 604800;

	  $startdate = new JDate($event['dtstart']);

	  $monthstart = new JDate($startdate->toFormat('%Y')."-".$startdate->toFormat('%m')."-01");

	  $currentdate = new JDate($startdate->toFormat('%Y')."-".$startdate->toFormat('%m')."-01");
	  $weekstartday = $monthstart->toFormat('%w');	  

	  $addedoffeset = 0;

	  $prevmonth = $startdate->toFormat('%m');

	  if($event['monthdayselector'] == 'monthweekdays'){

		 $week = 1;
         $count = 1;

		 while($this->validatereploop($event,$currentdate,$count)){

		     // reset to first of month
			 $month = $currentdate->toFormat('%m');
			 $year = $currentdate->toFormat('%Y');
			 
			 $prevweek = 1;
			 foreach($event['monthweeks'] as $week){
	
				 for($i=$prevweek;$i<$week;$i++){
				   
					 $addedoffeset += $dayseconds * (7);
                     $currentdate->setOffset($addedoffeset); // go to next week 
                     
					 $prevweek = $week;
				 }
				
				 $weekstartday = $currentdate->toFormat('%w');
				
				 foreach($event['monthweekdays'] as $weekday){
					
					$offset = $weekday - $weekstartday;
					$offset = ($offset < 0)?(7 +$offset):$offset;
				    $totaltime = $currentdate->toUnix(true) + ($dayseconds*($offset)*3600);
					
					if(strtotime(strftime('%Y-%m-%d',$totaltime)) > $startdate->toUnix() &&  $month == strftime('%m',$totaltime) ){
		  
					   if($event['countselector'] == 'until'){ 
                           
						   if($totaltime < strtotime($event['rpuntil']) ){						   

							   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime),'day'=>strftime('%w',$totaltime));

					           $count ++; 

						   }

					   }else{

						     $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime),'day'=>strftime('%w',$totaltime));			         

					   }

					}	    
					
				 }	 
				 
			 }
			 // reset month 
			 $nextmonthoffset = strtotime("+1 month",strtotime($year."-".$month."-01")) - $currentdate->toUnix(true);
			 $nextmonthoffset /= 3600;
			 $addedoffeset += ($nextmonthoffset);
			 $currentdate->setOffset($addedoffeset);
			
			 $count++;

		 }

	  }else{

		  $mondays = explode(",",$event['monthdays']);

		  $count = 1;

		  $interval = $event['rpinterval'];

		  while($this->validatereploop($event,$currentdate,$count)){

			  foreach($mondays as $monthday){

				    $monthday-- ;

				    $totaltime = $currentdate->toUnix(true) + ($dayseconds*$monthday*3600);

					//pr(strftime('%Y-%m-%d',$totaltime)." << ".strftime('%Y-%m-%d',$startdate->toUnix()));

					if($totaltime > $startdate->toUnix()){

						if($event['countselector'] == 'until'){

							 if($totaltime < strtotime($event['rpuntil'])){

							   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

					           $count ++; 

						     }

						}else{

 							   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

					    }

					}

			  }
             
			 $count ++;
            // pr(strftime('%Y-%m-%d',strtotime("+1 month",strtotime(strftime('%Y-%m',$currentdate->toUnix(true))."-01"))));
			// $nextmonthoffset = strtotime("+1 month", strtotime(date("F",$currentdate->toUnix(true)) . "1")) - $currentdate->toUnix(true);
			 
			  $nextmonthoffset = strtotime("+1 month",strtotime(strftime('%Y-%m',$currentdate->toUnix(true))."-01")) - $currentdate->toUnix(true);

			 $nextmonthoffset /= 3600;

			//pr("+1 month >> ".date("F",$currentdate->toUnix(true)) . "1");

			 $addedoffeset += ($nextmonthoffset);

			 $currentdate->setOffset($addedoffeset);

		  }

	  }

	  return $repetitions;

  }

  function makeweeklyrepeat($event){

      $repetitions = array();

	  $dayseconds = 86400/3600;

	  $weekseconds = 604800;

	  $startdate = new JDate($event['dtstart']);

      $currentdate = clone $startdate;

	  $addedoffeset = 0;

	  $weekstart = $startdate->toFormat('%w');
      $addedoffeset -= $weekstart*$dayseconds;

	  $currentdate->setoffset($addedoffeset);
      $count = 1; ;

	  $interval = $event['rpinterval'];
      
	  while($this->validatereploop($event,$currentdate,$count)){

		   foreach($event['weekdays'] as $weekday){
              
			   $totaltime = $currentdate->toUnix(true) + ($dayseconds*$weekday*3600) ;
			   if(strftime('%H',$totaltime) == '23') {
			   		
					$totaltime += 3600;
					
			   }
              
			  
			  // $totaltime = strtotime("+5 day", $currentdate->toUnix(true));
			   if($totaltime > $startdate->toUnix()){

			       if($event['countselector'] == 'until'){

					 if($totaltime < strtotime($event['rpuntil'])){		   

					   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime)); // ,'day'=>strftime('%w',$totaltime)
					   
                     /*   pr(strftime('%Y-%m-%d %H:%M:%S',$totaltime));
				 
				 
				 if(strftime('%w',$totaltime) == 4 || strftime('%w',$totaltime) == 6) {
				 	pr(strftime('%w',$totaltime));
					prd($repetitions);
					
				 } */
					   $count ++; 

					 }

				  }else{

				 $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime)); // ,'day'=>
				

				  }

			   }

		   }
          // pr($currentdate->toMySQL(true));
           $count ++; 
		   $addedoffeset += 7*$dayseconds*$interval;

		   $currentdate->setoffset($addedoffeset);
		   
		  // pr($currentdate->toMySQL(true));
		   
		   //pr("loop end");

	  }
     //pr($repetitions);
	 //die;
	 return $repetitions;

  }

  function makeyearlyrepeat($event){

	  $addedoffeset = 0;	  

	  $dayseconds = 86400/3600;

	  $weekseconds = 604800;

	  $startdate = new JDate($event['dtstart']);

	  $currentdate = new JDate($startdate->toFormat('%Y')."-01-01");

	  $interval = $event['rpinterval']; 

	  $count = 1;

	  $repetitions =  array();

	  while($this->validatereploop($event,$currentdate,$count)){

			   $totaltime = strtotime($currentdate->toFormat('%Y')."-".$startdate->toFormat('%m-%d'));//$currentdate->toUnix(true) + ($dayseconds*$yearday*3600);

			   if($totaltime > $startdate->toUnix(true)){

			       if($event['countselector'] == 'until'){		    

					 if($totaltime < strtotime($event['rpuntil'])){

					   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

					   $count ++; 				  

					 }

				  }else{

						 $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

				  }

			   }

		   $count++;

		   $addedoffeset += (strtotime($currentdate->toFormat('%Y-%m-%d')." +".$interval." year") - $currentdate->toUnix(true))/3600;

		   $currentdate->setoffset($addedoffeset);	    

	  }

	 return $repetitions;

  }

  function makedailyrepeat($event){

	  $dayseconds = 86400/3600;

	  $weekseconds = 604800;

	  $startdate = new JDate($event['dtstart']);

	  $currentdate = clone $startdate;

	  $interval = $event['rpinterval'];

	  $count = 1;

	  $repetitions =  array();

	  $addedoffeset = 0;

	  while($this->validatereploop($event,$currentdate,$count)){

		   $totaltime = $currentdate->toUnix(true);

		   if($totaltime > $startdate->toUnix()){

			       if($event['countselector'] == 'until'){

					 if($totaltime < strtotime($event['rpuntil'])){

					   $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

					   $count ++; 

					 }

				  }else{		  

						 $repetitions[] = array('dtstart'=>strftime('%Y-%m-%d',$totaltime));

						 $count ++;  

				  }

			   }

			 $addedoffeset += 24*$interval;

			 $currentdate->setoffset($addedoffeset);

	  }

	  return $repetitions;

  }

  function validatereploop($event,$currentdate,$count){

	    if($event['countselector'] == 'until'){
            
	 	    return ($currentdate->toUnix(true) <= strtotime($event['rpuntil']) );

		}else{

			return ($count <= $event['rpcount']);

		}

  }

}

class DtableGroup extends DtrTable{

  var $id;

  var $slabId; 

  var $member;

  var $type;

  var $amount;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_event_detail', 'id', $db );

  }

   function getSlab($membercount=1){
        if(intval($membercount) < 1){
		  $membercount = 1;
		}
        $data = $this->find(" slabId=".$this->slabId." and member <= ".$membercount." " , " member desc ",null ,  1);
        
		return $data[0];

	}

}

class TableEventconfig extends DtrTable{

   var $eventId; 

   var $key;

   var $value;

   var $id;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_event_config', 'id', $db );

  }

  function saveAll($data){

	 $config_data = array();

	  foreach($data as $key=>&$value){

		  if(is_array($value)){

		     $value = implode(",",$value);

		  }

		 $config_data[] = array('key'=>$key,'value'=>$value);	 

     }

	 parent::saveAll($config_data);

  }

}

class TablePrerequisitecategory extends DtrTable{

   var $event_id; 

   var $prerequisite_id;

   var $id;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_prerequisite_category', 'id', $db );

  }

  function saveAll($data){

     if(!is_array($data)){

		return;

	 }

	 $catdata = array();

	 foreach($data as $value){

	    $catdata []= array('prerequisite_id'=>$value);

	 }

	parent::saveAll($catdata);

  }

}

class TablePrerequisite extends DtrTable{

   var $event_id; 

   var $prerequisite_id;

   var $id;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_prerequisite', 'id', $db );

  }

   function saveAll($data){

     if(!is_array($data)){

	    return;

	 }

	 $evtdata = array();

	 foreach($data as $value){

	    $evtdata []= array('prerequisite_id'=>$value) ;

	 }

	parent::saveAll($evtdata);

  }

}

class TableEventdiscountcode extends DtrTable{

   var $event_id; 

   var $discount_code_id;

   var $id;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

	    $this->TableEventfeeorder  =& DtrTable::getInstance('Feeorder','Table');

		$this->TableDiscountcode  =& DtrTable::getInstance('Discountcode','Table');

		parent::__construct( '#__dtregister_events_codes', 'id', $db );

  }

  function saveAll($data=array()){

	 if(!is_array($data)){

	    return;	 

     }

	 $codedata = array();

     if(is_array($data))

	 foreach($data as $code){

	    $codedata[]= array('discount_code_id'=>$code);

	 }

	 parent::saveAll($codedata);

	 $feeorders = array();

	 $this->TableEventfeeorder->eventId = $this->event_id;

	 $existing_discountcodes = $this->TableEventfeeorder->getDiscountcodes();

	 $existing_discountcode_ids = array();

	 if(is_array($existing_discountcodes))

	  foreach($existing_discountcodes as $discountcode){

	    $existing_discountcode_ids[] = $discountcode->reference_id;

      }

	 $not_inserting = array_intersect( $data,$existing_discountcode_ids);

	if($existing_discountcodes)

	foreach($existing_discountcodes as $existing_discountcode){

	   	if(!in_array($existing_discountcode->reference_id,$not_inserting)){ // remove 

		   $this->TableEventfeeorder->delete($existing_discountcode->id);

	    }

    }

	 $ordering = $this->TableEventfeeorder->getNextOrder("eventId = '".$this->event_id."' ");

     if(is_array($data))

	 foreach($data as $discountcode){

		if(!in_array($discountcode,$not_inserting)){

		   	$feeorders[] = array('reference_id'=>$discountcode,'type'=>'discountcode','title'=>'','eventId'=>$this->event_id,'ordering'=>$ordering);

			$ordering ++;

	    }

    }

     if(count($feeorders) > 0)

	  $this->TableEventfeeorder->saveAll($feeorders);

  }

}

class TableEventfield extends DtrTable{

   var $event_id; 

   var $field_id;

   var $id;

   var $showed;

   var $required;

   var $group_behave = 1;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

	    $this->TableEventfeeorder  =& DtrTable::getInstance('Feeorder','Table');

		$this->TableField  =& DtrTable::getInstance('Field','Table');

		parent::__construct( '#__dtregister_field_event', 'id', $db );

  }

  function saveAll($data){

	 $fields = array();

	 $field_ids = array();

     if(is_array($data))

	 foreach($data as $key=>&$field){

	    $field['field_id'] = $key;

        if($field['showed'] == -1){
			$this->TableField->load($key);
			$field['group_behave'] = $this->TableField->group_behave;
			$field['required'] = $this->TableField->required;
	
		}		

	 }

	 parent::saveAll($data);

	 $fields = $this->getFeeField();
//pr($fields);
     if(is_array($fields))

	 foreach($fields as $field){

		 $field_ids[] = $field->id;

	  }

	 $data = $field_ids;

	 $feeorders = array();

	 $this->TableEventfeeorder->eventId = $this->event_id;

	 $existing_fields = $this->TableEventfeeorder->getFields();

	 $existing_field_ids = array();

	 if(is_array($existing_fields))

	  foreach($existing_fields as $field){

	    $existing_field_ids[] = $field->reference_id;

      }

	 $not_inserting = array_intersect( $data,$existing_field_ids);

	if($existing_fields)

	foreach($existing_fields as $existing_field){

	   	if(!in_array($existing_field->reference_id,$not_inserting)){ // remove 

		   $this->TableEventfeeorder->delete($existing_field->id);

	    }

    }

	$ordering = $this->TableEventfeeorder->getNextOrder("eventId = '".$this->event_id."' ");

     if(is_array($data))

	 foreach($data as $field){

		if(!in_array($field,$not_inserting)){

		   	$feeorders[] = array('reference_id'=>$field,'type'=>'field','title'=>'','eventId'=>$this->event_id,'ordering'=>$ordering);

			$ordering ++;

	    }  

    }

     if(count($feeorders) > 0)

	  $this->TableEventfeeorder->saveAll($feeorders);

  }

  function getFeeField(){

	  $fields = array();

	  $this->TableField->findtreeByEvent($this->event_id,0,$fields );

	  $feefields = array();
	
	  if(is_array($fields))

	  foreach($fields as  $field){

		   if($field->fee_field){

			   $feefields[$field->id] = $field;    

		   }

	  }

	   return $feefields;

   }

}

class TableJevent extends DtrTable {

      var $evdet_id;

      function __construct( &$db = null ) {

			$db = &JFactory::getDBO();

			$this->db =&$db;

			parent::__construct( '#__jevents_vevdetail', 'evdet_id', $db );

	  }
      
	  function isInstall(){

		$tables = $this->_db->getTableList();
		$table_name = $this->_db->getPrefix()."jevents_vevdetail";
		
		$sql = "select * from #__components where `option` = 'com_jevents'";
		$data = $this->query($sql,null,null);
		
		return (bool)(in_array($table_name,$tables) && $data);
			
	 }
	  
	  function optionslist(){

        global $event_show_date,$date_format,$now;     
        $sql = "SELECT DISTINCT e.evdet_id, e.summary, e.dtstart , e.dtend FROM #__jevents_vevdetail e inner join #__jevents_vevent je on je.detail_id = e.evdet_id inner join #__jevents_rrule r on je.ev_id = r.eventid left join #__dtregister_group_event g on e.evdet_id=g.eventId WHERE g.slabId is null and e.dtend > ".$now->toUnix(true)."  and r.freq = 'none' and je.state > 0 ";

	  	$data = $this->query($sql,null,null);
		
		 $list = array();
         if($data)
		 foreach($data as $value){
              $title = $value->summary;
		      if($event_show_date){
		         $start_date = JFactory::getDate($value->dtstart)->toFormat($date_format);
		         $title = $value->summary." (".$start_date.")";
	          }

			$list[$value->evdet_id] = $title;

		 }

		 return $list;

	  }

	  function getreprules($eventid=null){

		  if($this->evdet_id ==""){

			  $this->evdet_id = $eventid;

		  }

		  $query = "select * from #__jevents_rrule where eventid = ".$this->evdet_id;

		  $data = $this->query($query);

		  if($data)

		    $data = $data[0];

		  return $data;	    

	  }

	  function parserule($eventid=null){

		  if($this->evdet_id ==""){

			  $this->evdet_id = $eventid;

		  }

		  $data = $this->getreprules();

		  if($data){

		  }else{

			 return false;  

		  }

		  $function = strtolower($data->freq);

		  $method = array($this,$function);
          if(is_callable($method)){
			   
			   $this->{$function}($data);
			   
		  }else{
			   return false;
		  }
		  
		  return true;

	  }

	  function daily($rep){

		  $this->repeatType = 'daily';

		  $this->rpinterval = $rep->rinterval;

		  $this->rpcount = $rep->count;

		  $this->rpuntil = $rep->until;

	  }

	  function weekly($rep){

		  $this->repeatType = 'weekly';

		  $this->rpinterval = $rep->rinterval;

		  $this->rpcount = $rep->count;

		  $this->rpuntil = $rep->until;

		  $weekdays = explode(',',$rep->byday);

		  $weektoken = array_flip(array('SU','MO','TU','WE','TH','FR','SA'));

		  $weekdayskeys = array();

          if(is_array($weekdays))

		  foreach($weekdays as $name){

			  $weekdayskeys[] = $weektoken[$name];

		  }
		
		  $this->weekdays = $weekdayskeys;

	  }

	   function monthly($rep){

		  // +1MO,+1TH,+1FR,+1SA,+3MO,+3TH,+3FR,+3SA,+4MO,+4TH,

		  // bymonthday  = +13,14,16

		  $this->repeatType = 'monthly';

		  $this->rpinterval = $rep->rinterval;

		  $this->rpcount = $rep->count;

		  $this->rpuntil = $rep->until;

		  $this->monthdays = str_replace('+','',$rep->bymonthday);

		  $weektoken = array_flip(array('SU','MO','TU','WE','TH','FR','SA'));

		  $weekdayskeys =  array();

		  $i = 1;

		  $weekprev = 0;

		  $weeks = array();

		  $byday = array_filter(explode(",",$rep->byday));

          if(is_array($byday))

		  foreach($byday as $day){

			    if($i==1){

					$weektest = substr($day,1,1);

				   	$i++;

				}

				if($weekprev != substr($day,1,1)){

					$weekprev = substr($day,1,1);

					$weeks[] = $weekprev;

			    }

				if(substr($day,1,1)!=$weektest){

					continue;

				}else{

				   $name = substr($day,2,2);

			       $weekdayskeys[] = $weektoken[$name];

				}

		  }

		  $this->monthweekdays = $weekdayskeys;

		  $this->monthweeks = $weeks;

	  }

	  function yearly($rep){

		  $this->repeatType = 'yearly';

		  $this->rpinterval = $rep->rinterval;

		  $this->rpcount = $rep->count;

		  $this->rpuntil = $rep->until;

		  $this->yeardays = $rep->byyearday;	

	  }

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

function prt($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";	
	
	die ;
}
class DtregisterModelMigration extends DtrModel {
    
    function __construct($config = array()){
	   
	   $this->defaultfields =  array('firstname','lastname','zip','city','state','phone','email','address','address2','title','organization','country');
       parent::__construct($config);
	   $this->TableEvent  =& DtrTable::getInstance('Event','Table');
	   $this->TableUser  =& DtrTable::getInstance('Duser','Table');
	   $this->TableUsergroupamount  =& DtrTable::getInstance('Usergroupamount','Table');
	   $this->TableUserfield = & DtrTable::getInstance('Userfield','Table');
	   $this->TableMember  =& DtrTable::getInstance('Member','Table');
	   $this->fieldmapByName = array();
	   $this->fieldmapById = array();
	   
	   $this->UserFldsTodefault =  array(  
	                  'userFirstName'=>'firstname',
										'userLastName'=>'lastname',
										'userOrganization'=>'organization',
										'userAddress'=>'address',
										'userAddress2'=>'address2',
										'userCity'=>'city',
										'userState'=>'state',
										'userCountry'=>'country',
										'userZip'=>'zip',
										'userPhone'=>'phone',
										'userEmail'=>'email',
										'userTitle' => 'title'
										
	                               );
		
	   $this->UserFldsTodefault = array_flip($this->UserFldsTodefault);
	   $this->mapFields();
	}
	
	function dtuser(){
		
		
		
	}
	
	function get_jevent_offset(){
		
		$table =& JTable::getInstance('component');
		$table->loadByOption("com_jevents" );
		$temp = strtotime('now');
		$system_offset =  (strtotime(strftime('%Y%m%dT%H%M%S',$temp))-strtotime(strftime('%Y%m%dT%H%M%SZ',$temp)));
		
		$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jevents'.DS.'config.xml';
		
		if (file_exists( $path )) {
		    $instance = new JParameter( $table->params, $path );
		} else {
		    $instance = new JParameter( $table->params );
		}
		
		$jeventTimeZone = $instance->get("icaltimezonelive","");
		if($jeventTimeZone != ""){
		
			if (is_callable("date_default_timezone_set")){
				$timezone= date_default_timezone_get();
				date_default_timezone_set($jeventTimeZone);
				$jevent_offset =  (strtotime(strftime('%Y%m%dT%H%M%S',$temp))-strtotime(strftime('%Y%m%dT%H%M%SZ',$temp)));
				date_default_timezone_set($timezone);
				return ($system_offset - $jevent_offset);
		
	
			}
        }
        
		return 0 ;
			
	}
	
	function dtevents(){
		$database = &JFactory::getDBO();
		$this->get_events_error();
		$this->new_slabId = array();
		$offset = $this->get_jevent_offset();
		if($offset === 0){
			$offset = 0 ;
		}elseif($offset < 0){
			$offset = " - ".abs($offset);
		}elseif($offset > 0){
			$offset = " + ".abs($offset);
		}
		foreach($this->events_error as $eventId){
			 // insert event
			 $query = "insert into `#__dtregister_group_event` select * from `#__dtregister_rollback_group_event` where eventId = '$eventId' limit 0,1";
			 $this->TableEvent->rawquery($query);
			 $slabId = $database->insertid();
			 $this->new_slabId[$eventId] = $slabId ;
			 
			 // insert group details
			 $query = 	"insert into #__dtregister_event_detail select null , $slabId ,memberTotal, if (memberTotal*regGroupRate=regGroupPerRate,'per_person','flat'),if (memberTotal*regGroupRate=regGroupPerRate,regGroupPerRate,regGroupRate) from #__dtregister_rollback_group_event where eventId = '$eventId' ";
			  $this->TableEvent->rawquery($query);
			  
			 // get field links and  update them .
			 
			 $links = $this->get_event_field_links($eventId);
			 if(count($links)){
			 	$query = "update #__dtregister_field_event set event_id = $slabId where id in(".implode(",",$links)."  ";
				$this->TableEvent->rawquery($query);
			 }
			 // get discount code links and  update them .
			 $links = $this->get_event_code_links($eventId);
			 if(count($links)){
			 	$query = "update #__dtregister_events_codes set event_id = $slabId where id in(".implode(",",$links)."  ";
				$this->TableEvent->rawquery($query);
			 }
			 
			 // get user links and update
			  $links = $this->get_event_user_links($eventId);
			 if(count($links)){
			 	$query = "update #__dtregister_user set eventId = $slabId where id userId in(".implode(",",$links)."  ";
				$this->TableEvent->rawquery($query);
			 }
			 
			 // update title and date time of added event
			 
			 
			$query = "update #__dtregister_group_event e inner join #__jevents_vevdetail j on e.eventId=j.evdet_id set e.title = 
			j.summary ,  e.dtstart = FROM_UNIXTIME(j.dtstart ".$offset.",'%Y-%m-%d') , e.dtstarttime = FROM_UNIXTIME(j.dtstart ".$offset.",'%H:%i:%s') , 
			e.dtend =  FROM_UNIXTIME(j.dtend ".$offset.",'%Y-%m-%d') , e.dtendtime = FROM_UNIXTIME(j.dtend ".$offset.",'%H:%i:%s') where slabId = '$slabId'";
			
			$this->TableEvent->rawquery($query);
			
			/// add pay options
			$this->add_pay_option($slabId,$eventId);
			
			// add fee order for basic type ;
			$this->TableEvent->TableEventfeeorder->eventId = $slabId; 
            $this->TableEvent->TableEventfeeorder->savebasictypes();
		}
		
		$query = "update #__dtregister_group_event e inner join  #__dtregister_rollback_group_event re on re.slabId = e.slabId inner join #__jevents_vevdetail j on re.eventId=j.evdet_id set e.title = 
			j.summary ,  e.dtstart = FROM_UNIXTIME(j.dtstart ".$offset.",'%Y-%m-%d') , e.dtstarttime = FROM_UNIXTIME(j.dtstart ".$offset.",'%H:%i:%s') , 
			e.dtend =  FROM_UNIXTIME(j.dtend ".$offset.",'%Y-%m-%d') , e.dtendtime = FROM_UNIXTIME(j.dtend ".$offset.",'%H:%i:%s') ";
			
			$this->TableEvent->rawquery($query);
			
			
			$query = "update #__dtregister_user u inner join  #__dtregister_rollback_user ru on ru.userId = u.userId inner join #__dtregister_rollback_group_event re  on re.eventId = ru.eventId set u.eventId = re.slabId
		 ";
			
			$this->TableEvent->rawquery($query);
		
			
	}
	
	function add_pay_option($slabId,$eventId){
		
		$query = "select title from #__dtregister_group_event";
		$database = &JFactory::getDBO();
		$title = $database->loadResult();
		
		
		$query = "insert into #__dtregister_payment set name = ".$this->TableEvent->_db->Quote($title);
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			$payment_id = $this->TableEvent->_db->insertid();
			
			$query = "insert into #__dtregister_payment_config select null , `key` ,`value` , $payment_id from #__dtregister_rollback_event_config  where eventId = ".$eventId;
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();	
		
	}
	
	function get_event_user_links($eventId){
		
		$query = "select  userId from #__dtregister_rollback_user where eventId='$eventId'";
		$ids = $this->TableEvent->query($query,null,"","");
		$ret = array();
		foreach($ids as $id){
			$ret[] = $id->userId ;
		}
		return $ret ;
			
	}
	
	function get_event_code_links($eventId){
		
		$query = "select  id from #__dtregister_rollback_events_codes where event_id='$eventId'";
		$ids = $this->TableEvent->query($query,null,"","");
		$ret = array();
		foreach($ids as $id){
			$ret[] = $id->id ;
		}
		return $ret ;
			
	}
	
	function get_event_field_links($eventId){
		
		$query = "select  id from #__dtregister_rollback_field_event where event_id='$eventId'";
		$ids = $this->TableEvent->query($query,null,"","");
		$ret = array();
		foreach($ids as $id){
			$ret[] = $id->id ;
		}
		return $ret ;
			
	}
	
	function get_member_ids(){
		
		$query = "select  	groupMemberId from #__dtregister_group_member ";
		$ids = $this->TableEvent->query($query,null,"","");
		
		$ret = array();
		foreach($ids as $id){
			$ret[] = $id->groupMemberId ;
		}
		return $ret ;
	}
	
	function get_users(){
		
		$query = "select  userId from #__dtregister_rollback_user ";
		$ids = $this->TableEvent->query($query,null,"","");
		
		$ret = array();
		foreach($ids as $id){
			$ret[] = $id->userId ;
		}
		return $ret ;
			
	}
	
	function delete_imported_event(){
			
	}
	
	function get_events_error(){
		$database = &JFactory::getDBO();
		$tables = $database->getTableList();
	    $table_name = $database->getPrefix()."dtregister_rollback_group_event";
		$rollbackthere = !(in_array($table_name,$tables));
		$query = "select distinct re.eventId from #__dtregister_rollback_group_event re 
		           left join #__dtregister_group_event e on e.eventId = re.eventId 
				   where e.eventId is null	 " ;
				   
		$events = $this->TableEvent->query($query,null,"","");
		
		$this->events_error = array();
		
		foreach($events as $evt){
			$this->events_error[$evt->eventId] = $evt->eventId ;
		} 
	    
		
		return $this->events_error ;
			
	}
	
	function mapFields(){
	   
	    $fields = $this->TableEvent->TableField->find();
		
		if (is_array($fields)) 
		foreach($fields as $field){
			
			$this->fieldmapById[$field->id] = $field;
			
			$this->fieldmapByName[$field->name] = $field;
	    }
	   	
	}
	
	function getFieldValue($field,$value){
	   	
		if($field->type == '3'){ // checkbox
		   $index =  array();
		   $values = explode("|",$value);
		   
		   if (is_array($field->values)) 
		   foreach(explode('|',$field->values) as $key => $val){
				
				if(in_array($val,$values)){
				   	$index[] = $key;
				    
				}
			  
			}
			return implode("|",$index);
		}elseif(in_array($field->type,array(1,4))){ // radio and dropdown
			
		   	if (is_array($field->values)) 
			foreach(explode('|',$field->values) as $key => $val){
				
				if($value == $val){
				   	
					break;
				}
			  
			}
			
			return @$key;
			
		}else{
		   return $value;	
		}
		
	}
	
	function renamefields(){
		
		if (is_array($this->UserFldsTodefault)) 
		foreach( $this->UserFldsTodefault as  $key=>$value){
			$this->TableUser->renamefield($value,$key);
		}
		$this->TableUser->renamefield('userType','type');
		
	}
	
	function usertable(){
	    
		//$this->TableUser->renamefields('userType','type');
	  $user_ids = $this->get_users();
	  $where = "";
	  if(count($user_ids )){
		  
		  $where = " userId in (".implode(",",$user_ids).") ";
		  
	  }
	 
	  $users  = $this->TableUser->find($where);
	  
		$this->renamefields();
		//$this->waiting();
		
		$userdata = array();
		$usersRemoveData = array(0);
		
		if (is_array($users)) 
		foreach($users as $user){
		    $userfield =  array();
			$userfield['user_id'] = $user->userId;
			
			if (is_array($this->fieldmapByName)) 
			foreach($this->fieldmapByName as $field_name => $field){
			   if(isset($this->UserFldsTodefault[$field_name])){ // default field
			 
				    if(isset($user->{$this->UserFldsTodefault[$field_name]}) && $user->{$this->UserFldsTodefault[$field_name]} != "" ){
				       $userfield['field_id'] = $field->id;
				       $userfield['value'] = $user->{$this->UserFldsTodefault[$field_name]};
					   $userdata[] = $userfield;
					   $usersRemoveData[] = $user->userId ;
			        }elseif(isset($user->{$field_name}) && $user->{$field_name} != ""){
						
					  $userfield['field_id'] = $field->id;
						$userfield['value'] = $this->getFieldValue($field,$user->{$field_name});
						$userdata[] = $userfield;
						$usersRemoveData[] = $user->userId;
						
				    }
				   
			   }else{ //custom default field
				    
					if(isset($user->{$field_name}) && $user->{$field_name} != ""){
					  $userfield['field_id'] = $field->id;
						$userfield['value'] = $this->getFieldValue($field,$user->{$field_name});
						$userdata[] = $userfield;
						$usersRemoveData[] = $user->userId;
						
				    }
					
			   }
			  	
			}
			
		}
		if(count($usersRemoveData)){
			
			$query = "delete from #__dtregister_user_field_values where user_id in (".implode(",",$usersRemoveData).") ";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			
		}
		//$this->TableUser->TableUserfield->truncate();
		
		$this->TableUser->TableUserfield->saveAll_migration($userdata);
		$this->updatememtot();
		$this->updatestatus($user_ids);
		$this->membertable($user_ids);
		$this->fee($user_ids);
	 		
	}
	
	function updatestatus($user_ids ){
		/*$this->statustxt =  array(-2=>JText::_('DT_WAITING'),-1=>JText::_('DT_CANCELLED'),0=>JText::_('DT_PENDING'),1=>JText::_('DT_ACTIVE'));
		case 0:
					      echo  JText::_( 'DT_ACTIVE' );
					   break;
					   
					   case 1:
					      echo  JText::_( 'DT_CANCELLED' );
					   break;
					   
					   case 2:
					      echo  JText::_( 'DT_PENDING' );
					   break; */
		if(count($user_ids)){
			$query = "update #__dtregister_user set status = 1 where cancel = 0 and userId in (".implode(",",$user_ids).")";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			$query = "update #__dtregister_user set status = -1 where cancel = 1 and userId in (".implode(",",$user_ids).")";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			$query = "update #__dtregister_user set status = 0 where cancel = 2 and userId in (".implode(",",$user_ids).")";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
		}
				
	}
	
	function waiting(){
	    $query = "insert into #__dtregister_user(eventId,type,firstname,address,state,zip,phone,country,email,memtot,status,register_date) select event_id ,if(number_registrants>1,'G','I')fname,address,state,zip,phone,country,email ,number_registrants,number_registrants,-2,created from #__dtregister_waiting";
		$waitings = $this->TableEvent->query($query,null,"","");
		
	}
	
	function savebasictypes(){
		
		 $query = "select slabId from `#__dtregister_group_event`";
		 $events = $this->TableEvent->query($query,null,"","");
		 
		 if (is_array($events)) 
		 foreach($events  as $events){
		 	 $this->TableEvent->TableEventfeeorder->eventId = $events->slabId; 

	         $this->TableEvent->TableEventfeeorder->savebasictypes();
		 }
		 	
	}
	
	function fee($user_ids){
		//select gm.amount , u.paid_amount ,u.due_payment , u.userId , u.payment_type ,
		//from jos_dtregister_group_amount as gm 
  //inner join jos_dtregister_group as g on g.groupId= gm.groupId 
  // inner join jos_dtregister_user u on  g.useid = u.userId
		/*$users = $query = "select  gm.amount , u.paid_amount ,u.due_payment , u.userId , 
		           u.payment_type ,u.memtot , u.userId , u.eventId , u.register_date
		           from #__dtregister_user u 
		           inner join #__dtregister_group as g on g.useid = u.userId
				   inner join #__dtregister_group_amount as gm on g.groupId = gm.groupId
				    where u.eventId = 45 " ;
				   $users = $this->TableEvent->query($query);
		foreach($users as $user){
			pr($user);
			$this->TableEvent->load($user->eventId);
			$this->TableUser->load($user->userId);
			//$feeObj = new DT_Fee($this->TableEvent,$this->TableUser);
			//$feeObj->getFee(false,$user->register_date);
			$fee['fee'] = $user->amount ;
			$fee['paid_fee'] =$user->paid_amount;
			$fee['userId'] = 
			prd($feeObj);
			unset($feeObj);
		}*/
		
		$query = 'delete  from `#__dtregister_fee` where user_id in(select user_id from (SELECT sum( 1 ) AS tot, user_id  FROM `#__dtregister_fee` GROUP BY user_id HAVING tot >1)t)';
		
		$this->TableEvent->rawquery($query);
		
		if(count($user_ids)){
			
			$query = 'delete  from `#__dtregister_fee` where user_id in('.implode(",",$user_ids).')';
		
		    $this->TableEvent->rawquery($query);	
		}
		
	   echo $this->TableEvent->_db->getErrorMsg();
		
	    $query = "SELECT sum( 1 ) AS tot, user_id  FROM `#__dtregister_fee` GROUP BY user_id HAVING tot >1 ";

		$duplicates = $this->TableEvent->query($query,null,"","");
		echo $this->TableEvent->_db->getErrorMsg();
		
		if (is_array($duplicates)) 
		foreach($duplicates as $duplicate){
			echo 'delete  from `#__dtregister_fee` where user_id = '.$duplicate->user_id.' ';
			$dups = $this->TableEvent->rawquery('delete  from `#__dtregister_fee` where user_id = '.$duplicate->user_id.' ');
			echo $this->TableEvent->_db->getErrorMsg();
			/*foreach($dups as $key => $dup){
			     if($key==0) continue;
				  $query = "delete from #__dtregister_fee where id = ".$dup->id;
				  $this->TableEvent->rawquery($query);
				  echo $this->TableEvent->_db->getErrorMsg();
				 
			}*/
			
		}
		
		
		$query = "insert into #__dtregister_fee(fee,paid_amount,due,user_id,payment_method,status) SELECT gm.amount , u.paid_amount ,u.due_payment , u.userId , u.payment_type , u.pay_later_paid
FROM #__dtregister_group_amount AS gm
INNER JOIN #__dtregister_group AS g ON g.groupId = gm.groupId
INNER JOIN #__dtregister_user u ON g.useid = u.userId where u.userId in(".implode(",",$user_ids).")";

       $this->TableEvent->rawquery($query);
	   echo $this->TableEvent->_db->getErrorMsg();
	   
	   $query = "update #__dtregister_fee set payment_method = 1 where  payment_method = 'At_door'";
	   $this->TableEvent->rawquery($query);
	   echo $this->TableEvent->_db->getErrorMsg();
	   $query = "update #__dtregister_fee set payment_method = 2 where  payment_method = 'Mail'";
	   $this->TableEvent->rawquery($query);
	   echo $this->TableEvent->_db->getErrorMsg();
	   $query = "update #__dtregister_fee set payment_method = 3 where  payment_method = 'Phone'";
	   $this->TableEvent->rawquery($query);
	   echo $this->TableEvent->_db->getErrorMsg();
	   
		
	}
	
	function event(){
		$this->updateAssocJevent();
		$this->populateEventDetails();
		$this->groupEvents();
	    $this->eventPayoptions();
		$this->savebasictypes();
	}
	
	function eventPayoptions(){
		
		$query = "DELETE t1, t2 FROM #__dtregister_payment t1 INNER JOIN  #__dtregister_payment_config t2  WHERE t1.id=t2.payment_id AND t1.default=0";
		$this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();
		$query = "select distinct c.eventId , e.title from #__dtregister_event_config c inner join  #__dtregister_group_event e on e.slabId = c.eventId  where e.payment_option = 2 group by eventId";
		$events = $this->TableEvent->query($query,null,"","");
		
		if (is_array($events)) 
		foreach($events as $event){
			
			$query = "insert into #__dtregister_payment set name = ".$this->TableEvent->_db->Quote($event->title);
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			$payment_id = $this->TableEvent->_db->insertid();
			
			$query = "insert into #__dtregister_payment_config select null , `key` ,`value` , $payment_id from #__dtregister_event_config  where eventId = ".$event->eventId;
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			
		}
		
	}
	
	function groupEvents(){
		$query = "SELECT sum( 1 ) AS tot, eventId, slabId FROM `#__dtregister_group_event` GROUP BY eventId HAVING tot >1 where eventId <> 0";

		$events = $this->TableEvent->query($query,null,"","");
		
	    if (count($events) > 0 ) {
			foreach($events as $event){
				$dupevents = $this->TableEvent->find('eventId = '.$event->eventId." and eventId <> 0");
				
				if (is_array($dupevents)) 
				foreach($dupevents as $key => $dupevent){
					 if($key==0) continue;
					  $query = "delete from #__dtregister_group_event where slabId = ".$dupevent->slabId;
					  $this->TableEvent->rawquery($query);
					  echo $this->TableEvent->_db->getErrorMsg();
					 
				}
				
			}
		}
		if($events){
			$query = "ALTER TABLE `#__dtregister_group_event` CHANGE `slabId` `slabId` INT( 11 ) NOT NULL";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();		
	 
			 $query = "ALTER TABLE `#__dtregister_group_event` DROP PRIMARY KEY";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();	
			
			$query = "Update #__dtregister_group_event set slabId = eventId";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			
			$query = "ALTER TABLE `#__dtregister_group_event` ADD PRIMARY KEY(`slabId`)";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();	
			
			$query = "ALTER TABLE `#__dtregister_group_event` CHANGE `slabId` `slabId` INT( 11 ) NOT NULL AUTO_INCREMENT";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			return true;
		}else{
			return false;
		}

	}
	
	function fix_migration(){
		
		 
		 
		 //$query = "update `#__dtregister_group_event` e , `#__dtregister_rollback_group_event` re  set e.eventId = re.eventId 
//where re.slabId = e.slabId ";
		 //$this->TableEvent->rawquery($query);
		 $this->TableEvent->truncate();
	     echo $this->TableEvent->_db->getErrorMsg();
		 
		 $query = "insert into `#__dtregister_group_event` select * from `#__dtregister_rollback_group_event`";
         $this->TableEvent->rawquery($query);
		 echo $this->TableEvent->_db->getErrorMsg();		
		 $updated = $this->groupEvents();
		 if($updated){
		 	$this->updateAssocJevent();
		    $this->eventPayoptions();
		    $this->savebasictypes();
		 }
		
		 $this->usertable();
		 /*
		 $query = "ALTER TABLE `#__dtregister_group_event` CHANGE `slabId` `slabId` INT( 11 ) NOT NULL";
        $this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();		

         $query = "ALTER TABLE `#__dtregister_group_event` DROP PRIMARY KEY";
        $this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();	
     
		$query = "Update #__dtregister_group_event set slabId = eventId";
		$this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();
		
		$query = "ALTER TABLE `#__dtregister_group_event` ADD PRIMARY KEY(`slabId`)";
        $this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();	
 		
		$query = "ALTER TABLE `#__dtregister_group_event` CHANGE `slabId` `slabId` INT( 11 ) NOT NULL AUTO_INCREMENT" ;
        $this->TableEvent->rawquery($query);
		echo $this->TableEvent->_db->getErrorMsg();
		
		*/
	
	}
	
	function populateEventDetails(){
		
	$query = 	"insert into #__dtregister_event_detail select null , slabId ,memberTotal, if (memberTotal*regGroupRate=regGroupPerRate,'per_person','flat'),if (memberTotal*regGroupRate=regGroupPerRate,regGroupPerRate,regGroupRate) from #__dtregister_group_event ";
	
	  $this->TableEvent->rawquery($query);
	  
	}
	
	function updateAssocJevent(){
		$query = "update #__dtregister_group_event e inner join #__jevents_vevdetail j on e.eventId=j.evdet_id set e.title = j.summary ,  e.dtstart = FROM_UNIXTIME(j.dtstart,'%Y-%m-%d') , e.dtstarttime = FROM_UNIXTIME(j.dtstart,'%h:%i:%s') , e.dtend =  FROM_UNIXTIME(j.dtend,'%Y-%m-%d') , e.dtendtime = FROM_UNIXTIME(j.dtend,'%h:%i:%s') ";
		
		$this->TableEvent->rawquery($query);
	}
	
	function membertable($user_ids){
	   
	   $this->updateUserId();
	   $member_ids = $this->get_member_ids();
	   
	   if(count($member_ids) < 1){
		   return ;
	   }else{
			$where = " 	groupMemberId in(".implode(",",$member_ids).") ";
	   }
	   
	   $members =  $this->TableMember->find($where,null,"","");
	   $memberdata = array();
	   $membersRemoveData = array();
	   
	   if (is_array($members)) 
	   foreach($members as $member){
		  $memberfield =  array();
			$memberfield['member_id'] = $member->groupMemberId;
			
			if (is_array($this->fieldmapByName)) 
			foreach($this->fieldmapByName as $field_name => $field){
			    // default field
				    
					if(isset($member->{$field_name}) && $member->{$field_name} != ""){
					  $memberfield['field_id'] = $field->id;
						$memberfield['value'] = $this->getFieldValue($field,$member->{$field_name});
						$memberdata[] = $memberfield;
						$membersRemoveData[] = $member->groupMemberId;
				    }

			}
		}
		if(count($membersRemoveData)){
			
			$query = "delete from #__dtregister_member_field_values where member_id in (".implode(",",$membersRemoveData).") ";
			$this->TableEvent->rawquery($query);
			echo $this->TableEvent->_db->getErrorMsg();
			
		}
		//$this->TableMember->TableMemberfield->truncate();
		$this->TableMember->TableMemberfield->saveAll_migration($memberdata);
	   	
	}
	
	function updatememtot(){
		     
		 $query = "update #__dtregister_user as u inner join #__dtregister_group as g on g.useid= u.userId inner join #__dtregister_group_amount ga  set  u.memtot = ga.numberOfPerson ";
		 
		 $this->TableUser->rawquery($query);
		 $query = "update #__dtregister_user set memtot = 1 where memtot = 0";
		 
		 $this->TableUser->rawquery($query);
		 //pr($this->TableUser->_db->getErrorMsg());
	}
	
	
	
	function updateUserId(){
		
	   $query = "update from #__dtregister_group_member as gm  inner join #__dtregister_group as g on g.groupId= gm.groupUserId  set gm.groupUserId = g.useid ";
		 
		 $this->TableMember->rawquery($query);
	}
	
	function rollback(){
	    
		$tables = $this->_db->getTableList();
		
		if (is_array($tables)) 
		foreach($tables as $table){
			if(strpos($table,'_dtregister_')){
				if(!strpos($table,'_bak') && !strpos($table,'_rollback')){
					$rollbacktable  = str_replace('_dtregister_','_dtregister_rollback_',$table);
					$query = "TRUNCATE TABLE `".$table."` ";
					$this->_db->setQuery($query);
					//pr($this->_db->getQuery());
					$this->_db->query();
					
					$query = "insert into `".$table."` select * from `".$rollbacktable."`";
					$this->_db->setQuery($query);
					//pr($this->_db->getQuery());
					$this->_db->query();
				}
				
			}
		}
		
	}
	
	function backupForRollback(){
		
		$tables = $this->_db->getTableList();
		$tablelist = $tables;
		//pr($tablelist);
		
		if (is_array($tables)) 
		foreach($tables as $table){
			
			if(strpos($table,'_dtregister_')){
				if(!strpos($table,'_bak') && !strpos($table,'_rollback')){
					$newtable = str_replace('_dtregister_','_dtregister_rollback_',$table);
					
					if(in_array($newtable,$tablelist)){
						$query ="drop ".$newtable." ";
						$this->_db->setQuery($query);
						//pr($this->_db->getQuery());
						$this->_db->query();
					}
					$query = "create TABLE  `".$newtable."` select * from  `".$table."`";
					$this->_db->setQuery($query);
					//pr($this->_db->getQuery());
					$this->_db->query();
					//pr($newtable);
				}
				
			}
			
		}
		
	}
	
	function migrate_backup(){
    
	$database = &JFactory::getDBO();
	
	$tables = $this->_db->getTableList();
	$table_name = $this->_db->getPrefix()."dtregister";
	$take_backup = !(in_array($table_name,$tables));
	
/*	if(!$take_backup){
		
		$query = "select * from #__dtregister where `property` = 'migrate' and `value` = 0" ;
		$database->setQuery($query);
		$data = $database->loadObjectList();
		$take_backup = !!($data);
		
	}*/
	
	if($take_backup){
	    
		 "create TABLE `#__dtregister_bak_categories` select * from  `#__dtregister_categories`;
		  create TABLE `#__dtregister_bak_codes` select * from  `#__dtregister_codes`;
		  create TABLE `#__dtregister_bak_config` select * from  `#__dtregister_config`;
		  create TABLE `#__dtregister_bak_events_codes` select * from  `#__dtregister_events_codes`;
		  create TABLE `#__dtregister_bak_event_config` select * from  `#__dtregister_event_config`;
		  create TABLE `#__dtregister_bak_export_fields` select * from  `#__dtregister_export_fields`;
		  create TABLE `#__dtregister_bak_fields` select * from  `#__dtregister_fields`;
		  create TABLE `#__dtregister_bak_field_event` select * from  `#__dtregister_field_event`;
		  create TABLE `#__dtregister_bak_files` select * from  `#__dtregister_files`;
		  create TABLE `#__dtregister_bak_group` select * from  `#__dtregister_group`;
		  create TABLE `#__dtregister_bak_group_amount` select * from  `#__dtregister_group_amount`;
		  create TABLE `#__dtregister_bak_group_event` select * from  `#__dtregister_group_event`;
		  create TABLE `#__dtregister_bak_group_member` select * from  `#__dtregister_group_member`;
		  create TABLE `#__dtregister_bak_history` select * from  `#__dtregister_history`;
		  create TABLE `#__dtregister_bak_ipn_debug` select * from  `#__dtregister_ipn_debug`;
		  create TABLE `#__dtregister_bak_locations` select * from  `#__dtregister_locations`;
		  create TABLE `#__dtregister_bak_prerequisite` select * from  `#__dtregister_prerequisite`;
		  create TABLE `#__dtregister_bak_prerequisite_category` select * from  `#__dtregister_prerequisite_category`;
		  create TABLE `#__dtregister_bak_session` select * from  `#__dtregister_session`;
		  create TABLE `#__dtregister_bak_sync` select * from  `#__dtregister_sync`;
		  create TABLE `#__dtregister_bak_user` select * from  `#__dtregister_user`;
		  create TABLE `#__dtregister_bak_waiting` select * from  `#__dtregister_waiting`;";
		  
		  $database->setQuery($query);
		  $database->query();
		  
	}
		
}
	
}
?>
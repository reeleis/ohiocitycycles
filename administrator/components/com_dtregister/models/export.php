<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelExport extends DtrModel {
	public static $limit = 4;
	function __construct($config = array()){
	   
	   parent::__construct($config);
	   $this->table = new TableExport($this->getDBO());
	   $this->generalFields =  array(
	   							   'event_date'=> JText::_('DT_EVENT_DATE'),
	                               'type'=> JText::_('DT_USER_TYPE'),
								   'amount'=> JText::_('DT_AMOUNT'),
								   'payment_type'=> JText::_('DT_PAYMENT_TYPE'),
								   'paid'=>JText::_('DT_PAYMENT_STATUS') ,
								   'paid_amount'=>JText::_('DT_AMOUNT_PAID') ,
								   'memtot'=> JText::_('DT_NUMBER_MEMBERS'),
								   'confirmNum'=> JText::_('DT_CONFIRMATION_NUMBER'),
								   'code'=> JText::_('DT_DISCOUNT_CODE'),
								   'category'=> JText::_('DT_CATEGORY'),
								   'location'=> JText::_('DT_LOCATION'),
								   'user_id'=>JText::_('DT_JOOMLA_USERID'),
								    'attend' =>JText::_('DT_ATTENDED'),
								   'status'=>  JText::_('DT_STATUS'),
								   'transaction_id'=>  JText::_('DT_TRANSACTION_ID'),
								   'userId'=>  JText::_('DT_USER_ID')
	                             );

	}
	
	function prepareEventoptions($events=array()){
	   	$tevt =& DtrTable::getInstance('Event','Table');
		$options = array();
		
		if (count($events) > 0) {
			foreach($events as $event){
				$tevt->load($event->slabId);
				$options[$event->slabId] = $tevt->displayTitle();
			}
		}
		return $options;
	}
}

class TableExport extends DtrTable{
    
	var $id;
	var $events = array();
	var $group_export_fields =  array();
	var $general_export_fields = array();
	var $individual_export_fields =  array();
	
    function __construct( &$db = null ) {

	     $db = &JFactory::getDBO();

	     parent::__construct( '#__dtregister_export_settings', 'id', $db );
		 $this->UserModel =& DtrModel::getInstance('User','DtregisterModel');
		 $this->pmethod =& DtrModel::getInstance('paymentmethod','DtregisterModel');
		 $this->feeModel =& DtrModel::getInstance('fee','DtregisterModel');
		 $this->Tablefield  =& DtrTable::getInstance('Field','Table');
		 $this->generalFields = array(
		 						   'event_date'=> JText::_('DT_EVENT_DATE'),
	                               'type'=> JText::_('DT_USER_TYPE'),
								   'amount'=> JText::_('DT_AMOUNT'),
								   'payment_type'=> JText::_('DT_PAYMENT_TYPE'),
								   'paid'=>JText::_('DT_PAYMENT_STATUS') ,
								   'paid_amount'=>JText::_('DT_AMOUNT_PAID') ,
								   'memtot'=> JText::_('DT_NUMBER_MEMBERS'),
								   'confirmNum'=> JText::_('DT_CONFIRMATION_NUMBER'),
								   'code'=> JText::_('DT_DISCOUNT_CODE'),
								   'category'=> JText::_('DT_CATEGORY'),
								   'location'=> JText::_('DT_LOCATION'),
								   'user_id'=>JText::_('DT_JOOMLA_USERID'), 
								   'attend' =>JText::_('DT_ATTENDED'),
								   'status'=>  JText::_('DT_STATUS'),
								   'transaction_id'=>  JText::_('DT_TRANSACTION_ID'),
								   'userId'=>  JText::_('DT_USER_ID')
	                             );
		
		$fieldType =  DtrModel::getInstance('Fieldtype','DtregisterModel');
        $this->fieldTypes =  $fieldType->getTypes();
		
	}
   	
	function load($id){
	   
	   parent::load($id);
	   $this->events = json_decode($this->events);
	   $this->general_export_fields = ($this->general_export_fields=='')?array():json_decode($this->general_export_fields);
	   $this->group_export_fields = ($this->group_export_fields=='')?array():json_decode($this->group_export_fields);
	   $this->individual_export_fields = ($this->individual_export_fields=='')?array():json_decode($this->individual_export_fields);
	}
	
	function saveFields($general=array(),$individual=array(),$group=array()){
	   	
		$sgeneral = json_encode($general);
		$sindividual = json_encode($individual);
		$sgroup = json_encode($group);
		$this->individual_export_fields = $sindividual;
		$this->general_export_fields = $sgeneral;
		$this->group_export_fields = $sgroup;
		$this->loadfirstRow();
		
		if($this->id){
		   	$this->save_field('general_export_fields' , $this->_db->Quote($sgeneral));
			echo $this->_db->getErrorMsg();
			$this->save_field('group_export_fields' , $this->_db->Quote($sgroup));
			echo $this->_db->getErrorMsg();
			$this->save_field('individual_export_fields' , $this->_db->Quote($sindividual));
			echo $this->_db->getErrorMsg();
			
		}else{
		   //$this->save(array('events'=> $sevents));	
		}
		
		$this->individual_export_fields = $individual;
		$this->general_export_fields = $general;
		$this->group_export_fields = $group;
	
	}
	function saveEvents($events = array()){
	    $sevents = json_encode($events);
		$this->events = $sevents;
		$this->loadfirstRow();
		if($this->id){
		   	$this->save_field('events', $this->_db->Quote($sevents));
		}else{
		   $this->save(array('events'=> $sevents));	
		}
		
		$this->events = $events;
		
	}
	function loadfirstRow(){
	   
	   $data = $this->find('','',0,1);
	   
	   if($data){
		  $this->load($data[0]->id);   
	   }
	}
	function mergeCustomFieldHeader(){
	  
	  global $csv_separator;
		
	  $group_export_fields = array();
	  $individual_export_fields =  array();
	  if (count($this->individual_export_fields) > 0) {
	  		$individual_export_fields =  array_combine($this->individual_export_fields,$this->individual_export_fields);
	  }
	  if (count($this->group_export_fields) > 0) {
	  		$group_export_fields =  array_combine($this->group_export_fields,$this->group_export_fields);
	  }
	  $merge = array();
	
	   if (count($individual_export_fields) > 0) {
		   foreach($individual_export_fields as $key=>$id){
			   
			   $merge[] = $id;
			   $this->field_settings[$id][] = 'individual';
			   if(isset($group_export_fields[$key])){
				   unset($group_export_fields[$key]);
				   $this->field_settings[$id][] = 'group';
				   
			   }
				
		   }
	   }
	   
	   if (count($group_export_fields) > 0) {
		   foreach($group_export_fields as $field){
			   $this->field_settings[$field][] = 'group';
		   }
	   }
	
	   $merge = array_merge($merge,$group_export_fields);

	   $flds = array();
	   if(count($merge)) {
		 
	       $fields = $this->Tablefield->find( 'id in('.implode(",",$merge).')','ordering ');
		   
		   $temp = array();
		   
		   if (count($fields) > 0) {
			   foreach($fields as $field){
				   
				   $temp[$field->id] = $field->id;
				   $flds[$field->id] = $field;
				   
			   }
		   }
		   $merge = $temp;
	   }
	   //$this->field_settings = $field_settings; 
	   $this->customHeaderFields = $merge;
	   $this->customFields = $flds;

	}
	function getUsers($datefrom="", $dateto="",$page=0){
	   	
		$where[] =  " eventId in(".implode(",",$this->events).") ";
		$dateto_con = "";
        $datefrom_con = ""; // CAST('2000-01-01' AS DATE)
	    if($datefrom!=""){
	
		   $datefrom = strftime('%Y-%m-%d', strtotime($datefrom)) ." 00:00:00";
	       $where[] = "  register_date >= '$datefrom' ";
	
		}
	    if($dateto!=""){
	
		   $dateto = strftime('%Y-%m-%d', strtotime($dateto))." 23:59:59";
	       $where[] = "  register_date  <= '$dateto' "; 
		
		}
		if(isset($_REQUEST['status']) && count($_REQUEST['status'])){
			
			$where[] = " status in(".implode(",",$_REQUEST['status']).") ";
			
		}else{
			
		   return array();
		   
		}
		
		$condition =  implode(' and ',$where);
	    $limitstart = $page*DtregisterModelExport::$limit;
		
		$users = $this->UserModel->table->find($condition,'register_date',$limitstart,DtregisterModelExport::$limit);
		$this->totalcount = $this->UserModel->table->getLastCount();
		//pr($this->totalcount);
		return $users;
	}
	
	function getgeneralHeader(){
	  $generalfields = array();
	  if (count($this->general_export_fields) > 0) {
	  		$generalfields = array_combine($this->general_export_fields,$this->general_export_fields);
	  }
	  if (count($generalfields) > 0) {
		  foreach($generalfields as $field){
			   $this->field_settings[$field][] = 'general';
		  }
	  }
		
	}
	function makeheader(){
		
		global $csv_separator;
		
	    $header = array();
		$header['register_date'] = JText::_('DT_REGISTER_DATE');
		$header['eventname'] = JText::_('DT_EVENT_NAME');
		
		if (count($this->general_export_fields) > 0) {
			foreach($this->general_export_fields as $field){
				
				$header[$field] = $this->generalFields[$field];
				
			}
		}
		
		if (count($this->customHeaderFields) > 0) {
			foreach($this->customHeaderFields as $field){
				$header[$field] = $this->customFields[$field]->name;
			}
		}
		$this->header = $header;
		
		if($_REQUEST['page']==0){
		   $this->csvoutput .= implode("$csv_separator",$header)."\n";
		}
	
	}

	function type($user){
	  	return $user->type;
	}
	function memtot($user){
	  	return $user->memtot;
	}
	
	function confirmNum($user){
	   	return $user->confirmNum;
	}
	
	function code($user){
	   return $user->TableDiscountcode->name;
	}
	function groupId($user){ // not required in MVC
	    return "";
	}
	function user_id($user){
	  return ($user->user_id)?$user->user_id:''; 
	}
	
	function userId($user){
	  return ($user->userId)?$user->userId:''; 
	}
	function category($user){
	  return $user->TableEvent->TableCategory->categoryName;
	}
	function location($user){
		//pr($user->TableEvent->location_id);
		//pr($user->TableEvent->TableLocation);
	  return $user->TableEvent->TableLocation->name;
	}
	function amount($user){
	    return $user->fee->fee;	
	}
	function payment_type($user){
		$methods = $this->pmethod->getMergeList();
		return isset($methods[$user->fee->payment_method])?$methods[$user->fee->payment_method]:'';	
	}
	
	function event_date($user){
		return $user->TableEvent->displaydatecolumn_no_html();
			}
	
	function paid($user){
	    
		return isset($this->feeModel->table->statustxt[$user->fee->status])?$this->feeModel->table->statustxt[$user->fee->status]:'';	
	}
	
	function paid_amount($user){
	    
		return  DTreg::showprice($user->fee->paid_amount);	
	}
	
	function attend($user){
	     return $user->attendtxt[$user->attend];
	}
	
	function status($user){
	    return $user->statustxt[$user->status];	
	}
	
	function transaction_id($user){
	   	 return ($user->transaction_id)?$user->transaction_id:''; 
	}
	function getUserColumndata($user,$field){
		
	  	if(in_array($field,$this->general_export_fields)){
		    return $this->{$field}($user);
		}else{
			$class = "Field_".$this->fieldTypes[$this->customFields[$field]->type];

		    $fieldTable = new $class();
            
		    $fieldTable->load($field);
			$function = "viewHtml";
			if(method_exists($fieldTable,'exportView')){
			   	$function = "exportView";
			}
		    return $fieldTable->{$function}((array)$user);
		}
	}
	
	function getMemberColumndata($member,$field){
	    
		if(in_array($field,$this->general_export_fields)){
		    return $this->{$field}($user);
		}else{
		    $class = "Field_".$this->fieldTypes[$this->customFields[$field]->type];

		    $fieldTable =  new $class();
            
		    $fieldTable->load($field);
			$function = "viewHtml";
			if(method_exists($fieldTable,'exportView')){
			   	$function = "exportView";
			}
		    return $fieldTable->{$function}((array)$member);
		}
			
	}
	
	function addCsvRow($data=array()){
		global $csv_separator;
		//pr($data);
		$this->csvoutput .= '"'.implode('"'.$csv_separator.'"',$data).'"'."\n";
	}
	
	function addUsersdata($users=array()){
	   	//$users = $this->getUsers();
		
		if (count($users) > 0) {
			foreach($users as $user){
				//pr($user);
				$tUser = new TableDuser();
				//unset($tUser->TableEvent->location_id);
				$tUser->load($user->userId);
				
				$data = array();
				
				if (count($this->header) > 0) {
					foreach($this->header as $field => $value){
						
						$data[$field] = "";
						if(isset($this->field_settings[$field]) && in_array('general',$this->field_settings[$field])){
						   $data[$field] = 	$this->getUserColumndata($tUser,$field);
						}elseif( isset($this->field_settings[$field]) && in_array('individual',$this->field_settings[$field])){
						   $data[$field] =   $this->getUserColumndata($tUser,$field);
						}elseif($field == 'register_date'){
							 $data[$field] = $tUser->register_date;
						}elseif($field == 'eventname'){
							$data[$field] = $tUser->TableEvent->title;
						}else{
						   	$data[$field] = "";
						}
						
					}
					// prd($data);
				}
				
				$this->addCsvRow($data);
				if($tUser->type=='G'){
						$this->addmembers($tUser);
				}
				unset($tUser);
			}
		}
	}
    function addmembers($user){
	  	
		if (count($user->members) > 0) {
			foreach($user->members as $member){
				
				$user->TableMember->load($member->groupMemberId);
				$data = array();
				if (count($this->header) > 0) {
					foreach($this->header as $field => $value){
						$data[$field] = "";
						if(isset($this->field_settings[$field]) && in_array('general',$this->field_settings[$field])){
						   $data[$field] = $this->getUserColumndata($user,$field);
						}elseif(isset($this->field_settings[$field]) && in_array('group',$this->field_settings[$field])){
						   $data[$field] = $this->getMemberColumndata($user->TableMember,$field);
						}else{
							 $data[$field] = "";
						}
					}
				}
				$this->addCsvRow($data);
				
			}
		}
		
	}
	function doexport($from=null,$to=null,$page=0){
		global $csv_separator;
		
		$this->csvoutput = "";
		$this->field_settings = array();
		$this->getgeneralHeader();
		$this->mergeCustomFieldHeader();
		//if($page == 0){
			$this->makeheader();	
		//}
		
		$users = $this->getUsers($from, $to,$page);
		$this->addUsersdata($users);
		
		$this->writeTofile($page);
		
	}
	
	function writeTofile($page){
		
		if(!isset($_REQUEST['file']) || $_REQUEST['file']=='' ){
			
			$confObject = JFactory::getApplication();
            $tmpPath = $confObject->getCfg('tmp_path');
			//$this->filename = tempnam(sys_get_temp_dir(),null);
			$this->filename = tempnam($tmpPath ,null);
			
		}else{
			$this->filename = $_REQUEST['file'];
		}
		file_put_contents($this->filename, trim($this->csvoutput)."\n",FILE_APPEND);
		ob_clean();
		echo json_encode(array('total'=>$this->totalcount,
							   'file'=>$this->filename,
							   'limit'=> DtregisterModelExport::$limit,
							   'page'=>$page,
							   'csv'=>@file_get_contents($this->filename),
							   'current'=>$this->csvoutput)
						 );
		die;
		prd($this->filename);
	}
	
	function output(){
		ob_clean();
	   if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT'])) {

			$UserBrowser = "Opera";

		}

		elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT'])) {

			$UserBrowser = "IE";

		} else {

			$UserBrowser = '';	
		}
		$mime_type = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';

		$filename = "BackupList_Registrations";
		
		header('Content-Type: ' . $mime_type);

		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');

			if ($UserBrowser == 'IE') {

			    header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

			 	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

			 	header('Pragma: public');

			}

			else {

				header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

				header('Pragma: no-cache');

			}
           echo @file_get_contents($this->filename);
		   unlink($this->filename);
			//echo $this->csvoutput;

			exit();	
	}
}

?>
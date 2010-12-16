<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelMember extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table = new TableMember($this->getDBO());

	 }

}

class TableMember extends DtrTable {

    var $groupMemberId;

	var $groupUserId;

     function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

	    $this->displayField = 'title';

		$this->db =&$db;

	    //$this->TableUser =& DtrTable::getInstance('Duser','Table');

		$this->TableMemberfield =& DtrTable::getInstance('Memberfield','Table');

		$this->Tablefield =& DtrTable::getInstance('field','Table');

		parent::__construct( '#__dtregister_group_member', 'groupMemberId', $db );

   }

   function getObjData(){

	   $data = parent::getObjData();

	   unset($data->TableMemberfield);

	   unset($data->Tablefield);

	   return $data;

	}

   function load($id){

	   parent::load($id);

	   $this->fields = $this->TableMemberfield->findByMemberId($this->groupMemberId);

   }

   function delete($id,$tUser){

	   $tUser->memtot-- ;

	   $query = "update ". $tUser->getTableName()." set memtot= ".$tUser->memtot." where userId = ".$tUser->userId ;

	   $tUser->_db->setQuery($query);

	   $tUser->_db->query();

	   $fee = $tUser->calculateFee();

	   $fee->paid_amount = $tUser->TableFee->paid_amount;

	   $tUser->TableFee->save((array)$fee);

	   parent::delete($id);

   }

   function save($member){

	   global $now;

	   if(!isset($member['groupUserId'])){

	      $member['groupUserId'] = $this->groupUserId;

	   }

	   if(!isset($member['groupMemberId']) && $this->groupMemberId == ""){

		     $member['created'] = $now->toMySQL(true);

	   }

	   parent::save($member);

	   $this->TableMemberfield->member_id = $this->groupMemberId;

	   $this->TableMemberfield->removeBymember($this->groupMemberId);

	   $this->TableMemberfield->saveAll(array_filter($member['fields']));

   }

   function findByUserId($user_id=0){

	  $members = $this->find(" groupUserId = $user_id  ");

	  $membersdata = array();

	  $temp =  array();

	  if (is_array($members)) 
	  foreach($members as $member){

		  //$member =  (array)$member;

		  $member->fields = $this->TableMemberfield->findByMemberId($member->groupMemberId);
  
		  if (is_array($member->fields)) 
		  foreach($member->fields as $field_id => $value){

			  $this->Tablefield->load($field_id);

			  $member->{$this->Tablefield->name} = $value;	    

		  }

		  $temp[$member->groupMemberId] = $member;

	  }

	  return $temp;

   }

   function contact_custom_fields($member=null){

	    if($member==null){

			$member = $this;

	    }

	    $defaultfields =  array('firstname','lastname','zip','city','state','phone','email');

		$contactCustomFields = '';

		if (is_array($member->fields)) 
		foreach($member->fields as $field_id => $dfield){

			 if(is_array($dfield)){

				 $dfield = implode(',',$dfield);

			 }

		     $fld = $this->TableMemberfield->Tablefield->find(' id = '.$field_id);

		   	 $fld = $fld[0];

			 if(!in_array($fld->name,$defaultfields)){

				 $contactCustomFields .= $fld->label.': '.$dfield.'<br />';

			 }

		}

		return $contactCustomFields;

	}

  function removeByuser($id){

	   $members = $this->findByUserId($id);
	   
	   if (is_array($members)) 
	   foreach($members as $member){
		     
			 $this->TableMemberfield->removeBymember($member->groupMemberId);
	   }
	     $query = "delete from ".$this->getTableName()." where groupUserId = ".$this->db->Quote($id)." ";

	   $this->db->setQuery($query);

	   $this->db->query();

  }
  function removeByUserId($id){
	  $this->removeByuser($id);  
  }
  function compare($member){
	   
	   $field = $this->TableMemberfield->TableField;
	    
		if (is_array($member->fields)) 
		foreach($member->fields as $field_id => $value){
		    $field->load($field_id);
			if($field->applychangefee){
				if($value != $this->fields[$field_id]){
				   	return false;
				}
			}
	   }
	   return true;
  }
}

class TableMemberfield extends DtrTable {
	
    var $id;

	var $field_id;

	var $member_id;

	var $value;

     function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_member_field_values', 'id', $db );

		$this->Tablefield  =& DtrTable::getInstance('Field','Table');

		$this->TableField  =& $this->Tablefield;

  }

  function removeBymember($member_id){

	  $query = "delete from ".$this->getTableName()." where member_id = ".$this->db->Quote(($this->member_id)?$this->member_id:$member_id)." ";

	   $this->db->setQuery($query);

	   $this->db->query();

  }

   function saveAll($data=array()){

	  $temp = array();

	  if (is_array($data)) 
	  foreach($data as $key => $value){

		if(is_array($value)){

		   $value = implode("|",$value);

	    }

		$temp[] =  array('member_id'=>$this->member_id,'field_id'=>$key,'value'=>$value);

	  }

	  parent::saveAll($temp);

  }

   function saveAll_migration($data){
	  parent::saveAll($data);
  }

   function findByMemberId($member_id=0){

	$data = $this->find(" member_id = $member_id  ");  

	$temp = array();

	if (is_array($data)) 
	foreach($data as $field){

		$temp[$field->field_id] = $field->value;

    } 

	return $temp;

  }

}

?>
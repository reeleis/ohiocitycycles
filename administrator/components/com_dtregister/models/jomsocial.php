<?php

/**
* @version 2.7.6
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 class JomsocialFields extends DtrTable {

  var $id=null;

  var $fieldcode=null;

  var $published = null;
  
  var $ordering = 0;
  
  var $name = 0;

  function __construct( &$db ) {

    $this->db = $db;

    parent::__construct( '#__community_fields', 'id', $db );

  }
}
class JomUser extends DtrTable {

  var $userid=null;

  var $avatar =null;

  var $status = null;

  function __construct( &$db ) {

    $this->db = $db;

    parent::__construct( '#__community_users', 'userid', $db );
	
	$this->JOMField = new JomsocialFields($db);
	
	$this->fields = $this->JOMField->find(" published=1 and type <> 'group' ");
	
	$temp = array();
	
	if (is_array($this->fields))
	foreach($this->fields as $field){
		$temp[$field->id] = $field;
		
	 }
	 $this->fields = $temp;

  }
  
  function load($id){
	  
	 parent::load($id);
	 
	 $query = "select * from #__community_fields_values where user_id = $id ";
	 $data = $this->query($query);
	
	 if (is_array($data)) 
	 foreach($data as $row){
		 if(isset($this->fields[$row->field_id]))
	   	 $field = $this->fields[$row->field_id];
		 
		 if(isset($field->fieldcode) && isset($row->value) && $row->value != "")
		   $this->{$field->fieldcode} = $row->value;
     }
 
  }

}
 class DtregisterModelJomsocial extends DtrModel{
     
	 var $_data;
	 var $_fields;
     
	  function __construct($config = array()){
	  
       parent::__construct($config);
	   if($this->jomsocialInstall()){
		    $this->table =  new JomsocialFields($this->getDBO());
	   
	        $this->User = new JomUser($this->getDBO());
		}

	 }
	 
	 function load($id=0,$juser){
	    
		$this->User->load($id);
		
		//$this->User->avatar ="images/comprofiler/".$this->User->avatar ;
		$juser->load($id);

		$return = array();
		
		if (is_array($this->User->fields)) 
		foreach($this->User->fields as $field){
		   	
			if(isset($this->User->{$field->fieldcode}))
			   $return[$field->id] = $this->User->{$field->fieldcode};	
					
		}
	
		return $return;
 
     }
	 function jomsocialInstall(){
	    
		$tables = $this->_db->getTableList();
		$table_name = $this->_db->getPrefix()."community_fields";
	
		return (bool)(in_array($table_name,$tables));
			
	 }
	 
	 function getFields(){
	 
		if(!$this->jomsocialInstall()){
		   return array();
		}
	  $query = "Select * from #__community_fields where published=1 and type <> 'group' order by ordering ";
		
		$this->_db->setQuery($query);
		return $this->_db->loadObjectList();
	 }
	 
	 function getFieldsOption(){
	  $fields = $this->getFields();
		$list = array();
		$list[]=JHTML::_('select.option',"", "Select Field");
		
		if (is_array($fields)) 
		foreach($fields as $field){
		   
		   $list[]=JHTML::_('select.option',$field->id, $field->name);
		   
		}
		
		return $list;
	 }

 }
?>
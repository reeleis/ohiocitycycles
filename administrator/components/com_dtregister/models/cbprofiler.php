<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/


class DTCBFields extends DtrTable {

  var $id=null;

  var $fieldcode=null;

  var $published = null;
  
  var $ordering = 0;
  
  var $name = 0;

  function __construct( &$db ) {

    $this->db = $db;

    parent::__construct( '#__comprofiler_fields', 'fieldid', $db );

  }
}

 class DtCbUser extends DtrTable {

  var $id=null;

  var $fieldcode=null;

  var $published = null;
  
  var $ordering = 0;
  
  var $name = 0;

  function __construct( &$db ) {

    $this->db = $db;

    parent::__construct( '#__comprofiler', 'id', $db );
	
	$this->CBField = new DTCBFields($db);
	
	$this->fields = $this->CBField->find();
	
	if (count($this->fields) > 0) {
		foreach($this->fields as $field){
				
			$this->{$field->name} =  null;
	
		}
	}

  }

}

 class DtregisterModelCbprofiler extends DtrModel{
     
	 var $_data;
	 var $_fields;
     
	 function __construct($config = array()){
	  
       parent::__construct($config);
	   	$this->notfields =  array('forumorder',
		                 'onlinestatus',
						 'lastvisitDate',
						 'registerDate',
						  'avatar',
						  'middlename',
						  'lastupdatedate',
						  'hits',
						  'password',
						  'params',
						  'connections',
						  'forumrank',
						  'forumkarma',
						  'forumsignature',
						  'forumview',
						  'forumorder',
						  'forumposts',
						  'username'
		                 );
		
	   if($this->isInstall()){
		   $this->table =  new DTCBFields($this->getDBO());
	   
	       $this->User = new DtCbUser($this->getDBO());
		}
	  
	 }
	 
	 function load($id=0,$juser){
	    if(!isset($this->User)){
			return false;
	    }
		$this->User->load($id);
		$this->User->avatar ="images/comprofiler/".$this->User->avatar ;
		$juser->load($id);
		
		$return = array();
		
		if (count($this->User->fields) > 0) {
			foreach($this->User->fields as $field){
				if($field->table == "#__users"){
					if(isset($juser->{$field->name}))
					   $return[$field->fieldid] = $juser->{$field->name};
				} else {
					if(isset($this->User->{$field->name}))
					   $return[$field->fieldid] = $this->User->{$field->name};	
				} 
			}
		}
			
		return $return;
 
     }
	 
	 function isInstall(){
		
		$tables = $this->_db->getTableList();
		$table_name = $this->_db->getPrefix()."comprofiler_fields";
		
		return (bool)(in_array($table_name,$tables));
			
	 }
	 
	 function getFields(){
	 
		if(!$this->isInstall()){
		   return array();
		}
	 // $query = "Select * from #__community_fields where published=1 and type <> 'group' order by ordering " ;
		
		//$this->_db->setQuery($query);
		//return $this->_db->loadObjectList();
	
		return $this->table->find( );
	 }
	 
	 function getFieldsOption(){
	  $fields = $this->getFields();
	  
		$list = array();
		$list[]=JHTML::_('select.option',"", "Select Field");
		
		if (count($fields) > 0) {
			foreach($fields as $field){
			   
			   $list[]=JHTML::_('select.option',$field->fieldid, $field->name);
			   
			}
		}
		
		return $list;
	 }

 }
?>
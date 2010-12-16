<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelDtregister extends DtrModel {
   
     public $version = "2.7.0";

	 public $migrated = false;
	 
     function __construct($config = array()){
	  
       parent::__construct($config);
	   $this->migrated  = 0;
	   $this->table = new TableDtregister($this->getDBO());
	   $data = $this->table->find(' property = "migrate"');
		if($data){
		   $data = $data[0];
		   $this->migrated = $data->value;
		}
	  	  
	 }

	 function setmigrated($value = 1){
	   	
		$data = $this->table->find(' property = "migrate"');
		if($data){
		   $data = $data[0];
		   $this->table->load($data->id);	
		   $this->table->value = $value;
		   
		   $this->table->store();
		}
		  
	 }
   
}

class TableDtregister extends DtrTable {
   
    var $property;
	
	var $value;
    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();
	
		$this->db =&$db;
	
		parent::__construct( '#__dtregister', 'id', $db );	

  }
   	
}
?>
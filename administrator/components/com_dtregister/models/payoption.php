<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPayoption extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table =  new TablePayoption($this->getDBO()) ;

  }

}

class TablePayoption extends DtrTable {

   var $id;

   var $name;

   var $default = 0;

    function __construct( &$db = null ) {

	  $db = &JFactory::getDBO();

	  $this->db = $db;

	  parent::__construct( '#__dtregister_payment', 'id', $db );

      $this->TablePayoptionconfig  =& DtrTable::getInstance('Payoptionconfig','Table');

	  $this->TablePaylater  =& DtrTable::getInstance('paylater','Table');

   }	

   function save($data){

	  parent::save($data['payment']);

	  $this->TablePayoptionconfig->payment_id = $this->id;

	  $this->getPaylaterIds($data);

	  $this->TablePayoptionconfig->removeByPaymentid();

	  $this->TablePayoptionconfig->saveAll($data['config']);

   }

   function getPaylaterIds(&$data){

	   $this->TablePaylater->truncate();

	   $paylaters = array();
		
	   if (is_array($data['paylater'])) 
	   foreach($data['paylater'] as $key=>$name){

		 if($data['paylaterIds'][$key] != 'new'){

		    $paylater =  array('name'=>$name,'id'=>$data['paylaterIds'][$key]);

		 }else{

		    $paylater =  array('name'=>$name);

		 }

		 $this->TablePaylater->save($paylater);

		 if($data['paylaterIds'][$key] == 'new'){

			 $data['paylaterIds'][$key] = $this->TablePaylater->_db->insertid();

			 if(isset($data['config']['pay_later_options'][$key]))

			   $data['config']['pay_later_options'][$key] = $this->TablePaylater->_db->insertid();

		 }

	   }

   }

   function load($id){

	     parent::load($id);

	     $this->config = $this->getConfig();

   }

   function getConfig(){

     $temp = array();

	 $data = $this->TablePayoptionconfig->find(' payment_id = "'.$this->id.'"');

	 $config_array = array(

	                             'paymentmethod',

								 'cardtype',

								 'pay_later_options',

								 'cardtype'

	                           );
							   
	 if (is_array($data)) 
	 foreach($data as $val){

	   if(in_array($val->key,$config_array) && !is_array($val->value)){

	      $val->value = explode(",",$val->value);

	   }

	   $temp[$val->key] = $val->value;

	 }

	 return $temp;

  }

}

class TablePayoptionconfig extends DtrTable{

   var $payment_id; 

   var $key;

   var $value;

   var $id;

   function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_payment_config', 'id', $db );

  }

  function removeByPaymentid(){

	 $query = "delete from ".$this->getTableName()." where payment_id = ".$this->db->Quote($this->payment_id)." ";

	 $this->db->setQuery($query);

	 $this->db->query();

  }

  function saveAll($data){

	 $config_data = array();

	  if (is_array($data)) 
	  foreach($data as $key=>&$value){

		  if(is_array($value)){

		     $value = implode(",",$value);

		  }

		 $config_data[] =  array('key'=>$key,'value'=>$value);

     }

	 pr($config_data);

	 parent::saveAll($config_data);

  }

}
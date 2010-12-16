<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelFee extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table =  new TableFee($this->getDBO());

	 }

}

class TableFee extends DtrTable {

    var $id;

    var $basefee;

	var $memberdiscount;

	var $latefee;

	var $birddiscount;

	var $discountcodefee;

	var $customfee = 0;

	var $tax;

	var $fee;

	var $paid_amount;

	var $user_id;

	var $cancelfee;

	var $changefee;
	
	var $status = 0;
	
	var $payment_method = "";

   function __construct( &$db = null ) {

		parent::__construct( '#__dtregister_fee', 'id', $db );

		$this->statustxt =  array(0=>JText::_('DT_NOT_PAID'),1=>JText::_('DT_PAID'));

   }

   function formatamount($amount){

	  return $amount;   

   }

   function findByUserId($user_id=0){

	   $data = $this->find(' user_id='.$user_id);
       if(!isset($data[0])){
		  return false;   
	   }
	   $data = $data[0];

	   $fee =  new stdClass;

	   if($data)

	   foreach($data as $key => $field){

		   $this->$key = $field;

		   $fee->$key = $field;

	   }

	   return $fee;

   }
     function removeByuser($id){

	   $query = "delete from ".$this->getTableName()." where user_id = ".$this->_db->Quote($id)." ";

	   $this->_db->setQuery($query);

	   $this->_db->query();
      
  }
  function removeByUserId($id){
	  
	  $this->removeByuser($id);  
  }
  
  function save($data){
  		
		if(isset($data['user_id'])){
		  $feerow = $this->findByUserId($data['user_id']);
		  if($feerow){
			$data['id'] = $feerow->id ;
		  }
		}
		
		parent::save($data);
		
  }

}

?>
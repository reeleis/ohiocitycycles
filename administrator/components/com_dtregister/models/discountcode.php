<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelDiscountcode extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->discountcode =  new TableDiscountcode($this->getDBO());

	   $this->table = $this->discountcode;

	 }

}

class TableDiscountcode extends DtrTable {

    var $id;

	var $name;

	var $label;

	var $publish;

	var $discount_type;

	var $start;

	var $end;

	var $amount;

	var $code;

	var $events_enable;

    var $limit;

	var $fields = array('name','publish','discount_type','start','end','amount','code','limit','events_enable');

  function __construct( &$db = null ) {

    $db = &JFactory::getDBO();

    $this->db = $db;

    parent::__construct( '#__dtregister_codes', 'id', $db );

  }

  function set($data=array()){


		if (count($data) > 0) {
			foreach($data as $key=>$value){
				if(in_array($key,$this->fields)){
					$this->$key = $value;
				}
			}
  		}

	}

	function save(){

	   parent::save();

	}

	 function enableAllEvents(){

	   $query = " SELECT DISTINCT e.eventId

					FROM #__dtregister_group_event as e

					LEFT JOIN #__dtregister_events_codes as d ON e.slabId = d.event_id

					AND d.discount_code_id = ".$this->id."

					WHERE e.publish =1

					AND d.event_id IS NULL ";

	   $this->db->setQuery($query);		

	   $data = $this->db->loadRowList();

	   if (count($data) > 0) {
		   foreach($data as $evtid){
			  $value = $evtid[0];
			  $query = "insert #__dtregister_events_codes set event_id =".$value.", discount_code_id =".$this->id;
			  $this->db->setQuery($query);		
			  $this->db->query();		
		   }
	   }

	}

	function  get(){

		return $this;

	}

	function getcodes($condition=null){

		$query = "select * from #__dtregister_codes";

		if(isset($condition)){

			$query .= " where ".$condition;	

		}

		$this->db->setQuery($query);

		 return $this->db->loadObjectList();

	}

    function check_space($name){

		if(preg_match("/[ ]/", $name)){

			$this->error = "Spaces are not allowed in the field name. Your space has been replaced by a _ character";

			return false;

		}

		return true;

	}

	function validate_name($name){

		if($name==""){

			$this->error = "Name is required";

			return false;

		}

		if(preg_match("/[^a-zA-Z0-9_]/", $name)){

			$this->error = "Field name only allow characters a-z,A-Z,0-9 and '_' character";

			return false;

		}

		return true;	

	}

	function validate_code($code){

		$query = "select * from #__dtregister_codes";

			$query .= " where code='".$code."'";	

		if(isset($this->id)){

			$query .= " and id <> ".$this->id;

		}

		$this->db->setQuery($query);

		$this->db->query();

		return ($this->db->getNumRows() == 0 );

	}

	function get_discount_amount($amount){

		if($this->discount_type==1){

			if($this->amount < $amount){

				return $this->amount;

			}else{

				return $amount;

			}

		}else{

			$percentage = $this->amount/100;

			return ($amount*$percentage);

		}

	}

	function usedold(){

	   $query = "select sum(1) from 

	   #__dtregister_user a 

	   inner join #__jevents_vevdetail d  on a.eventId=d.evdet_id 

	   inner join  #__dtregister_group b on  a.userId= b.useid 

       inner join #__dtregister_group_event evt  on evt.eventId = d.evdet_id 

 where a.cancel <> 1 and a.discount_code_id=".$this->id." group by discount_code_id ";

	   $this->db->setQuery($query);

      // echo "<br />". $this->db->getQuery();

	 //  echo "<br />";

	   $this->uses = $this->db->loadResult();

	   return $this->uses;

	}

	function used(){

	   $query = "select sum(1) from #__dtregister_user where status <> -1 and discount_code_id=".$this->id." group by discount_code_id ";

	   $this->db->setQuery($query);

	   $this->uses = $this->db->loadResult();

	   return $this->uses;

	}

	function is_expired($date=''){

	     global $now;

		 if($date==""){

		    $date = $now;

		 }

		  $query = "SELECT *

						FROM #__dtregister_codes AS dc

						WHERE (

						dc.id = '".$this->id."'

						AND dc.publish =1

						)

						AND (

							  (

								'".$date->toFormat()."'

								BETWEEN dc.start

								AND dc.end

								AND dc.start <> '0000-00-00 00:00:00'

								AND dc.end <> '0000-00-00 00:00:00'

							  )

							  OR (

								 dc.start = '0000-00-00 00:00:00'

								 and dc.end <> '0000-00-00 00:00:00'

								 and dc.end > '".$date->toFormat()."'

								)

							  Or(

								 dc.start <> '0000-00-00 00:00:00'

								 and dc.end = '0000-00-00 00:00:00'

								 and dc.start < '".$date->toFormat()."'

								)

							  or (

								  dc.start = '0000-00-00 00:00:00'

								   and dc.end = '0000-00-00 00:00:00'

								 )						

						 )" ;

		   $this->db->setQuery($query);

		   $this->db->query();

           if($this->db->getNumRows() > 0){

				return $this->id;

			 }else{

			    $this->error = JText::_( 'DT_CODE_EXPIRED' );

			    return false;

			 }

	}

}
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelFeeorder extends DtrModel {
   
   function __construct($config = array()){
	  
       parent::__construct($config);
	   
	   $this->table =  new TableFeeorder($this->getDBO());
	  
	 }
   
}
class TableFeeorder  extends DtrTable {
	
  var $id;
  var $eventId;
  var $reference_id;
  var $type;
  var $title;
  var $ordering;
  
  function __construct( &$db = null ) {

		$db = &JFactory::getDBO();
	    $this->displayField = 'title';
		$this->db =&$db ;
		$this->TableDiscountcode  =& DtrTable::getInstance('Discountcode','Table');
		$this->TableField  =& DtrTable::getInstance('Field','Table');
		/*
 base fee, late fee, early bird discount, member discount, tax, custom field fees/discounts, discount codes , change fee and cancel fee 
*/

	    $this->feeElements =  array(
         
				   'basefee'=>array('title'=>JText::_('DT_BASE_FEE'),'type'=>'basefee'),
				   'latefee'=>array('title'=>JText::_('DT_LATE_FEE'),'type'=>'latefee'),
				   'birddiscount'=>array('title'=>JText::_('DT_BIRD_DISCOUNT'),'type'=>'birddiscount'),
				   'memberdiscount'=>array('title'=>JText::_('DT_MEMBER_DISCOUNT'),'type'=>'memberdiscount'),
				   'tax'=>array('title'=>JText::_('DT_TAX_AMOUNT'),'type'=>'tax'),
				   'changefee'=>array('title'=>JText::_('DT_CHANGE_FEE'),'type'=>'changefee'),
				   'cancelfee'=>array('title'=>JText::_('DT_CANCEL_FEE'),'type'=>'cancelfee')
				 
			   );
		parent::__construct( '#__dtregister_feeorder', 'id', $db );

  }
  
  function getbasicTypes(){
	  // pr($this->feeElements);
	  $basic_feeorder_types = $this->find(' eventId = "'.$this->eventId.'" and type in("'.implode('" , "',array_keys($this->feeElements)).'")  ');
	   
	  return $basic_feeorder_types; 
	    
  }
  
  function savebasictypes(){
	  
      $basic_feeorder_types = $this->getbasicTypes();
	  
	  $feeorders =  array();
	  $existing_feeorders =  array();
	  $ordering = $this->getNextOrder("eventId = '".$this->eventId."' ");
	  
	  if (count($basic_feeorder_types) > 0) {
		  foreach($basic_feeorder_types as $feeorder){
			   $existing_feeorders[] = $feeorder->type;
		  }
	  }
	  
	  if (count($this->feeElements) > 0) {
		  foreach($this->feeElements as $key => $feeorder){
			  if(!in_array($key,$existing_feeorders)){
				 $feeorder['ordering'] = $ordering;
				 $feeorders[] = $feeorder;
				 $ordering++;
			  }
		  }
	  }
	  if(count($feeorders) > 0)
	    $this->saveAll($feeorders);
     
  }
  
  function getFields(){
	 
	 $data  = $this->find(' eventId = '.$this->eventId.' and type= "field" ');
	
	 return $data;
  }
  
  function getDiscountcodes(){
	 
	 $data  = $this->find(' eventId = '.$this->eventId.' and type= "discountcode" ');
	 
	 return $data;
  }
    
  function save($data){
	  $temp = $this->feeElements;
	  unset($this->feeElements);
	  parent::save($data);
	  $this->feeElements = $temp;
  }
  
  function store(){
	    if(isset($this->feeElements)){
		  $temp = $this->feeElements;
		  unset($this->feeElements);
		}
	    
	    parent::store();
		if(isset($temp)){
		  $this->feeElements = $temp;
		}
  }
  
  function removeByeventId($eventId=0){
		
	   	$query = "delete from ".$this->getTableName()." where eventId = ".$this->db->Quote($eventId)." ";
		$this->db->setQuery($query);
	    $this->db->query();
 }

}
?>
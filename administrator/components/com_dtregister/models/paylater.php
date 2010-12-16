<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPaylater extends DtrModel {

  var $options = array();

  function __construct($config=array()){
      
      
	    $this->options = array( 'at_door' => JText::_( 'DT_PAY_AT_DOOR' ),
							 'mail' => JText::_( 'DT_MAILIN_PAYMENT' ),
							 'phone' => JText::_( 'DT_CALLIN_PAYMENT' )
								);
		$this->methods =  array_keys($this->options);
		$this->table =  new TablePaylater($this->getDBO());
		$this->options = $this->table->optionslist();
		parent::__construct($config);
	  
  }

  function filter($val){
	  global $pay_later_options;
     if($pay_later_options ==""){
	 	$pay_later_options = array();
	 }
	 return(in_array($val,$pay_later_options));
  }
  
  function getOptions(){
	  global $pay_later_options;
     
	 return   array_flip(array_filter(array_flip($this->options),array($this,'filter')));
	 
     
  }
  
  function getMethodkeys(){
	    return array_keys($this->options);
  }
  
  function getMethods(){
	  
	  return $this->methods;
  }

}
class TablePaylater extends DtrTable {
   var $id;
   var $name;
   
    function __construct( &$db = null ) {

	  $db = &JFactory::getDBO();
  
	  $this->db = $db;
  
	  parent::__construct( '#__dtregister_paylater', 'id', $db );
      
   }
   
   function save($data){
	   if(!isset($data['id'])){
		    $data['id'] = ' null ';
	   }
	   $name = $this->_db->Quote($data['name']) ;
	   $sql="Insert Into #__dtregister_paylater(id,name) Values(".$data['id'].",".$name.")";
	   $this->_db->setQuery($sql);
	   $this->_db->query($sql);
	   pr($this->_db->getErrorMsg());

   }
}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelLocation extends DtrModel {

   function __construct($config = array()){
	  
       parent::__construct($config);
	   
	   $this->location =  new TableLocation($this->getDBO());
	   $this->table =  $this->location;
	  
	 }
   
}

class TableLocation extends DtrTable {

  var $id =null;

  var $name=null;

  var $address=null;

  var $address2=null;

  var $country=null;

  var $phone=null;

  var $email=null;

  var $website=null;

  var $city=null;

  var $state=null;

  var $zip=null; 

  var $image=null;

  var $showimage=null;

  function __construct( &$db = null ) {

    $db = &JFactory::getDBO();

    $this->db = $db;

    parent::__construct( '#__dtregister_locations', 'id', $db );

  }

}
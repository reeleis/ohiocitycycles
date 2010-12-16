<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelSection extends DtrModel {

   function __construct($config = array()){
	  
       parent::__construct($config);
	   
	   $this->table =  new TableSection($this->getDBO());

	 }
   
}

class TableSection extends DtrTable {

  function __construct( &$db = null ) {

    $db = &JFactory::getDBO();

    $this->db = $db;
    $this->displayField = 'title';
    parent::__construct( '#__sections', 'id', $db );

  }

}
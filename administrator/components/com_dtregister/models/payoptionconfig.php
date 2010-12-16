<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPayoptionconfig extends DtrModel {

   function __construct($config = array()){
	  
       parent::__construct($config);
	   
	   $this->table =  new TableDuser($this->getDBO());

	 }
   
}
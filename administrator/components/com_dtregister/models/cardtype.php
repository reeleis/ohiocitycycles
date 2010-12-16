<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelCardtype extends DtrModel {

	var $types = array();

  function __construct($config=array()){

	  $this ->types = array( "Visa" => JText::_( 'DT_VISA' ),
								"MasterCard"=>JText::_( 'DT_MASTERCARD' ),
								"Discover"=>JText::_( 'DT_DISCOVER' ),
								
								"AmericanExpress"=>JText::_( 'DT_AMERICANEXPRESS' )
								
								);
		
		parent::__construct($config);
	  
  }

  function gettypes(){
	  
     
	 return $this->types;
     
  }

}

?>
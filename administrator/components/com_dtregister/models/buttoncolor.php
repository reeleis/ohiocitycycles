<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelButtoncolor extends DtrModel {

	var $colors = array();

  function __construct($config=array()){

	  $this ->colors = array( "green" => JText::_( 'DT_GREEN' ),
								"black"=>JText::_( 'DT_BLACK' ),
								"blue"=>JText::_( 'DT_BLUE' ),
								"brown"=>JText::_( 'DT_BROWN' ),
								"orange"=>JText::_( 'DT_ORANGE' ),
								"purple"=>JText::_( 'DT_PURPLE' ),
								"red" => JText::_( 'DT_RED' ),
								"yellow"=>JText::_( 'DT_YELLOW' )
								);
		parent::__construct($config);
	  
  }

  function getColors(){

	 return $this->colors;
     
  }

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelFieldtype extends DtrModel 
{
   
	var $types=array(
								'0'=>'Text',
								'1'=>'Dropdown',
								'2'=>'Textarea',
								'3'=>'Checkbox',
								'4'=>'Radio',
								'5'=>'Date',
								'6'=>'Textual',
								'7'=>'Upload',
								'8'=>'Email'			
							);

  function getTypes(){
   
	 return $this->types;
     
  }

}

?>
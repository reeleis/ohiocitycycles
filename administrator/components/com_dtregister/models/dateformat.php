<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelDateformat extends DtrModel 
{
 							 //%b %e , %Y |  %e %b %Y | %m/%d/%Y | %d/%m/%Y | %Y/%m/%d |%m.%d.%Y | %d.%m.%Y | %Y.%m.%d

	var $formats=array(
								'%b %d, %Y'=>'Mar 5, 2009',
								'%d %b %Y'=>'5 Mar 2009',
								'%A, %d %b %Y'=>'Monday, 5 Mar 2009',
								'%m-%d-%Y'=>'mm-dd-yyyy',
								'%d-%m-%Y'=>'dd-mm-yyyy',
								'%Y-%m-%d'=>'yyyy-mm-dd',
								'%m.%d.%Y'=>'mm.dd.yyyy',
								'%d.%m.%Y'=>'dd.mm.yyyy',
								'%Y.%m.%d'=>'yyyy.mm.dd',
								'%m/%d/%Y'=>'mm/dd/yyyy',
								'%d/%m/%Y'=>'dd/mm/yyyy',
								'%Y/%m/%d'=>'yyyy/mm/dd',

							);
							 
	var $fileformats = array(
	              '%m-%d-%Y'=> 'mm-dd-yyyy'
				 ,'%d-%m-%Y'=> 'dd-mm-yyyy'
				 ,'%Y-%m-%d'=> 'yyyy-mm-dd' 
				 ,'%m.%d.%Y'=> 'mm.dd.yyyy'
				 ,'%d.%m.%Y'=> 'dd.mm.yyyy'
				 ,'%Y.%m.%d'=> 'yyyy.mm.dd'
	            );

  function getformats(){

	 return $this->formats;
     
  }

  function getfieldformats(){
    
	return $this->fileformats;
  }
  
}

?>
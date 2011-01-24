<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

  defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
class DtrModel extends JModel {
     
    function __construct($config = array()){
	  
       parent::__construct($config);
	 }
	 function find($condition = " 1=1 ",$ordering="",$limitstart=0,$limit=0){
		 if($condition==""){
		   $condition =  " 1=1 ";
		 }
		return $this->table->find($condition,$ordering,$limitstart=0,$limit=0);
	
	  }
	  
	  function lastQueryCount(){
	    $this->getDBO();
		$this->getDBO()->setQuery('SELECT FOUND_ROWS();');
		return $this->getDBO()->loadResult();
		
	  }
      
	  function getGlobal($key,$default=""){
	      $str = " global \$".$key.";";
	
		 eval($str);
		 if(!isset($$key)){
		    return $default;
		 }
	
		 return $$key;
		
	  }
	
}
?>
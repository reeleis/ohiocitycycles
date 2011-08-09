<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelCategory extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table =  new TableCategory($this->getDBO());

	 }

}
class TableCategory extends DtrTable{
   var $categoryId=null;

   var $categoryName=null;

   var $ordering = null;

   var $parent_id = 0 ;
   
   var $color = "";
   
   var $published = 0;
   
   var $access = 0;

   function __construct(&$db){

      $this->db = $db;

      parent::__construct( '#__dtregister_categories', 'categoryId', $db );

   }

   function hasChild(){

	$query = "Select count(*) from #__dtregister_categories where parent_id=".$this->categoryId;

	$this->db->setQuery($query);

	return ($this->db->loadResult()>0);

  }

  function orderByParent($rows= array()){

        if(!count($rows)){
           $user	=& JFactory::getUser();
		   $rows = $this->find('published = 1 and access <= '.$user->get('aid'),' ordering ');

		}
        $children =  array();
	    
		if (count($rows) > 0) {
			foreach ($rows as $v ) {
	
				$pt = $v->parent_id;
	
				$list = @$children[$pt] ? $children[$pt] : array();
	
				array_push( $list, $v );
	
				$children[$pt] = $list;
	
			}
		}

		return $children;

  }

  function save($data){
	 if(isset($data['categoryName'])){
		 $data['categoryName'] =  stripslashes($data['categoryName']);
	 }
	
     parent::save($data);	  
  }

  function optionslist(){

	   $rows = $this->find(NULL,' ordering ');

	   $children = $this->orderByParent($rows);

       $options=array();

		if(isset($children[0]) && is_array($children[0]))

		foreach($children[0] as $pcategory){

		   $options[$pcategory->categoryId]=$pcategory->categoryName;

		   if(isset($children[$pcategory->categoryId])){

		       foreach($children[$pcategory->categoryId] as $childcat){

			       $options[$childcat->categoryId]="--".$childcat->categoryName;

			   }

		   }

		}

		return $options;

  }
  
  
  function optionslist_filtered(){
	  
		$user	=& JFactory::getUser();
	   // $rows = $this->find(NULL,' ordering ');
	   $rows = $this->find('published = 1 and access <= '.$user->get('aid'),' ordering ');

	   $children = $this->orderByParent($rows);

       $options=array();

		if(isset($children[0]) && is_array($children[0]))

		foreach($children[0] as $pcategory){

		   $options[$pcategory->categoryId]=$pcategory->categoryName;

		   if(isset($children[$pcategory->categoryId])){

		       foreach($children[$pcategory->categoryId] as $childcat){

			       $options[$childcat->categoryId]="--".$childcat->categoryName;

			   }

		   }

		}

		return $options;

  }

}
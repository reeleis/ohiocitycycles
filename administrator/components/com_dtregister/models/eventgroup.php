<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelEventgroup extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table = new TableEventGroup($this->getDBO());

	   $this->tableJevt = new TableJevent($this->getDBO());

	 }

}

class TableEventgroup extends DtrTable {

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_group_event', 'slabId', $db );

  }

  function getall($condition , $ordering , $limitstart, $limit){

  }

}

class TableJevent extends DtrTable {

      function __construct( &$db = null ) {

			$db = &JFactory::getDBO();

			$this->db =&$db;

			parent::__construct( '#__jevents_vevdetail', 'evdet_id', $db );

	  }

	  function optionslist(){

		 $data = $this->find();

		 $list =  array();

		 if (count($data) > 0) {
			 foreach($data as $value){
				$list[$value->evdet_id] = $value->summary;
			 }
		 }

		 return $list;

	  }

}

?>
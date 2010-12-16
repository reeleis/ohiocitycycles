<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelAco extends DtrModel {

     function __construct($config = array()){

       parent::__construct($config);

	  $this->AcoGroup = array(
		          'DT_EDIT_OWN_EVENT'=>array(
				                         array(
										      'controller'=>'event',
											  'task'=>'edit',
											  'type'=>'sessionUser'
										   ),
										   array(
										      'controller'=>'event',
											  'task'=>'publish',
											  'type'=>'sessionUser'
										   ),
										   array(
										      'controller'=>'event',
											  'task'=>'unpublish',
											  'type'=>'sessionUser'
										   )
				                      ),
		          'DT_EVENT_CREATE'=> array(
				                       array(
									     'controller'=>'event',
									     'task'=>'add',
										 'type'=>'action'
									   )
									 ) ,
				  'DT_PUBLISH_EVENT'=>array(
				                          array(
											 'controller'=>'event',
											 'task'=>'publish',
											 'type'=>'action'
										   ),
										    array(
											 'controller'=>'event',
											 'task'=>'unpublish',
											 'type'=>'action'
										   )
				                       ),
				  'DT_DELETE_EVENT' => array(
				                         array(
									       'controller'=>'event',
									       'task'=>'delete',
										   'type'=>'action'
									    )
				                      ),
			       'DT_CREATE_CATEGORY' => array(
				                         array(
									       'controller'=>'category',
									       'task'=>'add',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EDIT_DELETE_CATEGORY' => array(
				                         array(
									       'controller'=>'category',
									       'task'=>'edit',
										   'type'=>'action'
									     ),
										  array(
									       'controller'=>'category',
									       'task'=>'delete',
										   'type'=>'action'
									     )
				                      ),
			       'DT_CREATE_FIELD' => array(
				                         array(
									       'controller'=>'field',
									       'task'=>'add',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EDIT_DELETE_FIELD' => array(
				                         array(
									       'controller'=>'field',
									       'task'=>'edit',
										   'type'=>'action'
									     ),
										  array(
									       'controller'=>'field',
									       'task'=>'delete',
										   'type'=>'action'
									     )
				                      ),
			       'DT_CREATE_DISCOUNTCODE' => array(
				                         array(
									       'controller'=>'discountcode',
									       'task'=>'add',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EDIT_DELETE_DISCOUNTCODE' => array(
				                         array(
									       'controller'=>'discountcode',
									       'task'=>'edit',
										   'type'=>'action'
									     ),
										  array(
									       'controller'=>'discountcode',
									       'task'=>'delete',
										   'type'=>'action'
									     )
				                      ),
			       'DT_CREATE_LOCATION' => array(
				                         array(
									       'controller'=>'location',
									       'task'=>'add',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EDIT_DELETE_LOCATION' => array(
				                         array(
									       'controller'=>'location',
									       'task'=>'edit',
										   'type'=>'action'
									     ),
										  array(
									       'controller'=>'location',
									       'task'=>'delete',
										   'type'=>'action'
									     )
				                      ),
			       'DT_CONFIG' => array(
				                         array(
									       'controller'=>'config',
									       'task'=>'index',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EMAIL_REGISTRANT' => array(
				                         array(
									       'controller'=>'registrantemail',
									       'task'=>'index',
										   'type'=>'action'
									     )
				                      ),
			       'DT_CREATE_PAYOPTION' => array(
				                         array(
									       'controller'=>'payoption',
									       'task'=>'add',
										   'type'=>'action'
									     )
				                      ),
			       'DT_EDIT_DELETE_PAYOPTION' => array(
				                         array(
									       'controller'=>'payoption',
									       'task'=>'edit',
										   'type'=>'action'
									     ),
										  array(
									       'controller'=>'payoption',
									       'task'=>'delete',
										   'type'=>'action'
									     )
				                      ),

		  );

	  /*
	  
- CSV Export // not created yet . 
- Create Payment Options // no controller for it
- Edit/Delete Payment Options // no controller for it .
- View Records  // lots of conflict with controller on frontend/backend
- Edit/Delete Records // lots of conflict with controller on frontend/backend
- Manual Registrations // lots of conflict with controller on frontend/backend
  
	  */

	   $this->table =  new TableAco($this->getDBO()) ; 

	 }

}

class TableAco extends DtrTable {

    var $id;
	var $type;
	var $alias;
	var $controller;
	var $task;

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_acos', 'id', $db );

  }
  
  function getAcoIdbyTypeControllerTask($type,$controller,$task,$alias){
	  
	  $data = $this->find('controller="'.$controller.'"  and task="'.$task.'" and alias="'.$alias.'" and type="'.$type.'" ');
	  if($data){
		 
		 return $data[0]->id;
		   
	  }else{
		  
		  $data = array(
		            'controller'=>$controller,
					'task'=>$task,
					'type'=>$type,
					'alias'=>$alias
				);
		  $this->save($data);
		  $id = $this->id;
		  $this->id = "";
		  return $id;
		  		    
	  }
	  
  }

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPermission extends DtrModel {

     function __construct($config = array()){

       parent::__construct($config);

	   $this->table =  new TablePermission($this->getDBO());

	 }

}

class TablePermission extends DtrTable {

	var $id;

	var $aco_id;

	var $aro_id;

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_permissions', 'id', $db );

		
        $this->ModelAco = DtrModel::getInstance('aco','DtregisterModel');

  }

  function getmatrix(){

	  $permissions = $this->find();  
	  
	  $query = "select p.aro_id , ac.alias from #__dtregister_permissions p inner join #__dtregister_acos ac on ac.id= p.aco_id group by p.aro_id,  ac.alias ";
      $this->_db->setQuery($query);
	  $permissions = $this->_db->loadObjectlist();
	  $matrix =  array();
     
	  if (is_array($permissions)) 
	  foreach($permissions as $permission){

		   $matrix[$permission->aro_id][$permission->alias] = 0;

	  }

	  return $matrix;

  }

  function update($data=array()){

	 $temp = array();
	 
	 if (is_array($data)) 
	 foreach($data as $grpRow){
	     
		 if (is_array($this->ModelAco->AcoGroup[$grpRow['group']])) 
		 foreach($this->ModelAco->AcoGroup[$grpRow['group']] as $aco){
		   
		   $acoId = $this->ModelAco->table->getAcoIdbyTypeControllerTask($aco['type'],$aco['controller'],$aco['task'],$grpRow['group']);
		  
		   $temp[] =  array('aro_id'=>$grpRow['aro_id'],'aco_id'=>$acoId);
		  	 
		 }
		 
	 }
	
	 $data = $temp;
    
	  $sql="TRUNCATE TABLE `#__dtregister_permissions` ";

	  $this->_db->setQuery($sql);

	  $this->_db->query();

	  $this->saveAll($data);

  }

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelAro extends DtrModel {

     function __construct($config = array()){

       parent::__construct($config);

	   $this->table = new TableAro($this->getDBO());

	 }

}

class TableAro extends DtrTable {

    var $id;
	var $type;
    var $aro_id;
	var $alias;

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

	    $this->db =&$db;
		include_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'user.php');

	    $this->TableJuser = & DtrTable::getInstance('Juser','Table');

		parent::__construct( '#__dtregister_aros', 'id', $db );

  }

  function save($data){
     
	 unset($this->AroGroup);
	  if(!isset($data['alias']) || $data['alias'] == ""){

		   $user = $this->TableJuser->find(' id = '.$data['aro_id']);

		   $user = $user[0];

		   $data['alias'] = $user->username;

	  }  

	  parent::save($data);

  }

  function findaroByUser($user){

	 $aro  =  $this->find(' aro_id ='.$user->id.' and type="joomlaUser"');

	 if($aro ){

		 return $aro[0];

	 }else{
        if($user->gid){
		   $con	= ' aro_id ='.$user->gid.' and type="joomlaAro"';
		}else{
		   $con	= ' aro_id = 29 and type="joomlaAro"';
		}
		 $aro  =  $this->find($con);

		 if($aro){

			 return $aro[0];

		 }else{

		     return false;	 

		 }

	 }

  }

  function delete($id=0){
	   
	   $this->query("delete from #__dtregister_permissions where aro_id=".$id);
	   
	   parent::delete($id);
	   
  }

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelFile extends DtrModel {

   function __construct($config = array()){

       parent::__construct($config);

	   $this->table = new TableFile($this->getDBO());

	 }

}

class TableFile extends DtrTable {

	var $id;

	var $path; 

	var $event_id;

     function __construct( &$db = null ) {

			$db = &JFactory::getDBO();

			$this->db =&$db;

			parent::__construct( '#__dtregister_files', 'id', $db );

	  }

	 function upload($file,$destfolder=null){

		jimport('joomla.filesystem.file');

		$filename = JFile::makeSafe($file['name']);

		$src = $file['tmp_name'];

        if($destfolder!=""){

		  $destfolder = $destfolder.DS;

		}

		$dest = JPATH_SITE . DS . "images" . DS ."dtregister".DS.$destfolder.$filename;

		if(JFile::exists($dest)){

			$this->re_name($filename,$destfolder);

			$dest = $this->path;

		}else{

			$this->path = $dest; 

		}

		return ( JFile::upload($src, $dest) );

	}

	 function re_name($filename,$destfolder=null){

	    static $number; 

		jimport('joomla.filesystem.file');

		$dest = JPATH_SITE . DS . "images" . DS ."dtregister".DS.$destfolder.$filename;

		if(JFile::exists($dest)){

			$ext =  JFile::getExt($filename);

			$name = JFile::stripExt($filename);

            $len = strlen($number);

            if($number>0){

			  $name = substr($name,0,"-".$len);

			}

			$number++ ;

			$name = $name.$number; 

			$this->re_name($name.".".$ext,$destfolder);

		}else{

		    $this->path = $dest;

		}

	}

	 function remove(){



		jimport('joomla.filesystem.file');

		$data = $this->find(' path = '.$this->db->Quote($this->path));

		if($data && $this->_db->getNumRows($this->_db->query()) ==1){

		   JFile::delete($this->path);

		}

		parent::delete();

	}
	
	function removeByevent_id($event_id=0){
		
	   	$query = "delete from ".$this->getTableName()." where event_id = ".$this->db->Quote($event_id)." ";
		$this->db->setQuery($query);

	    $this->db->query();
	}

}

?>
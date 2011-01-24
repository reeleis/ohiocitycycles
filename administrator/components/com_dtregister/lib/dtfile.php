<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DT_file{

	var $id;

	var $path; 

	function DT_file($id=null){

		$database = &JFactory::getDBO();

		$this->db = &$database;

		if($id!=""){

			$this->id = $id;

		}

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
			$number++;

			$name = $name.$number; 

			$this->re_name($name.".".$ext,$destfolder);

		}else{

		    $this->path = $dest;

		}

	}

	function remove(){

		jimport('joomla.filesystem.file');

		$sql = "select * from  #__dtregister_files where id=".$this->id;

		$this->db->setQuery($sql);

		$data = $this->db->loadObject();

		JFile::delete($data->path);

		$query = "delete from #__dtregister_files where id=".$this->id;

		$this->db->setQuery($query);

		$this->db->query();

	}

	function save($event_id){

		$query = "insert  #__dtregister_files set path=".$this->db->Quote($this->path)." , event_id = ".$event_id ; 

		$this->db->setQuery($query);

		$this->db->query();

	}

}
?>
<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerFile extends DtrController {
   
   var $name = "file";
   
    function __construct($config = array()){
		 
		 parent::__construct($config);
		 $this->view = & $this->getView( 'file', 'html' );
		 $this->view->setModel($this->getModel('file'));

	}
	
	function upload(){
	  ob_clean();
	  echo "<textarea>";
	   $field_id = JRequest::getVar('field_id', '');
	   $name = JRequest::getVar('name', '');
	   $types = explode(",",JRequest::getVar('filetypes'.$name, ''));
	   $file = $_FILES["file_".$name];
	   $size = JRequest::getVar('filesize'.$name, '');
	   $newtype = array();
	   
	   if (is_array($types)) 
	   foreach($types as $type){
		  $newtype[] = ".".$type;
	   }
	   
	   if (is_array($newtype)) 
	   foreach($newtype as $val){
		  $types[] = $val;
	   }
	   $dt_file = new DT_file();
       jimport('joomla.filesystem.file');
       $ext = JFile::getExt($file['name']);
	   if($file['name']==""){
	     ?>var data = {Error:'<?php echo JText::_( 'DT_ERROR_FILE_NOT_FOUND' ); ?>'}<?php
		 die;
	   }
	    if(in_array($ext,$types) || count($types) <1){
		   if(($file['size']/1000) <= $size){
			  $folder = 'uploads';
               if(isset($_REQUEST['eventpic'])){
				    $folder = "eventpics";
			   }
			  $dt_file->upload($file,$folder);
			  $value=$dt_file->path;
			  ?>var data = {Error:'',path:'<?php echo JFile::getName($dt_file->path) ?>',message:'<?php echo JText::_( 'DT_FILE_UPLOADED' ) ?>'}	  <?php
			}else{// file error
			   ?>var data = {Error:'<?php echo JText::_( 'DT_ERROR_FILE_SIZE' ); ?>'}<?php
			}
	     }else{// file type not valid ?>
         	var data ={Error:'<?php echo JText::_( 'DT_ERROR_FILE_TYPE' ); ?>'}
			<?php    
	     }		  		   
     
		echo "</textarea>";
 		exit;
	  
	}
	
	function thumb(){
	   global $registrant_avatar_width , $registrant_avatar_height; 
	   ob_clean();

	include(JPATH_SITE."/components/com_dtregister/lib/thumbnail.inc.php");
 $registrant_avatar_width = JRequest::getVar('w', $registrant_avatar_width );

	 $registrant_avatar_height = JRequest::getVar('h', $registrant_avatar_height );

	$thumb = new Thumbnail($_GET['filename']);
    
    $thumb->resize($registrant_avatar_width,$registrant_avatar_height);

    $thumb->show();

   exit;
	   	
	}
   
}
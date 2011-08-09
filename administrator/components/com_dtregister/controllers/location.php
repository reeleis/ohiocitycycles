<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterControllerLocation extends DtrController {

   var $name ='location';

	function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'location', 'html' );

		 $this->view->setModel($this->getModel('location'),true);

		 $this->registerTask( 'new',  'add' );

		 $this->registerDefaultTask("location");

		 JToolBarHelper::title(  JText::_( 'DT_LOCATION_MANAGEMENT'), 'dtregister' );

	}

	function location(){   

		JToolBarHelper::deleteList(JText::_( 'DT_DELETE_LOCATION'),'delete');

        JToolBarHelper::divider();

        JToolBarHelper::editList('edit', JText::_( 'DT_EDIT') );

	    JToolBarHelper::divider();

        JToolBarHelper::addNew('add',JText::_( 'DT_NEW_LOCATION'));

		$this->view->setLayout('list');

	    $this->view->display();

	}

	function add(){

	    JToolBarHelper::cancel('cancel');

        JToolBarHelper::save('save');

		$this->view->setLayout('add');

	   $this->view->display();

	}	

	function ImageUpload(){

	ob_clean();

	 $file = $_FILES['locationimage'];

     $dt_file = new DT_file();

    if($dt_file->upload($file,'locations')){

    echo "DTjQuery('#image').val('".$dt_file->path."');\n";

    echo "DTjQuery('#showimag').html('<img src=\"../index.php?option=com_dtregister&w=".$this->config->getGlobal('location_img_w',120)."&h=".$this->config->getGlobal('location_img_h',100)."&task=thumb&no_html=1&controller=file&filename=images/dtregister/locations/".basename($dt_file->path)."\" />');\n";

    echo "alert('".JText::_( 'DT_FILE_UPLOADED')  ."');";

  }else{

    echo "alert('".JText::_( 'DT_FILE_UPLOAD_ERROR')  ."');";

  }

 die;

	}

	function edit(){

	    JToolBarHelper::cancel('cancel');

		JToolBarHelper::title(  JText::_( 'DT_LOCATION_MANAGEMENT'), 'dtregister' );

        JToolBarHelper::save('save');

	   $this->view->setLayout('edit');

	   $this->view->display();

	}

	function save(){

	   global $mainframe;

       $row = $this->getModel('location')->location;

	   $id=JRequest::getInt('id',0);

	  if($id){

	     $row->load($id);

	  }

	if(!isset($_POST['showimage'])){

	   $row->showimage = 0;

	}

	if (!$row->bind( $_POST )) {

        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";

        exit();

    }

    if (!$row->check()) {

        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";

        exit();

    }

    if ($row->store() !== null) {

		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";

        exit();

    }

	$mainframe->redirect( "index2.php?option=com_dtregister&controller=location" ,JText::_( 'DT_LOCATION_SAVED') );

	}

	function delete(){

	global $mainframe;

    $locations = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	$database = &JFactory::getDBO();

	$warning = false;

	$message = false;

	if (is_array($locations)) 
	foreach($locations as $location){

		$sql='Select slabId From #__dtregister_group_event WHERE location_id=' . $database->Quote( $location );

		$database->setQuery($sql);

		$total=$database->loadResult();

		if ($total){

			$warning = true;

		}else{

		   $message = true;

		   $sql1='DELETE FROM  #__dtregister_locations WHERE id=' . $database->Quote( $location );

		   $database->setQuery($sql1);

		   $database->query();

		}

	}

	$msg = "";

	if($warning){

		$msg = JText::_( 'DT_LOCATION_DELETE_WARNING' );

	}

	if($message){

	   $msg .=  " ".JText::_( 'DT_LOCATION_DELETED' );

	}

	$mainframe->redirect("index.php?option=".DTR_COM_COMPONENT."&task=list&controller=location",$msg);

	}

}
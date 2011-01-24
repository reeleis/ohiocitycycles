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
class DtregisterControllerLocation extends DtrController {
   
   var $name ='location';
	
	function __construct($config = array()){
		$config = array('default_task'=>'location','task_map'=>array('new'=>'add'));
		 parent::__construct($config);
		 $this->view = & $this->getView( 'location', 'html' );
		 $this->view->setModel($this->getModel('location'),true);
		 //$this->registerTask( 'new',  'add' );
		 //$this->registerDefaultTask("location");
		 JToolBarHelper::title(  JText::_( 'DT_LOCATION_MANAGEMENT'), 'dtregister' );

	}
	
	function show(){
	 
	   $this->display();
	   
	}
	function location(){
	    
		JToolBarHelper::deleteList(JText::_( 'DT_DELETE_LOCATION'),'delete');

        JToolBarHelper::divider();

        JToolBarHelper::editList('edit', JText::_( 'DT_EDIT') );

	    JToolBarHelper::divider();

        JToolBarHelper::addNew('new',JText::_( 'DT_NEW_LOCATION'));
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
    
    echo "DTjQuery('#showimag').html('<img src=\"index.php?option=com_dtregister&controller=file&w=".$this->config->getGlobal('location_img_w',120)."&h=".$this->config->getGlobal('location_img_h',100)."&task=thumb&no_html=1&filename=".$dt_file->path."\" />');\n";

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
	   global $mainframe,$Itemid;

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

	$mainframe->redirect( "index.php?option=com_dtregister&controller=location&Itemid=$Itemid" ,JText::_( 'DT_LOCATION_SAVED') );
 
	}
	
	function delete(){
		global $mainframe,$Itemid;
	   $cid  = JRequest::getVar( 'cid', array(0), 'request', 'array' );
	    $row = $this->getModel('location')->location;
		$row->delete(intval( $cid[0] ));
	   
	   $mainframe->redirect("index.php?option=com_dtregister&controller=location&task=list&Itemid=$Itemid");	
    }

}
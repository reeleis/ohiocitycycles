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

class DtregisterControllerCategory extends DtrController {

	var $name ='category';

	function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'category', 'html' );

		 $this->view->setModel($this->getModel('category'),true);

		 $this->registerTask( 'new',  'add' );

		 $this->registerDefaultTask("category");

		 JToolBarHelper::title(  JText::_( 'DT_CATEGORY_MANAGEMENT'), 'dtregister' );



	}

	

	function edit(){

	   

	   



       JToolBarHelper::back();

       JToolBarHelper::divider();

       JToolBarHelper::save('save');

	   

	   $this->view->setLayout('edit');

	   $this->view->display();

	}

	

	function category(){

	    global $mainframe ;

	   

        JToolBarHelper::divider();

        JToolBarHelper::deleteList(JText::_('DT_DELETE_CATEGORY_CONFIRM'),'deletelist');

        JToolBarHelper::divider();

        JToolBarHelper::addNewX('add');
		JToolBarHelper::divider();
        JToolBarHelper::publishList('publish');
		JToolBarHelper::divider();
		JToolBarHelper::unpublishList('unpublish');
	    $this->view->setLayout('list');

		

		

		$this->view->display();

	}

    function publish(){
	  
	  global $mainframe , $Itemid ;
      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	 

	  $category = $this->getModel('category')->table ;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $category->load($id);

		  $category->published = 1 ;

		  $category->store();      

	  }
	 
      $mainframe->redirect("index.php?option=com_dtregister&controller=category&Itemid=$Itemid");
			
	}
	
	  function unpublish(){
	  
	  global $mainframe , $Itemid;
      $cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	 

	  $category = $this->getModel('category')->table ;

	   if (is_array($cid)) 
	   foreach($cid as $id){

	      $category->load($id);

		  $category->published = 0 ; 

		  $category->store();      

	  }
      $mainframe->redirect("index.php?option=com_dtregister&controller=category&Itemid=$Itemid");
			
	}
	

	function orderup(){

	  global  $mainframe ,$Itemid;

	  $cid  = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	  $this->reorder( intval( $cid[0] ), -1);

	  $mainframe->redirect("index2.php?option=com_dtregister&controller=category&task=list&Itemid=$Itemid");

	}

	

	function saveorder(){

	   

	   global $mainframe , $Itemid;

       $cid  = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	   $database = &JFactory::getDBO();



	   $total		= count( $cid );



	   $order	= JRequest::getVar( 'order', array(0), '', 'array' );



	   $row 		= $this->getModel('category')->table;



	   for( $i=0; $i < $total; $i++ ) {



		$row->load( (int) $cid[$i] );



		if ($row->ordering != $order[$i]) {



			$row->ordering = $order[$i];



			if (!$row->store()) {



				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";



				exit();



			}



		}



	}



	$mainframe->redirect("index2.php?option=com_dtregister&controller=category&task=list&Itemid=$Itemid");

	   

	}

	

	function orderdown(){

	   global  $mainframe , $Itemid;

	   $cid  = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	   $this->reorder( intval( $cid[0] ), 1 );

	   $mainframe->redirect("index2.php?option=com_dtregister&controller=category&task=list&Itemid=$Itemid");

	}


	

	function delete(){

	   

		global $mainframe ,$Itemid;

	

		$database = &JFactory::getDBO();

	

		$id=JRequest::getVar('id');

	

		$sql='Select slabId From #__dtregister_group_event WHERE category=' . $database->Quote( $id );

	

		$database->setQuery($sql);

	

		$total=$database->loadResult();

	

		if ($total){

	

		  $msg =  JText::_( 'DT_CATEGORY_DELETE_WARNING' );

	

		}

	

		else {

	

		$sql1='DELETE FROM  #__dtregister_categories WHERE categoryId=' . $database->Quote( $id );

	

		$database->setQuery($sql1);

	

		$database->query();

	

		 $msg = JText::_( 'DT_CATEGORY_DELETED' );

	

	   }

	

		$mainframe->redirect("index.php?option=".DTR_COM_COMPONENT."&task=list&controller=category&Itemid=$Itemid",$msg);



    

	}

	   

	function deletelist(){

	   

	   global $mainframe , $Itemid;

    $categories  = JRequest::getVar( 'cid', array(0), 'request', 'array' );

	$database = &JFactory::getDBO();

	$warning = false ;

	$message =  false ;

	if (is_array($categories)) 
	foreach($categories as $category){

		$sql='Select slabId From #__dtregister_group_event WHERE category=' . $database->Quote( $category );

	

		$database->setQuery($sql);

	

		$total=$database->loadResult();

	

		if ($total){

		    

			$warning =  true ;

		   

		}else{

		   $message =  true ;

		   $sql1='DELETE FROM  #__dtregister_categories WHERE categoryId=' . $database->Quote( $category );



		   $database->setQuery($sql1);

		

		   $database->query();

		  

		}

	}

	

	$msg = "";

	

	if($warning){

	    

		$msg = JText::_( 'DT_CATEGORY_DELETE_WARNING' );

		

	}

	if($message){

	   

	   $msg .=  " ".JText::_( 'DT_CATEGORY_DELETED' );

	   

	}

	 

	$mainframe->redirect("index.php?option=".DTR_COM_COMPONENT."&task=list&controller=category&Itemid=$Itemid",$msg);

	   

	}

	

	function reorder($uid, $inc){

	   

	   $cat = $this->getModel('category');

	   $cat->table->load( (int)$uid );

	   $cat->table->reorder();

   

	   $cat->table->move( $inc, " parent_id= ".$cat->table->parent_id );

	}

	function add(){

	    

		JToolBarHelper::back();

        JToolBarHelper::divider();

		JToolBarHelper::save('save');

	    $this->view->setLayout('add');

		$this->view->display();

	  

	}

	function save(){

	    global $mainframe , $Itemid;

	    $catid=JRequest::getVar('categoryId',false);

		$cat = $this->getModel('category')->table;

		$cat->save($_POST);
        
		//$cat->store();

		

		if($catid){ // edit

		  

		}else{  // new 

		    $database = &JFactory::getDBO();

		    $categoryId= $database->insertid();

			$sql = "select count(*) as count_cat from #__dtregister_categories";



			$database->setQuery($sql);

		

			$rows=$database->loadResult();

		

			$sql = "Update #__dtregister_categories set ordering = '".$rows."' where categoryId = '".$categoryId."'";

		

			$database->setQuery($sql);

		

			$database->query();

		}

		 $mainframe->redirect("index2.php?option=com_dtregister&controller=category&task=list&Itemid=$Itemid");

	}

	

}

?>
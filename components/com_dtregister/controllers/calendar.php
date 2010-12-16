<?php

class DtregisterControllerCalendar extends DtrController {



   var $name ='calendar';

	

	function __construct($config = array()){

		 parent::__construct($config);

		  $this->view = & $this->getView( 'calendar', 'html' );

		  $this->view->setModel($this->getModel('event'));

		  $this->view->setModel($this->getModel( 'location' ));

		  $this->view->setModel($this->getModel( 'user' ));

		  $this->view->setModel($this->getModel( 'member' ));

		  $this->view->setModel($this->getModel( 'field' ));
		  $this->view->setModel($this->getModel( 'category' ));

		  

		  $this->registerDefaultTask("index");

	}

	

	function index(){
        global $mainframe ;
		$cat = $mainframe->getUserStateFromRequest( "com_dtregister.cat", 'cat','all' );
        
		$this->view->assign('cat',$cat);
	   	$this->view->setLayout('index');

		$this->view->display();

	}

	

	function events(){

	   

	   $startdate = JREquest::getVar('showdate');

	   $viewtype = JREquest::getVar('viewtype');

      $cat = JREquest::getVar('cat','all');
	   

	   $daterange = DTrCommon::getDateRangeByViewType($startdate,$viewtype);

	   $mevt = $this->getModel('event');

	   $tevt = $mevt->table;

	   $query = $mevt->listingQuery($daterange,$cat);

	   $events = $tevt->query($query,null,null); 
       
	   $this->view->assign('eventTable',$tevt);
	   $this->view->assign('events',$events);

	   $this->display();

	   	

	}

   

}

?>
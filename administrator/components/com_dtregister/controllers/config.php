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



class DtregisterControllerConfig extends DtrController {

		

	var $name ='config';

	

	function __construct($config = array()){

		 parent::__construct($config);

		 $this->view = & $this->getView( 'config', 'html' );

		 $this->view->setModel($this->getModel('field'),false);

		 $this->registerTask( 'edit',  'edit' );

		 $this->registerDefaultTask("index");



	}



	function index(){	

			$document =& JFactory::getDocument();

			$document->setTitle(JText::_('DT_CONFIGURATION'));

			

			JToolBarHelper::title( JText::_( 'DT_CONFIGURATION' ), 'dtregister' );



			

			$this->view->setLayout('edit');

			

			

			

			$this->view->display();

		}

	

		function loadtab(){

			

			$type = JRequest::getVar('type') ;

			

			$this->view->setLayout('tab.'.$type);

			$this->view->display();

			

		}

		

		function save(){

		

			global $mainframe ,$eventListOrder;
            

			$conf = $this->getModel('config');

			if($eventListOrder != $_POST['config']["eventListOrder"]){
	            $conf->updateEventorder( $_POST['config']["eventListOrder"]);
	        }

            
			$database = &JFactory::getDBO();

			$sql="TRUNCATE TABLE `#__dtregister_config`  ";

	

			$database->setQuery($sql);

			$database->query();

			$mconfig = $this->getModel('config');

			foreach($_POST['config'] as $key=>$value){

				 if(is_array($value)){

					 if(in_array($key,$mconfig->config_array_map)){			  

					    $multiplevalue = json_encode($value);

					 // prd((array)json_decode($value));			

			         }else{

						 $multiplevalue= implode(',',$value);

					 }		

					$key=$database->Quote($key);

					$multiplevalue=$database->Quote($multiplevalue);

					$sql="Insert Into #__dtregister_config(config_key,config_value,`title`) Values($key,$multiplevalue,$key)";

					$database->setQuery($sql);

					if(!$database->query()){

						echo $database->getErrorMsg();		

						die;

					}

	

				  }else{

					 $value= JRequest::_cleanVar($value,JREQUEST_ALLOWHTML);

					$key=$database->Quote($key);

	

					$value=$database->Quote($value);

	

					$sql="Insert Into #__dtregister_config(config_key,config_value,`title`) Values($key,$value,$key)";

					$database->setQuery($sql);

	

				   if(!$database->query()){

						echo $database->getErrorMsg();

										

						die ;

					}

				}

			

			}

							

		  $mainframe->redirect("index.php?option=".DTR_COM_COMPONENT."&task=index&controller=config", JText::_( 'SETTINGS_SAVED' ));

		 

			

			

		}



			



}


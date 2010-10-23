<?php

 // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class JUpdateManController extends JController {
	function step1() {
		JToolBarHelper::title( JText::_( 'Joomla! Update Manager - Step 1' ), 'install.png' );
		JToolBarHelper::preferences('com_jupdateman', '300');
		// Download and parse update XML file and provide select download option
		require_once( JPATH_ADMINISTRATOR . '/components/com_jupdateman/step1.php' );
	}

	function step2() {
		JToolBarHelper::title( JText::_( 'Joomla! Update Manager - Step 2' ), 'install.png' );
		// Download selected file (progress dialog?) and Are You Sure?
		require_once( JPATH_ADMINISTRATOR . '/components/com_jupdateman/step2.php' );
	}

	function step3() {
		JToolBarHelper::title( JText::_( 'Joomla! Update Manager - Step 3' ), 'install.png' );
		// Install
		require_once( JPATH_ADMINISTRATOR . '/components/com_jupdateman/step3.php' );
	}
	
	function autoupdate() {
		$model =& $this->getModel();
		$res = $model->autoupdate();
		$view =& $this->getView('results', 'html');
		$view->setLayout(($res ? 'success' : 'failure'));
		$view->setModel($model, true); // set the model and make it default (true)
		$view->display();
	}
}

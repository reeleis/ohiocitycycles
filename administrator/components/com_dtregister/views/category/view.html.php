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
class DtregisterViewCategory extends DtrView {
   
   	function display($tpl = null){
	      			
			JHTML::_('behavior.tooltip');
			
			parent::display($tpl);
	       			
	}
   
}
?>
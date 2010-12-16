<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterViewCategory extends DtrView {
   
   	function display($tpl = null){
	      			
			JHTML::_('behavior.tooltip');
			parent::display($tpl);
				
		}
   
}
?>
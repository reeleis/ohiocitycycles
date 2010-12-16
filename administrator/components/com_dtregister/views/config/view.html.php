<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

class DtregisterViewConfig extends DtrView {

   

   	function display($tpl = null){

	      			
           JToolBarHelper::save('save');

			JToolBarHelper::cancel('cancel');

			JHTML::_('behavior.tooltip');

			parent::display($tpl);

				

		}

   

}

?>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$exModel = $this->getModel('export');
$eventOptions = $exModel->prepareEventoptions($this->events);
?>
<form action="index.php" method="post" name="adminForm">
<table>
 <tr>

        	<td colspan="5">

            <?php echo JText::_('DT_EXPORT_INSTRUCTIONS_PT1'); ?>

        	</td>

        </tr>

 		   <tr>

        	<td colspan="<?php echo $columns;?>">

            	 <input type="checkbox" id="checkall" /> <?php echo JText::_('DT_CHECKALL'); ?> <br />

        	</td>

        </tr>

<?php
echo  DtHtml::checkboxListrows('export_events',$eventOptions,5,$this->expevents);
?>

</table>
<input name="option" type="hidden" value="com_dtregister" />
<input name="controller" type="hidden" value="export" />
<input name="formsubmit" type="hidden" value="1" />
<input name="task" type="hidden" value="" />
</form>

 <script type="text/javascript">

	  DTjQuery(function(){

    	 DTjQuery("#checkall").click(function(){

		   if(this.checked){

		   		DTjQuery("form input[type=checkbox]").attr("checked", 'checked');

		   }else{

		   		DTjQuery("form input[type=checkbox]").attr("checked", false);

		   }

		 });

	  });

    </script>

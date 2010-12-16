<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 $mfield = $this->getModel('field');
 $mexport = $this->getModel('export');
 $mfield->table->displayField = 'label';

 $sql = "select distinct field_id from #__dtregister_field_event where showed <> 0 and event_id in(".implode(",",$this->tExport->events).")";
 $confields = $mfield->table->query($sql,null,null);

 $confieldIds = array();
 foreach($confields as $cf){
   	$confieldIds[] = $cf->field_id; 
 }
 
 $fields = $mfield->table->optionslist(' type <> 6 and id in('.implode(",",$confieldIds).') or parent_id in('.implode(",",$confieldIds).')','ordering');

?> 
 <form action="index.php" method="post" name="adminForm">
    <table cellpadding="10" cellpadding="10" width="100%" >
        <tr>

    <td colspan="3">

      <?php echo JText::_('DT_EXPORT_INSTRUCTIONS_PT2'); ?>

    </td>

    </tr>

        <tr>
          <td colspan="3">
              <table>

        <tr>

        <td>

        <?php echo JText::_('DT_START_DATE'); ?>: <?php 

          echo JHTML::_('calendar','', 'datefrom', 'datefrom',$format = '%Y-%m-%d',array('class'=>'inputbox datetype', 'size'=>'25', 'maxlength'=>'19')); ?>

          &nbsp;&nbsp;<?php echo JText::_('DT_END_DATE'); ?>: 

          <?php 

          echo JHTML::_('calendar','', 'dateto', 'dateto',$format = '%Y-%m-%d',array('class'=>'inputbox datetype', 'size'=>'25',  'maxlength'=>'19')); ?>

          </td>

        </tr>

       </table>

         </td>
        </tr>
        <tr>
           <td colspan="3">
       
               <input type="checkbox" id="checkall" /> <?php echo JText::_('DT_CHECKALL'); ?>
         
           </td>
       </tr>
        <tr>
          <td valign="top">
     <table>
        <tr><td colsapn="2" class="dt_heading">
	       <strong><?php echo JText::_('DT_GENERAL_INFO'); ?></strong>
	    </td></tr>
        <?php echo   DtHtml::checkboxListrows('general_export_fields', $mexport->generalFields,1,$this->general_export_fields); ?>   
     </table>
  </td>
  
  <td valign="top">
     <table>
        <tr><td colsapn="2" class="dt_heading">
	      <strong><?php echo JText::_('DT_INDIVIDUAL_GROUP_OPTIONS'); ?></strong>
	    </td></tr>
        <?php echo DtHtml::checkboxListrows('individual_export_fields', $fields,1,$this->individual_export_fields); ?>   
     </table>
  </td>
  
          <td valign="top">
            <table>
               <tr><td colsapn="2" class="dt_heading">
	             <strong><?php echo JText::_('DT_GROUP_MEMBER_DETAILS'); ?></strong>
	           </td></tr>
               <?php echo DtHtml::checkboxListrows('group_export_fields', $fields,1,$this->group_export_fields); ?>
            </table>
          </td>
  
       </tr>
 
    </table>
<input name="option" type="hidden" value="com_dtregister" />
<input name="controller" type="hidden" value="export" />
<input name="formsubmit" type="hidden" value="1" />
<input name="task" type="hidden" value="" />
</form>
 <script>

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

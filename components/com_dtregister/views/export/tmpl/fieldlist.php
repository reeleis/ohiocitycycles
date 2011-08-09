<?php

/**
* @version 2.7.6
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid;
 $mfield = $this->getModel('field');
 $mexport = $this->getModel('export');
 $mfield->table->displayField = 'label';

 $tuser = $this->getModel('user')->table;

 $sql = "select distinct field_id from #__dtregister_field_event where showed <> 0 and event_id in(".implode(",",$this->tExport->events).")";
 $confields = $mfield->table->query($sql,null,null);

 $confieldIds = array();
 foreach($confields as $cf){
   	$confieldIds[] = $cf->field_id;
	$tmp_fields = array();
	$mfield->table->findtree($cf->field_id,$tmp_fields);
	foreach($tmp_fields as $field_id =>$data){
		$confieldIds[] = $field_id;
	}
 }
 
 $fields = $mfield->table->optionslist(' type <> 6 and id in('.implode(",",$confieldIds).')','ordering'); // or parent_id in('.implode(",",$confieldIds).')
 $document =& JFactory::getDocument();
 $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/form.js");
 $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/jquery-ui.js");
 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css');
?> 
<div id="progressbarWrapper" style="height:30px; " class="ui-widget-default">
	<div id="progressbar" style="height:100%;"></div>
</div>
<script>
  var page = 0;
  var file = "";
  var totalpages = "";
  var limit = <?php echo  DtregisterModelExport::$limit; ?>;
  
  function populate_file(){
  	 
	 document.adminForm.task.value = 'fieldlist';
	 
	 var options = {
		             data:{'page':page,'file':file},
					 dataType: 'json',
					 forceSync:true ,
					 success : function(data){
					 	
						file = data.file;
						totalpages = Math.ceil(data.total/limit);
						totalpages -- ;
						DTjQuery( "#progressbar" ).progressbar('option','value',page*100/totalpages);
						
						if(page < totalpages){
							page++
							populate_file();
						}else{
							
							document.adminForm.filename.value = file;
							document.adminForm.task.value = 'downloadfile';
							page = 0;
  							file = "";
  							totalpages = "";
							document.adminForm.submit();
						}
					 }		 
	 
	                };
					
		DTjQuery('#adminForm').ajaxSubmit(options); 		
		
  }
  
  DTjQuery(function(){
	  DTjQuery( "#progressbar" ).progressbar({
			value: 0
	  });
      
  })
  
  function submitbutton(task){
	  
	  document.adminForm.task.value = task;
	  if(task == "fieldlist"){
		  alert('<?php echo JText::_('DT_PROCESSING_WAIT'); ?>');
	  	  if(page == 0 ){
	  		 populate_file();
			 return false;
		  }else if(page == totalpages){
		  
		  }

	  } else {
	  	 document.adminForm.submit();
	  }
  
  }
</script>
 <form action="index.php" method="post" id="adminForm" name="adminForm">
    <table cellpadding="10" cellpadding="10" width="100%">
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
          <table>
            <tr>
              <td> 
                <?php echo JText::_('DT_STATUS');?>:
              </td>
              <td>
                <?php
				   echo DtHtml::checkboxListrows('status', $tuser->statustxt,10,array_keys($tuser->statustxt));  
				?>
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
          <td valign="top" class="fields">
     <table>
        <tr><td colsapn="2" class="dt_heading">
	       <strong><?php echo JText::_('DT_GENERAL_INFO'); ?></strong>
	    </td></tr>
        <?php echo   DtHtml::checkboxListrows('general_export_fields', $mexport->generalFields,1,$this->general_export_fields); ?>   
     </table>
  </td>
  
  <td valign="top" class="fields">
     <table>
        <tr><td colsapn="2" class="dt_heading">
	      <strong><?php echo JText::_('DT_INDIVIDUAL_GROUP_OPTIONS'); ?></strong>
	    </td></tr>
        <?php echo DtHtml::checkboxListrows('individual_export_fields', $fields,1,$this->individual_export_fields); ?>   
     </table>
  </td>
  
          <td valign="top" class="fields">
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
<input name="filename" type="hidden" value="" />
<input type="hidden" name="Itemid" value="<?php echo $Itemid; ;?>">
</form>
 <script>

	  DTjQuery(function(){

    	 DTjQuery("#checkall").click(function(){

		   if(this.checked){

		   		DTjQuery(".fields input[type=checkbox]").attr("checked", 'checked');

		   }else{

		   		 DTjQuery(".fields input[type=checkbox]").attr("checked", false);

		   }

		 });

	  });

    </script>

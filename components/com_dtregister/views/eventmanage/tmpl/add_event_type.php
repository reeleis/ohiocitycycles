<?php
$mevent = $this->getModel('event');
if(!$mevent->tableJevt->isInstall()){
?>
 <tr style="display:none">
    <td>
      <input type="hidden" name="eventType" id="eventType" value="new" />
    </td>
 </tr>
<?php
}else{
?>
<tr>
  <td><?php echo JText::_( 'DT_EVENT_TYPE' ); ?>:</td>
   <?php
     $options = array('new'=>JText::_('DT_NEW_EVENT'),'jevent'=>JText::_('DT_JEVENT'));
   ?>
    <td><?php  echo JHTML::_('select.genericlist', DtHtml::options($options),'eventType',' ','value','text','new')?></td>
	
	    <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>
</tr>
<?php
}
?>
<script type="text/javascript">
    
	DTjQuery(function(){
	    
		DTjQuery("#eventType").change(function(){
		     
			 var value = DTjQuery(this).val();
			 if(navigator.appName.indexOf("Micro") >=0){
				 display = 'block';
			 }else{
				 display = 'table-row';
			 }
			 if(value == 'jevent'){
			    DTjQuery('#jeventrow').css({display:display});
				DTjQuery('tr[id="timerow"]').find('input').attr('readonly','readonly');
				DTjQuery('.repeatType').filter('[value="norepeat"]').attr("checked","checked");
                DTjQuery('.repeatType').filter('[value="norepeat"]').trigger('change');
				DTjQuery('.repeatType').attr('readonly','readonly');
				DTjQuery(".jeventdisable").attr('disabled','true');
				DTjQuery("#dtstarttime").timeEntry('destroy');
                DTjQuery("#dtendtime").timeEntry('destroy');
			 }else{
			   // DTjQuery('tr[id="timerow"]').css({display:display});   
				//DTjQuery('tr[id="timerow"]').find('input').removeAttr('readonly');	 
				DTjQuery('.repeatType').removeAttr('readonly');
				DTjQuery(".jeventdisable").removeAttr('disabled');
				DTjQuery('#summary').removeAttr('readonly');
				DTjQuery('#jeventrow').hide();
					DTjQuery("#dtstarttime").timeEntry({spinnerImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrange.png" ?>',spinnerBigImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrangeBig.png" ?>'});
                DTjQuery("#dtendtime").timeEntry({spinnerImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrange.png" ?>',spinnerBigImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrangeBig.png" ?>'});
			 }
			 	
		})
		DTjQuery("#eventType").trigger('change');	
	});
	
</script>
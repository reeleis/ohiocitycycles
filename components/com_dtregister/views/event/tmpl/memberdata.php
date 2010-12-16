<?php

global $Itemid , $full_message;
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'event_header.php');

?>
<div>
  <?php
     $tEvent = $this->tEvent ;
       $registered = $tEvent->getTotalregistered($tEvent->slabId);
      $message = ($registered >= $tEvent->max_registrations && $tEvent->max_registrations !=0 &&$tEvent->max_registrations!="")?$full_message:$this->tEvent->topmsg;
	  
	  echo ($message!="")?$message."<br /><br />":'';
  ?>
</div>
<div id="price_header">
<?php
//include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
?>
</div>
<form name="frmcart" method="post" action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid ?>" enctype="multipart/form-data">

 <table>

 <tr >

		<td colspan="3" align="left" ><strong><?php echo JText::_( 'DT_MEMBER' ) . ' ' .($this->memberIndex +1). ' ' . JText::_( 'DT_INFORMATION' ); //$currentMember; ?></strong></td>

		</tr>

 <?php

       echo  $this->form ;

	  

	 ?>

  <tr><td colspan="2">

    <input type="button" class="button" onclick="window.location='<?php echo $this->back; ?>'" value="<?php echo JText::_('DT_BACK'); ?>" id="next" name="billingInfo"/>

  <input type="submit" value="<?php echo JText::_( 'DT_NEXT_BUTTON' );?>" class="button"  /></td></tr>



  </table>



  <input type="hidden" name="option" value="com_dtregister" />

  <input type="hidden" name="controller" value="event" />

  <input type="hidden" name="task" value="memberdata" />

  <input type="hidden" name="memberIndex" value="<?php echo  $this->memberIndex; ?>" />



  <input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />



</form>
<script type="text/javascript">
 
  
 var updateFee =  function(){
	    
	   var prevtask = DTjQuery(document.frmcart.task).val();
	   var options = {
		               url : "<?php echo JRoute::_("index.php?no_html=1");?>",
					   success : function(responseText){
						             DTjQuery("#price_header").html(responseText);
					              }
		   }
	   DTjQuery(document.frmcart.task).val('price_header');
	   DTjQuery(document.frmcart).ajaxSubmit(options);
	   DTjQuery(document.frmcart.task).val(prevtask);
	     
  }
  
  updateFee();
</script>
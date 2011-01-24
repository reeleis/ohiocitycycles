<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid;
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
?>
<div id="price_header">
<?php
  //include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
?>
</div>
<form name="frmcart" id="frmcart" method="post" action="index.php" enctype="multipart/form-data">

   <table>

     <?php

	   echo $this->form;

	 ?>

    <tr><td colspan="3" align="center"><input onclick='window.location="<?php echo JRoute::_("index.php?option=com_dtregister&controller=member&task=index&userId=".$this->userId); ?>"' name="" type="button" class="button" value="<?php echo JText::_( 'DT_BACK' ); ?>" />&nbsp;&nbsp;<input type="submit" class="button" name="savemember" value="<?php echo JText::_( 'DT_SAVE' );?>" /></td></tr>

   </table>

   <input type="hidden" name="Member[groupUserId]" value="<?php echo $this->userId; ?>" />

   <input type="hidden" name="userId" value="<?php echo $this->userId; ?>" />

   <input type="hidden" name="formsubmit" value="add" />
   <input type="hidden" name="key" value="" />
   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="member" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="add" />

</form>

<div id="debug">

</div>

<script type="text/javascript">

 DTjQuery(function(){

   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.frmcart).validate({

	        success: function(label) {

				label.addClass("success");

			}

	});

 })

</script>
<script type="text/javascript">
 
  var updateFee = function(){
	    
	   var prevtask = DTjQuery(document.frmcart.task).val();
	   var prevcontroller = DTjQuery(document.frmcart.controller).val();
	   var options = {
		               url : "<?php echo JRoute::_("index.php?no_html=1");?>",
					   success : function(responseText){
						             DTjQuery("#price_header").html(responseText);
					              }
		   }
	   DTjQuery(document.frmcart.task).val('price_header');
	   DTjQuery(document.frmcart.controller).val('user');
	   DTjQuery(document.frmcart).ajaxSubmit(options);
	   DTjQuery(document.frmcart.task).val(prevtask);
	   DTjQuery(document.frmcart.controller).val(prevcontroller);
	     
  }
  
  updateFee();
</script>
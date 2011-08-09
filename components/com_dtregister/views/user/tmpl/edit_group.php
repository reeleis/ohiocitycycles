<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid,$xhtml,$cb_integrated,$cbviewonly;

$tUser = $this->mUser->table;

$dfields = $tUser->TableUserfield->Tablefield->getDefaultFieldIds();
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
?>

<div style="padding: 0px 0px 10px 0px">
	
	<?php echo JText::_('DT_EDIT_GROUP_BILLING_INSTRUCTIONS'); ?>
	
</div>

<div id="price_header">
<?php
  //include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
?>
</div>
<form name="frmcart" method="post" action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid ?>" enctype="multipart/form-data">

   <table border="0">

       <tr>

        <td colspan="2">
				<?php echo JText::_( 'DT_EDIT_MEMBERS' ); ?>:
                <input type="text" name="memtot" value="" size="6" />
		</td>

      </tr>

   <tr><td colspan="3" align="center"><input type="button" class="button" value="<?php echo JText::_( 'DT_BACK' ); ?>" onclick="javascript:history.back();" />&nbsp;<input type="submit" id="next" name="saveuser" class="button" value="<?php echo JText::_( 'DT_NEXT_BUTTON' );?>" class="button" /></td></tr>

   </table>

   <input type="hidden" name="userId" value="<?php echo $tUser->userId; ?>" />

   <input type="hidden" name="formsubmit" value="edit" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="user" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="edit_group" />

   <input type="hidden" name="User[userId]" value="<?php echo $tUser->userId; ?>" />
   
</form>

<div id="debug">

</div>

<script type="text/javascript">

  var priceupdate= {};
  var disabled = [];
  DTjQuery('#next').click(function(){
  	  if(DTjQuery(document.frmcart).valid()){
        var disabled = DTjQuery(':disabled');
        DTjQuery.each(disabled, function(){
		     DTjQuery(this).removeAttr('disabled');  
	   	})
	  	
	}
  })
  
  var updateFee = function(){
	   
	    DTjQuery.each(disabled, function(){
			DTjQuery(this).attr('disabled','disabled');  
			 });
	   if(priceupdate.formajax != undefined) {
		 
	      priceupdate.formajax.abort();
	   }
	   
	   var prevtask = DTjQuery(document.frmcart.task).val();
	   disabled = DTjQuery(':disabled');
	   
	   var options = {
		               url : "<?php echo JRoute::_("index.php?no_html=1");?>",
					   data : {task:'price_header'},
					   success : function(responseText){
						             DTjQuery("#price_header").html(responseText);
									  DTjQuery.each(disabled, function(){
										  DTjQuery(this).attr('disabled','disabled');  
									   })
									 ///DTjQuery(document.frmcart.task).val(prevtask);
					              },
					   beforeSubmit : function(){
						                  DTjQuery.each(disabled, function(){
		  										DTjQuery(this).removeAttr('disabled');  
	   									  })
										 //  DTjQuery(document.frmcart.task).val('price_header');
										  return true;
									  }
	               }
	  
	  // DTjQuery(document.frmcart.task).val('price_header');
	   priceupdate =  DTjQuery(document.frmcart).ajaxSubmit(options);
	   
	   DTjQuery.each(disabled, function(){
		  //DTjQuery(this).attr('disabled','disabled');  
	   })
	   //DTjQuery(document.frmcart.task).val(prevtask);

  }
  
  updateFee();

 DTjQuery(function(){

   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.frmcart).validate({

	        success: function(label) {

				label.addClass("success");

			}

	});

 })

</script>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid , $xhtml , $cb_integrated , $cbviewonly;

$tUser = $this->mUser->table;

$dfields = $tUser->TableUserfield->Tablefield->getDefaultFieldIds();
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
?>
<div id="price_header">
<?php
  //include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
?>
</div>
<form name="frmcart" method="post" action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid ?>" enctype="multipart/form-data">

   <table>

       <tr>

         <td colspan="2">

           <?php 

		     if($tUser->type=="G"){	    

	        ?>

        <a href="<?php echo JRoute::_('index.php?option=com_dtregister&controller=member&Itemid='.$Itemid.'&userId='.$tUser->userId,$xhtml ); ?>"><?php echo  JText::_( 'DT_EDIT_MEMBERS' ); ?></a></td>

      <?php

			  }

		    ?>

      </tr>
    <?php if($this->tEvent->use_discountcode){?>
      <tr>

         <td>

           <?php echo JText::_( 'DT_DISCOUNT_CODE'); ?>

         </td>

         <td>

           <input type="text" name="User[discount_code]" value="<?php echo $tUser->TableDiscountcode->code ?>" class="inputbox" />

         </td>

      </tr>
<?php } ?>

     <?php

	   echo  $this->form;

	 ?>

   <tr><td colspan="3" align="center"><input type="button" class="button" value="<?php echo JText::_( 'DT_BACK' ); ?>" onclick="javascript:history.back();" />&nbsp;<input type="submit" name="saveuser" class="button" value="<?php echo JText::_( 'DT_NEXT_BUTTON' );?>" class="button"  /></td></tr>

   </table>

   <input type="hidden" name="userId" value="<?php echo $tUser->userId; ?>" />

   <input type="hidden" name="formsubmit" value="edit" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="user" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="edit" />

   <input type="hidden" name="User[userId]" value="<?php echo $tUser->userId; ?>" />
   
</form>

<div id="debug">

</div>

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

 DTjQuery(function(){

   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.frmcart).validate({

	        success: function(label) {

				label.addClass("success");

			}

	});

 })

</script>
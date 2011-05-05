<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid,$currency_code;

$tUser = $this->mUser->table;

$paymthd = $this->getModel('paymentmethod');

$pMethods = $paymthd->getMergeList(true);

?>

<form name="adminForm" class="adminform" method="post" action="index.php" enctype="multipart/form-data">

   <table class="adminlist">

      <tr>

         <td style="width:150px;">

           <?php echo JText::_( 'DT_EVENT'); ?>

         </td>

         <td>

         <?php  echo JHTML::_('select.genericlist', DtHtml::options($tUser->TableEvent->optionslist(),JText::_("DT_SELECT_EVENT")),'User[eventId]',' ','value','text',$tUser->eventId)?>

         </td><td>&nbsp;</td>

      </tr>

      <tr><td><?php echo JText::_( 'DT_USERID' ); ?>:</td><td><?php  echo JHTML::_('select.genericlist', DtHtml::options($tUser->TableJUser->optionslist(),JText::_("DT_SELECT_USER")),'User[user_id]',' ','value','text',$tUser->user_id)?></td><td>&nbsp;</td></tr>

      <tr>

         <td>

           <?php echo JText::_( 'DT_DISCOUNT_CODE'); ?>

         </td>

         <td>

           <input type="text" name="User[discount_code]" value="<?php echo $tUser->TableDiscountcode->code ?>" class="inputbox" />

           <input type="hidden" name="User[userId]" value="<?php echo $tUser->userId; ?>" />

         </td><td>&nbsp;</td>

      </tr>
      
       <tr>

         <td>

           <?php echo JText::_( 'DT_CONFIRMATION_NUMBER'); ?>

         </td>

         <td>

           <input type="text" name="User[confirmNum]" value="<?php echo $tUser->confirmNum ?>" class="inputbox" />

         </td><td>&nbsp;</td>

      </tr>
       
       <tr>

         <td>

           <?php echo JText::_( 'DT_TRANSACTION_ID'); ?>

         </td>

         <td>

           <input type="text" name="User[transaction_id]" value="<?php echo $tUser->transaction_id ?>" class="inputbox" />

         </td><td>&nbsp;</td>

      </tr>
       
       <tr>

         <td>

           <?php echo JText::_( 'DT_STATUS'); ?>

         </td>

         <td>

         <?php  echo JHTML::_('select.genericlist', DtHtml::options($tUser->statustxt,JText::_("DT_SELECT_STATUS")),'User[status]',' ','value','text',$tUser->status)?>

         </td><td>&nbsp;</td>

      </tr>

      <tr>

         <td>

           <?php echo JText::_( 'DT_ATTENDED'); ?>

         </td>

         <td>

         <?php  echo JHTMLSelect::booleanlist("User[attend]","",$tUser->attend); ?>

         </td><td>&nbsp;</td>

      </tr>

       <tr>

         <td>

           <?php echo JText::_( 'DT_PAY_LATER_PAID'); ?>

         </td>

         <td>     

         <?php  echo JHTMLSelect::booleanlist("User[Fee][status]","",isset($tUser->fee->status)?$tUser->fee->status:0); ?>

         </td><td>&nbsp;</td>

      </tr>

       <tr>

         <td>

           <?php echo JText::_( 'DT_AMOUNT_PAID'); ?>

         </td>

         <td>

           <input type="text" name="User[Fee][paid_amount]" value="<?php echo DTreg::showprice($tUser->TableFee->paid_amount) ?>" class="inputbox" />

         </td><td>&nbsp;</td>

      </tr>
       <tr>

         <td>

           <?php echo JText::_( 'DT_AMOUNT'); ?>

         </td>

         <td>

           <input type="text" name="User[Fee][fee]" value="<?php echo DTreg::showprice($tUser->TableFee->fee); ?>" class="inputbox" />

         </td><td>&nbsp;</td>

      </tr>

      <tr><td><?php echo JText::_( 'DT_PAYMENT_METHOD' ); ?>:</td><td> <?php  echo JHTML::_('select.genericlist', DtHtml::options($pMethods,JText::_("DT_SELECT_PAY_OPTIONS")),'User[Fee][payment_method]',' ','value','text',isset($tUser->fee->payment_method)?$tUser->fee->payment_method:0)?></td><td>&nbsp;</td></tr>

     <?php

	   echo $this->form;

	 ?>
	
	 <?php
	   $html = $tUser->barCodeImg();

	   if($html!=""){
	 ?>
	   <tr>
	      <td><?php echo JText::_( 'DT_BARCODE' ); ?>:</td>

	      <td><?php echo $html; ?></td><td>&nbsp;</td>
	   </tr>
	 <?php  
  	   }

	 ?>

   </table>

   <input type="hidden" name="formsubmit" value="edit" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="user" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="edit" />

</form>

<div id="debug">

</div>

<script type="text/javascript">

 DTjQuery(function(){

   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.adminForm).validate({

	        success: function(label) {

				label.addClass("success");

			}

	});
	
	DTjQuery("#Useruser_id").change(function(){	    
		DTjQuery.getJSON('index.php?option=com_dtregister&controller=user&task=loadprofile&no_html=1',{id:DTjQuery(this).val()},function(data){

			DTjQuery.each(data,function(k,v){

				DTjQuery("#Field"+k).val(v);

			})

		});

	});

 })

 function submitbutton(pressbutton){

	if(pressbutton == "cancel"){

	   	submitform(pressbutton);

		return;

	}
    
	if(DTjQuery(document.adminForm).valid()){
		var disabled = DTjQuery(':disabled');
        DTjQuery.each(disabled, function(){
		     DTjQuery(this).removeAttr('disabled');  
	   	})
         document.adminForm.task.value = pressbutton;
		 //document.adminForm.submit();
	  	 submitform(pressbutton);

	}

	return false;

}

</script>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid;

$tUser = $this->mUser->table;

$paymthd = $this->getModel('Paymentmethod');

$pMethods = $paymthd->getMergeList(true);

?>

<form name="adminForm" class="adminform" method="post" action="index.php" enctype="multipart/form-data">

   <table class="adminlist">

      <tr>

         <td style="width:150px;">

           <?php echo JText::_( 'DT_EVENT'); ?>

         </td>

         <td>

         <?php  echo JHTML::_('select.genericlist', DtHtml::options($tUser->TableEvent->optionslist(),JText::_("DT_SELECT_EVENT")),'User[eventId]',' ','value','text',$this->eventId)?>

         </td>

         <td> </td>

      </tr>

      <tr><td><?php echo JText::_( 'DT_USERID' ); ?>:</td><td><?php  echo JHTML::_('select.genericlist', DtHtml::options($tUser->TableJUser->optionslist(),JText::_("DT_SELECT_USER")),'User[user_id]',' ','value','text',$tUser->user_id)?></td><td>&nbsp;</td></tr>

      <tr>

         <td>

           <?php echo JText::_( 'DT_DISCOUNT_CODE'); ?>

         </td>

         <td>

           <input type="text" name="User[discount_code]" value="<?php echo $tUser->TableDiscountcode->code ?>" class="inputbox" />

           <input type="hidden" name="User[userId]" value="<?php echo $tUser->userId; ?>" />

         </td>

         <td> </td>

      </tr>

       <tr>

         <td>

           <?php echo JText::_( 'DT_STATUS'); ?>

         </td>

         <td>

         <?php echo JHTML::_('select.genericlist', DtHtml::options($tUser->statustxt,JText::_("DT_SELECT_STATUS")),'User[status]',' ','value','text',$tUser->status)?>

         </td>

         <td> </td>

      </tr>  

       <tr>

         <td>

           <?php echo JText::_( 'DT_PAY_LATER_PAID'); ?>

         </td>

         <td>

         <?php  echo JHTMLSelect::booleanlist("User[Fee][status]","",(isset($tUser->fee))?$tUser->fee->status:0); ?>

         </td>

         <td> </td> 

      </tr>

      <tr>

         <td>

           <?php echo JText::_( 'DT_AMOUNT_PAID'); ?>

         </td>

         <td>

           <input type="text" name="User[Fee][paid_amount]" value="" class="inputbox" />     

         </td>

         <td> </td>

      </tr>

      <tr><td><?php echo JText::_( 'DT_PAYMENT_METHOD' ); ?>:</td><td> <?php  echo JHTML::_('select.genericlist', DtHtml::options($pMethods,JText::_("DT_SELECT_PAY_OPTIONS")),'User[Fee][payment_method]',' ','value','text',(isset($tUser->fee))?$tUser->fee->payment_method:'')?></td><td>&nbsp;</td></tr>  
     
     <?php

	   echo $this->form;

	 ?>
   
   <tr><td><?php echo JText::_( 'DT_SEND_EMAIL' ); ?>:</td><td><input type="checkbox" value="1" name="sendemail"></td><td>&nbsp;</td></tr>
   </table>

   <input type="hidden" name="User[memtot]" value="<?php echo $this->memtot; ?>" />

   <input type="hidden" name="User[type]" value="<?php echo $this->type; ?>" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="user" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="edit" />

   <input type="hidden" name="formsubmit" value="1" />

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

	  	submitform(pressbutton);

	}

	return false;

}

</script>
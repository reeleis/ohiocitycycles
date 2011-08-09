<?php

/**
* @version 2.7.7
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

         <?php echo JHTMLSelect::booleanlist("User[Fee][status]","",(isset($tUser->fee))?$tUser->fee->status:0); ?>

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
   
   <!----------- billing -------------->
   

      <tr class="billinginfo">
	
	      <td colspan="3" class="dt_heading"><?php echo JText::_( 'DT_OFFLINE_PAYMENT_DETAILS' ); ?></td>
	
	  </tr>
   
      <tr class="billinginfo">

                	<td><?php echo JText::_( 'DT_CARD_HOLDER_FIRSTNAME' ); ?>:<span class="dtrequired">  *  </span></td>

                    <td align="left"> <input id="billingFirstname" class="inputbox required" type="text" name="billing[firstname]" value="<?php echo (isset($tUser->card) && $tUser->card)?$tUser->card->firstname:'' ?>" /> </td><td> </td> 

                 </tr>

                   <tr class="billinginfo">

                	<td><?php echo JText::_( 'DT_CARD_HOLDER_LASTNAME' ); ?>:<span class="dtrequired">  *  </span></td>

                    <td align="left"> <input id="billingLastname" class="inputbox required" type="text" name="billing[lastname]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->lastname:'' ?>" /> </td>

                    <td> </td> 

                 </tr>
        <tr class="billinginfo">

                	<td><?php echo JText::_( 'DT_BILLING_ADDRESS' ); ?>:<span class="dtrequired">  *  </span></td>

                    <td align="left"> <input id="billingAddress" class="inputbox required" type="text" name="billing[address]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->address:'' ?>" /> </td>

                    <td> </td>

                 </tr>

                   <tr class="billinginfo">

                	<td><?php echo JText::_( 'DT_CITY' ); ?>:<span class="dtrequired">  *  </span></td>

                    <td align="left"><input id="billingCity" class="inputbox required" type="text" name="billing[city]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->city:'' ?>" />  </td>

                    <td> </td>

                 </tr class="billinginfo">

                   <tr class="billinginfo">

                	<td><?php echo JText::_( 'DT_STATE' ); ?>:<span class="dtrequired">  *  </span></td>

                    <td align="left" > <input id="billingState" class="inputbox required" type="text" name="billing[state]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->state:'' ?>" /> </td>

                    <td> </td>

                 </tr>

		         <tr class="billinginfo">
		            <td><?php echo JText::_( 'DT_ZIPCODE' ); ?>:<span class="dtrequired">  *  </span></td>
		            <td align="left"> <input id="billingZipcode" class="inputbox required" type="text" name="billing[zipcode]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->zipcode:'' ?>" /> </td>
		            <td> </td>
		         </tr>

    <?php 
		$countylist = & DtrTable::getInstance('Field','Table');
		
		$field = $countylist->fingbyName('country');
		
		 if($field){
			 
			 $dropDownDatas=explode("|",$field->values);
			 $value = (isset($tUser->card) && ($tUser->card))?$this->country:$field->selected;
			 $countrydropdown = JHTML::_('select.genericlist', DtHtml::options($dropDownDatas, JText::_("DT_SELECT_COUNTRY")),'billing[country]',' ','value','text',$value);			 
		 }
	?>
     <tr class="billinginfo">
			   <td>
				 <?php echo JText::_('DT_COUNTRY');?>
			   </td>
			   <td>
				 <?php echo $countrydropdown; ?>
			   </td><td> </td>
    </tr>

                 <tr class="billinginfo">
                	<td><?php echo JText::_( 'DT_PHONE' ); ?>:<span class="dtrequired">  *  </span></td>
                    <td align="left"> <input id="billingPhone" class="inputbox required" type="text" name="billing[phone]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->phone:'' ?>" /> </td>
                    <td> </td>
                 </tr>

    <tr class="billinginfo">

          <td><?php echo JText::_( 'DT_CARD_TYPE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

          <td>

            <?php
            $cardtype = array('Visa'=>'Visa','MasterCard'=>'MasterCard','Discover'=>'Discover','American'=>'American');
			$options=DtHtml::options($cardtype);

			echo JHTML::_('select.genericlist', $options,'billing[cardtype]','','value','text',(isset($tUser->card) &&  $tUser->card)?$this->card->cardtype:'');

			?>

          </td>

          <td> </td>

        </tr>
        
         <tr class="billinginfo">

		          <td><?php echo JText::_( 'DT_CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td align="left"><input type="text" name="billing[x_card_num]"  class="inputbox" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->cb_creditcardnumber:''?>" />

		              <br />

		            <?php echo JText::_( 'DT_CARD_NUMBER_EXPLANATION' );?></td>
		
		         <td> </td>

		   </tr>

           <tr class="billinginfo">

		          <td><?php echo JText::_( 'DT_CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		          <td align="left"><input type="text" name="billing[x_exp_date]" value="<?php echo (isset($tUser->card) && $tUser->card)?$this->cb_expdate:''?>" class="inputbox" />

		            &nbsp;&nbsp;(mm/yy)</td>
		
		          <td> </td>

		   </tr>
        
   <!-----------billing-------------- -->
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
     DTjQuery("#UserFeepayment_method").change(function(){
   		
		if(DTjQuery(this).val()=='offline_payment') {
			
			if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}
			
			DTjQuery(".billinginfo").css({display:display});
			DTjQuery("input[name^='billing']").addClass('required');
			
			
		} else {
			DTjQuery(".billinginfo").css({display:'none'});
			DTjQuery("input[name^='billing']").removeClass('required');
		}
		
   });
   DTjQuery("#UserFeepayment_method").trigger('change');
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
	  	submitform(pressbutton);

	}

	return false;

}

</script>
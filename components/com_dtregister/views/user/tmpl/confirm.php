<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid, $xhtml_url, $currency_code;
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
?>
<div id="price_header">
<?php
 //include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
 
	// pr($this->partial_payment_enable);
 
?>
</div>
<?php


  if(DT_Session::get('register.User.process') === 'change'){
  	 if($this->feeObj->changefee > 0){
	     $paying_amount = $this->feeObj->changefee  -  $this->feeObj->paid_amount + ( $this->feeObj->fee - $this->feeObj->changefee);
	 }else{
	     $paying_amount = 0 ;
	 }
	
	 
  }elseif(DT_Session::get('register.User.process') === 'cancel'){
     $paying_amount = $this->feeObj->cancelfee -  $this->feeObj->paid_amount;
  }else{
	 $paying_amount = $this->feeObj->fee - $this->feeObj->paid_amount;
  }
  
  ?>
<form name="frmcart" method="post" action = "index.php?option=com_dtregister&Itemid=<?php echo $Itemid ?>" enctype="multipart/form-data">

   <table>

     <?php

       echo $this->viewFields;

	   echo $this->viewMemFields;
	   
	   if($this->partial_payment_enable && $paying_amount > 0){
	    
	 ?>

     <tr>
     	<td>
         <?php echo JText::_('DT_PARTIAL_PAYMENT');?>: 
        
     	</td>
     	<td>
        <input type="radio" name="partial_payment" value="partial" />
        <input type="text" name="partial_payment_amount" size="10" value="" /> &nbsp;(<?php echo JText::_('DT_DONT_ENTER_CURRENCY');?>)
     	</td>
     </tr>
     
     <tr>
     	<td>
       <?php echo JText::_('DT_DUE_PAYMENT');?>:
     	</td>
     	<td>
       <input type="radio" name="partial_payment" value="full" />
        <input type="hidden" name ="paying_amount" value="<?php echo $paying_amount ; ?>" /> &nbsp;<?php echo   DTreg::displayRate($paying_amount,$currency_code); ?>
     	</td>
     </tr>
     <?php
	   }else{
		 
		 ?>
           <input type="hidden" name ="paying_amount" value="<?php echo $paying_amount; ?>" /> 
         <?php	
			   
	   }
	 ?>
     
     <tr>

     <td colspan="2">

       <input type="button" class="button" onclick="window.location='<?php echo $this->back; ?>'" value="<?php echo JText::_('DT_BACK'); ?>" id="back" name="billingInfo"/>	

       &nbsp;

       <input type="submit" name="confirm" id="next"; value="<?php echo JText::_( 'DT_NEXT_BUTTON' ); ?>"  />

     </td>

     </tr>

   </table>

   <input type="hidden" name="step" value="confirm" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="user" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="confirm" />

</form>
<?php
if(DT_Session::get('register.User.process') != 'duepayment'){

?>
<script type="text/javascript">
   DTjQuery(function(){
	  DTjQuery("#price_header").load("<?php echo JRoute::_("index.php?option=com_dtregister&controller=user&task=price_header&no_html=1&dttmpl=confirm_price_header",$xhtml_url);?>");
  })

</script>
<?php
}
?>
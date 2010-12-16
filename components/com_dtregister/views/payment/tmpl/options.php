<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid , $mainframe;

$document =& JFactory::getDocument();

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/jquery.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/validate.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/validationmethods.js");
if(DT_Session::get('register.User.process')){
  include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
}else{
  ?>
  <div class="componentheading"><?php echo JText::_('DT_EVENT_REGISTRATION')?>: <?php echo JText::_( 'DT_PAYMENT' );?>

		</div>
  <?php	
}
?>

<form name="frmcart" method="post" action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid; ?>" enctype="multipart/form-data">

<table>

<?php

global $Itemid, $xhtml ,$paymentmethod;

$paymentmhd = $this->getModel('paymentmethod');

$paymentmhds = $paymentmhd->getMethods();
$paymentmethods = $paymentmethod ;
$pay_images = $paymentmhd->images;

$paylateroptions=DtHtml::options($paymentmhd->paylater->getOptions(),JText::_( 'DT_SELECT_PAY_OPTIONS' ));

$i=1;

// echo '<pre>'; print_r($pay_images); 
$paymcnt = 0 ;
foreach($paymentmethods as $key=>$method){
	if($method == "pay_later" && DT_Session::get('register.User.process')){
		continue ;
    }
$paymcnt++ ;
// echo '<pre>'; echo $pay_images[$method].'<br>';
  ?>

	 <tr> 

            <td valign="top" width="164">
				<?php if ($method == "GoogleCheckout") { ?>
					<img src="<?php echo $pay_images[$method] ;?>" alt="" align="middle" />
                <?php } else { ?>
                    <img src="<?php echo $pay_images[$method] ;?>" alt="" width="149" height="100" align="middle" />
                <?php } ?>

			</td>

             <td valign="top" ><input type="radio" class="required" id="paymentmethod" name="paymentmethod" value="<?php echo $method; ?>"  /><?php echo $paymentmhds[$method] ;?>

			 <?php 

			  if($method == "pay_later"){

				   echo JHTML::_('select.genericlist', $paylateroptions,'pay_later_option','','value','text');

			  }

			   ?></td>

           </tr>

   	<?php

	$i++ ;

}


if($paymcnt == 1){
	if($method == "pay_later"){
		
		$paymethod_options = $paymentmhd->paylater->getOptions();
		
	   if(count($paymethod_options) == 1){
		    foreach($paymethod_options as $paylateroption=>$pay){
				
			}
	   		$mainframe->redirect("index.php?option=com_dtregister&controller=payment&task=form&paymentmethod=$method&Itemid=$Itemid&pay_later_option=$paylateroption");
	   }
	}else{
		$mainframe->redirect("index.php?option=com_dtregister&controller=payment&task=form&paymentmethod=$method&Itemid=$Itemid");
	}
  	
}

?>

<tr>

 <td>

   <label for="paymentmethod" style="display:none" class="error" generated="true"></label>

 </td>

</tr>

 <tr>

     <td>

       <input type="submit" name="submitpayment" id="next"; value="<?php echo JText::_( 'DT_NEXT_BUTTON' ); ?>"  />

     </td>

     </tr>

 <input type="hidden" name="option" value="com_dtregister" />

 <input type="hidden" name="controller" value="payment" />

 <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

 <input type="hidden" name="task" value="form" />

</table>

</form>

<script type="text/javascript">

 DTjQuery(function(){

   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.frmcart).validate({

	        success: function(label) {

				label.addClass("success");

			}

	});

	 DTjQuery('#pay_later_option').rules('add',{required: function(){

		                      return ( DTjQuery("#paymentmethod:checked").val() == 'pay_later');          

		                   }

                  });

 })

</script>

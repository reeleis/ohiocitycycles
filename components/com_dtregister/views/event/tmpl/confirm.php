<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid,$xhtml_url,$currency_code;
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'event_header.php');

?>
<div>
<?php echo JText::_('DT_CONFIRM_PAGE_HELP'); ?>
</div>

<div id="price_header">
<?php
  //include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'price_header.php');
?>
</div>

<form name="frmcart" method="post" enctype="multipart/form-data">

   <table>

      <?php

	    $temp = $this->feeObj->currentfee;

        if($this->event->partial_payment ==1 && $temp > 0){

			?>

           <?php
                 	if($this->event->partial_minimum_amount!="" && $this->event->partial_minimum_amount > 0 ){
					   $minimum_amount = $this->event->partial_minimum_amount;
					}else{
					    $minimum_amount = $this->event->partial_amount;
					}
				 ?>

			<tr><td><?php echo JText::_( 'DT_DEPOSIT_AMOUNT'); ?></td>
               
               <td><input type="text" name="paying_amount" id="paying_amount" value="<?php echo  $minimum_amount; ?>" />

              ( <?php echo JText::_( 'DT_MINIMUM_DEPOSIT'); ?> = 

               <?php echo DTreg::displayRate($this->event->partial_minimum_amount,$currency_code); ?> )

                  <label for="paying_amount" generated="true" class="error" style="display:none"></label>
			  
                <script type="text/javascript">
                    DTjQuery(function(){
				         
				         DTjQuery(document.frmcart).validate();
						 DTjQuery.validator.messages.required = " ";
						 DTjQuery.validator.messages.min = " ";
						 DTjQuery("#paying_amount").rules("add", {
													   min: <?php echo $minimum_amount;  ?>
													  });

					});

				 </script>
                
                </td>

            </tr>

            <tr></tr>

            <?php

            }else if($this->event->partial_payment == 2 && $temp > 0){

			 ?>

             <tr>

               <td>
                 <?php
                 	if($this->event->partial_minimum_amount!="" && $this->event->partial_minimum_amount  > 0 ){
					   $minimum_amount = $this->event->partial_minimum_amount;
					}else{
					    $minimum_amount = $this->event->partial_amount;
					}
				 ?>
                 <input type="" readonly="readonly" value="<?php echo $minimum_amount; ?>" name="paying_amount" />

                  ( <?php  echo JText::_( 'DT_DEPOSIT_AMOUNT'); ?> = 

               <?php echo DTreg::displayRate($this->event->partial_amount,$currency_code); ?> )

               </td>

             </tr>

             <?php

			}else{

			  ?>

              <input type="hidden" name ="paying_amount" value="<?php echo $this->paying_amount; ?>" />

              <?php	

		    }

		?>

     <?php

       echo $this->viewFields;

	   echo $this->viewUserField();

	   echo $this->viewMemFields;

	 ?>

     <tr>

     <td colspan="2"> 

       <input type="button" class="button" onclick="window.location='<?php echo $this->back ; ?>'" value="<?php echo JText::_('DT_BACK'); ?>" id="back" name="billingInfo"/>	

       &nbsp;

       <input type="submit" name="confirm" class="button" id="next"; value="<?php echo JText::_( 'DT_NEXT_BUTTON' ); ?>" />

     </td>

     </tr>

   </table>

   <input type="hidden" name="step" value="confirm" />

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="event" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="confirm" />

</form>
<script type="text/javascript">
  DTjQuery(function(){
	  DTjQuery("#price_header").load("<?php echo JRoute::_("index.php?option=com_dtregister&controller=event&task=price_header&no_html=1&dttmpl=confirm_price_header",$xhtml_url);?>");
  })
</script>
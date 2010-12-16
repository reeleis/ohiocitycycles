<table>
 
  <tr><td><?php echo JText::_('DT_EVENT_NAME') ?>: </td><td><?php echo $this->user->TableEvent->displaytitle(); ?></td></tr>
  <tr><td><?php echo JText::_('DT_EVENT_DATE') ?>: </td><td><?php echo $this->user->TableEvent->displaydate(); ?></td></tr>
  <?php 
  echo  $this->userdata ;
  
  ?>
 <tr><td><?php  echo  JText::_('DT_REGISTRATION_FEE') ?>: </td><td><?php echo  DTreg::displayRate($this->user->fee->fee); ?></td></tr>
 <tr><td><?php  echo  JText::_('DT_AMOUNT_PAID') ?>: </td><td><?php  echo DTreg::displayRate($this->user->fee->paid_amount); ?></td></tr>
 <tr><td><?php  echo  JText::_('DT_CONFIRMATION_NUMBER') ?>: </td><td><?php  echo $this->user->confirmNum; ?></td></tr>
 
  <tr><td><?php  echo JText::_('DT_PAYMENT_TYPE') ?>: </td><td><?php  echo $this->paymentmethods[$this->user->fee->payment_type]; ?></td></tr>
 <?php
  if($this->user->discount_code_id != 0 && $this->user->discount_code_id !=''){
?>
		  

			<tr><td><?php  echo JText::_('DT_DISCOUNT_CODE') ?>: </td><td><?php  echo  $this->user->TableDiscountcode->code ?></td></tr>
<?php
  }

 ?>
 <?php 
 global $barCodeImagetypeToExt , $barcode_image_type ;
  $barcodePath =JURI::root( false )."images/dtregister/barcode/".$this->user->confirmNum.".".$barCodeImagetypeToExt[$barcode_image_type];
  $barcodeImg = '<img border="0" src="'.$barcodePath.'" />';
  if($barcode_enable){
     echo "<tr><td>".JText::_('DT_BARCODE').": </td><td>".$barcodeImg."</td></tr>";
  }
 ?> 
</table>
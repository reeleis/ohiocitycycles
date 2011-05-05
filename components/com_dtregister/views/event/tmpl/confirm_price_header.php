<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

?>

<div id="dt_pricebox">
  
	  <?php
       global $currency_code,$show_price_tax,$show_fee_breakdown;
       
       $mEvent = $this->getModel('event');
       $tEvent = $mEvent->table;
       $tEvent->load(DT_Session::get('register.Event.eventId'));
	   $tEvent->overrideGlobal(DT_Session::get('register.Event.eventId'));
       //pr($tEvent);
       $userIndex = DT_Session::get('register.Setting.current.userIndex');
       $TableUser =& DtrTable::getInstance('Duser','Table');
	   $TableUser->create(DT_Session::get('register.User.'.$userIndex));
	   
	   $feeObj = new DT_Fee($tEvent,$TableUser);
	   $juser = JFactory::getUser();
	   
	   $feeObj->getFee($juser->id);
	   // pr( $feeObj->slab->type);
		if($feeObj->paid_fee > 0){
			$memtot =  $TableUser->memtot;
			$discount = $feeObj->memberdiscount + $feeObj->birddiscount + $feeObj->discountcodefee;
			?>
            <strong><?php echo JText::_( 'TOTAL_REGISTRATION_COST' );?>:</strong> <?php echo  DTreg::displayRate($feeObj->paid_fee,$currency_code); ?>
           <?php if($show_fee_breakdown) {?>
            <br /><div id="dt_price_breakdown">
			<?php echo JText::_( 'DT_REGISTRATION_FEE' ); ?>:&nbsp;

			<?php 
			
			if ($feeObj->slab->type == "flat") {
				echo $TableUser->memtot ."&nbsp;".JText::_('DT_MEMBERS')."&nbsp;=&nbsp;". DTreg::displayRate($feeObj->basefee,$currency_code);
			} else {
				echo $TableUser->memtot ."&nbsp;x&nbsp;". DTreg::displayRate($feeObj->basefee/$TableUser->memtot,$currency_code);
			}
			
			if ($discount>0){
				if($feeObj->memberdiscount>0)
				  echo "<br />".JText::_( 'DT_MEMBER_DISCOUNT' ).": ".DTreg::displayRate($feeObj->memberdiscount,$currency_code); 
				if($feeObj->birddiscount>0)
				  echo "<br />".JText::_( 'DT_BIRD_DISCOUNT' ).": ".DTreg::displayRate($feeObj->birddiscount,$currency_code);
				if($feeObj->discountcodefee > 0){
			      echo "<br />"."<strong>".JText::_( 'DT_DISCOUNT_CODE_APPLIED').": ".DTreg::displayRate($feeObj->discountcodefee,$currency_code). '</strong>';
				}elseif(isset($this->discountCodeError) && $this->discountCodeError = ""){
				   	echo "<br />".$this->discountCodeError;
				}
			} 
		    if ($feeObj->latefee>0){
				 echo "<br />".JText::_( 'DT_LATE_FEE' ).": ".DTreg::displayRate($feeObj->latefee,$currency_code); 
			}
			
			if($feeObj->customfee != 0 && $feeObj->customfee !="" && is_array($feeObj->fieldfee)){
				foreach($feeObj->fieldfee as $key=>$feefield){
					if($feefield['fee'] != 0) {
				   echo "<br />".$feefield['field']->label.": ".DTreg::displayRate($feefield['fee'],$currency_code);
					}
				}

			}
			
			if($feeObj->tax >0 && $show_price_tax){
			    echo "<br />".JText::_( 'DT_TAX' ).": ".DTreg::displayRate($feeObj->tax,$currency_code); 
			}
			
			?></div>

		<?php 
		}
	}

	?>

</div>
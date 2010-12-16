<div>
  
	  <?php
       global $currency_code ;
       
       $mEvent = $this->getModel('event');
       $tEvent = $mEvent->table ;
       $tEvent->load(DT_Session::get('register.Event.eventId'));
	   $tEvent->overrideGlobal(DT_Session::get('register.Event.eventId'));
       //pr($tEvent);
       $userIndex = DT_Session::get('register.Setting.current.userIndex');
       $TableUser  =& DtrTable::getInstance('Duser','Table');
	   $TableUser->create(DT_Session::get('register.User.'.$userIndex));
	   
	   $feeObj = new DT_Fee($tEvent,$TableUser);
	   $juser = JFactory::getUser();
	   
	   $feeObj->getFee($juser->id);
	  //pr( $feeObj) ;
		if($feeObj->paid_fee > 0){
			$memtot =  $TableUser->memtot ;
			$discount = $feeObj->memberdiscount + $feeObj->birddiscount + $feeObj->discountcodefee ;
			?>
            <strong><?php echo JText::_( 'TOTAL_REGISTRATION_COST' );?>:</strong> <?php echo  DTreg::displayRate($feeObj->paid_fee,$currency_code); 
           			
           
		}

	?>

</div>
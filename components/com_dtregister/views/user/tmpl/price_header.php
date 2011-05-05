<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

?>

<div>
  
	  <?php
       global $currency_code;
       
       $mEvent = $this->getModel('event');
       $tEvent = $mEvent->table;
	 
       $tEvent->load(DT_Session::get(DT_Session::get('register.User.eventId')));
	   $tEvent->overrideGlobal(DT_Session::get('register.User.eventId'));
       //pr($tEvent);
       
       $TableUser  =& DtrTable::getInstance('Duser','Table');
	   $userdata =  DT_Session::get('register.User');
	    if(isset($_REQUEST['key']) && $_REQUEST['key'] == ""){
			$members = $userdata['members'];
			$userdata['memtot']++;
			$newmember =  $_POST['Member'];
			$newmember['fields'] = JRequest::getVar('Field',array(),null,'array');
			$members[] = $newmember;
			$userdata['members'] = $members;
			foreach($userdata['members'] as $key => $dm){}
			?>
			 <script type="text/javascript">
			    //DTjQuery("input[name='key']").val('<?php //echo $key; ?>');
			 </script>
			<?php
		}
			   
	   $TableUser->create($userdata);
	   
	   $feeObj = new DT_Fee($tEvent,$TableUser);
	   $juser = JFactory::getUser();
	   
	   $feeObj->getFee($juser->id);
	  // pr(get_object_vars($feeObj));
	  //pr( $feeObj);
		if($feeObj->paid_fee > 0){
			$memtot = $TableUser->memtot;
			$discount = $feeObj->memberdiscount + $feeObj->birddiscount + $feeObj->discountcodefee;
			?>
            <strong><?php echo JText::_( 'TOTAL_REGISTRATION_COST' );?>:</strong> <?php echo  DTreg::displayRate($feeObj->paid_fee,$currency_code); 
         
		}

	?>

</div>
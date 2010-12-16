<?php
global $event_show_date ;
$HeventTable = $this->getModel('event')->table ;
$HeventTable->load($this->header_eventId);
$HeventTable->overrideGlobal($HeventTable->slabId);
$duepayment = 'DT_MAKE_PAYMENT';
$cancel = 'DT_CANCELLATION';
$change = 'DT_EDIT_RECORD';
$var = DT_Session::get('register.User.process');

?>
<div class="componentheading"><?php echo JText::_( $$var  );?>:

		<?php


			echo $HeventTable->title." "  ;

            if($event_show_date){
               echo "(".$HeventTable->displaydateheader(' ').")" ;
			}
			
		?></div>
<?php unset($HeventTable); ?>
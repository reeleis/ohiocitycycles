<?php
global $event_show_date ;
$HeventTable = $this->getModel('event')->table ;
$HeventTable->load($this->header_eventId);
$HeventTable->overrideGlobal($HeventTable->slabId);

?>
<div class="componentheading"><?php echo JText::_( 'DT_REGISTRATION' );?>:

		<?php


			echo $HeventTable->title." "  ;

            if($event_show_date){
               echo "(".$HeventTable->displaydateheader(' ').")" ;
			}
			
		?></div>
<?php unset($HeventTable); ?>
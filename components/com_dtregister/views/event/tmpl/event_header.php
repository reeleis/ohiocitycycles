<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $event_show_date;
$HeventTable = $this->getModel('event')->table;
$HeventTable->load($this->header_eventId);
$HeventTable->overrideGlobal($HeventTable->slabId);

?>
<div class="componentheading"><?php echo JText::_( 'DT_REGISTRATION' );?>:

		<?php

			echo $HeventTable->title." " ;

            if($event_show_date){
               echo "(".$HeventTable->displaydateheader(' ').")";
			}
			
		?></div>
<?php unset($HeventTable); ?>
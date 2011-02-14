<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/
$type = array('I'=>JText::_('DT_INDIVIDUAL'),'G'=>JText::_('DT_GROUP'));
global $currency_code;
$config = $this->getModel('config');
$this->event->overrideGlobal($this->event->slabId);

?>

<tr>

 <td>

   <?php echo $this->event->displayTitle(); ?>

 </td>

 <td>

   <?php echo $type[$this->registration['type']];?>

 </td>

 <td>

   <?php echo DTreg::displayRate($this->registration['fee']['paid_amount'],$config->getGlobal('currency_code','USD'));?>

 </td>

 <td>

   <a href="<?php echo JRoute::_('index.php?option=com_dtregister&controller=event&task=cartRemove&userIndex='.$this->index) ?>"  /><img src="<?php echo Juri::root(); ?>/components/com_dtregister/assets/images/publish_x.png" border="0" height="16" width="16" alt="Remove"></a>

 </td>

</tr>

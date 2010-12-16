<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

global $Itemid, $xhtml;
// pr(DT_Session::get('register.User'));

$eventTable = $this->getModel('event')->table;

$events = array();

$html = "";

foreach(DT_Session::get('register.User') as $key=>$registration){

	if(!isset($events[$registration['eventId']])){

	   $eventTable->load($registration['eventId']);

	   $events[$registration['eventId']] = $eventTable;

	}

    if(isset($registration['remove']) && $registration['remove']==1){

		continue;

    }

	$event = $events[$registration['eventId']];

	$this->assign('index',$key);

	$this->assign('event',$event);

	$this->assign('registration',$registration);

	$html .= $this->loadTemplate('row');

}

global $event_show_date;

?>
<div class="componentheading"><?php echo JText::_('DT_EVENT_REGISTRATION')?>: <?php echo JText::_( 'DT_MY_CART' );?>

</div>

<form action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid; ?>" method="post" class="adminform" enctype="multipart/form-data">

<table class="adminlist">

<tr>

 <th class="dt_heading">

   <?php echo JText::_('DT_EVENT');?>

 </th>

 <th class="dt_heading">

   <?php echo JText::_('DT_TYPE');?>

 </th>

 <th class="dt_heading">

   <?php echo JText::_('DT_PRICE');?>

 </th>
 
 <th class="dt_heading">

   <?php echo JText::_('DT_REMOVE');?>

 </th>

</tr>

  <?php echo $html; ?>

  <tr>

    <td colspan="4">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="4">

      <input type="button" value="<?php echo JText::_('DT_REGISTER_ANOTHER_EVENT'); ?>" id="continue" />

      <input type="submit" value="<?php echo JText::_('DT_CHECKOUT'); ?>" id="checkout" />

    </td>

  </tr>

</table>

   <input type="hidden" name="option" value="com_dtregister" />

   <input type="hidden" name="controller" value="payment" />

   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

   <input type="hidden" name="task" value="methods" />

 </form>

 <script type="text/javascript">

    DTjQuery(function(){

		 DTjQuery("#continue").click(function(){

			 window.location = "<?php echo JRoute::_("index.php?option=com_dtregister&Itemid=".$Itemid."&cart=continue" ,false); ?>"; // $xhtml

			 return false;		 	 

		 });	

	});

 </script>
<?php

/**
* @version 2.7.6
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid,$full_message;

$eventTable = $this->getModel('event')->table;

$tEvent = $this->tEvent;

$max_group_size = ($tEvent->max_group_size == '' || $tEvent->max_group_size == 0)?'unlimited':$tEvent->max_group_size;
$min_group_size = ($tEvent->min_group_size == '' || $tEvent->min_group_size == 0)?1:$tEvent->min_group_size;

$registered = $tEvent->getTotalregistered($tEvent->slabId);

$tEvent->max_registrations;

if($tEvent->max_registrations == 0 || $tEvent->max_registrations == ""){ 
	$availableSpots = "unlimited";
}elseif ($tEvent->max_registrations > $registered) {
	$availableSpots = $tEvent->max_registrations - $registered;
	if($max_group_size == 'unlimited' || intval($max_group_size) > $availableSpots){
		$max_group_size = $availableSpots;
	}
	
} else {
	$availableSpots = 0;
	$max_group_size = 0;
	$min_group_size = 0;
}

include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'event_header.php');
?>

<div>
  <?php
     $message = ($registered >= $tEvent->max_registrations && $tEvent->max_registrations > 0)?$full_message:$this->tEvent->topmsg;
	
	 echo ($message!="")?$message."<br /><br />":'';
  ?>
</div>

<script language="JavaScript">
function validateForm(){

	var max = '<?php if ($max_group_size > $availableSpots && $availableSpots !="unlimited") echo $availableSpots; else echo $max_group_size; ?>';
	var min = <?php echo $min_group_size; ?>;
	var availableSpots = '<?php echo $availableSpots; ?>';
		
		if (isNaN(parseInt(document.frmcart.memtot.value)))
		{
			alert ("<?php echo JText::_('DT_ALERT_ENTER_NUM_MEMBERS'); ?>");
			return false;
		}
		if ((parseInt(document.frmcart.memtot.value) < min || ( parseInt(document.frmcart.memtot.value) > max &&  parseInt(max) !=0 )) && max !="unlimited" )
		{
			alert ("<?php echo JText::_('DT_ALERT_GROUP_MEMBER_RANGE'); ?> "+ min +" - "+ max +".");
			return false;
		}
	
		 if(parseInt(document.frmcart.memtot.value) > parseInt(max) && parseInt(max) !=0 && max =="unlimited" ){

            alert("<?php echo JText::_( 'DT_MAX_GROUP_REGISTRATIONS' ); ?> "+parseInt(max));
            return false;
         }
		 
		  if(parseInt(document.frmcart.memtot.value) < parseInt(min) && parseInt(min) !=0 ){

            alert("<?php echo JText::_( 'DT_MIN_GROUP_REGISTRATIONS' ); ?> "+parseInt(min));
            return false;
         }	
        
		<?php if ($tEvent->waiting_list == '2') { ?>
			return true;
		<?php } else { ?>
				if (parseInt(availableSpots) == 0 && availableSpots !='unlimited') {
					alert ("<?php echo JText::_('DT_ALERT_REGISTRATION_CLOSED_FOR_THIS_EVENT'); ?>");			
					return false;
				}
		<?php } ?>
		 
	return true;
}
</script>


<form name="frmcart" method="post" action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid ?>" enctype="multipart/form-data" onSubmit="return validateForm();">

 <table style="float:left;"><tr><td><?php echo JText::_( 'GROUP_NUMBER' );?>: </td><td>
  <input type="text" size="4" name="memtot" id="memtot" /></td> </tr>
  <tr><td colspan="2">
  
  <input type="button" value="<?php echo JText::_( 'DT_BACK' );?>" class="button" onclick="window.location='<?php echo JRoute::_('index.php?option=com_dtregister&controller=event&task=register&eventId='. $tEvent->slabId) ?>'"  />
  &nbsp;
  <input type="submit" value="<?php echo JText::_( 'DT_NEXT_BUTTON' );?>" class="button"  /></td></tr>
  </table>
  <input type="hidden" name="option" value="com_dtregister" />
  <input type="hidden" name="controller" value="event" />
  <input type="hidden" name="task" value="groupNum" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />
</form>

 <script type="text/javascript">

    //<![CDATA[

	  function groupdetails(){

		 return true;

	  	// check that there is a value and it is a number

		  var max=<?php echo $max_group_size==''?0:$max_group_size; ?>;

          var min =<?php echo $min_group_size; ?>;

		  if(document.frmcart.memtot.value== '' || document.frmcart.memtot.value.charAt(0)==''|| isNaN(parseInt(document.frmcart.memtot.value))){
		  	alert("<?php echo JText::_( 'GROUP_NUMBER' ); ?>");
		  	return;
	  	  }

	  // check that the number is less than the number of available spots

	  if(spots!=-1){

		  if(document.frmcart.memtot.value>spots){

		  alert("<?php echo JText::_( 'DT_THERE_ARE_ONLY' ); ?> "+spots +" <?php echo JText::_( 'DT_AVAIL_REGISTER_SPOTS' ); ?>");

		  return;

		  }

	  }

	  if(document.frmcart.memtot.value > max && max !=0){

	  	alert("<?php echo JText::_( 'DT_MAX_GROUP_REGISTRATIONS' ); ?>"+max);

	  	return;

	  }

	  // check that the number is more than one

		if(document.frmcart.memtot.value > max)	{

			alert("<?php echo JText::_( 'DT_REGISTRANTS_MORE_THAN' ); ?>");

			return false;

		}
		
		if(document.frmcart.memtot.value < min)	{

			alert("<?php echo JText::_( 'DT_REGISTRANTS_LESS_THAN_REQUIRED' ); ?>");

			return false;

		}

	  document.frmcart.submit();

  }

    //]]>

  </script>
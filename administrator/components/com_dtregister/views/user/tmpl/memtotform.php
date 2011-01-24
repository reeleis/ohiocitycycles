<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid;

$eventTable = $this->getModel('event')->table;
$eventTable->load($this->eventId);
$registered = $eventTable->getTotalregistered($this->eventId);
$max_registrations = $eventTable->max_registrations;

$max_group_size = ($eventTable->max_group_size == '')?'unlimited':$eventTable->max_group_size;
$min_group_size = ($eventTable->min_group_size == '')?1:$eventTable->min_group_size;


if($eventTable->max_registrations == 0 || $eventTable->max_registrations == ""){ 
	$availableSpots = "unlimited";
}elseif ($max_registrations > $registered) {
	$availableSpots = $max_registrations - $registered;
	if($max_group_size == 'unlimited' || intval($max_group_size) > $availableSpots){
		$max_group_size = $availableSpots ;
	}
} else {
	$availableSpots = 0;
	$max_group_size = 0;
	$min_group_size = 0;
}

?>

<script language="JavaScript">
function validateForm(){

	var max = '<?php if ($max_group_size > $availableSpots && $availableSpots !="unlimited") echo $availableSpots; else echo $max_group_size; ?>';
	var min = <?php echo $min_group_size; ?>;
	var availableSpots = '<?php echo $availableSpots; ?>';
	
	if (parseInt(availableSpots) == 0 && availableSpots !='unlimited') {
		alert ("<?php echo JText::_('DT_ALERT_FULL_EVENT'); ?>");
		return false;	
	}
	
	
		
		if (isNaN(parseInt(document.adminForm.memtot.value)))
		{
			alert ("<?php echo JText::_('DT_ALERT_ENTER_NUM_MEMBERS'); ?>");
			return false;
		}
	
	    if ((parseInt(document.adminForm.memtot.value) < min || ( parseInt(document.adminForm.memtot.value) > max &&  parseInt(max) !=0 )) && max !="unlimited" )
		{
			alert ("<?php echo JText::_('DT_ALERT_GROUP_MEMBER_RANGE'); ?> "+ min +" - "+ max +".");
			return false;
		}
		
		if(parseInt(document.adminForm.memtot.value) > parseInt(max) && parseInt(max) !=0 && max =="unlimited" ){

            alert("<?php echo JText::_( 'DT_MAX_GROUP_REGISTRATIONS' ); ?> "+parseInt(max));
            return false ;
         }
		 
		  if(parseInt(document.adminForm.memtot.value) < parseInt(min) && parseInt(min) !=0 ){

            alert("<?php echo JText::_( 'DT_MIN_GROUP_REGISTRATIONS' ); ?> "+parseInt(min));
            return false ;
         }	
		
	
	
	// return true;
}
</script>

<form name="adminForm" method="post" action="index.php" enctype="multipart/form-data" onSubmit="return validateForm();">
   <table>
      <tr>
         <td>
           <?php echo JText::_( 'DT_REGISTRANTS'); ?>
         </td>
         <td>
           <input type="text" name="memtot" id="memtot" value="" class="inputbox required" />
         </td>
      </tr>
  
   </table>
   <input type="hidden" name="option" value="com_dtregister" />
   <input type="hidden" name="controller" value="user" />
   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
   <input type="hidden" name="task" value="memtotform" />
   <input type="hidden" name="formsubmit" value="1" />
</form>
<div id="debug">
</div>
<script type="text/javascript">
 
 
 DTjQuery(function(){
   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.adminForm1).validate({
	        success: function(label) {
				label.addClass("success");
			}

	});
	
	
 })
 
 function submitbutton(pressbutton){
    submitform(pressbutton);
	if(DTjQuery(document.adminForm1).valid()){
	  	submitform(pressbutton);
	}
	
	return false;

}

</script>
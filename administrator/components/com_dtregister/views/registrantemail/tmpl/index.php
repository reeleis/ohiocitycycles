<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $mainframe;
$mevent = $this->getModel('event');
$TableUser = $this->getModel('user')->table;
$status = '';
$attend = '';

$event_options = DtHtml::options($mevent->table->optionslist(),JText::_('DT_SELECT_EVENT'));

?>

	<form name="adminForm" id="emailRegitration" method="post" action="index.php">

	  <table cellpadding="4" cellspacing="1" border="0">

        <tr><td colspan="4"><?php echo JText::_( 'DT_EMAIL_REG_INSTRUCTIONS' ); ?></td></tr>
    
		<tr><td><?php echo JText::_( 'DT_SELECT_EVENT' ); ?>:</td>
			<td><?php echo JHTML::_('select.genericlist', $event_options,'event_id',' class="required" ','value','text','');?></td>
			<td></td></tr>

        <tr><td><?php echo JText::_( 'DT_PAYMENT_STATUS' ); ?>:</td>
	        <td>
                <?php  echo JHTML::_('select.genericlist', DtHtml::options(array(0=>JText::_('DT_PAID'),1=>JText::_('DT_NOT_PAID'),2=>JText::_('DT_BOTH'))),'search[fee_status]',' ','value','text',2) ?>
                <?php $options = array('1'=>JText::_('DT_INCLUDE_FREE_RECORDS'));
	                  echo DtHtml::checkboxList('search[free]',$options,array(1));
	            ?>
            </td>
            <td align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EMAILREG_PAYSTATUS_HELP' )), '', 'tooltip.png', '', ''); ?></td>
	    </tr>
    
        <tr><td><?php echo JText::_( 'DT_ATTENDED' ); ?>:</td>
	        <td>
                <?php echo JHTML::_('select.genericlist', DtHtml::options(array(0=>JText::_('DT_ATTENDED'),1=>JText::_('DT_NOT_ATTENDED'),2=>JText::_('DT_BOTH'))),'search[attend]','','value','text',2)?>
            </td>
            <td align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EMAILREG_ATTENDED_HELP' )), '', 'tooltip.png', '', ''); ?></td>
	    </tr>
    
        <tr><td><?php echo JText::_( 'DT_STATUS' ); ?>:</td>
	        <td>
                <?php echo DtHtml::checkboxList('search[status]',$TableUser->statustxt,array(0,1)); ?>
            </td>
            <td align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EMAILREG_STATUS_HELP' )), '', 'tooltip.png', '', ''); ?></td>
	    </tr>

	    <tr><td><?php echo JText::_( 'DT_FROM_NAME' ); ?>:</td>
		    <td><input type="text" name="from_name" size="50" value="<?php echo $mainframe->getCfg('fromname');?>" /></td>
            <td></td>
        </tr>
      
        <tr><td><?php echo JText::_( 'DT_FROM_EMAIL' ); ?>:</td>
	        <td><input type="text" name="from_email" size="50" value="<?php echo $mainframe->getCfg('mailfrom');?>" /></td>
	        <td></td></tr>

		<tr><td><?php echo JText::_( 'DT_SUBJECT' ); ?>:</td>
			<td><input type="text" class="required" name="subject" size="50" /></td>
			<td></td></tr>
        
        <tr><td><?php echo JText::_( 'DT_BCC' ); ?>:</td>
	        <td><input type="text" name="bcc" size="50" /></td>
	        <td align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_BCC_HELP' )), '', 'tooltip.png', '', ''); ?></td></tr>

		<tr>

			<td valign="top" style="width:100px;"><?php echo JText::_( 'DT_MESSAGE' ); ?>:</td>

			<td>

				<?php

					$editor =& JFactory::getEditor();

					if ($mainframe->getCfg('com_show_editor_buttons')) {

                    	$t_buttons = explode(',', $mainframe->getCfg('com_editor_button_exceptions'));

                    } else {

                    	// hide all

                        $t_buttons = false;

                    }

                    echo $editor->display( 'content', isset($row->content)?$row->content:'', "100%", 250, '70', '10', $t_buttons);

				?>

			</td>
			
			<td align="left" valign="top">
				
				<div style="padding:5px 5px 5px 15px;">

                <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

                <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

                <br />[EVENT_TIME] - <?php echo JText::_( 'DT_TAG_EVENT_TIME' );?>
                
                <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

                <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

                <br />[GROUP_NUMBER] - <?php echo JText::_( 'DT_TAG_GROUP_NUMBER' ); ?>

                <br />[AMOUNT] - <?php echo JText::_( 'DT_TAG_AMOUNT' );?>
                
                <br />[AMOUNT_PAID] - <?php echo JText::_( 'DT_TAG_AMOUNT_PAID' );?>
                
                <br />[AMOUNT_DUE] - <?php echo JText::_( 'DT_TAG_AMOUNT_DUE' );?>

                <br />[AMOUNT_NOTAX] - <?php echo JText::_( 'DT_TAG_AMOUNT_NOTAX' );?>

                <br />[TAX] - <?php echo JText::_( 'DT_TAG_TAX' );?>

                <br />[PAYMENT_TYPE] - <?php echo JText::_( 'DT_TAG_PAYMENT_TYPE' );?>

                <br />[TRANS_ID] - <?php echo JText::_( 'DT_TAG_TRANS_ID' );?>

                <br />[CONFIRM_NUM] - <?php echo JText::_( 'DT_TAG_CONFIRM_NUM' );?>

                <br />[BARCODE] - <?php echo JText::_( 'DT_TAG_BARCODE' );?>
                
                <br />[STATUS] - <?php echo JText::_( 'DT_TAG_STATUS' );?>
                
                <br />[PAID_STATUS] - <?php echo JText::_( 'DT_TAG_PAID_STATUS' );?>

                <br />[USERNAME] - <?php echo JText::_( 'DT_TAG_USERNAME' );?>

                <br />[DATE_REGISTERED] - <?php echo JText::_( 'DT_TAG_DATE_REGISTERED' );?>

	            <br />[ALL_FIELDS] - <?php echo JText::_( 'DT_TAG_ALL_FIELDS' );?>

                </div>

            </td>

		</tr>

	</table>

	<input type="hidden" name="option" value="com_dtregister" />
    
    <input type="hidden" name="controller" value="registrantemail" />

	<input type="hidden" name="task" value="" />

</form>
<?php
$document =& JFactory::getDocument();

  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/form.js');
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validate.js');
?>
     <script language="JavaScript" type="text/javascript">

	   DTjQuery(function(){
            DTjQuery(document.adminForm).validate({
				success: function(label) {
					label.addClass("success");
				}

	        });
	   });
 
function submitbutton(pressbutton){
    
	if(pressbutton == "cancel"){
	   	submitform(pressbutton);
		return;
	}
	if(DTjQuery(document.adminForm).valid()){
	  	submitform(pressbutton);
	}
	
	return false;

}
</script>
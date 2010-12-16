<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $mainframe;
$mevent = $this->getModel('event');
$options=DtHtml::options($mevent->table->optionslist(),JText::_('DT_SELECT_EVENT'));

?>

	<form name="adminForm" id="emailRegitration" method="post" action="index.php">

	  <table cellpadding="4" cellspacing="1" border="0" >

    <tr><td colspan="4"><?php echo JText::_( 'DT_EMAIL_REG_INSTRUCTIONS' ); ?></td></tr>

	  <tr><td><?php echo JText::_( 'DT_FROM_NAME' ); ?>:</td><td><input type="text" name="from_name" size="50" value="<?php echo $mainframe->getCfg('fromname');?>" /></td>
     <td></td>
       <td rowspan="6" valign="bottom">
    
          <div style="padding:5px 5px 5px 15px;">

                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
                 
                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

                 <br />[GROUP_NUMBER] - <?php echo JText::_( 'DT_TAG_GROUP_NUMBER' ); ?>

                 <br />[AMOUNT] - <?php echo JText::_( 'DT_TAG_AMOUNT' );?>
                 
                 <br />[AMOUNT_PAID] - <?php echo JText::_( 'DT_TAG_AMOUNT_PAID' );?>
                 
                 <br />[AMOUNT_DUE] - <?php echo JText::_( 'DT_TAG_AMOUNT_DUE' );?>

                 <br />[AMOUNT_NOTAX] - <?php echo JText::_( 'DT_TAG_AMOUNT_NOTAX' );?>

                 <br />[TAX] - <?php echo JText::_( 'DT_TAG_TAX' );?>

                 <br />[PAYMENT_TYPE] - <?php echo JText::_( 'DT_TAG_PAYMENT_TYPE' );?>

                 <br />[CONFIRM_NUM] - <?php echo JText::_( 'DT_TAG_CONFIRM_NUM' );?>

                 <br />[BARCODE] - <?php echo JText::_( 'DT_TAG_BARCODE' );?>
                 
                 <br />[STATUS] - <?php echo JText::_( 'DT_TAG_STATUS' );?>
                 
                 <br />[PAID_STATUS] - <?php echo JText::_( 'DT_TAG_PAID_STATUS' );?>

                 <br />[USERNAME] - <?php echo JText::_( 'DT_TAG_USERNAME' );?>

                 <br />[DATE_REGISTERED] - <?php echo JText::_( 'DT_TAG_DATE_REGISTERED' );?>

                 </div>
                 
        </td>
    
    </tr>

	  <tr><td><?php echo JText::_( 'DT_FROM_EMAIL' ); ?>:</td><td><input type="text" name="from_email" size="50" value="<?php echo $mainframe->getCfg('mailfrom');?>" /></td><td></td></tr>

		<tr><td><?php echo JText::_( 'DT_SELECT_EVENT' ); ?>:</td><td><?php echo JHTML::_('select.genericlist', $options,'event_id',' class=" required " ','value','text','');?></td><td></td></tr>

		<tr><td><?php echo JText::_( 'DT_SUBJECT' ); ?>:</td><td><input type="text" class="required" name="subject" size="50" /></td><td></td></tr>
        
        <tr><td><?php echo JText::_( 'DT_BCC' ); ?>:</td><td><input type="text" name="bcc" size="50" /> &nbsp; &nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_BCC_HELP' )), '', 'tooltip.png', '', ''); ?></td><td>
         
        </td></tr>

		<tr>

			<td valign="top" style="width:100px;"><?php echo JText::_( 'DT_MESSAGE' ); ?>:</td>

			<td >

				<?php

					$editor =& JFactory::getEditor();

					if ($mainframe->getCfg('com_show_editor_buttons')) {

                    	$t_buttons = explode(',', $mainframe->getCfg('com_editor_button_exceptions'));

                    } else {

                    	// hide all

                        $t_buttons = false;

                    }

                    echo $editor->display( 'content', isset($row->content)?$row->content:'',  "100%", 250, '70', '10',  $t_buttons) ;

				?>

			</td>

		</tr>

	</table>

	<input type="hidden" name="option" value="com_dtregister" />
    
    <input type="hidden" name="controller" value="registrantemail" />

	<input type="hidden" name="task" value="" />

</form>
<?php
$document	=& JFactory::getDocument();

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
 
		 /*function submitbutton(pressbutton)

		{

			data = DTjQuery('#emailRegitration').formSerialize()+pressbutton+'&no_html=1';

			DTjQuery.post('index2.php', data,function(){},'script');

			return false;

		}*/
function submitbutton(pressbutton){
    
	if(pressbutton == "cancel"){
	   	submitform(pressbutton);
		return ;
	}
	if(DTjQuery(document.adminForm).valid()){
	  	submitform(pressbutton);
	}
	
	return false ;

}
</script>
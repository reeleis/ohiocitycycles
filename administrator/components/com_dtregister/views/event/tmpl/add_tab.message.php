<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$editor =& JFactory::getEditor();
$row = $this->row;
?>

<table class="adminform" width="100%" cellpadding="10" cellspacing="10">

      <tr align="center" valign="middle">

       <td width="20%" align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_INSTRUCTIONS' ); ?>:</strong></td>

       <td width="400" align="left" valign="top" style="width:620px"><?php echo $editor->display("data[event][topmsg]",stripslashes($row->topmsg),'','','70','20','0'); ?></td>

	   <td colspan="2" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_INSTRUCTIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

	  <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_DESCRIPTION' ); ?>:</strong>

        	<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][event_describe_set]","",$row->event_describe_set); ?>

      </td>

     	<td align="left" valign="top"><?php echo $editor->display("data[event][event_describe]",stripslashes($row->event_describe),'','','70','20','0'); ?></td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_DESCRIPTION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
      <tr align="center" valign="middle">

      	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_THANK' ); ?>:</strong>
             		<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][thanksmsg_set]","",$row->thanksmsg_set); ?>
 
          <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

          </div>
 
      	</td>

     	<td align="left" valign="top">
		      <?php echo $editor->display("data[event][thanksmsg]",stripslashes($row->thanksmsg),'','','70','20','0'); ?>
      </td>

		<td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
	  
      <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_PAYLATER_THANK' ); ?>:</strong>
         <br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][pay_later_thk_msg_set]","",$row->pay_later_thk_msg_set); ?>
      
         <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

        </div>
      
      </td>

     	<td align="left" valign="top">
	     <?php echo $editor->display("data[event][pay_later_thk_msg]",stripslashes($row->pay_later_thk_msg),'','','70','20','0'); ?>
      </td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_PAYLATER_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>
		  
	  </tr>

    <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CUSTOM_TERMS_CONDITIONS' ); ?>:</strong>

        <br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][terms_conditions_set]","",$row->terms_conditions_set); ?>

      </td>

       <td align="left" valign="top">
        <?php echo $editor->display("data[event][terms_conditions_msg]",stripslashes($row->terms_conditions_msg),'','','70','20','0'); ?>
      </td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_CUSTOM_TERMS_CONDITIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>  	

      </table>
<?php 

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$config = $this->getModel('config');
?>

<table class="adminlist">
	
	 <tr>

                     <td align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_USER_PANEL_MESSAGE' ); ?>:</strong></td>

                     <td align="left" style="width:620px">

                      <?php echo $editor->display("config[userpanelmessage]",stripslashes($config->getGlobal('userpanelmessage','')),'','','70','20','0'); ?>

                     </td>

                     <td><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_MESSAGE_HELP' )), '', 'tooltip.png', '', '');?></td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_EDIT_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_edit_show]","","value","text",$config->getGlobal('upanel_edit_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_EDIT_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_AMOUNT_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_amount_show]","","value","text",$config->getGlobal('upanel_amount_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_AMOUNT_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_DUE_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_due_show]","","value","text",$config->getGlobal('upanel_due_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_DUE_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_PAY_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_pay_show]","","value","text",$config->getGlobal('upanel_pay_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_PAY_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_CANCEL_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_cancel_show]","","value","text",$config->getGlobal('upanel_cancel_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_CANCEL_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>

	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_UPANEL_STATUS_SHOW' );?>:</strong></td>

	<td>
		
		  <?php
				$options=array();
                $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
				$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				echo JHTML::_('select.genericlist', $options,"config[upanel_status_show]","","value","text",$config->getGlobal('upanel_status_show'));
		  ?>
    </td>

	<td><?php echo JHTML::tooltip((JText::_( 'DT_UPANEL_STATUS_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

</tr>

<tr>		 	 

<td colspan="3" class="dt_heading"><?php echo JText::_( 'DT_UPANEL_EMAILS' );?></td>

</tr>
	
		<tr>

                                 <td valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_CANCEL_EMAIL' ); ?>:</strong>

                                 <div style="padding:5px 5px 5px 15px;">

									<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

					                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

					                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
					
					                 <br />[EVENT_TIME] - <?php echo JText::_( 'DT_TAG_EVENT_TIME' );?>

					                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

					                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
					
					                 <br />[CODE] - <?php echo JText::_( 'DT_TAG_CODE' );?>
					
						             <br />[ALL_FIELDS] - <?php echo JText::_( 'DT_TAG_ALL_FIELDS' );?>
					
									 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                       </td>

                                 <td>

                                  <?php $email_cancel_confirm = isset($email_cancel_confirm)?$email_cancel_confirm:'';?>

                                  <?php echo $editor->display("config[email_cancel_confirm]",stripslashes($config->getGlobal('email_cancel_confirm','')),'','340','70','20','0'); ?>

                                 </td>

                                 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_CANCEL_EMAIL_HELP' )), '', 'tooltip.png', '', '');?></td>

                 </tr>

                 <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_CANCEL_EMAIL_SUBJECT' );?>:</strong></td>

				  <td align="left" valign="top"><input type="text" name="config[upsubcancelemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('upsubcancelemail','')); ?>" /></td>

				  <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_CANCEL_EMAIL_SUBJECT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

				</tr>

			     <tr>		 	 

                     <td colspan="3"><hr /></td>

                 </tr>                              

                 <tr>

                                 <td valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_CHANGE_EMAIL' ); ?>:</strong>

                                 <div style="padding:5px 5px 5px 15px;">

									<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

					                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

					                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
					
					                 <br />[EVENT_TIME] - <?php echo JText::_( 'DT_TAG_EVENT_TIME' );?>

					                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

					                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
					
					                 <br />[CODE] - <?php echo JText::_( 'DT_TAG_CODE' );?>
					
						             <br />[ALL_FIELDS] - <?php echo JText::_( 'DT_TAG_ALL_FIELDS' );?>
					
				                  	 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                                 </td>

                                 <td>

                                  <?php $email_change_confirm = isset($email_change_confirm)?$email_change_confirm:'';?>

                                  <?php echo $editor->display("config[email_change_confirm]",stripslashes($config->getGlobal('email_change_confirm','')),'','340','70','20','0'); ?>                                      

                                 </td>

                                 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_CHANGE_EMAIL_HELP' )), '', 'tooltip.png', '', '');?></td>

                 </tr>

                 <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_CHANGE_EMAIL_SUBJECT' );?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="config[upsubchangeemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('upsubchangeemail','')); ?>" /></td>

									<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_CHANGE_EMAIL_SUBJECT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

								 </tr>

					       <tr>		 	 

                       <td colspan="3"><hr /></td>

                 </tr>      

                 <tr>

                                 <td valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_PAYMENT_EMAIL' ); ?>:</strong>

                                 <div style="padding:5px 5px 5px 15px;">

									<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

					                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

					                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
					
					                 <br />[EVENT_TIME] - <?php echo JText::_( 'DT_TAG_EVENT_TIME' );?>

					                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

					                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
					
					                 <br />[CODE] - <?php echo JText::_( 'DT_TAG_CODE' );?>
					
						             <br />[ALL_FIELDS] - <?php echo JText::_( 'DT_TAG_ALL_FIELDS' );?>
					
					                 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                                 </td>

                                 <td>

                                  <?php echo $editor->display("config[payment_confirm]",stripslashes($config->getGlobal('payment_confirm','')),'','340','70','20','0'); ?>

                                 </td>

                                 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_PAYMENT_EMAIL_HELP' )), '', 'tooltip.png', '', '');?></td>

                 </tr>

                 <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_USER_PANEL_PAYMENT_EMAIL_SUBJECT' );?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="config[upsubpaymentemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('upsubpaymentemail','')); ?>" /></td>

									<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_USER_PANEL_PAYMENT_EMAIL_SUBJECT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

								 </tr>

     </table>
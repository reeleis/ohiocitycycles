<?php 

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

?>

<table class="adminform" width="100%" cellpadding="10" cellspacing="10">                      

               <tr>

					<td align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_FROM_NAME' );?>:</strong></td>

					<td style="width:620px"><input type="text" class="required" name="config[DT_fromname]" size="40" value="<?php echo $config->getGlobal('DT_fromname','') ; ?>" /></td>

					<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_FROM_NAME_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>

                <tr>

					<td align="left" valign="top"><strong><?php echo JText::_( 'DT_FROM_EMAIL' );?>:</strong></td>

					<td><input type="text" class="required" name="config[DT_mailfrom]" size="40" value="<?php echo $config->getGlobal('DT_mailfrom','') ; ?>" /></td>

					<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_FROM_EMAIL_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>
				
				<tr>
			   <td align="left" valign="top"><strong><?php echo JText::_( 'DT_FRONTEND_EVENT_NOTIFICATION' );?>:</strong></td>

			    <td align="left" valign="top"><input type="text" name="config[frontendEventNotification]" size="40" maxlength="120" value="<?php echo stripslashes($config->getGlobal('frontendEventNotification','')); ?>" /></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_FRONTEND_EVENT_NOTIFICATION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

			 </tr>
			 <tr align="center" valign="middle">
				
				<td align="left" valign="top"><strong><?php echo JText::_( 'DT_FRONTEND_EMAIL_NOTIFY_WHEN' ); ?>:</strong></td>

				<td align="left" valign="top">

			        <?php $options = array('create'=>JText::_('DT_CREATES_EVENT'),'edit'=>JText::_('DT_EDITS_EVENT'),'delete'=>JText::_('DT_DELETES_EVENT'));

						echo DtHtml::checkboxList('config[eventModifyNotification]',$options,$config->getGlobal('eventModifyNotification',array()));

					?>

			     </td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_FRONTEND_EMAIL_NOTIFY_WHEN_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>
				
				<tr>		 	 

	                <td colspan="3"><hr /></td>

	            </tr>

				<tr align="center" valign="middle">

                 <td align="left" valign="top"><strong><?php echo JText::_( 'THANKS_EMAIL' );?>:</strong>

                 <div style="padding:5px 5px 5px 15px;">

					<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

	                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

	                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

	                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

	                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
	
	                 <br />[PASSWORD] - <?php echo JText::_( 'DT_TAG_PASSWORD' );?>

	                 <br />[DATE_REGISTERED] - <?php echo JText::_( 'DT_TAG_DATE_REGISTERED' );?>
	
					 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                </td>

				<td align="left" valign="top"><?php echo $editor->display("config[thanksemail]",stripslashes($config->getGlobal('thanksemail','')),'','340','20','20','0'); ?></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_EMAIL_AUTH' )), '', 'tooltip.png', '', ''); ?> </td>

			</tr>   

            <tr align="center" valign="middle">

                <td align="left" valign="top"><strong><?php echo JText::_( 'DT_THANKS_EMAIL_SUB' );?>:</strong></td>

				<td align="left" valign="top"><input type="text" name="config[subthanksemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('subthanksemail','') ); ?>" /></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_EMAIL_AUTH_SUB' )), '', 'tooltip.png', '', ''); ?></td>

			</tr>
            <tr>		 	 

	                <td colspan="3"><hr /></td>

	            </tr>
            <tr align="center" valign="middle">

                 <td align="left" valign="top"><strong><?php echo JText::_( 'DT_WAITING_EMAIL' );?>:</strong>

                 <div style="padding:5px 5px 5px 15px;">

					<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

	                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

	                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

	                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

	                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
	
	                 <br />[PASSWORD] - <?php echo JText::_( 'DT_TAG_PASSWORD' );?>

	                 <br />[DATE_REGISTERED] - <?php echo JText::_( 'DT_TAG_DATE_REGISTERED' );?>
	
					 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                </td>

				<td align="left" valign="top"><?php echo $editor->display("config[waitingemail]",stripslashes($config->getGlobal('waitingemail','')),'','340','20','20','0'); ?></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_WAITING_EMAIL_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

			</tr>   

            <tr align="center" valign="middle">

                <td align="left" valign="top"><strong><?php echo JText::_( 'DT_WAITING_EMAIL_SUB' );?>:</strong></td>

				<td align="left" valign="top"><input type="text" name="config[subwaitingemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('subwaitingemail','') ); ?>" /></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_WAITING_EMAIL_HELP_SUB' )), '', 'tooltip.png', '', ''); ?></td>

			</tr>
            
			<tr>		 	 

	                <td colspan="3"><hr /></td>

	            </tr>

				<tr align="center" valign="middle">

                 <td align="left" valign="top"><strong><?php echo JText::_( 'DT_ADMIN_REGISTRATION_EMAIL' );?>:</strong>

                 <div style="padding:5px 5px 5px 15px;">

					<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

	                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

	                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

	                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

	                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
	
					 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                </td>

				<td align="left" valign="top"><?php echo $editor->display("config[admin_registrationemail]",stripslashes($config->getGlobal('admin_registrationemail','')),'','340','20','20','0'); ?></td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_ADMIN_REGISTRATION_EMAIL' )), '', 'tooltip.png', '', ''); ?> </td>

			</tr>   

            <tr align="center" valign="middle">

                <td align="left" valign="top"><strong><?php echo JText::_( 'DT_ADMIN_REGISTRATION_EMAIL_SUB' );?>:</strong></td>

				<td align="left" valign="top"><input type="text" name="config[subject_admin_registrationemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('subject_admin_registrationemail','') ); ?>" /></td>

				<td><?php echo JHTML::tooltip((JText::_( 'DT_ADMIN_REGISTRATION_EMAIL_SUB' )), '', 'tooltip.png', '', ''); ?></td>

			</tr>

			<tr>		 	 

                <td colspan="3"><hr /></td>

            </tr> 

                <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_STATUS_CHANGE_MSG'); ?>:</strong>

                    <div style="padding:5px 5px 5px 15px;">

						<br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

		                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

		                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

		                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

		                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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
		
						 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                    </td>
					<td align="left" valign="top">

                    <?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: &nbsp;<?php   

                               echo JHTML::_('select.booleanlist', "config[status_change_msg_send]","",$config->getGlobal('status_change_msg_send',1));  ?>

                    <?php echo $editor->display("config[status_change_msg]",stripslashes($config->getGlobal('status_change_msg','')),'','340','20','20','0'); ?></td>

					<td align="center"><?php echo JHTML::tooltip(JText::_( 'DT_STATUS_CHANGE_MSG_HELP'));?> </td>

				 </tr>

                  <tr align="center" valign="middle">

                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CHANGE_STATUS_EMAIL_SUB' );?>:</strong></td>

					<td align="left" valign="top"><input type="text" name="config[subchangestatusemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('subchangestatusemail','')); ?>" /></td>

					<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CHANGE_STATUS_EMAIL_HELP' )), '', 'tooltip.png', '', ''); ?></td>

				</tr>

                  <tr>		 	 

                    <td colspan="3"><hr /></td>

                  </tr>

                  <tr align="center" valign="middle">

                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAID_STATUS_CHANGE_MSG'); ?>:</strong>

                    <div style="padding:5px 5px 5px 15px;">

                 <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:<br />

                 <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

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

				 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

                    </td>

					<td align="left" valign="top">

                    <?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: &nbsp;<?php 

					           echo JHTMLSelect::booleanlist("config[paid_status_change_msg_send]","",$config->getGlobal('paid_status_change_msg_send',1)); ?>

                    <?php echo $editor->display("config[paid_status_change_msg]",stripslashes($config->getGlobal('paid_status_change_msg','')),'','340','20','20','0'); ?></td>

					<td align="center"><?php echo JHTML::tooltip(JText::_( 'DT_PAID_STATUS_CHANGE_MSG_HELP'));?> </td>

				</tr>

                 <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAID_STATUS_EMAIL_SUB' );?>:</strong></td>

					<td align="left" valign="top"><input type="text" name="config[subpaidstatusemail]" size="80" maxlength="100" value="<?php echo stripslashes($config->getGlobal('subpaidstatusemail','')); ?>" /></td>

					<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PAID_STATUS_EMAIL_SUB_HELP' )), '', 'tooltip.png', '', ''); ?></td>

				</tr>
							
	 			</table>
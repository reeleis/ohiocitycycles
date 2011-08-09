<?php

/**
* @version 2.7.6
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$editor =& JFactory::getEditor();
$config = $this->getModel('config');
?>

   <table class="adminlist" width="100%" cellpadding="10" cellspacing="10">
   
                <tr>
                  <td align="left"><strong><?php echo JText::_( 'DT_THANKS_REDIRECTION' ); ?>:</strong></td>
                  <td>
                      <?php
                              $options=array();
                              $options[]=JHTML::_('select.option',"0",JText::_( 'DT_REDIRECT_URL' ));
                              $options[]=JHTML::_('select.option',"1",JText::_( 'DT_ONSCREEN_MESSAGE' ));
							  
							  echo JHTML::_('select.radiolist', $options, 'config[thanks_redirection]','','value','text',$config->getGlobal('thanks_redirection',1));
                      ?>
                  </td>
                  <td><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_REDIRECTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
                </tr>

			    <tr>

					<td align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_THANKS_REDIRECT_URL' );?>:</strong></td>

					<td style="width:620px"><input type="text" name="config[thanks_redirect_url]" size="60" value="<?php echo $config->getGlobal('thanks_redirect_url','') ; ?>" /></td>

					<td><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_REDIRECT_URL_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>
                
                <tr align="center" valign="middle">
                  <td align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_THANKS_MSG' ); ?>:</strong>
                     <div style="padding:5px 5px 5px 15px;">
                     <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:
                     <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>
                     <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
                     </div>
                   </td>
				   <td align="left" valign="top" style="width:620px"><?php echo $editor->display("config[thanksmsg]",stripslashes($config->getGlobal('thanksmsg','')),'','340','70','20','0'); ?></td>
				   <td><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_MSG_AUTH' )), '', 'tooltip.png', '', '');?> </td>
				</tr>
                
                <tr>
                  <td align="left"><strong><?php echo JText::_( 'DT_PAY_LATER_REDIRECTION' ); ?>:</strong></td>
                  <td>
                      <?php
                              $options=array();
							  $options[]=JHTML::_('select.option',"0",JText::_( 'DT_REDIRECT_URL' ));
                              $options[]=JHTML::_('select.option',"1",JText::_( 'DT_ONSCREEN_MESSAGE' ));
							  
							  echo JHTML::_('select.radiolist', $options, 'config[pay_later_redirection]','','value','text',$config->getGlobal('pay_later_redirection',1));
                      ?>
                  </td>
                  <td><?php echo JHTML::tooltip((JText::_( 'DT_PAY_LATER_REDIRECTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
                </tr>

			    <tr>

					<td align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_PAY_LATER_REDIRECT_URL' );?>:</strong></td>

					<td style="width:620px"><input type="text" name="config[pay_later_redirect_url]" size="60" value="<?php echo $config->getGlobal('pay_later_redirect_url','') ; ?>" /></td>

					<td><?php echo JHTML::tooltip((JText::_( 'DT_PAY_LATER_REDIRECT_URL_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>
                
                <tr align="center" valign="middle"> 
                   <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAY_LATER_MSG'); ?>:</strong> 
                      <div style="padding:5px 5px 5px 15px;">
                      <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:
                      <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>
                      <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>
                      </div>
                    </td>
				    <td align="left" valign="top"><?php echo $editor->display("config[pay_later_thk_msg]",stripslashes($config->getGlobal('pay_later_thk_msg','')),'','340','70','20','0'); ?></td>
				    <td><?php echo JHTML::tooltip(JText::_( 'DT_PAY_LATER_MSG_HELP'));?> </td>
				</tr>

				<tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_FULL_PAGE_MESSAGE' ); ?>:</strong></td>
					<td align="left" valign="top"><?php echo $editor->display("config[full_message]",stripslashes($config->getGlobal('full_message','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip((JText::_( 'DT_FULL_PAGE_MESSAGE_HELP' )), '', 'tooltip.png', '', ''); ?></td>
				</tr>

				<tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CUT_OFF_DATE_MESSAGE' ); ?>:</strong></td>
					<td align="left" valign="top"><?php echo $editor->display("config[cut_off_date_message]",stripslashes($config->getGlobal('cut_off_date_message','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip((JText::_( 'DT_CUT_OFF_DATE_MESSAGE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
				</tr>
								  
				<tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_AFTER_FULL_PAGE_MESSAGE' ); ?>:</strong></td>
				    <td align="left" valign="top"><?php echo $editor->display("config[waiting_msg]",stripslashes($config->getGlobal('waiting_msg','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip((JText::_( 'DT_AFTER_FULL_PAGE_MESSAGE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
				</tr>

				<tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_TERMS_COND_MSG' ); ?>:</strong></td>
					<td align="left" valign="top"><?php echo $editor->display("config[terms_conditions_msg]",stripslashes($config->getGlobal('terms_conditions_msg','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip((JText::_( 'DT_TERMS_COND_MSG_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
				</tr>

				<tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PRIVATE_EVENT_MSG'); ?>:</strong></td>
				    <td align="left" valign="top"><?php echo $editor->display("config[private_event_msg]",stripslashes($config->getGlobal('private_event_msg','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip(JText::_( 'DT_PRIVATE_EVENT_MSG_HELP'));?> </td>
				</tr>
								  
                <tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PREREQUISITE_EVENT_MSG'); ?>:</strong>
                      <div style="padding:5px 5px 5px 15px;">
                      <br />[PREREQ_EVENTS] - <?php echo JText::_( 'DT_TAG_PREREQ_EVENTS' );?>
                      <br />[PREREQ_CATEGORY] - <?php echo JText::_( 'DT_TAG_PREREQ_CATEGORY' );?>
                      </div>
                    </td>
				    <td align="left" valign="top"><?php echo $editor->display("config[prerequisite_event_msg]",stripslashes($config->getGlobal('prerequisite_event_msg','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip(JText::_( 'DT_PREREQUISITE_EVENT_MSG_HELP'));?> </td>
				</tr>
                  
                <tr align="center" valign="middle">
                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_OVERLAP_EVENT_MSG'); ?>:</strong></td>
					<td align="left" valign="top"><?php echo $editor->display("config[overlap_event_msg]",stripslashes($config->getGlobal('overlap_event_msg','')),'','340','70','20','0'); ?></td>
					<td><?php echo JHTML::tooltip(JText::_( 'DT_OVERLAP_EVENT_MSG_HELP'));?> </td>
				</tr>

	 		</table>
            <script type="text/javascript">
				DTjQuery(function(){
					DTjQuery('input[name*="config[thanks_redirection]"]').live('click',function(){
    
    	if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}

			
    if(this.checked) {
        tr = DTjQuery(this).parent().parent() ;
       
        if(this.value == '1'){
          
			
		   tr.next().hide();
           tr.next().next().css({display:display});	
        } else {
             
			 tr.next().next().hide();
             tr.next().css({display:display});

       }
    }
                    })
					checked = DTjQuery('input[name*="config[thanks_redirection]"]:checked');
				    checked.trigger('click');
					checked.attr('checked',true);
					
					DTjQuery('input[name*="config[pay_later_redirection]"]').live('click',function(){
    
    	if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}

			
    if(this.checked) {
        tr = DTjQuery(this).parent().parent() ;
       
        if(this.value == '1'){
          
			
		   tr.next().hide();
           tr.next().next().css({display:display});	
        } else {
             
			 tr.next().next().hide();
             tr.next().css({display:display});

       }
    }
                    })
					checked = DTjQuery('input[name*="config[thanks_redirection]"]:checked');
				    checked.trigger('click');
					checked.attr('checked',true);
					
				
				})  
			</script>
                           
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
$row = $this->row;
?>

<table class="adminform" cellpadding="10" cellspacing="10">

      <tr align="center" valign="middle">

       <td align="left" valign="top" style="width:100px; padding-right:5px"><strong><?php echo JText::_( 'DT_INSTRUCTIONS' ); ?>:</strong></td>

       <td align="left" valign="top"><?php echo $editor->display("data[event][topmsg]",stripslashes($row->topmsg),'','','70','20','0'); ?></td>

	   <td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_INSTRUCTIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

	  <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_DESCRIPTION' ); ?>:</strong>

        	<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: 
            <br /><?php echo JHTMLSelect::booleanlist("data[event][event_describe_set]","",$row->event_describe_set); ?>

      </td>

     	<td align="left" valign="top"><?php echo $editor->display("data[event][event_describe]",stripslashes($row->event_describe),'','','70','20','0'); ?></td>

		  <td align="left" valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_DESCRIPTION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
	
	  <tr>

		      <th colspan="3" style="background: #d3e8c1; padding:5px;"><?php echo JText::_( 'DT_CUSTOM_EVENT_MESSAGES_SETUP' ); ?></th>

	 </tr>
	
		 <tr>
	      <td>
	        <?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: 
	        <br /><?php echo JHTMLSelect::booleanlist("data[event][thanksmsg_set]","",$row->thanksmsg_set); ?>
	      </td>
	    </tr>
	
         <tr>
                  <td align="left"><strong><?php echo JText::_( 'DT_THANKS_REDIRECTION' ); ?>:</strong></td>
                  <td>
                      <?php
                              $options=array();
                              $options[]=JHTML::_('select.option',"0",JText::_( 'DT_REDIRECT_URL' ));
                              $options[]=JHTML::_('select.option',"1",JText::_( 'DT_ONSCREEN_MESSAGE' ));
							  
							  echo JHTML::_('select.radiolist', $options, 'data[event][thanks_redirection]','','value','text',$row->thanks_redirection);
                      ?>
                  </td>
                  <td><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_REDIRECTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
         </tr>
         
         <tr>

                <td align="left" valign="top"><strong><?php echo JText::_( 'DT_THANKS_REDIRECT_URL' );?>:</strong></td>

                <td><input type="text" name="data[event][thanks_redirect_url]" size="60" value="<?php echo $row->thanks_redirect_url; ?>" /></td>

                <td><?php echo JHTML::tooltip((JText::_( 'DT_THANKS_REDIRECT_URL_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

         </tr>
      <tr align="center" valign="middle">

      	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_THANK' ); ?>:</strong>
             		<br /><br />
 
          <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

          </div>
 
      	</td>

     	<td align="left" valign="top">
		      <?php echo $editor->display("data[event][thanksmsg]",stripslashes($row->thanksmsg),'','','70','20','0'); ?>
      </td>

		<td align="left" valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
    
    <tr>
      <td>
        <?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: 
        <br /><?php echo JHTMLSelect::booleanlist("data[event][pay_later_thk_msg_set]","",$row->pay_later_thk_msg_set); ?>
      </td>
    </tr>

        <tr>
                  <td align="left"><strong><?php echo JText::_( 'DT_PAY_LATER_REDIRECTION' ); ?>:</strong></td>
                  <td>
                      <?php
                              $options=array();
                              $options[]=JHTML::_('select.option',"0",JText::_( 'DT_REDIRECT_URL' ));
                              $options[]=JHTML::_('select.option',"1",JText::_( 'DT_ONSCREEN_MESSAGE' ));
							  
							  echo JHTML::_('select.radiolist', $options, 'data[event][pay_later_redirection]','','value','text',$row->pay_later_redirection);
                      ?>
                  </td>
                  <td><?php echo JHTML::tooltip((JText::_( 'DT_PAY_LATER_REDIRECTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
                </tr>

		<tr>

					<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAY_LATER_REDIRECT_URL' );?>:</strong></td>

					<td><input type="text" name="data[event][pay_later_redirect_url]" size="60" value="<?php echo $row->pay_later_redirect_url; ?>" /></td>

					<td><?php echo JHTML::tooltip((JText::_( 'DT_PAY_LATER_REDIRECT_URL_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>
      <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_PAYLATER_THANK' ); ?>:</strong>
         <br /><br /> 
      
         <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

        </div>
      
      </td>

     	<td align="left" valign="top">
	     <?php echo $editor->display("data[event][pay_later_thk_msg]",stripslashes($row->pay_later_thk_msg),'','','70','20','0'); ?>
      </td>

		  <td align="left" valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_PAYLATER_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>
		  
	  </tr>
	
	<tr><td colspan="3">&nbsp;</td></tr>

    <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CUSTOM_TERMS_CONDITIONS' ); ?>:</strong>

        <br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: 
        <br /><?php echo JHTMLSelect::booleanlist("data[event][terms_conditions_set]","",$row->terms_conditions_set); ?>

      </td>

       <td align="left" valign="top">
	
        <?php echo $editor->display("data[event][terms_conditions_msg]",stripslashes($row->terms_conditions_msg),'','','70','20','0'); ?>
      </td>

		  <td align="left" valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_CUSTOM_TERMS_CONDITIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>  	

      </table>
      <script type="text/javascript">
				DTjQuery(function(){
					DTjQuery('input[name*="data[event][thanks_redirection]"]').live('click',function(){
    
    	if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}
			
    if(this.checked) {
        tr = DTjQuery(this).parent().parent();
       
        if(this.value == '1'){
          
			
		   tr.next().hide();
           tr.next().next().css({display:display});	
        } else {
             
			 tr.next().next().hide();
             tr.next().css({display:display});

       }
    }
                    })
					checked = DTjQuery('input[name*="data[event][thanks_redirection]"]:checked');
				    checked.trigger('click');
					checked.attr('checked',true);
					
					DTjQuery('input[name*="data[event][pay_later_redirection]"]').live('click',function(){
    
    	if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}
			
    if(this.checked) {
        tr = DTjQuery(this).parent().parent();
       
        if(this.value == '1'){
          
			
		   tr.next().hide();
           tr.next().next().css({display:display});	
        } else {
             
			 tr.next().next().hide();
             tr.next().css({display:display});

       }
    }
                    })
					checked = DTjQuery('input[name*="data[event][pay_later_redirection]"]:checked');
				    checked.trigger('click');
					checked.attr('checked',true);	
				
				})  
			</script>
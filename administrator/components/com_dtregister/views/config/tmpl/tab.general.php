 <?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 $config = $this->getModel('config');

 $jomsocial = $this->getModel('jomsocial');

 $currency= $this->getModel('currency');

 $dateformat=&$this->getModel('dateformat');

 $buttoncolor=&$this->getModel('buttoncolor');

 ?>

 <table class="adminlist" width="100%" cellpadding="10" cellspacing="10">

    <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PROFILE_INTEGRATION' );?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_COMMUNITY_BUILDER' ));

									if($jomsocial->jomsocialInstall()){

									   $options[]=JHTML::_('select.option', '2', JText::_( 'DT_JOMSOCIAL' ));

									}elseif($config->getGlobal('cb_integrated')==2){

									   $cb_integrated = 0;

									}

								    

								   echo JHTML::_('select.genericlist', $options,'config[cb_integrated]','','value','text',$config->getGlobal('cb_integrated'));



								   ?>



							   </td>



								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PROFILE_INTEGRATION_HELP' )), '', 'tooltip.png', '', '');?> </td>
								
	</tr>

    <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CB_VIEW_ONLY' );?>:</strong></td>



                                     <td>



                                       <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));



								   echo JHTML::_('select.genericlist', $options,'config[cbviewonly]','','value','text',$config->getGlobal('cbviewonly'));



								   ?>



							   	</td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CB_VIEW_ONLY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

							   <tr align="center" valign="middle">



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_SAVE_PAYMENT_INFO' );?>:</strong></td>



							   <td align="left" valign="top">



								   <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));//



								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));



								   echo JHTML::_('select.genericlist', $options,'config[save_payment_info]','','value','text',$config->getGlobal('save_payment_info'));



								   ?>



							   </td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SAVE_PAYMENT_INFO_TIP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                               

                                           

                               <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_SEND_EMAIL_TO_GROUP' );?>:</strong></td>



                                     <td>



                                       <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));



								   echo JHTML::_('select.genericlist', $options,'config[sendEmailToGroup]','','value','text',$config->getGlobal('sendEmailToGroup'));



								   ?>



							   	</td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SEND_EMAIL_TO_GROUP_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                               

                                <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PRIVATE_EVENT_NOTIFICATION' );?>:</strong></td>



                    <td>



                    <?php



								   $options=array();



                    $options[]=JHTML::_('select.option', 'onscreen', JText::_( 'DT_ONSCREEN' ));



								   $options[]=JHTML::_('select.option', 'redirect', JText::_( 'DT_REDIRECT' ));



								   echo JHTML::_('select.genericlist', $options,'config[private_event_notification]','','value','text',$config->getGlobal('private_event_notification'));



								   ?>



							   	</td>



							   	<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PRIVATE_EVENT_NOTIFICATION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                 <tr>



							   	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PRIVATE_EVENT_REDIRECT' );?>:</strong></td>



                  <td>

                      <input class="inputbox" name="config[private_event_redirect]" id="private_event_redirect" value="<?php echo  $config->getGlobal('private_event_redirect'); ?>" size="40" type="text" />



							   	</td>



							   	<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PRIVATE_EVENT_REDIRECT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                               <?php

                                $status_options = array();

								

	 $status_options[] = JHTML::_('select.option', 1, JText::_('DT_ACTIVE'));

	

	 $status_options[] = JHTML::_('select.option', -1, JText::_('DT_CANCELLED'));

	 

	 $status_options[] = JHTML::_('select.option', 0, JText::_('DT_PENDING'));

	 

							   ?>

                    <tr>



							   	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAID_DEFAULT_STATUS' );?>:</strong></td>

                  <td>

                  <?php			  

                echo  JHTML::_('select.genericlist', $status_options,'config[paid_default_status]',' ', 'value','text',$config->getGlobal('paid_default_status'));

				  ?>

					</td>

					<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PAID_DEFAULT_STATUS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

				</tr>

                <tr>

					<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PARTIAL_DEFAULT_STATUS' );?>:</strong></td>

                  <td>

                  <?php

                 echo  JHTML::_('select.genericlist', $status_options,'config[partial_default_status]',' ', 'value','text',$config->getGlobal('partial_default_status'));

				  ?>

				</td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PARTIAL_DEFAULT_STATUS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                </tr>

               <tr>

					<td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAYLATER_DEFAULT_STATUS' );?>:</strong></td>

                  <td>

                  <?php

				   $paylater_default_status = (!isset($paylater_default_status))?0:$paylater_default_status ;

                echo  JHTML::_('select.genericlist', $status_options,'config[paylater_default_status]',' ', 'value','text',$config->getGlobal('paylater_default_status'));

				  ?>

				</td>

				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PAYLATER_DEFAULT_STATUS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

			</tr>
			
			<tr>
				<td align="left" valign="top"><strong><?php echo JText::_( 'DT_MULTI_EVENT_CART_OPTION' );?>:</strong></td>
		         <td>
							<?php
							   $options=array();
							   $options[]=JHTML::_('select.option', '0', JText::_( 'DT_DISABLE' ));
							   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_ENABLE' ));
							   echo JHTML::_('select.genericlist', $options,'config[disable_cart]','','value','text',$config->getGlobal('disable_cart'));
							?>
		        </td>
				<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_MULTI_EVENT_CART_OPTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
			</tr>

            <tr>

				<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CONFIRM_NUMBER_TYPE' );?>:</strong></td>



                  <td>

                  <?php

				   $confirm_number_type = (!isset($confirm_number_type))?'random':$confirm_number_type ;

				   $confirm_number_type_options =  array();

				   $confirm_number_type_options[] = JHTML::_('select.option', 'random', JText::_('DT_RANDOM'));

				   $confirm_number_type_options[] = JHTML::_('select.option', 'sequential', JText::_('DT_SEQUENTIAL'));

                echo  JHTML::_('select.genericlist', $confirm_number_type_options,'config[confirm_number_type]',' ', 'value','text',$config->getGlobal('confirm_number_type'));

				  ?>

							   	</td>

							   	<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CONFIRM_NUMBER_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

					</tr>

                      <tr>

					<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CONFIRM_NUMBER_PREFIX' );?>:</strong></td>

                  <td>

                  <?php $confirm_number_prefix = (!isset($confirm_number_prefix))?'':$confirm_number_prefix; ?>

                   <input type="text" id="confirm_number_prefix" name="config[confirm_number_prefix]" value="<?php echo $config->getGlobal('confirm_number_prefix'); ?>" />

							   	</td>

							   	<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CONFIRM_NUMBER_PREFIX_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>

    <tr>

		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CONFIRM_NUMBER_START' );?>:</strong></td>

        <td>

            <?php $confirm_number_start = (!isset($confirm_number_start))?'':$confirm_number_start ;

			?>

            <input type="text" name="config[confirm_number_start]" id="confirm_number_start" value="<?php echo $config->getGlobal('confirm_number_start') ; ?>" />

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CONFIRM_NUMBER_START_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>

    <tr>

		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CSV_SEPARATOR' );?>:</strong></td>

        <td>         

             <input type="text" name="config[csv_separator]" id="csv_separator" size="5" value="<?php echo $config->getGlobal('csv_separator',',') ; ?>" />

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CSV_SEPARATOR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
    
    
						
	<tr align="center" valign="middle">
		
		  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_REGISTERED_PREVENT_DUPLICATION' );?>:</strong></td>

          <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));

								   echo JHTML::_('select.genericlist', $options,'config[prevent_duplication]','','value','text',$config->getGlobal('prevent_duplication'));

								   ?>

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTERED_PREVENT_DUPLICATION_HELP' )), '', 'tooltip.png', '', '');?> </td>

	</tr>
						
	<tr>

		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_TIME_CHECK' );?>:</strong></td>

        <td>

             <?php

				$options=array();

				$options[]=JHTML::_('select.option', '0', JText::_( 'No' ));

				$options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));

				echo JHTML::_('select.genericlist', $options,'config[timecheck]','','value','text',$config->getGlobal('timecheck'));

			  ?>

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_TIME_CHECK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>

    <tr>

        <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PREREQUISITE_PAID' );?>:</strong></td>

        <td>

                                     <?php

								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));



								   echo JHTML::_('select.genericlist', $options,'config[prerequisite_paid]','','value','text',$config->getGlobal('prerequisite_paid'));

								   ?>

		</td>

	    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PREREQUISITE_PAID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>

	<tr>

	   <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PREREQUISITE_ATTEND' );?>:</strong></td>

       <td>

            <?php

			$options=array();

			$options[]=JHTML::_('select.option', '0', JText::_( 'No' ));

			$options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));

			echo JHTML::_('select.genericlist', $options,'config[prerequisite_attend]','','value','text',$config->getGlobal('prerequisite_attend'));

			?>

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PREREQUISITE_ATTEND_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
	
	<tr>		 	 

        <td colspan="3" class="dt_heading"><?php echo JText::_( 'DT_DISPLAY');?></td>

    </tr>
	
	<tr align="center" valign="middle">
		
		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_SECURITY_IMAGE_CHECK' );?>:</strong></td>

        <td align="left" valign="top">

								   <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));



								   echo JHTML::_('select.genericlist', $options,'config[security_image_check]','','value','text',$config->getGlobal('security_image_check'));



								   ?>



							   </td>



								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SECURITY_IMAGE_CHECK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



	</tr>

	<tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_TERMS_CONDITIONS' );?>:</strong></td>



							   <td align="left" valign="top">



								   <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));//



								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));



								   echo JHTML::_('select.genericlist', $options,'config[terms_conditions]','','value','text',$config->getGlobal('terms_conditions'));



								   ?>



							   </td>



								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_TERMS_CONDITIONS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
    
    <tr>



                                    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_REGISTRANT_BUTTON_COLOR' ); ?>:</strong></td>



                                    <td>



                                    <?php



                            			       $options=DtHtml::options($buttoncolor->getColors());

                                                $button_color = isset($button_color)?$button_color:'blue';



                                              echo JHTML::_('select.genericlist', $options, 'config[button_color]','','value','text',$config->getGlobal('button_color'));



									?>



                                    </td>



                                        <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_BUTTON_COLOR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



                                  </tr>
    
    <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_DATE_FORMAT' ) ?>:</strong></td>



							   <td align="left" valign="top">



								   <?php



								

                                   $options=DtHtml::options($dateformat->getformats());

								   if($config->getGlobal('date_format')==""){$date_format='%m-%d-%Y';}else{

								     

									 $date_format = $config->getGlobal('date_format');

								   

								   }

								

								   echo JHTML::_('select.genericlist',$options,"config[date_format]",'','value','text',$date_format);



								   ?>



							   </td>



								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_DATE_FORMAT_HELP' )), '', 'tooltip.png', '', ''); ?></td>



							   </tr>
    
    <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_SHOW_DATE' );?>:</strong></td>



                                     <td>



                                       <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));



								   echo JHTML::_('select.genericlist', $options,'config[event_show_date]','','value','text', $config->getGlobal('event_show_date'));



								   ?>



							   	</td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SHOW_DATE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>
                               
    <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_FORM_FIELD_STYLING' );?>:</strong></td>



                                     <td>



                                       <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'DT_STYLED_TEMPLATE' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_STYLED_TEMPLATE_DTREGISTER' ));



								   echo JHTML::_('select.genericlist', $options,'config[form_field_style]','','value','text', $config->getGlobal('form_field_style'));



								   ?>



							   	</td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_FORM_FIELD_STYLING_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>
                    
    <tr align="center" valign="middle">
		
		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_SHOW_FEE_BREAKDOWN' );?>:</strong></td>

        <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));

								   echo JHTML::_('select.genericlist', $options,'config[show_fee_breakdown]','','value','text',$config->getGlobal('show_fee_breakdown'));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_FEE_BREAKDOWN_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>						
</table>

 <script type="text/javascript">
							  DTjQuery('#configprivate_event_notification').live('change',function(){		     

								  if(DTjQuery(this).val()=='redirect'){

								      DTjQuery('#private_event_redirect').removeAttr('disabled');

								  }else{

									  DTjQuery('#private_event_redirect').attr('disabled',true);

								  }

							  })

							   DTjQuery('#configprivate_event_notification').trigger('change');

							 DTjQuery('#configconfirm_number_type').live('change',function(){

								  if(DTjQuery(this).val()=='sequential'){

								      DTjQuery('#confirm_number_start').removeAttr('disabled');

								  }else{

									  DTjQuery('#confirm_number_start').attr('disabled',true);

								  }							  

							  })

							   DTjQuery('#configconfirm_number_type').trigger('change');			

							</script>
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
 $jomsocial = $this->getModel('jomsocial');
 $currency=&$this->getModel('currency');
 $dateformat=&$this->getModel('dateformat');
 $buttoncolor=&$this->getModel('buttoncolor');

 ?>

<table class="adminlist" width="100%" cellpadding="10" cellspacing="10"> 

	<tr>		 	 

        <td colspan="5" class="dt_heading"><?php echo JText::_( 'DT_COLUMNS_EXTRAS');?></td>

    </tr>

   <tr align="center" valign="middle">
	
	    <td align="left" valign="top"><strong><?php echo JText::_( 'DT_MONTH_FILTER_SHOW');?>:</strong></td>

		<td align="left" valign="top">

				<?php

					$options=array();

					$options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

					$options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
				    echo JHTML::_('select.genericlist', $options,"config[month_filter_show]","","value","text",$config->getGlobal('month_filter_show'));

				 ?>

	   </td>

	  <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_MONTH_FILTER_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	</tr>      

    <tr align="center" valign="middle">
		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_FILTER_SHOW');?>:</strong></td>
		<td align="left" valign="top">
			<?php
            $options=array();
            $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
            $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
            echo JHTML::_('select.genericlist', $options,"config[event_filter_show]","","value","text",$config->getGlobal('event_filter_show'));
            ?>
		</td>
		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_FILTER_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
	</tr>
    
    <tr align="center" valign="middle">
		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_LOCATION_SHOW');?>:</strong></td>
		<td align="left" valign="top">
			<?php
            $options=array();
            $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));
            $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));
            echo JHTML::_('select.genericlist', $options,"config[event_location_show]","","value","text",$config->getGlobal('event_location_show'));
            ?>
		</td>
		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_LOCATION_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
	</tr>     

                                 <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_SEARCH_SHOW');?>:</strong></td>

							    <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

								   echo JHTML::_('select.genericlist', $options,"config[event_search_show]","","value","text",$config->getGlobal('event_search_show'));

								   ?>

							   </td>

								 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SEARCH_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

							   <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_TITLE_LINK');?>:</strong></td>

							    <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "dtregister",JText::_( 'DT_REGISTRATION'));

								   $options[]=JHTML::_('select.option', "jevent",JText::_( 'DT_JEVENT'));   

								  // $options[]=JHTML::_('select.option', "article",JText::_( 'DT_ARTICLE'));

								   echo JHTML::_('select.genericlist', $options,"config[event_title_link]","","value","text",$config->getGlobal('event_title_link'));

								   ?>

							   </td>

								 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_TITLE_LINK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>   

                               <tr>

							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_FIELD_WIDTH' );?>:</strong></td>

							   		<td><input type="text" name="config[event_field_width]" size="9" value="<?php echo $config->getGlobal('event_field_width'); ?>" /></td>

							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_FIELD_WIDTH_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                                 <tr>

							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_DATE_WIDTH' );?>:</strong></td>

							   		<td><input type="text" name="config[event_date_width]" size="9" value="<?php echo $config->getGlobal('event_date_width'); ?>" /></td>

							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_DATE_WIDTH_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

<tr>

                                <td align="left"><strong><?php echo JText::_( 'DT_SHOW_EVENT_IMAGE' ); ?>:</strong></td>

                                <td>

                                <?php

								$options = array(JText::_('NO'),JText::_('YES'));	

							     echo JHTML::_('select.genericlist', DtHtml::options($options),'config[show_event_image]','','value','text',$config->getGlobal('show_event_image',0));

								?>

                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_EVENT_IMAGE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                              </tr>
                                <tr>

							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_SHOW_DATE' );?>:</strong></td>

		<td>
			
			  <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

								   echo JHTML::_('select.genericlist', $options,"config[event_date_show]","","value","text",$config->getGlobal('event_date_show'));

								   ?>
	    </td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_DATE_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>

	<tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PRICE_COLUMN');?>:</strong></td>

		<td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

								   echo JHTML::_('select.genericlist', $options,"config[price_column]","","value","text",$config->getGlobal('price_column'));

								   ?>

		</td>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_PRICE_COLUMN_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
							
	<tr>

		<td align="left"><strong><?php echo JText::_( 'DT_SHOW_PRICE_TAXES' ); ?>:</strong></td>

		<td>

			<?php

			$options = array(JText::_('NO'),JText::_('YES'));

			echo JHTML::_('select.genericlist', DtHtml::options($options),'config[show_price_tax]','','value','text',$config->getGlobal('show_price_tax',0));

			?>

		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_PRICE_TAXES_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
							
	<tr align="center" valign="middle">
		
		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CAPACITY_COLUMN' );?>:</strong></td>

		<td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '1', JText::_( 'Show' ));

								   $options[]=JHTML::_('select.option', '0', JText::_( 'Hide' ));

								   echo JHTML::_('select.genericlist', $options,'config[capacity_column]','','value','text',$config->getGlobal('capacity_column'));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_CAPACITY_COLUMN_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                                <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_DISPLAY_TIME' );?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'DT_HIDE' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_START_TIME' ));

                                   $options[]=JHTML::_('select.option', '2', JText::_( 'DT_START_END_TIME' ));

								   echo JHTML::_('select.genericlist', $options,'config[displaytime]','','value','text',$config->getGlobal('displaytime'));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_DISPLAY_TIME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

							   <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_REGISTERED_COLUMN' );?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '1', JText::_( 'Show' ));

								   $options[]=JHTML::_('select.option', '0', JText::_( 'Hide' ));

								   echo JHTML::_('select.genericlist', $options,'config[registered_column]','','value','text',$config->getGlobal('registered_column'));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTERED_COLUMN_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

							<tr>		 	 

				                <td colspan="5" class="dt_heading"><?php echo JText::_( 'DT_LOCATION');?></td>

				            </tr>

                           <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_SHOW_LOCATION');?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

								   echo JHTML::_('select.genericlist', $options,"config[showlocation]","","value","text",$config->getGlobal('showlocation'));

								   ?>

							   </td>

								 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_LOCATION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                           <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_LINK_GOOGLE');?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

                                   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

                                   echo JHTML::_('select.genericlist', $options,"config[linktogoogle]","","value","text",$config->getGlobal('linktogoogle'));

								   ?>

						   </td>

								 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_LINK_GOOGLE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                           <tr>

							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_GOOGLE_KEY' );?>:</strong></td>

							   		<td><input type="text" name="config[googlekey]" size="50" value="<?php echo $config->getGlobal('googlekey'); ?>" />

                    <br />(<?php echo JText::_( 'DT_GOOGLE_KEY_URL_TIP' );?>)

                    </td>

							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_GOOGLE_KEY_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                           <tr>

						   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_LOCATION_IMAGE_WIDTH' );?>:</strong></td>

							   		<td><input type="text" name="config[location_img_w]" size="9" value="<?php echo $config->getGlobal('location_img_w'); ?>" /></td>

							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_LOCATION_IMAGE_WIDTH_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

                                   <tr>

							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_LOCATION_IMAGE_HEIGHT' );?>:</strong></td>

							   		<td><input type="text" name="config[location_img_h]" size="9" value="<?php echo $config->getGlobal('location_img_h'); ?>" /></td>

							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_LOCATION_IMAGE_HEIGHT_TIP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>
							
							<tr>		 	 

						        <td colspan="5" class="dt_heading"><?php echo JText::_( 'DT_MISCELLANEOUS');?></td>

						    </tr>

                               <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_SHOW_PAST_EVENT');?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', "1",JText::_( 'DT_SHOW'));

								   $options[]=JHTML::_('select.option', "0",JText::_( 'DT_HIDE'));

                                   //$show_past_event = isset($show_past_event)?$show_past_event:'0';

								   echo JHTML::_('select.genericlist', $options,"config[show_past_event]","","value","text",$config->getGlobal('show_past_event',0));

								   ?>

							   </td>

								 <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_PAST_EVENT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

							   <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_SHOW_REGISTRATION_BUTTON' );?>:</strong></td>

							   <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '1', JText::_( 'Show' ));

								   $options[]=JHTML::_('select.option', '0', JText::_( 'Hide' ));

								   echo JHTML::_('select.genericlist', $options,'config[show_registration_button]','','value','text',$config->getGlobal('show_registration_button',0));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_REGISTRATION_BUTTON_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

								<tr>

                                <td  align="left"><strong><?php echo JText::_( 'DT_EVENT_FRONT_LINK_TYPE' ); ?>:</strong></td>

                                <td>

                                    <?php

                                                $options=array();

                                                $options[]=JHTML::_('select.option',"0",JText::_( 'DT_TEXT' ));

                                                $options[]=JHTML::_('select.option',"1",JText::_( 'DT_IMAGE' ));

                        						$front_link_type = isset($front_link_type)?$front_link_type:1;

                                          echo JHTML::_('select.genericlist', $options, 'config[front_link_type]','','value','text',$config->getGlobal('front_link_type',0));

                                    ?>

                                </td>

                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_FRONT_LINK_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                              </tr>

                              <tr>

                                <td align="left"><strong><?php echo JText::_( 'DT_EVENT_LIST_ORDER' ); ?>:</strong></td>



                                <td>



                                    <?php



                                        $options=array();

										$options[]=JHTML::_('select.option',"0",JText::_( 'DT_MANUAL_ORDERING' ));

										$options[]=JHTML::_('select.option',"1",JText::_( 'DT_OLDEST_FIRST' ));

                                        $options[]=JHTML::_('select.option',"2",JText::_( 'DT_NEWEST_FIRST' ));

                                        $options[]=JHTML::_('select.option',"3",JText::_( 'DT_NAME_AZ' ));

                        						  //  $eventListOrder = isset($eventListOrder)?$eventListOrder:0;

                                        echo JHTML::_('select.genericlist', $options, 'config[eventListOrder]','','value','text',$config->getGlobal('eventListOrder',0));



                                    ?>



                                </td>



                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_LIST_ORDER_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



                              </tr>



								              <tr>



                                <td align="left"><strong><?php echo JText::_( 'DT_EVENT_LIST_NUMBER' ); ?>:</strong></td>



                                <td><input type="text" size="5" name="config[event_list_number]" value="<?php echo $config->getGlobal('event_list_number',20); ?>" /></td>



                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_LIST_NUMBER_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



                              </tr>

                                <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_THUMB_WIDTH' );?>:</strong></td>



							   		<td><input type="text" name="config[event_thumb_width]" size="9" value="<?php echo $config->getGlobal('event_thumb_width'); ?>" /></td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_THUMB_WIDTH_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                                 <tr>



							   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_THUMB_HEIGHT' );?>:</strong></td>



							   		<td><input type="text" name="config[event_thumb_height]" size="9" value="<?php echo $config->getGlobal('event_thumb_height'); ?>" /></td>



							   		<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_THUMB_HEIGHT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



							   </tr>

                     <tr>



                                <td align="left"><strong><?php echo JText::_( 'DT_SHOW_MODERATOR' ); ?>:</strong></td>



                                <td>

                                <?php

								$options = array(JText::_('NO'),JText::_('YES'));

							

							     echo JHTML::_('select.genericlist', DtHtml::options($options),'config[show_moderator]','','value','text',$config->getGlobal('show_moderator',0));

								?>

                              

                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_MODERATOR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



                              </tr>
              
                    <tr>



                                <td align="left"><strong><?php echo JText::_( 'DT_MODERATOR_LINK_PROFILE' ); ?>:</strong></td>



                                <td>

                                <?php

								$options = array(JText::_('NO'),JText::_('YES'));

							

							     echo JHTML::_('select.genericlist', DtHtml::options($options),'config[link_moderator_profile]','','value','text',$config->getGlobal('link_moderator_profile',0));

								?>

                        		    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_MODERATOR_LINK_PROFILE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                              </tr>
							
                            </table>

                           
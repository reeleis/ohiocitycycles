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
<table class="adminlist" width="100%" cellpadding="10" cellspacing="10">
   
   <tr>

		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CALENDAR_LINK' );?>:</strong></td>

         <td>

             <?php

				   $calendar_link = (!isset($calendar_link))?0:$calendar_link;

				   $calendar_link_opts = array();

				   $calendar_link_opts[] = JHTML::_('select.option', '1', JText::_('DT_ARTICLE'));
                   
				   $calendar_link_opts[] = JHTML::_('select.option', '2', JText::_('DT_REGISTRATION'));
				   
                echo JHTML::_('select.genericlist', $calendar_link_opts,'config[calendar_link]',' ', 'value','text',$config->getGlobal('calendar_link',0));

			?>        

		</td>

		<td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CALENDAR_LINK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
    
   <tr>
      <td><strong><?php echo JText::_( 'DT_CALENDAR_START_DAY' );?>:</strong></td>
      <td> <?php

				   $calendar_startDay_opts = array();

				   $calendar_startDay_opts[] = JHTML::_('select.option', '1', JText::_('DT_SUN'));
                   
				   $calendar_startDay_opts[] = JHTML::_('select.option', '2', JText::_('DT_MON'));
				   
                echo JHTML::_('select.genericlist', $calendar_startDay_opts,'config[calendar_startDay]',' ', 'value','text',$config->getGlobal('calendar_startDay',1));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CALENDAR_START_DAY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_CATEGORY' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('DT_ABOVE_CALENDAR'));
				   $calendar_catShow_opts[] = JHTML::_('select.option', '2', JText::_('DT_BELOW_CALENDAR'));
				   $calendar_catShow_opts[] = JHTML::_('select.option', '3', JText::_('DT_ABOVE_BELOW_CALENDAR'));
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('DT_HIDE_CATEGORIES'));

                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_showCat]',' ', 'value','text',$config->getGlobal('calendar_showCat',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_CATEGORY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_EVENT_TITLE_WRAP' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_eventTitle_wrap]',' ', 'value','text',$config->getGlobal('calendar_eventTitle_wrap',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_TITLE_WRAP_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_EVENT_SHOW_TIME' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts =  array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_showTime]',' ', 'value','text',$config->getGlobal('calendar_showTime',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SHOW_TIME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>

   <tr>
      <td><strong><?php echo JText::_( 'DT_CAL_SHOW_IMAGE_GRIDVIEW' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_image_gridview]',' ', 'value','text',$config->getGlobal('calendar_show_image_gridview',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_IMAGE_GRIDVIEW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CAL_IMAGE_GRIDVIEW_WIDTH' );?>:</strong></td>
        <td><input type="text" name="config[event_image_gridview_width]" size="9" value="<?php echo $config->getGlobal('event_image_gridview_width'); ?>" /></td>
        <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_IMAGE_GRIDVIEW_WIDTH_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
   		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CAL_IMAGE_GRIDVIEW_HEIGHT' );?>:</strong></td>
        <td><input type="text" name="config[event_image_gridview_height]" size="9" value="<?php echo $config->getGlobal('event_image_gridview_height'); ?>" /></td>
        <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_IMAGE_GRIDVIEW_HEIGHT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
	<tr>		 	 

       <td colspan="3" class="dt_heading"><?php echo JText::_( 'DT_CAL_POPUP_DETAILS');?></td>

   </tr>
   
    <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_POP_UP' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('DT_HIDE'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('DT_SHOW'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_popup]',' ', 'value','text',$config->getGlobal('calendar_show_popup',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_POP_UP_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
    <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_EVENT_IMAGE' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_image]',' ', 'value','text',$config->getGlobal('calendar_show_image',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_EVENT_IMAGE_CAL_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_DATE' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
	
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_date]',' ', 'value','text',$config->getGlobal('calendar_show_date',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_DATE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_DISPLAY_TIME' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
	
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_time]',' ', 'value','text',$config->getGlobal('calendar_show_time',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_TIME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
    <tr>
      <td><strong><?php echo JText::_( 'DT_PRICE_COLUMN' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();

				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_price]',' ', 'value','text',$config->getGlobal('calendar_show_price',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_PRICE_SHOW_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   </tr>
   
    <tr>
      <td><strong><?php echo JText::_( 'DT_CAPACITY_COLUMN' );?>:</strong></td>
      <td> <?php		  

				   $calendar_catShow_opts = array();

				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_capacity]',' ', 'value','text',$config->getGlobal('calendar_show_capacity',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_CAPACITY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_REGISTERED_COLUMN' );?>:</strong></td>
      <td> <?php		  

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_registered]',' ', 'value','text',$config->getGlobal('calendar_show_registered',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_REGISTERED_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>

   <tr>
      <td><strong><?php echo JText::_( 'DT_CAL_SHOW_AVAILABLE' );?>:</strong></td>
      <td> <?php		  

				   $calendar_catShow_opts = array();

				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));

				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));

                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_available_spots]',' ', 'value','text',$config->getGlobal('calendar_show_available_spots',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_AVAILABLE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_LOCATION' );?>:</strong></td>
      <td> <?php

				   $calendar_catShow_opts = array();
				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_location]',' ', 'value','text',$config->getGlobal('calendar_show_location',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_LOCATION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_MODERATOR' );?>:</strong></td>
      <td> <?php 

				   $calendar_catShow_opts = array();

				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_show_moderator]',' ', 'value','text',$config->getGlobal('calendar_show_moderator',0));

			?>        </td>
      <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CAL_SHOW_MODERATOR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>

</table>
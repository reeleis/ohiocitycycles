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
?>
<table class="adminlist" width="100%" cellpadding="10" cellspacing="10">
   
   <tr>

		<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CALENDAR_LINK' );?>:</strong></td>

         <td>

             <?php

				   $calendar_link = (!isset($calendar_link))?0:$calendar_link ;

				   $calendar_link_opts =  array();

				 
				   $calendar_link_opts[] = JHTML::_('select.option', '1', JText::_('DT_ARTICLE'));
                   
				   $calendar_link_opts[] = JHTML::_('select.option', '2', JText::_('DT_REGISTRATION'));
				   
                echo JHTML::_('select.genericlist', $calendar_link_opts,'config[calendar_link]',' ', 'value','text',$config->getGlobal('calendar_link',0));

			?>        

		</td>

		<td><?php echo JHTML::tooltip((JText::_( 'DT_CALENDAR_LINK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>
    
   <tr>
      <td><strong><?php echo JText::_( 'DT_CALENDAR_START_DAY' );?>:</strong></td>
      <td> <?php

				  

				   $calendar_startDay_opts =  array();

				
				   $calendar_startDay_opts[] = JHTML::_('select.option', '1', JText::_('DT_SUN'));
                   
				   $calendar_startDay_opts[] = JHTML::_('select.option', '2', JText::_('DT_MON'));
				   
                echo JHTML::_('select.genericlist', $calendar_startDay_opts,'config[calendar_startDay]',' ', 'value','text',$config->getGlobal('calendar_startDay',1));

			?>        </td>
      <td><?php echo JHTML::tooltip((JText::_( 'DT_CALENDAR_START_DAY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_SHOW_CATEGORY' );?>:</strong></td>
      <td> <?php

				  

				   $calendar_catShow_opts =  array();

				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('DT_HIDE'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('DT_SHOW'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_showCat]',' ', 'value','text',$config->getGlobal('calendar_showCat',0));

			?>        </td>
      <td><?php echo JHTML::tooltip((JText::_( 'DT_SHOW_CATEGORY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_EVENT_TITLE_WRAP' );?>:</strong></td>
      <td> <?php

				  

				   $calendar_catShow_opts =  array();

				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_eventTitle_wrap]',' ', 'value','text',$config->getGlobal('calendar_eventTitle_wrap',0));

			?>        </td>
      <td><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_TITLE_WRAP_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>
   
   <tr>
      <td><strong><?php echo JText::_( 'DT_EVENT_SHOW_TIME' );?>:</strong></td>
      <td> <?php

				  

				   $calendar_catShow_opts =  array();

				
				   $calendar_catShow_opts[] = JHTML::_('select.option', '0', JText::_('NO'));
                   
				   $calendar_catShow_opts[] = JHTML::_('select.option', '1', JText::_('YES'));
				   
                echo JHTML::_('select.genericlist', $calendar_catShow_opts,'config[calendar_showTime]',' ', 'value','text',$config->getGlobal('calendar_showTime',0));

			?>        </td>
      <td><?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SHOW_TIME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
   </tr>

</table>
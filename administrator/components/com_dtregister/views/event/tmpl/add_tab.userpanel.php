<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$row = $this->row;

?>

<table class="adminlist" width="100%" cellpadding="10" cellspacing="10">

	  <tr align="center" valign="middle">

      <td align="left" valign="top"><?php echo JText::_( 'DT_PARTIAL_PAYMENT_ENABLE' ); ?>:</td>

	  <td width="400" align="left" valign="top">

	    <?php

	    $options=array();

        $options[]=JHTML::_('select.option',"0",JText::_( 'NO'));

	    $options[]=JHTML::_('select.option',"1",JText::_( 'YES'));
		
	    echo JHTML::_('select.radiolist', $options,"data[event][partial_payment_enable]","","value","text",$row->partial_payment_enable);

	    ?>

	  </td>

	  <td><?php echo JHTML::tooltip((JText::_( 'DT_PARTIAL_PAYMENT_ENABLE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

      <tr align="center" valign="middle">

      <td align="left" valign="top"><?php echo JText::_( 'DT_CANCEL_REFUND' ); ?>:</td>

	  <td width="400" align="left" valign="top">

	    <?php

	    $options=array();

        $options[]=JHTML::_('select.option',"0",JText::_( 'NO'));

	    $options[]=JHTML::_('select.option',"1",JText::_( 'YES'));
      
	    echo JHTML::_('select.radiolist', $options,"data[event][cancel_refund_status]","","value","text",$row->cancel_refund_status);

	    ?>

	  </td>

	  <td><?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_REFUND_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

       <tr>

       <td>

          <?php echo JText::_( 'DT_EDIT_OPTION' ); ?>:

       </td>

       <td>

       <?php 

	       echo JHTML::_('select.booleanlist',"data[event][edit_fee]","",$row->edit_fee);

	     ?>

       </td>

       <td align="left">

         <?php echo JHTML::tooltip((JText::_( 'DT_EDIT_OPTION_HELP' )), '', 'tooltip.png', '', ''); ?>

       </td>

      </tr>

      <tr>

        <td align="left"><?php echo JText::_( 'DT_CHANGE_DATE' ); ?>:</td>

        <td>

        	<?php

        		if(defined('_JEXEC'))

        		{

        			echo JHTML::_("calendar",$row->change_date,"data[event][change_date]","change_date");

        		}

        		else

        		{

        		?>

        			<input class="inputbox" type="text" name="data[event][change_date]" id="change_date" size="12" maxlength="10" value="<?php echo $row->change_date; ?>" />

            	<input type="reset" class="button" value="..." onclick="return showCalendar('change_date', 'y-mm-dd');" />

        		<?php

        		}

        	?>

  <input type="text" class="timeEntry" id="change_time" name="data[event][change_time]" value="<?php echo $row->change_time; ?>" />

	    	</td>

        <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CHANGE_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>

      <tr>

       <td>

          <?php echo JText::_( 'DT_CANCEL_OPTION' ); ?>:

       </td>

       <td>

       <?php 

	        echo JHTML::_('select.booleanlist',"data[event][cancel_enable]","",$row->cancel_enable);

	     ?>

       </td>

       <td align="left">

         <?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_OPTION_HELP' )), '', 'tooltip.png', '', ''); ?>

       </td>

      </tr>

      <tr>

        <td align="left"><?php echo JText::_( 'DT_CANCEL_DATE' ); ?>:</td>

        <td>

        	<?php

        		if(defined('_JEXEC'))

        		{

        			echo JHTML::_("calendar",$row->cancel_date,"data[event][cancel_date]","cancel_date");

        		}

        		else

        		{

        		?>

			<input class="inputbox" type="text" name="data[event][cancel_date]" id="cancel_date" size="12" maxlength="10" value="<?php echo $row->cancel_date; ?>" />

            	<input type="reset" class="button" value="..." onclick="return showCalendar('cancel_date', 'y-mm-dd');" />

        		<?php

        		}

        	?>

<input type="text" class="timeEntry" id="cancel_time" name="data[event][cancel_time]" value="<?php echo $row->cancel_time; ?>" />

	    	</td>

        <td align="left"><?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>
      
            <tr>
	
                                 <td><?php echo JText::_( 'DT_CHANGE_FEE_ENABLE' ); ?>:</td>

                                 <td> <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));

								   echo JHTML::_('select.radiolist', $options,'data[event][changefee_enable]','','value','text',$row->changefee_enable);

								   ?></td>

                                <td><?php echo JHTML::tooltip((JText::_( 'DT_CHANGE_FEE_ENABLE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

                              <tr>

                                 <td><?php echo JText::_( 'DT_CHANGE_FEE_TYPE' ); ?>:</td>

                                 <td> <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_AMOUNT' ));

								   $options[]=JHTML::_('select.option', '2', JText::_( 'DT_PERCENTAGE' ));

								   echo JHTML::_('select.radiolist', $options,'data[event][changefee_type]','','value','text',$row->changefee_type);

								   ?></td>

                                 <td><?php echo JHTML::tooltip((JText::_( 'DT_CHANGE_FEE_TYPE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

                              <tr>

                                 <td><?php echo JText::_( 'DT_CHANGE_FEE' ); ?>:</td>

                                 <td> 

                                   <input type="text" size="10" value="<?php echo $row->changefee ?>" name="data[event][changefee]"/>

                                   </td>

                                 <td><?php echo JHTML::tooltip((JText::_( 'DT_CHANGE_FEE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

                              <tr>

                                 <td><?php echo JText::_( 'DT_CANCEL_FEE_ENABLE' ); ?>:</td>

                                 <td> <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));

								   echo JHTML::_('select.radiolist', $options,'data[event][cancelfee_enable]','','value','text',$row->cancelfee_enable);

								   ?></td>

                                 <td><?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_FEE_ENABLE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

                              <tr>

                                 <td><?php echo JText::_( 'DT_CANCEL_FEE_TYPE' ); ?>:</td>

                                 <td> <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_AMOUNT' ));

								   $options[]=JHTML::_('select.option', '2', JText::_( 'DT_PERCENTAGE' ));

								   echo JHTML::_('select.radiolist', $options,'data[event][cancelfee_type]','','value','text',$row->cancelfee_type);

								   ?></td>

                                 <td><?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_FEE_TYPE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

                              <tr>

                                 <td><?php echo JText::_( 'DT_CANCEL_FEE' ); ?>:</td>

                                 <td> 

                                   <input type="text" size="10" value="<?php echo $row->cancelfee; ?>" name="data[event][cancelfee]"/>

                                   </td>

                                 <td><?php echo JHTML::tooltip((JText::_( 'DT_CANCEL_FEE_HELP' )), '', 'tooltip.png', '', '');?></td>

                              </tr>

      </table>
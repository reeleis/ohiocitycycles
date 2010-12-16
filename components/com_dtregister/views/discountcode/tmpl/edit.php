<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
   global $Itemid ;
   $dt_code = $this->getModel('discountcode')->table;

   $dt_code->load($_REQUEST['id']);
   $document =& JFactory::getDocument();

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/form.js');

	?>

    <form name="adminForm" id="updateDiscountCode" method="post" action="index.php">

    <table width="100%" class="adminlist">

			<tbody>

			<tr>

				<th class="dt_heading" colspan="3"><?php echo JText::_( 'DT_DISCOUNT_CODE');?> <?php echo JText::_( 'DT_DETAILS');?></th>

			</tr>

			<tr>

				<td width="20%" align="left" valign="top"><?php echo JText::_( 'DT_NAME');?>:</td>

				<td valign="top" align="left" width="30%">

				<input class="text_area" type="text" name="name" size="30" maxlength="50" value="<?php echo $dt_code->name?>"  />

				</td>

					<td valign="top" align="left">
                       <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_NAME_HELP' )), '', 'tooltip.png', '', ''); ?>
					
					</td>

			</tr>

			<tr class="typeshow type1 type3 type4" >

				<td><?php echo JText::_( 'DT_START_DATE');?>:</td>

				<td align="left">

				<?php echo JHTML::_("calendar",$dt_code->start,"start","start",'%Y-%m-%d %H:%M:%S',array('size'=>'25','showsTime'=>'true')); ?>

				</td>

					<td valign="top" align="left">
                       <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_STARTDATE_HELP' )), '', 'tooltip.png', '', ''); ?>
					
					</td>

			</tr>

			<tr class="typeshow type1 type3 type4">

				<td><?php echo JText::_( 'DT_END_DATE');?>:</td>

				<td align="left">

					<?php echo JHTML::_("calendar", $dt_code->end,"end","end",'%Y-%m-%d %H:%M:%S',array('size'=>25,'showsTime'=>'true')); ?>

				</td>

					<td valign="top" align="left">
                     <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_ENDDATE_HELP' )), '', 'tooltip.png', '', ''); ?>
					
					</td>

			</tr>

            <tr class="typeshow type1 type3 type4">

				<td><?php echo JText::_( 'DT_DISCOUNT_CODE_LIMIT');?>:</td>

				<td align="left">

                    <input class="text_area" type="text" name="limit" size="10" maxlength="4" value="<?php echo $dt_code->limit;?>" />

				</td>

					<td valign="top" align="left">
                      <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_CODE_LIMIT_HELP' )), '', 'tooltip.png', '', ''); ?>
					
					</td>

			</tr>

			<tr class="typeshow type1 type3 type4">

				<td><?php echo JText::_( 'DT_PUBLISH');?>:</td>

				<td>

                  <?php

					   			  $options=array();

								   $options[]=JHTML::_('select.option',"0",JText::_( 'NO'));

								   $options[]=JHTML::_('select.option',"1",JText::_( 'YES'));

								   echo JHTML::_('select.genericlist',$options,"publish","","value","text",$dt_code->publish);

								   ?>

				</td>

				</td>

					<td valign="top" align="left">
                     <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_PUBLISH_HELP' )), '', 'tooltip.png', '', ''); ?>
					
				</td>

			</tr>
            
            <tr class="typeshow type1 type3 type4">

				<td><?php echo JText::_( 'DT_ENABLE_FOR');?>:</td>

				<td>

                  <?php

					$options=array();

					$options[]=JHTML::_('select.option',"0",JText::_( 'DT_PER_EVENT'));

					$options[]=JHTML::_('select.option',"1",JText::_( 'DT_ALL_EVENT'));

					echo JHTML::_('select.genericlist',$options,"events_enable","","value","text",$dt_code->events_enable);

				  ?>

				</td>

				</td>

					<td valign="top" align="left">
                     <?php echo JHTML::tooltip((JText::_( 'DT_ENABLE_FOR_HELP' )), '', 'tooltip.png', '', ''); ?>
					
				</td>

			</tr>

			<tr class="typeshow  type1 type3 type4">

				<td><?php echo JText::_( 'DT_CODE_DISCOUNT_TYPE');?>:</td>

				<td align="left">

               <?php

				$options=array();

				$options[]=JHTML::_('select.option',"1",JText::_( 'DT_AMOUNT'));

				$options[]=JHTML::_('select.option',"2",JText::_( 'DT_PERCENTAGE'));

				echo JHTML::_('select.genericlist',$options,"discount_type","","value","text",$dt_code->discount_type);

				?>

				</td>

					<td valign="top" align="left">
                          <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_CODE_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?>
				
					</td>

			</tr>

			<tr class="typeshow type2">

				<td><?php echo JText::_( 'DT_AMOUNT');?>:</td>

				<td align="left">

					<input class="text_area" type="text" name="amount" size="10" maxlength="250" value="<?php echo $dt_code->amount; ?>" />

				</td>

					<td valign="top" align="left">
                      <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_CODE_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?>
					
					</td>

			</tr>

			<tr class="typeshow type2">

				<td><?php echo JText::_( 'DT_DISCOUNT_CODE');?>:</td>

				<td align="left">

					<input class="text_area" type="text" name="code" size="10" maxlength="250" value="<?php echo $dt_code->code; ?>" />

				</td>

					<td valign="top" align="left">
                     <?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_CODE_HELP' )), '', 'tooltip.png', '', ''); ?>
				
					</td>

			</tr>

			</tbody>

		</table>
    
     <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

	 <input type="hidden" name="id" value="<?php echo $dt_code->id?>" />
     
     <input type="hidden" name="controller" value="discountcode" />
     <input type="hidden" name="task" value="" />
     <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>">
</form>

     <script src="../components/com_dtregister/assets/js/jquery.js" language="javascript" type="text/javascript"></script>

     <script src="../components/com_dtregister/assets/js/form.js" language="javascript" type="text/javascript"></script>

     <script language="JavaScript" type="text/javascript">

		 function submitbutton(pressbutton)

		{
            if(pressbutton=="cancel"){
		     submitform(pressbutton);
		   }else{
			
			document.adminForm.task.value = pressbutton;
			data = DTjQuery('#updateDiscountCode').formSerialize();

			DTjQuery.post('index.php?no_html=1', data,function(){},'script');

			return false;
		   }

		}

		</script>

    <?php 

?>
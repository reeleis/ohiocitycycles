<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 $section = $this->getModel('section')->table;

 $discountcode = $this->getModel('discountcode')->table;

 $row = $this->row;

 $config = $this->getModel('config');

 $paymentmethod = $this->getModel('paymentmethod');

 $cardtype = $this->getModel('cardtype');

 $paylater = $this->getModel('paylater');

 $currency= $this->getModel('currency');

?>

<table class="adminlist" width="100%" cellpadding="10" cellspacing="10">

   <tr>

      <td>

        <?php echo JText::_("DT_SELECT_PAYMENT_CONFIG");?>

      </td>

      <td>

        <?php 
		  $default = $this->getModel('payoption')->table;
		  $defaultpayment = $default->find(' `default`=1 ');
		  
		  if($defaultpayment){
			  $defaultpayment = $defaultpayment[0];
		   }else{
			   $defaultpayment = new stdClass;
			   $defaultpayment->id = "";
		   }
		   
		echo JHTML::_('select.genericlist',DtHtml::options($this->row->TablePayoption->optionslist()),'data[event][payment_id]','','value','text',isset($row->payment_id)?$row->payment_id:$defaultpayment->id );?>

      </td>

	  <td colspan="2" align="left">

         <?php echo JHTML::tooltip((JText::_( 'DT_SELECT_PAYMENT_CONFIG_HELP' )), '', 'tooltip.png', '', ''); ?>

      </td>

   </tr>      
 
        <tr>

	   <?php

        $options=array();

	      $options[]=JHTML::_('select.option',"1",JText::_( 'DT_EVENT_PARTIAL_PAYMENT_YES_OPTIONAL' ));

	      $options[]=JHTML::_('select.option',"2",JText::_( 'DT_EVENT_PARTIAL_PAYMENT_YES_REQUIRED' ));

	      $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

	     ?>

       <td>

          <?php echo JText::_( 'DT_EVENT_PARTIAL_PAYMENT_ALLOW' ); ?>:

       </td>

       <td>

       <?php 

	       echo JHTML::_('select.genericlist', $options,"data[event][partial_payment]","","value","text",$row->partial_payment);

	     ?>

       </td>

       <td colspan="2" align="left">

         <?php echo JHTML::tooltip((JText::_( 'DT_EVENT_PARTIAL_PAYMENT_ALLOW_HELP' )), '', 'tooltip.png', '', ''); ?>

       </td>

      </tr>

      <tr align="center" valign="middle">

	  	 <td align="left" valign="top"><?php echo JText::_( 'DT_PARTIAL_AMOUNT' ); ?>:</td>

    	 <td align="left" valign="top">	<input type="text" id="partial_amount" name="data[event][partial_amount]" value="<?php echo $row->partial_amount ?>" /></td>

		 <td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_PARTIAL_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	   </tr>

      <tr>

         <tr align="center" valign="middle">

	  	 <td align="left" valign="top"><?php echo JText::_( 'DT_PARTIAL_MINIMUM_AMOUNT' ); ?>:</td>

    	 <td align="left" valign="top">	<input type="text" name="data[event][partial_minimum_amount]" id="partial_minimum_amount" value="<?php echo $row->partial_minimum_amount ?>" /></td>

		   <td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_PARTIAL_MINIMUM_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	    </tr>

       <tr>

	   <?php

        $options=array();

	      $options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));

	      $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

	     ?>

       <td>

          <?php echo JText::_( 'DT_TAX_ALLOW' ); ?>:

       </td>

       <td>

       <?php 

	       echo JHTML::_('select.genericlist', $options,"data[event][tax_enable]","","value","text",$row->tax_enable);

	     ?>

       </td>

       <td colspan="2" align="left">

         <?php echo JHTML::tooltip((JText::_( 'DT_TAX_ALLOW_HELP' )), '', 'tooltip.png', '', ''); ?>

       </td>

      </tr>

      <tr align="center" valign="middle">

	  	 <td align="left" valign="top"><?php echo JText::_( 'DT_TAX_AMOUNT' ); ?>:</td>

    	 <td align="left" valign="top">	<input type="text" id="tax_amount" name="data[event][tax_amount]" value="<?php echo $row->tax_amount ?>" /></td>

		   <td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_TAX_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

      <tr align="center" valign="middle">

      <td align="left" valign="top"><?php echo JText::_( 'DT_DISCOUNT_TYPE' ); ?>:</td>

	    <td align="left" valign="top">

	    <?php

	    $options=array();

	    $options[]=JHTML::_('select.option',"0",JText::_( 'DT_NONE'));

	    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_AMOUNT'));

	    $options[]=JHTML::_('select.option',"2",JText::_( 'DT_PERCENTAGE'));

         echo JHTML::_('select.genericlist', $options,"data[event][discount_type]","","value","text",$row->discount_type);

	    ?>

	    </td>

	<td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

	  <tr align="center" valign="middle">

	  	<td align="left" valign="top"><?php echo JText::_( 'DT_DISCOUNT_AMOUNT' ); ?>:</td>

    	<td align="left" valign="top">	<input type="text" name="data[event][discount_amount]" value="<?php echo $row->discount_amount; ?>" /></td>

		<td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_DISCOUNT_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	</tr>

    <tr align="center" valign="middle">

      <td align="left" valign="top"><?php echo JText::_( 'DT_BIRD_DISCOUNT_TYPE' ); ?>:</td>

	    <td align="left" valign="top">

	    <?php

	    $options=array();

	    $options[]=JHTML::_('select.option',"0",JText::_( 'DT_NONE'));

	    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_AMOUNT'));

	    $options[]=JHTML::_('select.option',"2",JText::_( 'DT_PERCENTAGE'));

	    echo JHTML::_('select.genericlist', $options,"data[event][bird_discount_type]","","value","text",$row->bird_discount_type);

	    ?>

	    </td>

	<td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_BIRD_DISCOUNT_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

    <tr align="center" valign="middle">

	  	<td align="left" valign="top"><?php echo JText::_( 'DT_BIRD_DISCOUNT_AMOUNT' ); ?>:</td>

    	<td align="left" valign="top">	<input type="text" name="data[event][bird_discount_amount]" value="<?php echo $row->bird_discount_amount ; ?>" /></td>

		  <td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_BIRD_DISCOUNT_AMOUNT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

    <tr>

        <td><?php echo JText::_( 'DT_BIRD_DISCOUNT_DATE' ); ?>:</td>

        <td>

        	<?php

        		if(defined('_JEXEC'))

        		{

        			echo JHTML::_("calendar",$row->bird_discount_date,"data[event][bird_discount_date]","bird_discount_date");

        		}

        		else

        		{

        		?>

        			<input class="inputbox" type="text" name="data[event][bird_discount_date]" id="bird_discount_date" size="12" maxlength="10" value="<?php echo $row->bird_discount_date; ?>" />

            	<input type="reset" class="button" value="..." onclick="return showCalendar('bird_discount_date', 'y-mm-dd');" />

        		<?php

        		}

        	?>

          <input type="text" class="timeEntry" id="bird_discount_time" name="data[event][bird_discount_time]" value="<?php echo $row->bird_discount_time; ?>" />

		    </td>

        <td colspan="2" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_BIRD_DISCOUNT_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>

      <tr>

	  	  <td valign="top" align="left"><?php echo JText::_( 'DT_LATE_FEE' ); ?>:</td>

        	  <td><input class="inputbox" type="text" name="data[event][latefee]" id="latefee" maxlength="10" value="<?php echo $row->latefee; ?>" /></td>

	  	  <td colspan="2" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_LATE_FEE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

     </tr>

     <tr>

	  	  <td valign="top" align="left"><?php echo JText::_( 'DT_LATE_FEE_DATE' ); ?>:</td>

	  	  <td>

	  	    <?php

              	if(defined('_JEXEC'))

        		{
	
			echo JHTML::_("calendar",$row->latefeedate,"data[event][latefeedate]","latefeedate");

        		}

        		else

        		{

        		?>

        			<input class="inputbox" type="text" name="data[event][latefeedate]" id="latefeedate" size="12" maxlength="10" value="<?php echo $row->latefeedate;?>" />

              <input type="reset" class="button" value="..." onclick="return showCalendar('latefeedate', 'y-mm-dd');" />

        		<?php

        		}

	  	    ?>

  <input type="text" class="timeEntry" id="latefeetime" name="data[event][latefeetime]" value="<?php echo $row->latefeetime; ?>" />
    </td>

	  <td colspan="2" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_LATE_FEE_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>

	<tr>

	    <td colspan="4" class="dt_heading"><b><?php echo JText::_( 'DT_EVENT_PRICING' ); ?>:</b></td>

    </tr>

    <tr>

	    <td colspan="4"><b><?php echo JText::_( 'DT_INDIVIDUAL_RATE' ); ?>:</b></td>

    </tr>

    <tr>

      <td valign="top" align="right"><?php echo JText::_( 'DT_INDIVIDUAL' ); ?>:<input type="hidden" name="data[group][0][member]" value="1" /></td>

      <td>

          <input class="inputbox" type="text" name="data[group][0][amount]" size="20" maxlength="10" value="<?php echo(isset($row->group[0]->amount))? htmlspecialchars( $row->group[0]->amount, ENT_QUOTES ):'';?>" />

     </td>

      <td colspan="2" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_INDIVIDUAL_RATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

    </tr>

    <tr>

	    <td colspan="4"><b><?php echo JText::_( 'DT_GROUP_REGISTRATION_RATE' ); ?>:</b></td>

    </tr>

    <tr><td colspan="4"><?php echo JText::_( 'DT_GROUP_RATE_INSTRUCTION' ); ?>

           <ul><li><?php echo JText::_( 'DT_NUMBER_MEMBERS_EXPLANATION' ); ?></li>

           <li><?php echo JText::_( 'DT_RATE_TYPE_INSTRUCTION' ); ?></li>

           </ul></td>

    </tr>

    <?php

        $options=array();

	      $options[]=JHTML::_('select.option',"flat",JText::_( 'DT_FLAT_RATE' ));

	      $options[]=JHTML::_('select.option',"per_person",JText::_( 'DT_PER_PERSON' ));
	
	     ?>

   <tr>

     <td colspan="3">
     
      <span>
        <table>
          <tr>
            <td width="20%"><?php echo JText::_('DT_NUMBER_MEMBERS');?></td>
            <td width="20%"><?php echo JText::_('DT_RATE_TYPE');?></td>
            <td width="20%"><?php echo JText::_('DT_AMOUNT');?></td>
            <td width="40%" align="left">&nbsp;</td>
          </tr>
        </table>
      </span>

      <?php

	  if(!$row->group){

		?>

          <span class="addmorerate">

      <table>

      <tr>

      <td width="20%" valign="top" align="right"><input class="inputbox" id="groupmember" type="text" name="data[group][1][member]" size="20" maxlength="10" value="<?php echo isset($group->member)?$group->member:'';?>" onBlur="if(parseInt(this.value)==1){alert('Group must have members more than 1');this.value='';}" /></td>

      <td width="20%">

         <?php 

	       echo JHTML::_('select.genericlist', $options,"data[group][1][type]","","value","text",isset($group->type)?$group->type:'');

	     ?>

      <td width="20%" align="left"><input class="inputbox" id="groupamount" type="text" name="data[group][1][amount]" size="20" maxlength="10" value="<?php echo isset($group->amount)?$group->amount:'';?>" /></td>

      <td width="40%" align="left">&nbsp;</td>

    </tr>

      </table>

      </span>

        <?php

	  }
	  
      if(isset($row->group) && is_array($row->group))
	  $i = 0;
      foreach($row->group as $key=>$group){
        
		
	   if($key==0){

	      continue;

	   }
	   $i++;

	  ?>

       <span class="addmorerate">

      <table>

      <tr>

      <td width="20%" valign="top" align="right"><input class="inputbox" id="groupmember" type="text" name="data[group][<?php echo $i; ?>][member]" size="5" maxlength="10" value="<?php echo $group->member;?>" onBlur="if(parseInt(this.value)==1){alert('Group must have members more than 1');this.value='';}" /></td>

      <td width="20%">

         <?php 

	       echo JHTML::_('select.genericlist', $options,"data[group][".$i."][type]","","value","text",$group->type);

	     ?>

      <td width="20%" align="left"><input class="inputbox" id="groupamount" type="text" name="data[group][<?php echo $i; ?>][amount]" size="20" maxlength="10" value="<?php echo $group->amount;?>" /></td>

      <td width="40%" align="left">&nbsp;</td>

    </tr>

      </table>

      </span>

       <?php } ?>

     </td>

   </tr>

    <tr>

	  	  <td align="left" colspan="4">&nbsp;</td>

    </tr>

	<tr align="center" valign="middle">

	  	<td align="left" valign="top"><?php echo JText::_( 'DT_USE_DISCOUNT_CODE'); ?>:</td>

    	<td align="left" valign="top"><?php

        $options = array();

		$options[]=JHTML::_('select.option',"0",JText::_( 'NO'));

        $options[]=JHTML::_('select.option',"1",JText::_( 'YES'));

	      echo JHTML::_('select.genericlist',$options,"data[event][use_discountcode]","","value","text",$row->use_discountcode);

		    ?>

      </td>

	<td colspan="2"><?php echo JHTML::tooltip((JText::_( 'DT_USE_DISCOUNT_CODE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

        <?php

        echo  "<tr><th colspan='4' class='dt_heading'>". JText::_( 'DT_DISCOUNT_CODES') ."</th></tr>";

         $options = $discountcode->optionslist('publish=1');

		 echo  DtHtml::checkboxListrows('data[discountcode]',$options,4,$row->discountcode);

        ?>

     </table>

     <script type="text/javascript">

	  DTjQuery(function(){
		  
		    DTjQuery(".addmorerate").EnableMultiField({linkText:'<?php echo JText::_('DT_ADD_MORE')?>',removeLinkText:'<?php echo JText::_('DT_REMOVE');?>'});
		  
		  DTjQuery("#dataeventpartial_payment").change(function(){
		
			 switch(parseInt(DTjQuery(this).val())){
			    
				case 0:
				   DTjQuery("#partial_amount").val('');
				   DTjQuery("#partial_minimum_amount").val('');
				   DTjQuery("#partial_amount").attr('disabled',true);
				   DTjQuery("#partial_minimum_amount").attr('disabled',true);
				break;
				case 1:
				   DTjQuery("#partial_amount").val('');
				   //jQuery("#partial_minimum_amount").val('');
				   DTjQuery("#partial_amount").attr('disabled','disabled');
				   DTjQuery("#partial_minimum_amount").removeAttr('disabled');
				break;
				case 2:
				  // jQuery("#partial_amount").val('');
				   DTjQuery("#partial_minimum_amount").val('');
				   DTjQuery("#partial_amount").removeAttr('disabled');
				   DTjQuery("#partial_minimum_amount").attr('disabled',true);
				break;
			 
			 }
		   
		});
		
		   DTjQuery("#dataeventpartial_payment").trigger('change');
		   
	  });
	  
	 </script>
     
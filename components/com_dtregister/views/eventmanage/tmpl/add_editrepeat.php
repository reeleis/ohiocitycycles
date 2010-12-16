<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$document =& JFactory::getDocument();

$document->addScript("includes/js/joomla.javascript.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/validate.js");

$repetition = $this->row->repetition;
?>

<tr id='repeatrow'>

  <td colspan="3">

    <span style="display:none">

      <?php

		$options=array();

		$options[]=JHTML::_('select.option',"norepeat",JText::_( 'DT_NO_REPEAT' ));

	    $options[]=JHTML::_('select.option',"daily",JText::_( 'DT_DAILY' ));

		$options[]=JHTML::_('select.option',"weekly",JText::_( 'DT_WEEKLY' ));

		$options[]=JHTML::_('select.option',"monthly",JText::_( 'DT_MONTHLY' ));

        $options[]=JHTML::_('select.option',"yearly",JText::_( 'DT_YEARLY' ));

		echo JHTML::_('select.radiolist', $options, "data[event][repeatType]",' class="repeatType" ','value','text',isset($repetition->repeatType)?$repetition->repeatType:'norepeat');

	  ?>

      </span>

  </td>

</tr>

<tr>

  <td colspan="3">

       <span id='repeat'>

         <span id='common'>

            <span id='spanrpinterval' style="display:none">

             <?php echo JText::_('DT_INTERVAL'); ?>

             <input type="text" size="5" id='rpinterval' name='data[event][rpinterval]' value="1" />

             <span id='rpintervaltitle'></span>

           </span>

             <span id='spanrpcount'>

               <input type="radio" name='data[event][countselector]' id="rpcountselect"  <?php echo (isset($repetition->countselector) && $repetition->countselector == 'count')?'checked':'' ?> value="count" class = 'countselector' />

               <input type="text" name="data[event][rpcount]" id='rpcount' value= "<?php echo isset($repetition->rpcount)?$repetition->rpcount:''; ?>" size="5" />

              <?php echo JText::_('DT_REPEATS_OR_UNTIL'); ?>

           </span>

           

           <span id='spanrpuntil' >

             <input type="radio" name='data[event][countselector]' id="rpuntilselector"  <?php echo (isset($repetition->countselector) && $repetition->countselector == 'until')?'checked="checked"':'' ?> value="until" class = 'countselector' />

             <?php

               echo JHTML::_("calendar",isset($repetition->rpuntil)?$repetition->rpuntil:'',"data[event][rpuntil]","rpuntil");

			 ?>

             <!--input type="text" name="data[event][rpuntil]" id='rpuntil' /><input type="reset" class="button" value="..."

onclick="return DTshowCalendar('rpuntil');" /-->

            </span>

         </span>

         <br />

          <span id='weekly'>

              <?php echo JText::_('DT_BY_DAYS')?>: <?php

                 $options =  array(

				               Jtext::_('DT_SUN'),

							   Jtext::_('DT_MON'),

							   Jtext::_('DT_TUE'),

							   Jtext::_('DT_WED'),

							   Jtext::_('DT_THU'),

							   Jtext::_('DT_FRI'),

							   Jtext::_('DT_SAT')

				             );

			   echo   DtHtml::checkboxList('data[event][weekdays]',$options,isset($repetition->weekdays)?$repetition->weekdays:array());

			  ?>

          </span>

          

           <span id='monthly'>
	
	          <br /> 

              <table><tr><td valign="top">

               <input type="radio" name='data[event][monthdayselector]' value="monthdays"  <?php echo (isset($repetition->monthdayselector) && $repetition->monthdayselector == 'monthdays')?'checked':'' ?>  class = 'monthdayselector' />

               </td><td valign="top">

               <?php echo JText::_('DT_MONTH_DAYS_COMMA_SEPARATED')?>: 

               <input id='monthdays' type="text" value="<?php echo implode(",",isset($repetition->monthdays)?$repetition->monthdays:array()); ?>" name="data[event][monthdays]" />

               </td></tr>

               <tr><td valign="top">
	
	           <input type="radio" name='data[event][monthdayselector]' value="monthweekdays"  <?php echo (isset($repetition->monthdayselector) && $repetition->monthdayselector == 'monthweekdays')?'checked':'' ?>  class = 'monthdayselector' />
	
	           </td><td valign="top">

             <?php echo JText::_('DT_MONTH_DAYS_WEEK')?>: 

               <?php

                 $options =  array(

				               Jtext::_('DT_SUN'),

							   Jtext::_('DT_MON'),

							   Jtext::_('DT_TUE'),

							   Jtext::_('DT_WED'),

							   Jtext::_('DT_THU'),

							   Jtext::_('DT_FRI'),

							   Jtext::_('DT_SAT')

				             );

			   echo   DtHtml::checkboxList('data[event][monthweekdays]',$options,isset($repetition->monthweekdays)?$repetition->monthweekdays:array());

			  ?>

              <br />

               <?php echo JText::_('DT_WEEKS')?>: <?php

                 $options =  array(

				              1=> Jtext::_('DT_WEEK1'),

							  2=>Jtext::_('DT_WEEK2'),

							  3=>Jtext::_('DT_WEEK3'),

							  4=> Jtext::_('DT_WEEK4'),

							  5 => Jtext::_('DT_WEEK5'),

				             );

			   echo   DtHtml::checkboxList('data[event][monthweeks]',$options,isset($repetition->monthweeks)?$repetition->monthweeks:array());

			  ?>
			
			</td></tr>
			
			</table>

          </span>

           <!--span id='yearly' style="display:none">

            

            <?php //echo  JText::_('DT_YEAR_DAYS_COMMA_SEPARATED')?>

                   <input id='yeardays' type="text" value="<?php echo  implode(",",isset($repetition->yeardays)?$repetition->yeardays:array()); ?>" name="data[event][yeardays]"  />

          

          </span -->

       </span>

  </td>

</tr>

<script type="text/javascript" >

   DTjQuery(function(){

	    DTjQuery('.repeatType').change(function(){

			DTjQuery(".countselector:checked").trigger('change');

			//DTjQuery("#rpcountselect").attr('checked',true);

	        dispatch(DTjQuery(this).val(),[]);

	    })

		DTjQuery('.countselector').change(function(){

		    

			dispatch(DTjQuery(this).val(),[]);

				

		});

		DTjQuery('.monthdayselector').change(function(){

		    

			dispatch(DTjQuery(this).val(),[]);

				

		});

		

		

		DTjQuery("#repeat").hide();

		DTjQuery(".repeatType:checked").trigger('change');

   })

   

   function monthdays(){

	   DTjQuery('#monthdays').removeAttr('disabled');

	   DTjQuery('input[name="data\\[event\\]\\[monthweekdays\\]\\[\\]"]').attr('checked',false);

	   DTjQuery('input[name="data\\[event\\]\\[monthweeks\\]\\[\\]"]').attr('checked',false);

	   DTjQuery('input[name="data\\[event\\]\\[monthweekdays\\]\\[\\]"]').attr('disabled',true);

	   DTjQuery('input[name="data\\[event\\]\\[monthweeks\\]\\[\\]"]').attr('disabled',true);

	  // DTjQuery('#rpuntil').attr('disabled',true);

	   

	   

   }

   

   function monthweekdays(){

	   

	   DTjQuery('input[name="data\\[event\\]\\[monthweekdays\\]\\[\\]"]').removeAttr('disabled');

	   DTjQuery('input[name="data\\[event\\]\\[monthweeks\\]\\[\\]"]').removeAttr('disabled');

	   DTjQuery('#monthdays'). val('');

	   DTjQuery('#monthdays').attr('disabled',true);

	      

   }

   

   

   function count(){

	   DTjQuery('#rpcount').removeAttr('disabled');

	   DTjQuery('#rpuntil'). val('');

	   DTjQuery('#rpuntil').attr('disabled',true);

   }

   

   function until(){

	  DTjQuery('#rpuntil').removeAttr('disabled');

	  DTjQuery('#rpcount'). val('');

	  DTjQuery('#rpcount').attr('disabled',true);

	     

   }

   

   function norepeat(){

	   DTjQuery("#repeat").hide();

	    

   }

   

   function weekly(){

	   DTjQuery("#repeat").show();

	   DTjQuery("#rpintervaltitle").html('<?php echo JText::_('DT_WEEKS') ; ?>');

	   DTjQuery("#weekly").show();

	   DTjQuery("#monthly").hide();

	   DTjQuery("#yearly").hide();

   }

   

   function yearly(){

	   DTjQuery("#repeat").show();

	   DTjQuery("#rpintervaltitle").html('<?php echo JText::_('DT_YEARS') ; ?>');

	   DTjQuery("#weekly").hide();

	   DTjQuery("#monthly").hide();

	   DTjQuery("#yearly").show();

	   

   }

   

   function monthly(){

	    DTjQuery("#repeat").show();

	    DTjQuery("#rpintervaltitle").html('<?php echo JText::_('DT_MONTHS') ; ?>');

		DTjQuery("#weekly").hide();

	    DTjQuery("#monthly").show();

	    DTjQuery("#yearly").hide();

	        

   }

   

   function daily(){

	   DTjQuery("#repeat").show();

	   DTjQuery("#rpintervaltitle").html('<?php echo JText::_('DT_DAYS') ; ?>');

	   DTjQuery("#weekly").hide();

	   DTjQuery("#monthly").hide();

	   DTjQuery("#yearly").hide();

	   

	    

   }

   

   function dispatch(fn, args) {

    fn = (typeof fn == "function") ? fn : window[fn];  

    return fn.apply(this, args || []);  

}



   

</script>
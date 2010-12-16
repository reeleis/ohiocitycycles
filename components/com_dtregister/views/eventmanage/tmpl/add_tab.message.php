<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$editor =& JFactory::getEditor();
$row = $this->row;
?>

<table class="adminform" width="100%" cellpadding="10" cellspacing="10">

      <tr align="center" valign="middle">

       <td width="20%" align="left" valign="top" style="width:420px; padding-right:5px"><strong><?php echo JText::_( 'DT_INSTRUCTIONS' ); ?>:</strong></td>

       <td width="400" align="left" valign="top" style="width:620px"><?php echo $editor->display("data[event][topmsg]",stripslashes($row->topmsg),'200','','10','20','0'); ?></td>

	   <td colspan="2" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_INSTRUCTIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

	  <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_DESCRIPTION' ); ?>:</strong>

        	<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][event_describe_set]","",$row->event_describe_set); ?>

      </td>

     	<td align="left" valign="top"><?php echo $editor->display("data[event][event_describe]",stripslashes($row->event_describe),'','','20','20','0'); ?></td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_DESCRIPTION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
      <tr align="center" valign="middle">

      	<td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_THANK' ); ?>:</strong>
             		<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][thanksmsg_set]","",$row->thanksmsg_set); ?>
 
          <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

          </div>
 
      	</td>

     	<td align="left" valign="top">
		      <?php echo $editor->display("data[event][thanksmsg]",stripslashes($row->thanksmsg),'','','20','20','0'); ?>
      </td>

		<td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>
	  <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EVENT_PAYLATER_THANK' ); ?>:</strong>
         <br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][pay_later_thk_msg_set]","",$row->pay_later_thk_msg_set); ?>
      
         <div style="padding:5px 5px 5px 15px;">

            <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

            <br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

            <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

        </div>
      
      </td>

     	<td align="left" valign="top">
	     <?php echo $editor->display("data[event][pay_later_thk_msg]",stripslashes($row->pay_later_thk_msg),'','','20','20','0'); ?>
      </td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_PAYLATER_THANK_HELP' )), '', 'tooltip.png', '', ''); ?></td>
		  
	  </tr>

    <tr align="center" valign="middle">

      <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CUSTOM_TERMS_CONDITIONS' ); ?>:</strong>

        <br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][terms_conditions_set]","",$row->terms_conditions_set); ?>

      </td>

       <td align="left" valign="top">
        <?php echo $editor->display("data[event][terms_conditions_msg]",stripslashes($row->terms_conditions_msg),'','','20','20','0'); ?>
      </td>

		  <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_CUSTOM_TERMS_CONDITIONS_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	  </tr>

    <tr align="center" valign="middle">

     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CUSTOM_THANKS' ); ?>:</strong>

      	<br /><br /><?php echo JText::_( 'DT_ENABLE_FEATURE' );?>: <?php echo JHTMLSelect::booleanlist("data[event][thksmsg_set]","",$row->thksmsg_set); ?>

                 <div style="padding:5px 5px 5px 15px;">

                 <br /><?php echo JText::_( 'DT_TAG_INSERT_TEXT' );?>:

                 	<br />[EVENT_NAME] - <?php echo JText::_( 'DT_TAG_EVENT_NAME' );?>

	                 <br />[EVENT_DATE] - <?php echo JText::_( 'DT_TAG_EVENT_DATE' );?>

	                 <br />[LOCATION] - <?php echo JText::_( 'DT_TAG_LOCATION' );?>

	                 <br />[LOCATION_DETAILS] - <?php echo JText::_( 'DT_TAG_LOCATION_DETAILS' );?>

	                 <br />[GROUP_NUMBER] - <?php echo JText::_( 'DT_TAG_GROUP_NUMBER' ); ?>

	                 <br />[AMOUNT] - <?php echo JText::_( 'DT_TAG_AMOUNT' );?>

	                 <br />[AMOUNT_PAID] - <?php echo JText::_( 'DT_TAG_AMOUNT_PAID' );?>

	                 <br />[AMOUNT_DUE] - <?php echo JText::_( 'DT_TAG_AMOUNT_DUE' );?>

	                 <br />[AMOUNT_NOTAX] - <?php echo JText::_( 'DT_TAG_AMOUNT_NOTAX' );?>

	                 <br />[TAX] - <?php echo JText::_( 'DT_TAG_TAX' );?>

	                 <br />[PAYMENT_TYPE] - <?php echo JText::_( 'DT_TAG_PAYMENT_TYPE' );?>

	                 <br />[CONFIRM_NUM] - <?php echo JText::_( 'DT_TAG_CONFIRM_NUM' );?>

	                 <br />[BARCODE] - <?php echo JText::_( 'DT_TAG_BARCODE' );?>

	                 <br />[STATUS] - <?php echo JText::_( 'DT_TAG_STATUS' );?>

	                 <br />[PAID_STATUS] - <?php echo JText::_( 'DT_TAG_PAID_STATUS' );?>

	                 <br />[USERNAME] - <?php echo JText::_( 'DT_TAG_USERNAME' );?>
	
	                 <br />[PASSWORD] - <?php echo JText::_( 'DT_TAG_PASSWORD' );?>

	                 <br />[DATE_REGISTERED] - <?php echo JText::_( 'DT_TAG_DATE_REGISTERED' );?>
	
					 <br />{GROUP_MEMBER}  {/GROUP_MEMBER} - <?php echo JText::_( 'DT_TAG_GROUP_MEMBER' );?>

                 </div>

     </td>

      <td align="left" valign="top">
       <?php echo $editor->display("data[event][thksmsg]",stripslashes($row->thksmsg),'','340','20','20','0'); ?>
     </td>

		 <td colspan="2" align="left" valign="top">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_CUSTOM_THANKS_HELP' )), '', 'tooltip.png', '', ''); ?>

     </td>

	  </tr>

      	<tr>

		      <th colspan="4" style="background: #d3e8c1; padding:5px;"><?php echo JText::_( 'DT_EMAIL_FILE_ATTACHMENT' ); ?></th>

		    </tr>

		 <tr>

       		 <td>

       		    <?php echo JText::_( 'DT_SELECT_FILE' ); ?>:&nbsp;

             	<script type="text/javascript">

                DTjQuery(function(){
                        
					
						
						//jQuery('.fields').trigger('click');
						
				        DTjQuery(".remove_file").click(function(event){

					        event.preventDefault();

						    element = this;

					    	DTjQuery.get(DTjQuery(this).attr('href'), function(data){

								DTjQuery(element).parent().parent().remove();

						    });

						    return false ;

					});

                	var fileMax = 10;

                	DTjQuery("input.upload").change(function(){

                		doIt(this, fileMax);

                	});

				   

                });	

                function doIt(obj, fm) {

                	if(DTjQuery('input.upload').size() > fm) {alert('Max files is '+fm); obj.value='';return true;}

                	DTjQuery(obj).hide();

                	DTjQuery(obj).parent().prepend('<input type="file" class="upload" name="event_files[]" value="'+obj.value+'" />').find("input:first").change(function() {doIt(this, fm)});

                	var v = obj.value;

               		 if(v != '') {

                		DTjQuery("div#files_list").append('<div>'+v+' <input type="button" class="remove" value="Delete" /></div>')

                		.find("input").click(function(){

               			 	DTjQuery(this).parent().remove();

                			DTjQuery(obj).remove();

                			return true;

                		});

                	}

                };

	</script>

    <span>
			<input type="file" name="event_files[]"  class="upload"/>
 
            <div id="files_list">

            </div>

            </span>

        	</td>

        	<td>

        	  <?php echo JText::_( 'DT_FILE_ATTACHMENT_HELP' ); ?>

        	</td>
        	
        	<td colspan="2">&nbsp;</td>

        </tr>

     <?php 
	  
	  if($row->slabId==""){
	      echo $this->loadTemplate('copyfile');
	  }else{
	   echo $this->loadTemplate('editfile');
	  }
       
	 ?>

      </table>
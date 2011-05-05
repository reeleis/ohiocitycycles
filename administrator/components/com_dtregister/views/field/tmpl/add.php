<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$mfield = $this->getModel('field');

$row =  $this->getModel('field')->table;

$this->assign('row',$row);

$cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );

$id = $cid[0];

$row->load($id);

if(isset($_POST['name'])){

	  $row->bind( $_POST );

	  $row->name = "";

}

if(isset($this->copyfield)){

   unset($row->id);

   $row->id = "";

}

$fieldtype =  $this->getModel('fieldtype');

$dateformat =  $this->getModel('dateformat');

if($row->type<3){

	$atttribute=' disabled=true ';

} else {$atttribute='';}

  $document	=& JFactory::getDocument();
 
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validationmethods.js');
?>

		<script language="javascript" type="text/javascript">

		function submitbutton(pressbutton) {

			var form = document.adminForm;

			if (pressbutton == 'cancel') {

				submitform( pressbutton );

				return;

			}

			// do field validation

			if (form.name.value == ""){

				alert( "Field must have a name" );

				return;

			}

			var startChar=form.name.value.charAt(0);

			if((startChar>='0') && (startChar <= '9'))

			{

				alert("Cannot start field name with a number");

				return;

			}

			var re = new RegExp("[^a-zA-Z0-9_]");

			if (form.name.value.match(re))

			{

		    	alert("Field name only allow characters a-z,A-Z,0-9 and '_' character");

		    	return;

		  	}

			if (form.type.value == 1 || form.type.value == 3 || form.type.value == 4)

			{

			   if(form.usagelimit.value==""){

				    alert("<?php echo JText::_( 'DT_FIELD_LIMIT_REQUIRED' );?>");

                    return;

			   }

			   if(form.values.value == ""){

				    alert("<?php echo JText::_( 'DT_FIELD_VALUE_REQUIRED' );?>");

                    return;

			   }

		  	}

           if(DTjQuery(document.adminForm).valid()){

			submitform( pressbutton );
			
		   }else{
			  return;   
		   }

		}

		</script>

<form action="index2.php" method="post" name="adminForm" id="adminForm">

	<table class="adminheading">

		<tr>

			<th>

			<?php echo JText::_( 'DT_FIELD_MGMT' );?>:

			<small>

			<?php echo $row->id ? JText::_('DT_EDIT') : JText::_('DT_NEW');?>

			</small>

			</th>

		</tr>

	</table>

	<table width="100%" class="adminform" border="1">

      <tbody>

			<tr>

				<th colspan="3" class="dt_heading"><?php echo JText::_( 'DT_DETAILS' );?></th>

			</tr>

			<tr>

				<td width="20%" align="left" valign="top"><?php echo JText::_( 'DT_NAME' );?>:</td>

				<td valign="top" align="left" width="30%">

				<input class="text_area" type="text" name="name" size="50" maxlength="250" <?php echo ($row->id)?'readonly':''?> value="<?php echo $row->name;?>"  onChange="updateFieldName();" />

			    </td>

			    <td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_NAME' )), '', 'tooltip.png', '', '');?></td>

		    </tr>
            
            <tr>

				<td width="20%" align="left" valign="top"><?php echo JText::_( 'DT_EMAIL_TAG' );?>:</td>

				<td valign="top" align="left" width="30%">

				<input class="text_area required fieldtag" type="text" name="tag" id="tag"  size="50" maxlength="250" value="<?php echo $row->tag;?>" />

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_TAG' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr>

				<td valign="top" align="right"><?php echo JText::_( 'DT_FIELD_TYPE' );?>:</td>

				<td><?php	

				  $options=DtHtml::options($fieldtype->getTypes());

				  echo JHTML::_('select.genericlist', $options,"type","onchange='changeFieldType(1);'","value","text",$row->type);

				?></td>

				<td valign="top" align="left"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_FIELD_TYPE' ), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type0 type1 type5 type8">

				<td valign="top"><?php echo JText::_( 'DT_SIZE' );?>:</td>

				<td valign="top">

					<input type="text" name="field_size" size="10"  value="<?php echo $row->field_size?>" <?php if(($row->type !=0) && ($row->type !=1)) echo "disabled=true"; ?> />

				</td>

				<td valign="top"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_FIELD_SIZE' ), '', 'tooltip.png', '', '');?></td>

			</tr>
			
			<tr class="typeshow type0 type2 type8">

				<td valign="top"><?php echo JText::_( 'DT_MAXLENGTH' );?>:</td>

				<td valign="top">

				<input type="text" name="maxlength" size="10" value="<?php echo (isset($row->maxlength) && $row->maxlength !=0)?$row->maxlength:'' ?>" />

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_MAXLENGTH' )), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow  type2 ">

				<td valign="top"><?php echo JText::_( 'DT_SHOW_CHAR_COUNT' );?>:</td>

				<td valign="top">

				<?php echo JHTML::_('select.booleanlist','showcharcnt','',$row->showcharcnt); ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_SHOW_CHAR_COUNT' )), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow  type5 ">  

                <td align="left" valign="top"><?php echo JText::_( 'DT_DATE_FORMAT' ) ?>:</td>

				<td align="left" valign="top">

					<?php

                        $format_list=DtHtml::options($dateformat->getfieldformats());

						echo JHTML::_('select.genericlist',$format_list,"date_format",'','value','text',isset($row->date_format)?$row->date_format:'%m-%d-%Y');

					?>

                </td>

				<td><?php echo JHTML::tooltip((JText::_( 'DT_DATE_FORMAT_HELP' )), '', 'tooltip.png', '', ''); ?></td>

			</tr>

			<tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_LABEL' );?>:</td>

				<td valign="top">

				<input class="text_area" type="text" name="label" size="50" maxlength="250" value="<?php echo htmlentities(stripslashes($row->label),null,'UTF-8');?>" />

				</td>

				<td valign="top"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_FIELD_LABEL' ), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_CONDITION_FIELD' );?>:</td>

				<td valign="top">

                <?php

				echo $this->loadTemplate('parentlist');

				?>

                <br />

                <span id="parentoptions">

                </span>

				</td>

				<td valign="top"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_CONDITION_FIELD' ), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow type8">

				<td valign="top"><?php echo JText::_( 'DT_CONFIRMATION_FIELD' );?>:</td>

				<td valign="top">

                <?php

                  $confirmation_field = isset($row->confirmation_field)?$row->confirmation_field:0;

				  echo JHTML::_('select.booleanlist','confirmation_field','',$confirmation_field);

				?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_CONFIRMATION_FIELD' ), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow  type1 type3 type4" >

				<td><?php echo JText::_( 'DT_VALUES' );?>:</td>

				<td align="center">

					<textarea name="values" rows="3" cols="40" <?php if((!$row->type) || ($row->type==2)) echo  "disabled"; ?>><?php echo $row->values?></textarea>

					<br />(<?php echo JText::_( 'DT_VALUE_DELIMITED' );?>)

				</td>

				<td valign="top" align="left"><?php  echo JHTML::tooltip(JText::_( 'DT_HELP_FIELD_VALUES' ), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow  type1 type3 type4" >

				<td><?php echo JText::_( 'DT_SELECTION_LIMIT' );?>:</td>

				<td align="center">

					<textarea name="usagelimit" rows="3" cols="40" ><?php echo $row->usagelimit; ?></textarea>

					<br />(<?php echo JText::_( 'DT_VALUE_DELIMITED' );?>)

				</td>

				<td valign="top" align="left"><?php  echo JHTML::tooltip(JText::_( 'DT_HELP_SELECTION_LIMIT' ), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type1 type3 type4">

				<td><?php echo JText::_( 'DT_SELECTED_VALUES' );?>:</td>

				<td align="center">

					<input class="text_area" type="text" name="selected" size="70" maxlength="250" value="<?php echo implode("|",$row->selected);?>" <?php if((!$row->type) || ($row->type==2)) echo  "disabled"; ?> /> 

                    <br />(<?php echo JText::_( 'DT_VALUE_DELIMITED' );?>)

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_FIELD_SELECTED' ), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type1 type2 type3 type4">

				<td><?php echo JText::_( 'DT_FEE_FIELD' );?></td>

				<td>

					<input type="checkbox" name="fee_field" value="1" <?php if($row->fee_field==1) echo "checked"; ?> <?php if((!$row->type) || ($row->type==2)) echo  "disabled"; ?> onClick="changeFeeField();"/>

				</td>

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_FEE' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow  type1 type3 type4">

				<td><?php echo JText::_( 'DT_FEES' );?>:</td>

				<td align="center">

					<input class="text_area" type="text" name="fees" size="70" maxlength="" value="<?php echo implode("|",$row->fees) ;?>" <?php if((!$row->type) || ($row->type==2)) echo  "disabled"; ?> />

          <br />(<?php echo JText::_( 'DT_VALUE_DELIMITED' );?>)

				</td>

				<td valign="top" align="left"><?php  echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_FEES' )), '', 'tooltip.png', '', '');?></td>

			</tr>

      <tr class="typeshow  type1 type3 type4">

				<td><?php echo JText::_( 'DT_FEE_TYPE' );?>:</td>

				<td align="center">

          <?php

	        $options=array();

	        $options[]=JHTML::_('select.option',"1",JText::_( 'DT_AMOUNT' ));

	        $options[]=JHTML::_('select.option',"2",JText::_( 'DT_PERCENTAGE' ));

            $fee_type = isset($row->fee_type)?$row->fee_type:'1';

	        echo JHTML::_('select.genericlist', $options,"fee_type","","value","text",$fee_type);

	        ?>

				</td>

				<td valign="top" align="left"><?php  echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_FEE_TYPE' )), '', 'tooltip.png', '', '');?></td>

			</tr>

            <tr class="typeshow  type2">

				<td><?php echo JText::_( 'DT_TEXTAREA_FEE' );?>:</td>

				<td align="center">

					<input class="text_area" type="text" name="textareafee" size="50" maxlength="250" value="<?php echo $row->textareafee;?>" <?php if($row->type!=2) echo  "disabled"; ?> />

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_TEXTAREA_FEE' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow  type2">

				<td><?php echo JText::_( 'DT_ROWS' );?>:</td>

				<td align="center">

					<input class="text_area" type="text" name="rows" size="10" maxlength="250" value="<?php echo $row->rows;?>" <?php if($row->type!=2) echo  "disabled"; ?> />

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_ROWS' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow  type2">

				<td><?php echo JText::_( 'DT_COLUMNS' );?>:</td>

				<td align="center">

					<input class="text_area" type="text" name="cols" size="10" maxlength="250" value="<?php echo $row->cols;?>" <?php if($row->type!=2) echo  "disabled"; ?> />

				</td>

				<td valign="top" align="left"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_COLS' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type0 type1 type2 type3 type4 type5 type8">

			  <td valign="top"><?php echo JText::_( 'DT_DESCRIPTION' );?>:</td>

			  <td valign="top">

				<textarea name="description" rows="3" cols="40"><?php echo $row->description?></textarea>

			  </td>

			  <td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_DESCRIPTION' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type6">

        <td valign="top"><?php echo JText::_( 'DT_TEXTUAL' );?>:</td>

			  <td valign="top">

				<textarea name="textual" rows="3" cols="40"><?php echo stripslashes($row->textual)?></textarea>

			  </td>

			  <td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_TEXTUAL' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow  type6 ">

				<td valign="top"><?php echo JText::_( 'DT_TEXTUALDISPLAY_FIELD' );?>:</td>

				<td valign="top">

                <?php

                  $textualdisplay = isset($row->textualdisplay)?$row->textualdisplay:0;

			      echo JHTML::_('select.booleanlist','textualdisplay','',$textualdisplay);

				?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip(JText::_( 'DT_HELP_TEXTUALDISPLAY_FIELD' ), '', 'tooltip.png', '', '');?></td>

			</tr>

			<tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_PUBLISH' );?>:</td>

				<td valign="top">

				<?php echo JHTMLSelect::booleanlist('published',$atttribute,$row->published); ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_PUBLISHED' )), '', 'tooltip.png', '', '');?></td>

			</tr>
            
            <tr class="typeshow type0 type1 type2 type3 type4 type5 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_APPLY_FOR_CHANGE' );?>:</td>

				<td valign="top">

				<?php echo JHTMLSelect::booleanlist('applychangefee','',$row->applychangefee); ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_APPLY_FOR_CHANGE' )), '', 'tooltip.png', '', '');?></td>

			</tr>

           <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_HIDDEN' );?>:</td>

				<td valign="top">

				<?php echo JHTMLSelect::booleanlist('hidden',$atttribute,$row->hidden);

				 ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_HIDDEN' )), '', 'tooltip.png', '', '');?></td>

			</tr>
           
           <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_INCLUDE_IN_ALL_TAG' );?>:</td>

				<td valign="top">

				<?php echo JHTMLSelect::booleanlist('all_tag_enable',$atttribute,$row->all_tag_enable);

				 ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_INCLUDE_IN_ALL_TAG' )), '', 'tooltip.png', '', '');?></td>

			</tr> 
            

			<tr class="typeshow type3 type4">



				<td valign="top"><?php echo JText::_( 'DT_NEW_LINES' );?>:</td>



				<td valign="top">



				<?php echo JHTMLSelect::booleanlist('new_line',$atttribute,$row->new_line); ?>



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_NEWLINE' )), '', 'tooltip.png', '', '');?></td>



			</tr>

			<tr class="typeshow type7">



				<td valign="top"><?php echo JText::_( 'DT_FILE_SIZE' );?>:</td>



				<td valign="top">



				<input type="text" name="filesize" size="50" value="<?php echo isset($row->filesize)?$row->filesize:'' ?>" />



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FILE_SIZE' )), '', 'tooltip.png', '', '');?></td>



			</tr>

            

      <tr class="typeshow type7">



				<td valign="top"><?php echo JText::_( 'DT_FILE_TYPES' );?>:</td>



				<td valign="top">



				<input type="text" name="filetypes" size="50" value="<?php echo isset($row->filetypes)?$row->filetypes:'' ?>" />



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FILE_TYPES' )), '', 'tooltip.png', '', '');?></td>



			</tr>

            

      <tr class="typeshow type7">



				<td valign="top"><?php echo JText::_( 'DT_UPLOAD_ATTACHMENT' );?>:</td>



				<td valign="top">



        <?php

				$upload = isset($row->filetypes)?$row->upload:0;

				echo JHTML::_('select.booleanlist','upload','',$upload);



        ?>



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_UPLOAD_ATTACHMENT' )), '', 'tooltip.png', '', '');?></td>



			</tr>
			
			<tr class="typeshow type0 type1 type2 type3 type4 type5 type7 type8">  <td align="left" valign="top"><?php echo JText::_( 'DT_LISTINGS' ); ?>:</td>

						    <td align="left" valign="top">

                            <?php
                             if(in_array($row->name,$row->defaultListing)){
							    
								$listattr = " class = 'listing' ";
								$listattr = "";
							 }else{
								 
								 $listattr = "";
								 
							 }
							 
							 echo DtHtml::checkboxList('listing',$mfield->listingTypes,$row->listing,"","",$listattr);

							?>

                           </td>

								<td><?php echo JHTML::tooltip((JText::_( 'DT_LISTINGS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

						  </tr>

			<tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

			  <td colspan="3" class="dt_heading"><?php echo JText::_( 'DT_DEFAULT_SETTINGS' );?></td>

			</tr>

      <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">

				<td valign="top"><?php echo JText::_( 'DT_ALL_EVENT' );?>:</td>

				<td valign="top">

				<?php echo JHTMLSelect::booleanlist('allevent',$atttribute,$row->allevent); ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_ALL_EVENT' )), '', 'tooltip.png', '', '');?></td>

			</tr>

             <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">



				<td valign="top"><?php echo JText::_( 'DT_SHOW' );?>:</td>



				<td valign="top">



				<?php 
              $options = array();
				$options[]=JHTML::_('select.option',"0",JText::_( 'DT_NONE' ));

   $options[]=JHTML::_('select.option',"1",JText::_( 'DT_INDIVIDUAL' ));

   $options[]=JHTML::_('select.option',"2",JText::_( 'DT_GROUP' ));

   $options[]=JHTML::_('select.option',"3",JText::_( 'DT_BOTH'));

	echo JHTML::_('select.radiolist', $options,"showed","","value","text",$row->showed);

				 ?>



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_SHOW' )), '', 'tooltip.png', '', '');?></td>



			</tr>

            

      <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">



				<td valign="top"><?php echo JText::_( 'DT_REQUIRED' );?>:</td>



				<td valign="top">



				<?php echo JHTMLSelect::booleanlist('required',$atttribute,$row->required);; ?>



				</td>



				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_REQUIRED' )), '', 'tooltip.png', '', '');?></td>



			</tr>

            

      <tr class="typeshow type0 type1 type2 type3 type4 type5 type6 type7 type8">



				<td valign="top"><?php echo JText::_( 'DT_CUSTOM_FIELD_GROUPOPTIONS' );?>:</td>



				<td valign="top">

				<?php

				 $options = array();

   $options[]=JHTML::_('select.option',"1",JText::_( 'DT_EACH_MEMBER' ));

   $options[]=JHTML::_('select.option',"2",JText::_( 'DT_BILLING_ONLY' ));

   $options[]=JHTML::_('select.option',"3",JText::_( 'DT_MEMBERS_BILLING'));

				 echo JHTML::_('select.radiolist', $options,"group_behave","","value","text",$row->group_behave);

 ?>

				</td>

				<td valign="top"><?php echo JHTML::tooltip((JText::_( 'DT_HELP_FIELD_GROUPOPTIONS' )), '', 'tooltip.png', '', '');?></td>

			</tr>

			</tbody>

		</table>

          <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

          <input type="hidden" name="controller" value="field" />

          <input type="hidden" name="task" value="" />

		  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

		</form>

		<script language="javascript">

         DTjQuery(function(){
		      
			DTjQuery(document.adminForm).validate({
	             success: function(label) {
				            label.addClass("success");
			              }

	        });
			//DTjQuery('#tag').rules('add','required');
			//DTjQuery('#tag').rules('add','fieldtag');
			  	 
		 });

			window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });

			function updateFieldName()

			{

				var form=document.adminForm;

				var fieldName=form.name;

				if(fieldName.value.indexOf(' ')!=-1)

				{

					//We will replace the space here

					var re = new RegExp("[ ]", "g");

				    fieldName.value= fieldName.value.replace(re,"_");

					alert('Spaces are not allowed in the field name. Your space has been replaced by a _ character');

				}

				var re = new RegExp("[^a-zA-Z0-9_]");

				if (fieldName.value.match(re))

				{

			    	alert("Field name only allow characters a-z,A-Z,0-9 and '_' character");

			    	return;

			  	}

			}

			function changeFieldType(rest)

			{

				var form=document.adminForm;

				var fieldType=form.type.value;

				DTjQuery('.typeshow').css({display:'none'});

                DTjQuery('.typeshow').find('input , select , textarea').attr('disabled',true);

				if(navigator.appName.indexOf("Micro") >=0){

					display = 'block';

				}else{

					display = 'table-row';

				}

				DTjQuery('.type'+fieldType).css({display:display});

				DTjQuery('.type'+fieldType).find('input , select , textarea').removeAttr('disabled');

				if(fieldType == 1 || fieldType == 3 || fieldType == 4 ){

				   form.values.disabled=false;

					form.selected.disabled=false;

					form.fee_field.disabled=false;

					if(form.fee_field.checked==true)

						form.fees.disabled=false;

					else

						form.fees.disabled=true;

				}else{

					if(fieldType == 2){

						form.fee_field.disabled = false;

				    }else{

						form.fee_field.disabled = true;

				    }

				}

				DTjQuery('#published0').attr('disabled',false);

				DTjQuery('.type'+fieldType).attr('value','');

				DTjQuery('#published1').attr('disabled',false);

				DTjQuery('#hidden0').attr('disabled',false);

				DTjQuery('#hidden1').attr('disabled',false);

				DTjQuery('#allevent0').attr('disabled',false);

				DTjQuery('#allevent1').attr('disabled',false);

				DTjQuery('#required0').attr('disabled',false);

				DTjQuery('#required1').attr('disabled',false);

				DTjQuery('#showed0').attr('disabled',false);

				DTjQuery('#showed1').attr('disabled',false);

			}

			function changeFeeField()

			{

				var form=document.adminForm;

				if(form.fee_field.checked==1)

				{

					form.fees.disabled=false;

					form.textareafee.disabled=false;

				}

				else

				{

					form.fees.disabled=true;

					form.textareafee.disabled=true;

				}

			}

			<?php
			   
			   if(is_array($row->selection_values) && count($row->selection_values)){
				   ?>
				    var selection_values = <?php echo json_encode($row->selection_values);?>;
				   <?php
			    }elseif($row->selection_values!= "" && !is_array($row->selection_values)){
					 ?>
				    var selection_values = <?php echo json_encode(explode(",",$row->selection_values));?>;
				   <?php
				}else{
					?>
					var selection_values = [];
					<?php
				   	
				}
			 
			?>

            DTjQuery(function(){

			   changeFieldType(0);
                
			   <?php
			      
				  if(in_array($row->name,$row->defaultListing)){
					  ?>
					   DTjQuery('.listing').attr('disabled',true);
					  <?php
				   }
				  
			   ?>
			   
			   DTjQuery('#parent_id').change(function(){

				  if(DTjQuery(this).val()!=""){

				      DTjQuery('#parentoptions').load("index.php?option=<?php echo DTR_COM_COMPONENT; ?>&controller=field&task=options&no_html=1&id="+DTjQuery(this).val(),function(){

		 	DTjQuery('#parentoptions').find('input').val(selection_values);

			selection_values = [];

		})

				  }

			   })

			   DTjQuery('#parent_id').trigger('change');

			})

		</script>

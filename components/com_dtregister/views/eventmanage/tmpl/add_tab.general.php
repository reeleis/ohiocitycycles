<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$jevent = $this->getModel('event')->tableJevt;

$category = $this->getModel('category')->table;

$location = $this->getModel('location')->table;

$section = $this->getModel('section')->table;

$row = $this->row;

$article = $row->get_article();

$jusertable = $this->getModel('user')->table->TableJUser;

?>

<table cellpadding="4" cellspacing="1" border="1" width="100%" class="adminform">

    <tr><td><?php echo JText::_( 'DT_EVENT_OWNER' ); ?>:</td>
	
	    <td><?php  echo JHTML::_('select.genericlist', DtHtml::options($jusertable->optionslist(),JText::_("DT_SELECT_USER")),'data[event][user_id]',' ','value','text',$row->user_id)?></td>
	
	    <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_OWNER_HELP' )), '', 'tooltip.png', '', ''); ?></td>
	
	</tr>  
    <?php 
	  if($row->slabId == ""){
		  echo $this->loadTemplate('event_type');
	 ?>
    <tr id="jeventrow">

        <td><?php echo JText::_( 'DT_SELECT_JEVENT' ); ?>:</td>

        <td width="400" id="jeventrow">

 			  <?php 

			   $events=DtHtml::options($jevent->optionslist(),JText::_('DT_SELECT_EVENT'));

			   echo JHTML::_('select.genericlist', $events,"data[event][eventId]","","value","text",$row->eventId); ?></td>

        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SELECTION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>
     <?php
     }else{
	    
		if($row->eventId){
		?>
         <script type="text/javascript">
		 
		   DTjQuery(function(){
			  DTjQuery('tr[id="timerow"]').find('input').attr('disabled',true);
			  DTjQuery("#dtstarttime").timeEntry('destroy');
              DTjQuery("#dtendtime").timeEntry('destroy');
		   })
		 </script>
        <?php
		}	 
	 
	 }
	  
	  ?>
       <tr id="timerow">

      	<td align="right"><?php echo JText::_( 'DT_EVENT_TITLE' ); ?>:</td>

      	<td>

            <input type="text" id="summary" name="data[event][title]" value="<?php echo $row->title; ?>"  />

      	</td>

      	<td colspan="2" align="left">

      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_TITLE_HELP' )), '', 'tooltip.png', '', ''); ?>

      	</td>

   </tr>

   <tr>

	 <td><?php echo JText::_( 'DT_EVENT_CATEGORY' ); ?>:</td>

    <td><?php  

        $options=DtHtml::options($category->optionslist(),JText::_('DT_NONE'));

		echo JHTML::_('select.genericlist', $options,"data[event][category]","","value","text",$row->category); ?></td>

    <td colspan="2">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_CATEGORY_HELP' )), '', 'tooltip.png', '', ''); ?></td>

    </tr>

      <tr>

        <td><?php echo JText::_( 'DT_SELECT_LOCATION' ); ?>:</td>

        <td>

 			  <?php 

              $locationsOpts = DtHtml::options($location->optionslist(),JText::_('DT_SELECT_EVENT'));

			  echo JHTML::_('select.genericlist', $locationsOpts,"data[event][location_id]","","value","text",$row->location_id); ?></td>

        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_SELECT_LOCATION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

   </tr>

    <tr>

      	<td align="right"><?php echo JText::_( 'DT_EVENT_PUBLISH' ); ?>:</td>

      	<td>

			<?php

			$options=array();

			$options[]=JHTML::_('select.option',"0",JText::_( 'No' ));

			$options[]=JHTML::_('select.option',"1",JText::_( 'Yes' ));

            echo JHTML::_('select.radiolist', $options, 'data[event][publish]','','value','text',$row->publish);

			?>

      	</td>

      	<td colspan="2" align="left">

      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_PUBLISH_HELP' )), '', 'tooltip.png', '', ''); ?>

      	</td>

      </tr>

   <tr align="center" valign="middle" >
	
	  <td align="left" valign="top"><?php echo JText::_( 'DT_TIME_FORMAT' );?>:</td>

		<td align="left" valign="top">

			<?php

			$options = array();

            $options[]=JHTML::_('select.option', '1', JText::_( 'DT_12_FORMAT' ));

            $options[]=JHTML::_('select.option', '2', JText::_( 'DT_24_FORMAT' ));

			echo JHTML::_('select.genericlist', $options,'data[event][timeformat]','','value','text',$row->timeformat);

			?>

		</td>

		<td>&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_TIME_FORMAT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

		</tr>
       <tr id="timerow">

      	<td align="right"><?php echo JText::_( 'DT_EVENT_START' ); ?>:</td>

      	<td>
        <input type="text" class="error" id="dtstart" name="data[event][dtstart]" value="<?php echo $row->dtstart; ?>">
         <?php //echo   JHTML::_("calendar",$row->dtstart,"data[event][dtstart]","dtstart",'%Y-%m-%d','class="checkdate"');?>

           <input type="button" class="button jeventdisable" value="..."

onclick="return DTshowCalendar('dtstart','%Y-%m-%d');" />

			<input type="text" class="timeEntry checkdate " id="dtstarttime" name="data[event][dtstarttime]" value="<?php echo $row->dtstarttime; ?>" />&nbsp;
           <label for="dtstart" generated="true" class="error" style="display:none"></label>
           
      	</td>

      	<td colspan="2" align="left">

      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_START_HELP' )), '', 'tooltip.png', '', ''); ?>

      	</td>

      </tr>

       <tr id="timerow">

      	<td align="right"><?php echo JText::_( 'DT_EVENT_END' ); ?>:</td>

      	<td>
            <input type="text" class="" id="dtend" name="data[event][dtend]" value="<?php echo $row->dtend; ?>">
            <?php //echo  JHTML::_("calendar",$row->dtend,"data[event][dtend]","dtend",'%Y-%m-%d','class="checkdate"');?>

             <input type="button" class="button jeventdisable" value="..."

onclick="return DTshowCalendar('dtend','%Y-%m-%d');" />

            <input type="text" class="timeEntry checkdate" id="dtendtime" name="data[event][dtendtime]" value="<?php echo $row->dtendtime; ?>" />

      	</td>

      	<td colspan="2" align="left">

      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_END_HELP' )), '', 'tooltip.png', '', ''); ?>

      	</td>

    </tr>

      <tr>

	  	 <td><?php echo JText::_( 'DT_SEND_NOTIFICATION_TO' ); ?>:</td>

         <td align="left"><input class="inputbox required" type="text" name="data[event][email]" id="email" size="60" value="<?php echo $row->email; ?>" /></td>

	  <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_SEND_NOTIFICATION_TO_HELP' )), '', 'tooltip.png', '', ''); ?></td>

   </tr>

       <?php
	    
	     if($row->slabId =="" ){

             echo  $this->loadTemplate('repeat');

		 }elseif($row->parent_id == 0 && $row->repetition_id > 0){

			 echo  $this->loadTemplate('editrepeat');

		 }elseif($row->parent_id == 0){

		     echo  $this->loadTemplate('repeat');	 

		 }

	   ?>

      <tr>

        <td align="right"><?php echo JText::_( 'DT_REGISTRATION_TYPE' ); ?>:</td>

        <td>

 		    <?php 

			 $options=array();

	         $options[]=JHTML::_('select.option',"individual",JText::_('DT_INDIVIDUAL'));

             $options[]=JHTML::_('select.option',"group",JText::_('DT_GROUP'));

             $options[]=JHTML::_('select.option',"both",JText::_('DT_BOTH'));

			echo JHTML::_('select.genericlist', $options,'data[event][registration_type]','','value','text',$row->registration_type); 

			?></td>

        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_REGISTRATION_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>

      <tr id="grouptype">

        <td align="right"><?php echo JText::_( 'DT_GROUP_REG_TYPE' ); ?>:</td>

        <td>

 		    <?php 

			 $options=array();

             $options[]=JHTML::_('select.option',"simple",JText::_( 'DT_GROUP_REG_SIMPLE' ));

             $options[]=JHTML::_('select.option',"detail",JText::_( 'DT_GROUP_REG_DETAILED' ));

			echo JHTML::_('select.genericlist', $options,'data[event][group_registration_type]','','value','text',$row->group_registration_type); 

			?></td>

        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_GROUP_REG_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

      </tr>

      <tr>

      <td><?php echo JText::_( 'DT_PUBLIC_LIST' ); ?>:</td>

      <td align="left" valign="top">

	    <?php

	    $options=array();

	    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_PUBLIC' ));

	    $options[]=JHTML::_('select.option',"0",JText::_( 'DT_PRIVATE' ));

	    echo JHTML::_('select.genericlist', $options,"data[event][public]","","value","text",$row->public);

	    ?>

	    </td>

      <td colspan="2" align="left">

      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_PUBLIC_LIST_HELP' )), '', 'tooltip.png', '', ''); ?>

      </td>

      </tr>

      <tr>

        <td><?php echo JText::_( 'DT_EVENT_MAX_REGISTRATION' ); ?>:</td>

        <td>

                   	<input type="text" name="data[event][max_registrations]" size="10" value="<?php echo  $row->max_registrations ;?>" />

		    </td>

        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_MAX_REGISTRATION_HELP' )), '', 'tooltip.png', '', ''); ?></td>

    </tr>
    <tr align="center" valign="middle">
	
	    <td align="left" valign="top"><?php echo JText::_( 'DT_MIN_GROUP_SIZE' ); ?>:</td>

   		<td align="left" valign="top">
	
		<input id="min_group_size" type="text" name="data[event][min_group_size]" size="10" value="<?php echo $row->min_group_size; ?>" /></td>

		<td colspan="2">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_MIN_GROUP_SIZE_DESC' )), '', 'tooltip.png', '', ''); ?></td>

	 </tr>
    <tr align="center" valign="middle">
	
	    <td align="left" valign="top"><?php echo JText::_( 'DT_MAX_GROUP_SIZE' ); ?>:</td>

   		<td align="left" valign="top">
	
		<input type="text" id="max_group_size" name="data[event][max_group_size]" size="10" value="<?php echo $row->max_group_size; ?>" /></td>

		<td colspan="2">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_MAX_GROUP_SIZE_DESC' )), '', 'tooltip.png', '', ''); ?></td>

	 </tr>

     <tr>

        <td><?php echo JText::_( 'DT_REGISTRATION_OPEN_DATE' ); ?>:</td>

        <td>

        	<?php



				if(defined('_JEXEC'))



        		{



        			echo JHTML::_("calendar",$row->startdate,"data[event][startdate]","startdate");



        		}



        		else



        		{



        		?>



        			<input class="inputbox" type="text" name="data[event][startdate]" id="startdate" size="12" maxlength="10" value="<?php echo $row->startdate; ?>" />



            	<input type="reset" class="button" value="..." onclick="return showCalendar('startdate', 'y-mm-dd');" />



        		<?php



        		}



        	?>

             <input type="text" class="timeEntry" id="starttime" name="data[event][starttime]" value="<?php echo $row->starttime; ?>" />

		    </td>



        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_REGISTRATION_OPEN_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>



      </tr>

      

      <tr>



        <td><?php echo JText::_( 'DT_CUT_OFF_DATE' ); ?>:</td>



        <td>



        	<?php



           	if(defined('_JEXEC'))



        		{



        			echo JHTML::_("calendar",$row->cut_off_date,"data[event][cut_off_date]","cut_off_date");



        		}



        		else



        		{



        		?>



        			<input class="inputbox" type="text" name="data[event][cut_off_date]" id="cut_off_date" size="12" maxlength="10" value="<?php echo $row->cut_off_date; ?>" />



            	<input type="reset" class="button" value="..." onclick="return showCalendar('cut_off_date', 'y-mm-dd');" />



        		<?php



        		}



        	?>

            <input type="text" class="timeEntry" id="cut_off_time" name="data[event][cut_off_time]" value="<?php echo $row->cut_off_time; ?>" />

		    </td>



        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_CUT_OFF_DATE_HELP' )), '', 'tooltip.png', '', ''); ?></td>



      </tr>

      

      <tr>



      <td><?php echo JText::_( 'DT_WAITING_LIST' ); ?>:</td>



      <td align="left" valign="top">



	    <?php



	    $options=array();



	    $options[]=JHTML::_('select.option',"0",JText::_( 'DT_DISABLE' ));



	   // $options[]=JHTML::_('select.option',"1",JText::_( 'DT_ENABLE_AUTO' ));

		

		$options[]=JHTML::_('select.option',"2",JText::_( 'DT_ENABLE_MANUAL' ));

        

	    echo JHTML::_('select.genericlist', $options,"data[event][waiting_list]","","value","text",$row->waiting_list);



	    ?>



	    </td>



      <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_WAITING_LIST_HELP' )), '', 'tooltip.png', '', ''); ?></td>



      </tr>

       

    <tr>

    <td valign="top"><?php echo JText::_( 'DT_EVENT_CATEGORY_PREREQUISITE' ); ?>:</td>

    <td><?php 

	   $options=DtHtml::options($category->optionslist());

	   echo JHTML::_('select.genericlist', $options,"data[prerequisite_category][]", 'multiple="multiple" size="5"',"value","text",$row->prerequisitecategory); ?></td>

    <td colspan="2">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_CATEGORY_PREREQUISITE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

   </tr>

      <tr>

        <td valign="top"><?php echo JText::_( 'DT_PREREQUISITE' ); ?>:</td>

        <td>

 			  <?php 

			   $options=DtHtml::options($row->optionslist(),JText::_('DT_SELECT_EVENT'));

              echo JHTML::_( 'select.genericlist', $options, 'data[prerequisite][]', 'multiple="multiple" size="5"',"value","text",$row->prerequisite);

              $options = array();	  

        ?></td>



        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_PREREQUISITE_HELP' )), '', 'tooltip.png', '', ''); ?></td>



      </tr>

      

      <tr>



        <td><?php echo JText::_( 'DT_ARTICLE' ); ?>:</td>



        <td>



			<?php



              

                $options=DtHtml::options($section->optionslist(),JText::_('DT_SELECT_SECTION'));

				$section_html =  JHTML::_('select.genericlist', $options,"articlesection","","value","text");



				$options=array();



				$options[]=JHTML::_('select.option',"",JText::_( 'DT_SELECT_CATEGORY' ));



				$category_html =  JHTML::_('select.genericlist', $options,"articlecategory","","value","text");



				$options=array();



				$options[]=JHTML::_('select.option',"",JText::_( 'DT_SELECT_ARTICLE' ));



				$article_html =  JHTML::_('select.genericlist', $options,"data[event][article_id]","","value","text",$row->article_id);



			?>



			  <span id="section_id" ><?php echo $section_html; ?></span>



        <span id="category_id" ><?php echo $category_html; ?></span>



        <span id="article_id" ><?php echo $article_html; ?></span>



 		    </td>



        <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_ARTICLE_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?></td>



      </tr>



	    <tr>

         

       <tr>



      	<td align="right"><?php echo JText::_( 'DT_DETAILS_ITEMID' ); ?>:</td>



      	<td> 

            <input type="text" id="" name="data[event][detail_itemid]" size="10" value="<?php echo $row->detail_itemid; ?>" />

      	</td>



      	<td colspan="2" align="left">



      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_DETAILS_ITEMID_HELP' )), '', 'tooltip.png', '', ''); ?>



      	</td>



      </tr>

      

      	<td align="right"><?php echo JText::_( 'DT_EVENT_DETAIL_LINK_DISPLAY' ); ?>:</td>



      	<td>



			<?php



				 		$options=array();



						$options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));



						$options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));



            

            echo JHTML::_('select.radiolist', $options, 'data[event][detail_link_show]','','value','text',$row->detail_link_show);



			?>



      	</td>



      	<td colspan="2" align="left">



      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_DETAIL_LINK_DISPLAY_HELP' )), '', 'tooltip.png', '', ''); ?>



      	</td>



      </tr>



	  <tr>



      	<td align="right"><?php echo JText::_( 'DT_EVENT_SHOW_REGISTRANT' ); ?>:</td>



      	<td>



			<?php



				 		$options=array();



						$options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));



						$options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));





            echo JHTML::_('select.radiolist', $options, 'data[event][show_registrant]','','value','text',$row->show_registrant );



			?>



      	</td>



      	<td colspan="2" align="left">



      		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_SHOW_REGISTRANT_HELP' )), '', 'tooltip.png', '', ''); ?>



      	</td>



      </tr>



      <tr>



				<td align="left" valign="top"><?php echo JText::_( 'DT_DUPLICATION_OVERRIDE' );?>:</td>



        <td>



                   <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '1', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '0', JText::_( 'Yes' ));

                  								   echo JHTML::_('select.radiolist', $options,'data[config][prevent_duplication]','','value','text',isset($row->config['prevent_duplication'])?$row->config['prevent_duplication']:1);



								   ?>



					</td>



					<td>&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_DUPLICATION_OVERRIDE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>



				</tr>

                               

        <tr>



					<td align="left" valign="top"><?php echo JText::_( 'DT_OVERRIDE_OVERLAP' );?>:</td>



          <td>



                   <?php



								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));

                  			   echo JHTML::_('select.radiolist', $options,'data[config][usetimecheck]','','value','text',isset($row->config['usetimecheck'])?$row->config['usetimecheck']:0);



								   ?>



					</td>



					<td>&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_OVERRIDE_OVERLAP_HELP' )), '', 'tooltip.png', '', ''); ?></td>



	</tr>

    <tr>

		<td align="left" valign="top"><?php echo JText::_( 'DT_EXCLUDE_OVERLAP' );?>:</td>

          <td>

                   <?php

								   $options=array();



								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));



								   $options[]=JHTML::_('select.option', '1', JText::_( 'Yes' ));

                   

								   echo JHTML::_('select.radiolist', $options,'data[config][excludeoverlap]','','value','text',isset($row->config['excludeoverlap'])?$row->config['excludeoverlap']:0);



								   ?>



					</td>



					<td>&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EXCLUDE_OVERLAP_HELP' )), '', 'tooltip.png', '', ''); ?></td>

	</tr>

    <tr>

	    <td valign="top" align="right">&nbsp;</td>

	    <td>&nbsp;</td>

	    <td colspan="2" align="left">&nbsp;</td>

     </tr>

   <tr>

		<td align="left" valign="top"><?php echo JText::_( 'DT_USER_CREATION' );?>:</td>

        <td>

                                       <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'No' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'DT_YES_REQUIRED' ));
								   $options[]=JHTML::_('select.option', '2', JText::_( 'DT_YES_OPTIONAL' ));

								   echo JHTML::_('select.genericlist', $options,'data[event][usercreation]','','value','text',$row->usercreation);

								   ?>

		</td>

		<td>&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_USER_CREATION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

	</tr>


<?php echo $this->loadTemplate('image'); ;?>
</table>



<script type="text/javascript">
 
  DTjQuery(function(){
	    DTjQuery.validator.messages.required ;
		
		
		
	    DTjQuery(document.adminForm).validate({
                        success: function(label) {
                            label.addClass("success");
                        }
              
                });
		DTjQuery("#min_group_size").rules('add',{lessthen:'#max_group_size',messages:{lessthen:" "}});
		 DTjQuery('#dtstart').rules('add',{datelessthen: "#dtend", required:true,
		                   messages :{datelessthen:""}
                  });
		 /* DTjQuery('#dtend').rules('add',{datelessthen: "#dtend",  required:true,
		                   messages :{datelessthen:""}
                  });*/
	    DTjQuery(".checkdate").change(function(){
		    
			if(DTjQuery(document.adminForm).validate().element("#dtstart" )){
				DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').addClass('success');
		
			}else{
			   DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').removeClass('success');
			
			}
				
		});
		
		DTjQuery("#dataeventregistration_type").change(function(){
		     
			 var value = DTjQuery(this).val();
			 if(navigator.appName.indexOf("Micro") >=0){
				 display = 'block';
			 }else{
				 display = 'table-row';
			 }
			 if(value != 'individual'){
			    DTjQuery('#grouptype').css({display:display});
				
			 }else{
				DTjQuery('#grouptype').hide();
			     
			 }
			 	
		})
		DTjQuery("#dataeventregistration_type").trigger('change');	
	});
   
   var article = <?php echo json_encode($article);?> ;

   if(article ==  null){
	   article = {};
   }

   DTjQuery('#articlesection').change(function(){



			DTjQuery('#category_id').load("index.php?option=com_dtregister&controller=eventmanage&no_html=1&sectionId="+DTjQuery(this).val()+"&task=getcategory",article,function(){

		   

			 article['sectionid'] = DTjQuery(this).val();

			

			DTjQuery('#articlecategory').change(function(){

                article['catid'] = DTjQuery(this).val();

			DTjQuery('#article_id').load("index.php?option=com_dtregister&controller=eventmanage&no_html=1&categoryId="+DTjQuery(this).val()+"&task=getarticle",article,function(){

				});

		});	

			});

		});

   DTjQuery(function(){

	    DTjQuery("#dataeventarticle_id").change(function(){

		     

			 article['id'] = DTjQuery(this).val();

			 	

		});

	   	<?php

		if($article !== false){

		?>

		   DTjQuery('#articlesection').val(<?php echo (isset($article->sectionid))?$article->sectionid:''; ?>);

		   

		   DTjQuery('#category_id').load("index.php?option=com_dtregister&controller=eventmanage&no_html=1&sectionId="+article['sectionid']+"&task=getcategory",article,function(){


			      DTjQuery('#articlecategory').val(article['catid']);

				  

				  DTjQuery('#article_id').load("index.php?option=com_dtregister&controller=eventmanage&no_html=1&categoryId="+article['catid']+"&task=getarticle",article,function(){

				 

				   DTjQuery('#dataeventarticle_id').val(article['id']);

				 

				});			   

		   });

		   DTjQuery('#articlesection').trigger('change');

		<?php	

		}

		?>
       
   });
   
    function submitbutton(pressbutton){
    
			if(pressbutton == "cancel"){
				submitform(pressbutton);
				return ;
			}
			
			if(DTjQuery(document.adminForm).valid()){
				DTjQuery('input').removeAttr('disabled');
				submitform(pressbutton);
			}
			if(DTjQuery(document.adminForm).validate().element("#dtstart" )){
				DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').addClass('success');
		
			}else{
			   DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').removeClass('success');
			
			}
			  
			return false ;
		
		}
		
		 function DTselected(cal, date) {

			cal.sel.value = date; // just update the value of the input field
			
			if(DTjQuery(document.adminForm).validate().element("#dtstart" )){
				DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').addClass('success');
		
			}else{
			   DTjQuery('label[for="dtstart"]').show();
				DTjQuery('label[for="dtstart"]').removeClass('success');
			
			}
		
		
		   return false ;
			
		
		}
  
</script>
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid ,  $xhtml_url ,$now ,$event_title_link ,$button_color , $googlekey , $amp , $show_event_image;

$eventTable = $this->getModel('event')->table;

$categoryTable = $this->getModel('category')->table;

$locationTable = $this->getModel('location')->table;

$config = $this->getModel('config');

$row = $this->row ;

$bgRow = $this->bgRow ;

$class = 'class="detailslink"' ;

$eventTable->load($row->slabId);

$eventTable->formatTimeproperty($row->dtstarttime);
$eventTable->formatTimeproperty($row->dtendtime);

$j=2; if($config->getGlobal('price_column')){$j++;}if($config->getGlobal('capacity_column')){$j++;}if($config->getGlobal('registered_column')){$j++;}

$color = $config->getGlobal('button_color') ;

        $task = $eventTable->getTask($row);	

		$currCat = $row->category;

		$article = $eventTable->getArticle($row->article_id);

		$article_ItemId = $eventTable->getArticleItemid($article);
		
       

        $eventTable->overrideGlobal($row->slabId); 

		 if($config->getGlobal('event_title_link') == "jevent"){
              $jevent_view_id = $eventTable->getJeventdetailId($row->slabId);

        $jevent_href = JRoute::_("index.php?option=com_jevents&task=icalrepeat.detail&evid=".$jevent_view_id."&Itemid=".DTreg::getcomItemId('com_jevents'),$xhtml_url);
             $event_title_href = $jevent_href;

		 }else{

		    $event_title_href = DTreg::register_href($row,$task );

		 }

		?>

		<tr <?php echo 'class="'.$bgRow.'"'; ?>>
          <?php if($show_event_image){?>
         <td width="<?php echo  $config->getGlobal('event_thumb_width',100); ?>">
            <?php 
			if($row->imagepath !=""){
			echo  '<a href="'.JURI::base( true ).'/images/dtregister/eventpics/'.$row->imagepath.'" class="colorbox"><img src="'.JRoute::_('index.php?option=com_dtregister&controller=file&task=thumb&w='.$config->getGlobal('event_thumb_width',100).'&h='.$config->getGlobal('event_thumb_height',100).'&filename=images/dtregister/eventpics/'.$row->imagepath,$xhtml_url).'" border="0" alt= " " /></a>'; 
			}else{
			  echo  "&nbsp;";	
			}
			?>
         </td>
          <?php }?>
        <?php if((strtotime($row->dtend." ".$row->dtendtime) > $now->toUnix(true) || $row->dtend=="" || $row->dtend=="0000-00-00" ) && $row->future_event=='n'  ){  ; ?> 

		  	<td align="left" class="eventlist"><a href="<?php echo $event_title_href;?>"><?php echo $row->title;?></a>

		<?php }else { ?>

		<td align="left" class="eventlist"><?php echo $row->title;?>

          <?php } ?>

         <?php 

           if($row->location_id !="" && $row->location_id > 0 && $config->getGlobal('showlocation',0)){

		      $locationTable->load($row->location_id);

			  if($locationTable->name !=""){

		 

		   echo "<br />&nbsp;".JText::_( 'DT_LOCATION')  ; ?>:&nbsp;<a class="colorbox" href="<?php echo JRoute::_("index.php?option=com_dtregister&controller=location&task=show&id=".$row->location_id."&tmpl=component",$xhtml_url,false) ?>"   ><?php echo stripslashes($locationTable->name);?></a>

         <?php

		    if($config->getGlobal('linktogoogle')==1){

		 ?>

         <?php

			}

			}

		   }

           echo $this->loadTemplate('moderator');

          $br = false;

          $start_brace = "" ;

		  $end_brace = "" ;

		  if(is_numeric($row->article_id) && $row->article_id > 0 && $row->detail_link_show == 1){

			$mosConfig_live_site = JURI::base( true );

			if($config->getGlobal('front_link_type')){

				$title = '<img src="'.JURI::root(true).'/components/com_dtregister/assets/images/'.$button_color.'/view_details_62x14.png" class="event_button" alt="'.JText::_('DT_VIEW_DETAIL').'" />';

				$class = 'class="detailslink"' ;

				$start_brace = '';

				$end_brace = '';

			}else{

			    $start_brace = '[';

				$end_brace = ']';

				$title = JText::_( 'DT_VIEW_DETAILS');

				$class = 'class="detailslink"' ;

			}

            $br = true ;

          echo '<br />'.$start_brace.'<a '.$class.' href="'.JRoute::_('index.php?option=com_content&view=article&id='.$article->id.'&Itemid='.$article_ItemId,$xhtml_url).'">'.$title.'</a>'.$end_brace;

		  }

		  if($row->show_registrant == 1){

			if($config->getGlobal("front_link_type",0)==1){

				$title = '<img src="'.JURI::root(true).'/components/com_dtregister/assets/images/'.$button_color.'/attendees_62x14.png" class="event_button" alt="'.JText::_('DT_VIEW_REGISTRANTS').'" />';

				$class = 'class="detailslink"' ;

				$start_brace = '';

				$end_brace = '';

			}else{

				$start_brace = '[';

				$end_brace = ']';

				$title = JText::_( 'DT_VIEW_REGISTRANTS');

				$class = 'class="detailslink"' ;

			}

			  if(!$br){

			     echo '<br />';

			  }



			   $br = true ;

                 

				echo $start_brace.'<a '.$class.' href="'.JRoute::_('index.php?option=com_dtregister&eventId='.$row->slabId.'&task=registrant&controller=event&Itemid='.$Itemid,$xhtml_url).'">'.$title.'</a>'.$end_brace;



		  }

        
		  if ($config->getGlobal('show_registration_button',0) == 1 && (strtotime($row->dtend." ".$row->dtendtime) > $now->toUnix(true) || $row->dtend=="" || $row->dtend=="0000-00-00" ) && $row->future_event == 'n' ){



               if(!$br){



			     echo '<br />';



			  }



			   $br = true ;


           
		  	echo $start_brace.DTreg::register_link_small($row,$task,$class,$color,$config->getGlobal('front_link_type')).$end_brace;



		  }
          
		  


		?>



        </td>

         <?php if($config->getGlobal('event_date_show')){ ?>

		<td align="left" class="eventlist">



			<?php echo $eventTable->displaydatecolumn() 



			?> </td>

        <?php } ?>

	<?php if($config->getGlobal('price_column')){?>



				<td align="left" class="eventlist"><nobr>



				<?php

                 

					

                       

						if($eventTable->getIndividualRate($row) > 0){  

						   $price = $eventTable->getIndividualRate($row) ;

                           echo DTreg::displayRate($price,$config->getGlobal('currency_code','USD'));

						}else{



						   echo JText::_( 'DT_FREE' );



						}



					?>



				</nobr></td>



			<?php }



			if($config->getGlobal('capacity_column')){



			?>





				<td align="left" class="eventlist">



				<?php



				if($row->max_registrations>0){



					echo $row->max_registrations;



				} else {



					echo JText::_( 'DT_UNLIMITED' );



				}



				?>



				</td>



			<?php



			}



			?>



			<?php if($config->getGlobal('registered_column')){?>



				<td align="left" class="eventlist">

                 

				<?php  echo $row->registered;?>



				</td>



			<?php } ?>



		</tr>



		<?php if($row->event_describe_set){ ?>



		<tr <?php echo 'class="'.$bgRow.'"'; ?>><td colspan="<?php echo ++$j; ?>"><?php echo stripslashes($row->event_describe); ?></td></tr>



	<?php }

	      

           $eventTable->resumeGlobal();

		

?>
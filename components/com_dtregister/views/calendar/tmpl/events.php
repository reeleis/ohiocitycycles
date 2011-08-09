<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

  global $calendar_link,$xhtml_url,$Itemid,$calendar_show_moderator,$calendar_show_location,$calendar_show_registered;
  global $calendar_show_capacity,$calendar_show_price,$calendar_show_date,$calendar_show_time,$calendar_show_image, $calendar_showTime;
  global $calendar_show_image_gridview,$event_image_gridview_width,$event_image_gridview_height,$calendar_show_available_spots;
  
  
  $events = array();
  $eventTable = $this->eventTable;
  $config = $this->getModel('config');
  $locationTable = $this->getModel('location')->table;
  
  $muser = $this->getModel( 'user' );
  $tuser = $muser->table;
  $profile = $tuser->TableJUser;

  $cal_configs = array('calendar_showTime'=>$calendar_showTime,
                       'calendar_show_image'=>$calendar_show_image,
					   'calendar_show_date'=>$calendar_show_date,
					   'calendar_show_time'=>$calendar_show_time,
					   'calendar_show_price'=>$calendar_show_price,
					   'calendar_show_capacity'=>$calendar_show_capacity,
					   'calendar_show_registered'=>$calendar_show_registered,
					   'calendar_show_available_spots' => $calendar_show_available_spots,
					   'calendar_show_location'=>$calendar_show_location,
					   'calendar_show_moderator'=>$calendar_show_moderator,
					   'calendar_show_image_gridview'=>$calendar_show_image_gridview,
					   'event_image_gridview_width'=>$event_image_gridview_width,
					   'event_image_gridview_height'=>$event_image_gridview_height
                        );

  foreach($this->events as $event){
	
     $href = "";
	 if($calendar_link){
	     if($calendar_link == 1){
			if($event->article_id){
				$eventTable->load($event->slabId);
				$article = $eventTable->getArticle($event->article_id);
                $article_ItemId = $eventTable->getArticleItemid($article);
		        $href = JRoute::_('index.php?option=com_content&view=article&id='.$article->id.'&Itemid='.$article_ItemId,$xhtml_url);
			}else{
			    
			   $eventTable->load($event->slabId);
			 
			   if($eventTable->check_registerable() && $event->future_event=="n"){
				   $href = JRoute::_('index.php?option=com_dtregister&controller=event&task=register&eventId='.$event->slabId.'&Itemid='.$Itemid,$xhtml_url);
			   }else{
				   $href = "";
			   }
					
			}
			
		 }else{
			 $eventTable->load($event->slabId);
			 
			 if($eventTable->check_registerable() && $event->future_event=="n"){
		         $href = JRoute::_('index.php?option=com_dtregister&controller=event&task=register&eventId='.$event->slabId.'&Itemid='.$Itemid,$xhtml_url);
			 }elseif($event->article_id){
				$article = $eventTable->getArticle($event->article_id);
                $article_ItemId = $eventTable->getArticleItemid($article);
		        $href = JRoute::_('index.php?option=com_content&view=article&id='.$article->id.'&Itemid='.$article_ItemId,$xhtml_url);
			}else{
				 $href = "";
			}
			
		 }
	 }
	 
	  $eventTable->load($event->slabId);
	  $eventTable->formatTimeproperty($row->dtstarttime);
	  $eventTable->formatTimeproperty($row->dtendtime);

	  $temp = array();

	  $temp[] = $event->slabId;

	  $temp[] = $event->title;

	  $temp[] = strftime("%m/%d/%Y %H:%M",strtotime($event->dtstart." ".$event->dtstarttime));

	  $temp[] = strftime("%m/%d/%Y %H:%M",strtotime($event->dtend." ".$event->dtendtime));

	  $temp[] = "0";

	  $temp[] = ($event->color == "")?'#a78e67':$event->color;

	  $temp[] = null;

	  $temp[] = -1;

	  $temp[] = 1;

	  $temp[] = $event->loc_name;

	  $temp[] = $href;
	  
	  $temp[] = ($event->timeformat == 2)?'HH:MM':'hh:MM tt';
	  
	  if(isset($event->imagepath)) {
			$temp[] = $event->imagepath;
	  }else{
			$temp[] = '';
	  }
      
	  $temp[] = $cal_configs;
	  
	  $temp[] = $eventTable->displaydatecolumnonly();
	  
	  if($eventTable->getIndividualRate($event) > 0){  

			$price = $eventTable->getIndividualRate($event);
			$price =  DTreg::displayRate($price,$config->getGlobal('currency_code','USD'));
			global $show_price_tax;
			if($show_price_tax && $eventTable->tax_enable){
				 $price += ($price*$event->tax_amount)/100;

			}

	  } else {
			$price = JText::_('DT_FREE');
	  }
	  $temp[] = $price;
	  
	  if($event->max_registrations > 0) {
	  	  $capacity = $event->max_registrations;
	  } else {
		  $capacity = JText::_('DT_UNLIMITED');
	  }
	  $temp[] = $capacity;
	  
	  $registered = $eventTable->getTotalregistered($event->slabId);
	  if($registered > 0) {
	  	  $registered = $registered;
	  } else {
		  $registered = 0;
	  }
	  $temp[] = $registered;

	  $locationTable->load($event->location_id);
	  if($event->loc_name != ""){
			$location = stripslashes($event->loc_name);
	  } else {
	  		$location = JText::_('DT_NOT_SPECIFY');
			$location = '';
	  }
	  $temp[] = $location;
	  
	  if ($event->max_registrations > 0 && $event->max_registrations > $registered) {
	  		$spaces_left = $event->max_registrations - $registered;
	  } else if($event->max_registrations == 0){
	  		$spaces_left = JText::_('DT_UNLIMITED');
	  } else{
	       $spaces_left =  JText::_('DT_WAITING');
	  }
	  $temp[] = $spaces_left;
	  
      $profile->load($event->user_id);
	  if ($profile->name != "") {
		  $moderator = $profile->name;
	  } else {
		  $moderator = 'None';
	  }
	  $temp[] = $moderator;
	  
	   if(isset($event->imagepath) && $event->imagepath != "") {
			$image_tag = '<img border="0" alt="" src="'.JRoute::_('index.php?option=com_dtregister&controller=file&task=thumb&w='.$event_image_gridview_width.'&h='.$event_image_gridview_height.'&filename=images%2Fdtregister%2Feventpics%2Fimage_name').'" />';

			$image_tag = str_replace('image_name',$event->imagepath,$image_tag);
			$temp[] = $image_tag;
	  }else{
			$temp[] = '';
	  }
	  
	  $temp[] = $eventTable->displaytimecolumn();
	 
	  $events[] = $temp;

  }
  
  // echo '<pre>'; print_r($events); exit;

  $json = new stdClass;

  $json->events = $events;
  ob_clean();
  echo json_encode($json);

  die;

?>
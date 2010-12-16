<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

  global $calendar_link,$xhtml_url,$Itemid;
  
  $events =   array();
  $eventTable = $this->eventTable;

  foreach($this->events as $event){
	
     $href = "";
	 if($calendar_link){
	     if($calendar_link == 1){
			if($event->article_id){
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

	  $temp  =  array();

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

	  $events[] = $temp;

  }

  $json =  new stdClass;

  $json->events = $events;

  echo json_encode($json);

  die;

?>
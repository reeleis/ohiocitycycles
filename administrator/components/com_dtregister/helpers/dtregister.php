<?php
class DTreg {
    
	
	function getcomItemId($option){
		
		global $mainframe;
				
        $database = &JFactory::getDBO();
		$query = " SELECT m.id
					FROM #__components c
					INNER JOIN #__menu m ON c.id = m.componentid
					WHERE c.option = '$option' 
					AND c.parent= 0
					LIMIT 1 ";
	
		$database->setQuery( $query );
	    
		 $Itemid = $database->loadResult();
		 return $Itemid ; 

    }
	
	function register_link_small($row,$task,$class,$color,$front_link_type=0){
	     // prd('reached');
		 if($row->future_event=='y' ){ 

		 if($front_link_type){

		   	 $register = '<img class="event_button" src="components/com_dtregister/assets/images/'.$color.'/closed_62x14.png" border="0" alt="'.JText::_('DT_CLOSED').'" />';

			 $separater = " ";

             return $register ;

		   }else{

	    		$register = JText::_( 'DT_CLOSED');

                return $register ;

		   }

   }elseif(($row->cut_off=='y') && ($row->cut_off_date!='0000-00-00')){

		

		 if($front_link_type){

		   	 $register = '<img class="event_button" src="components/com_dtregister/assets/images/'.$color.'/closed_62x14.png" border="0" alt="'.JText::_('DT_CLOSED').'" />';

			 $separater = " ";

		   }else{

	    		$register = JText::_( 'DT_REGISTER');

		   }

	}elseif(($row->registered>=$row->max_registrations)&&($row->max_registrations)&&($row->waiting_list=='0')){

		

		if($front_link_type){

		   	 $register = '<img class="event_button" src="components/com_dtregister/assets/images/'.$color.'/full_62x14.png" border="0" alt="'.JText::_('DT_FULL').'" />';

			 $separater = " ";

		   }else{

	    		$register = JText::_( 'DT_FULL');

		   }
           return $register ;
	}elseif(($row->registered >= $row->max_registrations)&&($row->max_registrations)&&($row->waiting_list > 0)){

		if($front_link_type){

		   	 $register = '<img class="event_button" src="components/com_dtregister/assets/images/'.$color.'/full_62x14.png" border="0" alt="'.JText::_('DT_FULL').'" />';

			 $separater = " ";

		   }else{

	    		$register = JText::_( 'DT_FULL');

		   }

	}else{

		if($front_link_type){

		   	 $register = '<img class="event_button" src="components/com_dtregister/assets/images/'.$color.'/register_62x14.png" border="0" alt="'.JText::_('DT_REGISTER').'" />';

			 $separater = " ";

		   }else{

	    		$register = JText::_( 'DT_REGISTER');

		   }

	}
     $reglink =  self::register_href($row,$task);
	 return $text ='<a '.$class.' href="'.$reglink.'">'.$register.'</a>';
		 
		 
	}
	
	function register_href($row,$task){
	    global $xhtml_url ,$Itemid ;
		$eventId = $row->slabId ;
		
		return JRoute::_("index.php?option=com_dtregister&controller=event&eventId=$eventId&Itemid=$Itemid&task=register",$xhtml_url);

		
		switch ($row->registration_type) {

         case "individual" :

  		      $reglink=JRoute::_("index.php?option=com_dtregister&controller=event&eventId=$eventId&Itemid=$Itemid&task=$task&type=individual",$xhtml_url);

          	  break;

        case "group" :

              $reglink=JRoute::_("index.php?option=com_dtregister&controller=event&eventId=$eventId&Itemid=$Itemid&task=$task&type=group_num",$xhtml_url);

      		  break;

        case "both" :

            $reglink=JRoute::_("index.php?option=com_dtregister&controller=event&eventId=$eventId&Itemid=$Itemid&task=$task&type=options",$xhtml_url);

    	    break;

      }
		return $reglink ;
		
		
	}
	
	function currency_symbol($currency_code){
	    $arrCode=array(

     		'USD'=>'$',

     		'BRL'=>'R$',

     		'ZAR'=>'R',

     		'GBP'=>'&#163;',

     		'EUR'=>'&#128;',

     		'JPY'=>'&#165;'

     	);

		foreach($arrCode as $arKey=>$arValue){

			if ($arKey === $currency_code){

				$currency_symbol = $arValue;

				break;

			} else {
	
				$currency_symbol = "";
	
			}

		}
		
		return $currency_symbol;
	}
	
	function eventStartDateDisplay($row){
	    
		global $displaytime , $timeformat , $dateformat ; // config variables 
		
		if($row->dtstart == $row->dtend){
		   
		}
		
		return '<span style="float:left">'.$row->dtstart.'<br />&nbsp;'.$row->dtstarttime.'</span>' ;
		
		
	}
	
	function eventEndDateDisplay($row){
	   
	   
	   return '<span style="float:right">'.' - ' .$row->dtend.'<br />&nbsp;&nbsp;&nbsp;'.$row->dtendtime.'</span>' ;
	   
	}
	
	function displayRate($value,$code="USD"){
	   global $currency_code ;
	   if($code == ""){
	       $code = "USD";
		   
	   }
	   
	   $currency_symbol = self::currency_symbol($code);
	   $currency_symbol = ($currency_symbol=="")?$currency_symbol:$currency_symbol." ";
	   $code = ($currency_symbol=='')?' '.$code:'';
	   return $currency_symbol.self::numberFormat($value,2).$code;
	   
	    
	}
	
	function showprice($value=0){
		
		return self::numberFormat($value,2);
	}
	
	function displayEventTitle($event=null){
	   
	   return $event->title ;	
	}
    
	function showDate($date='now'){
	   
	   	return $date ;
	}
	
    function numberFormat($value,$precision=2){
      global $currency_separator ;
      $number_value = $value ;

      $padString = "";

      $value = $number_value;

	  $formatedValue=number_format($value,$precision,".","");

	  $pointIndex=strrpos($formatedValue,".");

	  if($pointIndex===false){

      if($currency_separator == 1){

		  $formatedValue = str_replace(".",",",$formatedValue);

		}

		return $formatedValue;

	  }else{
        
		//Cut the string and show it here

		$pointIndex=strrpos($formatedValue,".");

		if($pointIndex==false)

		{

			if($currency_separator == 1){

			  $formatedValue = str_replace(".",",",$formatedValue);

			}

			return $formatedValue;

		}

		else

		{

			$newLength=$pointIndex+1+$precision;

			for($i=strlen($formatedValue);$i<$newLength;$i++)

			{

				$padString.="0";

			}

        if($currency_separator == 1){

		     $formatedValue = str_replace(".",",",$formatedValue.$padString);

		    }else{

			  $formatedValue = $formatedValue.$padString ;

			}

			return $formatedValue;

		}

	}

  }
	
}
?>
<?php

  
   $html .= '<tr><td>'.JText::_( 'DT_FIRSTNAME' ).':</td><td>'.stripslashes($dt_user->userFirstName).'</td></tr>';
   
   $html .= '<tr><td>'.JText::_( 'DT_LASTNAME' ).':</td><td>'.stripslashes($dt_user->userLastName).'</td></tr>';
     
   $html .= '<tr><td>'.JText::_( 'DT_ORGANIZATION' ).':</td><td>'.stripslashes($dt_user->userOrganization).'</td></tr>';
   
   $html .= '<tr><td>'.JText::_( 'DT_ADDRESS' ).':</td><td>'.stripslashes($dt_user->userAddress).'</td></tr>';

   $html .= '<tr><td>'.JText::_( 'DT_CITY' ).':</td><td>'.stripslashes($dt_user->userCity).'</td></tr>';

   $html .= '<tr><td>'.JText::_( 'DT_STATE' ).':</td><td>'.stripslashes($dt_user->userState).'</td></tr>';
   
   $html .= '<tr><td>'.JText::_( 'DT_COUNTRY' ).':</td><td>'.stripslashes($dt_user->userCountry).'</td></tr>';

   $html .= '<tr><td>'.JText::_( 'DT_ZIPCODE' ).':</td><td>'.stripslashes($dt_user->userZip).'</td></tr>';

   $html .= '<tr><td>'.JText::_( 'DT_PHONE' ).':</td><td>'.stripslashes($dt_user->userPhone).'</td></tr>';
   
   $html .= '<tr><td>'.JText::_( 'DT_EMAIL' ).':</td><td>'.stripslashes($dt_user->userEmail).'</td></tr>';
   if((int)$dt_user->user_id >0){
	    $html .= '<tr><td>'.JText::_( 'DT_USERNAME' ).':</td><td>'.stripslashes($dt_user->username).'</td></tr>';
	   
   }
	if($dt_user->userType=='G'){
	 $field_type = "B";
	}else{
	  $field_type = "I";
	}
	$html .= $dt_user->event->field_view($field_type,$dt_user);
	
   if($dt_user->userType=='G'){
    
   $fields = $dt_user->event->get_group_custom_field();
   foreach((array)$fields as $key => $value){
      $temp[$value->name] = $value;
   }
   
   $i  = 1;
   $id_fields = array('groupMemberId','groupUserId','groupId','useid');
   
   $members = $dt_user->get_members();
    foreach($members as $key => $value){
	   
	   $html .=  "<tr><td colspan=2><br /><u>".JText::_( 'DT_MEMBER' )." {$i}</u></td></tr>";
	   if(!isset($value->remove) && $value->remove !=1){
	         
	       foreach ((array)$value as $key2 => $value2){
	     
		  if($value2!="" && !in_array($key2,$id_fields)){
		     if(isset($temp[$key2])){
			   $html .=  "<tr><td>" . stripslashes($temp[$key2]->label) . ": </td><td>". stripslashes($value2) ."</td></tr>";
			 }else{
		       $html .=  "<tr><td>" . stripslashes($key2) . ": </td><td>". stripslashes($value2) ."</td></tr>";
			 }
		  }
		   
	   }
	       $i++ ;
	   } 
	}
	
   }
?>
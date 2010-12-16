<?php 

class TagParser {



  

   function __construct(){ 

      

	   $mpaymentmethods = $this->getModel('Paymentmethod');

	   $this->paymentmethods = $mpaymentmethods->getMergeList() ;

		 

	   $this->mfield = $this->getModel('field');

	   $this->tfield	= $this->getModel('field')->table ;

		 

	   $this->testRegmsg = "Use the following tags to insert data from the registration:

[TITLE] - Registrant's Title

[NAME] - Registrant's Name

[FIRSTNAME] - Registrant's First Name only

[ORGANIZATION] - Registrant's Organization

[EVENT_NAME] - Event Title

[EVENT_DATE] - Event Date

[LOCATION] - Event Location

[LOCATION_DETAILS] - Location details: address, phone, email, website

[CONTACT_DETAILS] - Registrant Contact Information

[GROUP_NAMES] - List the names of the group members

[GROUP_NUMBER] - Number of people in the group

[AMOUNT] - Registration Fee

[AMOUNT_PAID] - Amount Paid

[AMOUNT_DUE] - Amount Due

[AMOUNT_NOTAX] - The final registration cost before Tax is added.

[TAX] - The tax amount for the record.

[PAYMENT_TYPE] - Method of Payment

[CONTACT_CUSTOM_FIELDS] - List the custom fields for the registrant contact

[GROUP_CUSTOM_FIELDS] - List the custom fields for the group users

- Individual Custom Field. Use the tag provided in the Custom Fields Manager.

[CONFIRM_NUM] - Confirmation Number to match admin email and records

[BARCODE] - This tag will embed the barcode for this record.

[STATUS] - Status (Active, Pending, Cancelled)

[PAID_STATUS] - Paid Status (Paid, Not Paid)

[USERNAME] - Username created during registration

[PASSWORD] - Password created during registration

[DATE_REGISTERED] - The date the registration record was created. " ;

	}

   

	 

	 function parsetags($msg="", $recipient=array()){

		 

		 

		 preg_match_all('/\[[^\]]*\]/',$msg,$matches);

		 $tfield = $this->mfield->table ;

		 $tags = array();

		 $tagvals = array();

		 foreach($matches[0] as $value){

		     

			  $str_replace_key =  strtolower(substr($value,1,-1));

			  $field = $tfield->fingbyName($str_replace_key);

			  $tags[] = $value ;

			  

			  if($field){

				  if(isset($recipient->fields[$field->id])){

					  $tagvals[] = $recipient->fields[$field->id] ;

				  }else{

					  $tagvals[] = '';

				  }  

			  }else{

				  

				 $tagvals[] =  $this->{$str_replace_key}($recipient) ;

				  

				    

			  }

			   

			  

			  

			 	 

		 }

		 

		 return str_replace($tags,$tagvals,$msg);

		 

		 

		 

		 

	 }

	 

	 function event_name($recipient){

	     $user = $this->getuser($recipient);

		 

		 return $user->TableEvent->displaytitle();

		 

		 	 

	 }

	 

	  function event_date($recipient){

	    $user = $this->getuser($recipient);

		 return $user->TableEvent->displaydate();

		 

		 	 

	 }

	 

	 function location($recipient){

		$user = $this->getuser($recipient);

		return $user->TableEvent->TableLocation->name ;

		 

	 }

	 

	 

	 

	 function confirm_num(){

		 $user = $this->getuser($recipient);

		return $user->confirmNum ;

	  	 

	 }

	 

	 function amount_due(){

	     $user = $this->getuser($recipient);

		 return  1;

     }

	 

	 function paid_status($recipient){

	     $user = $this->getuser($recipient);

		 

		 return $user->fee->statustxt[$user->fee->status] ;

		 	 

	 }

	 

	 function barcode($recipient){

	     $user = $this->getuser($recipient);

		 global $barCodeImagetypeToExt , $barcode_image_type ;

         $barcodePath =JURI::root( false )."images/dtregister/barcode/".$user->confirmNum.".".$barCodeImagetypeToExt[$barcode_image_type];

         return  '<img border="0" src="'.$barcodePath.'" />';

	 }

	 

	 function status($recipient){

	    $user = $this->getuser($recipient);

		 

		 return $user->statustxt[$user->status]  ;

     }

	 

	 function username($recipient){

		  $user = $this->getuser($recipient);

		  return $user->juser->username ;

	 }

	 

	 function password(){

	    

		

		return "password";	 

	 }

	 

	 function location_details($recipient){

		 

		 $user = $this->getuser($recipient);

		 $location = $user->TableEvent->TableLocation ;

		 

		 $locParts =  array();

		 

		 $locParts[] = $location->address.$location->address2 ;

		 

		 $locParts[] = $location->city.', '.$location->state.' '.$location->zip ;

		 $locParts[] = $location->country ;

		 $locParts[] = $location->phone ;

		 $locParts[] = $location->email ;

		 $locParts[] = $location->website ;

	

	     return implode(' <br /> ',array_filter($locParts));

		 

	 }  

	 

	 function firstname($recipient){

	     

		 if(isset($recipient->groupUserId)){

			$recipient->firstname ;

	     }else{

		   $recipient->getFieldByName('firstname') ;

		 }

		 	 

	 }

	 

	  function name($recipient){

		 $nameparts = array();

	   	 if(isset($recipient->groupUserId)){

			$nameparts[] = $recipient->firstname ;

			$nameparts[] = $recipient->lastname ;

	     }else{

		    $nameparts[] = $recipient->getFieldByName('firstname') ;

		    $nameparts[] = $recipient->getFieldByName('lastname') ;

		 }

		 

		 return implode(' ',array_filter($nameparts));

	 }

	  

	 function lastname($recipient){

	     

		 if(isset($recipient->groupUserId)){

			$recipient->lastname ;

	     }else{

		   $recipient->getFieldByName('lastname') ;

		 }

		 	 

	 }

	 

	  function title($recipient){

	     

		 if(isset($recipient->groupUserId)){

			$recipient->title ;

	     }else{

		   $recipient->getFieldByName('title') ;

		 }

		 	 

	 }

	 

	  function organization($recipient){

	     $user  = $this->getuser($recipient);

		 return $user->getFieldByName('organization') ;

	 }

	 

	 function contact_details($recipient){

		 

		$user  = $this->getuser($recipient);

		

		$user->getFieldByName('address');

		$details[] = $user->getFieldByName('address') ;

		$details[] = $user->getFieldByName('address2') ;

		$details[] = $user->getFieldByName('city').', '.$user->getFieldByName('state').' '.$user->getFieldByName('zip');

		$details[] = $user->getFieldByName('country') ;

		$details[] = $user->getFieldByName('phone') ;

		$details[] = $user->getFieldByName('email') ;

		$details = array_filter($details);

		return implode("<br />",$details);

		



		 

	 }

	 

	 function group_names($recipient){

	     

		 $user  = $this->getuser($recipient);

		 if($user->type=='G'){

			 $names = array();

			 foreach($user->members as $member){

			     

				 $nameParts = array();

				 $nameParts[] = $member->title ;

				 $nameParts[] = $member->firstname ;

				 $nameParts[] = $member->lastname ;

				 

				 $name = implode(" ",array_filter($nameParts)) ;

				 $names[] = $name ;

				 	 

			 }

			 

			 return implode(" <br /> ",array_filter($names)) ;

		 }else{

			 return "";

		 }

		 

		 

		 

     }

	 

	 function group_number(){

	   	 

		 $user  = $this->getuser($recipient);

		 

		 return $user->memtot ;

		 

	 }

	 

	 function memtot($recipient){

		 

		 $user  = $this->getuser($recipient);

		 

		 return $user->memtot ;

		 

	 }

	 

	 function amount($recipient){

		$user  = $this->getuser($recipient);

		return  $user->TableFee->formatamount($user->TableFee->fee); 

	 }

	 

	 function amount_paid($recipient ){

		$user  = $this->getuser($recipient);

		return  $user->TableFee->formatamount($user->TableFee->paid_amount); 

	}

	 

	 function payment_type($recipient){

	     $user  = $this->getuser($recipient);

		 $mpaymentmethods = $this->getModel('paymentmethod');

		 $methods = $mpaymentmethods->getMergeList() ;

		 return $methods[$user->fee->payment_type];

		 

		 	 

	 }

	 

	 function  contact_custom_fields($recipient){

		 

		 $user  = $this->getuser($recipient);

		 

		 return $user->contact_custom_fields();

		 

	 }

	 

	 function group_custom_fields($recipient){

		 

		 $user  = $this->getuser($recipient);

		 $i = 1 ;

		 $groupCustomField =  array();

		 

		 foreach($user->members as $member){

			   $nameParts = array();

			   $nameParts[] = $member->title ;

			   $nameParts[] = $member->firstname ;

			   $nameParts[] = $member->lastname ;

               $name = implode(" ",array_filter($nameParts)) ;

		       $groupCustomFields[] = JText::_('DT_MEMBER') .($i).': '.$name;

			   

			   $groupCustomFields[] = $user->TableMember->contact_custom_fields($member).'<br /><br />';

			   

			   $i++ ;

		 }

	     

		 return '<br /><br /><br />'.implode(" <br /> ",$groupCustomFields);

		 	 

		 

	 }

	 	 

	 function amount_notax(){

		 

		 return 'amount_notax' ;

		 

	}

	

	 function tax(){

		 

		 return 'tax';

		 

	}

	

	function  date_registered($recipient){

		$user = $this->getuser($recipient);

		

		return $user->showRegDate();

	} 

	 

	 function getuser($recipient){

		  if(isset($recipient->groupUserId)){

			$user = $this->getModel('user')->table; 

			$user->load($recipient->groupUserId);

	     }else{

		    $user = $recipient;

		 }

		 return $user  ;

	 }

	 

	 function userdata(){

	     

		  $userId = JRequest::getVar('userId' , 0);

		  

		  $user = $this->getModel('User')->table;

		  $user->load($userId);

		  

		  $type = ($user->type == 'I')?'I':'B';

		  $fieldshtml = "";

		  if($user->user_id > 0 ){

			  

			  $fieldshtml  .= '<tr><td>'. JText::_( 'DT_USERNAME' ).':</td><td>'.$user->juser->username.'</td></tr>' ;

			  

		  }

		  

		  $fieldshtml .= $user->TableEvent->viewFields($type,(array)$user->getObjData(),false);

		  if($user->type == 'G'){

			  $i = 1 ;

			  foreach($user->members as $key => $member){

				      $fieldshtml .= "<tr><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'><u>".JText::_( 'DT_MEMBER' ).($i)." </u></td></tr>";

		      $fieldshtml .= $user->TableEvent->viewFields('M',(array)$member,false,'frmcart',false);

				  $i++ ;

			  }

			    

		  }

		  $this->emailview->assign('user',$user);

		  return  $fieldshtml ;

		 	 

	 }    

    



}

?>
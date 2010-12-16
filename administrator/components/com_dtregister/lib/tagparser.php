<?php 

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class Tagparser {

   function __construct(){ 

	   $mpaymentmethods =& DtrModel::getInstance('DtregisterModelPaymentmethod');

	   $this->paymentmethods = $mpaymentmethods->getMergeList();

	   $this->mfield = & DtrModel::getInstance('Field','DtregisterModel'); 

	   $this->tfield = $this->mfield->table;
     $fieldType = DtrModel::getInstance('Fieldtype','DtregisterModel');

	   $this->fieldTypes = $fieldType->getTypes();
		 
	   $this->testRegmsg = "";
     
	   $this->invalid_tags = array('GROUP_CUSTOM_FIELDS','CONTACT_CUSTOM_FIELDS','CONTACT_DETAILS');
	 
	}

	 function getTagcontent($tag,$msg){
		 
		 $tagstart = "\{".$tag."\}";
		 $tagend   = "\{\/".$tag."\}";
		 $expression = "/(?<=".$tagstart.")(.*)*(?=".$tagend.")/msU";
		 preg_match_all($expression,$msg,$matches);
		 if(isset($matches[0]) && isset($matches[0][0])){
		   return $matches[0][0];
		 }else{
		    return "";	 
		 }
		 prd($matches);
	 }
     
	 function replaceTagContent($tag,$msg){
	   $tagstart = "\{".$tag."\}";
		 $tagend   = "\{\/".$tag."\}";
		 $expression = "/".$tagstart."(.*)*".$tagend."/msU";
		 $data = preg_replace($expression,'',$msg);
		 return $data;
		
     }
	 
	 function parsetags($msg="", $recipient=array()){

       if($msg==""){
		  //$msg = $this->testRegmsg;   
	   }
		 
		 preg_match_all('/\[[^\]]*\]/',$msg,$matches);
         
		 $tfield = $this->mfield->table;

		 $tags = array();

		 $tagvals = array();
         
		 foreach($matches[0] as $value){

			  $str_replace_key =  substr($value,1,-1);
              if(in_array($str_replace_key,$this->invalid_tags)){
				   continue;
			  }
			  $field = $tfield->findByTag($str_replace_key);
              
			  $tags[] = $value;
             
			  if($field){
				  
				  if(isset($recipient->fields[$field->id])){
            $recipient->fields[$field->id];
					  $fielddata = $this->tfield->find(' id='.$field->id);
					  
					  $fielddata = $fielddata[0];
					  $classname = 'Field_'.$this->fieldTypes[$fielddata->type];
					  $fieldTable = new $classname();
					  $fieldTable->load($field->id);
					  $function = 'viewHtml';
					  if(is_callable(array($fieldTable,'exportView'))){
						  $function = 'exportView';
					  }
					  $tagvals[] = $fieldTable->$function((array)$recipient,null,'',false);//$this->tfield->load($field->id);
					 
				  }else{

					  $tagvals[] = '';

				  }  

			  }else{

            if(is_callable(array($this,$str_replace_key)))
				 {
				    $tagvals[] =  $this->{$str_replace_key}($recipient);
				 }

			  }

		 }
        
		 return str_replace($tags,$tagvals,$msg);

	 }

	 function event_name($recipient){

	     $user = $this->getuser($recipient);

		 return $user->TableEvent->title;

	 }

	  function event_date($recipient){

	    $user = $this->getuser($recipient);

		 return $user->TableEvent->displaydate();

	 }

	 function location($recipient){

		$user = $this->getuser($recipient);

		return $user->TableEvent->TableLocation->name;

	 }

	 function confirm_num($recipient ){

		 $user = $this->getuser($recipient);

		return $user->confirmNum;

	 }

	 function amount_due($recipient ){
         global $currency_code;
	     $user = $this->getuser($recipient);
         return  DTreg::displayRate(($user->TableFee->fee - $user->TableFee->paid_amount),$currency_code); 
		 
     }

	 function paid_status($recipient){

	     $user = $this->getuser($recipient);
         $fee = & DtrModel::getInstance('DtregisterModelFee');
		 return $fee->table->statustxt[$user->TableFee->status];
         	 	 
	 }

	 function barcode($recipient){

	     $user = $this->getuser($recipient);

		 global $barCodeImagetypeToExt , $barcode_image_type;
//pr($barCodeImagetypeToExt);
         $barcodePath =JURI::root( false )."images/dtregister/barcode/".$user->confirmNum.".".$barcode_image_type;

         return  '<img border="0" src="'.$barcodePath.'" alt="[BARCODE_MISSING] '.$barcodePath.'" />';

	 }

	 function status($recipient){

	    $user = $this->getuser($recipient);

		 return $user->statustxt[$user->status];

     }

	 function username($recipient){

		  $user = $this->getuser($recipient);

		  return $user->TableJUser->username;

	 }

	 function password($recipient){
        $dtuser = $this->getuser($recipient);
		
		if(DT_Session::get('register.User') !== false ){
			if(count(DT_Session::get('register.User'))== 1){
			  foreach(DT_Session::get('register.User') as $user ){
				  
				  break ;
			  }
			}else{
			  foreach(DT_Session::get('register.User') as $user ){
				  
				  if(isset($user['userId'])&& $dtuser->userId == $user['userId']){
				  	 break ;
				  }
			  }
			}
			if(isset($user['password'])){
			   return $user['password'] ;
			}else{ 
			   return "";
			}
		}else{
			return "";	 
		}
		
		

	 }

	 function location_details($recipient){

		 $user = $this->getuser($recipient);

		 $location = $user->TableEvent->TableLocation;

		 $locParts = array();

		 $locParts[] = $location->address.$location->address2;

		 $locParts[] = $location->city.', '.$location->state.' '.$location->zip;

		 $locParts[] = $location->country;

		 $locParts[] = $location->phone;

		 $locParts[] = $location->email;

		 $locParts[] = $location->website;

	     return implode(' <br /> ',array_filter($locParts));

	 }  

	 function firstname($recipient){

		 if(isset($recipient->groupUserId)){

			$recipient->firstname;

	     }else{

		   $recipient->getFieldByName('firstname');

		 }

	 }

	  function name($recipient){

		 $nameparts = array();

	   	 if(isset($recipient->groupUserId)){

			$nameparts[] = $recipient->firstname;

			$nameparts[] = $recipient->lastname;

	     }else{

		    $nameparts[] = $recipient->getFieldByName('firstname');

		    $nameparts[] = $recipient->getFieldByName('lastname');

		 }

		 return implode(' ',array_filter($nameparts));

	 }

	 function lastname($recipient){

		 if(isset($recipient->groupUserId)){

			$recipient->lastname;

	     }else{

		   $recipient->getFieldByName('lastname');

		 }

	 }

	  function title($recipient){

		 if(isset($recipient->groupUserId)){

			$recipient->title;

	     }else{

		   $recipient->getFieldByName('title');

		 }

	 }

	  function organization($recipient){

	     $user = $this->getuser($recipient);

		 return $user->getFieldByName('organization');

	 }

	 function contact_details($recipient){

		return "";

		$user  = $this->getuser($recipient);

		$user->getFieldByName('address');

		$details[] = $user->getFieldByName('address');

		$details[] = $user->getFieldByName('address2');

		$details[] = $user->getFieldByName('city').', '.$user->getFieldByName('state').' '.$user->getFieldByName('zip');

		$details[] = $user->getFieldByName('country');

		$details[] = $user->getFieldByName('phone');

		$details[] = $user->getFieldByName('email') ;

		$details = array_filter($details);

		return implode("<br />",$details);

	 }

	 /*function group_names($recipient){

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

			 return implode(" <br /> ",array_filter($names));

		 }else{

			 return "";

		 }

     }*/

	 function group_number($recipient){

		 $user = $this->getuser($recipient);

		 return $user->memtot;

	 }

	 function memtot($recipient){

		 $user  = $this->getuser($recipient);

		 return $user->memtot;

	 }

	 function amount($recipient){
        global $currency_code;
		$user  = $this->getuser($recipient);

		return DTreg::displayRate($user->TableFee->formatamount($user->TableFee->fee),$currency_code); 

	 }

	 function amount_paid($recipient ){
        global $currency_code;
		$user = $this->getuser($recipient);

		return DTreg::displayRate($user->TableFee->formatamount($user->TableFee->paid_amount),$currency_code); 

	}

	 function payment_type($recipient){

	   $user = $this->getuser($recipient);

		 $mpaymentmethods = & DtrModel::getInstance('DtregisterModelPaymentmethod');

		 $methods = $mpaymentmethods->getMergeList();
		 // pr($methods[$user->TableFee->payment_method]);
		 // prd($methods); echo 'hello';
		
		 return $methods[$user->TableFee->payment_method];

	 }

	 function contact_custom_fields($recipient){

         return "";		 

		 $user = $this->getuser($recipient);

		 return $user->contact_custom_fields();

	 }

	 function group_custom_fields($recipient){

        return "";		 

		 $user = $this->getuser($recipient);

		 if(!count($user->members)){

		    return "";

		 }

		 $i = 1;

		 $groupCustomField = array();

		 foreach($user->members as $member){

			   $nameParts = array();

			   $nameParts[] = $member->title;

			   $nameParts[] = $member->firstname;

			   $nameParts[] = $member->lastname;

         $name = implode(" ",array_filter($nameParts));

		     $groupCustomFields[] = JText::_('DT_MEMBER') .($i).': '.$name;

			   $groupCustomFields[] = $user->TableMember->contact_custom_fields($member).'<br /><br />';

			   $i++ ;

		 }

		 return '<br /><br /><br />'.implode(" <br /> ",$groupCustomFields);

	 }

	 function amount_notax(){

		 return 'amount_notax';

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

			$user = & DtrModel::getInstance('DtregisterModelUser');

			$user = $user->table;

			$user->load($recipient->groupUserId);

	     }else{

		    $user = $recipient;

		 }
        
		 return $user;

	 }

	 function userdata($userId){

		 //$userId = JRequest::getVar('userId' , 0);

		 $user = & DtrModel::getInstance('DtregisterModelUser');

		  $user = $user->table;

		  $user->load($userId);

		  $type = ($user->type == 'I')?'I':'B';

		  $fieldshtml = "";

		  if($user->user_id > 0 ){

			  $fieldshtml  .= '<tr><td>'. JText::_( 'DT_USERNAME' ).':</td><td>'.$user->TableJUser->username.'</td></tr>';

		  }

		  $fieldshtml .= $user->TableEvent->viewFields($type,(array)$user->getObjData(),false);

		  if($user->type == 'G'){

			  $i = 1;

			  foreach($user->members as $key => $member){

				      $fieldshtml .= "<tr><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'><u>".JText::_( 'DT_MEMBER' ).($i)." </u></td></tr>";

		      $fieldshtml .= $user->TableEvent->viewFields('M',(array)$member,false,'frmcart',false);

				  $i++ ;

			  }

		  }

		 return $fieldshtml;

	 }    

}

?>
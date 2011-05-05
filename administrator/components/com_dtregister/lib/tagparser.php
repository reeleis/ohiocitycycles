<?php 

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class Tagparser {
   
   var $parse_password =  false;
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
		 
		 $tagstart = preg_quote("{".$tag."}","%");
		 $tagend   = preg_quote("{/".$tag."}","5");
		 $expression = "/(?<=".$tagstart.")(.*)*(?=".$tagend.")/msU";
		 $expression = "(?<=".$tagstart.")(.*)(?=".$tagend.")";
		
		 preg_match_all("%".$expression."%msU",$msg,$matches);
		 
		 if(isset($matches[0]) && isset($matches[0][0])){
		   return $matches[0][0];
		 }else{
		    return "";	 
		 }
		 prd($matches);
	 }
     
	 function replaceTagContent($tag,$msg,$replace=""){
	   $tagstart = preg_quote("{".$tag."}",'%');
		 $tagend   = preg_quote("{/".$tag."}","%");
		 $expression = "/".$tagstart."(.*)*".$tagend."/msU";
		$expression = $tagstart."(.*)".$tagend;
		
		$data = preg_replace("%".$expression."%msU",$replace,$msg);
		 // $data = preg_quote($expression);
		 return $data;
		
     }
	 
	 function parsetags($msg="", $recipient=array()){

       if($msg==""){
		  //$msg = $this->testRegmsg;   
	   }
	     //
		 // die('here');
		 preg_match_all('/\[[^\]]*\]/',$msg,$matches);
         // die('here too');
		 $tfield = $this->mfield->table;
		 
		 $tags = array();

		 $tagvals = array();
         //pr($matches[0]);
		 foreach($matches[0] as $value){

			  $str_replace_key = substr($value,1,-1);
              if(in_array($str_replace_key,$this->invalid_tags)){
				   continue;
			  }
			  if(!$this->parse_password && $str_replace_key == 'PASSWORD'){
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
					  
					  $tagvalues = $fieldTable->$function((array)$recipient,null,'',false);//$this->tfield->load($field->id);
					  $tagvals[] = $tagvalues;	 
					 
				  }else{

					  $tagvals[] = '';

				  }  

			  }else{

			  $function = strtolower($str_replace_key);
			  
            if(is_callable(array($this,$function)))
				 {
				    $tagvals[] = $this->{$function}($recipient);
				 }else{
				       $tagvals[] = "";
				}

			  }

		 }
		 $tags_new = $tags;
		 $tagvals_new = $tagvals;
        /* foreach ($tagvals_new as $key=>$value) {
		 
		 	if ($value != "")  {
				$tagvals2[$key] = $value;
				$tags2[$key] = $tags_new[$key];
			}
		 
		 }*/
		 
		  // pr($tags_new);
		  // pr($tagvals_new);
		  // return str_replace($tags,$tagvals,$msg);
		  
		  $msg = str_replace($tags,$tagvals,$msg);		  
		  $msg = nl2br($msg);
		  $msg = preg_replace("/<p>([\s])*<\/p>/",'',$msg);
		  $msg = preg_replace("/<br \/>[\s]*<br \/>/",'null_space',$msg);
		  $msg = preg_replace("/<p>([\s])*<\/p>/",'',$msg);
		  $msg = preg_replace("/<br \/>[\s]*<br \/>/",'null_space',$msg);
		  $msg = preg_replace("/null_space/",'<br />',$msg);
		  $msg = preg_replace("/<\/p>([\s])*<br \/>/",'</p>',$msg);
		 
		  return $msg;

	 }

	 function event_name($recipient){

	     $user = $this->getuser($recipient);

		 return $user->TableEvent->title;

	 }
	 
	 function all_fields($recipient){
	 	
		$user = $this->getuser($recipient);
		$field =  DtrTable::getInstance('field','Table');
		
	    $fieldType =  DtrModel::getInstance('Fieldtype','DtregisterModel');
        $txt =  "";
		$txt_parts = array();
	    $fieldTypes =  $fieldType->getTypes();
		foreach($user->fields as $field_id => $value){
			
			$field->load($field_id);
			if($field->all_tag_enable){
				
				$class = "Field_".$fieldTypes[$field->type];

		    	$fieldTable = new $class();

		    	$fieldTable->load($field->id);
				$function = "viewHtml";
				if(method_exists($fieldTable,'exportView')){
			   		$function = "exportView";
				}
		    	
				$value = $fieldTable->{$function}((array)$user);
				
				//$txt .= $fieldTable->label.': '.$value.'<br />' ;
				$txt_parts[] = stripslashes($fieldTable->label).': '.$value;
			}
			
		}
		// $txt_parts = array_reverse($txt_parts);
		$txt =  implode("<br />",$txt_parts);
		return $txt;
		
	 }
	 
	 function event_time($recipient){
	 	
		$user = $this->getuser($recipient);
		 
		return $user->TableEvent->displaytimecolumn(' ');
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
         return DTreg::displayRate(($user->TableFee->fee - $user->TableFee->paid_amount),$currency_code); 
		 
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
         $barcodePath = str_replace('/components/com_dtregister','',$barcodePath);
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
				  
				  break;
			  }
			}else{
			  foreach(DT_Session::get('register.User') as $user ){
				  
				  if(isset($user['userId'])&& $dtuser->userId == $user['userId']){
				  	 break;
				  }
			  }
			}
			if(isset($user['password'])){
			   return $user['password'];
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
         $secondline = array($location->city , trim($location->state.' '.$location->zip));
		 $locParts[] = $location->address.$location->address2;

		 $locParts[] = implode(", ",array_filter($secondline));

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

		$user = $this->getuser($recipient);

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
	
	 function cancel_fee($recipient ){
        global $currency_code;
		$user = $this->getuser($recipient);

		return DTreg::displayRate($user->TableFee->formatamount($user->TableFee->cancelfee),$currency_code); 

	}

	 function payment_type($recipient){

	   $user = $this->getuser($recipient);

		 $mpaymentmethods = & DtrModel::getInstance('DtregisterModelPaymentmethod');

		 $methods = $mpaymentmethods->getMergeList();
		 // pr($methods[$user->TableFee->payment_method]);
		 // prd($methods); echo 'hello';
		
		 return isset($methods[$user->TableFee->payment_method])?$methods[$user->TableFee->payment_method]:JText::_('DT_FREE');

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

			   $i++;

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
     function registered_date($recipient){
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

				  $i++;

			  }

		  }

		 return $fieldshtml;

	 }
	 
	 function code($recipient){
     	$user = $this->getuser($recipient);
		if($user->discount_code_id){
		  return $user->TableDiscountcode->code ;
		}else{
		   return '';
		}
	 }

}

?>
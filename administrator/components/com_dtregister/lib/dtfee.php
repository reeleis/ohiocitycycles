<?php

/**
* @version 2.7.1
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DT_Fee{

	var $basefee;

	var $memberdiscount;

	var $latefee;

	var $birddiscount;

	var $discountcodefee;

	var $customfee = 0;

	var $tax;

	var $currentfee;

	var $fee;

	var $paid_fee;

	var $payment_method;

	var $changefee;

	var $cancelfee;
    
	var $fieldfee = array();

	function __construct($event=null,$user=null){

	   	$this->TableEvent = $event;
        $this->is_changed = false;
		$this->TableUser = $user;
		if($user->userId){
		   	$this->OldUser = new TableDuser();
			$this->OldUser->load($user->userId);
			///$this->OldUser->compare($this->TableUser);
			$this->is_changed = !$this->OldUser->compare($this->TableUser);
			
		}else{
			$this->OldUser = false;
		}
        $fieldtype = DtrModel::getInstance('Fieldtype','DtregisterModel');

		$this->fieldtypes = $fieldtype->getTypes();

    }

	function setPaidAmount($amount){

	  	$this->paid_amount = $amount;

	}

	function setPaidMethod($method){

	  	$this->payment_method = $method;

	}

	function setPaidStatus($status){

	  $this->status = $status;	

	}

	function getFee($ismember=false,$date=null){

	   	global $now;

		if($date != null and is_string($date)){

		   $date =  new JDate($date);

		}
        
		if(isset($this->TableUser->userId) && $this->TableUser->userId > 0){
		  	
			foreach($this->TableUser->fee as $feepart =>$partvalue){
			   if(!in_array($feepart , array('id','user_id'))){
				  
				  $this->$feepart = $partvalue ;
				    
			   }		
			}
			  	
		}
		
		if(isset($this->TableUser->process)&& $this->TableUser->process=='due'){

			// set the fee from session;

		}

		$date = ($date == null)?$now:$date;

		$this->date = $date;

		$this->ismember = $ismember;

		$this->basefee = $this->getBasefee($this->TableUser->memtot);

		$this->processFee();

		$this->fee = $this->currentfee;

		$this->paid_fee = $this->fee;
         
		
		 
		return $this->currentfee;

	}

	function getChangefee(){

	   global $changefee_enable,$changefee_type, $changefee;

	   /*if(isset($this->TableUser->process) && ($this->TableUser->process=="duepayment" || $this->TableUser->process=="due" || $this->TableUser->process=="cancel" ) ){

		    $amount = 0;

		    $this->changefee = $amount;

	        return $amount;

	   }*/
	   
	   if(!isset($this->TableUser->process) || $this->TableUser->process != 'change'){
		    $amount = 0;
            
		    $this->changefee = $amount;

	        return $amount;
	   }

       
	   if(isset($this->TableUser->userId) && $this->TableUser->userId != "" && $this->TableUser->status != -1 ){
	 
		 if($this->TableEvent->edit_fee && $this->TableEvent->changefee_enable && $this->is_changed){

			$type = ($this->TableEvent->changefee_type==1)?'amount':'percentage';

	   	    $amount = $this->calculatebytype($type,$this->TableEvent->changefee  , $this->currentfee );

		 }else{

		   	 $amount = 0;

		 }

	   }else{

		   	$amount = 0;

	   }

	   $this->changefee = $amount;

	   return $amount;

	}

	function getCancelfee(){

	   global $cancelfee_enable,$cancelfee_type, $cancelfee;

	   /*if(isset($this->TableUser->process) && ($this->TableUser->process=="due" || $this->TableUser->process=="change" )){

		    $amount = 0;

		    $this->cancelfee = $amount;

	        return $amount;

	   }*/
	   
	    if(!isset($this->TableUser->process) || $this->TableUser->process != 'cancel'){
		    $amount = 0;
           
		    $this->cancelfee = $amount;

	        return $amount;
	   }
	   
	   if(isset($this->TableUser->userId) && $this->TableUser->userId != "" && $this->TableUser->status != -1 ){

		 if($this->TableEvent->cancel_enable && $this->TableEvent->cancelfee_enable){

			$type = ($this->TableEvent->cancelfee_type==1)?'amount':'percentage';

	   	    $amount = $this->calculatebytype($type,$this->TableEvent->cancelfee, $this->currentfee );

		 }else{
             
		   	 $amount = 0;

		 }

	   }else{

		   	$amount = 0;

	   }

	   $this->cancelfee = $amount;

	   return $amount;

	}

	function processFee(){

	   $this->currentfee = $this->basefee;
	   if(isset($this->customfee) && $this->customfee >0 ){
	   		$this->currentfee += $this->customfee ;
	   }
	   foreach($this->TableEvent->feeorder  as $feeorder){

		   if($feeorder->type == "basefee"){

			    continue;

		   }

		   if($feeorder->type == "birddiscount"){

			   $amount = $this->getBirdDiscount();

			   $this->currentfee -= $amount; 

		   }

		   if($feeorder->type == "changefee"){

			  $amount = $this->getChangefee(); 

			  $this->currentfee += $amount; 
		   }

		    if($feeorder->type == "cancelfee"){

			  $amount = $this->getCancelfee();

			  $this->currentfee += $amount; 

		   }

		   if($feeorder->type == "discountcode" && $this->TableUser->discount_code_id == $feeorder->reference_id){

		       $amount = $this->getDiscountcodeamount();

			   $this->currentfee -= $amount; 

		   }elseif($feeorder->type == "discountcode"){

			    continue;

		   }

		   if($feeorder->type == "field"){

			  $fee = $this->getFieldFee($feeorder->reference_id);
			  if(!isset($this->TableUser->process) || $this->TableUser->process != "duepayment"){
			  	 
				 $this->currentfee += $fee;

			  	 $this->customfee += $fee;
				 
			  }
			  

		   }

		   if($feeorder->type == "memberdiscount"){

			  $this->memberdiscount = $this->getMemberDiscount();

			  $this->currentfee -= $this->memberdiscount;

		   }

		   if($feeorder->type =='latefee'){

		       $this->latefee = $this->getLatefee();

			   $this->currentfee += $this->latefee;

		   }

		   if($feeorder->type =='tax'){

			   $this->tax = $this->getTax();

			   $this->currentfee += $this->tax;

		   }

	   }

	}

	function getTax(){
      
	  if($this->TableEvent->tax_enable){

	     $tax_amount =  $this->currentfee * $this->TableEvent->tax_amount/100;

	   }else{

	      $tax_amount = 0;

	   }

	   return $tax_amount;

	}

	function getMemberDiscount(){

		$event = $this->TableEvent;
        if(!$this->ismember){

		   	return 0;

		}
        if(isset($this->TableUser->userId) && $this->TableUser->userId > 0){
			$this->TableUser->fee = (array) $this->TableUser->fee ;
			return $this->TableUser->fee['memberdiscount'];
		   	
		}
		$type = ($event->discount_type==1)?'amount':'percentage';

	   	$discount = $this->calculatebytype($type,$event->discount_amount , $this->currentfee );

		if($type=='amount'){

		  if($this->TableUser->type == 'G'){

			  $totmemforDiscount = 0;
              $totmemforDiscount = $this->TableUser->memtot;

		  }else{

			  $totmemforDiscount = 1;

		  }

		  $discount = $discount * $totmemforDiscount;

		}

		if($this->currentfee < $discount){

		    $discount = $this->currentfee;

		}

		return $discount;

	}

	function getFieldFee($field_id){
         
		 
		 if(isset($this->fieldfee[$field_id])){
		    
			return ;	 
		 }
		$field = $this->TableEvent->TableField;

        $field->load($field_id);

		$newcontext = "Field_".$this->fieldtypes[$field->type];

	    $obj = new $newcontext();

		$obj->bind((array)$field);

		$field = $obj;

		$fee = 0;

		if($this->TableUser->type == 'G'){

           if(isset($this->TableUser->members) && is_array($this->TableUser->members))		        
		   foreach($this->TableUser->members as $member){

			  if(isset($member->fields[$field_id])){

				 if(is_array($member->fields[$field_id])){

				    foreach($member->fields[$field_id] as $feekey){

					   $fee += $field->getfeeByKey($feekey);

				    }

				 }else{

					 $fee += $field->getfeeByKey($member->fields[$field_id]);

				 }

			  }

		   }   

		}

		if(isset($this->TableUser->fields[$field_id])){
           
		   if(is_array($this->TableUser->fields[$field_id])){

			  foreach($this->TableUser->fields[$field_id] as $feekey){

				 $fee += $field->fees[$feekey];

			  }

		   }else{

			   $fee += $field->getfeeByKey($this->TableUser->fields[$field_id]);

		   }
		
		}
		$type = ($field->fee_type==1)?'amount':'percentage';

        $fee = $this->calculatebytype($type,$fee , $this->currentfee );
		
        $this->fieldfee[$field->id] = array('field'=>(object)(array)$field,'fee'=>$fee);
		$childs = $obj->getchild();
		
		foreach($childs as $child){
			if(!$child->fee_field){
				continue;
			}
			$fee += $this->getFieldFee($child->id);
				
		}
		
		//$type = ($field->fee_type==1)?'amount':'percentage';

        //$fee = $this->calculatebytype($type,$fee , $this->currentfee );
		
		return $fee;

	}

	function getDiscountcodeamount(){
       
	    if(isset($this->TableUser->userId) && $this->TableUser->userId > 0){
			$this->TableUser->fee = (array) $this->TableUser->fee ;
			return $this->TableUser->fee['discountcodefee'];
		   	
		}
		if($this->TableUser->discount_code_id){
                 $this->TableEvent->TableEventdiscountcode->TableDiscountcode->load($this->TableUser->discount_code_id);
			$type = ($this->TableEvent->TableEventdiscountcode->TableDiscountcode->discount_type==1)?'amount':'percentage';

			$this->discountcodefee = $this->calculatebytype($type,$this->TableEvent->TableEventdiscountcode->TableDiscountcode->amount , $this->currentfee );

			if($this->currentfee < $this->discountcodefee){

			   	$this->discountcodefee = $this->currentfee;

			}

			return $this->discountcodefee;

		}else{

			return 0;

		}

	}

	function getLatefee(){

		global $now;
         if(isset($this->TableUser->userId) && $this->TableUser->userId > 0){
			 $this->TableUser->fee = (array) $this->TableUser->fee ;
			return $this->TableUser->fee['latefee'];
		   	
		}
		if(strtotime($this->date->toFormat('%Y-%m-%d')) > strtotime($this->TableEvent->latefeedate)){

			  if($this->TableUser->type == 'G'){

			   if($this->TableEvent->group_registration_type !="detail"){
				   
				   $totmemforDiscount = $this->TableUser->memtot;
				   
			   }else{

			      $totmemforDiscount = 0;
				  $totmemforDiscount = $this->TableUser->memtot;

			   }

		  }else{

			  $totmemforDiscount = 1;

		  }
            if($this->OldUser !== false){
				
			}
			$latefee = $this->TableEvent->latefee*$totmemforDiscount;

			return $latefee;

		}else{

		   return 0;

		}

	}

	function getBirdDiscount(){

		global $now;
		if(isset($this->TableUser->userId) && $this->TableUser->userId > 0){
			$this->TableUser->fee = (array) $this->TableUser->fee ;
			return $this->TableUser->fee['birddiscount'];
		   	
		}
		if(strtotime($this->date->toFormat()) < strtotime(trim($this->TableEvent->bird_discount_date." ".$this->TableEvent->bird_discount_time)) 

		&& $this->TableEvent->bird_discount_type != 0 ){
     
		    $type = ($this->TableEvent->bird_discount_type==1)?'amount':'percentage';

			if(!isset($this->slab)){

			   $this->slab = $this->getSlab($this->TableUser->memtot);

			}

			if($this->slab->type != 'flat' && $type=="amount" && $this->TableUser->type='G' ){

			  
                if($this->TableEvent->group_registration_type !="detail"){
				   
				   $totmemforDiscount = $this->TableUser->memtot;
				   
			   }else{
				  $totmemforDiscount = 0;
				  $totmemforDiscount = $this->TableUser->memtot;

			  }

			  if(isset($this->TableUser->userId) && $this->TableUser->userId != ""){

			     $this->birddiscount = $this->TableUser->TableFee->birddiscount;

			  }else{

			     $this->birddiscount = $this->calculatebytype($type,$this->TableEvent->bird_discount_amount , $this->currentfee );
                  $this->birddiscount = $this->birddiscount*$this->TableUser->memtot;
			  }

			}else{

			    $this->birddiscount = $this->calculatebytype($type,$this->TableEvent->bird_discount_amount , $this->currentfee );

			 }

			if($this->currentfee < $this->birddiscount){

			   	$this->birddiscount = $this->currentfee;

			}

			return $this->birddiscount;

		}else{

		   return 0;

		}

	}

	function calculatebytype($type='amount',$factor,$amount){

	    if($type == 'percentage'){

		   $per = $factor/100;

		   $amount= $amount*$per;

		}elseif($type == 'amount'){

		   $amount = $factor;   

		}

		return $amount;

    }

	function getBasefee($memtot=1){
		
		$return= '';
	   $this->slab = $this->getSlab($memtot);
		
	   if ($this->slab) {
		   $type = $this->slab->type;
		   $amount = $this->slab->amount;
	
		   if($type == "flat"){
	
			  $return = $amount;
	
		   } else {
	
			  $return = $amount * $memtot;
	
		   }
	   }

		// echo '<pre>'; print_r($return); exit;	   

		return $return;

	}

	function getSlab($memtot=1){
        
	   	return $this->TableEvent->getSlab($memtot);

	}

	function cancel_fee($amount=0){

		 global $cancelfee_type,$cancelfee_enable,$cancelfee;

		 if($amount == 0){

		   //return 0;

		 }

		if($cancelfee_enable){

		    $type = ($cancelfee_type==1)?'amount':'percentage';

		    $cancelfee = self::calculatebytype($type,$cancelfee,$amount);

			return $cancelfee;

		 }else{

		   return 0;

		 }

     }

	 function change_fee($amount=0){

	   global $changefee_enable, $changefee_type, $changefee;

	   if($changefee_enable){

		 $type = ($changefee_type==1)?'amount':'percentage';

		 $changefee = self::calculatebytype($type,$changefee,$amount);

		 return $changefee;

	   }else{

		  return 0;   

	   }	 

	 }

}

?>
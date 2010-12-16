<?php

class DT_Cart{

	

	var $amount ;

	

	function calculateAmount(){

       $paid_amount = 0 ;
    
	   foreach(DT_Session::get('register.User')  as $key => $user){
		  
		   
           if($key === 'process'){
			   continue ;
			}
			
			
		   $paid_amount += $user['fee']['paying_amount'] ;

	   }

        

		

       $this->amount = $paid_amount ;

    }

	

	function getAmount(){

	    

		if(empty($this->amount)){

		   $this->calculateAmount();

		}

		return $this->amount ;

			

	}

	

	function add(){

	   	

	}

	

	function remove(){

	   	

	}

	

    

    





}

?>
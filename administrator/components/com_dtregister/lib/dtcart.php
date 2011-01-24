<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DT_Cart{

	var $amount;

	function calculateAmount(){

       $paid_amount = 0;
    
	   foreach(DT_Session::get('register.User')  as $key => $user){
		  
           if($key === 'process'){
			   continue ;
			}
			
			if (isset($user['fee']['paying_amount']))
		   $paid_amount += $user['fee']['paying_amount'];

	   }

       $this->amount = $paid_amount;

    }

	function getAmount(){

		if(empty($this->amount)){

		   $this->calculateAmount();

		}

		return round($this->amount,2);

	}

	function add(){

	}

	function remove(){

	}

}

?>
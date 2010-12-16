<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPaymentmethod extends DtrModel {

	var $methods = array();

  function __construct($config=array()){

	  $this->methods = array( "authorizenet" => JText::_( 'AUTH_NET' ),

								"echeck"=>JText::_( 'ECHECK' ),

								"GoogleCheckout"=>JText::_( 'DT_GOOGLE_CHECKOUT' ),

								"NetDeposit"=>JText::_( 'DT_NETDEPOSIT' ),

								"paypal"=>JText::_( 'PAYPAL' ),

								"Eway"=>JText::_( 'Eway' ),

								'Sage'=>JText::_('DT_SAGE'),

								"ideal" => JText::_( 'DT_PAY_IDEAL_MOLLIE' ),

								"idealRabo"=>JText::_( 'DT_PAY_IDEAL_LITE' ),

								"pay_later"=>JText::_( 'DT_PAY_LATER' )

								);
										
		$path = JURI::root(true)."/components/com_dtregister/assets/images/";
		global $googlemerchid ,$amp;
        $this->images = array(
		                   'authorizenet'=> $path .'card_pay.jpg',
						   'echeck'=> $path .'echeck_pay.jpg',
						   // 'GoogleCheckout'=> "https://checkout.google.com/buttons/checkout.gif?merchant_id=".$googlemerchid.$amp."w=160".$amp."h=43". $amp."style=trans".$amp."variant=text". $amp."loc=en_US",
						   'GoogleCheckout'=> "https://checkout.google.com/buttons/checkout.gif?merchant_id=".$googlemerchid.$amp."w=160".$amp."h=43". $amp."style=trans".$amp."variant=text". $amp."loc=en_US",
						   'NetDeposit'=> $path .'card_pay.jpg',
						   'paypal'=> $path .'paypal_pay.jpg',
						   'Eway'=> $path .'eway_card_pay.jpg',
						   'Sage'=> $path .'sage_card_pay.jpg',
						   'ideal'=> $path .'ideal_pay.jpg',
						   'idealRabo'=> $path .'ideal_pay.jpg',
						   'pay_later'=> $path .'pay_later.jpg',
		               );
		$this->paylater  =& DtrModel::getInstance('Paylater','DtregisterModel');

		parent::__construct($config);

  }

  function getMethods(){

	  global $mainframe;

      if($mainframe->isAdmin()){
		  $this->methods['ideal'] =   JText::_( 'DT_PAY_IDEAL_MOLLIE' ); 
		  $this->methods['idealRabo'] =   JText::_( 'DT_PAY_IDEAL_LITE' ); 
	  }

	 return $this->methods;

  }

  function getMergeList($all=false){

	  $paylater = &DtrModel::getInstance('paylater','dtregisterModel');

	  $plm = $paylater->getOptions();

	  if(isset($all) && $all){
		 $plm = $paylater->table->optionslist(); 
	  }else{
	  	$plm = $paylater->getOptions();
	  }
	  $pm = $this->methods ;
	  if (isset($pm['pay_later'])) 
	  unset($pm['pay_later']);
	  
	  if (is_array($plm)) 
	  foreach($plm as $key=> $method){
		   $pm[$key] = $method;  
	  }
      
	  return $pm;

  }

}

?>
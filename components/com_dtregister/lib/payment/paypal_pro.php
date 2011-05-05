<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class paypal_pro extends Payment 
{
	public $API_USERNAME;
	public $API_PASSWORD;
	public $API_SIGNATURE;
	public $API_ENDPOINT;
	public $USE_PROXY;
	public $PROXY_HOST;
	public $PROXY_PORT;
	public $PAYPAL_URL;
	public $VERSION;
	public $NVP_HEADER;
	
	public $bywebservice = true;

	// function __construct($API_USERNAME, $API_PASSWORD, $API_SIGNATURE, $PROXY_HOST, $PROXY_PORT, $IS_ONLINE = FALSE, $USE_PROXY = FALSE, $VERSION = '57.0')
	function __construct()
	{
		global $paypal_api_user , $paypal_api_password , $paypal_api_signature , $paypal_pro_country  ,$godaddy_hosting;
		$VERSION = '57.0';
		parent::__construct();
		$this->API_USERNAME = 'chahal_1217571131_biz_api1.hotmail.com'; // $API_USERNAME;
		$this->API_PASSWORD = 'J48TN67TC5BDUVDV'; // $API_PASSWORD;
		$this->API_SIGNATURE = 'A9LC3Qajo-H2V8mPq4eIktgPvG2RAUCxfRRLEPhAB8Q8wU1uWETp1Nib'; //$API_SIGNATURE;
		
		$this->API_USERNAME = $paypal_api_user; // $API_USERNAME;
		$this->API_PASSWORD =  $paypal_api_password; // $API_PASSWORD;
		$this->API_SIGNATURE = $paypal_api_signature; //$API_SIGNATURE;
		$this->API_ENDPOINT = ($this->paymentmode=='test')?'https://api-3t.sandbox.paypal.com/nvp':'https://api-3t.paypal.com/nvp';
		$this->USE_PROXY = false;
		if($godaddy_hosting){
          
		  $this->USE_PROXY = true;
		  $PROXY_HOST = "http://proxy.shr.secureserver.net";
		  $PROXY_PORT = 3128;

	   }
		
		if($this->USE_PROXY == true)
		{
			$this->PROXY_HOST = $PROXY_HOST;
			$this->PROXY_PORT = $PROXY_PORT;
		}
		else
		{
			$this->PROXY_HOST = '127.0.0.1';
			$this->PROXY_PORT = '808';
		}
		if($this->paymentmode=='test')
		{
			$this->PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		else
		{
			$this->PAYPAL_URL = 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		$this->VERSION = $VERSION;
	}

	function hash_call($methodName,$nvpStr)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->API_ENDPOINT);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		if($this->USE_PROXY)
		{
			curl_setopt ($ch, CURLOPT_PROXY, $this->PROXY_HOST.":".$this->PROXY_PORT); 
		}
		$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($this->VERSION)."&PWD=".urlencode($this->API_PASSWORD)."&USER=".urlencode($this->API_USERNAME)."&SIGNATURE=".urlencode($this->API_SIGNATURE).$nvpStr;
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
		$response = curl_exec($ch); 
		
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
	
		if (curl_errno($ch))
		{
			die("CURL send a error during perform operation: ".curl_errno($ch));
		} 
		else 
		{
			curl_close($ch);
		}

	return $nvpResArray;
	}

	function deformatNVP($nvpstr)
	{

		$intial=0;
		$nvpArray = array();
		while(strlen($nvpstr))
		{
			$keypos= strpos($nvpstr,'='); 
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr); 
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		 }
		return $nvpArray;
	}
	
	function billingform(){

	   global $cardtype;
       
	   $form =  parent::billingform();
        ob_start();
	    $size = count($cardtype);
	   if($size ==1){

		  ?>

          <tr>

           <td>

           <input type="radio" style="display:none"  name="billing[cardtype]" value="<?php echo  $cardtype[0];?>"  <?php  echo "checked"; ?> /></td></tr>

          <?php

	   }else{

	   ?>

	    <tr>

             <td width="31%" ><?php echo JText::_( 'CARD_TYPE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

          <td>

            <?php

			$options=DtHtml::options($cardtype);
			echo JHTML::_('select.genericlist', $options,'billing[cardtype]','','value','text',isset($this->cardtype)?$this->cardtype:'');

			?>

          </td>

        </tr>

	   <?php

	   }

	   ?>

          <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left" ><input type="text" name="billing[x_card_num]"  class="inputbox" value="<?php echo isset($this->cb_creditcardnumber)?$this->cb_creditcardnumber:''?>" />

		              <br />

		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>

		        </tr>

           <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		          <td width="69%" align="left" ><input type="text" name="billing[x_exp_date]" value="<?php echo isset($this->cb_expdate)?$this->cb_expdate:''?>" class="inputbox" />

		            &nbsp;&nbsp;(mm/yyyy)</td>

		        </tr>

             <tr>

		          <td width="31%" ><?php echo JText::_( 'CVV_CODE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left" ><input type="text" name="billing[x_card_code]" size="10"  class="inputbox" value="<?php echo isset($this->x_card_code)?$this->x_card_code:'' ;?>" />

		            <?php echo JText::_( 'CVV_CODE_EXPLANATION' );?></td>

		        </tr>

       <?php
		
	   $html = ob_get_clean();

	   return $form.$html;

   }

	function setFields(){

   }

	function process(){
        global $currency_code;
		if($currency_code==""){$currency_code='USD';}
		
		switch($card_type){			
			case 'AmericanExpress':
				$this->cardtype = 'Amex';
			break;
			default:
				$this->cardtype = $card_type;
			break;
		}
		$card_expiry_array = explode("/", $this->x_exp_date);
		
		$firstName 			= urlencode($this->firstname);
		$lastName 			= urlencode($this->lastname);
		$creditCardType 	= urlencode($this->cardtype);
		$creditCardNumber 	= urlencode($this->x_card_num);
		$expDateMonth 		= urlencode($card_expiry_array[0]);
		$expDateYear 		= urlencode($card_expiry_array[1]);
		$cvv2Number 		= urlencode($this->x_card_code);
		$address1 			= urlencode($this->address);
		$address2 			= '';
		$city 				= urlencode($this->city);
		$state 				= urlencode($this->state);
		$zip 				= urlencode($this->zip);
		$amount 			= urlencode($this->cart->getAmount());
		$currencyCode		= urlencode($currency_code);
		$paymentAction 		= urlencode("Sale");
		$nvpRecurring 		= '';
		$methodToCall 		= 'DoDirectPayment';
		$nvpstr='&PAYMENTACTION='.$paymentAction.'&AMT='.$amount.'&CREDITCARDTYPE='.$creditCardType.'&ACCT='.$creditCardNumber.'&EXPDATE='.$expDateMonth.$expDateYear.'&CVV2='.$cvv2Number.'&FIRSTNAME='.$firstName.'&LASTNAME='.$lastName.'&STREET='.$address1.'&CITY='.$city.'&STATE='.$state.'&ZIP='.$zip.'&COUNTRYCODE='.$this->country.'&CURRENCYCODE='.$currencyCode.'&IPADDRESS='.urlencode($_SERVER['REMOTE_ADDR']).'';
		
		//$nvpstr='&PAYMENTACTION=Sale&AMT=2&CREDITCARDTYPE=Visa&ACCT=4340325581348705&EXPDATE=082019&CVV2=123&FIRSTNAME=Lucky&LASTNAME=Litt&STREET=address&CITY=city&STATE=state&ZIP=12345&COUNTRYCODE=US&CURRENCYCODE=USD&IPADDRESS='.urlencode($_SERVER['REMOTE_ADDR']).'';
		
		//pr($nvpstr);
		
		$resArray = $this->hash_call($methodToCall,$nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		// pr($resArray);
		
		if(isset($resArray['TRANSACTIONID']) && $resArray['TRANSACTIONID'] !=""){
		   	$this->transactionId = $res['TRANSACTIONID'];
             DT_Session::set('register.payment.transactionId',$this->transactionId);
			 return true;
	    }else{
			echo JText::_( 'DT_PAYPAL_PRO_FAILURE' ).'<br /><br />';
			return false;
		}

   }

    function parseResponse(){

		 $this->responseParts = explode("|",$this->response);

	}

	function __destruct() 
	{

	}
}
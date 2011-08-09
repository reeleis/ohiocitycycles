<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

define('EWAY_DEFAULT_CUSTOMER_ID','87654321');

define('EWAY_DEFAULT_PAYMENT_METHOD', 'REAL_TIME'); // possible values are: REAL_TIME, REAL_TIME_CVN, GEO_IP_ANTI_FRAUD

define('EWAY_DEFAULT_LIVE_GATEWAY', false); //<false> sets to testing mode, <true> to live mode

	//define URLs for payment gateway

define('EWAY_PAYMENT_LIVE_REAL_TIME', 'https://www.eway.com.au/gateway/xmlpayment.asp');

define('EWAY_PAYMENT_LIVE_REAL_TIME_TESTING_MODE', 'https://www.eway.com.au/gateway/xmltest/testpage.asp');

define('EWAY_PAYMENT_LIVE_REAL_TIME_CVN', 'https://www.eway.com.au/gateway_cvn/xmlpayment.asp');

define('EWAY_PAYMENT_LIVE_REAL_TIME_CVN_TESTING_MODE', 'https://www.eway.com.au/gateway_cvn/xmltest/testpage.asp');

define('EWAY_PAYMENT_LIVE_GEO_IP_ANTI_FRAUD', 'http://www.eway.com.au/gateway_cvn/xmlbeagle.asp');

define('EWAY_PAYMENT_LIVE_GEO_IP_ANTI_FRAUD_TESTING_MODE', EWAY_PAYMENT_LIVE_REAL_TIME_TESTING_MODE); //in testing mode process with REAL-TIME

define('EWAY_PAYMENT_HOSTED_REAL_TIME', 'https://www.eway.com.au/gateway/payment.asp');

define('EWAY_PAYMENT_HOSTED_REAL_TIME_TESTING_MODE', 'https://www.eway.com.au/gateway/payment.asp');

define('EWAY_PAYMENT_HOSTED_REAL_TIME_CVN', 'https://www.eway.com.au/gateway_cvn/payment.asp');

define('EWAY_PAYMENT_HOSTED_REAL_TIME_CVN_TESTING_MODE', 'https://www.eway.com.au/gateway_cvn/payment.asp');

	//define script constants

	define('REAL_TIME', 'REAL-TIME');

	define('REAL_TIME_CVN', 'REAL-TIME-CVN');

	define('GEO_IP_ANTI_FRAUD', 'GEO-IP-ANTI-FRAUD');

class EwayPaymentHosted {

	var $myGatewayURL;

    var $myCustomerID;
	var $username ;

    var $myTransactionData = array();

	var $bywebservice = false;

	//Class Constructor

	function EwayPaymentHosted($customerID = EWAY_DEFAULT_CUSTOMER_ID, $method = EWAY_DEFAULT_PAYMENT_METHOD ,$liveGateway = EWAY_DEFAULT_LIVE_GATEWAY) {
		global $eway_username , $currency_code ;
        if($liveGateway){
			$this->myCustomerID = $customerID;	
			$this->username = $eway_username ;
			$this->currency = $currency_code ;
		}else{
			$this->myCustomerID = 87654321;
			$this->username = 'TestAccount';
			$this->currency = 'AUD' ;
		}
	    
        $this->myGatewayURL = 'https://au.ewaygateway.com/Request/';
	    switch($method){

		    case "REAL_TIME";

		    	$this->myGatewayURL = 'https://au.ewaygateway.com/Request/';
    		break;

	    	case "REAL-TIME-CVN";


		    	$this->myGatewayURL = 'https://au.ewaygateway.com/Request/';

	    	break;	    	

    	}
		
	}
	
	
	
	
	function get_transaction_detail(){
		
		global $godaddy_hosting ;
		$ewayurl ="?CustomerID=".$this->myCustomerID;
		$ewayurl.="&UserName=".$this->username;
		$ewayurl.="&AccessPaymentCode=".$_REQUEST['AccessPaymentCode'];
		
		 $spacereplace = str_replace(" ", "%20", $ewayurl);	
	    $posturl="https://au.ewaygateway.com/Result/$spacereplace";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		if ($godaddy_hosting) 
		{
			$proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
			curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
			curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			curl_setopt ($ch, CURLOPT_PROXY, "http://proxy.shr.secureserver.net:3128");
		}
		
		$response = curl_exec($ch);
		
		if(curl_errno( $ch )){
			echo 'Curl error: ' . curl_error($ch);
			die ;
			return false ;
		}else{
		   $status = Eway::fetch_data($response,'<TrxnStatus>','</TrxnStatus>');
		   
		   if(strtolower($status) == 'false'){
		   	   return false ;
		   }else{
		   }
		  $transaction_id = Eway::fetch_data($response, '<TrxnNumber>', '</TrxnNumber>');
		  return $transaction_id ;
		}
		echo "<pre>";
		echo  htmlentities($response);
		prd($response);
		
		die ;
		
	}
	function doPayment() {
		global $godaddy_hosting , $currency_code ;
		$ewayurl ="?CustomerID=".$this->myCustomerID;
		$ewayurl.="&UserName=".$this->username;
		$ewayurl.="&Currency=".$this->currency;
		
		foreach($this->myTransactionData as $key=>$value){
			 $ewayurl.="&".$key."=".$value;
		}
		
			
	    $spacereplace = str_replace(" ", "%20", $ewayurl);	
	    $posturl="https://au.ewaygateway.com/Request/$spacereplace";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		if ($godaddy_hosting) 
		{
			$proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
			curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
			curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			curl_setopt ($ch, CURLOPT_PROXY, "http://proxy.shr.secureserver.net:3128");
		}
		
		$response = curl_exec($ch);
		
		if(curl_errno( $ch )){
			
			echo 'Curl error: ' . curl_error($ch);
			return false ;
			
		}else{
			
			$responsemode = Eway::fetch_data($response, '<result>', '</result>');
	   		$responseurl = Eway::fetch_data($response, '<uri>', '</uri>');
		   
			if($responsemode=="True")
			{ 			  	  	
			  header("location: ".$responseurl);
			  exit;
			}
			else
			{
			 
			 echo  Eway::fetch_data($response, '<error>', '</error>');
			  
			  return false;
			}
			
		}
		
	}
	
	
	
	//Payment Function

	function doPayment_old() {

	ob_start();

?>

<center><h3><?php echo $this->message; ?></h3></center>

	<form method="post" name="ewaySubmitForm" action="<?php echo $this->myGatewayURL;?>">

	<input type="hidden" name="ewayCustomerID" value="<?php echo 	$this->myCustomerID;?>" />

<?php

	foreach($this->myTransactionData as $key=>$value){

?>	<input type="hidden" name="<?php echo $key?>" value="<?php echo $value?>" />

<?php

	}

?>	</form>

<script type="text/javascript">

  function redirect(){

				document.ewaySubmitForm.submit();

			}

   setTimeout("redirect()",5000);	

 </script>

<?php

return ob_get_clean();

	}

	//Set Transaction Data

	//Possible fields: "TotalAmount", "CustomerFirstName", "CustomerLastName", "CustomerEmail", "CustomerAddress", "CustomerPostcode", 

	//"CustomerInvoiceDescription", "CustomerInvoiceRef", "URL", "SiteTitle", "TrxnNumber", "Option1", "Option2", "Option3", "CVN"

	function setTransactionData($field, $value) {

		//if($field=="TotalAmount")

			//$value = round($value*100);

		$this->myTransactionData[$field] = htmlentities(trim($value));

	}

}

?>
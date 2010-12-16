<?php



/**

* @version 2.6.5

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

    var $myTransactionData = array();

	

	var $bywebservice =  false ;

    

	//Class Constructor

	function EwayPaymentHosted($customerID = EWAY_DEFAULT_CUSTOMER_ID, $method = EWAY_DEFAULT_PAYMENT_METHOD ,$liveGateway  = EWAY_DEFAULT_LIVE_GATEWAY) {

	    $this->myCustomerID = $customerID;
       
	    switch($method){

		    case "REAL_TIME";

		    		if($liveGateway)

		    			$this->myGatewayURL = EWAY_PAYMENT_HOSTED_REAL_TIME;

		    		else

	    				$this->myGatewayURL = EWAY_PAYMENT_HOSTED_REAL_TIME_TESTING_MODE;

	    		break;

	    	 case "REAL-TIME-CVN";

		    		if($liveGateway)

		    			$this->myGatewayURL = EWAY_PAYMENT_HOSTED_REAL_TIME_CVN;

		    		else

	    				$this->myGatewayURL = EWAY_PAYMENT_HOSTED_REAL_TIME_CVN_TESTING_MODE;

	    		break;	    	

    	}
		

	}

	

	//Payment Function

	function doPayment() {

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

		if($field=="TotalAmount")

			$value = round($value*100);

		$this->myTransactionData["eway" . $field] = htmlentities(trim($value));

	}

	

}

?>
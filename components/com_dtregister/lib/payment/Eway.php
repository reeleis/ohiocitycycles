<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class Eway extends Payment{

	var $return_url =  array('registeration'=>'paymentReturn','duepay'=>'duepaymentReturn','change'=>'chgReturn','cancel'=>'cancelReturn');

    function Eway(){

		  global $eway_customerid, $ewaymode, $godaddy_hosting,$ewaytype;

		  parent::__construct();

		  $this->eway_customerid = $eway_customerid;

		  $this->ewaymode = $this->paymentmode;

		  $this->ewaytype = $ewaytype;
           
		   $file =  ($ewaytype == "live")?JPATH_SITE.'/components/com_dtregister/lib/payment/eway/EwayPaymentLive.php':JPATH_SITE.'/components/com_dtregister/lib/payment/eway/EwayPaymentHosted.php';

		  require_once( $file);

		   $class = ($ewaytype == "live")?'EwayPaymentLive':'EwayPaymentHosted';

		  $gateway = ($this->ewaymode=='test')?false:true;

		  $this->payEway = new $class($eway_customerid,'REAL_TIME',$gateway);
          $this->bywebservice = $this->payEway->bywebservice;

		  $this->godaddy_hosting = $godaddy_hosting;

	 }

	 function setformData(){

	     $this->billing_form = $this->billingform();

		 $this->getLoginUserData();

	 }

	 function billingform(){

		 $form =  parent::billingform();

		 ob_start();

		 ?>

             <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left" ><input type="text" name="billing[x_card_num]" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo (isset($this->credircardNo))?$this->credircardNo:''; ?>" />

		              <br />

		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>

		        </tr>

                 <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		          <td width="69%" align="left" ><input type="text" name="billing[x_exp_date]" value="<?php echo (isset($this->credircardExp))?$this->credircardExp:''; ?>" class="inputbox" />

		            &nbsp;&nbsp;(mm/yy)</td>

		        </tr>

                 <tr>

		          <td width="31%" ><?php echo JText::_( 'CVV_CODE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left" ><input type="text" name="billing[x_card_code]" size="10" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo (isset($this->x_card_code))?$this->x_card_code:'' ; ?>" />

		            <?php echo JText::_( 'CVV_CODE_EXPLANATION' );?> </td>

		        </tr>

		 <?php

		 $html = ob_get_clean();

		 return $form.$html; 

	 }

  function drawform($options){

		global $Itemid;

	    if(!method_exists($this->payEway,'setCurlPreferences')){

		   $this->payEway->message = JText::_('DT_EWAY_REDIRECT_MSG');

		   $this->setfields();

	   $session_id = $this->saveSession();
       $this->paymentType = "";
	   $this->private_data = $this->paymentType.'|session='.$session_id;

	   JURI::root( false );

	    $this->continue_url = JURI::root( false )."components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore";

		$this->payEway->setTransactionData("URL",$this->continue_url);

		$this->payEway->setTransactionData("AutoRedirect",1);

		$this->formatPostfields();

		 return $this->payEway->doPayment();

	}

		global $cardtype,$save_payment_info,$cardtype;	

	 }

	  function setfields(){

	   // echo '<pre>'; print_r($this->cart); print_r($this); exit;

	   $this->fields['TotalAmount'] = $this->cart->getAmount();

	   if(method_exists($this->payEway,'setCurlPreferences')){
          $expiry =  explode('/',$this->x_exp_date);

		  $this->fields['CustomerPostcode'] = $this->zip;
		
	      $this->fields['CardNumber'] = $this->x_card_num;

	      $this->fields['CardHoldersName'] = $this->firstname.' '.$this->lastname;

	      $this->fields['CardExpiryMonth'] =  $expiry[0];

	      $this->fields['CardExpiryYear'] = $expiry[1];

		  $this->fields['CVN'] = $this->x_card_code;

	  }

	   $this->fields['CustomerInvoiceRef'] = $this->confirmNum;

	  // $this->fields['CompanyName'] = $this->organization;

	   $this->fields['CustomerFirstName'] = $this->firstname;

	   $this->fields['CustomerInvoiceDescription'] = $this->description;

	   $this->fields['CustomerLastName'] = $this->lastname;

	   $this->fields['CustomerAddress'] = $this->address;

	   $this->fields['CustomerEmail'] = ($this->email!="")?$this->email:'';

	   $this->fields['TrxnNumber'] = '';

	   $this->fields['Option1'] = '';

	   $this->fields['Option2'] = '';

	   $this->fields['Option3'] = '';

	   

	  // $this->fields['Phone'] = $this->phone;

	  // $this->fields['Email'] = $this->email;

	   //$this->fields['Credit'] = 0;

	   //die;

	 }

	 function formatPostfields(){

		 $fields = "";

         foreach( $this->fields as $key => $value ){ 

		    //if(trim($value)!="")

		    $this->payEway->setTransactionData($key, $value);

		 }

	 }

	 function process(){

	    global $Itemid, $curreny_code;

		if(!method_exists($this->payEway,'setCurlPreferences')){

		   echo $this->drawform(array());

		   return true;

		}

		$this->setfields();

		$this->formatPostfields();

		if(method_exists($this->payEway,'getVisitorIP'))

		$this->payEway->setTransactionData("CustomerIPAddress", $this->payEway->getVisitorIP()); //mandatory field when using Geo-IP Anti-Fraud

	    $this->payEway->setTransactionData("CustomerBillingCountry", $curreny_code); //mandatory field when using Geo-IP Anti-Fraud

	//special preferences for php Curl

	if(method_exists($this->payEway,'setCurlPreferences'))

	$this->payEway->setCurlPreferences(CURLOPT_SSL_VERIFYPEER, 0);  

	//pass a long that is set to a zero value to stop curl from verifying the peer's certificate 

	//$eway->setCurlPreferences(CURLOPT_CAINFO, "/usr/share/ssl/certs/my.cert.crt"); //Pass a filename of a file holding one or more certificates to verify the peer with. This only makes sense when used in combination with the CURLOPT_SSL_VERIFYPEER option. 

	//$eway->setCurlPreferences(CURLOPT_CAPATH, "/usr/share/ssl/certs/my.cert.path");

		if($this->godaddy_hosting && method_exists($this->payEway,'setCurlPreferences')){

			$this->payEway->setCurlPreferences(CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //use CURL proxy, for example godaddy.com hosting requires it

	        $this->payEway->setCurlPreferences(CURLOPT_PROXY, "http://proxy.shr.secureserver.net:3128"); //use CURL proxy, for example godaddy.com hosting requires it

		}

	$ewayResponseFields = $this->payEway->doPayment();



	if($ewayResponseFields["EWAYTRXNSTATUS"]=="False"){

		print "Transaction Error: " . $ewayResponseFields["EWAYTRXNERROR"] . "<br>\n";		

		foreach($ewayResponseFields as $key => $value)

			//print "\n<br>\$ewayResponseFields[\"$key\"] = $value";

		//exit();

		return false;

	}else if($ewayResponseFields["EWAYTRXNSTATUS"]=="True"){

	       $this->transactionId = $ewayResponseFields['ewayTrxnReference'];
		   DT_Session::set('register.payment.transactionId',$this->transactionId);

		//print "Transaction Success: " . $ewayResponseFields["EWAYTRXNERROR"]  . "<br>\n";

		foreach($ewayResponseFields as $key => $value)

			//print "\n<br>\$ewayResponseFields[\"$key\"] = $value";

			return true;

		//exit();

	}

	 }

	  function afterpayment(){

		  $this->transactionId = $_REQUEST['ewayTrxnReference'];
		  
		  DT_Session::set('register.payment.transactionId',$this->transactionId);

		   $this->confirmNum = $_SESSION['register']['billingInfo']['confirmNum'];

		   unset($_SESSION['register']['billingInfo']['confirmNum']);

	 }

}

?>
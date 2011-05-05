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
class psigate extends Payment{

    function psigate(){
		  global $psi_storeid, $godaddy_hosting,$psitype,$psi_passphrase,$psi_merchantId;
		  parent::__construct();
		  
		  $file = ($psitype == "live")?JPATH_SITE.'/components/com_dtregister/lib/payment/psigate/hosted.php':JPATH_SITE.'/components/com_dtregister/lib/payment/psigate/live.php';

		  require_once( $file);
		  
		  $class = ($psitype == "live")?'Hosted':'Live';
		  // $class = 'Hosted';
		  $this->paymentObj = new $class();
		  
		  $this->bywebservice = $this->paymentObj->bywebservice;
		  
		  $this->paymentObj->init($this->paymentmode);
		  $this->godaddy_hosting = $godaddy_hosting;
		//  $this->paymentObj->setOrderID('123456'); // Order ID.  Leave blank to have PSiGate assign
		
	}	
	
	function setformData(){
		 $this->paymentObj->setOrderID('123456'); // Order ID.  Leave blank to have PSiGate assign
	     $this->billing_form = $this->billingform();
		 $this->getLoginUserData();

	 }

	function billingform(){

		 $form = parent::billingform();

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

	    if(!$this->bywebservice){

		  $session_id = $this->saveSession();
           
		   $this->paymentObj->session_id = $session_id;
		   $this->setfields();

		 return $this->paymentObj->doPayment();	 

	}

		global $cardtype,$save_payment_info,$cardtype;

	 }
	 
	function getVisitorIP(){

		$ip = $_SERVER["REMOTE_ADDR"];
        
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
		    $proxy = $_SERVER["HTTP_X_FORWARDED_FOR"];

		    if(ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$proxy))
               $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
				
		}

		return $ip;

	}
	 
	function setfields(){

       $this->paymentObj->setSubTotal($this->cart->getAmount());

	   if($this->bywebservice){ 
          $expiry =  explode('/',$this->x_exp_date);
		  $this->paymentObj->setCardNumber($this->x_card_num);
		  
		  $this->paymentObj->setBname($this->firstname.' '.$this->lastname);
		  		  
		  $this->paymentObj->setCardExpMonth($expiry[0]);

		  $this->paymentObj->setCardExpYear($expiry[1]);

		  $this->paymentObj->setCustomerIP($this->getVisitorIP()); // Customer IP address, for fraud

		  $this->paymentObj->setCardCavv($this->x_card_code); //

	  }

	   //pr($this->confirmNum);

       if(isset($this->city))
	   $this->paymentObj->setBcity($this->city);
	   
	   if(isset($this->state))
	   $this->paymentObj->setBprovince($this->state); // Billing state or province
	   if(isset($this->zipcode))
	   $this->paymentObj->setBpostalCode($this->zipcode); // Billing Zip
	   if(isset($this->country))
	   $this->paymentObj->setBcountry($this->country); // Country Code - 2 
	   $this->fields['CustomerInvoiceDescription'] = JText::_('DT_INVOICE_DESCRIPTION_PSIGATE');
       
	   if(isset($this->address))
	   $this->paymentObj->setBaddress1($this->address);
	   
	   if(isset($this->email))
	   	$this->paymentObj->setEmail(($this->email!="")?$this->email:''); // Customer Email
		
		$this->paymentObj->setComments(JText::_('DT_INVOICE_DESCRIPTION_PSIGATE'));  // comments, whatever you'd like

	 }

	function formatPostfields(){

		 $fields = "";

         foreach( $this->fields as $key => $value ){ 

		    //if(trim($value)!="")

		    $this->paymentObj->setTransactionData($key, $value);

		 }

	 }

	function process(){

	    global $Itemid, $curreny_code;

        $this->setfields();		
         
		if(!$this->bywebservice){

		   echo $this->drawform(array());

		   return true;

		}

		$this->paymentObj->godaddy_hosting = false;
		if($this->godaddy_hosting && $this->bywebservice){

			$this->paymentObj->godaddy_hosting = true;

		}

	$return = $this->paymentObj->doPayment();
	
	if($return == PSIGATE_TRANSACTION_OK ){
		
		 $this->transactionId = $this->paymentObj->getTrxnReturnCode();
		 DT_Session::set('register.payment.transactionId',$this->transactionId);
		 return true;
	}else{
		echo $this->paymentObj->getTrxnErrMsg();
		return false;
	}

   }
    
	function success(){
		
		   $this->transactionId = $_REQUEST['TransRefNumber'];
		   DT_Session::set('register.payment.transactionId', $this->transactionId);
		   return true;
		
	}
	function afterpayment(){

	     prd($_REQUEST);

		  $this->transactionId = $_REQUEST['ewayTrxnReference'];
		  
		  DT_Session::set('register.payment.transactionId',$this->transactionId);
           
		   $this->confirmNum =  $_SESSION['register']['billingInfo']['confirmNum'];

		   unset($_SESSION['register']['billingInfo']['confirmNum']);

	 }

}
?>
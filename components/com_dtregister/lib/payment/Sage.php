<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class Sage extends Payment{

	 var $M_id;

	 var $M_key;

	 var $acctNum;

	 var $credircardNo = '';

	 var $credircardExp = '';

	 var $url = "https://www.sagepayments.net/cgi-bin/eftbankcard.dll?transaction";

	 var $godaddy_hosting = 0;

	 var $bywebservice = true;

   function __construct() {

        global $sage_M_id , $sage_M_key ,$sagemode , $godaddy_hosting;

		  parent::__construct();

		  $this->M_id = $sage_M_id;

		  $this->M_key = $sage_M_key;

		  $this->godaddy_hosting = $godaddy_hosting ;

   }

   function billingform(){

	   global $cardtype;

	   $form = parent::billingform();

	   $size = count($cardtype);

	   ob_start();

	   ?>

          <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left" ><input type="text" name="billing[x_card_num]"  class="inputbox" value="<?php echo isset($this->cb_creditcardnumber)?$this->cb_creditcardnumber:''?>" />

		              <br />

		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>

		        </tr>

           <tr>

		          <td width="31%" ><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		          <td width="69%" align="left" ><input type="text" name="billing[x_exp_date]" value="<?php echo isset($this->x_exp_date)? $this->x_exp_date:''?>" class="inputbox" />

		            &nbsp;&nbsp;(mm/yy)</td>

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

	 $this->x_exp_date =str_replace("/","",$this->x_exp_date);

	   $this->fields = array(

//  ###########3  MINIMUM TRANSACTION REQUIRED DETAILS  ################3

	"M_id"				=> $this->M_id,

	"M_key"				=> $this->M_key,

    "T_code"=> '01',

    'C_name' => trim($this->firstname.' '.$this->lastname),

	"C_cardnumber"			=> $this->x_card_num,

	"C_exp"			=> $this->x_exp_date,

	"x_description"			=> $this->description,

    "x_card_code"           => $this->x_card_code,

	"T_amt"				=>  $this->cart->getAmount(),
	
	//"T_amt"				=>  1,

//	"CompanyName"      		=>$this->organization,

	"C_address"				=>$this->address,

	"C_city"				=>$this->city,

	"C_state"				=>$this->state,

	"C_zip"					=>$this->zipcode,

	"C_email"				=>$this->email,

                     );

   }

   function process(){

	  $this->setFields();

	  $fields = $this->formatfields();

	  $this->url;

	  $ch = curl_init($this->url);

	  if($this->godaddy_hosting){

		  curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

		  curl_setopt ($ch, CURLOPT_PROXY,"http://proxy.shr.secureserver.net:3128");

	  }

	  	curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response

		//curl_setopt($ch, CURLOPT_VERBOSE, 1);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)

		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###

		 $resp = curl_exec($ch); //execute post and get results

		 $this->response = $resp;

		 $this->parseResponse();

		 if($this->responseParts['success']=='A'){

			  $this->transactionId = $gatewaydata['TransactionID'];
			  DT_Session::set('register.payment.transactionId',$this->transactionId);

			 return true;

		 }else{
              echo $this->responseParts['message'] ;
			  return false;

		}

		 prd($resp);

   }

    function parseResponse(){

	  $resp = $this->response;

	  $data['success'] = $resp[1]; //A is approved E is declined/error.

	  $data['code'] = substr($resp, 2, 6);

      $data['message'] = substr($resp, 8, 32);

      $data['frontend'] = substr($resp, 40, 2);

      $data['cvv'] = $resp[42];

	  $data['avs'] = $resp[43];

      $data['risk'] = substr($resp, 44, 2);

      $data['reference'] = substr($resp, 46, 10);
	
	  $start  =  strpos($resp, chr(28)) + 1 ;
	  $end = strrpos($resp, chr(28)) ;
	  $length = $end - $start ;
	

      $data['TransactionID'] = substr($resp, $start,$length);

       $this->responseParts = $data;

		 return $data;

	 }

}

?>
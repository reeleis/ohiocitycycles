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
class echeck extends Payment{
    
   	var $bywebservice = true;
	var $x_bank_acct_type = "";
   function __construct() {

        global $merchid, $authnetmode, $transkey,$godaddy_hosting;
		parent::__construct();
		$this->godaddy_hosting = $godaddy_hosting;

		$this->url = ($this->paymentmode=='test')?"https://test.authorize.net/gateway/transact.dll":"https://secure.authorize.net/gateway/transact.dll";
		
		$this->x_test_request = ($this->paymentmode=='test')?'TRUE':'FALSE';
		
		$this->x_login = $merchid;
		
		$this->x_version = "3.1";
		
		$this->x_tran_key = $transkey;
		$this->x_delim_char = "|";
		$this->x_delim_data = "TRUE";
		$this->x_url = "FALSE";
		$this->x_type = "AUTH_CAPTURE";
		$this->x_method = "ECHECK";
		$this->x_relay_response = "FALSE";

   }
   
   function billingform(){
	   global $cardtype;
	   $form = parent::billingform();
	  	
	   $size = count($cardtype);
	   ob_start();
	   
	   ?>
	      <tr><td colspan="2" ><strong><?php echo JText::_( 'DT_BANK_INFORMATION' ) ?></strong><br /></td></tr>
          <tr><td><?php echo JText::_( 'DT_BANK_ROUTING_NUMBER' ) ?>:<span class='dtrequired'>&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;</span></td>

					<td><input type="text" name="billing[x_bank_aba_code]" onKeyUp="chknumber(this)" class="inputbox"  size="20" maxlength="16" value="<?php echo isset($rowProfile->cb_routingnumber)?$rowProfile->cb_routingnumber:'';?>"/></td></tr>

			    <tr><td><?php echo JText::_( 'DT_BANK_ACCOUNT_NUMBER' ) ?>:<span class='dtrequired'>&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;</span></td>

			        <td><input type="text" name="billing[x_bank_acct_num]" onKeyUp="chknumber(this)" class="inputbox"  size="20" maxlength="16" value="<?php echo isset($rowProfile->cb_acctnumber)?$rowProfile->cb_acctnumber:'';?>"/></td></tr>

			    <tr><td><?php echo JText::_( 'DT_BANK_ACCOUNT_TYPE' ) ?>:<span class='dtrequired'>&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;</span></td>

			        <td>
                    <?php
					$options = array('CHECKING'=> JText::_( 'DT_BANK_CHECKING' ),'SAVINGS'=>JText::_( 'DT_BANK_SAVINGS' ));
                    $options=DtHtml::options($options);

			echo JHTML::_('select.genericlist', $options,'billing[x_bank_acct_type]','','value','text',$this->x_bank_acct_type);
  ?>

			        </td></tr>
         <tr><td><?php echo JText::_( 'DT_BANK_NAME' ); ?>:<span class='dtrequired'>&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;</span></td>

			        <td><input type="text" name="billing[x_bank_name]" class="inputbox" size="30" value="<?php echo isset($rowProfile->cb_bankname)?$rowProfile->cb_bankname:''?>"/></td></tr>

			  	<tr><td><?php echo JText::_( 'DT_BANK_ACCOUNT_HOLDER' ); ?>:<span class='dtrequired'>&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;</span></td><td><input type="text" name="billing[x_bank_acct_name]" class="inputbox" size="30" value="<?php echo isset($rowProfile->cb_accountholder)?$rowProfile->cb_accountholder:''?>"/></td></tr>
	<tr><td colspan="2" align="center">&nbsp;</td></tr>


       <?php
	   $html = ob_get_clean();
	   
	   return $form.$html;
 
   }
   
   function setFields(){
	   
	   $this->fields = array(             

//  ###########3  MINIMUM TRANSACTION REQUIRED DETAILS  ################3
    //"x_allow_partial_Auth"  => "True",
	"x_login"				=> $this->x_login,

	"x_version"				=> $this->x_version,

    "x_delim_char"			=> $this->x_delim_char,

	"x_delim_data"			=> $this->x_delim_data,

	"x_url"					=> $this->x_url,

	"x_type"				=> $this->x_type,

	"x_method"				=> $this->x_method,

 	"x_tran_key"			=> $this->x_tran_key,

 	"x_relay_response"		=> $this->x_relay_response,
     
	"x_amount"				=>  $this->cart->getAmount(),

    "x_test_request"        => $this->x_test_request,

//  ###########3  CUSTOMER DETAILS  ################3

	"x_first_name"			=>$this->firstname,

	"x_last_name"			=>$this->lastname,

	//"x_company"      		=>$this->organization,

	"x_address"				=>$this->address,

	"x_city"				=>$this->city,

	"x_state"				=>$this->state,

	//"x_phone"				=>$this->phone,

	"x_zip"					=>$this->zipcode,

	//"x_cust_id"				=>substr($this->confirmNum,3),

	"x_email"				=>$this->email,

//  ###########3  SHIPPING DETAILS  ################3

	"x_ship_to_first_name" 	=> $this->firstname,

	"x_ship_to_last_name" 	=> $this->lastname,

	 "x_ship_to_address"  	=> $this->address,

	"x_ship_to_city" 		=> $this->city,

	"x_ship_to_state" 		=> $this->state,

	//"x_ship_to_country" 	=> $this->country,

	"x_ship_to_zip" 		=> $this->zipcode,

	//"x_ship_to_phone" 		=> $this->phone,

	"x_ship_to_email" 		=> $this->email,

//  ###########3  MERCHANT REQUIRED DETAILS  ################3

	"x_invoice_num" 		=> (!isset($this->confirmNum)|| $this->confirmNum=="")?'':$this->confirmNum,
	
	"x_description"			=> $this->description,
	
	"x_bank_aba_code"		=> $this->x_bank_aba_code,

	"x_bank_acct_num"		=> $this->x_bank_acct_num,

	"x_bank_acct_type"		=> $this->x_bank_acct_type,

	"x_bank_name"			=> $this->x_bank_name,

	"x_bank_acct_name"		=> stripslashes(stripslashes($this->x_bank_acct_name)),

	"x_echeck_type"			=> "WEB",

	"x_recurring_billing"	=> "NO",

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
		 $this->parseResponse() ;
		 if($this->responseParts[0]==1){
			  $this->transactionId = $this->responseParts[6] ;
			  DT_Session::set('register.payment.transactionId',$this->transactionId);
			 return true;
		 }else{
			 $res = $this->responseParts;
			 switch($res[0]){
			
				case 1:
			
					$this->errorMsg = JText::_( 'DT_PAYMENT_SUCCESSFUL' ).'<br />';
			
					$this->errorMsg .= JText::_( 'DT_AUTHORIZATION_CODE' ).': '.$res[4].'<br />';
			
					$this->errorMsg .= JText::_( 'DT_AMOUNT' ).': '.$res[9].'<br />';
			
					$this->errorMsg .= JText::_( 'TRANS_ID' ).': '.$res[6].'<br />';
			
					$this->errorMsg .= JText::_( 'DT_INVOICE_NUMBER' ).': '.$res[7].'<br /><br />';
			
					break;
			
				case 2:
			
					if($res[2]==2 || $res[2]==4){
			
						$this->errorMsg =  JText::_( 'DT_PAYMENT_DECLINED' );
			
						$this->errorMsg .= JText::_( 'DT_REASON' ).": ".$res[3]."<br />";
			
					}
			
					break;
			
				case 3:
			
					if($this->paymentmode=='test'){$status =1;
			
					}else{
			
						echo JText::_( 'DT_REASON' ).": ";
			
						switch($res[2]){
			
							case 5:
			
								$this->errorMsg =  JText::_( 'DT_AMOUNT_NOT_VALID' );
			
								break;
			
							case 6:
			
							case 37:
			
								$this->errorMsg =  JText::_( 'DT_CARD_NUMBER_INVALID' );
			
								break;
			
							case 7:
			
								$this->errorMsg =  JText::_( 'DT_EXP_DATE_INVALID' );
			
								break;
			
							case 11:
			
								$this->errorMsg =  JText::_( 'DT_DUPLICATE_TRANSACTION' );
			
								break;
			
							case 13:
			
								$this->errorMsg =  JText::_( 'DT_API_LOGIN_INVALID' );
			
								break;
			
							case 17:
			
							case 28:
			
								$this->errorMsg =  JText::_( 'DT_MERCHANT_NOT_CONFIGURED' );
			
								break;
			
							case 19:
			
							case 20:
			
							case 21:
			
							case 22:
			
							case 23:
			
							case 25:
			
							case 26:
			
							case 57:
			
							case 58:
			
							case 59:
			
							case 60:
			
							case 61:
			
							case 62:
			
							case 63:
			
								$this->errorMsg =  JText::_( 'DT_ERROR_OCCURRED' );
			
								$this->errorMsg .=  '<a href="'.JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid ,$xhtml_url).'">'.JText::_( 'DT_CLICK_HERE' ).'</a>';
			
								break;
			
							case 27:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_AVS_MISMATCH');
			
								break;
			
							case 34:
			
							case 35:
			
							case 38:
			
							case 43:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_MERCH_SETUP_PROCESSOR' );
			
								break;
			
							case 49:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_MAX_ALLOWED' );
			
								break;
			
							case 50:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_TRANS_SETTLE_REFUNDED' );
			
								break;
			
							case 54:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_REF_TRANS' );
			
								break;
			
							case 55:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_SUM_CREDIT_REF_TRANS' );
			
								break;
			
							case 56:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_ECHECK_ONLY' );
			
								break;
			
							case 66:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_SECURITY_GUIDELINES' );
			
								break;
			
							case 68:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_XVERSION_INVALID' );
			
								break;
			
							case 69:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_XTYPE_INVALID' );
			
								break;
			
							case 78:
			
								$this->errorMsg =  JText::_( 'DT_AUTH_XCARD_FAILED' );
			
								break;
			
						}
			
					}
			
					break;
			
			}
			 switch($res[38]){

				  case 'N':
		  
					  $this->errorMsg =  JText::_( 'DT_AUTH_CC_CODE_MISMATCH' );
		  
					  break;
		  
				  case 'P':
		  
					  $this->errorMsg =  JText::_( 'DT_AUTH_CC_NOT_PROCESSED' );
		  
					  break;
		  
				  case 'S':
		  
					  $this->errorMsg =  JText::_( 'DT_AUTH_CC_CODE_NOT_PRESENT' );
		  
					  break;
		  
				  case 'U':
		  
					  $this->errorMsg =  JText::_( 'DT_AUTH_ISSUER_NOT_PROCESS' );
		  
					  break;
		  
			  }
			  
			  return false;

		 }
	     
   }
   
    function parseResponse(){
	     
		 $this->responseParts = explode("|",$this->response);
		
	 }
  
}
?>
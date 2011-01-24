<?php

/**
* @version 2.7.1
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');
class saferpay extends Payment {
	
	var $url = null;
	
	var $account_id = null;
	
	var $params = array();
	
	var $data = array();
	
	var $bywebservice =  false;
	
	function __construct() {
		global $Itemid;
		global $godaddy_hosting , $safe_pay_account_id , $currency_code;
		parent::__construct();

		$this->godaddy_hosting = $godaddy_hosting;
		$this->url = 'https://www.saferpay.com/hosting/';
		//$this->paymentmode = "test";
		if ($this->paymentmode == 'test') {
			$this->account_id =  '99867-94913159';
		} else {
			$this->account_id =  $safe_pay_account_id;
		}
		$this->set_param('ACCOUNTID', $this->account_id);
		
		$this->currency_code = $currency_code;
											
	}
	
	function set_param($name, $val) {
		$this->params[$name] = $val;
	}
	
	function set_params($params) {
		foreach ($params as $key => $value) {
			$this->params[$key] = $value;
		}
	}
	
	function process() {
		global $mainframe, $Itemid;		
		$siteUrl = JURI::base();
									
		$description = $this->description;
		$session_id = $this->saveSession();
		$this->set_param('CURRENCY', $this->currency_code);
		$this->set_param('SUCCESSLINK', JURI::base()."components/com_dtregister/success.php?return=".$session_id."&Itemid=$Itemid&task=restore");
		$this->set_param('ORDERID', $session_id);
		$this->set_param('DESCRIPTION', $this->description) ;
		$this->set_param('AMOUNT', $this->cart->getAmount()*100);
		$queryString = '';
		foreach ($this->params as  $key => $value) {
			$queryString .= $key. "=" . urlencode($value) ."&";
		}
		$queryString = substr($queryString, 0, strlen($queryString) - 1);
		$url = $this->url . 'CreatePayInit.asp?' . $queryString;
		$redirectURL = $this->getUrl($url);
		$mainframe->redirect($redirectURL);									
	}	
	
	function validate() {		  
		$queryString = $_SERVER['QUERY_STRING'];
		$query = $this->parseVariables($queryString);				
		$orderId = $_REQUEST["order_id"];
		$data = $query['DATA'];
		$signature = $query['SIGNATURE'];
		$valid = true;									
		if( empty( $signature )) {
			$valid = false;
		}				
		$DATA = urldecode($data);		
		while (substr($DATA,0,14)=="<IDP MSGTYPE=\\") {$DATA = stripslashes($DATA);}
		$SIGNATURE = urldecode($signature);					
		if ($this->paymentmode != 'test') {
			$accountId = $this->account_id;
		} else {
			$accountId = '99867-94913159';			
		}
		if (empty($accountId)) {
			$valid = false;
		}		
		if ($valid) {
			$orderId = intval( $orderId );				
			$gateway = $this->url . "VerifyPayConfirm.asp";				
			$url = "$gateway?DATA=".urlencode($DATA)."&SIGNATURE=".urlencode($SIGNATURE);
			$result = $this->getUrl($url);			
			if (substr($result, 0, 3) == "OK:")
			{											
				parse_str(substr($result, 3));
				if ($this->paymentmode != 'test') {
					$payCompleteURL = $this->url . "PayComplete.asp?ACCOUNTID=$accountId&ID=".urlencode($ID)."&TOKEN=".urlencode($TOKEN);
				} else {					
					$payCompleteURL = $this->url . "PayComplete.asp?spPassword=XAjc3Kna&ACCOUNTID=$accountId&ID=".urlencode($ID)."&TOKEN=".urlencode($TOKEN);
				}				
				$payCompleteResult = $this->getUrl($payCompleteURL);							
				if (substr($payCompleteResult, 0, 2) == "OK")
				{
					$valid = true;					
					parse_str(substr($payCompleteResult, 3));
					JRequest::setVar('transaction_id', $ID);
				}
				else
				{
					$valid = false;
				}
			}
			else 
			{
				$valid = false;			
			}																								
		}		
		return $valid;							
	}	
	
	function success() {					
		global  $mainframe ,$Itemid , $now;
		
		$ret = $this->validate();				
		if ($ret) {
			$id = JRequest::getVar('order_id', 0);						   			   			
   			
   			$this->transactionId = JRequest::getVar('transaction_id');
   			DT_Session::set('register.payment.transactionId', $this->transactionId);
   			$database = &JFactory::getDBO();
	        $data = $_SESSION;
	        $sql = "update #__dtregister_session set `data`= ".$database->Quote(serialize($data))." where id=".$id;
	        $database->setQuery($sql);
	        $database->query();
		    
			$database->getErrorMsg();
			
   			return true;	
		} else {			
			
			return false;
		}		     
	}
	
	
	function getUrl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		if($this->godaddy_hosting){

           curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
           curl_setopt ($ch, CURLOPT_PROXY,"http://proxy.shr.secureserver.net:3128");
        }
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);		
		curl_close($ch);
		return $result;
	}	
	
	function parseVariables($queryString) {		
		$array = array();
		$parts = explode('&', $queryString);		
		for ($i = 0 , $n = count($parts);
		    $i < $n; $i++) {
			$keyValueArr = explode('=', $parts[$i]);
			$array[$keyValueArr[0]] = $keyValueArr[1]; 
		}
		return $array;
	}
}
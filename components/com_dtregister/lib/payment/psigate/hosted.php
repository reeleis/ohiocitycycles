<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

define( 'PSIGATE_CURL_ERROR_OFFSET', 1000 );
define( 'PSIGATE_XML_ERROR_OFFSET',  2000 );
define( 'PSIGATE_TRANSACTION_OK',       'APPROVED' );
define( 'PSIGATE_TRANSACTION_DECLINED',   'DECLINED' );
define( 'PSIGATE_TRANSACTION_ERROR',  'ERROR' );

class Hosted {
    var $parser;
    var $xmlData;
    var $currentTag;
    var $myGatewayURL;
    var $myStoreID;
    var $myPassphrase;
    var $myPaymentType;
    var $myCardAction;
    var $mySubtotal;
    var $myTaxTotal1;
    var $myTaxTotal2;
    var $myTaxTotal3;
    var $myTaxTotal4;
    var $myTaxTotal5;
    var $myShipTotal;
    var $myCardNumber;
    var $myCardExpMonth;
    var $myCardExpYear;
    var $myCardIDCode;
    var $myCardIDNumber;
    var $myTestResult;
    var $myOrderID;
    var $myUserID;
    var $myBname;
    var $myBcompany;
    var $myBaddress1;
    var $myBaddress2;
    var $myBcity;
    var $myBprovince;
    var $myBpostalcode;
    var $myBcountry;
    var $mySname;
    var $myScompany;
    var $mySaddress1;
    var $mySaddress2;
    var $myScity;
    var $mySprovince;
    var $mySpostalcode;
    var $myScountry;
    var $myPhone;
    var $myFax;
    var $myEmail;
    var $myComments;
    var $myCustomerIP;
    var $myCardXID;
    var $myCardCavv;
    var $myCardECI;
    var $myResultTrxnTransTime;
    var $myResultTrxnOrderID;
    var $myResultTrxnApproved;
    var $myResultTrxnReturnCode;
    var $myResultTrxnErrMsg;
    var $myResultTrxnTaxTotal;
    var $myResultTrxnShipTotal;
    var $myResultTrxnSubTotal;
    var $myResultTrxnFullTotal;
    var $myResultTrxnPaymentType;
    var $myResultTrxnCardNumber;
    var $myResultTrxnCardExpMonth;
    var $myResultTrxnCardExpYear;
    var $myResultTrxnTransRefNumber;
    var $myResultTrxnCardIDResult;
    var $myResultTrxnAVSResult;
    var $myResultTrxnCardAuthNumber;
    var $myResultTrxnCardRefNumber;
    var $myResultTrxnCardType;
    var $myResultTrxnIPResult;
    var $myResultTrxnIPCountry;
    var $myResultTrxnIPRegion;
    var $myResultTrxnIPCity;
    var $myError;
    var $myErrorMessage;
	var $bywebservice = true;

    /***********************************************************************
     *** XML Parser - Callback functions                                 ***
     ***********************************************************************/

    function ElementStart ($parser, $tag, $attributes) {
        $this->currentTag = $tag;
    }

    function ElementEnd ($parser, $tag) {
        $this->currentTag = "";
    }

    function charachterData ($parser, $cdata) {
        $this->xmlData[$this->currentTag] = $cdata;
    }

 	function init($mode = 'test'){
		
		global $psi_storeid, $godaddy_hosting,$psitype,$psi_passphrase , $psi_live_url;
		if($mode == 'test'){
			
			$this->setGatewayURL('https://dev.psigate.com:7989/Messenger/XMLMessenger'); 
			
			$this->setStoreID('teststore');
		    $this->setPassPhrase('psigate1234'); // Assures authenticity
		}else{
			
			$this->setGatewayURL($psi_live_url); 
			$this->setStoreID($psi_storeid);
		    $this->setPassPhrase($psi_passphrase); // Assures authenticity
			
		}

		$this->setPaymentType('CC');
		$this->setCardAction('0'); // 1 for Authorize, 0 for Immediate Charge
		$this->setTaxTotal1('0'); // Tax value 1, ex Sales Tax
	    $this->setTaxTotal2(''); // Tax value 2, ex VAT
		$this->setTaxTotal3('0'); // Tax value 3, ex GST
		$this->setTaxTotal4('0'); // Tax value 4, ex PST
		$this->setTaxTotal5('0'); // Tax value 5
		$this->setShiptotal('0'); // shipping
		$this->myShippingtotal = 0;
		
	}
	
    /***********************************************************************
     *** SET values to send to PsiGate                                   ***
     ***********************************************************************/

	function setGatewayURL($GatewayURL) {
		$this->myGatewayURL = $GatewayURL;
	}

    function setStoreID( $StoreID ) {
        $this->myStoreID = $StoreID;
    }

    function setPassphrase( $Passphrase ) {
        $this->myPassphrase = $Passphrase;
    }

    function setPaymentType( $PaymentType ) {
        $this->myPaymentType = $PaymentType;
    }

    function setCardAction( $CardAction ) {
        $this->myCardAction = $CardAction;
    }

    function setSubtotal( $Subtotal ) {
        $this->mySubtotal = $Subtotal;
    }

    function setTaxTotal1( $TaxTotal1 ) {
    	$this->myTaxTotal1 = $TaxTotal1;
    }

    function setTaxTotal2( $TaxTotal2 ) {
    	$this->myTaxTotal2 = $TaxTotal2;
    }

    function setTaxTotal3( $TaxTotal3 ) {
    	$this->myTaxTotal3 = $TaxTotal3;
    }

    function setTaxTotal4( $TaxTotal4 ) {
    	$this->myTaxTotal4 = $TaxTotal4;
    }

    function setTaxTotal5( $TaxTotal5 ) {
    	$this->myTaxTotal5 = $TaxTotal5;
    }

    function setShiptotal( $Shiptotal ) {
    	$this->myShippingtotal = $Shiptotal;
    }

    function setCardNumber( $CardNumber ) {
        $this->myCardNumber = $CardNumber;
    }

    function setCardExpMonth( $CardExpMonth ) {
        $this->myCardExpMonth = $CardExpMonth;
    }

    function setCardExpYear( $CardExpYear ) {
        $this->myCardExpYear = $CardExpYear;
    }

    function setCardIDCode( $CardIDCode ) {
        $this->myCardIDCode = $CardIDCode;
    }

    function setTestResult( $TestResult ) {
        $this->myTestResult = $TestResult;
    }

    function setOrderID( $OrderID ) {
        $this->myOrderID = $OrderID;
    }

    function setUserID( $UserID ) {
        $this->myUserID = $UserID;
    }

    function setBname( $Bname ) {
        $this->myBname = $Bname;
    }

    function setBcompany( $Bcompany ) {
        $this->myBcompany = $Bcompany;
    }

    function setBaddress1( $Baddress1 ) {
        $this->myBaddress1 = $Baddress1;
    }

    function setBaddress2( $Baddress2 ) {
        $this->myBaddress2 = $Baddress2;
    }

    function setBcity( $Bcity ) {
        $this->myBcity = $Bcity;
    }

    function setBprovince( $Bprovince ) {
        $this->myBprovince = $Bprovince;
    }

    function setBpostalcode( $Bpostalcode) {
    	$this->myBpostalcode = $Bpostalcode;
    }

    function setBcountry( $Bcountry) {
    	$this->myBcountry = $Bcountry;
    }

    function setSname( $Sname) {
    	$this->mySname = $Sname;
    }

    function setScompany( $Scompany) {
    	$this->myScompany = $Scompany;
    }

    function setSaddress1( $Saddress1) {
    	$this->mySaddress1 = $Saddress1;
    }

    function setSaddress2( $Saddress2) {
    	$this->mySaddress2 = $Saddress2;
    }

    function setScity( $Scity) {
    	$this->myScity = $Scity;
    }

    function setSprovince( $Sprovince) {
    	$this->mySprovince = $Sprovince;
    }

    function setSpostalcode( $Spostalcode) {
    	$this->mySpostalcode = $Spostalcode;
    }

    function setScountry( $Scountry) {
    	$this->myScountry = $Scountry;
    }

    function setPhone( $Phone) {
    	$this->myPhone = $Phone;
    }

    function setFax( $Fax) {
    	$this->myFax = $Fax;
    }

    function setEmail( $Email) {
    	$this->myEmail = $Email;
    }

    function setComments( $Comments) {
    	$this->myComments = $Comments;
    }

    function setCustomerIP( $CustomerIP) {
    	$this->myCustomerIP = $CustomerIP;
    }

    function setCardIDNumber( $CardIDNumber) {
    	$this->myCardIDNumber = $CardIDNumber;
    }

    function setCardXID( $CardXID) {
    	$this->myCardXID = $CardXID;
    }

    function setCardCavv( $CardCavv) {
    	$this->myCardCavv = $CardCavv;
    }

    function setCardECI( $CardECI) {
    	$this->myCardECI = $CardECI;
    }

    /***********************************************************************
     *** GET values returned by PsiGate                                  ***
     ***********************************************************************/

    function getTrxnTransTime() {
        return $this->myResultTrxnTransTime;
    }

    function getTrxnOrderID() {
        return $this->myResultTrxnOrderID;
    }

    function getTrxnApproved() {
        return $this->myResultTrxnApproved;
    }

    function getTrxnReturnCode() {
        return $this->myResultTrxnReturnCode;
    }

    function getTrxnErrMsg() {
        return $this->myResultTrxnErrMsg;
    }

    function getTrxnTaxTotal() {
        return $this->myResultTrxnTaxTotal;
    }

    function getTrxnShipTotal() {
        return $this->myResultTrxnShipTotal;
    }

    function getTrxnSubTotal() {
        return $this->myResultTrxnSubTotal;
    }

    function getTrxnFullTotal() {
        return $this->myResultTrxnFullTotal;
    }

    function getTrxnPaymentType() {
        return $this->myResultTrxnPaymentType;
    }

    function getTrxnCardNumber() {
        return $this->myResultTrxnCardNumber;
    }

    function getTrxnCardExpMonth() {
        return $this->myResultTrxnCardExpMonth;
    }

    function getTrxnCardExpYear() {
        return $this->myResultTrxnCardExpYear;
    }

    function getTrxnTransRefNumber() {
        return $this->myResultTrxnTransRefNumber;
    }

    function getTrxnCardIDResult() {
        return $this->myResultTrxnCardIDResult;
    }

    function getTrxnAVSResult() {
        return $this->myResultTrxnAVSResult;
    }

    function getTrxnCardAuthNumber() {
        return $this->myResultTrxnCardAuthNumber;
    }

    function getTrxnCardRefNumber() {
        return $this->myResultTrxnCardRefNumber;
    }

    function getTrxnCardType() {
        return $this->myResultTrxnCardType;
    }

    function getTrxnIPResult() {
        return $this->myResultTrxnIPResult;
    }

    function getTrxnIPCountry() {
        return $this->myResultTrxnIPCountry;
    }

    function getTrxnIPRegion() {
        return $this->myResultTrxnIPRegion;
    }

    function getTrxnIPCity() {
        return $this->myResultTrxnIPCity;
    }

    function getError() {

        if( $this->myError != 0 ) {
            // Internal Error
            return $this->myError;
        } else {
            // PsiGate Error
            if( $this->getTrxnApproved() == 'APPROVED' ) {
                return PSIGATE_TRANSACTION_OK;
            } elseif( $this->getTrxnApproved() == 'DECLINED' ) {
                return PSIGATE_TRANSACTION_DECLINED;
            } else {
                return PSIGATE_TRANSACTION_ERROR;
            }
        }
    }

    function getErrorMessage() {

        if( $this->myError != 0 ) {
            // Internal Error
            return $this->myErrorMessage;
        } else {
            // PsiGate Error
            return $this->getTrxnError();
        }
    }

    /***********************************************************************
     *** Class Constructor                                               ***
     ***********************************************************************/

    function Hosted() {
    }

    /***********************************************************************
     *** Business Logic                                                  ***
     ***********************************************************************/

    function doPayment() {
		
        $xmlRequest = "<Order>".
                "<StoreID>".htmlentities( $this->myStoreID )."</StoreID>".
                "<Passphrase>".htmlentities( $this->myPassphrase)."</Passphrase>".
                "<Tax1>".htmlentities( $this->myTaxTotal1)."</Tax1>".
                "<Tax2>".htmlentities( $this->myTaxTotal2)."</Tax2>".
                "<Tax3>".htmlentities( $this->myTaxTotal3)."</Tax3>".
                "<Tax4>".htmlentities( $this->myTaxTotal4)."</Tax4>".
                "<Tax5>".htmlentities( $this->myTaxTotal5)."</Tax5>".
                "<ShippingTotal>".htmlentities( $this->myShippingtotal)."</ShippingTotal>".
                "<Subtotal>".htmlentities( $this->mySubtotal )."</Subtotal>".
                "<PaymentType>".htmlentities( $this->myPaymentType )."</PaymentType>".
                "<CardAction>".htmlentities( $this->myCardAction )."</CardAction>".
                "<CardNumber>".htmlentities( $this->myCardNumber )."</CardNumber>".
                "<CardExpMonth>".htmlentities( $this->myCardExpMonth )."</CardExpMonth>".
                "<CardExpYear>".htmlentities( $this->myCardExpYear )."</CardExpYear>".
                "<CardIDCode>".htmlentities( $this->myCardIDCode )."</CardIDCode>".
                "<CardIDNumber>".htmlentities( $this->myCardIDNumber )."</CardIDNumber>".
                "<TestResult>".htmlentities( $this->myTestResult )."</TestResult>".
                "<OrderID>".htmlentities( $this->myOrderID )."</OrderID>".
                "<UserID>".htmlentities( $this->myUserID )."</UserID>".
                "<Bname>".htmlentities( $this->myBname )."</Bname>".
                "<Bcompany>".htmlentities( $this->myBcompany )."</Bcompany>".
                "<Baddress1>".htmlentities( $this->myBaddress1 )."</Baddress1>".
                "<Baddress2>".htmlentities( $this->myBaddress2 )."</Baddress2>".
                "<Bcity>".htmlentities( $this->myBcity )."</Bcity>".
                "<Bprovince>".htmlentities( $this->myBprovince )."</Bprovince>".
                "<Bpostalcode>".htmlentities( $this->myBpostalcode )."</Bpostalcode>".
                "<Bcountry>".htmlentities( $this->myBcountry )."</Bcountry>".
                "<Sname>".htmlentities( $this->mySname )."</Sname>".
                "<Scompany>".htmlentities( $this->myScompany )."</Scompany>".
                "<Saddress1>".htmlentities( $this->mySaddress1 )."</Saddress1>".
                "<Saddress2>".htmlentities( $this->mySaddress2 )."</Saddress2>".
                "<Scity>".htmlentities( $this->myScity )."</Scity>".
                "<Sprovince>".htmlentities( $this->mySprovince )."</Sprovince>".
                "<Spostalcode>".htmlentities( $this->mySpostalcode )."</Spostalcode>".
                "<Scountry>".htmlentities( $this->myScountry )."</Scountry>".
                "<Phone>".htmlentities( $this->myPhone )."</Phone>".
                "<Email>".htmlentities( $this->myEmail )."</Email>".
                "<Comments>".htmlentities( $this->myComments )."</Comments>".
                "<CustomerIP>".htmlentities( $this->myCustomerIP )."</CustomerIP>".
                "<CardXID>".htmlentities( $this->myCardXID )."</CardXID>".
                "<CardCavv>".htmlentities( $this->myCardCavv )."</CardCavv>".
                "<CardECI>".htmlentities( $this->myCardECI )."</CardECI>".
        "</Order>";

        /* Use CURL to execute XML POST and write output into a string */
        $ch = curl_init( $this->myGatewayURL );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xmlRequest );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 240 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		
		if($this->godaddy_hosting){
		 //  curl_setopt( $ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP );
		  // curl_setopt( $ch, CURLOPT_PROXY, 'http://proxy.shr.secureserver.net:3128' );
		}
		
         $xmlResponse = curl_exec( $ch );
		
        // Check whether the curl_exec worked.
        if( curl_errno( $ch ) == CURLE_OK ) {
            // It worked, so setup an XML parser for the result.
            $this->parser = xml_parser_create();

            // Disable XML tag capitalisation (Case Folding)
            xml_parser_set_option ($this->parser, XML_OPTION_CASE_FOLDING, FALSE);

            // Define Callback functions for XML Parsing
            xml_set_object($this->parser, &$this);
            xml_set_element_handler ($this->parser, "ElementStart", "ElementEnd");
            xml_set_character_data_handler ($this->parser, "charachterData");

            // Parse the XML response
            xml_parse($this->parser, $xmlResponse, TRUE);

            if( xml_get_error_code( $this->parser ) == XML_ERROR_NONE ) {
                // Get the result into local variables.
                $this->myResultTrxnTransTime = $this->xmlData['TransTime'];
                $this->myResultTrxnOrderID = $this->xmlData['OrderID'];
                $this->myResultTrxnApproved = $this->xmlData['Approved'];
                $this->myResultTrxnReturnCode = $this->xmlData['ReturnCode'];
                $this->myResultTrxnErrMsg = $this->xmlData['ErrMsg'];
                $this->myResultTrxnTaxTotal = $this->xmlData['TaxTotal'];
                $this->myResultTrxnShipTotal = $this->xmlData['ShipTotal'];
                $this->myResultTrxnSubTotal = $this->xmlData['SubTotal'];
                $this->myResultTrxnFullTotal = $this->xmlData['FullTotal'];
                $this->myResultTrxnPaymentType = $this->xmlData['PaymentType'];
                $this->myResultTrxnCardNumber = $this->xmlData['CardNumber'];
                $this->myResultTrxnCardExpMonth = $this->xmlData['CardExpMonth'];
                $this->myResultTrxnCardExpYear = $this->xmlData['CardExpYear'];
                $this->myResultTrxnTransRefNumber = $this->xmlData['TransRefNumber'];
                $this->myResultTrxnCardIDResult = $this->xmlData['CardIDResult'];
                $this->myResultTrxnAVSResult = $this->xmlData['AVSResult'];
                $this->myResultTrxnCardAuthNumber = $this->xmlData['CardAuthNumber'];
                $this->myResultTrxnCardRefNumber = $this->xmlData['CardRefNumber'];
                $this->myResultTrxnCardType = $this->xmlData['CardType'];
                $this->myResultTrxnIPResult = $this->xmlData['IPResult'];
                $this->myResultTrxnIPCountry = $this->xmlData['IPCountry'];
                $this->myResultTrxnIPRegion = $this->xmlData['IPRegion'];
                $this->myResultTrxnIPCity = $this->xmlData['IPCity'];
                $this->myError = 0;
                $this->myErrorMessage = '';
				
            } else {
                // An XML error occured. Return the error message and number.
                $this->myError = xml_get_error_code( $this->parser ) + PSIGATE_XML_ERROR_OFFSET;
                $this->myErrorMessage = xml_error_string( $myError );
            }
            // Clean up our XML parser
            xml_parser_free( $this->parser );
        } else {
            // A CURL Error occured. Return the error message and number. (offset so we can pick the error apart)
            $this->myError = curl_errno( $ch ) + PSIGATE_CURL_ERROR_OFFSET;
            $this->myErrorMessage = curl_error( $ch );
        }
        // Clean up CURL, and return any error.
        curl_close( $ch );

    /***********************************************************************
     *** Optional commented-out Debug.  Dont mess with it.               ***
     ***********************************************************************/

// echo $xmlRequest;
// echo $xmlResponse;
// exit();

        return $this->getError();
    }
}
?>
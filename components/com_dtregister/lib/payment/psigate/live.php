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

class Live {

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
	var $bywebservice = false;

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
		
		global $psi_storeid, $godaddy_hosting,$psitype,$psi_passphrase;
		if($mode == 'test'){
			$this->setGatewayURL('https://devcheckout.psigate.com/HTMLPost/HTMLMessenger'); 
		}else{
			$this->setGatewayURL('https://checkout.psigate.com/HTMLPost/HTMLMessenger');			
		}
	
		$this->setPaymentType('CC');
		$this->setCardAction('0'); // 1 for Authorize, 0 for Immediate Charge
		$this->setTaxTotal1('0'); // Tax value 1, ex Sales Tax
	    $this->setTaxTotal2('0'); // Tax value 2, ex VAT
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
        $this->mySubtotal = $Subtotal.".00";
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
    	$this->myShiptotal = $Shiptotal;
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

    function setCardIDNumber( $CardIDNumber ) {
        $this->myCardIDNumber = $CardIDNumber;
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

    function Live() {
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
	
    /***********************************************************************
     *** Business Logic                                                  ***
     ***********************************************************************/

	function doPayment() {
		global $psi_merchantId , $psi_merchantId, $Itemid , $psi_storeid;
        $mosConfig_live_site = JURI::root( false );
		$session_id = $this->session_id ;
		
		// pr($this->myGatewayURL); pr($psi_merchantId); exit;
		
		$this->myPaymentType = "CC";
		echo "<center><h3>".JText::_( 'DT_PSIGATE_REDIRECT_MSG')."</h3></center>\n";
		echo "<form method=\"post\" name=\"formRegister\" action=\"".$this->myGatewayURL."\">\n";

		echo "<input type=\"hidden\" name=\"StoreKey\" value=\"$psi_storeid\">";
		echo "<input type=\"hidden\" name=\"MerchantID\" value=\"$psi_merchantId\">";	
		echo "<input type=\"hidden\" name=\"PaymentType\" value=\"$this->myPaymentType\">";
	    echo "<input type=\"hidden\" name=\"TestResult\" value=\"A\">";
		
	    echo "<input type=\"hidden\" name=\"Tax1\" value=\"0\">";
		echo "<input type=\"hidden\" name=\"Tax2\" value=\"0\">";
	    echo "<input type=\"hidden\" name=\"Tax3\" value=\"0\">";
	    echo "<input type=\"hidden\" name=\"Tax4\" value=\"0\">";
	    echo "<input type=\"hidden\" name=\"Tax5\" value=\"0\">";
	   
	    echo "<input type=\"hidden\" name=\"ThanksURL\" value=\"{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore\" />";
		echo "<input type=\"hidden\" name=\"NoThanksURL\" value=\"{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=cancel\" />";

		echo "<input type=\"hidden\" name=\"ShippingTotal\" value=\"0\">";
		echo "<input type=\"hidden\" name=\"SubTotal\" value=\"$this->mySubtotal\">";
	
		echo "<input type=\"hidden\" name=\"CustomerIP\" value=\"".$this->getVisitorIP()."\">";
		
		echo "<input type=\"hidden\" name=\"CardAction\" value=\"0\">";
		echo "<input type=\"hidden\" name=\"CardNumber\" value=\"$this->myCardNumber\">";
		echo "<input type=\"hidden\" name=\"CardExpMonth\" value=\"$this->myCardExpMonth\">";
		echo "<input type=\"hidden\" name=\"CardExpYear\" value=\"$this->myCardExpYear\">";
		echo "<input type=\"hidden\" name=\"CardIDCode\" value=\"$this->myCardIDCode\">";
		echo "<input type=\"hidden\" name=\"CardIDNumber\" value=\"$this->myCardIDNumber\">";
		echo "<input type=\"hidden\" name=\"CardXID\" value=\"$this->myCardXID\">";
		echo "<input type=\"hidden\" name=\"CardCavv\" value=\"$this->myCardCavv\">";
		echo "<input type=\"hidden\" name=\"CardECI\" value=\"$this->myCardECI\">";
		
		echo "</form>\n";
		?>
        
        <!--<FORM name="formRegister" ACTION='https://devcheckout.psigate.com/HTMLPost/HTMLMessenger' METHOD="post">
        <INPUT TYPE=TEXT NAME="StoreKey" VALUE="merchantcardcapture200024">StoreKey<BR>
        <INPUT TYPE=TEXT NAME="CustomerRefNo" VALUE="123456789">CustomerRefNo<BR>
        <INPUT TYPE=TEXT NAME="Bname" VALUE="John Smith">Bname<BR>
        <INPUT TYPE=TEXT NAME="Bcompany" VALUE="PSiGate">Bcompany<BR>
        <INPUT TYPE=TEXT NAME="Baddress1" VALUE="123 Main St.">Baddress1<BR>
        <INPUT TYPE=TEXT NAME="Baddress2" VALUE="Apt 6">Baddress2<BR>
        <INPUT TYPE=TEXT NAME="Bcity" VALUE="Toronto">Bcity<BR>
        <INPUT TYPE=TEXT NAME="Bprovince" VALUE="ON">Bprovince<BR>
        <INPUT TYPE=TEXT NAME="Bpostalcode" VALUE="L5N2B3">Bpostalcode<BR>
        <INPUT TYPE=TEXT NAME="Bcountry" VALUE="CA">Bcountry<BR>
        <INPUT TYPE=TEXT NAME="Phone" VALUE="416-555-2092">Phone<BR>
        <INPUT TYPE=TEXT NAME="Fax" VALUE="416-555-2091">Fax<BR>
        <INPUT TYPE=TEXT NAME="Email" VALUE="someone@somewhere.com">Email<BR>
        <INPUT TYPE=TEXT NAME="Comments" VALUE="No comments today">Comments<BR>
        <INPUT TYPE=TEXT NAME="Tax1" VALUE="1.00">Tax1<BR>
        <INPUT TYPE=TEXT NAME="ShippingTotal" VALUE="6.00">ShippingTotal<BR>
        <INPUT TYPE=TEXT NAME="SubTotal" VALUE="8.00">SubTotal<BR>
        <INPUT TYPE=TEXT NAME="PaymentType" VALUE="CC">PaymentType<BR>
        <INPUT TYPE=TEXT NAME="CardAction" VALUE="0">CardAction<BR>
        <INPUT TYPE=TEXT NAME="CardNumber" VALUE="4111111111111111">CardNumber<BR>
        <INPUT TYPE=TEXT NAME="CardExpMonth" VALUE="12">CardExpMonth<BR>
        <INPUT TYPE=TEXT NAME="CardExpYear" VALUE="13">CardExpYear<BR>
        <INPUT TYPE=TEXT NAME="CardIDNumber" VALUE="">CardIDNumber<BR>
        <INPUT TYPE=SUBMIT VALUE="Buy Now">
        </FORM>-->
        
        <script language="javascript">
			function rg_direc_to_psigate(){
				document.formRegister.submit();
			}
			setTimeout("rg_direc_to_psigate()",5000);
		</script>
        
        <!--
<FORM ACTION='https://devcheckout.psigate.com/HTMLPost/HTMLMessenger' METHOD=post><TABLE>
<INPUT TYPE=TEXT NAME="MerchantID" VALUE="psigatecapturescard001010">MerchantID<BR>

<INPUT TYPE=TEXT NAME="PaymentType" VALUE="CC">PaymentType<BR>
<INPUT TYPE=TEXT NAME="TestResult" VALUE="A">TestResult<BR>

<INPUT TYPE=TEXT NAME="Tax1" VALUE="0">Tax1<BR>
<INPUT TYPE=TEXT NAME="Tax2" VALUE="0">Tax2<BR>
<INPUT TYPE=TEXT NAME="Tax3" VALUE="0">Tax3<BR>
<INPUT TYPE=TEXT NAME="Tax4" VALUE="0">Tax4<BR>
<INPUT TYPE=TEXT NAME="Tax5" VALUE="0">Tax5<BR>
<INPUT TYPE=TEXT NAME="ShippingTotal" VALUE="0">ShippingTotal<BR>
<INPUT TYPE=TEXT NAME="SubTotal" VALUE="<?php //echo  $this->mySubtotal; ?>">SubTotal<BR>
<INPUT TYPE=TEXT NAME="CardAction" VALUE="0">CardAction<BR>

<INPUT TYPE=SUBMIT VALUE="Buy Now">
</FORM>
<INPUT TYPE=TEXT NAME="CustomerRefNo" VALUE="123456789">CustomerRefNo<BR>
<INPUT TYPE=TEXT NAME="OrderID" VALUE="">OrderID<BR>
<INPUT TYPE=TEXT NAME="UserID" VALUE="User1">UserID<BR>
<INPUT TYPE=TEXT NAME="Bname" VALUE="John Smith">Bname<BR>
<INPUT TYPE=TEXT NAME="Bcompany" VALUE="PSiGate">Bcompany<BR>
<INPUT TYPE=TEXT NAME="Baddress1" VALUE="123 Main St.">Baddress1<BR>
<INPUT TYPE=TEXT NAME="Baddress2" VALUE="Apt 6">Baddress2<BR>
<INPUT TYPE=TEXT NAME="Bcity" VALUE="Toronto">Bcity<BR>
<INPUT TYPE=TEXT NAME="Bprovince" VALUE="Ontario">Bprovince<BR>
<INPUT TYPE=TEXT NAME="Bpostalcode" VALUE="L5N2B3">Bpostalcode<BR>
<INPUT TYPE=TEXT NAME="Bcountry" VALUE="Canada">Bcountry<BR>

<INPUT TYPE=TEXT NAME="Phone" VALUE="416-555-2092">Phone<BR>
<INPUT TYPE=TEXT NAME="Fax" VALUE="416-555-2091">Fax<BR>
<INPUT TYPE=TEXT NAME="Email" VALUE="charles.zhu@psigate.com">Email<BR>
<INPUT TYPE=TEXT NAME="Comments" VALUE="No comments today">Comments<BR>-->
			            
		<?php
       
	}
	
}
?>
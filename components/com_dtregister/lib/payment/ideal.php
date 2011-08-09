<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/*-----------------------------------------------------------------------
  Start              : 24 februari 2009
  Door               : Mollie B.V. (RDF) © 2009
  Versie             : 1.07 (gebaseerd op de Mollie iDEAL class van
                       Concepto IT Solution - http://www.concepto.nl/)
  Laatste aanpassing : 19 november 2009
  Aard v. aanpassing : Gebruik standaard een SSL verbinding naar Mollie toe
  Door               : MK
  -----------------------------------------------------------------------*/

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class ideal extends Payment{

	const     MIN_TRANS_AMOUNT = 118;

	protected $partner_id      = null;

	protected $testmode        = false;

	protected $bank_id         = null;

	protected $amount          = 0;

	public $description        = null;

	protected $return_url      = null;

	protected $report_url      = null;

	protected $bank_url        = null;

	protected $transaction_id  = null;

	protected $paid_status     = false;

	protected $consumer_info   = array();

	protected $error_message   = '';

	protected $error_code      = 0;

	protected $api_host = 'ssl://secure.mollie.nl';

	protected $api_port = 443;

	var $bywebservice = false;

	public function __construct ()

	{

		global $partner_id,$api_host,$api_port; 

		parent::__construct();

		$this->partner_id = $partner_id;

		$this->api_host = 'ssl://secure.mollie.nl';

		$this->api_port = 443;

		$this->setTestmode(($this->paymentmode=='test'));

	}

	function billingform(){

	    $bank_array = $this->getBanks();

		ob_start();

		?>

		<tr>

      <td><?php echo JText::_( 'DT_BANK' );?></td>

      <td><select name="billing[bank_id]" id="bank_id">

        <option value=''><?php echo JText::_( 'DT_SELECT_BANK' );?></option>

        <?php foreach ($bank_array as $bank_id => $bank_name) { ?>

        <option value="<?php echo  $bank_id ?>"><?php echo  $bank_name ?></option>

        <?php } ?>

        </select>

      </td>

 </tr>

        <?php

	    return ob_get_clean();

	}

	// Haal de lijst van beschikbare banken

	public function getBanks()

	{

		$banks_xml = $this->_sendRequest($this->api_host, $this->api_port, '/xml/ideal/', 'a=banklist' . (($this->testmode) ? '&testmode=true' : ''));

		if (empty($banks_xml))

			return false;

		$banks_object = $this->_XMLtoObject($banks_xml);

		if (!$banks_object || $this->_XMlisError($banks_object))

			return false;

		$banks_array = array();

		foreach ($banks_object->bank as $bank) {

			$banks_array["{$bank->bank_id}"] = "{$bank->bank_name}";

		}

		return $banks_array;

	}

	// Zet een betaling klaar bij de bank en maak de betalings URL beschikbaar

	public function createPayment ($bank_id, $amount, $description="test", $return_url, $report_url)

	{

		if (!$this->setBankId($bank_id) or

			!$this->setDescription($description) or

			!$this->setAmount($amount) or

			!$this->setReturnUrl($return_url) or

			!$this->setReportUrl($report_url))

		{

			$this->error_message = "De opgegeven betalings gegevens zijn onjuist of incompleet.";

			return false;

		}

		$create_xml = $this->_sendRequest(

						$this->api_host,

						$this->api_port,

						'/xml/ideal/',

						'a=fetch' .

				 	  	 '&partnerid=' .   urlencode($this->getPartnerId()) .

						 '&bank_id=' .     urlencode($this->getBankId()) .

						 '&amount=' .      urlencode($this->getAmount()) .

						 '&reporturl=' .   urlencode($this->getReportURL()) .

						 '&description=' . urlencode($this->getDescription()) .

						 '&returnurl=' .   urlencode($this->getReturnURL()));

		if (empty($create_xml))

			return false;

		$create_object = $this->_XMLtoObject($create_xml);

		if (!$create_object || $this->_XMLisError($create_object))

			return false;

		$this->transaction_id = $create_object->order->transaction_id;
     //   DT_Session::set('register.payment.transactionId', $this->transaction_id);
		$this->bank_url = $create_object->order->URL;

		return true;

	}

	function success() {	
		$id = JRequest::getVar('transaction_id', 0);
		$this->checkPayment($id) ;
		if(!$this->paid_status ){
		   return false ;
		}
		if($id) {
			$this->transactionId = JRequest::getVar('transaction_id');
   			DT_Session::set('register.payment.transactionId', $this->transactionId);
   			$database = &JFactory::getDBO();
	        $data = $_SESSION;
	        $sql = "update #__dtregister_session set `data`= ".$database->Quote(serialize($data))." where id=".$id;
	        $database->setQuery($sql);
	        $database->query();
		    
			$database->getErrorMsg();
			
   			return true;	
		}else {
			return false;
		}	
		
	}

	function process(){

	    global $mainframe,$Itemid;

		$mosConfig_live_site = JURI::root( false );
		
		$session_id = $this->saveSession();
		
		$return_url = "{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore";

		$report_url = "{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=cancel";

	   $data = $this->createPayment($this->bank_id, ($this->cart->getAmount()*100), $this->description, $return_url, $report_url);

	   if(!$data){

		  return $data;   

	   }

	   $mainframe->redirect( $this->getBankURL());

	}

	public function checkPayment ($transaction_id) 

	{

		if (!$this->setTransactionId($transaction_id)) {

			$this->error_message = "Er is een onjuist transactie ID opgegeven";

			return false;

		}

		$check_xml = $this->_sendRequest(

			$this->api_host,

			$this->api_port,

			'/xml/ideal/',

			'a=check' .

			  '&partnerid=' . urlencode($this->getPartnerId()) .

			  '&transaction_id=' . urlencode($this->getTransactionId()) .

			  (($this->testmode) ? '&testmode=true' : '')

		);

		if (empty($check_xml))

			return false;

		$check_object = $this->_XMLtoObject($check_xml);

		if (!$check_object || $this->_XMLisError($check_object))

			return false;

		$this->paid_status   = ($check_object->order->payed == 'true');

		$this->amount        = $check_object->order->amount;

		$this->consumer_info = (isset($check_object->order->consumer)) ? (array) $check_object->order->consumer : array();

		return true;

	}

/*

	PROTECTED FUNCTIONS

*/

	protected function _sendRequest ($host, $port, $path, $data) 

	{

		$hostname = str_replace('ssl://', '', $host);

		$fp = @fsockopen($host, $port, $errno, $errstr);

		$buf = '';

		if (!$fp) 

		{

			$this->error_message = 'Kon geen verbinding maken met server: ' . $errstr;

			$this->error_code    = 0; 

			return false;

		}

		@fputs($fp, "POST $path HTTP/1.0\n");

		@fputs($fp, "Host: $hostname\n");

		@fputs($fp, "Content-type: application/x-www-form-urlencoded\n");

		@fputs($fp, "Content-length: " . strlen($data) . "\n");

		@fputs($fp, "Connection: close\n\n");

		@fputs($fp, $data); 

		while (!feof($fp)) {

			$buf .= fgets($fp, 128);

		}

		fclose($fp);

		if (empty($buf))

		{	

			$this->error_message = 'Zero-sized reply';

			return false;

		} else

			list($headers, $body) = preg_split("/(\r?\n){2}/", $buf, 2);

		return $body;

	}

	protected function _XMLtoObject ($xml) 

	{

		try 

		{

			$xml_object = new SimpleXMLElement($xml);

			if ($xml_object == false) {

				$this->error_message = "Kon XML resultaat niet verwerken";

				return false;

			}

		}

		catch (Exception $e) 

		{

			return false;

		}

		return $xml_object;

	}

	protected function _XMLisError($xml)

	{

		if (isset($xml->item))

		{

			$attributes = $xml->item->attributes();

			if ($attributes['type'] == 'error')

			{

				$this->error_message = (string) $xml->item->message;

				$this->error_code    = (string) $xml->item->errorcode;

				return true;

			}

		}

		return false;

	}

	/* Getters en setters */

	public function setPartnerId ($partner_id) 

	{

		if (!is_numeric($partner_id))

			return false;

		return ($this->partner_id = $partner_id);

	}

	public function getPartnerId () {

		return $this->partner_id;

	}

	public function setTestmode ($enable = true) 

	{
        
		return ($this->testmode = $enable);

	}

	public function setBankId ($bank_id) 

	{

		if (!is_numeric($bank_id))

			return false;

		return ($this->bank_id = $bank_id);

	}

	public function getBankId () 

	{

		return $this->bank_id;

	}

	public function setAmount ($amount) 

	{

		if (!preg_match('~^[0-9]+$~', $amount))

			return false;

		if (self::MIN_TRANS_AMOUNT > $amount)

			return false;

		return ($this->amount = $amount);

	}

	public function getAmount () 

	{

		return $this->amount;

	}

	public function setDescription ($description) 

	{

		$description = substr($description, 0, 29);

		return ($this->description = $description);

	}

	public function getDescription () 

	{

		return $this->description;

	}

	public function setReturnURL ($return_url) 

	{

		if (!preg_match('|(\w+)://([^/:]+)(:\d+)?(.*)|', $return_url))

			return false;

		return ($this->return_url = $return_url);

	}

	public function getReturnURL () 

	{

		return $this->return_url;

	}

	public function setReportURL ($report_url) 

	{

		if (!preg_match('|(\w+)://([^/:]+)(:\d+)?(.*)|', $report_url))

			return false;

		return ($this->report_url = $report_url);

	}

	public function getReportURL () 

	{

		return $this->report_url;

	}

	public function setTransactionId ($transaction_id) 

	{

		if (empty($transaction_id))

			return false;

		return ($this->transaction_id = $transaction_id);

	}

	public function getTransactionId () 

	{

		return $this->transaction_id;

	}

	public function getBankURL () 

	{

		return $this->bank_url;

	}

	public function getPaidStatus () 

	{

		return $this->paid_status;

	}

	public function getConsumerInfo () 

	{

		return $this->consumer_info;

	}

	public function getErrorMessage()

	{

		return $this->error_message;

	}

	public function getErrorCode()

	{

		return $this->error_code;

	}

}
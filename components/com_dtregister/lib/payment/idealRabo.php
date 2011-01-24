<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $idealLiteHashKey, $idealLiteMerchantId;

	define('IDEAL_AQUIRER', 'Rabobank'); // Use Rabobank, ING Bank or Simulator

	define('IDEAL_HASH_KEY', $idealLiteHashKey);

	define('IDEAL_MERCHANT_ID', $idealLiteMerchantId);

	define('IDEAL_SUB_ID', '0');

	

	define('IDEAL_URL_CANCEL', '');

	define('IDEAL_URL_ERROR', '');

	define('IDEAL_URL_SUCCESS', '');

    require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

	class idealRabo extends Payment{

		// Default settings

		public $sCurrency = 'EUR'; // Ideal only support payments in EURO.

		protected $sLanguageCode = 'nl'; // NL

		protected $sPaymentType = 'ideal';

		// Account settings

		protected $sMerchantId = '';

		protected $sSubId = 0;

		protected $sHashKey = '';

		protected $sAquirerName = '';

		protected $sAquirerUrl = '';

		// Order settings

		protected $fOrderAmount = 0.00;

		protected $sOrderId = '';

		protected $sOrderDescription = '';

		protected $sUrlCancel = '';

		protected $sUrlError = '';

		protected $sUrlSuccess = '';

		// Form settings

		protected $sButtonLabel = 'Betalen met iDEAL';

		protected $sButtonImage = false;

		protected $iButtonImageWidth = 0;

		protected $iButtonImageHeight = 0;

		var $bywebservice = false;

		public function __construct()

		{

			parent::__construct();

			if(defined('IDEAL_HASH_KEY'))

			{

				$this->setHashKey(IDEAL_HASH_KEY);

			}

			elseif(defined('IDEAL_PRIVATE_KEY'))

			{

				$this->setHashKey(IDEAL_PRIVATE_KEY);

			}

			if(defined('IDEAL_AQUIRER'))

			{

				if($this->paymentmode == 'test')

				{
                    
					$this->setAquirer(IDEAL_AQUIRER, IDEAL_TEST_MODE);

				}

				else

				{

					$this->setAquirer(IDEAL_AQUIRER);

				}

			}

			if(defined('IDEAL_MERCHANT_ID'))

			{

				if(defined('IDEAL_SUB_ID'))

				{

					$this->setMerchant(IDEAL_MERCHANT_ID, IDEAL_SUB_ID);

				}

				else

				{

					$this->setMerchant(IDEAL_MERCHANT_ID);

				}

			}

			if(defined('IDEAL_URL_CANCEL'))

			{

				$this->setUrlCancel(IDEAL_URL_CANCEL);

			}

			if(defined('IDEAL_URL_ERROR'))

			{

				$this->setUrlError(IDEAL_URL_ERROR);

			}

			if(defined('IDEAL_URL_SUCCESS'))

			{

				$this->setUrlSuccess(IDEAL_URL_SUCCESS);

			}

		}

		// Set amount in EURO, use a float or integer 

		public function setAmount($fOrderAmount)

		{

			$this->fOrderAmount = $fOrderAmount;

		}

		// Your secret hash key to secure form data (should match your Ideal Dashboard)

		public function setHashKey($sHashKey)

		{

			$this->sHashKey = $sHashKey;

		}

		// Your merchantID and subID

		public function setMerchant($sMerchantId, $sSubId = '0')

		{

			$this->sMerchantId = $sMerchantId;

			$this->sSubId = $sSubId;

		}

		// Upto 32 characters

		public function setOrderDescription($sOrderDescription)

		{

			$this->sOrderDescription = substr($sOrderDescription, 0, 32);

		}


		// Upto 16 characters, should be a unique reference to your order

		public function setOrderId($sOrderId)

		{

			$this->sOrderId = substr($sOrderId, 0, 16);

		}

		// Set aquirer (Use: Rabobank, ING Bank or ABN Amro)

		public function setAquirer($sAquirerName, $bTestMode = false)

		{

			$this->sAquirerName = $sAquirerName;

			if(stripos($sAquirerName, 'rabo') !== false) // Rabobank

			{

				$this->sUrlAquirer = 'https://ideal' . ($bTestMode ? 'test' : '') . '.rabobank.nl/ideal/mpiPayInitRabo.do';

			}

			elseif(stripos($sAquirerName, 'ing') !== false) // ING Bank

			{

				$this->sUrlAquirer = 'https://ideal' . ($bTestMode ? 'test' : '') . '.secure-ing.com/ideal/mpiPayInitIng.do';

			}

			elseif(stripos($sAquirerName, 'sim') !== false) // IDEAL SIMULATOR

			{

				$this->sUrlAquirer = 'https://www.ideal-simulator.nl/lite/';

			}

			else // Unknown aquirer

			{

				$this->setError('Unknown aquirer. Please use Rabobank, ING Bank or Simulator.', false, __FILE__, __LINE__);

				return false;

			}

		}

		// Set URL for TRANSACTION_CANCEL

		public function setUrlCancel($sUrl)

		{

			$this->sUrlCancel = $sUrl;

		}

		// Set URL for TRANSACTION_ERROR

		public function setUrlError($sUrl)

		{

			$this->sUrlError = $sUrl;

		}

		// Set URL for TRANSACTION_SUCCESS

		public function setUrlSuccess($sUrl)

		{

			$this->sUrlSuccess = $sUrl;

		}

		// Set submit button label, or define an image as submit-button

		public function setButton($sLabel, $sImage = false, $iWidth = 0, $iHeight = 0)

		{

			$this->sButtonLabel = $sLabel;

			$this->sButtonImage = $sImage;

			$this->iButtonImageWidth = $iWidth;

			$this->iButtonImageHeight = $iHeight;

		}

		function process(){

		     global $currency_code , $Itemid;

			 $this->sCurrency = $currency_code ;
               $mosConfig_live_site = JURI::root( false );
			 $urlSuccess = "{$mosConfig_live_site}index.php?option=com_dtregister&task=success&controller=payment&Itemid=$Itemid";

		$urlCancel = "{$mosConfig_live_site}index.php?option=com_dtregister&task=cancel&controller=payment&Itemid=$Itemid" ;

		$urlError = "{$mosConfig_live_site}index.php?option=com_dtregister&task=error&controller=payment&Itemid=$Itemid" ;

			 $this->setUrlCancel($urlCancel);

	         $this->setUrlSuccess($urlSuccess);

	         $this->setUrlError($urlError);

			 $this->setAmount($this->cart->getAmount());

	         $this->setOrderId($this->confirmNum);

	         $this->setOrderDescription($this->description);

			echo $this->createForm();

		}

		// Generate iDEAL Lite form

		public function createForm()

		{

			$iAmount = round($this->fOrderAmount * 100);

			$sValidUntil = date('Y-m-d\TG:i:s\Z', strtotime('+1 hour'));

			// Setup hash string

			$sHashString = $this->sHashKey . $this->sMerchantId . $this->sSubId 

			. $iAmount . $this->sOrderId . $this->sPaymentType . $sValidUntil 

			. '1' . $this->sOrderDescription . '1' . $iAmount;

			// Remove HTML Entities

			$sHashString = html_entity_decode($sHashString);

			// Remove space characters: "\t", "\n", "\r" and " "

			$sHashString = str_replace(array("\t", "\n", "\r", " "), '', $sHashString);

			// Generate hash

			$sHash = sha1($sHashString);

			// Generate HTML form

			$html = "<center><h3>".JText::_( 'DT_IDEAL_REDIRECT_MSG')."</h3></center>\n";

			$html .= '<form action="' . $this->escapeHtml($this->sUrlAquirer) . '" id="ideal_form" method="post" name="ideal_form">'

			. '<input type="hidden" name="merchantID" value="' . $this->sMerchantId . '">'

			. '<input type="hidden" name="subID" value="' . $this->sSubId . '">'

			. '<input type="hidden" name="amount" value="' . $iAmount . '" >'

			. '<input type="hidden" name="purchaseID" value="' . $this->escapeHtml($this->sOrderId) . '">'

			. '<input type="hidden" name="language" value="' . $this->escapeHtml($this->sLanguageCode) . '">' // NL

			. '<input type="hidden" name="currency" value="' . $this->escapeHtml($this->sCurrency) . '">'

			. '<input type="hidden" name="description" value="' . $this->escapeHtml($this->sOrderDescription) . '">'

			. '<input type="hidden" name="hash" value="' . $sHash . '">'

			. '<input type="hidden" name="paymentType" value="' . $this->escapeHtml($this->sPaymentType) . '">'

			. '<input type="hidden" name="validUntil" value="' . $sValidUntil . '">'

			. '<input type="hidden" name="itemNumber1" value="1">'

			. '<input type="hidden" name="itemDescription1" value="' . $this->escapeHtml($this->sOrderDescription) . '">'

			. '<input type="hidden" name="itemQuantity1" value="1">'

			. '<input type="hidden" name="itemPrice1" value="' . $iAmount . '">'

			. ($this->sUrlCancel ? '<input type="hidden" name="urlCancel" value="' . $this->escapeHtml($this->sUrlCancel) . '">' : '')

			. ($this->sUrlSuccess ? '<input type="hidden" name="urlSuccess" value="' . $this->escapeHtml($this->sUrlSuccess) . '">' : '')

			. ($this->sUrlError ? '<input type="hidden" name="urlError" value="' . $this->escapeHtml($this->sUrlError) . '">' : '')

			. '</form>';  

			$html .= ' <script language="javascript">

			function rg_direc_to_ideal(){

				document.ideal_form.submit();

			}

			setTimeout("rg_direc_to_ideal()",5000);

		</script>';

			return $html;

		}

		protected function escapeHtml($string)

		{

			return str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);

		}

	}

?>
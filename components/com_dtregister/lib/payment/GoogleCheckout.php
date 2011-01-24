<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class GoogleCheckout extends Payment

{
    // {{{ properties

    /**
     * Merchant ID
     *
     * @access protected
     * @var string
     */

    var $_merchantId = '';

    /**
     * Server type - 'sandbox' or 'checkout'
     *
     * @access protected
     * @var string
     */

    var $_serverType = 'sandbox';

    /**
     * Currency
     *
     * @access protected
     * @var string
     */

    var $_currency = 'USD';

    /**
     * Shopping cart items
     *
     * @access protected
     * @var array
     */

    var $_items = array();

    /**
     * Shipping methods
     *
     * @access protected
     * @var array
     */

    var $_shipMethods = array();

    /**
     * Tax rate and US state
     *
     * @access protected
     * @var array
     */

    var $_taxRate = array();

	var $fields = array();

	var $return_url =  array('registeration'=>'googleReturn','duepay'=>'gdueReturn','change'=>'gchgReturn','cancel'=>'gcancelReturn');

	var $bywebservice = false;

    // }}}

    /// {{{ GoogleCheckoutButton()

    /**
     * Class constructor
     *
     * @access public
     * @param string $merchantId Merchant ID.
     * @param string $serverType Server type - 'sandbox' or 'checkout'.
     * @param string $currency Currency.
     * @return object
     */

    function GoogleCheckout()

    {

	    global $googlemerchid, $googlemode ,$currency_code,$googleapikey; 

		parent::__construct();

        $this->_merchantId = $googlemerchid;
        $this->merchant_id = $this->_merchantId;
		$this->merchant_key = $googleapikey;

        $this->_serverType = ($this->paymentmode !='test') ? 'checkout' : 'sandbox';

		 if ($this->_serverType == 'sandbox') {

           $this->server_url = "https://sandbox.google.com/checkout/";

        } else {

            $this->server_url=  "https://checkout.google.com/";

        }

        $this->_currency = $currency_code;

		$this->schema_url = "http://checkout.google.com/schema/2";

       $this->base_url = $this->server_url . "api/checkout/v2/"; 

       $this->checkout_url = $this->base_url . "checkout/Merchant/" . $this->_merchantId;

       $this->checkoutForm_url = $this->base_url . "checkoutForm/Merchant/" . $this->_merchantId;

    }

	function tryAgain(){	

	}

	function GetXML() {

		require_once( JPATH_SITE.'/components/com_dtregister/lib/payment/gcheckout/gc_xmlbuilder.php');		

	    $xml_data = new gc_XmlBuilder();

		$xml_data->Push('checkout-shopping-cart',

          array('xmlns' => $this->schema_url));

          $xml_data->Push('shopping-cart');

		    $xml_data->Push('items');

			foreach($this->_items as $item){

				$xml_data->Push('item');

				$xml_data->Element('item-name', $item['name']);

				$xml_data->Element('item-description', $item['description']);

				$xml_data->Element('unit-price', $item['price'],

					array('currency' => $this->_currency));

				$xml_data->Element('quantity', $item['quantity']);		

				$xml_data->Pop('item');

			}

			$xml_data->Pop('items');

		  $xml_data->Element('merchant-private-data',$this->private_data);

		  $xml_data->Pop('shopping-cart');

		  $xml_data->Push('checkout-flow-support');

		  $xml_data->Push('merchant-checkout-flow-support');

		  $xml_data->Element('continue-shopping-url',$this->continue_url);

		  $xml_data->Pop('merchant-checkout-flow-support');

          $xml_data->Pop('checkout-flow-support');

         $xml_data->Pop('checkout-shopping-cart');	 		  

		return $xml_data->GetXML(); 

	}


    // }}}

    /// {{{ addItem()

    /**
     * Add a shopping cart item
     *
     * @access public
     * @param string $name Item name.
     * @param string $description Item description.
     * @param int $quantity Item quantity.
     * @param float $price Item unit price.
     * @return void
     */

    function addItem($name, $description, $quantity, $price)

    {

        $this->_items[] = array(

            'name' => $name,

            'description' => $description,

            'quantity' => abs(intval($quantity)),

            'price' => floatval($price)

        );

    }

    // }}}

    /// {{{ addDiscount()

    /**
     * Add a discount amount
     *
     * @access public
     * @param string $name Discount item name.
     * @param string $description Discount item description.
     * @param float $amount Discount amount.
     * @return void
     */

    function addDiscount($name, $description, $amount)

    {

        if ($amount > 0) {

            $amount = 0 - $amount;

        }

        $this->_items[] = array(

            'name' => $name,

            'description' => $description,

            'quantity' => 1,

            'price' => floatval($amount)

        );

    }

    // }}}

    /// {{{ addShippingMethod()

    /**
     * Add a shipping method
     *
     * @access public
     * @param string $name Name of shipping method.
     * @param float $price Shipping price.
     * @param string $area Region of the United States where items may be shipped:
     *                     'CONTINENTAL_48' - All U.S. states except Alaska and Hawaii,
     *                     'FULL_50_STATES' - All U.S. states,
     *                     'ALL' - All U.S. postal service addresses.
     *
     * @return void
     */

    function addShippingMethod($name, $price, $area = '')

    {

        $this->_shipMethods[] = array(

            'name' => $name,

            'price' => abs(floatval($price)),

            'area' => $area

        );

    }

    // }}}

    /// {{{ setTaxRate()

    /**
     * Define a tax rate for specific US state
     *
     * @access public
     * @param float $taxRate Tax rate.
     * @param string $taxState US state where particular tax rule is applied.
     * @return void
     */

    function setTaxRate($taxRate, $taxState)

    {

        $this->_taxRate = array(

            'rate' => $taxRate,

            'state' => $taxState

        );

    }

    // }}}

    /// {{{ showButton()

    /**
     * Display the button
     *
     * @access public
     * @param string $type The type of button - 'large', 'medium' or 'small'.
     * @param string $style The button style - 'white' or 'trans'.
     * @param bool $disabled Button state.
     * @param bool $asString Return form as a string if true.
     * @return string
     */

    function drawform($options=array(),$type = 'large', $style = 'white', $disabled = false, $asString = false)

    {

	     switch ($type) {

        case 'small':

            $w = 160;

            $h = 43;

            break;

        case 'medium':

            $w = 168;

            $h = 44;

            break;

        default:

            $w = 180;

            $h = 46;

        }

		$variant = ($disabled ? 'disabled' : 'text');

		$data  = "<br /><center><h3>".JText::_('DT_GOOGLECHECKOUT_REDIRECT_MSG')."</h3></center>" ;

		$data .= "<form method=\"POST\" action=\"". 

                $this->checkout_url . "\" name =\"formRegister\" >

                <input type=\"hidden\" name=\"cart\" value=\"". 

                base64_encode($this->GetXML()) ."\">

                <input type=\"hidden\" name=\"signature\" value=\"". 

                base64_encode($this->CalcHmacSha1($this->GetXML())). "\"> 

                <input style='display:none' type=\"image\" name=\"Checkout\" alt=\"Checkout\" 

                src=\"". $this->server_url."buttons/checkout.gif?merchant_id=" .

                $this->merchant_id."&w=".$w. "&h=".$h."&style=".

                $style."&variant=".$variant."&loc=en_US\" 

                height=\"".$h."\" width=\"".$w. "\" /></form>" ;

		$data .= '<script language="javascript">

			function rg_direc_to_paypal(){

				document.formRegister.submit();

			}

			setTimeout("rg_direc_to_paypal()",5000);

		</script>';

		return $data;

        if ($this->_serverType == 'sandbox') {

            $submitUrl = 'https://sandbox.google.com/checkout/cws/v2/Merchant/' . $this->_merchantId . '/checkoutForm';

            $buttonUrl = 'http://sandbox.google.com/checkout/buttons/checkout.gif';

        } else {

            $submitUrl = 'https://checkout.google.com/cws/v2/Merchant/' . $this->_merchantId . '/checkoutForm';

            $buttonUrl = 'http://checkout.google.com/buttons/checkout.gif';

        }

       

        $formHtml = '<form method="post" action="' . $submitUrl . '" accept-charset="utf-8">' . "\n";

        foreach ($this->_items as $i => $item) {

            $formHtml .= '<input type="hidden" name="item_name_' . $i . '" value="' . $item['name'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="item_description_' . $i . '" value="' . $item['description'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="item_quantity_' . $i . '" value="' . $item['quantity'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="item_price_' . $i . '" value="' . $item['price'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="item_currency_' . $i . '" value="' . $this->_currency . '" />' . "\n";

        }

        foreach ($this->_shipMethods as $i => $shipMethod) {

            $formHtml .= '<input type="hidden" name="ship_method_name_' . $i . '" value="' . $shipMethod['name'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="ship_method_price_' . $i . '" value="' . $shipMethod['price'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="ship_method_currency_' . $i . '" value="' . $this->_currency . '" />' . "\n";

            if (!empty($shippingMethod['area'])) {

                $formHtml .= '<input type="hidden" name="ship_method_us_area_' . $i . '" value="' . $shipMethod['area'] . '" />' . "\n";

            }

        }

        if ($this->_taxRate['rate'] > 0 && !empty($this->_taxRate['state'])) {

            $formHtml .= '<input type="hidden" name="tax_rate" value="' . $this->_taxRate['rate'] . '" />' . "\n";

            $formHtml .= '<input type="hidden" name="tax_us_state" value="' . $this->_taxRate['state'] . '" />' . "\n";

        }

		foreach ($this->fields as $name => $value) {



         $formHtml .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';



      }

        $formHtml .= '<input type="hidden" name="_charset_" />' . "\n";

        $formHtml .= '<input type="image" name="Google Checkout" alt="Fast checkout through Google"';

        $formHtml .= ' src="' . $buttonUrl . '?merchant_id=' . $this->_merchantId;

        $formHtml .= '&w=' . $w . '&h=' . $h . '&style=' . $style . '&variant=' . $variant . '&loc=en_US"';

        $formHtml .= ' style="width: ' . $w . '; height: ' . $h . '" />' . "\n";

        $formHtml .= '</form>';

        if (!$asString) {

          //  echo $formHtml;

        }

        return $formHtml;

    }

	 function add_field($field, $value) {

      $this->fields["$field"] = $value;

    }

	function setformData(){

		$this->addItem($this->description,JText::_( 'DT_REGISTRATION'),1,$this->amount);

		$this->add_field('continue_url', $this->continue_url);

		$this->add_field('shopping-cart.items.item-0.merchant-private-item-data',$this->private_data);

	}

	function setBillinginfo($info){

	}

	function CalcHmacSha1($data) {

      $key = $this->merchant_key;

      $blocksize = 64;

      $hashfunc = 'sha1';

      if (strlen($key) > $blocksize) {

        $key = pack('H*', $hashfunc($key));

      }

      $key = str_pad($key, $blocksize, chr(0x00));

      $ipad = str_repeat(chr(0x36), $blocksize);

      $opad = str_repeat(chr(0x5c), $blocksize);

      $hmac = pack(

                    'H*', $hashfunc(

                            ($key^$opad).pack(

                                    'H*', $hashfunc(

                                            ($key^$ipad).$data

                                    )

                            )

                    )

                );

      return $hmac; 

    }

	function process(){

		global $Itemid;

	   	$session_id = $this->saveSession();

		$this->private_data = 'user|session='.$session_id;

		$mosConfig_live_site = JURI::root( false );

		$this->continue_url = JURI::root( false )."components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore";

		$this->addItem($this->description,JText::_( 'DT_REGISTRATION'),1,$this->cart->getAmount());

		$this->add_field('continue_url', $this->continue_url);

		$this->add_field('shopping-cart.items.item-0.merchant-private-item-data',$this->private_data);

		echo  $this->drawform();

	}

	function beforepayment(){

	   global $Itemid;
       $session_id = $this->saveSession();
       $this->private_data = $this->paymentType.'|session='.$session_id;
       JURI::root( false );
       $this->continue_url = JURI::root( false )."components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore";

	}
	
	function notify(){
	   if($_REQUEST['_type']=='new-order-notification'){
		   $this->transactionId = $_REQUEST['google-order-number'];
		   DT_Session::set('register.payment.transactionId',$this->transactionId);
		   return true;   
	   }else{
		   return false;   
	   }
	}

}

?>
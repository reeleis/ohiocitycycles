<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelCurrency extends DtrModel 
{
   
	var $currencies=array(
								'USD'=>'U.S. Dollars',
								'AUD'=>'Australian Dollars',
								'BRL'=>'Brazilian Real',
								'GBP'=>'British Pounds Sterling',
								'CAD'=>'Canadian Dollars',
								'CNY'=>'Chinese Yuan',
								'CZK'=>'Czech Koruna',
								'DKK'=>'Danish Kroner',
								'EUR'=>'Euros',
								'HKD'=>'Hong Kong Dollars',
								'HUF'=>'Hungarian Forints',
								'ILS'=>'Israeli New Shekels',
								'JPY'=>'Japanese Yen',
								'MXN'=>'Mexican Pesos',
								'NZD'=>'New Zealand Dollars',
								'NOK'=>'Norwegian Kroner',
								'PLN'=>'Polish Zloty',
								'RUB'=>'Russian Rubles',
								'SAR'=>'Saudi Riyal',
								'SGD'=>'Singapore Dollars',
								'ZAR'=>'South African Rand',
								'SEK'=>'Swedish Kronor',
								'CHF'=>'Swiss Francs',
								'TWD'=>'Taiwan Dollars',
								'UAE'=>'United Arab Emirates Dirham'
							);

  function getCurrency(){
     
	 return $this->currencies;
     
  }

}

?>
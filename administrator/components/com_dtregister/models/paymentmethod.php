<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelPaymentmethod extends DtrModel {

	var $methods = array();

  function __construct($config=array()){

	  $this->methods = array( "authorizenet" => JText::_( 'AUTH_NET' ),
								"echeck"=>JText::_( 'ECHECK' ),
								"GoogleCheckout"=>JText::_( 'DT_GOOGLE_CHECKOUT' ),
								"NetDeposit"=>JText::_( 'DT_NETDEPOSIT' ),
								"paypal"=>JText::_( 'PAYPAL' ),
								"Eway"=>JText::_( 'DT_EWAY' ),
								"usaepay_credit_card"=>JText::_( 'DT_USAEPAY' ),
								"usaepay_echeck"=>JText::_('DT_USAEPAY_ECHECK'),
								'Sage'=>JText::_('DT_SAGE'),
								"ideal" => JText::_( 'DT_PAY_IDEAL_MOLLIE' ),
								"idealRabo"=>JText::_( 'DT_PAY_IDEAL_LITE' ),
								'saferpay' => JText::_( 'DT_SAFER_PAY' ),
                                'psigate'=>JText::_('DT_PSIGATE'),
								"pay_later"=>JText::_( 'DT_PAY_LATER' ),
								"paypal_pro"=>JText::_( 'DT_PAYPAL_PRO' ),
								'offline_payment' => JText::_( 'DT_OFFLINE_PAYMENT' )

								);
										
		$path = JURI::root(true)."/components/com_dtregister/assets/images/";
		global $googlemerchid,$amp;
        $this->images = array(
		                   'authorizenet'=> $path .'card_pay.jpg',
						   'echeck'=> $path .'echeck_pay.jpg',
						   'GoogleCheckout'=> "https://checkout.google.com/buttons/checkout.gif?merchant_id=".$googlemerchid.$amp."w=160".$amp."h=43". $amp."style=trans".$amp."variant=text". $amp."loc=en_US",
						   'NetDeposit'=> $path .'card_pay.jpg',
						   'paypal'=> $path .'paypal_pay.jpg',
						   'Eway'=> $path .'eway_card_pay.jpg',
						   'Sage'=> $path .'sage_card_pay.jpg',
						   'ideal'=> $path .'ideal_pay.jpg',
						   'idealRabo'=> $path .'ideal_pay.jpg',
						   'pay_later'=> $path .'pay_later.jpg',
						   'paypal_pro'=> $path .'paypal_pay.jpg',
						   'saferpay'=>$path.'saferpay_pay.jpg',
						   'psigate'=> $path .'psigate_pay.jpg',
						   'usaepay_credit_card'=>$path.'card_pay.jpg',
						   'usaepay_echeck'=>$path.'echeck_pay.jpg',
						   'offline_payment' => $path.'card_pay.jpg',
		               );
		$this->paylater  =& DtrModel::getInstance('Paylater','DtregisterModel');

		parent::__construct($config);

  }

  function getMethods(){

	  global $mainframe;

      if($mainframe->isAdmin()){
		  $this->methods['ideal'] = JText::_( 'DT_PAY_IDEAL_MOLLIE' ); 
		  $this->methods['idealRabo'] = JText::_( 'DT_PAY_IDEAL_LITE' ); 
	  }

	 return $this->methods;

  }

  function getMergeList($all=false){

	  $paylater = &DtrModel::getInstance('paylater','dtregisterModel');

	  $plm = $paylater->getOptions();

	  if(isset($all) && $all){
		 $plm = $paylater->table->optionslist(); 
	  }else{
	  	$plm = $paylater->getOptions();
	  }
	  $pm = $this->methods;
	  if (isset($pm['pay_later'])) 
	  unset($pm['pay_later']);
	  
	  if (is_array($plm)) 
	  foreach($plm as $key=> $method){
		   $pm[$key] = $method;  
	  }
      
	  return $pm;

  }
  
  function paypal_country_codes(){
	 
	  return array(
'AF'=>'Afghanistan',
'AX'=>'ÅLAND ISLANDS',
'AL'=>'Albania',
'DZ'=>'Algeria',
'AS'=>'American Samoa',
'AD'=>'Andorra',
'AO'=>'Angola',
'AI'=>'Anguilla',
'AQ'=>'Antarctica',
'AG'=>'Antigua And Barbuda',
'AR'=>'Argentina',
'AM'=>'Armenia',
'AW'=>'Aruba',
'AU'=>'Australia',
'AT'=>'Austria',
'AZ'=>'Azerbaijan',
'BS'=>'Bahamas',
'BH'=>'Bahrain',
'BD'=>'Bangladesh',
'BB'=>'Barbados',
'BY'=>'Belarus',
'BE'=>'Belgium',
'BZ'=>'Belize',
'BJ'=>'Benin',
'BM'=>'Bermuda',
'BT'=>'Bhutan',
'BO'=>'Bolivia',
'BA'=>'Bosnia And Herzegovina',
'BW'=>'Botswana',
'BV'=>'Bouvet Island',
'BR'=>'Brazil',
'IO'=>'British Indian Ocean Territory',
'BN'=>'Brunei',
'BG'=>'Bulgaria',
'BF'=>'Burkina Faso',
'BI'=>'Burundi',
'KH'=>'Cambodia',
'CM'=>'Cameroon',
'CA'=>'Canada',
'CV'=>'Cape Verde',
'KY'=>'Cayman Islands',
'CF'=>'Central African Republic',
'TD'=>'Chad',
'CL'=>'Chile',
'CN'=>'China',
'CX'=>'Christmas Island',
'CC'=>'Cocos (Keeling) Islands',
'CO'=>'Columbia',
'KM'=>'Comoros',
'CG'=>'Congo',
'CK'=>'Cook Islands',
'CR'=>'Costa Rica',
'CI'=>'Cote D\'Ivorie (Ivory Coast)',
'HR'=>'Croatia (Hrvatska)',
'CU'=>'Cuba',
'CY'=>'Cyprus',
'CZ'=>'Czech Republic',
'CD'=>'Democratic Republic Of Congo (Zaire)',
'DK'=>'Denmark',
'DJ'=>'Djibouti',
'DM'=>'Dominica',
'DO'=>'Dominican Republic',
'EC'=>'Ecuador',
'EG'=>'Egypt',
'SV'=>'El Salvador',
'GQ'=>'Equatorial Guinea',
'ER'=>'Eritrea',
'EE'=>'Estonia',
'ET'=>'Ethiopia',
'FK'=>'Falkland Islands (Malvinas)',
'FO'=>'Faroe Islands',
'FJ'=>'Fiji',
'FI'=>'Finland',
'FR'=>'France',
'GF'=>'French Guinea',
'PF'=>'French Polynesia',
'TF'=>'French Southern Territories',
'GA'=>'Gabon',
'GM'=>'Gambia',
'GE'=>'Georgia',
'DE'=>'Germany',
'GH'=>'Ghana',
'GI'=>'Gibraltar',
'GR'=>'Greece',
'GL'=>'Greenland',
'GD'=>'Grenada',
'GP'=>'Guadeloupe',
'GU'=>'Guam',
'GT'=>'Guatemala',
'GN'=>'Guinea',
'GW'=>'Guinea-Bissau',
'GY'=>'Guyana',
'HT'=>'Haiti',
'HM'=>'Heard And McDonald Islands',
'VA'=>'Holy See (Vatican City State)',
'HN'=>'Honduras',
'HK'=>'Hong Kong',
'HU'=>'Hungary',
'IS'=>'Iceland',
'IN'=>'India',
'ID'=>'Indonesia',
'IR'=>'Iran',
'IQ'=>'Iraq',
'IE'=>'Ireland',
'IM'=>'Isle Of Man',
'IL'=>'Israel',
'IT'=>'Italy',
'JM'=>'Jamaica',
'JP'=>'Japan',
'JE'=>'Jersey',
'JO'=>'Jordan',
'KZ'=>'Kazakhstan',
'KE'=>'Kenya',
'KI'=>'Kiribati',
'KP'=>"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF",
'KR'=>'KOREA, REPUBLIC OF',
'KW'=>'Kuwait',
'KG'=>'Kyrgyzstan',
'LA'=>'Laos',
'LV'=>'Latvia',
'LB'=>'Lebanon',
'LS'=>'Lesotho',
'LR'=>'Liberia',
'LY'=>'Libyan Arab Jamahiriya',
'LI'=>'Liechtenstein',
'LT'=>'Lithuania',
'LU'=>'Luxembourg',
'MO'=>'Macau',
'MK'=>'Macedonia',
'MG'=>'Madagascar',
'MW'=>'Malawi',
'MY'=>'Malaysia',
'MV'=>'Maldives',
'ML'=>'Mali',
'MT'=>'Malta',
'MH'=>'Marshall Islands',
'MQ'=>'Martinique',
'MR'=>'Mauritania',
'MU'=>'Mauritius',
'YT'=>'Mayotte',
'MX'=>'Mexico',
'FM'=>'Micronesia',
'MD'=>'Moldova',
'MC'=>'Monaco',
'MN'=>'Mongolia',
'MS'=>'Montserrat',
'MA'=>'Morocco',
'MZ'=>'Mozambique',
'MM'=>'Myanmar (Burma)',
'NA'=>'Namibia',
'NR'=>'Nauru',
'NP'=>'Nepal',
'NL'=>'Netherlands',
'AN'=>'Netherlands Antilles',
'NC'=>'New Caledonia',
'NZ'=>'New Zealand',
'NI'=>'Nicaragua',
'NE'=>'Niger',
'NG'=>'Nigeria',
'NU'=>'Niue',
'NF'=>'Norfolk Island',
'MP'=>'Northern Mariana Islands',
'NO'=>'Norway',
'OM'=>'Oman',
'PK'=>'Pakistan',
'PW'=>'Palau',
'PS'=>'Palestinian Territory, Occupied',
'PA'=>'Panama',
'PG'=>'Papua New Guinea',
'PY'=>'Paraguay',
'PE'=>'Peru',
'PH'=>'Philippines',
'PN'=>'Pitcairn',
'PL'=>'Poland',
'PT'=>'Portugal',
'PR'=>'Puerto Rico',
'QA'=>'Qatar',
'RE'=>'Reunion',
'RO'=>'Romania',
'RU'=>'Russian Federation',
'RW'=>'Rwanda',
'SH'=>'Saint Helena',
'KN'=>'Saint Kitts And Nevis',
'LC'=>'Saint Lucia',
'PM'=>'Saint Pierre And Miquelon',
'VC'=>'Saint Vincent And The Grenadines',
'WS'=>'Samoa',
'SM'=>'San Marino',
'ST'=>'Sao Tome And Principe',
'SA'=>'Saudi Arabia',
'SN'=>'Senegal',
'CS'=>'Serbia And Montnegro',
'SC'=>'Seychelles',
'SL'=>'Sierra Leone',
'SG'=>'Singapore',
'SK'=>'Slovak Republic',
'SI'=>'Slovenia',
'SB'=>'Solomon Islands',
'SO'=>'Somalia',
'ZA'=>'South Africa',
'GS'=>'South Georgia And South Sandwich Islands',
'ES'=>'Spain',
'LK'=>'Sri Lanka',
'SD'=>'Sudan',
'SR'=>'Suriname',
'SJ'=>'Svalbard And Jan Mayen',
'SZ'=>'Swaziland',
'SE'=>'Sweden',
'CH'=>'Switzerland',
'SY'=>'Syria',
'TW'=>'Taiwan',
'TJ'=>'Tajikistan',
'TZ'=>'Tanzania',
'TH'=>'Thailand',
'TL'=>'Timor-Leste',
'TG'=>'Togo',
'TK'=>'Tokelau',
'TO'=>'Tonga',
'TT'=>'Trinidad And Tobago',
'TN'=>'Tunisia',
'TR'=>'Turkey',
'TM'=>'Turkmenistan',
'TC'=>'Turks And Caicos Islands',
'TV'=>'Tuvalu',
'UG'=>'Uganda',
'UA'=>'Ukraine',
'AE'=>'United Arab Emirates',
'UK'=>'United Kingdom',
'US'=>'United States',
'UM'=>'United States Minor Outlying Islands',
'UY'=>'Uruguay',
'UZ'=>'Uzbekistan',
'VU'=>'Vanuatu',
'VE'=>'Venezuela',
'VN'=>'Vietnam',
'VG'=>'Virgin Islands (British)',
'VI'=>'Virgin Islands (US)',
'WF'=>'Wallis And Futuna Islands',
'EH'=>'Western Sahara',
'YE'=>'Yemen',
'ZM'=>'Zambia',
'ZW'=>'Zimbabwe'
);	  
 }

}

?>
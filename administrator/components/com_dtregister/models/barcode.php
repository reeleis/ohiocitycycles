<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelBarcode extends DtrModel { 
     
	  function __construct($config = array()){
		   
		   parent::__construct($config);
		   
		   $this->barCodeTypes =  array(
                    'code39'=>JText::_('DT_CODE39'),
					'code39extended'=>JText::_('DT_CODE39_EXTENDED'),
					'code93'=>JText::_('DT_CODE93'),
					'code128'=>JText::_('DT_CODE128')
				);
           $this->barCodeImagetype =  array('png'=>JText::_('DT_BARCODE_PNG'),'jpg'=>JText::_('DT_BARCODE_JPEG'));
           $this->barCodeImagetypeToExt =  array('png'=>'png','jpg'=>'jpeg');
           $this->barCodeResolutions =  array('1'=>1,'2'=>'2','3'=>'3' );
           $this->barcodeRotation =  array(0=>JText::_('DT_DEGREE_ZERO'),90=>JText::_('DT_DEGREE_90'),180=>JText::_('DT_DEGREE_180'),270=>JText::_('DT_DEGREE_270'));
   
	  }
 
}
?>
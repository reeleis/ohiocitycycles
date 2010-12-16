<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterControllerBarcode extends DtrController {
   
   var $name = "Barcode";
   
    function __construct($config = array()){
		 
		 parent::__construct($config);
		 $this->view = & $this->getView( 'Barcode', 'html' );
			 
	}
	
	function preview(){
	     global $barcode_type , $barcode_image_type , $barcodeDpi , $barcodeThick , $barcode_resolution , $barcode_font_size,$barcode_checksum ,$barcode_rotation ,$barCodeImagetypeToExt;
		 
		 $barcode_type = JRequest::getVar('barcode_type',$barcode_type);
		 $barcode_image_type = JRequest::getVar('barcode_image_type',$barcode_image_type);
		 $barcodeDpi = JRequest::getVar('barcodeDpi',$barcodeDpi);
		 $barcodeThick = JRequest::getVar('barcodeThick',$barcodeThick);
		 $barcode_resolution = JRequest::getVar('barcode_resolution',$barcode_resolution);
		 $barcode_font_size = JRequest::getVar('barcode_font_size',$barcode_font_size);
		 $barcode_rotation = JRequest::getVar('barcode_rotation',$barcode_rotation);
		 
		 $request =  array(
		          'barcode_type'=>$barcode_type ,
				  'barcode_image_type'=>$barcode_image_type ,
				  'barcodeDpi'=>$barcodeDpi ,
				  'barcodeThick'=>$barcodeThick ,
				  'barcode_resolution'=>$barcode_resolution ,
				  'barcode_font_size'=>$barcode_font_size ,
				  'barcode_rotation'=>$barcode_rotation ,
		      );
		 $get_str = str_replace("&amp;","&",http_build_query($request));
	   ?>
		 <img border="0" src="<?php echo "index.php?option=com_dtregister&task=previewsrc&controller=barcode&no_html=1&".$get_str; ?>" />
       <?php
	   	
	}
	
	function previewsrc(){
		 global $barcode_type , $barcode_image_type , $barcodeDpi , $barcodeThick , $barcode_resolution , $barcode_font_size,$barcode_checksum ,$barcode_rotation ,$barCodeImagetypeToExt;
	      $barcode_type = JRequest::getVar('barcode_type',$barcode_type);
		 $barcode_image_type = JRequest::getVar('barcode_image_type',$barcode_image_type);
		 $barcodeDpi = JRequest::getVar('barcodeDpi',$barcodeDpi);
		 $barcodeThick = JRequest::getVar('barcodeThick',$barcodeThick);
		 $barcode_resolution = JRequest::getVar('barcode_resolution',$barcode_resolution);
		 $barcode_font_size = JRequest::getVar('barcode_font_size',$barcode_font_size);
		 $barcode_rotation = JRequest::getVar('barcode_rotation',$barcode_rotation);
	    $barcode = new DTbarcode();
		$barcode->preview();
		
	   	
	}
	
}
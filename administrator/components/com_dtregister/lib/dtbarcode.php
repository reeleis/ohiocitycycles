<?php
class DTbarcode{
	
   function DTbarcode($text="Testing",$filename=""){
	    global $barcode_type , $barcode_image_type , $barcodeDpi , $barcodeThick , $barcode_resolution , $barcode_font_size,$barcode_checksum ,$barcode_rotation ,$barCodeImagetypeToExt;
		$barcode_checksum = 0 ;
		$this->barcodeModel =  DtrModel::getInstance('barcode','DtregisterModel');
		$barCodeImagetypeToExt = $this->barcodeModel->barCodeImagetypeToExt ;
		$class_dir = JPATH_SITE.'/components/com_dtregister/lib/barcode/class';
		$filename = ($filename!="")?JPATH_SITE.'/images/dtregister/barcode/'.$filename.'.'.$barcode_image_type:'' ;
		
	    require_once($class_dir . '/color.php');
	    require_once($class_dir . '/barcode.php');
	    require_once($class_dir . '/drawing.php');
	    require_once($class_dir . '/font.php');
		require_once($class_dir . '/'.$barcode_type.'.php');
		
		$this->font = new BCGFont(JPATH_SITE . '/components/com_dtregister/monofont.ttf', intval($barcode_font_size));
		$this->color_black = new BCGColor(0, 0, 0);
		$this->color_white = new BCGColor(255, 255, 255);
		$codebar = 'BCG' . $barcode_type;
		$this->code_generated = new $codebar();
		
		if($barcode_checksum && intval($barcode_checksum) === 1)
		  $this->code_generated->setChecksum(true);
		  
		$this->code_generated->setLabel($text);
		$this->code_generated->setThickness($barcodeThick);
		$this->code_generated->setScale($barcode_resolution);
		$this->code_generated->setBackgroundColor($this->color_white);
		$this->code_generated->setForegroundColor($this->color_black);
		$this->code_generated->setFont($this->font);
		
		$this->code_generated->parse($text);
		
		$this->drawing = new BCGDrawing($filename, $this->color_white);
		$this->drawing->setBarcode($this->code_generated);
		$this->drawing->setRotationAngle($barcode_rotation);
		$this->drawing->setDPI(($barcodeDpi == 'null' || $barcodeDpi=="" )? null : (int)$barcodeDpi);
		
		$this->drawing->draw();
		$this->drawing->finish($barcode_image_type);
   }	
   
   function preview(){
	   global $barcode_image_type;
	   	
		
	    $barCodeImagetype = $this->barcodeModel->barCodeImagetype ;
		
	   if($barcode_image_type == 'png') { 
			//header('Content-Type: image/png');
		} elseif($barcode_image_type == 'jpg') {
			//header('Content-Type: image/jpeg');
		} elseif(intval($_GET['o']) === 3) {
			//header('Content-Type: image/gif');
		}
        $temp =  array_flip(array_keys($barCodeImagetype));
		
		
        $this->drawing->finish($temp[$barcode_image_type]);
		
   }
   
   function save(){
	     
   }
}
?>
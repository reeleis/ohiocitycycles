<?php 

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $barCodeTypes ,$barCodeImagetype ,$barCodeResolutions , $barcodeRotation; 

$barcodeModel =&$this->getModel('barcode');
$barCodeTypes = $barcodeModel->barCodeTypes ; 
$barCodeImagetype = $barcodeModel->barCodeImagetype ; 
$barCodeResolutions = $barcodeModel->barCodeResolutions ; 
$barcodeRotation = $barcodeModel->barcodeRotation ; 

?>

<table>
  <tr>
    <td>
      <strong><?php echo  JText::_('DT_BARCODE_ENABLE');?>:</strong>
    </td>
     <td>
      <?php
	   echo JHTML::_('select.booleanlist', "config[barcode_enable]","", $config->getGlobal('barcode_enable',0));  ?>
        
	 
    </td>
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_ENABLE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  <tr>
    <td>
      <strong><?php echo  JText::_('DT_BARCODE_TYPE');?>:</strong>
    </td>
     <td>
      <?php
	   
	      echo JHTML::_('select.genericlist', DtHtml::options($barCodeTypes),'config[barcode_type]','','value','text',$config->getGlobal('barcode_type','code39'));
        
	  ?>
    </td>
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
    
  </tr>
   <tr>
    <td>
      <strong><?php echo  JText::_('DT_BARCODE_IMAGE_TYPE');?>:</strong>
    </td>
     <td>
     <?php
	    
       echo JHTML::_('select.genericlist', $options=DtHtml::options($barCodeImagetype),'config[barcode_image_type]','','value','text',$config->getGlobal('barcode_image_type','png'));
	  ?>
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_IMAGE_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
   <tr>
    <td>
     <strong> <?php echo  JText::_('DT_BARCODE_DPI');?>:</strong>
    </td>
     <td>
     
      <input type="text" name="config[barcodeDpi]" size="5" value="<?php echo $config->getGlobal('barcodeDpi',72) ; ?>" />
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_DPI_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
   <tr>
    <td>
      <strong><?php echo  JText::_('DT_BARCODE_THICKNESS');?>:</strong>
    </td>
     <td>
    
    <input type="text" name="config[barcodeThick]" size="5" value="<?php echo $config->getGlobal('barcodeThick',30)  ; ?>" />
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_THICKNESS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
  
   <tr>
    <td>
     <strong> <?php echo  JText::_('DT_BARCODE_RESOLUTION');?>:</strong>
    </td>
     <td>
    
     <?php
	     
	   echo JHTML::_('select.radiolist',  DtHtml::options($barCodeResolutions),'config[barcode_resolution]','','value','text',$config->getGlobal('barcode_resolution',1));
        
	  ?>
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_RESOLUTION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
   <tr>
    <td>
     <strong> <?php echo  JText::_('DT_BARCODE_ROTATION');?>:</strong>
    </td>
     <td>
  
     <?php
	   
	      echo JHTML::_('select.radiolist', DtHtml::options($barcodeRotation),'config[barcode_rotation]','','value','text',$config->getGlobal('barcode_rotation',0));
        
	  ?>
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_ROTATION_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
  
   <tr>
    <td>
      <strong><?php echo  JText::_('DT_BARCODE_FONT_SIZE');?>:</strong>
    </td>
     <td>
     
    <input type="text" name="config[barcode_font_size]" size="5" value="<?php echo $config->getGlobal('barcode_font_size',10) ; ?>" />
    </td>
    
	<td><?php echo JHTML::tooltip((JText::_( 'DT_BARCODE_FONT_SIZE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
  </tr>
  
</table>
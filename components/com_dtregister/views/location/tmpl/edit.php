<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

	$document =& JFactory::getDocument();
    
	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/form.js');
    $config = $this->getModel('config');
	$country = $this->getModel('country');
	$row = $this->getModel('location')->location;
	$id = JRequest::getVar( 'cid', array(0), 'request', 'array' );
    global $Itemid;
	if($id){

	   $row->load($id[0]);

	}

?>

<script type="text/javascript">

DTjQuery(document).ready(function(){

DTjQuery('#imageUpload').click(function(){

    DTjQuery("#task").val("locationImageUpload");

     var options = { 

	type :'POST',

	target : '#debug',

    url: 'index.php?no_html=1', 

    iframe : true ,

	dataType : 'script',

	success :function(){

	   DTjQuery("#task").val("");

	}

   }; 

// pass options to ajaxForm 

  DTjQuery('#adminForm').ajaxSubmit(options);

   return false;

});

 });

function submitbutton(pressbutton){

	submitform(pressbutton);

}

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table width="100%" class="adminlist" border="1">

    <tr>

      <td class="dt_heading" colspan="3"><?php echo JText::_('DT_LOCATION');?> <?php echo JText::_('DT_DETAILS');?></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_NAME'); ?></td><td><input type="text" size="40" name="name" value="<?php echo stripslashes($row->name); ?>" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_ADDRESS'); ?></td><td><input type="text" size="40" name="address" value="<?php echo stripslashes($row->address); ?>" /></td>

   </tr>

   </tr>

     <tr>

      <td><?php echo JText::_( 'DT_ADDRESS2'); ?></td><td><input type="text" size="40" name="address2" value="<?php echo stripslashes($row->address2); ?>" /></td>

   </tr>

    <tr>

      <td><?php echo JText::_( 'DT_CITY'); ?></td><td><input type="text" size="40" name="city" value="<?php echo stripslashes($row->city); ?>" /></td>

   </tr>

    <tr>

      <td><?php echo JText::_( 'DT_STATE'); ?></td><td><input type="text" size="40" name="state" value="<?php echo stripslashes($row->state); ?>" /></td>

   </tr>
    <tr>

      <td><?php echo JText::_( 'DT_COUNTRY'); ?></td><td>
      <?php
        $options=DtHtml::options($country->getCountry());
		echo JHTML::_('select.genericlist', $options,'country','', 'value','text',$row->country);
	  ?>
      </td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_ZIPCODE'); ?></td><td><input type="text" size="40" name="zip" value="<?php echo $row->zip; ?>" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_PHONE'); ?></td><td><input type="text" size="40" name="phone" value="<?php echo $row->phone; ?>" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_EMAIL'); ?></td><td><input type="text" size="40" name="email" value="<?php echo $row->email; ?>" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_WEBSITE'); ?></td><td><input type="text" size="40" name="website" value="<?php echo $row->website; ?>" />

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo JText::_( 'DT_INCLUDE_HTTP_HELP'); ?>

      </td>  

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_LOCATION_IMAGE'); ?></td>

      <td>

      <span id="showimag"><?php 

	  if($row->image!=""){
     
	  echo "<img src=\"index.php?option=com_dtregister&controller=file&w=".$config->getGlobal('location_img_w',150)."&h=".$config->getGlobal('location_img_h',150)."&task=thumb&no_html=1&filename=images/dtregister/locations/".basename($row->image)."\" />";

	  }

	  ?>

	  </span><input type="checkbox" <?php echo $row->showimage==1?'checked':'';?> name="showimage" value="1" />

      <input type="file" name="locationimage" /> &nbsp;

      <input type="button" id="imageUpload" value="<?php echo  JText::_( 'DT_UPLOAD'); ?>" />

      <input type="hidden" name="image" id="image" value="<?php echo $row->image; ?>" />

      <input type="hidden" name="option" value="com_dtregister" />
      <input type="hidden" name="controller" value="location" />
      <input type="hidden" id="task" name="task" value="" />

      <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
      <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

      <br /><?php echo JText::_( 'DT_LOCATION_IMAGE_CHECKBOX_HELP'); ?>

      </td>

   </tr>

</table>

</form>
<div id="debug">

</div>
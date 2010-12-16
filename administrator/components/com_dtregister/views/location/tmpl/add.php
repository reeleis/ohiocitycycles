<?php

/**
* @version 2.6.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

	$document	=& JFactory::getDocument();

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/form.js');
    $country =  $this->getModel('country');
?>

<script type="text/javascript">

DTjQuery(document).ready(function(){

DTjQuery('#imageUpload').click(function(){

    DTjQuery("#task").val("ImageUpload");

     var options = { 

	type :'POST',

	target : '#debug',

    url : 'index.php?no_html=1', 

    iframe : true ,

	dataType : 'script',

	success :function(data){
       
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

<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table width="100%" class="adminform" border="1">

   <tr>

      <td colspan="2"></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_NAME'); ?></td><td><input type="text" size="40" name="name" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_ADDRESS'); ?></td><td><input type="text" size="40" name="address" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_ADDRESS2'); ?></td><td><input type="text" size="40" name="address2" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_CITY'); ?></td><td><input type="text" size="40" name="city" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_STATE'); ?></td><td><input type="text" size="40" name="state" /></td>

   </tr>
   <tr>

      <td><?php echo JText::_( 'DT_COUNTRY'); ?></td><td>
      <?php
        $options=DtHtml::options($country->getCountry());
		echo JHTML::_('select.genericlist', $options,'country','', 'value','text','United States');
	  ?>
      </td>

   </tr>
 
   <tr>

      <td><?php echo JText::_( 'DT_ZIPCODE'); ?></td><td><input type="text" size="40" name="zip" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_PHONE'); ?></td><td><input type="text" size="40" name="phone" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_EMAIL'); ?></td><td><input type="text" size="40" name="email" /></td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_WEBSITE'); ?></td><td><input type="text" size="40" name="website" />

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo JText::_( 'DT_INCLUDE_HTTP_HELP'); ?>

      </td>

   </tr>

   <tr>

      <td><?php echo JText::_( 'DT_LOCATION_IMAGE'); ?></td>

      <td>
       <input type="hidden" name="image" id="image" />

      <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT ;?>" />
      <input type="hidden" name="controller" value="location" />

      <input type="hidden" id="task" name="task" value="" />
      <span id="showimag"></span><input type="checkbox" name="showimage" value="1" />

      <input type="file" name="locationimage" /> &nbsp;

      <input type="button" id="imageUpload" value="<?php echo  JText::_( 'DT_UPLOAD'); ?>" />

      

      <br /><?php echo JText::_( 'DT_LOCATION_IMAGE_CHECKBOX_HELP'); ?>

      </td>

   </tr>

</table>

</form>

<div id="debug">

</div>
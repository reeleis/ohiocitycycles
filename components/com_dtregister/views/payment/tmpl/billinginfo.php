<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid ,$xhtml_url;  

if(DT_Session::get('register.User.process')){
  include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
}else{
  ?>
  <div class="componentheading"><?php echo JText::_('DT_EVENT_REGISTRATION')?>: <?php echo JText::_( 'DT_PAYMENT' );?>

		</div>
  <?php	
}
?>

<form method="post" name="frmcart" id="frmcart">

<table>

  <?php echo $this->form ;?>

  <tr>

    <td colspan="2">

      <input type="submit" id="billinginfo" name="billinginfo"  value="Submit" />

    </td>

  </tr>

</table>

<input type="hidden" name="option" value="com_dtregister" />

<input type="hidden" name="controller" value="payment" />

<input type="hidden" name="task" value="billinginfo" />

<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

</form>

<script type="text/javascript">
  
  DTjQuery(function(){
	  
	  DTjQuery.validator.messages.required = " ";
	  DTjQuery.validator.messages.remote = " ";
	  DTjQuery(document.frmcart).validate({
			  success: function(label) {
				  label.addClass("success");
			  }
  
	  });
	  
	  DTjQuery("#billinginfo").click(function(){
			if(DTjQuery(document.frmcart).valid()){
				DTjQuery('').attr('disabled','disabled');
			}
			  
	  });
  })
  
</script>
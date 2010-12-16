<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid, $xhtml_url ;
$eventId = JRequest::getVar('eventId',0);
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'event_header.php');
?>

<form name="frmcart" method="post" />

  <table style="margin-left: auto; margin-right: auto; text-align: center;">
	
	<tr> <td colspan="2"><span ><strong><?php echo JText::_( 'SELECT_OPTION' );?> </strong></span><br /></td></tr>

	<tr>

      <td width="50%">

              <div style="text-align: center;">
                
               <a href="<?php echo JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=individualRegister',$xhtml_url ); ?>" > <img src="<?php echo  JURI::root(true);?>/components/com_dtregister/assets/images/individual.jpg" alt="" vspace="5" border="0" width="120" height="100" /></a>

             </div>

        </td>

		<td width="50%">

              <div style="text-align: center;">
               
               <a href="<?php echo JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=groupNum',$xhtml_url ) ?>" > <img src="<?php echo JURI::root(true);?>/components/com_dtregister/assets/images/group.jpg" alt="" vspace="5" border="0" width="120" height="100" /></a>

             </div>

        </td>

       </tr>

	   <tr><td width="50%" style="text-align: center;"><div><input name="rtype" type="radio" value="individualRegister" />

	     	<?php echo JText::_( 'INDIVIDUAL_REGISTRATION' );?> </div></td>

          <td style="text-align: center;"><div><input name="rtype" type="radio" value="groupNum" /><input type="hidden" name="eventId" value="<?php echo $eventId?>" />

          	<?php echo JText::_( 'GROUP_REGISTRATION' );?></div></td></tr>

		<tr><td colspan="2"> </td></tr>

	    <tr><td colspan="2"><div><input type="button" name="send" value="<?php echo JText::_( 'DT_NEXT_BUTTON' ); ?>" class="button" onclick="validateit();" /></div></td></tr>
		
   </table>

<input type="hidden" name="type" value="" />

<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

</form>
      <script type="text/javascript">
           //<![CDATA[
			function validateit()

			{

				if(document.frmcart.rtype[0].checked==false && document.frmcart.rtype[1].checked==false){

					alert ("Please Select any type first");

					document.frmcart.rtype[0].focus();

			    	return;

			    }

				if(document.frmcart.rtype[0].checked){

					<?php // $_SESSION['register']['reg_type'] = 'reg_individual';	$_SESSION['register']['memtot'] = 1; ?>
                      
					window.location ="<?php echo  JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=individualRegister',false ) ; ?>";

				} else if(document.frmcart.rtype[1].checked){

					<?php // $_SESSION['register']['reg_type'] = 'reg_group';	$_SESSION['register']['memtot'] = NULL; ?>

			    	window.location ="<?php echo  JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&eventId='.$eventId.'&controller=event&task=groupNum',false ) ?>";

				} else {

					return;

				}

			}
           //]]>
		</script>

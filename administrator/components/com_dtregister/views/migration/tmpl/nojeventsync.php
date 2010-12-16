<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

?>

<table border="0" width="520">
	
	<tr>
		
		<td align="left" valign="top">
			
			<?php echo JText::_('DT_NOJEVENTS_INFO');?>
			
		</td>
		
		<td align="left" valign="top" style="padding-left:20px;">

<a href="index.php?option=com_dtregister&controller=migration&task=nojeventSync&remove=1"><img src="components/com_dtregister/assets/images/no_jevents_130.png" border="0" /></a>

        </td>

     </tr>

</table>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<input type="hidden" name="option" value="com_dtregister" />

 <input type="hidden" name="controller" value="cpanel" />

 <input type="hidden" name="task" value="" />

</form>
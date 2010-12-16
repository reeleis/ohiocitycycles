<?php
global $Itemid , $cut_off_date_message , $xhtml_url ;

?>
<table>

		<tr>

			<td>

				<?php echo $cut_off_date_message; ?>

			</td>

		</tr>

		<tr>

			<td>
               
				<a href="<?php echo  JRoute::_('index.php?option=com_dtregister&controller=event&Itemid='.$Itemid ,$xhtml_url); ?>"><?php echo JText::_( 'DT_RETURN_TO_EVENTS' ); ?></a>

			</td>

		</tr>

	</table>

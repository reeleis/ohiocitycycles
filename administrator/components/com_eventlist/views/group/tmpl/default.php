<?php
/**
 * @version 0.9 $Id: default.php 507 2008-01-03 15:48:34Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');
?>

<script language="javascript" type="text/javascript">
	function submitbutton(task)
	{

		var form = document.adminForm;

		if (task == 'cancel') {
			submitform( task );
			return;
		}
		else if (form.name.value == ""){
			alert( "<?php echo JText::_( 'ADD GROUP NAME'); ?>" );
		} else {
			allSelected(document.adminForm['maintainers[]']);
			submitform( task );
		}
	}
</script>

<script>
	// moves elements from one select box to another one
	function moveOptions(from,to) {
		// Move them over
		for (var i=0; i<from.options.length; i++) {
			var o = from.options[i];
			if (o.selected) {
			  to.options[to.options.length] = new Option( o.text, o.value, false, false);
			}
		}

		// Delete them from original
		for (var i=(from.options.length-1); i>=0; i--) {
			var o = from.options[i];
			if (o.selected) {
			  from.options[i] = null;
			}
		}
		from.selectedIndex = -1;
		to.selectedIndex = -1;
	}

	function allSelected(element) {

		for (var i=0; i<element.options.length; i++) {
			var o = element.options[i];
			o.selected = true;
		}
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

<table class="adminlist">
	<tr>
		  <td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
		  <td class="sectionname" align="right" width="100%">
		  	<font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">
		  		<?php echo $this->row->id ? '::'.JText::_( 'EDIT GROUP').'::' : '::'.JText::_( 'ADD GROUP').'::'; ?>
			</font>
		</td>
	</tr>
</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td valign="top">

			<table class="adminform">
				<tr>
					<td>
						<label for="name">
							<?php echo JText::_( 'GROUP NAME' ).':'; ?>
						</label>
					</td>
					<td>
						<input name="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="60" id="name" />
					</td>
				</tr>
			</table>

			<table class="adminform">
				<tr>
					<td><b><?php echo JText::_( 'AVAILABLE USERS' ).':'; ?></b></td>
					<td>&nbsp;</td>
					<td><b><?php echo JText::_( 'MAINTAINERS' ).':'; ?></b></td>
				</tr>
				<tr>
					<td width="260px"><?php echo $this->lists['available_users']; ?></td>
					<td width="110px">
						<input style="width: 50px" type="button" name="right" value="&gt;" onClick="moveOptions(document.adminForm['available_users'], document.adminForm['maintainers[]'])" />
						<br /><br />
						<input style="width: 50px" type="button" name="left" value="&lt;" onClick="moveOptions(document.adminForm['maintainers[]'], document.adminForm['available_users'])" />
					</td>
					<td width="260px"><?php echo $this->lists['maintainers']; ?></td>
				</tr>
			</table>

		</td>
		<td valign="top" width="320px" style="padding: 7px 0 0 5px">
			<?php
			$title = JText::_( 'DESCRIPTION' );
			echo $this->pane->startPane("det-pane");
			echo $this->pane->startPanel( $title, 'desc' );
			?>
			<table>
				<tr>
					<td>
						<textarea wrap="virtual" rows="10" cols="40" name="description" class="inputbox"><?php echo $this->row->description; ?></textarea>
					</td>
				</tr>
			</table>
			<?php
			echo $this->pane->endPanel();
			echo $this->pane->endPane();
			?>
		</td>
	</tr>
</table>

<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="groups" />
<input type="hidden" name="view" value="group" />
<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
<input type="hidden" name="task" value="" />
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
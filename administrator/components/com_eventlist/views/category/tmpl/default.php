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
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (form.catname.value == ""){
		alert( "<?php echo JText::_( 'ADD NAME CATEGORY' ); ?>" );
	} else {
		<?php echo $this->editor->save( 'catdescription' ); ?>
		submitform( pressbutton );
	}
}
</script>


<form action="index.php" method="post" name="adminForm" id="adminForm">
<table class="adminlist">
	<tr>
  		<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
  		<td class="sectionname" align="right" width="100%"><font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;"><?php echo $this->row->id ? '::'.JText::_( 'EDIT CATEGORY' ).'::' : '::'.JText::_( 'ADD CATEGORY' ).'::';?></font></td>
	</tr>
</table>


	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
				<table  class="adminform">
					<tr>
						<td>
							<label for="catname">
								<?php echo JText::_( 'CATEGORY' ).':'; ?>
							</label>
						</td>
						<td>
							<input name="catname" value="<?php echo $this->row->catname; ?>" size="50" maxlength="100" />
						</td>
						<td>
							<label for="published">
								<?php echo JText::_( 'PUBLISHED' ).':'; ?>
							</label>
						</td>
						<td>
							<?php
							$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->row->published );
							echo $html;
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="alias">
								<?php echo JText::_( 'Alias' ).':'; ?>
							</label>
						</td>
						<td colspan="3">
							<input class="inputbox" type="text" name="alias" id="alias" size="50" maxlength="100" value="<?php echo $this->row->alias; ?>" />
						</td>
					</tr>
				</table>

			<table class="adminform">
				<tr>
					<td>
						<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols
						echo $this->editor->display( 'catdescription',  $this->row->catdescription, '100%;', '350', '75', '20', array('pagebreak', 'readmore') ) ;
						?>
					</td>
				</tr>
			</table>
			</td>
			<td valign="top" width="320px" style="padding: 7px 0 0 5px">
			<?php
			$title = JText::_( 'ACCESS' );
			echo $this->pane->startPane( 'det-pane' );
			echo $this->pane->startPanel( $title, 'access' );
			?>
			<table>
				<tr>
					<td>
						<label for="access">
							<?php echo JText::_( 'ACCESS' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						echo $this->Lists['access'];
						?>
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'GROUP' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'group' );
			?>
			<table>
				<tr>
					<td>
						<label for="groups">
							<?php echo JText::_( 'GROUP' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo $this->Lists['groups']; ?>
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'IMAGE' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'catimage' );
			?>
			<table>
				<tr>
					<td>
						<label for="catimage">
							<?php echo JText::_( 'CHOOSE IMAGE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo $this->Lists['imagelist']; ?>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<script language="javascript" type="text/javascript">
						if (document.forms[0].image.options.value!=''){
							jsimg='../images/stories/' + getSelectedValue( 'adminForm', 'image' );
						} else {
							jsimg='../images/M_images/blank.png';
						}
						document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="Preview" />');
						</script>
						<br /><br />
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'METADATA INFORMATION' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'metadata' );
			?>
		<table>
		<tr>
			<td>
				<label for="metadesc">
					<?php echo JText::_( 'META DESCRIPTION' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_description" id="metadesc" style="width:300px;"><?php echo str_replace('&','&amp;',$this->row->meta_description); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="metakey">
					<?php echo JText::_( 'META KEYWORDS' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_keywords" id="metakey" style="width:300px;"><?php echo str_replace('&','&amp;',$this->row->meta_keywords); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<input type="button" class="button" value="<?php echo JText::_( 'ADD CATNAME' ); ?>" onclick="f=document.adminForm;f.metakey.value=f.catname.value;" />
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
<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
<input type="hidden" name="controller" value="categories" />
<input type="hidden" name="view" value="category" />
<input type="hidden" name="task" value="" />
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
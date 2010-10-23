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

<form action="index.php?option=com_eventlist&amp;view=categoryelement&amp;tmpl=component" method="post" name="adminForm">

<table class="adminform">
	<tr>
		<td width="100%">
			<?php echo JText::_( 'SEARCH' ); ?>
			<input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" />
			<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
			<button onclick="this.form.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		</td>
		<td nowrap="nowrap"><?php  echo $this->lists['state']; ?></td>
	</tr>
</table>

<table class="adminlist" cellspacing="1">
	<thead>
		<tr>
			<th width="7"><?php echo JText::_( 'Num' ); ?></th>
			<th align="left" class="title"><?php echo JHTML::_('grid.sort', 'CATEGORY', 'catname', $this->lists['order_Dir'], $this->lists['order'], 'categoryelement' ); ?></th>
			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'ACCESS' ); ?></th>
			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'PUBLISHED' ); ?></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="4">
				<?php echo $this->pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>

	<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count($this->rows); $i < $n; $i++) {
			$row = $this->rows[$i];

			if (!$row->access) {
				$access = 'Public';
			} else if ($row->access == 1) {
				$access = 'Registered';
			} else {
				$access = 'Special';
			}
   		?>
		<tr class="<?php echo "row$k"; ?>">
			<td width="7"><?php echo $this->pageNav->getRowOffset( $i ); ?></td>
			<td align="left">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'SELECT' );?>::<?php echo $row->catname; ?>">
				<a style="cursor:pointer" onclick="window.parent.elSelectCategory('<?php echo $row->id; ?>', '<?php echo str_replace( array("'", "\""), array("\\'", ""), $row->catname ); ?>');">
					<?php echo htmlspecialchars($row->catname, ENT_QUOTES, 'UTF-8'); ?>
				</a></span>
			</td>
			<td align="center"><?php echo $access; ?></td>
			<td align="center">
				<?php
				$img = $row->published ? 'tick.png' : 'publish_x.png';
				$alt = $row->published ? 'Published' : 'Unpublished';
				?>
				<img src="images/<?php echo $img;?>" width="16" height="16" border="0" alt="<?php echo $alt;?>" />
			</td>
		</tr>
			<?php $k = 1 - $k; } ?>
	</tbody>

</table>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<input type="hidden" name="task" value="">
<input type="hidden" name="tmpl" value="component">
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>
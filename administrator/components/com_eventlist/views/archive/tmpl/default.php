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

defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
		  	<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
		  	<td class="sectionname" align="right" width="100%"><font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">::<?php echo JText::_( 'ARCHIVE' ); ?>::</font></td>
		</tr>
	</table>

	<table class="adminform">
		<tr>
			<td width="100%">
				<?php echo JText::_( 'SEARCH' ).' '.$this->lists['filter']; ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_( 'Filter by title or enter article ID' );?>"/>
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="this.form.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
		</tr>
	</table>

	<table class="adminlist" cellspacing="1">
		<thead>
			<tr>
				<th width="5"><?php echo JText::_( 'Num' ); ?></th>
				<th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'DATE', 'a.dates', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'Start', 'a.times', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'EVENT TITLE', 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'VENUE', 'loc.venue', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'CATEGORY', 'cat.catname', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JHTML::_('grid.sort', 'CITY', 'loc.city', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<th class="title"><?php echo JText::_( 'CREATION' ); ?></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<td colspan="9">
					<?php echo $this->pageNav->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>

		<tbody>
			<?php
			$k = 0;
			for($i=0, $n=count( $this->rows ); $i < $n; $i++) {
				$row = &$this->rows[$i];
				$date		= strftime( $this->elsettings->formatdate, strtotime( $row->dates ));

				if (!$row->enddates) {
					$displaydate = $date;
				} else {
					$enddate 	= strftime( $this->elsettings->formatdate, strtotime( $row->enddates ));
					$displaydate = $date.' - <br />'.$enddate;
				}

				//Don't display 0 time
				if (!$row->times) {
					$time = '';
				} else {
					$time = strftime( $this->elsettings->formattime, strtotime( $row->times ));
					$time = $time.' '.$this->elsettings->timename;
				}
   			?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $this->pageNav->getRowOffset( $i ); ?></td>
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
				<td>
					<?php echo $displaydate; ?>
				</td>
				<td><?php echo $time; ?></td>
				<td><?php echo htmlspecialchars($row->title, ENT_QUOTES, 'UTF-8'); ?></td>
				<td><?php echo $row->venue ? htmlspecialchars($row->venue, ENT_QUOTES, 'UTF-8') : '-'; ?></td>
				<td><?php echo htmlspecialchars($row->catname, ENT_QUOTES, 'UTF-8'); ?></td>
				<td><?php echo $row->city ? htmlspecialchars($row->city, ENT_QUOTES, 'UTF-8') : '-'; ?></td>
				<td>
					<?php echo JText::_( 'AUTHOR' ).': '; ?><a href="<?php echo 'index.php?option=com_users&amp;task=edit&amp;hidemainmenu=1&amp;cid[]='.$row->created_by; ?>"><?php echo $row->author; ?></a><br />
					<?php echo JText::_( 'EMAIL' ).': '; ?><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a><br />
					<?php
					$created = JHTML::Date( $row->created, JText::_( 'DATE_FORMAT_LC2' ) );
					$edited	 = JHTML::Date( $row->modified, JText::_( 'DATE_FORMAT_LC2' ) );
					$image 		= JHTML::_('image', '/templates/'. $this->template .'/images/menu/icon-16-info.png', JText::_( 'NOTES' ) );
					$overlib 	= JText::_( 'CREATED AT' ).': '.$created.'<br />';
					$overlib	.= JText::_( 'WITH IP' ).': '.$row->author_ip.'<br />';
					if ($row->modified != '0000-00-00 00:00:00') {
						$overlib 	.= JText::_( 'EDITED AT' ).': '.$edited.'<br />';
						$overlib 	.= JText::_( 'EDITED FROM' ).': '.$row->editor.'<br />';
					}
					?>
					<span class="editlinktip hasTip" title="<?php echo JText::_('EVENT STATS'); ?>::<?php echo $overlib; ?>">
						<?php echo $image; ?>
					</span>
				</td>
			</tr>
			<?php $k = 1 - $k;  } ?>
		</tbody>

	</table>

	<p class="copyright">
		<?php echo ELAdmin::footer( ); ?>
	</p>

	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="view" value="archive" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="archive" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
</form>
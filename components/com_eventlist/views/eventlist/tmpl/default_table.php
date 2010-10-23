<?php
/**
 * @version 0.9 $Id: default_table.php 507 2008-01-03 15:48:34Z schlu $
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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<script language="javascript" type="text/javascript">

	function tableOrdering( order, dir, view )
	{
		var form = document.adminForm;

		form.filter_order.value 	= order;
		form.filter_order_Dir.value	= dir;
		document.adminForm.submit( view );
	}
</script>

<form action="<?php echo JRoute::_('index.php') ?>" method="post" name="adminForm">

<?php if ($this->params->get('filter') || $this->params->get('display')) : ?>
<div id="el_filter" class="floattext">
		<?php if ($this->params->get('filter')) : ?>
		<div class="el_fleft">
			<?php
			echo '<label for="filter_type">'.JText::_('Filter').'</label>&nbsp;';
			echo $this->lists['filter_type'].'&nbsp;';
			?>
			<input type="text" name="filter" id="filter" value="<?php echo $this->lists['filter'];?>" class="text_area" onchange="document.adminForm.submit();" />
			<button onclick="document.adminForm.submit();"><?php echo JText::_( 'Go' ); ?></button>
			<button onclick="document.getElementById('filter').value='';document.adminForm.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		</div>
		<?php endif; ?>
		<?php if ($this->params->get('display')) : ?>
		<div class="el_fright">
			<?php
			echo '<label for="limit">'.JText::_('Display Num').'</label>&nbsp;';
			echo $this->pageNav->getLimitBox();
			?>
		</div>
		<?php endif; ?>
</div>
<?php endif; ?>

<table width="<?php echo $this->elsettings->tablewidth; ?>" border="0" cellspacing="0" cellpadding="0" summary="eventlist">
	<thead>
			<tr>
				<th id="el_date" width="<?php echo $this->elsettings->datewidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->datename), 'a.dates', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				if ($this->elsettings->showtitle == 1) :
				?>
				<th id="el_title" width="<?php echo $this->elsettings->titlewidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->titlename), 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				endif;
				if ($this->elsettings->showlocate == 1) :
				?>
				<th id="el_location" width="<?php echo $this->elsettings->locationwidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->locationname), 'l.venue', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				endif;
				if ($this->elsettings->showcity == 1) :
				?>
				<th id="el_city" width="<?php echo $this->elsettings->citywidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->cityname), 'l.city', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				endif;
				if ($this->elsettings->showstate == 1) :
				?>
				<th id="el_state" width="<?php echo $this->elsettings->statewidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->statename), 'l.state', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				endif;
				if ($this->elsettings->showcat == 1) :
				?>
				<th id="el_category" width="<?php echo $this->elsettings->catfrowidth; ?>" class="sectiontableheader" align="left"><?php echo JHTML::_('grid.sort', $this->escape($this->elsettings->catfroname), 'c.catname', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
				<?php
				endif;
				?>
			</tr>
	</thead>
	<tbody>
	<?php
	if ($this->noevents == 1) :
		?>
		<tr align="center"><td><?php echo JText::_( 'NO EVENTS' ); ?></td></tr>
		<?php
	else :

	$this->rows =& $this->getRows();

	foreach ($this->rows as $row) :
		?>
  			<tr class="sectiontableentry<?php echo ($row->odd +1 ) . $this->params->get( 'pageclass_sfx' ); ?>" >

    			<td headers="el_date" width="<?php echo $this->elsettings->datewidth; ?>" align="left">
    				<strong><?php echo $row->displaydate; ?></strong>
					<?php
					if ($this->elsettings->showtime == 1) :
						echo $row->displaytime;
					endif;
					?>
				</td>

				<?php
				//Link to details
				$detaillink = JRoute::_( 'index.php?view=details&id='. $row->slug );
				//title
				if (($this->elsettings->showtitle == 1 ) && ($this->elsettings->showdetails == 1) ) :
				?>

				<td headers="el_title" width="<?php echo $this->elsettings->titlewidth; ?>" align="left" valign="top"><a href="<?php echo $detaillink ; ?>"> <?php echo $this->escape($row->title); ?></a></td>

				<?php
				endif;

				if (( $this->elsettings->showtitle == 1 ) && ($this->elsettings->showdetails == 0) ) :
				?>

				<td headers="el_title" width="<?php echo $this->elsettings->titlewidth; ?>" align="left" valign="top"><?php echo $this->escape($row->title); ?></td>

				<?php
				endif;
				if ($this->elsettings->showlocate == 1) :
				?>

					<td headers="el_location" width="<?php echo $this->elsettings->locationwidth; ?>" align="left" valign="top">
						<?php
						if ($this->elsettings->showlinkvenue == 1 ) :
							echo $row->locid != 0 ? "<a href='".JRoute::_('index.php?view=venueevents&id='.$row->venueslug)."'>".$this->escape($row->venue)."</a>" : '-';
						else :
							echo $row->locid ? $this->escape($row->venue) : '-';
						endif;
						?>
					</td>

				<?php
				endif;

				if ($this->elsettings->showcity == 1) :
				?>

					<td headers="el_city" width="<?php echo $this->elsettings->citywidth; ?>" align="left" valign="top"><?php echo $row->city ? $this->escape($row->city) : '-'; ?></td>

				<?php
				endif;

				if ($this->elsettings->showstate == 1) :
				?>

					<td headers="el_state" width="<?php echo $this->elsettings->statewidth; ?>" align="left" valign="top"><?php echo $row->state ? $this->escape($row->state) : '-'; ?></td>

				<?php
				endif;

				if ($this->elsettings->showcat == 1) :
					if ($this->elsettings->catlinklist == 1) :
					?>

						<td headers="el_category" width="<?php echo $this->elsettings->catfrowidth; ?>" align="left" valign="top">
							<a href="<?php echo JRoute::_('index.php?view=categoryevents&id='.$row->categoryslug); ?>">
								<?php echo $row->catname ? $this->escape($row->catname) : '-' ; ?>
							</a>
						</td>

					<?php else : ?>

						<td headers="el_category" width="<?php echo $this->elsettings->catfrowidth; ?>" align="left" valign="top">
							<?php echo $row->catname ? $this->escape($row->catname) : '-'; ?>
						</td>

				<?php
					endif;
				endif;
				?>

			</tr>

  		<?php
		endforeach;
		endif;
		?>

	</tbody>
</table>
<br />
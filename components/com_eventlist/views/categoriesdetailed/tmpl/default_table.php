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

<table width="<?php echo $this->elsettings->tablewidth; ?>" border="0" cellspacing="0" cellpadding="0" summary="eventlist">
<thead>
			<tr>
				<th id="el_date_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->datewidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->datename); ?></th>
				<?php
				if ($this->elsettings->showtitle == 1) :
				?>
				<th id="el_title_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->titlewidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->titlename); ?></th>
				<?php
				endif;
				if ($this->elsettings->showlocate == 1) :
				?>
				<th id="el_location_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->locationwidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->locationname); ?></th>
				<?php
				endif;
				if ($this->elsettings->showcity == 1) :
				?>
				<th id="el_city_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->citywidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->cityname); ?></th>
				<?php
				endif;
				if ($this->elsettings->showstate == 1) :
				?>
				<th id="el_state_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->statewidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->statename); ?></th>
				<?php
				endif;
				if ($this->elsettings->showcat == 1) :
				?>
				<th id="el_category_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->catfrowidth; ?>" class="sectiontableheader" align="left"><?php echo $this->escape($this->elsettings->catfroname); ?></th>
				<?php
				endif;
				?>
			</tr>
</thead>

<tbody>
	<?php
	$this->rows = $this->getRows();
	if (!$this->rows) :
	?>
		<tr class="no_events"><td><?php echo JText::_( 'NO EVENTS' ); ?></td></tr>
		<?php
	else :

	foreach ($this->rows as $row) :
		?>
  			<tr class="sectiontableentry<?php echo ($row->odd +1 ) . $this->params->get( 'pageclass_sfx' ); ?>" >
    			<td headers="el_date_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->datewidth; ?>" align="left">
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
				<td headers="el_title_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->titlewidth; ?>" align="left" valign="top"><a href="<?php echo $detaillink ; ?>"> <?php echo $this->escape($row->title); ?></a></td>
				<?php
				endif;
				if (( $this->elsettings->showtitle == 1 ) && ($this->elsettings->showdetails == 0) ) :
				?>
				<td headers="el_title_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->titlewidth; ?>" align="left" valign="top"><?php echo $this->escape($row->title); ?></td>
				<?php
				endif;

				if ($this->elsettings->showlocate == 1) :
				?>
					<td headers="el_location_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->locationwidth; ?>" align="left" valign="top">
				<?php
					if ($this->elsettings->showlinkvenue == 1 ) :
							echo $row->locid != 0 ? "<a href='".JRoute::_("index.php?view=venueevents&sid=$row->venueslug")."'>".$this->escape($row->venue)."</a>" : '-';
						else :
							echo $row->locid ? $this->escape($row->venue) : '-';
						endif;
				?>
					</td>
				<?php
				endif;
				if ($this->elsettings->showcity == 1) :
				?>
					<td headers="el_city_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->citywidth; ?>" align="left" valign="top"><?php echo $row->city ? $this->escape($row->city) : '-'; ?></td>
				<?php
				endif;

				if ($this->elsettings->showstate == 1) :
				?>
					<td headers="el_state_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->statewidth; ?>" align="left" valign="top"><?php echo $row->state ? $this->escape($row->state) : '-'; ?></td>
				<?php
				endif;

				if ($this->elsettings->showcat == 1) :
					if ($this->elsettings->catlinklist == 1) :
					?>
						<td headers="el_category_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->catfrowidth; ?>" align="left" valign="top">
							<a href="<?php echo JRoute::_('index.php?view=categoryevents&id='.$row->categoryslug) ; ?>">
								<?php echo $row->catname ? $this->escape($row->catname) : '-' ; ?>
							</a>
						</td>
					<?php else : ?>
						<td headers="el_category_cat<?php echo $this->categoryid; ?>" width="<?php echo $this->elsettings->catfrowidth; ?>" align="left" valign="top">
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
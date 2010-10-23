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
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
		  	<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
		</tr>
	</table>
	<br />
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
			<table class="adminlist">
				<tr>
					<td>
						<div id="cpanel">
						<?php
						global $option;

						$link = 'index.php?option='.$option.'&amp;view=events';
						EventListViewEventList::quickiconButton( $link, 'icon-48-events.png', JText::_( 'EVENTS' ) );

						$link = 'index.php?option='.$option.'&amp;view=event';
						EventListViewEventList::quickiconButton( $link, 'icon-48-eventedit.png', JText::_( 'ADD EVENT' ) );

						$link = 'index.php?option='.$option.'&amp;view=venues';
						EventListViewEventList::quickiconButton( $link, 'icon-48-venues.png', JText::_( 'VENUES' ) );

						$link = 'index.php?option='.$option.'&amp;view=venue';
						EventListViewEventList::quickiconButton( $link, 'icon-48-venuesedit.png', JText::_( 'ADD VENUE' ) );

						$link = 'index.php?option='.$option.'&amp;view=categories';
						EventListViewEventList::quickiconButton( $link, 'icon-48-categories.png', JText::_( 'CATEGORIES' ) );

						$link = 'index.php?option='.$option.'&amp;view=category';
						EventListViewEventList::quickiconButton( $link, 'icon-48-categoriesedit.png', JText::_( 'ADD CATEGORY' ) );

						$link = 'index.php?option='.$option.'&amp;view=groups';
						EventListViewEventList::quickiconButton( $link, 'icon-48-groups.png', JText::_( 'GROUPS' ) );

						$link = 'index.php?option='.$option.'&amp;view=group';
						EventListViewEventList::quickiconButton( $link, 'icon-48-groupedit.png', JText::_( 'ADD GROUP' ) );

						$link = 'index.php?option='.$option.'&amp;view=archive';
						EventListViewEventList::quickiconButton( $link, 'icon-48-archive.png', JText::_( 'ARCHIVE' ) );

						//only admins should be able to see this items
						if ($this->user->get('gid') > 24) {
							$link = 'index.php?option='.$option.'&amp;controller=settings&amp;task=edit';
							EventListViewEventList::quickiconButton( $link, 'icon-48-settings.png', JText::_( 'SETTINGS' ) );

							$link = 'index.php?option='.$option.'&amp;view=editcss';
							EventListViewEventList::quickiconButton( $link, 'icon-48-cssedit.png', JText::_( 'EDIT CSS' ) );

							$link = 'index.php?option='.$option.'&amp;view=cleanup';
							EventListViewEventList::quickiconButton( $link, 'icon-48-housekeeping.png', JText::_( 'CLEANUP' ) );
						}

						$link = 'index.php?option='.$option.'&amp;view=help';
						EventListViewEventList::quickiconButton( $link, 'icon-48-help.png', JText::_( 'HELP' ) );

						$link = 'index.php?option='.$option.'&amp;view=updatecheck';
						EventListViewEventList::quickiconButton( $link, 'icon-48-update.png', JText::_( 'UPDATE CHECK' ), 1 );
						
						$link = 'index.php?option='.$option.'&amp;controller=sampledata&amp;task=load';
						EventListViewEventList::quickiconButton( $link, 'icon-48-sampledata.png', JText::_( 'LOAD SAMPLE DATA' ) );
						?>
						</div>
					</td>
				</tr>
			</table>
			</td>
			<td valign="top" width="320px" style="padding: 7px 0 0 5px">
			<?php
			$title = JText::_( 'EVENT STATS' );
			echo $this->pane->startPane( 'stat-pane' );
			echo $this->pane->startPanel( $title, 'events' );

				?>
				<table class="adminlist">
					<tr>
						<td>
							<?php echo JText::_( 'EVENTS PUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->events[0]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'EVENTS UNPUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->events[1]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'EVENTS ARCHIVED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->events[2]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'EVENTS TOTAL' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->events[3]; ?></b>
						</td>
					</tr>
				</table>
				<?php

				$title = JText::_( 'VENUE STATS' );
				echo $this->pane->endPanel();
				echo $this->pane->startPanel( $title, 'venues' );

				?>
				<table class="adminlist">
					<tr>
						<td>
							<?php echo JText::_( 'VENUES PUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->venue[0]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'VENUES UNPUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->venue[1]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'VENUES TOTAL' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->venue[2]; ?></b>
						</td>
					</tr>
				</table>
				<?php

				$title = JText::_( 'CATEGORY STATS' );
				echo $this->pane->endPanel();
				echo $this->pane->startPanel( $title, 'categories' );

				?>
				<table class="adminlist">
					<tr>
						<td>
							<?php echo JText::_( 'CATEGORIES PUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->category[0]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'CATEGORIES UNPUBLISHED' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->category[1]; ?></b>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo JText::_( 'CATEGORIES TOTAL' ).': '; ?>
						</td>
						<td>
							<b><?php echo $this->category[2]; ?></b>
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

	<p class="copyright">
		<?php echo ELAdmin::footer( ); ?>
	</p>
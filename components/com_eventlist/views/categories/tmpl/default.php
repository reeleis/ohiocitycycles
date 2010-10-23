<?php
/**
 * @version 0.9 $Id: default.php 428 2007-10-04 14:18:57Z schlu $
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
<div id="eventlist" class="el_categoriesview">
<p class="buttons">
	<?php
		echo ELOutput::submitbutton( $this->dellink, $this->params, 'categories' );
		echo ELOutput::archivebutton( $this->elsettings->oldevent, $this->params, $this->task );
	?>
</p>

<?php if ($this->params->def( 'show_pagepage_title', 1 )) : ?>
	<h1 class="componentheading">
		<?php echo $this->escape($this->pagetitle); ?>
	</h1>
<?php endif; ?>

<?php foreach ($this->rows as $row) : ?>

<div class="floattext">
	<h2 class="eventlist cat<?php echo $row->id; ?>">
		<?php echo $this->escape($row->catname); ?>
	</h2>

	<div class="catimg">
	  	<?php
			echo JHTML::_('link', JRoute::_($this->urlfragment.$row->slug), $row->image);
		?>
		<p>
			<?php
			echo JText::_( 'EVENTS' ).': ';
			echo JHTML::_('link', JRoute::_($this->urlfragment.$row->slug), $row->assignedevents);
			?>
		</p>
	</div>

	<div class="catdescription cat<?php echo $row->id; ?>"><?php echo $row->catdescription ; ?>
	<p>
		<?php
		if ($this->task == 'archive') :
			echo JHTML::_('link', JRoute::_($this->urlfragment.$row->slug), JText::_( 'SHOW ARCHIVE' ));
		else :
			echo JHTML::_('link', JRoute::_($this->urlfragment.$row->slug), JText::_( 'SHOW EVENTS' ));
		endif;
		?>
	</p>
	</div>

</div>
<?php endforeach; ?>

<!--pagination-->
<p class="pageslinks">
	<?php echo $this->pageNav->getPagesLinks($this->navlink); ?>
</p>

<p class="pagescounter">
	<?php echo $this->pageNav->getPagesCounter(); ?>
</p>

<!--copyright-->

<p class="copyright">
	<?php echo ELOutput::footer( ); ?>
</p>
</div>
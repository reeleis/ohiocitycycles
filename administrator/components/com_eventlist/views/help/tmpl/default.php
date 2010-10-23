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

<table class="adminlist" width="100%">
	<tr>
		<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
		<td class="sectionname" align="right" width="100%"><font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">::<?php echo JText::_( 'HELP' ); ?>::</font></td>
	</tr>
</table>

<br />

<form action="index.php" method="post" name="adminForm">
<table border="1" class="adminform">
	<tr>
		<td colspan="2">
			<table width="100%">
				<tr>
					<td>
						<strong><?php echo JText::_( 'Search' ); ?></strong>
						<input class="text_area" type="hidden" name="option" value="com_eventlist" />
						<input type="text" name="search" id="search" value="<?php echo $this->helpsearch;?>" class="inputbox" />
						<input type="submit" value="<?php echo JText::_( 'Go' ); ?>" class="button" />
						<input type="button" value="<?php echo JText::_( 'Reset' ); ?>" class="button" onclick="f=document.adminForm;f.search.value='';f.submit()" />
					</td>
					<td style="text-align:right">
						<a href="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/el.intro.html'; ?>" target='helpFrame'><?php echo JText::_( 'HOME' ); ?></a>
						|
						<a href="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/helpsite/el.gethelp.html'; ?>" target='helpFrame'><?php echo JText::_( 'GET HELP' ); ?></a>
						|
						<a href="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/helpsite/el.givehelp.html'; ?>" target='helpFrame'><?php echo JText::_( 'GIVE HELP' ); ?></a>
						|
						<a href="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/helpsite/el.credits.html'; ?>" target='helpFrame'><?php echo JText::_( 'CREDITS' ); ?></a>
						|
						<a href="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/helpsite/el.changelog.html'; ?>" target='helpFrame'><?php echo JText::_( 'CHANGELOG' ); ?></a>
						|
						<?php echo JHTML::_('link', 'http://www.gnu.org/licenses/gpl-2.0.html', JText::_( 'LICENSE' ), array('target' => 'helpFrame')) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
	<tr valign="top">
		<td align="left">

			<?php
			echo $this->pane->startPane("det-pane");
			$title = JText::_( 'SCREEN HELP' );
			echo $this->pane->startPanel( $title, 'registra' );
			?>
			<table class="adminlist">
				<?php
				foreach ($this->toc as $k=>$v) {
					echo '<tr>';
					echo '<td>';
					echo JHTML::Link('components/com_eventlist/help/'.$this->langTag.'/'.$k, $v, array('target' => 'helpFrame'));
					echo '</td>';
					echo '</tr>';
				}
				?>
			</table>

			<?php
			echo $this->pane->endPanel();
			echo $this->pane->endPane();
		  	?>
		</td>
		<td width="75%">
			<iframe name="helpFrame" src="<?php echo 'components/com_eventlist/help/'.$this->langTag.'/el.intro.html'; ?>" class="helpFrame" frameborder="0"></iframe>
		</td>
	</tr>
</table>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="view" value="help" />
<input type="hidden" name="task" value="" />

</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<?php
//keep session alive
JHTML::_('behavior.keepalive');
?>
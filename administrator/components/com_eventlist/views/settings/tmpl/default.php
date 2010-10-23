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

<form action="index.php" method="post" name="adminForm">
	  	<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
				<td class="sectionname" align="right" width="100%"><font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">::<?php echo JText::_( 'SETTINGS' ); ?>::</font></td>
			</tr>
 	 	</table>
 	 	<br />

    	<div id="elconfig-document">
			<div id="page-basic">
				<?php require_once(dirname(__FILE__).DS.'el.settings_basic.html'); ?>
			</div>

			<div id="page-usercontrol">
				<?php require_once(dirname(__FILE__).DS.'el.settings_usercontrol.html'); ?>
			</div>

			<div id="page-details">
				<?php require_once(dirname(__FILE__).DS.'el.settings_detailspage.html'); ?>
			</div>

			<div id="page-layout">
				<?php require_once(dirname(__FILE__).DS.'el.settings_layout.html'); ?>
			</div>

			<div id="page-parameters">
				<?php require_once(dirname(__FILE__).DS.'el.settings_parameters.html'); ?>
			</div>
		</div>
		<div class="clr"></div>

		<?php echo JHTML::_( 'form.token' ); ?>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="id" value="1">
		<input type="hidden" name="lastupdate" value="<?php echo $this->elsettings->lastupdate; ?>">
		<input type="hidden" name="option" value="com_eventlist">
		<input type="hidden" name="controller" value="settings">
		</form>

		<p class="copyright">
			<?php echo ELAdmin::footer( ); ?>
		</p>
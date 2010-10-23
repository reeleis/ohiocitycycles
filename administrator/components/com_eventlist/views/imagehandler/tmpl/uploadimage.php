<?php
/**
 * @version 0.9 $Id: uploadimage.php 507 2008-01-03 15:48:34Z schlu $
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

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<form method="post" action="<?php echo $this->request_url; ?>" enctype="multipart/form-data" name="adminForm">

<table class="adminlist">
	<tr>
  		<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
  		<td class="sectionname" align="right"><font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">::<?php echo JText::_( 'UPLOAD IMAGE' ); ?>::</font></td>
	</tr>
</table>

<table class="noshow">
  	<tr>
		<td width="50%" valign="top">
		
				<?php if($this->ftp): ?>
				<fieldset class="adminform">
					<legend><?php echo JText::_('FTP TITLE'); ?></legend>

					<?php echo JText::_('FTP DESC'); ?>
					
					<?php if(JError::isError($this->ftp)): ?>
						<p><?php echo JText::_($this->ftp->message); ?></p>
					<?php endif; ?>

					<table class="adminform nospace">
						<tbody>
							<tr>
								<td width="120">
									<label for="username"><?php echo JText::_('USERNAME'); ?>:</label>
								</td>
								<td>
									<input type="text" id="username" name="username" class="input_box" size="70" value="" />
								</td>
							</tr>
							<tr>
								<td width="120">
									<label for="password"><?php echo JText::_('PASSWORD'); ?>:</label>
								</td>
								<td>
									<input type="password" id="password" name="password" class="input_box" size="70" value="" />
								</td>
							</tr>
						</tbody>
					</table>
				</fieldset>
			<?php endif; ?>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'SELECT IMAGE UPLOAD' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td>
 							<input class="inputbox" name="userfile" id="userfile" type="file" />
							<br /><br />
							<input class="button" type="submit" value="<?php echo JText::_('UPLOAD') ?>" name="adminForm" />
    			       	</td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
        <td width="50%" valign="top">

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'ATTENTION' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td>
 							<b><?php
 							echo JText::_( 'TARGET DIRECTORY' ).':'; ?></b>
							<?php
							if ($this->task == 'venueimg') {
								echo "/images/eventlist/venues/";
								$this->task = 'venueimgup';
							} else {
								echo "/images/eventlist/events/";
								$this->task = 'eventimgup';
							}

							?><br />
							<b><?php echo JText::_( 'IMAGE FILESIZE' ).':'; ?></b> <?php echo $this->elsettings->sizelimit; ?> kb<br />

							<?php
							if ( $this->elsettings->gddisabled ) {

								if (imagetypes() & IMG_PNG) {
									echo "<br /><font color='green'>".JText::_( 'PNG SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'NO PNG SUPPORT' )."</font>";
								}
								if (imagetypes() & IMG_JPEG) {
									echo "<br /><font color='green'>".JText::_( 'JPG SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'NO JPG SUPPORT' )."</font>";
								}
								if (imagetypes() & IMG_GIF) {
									echo "<br /><font color='green'>".JText::_( 'GIF SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'NO GIF SUPPORT' )."</font>";
								}
							} else {
								echo "<br /><font color='green'>".JText::_( 'PNG SUPPORT' )."</font>";
								echo "<br /><font color='green'>".JText::_( 'JPG SUPPORT' )."</font>";
								echo "<br /><font color='green'>".JText::_( 'GIF SUPPORT' )."</font>";
							}
							?>
    			       	</td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
	</tr>
</table>

<?php if ( $this->elsettings->gddisabled ) { ?>

<table class="noshow">
	<tr>
		<td>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'ATTENTION' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td align="center">
							<?php echo JText::_( 'GD WARNING' ); ?>
    			     	 </td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
	</tr>
</table>

<?php } ?>

<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="imagehandler" />
<input type="hidden" name="task" value="<?php echo $this->task;?>" />
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>
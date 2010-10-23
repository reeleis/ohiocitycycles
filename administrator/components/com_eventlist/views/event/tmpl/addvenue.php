<?php
/**
 * @version 0.9 $Id: addvenue.php 507 2008-01-03 15:48:34Z schlu $
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
	function submitbutton(task)
	{
		var form = document.adminForm;

		if (form.venue.value == ""){
			alert( "<?php echo JText::_( 'ADD VENUE' ); ?>" );
			form.venue.focus();
		} else if (form.city.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'ADD CITY' ); ?>" );
			form.city.focus();
		} else if (form.street.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'ADD STREET' ); ?>" );
			form.street.focus();
		} else if (form.plz.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'ADD ZIP' ); ?>" );
			form.plz.focus();
		} else if (form.country.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'ADD COUNTRY' ); ?>" );
			form.country.focus();
		} else {
			<?php
			echo $this->editor->save( 'locdescription' );
			?>
			submitform( task );
			//window.parent.close();
		}
	}
</script>

<?php
//Set the info image
$infoimage = JHTML::_('image', '../components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );
?>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">


<table class="adminform" width="100%">
	<tr>
		<td>
			<div style="float: left;">
				<label for="venue">
					<?php echo JText::_( 'VENUE' ).':'; ?>
				</label>
				<input name="venue" value="" size="55" maxlength="50" />
					&nbsp;&nbsp;&nbsp;
			</div>

			<div style="float: right;">
				<button type="button" onclick="submitbutton('addvenue')">
					<?php echo JText::_('SAVE') ?>
				</button>
				<button type="button" onclick="window.parent.close()" />
					<?php echo JText::_('CANCEL') ?>
				</button>
			</div>
		</td>
	</tr>
</table>

<br />

<fieldset>
<legend><?php echo JText::_('VARIOUS'); ?></legend>
<table>
	<tr>
		<td>
			<label for="publish">
				<?php echo JText::_( 'PUBLISHED' ).':'; ?>
			</label>
		</td>
		<td>
			<?php
			$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->published );
			echo $html;
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="locimage">
				<?php echo JText::_( 'CHOOSE IMAGE' ).':'; ?>
			</label>
		</td>
		<td>
			<?php echo $this->imageselect; ?>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<script language="javascript" type="text/javascript">
			if (document.forms[0].a_imagename.value!=''){
				var imname = document.forms[0].a_imagename.value;
				jsimg='../images/eventlist/venues/' + imname;
			} else {
				jsimg='../images/M_images/blank.png';
			}
			document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="Preview" />');
			</script>
			<br />
			<br />
		</td>
	</tr>
</table>
</fieldset>

<fieldset>
	<legend><?php echo JText::_('ADDRESS'); ?></legend>
	<table class="adminform" width="100%">
		<tr>
  			<td><?php echo JText::_( 'STREET' ).':'; ?></td>
			<td><input name="street" value="" size="55" maxlength="50" /></td>
	 	</tr>
  		<tr>
  		  	<td><?php echo JText::_( 'ZIP' ).':'; ?></td>
  		  	<td><input name="plz" value="" size="15" maxlength="10" /></td>
	  	</tr>
  		<tr>
  			<td><?php echo JText::_( 'CITY' ).':'; ?></td>
  			<td><input name="city" value="" size="55" maxlength="50" />
			</td>
  		</tr>
  		<tr>
  			<td><?php echo JText::_( 'STATE' ).':'; ?></td>
  			<td><input name="state" value="" size="55" maxlength="50" />
			</td>
  		</tr>
  		<tr>
  		  	<td><?php echo JText::_( 'COUNTRY' ).':'; ?></td>
  		  	<td>
				<input name="country" value="" size="4" maxlength="3" />&nbsp;
				<span class="editlinktip hasTip" title="<?php echo JText::_('NOTES'); ?>::<?php echo JText::_( 'COUNTRY HINT' ); ?>">
					<?php echo $infoimage; ?>
				</span>
			</td>
		</tr>
  		<tr>
    		<td><?php echo JText::_( 'WEBSITE' ).':'; ?></td>
    		<td>
    			<input name="url" value="" size="55" maxlength="50" />&nbsp;
    			<span class="editlinktip hasTip" title="<?php echo JText::_('NOTES'); ?>::<?php echo JText::_( 'WEBSITE HINT' ); ?>">
					<?php echo $infoimage; ?>
				</span>
    		</td>
  		</tr>
  		<?php if ( $this->elsettings->showmapserv != 0 ) { ?>
		<tr>
			<td>
				<label for="map">
					<?php echo JText::_( 'ENABLE MAP' ).':'; ?>
				</label>
			</td>
			<td>
				<?php
          			echo JHTML::_('select.booleanlist', 'map', 'class="inputbox"', 0 );
          		?>
          		&nbsp;
          		<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ADDRESS NOTICE'); ?>">
					<?php echo $infoimage; ?>
				</span>
			</td>
		</tr>
		<?php } ?>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo JText::_('DESCRIPTION'); ?></legend>
		<?php echo $this->editor->display('locdescription', '', '655', '400', '70', '15', false); ?>
</fieldset>

<fieldset>
	<table>
		<tr>
			<td valign="top">
				<label for="metadesc">
					<?php echo JText::_( 'META DESCRIPTION' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_description" id="metadesc" style="width:300px;"></textarea>
			</td>
			<td valign="top">
				<label for="metakey">
					<?php echo JText::_( 'META KEYWORDS' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_keywords" id="metakey" style="width:300px;"></textarea>
				<br />
				<input type="button" class="button" value="<?php echo JText::_( 'ADD VENUE CITY' ); ?>" onclick="f=document.adminForm;f.metakey.value=f.venue.value+', '+f.city.value+f.metakey.value;" />
			</td>
		</tr>
	</table>
</fieldset>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="venues" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="task" value="" />
</form>
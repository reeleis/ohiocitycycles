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

<script language="javascript" type="text/javascript">
	function submitbutton(task)
	{

		var form = document.adminForm;

		if (task == 'cancel') {
			submitform( task );
		} else if (form.dates.value == ""){
			alert( "<?php echo JText::_( 'ADD DATE'); ?>" );
		} else if (form.title.value == ""){
			alert( "<?php echo JText::_( 'ADD TITLE'); ?>" );
			form.title.focus();
		} else if (!form.dates.value.match(/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/gi)) {
			alert("<?php echo JText::_( 'DATE WRONG'); ?>");
		} else if (form.enddates.value !="" && !form.enddates.value.match(/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/gi)) {
			alert("<?php echo JText::_( 'ENDDATE WRONG'); ?>");
		} else if (form.times.value == "" && form.endtimes.value != "") {
			alert("<?php echo JText::_( 'ADD TIME'); ?>");
			form.times.focus();
		} else if (form.times.value != "" && !form.times.value.match(/[0-2][0-9]:[0-5][0-9]/gi)) {
			alert("<?php echo JText::_( 'TIME WRONG'); ?>");
			form.times.focus();
		} else if (form.endtimes.value != "" && !form.endtimes.value.match(/[0-2][0-9]:[0-5][0-9]/gi)) {
			alert("<?php echo JText::_( 'TIME WRONG'); ?>");
			form.endtimes.focus();
		} else if (form.catsid.value == "0"){
			alert( "<?php echo JText::_( 'CHOOSE CATEGORY'); ?>" );
		} else if (form.locid.value == ""){
			alert( "<?php echo JText::_( 'CHOOSE VENUE'); ?>" );
		} else {
			<?php
			echo $this->editor->save( 'datdescription' );
			?>
			submitform( task );
		}
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<table class="adminlist">
	<tr>
		<td><img src="components/com_eventlist/assets/images/evlogo.png" height="108" width="250" alt="Event List Logo" align="left" /></td>
		<td class="sectionname" align="right" width="100%">
		  	<font style="color: #C24733; font-size : 18px; font-weight: bold; text-align: left;">
		  	<?php
		  	if ($this->task == 'copy') {
		  		echo '::'.JText::_( 'COPY EVENT').'::';
		  	} else {
		  		echo $this->row->id ? '::'.JText::_( 'EDIT EVENT').'::' : '::'.JText::_( 'ADD EVENT').'::';
		  	}
			?>
			</font>
		</td>
	</tr>
</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="adminform">
	<tr>
		<td valign="top">
			<table class="adminform">
				<tr>
					<td>
						<label for="title">
							<?php echo JText::_( 'EVENT TITLE' ).':'; ?>
						</label>
					</td>
					<td>
						<input class="inputbox" name="title" value="<?php echo $this->row->title; ?>" size="50" maxlength="100" id="title" />
					</td>
					<td>
						<label for="published">
							<?php echo JText::_( 'PUBLISHED' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						$html = JHTML::_('select.booleanlist', 'published', '', $this->row->published );
						echo $html;
						?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="alias">
							<?php echo JText::_( 'Alias' ).':'; ?>
						</label>
					</td>
					<td colspan="3">
						<input class="inputbox" type="text" name="alias" id="alias" size="50" maxlength="100" value="<?php echo $this->row->alias; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="venueid">
							<?php echo JText::_( 'VENUE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						echo $this->venueselect;
						?>
					</td>
					<td>
						<label for="catid">
							<?php echo JText::_( 'CATEGORY' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						echo $this->Lists['category']
						?>
					</td>
				</tr>
			</table>

			<table class="adminform">
				<tr>
					<td>
						<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols, buttons
						echo $this->editor->display( 'datdescription',  $this->row->datdescription, '100%;', '550', '75', '20', array('pagebreak', 'readmore') ) ;
						?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top" width="320px" style="padding: 7px 0 0 5px">
			<?php
			$title = JText::_( 'DETAILS' );
			echo $this->pane->startPane("det-pane");
			echo $this->pane->startPanel( $title, 'date' );

			//Set the info image
			$infoimage = JHTML::image('components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );
			?>
			<table>
				<tr>
					<td>
						<label for="dates">
							<?php echo JText::_( 'DATE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo JHTML::_('calendar', $this->row->dates, "dates", "dates"); ?>
           			</td>
            		<td>
            			<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>">
							<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="enddates">
						<?php echo JText::_( 'ENDDATE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo JHTML::_('calendar', $this->row->enddates, "enddates", "enddates"); ?>
           			</td>
          		 	<td>
						<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>">
							<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="times">
							<?php echo JText::_( 'EVENT TIME' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						if ($this->row->times) {
							$this->row->times = substr($this->row->times, 0, 5);
						}
						?>
						<input class="inputbox" name="times" value="<?php echo $this->row->times; ?>" size="15" maxlength="8" id="times" />
					</td>
					<td>
			  			<?php if ( $this->elsettings->showtime == 1 ) { ?>
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME'); ?>">
								<?php echo $infoimage; ?>
							</span>
			  			<?php } else { ?>
			  				<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME OPTIONAL'); ?>">
								<?php echo $infoimage; ?>
							</span>
			  			<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="endtimes">
							<?php echo JText::_( 'END TIME' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						if ($this->row->endtimes) {
							$this->row->endtimes = substr($this->row->endtimes, 0, 5);
						}
						?>
						<input class="inputbox" name="endtimes" value="<?php echo $this->row->endtimes; ?>" size="15" maxlength="8" id="endtimes" />
					</td>
					<td>
			  			<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME OPTIONAL'); ?>">
							<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'REGISTRATION' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'registra' );
			?>
			<table>
				<tr>
					<td>
						<label for="registra">
							<?php echo JText::_( 'ENABLE REGISTRATION' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						$html = JHTML::_('select.booleanlist', 'registra', '', $this->row->registra );
						echo $html;
						?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="unregistra">
							<?php echo JText::_( 'ENABLE UNREGISTRATION' ).':'; ?>
						</label>
					</td>
					<td>
						<?php
						$html = JHTML::_('select.booleanlist', 'unregistra', '', $this->row->unregistra );
						echo $html;
						?>
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'IMAGE' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'image' );
			?>
			<table>
				<tr>
					<td>
						<label for="image">
							<?php echo JText::_( 'CHOOSE IMAGE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo $this->imageselect; ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<img src="../images/M_images/blank.png" name="imagelib" id="imagelib" width="80" height="80" border="2" alt="Preview" />
						<script language="javascript" type="text/javascript">
						if (document.forms[0].a_imagename.value!=''){
							var imname = document.forms[0].a_imagename.value;
							jsimg='../images/eventlist/events/' + imname;
							document.getElementById('imagelib').src= jsimg;
						}
						</script>

						<br />
					</td>
				</tr>
			</table>
			<?php
			$title = JText::_( 'RECURRING EVENTS' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'recurrence' );
			?>


				<table width="100%">
					<tr>
						<td width="50%"><?php echo JText::_( 'RECURRENCE' ); ?>:</td>
						<td width="50%">
						  <select id="recurrence_select" name="recurrence_select" size="1">
						    <option value="0"><?php echo JText::_( 'NOTHING' ); ?></option>
						    <option value="1"><?php echo JText::_( 'DAYLY' ); ?></option>
						    <option value="2"><?php echo JText::_( 'WEEKLY' ); ?></option>
						    <option value="3"><?php echo JText::_( 'MONTHLY' ); ?></option>
						    <option value="4"><?php echo JText::_( 'WEEKDAY' ); ?></option>
						  </select>
						</td>
					</tr>
					<tr>
						<td colspan="2" id="recurrence_output">&nbsp;</td>
					</tr>
					<tr id="counter_row" style="display:none;">
						<td><?php echo JText::_( 'RECURRENCE COUNTER' ); ?>:</td>
						<td>
					        <?php echo JHTML::_('calendar', ($this->row->recurrence_counter <> 0000-00-00)? $this->row->recurrence_counter: JText::_( 'UNLIMITED' ), "recurrence_counter", "recurrence_counter"); ?>
					        <a href="#" onclick="include_unlimited('<?php echo JText::_( 'UNLIMITED' ); ?>'); return false;"><img src="../components/com_eventlist/assets/images/unlimited.png" width="16" height="16" alt="<?php echo JText::_( 'UNLIMITED' ); ?>" /></a>
						</td>
					<tr>
					<tr>
						<td><br/><br/><br/></td>
					</tr>
				</table>
			<br/>
			<input type="hidden" name="recurrence_number" id="recurrence_number" value="<?php echo $this->row->recurrence_number; ?>" />
			<input type="hidden" name="recurrence_type" id="recurrence_type" value="<?php echo $this->row->recurrence_type; ?>" />
			<script type="text/javascript">
			<!--
				var $select_output = new Array();
				$select_output[1] = "<?php echo JText::_( 'OUTPUT DAY' ); ?>";
				$select_output[2] = "<?php echo JText::_( 'OUTPUT WEEK' ); ?>";
				$select_output[3] = "<?php echo JText::_( 'OUTPUT MONTH' ); ?>";
				$select_output[4] = "<?php echo JText::_( 'OUTPUT WEEKDAY' ); ?>";

				var $weekday = new Array();
				$weekday[0] = "<?php echo JText::_( 'MONDAY' ); ?>";
				$weekday[1] = "<?php echo JText::_( 'TUESDAY' ); ?>";
				$weekday[2] = "<?php echo JText::_( 'WEDNESDAY' ); ?>";
				$weekday[3] = "<?php echo JText::_( 'THURSDAY' ); ?>";
				$weekday[4] = "<?php echo JText::_( 'FRIDAY' ); ?>";
				$weekday[5] = "<?php echo JText::_( 'SATURDAY' ); ?>";
				$weekday[6] = "<?php echo JText::_( 'SUNDAY' ); ?>";

				var $before_last = "<?php echo JText::_( 'BEFORE LAST' ); ?>";
				var $last = "<?php echo JText::_( 'LAST' ); ?>";

				start_recurrencescript();
			-->
			</script>
			<?php
			$title = JText::_( 'METADATA INFORMATION' );
			echo $this->pane->endPanel();
			echo $this->pane->startPanel( $title, 'meta' );
			?>
			<table>
				<tr>
					<td>
						<input class="inputbox" type="button" onclick="insert_keyword('[title]')" value="<?php echo JText::_( 'EVENT TITLE' ); ?>" />
						<input class="inputbox" type="button" onclick="insert_keyword('[a_name]')" value="<?php echo JText::_( 'VENUE' ); ?>" />
						<input class="inputbox" type="button" onclick="insert_keyword('[catsid]')" value="<?php echo JText::_( 'CATEGORY' ); ?>" />
						<input class="inputbox" type="button" onclick="insert_keyword('[dates]')" value="<?php echo JText::_( 'DATE' ); ?>" />
						<p><input class="inputbox" type="button" onclick="insert_keyword('[times]')" value="<?php echo JText::_( 'EVENT TIME' ); ?>" />
						<input class="inputbox" type="button" onclick="insert_keyword('[enddates]')" value="<?php echo JText::_( 'ENDDATE' ); ?>" />
						<input class="inputbox" type="button" onclick="insert_keyword('[endtimes]')" value="<?php echo JText::_( 'END TIME' ); ?>" /></p>
						<br/>
						<label for="meta_keywords">
							<?php echo JText::_( 'META KEYWORDS' ).':'; ?>
						</label>
						<br />

						<?php
						if (!empty($this->row->meta_keywords)) {
							$meta_keywords = $this->row->meta_keywords;
						} else {
							$meta_keywords = $this->elsettings->meta_keywords;
						}
						?>

						<textarea class="inputbox" name="meta_keywords" id="meta_keywords" rows="5" cols="40" maxlength="150" onfocus="get_inputbox('meta_keywords')" onblur="change_metatags()"><?php echo $meta_keywords; ?></textarea>
				</td>
			<tr>
			<tr>
				<td>
					<label for="meta_description">
						<?php echo JText::_( 'META DESCRIPTION' ).':'; ?>
					</label>
					<br />
					<?php
					if (!empty($this->row->meta_description)) {
						$meta_description = $this->row->meta_description;
					} else {
						$meta_description = $this->elsettings->meta_description;
					}
					?>

					<textarea class="inputbox" name="meta_description" id="meta_description" rows="5" cols="40" maxlength="200" onfocus="get_inputbox('meta_description')" onblur="change_metatags()"><?php echo $meta_description; ?></textarea>
				</td>
			<tr>
			<!-- include the metatags end-->
		</table>
		<script type="text/javascript">
		<!--
			starter("<?php echo JText::_( 'META ERROR' ); ?>");	// da window.onload schon belegt wurde, wird die Funktion 'manuell' aufgerufen

			// the onsubmit - section
			document.adminForm.onsubmit = function() {		// the form - tag get a onsubmit attribute
				$("meta_keywords").value = $keywords;
				$("meta_description").value = $description;
				submit_unlimited();
			};
		-->
		</script>
		<?php
		echo $this->pane->endPanel();
		echo $this->pane->endPane(); ?>
		</td>
	</tr>
</table>

<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="events" />
<input type="hidden" name="view" value="event" />
<input type="hidden" name="task" value="" />
<?php if ($this->task == 'copy') { ?>
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="created" value="" />
	<input type="hidden" name="author_ip" value="" />
	<input type="hidden" name="created_by" value="" />
<?php } else { ?>
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
	<input type="hidden" name="created" value="<?php echo $this->row->created; ?>" />
	<input type="hidden" name="author_ip" value="<?php echo $this->row->author_ip; ?>" />
	<input type="hidden" name="created_by" value="<?php echo $this->row->created_by; ?>" />
<?php } ?>
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
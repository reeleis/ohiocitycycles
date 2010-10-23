<?php
/**
 * @version 0.9 $Id: default.php 517 2008-01-10 21:00:49Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENCE.php
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
defined('_JEXEC') or die('Restricted access');
?>

<script language="javascript" type="text/javascript">
		Window.onDomReady(function(){
			document.formvalidator.setHandler('date',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('[0-9]{4}-[0-1][0-9]-[0-3][0-9]','gi');
						return regexp[time].test(value);
					}
				}
			);
			document.formvalidator.setHandler('time',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}','gi');
						return regexp[time].test(value);
					}
				}
			);
			document.formvalidator.setHandler('venue',
				function (value) {
					timer = new Date();
					time = timer.getTime();
					regexp = new Array();
					regexp[time] = new RegExp('^[0-9]{1}[0-9]{0,}$');
					return regexp[time].test(value);
				}
			);
			document.formvalidator.setHandler('catsid',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('^[1-9]{1}[0-9]{0,}$');
						return regexp[time].test(value);
					}
				}
			);
		});

		function submitbutton( pressbutton ) {


			if (pressbutton == 'cancelevent' || pressbutton == 'addvenue') {
				submitform( pressbutton );
				return;
			}

			var form = document.adminForm;
			var validator = document.formvalidator;
			var title = $(form.title).getValue();
			title.replace(/\s/g,'');

			if ( title.length==0 ) {
   				alert("<?php echo JText::_( 'ADD TITLE', true ); ?>");
   				validator.handleResponse(false,form.title);
   				form.title.focus();
   				return false;
  			} else if ( form.dates.value=="" ) {
   				alert("<?php echo JText::_( 'ADD DATE', true ); ?>");
   				validator.handleResponse(false,form.dates);
   				form.dates.focus();
   				return false;
  			} else if ( validator.validate(form.dates) === false ) {
   				alert("<?php echo JText::_( 'DATE WRONG', true ); ?>");
   				validator.handleResponse(false,form.dates);
   				form.dates.focus();
   				return false;
  			} else if ( validator.validate(form.enddates) === false ) {
  				//alert(validator.validate(form.enddates));
  				alert("<?php echo JText::_( 'DATE WRONG', true ); ?>");
    			validator.handleResponse(false,form.enddates);
  				form.enddates.focus();
  				return false;
  			} else if ( validator.validate(form.times) === false ) {
    			alert("<?php echo JText::_( 'TIME WRONG', true ); ?>");
    			validator.handleResponse(false,form.times);
    			form.times.focus();
    			return false;
			} else if ( validator.validate(form.endtimes) === false ) {
  				alert("<?php echo JText::_( 'ENDTIME WRONG', true ); ?>");
    			validator.handleResponse(false,form.endtimes);
  				form.endtimes.focus();
  				return false;
			} else if ( validator.validate(form.catsid) === false ) {
    			alert("<?php echo JText::_( 'SELECT CATEGORY', true ); ?>");
    			validator.handleResponse(false,form.catsid);
    			form.catsid.focus();
    			return false;
  			} else if ( validator.validate(form.locid) === false ) {
    			alert("<?php echo JText::_( 'SELECT VENUE', true ); ?>");
    			validator.handleResponse(false,form.locid);
    			form.locid.focus();
    			return false;
  			} else {
  			<?php
			// JavaScript for extracting editor text
				echo $this->editor->save( 'datdescription' );
			?>
				submitform(pressbutton);

				return true;
			}
		}


		var tastendruck = false
		function rechne(restzeichen)
		{

			maximum = <?php echo $this->elsettings->datdesclimit; ?>

			if (restzeichen.datdescription.value.length > maximum) {
				restzeichen.datdescription.value = restzeichen.datdescription.value.substring(0, maximum)
				links = 0
			} else {
				links = maximum - restzeichen.datdescription.value.length
			}
			restzeichen.zeige.value = links
		}

		function berechne(restzeichen)
   		{
  			tastendruck = true
  			rechne(restzeichen)
   		}
	</script>


<div id="eventlist" class="el_editevent">

    <?php if ($this->params->def( 'show_page_title', 1 )) : ?>
    <h1 class="componentheading">
        <?php echo $this->params->get('page_title'); ?>
    </h1>
    <?php endif; ?>

    <form enctype="multipart/form-data" name="adminForm" action="<?php echo JRoute::_('index.php') ?>" method="post" class="form-validate">
        <div class="el_save_buttons floattext">
            <button type="submit" class="submit" onclick="return submitbutton('saveevent')">
        	    <?php echo JText::_('SAVE') ?>
        	</button>
        	<button type="reset" class="button cancel" onclick="submitbutton('cancelevent')">
        	    <?php echo JText::_('CANCEL') ?>
        	</button>
        </div>
        <br class="clear" />

    	<fieldset class="el_fldst_details">

        	<legend><?php echo JText::_('NORMAL INFO'); ?></legend>

          <div class="el_title floattext">
              <label for="title">
                  <?php echo JText::_( 'TITLE' ).':'; ?>
              </label>

              <input class="inputbox required" type="text" id="title" name="title" value="<?php echo $this->escape($this->row->title); ?>" size="65" maxlength="60" />
          </div>

          <div class="el_venue floattext">
              <label for="a_name">
                  <?php echo JText::_( 'VENUE' ).':'; ?>
              </label>

              <input type="text" id="a_name" value="<?php echo $this->row->venue; ?>" disabled="disabled" />

              <div class='el_buttons floattext'>

                	<button type="button" onclick="elSelectVenue(0,'<?php echo JText::_('NO VENUE'); ?>');"><?php  echo JText::_('NO VENUE'); ?></button>
                  <?php if ( $this->delloclink == 1 && !$this->row->id ) : //show location submission link ?>
              		<button type="button" onclick="submitbutton('addvenue');"><?php echo JText::_( 'DELIVER NEW VENUE' ); ?></button>
                	<?php endif; ?>
                  <a class="el_venue_select modal" title="<?php echo JText::_('SELECT'); ?>" href="<?php echo JRoute::_('index.php?view=editevent&layout=selectvenue&tmpl=component'); ?>" rel="{handler: 'iframe', size: {x: 650, y: 375}}">
                      <span><?php echo JText::_('SELECT')?></span>
                  </a>
                  <input class="inputbox required validate-venue" type="hidden" id="a_id" name="locid" value="<?php echo $this->row->locid; ?>" />
              </div>
          </div>

          <div class="el_category floattext">
          		<label for="catsid" class="catsid">
                  <?php echo JText::_( 'CATEGORY' ).':';?>
              </label>
          		<?php
                	$html = JHTML::_('select.genericlist', $this->categories, 'catsid','size="1" class="inputbox required validate-catsid"', 'value', 'text', $this->row->catsid );
                	echo $html;
          		?>
          </div>

          <div class="el_startdate floattext">
              <label for="dates">
                  <?php echo JText::_( 'DATE' ).':'; ?>
              </label>
              <?php echo JHTML::_('calendar', $this->row->dates, 'dates', 'dates', '%Y-%m-%d', array('class' => 'inputbox required validate-date')); ?>
              <small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('DATE HINT'); ?>">
      		    <?php echo $this->infoimage; ?>
          		</small>
      		</div>

      		<div class="el_enddate floattext">
              <label for="enddates">
                  <?php echo JText::_( 'ENDDATE' ).':'; ?>
              </label>
              <?php echo JHTML::_('calendar', $this->row->enddates, 'enddates', 'enddates', '%Y-%m-%d', array('class' => 'inputbox validate-date')); ?>
        			<small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('DATE HINT'); ?>">
        			    <?php echo $this->infoimage; ?>
        			</small>
      		</div>

          <div class="el_date el_starttime floattext">
              <label for="el_starttime">
                        <?php echo JText::_( 'TIME' ).':'; ?>
              </label>
        			<input class="inputbox validate-time" id="el_starttime" name="times" value="<?php echo substr($this->row->times, 0, 5); ?>" size="15" maxlength="8" />
        			<?php if ( $this->elsettings->showtime == 1 ) : ?>
        			<small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('TIME HINT'); ?>">
        			    <?php echo $this->infoimage; ?>
        			</small>
        			<?php else : ?>
        			<small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENDTIME HINT'); ?>">
        			    <?php echo $this->infoimage; ?>
        			</small>
        			<?php endif;?>
      		</div>

          <div class="el_date el_endtime floattext">
              <label for="el_endtime">
                  <?php echo JText::_( 'ENDTIME' ).':'; ?>
              </label>
              <input class="inputbox validate-time" id="el_endtime" name="endtimes" value="<?php echo substr($this->row->endtimes, 0, 5); ?>" size="15" maxlength="8" />&nbsp;
        			<small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENDTIME HINT'); ?>">
        			    <?php echo $this->infoimage; ?>
        			</small>
      		</div>

        </fieldset>


    	<?php if ( $this->elsettings->showfroregistra == 2 ) : ?>
    	<fieldset class="el_fldst_registration">

          <legend><?php echo JText::_('REGISTRATION'); ?></legend>

          <?php if ( $this->elsettings->showfroregistra == 2 ) : ?>
          <div class="el_register floattext">
              <p><strong><?php echo JText::_( 'SUBMIT REGISTER' ).':'; ?></strong></p>

              <label for="registra0"><?php echo JText::_( 'no' ); ?></label>
        			<input type="radio" name="registra" id="registra0" value="0" checked="checked" />

        			<br class="clear" />

              <label for="registra1"><?php echo JText::_( 'yes' ); ?></label>
            	<input type="radio" name="registra" id="registra1" value="1" />
          </div>
      		<?php
      		//register end
      		endif;

      		if ( $this->elsettings->showfrounregistra == 2 ) :
      		?>
      		<div class="el_unregister floattext">
        			<p><strong><?php echo JText::_( 'SUBMIT UNREGISTER' ).':'; ?></strong></p>

            	<label for="unregistra0"><?php echo JText::_( 'no' ); ?></label>
        			<input type="radio" name="unregistra" id="unregistra0" value="0" checked="checked" />

        			<br class="clear" />

            	<label for="unregistra1"><?php echo JText::_( 'yes' ); ?></label>
            	<input type="radio" name="unregistra" id="unregistra1" value="1" />
      		</div>
      		<?php
      		//unregister end
      		endif;
      		?>
    	</fieldset>

    	<?php
    	//registration end
    	endif;
    	?>

    	<fieldset class="el_fldst_recurrence">

          <legend><?php echo JText::_('RECURRENCE'); ?></legend>

          <div class="recurrence_select floattext">
              <label for="recurrence_select"><?php echo JText::_( 'RECURRENCE' ); ?>:</label>
            	<select id="recurrence_select" name="recurrence_select" size="1">
            	  <option value="0"><?php echo JText::_( 'NOTHING' ); ?></option>
            		<option value="1"><?php echo JText::_( 'DAYLY' ); ?></option>
            		<option value="2"><?php echo JText::_( 'WEEKLY' ); ?></option>
            		<option value="3"><?php echo JText::_( 'MONTHLY' ); ?></option>
            		<option value="4"><?php echo JText::_( 'WEEKDAY' ); ?></option>
            	</select>
          </div>

          <div class="recurrence_output floattext">
            	<label id="recurrence_output">&nbsp;</label>
              <div id="counter_row" style="display:none;">
                  <label for="recurrence_counter"><?php echo JText::_( 'RECURRENCE COUNTER' ); ?>:</label>
                  <div class="el_date>"><?php echo JHTML::_('calendar', ($this->row->recurrence_counter <> 0000-00-00) ? $this->row->recurrence_counter : JText::_( 'UNLIMITED' ), "recurrence_counter", "recurrence_counter"); ?>
              	    <a href="#" onclick="include_unlimited('<?php echo JText::_( 'UNLIMITED' ); ?>'); return false;"><img src="components/com_eventlist/assets/images/unlimited.png" width="16" height="16" alt="<?php echo JText::_( 'UNLIMITED' ); ?>" /></a>
              	</div>
              </div>
          </div>

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

        		unlimited_starter();
        	-->
            </script>

    	</fieldset>

    	<?php if (( $this->elsettings->imageenabled == 2 ) || ($this->elsettings->imageenabled == 1)) : ?>
    	<fieldset class="el_fldst_image">
      	  <legend><?php echo JText::_('IMAGE'); ?></legend>
      		<?php
          if ($this->row->datimage) :
      		    echo ELOutput::flyer( $this->row, $this->elsettings, $this->dimage, 'event' );
      		else :
      		    echo JHTML::_('image', 'components/com_eventlist/assets/images/noimage.png', JText::_('NO IMAGE'), array('class' => 'modal'));
      		endif;
        	?>
          <label for="userfile"><?php echo JText::_('IMAGE'); ?></label>
      		<input class="inputbox <?php echo $this->elsettings->imageenabled == 2 ? 'required' : ''; ?>" name="userfile" id="userfile" type="file" />
      		<small class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('MAX IMAGE FILE SIZE').' '.$this->elsettings->sizelimit.' kb'; ?>">
      		    <?php echo $this->infoimage; ?>
      		</small>
              <!--<div class="el_cur_image"><?php echo JText::_( 'CURRENT IMAGE' ); ?></div>
      		<div class="el_sel_image"><?php echo JText::_( 'SELECTED IMAGE' ); ?></div>-->
    	</fieldset>
    	<?php endif; ?>


    	<fieldset class="description">
      		<legend><?php echo JText::_('DESCRIPTION'); ?></legend>

      		<?php
      		//if usertyp min editor then editor else textfield
      		if ($this->editoruser) :
      			echo $this->editor->display('datdescription', $this->row->datdescription, '100%', '400', '70', '15', array('pagebreak', 'readmore') );
      		else :
      		?>
      		<textarea style="width:100%;" rows="10" name="datdescription" class="inputbox" wrap="virtual" onkeyup="berechne(this.form)"><?php echo $this->row->datdescription; ?></textarea><br />
      		<?php echo JText::_( 'NO HTML' ); ?><br />
      		<input disabled value="<?php echo $this->elsettings->datdesclimit; ?>" size="4" name="zeige" /><?php echo JText::_( 'AVAILABLE' ); ?><br />
      		<a href="javascript:rechne(document.adminForm);"><?php echo JText::_( 'REFRESH' ); ?></a>
      		<?php endif; ?>
    	</fieldset>

      <div class="el_save_buttons floattext">
          <button type="submit" class="submit" onclick="return submitbutton('saveevent')">
        	    <?php echo JText::_('SAVE') ?>
        	</button>
        	<button type="reset" class="button cancel" onclick="submitbutton('cancelevent')">
        	    <?php echo JText::_('CANCEL') ?>
        	</button>
      </div>
      <br class="clear" />

    	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
    	<input type="hidden" name="returnview" value="<?php echo $this->returnview; ?>" />
    	<input type="hidden" name="created" value="<?php echo $this->row->created; ?>" />
    	<input type="hidden" name="author_ip" value="<?php echo $this->row->author_ip; ?>" />
    	<input type="hidden" name="created_by" value="<?php echo $this->row->created_by; ?>" />
    	<input type="hidden" name="curimage" value="<?php echo $this->row->datimage; ?>" />
    	<?php echo JHTML::_( 'form.token' ); ?>
    	<input type="hidden" name="task" value="" />
    </form>

    <p class="copyright">
    	<?php echo ELOutput::footer( ); ?>
    </p>

</div>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
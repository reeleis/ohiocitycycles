<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

 class configHTML {
	function mailSettings($lists) {
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_MAIL_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_MAILSENDMETHOD ;
					$tip = _ACA_MAILSENDMETHOD_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['mailermethod']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SEND_MAIL_FROM ;
					$tip = _ACA_SEND_MAIL_FROM_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['sendmail_from']" size="50" value="<?php echo $GLOBALS[ACA.'sendmail_from']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SEND_MAIL_NAME;
					$tip = _ACA_SEND_MAIL_NAME_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['sendmail_name']" size="50" value="<?php echo $GLOBALS[ACA.'sendmail_name']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SENDMAILPATH ;
					$tip = _ACA_SENDMAILPATH_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['sendmail_path']" size="50" value="<?php echo $GLOBALS[ACA.'sendmail_path']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SMTPAUTHREQUIRED;
					$tip = _ACA_SMTPAUTHREQUIRED_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['auth_required']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SMTPUSERNAME;
					$tip = _ACA_SMTPUSERNAME_TIPS ;
					echo compa::toolTip($tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['smtp_username']" size="50" value="<?php echo $GLOBALS[ACA.'smtp_username']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SMTPPASSWORD;
					$tip = _ACA_SMTPPASSWORD_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['smtp_password']" size="50" value="<?php echo $GLOBALS[ACA.'smtp_password']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title =_ACA_SMTPHOST;
					$tip = _ACA_SMTPHOST . ' mail.yoursite.com' ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['smtp_host']" size="50" value="<?php echo $GLOBALS[ACA.'smtp_host']; ?>">
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_MAILINGS_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_MAIL_FORMAT;
					$tip = _ACA_MAIL_FORMAT_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php
				 echo $lists['mail_format'];
				 ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_CONFIRMBOUNCE;
					$tip = _ACA_CONFIRMBOUNCE_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['confirm_return']" size="50" value="<?php echo $GLOBALS[ACA.'confirm_return']; ?>">
				<input type="hidden"  value="1" name="config['use_embedded_images']" />
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_UPLOAD_PATH;
					$tip = _ACA_UPLOAD_PATH_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['upload_url']" size="50" value="<?php echo $GLOBALS[ACA.'upload_url']; ?>">
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
		<fieldset class="acajoomcss">
	<legend><?php echo _ACA_SENDING_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_PAUSEX_TIPS;
					$title = _ACA_PAUSEX;
					echo compa::toolTip($tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['pause_time']" size="50" value="<?php echo $GLOBALS[ACA.'pause_time']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_EMAIL_BET_PAUSE_TIPS ;
					$title = _ACA_EMAIL_BET_PAUSE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['emails_between_pauses']" size="50" value="<?php echo $GLOBALS[ACA.'emails_between_pauses']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_WAIT_USER_PAUSE;
					$tip = _ACA_WAIT_USER_PAUSE_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['wait_for_user']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SCRIPT_TIMEOUT;
					$tip = _ACA_SCRIPT_TIMEOUT_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['script_timeout']" size="50" value="<?php echo $GLOBALS[ACA.'script_timeout']; ?>">
			</td>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_TIME_OFFSET_TIPS ;
					$title = _ACA_TIME_OFFSET;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<a href="index2.php?option=com_config&hidemainmenu=1"><?php echo _ACA_TIME_OFFSET_URL; ?></a>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
	}
	function subcriberSettings($lists) {
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_SUBCRIBERS_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_ALLOW_UNREG_TIPS ;
					$title = _ACA_ALLOW_UNREG;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['allow_unregistered']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_REQ_CONFIRM_TIPS;
					$title = _ACA_REQ_CONFIRM;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['require_confirmation']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_REDIRECTCONFIRMATION_TIPS;
					$title = _ACA_REDIRECTCONFIRMATION;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['redirectconfirm']" size="30" value="<?php echo $GLOBALS[ACA.'redirectconfirm'];?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_CONFIRMFROMNAME;
					$tip = _ACA_CONFIRMFROMNAME_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['confirm_fromname']" size="50" value="<?php echo $GLOBALS[ACA.'confirm_fromname']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_CONFIRMFROMEMAIL;
					$tip = _ACA_CONFIRMFROMEMAIL_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['confirm_fromemail']" size="50" value="<?php echo $GLOBALS[ACA.'confirm_fromemail']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_HTML_CONFIRM_TIPS;
					$title =_ACA_HTML_CONFIRM;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['confirm_html']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_TIME_ZONE_TIPS;
					$title =_ACA_TIME_ZONE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['time_zone']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_FRONTEND_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SHOW_ARCHIVE_TIPS;
					$title = _ACA_SHOW_ARCHIVE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_archive']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
	}
	function cronSettings($lists) {
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_SCHEDULE_FREQUENCY; ?></legend>
	<table class="acajoomtable" cellspacing="1" width="100%" >
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_CRON_MAX_FREQ_TIPS;
					$title = _ACA_CRON_MAX_FREQ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['cron_max_freq']" size="5" value="<?php echo $GLOBALS[ACA.'cron_max_freq']; ?>">
				<?php echo _ACA_CRON_MINUTES ; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_CRON_MAX_EMAIL_TIPS;
					$title = _ACA_CRON_MAX_EMAIL;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['cron_max_emails']" size="5" value="<?php echo $GLOBALS[ACA.'cron_max_emails']; ?>">
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
		if (class_exists('pro')) {
		  ?>
			<fieldset class="acajoomcss">
			<legend><?php echo _ACA_MAINTENANCE_TAB; ?></legend>
			<table class="acajoomtable" cellspacing="1" width="100%" >
				<tbody>
				<tr>
					<td width="185" class="key">
						<span class="editlinktip">
						<?php

							$tip = _ACA_MAINTENANCE_FREQ_TIPS;
							$title = _ACA_MAINTENANCE_FREQ;
							echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
						?>
						</span>
					</td>
					<td>
						<input class="inputbox" type="text" name="config['maintenance_clear']" size="5" value="<?php echo $GLOBALS[ACA.'maintenance_clear']; ?>">
						<?php echo _ACA_CRON_DAYS ; ?>
					</td>
				</tr>
				</tbody>
			</table>
			</fieldset>
			<?php
		}
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_SCHEDULE_TITLE; ?></legend>
	<table class="acajoomtable" cellspacing="1" width="100%" >
		<tbody>
		<tr>
			<td>
			<?php
				echo _ACA_ACAJOOM_CRON_DESC;
			?>
								<br/>
				<a href="http://www.joobisoft.com" target="_blank">http://www.joobisoft.com</a>
				<br/>
				<br/>
				You need to be registered to our Website <a href="http://www.joobisoft.com" target="_blank">http://www.joobisoft.com</a> to have access to this free service.
				<br/>
				After having registered and confirmed your e-mail, please log in on <a href="http://www.joobisoft.com" target="_blank">http://www.joobisoft.com</a> and click on the menu 'my cron task' to configure your cron task.
				<br/>
				You will have to enter this URL : <b><?php echo $GLOBALS['mosConfig_live_site']; ?></b> in our form.
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo _ACA_CRON_DOCUMENTATION . '<br />'. _ACA_CRON_DOC_URL ; ?>
				<hr>
				<?php echo _ACA_CRON_DESC ; ?>
			</td>
		</tr>

		</tbody>
	</table>
	</fieldset>
	<?php
	}
	function logsSettings($lists) {
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_STATS_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_ENABLE_READ_STATS_TIPS ;
					$title = _ACA_ENABLE_READ_STATS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['enable_statistics']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_LOG_VIEWSPERSUB_TIPS ;
					$title = _ACA_LOG_VIEWSPERSUB;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['statistics_per_subscriber']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_LOGS_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_DISPLAY_LOG_TIPS;
					$title = _ACA_DIAPLAY_LOG;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['display_trace']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SEND_PERF_DATA_TIPS;
					$title = _ACA_SEND_PERF_DATA;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_data']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SEND_LOG_TIPS ;
					$title = _ACA_SEND_LOG;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_log']; ?>
			</td>
		</tr>
		<?php
		if (class_exists('auto')) $flag = auto::viewCron(); else $flag = false;
		if ($flag) {
		?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SEND_AUTO_LOG_TIPS ;
					$title = _ACA_SEND_AUTO_LOG;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_auto_log']; ?>
			</td>
		</tr>
		<?php }  ?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SEND_LOGDETAIL;
					$tip = _ACA_SEND_LOGDETAIL_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_log_simple']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SEND_LOGCLOSED;
					$tip = _ACA_SEND_LOGCLOSED_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_log_closed']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SAVE_LOG;
					$tip = _ACA_SAVE_LOG_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['save_log']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SAVE_LOGDETAIL_TIPS ;
					$title =_ACA_SAVE_LOGDETAIL;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['save_log_simple']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SAVE_LOGFILE_TIPS ;
					$title =_ACA_SAVE_LOGFILE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['save_log_file']" size="50" value="<?php echo $GLOBALS[ACA.'save_log_file']; ?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_CLEAR_LOG_TIPS ;
					$title =_ACA_CLEAR_LOG;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['clear_log']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
	}
	function miscSettings($lists) {
	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_MISC_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SHOW_GUIDE;
					$tip = _ACA_SHOW_GUIDE_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_guide']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SHOW_TIPS;
					$tip = _ACA_SHOW_TIPS_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_tips']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_ITEMID;
					$tip = _ACA_ITEMID_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['itemidAca']" size="5" value="<?php echo $GLOBALS[ACA.'itemidAca'];?>">
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_AUTO_UPDATE;
					$tip = _ACA_AUTO_UPDATE_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['update_notification']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SHOW_LISTS_TIPS ;
					$title = _ACA_SHOW_LISTS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_lists']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_USE_SEF;
					$tip = _ACA_USE_SEF_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['use_sef']; ?>
			</td>
		</tr>
		<?php
		if (class_exists('auto')) auto::miscSettings($lists);
		?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SHOW_FOOTER_TIPS ;
					$title = _ACA_SHOW_FOOTER;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_footer']; ?>
			</td>
		</tr>
				<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SHOW_AUTHOR;
					$tip = _ACA_SHOW_AUTHOR_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_author']; ?>
			</td>
		</tr>
		<?php if(class_exists('pro')){ ?>
				<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_SHOW_JCALPRO;
					$tip = _ACA_SHOW_JCALPRO_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['show_jcalpro']; ?>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_ADDEMAILREDLINK;
					$tip = _ACA_ADDEMAILREDLINK_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['addEmailRedLink']; ?>
			</td>
		</tr>
		<?php
		if ( $GLOBALS[ACA.'type'] =='Plus' OR $GLOBALS[ACA.'type']=='PRO' ) {
		?>
			<tr>
				<td width="185" class="key">
					<span class="editlinktip">
					<?php
						$tip = _ACA_SHOW_SIGNATURE_TIPS ;
						$title = _ACA_SHOW_SIGNATURE;
						echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
					?>
					</span>
				</td>
				<td>
					<?php echo $lists['show_signature']; ?>
				</td>
			</tr>
		<?php
		}
		?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_LISTS_EDITOR_TIPS ;
					$title = _ACA_LISTS_EDITOR;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['listHTMLeditor']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_UPDATE_URL_TIPS. '<br />' ._ACA_UPDATE_URL_WARNING ;
					$title = _ACA_UPDATE_URL ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
				<span class="error">
				<?php
					echo acajoom::WarningIcon( _ACA_UPDATE_URL_WARNING );
				?>
				</span>
			</td>
			<td>
				<input class="inputbox" type="text" name="config['update_url']" size="50" value="<?php echo $GLOBALS[ACA.'update_url']; ?>">
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_ERR_SETTINGS; ?></legend>
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_ERR_SHOW;
					$tip = _ACA_ERR_SHOW_TIPS ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['report_error']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$title = _ACA_ERR_SEND;
					$tip = _ACA_ERR_SEND_TIPS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['send_error']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
	}
	function cbSettings() {
		 $lists['cb_plugin'] = mosHTML::yesnoRadioList( "config['cb_plugin']" , 'class="inputbox"', $GLOBALS[ACA.'cb_plugin'] );
		 $lists['cb_showname'] = mosHTML::yesnoRadioList( "config['cb_showname']" , 'class="inputbox"', $GLOBALS[ACA.'cb_showname'] );
		 $lists['cb_checkLists'] = mosHTML::yesnoRadioList( "config['cb_checkLists']" , 'class="inputbox"', $GLOBALS[ACA.'cb_checkLists'] );
		 $lists['cb_showHTML'] = mosHTML::yesnoRadioList( "config['cb_showHTML']" , 'class="inputbox"', $GLOBALS[ACA.'cb_showHTML'] );
		 $lists['cb_defaultHTML'] = mosHTML::yesnoRadioList( "config['cb_defaultHTML']" , 'class="inputbox"', $GLOBALS[ACA.'cb_defaultHTML'] );

		?>
		<fieldset class="acajoomcss">
		<legend><?php echo _ACA_CB_INTEGRATION; ?></legend>
		<?php
		acajoom::beginingOfTable('acajoomtable');
		if ($GLOBALS[ACA.'cb_pluginInstalled']==0) {
			if (!acajoom::checkCBPlugin()) {
				 acajoom::miseEnPage(acajoom::WarningIcon( _ACA_CB_PLUGIN_NOT_INSTALLED ), ' ' , '<span style="color: rgb(255, 0, 0);">'._ACA_CB_PLUGIN_NOT_INSTALLED.'</span>' );
			}
		}
		 acajoom::miseEnPage(_ACA_CB_PLUGIN, _ACA_CB_PLUGIN_TIPS , $lists['cb_plugin']);
		 acajoom::miseEnPage(_ACA_CB_LISTS, _ACA_CB_LISTS_TIPS , "<input class=\"inputbox\" type=\"text\" name=\"config['cb_listIds']\" size=\"30\" value=\"". $GLOBALS[ACA.'cb_listIds']."\" >" );
		 acajoom::miseEnPage(_ACA_CB_INTRO, _ACA_CB_INTRO_TIPS , "<textarea  name=\"config['cb_intro']\" rows=\"3\" cols=\"40\" >". $GLOBALS[ACA.'cb_intro']."</textarea>" );
		 acajoom::miseEnPage(_ACA_CB_SHOW_NAME, _ACA_CB_SHOW_NAME_TIPS , $lists['cb_showname']);
		 acajoom::miseEnPage(_ACA_CB_LIST_DEFAULT, _ACA_CB_LIST_DEFAULT_TIPS , $lists['cb_checkLists']);
		 acajoom::miseEnPage(_ACA_CB_HTML_SHOW, _ACA_CB_HTML_SHOW_TIPS , $lists['cb_showHTML']);
		 acajoom::miseEnPage(_ACA_CB_HTML_DEFAULT, _ACA_CB_HTML_DEFAULT_TIPS , $lists['cb_defaultHTML']);
		 acajoom::endOfTable();
		echo '</fieldset>';
	}
	 function showConfigEdit($GLOBALS) {

		 $mailOpt[] = mosHTML::makeOption( 'mail' , 'PHP mail function' );
		 $mailOpt[] = mosHTML::makeOption('sendmail' ,  'Sendmail');
		 $mailOpt[] = mosHTML::makeOption( 'smtp' , 'SMTP Server');
		 $logFormat[] = mosHTML::makeOption( '0' , _ACA_DETAILED );
		 $logFormat[] = mosHTML::makeOption( '1' , _ACA_SIMPLE );
		 $lists['mailermethod'] = mosHTML::selectList( $mailOpt, "config['emailmethod']" , 'class="inputbox" size="1"', 'value', 'text', $GLOBALS[ACA.'emailmethod'] );
		 $lists['auth_required'] = mosHTML::yesnoRadioList( "config['smtp_auth_required']" , 'class="inputbox"', $GLOBALS[ACA.'smtp_auth_required'] );
		 $lists['allow_unregistered'] = mosHTML::yesnoRadioList( "config['allow_unregistered']" , 'class="inputbox"', $GLOBALS[ACA.'allow_unregistered'] );
		 $lists['require_confirmation'] = mosHTML::yesnoRadioList( "config['require_confirmation']" , 'class="inputbox"', $GLOBALS[ACA.'require_confirmation'] );
		 $lists['show_login'] = mosHTML::yesnoRadioList( "config['show_login']" , 'class="inputbox"', $GLOBALS[ACA.'show_login'] );
		 $lists['show_logout'] = mosHTML::yesnoRadioList( "config['show_logout']" , 'class="inputbox"', $GLOBALS[ACA.'show_logout'] );
		 $lists['confirm_html'] = mosHTML::yesnoRadioList( "config['confirm_html']" , 'class="inputbox"', $GLOBALS[ACA.'confirm_html'] );
		 $lists['time_zone'] = mosHTML::yesnoRadioList( "config['time_zone']" , 'class="inputbox"', $GLOBALS[ACA.'time_zone'] );
		 $lists['show_archive'] = mosHTML::yesnoRadioList( "config['show_archive']" , 'class="inputbox"', $GLOBALS[ACA.'show_archive'] );
		 $lists['enable_statistics'] = mosHTML::yesnoRadioList( "config['enable_statistics']" , 'class="inputbox"', $GLOBALS[ACA.'enable_statistics'] );
		 $lists['statistics_per_subscriber'] = mosHTML::yesnoRadioList( "config['statistics_per_subscriber']" , 'class="inputbox"', $GLOBALS[ACA.'statistics_per_subscriber'] );
		 $lists['wait_for_user'] = mosHTML::yesnoRadioList( "config['wait_for_user']" , 'class="inputbox"', $GLOBALS[ACA.'wait_for_user'] );
		 $lists['display_trace'] = mosHTML::yesnoRadioList( "config['display_trace']" , 'class="inputbox"', $GLOBALS[ACA.'display_trace'] );
		 $lists['send_data'] = mosHTML::yesnoRadioList( "config['send_data']" , 'class="inputbox"', $GLOBALS[ACA.'send_data'] );
		 $lists['send_auto_log'] = mosHTML::yesnoRadioList( "config['send_auto_log']" , 'class="inputbox"', $GLOBALS[ACA.'send_auto_log'] );
		 $lists['send_log'] = mosHTML::yesnoRadioList( "config['send_log']" , 'class="inputbox"', $GLOBALS[ACA.'send_log'] );
		 $lists['save_log'] = mosHTML::yesnoRadioList( "config['save_log']" , 'class="inputbox"', $GLOBALS[ACA.'save_log'] );
		 $lists['send_log_closed'] = mosHTML::yesnoRadioList( "config['send_log_closed']" , 'class="inputbox"', $GLOBALS[ACA.'send_log_closed'] );
		 $lists['clear_log'] = mosHTML::yesnoRadioList( "clear_log" , 'class="inputbox"', 0 );
		 $lists['send_log_simple'] = mosHTML::selectList( $logFormat, "config['send_log_simple']" , 'class="inputbox" size="1"', 'value', 'text', $GLOBALS[ACA.'send_log_simple'] );
		 $lists['save_log_simple'] = mosHTML::selectList( $logFormat, "config['save_log_simple']" , 'class="inputbox" size="1"', 'value', 'text', $GLOBALS[ACA.'save_log_simple'] );
		 $lists['show_footer'] = mosHTML::yesnoRadioList( "config['show_footer']" , 'class="inputbox"', $GLOBALS[ACA.'show_footer'] );
		 $lists['show_jcalpro'] = mosHTML::yesnoRadioList( "config['show_jcalpro']" , 'class="inputbox"', $GLOBALS[ACA.'show_jcalpro'] );
		 $lists['show_signature'] = mosHTML::yesnoRadioList( "config['show_signature']" , 'class="inputbox"', $GLOBALS[ACA.'show_signature'] );
		 $lists['show_lists'] = mosHTML::yesnoRadioList( "config['show_lists']" , 'class="inputbox"', $GLOBALS[ACA.'show_lists'] );
		 $lists['use_embedded_images'] = mosHTML::yesnoRadioList( "config['use_embedded_images']" , 'class="inputbox"', $GLOBALS[ACA.'use_embedded_images'] );
		 $lists['show_guide'] = mosHTML::yesnoRadioList( "config['show_guide']" , 'class="inputbox"', $GLOBALS[ACA.'show_guide'] );
		 $lists['show_author'] = mosHTML::yesnoRadioList( "config['show_author']" , 'class="inputbox"', $GLOBALS[ACA.'show_author'] );
		 $lists['show_tips'] = mosHTML::yesnoRadioList( "config['show_tips']" , 'class="inputbox"', $GLOBALS[ACA.'show_tips'] );
		 $lists['update_notification'] = mosHTML::yesnoRadioList( "config['update_notification']" , 'class="inputbox"', $GLOBALS[ACA.'update_notification'] );
		 $lists['use_sef'] = mosHTML::yesnoRadioList( "config['use_sef']" , 'class="inputbox"', $GLOBALS[ACA.'use_sef'] );
		 $lists['listype1'] = mosHTML::yesnoRadioList( "config['listype1']" , 'class="inputbox"', $GLOBALS[ACA.'listype1'] );
		 $lists['listype2'] = mosHTML::yesnoRadioList( "config['listype2']" , 'class="inputbox"', $GLOBALS[ACA.'listype2'] );
		 $lists['listHTMLeditor'] = mosHTML::yesnoRadioList( "config['listHTMLeditor']" , 'class="inputbox"', $GLOBALS[ACA.'listHTMLeditor'] );
		 $lists['send_error'] = mosHTML::yesnoRadioList( "config['send_error']" , 'class="inputbox"', $GLOBALS[ACA.'send_error'] );
		 $lists['report_error'] = mosHTML::yesnoRadioList( "config['report_error']" , 'class="inputbox"', $GLOBALS[ACA.'report_error'] );
		 $lists['addEmailRedLink'] = mosHTML::yesnoRadioList( "config['addEmailRedLink']" , 'class="inputbox"', $GLOBALS[ACA.'addEmailRedLink'] );

		if (class_exists('aca_archive') ) {
			$jour = array();
			$jour[] = mosHTML :: makeOption( '0', _FREQ_OPT_0 );
			$jour[] = mosHTML :: makeOption( '1', _FREQ_OPT_1 );
			$jour[] = mosHTML :: makeOption( '2', _FREQ_OPT_2 );
			$jour[] = mosHTML :: makeOption( '3', _FREQ_OPT_3 );
			$jour[] = mosHTML :: makeOption( '4', _FREQ_OPT_4 );
			$jour[] = mosHTML :: makeOption( '5', _FREQ_OPT_5 );
			$jour[] = mosHTML :: makeOption( '6', _FREQ_OPT_6 );
			$dateType = array();
			$dateType[] = mosHTML :: makeOption( '1', _DATE_OPT_1 );
			$dateType[] = mosHTML :: makeOption( '2', _DATE_OPT_2 );
			$lists['frequency'] = mosHTML :: selectList( $jour, "config['frequency']" , 'class="inputbox" size="1"', 'value', 'text', $GLOBALS[ACA.'frequency'] );
			$lists['date_type'] = mosHTML :: selectList( $dateType, "config['date_type']" , 'class="inputbox" size="1"', 'value', 'text', $GLOBALS[ACA.'date_type'] );

		}

			$mail_format[] = mosHTML::makeOption( '0', 'Text (8bit)' );
			$mail_format[] = mosHTML::makeOption( '1', 'MIME (base64)' );
			$lists['mail_format'] = mosHTML::radioList( $mail_format, "config['mail_format']", 'class="inputbox"',  $GLOBALS[ACA.'mail_format'] );


	backHTML::formStart('configpanel', 0 ,'' );
	?>
	<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td>
	<form action="index2.php" method="post" name="adminForm">
	<?php
			 $config_tabs = new mosTabs(1);
			 $config_tabs->startPane('acaConfig');
			 $config_tabs->startTab(_ACA_MAIL_CONFIG, 'mail');
			configHTML::mailSettings($lists);
			$config_tabs->endTab();
			$config_tabs->startTab(_ACA_SUBSCRIBER_CONFIG, 'subscribers');
			configHTML::subcriberSettings($lists);
			$config_tabs->endTab();
			if (class_exists('auto')) $flag = auto::viewCron(); else $flag = false;
			if ($flag) {
				$config_tabs->startTab(_ACA_SCHEDULER, 'scheduler');
				configHTML::cronSettings($lists);
				$config_tabs->endTab();
			}
			$config_tabs->startTab(_ACA_LOGGING_CONFIG, 'logging');
			configHTML::logsSettings($lists);
			$config_tabs->endTab();
			if ($GLOBALS[ACA.'integration']
			 AND ( $GLOBALS[ACA.'cb_integration']
			  OR ( class_exists('aca_virtuemart') && $GLOBALS[ACA.'virtuemart'] ) ) ) {
				$config_tabs->startTab(_ACA_CONFIG_INTEGRATION, 'integration');
				if ($GLOBALS[ACA.'cb_integration']) configHTML::cbSettings();
				if ( class_exists('aca_virtuemart') && isset($GLOBALS[ACA.'virtuemart']) && $GLOBALS[ACA.'virtuemart'] ) aca_virtuemart::tab();
				$config_tabs->endTab();
			}
			if (class_exists('aca_archive') ) {
				$config_tabs->startTab(_ACA_MENU_TAB_ARCHIVE, 'archive');
				aca_archive::showArchive($lists);
				$config_tabs->endTab();
			}
			$config_tabs->startTab(_ACA_MISC_CONFIG, 'misc');
			configHTML::miscSettings($lists);
			$config_tabs->endTab();
			if (class_exists('auto')) {
				$config_tabs->startTab(_ACA_LICENSE_CONFIG, 'licence');
				auto::licenseSettings($lists);
				$config_tabs->endTab();
			}
			$config_tabs->endPane();
	?>
		<input type="hidden" name="option" value="com_acajoom" />
		<input type="hidden" name="act" value="configuration" />
    	<input type="hidden" name="boxchecked" value="0" />
    	<input type="hidden" name="task" value="" />
	</form>
	</td></tr></tbody></table>
	<?php
	 }
 }


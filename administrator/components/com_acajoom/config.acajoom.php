<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

	$acajoomConfigFile = array();

	$acajoomConfigFile['component'] = 'Acajoom';
	$acajoomConfigFile['type'] = 'News';
	$acajoomConfigFile['version'] = '2.0.5';
	$acajoomConfigFile['level'] = '1';

	$acajoomConfigFile['emailmethod'] = 'sendmail';
	$acajoomConfigFile['sendmail_from'] = '';
	$acajoomConfigFile['sendmail_name'] = '';
	$acajoomConfigFile['sendmail_path'] = '/usr/sbin/sendmail';
	$acajoomConfigFile['smtp_host'] = '';
	$acajoomConfigFile['smtp_auth_required'] = '1';
	$acajoomConfigFile['smtp_username'] = '';
	$acajoomConfigFile['smtp_password'] = '';
	$acajoomConfigFile['use_embedded_images'] = '1';
	$acajoomConfigFile['confirm_return'] = '';
	$acajoomConfigFile['upload_url'] = '/components/com_acajoom/upload';

	$acajoomConfigFile['enable_statistics'] = '1';
	$acajoomConfigFile['statistics_per_subscriber'] = '1';

	$acajoomConfigFile['send_data'] = '1';
	$acajoomConfigFile['allow_unregistered'] = '1';
	$acajoomConfigFile['require_confirmation'] = '0';
	$acajoomConfigFile['redirectconfirm'] = '';
	$acajoomConfigFile['show_login'] = '1';
	$acajoomConfigFile['show_logout'] = '1';
	$acajoomConfigFile['send_unsubcribe'] = '1';
	$acajoomConfigFile['confirm_fromname'] = '';
	$acajoomConfigFile['confirm_fromemail'] = '';
	$acajoomConfigFile['confirm_html'] = '1';
	$acajoomConfigFile['time_zone'] = '0';
	$acajoomConfigFile['show_archive'] = '1';

	$acajoomConfigFile['pause_time'] = '20';
	$acajoomConfigFile['emails_between_pauses'] = '65';
	$acajoomConfigFile['wait_for_user'] = '0';
	$acajoomConfigFile['script_timeout'] = '60';
	$acajoomConfigFile['display_trace'] = '1';
	$acajoomConfigFile['send_log'] = '1';
	$acajoomConfigFile['send_auto_log'] = '0';
	$acajoomConfigFile['send_log_simple'] = '0';
	$acajoomConfigFile['send_log_closed'] = '1';
	$acajoomConfigFile['save_log'] = '0';
	$acajoomConfigFile['send_email'] = '1';
	$acajoomConfigFile['save_log_simple'] = '0';
	$acajoomConfigFile['save_log_file'] = '/administrator/components/com_acajoom/com_acajoom.log';
	$acajoomConfigFile['send_log_address'] = '@acajoom.com';
	$acajoomConfigFile['option'] = 'com_sdonkey';
	$acajoomConfigFile['send_log_name'] = 'Acajoom Mailing Report';
	$acajoomConfigFile['homesite'] = 'http://www.acajoom.com';
	$acajoomConfigFile['report_site'] = 'http://www.acajoom.com';

	$acajoomConfigFile['integration'] = '0';

	$acajoomConfigFile['cb_plugin'] = '1';
	$acajoomConfigFile['cb_listIds'] = '0';
	$acajoomConfigFile['cb_intro'] = '';
	$acajoomConfigFile['cb_showname'] = '1';
	$acajoomConfigFile['cb_checkLists'] = '1';
	$acajoomConfigFile['cb_showHTML'] = '1';
	$acajoomConfigFile['cb_defaultHTML'] = '1';
	$acajoomConfigFile['cb_integration'] = '0';
	$acajoomConfigFile['cb_pluginInstalled']= '0';
	$acajoomConfigFile['cron_max_freq'] = '10';
	$acajoomConfigFile['cron_max_emails'] = '60';
	$acajoomConfigFile['last_cron'] = '' ;
	$acajoomConfigFile['last_sub_update'] = '' ;
	$acajoomConfigFile['next_autonews'] = '' ;
	$acajoomConfigFile['show_footer'] = '1';
	$acajoomConfigFile['show_signature'] = '1';
	$acajoomConfigFile['update_url'] = 'http://www.acajoom.com/update/';
	$acajoomConfigFile['date_update'] = '';
	$acajoomConfigFile['update_message'] = '';
	$acajoomConfigFile['show_guide'] = '1';
	$acajoomConfigFile['news1'] = '1';
	$acajoomConfigFile['news2'] = '1';
	$acajoomConfigFile['news3'] = '1';
	$acajoomConfigFile['cron_setup'] = '0';
	$acajoomConfigFile['queuedate'] = '';
	$acajoomConfigFile['update_avail'] = '0';
	$acajoomConfigFile['show_tips'] = '1';
	$acajoomConfigFile['update_notification'] = '1';
	$acajoomConfigFile['show_lists'] = '1';
	$acajoomConfigFile['use_sef'] = '0';
	$acajoomConfigFile['listHTMLeditor'] = '1';
	$acajoomConfigFile['mod_pub'] = '0';
	$acajoomConfigFile['firstmailing'] = '0';
	$acajoomConfigFile['nblist'] = '9';

	$acajoomConfigFile['license'] ='';
	$acajoomConfigFile['token'] ='';
	$acajoomConfigFile['maintenance'] ='';
	$acajoomConfigFile['admin_debug'] ='0';
	$acajoomConfigFile['send_error'] ='1';
	$acajoomConfigFile['report_error'] ='1';

	$acajoomConfigFile['frequency'] = '0';
	$acajoomConfigFile['nb_days'] = '7';
	$acajoomConfigFile['date_type'] = '1';
	$acajoomConfigFile['arv_cat'] = '';
	$acajoomConfigFile['arv_sec'] = '';
	$acajoomConfigFile['maintenance_clear'] = '24' ;
	$acajoomConfigFile['maintenance_date'] = '' ;
	$acajoomConfigFile['mail_format'] = '1';
	$acajoomConfigFile['showtag'] = '0';

	$acajoomConfigFile['show_author'] = '0';
	$acajoomConfigFile['addEmailRedLink'] = '0';
	$acajoomConfigFile['itemidAca'] = '99';
	$acajoomConfigFile['show_jcalpro'] = '0';

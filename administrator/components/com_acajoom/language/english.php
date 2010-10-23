<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>English language file</p>
* @author Acajoom Services <support@acajoom.com>
* @version $Id: english.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

#######    NOTE TO TRANSLATORS  #######
# If you wish to translate the language file to your own language, please feel free to do so
# We would apprecaite if you could send you translation to the specified email
# so that other people could benefit from your contribution
# If you feel that the file is too long feel free to do as much as you want and probably
# someone else will be happy to pick up were you stopped.
#  We did our bestt to organize the subject by order of priority so start at the top
# If you update your translation please send you updates to translation@acajoom.com
# IMPORTANT: make sure respect as much as posible the punctionation and spacing because
# sometimes the word constant are conbined...
# Don't ever remove a define as it will create an error in the code.
# when using apostrophy  '   add a back-slash before like this:  \'  otherwise it will create an error.
# sometimes you will see html tag in the define, please leave it the way it is.

# DONT FORGET if you want to be credited fro your work, make sure to change the credit
# with your name and email if you want people to contact you otherwise leave the email as it is.
# We will use that information to also include you into the About section of the component
# Thank you very much for your contribution translating in your language

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom is a mailing lists, newsletters, auto-responders, and follow up tool to communication effectively with your users and customers.  ' .
		'Acajoom, Your Communication Partner!');
define('_ACA_FEATURES', 'Acajoom, your communication partner!');

// Type of lists
define('_ACA_NEWSLETTER', 'Newsletter');
define('_ACA_AUTORESP', 'Auto-responder');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Post card');
define('_ACA_PERF', 'Performance');
define('_ACA_COUPON', 'Coupon');
define('_ACA_CRON', 'Cron Task');
define('_ACA_MAILING', 'Mailing');
define('_ACA_LIST', 'List');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Lists');
define('_ACA_MENU_SUBSCRIBERS', 'Subscribers');
define('_ACA_MENU_NEWSLETTERS', 'Newsletters');
define('_ACA_MENU_AUTOS', 'Auto-responders');
define('_ACA_MENU_COUPONS', 'Coupons');
define('_ACA_MENU_CRONS', 'Cron Tasks');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Post cards');
define('_ACA_MENU_PERFS', 'Performances');
define('_ACA_MENU_TAB_LIST', 'Lists');
define('_ACA_MENU_MAILING_TITLE', 'Mailings');
define('_ACA_MENU_MAILING' , 'Mailings for ');
define('_ACA_MENU_STATS', 'Statistics');
define('_ACA_MENU_STATS_FOR', 'Statistics for ');
define('_ACA_MENU_CONF', 'Configuration');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'About');
define('_ACA_MENU_LEARN', 'Education center');
define('_ACA_MENU_MEDIA', 'Media Manager');
define('_ACA_MENU_HELP', 'Help');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Import');
define('_ACA_MENU_EXPORT', 'Export');
define('_ACA_MENU_SUB_ALL', 'Subcribe All');
define('_ACA_MENU_UNSUB_ALL', 'Unsubcribe All');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archive');
define('_ACA_MENU_PREVIEW', 'Preview');
define('_ACA_MENU_SEND', 'Send');
define('_ACA_MENU_SEND_TEST', 'Send Test Email');
define('_ACA_MENU_SEND_QUEUE', 'Process Queue');
define('_ACA_MENU_VIEW', 'View');
define('_ACA_MENU_COPY', 'Copy');
define('_ACA_MENU_VIEW_STATS' , 'View stats');
define('_ACA_MENU_CRTL_PANEL' , ' Control Panel');
define('_ACA_MENU_LIST_NEW' , ' Create a List');
define('_ACA_MENU_LIST_EDIT' , ' Edit a List');
define('_ACA_MENU_BACK', 'Back');
define('_ACA_MENU_INSTALL', 'Installation');
define('_ACA_MENU_TAB_SUM', 'Summary');
define('_ACA_STATUS' , 'Status');

// messages
define('_ACA_ERROR' , ' An error occurred! ');
define('_ACA_SUB_ACCESS' , 'Access rights');
define('_ACA_DESC_CREDITS', 'Credits');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Homepage');
define('_ACA_DESC_MAILING', 'Mailing list');
define('_ACA_DESC_SUBSCRIBERS', 'Subscribers');
define('_ACA_PUBLISHED','Published');
define('_ACA_UNPUBLISHED','Unpublished');
define('_ACA_DELETE','Delete');
define('_ACA_FILTER','Filter');
define('_ACA_UPDATE','Update');
define('_ACA_SAVE','Save');
define('_ACA_CANCEL','Cancel');
define('_ACA_NAME','Name');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Select');
define('_ACA_ALL','All');
define('_ACA_SEND_A', 'Send a ');
define('_ACA_SUCCESS_DELETED', ' successfully deleted');
define('_ACA_LIST_ADDED', 'List successfully created');
define('_ACA_LIST_COPY', 'List successfully copied');
define('_ACA_LIST_UPDATED', 'List successfully updated');
define('_ACA_MAILING_SAVED', 'Mailing successfully saved.');
define('_ACA_UPDATED_SUCCESSFULLY', 'successfully updated.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Subscriber\'s information');
define('_ACA_VERIFY_INFO', 'Please verify the link you submitted, some information are missing.');
define('_ACA_INPUT_NAME', 'Name');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Receive HTML?');
define('_ACA_TIME_ZONE', 'Time Zone');
define('_ACA_BLACK_LIST', 'Black list');
define('_ACA_REGISTRATION_DATE', 'User registration date');
define('_ACA_USER_ID', 'User id');
define('_ACA_DESCRIPTION', 'Description');
define('_ACA_ACCOUNT_CONFIRMED', 'Your account has been activated.');
define('_ACA_SUB_SUBSCRIBER', 'Subscriber');
define('_ACA_SUB_PUBLISHER', 'Publisher');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registered');
define('_ACA_SUBSCRIPTIONS', 'Your Subscription');
define('_ACA_SEND_UNSUBCRIBE', 'Send unsubscribe message');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Click Yes to send an unsubscribe email confimation message.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Please confirm your subscription');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Unsubscription confirmation');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hi [NAME],<br />' .
		'Just one more step and you will be subscribed to the list.  Please click on the following link to confirm your subscription.' .
		'<br /><br />[CONFIRM]<br /><br />For an question please contact the webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'This is a confirmation email that you have been unsubscribed from our list.  We are sorry that you decided to unsubscribe should you decide to re-subscribe you can always do so on our site.  Should you have any question please contact our webmaster.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Signup date');
define('_ACA_CONFIRMED', 'Confirmed');
define('_ACA_SUBSCRIB', 'Subscribe');
define('_ACA_HTML', 'HTML mailings');
define('_ACA_RESULTS', 'Results');
define('_ACA_SEL_LIST', 'Select a list');
define('_ACA_SEL_LIST_TYPE', '- Select type of list -');
define('_ACA_SUSCRIB_LIST', 'List of all subscribers');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Subscribers for : ');
define('_ACA_NO_SUSCRIBERS', 'No subscribers found for this lists.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'A confirmation email has been sent to you.  Please check your email and click on the link provided.<br />' .
		'You need to confirm your email for your subscription to take effect.');
define('_ACA_SUCCESS_ADD_LIST', 'You have been successfully added to the list.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Click here to confirm your subscription');
define('_ACA_UNSUBSCRIBE_LINK', 'Click here to unsubscribe yourself from the list');
define('_ACA_UNSUBSCRIBE_MESS', 'Your email address has been removed from the list');

define('_ACA_QUEUE_SENT_SUCCESS' , 'All scheduled mailings have been succesfully sent.');
define('_ACA_MALING_VIEW', 'View all mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Are you sure you want to unsubscribe from this list?');
define('_ACA_MOD_SUBSCRIBE', 'Subscribe');
define('_ACA_SUBSCRIBE', 'Subscribe');
define('_ACA_UNSUBSCRIBE', 'Unsubscribe');
define('_ACA_VIEW_ARCHIVE', 'View archive');
define('_ACA_SUBSCRIPTION_OR', ' or click here to update your information');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'This email address has already been registered.');
define('_ACA_SUBSCRIBER_DELETED', 'Subscriber suscessfully deleted.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'User Control Panel');
define('_UCP_USER_MENU', 'User Menu');
define('_UCP_USER_CONTACT', 'My Subscriptions');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Cron Task Management');
define('_UCP_CRON_NEW_MENU', 'New Cron');
define('_UCP_CRON_LIST_MENU', 'List my Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Coupons Management');
define('_UCP_COUPON_LIST_MENU', 'List of Coupons');
define('_UCP_COUPON_ADD_MENU', 'Add a Coupon');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Description');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Subscription');
define('_ACA_LIST_T_SENDER', 'Sender information');

define('_ACA_LIST_TYPE', 'List Type');
define('_ACA_LIST_NAME', 'List name');
define('_ACA_LIST_ISSUE', 'Issue #');
define('_ACA_LIST_DATE', 'Send date');
define('_ACA_LIST_SUB', 'Mailing subject');
define('_ACA_ATTACHED_FILES', 'Attached files');
define('_ACA_SELECT_LIST', 'Please select a list to edit!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Type of list');
define('_ACA_AUTO_RESP_OPTION', 'Auto-responder options');
define('_ACA_AUTO_RESP_FREQ', 'Subscribers can choose frequency');
define('_ACA_AUTO_DELAY', 'Delay (in days)');
define('_ACA_AUTO_DAY_MIN', 'Minimum frequency');
define('_ACA_AUTO_DAY_MAX', 'Maximum frequency');
define('_ACA_FOLLOW_UP', 'Specify follow up auto-responder');
define('_ACA_AUTO_RESP_TIME', 'Subscribers can choose time');
define('_ACA_LIST_SENDER', 'List sender');

define('_ACA_LIST_DESC', 'List description');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Sender name');
define('_ACA_SENDER_EMAIL', 'Sender email');
define('_ACA_SENDER_BOUNCE', 'Sender bounce address');
define('_ACA_LIST_DELAY', 'Delay');
define('_ACA_HTML_MAILING', 'HTML mailing?');
define('_ACA_HTML_MAILING_DESC', '(if you change this, you\'ll have to save and return to this screen to see the changes.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Hide from frontend?');
define('_ACA_SELECT_IMPORT_FILE', 'Select a file to import');;
define('_ACA_IMPORT_FINISHED', 'Import finished');
define('_ACA_DELETION_OFFILE', 'Deletion of file');
define('_ACA_MANUALLY_DELETE', 'failed, you should manually delete the file');
define('_ACA_CANNOT_WRITE_DIR', 'Cannot write directory');
define('_ACA_NOT_PUBLISHED', 'Could not sent the mailing, the list is not published.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Click Yes to publish the list');
define('_ACA_INFO_LIST_NAME', 'Enter the name of your list here. You can identify the list with this name.');
define('_ACA_INFO_LIST_DESC', 'Enter a brief description of your list here. This description will be visible to visitors at your site.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Enter the name of the sender of the mailing. This name will be visible when subscribers receive messages from this list.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Enter the email address from which the messages will be sent.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Enter the email address where users can reply to. It is highly recommended to be the same as the sender email, since spam filters will give your message a higher spam ranking if they are different.');
define('_ACA_INFO_LIST_AUTORESP', 'Choose the type of mailings for this list. <br />' .
		'Newsletter: normal newsletter<br />' .
		'Auto-responder: an auto-responder is a list which is sent automatically through the website at regular intervals.');
define('_ACA_INFO_LIST_FREQUENCY', 'Enable the users to choose how often they receive the list.  It gives more flexibility to the user.');
define('_ACA_INFO_LIST_TIME', 'Let the user choose their preferred time of the day to receive the list.');
define('_ACA_INFO_LIST_MIN_DAY', 'Define what is the minimum frequency a user can choose to receive the list');
define('_ACA_INFO_LIST_DELAY', 'Specify the delay between this auto-responder and the previous one.');
define('_ACA_INFO_LIST_DATE', 'Specify the date to publish the news list if you want to delay the publishing. <br /> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Define what is the maximum frequency a user can choose to receive the list');
define('_ACA_INFO_LIST_LAYOUT', 'Enter the layout of your mailing list here. You can enter any layout for your mailing here.');
define('_ACA_INFO_LIST_SUB_MESS', 'This message will be send to the subscriber when he or she first registers. You can define any text you like in here.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'This message will be send to the subscriber when he or she unsubscribes. Any message can be entered here.');
define('_ACA_INFO_LIST_HTML', 'Select the checkbox if you wish to send out a HTML mailing. Subscribers will be able to specify if they wish to receive the HTML message, or the Text only message when subscribe to a HTML list.');
define('_ACA_INFO_LIST_HIDDEN', 'Click Yes to hide the list from the fontend, users won\'t be able to subscribe but you will be still able to send mailings.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Do you want to automatically subscribe users to this list?<br /><B>New Users:</B> will registerer every new users who register on the website.<br /><B>All Users:</B> will register every registered users in the database.<br />(all those option support Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Select the frontend access level. This will show or hide the mailing to usergroups who don\'t have access to it, so they won\'t be able to subscribe to it.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Select the access level of the usergroup you wish to allow editing. That usergroup and above will be able to edit the mailing and send it out, either from the frontend or backend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'If you want the auto-responder to move to another one once it reaches the last message you can specify here the following up auto-responder.');
define('_ACA_INFO_LIST_ACA_OWNER', 'This is the ID of the person who created the list.');
define('_ACA_INFO_LIST_WARNING', '   This last option is available only once at the creation of the list.');
define('_ACA_INFO_LIST_SUBJET', ' Subject of the mailing.  This is the subject of the email the subscriber will received.');
define('_ACA_INFO_MAILING_CONTENT', 'This is the body of email you want to send.');
define('_ACA_INFO_MAILING_NOHTML', 'Enter here the body of the email you want to send to subscribers who choose to receive only none HTML mailings. <BR/> NOTE: if you leave it blank Acajoom will automatically convert the HTML text into text only.');
define('_ACA_INFO_MAILING_VISIBLE', 'Click Yes to show the mailing in the fontend.');
define('_ACA_INSERT_CONTENT', 'Insert existing content');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Coupon successfully sent!');
define('_ACA_CHOOSE_COUPON', 'Choose a coupon');
define('_ACA_TO_USER', ' to this user');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Every hours');
define('_ACA_FREQ_CH2', 'Every 6 hours');
define('_ACA_FREQ_CH3', 'Every 12 hours');
define('_ACA_FREQ_CH4', 'Daily');
define('_ACA_FREQ_CH5', 'Weekly');
define('_ACA_FREQ_CH6', 'Monthly');
define('_ACA_FREQ_NONE', 'No');
define('_ACA_FREQ_NEW', 'New Users');
define('_ACA_FREQ_ALL', 'All Users');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Click Yes if you want to use this for an Acajoom Cron, No for any other cron task.<br />' .
		'If you click Yes you don\'t need to specify the Cron Address, it will be automatically added.');
define('_ACA_SITE_URL' , 'Your site URL');
define('_ACA_CRON_FREQUENCY' , 'Cron Frequency');
define('_ACA_STARTDATE_FREQ' , 'Start Date');
define('_ACA_LABELDATE_FREQ' , 'Specify Date');
define('_ACA_LABELTIME_FREQ' , 'Specify Time');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Frequency');
define('_ACA_TITLE_CRONLIST', 'Cron List');
define('_NEW_LIST', 'Create a new list');

//title CRON form
define('_ACA_TITLE_FREQ', 'Cron Edit');
define('_ACA_CRON_SITE_URL', 'Please enter a valid site url, starting with http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'All mailings');
define('_ACA_EDIT_A', 'Edit a ');
define('_ACA_SELCT_MAILING', 'Please select a list in the drop down menu in order to add a new mailing.');
define('_ACA_VISIBLE_FRONT', 'Visible in frontend');

// mailer
define('_ACA_SUBJECT', 'Subject');
define('_ACA_CONTENT', 'Content');
define('_ACA_NAMEREP', '[NAME] = This will be replaced by the name the subscriber entered, you\'ll be sending personalized email when using this.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = This will be replaced by the FIRST name of the subscriber entered.<br />');
define('_ACA_NONHTML', 'Non-html version');
define('_ACA_ATTACHMENTS', 'Attachments');
define('_ACA_SELECT_MULTIPLE', 'Hold control (or command) to select multiple attachments.<br />' .
		'The files displayed in this attachement list are located in the attachement folder, you can change this location in the configuration panel.');
define('_ACA_CONTENT_ITEM', 'Content item');
define('_ACA_SENDING_EMAIL', 'Sending email');
define('_ACA_MESSAGE_NOT', 'Message could not be sent');
define('_ACA_MAILER_ERROR', 'Mailer error');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Message sent successfully');
define('_ACA_SENDING_TOOK', 'Sending this mailing took');
define('_ACA_SECONDS', 'seconds');
define('_ACA_NO_ADDRESS_ENTERED', 'No email address or subscriber provided');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Change');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Change your subscription');
define('_ACA_WHICH_EMAIL_TEST', 'Indicate the email address to send a test to or select preview');
define('_ACA_SEND_IN_HTML', 'Send in HTML (for html mailings)?');
define('_ACA_VISIBLE', 'Visible');
define('_ACA_INTRO_ONLY', 'Intro only');

// stats
define('_ACA_GLOBALSTATS', 'Global stats');
define('_ACA_DETAILED_STATS', 'Detailed stats');
define('_ACA_MAILING_LIST_DETAILS', 'List details');
define('_ACA_SEND_IN_HTML_FORMAT', 'Send in HTML format');
define('_ACA_VIEWS_FROM_HTML', 'Views (from html mails)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Send in text format');
define('_ACA_HTML_READ', 'HTML read');
define('_ACA_HTML_UNREAD', 'HTML unread');
define('_ACA_TEXT_ONLY_SENT', 'Text only');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Stats');
define('_ACA_SUBSCRIBER_CONFIG', 'Subscribers');
define('_ACA_MISC_CONFIG', 'Miscellaneous');
define('_ACA_MAIL_SETTINGS', 'Mail Settings');
define('_ACA_MAILINGS_SETTINGS', 'Mailings Settings');
define('_ACA_SUBCRIBERS_SETTINGS', 'Subscribers Settings');
define('_ACA_CRON_SETTINGS', 'Cron Settings');
define('_ACA_SENDING_SETTINGS', 'Sending Settings');
define('_ACA_STATS_SETTINGS', 'Statistics Settings');
define('_ACA_LOGS_SETTINGS', 'Logs Settings');
define('_ACA_MISC_SETTINGS', 'Miscellaneous Settings');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'From Email');
define('_ACA_SEND_MAIL_NAME', 'From Name');
define('_ACA_MAILSENDMETHOD', 'Mailer method');
define('_ACA_SENDMAILPATH', 'Sendmail path');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP Authentication required');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Select yes if your SMTP server requires authentication');
define('_ACA_SMTPUSERNAME', 'SMTP username');
define('_ACA_SMTPUSERNAME_TIPS', 'Enter the SMTP username when your SMTP server requires authentication');
define('_ACA_SMTPPASSWORD', 'SMTP password');
define('_ACA_SMTPPASSWORD_TIPS', 'Enter the SMTP password when your SMTP server requires authentication');
define('_ACA_USE_EMBEDDED', 'Use embedded images');
define('_ACA_USE_EMBEDDED_TIPS', 'Select yes if the images in attached content items should be embedded in the email for html messages, or no to use default image tags that link to the images on the site.');
define('_ACA_UPLOAD_PATH', 'Upload/attachements path');
define('_ACA_UPLOAD_PATH_TIPS', 'You can specify an upload directory.<br />' .
		'Make sure that the directory you specify exist, otherwise create it.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Allow unregistered');
define('_ACA_ALLOW_UNREG_TIPS', 'Select Yes if you want to allow users to subscribe to lists without registering at the site.');
define('_ACA_REQ_CONFIRM', 'Require confirmation');
define('_ACA_REQ_CONFIRM_TIPS', 'Select yes if you require that unregistered subscribers confirm their email address.');
define('_ACA_SUB_SETTINGS', 'Subscribe Settings');
define('_ACA_SUBMESSAGE', 'Subscribe Email');
define('_ACA_SUBSCRIBE_LIST', 'Subscribe to a list');

define('_ACA_USABLE_TAGS', 'Usable tags');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = This creates a clickable link where the subscriber can confirm their subscription. This is <strong>required</strong> to make Acajoom work properly.<br />'
.'<br />[NAME] = This will be replaced by the name the subscriber entered, you\'ll be sending personalized email when using this.<br />'
.'<br />[FIRSTNAME] = This will be replaced by the FIRST name of the subscriber, First name is DEFINEd as the first name entered by the subscriber.<br />');
define('_ACA_CONFIRMFROMNAME', 'Confirm from name');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Enter the from name to display on confirmation lists.');
define('_ACA_CONFIRMFROMEMAIL', 'Confirm from email');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Enter the email address to display on confirmation lists.');
define('_ACA_CONFIRMBOUNCE', 'Bounce address');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Enter the bounce address to display on confirmation lists.');
define('_ACA_HTML_CONFIRM', 'HTML confirm');
define('_ACA_HTML_CONFIRM_TIPS', 'Select yes if confirmation lists should be html if the user allows html.');
define('_ACA_TIME_ZONE_ASK', 'Ask time zone');
define('_ACA_TIME_ZONE_TIPS', 'Select yes if you want to ask the user\'s time zone. The queued mailings will be sent based on time zone when applicable');

 // Cron Set up
 define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_TIME_OFFSET_URL', 'click here to set up the offset in the global configuration panel -> Locale tab');
define('_ACA_TIME_OFFSET_TIPS', 'Set up your server time offset so that recorded date and time are exact');
define('_ACA_TIME_OFFSET', 'Time offset');
define('_ACA_CRON_DESC','<br />Using the cron function you can setup an automated task for your Joomla website!<br />' .
		'To set it up you need to add in your control panel crontab the following command:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />If you need help setting it up or have problems please consult our forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pause x seconds every configured amount of emails');
define('_ACA_PAUSEX_TIPS', 'Enter a number of seconds Acajoom will give the SMTP server the time to send out the messages before proceeding with the next configured amount of messages.');
define('_ACA_EMAIL_BET_PAUSE', 'Emails between pauses');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'The number of emails to send before pausing.');
define('_ACA_WAIT_USER_PAUSE', 'Wait for user input at pause');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Whether the script should wait for user input when paused between sets of mailings.');
define('_ACA_SCRIPT_TIMEOUT', 'Script timeout');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'The number of minutes the script should be able to run (0 for unlimited).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Enable read statistics');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Select yes if you want to log the number of views. This technique can only be used with html mailings');
define('_ACA_LOG_VIEWSPERSUB', 'Log views per subscriber');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Select yes if you want to log the number of views per subscriber. This technique can only be used with html mailings');
// Logs settings
define('_ACA_DETAILED', 'Detailed logs');
define('_ACA_SIMPLE', 'Simplified logs');
define('_ACA_DIAPLAY_LOG', 'Display logs');
define('_ACA_DISPLAY_LOG_TIPS', 'Select yes if you want to display the logs while sending mailings.');
define('_ACA_SEND_PERF_DATA', 'Send out performance');
define('_ACA_SEND_PERF_DATA_TIPS', 'Select yes if you want to allow Acajoom to send out ANONYMOUS reports about your configuration, the number of subscribers to a list and the time it took to send the mailing. This will give us an idea about Acajoom performance and will HELP US	improve Acajoom in future developments.');
define('_ACA_SEND_AUTO_LOG', 'Send log for auto-responder');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Select yes if you want to send an email log each time teh queue is processed.  WARMING: this can resuLt in a large among of emails.');
define('_ACA_SEND_LOG', 'Send log');
define('_ACA_SEND_LOG_TIPS', 'Whether a log of the mailing should be emailed to the email address of the user who sent the mailing.');
define('_ACA_SEND_LOGDETAIL', 'Send log detail');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Detailed includes the success or failure information for each subscriber and an overview of the information. Simple only sends the overview.');
define('_ACA_SEND_LOGCLOSED', 'Send log if connection closed');
define('_ACA_SEND_LOGCLOSED_TIPS', 'With this option on the user who sent the mailing will still receive a report by email.');
define('_ACA_SAVE_LOG', 'Save log');
define('_ACA_SAVE_LOG_TIPS', 'Whether a log of the mailing should be appended to the log file.');
define('_ACA_SAVE_LOGDETAIL', 'Save log detail');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Detailed includes the success or failure information for each subscriber and an overview of the information. Simple only saves the overview.');
define('_ACA_SAVE_LOGFILE', 'Save log file');
define('_ACA_SAVE_LOGFILE_TIPS', 'File to which log information is appended. This file could become rather large.');
define('_ACA_CLEAR_LOG', 'Clear log');
define('_ACA_CLEAR_LOG_TIPS', 'Clears the log file.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Last executed queue');
define('_ACA_CP_TOTAL', 'Total');
define('_ACA_MAILING_COPY', 'Mailing successfully copied!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Show guide');
define('_ACA_SHOW_GUIDE_TIPS', 'Show the guide at the starts to help new users to create a newsletter, an auto-responder and setup Acajoom properly.');
define('_ACA_AUTOS_ON', 'Use Auto-responders');
define('_ACA_AUTOS_ON_TIPS', 'Select No if you don\'t want to use Auto-responders, all the auto-responders option will be desactivated.');
define('_ACA_NEWS_ON', 'Use Newsletters');
define('_ACA_NEWS_ON_TIPS', 'Select No if you don\'t want to use Newsletters, all the newsletters option will be desactivated.');
define('_ACA_SHOW_TIPS', 'Show tips');
define('_ACA_SHOW_TIPS_TIPS', 'Show the tips, to help users use Acajoom more effectively.');
define('_ACA_SHOW_FOOTER', 'Show the footer');
define('_ACA_SHOW_FOOTER_TIPS', 'Whether or not the footer copyright notice should be displayed.');
define('_ACA_SHOW_LISTS', 'Show lists in frontend');
define('_ACA_SHOW_LISTS_TIPS', 'When user are not registered show a list of the lists they can subscribe to with archive button for newsletter or simply a login form so that they register.');
define('_ACA_CONFIG_UPDATED', 'The configuration details have been updated!');
define('_ACA_UPDATE_URL', 'Update URL');
define('_ACA_UPDATE_URL_WARNING', 'WARNING! Do not change this URL unless you have been asked to do so by Acajoom technical team.<br />');
define('_ACA_UPDATE_URL_TIPS', 'For example: http://www.acajoom.com/update/ (include the closing slash)');

// module
define('_ACA_EMAIL_INVALID', 'The email entered is invalid.');
define('_ACA_REGISTER_REQUIRED', 'Please register to the site before you can sign for a list.');

// Access level box
define('_ACA_OWNER', 'Creator of the list:');
define('_ACA_ACCESS_LEVEL', 'Set access level for the list');
define('_ACA_ACCESS_LEVEL_OPTION', 'Access level Options');
define('_ACA_USER_LEVEL_EDIT', 'Select which user level is allowed to edit a mailing (either from frontend or backend) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Daily');
define('_ACA_AUTO_DAY_CH2', 'Daily  no weekend');
define('_ACA_AUTO_DAY_CH3', 'Every other day');
define('_ACA_AUTO_DAY_CH4', 'Every other day no weekend');
define('_ACA_AUTO_DAY_CH5', 'Weekly');
define('_ACA_AUTO_DAY_CH6', 'Bi-weekly');
define('_ACA_AUTO_DAY_CH7', 'Monthly');
define('_ACA_AUTO_DAY_CH9', 'Yearly');
define('_ACA_AUTO_OPTION_NONE', 'No');
define('_ACA_AUTO_OPTION_NEW', 'New Users');
define('_ACA_AUTO_OPTION_ALL', 'All Users');

//
define('_ACA_UNSUB_MESSAGE', 'Unsubscribe Email');
define('_ACA_UNSUB_SETTINGS', 'Unsubscribe Settings');
define('_ACA_AUTO_ADD_NEW_USERS', 'Auto Subscribe Users?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'There are currently no update available.');
define('_ACA_VERSION', 'Acajoom Version');
define('_ACA_NEED_UPDATED', 'Files that need to be updated:');
define('_ACA_NEED_ADDED', 'Files that need to be added:');
define('_ACA_NEED_REMOVED', 'Files that need to be removed:');
define('_ACA_FILENAME', 'Filename:');
define('_ACA_CURRENT_VERSION', 'Current version:');
define('_ACA_NEWEST_VERSION', 'Newest version:');
define('_ACA_UPDATING', 'Updating');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'The files have been updated successfully.');
define('_ACA_UPDATE_FAILED', 'Update failed!');
define('_ACA_ADDING', 'Adding');
define('_ACA_ADDED_SUCCESSFULLY', 'Added successfully.');
define('_ACA_ADDING_FAILED', 'Adding failed!');
define('_ACA_REMOVING', 'Removing');
define('_ACA_REMOVED_SUCCESSFULLY', 'Removed successfully.');
define('_ACA_REMOVING_FAILED', 'Removing failed!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Install a different version');
define('_ACA_CONTENT_ADD', 'Add content');
define('_ACA_UPGRADE_FROM', 'Import data (newsletters and subscribers\' information) from ');
define('_ACA_UPGRADE_MESS', 'There are no risk to your existing data. <br /> This process will simply import the data to the Acajoom database.');
define('_ACA_CONTINUE_SENDING', 'Continue sending');

// Acajoom message
define('_ACA_UPGRADE1', 'You can easily import your users and newsletters from ');
define('_ACA_UPGRADE2', ' to Acajoom in the updates panel.');
define('_ACA_UPDATE_MESSAGE', 'A new version of Acajoom is available! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Click here to update!');
define('_ACA_THANKYOU', 'Thank you for choosing Acajoom, Your communication partner!');
define('_ACA_NO_SERVER', 'Update Server not available, please check back later.');
define('_ACA_MOD_PUB', 'Acajoom module is not published.');
define('_ACA_MOD_PUB_LINK', 'Click here to publish it!');
define('_ACA_IMPORT_SUCCESS', 'successfully imported');
define('_ACA_IMPORT_EXIST', 'subscriber already in database');

// Acajoom\'s Guide
define('_ACA_GUIDE', '\'s Wizard');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom has many great features and this wizard will guide you through a four easy steps process to get you started sending your newsletters and auto-responders!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'First, you need to add a list.  A list could be of two types, either a newsletter or an auto-responder.' .
		'  In the list you define all the different parameters to enable the sending of your newsletters or auto-responders: sender name, layout, subscribers\' welcome message, etc...
<br /><br />You can set up your first list  here: <a href="index2.php?option=com_acajoom&act=list" >create a list</a> and click the New button.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom provides you with an easy way to import all data from a previous newsletter system.<br />' .
		' Go to the Import panel and choose your previous newsletter system to import the all your newsletters and subscribers.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANT: the import is risk FREE and doesn\'t affect in any way the data of your previous newsletter system</span><br />' .
		'After the import you will be able to manage your subscribers and mailings directly from Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Great your first list is setup!  You can now write your first %s.  To create it go to: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Auto-responder Management');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Newsletter Management');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' and select your %s. <br /> Then choose your %s in the drop down list.  Create your first mailing by clicking New ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Before you send your first newsletter you may want to check the mail configuration.  ' .
		'Go to the <a href="index2.php?option=com_acajoom&act=configuration" >configuration page</a> to verify the mail settings. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />When you are ready go back to the Newsletters menu, select your mailing and click Send');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'For your auto-responders to be sent you first need to set up a cron task on your server. ' .
		' Please refer to the Cron tab in the configuration panel.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >click here</a> to learn about setting up a cron task. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Make also sure that you have published Acajoom module so that people can sign up for the list.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' You can now also set up an auto-responder.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' You can now also set up a newsletter.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Voila! You are ready to effectively communicate with you visitors and users. This wizard will end as soon as you have entered a second mailing or you can turn it off in the <a href="index2.php?option=com_acajoom&act=configuration" >configuration panel</a>.' .
		'<br /><br />  If you have any question while using Acajoom, please refer to the ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' You will also find lots of information on how to communicate effectively with your subscribers on <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Thank you for using Acajoom. Your Communication Partner!</b> ');
define('_ACA_GUIDE_TURNOFF', 'The wizard is now being turned off!');
define('_ACA_STEP', 'STEP ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom Configuration');
define('_ACA_INSTALL_SUCCESS', 'Succesful Install');
define('_ACA_INSTALL_ERROR', 'Installation Error');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Acajoom Module');
//Others
define('_ACA_JAVASCRIPT','!Warning! Javascript must be enabled for proper operation.');
define('_ACA_EXPORT_TEXT','The subscribers exported is based on the list you have chosen. <br />Export subscribers for list');
define('_ACA_IMPORT_TIPS','Import subscribers. The information in the file need to be to the following format: <br />' .
		'Name,email,receiveHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmed(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'is already a subscriber');
define('_ACA_GET_STARTED', 'Click here to get started!');

//News since 1.0.1
define('_ACA_WARNING_1011','Warning: 1011: Update will not work because of your server restrictions.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Choose which email address will show as the sender.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Choose what name will show as the sender.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Choose which mailer you wish to use: PHP mail function, <span>Sendmail</span> or SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'This is the directory of the Mail server');
define('_ACA_LIST_T_TEMPLATE', 'Template');
define('_ACA_NO_MAILING_ENTERED', 'No mailing provided');
define('_ACA_NO_LIST_ENTERED', 'No list provided');
define('_ACA_SENT_MAILING' , 'Sent mailings');
define('_ACA_SELECT_FILE', 'Please select a file to ');
define('_ACA_LIST_IMPORT', 'Check the list(s) you want the subscribers to be associated with.');
define('_ACA_PB_QUEUE', 'Subscriber inserted but problem to connect him/her to the list(s). Please check manually.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Update Highly recommanded!');
define('_ACA_UPDATE_MESS2' , 'Patch and small fixes.');
define('_ACA_UPDATE_MESS3' , 'New release.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 is required to update.');
define('_ACA_UPDATE_IS_AVAIL' , ' is available!');
define('_ACA_NO_MAILING_SENT', 'No mailing sent!');
define('_ACA_SHOW_LOGIN', 'Show login form');
define('_ACA_SHOW_LOGIN_TIPS', 'Select Yes to show a login form in the front-end Acajoom control panel so that user can register to the website.');
define('_ACA_LISTS_EDITOR', 'List Description Editor');
define('_ACA_LISTS_EDITOR_TIPS', 'Select Yes to use an HTML editor to edit the list description field.');
define('_ACA_SUBCRIBERS_VIEW', 'View subscribers');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Front-end Settings' );
define('_ACA_SHOW_LOGOUT', 'Show logout button');
define('_ACA_SHOW_LOGOUT_TIPS', 'Select Yes to show a logout button in the front-end Acajoom control panel.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integration');
define('_ACA_CB_INTEGRATION', 'Community Builder Integration');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin for Community Builder is not yet installed!');
define('_ACA_CB_PLUGIN', 'Lists at registration');
define('_ACA_CB_PLUGIN_TIPS', 'Select Yes to show the mailing lists in the community builder registration form');
define('_ACA_CB_LISTS', 'List IDs');
define('_ACA_CB_LISTS_TIPS', 'THIS IS A REQUIRED FIELD. Enter the id number of the lists you wish to allow users to subscribe to seperated by a comma ,  (0 show all the lists)');
define('_ACA_CB_INTRO', 'Introduction text');
define('_ACA_CB_INTRO_TIPS', 'A text that appear will appear before the listing. LEAVE BLANK TO SHOW NOTHING.  You can use HTML tags to customize the look and feel.');
define('_ACA_CB_SHOW_NAME', 'Show List Name');
define('_ACA_CB_SHOW_NAME_TIPS', 'Select whether or not to show the name of the list after the introduction.');
define('_ACA_CB_LIST_DEFAULT', 'Check list by default');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Select whether or not to you want the check box for each list checked by default.');
define('_ACA_CB_HTML_SHOW', 'Show Receive HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Set to Yes to allow users to decide whether they want HTML emails or not. Set to No to use default receive html.');
define('_ACA_CB_HTML_DEFAULT', 'Default Receive HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Set this option to show the default html mailing configuration. If the Show Receive HTML is set to No then this option will be the default.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Could not backup the file! File not replaced.');
define('_ACA_BACKUP_YOUR_FILES', 'The old version of the files have been backed up into the following directory:');
define('_ACA_SERVER_LOCAL_TIME', 'Server local time');
define('_ACA_SHOW_ARCHIVE', 'Show archive button');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Select YES to show the archive button in the front end on the Newsletter listing');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Images');
define('_ACA_LIST_OPT_CTT', 'Content');
define('_ACA_INPUT_NAME_TIPS', 'Enter your full name (firstname first)');
define('_ACA_INPUT_EMAIL_TIPS', 'Enter your email address (Make sure this is a valid email address if you want to receive our mailings.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Choose Yes if you want to receive HTML mailings - No to receive Text only mailings');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Specify your time zone.');

// Since 1.0.5
define('_ACA_FILES' , 'Files');
define('_ACA_FILES_UPLOAD' , 'Upload');
define('_ACA_MENU_UPLOAD_IMG' , 'Upload Images');
define('_ACA_TOO_LARGE' , 'File size too large. The maximum permitted size is');
define('_ACA_MISSING_DIR' , 'Destination directory doesn\'t exist');
define('_ACA_IS_NOT_DIR' , 'The destination directory doesn\'t exist or is a regular file.');
define('_ACA_NO_WRITE_PERMS' , 'The destination directory doesn\'t have write perms.');
define('_ACA_NO_USER_FILE' , 'You haven\'t selected any file for uploading.');
define('_ACA_E_FAIL_MOVE' , 'Impossible to move the file.');
define('_ACA_FILE_EXISTS' , 'The destination file already exists.');
define('_ACA_CANNOT_OVERWRITE' , 'The destination file already exists and could not be overwritten.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'File extension not permitted.');
define('_ACA_PARTIAL' , 'The file was only partially uploaded.');
define('_ACA_UPLOAD_ERROR' , 'Upload error:');
define('DEV_NO_DEF_FILE' , 'The file was only partially uploaded.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = This will be replaced with the subscription links.' .
		' This is <strong>required</strong> to make Acajoom work properly.<br />' .
		'If you place any other content in this box it will be display in all mailings corresponding to this list.' .
		' <br />Add your subscription message at the end.  Acajoom will automatically add a link for the subscriber to change their information and a link to unsubscribe from the list.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notification');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notifications');
define('_ACA_USE_SEF', 'SEF in mailings');
define('_ACA_USE_SEF_TIPS', 'It is recommended that you choose No.  However if you want the URL included in your mailings to use SEF then choose Yes.' .
		' <br /><b>The links will works the same for either options.  No will insure that the links in the mailings will always works even if you change your SEF.</b> ');
define('_ACA_ERR_NB' , 'Error #: ERR');
define('_ACA_ERR_SETTINGS', 'Error handeling settings');
define('_ACA_ERR_SEND' ,'Send error report');
define('_ACA_ERR_SEND_TIPS' ,'If you want Acajoom be a better product please select YES.  This will send us an error report.  So you even dont need to report bugs anymore ;-) <br /> <b>NO PRIVATE INFORMATION IS SENT</b>.  We dont even know from what website the error is coming from. We send only information about Acajoom, the PHP setup and SQL queries. ');
define('_ACA_ERR_SHOW_TIPS' ,'Choose Yes to show error number on the screen.  Mainly used for debuging purpose. ');
define('_ACA_ERR_SHOW' ,'Show errors');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Show unsubscribe links');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Select Yes to show the unsubscribe links at the bottom of the mailings for users to change their subscriptions. <br /> No disable the footer and links.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">IMPORTANT NOTICE!</span> <br />If you are upgrading from a previous Acajoom install you need to upgrade your database structure by clicking on the following button (Your data will stay in integrity)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Upgrade tables and configuration');
define('_ACA_MAILING_MAX_TIME', 'Max queue time' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Define the maximum time for each set of emails sent by the queue. Recommanded between 30s and 2mins.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart Integration');
define('_ACA_VM_COUPON_NOTIF', 'Coupon notification ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Specify the ID number of the mailing you want to use to send coupons to your shoppers.');
define('_ACA_VM_NEW_PRODUCT', 'New products notification ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Specify the ID number of the mailing you want to use to send new products notification.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Create form');
define('_ACA_FORM_COPY', 'HTML code');
define('_ACA_FORM_COPY_TIPS', 'Copy the generated HTML code into your HTML page.');
define('_ACA_FORM_LIST_TIPS', 'Select the list you want to include in the form');
// update messages
define('_ACA_UPDATE_MESS4' , 'It can\'t be updated automatically.');
define('_ACA_WARNG_REMOTE_FILE' , 'No way to get remote file.');
define('_ACA_ERROR_FETCH' , 'Error fetching file.');

define('_ACA_CHECK' , 'Check');
define('_ACA_MORE_INFO' , 'More info');
define('_ACA_UPDATE_NEW' , 'Update to newer version');
define('_ACA_UPGRADE' , 'Upgrade to higher product');
define('_ACA_DOWNDATE' , 'Roll back to previous version');
define('_ACA_DOWNGRADE' , 'Back to basic product');
define('_ACA_REQUIRE_JOOM' , 'Require Joomla');
define('_ACA_TRY_IT' , 'Try it!');
define('_ACA_NEWER', 'Newer');
define('_ACA_OLDER', 'Older');
define('_ACA_CURRENT', 'Current');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Try one of the other components');
define('_ACA_MENU_VIDEO' , 'Video tutorials');
define('_ACA_SCHEDULE_TITLE', 'Automatic schedule function setting');
define('_ACA_ISSUE_NB_TIPS' , 'Issue number generated automatically by the system' );
define('_ACA_SEL_ALL' , 'All mailings');
define('_ACA_SEL_ALL_SUB' , 'All lists');
define('_ACA_INTRO_ONLY_TIPS' , 'If you check this box only the introduction of the article will be inserted into the mailing with a read more link to the complete article on your site.' );
define('_ACA_TAGS_TITLE' , 'Content tag');
define('_ACA_TAGS_TITLE_TIPS' , 'Copy and paste this tag into the mailing where you want to have the content to be placed.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Indicate the email address to send a test to');
define('_ACA_PREVIEW_TITLE' , 'Preview');
define('_ACA_AUTO_UPDATE' , 'New update notification');
define('_ACA_AUTO_UPDATE_TIPS' , 'Select Yes if you want to be notified of new updates for your component. <br />IMPORTANT!! Show tips needs to be on for this function to work.');

// since 1.1.0
define('_ACA_LICENSE' , 'License Information');

// since 1.1.1
define('_ACA_NEW' , 'New');
define('_ACA_SCHEDULE_SETUP', 'In order for the autoresponders to be sent you need to setup scheduler in the configuration.');
define('_ACA_SCHEDULER', 'Scheduler');
define('_ACA_ACAJOOM_CRON_DESC' , 'if you do not have access to a cron task manager on your website, you can register for a Free Acajoom Cron account at:' );
define('_ACA_CRON_DOCUMENTATION' , 'You can find further information on setting up the Acajoom Scheduler at the following url:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Queue processed succefully...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Error moving imported file' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Scheduler frequency' );
define( '_ACA_CRON_MAX_FREQ' , 'Scheduler max frequency' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Specify the maximum frequency the scheduler can run ( in minutes ).  This will limit the scheduler even if the cron task is set up more frequently.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Maximum emails per task' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Specify the maximum number of emails sent per task (0 unlimited).' );
define( '_ACA_CRON_MINUTES' , ' minutes' );
define( '_ACA_SHOW_SIGNATURE' , 'Show email footer' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Whether or not you want to promote Acajoom in the footer of the emails.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Auto-responders processed successfully...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Scheduled newsletters processed successfully...' );
define( '_ACA_MENU_SYNC_USERS' , 'Sync Users' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Users Synchronization Successful!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Yes' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'No' );
if (!defined('_HI')) define( '_HI', 'Hi' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Top' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Bottom' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'If you select this only the title of the article will be inserted into the mailing as a link to the complete article on your site.');
define('_ACA_TITLE_ONLY' , 'Title Only');
define('_ACA_FULL_ARTICLE_TIPS' , 'If you select this the complete article will be inserted into the mailing');
define('_ACA_FULL_ARTICLE' , 'Full Article');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Select a content item to append to the message. <br />Copy and paste the <b>content tag</b> into the mailing.  You can choose to have the full text, intro only, or title only with (0, 1, or 2 respectively). ');
define('_ACA_SUBSCRIBE_LIST2', 'Mailing list(s)');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Smart-Newsletter');
define('_ACA_MENU_AUTONEWS', 'Smart-Newsletters');
define('_ACA_AUTO_NEWS_OPTION', 'Smart-Newsletter options');
define('_ACA_AUTONEWS_FREQ', 'Newsletter Frequency');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Specify the frequency at which you want to send the smart-newsletter.');
define('_ACA_AUTONEWS_SECTION', 'Article Section');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Specify the section you want to choose the articles from.');
define('_ACA_AUTONEWS_CAT', 'Article Category');
define('_ACA_AUTONEWS_CAT_TIPS', 'Specify the category you want to choose the articles from (All for all article in that section).');
define('_ACA_SELECT_SECTION', 'Select a section');
define('_ACA_SELECT_CAT', 'All Categories');
define('_ACA_AUTO_DAY_CH8', 'Quaterly');
define('_ACA_AUTONEWS_STARTDATE', 'Start date');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Specify the date you want to start sending the Smart Newsletter.');
define('_ACA_AUTONEWS_TYPE', 'Content rendering');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Full Article: will include the entire article in the newsletter.<br />' .
		'Intro only: will include only the introduction of the article in the newsletter.<br/>' .
		'Title only: will include only the title of the article in the newsletter.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = This will be replaced by the Smart-newsletter.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Create / View Mailings');
define('_ACA_LICENSE_CONFIG' , 'License' );
define('_ACA_ENTER_LICENSE' , 'Enter license');
define('_ACA_ENTER_LICENSE_TIPS' , 'Enter your license number and save it.');
define('_ACA_LICENSE_SETTING' , 'License settings' );
define('_ACA_GOOD_LIC' , 'Your license is valid.' );
define('_ACA_NOTSO_GOOD_LIC' , 'Your license is not valid: ' );
define('_ACA_PLEASE_LIC' , 'Please contact Acajoom support to upgrade your license ( license@acajoom.com ).' );
define('_ACA_DESC_PLUS', 'Acajoom Plus is the first sequencial auto-responders for Joomla CMS.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO the ultimate mailing system for Joomla CMS.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , 'Enter token');

define('_ACA_ENTER_TOKEN_TIPS' , 'Please enter your token number you received by email when you purchased Acajoom. ');

define('_ACA_ACAJOOM_SITE', 'Acajoom site:');
define('_ACA_MY_SITE', 'My site:');

define( '_ACA_LICENSE_FORM' , ' ' .
 		'Click here to go to the license form.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Please clear the license field so it is empty and try again.<br />  If the problem persists, ' );

define( '_ACA_LICENSE_SUPPORT' , 'If you still have questions, ' . _ACA_PLEASE_LIC );

define( '_ACA_LICENSE_TWO' , 'you can get your license manual by entering the token number and site URL (which is highlighted in green at the top of this page) in the License form. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );

define('_ACA_ENTER_TOKEN_PATIENCE', 'After saving your token a license will be generated automatically. ' .
		' Usually the token is validated in 2 minutes.  However, in some cases it can take up to 15 minutes.<br />' .
		'<br />Check back this control panel in few minutes.  <br /><br />' .
		'If you didn\'t receive a valid license key in 15 minutes, '. _ACA_LICENSE_TWO);


define( '_ACA_ENTER_NOT_YET' , 'Your token has not yet been validated.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Pleae visit <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> to download the newest version.');
define( '_ACA_NOTIF_UPDATE' , 'To be notified of new updates enter your email address and click subscribe ');

define('_ACA_THINK_PLUS', 'If you want more out of your mailing system think Plus!');
define('_ACA_THINK_PLUS_1', 'Sequential auto-responders');
define('_ACA_THINK_PLUS_2', 'Schedule the delivery of your newsletter for a predefined date');
define('_ACA_THINK_PLUS_3', 'No more server limitation');
define('_ACA_THINK_PLUS_4', 'and much more...');

//since 1.2.2
define( '_ACA_LIST_ACCESS', 'List Access' );
define( '_ACA_INFO_LIST_ACCESS', 'Specify what group of users can view and subscribe to this list' );
define( 'ACA_NO_LIST_PERM', 'You don\'t have enough permission to subscribe to this list' );

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', 'Archive');
 define('_ACA_MENU_ARCHIVE_ALL', 'Archive All');

//Archive Lists
 define('_FREQ_OPT_0', 'None');
 define('_FREQ_OPT_1', 'Every Week');
 define('_FREQ_OPT_2', 'Every 2 Weeks');
 define('_FREQ_OPT_3', 'Every Month');
 define('_FREQ_OPT_4', 'Every Quarter');
 define('_FREQ_OPT_5', 'Every Year');
 define('_FREQ_OPT_6', 'Other');

define('_DATE_OPT_1', 'Created date');
define('_DATE_OPT_2', 'Modified date');

define('_ACA_ARCHIVE_TITLE', 'Setting up auto-archive frequency');
define('_ACA_FREQ_TITLE', 'Archive frequency');
define('_ACA_FREQ_TOOL', 'Define how often you want the Archive Manager to arhive your website content.');
define('_ACA_NB_DAYS', 'Number of days');
define('_ACA_NB_DAYS_TOOL', 'This is only for the Other option! Please specify the number of days between each Archive.');
define('_ACA_DATE_TITLE', 'Date type');
define('_ACA_DATE_TOOL', 'Define if the archived should be done on the created date or modified date.');

define('_ACA_MAINTENANCE_TAB', 'Maintenance settings');
define('_ACA_MAINTENANCE_FREQ', 'Maintenance frequency');
define( '_ACA_MAINTENANCE_FREQ_TIPS', 'Specify the frequency at which you want the maintenance routine to run.' );
define( '_ACA_CRON_DAYS' , 'hour(s)' );

define( '_ACA_LIST_NOT_AVAIL', 'There is no list available.');
define( '_ACA_LIST_ADD_TAB', 'Add/Edit' );

define( '_ACA_LIST_ACCESS_EDIT', 'Mailing Add/Edit Access' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', 'Specify what group of users can add or edit a new mailing for this list' );
define( '_ACA_MAILING_NEW_FRONT', 'Create a New Mailing' );

define('_ACA_AUTO_ARCHIVE', 'Auto-Archive');
define('_ACA_MENU_ARCHIVE', 'Auto-Archive');

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', '[ISSUENB] = This will be replaced by the issue number of  the newsletter.');
define('_ACA_TAGS_DATE', '[DATE] = This will be replaced by the sent date.');
define('_ACA_TAGS_CB', '[CBTAG:{field_name}] = This will be replaced by the value taken from the Community Builder field: eg. [CBTAG:firstname] ');
define( '_ACA_MAINTENANCE', 'Maintenance' );

define('_ACA_THINK_PRO', 'When you have professional needs, you use professional components!');
define('_ACA_THINK_PRO_1', 'Smart-Newsletters');
define('_ACA_THINK_PRO_2', 'Define access level for your list');
define('_ACA_THINK_PRO_3', 'Define who can edit/add mailings');
define('_ACA_THINK_PRO_4', 'More tags: add your CB fields');
define('_ACA_THINK_PRO_5', 'Joomla contents Auto-archive');
define('_ACA_THINK_PRO_6', 'Database optimization');

define('_ACA_LIC_NOT_YET', 'Your license is not yet valid.  Please check the license Tab in the configuration panel.');
define('_ACA_PLEASE_LIC_GREEN' , 'Make sure to provide the green information at the top of the tab to our support team.' );

define('_ACA_FOLLOW_LINK' , 'Get Your License');
define( '_ACA_FOLLOW_LINK_TWO' , 'You can get your license by entering the token number and site URL (which is highlighted in green at the top of this page) in the License form. ');
define( '_ACA_ENTER_TOKEN_TIPS2', ' Then click on Apply button in the top right menu.' );
define( '_ACA_ENTER_LIC_NB', 'Enter your License' );
define( '_ACA_UPGRADE_LICENSE', 'Upgrade Your License');
define( '_ACA_UPGRADE_LICENSE_TIPS' , 'If you received a token to upgrade your license please enter it here, click Apply and proceed to number <b>2</b> to get your new license number.' );

define( '_ACA_MAIL_FORMAT', 'Encoding format' );
define( '_ACA_MAIL_FORMAT_TIPS', 'What format do you want to use for encoding your mailings, Text only or MIME' );
define( '_ACA_ACAJOOM_CRON_DESC_ALT', 'If you do not have access to a cron task manager on your website, you can use the Free jCron component to create a cron task from your website.' );

//since 1.3.1
define('_ACA_SHOW_AUTHOR', 'Show Author\'s Name');
define('_ACA_SHOW_AUTHOR_TIPS', 'Select Yes if you want to add the name of the author when you add an article in the Mailing');

//since 1.3.5
define('_ACA_REGWARN_NAME','Please enter your name.');
define('_ACA_REGWARN_MAIL','Please enter a valid e-mail address.');

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS','If you select Yes, the e-mail of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be useful if you want to execute a special script in your redirect page.');
define('_ACA_ADDEMAILREDLINK','Add e-mail to the redirect link');

//since 1.6.3
define('_ACA_ITEMID','ItemId');
define('_ACA_ITEMID_TIPS','This ItemId will be added to your Acajoom links.');

//since 1.6.5
define('_ACA_SHOW_JCALPRO','jCalPRO');
define('_ACA_SHOW_JCALPRO_TIPS','Show the integration tab for jCalPRO <br/>(only if jCalPRO is installed on your website!)');
define('_ACA_JCALTAGS_TITLE','jCalPRO Tag:');
define('_ACA_JCALTAGS_TITLE_TIPS','Copy and paste this tag into the mailing where you want to have the event to be placed.');
define('_ACA_JCALTAGS_DESC','Description:');
define('_ACA_JCALTAGS_DESC_TIPS','Select Yes if you want to insert the description of the event');
define('_ACA_JCALTAGS_START','Start date:');
define('_ACA_JCALTAGS_START_TIPS','Select Yes if you want to insert the start date of the event');
define('_ACA_JCALTAGS_READMORE','Read more:');
define('_ACA_JCALTAGS_READMORE_TIPS','Select Yes if you want to insert a <b>read more link</b> for this event');
define('_ACA_REDIRECTCONFIRMATION','Redirect URL');
define('_ACA_REDIRECTCONFIRMATION_TIPS','If you require a confirmation e-mail, the user will be confirmed and redirected to this URL if he clicks on the confirmation link.');

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Save');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','No account yet?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Register');
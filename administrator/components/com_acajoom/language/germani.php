<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>German informal language file.</p>
* @copyright (c) 2006 David Freund / All Rights Reserved
* @author David Freund <david@mjjd.de>
* @version 1.0.4
* @version $Id: germani.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom ist eine Komponente, zum Verwalten von Mailinglisten, Newslettern, Autorespondern und mehr, um effizient mit seinen Bentuzern und Kunden zu kommunizieren. ' .
		'Acajoom, dein Kommunikationspartner!');
define('_ACA_FEATURES', 'Acajoom, dein Kommunikationspartner!');

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
define('_ACA_LIST', 'Liste');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Listenverwaltung');
define('_ACA_MENU_SUBSCRIBERS', 'Abonnementen');
define('_ACA_MENU_NEWSLETTERS', 'Newsletter');
define('_ACA_MENU_AUTOS', 'Auto-responders');
define('_ACA_MENU_COUPONS', 'Coupons');
define('_ACA_MENU_CRONS', 'Cron Tasks');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Post cards');
define('_ACA_MENU_PERFS', 'Performance');
define('_ACA_MENU_TAB_LIST', 'Liste');
define('_ACA_MENU_MAILING_TITLE', 'Mailings');
define('_ACA_MENU_MAILING' , 'Mailings für');
define('_ACA_MENU_STATS', 'Statistik');
define('_ACA_MENU_STATS_FOR', 'Statistik für');
define('_ACA_MENU_CONF', 'Konfiguration');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Über');
define('_ACA_MENU_LEARN', 'Lerncenter');
define('_ACA_MENU_MEDIA', 'Media Manager');
define('_ACA_MENU_HELP', 'Hilfe');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Importieren');
define('_ACA_MENU_EXPORT', 'Exportieren');
define('_ACA_MENU_SUB_ALL', 'ALLE eintragen');
define('_ACA_MENU_UNSUB_ALL', 'ALLE austragen');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archiv');
define('_ACA_MENU_PREVIEW', 'Vorschau');
define('_ACA_MENU_SEND', 'Senden');
define('_ACA_MENU_SEND_TEST', 'Test senden');
define('_ACA_MENU_SEND_QUEUE', 'Prozessablauf');
define('_ACA_MENU_VIEW', 'Ansehen');
define('_ACA_MENU_COPY', 'Kopieren');
define('_ACA_MENU_VIEW_STATS' , 'Zeige Statistiken');
define('_ACA_MENU_CRTL_PANEL' , ' Control Panel');
define('_ACA_MENU_LIST_NEW' , ' Erstelle eine Liste');
define('_ACA_MENU_LIST_EDIT' , ' Bearbeite eine Liste');
define('_ACA_MENU_BACK', 'Zurück');
define('_ACA_MENU_INSTALL', 'Installation');
define('_ACA_MENU_TAB_SUM', 'Zusammenfassung');
define('_ACA_STATUS' , 'Status');

// messages
define('_ACA_ERROR' , ' Ein Fehler trat auf! ');
define('_ACA_SUB_ACCESS' , 'Zugangsrechte');
define('_ACA_DESC_CREDITS', 'Credits');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Homepage');
define('_ACA_DESC_MAILING', 'Mailing list');
define('_ACA_DESC_SUBSCRIBERS', 'Abonement');
define('_ACA_PUBLISHED','Veröffentlicht');
define('_ACA_UNPUBLISHED','Unveröffentlicht');
define('_ACA_DELETE','Löschen');
define('_ACA_FILTER','Filter');
define('_ACA_UPDATE','Update');
define('_ACA_SAVE','Speichern');
define('_ACA_CANCEL','Abbruch');
define('_ACA_NAME','Name');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Auswählen');
define('_ACA_ALL','AllE');
define('_ACA_SEND_A', 'Sende einen ');
define('_ACA_SUCCESS_DELETED', ' erfolgreich gelöscht');
define('_ACA_LIST_ADDED', 'Liste erfolgreich erstellt');
define('_ACA_LIST_COPY', 'Liste erfolgreich kopiert');
define('_ACA_LIST_UPDATED', 'Liste erfolgreich upgedated');
define('_ACA_MAILING_SAVED', 'Mailing erfolgreich gespeichert.');
define('_ACA_UPDATED_SUCCESSFULLY', 'erfolgreich upgedated.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Abonnementeninformationen');
define('_ACA_VERIFY_INFO', 'Bitte überprüfe den übertragenden Link, einige Informationen fehlen.');
define('_ACA_INPUT_NAME', 'Name');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Empfange HTML?');
define('_ACA_TIME_ZONE', 'Zeitzone');
define('_ACA_BLACK_LIST', 'Black list');
define('_ACA_REGISTRATION_DATE', 'Registrierungsdatum');
define('_ACA_USER_ID', 'Benutzer ID');
define('_ACA_DESCRIPTION', 'Beschreibung');
define('_ACA_ACCOUNT_CONFIRMED', 'Dein Account wurde aktiviert.');
define('_ACA_SUB_SUBSCRIBER', 'Abonement');
define('_ACA_SUB_PUBLISHER', 'Publisher');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registrierter');
define('_ACA_SUBSCRIPTIONS', 'Abonnements');
define('_ACA_SEND_UNSUBCRIBE', 'Sende Abmeldungsnachricht');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Klicke auf Ja um eine Abmeldungsbestätigung zu verschicken.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Bitte bestätige deine Anmeldung');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Abmeldungsbestätigung');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hi [NAME],<br />' .
		'Noch ein kurzer Schritt und du hast den Newsletter abonniert. Klicke auf den folgenden Link um deine Registrierung zu bestätigen:' .
		'<br /><br />[CONFIRM]<br /><br />Falls du Fragen hast, wende dich an den Webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Dies ist eine Bestätigungsemail, dass du von der Liste entfernt worden bist. Es tut uns leid, dass du dich entschieden hast, unsere E-Mails nicht weiter zu empfangen. Du kannst dich natürlich jederzeit wieder anmelden.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Anmeldungsdatum');
define('_ACA_CONFIRMED', 'Bestätigung');
define('_ACA_SUBSCRIB', 'Aboniert');
define('_ACA_HTML', 'HTML mailings');
define('_ACA_RESULTS', 'ERgebnisse');
define('_ACA_SEL_LIST', 'Wähle eine Liste');
define('_ACA_SEL_LIST_TYPE', '- Wähle eine Listenart -');
define('_ACA_SUSCRIB_LIST', 'Liste aller Abonnementen');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Angemeldet für: ');
define('_ACA_NO_SUSCRIBERS', 'Es gibt keine Abonnementen auf dieser Liste');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Eine Bestätigungsemail wurde dir zugesand, bitte check deine E-Mails und klick auf den Bestätigungslink.<br />' .
		'Du musst deine E-Mailadresse bestätigen, um dein Abonnement gültig zu machen.');
define('_ACA_SUCCESS_ADD_LIST', 'Du wurdest erfolgreich der Liste hinzugefügt.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Klicke hier um dein Abonnement zu bestätigen.');
define('_ACA_UNSUBSCRIBE_LINK', 'Klicke hier um dich von der Liste wieder abzumelden.');
define('_ACA_UNSUBSCRIBE_MESS', 'Deine E-Mailadresse wurde von der Liste entfern');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Alle geplanten Mailings wurden erfolgreich versendet.');
define('_ACA_MALING_VIEW', 'Zeige alle Mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Bist du sicher, dass du dich von dieser Liste abmelden willst?');
define('_ACA_MOD_SUBSCRIBE', 'Abonnieren');
define('_ACA_SUBSCRIBE', 'Abonnieren');
define('_ACA_UNSUBSCRIBE', 'Abmelden');
define('_ACA_VIEW_ARCHIVE', 'Zeige das Archiv');
define('_ACA_SUBSCRIPTION_OR', ' oder klicke heir für weitere Informationen');
	define('_ACA_EMAIL_ALREADY_REGISTERED', 'Diese E-Mailadresse wurde schon mal angemeldet.');
define('_ACA_SUBSCRIBER_DELETED', 'Abonnementen erfolgreich gelöscht');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Benutzer Kontrollmenü');
define('_UCP_USER_MENU', 'Benutzermenü');
define('_UCP_USER_CONTACT', 'Meine Abonnements');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Cron Task Management');
define('_UCP_CRON_NEW_MENU', 'New Cron');
define('_UCP_CRON_LIST_MENU', 'Zeige meine Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Coupons Management');
define('_UCP_COUPON_LIST_MENU', 'List of Coupons');
define('_UCP_COUPON_ADD_MENU', 'Add a Coupon');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Beschreibung');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Abonement');
define('_ACA_LIST_T_SENDER', 'Absenderinformationen');

define('_ACA_LIST_TYPE', 'Listenart');
define('_ACA_LIST_NAME', 'Listenname');
define('_ACA_LIST_ISSUE', 'Ausgabe #');
define('_ACA_LIST_DATE', 'Sendungsdatum');
define('_ACA_LIST_SUB', 'Mailing Betreff');
define('_ACA_ATTACHED_FILES', 'Angehängte Dateien');
define('_ACA_SELECT_LIST', 'Bitte wähle eine Liste zum editieren aus!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Listenart');
define('_ACA_AUTO_RESP_OPTION', 'Optionen für automatische Antworten');
define('_ACA_AUTO_RESP_FREQ', 'Abonemmenten können Häufigkeit wählen');
define('_ACA_AUTO_DELAY', 'Verzögerung (in Tagen)');
define('_ACA_AUTO_DAY_MIN', 'Minimalste Häufigkeit');
define('_ACA_AUTO_DAY_MAX', 'Maximalste Häufigkeit');
define('_ACA_FOLLOW_UP', 'Specify follow up auto-responder');
define('_ACA_AUTO_RESP_TIME', 'Subscribers can choose time');
define('_ACA_LIST_SENDER', 'List sender');

define('_ACA_LIST_DESC', 'List description');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Absendernamen');
define('_ACA_SENDER_EMAIL', 'Absender-Email');
define('_ACA_SENDER_BOUNCE', 'Rückantwortsadresse');
define('_ACA_LIST_DELAY', 'Verzögerung');
define('_ACA_HTML_MAILING', 'HTML Mails?');
define('_ACA_HTML_MAILING_DESC', '(wenn du dieses änders, musst du speichern und die Seite neu laden, um die Änderungen zu sehen.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Im Frontend verstecken?');
define('_ACA_SELECT_IMPORT_FILE', 'Wähle eine Datei zum importieren aus');;
define('_ACA_IMPORT_FINISHED', 'Import beendet');
define('_ACA_DELETION_OFFILE', 'Löschen einer Datei');
define('_ACA_MANUALLY_DELETE', 'gescheitert, du solltest die Datei manuell löschen');
define('_ACA_CANNOT_WRITE_DIR', 'Kann in diesem Verzeichnis nicht schreiben');
define('_ACA_NOT_PUBLISHED', 'Konnte das Mailing nicht verschicken, die Liste wurde nicht veröffentlicht.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Klicke auf Ja um die Liste zu veröffentlichen');
define('_ACA_INFO_LIST_NAME', 'Trage hier den Namen deiner Liste ein. Du kannst die Liste an Hand ihres Namen identifizieren.');
define('_ACA_INFO_LIST_DESC', 'Trage hier eine kurze Beschreibung deiner Liste ein. Diese Beschreibung wird für Besucher deiner Webseite sichtbar sein.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Trage hier den Namen des Absenders für die Mailings ein. Dieser Name wird sichtbar sein, wenn Abonnementen Nachrichten über diese Liste empfangen.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Trage hier die E-Mailadresse ein, von der die Nachrichten versandt werden.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Trage hier die E-Mailadresse ein, auf die Benutzer antworten können. Es ist höchstempfehlenstwert, dass diese, die gleiche wie die Senderadresse ist, da Spamfilter den Nachrichten sonst eher als Spam behandeln.');
define('_ACA_INFO_LIST_AUTORESP', 'Wähle den Typ für Nachrichten dieser Liste:<br />' .
		'Newsletter: Normaler Newsletter<br />' .
		'Auto-responder: Ein auto-responder ist eine Liste, welche automatisch durch die Webseite in regelmäßigen Abständen verschickt wird.');
define('_ACA_INFO_LIST_FREQUENCY', 'Erlaube dem Benutzer wie oft sie Nachrichten von der Liste erhalten. Das gibt den Benutzern mehr Flexibilität.');
define('_ACA_INFO_LIST_TIME', 'Erlaube dem Benutzer auszuwählen, zu welcher Zeit er am liebsten Nachrichten über die Liste empfängt.');
define('_ACA_INFO_LIST_MIN_DAY', 'Definiere was die minimalste Häufigkeit an Nachrichten über die Liste ist, die ein Benutzer wählen kann.');
define('_ACA_INFO_LIST_DELAY', 'Setzte den Abstand zwischem diesem Auto-Respondern und dem vorherigen.');
define('_ACA_INFO_LIST_DATE', 'Setzte das Datum, an dem du diese Nachricht veröffentlichen willst, wenn du die Veröffentlichung verzögern willst. <br /> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Definiere was die maximale Häufigkeit an Nachrichten über die Liste ist, die ein Benutzer wählen kann');
define('_ACA_INFO_LIST_LAYOUT', 'Trage hier das Layout der Mailingliste ein. Du kannst jedes Layout hier eintragen');
define('_ACA_INFO_LIST_SUB_MESS', 'Diese Nachricht wird zum Benutzer geschickt, wenn er oder sie sich registriert. Du kannst jeden Text hier eintragen.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Diese Nachricht wird zum Abonnementen geschickt, wenn er sich von der Liste abgemeldet hat. Jede Nachricht kann hier eingetragen werden.');
define('_ACA_INFO_LIST_HTML', 'Wähle dieses wenn du eine HTML-Mail verschicken willst. Abonnementen haben die Möglichkeit sich auszusuchen, ob sie die HTML-Nachricht empfangen wwollen oder nur den reinen Text, wenn sie eine HTML-Liste abonniert haben.');
define('_ACA_INFO_LIST_HIDDEN', 'Klicke Ja um die Mailingliste vor dem Frontend zu verstecken. Dadruch können Benutzer sich nicht anmelden, aber du kannst weiterhin Mailings verschicken.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Sollen Benutzer automatisch der Liste hinzugefügt werden?<br /><B>Neue Benutzer:</B> Jeder neu registrierte Benutzer wird der Liste hinzugefügt.<br /><B>Alle Benutzer:</B> Registriert jeden Benutzer in der Datenbank.<br />(alle Optionen unterstützten den CommunityBuilder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Bestimme die Zugangsoptionen aus dem Frontend. Damit werden Listen Benutzern gezeigt oder vor ihnen versteckt, wenn sie keinen Zugang zu ihnen haben, also sich nicht eintragen können.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Wähle den Zugangslevel der Benutzergruppe, der du erlauben willst, die Liste zu bearbeiten. Die Benutzergruppe wird in der Lage sein, Mailings zu bearbeiten und zu versenden, sowohl vom Backend, als auch vom Frontend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Wenn du willst, dass der Auto-Responder zu einem weiteren wechselt, sobald es die letzte Nachricht erreicht hat, kannst du hier den folgenden Auto-Responder bestimmen.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Das ist die ID der Person, die die Liste erstellt hat.');
define('_ACA_INFO_LIST_WARNING', '   Diese Option ist nur beim Erstellen der Liste wählbar.');
define('_ACA_INFO_LIST_SUBJET', ' Betreff des Mailings. Das ist der Betreff der E-Mail, die die Benutzer bekommen werden.');
define('_ACA_INFO_MAILING_CONTENT', '^Das ist der Body der E-Mail, die du versenden willst.');
define('_ACA_INFO_MAILING_NOHTML', 'Trage hier den Body der E-Mail ein, den Benutzer erhalten sollen, die keine HTML-E-mails bekommen wollen.');
define('_ACA_INFO_MAILING_VISIBLE', 'Klicke Ja um das Mailing im Frontend anzuzeigen.');
define('_ACA_INSERT_CONTENT', 'Füge existierenden Content ein.');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Coupon erfolgreich versendet!');
define('_ACA_CHOOSE_COUPON', 'Wähle einen Coupon');
define('_ACA_TO_USER', ' an diesen Benutzer');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Jede Stunde');
define('_ACA_FREQ_CH2', 'Alle 6 Stunden');
define('_ACA_FREQ_CH3', 'Alle 12 Stunden');
define('_ACA_FREQ_CH4', 'Täglich');
define('_ACA_FREQ_CH5', 'Wöchentlich');
define('_ACA_FREQ_CH6', 'Monatlich');
define('_ACA_FREQ_NONE', 'Nicht');
define('_ACA_FREQ_NEW', 'Neue Benutzer');
define('_ACA_FREQ_ALL', 'Alle Benutzer');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Klicke Ja wenn du dieses für einen Acajoom Cron nutzen willst, NEin für einen anderen Conjob.<br />' .
		'Wenn du Ja Klickst, musst du keine spezielle Cron-Adresse eingeben, sie wird automatisch dazugefügt.');
define('_ACA_SITE_URL' , 'Die URL deiner Webseite');
define('_ACA_CRON_FREQUENCY' , 'Cron Häufigkeit');
define('_ACA_STARTDATE_FREQ' , 'Anfangsdatum');
define('_ACA_LABELDATE_FREQ' , 'Datum bestimmen');
define('_ACA_LABELTIME_FREQ' , 'Zeit bestmmen');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Häufigkeit');
define('_ACA_TITLE_CRONLIST', 'Cron Liste');
define('_NEW_LIST', 'Erstelle eine neue Liste');

//title CRON form
define('_ACA_TITLE_FREQ', 'Cron Bearbeiten');
define('_ACA_CRON_SITE_URL', 'Bitte trage eine gültige URL ein, beginnend mit http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Alle Mailings');
define('_ACA_EDIT_A', 'Bearbeite ein ');
define('_ACA_SELCT_MAILING', 'Bitte wähle eine Liste aus dem Drop-Down Menü um ein neues Mailing zu verfassen.');
define('_ACA_VISIBLE_FRONT', 'Sichtbar im Frontend');

// mailer
define('_ACA_SUBJECT', 'Betreff');
define('_ACA_CONTENT', 'Inhalt');
define('_ACA_NAMEREP', '[NAME] = Dies wird durch den Namen des Abonnementen ersetzt, die E-Mail wird also personalisiert, wenn du dieses nutzt.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Dies wird durch den VORnamen des Abonnementen ersetzt.<br />');
define('_ACA_NONHTML', 'NICHT-HTML Version');
define('_ACA_ATTACHMENTS', 'Anhänge');
define('_ACA_SELECT_MULTIPLE', 'Halte Steuerung (STRG) um mehrere Anhänge zu wählen.<br />' .
		'Die Dateien, die in der Liste der Anhänge, erscheinen, sind im Ordner Attachements gespeichert. Du kannst diesen Ordner im Konfigurationsmenü ändern.');
define('_ACA_CONTENT_ITEM', 'Inhaltselement');
define('_ACA_SENDING_EMAIL', 'Versende  E-mails');
define('_ACA_MESSAGE_NOT', 'E-Mails konnte nicht versendet werden');
define('_ACA_MAILER_ERROR', 'MAil error');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'E-Mail erfolgreich versendet');
define('_ACA_SENDING_TOOK', 'Diese Mail zu versenden dauerte');
define('_ACA_SECONDS', 'Sekunden');
define('_ACA_NO_ADDRESS_ENTERED', 'Keine Adresse eingetragen');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Ändere');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Ändere deine Abonnements');
define('_ACA_WHICH_EMAIL_TEST', 'Gebe die E-Mailadresse an, an die eine Textmail gesendet werden soll, oder wähle Vorschau');
define('_ACA_SEND_IN_HTML', 'Versene in HTML (für HTML-Mails)?');
define('_ACA_VISIBLE', 'Sichtbar');
define('_ACA_INTRO_ONLY', 'Nur die Einleitung');

// stats
define('_ACA_GLOBALSTATS', 'Allgemeine Statistiken');
define('_ACA_DETAILED_STATS', 'Detailierte Statistiken');
define('_ACA_MAILING_LIST_DETAILS', 'Zeige Details');
define('_ACA_SEND_IN_HTML_FORMAT', 'Sende im HTML-Format');
define('_ACA_VIEWS_FROM_HTML', 'Ansichten (aus HTML-Mails)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Sende im Textformat');
define('_ACA_HTML_READ', 'HTML lesen');
define('_ACA_HTML_UNREAD', 'HTML nicht lesen');
define('_ACA_TEXT_ONLY_SENT', 'Nur Text');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Statistiken');
define('_ACA_SUBSCRIBER_CONFIG', 'Abonnementen');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Verschiedenes');
define('_ACA_MAIL_SETTINGS', 'Mail Einstellungen');
define('_ACA_MAILINGS_SETTINGS', 'Mailing Einstellungen');
define('_ACA_SUBCRIBERS_SETTINGS', 'Abonemmenten Einstellungen');
define('_ACA_CRON_SETTINGS', 'Cron Einstellungen');
define('_ACA_SENDING_SETTINGS', 'Sendeeinstellungen');
define('_ACA_STATS_SETTINGS', 'Statistikeinstellungen');
define('_ACA_LOGS_SETTINGS', 'Logeinstellungen');
define('_ACA_MISC_SETTINGS', 'Verschiedene Einstellungen');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'E-Mail von');
define('_ACA_SEND_MAIL_NAME', 'Von Name');
define('_ACA_MAILSENDMETHOD', 'Versandmethode');
define('_ACA_SENDMAILPATH', 'Sendmail pfad');
define('_ACA_SMTPHOST', 'SMTP Host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP Authentifizierung erforderlich');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Wähle ja, wenn dein SMTP Server Authentifizierung erfordert');
define('_ACA_SMTPUSERNAME', 'SMTP Benutzername');
define('_ACA_SMTPUSERNAME_TIPS', 'Trage den SMTP Benutzername ein, wenn dein SMTP Server Authentifzierung verlangt');
define('_ACA_SMTPPASSWORD', 'SMTP Password');
define('_ACA_SMTPPASSWORD_TIPS', 'Trage dein SMTP Password ein, wenn dein SMTP Server Authentifizierung verlangt');
define('_ACA_USE_EMBEDDED', 'Benutze eingebettete Bilder');
define('_ACA_USE_EMBEDDED_TIPS', 'Wähle ja, wenn die Bilder in HTML E-Mails im Anhang eingebettet werden sollen oder nein, wenn sie mit Standart Bilder Tags über den Server verlinkt werden sollen');
define('_ACA_UPLOAD_PATH', 'Upload/Anhang Pfad');
define('_ACA_UPLOAD_PATH_TIPS', 'Du kannst ein Uploadverzeichnis bestimmen<br />' .
		'Gehe sicher, dass das bestimmte Verzeichnis existiert, oder erstelle es');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Erlaube Nichtregistrierten');
define('_ACA_ALLOW_UNREG_TIPS', 'Wähle JA, wenn du willst, dass Benutzer sich eintragen dürfen, ohne auf der Seite registriert zu sein.');
define('_ACA_REQ_CONFIRM', 'Bestätigung erfordert');
define('_ACA_REQ_CONFIRM_TIPS', 'Wähle Ja, wenn du willst, dass unregistrierte Benutzer ihre E-Mailadresse bestätigen müssen.');
define('_ACA_SUB_SETTINGS', 'Abonnement Einstellungen');
define('_ACA_SUBMESSAGE', 'Abonenmenten Email');
define('_ACA_SUBSCRIBE_LIST', 'Trage dich in eine Liste ein');

define('_ACA_USABLE_TAGS', 'Erlaubte Tags');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Dies erzeugt einen Link, den Benutzer nutzen können, um ihr Abonnement zu bestätigen. Dies ist  <strong>erforderlich</strong> damit Acajoom richtig funktioniert.<br />'
.'<br />[NAME] = Das wird durch den Namen des Abonnmenten ersetzt, die E-Mail wird also personalisiert.br />'
.'<br />[FIRSTNAME] = Dies wird durch den VORnamen des Abonnmenten. VDer Vorname ist definiert als der Vorname, den der Abonnment eingetragen hat.<br />');
define('_ACA_CONFIRMFROMNAME', 'Bestätigung des Namen');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Trage die Bestätigung des Namen ein, um eine Liste der Bestätigungen zu sehen.');
define('_ACA_CONFIRMFROMEMAIL', 'Bestätigung der E-mail');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Trage die E-Mailadresse ein, um eine Liste der Bestätigungen zu sehen.');
define('_ACA_CONFIRMBOUNCE', 'Bestätigung die  Bounce E-Mailadresse');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Trage die Bounce E-Mailadresse ein, um eine Liste der Bestätigungen zu sehen.');
define('_ACA_HTML_CONFIRM', 'HTML Bestätigung');
define('_ACA_HTML_CONFIRM_TIPS', 'Wähle Ja, wenn die Bestätigungsliste HTML sein soll, so fern der Bentuzer HTML erlaubt..');
define('_ACA_TIME_ZONE_ASK', 'Frage nach Zeitzone');
define('_ACA_TIME_ZONE_TIPS', 'Wähle Ja, wenn du willst, dass der Benutzer nach seiner Zeitzone gefragt wird. Die E-Mails werden dann auf Basis der Zeitzone versandt.');

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', 'Klicke hier um di Zeitabweichung in der Global configuration zu setzen. Global configuration --> Lokale');
define('_ACA_TIME_OFFSET_TIPS', 'Setze deine Serverzeitabweichung, so dass das gespeicherte Datum und die Zeit korrekt sind');
define('_ACA_TIME_OFFSET', 'Zeitabweichung');
define('_ACA_CRON_TITLE', 'Stelle die Cron-Funktion ein');
define('_ACA_CRON_DESC','<br />Wenn du die Cron-Funktion nutzt, kannst du eine automatische Aufgabe für deine Joomla Webseite einstellen!<br />' .
		'Um es zu aktivieren musst du in deinen Cronteinstellungen folgenden Befehl ergänzen:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Wenn du Hilfe bei der Einrichtung brauchst, oder Probleme hast, bitte benutzte unser Forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Warte x Sekunden nach einer bestimmten Anzahl von Mails');
define('_ACA_PAUSEX_TIPS', 'Trage eine Anzahl von Sekunden ein, die Acajoom dem SMTP Server gibt, um die E-Mails zu versenden, bevor er mit der nächsten bestimmten Anzahl von E-Mails fortfährt.');
define('_ACA_EMAIL_BET_PAUSE', 'E-Mails zwischen den Pausen');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Anzahl der E-Mails, die zwischen den Pausen versendet werden soll.');
define('_ACA_WAIT_USER_PAUSE', 'Warte auf den Benutzer nach einer Pause');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Soll das Skript nach der Pause zwischen den E-Mails auf eine Benutzereingabe warten.');
define('_ACA_SCRIPT_TIMEOUT', 'Skript brauchte zu lange (Time out)');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Die Anzahl der Minuten, die das Skript laufen sollte.');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Aktiviere Statistiken');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Wähle Ja, wenn gespeichert werden soll, wie viele Leute die E-Mail angesehen haben. Das kann nur bei HTML-Mails genutzt werden.');
define('_ACA_LOG_VIEWSPERSUB', 'Speichere Anzeigen pro Benutzer');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Wähle Ja, wenn Anzeigen pro Benutzer gespeichert werden soll. Dies kann nur bei HTML-Mails genutzt werden.');
// Logs settings
define('_ACA_DETAILED', 'Detailierte Logs');
define('_ACA_SIMPLE', 'Einfache Kogs');
define('_ACA_DIAPLAY_LOG', 'Zeige Logs');
define('_ACA_DISPLAY_LOG_TIPS', 'Wähle Ja, wenn du die Logs während des Mailversandes angezeigt haben möchtest.');
define('_ACA_SEND_PERF_DATA', 'Sendestatistik');
define('_ACA_SEND_PERF_DATA_TIPS', 'Wähle Ja, wenn du Acajoom erlauben willst, anonyme Berichte über deine Konfiguration, die Menge der Abonnmenten einer Liste und der Zeit die das Versenden der Mail zu versenden. Dies würde uns helfen, Acajoom in Zukunft zu verbessern.');
define('_ACA_SEND_AUTO_LOG', 'Sende Logdatei für Auto-Responder');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Wähle Ja, wenn du willst, dass du jedes Mal einen Log bekommst, wenn die Mails verschickt werden. WARNUNG: Dies kann zu einer großen Menge Mails führen');
define('_ACA_SEND_LOG', 'Sende Log');
define('_ACA_SEND_LOG_TIPS', 'Soll ein Log an die E-Mailadresse geschickt werden, welche das Mailing verschickt hat');
define('_ACA_SEND_LOGDETAIL', 'Sende detailierten Logs');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Detailiert beinhaltet Erfolg- oder Fehlermeldungen für jeden Abonnemten und eine Übersicht über diese Informationen. Einfach sendet nur die Übersicht.');
define('_ACA_SEND_LOGCLOSED', 'Sende Log wenn die Verbindung beendet wird.');
define('_ACA_SEND_LOGCLOSED_TIPS', ' Wenn diese Option aktiviert ist, erhält der Benutzer, der das Mailing versandt hat auch einen Bericht per E-Mail.');
define('_ACA_SAVE_LOG', 'Speichere Log');
define('_ACA_SAVE_LOG_TIPS', 'Soll ein Log des Mailings an die Logdatei angehängt werden?');
define('_ACA_SAVE_LOGDETAIL', 'Speiche detailierten Log');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Detailed includes the success or failure information for each subscriber and an overview of the information. Simple only saves the overview.');
define('_ACA_SAVE_LOGFILE', 'Save log file');
define('_ACA_SAVE_LOGFILE_TIPS', 'File to which log information is appended. This file could become rather large.');
define('_ACA_CLEAR_LOG', 'Leere  Log');
define('_ACA_CLEAR_LOG_TIPS', 'Leert die Logdatei.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Letzte ausgeführte Reihe');
define('_ACA_CP_TOTAL', 'Total');
define('_ACA_MAILING_COPY', 'Mailing erfolgreich kopiert!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Zeige Assistenten');
define('_ACA_SHOW_GUIDE_TIPS', 'Zeige den Assistenten am Anfang, um neuen Benutzern zu helfen, eigene Newsletter zu kreieren, einen Auto-Responder und um Acajoom richtig zu konfigurieren.');
define('_ACA_AUTOS_ON', 'Benutze Auto-Responders');
define('_ACA_AUTOS_ON_TIPS', 'Wähle Ja, wenn du Auto-Responder nicht nutzen willst, alle Auto-Responder Optionen werden deaktiviert.');
define('_ACA_NEWS_ON', 'Benutze Newsletter');
define('_ACA_NEWS_ON_TIPS', 'Select No if you don\'t want to use Newsletters, all the newsletters option will be desactivated.');
define('_ACA_SHOW_TIPS', 'Zeige Tipps');
define('_ACA_SHOW_TIPS_TIPS', 'Zeige Tipps damit Benutzer Acajoom einfacher bedienen können.');
define('_ACA_SHOW_FOOTER', 'Zeige den Footer');
define('_ACA_SHOW_FOOTER_TIPS', 'Soll die Copyright Hinweise im Footer angezeigt werden, oder nicht?');
define('_ACA_SHOW_LISTS', 'Zeige Listen im Frontend');
define('_ACA_SHOW_LISTS_TIPS', 'Wenn Benutzer nicht registriert sind, ziege eine Liste der möglichen Newsletter, die sie abonnieren können, sowie den Archiv Button oder das Registrierungsformular.');
define('_ACA_CONFIG_UPDATED', 'Die Konfiguration wurde upgedated!');
define('_ACA_UPDATE_URL', 'Update URL');
define('_ACA_UPDATE_URL_WARNING', 'WARNUNG! Ändere die URL nicht, es sei denn du würdest vom technischen Team von Acajoom darum gebeten<br />');
define('_ACA_UPDATE_URL_TIPS', 'Zum Beispiele: http://www.acajoom.com/update/ (inklusive dem Slash am Ende)');

// module
define('_ACA_EMAIL_INVALID', 'Die eingegebene E-Mail ist ungültig.');
define('_ACA_REGISTER_REQUIRED', 'Bitte registriere dich, bevor du eine Liste abonnierst.');

// Access level box
define('_ACA_OWNER', 'Hersteller der  Liste:');
define('_ACA_ACCESS_LEVEL', 'Setze Zugriffslevel für die Liste');
define('_ACA_ACCESS_LEVEL_OPTION', 'Benutzerlevel Optionen');
define('_ACA_USER_LEVEL_EDIT', 'Wähle welches Benuzterlevel Mailings bearbeiten darf (sowohl im Frontend als auch im Backend) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Täglich');
define('_ACA_AUTO_DAY_CH2', 'Täglich, außer Wochenenden');
define('_ACA_AUTO_DAY_CH3', 'Jeden zweiten Tag');
define('_ACA_AUTO_DAY_CH4', 'Jeden zweiten Tag, außer Wochenenden');
define('_ACA_AUTO_DAY_CH5', 'Wöchentlich');
define('_ACA_AUTO_DAY_CH6', 'Zwei-Wöchentlich');
define('_ACA_AUTO_DAY_CH7', 'Monatlich');
define('_ACA_AUTO_DAY_CH9', 'Jährlich');
define('_ACA_AUTO_OPTION_NONE', 'Nein');
define('_ACA_AUTO_OPTION_NEW', 'Neue Benutzer');
define('_ACA_AUTO_OPTION_ALL', 'Alle Benutzer');

//
define('_ACA_UNSUB_MESSAGE', 'E-Mail abmelden');
define('_ACA_UNSUB_SETTINGS', 'Einstellungen abmelden');
define('_ACA_AUTO_ADD_NEW_USERS', 'Automatisch Benutzer anmelden?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Momentan sind keine Updates verhanden.');
define('_ACA_VERSION', 'Acajoom Version');
define('_ACA_NEED_UPDATED', 'Dateien die upgedatet werden müssen:');
define('_ACA_NEED_ADDED', 'Dateien die hinzugefügt werden müssen:');
define('_ACA_NEED_REMOVED', 'Dateien die gelöscht werden müssen:');
define('_ACA_FILENAME', 'Dateiname:');
define('_ACA_CURRENT_VERSION', 'Aktuelle Version:');
define('_ACA_NEWEST_VERSION', 'Neuste Version:');
define('_ACA_UPDATING', 'Update läuft');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Diese Dateien wurden erfolgreich upgedatet.');
define('_ACA_UPDATE_FAILED', 'Update fehlgeschlagen!');
define('_ACA_ADDING', 'Füge hinzu');
define('_ACA_ADDED_SUCCESSFULLY', 'Erfolgreich hinzugefügt.');
define('_ACA_ADDING_FAILED', 'Hinzufügen fehlgeschlagen!');
define('_ACA_REMOVING', 'Entfernen');
define('_ACA_REMOVED_SUCCESSFULLY', 'Erfolgreich entfernt.');
define('_ACA_REMOVING_FAILED', 'Entfernen fehlgeschlagen!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installiere eine andere Version');
define('_ACA_CONTENT_ADD', 'Füge Inhalt hinzu');
define('_ACA_UPGRADE_FROM', 'Importiere Daten (Newsletter- und Abonnenteninformationen) von ');
define('_ACA_UPGRADE_MESS', 'Es besteht kein Risiko für bestehende Daten. <br /> Dies wird die Dateien nur in die Acajoom Datenbank importieren.');
define('_ACA_CONTINUE_SENDING', 'Senden fortsetzen');

// Acajoom message
define('_ACA_UPGRADE1', 'Du kannst Benutzer und Newsletter einfach importieren aus');
define('_ACA_UPGRADE2', ' nach Acajoom im Uprademenü.');
define('_ACA_UPDATE_MESSAGE', 'Eine neue Version von Acajoom ist erschienen ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Klicke hier um upzudaten!');
define('_ACA_CRON_SETUP', 'Damit Auto-Responder verschikct werden, musst du einen Cron Task einrichten.');
define('_ACA_FEATURES', 'Acajoom, dein Kommunikationspartner!');
define('_ACA_THANKYOU', 'Danke, dass du Acajoom gewählt hast, deinen Kommunkationspartner!');
define('_ACA_NO_SERVER', 'Der Update Server ist nicht erreichbar, probier es später noch mal.');
define('_ACA_MOD_PUB', 'Das Acajoom Modul ist nicht veröffentlicht.');
define('_ACA_MOD_PUB_LINK', 'Klicke hier um es zu veröffentlichen!');
define('_ACA_IMPORT_SUCCESS', 'Erfolgreich importiert');
define('_ACA_IMPORT_EXIST', 'Abonnmenten sind bereits in der Datenbank');


// Acajoom's Guide
define('_ACA_GUIDE', '\'s Assistent');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom has many great features and this wizard will guide you through a four easy steps process to get you started sending your newsletters and auto-responders!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'First, you need to add a list.  A list could be of two types, either a newsletter or an auto-responder.' .
		'  In the list you define all the different parameters to enable the sending of your newsletters or auto-responders: sender name, layout, subscribers\' welcome message, etc...
<br /><br />You can set up your first list  here: <a href="index2.php?option=com_acajoom&act=list" >create a list</a> and click the New button.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom provides you with an easy way to import all data from a previous newsletter system.<br />' .
		' Go to the Updates panel and choose your previous newsletter system to import the all your newsletters and subscribers.<br /><br />' .
		'<span style="color:#FF5E00;"  >IMPORTANT: the import is risk FREE and doesn\'t affect in any way the data of your previous newsletter system</span><br />' .
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
		' You will also find lots of information on how to communicate effectively with your subscribers on <a href="http://www.acajoom.com/"  target="_blank">www.Acajoom.com</a>.' .
		'<p /><br /><b>Thank you for using Acajoom. Your Communication Partner!<b/> ');
define('_ACA_GUIDE_TURNOFF', 'Der Assitent wird abgeschaltet!');
define('_ACA_STEP', 'Schritt ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom Konfiguration');
define('_ACA_INSTALL_SUCCESS', 'Erfolgreich installiert');
define('_ACA_INSTALL_ERROR', 'Installationsfehler');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Acajoom Modul');
//Others
define('_ACA_JAVASCRIPT','!Warnung! Javascript muss erlaubt sein, damit Acajoom ordentlich funktioniert.');
define('_ACA_EXPORT_TEXT','Die zu exportierenden Abonnenten stammen aus der gewählten Liste. <br />Exportiere Abonnenten für Liste:');
define('_ACA_IMPORT_TIPS','Importiere Abonnenten. Die Informationen in dieser Datei müssen im folgenden Format sein: <br />' .
		'Name,email,receiveHTML(1/0),confirmed(1/0)');
define('_ACA_SUBCRIBER_EXIT', 'ist bereits eingetragen');
define('_ACA_GET_STARTED', 'Klicke hier um zu beginnen!');

//News since 1.0.1
define('_ACA_WARNING_1011','Warnung: 1011: Update funktioniert nicht, wegen deiner Servereinstellungen.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Wähle, welche E-Mailadresse als Absender gezeigt wird.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Wähle welcher Name als Absender gezeigt wird.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Wähle welche E-Mailfunktion du nutzen willst: PHP mail function, <span>Sendmail</span> oder SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Dies ist das Verzeichnis des Mailservers');
define('_ACA_LIST_T_TEMPLATE', 'Template');
define('_ACA_NO_MAILING_ENTERED', 'Kein Mailing ausgewählt');
define('_ACA_NO_LIST_ENTERED', 'Keine Liste ausgewählt');
define('_ACA_SENT_MAILING' , 'Sende Mailings');
define('_ACA_SELECT_FILE', 'Bitte wähle eine Datei um ');
define('_ACA_LIST_IMPORT', 'Wähle die Liste(n) mit denen Abonnenten verbunden werden sollen.');
define('_ACA_PB_QUEUE', 'Abonnent hinzugefügt, aber es gibt Probleme ihn/sie zur Liste hinzuzufügen. Bitte überprüfe dieses manuell');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Update dringend empfohlen!');
define('_ACA_UPDATE_MESS2' , 'Patch und kleine Fixe.');
define('_ACA_UPDATE_MESS3' , 'Neues Release.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 ist erforderlich um upzudaten.');
define('_ACA_UPDATE_IS_AVAIL' , ' ist erhätlich!');
define('_ACA_NO_MAILING_SENT', 'Kein Mailing versendet!');
define('_ACA_SHOW_LOGIN', 'Zeige Loginformular');
define('_ACA_SHOW_LOGIN_TIPS', 'Wähle Ja um ein Loginformular im Frontend von Acajoom zu zeigen, so dass Benutzer sich auf der Webseite registrieren können.');
define('_ACA_LISTS_EDITOR', 'Editor der Listenbeschreibung');
define('_ACA_LISTS_EDITOR_TIPS', 'Wähle Ja um einen HTMl Editor zu vewenden, um die Listenbeschreibung zu ändern.');
define('_ACA_SUBCRIBERS_VIEW', 'Zeige Abonnementen');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Front-End Einstellungen' );
define('_ACA_SHOW_LOGOUT', 'Zeige Abmelde-Button');
define('_ACA_SHOW_LOGOUT_TIPS', 'Wähle Ja um einen Abmelde-Button im Ajacoom-Bereich auf der Webseite zu zeigen.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integration');
define('_ACA_CB_INTEGRATION', 'Community Builder Integration');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin für den Community Builder ist noch nicht installiert!');
define('_ACA_CB_PLUGIN', 'Listen bei Registrierung');
define('_ACA_CB_PLUGIN_TIPS', 'WÄhle Ja um die Mailinglisten im Registrierungsformaler des Community Builders zu zeigen');
define('_ACA_CB_LISTS', 'Listen IDs');
define('_ACA_CB_LISTS_TIPS', 'DIESES FELD WIRD BENÖTIGT: Trage die ID der Listen ein, die Benutzer abonnieren können sollen, getrennt durch Komma , (0 zeigt alle Listen).');
define('_ACA_CB_INTRO', 'Einführungstext');
define('_ACA_CB_INTRO_TIPS', 'Dieser Text erscheit vor der Liste. WENN ER LEER IST, WIRD NICHTS ANGEZEIGT. benutze cb_pretext für das CSS Layout.');
define('_ACA_CB_SHOW_NAME', 'Zeigen Listenname');
define('_ACA_CB_SHOW_NAME_TIPS', 'Wähle ob der Listenname nach dem Einführungstext angezeigt werden soll oder nicht.');
define('_ACA_CB_LIST_DEFAULT', 'Wähle Liste standartmässig aus');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Wähle ob die Checkbox für jede Liste standartmässig aktiviert sein soll.');
define('_ACA_CB_HTML_SHOW', 'Zeige HTML empfangen');
define('_ACA_CB_HTML_SHOW_TIPS', 'Setzte dieses auf JA um Benutzern zu erlauben auszuwählen, ob sie HTML E-Mails bekommen wollen oder nicht. Setze auf Nein um Standarteinstellungen zu verwenden.');
define('_ACA_CB_HTML_DEFAULT', 'Standartmässig HTML empfangen');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Setze diese Einstellung um die Standart HTML Konfiguration zu zeigen. Wenn  HTML empfangen auf Nein steht, ist diese Option die Standartoption.');


define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Dieses wird mit den Ein-/Austragungslinks ersetzt.' .
		' Es ist <strong>notwendig</strong> damit Acajoom ordentlich funktioniert.<br />' .
		'Wenn du weiteren Content in dieser Box plaziert, wird er in allen Mailings dieser Liste angezeigt.' .
		' <br />Füge deine Abonnementsnachricht am Ende hinzu.  Acajoom wird automatisch einen Link hinzufügen, damit Abonnementen ihre Abonnements ändern und sich abmelden können.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Hinweis');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Hinweise');
define('_ACA_USE_SEF', 'SEF in Mailings');
define('_ACA_USE_SEF_TIPS', 'Es ist empfohlen NEIN zu wählen. Wenn du umbedingt willst, dass die URL in deiner Mail SEF verwendet, dann wähle JA.' .
		' <br /><b>Die Links funktionieren für beide Optionen. NEIN stellt sicher, dass die Links auch funktionieren, wenn du deine SEF änderst.</b> ');
define('_ACA_ERR_NB' , 'Fehler #: ERR');
define('_ACA_ERR_SETTINGS', 'Fehler beim Bearbeiten der Einstellungen');
define('_ACA_ERR_SEND' ,'Sende Fehlerbericht');
define('_ACA_ERR_SEND_TIPS' ,'Wenn du willst, dass Acajoom verbessert wird, wähle JA. Das wird uns einen Fehlerbericht senden, so dass du uns Bugs nicht mehr melden musst. ;-) <br /><b>KEINE PRIVATEN INFORMATIONEN WERDEN VERSANDT</b> Wir erfahren nicht mal von welcher Webseite der Fehler kommt, lediglich Acajoom Informationen, sowie das PHP-Setup und SQL-Queries werden versandt. ');
define('_ACA_ERR_SHOW_TIPS' ,'Wähle Ja um die Fehlernummer anzuzeigen. Hauptsächlich für Debugging Zwecke. ');
define('_ACA_ERR_SHOW' ,'Zeige Fehler');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Zeige Abmeldungslinks');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Wähle Ja um am Ende der E-Mails die Abmeldungslinks anzuzeigen, um Benutzern erlauben ihre Abonnements zu ändern <br /> No entfernt den Footer und die Links.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">WICHTIGER HINWEIS!</span> <br />Wenn du von einer vorherigen Acajoomversion upgradest, muss deine Datenbank upgedatet werden, indem du hier klickst (Deine Daten bleiben erhalten)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Update Tabellen und Konfiguration');
define('_ACA_MAILING_MAX_TIME', 'Max Bearbeitungszeit' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Definiere die maximale Zeit für einzelne E-Mailpackete, die versandt werden sollen. Empfohlen werden Zeiten zwischen 30s 2mins..');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart Integration');
define('_ACA_VM_COUPON_NOTIF', 'Coupon Hinweis ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Wähle die ID Nummer des Mailings, dass du nutzen willst um Coupons an deine Kunden zu versenden');
define('_ACA_VM_NEW_PRODUCT', 'Hinweis ID für neue Projekte');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Wähle die ID des Mailings, dass du nutzen willst, um Informationen über neue Produkte zu versenden.');


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
define('_ACA_AUTO_SCHEDULE', 'Schedule');
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
define( '_ACA_MAILING_NEW_FRONT', 'Createa New Mailing' );

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
define('_ACA_REGWARN_NAME','Bitte Ihren Namen eingeben.');
define('_ACA_REGWARN_MAIL','Bitte Ihre E-Mail Adresse eingeben.');

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS','If you select Yes, the e-mail of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be usefull if you want to execute a special script in your redirect page.');
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
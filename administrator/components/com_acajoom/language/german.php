<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>German language file.</p>
* @author Frank Jansen <digital-media@gmx.net>
* @version 1.0.8
* @version $Id: german.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom ist eine Komponente, zum Verwalten von Mailinglisten, Newslettern, Autorespondern und mehr, um effizient mit seinen Bentuzern und Kunden zu kommunizieren.<br />' .
		'Acajoom, dein Kommunikationspartner!');

// Type of lists
define('_ACA_NEWSLETTER', 'Newsletter');
define('_ACA_AUTORESP', 'Auto-responder');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Postkarte');
define('_ACA_PERF', 'Geschwindigkeit');
define('_ACA_COUPON', 'Coupon');
define('_ACA_CRON', 'Cron Task');
define('_ACA_MAILING', 'Mailing');
define('_ACA_LIST', 'Liste');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Listenverwaltung');
define('_ACA_MENU_SUBSCRIBERS', 'Abonnenten');
define('_ACA_MENU_NEWSLETTERS', 'Newsletter');
define('_ACA_MENU_AUTOS', 'Auto-responders');
define('_ACA_MENU_COUPONS', 'Coupons');
define('_ACA_MENU_CRONS', 'Cron Tasks');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Postkarten');
define('_ACA_MENU_PERFS', 'Geschwinidigkeit');
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
define('_ACA_DESC_CREDITS', 'Gutschriften');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Homepage');
define('_ACA_DESC_MAILING', 'Mailing Liste');
define('_ACA_DESC_SUBSCRIBERS', 'Abonnement');
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
define('_ACA_ALL','Alle');
define('_ACA_SEND_A', 'Sende einen ');
define('_ACA_SUCCESS_DELETED', ' erfolgreich gelöscht');
define('_ACA_LIST_ADDED', 'Liste erfolgreich erstellt');
define('_ACA_LIST_COPY', 'Liste erfolgreich kopiert');
define('_ACA_LIST_UPDATED', 'Liste erfolgreich upgedated');
define('_ACA_MAILING_SAVED', 'Mailing erfolgreich gespeichert.');
define('_ACA_UPDATED_SUCCESSFULLY', 'erfolgreich upgedated.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Abonnenteninformationen');
define('_ACA_VERIFY_INFO', 'Bitte überprüfen sie den übertragenden Link, einige Informationen fehlen.');
define('_ACA_INPUT_NAME', 'Name');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Empfange HTML?');
define('_ACA_TIME_ZONE', 'Zeitzone');
define('_ACA_BLACK_LIST', 'Sperrliste');
define('_ACA_REGISTRATION_DATE', 'Registrierungsdatum');
define('_ACA_USER_ID', 'Benutzer ID');
define('_ACA_DESCRIPTION', 'Beschreibung');
define('_ACA_ACCOUNT_CONFIRMED', 'Ihr Account wurde aktiviert.');
define('_ACA_SUB_SUBSCRIBER', 'Abonnement');
define('_ACA_SUB_PUBLISHER', 'Redakteur');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registrierter');
define('_ACA_SUBSCRIPTIONS', 'Abonnements');
define('_ACA_SEND_UNSUBCRIBE', 'Sende Abmeldungsnachricht');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Klicken sie auf Ja um eine Abmeldungsbestätigung zu verschicken.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Bitte bestätigen sie ihre Anmeldung');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Abmeldungsbestätigung');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hi [NAME],<br />' .
		'Noch ein kurzer Schritt und sie haben den Newsletter abonniert. Klicken sie auf den folgenden Link um ihre Registrierung zu bestätigen:' .
		'<br /><br />[CONFIRM]<br /><br />Falls du Fragen hast, wende dich an den Webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Dies ist eine Bestätigungsemail, dass du von der Liste entfernt worden bist. Es tut uns leid, dass du dich entschieden hast, unsere E-Mails nicht weiter zu empfangen. Du kannst dich natürlich jederzeit wieder anmelden.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Anmeldungsdatum');
define('_ACA_CONFIRMED', 'Bestätigung');
define('_ACA_SUBSCRIB', 'Abonniert');
define('_ACA_HTML', 'HTML mailings');
define('_ACA_RESULTS', 'Ergebnisse');
define('_ACA_SEL_LIST', 'Wählen sie eine Liste');
define('_ACA_SEL_LIST_TYPE', '- Wählen sie eine Listenart -');
define('_ACA_SUSCRIB_LIST', 'Liste aller Abonnenten');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Angemeldet für: ');
define('_ACA_NO_SUSCRIBERS', 'Es gibt keine Abonnenten auf dieser Liste');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Eine Bestätigungsemail wurde ihnen zugesand, bitte überprüfen sie ihre E-Mails und klicken sie auf den Bestätigungslink.<br />' .
		'Sie müssen ihre E-Mailadresse bestätigen, um ihr Abonnement gültig zu machen.');
define('_ACA_SUCCESS_ADD_LIST', 'Sie wurden erfolgreich der Liste hinzugefügt.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Klicken sie hier um ihr Abonnement zu bestätigen.');
define('_ACA_UNSUBSCRIBE_LINK', 'Klicken sie hier um sich von der Liste wieder abzumelden.');
define('_ACA_UNSUBSCRIBE_MESS', 'Ihre E-Mailadresse wurde von der Liste entfernt');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Alle geplanten Mailings wurden erfolgreich versendet.');
define('_ACA_MALING_VIEW', 'Zeige alle Mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Sind sie sicher, dass sie sich von dieser Liste abmelden wollen?');
define('_ACA_MOD_SUBSCRIBE', 'Abonnieren');
define('_ACA_SUBSCRIBE', 'Abonnieren');
define('_ACA_UNSUBSCRIBE', 'Abmelden');
define('_ACA_VIEW_ARCHIVE', 'Zeige das Archiv');
define('_ACA_SUBSCRIPTION_OR', ' oder klicken sie hier für weitere Informationen');
	define('_ACA_EMAIL_ALREADY_REGISTERED', 'Diese E-Mailadresse wurde schon mal angemeldet.');
define('_ACA_SUBSCRIBER_DELETED', 'Abonnenten erfolgreich gelöscht');


### UserPanel ###
 //User Menu
define("_UCP_USER_PANEL", "Benutzer Kontrollmenü");
define("_UCP_USER_MENU", "Benutzermenü");
define("_UCP_USER_CONTACT", "Meine Abonnements");
 //Acajoom Cron Menu
define("_UCP_CRON_MENU", "Cron Task Management");
define("_UCP_CRON_NEW_MENU", "New Cron");
define("_UCP_CRON_LIST_MENU", "Zeige meine Cron");
 //Acajoom Coupon Menu
define("_UCP_COUPON_MENU", "Coupons Management");
define("_UCP_COUPON_LIST_MENU", "Couponsliste");
define("_UCP_COUPON_ADD_MENU", "Coupon hinzufügen");

### lists ###
// Tabs
define("_ACA_LIST_T_GENERAL", "Beschreibung");
define("_ACA_LIST_T_LAYOUT", "Layout");
define("_ACA_LIST_T_SUBSCRIPTION", "Abonnement");
define("_ACA_LIST_T_SENDER", "Absenderinformationen");

define("_ACA_LIST_TYPE", "Listenart");
define("_ACA_LIST_NAME", "Listenname");
define("_ACA_LIST_ISSUE", "Ausgabe #");
define("_ACA_LIST_DATE", "Sendungsdatum");
define("_ACA_LIST_SUB", "Mailing Betreff");
define("_ACA_ATTACHED_FILES", "Angehängte Dateien");
define("_ACA_SELECT_LIST", "Bitte wählen sie eine Liste zum editieren aus!");

// Auto Responder box
define("_ACA_AUTORESP_ON", "Listenart");
define("_ACA_AUTO_RESP_OPTION", "Optionen für automatische Antworten");
define("_ACA_AUTO_RESP_FREQ", "Abonnenten können Häufigkeit wählen");
define("_ACA_AUTO_DELAY", "Verzögerung (in Tagen)");
define("_ACA_AUTO_DAY_MIN", "Minimalste Häufigkeit");
define("_ACA_AUTO_DAY_MAX", "Maximalste Häufigkeit");
define("_ACA_FOLLOW_UP", "Specify follow up auto-responder");
define("_ACA_AUTO_RESP_TIME", "Abonnenten können die Zeit auswählen");
define("_ACA_LIST_SENDER", "Listen Absender");

define("_ACA_LIST_DESC", "Listen Beschreibung");
define("_ACA_LAYOUT", "Layout");
define("_ACA_SENDER_NAME", "Absendernamen");
define("_ACA_SENDER_EMAIL", "Absender-Email");
define("_ACA_SENDER_BOUNCE", "Rückantwortadresse");
define("_ACA_LIST_DELAY", "Verzögerung");
define("_ACA_HTML_MAILING", "HTML Mails?");
define("_ACA_HTML_MAILING_DESC", "(wenn sie dieses ändern, müssen sie speichern und die Seite neu laden, um die Änderungen zu sehen.)");
define("_ACA_HIDE_FROM_FRONTEND", "Im Frontend verstecken?");
define("_ACA_SELECT_IMPORT_FILE", "Wählen sie eine Datei zum importieren aus");;
define("_ACA_IMPORT_FINISHED", "Import beendet");
define("_ACA_DELETION_OFFILE", "Löschen einer Datei");
define("_ACA_MANUALLY_DELETE", "gescheitert, sie sollten die Datei manuell löschen");
define("_ACA_CANNOT_WRITE_DIR", "Kann in diesem Verzeichnis nicht schreiben");
define("_ACA_NOT_PUBLISHED", "Konnte das Mailing nicht verschicken, die Liste wurde nicht veröffentlicht.");

//  List info box
define("_ACA_INFO_LIST_PUB", "Klicken sie auf Ja um die Liste zu veröffentlichen");
define("_ACA_INFO_LIST_NAME", "Tragen sie hier den Namen ihrer Liste ein. Sie können die Liste an Hand ihres Namen identifizieren.");
define("_ACA_INFO_LIST_DESC", "Tragen sie hier eine kurze Beschreibung ihrer Liste ein. Diese Beschreibung wird für Besucher deiner Webseite sichtbar sein.");
define("_ACA_INFO_LIST_SENDER_NAME", "Tragen sie hier den Namen des Absenders für die Mailings ein. Dieser Name wird sichtbar sein, wenn Abonnenten Nachrichten über diese Liste empfangen.");
define("_ACA_INFO_LIST_SENDER_EMAIL", "Tragen sie hier die E-Mailadresse ein, von der die Nachrichten versandt werden.");
define("_ACA_INFO_LIST_SENDER_BOUNCED", "Tragen sie hier die E-Mailadresse ein, auf die Benutzer antworten können. Es ist höchstempfehlenswert, dass diese, die gleiche wie die Senderadresse ist, da Spamfilter den Nachrichten sonst eher als Spam behandeln.");
define("_ACA_INFO_LIST_AUTORESP", "Wählen sie den Typ für Nachrichten dieser Liste:<br />" .
		"Newsletter: Normaler Newsletter<br />" .
		"Auto-responder: Ein auto-responder ist eine Liste, welche automatisch durch die Webseite in regelmäßigen Abständen verschickt wird.");
define("_ACA_INFO_LIST_FREQUENCY", "Erlaube dem Benutzer wie oft sie Nachrichten von der Liste erhalten. Das gibt den Benutzern mehr Flexibilität.");
define("_ACA_INFO_LIST_TIME", "Erlaube dem Benutzer auszuwählen, zu welcher Zeit er am liebsten Nachrichten über die Liste empfängt.");
define("_ACA_INFO_LIST_MIN_DAY", "Definiere was die minimalste Häufigkeit an Nachrichten über die Liste ist, die ein Benutzer wählen kann.");
define("_ACA_INFO_LIST_DELAY", "Setzte den Abstand zwischem diesem Auto-Respondern und dem vorherigen.");
define("_ACA_INFO_LIST_DATE", "Setzte das Datum, an dem du diese Nachricht veröffentlichen willst, wenn du die Veröffentlichung verzögern willst. <br /> FORMAT : YYYY-MM-DD HH:MM:SS");
define("_ACA_INFO_LIST_MAX_DAY", "Definiere was die maximale Häufigkeit an Nachrichten über die Liste ist, die ein Benutzer wählen kann");
define("_ACA_INFO_LIST_LAYOUT", "Trage hier das Layout der Mailingliste ein. Du kannst jedes Layout hier eintragen");
define("_ACA_INFO_LIST_SUB_MESS", "Diese Nachricht wird zum Benutzer geschickt, wenn er oder sie sich registriert. Du kannst jeden Text hier eintragen.");
define("_ACA_INFO_LIST_UNSUB_MESS", "Diese Nachricht wird zum Abonnenten geschickt, wenn er sich von der Liste abgemeldet hat. Jede Nachricht kann hier eingetragen werden.");
define("_ACA_INFO_LIST_HTML", "Wähle dieses wenn du eine HTML-Mail verschicken willst. Abonnenten haben die Möglichkeit sich auszusuchen, ob sie die HTML-Nachricht empfangen wwollen oder nur den reinen Text, wenn sie eine HTML-Liste abonniert haben.");
define("_ACA_INFO_LIST_HIDDEN", "Klicke Ja um die Mailingliste vor dem Frontend zu verstecken. Dadruch können Benutzer sich nicht anmelden, aber du kannst weiterhin Mailings verschicken.");
define("_ACA_INFO_LIST_ACA_AUTO_SUB", "Sollen Benutzer automatisch der Liste hinzugefügt werden?<br /><B>Neue Benutzer:</B> Jeder neu registrierte Benutzer wird der Liste hinzugefügt.<br /><B>Alle Benutzer:</B> Registriert jeden Benutzer in der Datenbank.<br />(alle Optionen unterstützten den CommunityBuilder)");
define("_ACA_INFO_LIST_ACC_LEVEL", "Bestimme die Zugangsoptionen aus dem Frontend. Damit werden Listen Benutzern gezeigt oder vor ihnen versteckt, wenn sie keinen Zugang zu ihnen haben, also sich nicht eintragen können.");
define("_ACA_INFO_LIST_ACC_USER_ID", "Wähle den Zugangslevel der Benutzergruppe, der du erlauben willst, die Liste zu bearbeiten. Die Benutzergruppe wird in der Lage sein, Mailings zu bearbeiten und zu versenden, sowohl vom Backend, als auch vom Frontend.");
define("_ACA_INFO_LIST_FOLLOW_UP", "Wenn du willst, dass der Auto-Responder zu einem weiteren wechselt, sobald es die letzte Nachricht erreicht hat, kannst du hier den folgenden Auto-Responder bestimmen.");
define("_ACA_INFO_LIST_ACA_OWNER", "Das ist die ID der Person, die die Liste erstellt hat.");
define("_ACA_INFO_LIST_WARNING", "   Diese Option ist nur beim Erstellen der Liste wählbar.");
define("_ACA_INFO_LIST_SUBJET", " Betreff des Mailings. Das ist der Betreff der E-Mail, die die Benutzer bekommen werden.");
define("_ACA_INFO_MAILING_CONTENT", "^Das ist der Body der E-Mail, die du versenden willst.");
define("_ACA_INFO_MAILING_NOHTML", "Trage hier den Body der E-Mail ein, den Benutzer erhalten sollen, die keine HTML-E-mails bekommen wollen.");
define("_ACA_INFO_MAILING_VISIBLE", "Klicke Ja um das Mailing im Frontend anzuzeigen.");
define("_ACA_INSERT_CONTENT", "Füge existierenden Content ein.");

// Coupons
define("_ACA_SEND_COUPON_SUCCESS", "Coupon erfolgreich versendet!");
define("_ACA_CHOOSE_COUPON", "Wähle einen Coupon");
define("_ACA_TO_USER", " an diesen Benutzer");

### Cron options
//drop down frequency(CRON)
define("_ACA_FREQ_CH1", "Jede Stunde");
define("_ACA_FREQ_CH2", "Alle 6 Stunden");
define("_ACA_FREQ_CH3", "Alle 12 Stunden");
define("_ACA_FREQ_CH4", "Täglich");
define("_ACA_FREQ_CH5", "Wöchentlich");
define("_ACA_FREQ_CH6", "Monatlich");
define("_ACA_FREQ_NONE", "Nicht");
define("_ACA_FREQ_NEW", "Neue Benutzer");
define("_ACA_FREQ_ALL", "Alle Benutzer");

//Label CRON form
define("_ACA_LABEL_FREQ", "Acajoom Cron?");
define("_ACA_LABEL_FREQ_TIPS", "Klicken sie Ja wenn sie dieses für einen Acajoom Cron nutzen wollen, Nein für einen anderen Cronjob.<br />" .
		"Wenn sie Ja klicken, müssen sie keine spezielle Cron-Adresse eingeben, sie wird automatisch dazugefügt.");
define("_ACA_SITE_URL" , "Die URL ihrer Webseite");
define("_ACA_CRON_FREQUENCY" , "Cron Häufigkeit");
define("_ACA_STARTDATE_FREQ" , "Anfangsdatum");
define("_ACA_LABELDATE_FREQ" , "Datum bestimmen");
define("_ACA_LABELTIME_FREQ" , "Zeit bestimmen");
define("_ACA_CRON_URL", "Cron URL");
define("_ACA_CRON_FREQ", "Häufigkeit");
define("_ACA_TITLE_CRONLIST", "Cron Liste");
define("_NEW_LIST", "Neue Liste erstellen");

//title CRON form
define("_ACA_TITLE_FREQ", "Cron Bearbeiten");
define("_ACA_CRON_SITE_URL", "Bitte tragen sie eine gültige URL ein, beginnend mit http://");

### Mailings ###
define("_ACA_MAILING_ALL", "Alle Mailings");
define("_ACA_EDIT_A", "Bearbeite ein ");
define("_ACA_SELCT_MAILING", "Bitte wählen sie eine Liste aus dem Drop-Down Menü um ein neues Mailing zu verfassen.");
define("_ACA_VISIBLE_FRONT", "Sichtbar im Frontend");

// mailer
define("_ACA_SUBJECT", "Betreff");
define("_ACA_CONTENT", "Inhalt");
define("_ACA_NAMEREP", "[NAME] = Dies wird durch den Namen des Abonnenten ersetzt, die E-Mail wird also personalisiert, wenn sie dieses nutzen.<br />");
define("_ACA_FIRST_NAME_REP", "[FIRSTNAME] = Dies wird durch den Vornamen des Abonnenten ersetzt.<br />");
define("_ACA_NONHTML", "NICHT-HTML Version");
define("_ACA_ATTACHMENTS", "Anhänge");
define("_ACA_SELECT_MULTIPLE", "Halten sie Steuerung (STRG) um mehrere Anhänge zu wählen.<br />" .
		"Die Dateien, die in der Liste der Anhänge erscheinen, sind im Ordner Attachements gespeichert. Sie können diesen Ordner im Konfigurationsmenü ändern.");
define("_ACA_CONTENT_ITEM", "Inhaltselement");
define("_ACA_CONTENT_ITEM_SELECT", "Wählen sie ein Element, um es in die Nachricht einzufügen<br />Kopiere den <b>Platzhalter</b> und füge ihn in die Nachricht ein.  Du kannst wählen ob du nur das Intro oder den gesamten Text in der Mail haben willst (0 or 1).");
define("_ACA_SENDING_EMAIL", "Versende  E-mails");
define("_ACA_MESSAGE_NOT", "E-Mails konnte nicht versendet werden");
define("_ACA_MAILER_ERROR", "Versende Fehler");
define("_ACA_MESSAGE_SENT_SUCCESSFULLY", "E-Mail erfolgreich versendet");
define("_ACA_SENDING_TOOK", "Das versenden dieser Mail dauerte");
define("_ACA_SECONDS", "Sekunden");
define("_ACA_NO_ADDRESS_ENTERED", "Keine Adresse eingetragen");
define("_ACA_CHANGE_SUBSCRIPTIONS", "Ändere");
define("_ACA_CHANGE_EMAIL_SUBSCRIPTION", "Ändern sie ihre Abonnements");
define("_ACA_WHICH_EMAIL_TEST", "Geben sie die E-Mailadresse an, an die eine Textmail gesendet werden soll, oder wählen sie Vorschau");
define("_ACA_SEND_IN_HTML", "Versende in HTML (für HTML-Mails)?");
define("_ACA_VISIBLE", "Sichtbar");
define("_ACA_INTRO_ONLY", "Nur die Einleitung");

// stats
define("_ACA_GLOBALSTATS", "Allgemeine Statistiken");
define("_ACA_DETAILED_STATS", "Detaillierte Statistiken");
define("_ACA_MAILING_LIST_DETAILS", "Zeige Details");
define("_ACA_SEND_IN_HTML_FORMAT", "Sende im HTML-Format");
define("_ACA_VIEWS_FROM_HTML", "Ansichten (aus HTML-Mails)");
define("_ACA_SEND_IN_TEXT_FORMAT", "Sende im Textformat");
define("_ACA_HTML_READ", "HTML lesen");
define("_ACA_HTML_UNREAD", "HTML nicht lesen");
define("_ACA_TEXT_ONLY_SENT", "Nur Text");

// Configuration panel
// main tabs
define("_ACA_MAIL_CONFIG", "Mail");
define("_ACA_LOGGING_CONFIG", "Logs & Statistiken");
define("_ACA_SUBSCRIBER_CONFIG", "Abonnenten");
define("_ACA_AUTO_CONFIG", "Cron");
define("_ACA_MISC_CONFIG", "Verschiedenes");
define("_ACA_MAIL_SETTINGS", "Mail Einstellungen");
define("_ACA_MAILINGS_SETTINGS", "Mailing Einstellungen");
define("_ACA_SUBCRIBERS_SETTINGS", "Abonnenten Einstellungen");
define("_ACA_CRON_SETTINGS", "Cron Einstellungen");
define("_ACA_SENDING_SETTINGS", "Sendeeinstellungen");
define("_ACA_STATS_SETTINGS", "Statistikeinstellungen");
define("_ACA_LOGS_SETTINGS", "Logeinstellungen");
define("_ACA_MISC_SETTINGS", "Verschiedene Einstellungen");
// mail settings
define("_ACA_SEND_MAIL_FROM", "E-Mail von");
define("_ACA_SEND_MAIL_NAME", "Von Name");
define("_ACA_MAILSENDMETHOD", "Versandmethode");
define("_ACA_SENDMAILPATH", "Sendmail pfad");
define("_ACA_SMTPHOST", "SMTP Host");
define("_ACA_SMTPAUTHREQUIRED", "SMTP Authentifizierung erforderlich");
define("_ACA_SMTPAUTHREQUIRED_TIPS", "Wählen sie ja, wenn ihr SMTP Server Authentifizierung erfordert");
define("_ACA_SMTPUSERNAME", "SMTP Benutzername");
define("_ACA_SMTPUSERNAME_TIPS", "Tragen sie den SMTP Benutzernamen ein, wenn ihr SMTP Server Authentifzierung verlangt");
define("_ACA_SMTPPASSWORD", "SMTP Passwort");
define("_ACA_SMTPPASSWORD_TIPS", "Tragen sie ihr SMTP Passwort ein, wenn ihr SMTP Server Authentifizierung verlangt");
define("_ACA_USE_EMBEDDED", "Eingebettete Bilder benutzen");
define("_ACA_USE_EMBEDDED_TIPS", "Wählen sie ja, wenn die Bilder in HTML E-Mails im Anhang eingebettet werden sollen oder nein, wenn sie mit Standart Bilder Tags über den Server verlinkt werden sollen");
define("_ACA_UPLOAD_PATH", "Upload/Anhang Pfad");
define("_ACA_UPLOAD_PATH_TIPS", "Sie können ein Verzeichnis zum hochladen bestimmen<br />" .
		"Gehen sie sicher, dass das bestimmte Verzeichnis existiert, oder erstellen sie es");

// subscribers settings
define("_ACA_ALLOW_UNREG", "Erlaube Anonyme");
define("_ACA_ALLOW_UNREG_TIPS", "Wählen sie JA, wenn sie wollen, dass Benutzer sich eintragen dürfen, ohne auf der Seite registriert zu sein.");
define("_ACA_REQ_CONFIRM", "Bestätigung erfordert");
define("_ACA_REQ_CONFIRM_TIPS", "Wählen sie Ja, wenn sie wollen, dass unregistrierte Benutzer ihre E-Mailadresse bestätigen müssen.");
define("_ACA_SUB_SETTINGS", "Abonnement Einstellungen");
define("_ACA_SUBMESSAGE", "Abonnenten Email");
define("_ACA_SUBSCRIBE_LIST", "Tragen sie sich in eine Liste ein");

define("_ACA_USABLE_TAGS", "Erlaubte Tags");
define("_ACA_NAME_AND_CONFIRM", "<b>[CONFIRM]</b> = Dies erzeugt einen Link, den Benutzer nutzen können, um ihr Abonnement zu bestätigen. Dies ist  <strong>erforderlich</strong> damit Acajoom richtig funktioniert.<br />"
."<br />[NAME] = Das wird durch den Namen des Abonnenten ersetzt, die E-Mail wird also personalisiert.br />"
."<br />[FIRSTNAME] = Dies wird durch den Vornamen des Abonnenten ersetzt. Der Vorname ist definiert als der Vorname, den der Abonnent eingetragen hat.<br />");
define("_ACA_CONFIRMFROMNAME", "Bestätigung des Namen");
define("_ACA_CONFIRMFROMNAME_TIPS", "Tragen sie den 'von'-Namen ein, der auf Bestätigungslisten erscheinen soll.");
define("_ACA_CONFIRMFROMEMAIL", "Bestätigung der E-mail");
define("_ACA_CONFIRMFROMEMAIL_TIPS", "Tragen sie die E-Mail Adresse ein, um eine Liste der Bestätigungen zu sehen.");
define("_ACA_CONFIRMBOUNCE", "Bestätigung der  Bounce E-Mail Adresse");
define("_ACA_CONFIRMBOUNCE_TIPS", "Tragen sie die Bounce E-Mail Adresse ein, um eine Liste der Bestätigungen zu sehen.");
define("_ACA_HTML_CONFIRM", "HTML Bestätigung");
define("_ACA_HTML_CONFIRM_TIPS", "Wähle Ja, wenn die Bestätigungsliste HTML sein soll, sofern der Benutzer HTML erlaubt..");
define("_ACA_TIME_ZONE_ASK", "Frage nach Zeitzone");
define("_ACA_TIME_ZONE_TIPS", "Wählen sie Ja, wenn der Benutzer nach seiner Zeitzone gefragt werden soll. Die E-Mails werden dann auf Basis der Zeitzone versandt.");

 // Cron Set up
define("_ACA_TIME_OFFSET_URL", "Klicken sie hier um die Zeitabweichung in der globalen Konfiguration zu setzen. globale Konfiguration --> Lokale");
define("_ACA_TIME_OFFSET_TIPS", "Setzen sie ihre Serverzeitabweichung, so dass das gespeicherte Datum und die Zeit korrekt sind");
define("_ACA_TIME_OFFSET", "Zeitabweichung");
define("_ACA_CRON_TITLE", "Stelle die Cron-Funktion ein");
define('_ACA_CRON_DESC','<br />Wenn sie die Cron-Funktion nutzen, können sie eine automatische Aufgabe für ihre Joomla Webseite einstellen!<br />' .
		'Um es zu aktivieren müssen sie in ihren Cron einstellungen folgenden Befehl ergänzen:<br />' .
		'/usr/bin/php  /home/joomla/public_dev/index.php?option=com_acajoom&act=cron' .
		'<br /><br />Anmerkungen:<br />' .
		' - wenn ihr PHP-Pfad anders als /usr/bin/php ist, nutzen sie bitte dieses, format /$php_path/php' .
 		'<br /><br />Für mehr Informationen, wie man ein Cron aufsetzt<br />' .
		' - Cpanel klicken sie hier ' .
 		'<a href="http://www.visn.co.uk/cpanel-docs/cron-jobs.html" target="_blank">http://www.visn.co.uk/cpanel-docs/cron-jobs.html</a><br />' .
 		' - Bitte klicke hier ' .
 		'<a href="http://www.swsoft.com/doc/tutorials/Plesk/Plesk7/plesk_plesk7_eu/plesk7_eu_crontab.htm" target="_blank">' .
 		'http://www.swsoft.com/doc/tutorials/Plesk/Plesk7/plesk_plesk7_eu/plesk7_eu_crontab.htm</a><br />' .
 		' - Interworx klicke hier ' .
 		'<a href="http://www.sagonet.com/interworx/tutorials/siteworx/cron.php" target="_blank">' .
 		'http://www.sagonet.com/interworx/tutorials/siteworx/cron.php</a><br />' .
 		' - Allgemiene Linux crontab Informationen klicke hier ' .
 		'<a href="http://www.computerhope.com/unix/ucrontab.htm#01" target="_blank">http://www.computerhope.com/unix/ucrontab.htm#01</a><br />' .
 		'<br />Wenn du Hilfe bei der Einrichtung brauchst, oder Probleme hast, bitte benutzte unser Forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define("_ACA_PAUSEX", "Warte x Sekunden nach einer bestimmten Anzahl von Mails");
define("_ACA_PAUSEX_TIPS", "Tragen sie eine Anzahl von Sekunden ein, die Acajoom dem SMTP Server gibt, um die E-Mails zu versenden, bevor er mit der nächsten bestimmten Anzahl von E-Mails fortfährt.");
define("_ACA_EMAIL_BET_PAUSE", "E-Mails zwischen den Pausen");
define("_ACA_EMAIL_BET_PAUSE_TIPS", "Anzahl der E-Mails, die zwischen den Pausen versendet werden soll.");
define("_ACA_WAIT_USER_PAUSE", "Warte auf den Benutzer nach einer Pause");
define("_ACA_WAIT_USER_PAUSE_TIPS", "Soll das Skript nach der Pause zwischen den E-Mails auf eine Benutzereingabe warten.");
define("_ACA_SCRIPT_TIMEOUT", "Skript brauchte zu lange (Time out)");
define("_ACA_SCRIPT_TIMEOUT_TIPS", "Die Anzahl der Minuten, die das Skript laufen sollte.");
// Stats settings
define("_ACA_ENABLE_READ_STATS", "Aktiviere Statistiken");
define("_ACA_ENABLE_READ_STATS_TIPS", "Wählen sie Ja, wenn gespeichert werden soll, wie viele Leute die E-Mail angesehen haben. Das kann nur bei HTML-Mails genutzt werden.");
define("_ACA_LOG_VIEWSPERSUB", "Speichere Anzeigen pro Benutzer");
define("_ACA_LOG_VIEWSPERSUB_TIPS", "Wählen sie Ja, wenn Anzeigen pro Benutzer gespeichert werden soll. Dies kann nur bei HTML-Mails genutzt werden.");
// Logs settings
define("_ACA_DETAILED", "Detaillierte Logs");
define("_ACA_SIMPLE", "Einfache Logs");
define("_ACA_DIAPLAY_LOG", "Zeige Logs");
define("_ACA_DISPLAY_LOG_TIPS", "Wähle Ja, wenn du die Logs während des Mailversandes angezeigt haben möchtest.");
define("_ACA_SEND_PERF_DATA", "Sendestatistik");
define("_ACA_SEND_PERF_DATA_TIPS", "Wählen sie Ja, wenn sie Acajoom erlauben wöllen, anonyme Berichte über ihre Konfiguration, die Menge der Abonnmenten einer Liste und der Zeit die das Versenden der Mail zu versenden. Dies würde uns helfen, Acajoom in Zukunft zu verbessern.");
define("_ACA_SEND_AUTO_LOG", "Sende Logdatei für Auto-Responder");
define("_ACA_SEND_AUTO_LOG_TIPS", "Wählen sie Ja, wenn du wollen, dass sie jedes Mal einen Log bekommen, wenn die Mails verschickt werden. WARNUNG: Dies kann zu einer großen Menge Mails führen");
define("_ACA_SEND_LOG", "Sende Log");
define("_ACA_SEND_LOG_TIPS", "Soll ein Log an die E-Mailadresse geschickt werden, welche das Mailing verschickt hat");
define("_ACA_SEND_LOGDETAIL", "Sende detaillierte Logs");
define("_ACA_SEND_LOGDETAIL_TIPS", "Detailliert beinhaltet Erfolg- oder Fehlermeldungen für jeden Abonnenten und eine Übersicht über diese Informationen. Einfach sendet nur die Übersicht.");
define("_ACA_SEND_LOGCLOSED", "Sende Log wenn die Verbindung beendet wird.");
define("_ACA_SEND_LOGCLOSED_TIPS", "Wenn diese Option aktiviert ist, erhält der Benutzer, der das Mailing versandt hat auch einen Bericht per E-Mail.");
define("_ACA_SAVE_LOG", "Speichere Log");
define("_ACA_SAVE_LOG_TIPS", "Soll ein Log des Mailings an die Logdatei angehängt werden?");
define("_ACA_SAVE_LOGDETAIL", "Speichere detaillierten Log");
define("_ACA_SAVE_LOGDETAIL_TIPS", "Detailliert beinhaltet die Erfolgs- oder Fehlerinformation für jeden Abonnenten und eine Übersicht der Informationen. Einfach, speichert nur die Übersicht.");
define("_ACA_SAVE_LOGFILE", "Logdatei speichern");
define("_ACA_SAVE_LOGFILE_TIPS", "Datei, an welche die Log Informationen angehängt werden. Diese Datei kann sehr groß werden.");
define("_ACA_CLEAR_LOG", "Leere  Log");
define("_ACA_CLEAR_LOG_TIPS", "Leert die Logdatei.");

### control panel
define("_ACA_CP_LAST_QUEUE", "Letzte ausgeführte Reihe");
define("_ACA_CP_TOTAL", "Total");
define("_ACA_MAILING_COPY", "Mailing erfolgreich kopiert!");

// Miscellaneous settings
define("_ACA_SHOW_GUIDE", "Zeige Assistenten");
define("_ACA_SHOW_GUIDE_TIPS", "Zeigt den Assistenten am Anfang, um neuen Benutzern zu helfen, eigene Newsletter zu kreieren, einen Auto-Responder und um Acajoom richtig zu konfigurieren.");
define("_ACA_AUTOS_ON", "Benutze Auto-Responders");
define("_ACA_AUTOS_ON_TIPS", "Wähleb sie Ja, wenn sie Auto-Responder nicht nutzen wollen, alle Auto-Responder Optionen werden deaktiviert.");
define("_ACA_NEWS_ON", "Benutze Newsletter");
define("_ACA_NEWS_ON_TIPS", "Wählen sie NEIN wenn sie keinen Newsletter nutzen möchten, alle Newsletter Optionen werden deaktiviert.");
define("_ACA_SHOW_TIPS", "Zeige Tipps");
define("_ACA_SHOW_TIPS_TIPS", "Zeige Tipps damit Benutzer Acajoom einfacher bedienen können.");
define("_ACA_SHOW_FOOTER", "Zeige den Footer");
define("_ACA_SHOW_FOOTER_TIPS", "Soll die Copyright Hinweise im Footer angezeigt werden, oder nicht?");
define("_ACA_SHOW_LISTS", "Zeige Listen im Frontend");
define("_ACA_SHOW_LISTS_TIPS", "Wenn Benutzer nicht registriert sind, zeige eine Liste der möglichen Newsletter, die sie abonnieren können, sowie den Archiv Button oder das Registrierungsformular.");
define("_ACA_CONFIG_UPDATED", "Die Konfiguration wurde upgedated!");
define("_ACA_UPDATE_URL", "Update URL");
define("_ACA_UPDATE_URL_WARNING", "WARNUNG! Ändern sie die URL nicht, es sei denn sie würden vom technischen Team von Acajoom darum gebeten<br />");
define("_ACA_UPDATE_URL_TIPS", "Zum Beispiele: http://www.acajoom.com/update/ (inklusive dem Slash am Ende)");

// module
define("_ACA_EMAIL_INVALID", "Die eingegebene E-Mail ist ungültig.");
define("_ACA_REGISTER_REQUIRED", "Bitte registrieren sie sich, bevor sie eine Liste abonnieren.");

// Access level box
define("_ACA_OWNER", "Hersteller der  Liste:");
define("_ACA_ACCESS_LEVEL", "Setze Zugriffslevel für die Liste");
define("_ACA_ACCESS_LEVEL_OPTION", "Benutzerlevel Optionen");
define("_ACA_USER_LEVEL_EDIT", "Wählen sie welcher Benutzerlevel Mailings bearbeiten darf (sowohl im Frontend als auch im Backend) ");

//  drop down options
define("_ACA_AUTO_DAY_CH1", "Täglich");
define("_ACA_AUTO_DAY_CH2", "Täglich, außer Wochenenden");
define("_ACA_AUTO_DAY_CH3", "Jeden zweiten Tag");
define("_ACA_AUTO_DAY_CH4", "Jeden zweiten Tag, außer Wochenenden");
define("_ACA_AUTO_DAY_CH5", "Wöchentlich");
define("_ACA_AUTO_DAY_CH6", "Zwei-Wöchentlich");
define("_ACA_AUTO_DAY_CH7", "Monatlich");
define("_ACA_AUTO_DAY_CH8", "Zwei-Monatlich");
define("_ACA_AUTO_DAY_CH9", "Jährlich");
define("_ACA_AUTO_OPTION_NONE", "Nein");
define("_ACA_AUTO_OPTION_NEW", "Neue Benutzer");
define("_ACA_AUTO_OPTION_ALL", "Alle Benutzer");

//
define("_ACA_UNSUB_MESSAGE", "E-Mail abmelden");
define("_ACA_UNSUB_SETTINGS", "Einstellungen abmelden");
define("_ACA_AUTO_ADD_NEW_USERS", "Automatisch Benutzer anmelden?");

// Update and upgrade messages
define("_ACA_NO_UPDATES", "Momentan sind keine Updates vorhanden.");
define("_ACA_VERSION", "Acajoom Version");
define("_ACA_NEED_UPDATED", "Dateien die upgedatet werden müssen:");
define("_ACA_NEED_ADDED", "Dateien die hinzugefügt werden müssen:");
define("_ACA_NEED_REMOVED", "Dateien die gelöscht werden müssen:");
define("_ACA_FILENAME", "Dateiname:");
define("_ACA_CURRENT_VERSION", "Aktuelle Version:");
define("_ACA_NEWEST_VERSION", "Neuste Version:");
define("_ACA_UPDATING", "Update läuft");
define("_ACA_UPDATE_UPDATED_SUCCESSFULLY", "Diese Dateien wurden erfolgreich upgedatet.");
define("_ACA_UPDATE_FAILED", "Update fehlgeschlagen!");
define("_ACA_ADDING", "Füge hinzu");
define("_ACA_ADDED_SUCCESSFULLY", "Erfolgreich hinzugefügt.");
define("_ACA_ADDING_FAILED", "Hinzufügen fehlgeschlagen!");
define("_ACA_REMOVING", "Entfernen");
define("_ACA_REMOVED_SUCCESSFULLY", "Erfolgreich entfernt.");
define("_ACA_REMOVING_FAILED", "Entfernen fehlgeschlagen!");
define("_ACA_INSTALL_DIFFERENT_VERSION", "Installiere eine andere Version");
define("_ACA_CONTENT_ADD", "Füge Inhalt hinzu");
define("_ACA_UPGRADE_FROM", "Importiere Daten (Newsletter- und Abonnenteninformationen) von ");
define("_ACA_UPGRADE_MESS", "Es besteht kein Risiko für bestehende Daten. <br /> Dies wird die Dateien nur in die Acajoom Datenbank importieren.");
define("_ACA_CONTINUE_SENDING", "Senden fortsetzen");

// Acajoom message
define("_ACA_UPGRADE1", "Die können Benutzer und Newsletter einfach importieren aus");
define("_ACA_UPGRADE2", " nach Acajoom im Uprademenü.");
define("_ACA_UPDATE_MESSAGE", "Eine neue Version von Acajoom ist erschienen ");
define("_ACA_UPDATE_MESSAGE_LINK", "Klicken sie hier um upzudaten!");
define("_ACA_CRON_SETUP", "Damit Auto-Responder verschikct werden, müssen sie einen Cron Task einrichten.");
define("_ACA_FEATURES", 'Acajoom, dein Kommunikationspartner!');
define("_ACA_THANKYOU", 'Danke, dass sie Acajoom gewählt haben, ihr Kommunkationspartner!');
define("_ACA_NO_SERVER", 'Der Update Server ist nicht erreichbar, probieren sie es später noch mal.');
define("_ACA_MOD_PUB", 'Das Acajoom Modul ist nicht veröffentlicht.');
define("_ACA_MOD_PUB_LINK", 'Klicke hier um es zu veröffentlichen!');
define("_ACA_IMPORT_SUCCESS", 'Erfolgreich importiert');
define("_ACA_IMPORT_EXIST", 'Abonnenten sind bereits in der Datenbank');


// Acajoom's Guide
define("_ACA_GUIDE", "\'s Assistent");
define("_ACA_GUIDE_FIRST_ACA_STEP", "<p>Acajoom has many great features and this wizard will guide you through a four easy steps process to get you started sending your newsletters and auto-responders!<p />");
define("_ACA_GUIDE_FIRST_ACA_STEP_DESC", 'First, you need to add a list.  A list could be of two types, either a newsletter or an auto-responder.' .
		'  In the list you define all the different parameters to enable the sending of your newsletters or auto-responders: sender name, layout, subscribers\' welcome message, etc...
<br /><br />You can set up your first list  here: <a href="index2.php?option=com_acajoom&act=list">create a list</a> and click the New button.');
define("_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE", "Acajoom provides you with an easy way to import all data from a previous newsletter system.<br />" .
		" Go to the Updates panel and choose your previous newsletter system to import the all your newsletters and subscribers'.<br /><br />" .
		"<span style='color:#FF5E00;' >IMPORTANT: the import is risk FREE and doesn't affect in any way the data of your previous newsletter system'</span><br />" .
		"After the import you will be able to manage your subscribers and mailings directly from Acajoom.<br /><br />");
define("_ACA_GUIDE_SECOND_ACA_STEP", "Great your first list is setup!  You can now write your first %s.  To create it go to: ");
define("_ACA_GUIDE_SECOND_ACA_STEP_AUTO", "Auto-responder Management");
define("_ACA_GUIDE_SECOND_ACA_STEP_NEWS", "Newsletter Management");
define("_ACA_GUIDE_SECOND_ACA_STEP_FINAL", " and select your %s. <br /> Then choose your %s in the drop down list.  Create your first mailing by clicking New ");

define("_ACA_GUIDE_THRID_ACA_STEP_NEWS", 'Before you send your first newsletter you may want to check the mail configuration.  ' .
		'Go to the <a href="index2.php?option=com_acajoom&act=configuration">configuration page</a> to verify the mail settings. <br />');
define("_ACA_GUIDE_THRID2_ACA_STEP_NEWS", '<br />When you are ready go back to the Newsletters menu, select your mailing and click Send');

define("_ACA_GUIDE_THRID_ACA_STEP_AUTOS", 'For your auto-responders to be sent you first need to set up a cron task on your server. ' .
		' Please refer to the Cron tab in the configuration panel.' .
		' <a href="index2.php?option=com_acajoom&act=configuration">click here</a> to learn about setting up a cron task. <br />');

define("_ACA_GUIDE_MODULE", " <br />Make also sure that you have published Acajoom module so that people can sign up for the list.");

define("_ACA_GUIDE_FOUR_ACA_STEP_NEWS", " You can now also set up an auto-responder.");
define("_ACA_GUIDE_FOUR_ACA_STEP_AUTOS", " You can now also set up a newsletter.");
define("_ACA_GUIDE_FOUR_ACA_STEP", '<p><br />Voila! You are ready to effectively communicate with you visitors and users. This wizard will end as soon as you have entered a second mailing or you can turn it off in the <a href="index2.php?option=com_acajoom&act=configuration">configuration panel</a>.' .
		'<br /><br />  If you have any question while using Acajoom, please refer to the ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22">forum</a>. ' .
		' You will also find lots of information on how to communicate effectively with your subscribers on <a href="http://www.acajoom.com/" target="blank">www.Acajoom.com</a>.' .
		'<p /><br /><b>Thank you for using Acajoom. Your Communication Partner!<b/> ');
define("_ACA_GUIDE_TURNOFF", "Der Assistent wird abgeschaltet!");
define("_ACA_STEP", "Schritt ");

// Acajoom Install
define("_ACA_INSTALL_CONFIG", "Acajoom Konfiguration");
define("_ACA_INSTALL_SUCCESS", "Erfolgreich installiert");
define("_ACA_INSTALL_ERROR", "Installationsfehler");
define("_ACA_INSTALL_BOT", "Acajoom Plugin (Bot)");
define("_ACA_INSTALL_MODULE", "Acajoom Modul");
//Others
define('_ACA_JAVASCRIPT','!Warnung! Javascript muss erlaubt sein, damit Acajoom ordentlich funktioniert.');
define('_ACA_EXPORT_TEXT','Die zu exportierenden Abonnenten stammen aus der gewählten Liste. <br />Exportiere Abonnenten für Liste:');
define('_ACA_IMPORT_TIPS','Importiere Abonnenten. Die Informationen in dieser Datei müssen im folgenden Format sein: <br />' .
		'Name,email,receiveHTML(0/1),confirmed(0/1)');
define("_ACA_SUBCRIBER_EXIT", "ist bereits eingetragen");
define("_ACA_GET_STARTED", "Klicke hier um zu beginnen!");

//News since 1.0.1
define('_ACA_WARNING_1011','Warnung: 1011: Update funktioniert nicht, wegen ihrer Servereinstellungen.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Wählen sie welche E-Mailadresse als Absender gezeigt wird.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Wählen sie welcher Name als Absender gezeigt wird.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Wählen sie welche E-Mailfunktion sie nutzen wollen: PHP mail function, <span>Sendmail</span> oder SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Dies ist das Verzeichnis des Mailservers');
define('_ACA_LIST_T_TEMPLATE', 'Template');
define('_ACA_NO_MAILING_ENTERED', 'Kein Mailing ausgewählt');
define('_ACA_NO_LIST_ENTERED', 'Keine Liste ausgewählt');
define('_ACA_SENT_MAILING' , 'Sende Mailings');
define('_ACA_SELECT_FILE', 'Bitte wähle eine Datei um ');
define('_ACA_LIST_IMPORT', 'Wählen sie die Liste(n) mit denen Abonnenten verbunden werden sollen.');
define('_ACA_PB_QUEUE', 'Abonnent hinzugefügt, aber es gibt Probleme ihn/sie zur Liste hinzuzufügen. Bitte überprüfe dieses manuell');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Update dringend empfohlen!');
define('_ACA_UPDATE_MESS2' , 'Patch und kleine Fixe.');
define('_ACA_UPDATE_MESS3' , 'Neues Release.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 ist erforderlich um upzudaten.');
define('_ACA_UPDATE_IS_AVAIL' , ' ist erhätlich!');
define('_ACA_NO_MAILING_SENT', 'Kein Mailing versendet!');
define('_ACA_SHOW_LOGIN', 'Zeige Loginformular');
define('_ACA_SHOW_LOGIN_TIPS', 'Wählen sie Ja um ein Loginformular im Frontend von Acajoom zu zeigen, so dass Benutzer sich auf der Webseite registrieren können.');
define('_ACA_LISTS_EDITOR', 'Editor der Listenbeschreibung');
define('_ACA_LISTS_EDITOR_TIPS', 'Wählen sie Ja um einen HTMl Editor zu verwenden, um die Listenbeschreibung zu ändern.');
define('_ACA_SUBCRIBERS_VIEW', 'Zeige Abonnenten');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Front-End Einstellungen' );
define('_ACA_SHOW_LOGOUT', 'Zeige Abmelde-Button');
define('_ACA_SHOW_LOGOUT_TIPS', 'Wählen sie Ja um einen Abmelde-Button im Ajacoom-Bereich auf der Webseite zu zeigen.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integration');
define('_ACA_CB_INTEGRATION', 'Community Builder Integration');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin für den Community Builder ist noch nicht installiert!');
define('_ACA_CB_PLUGIN', 'Listen bei Registrierung');
define('_ACA_CB_PLUGIN_TIPS', 'WÄhlen sie Ja um die Mailinglisten im Registrierungsformular des Community Builders zu zeigen');
define('_ACA_CB_LISTS', 'Listen IDs');
define('_ACA_CB_LISTS_TIPS', 'DIESES FELD WIRD BENÖTIGT: Tragen sie die ID der Listen ein, die Benutzer abonnieren können sollen, getrennt durch Komma , (0 zeigt alle Listen).');
define('_ACA_CB_INTRO', 'Einführungstext');
define('_ACA_CB_INTRO_TIPS', 'Dieser Text erscheit vor der Liste. WENN ER LEER IST, WIRD NICHTS ANGEZEIGT. Benutzen sie cb_pretext für das CSS Layout.');
define('_ACA_CB_SHOW_NAME', 'Zeige Listenname');
define('_ACA_CB_SHOW_NAME_TIPS', 'Wählen sie ob der Listenname nach dem Einführungstext angezeigt werden soll oder nicht.');
define('_ACA_CB_LIST_DEFAULT', 'Wähle Liste Standardmässig aus');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Wählen sie ob die Checkbox für jede Liste standardmässig aktiviert sein soll.');
define('_ACA_CB_HTML_SHOW', 'Zeige HTML empfangen');
define('_ACA_CB_HTML_SHOW_TIPS', 'Setzten sie dieses auf JA um Benutzern zu erlauben auszuwählen, ob sie HTML E-Mails bekommen wollen oder nicht. Setzen sie auf Nein um Standardeinstellungen zu verwenden.');
define('_ACA_CB_HTML_DEFAULT', 'Standardmässig HTML empfangen');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Setzen sie diese Einstellung um die Standard HTML Konfiguration zu zeigen. Wenn  HTML empfangen auf Nein steht, ist diese Option die Standardoption.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Konnte Datei nicht sichern! Datei nicht ersetzt.');
define('_ACA_BACKUP_YOUR_FILES', 'Die alte Version der Datei wurde in folgendem Verzeichnis gesichert:');
define('_ACA_SERVER_LOCAL_TIME', 'lokale Serverzeit');
define('_ACA_SHOW_ARCHIVE', 'Zeige Archiv Knopf');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Wählen sie JA um den Archiv Knopf in der Newsletter Liste im Frontend anzuzeigen');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Bilder');
define('_ACA_LIST_OPT_CTT', 'Inhalt');
define('_ACA_INPUT_NAME_TIPS', 'Geben sie ihren vollen Namen ein (Vorname zuerst)');
define('_ACA_INPUT_EMAIL_TIPS', 'Geben sie Ihre e-mail Adresse ein (Stellen sie sicher das dies eine gültige e-mail Addresse ist, wenn sie unsere Mailings empfangen möchten.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Wählen sie Ja wenn sie HTML Mailings empfangen möchten - Nein um reine Text Mailings zu empfangen');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Wählen sie ihre Zeitzone.');


// Since 1.0.5
define('_ACA_FILES' , 'Dateien');
define('_ACA_FILES_UPLOAD' , 'Hochladen');
define('_ACA_MENU_UPLOAD_IMG' , 'Bilder hochladen');
define('_ACA_TOO_LARGE' , 'Die Datei ist zu groß. Die maximal erlaubte Größe beträgt');
define('_ACA_MISSING_DIR' , 'Das Zielverzeichnis existiert nicht');
define('_ACA_IS_NOT_DIR' , 'Das Zielverzeichnis existiert nicht oder ist eine Datei.');
define('_ACA_NO_WRITE_PERMS' , 'Sie haben keine Schreibberechtigung für das Zielverzeichnis.');
define('_ACA_NO_USER_FILE' , 'Sie haben keine Datei zum hochladen ausgewählt.');
define('_ACA_E_FAIL_MOVE' , 'Kann Datei nicht verschieben.');
define('_ACA_FILE_EXISTS' , 'Die Datei existiert bereits.');
define('_ACA_CANNOT_OVERWRITE' , 'Die Datei existiert bereits und kann nicht überschrieben werden.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Diese Dateierweiterung ist nicht erlaubt.');
define('_ACA_PARTIAL' , 'Die Datei wurde nur teilweise hochgeladen.');
define('_ACA_UPLOAD_ERROR' , 'Fehler beim hochladen:');
define('DEV_NO_DEF_FILE' , 'Die Datei wurde nur teilweise hochgeladen.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define("_ACA_CONTENTREP", '[SUBSCRIPTIONS] = Dieses wird durch die Abonnement Links ersetzt.' .
		'Es ist <strong>notwendig</strong> damit Acajoom ordentlich funktioniert.<br />' .
		'Wenn du weiteren Content in dieser Box plaziert, wird er in allen Mailings dieser Liste angezeigt.' .
		' <br />Füge deine Abonnementsnachricht am Ende hinzu.  Acajoom wird automatisch einen Link hinzufügen, damit Abonnenten ihre Abonnements ändern und sich abmelden können.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Benachrichtigung');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Benachrichtigungen');
define('_ACA_USE_SEF', 'SEF in Mailings');
define('_ACA_USE_SEF_TIPS', 'Es wird empfohlen NEIN zu wählen. Wenn Sie möchten das diese URL in Ihre Mailings eingefügt wird um SEF zu benutzen dann wählen Sie JA.' .
		' <br /><b>Die Links verhalten sich genauso bei anderen Optionen.  Es gibt keine Garantie das die Links in den Mailings immer funktionieren werden, auch wenn sie ihr SEF ändern.</b> ');
define('_ACA_ERR_NB' , 'Fehler #: ERR');
define('_ACA_ERR_SETTINGS', 'Einstellungen zur Fehlerbehandlung');
define('_ACA_ERR_SEND' ,'Sende Fehler Bericht');
define('_ACA_ERR_SEND_TIPS' ,'Wenn sie möchten das Acajoom stetig verbessert wird wählen sie JA. Dadurch wird ein Fehlerbericht zu uns gesendet.  Somit brauchen sie uns keinen manuellen Fehlerbericht mehr zu senden <br /> <b>ES WERDEN KEINE PRIVATEN INFORMATIONEN GESENDET</b>.  Wir erfahren noch nichteinmal von welcher Webseite der Fehlerbericht kommt. Wir versenden ausschließlich Informationen über Acajoom , das PHP Setup und SQL abfragen. ');
define('_ACA_ERR_SHOW_TIPS' ,'Wählen sie JA um die Fehlernummer anzuzeigen.  Wird zu debugging Zwecken genutzt. ');
define('_ACA_ERR_SHOW' ,'Fehler anzeigen');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Zeige Kündigungs Links');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Wählen Sie Ja um die Kündigungs Links am Ende der Mailings damit die Empfänger ihr Abonnement ändern können.<br /> Nein,um Fusszeilen und Links zu deaktivieren.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">WICHTIGE MITTEILUNG!</span> <br />Wenn sie von einer älteren Acajoom Installation wechseln wollen, müssen sie ihre Datenbankstruktur aktualisieren, indem sie folgenden Knopf klicken (Ihre Daten bleiben dabei erhalten)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Aktualisiere Tabellen und Konfiguration');
define('_ACA_MAILING_MAX_TIME', 'Max Warteschlangen Zeit' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Geben sie die maximale Zeit für jedes E-Mail Paket das von der Warteschlange gesendet wird ein. Empfohlene Werte liegen zwischen 30 Sek. and 2 Min.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart Integration');
define('_ACA_VM_COUPON_NOTIF', 'Coupon Benachrichtigungs ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Geben sie die ID Nummer des Mailings an welches sie benutzen möchten um die Coupons zu ihren Kunden zu schicken.');
define('_ACA_VM_NEW_PRODUCT', 'Neue Produktbenachrichtigungs ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Geben sie die ID Nummer des Mailings an um neue Produktbenachrichtigungen zu verschicken.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Formular erstellen');
define('_ACA_FORM_COPY', 'HTML code');
define('_ACA_FORM_COPY_TIPS', 'Kopiere den generierten HTML code in ihre HTML Seite.');
define('_ACA_FORM_LIST_TIPS', 'Wählen sie die Liste aus die sie in ihr Formular einfügen möchten');
// update messages
define('_ACA_UPDATE_MESS4' , 'Kann\Kann nicht automatisch updaten.');
define('_ACA_WARNG_REMOTE_FILE' , 'Kann entfernte Datei nicht laden.');
define('_ACA_ERROR_FETCH' , 'Fehler beim holen der Datei.');

define('_ACA_CHECK' , 'Überprüfen');
define('_ACA_MORE_INFO' , 'Mehr Informationen');
define('_ACA_UPDATE_NEW' , 'Update auf neuere Version');
define('_ACA_UPGRADE' , 'Auf erweitertes Produkt aktualisieren');
define('_ACA_DOWNDATE' , 'Zurück zur letzten Version');
define('_ACA_DOWNGRADE' , 'Zurück zum Basis Produkt');
define('_ACA_REQUIRE_JOOM' , 'Benötige Joomla');
define('_ACA_TRY_IT' , 'Ausprobieren!');
define('_ACA_NEWER', 'Neuer');
define('_ACA_OLDER', 'Älter');
define('_ACA_CURRENT', 'Aktuell');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Versuchen sie eine der anderen Komponenten');
define('_ACA_MENU_VIDEO' , 'Video Anleitungen');
define('_ACA_AUTO_SCHEDULE', 'Zeitplan');
define('_ACA_SCHEDULE_TITLE', 'Automatische Zeitplan Einstellungen');
define('_ACA_ISSUE_NB_TIPS' , 'Ausgabenummer wird automatisch vom System generiert' );
define('_ACA_SEL_ALL' , 'Alle Mailings');
define('_ACA_SEL_ALL_SUB' , 'Alle Listen');
define('_ACA_INTRO_ONLY_TIPS' , 'Wenn sie diese Option auswählen, wird nur der Einführungstext des Artikels in ihr Mailing eingesetzt. Dazu ein Link zu dem kompletten Artikel auf ihrer Seite.' );
define('_ACA_TAGS_TITLE' , 'Inhalts Variable');
define('_ACA_TAGS_TITLE_TIPS' , 'Kopieren und fügen sie diese Variable in ihr Mailing, an der Stelle an der der Inhalt erscheinen soll.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Geben sie eine e-mail Adresse an, zu welcher der Test gesendet werden soll');
define('_ACA_PREVIEW_TITLE' , 'Vorschau');
define('_ACA_AUTO_UPDATE' , 'Neue Update Benachrichtigung');
define('_ACA_AUTO_UPDATE_TIPS' , 'Wählen Sie JA wenn sie über neue Updates der Komponente benachrichtigt werden wollen. <br />Wichtig!! "Tips anzeigen" muss eingeschaltet sein damit diese Funktion arbeitet.');

// since 1.1.0
define('_ACA_LICENSE' , 'Lizenz Information');

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
<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
 * <p>Swedish language file.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author Janne Karlsson<support@acajoom.com>
 * @version $Id: swedish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom är en mailinglista, nyhetsbrev, auto-respondrar, och ett uppföljningsverktyg för att kommunicera effektivt med dina användare och kunder. ' .
		'Acajoom, Din Kommunikations Partner!');
define('_ACA_FEATURES', 'Acajoom, din kommunikationspartner!');

// Type of lists
define('_ACA_NEWSLETTER', 'Nyhetsbrev');
define('_ACA_AUTORESP', 'Auto-responder');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eKort');
define('_ACA_POSTCARD', 'Postkort');
define('_ACA_PERF', 'Prestanda');
define('_ACA_COUPON', 'Kupong');
define('_ACA_CRON', 'Cron Uppgift');
define('_ACA_MAILING', 'Maila');
define('_ACA_LIST', 'Lista');

 //acajoom Menu
define('_ACA_MENU_LIST', 'List Hanterare');
define('_ACA_MENU_SUBSCRIBERS', 'Prenumeranter');
define('_ACA_MENU_NEWSLETTERS', 'Nyhetsbrev');
define('_ACA_MENU_AUTOS', 'Auto-respondrar');
define('_ACA_MENU_COUPONS', 'Kuponger');
define('_ACA_MENU_CRONS', 'Cron Uppgifter');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eKort');
define('_ACA_MENU_POSTCARDS', 'Postkort');
define('_ACA_MENU_PERFS', 'Prestanda');
define('_ACA_MENU_TAB_LIST', 'Listor');
define('_ACA_MENU_MAILING_TITLE', 'Mail');
define('_ACA_MENU_MAILING' , 'Mailande för ');
define('_ACA_MENU_STATS', 'Statistik');
define('_ACA_MENU_STATS_FOR', 'Statistik för ');
define('_ACA_MENU_CONF', 'Konfiguration');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Om');
define('_ACA_MENU_LEARN', 'Utbildningscenter');
define('_ACA_MENU_MEDIA', 'Media Hanterare');
define('_ACA_MENU_HELP', 'Hjälp');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Importera');
define('_ACA_MENU_EXPORT', 'Exportera');
define('_ACA_MENU_SUB_ALL', 'Prenumerara Alla');
define('_ACA_MENU_UNSUB_ALL', 'Ej Prenumerera Alla');
define('_ACA_MENU_VIEW_ARCHIVE', 'Arkiv');
define('_ACA_MENU_PREVIEW', 'Förhandsgranska');
define('_ACA_MENU_SEND', 'Skicka');
define('_ACA_MENU_SEND_TEST', 'Skicka Test E-post');
define('_ACA_MENU_SEND_QUEUE', 'Process Kö');
define('_ACA_MENU_VIEW', 'Visa');
define('_ACA_MENU_COPY', 'Kopiera');
define('_ACA_MENU_VIEW_STATS' , 'Visa stats');
define('_ACA_MENU_CRTL_PANEL' , ' Kontrollpanel');
define('_ACA_MENU_LIST_NEW' , ' Skapa en Lista');
define('_ACA_MENU_LIST_EDIT' , ' Redigera en Lista');
define('_ACA_MENU_BACK', 'Tillbaka');
define('_ACA_MENU_INSTALL', 'Installation');
define('_ACA_MENU_TAB_SUM', 'Summering');
define('_ACA_STATUS' , 'Status');

// messages
define('_ACA_ERROR' , ' Ett fel inträffade! ');
define('_ACA_SUB_ACCESS' , 'Behörighets rättigheter');
define('_ACA_DESC_CREDITS', 'Krediter');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Hemsida');
define('_ACA_DESC_MAILING', 'Maillista');
define('_ACA_DESC_SUBSCRIBERS', 'Prenumeranter');
define('_ACA_PUBLISHED','Publicerad');
define('_ACA_UNPUBLISHED','Opublicerad');
define('_ACA_DELETE','Radera');
define('_ACA_FILTER','Filter');
define('_ACA_UPDATE','Uppdatera');
define('_ACA_SAVE','Spara');
define('_ACA_CANCEL','Avbryt');
define('_ACA_NAME','Namn');
define('_ACA_EMAIL','E-post');
define('_ACA_SELECT','Välj');
define('_ACA_ALL','Alla');
define('_ACA_SEND_A', 'Skicka en ');
define('_ACA_SUCCESS_DELETED', ' raderades');
define('_ACA_LIST_ADDED', 'Lista skapades');
define('_ACA_LIST_COPY', 'Lista kopierades');
define('_ACA_LIST_UPDATED', 'Lista uppdaterades');
define('_ACA_MAILING_SAVED', 'Mailande sparades.');
define('_ACA_UPDATED_SUCCESSFULLY', 'uppdaterat.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Prenumerations information');
define('_ACA_VERIFY_INFO', 'Verifiera länken du la till, viss information saknas.');
define('_ACA_INPUT_NAME', 'Namn');
define('_ACA_INPUT_EMAIL', 'E-post');
define('_ACA_RECEIVE_HTML', 'Mottag HTML?');
define('_ACA_TIME_ZONE', 'Tids Zon');
define('_ACA_BLACK_LIST', 'Svarta listan');
define('_ACA_REGISTRATION_DATE', 'Användares registreringsdatum');
define('_ACA_USER_ID', 'Användar ID');
define('_ACA_DESCRIPTION', 'Beskrivning');
define('_ACA_ACCOUNT_CONFIRMED', 'Ditt konto har aktiverats.');
define('_ACA_SUB_SUBSCRIBER', 'Prenumerant');
define('_ACA_SUB_PUBLISHER', 'Publisher');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registered');
define('_ACA_SUBSCRIPTIONS', 'Prenumerationer');
define('_ACA_SEND_UNSUBCRIBE', 'Skicka prenumerera ej meddelande');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Klicka Ja för att skicka ett prenumerera ej e-post bekräftelse meddelande.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Bekräfta din prenumeration');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Prenumerera Ej bekräftelse');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hej ! [NAME],<br />' .
		'Bara ett steg till sedan är du inlagd i prenumerationslistan.  Klicka på följande länk för att bekräfta din prenumeration.' .
		'<br /><br />[CONFIRM]<br /><br />Vid frågor kontakta webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Detta är ett bekräftelsemail om att du har valt att inte längre prenumerera hos oss mera.  Vi är självklart ledsna att du valt detta men om du väljer att åter prenumerera hos oss igen så är du välkommen tillbaka.  Om du har några frågor så kontakta vår webmaster.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Inskrivningsdatum');
define('_ACA_CONFIRMED', 'Bekräftad');
define('_ACA_SUBSCRIB', 'Prenumerera');
define('_ACA_HTML', 'HTML mail');
define('_ACA_RESULTS', 'Resultat');
define('_ACA_SEL_LIST', 'Välj en lista');
define('_ACA_SEL_LIST_TYPE', '- Välj typ av lista -');
define('_ACA_SUSCRIB_LIST', 'Lista på alla prenumeranter');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'prenumeranter för : ');
define('_ACA_NO_SUSCRIBERS', 'Inga prenumeranter hittades i denna lista.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Ett bekräftelsemail har skickats till e-postadressen som du uppgav.  Kolla ditt e-post meddelande och klicka på länken som anges.<br />' .
		'Du behöver bekräfta din e-post för att din prenumeration ska börja gälla.');
define('_ACA_SUCCESS_ADD_LIST', 'Du har lagts till i listan över prenumerationer.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Klicka här för att bekräfta din prenumeration');
define('_ACA_UNSUBSCRIBE_LINK', 'Klicka här för att ta bort dig från listan över prenumeranter');
define('_ACA_UNSUBSCRIBE_MESS', 'Din e-postadress har tagits bort från listan');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Alla schemalagda mailningar har skickats iväg.');
define('_ACA_MALING_VIEW', 'Visa alla mailningar');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Är du säker på att du inte vill prenumerera hos oss längre?');
define('_ACA_MOD_SUBSCRIBE', 'Prenumerera');
define('_ACA_SUBSCRIBE', 'Prenumerera');
define('_ACA_UNSUBSCRIBE', 'Prenumerera Ej');
define('_ACA_VIEW_ARCHIVE', 'Visa arkiv');
define('_ACA_SUBSCRIPTION_OR', ' eller klicka här för att uppdatera din information');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'E-postadressen som du angav finns redan.');
define('_ACA_SUBSCRIBER_DELETED', 'Prenumerant raderades.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Användar Kontrollpanel');
define('_UCP_USER_MENU', 'Användarmeny');
define('_UCP_USER_CONTACT', 'Mina Prenumerationer');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Cron Uppgifts Hanterare');
define('_UCP_CRON_NEW_MENU', 'NY Cron');
define('_UCP_CRON_LIST_MENU', 'Lista min Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Kupong Hanterare');
define('_UCP_COUPON_LIST_MENU', 'Lista på Kuponger');
define('_UCP_COUPON_ADD_MENU', 'Skapa en Kupong');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Beskrivning');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Prenumeration');
define('_ACA_LIST_T_SENDER', 'Avsändarinformation');

define('_ACA_LIST_TYPE', 'List Typ');
define('_ACA_LIST_NAME', 'List namn');
define('_ACA_LIST_ISSUE', 'Nummer #');
define('_ACA_LIST_DATE', 'Sändningsdatum');
define('_ACA_LIST_SUB', 'Mailämne');
define('_ACA_ATTACHED_FILES', 'Bifogade filer');
define('_ACA_SELECT_LIST', 'Välj en lista att redigera!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Typ av lista');
define('_ACA_AUTO_RESP_OPTION', 'Auto-responder val');
define('_ACA_AUTO_RESP_FREQ', 'Prenumeranter kan välja frekvens');
define('_ACA_AUTO_DELAY', 'Försening (i dagar)');
define('_ACA_AUTO_DAY_MIN', 'Minimum frekvens');
define('_ACA_AUTO_DAY_MAX', 'Maximum frekvens');
define('_ACA_FOLLOW_UP', 'Specificera auto-responder uppföljning');
define('_ACA_AUTO_RESP_TIME', 'Prenumeranter kan välja tid');
define('_ACA_LIST_SENDER', 'Lista avsändare');

define('_ACA_LIST_DESC', 'List beskrivning');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Avsändarnamn');
define('_ACA_SENDER_EMAIL', 'Avsändarens e-post');
define('_ACA_SENDER_BOUNCE', 'Avsändarens studsadress');
define('_ACA_LIST_DELAY', 'Försening');
define('_ACA_HTML_MAILING', 'HTML mail?');
define('_ACA_HTML_MAILING_DESC', '(om du ändrar detta, så behöver du spara och återvända till denna ruta för att se ändringarna.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Dölj på framsidan?');
define('_ACA_SELECT_IMPORT_FILE', 'Välj en fil att importera');;
define('_ACA_IMPORT_FINISHED', 'Importering avslutat');
define('_ACA_DELETION_OFFILE', 'Radering av fil');
define('_ACA_MANUALLY_DELETE', 'misslyckades, du måste ta bort filen manuellt');
define('_ACA_CANNOT_WRITE_DIR', 'Kan inte skriva till mappen');
define('_ACA_NOT_PUBLISHED', 'Kunde inte skicka mailen, listan är inte publicerad.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Klicka Ja för att publicera listan');
define('_ACA_INFO_LIST_NAME', 'Skriv in namnet på listan här. Du kan identifiera listan med detta namn.');
define('_ACA_INFO_LIST_DESC', 'Skriv in en kort beskrivning på listan här. Denna beskrivning kommer att vara synlig för besökare på din hemsida.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Skriv in namnet på avsändaren på mailen. Detta namn kommer att vara synligt när prenumeranter mottar meddelanden från denna lista.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Skriv in e-postadressen från vilken meddelandet kommer att skickas ifrån.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Skriv in e-postadressen som användare kan svar till. Det rekomenderas att det är samma som avsändar adressen, eftersom spamfilter kommer att ge ditt meddelande en högre rankning om dom är olika.');
define('_ACA_INFO_LIST_AUTORESP', 'Välj typ av mail på denna lista. <br />' .
		'Nyhetsbrev: normalt nyhetsbrev<br />' .
		'Auto-responder: en auto-responder är en lista som sänds automatiskt genom hemsidan vid regelbundna intervaller.');
define('_ACA_INFO_LIST_FREQUENCY', 'Aktivera användare genom att ange hur ofta dom ska motta från denna lista.  Det ger mer flexibilitet för användaren.');
define('_ACA_INFO_LIST_TIME', 'Låt användaren välja sin önskade tid på dygnet för att motta från listan.');
define('_ACA_INFO_LIST_MIN_DAY', 'Definera vad som är den minimala frekvensen en användare kan välja att mottaga listan');
define('_ACA_INFO_LIST_DELAY', 'Specificera fördröjningen mellan denna auto-responder och den föregående gången.');
define('_ACA_INFO_LIST_DATE', 'Specificera datumet för publicering av nyhetslistan om du vill fördröja publiceringen. <br /> FORMAT : ÅÅÅÅ-MM-DD TT:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Definera vad som är den maximala frekvensen en användare kan välja att mottaga listan');
define('_ACA_INFO_LIST_LAYOUT', 'Skriv in layouten på din maillista här. Du kan fylla i vilken layout för din mail här.');
define('_ACA_INFO_LIST_SUB_MESS', 'Detta meddelande kommer att skickas till prenumeranten när han eller hon registreras för första gången. Du kan fylla i den text du önskar här.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Detta meddelande kommer att skickas till prenumeranten när han eller hon vill avsäga sig sin prenumeration. Ditt meddelande kan du fylla i här.');
define('_ACA_INFO_LIST_HTML', 'Välj kryssrutan om du vill skicka ut ett HTML mail. Prenumeranter kommer att kunna specificera om dom vill motta HTML meddelande, eller endast Text meddelande när dom prenumererar på en HTML lista.');
define('_ACA_INFO_LIST_HIDDEN', 'Klicka Ja för att dölja listan på förstasidan, användare kommer inte att kunna prenumerera men du kommer fortfarande att kunna skicka mail.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Vill du med automatik lägga till prenumeranter till denna lista?<br /><B>Nya Användare:</B> kommer att registrera varje ny användare som har registrerat sig på hemsidan.<br /><B>Alla Användare:</B> kommer att registrera varje registrerad användare till databasen.<br />(alla dessa alternativ supportar Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Välj förstasidans behörighetsnivå. Detta kommer att visa eller dölja mailen till användargrupper som inte har tillgång till den, så dom inte kan prenumerera på den.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Välj behörighetsnivå på användargrupper som du vill ska kunna redigera. Dessa användargrupper och ovanför kommer att kunna redigera mailen och skicka ut dom, antingen från förstasidan eller från backend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Om du vill att auto-respondern ska flyttas till en annan så fort den skickat sitt sista meddelande så kan du specificera det här för att följa upp auto-respondern.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Detta är ID:en på personen som skapade listan.');
define('_ACA_INFO_LIST_WARNING', ' Detta sista val är endast tillgängligt på slutet vid skapande av listan.');
define('_ACA_INFO_LIST_SUBJET', ' Ämne på mailen.  Detta är ämnet på e-posten som prenumeranten kommer att motta.');
define('_ACA_INFO_MAILING_CONTENT', 'Detta är huvudrutan på mailet som kommer att skickas.');
define('_ACA_INFO_MAILING_NOHTML', 'Skriv in här huvudtexten på mailet som du vill skicka till prenumeranterna som väljer att motta endast icke HTML mail. <BR/> NOTERA: om du lämnar detta tomt så kommer Acajoom automatiskt att konvertera det från HTML text till endast text.');
define('_ACA_INFO_MAILING_VISIBLE', 'Klicka Ja för att visa mailen på förstasidan.');
define('_ACA_INSERT_CONTENT', 'Sätt in existerande innehåll');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Kupong skickat!');
define('_ACA_CHOOSE_COUPON', 'Välj en kupong');
define('_ACA_TO_USER', ' till denna användare');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Varje timma');
define('_ACA_FREQ_CH2', 'Var 6:e timma');
define('_ACA_FREQ_CH3', 'Var 12:e timma');
define('_ACA_FREQ_CH4', 'Dagligt');
define('_ACA_FREQ_CH5', 'Veckovis');
define('_ACA_FREQ_CH6', 'Månadsvis');
define('_ACA_FREQ_NONE', 'Nej');
define('_ACA_FREQ_NEW', 'Nya Användare');
define('_ACA_FREQ_ALL', 'Alla Användare');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Klicka Ja om du vill använda detta som ett Acajoom Cron, Nej för någon annan cron uppgift.<br />' .
		'Om du klicka Ja så behöver du inte ange någon Cron Adress, det kommer automatiskt att läggas till.');
define('_ACA_SITE_URL' , 'Din hemsidas URL');
define('_ACA_CRON_FREQUENCY' , 'Cron Frekvens');
define('_ACA_STARTDATE_FREQ' , 'Start Datum');
define('_ACA_LABELDATE_FREQ' , 'Specificera Datum');
define('_ACA_LABELTIME_FREQ' , 'Specificera Tid');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Frekvens');
define('_ACA_TITLE_CRONLIST', 'Cron Lista');
define('_NEW_LIST', 'Skapa en ny lista');

//title CRON form
define('_ACA_TITLE_FREQ', 'Redigera Cron');
define('_ACA_CRON_SITE_URL', 'Fyll i en giltig hemside url, starta med http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Alla mail');
define('_ACA_EDIT_A', 'Redigera ett ');
define('_ACA_SELCT_MAILING', 'Välj en lista i drop down menyn för att lägga till en ny mail.');
define('_ACA_VISIBLE_FRONT', 'Synligt på förstasidan');

// mailer
define('_ACA_SUBJECT', 'Ämne');
define('_ACA_CONTENT', 'Innehåll');
define('_ACA_NAMEREP', '[NAME] = Detta kommer att ersättas med namnet som prenumeranten uppgav, du skickar personlig e-post när du använder dig av detta.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Detta kommer att ersättas med FÖR namnet som prenumeranten uppgav.<br />');
define('_ACA_NONHTML', 'Ingen-html version');
define('_ACA_ATTACHMENTS', 'Bifogade filer');
define('_ACA_SELECT_MULTIPLE', 'Hold kontrollen (eller kommando) för att välja flera bifogade filer.<br />' .
		'Filerna som visas i den bifogade listan finns i en bifogad fil mapp, du kan ändra denna plats i konfigurationspanelen.');
define('_ACA_CONTENT_ITEM', 'Innehålls objekt');
define('_ACA_SENDING_EMAIL', 'Skickar e-post');
define('_ACA_MESSAGE_NOT', 'Meddelandet kunde inte skickas');
define('_ACA_MAILER_ERROR', 'Mail fel');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Meddelande skickat');
define('_ACA_SENDING_TOOK', 'Sändning av detta mail tog');
define('_ACA_SECONDS', 'sekunder');
define('_ACA_NO_ADDRESS_ENTERED', 'Ingen e-postadress eller prenumerant angavs');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Ändra');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Ändra din prenumeration');
define('_ACA_WHICH_EMAIL_TEST', 'Indikera en e-postadress för att skicka ett test till eller välj förhandsgranska');
define('_ACA_SEND_IN_HTML', 'Send in HTML (for html mailings)?');
define('_ACA_VISIBLE', 'Synlig');
define('_ACA_INTRO_ONLY', 'Endast Intro');

// stats
define('_ACA_GLOBALSTATS', 'Global stats');
define('_ACA_DETAILED_STATS', 'Detaljerad stats');
define('_ACA_MAILING_LIST_DETAILS', 'List detaljer');
define('_ACA_SEND_IN_HTML_FORMAT', 'Skicka i HTML format');
define('_ACA_VIEWS_FROM_HTML', 'Visningar (fråm html mail)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Skicka i text format');
define('_ACA_HTML_READ', 'HTML läst');
define('_ACA_HTML_UNREAD', 'HTML oläst');
define('_ACA_TEXT_ONLY_SENT', 'Endast Text');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Loggar & Stats');
define('_ACA_SUBSCRIBER_CONFIG', 'Prenumeranter');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Övrig');
define('_ACA_MAIL_SETTINGS', 'Mail Inställningar');
define('_ACA_MAILINGS_SETTINGS', 'Mail Inställningar');
define('_ACA_SUBCRIBERS_SETTINGS', 'Prenumerant Inställningar');
define('_ACA_CRON_SETTINGS', 'Cron Inställningar');
define('_ACA_SENDING_SETTINGS', 'Sändnings Inställningar');
define('_ACA_STATS_SETTINGS', 'Statistik Inställningar');
define('_ACA_LOGS_SETTINGS', 'Logg Inställningar');
define('_ACA_MISC_SETTINGS', 'Övriga Inställningar');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Från E-post');
define('_ACA_SEND_MAIL_NAME', 'Från Namn');
define('_ACA_MAILSENDMETHOD', 'Mail metod');
define('_ACA_SENDMAILPATH', 'Skicka mail sökväg');
define('_ACA_SMTPHOST', 'SMTP värd');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP Autentificering krävs');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Välj ja om din SMTP server kräver autentificering');
define('_ACA_SMTPUSERNAME', 'SMTP användarnamn');
define('_ACA_SMTPUSERNAME_TIPS', 'Skriv in SMTP användarnamnet när din SMTP server kräver autentificering');
define('_ACA_SMTPPASSWORD', 'SMTP lösenord');
define('_ACA_SMTPPASSWORD_TIPS', 'Skriv in SMTP lösenord när din SMTP server kräver autentificering');
define('_ACA_USE_EMBEDDED', 'Använd inbäddade bilder');
define('_ACA_USE_EMBEDDED_TIPS', 'Välj ja om bilderna i bifogat innehålls objekt ska bäddas in i mailet för html meddelanden, eller nej för att använda dig av standardbild tagar som länkas till bilderna på hemsidan.');
define('_ACA_UPLOAD_PATH', 'Uppladdning/bifogade filer sökväg');
define('_ACA_UPLOAD_PATH_TIPS', 'Du kan specificera en uppladdningsmapp.<br />' .
		'Se till att mappen som du specificerade finns, annars skapa den.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Tillåt oregistrerade');
define('_ACA_ALLOW_UNREG_TIPS', 'Välj Ja om du vill tillåta användare att prenumerera på listor utan att vara registrerade på hemsidan.');
define('_ACA_REQ_CONFIRM', 'Kräver bekräftelse');
define('_ACA_REQ_CONFIRM_TIPS', 'Välj ja om du kräver att oregistrerade prenumeranter ska bekräfta sin e-postadress.');
define('_ACA_SUB_SETTINGS', 'Prenumerations Inställningar');
define('_ACA_SUBMESSAGE', 'Prenumerations E-post');
define('_ACA_SUBSCRIBE_LIST', 'Prenumerera på en lista');

define('_ACA_USABLE_TAGS', 'Användbara taggar');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Detta skapar en klickbar länk som prenumeranten kan bekräfta sin prenumeration. Detta  <strong>krävs</strong> för att Acajoom ska fungera korrekt.<br />'
.'<br />[NAME] = Detta kommer att ersättas med namnet som prenumeranten uppgav, du skickar personlig e-post om du använder dig av detta.<br />'
.'<br />[FIRSTNAME] = Detta kommer att ersättas med FÖR namnet på prenumeranten, Första namnet DEFINERAS som första namnet som fylls i av prenumeranten.<br />');
define('_ACA_CONFIRMFROMNAME', 'Bekräfta från namn');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Skriv in från namn som visas i bekräftelse listor.');
define('_ACA_CONFIRMFROMEMAIL', 'Bekräfta från e-post');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Skriv in en e-postadress som visas i bekräftelse listor.');
define('_ACA_CONFIRMBOUNCE', 'Studsadress');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Skriv in en studsadress som visas i bekräftelse listor.');
define('_ACA_HTML_CONFIRM', 'HTML bekräftelse');
define('_ACA_HTML_CONFIRM_TIPS', 'Välj ja om bekräftelse listor ska vara html om användaren tillåter html.');
define('_ACA_TIME_ZONE_ASK', 'Fråga tidszon');
define('_ACA_TIME_ZONE_TIPS', 'Välj ja om du vill fråga om användarnas tidszon.  De köade mailen kommer att skickas enligt turordningen baserat på vilken tidszon man befinner sig i');

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', 'klicka här för att ställa in offset i den globala konfigurationspanelen -> Lokal tab');
define('_ACA_TIME_OFFSET_TIPS', 'Ställ in din servers tid offset så det inspelade datumet och tiden är exakt');
define('_ACA_TIME_OFFSET', 'Tid offset');
define('_ACA_CRON_TITLE', 'Ställer in cron funktion');
define('_ACA_CRON_DESC','<br />Genom att använda cron funktionen så kan du ställa in en automatisk uppgift för din hemsida!<br />' .
		'För att ställa in den så behöver du i din crontab kontrollpanel skriva följande kommando:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Om du behöver hjälp att ställa in den eller har problem var god och konsultera vårat forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pausa x sekunder varje konfigurerad mängd av mail');
define('_ACA_PAUSEX_TIPS', 'Skriv in antalet sekunder som Acajoom kommer att ge SMTP servern tiden att sända ut meddelanden innan den fortsätter med nästa konfigurerade mängd av meddelanden.');
define('_ACA_EMAIL_BET_PAUSE', 'Mail mellan pausar');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Antalet mail att skicka innan den ska pausa.');
define('_ACA_WAIT_USER_PAUSE', 'Vänta på användarinmatningsdata vid paus');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Om skriptet ska vänta på användarinmatningsdata när paus sker med mailande.');
define('_ACA_SCRIPT_TIMEOUT', 'Skript timeout');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Antalet minuter som skriptet ska köras.');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Aktivera läs statistik');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Välj ja om du vill logga antalet visningar. Denna teknik kan endast användas med html mailande');
define('_ACA_LOG_VIEWSPERSUB', 'Logga visningar per prenumerant');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Välj ja om du vill logga antalet visningar per prenumerant. Denna teknik kan endast användas med html mailande');
// Logs settings
define('_ACA_DETAILED', 'Detaljerade loggar');
define('_ACA_SIMPLE', 'Förenklade loggar');
define('_ACA_DIAPLAY_LOG', 'Visa loggar');
define('_ACA_DISPLAY_LOG_TIPS', 'Välj ja om du vill visa loggar medans du skickar mail.');
define('_ACA_SEND_PERF_DATA', 'Sänd ut prestanda');
define('_ACA_SEND_PERF_DATA_TIPS', 'Välj ja om du vill tillåta Acajoom att sända ut ANONYMA rapporter om din konfiguration, antalet prenumeranter i en lista och tiden det tog att skicka ut mailen. Detta ger oss en idé om Acajoom prestandan och kommer att HJÄLPA OSS att förbättra Acajoom i framtida utvecklingar.');
define('_ACA_SEND_AUTO_LOG', 'Skicka logg för auto-responder');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Välj ja om du vill skicka en mail logg varje gång tek kön behandlas.  VARNING: detta kan resultera i stor mängd mail.');
define('_ACA_SEND_LOG', 'Skicka logg');
define('_ACA_SEND_LOG_TIPS', 'Om en logg av mailandet ska e-postas till användarens e-postadress som skickade mailet.');
define('_ACA_SEND_LOGDETAIL', 'Skicka logg detaljer');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Detaljerad inkluderar den lyckade eller felaktiga information för varje prenumerant och en överblick utav informationen. Skickar endast en enkel översikt.');
define('_ACA_SEND_LOGCLOSED', 'Skicka logg om överföringen stängs');
define('_ACA_SEND_LOGCLOSED_TIPS', ' Med detta val på användaren som skickade mailet så kommer den personen fortfarande få en rapport via e-post.');
define('_ACA_SAVE_LOG', 'Spara logg');
define('_ACA_SAVE_LOG_TIPS', 'Om en logg på mailen ska tas upp till loggfilen.');
define('_ACA_SAVE_LOGDETAIL', 'Spara loggdetaljer');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Detaljerad inkluderar den lyckade eller felaktiga information för varje prenumerant och en överblick utav informationen. Sparar endast en enkel översikt.');
define('_ACA_SAVE_LOGFILE', 'Spara loggfil');
define('_ACA_SAVE_LOGFILE_TIPS', 'Filen som logg informationen ska tas upp till. Denna fil kan bli riktigt stor.');
define('_ACA_CLEAR_LOG', 'Rensa logg');
define('_ACA_CLEAR_LOG_TIPS', 'Rensar loggfilen.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Senast körda kö');
define('_ACA_CP_TOTAL', 'Totalt');
define('_ACA_MAILING_COPY', 'Mailen kopierad!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Visa guide');
define('_ACA_SHOW_GUIDE_TIPS', 'Visar guiden vid start för att hjälpa nya användare skapa ett nyhetsbrev, en auto-responder och att ställa in Acajoom ordentligt.');
define('_ACA_AUTOS_ON', 'Använd Auto-respondrar');
define('_ACA_AUTOS_ON_TIPS', 'Välj Nej om du inte vill använda Auto-respondrar, alla auto-responder val kommer att inaktiveras.');
define('_ACA_NEWS_ON', 'Använd Nyhetsbrev');
define('_ACA_NEWS_ON_TIPS', 'Välj Nej om du inte vill använda Nyhetsbrev, alla nyhetsbrevsval kommer att inaktiveras.');
define('_ACA_SHOW_TIPS', 'Visa tips');
define('_ACA_SHOW_TIPS_TIPS', 'Visa tipsen, för att hjälpa användare att använda Acajoom mer effektivt.');
define('_ACA_SHOW_FOOTER', 'Visa sidfot');
define('_ACA_SHOW_FOOTER_TIPS', 'Om sidfots copyrights noteringar ska visas.');
define('_ACA_SHOW_LISTS', 'Visa listor på förstasidan');
define('_ACA_SHOW_LISTS_TIPS', 'När användare inte är registrerade visa en lista på listor som dom kan prenumerera på med arkivknapp för nyhetsbrev eller ett login formulär så dom kan registrera sig.');
define('_ACA_CONFIG_UPDATED', 'Konfigurations detaljerna har uppdaterats!');
define('_ACA_UPDATE_URL', 'Uppdatera URL');
define('_ACA_UPDATE_URL_WARNING', 'VARNING! Ändra inte på denna URL om du inte har blivit tillsagd av Acajoom tekniska team att göra så.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Som exempel: http://www.acajoom.com/update/ (inkludera det avslutande slashen)');

// module
define('_ACA_EMAIL_INVALID', 'E-posten som angavs är felaktig.');
define('_ACA_REGISTER_REQUIRED', 'Var vänlig och registrera dig på hemsidan innan du kan anmäla dig som prenumerant.');

// Access level box
define('_ACA_OWNER', 'Skapare av lista:');
define('_ACA_ACCESS_LEVEL', 'Ställ in behörighetsnivå för listan');
define('_ACA_ACCESS_LEVEL_OPTION', 'Behörighetsnivå Val');
define('_ACA_USER_LEVEL_EDIT', 'Välj vilken användarnivå som tillåter redigering av mailen (antingen från förstasidan eller backend) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Daglig');
define('_ACA_AUTO_DAY_CH2', 'Daglig ingen helg');
define('_ACA_AUTO_DAY_CH3', 'Varannan dag');
define('_ACA_AUTO_DAY_CH4', 'Varannan dag ingen helg');
define('_ACA_AUTO_DAY_CH5', 'Veckovis');
define('_ACA_AUTO_DAY_CH6', 'Varannan vecka');
define('_ACA_AUTO_DAY_CH7', 'Månadsvis');
define('_ACA_AUTO_DAY_CH9', 'Årligt');
define('_ACA_AUTO_OPTION_NONE', 'Nej');
define('_ACA_AUTO_OPTION_NEW', 'Nya Användare');
define('_ACA_AUTO_OPTION_ALL', 'Alla Användare');

//
define('_ACA_UNSUB_MESSAGE', 'Prenumerera Ej E-post');
define('_ACA_UNSUB_SETTINGS', 'Prenumerera Ej Inställningar');
define('_ACA_AUTO_ADD_NEW_USERS', 'Auto Prenumerera Användare?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Det finns förnärvarande inga uppdateringar tillgängliga.');
define('_ACA_VERSION', 'Acajoom Version');
define('_ACA_NEED_UPDATED', 'Filer som behöver uppdateras:');
define('_ACA_NEED_ADDED', 'Filer som behöver läggas till:');
define('_ACA_NEED_REMOVED', 'Filer som behöver tas bort:');
define('_ACA_FILENAME', 'Filnamn:');
define('_ACA_CURRENT_VERSION', 'Nuvarande version:');
define('_ACA_NEWEST_VERSION', 'Nyaste version:');
define('_ACA_UPDATING', 'Uppdaterar');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Filerna har uppdaterats.');
define('_ACA_UPDATE_FAILED', 'Uppdatering misslyckades!');
define('_ACA_ADDING', 'Lägger till');
define('_ACA_ADDED_SUCCESSFULLY', 'Tillagda.');
define('_ACA_ADDING_FAILED', 'Tilläggning misslyckades!');
define('_ACA_REMOVING', 'Tar bort');
define('_ACA_REMOVED_SUCCESSFULLY', 'Togs bort.');
define('_ACA_REMOVING_FAILED', 'Borttagning misslyckades!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installera en annan version');
define('_ACA_CONTENT_ADD', 'Skapa innehåll');
define('_ACA_UPGRADE_FROM', 'Importera data (nyhetsbrev och prenumeranter\' information) från ');
define('_ACA_UPGRADE_MESS', 'Det finns ingen risk för din existerande data. <br /> Denna process kommer importera data till Acajoom databasen.');
define('_ACA_CONTINUE_SENDING', 'Fortsätt skicka');

// Acajoom message
define('_ACA_UPGRADE1', 'Du kan enkelt importera dina användare och nyhetsbrev från ');
define('_ACA_UPGRADE2', ' till Acajoom i uppdateringspanelen.');
define('_ACA_UPDATE_MESSAGE', 'En ny version av Acajoom finns tillgänglig! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Klicka här för att uppdatera!');
define('_ACA_CRON_SETUP', 'För att autorespondrarna ska skickas så behöver du ställa in en cron uppgift.');
define('_ACA_THANKYOU', 'Tack för att du valde Acajoom, Din kommunikationspartner!');
define('_ACA_NO_SERVER', 'Uppdatering av Server är inte tillgänglig, var god och försök senare.');
define('_ACA_MOD_PUB', 'Acajoom modulen är inte publicerad.');
define('_ACA_MOD_PUB_LINK', 'Klicka här för att publicera den!');
define('_ACA_IMPORT_SUCCESS', 'Importerades');
define('_ACA_IMPORT_EXIST', 'Prenumeranten finns redan i databasen');


// Acajoom's Guide
define('_ACA_GUIDE', '\'s Wizard');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom har många stora fördelar och denna wizard kommer att guida dig igenom fyra enkla steg för att hjälpa dig att komma igång med sändning av ditt nyhetsbrev och auto-respondrar!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Första, du behöver skapa en lista.  En lista kan vara av två typer, antingen ett nyhetsbrev eller en auto-responder.' .
		'  I listan som du definerar alla möjliga parametrar för att aktivera sändning av ditt nyhetsbrev eller auto-respondrar: avsändarens namn, layout, prenumeranter\' välkomst meddelande, etc...
<br /><br />Du kan ställa in din första lista här: <a href="index2.php?option=com_acajoom&act=list" >skapa en lista</a> och klicka på Ny knappen.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom tillhandahåller dig med en enkel väg genom att importera all data från ett tidigare nyhetsbrevssystem.<br />' .
		' Gå till Uppdaterapanelen och välj ditt tidigare nyhetsbrevssystem att importera alla dina nyhetsbrev och prenumeranter.<br /><br />' .
		'<span style="color:#FF5E00;" >VIKTIGT: importeringen är riskfri och påverkar inte på något sett data från ditt tidigare nyhetsbrevssystem</span><br />' .
		'Efter importering så kommer du ha möjlighet att hantera dina prenumeranter och mailen direkt genom Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Kanon din första lista är inställd!  Du kan nu skriva din första %s.  För att skapa den gå till: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Auto-responder Hanterare');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Nyhetsbrevs Hanterare');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' och välj din %s. <br /> Sedan så väljer du din %s i drop down listan.  Skapa din första mail genom att klicka på Ny ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Innan du skickar ditt första nyhetsbrev så ska du kolla genom mail konfigurationen.  ' .
		'Gå till <a href="index2.php?option=com_acajoom&act=configuration" >konfigurations sidan</a> för att verifiera mail inställningarna. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />När du är klar gå tillbaka till Nyhetsbrevs menyn, välj din mail och klicka sedan på Skicka');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'För att dina auto-respondrar ska sändas så behöver du först ställa in en cron uppgift på din server. ' .
		' Referera till Cron tabben i konfigurationspanelen.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >klicka här</a> för att lära dig om hur man ställer in en cron uppgift. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Kolla även upp att du har publicerat Acajoom modulen så personer kan skriva in sig för prenumerationer.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Du kan nu också ställa in en auto-responder.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Du kan nu också ställa in ett nyhetsbrev.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Voila! Du är nu redo för att effektivt kommunicera med dina besökare och användare. Denna wizard kommer att avslutas när du har fixat din andra omgång med mail eller så kan du stänga av det i <a href="index2.php?option=com_acajoom&act=configuration" >konfigurationspanelen</a>.' .
		'<br /><br />  Om du har några frågor medans du använder Acajoom, refera till ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Du hittar även massor med information på hur du kommunicerar effektivt med dina prenumeranter på <a href="http://www.acajoom.com/" target="_blank">www.Acajoom.com</a>.' .
		'<p /><br /><b>Tack för att du använder Acajoom. Din Kommunikations Partner!</b> ');
define('_ACA_GUIDE_TURNOFF', 'Wizarden stängs nu av!');
define('_ACA_STEP', 'STEG ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom Konfiguration');
define('_ACA_INSTALL_SUCCESS', 'Installerades');
define('_ACA_INSTALL_ERROR', 'Installations Fel');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Acajoom Modul');
//Others
define('_ACA_JAVASCRIPT','!Varning! Javascript måste vara aktiverat för en fungerande operation.');
define('_ACA_EXPORT_TEXT','Prenumeranterna som exporterades baseras på listan som du angav. <br />Exportera prenumeranter för lista');
define('_ACA_IMPORT_TIPS','Importera prenumeranter. Informationen i filen behöver vara i följande format: <br />' .
		'Namn,e-post,mottaHTML(1/0),<span style="color: rgb(255, 0, 0);">bekräftad(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'är redan en prenumerant');
define('_ACA_GET_STARTED', 'Klicka här för att köra igång!');

//News since 1.0.1
define('_ACA_WARNING_1011','Varning: 1011: Uppdatera kommer inte att fungera på grund av dina server restrektioner.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Välj vilken e-postadress som ska visas som avsändare.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Välj vilket namn som ska visas som avsändare.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Välj vilken mail som du vill ska användas: PHP mail funktion, <span>Sendmail</span> eller SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Detta är mappen till Mailservern');
define('_ACA_LIST_T_TEMPLATE', 'Mall');
define('_ACA_NO_MAILING_ENTERED', 'Inget mailande tillhandahålls');
define('_ACA_NO_LIST_ENTERED', 'Ingen lista tillhandahålls');
define('_ACA_SENT_MAILING' , 'Skickade mail');
define('_ACA_SELECT_FILE', 'Välj en fil att ');
define('_ACA_LIST_IMPORT', 'Kolla lista(or) som du vill att prenumeranter ska associeras med.');
define('_ACA_PB_QUEUE', 'Prenumerant inlagd men problem att ansluta han/henne till lista(or). Kolla manuellt.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Uppdatering rekommenderas Mycket!');
define('_ACA_UPDATE_MESS2' , 'Patch och små åtgärder.');
define('_ACA_UPDATE_MESS3' , 'Ny utgåva.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 behövs för att kunna uppdatera.');
define('_ACA_UPDATE_IS_AVAIL' , ' fins tillgänglig!');
define('_ACA_NO_MAILING_SENT', 'Inga mail skickade!');
define('_ACA_SHOW_LOGIN', 'Visa logga in formulär');
define('_ACA_SHOW_LOGIN_TIPS', 'Välj Ja för att visa ett logga in formulär i förstaside Acajoom kontrollpanelen så att användare kan registrera sig på hemsidan.');
define('_ACA_LISTS_EDITOR', 'Listans Beskrivnings Redigerare');
define('_ACA_LISTS_EDITOR_TIPS', 'Välj Ja för att använda en HTML redigerare för att redigera listans beskrivningsfält.');
define('_ACA_SUBCRIBERS_VIEW', 'Visa prenumeranter');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Förstaside Inställningar' );
define('_ACA_SHOW_LOGOUT', 'Visa logga ut knapp');
define('_ACA_SHOW_LOGOUT_TIPS', 'Välj Ja för att visa en logga ut knapp På förstasidans Acajoom kontrollpanel.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integration');
define('_ACA_CB_INTEGRATION', 'Community Builder Integration');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom
Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin för Community Builder är ännu inte installerad!');
define('_ACA_CB_PLUGIN', 'Listor vid registrering');
define('_ACA_CB_PLUGIN_TIPS', 'Välj Ja för att visa maillistor i community builders registrerings formulär');
define('_ACA_CB_LISTS', 'List ID:er');
define('_ACA_CB_LISTS_TIPS', 'DETTA ÄR ETT OBLIGATORISKT FÄLT. Skriv in id nummer på listor som du vill att användare ska ha tillåtelse att prenumerera på separera med kommatecken,  (0 visa alla listor)');
define('_ACA_CB_INTRO', 'Introduktionstext');
define('_ACA_CB_INTRO_TIPS', 'En text som visas kommer att visas före listorna. LÄMNA TOMT FÖR ATT INTE VISA NÅGONTING. Använd cb_förtext för CSS layout.');
define('_ACA_CB_SHOW_NAME', 'Visa Listnamn');
define('_ACA_CB_SHOW_NAME_TIPS', 'Välj om namnet på listan ska visas efter introduktionen.');
define('_ACA_CB_LIST_DEFAULT', 'Kolla lista som standard');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Välj om du vill att kryssrutan för varje lista ska kollas som standard.');
define('_ACA_CB_HTML_SHOW', 'Visa Mottag HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Ställ in till Ja för att tillåta användare att besluta om dom ska ha HTML e-post eller inte. Ställ in till Nej för att använda mottag html som standard.');
define('_ACA_CB_HTML_DEFAULT', 'Standard Mottag HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Ställ in detta alternativ för att visa standard html mail konfiguration. Om Visa Mottag HTML är inställt till Nej så kommer detta val att vara standard.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Kunde inte göra en backup på filen! Filen ersattes inte.');
define('_ACA_BACKUP_YOUR_FILES', 'De äldre versionsfilerna har backats upp till följande mapp:');
define('_ACA_SERVER_LOCAL_TIME', 'Server lokaltid');
define('_ACA_SHOW_ARCHIVE', 'Visa arkivknapp');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Välj Ja för att visa arkivknappen på förstasidan i Nyhetsbrevslistan');
define('_ACA_LIST_OPT_TAG', 'Taggar');
define('_ACA_LIST_OPT_IMG', 'Bilder');
define('_ACA_LIST_OPT_CTT', 'Innehåll');
define('_ACA_INPUT_NAME_TIPS', 'Fyll i ditt fullständiga namn (förnamnet först)');
define('_ACA_INPUT_EMAIL_TIPS', 'Fyll i din e-postadress (Var noga med att detta är en giltig e-postadress om du vill mottaga våra nyhetsbrev.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Välj Ja om du vill mottaga HTML mail - Nej för att mottaga endast Text mail');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Specificera din tidszon.');

// Since 1.0.5
define('_ACA_FILES' , 'Filer');
define('_ACA_FILES_UPLOAD' , 'Ladda Upp');
define('_ACA_MENU_UPLOAD_IMG' , 'Ladda Upp Bilder');
define('_ACA_TOO_LARGE' , 'Filstorleken är för stor. Den tillåtna maximala storleken är');
define('_ACA_MISSING_DIR' , 'Destinations mappen existerar inte');
define('_ACA_IS_NOT_DIR' , 'Destinations mappen existerar inte eller är inte en ordinär fil.');
define('_ACA_NO_WRITE_PERMS' , 'Destinations mappen är skrivskyddad.');
define('_ACA_NO_USER_FILE' , 'Du har inte valt en fil att ladda upp.');
define('_ACA_E_FAIL_MOVE' , 'Omöjligt att flytta filen.');
define('_ACA_FILE_EXISTS' , 'Destinationsfilen finns redan.');
define('_ACA_CANNOT_OVERWRITE' , 'Destinationsfilen finns redan och kan därför inte skrivas över.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Filändelsen är inte tillåten.');
define('_ACA_PARTIAL' , 'Filen laddades delvis bara upp.');
define('_ACA_UPLOAD_ERROR' , 'Uppladdningsfel:');
define('DEV_NO_DEF_FILE' , 'Filen laddades delvis bara upp.');

define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Detta kommer att ersättas med prenumerationslänkar.' .
		'Detta är <strong>nödvändigt</strong> för att Acajoom ska fungera korrekt.<br />' .
		'Om du placerar annat innehåll i denna ruta så kommer det att visas i alla mail som hänvisas till denna lista.' .
		' <br />Lägg till ditt prenumerations meddelande i slutet.  Acajoom kommer automatiskt att lägga till en länk för prenumeranten att ändra sin information och en länk för att sluta prenumera från listan.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Meddelande');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Meddelanden');
define('_ACA_USE_SEF', 'SEF i mail');
define('_ACA_USE_SEF_TIPS', 'Det är rekommenderat att du väljer Nej.  Men om du vill att URL,en ska inkluderas i din mail för att använda SEF välj då Ja.' .
		' <br /><b>Länkarna fungerar på samma sett oavsett val.  Nej kommer att försäkra dig att länkarna i mailen kommer alltid att fungera även om du ändrar din SEF.</b> ');
define('_ACA_ERR_NB' , 'Fel #: ERR');
define('_ACA_ERR_SETTINGS', 'Felhanterings inställningar');
define('_ACA_ERR_SEND' ,'Skicka felrapport');
define('_ACA_ERR_SEND_TIPS' ,'Om du vill att Acajoom ska bli en bättre produkt välj JA.  Detta kommer att sända oss en felrapport.  Så du behöver inte själv rapportera buggar längre ;-) <br /> <b>INGEN PRIVAT INFORMATION KOMMER ATT SKICKAS</b>.  Vi vet inte ens från vilken hemsida felet kommer ifrån. Vi skickar endast information om Acajoom, PHP inställningarna och SQL frågor. ');
define('_ACA_ERR_SHOW_TIPS' ,'Välj Ja för att visa felnummer på skärmen.  Används oftast för att avbuggnings syfte. ');
define('_ACA_ERR_SHOW' ,'Visa fel');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Visa prenumerera Inte länkar');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Välj Ja för att visa prenumerera Inte länkar i botten av mailen för användare för möjligheten att ändra sina prenumerationer. <br /> Nej avaktivera footer och länkar.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">VIKTIGT MEDDELANDE!</span> <br />Om du uppgraderar från en tidigare version av Acajoom installation så behöver du även uppgradera din databas struktur genom att klicka på följande knapp (Din data kommer fortfarande att vara fullständig)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Uppgradera tabeller och konfiguration');
define('_ACA_MAILING_MAX_TIME', 'Max kötid' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Definera den maximala tiden för varje mailutskick skickad av kön. Rekommenderat mellan 30 s och 2 min.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart Integrering');
define('_ACA_VM_COUPON_NOTIF', 'Kupong meddelande ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Specificera ID numret av mail som du vill använda för att skicka kuponger till dina köpare.');
define('_ACA_VM_NEW_PRODUCT', 'Ny produkt meddelande ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Specificera ID numret av mail som du vill använda för att skicka ny produkt meddelande.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Skapa formulär');
define('_ACA_FORM_COPY', 'HTML kod');
define('_ACA_FORM_COPY_TIPS', 'Kopiera den generade HTML koden till din HTML sida.');
define('_ACA_FORM_LIST_TIPS', 'Välj listan som du vill inkludera i formläret');
// update messages
define('_ACA_UPDATE_MESS4' , 'Det kan inte uppdateras automatiskt.');
define('_ACA_WARNG_REMOTE_FILE' , 'Ingen möjlighet att komma åt den fjärranvända filen.');
define('_ACA_ERROR_FETCH' , 'Fel vid hämtning av fil.');

define('_ACA_CHECK' , 'Kolla');
define('_ACA_MORE_INFO' , 'Mer info');
define('_ACA_UPDATE_NEW' , 'Uppdatera till en nyare version');
define('_ACA_UPGRADE' , 'Uppgradera till en högre produkt');
define('_ACA_DOWNDATE' , 'Återgå till föregående version');
define('_ACA_DOWNGRADE' , 'Tillbaka till standard produkten');
define('_ACA_REQUIRE_JOOM' , 'Behöver Joomla');
define('_ACA_TRY_IT' , 'Prova på!');
define('_ACA_NEWER', 'Nyare');
define('_ACA_OLDER', 'Äldre');
define('_ACA_CURRENT', 'Nuvarande');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Prova någon annan komponent');
define('_ACA_MENU_VIDEO' , 'Video undervisning');
define('_ACA_AUTO_SCHEDULE', 'Schema');
define('_ACA_SCHEDULE_TITLE', 'Automatiska schemafunktions inställningar');
define('_ACA_ISSUE_NB_TIPS' , 'Utfärdar nummer generades automatiskt av systemet' );
define('_ACA_SEL_ALL' , 'Alla mail');
define('_ACA_SEL_ALL_SUB' , 'Alla listor');
define('_ACA_INTRO_ONLY_TIPS' , 'Om du markerar denna ruta så kommer endast introduktionen av artikeln att sättas in i mailet med en läs mer länk för att se hela artikeln på din sida.' );
define('_ACA_TAGS_TITLE' , 'Innehålls tagg');
define('_ACA_TAGS_TITLE_TIPS' , 'Kopiera och klistra denna tagg i ditt mail där du vill ha innehållet placerat.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Markera emailadressen att skicka testet till');
define('_ACA_PREVIEW_TITLE' , 'Förhandsgranska');
define('_ACA_AUTO_UPDATE' , 'Nytt uppdaterings meddelande');
define('_ACA_AUTO_UPDATE_TIPS' , 'Välj Ja om du vill bli meddelad vid nya uppdateringar för din komponent. <br />VIKTIGT!! Visa tips behöver vara på för att denna funktion ska fungera.');

// since 1.1.0
define('_ACA_LICENSE' , 'Licens Information');


// since 1.1.1
define('_ACA_NEW' , 'Ny');
define('_ACA_SCHEDULE_SETUP', 'För att autorespondrarna ska skickas så behöver du ställa in schemat i konfigurationen.');
define('_ACA_SCHEDULER', 'Schema');
define('_ACA_ACAJOOM_CRON_DESC' , 'om du inte har tillgång till cron hanteraren på din hemsida, så kan du registrera dig för ett fritt Acajoom Cron konto hos:' );
define('_ACA_CRON_DOCUMENTATION' , 'Du kan hitta ytterliggare information om att ställa in Acajoom Schemat vid följande url:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Kö behandling lyckades...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Fel vid flytt av importerad fil' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Schema frekvens' );
define( '_ACA_CRON_MAX_FREQ' , 'Schemats maximala frekvens' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Specificera den maximala frekvensen som schemat kan köra ( i minuter ).  Detta kommer att begränsa schemat även om cron hanteraren är uppsatt mer frekvent.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Maximala antalet mail per uppgift' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Specificera det maximala antalet mail sända per uppgift (0 obegränsat).' );
define( '_ACA_CRON_MINUTES' , ' minuter' );
define( '_ACA_SHOW_SIGNATURE' , 'Visa mailfooter' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Oavsett om du vill eller inte vill promota Acajoom i footern av dina mail.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Auto-responder behandling lyckades...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Schemalagd nyhetsbrevsbehandling lyckades...' );
define( '_ACA_MENU_SYNC_USERS' , 'Synkronisera Användare' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Användar Synkroniseringen Lyckades!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logga Ut' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Ja' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Nej' );
if (!defined('_HI')) define( '_HI', 'Hej' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Topp' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Botten' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Om du väljer detta så kommer endast titeln i artikeln att sättas in i mailet som en länk till den kompletta artikeln på din sida.');
define('_ACA_TITLE_ONLY' , 'Endast Titel');
define('_ACA_FULL_ARTICLE_TIPS' , 'Om du väljer detta så kommer hela artiklen att sättas in i mailet');
define('_ACA_FULL_ARTICLE' , 'Hel Artikel');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Välj ett innehållsobjekt att visas i meddelandet. <br />Kopiera och klistra <b>innehålls taggen</b> i mailet.  Du kan välja att ha hela texten, endast intro, eller endast titel med (0, 1, eller 2 var för sig). ');
define('_ACA_SUBSCRIBE_LIST2', 'Mail lista(or)');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Smart-Nyhetsbrev');
define('_ACA_MENU_AUTONEWS', 'Smart-Nyhetsbrev');
define('_ACA_AUTO_NEWS_OPTION', 'Smart-Nyhetsbrevs val');
define('_ACA_AUTONEWS_FREQ', 'Nyhetsbrevs Frekvens');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Specificera frekvensen som du vill skicka smart-nyhetsbrevet.');
define('_ACA_AUTONEWS_SECTION', 'Artikel Sektion');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Specificera sektionen som du vill välja artiklar ifrån.');
define('_ACA_AUTONEWS_CAT', 'Artikel Kategori');
define('_ACA_AUTONEWS_CAT_TIPS', 'Specificera kategorin som du vill välja artiklar ifrån (Alla för alla artiklar i den sektionen).');
define('_ACA_SELECT_SECTION', 'Välj en sektion');
define('_ACA_SELECT_CAT', 'Alla Kategorier');
define('_ACA_AUTO_DAY_CH8', 'Kvartalsvis');
define('_ACA_AUTONEWS_STARTDATE', 'Start datum');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Specificera datumet som du vill starta sändning av Smart Nyhetsbrev.');
define('_ACA_AUTONEWS_TYPE', 'Innehålls återgivning');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Hel Artikel: kommer att inkludera hela artikeln i nyhetsbrevet.<br />' .
		'Endast Intro: kommer endast att inkludera introduktionen av artikeln i nyhetsbrevet.<br/>' .
		'Endast Titel: kommer endast att inkludera titeln på artikeln i nyhetsbrevet.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNYHETSBREV] = Detta kommer att ersättas med Smart-nyhetsbrevet.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Skapa / Visa Mail');
define('_ACA_LICENSE_CONFIG' , 'Licens' );
define('_ACA_ENTER_LICENSE' , 'Fyll i licens');
define('_ACA_ENTER_LICENSE_TIPS' , 'Fyll i ditt licensnummer och tryck på spara.');
define('_ACA_LICENSE_SETTING' , 'Licensinställningar' );
define('_ACA_GOOD_LIC' , 'Din licens är giltig.' );
define('_ACA_NOTSO_GOOD_LIC' , 'Din licens är inte giltig: ' );
define('_ACA_PLEASE_LIC' , 'Kontakta Acajoom support för att uppgradera din licens ( license@acajoom.com ).' );

define('_ACA_DESC_PLUS', 'Acajoom Plus är den första auto-responder sekvensen för Joomla CMS.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO är det ultimata mailsystemet för Joomla CMS.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , 'Fyll i bevis');
define('_ACA_ENTER_TOKEN_TIPS' , 'Var vänlig och fyll i ditt bevisnummer som du mottog via mail när du köpte Acajoom. ');
define('_ACA_ACAJOOM_SITE', 'Acajoom sidan:');
define('_ACA_MY_SITE', 'Min sida:');
define( '_ACA_LICENSE_FORM' , ' ' .
 		'Klicka här för att fortsätta till licensformuläret.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Töm licensfältet och prova på nytt igen.<br />  Om problemet kvarstår, ' );
define( '_ACA_LICENSE_SUPPORT' , 'Om du fortfarande har frågor, ' . _ACA_PLEASE_LIC );
define( '_ACA_LICENSE_TWO' , 'du kan få din licensmanual genom att fylla i bevisnumret och sidans URL (som är belyst i grönt i toppen av denna sida) i Licensformuläret. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );
define('_ACA_ENTER_TOKEN_PATIENCE', 'Efter att du sparat ditt bevis så kommer en licens att automatiskt genereras. ' .
		' Vanligtvis så är blir beviset validerat inom 2 minuter.  Men, i vissa fall så kan det ta upp till 15 minuter.<br />' .
		'<br />Återkom till denna kontrollpanel om ett par minuter.  <br /><br />' .
		'Om du inte mottagit en giltig licensnyckel inom 15 minuter, '. _ACA_LICENSE_TWO);
define( '_ACA_ENTER_NOT_YET' , 'Ditt bevis har ännu inte blivit validerat.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Besök <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> för att ladda ner den senaste versionen.');
define( '_ACA_NOTIF_UPDATE' , 'För att bli meddelad om nya uppdateringar skriv in din emailadress och klicka på prenumerera ');

define('_ACA_THINK_PLUS', 'Om du vill få ut mer av mailsystemet tänk då på Plus!');
define('_ACA_THINK_PLUS_1', 'Auto-responder Sekvens');
define('_ACA_THINK_PLUS_2', 'Schemalägg leveransen av ditt nyhetsbrev med ett fördefinerat datum');
define('_ACA_THINK_PLUS_3', 'Ingen mer serverbegränsning');
define('_ACA_THINK_PLUS_4', 'och mycket mer...');


//since 1.2.2
define( '_ACA_LIST_ACCESS', 'List Åtkomst' );
define( '_ACA_INFO_LIST_ACCESS', 'Specificera vilken grupp av användare som kan se och prenumerera på denna lista' );
define( 'ACA_NO_LIST_PERM', 'Du har inte tillräcklig behörighet för att prenumerera på denna lista' );

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', 'Arkivera');
 define('_ACA_MENU_ARCHIVE_ALL', 'Arkivera Alla');

//Archive Lists
 define('_FREQ_OPT_0', 'Inga');
 define('_FREQ_OPT_1', 'Varje Vecka');
 define('_FREQ_OPT_2', 'Varannan Vecka');
 define('_FREQ_OPT_3', 'Varje Månad');
 define('_FREQ_OPT_4', 'Varje Kvartal');
 define('_FREQ_OPT_5', 'Varje År');
 define('_FREQ_OPT_6', 'Annat');

define('_DATE_OPT_1', 'Skapar datum');
define('_DATE_OPT_2', 'Ändrings datum');

define('_ACA_ARCHIVE_TITLE', 'Ställer in auto-arkiv frekvensen');
define('_ACA_FREQ_TITLE', 'Arkiv frekvens');
define('_ACA_FREQ_TOOL', 'Definera hur ofta som du vill att Arkiv Hanteraren ska arkivera din hemsidas innehåll.');
define('_ACA_NB_DAYS', 'Antal dagar');
define('_ACA_NB_DAYS_TOOL', 'Detta är endast för Annat alternativet! Specificera antalet dagar mellan varje arkivering.');
define('_ACA_DATE_TITLE', 'Datumtyp');
define('_ACA_DATE_TOOL', 'Definera om arkiveringen ska ske vis skapardatumet eller vid ändringsdatumet.');

define('_ACA_MAINTENANCE_TAB', 'Underhållsinställningar');
define('_ACA_MAINTENANCE_FREQ', 'Underhållsfrekvens');
define( '_ACA_MAINTENANCE_FREQ_TIPS', 'Specificera frekvensen som du vill att underhållsrutinen ska köras.' );
define( '_ACA_CRON_DAYS' , 'timme(ar)' );

define( '_ACA_LIST_NOT_AVAIL', 'Det finns ingen lista tillgänglig.');
define( '_ACA_LIST_ADD_TAB', 'Skapa/Redigera' );

define( '_ACA_LIST_ACCESS_EDIT', 'Mail Skapa/Redigera Åtkomst' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', 'Specificera vilken grupp av användare som kan redigera nya mail för denna lista' );
define( '_ACA_MAILING_NEW_FRONT', 'Skapa en Ny Mail' );

define('_ACA_AUTO_ARCHIVE', 'Auto-Arkiv');
define('_ACA_MENU_ARCHIVE', 'Auto-Arkiv');

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', '[ISSUENB] = Detta kommer att ersättas av utgåvonumret på nyhetsbrevet.');
define('_ACA_TAGS_DATE', '[DATE] = Detta kommer att ersättas av sändningsdatum.');
define('_ACA_TAGS_CB', '[CBTAG:{field_name}] = Detta kommer att ersättas av värdet som kommer från Community Builder fältet: ex. [CBTAG:firstname] ');
define( '_ACA_MAINTENANCE', 'Underhåll' );


define('_ACA_THINK_PRO', 'När du har professionella önskemål, så använder du professionella komponenter!');
define('_ACA_THINK_PRO_1', 'Smart-Nyhetsbrev');
define('_ACA_THINK_PRO_2', 'Definera åtkomstnivå för din lista');
define('_ACA_THINK_PRO_3', 'Definera vem som kan redigera/skapa mail');
define('_ACA_THINK_PRO_4', 'Mera taggar: skapa ditt CB fält');
define('_ACA_THINK_PRO_5', 'Joomla innehålls Auto-arkiv');
define('_ACA_THINK_PRO_6', 'Databasoptimering');

define('_ACA_LIC_NOT_YET', 'Din licens är ännu inte giltig.  Var vänlig och undersök licensfliken i konfigurationspanelen.');
define('_ACA_PLEASE_LIC_GREEN' , 'Var noga med att ange den gröna informationen vid toppen av fliken till vårat supportteam.' );

define('_ACA_FOLLOW_LINK' , 'Skaffa Din Licens');
define( '_ACA_FOLLOW_LINK_TWO' , 'Du kan få din licens genom att fylla i bevisnumret och sidans URL (som belyses med grönt i toppen på denna sida) i Licensformuläret. ');
define( '_ACA_ENTER_TOKEN_TIPS2', ' Klicka sedan på Lägg till knappen i den övre högra menyn.' );
define( '_ACA_ENTER_LIC_NB', 'Fyll i Din Licens' );
define( '_ACA_UPGRADE_LICENSE', 'Uppgradera Din Licens');
define( '_ACA_UPGRADE_LICENSE_TIPS' , 'Om du mottagit ett bevis för uppgradering av din licens var då vänlig och fyll i den här, klicka på Lägg till och fortsätt till nummer <b>2</b> för att få ditt nya licensnummer.' );

define( '_ACA_MAIL_FORMAT', 'Kodformat' );
define( '_ACA_MAIL_FORMAT_TIPS', 'Vilket format vill du använda för att koda dina mail, Endast text eller MIME' );
define( '_ACA_ACAJOOM_CRON_DESC_ALT', 'Om du inte har tillgång till en cronjobbs hanteraren på din hemsida, så kan du använda den Fria jCron komponenten för att skapa ett cron jobb från din hemsida.' );

//since 1.3.1
define('_ACA_SHOW_AUTHOR', 'Show Author\'s Name');
define('_ACA_SHOW_AUTHOR_TIPS', 'Select Yes if you want to add the name of the author when you add an article in the Mailing');

//since 1.3.5
define('_ACA_REGWARN_NAME','Ange ditt namn.');
define('_ACA_REGWARN_MAIL','Ange en giltig e-postadress.');

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
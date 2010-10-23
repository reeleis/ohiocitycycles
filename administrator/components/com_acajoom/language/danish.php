<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>Danish language file.</p>
* @copyright (c) 2006 Acajoom Services / All Rights Reserved
* @author Joergen Floes<support@acajoom.com>
* @version $Id: danish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom er forsendelseslister, nyhedsbreve, auto-svar funktion, og opfølgningsværktøj til effektiv kommunikation med dine brugere og kunder.  ' .
		'Acajoom, Din kommunikationspartner!');
define('_ACA_FEATURES', 'Acajoom, din kommunikationspartner!');

// Type of lists
define('_ACA_NEWSLETTER', 'Nyhedsbrev');
define('_ACA_AUTORESP', 'Auto-svar');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eKort');
define('_ACA_POSTCARD', 'Postkort');
define('_ACA_PERF', 'Performance');
define('_ACA_COUPON', 'Kupon');
define('_ACA_CRON', 'Cron opgave');
define('_ACA_MAILING', 'Forsendelse');
define('_ACA_LIST', 'Liste');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Administration af lister');
define('_ACA_MENU_SUBSCRIBERS', 'Abonnenter');
define('_ACA_MENU_NEWSLETTERS', 'Nyhedsbreve');
define('_ACA_MENU_AUTOS', 'Auto-svar');
define('_ACA_MENU_COUPONS', 'Kuponer');
define('_ACA_MENU_CRONS', 'Cron opgaver');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eKort');
define('_ACA_MENU_POSTCARDS', 'Postkort');
define('_ACA_MENU_PERFS', 'Performances');
define('_ACA_MENU_TAB_LIST', 'Lister');
define('_ACA_MENU_MAILING_TITLE', 'Forsendelser');
define('_ACA_MENU_MAILING' , 'Forsendelse af ');
define('_ACA_MENU_STATS', 'Statistik');
define('_ACA_MENU_STATS_FOR', 'Statistik for ');
define('_ACA_MENU_CONF', 'Konfiguration');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Om');
define('_ACA_MENU_LEARN', 'Uddannelsescenter');
define('_ACA_MENU_MEDIA', 'Media administration');
define('_ACA_MENU_HELP', 'Hjælp');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Import');
define('_ACA_MENU_EXPORT', 'Export');
define('_ACA_MENU_SUB_ALL', 'Abonner på alle');
define('_ACA_MENU_UNSUB_ALL', 'Afmeld alle');
define('_ACA_MENU_VIEW_ARCHIVE', 'Arkiv');
define('_ACA_MENU_PREVIEW', 'Preview');
define('_ACA_MENU_SEND', 'Send');
define('_ACA_MENU_SEND_TEST', 'Send Test Email');
define('_ACA_MENU_SEND_QUEUE', 'Process kø');
define('_ACA_MENU_VIEW', 'Se');
define('_ACA_MENU_COPY', 'Kopier');
define('_ACA_MENU_VIEW_STATS' , 'Se statistik');
define('_ACA_MENU_CRTL_PANEL' , ' CPanel');
define('_ACA_MENU_LIST_NEW' , ' Opret en liste');
define('_ACA_MENU_LIST_EDIT' , ' Ret en liste');
define('_ACA_MENU_BACK', 'Tilbage');
define('_ACA_MENU_INSTALL', 'Installation');
define('_ACA_MENU_TAB_SUM', 'Opsummering');
define('_ACA_STATUS' , 'Status');

// messages
define('_ACA_ERROR' , ' Der opstod en fejl! ');
define('_ACA_SUB_ACCESS' , 'Adgangsrettigheder');
define('_ACA_DESC_CREDITS', 'Credits');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Hjemmeside');
define('_ACA_DESC_MAILING', 'Forsendelsesliste');
define('_ACA_DESC_SUBSCRIBERS', 'Modtagere');
define('_ACA_PUBLISHED','Udgivet');
define('_ACA_UNPUBLISHED','U-udgivet');
define('_ACA_DELETE','Slet');
define('_ACA_FILTER','Filtrer');
define('_ACA_UPDATE','Opdater');
define('_ACA_SAVE','Gem');
define('_ACA_CANCEL','Slet');
define('_ACA_NAME','Navn');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Vælg');
define('_ACA_ALL','alle');
define('_ACA_SEND_A', 'Send en ');
define('_ACA_SUCCESS_DELETED', ' succesfuldt slettet');
define('_ACA_LIST_ADDED', 'Liste succesfuldt oprettet');
define('_ACA_LIST_COPY', 'Liste succesfuldt kopieret');
define('_ACA_LIST_UPDATED', 'List succesfuldt opdateret');
define('_ACA_MAILING_SAVED', 'Forsendelse succesfuldt gemt.');
define('_ACA_UPDATED_SUCCESSFULLY', 'succesfuldt opdateret.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Abonnentens information');
define('_ACA_VERIFY_INFO', 'Verificer det link du angav, der mangler noget information.');
define('_ACA_INPUT_NAME', 'Navn');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Modtag HTML?');
define('_ACA_TIME_ZONE', 'Tidszone');
define('_ACA_BLACK_LIST', 'Spær bruger');
define('_ACA_REGISTRATION_DATE', 'Bruger registreringsdato');
define('_ACA_USER_ID', 'Bruger id');
define('_ACA_DESCRIPTION', 'Beskrivelse');
define('_ACA_ACCOUNT_CONFIRMED', 'Din konto er blevet aktiveret.');
define('_ACA_SUB_SUBSCRIBER', 'Abonnent');
define('_ACA_SUB_PUBLISHER', 'Udgiver');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registreret');
define('_ACA_SUBSCRIPTIONS', 'Dit abonnement');
define('_ACA_SEND_UNSUBCRIBE', 'Send afmeldingsmeddelelse');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Klik Ja for at sende en afmeld email meddelelse.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Venligst bekræft dit abonnement');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Afmeldingsbekræftigelse');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hej [NAME],<br />' .
		'Bare et trin mere og du vil blive abonnent af listen.  Venligst klik på det følgende likn for at bekræftige dine abonnementer.' .
		'<br /><br />[CONFIRM]<br /><br />Hvis der er spørgsmål så kontakt webmasteren.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Denne email bekræftiger at du er blevet afmeldt fra vores liste.  Vi beklager at du besluttede at afmelde men skulle du beslutte at gentilmelde kan du altid gøre det på vore webside.  Skulle du have nogen spørgsmål da kontakt venligst vores webmaster.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Tilmeldingsdato');
define('_ACA_CONFIRMED', 'Bekræfted');
define('_ACA_SUBSCRIB', 'Abonner');
define('_ACA_HTML', 'HTML udsendelser');
define('_ACA_RESULTS', 'Resultater');
define('_ACA_SEL_LIST', 'Vælg en liste');
define('_ACA_SEL_LIST_TYPE', '- Vælg typen af listen -');
define('_ACA_SUSCRIB_LIST', 'Liste over alle abonnenter');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'abonnenter af : ');
define('_ACA_NO_SUSCRIBERS', 'Ingen abonnenter fundet til denne liste.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'En bekræftigelses email er blevet sendt til dig.  Venligst check din email og klik på det angivne link.<br />' .
		'Du skal bekræfte din email for at dit abonnement træder i kraft.');
define('_ACA_SUCCESS_ADD_LIST', 'Du er succesfuldt blevet tilføjet til listen.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Klik her for at bekræfte dit abonnement');
define('_ACA_UNSUBSCRIBE_LINK', 'Klik her for at afmelde dig selv fra listen');
define('_ACA_UNSUBSCRIBE_MESS', 'Din email adresse er blevet afmeldt fra listen');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Alle planlagte forsendelser er blevet succesfuldt udsendt.');
define('_ACA_MALING_VIEW', 'Se alle forsendelser');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Er du sikker på at du vil afmeldes fra denne liste?');
define('_ACA_MOD_SUBSCRIBE', 'Abonner');
define('_ACA_SUBSCRIBE', 'Abonner');
define('_ACA_UNSUBSCRIBE', 'Afmeld');
define('_ACA_VIEW_ARCHIVE', 'Se arkivet');
define('_ACA_SUBSCRIPTION_OR', ' eller klik her for at opdatere dine informationer');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Denne email adresse er allerede blevet registreret.');
define('_ACA_SUBSCRIBER_DELETED', 'Abonnent succesfuldt slettet.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Bruger kontrolpanel');
define('_UCP_USER_MENU', 'Bruger menu');
define('_UCP_USER_CONTACT', 'Mine abonnementer');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Cron opgave administration');
define('_UCP_CRON_NEW_MENU', 'Ny Cron');
define('_UCP_CRON_LIST_MENU', 'List mine Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Kupon administration');
define('_UCP_COUPON_LIST_MENU', 'Liste over kuponner');
define('_UCP_COUPON_ADD_MENU', 'Tilføj en kupon');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Beskrivelse');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Abonnement');
define('_ACA_LIST_T_SENDER', 'Afsender information');

define('_ACA_LIST_TYPE', 'Liste type');
define('_ACA_LIST_NAME', 'Liste navn');
define('_ACA_LIST_ISSUE', 'Hændelse #');
define('_ACA_LIST_DATE', 'Sendt dato');
define('_ACA_LIST_SUB', 'Forsendelsens emne');
define('_ACA_ATTACHED_FILES', 'Vedhæftede filer');
define('_ACA_SELECT_LIST', 'Vælg en liste der skal rettes!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Typen af listen');
define('_ACA_AUTO_RESP_OPTION', 'Auto-svar muligheder');
define('_ACA_AUTO_RESP_FREQ', 'Abonnenterne kan vælge frekvensen');
define('_ACA_AUTO_DELAY', 'Forsinkelse (i dage)');
define('_ACA_AUTO_DAY_MIN', 'Minimum frekvens');
define('_ACA_AUTO_DAY_MAX', 'Maximum frekvens');
define('_ACA_FOLLOW_UP', 'Angiv opfølgende auto-svar');
define('_ACA_AUTO_RESP_TIME', 'Abonnenter kan bestemme tidspunkt');
define('_ACA_LIST_SENDER', 'Liste afsendere');

define('_ACA_LIST_DESC', 'Liste beskrivelser');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Afsender navn');
define('_ACA_SENDER_EMAIL', 'Afsender email');
define('_ACA_SENDER_BOUNCE', 'Afsenderens svar adresse');
define('_ACA_LIST_DELAY', 'Forsinkelse');
define('_ACA_HTML_MAILING', 'HTML forsendelse?');
define('_ACA_HTML_MAILING_DESC', '(hvis du ændrer dette, skal du gemme og komme tilbage til dette skærmbillede for at se ændringerne.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Skjul fra front-end?');
define('_ACA_SELECT_IMPORT_FILE', 'Vælg en fil der skal importeres');;
define('_ACA_IMPORT_FINISHED', 'Import afsluttet');
define('_ACA_DELETION_OFFILE', 'Sletning af fil');
define('_ACA_MANUALLY_DELETE', 'fejlede, du skal slette filen manuelt');
define('_ACA_CANNOT_WRITE_DIR', 'Kan ikke skrive i biblioteket');
define('_ACA_NOT_PUBLISHED', 'Kunne ikke sende forsendelsen, listen er ikke udgivet.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Klik Ja for at udgive listen');
define('_ACA_INFO_LIST_NAME', 'Skriv navnet på din liste her. Du kan identificere listen med dette navn.');
define('_ACA_INFO_LIST_DESC', 'Indtast en kort beskrivelse af din liste her. Denne beskrivelse vil være synlig for gæster på din webside.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Indtast navnet på afsenderen af brevet. Dette navn vil være synligt når abonnenterne modtager meddelelser fra denne liste.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Skriv den email adresse som meddelelsen skal sendes fra.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Skriv den email adresse hvor bruger kan svare til. Det anbefales at det er den samme som afsenderen af emailen, da spam filtere vil give din meddelelse en højere spam ranking hvis de er forskellige.');
define('_ACA_INFO_LIST_AUTORESP', 'Vælg typen af forsendelser på denne liste. <br />' .
		'Nyhedsbrev: normalt nyhedsbrev<br />' .
		'Auto-svar: en auto-svar er en liste som sendes automatisk gennnem websiden på en fast interval.');
define('_ACA_INFO_LIST_FREQUENCY', 'Tillad brugerne at vælge hvor ofte de vil modtage fra listen.  Det giver mere fleksibilitet for brugeren.');
define('_ACA_INFO_LIST_TIME', 'Lad brugeren vælge deres foretrukne tid på dagen for at modtage denne liste.');
define('_ACA_INFO_LIST_MIN_DAY', 'Definer hvad der er den mindste frekvens en bruger kan vælge at modtage fra listen');
define('_ACA_INFO_LIST_DELAY', 'Angiv en forsinkelse mellem denne auto-svar og den forrige.');
define('_ACA_INFO_LIST_DATE', 'Angiv datoen hvor nyhedslisten skal udgives, hvis du vil forsinke udgivelsen. <br /> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Definer hvad der er den maksimale frekvens en bruger kan vælge at modtage fra listen');
define('_ACA_INFO_LIST_LAYOUT', 'Angiv layout for din forsendelseliste her. Du kan angive et hvilket som helst layout for din forsendelse her.');
define('_ACA_INFO_LIST_SUB_MESS', 'Denne meddelelse vil blive sendt til abonnenten når han eller hun registreres første gang. Du kan skrive lige den tekst du vil have her.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Denne meddelelse vil blive sendt til abonnenten når han eller hun afmelder. En hvilken som helst tekst kan indtastes her.');
define('_ACA_INFO_LIST_HTML', 'Vælg afkrydsningsboxen hvis du ønsker at sende en HTML udsendelse. Abonnenter vil have mulighed for at angive hvis de ønsker at modtage HTML meddelelsen HTML, eller kun tekst meddelelsen når de abonnerer på en HTML liste.');
define('_ACA_INFO_LIST_HIDDEN', 'Klik Ja for at skjule listen fra front-end, brugerne vil ikke have mulighed for at abonnere men du vil stadig have mulighed for at sende udsendelsen.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Vil du have at brugerne automatisk tilmeldes til denne liste?<br /><B>Nye brugere:</B> vil registrere alle nye brugere der registrer sig på websiden.<br /><B>Alle brugere:</B> vil registre alle brugere der er registreret i databasen.<br />(alle disse funktioner understøtter Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Vælg front-end adgangsniveauet. Dette vil vise elle skjule udsendelsen for brugergrupper der ikke har adgang til den, så de ikke har mulighed for at abonnere på den.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Vælg adgangsniveauet for den brugergruppe du ønsker skal kunne rette. Denne brugegruppe og overliggende vil kunne rette forsendelserne og sende dem ud, enten fra front-end eller back-end.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Hvis du ønsker at auto-svaret skal flytte til en anden når den når til den sidste meddelelse kan du angive den efterfølgnede auto-svar her.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Dette er ID\'et for den person som oprettede listen.');
define('_ACA_INFO_LIST_WARNING', '   Denne sidste mulighed er kun tilgængelig en gang når listen oprettes.');
define('_ACA_INFO_LIST_SUBJET', ' Emnet for brevet.  Dette er emnet på den email som abonnenten vil modtage.');
define('_ACA_INFO_MAILING_CONTENT', 'Det er hoveddelen af den email du ønsker at sende.');
define('_ACA_INFO_MAILING_NOHTML', 'Indtast hoveddelen af den email du ønsker at sende til abonnenter der vælger kun at modtage ikke-HTML forsendelser. <BR/> NOTE: hvis du lader den være blank vil Acajoom automatisk konvertere HTML teksten til ren tekst.');
define('_ACA_INFO_MAILING_VISIBLE', 'Klik Ja for at vise forsendelsen i front-end.');
define('_ACA_INSERT_CONTENT', 'Indsæt eksisterende indhold');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Kupon sendt succesfuldt!');
define('_ACA_CHOOSE_COUPON', 'Vælg en kupon');
define('_ACA_TO_USER', ' til denne bruger');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Hver time');
define('_ACA_FREQ_CH2', 'Hver 6 time');
define('_ACA_FREQ_CH3', 'Hver 12 time');
define('_ACA_FREQ_CH4', 'Dagligt');
define('_ACA_FREQ_CH5', 'Ugentligt');
define('_ACA_FREQ_CH6', 'Månedslig');
define('_ACA_FREQ_NONE', 'Ingen');
define('_ACA_FREQ_NEW', 'Nye brugere');
define('_ACA_FREQ_ALL', 'Alle brugere');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Klik Ja hvis du ønsker at bruge denne til en Acajomm Cron, Nej for en anden cron opgave.<br />' .
		'Hvis du klikker Ja behøver du ikke angive Cron adressen, den vil automatisk blive tilføjet.');
define('_ACA_SITE_URL' , 'Din websides URL');
define('_ACA_CRON_FREQUENCY' , 'Cron Frekvens');
define('_ACA_STARTDATE_FREQ' , 'Start dato');
define('_ACA_LABELDATE_FREQ' , 'Angiv dato');
define('_ACA_LABELTIME_FREQ' , 'Angiv tid');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Frekvens');
define('_ACA_TITLE_CRONLIST', 'Cron List');
define('_NEW_LIST', 'Opret en ny liste');

//title CRON form
define('_ACA_TITLE_FREQ', 'Ret Cron');
define('_ACA_CRON_SITE_URL', 'Indtast en gyldig webside URL, startende med http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Alle forsendelser');
define('_ACA_EDIT_A', 'Ret en ');
define('_ACA_SELCT_MAILING', 'Vælg en liste i rullemenuen for at kunne tilføje en ny forsendelse.');
define('_ACA_VISIBLE_FRONT', 'Synlig i front-end');

// mailer
define('_ACA_SUBJECT', 'Emne');
define('_ACA_CONTENT', 'Indhold');
define('_ACA_NAMEREP', '[NAME] = Dette vil blive erstattet med det navn abonnenten har indtastet, du vil sende personaliserede email når du bruger denne.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Dette vil blive erstattet med det FØRSTE navn som abonnenten har indtastet.<br />');
define('_ACA_NONHTML', 'Ikke-HTML version');
define('_ACA_ATTACHMENTS', 'Vedhæftninger');
define('_ACA_SELECT_MULTIPLE', 'Hold control (eller ctrl) for at vælge flere vedhæftninger.<br />' .
		'De viste filer i denne vedhæftningsliste er placeret i vedhæftningsfolderen, du kan ændre denne placering i kofigurationspanelet.');
define('_ACA_CONTENT_ITEM', 'Indholdsdokument');
define('_ACA_SENDING_EMAIL', 'Afsender email');
define('_ACA_MESSAGE_NOT', 'Meddelelsen kunne ikke sendes');
define('_ACA_MAILER_ERROR', 'Udsendelses fejl');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Meddelelse sendt succesfuldt');
define('_ACA_SENDING_TOOK', 'Afsendelsen af denne forsendelse tog');
define('_ACA_SECONDS', 'sekunder');
define('_ACA_NO_ADDRESS_ENTERED', 'Ingen email adressse eller modtager angivet');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Ændre');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Ændre dit abonnement');
define('_ACA_WHICH_EMAIL_TEST', 'Angiv den email adresse der sendes en test til eller vælg forevisning');
define('_ACA_SEND_IN_HTML', 'Send i HTML (for HTML udsendelser)?');
define('_ACA_VISIBLE', 'Synlig');
define('_ACA_INTRO_ONLY', 'Kun introduktionen');

// stats
define('_ACA_GLOBALSTATS', 'Global statistik');
define('_ACA_DETAILED_STATS', 'Detaljeret statistik');
define('_ACA_MAILING_LIST_DETAILS', 'Liste detaljer');
define('_ACA_SEND_IN_HTML_FORMAT', 'Sendt i HTML format');
define('_ACA_VIEWS_FROM_HTML', 'Visninger (fra HTML forsendelse)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Send i tekstformat');
define('_ACA_HTML_READ', 'HTML læst');
define('_ACA_HTML_UNREAD', 'HTML ulæst');
define('_ACA_TEXT_ONLY_SENT', 'Kun tekst');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Statistikker');
define('_ACA_SUBSCRIBER_CONFIG', 'Abonnenter');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Diverse');
define('_ACA_MAIL_SETTINGS', 'Brev opsætning');
define('_ACA_MAILINGS_SETTINGS', 'Forsendelses opsætning');
define('_ACA_SUBCRIBERS_SETTINGS', 'Abonnements opsætning');
define('_ACA_CRON_SETTINGS', 'Cron Settings');
define('_ACA_SENDING_SETTINGS', 'Afsendelses opsætning');
define('_ACA_STATS_SETTINGS', 'Statistik opsætning');
define('_ACA_LOGS_SETTINGS', 'Logs Settings');
define('_ACA_MISC_SETTINGS', 'Diverse opsætninger');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Afsender Email');
define('_ACA_SEND_MAIL_NAME', 'Afsender navn');
define('_ACA_MAILSENDMETHOD', 'Afsendelses metode');
define('_ACA_SENDMAILPATH', 'Sendmail sti');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP identifikation kræves');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Vælg Ja hvis din SMTP server kræver identifikation');
define('_ACA_SMTPUSERNAME', 'SMTP brugernavn');
define('_ACA_SMTPUSERNAME_TIPS', 'Indtast SMTP brugernavnet når din SMTP server kræver identifikation');
define('_ACA_SMTPPASSWORD', 'SMTP kodeord');
define('_ACA_SMTPPASSWORD_TIPS', 'Indtast SMTP kodeordet når din SMTP server kræver identifikation');
define('_ACA_USE_EMBEDDED', 'Brug indlejrede billeder');
define('_ACA_USE_EMBEDDED_TIPS', 'Vælg Ja hvis billederne i det vedhæftede indholdsdokument skal være indlejret i emailen ved HTML meddelelser, eller Nej for at bruge standard billed afmærkninger som linker til billederne på websiden.');
define('_ACA_UPLOAD_PATH', 'Upload/vedhæftnings sti');
define('_ACA_UPLOAD_PATH_TIPS', 'Du kan angive et upload bibliotek.<br />' .
		'Kontroller at biblioteket du angiver eksisterer, ellers opret det.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Tilad uregistrerede');
define('_ACA_ALLOW_UNREG_TIPS', 'Vælg Ja hvis du vil tillade brugere at abonnere på lister uden at være registrerede brugere på websiden.');
define('_ACA_REQ_CONFIRM', 'Kræv bekræftigelse');
define('_ACA_REQ_CONFIRM_TIPS', 'Vælg Ja hvis du kræver at uregistrerede abonnenter bekræfter deres email adresse.');
define('_ACA_SUB_SETTINGS', 'Abonnerings opsætning');
define('_ACA_SUBMESSAGE', 'Abonnerings email');
define('_ACA_SUBSCRIBE_LIST', 'Abonner på en liste');

define('_ACA_USABLE_TAGS', 'Brugbare markeringer');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Denne opretter et link hvor abonnenten kan bekræfte sine abonnementer. Denne er <strong>krævet</strong> for at få Acajoom til at fungere korrekt.<br />'
.'<br />[NAME] = Denne vil blive erstattet med navnet på abonnenten, du vil derved sende personaliserede emails ved brug af denne.<br />'
.'<br />[FIRSTNAME] = Dette vil blive erstattet af FORNAVNET på abonnenten, fornavnet er defineret som det første navn indtastet af abonnenten.<br />');
define('_ACA_CONFIRMFROMNAME', 'Bekræft AFSENDER navnet');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Indtast det afsender navn der vises på bekræftigelses listen.');
define('_ACA_CONFIRMFROMEMAIL', 'Bekræft AFSENDER email');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Indtast den afsender email adresse der vises på bekræftigelses listen.');
define('_ACA_CONFIRMBOUNCE', 'Retur adressen');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Indtast retur adressen som vises på bekræftigelseslisten.');
define('_ACA_HTML_CONFIRM', 'HTML bekræftigelse');
define('_ACA_HTML_CONFIRM_TIPS', 'Vælg Ja hvis bekræftigelses listen skal være HTML hvis brugeren tillader HTML.');
define('_ACA_TIME_ZONE_ASK', 'Spørg om tidszone');
define('_ACA_TIME_ZONE_TIPS', 'Vælg Ja hvis du ønsker at spørge om brugerens tidzone. De ventende forsendelser vil blive sendt på baggrund af tidszone hvis muligt');

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', 'klik her for at sætte offset i det globale konfigurations panel -> Lokal tab');
define('_ACA_TIME_OFFSET_TIPS', 'Sæt din servers tids offset så de registrede datoer og tider er eksakte');
define('_ACA_TIME_OFFSET', 'Tids offset');
define('_ACA_CRON_TITLE', 'Opsætning af cron funktion');
define('_ACA_CRON_DESC','<br />Ved brug af cron funktionen kan du oprette en automatisk opgave på din Joomla webside!<br />' .
		'For at oprette den skal du tilføje følgende kommando i dit crontab kontrolpanel:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Hvis du har brug for hjælp til at sætte op eller har problemer så konsulter vores forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pause x sekunder for hvert konfigureret antal emails');
define('_ACA_PAUSEX_TIPS', 'Indtast antallet af sekunder som Acajoom vil give SMTP serveren til at sende meddelelserne før der fortsættes med det næste konfigurered antal meddelelser.');
define('_ACA_EMAIL_BET_PAUSE', 'Emails mellem pauser');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Antallet af emails der sendes før der holdes pause.');
define('_ACA_WAIT_USER_PAUSE', 'Vent for bruger input under pausen');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Hvad enten scriptet skal vente på bruger input når der er pause mellem et sæt forsendelser.');
define('_ACA_SCRIPT_TIMEOUT', 'Script timeout');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Antallet af minutter scriptet skal kunne køre (0 for uendeligt).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Aktiver læse statistik');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Vælg Ja hvis du ønsker at logge antallet af visninger. Denne teknik kan kun bruges ved HTML forsendelser');
define('_ACA_LOG_VIEWSPERSUB', 'Log visninger per abonnent');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Vælg Ja hvis du vil logge antallet af visninger per abonnent. Denne teknik kan kun bruges ved HTML forsendelser');
// Logs settings
define('_ACA_DETAILED', 'Detaljerede logs');
define('_ACA_SIMPLE', 'Simple logs');
define('_ACA_DIAPLAY_LOG', 'Vis logs');
define('_ACA_DISPLAY_LOG_TIPS', 'Vælg Ja hvis du vil vise logs mens forsendelser sendes.');
define('_ACA_SEND_PERF_DATA', 'Afsendelses ydelsen');
define('_ACA_SEND_PERF_DATA_TIPS', 'Vælg Ja hvis du ønsker at tillade Acajoom at sende ANONYME rapporter om di konfiguration, antallet af abonnementer på en liste og tiden det tog at sende forsendelsen. Dette vil give os en ide om Acajoom ydelsen og vil HJÆLPE OS	med at forbedre Acajoom i den fremtidige udvikling.');
define('_ACA_SEND_AUTO_LOG', 'Send log over auto-svar');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Vælg Ja hvis du ønsker at sende en email log hvoer gang en kø er behandlet.  ADVARSEL: dette kan resultere i en stor mængde emails.');
define('_ACA_SEND_LOG', 'Send loggen');
define('_ACA_SEND_LOG_TIPS', 'Hvad enten en log over forsendelsen skal blive sendt til email adressen på brugeren der sendte forsendelsen.');
define('_ACA_SEND_LOGDETAIL', 'Send log detailer');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Detailjeret indeholder succes eller fejl information for hver enkelt abonnent og et overblik over informationen. Simpel sender kun overblikket.');
define('_ACA_SEND_LOGCLOSED', 'Send log hvis forbindelsen er lukket');
define('_ACA_SEND_LOGCLOSED_TIPS', ' Med dette valg hos brugeren, der sender forsendelsen, vil der stadig blive modtaget en rapport via email.');
define('_ACA_SAVE_LOG', 'Gem loggen');
define('_ACA_SAVE_LOG_TIPS', 'Om en log over en forsendels bliver tilføjet til logfilen eller ej.');
define('_ACA_SAVE_LOGDETAIL', 'Gem detaljeret log');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Detailjeret indeholder succes eller fejl information for hver enkelt abonnent og et overblik over informationen. Simpel gemmer kun overblikket.');
define('_ACA_SAVE_LOGFILE', 'Gem logfilen');
define('_ACA_SAVE_LOGFILE_TIPS', 'Filen til hvilken log informationen tilføjes. Denne fil kan blive ganske stor.');
define('_ACA_CLEAR_LOG', 'Slet loggen');
define('_ACA_CLEAR_LOG_TIPS', 'Sletter logfilen.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Sidst udførte kø');
define('_ACA_CP_TOTAL', 'Totalt');
define('_ACA_MAILING_COPY', 'Forsendelsen kopieret succesfuldt!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Vis guide');
define('_ACA_SHOW_GUIDE_TIPS', 'Viser guidelines i begyndelsen til at hjælpe nye brugere med at oprette et nyhedsbrev, en auto-responder og sætte Acajoom korrekt op.');
define('_ACA_AUTOS_ON', 'Brug Auto-svar');
define('_ACA_AUTOS_ON_TIPS', 'Vælg Nej hvis du ikke vil bruge Auto-svar, så vil alle auto-svar valgmulighederne blive deaktiveret.');
define('_ACA_NEWS_ON', 'Brug nyhedsbreve');
define('_ACA_NEWS_ON_TIPS', 'Vælg Nej hvis du ikke ønsker at bruge nyhedsbreve, så vil alle valgmulighederne for nyhedsbreve blive deaktiveret.');
define('_ACA_SHOW_TIPS', 'Vis tips');
define('_ACA_SHOW_TIPS_TIPS', 'Vis tips for at hjælpe brugerene til at bruge Acajoom mere effektivt.');
define('_ACA_SHOW_FOOTER', 'Vis sidebunden');
define('_ACA_SHOW_FOOTER_TIPS', 'Om sidebunden med copyright beskeden vil blive vist eller ej.');
define('_ACA_SHOW_LISTS', 'Vis lister i front-end');
define('_ACA_SHOW_LISTS_TIPS', 'Når en bruger ikke er registreret vises en liste over lister som de kan abonnere på med arkiv knap for nyhedsbreve eller en login formular så de kan registrere sig.');
define('_ACA_CONFIG_UPDATED', 'Konfigurationsdetaljerne er blevet opdateret!');
define('_ACA_UPDATE_URL', 'Opdater URL');
define('_ACA_UPDATE_URL_WARNING', 'ADVARSEL! Ændrer ikke denne URL medmindre du er blevet bedt om at gøre det af det tekniske team fra Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'For eksempel: http://www.acajoom.com/update/ (inkluder den afsluttende skråstreg)');

// module
define('_ACA_EMAIL_INVALID', 'Den indtastede email er ukorrekt.');
define('_ACA_REGISTER_REQUIRED', 'Venligst registrer til websiden før du kan vælge en liste.');

// Access level box
define('_ACA_OWNER', 'Ejeren af listen:');
define('_ACA_ACCESS_LEVEL', 'Sæt adgangsniveau for listen');
define('_ACA_ACCESS_LEVEL_OPTION', 'Adgangsniveau mulighederne');
define('_ACA_USER_LEVEL_EDIT', 'Vælg hvilket brugerniveau der kræves for at rette en forsendelse (enten fra front-end eller back-end) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Dagligt');
define('_ACA_AUTO_DAY_CH2', 'Dagligt  ikke weekend');
define('_ACA_AUTO_DAY_CH3', 'Hver anden dag');
define('_ACA_AUTO_DAY_CH4', 'Hver anden dag ikke weekend');
define('_ACA_AUTO_DAY_CH5', 'Ugentligt');
define('_ACA_AUTO_DAY_CH6', 'Hver anden uge');
define('_ACA_AUTO_DAY_CH7', 'Månedslig');
define('_ACA_AUTO_DAY_CH9', 'Årligt');
define('_ACA_AUTO_OPTION_NONE', 'Ingen');
define('_ACA_AUTO_OPTION_NEW', 'Nye brugere');
define('_ACA_AUTO_OPTION_ALL', 'Alle brugere');

//
define('_ACA_UNSUB_MESSAGE', 'Afmeld email');
define('_ACA_UNSUB_SETTINGS', 'Afmeldings opsætning');
define('_ACA_AUTO_ADD_NEW_USERS', 'Automatisk abonner brugere?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Der er iøjeblikket ikke nogen opdatering tilgængelig.');
define('_ACA_VERSION', 'Acajoom Version');
define('_ACA_NEED_UPDATED', 'Filer der skal opdateres:');
define('_ACA_NEED_ADDED', 'Filer der skal tilføjes:');
define('_ACA_NEED_REMOVED', 'Filer der skal slettes:');
define('_ACA_FILENAME', 'Filenavn:');
define('_ACA_CURRENT_VERSION', 'Nuværende version:');
define('_ACA_NEWEST_VERSION', 'Nyeste version:');
define('_ACA_UPDATING', 'Opdaterer');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Filerne er blevet succesfuldt opdateret.');
define('_ACA_UPDATE_FAILED', 'Opdatering fejlede!');
define('_ACA_ADDING', 'Tilføjer');
define('_ACA_ADDED_SUCCESSFULLY', 'Tilføjet succesfuldt.');
define('_ACA_ADDING_FAILED', 'Tilføjelse fejlede!');
define('_ACA_REMOVING', 'Fjerner');
define('_ACA_REMOVED_SUCCESSFULLY', 'Fjernet succesfuldt.');
define('_ACA_REMOVING_FAILED', 'Sletning fejlet!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installer en anden version');
define('_ACA_CONTENT_ADD', 'Tilføj sideindhold');
define('_ACA_UPGRADE_FROM', 'Importer data (nyhedsbreve og abonnenters information) fra ');
define('_ACA_UPGRADE_MESS', 'Der er ingen risiko for dine eksisterende data. <br /> Denne process vil simpelthen importere dataene i Acajoom databasen.');
define('_ACA_CONTINUE_SENDING', 'Fortsæt afsendelse');

// Acajoom message
define('_ACA_UPGRADE1', 'Du kan let importere dine brugere og nyhedsbreve fra ');
define('_ACA_UPGRADE2', ' til Acajoom i opdaterings panelet.');
define('_ACA_UPDATE_MESSAGE', 'En ny version af Acajoom er tilgængelig! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Klik her for at opdatere!');
define('_ACA_CRON_SETUP', 'For at auto-svarene kan sendes skal du oprette en cron opgave.');
define('_ACA_THANKYOU', 'Tak fordi du valgte Acajoom, Din kommunikations partner!');
define('_ACA_NO_SERVER', 'Opdaterings server er ikke tilgængelig, venligst check igen senere.');
define('_ACA_MOD_PUB', 'Acajoom module er ikke udgivet.');
define('_ACA_MOD_PUB_LINK', 'Klik her for at udgive det!');
define('_ACA_IMPORT_SUCCESS', 'succesfuldt importeret');
define('_ACA_IMPORT_EXIST', 'abonnent allerede i database');

// Acajoom\'s Guide
define('_ACA_GUIDE', '\'s Wizard');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom har mange gode faciliteter og denne wizard til at guide dig gennem en simpel fire trins process til at få dig igang med at sende dine nyhedsbreve og auto-svar!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Først, skal du tilføje en liste.  En liste kan være af to forskellige typer, enten et nyhedsbrev eller en auto-svar.' .
		'  I listen definerer du alle de forskellige parametre for at aktivere afsendelsen af dit nyhedsbrev eller auto-svar: afsendernavn, layout, abonnenternes velkomst meddelelse, etc...
<br /><br />Du kan oprette din første liste  her: <a href="index2.php?option=com_acajoom&act=list" >Opret en liste</a> og klik på Ny knappen.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom giver dig en let måde at importere alle data fra et tidligere nyhedsbrevssystem.<br />' .
		' Gå til opdaterings panelet og vælg dit tidligere nyhedsbrevssystem for at importere all dine nyhedsbreve og abonnenter.<br /><br />' .
		'<span style="color:#FF5E00;" >VIGTIGT: importen er risikofri og påvirker ikke på nogen måde data i dit tidligere nyhedsbrevsystem</span><br />' .
		'Efter importen vil du kunne administre abonnenter og forsendelser direkte i Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Godt din første liste er oprettet!  Du kan nu skrive dit første %s.  For at oprette det gå til: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Auto-svar administration');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Nyhedsbrevs administration');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' og vælg din %s. <br /> Derefter vælger du %s i drop down listen.  Opret din første forsendelse ved at klikke Ny ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Før du sender dit første nyhedsbrev vil du måske checke mail konfigurationen.  ' .
		'Gå til <a href="index2.php?option=com_acajoom&act=configuration" >konfigurationssiden</a> for at kontrollere mail opsætningen. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Når du er klar til at gå tilbage til Nyhedsbrev menuen, vælg da dit brev og klik send');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'For at dit auto-svar kan sendes skal du først oprette en cron opgave på din server. ' .
		' Venligst benyt Cron fanebladet i kontrolpanelet.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >klik her</a> for at lære hvordan man opretter en cron opgave. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Kontroller at du har publiceret Acajoom modulet så brugerne kan tilmelde sig listen.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Du kan nu også oprette et auto-svar.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Du kan nu også oprette et nyhedsbrev.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Flot! Nu er du klar til effektivt at kommunikere med dine besøgende og brugere. Denne wizard vil blive afsluttet så snart du har indtastet din anden forsendelse eller du slå den fra i <a href="index2.php?option=com_acajoom&act=configuration" >konfigurations panelet</a>.' .
		'<br /><br />  Hvis du har nogle spørgsmål når du bruger Acajoom, så kontakt venligst vores ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Du kan også finde en mængde information om hvordan man effektivt kommunikerer med sine abonnenter på <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Tak fordi du bruger Acajoom. Din kommunications partner!</b> ');
define('_ACA_GUIDE_TURNOFF', 'Wizarden er nu slået fra!');
define('_ACA_STEP', 'TRIN ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom konfiguration');
define('_ACA_INSTALL_SUCCESS', 'Succesfuldt Installeret');
define('_ACA_INSTALL_ERROR', 'Installations fejl');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Acajoom modul');
//Others
define('_ACA_JAVASCRIPT','!Advarsel! Javascript skal være aktiveret for korrekt funktion.');
define('_ACA_EXPORT_TEXT','De abonnenter der er eksporteret er baseret på den liste du valgte. <br />Export abonnenter for liste');
define('_ACA_IMPORT_TIPS','Import subscribers. The information in the file need to be to the following format: <br />' .
		'Name,email,receiveHTML(0/1),<span style="color: rgb(255, 0, 0);">confirmed(0/1)</span>');
define('_ACA_SUBCRIBER_EXIT', 'er allerede en abonnent');
define('_ACA_GET_STARTED', 'Klik her for at komme igang!');

//News since 1.0.1
define('_ACA_WARNING_1011','Advarsel: 1011: Opdatering vil ikke fungere på grund af din servers begrænsninger.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Vælg den email adresse der vil blive vist som afsender.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Vælg det navn der vil blive vist som afsender.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Vælg den afsendelsesfunktion du ønsker at bruge: PHP mail, <span>Sendmail</span> eller SMTP server.');
define('_ACA_SENDMAILPATH_TIPS', 'Dette er biblioteket på mail serveren');
define('_ACA_LIST_T_TEMPLATE', 'Skabelon');
define('_ACA_NO_MAILING_ENTERED', 'Ingen forsendelser udvalgt');
define('_ACA_NO_LIST_ENTERED', 'Ingen liste udvalgt');
define('_ACA_SENT_MAILING' , 'Afsendte forsendelser');
define('_ACA_SELECT_FILE', 'Vælg venligst en fil til ');
define('_ACA_LIST_IMPORT', 'Marker de lister du ønsker abonnenterne tilknyttet til.');
define('_ACA_PB_QUEUE', 'Abonnent oprettet men problem med at forbinde ham/hende med listerne. Vælg dem venligst manuelt.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Opdatering kraftigt anbefalet!');
define('_ACA_UPDATE_MESS2' , 'Rettelse og små fixes.');
define('_ACA_UPDATE_MESS3' , 'Ny udgave.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 er krævet for at opdatere.');
define('_ACA_UPDATE_IS_AVAIL' , ' er tilgængelig!');
define('_ACA_NO_MAILING_SENT', 'Ingen forsendelser afsendt!');
define('_ACA_SHOW_LOGIN', 'Vis login formular');
define('_ACA_SHOW_LOGIN_TIPS', 'Vælg Ja for at vise en login formular i Acajoom front-end kontrolpanelet så brugeren kan registrere sig til websiden.');
define('_ACA_LISTS_EDITOR', 'List Description Editor');
define('_ACA_LISTS_EDITOR_TIPS', 'Vælg Ja for at bruge en HTML editor til at rette i listens beskrivelses felt.');
define('_ACA_SUBCRIBERS_VIEW', 'Vis abonnenter');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Front-end opsætning' );
define('_ACA_SHOW_LOGOUT', 'Vis logout knap');
define('_ACA_SHOW_LOGOUT_TIPS', 'Vælg Ja for at vise logout knappen i Acajoom front-end kontrolpanelet.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integration');
define('_ACA_CB_INTEGRATION', 'Community Builder Integration');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin for Community Builder er ikke installeret endnu!');
define('_ACA_CB_PLUGIN', 'Lister ved registringen');
define('_ACA_CB_PLUGIN_TIPS', 'Vælg Ja for at vise forsendelseslisten i Community Builder registreringsformularen');
define('_ACA_CB_LISTS', 'List ID');
define('_ACA_CB_LISTS_TIPS', 'DETTE ER ET PÅKRÆVET FELT. Indtast ID nummeret på den liste du ønsker at tillade brugerne at abonnere på adskildt med komma ,  (0 = vis alle listerne)');
define('_ACA_CB_INTRO', 'Introduktions tekst');
define('_ACA_CB_INTRO_TIPS', 'En tekst der vil fremkomme før oversikten. LAD DEN VÆRE BLANK FOR IKKE AT VISE NOGET.  Du kan bruge HTML tags til at tilrette udseendet.');
define('_ACA_CB_SHOW_NAME', 'Vis liste navn');
define('_ACA_CB_SHOW_NAME_TIPS', 'Vælg om navnet på listen vises eller ej efter introduktionen.');
define('_ACA_CB_LIST_DEFAULT', 'Marker listen som standard');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Vælg om afkrydsningsboxen for hver enkelt liste er markeret som standard eller ej.');
define('_ACA_CB_HTML_SHOW', 'Vis modtag HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Sæt til Ja for at tillade brugere at vælge om de vil have HTML emails eller ej. Sæt til Nej for at bruge standard Modtag HTML.');
define('_ACA_CB_HTML_DEFAULT', 'Standard Modtag HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Sæt denne valgmulighed for vise standard HTML forsendelses konfigurationen. Hvis Vis modtag HTML er sat til Nej så vil denne valgmulighed være standard.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Kunne ikke sikkerhedskopiere filen! Filen blev ikke erstattet.');
define('_ACA_BACKUP_YOUR_FILES', 'Den gamle versio af filerne er blevet sikkerhedskopiere ind i følgende bibliotek:');
define('_ACA_SERVER_LOCAL_TIME', 'Server lokal tid');
define('_ACA_SHOW_ARCHIVE', 'Vis arkiv knap');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Vælg Ja for at vise en arkiv knap i front-end på Nyhedsbrev listen');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Billeder');
define('_ACA_LIST_OPT_CTT', 'Indhold');
define('_ACA_INPUT_NAME_TIPS', 'Indtast hele dit navn (fornavn først)');
define('_ACA_INPUT_EMAIL_TIPS', 'Indtast din email adresse (Vær sikker på at dette er en gyldig email adresse hvis du vil modtage vores forsendelser.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Vælg Ja hvis du ønsker at modtage HTML forsendelser - Ikke at modtage kun tekst forsendelser');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Angiv din tidszone.');

// Since 1.0.5
define('_ACA_FILES' , 'Filer');
define('_ACA_FILES_UPLOAD' , 'Upload');
define('_ACA_MENU_UPLOAD_IMG' , 'Upload billeder');
define('_ACA_TOO_LARGE' , 'Fil størrelsen er for stor. Den maksimalt tilladte størrelse er');
define('_ACA_MISSING_DIR' , 'Destinations biblioteket findes ikke');
define('_ACA_IS_NOT_DIR' , 'Destinations bibliotektet findes ikke eller er ikke en regulær fil.');
define('_ACA_NO_WRITE_PERMS' , 'Der er ikke skrive rettigheder i destinations biblioteket.');
define('_ACA_NO_USER_FILE' , 'Du har ikke valgt nogen fil at uploade.');
define('_ACA_E_FAIL_MOVE' , 'Umuligt at flytte filen.');
define('_ACA_FILE_EXISTS' , 'Destinations filen findes allerede.');
define('_ACA_CANNOT_OVERWRITE' , 'Destinations filen findes allerede og kunne ikke overskrives.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Fil extention er ikke tilladt.');
define('_ACA_PARTIAL' , 'Filen blev kun delvist uploaded.');
define('_ACA_UPLOAD_ERROR' , 'Upload fejl:');
define('DEV_NO_DEF_FILE' , 'Filen blev kun delvist uploaded.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Dette vil blive erstattet med abonnement links.' .
		' Dette er <strong>krævet</strong> for at Acajoom kan fungere korrekt.<br />' .
		'Hvis du andet indhold i denne box vildet blive vist i alle forsendelser som hører til denne liste.' .
		' <br />Tilføj din abonnements besked i slutningen.  Acajoom vil automatisk tilføje en link til abonnenten så de kan ændre deres information og en link til afmelding fra listen.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notification');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notificationer');
define('_ACA_USE_SEF', 'SEF i forsendelser');
define('_ACA_USE_SEF_TIPS', 'Det anbefales at du vælger Nej.  Hvis du ønsker URLen inkluderet i din forsendelse for at bruge SEF da vælg Ja.' .
		' <br /><b>Linkene vil fungere på samme måde uanset hviken du vælger.  Nej vil sikre at links i forsendelser altid vil fungere selv hvis du ændrer din SEF.</b> ');
define('_ACA_ERR_NB' , 'Fejl #: ERR');
define('_ACA_ERR_SETTINGS', 'Fejlhåndterings opsætning');
define('_ACA_ERR_SEND' ,'Send fejlrapport');
define('_ACA_ERR_SEND_TIPS' ,'Hvis du vil have Acajoom til at blive et bedre produkt så vælg venligst Ja.  Det vil sende os en fejlrapport.  Så du behøver ikke engang at rapportere fejl mere ;-) <br /> <b>INGEN PRIVATE INFORMATIONER BLIVER SENDT</b>.  Vi vil end ikke vide fra hvilken webside fejlen er sendt fra. Vi sender kun informationer om Acajoom, PHP opsætningen og SQL forespørgsler. ');
define('_ACA_ERR_SHOW_TIPS' ,'Vælg Ja for at vise antallet af fejl på skærmen.  Primært anvendt for at kunne debuging løsningen. ');
define('_ACA_ERR_SHOW' ,'Vis fejl');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Vis afmeldings links');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Vælg Ja for at vise afmeldings links i bunde af forsendelsen så brugerne kan ændre deres abonnementer. <br /> Nej vil slå sidefoden og links fra.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">VIGTIG BEMÆRKNING!</span> <br />Hvis du opgraderer fra en tidligere Acajoom installation skal du opgradere din database struktur ved at klikke på følgende knap (Dine data vil forblive uændret)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Opgrader tabeller og konfiguration');
define('_ACA_MAILING_MAX_TIME', 'Maks. kø tid' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Definer den maksimale tid for hver sæt af emails der sendes af køen. Anbefales mellem 30 sek og 2 min.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart Integration');
define('_ACA_VM_COUPON_NOTIF', 'Kupon notifications ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Angiv ID nummeret på den forsendelse du ønsker at bruge til at sende kuponner til dine handlende.');
define('_ACA_VM_NEW_PRODUCT', 'Ny produkt notification ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Angiv ID nummeret på den forsendelse du ønsker at sende som ny produkt notification.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Opret formular');
define('_ACA_FORM_COPY', 'HTML kode');
define('_ACA_FORM_COPY_TIPS', 'Kopier den genererede HTML kode ind i din HTML side.');
define('_ACA_FORM_LIST_TIPS', 'Vælg den liste du vil inkludere i formularen');
// update messages
define('_ACA_UPDATE_MESS4' , 'Den kan ikke opdateres automatisk.');
define('_ACA_WARNG_REMOTE_FILE' , 'Der er ingen måde at hente den remote fil.');
define('_ACA_ERROR_FETCH' , 'Fejl under henting af fil.');

define('_ACA_CHECK' , 'Check');
define('_ACA_MORE_INFO' , 'Mere information');
define('_ACA_UPDATE_NEW' , 'Opgrader til nyere version');
define('_ACA_UPGRADE' , 'Opgrader til højere produkt');
define('_ACA_DOWNDATE' , 'Rul tilbage til den tidligere version');
define('_ACA_DOWNGRADE' , 'Tilbage til det grundlæggende produkt');
define('_ACA_REQUIRE_JOOM' , 'Kræv Joomla');
define('_ACA_TRY_IT' , 'Prøv det!');
define('_ACA_NEWER', 'Nyere');
define('_ACA_OLDER', 'Ældre');
define('_ACA_CURRENT', 'Gældende');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Prøv en af de andre komponenter');
define('_ACA_MENU_VIDEO' , 'Video uddannelse');
define('_ACA_AUTO_SCHEDULE', 'Plan');
define('_ACA_SCHEDULE_TITLE', 'Automatisk planlægningsfunktions opsætning');
define('_ACA_ISSUE_NB_TIPS' , 'Problem nummer genereret automatisk af systemet' );
define('_ACA_SEL_ALL' , 'Alle forsendelser');
define('_ACA_SEL_ALL_SUB' , 'Alle lister');
define('_ACA_INTRO_ONLY_TIPS' , 'Hvis du vælger denne box er det kun intoduktionen til artiklen der vil bliv indsat i forsendelsen med en "læs mere" link til den komplette artikel på din webside.' );
define('_ACA_TAGS_TITLE' , 'Placeringsmærker');
define('_ACA_TAGS_TITLE_TIPS' , 'Klip og klister denne markering in i forsendelse der hvor du vil have indholdet placeret.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Angiv den email adresse som testen skal sendes til');
define('_ACA_PREVIEW_TITLE' , 'Preview');
define('_ACA_AUTO_UPDATE' , 'Ny opdaterings besked');
define('_ACA_AUTO_UPDATE_TIPS' , 'Vælg Ja hvis du vil have besked om nye opdateringer til din komponent. <br />VIGTIGT!! Vis tips skal være slået til for at denne funktion vil virke.');

// since 1.1.0
define('_ACA_LICENSE' , 'Licens information');

// since 1.1.1
define('_ACA_NEW' , 'Ny');
define('_ACA_SCHEDULE_SETUP', 'For at auto-svaret kan blive send skal du opsætte din scheduler i konfigurationen.');
define('_ACA_SCHEDULER', 'Scheduler');
define('_ACA_ACAJOOM_CRON_DESC' , 'Hvis du ikke har adgang til en cron opgave adminstrator på din webside, kan du registrere dig til en fri Acajoom Cron konto på:' );
define('_ACA_CRON_DOCUMENTATION' , 'Du kan finde yderligere information om opsætningen af Acajoom scheduleren på følgende url:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Køen behandlet succesfuldt...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Fejl ved flytning af importeret fil' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Scheduler frekvens' );
define( '_ACA_CRON_MAX_FREQ' , 'Scheduler max frekvens' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Specificer den maximale frekvens som scheduleren kan køre med ( i minuter ).  Dette vil begrænse scheduleren selv om cron opgaverne er opsat til oftere.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Maximum emails per opgave' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Angiv det maximale antal emails der sendes per opgave (0 ubegrænset).' );
define( '_ACA_CRON_MINUTES' , ' minuter' );
define( '_ACA_SHOW_SIGNATURE' , 'Vis email sidefoden' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Hvad enten du vil eller ikke vil fremhæve Acajoom i bunden af emailene.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Auto-svarene er behandlet succesfuldt...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Planlagte nyhedsbreve er behandlet succesfuldt...' );
define( '_ACA_MENU_SYNC_USERS' , 'Synkroniser brugere' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Brugere synkroniseret succesfuldt!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Ja' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Nej' );
if (!defined('_HI')) define( '_HI', 'Hej' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Top' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Bund' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Hvis du markerer denne så vil kun titlen af artiklen blive indsat i forsendelsen som en link til den komplette artikel på din webside.');
define('_ACA_TITLE_ONLY' , 'Kun titel');
define('_ACA_FULL_ARTICLE_TIPS' , 'Hvis du markerer denne vil den komplette artikel blive indsat i forsendelsen');
define('_ACA_FULL_ARTICLE' , 'Fuld artikel');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Vælg det indhold der skal vedlægges til meddelelsen. <br />Klip og klistre <b>content tag</b> ind i forsendelsen.  Du kan vælge at have hele teksten, kun introduktionen, eller kun titlen med (0, 1, eller 2 respektivt). ');
define('_ACA_SUBSCRIBE_LIST2', 'Forsendelseslister');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Smart-Nyhedsbrev');
define('_ACA_MENU_AUTONEWS', 'Smart-Nyhedsbreve');
define('_ACA_AUTO_NEWS_OPTION', 'Smart-Nyhedsbrev valg');
define('_ACA_AUTONEWS_FREQ', 'Nyhedsbrevs frekvens');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Angiv frekvensen for hvor ofte du vil sende Smart-nyhedsbrevet.');
define('_ACA_AUTONEWS_SECTION', 'Artikel sektion');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Angiv den sektion du vil vælge artikler fra.');
define('_ACA_AUTONEWS_CAT', 'Artikel kategori');
define('_ACA_AUTONEWS_CAT_TIPS', 'Angiv den kategori du vil vælge artikler fra (Alle for alle artikler i den sektion).');
define('_ACA_SELECT_SECTION', 'Vælg en sektion');
define('_ACA_SELECT_CAT', 'Alle kategorier');
define('_ACA_AUTO_DAY_CH8', 'Kvartalsvis');
define('_ACA_AUTONEWS_STARTDATE', 'Start dato');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Angiv den dato du vil starte med at sende dit Smart-Nyhedsbrev.');
define('_ACA_AUTONEWS_TYPE', 'Indholdet behandles');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Fuld artikel: Vil inkludere hele artiklen i nyhedsbrevet.<br />' .
		'Kun intro: Vil kun inkludere introduktionen til artiklen i nyhedsbrevet.<br/>' .
		'Kun titel: Vil kun inkludere titlen til artiklen i nyhedsbrevet.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Dette vil blive udskiftet med Smart-Nyhedsbrevet.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Opret / Se forsendelser');
define('_ACA_LICENSE_CONFIG' , 'Licens' );
define('_ACA_ENTER_LICENSE' , 'Indtast licens');
define('_ACA_ENTER_LICENSE_TIPS' , 'Indtast dit licens nummer og gem det.');
define('_ACA_LICENSE_SETTING' , 'Licens opsætning' );
define('_ACA_GOOD_LIC' , 'Din licens er gyldig.' );
define('_ACA_NOTSO_GOOD_LIC' , 'Din licens er ugyldig: ' );
define('_ACA_PLEASE_LIC' , 'Venligst kontakt Acajoom support for at opgradere din licens ( license@acajoom.com ).' );

define('_ACA_DESC_PLUS', 'Acajoom Plus er den første sekvensielle auto-svar til Joomla CMS.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO det ultimative mailing system til Joomla CMS.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , 'Indtast token');
define('_ACA_ENTER_TOKEN_TIPS' , 'Venligst indtast det token nummer du modtog på email da du købte Acajoom.' );
define('_ACA_ACAJOOM_SITE', 'Acajoom website:');
define('_ACA_MY_SITE', 'Mit website:');
define( '_ACA_LICENSE_FORM' , ' ' .
 		'Klik her for at gå til licens formularen.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Venligst slet licens feltet så det er tomt og prøv igen.<br />  Hvis problemet fortsætter, ' );
define( '_ACA_LICENSE_SUPPORT' , 'Hvis du stadig har spørgsmål, ' . _ACA_PLEASE_LIC );
define( '_ACA_LICENSE_TWO' , 'du kan få din licens manuelt ved at indtaste token nummeret og website URL (som er fremhævet i grønt øverst på denne side) i licens formularen. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );
define('_ACA_ENTER_TOKEN_PATIENCE', 'Efter at have gemt din token vil en licens blive genereret automatisk. ' .
		' Normalt bliver token valideret i 2 minutter.  Uanset, in nogle tilfælde kan det tage op til 15 minuter.<br />' .
		'<br />Kontroller dette kontrolpanel om få minutter.  <br /><br />' .
		'Hvis du ikke modtog en valid licenskode inden for 15 minuter, '. _ACA_LICENSE_TWO);
define( '_ACA_ENTER_NOT_YET' , 'Din token er endnu ikke blivet valideret.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Venligst besøg <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> for at downloade den nyeste version.');
define( '_ACA_NOTIF_UPDATE' , 'For at blive notificeret om nye opdatering skal du indtaste din email adresse og klikke abonner ');


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
define('_ACA_REGWARN_NAME','Angiv dit navn.');
define('_ACA_REGWARN_MAIL','Angiv en gyldig e-mailadresse.');


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
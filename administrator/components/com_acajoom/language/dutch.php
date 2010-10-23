<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
 * <p>Dutch language file.</p>
 * @author Tromp Wezelman <info@uitgaanopurk.nl>
 * @version $Id: dutch.php 491 2007-02-01 22:56:07Z divivo $
 * @link http://www.joobisoft.com
 * voor fouten die gemaakt zijn in dit taalbestand kan er gemailt worden naar info@uitgaanopurk.nl
 */

### Algemeen ###
 //acajoom Beschrijving
define('_ACA_DESC_NEWS', 'Acajoom is een tool voor een mailinglijst, nieuwsbrieven, automatische-responder, en een makkelijke tool om doeltreffend te communiceren met uw gebruikers en klanten.  ' .
		'Acajoom, Uw CommunicatiePartner!');
define('_ACA_FEATURES', 'Acajoom, uw communicatiepartner!');

// Lijst typen
define('_ACA_NEWSLETTER', 'Nieuwsbrief');
define('_ACA_AUTORESP', 'Auto-responder');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Briefkaart');
define('_ACA_PERF', 'Prestatie');
define('_ACA_COUPON', 'Bon');
define('_ACA_CRON', 'Crontaak');
define('_ACA_MAILING', 'Mailing');
define('_ACA_LIST', 'Lijst');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Lijstmanagement');
define('_ACA_MENU_SUBSCRIBERS', 'Abonnees');
define('_ACA_MENU_NEWSLETTERS', 'Nieuwsbrieven');
define('_ACA_MENU_AUTOS', 'Auto-responders');
define('_ACA_MENU_COUPONS', 'Bonnen');
define('_ACA_MENU_CRONS', 'Crontaken');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Briefkaarten');
define('_ACA_MENU_PERFS', 'Prestatie');
define('_ACA_MENU_TAB_LIST', 'Lijst');
define('_ACA_MENU_MAILING_TITLE', 'Mailings');
define('_ACA_MENU_MAILING' , 'Mailings voor ');
define('_ACA_MENU_STATS', 'Statistieken');
define('_ACA_MENU_STATS_FOR', 'Statistieken voor ');
define('_ACA_MENU_CONF', 'Configuratie');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Info');
define('_ACA_MENU_LEARN', 'Leercentrum');
define('_ACA_MENU_MEDIA', 'Mediamanager');
define('_ACA_MENU_HELP', 'Help');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Importeren');
define('_ACA_MENU_EXPORT', 'Exporteren');
define('_ACA_MENU_SUB_ALL', 'Iedereen Abonneren');
define('_ACA_MENU_UNSUB_ALL', 'Niemand Abonneren');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archief');
define('_ACA_MENU_PREVIEW', 'Voorbeeld');
define('_ACA_MENU_SEND', 'Versturen');
define('_ACA_MENU_SEND_TEST', 'Verstuur Testemail');
define('_ACA_MENU_SEND_QUEUE', 'Wachtrij');
define('_ACA_MENU_VIEW', 'Bekijken');
define('_ACA_MENU_COPY', 'Kopie&euml;ren');
define('_ACA_MENU_VIEW_STATS' , 'Bekijk statistieken');
define('_ACA_MENU_CRTL_PANEL' , ' Configuratiescherm');
define('_ACA_MENU_LIST_NEW' , ' Cre&euml;er een Lijst');
define('_ACA_MENU_LIST_EDIT' , ' Bewerk een Lijst');
define('_ACA_MENU_BACK', 'Terug');
define('_ACA_MENU_INSTALL', 'Installatie');
define('_ACA_MENU_TAB_SUM', 'Samenvatting');
define('_ACA_STATUS' , 'Status');

// berichten
define('_ACA_ERROR' , ' Een fout opgetreden! ');
define('_ACA_SUB_ACCESS' , 'Toegangsrechten');
define('_ACA_DESC_CREDITS', 'Credits');
define('_ACA_DESC_INFO', 'Informatie');
define('_ACA_DESC_HOME', 'Homepagina');
define('_ACA_DESC_MAILING', 'Mailinglijst');
define('_ACA_DESC_SUBSCRIBERS', 'Abonnees');
define('_ACA_PUBLISHED','Gepubliseerd');
define('_ACA_UNPUBLISHED','Niet gepubliceerd');
define('_ACA_DELETE','Verwijderen');
define('_ACA_FILTER','Filter');
define('_ACA_UPDATE','Update');
define('_ACA_SAVE','Opslaan');
define('_ACA_CANCEL','Annuleren');
define('_ACA_NAME','Naam');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Selecteren');
define('_ACA_ALL','Alle');
define('_ACA_SEND_A', 'Verstuur een ');
define('_ACA_SUCCESS_DELETED', ' met succes verwijderd');
define('_ACA_LIST_ADDED', 'Lijst met succes gecre&euml;erd');
define('_ACA_LIST_COPY', 'Lijst met succes gekopieerd');
define('_ACA_LIST_UPDATED', 'Lijst met succes bijgewerkt');
define('_ACA_MAILING_SAVED', 'Mailing met succes opgeslagen.');
define('_ACA_UPDATED_SUCCESSFULLY', 'met succes geupdate.');

### Abonnee informatie ###
//inschrijf en uitschrijf informatie
define('_ACA_SUB_INFO', 'Abonnees informatie');
define('_ACA_VERIFY_INFO', 'Controleer AUB de link die u toegevoegd heeft, er mist nog enige informatie.');
define('_ACA_INPUT_NAME', 'Naam');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Ontvang HTML?');
define('_ACA_TIME_ZONE', 'Tijdzone');
define('_ACA_BLACK_LIST', 'Zwarte lijst');
define('_ACA_REGISTRATION_DATE', 'Datum gebruikersregistratie');
define('_ACA_USER_ID', 'Gebruikers id');
define('_ACA_DESCRIPTION', 'Beschrijving');
define('_ACA_ACCOUNT_CONFIRMED', 'Uw account is geactiveerd.');
define('_ACA_SUB_SUBSCRIBER', 'Abonnee');
define('_ACA_SUB_PUBLISHER', 'Uitgever');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Geregistreerd');
define('_ACA_SUBSCRIPTIONS', 'Inschrijvingen');
define('_ACA_SEND_UNSUBCRIBE', 'Verstuur een bericht');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Klik op Ja om een bevestigingsbericht uitschrijving te versturen.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Bevestig uw inschrijving AUB');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Bevestiging uitschrijving');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Hallo [NAME],<br />' .
		'Nog een stap en u bent toegevoegd aan de lijst. Klik AUB op de volgende link om uw inschrijving te bevestigen.' .
		'<br /><br />[CONFIRM]<br /><br />Voor vragen neemt u aub contact op met de webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Dit is een bevestingsemail dat u bent uitgeschreven van onze lijst. We vinden het jammer dat u beslist heeft om u uit te schrijven. Wanneer u zich weer wilt inschrijven, kunt u dat altijd doen op onze website. Heeft u nog vragen, neemt u aub contact op met de webmaster.');

// Acajoom abonnees
define('_ACA_SIGNUP_DATE', 'Inschrijfdatum');
define('_ACA_CONFIRMED', 'Bevestigd');
define('_ACA_SUBSCRIB', 'Inschrijven');
define('_ACA_HTML', 'HTML mailings');
define('_ACA_RESULTS', 'Resultaten');
define('_ACA_SEL_LIST', 'Selecteer een lijst');
define('_ACA_SEL_LIST_TYPE', '- Selecteer type lijst -');
define('_ACA_SUSCRIB_LIST', 'Lijst van alle abonnees');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'abonnees voor : ');
define('_ACA_NO_SUSCRIBERS', 'Geen abonnees gevonden voor deze lijst.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Een bevestigings-email is naar u toegestuurd. Controleer aub uw email en klik op de toegevoegde link.<br />' .
		'U moet uw email bevestigen voordat uw inschrijving actief is.');
define('_ACA_SUCCESS_ADD_LIST', 'U bent met succes toegevoegd aan de lijst.');


 // Inschrijf informatie
define('_ACA_CONFIRM_LINK', 'Klik hier om uw inschrijving te bevestigen');
define('_ACA_UNSUBSCRIBE_LINK', 'Klik hier om u zelf uit te schrijven van onze lijst');
define('_ACA_UNSUBSCRIBE_MESS', 'Uw emailadres is verwijderd uit onze lijst');
define('_ACA_QUEUE_SENT_SUCCESS' , 'Alle geplande mailings zijn met succes verstuurd.');
define('_ACA_MALING_VIEW', 'Bekijk alle mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Weet u het zeker dat u zich wilt uitschrijven van onze lijst?');
define('_ACA_MOD_SUBSCRIBE', 'Inschrijven');
define('_ACA_SUBSCRIBE', 'Inschrijven');
define('_ACA_UNSUBSCRIBE', 'Uitschrijven');
define('_ACA_VIEW_ARCHIVE', 'Bekijk archief');
define('_ACA_SUBSCRIPTION_OR', ' of klik hier om uw informatie bij te werken');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Dit emailadres is al geregistreerd.');
define('_ACA_SUBSCRIBER_DELETED', 'Abonnee met succes verwijderd.');


### Gebruikers scherm ###
 //Gebruikers Menu
define('_UCP_USER_PANEL', 'Gebruikers configuratiescherm');
define('_UCP_USER_MENU', 'Gebruikers Menu');
define('_UCP_USER_CONTACT', 'Mijn inschrijvingen');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Crontaak Management');
define('_UCP_CRON_NEW_MENU', 'Nieuwe Cron');
define('_UCP_CRON_LIST_MENU', 'Mijn Cronlijst');
 //Acajoom Bon Menu
define('_UCP_COUPON_MENU', 'Bonmanagement');
define('_UCP_COUPON_LIST_MENU', 'Bonnenlijst');
define('_UCP_COUPON_ADD_MENU', 'Bon toevoegen');

### lijsts ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Beschrijving');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Inschrijving');
define('_ACA_LIST_T_SENDER', 'Zender informatie');
define('_ACA_LIST_TYPE', 'Lijsttype');
define('_ACA_LIST_NAME', 'Namen lijst');
define('_ACA_LIST_ISSUE', 'Mail nr #');
define('_ACA_LIST_DATE', 'Verzenddatum');
define('_ACA_LIST_SUB', 'Mailingonderwerp');
define('_ACA_ATTACHED_FILES', 'bijlagen');
define('_ACA_SELECT_LIST', 'Selecteer aub een lijst om te bewerken!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Lijsttype');
define('_ACA_AUTO_RESP_OPTION', 'Auto-responder opties');
define('_ACA_AUTO_RESP_FREQ', 'Abonnees kunnen frequentie kiezen');
define('_ACA_AUTO_DELAY', 'Vertraging (in dagen)');
define('_ACA_AUTO_DAY_MIN', 'Minimale frequentie');
define('_ACA_AUTO_DAY_MAX', 'Maximumale frequentie');
define('_ACA_FOLLOW_UP', 'Specificeren van een auto-responder');
define('_ACA_AUTO_RESP_TIME', 'Abonnees kunnen tijd kiezen');
define('_ACA_LIST_SENDER', 'Verzendlijst');
define('_ACA_LIST_DESC', 'Lijst omschrijving');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Naam verzender');
define('_ACA_SENDER_EMAIL', 'Email verzender');
define('_ACA_SENDER_BOUNCE', 'Verzender bounce adres');
define('_ACA_LIST_DELAY', 'Vertraging');
define('_ACA_HTML_MAILING', 'HTML mailing?');
define('_ACA_HTML_MAILING_DESC', '(Als u dit wijzigt, moet u het opslaan en terugkeren naar dit scherm om de opgeslagen wijzigingen te zien.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Verberg voor de voorpagina?');
define('_ACA_SELECT_IMPORT_FILE', 'Selecteer een bestand om te importeren');;
define('_ACA_IMPORT_FINISHED', 'Importeren voltooid');
define('_ACA_DELETION_OFFILE', 'Bestand verwijderen');
define('_ACA_MANUALLY_DELETE', 'Mislukt, u zult handmatig het bestand moeten verwijderen');
define('_ACA_CANNOT_WRITE_DIR', 'Map niet beschrijfbaar');
define('_ACA_NOT_PUBLISHED', 'Kan de mailing niet verzenden, de lijst in niet gepubliseerd.');

//  Lijst informatie box
define('_ACA_INFO_LIST_PUB', 'Klik op Ja om de lijst te publiseren');
define('_ACA_INFO_LIST_NAME', 'Vul de naam van uw lijst hier in. U kan de lijst herkennen aan deze naam.');
define('_ACA_INFO_LIST_DESC', 'Vul een korte omschrijving van uw lijst hier in. Deze omschrijving is zichtbaar voor de bezoekers van uw site.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Vul de naam van de verzender van de mailing in. Deze naam is zichtbaar wanneer de abonnees het bericht ontvangen van deze lijst.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Vul het emailadres in waar vandaan het bericht word verstuurd.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Vul het emailadres in waar gebruikers antwoord naar toe kunnen sturen. We raden u aan het zelfde email adres te gebruiken als het verzendadres, sinds spam filters uw bericht een hogere spamniveau geven als de emailadressen veschillend zijn.');
define('_ACA_INFO_LIST_AUTORESP', 'Kies het type mailing voor deze lijst. <br />' .
		'Nieuwsbrief: normale nieuwsbrief<br />' .
		'Auto-responder: een auto-responder is een lijst die automatisch word verstuurd door de website op verschillende tijden.');
define('_ACA_INFO_LIST_FREQUENCY', 'Inschakelen dat gebruikers kunnen kiezen hoe vaak ze een lijst ontvangen. Het geeft meer flexibiliteit aan de gebruiker.');
define('_ACA_INFO_LIST_TIME', 'Laat de gebruiker een bepaalde tijd van een dag kiezen wanneer zij de lijst willen ontvangen.');
define('_ACA_INFO_LIST_MIN_DAY', 'Bepaal wat de minimale frequentie is dat een gebruiker kan kiezen om een lijst te ontvangen.');
define('_ACA_INFO_LIST_DELAY', 'Specificeer de vertraging tussen deze auto-responder en de vorige.');
define('_ACA_INFO_LIST_DATE', 'Specificeer de datum om de nieuwslijst te publiceren als u de publicering wilt vertragen. <br /> FORMAAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Bepaal wat de maximale frequentie is dat een gebruiker kan kiezen om de lijst te ontvangen');
define('_ACA_INFO_LIST_LAYOUT', 'Voer de layout van uw mailinglijst hier in. U kunt elk layout hier invoegen voor uw mailing.');
define('_ACA_INFO_LIST_SUB_MESS', 'Dit bericht zal worden verstuurd naar de abonnee wanneer hij of zij zich voor het eerst registreert. U kan hier elke tekst invullen die nodig is.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Dit bericht word verstuurd naar de abonnee wanneer hij of zij zich uitschrijft. Elk willekeurig bericht kan hier worden ingevuld.');
define('_ACA_INFO_LIST_HTML', 'Selecteer de keuzebox als u een HTML mailing wil versturen. Abonnees kunnen instellen of ze een HTML-bericht willen ontvangen, of een tekstbericht alleen wanneer er wordt ingeschreven voor een HTML-lijst.');
define('_ACA_INFO_LIST_HIDDEN', 'Klik Ja om de lijst te verbergen voor de voorpagina, gebruikers kunnen zich niet inschrijven, maar je kunt de mailings nog wel versturen.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Wilt u automatisch gebruikers toevoegen tot deze lijst?<br /><B>Nieuwe Gebruiker:</B> voegt elke gebruiker toe die zich registreert op de website.<br /><B>Alle gebruikers:</B> Voegt alle geregistreerde gebruikers van de database toe.<br />(Al deze opties ondersteunen Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Selecteer het voorpagina toegangsniveau. Dit wil de mailing weergeven of verbergen voor gebruikersgroepen die er geen toegang tot hebben, zodat ze niet de mogelijkheid hebben om zich in te schrijven.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Selecteer het toegangsniveau van de gebruikersgroep die mogen bewerken. Die gebruikersgroep en alles daarboven heeft de rechten om mailing te bewerken en te versturen, zelfs van de frontend of backend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Als u wilt dat de auto-responder begint met een volgende wanneer het de laatste bericht heeft bereikt, kunt u hier de volgende auto-responder instellen.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Dit is de ID van de persoon die deze lijst heeft gecre&euml;erd.');
define('_ACA_INFO_LIST_WARNING', 'Deze laatste optie is alleen beschikbaar tijdens het cre&euml;ren van de lijst.');
define('_ACA_INFO_LIST_SUBJET', 'Onderwerp van de mailing.  Dit is het onderwerp van de email die de abonnee zal ontvangen.');
define('_ACA_INFO_MAILING_CONTENT', 'Dit is de inhoud van de email die u wilt versturen.');
define('_ACA_INFO_MAILING_NOHTML', 'Voer hier de inhoud in van de email die u wilt versturen naar abonnees die gekozen hebben om alleen niet HTML mailings te ontvangen. <BR/> NOTITIE: als u het leeg laat, zal Acajoom automatisch de HTML tekst converteren naar alleen tekst.');
define('_ACA_INFO_MAILING_VISIBLE', 'Klik op Ja om de mailings weer te geven in de frontend.');
define('_ACA_INSERT_CONTENT', 'Voeg bestaande content toe');

// Bonnen
define('_ACA_SEND_COUPON_SUCCESS', 'Bon met succes verzonden!');
define('_ACA_CHOOSE_COUPON', 'Kies een bon');
define('_ACA_TO_USER', ' naar deze gebruiker');

### Cron opties
//drop down frequentie(CRON)
define('_ACA_FREQ_CH1', 'Elk uur');
define('_ACA_FREQ_CH2', 'Elke 6 uur');
define('_ACA_FREQ_CH3', 'Elke 12 uur');
define('_ACA_FREQ_CH4', 'Dagelijks');
define('_ACA_FREQ_CH5', 'Wekelijks');
define('_ACA_FREQ_CH6', 'Maandelijks');
define('_ACA_FREQ_NONE', 'Nee');
define('_ACA_FREQ_NEW', 'Nieuwe Gebruikers');
define('_ACA_FREQ_ALL', 'Alle Gebruikers');

//Label CRON formulier
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Klik op Ja als u dit wilt gebruiken voor een Acajoom Cron en klik Nee voor elke andere Cron taak.<br />' .
		'Als u op Ja klikt, dan hoeft u geen specifiek Cron-adres op te geven, het wordt automatisch toegevoegd.');
define('_ACA_SITE_URL' , 'Uw website URL');
define('_ACA_CRON_FREQUENCY' , 'Cronfrequentie');
define('_ACA_STARTDATE_FREQ' , 'Startdatum');
define('_ACA_LABELDATE_FREQ' , 'Datum opgeven');
define('_ACA_LABELTIME_FREQ' , 'Tijd opgeven');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Frequentie');
define('_ACA_TITLE_CRONLIST', 'Cronlijst');
define('_NEW_LIST', 'Cre&euml;er een nieuwe lijst');

//titel CRON formulier
define('_ACA_TITLE_FREQ', 'Bewerk Cron');
define('_ACA_CRON_SITE_URL', 'Voer AUB een geldige website url in dat begint met http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Alle mailings');
define('_ACA_EDIT_A', 'Bewerk een ');
define('_ACA_SELCT_MAILING', 'Selecteer aub een lijst in het drop down menu om een nieuwe mailing toe te voegen.');
define('_ACA_VISIBLE_FRONT', 'Zichtbaar op de voorpagina');

// email
define('_ACA_SUBJECT', 'Onderwerp');
define('_ACA_CONTENT', 'Inhoud');
define('_ACA_NAMEREP', '[NAME] = Dit zal vervangen worden door de naam die de abonnee heeft ingevoerd, er wordt een gepersonaliseerde email verstuurd wanneer dit wordt gebruikt.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Dit zal vervangen worden door de voornaam die de abonnee heeft ingevuld.<br />');
define('_ACA_NONHTML', 'Niet-html versie');
define('_ACA_ATTACHMENTS', 'Bijlagen');
define('_ACA_SELECT_MULTIPLE', 'Houdt control (of command) toets vast om meerdere bijlagen te selecteren.<br />' .
		'De bestanden die weergegeven worden in deze bijlagenlijst zijn opgeslagen in de bijlagenmap, u kan deze locatie wijzigen in het configuratiescherm.');
define('_ACA_CONTENT_ITEM', 'Contentitem');
define('_ACA_SENDING_EMAIL', 'Email versturen');
define('_ACA_MESSAGE_NOT', 'Bericht kon niet worden verstuurd');
define('_ACA_MAILER_ERROR', 'Email error');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Bericht met succes verstuurd.');
define('_ACA_SENDING_TOOK', 'Versturen van deze mailing duurt');
define('_ACA_SECONDS', 'seconden');
define('_ACA_NO_ADDRESS_ENTERED', 'Geen adres ingevoerd');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Wijzig');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Wijzig uw inschrijving');
define('_ACA_WHICH_EMAIL_TEST', 'Geef het emailadres op om een testmail toe te sturen of selecteer voorbeeld');
define('_ACA_SEND_IN_HTML', 'Verstuur in HTML (voor html mailings)?');
define('_ACA_VISIBLE', 'Zichtbaar');
define('_ACA_INTRO_ONLY', 'Alleen intro');

// statistieken
define('_ACA_GLOBALSTATS', 'Globale statistieken');
define('_ACA_DETAILED_STATS', 'Gedetailleerde statistieken');
define('_ACA_MAILING_LIST_DETAILS', 'Lijstdetails');
define('_ACA_SEND_IN_HTML_FORMAT', 'Verstuur in HTML formaat');
define('_ACA_VIEWS_FROM_HTML', 'Bekeken (van html mails)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Verstuur in tekst formaat');
define('_ACA_HTML_READ', 'HTML gelezen');
define('_ACA_HTML_UNREAD', 'HTML ongelezen');
define('_ACA_TEXT_ONLY_SENT', 'Alleen tekst');

// Configuratie scherm
// Hoofd tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Stats');
define('_ACA_SUBSCRIBER_CONFIG', 'Abonnees');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Overige');
define('_ACA_MAIL_SETTINGS', 'Mail Instellingen');
define('_ACA_MAILINGS_SETTINGS', 'Instellingen mailings');
define('_ACA_SUBCRIBERS_SETTINGS', 'Abonnees-instellingen');
define('_ACA_CRON_SETTINGS', 'Croninstellingen');
define('_ACA_SENDING_SETTINGS', 'Versturen instellingen');
define('_ACA_STATS_SETTINGS', 'Statistieken-instellingen');
define('_ACA_LOGS_SETTINGS', 'Logs instellingen');
define('_ACA_MISC_SETTINGS', 'Overige instellingen');
// mail instellingen
define('_ACA_SEND_MAIL_FROM', 'Mail Van');
define('_ACA_SEND_MAIL_NAME', 'Van Naam');
define('_ACA_MAILSENDMETHOD', 'Mail methode');
define('_ACA_SENDMAILPATH', 'Uitgaand Mail-pad');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP wachtwoordverificatie vereist');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Selecteer ja als uw SMTP server wachtwoordverificatie vereist');
define('_ACA_SMTPUSERNAME', 'SMTP gebruikersnaam');
define('_ACA_SMTPUSERNAME_TIPS', 'Voer de SMTP gebruikersnaam in wanneer uw SMPT server wachtwoordverificatie vereist');
define('_ACA_SMTPPASSWORD', 'SMTP wachtwoord');
define('_ACA_SMTPPASSWORD_TIPS', 'Voer de SMTP wachtwoord in wanneer uw SMTP server wachtwoordverificatie vereist');
define('_ACA_USE_EMBEDDED', 'Gebruik vastgezette plaatjes');
define('_ACA_USE_EMBEDDED_TIPS', 'Selecteer ja als de plaatjes in de toegevoegd content items vastgezet dienen te worden voor html berichten, of nee om de link te gebruiken van de standaard plaatjes van deze site.');
define('_ACA_UPLOAD_PATH', 'Upload directory- /bijlagenpad');
define('_ACA_UPLOAD_PATH_TIPS', 'U kan een upload directory specificeren.<br />' .
		'U moet zeker weten dat deze directory bestaat, anders cre&euml;er deze.');

// Abonnee instellingen
define('_ACA_ALLOW_UNREG', 'Sta niet geregistreerde gebruikers toe');
define('_ACA_ALLOW_UNREG_TIPS', 'Selecteer Ja als u wilt toestaan dat gebruikers zich kunnen inschrijven zonder lid te worden van de website.');
define('_ACA_REQ_CONFIRM', 'Bevestiging vereist');
define('_ACA_REQ_CONFIRM_TIPS', 'Selecteer ja als u niet geregistreerde gebruikers hun emailadres wilt laten bevestigen.');
define('_ACA_SUB_SETTINGS', 'Abonnee Instellingen');
define('_ACA_SUBMESSAGE', 'Email abonnee');
define('_ACA_SUBSCRIBE_LIST', 'Inschrijven bij een lijst');

define('_ACA_USABLE_TAGS', 'Te gebruiken tags');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Dit cre&euml;ert een klikbare link waar de abonnee zijn inschrijving kan bevestigen. Dit is <strong>vereist</strong> om Acajoom goed te laten werken.<br />'
.'<br />[NAME] = Dit zal vervangen worden door de naam die de abonnee heeft ingevoerd. Er wordt een persoonlijke email verzonden als dit wordt gebruikt.<br />'
.'<br />[FIRSTNAME] = Dit zal vervangen worden door de voornaam van de abonnee. Voornaam is gedefini&euml;erd als de eerste naam die de abonnee heeft ingevoerd.<br />');
define('_ACA_CONFIRMFROMNAME', 'Naam bevestigen');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Voer de \'van\' naam in om om weer te geven in bevestigingslijsten.');
define('_ACA_CONFIRMFROMEMAIL', 'Email bevestigen');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Voer het emailadres in om weer te geven op bevestingslijsten.');
define('_ACA_CONFIRMBOUNCE', 'Bevestig bounceadres');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Voer het bounceadres in om weer te geven op bevestigingslijsten.');
define('_ACA_HTML_CONFIRM', 'HTML bevestigen');
define('_ACA_HTML_CONFIRM_TIPS', 'Selecteer ja als bevestingslijsten in html moet zijn als de gebruiker html heeft toegestaan.');
define('_ACA_TIME_ZONE_ASK', 'Vraag tijdzone');
define('_ACA_TIME_ZONE_TIPS', 'Selecteer ja als u de tijdzone van de gebruikers wilt vragen. De mailings die in de wachtrij staan zullen verzonden worden volgens de tijdzone');

 // Cron configureren
define('_ACA_TIME_OFFSET_URL', 'klik hier om de offset te wijzigen in het configuratiescherm -> Locale tab');
define('_ACA_TIME_OFFSET_TIPS', 'Stel uw server offset tijd in zodat opgeslagen datum en tijd gelijk zijn');
define('_ACA_TIME_OFFSET', 'Tijd offset');
define('_ACA_CRON_TITLE', 'Opzetten cronfunctie');
define('_ACA_CRON_DESC','<br />Door de cronfunctie te gebruiken kan u een automatische taak instellen voor uw Joomla website!<br />' .
		'Om dit in te stellen moet u een in uw Control Panel -> contrab het volgende commando:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Als u hulp nodig heeft om in te stellen of u heeft problemen, raadpleeg dan aub ons forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');

// Instellingen verzenden
define('_ACA_PAUSEX', 'Pauze x seconden na elke geconfigureerde hoeveelheid emails');
define('_ACA_PAUSEX_TIPS', 'Voer het aantal seconden in. Acajoom zal de SMTP server de tijd geven om de berichten te versturen voordat de volgende geconfigureerde hoeveelheid berichten wordt verzonden.');
define('_ACA_EMAIL_BET_PAUSE', 'Pauzes tussen de emails');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Het aantal verzonden emails voordat er wordt gepauzeerd.');
define('_ACA_WAIT_USER_PAUSE', 'Wachten voor gebruikersinput tijdens pauze');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'of het script moet wachten voor gebruikersinput tijdens pauze tussen een reeks van mailings.');
define('_ACA_SCRIPT_TIMEOUT', 'Script timeout');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Aantal minuten dat het script zou moeten werken.');

// Instellingen statistieken
define('_ACA_ENABLE_READ_STATS', 'Inschakelen lees statistieken');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Selecteer ja als u het aantal views wilt loggen. Deze techniek kan alleen worden gebruikt voor html mailings');
define('_ACA_LOG_VIEWSPERSUB', 'Log views per abonnee');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Selecteer ja als u het aantal views per abonnee wilt loggen. Deze techniek kan alleen worden gebruikt voor html mailings');

// Logs instellingen
define('_ACA_DETAILED', 'Gedetailleerde logs');
define('_ACA_SIMPLE', 'Eenvoudige logs');
define('_ACA_DIAPLAY_LOG', 'Logs weergeven');
define('_ACA_DISPLAY_LOG_TIPS', 'Selecteer ja als u de logs wilt weergeven tijdens het verzenden van de mailings.');
define('_ACA_SEND_PERF_DATA', 'Verzend performance');
define('_ACA_SEND_PERF_DATA_TIPS', 'Selecteer ja als u Acajoom wilt toestaan om onbekende raporten te versturen over uw configuratie. Het aantal abonnees van een lijst en de tijd die nodig is om een mailing te versturen. Dit geeft ons een idee over de Acajoom performance en zal ons helpen om Acajoom te verbeteren in toekomstige ontwikkelingen.');
define('_ACA_SEND_AUTO_LOG', 'Verzend log voor auto-responder');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Selecteer ja als u elke keer een email log wilt versturen als de wachtrij voltooid is.  WAARSCHUWMING: dit kan leiden tot een grote hoeveelheid emails.');
define('_ACA_SEND_LOG', 'Verzend log');
define('_ACA_SEND_LOG_TIPS', 'Of een log van de mailing gemaild moet worden naar het email adres van de gebruiker die de mailing heeft verzonden.');
define('_ACA_SEND_LOGDETAIL', 'Verzend log detail');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Details verzorgt het succes van error informatie voor iedere abonnee en een overzicht van de informatie. Details verzendt eenvoudig het overzicht.');
define('_ACA_SEND_LOGCLOSED', 'Verzendt log als verbinding is afgesloten');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Met deze instelling van de gebruiker die de mailing verstuurd, krijgt de gebruiker toch nog een rapport via de email.');
define('_ACA_SAVE_LOG', 'Log opslaan');
define('_ACA_SAVE_LOG_TIPS', 'Of de log van de mailing toegevoegd moet worden aan het logbestand.');
define('_ACA_SAVE_LOGDETAIL', 'Logdetail opslaan');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Details verzorgt het succes van error informatie voor iedere abonnee en een overzicht van de informatie. Het verzendt eenvoudig het overzicht.');
define('_ACA_SAVE_LOGFILE', 'Logbestand opslaan');
define('_ACA_SAVE_LOGFILE_TIPS', 'Bestand waar log informatie aan wordt toegevoegd. Het bestand kan heel groot worden.');
define('_ACA_CLEAR_LOG', 'Logbestand leegmaken');
define('_ACA_CLEAR_LOG_TIPS', 'Maakt het logbestand leeg.');

### Configuratiescherm
define('_ACA_CP_LAST_QUEUE', 'Leest uitgevoerde wachtrij');
define('_ACA_CP_TOTAL', 'Totaal');
define('_ACA_MAILING_COPY', 'Mailing met succes gekopieerd!');

// Overige instellingen
define('_ACA_SHOW_GUIDE', 'Handleiding weergeven');
define('_ACA_SHOW_GUIDE_TIPS', 'Geef tijdens het starten de handleiding weer om nieuwe gebruikers te helpen om een nieuwsbrief, een auto-responder te cre&euml;eren en om Acajoom goed in te stellen.');
define('_ACA_AUTOS_ON', 'Gebruik Auto-responders');
define('_ACA_AUTOS_ON_TIPS', 'Selecteer Nee als u geen Auto-responders wilt gebruiken, alle auto-responders instellingen worden gedeactiveerd.');
define('_ACA_NEWS_ON', 'Gebruik Nieuwsbrieven');
define('_ACA_NEWS_ON_TIPS', 'Selecteer Nee als u geen gebruik wilt maken van Nieuwsbrieven, Alle nieuwsbrief-opties zullen worden gedeactiveerd.');
define('_ACA_SHOW_TIPS', 'Tips weergeven');
define('_ACA_SHOW_TIPS_TIPS', 'Geeft tips weer om gebruikers te helpen om Acajoom effici&euml;nter te gebruiken.');
define('_ACA_SHOW_FOOTER', 'Geeft voetnoot weer');
define('_ACA_SHOW_FOOTER_TIPS', 'Of de voetnoot copyright notitie moet worden weergegeven.');
define('_ACA_SHOW_LISTS', 'Geeft lijst weer op de frontend');
define('_ACA_SHOW_LISTS_TIPS', 'Wanneer een gebruiker niet geregistreerd is, geeft een overzicht weer van de lijsten waar zij zich op kunnen inschrijven met een archief knop voor nieuwsbrieven of een eenvoudig inlogformulier zodat zij zich kunnen registreren.');
define('_ACA_CONFIG_UPDATED', 'De configuratie details zijn bijgewerkt!');
define('_ACA_UPDATE_URL', 'Update URL');
define('_ACA_UPDATE_URL_WARNING', 'WAARSCHUWING! Wijzig deze URL niet voordat dit gevraagd is door het Acajoom technisch team.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Voorbeeld: http://www.acajoom.com/update/ (schuine streep is belangrijk)');

// module
define('_ACA_EMAIL_INVALID', 'De ingevoerde email is ongeldig.');
define('_ACA_REGISTER_REQUIRED', 'Registreert u zichaub eerst op de site voordat u zich kan inschrijven voor de lijst.');

// Toegangsniveau box
define('_ACA_OWNER', 'Maker van de lijst:');
define('_ACA_ACCESS_LEVEL', 'Stel toegangsniveau in voor de lijst');
define('_ACA_ACCESS_LEVEL_OPTION', 'Toegansniveau Instellingen');
define('_ACA_USER_LEVEL_EDIT', 'Selecteer welk gebruikersniveau is toegestaan om een mailing te bewerken. (in de frontend of backend) ');

//  drop down opties
define('_ACA_AUTO_DAY_CH1', 'Dagelijks');
define('_ACA_AUTO_DAY_CH2', 'Dagelijks, geen weekend');
define('_ACA_AUTO_DAY_CH3', 'Om de dag');
define('_ACA_AUTO_DAY_CH4', 'Om de dag, geen weekend');
define('_ACA_AUTO_DAY_CH5', 'Wekelijks');
define('_ACA_AUTO_DAY_CH6', 'Om de week');
define('_ACA_AUTO_DAY_CH7', 'Maandelijks');
define('_ACA_AUTO_DAY_CH9', 'Jaarlijks');
define('_ACA_AUTO_OPTION_NONE', 'Nee');
define('_ACA_AUTO_OPTION_NEW', 'Nieuwe Gebruikers');
define('_ACA_AUTO_OPTION_ALL', 'Alle Gebruikers');

//
define('_ACA_UNSUB_MESSAGE', 'Uitschrijvings email');
define('_ACA_UNSUB_SETTINGS', 'Uitschrijvings instellingen');
define('_ACA_AUTO_ADD_NEW_USERS', 'Automatisch inschrijven gebruiker?');

// Update and upgrade berichten
define('_ACA_NO_UPDATES', 'Er zijn momenteel geen updates beschikbaar.');
define('_ACA_VERSION', 'Acajoom Versie');
define('_ACA_NEED_UPDATED', 'Bestanden die bijgewerkt moeten worden:');
define('_ACA_NEED_ADDED', 'Bestanden die toegevoegd moeten worden:');
define('_ACA_NEED_REMOVED', 'Bestanden die verwijderd moeten worden:');
define('_ACA_FILENAME', 'Bestandsnaam:');
define('_ACA_CURRENT_VERSION', 'Huidige versie:');
define('_ACA_NEWEST_VERSION', 'Nieuwste versie:');
define('_ACA_UPDATING', 'Bezig met Updaten');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'De bestanden zijn met succes bijgewerkt.');
define('_ACA_UPDATE_FAILED', 'Update mislukt!');
define('_ACA_ADDING', 'Toevoegen');
define('_ACA_ADDED_SUCCESSFULLY', 'Met succes toegevoegd.');
define('_ACA_ADDING_FAILED', 'Toevoegen mislukt!');
define('_ACA_REMOVING', 'Verwijderen');
define('_ACA_REMOVED_SUCCESSFULLY', 'Met succes verwijderd.');
define('_ACA_REMOVING_FAILED', 'Verwijderen mislukt!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installeer een andere versie');
define('_ACA_CONTENT_ADD', 'Content toevoegen');
define('_ACA_UPGRADE_FROM', 'Importeer data (nieuwsbrieven en abonnees informatie) van ');
define('_ACA_UPGRADE_MESS', 'Uw bestaande data loopt geen risico. <br /> Dit proces zal de data in de Acajoom database importeren.');
define('_ACA_CONTINUE_SENDING', 'Doorgaan met verzenden');

// Acajoom bericht
define('_ACA_UPGRADE1', 'U kan eenvoudig uw gebruikers en nieuwsbrieven importeren van ');
define('_ACA_UPGRADE2', ' naar Acajoom in het updatescherm.');
define('_ACA_UPDATE_MESSAGE', 'Een nieuwe versie van Acajoom is beschikbaar. ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Klik hier om de update te starten!');
define('_ACA_CRON_SETUP', 'Om autoresponders te versturen moet u een crontaak instellen.');
define('_ACA_THANKYOU', 'Bedankt voor het kiezen van Acajoom, uw communicatie partner!');
define('_ACA_NO_SERVER', 'Update Server niet beschikbaar, controleer later nog een keer aub.');
define('_ACA_MOD_PUB', 'Acajoom module is niet gepubliceerd.');
define('_ACA_MOD_PUB_LINK', 'Klik hier om deze te publiceren!');
define('_ACA_IMPORT_SUCCESS', 'Succesvol geimporteerd');
define('_ACA_IMPORT_EXIST', 'Abonnee bestaat al in de database');


// Acajoom's handleiding
define('_ACA_GUIDE', '\'s Wizard');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom heeft veel voordelen en de wizard zal u eenvoudig door 4 stappen heenleiden om te starten met het versturen van nieuwsbrieven en auto-responders!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Als eerste moet u een lijst maken. Een lijst kan uit twee typen bestaan,' .
		' een nieuwsbrief of een auto-responder.  In de lijst defini&euml;ert u alle verschillende parameters om het versturen' .
		' van nieuwsbrieven of auto-responders in te schakelen: Naam van de verzender, layout, abonnees, welkombericht, etc...' .
		'<br /><br />U kan uw eerste lijst hier configureren: <a href="index2.php?option=com_acajoom&act=list" >' .
				'cre&euml;er een lijst</a> en klik op de knop: Nieuw' );
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom biedt u een eenvoudige manier om data te importeren uit uw vorige nieuwsbriefsysteem.<br />' .
		' Ga naar het Updatescherm en kies het vorige nieuwsbriefsysteem om alle data te importeren.<br /><br />' .
		'<span style="color:#FF5E00;" >BELANGRIJK: het importeren is risicovrij en zal de data van uw vorige nieuwsbriefsysteem niet beschadigen</span><br />' .
		'Na het importeren kunt u de abonnees en mailings meteen beheren vanuit Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Cre&euml;er uw eerste lijst!  U kunt nu uw eerste %s opstellen.  Om deze te cre&euml;eren ga naar: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Auto-responder Management');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Nieuwsbrief Management');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' en select uw %s. <br /> Kies dan uw %s in de drop-down lijst.  Cre&euml;er uw eerste mailing door te klikken op Nieuw ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Voordat u uw eerste nieuwsbrief verstuurt, moet u uw mailconfiguratie nakijken.  ' .
		'Ga naar het <a href="index2.php?option=com_acajoom&act=configuration" >configuratiescherm</a> om de emailinstellingen te controleren. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Als u klaar bent ga dan terug naar het nieuwsbrief menu, selecteer uw mailing en klik op Verzenden');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Om uw auto-responders te verzenden moet u eerst een crontaak instellen op uw server. ' .
		' Refereer aub naar de Cron tab in het configuratiescherm.' .
		' <a href="index2.php?option=com_acajoom&act=configuration">klik hier</a> om te leren hoe u een crontaak kunt instellen. <br />');

define('_ACA_GUIDE_MODULE', ' <br />U moet de Acajoom module hebben gepubliceerd zodat belangstellenden zich kunnen inschrijven voor de lijst.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' U kan nu eventueel een auto-responder instellen.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' U kan nu ook een nieuwsbrief instellen.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Eindelijk! U bent klaar om effectief te communiceren met uw bezoekers en gebruikers.' .
		' Deze wizard zal stoppen wanneer u een tweede mailing heeft aangemaakt of u kunt deze deactiveren in het ' .
		'<a href="index2.php?option=com_acajoom&act=configuration" >configuratiescherm</a>.' .
		'<br /><br />  Als u nog vragen heeft tijdens het gebruik van Acajoom, refereer aub naar het ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22">forum</a>. ' .
		' U zult veel informatie vinden over hoe te communiceren op een effectieve manier met uw abonnees op <a href="http://www.acajoom.com/" target="_blank">www.Acajoom.com</a>.' .
		'<p /><br /><b>Bedankt voor het gebruiken van Acajoom. Uw Communicatie Partner!</b> ');
define('_ACA_GUIDE_TURNOFF', 'De wizard is nu uitgeschakeld!');
define('_ACA_STEP', 'STAP ');

// Acajoom Installatie
define('_ACA_INSTALL_CONFIG', 'Acajoom Configuratie');
define('_ACA_INSTALL_SUCCESS', 'Succesvol Geinstalleerd');
define('_ACA_INSTALL_ERROR', 'Installatie Error');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Acajoom Module');
//Overig
define('_ACA_JAVASCRIPT','!Waarschuwing! Javascript moet ingeschakeld worden voor een goede werking.');
define('_ACA_EXPORT_TEXT','Het exporteren van abonnees is gebaseerd op de lijst die u heeft gekozen. <br />Exporteer abonnees voor de lijst');
define('_ACA_IMPORT_TIPS','Importeer abonnees. De informatie in het bestand moet in het volgende formaat staan: <br />' .
		'Name,email,receiveHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmed(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'is al abonnee');
define('_ACA_GET_STARTED', 'Klik hier om te starten!');

//Nieuw sinds 1.0.1
define('_ACA_WARNING_1011','Waarschuwing: 1011: Update zal niet werken door uw server restricties.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Kies welk emailadres moet worden weergegeven als verzender.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Kies welke naam moet worden weergegeven als verzender.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Kies welke mailmethode u wilt gebruiken: PHP mail functie, <span>Sendmail</span> of SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Dit is de directory van de Mail-server');
define('_ACA_LIST_T_TEMPLATE', 'Template');
define('_ACA_NO_MAILING_ENTERED', 'Geen mailing beschikbaar');
define('_ACA_NO_LIST_ENTERED', 'Geen lijst beschikbaar');
define('_ACA_SENT_MAILING' , 'Verzend mailings');
define('_ACA_SELECT_FILE', 'Selecteer aub ook een bestand ');
define('_ACA_LIST_IMPORT', 'Selecteer de lijst(en) waar u abonnees mee geassocieerd wilt hebben.');
define('_ACA_PB_QUEUE', 'Abonnee toegevoegd, maar er is een probleem om hem/haar aan de lijst(en) te verbinden. Kijk AUB in de handleiding.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Update dringend geadviseerd!');
define('_ACA_UPDATE_MESS2' , 'Patch en kleine foutoplossingen');
define('_ACA_UPDATE_MESS3' , 'Nieuwe release.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 is vereist om te updaten.');
define('_ACA_UPDATE_IS_AVAIL' , ' is beschikbaar!');
define('_ACA_NO_MAILING_SENT', 'Geen mailing verstuurd!');
define('_ACA_SHOW_LOGIN', 'Geef login formulier weer');
define('_ACA_SHOW_LOGIN_TIPS', 'Selecteer Ja om een loginformulier weer te geven op de front-end Acajoom configuratiescherm zodat een gebruiker zich kan registreren op de website.');
define('_ACA_LISTS_EDITOR', 'Editor lijst beschijving');
define('_ACA_LISTS_EDITOR_TIPS', 'Selecteer Ja om een HTML-editor te gebruiken om de lijst omschrijving veld te bewerken.');
define('_ACA_SUBCRIBERS_VIEW', 'Bekijk abonnees');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Front-end Settings' );
define('_ACA_SHOW_LOGOUT', 'Laat logout knop zien');
define('_ACA_SHOW_LOGOUT_TIPS', 'Selecteer Ja om een logoutknop op het Acajoom panel te laten zien.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integratie');
define('_ACA_CB_INTEGRATION', 'Community Builder Integratie');
define('_ACA_INSTALL_PLUGIN', 'Community Builder Plugin (Acajoom Integratie) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Acajoom Plugin voor Community Builder is nog niet genstalleerd!');
define('_ACA_CB_PLUGIN', 'Registratielijsten');
define('_ACA_CB_PLUGIN_TIPS', 'Kies Ja om de maillijst in het in het Community Builder registratieformulier te laten zien');
define('_ACA_CB_LISTS', 'Lijst IDs');
define('_ACA_CB_LISTS_TIPS', 'DIT IS EN VERPLICHT VELD. Vul het id nummer in van de lijst waarop gebruikers zich kunnen inschrijven, gescheiden door een komma,  (0 toont alle lijsten)');
define('_ACA_CB_INTRO', 'Introductietekst');
define('_ACA_CB_INTRO_TIPS', 'Een tekst die ingevuld wordt  zal voor de lijst getoond worden. LAAT LEEG OM NIETS TE TONEN.  Gebruik  cb_pretekst voor CSS layout.');
define('_ACA_CB_SHOW_NAME', 'Toon de lijstnaam');
define('_ACA_CB_SHOW_NAME_TIPS', 'Kies om de naam van de lijst al dan niet te tonen na de introductie. ');
define('_ACA_CB_LIST_DEFAULT', 'Standaard Aanvinken');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Kies of het keuzevakje standaard ingevuld moet worden voor elke lijst. ');
define('_ACA_CB_HTML_SHOW', 'Toon Ontvang HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Kies Ja om gebruikers een keuze te laten maken of ze HTML mails willen ontvangen of niet. Kies Nee om standaard HTML te ontvangen. ');
define('_ACA_CB_HTML_DEFAULT', 'Standaard ontvangst HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Kies voor deze optie om de standaard HTML mailconfiguratie te tonen. Als het Standaard ontvangst HTML  op Nee staat is deze optie standaard. ');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Kan geen backup van het bestand maken! Bestand niet vervangen.');
define('_ACA_BACKUP_YOUR_FILES', 'De backup van de oude versie van de bestanden zijn in de volgende directory geplaatst:');
define('_ACA_SERVER_LOCAL_TIME', 'Lokale Server tijd');
define('_ACA_SHOW_ARCHIVE', 'Geef archiefknop weer');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Selecteer JA om de archiefknop in de nieuwsbrievenlijst op de front-end weer te geven');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Plaatjes');
define('_ACA_LIST_OPT_CTT', 'Inhoud');
define('_ACA_INPUT_NAME_TIPS', 'Voer uw volledige naam in (voornaam eerst)');
define('_ACA_INPUT_EMAIL_TIPS', 'Voer uw email adres in (Dit moet een geldig email adres zijn als u onze mailings wilt ontvangen.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Kies Ja als u HTML mailings wilt ontvangen - Nee om alleen tekst mailings te ontvangen');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Bepaal uw tijdzone.');

// Since 1.0.5
define('_ACA_FILES' , 'Bestanden');
define('_ACA_FILES_UPLOAD' , 'Upload');
define('_ACA_MENU_UPLOAD_IMG' , 'Upload Plaatjes');
define('_ACA_TOO_LARGE' , 'Bestandgrootte is te groot. De maximale toegestane grootte is');
define('_ACA_MISSING_DIR' , 'Doeldirectory bestaat niet');
define('_ACA_IS_NOT_DIR' , 'Doeldirectory bestaat niet of het is een normaal bestand.');
define('_ACA_NO_WRITE_PERMS' , 'De doeldirectory heeft geen schrijf rechten.');
define('_ACA_NO_USER_FILE' , 'U heeft geen bestand geselecteerd voor uploaden.');
define('_ACA_E_FAIL_MOVE' , 'Onmogelijk om het bestand te verplaatsen.');
define('_ACA_FILE_EXISTS' , 'Het doelbestand bestaat reeds.');
define('_ACA_CANNOT_OVERWRITE' , 'Het doelbestand bestaat reeds of kan niet overschreven worden.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Bestands extentie niet toegestaan.');
define('_ACA_PARTIAL' , 'Het bestand was alleen ten dele geupload.');
define('_ACA_UPLOAD_ERROR' , 'Upload error:');
define('DEV_NO_DEF_FILE' , 'Het bestand was alleen ten dele geupload.');
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Dit zal worden vervangen door de inschrijvingslinks.' .
		' Dit is <strong>vereist</strong> om Acajoom goed te laten werken.<br />' .
		'Als u andere content in deze box plaatst, word het weergegeven in alle mailings die betrekking hebben met deze lijst.' .
		' <br />Voeg uw inschrijvingsbericht toe op het eind. Acajoom zal automatisch een link toevoegen voor de abonnee om hun gegevens aan te passen en een link om zich uit te schrijven van de lijst.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notificatie');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notificatie');
define('_ACA_USE_SEF', 'SEF in mailings');
define('_ACA_USE_SEF_TIPS', 'Het is aanbevolen om Nee te kiezen. Als u toch de URL in de mailings als SEF wilt gebruiken, kies dan Ja.' .
		' <br /><b>De link werkt hetzelfde voor de beide opties.  We kunnen niet verzekeren dat de links in de mailings altijd werken, zelfs als u uw SEF wijzigt.</b> ');
define('_ACA_ERR_NB' , 'Error #: ERR');
define('_ACA_ERR_SETTINGS', 'Error afhandelings instellingen');
define('_ACA_ERR_SEND' ,'Verzend error rapport');
define('_ACA_ERR_SEND_TIPS' ,'Als u Acajoom wilt helpen verbeteren, selecteer aub JA.  Deze keuze zal ons een error rapport sturen.  Zo hoeft u geen bugs meer te rapporteren. ;-) <br /> <b>ER WORD GEEN PERSOONLIJKE INFORMATIE VERSTUURD</b>.  We weten niet eens van welke website de error vandaan komt. We versturen alleen de informatie over Acajoom, de PHP instellingen en de SQL queries. ');
define('_ACA_ERR_SHOW_TIPS' ,'Kies Ja om de error nummer weer te geven.  Hoofdzakelijk gebruikt voor debugging. ');
define('_ACA_ERR_SHOW' ,'Geef errors weer');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Geef uitschrijvings links weer');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Selecteer Ja om uitschrijvings links op het eind van de mailing weer te geven om gebruikers hun inschrijvingen te kunnen laten wijzigen. <br /> Niet de voetnoot en de links uitschakelen.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">BELANGRIJKE INFORMATIE!</span> <br />Als u een vorige Acajoom installatie bijwerkt, moet u de database structuur bijwerken door op de volgende knop te klikken (Uw gegevens zullen bewaard blijven)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Tabbellen en configuratie bijwerken');
define('_ACA_MAILING_MAX_TIME', 'Max queue tijd' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Defini&euml;er de maximale tijd voor elke set emails verstuurd door de queue. Aanbevolen tussen 30s en 2 minuten.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart intergratie');
define('_ACA_VM_COUPON_NOTIF', 'Bon notificatie ID.');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Specificeer de ID nummer van de mailing die u wilt gebruiken om bonnen te verzenden naar uw klanten.');
define('_ACA_VM_NEW_PRODUCT', 'Nieuwe producten notificatie ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Specificeer de ID nummer van de mailing die u wilt gebruiken om nieuwe product notificatie te verzenden.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Creëer formulier');
define('_ACA_FORM_COPY', 'HTML code');
define('_ACA_FORM_COPY_TIPS', 'Kopiëer de gegenereerde HTML code in uw HTML pagina.');
define('_ACA_FORM_LIST_TIPS', 'Selecteer de lijst die u wilt invoegen in het formulier');
// update messages
define('_ACA_UPDATE_MESS4' , 'Het Kan niet automatisch worden geupdate.');
define('_ACA_WARNG_REMOTE_FILE' , 'Het bestand kan niet verwijderd worden.');
define('_ACA_ERROR_FETCH' , 'Error tijdens openen bestand.');

define('_ACA_CHECK' , 'Controleer');
define('_ACA_MORE_INFO' , 'Meer info');
define('_ACA_UPDATE_NEW' , 'Bijwerken naar een nieuwere versie');
define('_ACA_UPGRADE' , 'Bijwerken naar een betere produkt');
define('_ACA_DOWNDATE' , 'Bijwerken naar een vorige versie');
define('_ACA_DOWNGRADE' , 'Terug naar het basis produkt');
define('_ACA_REQUIRE_JOOM' , 'Joomla Vereist');
define('_ACA_TRY_IT' , 'Probeer het!');
define('_ACA_NEWER', 'Nieuwer');
define('_ACA_OLDER', 'Ouder');
define('_ACA_CURRENT', 'Huidige');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Probeer een van de andere componenten');
define('_ACA_MENU_VIDEO' , 'Video tutorials');
define('_ACA_AUTO_SCHEDULE', 'Rooster');
define('_ACA_SCHEDULE_TITLE', 'Automatische setting roosterfunctie ');
define('_ACA_ISSUE_NB_TIPS' , 'Mailnummer wordt automatisch gegenereerd door het systeem' );
define('_ACA_SEL_ALL' , 'Alle mailings');
define('_ACA_SEL_ALL_SUB' , 'Alle lijsten');
define('_ACA_INTRO_ONLY_TIPS' , 'Als je dit hokje aanvinkt zal alleen het introductiedeel van het artikel in de nieuwsbrief geplaatst worden met een "lees meer" link naar het volledige artikel op je site.' );
define('_ACA_TAGS_TITLE' , 'Inhoudslabel');
define('_ACA_TAGS_TITLE_TIPS' , 'Kopieer en plak de label in de nieuwsbrief waar de inhoud geplaatst moet worden.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Vermeld het emailadres waar de testmail naar toe gestuurd wordt');
define('_ACA_PREVIEW_TITLE' , 'Preview');
define('_ACA_AUTO_UPDATE' , 'Nieuwe updatemelding');
define('_ACA_AUTO_UPDATE_TIPS' , 'Kies Ja als u geinformeerd wilt worden over nieuwe updates voor uw component. <br />BELANGRIJK!! Tips weergeven! moet op Ja staan om deze functie te laten werken.');

// since 1.1.0
define('_ACA_LICENSE' , 'Lincensie Informatie');

// since 1.1.1
define('_ACA_NEW' , 'Nieuw');
define('_ACA_SCHEDULE_SETUP', 'In welke volgorde de Auto-responder moet worden verstuurd, moet u een planning instellen in de configuratie.');
define('_ACA_SCHEDULER', 'Planning');
define('_ACA_ACAJOOM_CRON_DESC' , 'als u geen toegang heeft tot een cron taak manager op uw website, kan u zich registreren voor een gratis Acajoom Cron Account op:' );
define('_ACA_CRON_DOCUMENTATION' , 'U kunt meer informatie vinden over het instellen van een Acajoom Planning op de volgende url:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Wachtrij succesvol verwerkt...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Error met verplaatsen geimporteerd bestand' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Planning frequentie' );
define( '_ACA_CRON_MAX_FREQ' , 'Planning max frequentie' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Geef de maximale frequentie op dat de planning kan opereren ( in minuten ).  Dit zal de planning beperken, zelfs wanneer de cron taak is ingesteld met meer frequentie.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Maximale emails per taak' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Geef het aantal emails op dat verstuurd word per taak (0 ongelimiteerd).' );
define( '_ACA_CRON_MINUTES' , ' minuten' );
define( '_ACA_SHOW_SIGNATURE' , 'Geef email voetnoot weer' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Of u Acajoom in de voetnoot van de e-mails wel of niet wil promoten.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Auto-responders succesvol verwerkt...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Geplande nieuwsbrieven succesvol verwerkt...' );
define( '_ACA_MENU_SYNC_USERS' , 'Synchronisatie Gebruikers' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Gebruikers Synchronisatie Succesvol!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Uitloggen' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Ja' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Nee' );
if (!defined('_HI')) define( '_HI', 'Hallo' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Bovenkant' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Onderkant' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Indien u alleen dit selecteerd, zal in de mailing alleen de titel van het artikel worden toegevoegd als een link naar het complete artikel op uw website.');
define('_ACA_TITLE_ONLY' , 'Title alleen');
define('_ACA_FULL_ARTICLE_TIPS' , 'Als u dit selecteerd word het complete artikel toegevoegd in de mailing');
define('_ACA_FULL_ARTICLE' , 'Volledige Artikel');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Selecteer een content item om bij het bericht toe te voegen. <br />kopiëer en plak <b>content tag</b> in de mailing.  U kan kiezen voor volledige tekst, alleen de introductie of alleen de titel met (0, 1, or 2 respectievelijk). ');
define('_ACA_SUBSCRIBE_LIST2', 'Mailing lijst(en)');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Slimme-Nieuwsbrieven');
define('_ACA_MENU_AUTONEWS', 'Slimme-Nieuwsbrieven');
define('_ACA_AUTO_NEWS_OPTION', 'Slim-Nieuwsbrief instellingen');
define('_ACA_AUTONEWS_FREQ', 'Nieuwsbrief Frequentie');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Geef de frequentie op waarmee u de slim-nieuwsbrief sturen wil.');
define('_ACA_AUTONEWS_SECTION', 'Artikel Onderdeel');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Geef het onderdeel op waarvan u de artikelen kiezen wil.');
define('_ACA_AUTONEWS_CAT', 'Artikel Categorie');
define('_ACA_AUTONEWS_CAT_TIPS', 'Geef de categorie op waarvan u de artikelen kiezen wil (Alles voor alle artikelen in dat onderdeel).');
define('_ACA_SELECT_SECTION', 'Selecteer een onderdeel');
define('_ACA_SELECT_CAT', 'Alle Categorieëen');
define('_ACA_AUTO_DAY_CH8', 'Quaterly');
define('_ACA_AUTONEWS_STARTDATE', 'Start datum');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Geef de datum op waarmee u wilt beginnen met de Slimme Nieuwsbrief te sturen.');
define('_ACA_AUTONEWS_TYPE', 'Inhoud interpretatie');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Volledige Artikel: zal het volledige artikel in de nieuwsbrief toevoegen.<br />' .
		'Introductie alleen: Zal enkel de introductie van het artikel in de nieuwsbrief toevoegen.<br/>' .
		'Titel alleen: Zal enkel de titel van het artikel in de nieuwsbrief toevoegen.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Dit zal door de Slim-Nieuwsbrief vervangen worden.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Creëer / Bekijk de mailings');
define('_ACA_LICENSE_CONFIG' , 'licentie' );
define('_ACA_ENTER_LICENSE' , 'Voer licentie in');
define('_ACA_ENTER_LICENSE_TIPS' , 'Voer uw licentie nummer in en klik op opslaan.');
define('_ACA_LICENSE_SETTING' , 'licentie instellingen' );
define('_ACA_GOOD_LIC' , 'U heeft een geldige licentie.' );
define('_ACA_NOTSO_GOOD_LIC' , 'U heeft een ongeldige licentie: ' );
define('_ACA_PLEASE_LIC' , 'Contacteer AUB Acajoom support om uw licentie bij te werken ( license@acajoom.com ).' );

define('_ACA_DESC_PLUS', 'Acajoom Plus is de eerste logische auto-responder voor Joomla CMS.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO de ultieme E-mail systeem voor Joomla CMS.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , 'Voer bewijs in');
define('_ACA_ENTER_TOKEN_TIPS' , 'Voer AUB uw bewijsnummer in die u via de e-mail heeft ontvangen toen u Acajoom heeft aangeschaft. ');
define('_ACA_ACAJOOM_SITE', 'Acajoom site:');
define('_ACA_MY_SITE', 'Mijn site:');
define( '_ACA_LICENSE_FORM' , ' ' .
 		'Klik hier om naar het licentie formulier te gaan.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Maak AUB licentie veld leeg en probeer opnieuw.<br />  Als het probleem blijft bestaan, ' );
define( '_ACA_LICENSE_SUPPORT' , 'Heeft u nog steeds vragen, ' . _ACA_PLEASE_LIC );
define( '_ACA_LICENSE_TWO' , 'u kan uw lincentie handmatig verkrijgen door uw bewijsnummer en site URL (wat in groen aan de bovenkant van deze pagina staat) in te voeren in de Licentie formulier. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );
define('_ACA_ENTER_TOKEN_PATIENCE', 'Na opslaan van uw bewijsnummer zal een licentie automatisch worden gegenereerd. ' .
		' Normaal gesproken is uw bewijsnummer in 2 minuten goed gekeurd. Echter, is sommige gevallen kan het tot 15 minute duren.<br />' .
		'<br />Controleer over een paar minuten uw configuratiescherm opnieuw.  <br /><br />' .
		'Als u geen geldige licentienummer binnen 15 heeft ontvangen, '. _ACA_LICENSE_TWO);
define( '_ACA_ENTER_NOT_YET' , 'Uw bewijsnummer is nog niet geldig verklaard.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Bezoek AUB <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> om de nieuwste versie te downloaden.');
define( '_ACA_NOTIF_UPDATE' , 'Om over nieuwe updates op de hoogte te worden gesteld, vul uw e-mail adres in en klik op inschrijven ');

define('_ACA_THINK_PLUS', 'Als u meer uit uw mailingsysteem wilt halen, denk dan aan Acajoom Plus!');
define('_ACA_THINK_PLUS_1', 'Opeenvolgende auto-responders');
define('_ACA_THINK_PLUS_2', 'Plan de aflevering van uw nieuwsbrief voor een bepaalde datum');
define('_ACA_THINK_PLUS_3', 'Geen limieten/beperkingen meer');
define('_ACA_THINK_PLUS_4', 'en veel meer...');


//since 1.2.2
define( '_ACA_LIST_ACCESS', 'Lijst Toegang' );
define( '_ACA_INFO_LIST_ACCESS', 'Specificeer welke groep gebruikers deze lijst kan zien en abonnee kan worden' );
define( 'ACA_NO_LIST_PERM', 'U heeft niet voldoende rechten om abonnee te worden van deze lijst' );

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', 'Archief');
 define('_ACA_MENU_ARCHIVE_ALL', 'Archief Alles');

//Archive Lists
 define('_FREQ_OPT_0', 'Geen');
 define('_FREQ_OPT_1', 'Elke Week');
 define('_FREQ_OPT_2', 'Elke 2 Weken');
 define('_FREQ_OPT_3', 'Elke Maand');
 define('_FREQ_OPT_4', 'Elk Kwartaal');
 define('_FREQ_OPT_5', 'Elk Jaar');
 define('_FREQ_OPT_6', 'Anders');

define('_DATE_OPT_1', 'Datum gecreëerd');
define('_DATE_OPT_2', 'Datum gewijzigd');

define('_ACA_ARCHIVE_TITLE', 'Stel auto-archief frequentie in');
define('_ACA_FREQ_TITLE', 'Archief frequentie');
define('_ACA_FREQ_TOOL', 'Bepaal hoe vaak dat u wilt dat de Archief Manager uw website content in het archief zet.');
define('_ACA_NB_DAYS', 'Aantal dagen');
define('_ACA_NB_DAYS_TOOL', 'Dit is alleen voor de Anders optie! Geef het aantal dagen op tussen elke Archief.');
define('_ACA_DATE_TITLE', 'Datum type');
define('_ACA_DATE_TOOL', 'Bepaal of het in het archief zetten gedaan moet worden op datum gecreëerd of op datum gewijzigd.');

define('_ACA_MAINTENANCE_TAB', 'Onderhoud instellingen');
define('_ACA_MAINTENANCE_FREQ', 'Onderhoud frequentie');
define( '_ACA_MAINTENANCE_FREQ_TIPS', 'Specificeer de frequentie hoe vaak u de onderhoud wilt laten uitvoeren.' );
define( '_ACA_CRON_DAYS' , 'uur(en)' );

define( '_ACA_LIST_NOT_AVAIL', 'Er is geen lijst beschikbaar.');
define( '_ACA_LIST_ADD_TAB', 'Toevoegen/Bewerken' );

define( '_ACA_LIST_ACCESS_EDIT', 'Mailing Toevoegen/Bewerken Rechten' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', 'Specificeer wat voor groep gebruikers nieuwe mailing kan toevoegen of bewerken voor deze lijst' );
define( '_ACA_MAILING_NEW_FRONT', 'Creëer een nieuwe Mailing' );

define('_ACA_AUTO_ARCHIVE', 'Auto-Archief');
define('_ACA_MENU_ARCHIVE', 'Auto-Archief');

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', '[ISSUENB] = Dit zal vervangen worden door het onderwerp nummer van de nieuwsbrief.');
define('_ACA_TAGS_DATE', '[DATE] = Dit zal vervangen worden door de zend datum.');
define('_ACA_TAGS_CB', '[CBTAG:{field_name}] = Dit zal vervangen worden met de waarde gehaald uit de Community Builder veld: vb. [CBTAG:firstname] ');
define( '_ACA_MAINTENANCE', 'Onderhoud' );


define('_ACA_THINK_PRO', 'Wanneer u professioneel wilt werken, gebruikt u professionele components!');
define('_ACA_THINK_PRO_1', 'Slimme-Nieuwsbrieven');
define('_ACA_THINK_PRO_2', 'Bepaal rechten niveau voor uw lijst');
define('_ACA_THINK_PRO_3', 'Bepaal wie kan bewerken/toevoegen van mailings');
define('_ACA_THINK_PRO_4', 'Meer tags: Voeg uw CB velden toe');
define('_ACA_THINK_PRO_5', 'Joomla contents Auto-archief');
define('_ACA_THINK_PRO_6', 'Database optimalisatie');

define('_ACA_LIC_NOT_YET', 'Uw lincentie is nog niet geldig. Controleer AUB uw licentie tab in het configuratie scherm.');
define('_ACA_PLEASE_LIC_GREEN' , 'Weet zeker dat u de groene informatie verschaft aan de bovenkant van de tab aan onze support team.' );

define('_ACA_FOLLOW_LINK' , 'Verkrijg Uw Licentie');
define( '_ACA_FOLLOW_LINK_TWO' , 'U kan uw licentie verkrijgen door uw bewijsnummer en uw website url in te voeren (dat in groen te zien is aan de bovenkant van deze pagina ) in het Licentie formulier. ');
define( '_ACA_ENTER_TOKEN_TIPS2', ' Klik daarna op Toepassen in het bovenste rechter menu.' );
define( '_ACA_ENTER_LIC_NB', 'Voer uw Licentie in' );
define( '_ACA_UPGRADE_LICENSE', 'Upgrade uw Licentie');
define( '_ACA_UPGRADE_LICENSE_TIPS' , 'Als u een bewijsnummer heeft ontvangen om uw licentie bij te werken voer het hier in, klik op Toepassen en ga verder met nummer <b>2</b> om u nieuwe licentie nummer te verkrijgen.' );

define( '_ACA_MAIL_FORMAT', 'Encodering formaat' );
define( '_ACA_MAIL_FORMAT_TIPS', 'Wat voor formaat wilt u gebruiken voor encoderen van uw mailings, Alleen Tekst of MIME' );
define( '_ACA_ACAJOOM_CRON_DESC_ALT', 'Als u geen toegang heeft tot de cron taak manager op uw website, kan u de gratis JCron component gebruiken om een cron taak van uw website te creëren.' );

//sinds 1.3.1
define('_ACA_SHOW_AUTHOR', 'Toon Auteurs Naam');
define('_ACA_SHOW_AUTHOR_TIPS', 'Selecteer Ja als u de naam van de Auteur wilt toevoegen als u een artikel toevoegd in de Mailing');

//sinds 1.3.5
define('_ACA_REGWARN_NAME','Voer uw naam in.');
define('_ACA_REGWARN_MAIL','Voer een geldig e-mail adres in.');

//sinds 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS','Als u Ja selecteerd, zal de e-mail van de gebruiker toegevoegd worden als parameter aan het einde van uw doorvoer link (uw doorvoer link voor uw module of voor een extern Acajoom formulier).Dat kan handig zijn als u een speciaal script wilt uitvoeren op uw doorvoer pagina.');
define('_ACA_ADDEMAILREDLINK','Voeg e-mail toe aan de doorvoer link');

//sinds 1.6.3
define('_ACA_ITEMID','ItemId');
define('_ACA_ITEMID_TIPS','Dit ItemId word toegevoegd aan uw Acajoom links.');

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
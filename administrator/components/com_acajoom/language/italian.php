<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>Italian language file.</p>
* @copyright (c) 2006 Acajoom Services / All Rights Reserved
* @author Maria Luisa Rossari <support@acajoom.com>
* @version $Id: italian.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

### Generale ###
 //Descrizione Acajoom
define('_ACA_DESC_NEWS', 'Acajoom &egrave; gestione di liste indirizzi, newsletters, risposte automatiche, e tool di comunicazione follow up efficiente con i tuoi utenti e clienti.  ' .
		'Acajoom, il tuo Partner per la Comunicazione!');
define('_ACA_FEATURES', 'Acajoom, il tuo Partner per la Comunicazione!');

// Typi di liste
define('_ACA_NEWSLETTER', 'Newsletter');
define('_ACA_AUTORESP', 'Risposta automatica');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Cartolina');
define('_ACA_PERF', 'Prestazioni');
define('_ACA_COUPON', 'Buono');
define('_ACA_CRON', 'Cronologia');
define('_ACA_MAILING', 'Spedizione');
define('_ACA_LIST', 'Lista');

 //Menu Acajoom
define('_ACA_MENU_LIST', 'Gestione Liste');
define('_ACA_MENU_SUBSCRIBERS', 'Iscritti');
define('_ACA_MENU_NEWSLETTERS', 'Newsletters');
define('_ACA_MENU_AUTOS', 'Risposte automatiche');
define('_ACA_MENU_COUPONS', 'Buoni');
define('_ACA_MENU_CRONS', 'Cronologia');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Cartoline');
define('_ACA_MENU_PERFS', 'Prestazioni');
define('_ACA_MENU_TAB_LIST', 'Liste');
define('_ACA_MENU_MAILING_TITLE', 'Invio');
define('_ACA_MENU_MAILING' , 'Invio');
define('_ACA_MENU_STATS', 'Statistiche');
define('_ACA_MENU_STATS_FOR', 'Statistiche per ');
define('_ACA_MENU_CONF', 'Configurazione');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Info su');
define('_ACA_MENU_LEARN', 'Centro di formazione');
define('_ACA_MENU_MEDIA', 'Media Manager');
define('_ACA_MENU_HELP', 'Aiuto');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Importa');
define('_ACA_MENU_EXPORT', 'Esporta');
define('_ACA_MENU_SUB_ALL', 'Iscrivi tutti');
define('_ACA_MENU_UNSUB_ALL', 'Rimuovi tutti');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archivio');
define('_ACA_MENU_PREVIEW', 'Anteprima');
define('_ACA_MENU_SEND', 'Invio');
define('_ACA_MENU_SEND_TEST', 'Test invio Email');
define('_ACA_MENU_SEND_QUEUE', 'Coda Processi');
define('_ACA_MENU_VIEW', 'Vista');
define('_ACA_MENU_COPY', 'Copia');
define('_ACA_MENU_VIEW_STATS' , 'Vista statistiche');
define('_ACA_MENU_CRTL_PANEL' , 'Panello di controllo');
define('_ACA_MENU_LIST_NEW' , 'Crea una lista');
define('_ACA_MENU_LIST_EDIT' , 'Modifica una lista');
define('_ACA_MENU_BACK', 'Indietro');
define('_ACA_MENU_INSTALL', 'Installazione');
define('_ACA_MENU_TAB_SUM', 'Indice');
define('_ACA_STATUS' , 'Stato');

// messaggi
define('_ACA_ERROR' , 'Errore! ');
define('_ACA_SUB_ACCESS' , 'Privilegi di Accesso');
define('_ACA_DESC_CREDITS', 'Crediti');
define('_ACA_DESC_INFO', 'Informazioni');
define('_ACA_DESC_HOME', 'Homepage');
define('_ACA_DESC_MAILING', 'Lista di spedizione');
define('_ACA_DESC_SUBSCRIBERS', 'Iscritti');
define('_ACA_PUBLISHED','Pubblicato');
define('_ACA_UNPUBLISHED','Non Pubblicato');
define('_ACA_DELETE','Elimina');
define('_ACA_FILTER','Filtra');
define('_ACA_UPDATE','Aggiorna');
define('_ACA_SAVE','Salva');
define('_ACA_CANCEL','Cancella');
define('_ACA_NAME','Nome');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Seleziona');
define('_ACA_ALL','di');
define('_ACA_SEND_A', 'Invia a ');
define('_ACA_SUCCESS_DELETED', 'eliminato con successo');
define('_ACA_LIST_ADDED', 'Lista creata con successo');
define('_ACA_LIST_COPY', 'Lista copiata con successo');
define('_ACA_LIST_UPDATED', 'Lista aggiornata con successo');
define('_ACA_MAILING_SAVED', 'Mailing salvata con successo.');
define('_ACA_UPDATED_SUCCESSFULLY', 'aggiornato con successo.');

### Informazioni iscritti ###
//info iscrizione e rimozione
define('_ACA_SUB_INFO', 'Informazioni Iscritto\'i');
define('_ACA_VERIFY_INFO', 'Verifica il link che hai inserito, manca qualche informazione.');
define('_ACA_INPUT_NAME', 'Nome');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Ricevi HTML?');
define('_ACA_TIME_ZONE', 'Fuso orario');
define('_ACA_BLACK_LIST', 'Lista nera');
define('_ACA_REGISTRATION_DATE', 'Data di registrazione Utente');
define('_ACA_USER_ID', 'Id Utente');
define('_ACA_DESCRIPTION', 'Descrizione');
define('_ACA_ACCOUNT_CONFIRMED', 'Il tuo profilo &egrave; stato attivato.');
define('_ACA_SUB_SUBSCRIBER', 'Iscritto');
define('_ACA_SUB_PUBLISHER', 'Editore');
define('_ACA_SUB_ADMIN', 'Amministratore');
define('_ACA_REGISTERED', 'Registrato');
define('_ACA_SUBSCRIPTIONS', 'Iscrizioni');
define('_ACA_SEND_UNSUBCRIBE', 'Invia messaggio di cancellazione');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Clicca Si per inviare una mail di cancellazione messaggio di conferma.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Conferma la tua iscrizione');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Conferma cancellazione');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Ciao [NAME],<br />' .
	'Solo qualche passo e sarai iscritto alla lista.  Clicca sul link seguente per confermare la tua iscrizione.' .
	'<br /><br />[CONFIRM]<br /><br />Per informazioni contatta il webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Ti confermiamo che sei stato rimosso dalla lista.  Ci dispiace che tu abbia deciso di cancellarti ma se dovessi decidere di iscriverti nuovamente, potrai farlo in qualunque momento dal sito.  Per ogni informazione contatta il nostro webmaster.');

// Acajoom iscritti
define('_ACA_SIGNUP_DATE', 'Data firma');
define('_ACA_CONFIRMED', 'Confermato');
define('_ACA_SUBSCRIB', 'Iscritto');
define('_ACA_HTML', 'HTML mailings');
define('_ACA_RESULTS', 'Risultati');
define('_ACA_SEL_LIST', 'Seleziona una lista');
define('_ACA_SEL_LIST_TYPE', '- Seleziona il tipo di lista -');
define('_ACA_SUSCRIB_LIST', 'Lista di tutti gli iscritti');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Iscritti per: ');
define('_ACA_NO_SUSCRIBERS', 'Nessun iscritto trovato per queste liste.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Ti &egrave; stata inviata una mail di conferma. Per cortesia controlla la posta in arrivo e clicca sul link che trovi nel messaggio per dare conferma.<br />' .
		'La conferma &egrave; necessaria perch&egrave; la tua iscrizione venga attivata.');
define('_ACA_SUCCESS_ADD_LIST', 'Sei stato aggiunto alla lista con successo.');


 // info Iscrizione
define('_ACA_CONFIRM_LINK', 'Clicca qui per confermare la tua iscrizione');
define('_ACA_UNSUBSCRIBE_LINK', 'Clicca qui per rimuoverti dalla lista');
define('_ACA_UNSUBSCRIBE_MESS', 'Il tuo indirizzio di email &egrave; stato rimosso dalla lista.');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Tutte le email previste sono state inviate con successo.');
define('_ACA_MALING_VIEW', 'Vista di tutte le liste di invio');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Sei sicuro di volerti rimuovere da questa lista?');
define('_ACA_MOD_SUBSCRIBE', 'Iscriviti');
define('_ACA_SUBSCRIBE', 'Iscriviti');
define('_ACA_UNSUBSCRIBE', 'Cancellati');
define('_ACA_VIEW_ARCHIVE', 'Vista archivio');
define('_ACA_SUBSCRIPTION_OR', ' oppure clicca qui per modificare i tuoi dati');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Questo indirizzo di email &egrave; gi&agrave; stato registrato.');
define('_ACA_SUBSCRIBER_DELETED', 'Cancellazione avvenuta con successo.');


### Pannello di controllo utente ###
 //Menu utente
define('_UCP_USER_PANEL', 'Panello di Controllo utente');
define('_UCP_USER_MENU', 'Menu utente');
define('_UCP_USER_CONTACT', 'Le mie iscrizioni');
 //Acajoom Menu Cronologia
define('_UCP_CRON_MENU', 'Amministrazione cronologia');
define('_UCP_CRON_NEW_MENU', 'Nuova cronologia');
define('_UCP_CRON_LIST_MENU', 'Lista cronologie');
 //Acajoom Menu Coupon
define('_UCP_COUPON_MENU', 'Amministrazione buoni');
define('_UCP_COUPON_LIST_MENU', 'Lista buoni');
define('_UCP_COUPON_ADD_MENU', 'Aggiungi buono');

### liste ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Descrizione');
define('_ACA_LIST_T_LAYOUT', 'Modello');
define('_ACA_LIST_T_SUBSCRIPTION', 'Iscrizione');
define('_ACA_LIST_T_SENDER', 'Informazioni mittente');

define('_ACA_LIST_TYPE', 'Tipo lista');
define('_ACA_LIST_NAME', 'Nome lista');
define('_ACA_LIST_ISSUE', 'Invio #');
define('_ACA_LIST_DATE', 'Data invio');
define('_ACA_LIST_SUB', 'Oggetto');
define('_ACA_ATTACHED_FILES', 'Allegati');
define('_ACA_SELECT_LIST', 'Scegli la lista da modificare!');

// Box risposta automatica
define('_ACA_AUTORESP_ON', 'Tipo lista');
define('_ACA_AUTO_RESP_OPTION', 'Opzioni risposta automatica');
define('_ACA_AUTO_RESP_FREQ', 'Gli iscritti possono scegliere la frequenza');
define('_ACA_AUTO_DELAY', 'Dilazione (in giorni)');
define('_ACA_AUTO_DAY_MIN', 'Frequenza minima');
define('_ACA_AUTO_DAY_MAX', 'Frequenza massima');
define('_ACA_FOLLOW_UP', 'Specifica il follow up risposta automatica');
define('_ACA_AUTO_RESP_TIME', 'Gli iscritti possono scegliere l\'ora');
define('_ACA_LIST_SENDER', 'Lista invio');

define('_ACA_LIST_DESC', 'Descrizione lista');
define('_ACA_LAYOUT', 'Modello');
define('_ACA_SENDER_NAME', 'Nome mittente');
define('_ACA_SENDER_EMAIL', 'Email mittente');
define('_ACA_SENDER_BOUNCE', 'Indirizzo mittente respinto');
define('_ACA_LIST_DELAY', 'Dilazione');
define('_ACA_HTML_MAILING', 'invio HTML ?');
define('_ACA_HTML_MAILING_DESC', '(se lo cambi devi salvare e rientrare per vedere le modifiche.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Nascondi dal frontend?');
define('_ACA_SELECT_IMPORT_FILE', 'Scegli il file da importare');;
define('_ACA_IMPORT_FINISHED', 'Importazione completata');
define('_ACA_DELETION_OFFILE', 'Cancellazione del file');
define('_ACA_MANUALLY_DELETE', 'fallita, devi eliminarlo manualmente');
define('_ACA_CANNOT_WRITE_DIR', 'Impossibile modificare la directory');
define('_ACA_NOT_PUBLISHED', 'Invio non possibile, la lista non &egrave; pubblicata.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Clicca SI per pubblicare la lista');
define('_ACA_INFO_LIST_NAME', 'Inserisci il nome della tua lista qui. Puoi identificare la lista con questo nome.');
define('_ACA_INFO_LIST_DESC', 'Inserisci una breve descrizione della tua lista qui. Questa descrizione sar&agrave; visibile ai visitatori del sito.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Inserisci il nome del mittente. Questo sar&agrave; il nome visualizzato agli iscritti che ricevono messaggi da questa lista.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Inserisci l\'indirizzo email mittente.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Inserisci l\'indirizzo email mittente respinto. Si raccomanda che sia lo stesso del mittente: se fosse diverso, i filtri spam daranno al messaggio un alto grado di spam.');
define('_ACA_INFO_LIST_AUTORESP', 'Scegli il tipo di mailings per questa newsletter. <br />' .
		'Newsletter: newsletter normale<br />' .
		'Auto-responder: un auto-responder &egrave; una newsletter inviata automaticamente attraverso il sito ad intervalli regolari.');
define('_ACA_INFO_LIST_FREQUENCY', 'Abilita gli utenti a scegliere quanto spesso vogliono ricevere la newsletter.  Questo offre molta flessibilit&agrave; agli utenti.');
define('_ACA_INFO_LIST_TIME', 'Permetti all\'utente di scegliere a che ora del giorno preferisce ricevere la newsletter.');
define('_ACA_INFO_LIST_MIN_DAY', 'Definisci qual\'&egrave; la frequenza minima per ricevere la newsletter che un utente pu&ograve; scegliere');
define('_ACA_INFO_LIST_DELAY', 'Specifica la dilazione tra questa newsletter automatica e la precedente.');
define('_ACA_INFO_LIST_DATE', 'Specifica la data di di pubblicazione della lista delle newsletters che vuoi pubblicare dilazionate. <br /> FORMAT : AAAA-MM-GG HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Definisci qual\'&egrave; la frequenza massima per ricevere la newsletter');
define('_ACA_INFO_LIST_LAYOUT', 'Inserisci il modello della tua newsletter qui. Puoi inserire qualsiasi modello.');
define('_ACA_INFO_LIST_SUB_MESS', 'Questo messaggio verr&agrave; inviato al nuovo iscritto che si registra per la prima volta. Puoi inserire il testo che vuoi qui.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Questo messaggio verr&agrave; inviato all\'iscritto che si rimuove. Puoi inserire il testo che vuoi qui.');
define('_ACA_INFO_LIST_HTML', 'Seleziona il checkbox se vuoi inviare in formato HTML. Gli iscritti saranno in grado di specificare se vogliono ricevere in formato HTML o in formato solo Testo quando si iscrivono ad una newsletter.');
define('_ACA_INFO_LIST_HIDDEN', 'Clicca SI per nascondere la lista dal frontend, gli utenti non potranno iscriversi ma tu puoi ancora mandare mailings.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Sottoscrivi tutti gli utenti a questa lista?<br /><B>Nuovi Utenti:</B> verr&agrave; inserito ogni nuovo utente che si registra sul sito.<br /><B>Tutti gli utenti:</B> verr&agrave; registrato ogni nuovo utente nel database.<br />(tutte queste opzioni supportano Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Determina il livello di accesso dal frontend. Mostra o nasconde la mailing ai gruppi di utenti che non hanno accesso ad essa in modo che possano iscriversi.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Determina il livello di accesso del gruppo di utenti a cui vuoi permettere di poter modificare. Quei gruppi di utenti potranno modificare la newsletter ed inviarla sia dal frontend che dal beckend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Se vuoi che la risposta automatica recuperi un\'altra volta l\'ultimo messaggio, devi specificare qui la funzione di seguimi.');
define('_ACA_INFO_LIST_ACA_OWNER', 'ID della persona che ha creato la lista.');
define('_ACA_INFO_LIST_WARNING', 'Quest\'ultima opzione &egrave; disponibile solo una volta durante la creazione della lista.');
define('_ACA_INFO_LIST_SUBJET', 'Oggetto della mailing. Questo &egrave; l\'oggetto della email che l\'iscritto ricever&agrave;.');
define('_ACA_INFO_MAILING_CONTENT', 'Questo &egrave; il corpo del messaggioche vuoi inviare.');
define('_ACA_INFO_MAILING_NOHTML', 'Inserisci qui il corpo del messaggio che vuoi inviare agli iscritti che scelgono di non ricevere in formato HTML. <BR/> NOTA: se lo lasci in bianco Acajoom convertir&agrave; automaticamente l\'HTML in solo testo.');
define('_ACA_INFO_MAILING_VISIBLE', 'Clicca SI per visualizzare la mailing dal frontend.');
define('_ACA_INSERT_CONTENT', 'Inserisci il contenuto esistente');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Buono inviato con successo!');
define('_ACA_CHOOSE_COUPON', 'Scegli il buono');
define('_ACA_TO_USER', ' a questo utente');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Ogni ora');
define('_ACA_FREQ_CH2', 'Ogni 6 ore');
define('_ACA_FREQ_CH3', 'Ogni 12 ore');
define('_ACA_FREQ_CH4', 'Quotidianamente');
define('_ACA_FREQ_CH5', 'Settimanalmente');
define('_ACA_FREQ_CH6', 'Mensilmente');
define('_ACA_FREQ_NONE', 'No');
define('_ACA_FREQ_NEW', 'Nuovi utenti');
define('_ACA_FREQ_ALL', 'Tutti gli utenti');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Cronologia Acajoom?');
define('_ACA_LABEL_FREQ_TIPS', 'Clicca SI se vuoi usarlo per una cronologia Acajoom, No per ogni altro tipo di cronologia.<br />'.
	'Se clicchi SI non serve specificare l\'indirizzo, sar&agrave; automaticamente aggiunto.');
define('_ACA_SITE_URL' , 'URL del tuo sito');
define('_ACA_CRON_FREQUENCY' , 'Frequenza cronologia');
define('_ACA_STARTDATE_FREQ' , 'Data di inizio');
define('_ACA_LABELDATE_FREQ' , 'Specifica la data');
define('_ACA_LABELTIME_FREQ' , 'Specifica l\'ora');
define('_ACA_CRON_URL', 'URL cronologia');
define('_ACA_CRON_FREQ', 'Frequenza');
define('_ACA_TITLE_CRONLIST', 'Lista cronologia');
define('_NEW_LIST', 'Crea una nuova lista');

//title CRON form
define('_ACA_TITLE_FREQ', 'Modifica cronologia');
define('_ACA_CRON_SITE_URL', 'Inserisci un indirizzo di sito valido, iniziando con http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Tutte le mailings');
define('_ACA_EDIT_A', 'Modifica a');
define('_ACA_SELCT_MAILING', 'Seleziona una lista nel menu a tendina per aggiungere una nuova mailing.');
define('_ACA_VISIBLE_FRONT', 'Visibile nel frontend');

// mailer
define('_ACA_SUBJECT', 'Oggetto');
define('_ACA_CONTENT', 'Contenuto');
define('_ACA_NAMEREP', '[NAME] = Verr&agrave; sostituito con il cognome della persona iscritta. Serve per personalizzare la mail<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Verr&agrave; sostituito dal nome dell\'iscritto.<br />');
define('_ACA_NONHTML', 'Versione Non-html');
define('_ACA_ATTACHMENTS', 'Allegati');
define('_ACA_SELECT_MULTIPLE', 'Tieni premuto il tasto controllo  (o comando) per selezionare allegati multipli.<br />' .
		'I documenti visualizzati in questa lista di allegati sono residenti nella cartella degli allegati: puoi cambiare questo percorso nel pannello di controllo.');
define('_ACA_CONTENT_ITEM', 'Contenuti');
define('_ACA_SENDING_EMAIL', 'Invio email');
define('_ACA_MESSAGE_NOT', 'Il messaggio non pu&ograve; essere inviato');
define('_ACA_MAILER_ERROR', 'Errore Mailer');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Messaggio inviato correttamente');
define('_ACA_SENDING_TOOK', 'Accettato invio mailing');
define('_ACA_SECONDS', 'secondi');
define('_ACA_NO_ADDRESS_ENTERED', 'Nessun indirizzo inserito');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Cambia sottoscrizioni');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Cambia la tua sottoscrizione');
define('_ACA_WHICH_EMAIL_TEST', 'Indica a quale indirizzo email vuoi mandare questo test o anteprima');
define('_ACA_SEND_IN_HTML', 'Invia in HTML (per html mailings)?');
define('_ACA_VISIBLE', 'Visibile');
define('_ACA_INTRO_ONLY', 'Solo Intro');

// stats
define('_ACA_GLOBALSTATS', 'Statistiche globali');
define('_ACA_DETAILED_STATS', 'Dettagli statistiche');
define('_ACA_MAILING_LIST_DETAILS', 'Dettagli Mailinglist');
define('_ACA_SEND_IN_HTML_FORMAT', 'Inviata in HTML');
define('_ACA_VIEWS_FROM_HTML', 'Viste (da html mails)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Inviata in formato testo');
define('_ACA_HTML_READ', 'HTML letti');
define('_ACA_HTML_UNREAD', 'HTML non letti');
define('_ACA_TEXT_ONLY_SENT', 'Solo testo');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Statistiche');
define('_ACA_SUBSCRIBER_CONFIG', 'Iscritti');
define('_ACA_AUTO_CONFIG', 'Cronologia');
define('_ACA_MISC_CONFIG', 'Varie');
define('_ACA_MAIL_SETTINGS', 'Parametri Mail');
define('_ACA_MAILINGS_SETTINGS', 'Parametri Mailings');
define('_ACA_SUBCRIBERS_SETTINGS', 'Parametri Iscritti');
define('_ACA_CRON_SETTINGS', 'Parametri Cronologia');
define('_ACA_SENDING_SETTINGS', 'Parametri Invio');
define('_ACA_STATS_SETTINGS', 'Parametri Statistiche');
define('_ACA_LOGS_SETTINGS', 'Parametri Logs');
define('_ACA_MISC_SETTINGS', 'Parametri vari');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Da Email');
define('_ACA_SEND_MAIL_NAME', 'Da Nome');
define('_ACA_MAILSENDMETHOD', 'Metodo invio mail');
define('_ACA_SENDMAILPATH', 'Percorso Sendmail');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP autenticazione richiesta');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Scegli si se il tuo SMTP server richiede autenticazione');
define('_ACA_SMTPUSERNAME', 'SMTP nome utente');
define('_ACA_SMTPUSERNAME_TIPS', 'Inserisci il nome utente se il tuo SMTP server richiede autenticazione');
define('_ACA_SMTPPASSWORD', 'SMTP password');
define('_ACA_SMTPPASSWORD_TIPS', 'Inserisic la password se il tuo SMTP server richiede autenticazione');
define('_ACA_USE_EMBEDDED', 'Usa immagini incorporate in HTML');
define('_ACA_USE_EMBEDDED_TIPS', 'Seleziona si se le immagini del contenuto allegato possono essere inserite nel codice HTML, o no per usare i tag immagine di default del portale.');
define('_ACA_UPLOAD_PATH', 'Path Upload/allegati');
define('_ACA_UPLOAD_PATH_TIPS', 'Puoi specificare il percorso ad una cartella per l\'upload.<br />' .
	'Assicurati che la cartella esista altrimenti creane una.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Abilita non registrati');
define('_ACA_ALLOW_UNREG_TIPS', 'Seleziona SI se vuoi abilitare gli utenti all\'iscrizione alle newsletters senza registrazione al portale.');
define('_ACA_REQ_CONFIRM', 'Richiede conferma');
define('_ACA_REQ_CONFIRM_TIPS', 'Seleziona SI se richiedi che un utente non registrato confermi il suo indirizzo email.');
define('_ACA_SUB_SETTINGS', 'Parametri Iscrizione');
define('_ACA_SUBMESSAGE', 'Messaggio Iscrizione');
define('_ACA_SUBSCRIBE_LIST', 'Iscriviti a una newsletter');

define('_ACA_USABLE_TAGS', 'Tags abilitati');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Crea un collegamento cliccabile dove l\'iscritto pu&ograve; confermare la sua richiesta. &Egrave; <strong>richiesto</strong> per far funzionare Acajoom correttamente.<br />'
.'<br />[NAME] = Verr&agrave; sostituito dal cognome delliscritto per personalizzare la mail.<br />'
.'<br />[FIRSTNAME] = Verr&agrave; sostituito dal nome dell\'iscritto, il nome &egrave; DEFINITO come primo nome inserito dall\'iscritto.<br />');
define('_ACA_CONFIRMFROMNAME', 'Nome conferma');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Inserisci il mome da visualizzare nella lettera di conferma.');
define('_ACA_CONFIRMFROMEMAIL', 'Email conferma');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Inserisci l\'indirizzo email da visualizzare nella lettera di conferma.');
define('_ACA_CONFIRMBOUNCE', 'Email conferma respinta');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Inserisci l\'indirizzo da visualizzare per la lettera di conferma respinta.');
define('_ACA_HTML_CONFIRM', 'Conferma HTML');
define('_ACA_HTML_CONFIRM_TIPS', 'Seleziona si per inviare la lettera di conferma in HTML se lutente lo permette.');
define('_ACA_TIME_ZONE_ASK', 'Ora locale');
define('_ACA_TIME_ZONE_TIPS', 'Scegli SI se vuoi che l\'utente inserisca l\'ora locale. L\'invio delle mail verr&agrave effettuato sulla base dell\'ora locale quando applicabile');

 // Set up cronologia
define('_ACA_TIME_OFFSET_URL', 'Clicca qui per settare i parametri di scostamento nel pannello di configurazione globale -> Locale tab');
define('_ACA_TIME_OFFSET_TIPS', 'Setta l\'ora del tuo server cosi che i dati registrati e l\'ora siano esatti');
define('_ACA_TIME_OFFSET', 'Time offset');
define('_ACA_CRON_TITLE', 'Funzione di cronologia');
define('_ACA_CRON_DESC','<br />Usando la funzione di cronologia puoi assegnare una funzione automatica per il tuo sito Joomla!<br />' .
		'Per farlo ti serve aggiungere nel tuo pannello di controllo crontab il seguente comando:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Se ti serve aiuto per sistemarlo o hai qualche problema, visita il nostro forum  <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pausa in secondi ogni numero configurato di emails');
define('_ACA_PAUSEX_TIPS', 'Inserisci un numero di secondi che Acajoom dar&agrave; al SMTP server per inviare i messaggi prima di procedere con il successivo gruppo di messaggi.');
define('_ACA_EMAIL_BET_PAUSE', 'Emails tra pause');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Il numero di emails da inviare prima della pausa.');
define('_ACA_WAIT_USER_PAUSE', 'Attesa per input utente');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Se lo script debba aspettare un input utente nella pausa.');
define('_ACA_SCRIPT_TIMEOUT', 'Script timeout');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Il numero di minuti in cui lo script &egrave; in grado di girare (0 per illimitato).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Abilita la lettura delle statistiche');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Seleziona si se vuoi il registro del numero di viste. Questa tecnica pu&ograve; essere usata solo con HTML mailings');
define('_ACA_LOG_VIEWSPERSUB', 'Registro di viste per iscritto');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Seleziona si se vuoi il registro del numero di viste per iscritto. Questa tecnica pu&ograve; essere usata solo con HTML mailings');
// Logs settings
define('_ACA_DETAILED', 'Dettaglio logs');
define('_ACA_SIMPLE', 'Logs semplificati');
define('_ACA_DIAPLAY_LOG', 'Visualizza logs');
define('_ACA_DISPLAY_LOG_TIPS', 'Seleziona SI se vuoi visualizzare i logs mentre si invia.');
define('_ACA_SEND_PERF_DATA', 'Dati di funzionamento');
define('_ACA_SEND_PERF_DATA_TIPS', 'Seleziona SI se vuoi permettere a Acajoom di inviare reports ANONIMI sulla tua configurazione, il numero degli iscritti ad una lsita ed il tempo necessario per inviare la lista. Questo ci dar&agrave; una idea delle prestazioni Acajoom e CI AIUTER&Agrave; a perfezionare Acajoom per i futuri rilasci.');
define('_ACA_SEND_AUTO_LOG', 'Invia il log per la risposta automatica');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Seleziona SI se vuoi inviare un log per email ogni volta in cui la coda &egrave elaborata.  ATTENZIONE: questo pu&ograve generare un numero enorme di emails.');
define('_ACA_SEND_LOG', 'Log di invio');
define('_ACA_SEND_LOG_TIPS', 'Se un log della mailing deve essere inviato all\'indirizzo email dell\'utente che ha spedito la mailing.');
define('_ACA_SEND_LOGDETAIL', 'Invia il log dettagliato');
define('_ACA_SEND_LOGDETAIL_TIPS', 'I dettagli includono info sul successo o il fallimento invio mail per ogni iscritto e una descrizione delle informazioni. Semplice invia solo la descrizione.');
define('_ACA_SEND_LOGCLOSED', 'Invia il log se la connessione &egrave; chiusaS');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Con questa opzione l\'utente che ha spedito la lista ricever&agrave; anche un report per email.');
define('_ACA_SAVE_LOG', 'Log di salvataggio');
define('_ACA_SAVE_LOG_TIPS', 'Se un log della mailing deve essere aggiunto al file di log.');
define('_ACA_SAVE_LOGDETAIL', 'Dettaglio log di salvataggio');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'I dettagli includono informazioni sul successo o il fallimento invio per ogni iscritto e una descrizione delle informazioni. Semplice invia solo la descrizione.');
define('_ACA_SAVE_LOGFILE', 'Dettaglio log di salvataggio');
define('_ACA_SAVE_LOGFILE_TIPS', 'File in cui vengono aggiunte le informazioni sui log. Questo file pu&ograve; diventare molto esteso.');
define('_ACA_CLEAR_LOG', 'Pulisci log');
define('_ACA_CLEAR_LOG_TIPS', 'Pulisce il file di log.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Ultima coda eseguita');
define('_ACA_CP_TOTAL', 'Totale');
define('_ACA_MAILING_COPY', 'Mailing copiata con successo!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Mostra guida');
define('_ACA_SHOW_GUIDE_TIPS', 'Mostra la guida all\'inizio per aiutare i nuovi utenti a creare una newsletter, una risposta automatica ed a settare i parametri per Acajoom correttamente.');
define('_ACA_AUTOS_ON', 'Usa Risposta automatica');
define('_ACA_AUTOS_ON_TIPS', 'Scegli NO se non vuoi usare la risposta automatica, tutte le risposte automatiche verranno disattivate.');
define('_ACA_NEWS_ON', 'Usa Newsletters');
define('_ACA_NEWS_ON_TIPS', 'Scegli NO se non vuoi usare le Newsletters, tutte le opzioni newsletters saranno disattivate.');
define('_ACA_SHOW_TIPS', 'Mostra suggerimenti');
define('_ACA_SHOW_TIPS_TIPS', 'Mostra i suggerimenti per aiutare gli utenti ad usare Acajoom in modo efficace.');
define('_ACA_SHOW_FOOTER', 'Mostra la coda');
define('_ACA_SHOW_FOOTER_TIPS', 'Indica se il footer contente il copyright deve essere mostrato oppure no.');
define('_ACA_SHOW_LISTS', 'Mostra le liste nel frontend');
define('_ACA_SHOW_LISTS_TIPS', 'Quando l\'utente non &grave; registrato mostra la lista di newsletters cui pu&ograve; iscriversi, un bottone di vista archivio newsletter o semplicemente il modulo di login per la registrazione.');
define('_ACA_CONFIG_UPDATED', 'I dettagli di configurazione sono stati aggiornati!');
define('_ACA_UPDATE_URL', 'Aggiorna URL');
define('_ACA_UPDATE_URL_WARNING', 'ATTENZIONE! Non cambiare questa URL a meno che tu ne abbia chiesto l\'autorizzazione al Team Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Per esempio: http://www.acajoom.com/update/ (compreso lo slash finale)');

// modulo
define('_ACA_EMAIL_INVALID', 'Email immessa non valida.');
define('_ACA_REGISTER_REQUIRED', 'Devi prima registrarti per poterti iscrivere ad una newsletter.');

// Box livello Accessi
define('_ACA_OWNER', 'Il creatore della lista:');
define('_ACA_ACCESS_LEVEL', 'Setta il livello di accesso per la lista');
define('_ACA_ACCESS_LEVEL_OPTION', 'Opzioni di livello di accesso');
define('_ACA_USER_LEVEL_EDIT', 'Seleziona quale livello di accesso utente &egrave; abilitato a curare l\'edizione di una mailing (dal frontend o dal backend) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Quotidianamente');
define('_ACA_AUTO_DAY_CH2', 'Quotidianamente no weekend');
define('_ACA_AUTO_DAY_CH3', 'Ogni altro giorno');
define('_ACA_AUTO_DAY_CH4', 'Ogni altro giorno no weekend');
define('_ACA_AUTO_DAY_CH5', 'Settimanalmente');
define('_ACA_AUTO_DAY_CH6', 'Bi-settimanalmente');
define('_ACA_AUTO_DAY_CH7', 'Mensilmente');
define('_ACA_AUTO_DAY_CH9', 'Annualmente');
define('_ACA_AUTO_OPTION_NONE', 'No');
define('_ACA_AUTO_OPTION_NEW', 'Nuovi Utenti');
define('_ACA_AUTO_OPTION_ALL', 'Tutti gli Utenti');

//
define('_ACA_UNSUB_MESSAGE', 'Messaggio Email di rimozione');
define('_ACA_UNSUB_SETTINGS', 'Parametri di rimozione');
define('_ACA_AUTO_ADD_NEW_USERS', 'Iscrivi automaticamente Utenti?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Non ci sono aggiornamenti disponibili al momento.');
define('_ACA_VERSION', 'Versione Acajoom');
define('_ACA_NEED_UPDATED', 'Files da aggiornare:');
define('_ACA_NEED_ADDED', 'Files da aggiungere:');
define('_ACA_NEED_REMOVED', 'Files da rimuovere:');
define('_ACA_FILENAME', 'Nome file:');
define('_ACA_CURRENT_VERSION', 'Versione attuale:');
define('_ACA_NEWEST_VERSION', 'Nuova versione:');
define('_ACA_UPDATING', 'Aggiornamento');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'I files sono stati aggiornati con successo.');
define('_ACA_UPDATE_FAILED', 'Aggiornamento fallito!');
define('_ACA_ADDING', 'Aggiunte');
define('_ACA_ADDED_SUCCESSFULLY', 'Aggiunti con successo.');
define('_ACA_ADDING_FAILED', 'Aggiunta fallita!');
define('_ACA_REMOVING', 'Rimossi');
define('_ACA_REMOVED_SUCCESSFULLY', 'Rimossi con successo.');
define('_ACA_REMOVING_FAILED', 'Rimozione fallita!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installa una versione diversa');
define('_ACA_CONTENT_ADD', 'Aggiungi contenuto');
define('_ACA_UPGRADE_FROM', 'Importa dati (newsletters e iscritti\' informazioni) da');
define('_ACA_UPGRADE_MESS', 'Non c\'&egrave; pericolo nei dati esistenti. <br /> Questo processo impoter&agrave; semplicemente i dati nel database Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Continua invio');

// Acajoom message
define('_ACA_UPGRADE1', 'Puoi facilmente importare i tuoi utenti e le newsletters da');
define('_ACA_UPGRADE2', 'a Acajoom nel pannello aggiornamenti.');
define('_ACA_UPDATE_MESSAGE', 'Una nuova versione di Acajoom &egrave; disponibile! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Clicca qui per aggiornare!');
define('_ACA_CRON_SETUP', 'Perch&egrave; le risposte automatiche possano essere inviate devi settare i parametri della funzione cronologia.');
define('_ACA_THANKYOU', 'Grazie per aver scelto Acajoom, il tuo partner nella communicazione!');
define('_ACA_NO_SERVER', 'Il server per l\'aggiornamento non &egrave; disponibile, riprova pi&ugrave; tardi.');
define('_ACA_MOD_PUB', 'Il modulo Acajoom non &egrave; pubblicato.');
define('_ACA_MOD_PUB_LINK', 'Clicca qui per pubblicarlo!');
define('_ACA_IMPORT_SUCCESS', 'Importato con successo');
define('_ACA_IMPORT_EXIST', 'Iscritto gi&agrave; presente nel database');


// Acajoom\'s Guide
define('_ACA_GUIDE', '\'s Wizard');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom presenta molte caratteristiche e questo wizard ti guider&agrave; attraverso un processo di 4 facili passi will per permetterti di inviare le tue newsletters e risposte automatiche!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Prima di tutto, ti serve aggiungere una lista.  Una lista potrebbe essere di due tipi, o una newsletter o una risposta automatica.' .
		' Nella lista definisci i diversi parametri per abilitare l\'invio delle newsletters o delle risposte automatiche: mittente, layout, iscritti\' messaggio di benvenuto, etc...
<br /><br />Puoi organizzare la tua prima lista qui: <a href="index2.php?option=com_acajoom&act=list" >crea una lista</a> e clicca il bottone Nuovo.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom ti fornisce un modo facile per importare tutti i dati da un precedente sistema di newsletter.<br />' .
		' Vai in Aggiornamento nel pannello di controllo e scegli il tuo precedente sistema di newsletters per importare tutte le newsletters e gli iscritti.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: l\'importazione &egrave; LIBERA da rischi e non interessa in alcun modo i dati del tuo precedente sistema di newsletter</span><br />' .
		'Dopo l\'importazione sarai in grado di organizzare i tuoi iscritti e le mailings direttamente da Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Grande, la tua prima lista &egrave; allestita!  Puoi ora scrivere il tuo primo  %s.  Per crearlo vai a: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Amministrazione Risposta Automatica');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Amministrazione Newsletter');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' e seleziona il tuo %s. <br /> Poi scegli il tuo %s nella lista del menu a tendina.  Crea la tua prima lista di indirizzi cliccando su Nuovo ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Prima di inviare la tua prima newsletter controlla la configurazione della mail.'.
		'Vai alla <a href="index2.php?option=com_acajoom&act=configuration" >pagina di configurazione</a> per verificare i parametri della mail. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Quando sei pronto torna indietro al menu delle Newsletters, seleziona la tua lista di indirizzi e clicca Invio');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Per l\'invio delle tue risposte automatiche devi prima settare una funzione di cronologia sul tuo server. ' .
		' Vai al Cron tab nel pannello di controllo.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >clicca qui</a> per imparare come organizzare un task di cronologia. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Assicurati di aver pubblicato il modulo Acajoom in modo che gli utenti possano iscriversi alla lista.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', 'Ora puoi anche organizzare una risposta automatica.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', 'Ora puoi anche organizzare una newsletter.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Voila! Sei pronto per comunicare efficacemente con i tuoi ospiti e utenti. Questo wizard terminer&agrave; non appena avrai inserito una seconda lista o spegnerlo nel <a href="index2.php?option=com_acajoom&act=configuration" >pannello di configurazione</a>.' .
		'<br /><br />  Per ulteriori domande sull\'uso Acajoom, vai al ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Troverai molte informazioni su come comunicare efficacemente con i tuoi iscritti su <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Grazie per aver scelto di usare Acajoom. Il Tuo Partner per la Comunicazione!</b> ');
define('_ACA_GUIDE_TURNOFF', 'Il wizard si sta ora spegnendo!');
define('_ACA_STEP', 'STEP ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Configurazione Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Installazione riuscita');
define('_ACA_INSTALL_ERROR', 'Errore installatione');
define('_ACA_INSTALL_BOT', 'Plugin (Bot)Acajoom');
define('_ACA_INSTALL_MODULE', 'Modulo Acajoom');
//Others
define('_ACA_JAVASCRIPT','!Attenzione! Per un funzionamento corretto deve essere abilitato Javascript.');
define('_ACA_EXPORT_TEXT','Gli iscritti sono esportati in base alla lista che hai scelto. <br />Iscritti esportati per lista');
define('_ACA_IMPORT_TIPS','Iscritti importati. Le info nel file devono avere il seguente formato: <br />' .
		'Nome,email,riceviHTML(1/0),confermato(1/0)');
define('_ACA_SUBCRIBER_EXIT', '&egrave; gi&agrave; iscritto');
define('_ACA_GET_STARTED', 'Clicca qui per iniziare!');

//News since 1.0.1
define('_ACA_WARNING_1011','Warning: 1011: Aggiornamento non eseguito a causa di restrizioni del tuo server.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Scegli quale indirizzo viene mostrato come mittente.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Scegli quale nome viene mostrato come mittente.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Scegli il sistema di email che vuoi usare: PHP mail function, <span>Sendmail</span> or SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Questa &egrave; la directory del Mail server');
define('_ACA_LIST_T_TEMPLATE', 'Template');
define('_ACA_NO_MAILING_ENTERED', 'Mailing non fornita');
define('_ACA_NO_LIST_ENTERED', 'Lista non fornita');
define('_ACA_SENT_MAILING' , 'Mailings inviate');
define('_ACA_SELECT_FILE', 'Seleziona un file per ');
define('_ACA_LIST_IMPORT', 'Check sulla lista(e) di cui vuoi associare gli iscritti.');
define('_ACA_PB_QUEUE', 'Iscritto inserito ma ci sono problemi a collegarlo/a alla lista(e). Controlla manualmente.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Aggiornamento importante!');
define('_ACA_UPDATE_MESS2' , 'Patch and small fixes.');
define('_ACA_UPDATE_MESS3' , 'Nuova versione.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 is required to update.');
define('_ACA_UPDATE_IS_AVAIL' , ' &egrave; disponibile!');
define('_ACA_NO_MAILING_SENT', 'Nessuna mailing inviata!');
define('_ACA_SHOW_LOGIN', 'Mostra login form');
define('_ACA_SHOW_LOGIN_TIPS', 'Seleziona SI per visualizzare il form di login nel front-end del pannello di controllo Acajoom cos&igrave; l\'utente pu&ograve; registrarsi dal sito.');
define('_ACA_LISTS_EDITOR', 'Redattore Descrizione Lista');
define('_ACA_LISTS_EDITOR_TIPS', 'Seleziona SI per usare un editor HTML per modificare il campo di descrizione della lista.');
define('_ACA_SUBCRIBERS_VIEW', 'Vista iscritti');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Parametri Front-end' );
define('_ACA_SHOW_LOGOUT', 'Mostra il bottone logout');
define('_ACA_SHOW_LOGOUT_TIPS', 'Seleziona SI per mostrare il bottone di logout nel front-end Acajoom.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integrazione');
define('_ACA_CB_INTEGRATION', 'Integrazione Costruttore Comunit&agrave;');
define('_ACA_INSTALL_PLUGIN', 'Plugin Costruttore Comunit&agrave; (Acajoom Integration) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Il Plugin Acajoom per Community Builder non &egrave; ancora installato!');
define('_ACA_CB_PLUGIN', 'Registro Liste');
define('_ACA_CB_PLUGIN_TIPS', 'Seleziona SI per mostrare le mailing lists nel form di registrazione community builder');
define('_ACA_CB_LISTS', 'List IDs');
define('_ACA_CB_LISTS_TIPS', 'QUESTO &Egrave; UN CAMPO OBBLIGATORIO. Inserisci il numero delle liste cui vuoi abilitare gli utenti a iscriversi, separate da una virgola ,  (0 mostra tutte le liste)');
define('_ACA_CB_INTRO', 'Introduzione');
define('_ACA_CB_INTRO_TIPS', 'Il testo che comparir&agrave; prima dell\'elenco. LASCIATO IN BIANCO NON MOSTRA NULLA. Puoi usare i tags HTML per personalizzare il look.');
define('_ACA_CB_SHOW_NAME', 'Mostra Nome Lista');
define('_ACA_CB_SHOW_NAME_TIPS', 'Seleziona se mostrare oppure no il nome della lista dopo l\'introduzione.');
define('_ACA_CB_LIST_DEFAULT', 'Check list by default');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Seleziona se vuoi il check box per ogni lista, checked di default.');
define('_ACA_CB_HTML_SHOW', 'Mostra ricevi HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Settato su SI permette agli utenti di decidere se vogliono ricevere in formato HTML o no. Su NO viene usato di default ricevi html.');
define('_ACA_CB_HTML_DEFAULT', 'Ricevi HTML Default ');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Setta questa opzione per mostrare html mailing configuration di default. Se Mostra ricevi HTML &egrave; settato su NO, questa opzione sar&agrave; poi di default.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Il backup del file &egrave; fallito! Il file non &egrave stato sostituito.');
define('_ACA_BACKUP_YOUR_FILES', 'La precedente versione dei files &egrave; stata archiviata nella seguente directory:');
define('_ACA_SERVER_LOCAL_TIME', 'Ora locale del Server');
define('_ACA_SHOW_ARCHIVE', 'Mostra il pulsante di archivio');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Seleziona S&Igrave; per mostrare il pulsante di archivio nella pagina della lista delle Newsletter');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Immagini');
define('_ACA_LIST_OPT_CTT', 'Contenuto');
define('_ACA_INPUT_NAME_TIPS', 'Inserisci il tuo nome completo (Nome proprio prima)');
define('_ACA_INPUT_EMAIL_TIPS', 'Inserisci il tuo indirizzo email (Assicurati che sia un indirizzo email valido se vuoi ricevere le tue liste.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Scegli S&Igrave; se vuoi ricevere le tue liste HTML - NO per ricevere le liste in formato di testo');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Specifica il tuo fuso orario.');

// Since 1.0.5
define('_ACA_FILES' , 'Files');
define('_ACA_FILES_UPLOAD' , 'Carica');
define('_ACA_MENU_UPLOAD_IMG' , 'Carica Immagini');
define('_ACA_TOO_LARGE' , 'Il file &egrave; troppo grande. La massima dimensione permessa &egrave;');
define('_ACA_MISSING_DIR' , 'La cartella di destinazione non esiste');
define('_ACA_IS_NOT_DIR' , 'La cartella di destinazione non esiste oppure si tratta di un normale file.');
define('_ACA_NO_WRITE_PERMS' , 'Non hai i diritti di scrittura sulla cartella');
define('_ACA_NO_USER_FILE' , 'Non hai selezionato alcun file da caricare.');
define('_ACA_E_FAIL_MOVE' , 'Impossibile spostare il file.');
define('_ACA_FILE_EXISTS' , 'Il file di destinazione esiste gi&agrave;.');
define('_ACA_CANNOT_OVERWRITE' , 'Il file di destinazione esiste gi&agrave; e non puoi sovrascriverlo.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Estensione del file non permessa');
define('_ACA_PARTIAL' , 'Il file &egrave; stato caricato solo parzialmente.');
define('_ACA_UPLOAD_ERROR' , 'Errore di caricamento:');
define('DEV_NO_DEF_FILE' , 'Il file era stato caricato solo parzialmente.');
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Questo verr&agrave; sostituito con i link alle liste sottoscritte.' .
		' Ci&ograve; &egrave; <strong>richiesto</strong> per far funzionare Acajoom correttamente.<br />' .
		'Se inserisci un altro contenuto in questa casella, sar&agrave; visualizzato in tutte le comunicazioni di questa lista.' .
		' <br />Aggiungi il messaggio della tua newsletter alla fine. Acajoom aggiunger&agrave; automaticamente un link perch&egrave; l\'utente possa cambiare le proprie informazioni e un link per cancellarsi dalla lista.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notifica');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notifiche');
define('_ACA_USE_SEF', 'mailings in SEF');
define('_ACA_USE_SEF_TIPS', 'Si raccomanda di scegliere No. Comunque se vuoi che l\'URL inclusa nelle tue mailings usi SEF scegli SI.' .
		' <br /><b>I links lavoreranno allo stesso modo per entrambe le opzioni.  No, assicurer&agrave; che i links nelle mailings lavorerino sempre anche se cambi il tuo SEF.</b> ');
define('_ACA_ERR_NB' , 'Errore #: ERR');
define('_ACA_ERR_SETTINGS', 'Errore manipolazione settings');
define('_ACA_ERR_SEND' ,'Invia report errori');
define('_ACA_ERR_SEND_TIPS' ,'Se vuoi che Acajoom sia il miglior prodotto seleziona SI.  Questo ci mander&agrave; un report di errore.  Cosi non hai pi&ugrave; bisogno di riportare bugs ;-) <br /> <b>NESSUNA INFORMAZIONE PRIVATA &Egrave; INVIATA</b>. Non sappiamo da quale sito provenga l\'errore. Noi inviamo informazioni solo su Acajoom , il setup PHP e le queries SQL. ');
define('_ACA_ERR_SHOW_TIPS' ,'Scegli SI per visualizzare il numero di errore sullo schermo. Principalmente usato a scopo di ricerca e correzione errori. ');
define('_ACA_ERR_SHOW' ,'Visualizza errori');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Visualizza link di rimozione');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Seleziona SI per visualizzare i links di rimozione al fondo delle mailings per gli utenti che vogliono cambiare le loro iscrizioni. <br /> NO, disabilita i links e il footer.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">IMPORTANTE!</span> <br />Se stai facendo l\'upgrade di una precedente versione Acajoom devi aggiornare il tuo database cliccando sul seguente bottone (I tuoi dati rimarranno integri)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Tabelle e configurazione Upgrade');
define('_ACA_MAILING_MAX_TIME', 'Tempo massimo di coda' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Definisce il tempo massimo per ciascun gruppo di emails inviate. Si raccomanda sia tra 30 secondi e 2 minuti.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'Integrazione VirtueMart');
define('_ACA_VM_COUPON_NOTIF', 'ID comunicazione Buono');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Specifica il numero ID della mailing che vuoi usare per inviare buoni ai tuoi clienti.');
define('_ACA_VM_NEW_PRODUCT', 'ID comunicazione nuovi prodotti');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Specifica il numero ID della mailing che vuoi usare per inviare la comunicazione di nuovi prodotti.');

// dalla 1.0.8
// crea forms per iscrizioni
define('_ACA_FORM_BUTTON', 'Crea form');
define('_ACA_FORM_COPY', 'codice HTML');
define('_ACA_FORM_COPY_TIPS', 'Copia il codice sorgente HTML nella tua pagina HTML.');
define('_ACA_FORM_LIST_TIPS', 'Seleziona la lista che vuoi inserire nel form');
// messaggi aggiornamento
define('_ACA_UPDATE_MESS4' , 'Pu&ograve;\non pu&ograve; essere aggiornato automaticamente.');
define('_ACA_WARNG_REMOTE_FILE' , 'Nessun modo per prendere il file remoto.');
define('_ACA_ERROR_FETCH' , 'Errore di prelievo file.');

define('_ACA_CHECK' , 'Controllo');
define('_ACA_MORE_INFO' , 'Informazioni aggiuntive');
define('_ACA_UPDATE_NEW' , 'Aggiorna alla nuova versione');
define('_ACA_UPGRADE' , 'Upgrade to higher product');
define('_ACA_DOWNDATE' , 'Roll back to previous version');
define('_ACA_DOWNGRADE' , 'Indietro al prodotto di base');
define('_ACA_REQUIRE_JOOM' , 'Richiede Joomla');
define('_ACA_TRY_IT' , 'Provalo!');
define('_ACA_NEWER', 'Pi&ugrave; nuovo');
define('_ACA_OLDER', 'Pi&ugrave; vecchio');
define('_ACA_CURRENT', 'Attuale');

// dalla 1.0.9
define('_ACA_CHECK_COMP', 'Prova uno degli altri componenti');
define('_ACA_MENU_VIDEO' , 'Lezioni Video');
define('_ACA_AUTO_SCHEDULE', 'Programma');
define('_ACA_SCHEDULE_TITLE', 'Regolazione funzione automatica programma');
define('_ACA_ISSUE_NB_TIPS' , 'Numero di edizione generato automaticamente dal sistema' );
define('_ACA_SEL_ALL' , 'Tutte le newsletters');
define('_ACA_SEL_ALL_SUB' , 'Tutte le liste');
define('_ACA_INTRO_ONLY_TIPS' , 'Se spunti questo box sar&agrave; inserita nella newsletter solo l\'introduzione  con un link all\'articolo completo sul tuo sito.' );
define('_ACA_TAGS_TITLE' , 'Tag Contenuto');
define('_ACA_TAGS_TITLE_TIPS' , 'Copia e incolla questo tag tag nella newsletter dove vuoi che il contenuto relativo venga inserito.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Indica l\'indirizzo email a cui inviare il test');
define('_ACA_PREVIEW_TITLE' , 'Anteprima');
define('_ACA_AUTO_UPDATE' , 'Nuova notifica aggiornamento');
define('_ACA_AUTO_UPDATE_TIPS' , 'Seleziona SI se vuoi essere avvisato di nuovi aggiornamenti per il componente. <br />IMPORTANTE!! Si deve attivare Mostra suggerimenti perch&egrave; questa funzione lavori correttamente.');

// dalls 1.1.0
define('_ACA_LICENSE' , 'Informazioni Licenza');

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
define('_ACA_REGWARN_NAME','Inserisci il tuo nome.');
define('_ACA_REGWARN_MAIL','Inserisci un indirizzo e-mail valido.');

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
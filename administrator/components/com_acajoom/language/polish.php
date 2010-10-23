<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>Polish language file</p>
* @author Andrzej Herzberg <http://design-joomla.pl>
* @version $Id: polish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom to narzêdzie zaiweraj±ce listê mailingow±, newsletter, auto-responder s³u¿±ce do bardziej efektywnej komunikacji miêdzy u¿ytkownikiem i jego klientami.  ' .
		'Acajoom, Twój partner w komunikacji!');
define('_ACA_FEATURES', 'Acajoom, Twój partner w komunikacji!');

// Type of lists
define('_ACA_NEWSLETTER', 'Newsletter');
define('_ACA_AUTORESP', 'Auto-responder');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'e-Kartki');
define('_ACA_POSTCARD', 'Kartka pocztowa');
define('_ACA_PERF', 'Wyniki');
define('_ACA_COUPON', 'Kupon');
define('_ACA_CRON', 'Zadanie Crona');
define('_ACA_MAILING', 'Wysy³ka');
define('_ACA_LIST', 'Lista');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Listy');
define('_ACA_MENU_SUBSCRIBERS', 'Subskrybenci');
define('_ACA_MENU_NEWSLETTERS', 'Newslettery');
define('_ACA_MENU_AUTOS', 'Autorespondery');
define('_ACA_MENU_COUPONS', 'Kupony');
define('_ACA_MENU_CRONS', 'Zadania krona');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'e-Kartki');
define('_ACA_MENU_POSTCARDS', 'Kartki pocztowe');
define('_ACA_MENU_PERFS', 'Wyniki');
define('_ACA_MENU_TAB_LIST', 'Listy');
define('_ACA_MENU_MAILING_TITLE', 'Wysy³ki');
define('_ACA_MENU_MAILING' , 'Wysy³ki od ');
define('_ACA_MENU_STATS', 'Statystyki');
define('_ACA_MENU_STATS_FOR', 'Statystyki dla ');
define('_ACA_MENU_CONF', 'Konfiguracja');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'O');
define('_ACA_MENU_LEARN', 'Centrum edukacji');
define('_ACA_MENU_MEDIA', 'Menad¿er mediów');
define('_ACA_MENU_HELP', 'Pomoc');
define('_ACA_MENU_CPANEL', 'Panel zarz±dzania');
define('_ACA_MENU_IMPORT', 'Import');
define('_ACA_MENU_EXPORT', 'Export');
define('_ACA_MENU_SUB_ALL', 'Subskrybuj wszystkie listy');
define('_ACA_MENU_UNSUB_ALL', 'Wypisz siê ze wszystkich list');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archiwum');
define('_ACA_MENU_PREVIEW', 'Podgl±d');
define('_ACA_MENU_SEND', 'Wy¶lij');
define('_ACA_MENU_SEND_TEST', 'Wy¶lij email testowy');
define('_ACA_MENU_SEND_QUEUE', 'Kolejka procesu');
define('_ACA_MENU_VIEW', 'Widok');
define('_ACA_MENU_COPY', 'Kopia');
define('_ACA_MENU_VIEW_STATS' , 'Widok statystyk');
define('_ACA_MENU_CRTL_PANEL' , ' Panel kontrolny');
define('_ACA_MENU_LIST_NEW' , ' Dodaj listê');
define('_ACA_MENU_LIST_EDIT' , ' Edytuj listê');
define('_ACA_MENU_BACK', 'Powrót');
define('_ACA_MENU_INSTALL', 'Instalacja');
define('_ACA_MENU_TAB_SUM', 'Podsumowanie');
define('_ACA_STATUS' , 'Status');

// messages
define('_ACA_ERROR' , ' Wyst±pi³ b³±d! ');
define('_ACA_SUB_ACCESS' , 'Prawa dostêpu');
define('_ACA_DESC_CREDITS', 'Przypisy');
define('_ACA_DESC_INFO', 'Informacje');
define('_ACA_DESC_HOME', 'Strona domowa');
define('_ACA_DESC_MAILING', 'Lista mailingowa');
define('_ACA_DESC_SUBSCRIBERS', 'Subskrybenci');
define('_ACA_PUBLISHED','Opublikowane');
define('_ACA_UNPUBLISHED','Nie opublikowane');
define('_ACA_DELETE','Skasuj');
define('_ACA_FILTER','Filtr');
define('_ACA_UPDATE','Aktualizacja');
define('_ACA_SAVE','Zapisz');
define('_ACA_CANCEL','Pomiñ');
define('_ACA_NAME','Imiê');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Wybierz');
define('_ACA_ALL','Wszystkie');
define('_ACA_SEND_A', 'Wy¶lij ');
define('_ACA_SUCCESS_DELETED', ' skasowano');
define('_ACA_LIST_ADDED', 'Lista zosta³a utworzona');
define('_ACA_LIST_COPY', 'Lista zosta³a skopiowana');
define('_ACA_LIST_UPDATED', 'Lista zosta³a zaktualizowana');
define('_ACA_MAILING_SAVED', 'Mailing zapisano.');
define('_ACA_UPDATED_SUCCESSFULLY', 'zaktualizowano.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Informacja o subskrybentach');
define('_ACA_VERIFY_INFO', 'Proszê sparawdziæ podany odno¶nik, informacja mo¿e byæ niekompletna.');
define('_ACA_INPUT_NAME', 'Imiê');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Wiadomo¶æ HTML?');
define('_ACA_TIME_ZONE', 'Strefa czasowa');
define('_ACA_BLACK_LIST', 'Czarna lista');
define('_ACA_REGISTRATION_DATE', 'Data rejestracji u¿ytkownika');
define('_ACA_USER_ID', 'Id u¿ytkownika');
define('_ACA_DESCRIPTION', 'Opis');
define('_ACA_ACCOUNT_CONFIRMED', 'Twoje konto zosta³o aktywowane.');
define('_ACA_SUB_SUBSCRIBER', 'Subskrybent');
define('_ACA_SUB_PUBLISHER', 'Wydawca');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Zarejestrowany');
define('_ACA_SUBSCRIPTIONS', 'Twoja subskrypcja');
define('_ACA_SEND_UNSUBCRIBE', 'Wy¶lij wiadomo¶æ o rezygnacji z subskrypcji');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Kliknij Tak aby wys³aæ email z informacj± o rezygnacji z subskrypcji.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Proszê potwierdziæ swoj± subskrypcjê');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Potwierdzenie rezygnacji z subskrypcji');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Witaj [NAME],<br>' .
		'Zosta³ jescze tylko jeden krok i zostaniesz dopisany do naszej listy wysy³kowej.  Proszê klikn±æ na poni¿szy link aby potwierdzi¶ subskrupcjê.' .
		'<br><br>[CONFIRM]<br><br>W razie jakichkolwiek pytañ proszê o kontakt z webmasterem.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'To jest e-mail potwierdazj±cy wypisanie siê z naszej listy wysy³kowej.  Bardzo nam przykro, ¿e siê wypisa³e¶. Pamiêtaj jednak, ¿e zawsze mo¿esz odnowiæ subskrupcjê.  Je¶li mmasz jakiekolwiek pytania, proszê o kontakt.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Data zapisu');
define('_ACA_CONFIRMED', 'Zatwierdzony');
define('_ACA_SUBSCRIB', 'Subskrupcja');
define('_ACA_HTML', 'Mailing w formacie HTML');
define('_ACA_RESULTS', 'Wyniki');
define('_ACA_SEL_LIST', 'Wybierz listê');
define('_ACA_SEL_LIST_TYPE', '- Wybierz rodzaj listy -');
define('_ACA_SUSCRIB_LIST', 'Lista wszystkich subskrybentów');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Subskrybenci dla : ');
define('_ACA_NO_SUSCRIBERS', 'Nie znaleziono subskrybentów dla tej listy.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'E-mail z pro¶b± o potwierdzenie subskrypcji zosta³ wys³any.  Proszê odbierz korespondencjê i kliknij w link weryfikacyjny.<br>' .
		'Musisz potwierdziæ autentyczno¶æ swojej subskrypcji zanim dopiszemy ciê do listy naszych prenumeartorów.');
define('_ACA_SUCCESS_ADD_LIST', 'Twoje dane zosta³y dopisane do naszej listy wysy³kowej.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Klilkij tu aby potwierdziæ subskrypcjê');
define('_ACA_UNSUBSCRIBE_LINK', 'Kliknij tu aby wypisaæ siê z naszej listy wysy³kowej');
define('_ACA_UNSUBSCRIBE_MESS', 'Twój adres e-mail zosta³ usuniêty z naszej listy wysy³kowej');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Wszystkie zaplanowane wysy³ki zosta³y pomy¶lnie zrealizowane.');
define('_ACA_MALING_VIEW', 'Zobacz wszystkie wysy³ki');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Czy jeste¶ pewien, ¿e chcesz wypisaæ siê z naszej listy wysy³kowej?');
define('_ACA_MOD_SUBSCRIBE', 'Subskrybuj');
define('_ACA_SUBSCRIBE', 'Subskrybuj');
define('_ACA_UNSUBSCRIBE', 'Wypisz siê');
define('_ACA_VIEW_ARCHIVE', 'Zobacz archiwum');
define('_ACA_SUBSCRIPTION_OR', ' lub kliknij tu aby uaktualniæ informacje');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Ten adres e-mail jest ju¿ zarejestrowany w naszej bazie.');
define('_ACA_SUBSCRIBER_DELETED', 'Subskrybent skasowany.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Panel kontrolny u¿ytkownika');
define('_UCP_USER_MENU', 'Menu u¿ytkownika');
define('_UCP_USER_CONTACT', 'Moje subskrypcje');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Zarz±dzanie zadaniami crona');
define('_UCP_CRON_NEW_MENU', 'Nowy cron');
define('_UCP_CRON_LIST_MENU', 'Lista zadañ crona');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Zarz±dzanie kuponami');
define('_UCP_COUPON_LIST_MENU', 'Lista kuponów');
define('_UCP_COUPON_ADD_MENU', 'Dodaj kupon');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Opis');
define('_ACA_LIST_T_LAYOUT', 'Uk³ad');
define('_ACA_LIST_T_SUBSCRIPTION', 'Subskrypcja');
define('_ACA_LIST_T_SENDER', 'Informacja o nadawcy');

define('_ACA_LIST_TYPE', 'Typ listy');
define('_ACA_LIST_NAME', 'Nazwa listy');
define('_ACA_LIST_ISSUE', 'Emisja #');
define('_ACA_LIST_DATE', 'Data wysy³ki');
define('_ACA_LIST_SUB', 'Temat mailingu');
define('_ACA_ATTACHED_FILES', 'Za³±czone pliki');
define('_ACA_SELECT_LIST', 'Proszê wybraæ listê do edycji!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Typ listy');
define('_ACA_AUTO_RESP_OPTION', 'Opcje Autorespondera');
define('_ACA_AUTO_RESP_FREQ', 'Subskrybenci mog± wybraæ czêstotliwo¶æ');
define('_ACA_AUTO_DELAY', 'Opó¼nienie (w dniach)');
define('_ACA_AUTO_DAY_MIN', 'Minimalna czêstotliwo¶æ');
define('_ACA_AUTO_DAY_MAX', 'Maksymalna czêstotliwo¶æ');
define('_ACA_FOLLOW_UP', 'Okre¶l follow up autoresponder');
define('_ACA_AUTO_RESP_TIME', 'Subskrybenci mog± wybraæ czas');
define('_ACA_LIST_SENDER', 'Lista wysy³kowa');

define('_ACA_LIST_DESC', 'Opis listy');
define('_ACA_LAYOUT', 'Uk³ad');
define('_ACA_SENDER_NAME', 'Nazwa nadawcy');
define('_ACA_SENDER_EMAIL', 'E-mail nadawcy');
define('_ACA_SENDER_BOUNCE', 'Nadawca odbitych wiadomo¶ci');
define('_ACA_LIST_DELAY', 'Opó¼nienie');
define('_ACA_HTML_MAILING', 'Format HTML?');
define('_ACA_HTML_MAILING_DESC', '(je¶li dokonasz zmian powiniene¶ je zapisaæ i powróciæ do tego ekranu aby sprawdziæ efekt.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Ukryæ na stronie frontowej?');
define('_ACA_SELECT_IMPORT_FILE', 'Wybierz plik do zaimportowania');;
define('_ACA_IMPORT_FINISHED', 'Import zakoñczony');
define('_ACA_DELETION_OFFILE', 'Usuniêcie pliku');
define('_ACA_MANUALLY_DELETE', 'nie powiod³o siê, musisz rêcznie usun±æ plik');
define('_ACA_CANNOT_WRITE_DIR', 'Niemogê zapisaæ katalogu');
define('_ACA_NOT_PUBLISHED', 'Nie mo¿na wys³aæ mailingu, lista jest nieopublikowana.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Kliknij Tak aby opublikowaæ listê');
define('_ACA_INFO_LIST_NAME', 'Tutaj wpisz nazwê twojej listy. Bêdziesz móg³ identyfikowaæ listê u¿ywaj±c tej nazwy.');
define('_ACA_INFO_LIST_DESC', 'Tutaj wpisz krótki opis twojej listy. Ten opis bêdzie widoczny dla odwiedzaj±cych twój serwis.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Wpisz imiê wysy³aj±cego mailing. Bêdzie ono widoczne dla subskrybentów tej listy.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Wpisz adres e-mail z którego mailing jest wysy³any.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Wpisz adres email na który u¿ytkownicy mog± odpowiadaæ. Zalecamy aby by³ to tan sam adres co adres nadawcy. Niektóre filtry antyspamowe mog± wiadmo¶æ w której adres nadawcy ró¿ni siê od adresu zwrotnego uznaæ za spam');
define('_ACA_INFO_LIST_AUTORESP', 'Wybierz typ mailingu dla tej listy. <br>' .
		'Newsletter: Normalny newsletter<br>' .
		'Autoresponder: jest to specjalny rodzaj listyz której wiadomo¶ci wysy³ane s± automatycznie w zadanych odstêpach czasu.');
define('_ACA_INFO_LIST_FREQUENCY', 'Zaznacz czy u¿ytkownicy mog± wybraæ jak czêsto maj± otrzymywaæ wiadomo¶ci.  Pozwoli to na wiêksz± elastyczno¶æ dla u¿ytkowników.');
define('_ACA_INFO_LIST_TIME', 'Pozwól u¿ytkownikom wybraæ preferowan± porê dnia, o której chc± otrzymywaæ wiadomo¶ci.');
define('_ACA_INFO_LIST_MIN_DAY', 'Zdefiniuj minimaln± czêstotliwo¶æ z jak± u¿ytkownicy maj± otrzymywaæ wiadomo¶ci');
define('_ACA_INFO_LIST_DELAY', 'Sprecyzuj odstêp pomiêdzy t± wiadomo¶i± autorespondera a nastêpn±.');
define('_ACA_INFO_LIST_DATE', 'Sprecyzuj datê publikacji listy je¶li zamierzasz przerwac wysy³kê. <br> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Sprecyzuj jak± maksymaln± czêstotliow¶æ otrzymywania wiadomo¶ci u¿ytkownicy mog± wybraæ');
define('_ACA_INFO_LIST_LAYOUT', 'Tutaj wprowad¼ uk³ad twojej listy mailingowej. Mo¿esz zdefiniowaæ dowolny uk³ad.');
define('_ACA_INFO_LIST_SUB_MESS', 'Ta wiadomo¶æ zostanie wys³ana do subskrybenta, który w³a¶nie siê zarejestrowa³. Mo¿esz tutaj zdefiniowaæ dowolny tekst.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Ta wiadomo¶æ zostanie wys³ana do subskrybenta kiedy wypisze siê z listy. Mo¿e to byæ dowolna wiadomo¶æ.');
define('_ACA_INFO_LIST_HTML', 'Wybierz opcjê je¶li chcesz wysy³aæ wiadomo¶ci w formacie HTML. U¿ytkownicy s± zobowi±zani sprecyzowaæ czy chc± otrzymywaæ wiadomo¶ci w formacie HTML, czy tylko wiadomo¶ci tekstowe, w chili gdy zapisuj± siê do tej listy.');
define('_ACA_INFO_LIST_HIDDEN', 'Kliknij tak aby ukryæ listê na stronie frontowej, u¿ytkownicy nie bêd± zobowi±zani do zapisu ale wci±¿ bêdzie mo¿liwa wysy³ka.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Czy chcesz automatycznie zapisaæ nowych u¿ytkowników do tej listy?<br><B>Nowi u¿ytkownicy:</B> zostan± zarejestrowani wszyscy nowi u¿ytkownicy.<br><B>Wszyscy u¿ytkowicy:</B> zostan± zarejestrowani wszyscy u¿ytkownicy zapisani do tej pory w bazie.<br>(wszystkie opcje wspierane s± w Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Wybierz poziom dostêpu ze strony frontowej. Ta opcja pokazuje lub ukrywa listê mailingow± dla grup u¿ytkowników którzy nie chc± lub nie powinni siê do niej zapisywaæ.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Wybierz poziom dostêpu dla u¿ytkowników, którym chcesz pozwoliæ a edycjê. Ci u¿ytkownicy bêd± w stanie edytowaæ i wysy³ac mailing z pozomu frontu oraz z panela administracynjego.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'If you want the auto-responder to move to another one once it reaches the last message you can specify here the following up auto-responder.');
define('_ACA_INFO_LIST_ACA_OWNER', 'To jest ID osoby, która utowrzy³a listê.');
define('_ACA_INFO_LIST_WARNING', '   Ta ostatnia opcja jest dostêpna tylko raz, podczas tworzenia listy.');
define('_ACA_INFO_LIST_SUBJET', ' Temat wysy³ki.  To jest temat e-maila, który otrzyma subskrybent.');
define('_ACA_INFO_MAILING_CONTENT', 'To jest zawarto¶æ e-maila do wysy³ki.');
define('_ACA_INFO_MAILING_NOHTML', 'Wpisz tytaj tre¶æ wiadomo¶ci, któr± chcesz wys³aæ do tych subskrybentów, którzy wyrazili wojê otrzymywania wiadomo¶ci w formacie tekstowym podczas zapisu. <BR/> UWAGA: Je¶li zostawisz to pole puste Acajoom automatycznie przekonweruje wiadomo¶æ HTML do wiadomo¶ci tekstowej.');
define('_ACA_INFO_MAILING_VISIBLE', 'Kliknij TAK aby pokazaæ mailing na strnonie.');
define('_ACA_INSERT_CONTENT', 'Za³±cz istniej±cy artyku³');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Kupon wys³any!');
define('_ACA_CHOOSE_COUPON', 'Wybierz kupon');
define('_ACA_TO_USER', ' do tego u¿ytkownika');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'co godzinê');
define('_ACA_FREQ_CH2', 'co 6 godzin');
define('_ACA_FREQ_CH3', 'co 12 godzin');
define('_ACA_FREQ_CH4', 'codiennie');
define('_ACA_FREQ_CH5', 'co tydzieñ');
define('_ACA_FREQ_CH6', 'co miesi±c');
define('_ACA_FREQ_NONE', 'Nie');
define('_ACA_FREQ_NEW', 'Nowy u¿ytkownik');
define('_ACA_FREQ_ALL', 'Wszystcy u¿ytkownicy');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Kliknij TAK je¶li zamierzasz u¿yæ z Acajoom Cron, NIE dla innych zadañ crona.<br>' .
		'Je¶li wybierzesz TAK nie musisz wybieraæ adresu Cron-a, bêdzie on automatycznie dodany.');
define('_ACA_SITE_URL' , 'Adres URL twojej witryny');
define('_ACA_CRON_FREQUENCY' , 'Czêstotliwo¶æ Cron-a');
define('_ACA_STARTDATE_FREQ' , 'Data pocz±tkowa');
define('_ACA_LABELDATE_FREQ' , 'Okre¶l datê');
define('_ACA_LABELTIME_FREQ' , 'Okre¶l czas');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Czêstotliwo¶æ');
define('_ACA_TITLE_CRONLIST', 'Lista Cron-ów');
define('_NEW_LIST', 'Utwórz nowa listê');

//title CRON form
define('_ACA_TITLE_FREQ', 'Edycja Cron-a');
define('_ACA_CRON_SITE_URL', 'Proszê wpisaæ poprawny adres url witryny zaczynaj±cy siê od http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Wszystkie mailingi');
define('_ACA_EDIT_A', 'Edytuj ');
define('_ACA_SELCT_MAILING', 'Proszê wybraæ listê z rozwijalnego menu.');
define('_ACA_VISIBLE_FRONT', 'Widoczne na stronie');

// mailer
define('_ACA_SUBJECT', 'Temat');
define('_ACA_CONTENT', 'Zawarto¶æ');
define('_ACA_NAMEREP', '[NAME] = To pole zostanie zamienione na dane wprowadzone przez u¿ytkownika, mo¿esz wiêc wysy³aæ spersonalizowane wiadomo¶ci.<br>');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = To pole zostanie zamienione na imiê, które wprowadzi³ u¿ytkownik przy rejestracji.<br>');
define('_ACA_NONHTML', 'wersja bez HTML');
define('_ACA_ATTACHMENTS', 'Za³±czniki');
define('_ACA_SELECT_MULTIPLE', 'Wci¶nik klawisz control (albo command - Macintosh) aby wybraæ kilka za³±czników.<br>' .
		'Pliki bêda widoczne na li¶cie za³±czników zlokalizowanych w katalogu z za³±cznikami. Mo¿esz zmieniæ lokalizacjê tego katalogu w panelu kontrolnym.');
define('_ACA_CONTENT_ITEM', 'Element zawarto¶ci');
define('_ACA_SENDING_EMAIL', 'Wysy³ka maili');
define('_ACA_MESSAGE_NOT', 'Komunikat - nie mo¿e zostaæ wys³ane');
define('_ACA_MAILER_ERROR', 'B³±d mailera');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Komunikat - wys³ano pomy¶lnie');
define('_ACA_SENDING_TOOK', 'Wys³anie maili zabra³o ');
define('_ACA_SECONDS', ' sekund');
define('_ACA_NO_ADDRESS_ENTERED', 'Nie podano adresu e-mail lub u¿ytkownika ');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Zmieñ');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Zmieñ swoj± subskrypcjê');
define('_ACA_WHICH_EMAIL_TEST', 'Podaj edres e-mail do wys³ania wiadomo¶ci testowej lub wybierz podgl±d');
define('_ACA_SEND_IN_HTML', 'Wysy³ka w HTML (dla mailingu html)?');
define('_ACA_VISIBLE', 'Widoczny');
define('_ACA_INTRO_ONLY', 'Tylko intro');

// stats
define('_ACA_GLOBALSTATS', 'Statystyki globalne');
define('_ACA_DETAILED_STATS', 'Statystyki szczegó³ówe');
define('_ACA_MAILING_LIST_DETAILS', 'Szczegó³y listy');
define('_ACA_SEND_IN_HTML_FORMAT', 'Wys³ane w formacie HTML');
define('_ACA_VIEWS_FROM_HTML', 'Obejrzane (e-maile HTML)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Wys³ane w formacie tekstowym');
define('_ACA_HTML_READ', 'HTML przeczytane');
define('_ACA_HTML_UNREAD', 'HTML nieprzeczytane');
define('_ACA_TEXT_ONLY_SENT', 'Tylko tekst');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logi i statystyki');
define('_ACA_SUBSCRIBER_CONFIG', 'Subskrybenci');
define('_ACA_MISC_CONFIG', 'Ró¿no¶ci');
define('_ACA_MAIL_SETTINGS', 'Mail - ustawienia');
define('_ACA_MAILINGS_SETTINGS', 'Ustawienia mailingu');
define('_ACA_SUBCRIBERS_SETTINGS', 'Ustawienia subskrybentów');
define('_ACA_CRON_SETTINGS', 'Ustawienia Cron-a');
define('_ACA_SENDING_SETTINGS', 'Ustawienia wysy³ki');
define('_ACA_STATS_SETTINGS', 'Ustawienia statystyk');
define('_ACA_LOGS_SETTINGS', 'Ustawienia logów');
define('_ACA_MISC_SETTINGS', 'Ustawienia ró¿no¶ci');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Email nadawcy');
define('_ACA_SEND_MAIL_NAME', 'Nazwa nadawcy');
define('_ACA_MAILSENDMETHOD', 'Metoda wysy³ki');
define('_ACA_SENDMAILPATH', '¦cie¿ka do sendmail');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP wymagana autoryzacja');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Wybierz je¶li twój serwer SMTP wymaga autoryzacji');
define('_ACA_SMTPUSERNAME', 'SMTP nazwa u¿ytkownika');
define('_ACA_SMTPUSERNAME_TIPS', 'Wprowad¼ nazwê u¿ytkownika SMTP je¶li twój serwer SMTP wymaga autoryzacji');
define('_ACA_SMTPPASSWORD', 'SMTP has³o');
define('_ACA_SMTPPASSWORD_TIPS', 'Wprowad¼ has³o SMTP je¶li twój serwer SMTP wymaga autoryzacji');
define('_ACA_USE_EMBEDDED', 'U¿yj za³±czonych obrazów');
define('_ACA_USE_EMBEDDED_TIPS', 'Wybierz je¶li obrazki z za³±czonej zawarto¶ci maj± byc wys³ane w wiadomo¶ci HTML. W innym przypadku zostan± u¿yte standardowe tagi.');
define('_ACA_UPLOAD_PATH', 'Wgrywanie/¶cie¿ka do za³±czników');
define('_ACA_UPLOAD_PATH_TIPS', 'Mo¿esz wybraæ ¶cie¿kê do za³±czników.<br>' .
		'Sprawd¼ czy wybrany katalog istnieje, w przeciwnym wypadku utwórz go.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Zezwalaj niezarejestrowanym');
define('_ACA_ALLOW_UNREG_TIPS', 'Wybierz TAK je¶li chcesz pozwoliæ na zapis do subskypcji u¿ytkownikom niezarejestrowanym w serwisie.');
define('_ACA_REQ_CONFIRM', 'Wymagane potwierdzenie');
define('_ACA_REQ_CONFIRM_TIPS', 'Wybierz je¶li wymagasz potwierdzenia subskrypcji od niezarejestrowanych u¿ytkowników.');
define('_ACA_SUB_SETTINGS', 'Ustawienia subskrybenta');
define('_ACA_SUBMESSAGE', 'Ustawienia email');
define('_ACA_SUBSCRIBE_LIST', 'Subskrybenci do listy');

define('_ACA_USABLE_TAGS', 'U¿yteczne zak³adki');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Zostanie utworzony odno¶nik, za pomoc± którego u¿ytkownik bêdzie móg³ potwierdziæ subskrypcjê. Pole <strong>wymagane</strong> dla prawid³owej pracy Acajoom.<br>'
.'<br>[NAME] = To pole zostanie zast±pione nazw± (imiê i nazwisko), któr± u¿ytkownik poda³ przy rejestracji. Mo¿esz wiêc wysy³aæ spersonalizowane wiadomo¶ci.<br>'
.'<br>[FIRSTNAME] = To pole zostanie zast±pione nazw± (imieniem), któr± u¿ytkownik poda³ przy rejestracji. FIRSTNAME to pierwsze s³owo wpisane przez u¿ytkownika w polu z nazw±.<br>');
define('_ACA_CONFIRMFROMNAME', 'Potwierd¼ nazwê');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Wpisz nazwê wy¶wietlan± w wiadomo¶ci z potwierdzeniem.');
define('_ACA_CONFIRMFROMEMAIL', 'Potwierd¼ e-mail');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Wpisz email wy¶wietlany w wiadomo¶ci z potwierdzeniem.');
define('_ACA_CONFIRMBOUNCE', 'Adres dla odbitych wiadomo¶ci');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Wpisz adres e-mail dla odbitych wiadomo¶ci.');
define('_ACA_HTML_CONFIRM', 'potwierdzenie HTML');
define('_ACA_HTML_CONFIRM_TIPS', 'Wybierz tak je¶li wiadomo¶æ potwierdzaj±ca ma byæ wys³ana w formacie HTML dla u¿ytkowników, którzy wybrali tak± opcjê przy rejestracji.');
define('_ACA_TIME_ZONE_ASK', 'Sprawd¼ strefê czasow±');
define('_ACA_TIME_ZONE_TIPS', 'Wybierz tak, je¶li chcesz sprawdzaæ strefê czasow± u¿ytkownika. Skojekowane maile bêd± wysy³ane w³a¶ciwie dla danej strefy');

 // Cron Set up
 define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_TIME_OFFSET_URL', 'kliknij tu aby ustawiæ offset w gównym panelu konfiguracyjnym -> Zak³adka lokalna');
define('_ACA_TIME_OFFSET_TIPS', 'Ustaw odstêp czasu serwera');
define('_ACA_TIME_OFFSET', 'Odstêp czasu');
define('_ACA_CRON_DESC','<br>U¿ywaj±c funkcji cron-a mo¿esz ustawiæ automatyczne zadania dla twojego serwisu w Joomla!<br>' .
		'Aby u¿yæ tej funkcjonalno¶ci powiniene¶ ustawiæ w panelu administracyjnym nastêpuj±ce komendy:<br>' .
		'/usr/bin/php  /home/joomla/public_dev/index.php?option=com_acajoom&act=cron' .
		'<br><br>Uwaga:<br>' .
		' - je¶li scie¿ka na Twoim serwerze jest inna ni¿ /usr/bin/php proszê wpisaæ w³a¶ciw± w postaci /$php_path/php' .
 		'<br><br>Wiêcej informacji na temat ustawieñ crona<br>' .
		' - Cpanel kliknij tu ' .
 		'<a href="http://www.visn.co.uk/cpanel-docs/cron-jobs.html"  target="_blank">http://www.visn.co.uk/cpanel-docs/cron-jobs.html</a><br>' .
 		' - Plesk kliknij tu ' .
 		'<a href="http://www.swsoft.com/doc/tutorials/Plesk/Plesk7/plesk_plesk7_eu/plesk7_eu_crontab.htm" target="_blank">' .
 		'http://www.swsoft.com/doc/tutorials/Plesk/Plesk7/plesk_plesk7_eu/plesk7_eu_crontab.htm</a><br>' .
 		' - Interworx kliknij tu ' .
 		'<a href="http://www.sagonet.com/interworx/tutorials/siteworx/cron.php" target="_blank">' .
 		'http://www.sagonet.com/interworx/tutorials/siteworx/cron.php</a><br>' .
 		' - Ogólne informacje na temat crona pod Linuxem ' .
 		'<a href="http://www.computerhope.com/unix/ucrontab.htm#01" target="_blank">http://www.computerhope.com/unix/ucrontab.htm#01</a><br>' .
 		'<br>Je¶li potrzebujesz pomocy w ustawieniach crona lub masz inne problemy zapraszamy na nasze forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Przerwa x miêdzy ka¿d± ustawion± paczk± e-maili');
define('_ACA_PAUSEX_TIPS', 'Wprowad¼ ilo¶æ sekund, równowa¿n± przerwie pomiêdzy wysy³akmi kolejnyhc zdefiniowanych paczek maili.');
define('_ACA_EMAIL_BET_PAUSE', 'E-maili pomiêdzy przerwami');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Ilo¶æ e-maili do wys³ania przed przerw±.');
define('_ACA_WAIT_USER_PAUSE', 'Czekaj na wprowadzenie u¿ytkownika przy przerwie');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'CZy skrypt ma czekaæ na wprowadzenie u¿ytkownika w czasie przerwy pomiêdzy wysy³kami.');
define('_ACA_SCRIPT_TIMEOUT', 'Czas obliczeñ dla skryptu');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Liczba minut dzia³ania skryptu (0 = bez limitu).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'W³±czone czytanie statystyk');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Wybierz tak je¶li chcesz rejestrowaæ ilo¶æ wy¶wietleñ. Ta techika mo¿e byæ u¿yta tylko dla mailingu w formacie HTML');
define('_ACA_LOG_VIEWSPERSUB', 'Rejestruj wy¶wietlenia dla subskrybenta');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Wybierz tak je¶li chcesz rejestrowaæ ilo¶æ wy¶wietleñ dla ka¿dego u¿ytkownika. Ta techika mo¿e byæ u¿yta tylko dla mailingu w formacie HTML');
// Logs settings
define('_ACA_DETAILED', 'Szczegó³owe raporty');
define('_ACA_SIMPLE', 'Uproszczone raporty');
define('_ACA_DIAPLAY_LOG', 'Wy¶wietl raporty');
define('_ACA_DISPLAY_LOG_TIPS', 'Zaznacz tak je¶li chcesz wy¶wietlaæ rejestry w czasie wysy³ki.');
define('_ACA_SEND_PERF_DATA', 'Wydajno¶æ wysy³ki');
define('_ACA_SEND_PERF_DATA_TIPS', 'Zaznacz je¶li chcesz aby Ajacom generowa³ anonimowe sprawozdania o konfiguracji, ilo¶ci subskrybentów listy i rzeczywistego czasu wysy³ki. To pozwoli nam oceniæ wydajno¶æ systemu Acajoom i pozwoli na dokonanie poprawek w przysz³ych wersjach.');
define('_ACA_SEND_AUTO_LOG', 'Wy¶lij raporty dla auto-respondera');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Zaznacz tak jes³i chcesz otrzymywaæ e-mail z raportem za ka¿dym razem kiedy zadanie zostanie wykonane.  UWAGA: mo¿e to spowodowaæ ogromny wzrost ilo¶ci otrzymywanych maili.');
define('_ACA_SEND_LOG', 'Wy¶lij raport');
define('_ACA_SEND_LOG_TIPS', 'Czy raport z mailingu ma byæ wysy³any na adres u¿ytkownika zlecaj±cego wysy³kê.');
define('_ACA_SEND_LOGDETAIL', 'Wy¶lij sczegó³owy raport');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Szczegó³owy raport zawiera informacje o powodzeniu lub niepowodzeniu wysy³ki dla ka¿dego subskrybenta oraz przegl±d informacji. Krótki raport zawiera wy³±cznie przegl±d.');
define('_ACA_SEND_LOGCLOSED', 'Wy¶lij raport je¶li ³±czno¶æ zostanie zerwana');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Przy w³±czonej opcji u¿ytkownik wysy³aj±cy mailing wci±¿ mo¿e otrzymywac raporty na e-mail.');
define('_ACA_SAVE_LOG', 'Zapisz raport');
define('_ACA_SAVE_LOG_TIPS', 'Czy raport z mailingu ma byæ zapisany (za³±czony) do pliku.');
define('_ACA_SAVE_LOGDETAIL', 'Zapisz szczególowy raport');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Szczegó³owy raport zawiera informacje o powodzeniu lub niepowodzeniu wysy³ki dla ka¿dego subskrybenta oraz przegl±d informacji. Krótki raport zawiera wy³±cznie przegl±d.');
define('_ACA_SAVE_LOGFILE', 'Zapisz plik raportu');
define('_ACA_SAVE_LOGFILE_TIPS', 'Plik do którego jest do³±czany raport. Plik mo¿e byæ do¶æ spory.');
define('_ACA_CLEAR_LOG', 'Wyczy¶æ raport');
define('_ACA_CLEAR_LOG_TIPS', 'Kasuje dane z pliku raportu.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Ostatnio wykonana kolejka');
define('_ACA_CP_TOTAL', 'Suma');
define('_ACA_MAILING_COPY', 'Mailing skopiowany!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Poka¿ przewodnik');
define('_ACA_SHOW_GUIDE_TIPS', 'Pokazuje przewodnik pomagaj±cy nowym u¿ytkownikom utworzyæ newsletter, auto-responder i ustawiæ poprawnie system Acajoom.');
define('_ACA_AUTOS_ON', 'U¿yj Auto-responderów');
define('_ACA_AUTOS_ON_TIPS', 'Ustaw nie je¶li nie chcesz u¿ywaæ  Auto-responderów. Wszystkie autorespndery bêd± nieaktywne.');
define('_ACA_NEWS_ON', 'U¿yj newslettera');
define('_ACA_NEWS_ON_TIPS', 'Wybierz nie jes³i nie chcesz u¿ywaæ newslettera. Wszystkie newslettery bêd± nieaktywne.');
define('_ACA_SHOW_TIPS', 'Poka¿ porady');
define('_ACA_SHOW_TIPS_TIPS', 'Poka¿ porady pomagaj±ce u¿ytkownikom korzystaæ z systemu Acajoom bardziej efektywnie.');
define('_ACA_SHOW_FOOTER', 'Poka¿ stopkê');
define('_ACA_SHOW_FOOTER_TIPS', 'Czy ma by¶ pokazywana stopka Acajoom.');
define('_ACA_SHOW_LISTS', 'Poka¿ listê na stronie');
define('_ACA_SHOW_LISTS_TIPS', 'Pokazuje niezerejestrowanym u¿ytkownikom listy mailingowe, które bêd± mogli zaprenumerowaæ po zarejestrowaniu.');
define('_ACA_CONFIG_UPDATED', 'Szczczegó³y konfiguracji zosta³y zapisane!');
define('_ACA_UPDATE_URL', 'Uaktualnij URL');
define('_ACA_UPDATE_URL_WARNING', 'UWAGA! Nie zmieniaj tego adresu póki nie zostaniesz o to poproszony przez zespó³ techniczny Acajoom.<br>');
define('_ACA_UPDATE_URL_TIPS', 'Na przyk³ad: http://www.acajoom.com/update/ (razem z koñcowym slash-em)');

// module
define('_ACA_EMAIL_INVALID', 'Wprowadzony e-mail jest b³êdny.');
define('_ACA_REGISTER_REQUIRED', 'Proszê zarejestrowaæ siê w serwisie przed zapiseaniem siê na listê wysy³kow±.');

// Access level box
define('_ACA_OWNER', 'Twórca listy:');
define('_ACA_ACCESS_LEVEL', 'Ustaw poziom dostêpu do listy');
define('_ACA_ACCESS_LEVEL_OPTION', 'Opcje poziomu dostêpu');
define('_ACA_USER_LEVEL_EDIT', 'Wybierz, który poziom u¿ytkownika jest dopuszczony do redagowania listy (zarówno z poziomu panela jak i frontu strony) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Codziennie');
define('_ACA_AUTO_DAY_CH2', 'Codziennie bez weekendów');
define('_ACA_AUTO_DAY_CH3', 'Co dwa dni');
define('_ACA_AUTO_DAY_CH4', 'Co dwa dni bez weekendów');
define('_ACA_AUTO_DAY_CH5', 'Tygodniowo');
define('_ACA_AUTO_DAY_CH6', 'Co dwa tygodnie');
define('_ACA_AUTO_DAY_CH7', 'Miesiêcznie');
define('_ACA_AUTO_DAY_CH9', 'Rocznie');
define('_ACA_AUTO_OPTION_NONE', 'Nie');
define('_ACA_AUTO_OPTION_NEW', 'Nowy u¿ytkownik');
define('_ACA_AUTO_OPTION_ALL', 'Wszyscy u¿ytkownicy');

//
define('_ACA_UNSUB_MESSAGE', 'Email z resygnacj±');
define('_ACA_UNSUB_SETTINGS', 'Ustawienia rezygnacji');
define('_ACA_AUTO_ADD_NEW_USERS', 'Auto zapis?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Obecnie nie jest dostêpna ¿adna aktualizacja.');
define('_ACA_VERSION', 'Wersja Acajoom');
define('_ACA_NEED_UPDATED', 'Pliki, które powinny zostaæ uaktualnione:');
define('_ACA_NEED_ADDED', 'Pliki, które powinny zostaæ dodane:');
define('_ACA_NEED_REMOVED', 'Pliki konieczne do usuniêcia:');
define('_ACA_FILENAME', 'Nazwa pliku:');
define('_ACA_CURRENT_VERSION', 'Aktualna wersja:');
define('_ACA_NEWEST_VERSION', 'Nowsza wersja:');
define('_ACA_UPDATING', 'Uaktualnienie');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Pliki zosta³y pomy¶lnie zaktualizowane.');
define('_ACA_UPDATE_FAILED', 'Aktualizacja nieudana!');
define('_ACA_ADDING', 'Dodawanie');
define('_ACA_ADDED_SUCCESSFULLY', 'Pomy¶lnie dodano.');
define('_ACA_ADDING_FAILED', 'Dodanie nie udane!');
define('_ACA_REMOVING', 'Usuwanie');
define('_ACA_REMOVED_SUCCESSFULLY', 'Usuniêto pomy¶lnie.');
define('_ACA_REMOVING_FAILED', 'Usuwanie nieudane!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Zainstaluj inn± wersjê');
define('_ACA_CONTENT_ADD', 'Dodaj zawarto¶æ');
define('_ACA_UPGRADE_FROM', 'Import danych (newsletery i informacje o u¿ytkownikach) z');
define('_ACA_UPGRADE_MESS', 'Nie ma ¿adnego ryzyka dla Twoich danych. <br> TTen proces po prostu importuje dane do bazy danych systemu Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Kontynuacja wysy³ki');

// Acajoom message
define('_ACA_UPGRADE1', 'Mo¿esz w prosty sposób zaimportowaæ u¿ytkowników i newslettery z ');
define('_ACA_UPGRADE2', ' do Acajoom w panelu aktualizacji.');
define('_ACA_UPDATE_MESSAGE', 'Nowa wersja Acajoom jest dostêpna! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Kliknij aby zaktualizowaæ!');
define('_ACA_CRON_SETUP', 'Aby autoresponder by³ wysy³any nale¿y skonfigurowaæ zadania crona.');
define('_ACA_THANKYOU', 'Dziêkujemy za wybranie Acajoom, Twojego partnera w komunikacji!');
define('_ACA_NO_SERVER', 'Aktualizacja niedostêpna, prosimy wróciæ pó¼niej.');
define('_ACA_MOD_PUB', 'Acajoom modu³ nie zosta³ opublikowany.');
define('_ACA_MOD_PUB_LINK', 'Kliknij aby go opublikowaæ!');
define('_ACA_IMPORT_SUCCESS', 'zaimportowano pomy¶lnie');
define('_ACA_IMPORT_EXIST', 'subskrybent jest ju¿ w bazie danych');

// Acajoom\'s Guide
define('_ACA_GUIDE', ' Czarodziej');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom ma wiele ciekawych cech i ten Czarodziej bêdzie Ciê prowadziæ przez cztery proste kroki umo¿liwiaj±ce przesy³anie newsletterów i autoresponderów!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Po pierwsze, musisz dodaæ listê.  Mamy tu dwa rodzaje list: newsletter lub autoresponder.' .
		'  W li¶cie okre¶la siê wszystkie parametry umo¿liwiaj±ce wysy³anie newslettera lub autorespondera: nazwê nadawcy, uk³ad, komunikat powitalny dla subskrybenta itp...
<br><br>Tutaj mo¿esz ustawiæ swoj± pierwsz± listê: <a href="index2.php?option=com_acajoom&act=list" >utwórz listê</a> i klkinij przycisk Nowy.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom dostarcza bardzo przystêpne rozwi±zania umozliwiaj±ce import danych z innych systemów.<br>' .
		' Przejd¼ do panela uaktualnieñ i wybierz swój poprzedni system aby zaimportowaæ newslettery i u¿ytkowników.<br><br>' .
		'<span style="color:#FF5E00;" >WA¯NE: proces importu nie jest obarczony ryzykiem i nie wp³ynie w ¿aden sposób na dane w Twoim starszym systemie newslettera</span><br>' .
		'Po zaimportowaniu danych bêdzie mo¿liwe administrowanie subskrybentami i mailingami wprost z Acajoom.<br><br>');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Wspaniele, pierwsza lista jest ustawiona!  Teraz mo¿esz napisaæ swój pierwszy %s.  Aby go utworzyæ id¼ do: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Administracja auto-responderem');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Administracja newsletterem');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' i wybierz %s. <br> Nastêpnie wybierz %s z listy rozwijalnej.  Utwórz pierwszy mailing klikaj±c Nowy ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Zanim wy¶lesz swój pierwszy newsletter musisz sprawdziæ konfiguracjê poczty.  ' .
		'Przejd¼ do <a href="index2.php?option=com_acajoom&act=configuration" >strony konfiguracyjnej</a> aby zweryfikowaæ ustawienia e-mail. <br>');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br>Kiedy bêdziesz gotowy wróæ do menu newslettera, wybiezr mailing i kliknij Wy¶lij');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'W celu wys³ania autrespondera najpierw musisz skonfigurowaæ zadania crona na serwerze. ' .
		' Proszê przej¶æ do swojego panela aby skonfigurowaæ zadania crona.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >kliknij tu</a> aby dowiedzieæ siê wiêcej o konfiguracji crona. <br>');

define('_ACA_GUIDE_MODULE', ' <br>Upewnij siê czy modu³ Acajoom jest opublikowany aby odwiedzaj±cy mogli zapisaæ siê na listê.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Teraz mo¿esz równie¿ ustawiæ autoresponder.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Teraz mo¿esz równie¿ ustawiæ a newsletter.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br>Gratulacje! Jeste¶ gotów do efektywnego komunikowania siê z u¿ytkownikami i go¶æmi. Ten CZarodziej zakoñczy pracê po wys³aniu drugiego mailingu. Mo¿na go przywróciæ w <a href="index2.php?option=com_acajoom&act=configuration" >panelu konfiguracyjnym</a>.' .
		'<br><br>  Je¶li bêdziesz mieæ jakie¶ pytania w czasie u¿ywania Acajoom, proszê zadaæ je na  ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Mo¿esz tam te¿ znale¼æ wiele informacji jak efektywnie komunikowaæ siê ze swoimi subskrybentami <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br><b>Dziêkujemy, ¿e u¿ywasz Acajoom. Twojego partnera w komunikacji!</b> ');
define('_ACA_GUIDE_TURNOFF', 'Czarodziej zosta³ wy³±czony!');
define('_ACA_STEP', 'STEP ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Konfiguracja Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Pomy¶lnie zainstalowane');
define('_ACA_INSTALL_ERROR', 'B³±d instalacji');
define('_ACA_INSTALL_BOT', 'Acajoom Plugin (Bot)');
define('_ACA_INSTALL_MODULE', 'Modu³ Acajoom');
//Others
define('_ACA_JAVASCRIPT','!UWAGA! obs³uga javascript musi byæ w³±czona w czasie tej operacji.');
define('_ACA_EXPORT_TEXT','Eksportowani subskrybenci s± widoczni na liscie wyboru. <br>Eksportuj subskrybentów z listy');
define('_ACA_IMPORT_TIPS','Import subskrybentów. Informacja w pliku powinna mieæ nastêpuj±c± strukturê: <br>' .
		'Name,email,receiveHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmed(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'jest ju¿ subskrybentem');
define('_ACA_GET_STARTED', 'Klknij tu by rozpocz±æ!');

//News since 1.0.1
define('_ACA_WARNING_1011','Uwaga: 1011: Aktualizacja nie bêdzie mo¿liwa z powodu ograniczeñ serwera.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Wybierz adres e-mail, który bêdzie widoczny jako nadawca.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Wybierz imiê, które bêdzie widoczne jako nadawca.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Wybierz sposób wysy³ki e-maili: PHP mail , <span>Sendmail</span> lub SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'To jest katalog Mail serwera');
define('_ACA_LIST_T_TEMPLATE', 'Szablon');
define('_ACA_NO_MAILING_ENTERED', 'Mailing nie ustawiony');
define('_ACA_NO_LIST_ENTERED', 'Lista nie ustawiona');
define('_ACA_SENT_MAILING' , 'Wys³any mailing');
define('_ACA_SELECT_FILE', 'Prosze wybraæ plik do ');
define('_ACA_LIST_IMPORT', 'Zazanacz listy, które chcesz dowi±zaæ do subskrybentów.');
define('_ACA_PB_QUEUE', 'Subskrybent sopisany, ale wyst±pi³ problem z po³±czeniem go z list±. Dokonaj rêcznego wyboru.');
define('_ACA_UPDATE_MESS1' , 'Zalecana aktualizacja!');
define('_ACA_UPDATE_MESS2' , '£atki i drobne poprawki.');
define('_ACA_UPDATE_MESS3' , 'Nowa wersja.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 - potrzebna aktualizacja.');
define('_ACA_UPDATE_IS_AVAIL' , ' jest dostêpna!');
define('_ACA_NO_MAILING_SENT', 'Mailing niewys³any!');
define('_ACA_SHOW_LOGIN', 'Poka¿ formularz logowania');
define('_ACA_SHOW_LOGIN_TIPS', 'Wybierz aby pokazaæ formularz logowania do panela Acajoom na stronie.');
define('_ACA_LISTS_EDITOR', 'Edytor w opisie listy');
define('_ACA_LISTS_EDITOR_TIPS', 'Wybierz aby u¿yæ edytor HTML w opisie listy.');
define('_ACA_SUBCRIBERS_VIEW', 'Przegl±daj subskrybentów');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Ustawienia strony frontowej' );
define('_ACA_SHOW_LOGOUT', 'Poka¿ przycisk wylogowania');
define('_ACA_SHOW_LOGOUT_TIPS', 'Wybierza tak aby pokazaæ przycisk wylogowania w panelu Acajoom na stronie.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integracja');
define('_ACA_CB_INTEGRATION', 'Integracja z Community Builder');
define('_ACA_INSTALL_PLUGIN', 'Wtyczka do Community Builder (Integracja z Acajoom) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Wtyczka Acajoom do Community Builder nie jest jeszcze zainstalowana!');
define('_ACA_CB_PLUGIN', 'Listy przy rejestracji');
define('_ACA_CB_PLUGIN_TIPS', 'Wybierz aby pokazaæ listy wysy³kowe w formularzu rejestracji z komponentu CB');
define('_ACA_CB_LISTS', 'Listy IDs');
define('_ACA_CB_LISTS_TIPS', 'TO POLE JEST WYMAGANE. Wpisz numer identyfikacyjny listy, któr± maj± subskrybowaæ u¿ytkownicy. Kolejne identyfikatory oddziel przecinkiem (,) (0 pokazuje wszystkie listy)');
define('_ACA_CB_INTRO', 'Tekst wprowadzaj±cy');
define('_ACA_CB_INTRO_TIPS', 'Tekst, który bêdzie siê pojawiaæ przed wykazem. JE¦LI ZOSTAWISZ PUSTE NIC NIE BÊDZIE SIÊ WY¦WIETLAÆ.  Mo¿esz u¿yæ tagów HTML.');
define('_ACA_CB_SHOW_NAME', 'Poka¿ nazwê listy');
define('_ACA_CB_SHOW_NAME_TIPS', 'Wybierz je¶li chcesz wy¶wietlaæ nazwy list subskrypcyjnych po tekscie wprowadzaj±cym.');
define('_ACA_CB_LIST_DEFAULT', 'Ustaw listê jako domy¶ln±');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Wybierz je¶li chcesz ustawiæ listê jako domy¶ln±.');
define('_ACA_CB_HTML_SHOW', 'Poka¿ - "Wysy³ka HTML"');
define('_ACA_CB_HTML_SHOW_TIPS', 'Wybierz je¶li chcesz aby subskrybenci mogli zadecydowaæ czy chc± otrzymywaæ wiadomo¶ci w formacie HTML.');
define('_ACA_CB_HTML_DEFAULT', 'Domy¶lnie wysy³ka HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Opcja ustawia domy¶lny format mailingu.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Nie mo¿na zarchiwizowaæ pliku! Plik nie bêdzie zast±piony.');
define('_ACA_BACKUP_YOUR_FILES', 'Starsza wersja plików zostan± zariwizowane w nastêpuj±cym katalogu:');
define('_ACA_SERVER_LOCAL_TIME', 'SLokalny czas serwera');
define('_ACA_SHOW_ARCHIVE', 'Poka¿ przycisk archiwum');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Wybierz aby pokazaæ przycisk archiwum w wykazie newstellerów na stronie frontowej');
define('_ACA_LIST_OPT_TAG', 'Zak³adki');
define('_ACA_LIST_OPT_IMG', 'Ilustracje');
define('_ACA_LIST_OPT_CTT', 'Zawarto¶æ');
define('_ACA_INPUT_NAME_TIPS', 'Wpisz swoje imiê i nazwisko (koniecznie imiê pierwsze)');
define('_ACA_INPUT_EMAIL_TIPS', 'Wpisz swój adres e-mail (Upewnij siê czy jest to prawid³owy i aktualny adres.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Wybierz TAK, je¶³i akceptujesz maile w formacie HTML - NIE aby otrzymywaæ tylko wiadomo¶ci w formacie tekstowym');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Wybierz swoj± strefê czasow±.');

// Since 1.0.5
define('_ACA_FILES' , 'Pliki');
define('_ACA_FILES_UPLOAD' , 'Wy¶lij');
define('_ACA_MENU_UPLOAD_IMG' , 'Wy¶lij obrazki');
define('_ACA_TOO_LARGE' , 'Za du¿y plik. Makszmalnz doyowlonz roymiar to');
define('_ACA_MISSING_DIR' , 'Katalog nie istnieje');
define('_ACA_IS_NOT_DIR' , 'Katalog nie istnieje lub plik nieprawidlowy.');
define('_ACA_NO_WRITE_PERMS' , 'Katalog nie istnieje lub nie masz uprawnieñ do zapisu.');
define('_ACA_NO_USER_FILE' , 'Nie wybra³e¶ ¿adnych plików do wys³ania.');
define('_ACA_E_FAIL_MOVE' , 'Przesuniêcie pliku niemo¿liwe.');
define('_ACA_FILE_EXISTS' , 'Plik ju¿ istnieje.');
define('_ACA_CANNOT_OVERWRITE' , 'Plik ju¿ istnieje i nie mo¿e zostaæ nadpisany.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Niedupuszczalne rozszerzenie pliku.');
define('_ACA_PARTIAL' , 'Ten plik by³ czê¶ciowo wys³any.');
define('_ACA_UPLOAD_ERROR' , 'B³±d wysy³ki:');
define('DEV_NO_DEF_FILE' , 'Ten plik by³ czê¶ciowo wys³any.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Ten element bêdzie zast±piony linkiem do subskrypcji.' .
		' Pole <strong>wymagane</strong> aby Acajoom pracowa³ poprawnie.<br>' .
		'Je¶li umie¶cisz w tym polu inn± zawarto¶æ, bêdzie ona wy¶wietlana we wszystkich listach wysy³kowych.' .
		' <br> Dodaj na koñcu wiadomo¶æ o subskrypcji.  Acajoom automatycznie doda link dla subskrybenta umo¿liwiaj±cy zmianê ustawieñ subskrybcji lub wypisanie siê z listy.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Powiadomienie');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Powiadomienia');
define('_ACA_USE_SEF', 'SEF w mailingach');
define('_ACA_USE_SEF_TIPS', 'Zalecamy ustawienie tej opcji na NIE.  Jednak¿e, je¶li chcesz aby adresy URL za³±czone w mailingach u¿ywa³y opcji SEF, wybierz TAK.' .
		' <br><b> Linki bêda dzia³a³y tak samo dla obu opcji. </b> ');
define('_ACA_ERR_NB' , 'B³±d #: ERR');
define('_ACA_ERR_SETTINGS', 'B³±d ustawieñ');
define('_ACA_ERR_SEND' ,'Wy¶lij raport o b³êdach');
define('_ACA_ERR_SEND_TIPS' ,' Je¶li chcesz pomóc w ulepszeniu naszego produktu wybierz TAK.  Spowoduje to przes³anie raportu do nas.  WIêcej powiadomieñ nie bêdzie wiêc potrzeba ;-) <br> <b>PRYWATNE INFORMACJE NIE S¡ PRZESY£ANE</b>.  Nie wiemy sk±d pochodz± wiadomo¶ci o b³êdach. Wysy³ana jest tylko informacja o Acajoom , ustawieniach PHP i zapytaniach SQL. ');
define('_ACA_ERR_SHOW_TIPS' ,'Wybierz Tak aby wy¶wietlac numer b³êdu na ekranie.  U¿ywane g³ownie w celu wykrywania i usuwania usterek. ');
define('_ACA_ERR_SHOW' ,'Poka¿ b³êdy');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Poka¿ link do wypisania siê');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Wybierz aby pokazaæ link do wypisania siê lub zmiany ustawieñ subskrypcji list wysy³kowych w stopce ka¿dej wiadomo¶ci. <br> Ustawienie NIE wy³±cza stopkê i linki.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">WA¯NE POWIADMOMIENIE!</span> <br>Je¶li dokona³e¶ aktualizacji z poprzedniej wersji Acajoom powiniene¶ zaktualizowaæ strukturê bazy danych klikaj±c w nastêpuj±cy przycisk (Twoje dane zostan± nienaruszone)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Aktualizacja tabel i konfiguracji');
define('_ACA_MAILING_MAX_TIME', 'Maksymalny czas kolejki' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Zdefiniuj maksymalny czas dla wszystkich maili wysy³anych w kolejce. Zalecamy warto¶æ miêdzy 30s a 2min.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'Integracja z VirtueMart');
define('_ACA_VM_COUPON_NOTIF', 'Zawiadomienie o kupinie ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Wybierz numer ID mailingu w którym zamierzasz wys³aæ kupon rabatowy dla swoich klientów.');
define('_ACA_VM_NEW_PRODUCT', 'Zawiadomienie o nowych produktach ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Wybiezr numer ID mailingu w którym zamierzasz zawiadomiæ o nowych produktach.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Utwórz formularz');
define('_ACA_FORM_COPY', 'Kod HTML');
define('_ACA_FORM_COPY_TIPS', 'Skopiuj wygenerowany kod HTML na twoj± stronê.');
define('_ACA_FORM_LIST_TIPS', 'Wybierz listê w której chcesz za³±czyæ formularz');
// update messages
define('_ACA_UPDATE_MESS4' , 'To nie mo¿e byæ zaktualiyowane automatycznie.');
define('_ACA_WARNG_REMOTE_FILE' , 'Brak mo¿liwo¶ci otrzymania zdalnego pliku.');
define('_ACA_ERROR_FETCH' , 'B³±d przenoszonego pliku.');

define('_ACA_CHECK' , 'Wybierz');
define('_ACA_MORE_INFO' , 'Wiêcej informacji');
define('_ACA_UPDATE_NEW' , 'Aktualizacja do nowszej wersji');
define('_ACA_UPGRADE' , 'Aktualizacja do wy¿szego produktu');
define('_ACA_DOWNDATE' , 'Powrót do poprzedniej wersji');
define('_ACA_DOWNGRADE' , 'Powrót do podstawowego produktu');
define('_ACA_REQUIRE_JOOM' , 'Joomla wymagana');
define('_ACA_TRY_IT' , 'Wypróbuj!');
define('_ACA_NEWER', 'Nowsza');
define('_ACA_OLDER', 'Starsza');
define('_ACA_CURRENT', 'Aktualna');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Wypróbuj jeden z innych  komponentów');
define('_ACA_MENU_VIDEO' , 'Wideo tutorial');
define('_ACA_AUTO_SCHEDULE', 'Przypomnienie');
define('_ACA_SCHEDULE_TITLE', 'Ustawienia funkcji automatycznego przypomnienia');
define('_ACA_ISSUE_NB_TIPS' , 'Publikowane numery generowane s± automatycznie przez system' );
define('_ACA_SEL_ALL' , 'Wszystkie mailingi');
define('_ACA_SEL_ALL_SUB' , 'Wszystkie listy');
define('_ACA_INTRO_ONLY_TIPS' , 'Je¶li zaznaczysz tylko informacja wstêpna z artyku³u z linkiem czytaj wiêcej, bêdzie za³±czona do mailingu.' );
define('_ACA_TAGS_TITLE' , 'Zak³adka zawarto¶ci');
define('_ACA_TAGS_TITLE_TIPS' , 'Skopijuj i wklej t± zak³adkê do mailingu, w miejscu w którym chcesz wy¶wietliæ zawarto¶æ.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Podaj adres email, na który zostanie wys³any testowy mailing');
define('_ACA_PREVIEW_TITLE' , 'Podgl±d');
define('_ACA_AUTO_UPDATE' , 'Nowe powiadomienie o aktualizacji');
define('_ACA_AUTO_UPDATE_TIPS' , 'Wybierz tak je¶li chcesz zostaæ powiadomiony o nowej aktualizacji towjego komponentu. <br />WA¯NE!! Funkcja poka¿ tips-y musi byæ w³±czona aby powiadomienie dzia³a³o.');

// since 1.1.0
define('_ACA_LICENSE' , 'Informacja o licencji');


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
define('_ACA_REGWARN_NAME','Podaj swoje nazwisko i imie.');
define('_ACA_REGWARN_MAIL','Podaj poprawny adres e-mail.');

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
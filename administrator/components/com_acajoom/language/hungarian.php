<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
defined('_JEXEC') or die('...A közvetlen hozzáférés nem engedélyezett...');

/**
* <p>Hungarian language file</p>
* @author Joobi Ltd <support@acajoom.com>
* @version $Id: hungarian.php 401 2006-12-05 15:07:13Z divivo $
* @link http://www.joobiweb.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Az Acajoom komponens egy hírlevélkezelõ, automatikus válaszoló és ellenõrzõ eszköz a felhasználókkal való kapcsolattartás hatékonysága érdekében.  Acajoom, az Ön kommunikációs partnere!');
define('_ACA_FEATURES', 'Acajoom, az Ön kommunikációs partnere!');

// Type of lists
define('_ACA_NEWSLETTER', 'Hírlevél');
define('_ACA_AUTORESP', 'Automatikus válaszoló');
define('_ACA_AUTORSS', 'Automatikus RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Képeslap');
define('_ACA_PERF', 'Mûködés');
define('_ACA_COUPON', 'Kupon');
define('_ACA_CRON', 'Idõzítés feladat');
define('_ACA_MAILING', 'Levelezés');
define('_ACA_LIST', 'Lista');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Listakezelés');
define('_ACA_MENU_SUBSCRIBERS', 'Feliratkozók');
define('_ACA_MENU_NEWSLETTERS', 'Hírlevelek');
define('_ACA_MENU_AUTOS', 'Automatikus válaszolók');
define('_ACA_MENU_COUPONS', 'Kuponok');
define('_ACA_MENU_CRONS', 'Idõzítés feladatok');
define('_ACA_MENU_AUTORSS', 'Automatikus RSS');
define('_ACA_MENU_ECARD', 'eKépeslapok');
define('_ACA_MENU_POSTCARDS', 'Képeslapok');
define('_ACA_MENU_PERFS', 'Mûködések');
define('_ACA_MENU_TAB_LIST', 'Listák');
define('_ACA_MENU_MAILING_TITLE', 'Levelezések');
define('_ACA_MENU_MAILING' , 'Levelezés: ');
define('_ACA_MENU_STATS', 'Statisztika');
define('_ACA_MENU_STATS_FOR', 'Statisztika: ');
define('_ACA_MENU_CONF', 'Beállítás');
define('_ACA_MENU_UPDATE', 'Frissítések');
define('_ACA_MENU_ABOUT', 'Névjegy');
define('_ACA_MENU_LEARN', 'Képzés központ');
define('_ACA_MENU_MEDIA', 'Média kezelõ');
define('_ACA_MENU_HELP', 'Súgó');
define('_ACA_MENU_CPANEL', 'Vezérlõpult');
define('_ACA_MENU_IMPORT', 'Import');
define('_ACA_MENU_EXPORT', 'Export');
define('_ACA_MENU_SUB_ALL', 'Mindet felirat');
define('_ACA_MENU_UNSUB_ALL', 'Mindet leirat');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archivum');
define('_ACA_MENU_PREVIEW', 'Elõnézet');
define('_ACA_MENU_SEND', 'Küld');
define('_ACA_MENU_SEND_TEST', 'Teszt levél küldés');
define('_ACA_MENU_SEND_QUEUE', 'Feladatsor');
define('_ACA_MENU_VIEW', 'Megtekintés');
define('_ACA_MENU_COPY', 'Másolás');
define('_ACA_MENU_VIEW_STATS' , 'Megtekintési statisztika');
define('_ACA_MENU_CRTL_PANEL' , ' Vezérlõpult');
define('_ACA_MENU_LIST_NEW' , ' Új lista');
define('_ACA_MENU_LIST_EDIT' , ' Lista szerkesztés');
define('_ACA_MENU_BACK', 'Vissza');
define('_ACA_MENU_INSTALL', 'Telepítés');
define('_ACA_MENU_TAB_SUM', 'Összegzés');
define('_ACA_STATUS' , 'Állapot');

// messages
define('_ACA_ERROR' , ' Hiba történt! ');
define('_ACA_SUB_ACCESS' , 'Hozzáférési jogok');
define('_ACA_DESC_CREDITS', 'Készítõk');
define('_ACA_DESC_INFO', 'Információ');
define('_ACA_DESC_HOME', 'Webhely');
define('_ACA_DESC_MAILING', 'Levelezõ lista');
define('_ACA_DESC_SUBSCRIBERS', 'Feliratkozók');
define('_ACA_PUBLISHED','Publikálva');
define('_ACA_UNPUBLISHED','Visszavonva');
define('_ACA_DELETE','Törlés');
define('_ACA_FILTER','Szûrõ');
define('_ACA_UPDATE','Frissítés');
define('_ACA_SAVE','Mentés');
define('_ACA_CANCEL','Mégsem');
define('_ACA_NAME','Név');
define('_ACA_EMAIL','Email');
define('_ACA_SELECT','Válasszon!');
define('_ACA_ALL','Összes');
define('_ACA_SEND_A', 'Küldés: ');
define('_ACA_SUCCESS_DELETED', ' sikeresen törölve');
define('_ACA_LIST_ADDED', 'A lista sikeresen elkészült');
define('_ACA_LIST_COPY', 'A lista sikeresen másolva');
define('_ACA_LIST_UPDATED', 'A lista sikeresen frissítve');
define('_ACA_MAILING_SAVED', 'A levelezés sikeresen mentve.');
define('_ACA_UPDATED_SUCCESSFULLY', 'sikeresen frissítve.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Feliratkozói információk');
define('_ACA_VERIFY_INFO', 'Ellenõrizze a beküldött linket, néhány információ elveszett.');
define('_ACA_INPUT_NAME', 'Név');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'HTML formátum?');
define('_ACA_TIME_ZONE', 'Idõzóna');
define('_ACA_BLACK_LIST', 'Fekete lista');
define('_ACA_REGISTRATION_DATE', 'Felhasználói regisztrációs dátum');
define('_ACA_USER_ID', 'Felhasználó az');
define('_ACA_DESCRIPTION', 'Leírás');
define('_ACA_ACCOUNT_CONFIRMED', 'A regisztrációja aktíválva.');
define('_ACA_SUB_SUBSCRIBER', 'Feliratkozó');
define('_ACA_SUB_PUBLISHER', 'Publikáló');
define('_ACA_SUB_ADMIN', 'Adminisztrátor');
define('_ACA_REGISTERED', 'Regisztrált');
define('_ACA_SUBSCRIPTIONS', 'Feliratkozások');
define('_ACA_SEND_UNSUBCRIBE', 'Leiratkozási üzenet küldése');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Kattintson az Igen-re a leiratkozást megerõsítõ levél elküldéséhez!');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Kérjük, erõsítse meg a feliratkozását!');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Leiratkozás megerõsítése');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Kedves [NAME]!<br /><br />Még egy lépést kell megtennie a feliratkozás befejezéséig. Kattintson az alábbi linkre a feliratkozás megerõsítéséhez!<br /><br />[CONFIRM]<br /><br />Bármilyen kérdéssel forduljon az adminisztrátorhoz!<br /><br />Varanka Zoltán<br />(webmester - adminisztrátor)');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Kedves [NAME]!<br /><br />Ez egy megerõsítõ levél a hírlevél lemondásához. Sajnáljuk a döntését. Természetesen bármikor újra feliratkozhat a listára. Bármilyen kérdéssel forduljon az adminisztrátorhoz!<br /><br />Varanka Zoltán<br />(webmester - adminisztrátor)');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Bejelentkezési dátum');
define('_ACA_CONFIRMED', 'Megerõsítve');
define('_ACA_SUBSCRIB', 'Feliratkozás');
define('_ACA_HTML', 'HTML levelezések');
define('_ACA_RESULTS', 'Eredmények');
define('_ACA_SEL_LIST', 'Válasszon egy listát!');
define('_ACA_SEL_LIST_TYPE', '- Válasszon egy listatípust! -');
define('_ACA_SUSCRIB_LIST', 'Feliratkozók teljes listája');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Feliratkozók : ');
define('_ACA_NO_SUSCRIBERS', 'Ebben a listában nincsenek feliratkozók.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Küldtünk Önnek egy megerõsítõ levelet. Nézze át a postaládáját és kattintson a levélben levõ linkre.<br />A feliratkozását meg kell erõsítenie a levél segítségével.');
define('_ACA_SUCCESS_ADD_LIST', 'Ön sikeresen bekerült a listába.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Kattintson ide a feliratkozás megerõsítéséhez!');
define('_ACA_UNSUBSCRIBE_LINK', 'Kattintson ide a leiratkozáshoz!');
define('_ACA_UNSUBSCRIBE_MESS', 'Az Ön email címét eltávolítottuk a listából!');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Minden levél sikeresen elküldésre került.');
define('_ACA_MALING_VIEW', 'Levelezések megtekintése');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Biztosan szeretne leiratkozni a listáról?');
define('_ACA_MOD_SUBSCRIBE', 'Feliratkozás');
define('_ACA_SUBSCRIBE', 'Feliratkozás');
define('_ACA_UNSUBSCRIBE', 'Leiratkozás');
define('_ACA_VIEW_ARCHIVE', 'Archívum megtekintése');
define('_ACA_SUBSCRIPTION_OR', ' vagy kattintson ide az Ön információinak a frissítéséhez!');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Ez az email cím már a listában van.');
define('_ACA_SUBSCRIBER_DELETED', 'A feliratkozó sikeresen törölve.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Felhasználói vezérlõpult');
define('_UCP_USER_MENU', 'Felhasználói menü');
define('_UCP_USER_CONTACT', 'Feliratkozásaim');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Idõzítõ feladat kezelõ');
define('_UCP_CRON_NEW_MENU', 'Új idõzítés');
define('_UCP_CRON_LIST_MENU', 'Idõzítõm listája');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Kupon kezelõ');
define('_UCP_COUPON_LIST_MENU', 'Kupon lista');
define('_UCP_COUPON_ADD_MENU', 'Új kupon hozzáadás');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Leírás');
define('_ACA_LIST_T_LAYOUT', 'Kialakítás');
define('_ACA_LIST_T_SUBSCRIPTION', 'Feliratkozás');
define('_ACA_LIST_T_SENDER', 'Infó a küldõrõl');

define('_ACA_LIST_TYPE', 'Lista típus');
define('_ACA_LIST_NAME', 'Lista név');
define('_ACA_LIST_ISSUE', 'Kiadás száma');
define('_ACA_LIST_DATE', 'Küldés dátuma');
define('_ACA_LIST_SUB', 'Tárgy');
define('_ACA_ATTACHED_FILES', 'Csatolt fájlok');
define('_ACA_SELECT_LIST', 'Válassza ki a szerkesztendõ listát!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Lista típus');
define('_ACA_AUTO_RESP_OPTION', 'Automatikus válaszoló opciók');
define('_ACA_AUTO_RESP_FREQ', 'A feliratkozók kiválaszthatják a gyakoriságot');
define('_ACA_AUTO_DELAY', 'Késleltetés (napokban)');
define('_ACA_AUTO_DAY_MIN', 'Minimális gyakoriság');
define('_ACA_AUTO_DAY_MAX', 'Maximális gyakoriság');
define('_ACA_FOLLOW_UP', 'Az automatikus válaszoló beállítása');
define('_ACA_AUTO_RESP_TIME', 'A feliratkozók idõt választhatnak');
define('_ACA_LIST_SENDER', 'Lista küldõ');

define('_ACA_LIST_DESC', 'Lista leírás');
define('_ACA_LAYOUT', 'Kialakítás');
define('_ACA_SENDER_NAME', 'Küldõ neve');
define('_ACA_SENDER_EMAIL', 'Küldõ email címe');
define('_ACA_SENDER_BOUNCE', 'Küldõ válasz címe');
define('_ACA_LIST_DELAY', 'Késleltetés');
define('_ACA_HTML_MAILING', 'HTML levél?');
define('_ACA_HTML_MAILING_DESC', '(ha megváltoztatja ezt, mentenie kell majd visszatérni ehhez a képernyõhöz a változások megtekintésére.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Elrejtés a webes felületen?');
define('_ACA_SELECT_IMPORT_FILE', 'Válassza ki az importálandó fájlt!');;
define('_ACA_IMPORT_FINISHED', 'Az importálás befejezõdött');
define('_ACA_DELETION_OFFILE', 'Fájl törlése');
define('_ACA_MANUALLY_DELETE', 'meghiusult, kézzel kell törölnie a fájlt');
define('_ACA_CANNOT_WRITE_DIR', 'A könyvtár nem írható');
define('_ACA_NOT_PUBLISHED', 'A levél nem küldhetõ el, a lista nincs publikálva.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Kattintson ide a lista publikálásához!');
define('_ACA_INFO_LIST_NAME', 'Adja meg a lista nevét itt! Ezzel a névvel azonosíthatja a listát!');
define('_ACA_INFO_LIST_DESC', 'Adja meg a lista rövid leírását! Ezt a leírást látják a felhasználók.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Adja meg a levél küldõjének a nevét! Ezt a nevetlátják a feliratkozók, amikor levelet kapnak a listáról.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Adja meg azt az email címet, ahonnan az üzenetek küldésre kerülnek.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Adja meg azt az email címet,, ahova a feliratkozók válaszolhatnak. Ajánlatos, hogy ez megegyezzen a küldõ email címmel, mivel a spam szûrõk magasabb kockázatként kezelik, ha ezek különbözõek.');
define('_ACA_INFO_LIST_AUTORESP', 'Válassza ki a levelezés típusát ehhez a listához!<br />Hírlevél: normál hírlevél<br />Automatikus válaszoló: ez egy lista, amely megadott idõközönként küld levelet.');
define('_ACA_INFO_LIST_FREQUENCY', 'A felhasznlók megválaszthatják, hogy milyen gyakran kapjanak levelet. Ez nagy rugalmasságot biztosít.');
define('_ACA_INFO_LIST_TIME', 'A felhasználók megválaszthatják, hogy a hát melyik napján kapjanak levelet.');
define('_ACA_INFO_LIST_MIN_DAY', 'Milyen legyen az a minimális gyakoriság, amelyet a felhasználók megválaszthatnak, ha be akarják állítani a levelek fogadásának gyakorisságát?');
define('_ACA_INFO_LIST_DELAY', 'Adja meg a késleltetést az elõzõ és ezen automatikus válaszoló között!');
define('_ACA_INFO_LIST_DATE', 'Adja meg, mikor legyen publikálva a herlevél, ha késleltetettnek lett beállítva!<br /> Formátum: ÉÉÉÉ-HH-NN ÓÓ:PP:MM');
define('_ACA_INFO_LIST_MAX_DAY', 'Milyen legyen az a maximális gyakoriság, amelyet a felhasználók megválaszthatnak, ha be akarják állítani a levelek fogadásának gyakorisságát?');
define('_ACA_INFO_LIST_LAYOUT', 'Itt adhatja meg a levél kialakítását. Bármilyen kialakítást megadhat.');
define('_ACA_INFO_LIST_SUB_MESS', 'Ez a levél kerül elküldésre a felhasználónak az elsõ feliratkozáskor. Bármilyen szöveget meg lehet itt adni.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Ez a levél kerül elküldésre a felhasználónak az leiratkozik. Bármilyen szöveget meg lehet itt adni.');
define('_ACA_INFO_LIST_HTML', 'Pipálja ki a kijelölõdobozt, ha HTMLformában akarja a levelet elküldeni. A feliratkozók megadhatják, hogy HTML vagy szöveges formában kívánják-e fogadnia leveleket, amikor egy HTML listára iratkoznak fel.');
define('_ACA_INFO_LIST_HIDDEN', 'Kattintson az Igen-re a lista elrejtéséhez a webes felületen, a felhasználók ugyan nem iratkozhatnak fel,de azért meg lehet levelet küldeni.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Szeretné, hogy a felhasználók automatikusan feliratkozzanak erre a listára?<br /><B>Új felhasználók:</B>minden új felhasználó, aki regisztrál, feliratkozó is lesz egyben.<br /><B>Összes felhasználó:</B> minden regisztrált felhasználó feliratkozó is lesz egyben.<br />(támogatja a Community Buildert)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Válassza ki a webes felület hozzáférési szintjét! Ez megjeleníti vagy elrejti a levelezést azon csoportok esetén, amelynek nincs hozzáférési joga, tehát nem tudnak feliratkozni.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Válassza ki a hozzáférési szintjét annak a csoportnak, amelynek engedélyezni szeretmé a szerkesztést. Ez és az e feletti csoport szerkesztheti a levelezést és levelet küldhet ki mind a webes mind az adminisztrációs felületrõl.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Ha szeretné az automatikus válaszolót egy másokba mozgatni, amint eléri az utolsó üzenetet, megadhatja itt a nyomkövetõ automatikus válaszolót.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Ez a listát lértehozó személy azonosítója.');
define('_ACA_INFO_LIST_WARNING', '   Ez az utolsó opció csak a lista létrehozásakor elérhetõ.');
define('_ACA_INFO_LIST_SUBJET', ' A levelezés tárgya. Ez a szöveg kerül a levél tárgyába.');
define('_ACA_INFO_MAILING_CONTENT', 'Ez az elküldendõ levél törzse.');
define('_ACA_INFO_MAILING_NOHTML', 'Adja meg a levél törzsét, amelyet azoknak a feliratkozóknak kell elküldeni, akik csak szöveges levelet fogadnak. <BR/> Megjegyzés: ha üresen hagyja, a html formátumú szövegrész kerül ide szöveges formátumban.');
define('_ACA_INFO_MAILING_VISIBLE', 'Kattintson az Igen-re a levelezések megjelenítéséhez a webes felületen.');
define('_ACA_INSERT_CONTENT', 'Létezõ tartalom beszúrása');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'A kupon sikeresen elküldve!');
define('_ACA_CHOOSE_COUPON', 'Válasszon kupont!');
define('_ACA_TO_USER', ' ennek a felhasználónak');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Minden órában');
define('_ACA_FREQ_CH2', 'Minden 6 órában');
define('_ACA_FREQ_CH3', 'Minden 12 órában');
define('_ACA_FREQ_CH4', 'Naponta');
define('_ACA_FREQ_CH5', 'Hetente');
define('_ACA_FREQ_CH6', 'Havonta');
define('_ACA_FREQ_NONE', 'Nem');
define('_ACA_FREQ_NEW', 'Új felhasználól');
define('_ACA_FREQ_ALL', 'Összes felhasználó');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom idõzítõ?');
define('_ACA_LABEL_FREQ_TIPS', 'Kattintson az Igen-re, ha használni szeretné az Acajoom idõzítõtCron, A Nem beállítása más idõzítõ használatát teszi lehetõvé.<br />Ha az Igem-re kattint, nem kell megadnia az idõzítõ címét, ez automatikusan hozzáadódik.');
define('_ACA_SITE_URL' , 'Az Ön webhelyének URL-je');
define('_ACA_CRON_FREQUENCY' , 'Idõzítõ gyakoriság');
define('_ACA_STARTDATE_FREQ' , 'Kezdõ dátum');
define('_ACA_LABELDATE_FREQ' , 'Adja meg a dátumot!');
define('_ACA_LABELTIME_FREQ' , 'Adja meg az idõt!');
define('_ACA_CRON_URL', 'Idõzítõ URL');
define('_ACA_CRON_FREQ', 'Gyakoriság');
define('_ACA_TITLE_CRONLIST', 'Idõzítõ lista');
define('_NEW_LIST', 'Új lista készítése');

//title CRON form
define('_ACA_TITLE_FREQ', 'Idõzítõ szerkesztése');
define('_ACA_CRON_SITE_URL', 'Érvényes webhely URL-t adjon meg, kezdje http://-vel!');

### Mailings ###
define('_ACA_MAILING_ALL', 'Összes levelezés');
define('_ACA_EDIT_A', 'Szerkesztés: ');
define('_ACA_SELCT_MAILING', 'Válasszon egy listát a legördülõ menüben új levelezés hozzáadásához!');
define('_ACA_VISIBLE_FRONT', 'Látható a webes felületen');

// mailer
define('_ACA_SUBJECT', 'Tárgy');
define('_ACA_CONTENT', 'Tartalom');
define('_ACA_NAMEREP', '[NAME] = A feliratkozó nevére cserélõdik ki ez a kód, ezzel személyre szabhatja a levelet.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = A feliratkozó vezetéknevére (elsõ név) cserélõdik ki ez a kód.<br />');
define('_ACA_NONHTML', 'Nem-html verzió');
define('_ACA_ATTACHMENTS', 'Mellékletek');
define('_ACA_SELECT_MULTIPLE', 'Tartsa lenyomva a CTRL (vagy a Command) gombot több melléklet kiválasztásához.<br />A mellékletek listájában megjelenõ fájlokat egy külön könyvtárban helyezheti el, ez a könyvtár beállítható a beállítások paneljén.');
define('_ACA_CONTENT_ITEM', 'Tartalmi elem');
define('_ACA_SENDING_EMAIL', 'Levél küldése');
define('_ACA_MESSAGE_NOT', 'A levél nem küldhetõ el');
define('_ACA_MAILER_ERROR', 'Levélküldési hiba');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'A levél sikeresen elküldve');
define('_ACA_SENDING_TOOK', 'A levél elkóldése');
define('_ACA_SECONDS', 'másodpercet vett igénybe');
define('_ACA_NO_ADDRESS_ENTERED', 'Nincs email cím vagy feliratkozó megadva!');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Változtatás');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Változtat a feliratkozáson?');
define('_ACA_WHICH_EMAIL_TEST', 'Adja meg a tesztelésre használt email címet vagy válassza az elõnézetet!');
define('_ACA_SEND_IN_HTML', 'Küldés HTML módban (HTML leveleknél)?');
define('_ACA_VISIBLE', 'Látható');
define('_ACA_INTRO_ONLY', 'Csak bevezetõ');

// stats
define('_ACA_GLOBALSTATS', 'Globalis statisztika');
define('_ACA_DETAILED_STATS', 'Részletes statisztika');
define('_ACA_MAILING_LIST_DETAILS', 'Lista részletek');
define('_ACA_SEND_IN_HTML_FORMAT', 'Küldés HTML formátumban');
define('_ACA_VIEWS_FROM_HTML', 'Megtekintve (csak html leveleknél)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Küldés szöveges formátumban');
define('_ACA_HTML_READ', 'HTML olvasott');
define('_ACA_HTML_UNREAD', 'HTML nem olvasott');
define('_ACA_TEXT_ONLY_SENT', 'Csak szöveg');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Levél');
define('_ACA_LOGGING_CONFIG', 'Napló-statisztika');
define('_ACA_SUBSCRIBER_CONFIG', 'Feliratkozók');
define('_ACA_MISC_CONFIG', 'Egyéb');
define('_ACA_MAIL_SETTINGS', 'Levél beállítások');
define('_ACA_MAILINGS_SETTINGS', 'Levelezési beállítások');
define('_ACA_SUBCRIBERS_SETTINGS', 'Feliratkozó beállítások');
define('_ACA_CRON_SETTINGS', 'Idõzítõ beállítások');
define('_ACA_SENDING_SETTINGS', 'Küldési beállítások');
define('_ACA_STATS_SETTINGS', 'Statisztikai beállítások');
define('_ACA_LOGS_SETTINGS', 'Napló beállítások');
define('_ACA_MISC_SETTINGS', 'Egyéb beállítások');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Küldõ email');
define('_ACA_SEND_MAIL_NAME', 'Küldõ név');
define('_ACA_MAILSENDMETHOD', 'Levélküldõ mód');
define('_ACA_SENDMAILPATH', 'Sendmail útvonal');
define('_ACA_SMTPHOST', 'SMTP kiszolgáló');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP hitelesítés szükséges');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Válassza az Igen-t, ha az MTP szerver hitelesítést igényel');
define('_ACA_SMTPUSERNAME', 'SMTP felhasználónév');
define('_ACA_SMTPUSERNAME_TIPS', 'Adja meg az SMTP felhasználónevet, ha az SMTP szerver hitelesítést igényel!');
define('_ACA_SMTPPASSWORD', 'SMTP jelszó');
define('_ACA_SMTPPASSWORD_TIPS', 'Adja meg az SMTP jelszót, ha az SMTP szerver hitelesítést igényel!');
define('_ACA_USE_EMBEDDED', 'Beágyazott képek');
define('_ACA_USE_EMBEDDED_TIPS', 'Válassza az Igen-t, ha a mellékelt képeket be kell ágyazni a levélbe html formátum esetén vagy a Nem-et, ha a képek linkjeit szeretné elküldeni a levélben.');
define('_ACA_UPLOAD_PATH', 'Feltöltési/csatolási útvonal');
define('_ACA_UPLOAD_PATH_TIPS', 'Megadhatja a feltöltési könyvtárat.<br />Ellenõrizze, hogy a könyvtár létezik-e, ha szükséges hozza létre!');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Nem regisztráltak is');
define('_ACA_ALLOW_UNREG_TIPS', 'Válassza az Igen-t, ha a nem regisztrált felhasználók is feliratkozhatnak a listákra.');
define('_ACA_REQ_CONFIRM', 'Megerõsítés szükséges');
define('_ACA_REQ_CONFIRM_TIPS', 'Válassza az Igen-t, ha a nem regisztrált felhasználóknak meg kell erõsíteniük az email címüket.');
define('_ACA_SUB_SETTINGS', 'Feliratkozási beállítások');
define('_ACA_SUBMESSAGE', 'Feliratkozó levél');
define('_ACA_SUBSCRIBE_LIST', 'Feliratkozás egy listára');

define('_ACA_USABLE_TAGS', 'Használható címkék');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Kattintható linket készít, amellyel a feliratkozó megerõsítheti a feliratkozását. Ez <strong>szükséges</strong> az Acajoom megfelelõ mûködéséhez.<br /><br />[NAME] = Lecserélõdik a feliratkozó nevére, személyreszabva a küldött levelet.<br /><br />[FIRSTNAME] = Lecserélõdik a feliratkozó elsõ nevére (vezetéknév).<br />');
define('_ACA_CONFIRMFROMNAME', 'Megerõsítõ feladó név');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Adja meg a megerõsítõ listában megjelenõ nevet!');
define('_ACA_CONFIRMFROMEMAIL', 'Megerõsító feladó email cím');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Adja meg a megerõsítõ listában megjelenõ email címet!');
define('_ACA_CONFIRMBOUNCE', 'Válasz cím');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Adja meg a megerõsítõ listában megjelenõ válasz email címet!');
define('_ACA_HTML_CONFIRM', 'HTML megerõsítés');
define('_ACA_HTML_CONFIRM_TIPS', 'Vélassza az Igen-t, ha a megerõsítõ levelet html formában szeretné elküldeni, ha a feliratjozó lehetõvé teszi a html levél fogadását..');
define('_ACA_TIME_ZONE_ASK', 'Rákérdezés az idõzónára');
define('_ACA_TIME_ZONE_TIPS', 'Válassza az Igen-t, ha rá szeretne kérdezni a felhasználó idõzónájára. A levél a felhasználónak megfelelõ idõzóna szerinti idõben lesz elküldve, ahol ez alkalmazható.');

 // Cron Set up
define('_ACA_AUTO_CONFIG', 'Idõzítõ');
define('_ACA_TIME_OFFSET_URL', 'kattintson ide az eltolás beállításához az General Settings oldal Locale fülén');
define('_ACA_TIME_OFFSET_TIPS', 'Beállítja a szerver idõeltolását, hogy a felvett dátum és idõ adatok pontosak legyenek');
define('_ACA_TIME_OFFSET', 'Idõ eltolás');
define('_ACA_CRON_DESC','<br />Az idõzítõ funkcióval automatikus feladatot lehet beállítani a Joomla webhelyen!<br />Beállításához az alábbi utasítást kell adni az idõzítõ vezérlõpulthoz:<br /><b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> <br /><br />Ha segítségre van szüksége, keresse fel a <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a> oldal fórumát!');
// sending settings
define('_ACA_PAUSEX', 'Várakozzon x másodpercet minden beállított mennyiségû levélnél');
define('_ACA_PAUSEX_TIPS', 'Adja meg azt at idõt másodpercben, ameddig az Acajoom várakozik, mielõtt a következõ adag levelet elküldi.');
define('_ACA_EMAIL_BET_PAUSE', 'Levéladagok száma');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Az egyszerre elküldhetõ levelek száma.');
define('_ACA_WAIT_USER_PAUSE', 'Várakozás felhasználói bevitelte');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Két adag levél elküldése közben várakozzon-e a program felhasználói bevitelre?');
define('_ACA_SCRIPT_TIMEOUT', 'Idõ kifutás');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Idõ másodpercben, ameddig a program futhat.');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Statisztika olvasásának engedélyezése');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Válasszon Igen-t, ha szeretné naplózni a megtekintések számát. Ez csak html leveleknél használható');
define('_ACA_LOG_VIEWSPERSUB', 'Megtekintések naplózása feliratkozókként');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Válasszon Igen-t, ha szeretné naplózni a megtekintések számát felhasználókként. Ez csak html leveleknél használható');
// Logs settings
define('_ACA_DETAILED', 'Részletes napló');
define('_ACA_SIMPLE', 'Egyszerû napló');
define('_ACA_DIAPLAY_LOG', 'Napló megjelenítése');
define('_ACA_DISPLAY_LOG_TIPS', 'Válassza az Igen-t, ha szeretné megjeleníteni a naplózást a levelek elküldése során.');
define('_ACA_SEND_PERF_DATA', 'Küldési mûvelet');
define('_ACA_SEND_PERF_DATA_TIPS', 'Válassza az Igen-t, ha szeretne jelentést kapni a beállításokról, a feliratkozók számáról és az elküldés idõtartamáról. Ez informáiót ad az Acajoom mûködésérõl.');
define('_ACA_SEND_AUTO_LOG', 'Napló elküldése az automatikus válaszolónak.');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Válassza az Igen-t, ha a naplót szeretné elküldeni minden alkalommal, amikor a rendszer levelet küld. Figyelem: ez nagy méretû levelet is jelenthet.');
define('_ACA_SEND_LOG', 'Napló küldése');
define('_ACA_SEND_LOG_TIPS', 'Küldjön-e naplót a rendszer a levél küldõjének a címére.');
define('_ACA_SEND_LOGDETAIL', 'Részletes napló küldése');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Információ arról, hogy sikeres volt-e a levél elküldése az egyes feliratkozóknak. Alapban csak áttekintést küld.');
define('_ACA_SEND_LOGCLOSED', 'Napló küldése, ha megszakad a kapcsolat');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Ezzel az opcióval a küldõ minden esetben jelentést kap az elküldésekrõl.');
define('_ACA_SAVE_LOG', 'Napló mentése');
define('_ACA_SAVE_LOG_TIPS', 'A levelezés naplóbejegyzése bekerüljön-e a naplófájlba?');
define('_ACA_SAVE_LOGDETAIL', 'Részletes napló mentése');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'A részletes bejegyzés tartalmazza minden feliratkozóhoz elküldött levél sikerességét vagy meghiúsulását. At egyszerû csak áttekintést ad.');
define('_ACA_SAVE_LOGFILE', 'Naplófájl mentése');
define('_ACA_SAVE_LOGFILE_TIPS', 'Az a fájl, amibe a naplóbejegyzés kerül.Ez a fájl nagy méretûre is növekedhet.');
define('_ACA_CLEAR_LOG', 'Napló törlése');
define('_ACA_CLEAR_LOG_TIPS', 'Törli a napló fájl tartalmát.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Utoljára lefuttatott feladat');
define('_ACA_CP_TOTAL', 'Összes');
define('_ACA_MAILING_COPY', 'A levelezés sikeresen másolva!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Sorvezetõ használata');
define('_ACA_SHOW_GUIDE_TIPS', 'Jelenítse meg a sorvezetõt a használat elején segítve az új felhasználókat egy hírlvél, egy automatikus válaszoló létrehozásában és az Acajoom megfelelõ beállításában.');
define('_ACA_AUTOS_ON', 'Automatikus válaszolók használata');
define('_ACA_AUTOS_ON_TIPS', 'Válasszon Nem-et, ha nem akarja használni az automatikus válaszokókat, minden automatikus válaszoló kikapcsol.');
define('_ACA_NEWS_ON', 'Hírlevelek használata');
define('_ACA_NEWS_ON_TIPS', 'Válasszon Nem-t, ha nem akarja használni a hírleveleket, minden hírlevél opció kikapcsol.');
define('_ACA_SHOW_TIPS', 'Tippek megjelenítése');
define('_ACA_SHOW_TIPS_TIPS', 'Tippek megjelenítése a nagyobb hatékonyság érdekében.');
define('_ACA_SHOW_FOOTER', 'Lábléc megjelenítése');
define('_ACA_SHOW_FOOTER_TIPS', 'Megjelenjen-e a lábléc a copyright szöveggel.');
define('_ACA_SHOW_LISTS', 'Listák megjelenítése a webes felületen');
define('_ACA_SHOW_LISTS_TIPS', 'Ha a felhasználó nincs bejelentkezve, megjeleníti a listát illetve bejelentkezhetnek vagy regisztrálhatnak.');
define('_ACA_CONFIG_UPDATED', 'A konfigurációs beálítások frissítve!');
define('_ACA_UPDATE_URL', 'URL frissítése');
define('_ACA_UPDATE_URL_WARNING', 'Figyelem! Ne változtassa meg az URL-t, hacsak nem kért engedélyt az Acajoom technikai csapatától.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Például: http://www.acajoom.com/update/ (tartalmazza a lezáró perjelet)');

// module
define('_ACA_EMAIL_INVALID', 'A megadott email cím érvénytelen!');
define('_ACA_REGISTER_REQUIRED', 'Regisztráljon a feliratkozás elõtt!');

// Access level box
define('_ACA_OWNER', 'Lista készítõ:');
define('_ACA_ACCESS_LEVEL', 'Adja meg a lista hozzáférésének a szintjét!');
define('_ACA_ACCESS_LEVEL_OPTION', 'Hozzáférési szint opciók');
define('_ACA_USER_LEVEL_EDIT', 'Válassza ki, melyik szintnek van engedélyezve a levelezések szerkesztése (a webes vagy az adminisztrációs felületrõl');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Naponta');
define('_ACA_AUTO_DAY_CH2', 'Naponta hétvége kivételével');
define('_ACA_AUTO_DAY_CH3', 'Minden másnap');
define('_ACA_AUTO_DAY_CH4', 'Minden másnap hétvége kivételével');
define('_ACA_AUTO_DAY_CH5', 'Hetente');
define('_ACA_AUTO_DAY_CH6', 'Kéthetente');
define('_ACA_AUTO_DAY_CH7', 'Havonta');
define('_ACA_AUTO_DAY_CH9', 'Évente');
define('_ACA_AUTO_OPTION_NONE', 'Nem');
define('_ACA_AUTO_OPTION_NEW', 'Új felhasználók');
define('_ACA_AUTO_OPTION_ALL', 'Összes felhasználó');

//
define('_ACA_UNSUB_MESSAGE', 'Leiratkozó levél');
define('_ACA_UNSUB_SETTINGS', 'Leiratkozó beállítások');
define('_ACA_AUTO_ADD_NEW_USERS', 'Felhasználók automatikus feliratkozása?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Jelenleg nincs elérhetõ frissítés.');
define('_ACA_VERSION', 'Acajoom verzió');
define('_ACA_NEED_UPDATED', 'Frissítendõ fájlok:');
define('_ACA_NEED_ADDED', 'Hozzáadandó fájlok:');
define('_ACA_NEED_REMOVED', 'Eltávolítandó fájlok:');
define('_ACA_FILENAME', 'Fájlnév:');
define('_ACA_CURRENT_VERSION', 'Aktuális verzió:');
define('_ACA_NEWEST_VERSION', 'Legfrissebb verzió:');
define('_ACA_UPDATING', 'Frissítés');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'A fájlok sikeresen frissítve.');
define('_ACA_UPDATE_FAILED', 'A frissítés meghiúsult');
define('_ACA_ADDING', 'Hozzáadás');
define('_ACA_ADDED_SUCCESSFULLY', 'Sikeresen hozzáadva.');
define('_ACA_ADDING_FAILED', 'A hozzáadás meghiúsult!');
define('_ACA_REMOVING', 'Eltávolítás');
define('_ACA_REMOVED_SUCCESSFULLY', 'Sikeresen eltávolítva.');
define('_ACA_REMOVING_FAILED', 'Az eltávolítás meghiúsult!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Másik verzió telepítése');
define('_ACA_CONTENT_ADD', 'Tartalom hozzáadás');
define('_ACA_UPGRADE_FROM', 'Adatok importálása (névlevél és feliratkozó információ) : ');
define('_ACA_UPGRADE_MESS', 'A létezõ adatok nincsenek veszélyben.<br />Ez a mûvelet csak importálja az adatokat az Acajoom adatbázisába.');
define('_ACA_CONTINUE_SENDING', 'Küldés folytatása');

// Acajoom message
define('_ACA_UPGRADE1', 'Könnyen importálhatja a felhasználókat és a hírleveleket: ');
define('_ACA_UPGRADE2', ' az Acajoomba a frissítési panelen.');
define('_ACA_UPDATE_MESSAGE', 'Elérhetõ az Acajoom új verziója! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Kattintson ide a frissítéshez!');
define('_ACA_THANKYOU', 'Köszönjük, hogy az Acajoom-ot, az Ön kommunikációs partnerét választotta!');
define('_ACA_NO_SERVER', 'A frissítõ szerver nem érhetõ el, ellenõrizze késõbb!');
define('_ACA_MOD_PUB', 'Az Acajoom modul még nincs publikálva!');
define('_ACA_MOD_PUB_LINK', 'Kattintson ide a publikáláshoz!');
define('_ACA_IMPORT_SUCCESS', 'Sikeresen importálva');
define('_ACA_IMPORT_EXIST', 'A feliratkozó már az adatbázisban van');

// Acajoom's Guide
define('_ACA_GUIDE', ' varázsló');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Az Acajoom számtalan sajátsággal rendelkezik, ez a varázsló végig vezeti Önt négy egyszerû lépésen, amellyel el tudja készíteni hírleveleit és automatikus válaszolóit!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Elsõ lépésként létre kell hozni egy listát. Egy lista két típus egyike lehet vagy hírlevél vagy automatikus válaszoló. A listában paraméterekkel lehet szabályozni a hírlevelek küldését és és az automatikus válaszolók mûködését: küldõ neve, kialakítás, feliratkozók üdvözlõ üzenetei stb.<br /><br />Itt készítheti el az elsõ listát: <a href="index2.php?option=com_acajoom&act=list" >lista készítés</a> és kattintson a New gombon!');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Az Acajoom lehetõséget nyújt egy korábbi hírlevél rendszervõl adatok importálására.<br />Menjen a Frissítés panelre és válassza ki azt a hírlevél rendszert, ahonnan importálni szeretné a hírleveleket és a feliratkozókat.<br /><br /><span style="color:#FF5E00;" >Fontos: az importálás nem érinti a korábbi hírlevél rendszer adatait.</span><br />Az importálás után a levelezéseket és a feliratkozókat közvetlenül az Acajoom-ban tudja kezelni.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Gratulákunk, elkészült az elsõ lista!  Megírhatja az elsõ valamit: %s.  Ehhet menjen ide: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Automatikus válaszoló kezelõ');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Hírlevél kezelõ');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' és válassza ki: %s. <br />Majd válassza: %s a legördülõ listában. Az elsõ levelezés elkészítéséhez kattintson a New gombra!');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Mielõtt elküldi az elsõ hírlevelet, be kell állítani a levelezési konfigurációt. Menjen a <a href="index2.php?option=com_acajoom&act=configuration" >beállítások oldalra</a> ellenõrizni a beállításokat. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Ha ez kész, menjen vissza a Hírlevelek menübe és válassza ki a levelet és kattintson a Küldés gombra!');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Az elsõ automatikus véálaszoló hasznlatához egy idõzítõt kell beállítania a szerveren. Keresse meg a beállítások panelen az Idõzítõ fület! <a href="index2.php?option=com_acajoom&act=configuration" >Kattintson ide</a> az idõzítõ beállításával kapcsolatps további információkért!<br />');

define('_ACA_GUIDE_MODULE', ' <br />Ellenõrizze, hogy publikálta-e az Acajoom modult, amivel a érdeklõdõk feliratkozhatnak a listára.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Beállíthatja az automatikus válaszolót is.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Beállíthat egy hírlevelet is!');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Ön készen áll a hatékony kapcsolatra látogatóival és felhasználóival. Ez a varázsló befejezi mûködését, amint elkészíti a második levelezést vagy kikapcsolhatja <a href="index2.php?option=com_acajoom&act=configuration" >beállítások panelen</a>.<br /><br />Ha kérdése van az Acajoom, használatával kapcsolatban, használja a <a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=1" >fórumot</a>! Emellett számos információt is talál, hogy kommunikáljon hatékonyan a feliratkozókkal a <a href="http://www.acajoom.com/" target="_blank">www.Acajoom.com</a> oldalán.<p /><br /><b>Köszönjük, hogy az Acajoom-ot használja. Az Ön kommunikációs partnere!</b> ');
define('_ACA_GUIDE_TURNOFF', 'A varázsló kikapcsolásra kerül.');
define('_ACA_STEP', 'lépés ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom beállítás');
define('_ACA_INSTALL_SUCCESS', 'Sikeres telepítés');
define('_ACA_INSTALL_ERROR', 'Telepítési hiba');
define('_ACA_INSTALL_BOT', 'Acajoom beépülõ (robot)');
define('_ACA_INSTALL_MODULE', 'Acajoom modul');
//Others
define('_ACA_JAVASCRIPT','Figyelem: A Javascript-et engedélyezni kell a megfelelõ mûködéshez.');
define('_ACA_EXPORT_TEXT','Az exportált feliratkozók a válaszott listán alapulnak.<br />Feliratkozók exportálása listából');
define('_ACA_IMPORT_TIPS','Feliratkozók importálása. A fájlban levõ tartalomnak az alábbi formátumúnak kell lennie: <br />Name,Email,ReceiveHTML(1/0),<span style="color: rgb(255, 0, 0);">Registered(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'már létezõ feliratkozó');
define('_ACA_GET_STARTED', 'Kattintson ide az indításhoz!');

//News since 1.0.1
define('_ACA_WARNING_1011','Figyelem: 1011: A frissítés nem mûködik, mert a szerver visszautasította.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Válassza ki, melyik email cím jelenjen meg küldõként!');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Válassza ki, milyen név jelenjen meg küldõként!');
define('_ACA_MAILSENDMETHOD_TIPS', 'Válassza ki milyen levélküldõt szeretne jasználni: PHP mail függvény, <span>Sendmail</span> or SMTP szerver.');
define('_ACA_SENDMAILPATH_TIPS', 'Ez a levél szerver könyvtára');
define('_ACA_LIST_T_TEMPLATE', 'Sablon');
define('_ACA_NO_MAILING_ENTERED', 'Nincs levelezés megadva');
define('_ACA_NO_LIST_ENTERED', 'Nincs lista megadva');
define('_ACA_SENT_MAILING' , 'Levelek elküldése');
define('_ACA_SELECT_FILE', 'Válasszon egy fájlt: ');
define('_ACA_LIST_IMPORT', 'Ellenõrizze a listát, amelyhez feliratkozókat szeretne hozzárendelni.');
define('_ACA_PB_QUEUE', 'A feliratkozó be lett szúrva de probléma van vele a listához csatolásnál. Ellenõrizze manuálisan!');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'A frissítés erõsen ajánlott!');
define('_ACA_UPDATE_MESS2' , 'Folt és kisebb javítások.');
define('_ACA_UPDATE_MESS3' , 'Új kiadás.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 szükséges a frissítéshez.');
define('_ACA_UPDATE_IS_AVAIL' , ' elérhetõ!');
define('_ACA_NO_MAILING_SENT', 'Nem lett elküldve levél!');
define('_ACA_SHOW_LOGIN', 'Bejelentkezési ûrlap megjelenítése');
define('_ACA_SHOW_LOGIN_TIPS', 'Válasszon Igen-t, ha szeretné, hogy a bejelentkezési ûrlap megjelenjen az Acajoom webes felületének vezérlõpultján, hogy a felhasználók regisztrálhassanak a webhelyen..');
define('_ACA_LISTS_EDITOR', 'Lista leíró szerkesztõ');
define('_ACA_LISTS_EDITOR_TIPS', 'Válasszon Igen-t HTML szövegszerkesztõ használatához a a lista leírásának mezõjében.');
define('_ACA_SUBCRIBERS_VIEW', 'Feliratkozók megtekintése');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Webes beállítások' );
define('_ACA_SHOW_LOGOUT', 'Kijelentkezés gomb megjelenítése');
define('_ACA_SHOW_LOGOUT_TIPS', 'Válassza az Igen-t, ha meg akarja jeleníteni a Kijelentkezés gombot az AcaJoom vezérlõpult webes felületén.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integráció');
define('_ACA_CB_INTEGRATION', 'Community Builder integráció');
define('_ACA_INSTALL_PLUGIN', 'Community Builder beépülõ (Acajoom integráció) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Az Acajoom beépülõ a Community Builderbe még nincs telepítve!');
define('_ACA_CB_PLUGIN', 'Listák regisztráláskor');
define('_ACA_CB_PLUGIN_TIPS', 'Válassza az Igen-t, ha a levelezõ listákat meg akarja jeleníteni a Community Builder regisztrációs ûrlapján');
define('_ACA_CB_LISTS', 'Lista azonosítók');
define('_ACA_CB_LISTS_TIPS', 'EZ KÖTELEZÕ MEZÕ. Adja meg a listák azonosítóját vesszõvel elválasztva, amely ekre a felhasználó feliratkozhat . (0 az összes listát megjeleníti)');
define('_ACA_CB_INTRO', 'Bevezetõ szöveg');
define('_ACA_CB_INTRO_TIPS', 'A lista elõtt megjelenõ szöveg. HAGYJA ÜRESEN, HA NEM AKAR MEGJELENÍTENI SEMMIT!. Használja a cb_pretext-et a CSS-hez!.');
define('_ACA_CB_SHOW_NAME', 'Listanév megjelenítése');
define('_ACA_CB_SHOW_NAME_TIPS', 'Döntse el, hogy szeretné-e megjeleníteni a listaneveket a bevezetõ után!');
define('_ACA_CB_LIST_DEFAULT', 'Listák bejelölése alapértelmezésként');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Döntse el, hogy szeretné-e alapértelmezésként bejelölni minden listát!');
define('_ACA_CB_HTML_SHOW', 'HTML formátumban?');
define('_ACA_CB_HTML_SHOW_TIPS', 'Válassza az Igen-t, ha a felhasználók eldönthetik, hogy szeretnének-e HTML leveleket vagy sem. Állítsa Nem-re, ha alapértelmezésként HTML levelet akar használni!');
define('_ACA_CB_HTML_DEFAULT', 'Alapértelmezetten HTML formátumban?');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Állítsa be ezt a lehetõséget az alapértelmezett HTML levelezési beállítások megjelenítéséhez! Ha a HTML formátumban? bejegyzés Nem, akkor ez az opció lesz az alapértelmezett.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'A fájlrõl nem készíthetõ biztonsági másolat! A fájl nem került lecserélésre.');
define('_ACA_BACKUP_YOUR_FILES', 'A fájlok régebbi verziója mentésre került a következõ könyvtárban:');
define('_ACA_SERVER_LOCAL_TIME', 'Helyi szerver idõ');
define('_ACA_SHOW_ARCHIVE', 'Archívum gomb megjelenítése');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Válasszon Igen-t a hírlevelek listájának végén az Archívum gomb megjelenítéséhez');
define('_ACA_LIST_OPT_TAG', 'Kódok');
define('_ACA_LIST_OPT_IMG', 'Képek');
define('_ACA_LIST_OPT_CTT', 'Tartalom');
define('_ACA_INPUT_NAME_TIPS', 'Adja meg a teljes nevét (a keresztnevével kezdje)!');
define('_ACA_INPUT_EMAIL_TIPS', 'Adja meg az email címét! Ellenõrizze, hogy ez egy valódi email cím, ha valóban szeretne hírleveletet kapni!');
define('_ACA_RECEIVE_HTML_TIPS', 'Válasszon Igen-t, ha HTML hírleveleket szeretne kapni - vagy Nem-et, ha csak szöveges hírleveleket.');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Adja meg az idõzónáját!');

// Since 1.0.5
define('_ACA_FILES' , 'Fájlok');
define('_ACA_FILES_UPLOAD' , 'Feltöltés');
define('_ACA_MENU_UPLOAD_IMG' , 'Képek feltöltése');
define('_ACA_TOO_LARGE' , 'A fájl mérete túl nagy. A maximális méret:');
define('_ACA_MISSING_DIR' , 'A célkönyvtár nem létezik');
define('_ACA_IS_NOT_DIR' , 'A célkönyvtár nem létezik vagy pedig egy szabályos fájl.');
define('_ACA_NO_WRITE_PERMS' , 'A célkönyvtáron nincs írási jog.');
define('_ACA_NO_USER_FILE' , 'Nem válaszotta ki a feltöltendõ fájlt!');
define('_ACA_E_FAIL_MOVE' , 'A fájl nem helyezhetõ át!');
define('_ACA_FILE_EXISTS' , 'A célfájl már létezik.');
define('_ACA_CANNOT_OVERWRITE' , 'A célfájl már létezik vagy nem írható felül.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Nem engedélyezett fájlkiterjesztés.');
define('_ACA_PARTIAL' , 'A fájl csak részben került feltöltésre.');
define('_ACA_UPLOAD_ERROR' , 'Feltöltési hiba:');
define('DEV_NO_DEF_FILE' , 'A fájl csak részben került feltöltésre.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Ez lecserélésre kerül a feliratkozási linkekkel. Ez <strong>szükséges</strong> az Acajoom helyes mûködéséhez.<br />Ha bármilyen más tartalmat helyez el ebben a dobozban, ez a lista összes levelezésében meg fog jelenni.<br />Tegye a saját feiratkozási üzeneteit a végére Az Acajoom automatikusan hozzáadja a feliratkozás megváltoztatásához és a leiratkozáshoz szükséges linkeket.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Értesítés');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Értesítések');
define('_ACA_USE_SEF', 'SEF a levelezésben');
define('_ACA_USE_SEF_TIPS', 'Ajánlott a nem választása. Ha szeretné, hogy a levelezésben használt URL használja a SEF-et, akkor válassza az igent!<br /><b>A linkek mindegyik opcióhoz ugyanúgy mûködnek. Nem biztos, hogy a levelezésben a linkek mindig mûködnek, ha megváltozik a SEF.</b> ');
define('_ACA_ERR_SETTINGS', 'Hibakezelõ beállítások');
define('_ACA_ERR_SEND' ,'Hiba jelentés küldése');
define('_ACA_ERR_SEND_TIPS' ,'Ha szeretné, hogy az Acajoom jobb termékké váljon, válassza az Igen-t! Ez hibajelentést küld a fejlesztõknek. Így nem szükséges hibakutatást végeznie.<br /> <b>SEMMILYEN MAGÁNJELLEGÛ INFORMÁCIÓNEM KERÜL ELKÜLDÉSRE</b>. Még azt sem fogják tudni, melyik webhelyrõl érkezik a hibajelentés. Csak az Acojoomról kapnak informciót, a PHP beállításokról és az SQL lekérdezésekrõl. ');
define('_ACA_ERR_SHOW_TIPS' ,'Válasszon Igen-t a hiba sorszámának megjelenítéséhez a képernyõn. Fõleg hibakeresésre lehet használni. ');
define('_ACA_ERR_SHOW' ,'Hibák megjelenítése');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Leiratkozási linkek megtekintése');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Válasszon Igen-t a leiratkozáso linkek megjelenítéséhez  a levél alján, ahol a felhasználók megváltoztathatják a feliratkozásaikat. <br /> A Nem letiltja a láblécet és a linkeket.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">FONTOS MEGJEGYZÉS!</span> <br />Ha korábbi Acajoom verzióról frissít, frissíteni kell az adatbázis struktúrát is a következõ gombra kattintva (az adatok integritása megmarad)');
define('_ACA_UPDATE_INSTALL_BTN' , 'A táblák és a beállítások frissítése');
define('_ACA_MAILING_MAX_TIME', 'Maximális várakozási idõ' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Megadja azt a maximális idõt, ameddig a leveleknek várakozniuk kell asorban. Az ajánlott érték 30 másodperc és 2 perc közöztt van.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart integráció');
define('_ACA_VM_COUPON_NOTIF', 'Kupon értesítési azonosító');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Megadja a levelezés azonosítószámát, amit kuponok küldésekor szeretne használni.');
define('_ACA_VM_NEW_PRODUCT', 'Új termék értesítés azonosító');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Megadja a levelezés azonosítószámát, amit új termék értesítésnél szeretne használni.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Ûrlap létrehozása');
define('_ACA_FORM_COPY', 'HTML kód');
define('_ACA_FORM_COPY_TIPS', 'Másolja a generált HTML kódot a HTML oldalra!');
define('_ACA_FORM_LIST_TIPS', 'Válassza ki a listából az ûrlapba beszúrandó tartalmat!');
// update messages
define('_ACA_UPDATE_MESS4' , 'Nem frissíthetõ automatikusan.');
define('_ACA_WARNG_REMOTE_FILE' , 'Távoli fájl nem érhetõ el.');
define('_ACA_ERROR_FETCH' , 'Hiba a fájl elérésekor.');

define('_ACA_CHECK' , 'Ellenõrzés');
define('_ACA_MORE_INFO' , 'További infó');
define('_ACA_UPDATE_NEW' , 'Frissítés újabb verzióra');
define('_ACA_UPGRADE' , 'Frissítés a legfrissebb termékre');
define('_ACA_DOWNDATE' , 'Visszaállás elõzõ verzióra');
define('_ACA_DOWNGRADE' , 'Vissza az alaptermékre');
define('_ACA_REQUIRE_JOOM' , 'Joomla szükséges');
define('_ACA_TRY_IT' , 'Próbálja ki!');
define('_ACA_NEWER', 'Újabb');
define('_ACA_OLDER', 'Régebbi');
define('_ACA_CURRENT', 'Aktuális');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Próbáljon ki egyet a többi komponens közül!');
define('_ACA_MENU_VIDEO' , 'Videó bemutatók');
define('_ACA_SCHEDULE_TITLE', 'Automatikus idõbeállító funkció beállítása');
define('_ACA_ISSUE_NB_TIPS' , 'A kiadás számának automatikus generálása' );
define('_ACA_SEL_ALL' , 'Összes levelezés');
define('_ACA_SEL_ALL_SUB' , 'Összes lista');
define('_ACA_INTRO_ONLY_TIPS' , 'Ha kipipálja ezt a dobozt, csak a cikk bevezetõ szövege kerül be a levélbe egy Tovább linkkel.' );
define('_ACA_TAGS_TITLE' , 'Tartalom kód');
define('_ACA_TAGS_TITLE_TIPS' , 'Vágólapon keresztül tegye ezt a kódot a levél, ahol a tartalmat szeretné elhelyezni.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Jelzi az email címet, ahova a tesztet el kell küldeni');
define('_ACA_PREVIEW_TITLE' , 'Elõnézet');
define('_ACA_AUTO_UPDATE' , 'Új frissítési értesítés');
define('_ACA_AUTO_UPDATE_TIPS' , 'Válasszon Igen-t, ha szeretne értesítést a komponens frissítésérõl! <br />FONTOS! A tippek megjelenítése szükséges ennek afunkciónak a mûködéséhez.');

// since 1.1.0
define('_ACA_LICENSE' , 'Licensz információ');

// since 1.1.1
define('_ACA_NEW' , 'Új');
define('_ACA_SCHEDULE_SETUP', 'Az automatikus válaszoló mûködéséhez be kell állítani az idõzítõt a beállításoknál..');
define('_ACA_SCHEDULER', 'Idõzítõ');
define('_ACA_ACAJOOM_CRON_DESC' , 'ha nincs hozzáférése a webhelyen az idõzítõ feladat kezelõhöz, regisztrálhat egy ingyenes Acajoom idõzítõt itt:' );
define('_ACA_CRON_DOCUMENTATION' , 'Az Acajoom idõzítõ beállításaihoz további információkat itt talál:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'A feladatsor sikeresen feldolgozásra került...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Hiba az importált fájl mozgatása közben' );

//since 1.1.2
define( '_ACA_SCHEDULE_FREQUENCY' , 'Idõzítõ gyakoriság' );
define( '_ACA_CRON_MAX_FREQ' , 'Idõzítõ maximális gyakoriság' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Adja meg azt a maximális gykoriságot, amikor az idõzítõ fut (percekben).  Ez korlázozza az idõzítõt még akkor is, ha az idõzítõ feladat gyakorisága ennél rövidebb idõre van beállítva.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Feladatonkénti maximális levélszám' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Megadja meg a feladatonként elküldhetõ levelek maximális számát (0 - korlátlan).' );
define( '_ACA_CRON_MINUTES' , ' perc' );
define( '_ACA_SHOW_SIGNATURE' , 'Levél lábléc megjelenítése' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Megjelenjen-e az Acajoom-ot népszerûsítõ lábléc a levelekben.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Az automatikus válaszolók feladatai sikeresen feldolgozva...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Az idõzített hírlevelek feldolgozása sikeres...' );
define( '_ACA_MENU_SYNC_USERS' , 'Felhasználók szinkronizásása' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'A felhasználók szinkronizásása sikeres!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Kijelentkezés' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Igen' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Nem' );
if (!defined('_HI')) define( '_HI', 'Üdvözöljük' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Felül' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Lent' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Kijelentkezés' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Ha ezt kijelöli, csak a teljes cikkre mutató cikk cím kerül be linkként a levélbe.');
define('_ACA_TITLE_ONLY' , 'Csak cím');
define('_ACA_FULL_ARTICLE_TIPS' , 'Ha ezt kijelöli, a levélbe a cikk teljes tartalma bekerül');
define('_ACA_FULL_ARTICLE' , 'Teljes cikk');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Válasszon ki egy tartalmi elemet, amely bekerül a levélba.<br />Vágólapon keresztül helyezze el a <b>tartalom kódot</b> a levélbe!  Választhatja a teljes szöveget, csak a bevezetõt vagy csak a címet (0, 1, vagy 2). ');
define('_ACA_SUBSCRIBE_LIST2', 'Levelezõ listák');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Gyors hírlevél');
define('_ACA_MENU_AUTONEWS', 'Gyors hírlevelek');
define('_ACA_AUTO_NEWS_OPTION', 'Gyors hírlevél opciók');
define('_ACA_AUTONEWS_FREQ', 'Hírlevél gyakoriság');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Adja meg azt a gyakoriságot, ami szerint küldeni szeretné a gyors hírleveleket!');
define('_ACA_AUTONEWS_SECTION', 'Cikk szekció');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Válassza ki a szekciót, amelybõl cikket szeretne kijelölni!');
define('_ACA_AUTONEWS_CAT', 'Cikk kategória');
define('_ACA_AUTONEWS_CAT_TIPS', 'Válassza ki a kategóriát, amelybõl cikket szeretne kijelölni (Mind - összes cikk az adott szekcióból)!');
define('_ACA_SELECT_SECTION', 'Válasszon szekciót!');
define('_ACA_SELECT_CAT', 'Összes kategória');
define('_ACA_AUTO_DAY_CH8', 'Negyedévente');
define('_ACA_AUTONEWS_STARTDATE', 'Kezdõ dátum');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Adja meg azt a kezdõ dátumot, amitõl a gyors hírleveleket küldeni szeretné!');
define('_ACA_AUTONEWS_TYPE', 'Tartalom összeállítás');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Teljes cikk: a teljes cikk bekerül a levélbe<br />' .		'Csak bevezetõ: csak a cikk bevezetõje kerül be a levélbe<br/>' .		'Csak cím: csak a cikk címe kerül be a levélbe');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Ezt a gyors hírlevél cseréli le.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Levelezés létrehozás / megtekintés');
define('_ACA_LICENSE_CONFIG' , 'Licensz' );
define('_ACA_ENTER_LICENSE' , 'Adja meg a licensz kódot!');
define('_ACA_ENTER_LICENSE_TIPS' , 'Írja be a licensz kódot és mentse el.');
define('_ACA_LICENSE_SETTING' , 'Licensz beállítások' );
define('_ACA_GOOD_LIC' , 'Érvényes licensz.' );
define('_ACA_NOTSO_GOOD_LIC' , 'Nem érvényes licensz: ' );
define('_ACA_PLEASE_LIC' , 'Vegye fel a kapcsolatot az Acajoom támogatóival a licensz frissítése érdekében  ( license@acajoom.com ).' );
define('_ACA_DESC_PLUS', 'Az Acajoom Plus az elsõ szekvenciális automatikus válaszoló komponens Joomla rendszerre.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Az Acajoom PRO egy fejlett hírlevélküldõ rendszer Joomla rendszerre.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , 'Adja meg az azonosítót!');

define('_ACA_ENTER_TOKEN_TIPS' , 'Adja meg azt az azonosítót, amit emailben kapott meg az Acajoom megvásárlásakor!<br />Ezután mentsen! Az Acajoom automatikusan kapcsolódik a szerverhez egy licenszszám lekéréséhez.');

define('_ACA_ACAJOOM_SITE', 'Acajoom webhely:');
define('_ACA_MY_SITE', 'Webhelyem:');

define( '_ACA_LICENSE_FORM' , ' ' .	'Kattintson ide a licensz ûrlaphoz ugráshoz!</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Törölje a licensz mezõt ás próbálja meg újra!<br />Ha a probléma továbba is fennáll, ' );

define( '_ACA_LICENSE_SUPPORT' , 'A még mindig van kérdése, ' . _ACA_PLEASE_LIC );

define( '_ACA_LICENSE_TWO' , 'a Licensz ûrlapon lekérheti a licenszet kézi módszerrel is az azonosító és a saját webhely URL megadásával (amelyik zöld színnek jelenik meg ennek az oldalnak a felsõ részén). ' . _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );

define('_ACA_ENTER_TOKEN_PATIENCE', 'Az azonosító mentése után automatikusan egy licensz kód generálódik. Az azonosító általában 2 percen belül ellenõrzésre kerül, de bizonyos esetekben 15 percig is eltarthat..<br /><br />Térjen vissza erre az ellenõrzésre néhány perc mulva!<br /><br />Ha nem kap érvényes licensz kódot 15 percen belül, '. _ACA_LICENSE_TWO);


define( '_ACA_ENTER_NOT_YET' , 'A megadott azonosító még nem lett ellenõrizve.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Látogasson el a <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> oldalra a legfrissebb verzió letöltéséhez.');
define( '_ACA_NOTIF_UPDATE' , 'Ahhoz, hogy értesüljön az új frissítésekrõl, adja meg az email címét és kattintson a Feliratkozás linkre!');

define('_ACA_THINK_PLUS', 'Ha többet szeretne kihozni levelezõ rendszerébõl, gondoljon a Plus verzióra!');
define('_ACA_THINK_PLUS_1', 'Szekvenciális automatikus válaszolók');
define('_ACA_THINK_PLUS_2', 'Hírlevél idõzítése egy elõre megadott idõpontra!');
define('_ACA_THINK_PLUS_3', 'Nincs többé szerver korlát');
define('_ACA_THINK_PLUS_4', 'És sok más egyéb...');

//since 1.2.2
define( '_ACA_LIST_ACCESS', 'Lista hozzáférés' );
define( '_ACA_INFO_LIST_ACCESS', 'Adja meg, hogy milyen felhasználócsoportok láthatják és iratkozhatnak fel erre a listára!' );
define( 'ACA_NO_LIST_PERM', 'Nincs jogosultsága feliratkozni erre a listára!' );

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', 'Archívál');
 define('_ACA_MENU_ARCHIVE_ALL', 'Mindet archívál');

//Archive Lists
 define('_FREQ_OPT_0', 'Nincs');
 define('_FREQ_OPT_1', 'Hetente');
 define('_FREQ_OPT_2', 'Két hetente');
 define('_FREQ_OPT_3', 'Havonta');
 define('_FREQ_OPT_4', 'Negyed évente');
 define('_FREQ_OPT_5', 'Évente');
 define('_FREQ_OPT_6', 'Egyéb');

define('_DATE_OPT_1', 'Létrehozás dátum');
define('_DATE_OPT_2', 'Módosítás dátum');

define('_ACA_ARCHIVE_TITLE', 'Automatikus archíválás gyakoriságának beállítása');
define('_ACA_FREQ_TITLE', 'Archíválási gyakoriság');
define('_ACA_FREQ_TOOL', 'Adja meg, hogy milyen gyakran arhíválja az Archívum kezelõ a webhelye tartalmát!.');
define('_ACA_NB_DAYS', 'Napok száma');
define('_ACA_NB_DAYS_TOOL', 'Ez csak az Egyéb opcióra vonatkozik! Adja meg a napok számát két archíválás között!');
define('_ACA_DATE_TITLE', 'Dátum típus');
define('_ACA_DATE_TOOL', 'Adja meg, hogy a létrehozás dátuma vagy a módosítás dátuma alapján archíváljon!');

define('_ACA_MAINTENANCE_TAB', 'Karbantartási beállítások');
define('_ACA_MAINTENANCE_FREQ', 'Karbantartási gyakoriság');
define( '_ACA_MAINTENANCE_FREQ_TIPS', 'Adja meg azt a gyakoriságot, amikor a karbantartási mûvelet lefut!' );
define( '_ACA_CRON_DAYS' , 'óra' );

define( '_ACA_LIST_NOT_AVAIL', 'Jelenleg nincs elérhetõ lista.');
define( '_ACA_LIST_ADD_TAB', 'Hozzáad/szerkeszt' );

define( '_ACA_LIST_ACCESS_EDIT', 'Levelezés hozzáférés hozzáadás/szerkesztés' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', 'Adja meg azt a felhasználói csoportot, amely bõvítheti vagy szerkesztheti ehhez az listához tartozó levelezéseket!' );
define( '_ACA_MAILING_NEW_FRONT', 'Új levelezés létrehozás' );

define('_ACA_AUTO_ARCHIVE', 'Auto-Archívál');
define('_ACA_MENU_ARCHIVE', 'Auto-Archívál');

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', '[ISSUENB] = Lecserélõdik a hírlevél kiadás számára.');
define('_ACA_TAGS_DATE', '[DATE] = Lecserélõdik a küldés dátumára.');
define('_ACA_TAGS_CB', '[CBTAG:{field_name}] = Lecserélõdik a Community Builder mezõjének értékére: pl.: [CBTAG:firstname] ');
define( '_ACA_MAINTENANCE', 'Karbantartás' );

define('_ACA_THINK_PRO', 'Professzionális igényekhez professzionális komponensek!');
define('_ACA_THINK_PRO_1', 'Okos hírlevelek');
define('_ACA_THINK_PRO_2', 'Adja meg a hozzáférés szintjét a listához!');
define('_ACA_THINK_PRO_3', 'Adja meg, hogy ki szerkeszthet/adhat hozzá levelezést!');
define('_ACA_THINK_PRO_4', 'További adatok: adja hozzá saját CB mezõit!');
define('_ACA_THINK_PRO_5', 'A Joomla tartalmaz Auto-archiválást!');
define('_ACA_THINK_PRO_6', 'Adatbázis optimalizálás');

define('_ACA_LIC_NOT_YET', 'Az Ön licensze még nem érvényes. Ellenõrizze a Licensz fület a konfigurációs panelen!');
define('_ACA_PLEASE_LIC_GREEN' , 'Ügyeljen, hogy friss és valódi információkat adjon támogató csoportunknak ennek a fülnek a tetején!' );

define('_ACA_FOLLOW_LINK' , 'Licensz kérés');
define( '_ACA_FOLLOW_LINK_TWO' , 'Kérheti licenszét azonosítója és webhelyének URL-je megadásával (amelyik zöld színnel jelenik meg az oldal tetején) a Licensz ûrlapban.');
define( '_ACA_ENTER_TOKEN_TIPS2', ' Majd kattintson az Alkalmaz gombon a jobb felsõ menüben!' );
define( '_ACA_ENTER_LIC_NB', 'Írja be a licenszét!' );
define( '_ACA_UPGRADE_LICENSE', 'Licensz frissítése');
define( '_ACA_UPGRADE_LICENSE_TIPS' , 'Ha kapott azonosítót a licensz frissítéséhez, azt itt adja meg, majd kattintson az Alkalmaz gombon és folytassa a <b>2.</b> lépéssel licensz számának lekéréséhez!' );

define( '_ACA_MAIL_FORMAT', 'Kódolási formátum' );
define( '_ACA_MAIL_FORMAT_TIPS', 'Milyen kódolási formát szeretne használni levelezéseiben: csak szöveges vagy MIME' );
define( '_ACA_ACAJOOM_CRON_DESC_ALT', 'Ha nincs hozzáférése a webhelyén idõzítõ kezelõhöz, használhatja az ingyenes jCron komponenst az idõzítési feladatok megoldására!' );

//since 1.3.1
define('_ACA_SHOW_AUTHOR', 'A szerzõ nevének megjelenítése');
define('_ACA_SHOW_AUTHOR_TIPS', 'Válasszon Igen-t, ha a szerzõ nevét is el szeretné helyezni a levélbe elhelyezett cikknél!');

//since 1.3.5
define('_ACA_REGWARN_NAME','Adja meg a nevét!');
define('_ACA_REGWARN_MAIL','Érvényes email címet adjon meg!');

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
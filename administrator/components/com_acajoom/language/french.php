<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...L\'accès direct à cet emplacement n\'est pas autorisé...');

/**
 * <p>French language file.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author Acajoom Services <support@acajoom.com>
 * @author Christelle Gesset <support@acajoom.com>
 * @version $Id: french.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.joobisoft.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom est un gestionaire de listes, newsletters, bulletins, et réponses automatiques pour communiquer effectivement avec vos clients.  ' .
		'Acajoom, votre partenaire de communication');
define('_ACA_FEATURES', 'Acajoom, votre partenaire de communication!');

// Type of lists
define('_ACA_NEWSLETTER', 'Bulletin');
define('_ACA_AUTORESP', 'Reponse automatique');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Carte Postale');
define('_ACA_PERF', 'Performance');
define('_ACA_COUPON', 'Coupon');
define('_ACA_CRON', 'Tache Cron');
define('_ACA_MAILING', 'Mailing');
define('_ACA_LIST', 'Liste');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Gestion de Listes');
define('_ACA_MENU_SUBSCRIBERS', 'Abonnés');
define('_ACA_MENU_NEWSLETTERS', 'Newsletters');
define('_ACA_MENU_AUTOS', 'Réponses automatiques');
define('_ACA_MENU_COUPONS', 'Coupons');
define('_ACA_MENU_CRONS', 'Taches Cron');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Carte Postales');
define('_ACA_MENU_PERFS', 'Performances');
define('_ACA_MENU_TAB_LIST', 'Listes');
define('_ACA_MENU_MAILING_TITLE', 'Mailings');
define('_ACA_MENU_MAILING' , 'Mailings pour ');
define('_ACA_MENU_STATS', 'Statistiques');
define('_ACA_MENU_STATS_FOR', 'Statistiques pour ');
define('_ACA_MENU_CONF', 'Configuration');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'A propos');
define('_ACA_MENU_LEARN', 'Centre d\'éducation');
define('_ACA_MENU_MEDIA', 'Gestion des Medias');
define('_ACA_MENU_HELP', 'Aide');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Importer');
define('_ACA_MENU_EXPORT', 'Exporter');
define('_ACA_MENU_SUB_ALL', 'S\'abonner à tout');////
define('_ACA_MENU_UNSUB_ALL', 'Se désabonner de tout');////
define('_ACA_MENU_VIEW_ARCHIVE', 'Archive');
define('_ACA_MENU_PREVIEW', 'Aperçu');////
define('_ACA_MENU_SEND', 'Envoyer');
define('_ACA_MENU_SEND_TEST', 'Envoyer un Essai');
define('_ACA_MENU_SEND_QUEUE', 'File d\'attente de Processus');
define('_ACA_MENU_VIEW', 'Aperçu');
define('_ACA_MENU_COPY', 'Copier');
define('_ACA_MENU_VIEW_STATS' , 'Afficher statistiques');
define('_ACA_MENU_CRTL_PANEL' , 'Tableau de configuration');
define('_ACA_MENU_LIST_NEW' , 'Créer une liste');
define('_ACA_MENU_LIST_EDIT' , ' Editer une liste');
define('_ACA_MENU_BACK', 'Retour');
define('_ACA_MENU_INSTALL', 'Installation');
define('_ACA_MENU_TAB_SUM', 'Résumer');
define('_ACA_STATUS' , 'Statut');
define('_ACA_SENT_MAILING' , 'Message envoyé');

// messages
define('_ACA_ERROR' , 'Une erreur s\'est produite!');
define('_ACA_SUB_ACCESS' , 'Droits d\'utilisateur');
define('_ACA_DESC_CREDITS', 'Crédits');
define('_ACA_DESC_INFO', 'Information');
define('_ACA_DESC_HOME', 'Accueil');
define('_ACA_DESC_MAILING', 'Liste d\'envoi');
define('_ACA_DESC_SUBSCRIBERS', 'Abonnés');
define('_ACA_PUBLISHED','Publié');
define('_ACA_UNPUBLISHED','Non publié');
define('_ACA_DELETE','Effacer');
define('_ACA_FILTER','Filtrer');
define('_ACA_UPDATE','Mise à jour');
define('_ACA_SAVE','Sauvegarder');
define('_ACA_CANCEL','Annuler');
define('_ACA_NAME','Nom');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Selectionner');
define('_ACA_ALL','Tout');
define('_ACA_SEND_A', 'Envoyer un');
define('_ACA_SUCCESS_DELETED', 'Supprimé avec succès');
define('_ACA_LIST_ADDED', 'Liste créée avec succès');
define('_ACA_LIST_COPY', 'Liste copiée avec succès');
define('_ACA_LIST_UPDATED', 'Liste mise à jour avec succès.');
define('_ACA_MAILING_SAVED', 'Mailing sauvegardé avec succès.');
define('_ACA_UPDATED_SUCCESSFULLY', ' mise à jour avec succès.');


### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Informations Abonné');
define('_ACA_VERIFY_INFO', 'Veuillez verifier le lien entré, des informations manquent.');
define('_ACA_INPUT_NAME', 'Nom');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Recevoir du HTML?');
define('_ACA_TIME_ZONE', 'Fuseaux horaire');
define('_ACA_BLACK_LIST', 'Liste noire');
define('_ACA_REGISTRATION_DATE', 'Date d\'enregistrement de l\'utilisateur');
define('_ACA_USER_ID', 'Utilisateur id');
define('_ACA_DESCRIPTION', 'Description');
define('_ACA_ACCOUNT_CONFIRMED', 'Votre compte a été activé.');
define('_ACA_SUB_SUBSCRIBER', 'Abonné');
define('_ACA_SUB_PUBLISHER', 'Éditeur');
define('_ACA_SUB_ADMIN', 'Administrateur');
define('_ACA_REGISTERED', 'Enregistré');
define('_ACA_SUBSCRIPTIONS', 'Abonnements');
define('_ACA_SEND_UNSUBCRIBE', 'Abonnements');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Cliquez sur Oui pour envoyer un email de confimation de désabonnement.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Veuillez confirmer votre abonnement');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Confirmation de désabonnement');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Bonjour [NAME],<br />' .
		'Plus qu\'une étape et vous serez inscrit sur la liste. Cliquez s\'il vous plaît sur le lien suivant pour confirmer votre abonnement.' .
		'<br /><br />[CONFIRM]<br /><br />Pour toutes questions veuillez contacter le webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Ceci un email de confirmation de désabonnement à notre liste. Nous sommes désolés que vous ayez décidé de vous désabonner .Si vous décidez de vous ré-inscrire vous pouvez le faire sur notre site. Pour toutes questions veuillez contacter le webmaster.');

// Acajoom subscribers
define('_ACA_CONFIRMED', 'Confirmé');
define('_ACA_SUBSCRIB', 'Souscrire');
define('_ACA_HTML', 'HTML mailings');///
define('_ACA_RESULTS', 'Résultats');
define('_ACA_SEL_LIST', 'Selectionner une liste');
define('_ACA_SEL_LIST_TYPE', '-Selectionner un type de liste -');
define('_ACA_SUSCRIB_LIST', 'Liste de tous les abonnés');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Abonnés pour : ');
define('_ACA_NO_SUSCRIBERS', 'Aucun abonné n\'a été trouvé pour cette liste.');

define('_ACA_COMFIRM_SUBSCRIPTION', 'Un email de comfirmation vous a été envoyé. Vérifiez s\'il vous plaît votre email et cliquer sur le lien fourni.<br />' .
		'Vous devez confirmer votre email pour que votre abonnement puisse prendre effet.');
define('_ACA_SUCCESS_ADD_LIST', 'Vous avez été ajoutés avec succès à la liste.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Cliquez ici pour confirmer votre abonnement.');
define('_ACA_UNSUBSCRIBE_LINK', 'Cliquez ici pour vous désabonnez de la liste');
define('_ACA_UNSUBSCRIBE_MESS', 'Votre adresse email a été supprimée des listes');
define('_ACA_QUEUE_SENT_SUCCESS' , 'Tous les e-mails programmés ont été envoyés avec succès.');
define('_ACA_MALING_VIEW', 'Afficher tous les mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Etes-vous sûr de vouloir vous désabonner de cette liste?');
define('_ACA_MOD_SUBSCRIBE', 'S\'abonner');
define('_ACA_SUBSCRIBE', 'S\'abonner');
define('_ACA_UNSUBSCRIBE', 'Se désabonner');
define('_ACA_VIEW_ARCHIVE', 'Voir les archives');
define('_ACA_SUBSCRIPTION_OR', 'Cliquer ici pour mettre à jour vos informations');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Cette adresse mail a déjà été enregistrée.');
define('_ACA_SUBSCRIBER_DELETED', 'Abonné supprimé avec succès.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Panneau de configuration Utilisateur');
define('_UCP_USER_MENU', 'Menu Utilisateur');
define('_UCP_USER_CONTACT', 'Mes Abonnements');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Gestion des Tâches Cron');
define('_UCP_CRON_NEW_MENU', 'Nouveau Cron');
define('_UCP_CRON_LIST_MENU', 'Liste de mon Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Gestion de Coupons');
define('_UCP_COUPON_LIST_MENU', 'Liste de mes Coupons');
define('_UCP_COUPON_ADD_MENU', 'Ajouter un Coupon');


### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Description');
define('_ACA_LIST_T_LAYOUT', 'Disposition');
define('_ACA_LIST_T_SUBSCRIPTION', 'Abonnement');
define('_ACA_LIST_T_SENDER', 'Informations sur l\'expéditeur');

define('_ACA_LIST_TYPE', 'Type de liste');
define('_ACA_LIST_NAME', 'Nom de liste');
define('_ACA_LIST_ISSUE', 'Publication #');
define('_ACA_LIST_DATE', 'Date d\'envoi');
define('_ACA_LIST_SUB', 'Titre de la liste');/////
define('_ACA_HTML_CONTENT', 'Contenu HTML');/////
define('_ACA_ATTACHED_FILES', 'Piéces jointes');
define('_ACA_SELECT_LIST', 'Veuillez choisir une liste pour l\'édition!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Type de liste');
define('_ACA_AUTO_RESP_OPTION', 'Options des réponses automatiques');
define('_ACA_AUTO_RESP_FREQ', 'Les abonnés peuvent choisir la fréquence');
define('_ACA_AUTO_DELAY', 'Delai (en jours)');
define('_ACA_AUTO_DAY_MIN', 'Frequence minimum');
define('_ACA_AUTO_DAY_MAX', 'Frequence maximum');
define('_ACA_FOLLOW_UP', 'Spécifiez la réponse automatique suivant');
define('_ACA_AUTO_RESP_TIME', 'Les abonnés peuvent choisir le temps');
define('_ACA_LIST_SENDER', 'Liste des expéditeurs');

define('_ACA_LIST_DESC', 'Description de liste');
define('_ACA_LAYOUT', 'Disposition');
define('_ACA_SENDER_NAME', 'Nom de l\'expéditeur');
define('_ACA_SENDER_EMAIL', 'Email de l\'expéditeur');
define('_ACA_SENDER_BOUNCE', 'Adresse de retour de l\'expéditeur');/////
define('_ACA_LIST_DELAY', 'Delai');
define('_ACA_HTML_MAILING', 'Liste d\'envois HTML?');
define('_ACA_HTML_MAILING_DESC', '(Si vous changez ceci, vous devrez sauvegarder et retourner à cet écran pour voir les changements.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Visible du frontend?');
define('_ACA_SELECT_IMPORT_FILE', 'Choisissez un fichier à importer');
define('_ACA_IMPORT_FINISHED', 'Importation terminée');
define('_ACA_DELETION_OFFILE', 'Suppression du fichier');
define('_ACA_MANUALLY_DELETE', 'Échoué, vous devriez supprimer manuellement le fichier');
define('_ACA_CANNOT_WRITE_DIR', 'Ecriture impossible dans le répertoire');
define('_ACA_NOT_PUBLISHED', 'Les e-mails ne pourront pas être envoyés, la liste n\'est pas publiée.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'cliquez Oui pour publier la liste');
define('_ACA_INFO_LIST_NAME', 'Entrez le nom de votre liste ici. Vous pourrez ainsi l\'identifier.');
define('_ACA_INFO_LIST_DESC', 'Entrez à une brève description de votre liste ici.Cette description sera visible par les visiteurs de votre site.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Entrez le nom de l\'expéditeur du mailing. Ce nom sera visible quand les abonnés reçoiveront des messages de cette liste.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Entrez l\'adresse email d\'où les messages seront envoyés.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Entrez l\'adresse email où les utilisateurs peuvent répondre. Il est fortement recommandé d\'avoir le même email que celui de l\'expéditeur...........');///manque la fin
define('_ACA_INFO_LIST_AUTORESP', 'Choisir un type de mailing liste. <br />' .
		'Newsletter:  newsletter normale<br />' .
		'Réponse automatique: Une réponse automatique est une liste qui est envoyée automatiquement par le site Web à intervalles réguliers.');
define('_ACA_INFO_LIST_FREQUENCY', 'Permettez aux utilisateurs de choisir combien de fois ils reçoivent la liste. Cela donne plus de flexibilité à l\'utilisateur.');
define('_ACA_INFO_LIST_TIME', 'Laissez l\'utilisateur choisir leur horaire préféré pour recevoir la liste.');
define('_ACA_INFO_LIST_MIN_DAY', 'Définissez la fréquence minimale que peut choisir un utilisateur pour recevoir la liste');
define('_ACA_INFO_LIST_DELAY', 'Spécifiez le delai entre cette réponse automatique et le précédent.');
define('_ACA_INFO_LIST_DATE', 'Spécifiez la date de publication de la liste de nouvelles si vous voulez retarder la publication. <br /> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Définissez la fréquence maximale que peut choisir un utilisateur pour recevoir la liste');
define('_ACA_INFO_LIST_LAYOUT', 'Entrez la disposition de votre liste d\'adresses ici. Vous pouvez entrer n\'importe quelle disposition pour votre mailing ici.');
define('_ACA_INFO_LIST_SUB_MESS', 'Ce message sera envoyé à l\'abonné quand lui ou elle se seront d\'abord inscrit. Vous pouvez définir n\'importe quel texte que vous aimez ici.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Ce message sera envoyé à l\'abonné quand lui ou elle se désabonnera. N\'importe quel message peut être entré ici.');
define('_ACA_INFO_LIST_HTML', 'Cocher la case si vous voulez envoyer un mailing HTML. Les abonnés seront capables de spécifier s\'ils veulent recevoir les messages  HTML ou les Textes seulement lorsqu\'ils souscrivent à une liste HTML.');
define('_ACA_INFO_LIST_HIDDEN', 'Cliquez sur Oui pour cacher la liste du fontend, les utilisateurs ne pourront plus s\'abonner mais vous pourrez toujours envoyer des mailings.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Voulez-vous assigner automatiquement des utilisateurs à cette liste ? < Br / > <B> Nouveaux Utilisateurs : </B > seront registerés tous les nouveaux utilisateurs qui s\'inscrivent sur le site Web. < Br / > < B> Tous les Utilisateurs : </B > enregistrera tous les utilisateurs enregistrés dans la base de données. < Br / > (toute cette option support the Community Builder))');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Choisissez le niveau d\'accès de frontend. Cela montrera ou cachera le mailing au groupe utilisateurs qui n\'y a pas d\'accès, donc ils ne seront pas capables d\'y souscrire.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Choisissez le niveau d\'accès du groupe utilisateurs que vous voulez permettre d\'éditer. Ce usergroup et celui de dessus sera capable d\'éditer le mailing et le fera envoyer depuis le frontend ou backend.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Si vous voulez utiliser un autre auto-répondeur une fois le dernier message atteint  vous pouvez spécifier ici  l\'auto-répondeur suivant.');
define('_ACA_INFO_LIST_ACA_OWNER', 'C\'est l\'ID de la personne qui a créé la liste.');
define('_ACA_INFO_LIST_WARNING', 'Cette dernière option est disponible seulement une fois la liste créée.');
define('_ACA_INFO_LIST_SUBJET', ' Sujet du mailing C\'est le sujet de l\'email que l\'abonné reçevera.');
define('_ACA_INFO_MAILING_CONTENT', 'C\'est le corps d\'email que vous voulez envoyer.');
define('_ACA_INFO_MAILING_NOHTML', 'Enter here the body of the email you want to send to subscribers who choose to receive only none HTML mailings. <BR/> NOTE: if you leave it blank Acajoom will automatically convert the HTML text into text only.');/////
define('_ACA_INFO_MAILING_VISIBLE', 'Cliquez sur Oui pour que le mailing soit visible du frontend.');
define('_ACA_INSERT_CONTENT', 'Insérez le contenu existant');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Coupon envoyé avec succès!');
define('_ACA_CHOOSE_COUPON', 'Choisissez un coupon');
define('_ACA_TO_USER', ' À cet utilisateur');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Toutes les heures');
define('_ACA_FREQ_CH2', 'Toutes les 6 heures');
define('_ACA_FREQ_CH3', 'Toutes les 12 heures');
define('_ACA_FREQ_CH4', 'Quotidiennement');
define('_ACA_FREQ_CH5', 'Toutes les semaines');
define('_ACA_FREQ_CH6', 'Toutes les mois');
define('_ACA_FREQ_NONE', 'Non');
define('_ACA_FREQ_NEW', 'Nouveaux Utilisateurs');
define('_ACA_FREQ_ALL', 'Tous les Utilisateurs');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom Cron?');
define('_ACA_LABEL_FREQ_TIPS', 'Cliquez sur Oui si vous voulez l\'utiliser pour un Acajoom Cron, Non pour une autre tâche cron.<br />' .
		'Si vous cliquez sur Oui vous ne devez pas spécifier l\'Adresse de Cron, il sera automatiquement ajouté.');
define('_ACA_SITE_URL' , 'L\'URL de votre site');
define('_ACA_CRON_FREQUENCY' , 'Frequence Cron');
define('_ACA_STARTDATE_FREQ' , 'Date de Début');
define('_ACA_LABELDATE_FREQ' , 'Date Spécifique');
define('_ACA_LABELTIME_FREQ' , 'Horaire Spécifique');
define('_ACA_CRON_URL', 'Cron URL');
define('_ACA_CRON_FREQ', 'Frequence');
define('_ACA_TITLE_CRONLIST', ' Liste Cron');
define('_NEW_LIST', 'Créez une nouvelle liste');

//title CRON form
define('_ACA_TITLE_FREQ', 'Edition de vos taches Cron');
define('_ACA_CRON_SITE_URL', 'Veuillez entrez une URL de site valable, commençant avec http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Tous les  mailings');
define('_ACA_EDIT_A', 'Editer un ');
define('_ACA_SELCT_MAILING', 'Vous devez choisir une liste dans la liste déroulante pour ajouter un nouveau mailing.');
define('_ACA_VISIBLE_FRONT', 'Visible du frontend');

// mailer
define('_ACA_SUBJECT', 'Sujet');
define('_ACA_CONTENT', 'Contenu');
define('_ACA_NAMEREP', '[NAME] = Cela sera remplacé par le nom de l\'abonné entré, vous enverrez un email personnalisé en l\'utilisant.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Cela sera remplacé par le PRÉNOM de l\'abonné entré.<br />');
define('_ACA_NONHTML', 'Non-html version');
define('_ACA_ATTACHMENTS', 'Attachements');
define('_ACA_SELECT_MULTIPLE', 'Tenez le contrôle (ou la commande) pour choisir des attachements multiples.<br />' .
		'Les fichiers montrés dans cette liste d\'attachement sont placés dans le dossier attachement, vous pouvez changer cet emplacement dans le panneau de configuration.');
define('_ACA_CONTENT_ITEM', 'Content item');//
define('_ACA_SENDING_EMAIL', 'Envoi d\'email');
define('_ACA_MESSAGE_NOT', 'Le message n\' pas pu être envoyé');
define('_ACA_MAILER_ERROR', 'Erreur d\'envoi');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Message envoyé  avec succès');
define('_ACA_SENDING_TOOK', 'Envoyer ce mailing ');////took
define('_ACA_SECONDS', 'secondes');
define('_ACA_NO_ADDRESS_ENTERED', 'Aucune adresse email ou abonné n\'a été fourni');
define('_ACA_NO_MAILING_ENTERED', 'Aucune mailing n\'a été fourni');
define('_ACA_NO_LIST_ENTERED', 'Aucune list n\'a été fourni');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Changement');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Changez votre abonnement');
define('_ACA_WHICH_EMAIL_TEST', 'Indiquez l\'adresse électronique à laquelle vous voulez envoyer cet essai ou selectionnez aperçu');
define('_ACA_SEND_IN_HTML', 'Envoyer en HTML (pour les listes d\'envois html)?');
define('_ACA_VISIBLE', 'Visible');
define('_ACA_INTRO_ONLY', 'Intro seulement');

// stats
define('_ACA_GLOBALSTATS', 'Statistiques globales');
define('_ACA_DETAILED_STATS', 'Statistiques détaillées ');
define('_ACA_MAILING_LIST_DETAILS', 'Listes détaillées');
define('_ACA_SEND_IN_HTML_FORMAT', 'Envoyez au  format HTML');
define('_ACA_VIEWS_FROM_HTML', 'Vues (de courrier en HTML)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Envoyez au format texte');
define('_ACA_HTML_READ', 'lire HTML ');
define('_ACA_HTML_UNREAD', 'Ne pas lire en HTML ');
define('_ACA_TEXT_ONLY_SENT', 'Texte uniquement');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Logs & Stats');
define('_ACA_SUBSCRIBER_CONFIG', 'Abonnés');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Divers');
define('_ACA_MAIL_SETTINGS', 'Parametres de mail');/////
define('_ACA_MAILINGS_SETTINGS', 'Parametres des Mailings');
define('_ACA_SUBCRIBERS_SETTINGS', 'Parametres des Abonnés');
define('_ACA_CRON_SETTINGS', 'Parametres du Cron');
define('_ACA_SENDING_SETTINGS', 'Parametres de l\'envoi');
define('_ACA_STATS_SETTINGS', ' Envoi des Statistiques');
define('_ACA_LOGS_SETTINGS', 'Parametres de login');
define('_ACA_MISC_SETTINGS', 'Parametres Divers');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Message de ');
define('_ACA_SEND_MAIL_NAME', 'De nom');
define('_ACA_MAILSENDMETHOD', 'Methodes d\'envoi');//Mailer method
define('_ACA_SENDMAILPATH', 'chemin d\'envoi des mails');///
define('_ACA_SMTPHOST', 'Hôte SMTP');
define('_ACA_SMTPAUTHREQUIRED', 'Authentification SMTP exigée');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Choisissez oui si votre serveur de SMTP exige l\'authentification');
define('_ACA_SMTPUSERNAME', 'nom d\'utilisateur SMTP');
define('_ACA_SMTPUSERNAME_TIPS', 'Entrez votre SMTP username quand votre serveur SMTP exige l\'authentification');
define('_ACA_SMTPPASSWORD', 'mot de passe SMTP');
define('_ACA_SMTPPASSWORD_TIPS', 'Entrez votre SMTP password quand votre serveur SMTP exige l\'authentification');
define('_ACA_USE_EMBEDDED', 'Utilisez des images incorporées');
define('_ACA_USE_EMBEDDED_TIPS', 'Sélectionnez Oui si les images en pièces jointes contiennent des items qui doivent être inclus dans les envois de messages en HTML, ou ne pas utiliser par défaut les tags images qui relient aux images du site.');
define('_ACA_UPLOAD_PATH', 'Importer/chemin des pièces jointes');
define('_ACA_UPLOAD_PATH_TIPS', 'Vous pouvez spécifier un répertoire d\'importation.<br />' .
		'Vérifiez que le répertoire spécifié exist, sinon créez-le.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Non enregistrés autorisés');
define('_ACA_ALLOW_UNREG_TIPS', 'Sélectionner Oui si vous voulez permettre aux utilisateurs de s\'inscrire à une liste sans être enregistrés sur le site.');
define('_ACA_REQ_CONFIRM', 'Confirmation requise');
define('_ACA_REQ_CONFIRM_TIPS', 'Sélectionner Oui si vous demandez aux utilisateurs non enregistrés de confirmer leur adresse e-mail.');
define('_ACA_SUB_SETTINGS', 'Paramètres d\'inscription');
define('_ACA_SUBMESSAGE', 'E-mail d\'inscription');
define('_ACA_SUBSCRIBE_LIST', 'S\'incrire à une liste');

define('_ACA_USABLE_TAGS', 'Tags utilisables');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Ceci crée un lien hypertexte ou les utilisateurs peuvent confirmé leur inscription. Ceci est <strong>requis</strong> pour le bon fonctionnement d\'Acajoom.<br />'
.'<br />[NAME] = Ceci sera remplacé par le nom entré par l\'inscrit, vous enverrez des e-mails personnalisés en utilisant ceci.<br />'
.'<br />[FIRSTNAME] = Ceci sera remplacé par le nom de l\'inscrit, le nom est défini comme le premier nom entré par l\'inscrit.<br />');
define('_ACA_CONFIRMFROMNAME', 'Confirmation du nom');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Entrer le nom qui apparaitra sur la liste des confirmés.');
define('_ACA_CONFIRMFROMEMAIL', 'Confirmation de l\'e-mail');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Entrer l\'adress e-mail qui apparaitra sur la liste des confirmés.');
define('_ACA_CONFIRMBOUNCE', 'Confirmer l\'adresse de rebond');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Entrer l\'adresse de rebond à afficher dans les listes de confirmation.');
define('_ACA_HTML_CONFIRM', 'Confirmation HTML');
define('_ACA_HTML_CONFIRM_TIPS', 'Sélectionner oui si la liste de confirmation doit être en HTML si les utilisateurs autorise le HTML.');
if(!defined('_ACA_TIME_ZONE')) define('_ACA_TIME_ZONE', 'Demander le fuseau horaire');
define('_ACA_TIME_ZONE_TIPS', 'Sélectionner oui si vous voulez demander le fuseau horaire de l\'utilisateur.  La file d\'attente des e-mails sera envoyée en tenant compte du fuseau horaire de l\'utilisateur lorsque cela est applicable');

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', 'Cliquer ici pour paramètrer le décalage dans le panneau de configuration globale -> onglet Local');
define('_ACA_TIME_OFFSET_TIPS', 'Paramètrer le décalage temporel de votre serveur de sorte que la date et l\'heure enregistrées soient exactes ');
define('_ACA_TIME_OFFSET', 'Décalage temporel');
define('_ACA_CRON_TITLE', 'Installation de la fonction cron');
define('_ACA_CRON_DESC','<br />En utilisant la fonction CRON vous pouvez paramètrer des taches planifiées pour votre site web Joomla !<br />' .
		'Pour l\'installer, vous devez ajouter dans le panneau de configuration crontab la commande suivante :<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Si vous avez besoin d\'aide pour l\'installation ou que vous avez des difficultés, n\hésitez pas à consulter notre forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pause de x secondes à chaque quantité configurée d\'e-mails');
define('_ACA_PAUSEX_TIPS', 'Entrer un nombre en seconde Acajoom donnera au serveur SMTP le temps d\'envoyer les messages avant de procéder à la prochaine quantité de messages configurée.');
define('_ACA_EMAIL_BET_PAUSE', 'E-mails entre les pauses');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Le nombre d\'e-mails à envoyer avant de faire une pause.');
define('_ACA_WAIT_USER_PAUSE', 'Attente de l\'entrée utilisateur à la pause');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Si le script doit attendre une entrée utilisateur lors des pauses entre les lots d\'e-mails.');
define('_ACA_SCRIPT_TIMEOUT', 'Arrêt du Script');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Le nombre de minutes où le script doit être capable de tourner.');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Permettre la lecture des statistiques');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Sélectionner Oui si vous vouler noter le nombre de vus. Cette technique peut seulement être utilisée avec les e-mails html');
define('_ACA_LOG_VIEWSPERSUB', 'Noter le nombre de vus par abonné');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Sélectionner Oui si vous vouler noter le nombre de vus par abonné. Cette technique peut seulement être utilisée avec les e-mails html');
// Logs settings
define('_ACA_DETAILED', 'Logs détaillés');
define('_ACA_SIMPLE', 'Logs simplifiés');
define('_ACA_DIAPLAY_LOG', 'Afficher les logs');
define('_ACA_DISPLAY_LOG_TIPS', 'Sélectionner Oui si vous voulez affichez les logs lors de l\'envoi des e-mails.');
define('_ACA_SEND_PERF_DATA', 'Envoyer les données d\'éxécution');
define('_ACA_SEND_PERF_DATA_TIPS', 'Sélectionner oui si vous voulez permettre à Acajoom d\'envoyer des rapports anonymes sur votre configuration, le nombre d\'abonnés à une liste et le temps mis pour envoyer les e-mails. Ceci nous donnera une idée sur les performances d\'Acajoom et nous AIDERA à améliorer Acajoom dans les developeements futurs.');
define('_ACA_SEND_AUTO_LOG', 'Envoyer les logs pour les réponses automatiques');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Sélectionnez oui si vous voulez envoyer an e-mail de log à chaque traitement de la liste d\'envois.  AVERTISSEMENT : Cela peut aboutir à un très grand nombre d\'e-mails.');
define('_ACA_SEND_LOG', 'Envoyer les logs');
define('_ACA_SEND_LOG_TIPS', 'Si une notification de l\'e-mail doit être envoyée à l\'adresse e-mail de l\'utilisateur qui a envoyé les e-mails.');
define('_ACA_SEND_LOGDETAIL', 'Envoyer les logs détaillés');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Détails inclus l\'information sur le succès ou l\'échec pour chaque abonné et un aperçu de l\'information. Simple envoie seulement l\'aperçu.');
define('_ACA_SEND_LOGCLOSED', 'Envoyer une notification si la connexion est interrompue');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Avec cette option sur on, l\'utilisateur qui envoie le mailling recevera encore un rapport par e-mail.');
define('_ACA_SAVE_LOG', 'Sauvegarder les logs');
define('_ACA_SAVE_LOG_TIPS', 'Si un log concernant l\'envoi doit être ajouté au fichier de log.');
define('_ACA_SAVE_LOGDETAIL', 'Sauvegarder les logs détaillés');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Détails inclus l\'information sur le succès ou l\'échec pour chaque abonné et un aperçu de l\'information. Simple envoie seulement l\'aperçu.');
define('_ACA_SAVE_LOGFILE', 'Sauvegarder les fichiers de logs');
define('_ACA_SAVE_LOGFILE_TIPS', 'Fichier auquel les informations sur les logs doivent être ajoutés. Ce fichier peut devenir assez volumineux.');
define('_ACA_CLEAR_LOG', 'Clear log');
define('_ACA_CLEAR_LOG_TIPS', 'Effacer les fichiers de logs.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Dernière file d\'attente exécutée');
define('_ACA_CP_TOTAL', 'Total');
define('_ACA_MAILING_COPY', 'Copie réussie des Mailing !');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Afficher le guide');
define('_ACA_SHOW_GUIDE_TIPS', 'Afficher le guide pour aider les nouveaux utilisateurs à créer une newsletter, une réponse automatique et installer Acajoom proprement.');
define('_ACA_AUTOS_ON', 'Utiliser les réponses automatiques');
define('_ACA_AUTOS_ON_TIPS', 'Sélectionner Non si vous ne voulez pas utiliser les réponses automatiques, toutes les options des réponses automatiques seront désactivées.');
define('_ACA_NEWS_ON', 'Utiliser les Newsletters');
define('_ACA_NEWS_ON_TIPS', 'Sélectionner Non si vous ne voulez pas utiliser les Newsletters, toutes les options des newsletters seront déseactivées.');
define('_ACA_SHOW_TIPS', 'Montrer les astuces');
define('_ACA_SHOW_TIPS_TIPS', 'Montrer les astuces, pour aider les utilisateurs à se servir de Acajoom plus efficacement.');
define('_ACA_SHOW_FOOTER', 'Montrer le titre de bas de pages');
define('_ACA_SHOW_FOOTER_TIPS', 'Si oui ou non le copyright de bas de pages doit être affiché.');
define('_ACA_SHOW_LISTS', 'Montrer les listes sur le fontend');
define('_ACA_SHOW_LISTS_TIPS', 'Quand les utilisateurs ne sont pas enregistrés,montrer la liste des listes auquelles ils peuvent s\'abonner avec le bouton d\'archive pour les newsletters ou simplement une formulaire de login pour qu\'ils puissent s\'enregistrer.');
define('_ACA_CONFIG_UPDATED', 'Les détails de configuration ont été mis à jour !');
define('_ACA_UPDATE_URL', 'Mettre à jour l\'URL');
define('_ACA_UPDATE_URL_WARNING', ' AVERTISSEMENT ! Ne changer pas cet URL à moins que vous ayez été invités à le faire par l\'équipe technique d\'Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Par exemple: http://www.acajoom.com/update/ (inclus le slash fermant)');

// module
define('_ACA_EMAIL_INVALID', 'L\'e-mail entré est invalide.');
define('_ACA_REGISTER_REQUIRED', 'Merci de vous enregistrer sur le site avant de pouvoir vous abonner à une liste.');
define('_ACA_SIGNUP_DATE', 'Date d\'inscription');

// Access level box
define('_ACA_OWNER', 'Créateur de la liste :');
define('_ACA_ACCESS_LEVEL', 'Mettez un niveau d\'accès pour la liste ');
define('_ACA_ACCESS_LEVEL_OPTION', 'Options du niveau d\'accès');
define('_ACA_USER_LEVEL_EDIT', 'Sélectionner quel niveau utilisateur est autorisé à éditer un envoi	(soit frontend soit backend) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Journalier');
define('_ACA_AUTO_DAY_CH2', 'Journalier  pas le weekend');
define('_ACA_AUTO_DAY_CH3', 'Tous les autres jours');
define('_ACA_AUTO_DAY_CH4', 'Tous les autres jours pas le weekend');
define('_ACA_AUTO_DAY_CH5', 'Hebdomadaire');
define('_ACA_AUTO_DAY_CH6', 'Bi-hebdomadaire');
define('_ACA_AUTO_DAY_CH7', 'Mensuel');
define('_ACA_AUTO_DAY_CH9', 'Annuel');
define('_ACA_AUTO_OPTION_NONE', 'Non');
define('_ACA_AUTO_OPTION_NEW', 'Nouvel Utilisateurs');
define('_ACA_AUTO_OPTION_ALL', 'Tous les utilisations');

//
define('_ACA_UNSUB_MESSAGE', 'Se désincrire des e_mails');
define('_ACA_UNSUB_SETTINGS', 'Paramètres de désincription');
define('_ACA_AUTO_ADD_NEW_USERS', 'Inscription automatique des utilisateurs?');

// Update and upgrade messages
define('_ACA_VERSION', 'Version d\'Acajoom');
define('_ACA_NO_UPDATES', 'Il n\'y a pas actuellement de mises à jours disponibles.');
define('_ACA_NEED_UPDATED', 'Fichiers qui ont besoin d\'être mis à jour :');
define('_ACA_NEED_ADDED', 'Fichiers qui ont besoin d\'être ajoutés :');
define('_ACA_NEED_REMOVED', 'Fichiers qui ont besoin d\'être supprimés :');
define('_ACA_FILENAME', 'Nom di fichier :');
define('_ACA_CURRENT_VERSION', 'Version actuelle :');
define('_ACA_NEWEST_VERSION', 'Version la plus récente :');
define('_ACA_UPDATING', 'Mettre à jour');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Les fichiers ont été mis à jour avec succès.');
define('_ACA_UPDATE_FAILED', 'La mise à jour à échoué !');
define('_ACA_ADDING', 'Ajouter');
define('_ACA_ADDED_SUCCESSFULLY', 'Ajouter avec succès.');
define('_ACA_ADDING_FAILED', 'L\'ajout a échoué !');
define('_ACA_REMOVING', 'Supprimer');
define('_ACA_REMOVED_SUCCESSFULLY', 'Supprimer avec succès.');
define('_ACA_REMOVING_FAILED', 'La suppression a échoué!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Installer une version différente');
define('_ACA_CONTENT_ADD', 'Ajouter un contenu');
define('_ACA_UPGRADE_FROM', 'Importer des données (informations sur les newsletters and les abonnés) de ');
define('_ACA_UPGRADE_MESS', 'Il n\'y a aucun risque pour vos données existantes. <br /> Le processus va simplement importer les données dans la base de données de Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Continuer l\'envoi');

// Acajoom message
define('_ACA_UPGRADE1', 'Vous pouvez facilement importer vos utilisateurs et vos newsletters de ');
define('_ACA_UPGRADE2', ' vers Acajoom dans le panneau de mise à jour.');
define('_ACA_UPDATE_MESSAGE', 'Une nouvelle version de Acajoom est disponible. ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Une nouvelle version de Acajoom est disponible. Cliquer ici pour mettre à jour !');
define('_ACA_CRON_SETUP', 'Pour utiliser les réponses automatiques, vous avec besoin d\'installer une tâche cron.');
define('_ACA_THANKYOU', 'Merci d\'avoir choisi Acajoom, Votre partenaire de communication !');
define('_ACA_NO_SERVER', 'Le serveur de mise à jour n\'est pas disponible, merci de revenir un peu plus tard.');
define('_ACA_MOD_PUB', 'Le module Acajoom n\'est pas publié.');
define('_ACA_MOD_PUB_LINK', 'Cliquez ici pour le publier!');
define('_ACA_IMPORT_SUCCESS', 'Importer avec succès');
define('_ACA_IMPORT_EXIST', 'Utilisateur déjà présent dans la base de données');


// Acajoom's Guide
define('_ACA_GUIDE', '\'s User Guide');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom a plein de caractéristiques et ce tutotrial vous guidera au travers d\'un processus en quatre étapes pour vous permettre d\'envoyer des newsletters et des réponses automatiques!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Premièrement, vous avez besoin d\'ajouter une liste. Une liste peut être de deux types, soit une newsletter soit une réponse automatique.' .
		'  Dans une liste, you définissez tous les différents paramètres permettant l\'envoi de vos newsletters ou de vos réponses automatiques : nom de l\'expéditeur, la disposition, les abonnés\' le message de bienvenue, etc...
<br /><br />Vous pouvez créer votre première liste ici : <a href="index2.php?option=com_acajoom&act=list" >Créer une liste</a> et cliquer sur le Nouveau bouton.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom vous fournit un moyen facile d\'importer toutes vos données d\'une version antérieure de système de newsletters.<br />' .
		' Allez dans le panneau d\'importation et choisissez votre ancien système des newsletters pour importer toutes vos newsletters et tous vos abonnés.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANT: L\'import ne présente AUCUN risque et n\'affectera d\'aucune manière les données de votre ancien système de newsletters</span><br />' .
		'Après l\'import, vous pourrez gérer vos abonnés et l\'envoi des e-mails directement à partir de Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Super votre première liste est créée !  Vous pouvez maintenant écrire votre première %s.  Pour la créer, aller dans : ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Gestion des réponses automatiques');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Gestion des newsletters');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' et sélectionner votre %s. <br /> Ensuite choisissez %s dans le menu déroulant.  Créer votre premier mailing en cliquant sur Nouveau ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Avant d\envoyer votre première newsletter vous voudrez peut-être vérifier la configuration des e-mails.  ' .
		'Allez à la <a href="index2.php?option=com_acajoom&act=configuration" >page de configuration</a> pourvérifier les paramètres des e-mails. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Quand vous êtes prêt retourner au menu Newsletters, sélectionner votre e-mails et cliquez sur Envoyer');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Pour l\'envoi des réponses automatiques vous avez besoin premièrement d\'installer une tâche cron sur votre serveur. ' .
		' Merci de vous référer au Cron tab dans le panneau de configuration.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >Cliquez ici</a> pour apprendre comment installer une tâche cron. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Assurer vous également d\'avoir publié le module Acajoom pour que les utilisateurs puissent s\'inscrire sur les listes.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Vous pouvez maintemant également créer une réponse automatique.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Vous pouvez maintemant également créer une newsletter.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Voila! Vous êtes prêt à communiquer efficacement avec vos visiteurs et vos utilisateurs. Ce tutorial se terminera dès que vous aurez entré un second e-mail ou vous pouvez or you can l\arrêter dans le panneau de configuration.' .
		'<br /><br />  Si vous avez des questions sur l\'utilisation de Acajoom, merci de vous référer au ' .
		'<a target="_blank"  href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Vous pouvez aussi trouver de nombreuses informations sur comment communiquer efficacement avec vos abonnés sur <a href="http://www.acajoom.com/" target="_blank"">www.Acajoom.com</a>.' .
		'<p /><br /><b>Merci d\'utiliser Acajoom. Votre Partenaire de Communication !</b> ');
define('_ACA_GUIDE_TURNOFF', 'Le guide est maintenant arrêté !');
define('_ACA_STEP', 'STEP ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Configuration Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Installation réussie');
define('_ACA_INSTALL_ERROR', 'Erreur d installation');
define('_ACA_INSTALL_BOT', 'Plugin Acajoom (Bot)');
define('_ACA_INSTALL_MODULE', 'Module Acajoom Module');
//Others
define('_ACA_JAVASCRIPT','! Attention ! Javascript doit être activé pour une bonne opération.');
define('_ACA_EXPORT_TEXT','L\'export des abonnés est basé sur la liste que vous avez choisie. <br />Exporter les abonnés de la liste');
define('_ACA_IMPORT_TIPS','Import des abonnés. Les informations dans le fichier nécessitent d\'être au format suivant : <br />' .
		'Name,email,receiveHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmed(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'est déjà un abonné');
define('_ACA_GET_STARTED', 'Cliquez ici pour commencer !');

//News since 1.0.1
define('_ACA_WARNING_1011','Avertissement: 1011: La mise à jour ne fonctionnera pas à cause des restrictions sur votre serveur.');
define('_ACA_SEND_MAIL_FROM_TIPS', ' Choisissez l\'adresse e-mail qui apparaîtra pour l\'expéditeur. ');
define('_ACA_SEND_MAIL_NAME_TIPS', ' Choisissez le nom qui apparaitra pour l\'expéditeur.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Choisissez quel type de serveur vous désirez utiliser : Fonction PHP mail, <span>Sendmail</span> or Serveur SMTP.');
define('_ACA_SENDMAILPATH_TIPS', 'Ceci est le répertoire du serveur Mail');
define('_ACA_LIST_T_TEMPLATE', 'Template');
if(!defined('_ACA_NO_MAILING_ENTERED')) define('_ACA_NO_MAILING_ENTERED', 'Pas d\'e-mail fourni');
if(!defined('_ACA_NO_LIST_ENTERED')) define('_ACA_NO_LIST_ENTERED', 'Pas de liste fournie');
if(!defined('_ACA_SENT_MAILING')) define('_ACA_SENT_MAILING' , 'E-mails envoyés');
define('_ACA_SELECT_FILE', 'Merci de sélectionner un fichier ');
define('_ACA_LIST_IMPORT', ' Vérifier les listes auxquelles vous voulez que les abonnés soient associés.');
define('_ACA_PB_QUEUE', ' Abonné inséré mais un problème est survenu pour le/la relier aux listes. Merci de vérifier manuellement.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Mise à jour hautement recommandée!');
define('_ACA_UPDATE_MESS2' , 'Patch et petites corrections.');
define('_ACA_UPDATE_MESS3' , 'Nouvelle version.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 est requis pour mettre à jour.');
define('_ACA_UPDATE_IS_AVAIL' , ' est disponible ! ');
define('_ACA_NO_MAILING_SENT', 'Aucun e-mail envoyé ! ');
define('_ACA_SHOW_LOGIN', 'Afficher le formulaire d\'enregistrement');
define('_ACA_SHOW_LOGIN_TIPS', 'Sélectionner Oui pour montrer le formulaire d\'enregistrement depuis le front-end du panneau de configuration dÕAcajoom pour permettre aux utilisateurs de sÕenregistrer sur le site web.');
define('_ACA_LISTS_EDITOR', 'Editeur de description des listes');
define('_ACA_LISTS_EDITOR_TIPS', 'Sélectionner Oui pour utiliser un éditeur HTML pour éditer le champ description des listes.');
define('_ACA_SUBCRIBERS_VIEW', 'Voir les abonnés');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Paramètres du front-end' );
define('_ACA_SHOW_LOGOUT', 'Montrer le bouton de déconnexion');
define('_ACA_SHOW_LOGOUT_TIPS', 'Sélectionner Oui pour afficher un bouton de déconnexion dans le panneau de configuration du Front End d\'Acajoom.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Intégration');
define('_ACA_CB_INTEGRATION', 'Intégration de Community Builder');
define('_ACA_INSTALL_PLUGIN', 'Plugin de Community Builder (Intégration d\'Acajoom) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Le plugin pour Community Builder d\'Acajoom n\'est pas encore installé !');
define('_ACA_CB_PLUGIN', 'Listes à l\'enregistrement');
define('_ACA_CB_PLUGIN_TIPS', 'Sélectionner Oui pour afficher les listes d\'envoi dans le formulaire d\'enregistrement de Community builder');
define('_ACA_CB_LISTS', 'Listes des identifiants');
define('_ACA_CB_LISTS_TIPS', 'Ceci est un champ obligatoire. Entrez l\'identifiant numérique des listes auxquelles vous souhaitez permettre aux utilisateurs de s\'abonner, separés par une virgule ,  (0 montrer toutes les listes)');
define('_ACA_CB_INTRO', 'Texte d\'introduction');
define('_ACA_CB_INTRO_TIPS', 'Le texte qui apparaitra avant les listes. Laisser vide pour ne rien n\'afficher. Utiliser cb_pretext pour la disposition CSS.');
define('_ACA_CB_SHOW_NAME', 'Afficher le nom des listes');
define('_ACA_CB_SHOW_NAME_TIPS', 'Sélectionner si afficher ou non le nom des listes après l\'introduction.');
define('_ACA_CB_LIST_DEFAULT', 'Vérifier les listes par défaut');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Selectionner si oui ou non vous voulez les checkbox pour chaque liste choisie par défaut.');
define('_ACA_CB_HTML_SHOW', 'Montrer recevoir en HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Mettez Oui si vous autoriser les utilisateurs à choisir si ils veulent ou non recevoir les e-mails en HTML. Mettre Non pour utiliser par default recevoir les e-mails en html.');
define('_ACA_CB_HTML_DEFAULT', 'Recevoir en HTML par défaut');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Renseignez cette option pour afficher la configuration des envois en HTML par défaut. Si Recevoir en HTML par défaut est positionné sur Non alors cette option sera par défaut.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Les fichiers n\'ont pas pu être sauvegardés ! Fichiers non remplacés.');
define('_ACA_BACKUP_YOUR_FILES', 'L\'ancienne version des fichiers a été sauvegardée dans le répertoire suivant :');
define('_ACA_SERVER_LOCAL_TIME', 'Serveur local de temps');
define('_ACA_SHOW_ARCHIVE', 'Montrer le bouton Archive');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Sélectionnez Oui pour montrer le bouton Archive dans le listing des Newsletters du front end');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Images');
define('_ACA_LIST_OPT_CTT', 'Contenu');
define('_ACA_INPUT_NAME_TIPS', 'Entrez votre nom complet (Prénom en premier)');
define('_ACA_INPUT_EMAIL_TIPS', 'Entrez votre addresse e-mail (Vérifiez que l\'adresse e-mail est valide si vous voulez recevoir nos e-mails.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Choisissez Oui si vous voulez recevoir les e-mails au format HTML - Non pour recevoir seulement les e-mails au format texte');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Spécifiez votre fuseau horaire.');

// Since 1.0.5
define('_ACA_FILES' , 'Fichiers');
define('_ACA_FILES_UPLOAD' , 'Importer');
define('_ACA_MENU_UPLOAD_IMG' , 'Importer Images');
define('_ACA_TOO_LARGE' , 'La taille du fichier est trop importante. Le maximum autorisé est ');
define('_ACA_MISSING_DIR' , 'Le répertoire de destination n\'existe pas');
define('_ACA_IS_NOT_DIR' , 'Le répertoire de destination n\'existe pas ou est un fichier.');
define('_ACA_NO_WRITE_PERMS' , 'Le répertoire de destination n\'a pas les droits en écriture.');
define('_ACA_NO_USER_FILE' , 'Vous n\'avez pas sélectionné de fichiers pour l\'importation.');
define('_ACA_E_FAIL_MOVE' , 'Impossible de déplacer le fichier.');
define('_ACA_FILE_EXISTS' , 'Le répertoire de destination existe déjà.');
define('_ACA_CANNOT_OVERWRITE' , 'Le répertoire de destination existe déjà et il est impossible de l\'écraser.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'L\'extention du fichier n\'est pas autorisé.');
define('_ACA_PARTIAL' , 'Le fichier a été partiellement importé.');
define('_ACA_UPLOAD_ERROR' , 'Erreur d\'importation :');
define('DEV_NO_DEF_FILE' , 'Le fichier a été partiellement importé.');
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Ceci sera remplacé par les liens de souscription.' .
		' Ceci est <strong>nécessaire</strong> pour qu\'Acajoom fonctionne correctement.<br />' .
		'Si vous placez n\'importe quel autre contenu dans ce cadre il sera affiché dans tous les envois correspondants à cette liste.' .
		' <br />Ajouter votre message de souscription à la fin.  Acajoom ajoutera automatiquement un lien pour que les utilisateurs puissent modifier leurs informations et un lien pour se désabonner de la liste.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notification');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notifications');
define('_ACA_USE_SEF', 'SEF dans les envois');
define('_ACA_USE_SEF_TIPS', 'Il est recommandé de choisir non. Cependant si vous voulez que l\'url incluse dans vos envois utilise  SEF alors choississez Oui.' .
		' <br /><b>Les liens fonctionneront de la même manière pour l\'une ou l\'autre des options .  Rien n\'assurera que les liens dans les envois fonctionneront toujours si vous changez votre SEF.</b> ');
define('_ACA_ERR_NB' , 'Erreur #: ERR');
define('_ACA_ERR_SETTINGS', 'Paramètres de gestion des erreurs');
define('_ACA_ERR_SEND' ,'Envoyer un rapport d\'erreur');
define('_ACA_ERR_SEND_TIPS' ,'Si vous voulez qu\'Acajoom s\'améliore, sélectionnez Oui.  Cela nous enverra un rapport d\'erreur.  Ainsi vous même n\'avez plus besoin de rapporter les bugs  ;-) <br /> <b>AUCUNE INFORMATION PRIVEE N\'EST ENVOYEE</b>.  Nous ne savons même pas de quel site Web,  l\'erreur provient . Nous envoyons seulement des informations sur Acajoom, l\'installation PHP et les requêtes SQL. ');
define('_ACA_ERR_SHOW_TIPS' ,'Choississez Oui pour afficher le nombre d\'erreurs à l\'écran.  Principalement utiliser dans le but de débugger. ');
define('_ACA_ERR_SHOW' ,'Afficher erreurs');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Afficher les liens de désabonnement');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Sélectionner Oui pour afficher les liens de désabonnement en bas des e-mails pour permettre aux utilisateurs de modifier leurs inscriptions. <br /> Non désactive le bas de page et les liens.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">IMPORTANT AVERTISSEMENT!</span> <br />Si vous mettez à jour votre précendente installation d\'Acajoom, vous avez besoin de mettre à jour votre structure de base de données en cliquant sur le bouton suivant (Vos données resteront en intégralité)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Mettre à jour les tables et la configuration');
define('_ACA_MAILING_MAX_TIME', 'Délai d\'attente maximum ' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Définissez le temps maximum pour que chaque lot d\'emails soit envoyé par la file d\'attente . Recommander entre 30s et 2mins.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'Integration à VirtueMart');
define('_ACA_VM_COUPON_NOTIF', 'Identifiant de notification du coupon');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Spécifiez le numéro d\'identifiant de la liste que vous voulez utiliser pour envoyer les coupons à vos clients.');
define('_ACA_VM_NEW_PRODUCT', 'Identifiant de notification de nouveaux produits');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Spécifiez le numéro d\'identifiant de la liste que vous voulez utiliser pour envoyer la notification de nouveaux produits.');


// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Créer un formulaire');
define('_ACA_FORM_COPY', 'Code HTML');
define('_ACA_FORM_COPY_TIPS', 'Copiez le code HTML générer dans votre page HTML.');
define('_ACA_FORM_LIST_TIPS', 'Sélectionnez la liste que vous voulez inclure dans votre formulaire');
// update messages
define('_ACA_UPDATE_MESS4' , 'Ceci ne peut pas être mis à jour automatiquement.');
define('_ACA_WARNG_REMOTE_FILE' , 'Aucun moyen d\'obtenir le dossier à distance .');
define('_ACA_ERROR_FETCH' , 'Erreur lors de la recherche du fichier.');

define('_ACA_CHECK' , 'Vérifier');
define('_ACA_MORE_INFO' , 'Plus d\'informations');
define('_ACA_UPDATE_NEW' , 'Passer à la nouvelle version');
define('_ACA_UPGRADE' , 'Passer à un produit avancé');
define('_ACA_DOWNDATE' , 'Retour à la version précedente');
define('_ACA_DOWNGRADE' , 'Retour au produit de base');
define('_ACA_REQUIRE_JOOM' , 'Requiert Joomla');
define('_ACA_TRY_IT' , 'Essayez le !');
define('_ACA_NEWER', 'Nouveau');
define('_ACA_OLDER', 'Ancien');
define('_ACA_CURRENT', 'Courant');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Essayer un des autres composants');
define('_ACA_MENU_VIDEO' , 'Tutorials Vidéo');
define('_ACA_AUTO_SCHEDULE', 'Plannification');
define('_ACA_SCHEDULE_TITLE', 'Paramètres de la fonction de plannification automatique');
define('_ACA_ISSUE_NB_TIPS' , 'Nombre de questions générées automatiquement par le système ' );
define('_ACA_SEL_ALL' , 'Tous les mailings');
define('_ACA_SEL_ALL_SUB' , 'Toutes les listes');
define('_ACA_INTRO_ONLY_TIPS' , 'Si vous cochez cette case seul l\'introduction de votre article sera inséré dans vos envois avec un lien \'lire plus\' vers l\'article entier sur votre site web.' );
define('_ACA_TAGS_TITLE' , 'Tag Contenu');
define('_ACA_TAGS_TITLE_TIPS' , 'Copiez et collez ce tag dans vos envois à l\'endroit où vous voulez placer le contenu.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Indiquez l\'adresse e-mail pour envoyer un e-mail de test');
define('_ACA_PREVIEW_TITLE' , 'Aperçu');
define('_ACA_AUTO_UPDATE' , 'Notification de nouvelle mise à jour');
define('_ACA_AUTO_UPDATE_TIPS' , 'Sélectionnez Oui si vous voulez être averti des nouvelles mises à jour pour votre composant. <br />IMPORTANT!! Afficher tips doit être activé pour que cela fonctionne.');

// since 1.1.0
define('_ACA_LICENSE' , 'Information sur la license');


// since 1.1.1
define('_ACA_NEW' , 'Nouveau');
define('_ACA_SCHEDULE_SETUP', 'Pour envoyer des réponses automatiques, vous avez besoin d\'installer le programmateur dans la configuration.');
define('_ACA_SCHEDULER', 'Programmateur');
define('_ACA_ACAJOOM_CRON_DESC' , 'Si vous n\'avez pas accès au gestionnaire des tâches Cron de votre site internet, vous pouvez vous enregistrer à un compte libre d\'Acajoom Cron à :' );
define('_ACA_CRON_DOCUMENTATION' , 'Vous pouvez trouvez des informations supplémentaires sur l\'installation du programmateur d\'Acajoom à l\'adresse suivante :');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'File d\attende traitée avec succès...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Erreur lors du déplacement du fichier importé' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Fréquence du programmateur' );
define( '_ACA_CRON_MAX_FREQ' , 'Fréquence maximum du programmateur' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Spécifier la fréquence maximum à laquelle le programmateur peut fonctionner ( en minutes ).  Cela va limiter le programmateur même si la tâche cron est plus fréquente.' );
define( '_ACA_CRON_MAX_EMAIL' , 'E-mails maximum par tâche' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Spécifier le nombre maximum d\'e-mails envoyés par tâche (0 illimité).' );
define( '_ACA_CRON_MINUTES' , ' minutes' );
define( '_ACA_SHOW_SIGNATURE' , 'Montrer le pied de page de l\'e-mail' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Si vous voulez ou non promouvoir Acajoom dans le pied de page de vos e-mails.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Réponses automatiques traitées avec succès...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Newsletters programmées traitées avec succès...' );
define( '_ACA_MENU_SYNC_USERS' , 'Synchronisation des utilisateurs' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Synchronisation des utilisateurs réussie!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Déconnexion' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Oui' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Non' );
if (!defined('_HI')) define( '_HI', 'Salut' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Haut' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Bas' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Déconnexion' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Si vous sélectionnez ceci seul le titre de l\'article sera inséré dans l\'envoi comme lien vers l\'article entier sur votre site.');
define('_ACA_TITLE_ONLY' , 'Titre seul');
define('_ACA_FULL_ARTICLE_TIPS' , 'Si vous sélectionnez ceci l\'article entier sera inséré dans votre envoi');
define('_ACA_FULL_ARTICLE' , 'Article entier');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Sélectionnez un article à insérer dans votre message. <br />Copier et coller le <b>tag de contenu</b> dans votre Newsletter.  Vous pouvez choisir d\'avoir le text entier, une introduction seulement, ou le titre seulement avec (0, 1, ou 2 respectivement). ');
define('_ACA_SUBSCRIBE_LIST2', 'Liste(s) d\'envois');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Smart-Newsletter');
define('_ACA_MENU_AUTONEWS', 'Smart-Newsletters');
define('_ACA_AUTO_NEWS_OPTION', 'Options Smart-Newsletter');
define('_ACA_AUTONEWS_FREQ', 'Fréquence des Newsletters');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Spécifiez la fréquence à laquelle vous voulez envoyer les smart-newsletter.');
define('_ACA_AUTONEWS_SECTION', 'Section Article');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Spécifiez la section à partir de laquelle vous voulez choisir les articles.');
define('_ACA_AUTONEWS_CAT', 'Catégorie Article');
define('_ACA_AUTONEWS_CAT_TIPS', 'Spécifiez la catégorie à partir de laquelle vous voulez choisir les articles (Toutes pour tous les articles de la section).');
define('_ACA_SELECT_SECTION', 'Sélectionner une section');
define('_ACA_SELECT_CAT', 'Toutes les categories');
define('_ACA_AUTO_DAY_CH8', 'Trimestriel');
define('_ACA_AUTONEWS_STARTDATE', 'Date de début');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Spécifiez la date à laquelle vous souhaitez débuter les envois de Smart Newsletter.');
define('_ACA_AUTONEWS_TYPE', 'Rendu du contenu');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Article Entier: inclura l\'article entier dans la newsletter.<br />' .
		'Intro seulement: inclura seulement l\'introduction de l\'article dans la newsletter.<br/>' .
		'Titre seulement: inclura seulement le titre de l\'article dans la newsletter.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Ceci sera remplacé par la Smart-newsletter.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Créer / Voir les Mailings');
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

define('_DATE_OPT_1', 'Date de création');
define('_DATE_OPT_2', 'Date de modification');

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

define( '_ACA_LIST_ACCESS_EDIT', 'Ajouter/Editer un Mailing' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', 'Specify what group of users can add or edit a new mailing for this list' );
define( '_ACA_MAILING_NEW_FRONT', 'Créer un nouveau Mailing' );

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
define('_ACA_SHOW_AUTHOR', 'Afficher l\'auteur de l\'article');
define('_ACA_SHOW_AUTHOR_TIPS', 'Cliquez sur Oui si vous voulez ajouter le nom de l\'auteur des articles insérés dans les Mailings');

//since 1.3.5
define('_ACA_REGWARN_NAME','Saisissez votre nom.');
define('_ACA_REGWARN_MAIL','Saisissez une adresse e-mail valide.');

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS','If you select Yes, the e-mail of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be usefull if you want to execute a special script in your redirect page.');
define('_ACA_ADDEMAILREDLINK','Add e-mail to the redirect link');

//since 1.6.3
define('_ACA_ITEMID','ItemId');
define('_ACA_ITEMID_TIPS','Cet Itemid va être ajouté aux liens d\'Acajoom');

//since 1.6.5
define('_ACA_SHOW_JCALPRO','jCalPRO');
define('_ACA_SHOW_JCALPRO_TIPS','Afficher le tab pour ajouter des évènements du composant jCalPro <br/>(uniquement si jcalPro est installé sur votre site!)');
define('_ACA_JCALTAGS_TITLE','jCalPRO Tag:');
define('_ACA_JCALTAGS_TITLE_TIPS','Copier/coller ce tag dans votre Newsletter et il sera remplacé par l\'évènement sélectionné');
define('_ACA_JCALTAGS_DESC','Description :');
define('_ACA_JCALTAGS_DESC_TIPS','Sélectionnez OUI si vous voulez que la description de l\'évènement soit ajoutée');
define('_ACA_JCALTAGS_START','Date de début:');
define('_ACA_JCALTAGS_START_TIPS','Sélectionnez OUI si vous voulez que la date de début de l\'évènement soit ajoutée');
define('_ACA_JCALTAGS_READMORE','Lire la suite:');
define('_ACA_JCALTAGS_READMORE_TIPS','Sélectionnez OUI si vous voulez qu\'un lien pour lire la suite de de l\'évènement soit ajouté');
define('_ACA_REDIRECTCONFIRMATION','Redirect URL');
define('_ACA_REDIRECTCONFIRMATION_TIPS','If you require a confirmation e-mail, the user will be confirmed and redirected to this URL if he clicks on the confirmation link.');

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Enregistrer');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','Pas encore de compte&nbsp;?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Enregistrez-vous');
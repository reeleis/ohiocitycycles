<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>Spanish language file</p>
* @author Jorge Pasco <servicio@eaid.org>
* @version $Id: spanish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.eaid.org
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom es una herramienta para confeccionar listas de correo, boletines, auto-respuestas y seguimientos; que podrá utilizar para comunicarse con sus clientes y usuarios de manera efectiva.  ' .
		'¡Acajoom, su asistente de comunicaciones!');
define('_ACA_FEATURES', '¡Acajoom, su asistente de comunicaciones!');

// Type of lists
define('_ACA_NEWSLETTER', 'Boletín');
define('_ACA_AUTORESP', 'Auto-respuesta');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'Tarjeta electrónica');
define('_ACA_POSTCARD', 'Postal');
define('_ACA_PERF', 'Performance');
define('_ACA_COUPON', 'Cupón');
define('_ACA_CRON', 'Tarea Cron');
define('_ACA_MAILING', 'Envío');
define('_ACA_LIST', 'Lista');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Listas');
define('_ACA_MENU_SUBSCRIBERS', 'Suscriptores');
define('_ACA_MENU_NEWSLETTERS', 'Boletines');
define('_ACA_MENU_AUTOS', 'Auto-respuestas');
define('_ACA_MENU_COUPONS', 'Cupones');
define('_ACA_MENU_CRONS', 'Tareas Cron');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'Tarjetas electrónicass');
define('_ACA_MENU_POSTCARDS', 'Postales');
define('_ACA_MENU_PERFS', 'Performances');
define('_ACA_MENU_TAB_LIST', 'Listas');
define('_ACA_MENU_MAILING_TITLE', 'Envíos');
define('_ACA_MENU_MAILING' , 'Envíos para ');
define('_ACA_MENU_STATS', 'Estadísticas');
define('_ACA_MENU_STATS_FOR', 'Estadísticas para ');
define('_ACA_MENU_CONF', 'Configuración');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Acerca de');
define('_ACA_MENU_LEARN', 'Centro de aprendizaje');
define('_ACA_MENU_MEDIA', 'Gestor multimedia');
define('_ACA_MENU_HELP', 'Ayuda');
define('_ACA_MENU_CPANEL', 'Panel de control');
define('_ACA_MENU_IMPORT', 'Importar');
define('_ACA_MENU_EXPORT', 'Exportar');
define('_ACA_MENU_SUB_ALL', 'Subcribirse a todo');
define('_ACA_MENU_UNSUB_ALL', 'De-subcribirse a todo');
define('_ACA_MENU_VIEW_ARCHIVE', 'Archivo');
define('_ACA_MENU_PREVIEW', 'Vista previa');
define('_ACA_MENU_SEND', 'Enviar');
define('_ACA_MENU_SEND_TEST', 'Enviar correo de prueba');
define('_ACA_MENU_SEND_QUEUE', 'Cola de procesos');
define('_ACA_MENU_VIEW', 'Ver');
define('_ACA_MENU_COPY', 'Copiar');
define('_ACA_MENU_VIEW_STATS' , 'Ver estadísticas');
define('_ACA_MENU_CRTL_PANEL' , 'Panel de control');
define('_ACA_MENU_LIST_NEW' , ' Crear una lista');
define('_ACA_MENU_LIST_EDIT' , ' Editar una lista');
define('_ACA_MENU_BACK', 'Regresar');
define('_ACA_MENU_INSTALL', 'Instalación');
define('_ACA_MENU_TAB_SUM', 'Resumen');
define('_ACA_STATUS' , 'Estado');

// messages
define('_ACA_ERROR' , ' ¡Ha ocurrido un error! ');
define('_ACA_SUB_ACCESS' , 'Derechos de acceso');
define('_ACA_DESC_CREDITS', 'Créditos');
define('_ACA_DESC_INFO', 'Información');
define('_ACA_DESC_HOME', 'Página de inicio');
define('_ACA_DESC_MAILING', 'Lista de envíos');
define('_ACA_DESC_SUBSCRIBERS', 'Suscriptores');
define('_ACA_PUBLISHED','Publicado');
define('_ACA_UNPUBLISHED','No Publicado');
define('_ACA_DELETE','Eliminar');
define('_ACA_FILTER','Filtrar');
define('_ACA_UPDATE','Actualizar');
define('_ACA_SAVE','Guardar');
define('_ACA_CANCEL','Cancelar');
define('_ACA_NAME','Nombre');
define('_ACA_EMAIL','Correo');
define('_ACA_SELECT','Seleccionar');
define('_ACA_ALL','todo');
define('_ACA_SEND_A', 'Enviar a ');
define('_ACA_SUCCESS_DELETED', ' eliminado con éxito');
define('_ACA_LIST_ADDED', 'Lista creada con éxito');
define('_ACA_LIST_COPY', 'Lista copiada con éxito');
define('_ACA_LIST_UPDATED', 'Lista actualizada con éxito');
define('_ACA_MAILING_SAVED', 'Envío guardado con éxito.');
define('_ACA_UPDATED_SUCCESSFULLY', 'Actualizado con éxito.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Información del suscriptor');
define('_ACA_VERIFY_INFO', 'Por favor verifique el enlace que envió, alguna información no es correcta o se ha perdido.');
define('_ACA_INPUT_NAME', 'Nombre');
define('_ACA_INPUT_EMAIL', 'Correo');
define('_ACA_RECEIVE_HTML', '¿Acepta HTML?');
define('_ACA_TIME_ZONE', 'Zona horaria');
define('_ACA_BLACK_LIST', 'Lista negra');
define('_ACA_REGISTRATION_DATE', 'Fecha de registro de usuario');
define('_ACA_USER_ID', 'Id de usuario');
define('_ACA_DESCRIPTION', 'Descripción');
define('_ACA_ACCOUNT_CONFIRMED', 'Su cuenta ha sido activada.');
define('_ACA_SUB_SUBSCRIBER', 'Suscriptor');
define('_ACA_SUB_PUBLISHER', 'Editor');
define('_ACA_SUB_ADMIN', 'Administrador');
define('_ACA_REGISTERED', 'Registrado');
define('_ACA_SUBSCRIPTIONS', 'Vuestra suscripción');
define('_ACA_SEND_UNSUBCRIBE', 'Enviar mensaje para de-suscribirse');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Seleccione SI para enviar un correo de confirmación a fin de de-suscribirse.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Por favor confirme su suscripción');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Confirmación de de-suscripción');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Saludos [NAME],<br />' .
		'Falta un paso más para confirmar su suscripción en la lista.  Por favor acceda al siguiente enlace a fin de confirmar su suscripción.' .
		'<br /><br />[CONFIRM]<br /><br />Para cualquier consulta contáctese con el administrador.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Este es un mensaje que confirma su de-suscripción de nuestra lista.  Sentimos mucho que haya decidido cancelar su suscripción, sin embargo si decide reaanudarla puede hacerlo en nuestro portal web. Si tuviese alguna consulta puede contactar al administrador.');

// Acajoom Subscribers
define('_ACA_SIGNUP_DATE', 'Fecha de registro');
define('_ACA_CONFIRMED', 'Confirmado');
define('_ACA_SUBSCRIB', 'Suscrito');
define('_ACA_HTML', 'Correo HTML');
define('_ACA_RESULTS', 'Resultados');
define('_ACA_SEL_LIST', 'Seleccione una lista');
define('_ACA_SEL_LIST_TYPE', '- Seleccione el tipo de lista -');
define('_ACA_SUSCRIB_LIST', 'Lista de todos los suscriptores');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Suscriptores para: ');
define('_ACA_NO_SUSCRIBERS', 'No se encontraron suscriptores para estas listas.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Un mensaje de confirmación le ha sido enviado.  Por favor revise su correo y seleccione el enlace provisto.<br />' .
		'Necesita confirmar su correo para que su suscripción sea iniciada.');
define('_ACA_SUCCESS_ADD_LIST', 'Usted ha sido añadido exitósamente a la lista.');


 // Subscription info
define('_ACA_CONFIRM_LINK', 'Acceda aquí para confirmar la suscripción');
define('_ACA_UNSUBSCRIBE_LINK', 'Acceda aquí para cancelar manualmente la suscripción a la lista');
define('_ACA_UNSUBSCRIBE_MESS', 'Su correo ha sido removido de la lista');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Todos los mensajes pendientes han sido enviados con éxito.');
define('_ACA_MALING_VIEW', 'Ver todos los envíos');
define('_ACA_UNSUBSCRIBE_MESSAGE', '¿Está seguro que desea cancelar su suscripción de esta lista?');
define('_ACA_MOD_SUBSCRIBE', 'Suscribirse');
define('_ACA_SUBSCRIBE', 'Suscribirse');
define('_ACA_UNSUBSCRIBE', 'De-suscribirse');
define('_ACA_VIEW_ARCHIVE', 'Ver archivo');
define('_ACA_SUBSCRIPTION_OR', ' o acceda aquí para actualizar su información');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Este correo ha sido registrado previamente.');
define('_ACA_SUBSCRIBER_DELETED', 'Suscriptor eliminado con éxito.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Panel de control del usuario');
define('_UCP_USER_MENU', 'Menú del usuario');
define('_UCP_USER_CONTACT', 'Mis suscripciones');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Administración de tareas Cron');
define('_UCP_CRON_NEW_MENU', 'Nueva tarea Cron');
define('_UCP_CRON_LIST_MENU', 'Lista de mis tareas Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Administración de cupones');
define('_UCP_COUPON_LIST_MENU', 'Lista de cupones');
define('_UCP_COUPON_ADD_MENU', 'Añadir un cupón');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Descripción');
define('_ACA_LIST_T_LAYOUT', 'Formato');
define('_ACA_LIST_T_SUBSCRIPTION', 'Suscripción');
define('_ACA_LIST_T_SENDER', 'Información de remitente');

define('_ACA_LIST_TYPE', 'Tipo de lista');
define('_ACA_LIST_NAME', 'Nombre de lista');
define('_ACA_LIST_ISSUE', 'Edición #');
define('_ACA_LIST_DATE', 'Fecha de envío');
define('_ACA_LIST_SUB', 'Asunto');
define('_ACA_ATTACHED_FILES', 'Archivos adjuntos');
define('_ACA_SELECT_LIST', '¡Por favor seleccione una lista para editar!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Tipo de lista');
define('_ACA_AUTO_RESP_OPTION', 'Opciones de Auto-respuesta');
define('_ACA_AUTO_RESP_FREQ', 'Los suscriptores pueden elegir la frecuencia');
define('_ACA_AUTO_DELAY', 'Retardo (en días)');
define('_ACA_AUTO_DAY_MIN', 'Frecuencia mínima');
define('_ACA_AUTO_DAY_MAX', 'Frecuencia máxima');
define('_ACA_FOLLOW_UP', 'Especificar seguimiento de auto-respuesta');
define('_ACA_AUTO_RESP_TIME', 'Suscriptores pueden elegir el tiempo');
define('_ACA_LIST_SENDER', 'Remitentes de lista');

define('_ACA_LIST_DESC', 'Descripción de lista');
define('_ACA_LAYOUT', 'Formato');
define('_ACA_SENDER_NAME', 'Nombre de remitente');
define('_ACA_SENDER_EMAIL', 'Correo de remitente');
define('_ACA_SENDER_BOUNCE', 'Dirección de respuesta de remitente');
define('_ACA_LIST_DELAY', 'Retardo');
define('_ACA_HTML_MAILING', '¿Envío en HTML?');
define('_ACA_HTML_MAILING_DESC', '(si efectúa algún cambio deberá guardarlo y retornar a esta pantalla para poder observar el efecto.)');
define('_ACA_HIDE_FROM_FRONTEND', '¿Esconder en el portal web?');
define('_ACA_SELECT_IMPORT_FILE', 'Seleccione un archivo para importar');;
define('_ACA_IMPORT_FINISHED', 'Importación finalizada');
define('_ACA_DELETION_OFFILE', 'Eliminación de fichero');
define('_ACA_MANUALLY_DELETE', ' falló, usted deberá eliminar el fichero manualmente');
define('_ACA_CANNOT_WRITE_DIR', 'no se puede escribir en el directorio');
define('_ACA_NOT_PUBLISHED', 'no puede remitirse el envío, la lista no se ha publicado.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Seleccione SI para publicar la lista');
define('_ACA_INFO_LIST_NAME', 'Ingrese el nombre de su lista. Usted puede identificar su lista mediante este nombre.');
define('_ACA_INFO_LIST_DESC', 'Ingrese una breve descripción de su lista. Esta descripción será visible por los visitantes de su portal.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Ingrese el nombre del remitente del envío. Este nombre será visible cuando los suscriptores reciban mensajes de esta lista.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Ingrese el correo electrónico del cual serán enviados los mensajes.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Ingrese el correo electrónico al cual podrán responder los suscriptores. Es áltamente recomendable que sea el mismo del cual ha sido enviado el mensaje puesto que los filtros de spam pueden considerarlo como riesgoso si encuentran diferencias.');
define('_ACA_INFO_LIST_AUTORESP', 'Escoja el tipo de envío para esta lista. <br />' .
		'Boletín: boletín normal<br />' .
		'Auto-respuesta: una auto-respuesta es una lista que es enviada automáticamente mediante el portal web a intervalos regulares.');
define('_ACA_INFO_LIST_FREQUENCY', 'Permitir a los usuarios seleccionar la frecuencia con la cual recibirán la lista.  Esto les provee flexibilidad de operación.');
define('_ACA_INFO_LIST_TIME', 'Permita que el usuario escoja el momento del día en el cual recibirá la lista.');
define('_ACA_INFO_LIST_MIN_DAY', 'Defina cual es la frecuencia mínima que el usuario podrá escoger para recibir la lista');
define('_ACA_INFO_LIST_DELAY', 'Defina cual es el retardo entre esta auto-respuesta y la anterior.');
define('_ACA_INFO_LIST_DATE', 'Especifique la fecha para publicar las nuevas listas si quiere retardar la publicación. <br /> FORMATO : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Defina cual es la frecuencia máxima que el usuario podrá escoger para recibir la lista');
define('_ACA_INFO_LIST_LAYOUT', 'Ingrese el diseño de sus envíos. Puede ingresar cualquier diseño para sus correos.');
define('_ACA_INFO_LIST_SUB_MESS', 'Este mensaje será enviado al suscriptor cuando el o ella se registren por primera vez. Puede definir el texto que desee aquí.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Este mensaje será enviado al suscriptor cuando el o ella se de-suscriba. Puede ingresar cualquier mensaje aquí.');
define('_ACA_INFO_LIST_HTML', 'Seleccione la casilla de verificación si quiere enviar correos en formato HTML. Los suscriptores pueden especificar si desean recibir mensajes en formato HTML o en texto llano cuando se suscriben a una lista HTML.');
define('_ACA_INFO_LIST_HIDDEN', 'Elija SI para esconder la lista en el portal web, los usuarios no serán capaces de suscribirse pero usted podrá seguir enviando listas a los que ya se han registrado.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', '¿Quiere suscribir usuarios automáticamente a esta lista?<br /><B>Nuevos usuarios:</B> serán registrados todos los nuevos usuarios que se registren a través del portal web.<br /><B>Todos los usuarios:</B> serán registrados todos los usuarios de la base de datos.<br />(todas estas opciones soportan Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Seleccione el nivel de acceso del portal web. Esto podrá mostrar u ocultar los envíos a los grupos de usuarios que no tengan acceso a ella, por tanto no tendrán la opción de suscribirse.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Seleccione el nivel de acceso de los grupos de usuarios a los cuales permitirá la edición. Ese grupo y los inmediatamente superiores tendrán la posibilidad de editar los envíos y remitirlos tanto desde el portal web como desde el panel administrativo.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Puede especificar el seguimiento  de la auto-respuesta si usted desea que sea movida a otra una vez que alcance el último mensaje.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Esta es la identificación de la persona que creó la lista.');
define('_ACA_INFO_LIST_WARNING', '   Esta última opción estará disponible sólo al momento de la creación de la lista.');
define('_ACA_INFO_LIST_SUBJET', ' Asunto del envío.  Este es el asunto que mostrará el mensaje que el suscriptor reciba.');
define('_ACA_INFO_MAILING_CONTENT', 'Este es el cuerpo del mensaje que usted quiere enviar.');
define('_ACA_INFO_MAILING_NOHTML', 'Ingrese el cuerpo del mensaje que usted desea enviar a los suscriptores que escogieron secibir sólo mensajes en texto llano. <BR/> NOTE: Si lo deja en blanco Acajoom convertirá automáticamente el HTML a texto llano.');
define('_ACA_INFO_MAILING_VISIBLE', 'Seleccione SI para mostrar el mensaje en el portal web.');
define('_ACA_INSERT_CONTENT', 'Inserte un contenido existente');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', '¡Cupón enviado con éxito!');
define('_ACA_CHOOSE_COUPON', 'Seleccione un cupón');
define('_ACA_TO_USER', ' para este usuario');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Cada hora');
define('_ACA_FREQ_CH2', 'Cada 6 horas');
define('_ACA_FREQ_CH3', 'Cada 12 horas');
define('_ACA_FREQ_CH4', 'Diario');
define('_ACA_FREQ_CH5', 'Semanal');
define('_ACA_FREQ_CH6', 'Mensual');
define('_ACA_FREQ_NONE', 'No');
define('_ACA_FREQ_NEW', 'Nuevos usuarios');
define('_ACA_FREQ_ALL', 'Todos los usuarios');

//Label CRON form
define('_ACA_LABEL_FREQ', '¿Tarea Cron de Acajoom?');
define('_ACA_LABEL_FREQ_TIPS', 'Seleccione SI en el caso que desee usar esto para una tarea Cron de Acajoom, NO para cualquier otra tarea Cron.<br />' .
		'Si escoge SI no necesita especificar la dirección de la tarea Cron puesto que será añadida automaticamente.');
define('_ACA_SITE_URL' , 'Su dirección URL');
define('_ACA_CRON_FREQUENCY' , 'Frecuencia de tarea Cron');
define('_ACA_STARTDATE_FREQ' , 'Fecha de inicio');
define('_ACA_LABELDATE_FREQ' , 'Especifique fecha');
define('_ACA_LABELTIME_FREQ' , 'Especifique hora');
define('_ACA_CRON_URL', 'Dirección URL de tarea Cron');
define('_ACA_CRON_FREQ', 'Frecuencia');
define('_ACA_TITLE_CRONLIST', 'Lista de tareas Cron');
define('_NEW_LIST', 'Cree una nueva lista');

//title CRON form
define('_ACA_TITLE_FREQ', 'Editar tareas Cron');
define('_ACA_CRON_SITE_URL', 'Por favor ingrese una URL válida que empiece con http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Todos los envíos');
define('_ACA_EDIT_A', 'Editar un ');
define('_ACA_SELCT_MAILING', 'Por favor seleccione una lista del menú desplegable a fin de añadir un nuevo envío.');
define('_ACA_VISIBLE_FRONT', 'Visible en el portal web');

// mailer
define('_ACA_SUBJECT', 'Asunto');
define('_ACA_CONTENT', 'Contenido');
define('_ACA_NAMEREP', '[NAME] = Este campo será reemplazado por el nombre que el suscriptor haya ingresado al registrarse, con ello podrá personalizar sus mensajes.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Este campo será reemplazado por el primer nombre del suscriptor.<br />');
define('_ACA_NONHTML', 'Version en texto llano');
define('_ACA_ATTACHMENTS', 'Archivos adjuntos');
define('_ACA_SELECT_MULTIPLE', 'Mantenga presionado CTRL (o command) para seleccionar múltiples archivos adjuntos.<br />' .
		'Los ficheros mostrados en este grupo están localizados en la carpeta de archivos adjuntos, usted puede cambiar la ubicación en el panel de control.');
define('_ACA_CONTENT_ITEM', 'Artículos con contenido');
define('_ACA_SENDING_EMAIL', 'Enviando correo');
define('_ACA_MESSAGE_NOT', 'El mensaje no pudo ser enviado');
define('_ACA_MAILER_ERROR', 'Error del proceso de correo');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Mensaje enviado con éxito');
define('_ACA_SENDING_TOOK', 'Enviar este mensaje tomará');
define('_ACA_SECONDS', 'segundos');
define('_ACA_NO_ADDRESS_ENTERED', 'No se ha especificado dirección de correo o suscriptor');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Cambiar');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Cambiar la suscripción');
define('_ACA_WHICH_EMAIL_TEST', 'Indique una dirección de correo donde enviar un mensaje de prueba para comprobar la visualización');
define('_ACA_SEND_IN_HTML', '¿Enviar con formato HTML (para listas html)?');
define('_ACA_VISIBLE', 'Visible');
define('_ACA_INTRO_ONLY', 'Sólo introducción');

// stats
define('_ACA_GLOBALSTATS', 'Estadísticas globales');
define('_ACA_DETAILED_STATS', 'Estadísticas detalladas');
define('_ACA_MAILING_LIST_DETAILS', 'Estadísticas de listas');
define('_ACA_SEND_IN_HTML_FORMAT', 'Enviar con formato HTML');
define('_ACA_VIEWS_FROM_HTML', 'Vistas (de correos html)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Enviar como texto llano');
define('_ACA_HTML_READ', 'leído HTML');
define('_ACA_HTML_UNREAD', 'no leído HTML');
define('_ACA_TEXT_ONLY_SENT', 'Texto llano');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Correo');
define('_ACA_LOGGING_CONFIG', 'Registro y estadísticas');
define('_ACA_SUBSCRIBER_CONFIG', 'Suscriptores');
define('_ACA_MISC_CONFIG', 'Otros');
define('_ACA_MAIL_SETTINGS', 'Configuración de cuenta de correo');
define('_ACA_MAILINGS_SETTINGS', 'Configuración de envíos');
define('_ACA_SUBCRIBERS_SETTINGS', 'Configuración de suscriptores');
define('_ACA_CRON_SETTINGS', 'Configuración de tareas Cron');
define('_ACA_SENDING_SETTINGS', 'Configuración de despachos');
define('_ACA_STATS_SETTINGS', 'Configuración de estadísticas');
define('_ACA_LOGS_SETTINGS', 'Configuración de registros');
define('_ACA_MISC_SETTINGS', 'Otras configuraciones');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Correo de envío');
define('_ACA_SEND_MAIL_NAME', 'Nombre de envío');
define('_ACA_MAILSENDMETHOD', 'Método de correo');
define('_ACA_SENDMAILPATH', 'Ruta de Sendmail');
define('_ACA_SMTPHOST', 'Servidor SMTP');
define('_ACA_SMTPAUTHREQUIRED', 'Autentificación requerida por SMTP');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Seleccione SI en el caso que su servidor SMTP requiera autentificación');
define('_ACA_SMTPUSERNAME', 'Usuario SMTP');
define('_ACA_SMTPUSERNAME_TIPS', 'Ingrese el nombre de usuario para el servidor SMTP');
define('_ACA_SMTPPASSWORD', 'Contraseña SMTP');
define('_ACA_SMTPPASSWORD_TIPS', 'Ingrese la contraseña para el servidor SMTP');
define('_ACA_USE_EMBEDDED', 'Usar imágenes incluídas');
define('_ACA_USE_EMBEDDED_TIPS', 'Seleccione SI en el caso que las imágenes adjuntas en los artículos con contenido deban ser incluídas en el correo con formato html. Seleccione NO para usar etiquetas de imágenes que las vincularán con una dirección de su sitio web.');
define('_ACA_UPLOAD_PATH', 'Ruta de subida/archivos adjuntos');
define('_ACA_UPLOAD_PATH_TIPS', 'Puede especificar un directorio para carga de archivos.<br />' .
		'Asegúrese que el directorio especificado exista de lo contrario créelo.');

// Suscriptors settings
define('_ACA_ALLOW_UNREG', 'Permitir no registrados');
define('_ACA_ALLOW_UNREG_TIPS', 'Seleccione SI en el caso que desee que sus usuarios se suscriban a las listas sin haberse registrado en su portal web.');
define('_ACA_REQ_CONFIRM', 'Requerir confirmación');
define('_ACA_REQ_CONFIRM_TIPS', 'Seleccione SI en el caso que requiera que sus suscriptores no registrados confirmen sus direcciones de correo electrónico.');
define('_ACA_SUB_SETTINGS', 'Configuración de suscripción');
define('_ACA_SUBMESSAGE', 'Correo de suscripción');
define('_ACA_SUBSCRIBE_LIST', 'Suscribirse a una lista');

define('_ACA_USABLE_TAGS', 'Etiquetas usables');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Este campo crea un vínculo donde el suscriptor puede confirmar su suscripción, es <strong>requerida</strong> para que Acajoom funcione correctamente.<br />'
.'<br />[NAME] = Este campo será reemplazado por el nombre que el suscriptor haya ingresado al registrarse, con ello podrá personalizar sus mensajes.<br />'
.'<br />[FIRSTNAME] = Este campo será reemplazado por el primer nombre del suscriptor.<br />');
define('_ACA_CONFIRMFROMNAME', 'Nombre de remitente en correo de confirmación');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Ingrese el nombre para mostrar en la confirmación de listas.');
define('_ACA_CONFIRMFROMEMAIL', 'Correo de remitente en confirmación');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Ingrese la dirección de correo que se mostrará en la confirmación de listas.');
define('_ACA_CONFIRMBOUNCE', 'Correo de respuesta');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Ingrese la dirección de correo de respuesta en la confirmación de listas.');
define('_ACA_HTML_CONFIRM', 'Confirmación de HTML');
define('_ACA_HTML_CONFIRM_TIPS', 'Seleccione SI  en el caso que que la confirmación de la lista deba ser html si es que el usuario lo permite.');
define('_ACA_TIME_ZONE_ASK', 'Solicitar zona horaria');
define('_ACA_TIME_ZONE_TIPS', 'Seleccione SI en el caso que desee preguntar al usuario su zona horaria. Los correos pendientes se basarán en la zona horaria cuando sea aplicable');

 // Cron Set up
 define('_ACA_AUTO_CONFIG', 'Tareas Cron');
define('_ACA_TIME_OFFSET_URL', 'Seleccione para configurar la compensación horaria (offset) en el panel de configuracioón global -> Tabulador Local');
define('_ACA_TIME_OFFSET_TIPS', 'Configure la compensación horaria en su servidor a fin que los registros de fecha y hora sean exactos');
define('_ACA_TIME_OFFSET', 'Compensación horaria');
define('_ACA_CRON_DESC','<br />¡Usando la función de tareas Cron podrá configurar la automatización de trabajos para su sitio Joomla!<br />' .
		'Para configurarlo usted necesitará añadir en las tareas Cron de su panel de control el siguiente commando:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Si usted necesita ayuda para efectuar la configuración o tiene problemas por favor remítase a nuestros foros en <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Detener x segundos cada cierta cantidad de correos');
define('_ACA_PAUSEX_TIPS', 'Ingrese el número de segundos que Acajoom deberá dar al servidor SMTP para enviar los mensajes antes de proceder con la siguiente cantidad configurada de mensajes.');
define('_ACA_EMAIL_BET_PAUSE', 'Correos entre pausas');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'La cantidad de correos a enviar antes de detener.');
define('_ACA_WAIT_USER_PAUSE', 'Esperar por confirmación de usuario en la pausa');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'En el caso que el script deba esperar a la confirmación del usuario entre los grupos de mensajes.');
define('_ACA_SCRIPT_TIMEOUT', 'Tiempo de espera del Script');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'La cantidad de minutos que el script debe esperar en ejecución (0 para ilimitado).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Permitir estadísticas de lectura');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Seleccione SI en el caso que desee registrar la cantidad de lecturas. Esta técnica sólo puede ser usada en los envíos html');
define('_ACA_LOG_VIEWSPERSUB', 'Registro de lecturas por suscriptor');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Seleccione SI en el caso que desee registrar el número de lecturas por suscriptor. Esta técnica sólo puede ser usada en los envíos html');
// Logs settings
define('_ACA_DETAILED', 'Registros detallados');
define('_ACA_SIMPLE', 'Registros simples');
define('_ACA_DIAPLAY_LOG', 'Mostrar registros');
define('_ACA_DISPLAY_LOG_TIPS', 'Seleccione SI en el caso que desee mostrar los registros mientras procesa sus envíos.');
define('_ACA_SEND_PERF_DATA', 'Performance de envíos');
define('_ACA_SEND_PERF_DATA_TIPS', 'Seleccione SI en el caso que desee permitir a Acajoom enviar reportes ANÓNIMOS respecto a su configuración, número de suscriptores de una lista y el tiempo que tomó realizar el envío. Esto puede darnos una idea del performance de Acajoom y nos podrá AYUDAR a mejorar Acajoom en entregas futuras.');
define('_ACA_SEND_AUTO_LOG', 'Enviar registros para auto-respuestas');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Seleccione SI en el caso que desee enviar un correo de registro cada vez que un proceso es ejecutado.  ADVERTENCIA: esto puede desencadenar la generación de una alta cantidad de correos.');
define('_ACA_SEND_LOG', 'Enviar Registro');
define('_ACA_SEND_LOG_TIPS', 'Si un registro del envío debe ser remitido a la dirección de correo del usuario que programó el mismo.');
define('_ACA_SEND_LOGDETAIL', 'Enviar detalles de registro');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Detallado: Incluye información detallada del éxito o fracaso por cada suscriptor junto con un resumen global. Simple: Sólo envía el resumen.');
define('_ACA_SEND_LOGCLOSED', 'Enviar registro si la conexión se cerró');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Con esta opción el usuario que generó el envío podrá recibir un reporte por correo.');
define('_ACA_SAVE_LOG', 'Guardar registro');
define('_ACA_SAVE_LOG_TIPS', 'Si un registro de envío debe ser guardado en un archivo.');
define('_ACA_SAVE_LOGDETAIL', 'Guardar detalles de registro');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Detallado: Incluye información detallada del éxito o fracaso por cada Suscriptor junto con un resumen global. Simple: Sólo envía el resumen.');
define('_ACA_SAVE_LOGFILE', 'Archivo de registro');
define('_ACA_SAVE_LOGFILE_TIPS', 'Archivo donde la información será guardada. Este archivo puede ser extenso.');
define('_ACA_CLEAR_LOG', 'Borrar registros');
define('_ACA_CLEAR_LOG_TIPS', 'Limpia el archivo de registros.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Último proceso ejecutado');
define('_ACA_CP_TOTAL', 'Total');
define('_ACA_MAILING_COPY', '¡Envío copiado con éxito!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Mostrar guía');
define('_ACA_SHOW_GUIDE_TIPS', 'Muestra la guía cuando inicia el componente a fin de facilitar a los nuevos usuarios la tarea de crear boletines, auto-respuestas y configurar Acajoom correctamente.');
define('_ACA_AUTOS_ON', 'Usar Auto-respuestas');
define('_ACA_AUTOS_ON_TIPS', 'Seleccione NO en el caso que no desee usar Auto-respuestas, todas las opciones de auto-respuestas serán desactivadas.');
define('_ACA_NEWS_ON', 'Usar Boletiness');
define('_ACA_NEWS_ON_TIPS', 'Select NO en el caso que no desee usar Boletines, todas las opciones de boletines serán desactivadas.');
define('_ACA_SHOW_TIPS', 'Mostrar consejos');
define('_ACA_SHOW_TIPS_TIPS', 'Mostrar consejos para ayudar a los usuarios a ejecutar Acajoom con mayor efectividad.');
define('_ACA_SHOW_FOOTER', 'Mostrar pie de página');
define('_ACA_SHOW_FOOTER_TIPS', 'Decidir si el pie de página con los derechos reservados debe ser o no mostrado.');
define('_ACA_SHOW_LISTS', 'Mostrar listas en el portal web');
define('_ACA_SHOW_LISTS_TIPS', 'Cuando un usuario no está registrado permite mostrar una lista de las listas a las cuales puede suscribirse con un botón de archivo para boletines o un simple formulario de registro.');
define('_ACA_CONFIG_UPDATED', '¡Los detalles de configuración han sido actualizados!');
define('_ACA_UPDATE_URL', 'URL para actualizaciones');
define('_ACA_UPDATE_URL_WARNING', '¡ADVERTENCIA! No cambie esta URL si antes no ha consultado con el equipo técnico de Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Por ejemplo: http://www.acajoom.com/update/ (incluya la barra de cierre)');

// module
define('_ACA_EMAIL_INVALID', 'El correo ingresado no es válido.');
define('_ACA_REGISTER_REQUIRED', 'Por favor regístrese en el portal antes de registrarse en una lista.');

// Access level box
define('_ACA_OWNER', 'Creador de la lista:');
define('_ACA_ACCESS_LEVEL', 'Defina el nivel de acceso para la lisra');
define('_ACA_ACCESS_LEVEL_OPTION', 'Opciones de nivel de acceso');
define('_ACA_USER_LEVEL_EDIT', 'Seleccione qué nivel de usuario es permitido para editar un envío (tanto desde el portal como desde el panel de administración) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Diario');
define('_ACA_AUTO_DAY_CH2', 'Diario menos en fin de semana');
define('_ACA_AUTO_DAY_CH3', 'Cualquier otro día');
define('_ACA_AUTO_DAY_CH4', 'Cualquier otro día menos en fin de semana');
define('_ACA_AUTO_DAY_CH5', 'Semanal');
define('_ACA_AUTO_DAY_CH6', 'Cada 2 semanas');
define('_ACA_AUTO_DAY_CH7', 'Mensual');
define('_ACA_AUTO_DAY_CH9', 'Anual');
define('_ACA_AUTO_OPTION_NONE', 'No');
define('_ACA_AUTO_OPTION_NEW', 'Nuevos usuarios');
define('_ACA_AUTO_OPTION_ALL', 'Todos los usuarios');

//
define('_ACA_UNSUB_MESSAGE', 'Correo de de-suscripción');
define('_ACA_UNSUB_SETTINGS', 'Ajustes de de-suscripción');
define('_ACA_AUTO_ADD_NEW_USERS', '¿Auto suscribir usuarios?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'No hay actualizaciones disponibles.');
define('_ACA_VERSION', 'Versión de Acajoom');
define('_ACA_NEED_UPDATED', 'Archivos que necesitan ser actualizados:');
define('_ACA_NEED_ADDED', 'Archivos que necesitan ser añadidos:');
define('_ACA_NEED_REMOVED', 'Archivos que necesitan ser eliminados:');
define('_ACA_FILENAME', 'Nombre de archivo:');
define('_ACA_CURRENT_VERSION', 'Versión actual:');
define('_ACA_NEWEST_VERSION', 'Última Versión:');
define('_ACA_UPDATING', 'Actualizando');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Los archivos han sido actualizados con éxito.');
define('_ACA_UPDATE_FAILED', '¡Actualización fallida!');
define('_ACA_ADDING', 'Añadiendo');
define('_ACA_ADDED_SUCCESSFULLY', 'Añadido con éxito.');
define('_ACA_ADDING_FAILED', '¡Fallo al añadir!');
define('_ACA_REMOVING', 'Eliminando');
define('_ACA_REMOVED_SUCCESSFULLY', 'Eliminado con éxito.');
define('_ACA_REMOVING_FAILED', '¡Falló la eliminación!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Instale una versión diferente');
define('_ACA_CONTENT_ADD', 'Añadir contenido');
define('_ACA_UPGRADE_FROM', 'Importar datos (información de boletines y suscriptores) de ');
define('_ACA_UPGRADE_MESS', 'No hay riesgo para la información existente. <br /> Este proceso sólo importará la información a la base de datos de Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Continúe el envío');

// Acajoom message
define('_ACA_UPGRADE1', 'Puede fácilmente importar sus usuarios y boletines desde ');
define('_ACA_UPGRADE2', ' hacia Acajoom en el panel de actualizaciones.');
define('_ACA_UPDATE_MESSAGE', '¡Una nueva versión de Acajoom está disponible! ');
define('_ACA_UPDATE_MESSAGE_LINK', '¡Seleccione para actualizar!');
define('_ACA_CRON_SETUP', 'Para que las auto-respuestas puedan ser enviadas debe configurar una tarea Cron.');
define('_ACA_THANKYOU', 'Gracias por escoger Acajoom, ¡Su asistente de comunicaciones!');
define('_ACA_NO_SERVER', 'Servidor de actualizaciones no disponible, por favor inténtelo más tarde.');
define('_ACA_MOD_PUB', 'El módulo de Acajoom no está publicado.');
define('_ACA_MOD_PUB_LINK', '¡Presione aquí para publicarlo!');
define('_ACA_IMPORT_SUCCESS', 'Importado con éxito');
define('_ACA_IMPORT_EXIST', 'Suscriptor ya registrado en la base de datos');

// Acajoom\'s Guide
define('_ACA_GUIDE', ' Asistente');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>¡Acajoom cuenta con grandes funcionalidades y este asistente lo guiará en un simple proceso de cuatro pasos para que pueda empezar a enviar sus boletines y auto-respuestas!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Primero: usted necesita añadir una lista.  Una lista puede ser de dos tipos: boletín o auto-respuesta.' .
		'  En la lista usted define todos los parámetros para hacer posible el envío de sus boletínes o auto-respuestas: nombre del remitente, diseño, mensaje de bienvenida a los suscriptores, etc...
<br /><br />Usted puede crear su primera lista aquí: <a href="index2.php?option=com_acajoom&act=list" >crear una lista</a> y seleccionar el botón "Nuevo".');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom le brinda la facilidad de importar toda la información de sistemas de boletines anteriores.<br />' .
		' Vaya al panel de actualizaciones y escoja su antiguo sistema de boletines para importar los datos completos de usuarios y contenidos.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: La importación esta libre de riesgos y no afectará de ninguna manera la información de su anterior sistema</span><br />' .
		'Luego de la importación usted podrá manejar sus suscriptores y envíos directamente en Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', '¡Felicitaciones su primera lista ha sido creada!  Ahora podrá usted escribir su primer %s.  Para crearlo vaya a: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Manejador de Auto-respuestas');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Manejador de boletines');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' y seleccione su %s. <br /> Luego seleccione su %s en la lista desplegable.  Cree su primer envío seleccionando "Nuevo"');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Antes de enviar su primer boletín puede necesitar revisar la configuración de correo.  ' .
		'Vaya a la <a href="index2.php?option=com_acajoom&act=configuration" >página de configuraciones</a> para verificar sus parámetros de correo. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Cuando este listo regrese al menú de boletines seleccione su envío y presione enviar');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Para que su auto-respuesta sea enviada primero debe configurar una tarea Cron en su servidor. ' .
		' Por favor refiérase al tabulador Cron en el panel de configuración.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >presione aquí</a> para aprender acerca de configaciones de tareas Cron. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Asegúrese de haber publicado su módulo de Acajoom para que las personas puedan registrarse en sus listas.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Ahora también puede configurar auto-respuestas.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Ahora también puede configurar un boletín.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />¡Voila! Está listo para comunicarse efectivamente con sus usuarios. Este asistente terminará tan pronto como usted haya ingresado un segundo envío o lo haya desactivado en el <a href="index2.php?option=com_acajoom&act=configuration" >panel de control</a>.' .
		'<br /><br />  Si tuviera alguna consulta acerca de del uso de Acajoom, por favor refiérase a este ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >foro</a>. ' .
		' Usted podrá encontrar gran cantidad de información acerca de cómo comunicarse efectivamente con sus suscriptores en <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Gracias por usar Acajoom. ¡Su asistente de comunicaciones!</b> ');
define('_ACA_GUIDE_TURNOFF', 'El asistente ha sido desactivado!');
define('_ACA_STEP', 'PASO ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Configuración Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Instalado con éxito');
define('_ACA_INSTALL_ERROR', '¡Error en la instalación');
define('_ACA_INSTALL_BOT', 'Plugin Acajoom (Bot)');
define('_ACA_INSTALL_MODULE', 'Módulo Acajoom');
//Others
define('_ACA_JAVASCRIPT','!Advertencia! Javascript debe estar habilitado para permitir una correcta operación.');
define('_ACA_EXPORT_TEXT','La exportación de suscriptores estará basada en la lista que usted escoja. <br />Exportar suscriptores a lista');
define('_ACA_IMPORT_TIPS','Importar suscriptores. La información en el archivo necesita tener el siguiente formato: <br />' .
		'Nombre,correo,recibeHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmado(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'es ya un suscriptor');
define('_ACA_GET_STARTED', '¡Presione aquí para iniciar!');

//News since 1.0.1
define('_ACA_WARNING_1011','Advertencia: 1011: La actualización no funcionará por restricciones de su servidor.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Elija la dirección de correo que mostrará el remitente.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Elija el nombre que mostrará el remitente.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Elija el mensajero que desea usar: función de correo PHP, <span>Sendmail</span> o servidor SMTP.');
define('_ACA_SENDMAILPATH_TIPS', 'Este es el directorio del servidor de correo');
define('_ACA_LIST_T_TEMPLATE', 'Plantilla');
define('_ACA_NO_MAILING_ENTERED', 'No se ha provisto envío');
define('_ACA_NO_LIST_ENTERED', 'No se ha provisto lista');
define('_ACA_SENT_MAILING' , 'Envíos completados');
define('_ACA_SELECT_FILE', 'Por favor seleccione un archivo para ');
define('_ACA_LIST_IMPORT', 'Revise la lista(s) a las cuales desea que sean asociados sus suscriptores.');
define('_ACA_PB_QUEUE', 'Suscriptor insertado pero presenta problemas al conectarlo/la a la lista(s). Por favor revise manualmente.');
define('_ACA_UPDATE_MESS1' , '¡Actualización áltamente recomendada!');
define('_ACA_UPDATE_MESS2' , 'Parches y pequeñas reparaciones.');
define('_ACA_UPDATE_MESS3' , 'Nueva entrega.');
define('_ACA_UPDATE_MESS5' , 'Es requerido Joomla 1.5 para actualizar.');
define('_ACA_UPDATE_IS_AVAIL' , ' está disponible!');
define('_ACA_NO_MAILING_SENT', '¡No se procesó envío!');
define('_ACA_SHOW_LOGIN', 'Mostrar formulario de ingreso');
define('_ACA_SHOW_LOGIN_TIPS', 'Seleccione SI para mostrar el formulario de ingreso en el panel de control de Acajoom del portal web a fin que los usuarios se registren.');
define('_ACA_LISTS_EDITOR', 'Editor de descripción de lista');
define('_ACA_LISTS_EDITOR_TIPS', 'Seleccione SI para usar un editor HTML a fin de modificar el campo descriptivo de la lista.');
define('_ACA_SUBCRIBERS_VIEW', 'Ver suscriptores');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Configuración en portal web' );
define('_ACA_SHOW_LOGOUT', 'Mostrar botón de salida');
define('_ACA_SHOW_LOGOUT_TIPS', 'Seleccione SI a fin de mostrar el botón de salida en el panel de control de Acajoom en el portal web.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integración');
define('_ACA_CB_INTEGRATION', 'Integración con Community Builder');
define('_ACA_INSTALL_PLUGIN', 'Plugin de Community Builder Plugin (Integración con Acajoom) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', '¡El plugin Acajoom para Community Builder no ha sido instalado!');
define('_ACA_CB_PLUGIN', 'Listas al registrarse');
define('_ACA_CB_PLUGIN_TIPS', 'Seleccione SI a fin de mostrar las listas de correo al momento de registrarse con el formulario de Community Builder');
define('_ACA_CB_LISTS', 'IDs de listas');
define('_ACA_CB_LISTS_TIPS', 'ESTE ES UN CAMPO REQUERIDO. Ingrese el número identificador de las listas a las cuales desea que sus usuarios tengan acceso de suscripción separadas por comas (0 mostrará todas las listas)');
define('_ACA_CB_INTRO', 'Texto introductorio');
define('_ACA_CB_INTRO_TIPS', 'Texto que aparecerá antes de las listas. DÉJELO EN BLANCO PARA NO MOSTRAR NADA.  Usted puede usar etiquetas HTML para dar efectos visuales.');
define('_ACA_CB_SHOW_NAME', 'Mostrar nombres de listas');
define('_ACA_CB_SHOW_NAME_TIPS', 'Seleciónelo en el caso que desee o no mostrar el nombre de la lista luego de la introducción.');
define('_ACA_CB_LIST_DEFAULT', 'Activar listas por defecto');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Seleciónelo en el caso que desee o no mostrar activada la casilla de verificación por defecto.');
define('_ACA_CB_HTML_SHOW', 'Mostrar aceptación de HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Seleccione SI para permitir a los usuarios la selección de correos con formato HTML. Seleccione NO para definir HTML por defecto.');
define('_ACA_CB_HTML_DEFAULT', 'Recibir HTML por defecto');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Configure esta opción para mostrar que los correos serán enviados en html por defecto. En el caso que "mostrar recepción como HTML" esté configurado en NO entonces esta será la opción por defecto.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', '¡No pudo realizarse la copia de seguridad del archivo! El archivo no fue reemplazado.');
define('_ACA_BACKUP_YOUR_FILES', 'La versión antigua de los archivos ha sido guardada en el siguiente directorio:');
define('_ACA_SERVER_LOCAL_TIME', 'Hora local del servidor');
define('_ACA_SHOW_ARCHIVE', 'Mostrar botón de Archivo');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Seleccione SI a fin de mostrar el botón de archivo en la sección de la lista ubicada en el portal web');
define('_ACA_LIST_OPT_TAG', 'Etiquetas');
define('_ACA_LIST_OPT_IMG', 'Imágenes');
define('_ACA_LIST_OPT_CTT', 'Contenido');
define('_ACA_INPUT_NAME_TIPS', 'Ingrese su nombre completo (nombre de pila al inicio)');
define('_ACA_INPUT_EMAIL_TIPS', 'ingrese su correo electrónico (asegúrese que es una dirección válida si desea recibir nuestros envíos.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Seleccione SI a fin de recibir envíos HTML - Seleccione NO para recibir los envíos en texto llano');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Especifique su zona horaria.');

// Since 1.0.5
define('_ACA_FILES' , 'Archivos');
define('_ACA_FILES_UPLOAD' , 'Cargar');
define('_ACA_MENU_UPLOAD_IMG' , 'Cargar imágenes');
define('_ACA_TOO_LARGE' , 'Archivo demasiado grande. El máximo tamaño permitido es');
define('_ACA_MISSING_DIR' , 'El directorio de destino no existe');
define('_ACA_IS_NOT_DIR' , 'El directorio de destino no existe o es un archivo regular.');
define('_ACA_NO_WRITE_PERMS' , 'El directorio de destino no tiene permisos de escritura.');
define('_ACA_NO_USER_FILE' , 'No ha seleccionado ningún archivo para cargar.');
define('_ACA_E_FAIL_MOVE' , 'Imposible mover el archivo.');
define('_ACA_FILE_EXISTS' , 'El archivo de destino ya existe.');
define('_ACA_CANNOT_OVERWRITE' , 'El archivo de destino ya existe y no puede ser sobreescrito.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'La extensión del archivo no está permitida.');
define('_ACA_PARTIAL' , 'El archivo fue parcialmente cargado.');
define('_ACA_UPLOAD_ERROR' , 'Error de carga:');
define('DEV_NO_DEF_FILE' , 'El archivo fue parcialmente cargado.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Este campo será reemplazado con el enlace de suscripción.' .
		' Esto es <strong>requerido</strong> para que Acajoom trabaje correctamente.<br />' .
		'Si usted coloca cualquier otro contenido en esta area, el mismo será mostrado en todos los envíos correspondientes a esta lista.' .
		' <br />Añada su mensaje de suscripción al final.  Acajoom añadirá automáticamente un enlace para que el suscriptor cambie su información y otro enlace para de-suscribirse de la lista.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notificación');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notificaciones');
define('_ACA_USE_SEF', 'SEF en envíos');
define('_ACA_USE_SEF_TIPS', 'Es recomendable que usted elija NO.  Sin embargo si usted desea que las URL incluídas en su envío usen SEF seleccione SI.' .
		' <br /><b>Los enlaces trabajarán en cualquira de las opciones.  No podemos asegurar que los enlaces trabajarán siempre si usted cambia su SEF.</b> ');
define('_ACA_ERR_NB' , 'Error #: ERR');
define('_ACA_ERR_SETTINGS', 'Error manejando la configuración');
define('_ACA_ERR_SEND' ,'Enviar reportes de error');
define('_ACA_ERR_SEND_TIPS' ,'Si usted desea que Acajoom sea un mejor producto por favor seleccione SI.  Esto permitirá que nos envíe un reporte de error. Sin embargo usted no necesitará enviar nunca más reportes de errores ;-) <br /> <b>NINGUNA INFORMACIÓN PRIVADA ES ENVIADA</b>.  Nunca sabremos de que portal web proviene el error. Nosotros sólo enviamos información sobre Acajoom, la configuración PHP y las consultas SQL. ');
define('_ACA_ERR_SHOW_TIPS' ,'Seleccione SI para mostrar el número de error en su pantalla.  Principalmente usado para correción de fallas. ');
define('_ACA_ERR_SHOW' ,'Mostrar errores');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Mostrar enlaces de de-suscripción');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Seleccione SI para mostrar los enlaces de de-suscripción al final de los envíos para que los usuarios puedan cambiar sus suscripciones. <br /> No desactive el pie de página y los vínculos.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">¡NOTICIA IMPORTANTE!</span> <br />Si usted está actualizando de una versión previamente instalada de Acajoom, necesitará actualizar la estructura de su base de datos presionando el siguiente botón (Su información se mantendrá íntegra)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Actualizar tablas y configuración');
define('_ACA_MAILING_MAX_TIME', 'Máximo tiempo de espera' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Defina el máximo periodo de tiempo para cada grupo de correos enviados por el proceso. Se recomienda que sea entre 30s y 2mins.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'Integración con VirtueMart');
define('_ACA_VM_COUPON_NOTIF', 'ID de notificación de cupón');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Especifique el número de ID del envío que usted desea usar para remitir cupones a sus compradores.');
define('_ACA_VM_NEW_PRODUCT', 'ID de Notificación de nuevos productos');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Especifique el número de ID del envío que usted desea usar para notificar la existencia de nuevos productos.');

// since 1.0.8
// create forms for Suscripcións
define('_ACA_FORM_BUTTON', 'Crear formulario');
define('_ACA_FORM_COPY', 'Código HTML');
define('_ACA_FORM_COPY_TIPS', 'Copie el código HTML generado en su página HTML.');
define('_ACA_FORM_LIST_TIPS', 'Seleccione la lista que desea incluir en el formulario');
// update messages
define('_ACA_UPDATE_MESS4' , 'No puede ser actualizado automáticamente.');
define('_ACA_WARNG_REMOTE_FILE' , 'No hay forma de recuperar el archivo remoto.');
define('_ACA_ERROR_FETCH' , 'Error recuperando archivo.');

define('_ACA_CHECK' , 'Revisar');
define('_ACA_MORE_INFO' , 'Más información');
define('_ACA_UPDATE_NEW' , 'Actualizar a nueva versión');
define('_ACA_UPGRADE' , 'Actualizar a un producto mayor');
define('_ACA_DOWNDATE' , 'Regresar a la versión previa');
define('_ACA_DOWNGRADE' , 'Regresar al producto básico');
define('_ACA_REQUIRE_JOOM' , 'Requiere Joomla');
define('_ACA_TRY_IT' , '¡Puébelo!');
define('_ACA_NEWER', 'Nuevo');
define('_ACA_OLDER', 'Antiguo');
define('_ACA_CURRENT', 'Actual');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Pruebe uno de los otros componentes');
define('_ACA_MENU_VIDEO' , 'Video tutoriales');
define('_ACA_AUTO_SCHEDULE', 'Programación');
define('_ACA_SCHEDULE_TITLE', 'Configuración de la función de programación automática');
define('_ACA_ISSUE_NB_TIPS' , 'Número de publicación generado automáticamente por el sistema' );
define('_ACA_SEL_ALL' , 'Todos los envíos');
define('_ACA_SEL_ALL_SUB' , 'Todas las listas');
define('_ACA_INTRO_ONLY_TIPS' , 'Si usted selecciona esta opción, sólo la introducción del artículo será insertada en el envío junto con un enlace de "leer más" que lo dirigirpa hacia el artículo completo en el portal web.' );
define('_ACA_TAGS_TITLE' , 'Etiqueta de contenido');
define('_ACA_TAGS_TITLE_TIPS' , 'Copie y pegue esta etiqueta dentro del envío en el cual desea que el contenido sea colocado.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Indique la dirección a la cual se enviará el correo de prueba.');
define('_ACA_PREVIEW_TITLE' , 'Vista previa');
define('_ACA_AUTO_UPDATE' , 'Notificación de nuevas actualizaciones');
define('_ACA_AUTO_UPDATE_TIPS' , 'Seleccione SI en el caso que desee ser notificado de nuevas actualizaciones para su componente. <br />¡IMPORTANTE!! Mostar consejos necesita estar activado para que esta función trabaje correctamente.');

// since 1.1.0
define('_ACA_LICENSE' , 'Información de Licencia');


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
define('_ACA_REGWARN_NAME','Escriba su nombre.');
define('_ACA_REGWARN_MAIL','Escriba su e-mail.');

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
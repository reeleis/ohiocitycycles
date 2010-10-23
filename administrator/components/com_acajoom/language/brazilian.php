<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
 * <p>Potuguese language.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author  Ricardo Simões <support@acajoom.com>
 * @version $Id: portuguese.php 442 2007-01-07 11:52:33Z divivo $
* @link http://www.joobisoft.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom é uma ferramenta de listas de mailing, newsletters, auto-respostas, e seguimento, para comunicação eficaz com os seus utilizadores e clientes. ' .
		'Acajoom, O Seu Parceiro De Comunicação!');
define('_ACA_FEATURES', 'Acajoom, o seu parceiro de comunicação!');

// Type of lists
define('_ACA_NEWSLETTER', 'Newsletter');
define('_ACA_AUTORESP', 'Auto-resposta');
define('_ACA_AUTORSS', 'Auto-RSS');
define('_ACA_ECARD', 'Cartão Electrónico');
define('_ACA_POSTCARD', 'Cartão Postal');
define('_ACA_PERF', 'Performance');
define('_ACA_COUPON', 'Cupão');
define('_ACA_CRON', 'Tarefa Cron');
define('_ACA_MAILING', 'Mailing');
define('_ACA_LIST', 'Lista');

 //acajoom Menu
define('_ACA_MENU_LIST', 'Gestão de Listas');
define('_ACA_MENU_SUBSCRIBERS', 'Assinantes');
define('_ACA_MENU_NEWSLETTERS', 'Newsletters');
define('_ACA_MENU_AUTOS', 'Auto-Respostas');
define('_ACA_MENU_COUPONS', 'Cupões');
define('_ACA_MENU_CRONS', 'Tarefas Cron');
define('_ACA_MENU_AUTORSS', 'Auto-RSS');
define('_ACA_MENU_ECARD', 'Cartões Electrónicos');
define('_ACA_MENU_POSTCARDS', 'Cartões Postais');
define('_ACA_MENU_PERFS', 'Performances');
define('_ACA_MENU_TAB_LIST', 'Listas');
define('_ACA_MENU_MAILING_TITLE', 'Mailings');
define('_ACA_MENU_MAILING' , 'Mailings para ');
define('_ACA_MENU_STATS', 'Estatísticas');
define('_ACA_MENU_STATS_FOR', 'Estatísticas para ');
define('_ACA_MENU_CONF', 'Configuração');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'Sobre');
define('_ACA_MENU_LEARN', 'Centro de Educação');
define('_ACA_MENU_MEDIA', 'Gestão de Media');
define('_ACA_MENU_HELP', 'Ajuda');
define('_ACA_MENU_CPANEL', 'Painel de Controlo');
define('_ACA_MENU_IMPORT', 'Importar');
define('_ACA_MENU_EXPORT', 'Exportar');
define('_ACA_MENU_SUB_ALL', 'Subcrever Tudo');
define('_ACA_MENU_UNSUB_ALL', 'Não-Subscrever Tudo');
define('_ACA_MENU_VIEW_ARCHIVE', 'Arquivo');
define('_ACA_MENU_PREVIEW', 'Pré-visualizar');
define('_ACA_MENU_SEND', 'Enviar');
define('_ACA_MENU_SEND_TEST', 'Enviar Email de Teste');
define('_ACA_MENU_SEND_QUEUE', 'Fila de Processamento');
define('_ACA_MENU_VIEW', 'Ver');
define('_ACA_MENU_COPY', 'Copiar');
define('_ACA_MENU_VIEW_STATS' , 'Ver Estado');
define('_ACA_MENU_CRTL_PANEL' , ' Painel De Controlo');
define('_ACA_MENU_LIST_NEW' , ' Criar Lista');
define('_ACA_MENU_LIST_EDIT' , ' Editar Lista');
define('_ACA_MENU_BACK', 'Retroceder');
define('_ACA_MENU_INSTALL', 'Instalar');
define('_ACA_MENU_TAB_SUM', 'Sumário');
define('_ACA_STATUS' , 'Estado');

// messages
define('_ACA_ERROR' , ' Ocorreu um erro! ');
define('_ACA_SUB_ACCESS' , 'Direitos de Acesso');
define('_ACA_DESC_CREDITS', 'Créditos');
define('_ACA_DESC_INFO', 'Informação');
define('_ACA_DESC_HOME', 'Página Oficial');
define('_ACA_DESC_MAILING', 'Lista de Mailing');
define('_ACA_DESC_SUBSCRIBERS', 'Assinantes');
define('_ACA_PUBLISHED','Publicado');
define('_ACA_UNPUBLISHED','Não-Publicado');
define('_ACA_DELETE','Apagar');
define('_ACA_FILTER','Filtrar');
define('_ACA_UPDATE','Actualizar');
define('_ACA_SAVE','Salvar');
define('_ACA_CANCEL','Cancelar');
define('_ACA_NAME','Nome');
define('_ACA_EMAIL','E-mail');
define('_ACA_SELECT','Selecionar');
define('_ACA_ALL','Todas as');
define('_ACA_SEND_A', 'Enviar a ');
define('_ACA_SUCCESS_DELETED', ' apagado com sucesso');
define('_ACA_LIST_ADDED', 'Lista criada com sucesso');
define('_ACA_LIST_COPY', 'Lista copiada com sucesso');
define('_ACA_LIST_UPDATED', 'Lista actualizada com sucesso');
define('_ACA_MAILING_SAVED', 'Mailing salvado com sucesso.');
define('_ACA_UPDATED_SUCCESSFULLY', 'actualizado com sucesso.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', 'Informação do Assinante');
define('_ACA_VERIFY_INFO', 'Por favor verifique o link que submeteu, falta alguma informação.');
define('_ACA_INPUT_NAME', 'Nome');
define('_ACA_INPUT_EMAIL', 'Email');
define('_ACA_RECEIVE_HTML', 'Receber em HTML?');
define('_ACA_TIME_ZONE', 'Zona de Fuso Horário');
define('_ACA_BLACK_LIST', 'Lista Negra');
define('_ACA_REGISTRATION_DATE', 'Data de registo do utilizador');
define('_ACA_USER_ID', 'ID do Utilizador');
define('_ACA_DESCRIPTION', 'Descrição');
define('_ACA_ACCOUNT_CONFIRMED', 'A sua conta foi activada.');
define('_ACA_SUB_SUBSCRIBER', 'Assinante');
define('_ACA_SUB_PUBLISHER', 'Editor');
define('_ACA_SUB_ADMIN', 'Administrador');
define('_ACA_REGISTERED', 'Registado');
define('_ACA_SUBSCRIPTIONS', 'Subscrições');
define('_ACA_SEND_UNSUBCRIBE', 'Enviar mensagem de Cancelamento de subscrição');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Clique SIM para enviar um email de confirmação para cancelamento de subscrição.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Por favor confirme a sua subscrição');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Confirmação de Cancelamento de Subscrição');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Olá [NAME],<br />' .
		'Apenas mais um passo e subscreverá a lista.  Por favor clique no link seguinte para confirmar a sua subscrição.' .
		'<br /><br />[CONFIRM]<br /><br />Para questões é favor contactar o Webmaster.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Este é um email de confirmação de que você foi removido da nossa lista.  Lamentamos que tenha decidido cancelar a sua subscrição, caso queira voltar a subscrever pode sempre fazê-lo no nosso site.  Caso tenha alguma questão por favor contacte o nosso Webmaster.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', 'Data de Subscrição');
define('_ACA_CONFIRMED', 'Confirmado');
define('_ACA_SUBSCRIB', 'Subscrever');
define('_ACA_HTML', 'Mailings em HTML');
define('_ACA_RESULTS', 'Resultados');
define('_ACA_SEL_LIST', 'Selecione uma Lista');
define('_ACA_SEL_LIST_TYPE', '- Selecione tipo de Lista -');
define('_ACA_SUSCRIB_LIST', 'Lista Total de Assinantes');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'assinantes para : ');
define('_ACA_NO_SUSCRIBERS', 'Nenhum assinante encontrado para estas listas.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Foi enviado um email de confirmação para si.  Por favor verifique o seu email e clique no link fornecido.<br />' .
		'O seu email necessita de ser confirmado para que a sua subscrição possa ter efeito.');
define('_ACA_SUCCESS_ADD_LIST', 'Você foi adicionado a lista com sucesso.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Clique aqui para confirmar a sua subscrição');
define('_ACA_UNSUBSCRIBE_LINK', 'Clique aqui para remover-se da lista');
define('_ACA_UNSUBSCRIBE_MESS', 'O seu email foi removido da lista');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Todos os mailings agendados foram enviados com sucesso.');
define('_ACA_MALING_VIEW', 'Ver todos os mailings');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Tem a certeza que quer remover-se da lista?');
define('_ACA_MOD_SUBSCRIBE', 'Subscrever');
define('_ACA_SUBSCRIBE', 'Subscrever');
define('_ACA_UNSUBSCRIBE', 'Des-Subscrever');
define('_ACA_VIEW_ARCHIVE', 'Ver arquivo');
define('_ACA_SUBSCRIPTION_OR', ' ou clique aqui para actualizar a sua informação');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Este endereço de email já se encontra registado.');
define('_ACA_SUBSCRIBER_DELETED', 'Assinante apagado com sucesso.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', 'Painel de Controlo do Utilizador');
define('_UCP_USER_MENU', 'Menu do Utilizador');
define('_UCP_USER_CONTACT', 'As minhas subscrições');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', 'Gestão de tarefa Cron');
define('_UCP_CRON_NEW_MENU', 'Novo Cron');
define('_UCP_CRON_LIST_MENU', 'Listar o meu Cron');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', 'Gestão de Cupões');
define('_UCP_COUPON_LIST_MENU', 'Lista de Cupões');
define('_UCP_COUPON_ADD_MENU', 'Adicionar um Cupão');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', 'Descrição');
define('_ACA_LIST_T_LAYOUT', 'Layout');
define('_ACA_LIST_T_SUBSCRIPTION', 'Subscrição');
define('_ACA_LIST_T_SENDER', 'Informação do Remetente');

define('_ACA_LIST_TYPE', 'Tipo de Lista');
define('_ACA_LIST_NAME', 'Nome da Lista');
define('_ACA_LIST_ISSUE', 'Edição N #');
define('_ACA_LIST_DATE', 'Data de Envio');
define('_ACA_LIST_SUB', 'Assunto do Mailing');
define('_ACA_ATTACHED_FILES', 'Ficheiros Anexados');
define('_ACA_SELECT_LIST', 'Por favor selecione uma lista para editar!');

// Auto Responder box
define('_ACA_AUTORESP_ON', 'Tipo de Lista');
define('_ACA_AUTO_RESP_OPTION', 'Opções de Auto-resposta');
define('_ACA_AUTO_RESP_FREQ', 'Assinantes podem escolher frequência');
define('_ACA_AUTO_DELAY', 'Atraso (em dias)');
define('_ACA_AUTO_DAY_MIN', 'Frequência Mínima');
define('_ACA_AUTO_DAY_MAX', 'Frequência Máxima');
define('_ACA_FOLLOW_UP', 'Especificar seguimento de auto-resposta');
define('_ACA_AUTO_RESP_TIME', 'Assinantes podem escolher hora');
define('_ACA_LIST_SENDER', 'Remetente da Lista');

define('_ACA_LIST_DESC', 'Descrição da Lista');
define('_ACA_LAYOUT', 'Layout');
define('_ACA_SENDER_NAME', 'Nome do Remetente');
define('_ACA_SENDER_EMAIL', 'Email do Remetente');
define('_ACA_SENDER_BOUNCE', 'Endereço de bounce do Remetente');
define('_ACA_LIST_DELAY', 'Atraso');
define('_ACA_HTML_MAILING', 'Mailing em HTML?');
define('_ACA_HTML_MAILING_DESC', '(se modificar isto, você terá de salvar e retornar a este ecran para visualizar as mudanças.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Esconder do Sítio-Principal?');
define('_ACA_SELECT_IMPORT_FILE', 'Selecione um ficheiro para importação');;
define('_ACA_IMPORT_FINISHED', 'Importação terminada');
define('_ACA_DELETION_OFFILE', 'Eliminação do ficheiro');
define('_ACA_MANUALLY_DELETE', 'falhou, deverá apagar o ficheiro manualmente');
define('_ACA_CANNOT_WRITE_DIR', 'Não é possível escrever na directoria');
define('_ACA_NOT_PUBLISHED', 'Não foi possível enviar o mailing, a Lista não está publicada.');

//  List info box
define('_ACA_INFO_LIST_PUB', 'Clique em SIM para publicar a Lista');
define('_ACA_INFO_LIST_NAME', 'Introduza o nome da sua Lista aqui. Poderá identificar a Lista com este nome.');
define('_ACA_INFO_LIST_DESC', 'Introduza uma breve descrição da sua Lista aqui. Esta descrição será visível aos visitantes no seu site.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Introduza o nome do Remetente do mailing. Este nome será visível quando os assinantes receberem mensagens desta lista.');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Introduza o endereço de email de onde as mensagens serão enviadas.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Introduza o endereço de email para onde os utilizadores poderão responder. É altamente recomendado que seja igual ao do remetente, visto que existem filtros de SPAM que poderão atribuir uma probabilidade de SPAM elevada se forem diferentes.');
define('_ACA_INFO_LIST_AUTORESP', 'Escolha o tipo de mailings para esta Lista. <br />' .
		'Newsletter: newsletter normal<br />' .
		'Auto-resposta: uma Auto-resposta é uma Lista que é enviada automaticamente através da página web em intervalos regulares.');
define('_ACA_INFO_LIST_FREQUENCY', 'Permitir aos utilizadores escolher quantas vezes recebem a Lista.  Atribui mais flexibilidade ao utilizador.');
define('_ACA_INFO_LIST_TIME', 'Deixar que o utilizador escolha a hora preferida do dia para receber a Lista.');
define('_ACA_INFO_LIST_MIN_DAY', 'Definir qual é a frequência mínima que o utilizador pode escolher para receber a lista');
define('_ACA_INFO_LIST_DELAY', 'Especificar qual o atraso entre esta auto-resposta e a anterior.');
define('_ACA_INFO_LIST_DATE', 'Especificar a data para publicação da lista de notícias, caso queira atrasar a publicação. <br /> FORMATO : AAAA-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Definir qual é a frequência máxima que o utilizador pode escolher para receber a lista');
define('_ACA_INFO_LIST_LAYOUT', 'Introduza o layout da sua lista de mailing aqui. Pode introduzir qualquer layou para o seu mailing aqui.');
define('_ACA_INFO_LIST_SUB_MESS', 'Esta mensagem será enviada ao assinante quando ele ou ela se registam pela primeira vez. Pode definir aqui qualquer texto que goste.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Esta mensagem será enviada ao assinante quando ele ou ela cancelarem a subscrição. Pode inserir aqui qualquer mensagem.');
define('_ACA_INFO_LIST_HTML', 'Selecione a checkbox se desejar enviar mailing em HTML. Os assinantes poderão especificar se preferem receber mensagens em HTML, ou mensagens de apenas texto aquando da subscrição de uma lista HTML.');
define('_ACA_INFO_LIST_HIDDEN', 'Clique SIM para esconder a lista do sítio-principal, os utilizadores não poderão subscrever mas você poderá mesmo assim enviar mailings.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Deseja subscrição automática dos utilizadores para esta lista?<br /><B>Novos Utilizadores:</B> registará cada novo utilizador que se registe no site.<br /><B>Todos os Utilizadores:</B> registará cada utilizador registado na base de dados.<br />(todas aquelas opções suportam Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Selecione o nível de acesso do sítio-principal. Isto mostrará ou esconderá o mailing para os grupos de utilizadores que não têm acesso a ele, para que não sejam capazes do o subscrever.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Selecione o nível de acesso do grupo de utilizadores a quem permite edição. Esse grupo de utilizadores e superiores serão capazes de editar o mailing e enviá-lo, quer do sítio-principal quer do sítio de administração.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Se quiser que a auto-resposta mova-se para outra assim que atingir a última mensagem, pode especificar aqui a auto-resposta seguinte.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Esta é a ID da pessoa que criou a lista.');
define('_ACA_INFO_LIST_WARNING', '   Esta última opção apenas está disponível uma vez aquando da criação da lista.');
define('_ACA_INFO_LIST_SUBJET', ' Assunto do mailing.  Este é o assunto do email que o assinante receberá.');
define('_ACA_INFO_MAILING_CONTENT', 'Este é o corpo do email que você quer enviar.');
define('_ACA_INFO_MAILING_NOHTML', 'Introduza o corpo do email que você quer enviar para os assinantes que escolheram receber apenas mailings NÃO-HTML. <BR/> NOTA: se deixar em branco o Acajoom converterá automaticamente o texto HTML para apenas texto.');
define('_ACA_INFO_MAILING_VISIBLE', 'Clique SIM para mostrar mailing no sítio-principal.');
define('_ACA_INSERT_CONTENT', 'Insira o conteúdo existente');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', 'Cupão enviado com sucesso!');
define('_ACA_CHOOSE_COUPON', 'Escolha um cupão');
define('_ACA_TO_USER', ' para este utilizador');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', 'Cada hora');
define('_ACA_FREQ_CH2', 'Cada 6 horas');
define('_ACA_FREQ_CH3', 'Cada 12 horas');
define('_ACA_FREQ_CH4', 'Diariamente');
define('_ACA_FREQ_CH5', 'Semanalmente');
define('_ACA_FREQ_CH6', 'Mensalmente');
define('_ACA_FREQ_NONE', 'Não');
define('_ACA_FREQ_NEW', 'Novos utilizadores');
define('_ACA_FREQ_ALL', 'Todos os utilizadores');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Cron Acajoom?');
define('_ACA_LABEL_FREQ_TIPS', 'Clique em SIM se quiser utilizar isto para uma Cron Acajoom, NÃO para qualquer outra tarefa Cron.<br />' .
		'Se clicar em SIM não necessita de especificar o endereço do Cron, este será automaticamente adicionado.');
define('_ACA_SITE_URL' , 'O endereço URL do seu site');
define('_ACA_CRON_FREQUENCY' , 'Frequência do Cron');
define('_ACA_STARTDATE_FREQ' , 'Data de Começo');
define('_ACA_LABELDATE_FREQ' , 'Especifique Data');
define('_ACA_LABELTIME_FREQ' , 'Especifique Hora');
define('_ACA_CRON_URL', 'URL do Cron');
define('_ACA_CRON_FREQ', 'Frequência');
define('_ACA_TITLE_CRONLIST', 'Lista Cron');
define('_NEW_LIST', 'Criar uma nova lista');

//title CRON form
define('_ACA_TITLE_FREQ', 'Editar Cron');
define('_ACA_CRON_SITE_URL', 'Por favor introduza um endereço URL válido, começado por http://');

### Mailings ###
define('_ACA_MAILING_ALL', 'Todos os mailings');
define('_ACA_EDIT_A', 'Editar um ');
define('_ACA_SELCT_MAILING', 'Por favor selecione a Lista na caixa de possibilidades com vista a adicionar um novo mailing.');
define('_ACA_VISIBLE_FRONT', 'Visível no sítio-principal');

// mailer
define('_ACA_SUBJECT', 'Assunto');
define('_ACA_CONTENT', 'Conteúdo');
define('_ACA_NAMEREP', '[NAME] = Isto será substituído pelo nome que o assinante introduziu, você estará a enviar emails personalizados ao usar isto.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Isto será substituído pelo PRIMEIRO nome que o assinante introduziu.<br />');
define('_ACA_NONHTML', 'Versão Não-html');
define('_ACA_ATTACHMENTS', 'Anexos');
define('_ACA_SELECT_MULTIPLE', 'Carregue na tecla CONTROL (ou COMANDO) para selecionar múltiplos anexos.<br />' .
		'Os ficheiros apresentados nesta lista de anexos estão localizados na directoria de anexos, pode alterar esta localização no painel de controlo em Configuração.');
define('_ACA_CONTENT_ITEM', 'Item do Conteúdo');
define('_ACA_SENDING_EMAIL', 'A enviar email');
define('_ACA_MESSAGE_NOT', 'A Mensagem não pode ser enviada');
define('_ACA_MAILER_ERROR', 'Erro no Mailer');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Mensagem enviada com sucesso');
define('_ACA_SENDING_TOOK', 'O envio deste mailing foi de');
define('_ACA_SECONDS', 'segundos');
define('_ACA_NO_ADDRESS_ENTERED', 'Nenhum assinante ou endereço de email fornecido');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Modificar');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Modificar a sua subscrição');
define('_ACA_WHICH_EMAIL_TEST', 'Indique o endereço de email para enviar um teste ou selecione pré-visualizar');
define('_ACA_SEND_IN_HTML', 'Enviar em HTML (para mailings html)?');
define('_ACA_VISIBLE', 'Visível');
define('_ACA_INTRO_ONLY', 'Apenas Introdução');

// stats
define('_ACA_GLOBALSTATS', 'Estatísticas Globais');
define('_ACA_DETAILED_STATS', 'Estatísticas Detalhadas');
define('_ACA_MAILING_LIST_DETAILS', 'Detalhes de Listas');
define('_ACA_SEND_IN_HTML_FORMAT', 'Envio em formato HTML');
define('_ACA_VIEWS_FROM_HTML', 'Vistos (de emails em html)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Envio em formtato Texto');
define('_ACA_HTML_READ', 'Lidos HTML');
define('_ACA_HTML_UNREAD', 'Não-Lidos HTML');
define('_ACA_TEXT_ONLY_SENT', 'Apenas Texto');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', 'Mail');
define('_ACA_LOGGING_CONFIG', 'Hist. & Estat.');
define('_ACA_SUBSCRIBER_CONFIG', 'Assinantes');
define('_ACA_AUTO_CONFIG', 'Cron');
define('_ACA_MISC_CONFIG', 'Miscelânea');
define('_ACA_MAIL_SETTINGS', 'Definições de Mail');
define('_ACA_MAILINGS_SETTINGS', 'Definições de Mailings');
define('_ACA_SUBCRIBERS_SETTINGS', 'Definições de Assinantes');
define('_ACA_CRON_SETTINGS', 'Definições de Cron');
define('_ACA_SENDING_SETTINGS', 'Definições de Envio');
define('_ACA_STATS_SETTINGS', 'Definições de Estatísticas');
define('_ACA_LOGS_SETTINGS', 'Definições de Históricos');
define('_ACA_MISC_SETTINGS', 'Definições de Miscelânea');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Email do remetente');
define('_ACA_SEND_MAIL_NAME', 'Nome do remetente');
define('_ACA_MAILSENDMETHOD', 'Método do Mailer');
define('_ACA_SENDMAILPATH', 'Caminho do Sendmail');
define('_ACA_SMTPHOST', 'SMTP host');
define('_ACA_SMTPAUTHREQUIRED', 'Requer Autenticação SMTP');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Selecione SIM se o seu servidor SMTP require autenticação');
define('_ACA_SMTPUSERNAME', 'nome da conta SMTP');
define('_ACA_SMTPUSERNAME_TIPS', 'Introduza o nome da conta para o SMTP quando o seu servidor SMTP requerer autenticação');
define('_ACA_SMTPPASSWORD', 'palavra-passe SMTP');
define('_ACA_SMTPPASSWORD_TIPS', 'Introduza a palavra-passe para o SMTP quando o seu servidor SMTP requerer autenticação');
define('_ACA_USE_EMBEDDED', 'Usar imagens embebidas');
define('_ACA_USE_EMBEDDED_TIPS', 'Selecione SIM se as imagens dos items de conteúdo anexo deverão ser embebidas no email para mensagens em html, ou NÃO para usar as tags de imagem por defeito que fazem link para as imagens no site.');
define('_ACA_UPLOAD_PATH', 'Caminho de Envio/Anexos');
define('_ACA_UPLOAD_PATH_TIPS', 'Pode especificar uma directoria para envio.<br />' .
		'Certifique-se que a directoria que especificar existe, caso contrário crie-a.');

// subscribers settings
define('_ACA_ALLOW_UNREG', 'Permitir não-registados');
define('_ACA_ALLOW_UNREG_TIPS', 'Selecione SIM se quiser permitir utilizadores susbcreverem listas sem estarem registados no site.');
define('_ACA_REQ_CONFIRM', 'Requerer Confirmação');
define('_ACA_REQ_CONFIRM_TIPS', 'Selecione SIM se quiser obrigar os utilizadores assinantes não-registados a confirmar o seu endereço de email.');
define('_ACA_SUB_SETTINGS', 'Definições de Subscrição');
define('_ACA_SUBMESSAGE', 'Email de Subscrição');
define('_ACA_SUBSCRIBE_LIST', 'Subscrever uma lista');

define('_ACA_USABLE_TAGS', 'Tags utilizáveis');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = Isto cria um link clicável onde o assinante pode confirmar a sua subscrição. Isto é <strong>obrigatório</strong> para que o Acajoom funcione correctamente.<br />'
.'<br />[NAME] = Isto será substituído pelo nome que o assinante introduziu, estará a enviar emails personalizados ao usar isto.<br />'
.'<br />[FIRSTNAME] = Isto será substituído pelo PRIMEIRO nome do assinante, o primeiro nome é DEFINIDO pelo primeiro nome introduzido pelo assinante.<br />');
define('_ACA_CONFIRMFROMNAME', 'Confirmar o nome do Remetente');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Introduza o nome do remetente a mostrar na confirmação das listas.');
define('_ACA_CONFIRMFROMEMAIL', 'Confirmar o email do remetente');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Introduza o endereço de email do remetente a mostrar na confirmação das listas.');
define('_ACA_CONFIRMBOUNCE', 'Endereço de Bounce');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Introduza o endereço de bounce do remetente a mostrar na confirmação das listas.');
define('_ACA_HTML_CONFIRM', 'Confirmar HTML');
define('_ACA_HTML_CONFIRM_TIPS', 'Selecione SIM se as listas de confirmação devem ser em HTML se o utilizador permitir HTML.');
define('_ACA_TIME_ZONE_ASK', 'Perguntar Zona de Fuso Horário');
define('_ACA_TIME_ZONE_TIPS', 'Selecione SIM se quiser perguntar ao utilizador qual a sua zona de fuso horário. Quando aplicável, os mailings em espera serão enviados baseados na zona de fuso horário');

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', 'clique aqui para definir a zona de fuso horário no painel de configuração global do Joomla -> Separador Locale');
define('_ACA_TIME_OFFSET_TIPS', 'Defina a zona de fuso horário do seu servidor para que a data e hora guardadas sejam exactas');
define('_ACA_TIME_OFFSET', 'Fuso Horário');
define('_ACA_CRON_TITLE', 'Definir uma função Con');
define('_ACA_CRON_DESC','<br />Usar a função Cron automatiza tarefas para o seu site Joomla!<br />' .
		'Para a accionar precisa de adicionar no painel de controlo (separador cron)o seguinte comando:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Se precisar de ajuda para parametrizar ou tiver problemas por favor consulte o nosso forum <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', 'Pausa x segundos por cada quantidade de emails configurada');
define('_ACA_PAUSEX_TIPS', 'Introduza o número de segundos que o Acajoom dará ao servidor de SMTP para enviar as mensagens antes de proceder a novo envio do grupo seguinte de mensagens.');
define('_ACA_EMAIL_BET_PAUSE', 'Emails entre pausas');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Número de emails a enviar antes de fazer pausa.');
define('_ACA_WAIT_USER_PAUSE', 'Esperar por acção do utilizador numa pausa');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Caso o script deva esperar por acção do utilizador quando pausado entre conjuntos de mailings.');
define('_ACA_SCRIPT_TIMEOUT', 'Tempo de intervalo do Script');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Número de minutos que o script deverá ter para correr (0 para ilimitados).');
// Stats settings
define('_ACA_ENABLE_READ_STATS', 'Activar leitura de estatísticas');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Selecione SIM se quiser guardar no histórico o número de visualizações. Esta técnica só pode ser usada com mailings em html');
define('_ACA_LOG_VIEWSPERSUB', 'Guardar histórico de visualizações por assinante');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Selecione SIM se quiser guardar no histórico o número de visualizações por assinante. Esta técnica só pode ser usada com mailings em html');
// Logs settings
define('_ACA_DETAILED', 'Históricos detalhados');
define('_ACA_SIMPLE', 'Históricos simplificados');
define('_ACA_DIAPLAY_LOG', 'Mostrar históricos');
define('_ACA_DISPLAY_LOG_TIPS', 'Selecione SIM se quiser mostrar os históricos enquanto envia mailings.');
define('_ACA_SEND_PERF_DATA', 'Envio de performance para fora');
define('_ACA_SEND_PERF_DATA_TIPS', 'Selecione SIM se quiser permitir ao Acajoom enviar relatórios ANÓNIMOS sobre a sua configuração, número de assinantes de uma lista e o tempo que levou e enviar o mailing. Isto dá-nos uma ideia acerca da performance do Acajoom e AJUDA-NOS a melhorar o Acajoom em futuros desenvolvimentos.');
define('_ACA_SEND_AUTO_LOG', 'Histórico de envio para o Auto-resposta');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Selecione SIM se quiser enviar um email com histórico cada vez que a fila for processada.  AVISO: isto pode resultar numa grande quantidade de emails.');
define('_ACA_SEND_LOG', 'Histórico de envio');
define('_ACA_SEND_LOG_TIPS', 'Caso deva ser enviado um email com o histórico do mailing para o endereço de email do utilizador que envioou o mailing.');
define('_ACA_SEND_LOGDETAIL', 'Detalhe do histórico de envio');
define('_ACA_SEND_LOGDETAIL_TIPS', 'DETALHADO inclúe a informação de sucesso ou falha para cada assinante e um resumo geral da informação. SIMPLES apenas envia o resumo geral.');
define('_ACA_SEND_LOGCLOSED', 'Enviar histórico se a conexão for fechada');
define('_ACA_SEND_LOGCLOSED_TIPS', 'Com esta opção activada o utilizador que enviou o mailing receberá na mesma o relatório por email.');
define('_ACA_SAVE_LOG', 'Salvar Histórico');
define('_ACA_SAVE_LOG_TIPS', 'Caso o histórico do mailing deva ser anexado ao ficheiro do histórico.');
define('_ACA_SAVE_LOGDETAIL', 'Guardar histórico detalhado');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'DETALHADO inclúe a informação de sucesso ou falha para cada assinante e um resumo geral da informação. SIMPLES apenas envia o resumo geral.');
define('_ACA_SAVE_LOGFILE', 'Salvar ficheiro de Histórico');
define('_ACA_SAVE_LOGFILE_TIPS', 'Ficheiro ao qual a informção de histórico será anexada. Este ficheiro poderá ficar muito grande.');
define('_ACA_CLEAR_LOG', 'Limpar Histórico');
define('_ACA_CLEAR_LOG_TIPS', 'Limpa o ficheiro de Histórico.');

### control panel
define('_ACA_CP_LAST_QUEUE', 'Última fila executada');
define('_ACA_CP_TOTAL', 'Total');
define('_ACA_MAILING_COPY', 'Mailing copiado com sucesso!');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', 'Mostrar Guia');
define('_ACA_SHOW_GUIDE_TIPS', 'Mostra o Guia no início para ajudar novos utilizadores a criar uma newsletter, uma auto-resposta e parametrizar correctamente o Acajoom.');
define('_ACA_AUTOS_ON', 'Usar Auto-respostas');
define('_ACA_AUTOS_ON_TIPS', 'Selecione NÃO se não quiser usar Auto-respostas, todas as opções de auto-respostas serão desactivadas.');
define('_ACA_NEWS_ON', 'Usar Newsletters');
define('_ACA_NEWS_ON_TIPS', 'Selecione NÃO se não quiser usar Newsletters, todas as opções de newsletters serão desactivadas.');
define('_ACA_SHOW_TIPS', 'Mostrar Dicas');
define('_ACA_SHOW_TIPS_TIPS', 'Mostra dicas para ajudar os utilizadores a usar o Acajoom de forma eficaz.');
define('_ACA_SHOW_FOOTER', 'Mostrar Rodapé');
define('_ACA_SHOW_FOOTER_TIPS', 'Caso deva ou não ser mostrado os direitos de cópia no rodapé.');
define('_ACA_SHOW_LISTS', 'Mostrar Listas no sítio-principal');
define('_ACA_SHOW_LISTS_TIPS', 'Quando o utilizador não está registado mostra uma lista das listas que pode subscrever através de um botão de arquivo para as newsletters  ou simplesmente um formulário de login para que se possam registar.');
define('_ACA_CONFIG_UPDATED', 'Os detalhes da configuração foram actualizados!');
define('_ACA_UPDATE_URL', 'URL de Actualização');
define('_ACA_UPDATE_URL_WARNING', 'AVISO! Não mude este URL a não ser que lhe seja pedido para o fazer pela equipa técnica do Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Por exemplo: http://www.acajoom.com/update/ (inclua a barra no final)');

// module
define('_ACA_EMAIL_INVALID', 'O endereço de email introduzido é inválido.');
define('_ACA_REGISTER_REQUIRED', 'É necessário registar-se primeiro no site para poder ser assinante de uma lista.');

// Access level box
define('_ACA_OWNER', 'Criador da Lista:');
define('_ACA_ACCESS_LEVEL', 'Definir nível de acesso para a lista');
define('_ACA_ACCESS_LEVEL_OPTION', 'Opções de nível de acesso');
define('_ACA_USER_LEVEL_EDIT', 'Selecione que nível de utilizador tem permissão para editar um mailing (quer do sítio-principal quer do sítio de administração) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', 'Diariamente');
define('_ACA_AUTO_DAY_CH2', 'Diariamente, excepto fim-de-semana');
define('_ACA_AUTO_DAY_CH3', 'Dia sim, dia não');
define('_ACA_AUTO_DAY_CH4', 'Dia sim, dia não, excepto fim-de-semana');
define('_ACA_AUTO_DAY_CH5', 'Semanalmente');
define('_ACA_AUTO_DAY_CH6', 'Bi-semanal');
define('_ACA_AUTO_DAY_CH7', 'Mensal');
define('_ACA_AUTO_DAY_CH9', 'Anual');
define('_ACA_AUTO_OPTION_NONE', 'Não');
define('_ACA_AUTO_OPTION_NEW', 'Novos Utilizadores');
define('_ACA_AUTO_OPTION_ALL', 'Todos os Utilizadores');

//
define('_ACA_UNSUB_MESSAGE', 'Email para Não-subscrição');
define('_ACA_UNSUB_SETTINGS', 'Definições de Não-subscrição');
define('_ACA_AUTO_ADD_NEW_USERS', 'Subscrição automática de Utilizadores?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Não existem actualizações disponíveis de momento.');
define('_ACA_VERSION', 'Versão Acajoom');
define('_ACA_NEED_UPDATED', 'Ficheiros que precisam de ser actualizados:');
define('_ACA_NEED_ADDED', 'Ficheiros que precisam de ser adicionados:');
define('_ACA_NEED_REMOVED', 'Ficheiros que precisam de ser removidos:');
define('_ACA_FILENAME', 'Ficheiro:');
define('_ACA_CURRENT_VERSION', 'Versão actual:');
define('_ACA_NEWEST_VERSION', 'Última versão:');
define('_ACA_UPDATING', 'Actualizando');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Os ficheiros foram actualizados com sucesso.');
define('_ACA_UPDATE_FAILED', 'A Actualização Falhou!');
define('_ACA_ADDING', 'Adicionando');
define('_ACA_ADDED_SUCCESSFULLY', 'Adicionado com sucesso.');
define('_ACA_ADDING_FAILED', 'A Adição Falhou!');
define('_ACA_REMOVING', 'Removendo');
define('_ACA_REMOVED_SUCCESSFULLY', 'Removido com sucesso.');
define('_ACA_REMOVING_FAILED', 'A Remoção Falhou!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Instale uma versão diferente');
define('_ACA_CONTENT_ADD', 'Adicionar conteúdo');
define('_ACA_UPGRADE_FROM', 'Importar dados (newsletters e informação de assinantes) de ');
define('_ACA_UPGRADE_MESS', 'Não existem riscos para os seus dados existentes. <br /> Este processo simplesmente apenas importa dados para a base de dados do Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Continuar e enviar');

// Acajoom message
define('_ACA_UPGRADE1', 'Você pode facilmente importar os seus utilizadores e newsletters ');
define('_ACA_UPGRADE2', ' para o Acajoom no painel de actualizações.');
define('_ACA_UPDATE_MESSAGE', 'Está disponível uma nova versão do Acajoom! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Clique aqui para actualizar!');
define('_ACA_CRON_SETUP', 'Para que as auto-respostas sejam enviadas tem de configurar uma tarefa Cron.');
define('_ACA_THANKYOU', 'Obrigado por escolher Acajoom, o Seu Parceiro de Comunicação!');
define('_ACA_NO_SERVER', 'Servidor de actualização não disponível, por favor verifique mais tarde.');
define('_ACA_MOD_PUB', 'O módulo Acajoom não está publicado.');
define('_ACA_MOD_PUB_LINK', 'Clique aqui para o publicar!');
define('_ACA_IMPORT_SUCCESS', 'importado com sucesso');
define('_ACA_IMPORT_EXIST', 'assinante já está na base de dados');


// Acajoom\'s Guide
define('_ACA_GUIDE', 'Assistente');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>O Acajoom tem muitas caracteristicas grandiosas e este assistente vai guia-lo através de um processo de 4 passos fáceis para que começe a enviar newsletters e auto-respostas!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Primeiro, precisa de adicionar uma lista.  Uma lista pode ser de dois tipos, newsletter ou auto-resposta.' .
		'  Na lista você define todos os diferentes parâmetros para activar o envio das suas newsletters ou auto-respostas: nome do remetente, layout, mensagem de boas-vindas aos assinantes\' , etc...
<br /><br />Pode criar a sua primeira lista aqui: <a href="index2.php?option=com_acajoom&act=list" >criar uma lista</a> e clicar no botão novo.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'O Acajoom proporciona-lhe uma maneira fácil de importar toda a informação de um sistema prévio de newsletter.<br />' .
		' Vá ao painel de Actualizações e escolha o seu sistema prévio de newsletter para importar todas as suas newsletters e assinantes.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: a inmporatação é LIVRE de risco e não afecta de forma alguma a informação do seu sistema prévio de newsletter</span><br />' .
		'Depois da importação será capaz de gerir os seus assinantes e mailings directamente a partir do Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Optimo a sua primeira lista está criada!  Agora pode escrever o seu primeiro %s.  Para criar vá para: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Gestão de Auto-responder');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Gestão de Newsletters');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' e selecione o seu %s. <br /> Depois escolha o seu %s na lista de possibilidades.  Crie o seu primeiro mailing clicando em NOVO ');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'Antes de enviar a sua primeira newsletter poderá querer verificar a configuração de mail.  ' .
		'Vá para <a href="index2.php?option=com_acajoom&act=configuration" >Página de Configuração</a> para verificar as definições de mail. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Quando estiver pronto retroceda para o Menu Newsletters, selecione o seu mailing e clique em ENVIAR');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Para que as suas auto-respostas sejam enviadas necessita que primeiro esteja criada uma tarefa Cron no seu servidor. ' .
		' Por favor refira-se ao separador Cron no painel de configuração.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >clique aqui</a> para aparender como criar uma tarefa Cron. <br />');

define('_ACA_GUIDE_MODULE', ' <br />Certifique também que publicou o módulo Acajoom para que as pessoas possam assinar a lista.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Pode agora criar uma auto-resposta.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Pode agora também criar uma newsletter.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Aí está! Está agora pronto para comunicar de forma eficaz com os seus visitantes e utilizadores. Este assistente terminará assim que você introduzir um segundo mailing ou então pode desliga-lo no <a href="index2.php?option=com_acajoom&act=configuration" >Painel de Configuração</a>.' .
		'<br /><br />  Se tiver alguma questão enquanto usar o Acajoom, por favor refira-se ao ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >forum</a>. ' .
		' Encontrará também muita informação sobre como comunicar de forma eficaz com os seus assinantes em <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Obrigado por usar o Acajoom. O Seu Parceiro de Comunicação!</b> ');
define('_ACA_GUIDE_TURNOFF', 'O assitente esta agora a ser desligado!');
define('_ACA_STEP', 'STEP ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Configuração Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Instalação com Sucesso');
define('_ACA_INSTALL_ERROR', 'Erro na instalação');
define('_ACA_INSTALL_BOT', 'Plugin (Bot) Acajoom');
define('_ACA_INSTALL_MODULE', 'Módulo Acajoom');
//Others
define('_ACA_JAVASCRIPT','!Aviso! Para uma correcta operação o Javascript deve estar activado.');
define('_ACA_EXPORT_TEXT','Os assinantes exportados são baseados na lista que escolheu. <br />Exportar assinantes para lista');
define('_ACA_IMPORT_TIPS','Importar assinantes. A informação no ficheiro precisa de ter o seguinte formato: <br />' .
		'Nome,email,recebeHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmado(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'já é assinante');
define('_ACA_GET_STARTED', 'Clique aqui para começar!');

//News since 1.0.1
define('_ACA_WARNING_1011','Aviso: 1011: A Actualização não funcionará por causa das restrições do seu server.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Escolha que endereço de email será mostrado como remetente.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Escolha que nome se mostrado como remetente.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Escolha que mailer deseja usar: PHP mail function, <span>Sendmail</span> ou SMTP Server.');
define('_ACA_SENDMAILPATH_TIPS', 'Esta é a directoria do servidor de Mail');
define('_ACA_LIST_T_TEMPLATE', 'Tema Padrão');
define('_ACA_NO_MAILING_ENTERED', 'Nenhum mailing fornecido');
define('_ACA_NO_LIST_ENTERED', 'Nenhuma lista fornecida');
define('_ACA_SENT_MAILING' , 'Mailings Enviados');
define('_ACA_SELECT_FILE', 'Por favor selecione um ficheiro para ');
define('_ACA_LIST_IMPORT', 'Verifique a(s) lista(s) que você quer que tenha(m) assinantes associados.');
define('_ACA_PB_QUEUE', 'Subscriber inserted but problem to connect him/her to the list(s). Please check manually.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Actualização Altamente Recomendada!');
define('_ACA_UPDATE_MESS2' , 'Remendo e pequenas correcções.');
define('_ACA_UPDATE_MESS3' , 'Novo lançamento.');
define('_ACA_UPDATE_MESS5' , 'É obrigatório Joomla 1.5 para actualizar.');
define('_ACA_UPDATE_IS_AVAIL' , ' está disponível!');
define('_ACA_NO_MAILING_SENT', 'Nenhum mailing enviado!');
define('_ACA_SHOW_LOGIN', 'Mostra formulário de login');
define('_ACA_SHOW_LOGIN_TIPS', 'Selecione SIM para mostrar um formulário de login no sítio-principal do Painel de Controlo do Acajoom para que o utilizador possa registar-se no site.');
define('_ACA_LISTS_EDITOR', 'Editor de Descrição da Lista');
define('_ACA_LISTS_EDITOR_TIPS', 'Selecione SIM para usar um editor HTML para editar o campo Descrição da Lista.');
define('_ACA_SUBCRIBERS_VIEW', 'Ver assinantes');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Definiçoes do Sítio-Principal' );
define('_ACA_SHOW_LOGOUT', 'Mostra botão de logout');
define('_ACA_SHOW_LOGOUT_TIPS', 'Selecione SIM para mostrar um botão de logout no front-end do painal de controlo do Acajoom.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', 'Integração');
define('_ACA_CB_INTEGRATION', 'Integração com o Community Builder');
define('_ACA_INSTALL_PLUGIN', 'Plugin Community Builder (Integração Acajoom) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'O plugin Acajoom para o Community Builder ainda não está instalado!');
define('_ACA_CB_PLUGIN', 'Listas aquando do registo');
define('_ACA_CB_PLUGIN_TIPS', 'Selecione SIM para mostrar as listas de mailing no formulário de registo do community builder');
define('_ACA_CB_LISTS', 'Listas de IDs');
define('_ACA_CB_LISTS_TIPS', 'ESTE CAMPO É OBRIGATÓRIO. Introduza o número de ID das listas que você quer permitir aos utilizadores assinar separados por vírgula ,  (0 mostra todas as listas)');
define('_ACA_CB_INTRO', 'Texto de Introdução');
define('_ACA_CB_INTRO_TIPS', 'Um texto aparecerá antes da listagem. DEIXE EM BRANCO PARA NÃO MOSTRAR NADA.  Use cb_pretext para layout CSS.');
define('_ACA_CB_SHOW_NAME', 'Mostra Nome da Lista');
define('_ACA_CB_SHOW_NAME_TIPS', 'Selecione se deve ou não mostrar o nome da lista depois da introdução.');
define('_ACA_CB_LIST_DEFAULT', 'Verifica lista por defeito');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Selecione se quer ou não, ter uma caixa de verificação para cada lista verificado por defeito.');
define('_ACA_CB_HTML_SHOW', 'Mostra Receber HTML');
define('_ACA_CB_HTML_SHOW_TIPS', 'Escolha SIM para permitir aos utilizadores decidir se querem ou não, receber emails em HTML. Escolha NÃO para usar o receber HTML por defeito.');
define('_ACA_CB_HTML_DEFAULT', 'Receber HTML por defeito');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Escolha esta opção para mostrar a configuração de mail em HTML por defeito. Se o Mostra Receber Html estiver para NÃO então esta será a opção por defeitot.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', 'Não foi possível efectuar a cópia de segurança do ficheiro! O ficheiro não foi substituído.');
define('_ACA_BACKUP_YOUR_FILES', 'Foi efectuada uma cópia de segurança dos ficheiros da versão antiga na seguinte directória:');
define('_ACA_SERVER_LOCAL_TIME', 'Hora local do Servidor');
define('_ACA_SHOW_ARCHIVE', 'Mostrar botão de Arquivo');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Selecione SIM para mostrar o botão de Arquivo no front-end das listas de Newsletter');
define('_ACA_LIST_OPT_TAG', 'Tags');
define('_ACA_LIST_OPT_IMG', 'Imagens');
define('_ACA_LIST_OPT_CTT', 'Conteúdo');
define('_ACA_INPUT_NAME_TIPS', 'Introduza o seu nome completo (primeiro nome primeiro)');
define('_ACA_INPUT_EMAIL_TIPS', 'Introduza o seu endereço de email (Certifique-se de que este é um endereço de email válido para que possa receber as nossas Newsletters.)');
define('_ACA_RECEIVE_HTML_TIPS', 'Escolha SIM se quiser receber mails em HTML - NÃO para receber mails em apenas texto');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Especifique a sua zona de fuso horário.');


// Since 1.0.5
define('_ACA_FILES' , 'Ficheiros');
define('_ACA_FILES_UPLOAD' , 'Envio');
define('_ACA_MENU_UPLOAD_IMG' , 'Envio de Imagens');
define('_ACA_TOO_LARGE' , 'Tamanho do ficheiro demasiado grande. O tamanho máximo permitido é');
define('_ACA_MISSING_DIR' , 'O directório de destino não existe');
define('_ACA_IS_NOT_DIR' , 'O directório de destino não existe ou é um ficheiro regular.');
define('_ACA_NO_WRITE_PERMS' , 'O directório de destino não tem permissão de escrita.');
define('_ACA_NO_USER_FILE' , 'Não selecionou nenhum ficheiro para envio.');
define('_ACA_E_FAIL_MOVE' , 'Impossível mover o ficheiro.');
define('_ACA_FILE_EXISTS' , 'O ficheiro destino já existe.');
define('_ACA_CANNOT_OVERWRITE' , 'O ficheiro destino já existe e não pode ser sobreposto.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Extensão de ficheiro não permitida.');
define('_ACA_PARTIAL' , 'O ficheiro foi enviado apenas parcialmente.');
define('_ACA_UPLOAD_ERROR' , 'Erro de envio:');
define('DEV_NO_DEF_FILE' , 'O ficheiro foi enviado apenas parcialmente.');
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Isto será substiuído pelos links de subscrição.' .
		' Isto é <strong>obrigatório</strong> para que o Acajoom funcione correctamente.<br />' .
		'Se colocar algum outro conteúdo nesta caixa o mesmo será mostrado em todos os mailings correspondentes a esta Lista.' .
		' <br />Adicione a sua mensagem de subscrição no final.  O Acajoom adicionará automaticamente um link para que o assinante altere a informação dele, e um link para remover-se da Lista.');

// since 1.0.6
define('_ACA_NOTIFICATION', 'Notificação');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', 'Notificações');
define('_ACA_USE_SEF', 'SEF nos mailings');
define('_ACA_USE_SEF_TIPS', 'É recomendado que escolha NÃO.  No entanto se desejar que o URL incluído nos seus mailings use SEF então escolha SIM.' .
		' <br /><b>Os links funcionarão de igual forma para ambas as opções.  NÃO, assegurará que os links nos mailings funcionarão sempre mesmo que altere o seu SEF.</b> ');
define('_ACA_ERR_NB' , 'Erro #: ERR');
define('_ACA_ERR_SETTINGS', 'Definições de manuseamento de Erros');
define('_ACA_ERR_SEND' ,'Enviar relatório de erros');
define('_ACA_ERR_SEND_TIPS' ,'Se deseja que o Acajoom seja um produto melhor por favor selecione SIM.  Isto envia-nos um relatório de erros.  Por isso nunca mais necessita de reportar bugs ;-) <br /> <b>NENHUMA INFORMAÇÃO PRIVADA É ENVIADA</b>.  Nós nem sequer saberemos a que site pertençe o erro. Apenas enviamos informação sobre o Acajoom , a instalação PHP e queries SQL. ');
define('_ACA_ERR_SHOW_TIPS' ,'Escolha SIM para mostrar o número do erro no ecrán.  Usado principalmente para efeitos de debuging. ');
define('_ACA_ERR_SHOW' ,'Mostra erros');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Mostra links de remoção');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Selecione SIM para mostrar links de remoção no rodapé dos mailings para que os utilizadores possam mudar as suas subscrições. <br /> NÃO, desactiva os links e rodapé.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">NOTÍCIA IMPORTANTE!</span> <br />Se está a fazer uma actualização a partir de uma versão anterior do Acajoom, precisa de actualizar a estrutura da sua base de dados clicando no botão seguinte (A sua informação ficará íntegra)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Actualizar tabelas e configuração');
define('_ACA_MAILING_MAX_TIME', 'Tempo máximo da fila' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Define o tempo máximo para cada conjunto de emails enviados pela fila. Recomendado entre 30s e 2mins.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'Integração com VirtueMart');
define('_ACA_VM_COUPON_NOTIF', 'Notificação de ID do Cupão');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Especifica o número de ID do mailing que quiser usar para enviar cupões para os seus clientes.');
define('_ACA_VM_NEW_PRODUCT', 'Notificação de ID de novos produtos');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Especifica o número de ID do mailing que quiser usar para enviar notificação de novos produtos.');


// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', 'Criar Formulário');
define('_ACA_FORM_COPY', 'Código HTML');
define('_ACA_FORM_COPY_TIPS', 'Copie o código HTML gerado para a sua página HTML.');
define('_ACA_FORM_LIST_TIPS', 'Selecione a lista que quer incluir neste formulário');
// update messages
define('_ACA_UPDATE_MESS4' , 'Não pode ser actualizado automaticamente.');
define('_ACA_WARNG_REMOTE_FILE' , 'Não há maneira de conseguir o ficheiro remoto.');
define('_ACA_ERROR_FETCH' , 'Erro de acesso ao ficheiro.');

define('_ACA_CHECK' , 'Verificar');
define('_ACA_MORE_INFO' , 'Mais informação');
define('_ACA_UPDATE_NEW' , 'Actualizar para nova versão');
define('_ACA_UPGRADE' , 'Upgrade para produto mais elevado');
define('_ACA_DOWNDATE' , 'Voltar a instalar versão anterior');
define('_ACA_DOWNGRADE' , 'Voltar para o produto básico');
define('_ACA_REQUIRE_JOOM' , 'Requere Joomla');
define('_ACA_TRY_IT' , 'Experimentar!');
define('_ACA_NEWER', 'Novo');
define('_ACA_OLDER', 'Antigo');
define('_ACA_CURRENT', 'Actual');

// since 1.0.9
define('_ACA_CHECK_COMP', 'Experimentar um dos outros componentes');
define('_ACA_MENU_VIDEO' , 'Tutoriais Video');
define('_ACA_AUTO_SCHEDULE', 'Temporizador');
define('_ACA_SCHEDULE_TITLE', 'Definições de funções automáticas temporizadas');
define('_ACA_ISSUE_NB_TIPS' , 'Atribuir número automaticamente gerado pelo sistema' );
define('_ACA_SEL_ALL' , 'Todos os mailings');
define('_ACA_SEL_ALL_SUB' , 'Todas as listas');
define('_ACA_INTRO_ONLY_TIPS' , 'Se assinalar esta caixa apenas a introdução do artigo será inserida no mailing com um link LER MAIS para a leitura completa do mesmo no seu site.' );
define('_ACA_TAGS_TITLE' , 'Tag de conteúdo');
define('_ACA_TAGS_TITLE_TIPS' , 'Copie e cole esta tag para o seu mailing, no sítio onde quer colocar o conteúdo.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Indica o endereço de email para onde enviar um teste');
define('_ACA_PREVIEW_TITLE' , 'Pré-visualizar');
define('_ACA_AUTO_UPDATE' , 'Nova notificação de actualização');
define('_ACA_AUTO_UPDATE_TIPS' , 'Selecione SIM se quiser ser notificado de novas actualizações para o seu componente. <br />IMPORTANTE!! Mostrar Dicas tem de estar activado para que esta função funcione.');

// since 1.1.0
define('_ACA_LICENSE' , 'Informação de Licenceamento');


// since 1.1.1
define('_ACA_NEW' , 'Novo');
define('_ACA_SCHEDULE_SETUP', 'Para que as auto-respostas sejam enviadas tem de definir uma agenda na configuração.');
define('_ACA_SCHEDULER', 'Agendador');
define('_ACA_ACAJOOM_CRON_DESC' , 'se não tem acesso à administração de tarefas cron no seu website, pode registar-se para uma Conta Tarefa Cron Acajoom Grátis em:' );
define('_ACA_CRON_DOCUMENTATION' , 'Pode encontrar mais informação sobre como definir o Agendador Acajoom no url seguinte:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Fila processada com sucesso...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Erro ao mover ficheiro importado' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Frequência do Agenda' );
define( '_ACA_CRON_MAX_FREQ' , 'Frequência Máxima da Agenda' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Especifica a frequência máxima que a agenda pode ser executada ( em minutos ).  Isto limitará a atenda mesmo que a tarefa cron esteja definida com maior frequência.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Máximo de emails por tarefa' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Especifica o número máximo de emails enviados por tarefa (0 ilimitados).' );
define( '_ACA_CRON_MINUTES' , ' minutos' );
define( '_ACA_SHOW_SIGNATURE' , 'Mostra rodapé do email' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Caso queira ou não promover o Acajoom no rodapé dos emails.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Auto-respostas processadas com successo...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Newsletters agendadas processadas com sucesso...' );
define( '_ACA_MENU_SYNC_USERS' , 'Sincronizar Utilizadores' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Sincronização de Utilizadores processada com sucesso!' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Sair' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Sim' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Não' );
if (!defined('_HI')) define( '_HI', 'Olá' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Topo' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Fundo' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Se selecionar isto apenas o título do artigo será inserido no mailing como link para o artigo completo no seu site.');
define('_ACA_TITLE_ONLY' , 'Apenas Título');
define('_ACA_FULL_ARTICLE_TIPS' , 'Se selecionar isto o artigo completo será inserido no mailing');
define('_ACA_FULL_ARTICLE' , 'Artigo Completo');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Selecione um item de conteúdo para ser adicionado à mensagem. <br />Copie e cole o<b>content tag</b> para o mailing.  Pode escolher ter a totalidade do texto, apenas introdução, ou apenas título com (0, 1, ou 2 respectivamente). ');
define('_ACA_SUBSCRIBE_LIST2', 'Lista(s) de Mailing');

// smart-newsletter function
define('_ACA_AUTONEWS', 'Smart-Newsletter');
define('_ACA_MENU_AUTONEWS', 'Smart-Newsletters');
define('_ACA_AUTO_NEWS_OPTION', 'Opções da Smart-Newsletter');
define('_ACA_AUTONEWS_FREQ', 'Frequência da Newsletter');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Especifica a frequência com que deseja enviar as smart-newsletter.');
define('_ACA_AUTONEWS_SECTION', 'Secção de Artigos');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Especifica a secção de que quer escolher os artigos.');
define('_ACA_AUTONEWS_CAT', 'Categoria do Artigo');
define('_ACA_AUTONEWS_CAT_TIPS', 'Especifica a categoria de que quer escolher os artigos (TODAS para todos os artigos naquela secção).');
define('_ACA_SELECT_SECTION', 'Selecione secção');
define('_ACA_SELECT_CAT', 'Todas as Categorias');
define('_ACA_AUTO_DAY_CH8', 'Quaternalmente');
define('_ACA_AUTONEWS_STARTDATE', 'Data de começo');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Especifica a data para começar a enviar a Smart Newsletter.');
define('_ACA_AUTONEWS_TYPE', 'Renderização do Conteúdo');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', 'Artigo Completo: will include the entire article in the newsletter.<br />' .
		'Apenas Introdução: será incluida apenas a introdução do artigo na newsletter.<br/>' .
		'Apenas Título: será incluido apenas o título do artigo na newsletter.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Isto será substituído pela Smart-newsletter.' );

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
define('_ACA_REGWARN_NAME','Por favor, informe seu nome.');
define('_ACA_REGWARN_MAIL','Por favor, informe um endereço de e-mail válido.');

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
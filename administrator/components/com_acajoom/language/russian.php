<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Доступ запрещен...');

/**
* <p>Русский языковой файл</p>
* @author Salikhov Ilyas <salikhoff@gmail.com>
* @version $Id: russian.php 491 2007-02-01 22:56:07Z divivo $
*/


### General ###
 // Описание acajoom
define('_ACA_DESC_NEWS', 'Acajoom - это инструмент почтовых рассылок, рассылки новостей и автореспондер для эффективной коммуникации с Вашими пользователя и клиентами.  ' .
		'Acajoom, Ваш коммуникационный партнер!');
define('_ACA_FEATURES', 'Acajoom, Ваш коммуникационный партнер!');

// Тип списков
define('_ACA_NEWSLETTER', 'Информационный бюллетень');
define('_ACA_AUTORESP', 'Автоответчик');
define('_ACA_AUTORSS', 'RSS-подписка');
define('_ACA_ECARD', 'eCard');
define('_ACA_POSTCARD', 'Почтовая открытка');
define('_ACA_PERF', 'Производительность');
define('_ACA_COUPON', 'Купон');
define('_ACA_CRON', 'Задача Хрона');
define('_ACA_MAILING', 'Почтовая рассылка');
define('_ACA_LIST', 'Список');

// Меню acajoom
define('_ACA_MENU_LIST', 'Списки');
define('_ACA_MENU_SUBSCRIBERS', 'Подписчики');
define('_ACA_MENU_NEWSLETTERS', 'Информационные бюллетени');
define('_ACA_MENU_AUTOS', 'Автоответчики');
define('_ACA_MENU_COUPONS', 'Купоны');
define('_ACA_MENU_CRONS', 'Задачи Хрона');
define('_ACA_MENU_AUTORSS', 'RSS-подписка');
define('_ACA_MENU_ECARD', 'eCards');
define('_ACA_MENU_POSTCARDS', 'Почтовые Открытки');
define('_ACA_MENU_PERFS', 'Производительность');
define('_ACA_MENU_TAB_LIST', 'Списки');
define('_ACA_MENU_MAILING_TITLE', 'Почтовые рассылки');
define('_ACA_MENU_MAILING' , 'Рассылки для ');
define('_ACA_MENU_STATS', 'Статистика');
define('_ACA_MENU_STATS_FOR', 'Статистика для');
define('_ACA_MENU_CONF', 'Конфигурация');
define('_ACA_MENU_UPDATE', 'Import');
define('_ACA_MENU_ABOUT', 'О');
define('_ACA_MENU_LEARN', 'центр Образования');
define('_ACA_MENU_MEDIA', 'Медиа-менеджер'); // был - "Менеджер Носителя"
define('_ACA_MENU_HELP', 'Помощь');
define('_ACA_MENU_CPANEL', 'CPanel');
define('_ACA_MENU_IMPORT', 'Импорт');
define('_ACA_MENU_EXPORT', 'Экспорт');
define('_ACA_MENU_SUB_ALL', 'Подписаться на все');
define('_ACA_MENU_UNSUB_ALL', 'Аннулирует всю подписку');
define('_ACA_MENU_VIEW_ARCHIVE', 'Архив');
define('_ACA_MENU_PREVIEW', 'Предпросмотр');
define('_ACA_MENU_SEND', 'Отправка');
define('_ACA_MENU_SEND_TEST', 'Электронная почта для Теста Отправки');
define('_ACA_MENU_SEND_QUEUE', 'Очередь Процесса');
define('_ACA_MENU_VIEW', 'Вид');
define('_ACA_MENU_COPY', 'Копия');
define('_ACA_MENU_VIEW_STATS' , 'Просмотр статистики');
define('_ACA_MENU_CRTL_PANEL' , 'Панель Управления');
define('_ACA_MENU_LIST_NEW' , 'Создать Список');
define('_ACA_MENU_LIST_EDIT' , 'Править Список');
define('_ACA_MENU_BACK', 'Назад');
define('_ACA_MENU_INSTALL', 'Инсталляция');
define('_ACA_MENU_TAB_SUM', 'Резюме');
define('_ACA_STATUS', 'Состояние');

// сообщения
define('_ACA_ERROR' , ' Произошла ошибка! ');
define('_ACA_SUB_ACCESS' , 'Права доступа');
define('_ACA_DESC_CREDITS', 'О модуле');
define('_ACA_DESC_INFO', 'Информация');
define('_ACA_DESC_HOME', 'Домашняя страница');
define('_ACA_DESC_MAILING', 'Список рассылки');
define('_ACA_DESC_SUBSCRIBERS', 'Подписчики');
define('_ACA_PUBLISHED','Опубликовано');
define('_ACA_UNPUBLISHED','Не опубликовано');
define('_ACA_DELETE','Удалить');
define('_ACA_FILTER','Фильтр');
define('_ACA_UPDATE','Обновить');
define('_ACA_SAVE','Сохранить');
define('_ACA_CANCEL','Отменить');
define('_ACA_NAME','Имя');
define('_ACA_EMAIL','Электронная почта');
define('_ACA_SELECT','Выбрать');
define('_ACA_ALL','Все');
define('_ACA_SEND_A', 'Отправляются... ');
define('_ACA_SUCCESS_DELETED', ' удаление прошло успешно');
define('_ACA_LIST_ADDED', 'Список успешно создан');
define('_ACA_LIST_COPY', 'Список успешно скопирован');
define('_ACA_LIST_UPDATED', 'Список успешно обновлен');
define('_ACA_MAILING_SAVED', 'Почтовые отправления успешно сохранены.');
define('_ACA_UPDATED_SUCCESSFULLY', 'успешно обновлен.');

### Subscribers information ###
// подписка и отписка новостей
define('_ACA_SUB_INFO', 'Данные подписчика');
define('_ACA_VERIFY_INFO', 'Пожалуйста, проверьте введенную вами ссылку. Некоторая информация является недостающей.');
define('_ACA_INPUT_NAME', 'Имя');
define('_ACA_INPUT_EMAIL', 'Электронная почта');
define('_ACA_RECEIVE_HTML', 'Получать HTML?');
define('_ACA_TIME_ZONE', 'Часовой пояс');
define('_ACA_BLACK_LIST', 'Чёрный список');
define('_ACA_REGISTRATION_DATE', 'Дата регистрации пользователя');
define('_ACA_USER_ID', 'Идентификатор пользователя');
define('_ACA_DESCRIPTION', 'Описание');
define('_ACA_ACCOUNT_CONFIRMED', 'Ваша учетная запись активирована.');
define('_ACA_SUB_SUBSCRIBER', 'Подписчик');
define('_ACA_SUB_PUBLISHER', 'Издатель');
define('_ACA_SUB_ADMIN', 'Администратор');
define('_ACA_REGISTERED', 'Зарегистрировано');
define('_ACA_SUBSCRIPTIONS', 'Ваша подписка');
define('_ACA_SEND_UNSUBCRIBE', 'Сообщение об аннулировании подписки');
define('_ACA_SEND_UNSUBCRIBE_TIPS', 'Нажмите Да, чтобы посылать письмо с подтверждением аннулирования подписки.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', 'Пожалуйста, подтвердите подписку');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', 'Подтверждение отказа от подписки');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', 'Здравствуйте, [NAME],<br />' .
		'Еще один шаг, и вы будете подписаны на рассылку. Пожалуйста, перейдите по ссылке чтобы подтвердить подписку.' .
		'<br /><br />[CONFIRM]<br /><br />Если у вас возникли вопросы, пожалуйста, обратитесь к администратору.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', 'Настоящим письмом собщаем вам, что вы были удалены из числа наши подписчиков. Мы сожалеем о том, что Вы приняли решение отказаться от подписки. Если Вы захотите восстановить подписку, Вы всегда можете сделать это на нашем сайте. Если у Вас возникнут вопросы, обращайтесь к нашему администратору.');

// Подписчики Acajoom
define('_ACA_SIGNUP_DATE', 'Дата подписки');
define('_ACA_CONFIRMED', 'Подтверждено');
define('_ACA_SUBSCRIB', 'Подписаться');
define('_ACA_HTML', 'HTML рассылки');
define('_ACA_RESULTS', 'Результаты');
define('_ACA_SEL_LIST', 'Выберите список');
define('_ACA_SEL_LIST_TYPE', '- Выберите тип списка -');
define('_ACA_SUSCRIB_LIST', 'Список всех подписчиков');
define('_ACA_SUSCRIB_LIST_UNIQUE', 'Подписчики на:  ');
define('_ACA_NO_SUSCRIBERS', 'Для этого списка не найдено ни одного подписчика.');
define('_ACA_COMFIRM_SUBSCRIPTION', 'Вам было выслано письмо для подтверждения подписки.  Пожалуйста, проверь почту и перейдите по высланной ссылке.<br />' .
		'Чтобы подписка была активированна, вы должны подтвердить свой e-mail.');
define('_ACA_SUCCESS_ADD_LIST', 'Вы были успешно добавлены в список подписчиков.');


 // Subcription info
define('_ACA_CONFIRM_LINK', 'Нажмите здесь, чтобы подтвердить подписку');
define('_ACA_UNSUBSCRIBE_LINK', 'Нажмите здесь, чтобы удалить себя из списка подписчиков');
define('_ACA_UNSUBSCRIBE_MESS', 'Адрес вашей электронной почты был удален из списка');

define('_ACA_QUEUE_SENT_SUCCESS' , 'Все составленные рассылки были успешно разосланы.');
define('_ACA_MALING_VIEW', 'Показать все рассылки');
define('_ACA_UNSUBSCRIBE_MESSAGE', 'Вы уверены, что хотите отказаться от рассылки по данному листу?');
define('_ACA_MOD_SUBSCRIBE', 'Подписаться');
define('_ACA_SUBSCRIBE', 'Подписаться');
define('_ACA_UNSUBSCRIBE', 'Отказаться от подписки');
define('_ACA_VIEW_ARCHIVE', 'Показать архив');
define('_ACA_SUBSCRIPTION_OR', ' или нажмите здесь чтобы принять изменения');
define('_ACA_EMAIL_ALREADY_REGISTERED', 'Этот адрес уже есть в базе.');
define('_ACA_SUBSCRIBER_DELETED', 'Подписчик успешно удален.');


### Панель Пользователя ###
 // Пользовательское Меню
define('_UCP_USER_PANEL', 'Пользовательская Панель управления');
define('_UCP_USER_MENU', 'Пользовательское Меню');
define('_UCP_USER_CONTACT', 'Мои Подписки');
 // Меню Хрона Acajoom
define('_UCP_CRON_MENU', 'Управление Задачами Хрона');
define('_UCP_CRON_NEW_MENU', 'Новый Хрон');
define('_UCP_CRON_LIST_MENU', 'Список мой Хрон');
 // Меню Купона Acajoom
define('_UCP_COUPON_MENU', 'Управление Купонами');
define('_UCP_COUPON_LIST_MENU', 'Список Купонов');
define('_UCP_COUPON_ADD_MENU', 'Добавить Купон');

### списки ###
// Вкладки
define('_ACA_LIST_T_GENERAL', 'Описание');
define('_ACA_LIST_T_LAYOUT', 'Раскладка');
define('_ACA_LIST_T_SUBSCRIPTION', 'Подписка');
define('_ACA_LIST_T_SENDER', 'Данные отправителя');

define('_ACA_LIST_TYPE', 'Тип списка');
define('_ACA_LIST_NAME', 'Имя списка');
define('_ACA_LIST_ISSUE', 'Публикация #');
define('_ACA_LIST_DATE', 'Дата отправки');
define('_ACA_LIST_SUB', 'Тема рассылки');
define('_ACA_ATTACHED_FILES', 'Прикрепленные файлы');
define('_ACA_SELECT_LIST', 'Пожалуйста, выберите список для редактирования!');

// Окно автоответчика
define('_ACA_AUTORESP_ON', 'Тип списка');
define('_ACA_AUTO_RESP_OPTION', 'Настройки автоответчика');
define('_ACA_AUTO_RESP_FREQ', 'Подписчики могут выбирать периодичность рассылки');
define('_ACA_AUTO_DELAY', 'Перерыв (в днях)');
define('_ACA_AUTO_DAY_MIN', 'Минимальная частота');
define('_ACA_AUTO_DAY_MAX', 'Максимальная частота');
define('_ACA_FOLLOW_UP', 'Определить прикрепленный автоответчик');
define('_ACA_AUTO_RESP_TIME', 'Подписчики могут выбирать время');
define('_ACA_LIST_SENDER', 'Отправитель списка');

define('_ACA_LIST_DESC', 'Описание списка');
define('_ACA_LAYOUT', 'Стиль');
define('_ACA_SENDER_NAME', 'Имя отправителя');
define('_ACA_SENDER_EMAIL', 'Эл. адрес отправителя');
define('_ACA_SENDER_BOUNCE', 'Обратный адрес отправителя');
define('_ACA_LIST_DELAY', 'Перерыв');
define('_ACA_HTML_MAILING', 'HTML рассылка?');
define('_ACA_HTML_MAILING_DESC', '(Если Вы сохраните это, Вам будет необходимо выйти и снова войти на страницу, чтобы увидеть изменения.)');
define('_ACA_HIDE_FROM_FRONTEND', 'Не показывать во фронтенд?');
define('_ACA_SELECT_IMPORT_FILE', 'Выберите файл для импорта');;
define('_ACA_IMPORT_FINISHED', 'Импортирование закончено');
define('_ACA_DELETION_OFFILE', 'Удаление файла');
define('_ACA_MANUALLY_DELETE', 'не состоялось, вы должны вручную удалить файл');
define('_ACA_CANNOT_WRITE_DIR', 'Не могу записать в директорию');
define('_ACA_NOT_PUBLISHED', 'Не могу разослать рассылку.Список не опубликован.');

//  Информационный блок списков
define('_ACA_INFO_LIST_PUB', 'Надмите Да, чтобы опубликовать список.');
define('_ACA_INFO_LIST_NAME', 'Введите имя списка. С помощью этого имени Вы сможете идентифицировать список.');
define('_ACA_INFO_LIST_DESC', 'Введите краткое описание вашего списка. Оно будет доступно для посетителей вашего ресурса.');
define('_ACA_INFO_LIST_SENDER_NAME', 'Введите имя отправителя сообщения. Это имя будут видеть Ваши подписчики в графе "от кого".');
define('_ACA_INFO_LIST_SENDER_EMAIL', 'Введите электронный адрес, с которого будут отправляться сообщения.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', 'Введите электронный адрес для ответов подписчиков. Настоятельно рекомендуется указывать тот же адрес, что и у автора рассылки, так как такое письмо легче проходит через спам-фильтры почтовых систем.');
define('_ACA_INFO_LIST_AUTORESP', 'Выберите тип рассылок для данного списка. <br />' .
		'Новостная рассылка: Обычная новостная рассылка<br />' .
		'Автоответчик: автоответчик это лист, который рассылается автоматически через веб-сайт через заданные промежутки времени.');
define('_ACA_INFO_LIST_FREQUENCY', 'Разрешить пользователям выбирать, насколько часто они будут получать письма. Это рассылку более гибкой и удобной для пользователей.');
define('_ACA_INFO_LIST_TIME', 'Разрешить пользователям выбирать время дня, предпочтительное для получения рассылки.');
define('_ACA_INFO_LIST_MIN_DAY', 'Установите минимальную периодичность получения рассылки, которую может выбрать пользователь.');
define('_ACA_INFO_LIST_DELAY', 'Задайте интервал между работой этого автоответчика и предыдущего.');
define('_ACA_INFO_LIST_DATE', 'Установите дату отправки (публикации) новостной рассылки, если Вы хотите отложить публикацию.<br /> FORMAT : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', 'Установите максимальную периодичность получения рассылки, которую может выбрать пользователь.');
define('_ACA_INFO_LIST_LAYOUT', 'Введите стиль Вашего списка подписки. Здесь Вы можете ввести любой стиль для Ваших рассылок.');
define('_ACA_INFO_LIST_SUB_MESS', 'Это сообщение будет отправлено пользователю, который впервые зарегистрировался. Вы можете ввести здесь любой свой текст.');
define('_ACA_INFO_LIST_UNSUB_MESS', 'Это сообщение будет отправлено пользователю, который аннулирует подписку. Вы можете ввести здесь любой свой текст.');
define('_ACA_INFO_LIST_HTML', 'Выберите эту опцию, если Вы хотите рассылать сообщения в формате HTML. Пользователи могут выбирать между HTML вариантом рассылки и обычным текстом, когда подписываются на HTML рассылку.');
define('_ACA_INFO_LIST_HIDDEN', 'Нажмите Да, чтобы убрать подписку с фронтенда. Пользователи не смогут подписаться на рассылку, но Вы по-прежнему сможете отправлять сообщения уже подписавшимся.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', 'Вы хотите, чтобы пользователи автоматически добавлялись в этот список?<br /><B>Новые пользователи:</B> будут зарегистрированы все новые пользователи, зарегистрированные на сайте .<br /><B>Все пользователи:</B> будут зарегистрированы все пользователи, содержащиеся в базе данных.<br />(выбор варианта Все поддерживает Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', 'Выберите уровень доступа с фронтенда. Это позволяет показывать или скрывать рассылки от пользователей, которые не должны иметь доступа к этим подпискам, то есть они не смогут подписаться на эти рассылки.');
define('_ACA_INFO_LIST_ACC_USER_ID', 'Выберите уровень доступа для групп пользователей, которым разрешено редактирование. Эта группа и другие с более высокими уровнями доступа смогут редактировать рассылку и осуществлять отправку, как с фронтенда, так и из панели администратора.');
define('_ACA_INFO_LIST_FOLLOW_UP', 'Если Вы хотите, чтобы автоответчик передал действие другому, после того как дойдет до последнего сообщения, определите здесь последующий.');
define('_ACA_INFO_LIST_ACA_OWNER', 'Это ID пользователя, создавшего список.');
define('_ACA_INFO_LIST_WARNING', '   Эта последняя опция доступна только при создании списка.');
define('_ACA_INFO_LIST_SUBJET', ' Тема рассылки.  Это тема письма, которую будет видеть подписчик.');
define('_ACA_INFO_MAILING_CONTENT', 'Это содержание письма, которое Вы хотите отправить.');
define('_ACA_INFO_MAILING_NOHTML', 'Введите здесь содержание письма, которое Вы хотите отправить подписчикам решившим получать только HTML рассылки. <BR/> ЗАМЕЧАНИЕ: если вы оставите эту опцию пустой, то Acajoom автоматически преобразует HTML текст в обычный текст.');
define('_ACA_INFO_MAILING_VISIBLE', 'Нажмите Да, чтобы отображать рассылку во фронтенде.');
define('_ACA_INSERT_CONTENT', 'Вставить существующий контент');

// Купоны
define('_ACA_SEND_COUPON_SUCCESS', 'Купон успешно отправлен!');
define('_ACA_CHOOSE_COUPON', 'Выберите купон');
define('_ACA_TO_USER', ' этому пользователю');

### опции Хрона (демон ОС Unix, исполняющий предписанные команды в строго определённые дни и часы, указанные в специальном файле)
//надписи частоты рассылки Хрона
define('_ACA_FREQ_CH1', 'Каждый час');
define('_ACA_FREQ_CH2', 'Каждые 6 часов');
define('_ACA_FREQ_CH3', 'Каждые 12 часов');
define('_ACA_FREQ_CH4', 'Ежедневно');
define('_ACA_FREQ_CH5', 'Еженедельно');
define('_ACA_FREQ_CH6', 'Ежемесячно');
define('_ACA_FREQ_NONE', 'Нет');
define('_ACA_FREQ_NEW', 'Новый пользователь');
define('_ACA_FREQ_ALL', 'Все пользователи');

//Подписи для формы Хрона
define('_ACA_LABEL_FREQ', 'Acajoom Хрон?');
define('_ACA_LABEL_FREQ_TIPS', 'Нажмите Да, если Вы хотите использовать это для Хрона Acajoom, Нет для любого другого Хрон задания.<br />' .
		'Если выберете Да, Вам не нужно будет задавать адрес Хрона, он будет автоматически добавлен.');
define('_ACA_SITE_URL' , 'URL вашего сайта');
define('_ACA_CRON_FREQUENCY' , 'Частота запуска Хрона');
define('_ACA_STARTDATE_FREQ' , 'Дата начала');
define('_ACA_LABELDATE_FREQ' , 'Выберите дату');
define('_ACA_LABELTIME_FREQ' , 'Выберите время');
define('_ACA_CRON_URL', 'Хрон URL');
define('_ACA_CRON_FREQ', 'Частота');
define('_ACA_TITLE_CRONLIST', 'Список задач Хрона');
define('_NEW_LIST', 'Создать новый список');

//заголовок формы Хрона
define('_ACA_TITLE_FREQ', 'Редактор Хрона');
define('_ACA_CRON_SITE_URL', 'Пожалуйста, введите правильный адресс, начинающийся с http://');

### Рассылки ###
define('_ACA_MAILING_ALL', 'Все рассылки');
define('_ACA_EDIT_A', 'Редактировать... ');
define('_ACA_SELCT_MAILING', 'Пожалуйста, выберите список в выпадающем меню, чтобы добавить новую рассылку.');
define('_ACA_VISIBLE_FRONT', 'Видна во фронтенде');

// рассыльщик
define('_ACA_SUBJECT', 'Тема');
define('_ACA_CONTENT', 'Содержание');
define('_ACA_NAMEREP', '[NAME] = Это будет заменено на имя введенное подписчиком, При использовании этого, Вы будете рассылать письма, написанные непосредственно на имя подписчика.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = Это будет заменено на Имя (имя, введенное первым) подписчика.<br />');
define('_ACA_NONHTML', 'Не html версия');
define('_ACA_ATTACHMENTS', 'Прикрепленные данные');
define('_ACA_SELECT_MULTIPLE', 'Удерживайте ctrl, чтобы выбрать сразу несколько элементов.<br />' .
		'Файлы, показанные в списке прикрепленных данных расположены в папке прикрепленных файлов, Вы можете изменить их местонахождение в панели конфигурации.');
define('_ACA_CONTENT_ITEM', 'Часть контента');
define('_ACA_SENDING_EMAIL', 'Идет рассылка');
define('_ACA_MESSAGE_NOT', 'Сообщение не может быть отослано');
define('_ACA_MAILER_ERROR', 'Ошибка отправки');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', 'Сообщение было успешно отправлено');
define('_ACA_SENDING_TOOK', 'Отправка данной рассылки заняла');
define('_ACA_SECONDS', 'сек.');
define('_ACA_NO_ADDRESS_ENTERED', 'Не доступно ни одного адреса подписчика для оправки');
define('_ACA_CHANGE_SUBSCRIPTIONS', 'Изменить');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', 'Изменение Вашей подписки');
define('_ACA_WHICH_EMAIL_TEST', 'Выберите e-mail, чтобы отправить на него тестовое сообщение, или нажмите предпросмотр');
define('_ACA_SEND_IN_HTML', 'Оправлять в HTML  формате (для html рассылок)?');
define('_ACA_VISIBLE', 'Видимое');
define('_ACA_INTRO_ONLY', 'Только вступление');

// статистика
define('_ACA_GLOBALSTATS', 'Глобальная статистика');
define('_ACA_DETAILED_STATS', 'Детализированная статистика');
define('_ACA_MAILING_LIST_DETAILS', 'Детали списка рассылки');
define('_ACA_SEND_IN_HTML_FORMAT', 'Отправлять в HTML формате');
define('_ACA_VIEWS_FROM_HTML', 'Просмотры (из сообщений, отправленных в формате html)');
define('_ACA_SEND_IN_TEXT_FORMAT', 'Разослано в текстовом формате');
define('_ACA_HTML_READ', 'HTML прочитано');
define('_ACA_HTML_UNREAD', 'HTML не прочитано');
define('_ACA_TEXT_ONLY_SENT', 'Только текст');

// Панель Конфигурирования
// закладки
define('_ACA_MAIL_CONFIG', 'Почта');
define('_ACA_LOGGING_CONFIG', 'Логи и статистика');
define('_ACA_SUBSCRIBER_CONFIG', 'Подписчики');
define('_ACA_MISC_CONFIG', 'Разное');
define('_ACA_MAIL_SETTINGS', 'Настройки почты');
define('_ACA_MAILINGS_SETTINGS', 'Настройки рассылок');
define('_ACA_SUBCRIBERS_SETTINGS', 'Настройки подписчиков');
define('_ACA_CRON_SETTINGS', 'Настройки Хрона');
define('_ACA_SENDING_SETTINGS', 'Настройки отправки');
define('_ACA_STATS_SETTINGS', 'Настройки статистики');
define('_ACA_LOGS_SETTINGS', 'Настройки логов');
define('_ACA_MISC_SETTINGS', 'Другие настройки');
// mail settings
define('_ACA_SEND_MAIL_FROM', 'Адрес отправителя');
define('_ACA_SEND_MAIL_NAME', 'Имя отправителя');
define('_ACA_MAILSENDMETHOD', 'Метод рассылки');
define('_ACA_SENDMAILPATH', 'Путь к папке "Отосланные"');
define('_ACA_SMTPHOST', 'SMTP сервер');
define('_ACA_SMTPAUTHREQUIRED', 'Требуется аутентификация для SMTP');
define('_ACA_SMTPAUTHREQUIRED_TIPS', 'Выберите Да, если Ваш SMTP требует аутентификацию');
define('_ACA_SMTPUSERNAME', 'SMTP логин');
define('_ACA_SMTPUSERNAME_TIPS', 'Введите SMTP логин, если Ваш SMTP требует аутентификацию');
define('_ACA_SMTPPASSWORD', 'SMTP пароль');
define('_ACA_SMTPPASSWORD_TIPS', 'Введите SMTP пароль, если Ваш SMTP требует аутентификацию');
define('_ACA_USE_EMBEDDED', 'Использовать вставленные изображения');
define('_ACA_USE_EMBEDDED_TIPS', 'Выберите "Да", если картинки в прикрепленных элементах должны быть уложены в письмо для html сообщений, или "Нет", чтобы использовать обычные теги картинок, ссылающихся на картинки на веб-ресурсе.');
define('_ACA_UPLOAD_PATH', 'Путь к папке Загрузки/Вложения');
define('_ACA_UPLOAD_PATH_TIPS', 'Вы можете задать директорию для загрузки файлов на сервер<br />' .
		'Убедитесь, что директория, которую вы создали существует, если её нет, то создайте ее.');

// настройки подписчиков
define('_ACA_ALLOW_UNREG', 'Позволять незарегистрированным');
define('_ACA_ALLOW_UNREG_TIPS', 'Выберите "Да", если Вы хотите разрешить пользователям подписываться на рассылку без регистрации на сайте.');
define('_ACA_REQ_CONFIRM', 'Требовать письмо-подтверждение');
define('_ACA_REQ_CONFIRM_TIPS', 'Выберите "Да", если требуете от незарегистрировавшихся пользователей подтверждения их электронной почте.');
define('_ACA_SUB_SETTINGS', 'Настройки подписчика');
define('_ACA_SUBMESSAGE', 'Адрес для подписки');
define('_ACA_SUBSCRIBE_LIST', 'Подписаться на рассылку');

define('_ACA_USABLE_TAGS', 'Полезные тэги');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = создает кликабельную ссылку, пройдя по которой пользователь может подтвердить подписку. Эта опция <strong>необходима</strong>, чтобы Acajoom работал правильно.<br />'
.'<br />[NAME] = Это будет заменено на имя введенное подписчиком, При использовании этого, Вы будете рассылать письма, написанные непосредственно на имя подписчика.<br />'
.'<br />[FIRSTNAME] = Это будет заменено ИМЕНЕМ подписчика, за имя подписчика принимается первое из введенных имен.<br />');
define('_ACA_CONFIRMFROMNAME', 'Подтверждение, от:');
define('_ACA_CONFIRMFROMNAME_TIPS', 'Введите имя отправителя для показа в сообщениях подтверждения подписки.');
define('_ACA_CONFIRMFROMEMAIL', 'Подтверждение, с адреса:');
define('_ACA_CONFIRMFROMEMAIL_TIPS', 'Введите адрес для показа в сообщениях подтверждения подписки.');
define('_ACA_CONFIRMBOUNCE', 'E-mail адрес для уведомлений о несуществующих адресах');
define('_ACA_CONFIRMBOUNCE_TIPS', 'Введите адрес, который будет отображаться в сообщениях подтверждения подписки, и на который Вы хотели бы, чтобы поступали сообщения о несуществующих e-mail адресах подписчиков.');
define('_ACA_HTML_CONFIRM', 'HTML подтверждение');
define('_ACA_HTML_CONFIRM_TIPS', 'Выберите "Да", если Вы хотите отправлять сообщения подтверждения в формате HTML (если пользователь разрешил присылать ему такие письма).');
define('_ACA_TIME_ZONE_ASK', 'Спрашивать часовой пояс');
define('_ACA_TIME_ZONE_TIPS', 'Выберите "Да", если хотите запрашивать ввод часового пояса. Рассылки, находящиеся в очереди будут выполняться используя это значение.');

 // Настройки Хрона
 define('_ACA_AUTO_CONFIG', 'Хрон');
define('_ACA_TIME_OFFSET_URL', 'Нажмите здесь, чтобы установить расхождение в панели глобальной конфигурации - Локаль');
define('_ACA_TIME_OFFSET_TIPS', 'Установите временное смещение сервера, которое будет вписано в точную дату и время');
define('_ACA_TIME_OFFSET', 'Сдвиг времени');
define('_ACA_CRON_DESC','<br />Используя функцию Хрон, Вы можете установить автоматическую задачу, которая будет выполняться по расписанию, для Вашего сайта!<br />' .
		'Чтобы настроить это, Вам нужно добавить из панели управления в задачи по расписанию следующую команду:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Если вам понадобится помощь, то получить её можно на форуме разработчиков <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');

// установки отправки
define('_ACA_PAUSEX', 'Пауза x секунд после каждого сконфигурированного и заданного количества писем');
define('_ACA_PAUSEX_TIPS', 'Введите время в секундах, которое Acajoom будет давать Вашему SMTP серверу в качестве паузы между отправками заданного сконфигурированного количества писем.');
define('_ACA_EMAIL_BET_PAUSE', 'Письма между паузами');
define('_ACA_EMAIL_BET_PAUSE_TIPS', 'Количество писем для отправки до паузы.');
define('_ACA_WAIT_USER_PAUSE', 'Ждать ввода пользователем команды при паузе');
define('_ACA_WAIT_USER_PAUSE_TIPS', 'Должен ли скрипт при паузе ожидать ввода пользователем команды для отправки следующего пакета писем.');
define('_ACA_SCRIPT_TIMEOUT', 'Пауза скрипта');
define('_ACA_SCRIPT_TIMEOUT_TIPS', 'Количество минут, которое скрипт будет запущен (0 для снятия ограничения).');
// установки статистики
define('_ACA_ENABLE_READ_STATS', 'Разрешить вести статистику');
define('_ACA_ENABLE_READ_STATS_TIPS', 'Выберите Да, если Вы хотите сохранять количество просмотров. Данная статистика может вестись только для писем в формате HTML');
define('_ACA_LOG_VIEWSPERSUB', 'Записывать просмотры пользователя');
define('_ACA_LOG_VIEWSPERSUB_TIPS', 'Выберите Да, если Вы хотите сохранять количество просмотров выпусков рассылки отдельным подписчиком. Данная статистика может вестись только для писем в формате HTML');
// установки логов
define('_ACA_DETAILED', 'Детальные логи');
define('_ACA_SIMPLE', 'Упрощенные логи');
define('_ACA_DIAPLAY_LOG', 'Отображать логи');
define('_ACA_DISPLAY_LOG_TIPS', 'Выберите "Да", если хотите отображать логи в момент рассылки писем.');
define('_ACA_SEND_PERF_DATA', 'Отсылать статистику');
define('_ACA_SEND_PERF_DATA_TIPS', 'Выберите "Да", если Вы хотите разрешить, чтобы Acajoom отсылал АНОНИМНЫЕ сведения о конфигурации, количестве подписчиков и времени, которое занимает отправка сообщений. Это даст разработчикам идеи по улучшению работы компонента и поможет оптимизировать его в будущих релизах.');
define('_ACA_SEND_AUTO_LOG', 'Отправлять логи для автореспондера');
define('_ACA_SEND_AUTO_LOG_TIPS', 'Выберите Да, если Вы хотите, чтобы программа отправляла Вам сообщение каждый раз, когда обработан запрос. Предупреждение: это может привести к большому количеству сообщений в Вашем почтовом ящике.');
define('_ACA_SEND_LOG', 'Отправлять лог');
define('_ACA_SEND_LOG_TIPS', 'Должен ли быть лог отправки рассылки быть отправлен на почтовый адрес пользователя, который произвел рассылку.');
define('_ACA_SEND_LOGDETAIL', 'Отправлять детальные логи');
define('_ACA_SEND_LOGDETAIL_TIPS', 'Детальные логи включают в себя информацию об успешной или неудачной отправке сообщения каждому подписчику и обзор информации (статистику). Упрощенные отсылают только обзор.');
define('_ACA_SEND_LOGCLOSED', 'Отправлять лог, если соединение закрыто');
define('_ACA_SEND_LOGCLOSED_TIPS', 'С этой включенной опцией пользователь, производящий рассылку, получит отчет о рассылке по электронной почте.');
define('_ACA_SAVE_LOG', 'Сохранять лог');
define('_ACA_SAVE_LOG_TIPS', 'Должен ли лог отправки рассылки быть сохранен в файле лога');
define('_ACA_SAVE_LOGDETAIL', 'Сохранять детальный лог');
define('_ACA_SAVE_LOGDETAIL_TIPS', 'Детальные логи включают в себя информацию об успешной или неудачной отправке сообщения каждому подписчику и обзор информации (статистику). Упрощенные включают только обзор.');
define('_ACA_SAVE_LOGFILE', 'Сохранить файл лога');
define('_ACA_SAVE_LOGFILE_TIPS', 'Файл, в который записывается информация лога. Позднее этот файл может стать значительно больше.');
define('_ACA_CLEAR_LOG', 'Очистить лог');
define('_ACA_CLEAR_LOG_TIPS', 'Очистить файл лога.');

### панель управления
define('_ACA_CP_LAST_QUEUE', 'Последний обработанный запрос');
define('_ACA_CP_TOTAL', 'Всего');
define('_ACA_MAILING_COPY', 'Рассылка успешно скопирована!');

// разнообразные настройки
define('_ACA_SHOW_GUIDE', 'Показать руководство');
define('_ACA_SHOW_GUIDE_TIPS', 'Показывать руководство при старте программы, чтобы помочь новым пользователям создать новостную рассылку, настроить автореспондер и корректно настроить Acajoom.');
define('_ACA_AUTOS_ON', 'Использовать Автореспондеры');
define('_ACA_AUTOS_ON_TIPS', 'Выберите Нет, если Вы не хотите использовать автореспондеры, и опции автореспондеров будут деактивированы.');
define('_ACA_NEWS_ON', 'Использовать Новостные рассылки');
define('_ACA_NEWS_ON_TIPS', 'Выберите Нет, если Вы не хотите использовать новостные рассылки, и все их опции будут деактивированы.');
define('_ACA_SHOW_TIPS', 'Показывать советы');
define('_ACA_SHOW_TIPS_TIPS', 'Показать советы, чтобы помочь пользователям использовать Acajoom более эффективно.');
define('_ACA_SHOW_FOOTER', 'Показывать футер (footer)');
define('_ACA_SHOW_FOOTER_TIPS', 'Должно ли быть показано извещение об авторских правах.');
define('_ACA_SHOW_LISTS', 'Показывать список во фронтенде');
define('_ACA_SHOW_LISTS_TIPS', 'Показывать незарегистрированным пользователям список рассылок, на которые они могут подписаться с кнопкой перехода в архив подписки, или же просто форму регистрации, чтобы они могли зарегистрироваться.');
define('_ACA_CONFIG_UPDATED', 'Конфигурация была успешно обновлена!');
define('_ACA_UPDATE_URL', 'URL для обновлений');
define('_ACA_UPDATE_URL_WARNING', 'ВНИМАНИЕ! Не изменяйте этот URL, кроме случаев, когда Вас об этом просит техническая команда Acajoom.<br />');
define('_ACA_UPDATE_URL_TIPS', 'Пример: http://www.acajoom.com/update/ (Включая закрывающий слеш)');

// модуль
define('_ACA_EMAIL_INVALID', 'Введенный e-mail некорректен.');
define('_ACA_REGISTER_REQUIRED', 'Пожалуйста, зарегистрируйтесь на сайте перед тем, как Вы подпишетесь на рассылку.');

// блок уровней доступа
define('_ACA_OWNER', 'Создатель рассылки:');
define('_ACA_ACCESS_LEVEL', 'Установить уровень доступа к рассылке');
define('_ACA_ACCESS_LEVEL_OPTION', 'Опции доступа');
define('_ACA_USER_LEVEL_EDIT', 'Выберите, какая группа пользователей сможет редактировать рассылку по этому списку (как с фронтенда, так и с бэкенда)');

//  выпадающие опции
define('_ACA_AUTO_DAY_CH1', 'Ежедневно');
define('_ACA_AUTO_DAY_CH2', 'Ежедневно, кроме выходных');
define('_ACA_AUTO_DAY_CH3', 'По дням недели');
define('_ACA_AUTO_DAY_CH4', 'По дням недели, кроме праздников');
define('_ACA_AUTO_DAY_CH5', 'Еженедельно');
define('_ACA_AUTO_DAY_CH6', 'Раз в две недели');
define('_ACA_AUTO_DAY_CH7', 'Ежемесячно');
define('_ACA_AUTO_DAY_CH9', 'Ежегодно');
define('_ACA_AUTO_OPTION_NONE', 'Нет');
define('_ACA_AUTO_OPTION_NEW', 'Новые Подписчики');
define('_ACA_AUTO_OPTION_ALL', 'Все Подписчики');

//
define('_ACA_UNSUB_MESSAGE', 'Письмо об аннулировании подписки');
define('_ACA_UNSUB_SETTINGS', 'Установки аннулирования подписки');
define('_ACA_AUTO_ADD_NEW_USERS', 'Автоподписка пользователей?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', 'Нет возможных обновлений.');
define('_ACA_VERSION', 'Версия Acajoom');
define('_ACA_NEED_UPDATED', 'Файлы, которые необходимо заменить на новые:');
define('_ACA_NEED_ADDED', 'Файлы, которые необходимо добавить:');
define('_ACA_NEED_REMOVED', 'Файлы, которые необходимо удалить:');
define('_ACA_FILENAME', 'Имя файла:');
define('_ACA_CURRENT_VERSION', 'Текущая версия:');
define('_ACA_NEWEST_VERSION', 'Последняя версия:');
define('_ACA_UPDATING', 'Идет обновление');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', 'Файлы были успешно обновлены.');
define('_ACA_UPDATE_FAILED', 'Не удалось обновить!');
define('_ACA_ADDING', 'Идет добавление');
define('_ACA_ADDED_SUCCESSFULLY', 'Добавление прошло успешно.');
define('_ACA_ADDING_FAILED', 'Не удалось добавить!');
define('_ACA_REMOVING', 'Идет удаление');
define('_ACA_REMOVED_SUCCESSFULLY', 'Удаление прошло успешно.');
define('_ACA_REMOVING_FAILED', 'Не удалось удалить!');
define('_ACA_INSTALL_DIFFERENT_VERSION', 'Проинсталлируйте другую версию');
define('_ACA_CONTENT_ADD', 'Добавить содержимое');
define('_ACA_UPGRADE_FROM', 'Импорт информации (выпусков рассылок и подписчиков) из: ');
define('_ACA_UPGRADE_MESS', 'Нет никакого риска потерять Ваши существующие данные. <br /> Этот процесс просто импортирует информацию в базу данных Acajoom.');
define('_ACA_CONTINUE_SENDING', 'Продолжить отправку');

// сообщения Acajoom
define('_ACA_UPGRADE1', 'Вы можете легко импортировать своих подписчиков и сообщения из ');
define('_ACA_UPGRADE2', ' в Acajoom через панель обновлений.');
define('_ACA_UPDATE_MESSAGE', 'Доступна новая версия Acajoom! ');
define('_ACA_UPDATE_MESSAGE_LINK', 'Нажмите здесь для обновления!');
define('_ACA_THANKYOU', 'Спасибо Вам за использование Acajoom, Вашего коммуникационного партнера!');
define('_ACA_NO_SERVER', 'Сервер обновлений недоступен, пожалуйста, попробуйте позднее.');
define('_ACA_MOD_PUB', 'Модуль Acajoom не опубликован.');
define('_ACA_MOD_PUB_LINK', 'Нажмите здесь для его публикации!');
define('_ACA_IMPORT_SUCCESS', 'успешно импортировано');
define('_ACA_IMPORT_EXIST', 'подписчик уже существует в базе');

// Мастер Acajoom
define('_ACA_GUIDE', ' мастер');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom имеет много опций, и этот Мастер проведет Вас в четыре простых шага к тому, чтобы Вы смогли начать отправлять Ваши почтовые рассылки и пользоваться автореспондерами!<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', 'Во-первых, Вам нужно создать список рассылки. Список может быть двух типов, новостная рассылка или автореспондер.' .
		'  В настройках списка Вы можете установить различные параметры для Ваших новостных рассылок или автореспондеров: имя отправителя, стиль, приветственные сообщения подписчикам и так далее...
<br /><br />Вы можете настроить свой первый список подписки здесь: <a href="index2.php?option=com_acajoom&act=list">создать лист</a> и нажмите кнопку Новый (New).');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom предоставляет Вам легкий способ импортировать всю информацию из Вашей предыдущей системы почтовых рассылок.<br />' .
		' Откройте панель Обновлений и выберите Вашу предыдущую систему почтовых рассылок, чтобы импортировать из нее все выпуски рассылки и подписчиков.<br /><br />' .
		'<span style="color:#FF5E00;" >ВАЖНО: импорт безопасен и не может повредить или удалить информацию из Вашей предыдущей системы</span><br />' .
		'После импортирования Вы сможете управлять Вашими подписчиками и рассылками непосредственно в Acajoom.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', 'Великолепно! Ваш первый список создан! Теперь Вы можете создать свои первые %s. Чтобы создать их, пройдите: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', 'Управление автореспондерами');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', 'Управление рассылками');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', ' и выберите Ваше %s. <br /> Затем выберите Ваше %s из выпадающего меню. Создайте Ваше первое письмо, кликнув на Новый (New) ');
define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', 'До отправки вашей первой рассылки, возможно, Вам следует проверить почтовые настройки  ' .
		'Пройдите по ссылке <a href="index2.php?option=com_acajoom&act=configuration" >конфигурации</a>, чтобы проверить почтовые настройки. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />Когда Вы будете готовы, вернитесь в меню Почтовых рассылок, выберите Ваше письмо и нажмите Отправить');
define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', 'Для Ваших автореспондеров, во-первых, Вам нужно установить Задачу по расписанию (хрон) на Вашем сервере. ' .
		' Пожалуйста, откройте вкладку Задач по расписанию (Хрона) в панели конфигурации.' .
		' <a href="index2.php?option=com_acajoom&act=configuration">нажмите здесь</a> чтобы узнать больше об установке задачи по расписанию (хронов). <br />');
define('_ACA_GUIDE_MODULE', ' <br />Также удостоверьтесь в том, что Вы опубликовали модуль Acajoom и посетители могут подписаться на рассылку.');
define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' Также вы можете настроить автореспондер.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' Также Вы можете настроить почтовую рассылку.');
define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />Вуа-ля! Теперь Вы готовы эффективно взаимодействовать с Вашими посетителями и пользователями. Работа этого мастера будет завершена, как только Вы отправите свою вторую рассылку, или Вы можете отключить его в <a href="index2.php?option=com_acajoom&act=configuration" >панели конфигурации</a>.' .
		'<br /><br />  Если у Вас появились вопросы при использовании Acajoom, пожалуйста, обращайтесь на ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >форум</a>. ' .
		' Также Вы найдете массу информации о том, как эффективно взаимодействовать с Вашими подписчиками, здесь <a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a>.' .
		'<p /><br /><b>Спасибо Вам за использование Acajoom. Ваш коммуникационный партнер!</b> ');
define('_ACA_GUIDE_TURNOFF', 'Мастер теперь отключен!');
define('_ACA_STEP', 'ШАГ ');

// установка Acajoom
define('_ACA_INSTALL_CONFIG', 'Конфигурация Acajoom');
define('_ACA_INSTALL_SUCCESS', 'Установка успешна');
define('_ACA_INSTALL_ERROR', 'Ошибка установки');
define('_ACA_INSTALL_BOT', 'Плагин (Бот) Acajoom ');
define('_ACA_INSTALL_MODULE', 'Модуль Acajoom');
//Другое
define('_ACA_JAVASCRIPT','!Внимание! Javascript должен быть включен для корректной работы.');
define('_ACA_EXPORT_TEXT','Подписчики экспортируются на основе выбранного Вами списка.<br />Экспорт подписчиков из списка');
define('_ACA_IMPORT_TIPS','Импорт подписчиков. Информация в импортируемом файле должна быть в следующем формате: <br />' .
		'Имя,email,получатьHTML(1/0),<span style="color: rgb(255, 0, 0);">подтвержден(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', 'уже является подписчиком');
define('_ACA_GET_STARTED', 'Нажмите здесь, чтобы начать!');

//Новое, начиная с 1.0.1
define('_ACA_WARNING_1011','Предупреждение: 1011: Обновления не будут работать из-за ограничений на Вашем сервере.');
define('_ACA_SEND_MAIL_FROM_TIPS', 'Выберите, какой email адрес будет показываться как адрес отправителя.');
define('_ACA_SEND_MAIL_NAME_TIPS', 'Выберите, какое имя будет показываться как имя отправителя.');
define('_ACA_MAILSENDMETHOD_TIPS', 'Выберите метод отправки почты: почтовая функция PHP<span>Sendmail</span> или SMTP сервер.');
define('_ACA_SENDMAILPATH_TIPS', 'Это директория почтового сервера');
define('_ACA_LIST_T_TEMPLATE', 'Шаблон');
define('_ACA_NO_MAILING_ENTERED', 'Не выбрана рассылка');
define('_ACA_NO_LIST_ENTERED', 'Не выбран список');
define('_ACA_SENT_MAILING' , 'Отправленные рассылки');
define('_ACA_SELECT_FILE', 'Выберите файл для ');
define('_ACA_LIST_IMPORT', 'Выберите списки, с которыми Вы хотели бы проассоциировать своих подписчиков');
define('_ACA_PB_QUEUE', 'Подписчик добавлен, но возникла проблема при присоедии его к списку(-ам). Пожалуйста, проверьте вручную.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , 'Настоятельно рекомендуется обновить!');
define('_ACA_UPDATE_MESS2' , 'Патчи и маленькие доделки.');
define('_ACA_UPDATE_MESS3' , 'Новый релиз.');
define('_ACA_UPDATE_MESS5' , 'Joomla 1.5 необходима для обновления.');
define('_ACA_UPDATE_IS_AVAIL' , ' доступен!');
define('_ACA_NO_MAILING_SENT', 'Нет отправленных рассылок!');
define('_ACA_SHOW_LOGIN', 'Показывать форму логина');
define('_ACA_SHOW_LOGIN_TIPS', 'Выберите Да, чтобы показывать форму авторизации во фронтенде панели управления Acajoom, чтобы пользователь мог зарегистрироваться на сайте.');
define('_ACA_LISTS_EDITOR', 'Редактор описания списка');
define('_ACA_LISTS_EDITOR_TIPS', 'Выберите Да, чтобы использовать HTML-редактор для редактирования поля описания списка.');
define('_ACA_SUBCRIBERS_VIEW', 'Просмотр подписчиков');

//Новое, начиная с 1.0.2
define('_ACA_FRONTEND_SETTINGS' , 'Настройки фронтенда' );
define('_ACA_SHOW_LOGOUT', 'Показывать кнопку выхода');
define('_ACA_SHOW_LOGOUT_TIPS', 'Выберите Да, чтобы показывать кнопку выхода во фронтенде панели управления Acajoom.');

//Новое, начиная с 1.0.3, CB интеграция

define('_ACA_CONFIG_INTEGRATION', 'Интеграция');
define('_ACA_CB_INTEGRATION', 'Интеграция с Community Builder');
define('_ACA_INSTALL_PLUGIN', 'Плагин для Community Builder (Интеграция с Acajoom) ');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', 'Плагин Acajoom для Community Builder еще не установлен!');
define('_ACA_CB_PLUGIN', 'Списки при регистрации');
define('_ACA_CB_PLUGIN_TIPS', 'Выберите Да, чтобы показывать перечень Списков в форме регистрации Community Builder');
define('_ACA_CB_LISTS', 'Идентификаторы Списков');
define('_ACA_CB_LISTS_TIPS', 'ЭТО ПОЛЕ ОБЯЗАТЕЛЬНО ДЛЯ ЗАПОЛНЕНИЯ. Введите через запятую номера id Списков, которые должны видеть пользователи при регистрации для подписки на них,  (При установке поля в 0 будут показаны все списки)');
define('_ACA_CB_INTRO', 'Текст приветствия');
define('_ACA_CB_INTRO_TIPS', 'Текст, который появится до перечня возможных подписок. ОСТАВЬТЕ ПУСТЫМ, ЕСЛИ НИЧЕГО НЕ ХОТИТЕ ПОКАЗЫВАТЬ. Вы можете использовать тэги HTML для изменения внешнего вида текста.');
define('_ACA_CB_SHOW_NAME', 'Показывать название Списка');
define('_ACA_CB_SHOW_NAME_TIPS', 'Выберите, показывать или нет название Списка(ов) после приветствия.');
define('_ACA_CB_LIST_DEFAULT', 'Список выбран по умолчанию?');
define('_ACA_CB_LIST_DEFAULT_TIPS', 'Выберите, должен ли чекбокс уже быть отмечен для каждого Списка по умолчанию.');
define('_ACA_CB_HTML_SHOW', 'Показывать "Получать HTML"');
define('_ACA_CB_HTML_SHOW_TIPS', 'Установите "Да", чтобы позволить пользователям выбирать, хотят ли они получать рассылку в формате HTML. Установите Нет, чтобы подписчики получали HTML по умолчанию.');
define('_ACA_CB_HTML_DEFAULT', 'Получать HTML по умолчанию');
define('_ACA_CB_HTML_DEFAULT_TIPS', 'Отметьте эту опцию, чтобы показывать "Получение HTML" пользователями по умолчанию. Если показывать "Получать HTML" установлено в Нет, тогда эта опция будет включена по умолчанию.');

// Новое, начиная с 1.0.4
define('_ACA_BACKUP_FAILED', 'Не удалось создать бэкап файла! Файл не заменен.');
define('_ACA_BACKUP_YOUR_FILES', 'Старые версии файлов были сохранены в папку:');
define('_ACA_SERVER_LOCAL_TIME', 'Локальное время сервера');
define('_ACA_SHOW_ARCHIVE', 'Показывать кнопку Архив');
define('_ACA_SHOW_ARCHIVE_TIPS', 'Выберите ДА, чтобы показывать кнопку Архив во фронтенде перечня рассылок');
define('_ACA_LIST_OPT_TAG', 'Тэги');
define('_ACA_LIST_OPT_IMG', 'Изображения');
define('_ACA_LIST_OPT_CTT', 'Контент');
define('_ACA_INPUT_NAME_TIPS', 'Введите имя и фамилию (Имя первым, пожалуйста)');
define('_ACA_INPUT_EMAIL_TIPS', 'Введите Ваш email адрес (Вводите, пожалуйста, существующий и работающий адрес)');
define('_ACA_RECEIVE_HTML_TIPS', 'Выберите Да, если Вы хотели бы получать рассылку в формате HTML (это будет использовать чуть больше трафика, но Ваши письма будут приятно оформлены) или Нет, чтобы получать рассылку только в текстовом формате');
define('_ACA_TIME_ZONE_ASK_TIPS', 'Выберите Ваш часовой пояс.');

// Новое, начиная с 1.0.5
define('_ACA_FILES' , 'Файлы');
define('_ACA_FILES_UPLOAD' , 'Загрузки');
define('_ACA_MENU_UPLOAD_IMG' , 'Загрузки картинок');
define('_ACA_TOO_LARGE' , 'Размер файла превышает допустимый. Максимальный разрешенный размер файла');
define('_ACA_MISSING_DIR' , 'Директория назначения не существует');
define('_ACA_IS_NOT_DIR' , 'Директория назначения не существует или является файлом.');
define('_ACA_NO_WRITE_PERMS' , 'Директория назначения не имеет прав записи.');
define('_ACA_NO_USER_FILE' , 'Вы не выбрали ни одного файла для загрузки.');
define('_ACA_E_FAIL_MOVE' , 'Невозможно переместить файл.');
define('_ACA_FILE_EXISTS' , 'Такой файл уже существует на сервере.');
define('_ACA_CANNOT_OVERWRITE' , 'Такой файл уже существует и не может быть перезаписан.');
define('_ACA_NOT_ALLOWED_EXTENSION' , 'Расширение файла не входит в список разрешенных');
define('_ACA_PARTIAL' , 'Файл загружен лишь частично.');
define('_ACA_UPLOAD_ERROR' , 'Ошибка загрузки:');
define('DEV_NO_DEF_FILE' , 'Файл был загружен лишь частично.');

// уже существует, но изменен: добавлен <br/> в первой строке и строка про [SUBSCRIPTIONS]
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = Это будет заменено линками на подписку.' .
		' Это <strong>требуется</strong> , чтобы Acajoom работал корректно.<br />' .
		'Если Вы расположите любой другой контент в этом окне, это будет отображаться во всех письмах, направленных этому Списку.' .
		' <br />Добавьте Ваш текст для приветственного письма при подписке в конец. Acajoom автоматически добавит линки для подписчиков на изменение их информации и аннулирование подписки.');

// Новое, начиная с 1.0.6
define('_ACA_NOTIFICATION', 'Уведомление');  // ссылка на Email уведомление
define('_ACA_NOTIFICATIONS', 'Уведомления');
define('_ACA_USE_SEF', 'SEF в рассылках');
define('_ACA_USE_SEF_TIPS', 'Рекомендуется выбирать Нет. Если Вы все-таки хотите, чтобы URL-ы, включенные в Ваши рассылки, использовали SEF, тогда выбирайте Да.' .
		' <br /><b>Ссылки будут работать одинаково при разных условиях. Так Вы можете быть уверены, что пользователь, кликнув по линку в письме любой давности, попадет к Вам на сайт, даже если вы измените Вашу SEF структуру.</b> ');
define('_ACA_ERR_NB' , 'Ошибка #: ERR');
define('_ACA_ERR_SETTINGS', 'Установки отчетов об ошибках');
define('_ACA_ERR_SEND' ,'Отправлять отчет об ошибках');
define('_ACA_ERR_SEND_TIPS' ,'Если Вы хотите помочь Acajoom стать лучше, пожалуйста, выберите Да. Это включает функцию "отправить отчет об ошибках разработчику", то есть Вам даже на придется спрашивать на форуме о способе устранения бага ;-) <br /> <b>ЛИЧНАЯ ИНФОРМАЦИЯ НЕ ОТПРАВЛЯЕТСЯ</b>.  Мы даже не знаем, с каких сайтов поступают такие отчеты. Отправляется только информация об Acajoom , настройках PHP и запросах SQL . ');
define('_ACA_ERR_SHOW_TIPS' ,'Выберите Да, чтобы показывать номер ошибки на экране. Используется для целей дебагга скрипта. ');
define('_ACA_ERR_SHOW' ,'Показывать ошибки');
define('_ACA_LIST_SHOW_UNSUBCRIBE', 'Показывать линки аннулирования подписки');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', 'Выберите Да для показа ссылок аннулирования подписки внизу писем, чтобы подписчики смогли изменить статус их подписки. <br /> Нет  отключает футер и ссылки.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">ВАЖНОЕ СООБЩЕНИЕ!</span> <br />Если Вы обновляетесь с предыдущей версии Acajoom, Вам следует обновить структуру базу данных, кликнув по этой кнопке (Ваша информация останется в целости)');
define('_ACA_UPDATE_INSTALL_BTN' , 'Обновить таблицы и конфигурацию');
define('_ACA_MAILING_MAX_TIME', 'Максимальное время очереди' );
define('_ACA_MAILING_MAX_TIME_TIPS', 'Установите максимальное время для каждого комплекта писем, рассылаемых по очереди. Рекомендуется устанавливать между 30 секундами и 2 минутами.');

// virtuemart интеграция beta
define('_ACA_VM_INTEGRATION', 'Интеграция с VirtueMart ');
define('_ACA_VM_COUPON_NOTIF', 'ID извещения о Купоне');
define('_ACA_VM_COUPON_NOTIF_TIPS', 'Установите ID письма, которое Вы хотите использовать, чтобы разослать Купоны Вашим клиентам.');
define('_ACA_VM_NEW_PRODUCT', 'ID извещения о новых продуктах');
define('_ACA_VM_NEW_PRODUCT_TIPS', 'Установите ID письма, которое Вы хотите использовать, чтобы разослать извещение о новых продуктах Вашим клиентам.');

// Новое, начиная с 1.0.8
// создать формы для подписки
define('_ACA_FORM_BUTTON', 'Создать форму');
define('_ACA_FORM_COPY', 'HTML код');
define('_ACA_FORM_COPY_TIPS', 'Скопируйте сгенерированный HTML код на Вашу HTML страницу.');
define('_ACA_FORM_LIST_TIPS', 'Выберите Список, который Вы хотите включить в форму');
// обновить сообщения
define('_ACA_UPDATE_MESS4' , 'Не может быть обновлено автоматически');
define('_ACA_WARNG_REMOTE_FILE' , 'Удаленный файл недоступен.');
define('_ACA_ERROR_FETCH' , 'Ошибка fetching файла.');

define('_ACA_CHECK' , 'Проверить');
define('_ACA_MORE_INFO' , 'Подробнее');
define('_ACA_UPDATE_NEW' , 'Обновить до последней версии');
define('_ACA_UPGRADE' , 'Обновить до более новой версии');
define('_ACA_DOWNDATE' , 'Восстановить прежнюю версию');
define('_ACA_DOWNGRADE' , 'Обратно к первой версии');
define('_ACA_REQUIRE_JOOM' , 'Требовать Joomla');
define('_ACA_TRY_IT' , 'Сделай это!');
define('_ACA_NEWER', 'Более новая');
define('_ACA_OLDER', 'Более старая');
define('_ACA_CURRENT', 'Текущая');

// Новое, начиная с 1.0.9
define('_ACA_CHECK_COMP', 'Попробовать один из других компонентов');
define('_ACA_MENU_VIDEO' , 'Видео пособия');
define('_ACA_SCHEDULE_TITLE', 'Настройки автоматической функции планирования');
define('_ACA_ISSUE_NB_TIPS' , 'Получить число, автоматически сгенерированное системой' );
define('_ACA_SEL_ALL' , 'Все рассылки');
define('_ACA_SEL_ALL_SUB' , 'Все списки');
define('_ACA_INTRO_ONLY_TIPS' , 'Если вы всавите только вступление статьи, в письмо будет вставлена ссылка "Подробнее...", ведущая на полный разворот статьи на вашем сайте.' );
define('_ACA_TAGS_TITLE' , 'Тэг статьи');
define('_ACA_TAGS_TITLE_TIPS' , 'Скопируйте и вставьте этот тэг в письмо в то место, в которое хотите.');
define('_ACA_PREVIEW_EMAIL_TEST', 'Укажите email, на который уйдет тестовое письмо');
define('_ACA_PREVIEW_TITLE' , 'Просмотр');
define('_ACA_AUTO_UPDATE' , 'Уведомление о новых версиях');
define('_ACA_AUTO_UPDATE_TIPS' , 'Выберите "Да", если Вы хотите знать о новых версиях компонента. <br />ВАЖНО!! Настройка "Показывать советы" необходима для работы этой функции.');

// Новое, начиная с 1.1.0
define('_ACA_LICENSE' , 'Лицензионное соглашение');

// Новое, начиная с 1.1.1
define('_ACA_NEW' , 'Новое');
define('_ACA_SCHEDULE_SETUP', 'Для рассылки с помощью автореспондеров, в концигурациях должен быть установлен планировщик.');
define('_ACA_SCHEDULER', 'Планировщик');
define('_ACA_ACAJOOM_CRON_DESC' , 'если у Вас нет доступа к панели управления Хронами вашего сайта, Вы можете зарегистрировать бесплатный учетную запись Хрона Acajoom:' );
define('_ACA_CRON_DOCUMENTATION' , 'Вы можете найти дополнительную информацию по настройкам Планировщика Acajoom по следующему адресу:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , 'Очередь успешно выполнена...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , 'Ошибка перемещения импортируемого файла' );

//Новое, начиная с 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , 'Частота работы планировщика' );
define( '_ACA_CRON_MAX_FREQ' , 'Максимальная частота работы планировщика' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , 'Определяет максимальную частоту, с которой планировщик будет запускаться (в минутах). Является ограничением планировщика, даже если задание хрона запускается чаще.' );
define( '_ACA_CRON_MAX_EMAIL' , 'Максимальное число писем за раз' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , 'Определяет максимальное количество писем, рассылаемых за раз (0 - неограниченно).' );
define( '_ACA_CRON_MINUTES' , ' минут(-ы)' );
define( '_ACA_SHOW_SIGNATURE' , 'Показывать низ (footer) письма' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , 'Хотите ли вы установить внизу письма ссылку на Acajoom.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , 'Работа автореспондера прошла успешно...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , 'Почтовая рассылка прошла успешно...' );
define( '_ACA_MENU_SYNC_USERS' , 'Синхронизировать данные пользователей в базе данных' );
define( '_ACA_SYNC_USERS_SUCCESS' , 'Синхронизация данных пользователей прошла успешно!' );

// совместимость с Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Выйти' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'Да' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'Нет' );
if (!defined('_HI')) define( '_HI', 'Привет' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'Вверх' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'Вниз' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'Logout' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , 'Если вы выберите, то в письмо добавится только заголовок статьи в виде ссылки на полный разворот статьи на вашем сайте.');
define('_ACA_TITLE_ONLY' , 'Только заголовок');
define('_ACA_FULL_ARTICLE_TIPS' , 'Если вы выберите, то статья полностью добавиться в письмо');
define('_ACA_FULL_ARTICLE' , 'Вся статья');
define('_ACA_CONTENT_ITEM_SELECT_T', 'Выберите статью, которую Вы хотите добавить в письмо. <br />Скопируйте и вставьте <b>тэг статьи</b> в тело письма.  Вы можете выбрать, в каком виде ее вставлять: весь текст, только вступление или только заголовок-ссылку (0, 1 или 2 соответственно). ');
define('_ACA_SUBSCRIBE_LIST2', 'Список(ки) рассылки');

// Функция умной рассылки
define('_ACA_AUTONEWS', 'Умная рассылка');
define('_ACA_MENU_AUTONEWS', 'Умные рассылки');
define('_ACA_AUTO_NEWS_OPTION', 'Настройки умной рассылки');
define('_ACA_AUTONEWS_FREQ', 'Частота рассылки');
define('_ACA_AUTONEWS_FREQ_TIPS', 'Определяет частоту, с которой вы хотите производить умные рассылки.');
define('_ACA_AUTONEWS_SECTION', 'Раздел статей');
define('_ACA_AUTONEWS_SECTION_TIPS', 'Определяет раздел, из которого будут браться статьи для рассылки.');
define('_ACA_AUTONEWS_CAT', 'Категория статей');
define('_ACA_AUTONEWS_CAT_TIPS', 'Определяет категорию, из которой будут браться статьи для рассылки. (Все из всех тех статей в указанном разделе).');
define('_ACA_SELECT_SECTION', 'Выберите раздел');
define('_ACA_SELECT_CAT', 'Все категории');
define('_ACA_AUTO_DAY_CH8', 'Quaterly');
define('_ACA_AUTONEWS_STARTDATE', 'Дата начала');
define('_ACA_AUTONEWS_STARTDATE_TIPS', 'Определяет дату, с которой начинают производиться умные рассылки.');
define('_ACA_AUTONEWS_TYPE', 'Представление статьи');// каким мы увидим статьи, вставленные в письма
define('_ACA_AUTONEWS_TYPE_TIPS', 'Полная статья: будет вставлять всю статью в рассылку.<br />' .
		'Только вступление: будет вставлять только вступление статьи в рассылку.<br/>' .
		'Только заголовок: будет вставлять только заголовок в рассылку.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = Этот тэг будет заменен быстрой рассылкой.' );

//Новое, начиная с 1.1.3
define('_ACA_MALING_EDIT_VIEW', 'Создание / Просмотр писем');
define('_ACA_LICENSE_CONFIG' , 'Лицензия' );
define('_ACA_ENTER_LICENSE' , 'Ввести лицензию');
define('_ACA_ENTER_LICENSE_TIPS' , 'Введите ваш номер лицензии и сохраните его.');
define('_ACA_LICENSE_SETTING' , 'Настройки лицензии' );
define('_ACA_GOOD_LIC' , 'Ваша лизензия корректна!' );
define('_ACA_NOTSO_GOOD_LIC' , 'Ваша лицензия корректна: ' );
define('_ACA_PLEASE_LIC' , 'Пожалуйста, свяжитесь с Acajoom, чтобы обновить свою лицензиию ( license@acajoom.com ).' );
define('_ACA_DESC_PLUS', 'Acajoom Plus - первый компонент автоматической рассылки для  Joomla CMS.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO - самый мощный компонент - система рассылки для Joomla CMS.  ' . _ACA_FEATURES );

//Новое, начиная с 1.1.4
define('_ACA_ENTER_TOKEN' , 'Введите номер талона');
define('_ACA_ENTER_TOKEN_TIPS' , 'Введите номер талона, который вы получили при покупке Acajoom. ');
define('_ACA_ACAJOOM_SITE', 'Сайт Acajoom:');
define('_ACA_MY_SITE', 'Мой сайт:');
define( '_ACA_LICENSE_FORM' , ' ' .
 		'Лицензия.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , 'Пожалуйста, очистите поле лицензии.<br />  Если проблемы продолжают взникать, ' );
define( '_ACA_LICENSE_SUPPORT' , 'Если вы до сих пор имете вопросы, ' . _ACA_PLEASE_LIC );
define( '_ACA_LICENSE_TWO' , 'Вы можете получить Ваше лицензионное руководство, введя номер талона и адрес сайта URL (который подсвечен зеленым вверху страницы) в лицензионной форме. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );
define('_ACA_ENTER_TOKEN_PATIENCE', 'После сохранения вашего номера лицензия автоматически сгенерируется. ' .
		' Обычно купон действителен в течение 2-х минут.  Однако, в некоторых случаях он может быть продлен до 15 минут.<br />' .
		'<br />Вернитесь обратно в панель управления через несколько минут.  <br /><br />' .
		'Если вы не получили верный лицензионный ключ в течение 15 минут, '. _ACA_LICENSE_TWO);
define( '_ACA_ENTER_NOT_YET' , 'Ваш номер еще не действителен.');
define( '_ACA_UPDATE_CLICK_HERE' , 'Пожалуйста, посетите <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a>, чтобы скачать последнюю версию.');
define( '_ACA_NOTIF_UPDATE' , 'Чтобы узнавать о последних обновлениях, введите свой электронный ящик и нажмите Подписаться ');

define('_ACA_THINK_PLUS', 'Если Вы хотите большего от вашей системы рассылки, подумайте о Plus!');
define('_ACA_THINK_PLUS_1', 'Автореспонседоры');
define('_ACA_THINK_PLUS_2', 'Планируйте отправку ваших рассылок предопределённой датой');
define('_ACA_THINK_PLUS_3', 'Нет ограничений со стороны сервера');
define('_ACA_THINK_PLUS_4', 'и многое другое...');


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
define('_ACA_REGWARN_NAME','Пожалуйста, введите Ваше настоящее имя.');
define('_ACA_REGWARN_MAIL','Пожалуйста, введите правильно адрес e-mail.');

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
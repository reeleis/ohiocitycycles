<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');

/**
* <p>Traditional Chinese language file</p>
* @author Mike Ho <mikeho1980@hotmail.com>
* @version $Id: traditional_chinese.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.dogneighbor.com
*/

#######    NOTE TO TRANSLATORS  #######
# If you wish to translate the language file to your own language, please feel free to do so
# We would apprecaite if you could send you translation to the specified email
# so that other people could benefit from your contribution
# If you feel that the file is too long feel free to do as much as you want and probably
# someone else will be happy to pick up were you stopped.
#  We did our bestt to organize the subject by order of priority so start at the top
# If you update your translation please send you updates to translation@acajoom.com
# IMPORTANT: make sure respect as much as posible the punctionation and spacing because
# sometimes the word constant are conbined...
# Don't ever remove a define as it will create an error in the code.
# when using apostrophy  '   add a back-slash before like this:  \'  otherwise it will create an error.
# sometimes you will see html tag in the define, please leave it the way it is.

# DONT FORGET if you want to be credited fro your work, make sure to change the credit
# with your name and email if you want people to contact you otherwise leave the email as it is.
# We will use that information to also include you into the About section of the component
# Thank you very much for your contribution translating in your language

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', 'Acajoom 是一件讓你有效地和你的用戶及客戶通訊的郵寄名單, 電子報, 自動應答, 及跟進工具.' .
		'Acajoom, 你的通訊拍檔！');
define('_ACA_FEATURES', 'Acajoom, 你的通訊拍檔！');

// Type of lists
define('_ACA_NEWSLETTER', '電子報');
define('_ACA_AUTORESP', '自動應答');
define('_ACA_AUTORSS', '自動 RSS');
define('_ACA_ECARD', '電子卡');
define('_ACA_POSTCARD', '明信片');
define('_ACA_PERF', '效能');
define('_ACA_COUPON', '優惠券');
define('_ACA_CRON', '排程工作');
define('_ACA_MAILING', '郵件');
define('_ACA_LIST', '清單');

 //acajoom Menu
define('_ACA_MENU_LIST', '清單');
define('_ACA_MENU_SUBSCRIBERS', '訂閱者');
define('_ACA_MENU_NEWSLETTERS', '電子報');
define('_ACA_MENU_AUTOS', '自動應答');
define('_ACA_MENU_COUPONS', '優惠券');
define('_ACA_MENU_CRONS', '排程工作');
define('_ACA_MENU_AUTORSS', '自動-RSS');
define('_ACA_MENU_ECARD', '電子卡');
define('_ACA_MENU_POSTCARDS', '明信片');
define('_ACA_MENU_PERFS', '效能');
define('_ACA_MENU_TAB_LIST', '清單');
define('_ACA_MENU_MAILING_TITLE', '郵件');
define('_ACA_MENU_MAILING' , '郵件於');
define('_ACA_MENU_STATS', '統計');
define('_ACA_MENU_STATS_FOR', '統計於');
define('_ACA_MENU_CONF', '設定');
define('_ACA_MENU_UPDATE', '更新');
define('_ACA_MENU_ABOUT', '關於');
define('_ACA_MENU_LEARN', '教育中心');
define('_ACA_MENU_MEDIA', '媒體管理員');
define('_ACA_MENU_HELP', '說明');
define('_ACA_MENU_CPANEL', '控制台');
define('_ACA_MENU_IMPORT', '匯入');
define('_ACA_MENU_EXPORT', '匯出');
define('_ACA_MENU_SUB_ALL', '全部訂閱');
define('_ACA_MENU_UNSUB_ALL', '取消全部訂閱');
define('_ACA_MENU_VIEW_ARCHIVE', '封存');
define('_ACA_MENU_PREVIEW', '預覽');
define('_ACA_MENU_SEND', '發送');
define('_ACA_MENU_SEND_TEST', '發送測試電郵');
define('_ACA_MENU_SEND_QUEUE', '指令佇列');
define('_ACA_MENU_VIEW', '檢視');
define('_ACA_MENU_COPY', '複製');
define('_ACA_MENU_VIEW_STATS' , '檢視統計');
define('_ACA_MENU_CRTL_PANEL' , ' 控制台');
define('_ACA_MENU_LIST_NEW' , ' 建立清單');
define('_ACA_MENU_LIST_EDIT' , ' 編輯清單');
define('_ACA_MENU_BACK', '返回');
define('_ACA_MENU_INSTALL', '安裝');
define('_ACA_MENU_TAB_SUM', '概覽');
define('_ACA_STATUS' , '狀況');

// messages
define('_ACA_ERROR' , ' 發生了錯誤! ');
define('_ACA_SUB_ACCESS' , '存取權限');
define('_ACA_DESC_CREDITS', '製作人員');
define('_ACA_DESC_INFO', '資訊');
define('_ACA_DESC_HOME', '首頁');
define('_ACA_DESC_MAILING', '郵件清單');
define('_ACA_DESC_SUBSCRIBERS', '訂閱者');
define('_ACA_PUBLISHED','已發佈');
define('_ACA_UNPUBLISHED','未發佈');
define('_ACA_DELETE','刪除');
define('_ACA_FILTER','過濾器');
define('_ACA_UPDATE','更近');
define('_ACA_SAVE','儲存');
define('_ACA_CANCEL','取消');
define('_ACA_NAME','名稱');
define('_ACA_EMAIL','電郵');
define('_ACA_SELECT','選擇');
define('_ACA_ALL','全部');
define('_ACA_SEND_A', '發送一封 ');
define('_ACA_SUCCESS_DELETED', ' 已成功刪除');
define('_ACA_LIST_ADDED', '清單已成功建立');
define('_ACA_LIST_COPY', '清單已成功複製');
define('_ACA_LIST_UPDATED', '清單已成功更新');
define('_ACA_MAILING_SAVED', '郵件已成功儲存.');
define('_ACA_UPDATED_SUCCESSFULLY', '已成功更新.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', '訂閱者資訊');
define('_ACA_VERIFY_INFO', '請確定你傳送的連結，一些資訊缺失了.');
define('_ACA_INPUT_NAME', '名稱');
define('_ACA_INPUT_EMAIL', '電郵');
define('_ACA_RECEIVE_HTML', '接收 HTML？');
define('_ACA_TIME_ZONE', '時區');
define('_ACA_BLACK_LIST', '黑名單');
define('_ACA_REGISTRATION_DATE', '用戶註冊日期');
define('_ACA_USER_ID', '用戶 id');
define('_ACA_DESCRIPTION', '描述');
define('_ACA_ACCOUNT_CONFIRMED', '你的帳號已經啟動.');
define('_ACA_SUB_SUBSCRIBER', '訂閱者');
define('_ACA_SUB_PUBLISHER', 'Publisher');
define('_ACA_SUB_ADMIN', 'Administrator');
define('_ACA_REGISTERED', 'Registered');
define('_ACA_SUBSCRIPTIONS', '你的訂閱');
define('_ACA_SEND_UNSUBCRIBE', '發送取消訂閱訊息');
define('_ACA_SEND_UNSUBCRIBE_TIPS', '點擊「是」發送取消訂閱電郵確認訊息.');
define('_ACA_SUBSCRIBE_SUBJECT_MESS', '請確認你的訂閱');
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', '確認取消訂閱');
define('_ACA_DEFAULT_SUBSCRIBE_MESS', '[NAME]你好，<br />' .
		'還差一步你便會被加到訂閱清單.  請點擊以下連結確認你的訂閱.' .
		'<br /><br />[CONFIRM]<br /><br />如有疑問請聯繫網站管理員.');
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', '這封電郵是確認你已經從我們的清單中取消訂閱.  我們很遺憾你決定取消訂閱, 如你決定再訂閱, 歡迎你隨時到我們的網站.  如有疑問請聯繫我們的網站管理員.');

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', '訂閱日期');
define('_ACA_CONFIRMED', '已確認');
define('_ACA_SUBSCRIB', '訂閱');
define('_ACA_HTML', 'HTML 郵件');
define('_ACA_RESULTS', '結果');
define('_ACA_SEL_LIST', '選擇清單');
define('_ACA_SEL_LIST_TYPE', '- 選擇清單類型 -');
define('_ACA_SUSCRIB_LIST', '所有訂閱者清單');
define('_ACA_SUSCRIB_LIST_UNIQUE', '訂閱者於 : ');
define('_ACA_NO_SUSCRIBERS', '在此清單找不到訂閱者.');
define('_ACA_COMFIRM_SUBSCRIPTION', '一封確認電郵已發送給你.  請檢查你的電郵及點擊所提供的連結.<br />' .
		'你需要確認你的電郵你的訂閱才會生效.');
define('_ACA_SUCCESS_ADD_LIST', '你已經成功加到清單.');


 // Subcription info
define('_ACA_CONFIRM_LINK', '點擊這裡確認你的訂閱');
define('_ACA_UNSUBSCRIBE_LINK', '點擊這裡從清單中取消你的訂閱');
define('_ACA_UNSUBSCRIBE_MESS', '你的電郵地址已從清單中移除');

define('_ACA_QUEUE_SENT_SUCCESS' , '所有已排期郵件已成功發送.');
define('_ACA_MALING_VIEW', '檢視所有郵件');
define('_ACA_UNSUBSCRIBE_MESSAGE', '你確定你想從清單中取消訂閱?');
define('_ACA_MOD_SUBSCRIBE', '訂閱');
define('_ACA_SUBSCRIBE', '訂閱');
define('_ACA_UNSUBSCRIBE', '取消訂閱');
define('_ACA_VIEW_ARCHIVE', '檢視封存');
define('_ACA_SUBSCRIPTION_OR', ' 或點擊這裡更新你的資訊');
define('_ACA_EMAIL_ALREADY_REGISTERED', '此電郵地址已經註冊.');
define('_ACA_SUBSCRIBER_DELETED', '訂閱者已成功刪除.');


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', '用戶控制台');
define('_UCP_USER_MENU', '用戶選單');
define('_UCP_USER_CONTACT', '我的訂閱');
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', '排程工作管理');
define('_UCP_CRON_NEW_MENU', '新排程');
define('_UCP_CRON_LIST_MENU', '列出我的排程');
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', '優惠券管理');
define('_UCP_COUPON_LIST_MENU', '優惠券清單');
define('_UCP_COUPON_ADD_MENU', '新增優惠券');

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', '描述');
define('_ACA_LIST_T_LAYOUT', '版面設計');
define('_ACA_LIST_T_SUBSCRIPTION', '訂閱');
define('_ACA_LIST_T_SENDER', '寄件者資訊');

define('_ACA_LIST_TYPE', '清單類型');
define('_ACA_LIST_NAME', '清單名稱');
define('_ACA_LIST_ISSUE', '發行＃');
define('_ACA_LIST_DATE', '發送日期');
define('_ACA_LIST_SUB', '郵件標題');
define('_ACA_ATTACHED_FILES', '附件檔案');
define('_ACA_SELECT_LIST', '請選擇要編輯的清單!');

// Auto Responder box
define('_ACA_AUTORESP_ON', '清單類型');
define('_ACA_AUTO_RESP_OPTION', '自動應答選項');
define('_ACA_AUTO_RESP_FREQ', '訂閱者可以選擇頻率');
define('_ACA_AUTO_DELAY', '延遲（以日計）');
define('_ACA_AUTO_DAY_MIN', '最小頻率');
define('_ACA_AUTO_DAY_MAX', '最大頻率');
define('_ACA_FOLLOW_UP', '指定跟進自動應答');
define('_ACA_AUTO_RESP_TIME', '訂閱者可以選擇時間');
define('_ACA_LIST_SENDER', '列出寄件者');

define('_ACA_LIST_DESC', '清單描述');
define('_ACA_LAYOUT', '版面設計');
define('_ACA_SENDER_NAME', '寄件者名稱');
define('_ACA_SENDER_EMAIL', '寄件者電郵');
define('_ACA_SENDER_BOUNCE', '寄件者退回地址');
define('_ACA_LIST_DELAY', '延遲');
define('_ACA_HTML_MAILING', 'HTML 郵件?');
define('_ACA_HTML_MAILING_DESC', '(如果變更它, 你需要儲存及返回此頁檢視變更.)');
define('_ACA_HIDE_FROM_FRONTEND', '從首頁隱藏?');
define('_ACA_SELECT_IMPORT_FILE', '選擇要匯入的檔案');;
define('_ACA_IMPORT_FINISHED', '匯入完成');
define('_ACA_DELETION_OFFILE', '刪除檔案');
define('_ACA_MANUALLY_DELETE', '失敗, 你應該手動刪除檔案');
define('_ACA_CANNOT_WRITE_DIR', '不能寫入目錄');
define('_ACA_NOT_PUBLISHED', '不能發送郵件, 清單未發佈.');

//  List info box
define('_ACA_INFO_LIST_PUB', '點擊「是」發佈清單');
define('_ACA_INFO_LIST_NAME', '在此輸入你的清單的名稱. 你可以此名稱分辨清單.');
define('_ACA_INFO_LIST_DESC', '在此輸入你的清單的簡單描述. 你的網站訪客將會看到此描述.');
define('_ACA_INFO_LIST_SENDER_NAME', '輸入郵件寄件者的名稱. 當訂閱者從此清單收到訊息時可以看到此名稱.');
define('_ACA_INFO_LIST_SENDER_EMAIL', '輸入即將發送的訊息的電郵地址.');
define('_ACA_INFO_LIST_SENDER_BOUNCED', '輸入用戶可以回覆到的電郵地址. 強烈建議與寄件者電郵相同, 因為如果它們不同濫發過濾器將會給予你的訊息更高的濫發排名.');
define('_ACA_INFO_LIST_AUTORESP', '選擇此清單的郵件類型. <br />' .
		'電子報: 正常電子報<br />' .
		'自動應答: 自動應答是自動定期透過網站發送的清單.');
define('_ACA_INFO_LIST_FREQUENCY', '允許用戶選擇接收清單的頻率.  這給予用戶更大的彈性.');
define('_ACA_INFO_LIST_TIME', '讓用戶選擇接收清單的喜好時間.');
define('_ACA_INFO_LIST_MIN_DAY', '定義用戶可選擇接收清單的最小頻率');
define('_ACA_INFO_LIST_DELAY', '指定此自動應答與之前一個之間延遲.');
define('_ACA_INFO_LIST_DATE', '如你想延遲發佈請指定發佈新聞清單的日期. <br /> 格式 : YYYY-MM-DD HH:MM:SS');
define('_ACA_INFO_LIST_MAX_DAY', '定義用戶可選擇接收清單的最大頻率');
define('_ACA_INFO_LIST_LAYOUT', '在此輸入你的郵件清單的版面設計. 你可以在此輸入任何你的郵件的版面設計.');
define('_ACA_INFO_LIST_SUB_MESS', '此訊息將會發送到首次註冊的訂閱者. 你可以在此定義任何你喜歡的文字.');
define('_ACA_INFO_LIST_UNSUB_MESS', '此訊息將會發到到取消訂閱的訂閱者. 可在此輸入任何訊息.');
define('_ACA_INFO_LIST_HTML', '如你希望發送 HTML 郵件請選取方塊. 當訂閱時 HTML 清單時訂閱者將可以指定是否希望接收 HTML 訊息, 或純文字訊息.');
define('_ACA_INFO_LIST_HIDDEN', '點擊「是」 從前台隱藏清單, 用戶將不能訂閱但你仍可以發送郵件.');
define('_ACA_INFO_LIST_ACA_AUTO_SUB', '你要自動訂閱用戶到此清單嗎?<br /><B>新用戶:</B> 將會註冊每位註冊到網站的新用戶.<br /><B>所有用戶:</B> 將會註冊每位在資料庫的註冊用戶.<br />(所有選項支援 Community Builder)');
define('_ACA_INFO_LIST_ACC_LEVEL', '選擇前台存取層級. 它會對沒有權限的用戶群組顯示或隱藏郵件, 因此他們不能對它訂閱.');
define('_ACA_INFO_LIST_ACC_USER_ID', '選擇你想允許編輯的用戶群組的存取層級. 該用戶群組及以上將可以編輯郵件及透過前台或後台將它發送.');
define('_ACA_INFO_LIST_FOLLOW_UP', '如果你想自動應答一旦到達最後的訊息時移到另一訊息, 你可以在此指定跟進的自動應答.');
define('_ACA_INFO_LIST_ACA_OWNER', '這是建立清單者的 ID.');
define('_ACA_INFO_LIST_WARNING', '   此最後選項只於建立清單時啟用.');
define('_ACA_INFO_LIST_SUBJET', ' 郵件的標題.  這是訂閱者將收到的電郵的標題.');
define('_ACA_INFO_MAILING_CONTENT', '這是你想發送的電郵的主體部份.');
define('_ACA_INFO_MAILING_NOHTML', '在此輸入你想發送到選擇不接收 HTML 的訂閱者的電郵. <BR/> 注意: 如果你留空它 Acajoom 將會自動轉換 HTML 內容為純文字.');
define('_ACA_INFO_MAILING_VISIBLE', '點擊「是」於前台顯示郵件.');
define('_ACA_INSERT_CONTENT', '插入已存在內容');

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', '優惠券成功發送！');
define('_ACA_CHOOSE_COUPON', '選擇優惠券');
define('_ACA_TO_USER', ' 到此用戶');

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', '每小時');
define('_ACA_FREQ_CH2', '每 6 小時');
define('_ACA_FREQ_CH3', '每 12 小時');
define('_ACA_FREQ_CH4', '每日');
define('_ACA_FREQ_CH5', '每週');
define('_ACA_FREQ_CH6', '每月');
define('_ACA_FREQ_NONE', '無');
define('_ACA_FREQ_NEW', '新用戶');
define('_ACA_FREQ_ALL', '所有用戶');

//Label CRON form
define('_ACA_LABEL_FREQ', 'Acajoom 排程?');
define('_ACA_LABEL_FREQ_TIPS', '如果你想使用它作為 Acajoom 排程點擊「是」, 點擊「否」作為任何其他的排程工作.<br />' .
		'如果你點擊「是」 你不需要指定排程地址, 它將會自動地加入.');
define('_ACA_SITE_URL' , '你的網址');
define('_ACA_CRON_FREQUENCY' , '排程頻率');
define('_ACA_STARTDATE_FREQ' , '開始日期');
define('_ACA_LABELDATE_FREQ' , '指定日期');
define('_ACA_LABELTIME_FREQ' , '指定時間');
define('_ACA_CRON_URL', '排程網址');
define('_ACA_CRON_FREQ', '頻率');
define('_ACA_TITLE_CRONLIST', '排程清單');
define('_NEW_LIST', '建立新清單');

//title CRON form
define('_ACA_TITLE_FREQ', '排程編輯');
define('_ACA_CRON_SITE_URL', '請輸入有效的網址, 以 http:// 開始');

### Mailings ###
define('_ACA_MAILING_ALL', '所有郵件');
define('_ACA_EDIT_A', '編輯 ');
define('_ACA_SELCT_MAILING', '請在下拉式選單中選擇清單以新增郵件.');
define('_ACA_VISIBLE_FRONT', '可於前台檢視');

// mailer
define('_ACA_SUBJECT', '標題');
define('_ACA_CONTENT', '內容');
define('_ACA_NAMEREP', '[NAME] = 它會被訂閱者所輸入的名稱取代, 你可以用它發送個人化電郵.<br />');
define('_ACA_FIRST_NAME_REP', '[FIRSTNAME] = 它會被訂閱者所輸入的名字取代.<br />');
define('_ACA_NONHTML', '非-html 版本');
define('_ACA_ATTACHMENTS', '附件');
define('_ACA_SELECT_MULTIPLE', '按住 ctrl（或命令）選擇多個附件.<br />' .
		'附件清單中顯示的檔案放在附件資料夾內, 你可以在控制台變更此位置.');
define('_ACA_CONTENT_ITEM', '內容項目');
define('_ACA_SENDING_EMAIL', '電郵發送中');
define('_ACA_MESSAGE_NOT', '訊息不能發送');
define('_ACA_MAILER_ERROR', '郵件收發機錯誤');
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', '訊息已成功發送');
define('_ACA_SENDING_TOOK', '發送此郵件用了');
define('_ACA_SECONDS', '秒');
define('_ACA_NO_ADDRESS_ENTERED', '無提供電郵地址或訂閱者');
define('_ACA_CHANGE_SUBSCRIPTIONS', '變更');
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', '變更你的訂閱');
define('_ACA_WHICH_EMAIL_TEST', '指出發送測試或選擇預覽的電郵地址');
define('_ACA_SEND_IN_HTML', '以 HTML 發送（只限 html 郵件）？');
define('_ACA_VISIBLE', '可檢視');
define('_ACA_INTRO_ONLY', '只有簡介');

// stats
define('_ACA_GLOBALSTATS', '全域統計');
define('_ACA_DETAILED_STATS', '詳細統計');
define('_ACA_MAILING_LIST_DETAILS', '列出詳情');
define('_ACA_SEND_IN_HTML_FORMAT', '以 HTML 格式發送');
define('_ACA_VIEWS_FROM_HTML', '檢視（自 html 郵件）');
define('_ACA_SEND_IN_TEXT_FORMAT', '以純文字格式發送');
define('_ACA_HTML_READ', 'HTML 已閱讀');
define('_ACA_HTML_UNREAD', 'HTML 未閱讀');
define('_ACA_TEXT_ONLY_SENT', '純文字');

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', '郵寄');
define('_ACA_LOGGING_CONFIG', '紀錄及統計');
define('_ACA_SUBSCRIBER_CONFIG', '訂閱者');
define('_ACA_MISC_CONFIG', '雜項');
define('_ACA_MAIL_SETTINGS', '郵寄設定');
define('_ACA_MAILINGS_SETTINGS', '郵件設定');
define('_ACA_SUBCRIBERS_SETTINGS', '訂閱者設定');
define('_ACA_CRON_SETTINGS', '排程設定');
define('_ACA_SENDING_SETTINGS', '發送設定');
define('_ACA_STATS_SETTINGS', '統計設定');
define('_ACA_LOGS_SETTINGS', '紀錄設定');
define('_ACA_MISC_SETTINGS', '雜項設定');
// mail settings
define('_ACA_SEND_MAIL_FROM', '寄件者電郵');
define('_ACA_SEND_MAIL_NAME', '寄件者名稱');
define('_ACA_MAILSENDMETHOD', '郵件收發機模式');
define('_ACA_SENDMAILPATH', 'Sendmail 路徑');
define('_ACA_SMTPHOST', 'SMTP 主機');
define('_ACA_SMTPAUTHREQUIRED', 'SMTP 需要驗證');
define('_ACA_SMTPAUTHREQUIRED_TIPS', '如你的 SMTP 伺服器需要驗證, 選擇「是」');
define('_ACA_SMTPUSERNAME', 'SMTP 用戶名稱');
define('_ACA_SMTPUSERNAME_TIPS', '如你的 SMTP 伺服器需要驗證, 輸入 SMTP 用戶名稱');
define('_ACA_SMTPPASSWORD', 'SMTP 密碼');
define('_ACA_SMTPPASSWORD_TIPS', '如你的 SMTP 伺服器需要驗證, 輸入 SMTP 密碼');
define('_ACA_USE_EMBEDDED', '使用內嵌圖像');
define('_ACA_USE_EMBEDDED_TIPS', '如附加在內容項目的圖像是內嵌在 html 訊息電郵, 選擇「是」; 使用預設圖像標籤連結到網站圖像, 選擇「否」.');
define('_ACA_UPLOAD_PATH', '上載/附件路徑');
define('_ACA_UPLOAD_PATH_TIPS', '你可以指定上載目錄.<br />' .
		'確定你指定的目錄已存在, 否則建立它.');

// subscribers settings
define('_ACA_ALLOW_UNREG', '允許未註冊');
define('_ACA_ALLOW_UNREG_TIPS', '如你想允許用戶無需註冊到網站便可訂閱到清單, 選擇「是」.');
define('_ACA_REQ_CONFIRM', '需要確認');
define('_ACA_REQ_CONFIRM_TIPS', '如你需要未註冊訂閱者確認他們的電郵地址, 選擇「是」.');
define('_ACA_SUB_SETTINGS', '訂閱設定');
define('_ACA_SUBMESSAGE', '訂閱電郵');
define('_ACA_SUBSCRIBE_LIST', '訂閱到清單');

define('_ACA_USABLE_TAGS', '可用的標籤');
define('_ACA_NAME_AND_CONFIRM', '<b>[CONFIRM]</b> = 它建立可點擊連結使訂閱者可以確認他們的訂閱. 這是讓 Acajoom 正常運作所<strong>必須的</strong>.<br />'
.'<br />[NAME] = 它會被訂閱者所輸入的名稱取代, 你可以用它發送個人化電郵.<br />'
.'<br />[FIRSTNAME] = 它會被訂閱者所輸入的名字取代, 名字是由訂閱者定義.<br />');
define('_ACA_CONFIRMFROMNAME', '確認寄件者名稱');
define('_ACA_CONFIRMFROMNAME_TIPS', '輸入顯示在確認清單的寄件者名稱.');
define('_ACA_CONFIRMFROMEMAIL', '寄件者電郵確認');
define('_ACA_CONFIRMFROMEMAIL_TIPS', '輸入顯示在確認清單的電郵地址.');
define('_ACA_CONFIRMBOUNCE', '退回地址');
define('_ACA_CONFIRMBOUNCE_TIPS', '輸入顯示在確認清單的退回地址.');
define('_ACA_HTML_CONFIRM', 'HTML 確認');
define('_ACA_HTML_CONFIRM_TIPS', '如用戶允許 html 確認清單便是 html, 選擇「是」.');
define('_ACA_TIME_ZONE_ASK', '詢問時區');
define('_ACA_TIME_ZONE_TIPS', '如你想詢問用戶的時區, 選擇「是」. 適用時排程郵件會按時區發送');

 // Cron Set up
 define('_ACA_AUTO_CONFIG', '排程');
define('_ACA_TIME_OFFSET_URL', '點擊這裡在全域設定控制台 -> 地區分頁設定時差');
define('_ACA_TIME_OFFSET_TIPS', '設定你的伺服器時差使紀錄日期及時間準確');
define('_ACA_TIME_OFFSET', '時差');
define('_ACA_CRON_DESC','<br />使用排程功能你可以為你的 Joomla 網站設定自動化工作!<br />' .
		'要設定你需要在你的控制台 crontab 新增以下指令:<br />' .
		'<b>' . $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />如需協助設定或有問題請咨詢我們的討論區 <a href="http://www.acajoom.com" target="_blank">http://www.acajoom.com</a>');
// sending settings
define('_ACA_PAUSEX', '每設定數量電郵等待ｘ秒');
define('_ACA_PAUSEX_TIPS', '輸入 Acajoom 將會給予 SMTP 伺服器在執行下一設定數量訊息前發送訊息的時間秒數.');
define('_ACA_EMAIL_BET_PAUSE', '電郵之間暫停');
define('_ACA_EMAIL_BET_PAUSE_TIPS', '暫停前要發送的電郵數目.');
define('_ACA_WAIT_USER_PAUSE', '暫停時等待用戶輸入');
define('_ACA_WAIT_USER_PAUSE_TIPS', '當郵件組之間暫停時程式是否應等待用戶輸入.');
define('_ACA_SCRIPT_TIMEOUT', '程式逾時');
define('_ACA_SCRIPT_TIMEOUT_TIPS', '程式可執行分鐘時數（０代表不限）.');
// Stats settings
define('_ACA_ENABLE_READ_STATS', '允許閱讀統計');
define('_ACA_ENABLE_READ_STATS_TIPS', '如你想紀錄檢視數目, 選擇「是」. 此技術只可用於 html 郵件');
define('_ACA_LOG_VIEWSPERSUB', '紀錄每位訂閱者檢視');
define('_ACA_LOG_VIEWSPERSUB_TIPS', '如你想紀錄每位訂閱者的檢視數目, 選擇「是」. 此技術只可用於 html 郵件');
// Logs settings
define('_ACA_DETAILED', '詳細紀錄');
define('_ACA_SIMPLE', '簡單紀錄');
define('_ACA_DIAPLAY_LOG', '顯示紀錄');
define('_ACA_DISPLAY_LOG_TIPS', '如你想在發送郵件時顯示紀錄, 選擇「是」.');
define('_ACA_SEND_PERF_DATA', '發送效能');
define('_ACA_SEND_PERF_DATA_TIPS', '如你想允許 Acajoom 發送你的設定、清單上訂閱者數目及發送郵件所消耗時間的暱名報告, 選擇「是」. 這讓我們更了解 Acajoom 的效能及幫助我們改進 Acajoom 將來的開發.');
define('_ACA_SEND_AUTO_LOG', '發送自動應答紀錄');
define('_ACA_SEND_AUTO_LOG_TIPS', '如你想每次執行排程時發送電郵紀錄, 選擇「是」.  警告: 這可導致大量電郵.');
define('_ACA_SEND_LOG', '發送紀錄');
define('_ACA_SEND_LOG_TIPS', '是否電郵郵件紀錄到發送郵件的用戶的電郵地址.');
define('_ACA_SEND_LOGDETAIL', '發送詳細紀錄');
define('_ACA_SEND_LOGDETAIL_TIPS', '詳細紀錄包括每位訂閱者的成功及失敗資訊及資訊概覽. 簡單紀錄只發送概覽.');
define('_ACA_SEND_LOGCLOSED', '如連線關閉發送紀錄');
define('_ACA_SEND_LOGCLOSED_TIPS', '有了此選項, 發送郵件的用戶仍會接收到報告電郵.');
define('_ACA_SAVE_LOG', '儲存紀錄');
define('_ACA_SAVE_LOG_TIPS', '是否附加郵件紀錄到紀錄檔.');
define('_ACA_SAVE_LOGDETAIL', '儲存詳細紀錄');
define('_ACA_SAVE_LOGDETAIL_TIPS', '詳細紀錄包括每位訂閱者的成功及失敗資訊及資訊概覽. 簡單紀錄只發送概覽.');
define('_ACA_SAVE_LOGFILE', '儲存紀錄檔');
define('_ACA_SAVE_LOGFILE_TIPS', '紀錄資訊所附加到的檔案. 此檔案可能變得很大.');
define('_ACA_CLEAR_LOG', '清除紀錄');
define('_ACA_CLEAR_LOG_TIPS', '清除紀錄檔.');

### control panel
define('_ACA_CP_LAST_QUEUE', '最後執行排程');
define('_ACA_CP_TOTAL', '合共');
define('_ACA_MAILING_COPY', '成功複製郵件！');

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', '顯示指南');
define('_ACA_SHOW_GUIDE_TIPS', '在開始時顯示指南協助新用戶建立電子報, 自動應答及正確地設定 Acajoom.');
define('_ACA_AUTOS_ON', '使用自動應答');
define('_ACA_AUTOS_ON_TIPS', '如你不想使用自動應答, 選擇「否」, 所有自動應答選項將會關閉.');
define('_ACA_NEWS_ON', '使用電子報');
define('_ACA_NEWS_ON_TIPS', '如你不想使用電子報, 選擇「否」, 所有電子報選項將會關閉.');
define('_ACA_SHOW_TIPS', '顯示提示');
define('_ACA_SHOW_TIPS_TIPS', '顯示提示, 協助用戶更有效地使用 Acajoom.');
define('_ACA_SHOW_FOOTER', '顯示註腳');
define('_ACA_SHOW_FOOTER_TIPS', '是否顯示註腳版權通告.');
define('_ACA_SHOW_LISTS', '在前台顯示清單');
define('_ACA_SHOW_LISTS_TIPS', '當用戶未註冊時顯示他們可訂閱的電子報清單及封存按鈕或簡單地顯示登入表單讓他們註冊.');
define('_ACA_CONFIG_UPDATED', '設定詳情已更新！');
define('_ACA_UPDATE_URL', '更新網址');
define('_ACA_UPDATE_URL_WARNING', '警告！除非是 Acajoom 技術團隊提出，否則不要變更此網址.<br />');
define('_ACA_UPDATE_URL_TIPS', '例如：http://www.acajoom.com/update/（包括結尾斜線）');

// module
define('_ACA_EMAIL_INVALID', '所輸入的電郵無效.');
define('_ACA_REGISTER_REQUIRED', '在你訂閱清單前請先到網站註冊.');

// Access level box
define('_ACA_OWNER', '清單建立者:');
define('_ACA_ACCESS_LEVEL', '設定清單存取層級');
define('_ACA_ACCESS_LEVEL_OPTION', '存取層級選項');
define('_ACA_USER_LEVEL_EDIT', '選擇哪個用戶層級允許編輯郵件 (從前台或後台) ');

//  drop down options
define('_ACA_AUTO_DAY_CH1', '每日');
define('_ACA_AUTO_DAY_CH2', '每日，除了週末');
define('_ACA_AUTO_DAY_CH3', '每一其他日子');
define('_ACA_AUTO_DAY_CH4', '每一其他日子, 除了週末');
define('_ACA_AUTO_DAY_CH5', '每週');
define('_ACA_AUTO_DAY_CH6', '雙週');
define('_ACA_AUTO_DAY_CH7', '每月');
define('_ACA_AUTO_DAY_CH9', '每年');
define('_ACA_AUTO_OPTION_NONE', '無');
define('_ACA_AUTO_OPTION_NEW', '新用戶');
define('_ACA_AUTO_OPTION_ALL', '所有用戶');

//
define('_ACA_UNSUB_MESSAGE', '取消訂閱電郵');
define('_ACA_UNSUB_SETTINGS', '取消訂閱設定');
define('_ACA_AUTO_ADD_NEW_USERS', '自動訂閱用戶?');

// Update and upgrade messages
define('_ACA_NO_UPDATES', '暫時沒有可用更新.');
define('_ACA_VERSION', 'Acajoom 版本');
define('_ACA_NEED_UPDATED', '需要更新的檔案:');
define('_ACA_NEED_ADDED', '需要新增的檔案：');
define('_ACA_NEED_REMOVED', '需要移除的檔案：');
define('_ACA_FILENAME', '檔案名稱：');
define('_ACA_CURRENT_VERSION', '現在版本：');
define('_ACA_NEWEST_VERSION', '最新版本：');
define('_ACA_UPDATING', '更新中');
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', '檔案成功更新.');
define('_ACA_UPDATE_FAILED', '更新失敗！');
define('_ACA_ADDING', '新增中');
define('_ACA_ADDED_SUCCESSFULLY', '新增成功.');
define('_ACA_ADDING_FAILED', '新增失敗！');
define('_ACA_REMOVING', '移除中');
define('_ACA_REMOVED_SUCCESSFULLY', '移除成功.');
define('_ACA_REMOVING_FAILED', '移除失敗！');
define('_ACA_INSTALL_DIFFERENT_VERSION', '安裝不同版本');
define('_ACA_CONTENT_ADD', '新增內容');
define('_ACA_UPGRADE_FROM', '匯入資料（電子報及訂閱者資訊）自 ');
define('_ACA_UPGRADE_MESS', '此程序只簡單地匯入資料到 Acajoom 資料庫. <br /> 對你現存的資料不會構成風險.');
define('_ACA_CONTINUE_SENDING', '繼續發送');

// Acajoom message
define('_ACA_UPGRADE1', '你可以簡易地於更新控制台匯入你的用戶及電子報從 ');
define('_ACA_UPGRADE2', ' 到 Acajoom.');
define('_ACA_UPDATE_MESSAGE', '有新版本的 Acajoom！');
define('_ACA_UPDATE_MESSAGE_LINK', '點擊這裡更新!');
define('_ACA_THANKYOU', '多謝選擇 Acajoom, 你的通訊拍檔！');
define('_ACA_NO_SERVER', '更新伺服器暫停, 請稍後再嘗試.');
define('_ACA_MOD_PUB', 'Acajoom 模組未發佈.');
define('_ACA_MOD_PUB_LINK', '點擊這裡發佈它！');
define('_ACA_IMPORT_SUCCESS', '成功匯入');
define('_ACA_IMPORT_EXIST', '訂閱者已經於資料庫');

// Acajoom\'s Guide
define('_ACA_GUIDE', '精靈');
define('_ACA_GUIDE_FIRST_ACA_STEP', '<p>Acajoom 有很多強大的功能, 此精露會引導你渡過四個簡單步驟, 讓你開始發送你的電子報及自動應答！<p />');
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', '首先, 你需要新增清單.  清單有兩類, 電子報或自動應答.' .
		'  於清單內你需定定義所有不同參數才能發送你的電子報或自動應答: 寄件者名稱, 版面設計, 訂閱者歡迎辭等...
<br /><br />你可以在這裡設立你的首張清單: <a href="index2.php?option=com_acajoom&amp;act=list" >建立清單</a> 及點擊新增按鈕.');
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', 'Acajoom 給你提供簡易途徑從之前的電子報系統匯入所有資料.<br />' .
		' 前往更新控制台及選擇你之前的電子報系統匯入所有你的電子報及訂閱者.<br /><br />' .
		'<span style="color:#FF5E00;" >重要: 匯入是沒有風險的及不會影響你之前電子報系統的資料</span><br />' .
		'匯入後你將可以直接從 Acajoom 管理你的訂閱者及郵件.<br /><br />');
define('_ACA_GUIDE_SECOND_ACA_STEP', '你的首張清單已建立!  你現在可以撰寫你的首項%s.  要建立它前往: ');
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', '自動應答管理');
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', '電子報管理');
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', '及選擇你的%s. <br /> 然後在下拉式清單選擇你的%s.  點擊新增建立你的首項郵件');

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', '在你發送你的首項電子報前你可能需要檢查郵寄設定.  ' .
		'前往 <a href="index2.php?option=com_acajoom&amp;act=configuration" >設定頁</a> 確認郵寄設定. <br />');
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', '<br />當你準備好, 返回電子報選單, 選擇你的郵件及點擊發送');

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', '你需要先於你的伺服器設定排程工作, 才能發送你的自動應答. ' .
		' 請參考控制台排程分頁.' .
		' <a href="index2.php?option=com_acajoom&amp;act=configuration" >點擊這裡</a> 學習關於設定排程工作. <br />');

define('_ACA_GUIDE_MODULE', ' <br />確定你已發佈 Acajoom 模組讓人們可以註冊清單.');

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', ' 你現在亦可以設定自動應答.');
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', ' 你現在亦可以設定電子報.');

define('_ACA_GUIDE_FOUR_ACA_STEP', '<p><br />瞧! 你已準備好有效地與你的訪客及用戶通訊. 當你輸入第二項郵件時此精露將會結束或你可以於 <a href="index2.php?option=com_acajoom&act=configuration" >控制台</a> 關閉它.' .
		'<br /><br />  當你使用 Acajoom 時如有任何問題, 請參考 ' .
		'<a target="_blank" href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" >討論區</a>. ' .
		' 你亦可以到<a href="http://www.acajoom.com/" target="_blank" >www.Acajoom.com</a> 找到更多關於如何有效與你的訂閱者通訊的資訊 .' .
		'<p /><br /><b>感謝你使用 Acajoom. 你的通訊拍檔!</b> ');
define('_ACA_GUIDE_TURNOFF', '精靈現在關閉!');
define('_ACA_STEP', '步驟 ');

// Acajoom Install
define('_ACA_INSTALL_CONFIG', 'Acajoom 設定');
define('_ACA_INSTALL_SUCCESS', '安裝成功');
define('_ACA_INSTALL_ERROR', '安裝錯誤');
define('_ACA_INSTALL_BOT', 'Acajoom 插件（Bot）');
define('_ACA_INSTALL_MODULE', 'Acajoom 模組');
//Others
define('_ACA_JAVASCRIPT','!警告! Javascript 必須啟用才可正常運作.');
define('_ACA_EXPORT_TEXT','訂閱者是基於你所選清單匯出. <br />匯出訂閱者到清單');
define('_ACA_IMPORT_TIPS','匯入訂閱者. 檔案內資訊需要是以下格式: <br />' .
		'名稱,電郵,接收HTML(1/0),<span style="color: rgb(255, 0, 0);">已確定(1/0)</span>');
define('_ACA_SUBCRIBER_EXIT', '已經是訂閱者');
define('_ACA_GET_STARTED', '點擊這裡開始!');

//News since 1.0.1
define('_ACA_WARNING_1011','警告: 1011: 因你的伺服器限制不能更新.');
define('_ACA_SEND_MAIL_FROM_TIPS', '選擇寄件者顯示哪個電郵地址.');
define('_ACA_SEND_MAIL_NAME_TIPS', '選擇寄件者顯示什麼名稱.');
define('_ACA_MAILSENDMETHOD_TIPS', '選擇使用哪個郵件收發機: PHP 郵寄功能, <span>Sendmail</span> 或 SMTP 伺服器.');
define('_ACA_SENDMAILPATH_TIPS', '這是郵件伺服器目錄');
define('_ACA_LIST_T_TEMPLATE', '佈景主題');
define('_ACA_NO_MAILING_ENTERED', '無提供寄件');
define('_ACA_NO_LIST_ENTERED', '無提供清單');
define('_ACA_SENT_MAILING' , '已發送郵件');
define('_ACA_SELECT_FILE', '請選擇檔案 ');
define('_ACA_LIST_IMPORT', '檢查你想與訂閱者關聯連的清單.');
define('_ACA_PB_QUEUE', '訂閱者已插入但連接它到清單時出現問題. 請手動檢查.');
define('_ACA_UPDATE_MESS' , '');
define('_ACA_UPDATE_MESS1' , '強烈建議更新！');
define('_ACA_UPDATE_MESS2' , '補丁及輕微修正.');
define('_ACA_UPDATE_MESS3' , '新版本.');
define('_ACA_UPDATE_MESS5' , '更新需要 Joomla 1.5.');
define('_ACA_UPDATE_IS_AVAIL' , ' 已經推出!');
define('_ACA_NO_MAILING_SENT', '無發送郵件!');
define('_ACA_SHOW_LOGIN', '顯示登入表單');
define('_ACA_SHOW_LOGIN_TIPS', '選擇「是」於 Acajoom 控制台前台顯示登入表單使用戶能註冊到網站.');
define('_ACA_LISTS_EDITOR', '列出描述編輯');
define('_ACA_LISTS_EDITOR_TIPS', '選擇「是」使用 HTML 編輯器編輯清單描述欄.');
define('_ACA_SUBCRIBERS_VIEW', '檢視訂閱者');

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS' , '前台設定' );
define('_ACA_SHOW_LOGOUT', '顯示登出按鈕');
define('_ACA_SHOW_LOGOUT_TIPS', '選擇「是」在前台 Acajoom 控制台顯示登出按鈕.');

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', '整合');
define('_ACA_CB_INTEGRATION', 'Community Builder 整合');
define('_ACA_INSTALL_PLUGIN', 'Community Builder 插件（Acajoom 整合）');
define('_ACA_CB_PLUGIN_NOT_INSTALLED', '未安裝 Acajoom 的 Community Builder 插件!');
define('_ACA_CB_PLUGIN', '於註冊表顯示清單');
define('_ACA_CB_PLUGIN_TIPS', '選擇「是」於 community builder 註冊表格顯示郵件清單');
define('_ACA_CB_LISTS', '清單 ID');
define('_ACA_CB_LISTS_TIPS', '這是必填欄位. 以逗號分隔輸入你想允許用戶訂閱的清單的 id 號碼 (0 顯示所有清單)');
define('_ACA_CB_INTRO', '介紹文字');
define('_ACA_CB_INTRO_TIPS', '清單列出前將顯示的文字. 留空則不顯示任何文字.  你可使用 HTML 標籤自訂外觀及感覺.');
define('_ACA_CB_SHOW_NAME', '顯示清單名稱');
define('_ACA_CB_SHOW_NAME_TIPS', '選擇簡介後是否顯示清單名稱.');
define('_ACA_CB_LIST_DEFAULT', '預設剔選清單');
define('_ACA_CB_LIST_DEFAULT_TIPS', '選擇是否讓每個清單的方塊預設為已點選.');
define('_ACA_CB_HTML_SHOW', '顯示接收 HTML');
define('_ACA_CB_HTML_SHOW_TIPS', '選擇「是」允許用戶決定他們想接收 HTML 電郵與否. 選擇「否」使用預設接收 html.');
define('_ACA_CB_HTML_DEFAULT', '預設接收 HTML');
define('_ACA_CB_HTML_DEFAULT_TIPS', '設定此項顯示預設 html 郵件設定. 如顯示接收 HTML 設定為「否」此選項將為預設.');

// Since 1.0.4
define('_ACA_BACKUP_FAILED', '不能備份檔案! 檔案沒有被替代.');
define('_ACA_BACKUP_YOUR_FILES', '檔案的舊版本已備份到以下目錄:');
define('_ACA_SERVER_LOCAL_TIME', '伺服器本機時間');
define('_ACA_SHOW_ARCHIVE', '顯示封存按鈕');
define('_ACA_SHOW_ARCHIVE_TIPS', '選擇「是」於前台電子報清單顯示封存按鈕');
define('_ACA_LIST_OPT_TAG', '標籤');
define('_ACA_LIST_OPT_IMG', '圖像');
define('_ACA_LIST_OPT_CTT', '內容');
define('_ACA_INPUT_NAME_TIPS', '輸入你的全名（名字先）');
define('_ACA_INPUT_EMAIL_TIPS', '輸入你的電郵地址（如你想接收我們的郵件, 請確定這是有效的電郵地址.）');
define('_ACA_RECEIVE_HTML_TIPS', '如你想接收 HTML 郵件, 選擇「是」－純文字郵件，選擇「否」');
define('_ACA_TIME_ZONE_ASK_TIPS', '指定你的時區.');

// Since 1.0.5
define('_ACA_FILES' , '檔案');
define('_ACA_FILES_UPLOAD' , '上載');
define('_ACA_MENU_UPLOAD_IMG' , '上載圖像');
define('_ACA_TOO_LARGE' , '檔案太大. 最大限制是');
define('_ACA_MISSING_DIR' , '目的地目錄不存在');
define('_ACA_IS_NOT_DIR' , '目的地目錄不存在或是普通檔案.');
define('_ACA_NO_WRITE_PERMS' , '目的地目錄沒有寫入權限.');
define('_ACA_NO_USER_FILE' , '你沒有選擇要上載的檔案.');
define('_ACA_E_FAIL_MOVE' , '不可能移動檔案.');
define('_ACA_FILE_EXISTS' , '目的地檔案已經存在.');
define('_ACA_CANNOT_OVERWRITE' , '目的地檔案已存在及不能被覆蓋.');
define('_ACA_NOT_ALLOWED_EXTENSION' , '檔案類型不被允許.');
define('_ACA_PARTIAL' , '檔案只是部份被上載.');
define('_ACA_UPLOAD_ERROR' , '上載錯誤:');
define('DEV_NO_DEF_FILE' , '檔案只是部份被上載.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', '[SUBSCRIPTIONS] = 它會被訂閱連結取代.' .
		' 這是 <strong>必填的</strong> Acajoom 才能正常運作.<br />' .
		'如你在此方塊放置其他內容, 它會在所有相應到此清單的郵件內顯示.' .
		' <br />新增你的訂閱訊息於結尾.  Acajoom 會自動為訂閱者新增變更資訊及取消訂閱連結.');

// since 1.0.6
define('_ACA_NOTIFICATION', '通知');  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', '通知');
define('_ACA_USE_SEF', '於郵件開啟友善搜尋');
define('_ACA_USE_SEF_TIPS', '建議你選擇「否」.  但如你想你的郵件所包含的網址都使用 SEF, 則選擇「是」.' .
		' <br /><b>連結在兩種選項下均可運作.  選擇「否」確保郵件中連結總是運作, 即使你變更了你的 SEF.</b> ');
define('_ACA_ERR_NB' , '錯誤 #: ERR');
define('_ACA_ERR_SETTINGS', '錯誤處理設定');
define('_ACA_ERR_SEND' ,'發送錯誤報告');
define('_ACA_ERR_SEND_TIPS' ,'如你想 Acajoom 更完善請選擇「是」.  它會發送錯誤報告給我們.  故此你甚至不需要再報告臭蟲 ;-) <br /> <b>不會發送任何私人資訊</b>.  我們甚至不知道錯誤從哪個網址送來. 我們只發送關於 Acajoom 的資訊, PHP 設定及 SQL 詢問. ');
define('_ACA_ERR_SHOW_TIPS' ,'選擇「是」於螢幕顯示錯誤編號.  主要用作除錯作用. ');
define('_ACA_ERR_SHOW' ,'顯示錯誤');
define('_ACA_LIST_SHOW_UNSUBCRIBE', '顯示取消訂閱連結');
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', '選擇「是」於郵件底部顯示取消連結讓用戶變更他們的訂閱. <br /> 選擇「否」關閉註腳及連結.');
define('_ACA_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">重要通告！</span> <br />如你是從之前的  Acajoom 安裝升級，你需要點擊以下按鈕升級你的資料庫結構（你的資料會完整保留）');
define('_ACA_UPDATE_INSTALL_BTN' , '升級表格及設定');
define('_ACA_MAILING_MAX_TIME', '最大排程時間' );
define('_ACA_MAILING_MAX_TIME_TIPS', '定義每組排程發送電郵的最大時間. 建議在 30 秒至 2 分鐘之間.');

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', 'VirtueMart 整合');
define('_ACA_VM_COUPON_NOTIF', '優惠券通知 ID');
define('_ACA_VM_COUPON_NOTIF_TIPS', '指定你想用作發送優惠券到你的顧客的郵件 ID 號碼.');
define('_ACA_VM_NEW_PRODUCT', '新產品通知 ID');
define('_ACA_VM_NEW_PRODUCT_TIPS', '指定你想用作發送新產品通知的郵件 ID 號碼.');

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', '建立表單');
define('_ACA_FORM_COPY', 'HTML 編碼');
define('_ACA_FORM_COPY_TIPS', '複製所產生的 HTML 編碼到你的 HTML 頁.');
define('_ACA_FORM_LIST_TIPS', '選擇你想包括表單的清單');
// update messages
define('_ACA_UPDATE_MESS4' , '不能自動更新.');
define('_ACA_WARNG_REMOTE_FILE' , '不能取得遠端檔案.');
define('_ACA_ERROR_FETCH' , '頡取檔案錯誤.');

define('_ACA_CHECK' , '檢查');
define('_ACA_MORE_INFO' , '更多資訊');
define('_ACA_UPDATE_NEW' , '更新到新版本');
define('_ACA_UPGRADE' , '升級到更高檔產品');
define('_ACA_DOWNDATE' , '返回之前版本');
define('_ACA_DOWNGRADE' , '返回基本產品');
define('_ACA_REQUIRE_JOOM' , '需要 Joomla');
define('_ACA_TRY_IT' , '嘗試它！');
define('_ACA_NEWER', '較新的');
define('_ACA_OLDER', '較舊的');
define('_ACA_CURRENT', '現在的');

// since 1.0.9
define('_ACA_CHECK_COMP', '嘗試其他元件');
define('_ACA_MENU_VIDEO' , '影片教學');
define('_ACA_SCHEDULE_TITLE', '自動日程功能設定');
define('_ACA_ISSUE_NB_TIPS' , '發行編號自動由系統產生' );
define('_ACA_SEL_ALL' , '所有郵件');
define('_ACA_SEL_ALL_SUB' , '所有清單');
define('_ACA_INTRO_ONLY_TIPS' , '如你只點選此方塊, 插入到郵件的文章簡介將會附有「詳細內容...」連結到完整文章.' );
define('_ACA_TAGS_TITLE' , '內容標籤');
define('_ACA_TAGS_TITLE_TIPS' , '複製及貼上此標籤到郵件中你想放置內容的位置.');
define('_ACA_PREVIEW_EMAIL_TEST', '指定發送測試到這個電郵地址');
define('_ACA_PREVIEW_TITLE' , '預覽');
define('_ACA_AUTO_UPDATE' , '更新通知');
define('_ACA_AUTO_UPDATE_TIPS' , '如欲當元件有更新時通知你, 選擇「是」. <br />重要!! 此功能需要開啟提示.');

// since 1.1.0
define('_ACA_LICENSE' , '授權合約資訊');

// since 1.1.1
define('_ACA_NEW' , '新');
define('_ACA_SCHEDULE_SETUP', '你需要於設定設定日程表, 才可發送自動應答.');
define('_ACA_SCHEDULER', '日程表');
define('_ACA_ACAJOOM_CRON_DESC' , '如你沒有你網站排程工作管理員的存取權限, 你可以註冊免費的 Acajoom Cron 戶口於:' );
define('_ACA_CRON_DOCUMENTATION' , '你可以於以下網址找到更多設定 Acajoom 日程表資料:');
define('_ACA_CRON_DOC_URL' , '<a href="http://www.acajoom.com/index.php?option=com_content&amp;task=blogcategory&amp;id=29"
 target="_blank">http://www.acajoom.com/index.php?option=com_content&amp;task=blogcategory&amp;id=29</a>' );
define( '_ACA_QUEUE_PROCESSED' , '成功執行排程...' );
define( '_ACA_ERROR_MOVING_UPLOAD' , '移動匯入檔案錯誤' );

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY' , '日程表頻率' );
define( '_ACA_CRON_MAX_FREQ' , '日程表最大頻率' );
define( '_ACA_CRON_MAX_FREQ_TIPS' , '指定日程表可執行的最大頻率（分鐘）.  它會限制日程表即使排程工作設定更高頻率.' );
define( '_ACA_CRON_MAX_EMAIL' , '每件工作最大電郵' );
define( '_ACA_CRON_MAX_EMAIL_TIPS' , '指定每項工作的最大發送電郵數目（0 無限）.' );
define( '_ACA_CRON_MINUTES' , ' 分鐘' );
define( '_ACA_SHOW_SIGNATURE' , '顯示電郵註腳' );
define( '_ACA_SHOW_SIGNATURE_TIPS' , '你是否想於電郵註腳推廣 Acajoom.' );
define( '_ACA_QUEUE_AUTO_PROCESSED' , '自動應答成功執行...' );
define( '_ACA_QUEUE_NEWS_PROCESSED' , '已排程電子報成功執行...' );
define( '_ACA_MENU_SYNC_USERS' , '同步用戶' );
define( '_ACA_SYNC_USERS_SUCCESS' , '成功同步用戶！' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', '登出' );
if (!defined('_CMN_YES')) define( '_CMN_YES', '是' );
if (!defined('_CMN_NO')) define( '_CMN_NO', '否' );
if (!defined('_HI')) define( '_HI', '你好' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', '頂部' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', '底部' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', '登出' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS' , '如你選擇它, 只有插入到郵件的文章標題會連結到完整文章.');
define('_ACA_TITLE_ONLY' , '只有標題');
define('_ACA_FULL_ARTICLE_TIPS' , '如你選擇它, 完整文章會插入到郵件');
define('_ACA_FULL_ARTICLE' , '完整文章');
define('_ACA_CONTENT_ITEM_SELECT_T', '選擇附加到訊息的內容項目. <br />複製及貼上 <b>內容標籤</b> 到郵件.  你可 (分別地用 0, 1, 或 2) 選擇完整文章, 只有簡介, 或只有標題. ');
define('_ACA_SUBSCRIBE_LIST2', '郵件清單');

// smart-newsletter function
define('_ACA_AUTONEWS', '智能-電子報');
define('_ACA_MENU_AUTONEWS', '智能-電子報');
define('_ACA_AUTO_NEWS_OPTION', '智能-電子報選項');
define('_ACA_AUTONEWS_FREQ', '電子報頻率');
define('_ACA_AUTONEWS_FREQ_TIPS', '指定你想發送智能-電子報的頻率.');
define('_ACA_AUTONEWS_SECTION', '文章單元');
define('_ACA_AUTONEWS_SECTION_TIPS', '指定你想選擇文章來自哪個單元.');
define('_ACA_AUTONEWS_CAT', '文章分類');
define('_ACA_AUTONEWS_CAT_TIPS', '指定你想選擇文章來自哪個分類 (該單元內所有文章).');
define('_ACA_SELECT_SECTION', '選擇單元');
define('_ACA_SELECT_CAT', '所有分類');
define('_ACA_AUTO_DAY_CH8', '季度的');
define('_ACA_AUTONEWS_STARTDATE', '開始日期');
define('_ACA_AUTONEWS_STARTDATE_TIPS', '指定你想開始發送智能-電子報的日期.');
define('_ACA_AUTONEWS_TYPE', '內容翻譯');// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', '完整文章: 將於電子報包含完整文章.<br />' .
		'只有簡介: 將於電子報包含只有文章的簡介.<br/>' .
		'只有標題: 將於電子報包含只有文章的標題.');
define('_ACA_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = 它會由智能-電子報取代.' );

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', '建立 / 檢視郵件');
define('_ACA_LICENSE_CONFIG' , '授權合約' );
define('_ACA_ENTER_LICENSE' , '輸入授權合約');
define('_ACA_ENTER_LICENSE_TIPS' , '輸入你的授權合約號碼及儲存它.');
define('_ACA_LICENSE_SETTING' , '授權合約設定' );
define('_ACA_GOOD_LIC' , '你的授權合約有效.' );
define('_ACA_NOTSO_GOOD_LIC' , '你的授權合約無效：' );
define('_ACA_PLEASE_LIC' , '請聯絡 Acajoom 支援升級你的授權合約（license@acajoom.com）.' );
define('_ACA_DESC_PLUS', 'Acajoom Plus 是首個 Joomla CMS 的自動應答.  ' . _ACA_FEATURES );
define('_ACA_DESC_PRO', 'Acajoom PRO 是 Joomla CMS 的終極郵件系統.  ' . _ACA_FEATURES );

//since 1.1.4
define('_ACA_ENTER_TOKEN' , '輸入籌號');

define('_ACA_ENTER_TOKEN_TIPS' , '請輸入你在惠顧 Acajoom 時從電郵收到的籌號. ');

define('_ACA_ACAJOOM_SITE', 'Acajoom 網站：');
define('_ACA_MY_SITE', '我的網站：');

define( '_ACA_LICENSE_FORM' , ' ' .
 		'點擊這裡前往授權合約表格.</a>' );
define('_ACA_PLEASE_CLEAR_LICENSE' , '請消除授權合約欄及重試.<br />  如問題持續, ' );

define( '_ACA_LICENSE_SUPPORT' , '如你仍有疑問，' . _ACA_PLEASE_LIC );

define( '_ACA_LICENSE_TWO' , '你可於授權合約表單輸入你的籌號取得授權合約手冊及網址（本頁頂部綠色高亮部分）. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT );

define('_ACA_ENTER_TOKEN_PATIENCE', '儲存你的籌號後授權合約將會自動產生. ' .
		' 通常籌號確認需時 2 分鐘.  但是某些情況可能需時至 15 分鐘.<br />' .
		'<br />幾分鐘後返回此控制台檢查.  <br /><br />' .
		'如你在 15 分鐘內接收不到有效的授權合約, '. _ACA_LICENSE_TWO);


define( '_ACA_ENTER_NOT_YET' , '你的籌號尚未確認.');
define( '_ACA_UPDATE_CLICK_HERE' , '請到訪 <a href="http://www.acajoom.com" target="_blank">www.acajoom.com</a> 下載最新版本.');
define( '_ACA_NOTIF_UPDATE' , '要在有更新時通知你, 輸入你的電郵地址及點擊訂閱 ');

define('_ACA_THINK_PLUS', '如你想你的郵件系統具備更多功能請考慮 Plus!');
define('_ACA_THINK_PLUS_1', '連續的自動應答');
define('_ACA_THINK_PLUS_2', '排程於預定日子發送你的電子報');
define('_ACA_THINK_PLUS_3', '再沒有伺服器限制');
define('_ACA_THINK_PLUS_4', '及更多...');

//since 1.2.2
define( '_ACA_LIST_ACCESS', '清單存取權限' );
define( '_ACA_INFO_LIST_ACCESS', '指定哪個群組的用戶可以檢視及訂閱到此清單' );
define( 'ACA_NO_LIST_PERM', '你沒有足夠權限訂閱此清單' );

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', '封存');
 define('_ACA_MENU_ARCHIVE_ALL', '封存全部');

//Archive Lists
 define('_FREQ_OPT_0', '無');
 define('_FREQ_OPT_1', '每週');
 define('_FREQ_OPT_2', '每 2 週');
 define('_FREQ_OPT_3', '每月');
 define('_FREQ_OPT_4', '每季');
 define('_FREQ_OPT_5', '每年');
 define('_FREQ_OPT_6', '其他');

define('_DATE_OPT_1', '建立日期');
define('_DATE_OPT_2', '修改日期');

define('_ACA_ARCHIVE_TITLE', '設定自動-封存頻率');
define('_ACA_FREQ_TITLE', '封存頻率');
define('_ACA_FREQ_TOOL', '定義你想封存管理員每隔多久封存你的網站內容.');
define('_ACA_NB_DAYS', '日數');
define('_ACA_NB_DAYS_TOOL', '只適用於其他選項! 請指定每次封存相隔日數.');
define('_ACA_DATE_TITLE', '日期類型');
define('_ACA_DATE_TOOL', '定義應否在建立日期或修改日期封存.');

define('_ACA_MAINTENANCE_TAB', '維護設定');
define('_ACA_MAINTENANCE_FREQ', '維護頻率');
define( '_ACA_MAINTENANCE_FREQ_TIPS', '定義你想定期執行維護的頻率.' );
define( '_ACA_CRON_DAYS' , '小時' );

define( '_ACA_LIST_NOT_AVAIL', '沒有可用清單.');
define( '_ACA_LIST_ADD_TAB', '新增/編輯' );

define( '_ACA_LIST_ACCESS_EDIT', '新增郵件/編輯存取權限' );
define( '_ACA_INFO_LIST_ACCESS_EDIT', '指定哪個群組用戶可以為此清單新增或編輯新郵件' );
define( '_ACA_MAILING_NEW_FRONT', '建立新郵件' );

define('_ACA_AUTO_ARCHIVE', '自動封存');
define('_ACA_MENU_ARCHIVE', '自動封存');

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', '[ISSUENB] = 它會由電子報的發行號碼取代.');
define('_ACA_TAGS_DATE', '[DATE] = 它會由發送日期取代.');
define('_ACA_TAGS_CB', '[CBTAG:{field_name}] = 它會由 Community Builder 欄位取得的數值取代: 例. [CBTAG:firstname] ');
define( '_ACA_MAINTENANCE', '維護' );

define('_ACA_THINK_PRO', '有專業需要, 使用專業元件!');
define('_ACA_THINK_PRO_1', '智能-電子報');
define('_ACA_THINK_PRO_2', '為你的清單定義權限層級');
define('_ACA_THINK_PRO_3', '定義誰可以編輯/新增郵件');
define('_ACA_THINK_PRO_4', '更多標籤: 新增你的 CB 欄位');
define('_ACA_THINK_PRO_5', 'Joomla 內容自動封存');
define('_ACA_THINK_PRO_6', '最佳化資料庫');

define('_ACA_LIC_NOT_YET', '你的授權合約尚未確認.  請檢查控制台授權合約分頁.');
define('_ACA_PLEASE_LIC_GREEN' , '確定已提供分頁頂部的綠色資訊給我們的支援團隊.' );

define('_ACA_FOLLOW_LINK' , '取得你的授權合約');
define( '_ACA_FOLLOW_LINK_TWO' , '你可以在授權合約表單輸入籌號及網址取得授權合約 (本頁頂部綠色高亮部分). ');
define( '_ACA_ENTER_TOKEN_TIPS2', ' 然後點擊頂部右方選單的套用按鈕.' );
define( '_ACA_ENTER_LIC_NB', '輸入你的授權合約' );
define( '_ACA_UPGRADE_LICENSE', '升級你的授權合約');
define( '_ACA_UPGRADE_LICENSE_TIPS' , '如你收到升級你的授權合約籌號請在此輸入, 點擊套用及繼續第 <b>2</b> 步取得你的新授權合約號碼.' );

define( '_ACA_MAIL_FORMAT', '編碼格式' );
define( '_ACA_MAIL_FORMAT_TIPS', '你的郵件想用什麼格式的編碼, 純文字或 MIME' );
define( '_ACA_ACAJOOM_CRON_DESC_ALT', '如你沒有你網站排程工作管理員的存取權限, 你可以使用免費的 jCron 元件從你的網站建立排程工作.' );

//since 1.3.1
define('_ACA_SHOW_AUTHOR', '顯示作者名稱');
define('_ACA_SHOW_AUTHOR_TIPS', '如你想在郵件新增文章時新增作者名稱, 選擇「是」.');

//since 1.3.5
define('_ACA_REGWARN_NAME','請輸入你的名稱.');
define('_ACA_REGWARN_MAIL','請輸入有效的電郵地址.');

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS','如果你選擇是, 用戶的電郵將會被新增你的重新導向網址的結尾處作為參數.');
define('_ACA_ADDEMAILREDLINK','新增電郵到重新導向連結');

//since 1.6.3
define('_ACA_ITEMID','ItemId');
define('_ACA_ITEMID_TIPS','此 ItemId 將會加到你的 Acajoom 連結.');

//since 1.6.5
define('_ACA_SHOW_JCALPRO','jCalPRO');
define('_ACA_SHOW_JCALPRO_TIPS','顯示 jCalPRO 的整合分頁<br/>（只適用於如果 jCalPRO 已經安裝在你的網站！）');
define('_ACA_JCALTAGS_TITLE','jCalPRO 標籤:');
define('_ACA_JCALTAGS_TITLE_TIPS','複製及貼上此標籤於郵件清單內你欲放置項目（Event）的位置.');
define('_ACA_JCALTAGS_DESC','描述:');
define('_ACA_JCALTAGS_DESC_TIPS','如果你想插入項目的描述，選擇「是」');
define('_ACA_JCALTAGS_START','開始日期:');
define('_ACA_JCALTAGS_START_TIPS','如果你想插入項目的開始日期，選擇「是」');
define('_ACA_JCALTAGS_READMORE','閱讀更多:');
define('_ACA_JCALTAGS_READMORE_TIPS','如果你想插入 <b>閱讀更多連結</b> 到此項目，選擇「是」');
define('_ACA_REDIRECTCONFIRMATION','重新導向 URL');
define('_ACA_REDIRECTCONFIRMATION_TIPS','如果你需要確認電郵, 當用戶點擊確認連結時他將會被確認及重新導向到此 URL.');

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Save');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','No account yet?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Register');
<?php
header('Content-type: text/javascript');
$old_path = getcwd();
chdir('../../../../../');
define( '_JEXEC', 1 );
define('JPATH_BASE', getcwd() );
define( 'DS', DIRECTORY_SEPARATOR );
require_once("configuration.php");
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$lang =& JFactory::getLanguage();
$lang->setLanguage(JRequest::getVar('lang','en-GB'));
$lang->load('com_dtregister');

//chdir($old_path);
?> 
var i18n = DTjQuery.extend({}, i18n || {}, {

    xgcalendar: {

        dateformat: {

            "fulldaykey": "MMddyyyy",

            "fulldayshow": "L d yyyy",

            "fulldayvalue": "M/d/yyyy",

            "Md": "W M/d",

            "Md3": "L d",

            "separator": "/",

            "year_index": 2,

            "month_index": 0,

            "day_index": 1,

            "day": "d",

            "sun": "<?php echo JText::_('DT_SUN')?>",

            "mon": "<?php echo JText::_('DT_MON')?>",

            "tue": "<?php echo JText::_('DT_TUE')?>",

            "wed": "<?php echo JText::_('DT_WED')?>",

            "thu": "<?php echo JText::_('DT_THU')?>",

            "fri": "<?php echo JText::_('DT_FRI')?>",

            "sat": "<?php echo JText::_('DT_SAT')?>",

            "jan": "<?php echo JText::_('DT_JAN')?>",

            "feb": "<?php echo JText::_('DT_FEB')?>",

            "mar": "<?php echo JText::_('DT_MAR')?>",

            "apr": "<?php echo JText::_('DT_APR')?>",

            "may": "<?php echo JText::_('DT_MAY')?>",

            "jun": "<?php echo JText::_('DT_JUN')?>",

            "jul": "<?php echo JText::_('DT_JUL')?>",

            "aug": "<?php echo JText::_('DT_AUG')?>",

            "sep": "<?php echo JText::_('DT_SEP')?>",

            "oct": "<?php echo JText::_('DT_OCT')?>",

            "nov": "<?php echo JText::_('DT_NOV')?>",

            "dec": "<?php echo JText::_('DT_DEC')?>",
            
            "janfull": "<?php echo JText::_('DT_JAN_FULL')?>",

            "febfull": "<?php echo JText::_('DT_FEB_FULL')?>",

            "marfull": "<?php echo JText::_('DT_MAR_FULL')?>",

            "aprfull": "<?php echo JText::_('DT_APR_FULL')?>",

            "mayfull": "<?php echo JText::_('DT_MAY_FULL')?>",

            "junfull": "<?php echo JText::_('DT_JUN_FULL')?>",

            "julfull": "<?php echo JText::_('DT_JUL_FULL')?>",

            "augfull": "<?php echo JText::_('DT_AUG_FULL')?>",

            "sepfull": "<?php echo JText::_('DT_SEP_FULL')?>",

            "octfull": "<?php echo JText::_('DT_OCT_FULL')?>",

            "novfull": "<?php echo JText::_('DT_NOV_FULL')?>",

            "decfull": "<?php echo JText::_('DT_DEC_FULL')?>"
            
            

        },

        "no_implemented": "<?php echo JText::_('DT_NO_IMPLEMENT')?>",

        "to_date_view": "<?php echo JText::_('DT_CLICK_VIEW_CURRENT_DATE')?>",

        "i_undefined": "<?php echo JText::_('DT_UNDEFINED')?>",

        "allday_event": "<?php echo JText::_('DT_ALL_DAY_EVENT')?>",

        "repeat_event": "<?php echo JText::_('DT_REPEAT_EVENT')?>",

        "time": "<?php echo JText::_('DT_TIME')?>",

        "event": "<?php echo JText::_('DT_EVENT')?>",

        "location": "<?php echo JText::_('DT_LOCATION')?>",

        "participant": "<?php echo JText::_('DT_PARTICIPANT')?>",

        "get_data_exception": "<?php echo JText::_('DT_DATA_EXCEPTION')?>",

        "new_event": "<?php echo JText::_('DT_NEW_EVENT')?>",

        "confirm_delete_event": "<?php echo JText::_('DT_CONFIRM_DELETE')?> ",

        "confrim_delete_event_or_all": "<?php echo JText::_('DT_DELETE_EVENT_ALL')?>",

        "data_format_error": "<?php echo JText::_('DT_DATE_ERROR')?>",

        "invalid_title": "<?php echo JText::_('DT_EVENT_TITLE_BLANK')?>",

        "view_no_ready": "<?php echo JText::_('DT_VIEW_NOT_READY')?>",

        "example": "<?php echo JText::_('DT_EXAMPLE')?>",

        "content": "<?php echo JText::_('DT_WHAT')?>",

        "create_event": "<?php echo JText::_('DT_CREATE_EVENT')?>",

        "update_detail": "<?php echo JText::_('DT_EDIT_DETAILS')?>",

        "click_to_detail": "<?php echo JText::_('DT_VIEW_DETAILS')?>",

        "i_delete": "<?php echo JText::_('DT_DELETE')?>",

        "day_plural": "<?php echo JText::_('DT_DAYS')?>",

        "others": "<?php echo JText::_('DT_OTHERS')?>",
        "more": "<?php echo JText::_('DT_MORE')?>",
        "see": "<?php echo JText::_('DT_SEE')?>",
        "item": ""

    }

});


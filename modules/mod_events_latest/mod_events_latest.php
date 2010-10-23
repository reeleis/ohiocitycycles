<?php
/**
 * Module Latest Events for Joomla 1.0.x
 *
 * @version     $Id: mod_events_latest.php 843 2007-07-12 07:06:00Z geraint $
 * @package     Events
 * @subpackage  Module Latest Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/**
 * Interface to the Events Component.
 * Displays upcoming events and possibly recent past events according to
 * a set of programmable paramters.  See defintion below.  These parameters
 * can be specified in the module's parameters window in the administration
 * interface.

 * History
 * Rev 1.01 to 1.0: a few minor bugs were fixed in ver 1.01 from 1.0
 * Rev 1.1: implements a new, highly flexible customFormat specifier which can
 *          customize the event content information.
 * Rev 1.11: fixes a bug when no events are displayed.  Crept in somehow. :)
 * Rev 1.2: default display format string changed to display ${eventDate} rather
 *          than ${startDate} to better represent mutli-day events. New mod
 *          parameter 'norepeat' to control display of repeat type events.
 * Rev 1.21: fixed customFormat specifier ${content}, now includes first 150 chars
 *                of the envet content. -change made by Kaz McCoy
 *          fixed events sorting bug. (thanks Thomas Nilsson!)
 *          this module now calls the com_events class mosEventsRepeat to determine
 *          event viewability which should fix those discrepancy bugs betweeb this and
 *          the same events displayed/not displayed in the component
 * Jan 17/04, rev 1.2  Dave McDonnell
 */


// following line is to prevent direct access to this script via the url
defined( '_VALID_MOS' ) or die( 'Restricted access' );

//
// Parameters:
// ===========
//
// maxEvents = max. no. of events to display in the module (1 to 10, default is 5)
//
// mode:
// = 0  (default) display events for current week and following week only up to 'maxEvents'.
//
// = 1  same as 'mode'=0 except some past events for the current week will also be
//      displayed if num of future events is less than $maxEvents.
//
// = 2  display events for +'days' range relative to current day up to $maxEvents.
//
// = 3  same as mode 2 except if there are < 'maxEvents' in the range,
//      then display past events within -'days' range.
//
// = 4  display events for current month up to 'maxEvents'.
//
// days: (default=7) range of days relative to current day to display events for mode 1 or 3.
//
// displayLinks = 1 (default is 0) display event titles as links to the 'view_detail' com_events
//                   task which will display details of the event.
//
// displayYear = 1 (default is 0) display year when displaying dates in the non-customized event's listing.
//
// New for rev 1.1:
//
// disableDateStyle = 1 (default is 0) disables the application of the css style 'mod_events_latest_date' to
//                  the displayed events.  Use this when full customization of the display format is desired.
//                  See customFormat parameter below.
//
// disableTitleStyle = 1 (default is 0) disables the application of the css style 'mod_events_latest_title' to
//                  the displayed event's title.  Use this when full customization of the display format is desired.
//                  See customFormat parameter below.
//
// customFormatStr = string (default is null).  allows a customized specification of the desired event fields and
//                format to be used to display the event in the module.  The string can specify html directly.
//                As well, certain event fields can be specified as ${event_field} in the string.  If desired,
//                the user can even specify overriding inline styles in the event format using <div> or <span>
//                to delineate.  Or the <div>'s or <span>'s can actually reference new css style classes which you
//                can create in the template css file.
//                The ${startDate} and ${endDate} are special event fields which can support further customization
//                of the date and time display by allowing a user to specify exactly how to display the date with
//                identical format control codes to the PHP 'date()' function.
//
//                Event fields available:
//
//                ${startDate}, ${endDate}, ${eventDate}, ${title}, ${category}, ${contact}, ${content}, ${addressInfo}, ${extraInfo},
//                ${createdByAlias}, ${createdByUserName}, ${createdByUserEmail}, ${createdByUserEmailLink},
//                ${eventDetailLink}, ${color}
//
//                ${startDate}, ${eventDate} and ${endDate} can also specify a format in the form of a strftime() format or a
//                date() function format.  If a '%' sign is detected in the format string, strftime() is assumed
//                to be used (supports locale international dates).  An example of a format used:
//                ${startDate('D, M jS, Y, @g:ia')}
//
// Note that the default customFormatStr is '${eventDate}<br />${title}' which will almost display the same information
// and in the same format as in rev 1.11.  ${eventDate} is the actual date of an event within an event's
// start and end publish date ranges.  This more accurately reflects a multi-day event's actual date.


// We split out the functionality into a library so it can be called by mambots requiring latest events information
include_once(dirname(__FILE__)."/mod_events_latest.lib.php");

$jeventLatestObject = &JEventsLatest::getInstance($params);
echo $jeventLatestObject->displayLatestEvents();
?>
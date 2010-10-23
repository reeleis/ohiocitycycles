<?php
/**
 * Module Events Calendar for Joomla 1.0.x
 *
 * @version     $Id: mod_events_cal.php 871 2007-10-08 06:39:41Z geraint $
 * @package     Events
 * @subpackage  Module Events Calendar
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */


/*    Comments: Works only with installed Events Component

    Version 1.4 Modified May 7/04 by dmcd to fix some calendar display bug relating to last days outside current month
    as well as support for displaying up to 3 calendars (IE. Last, This, and Next Month's calendars)
    
    Module Parameters:
    ==================

    displayLastMonth = controls the display of a previous month calendar relative to current date.
                    = 'none' or 0 (default): never display a Last Month's calendar
                    = 'always' : always display a Last Month's calendar
                    = 'always,r' : display a Last Month's calendar. Stop displaying Last Month's
                       calendar if this month's current day of month is at least r.
                    = 'events' : display a Last Month's calendar only if there were scheduled events in that month.
                    = 'events,r' : display Last Month's calendar only if there were events scheduled for that month.
                       Stop displaying Last Month's calendar if this month's current day of month is at least r.
                       
    displayNextMonth = controls the display of a next month calendar relative to current date.
                    = 'none' or 0 (default): never display a Next Month's calendar
                    = 'always' : always display a Next Month's calendar
                    = 'always,r' : display a Next Month's calendar. Start displaying Next Month's
                       calendar if this month's current day of month is within r days of the first day of Next month.
                    = 'events' : display a Next Month's calendar (with current month) only if there are future scheduled
                       events in that month.
                    = 'events,r' : display Next Month's calendar only if there are events scheduled for that month.
                       Start displaying Next Month's calendar if this month's current day of month is within r days
                       of the first day of Next month.
    
    Example:
                displayLastMonth=always,7
                displayNextMonth=always,7
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// In case the module is loaded more than once it needs a definition trap
if (!defined("_MOD_EVENTS_CAL")) {
	define("_MOD_EVENTS_CAL",1);

	function displayCalendarMod($time, $linkString, &$day_name, $monthMustHaveEvent=false){

		global $startday, $database, $timeWithOffset, $my, $modparams;

		$myItemid = findAppropriateMenuID ($catidsOut, $modcatids, $catidList, $modparams);

		$gid = $my->gid;
		if (strlen($catidsOut)>0) $cat = "&amp;catids=$catidsOut";
		else $cat="";

		$cal_year=date("Y",$time);
		$cal_month=date("m",$time);
		$calmonth=date("n",$time);

		$month_name = EventsHelper::getMonthName($cal_month);
		$to_day = date("Y-m-d", $timeWithOffset);

		$cal_prev_month 	= $cal_month - 1;
		$cal_prev_month_yy	= $cal_year;

		$cal_next_month 	= $cal_month + 1;
		$cal_next_month_yy	= $cal_year;

		$cal_mod_next_year	= $cal_year + 1;
		$cal_mod_prev_year	= $cal_year - 1;
		$content			= '';

		// additional EBS
		if( $cal_prev_month == 0 ) {
			$cal_prev_month 	= 12;
			$cal_prev_month_yy 	= $cal_prev_month_yy - 1;
		}
		if( $cal_next_month == 13 ) {
			$cal_next_month 	= 1;
			$cal_next_month_yy 	= $cal_next_month_yy + 1;
		}

		
		if( $modparams->minical_showlink ){

			$content = '<table cellpadding="0" cellspacing="0" width="140" align="center" class="mod_events_monthyear">' . "\n"
			. '<tr >' . "\n";

			if( $modparams->minical_showlink == 1 ){

				$link = 'index.php?option=com_events&amp;Itemid='  . $myItemid . $cat.'&amp;task=';

				if( $modparams->minical_prevyear ){
					$seflinkPrevYear    = sefRelToAbs( $link . 'view_year'
					. '&amp;day=1&amp;month=' . $cal_month . '&amp;year=' . $cal_mod_prev_year
					. '&amp;mod_cal_year=' . $cal_mod_prev_year . '&amp;mod_cal_month=' . $cal_month);
					$content .= '<td>';
					$content .= '<a class="mod_events_link" href="' . $seflinkPrevYear
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_PY . '">&laquo;</a>' . "\n";
					$content .= '</td>';
				}

				if( $modparams->minical_prevmonth ){
					$seflinkPrevMon = sefRelToAbs( $link . 'view_month'
					. '&amp;day=1&amp;month=' . $cal_prev_month . '&amp;year=' . $cal_prev_month_yy
					. '&amp;mod_cal_year=' . $cal_prev_month_yy . '&amp;mod_cal_month=' . $cal_prev_month);

					$content .= '<td>';
					$content .= '<a class="mod_events_link" href="' . $seflinkPrevMon
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_PM . '">&lt;</a>' . "\n";
					$content .= '</td>';
				}

				if( $modparams->minical_actmonth == 1 ){
					// combination of actual month and year: view month
					$seflinkActMonth = sefRelToAbs( $link . 'view_month' . '&amp;month=' . $cal_month
					. '&amp;year=' . $cal_year);

					$content .= '<td align="center">';
					$content .= '<a class="mod_events_link" href="' . $seflinkActMonth
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_MON . '">' . $month_name . '</a>' . "\n";
					if( $modparams->minical_actyear < 1 ) $content .= '</td>';
				}elseif( $modparams->minical_actmonth == 2 ){
					$content .= '<td align="center">';
					$content .= $month_name . "\n";
					if( $modparams->minical_actyear < 1 ) $content .= '</td>';
				}

				if( $modparams->minical_actyear == 1 ){
					// combination of actual month and year: view year
					$seflinkActYear = sefRelToAbs( $link . 'view_year' . '&amp;month=' . $cal_month
					. '&amp;year=' . $cal_year );

					if( $modparams->minical_actmonth < 1 )$content .= '<td align="center">';
					$content .= '<a class="mod_events_link" href="' . $seflinkActYear
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_YEAR . '">' . $cal_year . '</a>' . "\n";
					$content .= '</td>';
				}elseif( $modparams->minical_actyear == 2 ){
					if( $modparams->minical_actmonth < 1 ) $content .= '<td align="center">';
					$content .= $cal_year . "\n";
					$content .= '</td>';
				}

				if( $modparams->minical_nextmonth ){
					$seflinkNextMon = sefRelToAbs( $link . 'view_month'
					. '&amp;day=1&amp;month=' . $cal_next_month . '&amp;year=' . $cal_next_month_yy
					. '&amp;mod_cal_year=' . $cal_next_month_yy . '&amp;mod_cal_month=' . $cal_next_month);

					$content .= '<td>';
					$content .= '<a class="mod_events_link" href="' . $seflinkNextMon
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_NM . '">&gt;</a>' . "\n";
					$content .= '</td>';
				}

				if( $modparams->minical_nextyear ){
					$seflinkNextYear    = sefRelToAbs( $link . 'view_year'
					. '&amp;day=1&amp;month=' . $cal_month . '&amp;year=' . $cal_mod_next_year
					. '&amp;mod_cal_year=' . $cal_mod_next_year . '&amp;mod_cal_month=' . $cal_month );

					$content .= '<td>';
					$content .= '<a class="mod_events_link" href="' . $seflinkNextYear
					. '" title="' . _CAL_LANG_CLICK_TOSWITCH_NY . '">&raquo;</a>' . "\n";
					$content .= '</td>';
				}

				// combination of actual month and year: view year & month [ mic: not used here ]
				// $seflinkActYM   = sefRelToAbs( $link . 'view_month' . '&amp;month=' . $cal_month
				// . '&amp;year=' . $cal_year );
			}else{
				// show only text
				$content .= '<td>';
				$content .= $month_name . ' ' . $cal_year;
				$content .= '</td>';
			}

			$content .= "</tr>\n"
			. "</table>\n";
		}

		$content .= '<table align="center" class="mod_events_table" cellspacing="0" cellpadding="2">' . "\n"
		. '<tr class="mod_events_dayname">' . "\n";

		// Days name rows
		for ($i=0;$i<7;$i++) {
			$content.="<td class='mod_events_td_dayname'>".$day_name[($i+$startday)%7]."</td>\n";
		}

		$content.="</tr>\n";

		// dmcd May 7/04 fix to fill in end days out of month correctly
		$dayOfWeek=$startday;

		$start= (date("w",mktime(0,0,0,$cal_month,1,$cal_year))-$startday+7)%7;

		$d=date("t",mktime(0,0,0,$cal_month,0,$cal_year))-$start + 1;
		if ($start>0) $content.="<tr>\n";
		for($a=$start; $a>0; $a--) {
			$content.="<td class='mod_events_td_dayoutofmonth'>".$d++."</td>\n";
			$dayOfWeek++;
		}


		$monthHasEvent=false;

		$lastDayOfMonth = date("t",mktime(0,0,0,$cal_month,1,$cal_year));

		/********** COPIED FROM EVENTS.PHP **********/

		$select_date 		= $cal_year . '-' . $cal_month . '-01 00:00:00';
		$select_date_fin 	= $cal_year . '-' . $cal_month . '-' . $lastDayOfMonth . ' 23:59:59';

		$query = "SELECT #__events.*"
		. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
		. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
		. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
		. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList($gid,$modcatids,$catidList).")"
		. "\n AND #__events.access <= $gid"
		. "\n AND (((publish_up >= '$select_date%' AND publish_up <= '$select_date_fin%')"
		. "\n OR (publish_down >= '$select_date%' AND publish_down <= '$select_date_fin%')"
		. "\n OR (publish_up >= '$select_date%' AND publish_down <= '$select_date_fin%')"
		. "\n OR (publish_up <= '$select_date%' AND publish_down >= '$select_date_fin%')"
		. "\n )"
		. "\n AND #__events.state = '1')"
		. "\n ORDER BY publish_up ASC" //publish_up ASC, reccurtype ASC
		;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		/********** END COPIED FROM EVENTS.PHP **********/

		$rowcount=count($rows);

		$repeatArray = array();
		for( $i = 0; $i < $rowcount; $i++ ){
			// build array of dates for each event
			$repeatArray[$i] = mosEventRepeatArrayMonth( $rows[$i], $cal_year, $cal_month );
		}

		for($d=1;$d<=$lastDayOfMonth;$d++) {
			// Note that if we are on the last day of the month and last day of week then we won't have
			// any out of month days so don't start a new row!
			if((( date( 'w', mktime( 0, 0, 0, $cal_month, $d, $cal_year )) - $startday ) % 7 ) == 0) {
			// && $d!=date( 't', mktime( 0, 0, 0, $cal_month, $d, $cal_year ))){
				$content.= "<tr>";
			}

			$do = ($d<10) ? "0$d" : "$d";
			$selected_date = "$cal_year-$cal_month-$do";

			$cellDate = mktime(0,0,0,$cal_month,$d,$cal_year);

			$mark_bold			= '';
			$mark_close_bold 	= '';
			$class = ( $selected_date == $to_day ) ? 'mod_events_td_todaynoevents' : 'mod_events_td_daynoevents';

			$dayHasEvent = false;
			for ($r = 0; $r < $rowcount && !$dayHasEvent; $r++) {

				if (array_key_exists($cellDate,$repeatArray[$r])) {
					$monthHasEvent=true;
					$dayHasEvent=true;
					$mark_bold = "<b>";
					$mark_close_bold = "</b>";
					$class = ($selected_date == $to_day) ? "mod_events_td_todaywithevents" : "mod_events_td_daywithevents";
					break;
				}
			}
			$sefdaylink=sefRelToAbs("index.php?option=com_events&amp;task=view_day&amp;year=".$cal_year."&amp;month=".$cal_month."&amp;day=".$do."&amp;Itemid=".$myItemid.$cat);

			$content.="<td class='".$class."'><a class='mod_events_daylink' href='".$sefdaylink."' title='"._CAL_LANG_CLICK_TOSWITCH_DAY ."'>".$mark_bold.$d.$mark_close_bold."</a></td>\n";

			// Check if Next week row
			// dmcd May 7/04 fix to fill in end days out of month correctly
			//if(((date("w",mktime(0,0,0,$cal_month,$d,$cal_year))-$startday+1)%7)==0) {
			if((1 + $dayOfWeek++)%7 == $startday && intval($d)!=date( 't', mktime( 0, 0, 0, $cal_month, $d, $cal_year )))
			$content .= "</tr>\n";

		}

		// Days out of the month
		// dmcd May 7/04 fix to fill in end days out of month correctly
		//if(((date("w",mktime(0,0,0,$cal_month+1,1,$cal_year))-$startday)%7)<>1) {
		$d=1;
		//    while(((date("w",mktime(0,0,0,($cal_month+1),$d,$cal_year))-$startday+1)%7)<>1) {
		while($dayOfWeek++ %7 != $startday) {
			$content.='<td class="mod_events_td_dayoutofmonth">'.$d."</td>\n";
			$d++;
		}

		$content .= '</tr></table>' . "\n";

		// Many people found this confusing! (geraint)
		/* just a textlink [mic] - if wanted just delete the remarks at cont[]
		* if remarks are deleted at content, the links will be displayed right after each months
		* otherwise with cont[] as 1 block after the last month
		*/
		//$seflink = sefRelToAbs( 'index.php?option=com_events&amp;task=view_month&amp;Itemid=' . $myItemid
		//. '&amp;month=' . $cal_month . '&amp;year=' . $cal_year );

		//$content .= '<table width="140" align="center"><tr><td class="mod_events_thismonth" >' . "\n";
		//$content .= '<div align="center"><a class="mod_events_link" href="' . $seflink . '">'
		//. $linkString . '</a></div>' . "\n";

		//$cont[] .= '<div align="center"><a class="mod_events_link" href="' . $seflink . '">' . $linkString.'</a></div>'."\n";

		//$content .= '</td></tr>' . "\n";
		//$content .= '</table>' . "\n";
		/* end textlink */

		// Now check to see if this month needs to have at least 1 event in order to display
		if (!$monthMustHaveEvent || $monthHasEvent) return $content;
		else return '';
	}
}

global $mosConfig_offset, $mosConfig_lang, $mosConfig_debug, $mainframe;

// setup for all required function and classes
$file = mosMainFrame::getBasePath() . 'components/com_events/includes/modutils.php';
if (file_exists($file) ) {
	include_once($file);
} else {
	die ("Events Calendar\n<br />This module needs the Events component");
}

// load language constants
EventsHelper::loadLanguage('modcal');

// get configuration object
$cfg = & EventsConfig::getInstance();

global $modparams ;
$modparams = mosParseParams( $module->params );

// default values if module paramaters have not been explicitly set
if (!isset($modparams->minical_showlink)) $modparams->minical_showlink=0;
if (!isset($modparams->inc_ec_css)) $modparams->inc_ec_css=1;

if( $mosConfig_debug ){
	echo 'PARAMS "' . $modparams . '"<br />';
	print_r( $modparams );
}

if(!isset( $modparams->displayLastMonth )){
	// get com_event config parameters for this module
	switch($cfg->get('modcal_DispLastMonth', 'NO')) {
		case 'YES_stop':
			$disp_lastMonthDays = $cfg->get('modcal_DispLastMonthDays', 0);
			$disp_lastMonth = 1;
			break;
		case 'YES_stop_events':
			$disp_lastMonthDays = $cfg->get('modcal_DispLastMonthDays', 0);
			$disp_lastMonth = 2;
			break;
		case 'ALWAYS':
			$disp_lastMonthDays = 0;
			$disp_lastMonth = 1;
			break;
		case 'ALWAYS_events':
			$disp_lastMonthDays = 0;
			$disp_lastMonth = 2;
			break;
		case 'NO':
		default:
			$disp_lastMonthDays = 0;
			$disp_lastMonth = 0;
			break;
	}
}
else {
	// parse this module parameter
	$displayLastMonth = isset( $modparams->displayLastMonth ) ? $modparams->displayLastMonth : 'none';
	$displayLastMonth=trim($displayLastMonth);

	if(preg_match("/^always/i", $displayLastMonth)) $disp_lastMonth = 1;
	else if(preg_match("/^events/i", $displayLastMonth)) $disp_lastMonth = 2;
	else $disp_lastMonth = 0;

	if($disp_lastMonth){
		list($jnk,$disp_lastMonthDays) = split("[\t ]*,[\t ]*", $displayLastMonth);
		if(!isset($disp_lastMonthDays)) $disp_lastMonthDays = 0;
		$disp_lastMonthDays = abs(intval($disp_lastMonthDays));
	}
}

if(!isset( $modparams->displayNextMonth )){
	// get com_event config parameters for this module
	switch($cfg->get('modcal_DispNextMonth', 'NO')) {
		case 'YES_stop':
			$disp_nextMonthDays = $cfg->get('modcal_DispNextMonthDays', 0);
			$disp_nextMonth = 1;
			break;
		case 'YES_stop_events':
			$disp_nextMonthDays = $cfg->get('modcal_DispNextMonthDays', 0);
			$disp_nextMonth = 2;
			break;
		case 'ALWAYS':
			$disp_nextMonthDays = 0;
			$disp_nextMonth = 1;
			break;
		case 'ALWAYS_events':
			$disp_nextMonthDays = 0;
			$disp_nextMonth = 2;
			break;
		case 'NO':
		default:
			$disp_nextMonthDays = 0;
			$disp_nextMonth = 0;
			break;
	}
}
else {
	$displayNextMonth = isset( $modparams->displayNextMonth ) ? $modparams->displayNextMonth : 'none';
	$displayNextMonth=trim($displayNextMonth);

	if(preg_match("/^always/i", $displayNextMonth)) $disp_nextMonth = 1;
	else if(preg_match("/^events/i", $displayNextMonth)) $disp_nextMonth = 2;
	else $disp_nextMonth = 0;

	if($disp_nextMonth){
		list($jnk,$disp_nextMonthDays) = split("[\t ]*,[\t ]*", $displayNextMonth);
		if(!isset($disp_nextMonthDays)) $disp_nextMonthDays = 0;
		$disp_nextMonthDays = abs(intval($disp_nextMonthDays));
	}
}


////////////////////////////////////////////////
global $timeWithOffset, $startday, $mainframe;

$timeWithOffset = time() + ($mosConfig_offset*60*60);

//date( "Y-m-d H:i:s", mktime() );
$startday = ($cfg->get('com_starday', 0) > 1) ? 0 : $cfg->get('com_starday', 0);
//$start=((date("w",mktime(0,0,0,$cal_month,0,$cal_year))-$startday+7)%7);

$day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>', _CAL_LANG_MONDAYSHORT, _CAL_LANG_TUESDAYSHORT, _CAL_LANG_WEDNESDAYSHORT, _CAL_LANG_THURSDAYSHORT, _CAL_LANG_FRIDAYSHORT, '<span class="saturday">' ._CAL_LANG_SATURDAYSHORT. '</span>' );
$content ="";

// addCustomHeadTag won't work in modules before Joomla 1.5!
global $_VERSION;
if (floatval($_VERSION->getShortVersion())>=1.5){
	global $mosConfig_live_site;
	$mainframe->addCustomHeadTag( "<link href='$mosConfig_live_site/modules/mod_events_cal/mod_events_cal1.5.css' rel='stylesheet' type='text/css' />");
}
else {
	// This breaks xhtml compliance if included !!
	if( $modparams->inc_ec_css) $content .= "<link href='modules/mod_events_cal.css' rel='stylesheet' type='text/css' />\n";
}

// dmcd - May 7/04, make calendar display a function.  Want to show 1,2, or 3 calendars optionally
// depending upon module parameters. (IE. Last Month, This Month, or Next Month)

$thisDayOfMonth = date("j", $timeWithOffset);
$daysLeftInMonth = date("t", $timeWithOffset) - date("j", $timeWithOffset) + 1;

// prepared for textlink
global $cont;
$cont = array();

if($disp_lastMonth && (!$disp_lastMonthDays || $thisDayOfMonth <= $disp_lastMonthDays))
$content .= displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset)-1,1,date("Y", $timeWithOffset)), _CAL_LANG_LAST_MONTH, $day_name, $disp_lastMonth == 2);

$content .= displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset),1,date("Y", $timeWithOffset)), _CAL_LANG_THIS_MONTH, $day_name);

if($disp_nextMonth && (!$disp_nextMonthDays || $daysLeftInMonth <= $disp_nextMonthDays))
$content .= displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset)+1,1,date("Y", $timeWithOffset)), _CAL_LANG_NEXT_MONTH, $day_name, $disp_nextMonth == 2);

// new mic - for displaying months as textlink or tooltip (optional) [ maybe as param option ? ]
if( $cont ){
	foreach( $cont AS $evText ){
		$content .= $evText;
	}
}

if (floatval($_VERSION->getShortVersion())>=1.5){
//	echo $content;
}

?>

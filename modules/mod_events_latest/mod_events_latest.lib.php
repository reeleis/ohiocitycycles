<?php
/**
 * Module Latest Events for Joomla 1.0.x
 *
 * @version     $Id: mod_events_latest.php 372 2007-01-20 20:16:39Z tstahl $
 * @package     Events
 * @subpackage  Module Latest Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/**
 * Library for Latest Events Module
 **/

// following line is to prevent direct access to this script via the url
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// setup for all required function and classes
$file = mosMainFrame::getBasePath() . 'components/com_events/includes/modutils.php';
if (file_exists($file) ) {
	include_once($file);
} else {
	die ("Events Latest\n<br />This module needs the Events component");
}

// load language constants
EventsHelper::loadLanguage('modlatest');

if (!defined( 'EVENTS_LATEST_MODULE' )) {
	define( 'EVENTS_LATEST_MODULE', 1 );

	function JEventsLatestcmpByStartTime (&$a, &$b) {
		// this custom sort compare function compares the start times of events that are referenced by the a & b vars
		if ($a->publish_up == $b->publish_up) return 0;
		if (!isset($a->_startTime)){
			$a->_startTime = mktime($a->hup,$a->minup,$a->sup);
		}
		if (!isset($b->_startTime)){
			$b->_startTime = mktime($b->hup,$b->minup,$b->sup);
		}
		return ($a->_startTime < $b->_startTime) ? -1 : 1;
	}

	class JEventsLatest {
	
	// Note that we encapsulate all this in a class to create
	// an isolated name space from everythng else (I hope).
	
		var $gid				= null;
		var $lang				= null;
		var $catid				= null;
		var $inccss				= null;

		var $maxEvents			= null;
		var $dispMode			= null;
		var $rangeDays			= null;
		var $norepeat			= null;
		var $displayLinks		= null;
		var $displayYear		= null;
		var $disableDateStyle	= null;
		var $disableTitleStyle	= null;
		var $linkCloaking		= null;
		var $customFormatStr	= null;
		var $defaultfFormatStr	= '${eventDate}[!a: - ${endDate(%I:%M%p)}]<br />${title}';

		var $com_starday		= null;

		var $modparams			= null;

		function JEventsLatest(&$params) {

			global $my, $mainframe;

			// get global configuration object
			$jevents_config		= &EventsConfig::getInstance();

			$this->gid     = $my->gid;
			// Can't use getCfg since this cannot be changed by Joomfish etc.
			$this->lang    = $mainframe->getCfg('lang');
			//$this->lang    = $mainframe->getLanguage();
			$this->modparams = & $params;

			// get params exclusive to module
			$this->inccss	= $params->get('modlatest_inccss', 0);

			// get params exclusive to component
			$this->com_starday = intval($jevents_config->get('com_starday',0));

			// get params depending on switch
			if (intval($params->get('modlatest_useLocalParam',  0)) == 1) {
				 $myparam = &$params;
			} else {
				$myparam = &$jevents_config;
			}
			$this->maxEvents			= intval($myparam->get('modlatest_MaxEvents', 15));
			$this->dispMode				= intval($myparam->get('modlatest_Mode',   0));
			$this->rangeDays			= intval($myparam->get('modlatest_Days', 30));
			$this->norepeat				= intval($myparam->get('modlatest_NoRepeat',   0));
			$this->displayLinks			= intval($myparam->get('modlatest_DispLinks', 1));
			$this->displayYear			= intval($myparam->get('modlatest_DispYear',  0));
			$this->disableDateStyle		= intval($myparam->get('modlatest_DisDateStyle',  0));
			$this->disableTitleStyle	= intval($myparam->get('modlatest_DisTitleStyle', 0));
			$this->linkCloaking			= intval($myparam->get('modlatest_LinkCloaking', 0));
			$this->customFormatStr		= $myparam->get('modlatest_CustFmtStr', '');
			if($this->dispMode > 4) $this->dispMode = 0;
			
			// $maxEvents hardcoded to 150 for now to avoid bad mistakes in params
			if($this->maxEvents > 150) $this->maxEvents = 150;

		}

		/**
		 * Creates a JEvents_Latest object
		 *
		 * @param object The module parameter
		 * @return object A JEvents_Latest object
		 */
		function &getInstance(&$params) {
			
			$object = & new  JEventsLatest($params);
			return $object;
		}

		/**
		 * Serves requested category
		 *
		 * @param int category id
		 * @return object database row
		 */
		function &_getCategory($id) {

			global $mainframe;
			global $database;

			static $rows;

			if ($id <= 0) {
				return null;
			}
			if (!isset($rows)) {
				$rows = array();
			}

			if (!isset($rows[$id])) {
				$rows[$id] = null;
				$query = "SELECT id, name FROM #__categories WHERE section= 'com_events'"
					. "\n AND published='1'"
					. "\n AND id = " . $id;
				$database->setQuery($query);
				$database->loadObject($rows[$id]);
			}
			return $rows[$id];
		}

		/**
		 * Serves requested user
		 *
		 * @param int user id
		 * @return object database row
		 */
		function &_getUser($id) {

			global $mainframe;
			global $database;

			static $rows;

			if ($id <= 0) {
				return null;
			}
			if (!isset($rows)) {
				$rows = array();
			}

			if (!isset($rows[$id])) {
				$rows[$id] = null;
				$query = "SELECT id, username, sendEmail, email FROM #__users"
					. "\n WHERE block ='0'"
					. "\n AND id = " . $id;
				$database->setQuery($query);
				$database->loadObject($rows[$id]);
			}
			return $rows[$id];
		}

		/**
		 * Cloaks html link whith javascript
		 *
		 * @param string The cloaking URL
		 * @param string The link text
		 * @return string HTML
		 */
		function _htmlLinkCloaking($url='', $text='') {
	
			$link = sefReltoAbs($url);

			if ($this->linkCloaking) {
				//return mosHTML::Link("", $text, array('onclick'=>'"window.location.href=\''.josURL($url).'\';return false;"'));
				return '<a href="#" onclick="window.location.href=\'' . $link . '\'; return false;">' . $text . '</a>';
			} else {
				//return mosHTML::Link(josURL($url), "$text");
				return '<a href="' . $link .'">' . $text . '</a>';
			}
		}
	
		// The function below is essentially the 'ShowEventsByDate' function in the com_events module,
		// except no actual output is performed.  Rather this function returns an array of references to
		// $rows within the $rows (ie events) input array which occur on the input '$date'.  This
		// is determined by the complicated com_event algorithm according to the event's repeatting type.
			
		
		function getEventsByDate(&$rows, $date, &$seenThisEvent, $noRepeats) {
		
		
			$year = date('Y', $date);
			$month = date('m', $date);
			$day = date('d', $date);
		
			$cellDate = mktime(0,0,0,$month,$day,$year);

			$num_events = count($rows);
			$chhours = "";
			$select_date = $year."-".$month."-".$day;
			$dayOfTheWeek = date("w",$date);
			$printcount = 0;
			$new_rows_events = array();
			
			if ($num_events==0) {
				return $new_rows_events;
			}
			
			for( $i = 0; $i < $num_events; $i++ ){
				// build array of dates for each event
				if (!isset($this->repeatArray[$month][$i])) {
					$this->repeatArray[$month][$i] = mosEventRepeatArrayMonth( $rows[$i], $year, $month );
					// merge it to an array by day
					foreach ($this->repeatArray[$month][$i] as $key => $value) {
						$this->eventsByDay[$key][] = $i;
					}
				}
			}	
			if (isset($this->eventsByDay) && array_key_exists($cellDate, $this->eventsByDay)) {
				// get all items of the day
				foreach ($this->eventsByDay[$cellDate] as $i) {
					$id = $rows[$i]->id;
					if(isset($seenThisEvent[$id]) && $noRepeats) continue;
					$seenThisEvent[$id] = 1;
					$new_rows_events[] = &$rows[$i];
				}
				usort($new_rows_events, "JEventsLatestcmpByStartTime");
			}

			return $new_rows_events;
		
		} // end function

		function displayLatestEvents($asHTML=true){
			
			global $mainframe;
			global $database;
			global $_MAMBOTS;

			static $isloaded_css = false;

			$now = time()+($mainframe->getCfg('offset')*60*60);
			$now_Y_m_d	= date('Y-m-d', $now);
			$now_d		= date('d', $now);
			$now_m		= date('m', $now);
			$now_Y		= date('Y', $now);
			$now_w		= date("w", $now);

			$content = null;
			
			if( $this->inccss && !$isloaded_css && $asHTML) {
				$content .= '<link href="' . $mainframe->getCfg('live_site') . '/modules/mod_events_latest.css" rel="stylesheet" type="text/css" />' . "\n";
				$isloaded_css = true;
			}
			$catidsOut = null;
			$modcatids = null;
			$catidList = null;

			$myItemid = findAppropriateMenuID($catidsOut, $modcatids, $catidList, $this->modparams->toObject());

			$cat = "";
			if ($catidsOut != 0){
				$cat = '&amp;catids='.$catidsOut;
			}
			// derive the event date range we want based on current date and 
			// form the db query.
			
			$todayBegin = $now_Y_m_d . " 00:00:00";
			$yesterdayEnd = date('Y-m-d', mktime(0,0,0,$now_m,$now_d - 1, $now_Y))." 23:59:59";
			
			switch ($this->dispMode){
			case 0:
			case 1:
			
				// week start (ie. Sun or Mon) is according to what has been selected in the events
				// component configuration thru the events admin interface.
				
				$numDay=($now_w - $this->com_starday + 7)%7;
				// begin of this week
				$beginDate = date('Y-m-d', mktime(0,0,0,$now_m,$now_d - $numDay, $now_Y))." 00:00:00";
				//$thisWeekEnd = date('Y-m-d', mktime(0,0,0,date('m'),date('d') - date('w')+6, date('Y'))." 23:59:59";
				// end of next week
				$endDate = date('Y-m-d', mktime(0,0,0,$now_m,$now_d - $numDay + 13, $now_Y))." 23:59:59";
				break;
				
			case 2:
			case 3:
				// begin of today - $days
				$beginDate = date('Y-m-d', mktime(0,0,0,$now_m,$now_d - $this->rangeDays, $now_Y))." 00:00:00";
				// end of today + $days
				$endDate = date('Y-m-d', mktime(0,0,0,$now_m,$now_d + $this->rangeDays, $now_Y))." 23:59:59";
				break;
				
			case 4:
			default:
				// beginning of this month
				$beginDate = date('Y-m-d', mktime(0,0,0,$now_m,1, $now_Y))." 00:00:00";
				// end of this month
				$endDate = date('Y-m-d', mktime(0,0,0,$now_m+1,0, $now_Y))." 23:59:59";
				break;
			}
		
			$query = "SELECT #__events.* "
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM (#__events)"
			. "\n WHERE #__events.catid IN(".accessibleCategoryList($this->gid,$modcatids,$catidList).")"
			. "\n AND #__events.access <= $this->gid"	
			. "\n AND (#__events.state='1' AND #__events.checked_out='0')"
			. "\n AND ((publish_up <= '$todayBegin%' AND publish_down >= '$todayBegin%')"
			. "\n OR (publish_up <= '$endDate%' AND publish_down >= '$endDate%')"
			. "\n OR (publish_up <= '$endDate%' AND publish_up >= '$todayBegin%')"
			. "\n OR (publish_down <= '$endDate%' AND publish_down >= '$todayBegin%'))"
			. "\n ORDER BY publish_up ASC";

			
			// initialise the query in the $database connector
			// this translates the '#__' prefix into the real database prefix
			
			$database->setQuery( $query );
		
			// retrieve the list of returned records as an array of objects
			
			$rows = $database->loadObjectList();
			
			// determine the events that occur each day within our range
			
			$events = 0;
			$date = $now;
			$lastDate = mktime(0,0,0,intval(substr($endDate,5,2)),intval(substr($endDate,8,2)),intval(substr($endDate,0,4)));
			$i=0;
			if ($asHTML){
				$content .= '<table class="mod_events_latest_table" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
			}
			$seenThisEvent = array();
			
			if(count($rows)){
				while($date <= $lastDate){
					// get the events for this $date
					$eventsThisDay = $this->getEventsByDate($rows, $date, $seenThisEvent, $this->norepeat);
					if(count($eventsThisDay)) {
						// dmcd May 7/04  bug fix to not exceed maxEvents
									$eventsToAdd = min($this->maxEvents-$events, count($eventsThisDay));
									$eventsThisDay = array_slice($eventsThisDay, 0, $eventsToAdd);
									
									$eventsByRelDay[$i] = $eventsThisDay;
						$events += count($eventsByRelDay[$i]);
					}
					if($events >= $this->maxEvents) break;
					$date = mktime(0,0,0,date('m', $date),date('d', $date)+1,date('Y', $date));
					$i++;
				}
			}

			if($events < $this->maxEvents && ($this->dispMode==1 || $this->dispMode==3)){
				// display some recent previous events too up to a total of $maxEvents

				$query = "SELECT #__events.* "
				. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
				. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
				. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
				. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
				. "\n FROM (#__events)"
				. "\n WHERE #__events.catid IN(".accessibleCategoryList($this->gid,$modcatids,$catidList).")"
				. "\n AND #__events.access <= $this->gid"	
				. "\n AND (#__events.state='1' AND #__events.checked_out='0')"
				. "\n AND ((publish_up <= '$beginDate%' AND publish_down >= '$beginDate%')"
				. "\n OR (publish_up <= '$yesterdayEnd%' AND publish_down >= '$yesterdayEnd%')"
				. "\n OR (publish_up <= '$yesterdayEnd%' AND publish_up >= '$beginDate%')"
				. "\n OR (publish_down <= '$yesterdayEnd%' AND publish_down >= '$beginDate%'))"
				. "\n ORDER BY publish_up DESC";

			
				// initialise the query in the $database connector
				// this translates the '#__' prefix into the real database prefix
				$database->setQuery( $query );
			
				// retrieve the list of returned records as an array of objects
			
				$prows = $database->loadObjectList();
			
				if(count($prows)){
					
					// start from yesterday
					$date = mktime(23,59,59,$now_m,$now_d-1,$now_Y);
					$lastDate = mktime(0,0,0,intval(substr($beginDate,5,2)),intval(substr($beginDate,8,2)),intval(substr($beginDate,0,4)));
					$i=-1;
					
					while($date >= $lastDate){
						// get the events for this $date
						$eventsThisDay = $this->getEventsByDate($prows, $date, $seenThisEvent, $this->norepeat);
						if(count($eventsThisDay)) {
							$eventsByRelDay[$i] = $eventsThisDay;
							$events += count($eventsByRelDay[$i]);
						}
						if($events >= $this->maxEvents) break;
						$date = mktime(0,0,0,date('m', $date),date('d', $date)-1,date('Y', $date));
						$i--;
					}
				}
			}
			
			//asdbg_break();
			if(isset($eventsByRelDay) && count($eventsByRelDay)){
				
				// Now to display these events, we just start at the smallest index of the $eventsByRelDay array
				// and work our way up.
			
				ksort($eventsByRelDay, SORT_NUMERIC);
				reset($eventsByRelDay);
			
				$firstTime=true;
			
				// initialize name of com_events module and task defined to view
				// event detail.  Note that these could change in future com_event
				// component revisions!!  Note that the '$itemId' can be left out in
				// the link parameters for event details below since the event.php
				// component handler will fetch its own id from the db menu table
				// anyways as far as I understand it.
				
				$option      = 'com_events';
				$task_events = 'view_detail';
			
			
			
				// Note we MUST get the $Itemid value for the events component
				// here, or some mambo things can break.
				/* replace by findAppropriateMenuID [tstahl]
				$query = "SELECT id"
				. "\n FROM #__menu WHERE"
				. "\n link = 'index.php?option=$option'"
				. "\n AND published = 1"
				. "\n AND access <= $this->gid"
				. "\n ORDER BY access ASC";
				$database->setQuery($query);
				$Itemid = intval($database->loadResult());
				*/


				/*	tstahl, 30.05.2006, fetch $category and $users attributes by class function on demand

				// get the com_events category names from the categories mos table
				
				$database->setQuery("SELECT id, name FROM #__categories WHERE section= 'com_events' AND published='1'");
				$category = $database->loadObjectList('id');
				
				// get the usernames and email addresses from the users mos table
				
				$database->setQuery("SELECT id, username, sendEmail, email FROM #__users WHERE block ='0'");
				$users = $database->loadObjectList('id');
				*/

				// see if $customFormatStr has been specified.  If not, set it to the default format
				// of date followed by event title.
				if($this->customFormatStr == NULL) $this->customFormatStr = $this->defaultfFormatStr;
				else {
						$this->customFormatStr = preg_replace('/^"(.*)"$/', "\$1", $this->customFormatStr);
						$this->customFormatStr = preg_replace("/^'(.*)'$/", "\$1", $this->customFormatStr);
						// escape all " within the string
						// $customFormatStr = preg_replace('/"/','\"', $customFormatStr);
					}
			
				// strip out event variables and run the string thru an html checker to make sure
				// it is legal html.  If not, we will not use the custom format and print an error
				// message in the module output.  This functionality is not here for now.
			
				// parse the event variables and reformat them into php syntax with special handling
				// for the startDate and endDate fields.
				//asdbg_break();
				$customFormat=$this->customFormatStr;

				$keywords = array(
							'content',				'eventDetailLink',		'createdByAlias',	'color',
							'createdByUserName',	'createdByUserEmail',	'createdByUserEmailLink',
							'eventDate',			'endDate',				'startDate',		'title',	'category',
							'contact',				'addressInfo',			'extraInfo'
							);
				$keywords_or = implode('|', $keywords);
				$whsp		= '[\t ]*'; // white space
				$datefm		= '\([^\)]*\)'; // date formats
				//$modifiers	= '(?::[[:alnum:]]*)';

				$pattern		= '/(\$\{'.$whsp.'(?:'.$keywords_or.')(?:'.$datefm.')?'.$whsp.'\})/';	// keyword pattern
				$cond_pattern	= '/(\[!?[[:alnum:]]+:[^\]]*])/';	// conditional string pattern e.g. [!a: blabla ${endDate(%a)}]
				
				// tokenize conditional strings
				$splitTerm = preg_split($cond_pattern, $customFormat, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

				$splitCustomFormat = array();
				foreach ( $splitTerm as $key => $value) {
					if (preg_match('/^\[(.*)\]$/', $value, $matches)) {
						// remove outer []
						$splitCustomFormat[$key]['data'] = $matches[1];
						// split condition
						preg_match('/^([^:]*):(.*)$/', $splitCustomFormat[$key]['data'], $matches);
						$splitCustomFormat[$key]['cond'] = $matches[1];
						$splitCustomFormat[$key]['data'] = $matches[2];
					} else {
						$splitCustomFormat[$key]['data'] = $value;
					}
					// tokenize into array
					$splitCustomFormat[$key]['data'] = preg_split($pattern, $splitCustomFormat[$key]['data'], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				}

				// cleanup, remove white spaces from key words, seperate date parm string and modifier into array;
				// e.g.  ${ keyword ( 'aaaa' ) } => array('keyword', 'aaa',)
				foreach($splitCustomFormat as $ix => $yy) {
					foreach($splitCustomFormat[$ix]['data'] as $keyToken => $customToken) {
						if (preg_match('/\$\{'.$whsp.'('.$keywords_or.')('.$datefm.')?'.$whsp.'}/', $customToken, $matches)) {
							$splitCustomFormat[$ix]['data'][$keyToken] = array();
							$splitCustomFormat[$ix]['data'][$keyToken]['keyword'] = stripslashes($matches[1]);
							if (isset($matches[2])) {
								// ('aaa') => aaa
								$splitCustomFormat[$ix]['data'][$keyToken]['dateParm'] = preg_replace('/^\(["\']?(.*)["\']?\)$/',"\$1", stripslashes($matches[2]));
							}
						} else {
							$splitCustomFormat[$ix]['data'][$keyToken] = stripslashes($customToken);
						}
					}
				}
			
				$_MAMBOTS->loadBotGroup( 'content' );

				foreach($eventsByRelDay as $relDay => $daysEvents){
			
					reset($daysEvents);
			
					// get all of the events for this day
					foreach($daysEvents as $dayEvent){
						// get the title and start time
						$startDate = $dayEvent->publish_up;
							$eventDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
								$now_m,$now_d + $relDay,$now_Y);
						$startDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
							substr($startDate,5,2), substr($startDate,8,2), substr($startDate,0,4));
						$endDate = $dayEvent->publish_down;
						$endDate = mktime(substr($endDate,11,2),substr($endDate,14,2), substr($endDate,17,2),
							substr($endDate,5,2), substr($endDate,8,2), substr($endDate,0,4));
			
						$year = date('Y', $startDate);
						$month = date('m', $startDate);
						$day = date('d', $startDate);
			
						if ($asHTML){
							if($firstTime) $content .= '<tr><td class="mod_events_latest_first">';
							else $content .= '<tr><td class="mod_events_latest">';
						}
			
						// generate output according custom string
						foreach($splitCustomFormat as $condtoken) {

							// evaluate all_day_event
							$all_day_event = false;
							//if ($dayEvent->publish_up == $dayEvent->publish_down) {
							if (($dayEvent->hup   == $dayEvent->hdn) &&
								($dayEvent->minup == $dayEvent->mindn) &&
								($dayEvent->sup   == $dayEvent->sdn)) {
								$all_day_event = true;
							}

							if (isset($condtoken['cond'])) {
								if ( $condtoken['cond'] == 'a'  && !$all_day_event) continue;
								if ( $condtoken['cond'] == '!a' &&  $all_day_event) continue;
							}
							foreach($condtoken['data'] as $token) {
								unset($match);
								unset($dateParm);
								$match='';
								if (is_array($token)) {
									$match = $token['keyword'];
									$dateParm = isset($token['dateParm']) ? trim($token['dateParm']) : "";
								} else {
									$content .= $token;
									continue;
								}
							
			
								switch ($match){
				
									case 'endDate':
									case 'startDate':
									case 'eventDate':
										// Note we need to examine the date specifiers used to determine if language translation will be
										// necessary.  Do this later when script is debugged.
					
										if(!$this->disableDateStyle && $asHTML)  $content .= '<span class="mod_events_latest_date">';
				
										if (!isset($dateParm) || $dateParm == ''){
											// no actual format specified, use default, eg. Fri Oct 12th, @7:30pm\
											// use the strftime function for international support
											if($this->lang == 'english'){
											//if($lang == 'english'){
												$time_fmt = $all_day_event ? '' : ', @g:ia';
												$dateFormat = $this->displayYear ?  'D, M jS, Y'.$time_fmt: 'D, M jS'.$time_fmt;
												$content .= date($dateFormat, $$match);
											} else {
												$time_fmt = $all_day_event ? '' : ' @%I:%M%p';
												$dateFormat = $this->displayYear ? '%a %b %d, %Y'.$time_fmt : '%a %b %d'.$time_fmt;
												$content .= strftime($dateFormat, $$match);
											}
										} else {
											// if a '%' sign detected in date format string, we assume strftime() is to be used,
											if(preg_match("/\%/", $dateParm)) $content .= strftime($dateParm, $$match);
											// otherwise the date() function is assumed.
											else $content .= date($dateParm, $$match);
										}
				
										if(!$this->disableDateStyle && $asHTML) $content .= "</span>";
									break;
				
									case 'title':
				
										if (!$this->disableTitleStyle && $asHTML) $content .= '<span class="mod_events_latest_content">';
										if ($this->displayLinks) {
			
											$content .= $this->_htmlLinkCloaking("index.php?option=".$option
												. "&amp;task="  . $task_events
												. "&amp;agid="  . $dayEvent->id
												. "&amp;year="  . date("Y", $eventDate)
												. "&amp;month=" . date("m", $eventDate)
												. "&amp;day=" 	. date("d", $eventDate)
												. "&amp;Itemid=". $myItemid
												. $cat, $dayEvent->title);
										} else {
											$content .= $dayEvent->title;
										}
										if (!$this->disableTitleStyle && $asHTML) $content .= '</span>';
									break;
				
									case 'category':
										$catobj   = $this->_getCategory($dayEvent->catid);
										$content .= $catobj->name;
									break;
				
									case 'contact':
										// Also want to cloak contact details so 
										$this->modparams->set("image",1);
										$dayEvent->text = $dayEvent->contact_info;
										$_MAMBOTS->trigger( 'onPrepareContent', array( &$dayEvent, &$this->modparams, 0 ), true ); 
										$dayEvent->contact_info=$dayEvent->text;
										$content .= $dayEvent->contact_info;
									break;
				
									case 'content':  // Added by Kaz McCoy 1-10-2004
										$this->modparams->set("image",1);
										$dayEvent->text = $dayEvent->content;
										$results = $_MAMBOTS->trigger( 'onPrepareContent', array( &$dayEvent, &$this->modparams, 0 ), true ); 
										$dayEvent->content = $dayEvent->text ;
										//$content .= substr($dayEvent->content, 0, 150);
										$content .= $dayEvent->content;
									break;
				
									case 'addressInfo':
										$content .= $dayEvent->adresse_info;
									break;
				
									case 'extraInfo':
										$content .= $dayEvent->extra_info;
									break;
				
									case 'createdByAlias':
										$content .= $dayEvent->created_by_alias;
									break;
				
									case 'createdByUserName':
										$catobj   = $this->_getUser($dayEvent->created_by);
										$content .= $catobj->username;
									break;
				
									case 'createdByUserEmail':
										// Note that users email address will NOT be available if they don't want to receive email
										$catobj   = $this->_getUser($dayEvent->created_by);
										$content .= $catobj->sendEmail ? $catobj->email : '';
									break;
				
									case 'createdByUserEmailLink':
										// Note that users email address will NOT be available if they don't want to receive email
										$content .= sefRelToAbs("index.php?option="
											. $option
											. "&amp;task=".$task_events
											. "&amp;agid=".$dayEvent->id
											. "&amp;year=".$year
											. "&amp;month=".$month
											. "&amp;day=".$day
											. "&amp;Itemid=".$myItemid
											. $cat);
									break;
				
									case 'color':
										$content .= $dayEvent->color_bar;
									break;
				
									case 'eventDetailLink':
										$content .= sefRelToAbs("index.php?option="
											. $option
											. "&amp;task=".$task_events
											. "&amp;agid=".$dayEvent->id
											. "&amp;year=".$year
											. "&amp;month=".$month
											. "&amp;day=".$day
											. "&amp;Itemid=".$myItemid
											. $cat);
				
									break;
				
									default:
										if ($match) $content .= $match;
									break;
								} // end of switch
							} // end of foreach
						} // end of foreach
						if ($asHTML){
							$content .= "</td></tr>\n";
						}
						else {
							$content .="\n";
						}
						$firstTime=false;
					} // end of foreach
				} // end of foreach
			
			} else {
				if ($asHTML){
					$content .= '<tr><td class="mod_events_latest_noevents">'. _CAL_LANG_NO_EVENTS . '</td></tr>' . "\n";
				}
				else {
					$content .=  _CAL_LANG_NO_EVENTS  . "\n";
				}
			}
			if ($asHTML){
				$content .="</table>\n";
			}
			return $content;
		} // end of function
	} // end of class
} // !defined( 'JEVENTS_LATEST_MODULE')

?>

<?php
/**
 * @version 0.9 $Id: helper.php 507 2008-01-03 15:48:34Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');

/**
 *
 * Holds some usefull functions to keep the code a bit cleaner
 *
 * @package Joomla
 * @subpackage EventList
 */
class ELHelper {

	/**
	 * Pulls settings from database
	 *
	 * @return object
	 * @since 0.9
	 */
	function elconfig()
	{
		$db =& JFactory::getDBO();

		$sql = 'SELECT * FROM #__eventlist_settings WHERE id = 1';
		$db->setQuery($sql);
		$config = $db->loadObject();

		return $config;
	}

	/**
	 * Receives settings from session
	 *
	 * @return object
	 * @since 0.9
	 */
	function config()
	{
		$session =& JFactory::getSession();

		$config = $session->get('elsettings');

		return $config;
	}

	/**
   	* Moves old events in the archive or delete them
   	*
 	* @since 0.9
   	*/
	function cleanevents($lastupdate)
	{
		$now = time();

		//last update later then 24h?
		//$difference = $now - $lastupdate;

		//if ( $difference > 86400 ) {

		//better: new day since last update?
		$nrdaysnow = floor($now / 86400);
		$nrdaysupdate = floor($lastupdate / 86400);

		if ( $nrdaysnow > $nrdaysupdate ) {

			$db			= & JFactory::getDBO();
			$elsettings = ELHelper::config();

			$nulldate = '0000-00-00';
			$query = 'SELECT * FROM #__eventlist_events WHERE DATE_SUB(NOW(), INTERVAL '.$elsettings->minus.' DAY) > (IF (enddates <> '.$nulldate.', enddates, dates)) AND recurrence_number <> "0" AND recurrence_type <> "0" AND `published` = 1';
			$db->SetQuery( $query );
			$recurrence_array = $db->loadAssocList();

			foreach($recurrence_array as $recurrence_row) {
				$insert_keys = '';
				$insert_values = '';
				$wherequery = '';

				// get the recurrence information
				$recurrence_number = $recurrence_row['recurrence_number'];
				$recurrence_type = $recurrence_row['recurrence_type'];

				$recurrence_row = ELHelper::calculate_recurrence($recurrence_row);
				if (($recurrence_row['dates'] <= $recurrence_row['recurrence_counter']) || ($recurrence_row['recurrence_counter'] == "0000-00-00")) {

					// create the INSERT query
					foreach ($recurrence_row as $key => $result) {
						if ($key != 'id') {
							if ($insert_keys != '') {
								$wherequery .= ' AND ';
								$insert_keys .= ', ';
								$insert_values .= ', ';
							}
							$insert_keys .= $key;
							if (($key == "enddates" || $key == "times" || $key == "endtimes") && $result == "") {
								$insert_values .= "NULL";
								$wherequery .= '`'.$key.'` IS NULL';
							} else {
								$insert_values .= "'".$result."'";
								$wherequery .= '`'.$key.'` = "'.$result.'"';
							}
						}
					}

					$query = 'SELECT id FROM #__eventlist_events WHERE '.$wherequery.';';

					$db->SetQuery( $query );

					if (count($db->loadAssocList()) == 0) {
						$query = 'INSERT INTO #__eventlist_events ('.$insert_keys.') VALUES ('.$insert_values.');';
						$db->SetQuery( $query );
						$db->Query();
					}
				}
			}

			if ($elsettings->oldevent == 1) {
				$query = 'DELETE FROM #__eventlist_events WHERE DATE_SUB(NOW(), INTERVAL '.$elsettings->minus.' DAY) > (IF (enddates <> '.$nulldate.', enddates, dates))';
				$db->SetQuery( $query );
				$db->Query();
			}

			if ($elsettings->oldevent == 2) {
				$query = 'UPDATE #__eventlist_events SET published = -1 WHERE DATE_SUB(NOW(), INTERVAL '.$elsettings->minus.' DAY) > (IF (enddates <> '.$nulldate.', enddates, dates))';
				$db->SetQuery( $query );
				$db->Query();
			}

			$query = 'UPDATE #__eventlist_settings SET lastupdate = '.time().' WHERE id = 1';
			$db->SetQuery( $query );
			$db->Query();
		}
	}

	/**
	 * this methode calculate the next date
	 */
	function calculate_recurrence($recurrence_row) {
		// get the recurrence information
		$recurrence_number = $recurrence_row['recurrence_number'];
		$recurrence_type = $recurrence_row['recurrence_type'];

		$day_time = 86400;	// 60 sec. * 60 min. * 24 h
		$week_time = 604800;// $day_time * 7days
		$date_array = ELHelper::generate_date($recurrence_row['dates'], $recurrence_row['enddates']);


		switch($recurrence_type) {
			case "1":
				// +1 hour for the Summer to Winter clock change
				$start_day = mktime(1,0,0,$date_array["month"],$date_array["day"],$date_array["year"]);
				$start_day = $start_day + ($recurrence_number * $day_time);
				break;
			case "2":
				// +1 hour for the Summer to Winter clock change
				$start_day = mktime(1,0,0,$date_array["month"],$date_array["day"],$date_array["year"]);
				$start_day = $start_day + ($recurrence_number * $week_time);
				break;
			case "3":
				$start_day = mktime(1,0,0,($date_array["month"] + $recurrence_number),$date_array["day"],$date_array["year"]);;
				break;
			default:
				$weekday_must = ($recurrence_row['recurrence_type'] - 3);	// the 'must' weekday
				if ($recurrence_number < 5) {	// 1. - 4. week in a month
					// the first day in the new month
					$start_day = mktime(1,0,0,($date_array["month"] + 1),1,$date_array["year"]);
					$weekday_is = date("w",$start_day);							// get the weekday of the first day in this month

					// calculate the day difference between these days
					if ($weekday_is <= $weekday_must) {
						$day_diff = $weekday_must - $weekday_is;
					} else {
						$day_diff = ($weekday_must + 7) - $weekday_is;
					}
					$start_day = ($start_day + ($day_diff * $day_time)) + ($week_time * ($recurrence_number - 1));
				} else {	// the last or the before last week in a month
					// the last day in the new month
					$start_day = mktime(1,0,0,($date_array["month"] + 2),1,$date_array["year"]) - $day_time;
					$weekday_is = date("w",$start_day);
					// calculate the day difference between these days
					if ($weekday_is >= $weekday_must) {
						$day_diff = $weekday_is - $weekday_must;
					} else {
						$day_diff = ($weekday_is - $weekday_must) + 7;
					}
					$start_day = ($start_day - ($day_diff * $day_time));
					if ($recurrence_number == 6) {	// before last?
						$start_day = $start_day - $week_time;
					}
				}
				break;
		}
		$recurrence_row['dates'] = date("Y-m-d", $start_day);
		if ($recurrence_row['enddates']) {
			$recurrence_row['enddates'] = date("Y-m-d", $start_day + $date_array["day_diff"]);
		}
		return $recurrence_row;
	}

	/**
	 * this method generate the date string to a date array
	 *
	 * @var string the date string
	 * @return array the date informations
	 * @access public
	 */
	function generate_date($startdate, $enddate) {
		$startdate = explode("-",$startdate);
		$date_array = array("year" => $startdate[0],
							"month" => $startdate[1],
							"day" => $startdate[2],
							"weekday" => date("w",mktime(1,0,0,$startdate[1],$startdate[2],$startdate[0])));
		if ($enddate) {
			$enddate = explode("-", $enddate);
			$day_diff = (mktime(1,0,0,$enddate[1],$enddate[2],$enddate[0]) - mktime(1,0,0,$startdate[1],$startdate[2],$startdate[0]));
			$date_array["day_diff"] = $day_diff;
		}
		return $date_array;
	}
}
?>
<?php 
define( '_JEXEC', 1 );

define('JPATH_BASE', dirname(__FILE__) );


define('DS', DIRECTORY_SEPARATOR);

require_once( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once( JPATH_BASE .DS.'includes'.DS.'helper.php' );
require_once( JPATH_BASE .DS.'includes'.DS.'toolbar.php' );
/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('administrator');

/**
 * INITIALISE THE APPLICATION
 *
 * NOTE :
 */
$mainframe->initialise(array(
        'language' => $mainframe->getUserState( "application.lang", 'lang' )
));
	
	$startDate = new DateTime(JRequest::getVar('startdate'));
	$endDate = new DateTime(JRequest::getVar('enddate'));
	$startDate = empty($startDate) ? "'2010-06-30 23:50:52'" : $startDate;
	$endDate = empty($endDate) ? "'2011-6-30 23:50:52'" : $endDate;
	$db =& JFactory::getDBO();
	$dateFormat = 'Y-m-d';
	$query = "
	SELECT
nameFirst
,coalesce(NonBikeTime, 0) AS NonBikeTime
,BikeTime
,100*BikeTime/(BikeTime + coalesce(NonBikeTime,0)) AS BikeTimePct
,TotalBikeCount
,TotalBikeValue
,AverageValue
,TotalBikeValue/BikeTime AS BikeHourValue
,TotalBikeValue/(BikeTime + coalesce(NonBikeTime,0)) AS HourlyValue
FROM
(
SELECT
t.memberid
,m.nameFirst
,sum(totalTime)/3600 AS BikeTime
FROM
jos_cbodb_transactions t
INNER JOIN
jos_cbodb_members m
ON m.id = t.memberid
Where
type = 4
and t.dateOpen > '" . $startDate->format($dateFormat ) . "'
and t.dateOpen < '" . $endDate->format($dateFormat ) . "'
AND t.memberid IN (SELECT biketimeid FROM `jos_cbodb_staff_biketime_mapping`)
GROUP BY t.memberid
) TB
LEFT JOIN
(
SELECT
t.memberid NonBikeID
,b.biketimeid as BikeID
,sum(totalTime)/3600 AS NonBikeTime
FROM
jos_cbodb_transactions t
INNER JOIN
jos_cbodb_staff_biketime_mapping b
ON t.memberID = b.nonbiketimeid
Where
type = 4
and t.dateOpen > '" . $startDate->format($dateFormat ) . "'
and t.dateOpen < '" . $endDate->format($dateFormat ) . "'
AND t.memberid IN (SELECT nonbiketimeid FROM `jos_cbodb_staff_biketime_mapping`)
GROUP BY t.memberid
) NB
ON TB.memberid = NB.BikeID
LEFT JOIN
(
SELECT
YEAR(TimeAdded),
commissionUserID AS CommissionID,
COUNT(*) TotalBikeCount,
SUM(PriceSale) AS TotalBikeValue,
CONVERT(SUM(PriceSale)/COUNT(*), SIGNED) AS AverageValue
FROM
	`jos_cbodb_items` i
WHERE
i.commissionUserID <> 0
and i.timeadded > '" . $startDate->format($dateFormat ) . "'
and i.timeadded < '" . $endDate->format($dateFormat ) . "'
GROUP BY
commissionUserID
) BV
on BV.CommissionID = NB.NonBikeID OR BV.CommissionID = memberid
"
/*	"SELECT Last_Name, First_Name, year_hours
FROM ((SELECT m.nameFirst as First_Name,
m.nameLast as Last_Name,
(SUM(t.totalTime)/3600) as year_hours
FROM `jos_cbodb_transactions` t INNER JOIN `jos_cbodb_members` m on 
t.memberID = m.id
WHERE t.dateOpen > '" . $startDate->format($dateFormat ) .
"' AND t.dateOpen < '" . $endDate->format($dateFormat ) . 
"' AND t.type = 1
GROUP BY t.memberID) hour_sum)
ORDER BY Last_Name"*/; 

	$db->setQuery($query);
	$rows = $db->loadRowList();
	
		if ($db->getErrorNum())
                {
                        echo $db->stderr();
                        exit;
                }



	$headers = array( "First Name", "Non-Bike Time", "Bike Time", "Bike Time Pct", "Total Bike Count",
					"Total Bike Value","Average Bike Value","Hourly Value (Bike Time)","Hourly Value (Total Time)") ;
	/*nameFirst
,coalesce(NonBikeTime, 0) AS NonBikeTime
,BikeTime
,100*BikeTime/(BikeTime + coalesce(NonBikeTime,0)) AS BikeTimePct
,TotalBikeCount
,TotalBikeValue
,AverageValue
,TotalBikeValue/BikeTime AS BikeHourValue
,TotalBikeValue/(BikeTime + coalesce(NonBikeTime,0)) AS HourlyValue
,TotalBikeValue/(BikeTime + coalesce(NonBikeTime,0))*0.80 AS LoanValue*/
	header("Content-type: text/csv");
	
	header("Content-Disposition: attachment; filename=\"staffproductivity.csv\"");
	
	echo "Staff Productivity report for " . $startDate->format($dateFormat ) . " through ". $endDate->format($dateFormat ) . "\n";
	
	for($k = 0; $k < sizeof($headers) - 1; $k++) {
		echo '"'.$headers[$k].'",';
	}
	echo '"'.$headers[sizeof($headers)-1]."\"\n";


	for($i = 0; $i < sizeof($rows); $i++ ) {
		$row = $rows[$i];
		for($j = 0; $j < sizeof($row) - 1; $j++) {
			echo '"'. $row[$j].'",';
			
		}
		echo '"'.$row[sizeof($row) -1]."\"\n";
	}
	exit;
?>


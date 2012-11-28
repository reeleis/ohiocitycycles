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
	$query ="
	SELECT
		Last_Name,
		First_Name,
		year_hours
	FROM
		(
		(SELECT
			m.nameFirst as First_Name,
			m.nameLast as Last_Name,
			(SUM(t.totalTime)/3600) as year_hours
		FROM
			`jos_cbodb_transactions` t
			INNER JOIN `jos_cbodb_members` m
			ON t.memberID = m.id
		WHERE t.dateOpen > '" . $startDate->format($dateFormat ) .
		"' AND t.dateOpen < '" . $endDate->format($dateFormat ) . 
		"' AND t.type = 1
		GROUP BY t.memberID)
		hour_sum)
		ORDER BY Last_Name"; 

	$db->setQuery($query);
	$rows = $db->loadRowList();
	
		if ($db->getErrorNum())
                {
                        echo $db->stderr();
                        exit;
                }



	$headers = array( "Last Name", "First Name", "Total Hours") ;

	header("Content-type: text/csv");
	
	header("Content-Disposition: attachment; filename=\"volunteering.csv\"");
	
	echo "Volunteer hours report for " . $startDate->format($dateFormat ) . " through ". $endDate->format($dateFormat ) . "\n";
	
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


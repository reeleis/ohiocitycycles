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
	
	$currentdate =& JFactory::getDate();
	$db =& JFactory::getDBO();
	$dateFormat = 'Y-m-d H:i:s';
	$query = "
	SELECT
		tag,
		timeAdded,
		description,
		priceSale
	FROM 
		`jos_cbodb_items` 
	WHERE
		isForSale =1
		AND isSold =0
	ORDER BY
		tag
"
; 

	$db->setQuery($query);
	$rows = $db->loadRowList();
	
		if ($db->getErrorNum())
                {
                        echo $db->stderr();
                        exit;
                }



	$headers = array( "Tag #", "Time Added", "Description", "Sale Price") ;
					
	header("Content-type: text/csv");
	
	header("Content-Disposition: attachment; filename=\"bicycleinventory.csv\"");
	
	echo "Bicycle Inventory Report as of " . $currentdate->toFormat() . "\n";
	
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


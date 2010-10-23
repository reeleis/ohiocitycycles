<?php
defined('_JEXEC') or die('Restricted access');
class TableItem extends JTable
{
	/** @var int */
	var $id = 0;
	/** @var datetime */
	var $timeAdded = 0;
	/** @var datetime */
	var $timeChanged= 0;
	/** @var string */
	var $description = "";
	/** @var string */
	var $notes;
	/** @var string an identifying number attached to the bike - used if the $id isn't used as the identifier. eg a barcode */
	var $tag;
	/** @var decimal(9,2) */	
	var $priceValue;
	/** @var decimal(9,2) */	
	var $priceDeposit;
	/** @var decimal(9,2) */	
	var $priceSale; 
	/** @var boolean */	
	var $isForSale;
	/** @var boolean */	
	var $isForRent;
	/** @var boolean */
	var $isSold;
	/** @var int */	
	var $status;
	/** @var int */	
	var $owner;
	/** @var int */	
	var $location;
	/** @var boolean */
	var $isReady;
	/** bike related variables follow, all null for non-bikes (except isBike = 0) */
	/** @var boolean */	
	var $isBike;
	/** @var string */
	var $bikeBrand;
	/** @var string */	
	var $bikeModel;
	/** @var string */	
	var $bikeColor;
	/** @var string */
	var $bikeSerial;
	/** @var string */	
	var $bikeStyle;
	/** @var float */
	var $bikeSize1;
	/** @var float */
	var $bikeSize2;
	/** @var float */
	var $bikeSize3;
	/** @var tinyint */
	var $bikeSizeUnit;
	/** @var int */	
	var $bikeERD;
	/** @var int */	
	var $bikeTireStyle;
	/** @var int */	
	var $bikeDrivetrain;
	/** @var int */
	var $bikeFrameStyle;
	/** @var int */	
	var $source;
	/** @var int */
	var $bikeCondition;
	/** @var int */
	var $commissionUserID;

	function __construct(&$db)
	{
		parent::__construct( '#__cbodb_items', 'id', $db );
	}

}
?>

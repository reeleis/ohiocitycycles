<?php
defined('_JEXEC') or die('Restricted access');
class TableTransaction extends JTable
{
	/** @var int */
	var $id = 0;
	/** @var datetime */
	var $dateOpen = 0;
	/** @var datetime */
	var $dateClosed= 0;
	/** @var datetime */	
	var $timeChanged= 0;
	/** @var int */
	var $totalTime = 0;
	/** @var boolean */
	var $isOpen = 0;
	/** @var int */
	var $memberID;
	/** @var int */
	var $type;
	/** @var int */	
	var $subtype;
	/** @var int */	
	var $bikeID;
	/** @var int */	
	var $taskID;
	/** @var float */
	var $creditRate;
	/** @var float */	
	var $credits; 
	/** @var decimal(9,2) */	
	var $cash;
	/** @var string */
	var $comment;
	/** @var int */	
	var $itemID;
	var $oldid;

	function __construct(&$db)
	{
		parent::__construct( '#__cbodb_transactions', 'id', $db );
	}

}
?>

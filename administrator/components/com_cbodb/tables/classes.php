<?php
defined('_JEXEC') or die('Restricted access');
class TableClasses extends JTable
{
	/** @var int */
	var $id = 0;
	/** @var timestamp */
	var $timeAdded = 0;
	/** @var datetime */
	var $starttime;
	/** @var int */
	var $length;
	/** @var int */	
	var $typeID;
	/** @var int */	
	var $instructorID;
	/** @var varchar */
	var $comment;

	function __construct(&$db)
	{
		parent::__construct( '#__cbodb_classes', 'id', $db );
	}

}
?>

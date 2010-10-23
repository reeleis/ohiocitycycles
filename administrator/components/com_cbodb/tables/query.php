<?php
defined('_JEXEC') or die('Restricted access');
class TableQuery extends JTable
{
  var $id = 0;
  var $type = 0;
  var $subtype = 0;
  var $description = "";
  var $sql = "";
  var $dateCreated = 0;
  var $timeUpdated = 0;

  function __construct(&$db)
  {
    parent::__construct( '#__cbodb_queries', 'id', $db );
  }

}
?>

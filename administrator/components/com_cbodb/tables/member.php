<?php
defined('_JEXEC') or die('Restricted access');
class TableMember extends JTable
{
  var $id = 0;
  var $oldid = 0;
  var $joomlaID = 0;
  var $nameFirst = "";
  var $nameLast = null;
  var $phoneMain = null;
  var $phoneAlt = null;
  var $phoneEmerg = "";
  var $emailAddress = "";
  var $emailStatus = null;
  var $emailNews = null;
  var $emailVolunteerOpps = null;
  var $isMember = null;
  var $membershipExpire = null;
  var $creditRate = 0;
  var $isGroup1 = null;
  var $isGroup2 = null;
  var $isGroup3 = null;
  var $isGroup4 = null;
  var $isGroup5 = null;
  var $isGroup6 = null;
  var $isGroup7 = null;
  var $isGroup8 = null;
  var $isGroup9 = null;
  var $timeCreated = null;
  var $timeChanged = null;
  var $address1 = null;
  var $address2 = null;
  var $city = null;
  var $state = null;
  var $zip = null;
  var $custom1 = null;
  var $custom2 = null;
  var $custom3 = null;
  var $custom4 = null;
  var $custom5 = null;

  function __construct(&$db)
  {
    parent::__construct( '#__cbodb_members', 'id', $db );
  }

}
?>

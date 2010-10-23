<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

function CheckAccess()
{
  //allowed IP. Change it to your static IP
  $allowedip = getConfigValue( 'allowedIP' );

  $ip = $_SERVER['REMOTE_ADDR'];
  return ($ip == $allowedip);
} 

function getConfigValue( $keyName )
{
	$db =& JFactory::getDBO();
	$query = "SELECT keyValue FROM #__cbodb_config WHERE keyName = '".$keyName."' LIMIT 1";
	$db->setQuery( $query );
	$result = $db->loadResult();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	return ($result);
}

function setConfigValue ( $keyName, $value )
{
	$db =& JFactory::getDBO();
	/** great place for a sql insertion */
	$query = "UPDATE #__cbodb_config SET keyValue = '".$value."' WHERE keyName = '".$keyName."' LIMIT 1";
	$db->setQuery( $query );
	$result = $db->loadResult();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	return (true);
}

function format_time_duration($seconds, $showDays='true')
{
  /* Format a number of seconds as [# days,] # hours, # mins */ 
  $minutes = abs(round($seconds / 60) % 60);
  $hours = abs(intval($seconds / 3600));
  if ($showDays)
  {
    $hours = $hours % 24;
    $days = abs(intval($seconds / 86400));
  }

  $timeStr = ($seconds >= 0) ? '' : '- ';

  if ($days != 0) {
    $timeStr .= $days . " days ";
  }
  if ($hours != 0 || $days != 0) {
    $timeStr .= $hours . " hrs ";
  }
  if ($minutes != 0 || ($days == 0 && $hours == 0)) {
    $timeStr .= $minutes . " mins ";
  }

  $timeStr = trim($timeStr);

  return $timeStr;
}

function show_transaction_totaltime($isOpen, $totalTime)
{
  if ($isOpen) {
    return 'currently logged-in';
  } else {
    return format_time_duration($totalTime);
  }
}

class CbodbMember {

	private $id;
	private $data; 	
 	
  	public function __construct($memberID=null)
  	{
	    $row =& JTable::getInstance('member', 'Table');
	    if ($memberID)
	    {
	        $row->id = $memberID;
	        $row->load($this->id);
	    }
	    $this->data = $row;
	}
	
    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }

    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }

    public function setAll( &$row )
    {
	    if (!($this->data->bind($row))) 
	   	{
			  echo "<script> alert('".$this->data->getError()."');
			  window.history.go(-1); </script>\n";
			  exit();
		}
		/*
		$this->data->emailStatus = ($this->data->emailStatus=="on") ? 1 : 0;
		$this->data->emailNews = ($this->data->emailNews=="on") ? 1 : 0;
		$this->data->emailVolunteerOpps = ($this->data->emailVolunteerOpps=="on") ? 1 : 0;
		*/
		$this->data->isGroup1 = ($this->data->isGroup1=="on") ? 1 : 0;
		$this->data->isGroup2 = ($this->data->isGroup2=="on") ? 1 : 0;
		$this->data->isGroup3 = ($this->data->isGroup3=="on") ? 1 : 0;
		$this->data->isGroup4 = ($this->data->isGroup4=="on") ? 1 : 0;
		$this->data->isGroup5 = ($this->data->isGroup5=="on") ? 1 : 0;
		$this->data->isGroup6 = ($this->data->isGroup6=="on") ? 1 : 0;
		$this->data->isGroup7 = ($this->data->isGroup7=="on") ? 1 : 0;
		$this->data->isGroup8 = ($this->data->isGroup8=="on") ? 1 : 0;
        
		$this->data->custom1 = ($this->data->custom1=="on") ? 1 : 0;
		$this->data->custom2 = ($this->data->custom2=="on") ? 1 : 0;
		$this->data->custom3 = ($this->data->custom3=="on") ? 1 : 0;
		$this->data->custom4 = ($this->data->custom4=="on") ? 1 : 0;
		$this->data->custom5 = ($this->data->custom5=="on") ? 1 : 0;
    }

    public function saveData()
    {
	    if (!$this->data->store())
	    {
		    echo "<script> alert('".$row->getError()."');window.history.go(-1); </script>\n";
		    exit();
	    }
    }
    
    /*******************************************************/
    /*******************************************************/
    
  public static $memberGroupArray = array(
    1 => "Class graduate or test-out",
    2 => "Skilled mechanic",
    3 => "Super volunteer",
    4 => "Staff",
    5 => "Trustee",
    6 => "New volunteer",
    7 => "Current student",
    8 => "Key volunteer");
    
    /*******************************************************/
    /*******************************************************/

    public function getMemberMailChimpInfo()
    {
      /*
       * Get dump of "raw" MailChimp subscription info for member (by email address.)
       * Returns an array of member info, OR an error string.
       */
      $email = $this->emailAddress; // (empty() doesn't seem to take class member as param)
      if (empty($email)) {
        return "Member e-mail address ('$this->emailAddress') invalid; no subscription information possible.";
      }
      
      require_once 'mailchimp-api/MCAPI.class.php';
      require_once 'mailchimp-api/config.inc.php';
      $mc_api = new MCAPI($mailchimp_api_key);
      
      $mc_list_member_info = $mc_api->listMemberInfo($mailchimp_list_id, $this->emailAddress);
      if ($mc_api->errorCode) {
      	return "MailChimp Error (getting member info): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
      }
      
      return $mc_list_member_info;
    }

    public function getMailChimpInterestGroups()
    {
      /*
       * Get list of ("Interest") Groups within the master list.
       * Returns the array of Groups, OR an error string.
       */
      require_once 'mailchimp-api/MCAPI.class.php';
      require_once 'mailchimp-api/config.inc.php';
      $mc_api = new MCAPI($mailchimp_api_key);
      
      $mc_interest_groups = $mc_api->listInterestGroups($mailchimp_list_id);

      if ($mc_api->errorCode) {
      	return "MailChimp Error (getting groups): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
      }
      
      return $mc_interest_groups['groups'];
    }

    public function getMemberMailChimpGroupSubscriptions()
    {
      /*
       * --UNUSED--
       * Get Interest Groups a member subscribes to (via email address.)
       * Returns the array of groups to which the member is subscribed, OR
       * an error string.
       */
      require_once 'mailchimp-api/MCAPI.class.php';
      require_once 'mailchimp-api/config.inc.php';
      $mc_api = new MCAPI($mailchimp_api_key);

      $mc_list_member_info = $mc_api->listMemberInfo($mailchimp_list_id, $this->emailAddress);
      if ($mc_api->errorCode) {
      	return "MailChimp Error (getting member info): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
      }
      
      $mc_groups_list_str = $mc_list_member_info['merges']['INTERESTS'];
      $mc_member_groups = explode(',', $mc_groups_list_str);
      return $mc_member_groups;
    }

    //public function getGroupSubscriptionListForMember()
    public function getMemberMailingListSubscriptionInfo()
    {
      /*
       * Get MailChimp subscription info for member by email address, or blank info for new member.
       * Returns an array including a 'subscribed' flag
       * and, (if that's true,) an array of all Interest Groups,
       * each with a flag signifying whether the member is subscribed:
       * (
       *   subscribed => bool,
       *   groups => (
       *     'group1' => bool,
       *     'group2' => bool,
       *     'groupN' => bool
       *   )
       * )
       * OR returns an error string.
       */
      require_once 'mailchimp-api/MCAPI.class.php';
      require_once 'mailchimp-api/config.inc.php';
      $mc_api = new MCAPI($mailchimp_api_key);
      
      // Get all Interest Groups
      $mc_interest_groups = $mc_api->listInterestGroups($mailchimp_list_id);
      if ($mc_api->errorCode) {
      	return "MailChimp Error (getting groups): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
      }
      
      // Init the return structure
      $mc_member_subscription_info = array('subscribed'=>false, 'groups'=>array());
      foreach ($mc_interest_groups['groups'] AS $group) {
        $mc_member_subscription_info['groups'][$group] = false;
      }
      $unsubscribed_info = $mc_member_subscription_info;
      
      if ($this->data->id == 0) {
        // New member; non-subscribed
        return print_r($this, true);
        return $unsubscribed_info;
      }
      else
      {
        // Existing member
        $email = $this->emailAddress; // (empty() doesn't seem to take class member as param)
        if (empty($email)) {
          return "Member e-mail address ('$this->emailAddress') invalid; no subscription information possible.";
        }
        
        // Get member info in MailChimp
        $mc_list_member_info = $mc_api->listMemberInfo($mailchimp_list_id, $this->emailAddress);
        
        if ($mc_api->errorCode)
        {
            switch ($mc_api->errorCode) // http://www.mailchimp.com/api/1.2/exceptions.field.php
            {
                case 215: // List_NotSubscribed
                case 232: // Email_NotExists
                case 233: // Email_NotSubscribed
                    // Member not yet subscribed.
                    return $unsubscribed_info;
                default:
                    return "MailChimp Error (getting member info): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
            }
        }
        
        $mc_member_subscription_info['subscribed'] = ($mc_list_member_info['status'] == 'subscribed');
        
        // subscribed groups
        $mc_groups_list_str = $mc_list_member_info['merges']['INTERESTS'];
        $mc_member_groups = explode(', ', $mc_groups_list_str);
        foreach ($mc_member_groups AS $group) {
            if (isset($mc_member_subscription_info['groups'][$group])) {
                $mc_member_subscription_info['groups'][$group] = true;
            }
        }
      }
      
      return $mc_member_subscription_info;
    }
    
    public function setMemberSubscription($subscribe=true, $groups=array(), $send_confirmation=false)
    {
        /*
         * Subscribe or Unsubscribe member to MailChimp list, setting Interest Group preferences
         */
        require_once 'mailchimp-api/MCAPI.class.php';
        require_once 'mailchimp-api/config.inc.php';
        $mc_api = new MCAPI($mailchimp_api_key);

        if ($subscribe)
        {
            $merge_vars = array(''); // '' necessary
            
            if (isset($this->nameFirst)) {
                $merge_vars['FNAME'] = $this->nameFirst;
            }
            
            if (isset($this->nameLast)) {
                $merge_vars['LNAME'] = $this->nameLast;
            }
            
            $groups_str = implode(', ', $groups);
            $merge_vars['INTERESTS'] = $groups_str;
            
            $retval = array();
            
            // Subscribe
            // By default this sends a confirmation email ($double_optin=true);
            // you will not see new members until the link contained in it is clicked!
            $retval['success'] = $mc_api->listSubscribe($mailchimp_list_id, $this->emailAddress, $merge_vars, 'html', $send_confirmation, true, true, false);
            // listSubscribe($id, $email_address, $merge_vars, $email_type='html', $double_optin=true, $update_existing=false, $replace_interests=true, $send_welcome=false)
            $retval['msg'] = "Subscription for $this->emailAddress successfully applied. Groups: { $groups_str }.";
        }
        else // unsubscribe
        {
            $retval['success'] = $mc_api->listUnsubscribe($mailchimp_list_id, $this->emailAddress, true);
            // listUnsubscribe($id, $email_address, $delete_member=false, $send_goodbye=true, $send_notify=true)
            $retval['msg'] = "$this->emailAddress successfuly unsubscribed (fully).";
        }

        if (!$retval['success'])
        {
            if ($mc_api->errorCode) {
                $retval['msg'] = "MailChimp Error (subscribing): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
            } else {
                $retval['msg'] = "Unknown MailChimp Error (subscribing).";
            }
        }

        return $retval;
    }
    
    public function subscribeMember($groups=array(), $send_confirmation=true)
    {
      /*
       * $groups: an array of List Interest Group strings ~ like ('News','Volunteer Opportunities')
       * 
       * return: an array including whether successful and the error string (if not)
       *   Array
       *   (
       *    [success] => bool indicating success/failure
       *    [msg] => string including success or error message
       *   )
       */
      require_once 'mailchimp-api/MCAPI.class.php';
      require_once 'mailchimp-api/config.inc.php';
      $mc_api = new MCAPI($mailchimp_api_key);
      
      $merge_vars = array(''); // '' necessary
      
      if (isset($this->data->id)) {
        $merge_vars['OCBCDB_MID'] = $this->data->id;
      }

      if (isset($this->data->nameFirst)) {
        $merge_vars['FNAME'] = $this->data->nameFirst;
      }
      
      if (isset($this->data->nameLast)) {
        $merge_vars['LNAME'] = $this->data->nameLast;
      }
      
      $groups_str = implode(', ', $groups);
      $merge_vars['INTERESTS'] = $groups_str;

      $retval = array();
      
      // By default this sends a confirmation email ($double_optin=true);
      // you will not see new members until the link contained in it is clicked!
      $retval['success'] = $mc_api->listSubscribe($mailchimp_list_id, $this->emailAddress, $merge_vars, 'html', $send_confirmation, true, true, false);
      // listSubscribe($id, $email_address, $merge_vars, $email_type='html', $double_optin=true, $update_existing=false, $replace_interests=true, $send_welcome=false)
      
      if ($retval['success']) {
        $retval['msg'] = "Subscription for $this->emailAddress successfully updated. Groups: { $groups_str }.";
      } else
      {
        if ($mc_api->errorCode) {
      	  $retval['msg'] = "MailChimp Error (subscribing): " . $mc_api->errorMessage . " (Code: " . $mc_api->errorCode . ")";
        } else {
          $retval['msg'] = "Unknown MailChimp Error (subscribing).";
        }
      }
      
      return $retval;
    }

    /*******************************************************/
    /*******************************************************/
    
    public function isLoggedIn() 
    {
		$db =& JFactory::getDBO();
		$query = "SELECT COUNT(isOpen) FROM #__cbodb_transactions WHERE memberID = ".$this->data->id." AND type <= 1000 AND isOpen = 1";
		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return ($result>0) ? TRUE : FALSE;		
    }

    public function getMemberInfo( )
    {
    	if (isset($this->data->id)) {
    		$credits = CbodbTransaction::getMemberCredits($this->data->id);
		    return $credits;
      } 
      return NULL;
    }
    
    /*
     * isInGroup()
     *
     * whether the member is in a particular group, designated by number.
     * groups are (currently) stored as isGroup1, isGroup2, etc., flags...
     * so we replace within the variable name.
     *
     * returns boolean
     */
    function isInGroup($GroupNum)
    {
      return ($this->data->{"isGroup$GroupNum"} == 1 || $this->data->{"isGroup$GroupNum"} == "on");
    }
    
    /*
     * hasRole()
     *
     * whether the member is in a particular group -- using group name instead of number (like isInGroup() )
     *
     * example: $member->hasRole("Key volunteer")
     *
     * returns boolean
     */
    function hasRole($RoleName)
    {
      // array of all keys to which Role Name applies (should only be one)
      $group_nums = array_keys(CbodbMember::$memberGroupArray, $RoleName);
      return (count($group_nums) > 0 && $this->isInGroup($group_nums[0]));
    }

    /** static functions */
    
	public static function loggedInCount( )
   {
		$db =& JFactory::getDBO();
		$query = "SELECT COUNT(DISTINCT memberID) FROM #__cbodb_transactions WHERE #__cbodb_transactions.isOpen = 1 AND #__cbodb_transactions.type <= 1000";
		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		
		return $result;
	}    	
    
    
   public static function loggedInList( $allfields=FALSE)
   {
		$db =& JFactory::getDBO();
		if ($allfields) {
		$query = "SELECT #__cbodb_members.*,#__cbodb_transactions.type,#__cbodb_transactions.dateOpen,#__cbodb_transactions.id AS transid FROM #__cbodb_transactions,#__cbodb_members WHERE #__cbodb_transactions.isOpen = 1 AND #__cbodb_transactions.type <= 1000 and #__cbodb_transactions.memberID = #__cbodb_members.id ORDER BY #__cbodb_members.nameLast";
		} else
		{
		$query = "SELECT #__cbodb_members.id,#__cbodb_members.nameFirst,#__cbodb_members.nameLast,#__cbodb_transactions.type,#__cbodb_transactions.id AS transid,#__cbodb_transactions.dateOpen FROM #__cbodb_transactions,#__cbodb_members WHERE #__cbodb_transactions.isOpen = 1 AND #__cbodb_transactions.type <= 1000 and #__cbodb_transactions.memberID = #__cbodb_members.id ORDER BY #__cbodb_members.nameLast";
		}
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		
		return $rows;
	}    	
    
    public static function memberList( $addsql=NULL ) 
    {
    	$db =& JFactory::getDBO();
    	$query = "SELECT * FROM #__cbodb_members";
    	if ($addsql) $query = "SELECT * FROM #__cbodb_members ".$addsql;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
    }
    public static function dropdownMemberList( $addsql=NULL ) 
    {
    	$db =& JFactory::getDBO();
    	$query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members ORDER BY nameLast,nameFirst";
    	if ($addsql) $query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members ".$addsql;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
    }
	
} /* END class CbodbMember */


class CbodbTransaction {

	private $id;
	public $data;

    public function __construct($transactionID=null) {
        $row =& JTable::getInstance('transaction', 'Table');
        if ($transactionID) {
		    $row->id = $transactionID;
		    $row->load($this->id);
        }
        $this->data = $row;
    }	
	
    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }
  
    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }
  
    public function setAll( &$row ) {
        if (!($this->data->bind($row))) {
            echo "<script> alert('".$this->data->getError()."');
            window.history.go(-1); </script>\n";
            exit();
        }
    }
 
    public function saveData() {
        $this->data->timeChanged = NULL;
        $this->data->store();
    }

    public static function getMemberCredits( $memberID )
    {
        $db =& JFactory::getDBO();
        $query = "SELECT SUM(credits) FROM #__cbodb_transactions WHERE memberID = ".$memberID;
        $db->setQuery( $query );
        $result = $db->loadResult();
        return $result;
    }

    public function getMemberCreditRate($memberID)
    {
        $db =& JFactory::getDBO();
        $query = "SELECT creditRate FROM #__cbodb_members WHERE id = ".$memberID;
        $db->setQuery( $query );
        $result = $db->loadResult();
        return $result;    
    }

	public static function getOpenTransactionListByType( $type )
	{
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__cbodb_transactions WHERE isOpen = 1 AND type = ".$type;
		$db->setQuery( $query );
		$result = $db->loadObjectList();
		return $result;
	}
	
    public static function getMemberTotalCredits( $memberID )
    {
        $db =& JFactory::getDBO();
        $query = "SELECT SUM(credits) FROM #__cbodb_transactions WHERE memberID = ".$memberID." AND credits > 0";
        $db->setQuery( $query );
        $result = $db->loadResult();
        return $result;
    }
	
    public static function getMemberLoginTransaction($memberID) 
    {
        $db =& JFactory::getDBO();
        $query = "SELECT id FROM #__cbodb_transactions WHERE memberID = ".$memberID." AND type <= 1000 AND isOpen = 1";
        $db->setQuery( $query );
        $result = $db->loadResult();
        if ($db->getErrorNum()) 
        {
        	echo $db->stderr();
        	return false;
        }
        return ($result);		
    }
  
    public static function getMemberTaskTransaction($memberID)
    {
    	$db =& JFactory::getDBO();
        $query = "SELECT id FROM #__cbodb_transactions WHERE memberID = ".$memberID." AND type = 3001 AND isOpen = 1";
        $db->setQuery( $query );
        $result = $db->loadResult();
        if ($db->getErrorNum()) 
        {
        	echo $db->stderr();
        	return false;
        }
        return (($result>0) ? $result : 0);		
    }
	
	public static function getMemberTask($memberID)
	{
    $db =& JFactory::getDBO();
		$query = "SELECT taskID FROM #__cbodb_transactions WHERE memberID = ".$memberID." AND type = 3001 AND isOpen = 1";
		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}
		return (($result>0) ? $result : 0);		
	}

	public static function getTransactionListByMember($memberID, $page)
	{
		$first = ($page-1)*25;
		$count = 25;
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__cbodb_transactions WHERE memberID = ".$memberID." AND isOpen = 0 ORDER BY dateClosed DESC LIMIT ".$first.", ".$count;
		$db->setQuery( $query );
		$result = $db->loadObjectList();
		return $result;
	}
	
	public function getGranderTransactionType()
	{
	  switch ($this->data->type) {
	    case 1: // Volunteering
	    case 2: // Personal
	    case 4: // Staff
	      return "Time";
	      break;
	    default:
	      return "Unknown";
	      break;
	  }
	}
	
} /* END class CbodbTransaction */


class CbodbItem {

	private $id;
	private $data; 	
 	
  	public function __construct($memberID=null) {
		$row =& JTable::getInstance('item', 'Table');
		if ($memberID) {
			$row->id = $memberID;
			$row->load($this->id);
		}
		$this->data = $row;
	}	
	
    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }

    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }

    public function setAll( &$row )
    {
	    if(!($this->data->bind($row))) 
	   	{
			echo "<script> alert('".$this->data->getError()."');
			window.history.go(-1); </script>\n";
			exit();
		}
		
		$this->data->isForSale = ($this->data->isForSale=="on") ? 1 : 0;
		$this->data->isForRent = ($this->data->isForRent=="on") ? 1 : 0;
		$this->data->isReady = ($this->data->isReady=="on") ? 1 : 0;
		$this->data->isBike = ($this->data->isBike=="on") ? 1 : 0;

	if($this->data->isBike == 1)
	{
		$this->data->description = 'Bicycle: '.$this->data->bikeBrand.', '.$this->data->bikeModel.', '.$this->data->bikeColor.', '.$this->data->bikeSerial;
	}
	
	if($this->data->id == 0)
	{
		$this->data->timeAdded = date("Y-m-d H:i:s", time());
	}

		
    }
    
    public function saveData() {

		$this->data->timeChanged = NULL;

		if (!$this->data->store())
		{
			echo $this->data->getError();
			exit();
		}
    }
    
    /*******************************************************/
    /*******************************************************/
    
    public static $itemBikeStyleArray = array("Not specified", "Road", "Hybrid", "Mountain", "City", "Cruiser", "BMX", "Kids");
    public static $itemStatusArray = array("Not specified", "Perfect", "Ready for Sale", "Ready for Rent", "Needs Repair");
    public static $itemLocationArray = array("Not specified", "Sales Floor", "LSR", "EAB Shed", "Rental Shed", "Rental cabinet", "Currently Out", "Lost");
    public static $itemBikeSizeUnitArray = array("Not specified", "cm", "in");
    public static $itemBikeTireStyleArray = array("Not specified", "Smooth", "Kinda Knobby", "Knobby");
    public static $itemBikeDrivetrainArray = array("Not specified", "F&R Derailer", "Rear Derailer", "Hub Gears", "Singlespeed", "Fixed Gear", "Unispeed");
    public static $itemSourceArray = array("Not specified", "Individual Donation", "Bike shop collection", "Police", "Purchased new");
    public static $itemBikeFrameStyleArray = array("Not specified", "Diamond", "Mixte", "Step-through", "Tandem");
    public static $commissionMechanics = array(0 => "No one", 1180 => "Al");
    
    /*******************************************************/
    /*******************************************************/
    
    /** static functions */
    
   
    public static function itemList( $addsql=NULL ) 
    {
    	$db =& JFactory::getDBO();
    	$query = "SELECT * FROM #__cbodb_items";
    	if ($addsql) $query = "SELECT * FROM #__cbodb_items ".$addsql;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
    }
    
   public static function getItemFromTag( $tag )
   {
  		$db =& JFactory::getDBO();
  		$query = "SELECT * FROM #__cbodb_items WHERE tag = '".$tag."' LIMIT 1";
		$db->setQuery( $query );
		$result = $db->loadObject();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		} else
		{
			return $result;
		}
	}

	public static function markTagAsSold( $tag )
	{
    		$db =& JFactory::getDBO();
    		$query = "UPDATE #__cbodb_items SET isSold = TRUE WHERE tag = '".$tag."'";
		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		} else
		{
			return true;
		}
	}
	
} /* END class CbodbItem */

class CbodbTask {

	private $id;
	public $data;

 	
  	public function __construct($id=null) {
		$row =& JTable::getInstance('task', 'Table');
	  	if ($id) {
			$row->id = $id;
			$row->load($this->id);
		}
		$this->data = $row;
	}	
	
    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }

    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }

    public function setAll( &$row )
    {
	    if(!($this->data->bind($row))) 
	   	{
			echo "<script> alert('".$this->data->getError()."');
			window.history.go(-1); </script>\n";
			exit();
		}

		
		$this->data->isOpen = ($this->data->isOpen=="on") ? 1 : 0;
		$this->data->isDone = ($this->data->isDone=="on") ? 1 : 0;
		$this->data->recurring = ($this->data->recurring=="on") ? 1 : 0;
		$this->data->active = ($this->data->active=="on") ? 1 : 0;
		
		$this->data->forGroup1 = ($this->data->forGroup1=="on") ? 1 : 0;
		$this->data->forGroup2 = ($this->data->forGroup2=="on") ? 1 : 0;
		$this->data->forGroup3 = ($this->data->forGroup3=="on") ? 1 : 0;
		$this->data->forGroup4 = ($this->data->forGroup4=="on") ? 1 : 0;
		$this->data->forGroup5 = ($this->data->forGroup5=="on") ? 1 : 0;
		$this->data->forGroup6 = ($this->data->forGroup6=="on") ? 1 : 0;
		$this->data->forGroup7 = ($this->data->forGroup7=="on") ? 1 : 0;
		$this->data->forGroup8 = ($this->data->forGroup8=="on") ? 1 : 0;

		/* below is a kluge - i had been getting isOpen and isDone set to true on new tasks
		   couldn't figure out why, so i'm doing this for now */
		if (!($this->id > 0))
		{
			$this->data->isOpen = 0;
			$this->data->isDone = 0;
		}

				
    }
    
    public function saveData() {
    	if ($this->data->id == 0)
    		{
    			$this->data->timeAdded = date("Y-m-d H:i:s", time());
    		} 
    	$this->data->timeChanged = NULL;
    	
	$this->data->store();
    }
    
    public static function taskList($filter = FALSE) 
    {
    	$db =& JFactory::getDBO();
	if ($filter) {
    		$query = "SELECT * FROM #__cbodb_tasks WHERE $filter";
	} else {
    		$query = "SELECT * FROM #__cbodb_tasks";
	}
	
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
    }

	public static function getTaskListForMember($memberID)
	{
		$member = new CbodbMember($memberID);
    		$db =& JFactory::getDBO();
    		$query = "SELECT * FROM #__cbodb_tasks WHERE active = 1 AND isOpen = 0 AND isDone = 0 AND ( (forGroup1 = 1 AND $member->isGroup1 = 1) OR (forGroup2 = 1 AND $member->isGroup2 = 1) OR (forGroup3 = 1 AND $member->isGroup3 = 1) OR (forGroup4 = 1 AND $member->isGroup4 = 1) OR (forGroup5 = 1 AND $member->isGroup5 = 1) OR (forGroup6 = 1 AND $member->isGroup6 = 1) OR (forGroup7 = 1 AND $member->isGroup7 = 1) OR (forGroup8 = 1 AND $member->isGroup1 = 1) )";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
	}
		

} /* END class CbodbTask */

class CbodbQuery {

        private $id;
        public $data;


        public function __construct($id=null) {
                $row =& JTable::getInstance('query', 'Table');
                if ($id) {
                        $row->id = $id;
                        $row->load($this->id);
                }
                $this->data = $row;
        }

    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }

    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }

    public function setAll( &$row )
    {
            if(!($this->data->bind($row)))
                {
                        echo "<script> alert('".$this->data->getError()."');
                        window.history.go(-1); </script>\n";
                        exit();
                }


    }

    public function saveData() {
        if ($this->data->id == 0)
                {
                        $this->data->timeAdded = date("Y-m-d H:i:s", time());
                }
        $this->data->timeChanged = NULL;

        $this->data->store();
    }

    public function recipientList() {
	if ($this->sql == "") {
		return NULL;
	}
    	$db =& JFactory::getDBO();
	$query = "SELECT id,emailAddress FROM #__cbodb_members WHERE ".$this->sql;
	$db->setQuery( $query );
	$recipientList = $db->loadObjectList();
	return $recipientList;
	
    }

    public static function queryList($type = 0, $subtype = 0) 
    {
    	$db =& JFactory::getDBO();
	if ($type && $subtype) {
    		$query = "SELECT * FROM #__cbodb_queries WHERE type = $type AND subtype = $subtype";
	} else if ($type) {
    		$query = "SELECT * FROM #__cbodb_queries WHERE type = $type";
	} else {
    		$query = "SELECT * FROM #__cbodb_queries";
	}
	
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) 
		{
			echo $db->stderr();
			return false;
		}
		return $rows;
    }

    public static function countResults($id)
	{
	$query = new CbodbQuery($id);
    	$db =& JFactory::getDBO();
	$query = "SELECT COUNT(id) FROM #__cbodb_members WHERE ".$query->sql;
	$db->setQuery( $query );
	$count = $db->loadResult();
	return $count;
	}
} /* END class CbodbQuery */

class CbodbClasses {

public static $cbodb_classtypes = array(1 => 'Shop Class A', 2=>'Shop Class B', 3=>'Shop Class C', 4=>'Shop Class D', 5=>'Bike Driver\'s Ed', 6=>'Earn A Bike Intro', 7=>'Earn A Bike A', 8=>'Earn A Bike B', 9=>'Earn A Bike C', 10=>'Earn A Bike D', 11 => 'Bike Driver\'s Ed Intro', 101=>'Special', 201 => 'Shop Class A', 202 => 'Shop Class B', 203 => 'Shop Class C', 204 => 'Shop Class D');

        private $id;
        public $data;

        public function __construct($classID=null) {
                $row =& JTable::getInstance('classes', 'Table');
                if ($classID) {
                        $row->id = $classID;
                        $row->load($this->id);
                }
                $this->data = $row;
        }

    public function __get($member) {
        if (isset($this->data->$member)) {
            return $this->data->$member;
        }
    }

    public function __set($member, $value) {
        // The ID of the dataset is read-only
        if ($member == "id") {
            return;
        }
        $this->data->$member = $value;
    }

    public function setAll( &$row )
    {
            if(!($this->data->bind($row)))
                {
                        echo "<script> alert('".$this->data->getError()."');
                        window.history.go(-1); </script>\n";
                        exit();
                }

    }

    public function saveData() {
                if (!$this->data->store())
                {
                        echo $this->data->getError();
                        exit();
                }
    }
} /* END class CbodbClasses */

/* END OF TABLE CLASS DEFINITIONS */
/* Functions follow */


function showMembers( $option, $filtered=FALSE )
{
	if ($filtered) {
		$filter = JRequest::getVar('filter');
		if (strcmp($filter,"") == 0) { $filter = "Logged In"; }
		if (strcmp($filter,"Logged In")==0)
		{
		$rows = CbodbMember::loggedInList(TRUE);
		} else if (strcmp($filter,"Recent")==0)
		{
		$rows = CbodbMember::memberList("ORDER BY timeChanged DESC LIMIT 40");
		} else 
		{
		$rows = CbodbMember::memberList("WHERE nameLast LIKE '".$filter."%' ORDER BY nameLast, nameFirst");
		}
		HTML_cbodb::showMembers( $option, $rows );
	} else
	{
		$rows = CbodbMember::memberList("ORDER BY nameLast ASC LIMIT 50");
		HTML_cbodb::showMembers( $option, $rows );
	}
}

function showBicycles( $option, $filter=FALSE )
{
	if ($filter) 
	{
		$filter = JRequest::getVar('filter');
		$rows = CbodbItem::itemList("WHERE isBike = 1 ORDER BY ".$filter);	
		HTML_cbodb::showBicycles( $option, $rows );
	} else
	{
		$rows = CbodbItem::itemList("WHERE isBike = 1");
		HTML_cbodb::showBicycles( $option, $rows );
	}
}

function showTasks( $option, $filter=FALSE )
{
		$rows = CbodbTask::taskList($filter);
		HTML_cbodb::showTasks( $option, $rows );
}

function showMainMenu( $option )
{
	echo '<h1>Ohio City Bicycle Co-op Member Database</h1>';
  showLoggedInMembers( $option );
//	$loggedincount = CbodbMember::loggedInCount();
//	HTML_cbodb::showMainMenu( $option, $loggedincount );
}

function showLoggedInMembers( $option ) 
{
	$rows = CbodbMember::loggedInList(TRUE);
	HTML_cbodb::showLoggedInMembers( $option, $rows );
}

function doSetAddress ( $option )
{
	global $mainframe;
	if(setIPAddress( $option ))
	{
		$mainframe->redirect('index.php?option=' .$option, 'Access enabled for this location, '.getConfigValue('allowedIP').'.');
	} else
	{
		$mainframe->redirect('index.php?option=' .$option, 'ERROR: Enabling access failed');
 	}
	
}

function setIPAddress ( $option )
{
  	$ipAddress = $_SERVER['REMOTE_ADDR'];
	return setConfigValue('allowedIP', $ipAddress);
}

function showTransactions( $option )
{
	$db =& JFactory::getDBO();

	global $mainframe;
	
	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
	$member_id	= $mainframe->getUserStateFromRequest($option.'.member_id', 'member_id', 0, 'int');
	$transaction_type	= $mainframe->getUserStateFromRequest($option.'.transaction_type', 'transaction_type', 0, 'int');
	//$member_id = JRequest::getVar('member_id');
	
	$dateStart	= $mainframe->getUserStateFromRequest($option.'.transactions.dateStart', 'dateStart', "", 'string');
	$dateEnd	= $mainframe->getUserStateFromRequest($option.'.transactions.dateEnd', 'dateEnd', "", 'string');
	
	//@ TODO: Ensure these are actually valid date strings
	
	if (empty($member_id)) {
	  // All transactions
    $query =
      "SELECT
	      SQL_CALC_FOUND_ROWS
        t.*,
        m.nameFirst,
        m.nameLast
      FROM
        #__cbodb_transactions t,
        #__cbodb_members m
      WHERE
        t.memberID = m.id";
  } else {
    // Transactions for member
    $query =
      "SELECT
  	    SQL_CALC_FOUND_ROWS
        t.*
      FROM
        #__cbodb_transactions t
      WHERE
        t.memberID = $member_id";
  }
  if ($dateStart != "") {
	  $dateStart = date('Y-m-d', strtotime($dateStart));
    $query .= " AND t.dateOpen >= '$dateStart 00:00:00'";
  }
  if ($dateEnd != "") {    
	  $dateEnd = date('Y-m-d', strtotime($dateEnd));
    $query .= " AND t.dateOpen <= '$dateEnd 23:59:59'";
  }
  if ($transaction_type) {
    $query .= " AND t.type = $transaction_type";
  }
  
  $query .= " ORDER BY t.dateOpen DESC, t.dateClosed DESC";

	$db->setQuery( $query, $limitstart, $limit );
  $rows = $db->loadObjectList();
  if ($db->getErrorNum()) 
  {
  	echo $db->stderr();
  	return false;
  }

  $db->setQuery('SELECT FOUND_ROWS();');
  $numRows = $db->loadResult();
	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $numRows, $limitstart, $limit );
	
	// Build dropdown for transaction types
	//$javascript = 'onchange="document.adminForm.submit();"';
	$javascript = '';
  $selected_val = $transaction_type;
  $transaction_types = array();
  //$transaction_types[] = JHTML::_('select.option', '-1', '- '.JText::_('Transaction Type').' -', 'value', 'text');
  $transaction_types[] = JHTML::_('select.option', '0', 'All Types', 'value', 'text');
	foreach (HTML_cbodb::$transactionTypeArray as $type_id => $type_name) {
	  $transaction_types[] = JHTML::_('select.option', $type_id, JText::_($type_name));
	}
	$lists['transaction_type'] = JHTML::_('select.genericlist', $transaction_types, 'transaction_type', 'class="inputbox" size="1" '.$javascript, 'value', 'text', $selected_val);
	
	HTML_cbodb::showTransactions( $option, $rows, $pageNav, $lists, $member_id, $dateStart, $dateEnd );
}

function viewMember( $option )
{
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$member = new CbodbMember( $id );
	HTML_cbodb::viewMember($member, $option);
}

function editBicycle( $option )
{
  $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
  $id = $cid[0];
  $item = new CbodbItem( $id );
  /*if (!($item->id > 0))
  {
    $db =& JFactory::getDBO();
    $query = "SELECT MAX(tag) FROM #__cbodb_items";
    $db->setQuery( $query );
    $maxTag = $db->loadResult();
    if ($db->getErrorNum()) 
    {
      echo $db->stderr();
      return false;
    }
    $item->tag = $maxTag + 1;
  }*/
  
  HTML_cbodb::editBicycle($item, $option);
  if ($item->id > 0) {
    showBicycleTransactions($item->tag, $option);
  }
}

function editBicycleByTag( $option )
{
  $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
  $tag = $cid[0];

  $item = CbodbItem::getItemFromTag($tag);

  HTML_cbodb::editBicycle($item, $option);
  showBicycleTransactions($tag, $option);
}

function showBicycleTransactions( $tag, $option )
{
  $db =& JFactory::getDBO();
	$query =
    "SELECT
      SQL_CALC_FOUND_ROWS
      t.*,
      m.nameFirst,
      m.nameLast
    FROM
      #__cbodb_transactions t,
      #__cbodb_members m
    WHERE
      t.itemID = $tag AND
      t.memberID = m.id";
	$db->setQuery( $query );
  $rows = $db->loadObjectList();
  //$result = $db->loadResult();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	if (count($rows) > 0) {
	  HTML_cbodb::showBicycleTransactions($option, $rows);
	}
}

function editMember( $option )
{
    $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
    $id = $cid[0];
    $member = new CbodbMember( $id );
    HTML_cbodb::editMember($member, $option);
}

function addMember( $option )
{
    /*
     * Separated this from editMember() because the forms have diverged enough
    */
    $member = new CbodbMember(0); // id=0 for new member
    $mc_interest_groups = $member->getMailChimpInterestGroups();
    HTML_cbodb::addMember($member, $option, $mc_interest_groups);
}

function viewMemberMailChimpInfo( $option )
{
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$member = new CbodbMember( $id );
	HTML_cbodb::viewMemberMailChimpInfo($member, $option);
}

function editMailingListSubscription( $option )
{
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$member = new CbodbMember( $id );
	$mc_member_subscription_info = $member->getMemberMailingListSubscriptionInfo();
	HTML_cbodb::editMailingListSubscription($member, $option, $mc_member_subscription_info);
}

function editTransaction( $option )
{
	global $mainframe;
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$transaction = new CbodbTransaction( $id );
	/*
	@TODO: remove when sure this didn't have a purpose
	$memberID = JRequest::getVar("memberID");
	if ($transaction->memberID > 0) {
	  $memberID = $transaction->memberID;
	}
	if ($memberID > 0) {
	*/
	if ($transaction->memberID > 0) {
		$member = new Cbodbmember( $transaction->memberID );
		if ($transaction->getGranderTransactionType() == "Time") {
	    // time-based transaction
		  HTML_cbodb::editTimeTransaction($option, $transaction, $member);
	  } else {
	    $memberCredits = $member->getMemberInfo();
		  HTML_cbodb::editTransaction($option, $transaction, $member, $memberCredits);
		}
	} else {
		$mainframe->redirect('index.php?option=' .$option.'&task=showmembers', 'Error: No member or transaction found');
	}
}

function newProvisionalTransaction( $option, $fromTransaction = FALSE )
{	
	// checkmarked transaction?
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	if ($id) {
	  if ($fromTransaction) {
	    // id refers to transaction id. get member from transaction
	    $oldTransaction = new CbodbTransaction($id);
	    $member_id = $oldTransaction->memberID;
	  } else {
	    // id refers to member id
	    $member_id = $id;
	  }
	} else {
	  // if that fails, try getting member_id from post var
	  $member_id = JRequest::getVar('list_query_member_id', 0, '', 'INT');
	}
	
	$member = new CbodbMember($member_id);
	$memberCredits = $member->getMemberInfo();
	
	$transaction = new CbodbTransaction();
	
	$transaction->dateOpen = date("Y-m-d H:i:s", time());
	$transaction->dateClosed = date("Y-m-d H:i:s", time());
	HTML_cbodb::newProvisionalTransaction($option, $transaction, $member, $memberCredits);
}

function newTimeTransaction( $option, $fromTransaction = FALSE )
{	
	// checkmarked transaction?
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	if ($id) {
	  if ($fromTransaction) {
	    // id refers to transaction id. get member from transaction
	    $oldTransaction = new CbodbTransaction($id);
	    $member_id = $oldTransaction->memberID;
	  } else {
	    // id refers to member id
	    $member_id = $id;
	  }
	} else {
	  // if that fails, try getting member_id from post var
	  $member_id = JRequest::getVar('list_query_member_id', 0, '', 'INT');
	}
	
	$member = new CbodbMember($member_id);
	
	$transaction = new CbodbTransaction();
	
	$transaction->dateOpen = date("Y-m-d H:i:s", time());
	$transaction->dateClosed = date("Y-m-d H:i:s", time());
	HTML_cbodb::newTimeTransaction($option, $transaction, $member);
}


function editTask( $option )
{
	global $mainframe;
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$task = new CbodbTask( $id );
	if ($task->itemID > 0)
	{
		$item = CbodbItem::getItemFromTag($task->itemID);
	} else
	{
		$item = NULL;
	}
	HTML_cbodb::editTask($option, $task, $item);
		
}

function adminRenewMember( $option )
{
	global $mainframe;
	$memberID = JRequest::getVar("memberID");

	$transaction = new CbodbTransaction( );
	$member = new Cbodbmember( $memberID );
	$memberCredits = $member->getMemberInfo();

	$transaction->dateOpen = date("Y-m-d H:i:s",time());
	$transaction->dateClosed = date("Y-m-d H:i:s",time());
	$transaction->credits = 80;
	HTML_cbodb::renewMember($option, $transaction, $member, $memberCredits);
}


function saveMember( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	$member = new CbodbMember($postRow['id']);
	$member->setAll($postRow);
	if ($member->isGroup1 == 0 && $member->isGroup2 == 0 && $member->isGroup3 == 0 && $member->isGroup4 == 0 && $member->isGroup5 == 0 && $member->isGroup6 == 0 && $member->isGroup7 == 0 && $member->isGroup8 == 0 ) $member->isGroup6 = 1;
	$member->saveData();		
	
	// If we're creating a new member -- not editing an existing one --
	// (we know, because the hidden 'new_member' form input will be set ~ to 1,)
	// then subscribe them to the Mailing List groups they chose, if they chose
	if ((isset($postRow['new_member'])) && ($postRow['new_member'] == 1))
	{
	    if (isset($postRow['listSubscribe']) && ($postRow['listSubscribe']=='listSubscribe')) {
	        $member->subscribeMember($postRow['interestGroups'], true);
        }
	}

	//$mainframe->redirect('index.php?option=' .$option, print_r($postRow[interestGroups], TRUE)); // debug
	$mainframe->redirect('index.php?option=' .$option, 'Member Saved');
}

function saveMemberEmailSubscriptions ( $option )
{
    /*
     * For 'save' on standalone editMailingListSubscription() form
     */
	global $mainframe;
	$postRow = JRequest::get('post');
	$member = new CbodbMember($postRow['memberId']);

	$subscribe = (isset($postRow['listSubscribe']) && $postRow['listSubscribe'] == 'listSubscribe');
	
	if (isset($postRow['interestGroups'])) {
	    $groups = $postRow['interestGroups'];
	} else {
	    $groups = array();
	}
	
    //$retval = $member->subscribeMember($groups); // old
    $retval = $member->setMemberSubscription($subscribe, $groups);
    $msg = $retval['msg'];
	//if ($retval['success']) { } else { }
	
	//$msg = print_r($postRow, TRUE); // debug
	
	$mainframe->redirect('index.php?option='.$option.'&task=edit&cid[]='.$member->id, $msg);
}

function saveTransaction( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	$transaction = new CbodbTransaction($postRow['id']);
	$transaction->setAll($postRow);
	$msg = '';

    if (!isset($transaction->creditRate) || is_empty($transaction->creditRate)) {
        $transaction->creditRate = $transaction->getMemberCreditRate($transaction->memberID);
    }

	if ($transaction->getGranderTransactionType() == "Time") {
	    // Time-based transaction: recalculate total time and credits
	    $transaction->totalTime = calculateTotalTime($transaction->dateOpen, $transaction->dateClosed);
        $transaction->credits = calculateCredits($transaction->totalTime, $transaction->creditRate);
        $msg = "Total time: ". format_time_duration($transaction->totalTime) .", Credits: $transaction->credits";
	}
	
	if ($transaction->type == 1001 || $transaction->type == 1003) {
		/* This is a purchase - make sure credits are negative */
		if ($transaction->credits > 0)
			$transaction->credits = -($transaction->credits);
		CbodbItem::markTagAsSold($transaction->itemID);
	}

	if ($transaction->type == 1003)
	{
        /* this is a membership renewal - update the account */
        $member = new CbodbMember($transaction->memberID);
        if (strtotime($member->membershipExpire) < time()) {
            $member->membershipExpire = date("Y-m-d H:i:s",time() + 365*24*3600);
	    } else {
            $member->membershipExpire = (date("Y-m-d H:i:s", strtotime($member->membershipExpire)+365*24*3600));
        }
        $member->isMember = 1;
        $member->saveData();
	}

	$transaction->saveData();
	
	$msg = "Transaction $transaction->id saved. " . $msg;
	
	// Going back to Show Transactions list
	// Saved the listing criteria as hidden form variables... use them to re-generate the previous view
	//$list_query_limit = $postRow['list_query_limit'] ? ('&limit=' . $postrow['list_query_limit']) : '';
	//$list_query_limitstart = $postRow['list_query_limitstart'] ? ('&limitstart=' . $postrow['list_query_limitstart']) : '';
	$list_query_member_id = $postRow['list_query_member_id'] ? ('&member_id=' . $postrow['list_query_member_id']) : '';
	$list_query_dateStart = $postRow['list_query_dateStart'] ? ('&dateStart=' . $postrow['list_query_dateStart']) : '';
	$list_query_dateEnd = $postRow['list_query_dateEnd'] ? ('&dateEnd=' . $postrow['list_query_dateEnd']) : '';
	
	$mainframe->redirect('index.php?option=' .
	                     $option .
	                     '&task=transactions' .
	                     //$list_query_limit .
	                     //$list_query_limitstart .
	                     $list_query_member_id .
	                     $list_query_dateStart .
	                     $list_query_dateEnd,
	                     $msg);
}

function saveTask( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	$task = new CbodbTask($postRow['id']);
	$task->setAll($postRow);

	$task->comment = JRequest::getVar( 'comment', '', 'post', 'string', JREQUEST_ALLOWRAW );
	
	$task->saveData();		

	$mainframe->redirect('index.php?task=showtasks&option=' .$option, 'Task saved!');
}


function adminLogoutMember( $option, $atTime = FALSE )
{
  global $mainframe;

	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$transid = $cid[0];
	$transaction = new CbodbTransaction( $transid );

  $openTime = strtotime($transaction->dateOpen);

	if ($atTime) {
		$transaction->dateClosed = date("Y-m-d ", $openTime);
		$transaction->dateClosed .= ((JRequest::getVar("hour")+5)%24) . ':' . JRequest::getVar("minute");
	} else {
    $transaction->dateClosed = date("Y-m-d H:i:s", time());
	}
  $transaction->isOpen = 0;
  
  $transaction->totalTime = calculateTotalTime($transaction->dateOpen, $transaction->dateClosed);
  $transaction->credits = calculateCredits($transaction->totalTime, $transaction->creditRate);
  
  $transaction->saveData();
  
  $memberCredits = CbodbTransaction::getMemberCredits($transaction->memberID);
  $mainframe->redirect('index.php?option=' .$option.'&task=showloggedin', 'Member logged out - earned '.sprintf("%.2F",$transaction->credits).' credits, current total is '.sprintf("%.2F",$memberCredits).' and time out is '.$transaction->dateClosed);
}


function calculateTotalTime($dateOpen, $dateClosed)
{
  $openTime = strtotime($dateOpen);
	$closedTime = strtotime($dateClosed);
  /*
  if ($dateClosed='') {
    // clocking-out now
    $closedTime = time();
  } else {
	  $closedTime = strtotime($dateClosed);    
  }
  */
  $totalTime = $closedTime - $openTime;
	if ($totalTime < 0) {
	  // apparently we have day-rollover issues...?
	  $totalTime += (24 * 3600);
  }
  return $totalTime;
}

function calculateCredits($totalTime, $creditRate)
{
  // check for day roll-over again, in case this gets called independently of calculateTotalTime()
	if ($totalTime < 0) {
	  $totalTime += (24 * 3600);
  }
  $credits = ($totalTime / 3600.0) * $creditRate;
  return $credits;
}


function saveBicycle( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	$bicycle = new CbodbItem($postRow['id']);

	$bicycle->setAll($postRow);

	$db =& JFactory::getDBO();
	$query = "SELECT id FROM #__cbodb_items WHERE tag = '".$bicycle->tag."' LIMIT 1";
	$db->setQuery( $query );
	$id = $db->loadResult();

/*	if ($id > 0)
	{
	$mainframe->redirect('index.php?option=' .$option.'&task=editbicycle&cid='.$id, 'Sorry, that tag number is in use. Here is the bike.');
	}*/
	
	$bicycle->saveData();		
	
	$another = JRequest::getVar('another');


	if (strcmp($another,"on") == 0)
	{
	$mainframe->redirect('index.php?option=' .$option.'&task=add&cbodb_mode=bicycle', 'Bicycle Saved');
	} else
	{
	$mainframe->redirect('index.php?option=' .$option.'&task=showbicycles', 'Bicycle Saved');
	}
}

function toggleTaskFlag( $option )
{
	global $mainframe;

	$taskID = JRequest::getVar('taskID');
	$flag = JRequest::getVar('flag');

	echo "Flag = $flag<br>";
	echo "taskID = $taskID<br>";

	if ($taskID > 0)
	{
		$task = new CbodbTask($taskID);
		if (!($task->timeAdded > 0)) { $mainframe->redirect('index.php?option=' .$option.'&task=showall&cbodb_mode=task'); }
		print_r($task);
		echo "<br><br>";
		if ($flag == "isDone") $task->isDone = !$task->isDone;
		if ($flag == "active") $task->active = !$task->active;
		print_r($task);
		echo "<br><br>";
	}
	
	$task->saveData();
	if ($flag == "isDone")
	{
	$mainframe->redirect('index.php?option=' .$option.'&task=showdonetasks&cbodb_mode=task');
	}
	$mainframe->redirect('index.php?option=' .$option.'&task=showall&cbodb_mode=task');
}

function showEmailQueries( $option, $filter=FALSE )
{
		$rows = CbodbQuery::queryList(1);
		foreach ($rows as $row) 
		{
			$resultCounts[$row->id] = CbodbQuery::countResults($row->id);	
		}
		HTML_cbodb::showEmailQueries( $option, $rows, $resultCounts );
}

function emailMenu( $option )
{
HTML_cbodb::emailMenu($option);
}

function composeEmail( $option )
{
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$id = $cid[0];
	$query = new CbodbQuery($id);
	$results = CbodbQuery::countResults($id);
	HTML_cbodb::composeEmail($option, $query, $results);	
}

function sendEmail( $option)
{
$id = JRequest::getVar('id');
$from = JRequest::getVar('from');
$subject = JRequest::getVar('subject');
/*$body = JRequest::getVar('body');*/
$body = JRequest::getVar( 'body', '', 'post', 'string', JREQUEST_ALLOWRAW );

/*
$mailSender =& JFactory::getMailer();
$mailSender ->addRecipient( $to );
$mailSender ->setSender( array(  $from ,"Ohio City Bicycle Co-op") );
$mailSender ->setSubject( $subject );
$mailSender ->setBody(  $body );
$mailSender ->setMode( 1 );

if (!$mailSender ->Send())
{
HTML_cbodb::emailMenu( $option );
}
*/
$query = new CbodbQuery($id);

$recipientList = $query->recipientList();
foreach ($recipientList as $recipientRow) 
{
	echo "Sending email to $recipientRow->emailAddress ... <br>";
JUtility::sendMail($from , "Ohio City Bicycle Co-op", $recipientRow->emailAddress, $subject, $body, 1);
}
}

function showStaffTotals( $option )
{
  // Show hours logged for all staff transactions,
  // and commissions for Al
  
  $db =& JFactory::getDBO();

	global $mainframe;
  
  $curYear = date('Y');
  $curMonth = date('m');
  $lastDayInMonth = date('t');
  $dateStartDefault = "$curYear-$curMonth-01";
  $dateEndDefault = "$curYear-$curMonth-$lastDayInMonth";

  // not working w/ this php version?
  //$dateStartDefault = date("Y-m-d", strtotime("first day of this month"));
  //$dateEndDefault = date("Y-m-d", strtotime("first day of next month"));
  
	$dateStart	= $mainframe->getUserStateFromRequest($option.'.staff.dateStart', 'dateStart', $dateStartDefault, 'string');
	$dateEnd	= $mainframe->getUserStateFromRequest($option.'.staff.dateEnd', 'dateEnd', $dateEndDefault, 'string');
	if ($dateStart == "") $dateStart = $dateStartDefault;
	if ($dateEnd == "") $dateEnd = $dateEndDefault;
	$dateStart = date('Y-m-d', strtotime($dateStart));
	$dateEnd = date('Y-m-d', strtotime($dateEnd));
  
  // Look up all staff hours logged this period, by user
  $queryHours =
    "SELECT
      t.memberID,
      m.nameFirst,
      m.nameLast,
      SUM(t.totalTime) AS totalTimeSeconds,
      COUNT(*) AS clockins,
      MAX( t.totalTime ) AS longestClockIn,
      AVG( t.totalTime ) AS avgClockIn
    FROM
      #__cbodb_transactions t,
      #__cbodb_members m
    WHERE
      t.type = 4 AND
      t.dateOpen >= '$dateStart 00:00:00' AND
      t.dateOpen <= '$dateEnd 23:59:59' AND
      t.memberID = m.id
    GROUP BY
      t.memberID
    ORDER BY
      m.nameLast, m.nameFirst ASC";

	$db->setQuery($queryHours);
  $rowsHours = $db->loadObjectList();
  if ($db->getErrorNum())
  {
  	echo $db->stderr();
  	return false;
  }

  // Look up all commissions earned this period, by user
  // Right now just getting Al's, since that's all we seem to care about
  $queryCommissions =
    "SELECT
      i.commissionUserID,
      m.nameFirst,
      m.nameLast,
	    SUM(t.cash) AS commissionCash,
	    SUM(t.credits) AS commissionCredits
    FROM
      #__cbodb_transactions t,
      #__cbodb_items i,
      #__cbodb_members m
    WHERE
      i.commissionUserID = 1180 AND
      t.itemID = i.tag AND
      t.dateOpen >= '$dateStart 00:00:00' AND
      t.dateOpen <= '$dateEnd 23:59:59' AND
      m.id = i.commissionUserID
    GROUP BY
      i.commissionUserID";

	$db->setQuery($queryCommissions);
  $rowsCommissions = $db->loadObjectList();
  if ($db->getErrorNum())
  {
  	echo $db->stderr();
  	return false;
  }
  
  // Merge commissions rows into hours rows
  foreach ($rowsCommissions AS $cRow) {
    $found = false;
    $hRowIndex = 0;
    foreach ($rowsHours AS $hRow) {
      if ($hRow->memberID == $cRow->commissionUserID) {
        $found = true;
        break;
      } else {
        $hRowIndex++;
      }
    }
    if (!$found) {
      // Member with commissions doesn't have staff hours: add them
      $hRowIndex = count($rowsHours);
      $rowsHours[$hRowIndex] = new stdClass;
      $rowsHours[$hRowIndex]->memberID = $cRow->commissionUserID;
      $rowsHours[$hRowIndex]->nameFirst = $cRow->nameFirst;
      $rowsHours[$hRowIndex]->nameLast = $cRow->nameLast;
    }
    $rowsHours[$hRowIndex]->commissionCash = $cRow->commissionCash;
    $rowsHours[$hRowIndex]->commissionCredits = $cRow->commissionCredits;
  }
	
	HTML_cbodb::showStaffTotals( $option, $rowsHours, $dateStart, $dateEnd );
}

function recordClass($instructorID,$classID,$isClassNow,$classdate,$classduration,$students)
{
  $class = new CbodbClasses();
  
  $class->instructorID = $instructorID;
  $class->typeID = $classID;
  $class->duration = $classduration * 3600;
  $class->comment = "";
  $class->timeAdded = NULL;
  
  if ($isClassNow)
  {
  	$starttime = date("Y-m-d H:i:s", time());
  }
  else
  {
  	$starttime = $classdate[year].'-'.$classdate[month].'-'.$classdate[day].' 12:00:00';
  }
  
  $class->starttime = $starttime;
  
  $class->saveData();
  
  foreach($students as $memberID => $studentdata)
  {
  	if (!strcmp($studentdata[inclass],"on")) {
  		$membertransaction = new CbodbTransaction();
  	$membertransaction->dateOpen = date("Y-m-d H:i:s",time());
  	$membertransaction->dateClosed = date("Y-m-d H:i:s",time());
  	$membertransaction->type = 4001;
  	$membertransaction->credits = -(abs($studentdata[paidcredits]));
  	$membertransaction->cash = $studentdata[paidcash];
  	$membertransaction->totalTime = $classduration*3600;
  	$membertransaction->memberID = $memberID;
  	/* Set the Transaction subtype to the class id so we can find the class */
  	$membertransaction->subtype = $class->id;
  	$membertransaction->comment = "Class: ".CbodbClasses::$cbodb_classtypes[$class->typeID];
  	$membertransaction->saveData();
  
  	$member = new CbodbMember($memberID);
  	if ($class->typeID == 1) 
  	{
  		if ($member->custom1 == 0 && $member->custom2 == 1 && $member->custom3 == 1 && $member->custom4 == 1)
  		{
  		/* in this case they are taking their final class, and should be a member now */
  			$starttimestamp = strtotime($starttime);
                  	$member->membershipExpire = date("Y-m-d H:i:s",$starttimestamp + 365*24*3600);
  			$member->isMember = 1;
  			$membertransaction->comment .= " - Membership renewed until $member->membershipExpire";
  			$membertransaction->saveData();
  		}
  		$member->custom1 = 1;
  	}
  	if ($class->typeID == 2)
  	{
  		if ($member->custom1 == 1 && $member->custom2 == 0 && $member->custom3 == 1 && $member->custom4 == 1)
  		{
  		/* in this case they are taking their final class, and should be a member now */
  			$starttimestamp = strtotime($starttime);
                  	$member->membershipExpire = date("Y-m-d H:i:s",$starttimestamp + 365*24*3600);
  			$member->isMember = 1;
  			$membertransaction->comment .= " - Membership renewed until $member->membershipExpire";
  			$membertransaction->saveData();
  		}
  		$member->custom2 = 1;
  	}
  	if ($class->typeID == 3)
  	{
  		if ($member->custom1 == 1 && $member->custom2 == 1 && $member->custom3 == 0 && $member->custom4 == 1)
  		{
  		/* in this case they are taking their final class, and should be a member now */
  			$starttimestamp = strtotime($starttime);
                  	$member->membershipExpire = date("Y-m-d H:i:s",$starttimestamp + 365*24*3600);
  			$member->isMember = 1;
  			$membertransaction->comment .= " - Membership renewed until $member->membershipExpire";
  			$membertransaction->saveData();
  		}
  		$member->custom3 = 1;
  	}
  	if ($class->typeID == 4)
  	{
  		if ($member->custom1 == 1 && $member->custom2 == 1 && $member->custom3 == 1 && $member->custom4 == 0)
  		{
  		/* in this case they are taking their final class, and should be a member now */
  			$starttimestamp = strtotime($starttime);
                  	$member->membershipExpire = date("Y-m-d H:i:s",$starttimestamp + 365*24*3600);
  			$member->isMember = 1;
  			$membertransaction->comment .= " - Membership renewed until $member->membershipExpire";
  			$membertransaction->saveData();
  		}
  		$member->custom4 = 1;
  	}
  	if ($class->typeID == 5) $member->custom5 = 1;
  	$member->saveData();
  	}
  }
}
<?php
defined( '_JEXEC' ) or defined ( '_VALID_MOS' ) or die( 'Restricted access' );

JImport('joomla.application.helper');
require_once( JApplicationHelper::getPath( 'html' ) );
require_once( JApplicationHelper::getPath( 'admin_functions' ) );
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.$option.DS.'tables');
switch($task)
{
	case 'listnames':
		listMemberNames( $option );
		break;
	case 'memberoptions':
		listMemberOptions( $option );
		break;
	case 'login':
		loginMember( $option );
		break;
	case 'logout':
		logoutMember( $option );
		break;
	case 'newmember':
		newMember( $option );
		break;
	case 'newmemberpurchase':
		newMemberPurchase( $option );
		break;
	case 'oldmemberpurchase':
		oldMemberPurchase( $option );
		break;
	case 'savenewmember':
		saveNewMember( $option );
		break;
	case 'savenewmemberpurchase':
		saveNewMemberpurchase( $option );
		break;
	case 'saveoldmemberpurchase':
		saveOldMemberpurchase( $option );
		break;
	case 'memberinfo':
		showMemberInfo( $option );
		break;
	case 'listnamesbylastname':
		listNamesByLastName( $option );
		break;
	case 'linkmember':
		linkMember( $option );
		break;
	case 'renewmember':
		renewMember( $option );
		break;
	case 'vert':
		//converttrans( $option );
		break;
	case 'shop':
		if (strcmp(JRequest::getVar("key"),'3b767559374f5132236f6e68256b2529') != 0 )
		{
		$mainframe->redirect('index.php');
		}
		else showOptions( $option );
		break;
	case 'listtasks':
		listTasks( $option );
		break;
	case 'viewtask':
		viewTask( $option );
		break;
	case 'checkouttask':
		checkOutTask( $option );
		break;
	case 'checkintask':
		checkInTask( $option );
		break;
	case 'savetask':
		saveCheckedInTask( $option );
		break;
	case 'listmembertransactions':
		listMemberTransactions( $option );
		break;
	case 'addbicycle':
		addBicycle( $option );
		break;
	case 'savenewbicycle':
		saveNewBicycle( $option );
		break;
	case 'startclass':
		startClass( $option );
		break;
	case 'saveclass':
		saveClass( $option );
		break;
	default:
		showMemberInfo( $option );
		break;
}

function linkMember( $option )
{
	$user =& JFactory::getUser();
	if (!($user->get("id") == 0))
	{
		$db =&JFactory::getDBO();
		$query = "SELECT id from #__cbodb_members WHERE emailAddress = '".$user->get("email")."'";
		//echo $query;
		$db->setQuery( $query );
		$rows =	 $db->loadObjectList();	
		//echo "<pre>";
		//print_r($user);
		//echo "</pre><br>user email is ".$user->get("email")."<br>";
		//echo "count is: ".count($rows).'<br>';
		if (count($rows) == 0)
		{
			HTML_CBODB::showMessage($option,"Sorry, there's no user with your exact email address. Call or email us and we will make a link to your user information.");
		} else if (count($rows) > 1)
		{
			HTML_CBODB::showMessage($option, "Sorry, we found more than one record with the same email address. We're not quite sure how that happened, but call or email us and we will make sure you get connected with the correct account.");
		} else
		{
			$member = new CbodbMember($rows[0]->id);
			$member->joomlaID = $user->get("id");
			$member->saveData();
			HTML_CBODB::showMessage($option, "Your accounts have been linked - see the menu on the right to check your details");
		}
	} else
	{
	 HTML_CBODB::showMessage($option, "You must be logged in to link your account - please log in or create an account if you don't have one.");
	}	
}

function showMemberInfo( $option )
{
	$user =& JFactory::getUser();
	if (!($user->get("id") == 0))
	{
		$db =&JFactory::getDBO();
		$query = "SELECT id from #__cbodb_members WHERE joomlaID = '".$user->get("id")."'";
		//echo $query;
		$db->setQuery( $query );
		$result =	 $db->loadResult();	
		if ($result > 0)
		{
			$member = new CbodbMember($result);
			$credits = CbodbTransaction::getMemberCredits($member->id);
			HTML_CBODB::showMemberInfo($option,$member,$credits);
		} else
		{
			HTML_CBODB::showMessage($option,"Sorry, your account doesn't seem to be linked. You can link it from the menu on the right, or call or email us.");
		}
	}else
	{
	 HTML_CBODB::showMessage($option, "You must be logged in to check your info - please log in or create an account if you don't have one.");
	}
}
	
function converttrans( $option )
{
$db =&JFactory::getDBO();
$query = "SELECT id from #__cbodb_members WHERE membershipExpire > '2008-03-13'";
$db->setQuery( $query );
$rows = $db->loadObjectList();
echo "count is: ".count($rows).'<br>';

foreach ($rows as $row)
{
	echo "entering row...<br>";
 /**       $transaction = new CbodbTransaction();
        $query = "SELECT id from jos_cbodb_members WHERE oldid = ".$row->member_num;
        $db->setQuery( $query );
        $memberID = $db->loadResult();

	$transaction->id = NULL;
	$transaction->memberID = $memberID;
	$transaction->totalTime = $row->totalTime;
	$transaction->oldid = $row->trans_num;
	$transaction->credits = -((float)$row->totalTime*5/3600);
	$transaction->isOpen = 0;
	$transaction->type = 1002;
	$transaction->cash = $row->cash;
	$transaction->comment = $row->comment;
	$transaction->dateOpen = date("Y-m-d H:i:s", $row->timeOpen);
	$transaction->dateClosed = date("Y-m-d H:i:s", $row->timeClosed);
        echo "transid: ".$row->trans_num.", old id: ".$row->member_num.", memberID: ".$memberID.'<br>';
	//print_r($row);
	//print_r($transaction);
	$transaction->saveData();*/
	//$query = "SELECT id from #__cbodb_members WHERE oldid = $row->id";
	//$db->setQuery( $query );
	//$id = $db->loadResult();
	$member = new CbodbMember($row->id);
	echo $id."--".$query."--".$member->nameFirst."<br>";
	//$member->membershipExpire = date("Y-m-d H:i:s",$row->expireDate);
	$member->isMember = 1;
	$member->saveData();
	
}
exit();
}

function showOptions( $option )
{
$loggedin =	CbodbMember::loggedInList(TRUE);
$taskTransactions = CbodbTransaction::getOpenTransactionListByType(3001);
$dropdownList = CbodbMember::dropdownMemberList();
HTML_cbodb::header();
HTML_cbodb::showOptions( $option, $loggedin, $taskTransactions, $dropdownList );
}

function listNamesByFirstName( $option )
{
	$db =& JFactory::getDBO();
	$query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members WHERE nameFirst LIKE '". JRequest::getVar("namefirst")."' ORDER BY nameFirst,nameLast";
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	HTML_cbodb::header();
	HTML_cbodb::listMemberNames( $option, $rows );
}

function listNamesByLastName( $option )
{
	$db =& JFactory::getDBO();
	$query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members WHERE nameLast LIKE \"". JRequest::getVar("namelast")."\" ORDER BY nameLast,nameFirst";
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	HTML_cbodb::header();
	//Used for testing purposes to correct error on names like O'Connor:
	//HTML_cbodb::showMessage($option, $query);
	HTML_cbodb::listMemberNames( $option, $rows );
}

function listMemberNames( $option )
{
	$db =& JFactory::getDBO();
	$query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members WHERE nameFirst LIKE '". JRequest::getVar("firstletter")."%' ORDER BY nameFirst,nameLast";
	//$query = "SELECT id,nameFirst,nameLast FROM #__cbodb_members";
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	if ($db->getErrorNum()) 
	{
		echo $db->stderr();
		return false;
	}
	HTML_cbodb::header();
	HTML_cbodb::listMemberNames( $option, $rows );
}

function listMemberOptions( $option )
{
	$id = JRequest::getVar("memberID");
	$member = new CbodbMember($id);
	$memberCredits = CbodbTransaction::getMemberCredits($id);
	$isLoggedIn = $member->isLoggedIn();
	$taskTransactionID = CbodbTransaction::getMemberTaskTransaction($id);
	HTML_cbodb::header();
	HTML_cbodb::listMemberOptions( $option, $id, $member, $memberCredits, $isLoggedIn, $taskTransactionID );
}


function renewMember( $option )
{
	global $mainframe;
	
	$memberID = JRequest::getVar("memberID");
	
	$member = new CbodbMember($memberID);
	
	$transaction = new CbodbTransaction();
	$postrow = JRequest::get('post');
	$transaction->setAll( $postrow );
	
	$transaction->type = 1003; // type for membership renewals
	$transaction->dateOpen = date("Y-m-d H:i:s", time());
	$transaction->dateClosed = date("Y-m-d H:i:s", time());
	
	$transaction->saveData();
	
	$memberCredits = CbodbTransaction::getMemberCredits($transaction->memberID);

	if (strtotime($member->membershipExpire) < time()) 
	{ 
		$member->membershipExpire = date("Y-m-d H:i:s",time() + 365*24*3600); 
	} else
	{
	$member->membershipExpire = (date("Y-m-d H:i:s", strtotime($member->membershipExpire)+365*24*3600));
	}
	$member->isMember = 1;
	$member->saveData();
	
	HTML_CBODB::showMessage($option,"Your membership has been renewed - thank you! You currently have ".sprintf("%.2F",$memberCredits)." credits remaining.");
	
}

function loginMember( $option )
{
	global $mainframe;
	$memberID = JRequest::getVar("memberID");
	$member = new CbodbMember($memberID);
	
	if ( !$member->isLoggedIn() )
	{	
		$transaction = new CbodbTransaction();
		$postrow = JRequest::get('post');
		$transaction->setAll( $postrow );
		$loginType = JRequest::getVar("logintype");
		$transaction->dateOpen = date("Y-m-d H:i:s", time());
	
		foreach(HTML_cbodb::$cbodb_user_logintypes as $typeid => $typestring) {
			if (strcmp($loginType,$typestring) == 0) $transaction->type = $typeid;
		}
		
		if ($transaction->type == 1 || $transaction->type == 4) {
		  // Volunteering or Staff
		  $transaction->creditRate = $member->creditRate;
		} elseif ($transaction->type == 2) {
		  // Personal Time: deduct
		  $transaction->creditRate = -1 * $member->creditRate;		  
		}
	
		$transaction->saveData();
		
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'You are logged in, thank you!');
	}
	else {
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'You were already logged in!');
	}
		
	
}

function newMember( $option ) 
{
    $member = new CbodbMember(0); // id=0 for new member
    $mc_interest_groups = $member->getMailChimpInterestGroups();
	HTML_cbodb::newMember( $option, $mc_interest_groups );
}

function newMemberPurchase( $option ) 
{
	HTML_cbodb::newMemberPurchase( $option );	
}

function oldMemberPurchase( $option ) 
{
	$dropdownList = CbodbMember::dropdownMemberList();
	HTML_cbodb::oldMemberPurchase( $option,$dropdownList );	
}

function saveNewMember( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	if ((strcmp($postRow['nameFirst'],"") != 0) && (strcmp($postRow['phoneEmerg'],"") != 0))
	{
		$member = new CbodbMember( );
		$member->setAll($postRow);
		$member->creditRate = NULL; // Make the rate set to default
		$member->timeCreated = date("Y-m-d H:i:s", time());
		//$member->membershipExpire = date("Y-m-d H:i:s", time());
		//$member->timeCreated = time();
		if ($member->isGroup1 == 0 && $member->isGroup2 == 0 && $member->isGroup3 == 0 && $member->isGroup4 == 0 && $member->isGroup5 == 0 && $member->isGroup6 == 0 && $member->isGroup7 == 0 && $member->isGroup8 == 0 ) $member->isGroup6 = 1;
		$member->saveData();

		$msg = '<p>You have been added as a member';
		
		if ($postRow['listSubscribe'] == 'listSubscribe') {
	        $retval = $member->subscribeMember($postRow['interestGroups'], true);
	        if ($retval['success']) {
	            $msg .= ' and subscribed to the mailing list.</p>';
	        } else {
	            $msg .= ' but we had issues subscribing you to the mailing list:</p>';
	            $msg .= '<p style="color:#CC0000;">' . $retval['msg'] . '</p>';
	        }
        }
		$msg .= '<p>... Welcome! You may now log in.</p>';
		
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', $msg);
	}
	else HTML_cbodb::newMember( $option, $mc_interest_groups, $postRow );
	
}

function saveNewMemberPurchase( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	if ((strcmp($postRow[nameFirst],"") != 0))
	{
		$itemID = $postRow[itemID];
		$cash = $postRow[cash];

		$member = new CbodbMember( );
		$member->setAll($postRow);
		$member->creditRate = NULL; // Make the rate set to default
		if ($member->emailAddress != NULL) $member->emailNews = 1;
		$member->timeCreated = time();
		$member->saveData();		
		
		$transaction = new CbodbTransaction();
		$transaction->memberID = $member->id;
		$transaction->itemID = $itemID;
		$transaction->cash = $cash;
		$transaction->type = 1001;
		$transaction->dateOpen = date("Y-m-d H:i:s", time());
		$transaction->dateClosed = date("Y-m-d H:i:s", time());
		$transaction->saveData();
		
		CbodbItem::markTagAsSold($itemID);
	
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Your transaction has been recorded, thank you.');
	}
	else {
		HTML_cbodb::newMemberPurchase( $option, $postRow );
	}
	
}

function saveOldMemberPurchase( $option )
{
	global $mainframe;
	$postRow = JRequest::get('post');
	if ($postRow[memberID] != 0)
	{
		$itemID = $postRow[itemID];
		$cash = $postRow[cash];
		$memberID = $postRow[memberID];

		$transaction = new CbodbTransaction();
		$transaction->memberID = $memberID;
		$transaction->itemID = $itemID;
		$transaction->cash = $cash;
		$transaction->type = 1001;
		$transaction->dateOpen = date("Y-m-d H:i:s", time());
		$transaction->dateClosed = date("Y-m-d H:i:s", time());
		$transaction->saveData();
		
		CbodbItem::markTagAsSold($itemID);
	
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Your transaction has been recorded, thank you.');
	}
	else {
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Please choose a member.');
	}
	
}


function logoutMember( $option )
{
	global $mainframe;
	
	$memberID = JRequest::getVar("memberID");
	$member = new CbodbMember($memberID);
	
	if ( $member->isLoggedIn() )
	{
		$transaction = new CbodbTransaction( CbodbTransaction::getMemberLoginTransaction($memberID) );
		$transaction->dateClosed = date("Y-m-d H:i:s", time());;
		$transaction->isOpen = 0;
    $transaction->totalTime = calculateTotalTime($transaction->dateOpen, $transaction->dateClosed);
    $transaction->credits = calculateCredits($transaction->totalTime, $transaction->creditRate);
		$transaction->saveData();
		
		$memberCredits = CbodbTransaction::getMemberCredits($transaction->memberID);
		checkInTaskOnLogout( $memberID );
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'You are logged out - '. (($transaction->type == 1) ? ('you earned '.sprintf("%.2F",$transaction->credits).' credits and your total is '.sprintf("%.2F",$memberCredits).' - ') : ('thank you!')));
	}
	else {
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'You weren\'t logged in!');
	}
}

function listTasks( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");

	$taskList = CbodbTask::getTaskListForMember($memberID);

	HTML_Cbodb::listTasks( $option, $memberID, $taskList );
}

function viewTask( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");
	$taskID = JRequest::getVar("taskID");

	$task = new CbodbTask($taskID);

	if ($task->itemID > 0)
	{
		$item = CbodbItem::getItemFromTag($task->itemID);
	} else $item = NULL;

	HTML_Cbodb::viewTask( $option, $memberID, $task, $item );
}

function checkOutTask( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");
	$taskID = JRequest::getVar("taskID");
	$itemID = JRequest::getVar("itemID");

	$transaction = new CbodbTransaction();
	$transaction->memberID = $memberID;
	$transaction->type = 3001;
	$transaction->dateOpen = date("Y-m-d H:i:s", time());
	$transaction->isOpen = 1;
	$transaction->taskID = $taskID;
	$transaction->itemID = $task->itemID;

	$transaction->saveData();
	if ($task > 0 ) {
		$task = new CbodbTask($taskID);

		$task->isOpen = 1;

		$task->saveData();
	}

	$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Task checked out, thank you!');
}

function saveCheckedInTask( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");
	$taskID = JRequest::getVar("taskID");
	$transactionID = JRequest::getVar("transactionID");

	$transaction = new CbodbTransaction($transactionID);
	$transaction->dateClosed = date("Y-m-d H:i:s", time());
	$transaction->isOpen = 0;
	$transaction->comment = JRequest::getVAR("comment");

	$transaction->saveData();

	if ($taskID > 0) {
		$task = new CbodbTask($taskID);
		$isDone = JRequest::getVar("isDone");
		$task->isDone = ($isDone == "on") ? 1 : 0;
		$task->isOpen = 0;

		$task->saveData();
	}

	$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Task checked in, thank you!');
}

function checkInTaskOnLogout( $memberID )
{

	$transactionID = CbodbTransaction::getMemberTaskTransaction( $memberID );

	$transaction = new CbodbTransaction($transactionID);
	$transaction->dateClosed = date("Y-m-d H:i:s", time());
	$transaction->isOpen = 0;
	$transaction->comment = "SYSTEM MESSAGE: Task left open on logout";

	$transaction->saveData();

	if ($taskID > 0) {
		$taskID = $transaction->taskID;
		$task = new CbodbTask($taskID);
		$task->isDone = 0;
		$task->isOpen = 0;

		$task->saveData();
	}
}

function checkInTask( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");
	$transactionID = JRequest::getVar("transactionID");

	$transaction = new CbodbTransaction($transactionID);

	$task = new CbodbTask($transaction->taskID);

	if ($task->itemID > 0)
	{
		$item = CbodbItem::getItemFromTag($task->itemID);
	} else $item = NULL;

	HTML_Cbodb::checkInTask( $option, $memberID, $transaction, $task, $item );
}

function listMemberTransactions( $option )
{
	global $mainframe;

	$memberID = JRequest::getVar("memberID");
	$page = JRequest::getVar("page");
	if ($page < 1) $page = 1;

	$transactionList = CbodbTransaction::getTransactionListByMember($memberID,$page);

	HTML_Cbodb::listMemberTransactions($transactionList,$memberID,$page);
}

function addBicycle( $option )
{

$memberID = JRequest::getVar("memberID");

HTML_Cbodb::addBicycle($option, $memberID);
}

function saveNewBicycle( $option )
{
	global $mainframe;

	$item = new CbodbItem();
	$postrow = JRequest::get('post');
	$memberID = JRequest::getVar('memberID');

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

	$item->isBike = 1;
	$item->setAll($postrow);

	//$item->commissionUserID = JRequest::getVar('memberID');

	$item->saveData();
	
	// Added 2012-07-26 Lee Reis Post-Givecamp 2012
	$membertransaction = new CbodbTransaction();
	date_default_timezone_set(getConfigValue("timeZone") );
	$membertransaction->dateOpen = date("Y-m-d H:i:s",time());
    $membertransaction->dateClosed = date("Y-m-d H:i:s",time());
    $membertransaction->type = 7;
    $membertransaction->memberID = $memberID;
    $membertransaction->itemID = $maxTag + 1;
    $membertransaction->cash = $item->priceSale;
	$membertransaction->saveData();
	// End of Added 2012-07-26

  $mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', "Bicycle is saved with tag number $item->tag. Please write the number on the bike's tag!");
}

function startClass( $option )
{
$memberID = JRequest::getVar("memberID");
$loggedin = CbodbMember::loggedInList(TRUE);
HTML_cbodb::startClass( $option, $loggedin, $memberID, $error );
}

function saveClass( $option )
{
	global $mainframe;

	$postrow = JRequest::get('post');
	$classID = $postrow[classID];


	if ( $classID == 0 ) 
	{
		$loggedin = CbodbMember::loggedInList(TRUE);
		HTML_cbodb::startClass( $option, $loggedin, $postrow[memberID], "You must select a class!");
	} else if ( $postrow[classdate][day] == 0 && $postrow[startsnow] != 'on')
	{
		$loggedin = CbodbMember::loggedInList(TRUE);
		HTML_cbodb::startClass( $option, $loggedin, $postrow[memberID], "You must select a date or choose 'today'!");
	} else 
	{
		recordClass($postrow[memberID],$postrow[classID],(strcmp($postrow[startsnow],"on")?0:1),$postrow[classdate],$postrow[duration],$postrow[students]);
		$mainframe->redirect('index.php?option=' .$option.'&task=shop&key=3b767559374f5132236f6e68256b2529#top', 'Class data recorded, thank you!');
	}
}
?>

<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'admin_functions' ) );

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

JSubMenuHelper::addEntry(JText::_('Main'), 'index.php?option=com_cbodb');
JSubMenuHelper::addEntry(JText::_('All Members'), 'index.php?option=com_cbodb&task=showmembers');
JSubMenuHelper::addEntry(JText::_('Clocked-in Members'), 'index.php?option=com_cbodb&task=showloggedin');
JSubMenuHelper::addEntry(JText::_('Bicycles'), 'index.php?option=com_cbodb&task=showbicycles');
JSubMenuHelper::addEntry(JText::_('Transactions'), 'index.php?option=com_cbodb&task=transactions&member_id=0&limitstart=0');
JSubMenuHelper::addEntry(JText::_('Tasks'), 'index.php?option=com_cbodb&task=showtasks');
JSubMenuHelper::addEntry(JText::_('Staff Totals'), 'index.php?option=com_cbodb&task=showstafftotals&dateStart=&dateEnd=');
JSubMenuHelper::addEntry(JText::_('Reporting'), 'index.php?option=com_cbodb&task=generatereport');

$mode = JRequest::getVar("cbodb_mode");

switch($task)
{
	case 'edit':
	case 'add':
	case 'new':
	case 'editMember':
		switch( $mode )
		{
			case 'bicycle':
				editBicycle( $option );
				break;
			case 'transaction':
		    switch( $task )
		    {
          case 'add':
          case 'new':
			      newProvisionalTransaction( $option, TRUE );
			      break;
			    default:
				    editTransaction( $option );
			      break;
				}
				break;
			case 'task':
				editTask( $option );
				break;
			case 'member':
			default:
		    switch( $task )
		    {
		      // Now separating New Member from Edit Existing; for MailChimp
          case 'add':
          case 'new':
			      addMember( $option );
			      break;
			    default:
				    editMember( $option );
			      break;
				}
				break;
		}
		break;
	case 'editTransaction':
		editTransaction( $option );
		break;
	case 'viewMemberMailChimpInfo':
		viewMemberMailChimpInfo( $option );
		break;
	case 'editMailingListSubscription':
		editMailingListSubscription( $option );
		break;
	case 'edittask':
		editTask( $option );
		break;
	case 'newtransactionfromtransaction':
		newProvisionalTransaction( $option, TRUE );
		break;
	case 'newtransactionfrommember':
		newProvisionalTransaction( $option, FALSE );
		break;
	case 'newtimetransaction':
		newTimetransaction( $option, FALSE );
		break;
	case 'selltomember':
	case 'transactions':
		showTransactions ( $option );
		break;
	case 'setip':
		doSetAddress( $option );
		break;
	case 'save':
		switch( $mode )
		{
			case 'member':
			  saveMember ( $option );
			  showMembers ( $option );
			  break;
			case 'transaction':
			  saveTransaction ( $option );
			  break;
			case 'bicycle':
			  saveBicycle ( $option );
			  break;
			case 'task':
			  saveTask ( $option );
			  break;
			case 'mailingsubscriptions':
			  saveMemberEmailSubscriptions( $option );
			  break;
		}
		break;
	case 'showall':
		switch( $mode )
		{
			case 'member':
			  showMembers ( $option );
			  break;
			case 'transaction':
			  showTransactions ( $option );
			  break;
			case 'bicycle':
			  showBicycles ( $option );
			  break;
			case 'task':
			  showTasks ( $option );
			  break;
		}
		break;
	case 'showactivetasks':
		switch( $mode )
		{
			case 'task':
			showTasks( $option, "active = 1" );
			break;
		}
		break;
	case 'showinactivetasks':
		switch( $mode )
		{
			case 'task':
			showTasks( $option, "active = 0" );
			break;
		}
		break;
	case 'showdonetasks':
		switch( $mode )
		{
			case 'task':
			showTasks( $option, "isDone = 1" );
			break;
		}
		break;
	case 'viewMember':
		viewMember( $option );
		break;
	case 'view':
		switch( JRequest::getVar("cbodb_mode") )
		{
			case 'member':
				viewMember( $option );
				break;
			case 'bicycle':
				viewBicycle( $option );
				break;
		}
		break;
	case 'clockout':
		adminLogoutMember( $option, FALSE );
		break;
	case 'clockoutattime':
		adminLogoutMember( $option, TRUE );
		break;
	case 'showbicycles':
		showBicycles( $option,FALSE );
		break;
	case 'showfilterbicycles':
		showBicycles( $option,TRUE );
		break;
	case 'editbicycle':
	case 'addbicycle':
		editBicycle( $option );
		break;
	case 'editbicyclebytag':
	  editBicycleByTag( $option );
	  break;
	case 'showfiltermembers':
		showMembers ( $option, TRUE );
		break;
	case 'showmembers':
		showMembers( $option, FALSE );
		break;
	case 'showloggedin':
		showLoggedInMembers( $option );
		break;
	case 'showtasks':
		showTasks( $option );
		break;
	case 'renewmember':
		adminRenewMember( $option );
		break;
	case 'toggletaskflag':
		toggleTaskFlag( $option );
		break;
	case 'listtransactions':
		listTransactions( $option, $mode );
		break;
	case 'showemailqueries':
		showEmailQueries( $option );
		break;
	case 'emailmenu':
		emailMenu( $option );
		break;
	case 'composeemail':
		composeEmail( $option );
		break;
	case 'sendemail':
		sendEmail( $option );
		break;
	case 'showstafftotals':
	  showStaffTotals( $option );
	  break;
	case 'generatereport':
	  showReportForm($option);
	  break;
	case 'mainmenu':
	default:
		showMainMenu( $option );
		break;
}

<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( $mainframe->getPath( 'toolbar_html', 'com_cbodb' ) );
$mode = JRequest::getVar('cbodb_mode');

switch($task)
{
	case 'transactions':
	case 'showtransactions':
    TOOLBAR_cbodb::_TRANSACTIONLIST();
		break;
	case 'view':
	  switch($mode)
	  {
	  case 'bicycle':
	  	TOOLBAR_cbodb::_BICYCLE();
	  	break;
	  case 'member':
	  default:
	  	TOOLBAR_cbodb::_MEMBER();
	  	break;
	  }
		break;
	case 'showall':
	  switch($mode)
	  {
	    case 'bicycle':
	    	TOOLBAR_cbodb::_BICYCLE();
	    	break;
	    case 'member':
	    	TOOLBAR_cbodb::_MEMBERLIST();
	    	break;
	    case 'transaction':
	    	TOOLBAR_cbodb::_TRANSACTIONLIST();
	    	break;
	    case 'task':
	    	TOOLBAR_cbodb::_TASKLIST();
	    	break;
	  }
	  break;
	case 'showfilterbicycles':
	case 'showbicycles':
	  TOOLBAR_cbodb::_BICYCLE();
		break;
	case 'editbicycle':
	case 'addbicycle':
	  TOOLBAR_cbodb::_EDITBICYCLE();
		break;
	case 'showmembers':
	case 'showfiltermembers':
	  TOOLBAR_cbodb::_MEMBERLIST();
		break;
	case 'showtasks':
  case 'showactivetasks':
	case 'showinactivetasks':
	case 'showdonetasks':
	  TOOLBAR_cbodb::_TASKLIST();
		break;
	case 'showloggedin':
	  TOOLBAR_cbodb::_LOGGEDINLIST();
		break;
  case 'renewmember':
  	TOOLBAR_cbodb::_NEW();
  	break;
  case 'editMailingListSubscription':
  	TOOLBAR_cbodb::_EDITMAILSUBSCRIPTIONS();
    break;
	case 'edittask':
  	  TOOLBAR_cbodb::_EDITTASK();
  	  break;
  case 'edittransaction':
	  	TOOLBAR_cbodb::_EDITTRANSACTION();
	  	break;
  case 'newtransactionfromtransaction':
  case 'newtransactionfrommember':
  case 'newtransaction':
	  TOOLBAR_cbodb::_NEWPROVISIONALTRANSACTION();
	  break;
  case 'newtimetransaction':
	  TOOLBAR_cbodb::_NEWTIMETRANSACTION();
	  break;
	case 'edit':
	case 'editMember':
    switch($mode)
	  {
	    case 'bicycle':
	  	  TOOLBAR_cbodb::_EDITBICYCLE();
	  	  break;
	    case 'member':
	  	  TOOLBAR_cbodb::_EDITMEMBER();
	  	  break;
	    case 'transaction':
	  	  TOOLBAR_cbodb::_EDITTRANSACTION();
	  	  break;
	    case 'task':
	  	  TOOLBAR_cbodb::_EDITTASK();
	  	  break;
	    default:
	  	  TOOLBAR_cbodb::_EDITMEMBER();
	  	  break;
	  }
	  break;
	case 'add':
	  switch($mode)
	  {
	    case 'bicycle':
	  	  TOOLBAR_cbodb::_EDITBICYCLE();
	  	  break;
	    case 'member':
	  	  TOOLBAR_cbodb::_NEWMEMBER();
	  	  break;
	    case 'transaction':
	  	  TOOLBAR_cbodb::_NEWTRANSACTION();
	  	  break;
	    case 'task':
	  	  TOOLBAR_cbodb::_NEWTASK();
	  	  break;
	    default:
	  	  TOOLBAR_cbodb::_NEWMEMBER();
	  	  break;
	  }
	  break;
  default:
  	TOOLBAR_cbodb::_DEFAULT();
  	break;
}
?>
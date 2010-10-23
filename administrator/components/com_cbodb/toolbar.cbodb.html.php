<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class TOOLBAR_cbodb {

  function _NEW() 
  {
  	JToolBarHelper::save();
  	//JToolBarHelper::apply();
  	JToolBarHelper::cancel('showall');
  }

	function _EDIT() 
	{
		TOOLBAR_cbodb::_NEW();
	}

	function _MEMBER() 
	{
		JToolBarHelper::custom('selltomember','apply.png','apply.png','Sell to Member',FALSE);
		JToolBarHelper::custom('editmember','apply.png','apply.png','Edit Member',FALSE);
		JToolBarHelper::cancel();
	}
	
  function _NEWMEMBER()
  {
    JToolBarHelper::title('New Member');
    TOOLBAR_cbodb::_NEW();
  }
  
  function _EDITMEMBER()
  {
  	JToolBarHelper::title('Edit Member');
  	TOOLBAR_cbodb::_EDIT();
  }
  
  function _EDITMAILSUBSCRIPTIONS()
  {
  	JToolBarHelper::title('Edit Member Mailing List Subscriptions');
  	JToolBarHelper::save();
  	//JToolBarHelper::save('saveMemberEmailSubscriptions', 'Save Subscriptions');
  	JToolBarHelper::cancel('showall');
  }
	
	function _BICYCLE()
	{
		JToolBarHelper::title('Bicycle Management');
  	JToolBarHelper::addNew('add','New Bicycle');
		JToolBarHelper::editList();
		//JToolBarHelper::custom('selltomember','apply.png','apply.png','Sell to Member',TRUE);
		JToolBarHelper::custom('viewbicycles','cancel.png','apply.png','Back to Main',FALSE);
	}

  function _EDITBICYCLE()
  {
  	JToolBarHelper::title('Bicycle Management');
  	JToolBarHelper::addNew('add','New Bicycle');
  	//JToolBarHelper::custom('selltomember','apply.png','apply.png','Sell to Member',TRUE);
  	JToolBarHelper::custom('viewbicycles','cancel.png','apply.png','Back to Main',FALSE);
  }

	function _TRANSACTIONLIST()
	{
		JToolBarHelper::title('Transaction Management');
		JToolBarHelper::addNew('add', 'New Provisional Transaction');
		JToolBarHelper::addNew('newtimetransaction', 'New Time Transaction');
		JToolBarHelper::editList('edit', 'Edit Transaction');
		//JToolBarHelper::addNew('members','View Members');
		JToolBarHelper::custom('mainmenu','cancel.png','apply.png','Back to Main',FALSE);
	}

  function _NEWTRANSACTION() 
  {
    JToolBarHelper::title('New Provisional Transaction');
    TOOLBAR_cbodb::_NEW();
  }

  function _NEWPROVISIONALTRANSACTION() 
  {
    JToolBarHelper::title('New Provisional Transaction');
    TOOLBAR_cbodb::_NEW();
  }

  function _NEWTIMETRANSACTION() 
  {
    JToolBarHelper::title('New Time Transaction');
    TOOLBAR_cbodb::_NEW();
  }

  function _EDITTRANSACTION()
  {
  	JToolBarHelper::title('Edit Transaction');
  	TOOLBAR_cbodb::_EDIT();
  }

	function _LOGGEDINLIST() 
	{
		JToolBarHelper::title('Clocked-in Members');
		JToolBarHelper::apply('showmembers','Show All Members');
		JToolBarHelper::custom('clockout','apply.png','apply.png','Clock Out');
		JToolBarHelper::custom('clockoutattime','apply.png','apply.png','Clock Out at time');
		JToolBarHelper::addNew('add', 'New Member');
		//JToolBarHelper::editList('edit', 'Edit Member'); // tries to Add New Member
		JToolBarHelper::custom('newtransactionfromtransaction','apply.png','apply.png','New Transaction for this Member',TRUE);
		JToolBarHelper::custom('Main Menu','cancel.png','apply.png','Back to Main',FALSE);
	}
	
	function _MEMBERLIST() 
	{
		JToolBarHelper::title('Member Management');
		JToolBarHelper::apply('showmembers','Show All Members');
		JToolBarHelper::apply('showloggedin','Show Clocked In Members');
		JToolBarHelper::addNew('add', 'New Member');
		JToolBarHelper::editList('edit', 'Edit Member');
		JToolBarHelper::custom('newtransactionfrommember','apply.png','apply.png','New Transaction for this Member',TRUE);
		JToolBarHelper::custom('Main Menu','cancel.png','apply.png','Back to Main',FALSE);
	}
	
	function _TASKLIST()
	{
		JToolBarHelper::title('Task Management');
		JToolBarHelper::apply('showall','Show All Tasks');
		JToolBarHelper::apply('showactivetasks','Show Active Tasks');
		JToolBarHelper::apply('showinactivetasks','Show Inactive Tasks');
		JToolBarHelper::apply('showdonetasks','Show Tasks Marked as Done');
		JToolBarHelper::addNew('add', 'New Task');
		JToolBarHelper::editList('edit', 'Edit Task');
		JToolBarHelper::custom('Main Menu','cancel.png','apply.png','Back to Main',FALSE);
	}

  function _NEWTASK()
  {
  	JToolBarHelper::title('New Task');
  	TOOLBAR_cbodb::_NEW();
  }

  function _EDITTASK()
  {
  	JToolBarHelper::title('Edit Task');
  	TOOLBAR_cbodb::_EDIT();
  }
	
	function _DEFAULT() 
	{
		JToolBarHelper::title('Ohio City Bicycle Co-op');
		JToolBarHelper::apply('showmembers','Show All Members');
		JToolBarHelper::apply('showloggedin','Show Clocked In Members');
		//JToolBarHelper::apply('setip','Reset IP Address');
		JToolBarHelper::addNew('showbicycles','View Bicycles');
		JToolBarHelper::addNew('transactions','View Transactions');
		JtoolBarHelper::addNew('showtasks','View Tasks');
		//JToolBarHelper::addNew('items','View Items');
		//JToolBarHelper::addNew('queue','View Work Queue');
		//JToolBarHelper::custom('Main Menu','cancel.png','apply.png','Back to Main',FALSE);
	}
}


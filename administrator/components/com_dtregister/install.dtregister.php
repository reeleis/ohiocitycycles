<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

function com_install() {

	$database = &JFactory::getDBO();

	JFolder::create('../images/dtregister/');
	
	JFolder::create('../images/dtregister/barcode/');
	
	JFolder::create('../images/dtregister/eventpics/');
	
	JFolder::create('../images/dtregister/locations/');
	
	JFolder::create('../images/dtregister/uploads/');
    
/******* Database changes from 2.6.9 to 2.7.x *******/

// Start changes for #__dtregister_categories

		$sql="Show columns from #__dtregister_categories";
		$database->setQuery($sql);
		$rows=$database->loadObjectList();
		$arrFields=array();

		for($i=0,$n=count($rows);$i<$n;$i++)
		{
			$row=$rows[$i];
			$arrFields[]=$row->Field;
		}

		if(!in_array('color',$arrFields))
		{
			$sql="ALTER TABLE `#__dtregister_categories` ADD `color` varchar(20) default NULL";
			$database->setQuery($sql);
			$database->query();
		}

		if(!in_array('published',$arrFields))
		{
			$sql="ALTER TABLE `#__dtregister_categories` ADD `published` int(1) default '0'";
			$database->setQuery($sql);
			$database->query();
		}
		
		if(!in_array('access',$arrFields))
		{
			$sql="ALTER TABLE `#__dtregister_categories` ADD `access` int(2) default '0'";
			$database->setQuery($sql);
			$database->query();
		}
		
		$sql= "ALTER TABLE `#__dtregister_categories` CHANGE `ordering` `ordering` INT(7) UNSIGNED NULL DEFAULT '1'";
		$database->setQuery($sql);
		$database->query();

	// End of changes to #__dtregister_categories

    // Start of changes to #__dtregister_codes

	$sql="Show columns from #__dtregister_codes";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('amount',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_codes` CHANGE `amount` `amount` decimal(8,2) default '0.00'";
		$database->setQuery($sql);
		$database->query();
	}
	
    // End of changes to #__dtregister_codes

    // Drop unneeded tables

	$sql="Show columns from #__dtregister_export_fields";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('group_export_fields',$arrFields))
	{
		$sql="DROP TABLE `#__dtregister_export_fields`";
		$database->setQuery($sql);
		$database->query();
	}
	
	$sql="Show columns from #__dtregister_sync";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('old_event_id',$arrFields))
	{
		$sql="DROP TABLE `#__dtregister_sync`";
		$database->setQuery($sql);
		$database->query();
	}

	$sql="Show columns from #__dtregister_waiting";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('number_registrants',$arrFields))
	{
		$sql="DROP TABLE `#__dtregister_waiting`";
		$database->setQuery($sql);
		$database->query();
	}

    // End of DROP tables

    // Start of changes to #__dtregister_fields table

	$sql="Show columns from #__dtregister_fields";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}
	
	if(!in_array('showed',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` CHANGE `showed` `showed` tinyint(2) NOT NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('textareafee',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `textareafee` text default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('showcharcnt',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `showcharcnt` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('default',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `default` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('confirmation_field',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `confirmation_field` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('listing',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `listing` text default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('textualdisplay',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `textualdisplay` int(1) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('applychangefee',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `applychangefee` int(2) default '1'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('tag',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `tag` varchar(255) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('all_tag_enable',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_fields` ADD `all_tag_enable` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	// End of changes to #__dtregister_fields table

    // Start of changes to #__dtregister_group_event

	$sql="Show columns from #__dtregister_group_event";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('title',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `title` varchar(255) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('dtstart',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `dtstart` date default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('dtend',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `dtend` date default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('dtstarttime',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `dtstarttime` TIME default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('dtendtime',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `dtendtime` TIME default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('tax_amount',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` CHANGE `tax_amount` `tax_amount` decimal(8,2) default '0.00'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('payment_id',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `payment_id` int(4) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('repetition_id',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `repetition_id` int(7) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('parent_id',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `parent_id` int(7) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('usercreation',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `usercreation` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('imagepath',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `imagepath` varchar(255) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('timeformat',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `timeformat` int(2) NULL default '2'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('latefeetime',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `latefeetime` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('bird_discount_time',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `bird_discount_time` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('starttime',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `starttime` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('cut_off_time',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `cut_off_time` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('change_time',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `change_time` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('cancel_time',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `cancel_time` time default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('user_id',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `user_id` int(7) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('changefee_enable',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `changefee_enable` int(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('changefee_type',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `changefee_type` int(2) default '1'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('changefee',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `changefee` decimal(8,2) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('cancelfee_type',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `cancelfee_type` int(2) default '1'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('cancelfee',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `cancelfee` decimal(8,2) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('usetimecheck',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `usetimecheck` int(1) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('group_registration_type',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `group_registration_type` varchar(20) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('cancel_enable',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `cancel_enable` tinyint(1) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('min_group_size',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `min_group_size` int(4) default '2'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('admin_notification_set',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `admin_notification_set` tinyint(2) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('admin_notification',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `admin_notification` text default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('partial_payment_enable',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `partial_payment_enable` int(1) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('prevent_duplication',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `prevent_duplication` tinyint(1) NULL default '1'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('event_admin_email_set',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `event_admin_email_set` tinyint(4) NOT NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('event_admin_email_from_name',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `event_admin_email_from_name` varchar(100) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('event_admin_email_from_email',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `event_admin_email_from_email` varchar(100) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('thanks_redirection',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `thanks_redirection` int(2) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}

	if(!in_array('thanks_redirect_url',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `thanks_redirect_url` varchar(255) default NULL";
		$database->setQuery($sql);
		$database->query();
	}

	if(!in_array('pay_later_redirection',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `pay_later_redirection` int(2) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}

	if(!in_array('pay_later_redirect_url',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_event` ADD `pay_later_redirect_url` varchar(255) default NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	$sql= "ALTER TABLE `#__dtregister_group_event` CHANGE `ordering` `ordering` INT(7) UNSIGNED NULL DEFAULT '1'";
	$database->setQuery($sql);
	$database->query();
	
	// End of changes to #__dtregister_group_event
	
	// Start of changes to #__dtregister_group_member
	
	$sql="Show columns from #__dtregister_group_member";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('created',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` ADD `created` DATETIME DEFAULT NULL";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('title',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `title`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('firstname',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `firstname`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('lastname',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `lastname`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('organization',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `organization`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('address',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `address`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('address2',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `address2`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('city',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `city`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('state',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `state`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('country',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `country`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('zip',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `zip`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('phone',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `phone`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('email',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_group_member` DROP `email`";
		$database->setQuery($sql);
		$database->query();
	}
	
	// End of changes to #__dtregister_group_member
	
	// Start of changes to #__dtregister_history

	$sql="Show columns from #__dtregister_history";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('transaction_id',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_history` CHANGE `amount` `amount` decimal(10,2) default '0.00'";
		$database->setQuery($sql);
		$database->query();
	}
	
	// End of changes to #__dtregister_history
	
	// Start of changes to #__dtregister_session
	
	$sql="Show columns from #__dtregister_session";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('processed',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_session` ADD `processed` tinyint(1) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	// End of changes to #__dtregister_session
	
	
	// Start of changes to #__dtregister_user

	$sql="Show columns from #__dtregister_user";
	$database->setQuery($sql);
	$rows=$database->loadObjectList();
	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)
	{
		$row=$rows[$i];
		$arrFields[]=$row->Field;
	}

	if(!in_array('userType',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` CHANGE `userType` `type` enum('I','G') default 'I'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('status',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` ADD `status` int(11) default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(!in_array('memtot',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` ADD `memtot` int(4) NULL default '0'";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('title',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `title`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('firstname',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `firstname`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('lastname',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `lastname`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('organization',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `organization`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('address',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `address`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('address2',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `address2`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('city',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `city`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('state',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `state`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('country',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `country`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('zip',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `zip`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('phone',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `phone`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('email',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `email`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userTitle',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userTitle`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userFirstName',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userFirstName`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userLastName',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userLastName`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userOrganization',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userOrganization`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userAddress',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userAddress`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userAddress2',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userAddress2`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userCity',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userCity`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userState',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userState`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userCountry',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userCountry`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userZip',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userZip`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userPhone',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userPhone`";
		$database->setQuery($sql);
		$database->query();
	}
	
	if(in_array('userEmail',$arrFields))
	{
		$sql="ALTER TABLE `#__dtregister_user` DROP `userEmail`";
		$database->setQuery($sql);
		$database->query();
	}

    // End of changes to #__dtregister_user

   // Add title field to config table

	$sql="Show columns from #__dtregister_config";

	$database->setQuery($sql);

	$rows=$database->loadObjectList();

	$arrFields=array();

	for($i=0,$n=count($rows);$i<$n;$i++)

	{

		$row=$rows[$i];

		$arrFields[]=$row->Field;

	}

	if(!in_array('title',$arrFields))

	{

		$sql="ALTER TABLE `#__dtregister_config` ADD `title` varchar(50) default NULL";

		$database->setQuery($sql);

		$database->query();

	}

	//Check and insert default data for configuration

	$sql="Select count(*) From #__dtregister_config";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		//Insert default data here
		$sql="INSERT INTO `#__dtregister_config` VALUES(1, 'capacity_column', '1', 'capacity_column');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(2, 'registered_column', '1', 'registered_column');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(3, 'cb_integrated', '1', 'cb_integrated');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(4, 'cbviewonly', '0', 'cbviewonly');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(5, 'thanksemail', '<p>[TITLE] [FIRSTNAME] [LASTNAME],</p>
		<p>You have registered for [EVENT_NAME] on [EVENT_DATE] which i held at [LOCATION]. Location details are:</p>
		<p>[LOCATION_DETAILS]</p>
		<p>Your info is:</p>
		<p>[ADDRESS]<br />[ADDRESS2]<br />[CITY], [STATE] [ZIP]<br />[COUNTRY]<br />[ORGANIZATION]<br />Phone: [PHONE]<br /> Email: [EMAIL]<br /></p>
		<p>There are [GROUP_NUMBER] people in your group:</p>
		<p>{GROUP_MEMBER}<br /> [TITLE] [FIRSTNAME] [LASTNAME]<br /> [ADDRESS]<br /> [ADDRESS2]<br /> [CITY], [STATE] [ZIP]<br /> [COUNTRY]<br /> Phone: [PHONE]<br /> Email: [EMAIL]<br /> {/GROUP_MEMBER}</p>
		<p>Your registration price total is [AMOUNT]. You have paid [AMOUNT_PAID], which leaves an amount due of [AMOUNT_DUE]. You paid via [PAYMENT_TYPE].</p>
		<br />
		<p>Your selected login info is:</p>
		<p>Username: [USERNAME]<br />Password: [PASSWORD]</p>
		<p>You registered on [DATE_REGISTERED] and your status is [STATUS] with a payment status of [PAID_STATUS].<br />Confirmation #: [CONFIRM_NUM]</p>
		<p>Thanks again for registering!</p>
		<p>Sincerely,</p>
		<p>Registration Team</p>', 'thanksemail');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(6, 'thanksmsg', 'Thank you for registering for [EVENT_NAME] on [EVENT_DATE]! Your registration is being processed and you will be sent any information that you need for the event. You will also be receiving an email receipt of your registration.', 'thanksmsg');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(7, 'subthanksemail', 'You have registered for [EVENT_NAME]!', 'subthanksemail');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(8, 'terms_conditions_msg', 'Place your terms and conditions message here.', 'terms_conditions_msg');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(9, 'terms_conditions', '1', 'terms_conditions');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(10, 'security_image_check', '1', 'security_image_check');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(11, 'full_message', 'This event is currently full and we are not allowing for any more registrations at this time.  We do apologize for this, but would like to offer you to be added to our Waiting List.  Fill out the following form, then if someone cancels their registration, you will be notified and given the opportunity to become an official registrant.', 'full_message');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(12, 'cut_off_date_message', 'We are no longer accepting registrations for this event. Thank you.', 'cut_off_date_message');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(13, 'waiting_msg', 'You have been added to the Waiting List for this event.  You will be notified if space becomes available. Thank you.', 'waiting_msg');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(14, 'paid_default_status', '0', 'paid_default_status');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(15, 'partial_default_status', '2', 'partial_default_status');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(16, 'paylater_default_status', '2', 'paylater_default_status');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(17, 'prerequisite_event_msg', '<p>Before you can register for this event, you must have already registered for the following event(s): <br />[PREREQ_EVENTS]</p>', 'prerequisite_event_msg');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(18, 'overlap_event_msg', '<p>You can not register for this event because you are already registered for another event at this same time.</p>', 'overlap_event_msg');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(19, 'confirm_number_start', '', 'confirm_number_start');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(20, 'confirm_number_prefix', 'DT-', 'confirm_number_prefix');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(21, 'confirm_number_type', 'random', 'confirm_number_type');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(22, 'prevent_duplication', '0', 'prevent_duplication');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(23, 'godaddy_hosting', '0', 'godaddy_hosting');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(24, 'save_payment_info', '1', 'save_payment_info');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(25, 'event_field_width', '200', 'event_field_width');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(26, 'event_filter_show', '1', 'event_filter_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(27, 'event_search_show', '1', 'event_search_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(28, 'eventListOrder', '1', 'eventListOrder');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(29, 'event_title_link', 'dtregister', 'event_title_link');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(30, 'sendEmailToGroup', '1', 'sendEmailToGroup');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(31, 'price_column', '1', 'price_column');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(32, 'private_event_msg', 'This event requires that you be a logged in member of this website. Please register a user account to gain access to our private events.', 'private_event_msg');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(33, 'private_event_notification', 'onscreen', 'private_event_notification');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(34, 'private_event_redirect', '', 'private_event_redirect');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(35, 'date_format', '%m-%d-%Y', 'date_format');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(36, 'event_show_date', '1', 'event_show_date');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(37, 'show_past_event', '0', 'show_past_event');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(38, 'show_group_members', '0', 'show_group_members');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(39, 'registrant_message', '<p>Below are the users that have already registered for this event.</p>', 'registrant_message');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(40, 'button_color', 'green', 'button_color');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(41, 'registrant_list', '1', 'registrant_list');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(42, 'registrant_avatar_height', '86', 'registrant_avatar_height');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(43, 'registrant_avatar_width', '60', 'registrant_avatar_width');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(44, 'registrant_cb_linked', '0', 'registrant_cb_linked');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(45, 'registrant_username', '0', 'registrant_username');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(46, 'registrant_registered_date', '1', 'registrant_registered_date');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(47, 'registrant_show_avatar', '0', 'registrant_show_avatar');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(48, 'show_registration_button', '1', 'show_registration_button');";
		$database->setQuery($sql);
		$database->query();

		$sql="INSERT INTO `#__dtregister_config` VALUES(49, 'linktogoogle', '1', 'linktogoogle');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(50, 'showlocation', '1', 'showlocation');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(51, 'displaytime', '2', 'displaytime');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(52, 'location_img_w', '150', 'location_img_w');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(53, 'location_img_h', '150', 'location_img_h');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(54, 'googlekey', '', 'googlekey');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(55, 'userpanelmessage', 'This is a message at the top of the user's control panel.', 'userpanelmessage');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(56, 'prerequisite_paid', '0', 'prerequisite_paid');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(57, 'prerequisite_attend', '0', 'prerequisite_attend');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(58, 'timecheck', '0', 'timecheck');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(59, 'paid_status_change_msg', 'The payment status of your registration of [EVENT_NAME] has been updated to [PAID_STATUS].', 'paid_status_change_msg');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(60, 'status_change_msg', 'The status of your registration of [EVENT_NAME] has been updated to [STATUS].', 'status_change_msg');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(61, 'paid_status_change_msg_send', '0', 'paid_status_change_msg_send');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(62, 'status_change_msg_send', '0', 'status_change_msg_send');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(63, 'map_cb_fields', '', 'map_cb_fields');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(64, 'map_jomsocial_fields', '', 'map_jomsocial_fields');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(65, 'DT_fromname', '', 'DT_fromname');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(66, 'DT_mailfrom', '', 'DT_mailfrom');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(67, 'month_filter_show', '1', 'month_filter_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(68, 'event_date_show', '1', 'event_date_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(69, 'barcode_enable', '0', 'barcode_enable');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(70, 'barcode_font_size', '12', 'barcode_font_size');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(71, 'barcode_resolution', '1', 'barcode_resolution');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(72, 'barcodeThick', '30', 'barcodeThick');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(73, 'barcodeDpi', '72', 'barcodeDpi');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(74, 'barcode_image_type', 'png', 'barcode_image_type');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(75, 'barcode_type', 'code39', 'barcode_type');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(76, 'barcode_rotation', '0', 'barcode_rotation');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(77, 'show_price_tax', '0', 'show_price_tax');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(78, 'admin_registrationemail', '<p>A new registration has come in for [EVENT_NAME] on [EVENT_DATE] at [EVENT_TIME]. The registrant is:</p>
		<p>Name: [FIRSTNAME] [LASTNAME]<br />Address: [ADDRESS]<br />Address2: [ADDRESS2]<br />City: [CITY]<br />State: [STATE] <br />Zip: [ZIP]<br />Country: [COUNTRY]<br />Organization: [ORGANIZATION]<br />Phone: [PHONE]<br /> Email: [EMAIL]</p>
		<p>[ALL_FIELDS]</p>
		<p>Number of Members: [GROUP_NUMBER]</p>
		<p>{GROUP_MEMBER}<br /> [TITLE] [FIRSTNAME] [LASTNAME]<br /> [ADDRESS]<br /> [ADDRESS2]<br /> [CITY], [STATE] [ZIP]<br /> [COUNTRY]<br /> Phone: [PHONE]<br /> Email: [EMAIL]<br />[ALL_FIELDS]<br />{/GROUP_MEMBER}</p>
		<p>Registration Amount: [AMOUNT]<br />Amount Paid: [AMOUNT_PAID]<br />Payment Method: [PAYMENT_TYPE]</p>
		<p>Status: [STATUS]<br />Username created: [USERNAME]</p>
		<p>Confirmation Number: [CONFIRM_NUM]<br />Transaction ID: [TRANS_ID]</p>
		<p>[BARCODE]</p>', 'admin_registrationemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(79, 'calendar_eventTitle_wrap', '1', 'calendar_eventTitle_wrap');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(80, 'calendar_link', '1', 'calendar_link');";

		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(81, 'calendar_showCat', '1', 'calendar_showCat');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(82, 'calendar_showTime', '1', 'calendar_showTime');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(83, 'calendar_startDay', '1', 'calendar_startDay');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(84, 'csv_separator', ',', 'csv_separator');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(85, 'email_cancel_confirm', '', 'email_cancel_confirm');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(86, 'email_change_confirm', '', 'email_change_confirm');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(87, 'event_date_width', '', 'event_date_width');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(88, 'event_list_number', '20', 'event_list_number');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(89, 'event_thumb_height', '150', 'event_thumb_height');";
		$database->setQuery($sql);
		$database->query();
	
		$sql="INSERT INTO `#__dtregister_config` VALUES(90, 'event_thumb_width', '150', 'event_thumb_width');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(91, 'eventModifyNotification', '', 'eventModifyNotification');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(92, 'front_link_type', '1', 'front_link_type');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(93, 'frontendEventNotification', '', 'frontendEventNotification');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(94, 'link_moderator_profile', '1', 'link_moderator_profile');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(95, 'pay_later_thk_msg', 'Thank you for registering for [EVENT_NAME] on [EVENT_DATE]! Your registration is being processed and you will be sent any information that you need for the event. You will also be receiving an email receipt of your registration.', 'pay_later_thk_msg');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(96, 'payment_confirm', '', 'payment_confirm');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(97, 'show_fee_breakdown', '1', 'show_fee_breakdown');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(98, 'show_moderator', '1', 'show_moderator');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(99, 'subchangestatusemail', 'Status changed for [EVENT_NAME]', 'subchangestatusemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(100, 'subject_admin_registrationemail', 'New [EVENT_NAME] Registration', 'subject_admin_registrationemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(101, 'subpaidstatusemail', 'Payment Status changed for [EVENT_NAME]', 'subpaidstatusemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(102, 'upanel_amount_show', '1', 'upanel_amount_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(103, 'upanel_cancel_show', '1', 'upanel_cancel_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(104, 'upanel_due_show', '1', 'upanel_due_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(105, 'upanel_edit_show', '1', 'upanel_edit_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(106, 'upanel_pay_show', '1', 'upanel_pay_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(107, 'upanel_status_show', '1', 'upanel_status_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(108, 'upsubcancelemail', 'Cancelled Registration for [EVENT_NAME]', 'upsubcancelemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(109, 'upsubchangeemail', 'Changed Registration for [EVENT_NAME]', 'upsubchangeemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(110, 'upsubpaymentemail', 'Payment Made for [EVENT_NAME]', 'upsubpaymentemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(111, 'show_event_image', '1', 'show_event_image');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(112, 'calendar_show_image_gridview', '0', 'calendar_show_image_gridview');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(113, 'event_image_gridview_width', '60', 'event_image_gridview_width');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(114, 'event_image_gridview_height', '60', 'event_image_gridview_height');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(115, 'calendar_show_popup', '1', 'calendar_show_popup');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(116, 'calendar_show_image', '1', 'calendar_show_image');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(117, 'calendar_show_date', '1', 'calendar_show_date');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(118, 'calendar_show_time', '1', 'calendar_show_time');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(119, 'calendar_show_price', '1', 'calendar_show_price');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(120, 'calendar_show_capacity', '1', 'calendar_show_capacity');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(121, 'calendar_show_registered', '1', 'calendar_show_registered');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(122, 'calendar_show_available_spots', '1', 'calendar_show_available_spots');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(123, 'calendar_show_location', '1', 'calendar_show_location');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(124, 'calendar_show_moderator', '1', 'calendar_show_moderator');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(125, 'waitingemail', '<p>[TITLE] [FIRSTNAME] [LASTNAME],</p>
		<p>You have joined the Waiting List for [EVENT_NAME] on [EVENT_DATE] which is held at [LOCATION]. Location details are:</p>
		<p>[LOCATION_DETAILS]</p>
		<p>Your info is:</p>
		<p>[ADDRESS]<br />[ADDRESS2]<br />[CITY], [STATE] [ZIP]<br />[COUNTRY]<br />[ORGANIZATION]<br />Phone: [PHONE]<br /> Email: [EMAIL]</p>
		<p>[ALL_FIELDS]</p>
		<p>There are [GROUP_NUMBER] people in your group:</p>
		<p>{GROUP_MEMBER}<br /> [TITLE] [FIRSTNAME] [LASTNAME]<br /> [ADDRESS]<br /> [ADDRESS2]<br /> [CITY], [STATE] [ZIP]<br /> [COUNTRY]<br /> Phone: [PHONE]<br /> Email: [EMAIL]<br />[ALL_FIELDS]<br /> {/GROUP_MEMBER}</p>
		<p>Your registration price total is  [AMOUNT] and will be required if space becomes available for you.</p>
		<p>You signed up on the waiting list on [DATE_REGISTERED] and your status is [STATUS].<br />Confirmation #: [CONFIRM_NUM]</p>
		<p>Thanks again for registering!</p>
		<p>Sincerely,</p>
		<p>Registration Team</p>', 'waitingemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(126, 'subwaitingemail', 'You are on the Waiting List for [EVENT_NAME]', 'subwaitingemail');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(127, 'event_location_show', '0', 'event_location_show');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(128, 'thanks_redirection', '1', 'thanks_redirection');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(129, 'pay_later_redirection', '1', 'pay_later_redirection');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_config` VALUES(130, 'admin_email_from_user', '0', 'admin_email_from_user');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default properties into database

	$sql="Select count(*) From #__dtregister";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{	
		$sql="INSERT INTO `#__dtregister` VALUES(1,'migrate','0');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default Fields into database

	$sql="Select count(*) From #__dtregister_fields where `name`
	  in('firstname','title','lastname','address','address2','city','state','zip','country','phone','email','organization')";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if( $total < 1 )
	{ 
	    
	   $sql="delete t1, t2 From #__dtregister_fields t1 left join #__dtregister_field_event t2 on t1.id = t2.field_id where `name`  
	   in('firstname','title','lastname','address','address2','city','state','zip','country','phone','email','organization')";
	   $database->setQuery($sql);
	   $database->query();
	   echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'title','Title','100','','1','1','0','	Mr|Mrs|Ms|Miss|Dr|Rev','1','','0','0','0','','0','','1','1','1','0|0|0|0|0|0','1','','0','0','0','2','0','3','0','','0','','','0','0','0','','0','1','TITLE','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'firstname','First Name','30','','2','1','1','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','3','1','3','60','','0','','','0','1','0','memberlist|attendeelist|recordlist','0','1','FIRSTNAME','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();

		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'lastname','Last Name','30','','3','1','1','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','3','1','3','100','','0','','','0','1','0','memberlist|attendeelist|recordlist','0','1','LASTNAME','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'address','Address','30','','5','1','0','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','1','0','0','200','','0','','','0','0','0','memberlist','0','0','ADDRESS','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'address2','Address 2','30','','6','1','0','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','1','0','0','200','','0','','','0','0','0','memberlist','0','0','ADDRESS2','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'city','City','30','','7','1','1','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','3','1','3','100','','0','','','0','0','0','memberlist','0','0','CITY','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'state','State','150','','8','1','0','Alabama|Alaska|Arizona|Arkansas|California|Colorado|Connecticut|Delaware|District of Columbia|Florida|Georgia|Hawaii|Idaho|Illinois|Indiana|Iowa|Kansas|Kentucky|Louisiana|Maine|Maryland|Massachusetts|Michigan|Minnesota|Mississippi|Missouri|Montana|Nebraska|Nevada|New Hampshire|New Jersey|New Mexico|New York|North Carolina|North Dakota|Ohio|Oklahoma|Oregon|Pennsylvania|Rhode Island|South Carolina|South Dakota|Tennessee|Texas|Utah|Vermont|Virginia|Washington|West Virginia|Wisconsin|Wyoming','1','','0','0','0','','0','','1','1','1','0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0','1','','0','0','0','3','1','3','0','','0','','','0','0','0','','0','0','STATE','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'zip','Zip','10','','9','1','0','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','1','1','3','10','','0','','','0','0','0','','0','0','ZIP','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$text = "Afghanistan|Albania|Algeria|Andorra|Angola|Antigua & Barbuda|Argentina|Armenia|Australia|Austria|Azerbaijan|Bahamas|Bahrain|Bangladesh|Barbados|Belarus|Belgium|Belize|Benin|Bhutan|Bolivia|Bosnia & Herzegovina|Botswana|Brazil|Brunei Darussalam|Bulgaria|Burkina Faso|Burma (Myanmar)|Burundi|Cambodia|Cameroon|Canada|Cape Verde|Cayman Islands|Central African|Chad|Chile|China|Colombia|Comoros|Congo|Congo, Democratic Republic of the|Costa Rica|Côte d'Ivoire|Croatia|Cuba|Cyprus|Czech Republic|Denmark|Djibouti|Dominica|Dominican Republic|Ecuador|East Timor|Egypt|El Salvador|England|Equatorial Guinea|Eritrea|Estonia|Ethiopia|Fiji|Finland|France|Gabon|Gambia, The|Georgia|Germany|Ghana|Great Britain|Greece|Grenada|Guatemala|Guinea|Guinea-Bissau|Guyana|Haiti|Honduras|Hong Kong|Hungary|Iceland|India|Indonesia|Iran|Iraq|Ireland|Israel|Italy|Jamaica|Japan|Jordan|Kazakhstan|Kenya|Kiribati|Kuwait|Kyrgyzstan|Laos|Latvia|Lebanon|Lesotho|Liberia|Libya|Liechtenstein|Lithuania|Luxembourg|Macedonia|Madagascar|Malawi|Malaysia|Maldives|Mali|Malta|Marshall Islands|Mauritania|Mauritius|Mexico|Micronesia|Moldova|Monaco|Mongolia|Montenegro|Morocco|Mozambique|Myanmar|Namibia|Nauru|Nepal|The Netherlands|New Zealand|Nicaragua|Niger|Nigeria|North Korea|Norway|Oman|Pakistan|Palau|Palestinian State|Panama|Papua New Guinea|Paraguay|Peru|Philippines|Poland|Portugal|Qatar|Romania|Russia|Rwanda|St. Kitts & Nevis|St. Lucia|St. Vincent & The Grenadines|Samoa|San Marino|São Tomé & Príncipe|Saudi Arabia|Senegal|Serbia|Seychelles|Sierra Leone|Singapore|Slovakia|Slovenia|Solomon Islands|Somalia|South Africa|South Korea|Spain|Sri Lanka|Sudan|Suriname|Swaziland|Sweden|Switzerland|Syria|Taiwan|Tajikistan|Tanzania|Thailand|Togo|Tonga|Trinidad & Tobago|Tunisia|Turkey|Turkmenistan|Tuvalu|Uganda|Ukraine|United Arab Emirates|United Kingdom|United States|Uruguay|Uzbekistan|Vanuatu|Vatican City|Venezuela|Vietnam|Western Sahara|Yemen|Yugoslavia|Zaire|Zambia|Zimbabwe";
		$text = $database->Quote($text);
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'country','Country','150','','10','1','0',".$text.",'1','United States','0','0','0','','0','','1','1','1','0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0','1','','0','0','0','2','0','3','0','','0','','','0','0','0','','0','0','COUNTRY','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();

		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'email','Email','30','','11','1','1','','8','','0','0','0','','0','','1','1','1','','1','','0','0','0','3','1','3','100','','0','','','0','0','1','memberlist|recordlist','0','0','EMAIL','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'phone','Phone','10','','12','1','0','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','3','1','1','10','','0','','','0','0','0','','0','0','PHONE','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
		
		$sql="INSERT INTO `#__dtregister_fields` VALUES(null, 'organization','Organization','30','','4','1','0','','0','','0','0','0','','0','','1','1','1','','1','','0','0','0','1','0','0','200','','0','','','0','0','0','attendeelist','0','0','ORGANIZATION','0');";
		$database->setQuery($sql);
		$database->query();
		echo $database->getErrorMsg();
	}


	// Changes to #__dtregister_field_event

		$sql="Show columns from #__dtregister_field_event";
		$database->setQuery($sql);
		$rows=$database->loadObjectList();
		$arrFields=array();

		for($i=0,$n=count($rows);$i<$n;$i++)
		{
			$row=$rows[$i];
			$arrFields[]=$row->Field;
		}

		if(in_array('showed',$arrFields))
		{
			$sql="ALTER TABLE `#__dtregister_field_event` CHANGE `showed` `showed` TINYINT(3) DEFAULT NULL";
			$database->setQuery($sql);
	     	$database->query();
		}

    $query = "insert into #__dtregister_field_event(field_id,event_id,showed) select t3.* , -1 from (SELECT *
FROM (

SELECT id
FROM #__dtregister_fields
WHERE `name`
IN (
'firstname', 'title', 'lastname', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'email', 'organization'
)
)t
JOIN (

SELECT DISTINCT slabId
FROM `#__dtregister_group_event`
)t2 ) t3 left join #__dtregister_field_event t4 on t4.field_id = t3.id and t4.event_id = t3.slabId  where t4.event_id is null";
    $database->setQuery($sql);
	$database->query();
	echo $database->getErrorMsg();
	// End of changes to #__dtregister_field_event

	// Load default Permissions options into database

	$sql="Select count(*) From #__dtregister_acos";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		//Insert default data here
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(1,'event','add','DT_EVENT_CREATE','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(2,'event','edit','DT_EDIT_OWN_EVENT','sessionUser');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(3,'event','publish','DT_PUBLISH_EVENT','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(4,'event','delete','DT_DELETE_EVENT','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(5,'event','unpublish','DT_EDIT_OWN_EVENT','sessionUser');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(6,'event','publish','DT_EDIT_OWN_EVENT','sessionUser');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(7,'event','unpublish','DT_PUBLISH_EVENT','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(8,'payoption','delete','DT_EDIT_DELETE_PAYOPTION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(9,'payoption','edit','DT_EDIT_DELETE_PAYOPTION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(10,'category','add','DT_CREATE_CATEGORY','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(11,'field','delete','DT_EDIT_DELETE_FIELD','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(12,'field','edit','DT_EDIT_DELETE_FIELD','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(13,'discountcode','add','DT_CREATE_DISCOUNTCODE','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(14,'location','add','DT_CREATE_LOCATION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(15,'config','index','DT_CONFIG','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(16,'payoption','add','DT_CREATE_PAYOPTION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(17,'registrantemail','index','DT_EMAIL_REGISTRANT','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(18,'discountcode','delete','DT_EDIT_DELETE_DISCOUNTCODE','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(19,'discountcode','edit','DT_EDIT_DELETE_DISCOUNTCODE','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(20,'field','add','DT_CREATE_FIELD','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(21,'category','delete','DT_EDIT_DELETE_CATEGORY','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(22,'category','edit','DT_EDIT_DELETE_CATEGORY','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(23,'location','delete','DT_EDIT_DELETE_LOCATION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(24,'location','edit','DT_EDIT_DELETE_LOCATION','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(25,'export','fieldlist','DT_CSV_EXPORT','action');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_acos` VALUES(26,'export','eventlist','DT_CSV_EXPORT','action');";
		$database->setQuery($sql);
		$database->query();
	}
	
	$sql="UPDATE `#__dtregister_acos` SET `controller` = 'payoption' WHERE `controller` = 'payment'";
	$database->setQuery($sql);
	$database->query();
	// echo "<br />".$database->getErrorMsg();
		
	// Load default Joomla User groups into database for Permissions use

	$sql="Select count(*) From #__dtregister_aros";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		$sql="INSERT INTO `#__dtregister_aros` VALUES(1,'29','joomlaAro','Public Frontend');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(2,'18','joomlaAro','Registered');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(3,'19','joomlaAro','Author');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(4,'20','joomlaAro','Editor');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(5,'21','joomlaAro','Publisher');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(6,'30','joomlaAro','Public Backend');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(7,'23','joomlaAro','Manager');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(8,'24','joomlaAro','Administrator');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_aros` VALUES(9,'25','joomlaAro','Super Administrator');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default Admin Permissions into database

	$sql="Select count(*) From #__dtregister_permissions";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(1,'9','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(2,'9','3');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(3,'9','7');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(4,'9','4');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(5,'9','10');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(6,'9','22');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(7,'9','21');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(8,'9','20');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(9,'9','12');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(10,'9','11');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(11,'9','13');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(12,'9','19');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(13,'9','18');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(14,'9','14');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(15,'9','24');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(16,'9','23');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(17,'9','15');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(18,'9','17');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(19,'9','16');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(20,'9','9');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(21,'9','8');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(22,'1','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(23,'1','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(24,'1','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(25,'2','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(26,'2','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(27,'2','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(28,'3','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(29,'3','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(30,'3','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(31,'4','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(32,'4','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(33,'4','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(34,'5','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(35,'5','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(36,'5','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(37,'6','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(38,'6','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(39,'6','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(40,'7','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(41,'7','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(42,'7','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(43,'8','2');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(44,'8','5');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(45,'8','6');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(46,'9','25');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_permissions` VALUES(47,'9','26');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default Pay Later options into database

	$sql="Select count(*) From #__dtregister_paylater";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		$sql="INSERT INTO `#__dtregister_paylater` VALUES(1,'Pay at the Door');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_paylater` VALUES(2,'Mail in Payment');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_paylater` VALUES(3,'Call in Payment');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default Pay Option into database

	$sql="Select count(*) From #__dtregister_payment";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		$sql="INSERT INTO `#__dtregister_payment` VALUES(1,'Default Payment Options','1');";
		$database->setQuery($sql);
		$database->query();
	}
	
	
	// Load default Pay Option Config into database

	$sql="Select count(*) From #__dtregister_payment_config";
	$database->setQuery($sql);
	$total=$database->loadResult();
	
	if(!$total)
	{
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(1,'pay_later_options','1,2,3','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(2,'sage_M_id','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(3,'sage_M_key','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(4,'idealLiteHashKey','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(5,'idealLiteMerchantId','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(6,'partner_id','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(7,'eway_customerid','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(8,'ewaytype','hosted','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(9,'paypalid','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(10,'netdeposit_clientcode','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(11,'netdeposit_clientid','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(12,'googleapikey','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(13,'googlemerchid','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(14,'merchid','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(15,'transkey','','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(16,'cardtype','Visa,MasterCard','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(17,'paymentmethod','authorizenet,paypal,pay_later','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(18,'paymentmode','live','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(19,'currency_separator','2','1');";
		$database->setQuery($sql);
		$database->query();
		
		$sql="INSERT INTO `#__dtregister_payment_config` VALUES(20,'currency_code','USD','1');";
		$database->setQuery($sql);
		$database->query();
	}
	

	//Check if the fields exist or not for CB Payment Info Records

	$fieldName="cb_creditcardnumber";
	//$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
	$sql="SHOW TABLES LIKE '%_comprofiler%'";
	$database->setQuery($sql);
	$database->getQuery();
	$total=$database->loadResult();
	if($total)
	{
		//Create CB tabs and CB fields for storing payment data
		$sql="Select tabid From #__comprofiler_tabs where title='Payment Information'";
		$database->setQuery($sql);
		$tabId=$database->loadResult();
		if(!$tabId)
		{
			$sql="INSERT INTO `#__comprofiler_tabs` VALUES ('', 'Payment Information', 'This information is used for online payments on this website.', 107, 10, '.5', 1, NULL, NULL, 1, '', 0, 'tab', 'cb_tabmain', -2);";
			$database->setQuery($sql);
			$database->query();
			$tabId=$database->insertid();
		}

			//Here we will add the additional fields for storing payment information
			$fieldName="cb_creditcardnumber";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();
			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Credit Card Number', 'Enter your card number without any dashes or spaces like aaaabbbbccccdddd', 'text', 16, 16, 0, $tabId, 5, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0,  NULL);"	;
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}

			$fieldName="cb_expdate";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();

			if(!$total)
			{
				//Add the fields to this table

				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Expiration Date', 'Enter your credit card expiration date as mm/yy', 'text', 5, 5, 0, $tabId, 6, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0,  NULL);"	;
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}
			$fieldName="cb_routingnumber";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();

			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'ABA Routing Number', 'Enter your 9-digit routing number for your checking account. Do not use any space or other characters.', 'text', 9, 10, 0, $tabId, 3, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0,  NULL);"	;
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}
			
		    $fieldName="cb_acctnumber";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();
			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Bank Account Number', 'Enter your bank account number with no spaces or other characters.', 'text', 0, 0, 0, $tabId, 1, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0, NULL);"	;
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();
				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}
			$fieldName="cb_bankname";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();

			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Bank Name', 'Enter the name of your Bank.', 'text', 60, 20, 0, $tabId, 2, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0,  NULL);";
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}

			$fieldName="cb_cardtype";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();
			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Card Type', 'Please select the type of card you are using.', 'select', 0, 20, 0, $tabId, 7, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0,  NULL);";
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();

				//add values to these type of fields
				$sql="INSERT INTO `#__comprofiler_field_values` VALUES ('', $fieldId, 'Visa', 1, 0);";
				$database->setQuery($sql);
				$database->query();
				$sql="INSERT INTO `#__comprofiler_field_values` VALUES ('', $fieldId, 'MasterCard', 2, 0);";
				$database->setQuery($sql);
				$database->query();
				$sql="INSERT INTO `#__comprofiler_field_values` VALUES ('', $fieldId, 'Discover', 3, 0);";
				$database->setQuery($sql);
				$database->query();
				$sql="INSERT INTO `#__comprofiler_field_values` VALUES ('', $fieldId, 'American Express', 4, 0);";
				$database->setQuery($sql);
				$database->query();
			}

			$fieldName="cb_accountholder";
			$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
			$database->setQuery($sql);
			$total=$database->loadResult();

			if(!$total)
			{
				//Add the fields to this table
				$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Account Holder', 'Enter the name on the bank account.', 'text', 50, 20, 0, $tabId, 8, 0, 0, NULL, NULL, 1, 0, 0, 0, 0, 0, NULL);";
				$database->setQuery($sql);
				$database->query();
				$fieldId=$database->insertid();

				//Add this field to #___comprofiler table
				$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
				$database->setQuery($sql);
				$database->query();
			}

	///////////////////////////////////////////////////////////
	//Check if the fields exist or not for Additional User Info
	///////////////////////////////////////////////////////////

		//Create CB tabs and CB fields for storing user information
		$sql="Select tabid From #__comprofiler_tabs where title='Additional Info'";
		$database->setQuery($sql);
		$tabId=$database->loadResult();
		if(!$tabId)
		{
			$sql="INSERT INTO `#__comprofiler_tabs` VALUES ('', 'Additional Info', 'Additional User contact information', 1, 10, '.5', 1, NULL, NULL, 1, NULL, 0, 'tab', 'cb_tabmain', -2);";
			$database->setQuery($sql);
			$database->query();
			$tabId=$database->insertid();
		}
		
	    $fieldName="cb_title";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Title', '', 'text', 0, 0, 0, '$tabId', 7, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);"	;
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}

		$fieldName="cb_address";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Address', '', 'text', 0, 0, 0, '$tabId', 7, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);"	;
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}
		$fieldName="cb_address2";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Address 2', '', 'text', 0, 0, 0, '$tabId', 7, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}
		//Here we will begin adding fields for additional user info
		$fieldName="cb_website";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();

		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Website', '', 'webaddress', 0, 0, 0, '$tabId', 1, 0, 0, NULL, NULL, 1, 0, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}

		$fieldName="cb_company";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table

			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Company', '', 'text', 0, 0, 0, '$tabId', 2, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}

		$fieldName="cb_phone";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Phone', '', 'text', 0, 0, 0, '$tabId', 8, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0, NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}
		$fieldName="cb_city";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{

			//Add the fields to this table

			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'City', '.', 'text', 0, 0, 0, '$tabId', 3, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}

		$fieldName="cb_state";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();

		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'State', '', 'text', 10, 4, 0, '$tabId', 4, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}
		$fieldName="cb_zipcode";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();
		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Zip Code', '', 'text', 0, 0, 0, '$tabId', 5, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();
			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}

		$fieldName="cb_country";
		$sql="Select count(*) From #__comprofiler_fields where name='$fieldName'";
		$database->setQuery($sql);
		$total=$database->loadResult();

		if(!$total)
		{
			//Add the fields to this table
			$sql="INSERT INTO #__comprofiler_fields(`fieldid`,`name`,`table`,`title`,`description`,`type`,`maxlength`,`size`,`required`,`tabid`,`ordering`,`cols`,`rows`,`value`,`default`,`published`,`registration`,`profile`,`readonly`,`calculated`,`sys`,`params`) VALUES ('', '$fieldName', '#__comprofiler', 'Country', '', 'text', 0, 0, 0, '$tabId', 6, 0, 0, NULL, NULL, 1, 1, 1, 0, 0, 0,  NULL);";
			$database->setQuery($sql);
			$database->query();
			$fieldId=$database->insertid();

			//Add this field to #___comprofiler table
			$sql="Alter table #__comprofiler add `$fieldName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
			$database->setQuery($sql);
			$database->query();
		}
	}
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'defines.php');
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtmodel.php');
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dttable.php');
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'migration.php'); 
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'event.php'); 
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'user.php');
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'member.php');
	include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'models'.DS.'dtregister.php'); 
    $migrate = DtrModel::getInstance('migration','DtregisterModel');
	$tables = $database->getTableList();
	$table_name = $database->getPrefix()."dtregister_rollback_group_event";
	$rollbackthere = !(in_array($table_name,$tables));
	$newTable = $database->getPrefix()."dtregister_group_event";
	$freshinstall = !(in_array($newTable,$tables));
	$dtreg = DtrModel::getInstance('dtregister','DtregisterModel');
	if($rollbackthere && !$dtreg->migrated && !$freshinstall){
		$migrate->backupForRollback();
		//$migrate->event();
		//$migrate->usertable();
		
	}elseif(!$dtreg->migrated && !$freshinstall){
		//$migrate->fix_migration();
			
	}
	$migrate->TableUser->renamefield('userType','type');
	$offset = $migrate->get_jevent_offset();
		if($offset === 0){
			$offset = " + 0 " ;
		}elseif($offset < 0){
			$offset = " - ".abs($offset);
		}elseif($offset > 0){
			$offset = " + ".abs($offset);
		}
		
		$query = "update #__dtregister_group_event e inner join  #__dtregister_rollback_group_event re on 

re.slabId = e.slabId inner join #__jevents_vevdetail j on re.eventId=j.evdet_id set 

e.title = 
			j.summary ,  e.dtstart = FROM_UNIXTIME(j.dtstart ".$offset." ,'%Y-%m-%d') , 

e.dtstarttime = FROM_UNIXTIME(j.dtstart ".$offset." ,'%H:%i:%s') , 
			e.dtend =  FROM_UNIXTIME(j.dtend ".$offset." ,'%Y-%m-%d') , e.dtendtime = 

FROM_UNIXTIME(j.dtend ".$offset." ,'%H:%i:%s') where e.title is null or e.title = ''";

  
       $database->setQuery($query);
	   $database->query();
	  // echo $database->getErrorMsg();
		
	
	// Onscreen text after successful installation
	
 if(!is_dir('../images/dtregister/locations/')){
   print "<font color=red>Failed to create folder /images/dtregister/locations/  <br />Please create this directory manually and make sure it is writable.</font><br />";
 }
  echo "<p><b>DT Register component Installed Successfully!</b></p>";

  echo "<p>To create your landing page for registration and list your events, simply create a Component menu item for DT Register.

<br /><br /></p>";

  echo "<p>

<br /></p>";

  echo "<p>Be sure to check our website at <a href=\"http://www.dthdevelopment.com\" target=\"_blank\">www.DTHDevelopment.com</a> for video tutorials and other support.

<br /><br /></p>";

}

?>
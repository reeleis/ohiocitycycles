
CREATE TABLE IF NOT EXISTS `#__dtregister` (
  `id` INT (7) NOT NULL AUTO_INCREMENT,
  `property` VARCHAR(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_acos` (
  `id` INT (7) NOT NULL AUTO_INCREMENT,
  `controller` VARCHAR(100) DEFAULT NULL,
  `task` VARCHAR(100) DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT NULL,
  `type` VARCHAR(50) DEFAULT 'action',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_aros` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `aro_id` INT(7) NULL DEFAULT '0',
  `type` VARCHAR(100) DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_captcha` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_ip` VARCHAR(50) NULL,
  `code` VARCHAR(50) NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_categories` (
  `categoryId` int(11) NOT NULL auto_increment,
  `categoryName` varchar(100) NOT NULL default '',
  `ordering` tinyint(3) UNSIGNED NULL,
  `parent_id` int(11) default '0',
  `color` varchar(20) default NULL,
  `published` int(1) default '0',
  `access` int(2) default '0',
  PRIMARY KEY  (`categoryId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_codes` (
  `id` bigint(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `start` datetime default NULL,
  `end` datetime default NULL,
  `publish` int(11) default '0',
  `discount_type` int(3) default '1',
  `amount` decimal(8,2) default '0.00',
  `code` varchar(20) default NULL,
  `limit` int(4) default '0',
  `events_enable` int(2) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_config` (
  `id` int(11) NOT NULL auto_increment,
  `config_key` varchar(50) default NULL,
  `config_value` text,
  `title` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_events_codes` (
  `id` bigint(11) NOT NULL auto_increment,
  `event_id` bigint(11) default NULL,
  `discount_code_id` bigint(11) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_event_config` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_event_detail` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `slabId` INT(7) NULL DEFAULT '0',
  `member` INT(4) NULL DEFAULT '1',
  `type` VARCHAR(20) NULL DEFAULT 'per_person',
  `amount` decimal(10,2) NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) TYPE=MYISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_export_settings` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `group_export_fields` text NOT NULL,
  `individual_export_fields` text NOT NULL,
  `general_export_fields` text NOT NULL,
  `events` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `basefee` varchar(12) DEFAULT NULL,
  `memberdiscount` varchar(12) DEFAULT NULL,
  `latefee` varchar(12) DEFAULT NULL,
  `birddiscount` varchar(12) DEFAULT NULL,
  `discountcodefee` varchar(12) DEFAULT NULL,
  `customfee` varchar(12) DEFAULT NULL,
  `tax` varchar(12) DEFAULT NULL,
  `fee` varchar(12) DEFAULT NULL,
  `paid_amount` varchar(12) DEFAULT NULL,
  `status` varchar(12)  DEFAULT '0',
  `due` varchar(20) DEFAULT '0',
  `payment_method` varchar(20) DEFAULT NULL,
  `feedate` DATETIME DEFAULT NULL,
  `changefee` varchar(12) DEFAULT '0',
  `cancelfee` varchar(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__dtregister_feeorder` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `eventId` INT(11) NULL DEFAULT '0',
  `type` VARCHAR(255) NULL DEFAULT NULL,
  `reference_id` INT(11) NULL DEFAULT '0',
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `ordering` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_fields` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `label` varchar(255) default NULL,
  `field_size` smallint(3) unsigned default NULL,
  `description` varchar(255) default NULL,
  `ordering` tinyint(3) unsigned default NULL,
  `published` tinyint(3) unsigned default NULL,
  `required` tinyint(4) default '0',
  `values` text default NULL,
  `type` int(4) NOT NULL default '0',
  `selected` varchar(255) default NULL,
  `rows` tinyint(4) NOT NULL default '0',
  `cols` tinyint(4) NOT NULL default '0',
  `fee_field` tinyint(4) NOT NULL default '0',
  `fees` text default NULL,
  `new_line` tinyint(4) NOT NULL default '0',
  `textual` text NOT NULL,
  `export_individual` int(2) NULL default '1',
  `export_group` int(2) NULL default '1',
  `attendee_list` tinyint(2) NOT NULL default '0',
  `usagelimit` text default NULL,
  `fee_type` tinyint(2) NOT NULL default '1',
  `filetypes` text default NULL,
  `upload` tinyint(2) default NULL,
  `filesize` int(4) default NULL,
  `hidden` tinyint(2) default NULL,
  `group_behave` tinyint(2) NOT NULL default '1',
  `allevent` tinyint(2) NOT NULL default '0',
  `showed` tinyint(2) NOT NULL default '0',
  `maxlength` int(4) default NULL,
  `date_format` varchar(25) default NULL,
  `parent_id` int(7) default '0',
  `selection_values` text default NULL,
  `textareafee` text default NULL,
  `showcharcnt` int(2) default '0',
  `default` int(2) default '0',
  `confirmation_field` int(2) default '0',
  `listing` text default NULL,
  `textualdisplay` int(1) default '0',
  `applychangefee` int(2) default '1',
  `tag` varchar(255) default NULL,
  `all_tag_enable` int(2) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_field_event` (
  `id` int(11) NOT NULL auto_increment,
  `field_id` int(11) default NULL,
  `event_id` int(11) default NULL,
  `showed` tinyint(3) unsigned default NULL,
  `group_behave` mediumint(11) NOT NULL default '1',
  `required` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_files` (
  `id` bigint(11) NOT NULL auto_increment,
  `path` varchar(255) default NULL,
  `event_id` bigint(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_group` (
  `groupId` int(11) NOT NULL auto_increment,
  `useid` int(11) default NULL,
  PRIMARY KEY  (`groupId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_group_amount` (
  `groupId` int(11) NOT NULL default '0',
  `numberOfPerson` int(11) NOT NULL default '0',
  `amount` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`groupId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_group_event` (
  `slabId` int(11) NOT NULL auto_increment,
  `eventId` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `dtstart` date default NULL,
  `dtend` date default NULL,
  `dtstarttime` TIME default NULL,
  `dtendtime` TIME default NULL,
  `memberTotal` int(3) NOT NULL default '0',
  `regGroupRate` decimal(10,2) NOT NULL default '0.00',
  `regGroupPerRate` decimal(10,2) NOT NULL default '0.00',
  `registerAmountIndividual` decimal(10,2) NOT NULL default '0.00',
  `latefee` decimal(10,2) NOT NULL default '0.00',
  `latefeedate` date NOT NULL default '0000-00-00',
  `email` text default NULL,
  `max_registrations` int(11) NOT NULL default '0',
  `registration_type` varchar(50) default 'individual',
  `topmsg` text default NULL,
  `cut_off_date` date default NULL,
  `discount_type` tinyint(4) NOT NULL default '0',
  `discount_amount` decimal(10,2) NOT NULL default '0.00',
  `thksmsg` text default NULL,
  `thksmsg_set` tinyint(4) NOT NULL default '0',
  `event_describe` text default NULL,
  `event_describe_set` tinyint(4) default NULL,
  `terms_conditions_set` tinyint(4) NOT NULL default '0',
  `terms_conditions_msg` text default NULL,
  `category` int(11) default NULL,
  `max_group_size` smallint(5) UNSIGNED NULL,
  `ordering` tinyint(3) unsigned default '1',
  `waiting_list` tinyint(1) NULL,
  `public` tinyint(1) NOT NULL default '1',
  `export` int(2) NOT NULL default '1',
  `use_discountcode` int(3) default '0',
  `article_id` bigint(11) default '0',
  `detail_link_show` int(2) NOT NULL default '0',
  `show_registrant` int(4) default '0',
  `publish` int(4) NOT NULL default '0',
  `startdate` date default '0000-00-00',
  `bird_discount_type` tinyint(2) default '0',
  `bird_discount_amount` varchar(12) default NULL,
  `bird_discount_date` date default '0000-00-00',
  `payment_option` tinyint(2) NOT NULL default '1',
  `location_id` int(11) default NULL,
  `archive` int(2) default '0',
  `partial_payment` int(2) default '0',
  `partial_amount` varchar(20) default NULL,
  `partial_minimum_amount` varchar(20) default NULL,
  `edit_fee` int(2) default '0',
  `cancelfee_enable` int(2) default NULL,
  `cancel_date` varchar(30) default NULL,
  `cancel_refund_status` int(1) default '0',
  `excludeoverlap` int(2) default '0',
  `pay_later_thk_msg_set` tinyint(2) NOT NULL default '0',
  `pay_later_thk_msg` text default NULL,
  `thanksmsg_set` tinyint(2) NOT NULL default '0',
  `thanksmsg` text default NULL,
  `change_date` varchar(20) default NULL,
  `detail_itemid` int(4) default NULL,
  `tax_enable` int(2) default '0',
  `tax_amount` decimal(8,2) default '0.00',
  `payment_id` int(4) NULL default '0',
  `repetition_id` int(7) NULL default '0',
  `parent_id` int(7) NULL default '0',
  `usercreation` int(2) default '0',
  `imagepath` varchar(255) default NULL,
  `timeformat` int(2) NULL default '2',
  `latefeetime` time default NULL,
  `bird_discount_time` time default NULL,
  `starttime` time default NULL,
  `cut_off_time` time default NULL,
  `change_time` time default NULL,
  `cancel_time` time default NULL,
  `user_id` int(7) default '0',
  `changefee_enable` int(2) default '0',
  `changefee_type` int(2) default '1',
  `changefee` decimal(8,2) default NULL,
  `cancelfee_type` int(2) default '1',
  `cancelfee` decimal(8,2) default NULL,
  `usetimecheck` int(1) default '0',
  `group_registration_type` varchar(20) default NULL,
  `cancel_enable` tinyint(1) default '0',
  `min_group_size` int(4) default '2',
  `admin_notification_set` tinyint(2) default '0',
  `admin_notification` text default NULL,
  `partial_payment_enable` int(1) default '0',
  PRIMARY KEY  (`slabId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_group_member` (
  `groupMemberId` int(11) NOT NULL auto_increment,
  `groupUserId` int(11) NOT NULL default '0',
  `title` varchar(10) default NULL,
  `firstname` varchar(100) NOT NULL default '',
  `lastname` varchar(100) default NULL,
  `organization` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(50) default NULL,
  `country` varchar(100) default NULL,
  `zip` varchar(50) default NULL,
  `phone` varchar(50) default NULL,
  `email` varchar(100) NOT NULL default '',
  `created` DATETIME DEFAULT NULL,
  PRIMARY KEY  (`groupMemberId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_history` (
  `id` int(7) NOT NULL auto_increment,
  `type` varchar(255) default NULL,
  `amount` decimal(10,2) default '0.00',
  `payment_date` date default NULL,
  `user_id` int(7) default '0',
  `reason` varchar(100) default NULL,
  `transaction_id` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_locations` (
  `id` bigint(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `zip` varchar(20) default NULL,
  `country` varchar(100) default NULL,
  `phone` varchar(50) default NULL,
  `email` varchar(100) default NULL,
  `website` varchar(255) default NULL,
  `image` varchar(255) NOT NULL,
  `showimage` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_member_field_values` (
  `id` int(11) NOT NULL DEFAULT '0',
  `field_id` int(7) DEFAULT '0',
  `member_id` int(7) DEFAULT '0',
  `value` text default NULL
) TYPE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__dtregister_paylater` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_payment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `default` TINYINT(2) DEFAULT '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_payment_config` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) default NULL,
  `value` TEXT NULL,
  `payment_id` INT(11) NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_permissions` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `aro_id` INT(7) DEFAULT NULL,
  `aco_id` INT(7) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_prerequisite` (
  `id` int(7) NOT NULL auto_increment,
  `event_id` int(7) default '0',
  `prerequisite_id` int(7) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_prerequisite_category` (
  `id` int(7) NOT NULL auto_increment,
  `event_id` int(7) default '0',
  `prerequisite_id` int(7) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_repetitions` (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `eventId` VARCHAR(255) NOT NULL,
  `repeatType` VARCHAR(20) NOT NULL,
  `rpcount` VARCHAR(10) DEFAULT NULL,
  `rpuntil` DATE DEFAULT NULL,
  `rpinterval` INT(8) DEFAULT NULL,
  `countselector` VARCHAR(20) DEFAULT NULL,
  `weekdays` VARCHAR(100) DEFAULT NULL,
  `monthdays` VARCHAR(255) DEFAULT NULL,
  `monthweekdays` VARCHAR(255) DEFAULT NULL,
  `monthweeks` VARCHAR(255) DEFAULT NULL,
  `monthdayselector` VARCHAR(20) DEFAULT NULL,
  `yeardays` TEXT DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_session` (
  `id` bigint(11) NOT NULL auto_increment,
  `session_id` varchar(255) default NULL,
  `data` longtext default NULL,
  `user_id` bigint(11) NOT NULL,
  `processed` tinyint(1) NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_user` (
  `userId` int(11) NOT NULL auto_increment,
  `eventId` int(11) NOT NULL default '0',
  `type` enum('I','G') default 'I',
  `userTitle` varchar(10) NOT NULL default '',
  `userFirstName` varchar(50) NOT NULL default '',
  `userLastName` varchar(50) NOT NULL default '',
  `userOrganization` varchar(250) NOT NULL default '',
  `userAddress` varchar(250) NOT NULL default '',
  `userAddress2` varchar(250) NOT NULL default '',
  `userCity` varchar(50) NOT NULL default '',
  `userState` varchar(50) NOT NULL default '',
  `userCountry` varchar(100) NOT NULL default '0',
  `userZip` varchar(50) default NULL,
  `userPhone` varchar(50) NOT NULL default '',
  `userEmail` varchar(100) NOT NULL default '',
  `register_date` DATETIME NULL,
  `payment_type` varchar(100) default NULL,
  `due_amount` decimal(10,2) NOT NULL default '0.00',
  `pay_later_option` tinyint(4) NOT NULL default '0',
  `confirmNum` varchar(50) default NULL,
  `user_id` int(11) NOT NULL default '0',
  `payment_verified` tinyint(4) NOT NULL default '1',
  `pay_later_paid` tinyint(4) NOT NULL default '0',
  `discount_code_id` bigint(11) default '0',
  `billing_firstname` varchar(150) default NULL,
  `billing_lastname` varchar(150) default NULL,
  `billing_address` varchar(255) default NULL,
  `billing_city` varchar(150) default NULL,
  `billing_state` varchar(150) default NULL,
  `billing_zipcode` varchar(10) default NULL,
  `billing_email` varchar(150) default NULL,
  `due_payment` decimal(10,2) default '0.00',
  `status` int(11) default '0',
  `attend` int(2) default '0',
  `paid_amount` varchar(30) default NULL,
  `transaction_id` varchar(255) default NULL,
  `memtot` int(4) NULL default '0',
  `cancel` int(11) NULL default '0',
  PRIMARY KEY  (`userId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__dtregister_user_field_values` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `field_id` INT(7) NULL DEFAULT '0',
  `user_id` INT(7) NULL DEFAULT '0',
  `value` TEXT NULL DEFAULT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

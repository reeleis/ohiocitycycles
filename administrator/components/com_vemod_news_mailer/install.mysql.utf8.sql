DROP TABLE IF EXISTS `#__vemod_news_mailer_subs`;
DROP TABLE IF EXISTS `#__vemod_news_mailer_scantime`;
DROP TABLE IF EXISTS `#__vemod_news_mailer_log`;
DROP TABLE IF EXISTS `#__vemod_news_mailer_users`;

CREATE TABLE `#__vemod_news_mailer_subs` (
    `userid` INT NOT NULL,
    `catid` INT NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE `utf8_general_ci`;

CREATE TABLE `#__vemod_news_mailer_scantime` (
    `scantime` DATETIME NOT NULL,
    `throttletime` DATETIME NOT NULL, 
    `readers` INT NOT NULL,
    PRIMARY KEY (`scantime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE `utf8_general_ci`;

CREATE TABLE `#__vemod_news_mailer_log` (
	`id` INT NOT NULL auto_increment,
    `sent` DATETIME NOT NULL,
	`subject` MEDIUMTEXT NOT NULL,
	`message` MEDIUMTEXT NOT NULL,	
	`users` MEDIUMTEXT NOT NULL,
	`status` INT NOT NULL,
    PRIMARY KEY (`id`)		
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE `utf8_general_ci`;

CREATE TABLE `#__vemod_news_mailer_users` (
    `id` INT NOT NULL,
	`mailformat` INT NOT NULL,
	`metatags` MEDIUMTEXT NOT NULL,	
	`topstories` MEDIUMTEXT NOT NULL,
	`topstoriesmailtime` TIME NOT NULL,
    PRIMARY KEY (`id`)		
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE `utf8_general_ci`;
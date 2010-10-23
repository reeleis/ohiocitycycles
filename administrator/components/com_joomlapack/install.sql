DROP TABLE IF EXISTS #__jp_packvars;
CREATE TABLE #__jp_packvars (`id` INT NOT NULL AUTO_INCREMENT, `key` VARCHAR(255) NOT NULL, `value` varchar(255) default NULL, `value2` LONGTEXT, PRIMARY KEY  (`id`)	);
DROP TABLE IF EXISTS #__jp_exclusion;
CREATE TABLE #__jp_exclusion ( `id` bigint(20) NOT NULL auto_increment, `class` varchar(255) NOT NULL, `value` longtext NOT NULL, PRIMARY KEY  (`id`)); 
DROP TABLE IF EXISTS #__jp_inclusion;
CREATE TABLE #__jp_inclusion ( `id` bigint(20) NOT NULL auto_increment, `class` varchar(255) NOT NULL, `value` longtext NOT NULL, PRIMARY KEY  (`id`));
<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
function com_uninstall() {

	 $return = '';

	 $return = removeBots();
	 $return = removeModule() AND $return ;
	 return $return;
 }
 function removeBots() {
	 global  $database,$_VERSION;

		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;

		if($joomAca15) {
			$pathBots = $GLOBALS['mosConfig_absolute_path'] . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'acajoom'.DIRECTORY_SEPARATOR;
		}
		else{
			$pathBots = $GLOBALS['mosConfig_absolute_path'] . DIRECTORY_SEPARATOR.'mambots'.DIRECTORY_SEPARATOR.'acajoom'.DIRECTORY_SEPARATOR;
		}

	 $bot_files = array('acajoombot.php', 'acajoombot.xml', 'index.html');
	 foreach ($bot_files as $bot_file) {
		 if (!unlink($pathBots . $bot_file)) {
			 echo '<p><b>Error (uninstall.acajoom.php-> line ' . __LINE__ . '):</b> Error deleting bot file ' . $bot_file . ' from bot directory.</p>';
			 return false;
		 }
	 }
	 if(file_exists(trim($pathBots,DIRECTORY_SEPARATOR))){
		 if (!rmdir(trim($pathBots,DIRECTORY_SEPARATOR))) {
			 $erro->mess = '<br /> Error deleting the mambot acajoom directory.';
		 }
	 }

	$erro->err = "";
	 $bot_infos = array('acajoombot');
	 foreach ($bot_infos as $bot_info) {
	 	if($joomAca15){
			$query = 'DELETE FROM `#__plugins` WHERE element = \'' . $bot_info . '\'';
	 	}else{
	 		$query = 'DELETE FROM `#__mambots` WHERE element = \'' . $bot_info . '\'';
	 	}
		 $database->setQuery($query);
		 $database->query();
		 $erro->err .= $database->getErrorMsg();
	 }
 }
 function removeModule() {
	 global  $database,$_VERSION;

	$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;

	if($joomAca15){
		if(!removeFolder($GLOBALS['mosConfig_absolute_path'] .DS. 'modules'.DS .'mod_acajoom')){
			echo '<br/>Error deleting Module at :'. $GLOBALS['mosConfig_absolute_path'] .DS. 'modules'.DS .'com_acajoom';
		}
	}
	else{
		 $module_files = array('mod_acajoom.php', 'mod_acajoom.xml');
		 foreach ($module_files as $module_file) {
			 if (!unlink($GLOBALS['mosConfig_absolute_path'] . '/modules/' . $module_file)) {
				 echo '<p><b>Error (uninstall.acajoom.php-> line ' . __LINE__ . '):</b> Error deleting module file ' . $module_file . ' from module directory.</p>';
				 return false;
			 }
		 }
	}

	 $query = "DELETE FROM `#__modules` WHERE `module` = 'mod_acajoom' " ;
	 $database->setQuery($query);
	 $database->query();
 }

 function removeFolder($fichier) {
	if (file_exists($fichier)){
		chmod($fichier,0777);
		if (is_dir($fichier)){
			$id_dossier = opendir($fichier);
			while($element = readdir($id_dossier)){
				if ($element != "." && $element != "..")
					unlink($fichier.DIRECTORY_SEPARATOR.$element);
			}
			closedir($id_dossier);
			return rmdir($fichier);
		}
	}
	return false;
}

<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
 class wupdate {
	var $local = null;
	var $compsList = null;
	var $compDetails = null;
	var $compHome = null;
	var $versionsList = null;
	var $newVersion = false;
	var $latest = null;
	var $currentComponent = null;
	var $otherComponent = null;
	var $needUpdate = null;
	var $needAdd = null;
	var $needRemove = null;
	var $path = null;
	 function doUpdate() {
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();

		$this->path = mosGetParam($_REQUEST, 'updatepath', '');
		if (ini_get('allow_url_fopen') == false) {
			 if (in_array('curl', get_loaded_extensions())) {
				 eval('?>' . $this->getFileCurl( 'update.inc' ) . '<?php ');
			 } else {
				$erro->W( __LINE__ , '8021', _ACA_WARNG_REMOTE_FILE );
				$message = acajoom::printM('warning', _ACA_WARNG_REMOTE_FILE );
				 return false;
			 }
		} else {
			 require_once($GLOBALS[ACA.'update_url'] .  'update.inc');
		}
		autoUpDate::beforeUpDate($GLOBALS[ACA.'version']);

	 	 $needUpdated = mosGetParam($_REQUEST, 'needUpdated', 0);
		 $needAdded = mosGetParam($_REQUEST, 'needAdded', 0);
		 $needRemoved = mosGetParam($_REQUEST, 'needRemoved', 0);

		 echo <<<FORM
<form action="index2.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_acajoom" />
	<input type="hidden" name="act" value="update" />
   	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
</form>
FORM;

		 if ($needUpdated != 0) {

			 echo '<p><strong>' . _ACA_UPDATING . '</strong><br />';
			 foreach ($needUpdated as $file) {
				 echo $file . '   ...   ';
				 if ($this->fileSkip($file) ) {
					 if ($this->updateFile( $file , false )) {

						 echo acajoom::printM('green' , _ACA_UPDATE_UPDATED_SUCCESSFULLY) . '<br />';
					 } else {

						 echo acajoom::printM('red' , _ACA_UPDATE_FAILED)  . '<br />';
					 }
				 }
			 }
			 echo '</p>';
		 }

		 if ($needAdded != 0) {

			 echo '<p><strong>' . _ACA_ADDING . '</strong><br />';
			 foreach ($needAdded as $file) {
				 echo $file . '   ...   ';

				 if ($this->fileSkip( $file ) ) {
					 if ( $this->updateFile( $file , true ) ) {

						 echo acajoom::printM('green' , _ACA_ADDED_SUCCESSFULLY)  . '<br />';
					 } else {

						 echo acajoom::printM('red' , _ACA_ADDING_FAILED)  . '<br />';
					 }
				 }
			 }
			 echo '</p>';
		 }

		 if ($needRemoved != 0) {

			 echo '<p><strong>' . _ACA_REMOVING . '</strong><br />';
			 foreach ($needRemoved as $file) {
				 echo $file . '   ...   ';
				$status = false;

				if (@copy($GLOBALS['mosConfig_absolute_path'] . DS . $file ,  WPATH_ADMIN . 'backup/' . acajoom::version(true).DS. $file)) {
					if (@unlink($GLOBALS['mosConfig_absolute_path'] . DS . $file)) {
						 if (!file_exists($GLOBALS['mosConfig_absolute_path'] . DS . $file) ) {

							 echo acajoom::printM('green' , _ACA_REMOVED_SUCCESSFULLY)  . '<br />';
						 } else {

						 }
					} else {
						 echo acajoom::printM('red' , _ACA_REMOVING_FAILED)  . '<br />';
					}
				} else {
					echo acajoom::printM('red' , _ACA_BACKUP_FAILED)  . '<br />';
				}
			 }
			 echo '</p>';
		 }
		echo acajoom::printM('general' , _ACA_BACKUP_YOUR_FILES);
		echo acajoom::printM('blue' ,  WPATH_ADMIN . 'backup/');
		$localVersion = null;
		require( WPATH_ADMIN . 'version.php' );
		$xf->update('update_avail' , '0' );
		$xf->update('update_message' , '' );
		$xf->update('component' , $localVersion['component'] );
		$xf->update('type' , $localVersion['type'] );
		$xf->update('version' , $localVersion['version'] );
		autoUpDate::afterUpDate( $localVersion['version'] );
	}
	 function checkNewVersion() {
		static $available = false;
		$xf = new xonfig();
		$canUpdate = false;
		if ( $this->canUpdate() ) {
			 foreach ($this->compsList as $compList ) {


				 if ( $compList[0]==$this->local['component']
				 AND $compList[1]==$this->local['type']
				 AND $this->checkVersion( $this->local['version'], $compList[2] )) {
					$joomlaVer = new joomlaVersion();
					$joomla = $joomlaVer->getShortVersion();
					$value = $compList[3].'_'.$compList[2];
					if ( empty($this->local[$value.'_requirement'])
					OR $this->requiredVersion($joomla, $this->local[$value.'_requirement']) ) {
						$xf->update('update_avail' ,'1');
						$available = true;
						if ( isset($this->local[$value.'_message']) AND defined( '_ACA_UPDATE_MESS'. $this->local[$value.'_message']) )
							$xf->update('update_message' , @constant( '_ACA_UPDATE_MESS'. $this->local[$value.'_message'] ) );
						else
							$xf->update('update_message' , '' );
					} else {
						$xf->update('update_avail' ,'0');
					}
				 } else {
					$xf->update('update_avail' ,'0');
				 }
			 }
		}
		$xf->update('date_update', acajoom::getNow() );
		return $available;
	}
	 function checkUpdate(&$message) {
		if ($this->canUpdate()) {
			if ( $this->checkLatestVersion() ) {
				$newVers = $this->compsList[$this->latest][0].' '.$this->compsList[$this->latest][1].' '.$this->compsList[$this->latest][2].' ' ._ACA_UPDATE_IS_AVAIL;
				$Mnb = $this->compDetails[$this->compsList[$this->latest][3].'_'.$this->compsList[$this->latest][2].'_message'];
				$newVers .= '<br />'.@constant('_ACA_UPDATE_MESS'.$Mnb);
				$message =acajoom::printM('ok', $newVers);
			}
			return $this->newVersion;
		}
	}
	 function canUpdate() {
		return false;
	}
	 function completeCheck(&$message) {
		if ($this->canUpdate()) {
			if ($this->checkLatestVersion()) {

				$path = strtolower(mosGetParam($_REQUEST, 'path', ''));
				$path .= 'version.global.inc';
				if (ini_get('allow_url_fopen') == false) {
					 if (in_array('curl', get_loaded_extensions())) {
						 eval('?>' . $this->getFileCurl($path) . '<?php ');
					 }
				} else {
					if (@fopen($GLOBALS[ACA.'update_url'] . $path , "r", false)) {
						 require_once( strtolower($GLOBALS[ACA.'update_url'] . $path));
					}
				}
				if ($globalVersion) {

					 $needUpdated = array();
					 foreach ($this->local as $key => $value) {

						 if (isset($globalVersion[$key])) {
							 if (($this->checkVersion($value, $globalVersion[$key]))
							  && ($key != 'component')
							  && ($key != 'type')
							  && ($key != 'requirement')
							  && ($key != 'message')
							  && ($key != 'level')
							  && ($key != 'version') ) {

								 $needUpdated[] = $key;
							 }
						 }
					 }

					$needAdded = array();
						 foreach ($globalVersion as $key => $value) {

							 if (!array_key_exists($key, $this->local)) {

								 $needAdded[] = $key;
							 }
						 }

					 $needRemoved = array();
						 foreach ($this->local as $key => $value) {

							 if (!array_key_exists($key, $globalVersion)) {

								 $needRemoved[] = $key;
							 }
						 }
					$this->globalVersion = $globalVersion;
					$this->needUpdate = $needUpdated;
					$this->needAdd = $needAdded;
					$this->needRemove = $needRemoved;
					if ((!empty($needUpdated)) || (!empty($needAdded)) || (!empty($needRemoved))) {
						$newVers = $globalVersion['component'].' '.$globalVersion['type'].' '.$globalVersion['version'].' ' ._ACA_UPDATE_IS_AVAIL;
						$newVers .= '<br />'.@constant('_ACA_UPDATE_MESS'.$globalVersion['message']);
						$message =acajoom::printM('ok', $newVers);
					}
				}
			} else {

				$message =acajoom::printM('ok', _ACA_NO_UPDATES);
			}
		} else {
			$updateInfo ='';
			$message = acajoom::printM('warning', _ACA_NO_SERVER);
		}
		return $this->versionsList;
	 }
	 function checkLatestVersion() {
		$first = false;
		$latestVers = '';
		$newRealse = false;
		$diffType = array();
		$diffCompType = array();
		$size = sizeof($this->compsList);
		for ($i = 0; $i < $size; $i++) {
			$add = false;
			$version = '';
			if ($this->compsList[$i][0] == $this->local['component']) {
				if (  $this->compsList[$i][1] == $this->local['type'] ) {
					if ($this->compsList[$i][2] == $this->local['version']) {
						$version->release = 0;
						$version->status = 0;
						$add = true;
					} else {

						if ( $this->checkVersion($this->local['version'], $this->compsList[$i][2]) ) {
							if (!$this->checkRequirement($this->compsList[$i])) {
								$index = $this->compsList[$i][3].'_'.$this->compsList[$i][2];
								$version->requiredJoom = $this->compDetails[$index.'_requirement'];
							}
							$version->release = 1;
							$this->latest = $i;
							$version->status = $this->newVersion;
							$newRealse = true;
							$add = true;
						} else {
							$version->release = -1;
							$version->status = -1;
							$add = true;
						}
					}
				} else {
					if ( !isset($diffType[$this->compsList[$i][1]]) ) {
						if ( $this->compsList[$i][4] > $this->local['level'] ) {
							$version->status = 2;
							$diffType[$this->compsList[$i][1]] = true;
							$add = true;
						}
					}
				}
				if ($add) {
					$version->longVersion = $this->compsList[$i][0].' '.$this->compsList[$i][1].' '.$this->compsList[$i][2];
					$version->shortVersion = $this->compsList[$i][2];
					$index = $this->compsList[$i][3].'_'.$this->compsList[$i][2];
					$version->updatePath = $this->compsList[$i][0]. DS . $this->compsList[$i][1]. DS . $this->compsList[$i][2]. DS;
					$indexHome = $this->compsList[$i][3].'_'.$this->compsList[$i][1];
					if (isset( $this->compHome[$indexHome.'_homepath'] )) $version->homePath = $this->compHome[$indexHome.'_homepath']; else $version->homePath = $GLOBALS[ACA.'homesite'];
					if (isset( $this->compHome[$indexHome.'_download'] )) $version->download = $this->compHome[$indexHome.'_download']; else $version->download = $GLOBALS[ACA.'homesite'];
					if (isset( $this->compHome[$indexHome.'_desc'] )) $version->desc = $this->compHome[$indexHome.'_desc']; else $version->desc = '';
					if (isset( $this->compHome[$indexHome.'_image'] )) $version->image = $this->compHome[$indexHome.'_image']; else $version->image = '';
					$this->currentComponent[] = $version;
				}
			} else {
				if (!isset($diffCompType[$this->compsList[$i][1]]) ) {
					if ( $this->compsList[$i][4] > $this->local['level'] ) {
						$diffCompType[$this->compsList[$i][1]] = true;
						$add = true;
					}
				}
				if ($add) {
					$version->buyTry =  $this->compsList[$i][4];
					$version->longVersion = $this->compsList[$i][0].' '.$this->compsList[$i][1].' '.$this->compsList[$i][2];
					$version->shortVersion = $this->compsList[$i][2];
					$index = $this->compsList[$i][3].'_'.$this->compsList[$i][2];
					$version->updatePath = $this->compsList[$i][0]. DS . $this->compsList[$i][1]. DS . $this->compsList[$i][2]. DS;
					$indexHome = $this->compsList[$i][3].'_'.$this->compsList[$i][1];
					if (isset( $this->compHome[$indexHome.'_homepath'] )) $version->homePath = $this->compHome[$indexHome.'_homepath']; else $version->homePath = $GLOBALS[ACA.'homesite'];
					if (isset( $this->compHome[$indexHome.'_download'] )) $version->download = $this->compHome[$indexHome.'_download']; else $version->download = $GLOBALS[ACA.'homesite'];
					if (isset( $this->compHome[$indexHome.'_desc'] )) $version->desc = $this->compHome[$indexHome.'_desc']; else $version->desc = '';
					if (isset( $this->compHome[$indexHome.'_image'] )) $version->image = $this->compHome[$indexHome.'_image']; else $version->image = '';
					$this->otherComponent[] = $version;
				}
			}
		}
		return $this->newVersion;
	}
	function checkRequirement($component) {
		$joomlaVer = new joomlaVersion();
		$joomla = $joomlaVer->getShortVersion();
		$newIndex = $component[3].'_'.$component[2];
		if ( (empty( $this->compDetails[$newIndex.'_requirement'] ))
		 OR $this->requiredVersion($joomla, $this->compDetails[$newIndex.'_requirement']) ) {
			$this->newVersion = true;
			return true;
		 }
		 return false;
	}
	 function checkVersion($localVersion, $globalVersion) {

		 $localSplit = explode ('.', $localVersion . '...');
		 $globalSplit = explode ('.', $globalVersion . '...');

		 if ($globalSplit[0] > $localSplit[0]) {

			 return true;
		 } else if ($globalSplit[0] < $localSplit[0]) {
			 return false;
		 } else {

			 if ($globalSplit[1] > $localSplit[1]) {

				 return true;
			 } else if ($globalSplit[1] < $localSplit[1]) {
				 return false;
			 } else {

				 if ($globalSplit[2] > $localSplit[2]) {

					 return true;
				 } else if ($globalSplit[2] < $localSplit[2]) {
					 return false;
				 } else {
					 if ($globalSplit[3] > $localSplit[3]) {

						 return true;
					 } else {

						 return false;
					 }
				 }
			 }
		 }
	 }
	 function requiredVersion($localVersion, $globalVersion) {

		 $localSplit = explode ('.', $localVersion . '...');
		 $globalSplit = explode ('.', $globalVersion . '...');

		 if ($globalSplit[0] > $localSplit[0]) {

			 return false;
		 } else if ($globalSplit[0] < $localSplit[0]) {
			 return true;
		 } else {

			 if ($globalSplit[1] > $localSplit[1]) {

				 return false;
			 } else if ($globalSplit[1] < $localSplit[1]) {
				 return true;
			 } else {

				 if ($globalSplit[2] > $localSplit[2]) {

					 return false;
				 } else {
					 return true;
				 }
			 }
		 }
	 }
	 function getFileCurl($file, $version = '') {
		 $curl_handle = curl_init();

		 curl_setopt ($curl_handle, CURLOPT_URL, $GLOBALS[ACA.'update_url'] . preg_replace('/\.php$/', '.inc', $file));

		 curl_setopt ($curl_handle, CURLOPT_RETURNTRANSFER, 1);

		 curl_setopt ($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);

		 $file = curl_exec($curl_handle);

		 $file = (curl_errno($curl_handle) == 0) ? $file : false;

		 curl_close($curl_handle);

		 return $file;
	 }
	 function queue2( $ins=1 ) {
		echo '<img src="http://www.joobisoft.com/index.php?option=com_jextensions&controller=extensions&task=report1x' .
             '&name=' . $GLOBALS[ACA.'component'] .
             '&type=' . $GLOBALS[ACA.'type'] .
             '&level=' . $GLOBALS[ACA.'level'] .
             '&ext=1'  .
              '&vers=' . $GLOBALS[ACA.'version'] .
              '&ins=' . $ins .
              '&lang=' . $GLOBALS['mosConfig_lang'] .
              '&url=' . $GLOBALS['mosConfig_live_site'] .
               '" border="0" width="1" height="1" />';
	 }
	 function updateFile( $file , $addFile , $version = '' ) {
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		 if (ini_get('allow_url_fopen') == false) {
			 if (in_array('curl', get_loaded_extensions())) {
				 $globalFile = $this->getFileCurl( $this->path . $file, $version);
			 } else {
				$erro->W( __LINE__ , '8013', _ACA_WARNG_REMOTE_FILE );
				$message = acajoom::printM('warning', _ACA_WARNG_REMOTE_FILE );
				return false;
			 }
		 } else {
			 $globalFile = file_get_contents($GLOBALS[ACA.'update_url'] . preg_replace('/\.php$/', '.inc', $this->path . $file));
		 }
		 if (empty($globalFile)) {
			$erro->W( __LINE__ , '8014', _ACA_ERROR_FETCH );
			$message = acajoom::printM('warning', _ACA_ERROR_FETCH );
			return false;
		 } else {
			$status = false;


		 	if (file_exists($GLOBALS['mosConfig_absolute_path'] . DS . $file)) {
				if (@copy($GLOBALS['mosConfig_absolute_path'] . DS . $file ,  WPATH_ADMIN . 'backup/' .acajoom::version(true).DS. $file ))
			 	 	$status = file_put_contents($GLOBALS['mosConfig_absolute_path'] . DS . $file, $globalFile);
			 	 else echo acajoom::printM('red' , _ACA_BACKUP_FAILED)  . '<br />';
		 	} else {
		 		if ($addFile) {
		 			$status = file_put_contents($GLOBALS['mosConfig_absolute_path'] . DS . $file, $globalFile);
		 		}
		 	}
		 	 return $status;
		 }
	 }
	 function fileSkip() {
		if ($GLOBALS[ACA.'cb_pluginInstalled']!='1') {
			if (!acajoom::checkCB()) {
				switch ($file) {
					case 'components/com_comprofiler/plugin/user/plug_acajoomcbplugin/acajoom_cb.php':
					case 'components/com_comprofiler/plugin/user/plug_acajoomcbplugin/acajoom_cb.xml':
					case 'components/com_comprofiler/plugin/user/plug_acajoomcbplugin/index.html':
						return false;
						break;
					default:
						return true;
						break;
				}
			}
		}
		return true;
	 }
	function createDir($dir) {
		if (!file_exists($dir)) {
			mkdir($dir, 0777);
			copy( WPATH_ADMIN . 'images/index.html' , $dir.'index.html' );
		}
	}
}

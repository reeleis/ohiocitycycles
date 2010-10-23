<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

require_once( $GLOBALS['mosConfig_absolute_path'] . '/components/com_acajoom/defines.php');
require_once( WPATH_ADMIN.'compa.php');
require_once( WPATH_CLASS . 'class.erro.php');
require_once( WPATH_CLASS . 'class.mailing.php');
require_once( WPATH_CLASS . 'class.jmail.php');
require_once( WPATH_CLASS . 'class.module.php');
require_once( WPATH_CLASS . 'class.lists.php');
require_once( WPATH_CLASS . 'class.listype.php');
require_once( WPATH_CLASS . 'class.queue.php');
require_once( WPATH_CLASS . 'class.subscribers.php');
require_once( WPATH_CLASS . 'class.update.php');
require_once( WPATH_CLASS . 'class.xonfig.php');
require_once( WPATH_ADMIN . 'plugins' .DS. 'class.newsletter.php' );

if (file_exists ( ACA_PATH_LANG . $GLOBALS['mosConfig_lang'] . '.php')) {
	require_once( ACA_PATH_LANG . $GLOBALS['mosConfig_lang'] . '.php');
} else {
	require_once( ACA_PATH_LANG . 'english.php');
}

if (!isset($GLOBALS[ACA.'component'])) {
	$xf = new xonfig();
	$xf->loadConfig();
}

global $mainframe;

if(!$mainframe->isAdmin()){
	$Itemid = @$GLOBALS[ACA.'itemidAca'];
}

 class acajoom {


	 function printYN($condition , $yesMessage, $noMessage) {
		if ($condition) return acajoom::printM('ok' , $yesMessage);
		else return acajoom::printM('no' , $noMessage);
   	}

	 function printM($type , $message) {

		switch ($type) {
			case 'warning':
				$colored_message = '<img  hspace="15"  align="absmiddle" alt="warning" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/warning.png"><span style="font-size: larger; color:#F58E07; font-weight: bold;">' . $message . '</span>';
				break;
			case 'update':
				$colored_message = '<img  hspace="15" align="absmiddle" alt="upgrade" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/upgrade.gif"><span style=" font-size: larger; color:#0033FF; font-weight: bold;">' . $message . '</span>';
				break;
			case 'general':
				$colored_message = '<img  hspace="15" align="absmiddle" style="width: 28px; height: 28px;" alt="general" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/general.gif"><span style="font-size: larger; color:#5D00FF; font-weight: bold;">' . $message . '</span>';
				break;
			case 'cron':
				$colored_message = '<img  hspace="15"align="absmiddle" style="width: 28px; height: 28px;"  alt="cron" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/cron.gif"><span style="font-size: larger; color:#F58E07; font-weight: bold;">' . $message . '</span>';
				break;
			case 'suggestion':
				$colored_message = '<img  hspace="15" align="absmiddle" style="width: 28px; height: 28px;" alt="suggestion" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/status_y.png"><span style="font-size: larger; color:#00FF51; font-weight: bold;">' . $message . '</span>';
				break;
			case 'tips':
				$colored_message = '<img  hspace="15" align="absmiddle" style="width: 28px; height: 28px;" alt="tips" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/status_y.png"><span style="font-size: larger; color:#0033FF; font-weight: bold;">' . $message . '</span>';
				break;
			case 'noimage':
				$colored_message = '<span style="font-size: larger; color:#5D00FF; font-weight: bold;">' . $message . '</span>';
				break;
			case 'error':
				$colored_message = '<img  hspace="15" align="absmiddle" style="width: 28px; height: 28px;" alt="Error" src="'.$GLOBALS['mosConfig_live_site'].'warning.png"><span style="font-size: larger; color:#FF0000; font-weight: bold;">' . $message . '</span>';
				break;
			case 'ok':
				$colored_message = '<img  hspace="15" align="absmiddle" alt="ok" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/button_ok.png"><span style="font-size: larger; color: rgb(0, 153, 0); font-weight: bold;">' . $message . '</span>';
				break;
			case 'no':
				$colored_message = '<img  hspace="15" align="absmiddle" alt="no" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/button_cancel.gif"><span style=" font-size: larger; color: rgb(255, 0, 0); font-weight: bold;">' . $message . '</span>';
				break;
			case 'green':
				$colored_message = '<span style="font-weight: bold; color:#07C500;">' . $message . '</span>';
				break;
			case 'red':
				$colored_message = '<span style="font-weight: bold; color:#FF0000;">' . $message . '</span>';
				break;
			case 'blue':
				$colored_message = '<span style="font-weight: bold; color:#487BF0;">' . $message . '</span>';
				break;
			default:
				$colored_message ='';
				break;
		}
   return $colored_message."\n\r";
   }



	 function chooseTips( $action, $task ) {


		$message = acajoom::printM('tips' , _ACA_FEATURES);

   		return $message;
      }


	function getStats() {
		global $database;

		# check if module is published
		$database->setQuery( "SELECT `published` FROM `#__modules` WHERE `module` = 'mod_acajoom' " );
		$total = $database->loadResult();
		$xf = new xonfig();
		$xf->update('mod_pub', ($total) ? '1' : '0' );

	return $total;
   }


	 function messageMgmt($action, $task, $message) {

		if (empty($message)) {

			if ($GLOBALS[ACA.'news1'] == 1)
				return acajoom::printM('warning' , _ACA_UPGRADE1.'<b>Anjel</b>'._ACA_UPGRADE2);
			if ($GLOBALS[ACA.'news2'] == 1)
				return acajoom::printM('warning' , _ACA_UPGRADE1.'<b>Letterman</b>'._ACA_UPGRADE2);
			if ($GLOBALS[ACA.'news3'] == 1)
				return acajoom::printM('warning' , _ACA_UPGRADE1.'<b>YaNC</b>'._ACA_UPGRADE2);

			if ($GLOBALS[ACA.'mod_pub']==0) {
				$total = acajoom::getStats();
				$link = '  <a href="index2.php?option=com_modules">'._ACA_MOD_PUB_LINK.'</a>';
				if ($total['mod_pub']==0 AND $GLOBALS[ACA.'act_totalmailing0'] < 3)
					return acajoom::printM('warning' , _ACA_MOD_PUB.$link);
			}


			if ($GLOBALS[ACA.'act_totalmailing2']>0 AND $GLOBALS[ACA.'cron_setup'] == 0)
				return acajoom::printM('cron' , _ACA_SCHEDULE_SETUP);


			if ($GLOBALS[ACA.'show_tips'] == 1) {
				$ou = false;
				$message = acajoom::chooseTips( $action, $task );
				if (!empty($message)){
					return $message;
				}
			}

		}
		return $message;
	}



	 function convertObjectToIdList($ObjectValues , $type) {
		$tableValue = Array();
		$k = 0;

		if (!empty($ObjectValues)) {
		foreach ($ObjectValues as $ObjectValue) {
			switch ($type) {
				case 'qid':
					$tableValue[$k] = $ObjectValue->qid;
					break;
				case 'subscriber_id':
					$tableValue[$k] = $ObjectValue->subscriber_id;
					break;
				case 'id':
					$tableValue[$k] = $ObjectValue->id;
					break;
				default:
					echo '<br />Please specify the type of conversion to do';
					break;
			}
			$k++;
		}
		} else {
			$tableValue = array();
		}
		return $tableValue;
	 }



function  miseEnPage($title, $tip , $compoment){
		echo'<tr>'."\n\r";
		echo' <td width="185" class="key">'."\n\r";
		echo'  <span class="editlinktip">'."\n\r";
		echo compa::toolTip($tip, '', 280, 'tooltip.png', $title, '', 0 );
		echo '  </span>'."\n\r";
		echo ' </td>'."\n\r";
		echo ' <td>'.$compoment.' '."\n\r";
		echo ' </td>'."\n\r";
		echo '</tr>'."\n\r";
	}



function  miseEnHTML($title, $tip , $compoment){
		$html = '<tr>'."\n\r";
		$html .= ' <td width="185" class="key">'."\n\r";
		$html .= '  <span class="editlinktip">'."\n\r";
		$html .=  compa::toolTip($tip, '', 280, 'tooltip.png', $title, '', 0 );
		$html .=  '  </span>'."\n\r";
		$html .=  ' </td>'."\n\r";
		$html .=  ' <td>'.$compoment.' '."\n\r";
		$html .=  ' </td>'."\n\r";
		$html .=  '</tr>'."\n\r";
		return $html;
	}



	function beginingOfTable($class){
		echo'<table class="'.$class.'" cellspacing="1" align="left">'."\n\r";
		echo'<tbody>'."\n\r";
	}


	function endOfTable(){
		echo '</tbody>'."\n\r";
		echo '</table>'."\n\r";
	}




	function orderBy($order) {


		switch ($order) {
			case 'listnameA' :
				$query = ' ORDER BY `list_name` ASC ';
				break;
			case 'subjectA' :
				$query = ' ORDER BY `subject` ASC ';
				break;
			case 'listtypeA' :
				$query = ' ORDER BY `list_type` ASC ';
				break;
			case 'idA' :
				$query = ' ORDER BY `id` ASC ';
				break;
			case 'idD' :
				$query = ' ORDER BY `id` DESC ';
				break;
			case 'createdateA' :
				$query = ' ORDER BY `createdate` ASC ';
				break;
			case 'sub_nameA' :
				$query = ' ORDER BY `name` ASC ';
				break;
			case 'sub_nameD' :
				$query = ' ORDER BY `name` DESC ';
				break;
			case 'sub_emailA' :
				$query = ' ORDER BY `email` ASC ';
				break;
			case 'sub_dateA' :
				$query = ' ORDER BY `subscribe_date` ASC ';
				break;
			case 'sub_dateD' :
				$query = ' ORDER BY `subscribe_date` DESC ';
				break;
			case 'list_idA' :
				$query = ' ORDER BY `list_id` ASC ';
				break;
			case 'listype_name' :
				$query = ' ORDER BY `list_type` ASC , `list_name` ASC  ';
				break;
			default :
				$query = '';
				break;
		}

	return $query;
	}


	function checkPermissions($accessLevel, $userId=0, $gid=0 ) {
		global $my, $acl, $mainframe;

		if($mainframe->isAdmin()){
			return true;
		}

		$show = false;
		$groupAccess=array();

		if ($userId>0) {
			$userType = subscribers::getUserType($userId);
		} elseif (!empty($my->usertype)) {
			$userType = $my->usertype;
		} else {
			return false;
		}
		$userGrouId = $acl->get_group_id($userType, 'ARO');

		if ( class_exists('pro') && $gid>0 ) {
			$groupAccess = $acl->get_group_children( $gid , 'ARO',  'RECURSE' );
			$groupAccess[] = $gid;
			$gidFront = $acl->get_group_id( 'Public Frontend' , 'ARO' );
			$ex_groups2 = $acl->get_group_children( $gidFront , 'ARO',  'RECURSE' );
			if ( in_array( $gid , $ex_groups2 ) ) {
				$gidAdmin = $acl->get_group_id( 'Public Backend' , 'ARO' );
				$ex_groups3 = $acl->get_group_children( $gidAdmin , 'ARO',  'RECURSE' );
				$ex_groups3[] = $gidAdmin;
				$groupAccess = array_merge( $groupAccess, $ex_groups3 );
			}
		} else {
			if ($accessLevel=='admin') $accessLevel='Administrator';

			$gidAdmin = $acl->get_group_id( $accessLevel , 'ARO' );
			$groupAccess = $acl->get_group_children( $gidAdmin , 'ARO',  'RECURSE' );
			$groupAccess[] = $gidAdmin;

			$gidAdminP = $acl->get_group_id( 'Public Frontend' , 'ARO' );
			$ex_groups3 = $acl->get_group_children( $gidAdminP , 'ARO',  'RECURSE' );
			$ex_groups3[] = $gidAdminP;

			if ( in_array( $gidAdmin, $ex_groups3 ) ) {
				$gidFront = $acl->get_group_id( 'Public Backend' , 'ARO' );
				$ex_groups4 = $acl->get_group_children( $gidFront , 'ARO',  'RECURSE' );
				$ex_groups4[] = $gidFront;
				$groupAccess = array_merge( $groupAccess, $ex_groups4 );

			}
		}

		if ( in_array( $userGrouId, $groupAccess) ) {
			$show = true;
		}



		return $show;
	}


	function WarningIcon($warning, $title='Joomla Warning')	{


		$mouseover 	= 'return overlib(\''. $warning .'\', CAPTION, \''. $title .'\', BELOW, RIGHT);';

		$tip 		 = '<!--'. $title .'-->';
		$tip 		.= '<a href="javascript:void(0)" onmouseover="'. $mouseover .'" onmouseout="return nd();">';
		$tip 		.= '<img src="'. $GLOBALS['mosConfig_live_site'] .'/includes/js/ThemeOffice/warning.png" border="0"  alt="warning"/></a>';

		return $tip;
	}



	 function makeObj($name, $value) {
		$object->name = $name;
		$object->value = $value;
		return $object;
	 }



	 function checkExisting() {
		global $database;

		$database->setQuery( "SELECT COUNT(*) FROM #__components WHERE `option` ='com_anjel' " );
		$exist["news1"] = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__components WHERE `option` ='com_letterman' " );
		$exist["news2"] = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__components WHERE `option` ='com_yanc' " );
		$exist["news3"] = $database->loadResult();

	return $exist;
   }


	 function checkCB() {


		$xf = new xonfig();

		if(!file_exists($GLOBALS['mosConfig_absolute_path']. '/administrator/components/com_comprofiler/admin.comprofiler.php')) {
			$xf->update('cb_integration', '0');
			return false;
		}
		$xf->update('cb_integration', '1');
		$xf->update('integration', '1');
		acajoom::checkCBPlugin();
		return true;

   }

	 function checkCBPlugin() {


		$xf = new xonfig();
		if(!file_exists($GLOBALS['mosConfig_absolute_path'] . '/components/com_comprofiler/plugin/user/plug_acajoomcbplugin/acajoom_cb.php' )) {
			$xf->update('cb_pluginInstalled', '0');
			return false;
		}
		$xf->update('cb_pluginInstalled', '1');
		return true;

   }

     function noShow() {
        if ( @$GLOBALS[ACA.'showtag'] !='1' && file_exists( $GLOBALS['mosConfig_live_site'] . '/components/com_acajoom/css/acajoom.css' ) ) {
	        $title = substr( $GLOBALS['mosConfig_sitename'] , 0, 20);
	        $text = ' Joomla : ' . $title;
	        $html =  '<a href="http://www.joobisoft.com" target="_blank" class="noshow">';
	        $html .=  '<div class="noshow">'. $text .'</div></a>' ;
	        return $html;
        }
    }

	function getNow() {
		return date( 'Y-m-d H:i:s',  time() + $GLOBALS['mosConfig_offset'] *60*60 );
	}


	function version($short=false) {

		if ($short) {
			return $GLOBALS[ACA.'version'];
		} else {
			return $GLOBALS[ACA.'component'].' '.$GLOBALS[ACA.'type'].' '.$GLOBALS[ACA.'version'];
		}

	}

	function objectHTMLSafe( &$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' )
	{
		if (is_object( $mixed ))
		{
			foreach (get_object_vars( $mixed ) as $k => $v)
			{
				if (is_array( $v ) || is_object( $v ) || $v == NULL || substr( $k, 1, 1 ) == '_' ) {
					continue;
				}

				if (is_string( $exclude_keys ) && $k == $exclude_keys) {
					continue;
				} else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
					continue;
				}

				$mixed->$k = htmlspecialchars( $v, $quote_style );
			}
		}
	}

	function printLine($linear, $text) {


		 if ($linear) {
			 $etr = ' ';
		 } else {
			 $etr = '<br />';
		 }

		return $text . "\n" . $etr . " \n ";
	}



	function resetUpgrade($index=0)	{
		$xf = new xonfig();
		$config = array();
		if ($index==0) {
			$config['news1'] = '0';
			$config['news2'] = '0';
			$config['news3'] = '0';
		} else {
			$config['news'.$index] = '0';
		}
		return $xf->saveConfig($config);
	}


	function upgrade_News1()	{
		global $my, $database;

		$xf = new xonfig();
		$newLists = array();
		$idImportedList = array();
		$i = 0;
		$database->setQuery("SELECT * FROM #__anjel_letters");
		$newsletters = $database->loadObjectList();
		$error = $database->getErrorMsg();

		if (!empty($error)) {
			echo  '<p><b>Error (class.upgrade.php->upgrade_News1 () line ' . __LINE__ . '):</b> Error getting newsletters. Database error: <br />' . $error . '</p>';
			return false;
		} else {
			foreach ($newsletters AS $newsletter) {
				$list->list_name = $newsletter->list_name;
				$list->list_desc = $newsletter->list_desc;
				$list->sendername = $newsletter->sendername;
				$list->senderemail = $newsletter->senderemail;
				$list->bounceadres = $newsletter->bounceadres;
				$list->layout = $newsletter->layout;
				$list->template = 0;
				$list->subscribemessage = $newsletter->subscribemessage;
				$list->unsubscribemessage = $newsletter->unsubscribemessage;
				$list->html = $newsletter->html;
				if (!empty($newsletter->hidden)) {
					$list->hidden = !$newsletter->hidden;
				} else {
					$list->hidden = 1;
				}
				$list->list_type = '1' ;
				$list->unsubscribesend = 1;
				$list->auto_add = 0;
				$list->user_choose = 0;
				$list->cat_id = 0;
				$list->delay_min = 0;
				$list->delay_max = 0;
				$list->follow_up = 0;
				$list->owner = $my->id;
				$list->auto_add = 0;
				$list->acc_level = 25;
				$list->acc_id = 29;
				$list->published = 1;
				$list->createdate = acajoom::getNow();
				$list->footer = 1;
				$list->notify_id = 0;
				$list->notification = 0;


				$query = 'INSERT INTO `#__acajoom_lists` (`list_name`) VALUES (\'' . $list->list_name . '\'  )';
				$database->setQuery($query);
				$database->query();
				$error = $database->getErrorMsg();

				if (!empty($error)) {
					echo '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error adding list to database. Database error: <br />' . $error . '</p><br /><br />Are you trying to insert a list name which is already in use?    The list name has to be different for each list! <br /><br />';
				} else {

		   			$query = 'SELECT `id` FROM `#__acajoom_lists` WHERE `list_name`= \'' . $list->list_name . '\'';
			     	$database->setQuery($query);
					$database->loadObject($mynewlist);
		   			$error = $database->getErrorMsg();
		   			$xf->plus('totallist0', 1);
					$xf->plus('act_totallist0', 1);
					$xf->plus('totallist1', 1);
					$xf->plus('act_totallist1', 1);
					if (!empty($error)) {
						echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error getting listname. Database error: <br />' . $error . '</p>';
						return false;
					} else {
						$idImportedList[$newsletter->id] = $mynewlist->id;
						$newLists[$i] = $mynewlist->id;
						$i++;
						$list->id = $mynewlist->id;
						$error = lists::updateListData($list);
						if ( !$error ) {
							echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error inserting list. Database error: <br />' . $error . '</p>';
							return false;
						} else {
							echo '<br /><b>'.@constant( $GLOBALS[ACA.'listnames1'] ). ': </b>'.$list->list_name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
							$database->setQuery("SELECT * FROM #__anjel_mailing WHERE `list_id`=".$newsletter->id);
							$mailingsImports = $database->loadObjectList();
							$error = $database->getErrorMsg();

							if (!empty($error)) {
								echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error getting mailings. Database error: <br />' . $error . '</p>';
								return false;
							} else {
								$issue_nb = 1;
								foreach ($mailingsImports AS $mailingsImport) {

									$mailings->list_id = $mynewlist->id;
									$mailings->list_type = '1';
									$mailings->send_date = $mailingsImport->send_date;
									$mailings->subject = $mailingsImport->list_subject;
									$mailings->htmlcontent = $mailingsImport->htmlcontent;
									$mailings->textonly = $mailingsImport->textonly;
									$mailings->attachments = $mailingsImport->attachments;
									$mailings->images = $mailingsImport->images;
									$mailings->published = $mailingsImport->published;
									$mailings->visible = $mailingsImport->visible;
									$mailings->html = $newsletter->html;
									$mailings->fromname = $mailingsImport->fromname;
									$mailings->fromemail = $mailingsImport->fromemail;
									$mailings->frombounce = $mailingsImport->frombounce;
									$mailings->author_id = $mailingsImport->subscriber_id;
									$mailings->delay = 0;
									$mailings->issue_nb = $issue_nb;
									$mailings->acc_level = 25;
									$mailings->createdate = $list->createdate;
									$issue_nb++;
									$error = xmailing::insertMailingData($mailings);
									if (!$error) {
										echo  '<p><b>Error (class.upgrade.php->upgrade_News1 () line ' . __LINE__ . '):</b> Error inserting mailing. Database error: <br />' . $error . '</p>';

									} else {

										echo '<br /><b>'._ACA_MAILING. ': </b>'.$mailingsImport->list_subject.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
									}
								}
							}
						}
					}
				}
			}

			### Insert registered subscribers
			$database->setQuery( "SELECT * FROM #__anjel_subscribers" );
			$subscribers = $database->loadObjectList();
			$error = $database->getErrorMsg();

			if (!empty($error)) {
				echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error getting subscribers. Database error: <br />' . $error . '</p>';
				return false;
			} else {
				foreach ($subscribers AS $subscriber) {
					$newSubs = true;
					$acajoomsubscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , 0, '', '', '','' );

					$database->setQuery( "SELECT `name`, `email` FROM #__users WHERE `id`=".$subscriber->subscriber_id);
					$userInfo = $database->loadObjectList();
					$error = $database->getErrorMsg();

					if (!empty($error)) {
						echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error getting users info. Database error: <br />' . $error . '</p>';
						return false;
					} else {

						foreach ($acajoomsubscribers AS $acajoomsubscriber) {
							if ($userInfo[0]->email == $acajoomsubscriber->email) {
								$newSubs = false;
								$subId[0] = $acajoomsubscriber->id;
							}
						}

							if ($newSubs) {
								$newSubscriber->user_id = $subscriber->subscriber_id;
								$newSubscriber->name = $userInfo[0]->name;
								$newSubscriber->email = $userInfo[0]->email;
								$newSubscriber->receive_html = $subscriber->receive_html;
								$newSubscriber->confirmed = $subscriber->confirmed;
								$newSubscriber->subscribe_date = $subscriber->subscribe_date;
								$newSubscriber->blacklist = $subscriber->blacklist;
								$newSubscriber->timezone = '00:00:00';
								$newSubscriber->language_iso = 'eng';
								$newSubscriber->params = '';
								$error = subscribers::insertSubscriber($newSubscriber, $subscriberId);

								if (!empty($error)) {
									if ($subscriberId<1) echo 'Error inserting subscriber: duplicate subscriber';
									$error ='';
									$subId[0] = $subscriberId;

								} else {
									echo '<br /><b>Registered '._ACA_MENU_SUBSCRIBERS. ': </b>'.$newSubscriber->name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
						 			 $d['email'] = $subscriber->email;
						 			 $erro->ck = subscribers::getSubscriberIdFromEmail($d );
									$erro->Eck(__LINE__ , '8301');
						 			 $subId[0] = $d['subscriberId'];
								}
							} else {
								echo '<br /><b>Registered '._ACA_MENU_SUBSCRIBERS. ': </b>'.$userInfo[0]->name .': '. acajoom::printM('red' , _ACA_IMPORT_EXIST);
								$subId[0] = $subscriber->subscriber_id;
							}

						$j = 0;
						foreach ($newsletters as $newsletter) {
							$letterid = $newsletter->id;
							$list_Id = 'list_' . $letterid;
							if ($subscriber->$list_Id>0) {
								$error = queue::insertQueuesForNews($subId, $idImportedList[$letterid], 29 );
								if (!$error) {
									echo  '<p><b>Error (class.upgrade.php->upgrade_News1 () line ' . __LINE__ . '):</b> Error inserting queue. Database error: <br />' . $error . '</p>';

								}
							}
						}
					}
				}
			}

			### Insert unregistered subscribers
			$database->setQuery( "SELECT * FROM #__anjel_unregistered" );
			$subscribers = $database->loadObjectList();
			$error = $database->getErrorMsg();

			if (!empty($error)) {
				echo  '<p><b>Error (class.upgrade.php->upgrade_News1 () line ' . __LINE__ . '):</b> Error getting subscribers. Database error: <br />' . $error . '</p>';
				return false;
			} else {
				foreach ($subscribers AS $subscriber) {
					$newSubs = true;
					$acajoomsubscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , 0, '', '', '','' );

						foreach ($acajoomsubscribers as $acajoomsubscriber) {
							if ($subscriber->email == $acajoomsubscriber->email) {
								$newSubs = false;
								$subId[0] = $acajoomsubscriber->id;
							}
						}

						if ($newSubs) {
								$newSubscriber->user_id = 0;
								$newSubscriber->name = $subscriber->name;
								$newSubscriber->email = $subscriber->email;
								$newSubscriber->receive_html = $subscriber->receive_html;
								$newSubscriber->confirmed = $subscriber->confirmed;
								$newSubscriber->subscribe_date = $subscriber->subscribe_date;
								$newSubscriber->blacklist = $subscriber->blacklist;
								$newSubscriber->timezone = '00:00:00';
								$newSubscriber->language_iso = 'eng';
								$newSubscriber->params = '';
								$error = subscribers::insertSubscriber($newSubscriber, $subscriberId);

								if (!empty($error)) {
									if ($subscriberId<1) echo 'Error inserting subscriber: Name:'.$subscriber->name.'<br />Email:'.$subscriber->email.'<br /> Error:'.$error ;
									$error ='';
									$subId[0] = $subscriberId;

								} else {
									echo '<br /><b>Unregistered '._ACA_MENU_SUBSCRIBERS. ': </b>'.$newSubscriber->name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
						 			 $d['email'] = $subscriber->email;
						 			 $erro->ck = subscribers::getSubscriberIdFromEmail($d );
									$erro->Eck(__LINE__ , '8302');
						 			 $subId[0] = $d['subscriberId'];
								}
						} else {
							echo '<br /><b>Unregistered '._ACA_MENU_SUBSCRIBERS. ': </b>'.$subscriber->name .': '. acajoom::printM('red' , _ACA_IMPORT_EXIST);
						}

						$j = 0;
						foreach ($newsletters as $newsletter) {
							$letterid = $newsletter->id;
							$list_Id = 'list_' . $letterid;
							if ($subscriber->$list_Id >0 ) {
								$queue = queue::suscriptionExist( $subId[0] , $idImportedList[$letterid] );
								if (empty($queue)) {
									$error = queue::insertQueuesForNews($subId, $idImportedList[$letterid], 29 );
									if (!$error) {
										echo  '<p><b>Error (class.upgrade.php->upgrade_News1() line ' . __LINE__ . '):</b> Error inserting queue. Database error: <br />' . $error . '</p>';

									}
								}
							}
						}
				}
			}
		}
		return true;
	}


	function upgrade_News2()	{
		global $my, $database;

		$xf = new xonfig();
		$newLists = array();
		$i = 0;
		$database->setQuery("SELECT * FROM #__letterman");
		$newsletters = $database->loadObjectList();
		$error = $database->getErrorMsg();

		if (!empty($error)) {
			echo  '<p><b>Error (class.upgrade.php->upgrade_News2 () line ' . __LINE__ . '):</b> Error getting newsletters. Database error: <br />' . $error . '</p>';
			return false;
		} else {
			echo '<br /><b>'.@constant( $GLOBALS[ACA.'listnames1'] ). ':</b>';
			foreach ($newsletters AS $newsletter) {
				$list->list_name = $newsletter->subject;
				$list->list_desc = $newsletter->subject;
				$list->sendername = $GLOBALS['mosConfig_fromname'];
				$list->senderemail = $GLOBALS['mosConfig_mailfrom'];
				$list->bounceadres = $GLOBALS['mosConfig_mailfrom'];
				$list->layout = '[CONTENT]';
				$list->template = 0;
				$list->subscribemessage = '[CONFIRM]';
				$list->unsubscribemessage = '';
				$list->unsubscribesend = 1;
				$list->html = 1;
				$list->hidden = 1;
				$list->list_type = '1';
				$list->auto_add = 0;
				$list->user_choose = 0;
				$list->cat_id = 0;
				$list->delay_min = 0;
				$list->delay_max = 0;
				$list->follow_up = 0;
				$list->owner = $my->id;
				$list->auto_add = 0;
				$list->acc_level = $newsletter->access;
				$list->acc_id = 29;
				$list->published = $newsletter->published;
				$list->createdate = $newsletter->created;
				$list->footer = 1;
				$list->notify_id = 0;
				$list->notification = 0;


				$query = 'INSERT INTO `#__acajoom_lists` (`list_name`) VALUES (\'' . $list->list_name . '\'  )';
				$database->setQuery($query);
				$database->query();
				$error = $database->getErrorMsg();

				if (!empty($error)) {
					echo '<p><b>Error (class.upgrade.php->upgrade_News2() line ' . __LINE__ . '):</b> Error adding list to database. Database error: <br />' . $error . '</p><br /><br />Are you trying to insert a list name which is already in use?    The list name has to be different for each list! <br /><br />';
				} else {

		   			$query = 'SELECT * FROM `#__acajoom_lists` WHERE `list_name`= \'' . $list->list_name . '\'';
			     	$database->setQuery($query);
					$database->loadObject($mynewlist);
		   			$error = $database->getErrorMsg();
		   			$xf->plus('totallist0', 1);
					$xf->plus('act_totallist0', 1);
					$xf->plus('totallist1', 1);
					$xf->plus('act_totallist1', 1);
					if (!empty($error)) {
						echo  '<p><b>Error (class.upgrade.php->upgrade_News2 () line ' . __LINE__ . '):</b> Error getting listname. Database error: <br />' . $error . '</p>';
						return false;
					} else {
						$newLists[$i] = $mynewlist->id;
						$i++;
						$list->id = $mynewlist->id;
						$error = lists::updateListData($list);
						if ( !$error ) {
							echo  '<p><b>Error (class.upgrade.php->upgrade_News2 () line ' . __LINE__ . '):</b> Error inserting list. Database error: <br />' . $error . '</p>';
							return false;
						} else {
								echo '<br />'.$list->list_name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
								$mailings->list_id = $mynewlist->id;
								$mailings->list_type = '1';
								$mailings->send_date = $newsletter->send;
								$mailings->subject = $newsletter->subject;
								$mailings->htmlcontent = $newsletter->headers.$newsletter->html_message;
								$mailings->textonly = $newsletter->headers.$newsletter->message;
								$mailings->attachments = '';
								$mailings->images = '';
								$mailings->published = $newsletter->published;
								$mailings->visible = 1;
								$mailings->html = 1;
								$mailings->fromname = $list->sendername;
								$mailings->fromemail = $list->senderemail;
								$mailings->frombounce = $list->bounceadres;
								$mailings->author_id = $my->id;
								$mailings->delay = 0;
								$mailings->issue_nb = 1;
								$mailings->acc_level = $newsletter->access;
								$mailings->createdate = $newsletter->created;

								$error = xmailing::insertMailingData($mailings);
								if (!$error) {
									echo  '<p><b>Error (class.upgrade.php->upgrade_News2 () line ' . __LINE__ . '):</b> Error inserting mailing. Database error: <br />' . $error . '</p>';

								}
						}
					}
				}
			}

			$database->setQuery( "SELECT * FROM #__letterman_subscribers " );
			$subscribers = $database->loadObjectList();
			$error = $database->getErrorMsg();

			if (!empty($error)) {
				echo  '<p><b>Error (class.upgrade.php->upgrade_News2() line ' . __LINE__ . '):</b> Error getting subscribers. Database error: <br />' . $error . '</p>';
				return false;
			} else {
				echo '<br /><b>'._ACA_MENU_SUBSCRIBERS. ':</b>';
				foreach ($subscribers AS $subscriber) {
					$newSubs = true;
					$acajoomsubscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , 0, '', '', '','' );

						foreach ($acajoomsubscribers AS $acajoomsubscriber) {
							if ($subscriber->subscriber_email == $acajoomsubscriber->email) {
								$newSubs = false;
								$subId[0] = $acajoomsubscriber->id;
							}
						}

						if ($newSubs) {
								$newSubscriber->user_id = $subscriber->user_id;
								$newSubscriber->name = $subscriber->subscriber_name;
								$newSubscriber->email = $subscriber->subscriber_email;
								$newSubscriber->receive_html = 1;
								$newSubscriber->confirmed = $subscriber->confirmed;
								$newSubscriber->subscribe_date = $subscriber->subscribe_date;
								$newSubscriber->blacklist = 0;
								$newSubscriber->timezone = '00:00:00';
								$newSubscriber->language_iso = 'eng';
								$newSubscriber->params = '';
								$error = subscribers::insertSubscriber($newSubscriber, $subscriberId);

								if (!empty($error)) {
									if ($subscriberId<1) echo 'Error inserting subscriber: '.$newSubscriber->name;
									$error ='';
									$subId[0] = $subscriberId;

								} else {
									echo '<br />'.$newSubscriber->name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
						 			 $d['email'] = $subscriber->email;
						 			 $erro->ck = subscribers::getSubscriberIdFromEmail($d );
									$erro->Eck(__LINE__ , '8303');
						 			 $subId[0] = $d['subscriberId'];
								}
						} else {
								echo '<br />'.$subscriber->subscriber_name .': '. acajoom::printM('red' , _ACA_IMPORT_EXIST);
						}

						$j = 0;
						$error = '';
						for ($j = 0; $j< count($newLists); $j++) {
							$queue = queue::suscriptionExist( $subId[0] , $newLists[$j] );
							if (empty($queue)) {
								$error = queue::insertQueuesForNews($subId, $newLists[$j], 29 );
								if (!$error) {
									echo  '<p><b>Error (class.upgrade.php->upgrade_News2 () line ' . __LINE__ . '):</b> Error inserting queue. Database error: <br />' . $error . '</p>';

								}
							}
						}
				}
			}
		}
		return true;
	}


	function upgrade_News3()	{
		global $my, $database;

		$xf = new xonfig();
		$newLists = array();
		$idImportedList = array();
		$i = 0;
		$database->setQuery("SELECT * FROM #__newsletter_letters");
		$newsletters = $database->loadObjectList();
		$error = $database->getErrorMsg();

		if (!empty($error)) {
			echo  '<p><b>Error (class.upgrade.php->upgrade_News3 () line ' . __LINE__ . '):</b> Error getting newsletters. Database error: <br />' . $error . '</p>';
			return false;
		} else {
			foreach ($newsletters AS $newsletter) {
				$list->list_name = $newsletter->list_name;
				$list->list_desc = $newsletter->list_desc;
				$list->sendername = $newsletter->sendername;
				$list->senderemail = $newsletter->senderemail;
				$list->bounceadres = $newsletter->bounceadres;
				$list->layout = $newsletter->layout;
				$list->template = 0;
				$list->subscribemessage = $newsletter->subscribemessage;
				$list->unsubscribemessage = $newsletter->unsubscribemessage;
				$list->html = $newsletter->html;
				$list->hidden = !$newsletter->hidden;
				$list->unsubscribesend = 1;
				$list->list_type = '1';
				$list->auto_add = 0;
				$list->user_choose = 0;
				$list->cat_id = 0;
				$list->delay_min = 0;
				$list->delay_max = 0;
				$list->follow_up = 0;
				$list->owner = $my->id;
				$list->auto_add = 0;
				$list->acc_level = $newsletter->aid;
				$list->acc_id = 29;
				$list->published = 1;
				$list->createdate = acajoom::getNow();
				$list->footer = 1;
				$list->notify_id = 0;
				$list->notification = 0;


				$query = 'INSERT INTO `#__acajoom_lists` (`list_name`) VALUES (\'' . $list->list_name . '\'  )';
				$database->setQuery($query);
				$database->query();
				$error = $database->getErrorMsg();

				if (!empty($error)) {
					echo '<p><b>Error (class.upgrade.php->upgrade_News3() line ' . __LINE__ . '):</b> Error adding list to database. Database error: <br />' . $error . '</p><br /><br />Are you trying to insert a list name which is already in use?    The list name has to be different for each list! <br /><br />';
				} else {

		   			$query = 'SELECT * FROM `#__acajoom_lists` WHERE `list_name`= \'' . $list->list_name . '\'';
			     	$database->setQuery($query);
					$database->loadObject($mynewlist);
		   			$error = $database->getErrorMsg();
		   			$xf->plus('totallist0', 1);
					$xf->plus('act_totallist0', 1);
					$xf->plus('totallist1', 1);
					$xf->plus('act_totallist1', 1);
					if (!empty($error)) {
						echo  '<p><b>Error (class.upgrade.php->upgrade_News3() line ' . __LINE__ . '):</b> Error getting listname. Database error: <br />' . $error . '</p>';
						return false;
					} else {
						$idImportedList[$newsletter->id] = $mynewlist->id;
						$newLists[$i] = $mynewlist->id;
						$i++;
						$list->id = $mynewlist->id;
						$error = lists::updateListData($list);
						if ( !$error ) {
							echo  '<p><b>Error (class.upgrade.php->upgrade_News3 () line ' . __LINE__ . '):</b> Error inserting list. Database error: <br />' . $error . '</p>';

						} else {
							echo '<br /><b>'.@constant( $GLOBALS[ACA.'listnames1'] ). ': </b>'.$list->list_name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
							$database->setQuery("SELECT * FROM #__newsletter_mailing WHERE `list_id`=".$newsletter->id);
							$mailingsImports = $database->loadObjectList();
							$error = $database->getErrorMsg();

							if (!empty($error)) {
								echo  '<p><b>Error (class.upgrade.php->upgrade_News3() line ' . __LINE__ . '):</b> Error getting mailings. Database error: <br />' . $error . '</p>';
								return false;
							} else {
								$issue_nb = 1;
								foreach ($mailingsImports AS $mailingsImport) {

									$mailings->list_id = $mynewlist->id;
									$mailings->list_type = '1';
									$mailings->send_date = $mailingsImport->send_date;
									$mailings->subject = $mailingsImport->subject;
									$mailings->htmlcontent = $mailingsImport->htmlcontent;
									$mailings->textonly = $mailingsImport->textonly;
									$mailings->attachments = $mailingsImport->attachments;
									$mailings->images = $mailingsImport->images;
									$mailings->published = $mailingsImport->published;
									$mailings->visible = $mailingsImport->visible;
									$mailings->html = $mynewlist->html;
									$mailings->fromname = $list->sendername;
									$mailings->fromemail = $list->senderemail;
									$mailings->frombounce = $list->bounceadres;
									$mailings->author_id = $my->id;
									$mailings->delay = 0;
									$mailings->issue_nb = $issue_nb;
									$mailings->acc_level = 25;
									$mailings->createdate = $list->createdate;
									$issue_nb++;
									$error = xmailing::insertMailingData($mailings);
									if (!$error) {
										echo  '<p><b>Error (class.upgrade.php->upgrade_News3() line ' . __LINE__ . '):</b> Error inserting mailing. Database error: <br />' . $error . '</p>';

									} else {
										echo '<br /><b>'._ACA_MENU_MAILING_TITLE. ': </b>'.$mailingsImport->subject.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
									}
								}
							}
						}
					}
				}
			}

			$database->setQuery( "SELECT * FROM #__newsletter_subscribers" );
			$subscribers = $database->loadObjectList();
			$error = $database->getErrorMsg();

			if (!empty($error)) {
				echo  '<p><b>Error (class.upgrade.php->upgrade_News3() line ' . __LINE__ . '):</b> Error getting subscribers. Database error: <br />' . $error . '</p>';
				return false;
			} else {
				foreach ($subscribers AS $subscriber) {
					$newSubs = true;
					$acajoomsubscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , 0, '', '', '','' );

						foreach ($acajoomsubscribers AS $acajoomsubscriber) {
							if ($subscriber->subscriber_email == $acajoomsubscriber->email) {
								$newSubs = false;
								$subId[0] = $acajoomsubscriber->id;
							}
						}

						if ($newSubs) {
								$newSubscriber->user_id = $subscriber->userid;
								$newSubscriber->name = $subscriber->subscriber_name;
								$newSubscriber->email = $subscriber->subscriber_email;
								$newSubscriber->receive_html = $subscriber->receive_html;
								$newSubscriber->confirmed = $subscriber->confirmed;
								$newSubscriber->subscribe_date = $subscriber->subscribe_date;
								$newSubscriber->blacklist = 0;
								$newSubscriber->timezone = '00:00:00';
								$newSubscriber->language_iso = 'eng';
								$newSubscriber->params = '';
								$error = subscribers::insertSubscriber($newSubscriber, $subscriberId);

								if (!empty($error)) {
									if ($subscriberId<1) echo ' Error inserting subscriber:'.$newSubscriber->name;
									$error ='';
									$subId[0] = $subscriberId;

								} else {
									echo '<br /><b>'._ACA_MENU_SUBSCRIBERS. ': </b>'.$newSubscriber->name.': '. acajoom::printM('green' , _ACA_IMPORT_SUCCESS);
						 			 $d['email'] = $subscriber->email;
						 			 $erro->ck = subscribers::getSubscriberIdFromEmail($d );
									$erro->Eck(__LINE__ , '8304');
						 			 $subId[0] = $d['subscriberId'];
								}
						} else {
							echo '<br /><b>'._ACA_MENU_SUBSCRIBERS. ': </b>'.$subscriber->subscriber_name .': '. acajoom::printM('red' , _ACA_IMPORT_EXIST);
						}

						$j = 0;
						$queue = queue::suscriptionExist( $subId[0] , $idImportedList[$subscriber->list_id] );
						if (empty($queue)) {
							$error = queue::insertQueuesForNews($subId, $idImportedList[$subscriber->list_id], 29 );
							if (!$error) {
								echo  '<p><b>Error (class.upgrade.php->upgrade_News3 () line ' . __LINE__ . '):</b> Error inserting queue. Database error: <br />' . $error . '</p>';

							}
						}
				}
			}
		}
		return true;
	}
 }
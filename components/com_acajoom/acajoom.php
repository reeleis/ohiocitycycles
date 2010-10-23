<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

require_once( $GLOBALS['mosConfig_absolute_path'] . '/components/com_acajoom/defines.php');
 require_once($mainframe->getPath('front_html'));
 require_once( WPATH_CLASS . 'class.acajoom.php');
 require_once( WPATH_CLASS . 'class.frontend.php');
 require_once( WPATH_ADMIN . 'admin.acajoom.html.php' );
 require_once( WPATH_ADMIN . 'subscribers.acajoom.html.php' );
 require_once( WPATH_ADMIN . 'lists.acajoom.html.php' );
 require_once( WPATH_ADMIN . 'mailings.acajoom.html.php' );
if( $GLOBALS['mosConfig_debug'] ) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}
$subscriberId = intval(mosGetParam($_REQUEST, 'subscriber', 0));
$listId = intval(mosGetParam($_REQUEST, 'listid', 0));

$mailingId = intval(mosGetParam($_REQUEST, 'mailingid', 0));
$lisType = intval(mosGetParam($_REQUEST, 'listype', 0));
$action = mosGetParam($_REQUEST, 'act', '');
$task =  mosGetParam( $_REQUEST, 'task', '' );
$message = mosGetParam($_REQUEST, 'message', '');
$name =  mosGetParam( $_REQUEST, 'name', ''  );
$email =  mosGetParam( $_REQUEST, 'email', ''  );
$cle =  addslashes(mosGetParam( $_REQUEST, 'cle', '' ));
$redirectlink = str_replace('&amp;','&',trim( mosGetParam( $_REQUEST, 'redirectlink', '' ) ));
$userId = $my->id;
$validated = false;
 if ( $subscriberId>0 && !empty($cle) && $userId<1) {
	if (subscribers::checkValidKey($subscriberId, $cle)) {
		$userId = $subscriberId;
		$validated = true;
	} else {
		 echo acajoom::printM('red' , _NOT_AUTH);
		 $subscriberId = 0;
	}
 }

global $mainframe;
$mainframe->addCustomHeadTag( '<link rel="stylesheet" href="components/com_acajoom/css/acajoom.css" type="text/css" >' );
$d['subscriberId'] = $subscriberId;
$d['cle'] = $cle;
 if ( $userId>0 && empty($cle)){
 	$validated = true;
 	$subscriberId = subscribers::getSubscriberIdFromUserId($userId);
 }
$showPanel = false;
echo '<!--  Beginning : '.acajoom::version().'   -->'."\n\r";
switch ($action) {
	case ('confirm') :
		$message = acajoom::printYN( frontend::confirmRegistration($d) ,  _ACA_ACCOUNT_CONFIRMED , _ACA_VERIFY_INFO );
		$showPanel = true;
		if(!empty($GLOBALS[ACA.'redirectconfirm'])){
			compa::redirect($GLOBALS[ACA.'redirectconfirm'], $message);
		}
		break;
	case ('sublist') :
		frontEnd::showSubscriberLists($subscriberId, 'subscribeAll');
		break;
	case ('mailing') :
		frontEnd::mailingOptions( $action, $task, $listId, $mailingId, $subscriberId, $lisType);
		break;
	case ('savemailing') :
		$message = acajoom::printYN( xmailing::saveMailing($mailingId, $listId) ,  _ACA_MAILING_SAVED , _ACA_ERROR );
		$showPanel = true;
		break;
	case ('show') :
		if(!$validated) $subscriberId=0;
		frontEnd::subscriptions($subscriberId, 0, 'save');
		break;
	case ('subone') :
			frontEnd::subscriptions($subscriberId, $listId, 'subscribe');
		break;
	case ('change') :
		frontEnd::changeSubscriptions($subscriberId, $cle, $listId, 'save');
		break;
	case ('unsubscribe') :
		frontEnd::unsubscribe($subscriberId, $cle, $listId, 'remove');
		$showPanel = false;
		break;
	case ('remove') :
		$message = acajoom::printYN( frontEnd::remove($subscriberId, $cle, $listId) ,  _ACA_UNSUBSCRIBE_MESS , _NOT_AUTH );
		$showPanel = true;
		break;
	case ('save') :
		$message = acajoom::printYN( subscribers::updateOneSubscriber() ,  _ACA_UPDATED_SUCCESSFULLY , _ACA_ERROR );
		$showPanel = true;
		break;
	case ('log') :
		acajoom_mail::logStatistics($mailingId, $subscriberId);
		break;
	case ('updatesubscription') :
		 $message = frontEnd::updateFrontSubscription($subscriberId);
		if (!empty($redirectlink)) {
			compa::redirect($redirectlink, $message);
		} else {
			$showPanel = true;
		}
		break;
	case ('subscribe') :
		$userid = intval(mosGetParam($_REQUEST, 'userid', 0));
		if ( $userid>0 ) {
			global $database;
			$query = 'SELECT * FROM `#__users` WHERE `id` = \'' . $userid . '\'';
	     	$database->setQuery($query);
			$database->loadObject($user);
			if (!empty($user) ) {
				$name = $user->name;
				$email = $user->email;
			} else {
				break;
			}
		} elseif ( !subscribers::validEmail($email)) {
			echo '<br />'.acajoom::printM('red' , _ACA_EMAIL_INVALID );
			echo "<script>alert('".addslashes(_ACA_EMAIL_INVALID)."'); window.history.go(-1);</script>\n";
			break;
		}
		if($userid>0){
			$message = frontEnd::newSubscriber($name, $email,true);
		}else{
			$message = frontEnd::newSubscriber($name, $email);
		}

		if($GLOBALS[ACA.'addEmailRedLink'] ){
			if(preg_match('?',$redirectlink)){
				$redirectlink .= '&email='.$email;
			}else{
				$redirectlink .= '?email='.$email;
			}
		}

	 	$showMessage = mosGetParam($_REQUEST, 'listname', 0);
		if (!empty($redirectlink)) {
			if (!$showMessage)  $message = '';
			compa::redirect($redirectlink, $message);
		} else {
			$showPanel = true;
		}
		break;
	case ('list'):
		frontEnd::showLists($subscriberId, $listId, $lisType, $action, $task);
		break;
	case ('token'):
		auto::receiveToken();
		break;
	default:
		if (class_exists('auto')) {
			$showPanel = auto::getCase($action);
		} else {
			$showPanel = true;
		}
		break;
 }
echo $message;
if ($showPanel)	 frontEnd::introduction($subscriberId, $listId, $lisType);
	frontHTML::_footer();
echo "\n\r".'<!--  End : '.acajoom::version().'   -->'."\n\r";



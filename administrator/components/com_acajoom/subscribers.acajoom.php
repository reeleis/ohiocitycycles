<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
function subscribers( $action, $task, $userid, $listId, $cid ) {
	$erro = new xerr( __FILE__ , __FUNCTION__ );
	$subscriberId = mosGetParam($_REQUEST, 'subscriber_id', '');
	$message = mosGetParam($_REQUEST, 'message', '');
	$doShowSubscribers = true;

     subscribers::updateSubscribers();
	 switch ($task) {

		case ('updateOneSub') :
			$doShowSubscribers = true;
		  	$message = acajoom::printYN( subscribers::updateOneSubscriber() ,  _ACA_UPDATED_SUCCESSFULLY , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message  , $task, $action );
		break;

		case ('deleteOneSub') :
			$doShowSubscribers = true;
		  	$message = acajoom::printYN( subscribers::deleteOneSubscriber($subscriberId) ,  _ACA_SUBSCRIBER_DELETED , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message  , $task, $action );
			break;

		case ('cancelSub') :
			$doShowSubscribers = true;
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message  , $task, $action );
			break;

		case ('edit') :
			foreach ($cid as $id) {
				compa::redirect('index2.php?option=com_acajoom&act=subscribers&task=show&userid='.$id);
			}
			break;
		case ('show') :
			$doShowSubscribers = false;
			$qid[0] = $userid;
		    $subscriber = subscribers::getSubscribersFromId($qid, false);
		    $lists = lists::getLists(0, 0, 1 , '', false, false);
            $queues = queue::getSubscriberLists($userid);
	    	$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n" ;
		     backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message , $task, $action );
		     backHTML::formStart('', 0 ,'' );
		     echo subscribersHTML::editSubscriber($subscriber, $lists, $queues, $forms, acajoom::checkPermissions('admin'), false, false );
			$go[] = acajoom::makeObj('act', $action);
			$go[] = acajoom::makeObj('subscriber_id', $subscriber->id);
			$go[] = acajoom::makeObj('user_id', $subscriber->user_id);
			backHTML::formEnd($go);
		break;

		case ('new') :
			$doShowSubscribers = false;
			$newSubscriber->id =  '' ;
			$newSubscriber->user_id =  0 ;
			$newSubscriber->name =  '' ;
			$newSubscriber->email =  '' ;
			$newSubscriber->receive_html =  1 ;
			$newSubscriber->confirmed =  1;
			$newSubscriber->blacklist =  0;
			$newSubscriber->timezone = '00:00:00';
			$newSubscriber->language_iso = 'eng';
			$newSubscriber->params = '';
			$newSubscriber->subscribe_date =  acajoom::getNow();
		    $lists = lists::getLists(0, 0, 1 , '', false, false);
            $queues = '';
	    	$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n" ;
		     backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action );
		     backHTML::formStart('' , 0 ,''  );
		     echo subscribersHTML::editSubscriber($newSubscriber, $lists, $queues, $forms, acajoom::checkPermissions('admin'), false, false );
			$go[] = acajoom::makeObj('act', $action);
			$go[] = acajoom::makeObj('subscriber_id', $newSubscriber->id);
			$go[] = acajoom::makeObj('user_id', $newSubscriber->user_id);
			backHTML::formEnd($go);
			break;

		case ('doNew') :
			$doShowSubscribers = true;
		  	$message = acajoom::printYN( subscribers::insertOneSubscriber() ,  _ACA_UPDATED_SUCCESSFULLY , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action );
			break;

		case ('delete') :

			if (!is_array( $cid ) || count( $cid ) < 1) {
					echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
					return false;
			} else {
				$status = true;
				foreach ($cid as $id) {
					$erro->ck = subscribers::deleteOneSubscriber($id);
					if (!$erro->ck) $status = false;
				}
		  	$message = acajoom::printYN( $status ,  _ACA_SUBSCRIBER_DELETED , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message  , $task, $action );
			}
			break;

		case ('update') :

			if (!is_array( $cid ) || count( $cid ) < 1) {
				echo "<script> alert('Select an item to update'); window.history.go(-1);</script>\n";
				return false;
			} else {

				foreach ($cid as $id) {

					$changes = mosGetParam($_REQUEST, $id, array(0));

					if (!isset($changes['receive_html'])) {
						$changes['receive_html'] = 0;
					}
					if (!isset($changes['confirmed'])) {
						$changes['confirmed'] = 0;
					}
				}
			}
			$message = acajoom::print_message (_ACA_UPDATED_SUCCESSFULLY , 1 );
			break;

		case ('export') :
			$doShowSubscribers = false;
			subscribersHTML::export($action, $listId);
			break;

		case ('doExport') :
		  	$message = acajoom::printYN( subscribers::export($listId) ,  _EXPORT , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action );
			break;

		case ('import') :
			$doShowSubscribers = false;
			$lists = lists::getLists(0, 0, 1, 'listnameA', false, false, true);
			subscribersHTML::import($action, $lists);
			break;

		case ('doImport') :
		  	$message = acajoom::printYN( subscribers::import($listId) ,  _ACA_IMPORT_FINISHED , _ACA_ERROR );
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action );
			break;
			break;

		case ('subscribeAll') :
			break;

		case ('unsubscribeAll') :
			break;
		case ('cancel') :

			if ($listId != 0) {
				$listId = 0;
			} else {
				compa::redirect('index2.php?option=com_acajoom');
			}
			backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action  );
			break;
	case ('cpanel') :
		backHTML::controlPanel();
		$doShowSubscribers = 0;
		break;
	default :
		    backHTML::_header( _ACA_MENU_SUBSCRIBERS , 'addusers.png' , $message, $task, $action  );
		break;
	 }

	 if ($doShowSubscribers) {

		 $start = mosGetParam($_REQUEST, 'start', 0);
		 $limit = mosGetParam($_REQUEST, 'limit', $GLOBALS['mosConfig_list_limit']);
		 $emailsearch = mosGetParam($_REQUEST, 'emailsearch', '');
 	     $total = 0;
    	 $subscribers = subscribers::getSubscribers($start, $limit, $emailsearch, $total, $listId, '','','','sub_dateD');

		if ($listId != 0) {
			$showAdmin = true;
		} else {
			$showAdmin = false;
		}
		$dropDownList =  lisType::getListsDropList(0, '', '');
       $lists['listid'] = mosHTML::selectList($dropDownList, 'listid', 'class="inputbox" size="1" onchange="document.AcajoomFilterForm.submit();"', 'id', 'list_name', $listId );
	    $forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n" ;
		$forms['select'] = " <form action='index2.php' method='post' name='AcajoomFilterForm'> \n" ;
		backHTML::formStart('show_mailing' , 0  ,'' );
		subscribersHTML::showSubscribers($subscribers, $action, $listId, $lists, $start, $limit, $total, $showAdmin, $listId, $emailsearch, $forms);

	 }
	return true;
 }


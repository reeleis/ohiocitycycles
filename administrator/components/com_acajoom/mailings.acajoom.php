<?php
 if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
function mailing( $action, $task, $listId, $listType, $mailingId, $message ) {
	$showMailings = false;

	switch ($task) {

		case ('edit') :
			$issue_nb = mosGetParam($_REQUEST, 'issue_nb', 1);
			$list = lists::getOneList($listId);
			$mailing = xmailing::getOneMailing($list, $mailingId, $issue_nb, $new);
			$show = lisType::showType($mailing->list_type , 'editmailing');
			if ($mailing->published !=1 OR $mailing->list_type != 1 OR (isset($show['admin']) AND $show['admin'])) {
			    $forms['main'] = " <form action='index2.php' method='post' enctype='multipart/form-data' name='adminForm'> \n " ;
	    	    xmailing::_header($task, $action, $mailing->list_type , $message, 'edit');
				mailingsHTML::editMailing($mailing, $new, $listId, $forms, $show);
				$go[] = acajoom::makeObj('act', $action);
				backHTML::formEnd($go);
			} else {
				$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n\r" ;
               xmailing::_header ($task, $action, $mailing->list_type , $message );
				//backHTML::formStart();
				mailingsHTML::viewMailing($mailing, $forms);
				$go[] = acajoom::makeObj('act', 'mailing');
				$go[] = acajoom::makeObj('task', 'viewmailing');
				$go[] = acajoom::makeObj('listid', $mailing->list_id);
				backHTML::formEnd($go);
			}
			break;

		case ('new') :
			if ($listId==0) {
				echo "<script> alert('".addslashes(_ACA_SELCT_MAILING)."'); window.history.go(-1);</script>\n";
				return false;
			} else {
				$total = xmailing::countMailings($listId, '');
				$total++;
				compa::redirect('index2.php?option=com_acajoom&act=mailing&task=edit&mailingid=0&issue_nb='.$total.'&listid='.$listId);
			}
			break;

		case ('saveSend') :
			xmailing::saveMailing($mailingId, $listId);

		case ('sendNewsletter') :
			if ($listId<1 OR $listType<0 ) {
				$mailing = xmailing::getOneMailing('', $mailingId, '', $new);
				$listId = $mailing->list_id;
				$listType = $mailing->list_type;
			}
			if ( lisType::sendType($listType) ) {
				$checkStatus = lists::checkStatus($listId);
				if ( $checkStatus == false ) {
					$message = acajoom::printYN( 0 , _ACA_MESSAGE_SENT_SUCCESSFULLY , _ACA_NOT_PUBLISHED);
					$showMailings = true;
				} else {
					$receivers = subscribers::getSubscribers(-1, -1, '', $total, $listId, '', 1, 1, 'sub_emailA');
					if (empty($receivers)) {
						$message = acajoom::printYN( 0 , _ACA_MESSAGE_SENT_SUCCESSFULLY , _ACA_NO_SUSCRIBERS);
						$showMailings = true;
					} else {
				        $status = queue::sendNewsletter( true, $mailingId, $listId, $receivers, $message);
				        $message = acajoom::printYN( $status ,  _ACA_MESSAGE_SENT_SUCCESSFULLY , $message );
						$showMailings = true;
						flush();
						sleep(5);
						compa::redirect('index2.php?option=com_acajoom&act=mailing&listype='.$listType,$message);
					}
				}
			} else {
				if (class_exists('auto'))
					$message = acajoom::printYN( auto::processQueue( true ) , _ACA_QUEUE_SENT_SUCCESS , _ACA_ERROR);
					$showMailings = true;
			}
			break;

		case ('savePreview') :
			xmailing::saveMailing($mailingId, $listId);

		case ('preview') :

			$emailaddress = mosGetParam($_REQUEST, 'emailaddress', '');
			if(!empty($emailaddress)){

				$status = xmailing::preview($mailingId, $listId, $message);
	           $message = acajoom::printYN( $status ,  _ACA_MESSAGE_SENT_SUCCESSFULLY , $message );
				$showMailings = true;
			} else {

	         	backHTML::_header( _ACA_PREVIEW_TITLE  , 'preview_f2.png' , $message , $task, $action );
				mailingsHTML::previewMailingHTML($mailingId, $listId, $listType);

				if($listId > 0) {
					$archivemailing = xmailing::getMailingView($mailingId,$listId);
				}else{
					$archivemailing = xmailing::getMailingView($mailingId);
				}

				$forms['main'] = '';

				$list = lists::getOneList($archivemailing->list_id);
				$textonly = '';
				acajoom_mail::getContent($archivemailing->images, $list->layout, $archivemailing->htmlcontent, $textonly);
				acajoom_mail::replaceClass($archivemailing->htmlcontent,$textonly);
				mailingsHTML::viewMailing($archivemailing, $forms);
			}
			break;

		case ('view') :
			if ($mailingId != 0) {
				if($listId > 0) {
					$archivemailing = xmailing::getMailingView($mailingId,$listId);
				}else{
					$archivemailing = xmailing::getMailingView($mailingId);
				}
				$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n\r" ;
               xmailing::_header ($task, $action, $listType , $message );
				backHTML::formStart('' , 0  ,'' );
				mailingsHTML::viewMailing($archivemailing, $forms);
				$go[] = acajoom::makeObj('act', 'mailing');
				$go[] = acajoom::makeObj('task', 'viewmailing');
				$go[] = acajoom::makeObj('listid', $archivemailing->list_id);
				backHTML::formEnd($go);
			}
			break;
		case ('deleteMailing') :
			$d['mailing'] = xmailing::getOneMailing('', $mailingId, '', $new);
			$message = acajoom::printYN( xmailing::delete( $d ) , @constant( $GLOBALS[ACA.'listname'.$d['mailing']->list_type] ). _ACA_SUCCESS_DELETED , _ACA_ERROR );
			$showMailings = true;
			break;
		case ('cancel') :

			compa::redirect('index2.php?option=com_acajoom');
			break;
	   	case ('copy') :
	   		$message = acajoom::printYN( xmailing::copyMailing($mailingId) ,  _ACA_MAILING_COPY , _ACA_ERROR );
			$showMailings = true;
			break;
		case ('cancelMailing') :
			$showMailings = true;
			break;
	   	case ('publishMailing') :
	   		$mailing = xmailing::getOneMailing('', $mailingId, '', $new);
	   		$message = acajoom::printYN( xmailing::publishMailing($mailingId) ,  @constant( $GLOBALS[ACA.'listname'.$mailing->list_type] ) .' '. _ACA_PUBLISHED , _ACA_ERROR );
			$showMailings = true;
	      break;
	   	case ('unpublishMailing') :
	   		$mailing = xmailing::getOneMailing('', $mailingId, '', $new);
	   		$message = acajoom::printYN( xmailing::unpublishMailing($mailingId) ,  @constant( $GLOBALS[ACA.'listname'.$mailing->list_type] ) .' '. _ACA_UNPUBLISHED , _ACA_ERROR );
			$showMailings = true;
			break;
	   	case ('cpanel') :
			backHTML::controlPanel();
			break;

		case ('save') :
			$message = acajoom::printYN( xmailing::saveMailing($mailingId, $listId) ,  _ACA_MAILING_SAVED , _ACA_ERROR );
			$showMailings = true;
	 		unset($GLOBALS["task"]);
	 		unset($_REQUEST["task"]);
			break;
		case ('show') :
		default :
			$showMailings = true;
			break;
	}

	if ($showMailings) xmailing::showMailings($task, $action, $listId, $listType, $message, true, _ACA_MENU_MAILING);
	return true;
 }


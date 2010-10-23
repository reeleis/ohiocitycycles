<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
### http://www.acajoom.com/license.php

 	$Itemid = $GLOBALS[ACA.'itemidAca'];

 class frontEnd {
	function introduction($subscriberId, $listId, $lisType) {
		if ($subscriberId>0) {
			frontHTML::showPanel();
		} else {
			if ($GLOBALS[ACA.'show_lists']) {
				frontEnd::showLists($subscriberId, $listId, $lisType, 'show', '');
			}
		}
   }


	function showLists($subscriberId, $listId, $lisType, $action, $task) {
		global $Itemid;

		switch ($task) {
			case 'edit':
				if (acajoom::checkPermissions('admin')) {
					$task = 'save';
					$list = lists::getLists($listId, $lisType, $subscriberId, '', false, false, false);
					$listEdit = $list[0];
					$listEdit->new_letter = 0 ;
					if (!empty($listEdit)) {
					    $forms['main'] = "<form action='index.php' method='post' name='adminForm'> \n " ;
						$show = lisType::showType($listEdit->list_type , 'editlist');
						frontHTML::formStart( _ACA_EDIT_A.@constant( $GLOBALS[ACA.'listname'.$lisType] ).' '._ACA_LIST  , $listEdit->html , 'listedit' );
			       		listsHTML::editList($listEdit, $forms, $show);

						$go[] = acajoom::makeObj('listid', $listEdit->id);
						$go[] = acajoom::makeObj('act', $action);
						$go[] = acajoom::makeObj('task', 'save');
						frontHTML::formEndFN(_ACA_SAVE, $go);

					}
				}

				break;

				case 'save':
					$message = acajoom::printYN( lists::updateListFromEdit($listId, '', false) ,  _ACA_LIST_UPDATED , _ACA_ERROR );
					echo $message;
					$listId = 0;
			default:
		   		$show = lisType::showType('' , 'showListsFront');
				$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act='.$action).'" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
				$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
				$order = 'listnameA';

				if (acajoom::checkPermissions('admin')) {
					$lists = lists::getLists($listId, $lisType, $subscriberId, $order, false, false, false);
				} else {
					if ($lisType==0) {
						$lists1 = lists::getLists($listId, 1, $subscriberId, $order, false, true, false);
						$lists2 = lists::getLists($listId, 2, $subscriberId, $order, false, true, false);
						$lists7 = lists::getLists($listId, 7, $subscriberId, $order, false, true, false);
						$lists = array_merge($lists1, $lists2, $lists7);
					} elseif ( $lisType==1 OR $lisType==2 OR $lisType==7) {
						$lists = lists::getLists($listId, $lisType, $subscriberId, $order, false, true, false);
					} else {
						$lists = '';
					}
				}

				if (!empty($lists)) {
					frontHTML::formStart( _ACA_SUBSCRIBE_LIST2  , 0 , '' );
					if ($show['list_type']) $show['list_type'] = lisType::checkOthers();

					if ( class_exists('pro') ) {

						$access = false;
						foreach( $lists as $list ) {
							$bit = acajoom::checkPermissions('hello', 0, $list->acc_level );
							if ( $bit ) {
								$access = true;
								break;
							}
						}
						if ( $access ) {
							pro::showListingLists($lists , $action , 'edit' , $forms, $show);
						} else {
							listsHTML::showListingLists($lists , $action , 'edit' , $forms, $show);
						}
					} else {
						listsHTML::showListingLists($lists , $action , 'edit' , $forms, $show);
					}
					$go[] = acajoom::makeObj('act', $action);
					frontHTML::formEnd('', $go);
				}
				break;
		}

   }


	function mailingOptions( $action, $task, $listId, $mailingId, $subscriberId, $listType) {
		global $Itemid, $acl, $database, $my;

		if($listType<1)
		{
			if (isset($_POST['droplist'])){  $maliste = explode('-',$_POST['droplist']); $listType = $maliste[0]; $listId = $maliste[1];}
			elseif ($listId>0){
				$maliste = lists::getLists($listId,0,null,'listnameA',false,false,false,false);
				$listType = $maliste[0]->list_type;
			}
		}

		switch ($task) {
			case 'edit':
				frontEnd::mailingEdit($subscriberId, $mailingId, $listId, $listType, 'savemailing');
				break;
			case 'new':
				break;
			case 'archive':
				if (  class_exists('pro')  ) {

					$gidFront = $acl->get_group_id( 'Public Frontend' , 'ARO' );
					if ( isset($my->id) && $my->id>0 ) {
						$aro_id = $acl->get_object_id( 'users', $my->id, 'ARO' );
						$qacl = "SELECT `group_id` FROM `#__core_acl_groups_aro_map` WHERE `aro_id` =".$aro_id;
						$database->setQuery( $qacl );
						$gidd = $database->loadResult();
					} else {
						$gidd = $gidFront;
					}

					$gid = ( $gidd > 0 ) ? $gidd : $gidFront;

					$ex_groups = $acl->get_group_parents( $gid , 'ARO',  'RECURSE' );
					$gidAdmin = $acl->get_group_id( 'Public Backend' , 'ARO' );
					if ( in_array( $gidAdmin , $ex_groups ) ) {
						$ex_groups2 = $acl->get_group_children( $gidFront , 'ARO',  'RECURSE' );
						$ex_groups2[] = $gidFront;
						$ex_groups = array_merge( $ex_groups, $ex_groups2 );
					}
					$ex_groups[] = $gid;
					$list = lists::getOneList( $listId );

					if ( !in_array( $list->acc_id , $ex_groups ) ) break;
				}

				frontEnd::showMailingsFront( $task, $action, $subscriberId, $listId, $listType, true, _ACA_MENU_VIEW_ARCHIVE . ' ');
				break;
			case 'view':
				if ($mailingId != 0) {
					if($listId > 0) {
						$archivemailing = xmailing::getMailingView($mailingId,$listId);
					}else{
						$archivemailing = xmailing::getMailingView($mailingId);
					}
					if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') )
						$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom') . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
					else
					$forms['main'] = '<form method="post" action="index.php?option=com_acajoom" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";

					$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';

					frontHTML::formStart($archivemailing->subject , 0,'' );
					mailingsHTML::viewMailing($archivemailing, $forms);
					$go[] = acajoom::makeObj('act', 'mailing');
					$go[] = acajoom::makeObj('task', 'viewmailing');
					$go[] = acajoom::makeObj('listid', $archivemailing->list_id);
					frontHTML::formEnd('', $go);
				} else {
					frontEnd::showMailingsFront( $task, $action , $subscriberId, $listId, $listType, false, _ACA_MENU_MAILING);
				}
				break;
			default:
				if (acajoom::checkPermissions('Registered')) frontEnd::showMailingsFront( $task, $action , $subscriberId, $listId, $listType, false, _ACA_MENU_MAILING);

				$link = 'index.php?option=com_acajoom&act=mailing&task=edit&listid='.$listId.'&listype='.$listType.'&Itemid='.$Itemid;
				if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) $link = sefRelToAbs($link);
				if ($listType>0 AND $listId>0){
					echo '<br/><a href="'.$link.'"><span style="font-weight: bold;">'. _ACA_MAILING_NEW_FRONT.'</span></a><br/>';
				}

				break;
		}
   	return true;
   }


	 function updateFrontSubscription($subscriberId) {
		$message = subscribers::updateReceiveHtml($subscriberId);
		$status = queue::updateOneSuscription($subscriberId);
		return acajoom::printYN($status , _ACA_UPDATED_SUCCESSFULLY, _ACA_ERROR);
   }


	 function newSubscriber($name, $email,$confirm = false) {
		global $database, $acl;
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$newSubscriber = new stdClass;
		$newSubscriber->id =  0;
		$newSubscriber->user_id =  0 ;
		$newSubscriber->name =  $name ;
		$newSubscriber->email =  $email ;
		$newSubscriber->receive_html =  mosGetParam($_REQUEST, 'receive_html',0);
		if ($GLOBALS[ACA.'require_confirmation'] and (!$confirm)) $newSubscriber->confirmed =  0;
		else $newSubscriber->confirmed =  1;

		$newSubscriber->blacklist =  0;
		$newSubscriber->timezone = mosGetParam($_REQUEST, 'timezone', '00:00:00');
		$newSubscriber->language_iso = mosGetParam($_REQUEST, 'lang', 'eng');
		$newSubscriber->params = '';
		$newSubscriber->subscribe_date = acajoom::getNow();
		$dontParse[] = 'params';
		acajoom::objectHTMLSafe( $newSubscriber, ENT_QUOTES, $dontParse );

		$confirmation = true;
		$d['email'] = $newSubscriber->email;
	    $erro->ck = subscribers::insertSubscriber($newSubscriber, $subscriberId);

	if (!$erro->Eck(__LINE__ , '8280')) {
		$erro->ck = subscribers::getSubscriberIdFromEmail($d);
		if ($erro->Eck(__LINE__ , '8270')) {
			$confirmation = false;
		} else {
			return acajoom::printM('blue' , _ACA_ERROR);
		}
	}

	if ($GLOBALS[ACA.'require_confirmation'] AND $confirmation AND (!$confirm)) {
		$erro->ck = acajoom_mail::sendConfirmationEmail($subscriberId);
		$erro->Eck(__LINE__ , '8281');
	}

	$erro->ck = queue::updateOneSuscription($subscriberId);
	if (!$erro->Eck(__LINE__ ,  '8272')) {
		return acajoom::printM('blue' , _ACA_ERROR);
	}


	if ($GLOBALS[ACA.'require_confirmation']  AND $confirmation AND (!$confirm)) {
		$queues = queue::getSubscriberLists($subscriberId);
		$qids = acajoom::convertObjectToIdList($queues , 'qid');
		$erro->ck = queue::updateSuspend($qids, 1);
		if (!$erro->Eck(__LINE__ ,  '8273')) {
			return $erro->mess;
		}
		$message = acajoom::printM('blue' , _ACA_COMFIRM_SUBSCRIPTION);
	} else {
		$message = acajoom::printM('green' , _ACA_SUCCESS_ADD_LIST);
	}

   	return $message;
   }



	 function subscriptions($subscriberId, $listId, $action) {
		global $Itemid;

			if (!empty($subscriberId)) {
				$qid[0] = $subscriberId;
			    $subscriber = subscribers::getSubscribersFromId($qid, false);
			    $queues = queue::getSubscriberLists($subscriberId);
			} else {
				$subscriber->id =  '' ;
				$subscriber->user_id =  0 ;
				$subscriber->name =  '' ;
				$subscriber->email =  '' ;
				$subscriber->receive_html =  1 ;
				$subscriber->confirmed =  1;
				$subscriber->blacklist =  0;
				$subscriber->timezone = '00:00:00';
				$subscriber->language_iso = 'eng';
				$newSubscriber->params = '';
				$subscriber->subscribe_date = acajoom::getNow();
            	$queues = '';
			}


			if ($subscriber->user_id>0) {
				$access = acajoom::checkPermissions('admin', $subscriber->user_id);
			} else {
				$access = false;
			}

			$lists = lists::getLists($listId, 0, $subscriberId, '', false , true, false);
			$doShowSubscribers = false;
			if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
			$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom') . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
			$forms['select'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act='.$action) . '"  name="AcajoomFilterForm">';
			} else {
			$forms['main'] = '<form method="post" action="index.php?option=com_acajoom" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
			$forms['select'] = '<form method="post" action="index.php?option=com_acajoom&act=' . $action.'"  name="AcajoomFilterForm">';
			}

			$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
			$forms['select'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';

			frontHTML::formStart( _ACA_SUBSCRIPTIONS, 0, 'name_email');
		    echo subscribersHTML::editSubscriber($subscriber, $lists, $queues, $forms, $access, true, false );
			$go[] = acajoom::makeObj('act', $action);
			$go[] = acajoom::makeObj('subscriber_id', $subscriber->id);
			$go[] = acajoom::makeObj('user_id', $subscriber->user_id);
			frontHTML::formEnd(_ACA_SAVE, $go);

   return true;
   }




	 function changeSubscriptions($subscriberId, $cle='', $listId, $action) {
		global $Itemid;

		if (!empty($subscriberId) AND !empty($cle)) {
			$qid[0] = $subscriberId;
		    $subscriber = subscribers::getSubscribersFromId($qid, false);
		    $confirmed = false;
		    if ( md5($subscriber->email) == $cle ) {
			    $queues = queue::getSubscriberLists($subscriberId);

				$confirmed = true;

				if ($subscriber->user_id>0) {
					$access = acajoom::checkPermissions('admin', $subscriber->user_id);
				} else {
					$access = false;
				}

				if ($subscriberId>0) $author = 0;
				$lists = lists::getLists($listId, 0, $subscriberId, '', false , true, false);
				$doShowSubscribers = false;
				if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
				$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom') . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
				$forms['select'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act=' . $action) . '"  name="AcajoomFilterForm">'."\n\r";
				} else {
				$forms['main'] = '<form method="post" action="index.php?option=com_acajoom" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
				$forms['select'] = '<form method="post" action="index.php?option=com_acajoom&act=' . $action.'"  name="AcajoomFilterForm">'."\n\r";
				}
				$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
				$forms['select'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
				$forms['main'] .= '<input type="hidden" name="confirmed" value="'.$confirmed.'" />';
				frontHTML::formStart( _ACA_SUBSCRIPTIONS, 0, 'name_email');
			    echo subscribersHTML::editSubscriber($subscriber, $lists, $queues, $forms, $access, true, false);
				$go[] = acajoom::makeObj('act', $action);
				$go[] = acajoom::makeObj('subscriber_id', $subscriber->id);
				$go[] = acajoom::makeObj('user_id', $subscriber->user_id);
				frontHTML::formEnd(_ACA_CHANGE_SUBSCRIPTIONS, $go);
				return true;
			} else {
			 	return false;
			}
		} else {
			return false;
		}

   }



	function confirmRegistration($d) {

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		if (!empty($d['subscriberId']) AND !empty($d['cle'])) {
			$qid[0] = $d['subscriberId'];
		    $subscriber = subscribers::getSubscribersFromId($qid, false);
		    if ( md5($subscriber->email) == $d['cle'] ) {
				$subscriber->confirmed = 1;
				$erro->ck = subscribers::updateSubscriber($subscriber, $notused);


				if ($erro->Eck(__LINE__ ,  '8275', $d)) {
					$queues = queue::getSubscriberLists($d['subscriberId']);
					$qids = acajoom::convertObjectToIdList($queues , 'qid');
					$erro->ck = queue::updateSuspend($qids, 0);
					return $erro->Eck(__LINE__ ,  '8276');
				}
		    }
		}
		return false;

   }


	 function remove($subscriberId, $cle='', $listId) {

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($subscriberId) AND !empty($cle) AND $listId>0) {
			$qid[0] = $subscriberId;
		    $subscriber = subscribers::getSubscribersFromId($qid, false);
		    if ( md5($subscriber->email) == $cle ) {

				$suscription = new stdClass;
				$suscription->user_id = $subscriberId;
				$suscription->sub_list_id[1] = $listId;
				$suscription->subscribed[1] = 0;
				$suscription->acc_level[1] = 0;

				$erro->ck = queue::updateSuscription($suscription);
				$erro->Eck(__LINE__ ,  '8277');
				$list = lists::getOneList($listId);
				if ($list->unsubscribesend ==1) {
					$erro->err = acajoom_mail::sendUnsubcribeEmail($subscriberId, $list);
					$erro->E(__LINE__ ,  '8278');
				}
			}
		}
		return $erro->R();
   }



	function unsubscribe($subscriberId, $cle='', $listId, $action) {
		global $Itemid;

		if (!empty($subscriberId) AND !empty($cle) AND $listId>0) {
			$qid[0] = $subscriberId;
		    $subscriber = subscribers::getSubscribersFromId($qid, false);
		    if ( md5($subscriber->email) == $cle ) {
			    $queues = queue::getSubscriberLists($subscriberId);
				$lists = lists::getLists($listId, 0 ,null,'', false, false, true);

				$list = $lists[0];
				if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
				$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom') . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
				} else {
				$forms['main'] = '<form method="post" action="index.php?option=com_acajoom" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
				}
				$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
				$link = ('index.php?option=com_acajoom&act=change&subscriber=' . $subscriberId . '&cle=' . $cle. '&listid=' . $listId .'&Itemid=' . $Itemid);

				frontHTML::formStart( _ACA_SUBSCRIPTIONS, 0, 'unsubscribe');
			    subscribersHTML::unsubscribe($subscriber, $list, $queues, $action, $forms);
				frontHTML::formEndYesNo($link, $cle, $subscriberId, $listId);

			} else {
			 	return false;
			}
		} else {
			return false;
		}

   }



	 function showSubscriberLists($subscriberId, $action) {

		$lists = lists::getLists(0, 0, $subscriberId, '', false , true, false);

		if ($subscriberId==0) {
			$subscriber ='';
			$queues = '';
			subscribersHTML::showSubscriberLists($subscriber, $lists, $queues, true);
		} else {
			frontEnd::subscriptions($subscriberId, 0, 'save');
		}
	    return true;
   }



	 function showMailingsFront( $task, $action, $subscriberId, $listId, $listType, $viewArchive, $pageTile) {
		global $Itemid, $my;

		 $start = mosGetParam($_REQUEST, 'start', 0);
		 //ADRIEN
		 //$limit = mosGetParam($_REQUEST, 'limit', $GLOBALS['mosConfig_list_limit']);
		 $limit = -1;
		 $emailsearch = mosGetParam($_REQUEST, 'emailsearch', '');
		 $order = mosGetParam($_REQUEST, 'order', 'idD');
 	     $total = 0;
		 $dropList = mosGetParam($_REQUEST, 'droplist', 'ZZZZ');
		 if ($dropList=='ZZZZ') $dropList = $listType .'-'. $listId;
 	     $total = 0;

		$dropListValues = explode ('-', $dropList);
		$listType = $dropListValues[0];
		$listId = $dropListValues[1];

		if ( class_exists('pro') && $listId>0 ) {
			$list = lists::getOneList($listId);
			$accessGrant = acajoom::checkPermissions('hello', 0, $list->acc_level );
		} else {
			$accessGrant = acajoom::checkPermissions('admin');
		}

		if ( $accessGrant ) {
			if ($listId>0) {
				$mailings = xmailing::getMailings($listId, 0, $start, $limit, $emailsearch, $total, $order, false, $viewArchive);
			} else {
				$mailings = xmailing::getMailings($listId, $listType, $start, $limit, $emailsearch, $total, $order, false, $viewArchive);
			}
		} else {
			if ($listType==1 OR $listType==2 OR $listType==7) {
				$mailings = xmailing::getMailings($listId, 0, $start, $limit, $emailsearch, $total, $order, true, $viewArchive);
			} elseif ($listType==0) {
				$mailings1 = xmailing::getMailings($listId, 1, $start, $limit, $emailsearch, $total, $order, true, $viewArchive);
				$mailings2 = xmailing::getMailings($listId, 2, $start, $limit, $emailsearch, $total, $order, true, $viewArchive);
				$mailings7 = xmailing::getMailings($listId, 7, $start, $limit, $emailsearch, $total, $order, true, $viewArchive);
				$mailings = array_merge($mailings1, $mailings2, $mailings7);
			} else {
				$mailings = '';
			}
		}

		if ($listId==0) {
	      $lists['title'] = lisType::chooseType($task, $action, $listType , 'titles', '', _ACA_MENU_MAILING);
	   } else {
			$listing = lists::getLists($listId, 0, $subscriberId, '', false, false, true);
			$listType = ( $listType>0 ) ? $listType : '0' ;
			$lists['title'] =  $pageTile .@constant( $GLOBALS[ACA.'listname'.$listType] );
	   }

		$dropDownList = lisType::getMailingDropList($listId, $listType, $order);
		$lists['droplist'] = mosHTML::selectList($dropDownList, 'droplist', 'class="inputbox" size="1" onchange="document.AcajoomFilterForm.submit();"', 'id', 'name', $dropList );
		if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
		$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act=' . $action) . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
		$forms['select'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act=' . $action) . '"  name="AcajoomFilterForm">'."\n\r";
		} else {
		$forms['main'] = '<form method="post" action="index.php?option=com_acajoom&act=' . $action. '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
		$forms['select'] = '<form method="post" action="index.php?option=com_acajoom&act=' . $action. '"  name="AcajoomFilterForm">'."\n\r";
		}
		$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
		$forms['select'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';

		$show = lisType::showType($listType , 'showMailings');
		$show['index'] = 'index';
		$show['select']= false;
		$show['buttons'] = true;

		if ( class_exists('pro') && !$viewArchive) {
			$show['admin'] = true;
			$show['status'] = true;
		}

		frontHTML::formStart( $lists['title'] , 0, 'show_mailing');
		mailingsHTML::showMailingList($mailings, $lists, $start, $limit, $total, $emailsearch, $listId, $listType, $forms, $show, $action );
		frontHTML::formEnd();

	    return true;
   }



	 function mailingEdit($subscriberId, $mailingId, $listId, $listType, $action) {
		global $my, $Itemid;

		$accessGrant = false;
		$new=0;
		if ( class_exists('pro') ) {
			$issue_nb = mosGetParam($_REQUEST, 'issue_nb', 0);
 			if ($issue_nb == 0) {
 				$issue_nb = xmailing::countMailings($listId, '');
				$issue_nb++;
 			}

			if ($listId>0) {
				$list = lists::getOneList($listId);
				$mailing = xmailing::getOneMailing($list, $mailingId, $issue_nb, $new);
				$acc_level = $list->acc_level;
			} else {
				return false;
			}

			if ( acajoom::checkPermissions('hello',0, $acc_level ) ) $accessGrant = true;

		} else {
			if ($subscriberId<>0 AND ($my->usertype == 'Administrator'
			OR $my->usertype == 'Super Administrator' ) ) {
				$accessGrant = true;
			}
		}

		if ( $accessGrant ) {

			$issue_nb = mosGetParam($_REQUEST, 'issue_nb', 0);
 			if ($issue_nb == 0) {
 				$issue_nb = xmailing::countMailings($listId, '');
				$issue_nb++;
 			}

			if ( empty($mailing) ) {
				if ($mailingId>0 ) {
					$mailing = xmailing::getOneMailing('', $mailingId, $issue_nb, $new);
				} else if ($listId>0) {
					$list = lists::getOneList($listId);
					$mailing = xmailing::getOneMailing($list, $mailingId, $issue_nb, $new);
				} else {
					return false;
				}
			}

			if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
			$forms['main'] = '<form method="post" enctype="multipart/form-data" action="'. sefRelToAbs('index.php?option=com_acajoom&act=savemailing') . '" onsubmit="submitbutton();return false;" name="adminForm" >'."\n\r";
			} else {
			$forms['main'] = '<form method="post" enctype="multipart/form-data" action="index.php?option=com_acajoom&act=savemailing" onsubmit="submitbutton();return false;" name="adminForm" >'."\n\r";
			}
			$forms['main'] .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
			$show = lisType::showType($mailing->list_type , 'editmailing');

    	    frontHTML::formStart( _ACA_EDIT_A. @constant( $GLOBALS[ACA.'listname'.$mailing->list_type] ) ,$mailing->html, 'edit_mailing');
			mailingsHTML::editMailing($mailing, $new, $listId, $forms, $show);
			$go[] = acajoom::makeObj('act', $action);
			frontHTML::formEnd( _CMN_SAVE .' '. @constant( $GLOBALS[ACA.'listname'.$mailing->list_type] ), $go);
		} else {
		 	echo acajoom::printM('red' , _NOT_AUTH);
		}

	    return true;
   }


 }

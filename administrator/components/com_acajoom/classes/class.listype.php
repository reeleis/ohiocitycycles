<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

 class lisType {

	 function chooseType($task, $action, $listType , $actionType, $message='', $title='') {

		$results = '';
		switch ($actionType) {
			case 'titles':
				if ($listType>0) {
			      	$results = $title._ACA_ALL.' '.@constant( $GLOBALS[ACA.'listnames'.$listType] );
				} else {
			      	$results = _ACA_MAILING_ALL;
				}
				break;
			case 'mailing_header':
				if ($listType>0) {
				backHTML::_header( @constant( $GLOBALS[ACA.'listnames'.$listType] ) , $GLOBALS[ACA.'listlogo'.$listType] , $message , $task, $action  );
				} else {
				backHTML::_header( _ACA_MAILING_ALL , $GLOBALS[ACA.'listlogo'.$listType] , $message  , $task, $action );
				}
				break;
			case 'mailing_edit_header':
				backHTML::_header( _ACA_EDIT_A.@constant( $GLOBALS[ACA.'listname'.$listType] ) , $GLOBALS[ACA.'listlogo'.$listType] , $message, $task, $action );
				break;
			default:
				$results = 'not prossible case , or not yet implemented';
			break;
		}
   return $results;
   }

	 function sendType($lisType) {
		if ($lisType==1) {
			return true;
		} else {
			return false;
		}
   }


	 function getListsDropList($listId, $listType, $order) {
		$lists = '';
		$lists[0]->list_name = _ACA_SEL_ALL_SUB;
		$lists[0]->id = 0;
		$lt = array_merge( $lists, lists::getLists(0, $listType, 1,$order, false, false, true));
      return $lt;
	 }


	 function getMailingDropList($listId, $listType, $order) {

		$lists = '';
		$i=0;
		$flag = array();
		$lists[0]->name = _ACA_SEL_ALL ;
		$lists[0]->id = '0-0';

		$nb = explode(',', $GLOBALS[ACA.'activelist']);

		$size = sizeof($nb);
		for($k = 0; $k < $size; $k ++) {
			$index = $nb[$k];
			if ($listType==$index OR ($GLOBALS[ACA.'listype'.$index] ==1 AND $GLOBALS[ACA.'totallist'.$index] >0)) {
				$i++;
				$lists[$i]->name = _ACA_ALL.' '.@constant( $GLOBALS[ACA.'listnames'.$index] );
				$lists[$i]->id = $index.'-0';
				$flag[$index] = 0;
			}
		}

		if ($listId>0) {
			$i++;
			$getList = lists::getLists($listId, 0, 1, $order, false, false, false);
			$lists[$i]->name = $getList[0]->list_name;
			$lists[$i]->id = $getList[0]->list_type.'-'.$getList[0]->id;
		} else {
			if ($listType==0) {
				$getLists = lists::getLists(0, 0, 1, 'listype_name', false, false, false);
			} else {
				$getLists = lists::getLists(0, $listType, 1, $order, false, false, false);
			}

			foreach ($getLists as $getList) {
				$size = sizeof($nb);
				for($k = 0; $k < $size; $k ++) {
					$index = $nb[$k];
					if ($getList->list_type == $index AND !$flag[$index] AND $GLOBALS[ACA.'listype'.$index] ==1 AND $GLOBALS[ACA.'totallist'.$index] > 0) {
						$i++;
						$lists[$i]->name = '-- '.@constant( $GLOBALS[ACA.'listnames'.$index] ).' --';
						$lists[$i]->id =  $index.'-0';
						$flag[$index] = true;
					}
				}

				if ($GLOBALS[ACA.'listype'.$getList->list_type]) {
					$i++;
					$lists[$i]->name = $getList->list_name;
					$lists[$i]->id = $getList->list_type.'-'.$getList->id;
				}
			}
		}

      return $lists;

	 }

	 function showType($listType , $screen) {

		switch ($screen) {
			case 'editmailing':
				if (class_exists($GLOBALS[ACA.'classes'.$listType])) {
					$view = new $GLOBALS[ACA.'classes'.$listType];
					$show = $view->editmailing();
				} else {
					$show['sender_info'] = true;
					$show['published'] = true;
					$show['pub_date'] = true;
					$show['hide'] = true;
					$show['issuenb'] = true;
					$show['delay'] = false;
					$show['htmlcontent'] = true;
					$show['textcontent'] = true;
					$show['attachement'] = true;
					$show['images'] = true;
					$show['sitecontent'] = true;
					$show['admin'] = true;
				}
				break;
			case 'editlist':

				$show['access'] = ( $GLOBALS[ACA.'type'] =='PRO' ) ? true : false;
				if (class_exists($GLOBALS[ACA.'classes'.$listType])) {
					$view = new $GLOBALS[ACA.'classes'.$listType];
					$show = array_merge($show, $view->editlist());
				} else {
					$show['sender_info'] = true;
					$show['hide'] = true;
					$show['auto_option'] = true;
					$show['htmlmailing'] = true;
					$show['auto_subscribe'] = true;
					$show['email_unsubcribe'] = false;
					$show['unsusbcribe'] = false;
				}
				break;
			case 'showMailings':
				$show['admin'] = acajoom::checkPermissions('admin');
				$show['index'] = 'index2';
				$show['buttons'] = false;
				if ($show['admin']) {
					if (class_exists($GLOBALS[ACA.'classes'.$listType])) {
						$view = new $GLOBALS[ACA.'classes'.$listType];
						$show = array_merge($show, $view->showMailings());
					} else {
						$show['id'] = true;
						$show['dropdown'] = true;
						$show['select'] = true;
						$show['issue'] = true;
						$show['sentdate'] = true;
						$show['delay'] = false;
						$show['status'] = true;
					}
				} else {
					$show['id'] = false;
					$show['dropdown'] = false;
					$show['select'] = false;
					$show['issue'] = true;
					$show['sentdate'] = true;
					$show['delay'] = false;
					$show['status'] = false;
				}
				break;
			case 'showListsBack':
				if (acajoom::checkPermissions('admin')) $show['id'] = true; else $show['id'] = false;
				$show['index'] = 'index2';
				$show['select'] = true;
				$show['published'] = true;
				$show['sender'] = true;
				$show['sender_email'] = false;
				$show['mailings_link'] = true;
				$show['mailings_sub'] = true;
				$show['list_type'] = true;
				$show['visible'] = true;
				$show['buttons'] = false;
				$show['front'] = false;
			break;
			case 'showListsFront':
				if (acajoom::checkPermissions('admin')) {
					$show['id'] = true;
					$show['published'] = true;
					$show['sender'] = true;
					$show['sender_email'] = false;
					$show['list_type'] = true;
					$show['visible'] = true;
					$show['mailings_sub'] = false;
					$show['mailings_link'] = true;
					$show['front'] = true;
				} else {
					$show['id'] = false;
					$show['published'] = false;
					$show['sender'] = false;
					$show['sender_email'] = false;
					$show['list_type'] = false;
					$show['visible'] = false;
					$show['mailings_sub'] = false;
					$show['mailings_link'] = false;
					$show['front'] = true;
				}
				$show['index'] = 'index';
				$show['select'] = false;
				$show['buttons'] = true;
			break;
			default:
				$show ='';
				break;
		}

		return $show;
	}

	 function checkOthers() {

		$status = false;

		$nb = explode(',', $GLOBALS[ACA.'activelist']);

		$size = sizeof($nb);
		for($k = 0; $k < $size; $k ++) {
			$index = $nb[$k];
			if ($GLOBALS[ACA.'listype'.$index] ==1 AND $index!=1 ) {
				$status = true;
			}
		}

		return $status;
	}



	 function getQueue($lisType) {

		if (class_exists($GLOBALS[ACA.'classes'.$lisType])) {
			$view = new $GLOBALS[ACA.'classes'.$lisType];
			return $view->getQueue();
		} else {
			return ' AND `published`= 1 ';
		}
	}


	 function getListOption() {

		$flag = false;
		$lists_option='';
		$nb = explode(',', $GLOBALS[ACA.'activelist']);
		$size = sizeof($nb);
		for($i = 0; $i < $size; $i ++) {
			$index = $nb[$i];
			if ($index==2)  $flag = true;
			if ($GLOBALS[ACA.'listshow'.$index]>0 AND $GLOBALS[ACA.'listype'.$index] == 1) {
				$dont = true;

				if ($dont) {
					$obj = new stdClass;
					$obj->value = $index;
					$obj->text = trim( $GLOBALS[ACA.'listname'.$index] ) ? @constant( $GLOBALS[ACA.'listname'.$index] ): '';
					$obj->dis = false;
					$lists_option[] = $obj;
				}
			}
		}
		if ( !$flag ) {
			$obj = new stdClass;
			$obj->value = 2;
			$obj->text = _ACA_AUTORESP;
			$obj->dis = true;
			$lists_option[] = $obj;
		}

		return $lists_option;
	}


	 function sendLogs($listType) {

		switch ($listType) {
			case '1':
			case '7':
				return true;
				break;
			case '2':
				if ($GLOBALS[ACA.'send_auto_log'] == 1) return true; else return false;
				break;
			default:
				return false;
			break;
		}
	}


	 function updateNewsletters() {

		if (empty($GLOBALS[ACA.'queuedate'])) {
			$updateTime = mktime(date("H"), date("i"), date("s"), date("m"), date("d")-7 ,  date("Y"));
			$upDate = date( 'Y-m-d H:i:s', $updateTime );
			if ($upDate > $GLOBALS[ACA.'date_update']) {
				$update = new wupdate();
				$update->checkNewVersion();
			}
		}
   }


 }

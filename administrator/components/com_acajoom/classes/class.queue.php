<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
class queue {

	 function sendNewsletter( $showHTML, $mailingId, $listId, $receivers, &$message , $tags = null) {

		$list = lists::getOneList($listId);
		$mailing = xmailing::getOneMailing($list, $mailingId, '', $new);

		xmailing::_header('', '', $list->list_type , '', '');
		$check = acajoom_mail::send($showHTML ,$mailing, $receivers, $list, $message , $tags );
		if ($check) xmailing::updateNewsletterSent($mailingId);

		return 	$check;
	 }


	 function getSubscriberLists($userId) {
		global $database;

		if ($userId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_queue` WHERE `subscriber_id`='.$userId;
			$query .= acajoom::orderBy('list_idA');

			$database->setQuery($query);
			$queue = $database->loadObjectList();
			$erro->err = $database->getErrorMsg();

			return $erro->Ertrn( __LINE__ , '8500', $database, $queue );

		}else {
			return '';
		}
	 }


	 function getAllOneList($listId) {
		global $database;

		if ($listId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_queue` WHERE `list_id`='.$listId.' ORDER BY `qid` ';
			$database->setQuery($query);
			$queue = $database->loadObjectList();
			$erro->err = $database->getErrorMsg();

			return $erro->Ertrn( __LINE__ , '8501', $database, $queue );
       }
	 }


	 function whatQID( $mailingId, $subId, $lisType ) {
		global $database;

		if ( $mailingId>0 AND $subId>0 ) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT `qid` FROM `#__acajoom_queue` WHERE `mailing_id`='.$mailingId;
			$query .= ' AND `subscriber_id`='.$subId;
			$query .= ' AND `type`='.$lisType;
			if ($lisType=='1') $query .= ' AND `published`=2';
			$database->setQuery($query);
			$qid = $database->loadResult();
			$erro->err = $database->getErrorMsg();

			return $erro->Ertrn( __LINE__ , '8555', $database, $qid );
       }
	 }


	 function getQueueFromMailingId($mailingId) {
		global $database;

		if ($mailingId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_queue` WHERE `mailing_id`='.$mailingId.' ORDER BY `qid` ';
			$database->setQuery($query);
			$queues = $database->loadObjectList();
			$erro->err = $database->getErrorMsg();

			return $erro->Ertrn( __LINE__ , '8502', $database, $queues );
		} else {
			return '';
		}
	 }



	 function getValidMailing(&$list, $mailingId) {

		$listId = $list->id;
		$ready = false;
	     do {
				if ($mailingId<1) {
					$mailingId = xmailing::getFirstMailingId($listId);
					if (empty($mailingId)) return '';
				}

				$mailing = xmailing::getOneMailing('', $mailingId, '', $new);
				if (!empty($mailing)) {
					if ($mailing->published == 1) {
						$newMailing = $mailing;
						$ready = true;
					} else {
						$newIssueNb = $mailing->issue_nb;
						$noMoreMailing = false;
						do {
								$newIssueNb++;
								$newMailing = xmailing::getQuickMailingIssue($listId, $newIssueNb, $total);
								if (empty($newMailing)) {
									$noMoreMailing = true;
									$newMailing->published = 0;
								}
						} while ( ($newMailing->published <> 1) AND ($newIssueNb < $total ) AND ($noMoreMailing == false) );

						if ((( $newIssueNb == $total) AND ($newMailing->published <> 1)) OR ($noMoreMailing == true)) {

							if ($list->follow_up > 0  AND $list->list_type=='2' ) {
								$list = lists::getOneList($list->follow_up);
								if (!empty($list)) {
									if ($list->list_type == 2) {
										$mailingId = xmailing::getFirstMailingId($list->id);
									} else {
										$newMailing = '';
										$newMailing->list_type = 1;
										$newMailing->list_id = $list->id;
							           	$ready = true;
									}
								} else {
					           	$newMailing = '';
								$ready = true;
								}
							} else {
					           	$newMailing = '';
								$ready = true;
							}
						} else {

							$ready = true;
						}
					}
				} else {
					$ready = true;
					$newMailing = '';
				}
	    } while (!$ready);

      return $newMailing;
	 }


	 function updateQueues($subId, $qids, $listId, $acc_level, $new) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$list = lists::getOneList($listId);
		if ($list->list_type == 1) {
	        if ($new) {
	            	if (!empty($subId)) {
	            		$erro->ck = queue::insertQueuesForNews($subId, $listId, $acc_level);
						$erro->Eck(__LINE__ , '8504' );
	            	} else {

					if ( !empty($qids) ) {
						$qid = implode( ',' , $qids );
						$query = 'SELECT `subscriber_id` FROM `#__acajoom_queue` WHERE `qid` IN ( '.$qid.' ) ' ;
						$database->setQuery($query);
						$subIds = $database->loadObjectList();
						$erro->err = $database->getErrorMsg();
			       }
						foreach ($subIds as $v ) {
							$subId[]=$v->subscriber_id;
						}

	            		$erro->ck = queue::insertQueuesForNews($subId, $listId, $acc_level);
						$erro->E(__LINE__ , '8505' );
	            	}
	        } else {
	            	if (!empty($subId)) {
						$erro->ck = queue::updateQueueData('', $subId, 0, $listId, 0, 0, 0, 0, $acc_level, 0);
						$erro->Eck(__LINE__ , '8506' );
	            	} elseif (!empty($qids)) {
	            		$erro->ck = queue::updateQueueData($qids , '', 0, $listId, 0, 0, 0, 0, $acc_level, 0);
						$erro->Eck(__LINE__ , '8507' );
	            	}
	        }
		} elseif ($list->list_type == 7) {

    		$newQueue->list_id = $list->id;
    		$newQueue->mailing_id = 0;
    		$newQueue->issue_nb = 0;
    		$newQueue->send_date = 0;
    		$newQueue->delay = 0;
    		$newQueue->acc_level = $acc_level;
    		$newQueue->published = $list->published;
    		$erro->ck = autonews::insertQueuesForAutoNews($subId, $newQueue);
			$erro->Eck(__LINE__ , '8508' );
		} else {
		        if ($new) {
		            	if (!empty($subId)) {
		            		$mailingId = 0;
		            		$mailing = queue::getValidMailing($list, $mailingId);

		            		if (!empty($mailing)) {
								if (class_exists('auto')) {
			            			if ($mailing->list_type == 2) {
					            		$newQueue->list_id = $mailing->list_id;
					            		$newQueue->mailing_id = $mailing->id;
					            		$newQueue->issue_nb = $mailing->issue_nb;
					            		$newQueue->send_date = acajoom::getNow();
					            		$newQueue->delay = $mailing->delay;
					            		$newQueue->acc_level = $acc_level;
					            		$newQueue->published = $list->published;
					            		$erro->ck = auto::insertQueuesForAuto($subId, $newQueue);
										$erro->Eck(__LINE__ , '8508' );
			            			}	else {
			            				$erro->ck = queue::insertQueuesForNews($subId, $mailing->list_id, $acc_level);
										$erro->Eck(__LINE__ , '8509' );
			            			}
		            			}
		            		} else {
								if (class_exists('auto')) {
				            		$newQueue->list_id = $list->id;
				            		$newQueue->mailing_id = 0;
				            		$newQueue->issue_nb = 0;
				            		$newQueue->send_date = 0;
				            		$newQueue->delay = 0;
				            		$newQueue->acc_level = $acc_level;
				            		$newQueue->published = $list->published;
				            		$erro->ck = auto::insertQueuesForAuto($subId, $newQueue);
									$erro->Eck(__LINE__ , '8510' );
		            			}
		            		}
		            	} elseif (!empty($qids)) {
		            		$mailingId = xmailing::getFirstMailingId($listId);
		            		if (!empty($mailingId)) {
		            			$mailing = queue::getValidMailing($list, $mailingId);
			            		if (!empty($mailing)) {
			            			if ($mailing->list_type == 2) {
					            		$subscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , $listId, '', 1, 1,'' );
	      								$subId = acajoom::convertObjectToIdList($subscribers , 'id');
										if (!empty($subId)) {
						      				$erro->ck = queue::updateQueueData( '', $subId, 1, $listId, $mailing->id, $mailing->issue_nb, 0, $mailing->delay, 0, 1);
											$erro->Eck(__LINE__ , '8511' );
										}
			            			}	else {

					            		$subscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , $listId, '', 1, 1,'' );
	      								$subId = acajoom::convertObjectToIdList($subscribers , 'id');
			            				$erro->ck = queue::insertQueuesForNews($subId, $mailing->list_id, $acc_level);
										$erro->Eck(__LINE__ , '8512' );
			            			}
			            		}
		            		}
		            	}
		        } else {
		            	if (!empty($subId)) {
							$mailing = queue::getValidMailing($list, 0);
							if (!empty($mailing)) $erro->ck = queue::updateQueueData( '', $subId, $list->list_type , $listId, '', '', 0, '', 0, $list->published );
							else $erro->ck = queue::updateQueueData('', $subId, $mailing->list_type, $mailing->list_id,
								 $mailing->id, $mailing->issue_nb, acajoom::getNow(), $mailing->delay, $acc_level, $mailing->published);
							$erro->E(__LINE__ , '8513' );
		            	} elseif (!empty($qids)) {
		            			$mailing = queue::getValidMailing($list, 0);
			            		if (!empty($mailing)) {
			            			if ($mailing->list_type == 2) {
			            				$erro->ck = queue::updateQueueData( $qids, '', $list->list_type , $listId, $mailing->id, $mailing->issue_nb, acajoom::getNow(), $mailing->delay, 0, 1);
										$erro->E(__LINE__ , '8514' );
			            			}	else {

			            				$subId = acajoom::convertObjectToIdList($qids , 'subscriber_id');
			            				$erro->ck = queue::deleteQueues($qids);
										$erro->Eck(__LINE__ , '8515' );
			            				$erro->ck = queue::insertQueuesForNews($subId, $mailing->list_id, $acc_level);
										$erro->Eck(__LINE__ , '8516' );
			            			}
			            		}
		            	}
		        }
		}
      return $erro->R();
	 }


	 function updateOneSuscription($subscriberId) {
 		global $acl, $database;
		$queue = '';
		$queue->user_id = $subscriberId;

		$listId = mosGetParam($_REQUEST, 'listid', 0);

		if ( !empty($listId) ) {
			$accessName = '';
			$userid = intval(mosGetParam($_REQUEST, 'userid', 0));
			$query = "SELECT usertype "
			. "\n FROM #__users"
			. "\n WHERE id = " . (int) $userid
			;

			$database->setQuery( $query );
			$accessName = $database->loadResult();

			//$accessName = strtolower(mosGetParam($_REQUEST, 'access', 'Public Frontend'));
			$groupId = $acl->get_group_id($accessName , 'ARO');

			if(empty($groupId)){$groupId = 29;}

			$idslists = explode(",", $listId);
			foreach($idslists as $i => $listId){
				$listId = intval($listId);
				if($listId<=0) break;

				$list = lists::getOneList($listId);
				if ( empty($list)) {
					echo acajoom::printM('red' , 'List not defined' );
					return false;
				}
				$ex_groups = $acl->get_group_children( $list->acc_id , 'ARO',  'RECURSE' );
				$ex_groups[] = $list->acc_id;
				$gidAdmin = $acl->get_group_id( 'Public Backend' , 'ARO' );

				if ( !in_array( $gidAdmin , $ex_groups ) ) {
					$ex_groups2 = $acl->get_group_children( $gidAdmin , 'ARO',  'RECURSE' );
					$ex_groups2[] = $gidAdmin;
					$ex_groups = array_merge( $ex_groups, $ex_groups2 );
				}

				if ( !in_array( $groupId, $ex_groups ) ) {
					echo acajoom::printM('red' , ACA_NO_LIST_PERM );
					return false;
				}

				$queue->sub_list_id[$i] = $listId;
				$queue->subscribed[$i] = 1;
				$queue->acc_level[$i] = $list->acc_id;
			}

		} else {
			$queue->sub_list_id = mosGetParam($_REQUEST, 'sub_list_id', '');
			$queue->subscribed = mosGetParam($_REQUEST, 'subscribed', 0);
			if($queue->subscribed == 0) {
				/*$queue->subscribed = $queue->sub_list_id;
				for($i=1;$i<=count($queue->sub_list_id);$i++){
					$queue->subscribed[$i] = 0;
				}*/
				$queue->subscribed = array();
				if(!empty($queue->sub_list_id)){
					foreach($queue->sub_list_id as $key=>$value){
						$queue->subscribed[$key] = 0;
					}
				}
			}

			$queue->acc_level = intval(mosGetParam($_REQUEST, 'acc_level', 29));
			if(!empty($queue->sub_list_id)){
				foreach($queue->sub_list_id as $key=>$value){
					if(empty($queue->subscribed[$key]) or $queue->subscribed[$key] != 1){
						$queue->subscribed[$key] = 0;
					}
				}
			}
			/*for($i=1;$i<=count($queue->sub_list_id);$i++){
				if($queue->subscribed[$i] != 1){
					$queue->subscribed[$i] = 0;
				}
			}*/
		}

		if (!empty($queue->subscribed) AND $subscriberId>0) {
			return queue::updateSuscription($queue);
		}
 		return true;
	 }


	 function updateSuscription($suscription) {
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		//$i = 0;
	  	//do  {
			//$i++;
		foreach($suscription->sub_list_id as $i=>$value){
			$queues = queue::suscriptionExist($suscription->user_id , $suscription->sub_list_id[$i]);
			if (!empty($queues)) {
				if (isset($suscription->subscribed[$i])) {
					if ( $suscription->subscribed[$i] == 0) {
						$erro->ck = queue::deleteSubsQueue($suscription->user_id , $suscription->sub_list_id[$i]);
						$erro->Eck(__LINE__ , '8520' );
					}  else {

						$updatedQueue = $queues;
						$updatedQueue->acc_level = $suscription->acc_level[$i];
						if ($queues->mailing_id<1) {
							$mailingId = xmailing::getFirstMailingId($queues->list_id);
							if (!empty($mailingId)) {
								$list = lists::getOneList($queues->list_id);
								$mailing = queue::getValidMailing($list, $mailingId);
								if (!empty($mailing)) {
									$updatedQueue->type = $mailing->list_type;
									$updatedQueue->list_id = $list->id;
									$updatedQueue->mailing_id = $mailing->id;
									$updatedQueue->published = $list->published;
									$updatedQueue->send_date = acajoom::getNow();
									if ($mailing->list_type == 1 OR $mailing->list_type == 7) {
										$updatedQueue->issue_nb = 0;
										$updatedQueue->send_date = '0000-00-00 00:00:00';
										$updatedQueue->delay = 0;
									} else {
										$updatedQueue->issue_nb = $mailing->issue_nb;
										$updatedQueue->send_date = acajoom::getNow();
										$updatedQueue->delay = $mailing->delay;
									}
								}
							}
							$qid = '';
							$qid[0] = $updatedQueue->qid;
							$erro->ck = queue::updateQueueData($qid, '',  $updatedQueue->type, $updatedQueue->list_id, $updatedQueue->mailing_id,
								 $updatedQueue->issue_nb, $updatedQueue->send_date, $updatedQueue->delay, $updatedQueue->acc_level, $updatedQueue->published);
							$erro->Eck(__LINE__ , '8521' );
						} else {
							queue::updateAccessLevel($updatedQueue);
						}
					}
				}
			} else {
				if (isset($suscription->subscribed[$i])) {
					if ( $suscription->subscribed[$i] == 1) {

			       	     $subId = array();
						 $subId[0]=$suscription->user_id;
						 $subList = ( isset($suscription->sub_list_id[$i]) ) ? $suscription->sub_list_id[$i] : 0;
						 $subLevel = ( isset($suscription->acc_level[$i]) ) ? $suscription->acc_level[$i] : 29;
					   	 $erro->ck = queue::updateQueues($subId, '', $subList , $subLevel , true);
						$erro->Eck(__LINE__ , '8522');
					}
				}
			}
	  	} //while (count($suscription->sub_list_id ) > $i );
      return $erro->R();
	 }


	 function updateAccessLevel($queue) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($queue) and !empty($queue->acc_level) and !empty($queue->qid)) {
		   $query = 'UPDATE `#__acajoom_queue` SET
		 			`acc_level` = ' . $queue->acc_level . '
		 			WHERE `qid` = ' . $queue->qid . ';';
	 	  $database->setQuery($query);
		  $database->query();
		  $erro->err = $database->getErrorMsg();
		}

		return $erro->E(__LINE__ , '8525', $database );

	 }



	 function updateSuspend($qid, $value) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($qid)) {
			$qids = implode (',', $qid);
		    $query = "UPDATE `#__acajoom_queue` SET `suspend` =". $value . " WHERE `qid` IN ( $qids ) ";
		    if ($value == 0) $query .= " AND `suspend` =1"; else $query .= " AND `suspend` =0";

	 	  	$database->setQuery($query);
		  	$database->query();
		  	$erro->err = $database->getErrorMsg();

			return $erro->E(__LINE__ , '8527', $database );
		}
	    return true;
	 }


	 function updatePublished($qid, $value=0) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($qid)) {
			$qids = implode (',', $qid);
			$textVal = ($value) ? '1' : '0';
		    $query = "UPDATE `#__acajoom_queue` SET `published` = '$textVal' WHERE `qid` IN ( $qids ) ";
	 	  	$database->setQuery($query);
		  	$database->query();
		  	$erro->err = $database->getErrorMsg();

			return $erro->E(__LINE__ , '8529', $database );
		 }
	    return true;
	 }


	 function updateQueueData($qid, $subsId, $type, $listId, $mailingId, $issue, $date, $delay, $accLevel, $published) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($qid) OR !empty($subsId)) {
			$query = 'UPDATE `#__acajoom_queue` SET ';
			$query .= ' `type` = ' . $type . ',';
			$query .= ' `list_id` = ' . $listId . ',';
			if (!empty($mailingId)) $query .= ' `mailing_id` = ' . $mailingId . ',';
			if (!empty($date)) $query .= ' `send_date` = \'' . $date . '\', ' ;
			if (!empty($delay)) $query .= ' `delay` = ' . $delay . ' ,';
			if (!empty($issue)) $query .= ' `issue_nb` = ' . $issue . ' , ' ;
		 	if ($accLevel <>0)	$query .= '	`acc_level` = ' . $accLevel . ' ,' ;
		 	$query .= '	`published` = ' . $published;

			if (!empty($qid)) {
				$qids = implode (',', $qid);
			    $query .= ' WHERE `qid` IN ( '.$qids.' ) ';
			} else {
				$subsIds = implode (',', $subsId);
				if ($mailingId>0) {
					$query .= ' WHERE `subscriber_id` IN ( '.$subsIds.' ) AND `mailing_id` ='.$mailingId;
				} else {
				    $query .= ' WHERE `subscriber_id` IN ( '.$subsIds.' ) AND `list_id` ='.$listId;
				}
			}
	 	 	$database->setQuery($query);
		 	$database->query();
			$erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8532', $database );
		}
		return $erro->R();
	 }


	 function insertQueuesForNews($subId, $listId, $acc_level ) {

		$status = true;
		for ($k=0 ;$k < count($subId); $k++) {
            $queue = new stdClass;
            $queue->id = 0;
            $queue->subscriber_id = $subId[$k];
            $queue->list_id = $listId;
            $queue->type = 1;
            $queue->mailing_id = 0;
            $queue->send_date = '0000-00-00 00:00:00';
            $queue->suspend = 0;
            $queue->delay = 0;
            $queue->acc_level = $acc_level;
            $queue->issue_nb = 0;
            $queue->published = 0;
            $queue->params = '';
            if (!queue::insert($queue)) $status = false;
		}
		return $status;
	 }


	 function insertQidsForNews($subId, $listId, $acc_level ) {

		$status = true;
		for ($k=0 ;$k < count($subId); $k++) {
            $queue = new stdClass;
	        $queue->id = 0;
            $queue->subscriber_id = $subId[$k];
            $queue->list_id = $listId;
            $queue->type = 1;
            $queue->mailing_id = 0;
            $queue->send_date = '0000-00-00 00:00:00';
            $queue->suspend = 0;
            $queue->delay = 0;
            $queue->acc_level = $acc_level;
            $queue->issue_nb = 0;
            $queue->published = 0;
            $queue->params = '';
            if (!queue::insert($queue)) $status = false;
		}
		return $status;
	 }


	 function insert($queue) {
		global $database;

		if ($queue->list_id < 1) {
			$mailing = xmailing::getOneMailing( '' , $queue->mailing_id , 0 , $new );
			if(empty($mailing->list_id)) return false;
			$queue->list_id = $mailing->list_id ;
		}
		if ( $queue->subscriber_id<0 ) return false;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'INSERT INTO `#__acajoom_queue` (`type` , `subscriber_id` , `list_id` , `mailing_id`, `issue_nb`,' .
				' `send_date`, `suspend` , `delay`, `acc_level`, `published` , `params`	) VALUES ('
		. intval($queue->type) . ', '
		. intval($queue->subscriber_id) . ' , '
		. intval($queue->list_id) . ', '
		. intval($queue->mailing_id) . ', '
		. intval($queue->issue_nb) . ', \''
		. $queue->send_date . '\', '
		. $queue->suspend . ' , '
		. $queue->delay . ' , '
		. $queue->acc_level . ' , '
		. $queue->published
		." ,  '$queue->params'  ) ";
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ , '8534', $database );

	 }



	 function deleteQueues($qid) {
		global $database;
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($qid)) {
			$qids = implode (',', $qid);
			If (!empty( $qids )) {
				$query = "DELETE FROM `#__acajoom_queue` WHERE qid IN ( $qids ) " ;
				$database->setQuery($query);
				$database->query();
				$erro->err = $database->getErrorMsg();
				$erro->E(__LINE__ , '8536', $database );
			}
		}
        return $erro->R();
	 }


	 function deleteSubsQueue($subscriber_id , $listId) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if ($subscriber_id>0) {
			$query = 'DELETE FROM `#__acajoom_queue` WHERE `subscriber_id` = ' . $subscriber_id;
			if ($listId>0) $query .=' AND `list_id` ='.$listId;

			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8539', $database );

		}
        return $erro->R();
	 }


	 function suscriptionExist( $subscriber_id , $listId ) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if ( $subscriber_id>0 AND $listId>0 ) {
			if(is_array($subscriber_id)){
				$subscriber_id = implode (',', $subscriber_id);
			}
			$query = 'SELECT * FROM `#__acajoom_queue` WHERE `subscriber_id` IN ( ' . $subscriber_id
			.') AND `list_id` ='.$listId;
			$database->setQuery($query);
			$database->loadObject($queue);
			$erro->err = $database->getErrorMsg();
			return $erro->Ertrn(__LINE__ , '8541', $database, $queue );

		}
		return '';
	 }


 }
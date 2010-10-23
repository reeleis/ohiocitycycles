<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
class lists {

	function getLists($listId, $listType, $author=null, $order='listnameA', $autoAdd=false, $onlyPublished=true, $onlyName=false, $notification=false) {
        global $database, $my, $acl;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		if ($onlyName) $query = 'SELECT `id` AS id, `list_name` AS list_name, `list_desc` AS list_desc, `list_type` AS list_type FROM `#__acajoom_lists`';
		else $query = 'SELECT * FROM `#__acajoom_lists` ';
		$where = array();

		if ($listId>0) {
			$where[] = ' `id`='.intval($listId);
		}
		if ($listType>0) {
			$where[] = ' `list_type`='.intval($listType);
		}

		if ($autoAdd) $where[] = ' `auto_add`=1 ';
		if ($onlyPublished == true) $where[] = ' `published`=1 AND `hidden`=1 ';

		if (  class_exists('pro') && isset($author)) {

			$aro_id = ( isset($my->id) && $my->id>0 ) ? $acl->get_object_id( 'users', $my->id, 'ARO' ) : 1;

			$qacl = "SELECT `group_id` FROM `#__core_acl_groups_aro_map` WHERE `aro_id` =".$aro_id;
			$database->setQuery( $qacl );
			$gidd = $database->loadResult();
			$gidFront = $acl->get_group_id( 'Public Frontend' , 'ARO' );
			$gid = ( $gidd > 0 ) ? $gidd : $gidFront;

			$ex_groups = $acl->get_group_parents( $gid , 'ARO',  'RECURSE' );
			$gidAdmin = $acl->get_group_id( 'Public Backend' , 'ARO' );

			if ( in_array( $gidAdmin , $ex_groups ) ) {
				$ex_groups2 = $acl->get_group_children( $gidFront , 'ARO',  'RECURSE' );
				$ex_groups2[] = $gidFront;
				$ex_groups = array_merge( $ex_groups, $ex_groups2 );
			}
			$ex_groups[] = $gid;
			$ex_groups[] = 0;
			$accIds = implode( ',' , $ex_groups );
			$where[] = " `acc_id` IN ( $accIds ) ";
		}

		if (!$notification) $where[] = ' `notification`=0 ';

		$wheretag = (count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '');
		$query .= $wheretag;
		$query .= ( class_exists('acajoom') ) ? acajoom::orderBy($order) : '';

		$database->setQuery($query);
		$lists = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();

		if(!empty($lists)){
			foreach ($lists as $key => $list){
				$lists[$key]->list_name = stripslashes($lists[$key]->list_name);
				$lists[$key]->list_desc = stripslashes($lists[$key]->list_desc);
			}
		}

		if (!$erro->E(__LINE__ ,  '8300')) {
			return false;
		} else {
         return $lists;
       }
	}


	function getSpecifiedLists( $listIds, $useAccess=true ) {
		global $database, $my, $acl;

		$myexplode = explode( ',', $listIds );
		if ( !empty($myexplode) ) {
			foreach( $myexplode as $myexp ) {
				$escapedArray[] = intval($myexp);
			}//endif
		} else {
			$escapedArray = array();
			$escaped = '';
		}//endif

		$escaped = implode( ',', $escapedArray );

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		if ($listIds==0) {
			$query = "SELECT * FROM `#__acajoom_lists` WHERE `published` = 1 " ;
		} elseif (!empty($escaped)) {
			$query = "SELECT * FROM `#__acajoom_lists` WHERE `id` IN ( $escaped ) AND `published` = 1 " ;
		} else {
			return '';
		}

		if ( class_exists('pro') && $useAccess ) {

			$aro_id = ( isset($my->id) && $my->id>0 ) ? $acl->get_object_id( 'users', $my->id, 'ARO' ) : 1;

			$qacl = "SELECT `group_id` FROM `#__core_acl_groups_aro_map` WHERE `aro_id` =".$aro_id;
			$database->setQuery( $qacl );
			$gidd = $database->loadResult();
			$gidFront = $acl->get_group_id( 'Public Frontend' , 'ARO' );
			$gid = ( $gidd > 0 ) ? $gidd : $gidFront;

			$ex_groups = $acl->get_group_parents( $gid , 'ARO',  'RECURSE' );
			$gidAdmin = $acl->get_group_id( 'Public Backend' , 'ARO' );
			if ( in_array( $gidAdmin , $ex_groups ) ) {
				$ex_groups2 = $acl->get_group_children( $gidFront , 'ARO',  'RECURSE' );
				$ex_groups2[] = $gidFront;
				$ex_groups = array_merge( $ex_groups, $ex_groups2 );
			}
			$ex_groups[] = $gid;
			$ex_groups[] = 0;
			$accIds = implode( ',' , $ex_groups );
			$query .= " AND `acc_id` IN ( $accIds ) ";
			//only jack
//			if ( empty($gidd) ) $gidd = '0';
//			$query .= " AND `acc_level` IN ( $accIds ) ";
//			$where[] = " `acc_level` = $gid  ";

		}

		$database->setQuery( $query );
		$lists = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();

		if (!$erro->E(__LINE__ ,  '8301')) {
			$lists = '';
			echo 'Please specify a list to subscribe to in your module settings. <br /> If you have several lists to subcribe to please seperate them by a comma ,  ';
			return false;
		}

		if(!empty($lists)){
			foreach ($lists as $key => $list){
				$lists[$key]->list_name = stripslashes($lists[$key]->list_name);
				$lists[$key]->list_desc = stripslashes($lists[$key]->list_desc);
				$lists[$key]->layout = stripslashes($lists[$key]->layout);
				$lists[$key]->subscribemessage = stripslashes($lists[$key]->subscribemessage);
				$lists[$key]->unsubscribemessage = stripslashes($lists[$key]->unsubscribemessage);
			}
		}

		return $lists;
	}


	function getNotifLists( &$list, $type, $catId ) {
         global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		if ( $type!=0 AND $catId > 0 ) {
			$query = "SELECT * FROM `#__acajoom_lists` WHERE `notification` = $type  AND `notify_id` = $catId " ;
		} else {
			return false;
		}

		$database->setQuery($query);
		$list = $database->loadObjectList();
		if(!empty($list)){
			foreach ($list as $key => $listdetail){
				$list[$key]->list_name = stripslashes($list[$key]->list_name);
				$list[$key]->list_desc = stripslashes($list[$key]->list_desc);
				$list[$key]->layout = stripslashes($list[$key]->layout);
				$list[$key]->subscribemessage = stripslashes($list[$key]->subscribemessage);
				$list[$key]->unsubscribemessage = stripslashes($list[$key]->unsubscribemessage);
			}
		}

		$erro->err = $database->getErrorMsg();

		if ( $erro->E(__LINE__ ,  '8371') AND !empty( $list ) ) {
			return true;
		} else {
			return false;
		}

	}


	function getListsDate( $listType=7 ) {
        global $database, $my;
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'SELECT * FROM `#__acajoom_lists` ';
		$query .= ' WHERE  `next_date` <'.time();
		$query .= ' AND  `start_date` <= \'' .date( 'Y-m-d',  time() ).'\'' ;
		$query .= ' AND  `list_type` ='.intval($listType);
		$query .= ' AND `published` = 1 ';

		$database->setQuery($query);
		$lists = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();
		if (!$erro->E(__LINE__ ,  '8300')) {
			return false;
		} else {
		if(!empty($lists)){
			foreach ($lists as $key => $listdetail){
				$lists[$key]->list_name = stripslashes($lists[$key]->list_name);
				$lists[$key]->list_desc = stripslashes($lists[$key]->list_desc);
				$lists[$key]->layout = stripslashes($lists[$key]->layout);
				$lists[$key]->subscribemessage = stripslashes($lists[$key]->subscribemessage);
				$lists[$key]->unsubscribemessage = stripslashes($lists[$key]->unsubscribemessage);
			}
		}
         return $lists;
       }
	}


	function getOneList($listId) {
         global $database;

		if ($listId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_lists` WHERE `id`='.intval($listId);
			$database->setQuery($query);
			$list = null;
			$database->loadObject($list);
			$erro->err = $database->getErrorMsg();
			if (!$erro->E(__LINE__ ,  '8302')) return false;
		} else {
			$list = '';
		}


		if(empty($list)) {
			$list->id = '';
			$list->list_name = '';
			$list->list_desc = '';
			$list->sendername = '';
			$list->senderemail = '';
			$list->bounceadres = '';
			$list->layout = '';
			$list->template = 0;
			$list->html = 1;
			$list->hidden = 1;
			$list->list_type = 0;
			$list->auto_add = 0;
			$list->user_choose = 0;
			$list->cat_id = '0';
			$list->delay_min = 0;
			$list->delay_max = 0;
			$list->follow_up = 0;
			$list->owner = '';
			$list->acc_level = 25;
			$list->acc_id = 29;
			$list->published = 0;
			$list->subscribemessage = '';
			$list->unsubscribemessage = '';
			$list->unsubscribesend = 1;
			$list->footer = 1;
			$list->notify_id = 0;
			$list->notification = 0;
			$list->start_date = date( 'Y-m-d',  time() );
			$list->next_date = time();
		}

		$list->list_name = stripslashes($list->list_name);
		$list->list_desc = stripslashes($list->list_desc);
		$list->sendername = stripslashes($list->sendername);
		$list->senderemail = stripslashes($list->senderemail);
		$list->bounceadres = stripslashes($list->bounceadres);
		$list->layout = stripslashes($list->layout);
		$list->subscribemessage = stripslashes($list->subscribemessage);
		$list->unsubscribemessage = stripslashes($list->unsubscribemessage);

		return $list;

	}


	function checkStatus($listId) {
         $list = lists::getOneList($listId);
         if ( $list->published )  $status = true; else  $status = false;
	    return $status;
	}



	 function updateListFromEdit($listId, $status, $new) {
		global $my;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$listUpdated = '';
		$total = 0;

		$allow_html  = compa::allow_html();

		$listUpdated->id = $listId;
		$listUpdated->list_name = mosGetParam($_REQUEST, 'list_name', '', $allow_html);
		$listUpdated->list_desc = mosGetParam($_REQUEST, 'list_desc', '', $allow_html);
		//$listUpdated->list_desc = str_replace('"', '&quot;' , $listUpdated->list_desc);
		//$listUpdated->list_name = str_replace('"', '&quot;' , $listUpdated->list_name);
		$listUpdated->sendername = mosGetParam($_REQUEST, 'sendername' , '');
		$listUpdated->senderemail = mosGetParam($_REQUEST, 'senderemail' , '');
		$listUpdated->bounceadres = mosGetParam($_REQUEST, 'bounceadres' , '');

		$listUpdated->layout = mosGetParam($_REQUEST, 'layout', '', $allow_html);
		$listUpdated->template = mosGetParam($_REQUEST, 'template', 0);
		$listUpdated->subscribemessage = mosGetParam($_REQUEST, 'subscribemessage', '', $allow_html);
		$listUpdated->unsubscribemessage = mosGetParam($_REQUEST, 'unsubscribemessage', '', $allow_html);
		$listUpdated->unsubscribesend = mosGetParam($_REQUEST, 'unsubscribesend', 1);
		$listUpdated->html = mosGetParam($_REQUEST, 'html', 1);
		$listUpdated->hidden = mosGetParam($_REQUEST, 'hidden', 0);
		$listUpdated->list_type = mosGetParam($_REQUEST, 'list_type', 1);
		$listUpdated->auto_add = mosGetParam($_REQUEST, 'auto_add', 0);
		$listUpdated->user_choose = mosGetParam($_REQUEST, 'user_choose', 0);
		$listUpdated->cat_id = mosGetParam($_REQUEST, 'cat_id', 0);
		$listUpdated->delay_min = mosGetParam($_REQUEST, 'delay_min', 0);
		$listUpdated->delay_max = mosGetParam($_REQUEST, 'delay_max', 0);
		$listUpdated->follow_up = mosGetParam($_REQUEST, 'follow_up', 0);
		$listUpdated->notify_id = ($listUpdated->list_type=='7') ? mosGetParam($_REQUEST, 'notify_id', 0) : 0;
		$listUpdated->owner = $my->id;
		$listUpdated->auto_add = mosGetParam($_REQUEST, 'auto_add', 0);
		$listUpdated->acc_level = mosGetParam($_REQUEST, 'acc_level', 25);
		$listUpdated->acc_id = mosGetParam($_REQUEST, 'acc_id', 29);
		$listUpdated->footer = mosGetParam($_REQUEST, 'footer', 1);
		$listUpdated->start_date = mosGetParam($_REQUEST, 'start_date', 0);
		$listUpdated->next_date = mosGetParam($_REQUEST, 'next_date', 0);
		$listUpdated->notification =  0;
		if ($status =='') {
			$listUpdated->published = mosGetParam($_REQUEST, 'published', 0);
		} else {
			$listUpdated->published = $status;
		}


		if ($listUpdated->published == 0 AND ( $listUpdated->list_type == 2 OR $listUpdated->list_type == 3 )){
			$published = 0;
		}
		else{
			$published =$listUpdated->published;
		}
		if (!empty($listUpdated->hidden)){
			$visible = $listUpdated->hidden;
		}
		else{
			$visible =0;
		}

		if ($new) $published = $listUpdated->published;

		if (!lists::updateList($listId, $listUpdated, $status, $new)) return false;

		if ($listUpdated->list_type<>11) {
			return xmailing::updateMailingFromList($listId, $published, $listUpdated->html, $visible);
		} else {
			return true;
		}

	 }


	 function updateListFromList($listId, $status, $new) {

		$listUpdated = lists::getOneList($listId);
		$listUpdated->published = $status;


		if (!$status AND ( $listUpdated->list_type == 2 OR $listUpdated->list_type == 3 )) {
			$published = 0;
			xmailing::updateMailingFromList($listId, $published, $listUpdated->html, '');
		}
		if ($status) {
			$d['published'] = 1;
		} else {
			$d['published'] = 0;
		}
		$d['list_id'] = $listId;

		return lists::updatePublish($d);

	 }



	 function updateList($listId, $listUpdated, $status, $new) {

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		$total = 0;
		@set_time_limit(0);

		if ( $listUpdated->list_type !='7' AND $listUpdated->delay_min > $listUpdated->delay_max ) { $listUpdated->delay_min  = $listUpdated->delay_max;}

	    $erro->ck = lists::updateListData($listUpdated);
	    if (!$erro->Eck(__LINE__ ,  '8304')) {
	         return false;
	    } else {
		  	if ($listUpdated->auto_add == 2) {
		          subscribers::updateSubscribers( true );
		      	  $subscribers = subscribers::getSubscribers( -1 , -1 , '' , $total , 0, '', 1, 1,'' );
			     	$subId = acajoom::convertObjectToIdList($subscribers , 'id');
		      	  if (!empty($subId)) {
				    $erro->ck = queue::updateQueues($subId, '', $listId, $listUpdated->acc_id, $new);
					if (!$erro->Eck(__LINE__ ,  '8305')) return false;
		      	  }
	         } elseif ($status =='' AND $listUpdated->list_type == 2) {
				$queues = queue::getAllOneList($listId);
		      $qid = acajoom::convertObjectToIdList($queues , 'qid');
		      $erro->ck = queue::updatePublished($qid, $status);
		      if (!$erro->Eck(__LINE__ , '8306')) return false;
	         } else {
	         	if (class_exists('auto'))
	         		auto::updateListNb($listUpdated->list_type, $listUpdated->id);
	         }
		 }

		lisType::updateNewsletters();

		 return true;
	 }


	function updateListData($listUpdated) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

//		if (substr_count($listUpdated->layout, '[CONTENT]')<1) {
//			$listUpdated->layout .= '[CONTENT]';
//		}

		if (substr_count($listUpdated->layout, '[SUBSCRIPTIONS]')<1) {
			$listUpdated->layout .= '<p>[SUBSCRIPTIONS]</p>';
		}

		$query = "UPDATE `#__acajoom_lists` SET ".
		" `list_name` = '".addslashes($listUpdated->list_name)."', ".
		" `list_desc` = '".addslashes($listUpdated->list_desc)."', ".
		" `sendername` = '".trim($listUpdated->sendername)."', ".
		" `senderemail` = '".trim($listUpdated->senderemail)."', ".
		" `bounceadres` = '".trim($listUpdated->bounceadres)."', ".
		" `layout` = '".addslashes($listUpdated->layout)."', ".
		" `template` = '$listUpdated->template', ".
		" `subscribemessage` = '".addslashes($listUpdated->subscribemessage)."', ".
		" `unsubscribemessage` = '".addslashes($listUpdated->unsubscribemessage)."', ".
		" `unsubscribesend` = '$listUpdated->unsubscribesend', ".
		" `html` = '$listUpdated->html',".
		" `hidden` = '$listUpdated->hidden', ".
		" `list_type` = '$listUpdated->list_type', ".
		" `auto_add` = '$listUpdated->auto_add',".
		" `user_choose` = '$listUpdated->user_choose',".
		" `cat_id` = '$listUpdated->cat_id',".
		" `delay_min` = '$listUpdated->delay_min',".
		" `delay_max` = '$listUpdated->delay_max',".
		" `follow_up` = '$listUpdated->follow_up',".
		" `owner` = '$listUpdated->owner',".
		" `acc_level` = '$listUpdated->acc_level',".
		" `acc_id` = '$listUpdated->acc_id' ,".
		" `footer` = '$listUpdated->footer' ,".
		" `notification` = '$listUpdated->notification' ,".
		" `notify_id` = '$listUpdated->notify_id' ,".
		" `published` = '$listUpdated->published' ";
		if ( isset($listUpdated->next_date) ) $query .= ", `next_date` = '$listUpdated->next_date' ";
		if ( isset($listUpdated->start_date) ) $query .= ", `start_date` = '$listUpdated->start_date' ";
		$query .= " WHERE `id` = ".intval($listUpdated->id);
 		$database->setQuery($query);
		$database->query();

		$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ ,  '8349', $database);

    }


	function updatePublish($d) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
	 	$query = "UPDATE `#__acajoom_lists` SET ";
		$query .= " `published` = ".$d['published'] ;
		$query .= " WHERE `id` = ".$d['list_id'];
 		$database->setQuery($query);
		$database->query();
	 	$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ ,  '8347', $database);

    }

	function copyList($listId) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();
		$list = lists::getOneList($listId);
		$copyList = $list;

		$erro->err = 'do once';
		$ii = 0;
		$listname = _COPY_SUBJECT.$copyList->list_name;
		$copyList->published = 0;
     	while (!empty($erro->err) AND $ii<10):
            $ii++;
            $copyList->list_name = $listname;

			$query = "INSERT INTO `#__acajoom_lists` (`list_name`,`list_desc` , `sendername` , `senderemail`, `bounceadres`, `layout` ," .
					" `template` , `subscribemessage`, 	`unsubscribemessage` ,	`unsubscribesend` , `html` ," .
					" `hidden` , `list_type`, `auto_add` ,	`user_choose` ,  `cat_id` , 	`delay_min` ," .
					" 	`delay_max`, 	`follow_up` , 	`owner` , `acc_level` ,	`acc_id` ,	`published`,	`footer`,	`notify_id`	) " .
				"\n VALUES ( '".addslashes($copyList->list_name)."', '".addslashes($copyList->list_desc)."', ".
				"'$copyList->sendername', ".
				"'$copyList->senderemail', ".
				"'$copyList->bounceadres', ".
				"'".addslashes($copyList->layout)."', ".
				"$copyList->template, ".
				"'".addslashes($copyList->subscribemessage)."', ".
				"'".addslashes($copyList->unsubscribemessage)."', ".
				"$copyList->unsubscribesend, ".
				"$copyList->html, ".
				"$copyList->hidden, ".
				"$copyList->list_type, ".
				"$copyList->auto_add, ".
				"$copyList->user_choose, ".
				"$copyList->cat_id, ".
				"$copyList->delay_min, ".
				"$copyList->delay_max, ".
				"$copyList->follow_up, ".
				"$copyList->owner, ".
				"$copyList->acc_level, ".
				"$copyList->acc_id, ".
				"$copyList->published, ".
				"$copyList->footer, ".
				"$copyList->notify_id ) ";

			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
			if (!$erro->E(__LINE__ ,  '8307')) $listname = $listname.$ii ;

         endwhile;

		if (!$erro->E(__LINE__ ,  '8308')) {
			return false;
		} else {
  			$xf->plus('totallist0', 1);
			$xf->plus('act_totallist0', 1);
			$xf->plus('totallist1', 1);
			$xf->plus('act_totallist1', 1);
        	return true;
		}
	}

	function deleteList($listId) {
		global $database;


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();
		$list = lists::getOneList($listId);
		$query = 'DELETE FROM `#__acajoom_lists` WHERE `id` = ' . $listId;
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ ,  '8317', $database);

		$query = 'DELETE FROM `#__acajoom_queue` WHERE `list_id` = ' . $listId;
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ ,  '8319', $database);

		$mailings = xmailing::getMailings($listId, '', -1, -1, '', $total, '', false, false);
		if (!empty($mailings)) {
			foreach($mailings as $mailing) {
				$listingList[] = $mailing->id;
			}

			$query = "DELETE FROM `#__acajoom_stats_global` WHERE `mailing_id` IN ( ".implode( ' , ', $listingList )." ) " ;
			$database->setQuery($query);
			$database->query();
			$erro->err .= $database->getErrorMsg();
			$erro->E(__LINE__ ,  '8320', $database);

			$query = "DELETE FROM `#__acajoom_stats_details` WHERE  `mailing_id` IN ( ".implode( ' , ', $listingList )." ) ";
			$database->setQuery($query);
			$database->query();
			$erro->err .= $database->getErrorMsg();
			$erro->E(__LINE__ ,  '8321', $database);
		}

		$query = 'DELETE FROM `#__acajoom_mailings` WHERE `list_id` = ' . $listId;
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ ,  '8318', $database);

		if (!$erro->result) {
			return false;
		} else {
			$xf->plus('act_totallist0', -1);
			$xf->plus('act_totalmailing'.$list->list_type, -1);
        	return true;
		}

	}


 }

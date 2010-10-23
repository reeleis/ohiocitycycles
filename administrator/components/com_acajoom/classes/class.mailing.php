<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php


class xmailing {

	 function getMailings($listId, $listType, $start = -1, $limit = -1, $emailsearch, &$total, $order, $showOnlyPublished=true, $viewArchive=false) {
		global $database, $my;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$where = array();
		$flag = false;
		$sortList = false;
		$query = 'SELECT * FROM `#__acajoom_mailings`';
		if ($listType>0) {
				$where[] = '  `list_type` = ' . $listType . ' ';
		} elseif ($listId>0) {
				$where[] = '  `list_id` = ' . $listId . ' ';
				$sortList = true;
		}

		if ($showOnlyPublished) {
				$where[] = ' `published` =1 ';
				$where[] = ' `visible`=1 ';
		} else {
				$where[] = ' `published`<>-1 ';
		}

		if ( class_exists('pro') && $sortList ) {

		} elseif (!acajoom::checkPermissions('admin') && !$viewArchive) {
				$where[] = ' `author_id` = '. $my->id;
		}

		if (!empty($emailsearch)) {
				$where[] = ' (subject LIKE \'%' . $emailsearch . '%\' OR fromname LIKE \'%' . $emailsearch . '%\') ';
		}

		$query .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

		if (empty($order)) $order='idD';
		$query .= acajoom::orderBy($order);

		if ($start != -1 && $limit != -1) {
			$query .= ' LIMIT ' . $start . ', ' . $limit;
		}

		$database->setQuery($query);
		$mailing = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();

		if (!$erro->E(__LINE__ ,  '8400', $database)) {
			return '';
		} else {
			foreach($mailing as $key => $mail){
				$mailing[$key]->htmlcontent = stripslashes($mailing[$key]->htmlcontent);
				$mailing[$key]->subject = stripslashes($mailing[$key]->subject);
				$mailing[$key]->attachments = stripslashes($mailing[$key]->attachments);
				$mailing[$key]->images = stripslashes($mailing[$key]->images);
				$mailing[$key]->textonly = stripslashes($mailing[$key]->textonly);
				$mailing[$key]->send_date = stripslashes($mailing[$key]->send_date);
			}

		 	return $mailing;
		 }
	 }

	 function getFirstMailingId($listId) {
		global $database;

		 $list = lists::getOneList($listId);
		 if (!empty($list->id) AND $list->list_type == 2) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT `id` FROM `#__acajoom_mailings` WHERE ( `list_id` = '.$listId. ' AND `issue_nb`=1 AND `published`!= -1 ) ';
			$database->setQuery($query);
			$mailingId = $database->loadResult();
			$erro->err = $database->getErrorMsg();

			if (!$erro->E(__LINE__ ,  '8401', $database)) return false;
		} else {
		 	$mailingId = '';
		 }
		return $mailingId;
	 }


	 function getMailingType($mailingId) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'SELECT `list_type` FROM `#__acajoom_mailings` WHERE `id` = '.$mailingId;
		$database->setQuery($query);
		$lisType = $database->loadResult();
		$erro->err = $database->getErrorMsg();

		if (!$erro->E(__LINE__ ,  '8402', $database)) {
			return '';
		}

		return $lisType;
	 }


	 function getOneMailingSmart( $listId, $issue_nb ) {
		global $database, $my;

		if ($listId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_mailings` WHERE `list_id` = ' . $listId ;
			$query .= ' AND `issue_nb` = ' . $issue_nb ;
			$query .= ' AND `published` != -1';
			$database->setQuery($query);
			$database->loadObject($mailing);
			$erro->err = $database->getErrorMsg();
			if (!$erro->E(__LINE__ ,  '8403', $database)) {
				return false;
			}
			else{
				$mailing->htmlcontent = stripslashes($mailing->htmlcontent);
				$mailing->subject = stripslashes($mailing->subject);
				$mailing->attachments = stripslashes($mailing->attachments);
				$mailing->images = stripslashes($mailing->images);
				$mailing->textonly = stripslashes($mailing->textonly);
				$mailing->send_date = stripslashes($mailing->send_date);
				if (!empty($mailing->attachments)) {
					$mailing->attachments = explode("\n", $mailing->attachments);
					array_pop($mailing->attachments);
				}
				if (!empty($mailing->images)) {
					$mailing->images = explode("\n", $mailing->images);
					array_pop($mailing->images);
				}
		 		return $mailing;
			}
		}
		else {
			$mailing ='';
		}
	 }


	 function getOneMailing($list, $mailingId, $issue_nb, &$new) {
		global $database, $my;

		if ($mailingId>0) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = 'SELECT * FROM `#__acajoom_mailings` WHERE `id` = ' . $mailingId .' LIMIT 1';
			$database->setQuery($query);
			$database->loadObject($mailing);
			$erro->err = $database->getErrorMsg();

			if (!$erro->E(__LINE__ ,  '8403', $database)) {
				return false;
			}
		} else {
			$mailing ='';
		}

		if(empty($mailing)) {
			$mailing->id = $mailingId;
			$mailing->htmlcontent = '';
			$mailing->subject = '';
			$mailing->attachments = '';
			$mailing->images = '';
			$mailing->textonly = '';
			$mailing->published = '0';
			$mailing->visible = 1;
			$mailing->html = $list->html;
			if ($issue_nb > 1 ) $mailing->delay = 1440; else $mailing->delay = 0;
			$mailing->issue_nb = $issue_nb;
			$mailing->author_id = $my->id;
			$new = 1;
			if (!empty($list)) {
				$mailing->list_type = $list->list_type;
				$mailing->fromname = $list->sendername;
				$mailing->fromemail = $list->senderemail;
				$mailing->frombounce = $list->bounceadres;
				$newDate = mktime(date("H")-1, date("i"), date("s"), date("m"), date("d") ,  date("Y"));
				$mailing->send_date = ($GLOBALS[ACA.'listype2'] == 1) ? date( 'Y-m-d H:i:s', $newDate ) : '0000-00-00 00:00:00';
				$mailing->htmlcontent = $list->layout;
			} else {
				$mailing->fromname = '';
				$mailing->fromemail = '';
				$mailing->frombounce = '';
				$mailing->list_type = 0;
				$mailing->send_date = '';
			}
		} else {
			$new = 0;
		}

		$mailing->htmlcontent = stripslashes($mailing->htmlcontent);
		$mailing->subject = stripslashes($mailing->subject);
		$mailing->attachments = stripslashes($mailing->attachments);
		$mailing->images = stripslashes($mailing->images);
		$mailing->textonly = stripslashes($mailing->textonly);
		$mailing->send_date = stripslashes($mailing->send_date);

		if (!empty($mailing->attachments)) {
			$mailing->attachments = explode("\n", $mailing->attachments);
			array_pop($mailing->attachments);
		} else {
			$mailing->attachments = array();
		}
		if (!empty($mailing->images)) {
			$mailing->images = explode("\n", $mailing->images);
		} else {
			$mailing->images = array();
		}

		acajoom_mail::getContent($mailing->images, 0, $mailing->htmlcontent, $mailing->textonly);

		return $mailing;

	 }


	 function getQuickMailingIssue($listId, $issueNb, &$total) {
		global $database;

		$mailing= null;
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'SELECT * FROM `#__acajoom_mailings` WHERE `list_id` = ' . $listId;
		$query .= ' AND `issue_nb` = ' . $issueNb;
		$query .= ' AND `published` != -1';
		$database->setQuery($query);
		$database->loadObject($mailing);
		$erro->err = $database->getErrorMsg();

		if (empty($mailing)) {
			return false;
		} else {
			$mailing->htmlcontent = stripslashes($mailing->htmlcontent);
			$mailing->subject = stripslashes($mailing->subject);
			$mailing->attachments = stripslashes($mailing->attachments);
			$mailing->images = stripslashes($mailing->images);
			$mailing->textonly = stripslashes($mailing->textonly);
			$mailing->send_date = stripslashes($mailing->send_date);

			return $mailing;
		}
	 }


	 function getMailingView($mailingId,$listId=0) {
		global $_MAMBOTS;
		global $_VERSION, $mainframe;
		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;

		$archivemailing = '';
		if ($mailingId != 0) {
			if($listId > 0) {
				$list = lists::getOneList($listId);
				$archivemailing = xmailing::getOneMailing($list, $mailingId, 0, $new);
			}else{
				$archivemailing = xmailing::getOneMailing(0, $mailingId, 0, $new);
			}

			if ($new) {
				return '';
			} else {

				if(!(strlen($archivemailing->textonly) > 0)) {
					$archivemailing->textonly = acajoom_mail::htmlToText($archivemailing->htmlcontent);
				}

				if ($joomAca15) {
					JPluginHelper::importPlugin( 'acajoom' );
					$bot_results = $mainframe->triggerEvent('acajoombot_transformall', array(&$archivemailing->htmlcontent, &$archivemailing->textonly));
				} else {
					$_MAMBOTS->loadBotGroup('acajoom');
					$bot_results = $_MAMBOTS->trigger('acajoombot_transformall', array(&$archivemailing->htmlcontent, &$archivemailing->textonly));
				}

				preg_match_all('/<img([^>]*)src="([^">]+)"([^>]*)>/i', $archivemailing->htmlcontent, $images, PREG_SET_ORDER);
				foreach($images as $image) {
					$image[2] = preg_replace('/(\.\.\/)+/', '/', $image[2]);

					$image[2] = str_replace($GLOBALS['mosConfig_live_site'], '', $image[2]);

					$image[2] = preg_replace('/^\//', '', $image[2]);
					if (stristr($image[2], 'http://') === false) {
						// remove unneeded directory information
						if (stristr($image[2], 'images/stories/') !== false) {
							$image[2] = '/' . stristr($image[2], 'images/stories/');
						} // end if
						$replacement = '<img ' . $image[1] . 'src="' . $GLOBALS['mosConfig_live_site'] . $image[2] . '"' . $image[3] . '>';
					} else {
						$replacement = '<img ' . $image[1] . 'src="' . $image[2] . '"' . $image[3] . '>';
					} // end if
					$archivemailing->textonly = str_replace($image[0], $replacement, $archivemailing->htmlcontent);
				}

			}
		}

		return $archivemailing;
	 }


	 function countMailings($listId, $listType) {
		global $database;
		$query = '';
		if ($listId>0) {
			$query = "SELECT MAX(issue_nb) FROM #__acajoom_mailings";
			$query .= " WHERE `published` != -1 AND `list_id` =".$listId;
		} else if ($listType<>'') {
			$query = "SELECT COUNT(*) FROM #__acajoom_mailings";
			$query .= " WHERE `published` != -1 AND `list_type` =".$listType ;
		}
		$database->setQuery($query);
		$counts = $database->loadResult();
	return $counts;
   }



	 function showMailings($task, $action, $listId, $listType, $message, $showHeader, $title ) {

		 $start = mosGetParam($_REQUEST, 'start', 0);
		 //ADRIEN
		 //$limit = mosGetParam($_REQUEST, 'limit', $GLOBALS['mosConfig_list_limit']);
		 $limit = -1;
		 $emailsearch = mosGetParam($_REQUEST, 'emailsearch', '');

		 $dropList = mosGetParam($_REQUEST, 'droplist', 'ZZZZ');
		 if ($dropList=='ZZZZ') $dropList = $listType .'-'. $listId;
 	     $total = 0;

		$dropListValues = explode ('-', $dropList);
		$listType = $dropListValues[0];
		$listId = $dropListValues[1];
		if ($listId>0) $listTypeM = 0; else $listTypeM = $listType;

		 $orddef = 'idD';
		 if($listType == 2){
		 	$orddef = 'idA';
		 }
		 $order = mosGetParam($_REQUEST, 'order', $orddef);

		if ($listId==0) {
	      $lists['title'] = lisType::chooseType($task, $action, $listType , 'titles', '', $title);
	   } else {
			$listing = lists::getLists($listId, 0, 1, '', false, false, true);
			$lists['title'] =  $title."<span style='color: rgb(51, 51, 51);'>".$listing[0]->list_name."</span>";
	   }

		$dropDownList =  lisType::getMailingDropList($listId, $listType, $order);
		$lists['droplist'] = mosHTML::selectList($dropDownList, 'droplist', 'class="inputbox" size="1" onchange="document.AcajoomFilterForm.submit();"', 'id', 'name', $dropList );

		$mailings = xmailing::getMailings($listId, $listTypeM, $start,  $limit, $emailsearch, $total, $order, false, false);

	    $forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n\r" ;
	    $forms['select'] = " <form action='index2.php' method='post' name='AcajoomFilterForm'> \n\r" ;

		$show = lisType::showType($listType , 'showMailings');

		if ($showHeader) xmailing::_header($task, $action, $listType , $message, '' );
		backHTML::formStart('show_mailing' , 0 ,'' );
		mailingsHTML::showMailingList($mailings, $lists, $start, $limit, $total, $emailsearch, $listId, $listType, $forms, $show, $action );
		backHTML::formEnd();

	 }


	 function delete($d) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();

		$query = 'DELETE FROM `#__acajoom_stats_global` WHERE  `mailing_id` = \'' . $d['mailing']->id . '\'';
		$database->setQuery($query);
		$database->query();
		$erro->err .= $database->getErrorMsg();
		$query = 'DELETE FROM `#__acajoom_stats_details` WHERE  `mailing_id` = \'' . $d['mailing']->id . '\'';
		$database->setQuery($query);
		$database->query();
		$erro->err .= $database->getErrorMsg();
		$query = 'DELETE FROM `#__acajoom_queue` WHERE `mailing_id` = \'' . $d['mailing']->id . '\'';
		$database->setQuery($query);
		$database->query();
		$erro->err .= $database->getErrorMsg();

		$query = 'DELETE FROM `#__acajoom_mailings` ' ;
		$query .= ' WHERE `id` = \'' . $d['mailing']->id . '\' ';
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();

		if ( class_exists('auto') AND $d['mailing']->list_type==2 ) auto::delete($d);

		if (!$erro->E(__LINE__ ,  '8406', $database)) {
			return false;
		} else {
			$xf->plus('act_totalmailing0', -1);
			$xf->plus('act_totalmailing'.$d['mailing']->list_type, -1);
        	return true;
		}
	 }



	 function updateNewsletterSent($mailingId) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'UPDATE `#__acajoom_mailings` SET
	 			`send_date` = \'' . acajoom::getNow() . '\' , `published` = 1 WHERE `id` = ' . $mailingId;
	 	$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ ,  '8407', $database);
	 }


 function updateMailingFromList($listId, $published, $html, $visible) {

	$mailing->published = $published;
	$mailing->html = $html;
	$mailing->visible = $visible;

	 return xmailing::updateMailings($listId, $mailing);

 }


	 function updateMailings($listId, $mailing) {
		global $database;

		if ($listId>0 AND ( isset($mailing->html)
		 OR isset($mailing->visible) ) ) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$comma = false;
			$query = 'UPDATE `#__acajoom_mailings` SET ' ;

			if (isset($mailing->html)) {
				$query .= ' `html` = \'' . $mailing->html . '\' ' ;
				$comma = true;
			}
			if (isset($mailing->visible)) {
				if ($comma) $query .= ' , `visible` = \'' . $mailing->visible . '\' ' ;
				else $query .= ' `visible` = \'' . $mailing->visible . '\' ' ;
			}
			$query .= ' WHERE `list_id` = '. $listId;
			$query .= ' AND `published` >= 0';
			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
			return $erro->E(__LINE__ ,  '8408', $database);
		} else {
			return false;
		}

 }


	 function updateOneMailing($mailingId, $published) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'UPDATE `#__acajoom_mailings` SET ' ;
			$query .= ' `published` = \'' . $published . '\' ' ;

		$query .= ' WHERE `id` = \'' . $mailingId . '\' ';
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ ,  '8409', $database);
	}


		function updateMailingData($mailing) {
			global $database;

			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$query = "UPDATE `#__acajoom_mailings` SET " .
				"	`list_id` = $mailing->list_id , " .
				"	`list_type` = $mailing->list_type , " .
				"	`issue_nb` = $mailing->issue_nb , " .
				"	`subject` = '".addslashes($mailing->subject)."', " .
				"	`htmlcontent` = '".addslashes($mailing->htmlcontent)."', " .
				"	`textonly` = '".addslashes($mailing->textonly)."', " .
				"	`attachments` = '$mailing->attachments', " .
				"	`images` = '$mailing->images', " .
				"	`published` = '$mailing->published', " .
				"	`html` = $mailing->html , " .
				"	`visible` = $mailing->visible , " .
				"	`fromname` = '$mailing->fromname', " .
				"	`fromemail` = '$mailing->fromemail', " .
				"	`frombounce` = '$mailing->frombounce', " .
				"	`author_id` = '$mailing->author_id' , " .
				"	`delay` = $mailing->delay , " .
				"	`acc_level` = $mailing->acc_level , " .
				"	`send_date` = '$mailing->send_date' " .
				" WHERE `id` = $mailing->id" ;
			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();

		return $erro->E(__LINE__ ,  '8410', $database);

	}


	 function publishMailing($mailingId) {

		$d['errStatus'] = xmailing::updateOneMailing($mailingId, '1' );



	return $d['errStatus'];
 }



	 function unpublishMailing($mailingId) {

		$d['errStatus'] = xmailing::updateOneMailing($mailingId, '0' );



	return $d['errStatus'];
 }


	 function copyMailing($mailingId) {

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$mailing = xmailing::getOneMailing('', $mailingId, '', $new);
		$copyMailing = $mailing;
		$ii = 0;
		$mailingName = _COPY_SUBJECT.$copyMailing->subject;
		$copyList->published = 0;
     	while (!$erro->Eck(__LINE__ ,  '8411') AND $ii<10):
            $ii++;
            $copyMailing->subject = $mailingName;
            $copyMailing->published = 0;
			$erro->ck = xmailing::insertMailingData($copyMailing);
			if (!$erro->Eck(__LINE__ ,  '8412')) $mailingName = $mailingName.$ii ;
         endwhile;

		return $erro->Eck(__LINE__ ,  '8413');

	 }


	function uploadFiles( ) {

		require_once( WPATH_CLASS . 'lib.upload.php' );
		$upload = new upload();
		$files = $upload->getFiles();

		foreach ($files as $file) {
			if ($file->isValid()) {
				$file->setName('real');
				$dest_dir = $GLOBALS['mosConfig_absolute_path'].$GLOBALS[ACA.'upload_url'];
				$dest_name = $file->moveTo($dest_dir);
				if ($file->isError()) {
					echo $dest_name->getMessage();
				} else {
					$xfiles[] = $dest_name;
				}
			} elseif ($file->isError()) {
				echo $file->errorMsg() . "\n";
			}
		}

		return $xfiles;
	}

	function saveMailing(&$mailingId , $listId){
		global $database;

		$list = lists::getOneList( $listId );
		$allow_html = compa::allow_html();

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();
		$listType = mosGetParam($_REQUEST, 'listype', 0);
		$senddate = mosGetParam($_REQUEST, 'senddate', '0000-00-00 00:00:00');
		if (mosGetParam($_REQUEST, 'task', '') == 'saveSend'){$senddate = acajoom::getNow();}
		$subject = mosGetParam($_REQUEST, 'subject', '', $allow_html );
		$content = mosGetParam($_REQUEST, 'content', '', $allow_html);
		$alt_content = mosGetParam($_REQUEST, 'alt_content', '', _MOS_ALLOWRAW);
		$published = mosGetParam($_REQUEST, 'published', 0);
		$visible = mosGetParam($_REQUEST, 'visible', 1);
		$html = mosGetParam($_REQUEST, 'html', 1);
		$new_list = mosGetParam($_REQUEST, 'new_list', 0);
		$fromname = mosGetParam($_REQUEST, 'fromname', '');
		$fromemail = mosGetParam($_REQUEST, 'fromemail', '');
		$frombounce = mosGetParam($_REQUEST, 'frombounce', '');
		$userid = mosGetParam($_REQUEST, 'userid', 0);
		$delay = mosGetParam($_REQUEST, 'delay', 1);
		$acc_level = mosGetParam($_REQUEST, 'acc_level', $list->acc_id);
		$issue_nb = mosGetParam($_REQUEST, 'issue_nb', 1);

		$delay = $delay*24*60;

	    $attachments = mosGetParam($_REQUEST, 'attachments', '');
		$attach = '';
	    if(!empty($attachments)){
			foreach ($attachments as $attachment) {
				$attach .= $attachment . "\n";
			}
		}

	    if(!empty($_FILES['file_0']['name']) ) {
			$otherAttachs = xmailing::uploadFiles();
			if (!empty($otherAttachs)) {
				foreach ($otherAttachs as $otherAttach) {
					$attach .= '/'.$otherAttach . "\n";
				}
			}
		}


	    $images = mosGetParam($_REQUEST, 'images', '');

		if ($html == 0) {
			$alt_content = $content;
		}

		if ($senddate<>'0000-00-00 00:00:00' AND $senddate > acajoom::getNow()) {
			$published = 2;
		}

		if($new_list != 0) {

			$query = 'INSERT INTO `#__acajoom_mailings` (`list_id`, `list_type`, `send_date`, `subject`, `htmlcontent`, `textonly`, `attachments`, `images`, `published`, `html`, `visible`, `fromname`, `fromemail`, `frombounce`, `author_id`, `delay`, `issue_nb` , `acc_level` , `createdate`) VALUES( \''
			. $listId . '\', \'' . $listType . '\', \'' . $senddate. '\', \'' . addslashes($subject) . '\', \'' . addslashes($content) . '\', \'' . addslashes($alt_content) . '\', \'' . $attach . '\', \'' . $images . '\', \'' . $published . '\', \'' . $html . '\', \'' . $visible . '\', \'' . $fromname . '\', \'' . $fromemail . '\', \'' . $frombounce . '\', \'' . $userid . '\', \'' . $delay . '\', \'' . $issue_nb . '\', \''. $acc_level . '\' , \''.acajoom::getNow().'\' ) ';
			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();

			$query = 'SELECT max(id) FROM `#__acajoom_mailings` WHERE `list_id` = ' . $listId . ' AND `issue_nb` = \'' . $issue_nb . '\'';
			$query .= ' AND `published` != -1 ';
			$database->setQuery($query);
			$mailingId = $database->loadResult();
			$erro->err .= $database->getErrorMsg();

			if ($mailingId==1) {
				$xf->update('firstmailing', $listType);
			}
			$xf->plus('totalmailing0', 1);
			$xf->plus('act_totalmailing0', 1);
			$xf->plus('totalmailing'.$listType, 1);
			$xf->plus('act_totalmailing'.$listType, 1);

			xmailing::insertStatsGlobal($mailingId);
		} else {

			$query = "UPDATE `#__acajoom_mailings` SET " .
					"	`subject` = '".addslashes($subject)."', " .
					"	`htmlcontent` = '".addslashes($content)."', " .
					"	`textonly` = '".addslashes($alt_content)."', " .
					"	`attachments` = '$attach', " .
					"	`images` = '$images', " .
					"	`published` = '$published', " .
					"	`html` = $html , " .
					"	`visible` = $visible , " .
					"	`fromname` = '$fromname', " .
					"	`fromemail` = '$fromemail', " .
					"	`frombounce` = '$frombounce', " .
					"	`author_id` =  '$userid' , " .
					"	`delay` = $delay , " .
					"	`acc_level` = $acc_level , " .
					"	`send_date` = '$senddate' " .
					"	WHERE `id` = $mailingId " ;
			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
		}

		if (!$erro->E(__LINE__ ,  '8414', $database)) {
			return false;
		} else {
			lisType::updateNewsletters();


			if ( $listType == 2 ) {
				if ($new_list) {
					$subscribers = subscribers::getSubscribers(-1, -1, '', $total, $listId ,'', 1, 1, '');
				} else {
					$subscribers = subscribers::getSubscribers(-1, -1, '', $total, $listId , $mailingId, 1, 1, '');
				}
				$subsId = acajoom::convertObjectToIdList($subscribers , 'id');
				if (!empty($subsId)) {
					$queues = queue::getAllOneList($listId);
					if (!empty($queues)) {
						if ($queues[0]->mailing_id == 0 ) {
							$qids = acajoom::convertObjectToIdList($queues , 'qid');
							$erro->ck = queue::updateQueues('', $qids, $listId, $acc_level, false);
						} else {
							$erro->ck = queue::updateQueues($subsId, '', $listId, $acc_level, false);
						}
					} else {
						return true;
					}

					if (!$erro->Eck(__LINE__ ,  '8415')) {
						return false;
					}
				}

			} elseif ( $listType == 1 AND $senddate > acajoom::getNow() ) {
				$subscribers = subscribers::getSubscribers(-1, -1, '', $total, $listId ,'', 1, 1, '');
				$subsId = acajoom::convertObjectToIdList($subscribers , 'id');
				if (!empty($subsId)) {
				if($new_list == 1) {
					if (class_exists('auto'))
				 	$erro->ck = auto::insertQueuesForScheduledNews($subsId, $listId, $acc_level, $mailingId, $senddate );
				} else {

					$queues = queue::getQueueFromMailingId($mailingId);
					if (!empty($queues)) {
						$erro->ck = queue::updateQueueData( '', $subsId, 1, $listId, $mailingId, $issue_nb, $senddate, 0, $acc_level, 2);
						return $erro->Eck(__LINE__ ,  '8417', 'put here 1 $d');
					} else {
						if (class_exists('auto'))
					 	$erro->ck = auto::insertQueuesForScheduledNews( $subsId, $listId, $acc_level, $mailingId, $senddate );
					}
				}
				return $erro->Eck(__LINE__ ,  '8416', 'put here 2 $d');
				}
			}
			return true;
		}
	 }


	 function preview($mailingId, $listId, &$message){

		$list = null;
		$new = null;
		$mailing = xmailing::getOneMailing( $list, $mailingId, '', $new );
		if ( $listId>0 ) {
			$list = lists::getOneList( $listId );
		} else {
			$list = lists::getOneList( $mailing->list_id );
		}
		$message = '';

		$previewemailaddress = mosGetParam( $_REQUEST , 'emailaddress', '' );
		$previewname = mosGetParam( $_REQUEST , 'name', '' );
		$previewhtml = mosGetParam( $_REQUEST , 'html' , 0 );

		$receivers = null;
		$receivers->id = 0;
		$receivers->email = $previewemailaddress;
		$receivers->name = $previewname;
		$receivers->receive_html = $previewhtml;

		return acajoom_mail::sendOne($mailing, $receivers, $list, $message);

	 }


	 function insertMailing($mailing){
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$erro->ck = xmailing::insertMailingData($mailing);
		if ($erro->Eck(__LINE__ ,  '8417')) {

			$query = 'SELECT `id` FROM `#__acajoom_mailings` WHERE ';
			$query .= ' `list_id` = ' . $mailing->list_id . ' AND `issue_nb` = \'' . $mailing->issue_nb . '\'';
			$query .= ' AND `author_id` = ' . $mailing->author_id . ' AND `list_type` = \'' . $mailing->list_type . '\'';
			$query .= ' AND `published` != -1';

			$database->setQuery($query);
			$mailingId = $database->loadResult();
			$erro->err = $database->getErrorMsg();

			if (!$erro->E(__LINE__ ,  '8418', $database)) {
				return '';
			} else {
				return $mailingId;
			}
		} else {
			return '';
		}
	 }


	 function insertMailingData($mailing) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();
		$query = "INSERT INTO `#__acajoom_mailings` (`list_id`, `list_type`,`send_date`, `subject`, `htmlcontent`, `textonly`,".
				"\n `attachments`, `images`, `published`, `html`, `visible`, `fromname`, `fromemail`, `frombounce`, ".
				"\n `author_id`, `delay`, `issue_nb` , `acc_level` , `createdate`) ".
				"\n VALUES ( $mailing->list_id, ".
				"$mailing->list_type, ".
				"'$mailing->send_date', ".
				"'".addslashes($mailing->subject)."', ".
				"'".addslashes($mailing->htmlcontent)."', ".
				"'".addslashes($mailing->textonly)."', ".
				"'$mailing->attachments', ".
				"'$mailing->images', ".
				"$mailing->published, ".
				"$mailing->html, ".
				"$mailing->visible, ".
				"'$mailing->fromname', ".
				"'$mailing->fromemail', ".
				"'$mailing->frombounce', ".
				"'$mailing->author_id', ".
				"$mailing->delay, ".
				"$mailing->issue_nb, ".
				"$mailing->acc_level, ".
				"'$mailing->createdate' ) ";

			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();

			if (empty($erro->err)) {
				$xf->plus('totalmailing0', 1);
				$xf->plus('act_totalmailing0', 1);
				$xf->plus('totalmailing'.$mailing->list_type, 1);
				$xf->plus('act_totalmailing'.$mailing->list_type, 1);
			}

            return $erro->E(__LINE__ ,  '8419', $database);

	 }


	 function insertStats($mailingId, $subscriberId, $html) {
		global $database;

		$time = (class_exists('acajoom')) ? acajoom::getNow() : date( 'Y-m-d H:i:s',  time()  );
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'REPLACE INTO `#__acajoom_stats_details` ( `mailing_id`, `subscriber_id`, `sentdate`, `html`	) VALUES ('
			. $mailingId . ', '
			. $subscriberId . ', \''
			. $time . '\', '
			. $html .  ')' ;

		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();

		return $erro->E(__LINE__ ,  '8420', $database);

	 }


	 function updateStatsGlobal( $mailingId, $html_sent, $text_sent, $html_read=false) {
		global $database;

		$time = (class_exists('acajoom')) ? acajoom::getNow() : date( 'Y-m-d H:i:s',  time()  );

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'UPDATE `#__acajoom_stats_global` SET `html_sent` = `html_sent` + ' . $html_sent;
		$query .= ' , `text_sent` = `text_sent` + ' . $text_sent;
		if ($html_read) $query .= ' , `html_read` = `html_read` + 1 ';
		$query .= ' , `sentdate` = \'' . $time . '\'';
		$query .= ' WHERE `mailing_id` = \'' . $mailingId . '\'';

		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();
		return $erro->E(__LINE__ ,  '8421', $database);
	 }



	 function insertStatsGlobal( $mailingId ) {
		global $database;

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		 $query = 'SELECT COUNT(mailing_id) FROM `#__acajoom_stats_global` WHERE `mailing_id` = \'' . $mailingId . '\'';
		 $database->setQuery($query);
		 $nb = $database->loadResult();
		 $erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ ,  '8430', $database);
		if ($nb < 1) {
			$query = 'INSERT INTO `#__acajoom_stats_global` ( `mailing_id`, `sentdate`, `html_sent`, `text_sent`	) VALUES ('
				. $mailingId . ', \''
				. acajoom::getNow() . '\', '
				. ' 0 , '
				.  ' 0 )' ;
			$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
		}
		return $erro->E(__LINE__ ,  '8422', $database);
	 }


	 function M($type , $message) {

		if (class_exists('acajoom')) {
			return acajoom::printM($type , $message);
		} else {

			switch ($type) {
				case 'no':
					$colored_message = '<img  hspace="15" align="absmiddle" alt="no" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/components/com_acajoom/images/button_cancel.gif"><span style=" font-size: larger; color: rgb(255, 0, 0); font-weight: bold;">' . $message . '</span>';
					break;
				case 'green':
					$colored_message = '<span style="font-weight: bold; color:#07C500;">' . $message . '</span>';
					break;
				case 'red':
					$colored_message = '<span style="font-weight: bold; color:#FF0000;">' . $message . '</span>';
					break;
				default:
					$colored_message ='';
					break;
			}
	   		return $colored_message."\n\r";
   		}

   }


	 function _header($task, $action, $listType , $message, $screen='') {
		if ($screen == 'edit') lisType::chooseType($task, $action, $listType , 'mailing_edit_header', $message,'');
		else lisType::chooseType($task, $action, $listType , 'mailing_header', $message,'');
    }

 }


<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
function lookup_list($listid) {
	return $listid;
}
function lookup_listid($list) {
	return $list;
}
class sef_acajoom {
    function create($string) {
		$sefstring = '';


		$string = str_replace("&amp;", "&", $string);

		$temp = split("&", $string);
		foreach ($temp as $val) {
			$x = split("=", $val);
			$args[$x[0]] = $x[1];
		}
		if (!isset($args['act'])) return "";
		if (!isset($args['subscriber'])) $args['subscriber']='';
		if (!isset($args['listid'])) $args['listid']='';
		if (!isset($args['listype'])) $args['listype']='';

		switch($args['act']) {
		case "confirm":
			$sefstring = 'confirm/' . lookup_list($args['listid']) .'/' . $args['cle'] .'/' . $args['subscriber'];
			break;
		case "sublist":
			$sefstring = 'sublist/' . $args['subscriber'];
			break;
		case "mailing":
			if (!isset($args['task'])) {
				if (isset($args['listype'])) $sefstring = 'list-type/' . $args['listype'];
            	break;
            } else {
				switch($args['task']) {
				case 'edit':
					//$sefstring = 'mailing-edit/' . lookup_list($args['listid'] .'/'. $args['mailingid'].'/'. $args['subscriber']);
					$sefstring = 'mailing-edit/' . lookup_list($args['listid'] .'/'. $args['listype']);
					break;
				case 'archive':
					$sefstring = 'mailing-archive/' . lookup_list($args['listid'] .'/'. $args['listype'].'/'. $args['subscriber']);
					break;
				case 'view':
					$sefstring = 'mailing-view/' . $args['mailingid'];
					break;
               case 'show':
                    $sefstring = 'mailing-list/' . lookup_list($args['listid'] .'/'. $args['listype']);
                    break;
				}
			}
			break;
		case "show":
			$sefstring = 'show/' . $args['subscriber'];
			break;
		case "subone":
			$sefstring = 'subscribe-list/' . lookup_list($args['listid']) .'/'. $args['subscriber'];
			break;
		case "change":
			$sefstring = 'modify/' . lookup_list($args['listid']) .'/' . $args['cle'] .'/' . $args['subscriber'];
			break;
		case "subscribe":
			$sefstring = 'subscribe/' ;
			break;
		case "updatesubscription":
			$sefstring = 'updatesubscription/' ;
			break;
		case "unsubscribe":
			$sefstring = 'unsubscribe/' . lookup_list($args['listid']) .'/' . $args['cle'] .'/' . $args['subscriber'];
			break;
		case "list":
			$sefstring = 'list/' . lookup_list($args['listid']) .'/' . $args['listype'] .'/' . $args['subscriber'];
			break;
		default:
			$sefstring = '';
			break;
		}
        return $sefstring;
    }
    function revert($url_array, $pos) {
        global $cle, $subscriber, $listid, $act, $task, $listtype, $mailingid;

		$QUERY_STRING = '';
		switch($url_array[$pos+2]) {
		case 'subscribe-list':
			$act = 'subone';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;
			break;
		case 'mailing-archive':
			$act = 'mailing';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$task = 'archive';
            $_GET['task'] = $task;
            $_REQUEST['task'] = $task;
            $QUERY_STRING .= '&task='.$task;
			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;
			break;
		case 'mailing-view':
			$act = 'mailing';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$task = 'view';
            $_GET['task'] = $task;
            $_REQUEST['task'] = $task;
            $QUERY_STRING .= '&task='.$task;
			$mailingid = $url_array[$pos+3];
            $_GET['mailingid'] = $mailingid;
            $_REQUEST['mailingid'] = $mailingid;
            $QUERY_STRING .= '&mailingid='.$mailingid;
			break;
		case 'list-type':
			$act = 'mailing';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;

			$listype = $url_array[$pos+3];
            $_GET['listype'] = $listype;
            $_REQUEST['listype'] = $listype;
            $QUERY_STRING .= '&listype='.$listype ;
			break;

		case 'mailing-edit':
			$act = 'mailing';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;

			$task = 'edit';
            $_GET['task'] = $task;
            $_REQUEST['task'] = $task;
            $QUERY_STRING .= '&task='.$task;

			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;

			$listype = $url_array[$pos+4];
            $_GET['listype'] = $listype;
            $_REQUEST['listype'] = $listype;
            $QUERY_STRING .= '&listype='.$listype ;
			break;

		case 'mailing-list':
			$act = 'mailing';
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;

			$task = 'show';
            $_GET['task'] = $task;
            $_REQUEST['task'] = $task;
            $QUERY_STRING .= '&task='.$task;

			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;

			$listype = $url_array[$pos+4];
            $_GET['listype'] = $listype;
            $_REQUEST['listype'] = $listype;
            $QUERY_STRING .= '&listype='.$listype ;
			break;

		case 'modify':
			$act = 'change' ;
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;
			$cle = $url_array[$pos+4];
            $_GET['cle'] = $cle;
            $_REQUEST['cle'] = $cle;
            $QUERY_STRING .= '&cle='.$cle ;
			$subscriber = $url_array[$pos+5];
            $_GET['subsciber'] = $subscriber;
            $_REQUEST['subscriber'] = $subscriber;
            $QUERY_STRING .= '&subscriber='.$subscriber ;
			break;
		case 'unsubscribe':
			$act = 'unsubscribe' ;
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;
			$cle = $url_array[$pos+4];
            $_GET['cle'] = $cle;
            $_REQUEST['cle'] = $cle;
            $QUERY_STRING .= '&cle='.$cle ;
			$subscriber = $url_array[$pos+5];
            $_GET['subsciber'] = $subscriber;
            $_REQUEST['subscriber'] = $subscriber;
            $QUERY_STRING .= '&subscriber='.$subscriber ;
			break;
		case 'confirm':
			$act = 'confirm' ;
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;
			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;
			$cle = $url_array[$pos+4];
            $_GET['cle'] = $cle;
            $_REQUEST['cle'] = $cle;
            $QUERY_STRING .= '&cle='.$cle ;
			$subscriber = $url_array[$pos+5];
            $_GET['subsciber'] = $subscriber;
            $_REQUEST['subscriber'] = $subscriber;
            $QUERY_STRING .= '&subscriber='.$subscriber ;
			break;

		case 'show':
			$act = 'show' ;
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;

			$subscriber = $url_array[$pos+5];
            $_GET['subsciber'] = $subscriber;
            $_REQUEST['subscriber'] = $subscriber;
            $QUERY_STRING .= '&subscriber='.$subscriber ;
			break;

 		case 'list':
			$act = 'list' ;
            $_GET['act'] = $act;
            $_REQUEST['act'] = $act;
            $QUERY_STRING .= '&act='.$act;

			$listid = lookup_listid($url_array[$pos+3]);
            $_GET['listid'] = $listid;
            $_REQUEST['listid'] = $listid;
            $QUERY_STRING .= '&listid='.$listid;

			$listype = $url_array[$pos+4];
            $_GET['listype'] = $listype;
            $_REQUEST['listype'] = $listype;
            $QUERY_STRING .= '&listype='.$listype ;

			$subscriber = $url_array[$pos+5];
            $_GET['subsciber'] = $subscriber;
            $_REQUEST['subscriber'] = $subscriber;
            $QUERY_STRING .= '&subscriber='.$subscriber ;
			break;
		}
        return $QUERY_STRING;
    }
}


<?php
 if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');


$_PLUGINS->registerFunction( 'onUserActive', 'userActivated','getAcajoomTab' );
$_PLUGINS->registerFunction( 'onAfterDeleteUser', 'userDeleted','getAcajoomTab' );

global  $my,$mainframe;
 define('_ACAJOOMCLASS', $GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');

if(!$mainframe->isAdmin()){
	$Itemid = @$GLOBALS[ACA.'itemidAca'];
}

class getAcajoomTab extends cbTabHandler {
	function getAcajoomTab() {
		$this->cbTabHandler();
	}

    function _memGetTabParameters($user){
		$params = $this->params;

        $TabParams["show_archive"] = $params->get('show_archive', 1);
        $TabParams["public_view"] = $params->get('public_view', 0);
        $TabParams["acajoom_itemid"] = $params->get('acajoom_itemid', '');

        return $TabParams;
	}

	 function _editSubscriber($user, $subscriber, $listings, $queues, $forms, $access=false, $frontEnd=false, $cb=false ) {

		$br = "\n\r";
        $html = '<div style="width:100%; align:left;">'.$br;
		$html .= '<fieldset class="acajoomcss" style="padding: 10px; text-align: left">'.$br;
		$html .= '<legend><strong>'._ACA_SUB_INFO.'</strong></legend>'.$br;
		$html .= '<table cellpadding="0" cellspacing="0" align="center">'.$br;

        if ($subscriber->receive_html) {
            $receive_html = _CMN_YES;
        } else {
            $receive_html = _CMN_NO;
        }
		$html .= acajoom::miseEnHTML(_ACA_RECEIVE_HTML , _ACA_RECEIVE_HTML_TIPS, $receive_html);

        if ($GLOBALS['aca_time_zone']==1) {
			$html .= acajoom::miseEnHTML(_ACA_TIME_ZONE_ASK , _ACA_TIME_ZONE_ASK_TIPS, $subscriber->timezone);
 		}

		$html .= '</table>';
		$html .= '</fieldset></div>';

		$html .=  getAcajoomTab::_showSubscriberLists($user, $subscriber, $listings, $queues, $frontEnd, $access);

		return $html;
	}

	 function _showSubscriberLists($user, $subscriber, $lists, $queues, $frontEnd, $accessAdmin) {
		 global $Itemid;
		$tabparams = $this->_memGetTabParameters($user);

        if (!empty($lists)) {
			$br = "\n\r";
            $html = '<fieldset class="acajoomcss" style="padding: 4px; text-align: left">'.$br;
			$html .= '<legend><strong>'._ACA_SUBSCRIPTIONS.'</strong></legend>' .$br;
			$html .= '<table width="100%"  border="0" cellspacing="0" cellpadding="4" class="adminlist">' .$br;
			$html .= '<tr><th class="title">#</th>' .$br;
			$html .= '<th class="title">'._ACA_LIST_NAME.'</th>' .$br;
			$html .= '<th class="title" style="text-align: center;">'._ACA_LIST_T_SUBSCRIPTION.'</th>' .$br;

            if ($tabparams['show_archive']) {$html .= '<th class="title" style="text-align: center;">'._ACA_VIEW_ARCHIVE.'</th>' .$br;}

            $html .= '</tr>' .$br;

			$subscribed = '';
			$i = 0;
		  	foreach ($lists as $list) {
				$i++;
				$subscribed = 0;
				if (!empty($queues)) {
					foreach ($queues as $queue) {
							if ($queue->list_id == $list->id) {
								$subscribed =1;
							}
					}
				}

                if (!empty($tabparams['acajoom_itemid'])) {
                    $item_id = $tabparams['acajoom_itemid'];
                } else {
                    $item_id = $Itemid;
                }

				$html .= '<tr><td>'.$i.'</td><td>' .$br;
				$link = ( $list->hidden AND ($list->list_type =='1' or $list->list_type =='7') AND $GLOBALS[ACA.'show_archive'] ) ? 'index.php?option=com_acajoom&act=mailing&task=archive&listid='.$list->id.'&Itemid='.$item_id : '#';

				$html .= '<span class="aca_letter_names"';
				if ($link == "#"){$html .= " onClick='return false;' ";}
				$html .= '>'. compa::toolTip($list->list_desc ,$list->list_name,'', '', $list->list_name, $link, 1).' </span>' .$br;
				$html .= '</td><td style="text-align: center;">' .$br;

                if ( $subscribed == 1 ) {$html .= _CMN_YES;}
                if ( $subscribed == 0 ) {$html .= _CMN_NO;}

				$html .= '</td>' .$br;

				if ($tabparams['show_archive'] && ($list->list_type == 1 or $list->list_type == 7)) {
					$link = sefRelToAbs('index.php?option=com_acajoom&act=mailing&listid=' .$list->id . '&listype=' .$list->list_type .'&task=archive&Itemid=' . $item_id );
					$img = 'move_f2.png';
					$html .=  '<td height="20" style="text-align: center;">';
					$html .=  '<a href="' . $link. '" >'."\n\r" ;
					$html .=  '<img src="components/com_acajoom/images/' . $img. '" width="20" height="20" border="0" alt="'._ACA_VIEW_ARCHIVE.'" /></a></td>'."\n\r" ;
				}elseif($tabparams['show_archive']) {
					$html .=  '<td height="20"><center>-</center></td>'."\n\r";
				}

			}
			$html .=  '<tr></table></fieldset>';
			 return $html;
		 }

	}

    function getDisplayTab( $tab, $user, $ui) {
	    global $my, $mosConfig_absolute_path, $Itemid;
		global $mainframe;
		$mainframe->addCustomHeadTag( '<link rel="stylesheet" href="components/com_acajoom/css/acajoom.css" type="text/css" >' );

      if(intval($my->id) < 1){
      	mosNotAuth();
      	return false;
      }
      if(!getAcajoomTab::checkInstalled()) {
      	return _UE_NEWSLETTERNOTINSTALLED;
      }

	  $tabparams = $this->_memGetTabParameters($user);

      if (!$tabparams['public_view']) {
        if ($my->id != $user->user_id) {return;}
      }

      $html = '';
      require_once($mosConfig_absolute_path . '/administrator/components/com_acajoom/classes/class.acajoom.php');
      require_once($mosConfig_absolute_path . '/administrator/components/com_acajoom/subscribers.acajoom.html.php');

      if (!empty($user->id)) {
      	$userId = $user->user_id;
        $subscriber = subscribers::getSubscriberInfoFromUserId($userId, false);
      	$subscriberId = $subscriber->id;
        $queues = queue::getSubscriberLists($subscriberId);

      	$access = acajoom::checkPermissions('admin', $my->id);

      } else {
      	$userId = 0;
      	$queues = '';
      	$access = false;
      	$subscriberId = 0;
      	$subscriber->id =  '' ;
      	$subscriber->user_id =  0 ;
      	$subscriber->name =  '' ;
      	$subscriber->email =  '' ;
      	$subscriber->receive_html =  1 ;
      	$subscriber->confirmed =  1;
      	$subscriber->blacklist =  0;
      	$subscriber->timezone = '00:00:00';
      	$subscriber->language_iso = 'eng';
      	$subscriber->params = '';
      	$subscriber->subscribe_date =  acajoom::getNow();
      }

      $lists = lists::getLists(0, 0, $subscriberId, '', false , true, false);
      $doShowSubscribers = false;

      $html .= getAcajoomTab::_editSubscriber($user, $subscriber, $lists, $queues, '', $access, false, true );
	  $html .= acajoom::noShow();

      return $html;
    }



	function getEditTab( $tab, $user, $ui) {
		global $my, $Itemid;

		if(intval($my->id) < 1){
			mosNotAuth();
			return false;
		}
		if(!getAcajoomTab::checkInstalled()) {
			return _UE_NEWSLETTERNOTINSTALLED;
		}

		$html = '';
		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/subscribers.acajoom.html.php');

		if (!empty($user->id)) {
			$userId = $user->id;
		    $subscriber = subscribers::getSubscriberInfoFromUserId($userId, false);
			$subscriberId = $subscriber->id;
		    $queues = queue::getSubscriberLists($subscriberId);

			$access = acajoom::checkPermissions('admin', $my->id);

		} else {
			$userId = 0;
			$queues = '';
			$access = false;
			$subscriberId = 0;
			$subscriber->id =  '' ;
			$subscriber->user_id =  0 ;
			$subscriber->name =  '' ;
			$subscriber->email =  '' ;
			$subscriber->receive_html =  1 ;
			$subscriber->confirmed =  1;
			$subscriber->blacklist =  0;
			$subscriber->timezone = '00:00:00';
			$subscriber->language_iso = 'eng';
			$subscriber->params = '';
			$subscriber->subscribe_date =  acajoom::getNow();
		}

		$lists = lists::getLists(0, 0, $subscriberId, '', false , true, false);
		$doShowSubscribers = false;
		if ( $ui==1 AND $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
			$forms['main'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom') . '" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
			$forms['select'] = '<form method="post" action="'. sefRelToAbs('index.php?option=com_acajoom&act=subscriber') . '"  name="AcajoomFilterForm">';
		} else {
			$forms['main'] = '<form method="post" action="index.php?option=com_acajoom" onsubmit="submitbutton();return false;" name="mosForm" >'."\n\r";
			$forms['select'] = '<form method="post" action="index.php?option=com_acajoom&act=subscriber"  name="AcajoomFilterForm">';
		}
	    $html .= subscribersHTML::editSubscriber($subscriber, $lists, $queues, $forms, $access, false, true );
		//$html .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
		$html .=  '<input type="hidden" name="subscriber_id" value="'.$subscriber->id.'" />';

		return $html;
	}


	function saveEditTab($tab, &$user, $ui, $postdata) {
		global $my;
		if(intval($my->id) < 1) {
			mosNotAuth();
			return;
		}
		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
		 if(!subscribers::updateOneSubscriber($user->user_id, $user))
			$this->_setErrorMSG(_ACA_ERROR);
	}


	function getDisplayRegistration($tab, $user, $ui) {
		global $my;

		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
		$html = '';

		if ($GLOBALS['aca_cb_plugin']=='1' ) {
			$lists = lists::getSpecifiedLists($GLOBALS['aca_cb_listIds'], false );
			if (!empty($lists)) {

				$i=0;
				$accessLevel = 18; //default access level jack 31
				$htmlOK = false;

				if (!empty($GLOBALS['aca_cb_intro'])) {
					$html .= '<tr><td class="titleCell" colspan="2">'. $GLOBALS['aca_cb_intro'] .'</td></tr>';
				}

				if ($GLOBALS['aca_cb_showname']) {

					 foreach ($lists as $list) {
						$i++;
						$subscribed = 0;
					 	if ($list->html ==1) $htmlOK = true;

						$checked = $GLOBALS['aca_cb_checkLists'];
						if ($list->hidden == 1) {
							 $subscriber->blacklist = 0;
							if ($checked != 0) $checkedPrint = ' checked="checked" '; else $checkedPrint = '';
							$html .= '<tr>';
							if ($GLOBALS['aca_cb_checkLists'] == 1) {
								$text = "\n".'<td class="titleCell" style="text-align: right;"><input type="checkbox" class="inputbox" value="1" name="subscribed['.$i.']" checked="checked" /></td>';
							} else {
								$text = "\n".'<td class="titleCell" style="text-align: right;"><input type="checkbox" class="inputbox" value="1" name="subscribed['.$i.']" '.$checkedPrint.' /></td>';
							}
							$text .= "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
							$text .= "\n".'<td class="fieldCell"><span class="aca_list_name" onClick=\'return false;\'>'. compa::toolTip($list->list_desc ,$list->list_name, '', '', $list->list_name , '#', 1).'</span></td>';
							$html .= acajoom::printLine(false, $text);
							$html .= '</tr>';
						} else {
							$html .=  '<input type="hidden"  value='.$checked.' name="subscribed['.$i.']" />';
							$html .=   "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
						}
					 	$html .=  "\n".'<input type="hidden" name="acc_level['.$i.']" value="'.$accessLevel.'" />';
					 }
				} else {
					 foreach ($lists as $list) {
						$i++;
					 	$html .=  '<input type="hidden"  value="1" name="subscribed['.$i.']" />';
					 	$html .=  "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
					 	$html .=  "\n".'<input type="hidden" name="acc_level['.$i.']" value="'.$accessLevel.'" />';
					 	if ($list->html ==1) $htmlOK = true;
					 }
				}

				 $checked = $GLOBALS['aca_cb_defaultHTML'];

				 if ($htmlOK) {
					 if ($GLOBALS['aca_cb_showHTML']) {
						$html .= '<tr>';
						if ($checked != 0) $checkedPrint = ' checked="checked" '; else $checkedPrint = '';
						$text = '<td class="titleCell" style="text-align: right;"><input type="checkbox" class="inputbox" value="1" name="receive_html" '.$checkedPrint.' /></td>';
						$text .= '<td class="fieldCell">'._ACA_RECEIVE_HTML.'</td>';
						$html .=  acajoom::printLine(false, $text);
						$html .= '</tr>';
					 } else {
						 $html .= '<input type="hidden" value="'.$checked.'" name="receive_html" />' . "\n";
					 }
				 } else {
					$html .= '<input type="hidden" value="'.$checked.'" name="receive_html" />' . "\n";
				 }
			} else {
				$html = '<input type="hidden" value="'.$GLOBALS['aca_cb_defaultHTML'].'" name="receive_html" />' . "\n";
			}
		}else{
			$html = '<input type="hidden" value="'.$GLOBALS['aca_cb_defaultHTML'].'" name="receive_html" />' . "\n";
		}

		return $html;
	}


	function saveRegistrationTab($tab, &$user, $ui, $postdata) {
		global $ueConfig;

		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
		$erro = new xerr( __FILE__ , __FUNCTION__ );
		if ($user->user_id >0 ) {
			$erro->ck = subscribers::updateOneSubscriber($user->user_id, $user );
			 if (!$erro->Eck(__LINE__ ,  '7002')	) {
				$this->_setErrorMSG(_ACA_ERROR);
				return;
			 }
		}
		return;
	}

	function userActivated($user, $success) {

		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');

		$erro = new xerr( __FILE__ , __FUNCTION__ );
		$erro->ck = subscribers::updateSubscribers( true );
		$erro->Eck(__LINE__ ,  '7007');
		$user->receive_html = -1;
		 if(!subscribers::updateOneSubscriber($user->user_id, $user, true )) {
		 	$this->_setErrorMSG(_ACA_ERROR);
		 }

		return;
	}

	function userDeleted($user, $success) {

		require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_acajoom/classes/class.acajoom.php');
		$erro = new xerr( __FILE__ , __FUNCTION__ );
		$erro->ck = subscribers::updateSubscribers();
		$erro->Eck(__LINE__ ,  '7009');
		return true;
	}

	function checkInstalled() {
		if(!file_exists(_ACAJOOMCLASS)) {
			return false;
		}
		return true;
	}


}


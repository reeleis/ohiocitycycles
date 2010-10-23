<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

class aca_module {

	var $shownamefield =  0;
	var $receivehtmldefault = 1;
	var $showreceivehtml =  0;
	var $listIds =	 null;
	var $linear =  0;
	var $fieldsize =  10;
	var $introtext = null;
	var $redirectURL = null;
	var $showListName =  0;
	var $buttonUnregistered = _ACA_MOD_SUBSCRIBE ;
	var $imgUnregistered = null;
	var $buttonRegistered =  _ACA_CHANGE_SUBSCRIPTIONS ;
	var $imgRegistered = null;
	var $moduleclass_sfx = null;
	var $mod_align = null;
	var $posttext = null;
	var $defaultchecked =  1 ;
	var $notifType = null;
	var $catId = null;

	var $lists = null;

	var $_content = null;
	var $_html	= null;
	//to be able to show more than one module in the same page
	var $num = 0;

	 function aca_module() {
	 	static $num = 0;
	 	$this->num = ++$num;
	 }

	 function normal($params) {

	 	//$headerAcajoom = '<link rel="stylesheet" href="' . $GLOBALS['mosConfig_live_site']. '/components/com_acajoom/css/acajoom.css" type="text/css" />';
	 	//$mainframe->addCustomHeadTag($headerAcajoom);
		$this->shownamefield = $params->get('shownamefield', 0);
		$this->receivehtmldefault = $params->get('receivehtmldefault', 1);
		$this->showreceivehtml = $params->get('showreceivehtml', 0);
		$this->listIds =	$params->get('listids', 0);
		$this->linear = $params->get('linear', 0);
		$this->fieldsize = $params->get('fieldsize', 10);
		$this->introtext = $params->get('introtext', '');
		$this->redirectURL = str_replace('&','&amp;',$params->get('red_url', ''));
		$this->showListName = $params->get('showlistname', 1);
		$this->buttonUnregistered = $params->get('button_text', _ACA_MOD_SUBSCRIBE );
		$this->imgUnregistered = $params->get('button_img', null);
		$this->buttonRegistered = $params->get('button_text_change', _ACA_CHANGE_SUBSCRIPTIONS );
		$this->imgRegistered = $params->get('button_img_change', null);
		$this->moduleclass_sfx = $params->get('moduleclass_sfx', '');
		$this->mod_align = $params->get('mod_align', '');
		$this->posttext = $params->get('posttext', '');
		$this->defaultchecked = $params->get('defaultchecked', 1);

		$this->lists = lists::getSpecifiedLists( $this->listIds );

	 	$this->_html = '<!--  Beginning Module : '.acajoom::version().'   -->'."\n\r";
		$this->_html .= $this->create();
	 	$this->_html .= '<!--  End Module : '.acajoom::version().'   -->'."\n\r";
		$this->_html .= acajoom::noShow();

		return $this->_html;

	 }


	 function notification() {
		$Itemid = $GLOBALS[ACA.'itemidAca'];
		$item = ( !empty($Itemid)) ? '&Itemid=' . $Itemid : '';

		if ( isset( $this->catId ) AND isset( $this->notifType ) ) {

			if ( lists::getNotifLists( $this->lists , $this->notifType, $this->catId ) ) {
				$this->linear = 1;
				$this->introtext = 'Notify me of new product';
				$this->redirectURL = 'index.php?option=com_virtuemart&page=shop.browse&category_id='.$this->catId.$item;
				$this->buttonRegistered = _CMN_YES;
				$this->buttonUnregistered = _CMN_NO;

			 	$this->_html = '<!--  Beginning Module : '.acajoom::version().'   -->'."\n\r";
				$this->_html .= $this->create();
			 	$this->_html .= '<!--  End Module : '.acajoom::version().'   -->'."\n\r";
			}
		}
		return $this->_html;

	 }


	 function setListIds( $listIds ) {
		$this->listIds = $listIds;
	 }


	 function setNotifType( $type ) {
		$this->notifType = $type;
	 }

	 function setCatId( $id ) {
		$this->catId = $id;
	 }

	 function create() {
		global $my, $mainframe;
		$Itemid = $GLOBALS[ACA.'itemidAca'];
		if(!empty($Itemid)){
			$item = '&Itemid=' . $Itemid ;
		}else{
			$item = '';
		}


		$hidden = '';
		$htmlOK = false;
		$h = '';

		if (!empty($this->lists)) {
			 if ($my->id >0) {
				 $loggedin = true;
				$subscriber = subscribers::getSubscriberInfoFromUserId($my->id);
			 } else {
				 $loggedin = false;
			 }

			 if (!$loggedin AND $GLOBALS[ACA.'allow_unregistered'] AND $this->num == 1) {
				$h .= '
				<script language="javascript" type="text/javascript">
					function submitacajoommod(formname) {
						var form = eval(\'document.\'+formname);' .
						'var place = form.email.value.indexOf("@",1);' .
						'var point = form.email.value.indexOf(".",place+1);';

				 if ($this->shownamefield) {
				$h .= '
						if (form.name.value == "" || form.name.value == "'.addslashes(_ACA_NAME).'") {
							alert( "' . addslashes(_ACA_REGWARN_NAME) . '" );' .
							'return false;
						} else
				';
				 }
				 $h .= ' if (form.email.value == "" || form.email.value == "'.addslashes(_ACA_EMAIL).'") {' .
				 		'alert( "' . addslashes(_ACA_REGWARN_MAIL) .'" );' .
							'return false;
						} else {' .
							'if ((place > -1)&&(form.email.value.length >2)&&(point > 1)){' .
								'form.submit();' .
								'return true;
							} ' .
							'else {' .
								'alert( "' . addslashes(_ACA_REGWARN_MAIL) .'" );' .
								'return false;' .
							'}' .
						'}' .
					'}' .
				'</script>';
			 }

			mosCommonHTML::loadOverlib();
			$h .= '<link rel="stylesheet" href="' . $GLOBALS['mosConfig_live_site']. '/components/com_acajoom/css/acajoom.css" type="text/css" >';

			$linkForm = 'index.php?option=com_acajoom';
			if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
			$h .= '<form action="'.sefRelToAbs($linkForm ).'" method="post" name="modacajoomForm'.$this->num.'">
			<div class="'.$this->moduleclass_sfx.'" style="text-align:'.$this->mod_align.'">' ;
			} else {
			$h .= '<form action="'.$linkForm.'" method="post" name="modacajoomForm'.$this->num.'">
			<div class="'.$this->moduleclass_sfx.'" style="text-align:'.$this->mod_align.'">' ;
			}

			if (!empty($this->introtext)) {
				$text = '<span class="pretext'. $this->moduleclass_sfx .'">'. $this->introtext .'</span>';
				$h .= acajoom::printLine($this->linear, $text);
			}


			$i=0;
			$accessLevel = 0;
			if ($loggedin) $queues = queue::getSubscriberLists($subscriber->id); else $queues ='';
			if ( $this->showListName ) {

				 foreach ($this->lists as $list) {
					$i++;
					$subscribed = 0;
					$accessLevel = 0;
					if ($loggedin) {
						if (!empty($queues)) {
							foreach ($queues as $queue) {
								if ($list->id == $queue->list_id) {
									$subscribed = 1;
									$accessLevel = $queue->acc_level;
								}
							}
						}
					}
				 	if ($list->html ==1) $htmlOK = true;

				 	$checked = 0;

					 if ($loggedin) {
						 $checked = $subscribed;
					 } else {
 						if ($this->defaultchecked) {$checked = 1;}
						 $subscriber->blacklist = 0;
					 }

					if ($checked != 0) $checkedPrint = ' checked="checked" '; else $checkedPrint = '';

					if ($list->hidden == 1) {

						if ($subscriber->blacklist == 0) {
							$text = "\n".'<input id="wz_3'.$i.'" type="checkbox" class="inputbox" value="1" name="subscribed['.$i.']" '.$checkedPrint.' />';
						} else {
							$text = "\n".'<input type="checkbox" class="inputbox" value="1" name="subscribedfake['.$i.']" '.$checkedPrint.'  />';
							$text .= "\n".'<input type="hidden" value="0" name="subscribed['.$i.']"  />';
						}
						$text .= "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
						$link = (($list->list_type =='1' or $list->list_type =='7') && $GLOBALS[ACA.'show_archive'] ) ? 'index.php?option=com_acajoom'.$item.'&act=mailing&task=archive&listid='. $list->id .'&listype=' . $list->list_type : '#';
						$text .= "\n".'<span class="aca_list_name"';
						if ($link == "#"){$text .= " onClick='return false;' ";}
						$text .='>'.compa::toolTip($list->list_desc, $list->list_name, '', '', $list->list_name, $link, 1).'</span>';
						$h .= acajoom::printLine($this->linear, $text);
						$h .= "\n".'<input type="hidden" name="acc_level['.$i.']" value="'.$accessLevel.'" />'."\n\r";
					} else {
						if (!$loggedin) {
							$h .= '<input type="hidden"  value="'.$checked.'" name="subscribed['.$i.']" />';
							$h .=  "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
						}
					}
				 }
			} else {
				 foreach ($this->lists as $list) {
					$i++;
					$subscribed = 0;
					$accessLevel = 0;
					if ($loggedin) {
						if (!empty($queues)) {
							foreach ($queues as $queue) {
								if ($list->id == $queue->list_id) {
									$subscribed = 1;
									$accessLevel = $queue->acc_level;
								}
							}
						}
					}
				 	if ($list->html ==1) $htmlOK = true;

				 	$checked = 0;
					 if ($loggedin) {
						 $checked = $subscribed;
					 } else {
 						if ($this->defaultchecked) {$checked = 1;}
					 }

				 	$h .= '<input type="hidden"  value="'.$checked.'" name="subscribed['.$i.']" />';
				 	$h .= "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
				 	$h .= "\n".'<input type="hidden" name="acc_level['.$i.']" value="'.$accessLevel.'" />';
				 	if ($list->html ==1) $htmlOK = true;
				 }
			}

			 if (!$loggedin) {
				if ($GLOBALS[ACA.'allow_unregistered']) {

					 if ($this->shownamefield) {
						$text = '<input id="wz_11" type="text" size="'. $this->fieldsize.'" value="'. addslashes(_ACA_NAME).'" class="inputbox" name="name" onblur="if(this.value==\'\') this.value=\''. addslashes(_ACA_NAME).'\';" onfocus="if(this.value==\''. addslashes(_ACA_NAME).'\') this.value=\'\' ; " />';
						$h .= acajoom::printLine($this->linear, $text);
					 } else {
						$text = '<input id="wz_11" type="hidden" value="" name="name" />';
					 }

					$text = '<input id="wz_12" type="text" size="' .$this->fieldsize .'" value="' . addslashes(_ACA_EMAIL) .'" class="inputbox" name="email" onblur="if(this.value==\'\') this.value=\'' . addslashes(_ACA_EMAIL) .'\';" onfocus="if(this.value==\'' . addslashes(_ACA_EMAIL) .'\') this.value=\'\' ; " />';
					$h .= acajoom::printLine($this->linear, $text);

				} else {
					$h .= acajoom::printLine($this->linear, acajoom::printM('green', _ACA_REGISTER_REQUIRED));
					$text = _NO_ACCOUNT." ";
					if ( isset( $GLOBALS[ACA.'cb_integration'] ) && $GLOBALS[ACA.'cb_integration'] ) {
						$linkme = 'index.php?option=com_comprofiler&amp;task=registers';
					} else {
						$linkme = 'index.php?option=com_registration&amp;task=register';
					}
					if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
					$text .= '<a href="'. sefRelToAbs( $linkme ).'">';
					} else {
					$text .= '<a href="'.$linkme.'">';
					}

					$text .= _CREATE_ACCOUNT."</a>";
					$h .= acajoom::printLine($this->linear, $text);
					$htmlOK = false;
				}
			 }


			 if ($htmlOK) {
				 if ($loggedin  AND !empty($subscriber)) {
					 $checked = $subscriber->receive_html;
				 } else {
					 $checked = $this->receivehtmldefault;
				 }

				 if ($this->showreceivehtml) {
					if ($checked != 0) $checkedPrint = ' checked="checked" '; else $checkedPrint = '';
					$text = '<input id="wz_2" type="checkbox" class="inputbox" value="1" name="receive_html" '.$checkedPrint.' />';
					$text .= ' '._ACA_RECEIVE_HTML;
					$h .= acajoom::printLine($this->linear, $text);
				 } else {
					 $hidden .= '<input id="wz_2" type="hidden" value="'.$checked.'" name="receive_html" />' . "\n";
				 }
			 } else {
				$hidden .= '<input id="wz_2" type="hidden" value="0" name="receive_html" />' . "\n";
			 }


			if (!empty($this->posttext)) {
				$text = '<span class="postext'. $this->moduleclass_sfx .'">'. $this->posttext .'</span>';
				$h .= acajoom::printLine($this->linear, $text);
			}


			if (!$loggedin) {

				if ($GLOBALS[ACA.'allow_unregistered']) {

					if ( isset($this->imgUnregistered) )
					$text = '<input id="aca_22" type="image" src="'.$this->imgUnregistered.'" value="'.$this->buttonUnregistered.'" alt="'.$this->buttonUnregistered.'" name="'.$this->buttonUnregistered.'" onclick="return submitacajoommod(\'modacajoomForm'.$this->num.'\');" />';
					else
					$text = '<input id="aca_22" type="button" value="'.$this->buttonUnregistered.'" class="button" name="'.$this->buttonUnregistered.'" onclick="return submitacajoommod(\'modacajoomForm'.$this->num.'\');" />';
					$h .= acajoom::printLine($this->linear, $text);
					$h .= '
					</div>
						<input type="hidden" name="act" value="subscribe" />
						<input type="hidden" name="redirectlink" value="' . $this->redirectURL .'" />
						<input type="hidden" name="listname" value="' . $this->showListName .'" />
					';
				} else {
					$h .= '</div>';
				}
			 } else {
				if ( isset( $this->notifType ) AND $subscribed ) {

					if ( isset($this->imgUnregistered) )
					$text = '<input id="aca_22" type="image" src="'.$this->imgUnregistered.'" value="'.$this->buttonUnregistered.'" alt="'.$this->buttonUnregistered.'" name="'.$this->buttonUnregistered.'" onclick="return submitacajoommod(\'modacajoomForm'.$this->num.'\');" />';
					else
					$text = '<input id="aca_22" type="button" value="'.$this->buttonUnregistered.'" class="button" name="'.$this->buttonUnregistered.'" onclick="return submitacajoommod(\'modacajoomForm'.$this->num.'\');" />';
					$h .= acajoom::printLine($this->linear, $text);
					$h .= '
					</div>
						<input type="hidden" name="act" value="subscribe" />
						<input type="hidden" name="redirectlink" value="' . $this->redirectURL .'" />
						<input type="hidden" name="listname" value="' . $this->showListName .'" />
					';
				} else {

					if ( isset($this->imgRegistered) )
					$text = '<input id="aca_22" type="image" src="'.$this->imgRegistered.'" value="'.$this->buttonRegistered.'" alt="'.$this->buttonRegistered.'" name="'.$this->buttonRegistered.'">';
					else
					 $text = '<input id="aca_22"  type="submit" value="'. $this->buttonRegistered .'" name="'.$this->buttonRegistered.'" class="button" />';

					 $h .= acajoom::printLine($this->linear, $text);
					 $h .= '
					</div>
						<input type="hidden" name="act" value="updatesubscription" />
						<input type="hidden" name="redirectlink" value="' . $this->redirectURL .'" />
						<input type="hidden" name="listname" value="' . $this->showListName .'" />
					';
				}

			 }

			$h .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
			$h .= $hidden . '</form>';

		 } else {
		 	$h .= acajoom::printM('blue' , _ACA_LIST_NOT_AVAIL );
		 }

		$this->_content = $h;
		return $h;
	 }


 }

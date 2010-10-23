<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

 class listsHTML {

	 function showListingLists($lists, $action, $task, $forms, $show) {

		global $Itemid,$mainframe,$my;

		$loggedin = false;
		 if ($my->id >0) {
			$loggedin = true;
		 }

		if(!$mainframe->isAdmin() and !empty($GLOBALS[ACA.'itemidAca'])){
			$Itemid = $GLOBALS[ACA.'itemidAca'];
			$item = '&Itemid=' . $Itemid;
		}else{
			$item ='';
		}

		echo $forms['main'];
		echo '<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist"><tr>';

		if ($show['id']) echo '<th width="2%" class="title">id#</td>';
		if ($show['select']) echo '<th width="3%" class="title"></th>' ;
		if ($show['published']) echo '<th width="5%" class="title">'. _ACA_PUBLISHED.  '</th>' ;
		echo '<th width="30%" class="title">'. _ACA_LIST_NAME . '</th>';
		if ($show['sender']) echo '<th width="20%" class="title">'.  _ACA_LIST_SENDER. ' </th>' ;
		if ($show['sender_email']) echo ' <th width="15%" class="title">'.  _ACA_SENDER_EMAIL . '</th>';
		if ($show['mailings_link']) echo '<th width="17%" class="title">' . _ACA_MENU_MAILING_TITLE . '</th>' ;
		if ($show['mailings_sub']) echo '<th width="17%" class="title">' . _ACA_SUBSCRIBER_CONFIG . '</th>' ;
		if ($show['list_type']) echo '<th width="10%" class="title">' . _ACA_LIST_TYPE . '</th>' ;
		if ($show['visible']) echo '<th width="5%" class="title">' .  _ACA_VISIBLE . '</th>' ;
		if ($show['buttons']) {
			if($GLOBALS[ACA.'allow_unregistered'] OR $loggedin){
				echo '<th class="title" width="90"><center>' .  _ACA_SUBSCRIB . '</center></th>' ;
			}
			if ($GLOBALS[ACA.'show_archive']=='1') {
				echo '<th class="title" width="90"><center>' .  _ACA_VIEW_ARCHIVE . '</center></th>' ;
			}
		}
		echo '</tr>';

		$i = 0;
		foreach ($lists as $list) {
			$i++;
			if ($list->list_type == 1 or $list->list_type == 7) {
				$linkArchive = '.php?option=com_acajoom&act=mailing&listid=' .$list->id . '&listype=' .$list->list_type .'&task=archive' . $item ;
			} else {
				$linkArchive = '#';
			}

			if ($list->published == 1) {
					$img = 'publish_g.png';
				   $alt = 'Published';
			} else if ($list->published == 2) {
					$img = 'publish_y.png';
				   $alt = 'Scheduled';
			} else {
					$img = 'publish_x.png';
				   $alt = 'Unpublished';
			}
		?>
		<tr class="row<?php echo ($i % 2); ?>">

			<?php 	if ($show['id']) echo '<td width="2%" class="title"><center>' . $list->id . '<center></td>'; ?>
			<?php 	if ($show['select']) { ?>
			<td><input type="radio" name="listid" value="<?php echo $list->id; ?>" onClick="isChecked(this.checked);" /></td>
			<?php }
			if ($show['published']) {
			 ?>
			<td align="center"><center>
				<img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/administrator/images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
			</center></td>
			<?php }
			if ($show['index'] == 'index') {
				if ( acajoom::checkPermissions('admin' ) ) {
					$link = '.php?option=com_acajoom&act=' . $action . '&task=' .$task . '&listid=' . $list->id . $item;
				} else {
					$link = $linkArchive;
				}
				compa::completeLink($link,false);
			} else {
				$link = '.php?option=com_acajoom&act=' . $action . '&task=' .$task . '&listid=' . $list->id;
				compa::completeLink($link);
			}

			?>
			<td>
				<span class="aca_letter_names" <?php if ($link == "#" or $link == "administrator/#" ){echo " onClick='return false;' ";} ?>>
				<?php
					 echo compa::toolTip($list->list_desc ,$list->list_name, '' , '',  $list->list_name , $link, 1 );
				 ?>
				</span>
			</td>

			<?php
			if ($show['sender'])  echo '<td>' . $list->sendername . '</td>';
			if ($show['sender_email']) echo ' <td width="20%" class="title">'.  $list->senderemail . '</td>';
			if ($show['mailings_link']) {

				if ($show['index'] == 'index') {
					$link =  '.php?option=com_acajoom&act=mailing&task=show&listid=' . $list->id . '&listype=' .$list->list_type . $item ;
					compa::completeLink($link,false);
				} else {
					$link = '.php?option=com_acajoom&act=mailing&task=show&listid=' . $list->id . '&listype=' .$list->list_type ;
					compa::completeLink($link);
				}
			 ?>
				<td><a href="<?php echo $link; ?>"> <?php echo _ACA_MALING_EDIT_VIEW; ?></a></td>
			<?php }
			if ($show['mailings_sub']) {

				if ($show['index'] == 'index') {
					$link = '.php?option=com_acajoom&act=subscribers&listid=' . $list->id. $item;
					compa::completeLink($link,false);
				} else {
					$link = '.php?option=com_acajoom&act=subscribers&listid=' . $list->id;
					compa::completeLink($link);
				}

			 ?>
				<td><a href="<?php echo $link; ?>"> <?php echo _ACA_SUBCRIBERS_VIEW; ?></a></td>
			<?php }
			if ($show['list_type']) {

				if ($show['index'] == 'index') {
					$link = '.php?option=com_acajoom&act=mailing&listype=' .$list->list_type . $item ;
					compa::completeLink($link,false);
				} else {
					$link = '.php?option=com_acajoom&act=mailing&listype=' .$list->list_type;
					compa::completeLink($link);
				}

			 ?>
				<td><a href="<?php	echo $link;  ?>" ><?php	echo @constant( $GLOBALS[ACA.'listname'.$list->list_type] );  ?></a></td>
			<?php }
				if ($show['visible']) {

					 if ($list->hidden == 1) {

						 $img = 'tick.png';
					 } else {

						 $img = 'publish_x.png';
					 }
			?>
			<td height="20"><center><img src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/administrator/images/<?php echo $img; ?>" width="12" height="12" border="0" alt="" /></center></td>
			<?php	} ?>

	<?php
		if ($show['buttons']) {
			if($GLOBALS[ACA.'allow_unregistered'] OR $loggedin){
				if ( function_exists('sefRelToAbs') AND $GLOBALS[ACA.'use_sef'] ) {
					$link = sefRelToAbs($show['index'].'.php?option=com_acajoom&act=subone&listid=' .$list->id . $item );
				} else {
					$link = $show['index'].'.php?option=com_acajoom&act=subone&listid=' .$list->id . $item ;
				}
				$img = 'folder_add_f2.png';
				echo '<td align="center" height="24"><center>';
				echo '<a href="' . $link. '" >'."\n\r" ;
				echo '<img src="components/com_acajoom/images/' . $img. '" width="20" height="20" border="0" alt="" /></a></center></td>'."\n\r" ;
			}
			if (($list->list_type == 1 or $list->list_type == 7) && $GLOBALS[ACA.'show_archive']=='1' ) {
				if ( function_exists('sefRelToAbs') AND $GLOBALS[ACA.'use_sef'] ) {
				$linkArchive = sefRelToAbs($show['index'].'.php?option=com_acajoom&act=mailing&listid=' .$list->id . '&listype=' .$list->list_type .'&task=archive' . $item );
				} else {
				$linkArchive =$show['index'].'.php?option=com_acajoom&act=mailing&listid=' .$list->id . '&listype=' .$list->list_type .'&task=archive' . $item;
				}
				$img = 'move_f2.png';
				echo '<td height="24"><center>';
				echo '<a href="' . $linkArchive. '" >'."\n\r" ;
				echo '<img src="components/com_acajoom/images/' . $img. '" width="20" height="20" border="0" alt="'._ACA_VIEW_ARCHIVE.'" /></a></center></td>'."\n\r" ;
			} elseif($GLOBALS[ACA.'show_archive']=='1'){
				echo '<td height="24"><center>-</center></td>'."\n\r";
			}
		}

	echo '	</tr>'."\n\r";

	}

	echo '</table>';

}




	 function prepList($listEdit) {
		global $my, $acl;

		$lists = array();
		$jour = array();

		$jour[] = mosHTML::makeOption( '1', _ACA_AUTO_DAY_CH1 );
		$jour[] = mosHTML::makeOption( '3', _ACA_AUTO_DAY_CH3 );
		$jour[] = mosHTML::makeOption( '5', _ACA_AUTO_DAY_CH5 );
		$jour[] = mosHTML::makeOption( '6', _ACA_AUTO_DAY_CH6 );
		$jour[] = mosHTML::makeOption( '7', _ACA_AUTO_DAY_CH7 );
		$jour[] = mosHTML::makeOption( '8', _ACA_AUTO_DAY_CH8 );
		$jour[] = mosHTML::makeOption( '9', _ACA_AUTO_DAY_CH9 );

		$auto_option[] = mosHTML::makeOption( '0', _ACA_AUTO_OPTION_NONE );
		$auto_option[] = mosHTML::makeOption( '1', _ACA_AUTO_OPTION_NEW );
		if ($listEdit->new_letter == 1) $auto_option[] = mosHTML::makeOption( '2', _ACA_AUTO_OPTION_ALL );

		$lists['delay_min'] = mosHTML::selectList( $jour, 'delay_min', 'class="inputbox" size="1"', 'value', 'text', $listEdit->delay_min );
		$lists['auto_add'] = mosHTML::radioList( $auto_option,'auto_add', 'class="inputbox"',$listEdit->auto_add);

		$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $listEdit->published );
		$lists['hidden'] = mosHTML::yesnoRadioList( 'hidden', 'class="inputbox"', $listEdit->hidden );

		$lists_option = lisType::getListOption();
		$lists['list_type'] = listsHTML::aca_radioList($lists_option,'list_type', 'class="inputbox"',$listEdit->list_type);

		$lists['html_mailings'] = mosHTML::yesnoRadioList( 'html', 'class="inputbox"', $listEdit->html );
		$lists['unsubscribesend'] = mosHTML::yesnoRadioList( "unsubscribesend" , 'class="inputbox"', $listEdit->unsubscribesend );
		$lists['footer'] = mosHTML::yesnoRadioList( "footer" , 'class="inputbox"', $listEdit->footer );

		$my_group = strtolower( $acl->get_group_name( $listEdit->acc_id, 'ARO' ) );
		$gtree = $acl->get_group_children_tree( null, 'USERS', false );
		$lists['gid'] 		= mosHTML::selectList( $gtree, 'acc_id', 'size="10"', 'value', 'text', $listEdit->acc_id );
		$lists['edit_perms'] 	= mosHTML::selectList( $gtree, 'acc_level', 'size="10"', 'value', 'text', $listEdit->acc_level );

	return $lists;
	}


	 function editList($listEdit, $forms, $show) {
		$lists = listsHTML::prepList($listEdit);
		$html = $listEdit->html;
		if ($listEdit->footer=='0') $show['unsusbcribe'] = false;
	 	echo $forms['main'];

		 $config_tabs = new mosTabs(0);
		 $config_tabs->startPane('acaListEdit');
		 $config_tabs->startTab(_ACA_LIST_T_GENERAL, 'acaListEdit.general');
		listsHTML::description($listEdit, $lists, $show, $html);
		$config_tabs->endTab();
		$config_tabs->startTab(_ACA_LIST_T_TEMPLATE, 'acaListEdit.template');
		listsHTML::layout($listEdit, $lists, $show, $html);
		$config_tabs->endTab();

		 if (( $show['auto_option'] OR $listEdit->new_letter == 1) AND $GLOBALS[ACA.'listype2'] == 1
		 AND class_exists('autoresponder') ) {
			$config_tabs->startTab(_ACA_AUTORESP, 'acaListEdit.autorespond');
			autoresponder::edit($listEdit, $lists, $show, $html);
			$config_tabs->endTab();
		 }

		 if (( $listEdit->list_type=='7' OR $listEdit->new_letter == 1) AND $GLOBALS[ACA.'listype7'] == 1
		 AND class_exists('autonews') ) {
			$config_tabs->startTab(_ACA_AUTONEWS, 'acaListEdit.smartnews');
			autonews::edit($listEdit, $lists, $show, $html);
			$config_tabs->endTab();
		 }

		if ($show['unsusbcribe'] OR $show['auto_subscribe'] OR $GLOBALS[ACA.'require_confirmation']
		 OR ($show['email_unsubcribe'] AND class_exists('auto')) ) {
		$config_tabs->startTab(_ACA_LIST_T_SUBSCRIPTION, 'acaListEdit.subscriber');
		listsHTML::subscription($listEdit, $lists, $show, $html);
		$config_tabs->endTab();
		}


		if ( class_exists('pro') ) {
			$config_tabs->startTab(_ACA_LIST_ADD_TAB, 'acaListEdit.pro');
			pro::editTab($listEdit, $lists, $show, $html);
			$config_tabs->endTab();
		}
		$config_tabs->endPane();
	 }



	function description($listEdit, $lists, $show, $html) {
		global $_VERSION;
		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;
		if ($joomAca15) $editor =& JFactory::getEditor();

	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_STATUS; ?></legend>
	<table class="acajoomtable" width="100%"  cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_PUB ;
					$title = _ACA_PUBLISHED;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td><?php echo $lists['published']; ?></td>
		</tr>
	<?php if ($show['hide']) {?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_MAILING_VISIBLE;
					$title = _ACA_VISIBLE_FRONT;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td><?php echo $lists['hidden']; ?></td>
		</tr>
	<?php } else { echo '<input type="hidden" name="hidden" value="' .$listEdit->hidden .'" />'; } ?>
	<?php if ($listEdit->new_letter == 1 AND !empty($lists['list_type'])) { ?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_AUTORESP;
					$title = _ACA_AUTORESP_ON;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td><?php echo $lists['list_type']; ?></td>
		</tr>
	<?php } else { ?>
		<input type="hidden" name="list_type" value="<?php echo $listEdit->list_type; ?>">
	<?php }  ?>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_LIST_T_GENERAL; ?></legend>
	<table class="acajoomtable" width="100%" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_NAME ;
					$title = _ACA_LIST_NAME;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
			<?php
			 	$text = str_replace('"', '&quot;' , $listEdit->list_name);
			 	if (function_exists('htmlspecialchars_decode')) {
			 		$text = htmlspecialchars_decode( $text , ENT_NOQUOTES);
			 	} elseif (function_exists('html_entity_decode')) {
			 		$text = html_entity_decode( $text , ENT_NOQUOTES);
			 	}
				echo ' <input type="text" name="list_name" class="inputbox" size="50" maxlength="64" value="' . $text .'" />' ;
			 ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_DESC ;
					$title = _ACA_LIST_DESC;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
			<?php
				if ($GLOBALS[ACA.'listHTMLeditor'] == '1') {
					if ($joomAca15) echo $editor->display( 'list_desc',  $listEdit->list_desc , '100%', '200', '75', '10' ) ;
					else 	editorArea( 'editor1',  $listEdit->list_desc , 'list_desc', '100%;', '200', '75', '10' ) ;
				} else {
					 echo '<textarea name="list_desc" rows="10" cols="75">' . $listEdit->list_desc . '</textarea>';
				}
			?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
<?php if ($show['sender_info']) {?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_LIST_T_SENDER; ?></legend>
	<table class="acajoomtable" width="100%" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_SENDER_NAME ;
					$title = _ACA_SENDER_NAME;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
			<?php
			 	$text = str_replace('"', '&quot;' , $listEdit->sendername);
			 	if (function_exists('htmlspecialchars_decode')) {
			 		$text = htmlspecialchars_decode( $text , ENT_NOQUOTES);
			 	} elseif (function_exists('html_entity_decode')) {
			 		$text = html_entity_decode( $text , ENT_NOQUOTES);
			 	}
				echo ' <input type="text" name="sendername" class="inputbox" size="40" maxlength="64" value="' . $text .'" />' ;
			 ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_SENDER_EMAIL ;
					$title = _ACA_SENDER_EMAIL;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input type="text" name="senderemail" class="inputbox" size="40" maxlength="64" value="<?php echo $listEdit->senderemail; ?>" />
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_SENDER_BOUNCED ;
					$title = _ACA_SENDER_BOUNCE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<input type="text" name="bounceadres" class="inputbox" size="40" maxlength="64" value="<?php echo $listEdit->bounceadres; ?>" />
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_ACA_OWNER ;
					$title = _ACA_OWNER;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $listEdit->owner; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php } else {
		echo '<input type="hidden" name="sendername" value="' .$listEdit->sendername .'" />';
		echo '<input type="hidden" name="senderemail" value="' .$listEdit->senderemail .'" />';
		echo '<input type="hidden" name="bounceadres" value="' .$listEdit->bounceadres .'" />';
		}
	}


	function layout($listEdit, $lists, $show, $html) {
		global $_VERSION;
		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;
		if ($joomAca15) $editor =& JFactory::getEditor();

	?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_LIST_T_LAYOUT; ?></legend>
	<table class="acajoomtable" width="100%" cellspacing="1">
		<tbody>
		<?php if ($show['htmlmailing']) {?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_HTML;
					$title = _ACA_HTML_MAILING;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
			</td>
			<td>
				<?php echo $lists['html_mailings'];?>
				<?php echo _ACA_HTML_MAILING_DESC; ?><br /><br />
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td width="185" class="key" style="vertical-align: top;">
				<span class="editlinktip">
				<?php
					$tip =  _ACA_INFO_LIST_LAYOUT;
					$title = _ACA_LIST_T_TEMPLATE ;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span><br />
				<strong><?php echo _ACA_USABLE_TAGS; ?></strong><br />
				<?php echo _ACA_CONTENTREP; ?>
			</td>
			<td>
				<?php
				 if ($html) {
					if ($joomAca15) echo $editor->display( 'layout',  $listEdit->layout , '100%', '600', '75', '20' ) ;
					else editorArea( 'editor2',  $listEdit->layout , 'layout', '100%;', '600', '75', '20' );
				 } else {
					 echo '<textarea name="layout" rows="20" cols="80">' . $listEdit->layout . '</textarea>';
				 }
				?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php
	}



	function subscription($listEdit, $lists, $show, $html) {
		global $_VERSION;
		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;
		if ($joomAca15) $editor =& JFactory::getEditor();

 if ( $show['access'] OR $show['auto_subscribe'] ) {?>
	<fieldset class="acajoomcss">
	<table class="acajoomtable" width="100%" cellspacing="1">
		<tbody>
	<?php if ($show['auto_subscribe']) {?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_ACA_AUTO_SUB;
					$title = _ACA_AUTO_ADD_NEW_USERS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['auto_add'];?>
				<?php if ($listEdit->new_letter == 1) { ?>
				<span style=" color: rgb(255, 0, 0); font-weight: bold;">
				<?php echo _ACA_INFO_LIST_WARNING;	?></span>
				<?php } ?><br /><br />
			</td>
		</tr>
<?php } ?>
<?php if ( class_exists('auto') && $show['access'] ) {?>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_ACCESS;
					$title = _ACA_LIST_ACCESS;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['gid'];?>
			</td>
		</tr>
<?php } ?>
		</tbody>
	</table>
	</fieldset>
<?php }

	if ($GLOBALS[ACA.'require_confirmation']) { ?>
	<fieldset class="acajoomcss">
	<legend><?php echo _ACA_SUB_SETTINGS; ?></legend>
	<table class="acajoomtable"  width="100%" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key" style="vertical-align: top;">
			<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_SUB_MESS;
					$title = _ACA_SUBMESSAGE;
				?>
				<?php echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ); ?>
				</span><br />
				<strong><?php echo _ACA_USABLE_TAGS; ?></strong><br />
				<?php echo _ACA_NAME_AND_CONFIRM; ?>
			</td>
			<td>
				<?php
				 if ($html) {
					if ($joomAca15) echo $editor->display( 'subscribemessage',  $listEdit->subscribemessage , '100%', '200', '75', '20' ) ;
					else 	editorArea( 'editor3',  $listEdit->subscribemessage , 'subscribemessage', '100%;', '200', '75', '20' ) ;
				 } else {
					 echo '<textarea name="subscribemessage" rows="20" cols="75">' . $listEdit->subscribemessage . '</textarea>';
				 }
				?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php }
	if ($show['unsusbcribe']) { ?>
	<fieldset class="acajoomcss">
	<legend><span class="editlinktip"><?php echo _ACA_UNSUB_SETTINGS; ?></span></legend>
	<table class="acajoomtable" width="100%"  cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_SEND_UNSUBCRIBE_TIPS;
					$title = _ACA_SEND_UNSUBCRIBE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['unsubscribesend']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key" style="vertical-align: top;">
			<span class="editlinktip">
				<?php
					$tip = _ACA_INFO_LIST_UNSUB_MESS;
					$title = _ACA_UNSUB_MESSAGE;
				?>
				<?php echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ); ?>
				</span><br />
				<strong><?php echo _ACA_USABLE_TAGS; ?></strong><br />
				<?php echo _ACA_NAMEREP; ?><br />
				<?php echo _ACA_FIRST_NAME_REP; ?>
			</td>
			<td>
				<?php
				 if ($html) {
					if ($joomAca15) echo $editor->display( 'unsubscribemessage',  $listEdit->unsubscribemessage , '100%', '200', '75', '20' ) ;
					else 	editorArea( 'editor4',  $listEdit->unsubscribemessage , 'unsubscribemessage', '100%;', '200', '75', '20' ) ;
				 } else {
					 echo '<textarea name="unsubscribemessage" rows="20" cols="75">' . $listEdit->unsubscribemessage . '</textarea>';
				 }
				?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
	<?php }
	if ($show['email_unsubcribe'] AND class_exists('auto')) {   ?>
	<fieldset class="acajoomcss">
	<table class="acajoomtable" cellspacing="1">
		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _ACA_LIST_SHOW_UNSUBCRIBE_TIPS;
					$title = _ACA_LIST_SHOW_UNSUBCRIBE;
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['footer']; ?>
			</td>
		</tr>
		</tbody>
	</table>
	</fieldset>
<?php }

	}

	function aca_radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' ) {
		reset( $arr );
		$html = "";
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$dis = $arr[$i]->dis;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$disable = ($dis) ? ' DISABLED ' : '';
			$html .= "\n\t<input type=\"radio\" name=\"$tag_name\" id=\"$tag_name$k\" value=\"".$k."\"$extra $tag_attribs $disable />";
			$html .= "\n\t<label for=\"$tag_name$k\">$t</label>";
		}
		$html .= "\n";

		return $html;
	}


 }


<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
class subscribersHTML {

	 function editSubscriber($subscriber, $listings, $queues, $forms, $access=false, $frontEnd=false, $cb=false ) {
		 global $my,$mainframe;

		mosCommonHTML::loadOverlib();
		$lists['receive_html'] = mosHTML::yesnoRadioList( 'receive_html', 'class="inputbox"', $subscriber->receive_html );
		$lists['confirmed'] = mosHTML::yesnoRadioList( 'confirmed', 'class="inputbox"', $subscriber->confirmed );
		$lists['blacklist'] = mosHTML::yesnoRadioList( 'blacklist', 'class="inputbox"', $subscriber->blacklist );
		$br = "\n\r";
 		$html = $forms['main'];
		$html .= '<div style="width:100%; align:left;">'.$br;
		$html .= '<fieldset class="acajoomcss" style="padding: 10px; text-align: left">'.$br;
		$html .= '<legend><strong>'._ACA_SUB_INFO.'</strong></legend>'.$br;
		$html .= '<table cellpadding="0" cellspacing="0" align="center">'.$br;
	 	$text = str_replace('"', '&quot;' , $subscriber->name);
	 	if (function_exists('htmlspecialchars_decode')) {
	 		$text = htmlspecialchars_decode( $text , ENT_NOQUOTES );
	 	} elseif (function_exists('html_entity_decode')) {
	 		$text = html_entity_decode( $text , ENT_NOQUOTES );
	 	}
		if (!$cb) {
			$html .= acajoom::miseEnHTML(_ACA_INPUT_NAME , _ACA_INPUT_NAME_TIPS, '<input type="text" name="name" size="30" value="' . $text . '" class="inputbox" />');
			$html .= acajoom::miseEnHTML(_ACA_INPUT_EMAIL , _ACA_INPUT_EMAIL_TIPS, '<input type="text" name="email" size="30" class="inputbox" value="' .$subscriber->email.' "  />');
		} else {
			$html .= '<input type="hidden" name="cb_integration" value="1"  />';
		}
		$html .= acajoom::miseEnHTML(_ACA_RECEIVE_HTML , _ACA_RECEIVE_HTML_TIPS, $lists['receive_html']);
		if ($GLOBALS[ACA.'time_zone']==1) {
			$html .= acajoom::miseEnHTML(_ACA_TIME_ZONE_ASK , _ACA_TIME_ZONE_ASK_TIPS, ' <input type="text" name="timezone" size="30" class="inputbox" value="' .$subscriber->timezone.'"  />' );
 		} else {
			$html .= '<input type="hidden" name="timezone" value="' .$subscriber->timezone.'"  />';
 		}

		 if ($access) {
		 	 if ($subscriber->user_id==0) {
				$html .= acajoom::miseEnHTML(_ACA_CONFIRMED , '', $lists['confirmed']);
			} else {
				if(!$cb or !$mainframe->isAdmin()) $html .=  '<input type="hidden" name="confirmed" value="'. $subscriber->confirmed.'" />'; }
				$html .= acajoom::miseEnHTML(_ACA_BLACK_LIST , '', $lists['blacklist']);
				$html .= acajoom::miseEnHTML(_ACA_REGISTRATION_DATE , '', $subscriber->subscribe_date);
				$html .= acajoom::miseEnHTML(_ACA_USER_ID , '', $subscriber->user_id );
		 } else {
		 	$html .=  '<input type="hidden" name="confirmed" value="'. $subscriber->confirmed.'" />';
		 	$html .=  '<input type="hidden" name="blacklist" value="'.$subscriber->blacklist. '" />';
		 }
		$html .= '</table>';
		$html .= '</fieldset></div>';
		$html .=  subscribersHTML::showSubscriberLists($subscriber, $listings, $queues, $frontEnd, $access);
		return $html;
	}


	 function showSubscriberLists($subscriber, $lists, $queues, $frontEnd, $accessAdmin) {
		global $my,$Itemid,$mainframe;

		if(!$mainframe->isAdmin()){
			$Itemid = $GLOBALS[ACA.'itemidAca'];
			$item = '&Itemid=' . $Itemid;
		}else{
			$item ='';
		}

		$html = '';
	 	if (!empty($lists)) {
			$br = "\n\r";
			$html = '<fieldset class="acajoomcss" style="padding: 4px; text-align: left">'.$br;
			$html .= '<legend><strong>'._ACA_SUBSCRIPTIONS.'</strong></legend>' .$br;
			$html .= '<table width="100%"  border="0" cellspacing="0" cellpadding="4" class="adminlist">' .$br;
			$html .= '<tr><th class="title">#</th>' .$br;
			$html .= '<th class="title">'._ACA_LIST_NAME.'</th>' .$br;
			$html .= '<th class="title" align=center>'._ACA_SUBSCRIB.'</th>' .$br;
			if ($accessAdmin) {
			$html .= '<th class="title"><center>id #</center></th>' .$br;
			}
		    if ($frontEnd AND $GLOBALS[ACA.'show_archive']=='1') {
                    $html .= '<th class="title"><center>' .  _ACA_VIEW_ARCHIVE . '</center></th>' .$br;
              } // end if
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
								$access = $queue->acc_level;
							}	else {
								$access = 29;
							}
					}
				} else {
						$access = 29;
				}

				$html .= '<tr><td>'.$i.'</td><td>' .$br;
				$link = ( $list->hidden AND ($list->list_type =='1' or $list->list_type =='7') AND $GLOBALS[ACA.'show_archive'] ) ? 'index.php?option=com_acajoom&act=mailing&task=archive&listid='.$list->id.'&listype='.$list->list_type.$item : '#';
				$html .= '<span class="aca_letter_names"';
				if ($link == "#"){$html .= " onClick='return false;' ";}
				$html.= '>'.compa::toolTip($list->list_desc, $list->list_name, '', '', $list->list_name, $link, 1).' </span>' .$br;
				$html .= '</td><td align="center">' .$br;
				$html .= '<input name="subscribed['. $i.']" value="1"' ;
				 if ( $subscribed == 1 ) { $html .= ' checked="checked"'; }
				$html .= ' type="radio">' ._CMN_YES.$br;
				$html .= '<input name="subscribed['. $i.']" value="0"' ;
				 if ( $subscribed == 0 ) { $html .= ' checked="checked"'; }
				$html .= ' type="radio">' ._CMN_NO.$br;
				$html .= '<input type="hidden" name="sub_list_id['. $i.']" value="'.$list->id.'" />' .$br;
				$html .= '</td>' .$br;
				 if ($accessAdmin) {
					$html .= '<td><center>'.$list->id.'</center></td> ';
				 	$html .=  '<input type="hidden" name="acc_level['.$i.']" value="'.$access. '" />';
				 } else {
				 	$html .=  '<input type="hidden" name="acc_level['.$i.']" value="'.$access. '" />';
				 }

				 if ($frontEnd) {
					if (($list->list_type == 1 or $list->list_type == 7) && $GLOBALS[ACA.'show_archive']=='1' ) {
						$link = sefRelToAbs('index.php?option=com_acajoom&act=mailing&listid=' .$list->id . '&listype=' .$list->list_type .'&task=archive' . $item );
						$img = 'move_f2.png';
						$html .=  '<td height="20"><center>';
						$html .=  '<a href="' . $link. '" >'."\n\r" ;
						$html .=  '<img src="components/com_acajoom/images/' . $img. '" width="20" height="20" align="center" border="0" alt="'._ACA_VIEW_ARCHIVE.'" /></a></center></td>'."\n\r" ;
					} elseif($GLOBALS[ACA.'show_archive']=='1') {
						$html .=  '<td height="20"><center>-</center></td>';
					}
				}
			}
			$html .=  '<tr></table></fieldset>';
		 }

		 return $html;

	}


	 function showSubscribers($subscribers, $action, $listId, &$lists, $start, $limit, $total, $showAdmin, $theLetterId, $emailsearch, $forms) {
		 global $my;

	echo $forms['select'];
	?>
		<input type="hidden" name="option" value="com_acajoom" />
		<input type="hidden" name="act" value="<?php echo $action; ?>" />
		<input type="hidden" name="task" value="" />
    	<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="listid" value="<?php echo $listId; ?>" />
		<input type="hidden" name="limit" value="<?php echo $limit; ?>" />

		<table style="text-align: left; width: 100%;" border="0"
	 cellpadding="2" cellspacing="0"><tbody><tr>
	 <td style="text-align: left; padding-left: 20px;"><span class="sectionname">
	 <?php if ($listId==0) {
	      echo _ACA_SUSCRIB_LIST;
	   } else {
	      $lt_name=lists::getLists($listId, 0, null, '', false, false, true);
	      echo _ACA_SUSCRIB_LIST_UNIQUE."<span style='color: rgb(51, 51, 51);'>".$lt_name[0]->list_name."</span>";
	   }
	 ?>
	 </span>
	 </td>
	 <td style="text-align: right;">
	 <?php echo _ACA_SEL_LIST.' : '. $lists['listid']." ";?> <?php echo _ACA_FILTER; ?> :
	<input type="text" name="emailsearch" value="<?php echo $emailsearch; ?>" class="inputbox" onChange="document.AcajoomFilterForm.submit();" />
	</td></tr></tbody></table>
	</form>

	<?php echo $forms['main']; ?>
		<input type="hidden" name="option" value="com_acajoom" />
		<input type="hidden" name="act" value="<?php echo $action; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="userid" value="" />
    	<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="listid" value="<?php echo $listId; ?>" />
		<input type="hidden" name="start" value="<?php echo $start; ?>" />
		<input type="hidden" name="limit" value="<?php echo $limit; ?>" />
		<input type="hidden" name="emailsearch" value="<?php echo $emailsearch;?>" />
	<table width="100%"  border="0" cellspacing="0" cellpadding="4" class="adminlist">
		<tr>
			<th class="title">#</th>
			<th class="title">&nbsp;</th>
			<th class="title"><?php echo _ACA_INPUT_NAME; ?></th>
			<th class="title"><?php echo _ACA_INPUT_EMAIL; ?></th>
			<th class="title"><?php echo _ACA_SIGNUP_DATE; ?></th>
			<th class="title"><center><?php echo _ACA_REGISTERED; ?>?</center></th>
			<th class="title"><center><?php echo _ACA_CONFIRMED; ?>?</center></th>
			<th class="title"><center><?php echo _ACA_HTML; ?>?</center></th>
	<?php	if ($my->usertype == 'Administrator' OR $my->usertype == 'Super Administrator') { ?>
			<th class="title">id#</th>
	<?php	} ?>
		</tr>
		<?php
			$i = 0;
			if (!empty($subscribers)) {
				foreach ($subscribers as $subscriber) {

				if ($subscriber->user_id <> 0) {
						$img = 'tick.png';
					   $alt = 'Registered';
				} else {
						$img = 'publish_x.png';
					   $alt = 'Unregistered';
				}
				if ($subscriber->confirmed == 1) {
						$imgC = 'tick.png';
					   $altC = 'Confirmed';
				} else {
						$imgC = 'publish_x.png';
					   $altC = 'Not confirmed';
				}
				if ($subscriber->receive_html == 1) {
						$imgH = 'tick.png';
					   $altH = 'HTML';
				} else {
						$imgH = 'publish_x.png';
					   $altH = 'TEXT';
				}
		?>
				<tr class="row<?php echo ($i + 1) % 2;?>">
					<td><?php echo $i+1+ $start; ?></td>
					<td>
						<input type="checkbox" name="cid[<?php echo $i; ?>]" value="<?php echo $subscriber->id; ?>" onclick="isChecked(this.checked);" />
					</td>
					<td>
					<a href="index2.php?option=com_acajoom&act=<?php echo $action; ?>&task=show&userid=<?php echo $subscriber->id; ?>" >
					<?php echo $subscriber->name; ?></a></td>
					<td><?php echo $subscriber->email; ?></td>
					<td><?php echo $subscriber->subscribe_date; ?></td>
					<td align="center">
						<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</td>

					<td align="center">
						<img src="images/<?php echo $imgC;?>" width="12" height="12" border="0" alt="<?php echo $altC; ?>" />
					</td>
					<td align="center">
						<img src="images/<?php echo $imgH;?>" width="12" height="12" border="0" alt="<?php echo $altH; ?>" />
					</td>
					<?php
					$i++;
					if ($my->usertype == 'Administrator' OR $my->usertype == 'Super Administrator') {
						echo '<td align="center">'.$subscriber->id.'</td>';
					}
				}
			}
			?>
			</tr>
	</table>
	</form>
	<?php
	backHTML::footerCounts($start, $limit, $emailsearch, $total, 9, $action, $listId, '');
	 }



	 function unsubscribe($subscriber, $list, $queues, $action, $forms ) {
		 global $my;

 		echo $forms['main'];
		 ?>
   		<input type="hidden" name="option" value="com_acajoom" />
		<input type="hidden" name="act" value="<?php echo $action; ?>" />
   		<input type="hidden" name="task" value="" />
    	<input type="hidden" name="boxchecked" value="0" />
   		<input type="hidden" name="subscriber_id" value="<?php echo $subscriber->id; ?>" />
   		<input type="hidden" name="cle" value="<?php echo md5($subscriber->email); ?>" />
   		<input type="hidden" name="listid" value="<?php echo $list->id; ?>" />
   		<div class="subscribe">
		<?php echo _ACA_UNSUBSCRIBE_MESSAGE.' '; ?>
		<span class="aca_letter_names" onClick='return false;'><?php echo compa::toolTip($list->list_desc, $list->list_name, '', '', $list->list_name, '#', 1); ?></span>
		</div>
		<?php

	}





	 function export($action, $listId) {
		?>
		<form action="index2.php?option=com_acajoom&act=<?php echo $action; ?>&listid=<?php echo $listId; ?>" method="post" name="adminForm" >
			<input type="hidden" name="task" value="" />
			<br /><br />
			<?php echo _ACA_EXPORT_TEXT.' #: '.$listId; ?><br /><br />
			<input type="button" value="Export" class="button" onclick="submitbutton('doExport')" />
		</form>
		<?php
	 }


	 function import($action, $lists) {

		?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;


				if (form.importfile.value == "") {
					alert( "<?php echo addslashes(_ACA_SELECT_FILE).' '. addslashes(_ACA_MENU_IMPORT).'!'; ?>" );
				} else {
					submitform(pressbutton);
				}
			}
		</script>
		<form action="index2.php?option=com_acajoom&act=<?php echo $action; ?>&listid=<?php echo $listId; ?>" method="post" name="adminForm" enctype="multipart/form-data" >
			<input type="hidden" name="task" value="" />
		<table cellpadding="0" cellspacing="0" align="center" class="acajoomcss">
			<tr>
				<th><?php echo _ACA_IMPORT_TIPS; ?></th>
			</tr>
			<tr>
				<td>
					<br />
					<?php echo _ACA_SELECT_IMPORT_FILE.' :'; ?>
					<input type="file" name="importfile" class="inputbox" />
				</td>
			</tr>
		</table>
		<?php

		mosCommonHTML::loadOverlib();

		echo '<br /><br /><table>';
		echo '<tr><th colspan="2">';
		echo _ACA_LIST_IMPORT;
		echo '</th></tr>';
		$i = 0;
		 foreach ($lists as $list) {
			$i++;
			echo '<tr><td width="40">';
			echo  "\n".'<input type="checkbox" class="inputbox" value="1" name="subscribed['.$i.']" />';
			echo  "\n".'<input type="hidden" name="sub_list_id['.$i.']" value="'.$list->id.'" />';
			echo  '</td><td>';
			echo  "\n".'<span class="aca_list_name  onClick=\'return false;\'">'. compa::toolTip($list->list_desc,$list->list_name, '', '', $list->list_name, '#', 1).'</span>';
			echo "\n".'<input type="hidden" name="acc_level['.$i.']" value="0" />';
			echo '</td></tr>';

		 }
		echo '<tr><td colspan="2"><center><input type="button" value="Import" class="button" onclick="submitbutton(\'doImport\')" /></center></td></tr>';
		echo '</table></form>';

	 }



 }


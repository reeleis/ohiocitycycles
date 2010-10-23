<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

 class backHTML {

	 function formStart($javascriptType='', $html = 0, $images=null) {
		global $_VERSION;
		$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;
		if ($joomAca15) $editor =& JFactory::getEditor();
		mosCommonHTML::loadOverlib();
		 echo '<script language="javascript" type="text/javascript">';
		 switch ($javascriptType) {
			case 'edit_mailing':
				if(!$joomAca15){
					?>
					var folderimages = new Array;
					<?php
					$i = 0;
					foreach ($images as $k=>$items) {
						foreach ($items as $v) {
							echo "folderimages[".$i++."] = new Array( '$k','".addslashes( ampReplace( $v->value ) )."','".addslashes( ampReplace( $v->text ) )."' );\t";
						}
					}
				}
			?>

			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'show') {
					submitform( pressbutton );
					return;
				}
				<?php
				if(!$joomAca15){
				?>
					var temp = new Array;
					for (var i=0, n=form.imagelist.options.length; i < n; i++) {
						temp[i] = form.imagelist.options[i].value;
					}
					form.images.value = temp.join( '\n' );
				<?php
				}
				?>
				if (form.subject.value == ""){
					alert( "Mailing must have a title" );
				} else {
					<?php
					if($html != 0) {
						if ($joomAca15) echo $editor->save( 'content' );
						else 	getEditorContents( 'editor1', 'content') ;
					 }
					?>
					if(pressbutton){
						if (pressbutton == 'saveSend') {
							if (!confirm('Are you sure you want to proceed?')){return;}
							form.action = 'index2.php?option=com_acajoom&act=mailing';
						}
						form.task.value=pressbutton;
					}
					form.submit();
				}
			}
		<?php
				break;
			case 'show_mailing':
			?>
			function checkcid(myField) {
				myField.checked = true;
				isChecked(true);
			}
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				if (pressbutton == 'sendNewsletter') {
					if (!confirm('Are you sure you want to proceed?')){return;}
					form.action = 'index2.php?option=com_acajoom&act=mailing';
				}
				submitform( pressbutton );
			}
			<?php
				break;
			case 'configpanel':
			?>
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				if (pressbutton == 'sendQueue') {
					form.action = 'index2.php?option=com_acajoom&act=mailing';
				}
				submitform( pressbutton );
			}
			<?php
				break;
			case 'editlist':
				?>
				function submitbutton(pressbutton) {
					var form = document.adminForm;
					if (pressbutton == 'cancel') {
						submitform( pressbutton );
						return;
					}
				<?php
					if ($GLOBALS[ACA.'listHTMLeditor'] == '1') {
					if ($joomAca15) echo $editor->save( 'list_desc' );
					else 	getEditorContents( 'editor1', 'list_desc') ;
					}
					if($html) {
						if ($joomAca15) {
							$editor->save( 'layout' );
							$editor->save( 'subscribemessage' );
							$editor->save( 'unsubscribemessage' );
						} else {
							getEditorContents( 'editor2', 'layout') ;
							getEditorContents( 'editor3', 'subscribemessage') ;
							getEditorContents( 'editor4', 'unsubscribemessage');
						}
					}
				?>
					submitform( pressbutton );
				}
				<?php
				break;
			default:
			?>
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				submitform( pressbutton );
			}
			<?php
				break;
		 	};
		echo '</script>';
	 }

	 function formEnd($values = '') {

		if (!empty($values)) {
			foreach ($values as $value) {
				echo '<input type="hidden" name="'.$value->name.'" value="'.$value->value.'" />'."\n\r";
			}
		}
		echo '<input type="hidden" name="option" value="com_acajoom" />'."\n\r";
		echo '<input type="hidden" name="task" value="" />'."\n\r";
    	echo '<input type="hidden" name="boxchecked" value="0" />'."\n\r";
		echo '</form>'."\n\r";

	 }


	 function _header($title, $img , $message, $task, $action ) {

	     $message = acajoom::messageMgmt($action, $task, $message);
?>
         <link rel="stylesheet" href="components/com_acajoom/cssadmin/acajoom.css" type="text/css" >
         <div id="acajoom">
         <table class="adminheading" width="99%">
         <tr>
         <?php if (empty($message))  {   ?>
               <th style="padding-left:60px; background: url(<?php echo $GLOBALS['mosConfig_live_site'];?>/administrator/images/<?php echo $img;?>) no-repeat left;" align="left"><?php echo $title;?></th>
               <td  align="right"><a href="index2.php?option=com_acajoom"><img src="components/com_acajoom/images/acajoom.jpg" alt="Acajoom Logo" border="0" align="right" /></a></td>
         <?php } else {
         	$lgt=  strlen($title)*11+80;
         ?>
               <td align="left" width="<?php echo $lgt;?>">
                  <table class="adminheading">
                     <tr>
		               <th style="padding-left:60px; background: url(<?php echo $GLOBALS['mosConfig_live_site'];?>/administrator/images/<?php echo $img;?>) no-repeat left;" align="left">
		               <?php

		                echo $title;
		                ?>
		               </th>
                     </tr>
                  </table>
               </td>
               <td>
               		<center>
                  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
                     <tr>
                     <td class="none" align="center"><?php echo $message;?></td>
                     <td  width="120px" align="right"><a href="index2.php?option=com_acajoom" target="_blank"><img src="components/com_acajoom/images/acajoom.jpg" alt="Acajoom Logo" border="0" align="right" /></a></td>
                     </tr>
                  </table>
               		</center>
                </td>
         <?php }   ?>

         </tr>
         </table>
<?php

	 if ($GLOBALS[ACA.'show_guide'] == 1 AND
	  	$task !='edit' AND $task !='doNew' AND $task !='new') {
		require_once( WPATH_ADMIN . 'guide.acajoom.php' );
	  	echo createGuide();
	}
}



	function _footer() {
		backHTML::_footerSignature();
	}


	 function _footerSignature() {

		$x = "@";
		$y="support";
		$z="acajoom.com";
		$mail=$y.$x.$z;
		echo '<div style="clear:both;"></div>';
		echo '<br /><div align="center" class="footer"><span class="footer"><a href="'. $GLOBALS[ACA.'homesite'] .'" target="_blank" class="footer">'. acajoom::version() .'</a>' .
				', Powered by <a href="http://www.joobisoft.com" target="_blank" class="footer">Joobi</a>.';
		echo '</div>';
    }



	 function footerCounts($start, $limit, $emailsearch, $total, $colspan, $action, $listId, $listType) {
	?>
	<center>
	<table width="100%"  border="0" cellspacing="0" cellpadding="4" class="adminlist">
		<tr>
			<th colspan="<?php echo $colspan; ?>" align="center">
				<a href="index2.php?option=com_acajoom&act=<?php echo $action; ?>&start=0&limit=<?php echo $limit;?>&emailsearch=<?php echo $emailsearch; ?>&listype=<?php echo $listType; ?>&listid=<?php echo $listId; ?>" class="pageNav"><< </a>&nbsp;
	<?php
			if (($limit * 5) < $start) {
				$i = $start - 50;
			} else {
				$i = 0;
			}
			$last = 10 + (intval($i / $limit) + 1);
			for ($j = (intval($i / $limit) + 1); $i < $total && $j <= $last; $i += $limit, $j++) {
				if($i == $start) {
					echo $j . '&nbsp;';
				} else {
	?>
				<a href="index2.php?option=com_acajoom&act=<?php echo $action; ?>&start=<?php echo $i; ?>&limit=<?php echo $limit;?>&emailsearch=<?php echo $emailsearch; ?>&listype=<?php echo $listType; ?>&listid=<?php echo $listId; ?>" class="pageNav"><?php echo $j;?></a>&nbsp;
	<?php
				}
			}
			if (($total - $limit) < 0) {
				$laststart = 0;
			} else {
				$laststart = $total - $limit;
			}
	?>
				<a href="index2.php?option=com_acajoom&act=<?php echo $action; ?>&start=<?php echo $laststart;?>&limit=<?php echo $limit;?>&emailsearch=<?php echo $emailsearch; ?>&listype=<?php echo $listType; ?>&listid=<?php echo $listId; ?>" class="pageNav"> >></a>&nbsp;
			</th>
		</tr>
		<tr>
			<td colspan="<?php echo $colspan;?>" align="center">
				<form action="index2.php" method="post" name="selectForm">
					<select name="limit" class="inputbox" size="1" onchange="document.selectForm.submit();">
	<?php
			for($i = 10; $i <= 50; $i += 10) {
	?>
						<option value="<?php echo $i;?>" <?php if($i == $limit) { echo "selected=\"selected\""; } ?>><?php echo $i;?></option>
	<?php
			}
	?>
					</select>
					<input type="hidden" name="option" value="com_acajoom" />
					<input type="hidden" name="act" value="<?php echo $action; ?>" />
					<input type="hidden" name="task" value="" />
					<input type="hidden" name="userid" value="" />
			    	<input type="hidden" name="boxchecked" value="0" />
					<input type="hidden" name="listid" value="<?php echo $listId; ?>" />
					<input type="hidden" name="listype" value="<?php echo $listType; ?>" />
					<input type="hidden" name="start" value="<?php echo $start; ?>" />
					<input type="hidden" name="emailsearch" value="<?php echo $emailsearch;?>" />
				</form>
				&nbsp;
	<?php
			if (($start + $limit) > $total) {
				$through = $total;
			} else {
				$through = $start + $limit;
			}
			echo _ACA_RESULTS . ' ' . ($start + 1) . ' - ' . ($through) . ' of ' . $total; ?>
			</td>
		</tr>
	</table>
	</center>
	<?php
	 }

	 function controlPanel() {
	 	//hack for JOomla 13 ADRIEN
	 		unset($GLOBALS["task"]);
	 		unset($_REQUEST["task"]);

?>

<link rel="stylesheet" href="components/com_acajoom/cssadmin/acajoom.css" type="text/css" >
<div align="center" class="centermain">
<div id="acajoom">
		<table class="acajoomcss">
            <tr>
         	<td width="58%" valign="top">
				<?php echo backHTML::iconsPanel(); ?>
			</td>
			<td width="42%" valign="top">

			<div style="width=100%;">
			<form action="index2.php" method="post" name="adminForm">
			<?php


			$tabs = new mosTabs(1);
			$tabs->startPane( 'acaControlPanel' );
			$tabs->startTab( _ACA_MENU_TAB_SUM , "acaControlPanel.Summary");
			?>
			<table class="acajoom_stats" style="text-align: left; width: 100%; " cellpadding="2" cellspacing="0">
			<tbody>
				<tr>
					 <th style="text-align: center;"><?php echo '#'; ?>
					 </th>
					 <th style="text-align: center;"><?php echo _ACA_MENU_TAB_LIST; ?></th>
					 <th style="text-align: center;"><?php echo _ACA_MENU_MAILING_TITLE; ?></th>
					 <th style="text-align: center;"><?php echo _ACA_SENT_MAILING; ?></th>
					 <th style="text-align: center;"><?php echo _ACA_DESC_SUBSCRIBERS; ?></th>
				</tr>
			 <?php
			$html = '';
			$totalist = 0;
			$totalmail = 0;
			$totalsub = 0;
			$totalsent = 0;
			$nb = explode(',', $GLOBALS[ACA.'activelist']);
			$size = sizeof($nb);
			for($i = 0; $i < $size; $i ++) {
				$index = $nb[$i];
				if ($GLOBALS[ACA.'listshow'.$index]>0 AND $GLOBALS[ACA.'listype'.$index] == 1) {
					$html .= '<tr>';
					$html .= '<td><b>'.@constant( $GLOBALS[ACA.'listnames'.$index] ).'</b></td>';
					$html .= '<td style="text-align: center; ">' .$GLOBALS[ACA.'act_totallist'.$index].' </td>';
					$html .= '<td style="text-align: center; ">' .$GLOBALS[ACA.'act_totalmailing'.$index].' </td>';
					$html .= '<td style="text-align: center; ">' .$GLOBALS[ACA.'totalmailingsent'.$index].' </td>';
					$html .= '<td style="text-align: center; ">' .$GLOBALS[ACA.'act_totalsubcribers'.$index].' </td>';
					$html .= '</tr>';
					$totalist = $totalist + $GLOBALS[ACA.'act_totallist'.$index];
					$totalmail = $totalmail + $GLOBALS[ACA.'act_totalmailing'.$index];
					$totalsent = $totalsent + $GLOBALS[ACA.'totalmailingsent'.$index];
					if ($GLOBALS[ACA.'act_totalsubcribers'.$index]<$totalsub) $totalsub = $GLOBALS[ACA.'act_totalsubcribers'.$index];
				}
			}

			$html .= '<tr>';
			$html .= '<td><b>'._ACA_CP_TOTAL.'</b></td>';
			$html .= '<td style="text-align: center; ">' .$totalist.' </td>';
			$html .= '<td style="text-align: center; ">' .$totalmail.' </td>';
			$html .= '<td style="text-align: center; ">' .$totalsent.' </td>';
			$html .= '<td style="text-align: center; ">' .$totalsub.' </td>';
			$html .= '</tr>';
			echo $html;
			?>
			 </tbody></table>
			 <br />
			<?php
			if (class_exists('auto')) echo auto::showQueue();
			$tabs->endTab();

			$tabs->startTab( _ACA_MENU_SUBSCRIBERS , "acaControlPanel.Subscribers");
			$emailsearch = '';
      		$listId = 0;
      		$start = mosGetParam($_REQUEST, 'start', 0);
		 	$limit = mosGetParam($_REQUEST, 'limit', 15);
		 	$order = mosGetParam($_REQUEST, 'order', 'date');
 	     	$total = 0;

			$subscribers = subscribers::getSubscribers($start, $limit, $emailsearch, $total, $listId, '', 1, 1, 'sub_dateD');
			mosCommonHTML::loadOverlib();

			?>
			<script type="text/javascript">
				function checkcid(myField) {
					myField.checked = true;
					isChecked(true);
				}
			</script>
<!--			<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>  -->

			<form action="index2.php" method="post" name="adminForm">
				<input type="hidden" name="option" value="com_acajoom" />
				<input type="hidden" name="act" value="acajoom" />
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
					<th class="title" style="text-align: left;"><?php echo _ACA_INPUT_NAME; ?></th>
					<th class="title" style="text-align: left;"><?php echo _ACA_INPUT_EMAIL; ?></th>
					<th class="title" style="text-align: center;"><?php echo _ACA_SIGNUP_DATE; ?></th>
				</tr>

				<?php
				$i = 0;
				foreach ($subscribers as $subscriber) {
				?>
				<tr class="row<?php echo ($i++) % 2;?>">
					<td><?php echo $i + $start; ?></td>
					<td style="text-align: left;">
					<a href="index2.php?option=com_acajoom&act=subscribers&task=show&userid=<?php echo $subscriber->id; ?>" >
					<?php echo $subscriber->name; ?></a></td>
					<td style="text-align: left;"><?php echo $subscriber->email; ?></td>
					<td style="text-align: center;"><?php echo mosFormatDate( $subscriber->subscribe_date, '%x' ); ?></td>
				</tr>
				<?php		}   ?>
			</table>
			</form>
			<?php
			backHTML::footerCounts($start, $limit, $emailsearch, $total, 4, '', $listId, '');

			$tabs->endTab();

			$tabs->startTab( _ACA_MENU_TAB_LIST , "acaControlPanel.Lists");

			$lists = lists::getLists(0, 0, 1, '', false , false, false);
			?>
			<table class="adminlist">
				<tr>
					<th class="title">#</th>
					<th class="title" width="65%"  style="text-align: left;"><?php echo _ACA_LIST_NAME; ?></th>
					<th class="title" width="25%"  style="text-align: left;"><?php echo _ACA_LIST_TYPE; ?></th>
					<th class="title"  style="text-align: center;">#id</th>
				</tr>
			<?php
			$i = 0;
			foreach ($lists as $list) {
				$i++;
				$link = 'index2.php?option=com_acajoom&act=mailing&task=show&listid='. $list->id;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td  style="text-align: left;">
						<a href="<?php echo $link; ?>">
							<?php echo $list->list_name;?></a>
					</td>
					<td  style="text-align: left;"><a href='index2.php?option=com_acajoom&act=mailing&listype=<?php	echo $list->list_type;  ?>'><?php	echo @constant( $GLOBALS[ACA.'listname'.$list->list_type] );  ?></a></td>
					<td  style="text-align: center;"><?php echo $list->id; ?></td>
					</tr>
			<?php
			}
			?>
			<tr>
				<th colspan="4">
				</th>
			</tr>
			</table>
			<?php
			$tabs->endTab();
			$tabs->endPane();
?>
			</form>
		</div>
		<div style="clear:both; float:left;">
		<?php echo acajoom::printM('blue', _ACA_SERVER_LOCAL_TIME.' :'.mosFormatDate(acajoom::getNow(), '%A, %d %B %Y %H:%M', 0)); ?>
		</div>
   <td>
   </tr>
   </table>
   </div>
</div>
<?php
	 }

	 function iconsPanel() {
	     global $my;
		echo '<div id="cpanel">';

	    $link = 'index2.php?option=com_acajoom&act=list';
	    backHTML::quickiconButton( $link, 'addedit.png', _ACA_MENU_LIST , false, 'admin' );

		$link = 'index2.php?option=com_acajoom&act=subscribers';
   	    backHTML::quickiconButton( $link, 'addusers.png', _ACA_MENU_SUBSCRIBERS, false, 'admin'  );

		$nb = explode(',', $GLOBALS[ACA.'activelist']);
		$size = sizeof($nb);
		for($i = 0; $i < $size; $i ++) {
			$index = $nb[$i];
			if ($GLOBALS[ACA.'listshow'.$index]>0
			 AND $GLOBALS[ACA.'listype'.$index] == 1 ) {
				$link = 'index2.php?option=com_acajoom&act=mailing&listype='.$index;
				backHTML::quickiconButton( $link, $GLOBALS[ACA.'listlogo'.$index], @constant($GLOBALS[ACA.'listnames'.$index]) , false, 'admin' );
			}
		}

		$link = 'index2.php?option=com_media';
		backHTML::quickiconButton( $link, 'mediamanager.png', _ACA_MENU_MEDIA , false, 'admin' );

		$link = 'index2.php?option=com_acajoom&act=statistics';
		backHTML::quickiconButton( $link, 'query.png', _ACA_MENU_STATS , false, 'admin' );

		$link = 'index2.php?option=com_acajoom&act=configuration';
		backHTML::quickiconButton( $link, 'menu.png', _ACA_MENU_CONF , false, 'admin' );

		//$link = 'index2.php?option=com_acajoom&act=update';
		//backHTML::quickiconButton( $link, 'backup.png', _ACA_MENU_UPDATE ,false, 'admin'  );

		$link = "http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22";
		backHTML::quickiconButton( $link, 'support.png', _ACA_MENU_HELP, true, 'Registered' );

		$link = 'http://www.acajoom.com/index.php?option=com_content&task=blogsection&id=5&Itemid=68';
		backHTML::quickiconButton( $link, 'impressions.png', _ACA_MENU_LEARN , true, 'Registered' );

		$link = "http://www.acajoom.com/index.php?option=com_content&task=blogcategory&id=29&Itemid=82";
		backHTML::quickiconButton( $link, 'browser.png', _ACA_MENU_VIDEO, true, 'Registered' );

		$link = 'index2.php?option=com_acajoom&act=about';
		backHTML::quickiconButton( $link, 'credits.png', _ACA_MENU_ABOUT , false, 'Registered' );

		echo '</div>';

	 }


	 function controlPanelBottonStart($title , $img) {
		?>
		<link rel="stylesheet" href="components/com_acajoom/css/acajoom.css" type="text/css" >
		<div align="center" class="centermain">
		<div id="acajoom">
				<table class="panelheading" border="0">
				<tr>
					<th class="acajoom" style=" height: 32px; background: url(administrator/images/<?php echo $img; ?>) no-repeat left;">
					<?php echo  $title;?></th>
				</tr>
				</table>
				<table class="panelheading">
		            <tr>
		         	<td width="58%" valign="top">
			<div id="cpanel">
		<?php
	 }


	function controlPanelBottomEnd() {
		?>
			</div>
			</td>
		 	</tr>
		 	</table>
		 	</div></div>
	 	<?php
	 }



	function about(){

		echo '<table width="100%" align="left"><tr>';
		echo '<td>';
		echo '<form action="index2.php" method="post" name="adminForm">';
		acajoom::beginingOfTable('acajoomtable');
		acajoom::miseEnPage('Description', '', constant('_ACA_DESC_' .strtoupper($GLOBALS[ACA.'type'])));
		acajoom::miseEnPage('Project Manager', '', 'Adrien Baborier');
		acajoom::miseEnPage('Contributor', '', 'Christelle Gesset');
		acajoom::miseEnPage('Logo design', '', '<a href="http://www.gaboink.com" target="_blank">George Jones</a>');
		acajoom::miseEnPage('Template design', '', '<a href="http://www.72dpi.net.au" target="_blank">Ryan Scott</a>');
		acajoom::miseEnPage('Video tutorials', '', '<a href="http://www.wisewomengroup.com" target="_blank">Lisa Egan</a>');
		acajoom::miseEnPage('CB Integration', '', 'Mikko R&ouml;nkk&ouml;');
		acajoom::miseEnPage('Add-ons', '', 'Kyle Witt');
		acajoom::miseEnPage('Language Translation', '', '');
		acajoom::miseEnPage('Danish', '', 'Joergen Floes');
		acajoom::miseEnPage('Dutch', '', 'Tromp Wezelman & Bart Bevers');
		acajoom::miseEnPage('French', '', 'Christelle Gesset');
		acajoom::miseEnPage('German', '', 'David Freund & Frank Jansen');
		acajoom::miseEnPage('Hungarian', '', 'Zolt&aacute;n Varanka');
		acajoom::miseEnPage('Italian', '', 'Maria Luisa Rossari');
		acajoom::miseEnPage('Norwegian', '', '<a href="http://www.timeoffice.com" target="_blank">Irma Rustad</a>');
		acajoom::miseEnPage('Polish', '', 'Andrzej Herzberg');
		acajoom::miseEnPage('Portuguese', '', 'Ricardo Sim&otilde;es');
		acajoom::miseEnPage('Russian', '', 'Salikhov Ilyas');
		acajoom::miseEnPage('Simplified Chinese', '', '<a href="http://www.joomlagate.com" target="_blank">Baijianpeng</a>');
		acajoom::miseEnPage('Spanish', '', '<a href="http://www.eaid.org" target="_blank">Jorge Pasco</a>');
		acajoom::miseEnPage('Swedish', '', 'Janne Karlsson');
		acajoom::miseEnPage(' ', '', '   ');
		acajoom::miseEnPage(_ACA_VERSION, '', acajoom::version());
		acajoom::miseEnPage(' ', '', '   ');
		acajoom::miseEnPage(_ACA_DESC_HOME, '', '<a href="'.$GLOBALS[ACA.'homesite'].'" target="_blank">www.Acajoom.com</a>');
		acajoom::miseEnPage(_ACA_MENU_HELP, '', '<a href="http://www.acajoom.com/content/blogcategory/29/93/" target="_blank">Documentation</a>');
		acajoom::miseEnPage(_ACA_MENU_HELP, '', '<a href="http://www.acajoom.com/index.php?option=com_joomlaboard&Itemid=26&task=listcat&catid=22" target="_blank">Forum</a>');
		acajoom::miseEnPage(_ACA_MENU_LEARN, '', '<a href="'.$GLOBALS[ACA.'homesite'].'index.php?option=com_content&task=blogsection&id=5&Itemid=68" target="_blank">Education Center</a>');
		acajoom::miseEnPage('Copyrights', '', 'Acajoom <i>Your Communciation Partner</i>, &copy; Acajoom Services');
### http://www.acajoom.com/license.php
### http://www.acajoom.com/license.php
		acajoom::miseEnPage( _ACA_LICENSE , '', '<a href="http://www.acajoom.com/index.php?option=com_content&task=view&id=2282&Itemid=84" target="_blank">&copy; Acajoom Services</a>');
		acajoom::endOfTable();
		backHTML::formEnd();
		echo '</td>';
		echo '<td width="380px">';
		$logo = 'acajoom_slog_'. strtolower($GLOBALS[ACA.'type']).'.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '</tr></table>';

	 }


	function installPRO(){

		$update = new wupdate();
	 	$available = $update->checkNewVersion();
		if ($available) {
			echo '<center>';
			echo acajoom::printM( 'ok' , _ACA_UPDATE_MESSAGE);
			echo '<br /><br />';
			echo acajoom::printM( 'green' , _ACA_UPDATE_CLICK_HERE);
			echo '</center>';
		}

		$type = ( isset($GLOBALS[ACA.'type']) ) ? $GLOBALS[ACA.'type'] : 'News';
		echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"	 border="0" cellpadding="10" cellspacing="2">' .
				'<tbody><tr><td>';
		echo '<br /><big><big><b>' . constant( '_ACA_DESC_'. strtoupper($type) );
		echo '</big></big></b></td>';
		echo '<td width="380px">';
		$logo = 'acajoom_slog_'. strtolower( $type ).'.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '</tr></table>';

		echo '<br />';
		echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"	 border="0" cellpadding="10" cellspacing="2">' .
				'<tbody><tr>';
		echo '<td width="380px">';
		$logo = 'acajoom_pro.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '<td><br /><big><big><b>' . _ACA_THINK_PRO;
		echo '</big></big></b>' .
				'<ul><li>'._ACA_THINK_PRO_1.'</li>' .
						'<li>'._ACA_THINK_PRO_2.'</li>' .
						'<li>'._ACA_THINK_PRO_3.'</li>' .
						'<li>'._ACA_THINK_PRO_4.'</li>' .
						'<li>'._ACA_THINK_PRO_5.'</li>' .
						'<li>'._ACA_THINK_PRO_6.'</li></ul>' .
				'</td>';
		echo '</tr></table>';



	 }


	function installPlus(){

		$update = new wupdate();
	 	$available = $update->checkNewVersion();
		if ($available) {
			echo '<center>';
			echo acajoom::printM( 'ok' , _ACA_UPDATE_MESSAGE);
			echo '<br /><br />';
			echo acajoom::printM( 'green' , _ACA_UPDATE_CLICK_HERE);
			echo '</center>';
		}

		$type = ( isset($GLOBALS[ACA.'type']) ) ? $GLOBALS[ACA.'type'] : 'News';
		echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"	 border="0" cellpadding="10" cellspacing="2">' .
				'<tbody><tr><td>';
		echo '<br /><big><big><b>' . constant( '_ACA_DESC_'. strtoupper($type) );
		echo '</big></big></b></td>';
		echo '<td width="380px">';
		$logo = 'acajoom_slog_'. strtolower( $type ).'.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '</tr></table>';

		echo '<fieldset class="acajoomcss" style="padding: 10px; text-align: left">';
		echo '<legend><strong>'._ACA_NOTIF_UPDATE.'</strong></legend>';

		$listID = 11;
		$name = 'Acajoom Updates';
		echo '<!--  Begining : Acajoom Form    -->
		<div>
		<form action="http://www.acajoom.com/index.php?option=com_acajoom" method="post" name="modacajoomForm">
		<input id="wz_31" type="checkbox" class="inputbox" value="1" name="subscribed[1]" checked="checked" />
		<input type="hidden" name="sub_list_id[1]" value="'.$listID.'" />';
		echo $name.'<br /><input type="hidden" name="acc_level[1]" value="29" />
		<input id="wz_11" type="text" size="30" value="Name" class="inputbox" name="name" onblur="if(this.value==\'\') this.value=\'Name\';" onfocus="if(this.value==\'Name\') this.value=\'\' ; " />
		<br />
		<input id="wz_12" type="text" size="30" value="E-mail" class="inputbox" name="email" onblur="if(this.value==\'\') this.value=\'E-mail\';" onfocus="if(this.value==\'E-mail\') this.value=\'\' ; " />
		<br /><input id="wz_2" type="checkbox" class="inputbox" value="1" name="receive_html"  checked="checked"  />';
		echo _ACA_RECEIVE_HTML. '<br />
		<input id="wz_22" type="submit" value="Subscribe" class="button" />
		<input type="hidden" name="act" value="subscribe" />
		</form>
		</div>
		<!--  End : Acajoom Form    -->';
		echo '</fieldset><br/>';

		echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"	 border="0" cellpadding="10" cellspacing="2">' .
				'<tbody><tr><td>';
		echo '<br /><big><big><b>' . _ACA_THINK_PLUS;
		echo '</big></big></b>' .
				'<ul><li>'._ACA_THINK_PLUS_1.'</li>' .
						'<li>'._ACA_THINK_PLUS_2.'</li>' .
						'<li>'._ACA_THINK_PLUS_3.'</li>' .
								'<li>'._ACA_THINK_PLUS_4.'</li></ul>' .
				'</td>';
		echo '<td width="380px">';
		$logo = 'acajoom_pro.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '</tr></table>';
		echo '<br />';
		echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;"	 border="0" cellpadding="10" cellspacing="2">' .
				'<tbody><tr>';
		echo '<td width="380px">';
		$logo = 'acajoom_plus.png';
		echo '<a href="http://www.acajoom.com" target="_blank"><img src="components/com_acajoom/images/'.$logo.'" alt="Acajoom Logo" border="0" align="center" /></a>';
		echo '</td>';
		echo '<td><br /><big><big><b>' . _ACA_THINK_PRO;
		echo '</big></big></b>' .
				'<ul><li>'._ACA_THINK_PRO_1.'</li>' .
						'<li>'._ACA_THINK_PRO_2.'</li>' .
						'<li>'._ACA_THINK_PRO_3.'</li>' .
						'<li>'._ACA_THINK_PRO_4.'</li>' .
						'<li>'._ACA_THINK_PRO_5.'</li>' .
						'<li>'._ACA_THINK_PRO_6.'</li></ul>' .
				'</td>';
		echo '</tr></table>';


	 }

	 function showStatistics($listStats, $mailing, $globalStats, $html_read, $html_unread, $text, $listId) {


?>
<form action="index2.php" method="post" name="adminForm">
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="adminlist">
	<tr>
		<th colspan="2" class="title"><?php echo _ACA_MAILING_LIST_DETAILS; ?>:</th>
	</tr>
	<tr>
		<td width="200" align="left"><?php echo @constant( $GLOBALS[ACA.'listname'.$listStats->list_type] ); ?>:</td>
		<td align="left"><?php echo $listStats->list_name; ?></td>
	</tr>
	<tr>
		<td width="200" align="left"><?php echo _ACA_DESCRIPTION; ?>:</td>
		<td align="left"><?php echo $listStats->list_desc; ?></td>
	</tr>
	<tr>
		<td width="200" align="left"><?php echo _ACA_LIST_ISSUE; ?>:</td>
		<td align="left"><?php echo $mailing->issue_nb; ?></td>
	</tr>
	<tr>
		<td width="200" align="left"><?php echo _ACA_SUBJECT; ?>:</td>
		<td align="left"><?php echo $mailing->subject;?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<?php
		  $stat_tabs = new mosTabs(0);
		  $stat_tabs->startPane('acaStats');
		  $stat_tabs->startTab(_ACA_GLOBALSTATS, 'acaStats');
?>
	<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="adminlist">
<?php

		 if($listStats->html == 1) {

?>
		<tr>
			<td width="200" align="left"><?php echo _ACA_SEND_IN_HTML_FORMAT; ?>:</td>
			<td align="left"><?php echo $globalStats->html_sent; ?></td>
		</tr>
		<tr>
			<td width="200" align="left"><?php echo _ACA_VIEWS_FROM_HTML; ?>:</td>
			<td align="left"><?php echo $globalStats->html_read; ?></td>
		</tr>
<?php
		 }
?>
		<tr>
			<td width="200" align="left"><?php echo _ACA_SEND_IN_TEXT_FORMAT; ?>:</td>
			<td align="left"><?php echo $globalStats->text_sent; ?></td>
		</tr>
	</table>
<?php
		  $stat_tabs->endTab();
		  $stat_tabs->startTab(_ACA_DETAILED_STATS, 'acaStats.detail');
?>
	<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="adminlist">
		<tr>
			<td valign="top">
				<table width="100%" cellpadding="4" cellspacing="0" border="1" align="center" class="adminlist">
					<tr>
						<td><?php echo _ACA_HTML_READ; ?></td>
						<td><?php echo _ACA_HTML_UNREAD; ?></td>
						<td><?php echo _ACA_TEXT_ONLY_SENT; ?></td>
					</tr>
					<tr>
						<td valign="top" align="left" width="33%">
<?php

		 if (sizeof($html_read) > 0) {

			 foreach ($html_read as $htmlread){
				 echo $htmlread->name . ' (' . $htmlread->email . ')<br />';
			 }
		 }
?>
						</td>
						<td valign="top" align="left" width="33%">
<?php

		 if (sizeof($html_unread) > 0) {

			 foreach ($html_unread as $htmlunread){
				 echo $htmlunread->name . ' (' . $htmlunread->email . ')<br />';
			 }
		 }
?>
						</td>
						<td valign="top" align="left" width="33%">
<?php

		 if (sizeof($text) > 0) {

			 foreach ($text as $atext){
				 echo $atext->name . ' (' . $atext->email . ')<br />';
			 }
		 }
?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php
		  $stat_tabs->endTab();
		  $stat_tabs->endpane();
?>
   	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="option" value="com_acajoom" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="statistics" />
	<input type="hidden" name="listid" value="<?php echo $listId; ?>" />
	<input type="hidden" name="mailingid" value="<?php echo $mailing->mailing_id; ?>" />
	<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
</form>
<?php
	 }


	function showCompsList($update) {

		?>
		</table>
		<?php
		if ($update->otherComponent) {
				?>
				<table width="100%" cellpadding="4" cellspacing="0" border="0" align="left" class="adminlist">
					<tr>
						<th colspan="4"><?php echo _ACA_CHECK_COMP; ?></th>
					</tr>
				<?php

				 foreach ($update->otherComponent as $component) {
					$moreLink = '<a href="'.$component->homePath.'" traget="_blank">'. _ACA_MORE_INFO . '</a>';
					$tryitLink = '<a href="'.$component->download.'" traget="_blank">'. _ACA_TRY_IT . '</a>';
				?>
					<tr>
						<td>
						<?php
							echo $component->longVersion;
							echo '<br />'.$component->desc;
						 ?>
						</td>
					<td>
					<?php
						echo $tryitLink;
					 ?>
					</td>
					<td>
					<?php
						echo $moreLink;
					 ?>
					</td>
					</tr>
				<?php
				}
				?>
				</table>
				<?php
		}
	}


	function showUpdateOptions($update) {


 if ((!empty($update->needAdd)) || (!empty($update->needRemove)) || (!empty($update->needUpdate))) {
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" cellpadding="4" cellspacing="0" border="0" align="left" class="adminlist">
			<tr>
				<th colspan="4"><?php echo _ACA_NEED_UPDATED; ?></th>
			</tr>
			<tr class="row0">
				<td>&nbsp;</td>
				<td><?php echo _ACA_FILENAME; ?></td>
				<td><center><?php echo _ACA_CURRENT_VERSION; ?></center></td>
				<td><center><?php echo _ACA_NEWEST_VERSION; ?></center></td>
			</tr>
		<?php

		 	 foreach ($update->needUpdate as $file) {
		?>
			<tr>
				<td><input type="checkbox" name="needUpdated[]" value="<?php echo $file; ?>" checked="checked" class="inputbox" /></td>
				<td><?php echo $file; ?></td>
				<td><center><?php echo $update->local[$file]; ?></center></td>
				<td><center><?php echo $update->globalVersion[$file]; ?></center></td>
			</tr>
		<?php
		 	 }
		?>
			<tr>
				<th colspan="4"><?php echo _ACA_NEED_ADDED; ?></th>
			</tr>
			<tr class="row0">
				<td>&nbsp;</td>
				<td><?php echo _ACA_FILENAME; ?></td>
				<td><center><?php echo _ACA_CURRENT_VERSION; ?></center></td>
				<td><center><?php echo _ACA_NEWEST_VERSION; ?></center></td>
			</tr>
		<?php

		 	 foreach ($update->needAdd as $file) {
		?>
			<tr>
				<td><input type="checkbox" name="needAdded[]" value="<?php echo $file; ?>" checked="checked" class="inputbox" /></td>
				<td><?php echo $file; ?></td>
				<td>&nbsp;</td>
				<td><center><?php echo $update->globalVersion[$file]; ?></center></td>
			</tr>
		<?php
		 	 }
		?>
			<tr>
				<th colspan="4"><?php echo _ACA_NEED_REMOVED; ?></th>
			</tr>
			<tr class="row0">
				<td>&nbsp;</td>
				<td><?php echo _ACA_FILENAME; ?></td>
				<td><center><?php echo _ACA_CURRENT_VERSION; ?></center></td>
				<td><center><?php echo _ACA_NEWEST_VERSION; ?></center></td>
			</tr>
		<?php

		 	 foreach ($update->needRemove as $file) {
		?>
			<tr>
				<td><input type="checkbox" name="needRemoved[]" value="<?php echo $file; ?>" checked="checked" class="inputbox" /></td>
				<td><?php echo $file; ?></td>
				<td><center><?php echo $update->local[$file]; ?></center></td>
				<td>&nbsp;</td>
			</tr>
		<?php
		 	 }
		?>
		</table>
			<input type="hidden" name="option" value="com_acajoom" />
			<input type="hidden" name="act" value="update" />
		   	<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="task" value="doUpdate" />
			<input type="hidden" name="updatepath" value="<?php echo strtolower( $update->local['component'] . DS . $update->local['type'] ) . DS . $update->globalVersion['version'] . DS ; ?>" />
		</form>
		<br />
		<?php
		 }

}


	function _upgrade() {
		$config['news1'] = false;
		$config['news2'] = false;
		$config['news3'] = false;

		$exist = acajoom::checkExisting();
		if (!empty($exist['news1'])) $config['news1'] = true;
		if (!empty($exist['news2'])) $config['news2'] = true;
		if (!empty($exist['news3'])) $config['news3'] = true;

		$mess ='';
		if ($config['news1'] OR $config['news2'] OR $config['news3']) {
		$mess = acajoom::printM('blue' , _ACA_UPGRADE_MESS). '<br />';
		}

		if ($config['news1']) {
			$mess .=  '<a href="index2.php?option=com_acajoom&act=update&task=new1">';
			$mess .= acajoom::printM('ok' ,_ACA_UPGRADE_FROM.'Anjel');
			$mess .=  '</a><br />';
		}

		if ($config['news2']) {
			$mess .=  '<a href="index2.php?option=com_acajoom&act=update&task=new2">';
			$mess .= acajoom::printM('ok' ,_ACA_UPGRADE_FROM.'Letterman');
			$mess .=  '</a><br />';
		}

		if ($config['news3']) {
			$mess .=  '<a href="index2.php?option=com_acajoom&act=update&task=new3">';
			$mess .= acajoom::printM('ok' ,_ACA_UPGRADE_FROM.'YaNC');
			$mess .=  '</a><br />';
		}
		echo $mess;
	}


	function quickiconButton( $link, $image, $text, $external=false, $accessLevel='' , $frontEnd=false) {
		if ( acajoom::checkPermissions($accessLevel)) {
			if ( $frontEnd AND $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs')) {
				$link = sefRelToAbs($link);
			}
		?>
		<div style="float:left;">
			<div class="icon">
				<a href="<?php echo $link; ?>" <?php if ($external) echo 'target="_blank"'; ?>>
				<?php compa::showIcon($image,$text); ?>
					<span><?php echo $text; ?></span>
				</a>
			</div>
		</div>
		<?php
		}
	}

 }


<?php
 if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
class mosMenuBarCustom {
	function cancel( $alt='Cancel', $href='' ) {
		compa::showIcon('cancel.png','back','cancel');
		compa::showIcon('cancel_f2.png','back','cancel',0);
		if ( $href ) {
   			$link = $href;
   		} else {
 			$link = 'javascript:window.history.back();';
		}
		?>
		<td>
  			<a class="toolbar" href="<?php echo $link; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','<?php echo $image2; ?>',1);">
			<?php echo $image; ?>
			<?php echo $alt;?>
  		</a>
		</td>
		<?php
	}
}
 class menuAcajoom {
	 function REGISTERED() {
		mosMenuBar::startTable();
		mosMenuBar::custom('export', 'archive.png', 'archive_f2.png', _ACA_MENU_EXPORT , false);
		mosMenuBar::spacer();
		mosMenuBar::custom('import', 'upload.png', 'upload_f2.png', _ACA_MENU_IMPORT , false);
		mosMenuBar::spacer(50);
		mosMenuBar::addNew();
		mosMenuBar::spacer();
		mosMenuBar::editList();
		mosMenuBar::spacer();
		mosMenuBar::deleteList('' , 'delete');
		mosMenuBar::spacer(50);
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function SHOWSUBSCRIBER() {
		mosMenuBar::startTable();
		mosMenuBar::custom('updateOneSub', 'save.png', 'save_f2.png', _ACA_UPDATE , false);
		//mosMenuBar::spacer(50);
		//mosMenuBar::deleteList('' , 'deleteOneSub');
		mosMenuBar::spacer(50);
		mosMenuBar::custom('cancelSub', 'cancel.png', 'cancel_f2.png', _ACA_CANCEL , false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function NEWSUBSCRIBER() {
		mosMenuBar::startTable();
		mosMenuBar::save('doNew', _ACA_SAVE );
		mosMenuBar::spacer(50);
		mosMenuBar::custom('cancelSub', 'cancel.png', 'cancel_f2.png', _ACA_CANCEL , false);
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function IMPORT() {
		mosMenuBar::startTable();
		mosMenuBar::custom('doImport', 'upload.png', 'upload_f2.png', _ACA_MENU_IMPORT , false);
		mosMenuBar::spacer(50);
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function EXPORT() {
		mosMenuBar::startTable();
		mosMenuBar::custom('doExport', 'archive.png', 'archive_f2.png', _ACA_MENU_EXPORT , false);
		mosMenuBar::spacer(50);
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function SHOW_LIST() {
		mosMenuBar::startTable();
		if (class_exists('pro'))
		mosMenuBar::custom('forms','html.png','html_f2.png', _ACA_FORM_BUTTON ,false);
		mosMenuBar::spacer(50);
		mosMenuBar::custom('publish','publish.png','publish_f2.png', _ACA_PUBLISHED ,true);
		mosMenuBar::spacer();
		mosMenuBar::custom('unpublish','publish.png','publish_f2.png', _ACA_UNPUBLISHED ,true);
		mosMenuBar::spacer(50);
		mosMenuBar::addNew();
		mosMenuBar::spacer();
		mosMenuBar::editList();
		mosMenuBar::spacer();
		mosMenuBar::custom( 'copy', 'copy.png', 'copy_f2.png', _ACA_MENU_COPY , true);
		mosMenuBar::spacer();
		mosMenuBar::deleteList('' , 'delete');
		mosMenuBar::spacer(50);
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function EDIT_LIST($task) {

		mosMenuBar::startTable();
		mosMenuBar::save('update', _ACA_SAVE );
		mosMenuBar::spacer(50);
		mosMenuBar::cancel($task);
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function NEW_LIST($task) {

		mosMenuBar::startTable();
		mosMenuBar::save('doNew', _ACA_SAVE );
		mosMenuBar::spacer(50);
		mosMenuBar::cancel($task);
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function SHOW_MAILINGS() {
		mosMenuBar::startTable();
		//mosMenuBar::custom('publishMailing','publish.png','publish_f2.png', _ACA_PUBLISHED ,true);
		//mosMenuBar::spacer();
		mosMenuBar::custom('unpublishMailing','publish.png','publish_f2.png', _ACA_UNPUBLISHED ,true);
		mosMenuBar::spacer(50);
		mosMenuBar::custom('preview', 'preview.png', 'preview_f2.png', _ACA_MENU_PREVIEW , true );
		$listype = 0;
		if (isset($_GET['listype'])){ $listype = $_GET['listype']; }
		elseif (isset($_POST['droplist'])){ $maliste = explode('-',$_POST['droplist']); $listype = $maliste[0];}
		elseif (isset($_POST['listid'])){
			$maliste = lists::getLists($_POST['listid'],0,null,'listnameA',false,false,false,false);
			$listype = $maliste[0]->list_type;
		}
		if ($listype==1) {
			mosMenuBar::spacer(50);
			mosMenuBar::custom('sendNewsletter','forward.png','forward_f2.png', _ACA_MENU_SEND ,true);
		}
		mosMenuBar::spacer(50);
		mosMenuBar::addNew();
		mosMenuBar::spacer();
		mosMenuBar::editList();
		mosMenuBar::spacer();
		mosMenuBar::spacer();
		mosMenuBar::deleteList('' , 'deleteMailing');
		mosMenuBar::spacer(50);
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function NEWMAILING() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::custom('savePreview', 'preview.png', 'preview_f2.png', _ACA_MENU_PREVIEW , false);
		$listype = 0;
		if (isset($_GET['listype'])){ $listype = $_GET['listype']; }
		elseif (isset($_POST['droplist'])){ $maliste = explode('-',$_POST['droplist']); $listype = $maliste[0];}
		elseif (isset($_POST['listype'])){ $listype = $_POST['listype'];}
		elseif (isset($_GET['listid'])){
			$maliste = lists::getLists($_GET['listid'],0,null,'listnameA',false,false,false,false);
			$listype = $maliste[0]->list_type;
		}

		if ($listype==1) {
			mosMenuBar::spacer(50);
			mosMenuBar::custom('saveSend','forward.png','forward_f2.png', _ACA_MENU_SEND ,false);
		}
		mosMenuBar::spacer(50);
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::spacer(50);
		mosMenuBar::cancel('show');
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function PREVIEWMAILING($task) {
		mosMenuBar::startTable();
		mosMenuBar::custom('preview', 'forward.png', 'forward_f2.png', _ACA_MENU_SEND_TEST , false);
		mosMenuBar::spacer(50);
		mosMenuBar::cancel('show');
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function CONFIGURATION() {
		mosMenuBar::startTable();
		if (class_exists('aca_archive') ) {
			mosMenuBar :: custom('archiveAll', 'unarchive.png', 'unarchive_f2.png', _ACA_MENU_ARCHIVE_ALL, false);
			mosMenuBar::spacer(50);
		}
		if ( class_exists('autonews') ) {
			mosMenuBar::custom('reset','checked_out.png','checked_out.png', 'Reset S.N. Counter' ,false);
			mosMenuBar::spacer(50);
		}
		if (class_exists('auto')) $flag = auto::viewCron(); else $flag = false;
		if ($flag) {
			mosMenuBar::custom('sendQueue','forward.png','forward_f2.png', _ACA_MENU_SEND_QUEUE ,false);
			mosMenuBar::spacer(50);
		}
		if ( $GLOBALS[ACA.'type'] =='Plus' OR $GLOBALS[ACA.'type']=='PRO' ) {
			mosMenuBar::custom('syncUsers','addusers.png','addusers.png', _ACA_MENU_SYNC_USERS ,false);
			mosMenuBar::spacer(50);
		}
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer(50);
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function CANCEL_ONLY($task) {
		mosMenuBar::startTable();
		mosMenuBar::cancel($task);
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function STATISTICS() {
		mosMenuBar::startTable();
		mosMenuBar::custom('view', 'move.png', 'move_f2.png', _ACA_MENU_VIEW_STATS, true);
		mosMenuBar::spacer(50);
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function UPDATE() {
		mosMenuBar::startTable();
		/*mosMenuBar::custom('complete', 'upload.png', 'upload_f2.png', _ACA_CHECK , false);
		mosMenuBar::spacer(50);
		mosMenuBar::cancel();
			*/
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function DOUPDATE() {

		mosMenuBar::startTable();
	 /*
		mosMenuBar::custom('doUpdate', 'upload.png', 'upload_f2.png', _ACA_UPDATE , false);
		mosMenuBar::spacer(50);
		mosMenuBar::cancel();
		*/
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
	 function ABOUT() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		mosMenuBar::endTable();
	 }
 }

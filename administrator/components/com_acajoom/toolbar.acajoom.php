<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );
global $_VERSION;
$joomAca15 = ( $_VERSION->RELEASE !='1.0' &&  class_exists('JFactory') ) ? true : false;
if ( $joomAca15 ) {
	$doc =& JFactory::getDocument();
	$css  = ".icon-32-tool 	{ background-image: url( 'templates/khepri/images/menu/icon-16-cpanel.png' ); }";
	$css  .= ".icon-32-upload 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-export.png' ); }";
	$css  .= ".icon-32-forward 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-send.png' ); }";
	$css  .= ".icon-32-addusers 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-adduser.png' ); }";
	$doc->addStyleDeclaration($css);
}
 $action = mosGetParam($_REQUEST, 'act', '');
 $task = mosGetParam($_REQUEST, 'task', '');
 $listId = mosGetParam($_REQUEST, 'listid', 0);
 $listType = mosGetParam($_REQUEST, 'listype', 0);
 switch ($action) {
	 case ('subscribers') :

	 	switch ($task) {
			case ('import') :
				menuAcajoom::IMPORT();
				break;
			case ('export') :
				menuAcajoom::EXPORT();
				break;
			case ('new') :
				menuAcajoom::NEWSUBSCRIBER();
				break;
			case ('show') :
				menuAcajoom::SHOWSUBSCRIBER();
				break;
			case ('doExport') :
			case ('cpanel') :

				break;
			default :
				menuAcajoom::REGISTERED();
				break;
	 	}
	 	break;
	 case ('list') :

	 	switch ($task) {
			case ('new') :
				menuAcajoom::NEW_LIST('');
				break;
			case ('edit') :
				menuAcajoom::EDIT_LIST('');
				break;
			case ('cpanel') :

				break;
			default:
				menuAcajoom::SHOW_LIST();
				break;
	 	}
	 	break;
	 case ('mailing') :

	 	switch ($task) {
			case ('edit') :
				menuAcajoom::NEWMAILING();
				break;
			case ('preview') :
				menuAcajoom::PREVIEWMAILING('show');
				break;
			case ('savePreview') :
				menuAcajoom::PREVIEWMAILING('show');
				break;
			case ('view') :
				menuAcajoom::CANCEL_ONLY('show');
				break;
			case ('publish') :
				menuAcajoom::CANCEL_ONLY('');
				break;
			case ('cpanel') :

				break;
			case ('show') :
			default :
				menuAcajoom::SHOW_MAILINGS();
				break;
	 	}
	 	break;
	 case ('configuration') :

	 	switch ($task) {
			case ('save') :
			case ('cpanel') :

				break;
			default :
				menuAcajoom::CONFIGURATION();
				break;
	 	}
	 	break;
	 case ('statistics') :

	 	switch ($task) {
			case ('edit') :
				menuAcajoom::CANCEL_ONLY('cancel');
				break;
			case ('cpanel') :

				break;
			default :

				menuAcajoom::STATISTICS();
				break;
	 	}
	 	break;
	 case ('update') :

	 	switch ($task) {
			case ('doUpdate'):
			case ('version'):
			case ('new1'):
			case ('new2'):
			case ('new3'):
				menuAcajoom::CANCEL_ONLY('show');
				break;
			case ('cpanel') :

				break;
			case ('complete') :
				menuAcajoom::DOUPDATE();
				break;
			case ('show') :
			default :
				menuAcajoom::UPDATE();
				break;
	 	}
	 	break;
	 case ('about') :

	 	switch ($task) {
			case ('cpanel') :

				break;
			default :
				menuAcajoom::ABOUT();
				break;
	 	}
	 	break;
	 default :
	 	break;
 }
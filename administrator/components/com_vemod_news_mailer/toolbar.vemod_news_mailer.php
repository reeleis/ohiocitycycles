<?php
//vemod_news_mailer Component//
/**
* Content code
* @package vemod_news_mailer
* @Copyright (C) 2007 by Thomas Allin
* @ All rights reserved
* @ vemod_news_mailer is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version 1.0
**/


// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted Access.' );

$title='Vemod News Mailer Manager';
if ($task)
{
    $title.=' <font size="-1">('.$task.')</font>';
}

JToolBarHelper::title($title);

switch ($task)
{
    case 'showmaintenance':
    case 'showsubscribers':
    case 'showbackup':
	case "emailscan":
	case "cleanemail":
	case "scanexpired":
	case "cleanexpired":
	case "scancategories":
	case "cleancategories":
	case "oneclick":
		//JToolBarHelper::startTable();
		//JToolBarHelper::title($task);
		JToolBarHelper::custom( 'controlpanel', 'back', 'back', 'Back', false );
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
		break;
    case 'editsubscribers':
    case 'editmailformat':
    case 'editsmsdetails':        
		//JToolBarHelper::startTable();
		//JToolBarHelper::title($task);		
		JToolBarHelper::apply();
		JToolBarHelper::cancel();		
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
		break;
    case 'configuration':
		//JToolBarHelper::startTable();
		//JToolBarHelper::title($task);		
		JToolBarHelper::save();
		JToolBarHelper::custom( 'controlpanel', 'back', 'back', 'Back', false );		
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
		break;
    default:        
		//JToolBarHelper::startTable();
		//JToolBarHelper::title($task);		
		JToolBarHelper::cancel();		
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
		break;				
}	
?>

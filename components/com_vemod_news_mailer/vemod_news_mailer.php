<?php
//vemod_news_mailer Component//
/**
* Content code
* @package vemod_news_mailer
* @Copyright (C) 2007 Thomas Allin
* @ All rights reserved
* @ vemod_news_mailer is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version 1.0
**/

defined( '_JEXEC' ) or die( 'Restricted Access.' );

global $Itemid, $mainframe;
$my=&JFactory::getUser();
$database = &JFactory::getDBO();
jimport('joomla.mail.helper');

if(!isset($fromtemplate))
{
    $fromtemplate = 0;
}

if ($fromtemplate)
{
	require_once(JPATH_SITE."/components/com_vemod_news_mailer/vemod_news_mailer.html.php");
}
else
{
	require_once( $mainframe->getPath( 'front_html' ) );
}

require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");

if (!isset($compiledusereadmore))
{
    if ($compiledreadmoretruncate==='')
    {
        $compiledusereadmore=0;
        $compiledreadmoretruncate=0;
    }
    else
    {
        $compiledusereadmore=1;    
    }
}

$subscribe = JRequest::getVar( 'subscribe');
$checknews = JRequest::getVar( 'checknews');
$preview = JRequest::getVar( 'preview');
$viewlog = JRequest::getVar( 'viewlog');
$updatelog = JRequest::getVar( 'updatelog');
//$killlog = JRequest::getVar( 'killlog');
$killlogitems = JRequest::getVar(  'killlogitems');
$viewsubs = JRequest::getVar( 'viewsubs');
$killsubs = JRequest::getVar( 'killsubs');
$emailverify = JRequest::getVar( 'emailverify');
$unsubscribeall = JRequest::getVar( 'unsubscribeall');
$emailverifyuser = JRequest::getVar( 'userid');
$emailverifycats = JRequest::getVar( 'catid');
$resendfailed = JRequest::getVar( 'resendfailed');
$changeusermailformat = JRequest::getVar( 'changeusermailformat');
$smssubscribe = JRequest::getVar( 'smssubscribe_x');
$emailverifycats=explode(",",$emailverifycats);

$maileraction=0;
if ($preview) $maileraction=1;
if ($checknews)	$maileraction=1;
if ($resendfailed) $maileraction=2;
if ($killlogitems) $maileraction=5;
if ($viewlog) $maileraction=2;
if ($updatelog) $maileraction=2;
//if ($killlog) $maileraction=5;
if ($viewsubs) $maileraction=4;
if ($killsubs) $maileraction=6;
if ($fromtemplate) $maileraction=3;
if ($changeusermailformat != '') $maileraction=7;
if ($smssubscribe != '') $maileraction=7;

$database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_vemod_news_mailer' AND published=1");
$Itemid = $database->loadResult();
$base_url = "index.php?option=com_vemod_news_mailer&amp;Itemid=$Itemid";  // Base URL string

$sidebarmodules=array();
$sidebarmodules[0]=vmn_getModuleArray(@$sidebarmodule1,@$sidebarmoduleid1);
$sidebarmodules[1]=vmn_getModuleArray(@$sidebarmodule2,@$sidebarmoduleid2);
$sidebarmodules[2]=vmn_getModuleArray(@$sidebarmodule3,@$sidebarmoduleid3);
$sidebarmodules[3]=vmn_getModuleArray(@$sidebarmodule4,@$sidebarmoduleid4);
$sidebarmodules[4]=vmn_getModuleArray(@$sidebarmodule5,@$sidebarmoduleid5);
$sidebarmodules[5]=vmn_getModuleArray(@$sidebarmodule6,@$sidebarmoduleid6);

$readmore=array();
$readmore['use']=$usereadmore;
$readmore['text']=$readmoretext;
$readmore['truncate']=$readmoretruncate;

$compiledreadmore=array();
$compiledreadmore['use']=$compiledusereadmore;
$compiledreadmore['text']=$compiledreadmoretext;
$compiledreadmore['truncate']=$compiledreadmoretruncate;

$emailsettings=array();
$emailsettings['mailfrom']=$mainframe->getCfg('mailfrom');
$emailsettings['fromname']=$mainframe->getCfg('fromname');
$emailsettings['smsmailfrom']=$mainframe->getCfg('mailfrom');
$emailsettings['smsfromname']=$mainframe->getCfg('fromname');
$emailsettings['receiver']=$mainframe->getCfg('mailfrom');
$emailsettings['smsoperator']='';

if (JMailHelper::isEmailAddress(@$mailfromaddress)) $emailsettings['mailfrom']=$mailfromaddress;
if (JMailHelper::isEmailAddress(@$receiveremail)) $emailsettings['receiver']=$receiveremail;
if (JMailHelper::isEmailAddress(@$smsfromaddress)) $emailsettings['smsmailfrom']=$smsfromaddress;
if (strlen(@$smsfromname)) $emailsettings['smsfromname']=$smsfromname;
if (strlen(@$smsoperator)) $emailsettings['smsoperator']=$smsoperator;

if (strlen(@$smsoperator))
{
    if (!isset($vmnsmscats))
    {
        $checkedsms=explode(",",@$vmncats);
    }
    else
    {
       $checkedsms=explode(",",@$vmnsmscats);
    }
    
    if (!isset($vmnsmssecs))
    {
        $scheckedsms=explode(",",@$vmnsecs);
    }
    else
    {
       $scheckedsms=explode(",",@$vmnsmssecs);
    }
    for ($i=0;$i<count($scheckedsms);$i++)
    {
        $scheckedsms[$i]=-$scheckedsms[$i];
    }
}
else
{
    $checkedsms=array();
    $scheckedsms=array();
}

$textusers=array();
if ($mailformat==2)
{
	$database->setQuery("SELECT id FROM #__vemod_news_mailer_users WHERE mailformat=1");
	$textusers=$database->loadResultArray();
}

$registertext='';
$usersConfig = &JComponentHelper::getParams( 'com_users' );
if (($my->id==0) && (strlen(@$registerurl)) && ($usersConfig->get( 'allowUserRegistration' )))
{
    $registertext='<span>&nbsp;&nbsp; '.JTEXT::_('NO_ACCOUNT').' <a href="'.@$registerurl.'" title="'.JTEXT::_('CREATE_ACCOUNT').'">'.JTEXT::_('CREATE_ACCOUNT').'</a></span>';
}

if ($interval==0)
{
	$interval=1;
}
$sinterval=3600 * $interval;
$now = gmdate( 'Y-m-d H:i:s' );
              
switch ($maileraction)
{
	case 1:	
    	//Preview / send.
		if ($fromtemplate) break;
		if ((!vmn_userAccess($previewusers)) && (!vmn_userAccess($mailusers)))
        {
            vmn_doPageTop(JTEXT::_('VMN_LOGIN'));
            echo $registertext;
            break;
        }
        vmn_lockTable();
        $database->setQuery( "SELECT scantime FROM #__vemod_news_mailer_scantime LIMIT 1" );
        $lastscan=$database->loadResult();
        if ($lastscan=='') $lastscan=$database->getNullDate();        
		vmn_setNow($lastscan,$now,$checknews); 
        vmn_unlockTable();  
        if (@$autoaddusers)
        {
            if ($checknews)
            {
                vmn_autoAddUsers($vmncats,$vmnsecs,$now,$lastscan);
            }
        }                              
        require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/js.vemod_news_mailer.php");
    	$newscount=0;
		$ncday=unserialize(stripslashes(@$newscompileday));
		$sncday=unserialize(stripslashes(@$snewscompileday));
		$nctime=unserialize(stripslashes(@$newscompiletime));
		$snctime=unserialize(stripslashes(@$snewscompiletime));
		$compilationtitle=unserialize(stripslashes(@$compilationtitle));
		$scompilationtitle=unserialize(stripslashes(@$scompilationtitle));		
		$compilationintrotext=unserialize(stripslashes(@$compilationintrotext));		
		$scompilationintrotext=unserialize(stripslashes(@$scompilationintrotext));		
		$unewitems=vmn_getNewItems($lastscan,$allnewscount,$vmncats,$vmnsecs,$now);
		if (!$checknews)
		{
			vmn_doPageTop(count($unewitems) . " " . JTEXT::_('VMN_OUT_OF') . " " . $allnewscount . " " . JTEXT::_('VMN_ITEMS_ARE_NEW'));
		}
		//else
		//{
			//vmn_doPageTop("0 " . JTEXT::_('VMN_OUT_OF') . " " . $allnewscount . " " . JTEXT::_('VMN_ITEMS_ARE_NEW'));		
		//}
    	echo '<span>&nbsp;&nbsp; '.JTEXT::_('VMN_LAST_SCAN') . ' ' . JHTML::date($lastscan, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($lastscan, '%H:%M:%S') . '. </span>';		
		//vmn_doTableHeader(array(JTEXT::_('VMN_SUBJECT'),JTEXT::_('VMN_MESSAGE'),JTEXT::_('VMN_USERS')));
		vmn_doTable();
			$evencount='0';
			if (count($ncday))
			{
				$cats=vmn_getCatsExclSecs($vmncats,$vmnsecs);
				foreach($cats as $cat)
				{
					$catid=$cat->id;
					$ncd=$ncday[$catid];
					if ($ncd)
					{
						//echo vmn_getCatTitle($catid) . " ";										
						$subscribers=vmn_getSubscribers($catid,unserialize(stripslashes($customrecipients)));
						if (count($subscribers))
						{	
							$weekday=$ncd-2;
							if ($weekday==-1) $weekday='';
							$timeofday=$nctime[$catid];
							if (vmn_getNewsInterval($now,$lastscan,$weekday,$timeofday,$startnews,$endnews))
							{
								$newitems=vmn_scanNewsCompilation($catid,$startnews,$endnews);
								if (count($newitems))
								{
									$HTMLbodytext=vmn_compileHTMLNews($newitems,$compiledreadmore,$compilednewsmailHTML);
									$textbodytext=vmn_compileTextNews($newitems,$compiledreadmore,$compilednewsmailText);
									$title=vmn_getCatTitle($catid);																														
									$newsitem= (object)array("title" => $compilationtitle[$catid],"introtext" => $compilationintrotext[$catid],"fulltext" => $HTMLbodytext . "[#*%*#]" . $textbodytext,"catid" => "-1");						
									vmn_sendNews($newsitem,$checknews,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,
									'',$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);                  
								    if (in_array($catid,$checkedsms))
								    {
    								    $smssubscribers=vmn_getSMSSubscribers($catid);
    								    vmn_sendSMS($newsitem,$checknews,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
    								}
									if (!$checknews)
									{
									    if (strlen(@$sentsmsusers))
										{
											vmn_doPreviewtableRow($evencount,$subjectsms,"<sms></sms><pre>".$smsmessage."</pre>",JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$sentsmsusers);
										}									
									    if (strlen($senttextusers))
										{
											vmn_doPreviewtableRow($evencount,$subject,"<pre>".$textmessage."</pre>",JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$senttextusers);
										}
									    if (strlen($sentHTMLusers))
										{
											vmn_doPreviewtableRow($evencount,$subject,$HTMLmessage,JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$sentHTMLusers);
										}
									}
									$newscount++;
								}
							}
						}
					}
				}
			}
			if (count($sncday))
			{
				$secs=vmn_getSecs($vmnsecs);
				foreach($secs as $sec)
				{
					$secid=-($sec->id);
					$sncd=$sncday[$secid];
					if ($sncd)
					{
						//echo vmn_getCatTitle($secid) . " ";
						$subscribers=vmn_getSubscribers($secid,unserialize(stripslashes($scustomrecipients)));
						if (count($subscribers))
						{
							$weekday=$sncd-2;
							if ($weekday==-1) $weekday='';
							$timeofday=$snctime[$secid];
							if (vmn_getNewsInterval($now,$lastscan,$weekday,$timeofday,$startnews,$endnews))
							{
								$newitems=vmn_scanNewsCompilation($secid,$startnews,$endnews);
								if (count($newitems))
								{
									$HTMLbodytext=vmn_compileHTMLNews($newitems,$compiledreadmore,$compilednewsmailHTML);
									$textbodytext=vmn_compileTextNews($newitems,$compiledreadmore,$compilednewsmailText);
									$title=vmn_getCatTitle($secid);
									$newsitem= (object)array("title" => $scompilationtitle[$secid],"introtext" => $scompilationintrotext[$secid],"fulltext" => $HTMLbodytext . "[#*%*#]" . $textbodytext,"catid" => "-1");
									vmn_sendNews($newsitem,$checknews,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,
									'',$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);                  
								    if (in_array($secid,$scheckedsms))
								    {									
    								    $smssubscribers=vmn_getSMSSubscribers($secid);
    								    vmn_sendSMS($newsitem,$checknews,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
    								}
									if (!$checknews)
									{
									    if (strlen(@$sentsmsusers))
										{
											vmn_doPreviewtableRow($evencount,$subjectsms,"<sms></sms><pre>".$smsmessage."</pre>",JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$sentsmsusers);
										}
								    	if (strlen($senttextusers))
										{
											vmn_doPreviewtableRow($evencount,$subject,"<pre>".$textmessage."</pre>",JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$senttextusers);
										}
									    if (strlen($sentHTMLusers))
										{
											vmn_doPreviewtableRow($evencount,$subject,$HTMLmessage,JHTML::date($endnews, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($endnews, '%H:%M:%S'),$sentHTMLusers);
										}
									}
									$newscount++;
								}
							}
						}
					}
				}
			}
			for ($i=0;$i < count($unewitems);$i++)
			{
				if (!$sncday[-($unewitems[$i]->sectionid)])
				{
					$subscribers=vmn_getSubscribers(-($unewitems[$i]->sectionid),unserialize(stripslashes($scustomrecipients)));
					if (count($subscribers))
					{
						$title=vmn_getCatTitle(-($unewitems[$i]->sectionid));
						vmn_sendNews($unewitems[$i],$checknews,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,$readmore,
						$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);
						if (in_array(-$unewitems[$i]->sectionid,$scheckedsms))
						{						
						     $smssubscribers=vmn_getSMSSubscribers(-($unewitems[$i]->sectionid));
						     vmn_sendSMS($unewitems[$i],$checknews,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
						}
						if (!$checknews)
						{
						    if (strlen(@$sentsmsusers))
							{
								vmn_doPreviewtableRow($evencount,$subjectsms,"<sms></sms><pre>".$smsmessage."</pre>",JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$sentsmsusers);
							}						
						    if (strlen($senttextusers))
							{
								vmn_doPreviewtableRow($evencount,$subject,"<pre>".$textmessage."</pre>",JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$senttextusers);
							}
						    if (strlen($sentHTMLusers))
							{
								vmn_doPreviewtableRow($evencount,$subject,$HTMLmessage,JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$sentHTMLusers);
							}
						}
						$newscount++;
					}
				}
				if (!$ncday[$unewitems[$i]->catid])
				{
					$subscribers=vmn_getSubscribers($unewitems[$i]->catid,unserialize(stripslashes($customrecipients)));
					if (count($subscribers))
					{
						$title=vmn_getCatTitle($unewitems[$i]->catid);
						vmn_sendNews($unewitems[$i],$checknews,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,$readmore,
						$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);
						if (in_array($unewitems[$i]->catid,$checkedsms))
						{						
						     $smssubscribers=vmn_getSMSSubscribers($unewitems[$i]->catid);
						     vmn_sendSMS($unewitems[$i],$checknews,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
						}
						if (!$checknews)
						{
						    if (strlen(@$sentsmsusers))
							{
								vmn_doPreviewtableRow($evencount,$subjectsms,"<sms></sms><pre>".$smsmessage."</pre>",JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$sentsmsusers);
							}						
						    if (strlen($senttextusers))
							{
								vmn_doPreviewtableRow($evencount,$subject,"<pre>".$textmessage."</pre>",JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$senttextusers);
							}
						    if (strlen($sentHTMLusers))
							{
								vmn_doPreviewtableRow($evencount,$subject,$HTMLmessage,JHTML::date($unewitems[$i]->publish_up, JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($unewitems[$i]->publish_up, '%H:%M:%S'),$sentHTMLusers);
							}
						}
						$newscount++;
					}
				}
			}
			if (isset($logsize)) vmn_trimLog($logsize);
		vmn_doEndTable();
		if ($checknews)
		{
		    vmn_doPageTop($newscount . " " . JTEXT::_('VMN_ITEMS_WERE_SENT'));
		}
		echo "<br>";
		vmn_doForm(vmn_sefRelToAbs($base_url));
		vmn_doTable();
			vmn_doTableRow();
				vmn_doButton(JTEXT::_('VMN_BACK'),0,vmn_sefRelToAbs($base_url),false);
				if ($preview)
				{
					vmn_doButton(JTEXT::_('VMN_SEND'),$mailusers,'',false,'checknews',JTEXT::_('VMN_SEND'));
				}
			vmn_doEndTableRow();
		vmn_doEndTable();
		vmn_doEndForm();
		if ($checknews)
		{
		  vmn_sendThrottledItems($now,$emailsettings,@$throttleinterval,@$throttlesize);
		}
	    break;
	case 3:
    	//from template
        vmn_lockTable();
        $database->setQuery( "SELECT scantime FROM #__vemod_news_mailer_scantime LIMIT 1" );
        $lastscan=$database->loadResult();
        if ($lastscan=='') $lastscan=$database->getNullDate();        
		$lastinterval=(int)(strtotime($lastscan) / $sinterval);
		$thisinterval=(int)(strtotime($now) / $sinterval);
		if ($lastinterval < $thisinterval)
		{
			vmn_setNow($lastscan,$now,TRUE);
            vmn_unlockTable();
            if (@$autoaddusers)
            {
                vmn_autoAddUsers($vmncats,$vmnsecs,$now,$lastscan);
            }                				
			if ($autoresend)
			{
				vmn_sendFailedItems($now,$emailsettings,@$throttleinterval,@$throttlesize);
			} 			
        	$ncday=unserialize(stripslashes($newscompileday));
        	$sncday=unserialize(stripslashes($snewscompileday));
        	$nctime=unserialize(stripslashes($newscompiletime));
        	$snctime=unserialize(stripslashes($snewscompiletime));
        	$compilationtitle=unserialize(stripslashes($compilationtitle));
        	$scompilationtitle=unserialize(stripslashes($scompilationtitle));
        	$compilationintrotext=unserialize(stripslashes($compilationintrotext));
        	$scompilationintrotext=unserialize(stripslashes($scompilationintrotext));			
			if (count($ncday))
			{
				$cats=vmn_getCatsExclSecs($vmncats,$vmnsecs);
				foreach($cats as $cat)
				{
					$catid=$cat->id;
					$ncd=$ncday[$catid];
					if ($ncd)
					{
						$subscribers=vmn_getSubscribers($catid,unserialize(stripslashes($customrecipients)));
						if (count($subscribers))
						{
							$weekday=$ncd-2;
							if ($weekday==-1) $weekday='';
							$timeofday=$nctime[$catid];
							if (vmn_getNewsInterval($now,$lastscan,$weekday,$timeofday,$startnews,$endnews))
							{
								$newitems=vmn_scanNewsCompilation($catid,$startnews,$endnews);
								if (count($newitems))
								{
									$HTMLbodytext=vmn_compileHTMLNews($newitems,$compiledreadmore,$compilednewsmailHTML);
									$textbodytext=vmn_compileTextNews($newitems,$compiledreadmore,$compilednewsmailText);
									$title=vmn_getCatTitle($catid);
									$newsitem= (object)array("title" => $compilationtitle[$catid],"introtext" => $compilationintrotext[$catid],"fulltext" => $HTMLbodytext . "[#*%*#]" . $textbodytext,"catid" => "-1");
									vmn_sendNews($newsitem,TRUE,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,
									'',$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);                  
								    if (in_array($catid,$checkedsms))
								    {								
    								    $smssubscribers=vmn_getSMSSubscribers($catid);
    								    vmn_sendSMS($newsitem,TRUE,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
    								}
								}
							}
						}
					}
				}
			}
			if (count($sncday))
			{
				$secs=vmn_getSecs($vmnsecs);
				foreach($secs as $sec)
				{
					$secid=-($sec->id);
					$sncd=$sncday[$secid];
					if ($sncd)
					{
						$subscribers=vmn_getSubscribers($secid,unserialize(stripslashes($scustomrecipients)));
						if (count($subscribers))
						{
							$weekday=$sncd-2;
							if ($weekday==-1) $weekday='';
							$timeofday=$snctime[$secid];
							if (vmn_getNewsInterval($now,$lastscan,$weekday,$timeofday,$startnews,$endnews))
							{
								$newitems=vmn_scanNewsCompilation($secid,$startnews,$endnews);
								if (count($newitems))
								{
									$HTMLbodytext=vmn_compileHTMLNews($newitems,$compiledreadmore,$compilednewsmailHTML);
									$textbodytext=vmn_compileTextNews($newitems,$compiledreadmore,$compilednewsmailText);
									$title=vmn_getCatTitle($secid);
									$newsitem= (object)array("title" => $scompilationtitle[$secid],"introtext" => $scompilationintrotext[$secid],"fulltext" => $HTMLbodytext . "[#*%*#]" . $textbodytext,"catid" => "-1");
									vmn_sendNews($newsitem,TRUE,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,
									'',$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);                  
								    if (in_array($secid,$scheckedsms))
								    {																		
    								    $smssubscribers=vmn_getSMSSubscribers($secid);
    								    vmn_sendSMS($newsitem,TRUE,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
    								}
								}
							}
						}
					}
				}
			}
			$newitems=vmn_getNewItems($lastscan,$newscount,$vmncats,$vmnsecs,$now);
			for ($i=0;$i < count($newitems);$i++)
			{
				if (!$sncday[-($newitems[$i]->sectionid)])
				{
					$subscribers=vmn_getSubscribers(-($newitems[$i]->sectionid),unserialize(stripslashes($scustomrecipients)));
					if (count($subscribers))
					{
						$title=vmn_getCatTitle(-($newitems[$i]->sectionid));
						vmn_sendNews($newitems[$i],TRUE,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,$readmore,
						$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,@$newsmailsubject,@$stripmambots);
						if (in_array(-$newitems[$i]->sectionid,$scheckedsms))
						{												
						     $smssubscribers=vmn_getSMSSubscribers(-($newitems[$i]->sectionid));
						     vmn_sendSMS($newitems[$i],TRUE,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
						}					
					}
				}
				if (!$ncday[$newitems[$i]->catid])
				{
					$subscribers=vmn_getSubscribers($newitems[$i]->catid,unserialize(stripslashes($customrecipients)));
					if (count($subscribers))
					{
						$title=vmn_getCatTitle($newitems[$i]->catid);				
						vmn_sendNews($newitems[$i],TRUE,$HTMLmessage,$textmessage,$subject,$sentHTMLusers,$senttextusers,$subscribers,$now,$readmore,
						$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$title,@$throttleinterval,@$throttlesize,$newsmailsubject,@$stripmambots);
						if (in_array($newitems[$i]->catid,$checkedsms))
						{												
						     $smssubscribers=vmn_getSMSSubscribers($newitems[$i]->catid);
						     vmn_sendSMS($newitems[$i],TRUE,$smsmessage,$subjectsms,$sentsmsusers,$smssubscribers,$now,@$smsText,$emailsettings,$title,@$throttleinterval,@$throttlesize,@$smssubject);
						}					
					}
				}
			}
			if (isset($logsize)) vmn_trimLog($logsize);
		}
		else
		{
            vmn_unlockTable();    				        
        }
		vmn_sendThrottledItems($now,$emailsettings,@$throttleinterval,@$throttlesize);
	    break;
	case 5:
		//Kill log
		if ($fromtemplate) break;
		if ((!vmn_userAccess($previewusers)) && (!vmn_userAccess($mailusers)))
        {
            vmn_doPageTop(JTEXT::_('VMN_LOGIN'));
            echo $registertext;
            break;
        }
		
		if ($killlogitems)
		{
			if (count(@$_POST['cid']))
			{
				foreach ($_POST['cid'] as $logitem)
				{
					$database->setQuery("DELETE FROM #__vemod_news_mailer_log WHERE id=$logitem");
					$database->query();
				}
			}
		}
		/*
		else
		{
			$database->setQuery( "TRUNCATE TABLE #__vemod_news_mailer_log" );
			$database->query();
		}
		*/
	case 2:
	    //View Log
		if ($fromtemplate) break;
		if ((!vmn_userAccess($previewusers)) && (!vmn_userAccess($mailusers)))
        {
            vmn_doPageTop(JTEXT::_('VMN_LOGIN'));
            echo $registertext;
            break;
        }
        if ($updatelog)
        {
            vmn_sendThrottledItems($now,$emailsettings,@$throttleinterval,@$throttlesize);
        }        
		require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/js.vemod_news_mailer.php");

		if ($resendfailed)
		{
		    $cats='';
			if (count(@$_POST['cid']))
			{
			    $catsarray=array();
				foreach ($_POST['cid'] as $logitem)
				{
					$database->setQuery("SELECT id FROM #__vemod_news_mailer_log WHERE id=$logitem");
					$logid = $database->loadResult();
					if ($logid)
					{
                        $catsarray[]=$logid;    
                    }
				}
				$cats=implode(',',$catsarray);
			}
		
            vmn_sendFailedItems($now,$emailsettings,@$throttleinterval,@$throttlesize,$cats);
			if (isset($logsize)) vmn_trimLog($logsize);
		}
		vmn_doForm(vmn_sefRelToAbs($base_url));
		$database->setQuery( "SELECT * FROM #__vemod_news_mailer_log ORDER BY sent" );
		$logs = $database->loadObjectList();
		vmn_doPageTop(count($logs) . " " . JTEXT::_('VMN_OUT_OF') . " " . $logsize);
		//vmn_doTableHeader(array(JTEXT::_('VMN_SUBJECT'),JTEXT::_('VMN_MESSAGE'),JTEXT::_('VMN_USERS')));
		vmn_doTable();
			$evencount='0';
			for ($i=0;$i < count($logs);$i++)
			{
				vmn_doLogTableRow($evencount,$logs[$i],JTEXT::_('VMN_SUCCESS'),JTEXT::_('VMN_FAILURE'),@$throttlesize);
			}
		vmn_doEndTable();
		echo "<br>";
		vmn_doTable();
    		vmn_doTableRow();
				vmn_doButton(JTEXT::_('VMN_BACK'),0,vmn_sefRelToAbs($base_url),false);
				vmn_doButton(JTEXT::_('VMN_RESEND'),$mailusers,'',false,'resendfailed',JTEXT::_('VMN_RESEND'));
				vmn_doButton(JTEXT::_('VMN_KILL_LOGITEMS'),$mailusers,'',false,'killlogitems',JTEXT::_('VMN_KILL_LOGITEMS'));
				//vmn_doButton(JTEXT::_('VMN_KILL_LOG'),$previewusers,'',false,'killlog',JTEXT::_('VMN_KILL_LOG'));
				vmn_doButton(JTEXT::_('UPDATE'),$mailusers,'',false,'updatelog');				
			vmn_doEndTableRow();
		vmn_doEndTable();
		vmn_doEndForm();
	    break;
	/*    
	case 6:
		//kill users
		if ($fromtemplate) break;
		if ((!vmn_userAccess($previewusers)) && (!vmn_userAccess($mailusers))) break;
		if (count($_POST['cid']))
		{
			foreach ($_POST['cid'] as $usercat)
			{
			    $usca=explode(",",$usercat);
				$usertokill=$usca[0];
				$cattokill=$usca[1];
				$database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid=$usertokill AND catid=$cattokill");
				$database->query();
			}
		}
	case 4:
		//View users
		if ($fromtemplate) break;
		if ((!vmn_userAccess($previewusers)) && (!vmn_userAccess($mailusers))) break;
		vmn_doForm(vmn_sefRelToAbs($base_url . "&amp;killsubs=1"));
		vmn_doPageTop("");
		vmn_doTableHeader(array(JTEXT::_('VMN_CATEGORY'),JTEXT::_('VMN_USERS')));
			$evencount='0';
			$newscats=vmn_getSecs($vmnsecs);
			for ($i=0;$i < count($newscats);$i++)
			{
				$subscribers=vmn_getSubscribers(-($newscats[$i]->id),unserialize(stripslashes($scustomrecipients)));
				vmn_doManageSubsRow($evencount,$subscribers,$newscats[$i]->title,-($newscats[$i]->id),$mailformat,$textusers);
			}
			$newscats=vmn_getCatsExclSecs($vmncats,$vmnsecs);
			for ($i=0;$i < count($newscats);$i++)
			{
				$subscribers=vmn_getSubscribers($newscats[$i]->id,unserialize(stripslashes($customrecipients)));
				vmn_doManageSubsRow($evencount,$subscribers,$newscats[$i]->title,$newscats[$i]->id,$mailformat,$textusers);
			}
		vmn_doEndTable();
		echo "<br>";
		vmn_doTable();
			vmn_doTableRow();
				vmn_doButton(JTEXT::_('VMN_BACK'),0,vmn_sefRelToAbs($base_url),false);
				vmn_doButton(JTEXT::_('VMN_KILL_SUBS'),$previewusers,'',false);
			vmn_doEndTableRow();
		vmn_doEndTable();
		vmn_doEndForm();
		break;
	*/
	case 7:
		//change mailformat
		if ($fromtemplate) break;
	   	if ($my->id!=0)
		{
		    if ($changeusermailformat != '')		
    		{
    			//User changed mailformat    		
                $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_users WHERE id=$my->id");
                $exist=$database->loadResult();
                if ($exist)
                {
                    $database->setQuery("UPDATE #__vemod_news_mailer_users SET mailformat=$changeusermailformat WHERE id=$my->id");
                    $database->query();                
                }
                else
                {
                    $database->setQuery("INSERT INTO #__vemod_news_mailer_users (id,mailformat) VALUES ($my->id,$changeusermailformat)");
        			$database->query();                           
                }    		
    		}
		    if ($smssubscribe != '')		
    		{
    		    $smsdetails=$_POST['smsdetails'];
    			//User changed mailformat    		
                $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_users WHERE id=$my->id");
                $exist=$database->loadResult();
                if ($exist)
                {
                    $database->setQuery("UPDATE #__vemod_news_mailer_users SET metatags='$smsdetails' WHERE id=$my->id");
                    $database->query();                
                }
                else
                {
                    $database->setQuery("INSERT INTO #__vemod_news_mailer_users (id,metatags) VALUES ($my->id,'$smsdetails')");
        			$database->query();                           
                }    		
    		}    		
    	}	
	default:
		if ($fromtemplate) break;
		//User clicked the subscibe button
		if ($my->id==0)
		{
			vmn_doPageTop(JTEXT::_('VMN_LOGIN'));
			echo $registertext;
			//break;
		}
		if ($subscribe && ($my->id != 0))
		{
	    	if ($useverificationemail)
			{
				//send verification email
				$subscribeto='';
				$maillink=$base_url . "&amp;emailverify=1&amp;userid=" . $my->id . "&amp;catid=";
				if (count(@$_POST['cid']))
				{
				    $subscribeto .= $vmchosencat . "<br><br>";
					foreach ($_POST['cid'] as $cat)
					{
					    $maillink .= $cat . ",";
						$cattitle=vmn_getCatTitle($cat);
						$subscribeto .= $cattitle . "<br>";
					}
					$maillink = rtrim($maillink,",");
					$subscribeto = rtrim($subscribeto,"<br>");
				}
				else
				{
					$subscribeto .= $vmnocats;
				}
				$maillink=vmn_sefRelToAbs($maillink);
				
                $search=array('[sitename]','[livesite]','[senddate]','[sendtime]');
		        $replace=array($mainframe->getCfg('sitename'),JURI::root(),JHTML::date('now', JTEXT::_('DATE_FORMAT_LC') ),JHTML::date('now', '%H:%M' ));

		        $subject = str_replace($search,$replace,stripslashes($vmsubject));
		        $subject 	= html_entity_decode($subject, ENT_QUOTES);				

				$database->setQuery("SELECT mailformat FROM #__vemod_news_mailer_users WHERE id=$my->id");
				$usermailformat=$database->loadResult();

				if (($mailformat==1) || (($mailformat==2) && ($usermailformat==1)))
				{
					$message=stripslashes($verifymailText);
					$subscribeto=str_replace("<br>","\n",$subscribeto);
					$maillink=$vmlinktext . "\n" . $maillink;
				}
				else
				{
					$maillink = '<a href="' . $maillink . '" target="_blank">' . $vmlinktext . '</a>';
					$message=stripslashes($verifymailHTML);
				}
				$search=array('[sitename]','[livesite]','[subject]','[username]','[subscribeto]','[verifylink]');
				$replace=array($mainframe->getCfg('sitename'),JURI::root(),stripslashes($vmsubject),$my->name,$subscribeto,$maillink);
				$message=str_replace($search,$replace,$message);
				$codedmessage = vmn_codeMessage($message);
				if (($mailformat==1) || (($mailformat==2) && ($usermailformat==1)))
				{
					$status=JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $my->email, $subject, $codedmessage);
				}
				else
				{
					$status=JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $my->email, $subject, $codedmessage, 1 );
				}
				if ($status===true)
				{
				    vmn_doPageTop(JTEXT::_('VMN_VERIFICATION_MAIL_MESSAGE'));
				}
				else
				{
                    vmn_doPageTop($status->getMessage());    
                }
			}
			else
			{
				vmn_updateSubs($my->id,@$_POST['cid']);
				vmn_doPageTop(JTEXT::_('VMN_YOUR_SUBSCRIPTIONS_HAS_BEEN_UPDATED'));
			}
		}
		elseif (($emailverify > 0) && ($emailverifyuser==$my->id))
		{
			vmn_updateSubs($my->id,$emailverifycats);
			vmn_doPageTop(JTEXT::_('VMN_YOUR_SUBSCRIPTIONS_HAS_BEEN_UPDATED'));
		}
		elseif (($unsubscribeall > 0) && ($my->id != 0))
		{
			vmn_updateSubs($my->id,$emailverifycats);
			vmn_doPageTop(JTEXT::_('VMN_YOUR_SUBSCRIPTIONS_HAS_BEEN_UPDATED'));
		}
		//Linked from the menu
		else
		{
			if ($my->id != 0)
			{
				if ($changeusermailformat != '')
				{
			    		vmn_doPageTop(($changeusermailformat==1) ? JTEXT::_('VMN_TEXT_CHOSEN'):JTEXT::_('VMN_HTML_CHOSEN'));
				}
			    else if ($smssubscribe != '')		
    		    {
    		            vmn_doPageTop(JTEXT::_('VMN_YOUR_SUBSCRIPTIONS_HAS_BEEN_UPDATED'));
    		    }
				else
				{
		    			vmn_doPageTop(JTEXT::_('VMN_YOUR_EMAIL')." ".$my->email);
				}
			}
		}
		//Show users subscriptions
		$fdescription=unserialize(stripslashes(@$frontdescription));
		$sfdescription=unserialize(stripslashes(@$sfrontdescription));
		vmn_doForm(vmn_sefRelToAbs($base_url));
		$database->setQuery( "SELECT catid FROM #__vemod_news_mailer_subs WHERE userid=$my->id ORDER BY catid" );
		$checked=$database->loadResultArray();
		$sresults=vmn_getSecs($vmnsecs);
		$seccount=count($sresults);
		$results=vmn_getCatsExclSecs($vmncats,$vmnsecs);

		if (@$frontendtree)
		{
    		$ncsecs=array();
    		for($i=0; $i < count( $results ); $i++) 
    		{
                $ncsecs[$results[$i]->section][]=$results[$i];
    		}
    		$nccatcount=0;
    		$ncseccount=0;
    		$ncsecchecked=array();
    		if (count($ncsecs))
    		{
                foreach ($ncsecs as $ncsec)
                {
                    $ncseccount++;
                    $matchall=true;
                    foreach ($ncsec as $nccat)
                    {
                        if (!in_array($nccat->id,$checked))
                        {
                            $matchall=false;
                        }
                        $nccatcount++;    
                    }
                    if ($matchall)
                    {
                        $ncsecchecked[]=array_search ( $ncsec , $ncsecs, true );
                    }
                }
            }
        ?>
		
<SCRIPT LANGUAGE="JavaScript">
<!--
function collapseSection(id)
{
    if (document.getElementById( id ).style.display=='none')
    {
	     var elem = document.getElementById( id );
		  //alert(elem.id);
	     if( elem )
	     {
          elem.style.display = 'block';
	     } /* if */
	  document.getElementById( id+'_collapse' ).src="components/com_vemod_news_mailer/collapseall.png";
	}
	else
	{
	     var elem = document.getElementById( id );
		  //alert(elem.id);
	     if( elem )
	     {
          elem.style.display = 'none';
	     } /* if */
	  document.getElementById( id+'_collapse' ).src="components/com_vemod_news_mailer/expandall.png";
    }
}

function checkSection(id,start,count,toggle)
{
	var c = toggle.checked;
	var n2 = 0;

        for (var i=0;i<count;i++)
        {
             cb = document.getElementById('cb'+(start+i));
		     if ( cb ) 
             {
			     cb.checked = c;
			     n2++;
		     }
        }             
}

    -->
    </script>		
		
		<?php
        }		
		echo '<table width="100%"><tr width="100%"><td width="100%">';
            echo '<table width="100%"><tr class="sectiontableheader" cellspacing="0"><td class="sectionname" width="30">&nbsp;</td>';
			echo '<td class="sectionname" width="30"><input type="checkbox" name="toggle" value="" onclick="javascript:vmn_checkAll(' . (count($results) + $seccount+@$ncseccount) . ');" /></td>';
			echo '<td class="sectionname" width="99%">'.JTEXT::_('VMN_YOU_ARE_SUBSCRIBING_TO').'</td></tr></table>';		
			$evencount='0';
			for($i=0; $i < count( $sresults ); $i++) 
			{
			    if (@$frontendtree)
			    {                
		            $i1=0;
                    $secid=$sresults[$i]->id;
                    $database->setQuery("SELECT * FROM #__categories WHERE section=$secid ORDER BY ordering");
                    $subcats=$database->loadObjectList();
                    if (count($subcats))
                    {
                        
                        echo '<table width="100%" cellspacing="0">';
                        vmn_doCountingTableRow($evencount);
                        echo '<td><div style="padding-left:10px;"><img id="ncsection'.$secid.'_collapse'.'" src="components/com_vemod_news_mailer/expandall.png" onclick="javascript:collapseSection(\'ncsection'.$secid.'\');" /></div></td>
                        <td width="30">';
                        echo '<input type="checkbox" id="cb'.$i.'" name="cid[]" value="'.-($secid).'"'; 
	                    if (count($checked))
                		{	
		                     echo in_array(-($secid),$checked) ? 'checked':''; 
	                    }
                		echo '></td>';
                		echo '<td width="49%">'.$sresults[$i]->title.'</td>';
                		echo '<td width="49%">'.$sfdescription[-($sresults[$i]->id)].'</td>';		
                		echo '<td width="20">'; 
                		if (count($scheckedsms))
                		{	
                			echo in_array(-($secid),$scheckedsms) ? '<img src="components/com_vemod_news_mailer/sms.gif" />':'&nbsp;'; 
                		}
                        echo '</td></tr></table>';
                        echo '<table width="100%" id="ncsection'.$secid.'" style="display:none;" cellpadding="0"><tr width="100%"><td width="30"><div style="padding-left:28px;">&nbsp;</div></td><td width="99%" style="border:1px solid #AAAAAA;">';                        
                        foreach ($subcats as $subcat)
                        {
                            $evencount--;
                            echo '<table width="100%" cellspacing="0">';    
	                        vmn_doCountingTableRow($evencount); 
                            echo '<td width="30">&nbsp;&nbsp;&bull;&nbsp;</td><td width="50%">'.$subcat->title.'</td><td width="50%">'.@$fdescription[$subcat->id].'</td></tr></table>';                               
                        } 
                        echo '</td></tr></table>';
                    }                
                }
			    else
			    {
				    vmn_doMySubscriptionsRow($evencount,$sresults[$i]->title,-($sresults[$i]->id),$i,$checked,$sfdescription[-($sresults[$i]->id)],$scheckedsms);
				}
			}
			if (@$frontendtree)
			{
    			$j=0;$i=0;
    			if ($nccatcount)
    			{
                    foreach ($ncsecs as $ncsec)
                    {
    		            $i1=0;
                        $secid=array_search ( $ncsec , $ncsecs, true );
                        echo '<table width="100%" cellspacing="0">';
                        vmn_doCountingTableRow($evencount);
                        echo '<td><div style="padding-left:10px;"><img id="ncsection'.$secid.'_collapse'.'" src="components/com_vemod_news_mailer/expandall.png" onclick="javascript:collapseSection(\'ncsection'.$secid.'\');" /></div></td>
                        <td width="30"><input type="checkbox" id="cb'.(count($results) + $seccount+$j).'" name="togglesection'.$secid.'" value="" onclick="javascript:checkSection(\'ncsection'.$secid.'\','.($seccount+$i).','.count($ncsec).',this);" ';
                        if (in_array($secid,$ncsecchecked))
                        {
                            echo 'checked ';
                        }
                        echo '/>
                        </td>
                        <td width="49%">'.vmn_getCatTitle(-$secid).'</td>
                        <td width="49%">'.@$sfdescription[-$secid].'</td><td width="20">&nbsp;</td></tr></table>';
                        echo '<table width="100%" id="ncsection'.$secid.'" style="display:none;" cellpadding="0"><tr width="100%"><td width="30"><div style="padding-left:28px;">&nbsp;</div></td><td width="99%" style="border:1px solid #AAAAAA;">';                        
                        foreach ($ncsec as $nccat)
                        {
                            $evencount--;
                            vmn_doMySubscriptionsRow($evencount,$nccat->title,$nccat->id,$i+$seccount,$checked,$fdescription[$nccat->id],$checkedsms,false); 
                            $i++;$i1++;       
                        } 
                        $j++; 
                        echo '</td></tr></table>';             
                    }
                }
            }
            else
            {
    			for($i=0; $i < count( $results ); $i++) 
    			{
    			    vmn_doMySubscriptionsRow($evencount,$results[$i]->title,$results[$i]->id,$i+$seccount,$checked,$fdescription[$results[$i]->id],$checkedsms);
    			}
            }
		echo '</td></tr></table>';
		//vmn_doEndTable();
		echo "<br>";
		vmn_doTable();
			vmn_doTableRow();
                vmn_doButton(JTEXT::_('VMN_SUBSCRIBE'),0,'',!JMailHelper::isEmailAddress($my->email));
				vmn_doButton(JTEXT::_('VMN_PREVIEW'),$previewusers,'',false,'preview');
				/*
				if ($mailusers < $previewusers)
				{
					vmn_doButton(JTEXT::_('VMN_SEND'),$mailusers,vmn_sefRelToAbs($base_url . "&amp;checknews=1"),false);
				}
				*/
				vmn_doButton(JTEXT::_('VMN_VIEW_LOG'),$previewusers,'',false,'viewlog');
				//vmn_doButton(JTEXT::_('VMN_VIEW_SUBS'),$previewusers,vmn_sefRelToAbs($base_url . "&amp;viewsubs=1"),false);
			vmn_doEndTableRow();
		vmn_doEndTable();	
		echo "<br>";								
		if ($mailformat==2)
		{
			require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/js.vemod_news_mailer.php");
			$database->setQuery("SELECT mailformat FROM #__vemod_news_mailer_users WHERE id=$my->id");
			$usermailformat=$database->loadResult();        		
			?>
			<textarea name="previewHTMLwindow" id="previewHTMLwindow" style="display:none;" cols="100" rows="15"><?php echo stripslashes($newsmailHTML); ?></textarea>
			<textarea name="previewtextwindow" id="previewtextwindow" style="display:none;" cols="100" rows="15"><?php echo stripslashes($newsmailText); ?></textarea>
			<table cellpadding="0" cellspacing="0" align="center" width="100%">
				<tr>
					<td align="center" colspan="4"><center>			
					<?php
					echo $mailformatmessage;
					?>
					</center></td>
				</tr>
			</table>
			<center>			
			<table cellpadding="0" cellspacing="0" align="center">
				<tr align="center">
					<td>&nbsp;&nbsp;&nbsp;
						<?php 
						if ($usermailformat != 1)
						{
							?><img src="<?php echo "components/com_vemod_news_mailer/tick.png"; ?>"><?php	
						}
						?>&nbsp;&nbsp;					
					</td>
					<td> 
					<?php
					if (($usermailformat == 1) && ($my->id != 0))
					{
						?><a id="selectHTML" href="<?php echo vmn_sefRelToAbs($base_url . "&amp;changeusermailformat=0"); ?>" title="<?php echo JTEXT::_('Select'); ?>"><strong>HTML</strong></a>&nbsp;&nbsp;&nbsp;<?php
					}
					else
					{
						?><strong>HTML</strong>&nbsp;&nbsp;&nbsp;<?php
					}
					?>
				    </td>
					<td width="25">
						<?php
                        echo doHTMLPreview($readmore,$sidebarmodules,$unsubscribealltext);
                        ?>
                        <img src="components/com_vemod_news_mailer/html.gif" border="0" alt="<?php echo JTEXT::_('VMN_PREVIEW'); ?>"/></a>
					</td>
					<td>
						<?php
                        echo doHTMLPreview($readmore,$sidebarmodules,$unsubscribealltext);
                        echo JTEXT::_('VMN_PREVIEW'); ?></a>
					</td>					
        	  	</tr>
				<tr align="center">
					<td>&nbsp;&nbsp;&nbsp;
						<?php
						if ($usermailformat == 1)
						{
							?><img src="<?php echo "components/com_vemod_news_mailer/tick.png"; ?>"><?php
						}
						?>&nbsp;&nbsp;
					</td>
     				<td>
					<?php
					if (($usermailformat != 1) && ($my->id != 0))
					{
						?><a id="selectText" href="<?php echo vmn_sefRelToAbs($base_url . "&amp;changeusermailformat=1"); ?>" title="<?php echo JTEXT::_('Select'); ?>"><strong>Text</strong></a>&nbsp;&nbsp;&nbsp;<?php
					}
					else
					{
						?><strong>Text</strong>&nbsp;&nbsp;&nbsp;<?php
					}
					?>
				    </td>
					<td width="25">                 			  
				  		<?php
                        echo doTextPreview($readmore,$sidebarmodules,$unsubscribealltext);
                        ?>
                        <img src="components/com_vemod_news_mailer/text.gif" border="0" alt="<?php echo JTEXT::_('VMN_PREVIEW'); ?>"/></a>
					</td>                    								
					<td align="left">                    			  
				  		<?php
                        echo doTextPreview($readmore,$sidebarmodules,$unsubscribealltext);
                        echo JTEXT::_('VMN_PREVIEW'); ?></a>
					</td>
    			</tr>					
			</table>
			</center>
			<?php          			
		}
		if (@$smsoperator != '')
		{
		    ?>
		    <br>
            <center>
		    <table cellpadding="0" cellspacing="0" align="center">
			<tr align="center">                
            <td align="center">
            <div align="center"><center>
            <?php echo @$smsfrontendtext; ?>
            </center></div>
            </td>
            </tr>
			<tr align="center">                
            <td align="center">
            <div align="center"> 
            <?php 
            if (JMailHelper::isEmailAddress($my->email))
            {
                $database->setQuery("SELECT metatags FROM #__vemod_news_mailer_users WHERE id=$my->id");
                $smsdetails=$database->loadResult();
                ?>
                <table cellpadding="0" cellspacing="0" border="0" align="center"><tr>
                <td width="16">
                <img src="components/com_vemod_news_mailer/sms.gif" alt="SMS"/>
                </td>
                <td>&nbsp;&nbsp;
                <input type="textbox" name="smsdetails" size="16" value="<?php echo @$smsdetails; ?>" />&nbsp;&nbsp;
                </td>
                <td width="16">                    
                <input type="image" name="smssubscribe" src="components/com_vemod_news_mailer/apply_f2.gif" border="0" title="<?php echo JTEXT::_('APPLY'); ?>" />
                </td></tr></table>
                <?php
            }
            else
            {
                ?>
                <table cellpadding="0" cellspacing="0" border="0" align="center"><tr>
                <td width="16">
                <img src="components/com_vemod_news_mailer/sms.gif" />
                </td>                    
                <td>&nbsp;&nbsp;                    
                <input type="textbox" name="smsdetails" size="16" value="" />&nbsp;&nbsp;
                </td>
                <td width="16">                                                           
                <img src="components/com_vemod_news_mailer/apply.gif" height="16" width="16" border="0" title="<?php echo JTEXT::_('APPLY'); ?>" />
                </td></tr></table>                    
                <?php
            }
            ?>
            </div>
            </td>
            </tr>
            </table>
            </center>                
            <?php
        }
		if (@$archiveitems)
		{
		    require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/js.vemod_news_mailer.php");
		    if (($my->id==0) && (@$archiveusers!=0))
		    {}
		    else
		    {
                $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_subs WHERE userid=$my->id");
                $issubscriber= $database->loadResult();
                if ((@$archiveusers==2) && (!$issubscriber))
                {}
                else
                {
        		    $query="SELECT * FROM #__vemod_news_mailer_log WHERE status=0 AND message NOT LIKE '<sms></sms>%' ";
        		    if (@$archiveformat==1)
        		    {
        		        $query.="AND message NOT LIKE '<pre>%' ";
                    }
                    else if (@$archiveformat==2)
                    {
        		        $query.="AND message LIKE '<pre>%' ";       
                    }
                    $query.="ORDER BY sent DESC LIMIT ".@$archiveitems;
                    $database->setQuery($query);
                    $archive=$database->loadObjectList();
                    if (count($archive))
                    {
                        echo '<br><br>';
                    	vmn_doTableHeader(array('','',@$archivename));
                    		$evencount='0';
                    		for ($i=0;$i < count($archive);$i++)
                    		{
                    			vmn_doArchiveRow($evencount,$archive[$i],@$archiveitemtext);
                    		}
                    	vmn_doEndTable();        
                    }
                }
            }
        }		
		vmn_doEndForm();
		break;
}
if (!$fromtemplate)
{
	# STOP! REMOVAL OF THE FOOTER IS NOT ALLOWED.
	# REMEMBER I PUT A LOT AF HARD WORK INTO THIS AND REMOVAL OF THE FOOTER IS STEALING!
	# YOU CAN HOWEVER EASE YOUR MIND HERE: http://www.shareit.com/product.html?productid=300182359
	vmn_doFooter();
}

?>
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

function vmn_stripMambots($str, $tags = "", $stripContent = false)
{
    preg_match_all("/{([^}]+)}/i",$tags,$allTags,PREG_PATTERN_ORDER);
    foreach ($allTags[1] as $tag)
    {
        if ($stripContent) {
            $str = preg_replace("/{".$tag."[^}]*}.*{\/".$tag."}/iU","",$str);
        }
        $str = preg_replace("/{\/?".$tag."[^}]*}/iU","",$str);
    }
    return $str;
}

function vmn_autoAddUsers($vmncats,$vmnsecs,$now,$lastscan)
{
    $database = &JFactory::getDBO();
    $timezoneoffset=date("O") / 100 * 60 * 60;
    $localnow=date('Y-m-d H:i:s',strtotime($now)+$timezoneoffset);
    $locallastscan=date('Y-m-d H:i:s',strtotime($lastscan)+$timezoneoffset);
	if (strlen($vmnsecs)==0) $vmnsecs="-9999999";
	$database->setQuery( "SELECT id FROM #__sections WHERE published=1 AND id IN (" . $vmnsecs . ") ORDER BY ordering" );
	$sections = $database->loadResultArray();
	if (strlen($vmncats)==0) $vmncats="-9999999";
	$database->setQuery( "SELECT id FROM #__categories WHERE published=1 AND id IN (" . $vmncats . ") AND section NOT IN (" . $vmnsecs . ") ORDER BY section, ordering" );
	$categories = $database->loadResultArray();
	$database->setQuery( "SELECT id,name,email FROM #__users WHERE registerDate > ".$database->quote($locallastscan)." AND registerDate <= ".$database->quote($localnow) );
	$users=$database->loadObjectList();
	$catcount=count($categories);
	$seccount=count($sections);
	if (count($users))
	{
    	foreach ($users as $user)
    	{
    	   $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_subs WHERE userid=$user->id");
    	   $alreadythere=$database->loadResult();
    	   if (!$alreadythere)
    	   {
            	if (JMailHelper::isEmailAddress($user->email ))
            	{
            	   if ($seccount)
                   {
                    	foreach($sections as $section)
                    	{
    				    	$database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($user->id,-$section)");
                  			$database->query();
    		            }
    		        }
    		        if ($catcount)
    		        {
                    	foreach($categories as $category)
                    	{
    		    	        $database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($user->id,$category)");
               				$database->query();
    		      		}
    		      	}
    		     }
		    }
		}
	}
}
//keep the log down
function vmn_trimLog($trimsize)
{
    $database = &JFactory::getDBO();
	$database->setQuery( "SELECT COUNT(*) FROM #__vemod_news_mailer_log" );
	$logcount=$database->loadResult();
	if ($logcount > $trimsize)
	{
		$logdelete=$logcount-$trimsize;
		$database->setQuery( "DELETE FROM #__vemod_news_mailer_log WHERE (status >=0 AND status <=2) ORDER BY sent LIMIT $logdelete" );
		$database->query();				    
	}
}

//remove special nordic characters and replace relative links with absolute ones
function vmn_codeMessage($message)
{
	$search = array('&aring;','&auml;','&ouml;','&Aring;','&Auml;','&Ouml;','&amp;');
	$replace = array('å','ä','ö','Å','Ä','Ö','&');
	$message = str_replace($search,$replace,$message);
	$message = str_replace("\r\r", "\r", str_replace("\n", "\r\n", $message));
	//Convert relative links to absolute.
	$message=preg_replace('#(href|src)="([^:"]*)("|(?:(?:%20|\s|\+)[^"]*"))#','$1="' . JURI::root() . '/$2$3',$message);
	return vmn_wordwrap($message);
}

//get the url of a content item
function vmn_getContentURL($newsitem)
{
    global $mainframe;
	$database = &JFactory::getDBO();
	$Itemid = $mainframe->getItemid( $newsitem->id, 0, 0);
	//$database->setQuery("SELECT DISTINCT id FROM #__menu WHERE type = 'content_category' AND componentid=$newsitem->catid AND published=1");
	//$menuid = $database->loadResult();
	//return vmn_sefRelToAbs("index.php?option=com_content&amp;task=view&amp;id=". $newsitem->id . "&amp;Itemid=" . $menuid);
    return vmn_sefRelToAbs("index.php?view=article&amp;id=". $newsitem->id . "&amp;option=com_content&amp;Itemid=" . $Itemid); 
}

function vmn_buildHTMLMessage($newsitem,&$message,$readmore,$sidebarmodules,$newsmailHTML,$send,$unsubscribealltext,$base_url,$categoryname,$subject,$stripmambots)
{
	global $mainframe;
	// Build e-mail message format
	//$subject 	= html_entity_decode($mainframe->getCfg('sitename') . " / " . $newsitem->title, ENT_QUOTES);
	
	$message=stripslashes($newsmailHTML);
    $introtext=$newsitem->introtext;	
	if ($newsitem->catid > -1)
	{
		$bodytext=$newsitem->fulltext;	
		truncateHTML($readmore,$introtext,$bodytext,$newsitem);
	}
	else
	{
		$text=explode("[#*%*#]",$newsitem->fulltext);
		$bodytext=$text[0];	
	}
	
	$unsubscribealllink='<a target="_blank" href="' . JURI::root() . '/' . $base_url . '&amp;unsubscribeall=1">' . $unsubscribealltext . '</a>';
	
	$search=array('[sitename]','[livesite]','[title]','[introtext]','[bodytext]','[subject]','[unsubscribeall]','[senddate]','[sendtime]','[categoryname]');
	$replace=array($mainframe->getCfg('sitename'),JURI::root(),$newsitem->title,$introtext,$bodytext,$subject,$unsubscribealllink,JHTML::date('now', JTEXT::_('DATE_FORMAT_LC') ),JHTML::date('now', '%H:%M' ),$categoryname);
	
	$message = str_replace($search,$replace,$message);	

	if (isset($newsitem->created_by))
	{
		$message = str_replace("[publishdatetime]", JHTML::Date($newsitem->publish_up,JTEXT::_('DATE_FORMAT_LC2')),$message);
		$message = str_replace("[author]", vmn_getAuthorName($newsitem),$message);
	}
	else
	{
		$message = str_replace("[publishdatetime]", '',$message);
		$message = str_replace("[author]", '',$message);
	}
	for ($i=0;$i<6;$i++)
	{
		if (strlen($sidebarmodules[$i]['name']))
		{
			$message=str_replace('[moduletitle'.($i+1).']',$sidebarmodules[$i]['title'],$message);
			$message=str_replace('[modulecontent'.($i+1).']',vmn_getModuleContent($sidebarmodules[$i],$send),$message);
		}
	}
	if (isset($newsitem->images))
	{
		$message=vmn_mosImage($message,$newsitem->images);
	}   
	$message = str_replace('{mospagebreak}','',$message );
    $message=vmn_stripMambots($message,$stripmambots,true);	
	return vmn_codeMessage($message);
}

function vmn_mosImage($text,$images)
{
	$images = explode( "\n", $images );
	$images1 = array();

	foreach ($images as $img) {
		$img = trim( $img );
		if ($img) {
			$temp = explode( '|', trim( $img ) );
			if (!isset( $temp[1] ))
			{
				$temp[1] = "left";
			}
			if ($temp[1]=="")
			{
                        	$temp[1]="none";
			}
			if (!isset( $temp[2] )) {
				$temp[2] = "Image";
			} else {
				$temp[2] = htmlspecialchars( $temp[2] );
			}
			if (!isset( $temp[3] )) {
				$temp[3] = "0";
			}
			$size = '';
			if (function_exists( 'getimagesize' )) {
				$size = @getimagesize( "JPATH_SITE/images/stories/$temp[0]" );
				if (is_array( $size )) {
					$size = "width=\"$size[0]\" height=\"$size[1]\"";
				}
			}
			if (!isset($temp[4]))
			{
                        	$temp[4]=""; //caption
			}
			if (!isset($temp[5]))
			{
                        	$temp[5]="bottom"; //caption pos bottom
			}
			if (!isset($temp[6]))
			{
                        	$temp[6]="0"; //caption align none
			}
			if (!isset($temp[7]))
			{
                        	$temp[7]="0"; //caption width 0
			}
			if ($temp[4]=="")		//no caption
			{
				$images1[]="<div style=\" border-width: $temp[3]px; float: $temp[1]; width: $temp[7]px;\" align=\"$temp[1]\">
				<img src=\"".JURI::root()."/images/stories/$temp[0]\" $size hspace=\"6\" alt=\"$temp[2]\" title=\"$temp[2]\" border=\"0\" />
				</div>";
			}
			else if ($temp[1]=="none")	//no align
			{
                        	$images1[]="<img src=\"".JURI::root()."/images/stories/$temp[0]\" $size hspace=\"6\" alt=\"$temp[2]\" title=\"$temp[2]\" border=\"0\" />";
			}
			else if ($temp[5]!="top")	//caption below
			{
				$images1[]="<div style=\" border-width: $temp[3]px; float: $temp[1]; width: $temp[7]px;\" align=\"$temp[1]\">
				<img src=\"".JURI::root()."/images/stories/$temp[0]\" $size hspace=\"6\" alt=\"$temp[2]\" title=\"$temp[2]\" border=\"0\" />
				<div style=\"text-align: $temp[6]\" align=\"$temp[6]\">$temp[4]</div>
				</div>";
			}
			else				//caption above
			{
                        	$images1[]="<div style=\" border-width: $temp[3]px; float: $temp[1]; width: $temp[7]px;\" align=\"$temp[1]\">
                        	<div style=\"text-align: $temp[6]\" align=\"$temp[6]\">$temp[4]</div>
                        	<img src=\"".JURI::root()."/images/stories/$temp[0]\" $size hspace=\"6\" alt=\"$temp[2]\" title=\"$temp[2]\" border=\"0\" />
                        	</div>";
			}
		}
	}

	$text1 = explode( '{mosimage}', $text );

	$text = $text1[0];

	for ($i=0, $n=count( $text1 )-1; $i < $n; $i++) {
		if (isset( $images1[$i] )) {
			$text .= $images1[$i];
		}
		if (isset( $text1[$i+1] )) {
			$text .= $text1[$i+1];
		}
	}
	unset( $text1 );
	return $text;
}

function vmn_buildTextMessage($newsitem,&$message,$readmore,$newsmailText,$unsubscribealltext,$base_url,$categoryname,$subject,$sidebarmodules,$send,$stripmambots)
{
	global $mainframe;
	// Build e-mail message format
	$h2t =& new vmn_class_html2text();
	//$subject 	= html_entity_decode($mainframe->getCfg('sitename') . " / " . $newsitem->title, ENT_QUOTES);

	$h2t->set_html($newsitem->introtext);
	$h2t->set_base_url(JURI::root());
	$introtext = $h2t->get_text();

	$message=stripslashes($newsmailText);
	if ($newsitem->catid==-1)
	{
		$text=explode("[#*%*#]",$newsitem->fulltext);
		$bodytext=$text[1];
	}
	else
	{
		$h2t->set_html($newsitem->fulltext);
		$h2t->set_base_url(JURI::root());
		$bodytext = $h2t->get_text();
		truncateText($readmore,$introtext,$bodytext,$newsitem);
	}
	
	for ($i=0;$i<6;$i++)
	{
		if (strlen($sidebarmodules[$i]['name']))
		{
		    $h2t->set_html($sidebarmodules[$i]['title']);
		    $h2t->set_base_url(JURI::root());		
			$message=str_replace('[moduletitle'.($i+1).']',$h2t->get_text(),$message);
		    $h2t->set_html(vmn_getModuleContent($sidebarmodules[$i],$send));
		    $h2t->set_base_url(JURI::root());					
			$message=str_replace('[modulecontent'.($i+1).']',$h2t->get_text(),$message);
		}
	}	

	$h2t->set_html($newsitem->title);
	$h2t->set_base_url(JURI::root());
	$title = $h2t->get_text();

	$unsubscribealllink=$unsubscribealltext . '
' . JURI::root() . '/' . $base_url . '&amp;unsubscribeall=1';
	$search=array('[sitename]','[livesite]','[title]','[introtext]','[bodytext]','[subject]','[unsubscribeall]','[senddate]','[sendtime]','[categoryname]');
	$replace=array($mainframe->getCfg('sitename'),JURI::root(),$title,$introtext,$bodytext,$subject,$unsubscribealllink,JHTML::date('now', JTEXT::_('DATE_FORMAT_LC') ),JHTML::date('now', '%H:%M' ),$categoryname);

	$message = str_replace($search,$replace,$message);

	if (isset($newsitem->created_by))
	{
		$message = str_replace("[publishdatetime]", JHTML::date($newsitem->publish_up,JTEXT::_('DATE_FORMAT_LC2')),$message);
		$message = str_replace("[author]", vmn_getAuthorName($newsitem),$message);
	}
	else
	{
		$message = str_replace("[publishdatetime]", '',$message);
		$message = str_replace("[author]", '',$message);
	}
	$message = str_replace( '{mosimage}','',$message );

	$message = str_replace('{mospagebreak}','',$message );
    $message=vmn_stripMambots($message,$stripmambots,true);
    return vmn_codeMessage($message);
}

function vmn_buildSMSMessage($newsitem,&$message,$smsText,$categoryname,$subject,$send)
{
	global $mainframe;
	// Build sms message format
	$h2t =& new vmn_class_html2text();
	//$subject 	= html_entity_decode($mainframe->getCfg('sitename') . " / " . $newsitem->title, ENT_QUOTES);

	$message=stripslashes($smsText);

	$h2t->set_html($newsitem->title);
	$h2t->set_base_url(JURI::root());
	$title = $h2t->get_text();

	$search=array('[sitename]','[title]','[senddate]','[sendtime]','[categoryname]');
	$replace=array($mainframe->getCfg('sitename'),$title,JHTML::date('now', JTEXT::_('DATE_FORMAT_LC') ),JHTML::date('now', '%H:%M' ),$categoryname);

	$message = str_replace($search,$replace,$message);

	return vmn_codeMessage($message);
}

function truncateText($readmore,&$introtext,&$bodytext,$newsitem)
{
	switch ($readmore['use'])
	{
	    case 1:
			$bodytexttrunc=substr($bodytext,0,$readmore['truncate']);
			if (strlen($bodytexttrunc) != strlen($bodytext))
			{
				$bodytext = $bodytexttrunc . '...

' . $readmore['text'] . '
' . vmn_getContentURL($newsitem) . ' ' . '
';
			}
			break;
		case 2:
			$introtexttrunc=substr($introtext,0,$readmore['truncate']);
			if (strlen($introtexttrunc) != strlen($introtext))
			{
				$introtext = $introtexttrunc . '...

' . $readmore['text'] . '
' . vmn_getContentURL($newsitem) . ' ' . '
';
			}
			$bodytext='';
			break;
        default:
            break;    		
	}
}

function truncateHTML($readmore,&$introtext,&$bodytext,$newsitem)
{
	switch ($readmore['use'])
	{
	    case 1:
			$bodytexttrunc=vmn_truncate($bodytext,$readmore['truncate']);
			if (strlen($bodytexttrunc) != strlen($bodytext))
			{
				$bodytext = $bodytexttrunc.'<br><a target="_blank" href="' . vmn_getContentURL($newsitem) . '">' . $readmore['text'] . '</a><br>';
			}
			break;
		case 2:
			$introtexttrunc=vmn_truncate($introtext,$readmore['truncate']);
			if (strlen($introtexttrunc) != strlen($introtext))
			{
				$introtext = $introtexttrunc.'<br><a target="_blank" href="' . vmn_getContentURL($newsitem) . '">' . $readmore['text'] . '</a><br>';
			}
			$bodytext='';
		    break;
		default:
		    break;
	}
}
//format and send a mail
function vmn_sendNews($newsitem,$send,&$HTMLmessage,&$textmessage,&$subject,&$sentHTMLusers,&$senttextusers,$subscribers,$now,$readmore,
$sidebarmodules,$newsmailHTML,$newsmailText,$mailformat,$textusers,$emailsettings,$unsubscribealltext,$base_url,$categoryname,$throttleinterval,$throttlesize,$newsmailsubject,$stripmambots)
{
	global $mainframe;
	if (!strlen($newsmailsubject))
	{
		$subject 	= html_entity_decode($mainframe->getCfg('sitename') . " / " . $newsitem->title, ENT_QUOTES);
	}
	else
	{
		$search=array('[sitename]','[livesite]','[title]','[senddate]','[sendtime]','[categoryname]');
		$replace=array($mainframe->getCfg('sitename'),JURI::root(),$newsitem->title,JHTML::date('now', JTEXT::_('DATE_FORMAT_LC') ),JHTML::date('now', '%H:%M' ),$categoryname);

		$subject = str_replace($search,$replace,stripslashes($newsmailsubject));
		$subject 	= html_entity_decode($subject, ENT_QUOTES);
	}

	$senttextusers="";
	$sentHTMLusers="";
	if ($mailformat==1)
	{
		$codedmessage=vmn_buildTextMessage($newsitem,$textmessage,$readmore,$newsmailText,$unsubscribealltext,$base_url,$categoryname,$subject,$sidebarmodules,$send,$stripmambots);
		$bccusers=array();
		foreach ($subscribers as $subscriber)
		{
			if (JMailHelper::isEmailAddress($subscriber->email))
			{
				$senttextusers.= $subscriber->name . " / " . $subscriber->email . "<br>";
				//$bccusers[]=$subscriber->email;
				$bccusers['email'][]=$subscriber->email;
				$bccusers['name'][]=$subscriber->name;
			}
		}
		if ($send)
		{
			vmn_sendtextmail($now,$bccusers,$subject,$codedmessage,$textmessage,$senttextusers,$emailsettings,$throttleinterval,$throttlesize);
		}
	}
	else if ($mailformat==2)
	{
		$codedmessage=vmn_buildTextMessage($newsitem,$textmessage,$readmore,$newsmailText,$unsubscribealltext,$base_url,$categoryname,$subject,$sidebarmodules,$send,$stripmambots);
		$bccusers=array();
		foreach ($subscribers as $subscriber)
		{
			if (in_array($subscriber->id,$textusers))
			{
				if (JMailHelper::isEmailAddress($subscriber->email))
				{
					$senttextusers.= $subscriber->name . " / " . $subscriber->email . "<br>";
					//$bccusers[]=$subscriber->email;
					$bccusers['email'][]=$subscriber->email;
					$bccusers['name'][]=$subscriber->name;
				}
			}
		}
		if ($send)
		{
			vmn_sendtextmail($now,$bccusers,$subject,$codedmessage,$textmessage,$senttextusers,$emailsettings,$throttleinterval,$throttlesize);
		}
		$codedmessage=vmn_buildHTMLMessage($newsitem,$HTMLmessage,$readmore,$sidebarmodules,$newsmailHTML,$send,$unsubscribealltext,$base_url,$categoryname,$subject,$stripmambots);
		$bccusers=array();
		foreach ($subscribers as $subscriber)
		{
			if (!in_array($subscriber->id,$textusers))
			{
				if (JMailHelper::isEmailAddress($subscriber->email))
				{
					$sentHTMLusers.= $subscriber->name . " / " . $subscriber->email . "<br>";
					//$bccusers[]=$subscriber->email;
					$bccusers['email'][]=$subscriber->email;
					$bccusers['name'][]=$subscriber->name;
				}
			}
		}
		if ($send)
		{
			vmn_sendHTMLmail($now,$bccusers,$subject,$codedmessage,$HTMLmessage,$sentHTMLusers,$emailsettings,$throttleinterval,$throttlesize);
		}
	}
	else
	{
		$codedmessage=vmn_buildHTMLMessage($newsitem,$HTMLmessage,$readmore,$sidebarmodules,$newsmailHTML,$send,$unsubscribealltext,$base_url,$categoryname,$subject,$stripmambots);
		$bccusers=array();
		foreach ($subscribers as $subscriber)
		{
			if (JMailHelper::isEmailAddress($subscriber->email))
			{
				$sentHTMLusers.= $subscriber->name . " / " . $subscriber->email . "<br>";
				//$bccusers[]=$subscriber->email;
				$bccusers['email'][]=$subscriber->email;
				$bccusers['name'][]=$subscriber->name;
			}
		}
		if ($send)
		{
			vmn_sendHTMLmail($now,$bccusers,$subject,$codedmessage,$HTMLmessage,$sentHTMLusers,$emailsettings,$throttleinterval,$throttlesize);
		}
	}
}

//format and send an SMS
function vmn_sendSMS($newsitem,$send,&$textmessage,&$subject,&$senttextusers,$subscribers,$now,
$smsText,$emailsettings,$categoryname,$throttleinterval,$throttlesize,$newsmailsubject)
{
	global $mainframe;
	$subject 	= html_entity_decode($newsmailsubject, ENT_QUOTES);

	$senttextusers="";                
	$codedmessage=vmn_buildSMSMessage($newsitem,$textmessage,$smsText,$categoryname,$subject,$send);
	$bccusers=array();
	if (count($subscribers))
	{
    	foreach ($subscribers as $subscriber)
    	{
    	    $email=trim($subscriber->metatags).'@'.$emailsettings['smsoperator'];
    		if (JMailHelper::isEmailAddress($email))
    		{
    			$senttextusers.= $subscriber->name . " / " . $email . "<br>";
    			//$bccusers[]=$subscriber->email;
    			$bccusers['email'][]=$email;
    			$bccusers['name'][]=$subscriber->name;
    		}
    	}
    	if ($send)
    	{
    		vmn_sendtextmail($now,$bccusers,$subject,$codedmessage,$textmessage,$senttextusers,$emailsettings,$throttleinterval,$throttlesize,'<sms></sms>');
    	}
    }
}

function vmn_sendHTMLmail($now,$bccusers,$subject,$codedmessage,$message,$sentusers,$emailsettings,$throttleinterval,$throttlesize)
{
	global $mainframe;
	$database = &JFactory::getDBO();
	if (count($bccusers))
	{
		if (($throttlesize>0) && ($throttleinterval>0))
		{
			$sentstatus=10;
        }
		else
		{
		    echo chr(0x0);
		    @set_time_limit(0);            		
			$status=(JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $emailsettings['receiver'], $subject, $codedmessage, 1 ,NULL,$bccusers['email'])===true);
			if ($status)
			{
				$sentstatus=0;
			}
			else
			{
				$sentstatus=1;
			}
		}
		$database->setQuery("INSERT INTO #__vemod_news_mailer_log (sent,subject,message,users,status) VALUES (" . $database->Quote($now) . "," . $database->Quote($subject) . "," . $database->Quote($message) . "," . $database->Quote($sentusers) . ",$sentstatus)");
		$database->query();
	}
}

function vmn_sendtextmail($now,$bccusers,$subject,$codedmessage,$message,$sentusers,$emailsettings,$throttleinterval,$throttlesize,$smsprefix='')
{
	global $mainframe;
	$database = &JFactory::getDBO();
	if (count($bccusers))
	{
		if (($throttlesize>0) && ($throttleinterval>0))
		{
			$sentstatus=-10;
		}
		else
		{
		    echo chr(0x0);
		    @set_time_limit(0);            		
		    if (strlen($smsprefix))
		    {
			     $status=(JUtility::sendMail( $emailsettings['smsmailfrom'], $emailsettings['smsfromname'], $emailsettings['smsmailfrom'], $subject, $codedmessage, 0 ,NULL,$bccusers['email'])===true);            
            }
		    else
		    {
			     $status=(JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $emailsettings['receiver'], $subject, $codedmessage, 0 ,NULL,$bccusers['email'])===true);
		    }
			if ($status)
			{
				$sentstatus=0;
			}
			else
			{
				$sentstatus=2;
			}
		}
		$database->setQuery("INSERT INTO #__vemod_news_mailer_log (sent,subject,message,users,status) VALUES (" . $database->Quote($now) . "," . $database->Quote($subject) . "," . $database->Quote($smsprefix."<pre>".$message."</pre>") . "," . $database->Quote($sentusers) . ",$sentstatus)");
		$database->query();
	}
}

function vmn_sendFailedItems($now,$emailsettings,$throttleinterval,$throttlesize,$cats='')
{
	$database = &JFactory::getDBO();
	if (strlen($cats))
	{
	   $database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status = 1 AND id IN ('$cats') ORDER BY sent");    
    }
    else
    {
	   $database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status = 1 ORDER BY sent");
    }    
	$faileditems=$database->loadObjectList();
	if (count($faileditems))
	{
		foreach	($faileditems as $faileditem)
		{
			$database->setQuery("DELETE FROM #__vemod_news_mailer_log WHERE id=$faileditem->id");
			$database->Query();
			$codedmessage=vmn_codeMessage($faileditem->message);
			$valid=vmn_getLoggedUsers($faileditem->users,0,0);
			if (count($valid['email']))
			{
				vmn_sendHTMLmail($now,$valid,$faileditem->subject,$codedmessage,$faileditem->message,$faileditem->users,$emailsettings,$throttleinterval,$throttlesize);
			}
		}
	}
	if (strlen($cats))
	{
	   $database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status = 2 AND id IN ('$cats') ORDER BY sent");	
    }
    else
    {	
	   $database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status = 2 ORDER BY sent");
	}
	$faileditems=$database->loadObjectList();
	if (count($faileditems))
	{
		foreach	($faileditems as $faileditem)
		{
			$database->setQuery("DELETE FROM #__vemod_news_mailer_log WHERE id=$faileditem->id");
			$database->Query();
			$message=$faileditem->message;
			$smsprefix='';
			if (strpos($message,'<sms></sms>')===0)
			{
                $smsprefix='<sms></sms>';
                $message=str_replace('<sms></sms>','',$message);
            }
			$search=array('<pre>','</pre>');
			$replace=array('','');
			$message=str_replace($search,$replace,$message);
			$codedmessage=vmn_codeMessage($message);
			$valid=vmn_getLoggedUsers($faileditem->users,0,0);
			if (count($valid['email']))
			{
				vmn_sendtextmail($now,$valid,$faileditem->subject,$codedmessage,$message,$faileditem->users,$emailsettings,$throttleinterval,$throttlesize,$smsprefix);
			}
		}
	}
}

function vmn_sendThrottledItems($now,$emailsettings,$throttleinterval,$throttlesize)
{
	$database = &JFactory::getDBO();
	if (($throttleinterval<1) || ($throttlesize<1))
	{
        	return;
	}
    vmn_lockTable();    	
    $database->setQuery("SELECT throttletime FROM #__vemod_news_mailer_scantime LIMIT 1");	
    $throttletime=$database->loadResult();
    if ((strtotime($now)-strtotime($throttletime))<$throttleinterval)
    {
        vmn_unlockTable();
        return;
    }
    $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_log WHERE status >= 10 OR status <= -10 ORDER BY sent LIMIT 1");
    $tcount=$database->loadResult();
    if ($tcount)
    {
    	$database->setQuery("UPDATE #__vemod_news_mailer_scantime SET throttletime=" . $database->Quote($now) . " LIMIT 1");
    	$database->query();	    
    }
    vmn_unlockTable();
    echo chr(0x0);
	$database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status >= 10 ORDER BY sent LIMIT 1");
	$throttleditem=NULL;
	$throttleditem=$database->loadObject();
	if ($throttleditem)
	{
		$database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=status+1 WHERE id=$throttleditem->id");
		$database->Query();			        					
		$throttlecount=$throttleditem->status-9;
		$codedmessage=vmn_codeMessage($throttleditem->message);
		$valid=vmn_getLoggedUsers($throttleditem->users,$throttlesize,$throttlecount);
		if (count($valid))
		{
		    $statuscount=0;
			for ($i=0;$i<count($valid['email']);$i++)
			{
		        @set_time_limit(600);			
				$status=(JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $valid['email'][$i], $throttleditem->subject, str_replace('[username]',$valid['name'][$i],$codedmessage), 1 ,NULL,NULL)===true);
				if (($i % 5) == 0)
                {
                    echo chr(0x0);
                }
				if ($status)
				{
                    $statuscount++;
                }
			}
			if ($throttleditem->status==10)
			{
                if ($statuscount<(count($valid['email'])*0.9))
                {
                    $database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=1 WHERE id=$throttleditem->id");
			        $database->Query();
                    return;                       
                }
            }
			return;
		}
		else
		{
			$database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=0 WHERE id=$throttleditem->id");
			$database->Query();
		}
	}
	$database->setQuery("SELECT * FROM #__vemod_news_mailer_log WHERE status <= -10 ORDER BY sent LIMIT 1");
	$throttleditem=NULL;
	$throttleditem=$database->loadObject();
	if ($throttleditem)		
    {
		$database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=status-1 WHERE id=$throttleditem->id");
		$database->Query();		        				    
		$throttlecount=abs($throttleditem->status)-9;
		$message=$throttleditem->message;
		$smsprefix='';
		if (strpos($message,'<sms></sms>')===0)
		{
            $smsprefix='<sms></sms>';
            $message=str_replace('<sms></sms>','',$message);
        }		
		$search=array('<pre>','</pre>');
		$replace=array('','');
		$message=str_replace($search,$replace,$message);
		$codedmessage=vmn_codeMessage($message);
		$valid=vmn_getLoggedUsers($throttleditem->users,$throttlesize,$throttlecount);
		if (count($valid))
		{
		    $statuscount=0;			
			for ($i=0;$i<count($valid['email']);$i++)
			{	
		        @set_time_limit(600);			
			    if (strlen($smsprefix))
			    {
                    $status=(JUtility::sendMail( $emailsettings['smsmailfrom'], $emailsettings['smsfromname'], $valid['email'][$i], $throttleditem->subject, str_replace('[username]',$valid['name'][$i],$codedmessage), 0 ,NULL,NULL)===true);			    
                }
                else
                {
				    $status=(JUtility::sendMail( $emailsettings['mailfrom'], $emailsettings['fromname'], $valid['email'][$i], $throttleditem->subject, str_replace('[username]',$valid['name'][$i],$codedmessage), 0 ,NULL,NULL)===true);
				}
				if (($i % 5) == 0)
                {
                    echo chr(0x0);
                }
				if ($status)
				{
                    $statuscount++;
                }
			}
			if ($throttleditem->status==-10)
			{
                if ($statuscount<(count($valid['email'])*0.9))
                {
                    $database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=2 WHERE id=$throttleditem->id");
			        $database->Query();
                    return;                       
                }
            }				
		}
		else
		{
			$database->setQuery("UPDATE  #__vemod_news_mailer_log SET sent=".$database->quote($now).", status=0 WHERE id=$throttleditem->id");
			$database->Query();
		}
	}
}

function vmn_getLoggedUsers($loggedstring,$chunksize,$chunk)
{
	$valid=array();
	$bccusers=explode('<br>',rtrim($loggedstring,'<br>'));
	if (count($bccusers))
	{
		if (!$chunksize)
		{
	        	$chunk=1;
	        	$chunksize=count($bccusers);
		}

		//for ($i=0;$i<count($bccusers);$i++)
		for ($i=$chunksize*($chunk-1);$i<$chunksize*$chunk;$i++)
		{
			if ($i>=count($bccusers))
			{
                                        	break;
			}
			$separator=strpos($bccusers[$i]," / ",0);
			if ($separator !== FALSE)
			{
				$usermailaddress=substr($bccusers[$i],$separator+3,strlen($bccusers[$i])-($separator+3));
				$username=substr($bccusers[$i],0,$separator);
				if (JMailHelper::isEmailAddress($usermailaddress))
				{
					$valid['email'][]=$usermailaddress;
					$valid['name'][]=$username;
				}
			}
		}
	}
	return $valid;
}

//returns empty string if no elems in array
function vmn_safeImplode($delimiter,$stringarray)
{
    if (count($stringarray))
	{
	    return implode($delimiter,$stringarray);
	}
	return "-9999999";
}

//Get subscribers to the specified category (negative catids are sections)
function vmn_getSubscribers($catid,$customrecipients)
{
	$database = &JFactory::getDBO();
	/*
	$database->setQuery("SELECT userid FROM #__vemod_news_mailer_subs WHERE catid=$catid");
	$user_ids=$database->loadResultArray();

	$database->setQuery( "SELECT * FROM #__users WHERE id IN (" . vmn_safeImplode(",",$user_ids) . ") ORDER BY name" );
	$subscribers=$database->loadObjectList();
	for ($i=0;$i<count($subscribers);$i++)
	{
		echo ($subscribers[$i]->id);
	}
	echo "<br>";
	*/

	$database->setQuery("SELECT * FROM #__users LEFT JOIN #__vemod_news_mailer_subs ON #__users.id = #__vemod_news_mailer_subs.userid WHERE #__vemod_news_mailer_subs.catid = $catid ORDER BY #__users.name");

	$subscribers=$database->loadObjectList();
 	/*
	for ($i=0;$i<count($subscribers);$i++)
	{
		echo ($subscribers[$i]->id);
	}
	echo "<br>";
	*/
	if (is_array($customrecipients))
	{
		$customrecipients=$customrecipients[$catid];
		if (strlen($customrecipients))
		{
			$customrecipients=explode(',',$customrecipients);
			if (count($customrecipients))
			{
				foreach ($customrecipients as $customrecipient)
				{
					if ($customrecipient != '')
					{
						if (JMailHelper::isEmailAddress(trim($customrecipient)))
						{
							$extrasub= (object)array("email" => trim($customrecipient),"name" => "","id" => "Custom");
							$subscribers[]=$extrasub;
						}
					}
				}
			}
		}
	}
	return $subscribers;
}

function vmn_getSMSSubscribers($catid)
{
    $database = &JFactory::getDBO();
    $database->setQuery("SELECT DISTINCT #__users.*,#__vemod_news_mailer_users.metatags FROM #__users,#__vemod_news_mailer_users,#__vemod_news_mailer_subs WHERE #__users.id=#__vemod_news_mailer_users.id AND #__users.id=#__vemod_news_mailer_subs.userid AND #__vemod_news_mailer_subs.catid=$catid ORDER BY #__users.name");	
	$subscribers=$database->loadObjectList();
	return $subscribers;	
}

//Get all allowed categories including subcategories of allowed sections
function vmn_getCatsIds($vmncats,$vmnsecs)
{
	$database = &JFactory::getDBO();
	if (strlen($vmncats)==0) $vmncats="-9999999";
	if (strlen($vmnsecs)==0) $vmnsecs="-9999999";	
	$database->setQuery( "SELECT DISTINCT id FROM #__categories WHERE published=1 AND (id IN (" . $vmncats . ") OR section IN (" . $vmnsecs . ")) ORDER BY section, ordering" );
	return $database->loadResultArray();
}

function vmn_scanNewsCompilation($catid,$starttime,$endtime)
{
	$database = &JFactory::getDBO();
	$starttime=date('Y-m-d H:i:s',$starttime+1);
	$endtime=date('Y-m-d H:i:s',$endtime);
	if ($catid > 0)
	{
		$newitems=vmn_getNewsBetween($starttime,$endtime,$catid);
	}
	else
	{
		$secid=-$catid;
		$database->setQuery( "SELECT DISTINCT id FROM #__categories WHERE published=1 AND section=$secid ORDER BY section, ordering" );
		$catids = $database->loadResultArray();
		$catids=vmn_safeImplode(",",$catids);
		$newitems=vmn_getNewsBetween($starttime,$endtime,$catids);
	}

	return $newitems;	
}

function vmn_compileHTMLNews($news,$readmore,$cHTML)
{
	$compilebody='';
	if (count($news))
	{
		foreach ($news as $newsitem)
		{
		    $bodytext=$newsitem->fulltext;
		    $introtext=$newsitem->introtext;
		    
			$compiledHTML=stripslashes($cHTML);	
		    truncateHTML($readmore,$introtext,$bodytext,$newsitem);			
			if ($compiledHTML == "")
			{
				$compiledHTML="<table bgcolor='#EEEEEE' width='100%'><tr><td><font size='-1'><strong>[title]</strong><font color='#555555'> (by [author], published [publishdatetime])</font><br><em>[introtext]</em><br>[bodytext]</font></td></tr></table><br>";
			}
			$compiledHTML = str_replace("[title]", $newsitem->title,$compiledHTML);	
			$compiledHTML = str_replace("[introtext]", $introtext,$compiledHTML);
			$compiledHTML = str_replace("[publishdatetime]", JHTML::date($newsitem->publish_up,JTEXT::_('DATE_FORMAT_LC2')),$compiledHTML);
			$compiledHTML = str_replace("[author]", vmn_getAuthorName($newsitem),$compiledHTML);	
			$compiledHTML = str_replace("[bodytext]", $bodytext,$compiledHTML);	
			if (isset($newsitem->images))
			{
				$compiledHTML=vmn_mosImage($compiledHTML,$newsitem->images);
			}
			$compilebody .= $compiledHTML;
		}
	}
	return $compilebody;	
}

function vmn_compileTextNews($news,$readmore,$ctext)
{
	$compilebody='';
	$h2t =& new vmn_class_html2text();
		
	if (count($news))
	{
		foreach ($news as $newsitem)
		{
        	$h2t->set_html($newsitem->fulltext);
        	$h2t->set_base_url(JURI::root());
        	$bodytext = $h2t->get_text();
        	
        	$h2t->set_html($newsitem->introtext);
        	$h2t->set_base_url(JURI::root());
        	$introtext = $h2t->get_text();
		
			$compiledtext=stripslashes($ctext);
		    truncateText($readmore,$introtext,$bodytext,$newsitem);			
			if ($compiledtext == "")
			{
				$compiledtext = "[title] (by [author], published [publishdatetime])
[introtext]
[bodytext]
_______________________________________________________________

";
			}
			$h2t->set_html($newsitem->title);
			$h2t->set_base_url(JURI::root());
			$compiledtext = str_replace("[title]", $h2t->get_text(),$compiledtext);

			$compiledtext = str_replace("[introtext]", $introtext,$compiledtext);
			
			$compiledtext = str_replace("[publishdatetime]", JHTML::date($newsitem->publish_up,JTEXT::_('DATE_FORMAT_LC2')),$compiledtext);
			
			$h2t->set_html(vmn_getAuthorName($newsitem));
			$h2t->set_base_url(JURI::root());
			$compiledtext = str_replace("[author]", $h2t->get_text(),$compiledtext);
			
			$compiledtext = str_replace("[bodytext]", $bodytext,$compiledtext);		
			$compilebody .= $compiledtext;
		}
	}
	return $compilebody;																										
}

function vmn_getAuthorName($newsitem)
{
    if (strlen($newsitem->created_by_alias))
    {
        return $newsitem->created_by_alias;
    }
	$database = &JFactory::getDBO();
	$database->setQuery("SELECT name FROM #__users WHERE id=$newsitem->created_by");
	return $database->loadResult();
}

function vmn_getNewsInterval($now,$lastscan,$weekday,$timeofday,&$startnews,&$endnews)
{
	$onehour=3600;
	$oneday=$onehour*24;
	$oneweek=$oneday*7;
	//tuesday
	//$weekday=1*$oneday; //'0'=monday,'1'=tuesday......
	//$weekday='';
	if ($weekday !== '') $weekday=$weekday*$oneday;

	//13:00
	//$timeofday=18*$onehour; //'0'=00:00:00,'1'=01:00:00,'2'=02:00:00
	//$timeofday='';
	if ($timeofday !== '') $timeofday=$timeofday*$onehour;

	if ($weekday !== '')
	{
		//weekly mailings
		if ($timeofday === '') $timeofday='0';
		$monday=strtotime("Monday");
		$calcoffset = (((int)($monday/$oneweek))*$oneweek) - $monday;
		$nextbreaktime=((int)ceil((strtotime($lastscan)+$calcoffset+1-$weekday-$timeofday)/$oneweek)*$oneweek)-$calcoffset+$weekday+$timeofday;	
		$weekcount=1;
		while (strtotime($now)-$nextbreaktime > $oneweek)
		{
                	$nextbreaktime=$nextbreaktime+$oneweek;
                	$weekcount++;
		}
		//echo date( 'Y-m-d H:i:s',$nextbreaktime ) . "<br>";		
		if (strtotime($now) >= $nextbreaktime)
		{
			if (strtotime($lastscan) < $nextbreaktime)
			{
				$startnews=$nextbreaktime-($oneweek*$weekcount);
				$endnews=$nextbreaktime;
				return TRUE;
			}
		}
	}
	else if ($timeofday !== '')
	{
		//daily mailings
		$midnight=strtotime("00:00:00");
		$calcoffset = (((int)($midnight/$oneday))*$oneday) - $midnight;
		$nextbreaktime=((int)ceil((strtotime($lastscan)+$calcoffset+1-$timeofday)/$oneday)*$oneday)-$calcoffset+$timeofday;
		$daycount=1;
		while (strtotime($now)-$nextbreaktime > $oneday)
		{
                	$nextbreaktime=$nextbreaktime+$oneday;
                	$daycount++;
		}
		//echo date( 'Y-m-d H:i:s',$nextbreaktime ) . "<br>";
		if (strtotime($now) >= $nextbreaktime)
		{
			if (strtotime($lastscan) < $nextbreaktime)
			{
				$startnews=$nextbreaktime-($oneday*$daycount);
				$endnews=$nextbreaktime;
				return TRUE;
			}
		}
	}
	else
	{
		//always
		//echo " always";
		$startnews=strtotime($lastscan)-1;
		$endnews=strtotime($now);
		return TRUE;
	}
	return FALSE;
}

function vmn_getNewsBetween($start,$end,$cats)
{
	$database = &JFactory::getDBO();
	$database->setQuery("SELECT DISTINCT * FROM #__content
	WHERE state=1
	AND catid IN (".$cats.")
	AND
	(
		(
			(
				created > publish_up
			)
			AND
			(
				created >= '".$start."' AND created <= '".$end."'
			)
		)
		OR
		(
			publish_up >= '".$start."' AND publish_up <= '".$end."'
		)
	)
	ORDER BY publish_up");
	return $database->loadObjectList();
}
//get all items from allowed categories and sections published after lastscan
function vmn_getNewItems($lastscan,&$newscount,$vmncats,$vmnsecs,$now)
{
	$database = &JFactory::getDBO();
	$cats=vmn_getCatsIds($vmncats,$vmnsecs);

	$database->setQuery("SELECT COUNT(*) FROM #__content WHERE state=1 AND catid IN (" . vmn_safeImplode(",",$cats) . ")");
	$newscount=$database->loadResult();
	$newitems=vmn_getNewsBetween(date('Y-m-d H:i:s',strtotime($lastscan)-1),$now,vmn_safeImplode(",",$cats));
	return $newitems;
}

//Get allowed sections
function vmn_getSecs($vmnsecs)
{
	$database = &JFactory::getDBO();
	if (strlen($vmnsecs)==0) $vmnsecs="-9999999";		
	$database->setQuery( "SELECT DISTINCT * FROM #__sections WHERE published=1 AND id IN (" . $vmnsecs . ") ORDER BY ordering" );
	return $database->loadObjectList();
}

//Get allowed categories (subcategories of allowed sections are excluded)
function vmn_getCatsExclSecs($vmncats,$vmnsecs)
{
	$database = &JFactory::getDBO();
	if (strlen($vmncats)==0) $vmncats="-9999999";
	if (strlen($vmnsecs)==0) $vmnsecs="-9999999";		
	$database->setQuery( "SELECT DISTINCT * FROM #__categories WHERE published=1 AND id IN (" . $vmncats . ") AND section NOT IN (" . $vmnsecs . ") ORDER BY section, ordering" );
	return $database->loadObjectList();
}

//Get title of category or section
function vmn_getCatTitle($catid)
{
	$database = &JFactory::getDBO();
	if ($catid > 0)
	{
		$database->setQuery("SELECT title FROM #__categories WHERE id=$catid AND published=1");
		return $database->loadResult();							
	}
	else
	{
		$secid=-($catid);
		$database->setQuery("SELECT title FROM #__sections WHERE id=$secid AND published=1");
		return $database->loadResult();							
	}	
}

//Update my subscriptions database entries
function vmn_updateSubs($userid,$cats)
{
    $database = &JFactory::getDBO();
	$database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid=$userid");
	$database->query();
	if (is_array($cats))
	{
    	if (count($cats))
    	{
    		foreach ($cats as $cat)
    		{
    		    if ($cat != '')
    		    {
    	    	    $database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($userid,$cat)");
    			    $database->query();
    			}
    		}
    	}
    }
}

//Update the lastscan time in db
function vmn_setNow(&$lastscan,$now,$send)
{
	$database = &JFactory::getDBO();
	if ($lastscan==$database->getNullDate())
	{
	   /*`
		$database->setQuery("TRUNCATE TABLE #__vemod_news_mailer_scantime");
		$database->query();	    	
		$database->setQuery("INSERT INTO #__vemod_news_mailer_scantime (scantime) VALUES (" . $database->Quote($now). ")");
		$database->query();
		$lastscan=$now;
        */
        $database->setQuery("UPDATE #__vemod_news_mailer_scantime SET scantime=" . $database->Quote($now) . " LIMIT 1");
		$database->query();		
	}
	elseif ($send)
	{
		$database->setQuery("UPDATE #__vemod_news_mailer_scantime SET scantime=" . $database->Quote($now) . " LIMIT 1");
		$database->query();		
	}
}

//make an even/odd row in a table (remember to put </tr> after your code)
function vmn_doCountingTableRow(&$evencount)
{
	$evenodd = $evencount % 2;
	if ($evenodd == 0) {
		$usrl_class = "sectiontableentry1";
	} else {
		$usrl_class = "sectiontableentry2";
	}
   	$evencount++;
    echo "\t<tr width=\"100%\" class=\"$usrl_class\">\n";
}

function vmn_doTableRow()
{
	echo "<tr>";
}

function vmn_doEndTableRow()
{
	echo "</tr>";
}

function doTextPreview($readmore,$sidebarmodules,$unsubscribealltext)
{
    global $mainframe;
    $my=&JFactory::getUser();
    return "<a id=\"previewtext\" href=\"javascript:displayText(document.getElementById('previewtextwindow').value,'".JURI::root()."','".addslashes(JTEXT::_('VMN_PREVIEW'))."','','','".addslashes($mainframe->getCfg('sitename'))."','".addslashes($readmore['text'])."','".$readmore['use']."','".$readmore['truncate']."','".addslashes($sidebarmodules[0]['title'])."','".addslashes($sidebarmodules[1]['title'])."','".addslashes($sidebarmodules[2]['title'])."','".addslashes($sidebarmodules[3]['title'])."','".addslashes($sidebarmodules[4]['title'])."','".addslashes($sidebarmodules[5]['title'])."','".addslashes(JTEXT::_('VMN_CLOSE'))."','".addslashes($my->name)."','".addslashes($unsubscribealltext)."','','');\" title=\"".JTEXT::_('VMN_PREVIEW')."\">";
}

function doHTMLPreview($readmore,$sidebarmodules,$unsubscribealltext)
{
    global $mainframe;
    $my=&JFactory::getUser();
    return "<a id=\"previewHTML\" href=\"javascript:displayHTML(document.getElementById('previewHTMLwindow').value,'".JURI::root()."','".addslashes(JTEXT::_('VMN_PREVIEW'))."','','','".addslashes($mainframe->getCfg('sitename'))."','".addslashes($readmore['text'])."','".$readmore['use']."','".$readmore['truncate']."','".addslashes($sidebarmodules[0]['title'])."','".addslashes($sidebarmodules[1]['title'])."','".addslashes($sidebarmodules[2]['title'])."','".addslashes($sidebarmodules[3]['title'])."','".addslashes($sidebarmodules[4]['title'])."','".addslashes($sidebarmodules[5]['title'])."','".addslashes(JTEXT::_('VMN_CLOSE'))."','".addslashes($my->name)."','".addslashes($unsubscribealltext)."','','');\" title=\"".JTEXT::_('VMN_PREVIEW')."\">";
}

function vmn_doLogTableRow(&$evencount,$logitem,$success,$failure,$throttlesize)
{
    if (strpos($logitem->message,'<pre>')===0)
    {
        $messageformat='Text';
        $formatpic='<img src="components/com_vemod_news_mailer/text.gif"/>';
    }
    elseif (strpos($logitem->message,'<sms></sms>')===0)
    {
        $messageformat='SMS';
        $formatpic='<img src="components/com_vemod_news_mailer/sms.gif"/>';
    }
    else
    {
        $messageformat='HTML';
        $formatpic='<img src="components/com_vemod_news_mailer/html.gif"/>';
    }
    
	if ($logitem->status==0)
	{
	    $userlist=$logitem->users;
	    $statustext=JTEXT::_('VMN_SUCCESS');
        $statusimage='<img src="components/com_vemod_news_mailer/email.gif" alt="'. JTEXT::_('VMN_SUCCESS').'"/>';
	}
	else if (($logitem->status==1) || ($logitem->status==2))
	{
	    $userlist=$logitem->users;
	    $statustext=JTEXT::_('VMN_FAILURE');
	    $statusimage='<img src="components/com_vemod_news_mailer/warning.gif" alt="'. JTEXT::_('VMN_FAILURE').'" />';    
	}
	else
	{
		$userlist='';
		$logusers=explode("<br>",$logitem->users);
		$progress=abs($logitem->status)-10;
        $statustext=str_repeat("-",$progress).'&gt;';		
		$statusimage='<img src="components/com_vemod_news_mailer/progress.gif" alt="<?php echo $statustext; >" />';
		for ($i=0;$i<$throttlesize*$progress;$i++)
		{
			if ($i>=count($logusers))
			{
                            	break;
			}
			$userlist.= $logusers[$i]."<br>";
		}
		$userlist.= '<font color="#555555">';
		for ($i=$throttlesize*$progress;$i<count($logusers);$i++)
		{
			$userlist.= $logusers[$i]."<br>";
		}
		$userlist.= '</font>';	
	}
	$evenodd = $evencount % 2;
	if ($evenodd == 0) {
		$usrl_class = "sectiontableentry1";
	} else {
		$usrl_class = "sectiontableentry2";
	}
    ?>
    <tr class="sectiontableheader"><td>
    <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="24">
    <input type="checkbox" id="cb<?php echo $logitem->id;?>" name="cid[]" value="<?php echo $logitem->id; ?>" />
    </td>
    <td width="20">
    <a href="javascript:displayNewsletter(document.getElementById('logitem<?php echo $logitem->id; ?>').innerHTML,'<?php echo addslashes($logitem->subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');">
    <img src="components/com_vemod_news_mailer/view.gif" border="0" alt="<?php echo JTEXT::_('SHOW'); ?>"/>
    </a>
    </td>
    <td>
    <a href="javascript:displayNewsletter(document.getElementById('logitem<?php echo $logitem->id; ?>').innerHTML,'<?php echo addslashes($logitem->subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');" title="<?php echo JTEXT::_('SHOW'); ?>">
    <?php echo $logitem->subject; ?>
    </a>    
    </td>
    <td><div align="right" style="float:right;">
    <?php echo $statustext; ?>
    </div></td><td width="25"><div align="center"><center>
    <?php echo $statusimage; ?>
    </center></div></td>    
    </tr></table>
    </td><td width="33%">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td>

        <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
        <td width="99%">&nbsp;
        <?php echo JHTML::date($logitem->sent,JTEXT::_('DATE_FORMAT_LC')).' '.JHTML::date($logitem->sent,'%H:%M:%S'); ?>
        </td>
        <td><div align="right" style="float:right;">
        <?php echo $messageformat; ?>
        </div></td>
        <td width="25"><div align="center"><center>
        <?php echo $formatpic; ?>
        </center></div>
        </td></tr></table>
    
    </td></tr></table>       
    </td></tr>
    
    <?php 	
    vmn_doCountingTableRow($evencount);
		?>
  		<td valign="top" style="border: 1px solid #AAAAAA;"><div style="height:250px;overflow:auto;"><div align="left" valign="top" style="zoom:50%;" id="logitem<?php echo $logitem->id; ?>"><?php echo $logitem->message; ?></div></div></td>  		
       	<td valign="top" width="33%" style="border-top:1px solid #AAAAAA;border-right:1px solid #AAAAAA;border-bottom:1px solid #AAAAAA;"><div style="height:240px;overflow:auto;padding:5px;"><?php echo $userlist; ?></div></td>
	</tr>
	<tr class="<?php echo $usrl_class; ?>"><td>&nbsp;</td><td>&nbsp;</td></tr>
	<?php
}

function vmn_doArchiveRow(&$evencount,$archiveitem,$archiveitemtext)
{
    $displaytext=$archiveitemtext;
    if (!strlen($displaytext))
    {
        $displaytext=$archiveitem->subject;
    }
    $senddate=JHTML::date($archiveitem->sent,JTEXT::_('DATE_FORMAT_LC'));
    $sendtime=JHTML::date($archiveitem->sent,'%H:%M:%S');
    $logusers=explode("<br>",$archiveitem->users);
    $usercount=count($logusers);
    $sendformat='HTML';
    if (strpos($archiveitem->message,'<pre>')===0)
    {
        $sendformat='Text';
    }
    $search=array('[subject]','[senddate]','[sendtime]','[usercount]','[mailformat]');
    $replace=array($archiveitem->subject,$senddate,$sendtime,$usercount,$sendformat);    
    $displaytext=str_replace($search,$replace,$displaytext);
	vmn_doCountingTableRow($evencount);
		?>
       		<td width="30" align="center">
       		<?php echo $evencount; ?>       		
       		</td>
       		<td width="30" align="center">
       		<a href="javascript:displayNewsletter(document.getElementById('archiveitem<?php echo $archiveitem->id; ?>').innerHTML,'<?php 
                echo addslashes($archiveitem->subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');"><img src="components/com_vemod_news_mailer/view.gif" border="0" alt="<?php echo JTEXT::_('SHOW'); ?>"/></a>       		
       		</td>       		
       		<td>
            <a href="javascript:displayNewsletter(document.getElementById('archiveitem<?php echo $archiveitem->id; ?>').innerHTML,'<?php 
                echo addslashes($archiveitem->subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');" title="<?php echo JTEXT::_('SHOW'); ?>"><?php echo $displaytext; ?></a>
  		    <div id="archiveitem<?php echo $archiveitem->id; ?>" style="display:none;"><?php echo $archiveitem->message; ?></div></td>
	</tr>
	<?php
}

function vmn_doPreviewtableRow(&$evencount,$subject,$message,$publish_up,$sentusers)
{
    if (strpos($message,'<pre>')===0)
    {
        $messageformat='Text';
        $formatpic='<img src="components/com_vemod_news_mailer/text.gif"/>';
    }
    elseif (strpos($message,'<sms></sms>')===0)
    {
        $messageformat='SMS';
        $formatpic='<img src="components/com_vemod_news_mailer/sms.gif"/>';
    }
    else
    {
        $messageformat='HTML';
        $formatpic='<img src="components/com_vemod_news_mailer/html.gif"/>';
    }

	$evenodd = $evencount % 2;
	if ($evenodd == 0) {
		$usrl_class = "sectiontableentry1";
	} else {
		$usrl_class = "sectiontableentry2";
	}
    vmn_doCountingTableRow($evencount);
		?>
		<tr class="sectiontableheader">
        <td>
        <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
        <td width="5">
        &nbsp;
        </td>
        <td width="20">
        <a href="javascript:displayNewsletter(document.getElementById('previewitem<?php echo $evencount; ?>').innerHTML,'<?php echo addslashes($subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');">
        <img src="components/com_vemod_news_mailer/view.gif" border="0" alt="<?php echo JTEXT::_('VMN_PREVIEW'); ?>"/>
        </a>
        </td>		
        <td width="99%">
        <a href="javascript:displayNewsletter(document.getElementById('previewitem<?php echo $evencount; ?>').innerHTML,'<?php echo addslashes($subject); ?>','<?php echo addslashes(JTEXT::_('VMN_CLOSE')); ?>');" title="<?php echo JTEXT::_('VMN_PREVIEW'); ?>">
        <?php echo $subject; ?>
        </a>
        </td></tr></table>
        </td>
        <td width="33%">
        
        <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
        <td width="99%">&nbsp;
        <?php echo $publish_up; ?>
        </td>
        <td><div align="right" style="float:right;">
        <?php echo $messageformat; ?>
        </div></td>
        <td width="25"><div align="center"><center>
        <?php echo $formatpic; ?>
        </center></div></td></tr></table>

        </td>
        </tr>
            <tr class="<?php echo $usrl_class; ?>">
            <td valign="top" style="border:1px solid #AAAAAA;"><div style="height:250px;overflow:auto;"><div align="left" valign="top" style="zoom:50%;" id="previewitem<?php echo $evencount; ?>"><?php echo $message; ?></div></div></td>
            <td valign="top" width="33%" style="border-top:1px solid #AAAAAA;border-right:1px solid #AAAAAA;border-bottom:1px solid #AAAAAA;"><div style="height:240px;overflow:auto;padding:5px;"><?php echo $sentusers; ?></div></td>			
	</tr>
	<tr class="<?php echo $usrl_class; ?>"><td>&nbsp;</td><td>&nbsp;</td></tr>    	   
	<?php
}

//Make a button with text and link (only if userlevel is above specified)
function vmn_doButton($caption,$userlevel,$redirect,$disabled,$name="subscribe",$confirm='')
{
	if (vmn_userAccess($userlevel))
	{
		if ($redirect == '')
		{
			?>
		  	<td align="center"><div align="center"><center><input <?php if ($disabled) echo 'disabled="disabled"'; ?> type="submit" class="button" name="<?php echo $name; ?>" value="<?php echo $caption; ?>" <?php if (strlen($confirm)) echo 'onclick="if(confirm(\''.$confirm.' ?\')) {document.userForm.submit();}else{return false;};"'; ?>></center></div></td>
			<?php		
		}
		else
		{
			?>
		  	<td align="center"><div align="center"><center><input <?php if ($disabled) echo 'disabled="disabled"'; ?> type="button" class="button" value="<?php echo $caption; ?>" onclick="window.location.href='<?php echo $redirect; ?>'"></center></div></td>
			<?php
		}
	}
}

function vmn_doForm($redirect)
{
	?>
		<form method="post" action="<?php echo $redirect; ?>" name="userForm">
	<?php
}

function vmn_doEndForm()
{
	?>
	</form>
	<?php
}

//make the page top caption
function vmn_doPageTop($caption)
{
	?>
    <span class="contentheading"><?php echo $caption; ?></span>
	<?php
}

//make a table header (remember to put </table> after your code)
function vmn_doTableHeader($caption)
{
		?>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr class="sectiontableheader">
				<?php
				for ($i=0;$i < count($caption);$i++)
				{
					?>
					<td class="sectionname"><?php echo $caption[$i]; ?></td>
					<?php
				}
				?>
			</tr>
	    <?php	
}

function vmn_doTable()
{
	echo '<table cellpadding="4" cellspacing="0" border="0" width="100%" >';	
}

function vmn_doEndTable()
{
	echo "</table>";
}

/*
//make a full manage subscibers row
function vmn_doManageSubsRow(&$evencount,$subscribers,$cattitle,$catid,$mailformat,$textusers)
{
	$usercounter=0;
	vmn_doCountingTableRow($evencount);
		?>
   		<td valign="top"><?php echo $cattitle;?></td>
       	<td valign="top">
			<?php 
			if (count($subscribers))
			{
				foreach ($subscribers as $subscriber)
				{
				    $usercounter++;
					echo $usercounter;
					if ($subscriber->id !='Custom')
					{
				    ?>
					<input type="checkbox" id="cb<?php echo $usercounter;?>" name="cid[]" value="<?php echo $subscriber->id . "," . $catid; ?>">								
					<?php
					}
					else
					{
						echo " ";
					}
					if ($mailformat==2)
					{
						if (in_array($subscriber->id,$textusers))
						{
							echo "Text ";
						}
						else
						{
							echo "HTML ";						
						}
					}					
				    echo "<strong>$subscriber->name</strong> $subscriber->email<br>";
				}
			}		
			?>	
		</td>
	</tr>
	<?php
}
*/

//make a full my subscriptions row
/*
function vmn_doMySubscriptionsRow(&$evencount,$title,$id,$i,$checked,$description,$checkedsms)
{
	vmn_doCountingTableRow($evencount);
		?>
		<td width="30" align="center"><?php echo $i+1;?></td>
		<td width="30"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $id; ?>" <?php 
		if (count($checked))
		{	
			echo in_array($id,$checked) ? 'checked':''; 
		}
		?>></td>
		<td><?php echo $title; ?></td>
		<td><?php echo $description; ?></td>		
		<td width="20%"><?php 
		if (count($checkedsms))
		{	
			echo in_array($id,$checkedsms) ? '<img src="components/com_vemod_news_mailer/sms.gif" />':'&nbsp;'; 
		}        
        ?></td>				
	</tr>
	<?php
}
*/
function vmn_doMySubscriptionsRow(&$evencount,$title,$id,$i,$checked,$description,$checkedsms,$showcount=true)
{
        echo '<table width="100%" cellspacing="0">';    
		vmn_doCountingTableRow($evencount);
		  if ($showcount)
		  {
		    echo '<td width="30" align="center">'.($i+1).'</td>';
		  }
            echo '<td width="30"><input type="checkbox" id="cb'.$i.'" name="cid[]" value="'.$id.'"'; 
	        if (count($checked))
    		{	
    			echo in_array($id,$checked) ? 'checked':''; 
    		}
    		echo '></td>';                                

		?>
		
		<td width="49%"><?php echo $title; ?></td>
		<td width="49%"><?php echo $description; ?></td>		
		<td width="20"><?php 
    		if (count($checkedsms))
    		{	
    			echo in_array($id,$checkedsms) ? '<img src="components/com_vemod_news_mailer/sms.gif" />':'&nbsp;'; 
    		}
       
        echo'</td></tr></table>';				
}

function vmn_doFooter()
{
	# STOP! REMOVAL OF THE FOOTER IS NOT ALLOWED.
	# REMEMBER I PUT A LOT AF HARD WORK INTO THIS AND REMOVAL OF THE FOOTER IS STEALING!
	# YOU CAN HOWEVER EASE YOUR MIND HERE: http://www.shareit.com/product.html?productid=300182359
	?>
	<br>
	<br>	
	<table cellpadding="0" cellspacing="0" border="0" width="100%" >
		<tr> 
	    	<td align="center"><div align="center"><center><font size="1">Vemod News Mailer 
        1.2.7</font></center></div></td>
		</tr>
		<tr> 
    		<td align="center"><div align="center"><center><font size="1">&copy; 2008, <a target=_blank href="http://www.musiker.nu/objectstudio/newsmailer/">Veinge
        musik och data</a>. All rights reserved</font></center></div></td>
		</tr>	
	</table>
	<?php
}

function vmn_userAccess($userlevel)
{
	$my=&JFactory::getUser();
	$database = &JFactory::getDBO();
	if ($userlevel=='0')
	{
		return TRUE;
	}
	$database->setQuery("SELECT name FROM #__core_acl_aro_groups");
	$accesslevels=$database->loadResultArray();
	$SAKey=array_search('Super Administrator',$accesslevels);
	if ($SAKey===FALSE)
	{
		return FALSE;
	}
	$database->setQuery("SELECT name FROM #__core_acl_aro_groups WHERE id = $userlevel");
	$accessname=$database->loadResult();
	$accessKey=array_search($accessname,$accesslevels);
	if ($accessKey===FALSE)
	{
		return FALSE;
	}
	$myKey=array_search($my->usertype,$accesslevels);
	if ($myKey===FALSE)
	{
		return FALSE;
	}
	if ($myKey >= $accessKey)
	{
		if ($myKey <= $SAKey)
		{
			return TRUE;
		}
	}
	return FALSE;
}


//Reads the title of a module
function vmn_getModuleArray($modulename,$moduleid)
{
	$database = &JFactory::getDBO();
	$module=array('name'=>$modulename,'id'=>$moduleid,'title'=>'');
	if (strlen($module['name']))
	{
		if ((isset($module['id'])) && ($module['id']!==''))
		{
	    		$database->setQuery("SELECT title FROM #__modules WHERE module = '" . $module['name'] . "' AND id=".$module['id']." AND published = 1");
		}
		else
		{
	    		$database->setQuery("SELECT title FROM #__modules WHERE module = '" . $module['name'] . "' AND published = 1");
		}
		$module['title']=$database->loadResult();
	}
	return $module;
}

//Reads the content of a module
function vmn_getModuleContent($moduleitem,$checknews)
{
		global $mainframe;
		$my=&JFactory::getUser();
		$database = &JFactory::getDBO();
		if ($checknews)
		{
		    	if (file_exists(JPATH_SITE."/modules/" . $moduleitem['name'] . "/" . $moduleitem['name'] . ".php"))
			{
				if ((isset($moduleitem['id'])) && ($moduleitem['id']!==''))
				{
					$database->setQuery("SELECT params FROM #__modules WHERE module = '" . $moduleitem['name'] . "' AND id=".$moduleitem['id']." AND published = 1");
				}
				else
				{
					$database->setQuery("SELECT params FROM #__modules WHERE module = '" . $moduleitem['name'] . "' AND published = 1");
				}
				$module=NULL;
				$module=$database->loadObject();
				$moduleparams=$module->params;				
				$tempgid=$my->gid;
				$temptype=$my->usertype;
				$my->gid=18;
				$my->usertype='Registered';
		
				$params = new JParameter( $moduleparams );
				$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
		    	    	ob_start();
	       		 	include(JPATH_SITE."/modules/" . $moduleitem['name'] . "/" . $moduleitem['name'] . ".php");
		      		$obcontents = ob_get_contents();
		      		if (!strlen($obcontents) && isset($content))
		      		{
                        $obcontents=$content;  
                    }		      		
				ob_end_clean();

				$my->gid=$tempgid;
				$my->usertype=$temptype;
			}
		}
		else
		{
			$obcontents="contents of " . $moduleitem['name'] . " will be placed here";
		}
		return $obcontents;
}

function vmn_truncate($text, $length, $ending = '...', $exact = false)
{
	if(strlen(preg_replace('/<.*?>/', '', $text)) <= $length)
	{
		return $text;
	}

	preg_match_all('/(<.+?>)?([^<>]*)/is', $text, $ausgabe, PREG_SET_ORDER);

	$total_length = 0;
	$arr_elements = array();
	$truncate = '';

	foreach($ausgabe as $treffer)
	{
		if(!empty($treffer[1]))
		{
			//<img />
			if(preg_match('/^<\s*.+?\/\s*>$/s', $treffer[1]))
			{
				//echo '1:'.htmlspecialchars($treffer[1]).'<br>';
				//</b>
			}
			else if(preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $treffer[1], $treffer2))
			{
				//echo '2:'.htmlspecialchars($treffer2[1]).'<br>';
				$pos = array_search($treffer2[1], $arr_elements);
				if($pos !== false)
				{
					unset($arr_elements[$pos]);
				}
				//<b>
			}
			else if(preg_match('/^<\s*([^\s>!]+).*?>$/s', $treffer[1], $treffer2))
			{
				array_unshift($arr_elements, strtolower($treffer2[1]));
				//echo '3:'.htmlspecialchars($treffer2[1]).'<br>';
			}
			$truncate .= $treffer[1];
		}
		$content_length = strlen(preg_replace('/(&[a-z]{1,6};|&#[0-9]+;)/i', ' ', $treffer[2]));
		if($total_length >= $length)
		{
			break;
		}
		else if($total_length+$content_length > $length)
		{
			$left = $total_length>$length?$total_length-$length:$length-$total_length;
			$entities_length = 0;
			if(preg_match_all('/&[a-z]{1,6};|&#[0-9]+;/i', $treffer[2], $treffer3, PREG_OFFSET_CAPTURE))
			{
				foreach($treffer3[0] as $entity)
				{
					if($entity[1]+1-$entities_length <= $left)
					{
						$left--;
						$entities_length += strlen($entity[0]);
					}
					else
					{
						break;
					}
				}
			}
			$truncate .= substr($treffer[2], 0, $left+$entities_length);
			break;
		}
		else
		{
			$truncate .= $treffer[2];
			$total_length += $content_length;
		}
	}
	//var_dump($ausgabe);
	if(!$exact)
	{
		$spacepos = strrpos($truncate, ' ');
		if(isset($spacepos))
		{
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	$truncate .= $ending;
	foreach($arr_elements as $element)
	{
		$truncate .= '</' . $element . '>';
	}
	return $truncate;
}

class vmn_class_html2text
{
    var $html;
    var $text;
    var $width = 90;
    var $search = array(
	"/&aring;/i","/&auml;/i","/&ouml;/i","/&Aring;/i","/&Auml;/i","/&Ouml;/i",
    	"/&hellip;/i",
        "/\r/",                                  // Non-legal carriage return
        "/[\n\t]+/",                             // Newlines and tabs
        '/[ ]{2,}/',                             // Runs of spaces, pre-handling
        '/<script[^>]*>.*?<\/script>/i',         // <script>s -- which strip_tags supposedly has problems with
        '/<style[^>]*>.*?<\/style>/i',           // <style>s -- which strip_tags supposedly has problems with
        //'/<!-- .* -->/',                         // Comments -- which strip_tags might have problem a with
        '/<h[123][^>]*>(.*?)<\/h[123]>/ie',      // H1 - H3
        '/<h[456][^>]*>(.*?)<\/h[456]>/ie',      // H4 - H6
        '/<p[^>]*>/i',                           // <P>
        '/<br[^>]*>/i',                          // <br>
        '/<b[^>]*>(.*?)<\/b>/ie',                // <b>
        '/<strong[^>]*>(.*?)<\/strong>/ie',      // <strong>
        '/<i[^>]*>(.*?)<\/i>/i',                 // <i>
        '/<em[^>]*>(.*?)<\/em>/i',               // <em>
        '/(<ul[^>]*>|<\/ul>)/i',                 // <ul> and </ul>
        '/(<ol[^>]*>|<\/ol>)/i',                 // <ol> and </ol>
        '/<li[^>]*>(.*?)<\/li>/i',               // <li> and </li>
        '/<li[^>]*>/i',                          // <li>
        '/<a [^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/ie',
                                                 // <a href="">
        '/<hr[^>]*>/i',                          // <hr>
        '/(<table[^>]*>|<\/table>)/i',           // <table> and </table>
        '/(<tr[^>]*>|<\/tr>)/i',                 // <tr> and </tr>
        '/<td[^>]*>(.*?)<\/td>/i',               // <td> and </td>
        '/<th[^>]*>(.*?)<\/th>/ie',              // <th> and </th>
        '/&(nbsp|#160);/i',                      // Non-breaking space
        '/&(quot|rdquo|ldquo|#8220|#8221|#147|#148);/i',
                                                 // Double quotes
        '/&(apos|rsquo|lsquo|#8216|#8217);/i',   // Single quotes
//        '/&gt;/i',                               // Greater-than
//        '/&lt;/i',                               // Less-than
        '/&(amp|#38);/i',                        // Ampersand
        '/&(copy|#169);/i',                      // Copyright
        '/&(trade|#8482|#153);/i',               // Trademark
        '/&(reg|#174);/i',                       // Registered
        '/&(mdash|#151|#8212);/i',               // mdash
        '/&(ndash|minus|#8211|#8722);/i',        // ndash
        '/&(bull|#149|#8226);/i',                // Bullet
        '/&(pound|#163);/i',                     // Pound sign
        '/&(euro|#8364);/i',                     // Euro sign
        '/&[^&;]+;/i',                           // Unknown/unhandled entities
        '/[ ]{2,}/'                              // Runs of spaces, post-handling
    );
    var $replace = array(
	'å','ä','ö','Å','Ä','Ö',
    	'...',
        '',                                     // Non-legal carriage return
        ' ',                                    // Newlines and tabs
        ' ',                                    // Runs of spaces, pre-handling
        '',                                     // <script>s -- which strip_tags supposedly has problems with
        '',                                     // <style>s -- which strip_tags supposedly has problems with
        //'',                                     // Comments -- which strip_tags might have problem a with
        "strtoupper(\"\n\n\\1\n\n\")",          // H1 - H3
        "ucwords(\"\n\n\\1\n\n\")",             // H4 - H6
        "\n\n\t",                               // <P>
        "\n",                                   // <br>
        'strtoupper("\\1")',                    // <b>
        'strtoupper("\\1")',                    // <strong>
        '_\\1_',                                // <i>
        '_\\1_',                                // <em>
        "\n\n",                                 // <ul> and </ul>
        "\n\n",                                 // <ol> and </ol>
        "\t* \\1\n",                            // <li> and </li>
        "\n\t* ",                               // <li>
	//'$this->_build_link_list("\\1", "\\2")',
	'$this->_build_link("\\1", "\\2")',
                                                // <a href="">
        "\n-------------------------\n",        // <hr>
        "\n\n",                                 // <table> and </table>
        "\n",                                   // <tr> and </tr>
        "\t\t\\1\n",                            // <td> and </td>
        "strtoupper(\"\t\t\\1\n\")",            // <th> and </th>
        ' ',                                    // Non-breaking space
        '"',                                    // Double quotes
        "'",                                    // Single quotes
//        '>',
//        '<',
        '&',
        '(c)',
        '(tm)',
        '(R)',
        '--',
        '-',
        '*',
        '£',
        'EUR',                                  // Euro sign. € ?
        '',                                     // Unknown/unhandled entities
        ' '                                     // Runs of spaces, post-handling
    );
    var $allowed_tags = '';
    var $url;
    var $_converted = false;
    var $_link_list = '';
    var $_link_count = 0;
    function html2text( $source = '', $from_file = false )
    {
        if ( !empty($source) ) {
            $this->set_html($source, $from_file);
        }
        $this->set_base_url();
    }
    function set_html( $source, $from_file = false )
    {
        $this->html = $source;

        if ( $from_file && file_exists($source) ) {
            $fp = fopen($source, 'r');
            $this->html = fread($fp, filesize($source));
            fclose($fp);
        }

        $this->_converted = false;
    }
    function get_text()
    {
        if ( !$this->_converted ) {
            $this->_convert();
        }

        return $this->text;
    }
    function set_allowed_tags( $allowed_tags = '' )
    {
        if ( !empty($allowed_tags) ) {
            $this->allowed_tags = $allowed_tags;
        }
    }
    function set_base_url( $url = '' )
    {
        if ( empty($url) ) {
            if ( !empty($_SERVER['HTTP_HOST']) ) {
                $this->url = 'http://' . $_SERVER['HTTP_HOST'];
            } else {
                $this->url = '';
            }
        } else {
            // Strip any trailing slashes for consistency (relative
            // URLs may already start with a slash like "/file.html")
            if ( substr($url, -1) == '/' ) {
                $url = substr($url, 0, -1);
            }
            $this->url = $url;
        }
    }
    function _convert()
    {
        // Variables used for building the link list
        $this->_link_count = 0;
        $this->_link_list = '';

        $text = trim(stripslashes($this->html));

        // Run our defined search-and-replace
        $text = preg_replace($this->search, $this->replace, $text);

        // Strip any other HTML tags
        $text = strip_tags($text, $this->allowed_tags);
       
        $text=str_replace('&lt;','<',$text);
        $text=str_replace('&gt;','>',$text);        
       
        // Bring down number of empty lines to 2 max
        $text = preg_replace("/\n\s+\n/", "\n\n", $text);
        $text = preg_replace("/[\n]{3,}/", "\n\n", $text);

        // Add link list
        if ( !empty($this->_link_list) ) {
            $text .= "\n\n" . $this->_link_list;
        }

        // Wrap the text to a readable format
        // for PHP versions >= 4.0.2. Default width is 75
        // If width is 0 or less, don't wrap the text.
        if ( $this->width > 0 ) {
            $text = wordwrap($text, $this->width);
        }

        $this->text = $text;

        $this->_converted = true;
    }

    function _build_link_list( $link, $display )
    {
        if ( substr($link, 0, 7) == 'http://' || substr($link, 0, 8) == 'https://' ||
             substr($link, 0, 7) == 'mailto:' ) {
            $this->_link_count++;
            $this->_link_list .= "[" . $this->_link_count . "] $link\n";
            $additional = ' [' . $this->_link_count . ']';
        } elseif ( substr($link, 0, 11) == 'javascript:' ) {
            // Don't count the link; ignore it
            $additional = '';
        // what about href="#anchor" ?
        } else {
            $this->_link_count++;
            $this->_link_list .= "[" . $this->_link_count . "] " . $this->url;
            if ( substr($link, 0, 1) != '/' ) {
                $this->_link_list .= '/';
            }
            $this->_link_list .= "$link\n";
            $additional = ' [' . $this->_link_count . ']';
        }

        return $display . $additional;
    }

    function _build_link( $link, $display )
    {
    	$linkurl ='';
        if ( substr($link, 0, 7) == 'http://' || substr($link, 0, 8) == 'https://' ||
             substr($link, 0, 7) == 'mailto:' )
	{
            $linkurl = $link;
        }
	 elseif (substr($link, 0, 11) == 'javascript:' )
	 {
            // Don't count the link; ignore it
        // what about href="#anchor" ?
        }
	else
	{
            $linkurl = $this->url;
            if ( substr($link, 0, 1) != '/' )
	    {
                $linkurl .= '/';
            }
            $linkurl .= "$link";
        }

        return $display ." ". $linkurl;
    }
}

function vmn_wordwrap($text, $size = 100)
{
    $new_text = '';
    $text_1 = explode('>',$text);
    $sizeof = sizeof($text_1);
    if ($sizeof<2) // no tags
    {
    	return wordwrap($text,$size);
    }
    $nested=0;
    for ($i=0; $i<$sizeof; ++$i) 
    {
        $text_2 = explode('<',$text_1[$i]);
        $sizeof_2=sizeof($text_2);
    	if ($sizeof_2==1) // no tags here so it must be the end of a nested tag or some text or whitespace at the end of the document
    	{
    		$new_text .= $text_2[0];
    		if ($i!=$sizeof-1) // if it is not the last line of the document it must be an end-of-tag
    	    {
    		   	$nested--;
                $new_text .= '>';
    	    }
     	}
    	else
    	{
    		// this is in between tags
    		if ($nested) // don't break
    		{
    	    	$new_text .= $text_2[0];
    		}
    		else
    		{
    	        if (trim($text_2[0])=='') // whitespace between tags
    			{
                    $new_text .="\n";
    			}
    	        else // regular text between tags
    			{
    				if (strlen($text_2[0])<$size)
    				{
                        $new_text .=$text_2[0]."\n";
    				}
    				else
    				{
                    	$new_text .= wordwrap($text_2[0],$size);
    				}
    			}
    		}
            for ($i1=1;$i1<$sizeof_2-1;$i1++) // this is not the first start-of-tag here, from now on don't break
            {
    	    	$nested++;
                $new_text .= '<' . $text_2[$i1];
    	    }
            if (!empty($text_2[$sizeof_2-1])) // this is a single unnested tag
    	    {
                $new_text .= '<' . $text_2[$sizeof_2-1] . '>';
            }
        }
    }
    return $new_text;
}

function vmn_lockTable()
{
    $database = &JFactory::getDBO();
    //increment readers
    $database->setQuery("UPDATE #__vemod_news_mailer_scantime SET readers=readers+1 LIMIT 1");
    $database->Query();
    //get number of readers
    $database->setQuery("SELECT readers FROM #__vemod_news_mailer_scantime LIMIT 1");
    $readers=$database->loadResult();
    //if only me
    if ($readers<2)
    {
        return;
    }
    //timeout after 10 seconds
    for ($i=0;$i<10;$i++) 
    {
        //wait a second
        sleep(1);
        //get number of readers again
        $database->setQuery("SELECT readers FROM #__vemod_news_mailer_scantime LIMIT 1");
        $newreaders=$database->loadResult();
        //keep alive;
        echo chr(0x0);
        //see if anyone stopped reading        
        if ($newreaders==$readers-1)
        {
            return;
        }
    }
    //timed out, abort all
    $database->setQuery("UPDATE #__vemod_news_mailer_scantime SET readers=0 WHERE readers>0 LIMIT 1");
    $database->Query();    
}

function vmn_unlockTable()
{
    $database = &JFactory::getDBO();
    //decrement readers
    $database->setQuery("UPDATE #__vemod_news_mailer_scantime SET readers=readers-1 WHERE readers>0 LIMIT 1");
    $database->Query();   
}

//fix to work for Joomla! 1.5 natively
function vmn_sefRelToAbs($url) {
	$mod_url = str_replace('&amp;', '&', $url);
	$uri    = JURI::getInstance();
	$prefix = $uri->toString(array('scheme', 'host', 'port'));
	return $prefix.JRoute::_($mod_url);
}
?>
<?php
// vemod_news_mailer Component
/**
* Content code
* @package vemod_news_mailer
* @Copyright (C) 2007 Thomas ALlin
* @ All rights reserved
* @ vemod_news_mailer is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version 1.0
**/


// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted Access.' );

// ensure user has access to this function
$my=&JFactory::getUser();
$acl=&JFactory::getACL();
global $mainframe;
if(!$my->gid == 25) {
	$mainframe->redirect( 'index2.php', _NOT_AUTH);
}

require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");  
require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/js.vemod_news_mailer.php");

jimport('joomla.mail.helper');

function TemplateCodeIncluded(&$incl_code,&$tfile,&$file)
{
	$database = &JFactory::getDBO();
    $incl_code = "<" . "?php " . "$" . "fromtemplate = 1;@include('components/com_vemod_news_mailer/vemod_news_mailer.php'); ?" . ">";
    
    $query = "SELECT template"
		   . "\n FROM #__templates_menu"
		   . "\n WHERE client_id = 0"
		   . "\n AND menuid = 0"
		   ;
    $database->setQuery( $query );

    $current_template = $database->loadResult();

    $tfile = JPATH_SITE . "/templates/" . $current_template . "/index.php";

    $file = file_get_contents($tfile);
	$codeincluded=substr_count($file, $incl_code);
    if ($codeincluded != FALSE) 
	{
		return 1;
	}
	return 0;
}

$task = JRequest::getVar( 'task');

switch ($task) {
 
	case "save":
		saveNewsMailer( $option );
		break;
	case "cancel":
		cancelNewsMailer( $option );
		break;
	case "backup":
		backupNewsMailer( $option );
		break;
	case "restore":
		restoreNewsMailer( $option );
		break;
	case "bulkadd":
		bulkAddUsers( $option );
		break;		
	case "emailscan":
		$msg=emailScan();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "cleanemail":
		$msg=emailClean();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "scanexpired":
		$msg=expiredScan();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "cleanexpired":
		$msg=expiredClean();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "scancategories":
		$msg=categoriesScan();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "cleancategories":
		$msg=categoriesClean();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "oneclick":
		$msg=oneClick();
		showMaintenance($option);
		if ($msg) echo "<script language=\"JavaScript\">window.onload=displayResult('$msg')</script>";			
		break;
	case "editmailformat":
		showMailFormat($option);
		break;
	case "editsmsdetails":
		showSMSDetails($option);
		break;	
    case "editsubscribers":	     	
       showCategory($option);
       break;
    case "showsubscribers":	     	
       showSubscribers($option);
       break;
    case "showmaintenance":	     	
       showMaintenance($option);
       break;
    case "showbackup":	     	
       showBackup($option);
       break;              
    case "savecategory":	     	
       saveCategory($option);
       break;
    case "savemailformat":	     	
       saveMailFormat($option);
       break;
    case "savesmsdetails":	     	
       saveSMSDetails($option);
       break;
    case "configuration":
        showNewsMailer( $option );
        break;                                		                      		                      		                      		
	default:
		showCPanel($option);
		break;
}

function bulkAddUsers($option)
{
    global $mainframe;
	$database = &JFactory::getDBO();
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");
	if (strlen($vmnsecs)==0) $vmnsecs="-9999999";
	$database->setQuery( "SELECT id FROM #__sections WHERE published=1 AND id IN (" . $vmnsecs . ") ORDER BY ordering" );
	$sections = $database->loadResultArray();
	if (strlen($vmncats)==0) $vmncats="-9999999";
	$database->setQuery( "SELECT id FROM #__categories WHERE published=1 AND id IN (" . $vmncats . ") AND section NOT IN (" . $vmnsecs . ") ORDER BY section, ordering" );
	$categories = $database->loadResultArray();
	$database->setQuery("TRUNCATE TABLE #__vemod_news_mailer_subs");
	$database->query();
	$database->setQuery( "SELECT id,name,email FROM #__users" );
	$users=$database->loadObjectList();
	$usercount=0;
	$catcount=count($categories);
	$seccount=count($sections);
	$invalid="";
	if (count($users))
	{
        	foreach ($users as $user)
        	{
                	if (JMailHelper::isEmailAddress($user->email ))
                	{
				$usercount++;
                        	foreach($sections as $section)
                        	{
				    	$database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($user->id,-$section)");
					$database->query();
				}
                        	foreach($categories as $category)
                        	{
				    	$database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($user->id,$category)");
					$database->query();
				}
			}
			else
			{
                        	$invalid.="$user->email (".$user->name.")  ";
			}
		}
	}
	if ($usercount)
	{
        	$msg=$usercount." users added to ".$catcount." categories and ".$seccount." sections.    ";
	}
	else
	{
        	$msg="No users with valid email found.    ";
	}
	if ($invalid)
	{
        	$msg .= "Invalid email addresses:  ".$invalid;
	}
	$mainframe->redirect( "index2.php?option=$option&task=showsubscribers",$msg);
}

function emailScan()
{
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT id,name,email FROM #__users" );
	$users=$database->loadObjectList();
	$invalid=array();
	if (count($users))
	{
        	foreach ($users as $user)
        	{
                	if (!JMailHelper::isEmailAddress($user->email ))
			{
                        	$invalid[]=$user;
			}
		}
	}
	$msg="Users db scanned.<br><br>";
	if (count($invalid))
	{
        	$msg .= "Invalid emails:<br>";
        	$removed="";
        	foreach($invalid as $invmail)
        	{
               		$msg .= "$invmail->email (".$invmail->name.")<br>";
			$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid=$invmail->id");
			$invid=$database->loadResult();
			if ($invid)
			{
				$removed.="$invmail->email (".$invmail->name.")<br>";
			}
		}
		if (!$removed)
		{
                	$msg.="No users with invalid email in subscribers table.";
		}
		else
		{
                	$msg.="<br>In subscribers table:<br>".$removed;
		}
	}
	else
	{
        	$msg .= "No bad addresses found.";
	}
	return $msg;
}

function emailClean()
{
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT id,name,email FROM #__users" );
	$users=$database->loadObjectList();
	$invalid=array();
	if (count($users))
	{
        	foreach ($users as $user)
        	{
                	if (!JMailHelper::isEmailAddress($user->email ))
			{
                        	$invalid[]=$user;
			}
		}
	}
	$msg="Subscribers db cleaned.<br><br>";
	if (count($invalid))
	{
        	$msg .= "Invalid emails:<br>";
        	$removed="";
        	foreach($invalid as $invmail)
        	{
               		$msg .= " $invmail->email (".$invmail->name.")<br>";
			$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid=$invmail->id");
			$invid=$database->loadResult();
			if ($invid)
			{
				$database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid=$invmail->id");
				$database->query();
				$removed.="$invmail->email (".$invmail->name.")<br>";
			}
		}
		if (!$removed)
		{
                	$msg.="No users removed.<br>";
		}
		else
		{
                	$msg.="<br>Removed:<br>".$removed;
		}
	}
	else
	{
        	$msg .= "No bad addresses found.";
	}
    return $msg;	
}

function expiredScan()
{
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT id FROM #__users" );
	$users=$database->loadResultArray();

	if (count($users))
	{
		$userlist=implode(",",$users);
		$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid NOT IN ($userlist)");
		$expired=$database->loadResultArray();
	}
	$msg="Subscribers db scanned.<br><br>";
	if (count($expired))
	{
        	$msg.="Ex-member ids:<br>".implode("<br>",$expired);
	}
	else
	{
        	$msg.="No ex-members found.";
	}
    return $msg;    	
}

function expiredClean()
{
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT id FROM #__users" );
	$users=$database->loadResultArray();

	if (count($users))
	{
		$userlist=implode(",",$users);
		$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid NOT IN ($userlist)");
		$expired=$database->loadResultArray();
	}
	$msg="Subcribers db cleaned.<br><br>";
	if (count($expired))
	{
		$explist=implode(",",$expired);
                $database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid IN ($explist)");
                $database->query();
        	$msg.="Ex user-ids:<br>".implode("<br>",$expired);
	}
	else
	{
        	$msg.="No ex-members found.";
	}
    return $msg;    	
}

function categoriesScan()
{
	$database = &JFactory::getDBO();
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");
	if (strlen($vmnsecs)==0)
    {
        $secs="-9999999";
    }
    else
    {
        $secs=(explode(',',$vmnsecs));
        for($i=0;$i<count($secs);$i++)
        {
            $secs[$i]=-$secs[$i];
        }
        $secs=implode(',',$secs);
    }
	if (strlen($vmncats)==0) $vmncats="-9999999";  
	$database->setQuery("SELECT DISTINCT catid FROM #__vemod_news_mailer_subs WHERE catid NOT IN ($secs) AND catid NOT IN ($vmncats)");
	$badcats=$database->loadResultArray();
    $database->setQuery("SELECT DISTINCT id FROM #__categories WHERE section IN ($vmnsecs)");
    $overridden=$database->loadResultArray();  	
	if (count($overridden))
	{
        foreach($overridden as $cat)
        {
            $badcats[]=$cat;
        }
    }
	$msg="Subscribers db scanned.<br><br>";
	if (count($badcats))
	{
        	$msg.="Unused category ids:<br>".implode("<br>",$badcats);
	}
	else
	{
        	$msg.="No unused categories found.";
	}
    return $msg;    	
}

function categoriesClean()
{
	$database = &JFactory::getDBO();
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");
	if (strlen($vmnsecs)==0)
    {
        $secs="-9999999";
    }
    else
    {
        $secs=(explode(',',$vmnsecs));
        for($i=0;$i<count($secs);$i++)
        {
            $secs[$i]=-$secs[$i];
        }
        $secs=implode(',',$secs);
    }
	if (strlen($vmncats)==0) $vmncats="-9999999";    
	$database->setQuery("SELECT DISTINCT catid FROM #__vemod_news_mailer_subs WHERE catid NOT IN ($secs) AND catid NOT IN ($vmncats)");
	$badcats=$database->loadResultArray();
    $database->setQuery("SELECT DISTINCT id FROM #__categories WHERE section IN ($vmnsecs)");
    $overridden=$database->loadResultArray();  	
	if (count($overridden))
	{
        foreach($overridden as $cat)
        {
            $badcats[]=$cat;
        }
    }	
	$msg="Subcribers db cleaned.<br><br>";
	if (count($badcats))
	{
		$badlist=implode(",",$badcats);
                $database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE catid IN ($badlist)");
                $database->query();
        	$msg.="Unused category ids:<br>".implode("<br>",$badcats);
	}
	else
	{
        	$msg.="No unused categories found.";
	}
    return $msg;    	
}
    
function oneClick()
{
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT id,name,email FROM #__users" );
	$users=$database->loadObjectList();
	$invalid=array();
	if (count($users))
	{
        	foreach ($users as $user)
        	{
                	if (!JMailHelper::isEmailAddress($user->email ))
			{
                        	$invalid[]=$user;
			}
		}
	}
	$msg="Subscribers db cleaned.<br><br>";
	if (count($invalid))
	{
        	$msg .= "Invalid emails:<br>";
        	$removed="";
        	foreach($invalid as $invmail)
        	{
               		$msg .= " $invmail->email (".$invmail->name.")<br>";
			$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid=$invmail->id");
			$invid=$database->loadResult();
			if ($invid)
			{
				$database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid=$invmail->id");
				$database->query();
				$removed.="$invmail->email (".$invmail->name.")<br>";
			}
		}
		if (!$removed)
		{
                	$msg.="No users removed.<br><br>";
		}
		else
		{
                	$msg.="<br>Removed:<br>".$removed."<br>";
		}
	}
	else
	{
        	$msg .= "No bad addresses found.<br><br>";
	}
	$database->setQuery( "SELECT id FROM #__users" );
	$users=$database->loadResultArray();

	if (count($users))
	{
		$userlist=implode(",",$users);
		$database->setQuery("SELECT DISTINCT userid FROM #__vemod_news_mailer_subs WHERE userid NOT IN ($userlist)");
		$expired=$database->loadResultArray();
	}
	$msg.="Subcribers db cleaned.<br><br>";
	if (count($expired))
	{
		$explist=implode(",",$expired);
                $database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE userid IN ($explist)");
        	$msg.="Ex-member ids:<br>".implode("<br>",$expired)."<br><br>";
	}
	else
	{
        	$msg.="No ex-members found.<br><br>";
	}
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");
	if (strlen($vmnsecs)==0)
    {
        $secs="-9999999";
    }
    else
    {
        $secs=(explode(',',$vmnsecs));
        for($i=0;$i<count($secs);$i++)
        {
            $secs[$i]=-$secs[$i];
        }
        $secs=implode(',',$secs);
    }
	if (strlen($vmncats)==0) $vmncats="-9999999";    
	$database->setQuery("SELECT DISTINCT catid FROM #__vemod_news_mailer_subs WHERE catid NOT IN ($secs) AND catid NOT IN ($vmncats)");
	$badcats=$database->loadResultArray();
    $database->setQuery("SELECT DISTINCT id FROM #__categories WHERE section IN ($vmnsecs)");
    $overridden=$database->loadResultArray();  	
	if (count($overridden))
	{
        foreach($overridden as $cat)
        {
            $badcats[]=$cat;
        }
    }	
	$msg.=" Subcribers db cleaned.<br><br>";
	if (count($badcats))
	{
		$badlist=implode(",",$badcats);
                $database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE catid IN ($badlist)");
                $database->query();
        	$msg.="Unused category ids:<br>".implode(", ",$badcats);
	}
	else
	{
        	$msg.="No unused categories found.";
	}
    return $msg;	
}

function backupDatabaseTable( $tablename )
{
	$database = &JFactory::getDBO();
	$backupFile = JPATH_SITE . "/administrator/backups/$tablename.bak";
	if (file_exists($backupFile))
	{
		unlink($backupFile);
	}
	//$query      = "SELECT * INTO OUTFILE '$backupFile' FROM #__$tablename";
	//$database->setQuery($query);
	//return $database->query();
	$query      = "SELECT * FROM #__$tablename";
	$database->setQuery($query);
	$dataarray= $database->loadObjectList();
	$datastring=serialize($dataarray);
	if (!touch($backupFile))
	{
		return FALSE;
	}
	chmod($backupFile,0766);
  	if ($fp = fopen("$backupFile", "w"))
	{
    	$result=fputs($fp, $datastring, strlen($datastring));
    	fclose ($fp);
		if (!file_exists($backupFile))
		{
			return FALSE;
		}
		return  $result;
	}
	return FALSE;
}

function backupNewsMailer( $option )
{
    global $mainframe;
	chmod(JPATH_SITE . "/administrator/backups",0766);
	$msg="";
	if (!backupDatabaseTable('vemod_news_mailer_log'))
	{
		$msg.="Log table not saved ";
	}
	if (!backupDatabaseTable('vemod_news_mailer_subs'))
	{
		$msg.="Subscriber table not saved ";
	}
	if (!backupDatabaseTable('vemod_news_mailer_users'))
	{
		$msg.="User table not saved ";
	}
	if (!copy(JPATH_SITE . "/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php",JPATH_SITE . "/administrator/backups/config.vemod_news_mailer.bak"))
	{
		$msg.="Config file not saved ";
	}
	if ($msg=="")
	{
		$msg="db tables backed up successfully!";
	}
	$mainframe->redirect( "index2.php?option=$option&task=showbackup",$msg);
}

function restoreDatabaseTable($tablename,$tablefields)
{
	$database = &JFactory::getDBO();
	$msg="";
	$query      = "CREATE TABLE IF NOT EXISTS #__$tablename ($tablefields)";
	$database->setQuery($query);
	$database->query();

	$backupFile = JPATH_SITE."/administrator/backups/$tablename.bak";
	if (file_exists($backupFile))
	{
		$datastring="";
	  	if ($fp = fopen("$backupFile", "r"))
		{
		    while (!feof($fp))
			{
	        	$datastring .= fgets($fp);
			}
    	}
		fclose ($fp);
		if (strlen($datastring))
		{
			$dataarray=unserialize($datastring);
			$query      = "TRUNCATE TABLE #__$tablename";
			$database->setQuery($query);
			$database->query();
			if (count($dataarray))
			{
				foreach ($dataarray as $row)
				{
					if (!$database->insertObject("#__$tablename",$row))
					{
						return FALSE;
					}
				}
			}
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return FALSE;
	}
	return TRUE;
}

function restoreNewsMailer( $option )
{
    global $mainframe;
    $msg="";
    if (!restoreDatabaseTable('vemod_news_mailer_log','id INT NOT NULL auto_increment, sent DATETIME NOT NULL, subject MEDIUMTEXT NOT NULL, message MEDIUMTEXT NOT NULL, users MEDIUMTEXT NOT NULL,	status INT NOT NULL, PRIMARY KEY (id)'))
	{
		$msg.="Log table not loaded ";
	}
    if (!restoreDatabaseTable('vemod_news_mailer_subs','userid INT NOT NULL, catid INT NOT NULL'))
	{
		$msg.="Subscriber table not loaded ";
	}
    if (!restoreDatabaseTable('vemod_news_mailer_users','id INT NOT NULL, mailformat INT NOT NULL, metatags MEDIUMTEXT NOT NULL, topstories MEDIUMTEXT NOT NULL, topstoriesmailtime TIME NOT NULL, PRIMARY KEY (id)'))
	{
		$msg.="User table not loaded ";
	}
	if (!copy(JPATH_SITE . "/administrator/backups/config.vemod_news_mailer.bak",JPATH_SITE . "/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php"))
	{
		$msg.="Config file not loaded ";
	}
	if ($msg=="")
	{
		$msg="db tables restored successfully!";
	}
	$mainframe->redirect( "index2.php?option=$option&task=showbackup",$msg);
}

function saveCategory($option)
{
  global $mainframe;
  $database = &JFactory::getDBO();  
  $savecategory=@$_POST['savecategory'];
  if ($savecategory)
  { 
    $database->setQuery("DELETE FROM #__vemod_news_mailer_subs WHERE catid=$savecategory");
    $database->query();      
    
    $users    = JRequest::getVar('usersselect', array(), '', 'array');  
             
	if ($savecategory > 0)
	{
		$database->setQuery("SELECT title FROM #__categories WHERE id=$savecategory AND published=1");
		$title= $database->loadResult().' (Category)';							
	}
	else
	{
		$secid=-($savecategory);
		$database->setQuery("SELECT title FROM #__sections WHERE id=$secid AND published=1");
		$title= $database->loadResult().' (Section)';							
	} 
   if (is_array($users))
   {
    if (count($users))
    {
        foreach($users as $user)
        {
            if ($user != 0)
            {           
                $userobj=NULL;
                $database->setQuery("SELECT DISTINCT * FROM #__users WHERE id=$user");
                $userobj=$database->loadObject();
                if ($userobj)
                {               
                    if (JMailHelper::isEmailAddress($userobj->email ))
                    {
                        $database->setQuery("INSERT INTO #__vemod_news_mailer_subs (userid,catid) VALUES ($user,$savecategory)");
    					$database->query();
                    }
                }
            }
        }
    }
   } 
    $msg = $title." was updated!";
    $mainframe->redirect("index2.php?option=$option&task=showsubscribers",$msg);
    break;
  
  }

}

function saveMailFormat($option)
{
        global $mainframe;
        $database = &JFactory::getDBO();
        $database->setQuery("UPDATE #__vemod_news_mailer_users SET mailformat=0");
        $database->query();
        $users=JRequest::getVar('textusersselect',array(),'','array');         
        if (is_array($users))
        {
            if (count($users))
            {        
                foreach($users as $user)
                {
                    if ($user != 0)
                    {
                        $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_users WHERE id=$user");
                        $exist=$database->loadResult();
                        if ($exist)
                        {
                            $database->setQuery("UPDATE #__vemod_news_mailer_users SET mailformat=1 WHERE id=$user");
                            $database->query();                
                        }
                        else
                        {
                            $database->setQuery("INSERT INTO #__vemod_news_mailer_users (id,mailformat) VALUES ($user,1)");
                			$database->query();                           
                        }
                    }
                }
            }
        }       
        $msg = "Mail formats was updated!";
        $mainframe->redirect("index2.php?option=$option&task=showsubscribers",$msg);
        break;   
}

function saveSMSDetails($option)
{
        global $mainframe;
        $database = &JFactory::getDBO();
        $database->setQuery("UPDATE #__vemod_news_mailer_users SET metatags=''");
        $database->query();
        $users=JRequest::getVar('usersselect',array(),'','array');        
        if (is_array($users))
        {
            if (count($users))
            {        
                foreach($users as $user)
                {
                    if ($user != '')
                    {
                        $usertexts=explode(',',$user);
                        $userid=$usertexts[0];
                        $usersms=$usertexts[1];
                        if ($userid != 0)
                        {
                            $database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_users WHERE id=$userid");
                            $exist=$database->loadResult();
                            if ($exist)
                            {
                                $database->setQuery("UPDATE #__vemod_news_mailer_users SET metatags='$usersms' WHERE id=$userid");
                                $database->query();                
                            }
                            else
                            {
                                $database->setQuery("INSERT INTO #__vemod_news_mailer_users (id,metatags) VALUES ($userid,'$usersms')");
                    			$database->query();                           
                            }
                        }
                    }
                }
            }
        }       
        $msg = "SMS details was updated!";
        $mainframe->redirect("index2.php?option=$option&task=showsubscribers",$msg);
        break;    
}
/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function saveNewsMailer( $option ) {
  global $mainframe;
  $database = &JFactory::getDBO();
  $configfile = "components/com_vemod_news_mailer/config.vemod_news_mailer.php";
  @chmod ($configfile, 0766);
  $permission = is_writable($configfile);
  if (!$permission) {
    $msg = "Config file not writeable!";
    $mainframe->redirect("index2.php?option=$option&task=configuration",$msg);
    break;
  }

	$codeincluded=TemplateCodeIncluded($incl_code,$tfile,$file);
	$msg="Vemod News Mailer: Config Save error !";

	$previewusers=$_POST['preview_group'];
	$mailusers=$_POST['mail_group'];
	$interval=$_POST['interval'];
	$throttleinterval=$_POST['throttleinterval'];	
	$throttlesize=$_POST['throttlesize'];
	$logsize=$_POST['logsize'];
	
	$smsoperator=$_POST['smsoperator'];
	$smsfromname=$_POST['smsfromname'];
	$smsfromaddress=$_POST['smsfromaddress'];
    $smssubject=$_POST['smssubject'];    	
	$smsfrontendtext=$_POST['smsfrontendtext'];  	
	$smsText=stripslashes($_POST['smsText']);
	$useverificationemail=($_POST['useverificationemail']==1) ? '1':'0';
	$vmsubject=stripslashes($_POST['vmsubject']);
	$vmchosencat=$_POST['vmchosencat'];
	$vmnocats=$_POST['vmnocats'];
	$vmlinktext=$_POST['vmlinktext'];
	$verifymailHTML=stripslashes($_POST['verifymailHTML']);
	$verifymailText=stripslashes($_POST['verifymailText']);
	$usereadmore=$_POST['usereadmore'];
	$readmoretext=$_POST['readmoretext'];
	$readmoretruncate=$_POST['readmoretruncate'];
	$compiledreadmoretext=$_POST['compiledreadmoretext'];
	$compiledusereadmore=$_POST['compiledusereadmore'];	
	$compiledreadmoretruncate=$_POST['compiledreadmoretruncate'];
	/*
	$sidebarmodule1=$_POST['sidebarmodule1'];
	$sidebarmodule2=$_POST['sidebarmodule2'];
	$sidebarmodule3=$_POST['sidebarmodule3'];
	$sidebarmodule4=$_POST['sidebarmodule4'];
	$sidebarmodule5=$_POST['sidebarmodule5'];
	$sidebarmodule6=$_POST['sidebarmodule6'];
	$sidebarmoduleid1=$_POST['sidebarmoduleid1'];	
	$sidebarmoduleid2=$_POST['sidebarmoduleid2'];
	$sidebarmoduleid3=$_POST['sidebarmoduleid3'];
	$sidebarmoduleid4=$_POST['sidebarmoduleid4'];
	$sidebarmoduleid5=$_POST['sidebarmoduleid5'];
	$sidebarmoduleid6=$_POST['sidebarmoduleid6'];
	*/
	$modules=$_POST['module_id'];
	for ($i=0;$i<count($modules);$i++)
	{
        $modules[$i]=explode(',',$modules[$i]);
    }
    $sidebarmodule1=$modules[0][0];
    $sidebarmodule2=$modules[1][0];
    $sidebarmodule3=$modules[2][0];
    $sidebarmodule4=$modules[3][0];
    $sidebarmodule5=$modules[4][0];
    $sidebarmodule6=$modules[5][0];
    $sidebarmoduleid1=$modules[0][1];
    $sidebarmoduleid2=$modules[1][1];
    $sidebarmoduleid3=$modules[2][1];
    $sidebarmoduleid4=$modules[3][1];
    $sidebarmoduleid5=$modules[4][1];
    $sidebarmoduleid6=$modules[5][1];                        
	$newsmailsubject=stripslashes($_POST['newsmailsubject']);
	$newsmailHTML=stripslashes($_POST['newsmailHTML']);
	$newsmailText=stripslashes($_POST['newsmailText']);
	$stripmambots=$_POST['stripmambots'];
	$compilednewsmailHTML=stripslashes($_POST['compilednewsmailHTML']);
	$compilednewsmailText=stripslashes($_POST['compilednewsmailText']);
	$mailformat=stripslashes($_POST['mailformat']);
	$mailformatmessage=$_POST['mailformatmessage'];
	$autoresend=$_POST['autoresend'];
	$autoaddusers=$_POST['autoaddusers'];
	$unsubscribealltext=$_POST['unsubscribealltext'];
	$receiveremail=$_POST['receiveremail'];
	$mailfromaddress=$_POST['mailfromaddress'];
	$customrecipients=serialize($_POST['customrecipients']);
	$scustomrecipients=serialize($_POST['scustomrecipients']);
	$frontdescription=serialize($_POST['frontdescription']);
	$sfrontdescription=serialize($_POST['sfrontdescription']);
	$compilationtitle=serialize($_POST['compilationtitle']);
	$scompilationtitle=serialize($_POST['scompilationtitle']);
	$compilationintrotext=serialize($_POST['compilationintrotext']);
	$scompilationintrotext=serialize($_POST['scompilationintrotext']);
	$newscompileday=serialize($_POST['compile_day']);
	$snewscompileday=serialize($_POST['scompile_day']);
	$newscompiletime=serialize($_POST['compile_time']);
	$snewscompiletime=serialize($_POST['scompile_time']);
	
	$popupstyle=$_POST['popupstyle'];
	$frontendtree=$_POST['frontendtree'];
	$archiveitems=$_POST['archiveitems'];
	$archivename=$_POST['archivename'];
	$archiveitemtext=$_POST['archiveitemtext'];
	$archiveusers=$_POST['archiveusers'];
	$archiveformat=$_POST['archiveformat'];
	$registerurl=$_POST['registerurl'];
	if (count(@$_POST['cid']))
	{
        $vmncats=implode(",",$_POST['cid']);
    }
    else
	{
        $vmncats='';
    }
	if (count(@$_POST['sid']))
	{
        $vmnsecs=implode(",",$_POST['sid']);
    }
    else
	{
        $vmnsecs='';
    }
	if (count(@$_POST['smscid']))
	{
        $vmnsmscats=implode(",",$_POST['smscid']);
    }
    else
	{
        $vmnsmscats='';
    }
	if (count(@$_POST['smssid']))
	{
        $vmnsmssecs=implode(",",$_POST['smssid']);
    }
    else
	{
        $vmnsmssecs='';
    }    
  $config  = "<?php\n";

  $config .= "\$vmncats = \"" .$vmncats ."\";\n";
  $config .= "\$vmnsecs = \"" .$vmnsecs ."\";\n";

  $config .= "\$vmnsmscats = \"" .$vmnsmscats ."\";\n";
  $config .= "\$vmnsmssecs = \"" .$vmnsmssecs ."\";\n";
  
  $config .= "\$previewusers = \"" .$previewusers ."\";\n";
  $config .= "\$mailusers = \"" .$mailusers ."\";\n";
  $config .= "\$interval = \"" .$interval ."\";\n";
  $config .= "\$throttleinterval = \"" .$throttleinterval ."\";\n";  
  $config .= "\$throttlesize = \"" .$throttlesize ."\";\n";
  $config .= "\$logsize = \"" .$logsize ."\";\n";

  $config .= "\$useverificationemail = \"" .$useverificationemail ."\";\n";
  $config .= "\$vmsubject = \"" .addslashes($vmsubject) ."\";\n";
  $config .= "\$vmchosencat = \"" .$vmchosencat ."\";\n";
  $config .= "\$vmnocats = \"" .$vmnocats ."\";\n";
  $config .= "\$vmlinktext = \"" .$vmlinktext ."\";\n";
  $config .= "\$verifymailHTML = \"" .addslashes($verifymailHTML) ."\";\n";
  $config .= "\$verifymailText = \"" .addslashes($verifymailText) ."\";\n";
  $config .= "\$smsText = \"" .addslashes($smsText) ."\";\n";
  $config .= "\$smsoperator = \"" .$smsoperator ."\";\n";
  $config .= "\$smsfromname = \"" .$smsfromname ."\";\n";
  $config .= "\$smsfromaddress = \"" .$smsfromaddress ."\";\n";
  $config .= "\$smssubject = \"" .$smssubject ."\";\n";    
  $config .= "\$smsfrontendtext = \"" .$smsfrontendtext ."\";\n";      
  $config .= "\$usereadmore = \"" .$usereadmore ."\";\n";
  $config .= "\$readmoretext = \"" .$readmoretext ."\";\n";
  $config .= "\$readmoretruncate = \"" .$readmoretruncate ."\";\n";
  $config .= "\$compiledreadmoretext = \"" .$compiledreadmoretext ."\";\n";
  $config .= "\$compiledusereadmore = \"" .$compiledusereadmore ."\";\n";  
  $config .= "\$compiledreadmoretruncate = \"" .$compiledreadmoretruncate ."\";\n";
  $config .= "\$sidebarmodule1 = \"" .$sidebarmodule1 ."\";\n";
  $config .= "\$sidebarmodule2 = \"" .$sidebarmodule2 ."\";\n";
  $config .= "\$sidebarmodule3 = \"" .$sidebarmodule3 ."\";\n";
  $config .= "\$sidebarmodule4 = \"" .$sidebarmodule4 ."\";\n";
  $config .= "\$sidebarmodule5 = \"" .$sidebarmodule5 ."\";\n";
  $config .= "\$sidebarmodule6 = \"" .$sidebarmodule6 ."\";\n";
  $config .= "\$sidebarmoduleid1 = \"" .$sidebarmoduleid1 ."\";\n";
  $config .= "\$sidebarmoduleid2 = \"" .$sidebarmoduleid2 ."\";\n";
  $config .= "\$sidebarmoduleid3 = \"" .$sidebarmoduleid3 ."\";\n";
  $config .= "\$sidebarmoduleid4 = \"" .$sidebarmoduleid4 ."\";\n";
  $config .= "\$sidebarmoduleid5 = \"" .$sidebarmoduleid5 ."\";\n";
  $config .= "\$sidebarmoduleid6 = \"" .$sidebarmoduleid6 ."\";\n";
  $config .= "\$newsmailsubject = \"" .addslashes($newsmailsubject) ."\";\n";
  $config .= "\$newsmailHTML = \"" .addslashes($newsmailHTML) ."\";\n";
  $config .= "\$newsmailText = \"" .addslashes($newsmailText) ."\";\n";
  $config .= "\$stripmambots = \"" .$stripmambots ."\";\n";
  $config .= "\$compilednewsmailHTML = \"" .addslashes($compilednewsmailHTML) ."\";\n";
  $config .= "\$compilednewsmailText = \"" .addslashes($compilednewsmailText) ."\";\n";
  $config .= "\$mailformat = \"" .addslashes($mailformat) ."\";\n";
  $config .= "\$mailformatmessage = \"" .$mailformatmessage ."\";\n";
  $config .= "\$autoresend = \"" .$autoresend ."\";\n";
  $config .= "\$autoaddusers = \"" .$autoaddusers ."\";\n";
  $config .= "\$unsubscribealltext = \"" .$unsubscribealltext ."\";\n";
  $config .= "\$receiveremail = \"" .$receiveremail ."\";\n";
  $config .= "\$mailfromaddress = \"" .$mailfromaddress ."\";\n";
  $config .= "\$customrecipients = \"" .addslashes($customrecipients) ."\";\n";
  $config .= "\$scustomrecipients = \"" .addslashes($scustomrecipients) ."\";\n";
  $config .= "\$frontdescription = \"" .addslashes($frontdescription) ."\";\n";
  $config .= "\$sfrontdescription = \"" .addslashes($sfrontdescription) ."\";\n";
  $config .= "\$compilationtitle = \"" .addslashes($compilationtitle) ."\";\n";
  $config .= "\$scompilationtitle = \"" .addslashes($scompilationtitle) ."\";\n";
  $config .= "\$compilationintrotext = \"" .addslashes($compilationintrotext) ."\";\n";
  $config .= "\$scompilationintrotext = \"" .addslashes($scompilationintrotext) ."\";\n";
  $config .= "\$newscompileday = \"" .addslashes($newscompileday) ."\";\n";
  $config .= "\$snewscompileday = \"" .addslashes($snewscompileday) ."\";\n";
  $config .= "\$newscompiletime = \"" .addslashes($newscompiletime) ."\";\n";
  $config .= "\$snewscompiletime = \"" .addslashes($snewscompiletime) ."\";\n";
  
  $config .= "\$popupstyle = \"" .$popupstyle ."\";\n";
  $config .= "\$frontendtree = \"" .$frontendtree ."\";\n";    
  $config .= "\$archiveitems = \"" .$archiveitems ."\";\n";
  $config .= "\$archivename = \"" .$archivename ."\";\n";
  $config .= "\$archiveitemtext = \"" .$archiveitemtext ."\";\n";
  $config .= "\$archiveusers = \"" .$archiveusers ."\";\n";
  $config .= "\$archiveformat = \"" .$archiveformat ."\";\n";
  $config .= "\$registerurl = \"" .$registerurl ."\";\n";
  
  
  $config .= "?>";

  if ($fp = fopen("$configfile", "w")) {
    fputs($fp, $config, strlen($config));
    fclose ($fp);
  }

	$msg="Vemod News Mailer: Config Saved !";

	if ($_POST['includecode'])
	{
	    if ($codeincluded==0)
		{
        	if($fp = fopen($tfile, 'w'))
			{
        		fwrite($fp, $file.$incl_code);
          		fclose($fp);
        	}
			else
			{
			    $msg="Vemod News Mailer: templates index.php not writable !";
			}
		}
	}
	else
	{
	    if ($codeincluded==1)
		{
	        if($fp = fopen($tfile, 'w'))
			{
        		$file = str_replace($incl_code, "", $file);
          		fwrite($fp, $file);
          		fclose($fp);
			}
			else
			{
			    $msg="Vemod News Mailer: templates index.php not writable !";
			}
        }
	}
	if (strlen($sidebarmodule1)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule1 . "/" . $sidebarmodule1 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule1 . "/" . $sidebarmodule1 . ".php does not exist!";
		}
	}
	if (strlen($sidebarmodule2)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule2 . "/" . $sidebarmodule2 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule2 . "/" . $sidebarmodule2 . ".php does not exist!";
		}
	}
	if (strlen($sidebarmodule3)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule3 . "/" . $sidebarmodule3 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule3 . "/" . $sidebarmodule3 . ".php does not exist!";
		}
	}
	if (strlen($sidebarmodule4)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule4 . "/" . $sidebarmodule4 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule4 . "/" . $sidebarmodule4 . ".php does not exist!";
		}
	}
	if (strlen(@$sidebarmodule5)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule5 . "/" . $sidebarmodule5 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule5 . "/" . $sidebarmodule5 . ".php does not exist!";
		}
	}
	if (strlen(@$sidebarmodule6)!=0)
	{
		if (!file_exists(JPATH_SITE."/modules/" . $sidebarmodule6 . "/" . $sidebarmodule6 . ".php"))
		{
			$msg .= " Warning: ".JPATH_SITE."/modules/" . $sidebarmodule6 . "/" . $sidebarmodule6 . ".php does not exist!";
		}
	}
    	
	$mainframe->redirect( "index2.php?option=$option&task=configuration",$msg);
}

/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelNewsMailer( $option ) {

    global $mainframe;
	$mainframe->redirect( "index2.php" );

}


/**
* List the records
* @param string The current GET/POST option
*/
function sectionTitle($secs,$cat)
{
    if ($cat->section)
    {
        if (count($secs))
        {
            foreach ($secs as $sec) 
            {
            	if ($sec->id==$cat->section)
            	return $sec->title;
            }
        }
    }
    return '';
}

function showNewsMailer($option) {
	global  $mainframe;
	$database = &JFactory::getDBO();
		
	$codeincluded=TemplateCodeIncluded($incl_code,$tfile,$file);
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");
	if ($interval==0) $interval=1;
    // make a standard yes/no list
    $mailformatarray=array();

    $mailformatarray[]    =JHTML::_('select.option','0', 'HTML');
    $mailformatarray[]    =JHTML::_('select.option','1', 'Plain text');
    $mailformatarray[]    =JHTML::_('select.option','2', 'User decides');
	
	$mailformatlist=JHTML::_('select.genericlist',$mailformatarray, 'mailformat', 'class="inputbox" size="1"', 'value', 'text', $mailformat);
    
    $truncatearray=array();

    $truncatearray[]    =JHTML::_('select.option','0', 'Don\'t truncate');
    $truncatearray[]    =JHTML::_('select.option','1', 'Truncate bodytext');
    $truncatearray[]    =JHTML::_('select.option','2', 'Truncate introtext'); 
             					
	# Do the main database query
	$database->setQuery( "SELECT * FROM #__categories WHERE (published=1 AND section REGEXP '^[0-9]+$') ORDER BY section, ordering" );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$checked=explode(",",$vmncats);
	if (!isset($vmnsmscats))
	{
        $checkedsms=explode(",",@$vmncats);
    }
	else
	{
	   $checkedsms=explode(",",@$vmnsmscats);
	}
	
	$database->setQuery( "SELECT * FROM #__sections WHERE published=1 ORDER BY ordering" );
	$srows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$schecked=explode(",",$vmnsecs);
	if (!isset($vmnsmssecs))
	{
        $scheckedsms=explode(",",@$vmnsecs);
    }
    else
    {
	   $scheckedsms=explode(",",@$vmnsmssecs);
	}
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( "controlpanel" );
				return;
			}
			
			submitform( pressbutton );

		}  
        function moduletitle(index)
        {
            var element=document.getElementsByName('module_id[]')[index];
            return element.options[element.selectedIndex].text;
        }	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Configuration</td>
		</tr>		
	</table>
	
  <?php

  $database->setQuery("SELECT title,module,id FROM #__modules WHERE published=1 and client_id=0 ORDER BY position,ordering");
  $modulearray=$database->loadObjectList();
  $moduleoptions=array();
  $moduleoptions[]=JHTML::_('select.option',',','-- Select module --');
  foreach ($modulearray as $module)
  {
    $moduleoptions[]=JHTML::_('select.option',$module->module.','.$module->id,$module->title);
    if ($module->module!='')
    {
        if ((@$sidebarmodule1==$module->module) && (@$sidebarmoduleid1==''))
        {
             $sidebarmoduleid1=$module->id;
        }
        if ((@$sidebarmodule2==$module->module) && (@$sidebarmoduleid2==''))
        {
             $sidebarmoduleid2=$module->id;
        }
        if ((@$sidebarmodule3==$module->module) && (@$sidebarmoduleid3==''))
        {
             $sidebarmoduleid3=$module->id;
        }
        if ((@$sidebarmodule4==$module->module) && (@$sidebarmoduleid4==''))
        {
             $sidebarmoduleid4=$module->id;
        }
        if ((@$sidebarmodule5==$module->module) && (@$sidebarmoduleid5==''))
        {
             $sidebarmoduleid5=$module->id;
        }
        if ((@$sidebarmodule6==$module->module) && (@$sidebarmoduleid6==''))
        {
             $sidebarmoduleid6=$module->id;
        }
    }           
  } 
  jimport('joomla.html.pane');
  $vnmtabs = &JPane::getInstance('tabs');
  echo $vnmtabs->startPane( "vemod_news_mailer" );
  echo $vnmtabs->startPanel("Content","Content-page");
		$ncoptions = array(
			JHTML::_('select.option', 0, 'No compilation' ),
			JHTML::_('select.option', 1, 'Every day' ),			
			JHTML::_('select.option', 2, 'Mondays' ),			
			JHTML::_('select.option', 3, 'Tuesdays' ),			
			JHTML::_('select.option', 4, 'Wedensdays' ),			
			JHTML::_('select.option', 5, 'Thursdays' ),			
			JHTML::_('select.option', 6, 'Fridays' ),			
			JHTML::_('select.option', 7, 'Saturdays' ),																					
			JHTML::_('select.option', 8, 'Sundays' )																								
		);
		$nctimes = array(
			JHTML::_('select.option', 0, '00:00' ),
			JHTML::_('select.option', 1, '01:00' ),			
			JHTML::_('select.option', 2, '02:00' ),			
			JHTML::_('select.option', 3, '03:00' ),			
			JHTML::_('select.option', 4, '04:00' ),			
			JHTML::_('select.option', 5, '05:00' ),			
			JHTML::_('select.option', 6, '06:00' ),			
			JHTML::_('select.option', 7, '07:00' ),																					
			JHTML::_('select.option', 8, '08:00' ),																								
			JHTML::_('select.option', 9, '09:00' ),
			JHTML::_('select.option', 10, '10:00' ),			
			JHTML::_('select.option', 11, '11:00' ),			
			JHTML::_('select.option', 12, '12:00' ),			
			JHTML::_('select.option', 13, '13:00' ),			
			JHTML::_('select.option', 14, '14:00' ),			
			JHTML::_('select.option', 15, '15:00' ),			
			JHTML::_('select.option', 16, '16:00' ),																					
			JHTML::_('select.option', 17, '17:00' ),																								
			JHTML::_('select.option', 18, '18:00' ),
			JHTML::_('select.option', 19, '19:00' ),			
			JHTML::_('select.option', 20, '20:00' ),			
			JHTML::_('select.option', 21, '21:00' ),			
			JHTML::_('select.option', 22, '22:00' ),			
			JHTML::_('select.option', 23, '23:00' )			
		);	  
	?>
  <font color="#FF0000"><strong>Compiled news mails can not be previewed before the compilation date/time has passed!</strong></font>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
			<th align="left" width="25">Id</th>
			<th width="240" align="left">Categories that allows subscription</th>	
			<th align="left" width="100">Frontend description (HTML allowed)</th>
			<th align="left" width="175">News compilation (GMT)</th>									
			<th align="left" width="100">Compilation title</th>
			<th align="left" width="100">Compilation introtext</th>
			<th align="left" width="100">Allow SMS notifications</th>
			<th align="left">Custom recipients e-mail addresses (separate with comma)</th>
		</tr>

<?php
		$k = 0;
		$recipients=unserialize(stripslashes(@$customrecipients));
		$fdescription=unserialize(stripslashes(@$frontdescription));
		$comptitle=unserialize(stripslashes(@$compilationtitle));
		$compintrotext=unserialize(stripslashes(@$compilationintrotext));
		$compileday=unserialize(stripslashes(@$newscompileday));
		$compiletime=unserialize(stripslashes(@$newscompiletime));
	
		// get list of groups
		$ncday = array();
		$nctime = array();						
		for($i=0; $i < count( $rows ); $i++) {
			$row = $rows[$i];
			$ncday[$row->id] = JHTML::_('select.genericlist', $ncoptions, "compile_day[$row->id]", 'size="1"', 'value', 'text', $compileday[$row->id] );			
			$nctime[$row->id] = JHTML::_('select.genericlist', $nctimes, "compile_time[$row->id]", 'size="1"', 'value', 'text', $compiletime[$row->id] );						
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+1;?></td>
			<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" <?php 
			if (count($checked))
			{
				echo in_array($row->id,$checked,TRUE) ? 'checked':''; 
			}
			?> onclick="isChecked(this.checked);" /></td>
				<td><?php echo $row->id; ?></td><td><?php echo $row->title.'&nbsp;&nbsp;&nbsp;(In section: '.sectionTitle($srows,$row).')'; ?></td>
				<td align="left">
				<input name="frontdescription[<?php echo $row->id; ?>]" type="text" value="<?php echo $fdescription[$row->id]; ?>" size="20">
				</td>								
				<td>
				<?php echo $ncday[$row->id] . " at " . $nctime[$row->id];?>
				</td>				
				<td align="left">
				<input name="compilationtitle[<?php echo $row->id; ?>]" type="text" value="<?php echo $comptitle[$row->id]; ?>" size="20">
				</td>				
				<td>
				<input name="compilationintrotext[<?php echo $row->id; ?>]" type="text" value="<?php echo $compintrotext[$row->id]; ?>" size="20">
				</td>
			<td><input type="checkbox" id="smscb<?php echo $i;?>" name="smscid[]" value="<?php echo $row->id; ?>" <?php 
			if (count($checkedsms))
			{
				echo in_array($row->id,$checkedsms,TRUE) ? 'checked':''; 
			}
			?> onclick="isChecked(this.checked);" /></td>                								
				<td>
				<input name="customrecipients[<?php echo $row->id; ?>]" type="text" value="<?php echo $recipients[$row->id]; ?>" size="30">
				</td>
		</tr>
<?php
			$k = 1 - $k;
		}
?>
    </table>
  <strong><font color="#FF0000">A checked section will include all published subcategories 
  and possibly override selections above</font></strong>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="20"><input type="checkbox" name="toggle1" value="" onclick="javascript:vmn_checkAll(<?php echo count($srows); ?>,'scb','toggle1',1);" /></th>
			<th align="left" width="25">Id</th>
			
      <th width="240" align="left">Sections that allows subscription</th>
			<th align="left" width="100">Frontend description (HTML allowed)</th>
			<th align="left" width="175">News compilation (GMT)</th>									
			<th align="left" width="100">Compilation title</th>									
			<th align="left" width="100">Compilation introtext</th>
            <th align="left" width="100">Allow SMS notifications</th>												
			<th align="left">Custom recipients e-mail addresses (separate with comma)</th>												
		</tr>

<?php
		$k = 0;
		$srecipients=unserialize(stripslashes(@$scustomrecipients));
		$sfdescription=unserialize(stripslashes(@$sfrontdescription));
		$scomptitle=unserialize(stripslashes(@$scompilationtitle));
		$scompintrotext=unserialize(stripslashes(@$scompilationintrotext));
		$scompileday=unserialize(stripslashes(@$snewscompileday));
		$scompiletime=unserialize(stripslashes(@$snewscompiletime));
		$sncday = array();
		$snctime = array();					
		for($i=0; $i < count( $srows ); $i++) {
			$row = $srows[$i];
			$negrowid=-$row->id;
			$sncday[-$row->id] = JHTML::_('select.genericlist', $ncoptions, "scompile_day[$negrowid]", 'size="1"', 'value', 'text', $scompileday[-($row->id)] );			
			$snctime[-$row->id] = JHTML::_('select.genericlist', $nctimes, "scompile_time[$negrowid]", 'size="1"', 'value', 'text', $scompiletime[-($row->id)] );									
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+1;?></td>
			<td><input type="checkbox" id="scb<?php echo $i;?>" name="sid[]" value="<?php echo $row->id; ?>" <?php 
			if (count($schecked))
			{
				echo in_array($row->id,$schecked,TRUE) ? 'checked':''; 
			}
			?> onclick="isChecked(this.checked);" /></td>
				<td><?php echo $row->id; ?></td><td><?php echo $row->title; ?></td>
				<td align="left">
				<input name="sfrontdescription[<?php echo -($row->id); ?>]" type="text" value="<?php echo $sfdescription[-($row->id)]; ?>" size="20">
				</td>												
				<td>
				<?php echo $sncday[-$row->id] . " at " . $snctime[-$row->id];?>
				</td>
				<td align="left">
				<input name="scompilationtitle[<?php echo -($row->id); ?>]" type="text" value="<?php echo $scomptitle[-($row->id)]; ?>" size="20">
				</td>				
				<td>
				<input name="scompilationintrotext[<?php echo -($row->id); ?>]" type="text" value="<?php echo $scompintrotext[-($row->id)]; ?>" size="20">
				</td>
			<td><input type="checkbox" id="smsscb<?php echo $i;?>" name="smssid[]" value="<?php echo $row->id; ?>" <?php 
			if (count($scheckedsms))
			{
				echo in_array($row->id,$scheckedsms,TRUE) ? 'checked':''; 
			}
			?> onclick="isChecked(this.checked);" /></td>                																
				<td>
				<input name="scustomrecipients[<?php echo -($row->id); ?>]" type="text" value="<?php echo $srecipients[-($row->id)]; ?>" size="30">
				</td>                				
		</tr>
<?php
			$k = 1 - $k;
		}

?>
    </table>

  <?php
    echo $vnmtabs->endPanel();
	echo $vnmtabs->startPanel("Schedule","Schedule-page");
	?>
  <!--<br>
	<br>-->
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="180" align="left"> <input type="checkbox" name="includecode" value="1" <?php
			echo ($codeincluded==1) ? 'checked':'';
			?> />
        Use scheduled news scans</th>

      <th align="left">New items will automatically be mailed to subscribers on
        template refresh</th>
    </tr>
    <tr class="row0">
	  <td>Automatically inserts</td>
      <td><strong>&lt;?php $fromtemplate = 1;@include('components/com_vemod_news_mailer/vemod_news_mailer.php');
        ?&gt;</strong> into your template file (Do not edit the template file by hand)</td>
	  </tr>
	  <tr class="row1">
	  <td>News scan interval</td>
	  <td><input name="interval" type="text" value="<?php echo $interval; ?>" size="2" maxlength="2">
        hours (Set to 1 to auto-send compiled news mails as soon as possible after
        the compilation date/time has passed)</td>
	  </tr>
    <tr class="row0">
      <td >Auto-resend failed mailings</td>
		<td align="left"><input type="checkbox" name="autoresend" value="1" <?php
			echo ($autoresend==1) ? 'checked':'';
			?> /> (will attempt to resend failed mailings on coming news scans. Be careful! If there is a problem with the mail configuration failed mailings can add up and slow down the site)</td>
    </tr>
    <tr class="row1">
      <td >Auto-add new registered users</td>
		<td align="left"><input type="checkbox" name="autoaddusers" value="1" <?php
			echo (@$autoaddusers==1) ? 'checked':'';
			?> /> Will scan the users table for members who registered since the last news scan and add them as subscribers to all available categories. Users can still unsubscribe whenever they like. (Does not require Scheduled news scan to be ON)</td>
    </tr>    
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="180" align="left">Throttle mailings</th>
		
    <th align="left">Mailings can be portioned out in smaller chunks. With throttling enabled mails will be sent individually not as bcc-copy. If "use scheduled news scans" is OFF the mail-chunks can be sent using the "Update" button at the frontend log page</th>
    </tr>
    <tr class="row0"> 
	  <td>Throttle after</td>
      <td> <input name="throttlesize" type="text" value="<?php echo @$throttlesize; ?>" size="4" maxlength="4"> mails (Leave blank to disable throttling)</td>
	  </tr>
	  <tr class="row1">
	  <td>Throttle minimum interval</td>
	  <td><input name="throttleinterval" type="text" value="<?php echo @$throttleinterval; ?>" size="6" maxlength="6"> seconds (Leave blank to disable throttling)</td>
	  </tr>
  </table>
	<?php
    echo $vnmtabs->endPanel();
	echo $vnmtabs->startPanel("Mail format","Mail format-page");
	?>  
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">Mail format</th>
	  <th align="left">Select the format of all mails sent with this component. "User decides" lets users select their prefered format</th>
    </tr>
    <tr class="row0">
			<td>Mail format</td>
            <td><?php echo $mailformatlist; ?></td>
    </tr>
    <tr class="row1">
	  <td>Mail format message</td><td><input name="mailformatmessage" type="text" value="<?php echo $mailformatmessage; ?>" size="60">
        i.e. Select Your prefered e-mail format</td>	
    </tr>   					
  </table> 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">SMS notification</th>
	  <th align="left" width="700">SMS notifications will be mailed to "phonenumber@SMSprovider"</th><th></th>
    </tr>
    <tr class="row0">
			<td>SMS carrier</td>
            <td colspan="2"><input name="smsoperator" type="text" value="<?php echo @$smsoperator; ?>" size="60"> i.e. sms.world-text.com, opensms.ipipi.com or mail-sms.com (Leave blank to disable sms notifications) Please note that most carriers (SMS via email providers) will require registration and will charge a small amount for each message</td>
    </tr>
<tr class="row1">
			<td>From name</td>
            <td colspan="2"><input name="smsfromname" type="text" value="<?php echo @$smsfromname; ?>" size="60"> The carrier might require this to be your phone number (default is sitename)</td>
    </tr>
<tr class="row0">
			<td>From address</td>
            <td colspan="2"><input name="smsfromaddress" type="text" value="<?php echo @$smsfromaddress; ?>" size="60"> The carrier might require this to be a certain email address or "yourphonemunber@SMSprovider" (default is the sites from address)</td>
    </tr>  
<tr class="row1">
			<td>Subject</td>
            <td colspan="2"><input name="smssubject" type="text" value="<?php echo @$smssubject; ?>" size="60"> The carrier might require this, otherwise leave blank</td>
    </tr>            
    <tr class="row0">
	  <td>Frontend text</td><td colspan="2"><input name="smsfrontendtext" type="text" value="<?php echo @$smsfrontendtext; ?>" size="60">
        i.e. You can get sms notifications about the categories you are subscribing to&lt;br&gt;&lt;b&gt;Enter your phone number&lt;/b&gt;</td><td></td>	
    </tr>
    <tr class="row1"> 
			<td valign="top">SMS text<br><br><input type="button" id="viewsmstext" value=" view " onclick="displayText(this.form.smsText.value,'',
			this.form.newsmailsubject.value,'','','<?php echo $mainframe->getCfg('sitename'); ?>','','','','',
			'','','','','','Close','User Name','','','')"></td>
			
            <td valign="top" width="500"><textarea name="smsText" id="smsText" cols="100" rows="15" wrap="OFF"><?php echo stripslashes(@$smsText); ?></textarea></td>
            
            <td valign="top" align="left">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[title]</b> Title of news item (will be compilation title in case of compiled newsletter category)<br>
	<b>[categoryname]</b> Name of category<br>
	<b>[senddate]</b> Date sms is sent<br>
	<b>[sendtime]</b> Time sms is sent<br>
	<b>[username]</b> Name of recipient (only available with throttling enabled)<br>
    </td>
    </tr>     					
  </table>        
	<?php
    echo $vnmtabs->endPanel();	
	echo $vnmtabs->startPanel("Verification","Verification-page");
	?>  
  <!--<br><br>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <td width="50%" valign="top">-->
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left"><input type="checkbox" name="useverificationemail" value="1" <?php 
			echo ($useverificationemail==1) ? 'checked':''; 
			?> /> Use verification email
	  </th>
	  <th></th>
    </tr>
    <tr class="row0"> 
	  <td>Subject</td><td><input name="vmsubject" type="text" value="<?php echo stripslashes($vmsubject); ?>" size="60">
        i.e. Verify Your subscriptions. The following placeholders can be included: <b>[sitename] [livesite] [senddate] [sendtime]</b></td>	
    </tr>
    <tr class="row1"> 
	  <td>Chosen cats</td><td><input name="vmchosencat" type="text" value="<?php echo $vmchosencat; ?>" size="60">
        i.e. You have chosen to subscribe to the following categories:</td>	
    </tr>		
    <tr class="row0"> 
	  <td>No chosen cats</td><td><input name="vmnocats" type="text" value="<?php echo $vmnocats; ?>" size="60">
        i.e. You have chosen to end all your subscriptions</td>	
    </tr>		
    <tr class="row1"> 
	  <td>Link text</td><td><input name="vmlinktext" type="text" value="<?php echo $vmlinktext; ?>" size="60">
        i.e Click here to update your subscriptions</td>	
    </tr>			
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">Mail format</th>
	  <th align="left" width="700">Use [sitename] [livesite] [subject] [username] [subscribeto] [verifylink]</th><th width="50%"></th>
    </tr>
    <tr class="row0"> 
			<td valign="top">HTML<br><br>
            
            <input type="button" id="viewverifymailHTML" value=" view " onclick="displayHTML(this.form.verifymailHTML.value,'<?php echo JURI::root(); ?>',
			this.form.vmsubject.value,this.form.vmchosencat.value,this.form.vmlinktext.value,'<?php echo addslashes($mainframe->getCfg('sitename')); ?>','','','','','','','','','','Close','User Name','','','')"></td>
			
            <td valign="top"><textarea name="verifymailHTML" id="verifymailHTML" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($verifymailHTML); ?></textarea></td>
            
            <td valign="top">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[livesite]</b> Url of Joomla! site, use when including pictures or links<br>
	<b>[subject]</b> The subject from above<br>
	<b>[username]</b> Name of the recipient<br>
	<b>[subscribeto]</b> Either "Chosen cats" or "No chosen cats" from above depending on users choice<br>
	<b>[verifylink]</b> Link text from above (must be included)<br>
	    </td>
    </tr>
    <tr class="row1"> 
			<td valign="top">Plain text<br><br>
            
            <input type="button" id="viewverifymailtext" value=" view " onclick="displayText(this.form.verifymailText.value,'<?php echo JURI::root(); ?>',
			this.form.vmsubject.value,this.form.vmchosencat.value,this.form.vmlinktext.value,'<?php echo addslashes($mainframe->getCfg('sitename')); ?>','','','','','','','','','','Close','User Name','','','')"></td>
			
            <td valign="top"><textarea name="verifymailText" id="verifymailText" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($verifymailText); ?></textarea></td>
            
            <td valign="top">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[livesite]</b> Url of Joomla! site, use when including pictures or links<br>
	<b>[subject]</b> The subject from above<br>
	<b>[username]</b> Name of the recipient<br>
	<b>[subscribeto]</b> Either "Chosen cats" or "No chosen cats" from above depending on users choice<br>
	<b>[verifylink]</b> Link text from above (must be included)<br>
	    </td>
    </tr>
  </table>  
	<?php
    echo $vnmtabs->endPanel();	
	echo $vnmtabs->startPanel("News Mails","News Mails-page");
	$truncatelist=JHTML::_('select.genericlist',$truncatearray, 'usereadmore', 'class="inputbox" size="1"', 'value', 'text', $usereadmore);
	?> 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">Receiver e-mail</th>
	  <th align="left">In case throttling is disabled all news will be sent to this address. Subscribers will be
        added as bcc-copy. If left blank the Joomla! Mail From address will be 
        used</th>
    </tr>	
    <tr class="row0"> 
	  <td>Receiver e-mail address</td>
            <td><input name="receiveremail" type="text" value="<?php echo $receiveremail; ?>" size="60"></td>	
    </tr>
  </table> 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">Mail from address</th>
	  <th align="left">If left blank the Joomla! Mail From address will be used</th>
    </tr>	
    <tr class="row0"> 
	  <td>Mail from address</td>
            <td><input name="mailfromaddress" type="text" value="<?php echo @$mailfromaddress; ?>" size="60"></td>	
    </tr>
  </table>      	 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">"Read more..." link
	  </th>
	  <th align="left">Truncate text in news mails and replace it with a "read 
        more..." link</th>
    </tr>
    <tr class="row0"> 
	  <td>Select truncation</td>
            <td><?php echo $truncatelist; ?>
      </td>	
    </tr>    
    <tr class="row1"> 
	  <td>Truncate news text after</td>
            <td><input name="readmoretruncate" type="text" value="<?php echo $readmoretruncate; ?>" size="4" maxlength="4"> characters</td>	
    </tr>
    <tr class="row0"> 
	  <td>Read more link text</td>
            <td><input name="readmoretext" type="text" value="<?php echo $readmoretext; ?>" size="60">
        i.e. Read more...</td>	
    </tr>	
  </table>  
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">Unsubscribe all link</th>
	  <th align="left">&nbsp;</th>
    </tr>
    <tr class="row0"> 
	  <td>Unsubscribe all link text</td>
            <td><input name="unsubscribealltext" type="text" value="<?php echo $unsubscribealltext; ?>" size="60">
        i.e. Click here to end all Your subscriptions</td>	
    </tr>
  </table>    
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th align="left" width="150">Sidebar modules</th>
	  <th align="left">i.e. Latest news or Most Read</th>
    </tr>
    <tr class="row0"> 
	<td>Module 1</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule1.','.@$sidebarmoduleid1 ); ?>
        </td>
	</tr>
    <tr class="row1">
	<td>Module 2</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule2.','.@$sidebarmoduleid2 ); ?>
        </td>
    </tr>
    <tr class="row0">
	<td>Module 3</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule3.','.@$sidebarmoduleid3 ); ?>
        </td>
    </tr>
    <tr class="row1">
	<td>Module 4</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule4.','.@$sidebarmoduleid4 ); ?>
        </td>
    </tr>
    <tr class="row0">
	<td>Module 5</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule5.','.@$sidebarmoduleid5 ); ?>
        </td>
    </tr>
    <tr class="row1">
	<td>Module 6</td>
        <td>
        <?php echo JHTML::_('select.genericlist', $moduleoptions, "module_id[]", 'size="1"', 'value', 'text', @$sidebarmodule6.','.@$sidebarmoduleid6 ); ?>
        </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">Subject</th>
	  <th align="left"  width="700">Use [sitename] [livesite] [title] [categoryname] [senddate] [sendtime]</th><th width="50%" align="left">Default is [sitename] / [title]</th>
    </tr>
    <tr class="row0"> 
			<td valign="top">Subject (No HTML)<br><br></td>
            <td valign="top"><input type="textbox" name="newsmailsubject" id="newsmailsubject" size="60" value="<?php echo @stripslashes($newsmailsubject); ?>" /></td>
            <td valign="top">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[livesite]</b> Url of Joomla! site, use when including pictures or links<br>
	<b>[title]</b> Title of news item (will be compilation title in case of compiled newsletter)<br>
	<b>[categoryname]</b> Name of category<br>
	<b>[senddate]</b> Date newsletter is sent<br>
	<b>[sendtime]</b> Time newsletter is sent<br>
	    </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th align="left" width="150">Mail format</th>
	  <th align="left" width="700">Use [sitename] [livesite] [title] [introtext] [bodytext] [categoryname] [senddate] [sendtime] [unsubscribeall] [moduletitle#] [modulecontent#] [username] [author] [publishdatetime]</th><th width="50%"></th>
    </tr>
    <tr class="row0"> 
			<td valign="top">HTML<br><br><input type="button" id="viewnewsmailHTML" value=" view " onclick="displayHTML(this.form.newsmailHTML.value,'<?php echo JURI::root(); ?>',this.form.newsmailsubject.value,'','',
			'<?php echo addslashes($mainframe->getCfg('sitename')); ?>',this.form.readmoretext.value,this.form.usereadmore.value,this.form.readmoretruncate.value,moduletitle(0),
			moduletitle(1),moduletitle(2),moduletitle(3),moduletitle(4),moduletitle(5),'Close','User Name',this.form.unsubscribealltext.value,'','')"></td>
			
            <td valign="top"><textarea name="newsmailHTML" id="newsmailHTML" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($newsmailHTML); ?></textarea></td>
            
            <td valign="top">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[livesite]</b> Url of Joomla! site, use when including pictures or links<br>
	<b>[title]</b> Title of news item (will be compilation title in case of compiled newsletter)<br>
	<b>[introtext]</b> Introtext of news item (will be compilation introtext in case of compiled newsletter)<br>
	<b>[bodytext]</b> Bodytext of news item (will be all news items in case of compiled newsletter)<br>
	<b>[categoryname]</b> Name of category<br>
	<b>[senddate]</b> Date newsletter is sent<br>
	<b>[sendtime]</b> Time newsletter is sent<br>
	<b>[unsubscribeall]</b> The unsubscribe all link from above<br>
	<b>[moduletitle#]</b> Title of incuded module from above (replace # with actual number)<br>
	<b>[modulecontent#]</b> Content of incuded module from above (replace # with actual number)<br>
	<b>[username]</b> Name of recipient (only available with throttling enabled)<br>
	<b>[author]</b> Author of news item (will be ignored in compiled newsletters)<br>
        <b>[publishdatetime]</b> Date and time of news item (will be ignored in compiled newsletters)<br>
	    </td>
    </tr>
    <tr class="row1"> 
			<td valign="top">Plain text<br><br><input type="button" id="viewnewsmailtext" value=" view " onclick="displayText(this.form.newsmailText.value,'<?php echo JURI::root(); ?>',
			this.form.newsmailsubject.value,'','','<?php echo addslashes($mainframe->getCfg('sitename')); ?>',this.form.readmoretext.value,this.form.usereadmore.value,this.form.readmoretruncate.value,moduletitle(0),
			moduletitle(1),moduletitle(2),moduletitle(3),moduletitle(4),moduletitle(5),'Close','User Name',this.form.unsubscribealltext.value,'','')"></td>
			
            <td valign="top"><textarea name="newsmailText" id="newsmailText" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($newsmailText); ?></textarea></td>
            
            <td valign="top">The following placeholders can be included:<br>
	<b>[sitename]</b> Name of Joomla! site<br>
	<b>[livesite]</b> Url of Joomla! site, use when including pictures or links<br>
	<b>[title]</b> Title of news item (will be compilation title in case of compiled newsletter)<br>
	<b>[introtext]</b> Introtext of news item (will be compilation introtext in case of compiled newsletter)<br>
	<b>[bodytext]</b> Bodytext of news item (will be all news items in case of compiled newsletter)<br>
	<b>[categoryname]</b> Name of category<br>
	<b>[senddate]</b> Date newsletter is sent<br>
	<b>[sendtime]</b> Time newsletter is sent<br>
	<b>[unsubscribeall]</b> The unsubscribe all link from above<br>
	<b>[moduletitle#]</b> Title of incuded module from above (replace # with actual number)<br>
	<b>[modulecontent#]</b> Content of incuded module from above (replace # with actual number)<br>	
	<b>[username]</b> Name of recipient (only available with throttling enabled)<br>
	<b>[author]</b> Author of news item (will be ignored in compiled newsletters)<br>
        <b>[publishdatetime]</b> Date and time of news item (will be ignored in compiled newsletters)<br>
	    </td>
    </tr>
    <tr class="row0"> 
			<td valign="top">Strip mambots</td>
            <td valign="top"><input type="textbox" name="stripmambots" id="stripmambots" size="60" value="<?php echo @$stripmambots; ?>" /></td>
            <td valign="top">i.e. {slide}{video} Will remove the mambot code from the newsletters including code between open- and close tags.
	    </td>
    </tr>        
  </table>  
	
  <?php
    echo $vnmtabs->endPanel();	
	echo $vnmtabs->startPanel("Compiled News","Compiled Mails-page");
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
	
	$compiledtruncatelist=JHTML::_('select.genericlist',$truncatearray, 'compiledusereadmore', 'class="inputbox" size="1"', 'value', 'text', $compiledusereadmore);
	?>
  <font color="#FF0000"><strong>Compiled news will replace the bodytext in the 
  ordinary news mail format. The title and introtext for each category can be 
  edited at the content tab.</strong></font> 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left"> "Read more..." link in compiled news mails
	  </th>
	  <th align="left">Truncate all news texts in compiled news mails and replace 
        it with a "read more..." link</th>
    </tr>
    <tr class="row0"> 
	  <td width="150">Select truncation</td>
            <td><?php echo $compiledtruncatelist; ?>
    </tr>    
    <tr class="row1"> 
	  <td width="150">Truncate texts in compiled news mails after</td>
            <td><input name="compiledreadmoretruncate" type="text" value="<?php echo $compiledreadmoretruncate; ?>" size="4" maxlength="4">
        characters</td>	
    </tr>
    <tr class="row0"> 
	  <td width="150">Read more link text</td>
            <td><input name="compiledreadmoretext" type="text" value="<?php echo $compiledreadmoretext; ?>" size="60">
        i.e. Read more...</td>	
    </tr>    
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th align="left" width="150">News item format</th>
	  <th align="left" width="700">Use [title] [introtext] [bodytext] [publishdatetime] [author]
        (leave blank to use default)</th>
		
      <th align="left" width="50%"> i.e.</th>
    </tr>
    <tr class="row0"> 
			<td valign="top">HTML<br><br>
        <input name="button" type="button" id="button3" onClick="displayHTML(this.form.newsmailHTML.value,'<?php echo JURI::root(); ?>',this.form.newsmailsubject.value,'','',
			'<?php echo addslashes($mainframe->getCfg('sitename')); ?>',this.form.compiledreadmoretext.value,this.form.compiledusereadmore.value,this.form.compiledreadmoretruncate.value,moduletitle(0),
			moduletitle(1),moduletitle(2),moduletitle(3),moduletitle(4),moduletitle(5),'Close','User Name',this.form.unsubscribealltext.value,this.form.compilednewsmailHTML.value,1)" value=" view "> 
      </td>
            <td valign="top"><textarea name="compilednewsmailHTML" id="compilednewsmailHTML" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($compilednewsmailHTML); ?></textarea></td>
			
      <td valign="top"><p>&lt;table bgcolor=&quot;#EEEEEE&quot; width=&quot;100%&quot;&gt;<br>
          &lt;tr&gt;<br>
          &lt;td&gt;<br>
          &lt;font size=&quot;-1&quot;&gt;&lt;strong&gt;[title]&lt;/strong&gt;<br>
          &lt;font color=&quot;#555555&quot;&gt; (by [author], published [publishdatetime])&lt;/font&gt;&lt;br&gt;<br>
          &lt;em&gt;[introtext]&lt;/em&gt;&lt;br&gt;<br>
          [bodytext]&lt;/font&gt;<br>
          &lt;/td&gt;<br>
          &lt;/tr&gt;<br>
          &lt;/table&gt;&lt;br&gt; <br>
            <br>The following placeholders can be included:<br>
	<b>[title]</b> Title of news item<br>
	<b>[introtext]</b> Introtext of news item<br>
	<b>[bodytext]</b> Bodytext of news item<br>
	<b>[author]</b> Author of news item <br>
        <b>[publishdatetime]</b> Date and time of news item <br>
        </td>
    </tr>
    <tr class="row1">

      <td valign="top"><p>Plain text<br>
          <br>
          <input name="button2" type="button" id="button2" onclick="displayText(this.form.newsmailText.value,'<?php echo JURI::root(); ?>',
			this.form.newsmailsubject.value,'','','<?php echo addslashes($mainframe->getCfg('sitename')); ?>',this.form.compiledreadmoretext.value,this.form.compiledusereadmore.value,this.form.compiledreadmoretruncate.value,moduletitle(0),
			moduletitle(1),moduletitle(2),moduletitle(3),moduletitle(4),moduletitle(5),'Close','User Name',this.form.unsubscribealltext.value,this.form.compilednewsmailText.value,1)" value=" view ">
        </p>
        </td>
            <td valign="top"><textarea name="compilednewsmailText" id="compilednewsmailText" cols="100" rows="15" wrap="OFF"><?php echo stripslashes($compilednewsmailText); ?></textarea></td>

      <td valign="top"><p>[title] (by [author], published [publishdatetime])<br>
          [introtext]<br>
          [bodytext]<br>
          _______________________________________________________________<br>
          <br>
          <br>
        </p>
            The following placeholders can be included:<br>
	<b>[title]</b> Title of news item<br>
	<b>[introtext]</b> Introtext of news item<br>
	<b>[bodytext]</b> Bodytext of news item<br>
	<b>[author]</b> Author of news item <br>
        <b>[publishdatetime]</b> Date and time of news item <br>
        </td>
    </tr>
  </table>
	<?php
    echo $vnmtabs->endPanel();	
	echo $vnmtabs->startPanel("Frontend","Frontend-page");
	?>    
  <?php
  	$acl=&JFactory::getACL();

	$gtree = array(
	JHTML::_('select.option', 0, '- All User Groups -' )
	);
	// get list of groups
	$lists = array();
	$gtree = array_merge( $gtree, $acl->get_group_children_tree( null, 'USERS', false ) );
	$lists['preview'] = JHTML::_('select.genericlist', $gtree, 'preview_group', 'size="10"', 'value', 'text', $previewusers );
	$lists['mail'] = JHTML::_('select.genericlist', $gtree, 'mail_group', 'size="10"', 'value', 'text', $mailusers );	
	
	$popupstyles=array(
			JHTML::_('select.option',0,'Lightbox style'),
            JHTML::_('select.option',1,'Popup style')
            );
	$popupselect = JHTML::_('select.genericlist', $popupstyles, 'popupstyle', 'size="1"', 'value', 'text', @$popupstyle );
	
	$archivestyles=array(
            JHTML::_('select.option',0,'Everybody'),
            JHTML::_('select.option',1,'Registered users'),
            JHTML::_('select.option',2,'Subscribers')
            );
	$archiveselect = JHTML::_('select.genericlist', $archivestyles, 'archiveusers', 'size="1"', 'value', 'text', @$archiveusers );
    
    $arciveformatarray=array();

    $arciveformatarray[]    =JHTML::_('select.option','0', 'All formats');
    $arciveformatarray[]    =JHTML::_('select.option','1', 'HTML');
    $arciveformatarray[]    =JHTML::_('select.option','2', 'Text');    
    
    $archiveformatlist=JHTML::_('select.genericlist',$arciveformatarray, 'archiveformat', 'class="inputbox" size="1"', 'value', 'text', @$archiveformat);	
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="200" align="left">Preview and archive view style</th>
			<th width="200" align="left"></th>
			<th></th>
		</tr>	
		<tr class="row0">
			<td>Preview style</td>		
			<td>			
			<?php echo $popupselect; ?>
			</td>
			<td>
			</td>
		</tr>	
	</table>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="200" align="left">Section/category select style</th>
			<th width="200" align="left"></th>
			<th></th>
		</tr>    
    <tr class="row0">
      <td >Show categories as sub nodes</td>
		<td align="left"><input type="checkbox" name="frontendtree" value="1" <?php
			echo (@$frontendtree==1) ? 'checked':'';
			?> /> Will show categories as expandable sub nodes to sections</td><td></td>
    </tr>      
	</table>    	
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
		    <th width="200" align="left">User access</th>
			<th width="200" align="left">Who can preview</th>
			<th width="200" align="left">Who can trigger mailings</th>
			<th></th>
		</tr>	
		<tr class="row0">
		    <td></td>
			<td>
			<?php echo $lists['preview']; ?>
			</td>
			<td>
			<?php echo $lists['mail']; ?>
			</td>
			<td>
			</td>			
		</tr>	
	</table>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="200" align="left">Archive</th>
			<th align="left"></th>
		</tr>	
		<tr class="row0">
		    <td>Number of items</td>
			<td>
			<input type="textbox" name="archiveitems" size="2" value="<?php echo @$archiveitems; ?>" /> 0 or blank disables archive
			</td>
		</tr>
		<tr class="row1">
		    <td>Archive caption</td>
			<td>
			<input type="textbox" name="archivename" size="60" value="<?php echo @$archivename; ?>" /> i.e. Newsletter Archive
			</td>
		</tr>	
		<tr class="row0">
		    <td>Who can see archive?</td>
			<td>
			<?php echo $archiveselect; ?>
			</td>
		</tr>	
		<tr class="row1">
		    <td>Show newsletter format</td>
			<td>
			<?php echo $archiveformatlist; ?> Show only newsletters in this format
			</td>
		</tr>
		<tr class="row0">
		    <td>Item text (HTML allowed)</td>
			<td>
			<input type="textbox" name="archiveitemtext" size="60" value="<?php echo @$archiveitemtext; ?>" /> Use<b> [subject] [senddate] [sendtime] [usercount] [mailformat] </b> i.e. &lt;b&gt;[subject]&lt;/b&gt;. Newsletter from [senddate] in [mailformat]-format. Sent to [usercount] users.
			</td>
		</tr>	        	                	
	</table>	
	
	<?php
	   $usersConfig = &JComponentHelper::getParams( 'com_users' );
	   if ($usersConfig->get( 'allowUserRegistration' ))
	   {
	   ?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="200" align="left">User registration</th>
			<th align="left">Show a link to the registration page at component frontpage</th>
		</tr>	
		<tr class="row0">
		    <td>Registration menu URL</td>
			<td>
			<input type="textbox" name="registerurl" size="60" value="<?php echo @$registerurl; ?>" /> i.e. "index.php?option=com_user&task=register" (Leave blank to disable) 
			</td>
		</tr>
    </table>
    <?php       
       }
    echo $vnmtabs->endPanel();	  
	echo $vnmtabs->startPanel("Log","Log-page");
	?>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">Log</th>
		<th align="left">Failed mailings and throttled items are stored in the log so dont make it too small</th>
    </tr>
	  <tr class="row0">	  
	  <td>Limit latest mailings log to</td>
      <td><input name="logsize" type="text" value="<?php echo $logsize; ?>" size="3" maxlength="3"> items </td>								  	
    </tr>
  </table>
	<?php
    echo $vnmtabs->endPanel();	
	echo $vnmtabs->endPane();
  	?>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />	
	</form>
<?php		
}

	 function showCPanel($option)
    {
        $database = &JFactory::getDBO();
        ?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "back") {
				submitform( "cancel" );
				return;
			}
			
			submitform( pressbutton );

		}  	
	</script>        
        <form action="index2.php" method="post" name="adminForm">
	   <table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="center" /></td>
		</tr>
	</table> 
    <table width="100%"><tr><td align="center"> 
    <table width="550"><tr><td>
		<table class="adminheading">
		<tr>
			<th class="cpanel">
			Vemod News Mailer Control Panel
			</th>
        </tr>
        <tr>
        <td width="55%" valign="top">
	    	<div id="cpanel">
          <div style="float:left;">
        		<div class="icon">
        			<a href="javascript:submitbutton('configuration');">
        				<div class="iconimage">
        					<img src="<?php echo JURI::root();?>/administrator/images/config.png" alt="Configuration" align="middle" name="image" border="0" />				</div>
        					Configuration</a>
        		</div>
    			</div>
    			
	    		<div style="float:left;">
							<div class="icon">
	        			<a href="javascript:submitbutton('showsubscribers');">
	        				<div class="iconimage">
	        					<img src="<?php echo JURI::root();?>/administrator/images/user.png" alt="Subscribers" align="middle" name="image" border="0" />				</div>
	        					Subscribers</a>
	        		</div>
	    		</div>
	    		
	    		<div style="float:left;">
							<div class="icon">
	        			<a href="javascript:submitbutton('showmaintenance');">
	        				<div class="iconimage">
	        					<img src="<?php echo JURI::root();?>/administrator/images/cpanel.png" alt="Maintenance" align="middle" name="image" border="0" />				</div>
	        					Maintenance</a>
	        		</div>
	    		</div>  
	    		<div style="float:left;">
							<div class="icon">
	        			<a href="javascript:submitbutton('showbackup');">
	        				<div class="iconimage">
	        					<img src="<?php echo JURI::root();?>/administrator/images/backup.png" alt="Backup / Upgrade" align="middle" name="image" border="0" />				</div>
	        					Backup / Upgrade</a>
	        		</div>
	    		</div>  	
		</div>
		</td>
        </tr>
        </table>
        </td></tr></table>
        </td></tr></table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
        </form>
        <?php
    }
    
function showBackup($option)
{
	?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "back") {
				submitform( "controlpanel" );
				return;
			}
			
			submitform( pressbutton );

		}  	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Backup / Upgrade</td>
		</tr>		
	</table>    	    
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr> 
      <th width="150" align="left">Database</th>
		<th align="left">Database tables can be backed up and restored into /administrator/backups. Use this feature when upgrading!</th>
    </tr>
	  <tr class="row0">	  
	  <td>Backup database tables</td>
      <td><input name="submitbackup" type="button" onClick="if (confirm('Make backup? It will overwrite earlier backup')){submitbutton('backup');}else{return;};" value="Backup">  Will attempt to CHMOD the /administrator/backups/ directory</td>								  	
    </tr>
	  <tr class="row1">
	  <td>Restore database tables</td>
      <td><input name="submitrestore" type="button" onClick="if (confirm('Restore?')){submitbutton('restore');}else{return;};" value="Restore"></td>								  	
    </tr>
	  <tr class="row0">
	  <td></td><td>
<b>Upgrade procedure:</b><br><br>

* In current version: If any newsletters are visible at the frontend "preview", send them. If throttling is enabled, make sure all chunks has been sent by looking at the frontend log. Backup the database here at this tab. Make sure it succeeds.<br>
* Uninstall current version completely and install a higher version.<br>
* In new version: restore the database here at this tab.<br><br>

There are 2 things to consider after an upgrade:<br><br>

* If "Use scheduled news scans" was on before the upgrade it must be selected again. This is disabled on uninstall to preserve the template file.<br>
* "Last scan time" is not backed up. Dont publish any news until upgrade is complete. <br>


</td>
</tr>
  </table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	</form>
	<?php
}        

function showMaintenance($option)
{
	?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "back") {
				submitform( "controlpanel" );
				return;
			}
			
			submitform( pressbutton );

		}  	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Maintenance</td>
		</tr>		
	</table>    	
	<font color="#FF0000"><strong>Please make a backup before using these tools!</strong></font>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="150" align="left">Invalid emails</th>
		<th align="left">Invalid email addresses can slow down mailings.</th>
    </tr>
	  <tr class="row0">
	  <td>Search for invalid addresses</td>
      <td><input name="submitemailscan" type="button" onClick="javascript:submitbutton('emailscan')" value="Scan emails"> This will search the users table. Users with invalid emails might not be subscibers</td>
    </tr>
	  <tr class="row1">
	  <td>Clean subscribers table</td>
      <td><input name="submitcleanemail" type="button" onClick="if (confirm('Clean out invalid email addresses?')){submitbutton('cleanemail');}else{return;};" value="Clean table"> This will search the users table. Users with invalid emails might not be subscibers (but if they are they will be removed from the subscribers table)</td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="150" align="left">Ex-members</th>
		<th align="left">Users that are no longer members of the site takes space and can slow down mailings.</th>
    </tr>
	  <tr class="row0">
	  <td>Search for ex-members</td>
      <td><input name="submitexpiredscan" type="button" onClick="javascript:submitbutton('scanexpired')" value="Scan ex-members"> This will search the subscribers table. </td>
    </tr>
	  <tr class="row1">
	  <td>Clean subscribers table</td>
      <td><input name="submitcleanexpired" type="button" onClick="if (confirm('Clean out expired users?')){submitbutton('cleanexpired');}else{return;};" value="Clean table"> This will search the subscribers table. Users that are no longer members will be removed</td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="150" align="left">Unused categories</th>
		<th align="left">Categories that are no longer available for subscription takes space and can slow down mailings. Please save config first.</th>
    </tr>
	  <tr class="row0">
	  <td>Search for unused categories</td>
      <td><input name="submitscancategories" type="button" onClick="javascript:submitbutton('scancategories')" value="Scan unused categories"> This will search the subscribers table. </td>
    </tr>
	  <tr class="row1">
	  <td>Clean subscribers table</td>
      <td><input name="submitcleancategories" type="button" onClick="if (confirm('Clean out unused categories')){submitbutton('cleancategories');}else{return;};" value="Clean table"> This will search the subscribers table. Unused categories will be removed</td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="150" align="left">One click maintenance</th>
		<th align="left">Do all of the above db table cleanings.</th>
    </tr>
	  <tr class="row0">
	  <td>One click maintenance</td>
      <td><input name="submitoneclick" type="button" onClick="if (confirm('Clean subscribers table from invalid email addresses, expired users and unused categories?')){submitbutton('oneclick');}else{return;};" value="Maintenance"> This will clean the subscribers table from invalid email addresses, ex-users and unused categories. </td>
    </tr>
  </table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	</form>
	<?php
}

function showCategory($option) {
	$database = &JFactory::getDBO();
       $category=JRequest::getVar( 'editcatid' );	
	//$category=explode('editcategory',$task);
	//$category= $category[1];
	$database->setQuery("SELECT #__users.* FROM #__users,#__vemod_news_mailer_subs WHERE #__users.id=#__vemod_news_mailer_subs.userid AND #__vemod_news_mailer_subs.catid=$category ORDER BY #__users.name");
	$subscribersarray=$database->loadObjectList();
	$database->setQuery("SELECT #__users.* FROM #__users LEFT JOIN  #__vemod_news_mailer_subs ON #__users.id=#__vemod_news_mailer_subs.userid AND #__vemod_news_mailer_subs.catid=$category WHERE #__vemod_news_mailer_subs.userid IS NULL ORDER BY #__users.name");
	$notsubscribersarray=$database->loadObjectList();
	
	if ($category > 0)
	{
		$database->setQuery("SELECT title FROM #__categories WHERE id=$category AND published=1");
		$title='&quot;'.$database->loadResult().'&quot; (Category)';							
	}
	else
	{
		$secid=-($category);
		$database->setQuery("SELECT title FROM #__sections WHERE id=$secid AND published=1");
		$title='&quot;'.$database->loadResult().'&quot; (Section)';							
	}		

  $usersoptions=array();
  if (count($subscribersarray))
  {
      foreach ($subscribersarray as $user)
      {
        if (JMailHelper::isEmailAddress($user->email ))
        {
            $usersoptions[]=JHTML::_('select.option',$user->id,$user->name.' / '.$user->email);
        }
      }
  }
  unset ($subscribersarray);

  $notusersoptions=array();
  if (count($notsubscribersarray))
  {
      foreach ($notsubscribersarray as $user)
      {
        if (JMailHelper::isEmailAddress($user->email ))
        {
            $notusersoptions[]=JHTML::_('select.option',$user->id,$user->name.' / '.$user->email);
        }
      }
  }
  unset ($notsubscribersarray);
  	
    $usersselect = JHTML::_('select.genericlist', $usersoptions, 'usersselect[]', 'size="24" class="inputbox" multiple="multiple" WIDTH="300" STYLE="width: 300px"', 'value', 'text', '' );
    $notusersselect = JHTML::_('select.genericlist', $notusersoptions, 'notusersselect[]', 'size="24" class="inputbox" multiple="multiple" WIDTH="300" STYLE="width: 300px"', 'value', 'text', '' );    
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( "showsubscribers" );
				return;
			}
            if (pressbutton == "apply") {
                selectAllOptions('usersselect[]');
				submitform( "savecategory" );
				return;
			}			
			submitform( pressbutton );

		}
        function moveOptions(fromname,toname)
        {
            var from=document.getElementsByName(fromname)[0];
            var to=document.getElementsByName(toname)[0];            
            var selIndex = from.selectedIndex;
              if (selIndex != -1) 
              {
                for(i=from.length-1; i>=0; i--)
                {
                  if(from.options[i].selected)
                  {                 
                    to.options[to.length] = new Option(from.options[i].text, from.options[i].value);
                    from.options[i] = null;
                  }
                }
                if (from.length > 0) 
                {
                  from.selectedIndex = - 1;
                }
              }
            sortSelect(to);
        }
        function compareText (option1, option2) {
          return option1.text < option2.text ? -1 :
            option1.text > option2.text ? 1 : 0;
        }
        function sortSelect (select) {
          var options = new Array (select.options.length);
          for (var i = 0; i < options.length; i++)
            options[i] = 
              new Option (
                select.options[i].text,
                select.options[i].value,
                select.options[i].defaultSelected,
                select.options[i].selected
              );
          options.sort(compareText);
          select.options.length = 0;
          for (var i = 0; i < options.length; i++)
            select.options[i] = options[i];
        }
        function selectAllOptions(selStr)
        {
          var selObj=document.getElementsByName(selStr)[0];
          for (var i=0; i<selObj.options.length; i++) {
            selObj.options[i].selected = true;
          }
        }  
          	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center"><?php echo $title; ?> subscribers</td>
		</tr>		
	</table>
	<font color="#FF0000"><strong>Please make a backup before using these tools!</strong></font>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">	
    <tr>
      <th width="150" align="left">Manage subscribers</th>
		<th align="left"><?php echo $title; ?></th>
    </tr>  
	  <tr class="row0">
	  <td valign="top" width="150">Move registered users to the subscriber list or remove subscribers from the subscriber list back to the user list</td>
      <td><table><tr><td valign="bottom">Registered users<br><?php echo $notusersselect; ?><br>
      <input type="button" value="Select all"onclick="selectAllOptions('notusersselect[]');" />
      </td><td align="left" valign="middle">
      <input type="button" value=" < "onclick="moveOptions('usersselect[]', 'notusersselect[]');" /><br>
      <input type="button" value=" > "onclick="moveOptions('notusersselect[]','usersselect[]');" />
      </td><td valign="bottom" align="left">Subscribers to <?php echo $title; ?><br><?php echo $usersselect; ?><br>
      <input type="button" value="Select all"onclick="selectAllOptions('usersselect[]');" />
      </td>
      </tr></table></td>
    </tr>	
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="savecategory" value="<?php echo $category; ?>" />
	</form>
	
  <?php	
}
function showMailFormat($option) {
	$database = &JFactory::getDBO();
	$database->setQuery("SELECT DISTINCT #__users.* FROM #__users,#__vemod_news_mailer_subs WHERE #__users.id=#__vemod_news_mailer_subs.userid ORDER BY #__users.name");
	$usersarray=$database->loadObjectList();
	$database->setQuery("SELECT id FROM #__vemod_news_mailer_users WHERE mailformat=1");
	$textusersarray=$database->loadResultArray();
	
  $usersoptions=array();
  $textusersoptions=array();
  if (count($usersarray))
  {
      foreach ($usersarray as $user)
      {
        if (in_array($user->id,$textusersarray))
        {
            $textusersoptions[]=JHTML::_('select.option',$user->id,$user->name.' / '.$user->email);
        }
        else
        {
            $usersoptions[]=JHTML::_('select.option',$user->id,$user->name.' / '.$user->email);        
        }
      }
  }
  unset ($usersarray);
  unset ($textusersarray);  


  	
    $usersselect = JHTML::_('select.genericlist', $usersoptions, 'usersselect[]', 'size="24" class="inputbox" multiple="multiple" WIDTH="300" STYLE="width: 300px"', 'value', 'text', '' );
    $textusersselect = JHTML::_('select.genericlist', $textusersoptions, 'textusersselect[]', 'size="24" class="inputbox" multiple="multiple" WIDTH="300" STYLE="width: 300px"', 'value', 'text', '' );    
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( "showsubscribers" );
				return;
			}
            if (pressbutton == "apply") {
			     selectAllOptions('textusersselect[]');
				submitform( "savemailformat" );
				return;
			}					
			submitform( pressbutton );

		}
        function moveOptions(fromname,toname)
        {
            var from=document.getElementsByName(fromname)[0];
            var to=document.getElementsByName(toname)[0];            
            var selIndex = from.selectedIndex;
              if (selIndex != -1) 
              {
                for(i=from.length-1; i>=0; i--)
                {
                  if(from.options[i].selected)
                  {                 
                    to.options[to.length] = new Option(from.options[i].text, from.options[i].value);
                    from.options[i] = null;
                  }
                }
                if (from.length > 0) 
                {
                  from.selectedIndex = - 1;
                }
              }
            sortSelect(to);
        }
        function compareText (option1, option2) {
          return option1.text < option2.text ? -1 :
            option1.text > option2.text ? 1 : 0;
        }
        function sortSelect (select) {
          var options = new Array (select.options.length);
          for (var i = 0; i < options.length; i++)
            options[i] = 
              new Option (
                select.options[i].text,
                select.options[i].value,
                select.options[i].defaultSelected,
                select.options[i].selected
              );
          options.sort(compareText);
          select.options.length = 0;
          for (var i = 0; i < options.length; i++)
            select.options[i] = options[i];
        }
        function selectAllOptions(selStr)
        {
          var selObj=document.getElementsByName(selStr)[0];
          for (var i=0; i<selObj.options.length; i++) {
            selObj.options[i].selected = true;
          }
        }  
          	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Subscribers Mail format</td>
		</tr>		
	</table>
	<font color="#FF0000"><strong>Please make a backup before using these tools!</strong></font>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">	
    <tr>
      <th width="150" align="left">Manage subscribers mail format</th>
		<th align="left"></th>
    </tr>  
	  <tr class="row0">
	  <td valign="top" width="150">Move HTML subscribers to the text subscriber list or remove subscribers from the text subscriber list back to the HTML subscriber list</td>
      <td><table><tr><td valign="bottom">HTML subscribers<br><?php echo $usersselect; ?><br>
      <input type="button" value="Select all"onclick="selectAllOptions('usersselect[]');" />
      </td><td align="left" valign="middle">
      <input type="button" value=" < "onclick="moveOptions('textusersselect[]', 'usersselect[]');" /><br>
      <input type="button" value=" > "onclick="moveOptions('usersselect[]','textusersselect[]');" />
      </td><td valign="bottom" align="left">text subscribers<br><?php echo $textusersselect; ?><br>
      <input type="button" value="Select all"onclick="selectAllOptions('textusersselect[]');" />
      </td>
      </tr></table></td>
    </tr>	
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="savemailformat" value="1" />
	</form>
	
  <?php	
}

function showSMSDetails($option)
{
	$database = &JFactory::getDBO();
	$database->setQuery("SELECT #__users.*,#__vemod_news_mailer_users.metatags FROM #__users LEFT JOIN #__vemod_news_mailer_users ON #__users.id=#__vemod_news_mailer_users.id WHERE #__vemod_news_mailer_users.id IS NULL OR #__users.id=#__vemod_news_mailer_users.id ORDER BY #__users.name");	
	$usersarray=$database->loadObjectList();
	$database->setQuery("SELECT DISTINCT #__users.id FROM #__users,#__vemod_news_mailer_subs WHERE #__users.id=#__vemod_news_mailer_subs.userid ORDER BY #__users.name");
	$idsarray=$database->loadResultArray();

  $usersoptions=array();
  if (count($usersarray))
  {
      foreach ($usersarray as $user)
      {
          if (in_array($user->id,$idsarray))
          {
            $usersoptions[]=JHTML::_('select.option',$user->id.','.$user->metatags,$user->name.' / '.$user->email);
          }
      }
  }
  unset ($usersarray);
  unset ($idsarray);  	
  	
    $usersselect = JHTML::_('select.genericlist', $usersoptions, 'usersselect[]', 'size="24" class="inputbox" WIDTH="300" STYLE="width: 300px" onclick="showOption();" onkeyup="showOption();"', 'value', 'text', '' );   
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( "showsubscribers" );
				return;
			}
            if (pressbutton == "apply") {
			     selectAllOptions('usersselect[]');
				submitform( "savesmsdetails" );
				return;
			}					
			submitform( pressbutton );

		}
        function showOption()
        {
            var from=document.getElementsByName('usersselect[]')[0];
            var to=document.getElementsByName('smsdetails')[0];
            var userid=document.getElementsByName('userid')[0];                       
            var selIndex = from.selectedIndex;
            var selvalue=from.options[selIndex].value;
            var temp = new Array();
            temp = selvalue.split(',');
            userid.value=temp[0];
	        to.value = temp[1];          
        }
        function submitOption()
        {
            var from=document.getElementsByName('usersselect[]')[0];
            var to=document.getElementsByName('smsdetails')[0];
            var userid=document.getElementsByName('userid')[0];                       
            var selIndex = from.selectedIndex;
            var temp=userid.value+','+to.value;
            from.options[selIndex].value=temp;
        }        
        function selectAllOptions(selStr)
        {
          var selObj=document.getElementsByName(selStr)[0];
          selObj.multiple=true;
          for (var i=0; i<selObj.options.length; i++) {
            selObj.options[i].selected = true;
          }
        }  
        function selectFirstOption(selStr)
        {
          var selObj=document.getElementsByName(selStr)[0];
          if (selObj.options.length)
          {
            selObj.options[0].selected = true; 
            showOption(); 
          }
        }  
          	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Subscribers SMS details</td>
		</tr>		
	</table>
	<font color="#FF0000"><strong>Please make a backup before using these tools!</strong></font>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">	
    <tr>
      <th width="150" align="left">Manage subscribers sms details</th>
		<th align="left"></th>
    </tr>  
	  <tr class="row0">
	  <td valign="top" width="150">Select subscribers and edit thier sms details</td>
      <td><table><tr><td valign="top">Subscribers<br><?php echo $usersselect; ?>
      </td>
      <td valign="top" align="left">Edit details<br><input typt="textbox" name="smsdetails" size="60" value="">
      <input type="button" value="Submit" onclick="submitOption();" />
      </td>
      </tr></table></td>
    </tr>	
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="userid" value="" />
	<input type="hidden" name="savesmsdetails" value="1" />
	</form>
	
  <?php	
			echo "<script language=\"JavaScript\">";
			echo "selectFirstOption('usersselect[]');";
			echo "</script>";  
}

function showSubscribers($option) {
	global $mainframe;
	$database = &JFactory::getDBO();
		
	require(JPATH_SITE."/administrator/components/com_vemod_news_mailer/config.vemod_news_mailer.php");

	# Do the main database query
	$database->setQuery( "SELECT * FROM #__categories WHERE (published=1 AND section REGEXP '^[0-9]+$') ORDER BY section, ordering" );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$checked=explode(",",$vmncats);
	
	$database->setQuery( "SELECT * FROM #__sections WHERE published=1 ORDER BY ordering" );
	$srows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$schecked=explode(",",$vmnsecs);
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "back") {
				submitform( "controlpanel" );
				return;
			}
			
			submitform( pressbutton );

		}  	
	</script>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname" align="center"><img src="components/com_vemod_news_mailer/vemod.jpg" align="middle" /></td>
		</tr>
		<tr>
			<td width="100%" class="sectionname" align="center">Manage subscribers</td>
		</tr>		
	</table>
	
  <?php

	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th align="left" width="25">#</th>		
			<th align="left" width="25">Id</th>
			<th align="left" width="25"></th>
			<th width="240" align="left">Categories that allows subscription</th>	
			<th align="left" width="240">Frontend description</th>
			<th align="left" width="80">Subscribers</th>
            <th align="left">Manage subscribers</th>
		</tr>

<?php
		$k = 0;
		$fdescription=unserialize(stripslashes(@$frontdescription));
	
		for($i=0; $i < count( $rows ); $i++) {
			$row = $rows[$i];
			$database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_subs WHERE catid=$row->id");
			$subcount=$database->loadResult();
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+1;?></td>
			<td><?php echo $row->id; ?></td>
			<td>
			<?php
			if (count($checked))
			{
				echo in_array($row->id,$checked,TRUE) ? '<img src="images/publish_g.png" />':'<img src="images/publish_x.png" />'; 
			}
			?>
			</td>
			<td><?php echo $row->title.'&nbsp;&nbsp;&nbsp;(In section: '.sectionTitle($srows,$row).')'; ?></td>
			<td align="left"><?php echo $fdescription[$row->id]; ?>
			</td>
            <td align"center"><?php echo $subcount; ?></td>								
			<td align="left"><input name="editcategory[]" type="button" onClick="this.form.editcatid.value='<?php echo $row->id; ?>';submitbutton('editsubscribers')" value="Subscribers"></td>
		</tr>
<?php
			$k = 1 - $k;
		}
?>
    </table>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="25">#</th>
			<th align="left" width="25">Id</th>
			<th align="left" width="25"></th>			
            <th width="240" align="left">Sections that allows subscription</th>
			<th align="left" width="240">Frontend description</th>
			<th align="left" width="80">Subscribers</th>			
            <th align="left">Manage subscribers</th>												
		</tr>

<?php
		$k = 0;
		$sfdescription=unserialize(stripslashes(@$sfrontdescription));
		for($i=0; $i < count( $srows ); $i++) {
			$row = $srows[$i];
			$negrowid=-$row->id;
			$database->setQuery("SELECT COUNT(*) FROM #__vemod_news_mailer_subs WHERE catid=$negrowid");
			$subcount=$database->loadResult();
			
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+1;?></td>
			<td><?php echo $row->id; ?></td>
			<td>
            <?php 
			if (count($schecked))
			{
				echo in_array($row->id,$schecked,TRUE) ? '<img src="images/publish_g.png" />':'<img src="images/publish_x.png" />'; 
			}
			?>
            </td>
            
             <td><?php echo $row->title; ?></td>
				<td align="left"><?php echo $sfdescription[-($row->id)]; ?>	</td>
            <td align"center"><?php echo $subcount; ?></td>                												
				<td align="left"><input name="editcategory[]" type="button" onClick="this.form.editcatid.value='<?php echo -($row->id); ?>';submitbutton('editsubscribers')" value="Subscribers"></td>                				
		</tr>
<?php
			$k = 1 - $k;
		}

?>
    </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="150" align="left">Add users</th>
		<th align="left">Please backup config first.</th>
    </tr>
	  <tr class="row0">
	  <td>Bulk add users as subscribers</td>
      <td><input name="submitbulkadd" type="button" onClick="if (confirm('Add all users to all categories?')){submitbutton('bulkadd');}else{return;};" value="Bulk add"> Bulk add all users as subscribers to all selected categories. Users with invalid e-mail addresses will not be added.</td>
    </tr>
    </table>    
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">Mail format</th><th align="left">Edit subscribers text or HTML settings</th>
    </tr>
    <tr class="row0">
	  <td>Edit subscribers mail format</td><td><input name="editmailformat" type="button" onClick="submitbutton('editmailformat')" value="Subscribers" <?php if ($mailformat != 2)echo 'disabled="disabled"'; ?> > (Enabled when Mail Format is "User decides")</td>	
    </tr>    					
  </table> 
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="left" width="150">SMS details</th>
	  <th align="left">Edit subscribers SMS settings</th>
    </tr>  
    <tr class="row0">
	  <td>Edit subscribers SMS details</td><td><input name="editsmsdetails" type="button" onClick="submitbutton('editsmsdetails')" value="Subscribers" <?php if (@$smsoperator == '')echo 'disabled="disabled"'; ?> > (Enabled when SMS provider is set)</td>	
    </tr>    					
  </table>       
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />	
    <input type="hidden" name="editcatid" value=""/>	
	</form>
    <?php
}

?>
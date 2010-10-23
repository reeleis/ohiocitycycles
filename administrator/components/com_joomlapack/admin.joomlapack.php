<?php
// Ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

// Restrict back-end access only to Super Administrators
if( !defined('_JEXEC') )
{
	if (!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) {
		mosRedirect( 'index2.php', _NOT_AUTH );
	}
} else {
	// Note: We are checking if someone can 'manage' the 'com_config', which translates to
	// being a super administrator in Joomla! 1.5.0. Most probably this will change in the
	// future and we'll have to supply a real ACL solution.
	$user = & JFactory::getUser();
	if (!$user->authorize('com_config', 'manage')) {
		$mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
	}
}

// 1.1.1b2 - Use constants with absolute paths
global $option;
if( !defined('_JEXEC') )
{
	$option	= mosGetParam( $_REQUEST, 'option',	'com_joomlapack' );
	if ( array_key_exists('mosConfig_asbolute_path', $_REQUEST ) )
	{
		die('Hacking attempt');
	} else {
		global $mosConfig_absolute_path;
		$myBase = $mosConfig_absolute_path;
		
		if (DIRECTORY_SEPARATOR == '\\'){
			// Change potential windows directory separator
			if ((strpos($myBase, '\\') > 0) || (substr($myBase, 0, 1) == '\\')){
				$myBase = strtr($myBase, '\\', '/');
			}
		}
	}
}

// 1.2.1 - Emulate Joomla! 1.5.x JPATH defines for absolute filenames
if( !defined('_JEXEC') ) {
	$myBase = (realpath($myBase) == '') ? $myBase : realpath($myBase); // 1.2a3 -- Rare case when $myBase == '/'
	define( 'DS', DIRECTORY_SEPARATOR );
	define( 'JPATH_SITE', realpath( $myBase ) );
	define( 'JPATH_COMPONENT_ADMINISTRATOR', $myBase.DS.'administrator'.DS.'components'.DS.$option );
	define( 'JPATH_COMPONENT', $myBase.DS.'components'.DS.$option );		
}

// Include Joomla! Version Abstraction Layer
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'frameworkabstraction.php' );

// Include abstract classes definitions
jpimport('classes.abstract.object');
jpimport('classes.abstract.filter');
jpimport('classes.abstract.enginearchiver');
jpimport('classes.abstract.engineparts');

// Get the parameters from the request
global $act, $task;
$act	= JoomlapackAbstraction::getParam('act',	'default');
$task	= JoomlapackAbstraction::getParam('task',	'');

// Some bureaucracy is only useful for non-AJAX calls. For AJAX calls, it's just a waste of CPU and memory :)
if (!JoomlapackAbstraction::isSAJAX()) {
	
	// 1. Get component version from its XML file
	// ------------------------------------------------------------------------
	JoomlapackAbstraction::getJoomlaPackVersion();
	
	// 2. HTML generation library for JoomlaPack's back-end
	// ------------------------------------------------------------------------
	jpimport('helpers.html');
	if( !defined('_JEXEC') ) {
		require_once( $mainframe->getPath( 'admin_html' ) );	
	} else {
		require_once( JApplicationHelper::getPath( 'admin_html' ) );
	}

	// 3. Localisation (language file loading)
	// ------------------------------------------------------------------------
	jpimport('helpers.lang');
}

// Configuration class
jpimport('classes.core.utility.configuration');

// For AJAX calls, some required stuff
if(JoomlapackAbstraction::isSAJAX())
{
	// Set error reporting to something usefull and use a custom error handler
	$JPConfiguration =& JoomlapackConfiguration::getInstance();
	if ( $JPConfiguration->isOutputWriteable() )
	{
		@error_reporting( 0 );
		jpimport('helpers.logger');
		$old_error_handler = set_error_handler("userErrorHandler");
	}
    
	// Load the SAJAX library
    jpimport('helpers.sajax');

    // Oh, yeah... If it ain't act=ajax, we need to tell Joomla! to load admin.joomlpack.html.php...
    if($act != 'ajax')
    {
    	require_once(JPATH_COMPONENT_ADMINISTRATOR . '/admin.joomlapack.html.php');
    }
}

/** handle the task */
switch ($act) {
    case "config":
    	// Configuration screen
    	if (!JoomlapackAbstraction::isSAJAX() && ($task!='save'))
    		echo '<link rel="stylesheet" href="components/'.$option.'/assets/css/jpcss.css" type="text/css" />';
    	switch ($task) {
    		case "apply":
				$configuration =& JoomlapackConfiguration::getInstance();
				$configuration->SaveFromPost();
        		jpackScreens::fConfig();
    			break;
    		case "save":
				$configuration =& JoomlapackConfiguration::getInstance();
				$configuration->SaveFromPost();
				$skipFooter = true;
				$uri = JoomlapackAbstraction::SiteURI().'/administrator/index.php?option='.JoomlapackAbstraction::getParam('option','com_joomlapack');
				$html = JoomlapackLangManager::_('CONFIG_CONT_LINE1').' <a href="'.$uri.'">'.JoomlapackLangManager::_('CONFIG_CONT_LINE2').'</a> '.JoomlapackLangManager::_('CONFIG_CONT_LINE3');
								
				echo <<<ENDSNIPPET
				<script language="Javascript" type="text/javascript">
				window.location="$uri";
				</script>
				<noscript>
				$html
				</noscript>
ENDSNIPPET;
				
        		//jpackScreens::fMain();
    			break;
    		case "cancel":
    			jpackScreens::fMain();
    			break;
    		default:
    			jpackScreens::fConfig();
    			break;
    	}
		break;
		
    case "pack":
    	if (!JoomlapackAbstraction::isSAJAX())
    		echo '<link rel="stylesheet" href="components/'.$option.'/assets/css/jpcss.css" type="text/css" />';
    	// Packing screen - that's where the actual backup takes place
        jpackScreens::fPack();
        break;
        
    case "backupadmin":
        jpackScreens::fBUAdmin();
        if($task == 'downloadfile')
        {
        	$skipFooter = true;
        }
    	break;

	case "def" :
		// Directory exclusion filters
		jpimport('classes.filter.def');
		jpackScreens::fDirExclusion();
		break;
		
	case "dbef" :
		// Database tables exclusion filters
		jpimport('classes.filter.dbef');
		jpackScreens::fDBExclusion();
		break;

    case "ajax":
    	jpimport('helpers.ajaxtool');
    	break;

    case "test":
		jpackScreens::fDebug();
    	break;

    case "log":
		jpackScreens::fLog();
        if(JoomlapackAbstraction::getParam('no_html', 0) == 1)
        {
        	$skipFooter = true;
        }
		break;
    
    case "dllog": // Option to download raw log
    	$JPConfiguration = JoomlapackConfiguration::getInstance();
    	@ob_end_clean(); // In case some braindead mambot spits its own HTML despite no_html=1
    	header('Content-type: text/plain');
    	header('Content-Disposition: attachment; filename="joomlapacklog.txt"');
    	@readfile( JoomlapackAbstraction::TranslateWinPath( $JPConfiguration->get('OutputDirectory').DS.'joomlapack.log' ) );
    	$skipFooter = true;
    	break;

    case "unlock":
		jpackScreens::fUnlock();
    	break;

    case "multidb":
    	jpackScreens::fMultiDB();
    	break;
    	
    case "sff":
    	jpackScreens::fFileExclusion();
    	break;

    case "configmigrate":
    	if($task == 'export')
    	{
    		$skipFooter = true;
    	}
    	jpackScreens::fConfigMigrate();
    	break;
    	
    case "cpanel":
    default:
    	if (!JoomlapackAbstraction::isSAJAX())
    		echo '<link rel="stylesheet" href="components/'.$option.'/assets/css/jpcss.css" type="text/css" />';
    	// Application status check
        jpackScreens::fMain();
        break;
}

// Post-AJAX cleanup
if(JoomlapackAbstraction::isSAJAX())
{
	// Restore error handler
	if( isset($old_error_handler) ) {
		restore_error_handler();
	}
}
else
{
	// Common footer
	if(!isset($skipFooter))
	{
		jpackScreens::CommonFooter();
	}
	
	// PayPal donate on Control Panel
	if($act == 'cpanel')
	{
		?>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<p>
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-butcc-donate.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			</p>
			</form>
		<?php
	}
}

/**
 * Custom PHP error handler, to cope for all those cheapy hosts who won't provide access to the
 * server's error logs. Kudos to the 1&1 how-to section for providing the bulk of this function.
 *
 * @param integer $errno PHP error type number
 * @param string $errmsg The message of the error
 * @param string $filename Script's filename where this error occured
 * @param integer $linenum Script's line number where this error occured
 * @param array $vars The variables passed (?) to the function, or something like that
 */
function userErrorHandler ($errno, $errmsg, $filename, $linenum,  $vars) 
{
	// Get the error type from the error number 
	$errortype = array (1    => "Error",
						2    => "Warning",
						4    => "Parsing Error",
						8    => "Notice",
						16   => "Core Error",
						32   => "Core Warning",
						64   => "Compile Error",
						128  => "Compile Warning",
						256  => "User Error",
						512  => "User Warning",
						1024 => "User Notice",
						2048 => "Strict Notice",
						4096 => "Catchable Fatal Error",
						8192 => "Run-time Deprecated",
						16384 => "User Created Deprecated",
						2047 => "All errors and warnings",
						6143 => "All errors and warnings",
						30719 => "All errors and warnings",
						32767 => "All errors and warnings"
	);
	$errlevel = isset($errortype[$errno]) ? $errortype[$errno] : $errno;

	switch($errno)
	{
		case 1:
		case 4:
		case 16:
		case 64:
		case 256:
			$level = _JP_LOG_ERROR;
			break;
			
		case 2:
		case 128:
		case 512:
			$level = _JP_LOG_DEBUG;
			break;
			
		default:
			return;
			break;
	}
	JoomlapackLogger::WriteLog($level, 'PHP '.$errlevel.' at '.$filename.':'.$linenum.' - '.$errmsg);
}
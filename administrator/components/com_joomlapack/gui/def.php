<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		$Id$
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @since		1.2.1
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

/**
 * The Directory Exclusion Filter management GUI class
 *
 */
class JoomlapackPageDEF
{
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageDEF
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageDEF();
		}
		
		return $instance;
	}

	/**
	 * Displays the HTML for this page, directly outputting it to the browser
	 */
	function echoHTML()
	{
		jpimport('helpers.lang');
		
		// 1.1.1b2 - Oops! This page wouldn't work on at least 1 windows system
		$myRoot = JPATH_SITE;
		$rootArray = explode('\\', $myRoot);
		$myRoot = implode('//', $rootArray);
		
		// Get URL for JavaScript
		$jsURI_pb = JoomlapackAbstraction::SiteURI() . '/administrator/components/' . JoomlapackAbstraction::getParam('option','com_joomlapack') . '/assets/js/xp_progress.js';
		
		// Get some more HTML fragments
		$headingHTML = JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_DEF') );
		
		$this->commonSAJAX();
		
		echo <<<ENDFRAGMENT
			<script language="javascript" src="$jsURI_pb">
				// WinXP Progress Bar- By Brian Gosselin- http://www.scriptasylum.com/
			</script>
			<script language="JavaScript" type="text/javascript">
				/*
				 * (S)AJAX Library code
				 */
ENDFRAGMENT;
		sajax_show_javascript();

		echo <<<ENDFRAGMENT
		 		sajax_fail_handle = SAJAXTrap;
		
				function SAJAXTrap( myData ) {
					alert('Invalid AJAX reponse: ' + myData);
				}
						
				var globRoot;
			
				function ToggleFilter( myRoot, myDir, myID ) {
					var sCheckStatus = (document.getElementById(myID).checked == true) ? "on" : "off";
			
					globRoot = myRoot;
			
					document.getElementById("DEFScreen").style.display = "none";
					document.getElementById("DEFProgressBar").style.display = "block";
			
					x_toggleDirFilter( myRoot, myDir, sCheckStatus, ToggleFilter_cb );
				}
			
				function ToggleFilter_cb( myRet ) {
					dirSelectionHTML( globRoot );
					document.getElementById("DEFScreen").style.display = "block";
					document.getElementById("DEFProgressBar").style.display = "none";
				}
			
				function dirSelectionHTML( myRoot ) {
					globRoot = myRoot;
					x_dirSelectionHTML( myRoot, cb_dirSelectionHTML );
				}
			
				function cb_dirSelectionHTML( myRet ) {
					document.getElementById("DEFScreen").style.display = "block";
					document.getElementById("DEFProgressBar").style.display = "none";
					document.getElementById("DEFOperationList").innerHTML = myRet;
				}
			</script>
			
			<div id="DEFProgressBar" style="display:none;" class="sitePack">
				<h4>Please wait...</h4>
				<script type="text/javascript">
					var bar0 = createBar(320,15,'white',1,'black','blue',85,7,3,"");
				</script>
			</div>
			
			<div id="DEFScreen">
				$headingHTML
				<div id="DEFOperationList">
					<script type="text/javascript">
						dirSelectionHTML('$myRoot');
					</script>
				</div>
			</div>		
ENDFRAGMENT;
	}
	
	function getDirSelectionHTML( $root )
	{
		jpimport('classes.filter.def');
		jpimport('helpers.lang');
		
		$root = realpath($root);
		
		$out = <<<END
			<h4>$root</h4>
			<table class="adminlist">
				<tr>
					<th align="left" width="50">
END;
	
		$out .= JoomlapackLangManager::_('DEF_EXCLUDE') . "\n" . "</th><th class=\"title\">" .
				JoomlapackLangManager::_('DEF_DIRECTORY') . "</th></tr>";
	
		$def = new JoomlapackFilterDEF();
		$def->init();
		
		$dirs = $def->getDirectory( $root );
		$id=0;
		foreach($dirs as $dir => $excluded){
			$id++;
			$checked = $excluded ? " checked = \"true\" " : "";
			$nocheck = ($dir == ".") || ($dir == "..");
			$out .= "\n<tr><td align=\"center\">";
			if (!$nocheck) {
				$out .= "<input type=\"checkbox\" $checked onclick=\"ToggleFilter('" . JoomlapackAbstraction::TranslateWinPath($root) . "', '$dir','def-$id');\" id=\"def-$id\">";
			} else {
				$out .= "&nbsp;";
			}
	
			$out .= "</td><td align=\"left\">";
			if ($excluded) {
				$out .= htmlentities($dir);
			} else {
				$out .= "<a href=\"javascript:dirSelectionHTML('". JoomlapackAbstraction::TranslateWinPath($root . DIRECTORY_SEPARATOR . $dir) ."');\">" . htmlentities($dir) . "</a>";
			}
			$out .= "</td></tr>";
		}
		$out .= "\n</table>";
		
		return $out;
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('toggleDirFilter', 'dirSelectionHTML');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}
	
	function dirSelectionHTML( $root ){
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$out = $this->getDirSelectionHTML( $root );
	
		@error_reporting($JP_Error_Reporting);
	
		return $out;
	}
	
	function toggleDirFilter( $root, $dir, $checked ){
		jpimport('classes.filter.def');
	
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$def = new JoomlapackFilterDEF();
		$def->modifyFilter($root, $dir, $checked);
		
		@error_reporting($JP_Error_Reporting);
		
		return 1;
	}

}
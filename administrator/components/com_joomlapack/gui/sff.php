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
 * The Single File exclusion filter management GUI class 
 *
 */
class JoomlapackPageSFF
{
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageSFF
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageSFF();
		}
		
		return $instance;
	}
	
	/**
	 * Displays the page
	 *
	 */
	function echoHTML()
	{
		jpimport('helpers.lang');
		
		// Default to site's root folder
		$myRoot = JPATH_SITE;
		$rootArray = explode('\\', $myRoot);
		$myRoot = implode('//', $rootArray);
		
		// Get URL for JavaScript
		$jsURI_pb = JoomlapackAbstraction::SiteURI() . '/administrator/components/' . JoomlapackAbstraction::getParam('option','com_joomlapack') . '/assets/js/xp_progress.js';
		
		// Get some more HTML fragments
		$headingHTML = JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_SFF') );
		
		$this->commonSAJAX();
		?>
			<script language="javascript" src="<?php echo $jsURI_pb; ?>">
				// WinXP Progress Bar- By Brian Gosselin- http://www.scriptasylum.com/
			</script>
			<script language="JavaScript" type="text/javascript">
				/*
				 * (S)AJAX Library code
				 */
				 <?php sajax_show_javascript(); ?>
		 		sajax_fail_handle = SAJAXTrap;
		
				function SAJAXTrap( myData ) {
					alert('Invalid AJAX reponse: ' + myData);
				}

				 
				 var globRoot;
				 
				function ToggleFilter( myRoot, myFile, myID ) {
					var sCheckStatus = (document.getElementById(myID).checked == true) ? "on" : "off";
			
					globRoot = myRoot;
			
					document.getElementById("DEFScreen").style.display = "none";
					document.getElementById("DEFProgressBar").style.display = "block";
			
					x_toggleFileFilter( myRoot, myFile, sCheckStatus, ToggleFilter_cb );
				}
			
				function ToggleFilter_cb( myRet ) {
					dirSelectionHTML( globRoot );
					document.getElementById("DEFScreen").style.display = "block";
					document.getElementById("DEFProgressBar").style.display = "none";
				}
			
				function dirSelectionHTML( myRoot ) {
					globRoot = myRoot;
					x_sffSelectionHTML( myRoot, cb_dirSelectionHTML );
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
				<?php echo $headingHTML; ?>
				<div id="DEFOperationList">
					<script type="text/javascript">
						dirSelectionHTML('<?php echo $myRoot; ?>');
					</script>
				</div>
			</div>	
		<?php
	}
	
	function getFileSelectionHTML( $root )
	{
		// Import usefull JoomlaPack classes
		jpimport('classes.filter.sff');
		jpimport('helpers.lang');
		jpimport('classes.core.utility.filtermanager');
		
		// Cleanup the root folder we were passed
		$root = realpath($root);

		// Get some translation strings
		$lang_dir = JoomlapackLangManager::_('SFF_DIR');
		$lang_excluded = JoomlapackLangManager::_('SFF_EXCLUDE');
		$lang_file = JoomlapackLangManager::_('SFF_FILE');
		
		// Scan folder for files
		$sff = new JoomlapackFilterSFF();
		$scanResult = $sff->getDirectory($root);
		
		// Get the directories filters; we're not going to allow the user to enter excluded folders :)
		$filterManager = new JoomlapackFilterManager();
		$filterManager->init();
		
		// Produce the output
		$out = <<<END
			<h4>$root</h4>
			<table border="0" cellspacing="10">
				<tr>
					<td valign="top">
						<!-- Directory Selection -->
						<table class="adminlist">
							<thead>
								<tr>
									<th>$lang_dir</th>
								</tr>
							</thead>
							<tbody>
END;
		
		$dirFilters = $filterManager->getFilters('folder');										
		foreach($scanResult['folders'] as $folder)
		{
			if( is_array($dirFilters) )
			{
				$wholefolder = JoomlapackAbstraction::TranslateWinPath($root . DIRECTORY_SEPARATOR . $folder);
				$showLink = !in_array($wholefolder,$dirFilters);
			} else {
				$showLink = true;
			}

			$out .= "\t\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t\t<td>\n";
			if($showLink) {
				$out .="<a href=\"javascript:dirSelectionHTML('". JoomlapackAbstraction::TranslateWinPath($root . DIRECTORY_SEPARATOR . $folder) ."');\">" . htmlentities($folder) . "</a>";
			} else {
				$out .= htmlentities($folder);
			}
			$out .= "\t\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t\t</tr>\n";
		}
									
		$out .= <<<END
							</tbody>
						</table>
					</td>
					<td valign="top">
						<!-- File Selection -->
						<table class="adminlist">
							<thead>
								<tr>
									<th>$lang_excluded</th>
									<th>$lang_file</th>
								</tr>
							</thead>
							<tbody>
END;

		$id=0;
		foreach($scanResult['files'] as $file => $excluded)
		{
			$id++;
			$checked = $excluded ? " checked = \"true\" " : "";
			$out .= "\n<tr><td align=\"center\">";
			$out .= "<input type=\"checkbox\" $checked onclick=\"ToggleFilter('" . JoomlapackAbstraction::TranslateWinPath($root) . "', '$file','sff-$id');\" id=\"sff-$id\">";
			$out .= "</td><td align=\"left\">";
			$out .= htmlentities($file);
			$out .= "</td></tr>";
		}
		
		$out .= <<<END
							</tbody>
						</table>
					</td>
				</tr>
			</table>
END;
		
		return $out;
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('toggleFileFilter', 'sffSelectionHTML');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}
	
	function toggleFileFilter($myRoot, $myFile, $sCheckStatus)
	{
		jpimport('classes.filter.sff');
		
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$sff = new JoomlapackFilterSFF();
		$sff->modifyFilter($myRoot, $myFile, $sCheckStatus);
		
		@error_reporting($JP_Error_Reporting);
		
		return 1;
	}
	
	function sffSelectionHTML( $myRoot )
	{
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$out = $this->getFileSelectionHTML( $myRoot );
		
		@error_reporting($JP_Error_Reporting);
		
		return $out;
	}
}
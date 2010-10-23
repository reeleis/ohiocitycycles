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
 * Database table exclusion filter GUI
 */
class JoomlapackPageDBEF
{
	/**
	 * Singleton
	 *
	 * @return JoomlapackPageDBEF
	 */
	function &getInstance()
	{
		static $instance;
		
		$instance = is_object($instance) ? $instance : new JoomlapackPageDBEF();
		return $instance;
	}
	
	function echoHTML()
	{
		jpimport('helpers.lang');
		// Get URL for JavaScript
		$jsURI_pb = JoomlapackAbstraction::SiteURI() . '/administrator/components/' . JoomlapackAbstraction::getParam('option','com_joomlapack') . '/assets/js/xp_progress.js';
		
		// Get some more HTML fragments
		$headingHTML = JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_DBEF') );
		
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
					
				function ToggleFilter( myTable, myID ) {
					var sCheckStatus = (document.getElementById(myID).checked == true) ? "on" : "off";
			
					document.getElementById("DBEFScreen").style.display = "none";
					document.getElementById("DBEFProgressBar").style.display = "block";
			
					x_toggleDBFilter( myTable, sCheckStatus, ToggleFilter_cb );
				}
			
				function ToggleFilter_cb( myRet ) {
					TablesHTML();
					document.getElementById("DBEFScreen").style.display = "block";
					document.getElementById("DBEFProgressBar").style.display = "none";
				}
			
				function TablesHTML() {
					x_DBSelectionHTML( cb_TablesHTML );
				}
			
				function cb_TablesHTML( myRet ) {
					document.getElementById("DBEFScreen").style.display = "block";
					document.getElementById("DBEFProgressBar").style.display = "none";
					document.getElementById("DBEFOperationList").innerHTML = myRet;
				}
				
				function Reset() {
					document.getElementById("DBEFScreen").style.display = "none";
					document.getElementById("DBEFProgressBar").style.display = "block";
					x_ResetDBEF( ToggleFilter_cb );
				}
				
				function FilterNonJ()
				{
					document.getElementById("DBEFScreen").style.display = "none";
					document.getElementById("DBEFProgressBar").style.display = "block";
					x_FilterNonJoomlaTables( ToggleFilter_cb );
				}
			</script>
			
			<div id="DBEFProgressBar" style="display:none;" class="sitePack">
				<h4>Please wait...</h4>
				<script type="text/javascript">
					var bar0 = createBar(320,15,'white',1,'black','blue',85,7,3,"");
				</script>
			</div>
			
			<div id="DBEFScreen">
				$headingHTML
				<div id="DBEFOperationList">
					<script type="text/javascript">
						TablesHTML();
					</script>
				</div>
			</div>		
ENDFRAGMENT;
	}
	
	function getTables()
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = "SHOW TABLES";
		$db->setQuery( $sql );
		$results = $db->loadRowList();
		$ret = array();
		foreach( $results as $row )
		{
			$ret[] = $row[0];
		}
		
		return $ret;
	}
	
	function getTablesHTML()
	{
		jpimport('classes.filter.dbef');
		jpimport('helpers.lang');
		
		$resetHTML = JoomlapackLangManager::_('DBEF_RESET');
		$filter1HTML = JoomlapackLangManager::_('DBEF_QUICK1');
		
		$out = <<<END
			<p>
			<a href='javascript:Reset();'>$resetHTML</a> -
			<a href='javascript:FilterNonJ();'>$filter1HTML</a>
			</p>
			<table class="adminlist">
				<tr>
					<th align="left" width="50">
END;
	
		$out .= JoomlapackLangManager::_('DBEF_EXCLUDE') . "\n" . "</th><th class=\"title\">" .
				JoomlapackLangManager::_('DBEF_TABLE') . "</th></tr>";

		$dbef = new JoomlapackFilterDBEF();
		$dbef->init();
		$filters = $dbef->getFilters('database');
		
		$tables = $this->getTables();
		$id=0;

		// Get db prefix
		global $mosConfig_dbprefix;
		$prefix = defined('_JEXEC') ? JApplication::getCfg('dbprefix') : $mosConfig_dbprefix;
		
		foreach( $tables as $table )
		{
			// Get abstract name
			$tableAbstract = str_replace($prefix, '#__', $table);
			$isJoomla = ($tableAbstract != $table);
			
			$checked = in_array($tableAbstract, $filters) ? " checked = \"true\" " : '';
			$id++;
			$out .= "\n<tr><td align=\"center\">";
			$out .= "<input type=\"checkbox\" $checked onclick=\"ToggleFilter('" . $tableAbstract . "', 'dbef-$id');\" id=\"dbef-$id\">";
			$out .= "</td><td align=\"left\">";
			$out .= ($isJoomla ? "<b>" : "") . htmlentities($table) . ($isJoomla ? "</b>" : "");
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
		sajax_export('toggleDBFilter', 'DBSelectionHTML', 'ResetDBEF', 'FilterNonJoomlaTables');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}
	
	function toggleDBFilter( $myTable, $checked )
	{
		jpimport('classes.filter.dbef');
		
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$dbef = new JoomlapackFilterDBEF();
		$dbef->modifyFilter($myTable, $checked);
		
		@error_reporting($JP_Error_Reporting);
		
		return 1;
	}
	
	function DBSelectionHTML()
	{
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$out = $this->getTablesHTML();
		
		@error_reporting($JP_Error_Reporting);
	
		return $out;
	}
	
	function ResetDBEF()
	{
		jpimport('classes.filter.dbef');
		
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$dbef = new JoomlapackFilterDBEF();
		$dbef->ResetDBFilters();
		
		@error_reporting($JP_Error_Reporting);
		
		return 1;
	}
	
	function FilterNonJoomlaTables()
	{
		jpimport('classes.filter.dbef');
		
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$dbef = new JoomlapackFilterDBEF();
		$dbef->ExcludeNonJoomla();
		
		@error_reporting($JP_Error_Reporting);
		
		return 1;
	}
		
}
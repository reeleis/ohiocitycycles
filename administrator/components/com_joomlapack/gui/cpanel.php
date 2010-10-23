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

class JoomlapackPageCPanel
{
	/**
	 * Is the output directory writable?
	 *
	 * @var bool
	 */
	var $_isOutWritable;
	
	/**
	 * Is the temporary directory writable?
	 *
	 * @var bool
	 */
	var $_isTempWritable;
	
	/**
	 * Is the application ready to backup?
	 *
	 * @var bool
	 */
	var $_isStatusGood;
	
	/**
	 * Is the user using the default temp directory?
	 *
	 * @var bool
	 */
	var $_defaultDirs;
	
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageCPanel
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageCPanel();
		}
		
		return $instance;
	}
	
	/**
	 * Constructor
	 *
	 * @return JoomlapackPageCPanel
	 */
	function JoomlapackPageCPanel()
	{
	}
	
	/**
	 * Displays the HTML for this page, directly outputting it to the browser (due to the use of tabs)
	 */
	function echoHTML()
	{
		// Load the translations
		// Make the Control Panel HTML
		$cpanel = new JoomlapackCPanelHTML();
		$cpanel->addItem( JoomlapackAbstraction::JPLink('config'), 'config', JoomlapackLangManager::_('CPANEL_CONFIG') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('configmigrate'), 'configmigrate', JoomlapackLangManager::_('CPANEL_CONFIGMIGRATE') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('def'), 'def', JoomlapackLangManager::_('CPANEL_DEF') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('sff'), 'sff', JoomlapackLangManager::_('CPANEL_SFF') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('dbef'), 'dbef', JoomlapackLangManager::_('CPANEL_DBEF') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('multidb'), 'multidb', JoomlapackLangManager::_('CPANEL_MULTIDB') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('pack'), 'backup', JoomlapackLangManager::_('CPANEL_PACK') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('backupadmin'), 'bufa', JoomlapackLangManager::_('CPANEL_BUADMIN') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('log'), 'log', JoomlapackLangManager::_('CPANEL_LOG') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('unlock'), 'reset', JoomlapackLangManager::_('CPANEL_UNLOCK') );
		$cpanelHTML = $cpanel->getHTML();
		
		// Create the admin form
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_HOME') );
		echo <<<ENDSNIPPET
		<table class="adminform">
			<tr>
				<td width="55%" valign="top">
					$cpanelHTML
				</td>
				<td width="45%" valign="top">
ENDSNIPPET;
		$this->_getTabsHTML();
		echo <<<ENDSNIPPET
				</td>
			</tr>
		</table>		
ENDSNIPPET;

	}
	
	/**
	 * Renders the JoomlaPack's overview tabbed pane
	 */
	function _getTabsHTML()
	{
		// Get some status information
		$config =& JoomlapackConfiguration::getInstance();
		$this->_isOutWritable	= $config->isOutputWriteable();	
		$this->_isTempWritable	= $config->isTempWriteable();
		$this->_isStatusGood	= $this->_isOutWritable && $this->_isTempWritable;
		$this->_defaultDirs		= (realpath($config->OutputDirectory) == realpath(JPATH_COMPONENT_ADMINISTRATOR.DS.'backup')) ||
								  realpath($config->TempDirectory) == realpath(JPATH_COMPONENT_ADMINISTRATOR.DS.'backup');

		if( defined('_JEXEC') )
		{
			jimport('joomla.html.pane');
			$tabs  =& JPane::getInstance('sliders');
			echo $tabs->startPane('jpstatuspane');
		} else {
			$tabs = new mosTabs(1);
			$tabs->startPane('jpstatuspane');
		}
		
		if( defined('_JEXEC') )
		{
			echo $tabs->startPanel( JoomlapackLangManager::_('MAIN_OVERVIEW'), 'jpstatusov' );
		} else {
			$tabs->startTab( JoomlapackLangManager::_('MAIN_OVERVIEW'), 'jpstatusov' );		
		}

		echo '<p class="sanityCheck">' . JoomlapackLangManager::_('MAIN_STATUS') . ': ';
		echo JoomlapackCommonHTML::colorizeWriteStatus( $this->_isStatusGood, true, 'appgood', 'appnotgood', 'main' ) . '</p>';
		
		// --- START --- Detect use of default temp directory
		if($this->_defaultDirs)
		{
			echo '<p class="sanityCheck">' . JoomlapackLangManager::_('MAIN_WARNING') . '<br/>';
			echo '<a href="http://www.joomlapack.net/index.php?option=com_content&id=75">'.JoomlapackLangManager::_('MAIN_WARNING_INFO') . '</a></p>';
		}
		// --- END ---

		if( defined('_JEXEC') )
		{
			echo $tabs->endPanel();
			echo $tabs->startPanel( JoomlapackLangManager::_('MAIN_DETAILS'), 'jpstatusdet' );
		} else {
			$tabs->endTab();		
			$tabs->startTab( JoomlapackLangManager::_('MAIN_DETAILS'), 'jpstatusdet' );
		}
		
		// Populate side panel
		$item		= JoomlapackLangManager::_('MAIN_ITEM');
		$status		= JoomlapackLangManager::_('MAIN_STATUS');
		$tempDir	= JoomlapackLangManager::_('COMMON_TEMPDIR');
		$tempStatus	= JoomlapackCommonHTML::colorizeWriteStatus( $this->_isTempWritable, true );
		$outDir		= JoomlapackLangManager::_('COMMON_OUTDIR');
		$outStatus	= JoomlapackCommonHTML::colorizeWriteStatus( $this->_isOutWritable, true );
		$verCheckTitle	= JoomlapackLangManager::_('COMMON_VERSION_CHECK');
		$verHTML	= $this->checkAppStatusV(strstr(_JP_VERSION,'SVN') ? 0 : 1);
		
		echo <<<ENDSNIPPET
			<table align="center" border="1" cellspacing="0" cellpadding="5" class="adminlist">
				<thead>
					<tr>
						<th class="title">$item</th>
						<th>$status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>$tempDir</td>
						<td>$tempStatus</td>
					</tr>
					<tr>
						<td>$outDir</td>
						<td>$outStatus</td>
					</tr>
					<tr>
						<td>$verCheckTitle</td>
						<td>$verHTML</td>
					</tr>
				</tbody>
			</table>
ENDSNIPPET;

		if( defined('_JEXEC') )
		{
			echo $tabs->endPanel();
			echo $tabs->startPanel( JoomlapackLangManager::_('MAIN_TRANSLATIONCREDITS'), 'jptranscredits' );
		} else {
			$tabs->endTab();		
			$tabs->startTab( JoomlapackLangManager::_('MAIN_TRANSLATIONCREDITS'), 'jptranscredits' );
		}
		
		$translationlanglabel = JoomlapackLangManager::_('MAIN_TRANSLATIONLANG');
		$translationlang = JoomlapackLangManager::_('INFO_LANGUAGE');
		$translationverlabel = JoomlapackLangManager::_('MAIN_TRANSLATIONVER');
		$translationver = JoomlapackLangManager::_('INFO_JPVER');
		$translationauthorlabel = JoomlapackLangManager::_('MAIN_TRANSLATIONAUTHOR');
		$translationauthor = JoomlapackLangManager::_('INFO_AUTHOR');
		$trasnlationurllabel = JoomlapackLangManager::_('MAIN_TRANSLATIONURL');
		$trasnlationurl = JoomlapackLangManager::_('INFO_AUTHORURL');
		
		echo <<<ENDSNIPPET
			<table align="center" border="1" cellspacing="0" cellpadding="5" class="adminlist">
				<thead>
					<tr>
						<th class="title">$item</th>
						<th>$status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>$translationlanglabel</td>
						<td>$translationlang</td>
					</tr>
					<tr>
						<td>$translationverlabel</td>
						<td>$translationver</td>
					</tr>
					<tr>
						<td>$translationauthorlabel</td>
						<td>$translationauthor</td>
					</tr>
					<tr>
						<td>$trasnlationurllabel</td>
						<td>$trasnlationurl</td>
					</tr>
				</tbody>
			</table>
ENDSNIPPET;
		
		if( defined('_JEXEC') )
		{
			echo $tabs->endPanel();
			echo $tabs->endPane();
		} else {
			$tabs->endTab();
			$tabs->endPane();		
		}
		
	}

	function checkAppStatusV ($app_status) {
		if ($app_status == 1) {
		$vcheck = urlencode(base64_encode(_JP_VERSION));
		//echo $vcheck;  //debug
		return "<script type=\"text/javascript\" src=\"http://www.joomlapack.net/version.php?vid=2&verx=$vcheck\"></script>";
		}
		else
		{
			return '<span style="color: #CCCC00; font-weight: bold;">Developer Snapshot</span>';
		}
	}
		
}

/* Get last run date.
      $path = "docs/";
      // show the most recent file
      echo "Most recent file is: ".getNewestFN($path);
      // Returns the name of the newest file
      // (My_name YYYY-MM-DD HHMMSS.inf)
      function getNewestFN ($path) {
        // store all .inf names in array
        $p = opendir($path);
        while (false !== ($file = readdir($p))) {
          if (strstr($file,".zip"))
            $list[]=date("YmdHis ", filemtime($path.$file)).$path.$file;
        }
        // sort array descending
        rsort($list);
        // return newest file name   
        return $list[0];
      }
*/
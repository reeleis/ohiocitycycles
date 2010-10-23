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

class jpackScreens {
	function fConfig() {
		jpimport('gui.configeditor');
		$page =& JoomlapackPageConfigEditor::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fPack() {
		jpimport('gui.backup');
		$page =& JoomlapackPageBackup::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fMain() {
		jpimport('gui.cpanel');
		$page =& JoomlapackPageCPanel::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fBUAdmin() {
		jpimport('gui.backupadmin');
		$page =& JoomlapackPageBackupAdmin::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fDirExclusion() {
		jpimport('gui.def');
		$page =& JoomlapackPageDEF::getInstance();
		jpackScreens::_loadPage($page);
	}
	
	function fDBExclusion() {
		jpimport('gui.dbef');
		$page =& JoomlapackPageDBEF::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fLog() {
		jpimport('gui.logview');
		$page =& JoomlapackPageLogView::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fDebug() {
		jpimport('gui.debug');
		$page =& JoomlapackPageDebug::getInstance();
		jpackScreens::_loadPage($page);
	}
	
	function fUnlock()
	{
		jpimport('gui.reset');
		$page =& JoomlapackPageReset::getInstance();
		jpackScreens::_loadPage($page);
	}

	function fMultiDB()
	{
		jpimport('gui.multidb');
		$page =& JoomlapackPageMultiDB::getInstance();
		jpackScreens::_loadPage($page);
	}
	
	function fFileExclusion()
	{
		jpimport('gui.sff');
		$page =& JoomlapackPageSFF::getInstance();
		jpackScreens::_loadPage($page);
	}
	
	function fConfigMigrate()
	{
		jpimport('gui.configmigration');
		$page =& JoomlapackPageConfigmigration::getInstance();
		jpackScreens::_loadPage($page);
	}
	
	function CommonFooter() {
		// Skip footer for AJAX calls
		if(JoomlapackAbstraction::isSAJAX()) return;
		
		$option = JoomlapackAbstraction::getParam('option','com_joomlapack');
	?>
		<p>
			[
			<a href="index2.php?option=<?php echo $option; ?>"><?php echo JoomlapackLangManager::_('CPANEL_HOME'); ?></a>
			]
			<br />
			<span style="font-size:x-small;">
			JoomlaPack <?php echo _JP_VERSION; ?>. Copyright &copy; 2006-2008 <a href="http://www.joomlapack.net">JoomlaPack Developers</a>.<br/>
			<a href="http://www.joomlapack.net">JoomlaPack</a> is Free Software released under the GNU/GPL License.
			</span>
		</p>
	<?php
	}
	
	/**
	 * Loads a page's HTML or instructs the class to process an AJAX request, based on the contents of
	 * the page request.
	 *
	 * @param object $page A JoomlaPack's page class object
	 */
	function _loadPage( &$page )
	{
		if( JoomlapackAbstraction::isSAJAX() )
		{
			$page->processAJAX();
		}
		else
		{
			$page->echoHTML();
		}
	}
	
}

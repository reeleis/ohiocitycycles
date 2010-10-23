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
 * Configuration screen
 *
 */
class JoomlapackPageConfigEditor
{
	
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageConfigEditor
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageConfigEditor();
		}
		
		return $instance;
	}
	
	/**
	 * Displays the HTML for this page, directly outputting it to the browser
	 */
	function echoHTML()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		// Show top header
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_CONFIG') );
		
		echo "<p align=\"center\">" . JoomlapackLangManager::_('CONFIG_FILESTATUS') . ' ' . JoomlapackCommonHTML::colorizeWriteStatus( $configuration->isConfigurationWriteable(), true ) . "</p>";
		
		$this->echoAJAXJS();
		
		?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="<?php echo JoomlapackAbstraction::getParam('option','com_joomlapack') ; ?>" />
			<input type="hidden" name="act" value="config" />
			<input type="hidden" name="task" value="" />
			
			<table border="0" cellpadding="0" cellspacing="0" width="95%" class="adminform">
			<tr><td>
		<?php
			if( !defined('_JEXEC') ) {
				$tabs = new mosTabs(1);
				$tabs->startPane(1);
				$tabs->startTab( JoomlapackLangManager::_('CONFIG_BASIC_OPTIONS'), 'jpconfigbasic' );
			} else {
				jimport('joomla.html.pane');
				$tabs =& JPane::getInstance('sliders');
				echo $tabs->startPane('jpconfig');
				echo $tabs->startPanel( JoomlapackLangManager::_('CONFIG_BASIC_OPTIONS'), 'jpconfigbasic' );
			}
		?>
			<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">
				<tr align="center" valign="middle">
					<th width="20%">&nbsp;</th>
					<th width="20%"><?php echo JoomlapackLangManager::_('CONFIG_OPTION'); ?></th>
					<th width="60%"><?php echo JoomlapackLangManager::_('CONFIG_CURSETTINGS'); ?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('COMMON_OUTDIR'); ?></td>
					<td><input type="text" name="outdir" id="outdir" size="40" value="<?php echo $configuration->OutputDirectory; ?>" />
					<input type="button" value="<?php echo JoomlapackLangManager::_('CONFIG_DEFAULTDIR'); ?>" onclick="getDefaultOutputDirectory();" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('COMMON_TEMPDIR'); ?></td>
					<td><input type="text" name="tempdir" id="tempdir" size="40" value="<?php echo $configuration->get('TempDirectory'); ?>" />
					<input type="button" value="<?php echo JoomlapackLangManager::_('CONFIG_DEFAULTDIR'); ?>" onclick="getDefaultTempDirectory();" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_TARNAME'); ?></td>
					<td><input type="text" name="tarname" size="40" value="<?php echo $configuration->TarNameTemplate;?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_LOGLEVEL'); ?></td>
					<td><?php $this->outputLogLevel( $configuration->logLevel ); // @todo Use common function ?></td>
				</tr>
			</table>
		<?php
			if( !defined('_JEXEC') ) {
				$tabs->endTab();
				$tabs->startTab( JoomlapackLangManager::_('CONFIG_ADVANCED'), 'jpconfigadvanced' );
			} else {
				echo $tabs->endPanel();
				echo $tabs->startPanel( JoomlapackLangManager::_('CONFIG_ADVANCED'), 'jpconfigadvanced' );
			}
			
		?>
			<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">	
				<tr align="center" valign="middle">
					<th width="20%">&nbsp;</th>
					<th width="20%"><?php echo JoomlapackLangManager::_('CONFIG_OPTION'); ?></th>
					<th width="60%"><?php echo JoomlapackLangManager::_('CONFIG_CURSETTINGS'); ?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_SQLCOMPAT'); ?></td>
					<td><?php $this->outputSQLCompat( $configuration->MySQLCompat ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_DBA_LABEL'); ?></td>
					<td><?php $this->AlgorithmChooser( $configuration->dbAlgorithm, "dbAlgorithm" ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_PA_LABEL'); ?></td>
					<td><?php $this->AlgorithmChooser( $configuration->packAlgorithm, "packAlgorithm" ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_LISTERENGINE'); ?></td>
					<td><?php $this->outputEngineSelector('listerengine', 'lister', $configuration->get('listerengine') ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_DBDUMPENGINE'); ?></td>
					<td><?php $this->outputEngineSelector('dbdumpengine', 'dumper', $configuration->get('dbdumpengine') ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_PACKERENGINE'); ?></td>
					<td><?php $this->outputEngineSelector('packerengine', 'packer', $configuration->get('packerengine') ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_ALTINSTALLER'); ?></td>
					<td><?php $this->AltInstallerChooser( $configuration->InstallerPackage ); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_BACKUPMETHOD'); ?></td>
					<td><?php $this->backupMethodChooser( $configuration->backupMethod ); ?>
				</tr>
			</table>	
		<?php
			if( !defined('_JEXEC') ) {
				$tabs->endTab();
				$tabs->startTab( JoomlapackLangManager::_('CONFIG_FRONTEND'), 'jpconfigfrontend' );
			} else {
				echo $tabs->endPanel();
				echo $tabs->startPanel( JoomlapackLangManager::_('CONFIG_FRONTEND'), 'jpconfigfrontend' );
			}
		?>
			<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">	
				<tr align="center" valign="middle">
					<th width="20%">&nbsp;</th>
					<th width="20%"><?php echo JoomlapackLangManager::_('CONFIG_OPTION'); ?></th>
					<th width="60%"><?php echo JoomlapackLangManager::_('CONFIG_CURSETTINGS'); ?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_ENABLEFEB'); ?></td>
					<td><input name="enableFrontend" type="checkbox" <?php echo ($configuration->enableFrontend ) ? 'checked' : ''; ?> /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_SECRETPROMPT'); ?></td>
					<td><input name="secretWord" type="text" size="30" maxlength="30" value="<?php echo $configuration->secretWord; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_SECRETINFO1'); ?><br />
					<?php echo $this->makeFEBURL(); ?>
					</td>
				</tr>
			</table>
		<?php
			if( !defined('_JEXEC') ) {
				$tabs->endTab();
				$tabs->startTab( JoomlapackLangManager::_('CONFIG_MAGIC'), 'jpconfigmagic' );
			} else {
				echo $tabs->endPanel();
				echo $tabs->startPanel( JoomlapackLangManager::_('CONFIG_MAGIC'), 'jpconfigmagic' );
			}
		?>
			<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">	
				<tr align="center" valign="middle">
					<th width="20%">&nbsp;</th>
					<th width="20%"><?php echo JoomlapackLangManager::_('CONFIG_OPTION'); ?></th>
					<th width="60%"><?php echo JoomlapackLangManager::_('CONFIG_CURSETTINGS'); ?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNROWSPERSTEP'); ?></td>
					<td><input name="mnRowsPerStep" type="text" value="<?php echo $configuration->mnRowsPerStep; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNMAXFRAGMENTSIZE'); ?></td>
					<td><input name="mnMaxFragmentSize" type="text" value="<?php echo $configuration->mnMaxFragmentSize; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNMAXFRAGMENTFILES'); ?></td>
					<td><input name="mnMaxFragmentFiles" type="text" value="<?php echo $configuration->mnMaxFragmentFiles; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNZIPFORCEOPEN'); ?></td>
					<td><input name="mnZIPForceOpen" type="checkbox" <?php echo ($configuration->mnZIPForceOpen ) ? 'checked' : ''; ?> /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNZIPCOMPRESSIONTHRESHOLD'); ?></td>
					<td><input name="mnZIPCompressionThreshold" type="text" value="<?php echo $configuration->mnZIPCompressionThreshold; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNZIPDIRREADCHUNK'); ?></td>
					<td><input name="mnZIPDirReadChunk" type="text" value="<?php echo $configuration->mnZIPDirReadChunk; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNMAXEXECTIMEALLOWED'); ?></td>
					<td><input name="mnMaxExecTimeAllowed" type="text" value="<?php echo $configuration->get('mnMaxExecTimeAllowed'); ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNMINIMUMEXECTIME'); ?></td>
					<td><input name="mnMinimumExectime" type="text" value="<?php echo $configuration->get('mnMinimumExectime'); ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MNEXECTIMEBIASPERCENT'); ?></td>
					<td><input name="mnExectimeBiasPercent" type="text" value="<?php echo $configuration->get('mnExectimeBiasPercent'); ?>" /></td>
				</tr>				
			</table>
		<?php
			if( !defined('_JEXEC') ) {
				$tabs->endTab();
				$tabs->startTab( JoomlapackLangManager::_('CONFIG_MYSQLDUMP'), 'jpconfigmysqldump' );
			} else {
				echo $tabs->endPanel();
				echo $tabs->startPanel( JoomlapackLangManager::_('CONFIG_MYSQLDUMP'), 'jpconfigmysqldump' );
			}
		?>
				<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">	
				<tr align="center" valign="middle">
					<th width="20%">&nbsp;</th>
					<th width="20%"><?php echo JoomlapackLangManager::_('CONFIG_OPTION'); ?></th>
					<th width="60%"><?php echo JoomlapackLangManager::_('CONFIG_CURSETTINGS'); ?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MYSQLDUMP_PATH'); ?></td>
					<td><input name="mysqldumpPath" type="text" value="<?php echo $configuration->get('mysqldumpPath'); ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MYSQLDUMP_DATACHUNK'); ?></td>
					<td><input name="mnMSDDataChunk" type="text" value="<?php echo $configuration->get('mnMSDDataChunk'); ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MYSQLDUMP_MAXQUERYLINES'); ?></td>
					<td><input name="mnMSDMaxQueryLines" type="text" value="<?php echo $configuration->get('mnMSDMaxQueryLines'); ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo JoomlapackLangManager::_('CONFIG_MYSQLDUMP_LINESPERSESSION'); ?></td>
					<td><input name="mnMSDLinesPerSession" type="text" value="<?php echo $configuration->get('mnMSDLinesPerSession'); ?>" /></td>
				</tr>
				</table>
		<?php
			if( !defined('_JEXEC') ) {
				$tabs->endTab();
				$tabs->endPane();
			} else {
				echo $tabs->endPanel();
				echo $tabs->endPane();
			}
		?>
			</td></tr></table>
			</form>
		<?php
	}
	
	/**
	 * Displays an SQL compatibility option combobox
	 *
	 * @param string $sqlcompat
	 */
	function outputSQLCompat( $sqlcompat ) {
		$options = array();
		
		if( !defined('_JEXEC') )
		{
			$options[] = mosHTML::makeOption('compat', JoomlapackLangManager::_('CONFIG_COMPAT') );
			$options[] = mosHTML::makeOption('default', JoomlapackLangManager::_('CONFIG_DEFAULT') );
			
			echo mosHTML::selectList( $options, 'sqlcompat', '', 'value', 'text', $sqlcompat );
		} else {
			$options[] = JHTML::_('select.option', 'compat', JoomlapackLangManager::_('CONFIG_COMPAT') );
			$options[] = JHTML::_('select.option', 'default', JoomlapackLangManager::_('CONFIG_DEFAULT') );
			
			echo JHTML::_('select.genericlist', $options, 'sqlcompat', '', 'value', 'text', $sqlcompat );
		}
	}
	
	function outputEngineSelector( $formField, $engine, $selectedValue )
	{
		// Load engine definitions
		$sourceINI = JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'engine'.DS.$engine.DS.'engine.ini';
		$engineArray = JoomlapackAbstraction::parse_ini_file($sourceINI, true);
		
		// Create selection list array
		$options = array();
		foreach($engineArray as $sectionKey => $engineItem)
		{
			if( !defined('_JEXEC') )
			{
				$options[] = mosHTML::makeOption($sectionKey, $engineItem['description'] );
			}
			else
			{
				$options[] = JHTML::_('select.option', $sectionKey, $engineItem['description'] );
			}
		}
		
		// Output the selection list
		if( !defined('_JEXEC') )
		{
			echo mosHTML::selectList( $options, $formField, '', 'value', 'text', $selectedValue );
		}
		else
		{
			echo JHTML::_('select.genericlist', $options, $formField, '', 'value', 'text', $selectedValue );
		}
		
	}
	
	/**
	 * Outputs a packing algorithm combobox
	 *
	 * @param string $strOption Current selection
	 * @param string $strName The name of the <select> tag
	 */
	function AlgorithmChooser( $strOption, $strName ) {
		$options = array();
		
		if( !defined('_JEXEC') )
		{
			$options[] = mosHTML::makeOption('smart', JoomlapackLangManager::_('CONFIG_SMART') );
			$options[] = mosHTML::makeOption('multi', JoomlapackLangManager::_('CONFIG_MULTI') );
			
			echo mosHTML::selectList( $options, $strName, '', 'value', 'text', $strOption );
		} else {
			$options[] = JHTML::_('select.option', 'smart', JoomlapackLangManager::_('CONFIG_SMART') );
			$options[] = JHTML::_('select.option', 'multi', JoomlapackLangManager::_('CONFIG_MULTI') );
			
			echo JHTML::_('select.genericlist', $options, $strName, '', 'value', 'text', $strOption );
		}	
	}
	
	/**
	 * Displays an installer selection combobox
	 *
	 * @param string $strOption Selected installer's key
	 */
	function AltInstallerChooser( $strOption ) {
		$configuration =& JoomlapackConfiguration::getInstance();
		
		$altInstallers = $configuration->AltInstaller->loadAllDefinitions();
		
		if( !defined('_JEXEC') )
		{
			foreach ($altInstallers as $altInstaller) {
				$options[] = mosHTML::makeOption($altInstaller['meta'], $altInstaller['name'] );
			}
			
			echo mosHTML::selectList( $options, 'altInstaller', '', 'value', 'text', $strOption );
		} else {
			foreach ($altInstallers as $altInstaller) {
				$options[] = JHTML::_('select.option', $altInstaller['meta'], $altInstaller['name'] );
			}
			
			echo JHTML::_('select.genericlist', $options, 'altInstaller', '', 'value', 'text', $strOption );
		}
	}
	
	/**
	 * Displays a logging level combobox
	 *
	 * @param string $strOption Selected log level
	 */
	function outputLogLevel( $strOption ) {
		$options = array();
		
		if( !defined('_JEXEC') )
		{
			$options[] = mosHTML::makeOption('1', JoomlapackLangManager::_('CONFIG_LLERROR') );
			$options[] = mosHTML::makeOption('2', JoomlapackLangManager::_('CONFIG_LLWARNING') );
			$options[] = mosHTML::makeOption('3', JoomlapackLangManager::_('CONFIG_LLINFO') );
			$options[] = mosHTML::makeOption('4', JoomlapackLangManager::_('CONFIG_LLDEBUG') );
			$options[] = mosHTML::makeOption('0', JoomlapackLangManager::_('CONFIG_LLNONE') );
			
			echo mosHTML::selectList( $options, 'logLevel', '', 'value', 'text', $strOption );
		} else {
			$options[] = JHTML::_('select.option', '1', JoomlapackLangManager::_('CONFIG_LLERROR') );
			$options[] = JHTML::_('select.option', '2', JoomlapackLangManager::_('CONFIG_LLWARNING') );
			$options[] = JHTML::_('select.option', '3', JoomlapackLangManager::_('CONFIG_LLINFO') );
			$options[] = JHTML::_('select.option', '4', JoomlapackLangManager::_('CONFIG_LLDEBUG') );
			$options[] = JHTML::_('select.option', '0', JoomlapackLangManager::_('CONFIG_LLNONE') );
			
			echo JHTML::_('select.genericlist', $options, 'logLevel', '', 'value', 'text', $strOption );
		}
	}
	
	function makeFEBURL()
	{
		$out = "<tt>";
		if( defined('_JEXEC') )
		{
			$out .= substr_replace(JURI::root(), '', -1, 1);
		} else {
			global $mosConfig_live_site;
			$out .= $mosConfig_live_site;
		}
		$out .= '/index2.php?option=com_joomlapack&act=fullbackup&key=<b>secret_key</b>&no_html=1';
		$out .= "</tt>";
		return $out;
	}

	function echoAJAXJS()
	{
		$this->commonSAJAX();
		echo <<<ENDFRAGMENT
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
				
				function getDefaultOutputDirectory()
				{
					x_getDefaultOutputDirectory( getDefaultOutputDirectory_cb )
				}
				
				function getDefaultOutputDirectory_cb( myRet )
				{
					document.getElementById("outdir").value = myRet;
				}

				function getDefaultTempDirectory()
				{
					x_getDeafultTempDirectory( getDeafultTempDirectory_cb )
				}
				
				function getDeafultTempDirectory_cb( myRet )
				{
					document.getElementById("tempdir").value = myRet;
				}
				
		</script>
ENDFRAGMENT;
	}

	function backupMethodChooser( $activeMethod )
	{
		$options = array();
		
		if(!defined('_JEXEC'))
		{
			$options[] = mosHTML::makeOption('ajax', JoomlapackLangManager::_('CONFIG_METHODAJAX') );
			$options[] = mosHTML::makeOption('redirect', JoomlapackLangManager::_('CONFIG_METHODJSREDIRECT') );
			
			echo mosHTML::selectList( $options, 'backupMethod', '', 'value', 'text', $activeMethod);
		} else {
			$options[] = JHTML::_('select.option', 'ajax', JoomlapackLangManager::_('CONFIG_METHODAJAX') );
			$options[] = JHTML::_('select.option', 'redirect', JoomlapackLangManager::_('CONFIG_METHODJSREDIRECT') );
			
			echo JHTML::_( 'select.genericlist', $options, 'backupMethod', '', 'value', 'text', $activeMethod);
		}
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('getDefaultOutputDirectory', 'getDeafultTempDirectory');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}

	function getDefaultOutputDirectory()
	{
		return JPATH_COMPONENT_ADMINISTRATOR.DS.'backup';
	}
	
	function getDeafultTempDirectory()
	{
		return JPATH_COMPONENT_ADMINISTRATOR.DS.'backup';
	}
}
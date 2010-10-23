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

class JoomlapackPageBackup
{
	
	/**
	 * @var array A stack of error messages to display
	 */
	var $_errorStack = array();
	
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageBackup
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageBackup();
		}
		
		return $instance;
	}
	
	/**
	 * Based on the backupMethod selected in the configuration, it redirects
	 * the display of HTML to one of the appropriate methods.
	 *
	 * @access public
	 */
	function echoHTML()
	{
		$config =& JoomlapackConfiguration::getInstance();
		$isAjax = $config->get('backupMethod','ajax') == 'ajax';
		
		if($isAjax) {
			$this->echoHTML_AJAX();
		} else {
			$this->echoHTML_Redirects();
		}
	}
	
	/**
	 * Displays a page suitable for navigating through backup steps using
	 * the JavaScript Redirects method
	 * 
	 * @access private
	 * @since 1.2.b1 
	 */
	function echoHTML_Redirects()
	{
		$task = JoomlapackAbstraction::getParam('task', 'welcome');

		// Get common header
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_PACK') );
		
		// Depending on the task at hand, we display a different screen
		switch( $task )
		{
			case 'welcome':
				/**
				 * The welcoming page, prompting the user to select a backup type and start
				 * the actual backup process
				 */
				$this->_echoHTML_Redirects_Welcome();
				break;
				
			case 'backup':
				/**
				 * The backup steps. After each step is completed, a JavaScript redirect is issued,
				 * causing the backend to proceed to the next step. The first step (start of backup)
				 * is denoted by passing &type=<backuptype> to the URL. This parameter is then removed
				 * from the URL for all subsequent steps.
				 */
				$this->_echoHTML_Redirects_Backup();
				break;
		}
	}
	
	/**
	 * Diplays a page suitable for performing a backup using AJAX calls to the
	 * backup engine
	 * 
	 * @access private
	 */
	function echoHTML_AJAX()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		// Get translations
		$dompackdb					= JoomlapackLangManager::_('PACK_DOMPACKDB');
		$dompacking					= JoomlapackLangManager::_('PACK_DOMPACKING');

		// Show top header
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_PACK') );
		echo $this->_renderJavaScript();
		
?>
<div id="Main">
	<div id="Welcome" class="sitePack">
		<p><?php echo JoomlapackLangManager::_('PACK_PROMPT'); ?></p>
		<div onclick="do_Start( 0 );" class="jpbutton">
			<img src="<?php echo JoomlapackCommonHTML::getImageURI('full') ?>" border="0" />
			<p><?php echo JoomlapackLangManager::_('PACK_BUTTON'); ?></p>
		</div>
		<div onclick="do_Start( 1 );" class="jpbutton">
			<img src="<?php echo JoomlapackCommonHTML::getImageURI('db') ?>" border="0" />
			<p><?php echo JoomlapackLangManager::_('PACK_BUTTON2'); ?></p>
		</div>
	</div>

	<div id="Init" style="display:none;" class="sitePack">
		<table class="stepstable" align="center">
			<thead>
				<tr>
					<th width="16"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr id="domDB">
					<td id="picDB"></td>
					<td><?php echo JoomlapackLangManager::_('PACK_DOMPACKDB'); ?></td>
				</tr>
				<tr id="domPacking">
					<td id="picPacking"></td>
					<td><?php echo JoomlapackLangManager::_('PACK_DOMPACKING'); ?></td>
				</tr>
				<tr id="domFinished">
					<td id="picFinished"></td>
					<td><?php echo JoomlapackLangManager::_('PACK_FINISHED'); ?></td>
				</tr>
			</tbody>
		</table>
		
		<div id="Warnings" class="sitePack" style="display: none;">
			<h4><?php echo JoomlapackLangManager::_('PACK_WARNINGSHEAD');?></h4>
			<div id="WarningsContents">
			</div>
		</div>

		<div id="Status">
			<p id="JPStep"></p>
			<p id="JPSubstep"></p>
		</div>
		
		<div id="AllDone" style="display:none;">
			<p>&nbsp;</p>
			<table border="0" cellspacing="4px;" cellpadding="0">
				<tr>
					<td width="32">
						<img src="<?php echo JoomlapackCommonHTML::getImageURI('ok_big') ?>" border="0" />
					</td>
					<td>
						<h4><?php echo JoomlapackLangManager::_('PACK_FINISHED'); ?></h4>
						<p><?php echo JoomlapackLangManager::_('PACK_FINISHEDTEXT'); ?></p>
					</td>
				</tr>
			</table>
			<a href="<?php echo JoomlapackAbstraction::JPLink('backupadmin'); ?>">
				<div class="jpbutton">
					<img src="<?php echo JoomlapackCommonHTML::getImageURI('bufa') ?>" border="0" />
					<p><?php echo JoomlapackLangManager::_('CPANEL_BUADMIN'); ?></p>
				</div>
			</a>

		</div>
		
		<div id="Timeout" style="display:none; margin-top: 10px;" class="sitePack">
			<table border="0" width="100%">
				<tr>
					<td valign="top">
						<img src="<?php echo JoomlapackCommonHTML::getImageURI('error_big') ?>" border="0" />
					</td>
					<td>
						<h4><?php echo JoomlapackLangManager::_('PACK_TIMEOUTTITLE'); ?></h4>
						<p><?php echo JoomlapackLangManager::_('PACK_TIMEOUT'); ?></p>
						<p id="JoomlapackErrorMessage" style="display: none">&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<a href="<?php echo JoomlapackAbstraction::JPLink('log'); ?>">
							<div class="jpbutton">
								<img src="<?php echo JoomlapackCommonHTML::getImageURI('log') ?>" border="0" />
								<p><?php echo JoomlapackLangManager::_('CPANEL_LOG'); ?></p>
							</div>
						</a>					
					</td>
				</tr>
			</table>
		</div>	
	</div>

	
	<div id="Debug">
	</div>

</div>
<?php
		
	}
	
	/**
	 * Outputs the JavaScript required for AJAX calls to work
	 * 
	 * @access private
	 */
	function _renderJavaScript()
	{
		$this->commonSAJAX();

		// Start JS tag
		echo <<<JSFRAGEND
			<script type="text/JavaScript">
			/*
	 		* (S)AJAX Library code
	 		*/	 		
JSFRAGEND;
		// Display (S)AJAX code
		sajax_show_javascript();	
		echo <<<JSFRAGEND
			</script>
JSFRAGEND;

		echo '<script type="text/javascript" src="' . JoomlapackAbstraction::SiteURI() . '/administrator/components/' . JoomlapackAbstraction::getParam('option','com_joomlapack') . '/assets/js/pack.js"></script>';
	}
	
	
	/**
	 * Displays the initial page for the JavaScript Redirects backup method
	 *
	 * @access private
	 * @since 1.2.b1
	 */
	function _echoHTML_Redirects_Welcome()
	{
?>
<div id="Main">
	<div id="Welcome" class="sitePack">
		<p><?php echo JoomlapackLangManager::_('PACK_PROMPT'); ?></p>
		<a href="<?php echo JoomlapackAbstraction::JPLink('pack','backup', false, 'type=full') ?>" class="jpbutton">
			<img src="<?php echo JoomlapackCommonHTML::getImageURI('full') ?>" border="0" />
			<span><?php echo JoomlapackLangManager::_('PACK_BUTTON'); ?></span>
		</a>
		<a href="<?php echo JoomlapackAbstraction::JPLink('pack','backup', false, 'type=dbonly') ?>" class="jpbutton">
			<img src="<?php echo JoomlapackCommonHTML::getImageURI('db') ?>" border="0" />
			<span><?php echo JoomlapackLangManager::_('PACK_BUTTON2'); ?></span>
		</a>
	</div>
</div>
<?php
	}
	
	/**
	 * Performs a backup step and displays the outcome. This is used by the
	 * JavaScript Redirects backup method
	 *
	 * @return bool|null Returns false if the backup step failed
	 * @since 1.2.b1
	 * @access private
	 */
	function _echoHTML_Redirects_Backup()
	{	
		// Decide how to proceed based on the existence and contents of the 'type' parameter in the URL
		$type = JoomlapackAbstraction::getParam('type', 'INVALID');
		if( $type == 'INVALID' )
		{
			$action = 'continue';
		} else {
			switch( $type )
			{
				case 'full':
					$action = 'new';
					$dbonly = 0;
					break;
					
				case 'dbonly':
					$action = 'new';
					$dbonly = 1;
					break;
					
				default:
					$action = 'error';
					break;
			}
		}
		
		// Quit on invalid page parameters
		if($action == 'error')
		{
				$this->_errorStack[] = JoomlapackLangManager::_('PACK_ERRORINVALIDPARAMETERS');
				$this->_echoHTML_Redirects_Error();
				return false;
		}
		
		/**
		 * Please note that we display the progress BEFORE running the next backup step.
		 * If we did otherwise, the progress would never get to be displayed to our user.
		 * This is due to the partial page (backend header, menu and component header)
		 * being sent to the browser before the lengthy backup process takes place.
		 */
		
		// Get a CUBE Return Array from the database
		jpimport('classes.core.cube');
		$cube =& JoomlapackCUBE::getInstance();
		$ret = $cube->getCUBEArray();
		
		// Parse $ret array
		if( $action == 'new' )
		{
			$domain = 'init';
			$step = '';
			$substep = '';
		} else {
			if( count($ret) <= 0 ) {
				$domain = 'finale';
			} else {
				$domain = $ret['Domain'];
				$step = $ret['Step'];
				$substep = $ret['Substep'];
			}
		}
		
		// Find current domain's index
		switch( $domain )
		{
			case 'init':
				$currentDomainIndex = 0;
				break;
			case 'PackDB':
				$currentDomainIndex = 3;
				break;
			case 'Packing':
				$currentDomainIndex = 4;
				break;
			case 'finale':
			default:
				$currentDomainIndex = 6;
				break;
		}
		
		// Now, make an array indicating in what state each domain is
		$domainDisplayArray = array();
		$domainDisplayArray[] = $this->_makeStepArrayEntry(JoomlapackLangManager::_('PACK_DOMPACKDB'), 3, $currentDomainIndex, false);
		$domainDisplayArray[] = $this->_makeStepArrayEntry(JoomlapackLangManager::_('PACK_DOMPACKING'), 4, $currentDomainIndex, false);
		$domainDisplayArray[] = $this->_makeStepArrayEntry(JoomlapackLangManager::_('PACK_FINISHED'), 5, $currentDomainIndex, false);
		$gridHTML = '';		
		foreach( $domainDisplayArray as $dispArray )
		{
			$class = ($dispArray['class'] == '') ? '' : 'class="' . $dispArray['class'] . '"';
			$imageLink = ($dispArray['pic'] == '') ? '' : '<img src="components/com_joomlapack/images/' . $dispArray['pic'] . '" />';
			$gridHTML .= "\t\t\t<tr $class>\n";
			$gridHTML .= "\t\t\t\t<td>$imageLink</td>\n";
			$gridHTML .= "\t\t\t\t<td>" . $dispArray['label'] . "</td>\n";
			$gridHTML .= "\t\t\t</tr>\n";
		}
		
		echo <<<ENDXXX1
<div id="Main">
	<div id="Init" class="sitePack">
		<table class="stepstable" align="center">
			<thead>
				<tr>
					<th width="16"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
$gridHTML
			</tbody>
		</table>
		
		<div id="Status" style="display: block;">
			<p id="JPStep">$step</p>
			<p id="JPSubstep">$substep</p>
		</div>
ENDXXX1;

		// Force display of progress (Joomla! does not like that... but I can't do any better than that :p)
		if($domain != 'finale')	@ob_flush();
		
		// Perform the backup step, if required
		switch ($action)
		{
			case 'continue':
				error_reporting(E_ALL & ~E_NOTICE);
				$ret = $this->tick(0,0);
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "<-- Finished JSRedirect Call (Continue) -->");
				break;
			case 'new':
				error_reporting(E_ALL & ~E_NOTICE);
				$ret = $this->tick(1,$dbonly);
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "<-- Finished JSRedirect Call (New) -->");
				break;
		}
			
		// Output page redirection JavaScript if we haven't finished already			
		if($domain != 'finale')
		{
			$step = JoomlapackAbstraction::getParam('step', 0);
			$step++;
			$link = JoomlapackAbstraction::JPLink('pack','backup',false,'&step='.$step);
?>
<script type="text/javascript">
	window.location = "<?php echo $link; ?>";
</script>
<?php
		} else {
?>
		<div id="AllDone">
			<p>&nbsp;</p>
			<table border="0" cellspacing="4px;" cellpadding="0">
				<tr>
					<td width="32">
						<img src="<?php echo JoomlapackCommonHTML::getImageURI('ok_big') ?>" border="0" />
					</td>
					<td>
						<h4><?php echo JoomlapackLangManager::_('PACK_FINISHED'); ?></h4>
						<p><?php echo JoomlapackLangManager::_('PACK_FINISHEDTEXT'); ?></p>
					</td>
				</tr>
			</table>
			<a href="<?php echo JoomlapackAbstraction::JPLink('backupadmin'); ?>">
				<div class="jpbutton">
					<img src="<?php echo JoomlapackCommonHTML::getImageURI('bufa') ?>" border="0" />
					<p><?php echo JoomlapackLangManager::_('CPANEL_BUADMIN'); ?></p>
				</div>
			</a>

		</div>
<?php
		}
		
		echo "</div>";
	}
	
	/**
	 * A helper function to populate the $domainDisplayArray which ultimately generated the progress
	 * grid output. This is called once for each domain displayed in the grid.
	 *
	 * @param string $label Text label of the domain
	 * @param int $domainID The unique numeric ID of the domain
	 * @param int $activeDomainID The unique numeric ID of the currently active domain
	 * @param bool $isError Set to true if this domain has failed
	 * @return array
	 * @access private
	 * @since 1.2.b1
	 */
	function _makeStepArrayEntry($label, $domainID, $activeDomainID, $isError = false)
	{
		$ret = array();
		
		// Get the class name and picture for the domain
		if($domainID < $activeDomainID) {
			$ret['pic'] = 'ok_small.png';
			$ret['class'] = 'ok';
		} elseif( $domainID == $activeDomainID ) {
			$ret['pic'] = 'arrow_small.png';
			$ret['class'] = 'active';
		} else {
			$ret['pic'] = '';
			$ret['class'] = '';
		}

		if($isError) {
			$ret['pic'] = 'error_small';
			$ret['class'] = 'error';
		}

		$ret['label'] = $label;

		return $ret;
	}


	/**
	 * Outputs an error condition. Used by the JavaScript Redirects backup method.
	 * It displays all errors found in the class' _errorStack array.
	 * 
	 * @access private
	 * @since 1.2.b1
	 */
	function _echoHTML_Redirects_Error()
	{
?>
<div id="Main">
	<div id="Timeout" style="display:none; margin-top: 10px;" class="sitePack">
		<table border="0" width="100%">
			<tr>
				<td valign="top">
					<img src="<?php echo JoomlapackCommonHTML::getImageURI('error_big') ?>" border="0" />
				</td>
			</tr>
<?php
		foreach( $this->_errorStack as $errorString )
		{
?>
			<tr>
				<td>
					<p><?php echo $errorString ?></p>
				</td>
			</tr>
<?php
}
?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<a href="<?php echo JoomlapackAbstraction::JPLink('log'); ?>">
						<div class="jpbutton">
							<img src="<?php echo JoomlapackCommonHTML::getImageURI('log') ?>" border="0" />
							<p><?php echo JoomlapackLangManager::_('CPANEL_LOG'); ?></p>
						</div>
					</a>					
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('tick', 'errorTrapReporting');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}

	/**
	* Continues the procedure
	* @param $forceStart boolean When set to true, forces the procedure to start over
	*/
	function tick( $forceStart = 0, $forceDBOnly = 0 ){
		jpimport('classes.core.cube');
	
		if ( ($forceDBOnly > 0) && ($forceStart > 0) ) {
			$cube =& JoomlapackCUBE::getInstance( true, true );
		} elseif ( $forceStart > 0 ) {
			$cube =& JoomlapackCUBE::getInstance( true );
		} else {
			$cube =& JoomlapackCUBE::getInstance();
		}
		
		$ret = $cube->tick();
		$cube->save();
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "<-- Finished AJAX Call -->");
	
		return $ret;
	}
	
	function errorTrapReport( $badData ){
		JPSetErrorReporting();
		JoomlapackLogger::WriteLog(_JP_LOG_ERROR, "Last operation failed. Server response:");
		JoomlapackLogger::WriteLog(_JP_LOG_ERROR, htmlspecialchars($badData));
		JPRestoreErrorReporing();
		
		return 1;
	}
}
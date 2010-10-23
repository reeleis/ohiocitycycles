<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		1.1.1b2
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* 
**/

// Ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

/**
 * Frontend full backup functions
 *
 */
class CFullBackup
{
	/**
	 * Key supplied in the request
	 *
	 * @var string
	 */
	var $key;

	function CFullBackup()
	{		
		// Force reloading always
		header ("Cache-Control: no-cache, must-revalidate");	// HTTP/1.1
		header ("Pragma: no-cache");	// HTTP/1.0
		
		// Check if the user can perform this operation 
		$this->_authenticate();
	}
	
	/**
	 * Static method to return the loaded instance of the class, or create a new if none is present.
	 * Implements the Singleton desing pattern
	 *
	 * @return CFullBackup
	 */
	function getInstance()
    {
		static $instance;
		
		$c = __CLASS__;
		return isset($instance) ? $instance : $instance = new $c;
	}
	
	/**
	 * Perform a step of the backup process
	 */
	function tick()
	{
		$task = JoomlapackAbstraction::getParam( 'task', 'init' );
		$error = JoomlapackAbstraction::getParam( 'error', false );
		$tweak = JoomlapackAbstraction::getParam('tweak', 'http');
		
		jpimport('classes.core.utility.configuration');
		jpimport('classes.core.cube');
		
		switch( $task )
		{
			case 'init':
				$ret = $this->_do(1);
				if($tweak == 'browser')
				{
					echo "<html><head><meta http-equiv=\"refresh\" content=\"0;". $this->_getNewURI(false) . "\" /></head><body></body></html>";
				} else {
					header( 'Location: ' . $this->_getNewURI(false) );
				}
				break;
			
			case 'continue':
				$ret = $this->_do();
				
				if ($ret['Error'] != "") {
					if($tweak == 'browser') {
						echo "<html><head><meta http-equiv=\"refresh\" content=\"0;". $this->_getNewURI(true,true) . "\" /></head><body></body></html>";
					} else {
						header( 'Location: ' . $this->_getNewURI(true, true) );
					}
				} elseif( $ret['Domain'] == 'finale' ) {
					if($tweak == 'browser') {
						echo "<html><head><meta http-equiv=\"refresh\" content=\"0;". $this->_getNewURI(true) . "\" /></head><body></body></html>";
					} else {
						header( 'Location: ' . $this->_getNewURI(true) );
					}
				} else {
					if($tweak == 'browser') {
						echo "<html><head><meta http-equiv=\"refresh\" content=\"0;". $this->_getNewURI(false) . "\" /></head><body></body></html>";
					} else {
						header( 'Location: ' . $this->_getNewURI(false) );
					}
				}

				break;
			
			case 'finished':
				if( $error )
				{
					global $CUBE;
					loadJPCUBE();
					echo JoomlapackLangManager::_('FRONTEND_STATUS500');
					echo $CUBE->_Error;
				} else {
					echo JoomlapackLangManager::_('FRONTEND_STATUS200');
				}
				break;
			
			default:
				echo JoomlapackLangManager::_('FRONTEND_ACCESSDENIED');
				break;
		}
	}
	
	/**
	 * Check for authorized use of this file, or die with 'Access Denied' message
	 *
	 */
	function _authenticate()
	{
		jpimport('classes.core.utility.configuration');
		$JPConfiguration = JoomlapackConfiguration::getInstance();
		
		// Check if the frontend backup option is enabled
		if( !$JPConfiguration->enableFrontend )
		{
			die( JoomlapackLangManager::_('FRONTEND_ACCESSDENIED') );
		}
		
		// Get key supplied in $_REQUEST
		$key1 = JoomlapackAbstraction::getParam('key', '');
		$key2 = JoomlapackAbstraction::getParam('secret', '');
		
		if( ($key1 == '') && ($key2 != '') ) {
			$this->key = $key2;
		} elseif( ($key1 != '') && ($key2 == '') ) {
			$this->key = $key1;
		} else {
			$this->key = '';
		}

		// Compare keys
		if( $this->key != $JPConfiguration->secretWord ) {
			die( JoomlapackLangManager::_('FRONTEND_ACCESSDENIED') );
		}
		
		// Check no_html (must be '1')
		$no_html = JoomlapackAbstraction::getParam('no_html', 0);
		if( $no_html != 1 ) {
			die( JoomlapackLangManager::_('FRONTEND_ACCESSDENIED') );
		}
	}
	
	/**
	 * Runs the CUBE tick
	 *
	 * @param integer $forceStart When set to 1 it forces a new instance of the CUBE to be created
	 * 
	 * @return array Status information from the CUBE
	 */
	function _do( $forceStart = 0 )
	{
		global $CUBE;
		
		if ( $forceStart > 0 ) {
			$this->_checkCollision(); // Collision detection
			$CUBE =& JoomlapackCUBE::getInstance( true, false );
		} else {
			$CUBE =& JoomlapackCUBE::getInstance( false );
		}

		$ret = $CUBE->tick();
		
		$CUBE->save();
		
		return $ret;
	}
	
	function _getNewURI($finished = false, $error = false)
	{		
		$option = JoomlapackAbstraction::getParam( 'option' );
		$key = JoomlapackAbstraction::getParam( 'key' );
		$dummy = JoomlapackAbstraction::getParam('dummy', 0);
		$tweak = JoomlapackAbstraction::getParam('tweak', 'http');
		$dummy++;

		if ($finished) {
			if ($error) {
				return JoomlapackAbstraction::SiteURI() . "/index2.php?option=$option&act=fullbackup&task=finished&error=1&key=$key&no_html=1";
			} else {
				return JoomlapackAbstraction::SiteURI() . "/index2.php?option=$option&act=fullbackup&task=finished&key=$key&no_html=1";
			}
		} else {
			return JoomlapackAbstraction::SiteURI() . "/index2.php?option=$option&act=fullbackup&task=continue&key=$key&no_html=1&dummy=$dummy&tweak=$tweak";
		}
	}
	
	function _checkCollision()
	{
		jpimport('classes.core.utility.configuration');

		$lastLock = JoomlapackTables::ReadVar('CUBELock');
		
		// Expire CUBE lock after two minutes of inactivity
		if(is_null($lastLock))
		{
			$noLock = true;
		} else {
			$now = time();
			$noLock = ($now - $lastLock) > 120;
		}
		
		if( !$noLock )
		{
			die( JoomlapackLangManager::_('FRONTEND_STATUS501') );
		}
		
	}
}
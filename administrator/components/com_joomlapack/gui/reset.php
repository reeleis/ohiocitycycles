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

class JoomlapackPageReset
{
	/**
	 * Sigleton
	 *
	 * @return JoomlapackPageReset
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageReset();
		}
		
		return $instance;
	}
	
	function echoHTML()
	{
		jpimport('helpers.lang');
		
		$errorStack = array(); // Initialize an errors stack 
		
		// Cleanup locks
		jpimport('classes.core.cube');
		JoomlapackCUBE::cleanup();
		
		// Test for the existence of a default temporary folder
		if( !is_dir(JPATH_COMPONENT_ADMINISTRATOR.DS.'backup') )
		{
			// Temp dir doesn't exist; try to create one
			if(! @mkdir( JPATH_COMPONENT_ADMINISTRATOR.DS.'backup' ) )
			{
				$errorStack[] = JoomlapackLangManager::_('UNLOCK_CANTCREATEDIR');
			} else {
				// Try creating a deafult .htaccess
				$htaccess = <<<END
Deny from all
END;
				$fp = @fopen( JPATH_COMPONENT_ADMINISTRATOR.DS.'backup'.DS.'.htaccess' );
				if( $fp === false )
				{
					$errorStack[] = JoomlapackLangManager::_('UNLOCK_CANTCREATEHTACCESS');
				} else {
					@fputs( $fp, $htaccess );
					@fclose( $fp );
				}
			}
			
		}
		
		// Get some more HTML fragments
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_UNLOCK') );
		
		?>
		<p>
		<?php
			if( count($errorStack) == 0 ) {
				echo JoomlapackLangManager::_('UNLOCK_DONE');
			} else {
				foreach( $errorStack as $error )
				{
					echo "<p class=\"error\">$error</p>";
				}
			}
		?>
		</p>
		<?php
	}
}
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

class JoomlapackPageLogView
{
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageLogView
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageLogView();
		}
		
		return $instance;
	}
	
	/**
	 * Displays the HTML for this page
	 * 
	 */
	function echoHTML()
	{
		$nohtml = JoomlapackAbstraction::getParam('no_html', 0);
		
		if($nohtml == 1)
		{
			JoomlapackLogger::VisualizeLogDirect();
		}
		else
		{
			$configuration =& JoomlapackConfiguration::getInstance();
			
			$option = JoomlapackAbstraction::getParam('option','com_joomlapack');
			
			// Show top header
			echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('LOG_LOGBANNER') );
			
			echo "<p><a href=\"index2.php?option=$option&act=dllog&no_html=1\">". JoomlapackLangManager::_('LOG_DOWNLOADTEXT') ."</a></p>";
			
			echo '<iframe src="index2.php?option='.$option.'&act=log&no_html=1" width="90%" height="400px">';
			echo '</iframe>';
		}
	}
}
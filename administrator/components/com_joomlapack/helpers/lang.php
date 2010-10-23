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

// Ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

class JoomlapackLangManager
{
	var $translations = null;		// The loaded translations array
	var $lang = "";					// User-selected language

	/**
	 * Initialises the class by loading the languages and populating the global $JPLang  
	 *
	 * @return JoomlapackLangManager
	 */
	function JoomlapackLangManager()
	{
		die('Creating objects of JoomlapackLangManager is not allowed');
	}
	
	/**
	 * Translation function, based on a translation key
	 *
	 * @param string $key The key to translate
	 * @return string The translation, or the key of the translation wasn't found
	 */
	function _($key)
	{
		static $translations;
		
		// Load translations on first call
		if(!$translations)
		{
			// Get local language
			if( !defined('_JEXEC') )
			{
				global $mosConfig_lang;
				$lang = $mosConfig_lang;	
			} else {
				$language	=& JFactory::getLanguage();
				$lang		=  $language->getBackwardLang();
			}
		
			// Load default language (English)
			$langEnglish = JoomlapackAbstraction::parse_ini_file( JPATH_COMPONENT_ADMINISTRATOR.DS.'lang'.DS.'english.ini', false);

			// Load user's language file, if exists
			if (file_exists( JPATH_COMPONENT_ADMINISTRATOR . "/lang/$lang.ini" )) {
				$langLocal = JoomlapackAbstraction::parse_ini_file( JPATH_COMPONENT_ADMINISTRATOR.DS.'lang'.DS."$lang.ini", false );
				if( is_array($langLocal) )
				{
					$translations = array_merge($langEnglish, $langLocal);
				}
				else
				{
					$translations = $langEnglish;
				}
				// # END FIX 1.2.b2
			} else {
				$translations = $langEnglish;
			}
			
			unset($langEnglish);
			unset($langLocal);
		}
		
		if(key_exists($key, $translations))
		{
			return $translations[$key];
		}
		else
		{
			return $key;
		}
	}
}
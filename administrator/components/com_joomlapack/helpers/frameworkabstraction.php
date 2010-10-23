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

/**
 * Provides static methods to abstract source-level differences between
 * Joomla! 1.0.x (built upon the Mambo codebase and coding conventions)
 * and Joomla! 1.5.x (built upon Joomla! Framework 1.5.x).
 *
 */
class JoomlapackAbstraction
{
	
	/**
	 * Discourage creating objects from this class
	 *
	 * @return JoomlapackAbstraction
	 */
	function JoomlapackAbstraction()
	{
		die('JoomlapackAbstraction does not support object creation.');
	}
	
	/**
	 * Gets a parameter value from the $_REQUEST object
	 *
	 * @param string $paramName The parameter name
	 * @param string $defaultValue The default value (null if not specified)
	 * @return mixed The parameter value
	 */
	function getParam( $paramName, $defaultValue = null )
	{
		if( !defined('_JEXEC') ) {
			return mosGetParam( $_REQUEST, $paramName, $defaultValue );
		} else {
			return JRequest::getVar($paramName, $defaultValue);
		}
	}
	
	/**
	 * Returns the site's base URI
	 *
	 * @return string The site's URI, e.g. http://www.example.com
	 */
	function SiteURI()
	{
		static $uri; // 1.2.2 - Added caching
		
		if(!defined('_JEXEC'))
		{
			if(!$uri)
			{
				// Fix 1.2.2 -- Smart URL determination compatible with rare setups where Apache reports wrong domain name
				global $mosConfig_live_site;

				$uri = $mosConfig_live_site;
				// Detect HTTPS
				if( !(empty($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] == 'off')) )
				{
					$uri = str_replace('http://','https://',$uri);
				}
			}
			
			return $uri;
		}
		else
		{
			if(!$uri)
			{
				$uri = substr_replace(JURI::root(), '', -1, 1);
			}

			return $uri;
		}
	}
	
	/**
	 * Returns a URI to a JoomlaPack function, defined by act and task
	 *
	 * @param string $act The JP action to perform 
	 * @param string $task The JP task (if any) associated to the action to perform
	 * @param bool $nohtml Set to true in order to suppress Joomla!'s regular HTML output
	 * @param string $miscOptions Any options to append to the URI
	 * 
	 * @return string
	 */
	function JPLink( $act, $task = "", $nohtml = false, $miscOptions = "" )
	{
		$link = JoomlapackAbstraction::SiteURI() . '/administrator/index2.php?';
		$link .= "option=" . JoomlapackAbstraction::getParam('option', 'com_joomlapack');
		$link .= ($act == "") ? "" : "&act=$act";
		$link .= ($task == "") ? "" : "&task=$task";
		$link .= $nohtml ? "&no_html=1" : "";
		$link .= ($miscOptions == "") ? "" : "&$miscOptions";
		
		return $link;
	}
	
	/**
	 * Makes a Windows path more UNIX-like, by turning backslashes to forward slashes
	 *
	 * @param string $p_path The path to transform
	 * @return string
	 */
	function TranslateWinPath( $p_path )
    {
		if (DIRECTORY_SEPARATOR == '\\'){ # 1.2.1 Do not use php_uname()
			// Change potential windows directory separator
			if ((strpos($p_path, '\\') > 0) || (substr($p_path, 0, 1) == '\\')){
				$p_path = strtr($p_path, '\\', '/');
			}
		}
		return $p_path;
	}
	
	/**
	 * Returns Joomla!'s database object
	 *
	 * @param bool $forceNewInstance When true, will attempt to reconnect to database
	 * @return JDatabase
	 */
	function getDatabase($forceNewInstance = false)
	{
		if( defined('_JEXEC') )
		{
			$database 	= & JFactory::getDBO();
		} else {
			// Joomla! 1.0.x
			global $database;
		}
		return $database;
	}
	
	/**
	 * Imports a JoomlaPack file from its relevant folder using require_once
	 *
	 * @param string $file Dotted notation
	 * @param boolean $backend If true, uses backend directory. If false, uses includes directory.
	 */
	function import( $file, $backend = true )
	{
		$expanded = explode('.', $file);
		$file = implode(DS,$expanded);
		
		if( $backend ) {
			$base = JPATH_COMPONENT_ADMINISTRATOR;
		} else {
			$base = JPATH_COMPONENT;
		}
		
		require_once $base.DS.$file.'.php';
	}
	
	/**
	 * Expands the archive's template name and returns an absolute path
	 *
	 * @param string $extension The extension to append, defaults to '.zip'
	 * @return string The absolute filename of the archive file requested
	 */
	function getExpandedTarName( $extension = '.zip' )
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		// Get the proper extension
		$templateName = $configuration->get('TarNameTemplate');
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Archive template name: $templateName");

		// Parse [DATE] tag
		$dateExpanded = strftime("%Y%m%d", time());
		$templateName = str_replace("[DATE]", $dateExpanded, $templateName);

		// Parse [TIME] tag
		$timeExpanded = strftime("%H%M%S", time());
		$templateName = str_replace("[TIME]", $timeExpanded, $templateName);

		// Parse [HOST] tag
		$templateName = str_replace("[HOST]", $_SERVER['SERVER_NAME'], $templateName);

		// Parse [RANDOM] tag
		$templateName = str_replace("[RANDOM]", md5(microtime()) , $templateName);

		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Expanded template name: $templateName");
		
		$path = $configuration->get('OutputDirectory').DS.$templateName.$extension;
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Calculated archive absolute path: $path");
		
		// What the hell was I thinking when I had put realpath($path) in here?!?!?!
		return JoomlapackAbstraction::TranslateWinPath( $path );
	}
	
	function getDBPrefix()
	{
		if( !defined('_JEXEC') )
		{
			global $mosConfig_dbprefix;
			return $mosConfig_dbprefix;
		} else {
			$conf =& JFactory::getConfig();
			return $conf->getValue('config.dbprefix');
		}
	}

	/**
	 * Parse an INI file and return an associative array. Since PHP versions before 5.1 are
	 * bitches with regards to INI parsing, I use a PHP-only solution to overcome this
	 * obstacle.
	 *
	 * @param string $file The file to process
	 * @param bool $process_sections True to also process INI sections
	 * @return array An associative array of sections, keys and values
	 */
	function parse_ini_file( $file, $process_sections )
	{
		if( version_compare(PHP_VERSION, '5.1.0', '>=') )
		{
			return parse_ini_file($file, $process_sections);
		} else {
			return JoomlapackAbstraction::_parse_ini_file($file, $process_sections);
		}
	}
	
	/**
	 * A PHP based INI file parser.
	 * 
	 * Thanks to asohn ~at~ aircanopy ~dot~ net for posting this handy function on
	 * the parse_ini_file page on http://gr.php.net/parse_ini_file
	 * 
	 * @param string $file Filename to process
	 * @param bool $process_sections True to also process INI sections
	 * @return array An associative array of sections, keys and values
	 * @access private
	 */
	function _parse_ini_file($file, $process_sections = false)
	{
		  $process_sections = ($process_sections !== true) ? false : true;

		  $ini = file($file);
		  if (count($ini) == 0) {return array();}
		
		  $sections = array();
		  $values = array();
		  $result = array();
		  $globals = array();
		  $i = 0;
		  foreach ($ini as $line) {
		    $line = trim($line);
		    $line = str_replace("\t", " ", $line);
		
		    // Comments
		    if (!preg_match('/^[a-zA-Z0-9[]/', $line)) {continue;}
		
		    // Sections
		    if ($line{0} == '[') {
		      $tmp = explode(']', $line);
		      $sections[] = trim(substr($tmp[0], 1));
		      $i++;
		      continue;
		    }
		
		    // Key-value pair
		    list($key, $value) = explode('=', $line, 2);
		    $key = trim($key);
		    $value = trim($value);
		    if (strstr($value, ";")) {
		      $tmp = explode(';', $value);
		      if (count($tmp) == 2) {
		        if ((($value{0} != '"') && ($value{0} != "'")) ||
		            preg_match('/^".*"\s*;/', $value) || preg_match('/^".*;[^"]*$/', $value) ||
		            preg_match("/^'.*'\s*;/", $value) || preg_match("/^'.*;[^']*$/", $value) ){
		          $value = $tmp[0];
		        }
		      } else {
		        if ($value{0} == '"') {
		          $value = preg_replace('/^"(.*)".*/', '$1', $value);
		        } elseif ($value{0} == "'") {
		          $value = preg_replace("/^'(.*)'.*/", '$1', $value);
		        } else {
		          $value = $tmp[0];
		        }
		      }
		    }
		    $value = trim($value);
		    $value = trim($value, "'\"");
		
		    if ($i == 0) {
		      if (substr($line, -1, 2) == '[]') {
		        $globals[$key][] = $value;
		      } else {
		        $globals[$key] = $value;
		      }
		    } else {
		      if (substr($line, -1, 2) == '[]') {
		        $values[$i-1][$key][] = $value;
		      } else {
		        $values[$i-1][$key] = $value;
		      }
		    }
		  }
		
		  for($j = 0; $j < $i; $j++) {
		    if ($process_sections === true) {
		      $result[$sections[$j]] = $values[$j];
		    } else {
		      $result[] = $values[$j];
		    }
		  }
		
		  return $result + $globals;
	}

	/**
	 * Reads the JoomlaPack version information out of joomlapack.xml and defines two constants 
	 *
	 */
	function getJoomlaPackVersion()
	{
		require_once( JPATH_SITE.DS.'includes'.DS.'domit'.DS.'xml_domit_lite_include.php' );
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if ($xmlDoc->loadXML( JPATH_COMPONENT_ADMINISTRATOR.DS.'joomlapack.xml', false, true )) {
			$root = &$xmlDoc->documentElement;
			$e = &$root->getElementsByPath('version', 1);
			define("_JP_VERSION", $e->getText()) ;
			$root = &$xmlDoc->documentElement;
			$e = &$root->getElementsByPath('creationDate', 1);
			define("_JP_DATE", $e->getText()) ;
		} else {
			define("_JP_VERSION", "1.2 Series SVN");
			define("_JP_DATE", "");
		}
	}
	
	/**
	 * Returns true if the script is called within a SAJAX request 
	 *
	 * @return bool
	 */
	function isSAJAX()
	{
		static $isAJAX = null;
		
		if(is_null($isAJAX)) {
			// The rsrnd SAJAX param must be set and no_html must be 1
			$isAJAX = isset($_REQUEST['rsrnd']) && ($_REQUEST['no_html'] == 1);
		}
		
		return $isAJAX;
	}
}

/**
 * Shorthand to JoomlapackAbstraction::import
 *
 * @param string $file Dotted notation
 * @param bool $isBackend True to use backend (administrator) folder
 */
function jpimport($file, $isBackend = true)
{
	JoomlapackAbstraction::import($file, $isBackend);
}
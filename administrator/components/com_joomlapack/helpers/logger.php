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

// Log levels
define("_JP_LOG_NONE",		0);
define("_JP_LOG_ERROR",		1);
define("_JP_LOG_WARNING",	2);
define("_JP_LOG_INFO",		3);
define("_JP_LOG_DEBUG",		4);

class JoomlapackLogger
{
	/**
	 * Clears the logfile
	 */
	function ResetLog() {
		$logName = JoomlapackLogger::logName();
		if( file_exists($logName) )	@unlink( $logName );
		touch( $logName );
	}

	/**
	 * Writes a line to the log, if the log level is high enough
	 *
	 * @param integer $level The log level (_JP_LOG_XX constants)
	 * @param string $message The message to write to the log
	 */
	function WriteLog( $level, $message )
	{
		$configuration =& JoomlapackConfiguration::getInstance();

		if( ($configuration->get('logLevel') >= $level) && ($configuration->get('logLevel') != 0))
		{
			$logName = JoomlapackLogger::logName();
			$message = str_replace( JPATH_SITE, "<root>", $message );
			$message = str_replace( "\n", '\n', $message ); // Fix 1.1.1 - Handle (error) messages containing newlines (by nicholas)
			switch( $level )
			{
				case _JP_LOG_ERROR:
					$string = "ERROR   |";
					break;
				case _JP_LOG_WARNING:
					$string = "WARNING |";
					break;
				case _JP_LOG_INFO:
					$string = "INFO    |";
					break;
				default:
					$string = "DEBUG   |";
					break;
			}
			$string .= strftime( "%y%m%d %R" ) . "|$message\n";
			$fp = fopen( $logName, "at" );
			if (!($fp === FALSE))
			{
				fwrite( $fp, $string );
				fclose( $fp );
			}
		}
	}

	/**
	 * Parses the log file and outputs formatted HTML to the standard output
	 */
	function VisualizeLogDirect()
	{
		$logName = JoomlapackLogger::logName();
		if(!file_exists($logName)) return false; //joostina pach
		$fp = fopen( $logName, "rt" );
		if ($fp === FALSE) return false;

		while( !feof($fp) )
		{
			$line = fgets( $fp );
			if(!$line) return;
			$exploded = explode( "|", $line, 3 );
			unset( $line );
			switch( trim($exploded[0]) )
			{
				case "ERROR":
					$fmtString = "<span style=\"color: red; font-weight: bold;\">[";
					break;
				case "WARNING":
					$fmtString = "<span style=\"color: #D8AD00; font-weight: bold;\">[";
					break;
				case "INFO":
					$fmtString = "<span style=\"color: black;\">[";
					break;
				case "DEBUG":
					$fmtString = "<span style=\"color: #666666; font-size: small;\">[";
					break;
				default:
					$fmtString = "<span style=\"font-size: small;\">[";
					break;
			}
			$fmtString .= $exploded[1] . "] " . htmlspecialchars($exploded[2]) . "</span><br/>\n";
			unset( $exploded );
			echo $fmtString;
			unset( $fmtString );
			ob_flush();
		}
		//ob_flush();
	}

	/**
	 * Calculates the absolute path to the log file
	 */
	function logName()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		return JoomlapackAbstraction::TranslateWinPath( $configuration->get('OutputDirectory').DS."joomlapack.log");
	}

}
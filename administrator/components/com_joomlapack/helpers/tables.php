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
 * Provides static functions to reading / writing data to & from JoomlaPack's database table
 * (the #__jp_packvars table)
 */
class JoomlapackTables
{
	
	/**
	 * Writes a variable to the database (#__jp_packvars)
	 *
	 * @param string $varName The name of the variable (must be unique; if it exists it gets overwritten)
	 * @param string $value The value to store
	 * @param bool $boolLongText True if you want to store a large string; deprecated since 1.1.2b
	 * @static
	 */
	function WriteVar( $varName, $value, $boolLongText = false ){
		$database = JoomlapackAbstraction::getDatabase();

		// Hopefully fixes the 'MySQL server has gone away' errors by testing MySQL
		// connection status and reconnecting if necessary.
		if(method_exists($database, 'connected')) $database->connected();			
		
		// Kill exisiting variable (if any)
		JoomlapackTables::DeleteVar( $varName );

		// Create variable
		$sql = "INSERT INTO #__jp_packvars (`key`, value2) VALUES (" . $database->Quote( $varName ) . ", " .$database->Quote( $value ) . ")";

		$database->setQuery( $sql );
		if($database->query() === false)
		{
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR,'Failed to store packing variable '.$varName.' in database.');
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR,'Error Message: '.$database->getErrorMsg());
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR,'Value was '.$value);
			return false;
		}
		
		return true;
	}

	/**
	 * Reads a variable out of #__jp_packvars
	 *
	 * @param string $key The name of the variable to read
	 * @param bool $boolLongText True if you want to store a large string; deprecated since 1.1.2b
	 * @return string
	 * @static
	 */
	function ReadVar( $key, $boolLongText = false ) {
		$database = JoomlapackAbstraction::getDatabase();
		
		$sql = "SELECT value2 FROM #__jp_packvars WHERE `key` = \"" . $database->getEscaped( $key ) . "\"";
		$database->setQuery( $sql );
		$database->query();
		return $database->loadResult();
	}
	
	/**
	 * Removes a variable from #__jp_packvars
	 *
	 * @param string $varName The variable to remove
	 * @static
	 */
	function DeleteVar( $varName )
	{
		$database = JoomlapackAbstraction::getDatabase();
		$database->setQuery( "DELETE FROM #__jp_packvars WHERE `key`=\"" . $database->getEscaped($varName) . "\"" );
		$database->query();
	}
	
	/**
	 * Removes all variables matching a pattern from #__jp_packvars
	 *
	 * @param string $keyPattern The name pattern the variables to be removed must follow
	 * @static
	 */
	function DeleteMultipleVars( $keyPattern )
	{
		$database = JoomlapackAbstraction::getDatabase();
		$database->setQuery( "DELETE FROM #__jp_packvars WHERE `key` LIKE \"" . $keyPattern . "\"" );
		$database->query();
	}
	
	/**
	 * Counts the number of instances for a specific variable
	 *
	 * @param string $key The varaible's name
	 * @return string
	 */
	function CountVar( $key )
	{
		$database = JoomlapackAbstraction::getDatabase();
		$sql = "SELECT `key` FROM #__jp_packvars WHERE `key` = \"" . $database->getEscaped( $key ) . "\"";
		$database->setQuery( $sql );
		$database->query();
		return $database->getNumRows();		
	}

	/**
	 * Reads and unserializes a packvar variable (combo function)
	 *
	 * @param string $varName The variable name to read
	 * @param mixed $default The default unserialized data to return if the $varName doesn't exist
	 * @return mixed The unserialized value read from database
	 */
	function UnserializeVar( $varName, $default = null )
	{
		if( JoomlapackTables::CountVar($varName) >=1 )
		{
			$serialized = JoomlapackTables::ReadVar($varName);
			return unserialize($serialized);
		}
		else
		{
			return $default;
		}
	}
	
	/**
	 * Writes a serialized copy of the $contentVariable to the database, under the packvar
	 * variable name of $varName.
	 *
	 * @param string $varName The packvar to create
	 * @param mixed $contentVariable Any variable to serialize (e.g. object, array, other variables, etc) 
	 */
	function SerializeVar( $varName, &$contentVariable )
	{
		$serialized = serialize($contentVariable);
		JoomlapackTables::WriteVar($varName, $serialized);
	}
}
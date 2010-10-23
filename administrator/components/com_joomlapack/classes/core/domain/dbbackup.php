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
 * Multiple database backup engine.
 */
class JoomlapackDomainDBBackup extends JoomlapackEngineParts
{
	/**
	 * A list of the databases to be packed
	 *
	 * @var array
	 */
	var $_databaseList = array();
	
	/**
	 * The current instance of JoomlapackDumperDefault used to backup tables
	 *
	 * @var JoomlapackDumperDefault
	 */
	var $_dumper = null;
	
	/**
	 * The current index of _databaseList
	 *
	 * @var integer
	 */
	var $_currentListIndex = null;
	
	/**
	 * Implements the constructor of the class
	 *
	 * @return JoomlapackDomainDBBackup
	 */
	function JoomlapackDomainDBBackup()
	{
		$this->_DomainName = "PackDB";
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: New instance");		
	}
	
	/**
	 * Implements the _prepare abstract method
	 *
	 */
	function _prepare()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Preparing instance");
		$this->_getDatabaseList();
		if($this->isError()) return false;
		$this->_currentListIndex = 0;
		$this->_isPrepared = true;
		$this->_hasRan = false;
	}
	
	/**
	 * Implements the _run() abstract method
	 */
	function _run()
	{
		if( $this->_hasRan )
		{
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Already finished");
			$this->_isRunning = false;
			$this->_hasRan = true;
			$this->_Step = '';
			$this->_Substep = '';			
		} else {
			$this->_isRunning = true;
			$this->_hasRan = false;			
		}
		
		
		// Make sure we have a JoomlapackDumperDefault instance loaded!
		if(is_null( $this->_dumper ))
		{
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Iterating next database");
			// Create a new instance
			$cube =& JoomlapackCUBE::getInstance();
			$this->_dumper =& $cube->getDBPackerEngine(true);
			// Configure the dumper instance
			$this->_dumper->setup( $this->_databaseList[$this->_currentListIndex] );
			// Error propagation
			if($this->_dumper->hasError())
			{
				$this->setError($this->_dumper->getError(), true);
				return false;
			}
			// Warning propagation
			if($this->_dumper->hasWarning())
			{
				foreach($this->_dumper->getWarning() as $warning)
				{
					$this->setWarning($warning, true);
				}
			}
		}
		
		// Try to step the instance
		$retArray = $this->_dumper->tick();
		// Error propagation
		if($this->_dumper->hasError())
		{
			$this->setError($this->_dumper->getError(), true);
			return false;
		}
		// Warning propagation
		if($this->_dumper->hasWarning())
		{
			foreach($this->_dumper->getWarning() as $warning)
			{
				$this->setWarning($warning, true);
			}
		}
		
		$this->_Step = $retArray['Step'];
		$this->_Substep = $retArray['Substep'];

		// Check if the instance has finished
		if(!$retArray['HasRun'])
		{
			// The instance has finished; go to the next entry in the list and dispose the old JoomlapackDumperDefault instance
			$this->_currentListIndex++;
			$this->_dumper = null;
			
			// Are we past the end of the list?
			if($this->_currentListIndex > (count($this->_databaseList)-1) )
			{
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: No more databases left to iterate");
				$this->_hasRan = true;
				$this->_isRunning = false;
			}
		}
		
	}
	
	/**
	 * Implements the _finalize() abstract method
	 *
	 */
	function _finalize()
	{
		$this->_isFinished = true;
		
		// If we are in db backup mode, don't create a databases.ini
		$cube =& JoomlapackCUBE::getInstance();
		if ($cube->_OnlyDBMode) {
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Skipping databases.ini");
			return;
		}
		
		
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Creating databases.ini");
		// Create a new string
		$databasesINI = '';
		
		// Loop through databases list
		foreach( $this->_databaseList as $definition )
		{
			// Joomla! core database comes with no parameters; we must retrieve them
			if( $definition['isJoomla'] )
			{
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Adding Joomla definition");
				if( !defined('_JEXEC') )
				{
					// Joomla! 1.0 parameters
					global $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix;
					$definition['host']     = $mosConfig_host;
					$definition['username'] = $mosConfig_user;
					$definition['password'] = $mosConfig_password;
					$definition['database'] = $mosConfig_db;
					$definition['prefix']   = $mosConfig_dbprefix;
					$definition['dumpFile'] = 'joomla.sql';
				} else {
					// Joomla! 1.5 parameters
					jimport('joomla.database.database');
					jimport( 'joomla.database.table' );
					
					$conf =& JFactory::getConfig();
					$definition['host']     = $conf->getValue('config.host');
					$definition['username'] = $conf->getValue('config.user');
					$definition['password'] = $conf->getValue('config.password');
					$definition['database'] = $conf->getValue('config.db');
					$definition['prefix']   = $conf->getValue('config.dbprefix');
					$definition['dumpFile'] = 'joomla.sql';
				}
			} else {
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Adding extra database definition");
				$definition['prefix'] = '';
			}
			
			$section = basename($definition['dumpFile']);
			
			$databasesINI .= <<<ENDDEF
[$section]
dbname = "{$definition['database']}"
sqlfile = "{$definition['dumpFile']}"
dbhost = "{$definition['host']}"
dbuser = "{$definition['username']}"
dbpass = "{$definition['password']}"
prefix = "{$definition['prefix']}"

ENDDEF;
			
		}
		
		// BEGIN FIX 1.2 Stable -- databases.ini isn't written on disk
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Writing databases.ini contents");
		$cube =& JoomlapackCUBE::getInstance();
		$archiver =& $cube->getArchiverEngine();
		$archiver->addVirtualFile('databases.ini','installation/sql',$databasesINI);
			// Error propagation
			if($archiver->hasError())
			{
				$this->setError($archiver->getError(), true);
				return false;
			}
			// Warning propagation
			if($archiver->hasWarning())
			{
				foreach($archiver->getWarning() as $warning)
				{
					$this->setWarning($warning, true);
				}
			}
		
	}
	
	/**
	 * Populates _databaseList with the list of databases in the settings
	 *
	 */
	function _getDatabaseList()
	{
		/*
		 * Logic:
		 * Add an entry for the Joomla! database
		 * If we are in DB Only mode, return
		 * Otherwise, itterate the configured databases and add them if and only if all settings are populated
		 */
		
		// Cleanup the _databaseList array
		$this->_databaseList = array();
		
		// Add a new record for the core Joomla! database
		$entry = array(
			'isJoomla' => true,
			'useFilters' => true,
			'host' => '',
			'port' => '',
			'username' => '',
			'password' => '',
			'database' => '',
			'dumpFile' => ''
		);
		
		$this->_databaseList[] = $entry;
		
		$cube =& JoomlapackCUBE::getInstance();
		if ($cube->_OnlyDBMode) {
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackDomainDBBackup :: Skipping extra databases definitions");
			return;
		}
		
		$extraDefs = JoomlapackHelperFiltertable::getInclusionList('multidb');
		if( count($extraDefs) > 0 )
		{
			foreach( $extraDefs as $def )
			{
				$entry = array(
					'isJoomla' => false,
					'useFilters' => false,
					'host' => $def['host'],
					'port' => $def['port'],
					'username' => $def['username'],
					'password' => $def['password'],
					'database' => $def['database'],
					'dumpFile' => $def['id'] . '-' . $def['database'] . '.sql'
				);
				$this->_databaseList[] = $entry;
			}
		}
	}
}
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

// Include the JoomlaPack database variable storage utility class and CUBE engine classes
jpimport('helpers.tables');
jpimport('classes.core.domain.dbbackup');
jpimport('classes.core.domain.pack');
jpimport('classes.core.utility.filtermanager');

// Import Smart algorithm magic numbers
$configuration =& JoomlapackConfiguration::getInstance();
if(!defined('mnMaxExecTimeAllowed'))	define('mnMaxExecTimeAllowed',	$configuration->get('mnMaxExecTimeAllowed'));
if(!defined('mnMinimumExectime'))		define('mnMinimumExectime',		$configuration->get('mnMinimumExectime'));
if(!defined('mnExectimeBiasPercent'))	define('mnExectimeBiasPercent',	$configuration->get('mnExectimeBiasPercent')/100);
unset($configuration);


/**
 * CUBE : Componentized Universal Backup Engine, is the heart and brains of JoomlaPack. It consists
 * of this central managements class, partly a Factory and partly a Director, managing all of the
 * backup process aspects: engine provisioning, temporary files management, backup workflow. Each
 * "domain" class takes care of one of the two fundamental backup operations (database backup and
 * filesystem backup). Engines take care of the specifics of database dumping, filesystem scanning
 * and archive creation. A constellation of helper classes implement supportive fuctions (e.g. log,
 * configuration and filter management).
 * 
 * JoomlapackCUBE implements the second CUBE generation (CUBE2), aiming at unparalleled flexibility
 * through an easily extensible infrastructure of filter and engine classes.
 * 
 * This class is the central management API part, which is exposed to the overlaied application
 *
 */
class JoomlapackCUBE extends JoomlapackObject {
	/**
	 * Current domain of operation
	 *
	 * @var string
	 * @access private
	 */
	var $_currentDomain;

	/**
	 * Current step
	 *
	 * @var string
	 * @access private
	 */
	var $_currentStep;

	/**
	 * Current substep
	 *
	 * @var string
	 * @access private
	 */
	var $_currentSubstep;

	/**
	 * Current engine object executing work
	 *
	 * @var JoomlapackEngineParts
	 * @access private
	 */
	var $_currentObject;

	/**
	 * Indicates if we are done
	 *
	 * @var boolean
	 * @access private
	 */
	var $_isFinished;

	/**
	 * The current error, if any
	 *
	 * @var string
	 * @access private
	 */
	var $_Error;

	/**
	 * Should we backup only the database contents and nothing more?
	 *
	 * @var boolean
	 * @access private
	 */
	var $_OnlyDBMode;
	
	/**
	 * An instance of the JoomlapackFilterManager
	 *
	 * @var JoomlapackFilterManager
	 * @access public
	 */
	var $FilterManager;
	
	/**
	 * The produced archive's extension, e.g. .jpa
	 *
	 * @var string
	 */
	var $_archiveExtension;
	
	/**
	 * JoomlapackArchiver instance
	 *
	 * @var JoomlapackArchiver
	 */
	var $_archiverInstance;
	
	/**
	 * Database dumper instance
	 *
	 * @var JoomlapackEngineParts
	 */
	var $_dumperInstance;
	
	/**
	 * Filesystem scanner (lister) instance
	 *
	 * @var object
	 */
	var $_listerInstance;
	
	/**
	 * Warnings stack array or null if no warnings were issued
	 *
	 * @var null|array
	 */
	var $_Warnings = null;

	/**********************************************************************************************
	 * GENERIC PUBLIC INTERFACE
	 **********************************************************************************************/
	
	/**
	 * A static method implementing the Singleton pattern, persisting in between sessions
	 *
	 * @param boolean $forceCreate Forcibly create a new instance of the object
	 * @param boolean $OnlyDBMode Create an object that only runs on DB mode.
	 * @return JoomlapackCUBE
	 * @static
	 */
	function & getInstance( $forceCreate = false, $OnlyDBMode = false )
	{
		static $instance;
		
		if( is_object($instance) && (!$forceCreate) )
		{
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackCUBE::getInstance - Object in memory (OK)");
			// An object already exists in memory. Return this.
			return $instance;
		} else {
			if( $forceCreate )
			{
				// If we are forced to create, we fool the code below by making it think that the CUBE
				// doesn't exist in the database.
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackCUBE::getInstance - Forced creation, removing CUBEObject");
				$count = -1;
				JoomlapackTables::DeleteVar('CUBEObject');
			} else {
				// Otherwise, look into the database for a stored CUBE object
				$count = JoomlapackTables::CountVar('CUBEObject');
			}
			
			if ($count != 1)
			{
				// No stored object, we are forced to create a fresh object or something really
				// odd is going on with MySQL!
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackCUBE::getInstance - Not found in database, creating new instance");
				$instance = new JoomlapackCUBE( $OnlyDBMode );
				return $instance;
			} else {
				// Load from db
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "JoomlapackCUBE::getInstance - Loading from database");
				// Get the includes first!
				JoomlapackCUBE::retrieveEngineIncludes();
				// Then load the object
				$serialized = JoomlapackTables::ReadVar('CUBEObject');
				$instance = unserialize( $serialized );
				return $instance;
			}
		}
	}

	/**
	 * Creates a new instance of the CUBE object and empties the temporary
	 * database tables
	 *
	 * @param boolean $OnlyDBMode Should we backup only the database contents?
	 * @return JoomlapackCUBE
	 */
	function JoomlapackCUBE( $OnlyDBMode = false )
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		$this->_OnlyDBMode = $OnlyDBMode;

		// Remove old entries from 'packvars' table
		JoomlapackTables::DeleteMultipleVars('%CUBE%');

		// Initialize internal variables
		$this->_currentDomain = "init";		// Current domain of operation
		$this->_currentObject = null;		// Nullify current object
		$this->_isFinished = false;
		//$this->_Error = false;
		
		// Load the filters manager
		$this->FilterManager = new JoomlapackFilterManager();

		// Create a lock time stamp
		JoomlapackTables::WriteVar( 'CUBELock', time() );
		
		// Get JoomlaPack version data
		JoomlapackAbstraction::getJoomlaPackVersion();

		JoomlapackLogger::ResetLog();
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "--------------------------------------------------------------------------------");
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "JoomlaPack "._JP_VERSION.' ('._JP_DATE.')');
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Your one for all backup solution");
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "--------------------------------------------------------------------------------");
		// PHP configuration variables are tried to be logged only for debug log levels
		if ($configuration->logLevel >= 3) {
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "--- PHP Configuration Values ---" );
			if( function_exists('php_version'))
				JoomlapackLogger::WriteLog(_JP_LOG_INFO, "PHP Version        :" . phpversion() );
			if(function_exists('php_uname'))
				JoomlapackLogger::WriteLog(_JP_LOG_INFO, "OS Version         :" . php_uname('s') );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Safe mode          :" . ini_get("safe_mode") );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Display errors     :" . ini_get("display_errors") );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Disabled functions :" . ini_get("disable_functions") );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "open_basedir restr.:" . ini_get('open_basedir') );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Max. exec. time    :" . ini_get("max_execution_time") );
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Memory limit       :" . ini_get("memory_limit") );
			if(function_exists("memory_get_usage"))
				JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Current mem. usage :" . memory_get_usage() );
			if(function_exists("gzcompress")) {
				JoomlapackLogger::WriteLog(_JP_LOG_INFO, "GZIP Compression   : available (good)" );
			} else {
				JoomlapackLogger::WriteLog(_JP_LOG_INFO, "GZIP Compression   : n/a (no compression)" );
			}
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "--------------------------------------------------------------------------------");
		}
		
		if ($this->_OnlyDBMode) {
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "JoomlaPack is starting a new database backup");
		} else {
			JoomlapackLogger::WriteLog(_JP_LOG_INFO, "JoomlaPack is starting a new full site backup");
			// Instanciate archiver, only if not in DB only mode
			$archiver =& $this->getArchiverEngine();
			
			$archiveFile = JoomlapackAbstraction::getExpandedTarName( $this->_archiveExtension );
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Expanded archive file name: " . $archiveFile);
			
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Seeding archive with installer");
			$installerPackage = JPATH_COMPONENT_ADMINISTRATOR.DS.'assets'.DS."installers".DS.$configuration->AltInstaller->Package;
			$archiver->initialize($installerPackage, $archiveFile);
			if($archiver->hasError())
			{
				$this->_Error = $archiver->getError();			
			}
		}
	}

	/**
	 * The public interface of JoomlapackCUBE, tick() does a single chunk of processing and returns a
	 * CUBE Return Array.
	 *
	 * @return array
	 */
	function tick(){
		if (!$this->_isFinished)
		{
			JoomlapackTables::WriteVar( 'CUBELock', time() ); // Update lock timestamp
			switch( $this->_runAlgorithm() ){
				case 0:
					// more work to do, return OK
					JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "CUBE :: More work required in domain '" . $this->_currentDomain);
					break;
				case 1:
					// Engine part finished
					JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "CUBE :: Domain '" . $this->_currentDomain . "' has finished");
					$this->_getNextObject();
					if ($this->_currentDomain == "finale") {
						// We have finished the whole process.
						JoomlapackCUBE::cleanup();
						JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "CUBE :: Just finished");
					}
					break;
				case 2:
					JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "CUBE :: Error occured in domain '" . $this->_currentDomain);
					// An error occured...
					JoomlapackCUBE::cleanup();
					break;
			} // switch
			return $this->_makeCUBEArray();
		}
	}

	/**
	 * Saves the current instance to the database 
	 */
	function save()
	{
		$serialized = serialize( $this );
		JoomlapackTables::WriteVar( 'CUBEObject', $serialized );
		unset( $serialized );
	}
	
	function getCUBEArray()
	{
		return $this->_makeCUBEArray();
	}
	
	/**********************************************************************************************
	 * GENERIC INTERFACE (Private Methods)
	 **********************************************************************************************/
	
	/**
	* Post work clean-up of files & database
	* @access private
	*/
	function cleanup()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "CUBE Cleanup started");
		
		// 1. Cleanup leftover temporary files, if present
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Removing leftover temporary files");
		JoomlapackCUBE::deleteTempFiles();
		
		// 2. Remove leftover packvars
		JoomlapackLogger::WriteLog(_JP_LOG_INFO, "Removing locks and leftover database variables");
		JoomlapackTables::DeleteMultipleVars('%'); // Removes all packvars
	}

	/**
	* Multi-step algorithm. Runs the tick() function of the $_currentObject once
	* and returns.
	* @return integer 0 if more work is to be done, 1 if we finished correctly,
	* 2 if error eccured.
	* @access private
	*/
	function _algoMultiStep()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Multiple Stepping");
		$error = false;

		$result = $this->_currentObject->tick();
		$this->_currentDomain = $result['Domain'];
		$this->_currentStep = $result['Step'];
		$this->_currentSubstep = $result['Substep'];
		$error = false;
		if(isset($result['Error'])) $error = !($result['Error'] == "");//joostina pach
		if($this->_currentObject->hasError())
		{
			$error = true;
			$this->_Error = $this->_currentObject->getError();
			$result['Error'] = $this->_Error; 
		}
		$finished = $error ? true : !($result['HasRun']);

		if (!$error) {
			JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Successful Slow algorithm on " . $this->_currentDomain);
		} else {
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR, "Failed Slow algorithm on " . $this->_currentDomain);
			JoomlapackLogger::WriteLog(_JP_LOG_ERROR, $result['Error']);
		}
		$this->_Error = $error ? $result['Error'] : "";
		if( $this->_currentObject->hasWarning() ) $this->_Warnings = $this->_currentObject->getWarning();
		return $error ? 2 : ( $finished ? 1 : 0 );
	}

	/**
	* Smart step algorithm. Runs the tick() function until we have consumed 75%
	* of the maximum_execution_time (minus 1 seconds) within this procedure. If
	* the available time is less than 1 seconds, it defaults to multi-step.
	* @return integer 0 if more work is to be done, 1 if we finished correctly,
	* 2 if error eccured.
	* @access private
	*/
	function _algoSmartStep()
	{
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Smart Stepping");

		// Get the maximum execution time
		$maxExecTime = ini_get("maximum_execution_time");
		$startTime = $this->_microtime_float();
		if ( ($maxExecTime == "") || ($maxExecTime == 0) ) {
			// If we have no time limit, set a hard limit of about 10 seconds
			// (safe for Apache and IIS timeouts, verbose enough for users)
			$maxExecTime = 14;
		}

		if ( $maxExecTime <= 1.75 ) {
			// If the available time is less than the trigger value, switch to
			// multi-step
			return $this->_algoMultiStep();
		} else {
			// All checks passes, this is a SmartStep-enabled case
			$maxRunTime = ($maxExecTime - 1) * 0.75;
			$runTime = 0;
			$finished = false;
			$error = false;

			// Loop until time's up, we're done or an error occured
			while( ($runTime <= $maxRunTime) && (!$finished) && (!$error) ){
				$result = $this->_currentObject->tick();
				$this->_currentDomain = $result['Domain'];
				$this->_currentStep = $result['Step'];
				$this->_currentSubstep = $result['Substep'];
				$error = false;
				if(isset($result['Error'])) $error = !($result['Error'] == "");
				if($this->_currentObject->hasError())
				{
					$error = true;
					$this->_Error = $this->_currentObject->getError();
					$result['Error'] = $this->_Error;
				}
				$finished = $error ? true : !($result['HasRun']);

				$endTime = $this->_microtime_float();
				$runTime = $endTime - $startTime;
			} // while

			// Return the result
			if (!$error) {
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Successful Smart algorithm on " . $this->_currentDomain);
			} else {
				JoomlapackLogger::WriteLog(_JP_LOG_ERROR, "Failed Smart algorithm on " . $this->_currentDomain);
				JoomlapackLogger::WriteLog(_JP_LOG_ERROR, $result['Error']);
			}
			$this->_Error = $error ? $result['Error'] : "";
			if($this->_currentObject->hasWarning())
			{
				if(is_null($this->_Warnings))
				{
					$this->_Warnings = $this->_currentObject->getWarning();
				}
				else
				{
					$this->_Warnings = array_merge($this->_Warnings, $this->_currentObject->getWarning());
				}
			}
			return $error ? 2 : ( $finished ? 1 : 0 );
		}
	}

	/**
	* Runs the user-selected algorithm for the current engine
	* @return integer 0 if more work is to be done, 1 if we finished correctly,
	* 2 if error eccured.
	* @access private
	*/
	function _runAlgorithm(){
		if(strlen($this->_Error) > 0) return 2; // Catch error conditions
		
		$algo = $this->_selectAlgorithm();
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "I have chosen $algo algorithm for " . $this->_currentDomain);

		switch( $algo ){
			case "multi":
				// Multi-step algorithm - slow but most compatible
				return $this->_algoMultiStep();
				break;
			case "smart":
				// SmartStep algorithm - best compromise between speed and compatibility
				return $this->_algoSmartStep();
				break;
			default:
				// No algorithm (null algorithm) for "init" and "finale" domains. Always returns success.
				//return $this->_isFinished ? 1 : 0;
				return 1;
		} // switch
	}

	/**
	* Selects the algorithm to use based on the current domain
	* @return string The algorithm to use
	* @access private
	*/
	function _selectAlgorithm(){
		$configuration =& JoomlapackConfiguration::getInstance();
		
		switch( $this->_currentDomain )
		{
			case "init":
			case "finale":
				return "(null)";
				break;
			case "PackDB":
				return $configuration->dbAlgorithm;
				break;
			case "Packing":
				return $this->_OnlyDBMode ? "(null)" :$configuration->packAlgorithm;
				break;
		}
	}

	/**
	* Creates the next engine object based on the current execution domain
	* @return integer 0 = success, 1 = all done, 2 = error
	* @access private
	*/
	function _getNextObject(){
		// Kill existing object
		$this->_currentObject = null;
		// Try to figure out what object to spawn next
		switch( $this->_currentDomain )
		{
			case "init":
				// Next domain : Filelist creation
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Next domain --> Database backup");
				$this->_currentObject = new JoomlapackDomainDBBackup();
				$this->_currentDomain = "PackDB";
				return 0;
				break;
			case "PackDB":
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Next domain --> Packing");
				// Next domain : File packing
				$this->_currentObject = new JoomlapackDomainPack();
				$this->_currentDomain = "Packing";
				return 0;
				break;
			case "Packing":
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Next domain --> finale");
				// Next domain : none (done)
				$this->_currentDomain = "finale";
				return 1;
				break;
			case "finale":
			default:
				JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Next domain not applicable; already on 'finale'");
				return 1;
				break;
		}
	}

	/**
	* Creates the CUBE return array
	* @return array A CUBE return array with timestamp data
	* @access private
	*/
	function _makeCUBEArray(){
		$ret['HasRun'] = $this->_isFinished ? 0 : 1;
		$ret['Domain'] = $this->_currentDomain;
		$ret['Step'] = htmlentities( $this->_currentStep );
		$ret['Substep'] = htmlentities( $this->_currentSubstep );
		$ret['Error'] = htmlentities( $this->_Error );
		$ret['Warnings'] = '';
		if(is_array($this->_Warnings))
		{
			foreach($this->_Warnings as $warning)
			{
				$ret['Warnings'] .= $warning."<br />\n";
			}
		}
		//$ret['Timestamp'] = $this->_microtime_float();
		return $ret;
	}
	
	/**
	* Returns the current microtime as a float
	* @return float Current microtime
	* @access private
	*/
	function _microtime_float()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
	
	/**********************************************************************************************
	 * ENGINE PROVISIONING
	 **********************************************************************************************/
	
	/**
	 * Returns the archiver engine object instance
	 * 
	 * @param bool $forceNew Force creation of a fresh instance, overriding the stored one
	 * @return JoomlapackArchiver The archiver engine object instance
	 */
	function & getArchiverEngine($forceNew = false)
	{	
		if((!$this->_archiverInstance) || $forceNew)
		{
			$configuration =& JoomlapackConfiguration::getInstance();
			$engine = $configuration->get('packerengine');
			$this->_archiverInstance =& $this->_getAnEngine('packer', $engine);			
		}
		
		return $this->_archiverInstance;		
	}
	
	/**
	 * Returns the file lister object instance
	 * 
	 * @param bool $forceNew Force creation of a fresh instance, overriding the stored one
	 * @return object The file lister object instance
	 * @todo Create an abstract class for file lister classes
	 */
	function & getListerEngine($forceNew = false)
	{
		if((!$this->_listerInstance) || $forceNew)
		{
			$configuration =& JoomlapackConfiguration::getInstance();
			$engine = $configuration->get('listerengine');
			$this->_listerInstance =& $this->_getAnEngine('lister', $engine);			
		}
		
		return $this->_listerInstance;
	}
	
	/**
	 * Returns the database packer object instance
	 * 
	 * @param bool $forceNew Force creation of a fresh instance, overriding the stored one
	 * @return JoomlapackEngineParts The database packer object instance
	 * @todo Create an abstract class for database packer classes
	 */
	function & getDBPackerEngine($forceNew = false)
	{	
		if((!$this->_dumperInstance) || $forceNew)
		{
			$configuration =& JoomlapackConfiguration::getInstance();
			$engine = $configuration->get('dbdumpengine');
			$this->_dumperInstance =& $this->_getAnEngine('dumper', $engine);			
		}
		
		return $this->_dumperInstance;
	}
	
	/**
	 * Fetches the required includes and actually includes them, too!
	 * 
	 * @static 
	 */
	function retrieveEngineIncludes()
	{
		if(JoomlapackTables::CountVar('CUBEEngineIncludes') >= 1)
		{
			// There is a db entry. Load, and unserialize
			$serialized = JoomlapackTables::ReadVar('CUBEEngineIncludes');
			$includes = unserialize($serialized);
			foreach($includes as $dotted)
			{
				jpimport($dotted);
			}
		}
	}

	/**********************************************************************************************
	 * ENGINE PROVISIONING (Private Methods)
	 **********************************************************************************************/
	/**
	 * Adds an entry to the engine includes table
	 *
	 * @param string $dottedNotation Dotted notation of class file to add to the list
	 */
	function _addEngineInclude($dottedNotation)
	{
		if(JoomlapackTables::CountVar('CUBEEngineIncludes') >= 1)
		{
			// There is a db entry. Load, and unserialize
			$serialized = JoomlapackTables::ReadVar('CUBEEngineIncludes');
			$includes = unserialize($serialized);
		}
		else
		{
			// Start a new array
			$includes = array();
		}
		
		// Append to the array
		$includes[] = $dottedNotation;
		
		// Serialize and save
		$serialized = serialize($includes);
		JoomlapackTables::WriteVar('CUBEEngineIncludes', $serialized);
	}
	
	/**
	 * Retrieves an object for the specified engine. It reads the engine.ini in order to do that.
	 * It will also call the _addEngineInclude to make sure the included file persists during
	 * the backup session.
	 *
	 * @param string $engine The engine type (lister, dumper, packer)
	 * @param string $item The engine class file name (e.g. deafault, jpa, etc)
	 */
	function & _getAnEngine($engine, $item)
	{
		// Load engine definitions
		JoomlapackLogger::WriteLog(_JP_LOG_DEBUG, "Creating $engine engine of type $item");
		$sourceINI = JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'engine'.DS.$engine.DS.'engine.ini';
		$engineArray = JoomlapackAbstraction::parse_ini_file($sourceINI, true);
		
		if(isset($engineArray[$item]))
		{
			$engineDescriptor = $engineArray[$item];
			$dotted = 'classes.engine.'.$engine.'.'.$engineDescriptor['include'];
			$this->_addEngineInclude($dotted);
			jpimport($dotted);
			$instance = new $engineDescriptor['class'];
			// If we are getting an archiver class, also populate the _archiveExtension field 
			if($engine == 'packer')
			{
				$this->_archiveExtension = $engineDescriptor['extension'];
			}
			return $instance;
		}
		else
		{
			$this->_Error = 'Engine '.$engine.'.'.$item.' not found.';
			return false;
		}
	}

	/**********************************************************************************************
	 * TEMPORARY FILES MANAGEMENT
	 **********************************************************************************************/
	
	/**
	 * Registers a temporary file with the CUBE object
	 *
	 * @param string $fileName The path of the file, relative to configured TempDirectory
	 * 
	 * @return string The absolute path to the temporary file, for use in file operations
	 */
	function registerTempFile( $fileName )
	{
		$tempFiles = JoomlapackTables::UnserializeVar('CUBETempFiles', array());
		
		if(!in_array($fileName, $tempFiles))
		{
			$tempFiles[] = $fileName;
			JoomlapackTables::SerializeVar('CUBETempFiles', $tempFiles);
		}
		
		$configuration =& JoomlapackConfiguration::getInstance();
		return $configuration->get('TempDirectory').DS.$fileName;
	}
	
	function unregisterAndDeleteTempFile( $fileName, $removePrefix = false )
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		if($removePrefix)
		{
			$fileName = str_replace( $configuration->get('TempDirectory') , '', $fileName);
			if( (substr($fileName, 1, 1) == '/') || (substr($fileName, 1, 1) == '\\') )
			{
				$fileName = substr($fileName, 2, strlen($fileName) - 1 );			
			}
		}
		
		
		if( JoomlapackTables::CountVar('CUBETempFiles') >= 1 )
		{
			$serialized = JoomlapackTables::ReadVar('CUBETempFiles');
			$tempFiles = unserialize($serialized);
			$newTempFiles = array();
			
			if(is_array($tempFiles))
			{
				$aFile = array_shift($tempFiles);
				while( !is_null($aFile) )
				{
					if($aFile != $fileName) $newTempFiles[] = $aFile;
					$aFile = array_shift($tempFiles);
				}
			}
			
			
			if( count($newTempFiles) == 0 )
			{
				JoomlapackTables::DeleteVar('CUBETempFiles');
			}
			else
			{
				$serialized = serialize($newTempFiles);
				JoomlapackTables::WriteVar('CUBETempFiles', $serialized);
			}
		}
		
		$file = $configuration->get('TempDirectory').DS.$fileName;
		return file_exists($file) ? @unlink($file) : false;
	}
	
	
	function deleteTempFiles()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		$tempFiles = JoomlapackTables::UnserializeVar('CUBETempFiles', array());
		foreach($tempFiles as $fileName)
		{
			$file = $configuration->get('TempDirectory').DS.$fileName;
			if(file_exists($file)) @unlink($file);
		}
		
		JoomlapackTables::DeleteVar('CUBETempFiles');
	}
}

/**
 * Timeout error handler
 */
function deadOnTimeOut()
{
	if( connection_status() >= 2 ) {
		JoomlapackLogger::WriteLog(_JP_LOG_ERROR, "JoomlaPack has timed out. Please read the documentation.");
	}
}
register_shutdown_function("deadOnTimeOut");
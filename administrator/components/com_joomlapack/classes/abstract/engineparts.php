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
 * Base class for CUBE components (a.k.a. Engine Parts)
 * @abstract 
 */
class JoomlapackEngineParts extends JoomlapackObject
{
	/**
	 * Indicates whether this part has finished its initialisation cycle
	 *
	 * @var boolean
	 * @access protected
	 */
	var $_isPrepared = false;
		
	/**
	 * Indicates whether this part has more work to do (it's in running state)
	 *
	 * @var boolean
	 * @access protected
	 */
	var $_isRunning = false;
	
	/**
	 * Indicates whether this part has finished its finalization cycle
	 *
	 * @var boolean
	 * @access protected
	 */
	var $_isFinished = false;

	/**
	 * Indicates whether this part has finished its run cycle
	 *
	 * @var boolean
	 * @access protected
	 */
	var $_hasRan = false;
	
	/**
	 * Indicates whether this part has prematurely stopped due to an error
	 *
	 * @var boolean
	 * @access protected
	 * @todo Remove duplicate error handling
	 */
	var $_isError = false;
	
	/**
	 * Stores the last error message for this part
	 *
	 * @var boolean
	 * @access protected
	 * @todo Remove duplicate error handling
	 */
	var $_errorMessage = "";
	
	/**
	 * The name of the engine part (a.k.a. Domain), used in return table
	 * generation.
	 *
	 * @var string
	 * @access protected
	 */
	var $_DomainName = "";
	
	/**
	 * The step this engine part is in. Used verbatim in return table and
	 * should be set by the code in the _run() method.
	 *
	 * @var string
	 * @access protected
	 */
	var $_Step = "";
	
	/**
	 * A more detailed description of the step this engine part is in. Used
	 * verbatim in return table and should be set by the code in the _run()
	 * method.
	 *
	 * @var string
	 * @access protected
	 */
	var $_Substep = "";
	
	/**
	 * Any configuration variables, in the form of an array. 
	 *
	 * @var array
	 * @access protected
	 */
	var $_parametersArray = array();
		
	/**
	 * Runs the preparation for this part. Should set _isPrepared
	 * to true
	 * @access protected
	 * @abstract 
	 */
	function _prepare()
	{
	}
	
	/**
	 * Runs the finalisation process for this part. Should set
	 * _isFinished to true.
	 * @access protected
	 * @abstract
	 */
	function _finalize()
	{	
	}
	
	/**
	 * Runs the main functionality loop for this part. Upon calling,
	 * should set the _isRunning to true. When it finished, should set
	 * the _hasRan to true. If an error is encountered, _isError should
	 * be set to true.
	 * @access protected
	 * @abstract
	 */
	function _run()
	{
		
	}
	
	/**
	 * Sets the engine part's internal state, in an easy to use manner
	 *
	 * @param string $state One of init, prepared, running, postrun, finished, error
	 * @param string $errorMessage The reported error message, should the state be set to error
	 * @since 1.2.1
	 */
	function setState($state = 'init', $errorMessage='Invalid setState argument')
	{
		switch($state)
		{
			case 'init':
				$this->_isPrepared = false;
				$this->_isRunning  = false;
				$this->_isFinished = false;
				$this->_hasRan     = false;
				break;
				
			case 'prepared':
				$this->_isPrepared = true;
				$this->_isRunning  = false;
				$this->_isFinished = false;
				$this->_hasRan     = false;
				break;
				
			case 'running':
				$this->_isPrepared = true;
				$this->_isRunning  = true;
				$this->_isFinished = false;
				$this->_hasRan     = false;
				break;
				
			case 'postrun':
				$this->_isPrepared = true;
				$this->_isRunning  = false;
				$this->_isFinished = false;
				$this->_hasRan     = true;
				break;
				
			case 'finished':
				$this->_isPrepared = true;
				$this->_isRunning  = false;
				$this->_isFinished = true;
				$this->_hasRan     = false;
				break;
				
			case 'error':
			default:
				$this->setError($errorMessage);
				$this->_isError = true;
				$this->_errorMessage = $errorMessage;
				break;
		}
	}
	
	/**
	 * Returns true if the engine part is flagged as in a state of error 
	 *
	 * @return boolean
	 * @final
	 */
	function isError()
	{
		return $this->_isError || $this->hasError();
	}
	
	/**
	 * Returns the error message set for the class
	 *
	 * @return string
	 * @final
	 */
	function getError()
	{
		// Fix 1.2.1.b2 -- This bugger caused core dumps. Ouch!!
		return strlen($this->_errorMessage) > 0 ? $this->_errorMessage : parent::getError();
	}
	
	/**
	 * The public interface to an engine part. This method takes care for
	 * calling the correct method in order to perform the initialisation -
	 * run - finalisation cycle of operation and return a proper CUBE
	 * reponse array.
	 * @return array A CUBE Return Array
	 * @access protected
	 * @final
	 */
	function tick()
	{
		// Call the right action method, depending on engine part state
		switch( $this->_getState() )
		{
			case "init":
				$this->_prepare();
				break;
			case "prepared":
				$this->_run();
				break;
			case "running":
				$this->_run();
				break;
			case "postrun":
				$this->_finalize();
				break;
		}
		
		// Send a Return Table back to the caller
		$out = $this->_makeReturnTable();
		return $out;
	}
	
	/**
	 * Sends any kind of setup information to the engine part. Using this,
	 * we avoid passing parameters to the constructor of the class. These
	 * parameters should be passed as an indexed array and should be taken
	 * into account during the preparation process only. This function will
	 * set the error flag if it's called after the engine part is prepared.
	 *
	 * @param array $parametersArray The parameters to be passed to the
	 * engine part.
	 * @access public
	 * @final 
	 */
	function setup( $parametersArray )
	{
		if( $this->_isPrepared )
		{
			$this->setState('error', "Can't modify configuration after the preparation of " . $this->_DomainName);
		}
		else
		{
			$this->_parametersArray = $parametersArray;
		}
	}
	
	/**
	 * Returns the state of this engine part.
	 * 
	 * @return string The state of this engine part. It can be one of
	 * error, init, prepared, running, postrun, finished.
	 * @access protected
	 * @final
	 */
	function _getState()
	{
		if( $this->_isError )
		{
			return "error";		
		}
		
		if( !($this->_isPrepared) )
		{
			return "init";
		}
		
		if( !($this->_isFinished) && !($this->_isRunning) && !( $this->_hasRan ) && ($this->_isPrepared) )
		{
			return "prepared";
		}
				
		if ( !($this->_isFinished) && $this->_isRunning && !( $this->_hasRan ) )
		{
			return "running";		
		}

		if ( !($this->_isFinished) && !($this->_isRunning) && $this->_hasRan )
		{
			return "postrun";		
		}
		
		if ( $this->_isFinished )
		{
			return "finished";
		}		
	}
	
	/**
	 * Constructs a CUBE Return Table based on the engine part's state.
	 *
	 * @final
	 * @return array The CUBE Return Array for the current state
	 */
	function _makeReturnTable()
	{
		//if($this->hasError() && strlen($this->_errorMessage) == 0 ) $this->_errorMessage = $this->getError();

		$out =  array(
			'HasRun'	=> (!($this->_isFinished)),
			'Domain'	=> $this->_DomainName,
			'Step'		=> $this->_Step,
			'Substep'	=> $this->_Substep,
			'Error'		=> $this->_errorMessage
		);
		
		return $out;
	}
}

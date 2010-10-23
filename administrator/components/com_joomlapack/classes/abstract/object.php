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

/**
 * JoomlapackObject defines common behavior shared among all JoomlaPack core components
 * (the entire CUBE framework and extension classes). Right now it focuses on:
 * - Error handling
 * - Warning handling
 *
 */
class JoomlapackObject
{
	/**
	 * The error message
	 *
	 * @var string
	 */
	var $_error = null;
	
	/**
	 * An array of warning messages
	 *
	 * @var array
	 */
	var $_warnings = null;
	
	/**
	 * Sets and logs the error message
	 *
	 * @param string $message The error message to be logged and displayed to the user
	 * @param bool $silent If set to true, no logging is performed (usefull for message propagation)
	 */
	function setError($message, $silent = false)
	{
		if(!$silent) JoomlapackLogger::WriteLog(_JP_LOG_ERROR, $message);
		$this->_error = $message;
	}
	
	/**
	 * Returns the error status. If true, the class is marked with an error and execution should be halted.
	 *
	 * @return bool
	 */
	function hasError()
	{
		return !is_null($this->_error);
	}
	
	/**
	 * Gets the error message
	 *
	 * @return string
	 */
	function getError()
	{
		return $this->_error;
	}
	
	/**
	 * Appends a warning to the warnings stack
	 *
	 * @param string $message The warning message
	 * @param bool $silent If set to true, no logging is performed (usefull for message propagation)
	 */
	function setWarning($message, $silent=false)
	{
		if(!$silent) JoomlapackLogger::WriteLog(_JP_LOG_WARNING, $message);
		$this->_warnings[] = $message;
	}
	
	/**
	 * Resturs the warnings status. False means no warnings. True means we have some warnings.
	 *
	 * @return bool
	 */
	function hasWarning()
	{
		return ( is_array($this->_warnings) ? (count($this->_warnings) > 0) : false );
	}
	
	/**
	 * Gets the warnings stack and clears it
	 *
	 * @return array
	 */
	function getWarning()
	{
		$ret = $this->_warnings;
		$this->_warnings = null;
		return $ret;
	}
}
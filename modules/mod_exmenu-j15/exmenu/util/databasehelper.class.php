<?php
/**
* @version $Id:$
* @author Daniel Ecer
* @package exmenu
* @copyright (C) 2005-2009 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
if (!defined('EXTENDED_MENU_HOME')) {
	die('Restricted access');
}


class AbstractExtendedMenuDatabaseHelper {

	var $_database = NULL;
	var $sqlNullDate		= NULL;
	var $sqlNow			= NULL;


	function __construct() {
		if (function_exists('jimport')) {
			$this->_database =& JFactory::getDBO();
		} else {
			$this->_database =& $GLOBALS['database'];
		}
	}


	function AbstractExtendedMenuDatabaseHelper() {
		$this->__construct();
	}


	function &getDatabase() {
		return $this->_database;
	}

	/**
	 * returns a quoted string you could use inside a query
	 * (this is a function provided for compatibility with Mambo 4.5.1)
	 * @see database::quote
	 * @return string
	 */
	function getSqlQuote($text) {
		$database	=& $this->getDatabase();
		if (method_exists($database, 'quote')) {
			return $database->quote($text);
		} else {
			return '\''.mysql_escape_string($text).'\'';
		}
	}

	function checkDatabaseError($msg = '') {
		$database	=& $this->getDatabase();
		if ($database->getErrorNum()) {
			if ($msg == '') {
				$msg	= 'database error:'.stripslashes($database->getErrorMsg());
			}
			trigger_error($msg, E_USER_WARNING);
			return TRUE;
		}
		return FALSE;
	}

	function getSqlNullDate() {
		if (is_null($this->sqlNullDate)) {
			$database	=& $this->getDatabase();
			if (method_exists($database, 'getNullDate')) {
				$this->sqlNullDate		= $database->getNullDate();
			} else {
				$this->sqlNullDate		= '0000-00-00 00:00:00';
			}
		}
		return $this->sqlNullDate;
	}

	function getSqlNow() {
		if (is_null($this->sqlNow)) {
			$offset = 0;
			if (function_exists('jimport')) {
				$config	=& JFactory::getConfig();
				$offset = $config->getValue('config.offset');
			} else {
				global $mosConfig_offset;
				$offset = $mosConfig_offset;
			}
			$this->sqlNow			= date('Y-m-d H:i', time() + $offset * 60 * 60);
		}
		return $this->sqlNow;
	}

	/**
	 * @since 0.4.0
	 */
	function getSqlIdEquals($name, $ids) {
		if (!is_array($ids)) {
			return $name.' = '.intval($ids);
		} else if (count($ids) == 1) {
			$keys	= array_keys($ids);
			return $name.' = '.intval($ids[$keys[0]]);
		} else if (count($ids) == 0) {
			return ' 0 ';
		} else {
			$a	= array();
			foreach($ids as $id) {
				$a[]		= intval($id);
			}
			return $name.' IN ('.implode(',', $a).')';
		}
	}

	/**
	 * @since 1.0.1
	 */
	function getSqlLike($name, $value, $invert = FALSE) {
		if (is_array($name)) {
			if (count($name) == 0) {
				return ($invert ? '1' : '0');
			} else if (count($name) == 1) {
				return $this->getSqlLike($name[0], $value, $invert);
			} else {
				$a		= array();
				foreach($name as $n) {
					$a[]		= $this->getSqlLike($n, $value, $invert);
				}
				return '('.implode(($invert ? ' AND ' : ' OR '), $a).')';
			}
		} else {
			return $name.($invert ? ' NOT LIKE ' : ' LIKE ').str_replace('*', '%', str_replace('%', '\%', $this->getSqlQuote($value)));
		}
	}
}


?>
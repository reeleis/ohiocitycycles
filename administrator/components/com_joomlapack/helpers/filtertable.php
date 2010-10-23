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
 * Handles transactions with the exclusion / inclusion filter tables
 * This is the underlying model of the filter functionality
 */
class JoomlapackHelperFiltertable
{
	// ================================================================================
	// Exclusion filters
	// ================================================================================
	
	/**
	 * Returns the list of filters of an exclusion filter class
	 *
	 * @param string $filterClass The filter class to get filters for
	 * @return array The filter list array, or an empty array if no filters are set
	 */
	function getExclusionList( $filterClass )
	{
		$db	= JoomlapackAbstraction::getDatabase();
		$sql = 'SELECT '.$db->nameQuote('value').' FROM #__jp_exclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass);
		$db->setQuery($sql);
		$temp = $db->loadRowList();
		$out = array();
		if(count($temp) > 0)
		{
			foreach($temp as $entry)
			{
				$out[] = $entry[0];
			}
		}
		return $out;
	}
		
	/**
	 * Deletes all exclusion filters of a given filter class
	 *
	 * @param string $filterClass The filter class to use
	 * @return bool
	 */
	function resetExclusionList( $filterClass )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'DELETE FROM #__jp_exclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass);
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	/**
	 * Adds an exclusion filter to the specified filter class
	 *
	 * @param string $filterClass The filter class to use
	 * @param string $value The value to add
	 * @return bool
	 */
	function addExclusionFilter( $filterClass, $value )
	{
		// Do not bother if it's already set
		if(JoomlapackHelperFiltertable::isExclusionFilterSet($filterClass, $value) )
		{
			return true;
		}
		
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'INSERT INTO #__jp_exclusion ('.$db->nameQuote('class').','.
				$db->nameQuote('value').') VALUES ('.
				$db->Quote($filterClass).', '.$db->Quote($value).')';
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	/**
	 * Removes an exclusion filter of the specified class from the filters collection
	 *
	 * @param string $filterClass The filter class to use
	 * @param string $value The value to remove
	 * @return bool
	 */
	function deleteExclusionFilter( $filterClass, $value )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'DELETE FROM #__jp_exclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass) . ' AND ' .
				$db->nameQuote('value') . ' = ' . $db->Quote($value);
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	/**
	 * Returns a boolean, indicating if the requested value is a member of the specified
	 * filter class 
	 *
	 * @param string $filterClass The filter class to use
	 * @param string $value The value to test
	 * @return bool TRUE if the $value represent an active filter, FALSE otherwise
	 */
	function isExclusionFilterSet( $filterClass, $value )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'SELECT COUNT('.$db->nameQuote('id').') FROM #__jp_exclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass) . ' AND ' .
				$db->nameQuote('value') . ' = ' . $db->Quote($value);
		$db->setQuery($sql);
		$count = $db->loadResult();
		return ($count > 0);
	}

	// ================================================================================
	// Inclusion filters
	// ================================================================================
	
	function getInclusionList( $filterClass )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'SELECT '.$db->nameQuote('value').','.$db->nameQuote('id').
				' FROM #__jp_inclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass);
		$db->setQuery($sql);
		$list = $db->loadRowList();
		
		// Post process results (unserialize values)
		$array = array();
		
		if(count($list) > 0)
		{
			foreach($list as $value)
			{
				$unserialized = unserialize($value[0]);
				$unserialized['id'] = $value[1];
				$array[] = $unserialized;
			}
		}
		
		return $array;
	}
	
	function getInclusionEntry( $filterClass, $id )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'SELECT '.$db->nameQuote('value').' FROM #__jp_inclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass) . ' AND '.
				$db->nameQuote('id') . ' = ' . $db->Quote($id);
		$db->setQuery($sql);
		$list = $db->loadResult();
		
		// Post process results (unserialize values)
		$array = array();
		
		if(!is_null($list))
		{
			$array = unserialize($list);
		}
		
		$array['id'] = $id;	
		return $array;
	}
	
	function resetInclusionList( $filterClass )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'DELETE FROM #__jp_inclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass);
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	function addInclusionFilter( $filterClass, $value )
	{
		if(isset($value['id']))
		{
			$newval = array();
			foreach($value as $key => $data)
			{
				if($key != 'id')
				{
					$newval[$key] = $data;
				}
			}
			$value = $newval;
			unset($newval);
		}
		
		// Do not bother if it's already set
		if(JoomlapackHelperFiltertable::isInclusionFilterSet($filterClass, $value) )
		{
			return true;
		}

		$db = JoomlapackAbstraction::getDatabase();
		$value = serialize($value);
		$sql = 'INSERT INTO #__jp_inclusion ('.$db->nameQuote('class').','.
				$db->nameQuote('value').') VALUES ('.
				$db->Quote($filterClass).', '.$db->Quote($value).')';
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	function updateInclusionFilter( $filterClass, $id, $value )
	{
		if(isset($value['id']))
		{
			$newval = array();
			foreach($value as $key => $data)
			{
				if($key != 'id')
				{
					$newval[$key] = $data;
				}
			}
			$value = $newval;
			unset($newval);
		}
		
		if(JoomlapackHelperFiltertable::isInclusionFilterSet($filterClass, $value) || !is_null($id) )
		{
			$db = JoomlapackAbstraction::getDatabase();
			$value = serialize($value);
			$sql = 'UPDATE #__jp_inclusion SET '.
					$db->nameQuote('value').' = '.$db->Quote($value).
					' WHERE '
					.$db->nameQuote('class').' = '.$db->Quote($filterClass).
					' AND '
					.$db->nameQuote('id').' = '.$db->Quote($id);
			$db->setQuery($sql);
			$db->query();
			return true;
		}
		else
		{
			return JoomlapackHelperFiltertable::addInclusionFilter($filterClass, $value);
		}
	}
	
	function deleteInclusionFilter( $filterClass, $id )
	{
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'DELETE FROM #__jp_inclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass) . ' AND ' .
				$db->nameQuote('id') . ' = ' . $db->Quote($id);
		$db->setQuery($sql);
		$db->query();
		return true;
	}
	
	function isInclusionFilterSet( $filterClass, $value )
	{
		if(isset($value['id']))
		{
			$newval = array();
			foreach($value as $key => $data)
			{
				if($key != 'id')
				{
					$newval[$key] = $data;
				}
			}
			$value = $newval;
			unset($newval);
		}
		
		$value = serialize($value);
		$db = JoomlapackAbstraction::getDatabase();
		$sql = 'SELECT COUNT('.$db->nameQuote('id').') FROM #__jp_inclusion WHERE '.
				$db->nameQuote('class') . ' = ' . $db->Quote($filterClass) . ' AND ' .
				$db->nameQuote('value') . ' = ' . $db->Quote($value);
		$db->setQuery($sql);
		$count = $db->loadResult();
		return ($count > 0);
	}
}
?>
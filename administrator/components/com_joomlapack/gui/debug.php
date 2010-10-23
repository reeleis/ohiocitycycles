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
 * This page is used while developing for testing out portions of the JoomlaPack
 * code base. Upon reaching release status it is cleared.
 *
 */
class JoomlapackPageDebug
{
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageDebug
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageDebug();
		}
		
		return $instance;
	}	
	
	function echoHTML()
	{
		jpimport('classes.engine.lister.default');
		$lister = new JoomlapackListerAbstraction;
		echo "<h2>Default method</h2>";
		$data = $lister->getDirContents('/');
		$this->do_dump($data);
		echo "<h2>glob</h2>";
		$data = $lister->_getDirContents_glob('/');
		$this->do_dump($data);
		
	}
	
	function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)
	{
	    $do_dump_indent = "<span style='color:#eeeeee;'>|</span> &nbsp;&nbsp; ";
	    $reference = $reference.$var_name;
	    $keyvar = 'the_do_dump_recursion_protection_scheme'; $keyname = 'referenced_object_name';
	
	    if (is_array($var) && isset($var[$keyvar]))
	    {
	        $real_var = &$var[$keyvar];
	        $real_name = &$var[$keyname];
	        $type = ucfirst(gettype($real_var));
	        echo "$indent$var_name <span style='color:#a2a2a2'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
	    }
	    else
	    {
	        $var = array($keyvar => $var, $keyname => $reference);
	        $avar = &$var[$keyvar];
	   
	        $type = ucfirst(gettype($avar));
	        if($type == "String") $type_color = "<span style='color:green'>";
	        elseif($type == "Integer") $type_color = "<span style='color:red'>";
	        elseif($type == "Double"){ $type_color = "<span style='color:#0099c5'>"; $type = "Float"; }
	        elseif($type == "Boolean") $type_color = "<span style='color:#92008d'>";
	        elseif($type == "NULL") $type_color = "<span style='color:black'>";
	   
	        if(is_array($avar))
	        {
	            $count = count($avar);
	            echo "$indent" . ($var_name ? "$var_name => ":"") . "<span style='color:#a2a2a2'>$type ($count)</span><br>$indent(<br>";
	            $keys = array_keys($avar);
	            foreach($keys as $name)
	            {
	                $value = &$avar[$name];
	                $this->do_dump($value, "['$name']", $indent.$do_dump_indent, $reference);
	            }
	            echo "$indent)<br>";
	        }
	        elseif(is_object($avar))
	        {
	            echo "$indent$var_name <span style='color:#a2a2a2'>$type</span><br>$indent(<br>";
	            foreach($avar as $name=>$value) do_dump($value, "$name", $indent.$do_dump_indent, $reference);
	            echo "$indent)<br>";
	        }
	        elseif(is_int($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
	        elseif(is_string($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color\"$avar\"</span><br>";
	        elseif(is_float($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
	        elseif(is_bool($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color".($avar == 1 ? "TRUE":"FALSE")."</span><br>";
	        elseif(is_null($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> {$type_color}NULL</span><br>";
	        else echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $avar<br>";
	
	        $var = $var[$keyvar];
	    }
	}

}
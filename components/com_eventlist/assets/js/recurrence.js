/**
 * @version 0.9 $Id$
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @author Sascha Karnatz
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

var $content;		// the content object
var $select_value;

/**
 * start function for the javascript (onload isn't possible)
 *
 * @access public
**/
function start_recurrencescript() {
	$content = $("recurrence_output"); // get the object (position) of the output
	var $type = parseInt($("recurrence_type").value);
	if (!isNaN($type)) {	// is the value of the type an integer?
		if ($type > 3) {	// get the type
			$("recurrence_select").value = 4;
		} else {
			$("recurrence_select").value = $type;
		}
		output_recurrencescript(); // start the output
	}
	$("recurrence_select").onchange = output_recurrencescript; // additional event handler
}

/**
 * the output of the script (a part of them is included in
 * this function)
 *
 * @access public
**/
function output_recurrencescript() {
	var $select_value = $("recurrence_select").value;	// the value of the select list
	if ($select_value != 0) {	// want the user a recurrence
		// create an element by the generate_output function
		// ** $select_output is an array of all sentences of each type **
		var $element = generate_output($select_output[$select_value], $select_value);
		$content.replaceChild($element, $content.firstChild);	// include the element
		set_parameter();	// set the new parameter
		$("counter_row").style.display = "table-row"; // show the counter
	} else {
		$("recurrence_number").value = 0;	// set the parameter
		$("recurrence_type").value = 0;
		$nothing = document.createElement("span");	// create a new "empty" element
		$nothing.appendChild(document.createTextNode(""));
		$content.replaceChild($nothing, $content.firstChild);	// replace the old element by the new one
		$("counter_row").style.display = "none"; // hide the counter
	}

}

/**
 * use the sentences of each type and include selectlist into this phrases
 *
 * @var array select_output
 * @var integer select_value
 * @return object the generated span element
 * @access public
**/
function generate_output($select_output, $select_value) {
	var $output_array = $select_output.split("[placeholder]");	// split the output into two parts
	var $span = document.createElement("span");					// create a new element
	for ($i = 0; $i < $output_array.length; $i++) {
		$weekday_array = $output_array[$i].split("[placeholder_weekday]");	// split by the weekday placeholder

		if ($weekday_array.length > 1) {	// is the weekday placeholder set?
			for ($k = 0; $k < $weekday_array.length; $k++) {
				$span.appendChild(document.createTextNode($weekday_array[$k]));	// include the the text snippets into span - element
				if ($k == 0) {	// the first iteration get an extra weekday selectlist
					$span.appendChild(generate_selectlist_weekday());
				}
			}
		} else {
			$span.appendChild(document.createTextNode($output_array[$i]));	// include the text snippet
		}
		if ($i == 0) {	// first iteration get an extra selectlist
			$span.appendChild(generate_selectlist($select_value));
		}

	}
	return $span;
}

/**
 * this function generate the normal selectlist
 *
 * @var integer select_value
 * @return object the generated selectlist
 * @access public
**/
function generate_selectlist($select_value) {
	var $selectlist = document.createElement("select");	// new select element
	$selectlist.name = "recurrence_selectlist";	// add attributes
	$selectlist.onchange = set_parameter;
	switch($select_value) {
		case "1":
			$limit = 14;	// days
			break;
		case "2":
			$limit = 8;		// weeks
			break;
		case "3":
			$limit = 12;	// months
			break;
		default:
			$limit = 6;		// weekdays
			break;
	}
	for ($j = 0; $j < $limit; $j++) {
		var $option = document.createElement("option");	// create option element
		if ($j == (parseInt($("recurrence_number").value) - 1)) {	// the selected - attribute
			$option.selected = true;
		}
		if (($j >= 4) && ($select_value == 4)) {	// get the word for "last" and "before last" in the weekday section
			var $name_value = "";
			switch($j) {
				case 4:
					$name_value = $last;
					break;
				case 5:
					$name_value = $before_last;
					break;
			}
			$option.appendChild(document.createTextNode($name_value)); 	// insert the name
			$option.value = $j+1;										// and the value
		} else {
			$option.appendChild(document.createTextNode($j + 1)); // + 1 day because their is no recuring each "0" day
		}
		$selectlist.appendChild($option);	// include the option - element into the select - element
	}
	return $selectlist;
}

/**
 * this function generate the weekday selectlist
 *
 * @return object the generated weekday selectlist
 * @access public
**/
function generate_selectlist_weekday() {
	var $selectlist = document.createElement("select");	// the new selectlist
	$selectlist.name = "recurrence_selectlist_weekday";	// add attributes
	$selectlist.onchange = set_parameter;
	for ($j = 0; $j < 7; $j++) {						// the 7 days
		var $option = document.createElement("option");	// create the option - elements
		if ($j == (parseInt($("recurrence_type").value) - 4)) {	// the selected - attribute
			$option.selected = true;
		}
		$option.value = $j;	// add the value
		$option.appendChild(document.createTextNode($weekday[$j])); // + 1 day because their is no recuring each "0" day
		$selectlist.appendChild($option);	// include the option - element into the select - element
	}
	return $selectlist;
}

/**
 * set the value of the hidden input tags
 *
 * @access public
**/
function set_parameter() {
	if ($("recurrence_select").value != 4) {	// include the value into the recurrence_type input tag
		$("recurrence_type").value = $("recurrence_select").value;
	} else {
		$("recurrence_type").value = parseInt($("recurrence_select").value) + parseInt(document.getElementsByName("recurrence_selectlist_weekday")[0].value);
	}
	// include the value into the recurrence_number input tag
	$("recurrence_number").value = document.getElementsByName("recurrence_selectlist")[0].value;
}
<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class JElementList extends JElement {
  
  var $_name = 'List';
  function fetchElement($name, $value, &$node, $control_name)	{
     
		$db = &JFactory::getDBO();

		$class = $node->attributes('class');

		if (!$class) {

			$class = "inputbox";

		}

		$query = "SELECT  categoryId , categoryName , parent_id

    FROM #__dtregister_categories  order by  ordering";

		$db->setQuery($query);

		$rows1 = $db->loadObjectList();
        
		$result = '<select name="'.$control_name.'['.$name.']" id="'.$name.'" class="'.$class.'">';

		if(is_array($value)){

		    $all_cats = in_array( -1, $value )?"selected":'';

		}elseif($value){

		    $all_cats = ( -1 == $value )?"selected":'';

		}else{

		    $all_cats = "";

		}

        $options=array();
        $children = array();
        foreach ($rows1 as $v )
		{
			$pt = $v->parent_id;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		
	  $options=array();
		$options[]=JHTML::_('select.option',"","Select Category");
		if(isset($children[0]))
		foreach($children[0] as $pcategory){
		   $options[]=JHTML::_('select.option',$pcategory->categoryId,$pcategory->categoryName);
		   if(isset($children[$pcategory->categoryId])){
		       foreach($children[$pcategory->categoryId] as $childcat){
			       $options[]=JHTML::_('select.option',$childcat->categoryId,"--".$childcat->categoryName);
			   }
		   }
		}
		return  JHTML::_('select.genericlist', $options,$control_name.'['.$name.']','',"value","text",$value);
		foreach( $options as $option ) {

			if(is_array( $value) ) {

				if( in_array( $option->id, $value ) ) {

					$result .= '<option selected="true" value="'.$option->id.'" >'.$option->title.'</option>';

				} else {

					$result .= '<option value="'.$option->id.'" >'.$option->title.'</option>';

				}

			} elseif ( $value ) {

				if( $value == $option->id ) {

					$result .= '<option selected="true" value="'.$option->id.'" >'.$option->title.'</option>';

				} else {

					$result .= '<option value="'.$option->id.'" >'.$option->title.'</option>';

				}

			} elseif ( !( $value ) ) {

				$result .= '<option value="'.$option->id.'" >'.$option->title.'</option>';

			}

		}

		$result .= '</select>';

		return $result;

  }
  
}
?>
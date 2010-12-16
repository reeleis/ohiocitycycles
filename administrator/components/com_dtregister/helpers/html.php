<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/


class DtHtml {
  
     function options($arr,$empty=false){
			  
		$options  =  array();
	    if($empty!==false){
		   $options[] = JHTML::_('select.option','',$empty);
		}
		foreach($arr as $key=>$value){
				  
			$options[]=JHTML::_('select.option',$key,$value);
			
		}
			
		return $options;		  
		  
	 }

	 function checkboxList($name,$options=array(),$values=array(),$after="",$before="",$attr=""){
	    $html = "" ;
		//$values =  array_values($values);
		
		foreach($options as $key=>$option){
		
		  $checked = (is_array($values) && in_array($key,$values))? "checked":'';
		  $html .= $before.'<input type="checkbox" name="'.$name.'[]" value="'.$key.'" '.$attr.' '.$checked.'  /> '.$option.$after ; 
		  
		}
		
		return $html;
	 }
	 
	 function paylatercheckboxlist($name,$options=array(),$values=array()){
	      
		  foreach($options as $key=>&$val){
		      
			  $val = '<input type="text" value="'.$val.'" name="data[paylater][]" /><input type="hidden" name="data[paylaterIds][]" value="'.$key.'" />&nbsp;<a href="#" class="remove">'.JText::_('DT_REMOVE').'</a>';
			  
		  }
		 
		 return  self::checkboxList($name,$options,$values,'<br /></span>',"<span>");
	  
	 }
	 function checkboxListrows($name,$options=array(),$cols=4,$values=array()){
	    $html = "" ;
		//$values =  array_values($values);
		$chunk = array_chunk($options,$cols,TRUE );
		
		foreach($chunk as $data){
		  $html .='<tr>';

			foreach($data as $key=>$value){
	
				if(in_array($key,$values)){
	
					$checked = 'checked';
	
				}else{
	
					$checked = '';
	
				}
	
					$html .='<td><input type="checkbox" name="'.$name.'[]" '.$checked .' value="'.$key.'" />&nbsp; '.$value.'</td>';
	
			 }

		$html .='</tr>';

		}
		
		return $html;
	 }
	 function gridTask( &$row, $i, $task= "publish" , $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='' )
	{
		$img 	= $row->$task ? $imgY : $imgX;
		$tasktxt 	= $row->$task ? 'un'.$task : $task;
		$alt 	= $row->$task ? JText::_( 'DT_'.$task ) : JText::_( 'DT_UN'.$task );
		$action = $row->$task ? JText::_( 'DT_UN'.$task ) : JText::_( 'DT_'.$task );

		$href = '
		<a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$tasktxt .'\')" title="'. $action .'">
		<img src="images/'. $img .'" border="0" alt="'. $alt .'" /></a>'
		;

		return $href;
	}
	
	function sort( $title, $order, $direction = 'asc', $selected = 0, $task=NULL ){
		
		global $button_color;
		
		$direction	= strtolower( $direction );
		$images		= array( 'down.png', 'up.png' );
		$index		= intval( $direction == 'desc' );
		$direction	= ($direction == 'desc') ? 'asc' : 'desc';

		$html = '<a href="javascript:tableOrdering(\''.$order.'\',\''.$direction.'\',\''.$task.'\');" title="'.JText::_( 'Click to sort this column' ).'">';
		$html .= JText::_( $title );
		if ($order == $selected ) {
			$html .= JHTML::_('image.site',  $images[$index], '/components/com_dtregister/assets/images/'.$button_color.'/', NULL, NULL);
		}
		$html .= '</a>';
		return $html;
	}
	
	function order($rows, $image='filesave.png', $task="saveorder"){
		$image = JHTML::_('image.administrator',  $image, '/components/com_dtregister/assets/images/', NULL, NULL, JText::_( 'Save Order' ) );
		$href = '<a href="javascript:saveorder('.(count( $rows )-1).', \''.$task.'\')" title="'.JText::_( 'Save Order' ).'">'.$image.'</a>';
		return $href;
	}
	
	function orderUpIcon($i, $condition = true, $task = 'orderup', $alt = 'Move Up', $enabled = true , $pagnav)
{
        $alt = JText::_($alt);
 
        $html = '&nbsp;';
        if (($i > 0 || ($i + $pagnav->limitstart > 0)) && $condition)
        {
                if($enabled) {
                        $html   = '<a href="#reorder" onclick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">';
                        $html   .= '   <img src="components/com_dtregister/assets/images/uparrow.png" width="16" height="16" border="0" alt="'.$alt.'" />';
                        $html   .= '</a>';
                } else {
                        $html   = '<img src="components/com_dtregister/assets/images/uparrow0.png" width="16" height="16" border="0" alt="'.$alt.'" />';
                }
        }
 
        return $html;
}

function orderDownIcon($i, $n, $condition = true, $task = 'orderdown', $alt = 'Move Down', $enabled = true,$pagnav)
{
        $alt = JText::_($alt);
 
        $html = '&nbsp;';
        if (($i < $n -1 || $i + $pagnav->limitstart < $pagnav->total - 1) && $condition)
        {
                if($enabled) {
                        $html   = '<a href="#reorder" onclick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">';
                        $html   .= '  <img src="components/com_dtregister/assets/images/downarrow.png" width="16" height="16" border="0" alt="'.$alt.'" />';
                        $html   .= '</a>';
                } else {
                        $html   = '<img src="components/com_dtregister/assets/images/downarrow0.png" width="16" height="16" border="0" alt="'.$alt.'" />';
                }
        }
 
        return $html;
}

function published( &$row, $i, $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='' )
	{
		$img 	= $row->published ? $imgY : $imgX;
		$task 	= $row->published ? 'unpublish' : 'publish';
		$alt 	= $row->published ? JText::_( 'Published' ) : JText::_( 'Unpublished' );
		$action = $row->published ? JText::_( 'Unpublish Item' ) : JText::_( 'Publish item' );

		$href = '
		<a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$task .'\')" title="'. $action .'">
		<img src="components/com_dtregister/assets/images/'. $img .'" border="0" alt="'. $alt .'" /></a>'
		;

		return $href;
	}


  
}

class JDTHTML extends JHTML{
    
	function tooltip($tooltip, $title='', $image='tooltip.png', $text='', $href='', $link=1,$class='DtTip'){
	    
		$tip =  parent::tooltip($tooltip, $title='', $image='tooltip.png', $text='', $href='', $link=1);
		
		return str_replace('hasTip',$class,$tip);
		
	}
	
}
  
?>
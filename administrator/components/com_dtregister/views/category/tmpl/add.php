<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$mosConfig_live_site = JURI::base( true );

$rows=$this->getModel('category')->find(' parent_id=0 ');
$temp =  array();
foreach($rows as $row){
   $temp[$row->categoryId] = $row->categoryName ;
}
 $options = DtHtml::options($temp,JText::_( 'DT_SELECT_PARENT' ));
 $list['parent_id'] = JHTML::_('select.genericlist', $options,"parent_id","","value","text");
 $document =& JFactory::getDocument();
 
$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/colorpicker.js');

$document->addStyleSheet(  JURI::root(true).'/components/com_dtregister/assets/css/colorpicker/colorpicker.css' ,'text/css','screen',array('charset'=>"utf-8") );

$accesOptions =  array('0'=>JText::_('DT_PUBLIC'),'1'=>JText::_('DT_REGISTERED'),'2'=>JText::_('DT_SPECIAL'));
?>

<script language="javascript" src="<?php echo $mosConfig_live_site ?>/includes/js/joomla.javascript.js"></script>

<form action="index2.php" method="post" name="adminForm" id="adminForm">

<p><?php echo JText::_( 'DT_CATEGORY_INSTRUCTIONS' ); ?></p>

<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminlist">
    <tr>
        <td width="200"><?php echo JText::_( 'DT_PARENT_CATEGORY' ); ?>:</td><td><?php echo $list['parent_id'] ?></td>
        <td  align="left">
     		&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
	
      	<td ><?php echo JText::_( 'DT_PUBLISH' ); ?>:</td>

      	<td>

			<?php

			$options=array();

			$options[]=JHTML::_('select.option',"0",JText::_( 'No' ));

			$options[]=JHTML::_('select.option',"1",JText::_( 'Yes' ));

            echo JHTML::_('select.radiolist', $options, 'published','','value','text',0);

			?>

      	</td>
        <td  align="left">
     		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_CAT_PUBLISH_HELP' )), '', 'tooltip.png', '', ''); ?>
        </td>
   </tr>
   <tr>
        <td width="200"><?php echo JText::_( 'DT_CATEGORY_NAME' ); ?>:</td><td><input type="text" name="categoryName" size="80" />
        </td>
        <td align="left">
     		&nbsp;&nbsp;
        </td>
   </tr>
 
   <tr>
        <td><?php echo JText::_('DT_SELECT_CAT_COLOR'); ?></td>

        <td>

			<span id="colorPicker1" style="float:left; border:1px solid black; width:20px; height:20px;margin:5px;"></span>
			<span id="text1" style=""><?php echo JText::_('DT_CLICK_SQUARE');?></span>

        </td>
        <td align="left">
     		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_SELECT_CAT_COLOR_HELP' )), '', 'tooltip.png', '', ''); ?>
        </td>
   </tr>
   <tr> 
        <td>
           <?php echo  JText::_('DT_ACCESS_LEVEL');?>
        </td>
        <td>
           <?php echo JHTML::_('select.genericlist',   DtHtml::options($accesOptions), 'access', '', 'value', 'text'); ?>
        </td>
        <td align="left">
     		&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_ACCESS_LEVEL_HELP' )), '', 'tooltip.png', '', '',0); ?>
        </td>
   </tr>
</table>
<input type="hidden" name="color" id="colorpic" value="">
<input type="hidden" name="task" value="save">

<input type="hidden" name="controller" value="category">

<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT ;?>">

<input type="hidden" name="hidemainmenu" value="0">

</form>
<script type="text/javascript">
  DTjQuery(function(){

	  DTjQuery("#colorPicker1").mlColorPicker({'onChange': function(val){
				DTjQuery("#colorPicker1").css("background-color", "#" + val);
				DTjQuery("#colorpic").val("#" + val);
	  }});

  })

</script>

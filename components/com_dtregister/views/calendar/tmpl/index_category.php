<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

  global $Itemid;
  $mCat = $this->getModel('category');
  $cats = $mCat->table->find(' published = 1');
  $html = "";
  
  foreach($cats as $cat){
	  $html .= '<div style="float:left;padding:2px 4px 2px 4px;margin:0px 1px 0px 1px;border:solid;border-width:1px 4px 1px 4px;border-color:'.$cat->color.'">';
	  $html .= '<a class="add_date" attr = "'.JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat='.$cat->categoryId).'" href="'.JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat='.$cat->categoryId).'">';
	  $html .= $cat->categoryName;
	  $html .= '</a>';
	  $html .= '</div>';
  }

?>
<div>
<div style="float:left;padding:2px 4px 2px 4px;margin:0px 1px 0px 1px;">
  <a class="add_date" attr="<?php echo JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat=all') ?>" href="<?php echo JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat=all') ?>"><?php echo JText::_('DT_ALL_CATEGORIES')?></a>
</div>
<?php echo $html; ?>

</div>
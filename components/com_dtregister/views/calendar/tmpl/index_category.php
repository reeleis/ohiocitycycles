<?php
  global $Itemid ;
  $mCat = $this->getModel('category');
  $cats = $mCat->table->find(' published = 1');
   $html = "" ;
  
  foreach($cats as $cat){
	  $html .= '<div style="float:left;padding:0 0 0 4px;border:solid;border-left-width:8px;border-color:'.$cat->color.'">';
	  $html .= '<a href="'.JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat='.$cat->categoryId).'">';
	  $html .= $cat->categoryName;
	  $html .= '</a>';
	  $html .= '</div>';
  }

?>
<div >
<div style="float:left">
  <a href="<?php echo JRoute::_('index.php?option=com_dtregister&task=calendar&controller=calendar&Itemid='.$Itemid.'&cat=all') ?>"><?php echo  JText::_('DT_ALL_CATEGORIES')?></a>
</div>
<?php echo $html ; ?>

</div>
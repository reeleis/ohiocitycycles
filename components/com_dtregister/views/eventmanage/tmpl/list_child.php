<?php 

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $eventListOrder, $Itemid;

$pageNav = $this->pageNav;

$tCategory = $this->getModel('category')->table;

$chd = $this->getModel('event')->table;

$i = $this->checkboxvalue;

$k = 0;

  foreach($this->event->childs as $child){

	  $i++;

	  $chd->load($child->slabId);  

	  
      
	  if ($chd->category == 0 || !isset($chd->category) ){$chd->categoryName=JText::_( 'DT_NONE' );}else{

		 

		 $tCategory->load($chd->category);

		 $chd->categoryName = $tCategory->categoryName;

	  }

	  ?>

      <tr class="<?php echo "row$k"; ?> child" id="<?php echo  $this->parent_id; ?>" >

        <td>&nbsp;
          
        </td>

        <td width="20" >

          <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $chd->slabId; ?>" onclick="isChecked(this.checked);" />

        </td>

        <td align="left">

          <a href="index.php?option=com_dtregister#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">

            <?php echo $chd->displayTitle(); ;?>

          </a>

       <?php

             $img = $chd->publish ? 'publish_g.png' : 'publish_x.png';

		     $alt = $chd->publish ? JText::_( 'DT_PUBLISHED' ) : JText::_( 'DT_UNPUBLISHED' );

		?>

	     </td>

        <td>

           <?php echo (int)$chd->slabId;  ?>

        </td>

       <td align="left">

         <?php $task =  $chd->publish?'unpublish':'publish';
		    
			 $chd->published = $chd->publish;
		     echo DtHtml::published( $chd, $i);
		 
		  ?>

       </td>

        <td align="left"><?php echo $chd->categoryName; ?></td>

        <td align="left"><?php echo $chd->displaytimecolumn();?></td>
<!--
        <td align="left"><?php // echo $chd->email; ?></td>
-->
    <?php

     if($eventListOrder ==0){

	?>

	  <td align="left">

            <!--<span><?php echo $pageNav->orderUpIcon( $i, true,'orderup', 'Move Up' ); #echo $pageNav->orderUpIcon( $i, ($row->category == @$rows[$i-1]->category), 'orderup_event', 'Move Up' ); ?></span>-->

		</td>

		<td align="left" rowspan="<?php echo $rowspan; ?>">

			<!--span><?php echo $pageNav->orderDownIcon( $i, $k, true,'orderdown', 'Move Down');# echo $pageNav->orderDownIcon( $k, $n, ($row->category == @$rows[$k+1]->category),'orderdown_event', 'Move Down'); ?></span-->

		</td>

		<td align="left" >

			<!--<input type="text" name="order[<?php echo $chd->slabId;?>]" size="5" value="<?php echo $chd->ordering; ?>" <?php //echo $disabled ?> class="text_area" style="text-align: center" />-->

		</td>

      <?php

    }

   ?>
<!--
     <td>

       <a class="colorbox" href="<?php // echo JRoute::_('index.php?option=com_dtregister&controller=feeorder&no_html=1&task=view&eventId='.$chd->eventId) ?>" ><?php // echo JText::_('DT_FEE_ORDERING')?></a>

     </td>
-->
      <?php $k = 1 - $k; echo "</tr>"; 

	  }

?>
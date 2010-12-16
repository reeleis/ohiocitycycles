<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

jimport( 'joomla.html.pagination' );

$rows = $this->getModel('category')->find(null,' ordering ');

$pageNav = new JPagination(count($rows), 0, 10);
$accesOptions =  array('0'=>JText::_('DT_PUBLIC'),'1'=>JText::_('DT_REGISTERED'),'2'=>JText::_('DT_SPECIAL'));
$children = array();

        foreach ($rows as $v )

		{

			$pt = $v->parent_id;

			$list = @$children[$pt] ? $children[$pt] : array();

			array_push( $list, $v );

			$children[$pt] = $list;

		}

	    $catlist=array();

		  if(isset($children[0]) && is_array($children[0]))

		  foreach($children[0] as $pcategory){

		   $catlist[]=$pcategory;

		   if(isset($children[$pcategory->categoryId])){

		       foreach($children[$pcategory->categoryId] as $childcat){

				   $childcat->categoryName = "|_".$childcat->categoryName ;

			       $catlist[]=$childcat;

			   }

		   }

		}

		$rows = $catlist ;	

?>

<form action="index.php" method="post" name="adminForm" autocomplete="off">

  <p><?php echo JText::_( 'DT_CATEGORY_INSTRUCTIONS'); ?></p>

<!--# Category ID ,Category Name, Parent Category, Access Level ,Status, Reorder, Order Delete -->
   <table class="adminlist" align="left" style="width:900px">
       <tr>
           <th width="20" class="dt_heading"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
           <th width="5" align="left" class="dt_heading">#</th>
           <th width="10" align="left" class="dt_heading"><?php echo JText::_( 'DT_CATEGORY_ID' ); ?></th>
           <th width="325" align="left" class="dt_heading"><?php echo JText::_( 'DT_CATEGORY_NAME' ); ?></th>
           <th width="325" align="left" class="dt_heading"><?php echo JText::_( 'DT_PARENT_CATEGORY' ); ?></th>
           <th width="100" align="left" class="dt_heading"><?php echo JText::_( 'DT_ACCESS_LEVEL' ); ?></th>
           <th width="25" align="left" class="dt_heading"><?php echo JText::_( 'DT_STATUS' ); ?></th>
           <th colspan="2" width="50" class="dt_heading"><?php echo JText::_( 'DT_REORDER' ); ?></th>
           <th width="20" class="dt_heading"><?php echo JText::_( 'DT_ORDER' );  echo JHTML::_('grid.order',  $rows ); ?></th>
           <th width="20" align="left" class="dt_heading"><?php echo JText::_( 'DT_DELETE' ); ?></th>
	</tr>

	<?php

	  $k = 0;

      for ($i=0, $n=count( $rows ); $i < $n; $i++) {

      $row = &$rows[$i];

	  $link1 = 'index.php?option=com_dtregister&task=edit&controller=category&hidemainmenu=1&id='. $row->categoryId;

      $link2 = 'index.php?option=com_dtregister&task=delete&controller=category&hidemainmenu=1&id='. $row->categoryId;

      $color = ($row->color!="")?'style="background-color:'.$row->color.';"':'';
	  $published = JHTML::_('grid.published', $row, $i);

	?>

	<tr class="<?php echo "row$k"; ?>">
       <td <?php echo $color; ?>>
         <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->categoryId; ?>" onclick="isChecked(this.checked);" />
       </td>
       <td><?php echo $k+1; ?></td>
       <td><?php echo $row->categoryId;?></td>
       <td><a href="<?php echo $link1?>"><?php echo stripslashes($row->categoryName);?></a></td>
       <td><?php

		  $database = &JFactory::getDBO();

          $parent =  new TableCategory($database);

		  $parent->load($row->parent_id);

		  echo $parent->categoryName;

		 ?>

        </td>
 
       <td><?php echo $accesOptions[$row->access] ;?></td>       
       <td><?php echo  $published ;?></td>
       <td>

        <span><?php echo $pageNav->orderUpIcon( $i, true, 'orderup', 'Move Up' ); ?></span>

       </td>

		<td>

        <span><?php echo $pageNav->orderDownIcon( $i, $n ,true,'orderdown', 'Move Down'); ?></span>

        </td>

        <td align="center" >

				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />

		</td>

        <td><a href="<?php echo $link2?>"><img src="components/com_dtregister/assets/images/delete.jpg" style="height:16px; width:16px; border: 0px; padding-left:3px"</a></td>

	  <?php $k = $k+ 1; } ?>

	</tr>

	</table>

  <input name="task"  type="hidden" value="edit" />

  <input type="hidden" name="controller" value="category" />

  <input name="option"  type="hidden" value="<?php echo DTR_COM_COMPONENT; ?>" />

  <input type="hidden" name="boxchecked" value="0" />

</form>

<script language="javascript">

			function savecategoryOrder(n,task)

			{

				for ( var j = 0; j <= n; j++ )

				{

					box = eval( "document.adminForm.cb" + j );

					if ( box ) {

						if ( box.checked == false ) {

							box.checked = true;

						}

					} else {

						alert("You cannot change the order of items, as an item in the list is `Checked Out`");

						return;

					}

				}

				submitform(task);

			}

		</script>

   <script language="javascript" type="text/javascript">

        function hideMainMenu()

       {

    window.location = "index2.php?option=com_dtregister&task=new&controller=category&hidemainmenu=1";

        }

function submitbutton(pressbutton) {

var form = document.adminForm;

		if (pressbutton) {

			submitform( pressbutton );

			return;

		}

}

</script>

<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$rows = $this->rows;

$pageNav = $this->pageNav;

$search = $this->search;

$custom_field_types =  $this->getModel('fieldtype')->getTypes();
global $Itemid ;
?>

	<form action="index.php?option=com_dtregister&Itemid=<?php echo $Itemid; ?>" method="post" name="adminForm">

    <p><?php echo JText::_( 'DT_CUSTOM_FIELD_INSTRUCTIONS' ); ?></p>

		<table class="adminheading">

		<tr>

			<td><strong><?php echo JText::_( 'DT_FILTER' );?>: </strong></td>

			<td>

			<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="text_area" onChange="document.adminForm.submit();" />

			</td>

		</tr>

		</table>

		<table class="adminlist">

		<tr>

			<th width="10" class="dt_heading">#</th>

			<th width="20" class="dt_heading">

			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />

			</th>

			<th class="dt_heading"><?php echo JText::_( 'DT_NAME' );?></th>

            <th width="100" class="dt_heading"><?php echo JText::_( 'DT_FIELD_TYPE' );?></th>

            <th class="dt_heading"><?php echo JText::_( 'DT_EMAIL_TAG' );?></th>

			<th width="35" class="dt_heading"><?php echo JText::_( 'DT_SIZE' );?></th>

			<th class="dt_heading"><?php echo JText::_( 'DT_LABEL' );?></th>

			<th colspan="2" width="5%" class="dt_heading"><?php echo JText::_( 'DT_REORDER' );?></th>

			<th width="2%" class="dt_heading"><?php echo JText::_( 'DT_ORDER' );?></th>

			<th width="1%" class="dt_heading">

			<a href="javascript: saveOrderCustom( <?php echo count( $rows )-1; ?>,'saveorder')"><img src="components/com_dtregister/assets/images/filesave.png" border="0" width="16" height="16" alt="<?php echo JText::_( 'DT_SAVE_ORDER' ); ?>" /></a>

			</th>

			<th width="20" class="dt_heading"><?php echo JText::_( 'DT_PUBLISHED' );?></th>

		</tr>

		<?php

		$k = 0;

		for ($i=0, $n=count( $rows ); $i < $n; $i++) {

			$row = &$rows[$i];

			$link 	= 'index.php?option='.$option.'&task=edit&controller=field&Itemid='.$Itemid.'&hidemainmenu=1&cid[]='. $row->id;

			$task 	= $row->published ? 'unpublish' : 'publish';

			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';

			$alt 	= $row->published ? JText::_( 'DT_PUBLISHED' ) : JText::_( 'DT_UNPUBLISHED' );

			$row->checked_out = false;

			$checked 	= JHTML::_('grid.checkedout',   $row, $i );

			?>

			<tr class="<?php echo "row$k"; ?>">

				<td>

				<?php  echo $pageNav->getRowOffset( $i ); ?>

				</td>

				<td>

				<?php echo $checked; ?>

				</td>
              
				<td align= "center">

					<a href="<?php echo $link; ?>" title="Edit Customfield">

						<?php echo $row->name; ?>

					</a>

				</td>

                 <td align="center">

						<?php echo $custom_field_types[$row->type]; ?>

				</td>

                <td align="center">

						<?php echo ($row->tag!="")?"[".$row->tag."]":''; ?>

				</td>

				<td align="center">

					<?php echo $row->field_size?>

				</td>

				<td align="center">

				<?php echo $row->label?>

				</td>

				<td>

				
                <?php echo DtHtml::orderUpIcon( $i, true, 'orderup', 'Move Up' , true, $pageNav ); ?>

				</td>

	  	    	<td>
                 <?php echo DtHtml::orderDownIcon( $i, $n ,true,'orderdown', 'Move Down',true, $pageNav); ?>
				

				</td>

				<td align="center" colspan="2">

				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />

				</td>

				<td align="center">
                   <?php echo DtHtml::published( $row, $i); ?>
				

				</td>

			</tr>

			<?php	$k = 1 - $k; } ?>

		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

		<input type="hidden" name="task" value="" />

		<input type="hidden" name="boxchecked" value="0" />

        <input type="hidden" name="controller" value="field" />

		<input type="hidden" name="hidemainmenu" value="0">
        
        <input type="hidden" name="Itemid" value="<?php echo Itemid; ?>">


		</form>

		<script language="javascript">

			function saveOrderCustom(n,task)

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
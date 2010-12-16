<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$d_code = $this->getModel('discountcode')->table;

$rows = $this->getModel('discountcode')->find();
global $Itemid ;
?>

<form action="index.php" method="post" name="adminForm" id="adminForm" class="adminform">

    <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

      <tr>

        <th width="20" class="dt_heading">

          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />

        </th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_NAME'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_START_DATE'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_END_DATE'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_DISCOUNT_CODE'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_PUBLISH'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_DISCOUNT_CODE_LIMIT'); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_DISCOUNT_CODE_USED'); ?>:</th>

      </tr>

<?php

    $k = 0;

	$n=count( $rows );

    if ($n>0){

    for ($i=0, $n=count( $rows ); $i < $n; $i++ ) {

      $row = &$rows[$i];

			$task 	= $row->publish ? 'unpublish' : 'publish';

			$img 	= $row->publish ? 'publish_g.png' : 'publish_x.png';

			$alt 	= $row->publish ? JText::_( 'DT_PUBLISHED' ) : JText::_( 'DT_UNPUBLISHED' );

	   $d_code->load($row->id);

?>

      <tr class="<?php echo "row$k"; ?>">

        <td width="20">

          <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />

        </td>

        <td align="left">

          <a href="index2.php?option=com_dtregister&task=edit&controller=discountcode&id=<?php echo $row->id; ?>&Itemid=<?php echo $Itemid; ?>" >

            <?php echo $row->name;?>

          </a>

	  </td>

        <td align="left"><?php echo (strtotime($row->start)!="")?($row->start):JText::_( 'DT_NOT_SPECIFIED' ); ?> </td>

        <td align="left"><?php echo (strtotime($row->end)!="")?($row->end):JText::_( 'DT_NOT_SPECIFIED' ); ?> </td>

		<td align="left"><?php echo $row->code; ?></td>

        <td align="center">

				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')">

				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />

				</a>

		</td>

         <td align="left"><?php echo ($row->limit !=='0')?$row->limit:JText::_( 'DT_DISCOUNT_CODE_UNLIMITED'); ?></td>

         <td align="left"><?php echo ($d_code->used())?$d_code->uses:0; ?></td>

      <?php $k = 1 - $k; echo  "</tr>" ; }

    } else { ?>

		<td align="center" colspan="9"><?php echo '<b>'. JText::_( 'DT_NO_DISCOUNT_CODE') . '</b>'; ?></td>

	<?php } ?>

    </table>

    <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

    <input type="hidden" name="task" value="" />

    <input type="hidden" name="controller" value="discountcode" />

    <input type="hidden" name="boxchecked" value="" />
    
   
</form>
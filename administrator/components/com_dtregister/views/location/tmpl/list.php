<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

?>
<?php
 global $mainframe;

  $database = &JFactory::getDBO();

  jimport('joomla.html.pagination');

  $limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );

  $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

  $sql = "Select SQL_CALC_FOUND_ROWS * from #__dtregister_locations";

  $database->setQuery( $sql,$limitstart,$limit);

  $locations=$database->loadObjectList();

  $database->setQuery('SELECT FOUND_ROWS();');

  $pageNav = new JPagination( $database->loadResult(), $limitstart, $limit  );
?>
<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table width="100%" class="adminlist">

  <tr>

    <th width="12px;" class="dt_heading">

     <input type="checkbox" name="toggle" size="12" value="" onclick="checkAll(<?php echo count( $locations ); ?>);" />

    </th>

    <th class="dt_heading">

      <?php echo JText::_( 'DT_NAME');  ?></a>

    </th>

    <th class="dt_heading">

      <?php echo JText::_( 'DT_ADDRESS'); ?>

    </th>

    <th class="dt_heading">

      <?php echo JText::_( 'DT_CITY'); ?>

    </th>

    <th class="dt_heading">

      <?php echo JText::_( 'DT_STATE'); ?>

    </th>

    <th class="dt_heading">

      <?php echo JText::_( 'DT_ZIPCODE'); ?>

    </th>

   </tr>

  <tr>

  <?php 

  $k = 0;

  $i = 0;

    foreach($locations as $location){

	  	$link 	= 'index2.php?option=com_dtregister&task=edit&controller=location&hidematinmenu=1&cid[]='. $location->id;

		  $checked 	= JHTML::_('grid.id', $i ,  $location->id );

	  ?>

     <tr class="<?php echo "row$k"; ?>">

     <td>

      <?php echo $checked; ?>

     </td>

    <td>

      <a href="<?php echo $link; ?>"><?php echo stripslashes($location->name); ?></a>

    </td>

    <td>

      <?php echo $location->address.' '.$location->address2;  ?>

    </td>

    <td>

      <?php echo $location->city ; ?>

    </td>

    <td>

      <?php echo $location->state ; ?>

    </td>

    <td>

      <?php echo $location->zip ; ?>

    </td>

   </tr>

  <tr>

  <?php $i++ ;	$k = 1 - $k; } ?>

   <td colspan="6">

     <?php  echo $pageNav->getListFooter();?>

      <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT ;?>" />

      <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart; ?>" />

	  <input type="hidden" name="boxchecked" value="0" />
      <input type="hidden" name="controller" value="location" />
	  <input type="hidden" name="task" value="" />

   </td>

  </tr>

</table>

</form>
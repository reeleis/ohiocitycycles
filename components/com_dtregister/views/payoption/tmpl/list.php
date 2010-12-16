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

  $sql = "Select SQL_CALC_FOUND_ROWS * from #__dtregister_payment";

  $database->setQuery( $sql,$limitstart,$limit);

  $payments=$database->loadObjectList();

  $database->setQuery('SELECT FOUND_ROWS();');

  $pageNav = new JPagination( $database->loadResult(), $limitstart, $limit  );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table class="adminlist">

  <tr>

    <th width="12" class="dt_heading">

     <input type="checkbox" name="toggle" size="12" value="" onclick="checkAll(<?php echo count( $locations ); ?>);" />

    </th>
     
    <th width="300" class="dt_heading">

      <?php echo JText::_( 'DT_PAYMENT_NAME'); ?>

    </th>

	<th width="120" class="dt_heading">
	      <?php echo JText::_('DT_DEFAULT'); ?>
	</th>

   </tr>

  <tr>

  <?php 

  $k = 0;

  $i = 0;

    foreach($payments as $payment){

	  	$link 	= 'index.php?option=com_dtregister&task=edit&controller=payoption&hidematinmenu=1&cid[]='. $payment->id;

		  $checked 	= JHTML::_('grid.id', $i , $payment->id );

	  ?>

     <tr class="<?php echo "row$k"; ?>">

     <td>

      <?php echo $checked; ?>

     </td>

	 <td>

       <a href="<?php echo $link; ?>"><?php echo stripslashes($payment->name); ?></a>

     </td>
     
     <td>
       <?php
          if($payment->default){
			  ?>
              <a href="index.php?option=com_dtregister#deselectdefault"  onclick="return listItemTask('cb<?php echo $i;?>','deselectdefault')">
              <?php
			  echo  JHTML::_('image', 'administrator/templates/khepri/images/menu/icon-16-default.png', null);
			   ?>
               </a>
              <?php
		  }else{
		  ?>
			   <a href="index.php?option=com_dtregister#default" onclick="return listItemTask('cb<?php echo $i;?>','makedefault')"><?php echo JText::_('DT_MAKE_DEFAULT'); ?></a>
          <?php
		  }
	   ?>
     </td>
    
   </tr>

  <tr>

  <?php $i++ ;	$k = 1 - $k; } ?>

   <td colspan="3">

     <?php  echo $pageNav->getListFooter();?>

      <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT ;?>" />

      <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart; ?>" />

	  <input type="hidden" name="boxchecked" value="0" />
      <input type="hidden" name="controller" value="payoption" />
	  <input type="hidden" name="task" value="" />

   </td>

  </tr>

</table>

</form>
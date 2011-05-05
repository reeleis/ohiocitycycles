<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

   jimport('joomla.html.pagination');

   $mosConfig_live_site = JURI::base( true );

   $event = $this->getModel('event')->table;

   $config = $this->getModel('config');

   global $mainframe;

   $search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );

   $search = $event->db->getEscaped( trim( strtolower( $search ) ) );

   $eventId=JRequest::getInt( 'eventId',0);

   $publish=JRequest::getInt( 'publish',"-1");

   $archive = JRequest::getVar('archive',-1);

   $where = array();

    $where[] = " ( a.parent_id = 0 || a.parent_id = a.slabId)";

	if ($search) { $where[] = " a.title LIKE '%$search%' "; }

	if($eventId>0){ $where[]=" a.slabId=$eventId "; }

    if($publish =="1" || $publish =="0"){

	  $where[] = " a.publish = '$publish' ";

	}

	 switch($archive){

      case -1:

	      $where[] = " a.archive=0 ";

	  break;

	  case 0: // all events

	       $archivesql = " ";

	  break;

	  case 1:

	       $where[]= " a.archive=1 ";

	  break;

   }

   $ordering = " c.ordering asc, a.ordering ASC ";

   $limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );

   $limitstart = $mainframe->getUserStateFromRequest( "view.dtreg_event_list.limitstart", 'limitstart', 0 );

   $where =  (count($where) >0 )?implode(' and ' , $where):'';	

   $rows = $event->findalldetail($where,$ordering,$limitstart,$limit);

   $pageNav = new JPagination( $event->getLastCount(), $limitstart, $limit  );

   $this->assign('pageNav',$pageNav);

?>

<script language="javascript">
function saveOrder(n,task)
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

   <form action="index2.php" method="post" name="adminForm">

  <table cellpadding="4" cellspacing="0" border="0" width="100%">

    <tr>

      <td width="50%" align="left">&nbsp;</td>

      <td nowrap><?php echo JText::_( 'DT_DISPLAY_NUM' ); ?> :</td>

      <td nowrap><?php echo $pageNav->getLimitBox(); ?> </td>

      <td><?php echo JText::_( 'DT_FILTER' ); ?>:</td>

	  	<td>

	  		<?php
	
	  			 $events = DtHtml::options($event->optionslist(),JText::_('DT_SELECT_EVENT'));
				 // echo '<pre>';
				 // print_r($event->optionslist());

				 echo JHTML::_('select.genericlist', $events,"eventId","onchange=document.adminForm.submit()","value","text",JRequest::getVar('eventId',''));

	  		?>

	  	</td>

       <!-- <td>

         <?php

		echo JText::_( 'DT_SHOW' );

		?>

        </td>-->

         <td>

        <?php

		  $options=array();

          $options[]=JHTML::_('select.option',"-1",JText::_( 'DT_ALL_EVENT' ));

	      $options[]=JHTML::_('select.option',"1",JText::_( 'DT_PUBLISHED' ));

	      $options[]=JHTML::_('select.option',"0",JText::_( 'DT_UNPUBLISHED' ));

          $publish = JRequest::getVar('publish');

	      echo JHTML::_('select.genericlist', $options,"publish",' onchange="submit()" ',"value","text",$publish);

			?>

        </td>
 
        <td>

        <?php

		  $options=array();

          $options[]=JHTML::_('select.option',"-1",JText::_( 'DT_HIDE_ARCHIVE' ));

	      $options[]=JHTML::_('select.option',"1",JText::_( 'DT_SHOW_ARCHIVE' ));

	      $options[]=JHTML::_('select.option',"0",JText::_( 'DT_ALL_EVENT' ));

          $archive = JRequest::getVar('archive',-1);

	      echo JHTML::_('select.genericlist', $options,"archive",' onchange="submit()" ',"value","text",$archive);

		?>

        </td>

      <td><?php echo JText::_( 'DT_SEARCH' ); ?>:</td>

      <td><input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />

      <input type="hidden" name="act" value="groups" />

      </td>

      <td width="right"> <?php if(isset($clist)){echo $clist;} ?> </td>

    </tr>

   <?php

     $this->loadTemplate('description');

   ?>

	  <td colspan="9">&nbsp;</td>

	</tr>

  </table>

    <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

<?php

   ob_start();

    $k = 0;

	$n=count( $rows );

    $checkboxvalue = 0;
    $prevcat = 0;
    if ($n>0){

    for ($i=0, $n=count( $rows ); $i < $n; $i++,$checkboxvalue++ ) {

      $row = &$rows[$i];

	  $event->load($row->slabId);	  

	  $rowdata = $event;

      if ($row->categoryName==""){$row->categoryName=JText::_( 'DT_NONE' );}

?>

      <tr class="<?php echo "row$k"; ?>">

       <td class="parent">
           <?php if($event->setChilds()){

			     echo '<img src="'.JURI::root(true).'/administrator/components/com_dtregister/assets/images/expand.png" border="0" />';

			    }

		 ?>
       </td>

        <td width="25" >

        <input type="checkbox" id="cb<?php echo $checkboxvalue;?>" name="cid[]" value="<?php echo $row->slabId; ?>" onclick="isChecked(this.checked);" />

        </td>

        <td align="left">

          <a href="index2.php?option=com_dtregister#edit" onclick="return listItemTask('cb<?php echo $checkboxvalue;?>','edit')">

            <?php echo $event->displayTitle(); ;?>

          </a>

       <?php

             $img = $row->publish ? 'publish_g.png' : 'publish_x.png';

		     $alt = $row->publish ? JText::_( 'DT_PUBLISHED' ) : JText::_( 'DT_UNPUBLISHED' );

		?>

	     </td>

        <td>

           <?php echo (int)$row->slabId;  ?>

        </td>

       <td align="left">

         <?php $task =  $row->publish?'unpublish':'publish'; ?>

         <a href="index2.php?option=com_dtregister#publish" onclick="return listItemTask('cb<?php echo $checkboxvalue;?>','<?php echo $task; ?>')">

         <img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>

       </td>

        <td align="left"><?php echo $row->categoryName; ?></td>

        <td align="left"><?php echo $event->displaytimecolumn(); ?></td>

        <td align="left"><?php echo $row->email; ?></td>

    <?php

     if($config->getGlobal('eventListOrder')==0){
        
		
	?>

	  <td align="left">
            <?php $showorderUP = ($prevcat != $row->categoryId)?false:true?>
            <span><?php echo $pageNav->orderUpIcon( $i, $showorderUP,'orderup', 'Move Up' ); #echo $pageNav->orderUpIcon( $i, ($row->category == @$rows[$i-1]->category), 'orderup_event', 'Move Up' ); ?></span>

		</td>

		<td align="left" >
            <?php 
			 $j = $i;
			 
			 $showorderDown = true;
			 for($j=($i+1);$j;$j++){
				 if(!isset($rows[$j])){
				   break;	 
				 }
				  
				 if($rows[$j]->event_parent == 0){
					 
					 if($rows[$j]->categoryId != $row->categoryId){
					    $showorderDown = false;
					 }else{
						 
						 $showorderDown = true;
					 }
					 break;
				 }else{
				    continue;
				 }
				 
			  }
			  
			 
			 ?>
			<span><?php echo $pageNav->orderDownIcon( $i, $k, $showorderDown,'orderdown', 'Move Down');# echo $pageNav->orderDownIcon( $k, $n, ($row->category == @$rows[$k+1]->category),'orderdown_event', 'Move Down'); ?></span>

		</td>

		<td align="left">

			<input type="text" name="order[<?php echo $row->slabId;?>]" size="5" value="<?php echo $event->ordering; ?>" <?php //echo $disabled ?> class="text_area" style="text-align: center" />

		</td>

      <?php

    }

   ?>

     <td>

       <a class="colorbox" href="<?php echo JRoute::_('index.php?option=com_dtregister&controller=feeorder&no_html=1&task=view&eventId='.$row->slabId) ?>" ><?php echo JText::_('DT_FEE_ORDERING')?></a>

     </td>

      <?php $k = 1 - $k; echo "</tr>"; 

	   if($event->setChilds()){

		 $this->assign('event',$event);  

		 $this->assign('checkboxvalue',$checkboxvalue);

		 $this->assign('parent_id',$row->slabId);

		 echo  $this->loadTemplate('child');

		 $checkboxvalue += count($event->childs);

	   }
       $prevcat = $row->categoryId;
	  }

    } else { ?>

		<td align="center" colspan="16"><?php echo '<b>'. JText::_( 'DT_NO_EVENTS' ) . '</b>'; ?></td>

	<?php }

	$html = ob_get_clean();

	 ?>

<tr>

       <th class="dt_heading">&nbsp;
         
       </th>

        <th width="20" class="dt_heading">

          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $checkboxvalue; ?>);" />

        </th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_EVENT_NAME' ); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_EVENTID' ); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_PUBLISH' ); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_CATEGORY_NAME' ); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_EVENT_TIME' ); ?>:</th>

        <th class="dt_heading" nowrap><?php echo JText::_( 'DT_ADMIN_EMAIL' ); ?>:</th>

     <?php

     if($config->getGlobal('eventListOrder','')==0){

	  ?>

        <th class="dt_heading" colspan="2" nowrap><?php echo JText::_( 'DT_REORDER' ); ?>:</th>

		<th class="dt_heading" nowrap><?php echo JText::_( 'DT_ORDER' ); ?>:

			   <a href="javascript: saveOrder( <?php echo count( $rows )-1; ?>,'saveorder')"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo JText::_( 'DT_SAVE_ORDER' ); ?>" /></a>

		</th>

       <?php

	 }

	?><br />

        <th class="dt_heading">

          <?php echo  JText::_('DT_FEE_ORDERING');?>

        </th>

      </tr>

      <?php echo $html; ?>

      <tr>

        <th align="center" colspan="16">

          <?php echo $pageNav->getPagesLinks(); ?></th>

      </tr>

      <tr>

        <td align="center" colspan="16">

          <?php # echo $pageNav->writePagesCounter(); ?></td>

      </tr>

    </table>

    <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT ;?>" />

    <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart; ?>" />

	<input type="hidden" name="boxchecked" value="0" />

    <input type="hidden" name="controller" value="event" />

	<input type="hidden" name="task" value="" />

    </form>

<?php

$document =& JFactory::getDocument();

$document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery-ui.js');

?>

<script type="text/javascript">

 DTjQuery(function(){

    DTjQuery(".colorbox").live('click',function(e){		

		e.preventDefault();

		var horizontalPadding = 30;

		var verticalPadding = 30;

		DTjQuery('<iframe id="externalSite" class="externalSite" src="'+DTjQuery(this).attr('href')+'" />').dialog({

			title:  '<?php echo JText::_('DT_FEE_ORDERING')?>',

			autoOpen: true,

			width: 800,

			height: 500,

			modal: true,

			resizable: true,

			autoResize: true,

			overlay: {

				opacity: 0.5,

				background: "black"

			}

		}).width(800 - horizontalPadding).height(500 - verticalPadding);

			     });

    DTjQuery(".child").hide();

	DTjQuery(".parent").toggle(

	   function(){

			var parent = DTjQuery(this).next().find('input:checkbox').val(); 

			DTjQuery('tr[id="'+parent+'"]').css('display','table-row');
            DTjQuery(this).children('img').attr('src','<?php echo  JURI::root(true); ?>/administrator/components/com_dtregister/assets/images/close.png')		 

	   },

		function(){

		    var parent = DTjQuery(this).next().find('input:checkbox').val(); 

			DTjQuery('tr[id="'+parent+'"]').css('display','none')

			DTjQuery(this).children('img').attr('src','<?php echo  JURI::root(true); ?>/administrator/components/com_dtregister/assets/images/expand.png')

		});               

 });

</script>
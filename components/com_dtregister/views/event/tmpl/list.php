<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 global $Itemid,$month_arr, $now, $xhtml_url, $googlekey, $amp, $show_event_image,$eventListOrder;

 $config = $this->getModel('config');

 $categoryTable = $this->getModel('category')->table;

 $eventTable = $this->getModel('event')->table;

 $document =& JFactory::getDocument();

 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.lightbox.js');

 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/jquery.lightbox.css');
 
 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/main.css');

 if($config->getGlobal('googlekey','')!==""){

   $document->addScript( "http://maps.google.com/maps?file=api".$amp."v=2.x".$amp."key=".$googlekey);

 }

 $limit = trim( JRequest::getVar('limit',$config->getGlobal('event_list_number','')) );

$where = array();

$limitstart = trim( JRequest::getVar('limitstart', 0 ) );

$month = JRequest::getVar('month','');

$year = JRequest::getVar('year','');//date('Y',$now->toUnix(true))

jimport('joomla.html.pagination');

$category = JRequest::getVar('category',"");
$cartcontinue = JRequest::getVar('cart','');

$search = JRequest::getVar('search');

$task = JRequest::getVar('task',''); 

if($task == "category"){

	$cats = array();

	for($i=1;$i<=12;$i++){

	   $cat_id = JRequest::getVar('list'.$i,'');

	   if( $cat_id > 0){

		  $cats[] = $cat_id;

	   }

	}
    $cat_id = JRequest::getVar('category','');
	if($cat_id > 0){
		$cats[] = $cat_id;
	}

	if(count($cats)>0){

	   $where[] = "  c.categoryId in( ".implode(",",$cats)." ) ";

	}

 }

 	$search = $config->getDBO()->getEscaped( trim( strtolower( $search ) ) );

if ($search){

  $where[] = "(b.event_describe LIKE '%{$search}%' OR b.title LIKE '%{$search}%' OR c.categoryName LIKE '%{$search}%'  OR l.name LIKE '%{$search}%' OR b.dtstart LIKE '%{$search}%' OR b.dtend LIKE '%{$search}%') ";

}

if($cartcontinue == 'continue'){
 // pr($_SESSION);
  $eventId = DT_Session::get('register.Event.eventId');
  $evtTcart = $this->getModel('event')->table;
  $evtTcart->load($eventId);
  $where[] = " b.payment_id = ".$evtTcart->payment_id;
 // prd($_SESSION);
    	
}

if(!$config->getGlobal('show_past_event',0)){

   $where[] = " (b.dtend >= '". $now->toFormat('%Y-%m-%d') ."' or b.dtend = '0000-00-00' or b.dtend Is Null) "; //(b.startdate <= now() || b.startdate is null ) and

}

$conf =& JFactory::getConfig();

$tzoffest = $conf->getValue('config.offset');

if($month !="" && $year !="" ){

   $start_date = new JDate($year."-".$month."-01");

$start_date->setOffset($conf->getValue('config.offset'));

$end_month = $month + 1;

if($end_month > 12){

      $end_month = "01";

	  $end_year = $year + 1;

   }else{

      $end_year = $year;

   }

    $end_date = new JDate($end_year."-".$end_month."-01");

$end_date->setOffset($conf->getValue('config.offset'));

   $where[] = " b.dtstart >= '".($start_date->toFormat('%Y-%m-%d'))."' and b.dtstart <  '".($end_date->toFormat('%Y-%m-%d'))."' " ;

}

if($month =="" && $year !="" ){

   $start_date = $year."-01-01";

   $end_year =  $year + 1;

   $end_date = $end_year."-01-01";

   $where[] = " b.dtstart >= '".($start_date)."' and b.dtstart <  '".($end_date)."' " ;

}

$my = & JFactory::getUser();

if(!$my->id){  // not logged in view only public event

   //$where[]  = " b.public = 1 ";	

}
$user =& JFactory::getUser();
$rows1 = $categoryTable->find('published = 1 and access <= '.$user->get('aid'),'ordering');

 $arrCategory = array();

	    for ($i=0,$n=count($rows1);$i<$n;$i++){

	    	$row1 = $rows1[$i];

	    	$catId = $row1->categoryId;

	    	$catName = $row1->categoryName;

	    	$tmpArr=array($catId=>$catName);

	    	DTrCommon::array_push_associative($arrCategory,$tmpArr);

	    }

$rows = $eventTable->findAllByCategory($categoryTable->orderByParent($rows1),implode(' and ',array_filter($where))," c.ordering, b.ordering ASC ");

?>

 <script type="text/javascript">

    //<![CDATA[

	DTjQuery(function(){ 

	  window.status='test';

	  DTjQuery(".colorbox").colorbox({width:550, height:550,iframe:true});

	  DTjQuery().bind('cbox_complete', function(){

		 // initialize();

        //setTimeout($.fn.colorbox.next, 1500);

       });

	})

    //]]>

</script>

<form action="<?php echo  JRoute::_("index.php?option=".DTR_COM_COMPONENT."&Itemid=".$Itemid, $xhtml_url ); ?>" method="post" name="frmcart">

   <table class="event_message" width="100%">

    <tr><th colspan="3" class="componentheading"><?php echo JText::_( 'DT_EVENT_REGISTRATION' );?></th></tr>

    <tr><td colspan="3"><?php echo JText::_( 'DT_EVENT_LIST_INSTRUCTIONS' );?></td></tr>

    <tr>

    <td align="left">

    <?php  if($config->getGlobal('event_search_show',0)==1){ ?>

    <b><?php echo JText::_( 'DT_SEARCH' ); ?>:</b> 

    <input type="text" name="search" value="<?php echo JRequest::getVar('search',''); ?>" class="inputbox" />

    <input type="submit" value="<?php echo JText::_( 'DT_SEARCH_GO' );?>" />

    <?php } ?>

    </td>

    <td>

    <?php 

	if($config->getGlobal('month_filter_show',0)){ // month filter flag 

	  $month_opts=DtHtml::options($month_arr,JText::_( 'DT_SELECT_MONTH' ));

	  echo JHTML::_('select.genericlist', $month_opts,"month",'onchange="submit()"',"value","text",$month); 

      $year_opts = array();

	  $year_opts[] = JHTML::_('select.option',"",JText::_( 'DT_SELECT_YEAR' ));

      for($i=2015 ; $i > 2007; $i-- ){

	    $year_opts[]=JHTML::_('select.option',$i,$i);

	  }

	  echo JHTML::_('select.genericlist', $year_opts,"year",'onchange="submit()"',"value","text",$year); 

	  ?>

       </td>     

       <?php }else{

	     $month = "";

	   } ?> 

    	<td align="right">

         <?php if($config->getGlobal('event_filter_show',0)==1){?>

        <?php

		  $options = DtHtml::options( $categoryTable->optionslist(),JText::_( 'DT_CATEGORY_VIEW' ));

		 echo JHTML::_('select.genericlist', $options,"category",'onchange="submit()"',"value","text",JRequest::getVar('category','')); ?>

         <?php } ?>

      </td>      

     </tr>

   </table>

   <table class="event_message" width="100%">

      <tr>
      <?php if($show_event_image){?>
       <th class="coltitle" align="left"> </th>
       <?php } ?>
      <th class="coltitle" align="left" width="<?php echo $config->getGlobal('event_field_width',0); ?>"><?php echo JText::_( 'DT_EVENT' );?></th>

         <?php $j=2;
		  if( $config->getGlobal('event_date_show',0)){ 
		  $j++;
		   ?>
 
		    <th class="coltitle" align="left" width="<?php echo $config->getGlobal('event_date_width',0); ?>"><?php echo JText::_( 'DT_DATE' );?></th>

        <?php } ?>

	<?php

		if($config->getGlobal('price_column',0)){

           $j++;

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_PRICE' ). '</th>';

		}

		if($config->getGlobal('capacity_column',0)){

           $j++;

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_CAPACITY' ). '</th>';

		}

		if($config->getGlobal('registered_column',0)){

          $j++;

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_REGISTERED' ).'</th>';
			
		}

	?>

	</tr>

    <?php

	if($rows){

		$total = count($rows);

		$limit = trim( JRequest::getVar('limit',$config->getGlobal('event_list_number')) );

		if($limit==""){

			$limit = $config->getGlobal('event_list_number');

		}

		$limitstart = trim( JRequest::getVar('limitstart', 0 ) );
        
		$pageNav = new DtPagination( $total, $limitstart, $limit  );

	//Get the number of registrants

    $rows = array_splice($rows,$pageNav->limitstart,$pageNav->limit);

	//End the number of registrants

	$link="index.php?option=$option&Itemid=$Itemid";

	$prevCat=NULL;

	$currCat=NULL;

	// Display an event on each row

    $k = 0;

	$prevCat = NUll;

	$parent = $categoryTable;
    
	for($i=0,$n=count($rows);$i<$n;$i++){

		if($k == 0){$bgRow='eventListRow1';}else{$bgRow='eventListRow2';}

		$row=$rows[$i];

		$currCat = $row->category;

		if($currCat!=$prevCat || $currCat==""){

			if (isset($arrCategory[$row->category]) && $arrCategory[$row->category]){

				$parent->categoryName = "";
				
				$parent->load($row->category);
				$parent->categoryName = "";
                $subclass = '';
				if($parent->parent_id > 0){
                    $subclass = 'class="subcategory"';
					$parent->load($parent->parent_id);

					$parent->categoryName .=" >> ";
					
				}

				echo '<tr class="categoryRow"><td colspan="'.$j.'" '. $subclass .' >'.$parent->categoryName.$arrCategory[$row->category].'</td></tr>';

			}

		}

        $this->assign('row',$row);

		$this->assign('bgRow',$bgRow);

		$this->assign('prevCat',$prevCat);

		$this->assign('currCat',$currCat);

		echo  $this->loadTemplate('row');

		$prevCat = $currCat;

		$k = 1-$k;

	} ?>

	<br /><br />

	<?php 

	  $link="index.php?option=".DTR_COM_COMPONENT."&Itemid=$Itemid";

	  echo $pageNav->getPagesLinks($link);

	}else if (!$rows && $search){

		echo "<tr><td colspan='2'>".JText::_( 'DT_NO_SEARCH_RESULTS' )."</td></tr>";

	} else {

		// no events to list

		echo "<tr><td colspan='2'>".JText::_( 'DT_NO_EVENTS' )."</td></tr>";

	} // END -> if($rows)

	?>

   </table> 

   <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT; ?>" />
   <input type="hidden" name="controller" value="event" />
   <input type="hidden" name="task" value="category" />
   <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart; ?>" />

</form>
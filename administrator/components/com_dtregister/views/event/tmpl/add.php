<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

  jimport('joomla.html.pane');

  $pane =& JPane::getInstance('tabs');

  $document	=& JFactory::getDocument();

  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/addmore.js');
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/mousewheel.js');
  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/timeEntry.js');

  if(isset($this->copy)){

    unset($this->row->slabId);

    $this->row->slabId = "" ;

 }
  $timeformatArray = array(1=>'false','2'=>'true');
?>
<script type="text/javascript">
    DTjQuery(function(){
	  DTjQuery(".timeEntry").timeEntry({show24Hours:true,spinnerImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrange.png" ?>',spinnerBigImage:'<?php echo JUri::root()."components/com_dtregister/assets/images/timeEntry/spinnerOrangeBig.png" ?>'});
	  
	   DTjQuery('#dataeventtimeformat').change(function(){
		   var format = DTjQuery(this).val();
		   
		   if(format == 2){
		       DTjQuery(".timeEntry").timeEntry('change','show24Hours',true);
		   }else{
			   DTjQuery(".timeEntry").timeEntry('change','show24Hours',false); 
			   DTjQuery(".timeEntry").timeEntry('change','ampmPrefix',' ');  
		   }
		   
	  });
	  DTjQuery('#dataeventtimeformat').trigger('change');
	})
</script>
<div>
<h3>
  <?php 
  
  echo (isset($this->row->slabId)&& $this->row->slabId !="")?$this->row->displayTitle().' ':''; ?>
</h3>
</div>
 <form name="adminForm" id="newDiscountCode" method="post"  action="index2.php" enctype="multipart/form-data">

   <table>

     <tr><td width="100%">

    <?php	

	        echo $pane->startPane('event');

 			echo $pane->startPanel(JText::_( 'DT_REGISTER_GENERAL' ),'dtregister1');

			echo  $this->loadTemplate('tab.general');

			echo $pane->endPanel();

            echo $pane->startPanel(JText::_( 'DT_DISCOUNT_FEE' ),'dtregister2');

			echo  $this->loadTemplate('tab.discountfee');

			echo $pane->endPanel();

            echo $pane->startPanel(JText::_( 'DT_REGISTER_EMAIL' ),'dtregister4');

			echo  $this->loadTemplate('tab.message');

			echo $pane->endPanel();
			
			echo $pane->startPanel(JText::_( 'DT_EMAILS' ),'dtregister3');
			
			echo  $this->loadTemplate('tab.email');
			
			echo $pane->endPanel();
			
	        echo $pane->startPanel(JText::_( 'DT_REGISTER_FIELDS' ),'dtregister5');

			echo  $this->loadTemplate('tab.field');

			echo $pane->endPanel();

	        echo $pane->startPanel(JText::_( 'DT_USER_PANEL' ),'dtregister6');

			echo  $this->loadTemplate('tab.userpanel');

			echo $pane->endPanel();

	        echo $pane->endPane();

 	  ?>
     
    </td></tr>
   </table>

    <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

    <input type="hidden" name="controller" value="event" />  

    <input type="hidden" name="data[event][slabId]" value="<?php echo $this->row->slabId; ?>" />

    <input type="hidden" name="task" value="" />

 </form>

 <script type="text/javascript" >

 DTjQuery(function(){

    DTjQuery('#dataeventeventId').change(function(){

	   DTjQuery.ajax({

	      url:'index.php?option=com_dtregister&controller=event&format=raw&task=getjevent&eventId='+DTjQuery(this).val(),

		   dataType :'json',

		   success :function(response){

			 DTjQuery("#summary").val(response.summary);

			 var startdate = new Date(response.dtstart*1000);

			 var enddate   = new Date(response.dtend*1000);

			 DTjQuery("#dtstart").val(startdate.print('%Y-%m-%d'));

			 DTjQuery("#dtstarttime").val(startdate.print('%H:%M'));

			 DTjQuery("#dtend").val(enddate.print('%Y-%m-%d'));

			 DTjQuery("#dtendtime").val(enddate.print('%H:%M'));
             DTjQuery(".jeventdisable").attr('disabled','true');
			 if(typeof(response.reprules) != 'undefined'){

			    // data[event][repeatType]

				DTjQuery("input[name='data\\[event\\]\\[repeatType\\]\\[\\]'] ").val(response.reprules.repeatType);
				               DTjQuery("input[name='data\\[event\\]\\[repeatType\\]'][value='"+response.reprules.repeatType+"']").attr('checked',true).trigger('change');

				DTjQuery("#rpinterval").val(response.reprules.rpinterval) ;

				DTjQuery("#rpcount").val(response.reprules.rpcount) ;

				DTjQuery("#rpuntil").val(response.reprules.rpuntil) ;

				var func = 'set'+response.reprules.repeatType ;

				dispatch(func,[response.reprules]);

			 }
             DTjQuery('#dataeventtimeformat').trigger('change');
		  }
          
	   });

	});

 });

function setdaily(rules){

}

function setmonthly(rules){

	DTjQuery("#monthdays").val(rules.monthdays) ;

//	DTjQuery("#monthdays").val(rules.monthdays) ;

	//data[event][monthweekdays][]

	DTjQuery.each(rules.monthweekdays,function(k,v){

		DTjQuery("input[name='data\\[event\\]\\[monthweekdays\\]\\[\\]'][value='"+v+"']").attr('checked',true) ;

	});

	DTjQuery.each(rules.monthweeks,function(k,v){

		DTjQuery("input[name='data\\[event\\]\\[monthweeks\\]\\[\\]'][value='"+v+"']").attr('checked',true) ;

	});	

}

function setweekly(rules){

	DTjQuery.each(rules.weekdays,function(k,v){	

		DTjQuery("input[name='data\\[event\\]\\[weekdays\\]\\[\\]'][value='"+v+"']").attr('checked',true) ;

	});

}

function setyearly(rules){

	DTjQuery("#yeardays").val(rules.yeardays) ;

}

</script>
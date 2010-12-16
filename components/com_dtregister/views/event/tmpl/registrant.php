<?php 

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid , $show_group_members , $cb_integrated , $registrant_name ,$registrant_show_avatar , $button_color ,$registrant_cb_linked , $xhtml ,$cb_integrated ,$registrant_username ,$showlocation ,$googlekey ,$amp,$xhtml_url , $front_link_type,$registrant_message;

$config = $this->getModel('config');
$mfield = $this->getModel('field');
$mfieldtype = $this->getModel('fieldtype');

$fieldtypes = $mfieldtype->getTypes();

$tfield = $mfield->table;

$tfield->pivotFields();
//pr($tfield->attendeelistfields());
$fields = $tfield->arrangeheader($tfield->attendeelistfields());

$this->assign('fields',$fields);

$muser = $this->getModel('user');

$tuser = $muser->table;

$dir = Jrequest::getVar('filter_order_Dir');

$order = Jrequest::getVar('filter_order');

$this->assign('muser',$muser);

$document =& JFactory::getDocument();

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');
$Tevent = $this->getModel('event')->table;
$locationTable = $this->getModel('location')->table;
$Tevent->load(JRequest::getVar('eventId'));
$this->assign('header_eventId',$Tevent->slabId);
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'event'.DS.'tmpl'.DS.'event_header.php');

echo "<p>".stripslashes($registrant_message)."</p>" ;
if($showlocation){
   
   
   
   if($Tevent->location_id){
       
	   $locationTable->load($Tevent->location_id);
	   if($locationTable->name !=""){
		   
		   	   echo "<br />&nbsp;".JText::_( 'DT_LOCATION')  ; ?>:&nbsp;<a class="colorbox" href="<?php echo JRoute::_("index.php?option=com_dtregister&controller=location&task=show&id=".$Tevent->location_id."&tmpl=component",$xhtml_url,false) ?>"   ><?php echo stripslashes($locationTable->name);?></a>
           <?php
	   }
	   
   }
   
}
$document	=& JFactory::getDocument();

 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.lightbox.js');

 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/jquery.lightbox.css');
 
 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/main.css');

 if($config->getGlobal('googlekey','')!==""){

  

   $document->addScript( "http://maps.google.com/maps?file=api".$amp."v=2.x".$amp."key=".$googlekey);



 }

?>
 <script type="text/javascript" >



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

<form name="frmcart" method="post">
 <table border="0" width="100%">

     <tr>

      <td align="left">

      <?php 
	        if($Tevent->check_registerable()){
			    
			   if($front_link_type){
	
				   $register = '<img src="components/com_dtregister/assets/images/'.$button_color.'/register_now_195.png" border="0" alt= " " />';
	               $separater = " ";
	
			   }else{
	
					$register = JText::_( 'DT_REGISTER');
	
			   }
			  $reglink = JRoute::_('index.php?option=com_dtregister&task=register&eventId='.$Tevent->slabId.'&Itemid='.$Itemid);
			   echo "<a href='$reglink'>".$register."</a>";
			   	 
			}//echo DTreg::register_link($eventId);
	  ?>

      </td>

        <td align="right">

          <input type="text" name="search" value="<?php echo JRequest::getVar( 'search' ,'' ); ?>" />&nbsp;&nbsp;

          <input type="submit" name="search_submit" value="<?php echo  JText::_( 'DT_SEARCH'); ?>" />

          
        </td>

    </tr>

    </table>

    <br />
<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform adminlist">

  <tr>

         <?php

        if($show_group_members == 1){

		?>

        	<th class="attendee_coltitle">&nbsp;</th>

        <?php

		}

	  ?>

      <?php

		if($cb_integrated > 0 && $registrant_show_avatar ==1){

		?>

        	<th class="attendee_coltitle">

        	 <?php echo JText::_( 'DT_AVATAR')?>

        	</th>

        <?php

		}?>

      <?php

       foreach($fields as $field){

		?>

           <th class="attendee_coltitle">

                <?php 

				echo DtHtml::sort($field->label, $field->name, $dir,$order,'registrant'); ?>

		</th>

        <?php

		if(trim($field->name) == 'name' && $registrant_username == 1 && $cb_integrated > 0){

		?>

           <th class="attendee_coltitle">

		     <?php  echo DtHtml::sort(JText::_( 'DT_USERNAME'), 'username', $dir,$order,'registrant');  ?>

           </th>

		<?php

		}

	   }

	   ?>

  </tr>

  <?php

  $rowhtml = "" ;

  $k = 0;

   $profile = $tuser->TableJUser;

   foreach($this->users as $user){

	  
     $tuser->load($user->userId);
	 
	  $rowhtml .="<tr class='eventListRow".($k+1) ." user".$user->id."'>";

	  if( $show_group_members == 1 ){

		  if($user->type=="G" && count($tuser->members)){

		       $class_show_member = " userpar ";

				$rowhtml .= '<td class="'.$class_show_member.'"><img src="'.JURI::root(true).'/components/com_dtregister/assets/images/'.$button_color.'/expand.png" border="0" alt= " "/></td>';

		  }else{

		     $rowhtml .= '<td >&nbsp;</td>';

		  }

	  }

	  $this->assign('user',$user);
      $this->assign('tuser',$tuser);
 
	  $rowhtml .= $this->loadtemplate("avatar");

	   foreach($fields  as $field){

		   $this->assign('field',$field);

		   if($field->name == 'name'){

		      $html  = $this->loadTemplate('name');  

			  $rowhtml .= $html;

		   }else{
			  $fieldClass = 'Field_'.$fieldtypes[$field->type];
			  
			  $fieldTable = new $fieldClass();
			  $fieldTable->load($field->id);

			  $rowhtml .='<td>'.$fieldTable->viewHtml((array)$tuser).'</td>';

		   }

	   }

	  $rowhtml .= '</tr>';

	  $html  = $this->loadTemplate('members');  

	  $rowhtml .= $html;

	   $k = 1 - $k;

   }

   echo $rowhtml;

  ?>
<tr>
  <td>
  <?php echo $this->pageNav->getListFooter() ;?>
  </td>
</tr>

</table>

<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

<input type="hidden" name="controller" value="event" />

<input type="hidden" name="task" value="registrant" />

<input type="hidden" name="Itemid" value="<?php echo $Itemid ; ?>" />

<input type="hidden" name="limitstart" value="" />

<input type="hidden" name="filter_order" value="<?php echo Jrequest::getVar('filter_order','name');?>" />

<input type="hidden" name="filter_order_Dir" value="<?php echo Jrequest::getVar('filter_order_Dir','asc');?>" />

</form>

<script type="text/javascript">

 //<![CDATA[

  function tableOrdering( order, dir, task ) {

	var form = document.frmcart;

	form.filter_order.value 	= order;

	form.filter_order_Dir.value	= dir;

	submitform( task );

}

function submitform(pressbutton){

	if (pressbutton) {

		document.frmcart.task.value=pressbutton;

	}

	if (typeof document.frmcart.onsubmit == "function") {

		document.frmcart.onsubmit();

	}

	document.frmcart.submit();

}

//]]>

</script>


 <script type="text/javascript">

     //<![CDATA[

	//jQuery.noConflict();

	DTjQuery(function(){

	  	DTjQuery('.detail').hide();

		DTjQuery('.userpar').click(function(){

			var path = new String(DTjQuery(this).children(':first').attr('src')) ; 

			if(path.match("expand") != null){

				DTjQuery(this).children(':first').attr('src',path.replace("expand","close"));

			}else{

				DTjQuery(this).children(':first').attr('src',path.replace("close","expand"));

			}

			cssdisplay = DTjQuery(this).parent().next().css('display');

			if(cssdisplay == null || (typeof(cssdisplay)!= undefined) && (cssdisplay.match("table-row") !=null || cssdisplay.match("block") !=null)){

			   DTjQuery(this).parent().next().css('display','none');

			}else{

			   DTjQuery(this).parent().next().css('display','table-row');

			}

		})

	})

     //]]>

	</script>
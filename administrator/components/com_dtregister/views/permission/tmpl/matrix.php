<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

  $acoObj = $this->getModel('aco');

  $aroObj = $this->getModel('aro');

  $aros = $aroObj->find();

  $acos = $acoObj->AcoGroup;

?>

<form action="index.php" method="post" name="adminForm" id="adminForm">

<table>
 <tr>
   <td colspan="5">
	 <div class="textbutton">
     <a class="colorbox" href="index.php?option=com_dtregister&controller=aro&task=add&tmpl=component"><?php echo JText::_('DT_ADD_USER')?></a>
     </div>
   </td>
 </tr>
 <tr>

   <th class="dt_heading">

      <?php echo JText::_("DT_ACO"); ?>

   </th>

   <?php

   foreach($acos as $name=>$aco){

    ?>

	  <th class="dt_heading_small">

       <?php echo JText::_($name);?>

      </th>

   <?php

   }

   ?>

 </tr>

 <?php

  foreach($aros as $aro){

    ?>

     <tr>

	   <td>
 
       <?php 
	        if($aro->type=="joomlaUser"){
			   ?>
			   <a class="arodelete" href="<?php echo JRoute::_("index.php?option=com_dtregister&controller=aro&task=delete&cid[]=".$aro->id)?>"><img src="components/com_dtregister/assets/images/delete.jpg" style="height:16px; width:16px; border:0px"></a>&nbsp;	
               <?php
			}
	        echo JText::_($aro->alias);
	    ?>

      </td>

        <?php

	   foreach($acos as $name=>$aco){

		   if(isset($this->matrix[$aro->id]) && isset($this->matrix[$aro->id][$name])){

				$checked = "checked";

		   }else{

			  $checked = "";   

		   }

		?>

		  <td align="center" style="border: 1px solid #efefef;">

		    <input type="checkbox" value="1" name="data[permission][<?php echo $aro->id; ?>][<?php echo $name; ?>]" <?php echo $checked; ?> />

		  </td>

	   <?php 

	   }

       ?>

     </tr>

   <?php

  }

 ?>

</table>

 <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

 <input type="hidden" name="controller" value="permission" />

 <input type="hidden" name="task" value="update" />

</form>
<?php

$document	=& JFactory::getDocument();

$document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery-ui.js');

?>

<script type="text/javascript" />
   DTjQuery(function(){
	   
	   DTjQuery(".colorbox").live('click',function(e){

					 e.preventDefault();

					 var horizontalPadding = 10;

		var verticalPadding = 10;

		DTjQuery('<iframe id="externalSite" class="externalSite" src="'+DTjQuery(this).attr('href')+'" />').dialog({

			title:  '<?php echo JText::_('DT_ADD_USER')?>',

			autoOpen: true,

			width:  325,

			height: 270,

			modal: true,

			resizable: true,

		//	autoResize: true,

			overlay: {

				opacity: 0.5,

				background: "black"

			}

		});

			     });
	      
   })
  
</script>
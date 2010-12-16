<?php

global $Itemid , $xhtml ;



$mfield = $this->getModel('field');

$tfield = $mfield->table ;

$fieldtype = $this->getModel('fieldtype');

$fieldtypes = $fieldtype->getTypes();
$fields = $tfield->memberlistfields();
include(JPATH_SITE.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'user'.DS.'tmpl'.DS.'event_header.php');
?>

<form action="index.php" name="frmcart" method="post" >

<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform adminlist">

 <tr>

       <td colspan="5">

          

          <a href="<?php echo JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&controller=user&task=edit&userId='.$this->userId,$xhtml ); ?>"><?php echo JText::_( 'DT_EDIT_BILLINGINFO') ?></a>

          

          &nbsp;|&nbsp;<a href="<?php echo JRoute::_('index.php?option=com_dtregister&controller=member&Itemid='.$Itemid.'&task=add&userId='.$this->userId,$xhtml) ; ?>"><?php echo JText::_( 'DT_ADDMEMBER') ?></a>

       </td>

     </tr> 

   <tr>



        <th width="20">&nbsp;



				



		</th>

       <?php

       foreach($fields as $field){

		?>

           <th width="20">



				<?php echo $field->label;?>



		</th>

        <?php

	   }

	   ?>

       <th><?php echo JText::_( 'DT_REMOVE') ?></th>

    </tr>

<?php

  $k=0;

  $i=0 ;

   $link = JHTML::_('image.administrator', '/administrator/images/publish_x.png', null,null,null ,JText::_( 'DT_CANCEL'));

 foreach($this->members as $key => $member){

?>

<tr class="<?php echo "row$k"; ?>">

   

    <td>		<?php

                  

				 echo  JHtml::link("index.php?option=com_dtregister&task=edit&controller=member&key=".$key."&groupMemberId=".$member['groupMemberId']."&Itemid=".$Itemid,'<img border="0"  src="'.JURI::root(true).'/images/M_images/edit.png" alt="'.JText::_( 'DT_EDIT').'" />');

				  

				  ?>



	</td>

    

     <?php

       foreach($fields as $field){

		?>

           <td width="20">



				<?php
				 
				  $classname = "Field_".$fieldtypes[$field->type];
				  $ObjField = new $classname();
				  $ObjField->load($field->id);
				  $ObjField->viewHtml($member) ;
				  if(isset($member['fields'][$field->id])){
					  $function = 'viewHtml';
					  if(is_callable(array($ObjField,'exportView'))){
						  $function = 'exportView';
					  }
					  echo $ObjField->$function($member);
					  ///echo $member['fields'][$field->id]." ".$classname;
				  }else{
					  echo '';
				   }
				 ?>



		</td>

        <?php

	   }

	   ?>

       <td><a href="<?php echo JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&task=remove&controller=member&key='.$key,$xhtml) ?> " ><?php echo $link ?></a></td>

   

</tr>

<?php	 

 $k = 1 - $k;

 $i++ ;

  }    

?>



</table>

<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT; ?>" />

<input type="hidden" name="userId" value="<?php echo $this->userId;?>" />

<input type="hidden" name="controller" value="member" />

<input type="hidden" name="task" value="index" />



<input type="hidden" name="filter_order" value="<?php echo Jrequest::getVar('filter_order'); ?>" />



<input type="hidden" name="filter_order_Dir" value="<?php echo Jrequest::getVar('filter_order_Dir');?>" />



<input type="hidden" name="boxchecked" value="0" />



</form>
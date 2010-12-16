<?php
global $Itemid , $xhtml ;

$mfield = $this->getModel('field');
$tfield = $mfield->table ;

$fields = $tfield->memberlistfields();
$fieldtype = $this->getModel('fieldtype');

$fieldtypes = $fieldtype->getTypes();
?>
<form action="index2.php" name="adminForm" method="post" >
<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform adminlist">
   <tr>

        <th width="20">

				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->members ); ?>);" />

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
    </tr>
<?php
  $k=0;
  $i=0 ;
 foreach($this->members as $member){
?>
<tr class="<?php echo "row$k"; ?>">
   
    <td>		<?php
                  echo $checked  = JHTML::_('grid.id', $i,$member->groupMemberId);	 ?>

	</td>
    
     <?php
       foreach($fields as $field){
		?>
           <td width="20">

				<?php
				  $classname = "Field_".$fieldtypes[$field->type];
				  $ObjField = new $classname();
				  $ObjField->load($field->id);
				  if(isset($member->fields[$field->id])){
					  $function = 'viewHtml';
					  if(is_callable(array($ObjField,'exportView'))){
						  $function = 'exportView';
					  }
					  echo $ObjField->$function((array)$member);
					  ///echo $member['fields'][$field->id]." ".$classname;
				  }else{
					  echo '';
				   }
				 
				 ?>

		</td>
        <?php
	   }
	   ?>
   
</tr>
<?php	 
 $k = 1 - $k;
 $i++ ;
  }    
?>
</table>
<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />
<input type="hidden" name="userId" value="<?php echo $this->userId;?>" />
<input type="hidden" name="controller" value="member" />
<input type="hidden" name="task" value="index" />

<input type="hidden" name="filter_order" value="<?php echo Jrequest::getVar('filter_order');?>" />

<input type="hidden" name="filter_order_Dir" value="<?php echo Jrequest::getVar('filter_order_Dir');?>" />

<input type="hidden" name="boxchecked" value="0" />

</form>
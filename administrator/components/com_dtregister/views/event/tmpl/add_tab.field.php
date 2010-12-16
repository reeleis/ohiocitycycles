 <?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

 $fieldObj = $this->getModel('field')->table;
 $rowFields = $fieldObj->find('published=1  and parent_id=0 ','ordering');
 $fields = $this->row->field;
 
 ?>

 <table class="adminlist" width="100%" cellpadding="10" cellspacing="10">

      <?php

      	if(count($rowFields)>0)

      	{

      	?>

      		<tr>

		      <th colspan="4"><?php echo JText::_( 'DT_FIELD_SELECTION_INSTRUCTIONS' ); ?></th>

		      </tr>

<tr>

          <th class="dt_heading"><?php echo JText::_( 'DT_CUSTOM_FIELD_NAME' ); ?></th>

		  <th class="dt_heading"><?php echo JText::_( 'DT_CUSTOM_FIELD_USED' ); ?></th>

          <th class="dt_heading"><?php echo JText::_( 'DT_REQUIRED' ); ?></th>

          <th class="dt_heading"><?php echo JText::_( 'DT_CUSTOM_FIELD_GROUPOPTIONS' ); ?></th>

</tr>

		      <?php

		      	for($i=0,$n=count($rowFields);$i<$n;$i++)

		      	{

		      		$rowField=$rowFields[$i];

                     $showed = -1;

					 $required = 0;

					 $group = 1;
				
                     if(isset($fields[$rowField->id])){

				        $showed = $fields[$rowField->id]->showed ;

						$required = $fields[$rowField->id]->required ;

						$group = $fields[$rowField->id]->group_behave ;

				     }

		      		$name=$rowField->name;

		      	?>

		      		<tr>

		      			<td><?php	echo $rowField->name; ?></td>

		      			<td><?php	
						    $options=array();

						    $options[]=JHTML::_('select.option',"0",JText::_( 'DT_NONE' ));

						    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_INDIVIDUAL' ));
							
							 $options[]=JHTML::_('select.option',"2",JText::_( 'DT_GROUP' ));
                             $options[]=JHTML::_('select.option',"3",JText::_( 'DT_BOTH' ));
						    $options[]=JHTML::_('select.option',"-1",JText::_( 'DT_DEFAULT'));
						 echo JHTML::_('select.radiolist', $options, "data[field][".$rowField->id."][showed]",' class="fields" ','value','text',$showed);
						
						?></td>

                        <td><?php  echo JHTMLSelect::booleanlist("data[field][".$rowField->id."][required]","",$required); ?></td>

                <td>

		      		  <?php

					 		  $options=array();

						    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_EACH_MEMBER' ));

						    $options[]=JHTML::_('select.option',"2",JText::_( 'DT_BILLING_ONLY' ));

						    $options[]=JHTML::_('select.option',"3",JText::_( 'DT_MEMBERS_BILLING'));

							

							  echo JHTML::_('select.radiolist', $options, 'data[field]['.$rowField->id.'][group_behave]','','value','text',$group);

							  ?>

		      			</td>

		      		</tr>

		      	<?php	} ?>

      	<?php

      	}

	?>

     </table>
     <script type="text/javascript">
	  DTjQuery(function(){
	   	 DTjQuery('.fields').click(function (){
						
						   var fieldname = DTjQuery(this).attr('name').replace('[showed]','');
						   
						   if(DTjQuery(this).val()== -1){
							  
							 DTjQuery("input[name^='"+fieldname+"\\[required\\]']").attr('disabled',true)
						
							 DTjQuery("input[name^='"+fieldname+"\\[group_behave\\]']").attr('disabled',true)
						
						   }else{
							  DTjQuery("input[name^='"+fieldname+"\\[required\\]']").removeAttr('disabled');
						
						      DTjQuery("input[name^='"+fieldname+"\\[group_behave\\]']").removeAttr('disabled');
						   }
						  
		  });
	      DTjQuery('.fields').each(function(){
						    
							if(this.checked){
							    DTjQuery(this).trigger('click');
							}
							
		});
	})
</script>
<?php

global $Itemid , $xhtml ;

$rows = $this->rows ;

$pageNav = $this->pageNav ;

$search = $this->search ;

$order  = Jrequest::getVar('filter_order') ;

$dir  = Jrequest::getVar('filter_order_Dir') ;

$paymthd  = $this->getModel('Paymentmethod');
$pMethods = $paymthd->getMergeList(true);
// echo "<pre>"; print_r($pMethods); echo "</pre>";

?>

<form action="index2.php" method="post" name="adminForm">

<?php

echo $this->loadTemplate('description');



?>

<table class="adminlist">

  <tr>



			<th width="5">#</th>



			<th width="20">



				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />



			</th>



			<th>

			<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_ADMIN_REGISTRANT_NAME' ), 'name', $dir, $order); ?>

			</th>



			<th>     <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_EMAIL' ), 'email', $dir, $order); ?>

            </th>



			<th>

			  <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_EVENT' ), 'event', $dir, $order); ?>

			</th>



			<th>

            <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_AMOUNT' ), 'amount', $dir, $order); ?>

            </th>



			<th>

			<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_REGISTER_DATE' ), 'date', $dir, $order); ?>

		</th>



      <th>

	     <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_CONFIRMATION_NUMBER' ), 'confirmNum', $dir, $order); ?>

	  </th>



      <th>

	    <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_DISCOUNT_CODE' ), 'discount_code', $dir, $order); ?>

	 </th>



      <th>

	    <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_PAYMENT_TYPE' ), 'type', $dir, $order); ?>

	</th>



			<th>

			<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_PAY_LATER_PAID' ), 'paid', $dir, $order); ?>

			</th>



			<th>

			<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_ATTENDED' ), 'attend', $dir, $order); ?>

			</th>



			<th>

			<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_MEMBERS' ), 'members', $dir, $order); ?>

			</th>



        <th>

		<?php echo JHTML::_( 'grid.sort', JText::_( 'DT_DUE_AMOUNT' ), 'due_amount', $dir, $order); ?>

		</th>

        

         <th>

		 <?php echo JHTML::_( 'grid.sort', JText::_( 'DT_STATUS' ), 'status', $dir, $order); ?>

		</th>



		</tr>

        <?php

		$k = 0;

		$i = 0 ;

		

		$fieldNameMap = $this->mUser->table->TableUserfield->Tablefield->mapNametoId();
		
        if($this->rows)
		foreach($this->rows as $row){
             $fee = $this->mUser->table->TableFee->findByUserId($row->userId);
			 
			$name = array();

			$link = 'index2.php?option=com_dtregister&task=edit&controller=user&cid[]='. $row->userId;

			

			$field_values = $this->mUser->table->TableUserfield->findByUserId($row->userId) ;

			$name = array();
            if(isset($field_values[$fieldNameMap['firstname']])){
			 $name[] = $field_values[$fieldNameMap['firstname']];
			}
            if(isset($field_values[$fieldNameMap['lastname']])){
			   $name[] = $field_values[$fieldNameMap['lastname']];
			}
			$name = implode(" ",array_filter($name));
			$email = "";
			if(isset($field_values[$fieldNameMap['email']])){
			$email = $field_values[$fieldNameMap['email']];
			}

		    

		 ?>

         <tr class="<?php echo "row$k"; ?>" >

           <td><?php echo $pageNav->getRowOffset( $i ); ?></td>

           <td><?php echo  $checked    = JHTML::_('grid.id', $i, $row->userId); ?></td>

           <td align="center"><a href="<?php echo $link?>"><?php  echo $name; ?></a></td>

           <td align="center"><a href="mailto:<?php echo stripslashes($email);?>"><?php echo stripslashes($email);?></a></td>

           <td align="center"><?php 
		    $evtTable =  $this->getModel('event')->table ;
			$evtTable->slabId = $row->slabId ;
			$evtTable->dtstart = $row->dtstart ;
			$evtTable->title = $row->title ;
		    echo $evtTable->displayTitle() ; ?> </td>

           <td align="center"><?php echo DTreg::numberFormat($row->fee,2);?></td>

           <td align="center"><?php echo $row->register_date;?></td>

           <td align="center"><?php echo $row->confirmNum; ?></td>

           <td align="center"><?php echo isset($row->code)?$row->code:'';?></td>

           <td align="center">
				<?php // echo (isset($fee->payment_method) && isset($pMethods[$fee->payment_method]))?$pMethods[$fee->payment_method]:isset($fee->payment_method)?$fee->payment_method:'' ;
				if ( (isset($fee) && $fee != "") && isset($pMethods[$fee->payment_method]) ) echo $pMethods[$fee->payment_method]; 
				else if (isset($fee->payment_method)) echo $fee->payment_method;
				//echo '<pre>fghfgh '; if(isset($fee)) print_r($fee); echo ' asdasd</pre>';
				?>
           </td>

           <td align="center"><?php echo  DtHtml::gridTask($row, $i,'fee_status'); ?></td>

           <td><?php echo  DtHtml::gridTask($row, $i,'attend'); ?></td>

           <td>	<?php if($row->type=='G'){
			   
			               if(!count($this->mUser->table->TableMember->findByUserId($row->userId))){
							echo $row->memtot." "; echo JText::_('DT_MEMBERS') ;
							   
						   }else{
			   
			    ?>


                    
					<a href="<?php echo $mainframe->getSiteURL();?>administrator/index2.php?option=com_dtregister&controller=member&task=index&userId=<?php echo $row->userId;?>&eventId=<?php echo $row->eventId?>"><?php echo $row->memtot;?> <?php echo JText::_('DT_MEMBERS')?></a>



					<?php } } ?></td>

             <td align="center"><?php 

				  if($row->cancel == 1){

				    echo DTreg::numberFormat($row->due,2) ;

				  }else{

				    echo DTreg::numberFormat(($row->fee-$row->paid_amount),2) ;

				  }

				

				?>

                

                </td>

                 <td align="center"><?php 

				  

				   echo $this->mUser->table->statustxt[$row->user_status];

				  

				?></td>

         </tr>

         <?php

		 $k = 1 - $k ;

		 $i++ ;

		}

		?>

</table>

<?php echo $pageNav->getListFooter(); ?>

<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

<input type="hidden" name="controller" value="user" />

<input type="hidden" name="task" value="index" />



<input type="hidden" name="filter_order" value="<?php echo Jrequest::getVar('filter_order','date');?>" />



<input type="hidden" name="filter_order_Dir" value="<?php echo Jrequest::getVar('filter_order_Dir','desc');?>" />



<input type="hidden" name="boxchecked" value="0" />



</form>

<script type="text/javascript">

  			function submitbutton(pressbutton)



			{



				if(pressbutton=='new' || pressbutton=='group_registration')



				{



					var selectTag=document.adminForm["search[eventId]"];



					if(selectTag.value=="")



					{



						alert('<?php echo JText::_('DT_SELECT_EVENT')?>');



						return;



					}



					else



					{



						submitform(pressbutton);



					}



				}



				else



				{



					submitform(pressbutton);



				}



			}

</script>
<?php 
      $files = $this->row->file ;
	 $files_html = "";
	   foreach($files as $value){

	    $files_html .='<tr>

							<td>'.basename($value->path).'</td>

							<td><a class="remove_file" href="index.php?option=com_dtregister&format=raw&task=remove&controller=file&id='.$value->id.'" >'.JText::_( 'DT_REMOVE' ).'</a></td>

					</tr>';

	   }
echo $files_html ;
	 ?>
	 <script type="text/javascript">
	   DTjQuery(function(){
	       DTjQuery(".remove_file").click(function(event){

					      event.preventDefault();

						    element = this;

						    DTjQuery.get(DTjQuery(this).attr('href'), function(data){

								DTjQuery(element).parent().parent().remove();

						});

						return false ;

					});

	   });
	 </script>
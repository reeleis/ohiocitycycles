<?php
global $Itemid ;

?>
<form name="adminForm" method="post" action="index.php" enctype="multipart/form-data">
  
  <table>
 <tr >

		<td colspan="3" align="left" ><strong>Member <?php echo $this->currentMember; ?> Information</strong></td>

		</tr>
 <?php
       echo  $this->form ;
	  
	 ?>
  
  </table>
   <input type="hidden" name="option" value="com_dtregister" />
   <input type="hidden" name="controller" value="user" />
   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
   <input type="hidden" name="task" value="member" />
   <input type="hidden" name="formsubmit" value="1" />
</form>
<div id="debug">
</div>
<script type="text/javascript">
 
 
 DTjQuery(function(){
   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.adminForm).validate({
	        success: function(label) {
				label.addClass("success");
			}

	});
	
	
 })
 
 function submitbutton(pressbutton){
    
	if(DTjQuery(document.adminForm).valid()){
	  	submitform(pressbutton);
	}
	
	return false ;

}

</script>
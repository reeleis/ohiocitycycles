<?php
global $Itemid ;

?>
<form name="adminForm" method="post" action="index.php" enctype="multipart/form-data">
   <table>
      <tr>
         <td>
           <?php echo JText::_( 'DT_REGISTRANTS'); ?>
         </td>
         <td>
           <input type="text" name="memtot" value="" class="inputbox required" />
                    
         </td>
      </tr>
  
   </table>
   <input type="hidden" name="option" value="com_dtregister" />
   <input type="hidden" name="controller" value="user" />
   <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
   <input type="hidden" name="task" value="memtotform" />
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
    submitform(pressbutton);
	if(DTjQuery(document.adminForm).valid()){
	  	submitform(pressbutton);
	}
	
	return false ;

}

</script>
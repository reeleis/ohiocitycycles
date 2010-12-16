<?php

echo $this->message;

?>
<form name="adminForm" action="index.php" />
  <table>
    <tr>
       <td><input type="button" class="confirm" name='confirm' value="Confirm" /> </td><td><input type="button" class="cancel" name='cancel' value="Cancel" /></td>
    </tr>
  </table>
  <input name="controller" value="eventmanage"  type="hidden"/>
  <input name="option" value="com_dtregister"  type="hidden"/>
  <input name="task" value=""  type="hidden"/>
</form>
<script type="text/javascript">
  DTjQuery('.confirm').click(function(){
	   submitbutton('editconfirm');
  });
   DTjQuery('.cancel').click(function(){
	   submitbutton('editcancel');
  });
</script>
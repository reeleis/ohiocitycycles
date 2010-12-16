<?php

  $jusertable = $this->tAro->TableJuser ;

?>

<form action="index.php" method="post" name="adminForm" id="adminForm">

  <table>

     <tr><td><?php echo JText::_( 'DT_USERID' ); ?>:</td><td><?php  echo JHTML::_('select.genericlist', DtHtml::options($jusertable->optionslist(),JText::_("DT_SELECT_USER")),'Aro[aro_id]',' ','value','text')?></td><td>&nbsp;</td></tr>

     <tr>

       <td>

         <input type="submit" value="Add" name="formsubmit" />

       </td>

     </tr>

  </table>

  <input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

    

 <input type="hidden" name="controller" value="aro" />



 <input type="hidden" name="task" value="add" />

</form>
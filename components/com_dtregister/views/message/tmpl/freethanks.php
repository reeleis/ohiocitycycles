<?php
global $Itemid ;
if($this->messages){
  
   foreach($this->messages as $message){
	   echo "<br />".$message ;
   }	
}
$continue = JRoute::_('index.php?option=com_dtregister&controller=event&cart=continue&Itemid='.$Itemid);
?>
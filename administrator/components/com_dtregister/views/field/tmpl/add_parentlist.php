<?php



   $list = $this->row->optionslist(' type = 1 or type=4 or type =3 ');

 

   $options=DtHtml::options($list,JText::_('DT_SELECT_FIELD'));

   echo JHTML::_('select.genericlist',$options,"parent_id",'','value','text',$this->row->parent_id);

?>
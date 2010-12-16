<?php
$row =  $this->getModel('field')->table ;
$cid = JRequest::getVar( 'cid', array(0), 'request', 'array' );
$id =   JRequest::getVar('id');
$row->load($id);
$list = explode('|',$row->values);

echo DtHtml::checkboxList('selection_values',$list,array(),'<br />');
?>

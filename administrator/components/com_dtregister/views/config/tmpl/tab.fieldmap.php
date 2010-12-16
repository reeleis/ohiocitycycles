<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

  $model = $this->getModel('cbprofiler');

  $options = array();

  $dfields = $model->getFields();

  $mfield = $this->getModel('field');

  $tfield = $mfield->table;

  $tfield->displayField = "name";

  $options = DtHtml::options($tfield->optionslist(' `type` <> 6 and `type` <> 7 ',' name '),JText::_('DT_SELECT_FIELD'));

  $html = "";

  $map_values = $config->getGlobal('map_cb_fields',array());
  
  $map_values = array_flip($map_values);  

  foreach($dfields as $field){
     
	 if(in_array($field->name, $model->notfields)){
	    	
			continue;
	 }
	 
	 $value = isset($map_values[$field->fieldid])?$map_values[$field->fieldid]:'';

	 $html .= '<tr><td>'.$field->name.'</td><td>'.JHTML::_('select.genericlist',  $options,"config[map_cb_fields][".$field->fieldid."]","","value","text",$value).'</td></tr>';

  }

  $JomModel = $this->getModel('jomsocial');

  $dfields = $JomModel->getFields();
  
  $map_jom_values = $config->getGlobal('map_jomsocial_fields',array());

  $map_jom_values = array_flip($map_jom_values);
 
  $jomHtml = "";

  foreach($dfields as $field){

	 $value = isset($map_jom_values[$field->id])?$map_jom_values[$field->id]:'';

	 $jomHtml .= '<tr><td>'.$field->name.'</td><td>'.JHTML::_('select.genericlist', $options,"config[map_jomsocial_fields][".$field->id."]","","value","text",$value).'</td></tr>';   

  }

?>

 <table style="width:700px">
    <tr>
       <td>

         <?php echo JText::_( 'DT_FIELDMAP_INSTRUCTIONS' ); ?>

       </td>
   </tr>
</table>
<table class="adminform" style="width:700px">
  <tr>
     <td>
        <table>
           <tr>
              <td class="dt_heading">
               <strong><?php echo JText::_('DT_COMMUNITY_BUILDER');?></strong>
              </td>
           </tr>
           <tr>
             <td>
                 <table>

                      <?php echo $html; ?>

                 </table>
             </td>
           </tr>
        </table>
     </td>
     <td width="40">&nbsp;</td>
     <td valign="top">
         <table>
           <tr>
              <td class="dt_heading">
                <strong><?php echo JText::_('DT_JOMSOCIAL');?></strong>
              </td>
           </tr>
           <tr>
             <td>
                 <table>

                      <?php echo $jomHtml; ?>

                 </table>
             </td>
           </tr>
        </table>
     </td>
  </tr>
</table>
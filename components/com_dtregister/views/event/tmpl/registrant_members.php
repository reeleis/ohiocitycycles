<?php
global $Itemid , $show_group_members , $cb_integrated , $registrant_name ,$registrant_show_avatar , $button_color ,$registrant_cb_linked , $xhtml, $cb_integrated ,$registrant_name ,$registrant_username;
$user = $this->user ;
$muser = $this->muser;
$tuser = $muser->table ;
$profile = $tuser->TableJUser ;
$mfieldtype = $this->getModel('fieldtype');

$fieldtypes = $mfieldtype->getTypes();
$tuser->load($user->userId);
$html = "" ;
if($show_group_members == 1){
     $html ='<tr class="detail member'.$user->userId.'"><td colspan="9"><table border="0" cellpadding=1 cellspacing=1 width="100%">';
	  $html = ""; 
   if(count($tuser->members)){
	   
	   foreach($tuser->members as $member){
		   
		   $username = '';
		   $username = $tuser->TableJUser->username;
		  
		  $html .= "<tr class='child detail' id='".$user->userId."'>";

		  $html .="<td>&nbsp;</td><td>&nbsp;</td>";
		  
		  foreach($this->fields as $field){
			  
			  if($field->name == 'name'){
		      $html .="<td>";
		  
		    switch($registrant_name){

				case 1:

					$html .= $member->firstname;

				break;

				case 2:

					$html .=$member->lastname;

				break;

				case 3:

					$html .=$member->firstname.' '.$member->lastname;

				break;
				default:
				  $html .=$member->firstname.' '.$member->lastname;
				

			 }

			$html .= "</td><td>&nbsp;</td>";
			
		   }else{
			   
			   
			   if (isset($member->{$field->name}) && $member->{$field->name} != '') {
				   
			
				
					$fieldClass = 'Field_'.$fieldtypes[$field->type];
			  
			  $fieldTable = new $fieldClass();
			  $fieldTable->load($field->id);
			  $function = 'viewHtml';
			  if(is_callable(array($fieldTable,'exportView'))){
				  $function = 'exportView' ;
			  }
					//$html .='<td colspan=4></td>';
					$html .='<td>'.$fieldTable->$function((array)$member).'</td>';	
					//$html .='<td colspan=2></td>';
					
			   
			   }else{
				   $html .='<td>&nbsp;</td>';
			   }
			   
			   // if (isset($member->{$field->name}) && $member->{$field->name} != '')
			   // $html .='<td>'.$member->{$field->name}.'</td>';
		   }
			  
			    
		  }
		   
	   }
	   
   }	
	//$html .="</table></td></tr>";
	
}
echo $html ;
?>
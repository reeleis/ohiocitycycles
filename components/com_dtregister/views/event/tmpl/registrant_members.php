<?php
global $Itemid , $show_group_members , $cb_integrated , $registrant_name ,$registrant_show_avatar , $button_color ,$registrant_cb_linked , $xhtml, $cb_integrated ,$registrant_name ,$registrant_username;
$user = $this->user ;
$muser = $this->muser;
$tuser = $muser->table ;
$profile = $tuser->TableJUser ;

$tuser->load($user->userId);
$html = "" ;
if($show_group_members == 1){
     $html ='<tr class="detail member'.$user->userId.'"><td colspan="9"><table border="0">';
   if(count($tuser->members)){
	   
	   foreach($tuser->members as $member){
		  $html .= "<tr>";

		  $html .="<td width='100px;'>&nbsp;</td>";
		  
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

			 }

			$html .= "</td>";
			
		   }else{
			   $html .='<td>'.$member->{$field->name}.'</td>';
		   }
			  
			    
		  }
		 
		   
	   }
	   
   }	
	$html .="</table></td></tr>";
}
echo $html ;
?>
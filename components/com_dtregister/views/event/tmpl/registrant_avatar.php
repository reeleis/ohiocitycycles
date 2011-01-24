<?php
global $Itemid , $show_group_members , $cb_integrated , $registrant_name ,$registrant_show_avatar , $button_color ,$registrant_cb_linked , $xhtml, $cb_integrated ,$registrant_username,$xhtml_url;
$user = $this->user ;
$muser = $this->muser;
$tuser = $muser->table ;
$profile = $tuser->TableJUser ;
$html = "";

 if($cb_integrated >0  && $registrant_show_avatar == 1){

	$html = "<td>";	  
		  if($user->user_id > 0){
			 
			 $profile->getProfile($user->user_id);
			 
			 
			 if($profile->profile->User->avatar !=""){
				 if($registrant_cb_linked == 1){
                           if($cb_integrated==2){
							   $html .= '<a  href="'.JRoute::_('index.php?option=com_community&view=profile&userid='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_community'),$xhtml_url).'">';
							}else{
							  
							   $html .= '<a  href="'. JRoute::_('index.php?option=com_comprofiler&task=userProfile&user='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_comprofiler'),$xhtml_url).'">';
							}
							
				  }
										   
				  $html .= '<img src="'.JRoute::_('index.php?option=com_dtregister&controller=file&task=thumb&filename='.$profile->profile->User->avatar,$xhtml_url).'" border="0" alt= " " />';
						
				  if($registrant_cb_linked == 1){

					 $html .= '</a>';

				  }
				  
			 }else{
				  $html .='&nbsp;';
			 }
		     
		  }else{
			  $html .='&nbsp;';
		  }
		  $html .='</td>';
	  }
	  
	  echo $html ;
?>
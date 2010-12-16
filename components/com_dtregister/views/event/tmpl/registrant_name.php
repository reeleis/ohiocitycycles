<?php
global $Itemid , $show_group_members , $cb_integrated , $registrant_name ,$registrant_show_avatar , $button_color ,$registrant_cb_linked , $xhtml, $cb_integrated ,$registrant_name ,$registrant_username,$xhtml_url;
$user = $this->user ;
$muser = $this->muser;
$tuser = $this->tuser ;
$profile = $tuser->TableJUser ;

$mfield = $this->getModel('field')->table;
$firstname = $mfield->fingbyName('firstname');
$lastname = $mfield->fingbyName('lastname');
$html = "<td>";

			if($registrant_cb_linked == 1 && $tuser->user_id > 0){
                if($cb_integrated==2){
				  
				   $html .= '<a  href="'.JRoute::_('index.php?option=com_community&view=profile&userid='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_community'),$xhtml_url).'">';
				}else{
				   $html .= '<a  href="'.JRoute::_('index.php?option=com_comprofiler&task=userProfile&user='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_comprofiler'),$xhtml_url).'">';
				}
				
			}

			//switch($registrant_name){

				//case 1:

					$html .= $tuser->fields[$firstname->id];

				//break;

			//	case 2:

				$html .= " ".$tuser->fields[$lastname->id];

			//	break;

			//	case 3:

			//	$html .= $profile->username;

			//	break;

			//}

		if($registrant_cb_linked == 1 && $user->user_id > 0){

				$html .= '</a>';

		}

		$html .= "</td>";
		
if($registrant_username ==1 && $cb_integrated >0 ){

			$html .='<td>';

			if($registrant_cb_linked == 1 && $user->user_id > 0){
                
				 if($cb_integrated==2){
				   $html .= '<a  href="'.JRoute::_('index.php?option=com_community&view=profile&userid='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_community'),$xhtml_url).'">';
				}else{
				   $html .= '<a  href="'.JRoute::_('index.php?option=com_comprofiler&task=userProfile&user='.$user->user_id.'&Itemid='.DTreg::getcomItemId('com_comprofiler'),$xhtml_url).'">';
				}
				
			}

		

			if($user->user_id  > 0){

				$html .= $profile->username;

			}else{

				$html .= '&nbsp;';

			}

			if($registrant_cb_linked == 1 && $user->user_id > 0){

				$html .= '</a>';

			}

			$html .='</td>';

		}
		
	echo $html ;


?>
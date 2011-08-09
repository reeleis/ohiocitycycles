<?php
global $cb_integrated ,$show_moderator , $link_moderator_profile , $xhtml_url ;

$row = $this->row ;
$muser = $this->getModel( 'user' );

$tuser = $muser->table ;
$link = "";

$link = "";
if($show_moderator != '0' && $row->user_id ){
	$profile = $tuser->TableJUser ;
     $profile->load($row->user_id);
   	if($cb_integrated && $link_moderator_profile){
	      $profile->getProfile($row->user_id);	  
		  $hrefarr = array(2=>JRoute::_('index.php?option=com_community&view=profile&userid='.$row->user_id.'&Itemid='.DTreg::getcomItemId('com_community'),$xhtml_url),1=> JRoute::_('index.php?option=com_comprofiler&task=userProfile&user='.$row->user_id.'&Itemid='.DTreg::getcomItemId('com_comprofiler'),$xhtml_url));
		  
		  
		  switch($show_moderator) {
		  	
			 case '1': 
			    $text = $profile->name ;
			 break;
			 
			 case 'username': 
			    $text = $profile->username ;
			 break;
			 
			 case 'name_username': 
			    $text = $profile->name.' ('.$profile->username.')';
			 break;
			 
		  }
		  $href = $hrefarr[$cb_integrated] ;
		  $link = '<a  href="'.$href.'">'.$text.'</a>';
    }else{
		
		 $link = $profile->name;
			   
	}
}

if($link != ""){
   	echo  '<br />&nbsp;'.JText::_('DT_MODERATOR').':&nbsp;'.$link ;
}

?>
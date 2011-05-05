<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterViewEvent	 extends DtrView {
   
   	function display($tpl = null){
	
			parent::display($tpl);
				
	}
	
	function viewUserField(){
	    require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
	     $fieldView = new DtregisterViewField(array());
	  
	      foreach($fieldView->_path['template'] as $path){
	        if(file_exists($path)){
		      $basepath = $path;
			   break;
		    }
	      }
	      $file = $basepath."default.php";
		  $tpl = file_get_contents($file);
		 
		  $userIndex = DT_Session::get('register.Setting.current.userIndex');
		  
		  $label = JText::_('DT_USERNAME');
	      $value = DT_Session::get('register.User.'.$userIndex.'.username');
		  if($value == ""){
			  return "";
		  }
		  $constants = array('[label]','[value]','[description]');
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  return $html = str_replace($constants,$replace,$tpl); 
    }
	function userFields($usercreation=0){
	     global $amp, $xhtml;
		 $my = &JFactory::getUser();
		 
		 if($my->id || $usercreation==0){
		    	return "";
		 }
	     require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
	     $fieldView = new DtregisterViewField(array());
	  
	      foreach($fieldView->_path['template'] as $path){
	        if(file_exists($path)){
		      $basepath = $path;
			   break;
		    }
	      }
	      $file = $basepath."default.php";
		  if($usercreation==1){
			 $requiredlabel = " <span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
			 $requireclass = "required";
		  }else{
			 $requiredlabel = "";
			 $requireclass = "";
		  }
	      $label = JText::_('DT_USERNAME').$requiredlabel;
		 
	      $value = '<input type="text" name="username" id="username" value="" class="'.$requireclass.'" />';
	      $constants = array('[label]','[value]','[description]');
		  $description =  JHTML::tooltip(JText::_('DT_USERNAME_TIP'), '', 'tooltip.png', '', '');
		  $replace = array($label,$value,$description);
		  $tpl = file_get_contents($file);
		  $html = str_replace($constants,$replace,$tpl);
		  
		  $label = JText::_('DT_PASSWORD').$requiredlabel;
	      $value = '<input type="password" name="password" id="password"  value="" class="'.$requireclass.'" />';
		  $description = JHTML::tooltip(JText::_('DT_PASSWORD_TIP'), '', 'tooltip.png', '', '');
		  $replace = array($label,$value,$description);
		  $tpl = file_get_contents($file);
		  $html .= str_replace($constants,$replace,$tpl); 
		  
		  $label = JText::_('DT_CONFIRM_PASSWORD').$requiredlabel;
	      $value = '<input type="password" id="confirmpassword" name="confirmpassword" value="" class="'.$requireclass.'" />';
		  $description =  JHTML::tooltip(JText::_('DT_CONFIRM_PASSWORD_TIP'), '', 'tooltip.png', '', '');
		  $replace = array($label,$value,$description);
		  $tpl = file_get_contents($file);
		  $html .= str_replace($constants,$replace,$tpl);
	   	  $document = &JFactory::getDocument();
		  ob_start();
		  ?>
             DTjQuery(function(){
                  DTjQuery(document.frmcart).validate({
                        success: function(label) {
                            label.addClass("success");
                        }
              
                });
                    DTjQuery('#username').val('');
                    DTjQuery('#password').val('');
                    DTjQuery('#confirmpassword').val('');
                   DTjQuery('#username').rules('add',{remote: "<?php echo JRoute::_('index.php?option=com_dtregister&controller=validate&task=uniqueUser&no_html=1',$xhtml); ?>",
                   messages : {
                      remote : "<?php echo  JText::_('DT_USER_ALREADY_EXISTS')?>"
                   }
                 
             }) 
                   DTjQuery('#confirmpassword').rules('add',{equalTo: "#password"
                  });

              })
          <?php
		  $js = ob_get_clean();
		  $document->addScriptDeclaration($js);
	   	 return $html;
	 }
	 
	 function capthaField(){
	     global $amp,$xhtml,$button_color,$security_image_check;
		 if(!$security_image_check){
		    return;
		 }
		 require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
	     $fieldView = new DtregisterViewField(array());
	     $html = "";
		
	      foreach($fieldView->_path['template'] as $path){
	        if(file_exists($path)){
		      $basepath = $path;
			   break;
		    }
	      }
		  $constants = array('[label]','[value]','[description]');
	      $file = $basepath."default.php";
		  
		  $label = JText::_('DT_ENTER_SECURITY_CODE')." <span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
	      $value = '<input type="text" id="captchaField" name="captcha" value="" class="required" /> <img src="'. JURI::root(true).'/components/com_dtregister/CaptchaSecurityImages.php?width=100'. $amp.'height=40'.$amp.'characters=5" id="captchaelement" align="middle" alt="" /><a href="#" id="captchreload"><img border="" src="'.JUri::root(true).'/components/com_dtregister/assets/images/'.$button_color.'/reload_20x20.png'.'" /></a><label for="captchaField" style="display:none" generated="true" class="error"></label>
';
          $document = &JFactory::getDocument();
		  ob_start();
		  ?>
             DTjQuery(function(){
                 
                 DTjQuery('#captchreload').live('click',function(){
                     var src = DTjQuery('#captchaelement').attr('src');
                     DTjQuery('#captchaelement').attr('src','');
                     DTjQuery('#captchaelement').attr('src',src+"&rand"+Math.floor(Math.random()*5));
                     return false;
                     
                 });
                   DTjQuery(document.frmcart).validate({
                        success: function(label) {
                            label.addClass("success");
                        }
              
                });
                   DTjQuery('#captchaField').rules('add',{remote: "<?php echo JRoute::_('index.php?option=com_dtregister&controller=validate&task=captcha&no_html=1',$xhtml); ?>"
});
                 
             });
          <?php
		  $js = ob_get_clean();
		  $document->addScriptDeclaration($js);
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  $html .= str_replace($constants,$replace,$tpl); 
		  return $html;
		
	 }
        
  function termsField($eventId){
	     global $amp,$xhtml,$terms_conditions;
		 if(!$terms_conditions){
		    return;
		 }
	     require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
	     $fieldView = new DtregisterViewField(array());
	  
	      foreach($fieldView->_path['template'] as $path){
	        if(file_exists($path)){
		      $basepath = $path;
			   break;
		    }
	      }
	      $file = $basepath."default.php";
		  $label = JText::_( 'DT_CHECK_TERMS_CONDITIONS' );
	      $value = '<input type="checkbox" name="terms_conditions" id="terms_conditionscheck" value="terms" class="required" />';
		  $value .= '<a href="'.JRoute::_('index.php?option=com_dtregister&controller=event&task=terms&no_html=1&eventId='.$eventId).'" id="terms_conditions_popup" class="lbOn">'. htmlspecialchars (JText::_( 'DT_TERMS_CONDITIONS_READ' )).'</a> <label for="terms_conditions" style="display:none" generated="true" class="error"></label> ';
              
	      $constants = array('[label]','[value]','[description]');
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  $html = str_replace($constants,$replace,$tpl);
		  $document	=& JFactory::getDocument();
		  
		  if(!JModuleHelper::isEnabled('s5_box')){
     		 $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/jquery.lightbox.css');
          }
		  $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.lightbox.js');
		   ob_start();
		  ?>
             DTjQuery(function(){
                 DTjQuery("#terms_conditions_popup").live('click',function(){
                
			var href = DTjQuery(this).attr('href');
            
			DTjQuery.fn.colorbox({href:DTjQuery(this).attr('href'), open:true,iframe:true,  innerWidth:'50%',innerHeight:'50%' });
			
			return false;

		});
                
             });
          <?php
		  $js = ob_get_clean();
		  $document->addScriptDeclaration($js);
		  return $html;
  }
}
?>
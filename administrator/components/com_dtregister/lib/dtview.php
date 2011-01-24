<?php

/**
* @version 2.7.1
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined('_JEXEC') or die();
jimport( 'joomla.application.component.view');
class DtrView extends JView {
     
	 function __construct($params){
        
		parent::__construct($params);
	   $this->addHelperPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers');
		$this->loadHelper('html');
		$this->loadHelper('dtregister');

	 }
	 
	 function display($tpl){
	    //$this->getModel('config')->setGlobal();
	//	http://www.joomlaeventregistration.com/dtreg27/media/system/js/mootools.js
		global $mainframe;
		$bar = & JToolBar::getInstance('toolbar');
		$document	=& JFactory::getDocument();
		 //$document->addScript( JURI::root(true).'/media/system/js/mootools.js');
		$document->addScript( JURI::root(true).'/includes/js/joomla.javascript.js');
			 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');
			 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validate.js');
			 $document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validationmethods.js');
		if(!$mainframe->isAdmin()){
		   	if(!(isset($_REQUEST['tmpl']) || isset($_REQUEST['no_html']) || (isset($_REQUEST['format']) && $_REQUEST['format']!='html' ))){
				if(!isset($mainframe->JComponentTitle)){
						$mainframe->JComponentTitle = "";
				}
				echo $bar->render().$mainframe->JComponentTitle."<div style='clear:both;'></div>";
				
			}
			$document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/main.css');
			
			
			ob_start();
			?>
            
            DTjQuery(function(){
   
               DTjQuery('a.toolbar').click(function(event){
                  event.preventDefault();
               
               })
                
            })
            <?php
			 $js = ob_get_clean();
			 $document->addScriptDeclaration( $js );
			
		}else{
			 $document =& JFactory::getDocument();
			 $document->addStyleSheet(JURI::root(true).'/administrator/components/com_dtregister/assets/css/admin.dtregister.css');
			 JToolBarHelper::custom('cpanel','cpanel','',JText::_( 'DT_CONTROL_PANEL'),false);
		   	
			 ob_start();
             ?>
              DTjQuery(function(){
                
                DTjQuery("a[onclick*='cpanel']").click( function(){
                        
                        document.adminForm.controller.value = 'cpanel';
                        submitform('index');
                        
                })
                DTjQuery("a[onclick*='cpanel']").attr('onclick' ,null);
              })
             <?php
			 $js = ob_get_clean();
			 $document->addScriptDeclaration( $js );
			 
			 
		}
		
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
	      $value = DT_Session::get('register.User.username');
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
	      $label = JText::_('DT_USERNAME')." <span class='required'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
	      $value = '<input type="text" name="username" id="username" value="" class="required" />';
	      $constants = array('[label]','[value]','[description]');
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  $html = str_replace($constants,$replace,$tpl);
		  
		  $label = JText::_('DT_PASSWORD')." <span class='required'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
	      $value = '<input type="password" name="password" id="password"  value="" class="required" />';
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  $html .= str_replace($constants,$replace,$tpl); 
		  
		  $label = JText::_('DT_CONFIRM_PASSWORD')." <span class='required'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
	      $value = '<input type="password" id="confirmpassword" name="confirmpassword" value="" class="required" />';
		  $replace = array($label,$value,'');
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
                   DTjQuery('#username').rules('add',{remote: "<?php echo JRoute::_('index.php?option=com_dtregister&controller=validate&task=uniqueUser&no_html=1',$xhtml); ?>"
                 
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
	     global $amp , $xhtml ;
		 require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");
	     $fieldView = new DtregisterViewField(array());
	  
	      foreach($fieldView->_path['template'] as $path){
	        if(file_exists($path)){
		      $basepath = $path;
			   break;
		    }
	      }
		  $constants = array('[label]','[value]','[description]');
	      $file = $basepath."default.php";
		  
		  $label = JText::_('DT_ENTER_SECURITY_CODE')." <span class='required'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
	      $value = '<input type="text" id="captchaField" name="captcha" value="" class="required" /> <img src="'. JURI::root(true).'/components/com_dtregister/CaptchaSecurityImages.php?width=100'. $amp.'height=40'.$amp.'characters=5" id="captchaelement" align="middle" alt="" /><label for="captchaField" style="display:none" generated="true" class="error"></label>
';
          $document = &JFactory::getDocument();
		  ob_start();
		  ?>
             DTjQuery(function(){
                 
                 DTjQuery('#captchaelement').live('click',function(){
                     var src = DTjQuery(this).attr('src');
                     DTjQuery(this).attr('src','');
                     DTjQuery(this).attr('src',src+"&rand"+Math.floor(Math.random()*5));
                     
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
	    global $amp , $xhtml ;
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
		  	$value .= '<a href="'.JRoute::_('index.php?option=com_dtregister&controller=event&task=terms&no_html=1&eventId='.$eventId).'" id="terms_conditions_popup"  class="lbOn">'. htmlspecialchars  (JText::_( 'DT_TERMS_CONDITIONS_READ' )).'</a> <label for="terms_conditions" style="display:none" generated="true" class="error"></label> ';

              
	      $constants = array('[label]','[value]','[description]');
		  $replace = array($label,$value,'');
		  $tpl = file_get_contents($file);
		  $html = str_replace($constants,$replace,$tpl);
		  $document	=& JFactory::getDocument();
		  $document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/jquery.lightbox.css');
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
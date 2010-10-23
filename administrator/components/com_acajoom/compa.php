<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
global $_VERSION;

class compa{

	function joom10(){
		static $version;
		//return true if where are with Joomla 1.0.x, return false if it's Joomla 1.5.x
		if (!isset($version) OR ($version!== true AND $version!== false)){
			if(class_exists('JFactory')) {$version = false;}
			else{$version = true;}
		}

		return $version;
	}

	function completeLink(&$link,$back = true){
		if(compa::joom10()){
			if($back){
				$link = $GLOBALS['mosConfig_live_site'].'/administrator/index2'.$link;
			}else{
				if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
					$link = sefRelToAbs('index'.$link);
				}else{
					$link = $GLOBALS['mosConfig_live_site'].'/index'.$link;
				}
			}
		}else{
			$link = 'index'.$link;
		}
	}

	function showIcon($image,$text,$text2 = '',$option = 1){
		if(compa::joom10()){
			echo mosAdminMenus::imageCheckAdmin( $image, '/administrator/images/', NULL,NULL, $text,$text2,$option );
		}
		else{
			echo '<img alt="'.$text.'" src="'.$GLOBALS['mosConfig_live_site'].'/administrator/images/'.$image.'"/>';
			//echo JHTML::_('image.administrator', $image, 'images/', NULL, NULL, $text, $text2,$option);
		}
	}

	function toolTip($tooltip, $title='', $width='', $image='tooltip.png', $text='', $href='', $link=1){

		if(compa::joom10()){
			if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) $href = sefRelToAbs($href);
			return mosToolTip( addslashes($tooltip), addslashes($title), $width, $image, $text, $href, $link);
		}else{
			if(preg_match("/#/",$href)){
				$href = null;
			}
			return JHTML::_('tooltip', $tooltip, $title, $image, $text, $href, $link);
		}
	}

	function allow_html(){
		if(compa::joom10()){
			return _MOS_ALLOWHTML;
		}else{
			return 0x0004;
		}
	}

	function redirect($link, $message = ''){
		global $mainframe;
		if(compa::joom10()){
			if ( !preg_match("/index2/",$link) AND function_exists('sefRelToAbs') AND $GLOBALS[ACA.'use_sef'] ) {
				$link = sefRelToAbs($link);
			}
			mosRedirect($link, $message);
			exit;
		}else{
			$mainframe->redirect( $link, $message );
			exit;
		}
	}

	function encodeutf($string){
		if(compa::joom10()){
			return $string;
		}else{
			return utf8_encode($string);
		}
	}
}

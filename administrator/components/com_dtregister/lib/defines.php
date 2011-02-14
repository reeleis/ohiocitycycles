<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

if (!defined('DTR_COM_COMPONENT')){

	define('DTR_COM_COMPONENT',"com_dtregister");

	define("DTR_COMPONENT",str_replace("com_","",'DT_COM_COMPONENT'));

}

JLoader::register('DtrModel' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtmodel.php');

JLoader::register('DtrController' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtcontroller.php');

JLoader::register('DtrView' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtview.php');

JLoader::register('DtrTable' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dttable.php');

JLoader::register('DT_file' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtfile.php');

JLoader::register('DT_Session' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtsession.php');

JLoader::register('DT_Fee' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtfee.php');

JLoader::register('DT_Cart' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtcart.php');

JLoader::register('DTbarcode' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtbarcode.php');

JLoader::register('DTrCommon' ,JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtcommon.php');

JLoader::register('Tagparser' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'tagparser.php');
JLoader::register('DtPagination' , JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'lib'.DS.'dtpagination.php');
//$defaultimeZone = date_default_timezone_get();
function set_tz_by_offset($offset) {
	    global $defaultimeZone;
        $offset = $offset*60*60;
        $abbrarray = timezone_abbreviations_list();
        foreach ($abbrarray as $abbr) {
             //echo $abbr."<br>";
                foreach ($abbr as $city) {
                    //echo $city['offset']." $offset<br>";
                        if ($city['offset'] == $offset) { // remember to multiply $offset by -1 if you're getting it from js
                               date_default_timezone_set($city['timezone_id']);
                               return true;
                        }
                }
        }
    date_default_timezone_set($defaultimeZone);
    return false;
}
$conf =& JFactory::getConfig();
//set_tz_by_offset($conf->getValue('config.offset')); 

global $DT_config , $month_arr , $now , $xhtml_url , $amp , $sign_up_redirect;

jimport('joomla.utilities.date');

$now = new JDate('now');

//$now = new JDate(strftime('%Y-%m-%d %H:%M:%S'));
$now->setoffset($conf->getValue('config.offset'));
//pr(strftime('%Y-%m-%d %H:%M:%S %Z%n'));
//date_default_timezone_set($defaultimeZone);

//$now->setOffset($conf->getValue('config.offset'));

$month_arr =  array (

    '01'=>JText::_( 'DT_JAN'),

    '02'=>JText::_( 'DT_FEB'),

	'03'=>JText::_( 'DT_MAR'),

    '04'=>JText::_( 'DT_APR'),

	'05'=>JText::_( 'DT_MAY'),

	'06'=>JText::_( 'DT_JUN'),

	'07'=>JText::_( 'DT_JUL'),

	'08'=>JText::_( 'DT_AUG'),

	'09'=>JText::_( 'DT_SEP'),

	'10'=>JText::_( 'DT_OCT'),

	'11'=>JText::_( 'DT_NOV'),

	'12'=>JText::_( 'DT_DEC'),

);

$xhtml_url = false;

if($xhtml_url){

   $amp = "&amp;";

}else{

   $amp = "&";

}

if (!function_exists('pr')) {

function pr($data=array()){ //return;
/*
  	echo "<pre>";

	 $backtrace =  debug_backtrace();

	 $index = 0;

	if(basename($backtrace[0]['file'])=="defines.php"){

	   $index = 1;	

	}

	echo "<br /><b>called in file ".$backtrace[$index]['file']."  line number ".$backtrace[$index]['line']."</b><br />";

	if(empty($data)){

	    var_dump($data);

	}

	  print_r($data);

	echo "</pre>";
*/
}

}

function prd($data=null){ //return;
/*
  pr($data);

  die;	
*/
}

function Comp($Num1,$Num2,$Scale=null) {
  // check if they're valid positive numbers, extract the whole numbers and decimals
  if(!preg_match("/^\+?(\d+)(\.\d+)?$/",$Num1,$Tmp1)||
     !preg_match("/^\+?(\d+)(\.\d+)?$/",$Num2,$Tmp2)) return('0');

  // remove leading zeroes from whole numbers
  $Num1=ltrim($Tmp1[1],'0');
  $Num2=ltrim($Tmp2[1],'0');

  // first, we can just check the lengths of the numbers, this can help save processing time
  // if $Num1 is longer than $Num2, return 1.. vice versa with the next step.
  if(strlen($Num1)>strlen($Num2)) return(1);
  else {
    if(strlen($Num1)<strlen($Num2)) return(-1);

    // if the two numbers are of equal length, we check digit-by-digit
    else {

      // remove ending zeroes from decimals and remove point
      $Dec1=isset($Tmp1[2])?rtrim(substr($Tmp1[2],1),'0'):'';
      $Dec2=isset($Tmp2[2])?rtrim(substr($Tmp2[2],1),'0'):'';

      // if the user defined $Scale, then make sure we use that only
      if($Scale!=null) {
        $Dec1=substr($Dec1,0,$Scale);
        $Dec2=substr($Dec2,0,$Scale);
      }

      // calculate the longest length of decimals
      $DLen=max(strlen($Dec1),strlen($Dec2));

      // append the padded decimals onto the end of the whole numbers
      $Num1.=str_pad($Dec1,$DLen,'0');
      $Num2.=str_pad($Dec2,$DLen,'0');

      // check digit-by-digit, if they have a difference, return 1 or -1 (greater/lower than)
      for($i=0;$i<strlen($Num1);$i++) {
        if((int)$Num1{$i}>(int)$Num2{$i}) return(1);
        else
          if((int)$Num1{$i}<(int)$Num2{$i}) return(-1);
      }

      // if the two numbers have no difference (they're the same).. return 0
      return(0);
    }
  }
}

function db(){
/*
  echo "<pre>";

	 $backtrace = debug_backtrace();

	 $index = 0;

	if(basename($backtrace[0]['file'])=="defines.php"){

	   $index = 1;	

	}

	echo "<br /><b>called in file ".$backtrace[$index]['file']."  line number ".$backtrace[$index]['line']."</b><br />";

  echo "<pre>";

   debug_print_backtrace();

   echo "</pre>";
*/
}

//pr($now->toMySQL(true));
//pr(strftime('%Y-%m-%d %H:%M:%S %Z%n'));


function my_array_filter_fn($val) {
  $val = trim($val);
  $allowed_vals = array("0"); // Add here your valid values
  return in_array($val, $allowed_vals, true) ? true : ( $val ? true : false );
}
//pr($now->toMySQL(true));
//pr(strftime('%Y-%m-%d %H:%M:%S %Z%n'));

?>
<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DTrCommon {

	function birdDiscountCalc($type,$discount,$amount){

	   if($type == 2 || $type == 3){

		 $per = (100-$discount)/100;

		   $amount= $amount*$per;

		}elseif($type != 0){

		   $amount = $amount - $discount;   

		}

		return $amount;

	}

	function cntMemtotInSession($members=array()){

		if(count($members)<=0){

             return 1;

        }

		$cnt = 0;

		foreach($members as $member){

			 if(isset($member['remove']) && $member['remove']){

			}else{

			  $cnt++;

			}

		}

		return $cnt;

	}

	function objectToArray( $object ){

        if( !is_object( $object ) && !is_array( $object ) )

        {

            return $object;

        }

        if( is_object( $object ) )

        {

            $object = get_object_vars( $object );

        }

        return array_map( array('DTrCommon','objectToArray'), $object );

    }

	function getDateRangeByViewType($date=null, $viewType='month'){

		global $now;
        $viewType = ($viewType == '')?'month':$viewType;
		 
		if($date==null){

		  	$date = $now;

		}else{

		   $arr = explode("/",$date);

		   $date = $arr[2]."-".$arr[0]."-".$arr[1];

		   $date = 	new JDate( $date );

		}

		switch($viewType){

		   case 'month':

		      $startoffset = -($arr[1] + 5);

		      $date->setOffset(($startoffset*24));

			  $startdate = $date->toFormat('%Y-%m-%d');

			  $endoffest = (35 - $arr[1]);

			  $date->setOffset(($endoffest*24));

			  $enddate = $date->toFormat('%Y-%m-%d');

		   break;

		   case 'week':

			  $startoffset = -7;

		      $date->setOffset(($startoffset*24));

			  $startdate = $date->toFormat('%Y-%m-%d');

			  $endoffest = 7;

			  $date->setOffset(($endoffest*24));

			  $enddate = $date->toFormat('%Y-%m-%d');

		   break;

		   case 'day':

		      $startoffset = -1;

		      $date->setOffset(($startoffset*24));

			  $startdate = $date->toFormat('%Y-%m-%d');

			  $endoffest = 1;

			  $date->setOffset(($endoffest*24));

			  $enddate = $date->toFormat('%Y-%m-%d');

		   break;

		}

		return array('startdate'=>$startdate , 'enddate'=>$enddate);

	}

	function array_push_associative(&$arr) {

	$args = func_get_args();

    $ret = 0;

	foreach ($args as $arg) {

		if (is_array($arg)) {

			foreach ($arg as $key => $value) {

				$arr[$key] = $value;

				$ret++;

			}

		}else{

			$arr[$arg] = "";

		}

	}

	return $ret;
}

}

?>
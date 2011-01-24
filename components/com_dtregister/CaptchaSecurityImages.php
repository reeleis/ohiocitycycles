<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

@session_start();

@ob_start();

define( '_JEXEC', 1 );

define( 'DS', DIRECTORY_SEPARATOR );

//@$_SESSION['old_path'] = getcwd();

chdir('../../');

define('JPATH_BASE', getcwd() );

require_once("configuration.php");

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );

require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

		jimport('joomla.database.database');

		jimport( 'joomla.database.table' );

		$conf = new  JConfig();

		$host 		= $conf->host;

		$user 		= $conf->user;

		$password 	= $conf->password;

		$database	= $conf->db;

		$prefix 	= $conf->dbprefix;

		$driver 	= $conf->dbtype;

		$debug 		= $conf->debug;

		$options	= array ( 'driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix );

		global $database;

		$database =& JDatabase::getInstance( $options );

		//@chdir($_SESSION['old_path']);

/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/

class CaptchaSecurityImages {

   var $font = 'monofont.ttf';

   function generateCode($characters) {

      /* list all possible characters, similar looking characters and vowels have been removed */

      $possible = '23456789bcdfghjkmnpqrstvwxyz';

      $code = '';

      $i = 0;

      while ($i < $characters) {

         $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);

         $i++;

      }

      return $code;

   }

   function CaptchaSecurityImages($width='120',$height='40',$characters='6') {

	global $mosConfig_dbprefix,$Itemid , $database;

	$code = $this->generateCode($characters);

	/* font size will be 75% of the image height */

	$font_size = $height * 0.75;

	$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

	/* set the colours */

	$background_color = imagecolorallocate($image, 255, 255, 255);

	$text_color = imagecolorallocate($image, 20, 40, 100);

	$noise_color = imagecolorallocate($image, 100, 120, 180);

	/* generate random dots in background */

	for( $i=0; $i<($width*$height)/3; $i++ ) {

		imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);

	}

	/* generate random lines in background */

	for( $i=0; $i<($width*$height)/150; $i++ ) {

		imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);

	}

	/* create textbox and add text */

	$textbox = imagettfbbox($font_size, 0, JPATH_SITE."/components/com_dtregister/".$this->font, $code) or die('Error in imagettfbbox function');

	$x = ($width - $textbox[4])/2;

	$y = ($height - $textbox[5])/2;

	imagettftext($image, $font_size, 0, $x, $y, $text_color, JPATH_SITE."/components/com_dtregister/".$this->font , $code) or die('Error in imagettftext function');

	/* output captcha image to browser */

   @ob_clean();

	header('Content-Type: image/jpeg');

	imagejpeg($image);

	imagedestroy($image);

		//We will use database for storing captcha information

		require_once("configuration.php");

		//require_once("config.dtregister.php");

		//Check if class exist or not

		if(class_exists("JConfig")){

			//Joomla 1.5

			$config=new JConfig();

			$host=$config->host;

			$user=$config->user;

			$password=$config->password;

			$db=$config->db;

			$db_prefix=$config->dbprefix;

		}else {

			// global $mosConfig_host,$mosConfig_user,$mosConfig_password,$mosConfig_db;

			$host=$mosConfig_host;

			$user=$mosConfig_user;

			$password=$mosConfig_password;

			$db=$mosConfig_db;

			$db_prefix=$mosConfig_dbprefix;

		}

		//Connect to database

		$link=mysql_connect($host,$user,$password) or die("Could not connect to database");

		mysql_select_db($db,$link) or die('Could not select database');

		$userIp=$_SERVER['REMOTE_ADDR'];

		//Check if user exist or not

		$sql="Select count(*) From {$db_prefix}dtregister_captcha where user_ip='$userIp'";

		$result=mysql_query($sql);

		$total=mysql_result($result,0,0);

		if($total){

			//Update the code into database

			$sql="Update {$db_prefix}dtregister_captcha set code='$code' where user_ip='$userIp'";

		}else{

			//Insert the code into database

			$sql="Insert into {$db_prefix}dtregister_captcha(user_ip,code) Values('$userIp','$code') ";

		}

		mysql_query($sql);

}

}

$width = isset($_GET['width']) && $_GET['width'] < 600 ? $_GET['width'] : '120';

$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '40';

$characters = isset($_GET['characters']) && $_GET['characters'] > 2 ? $_GET['characters'] : '6';

$captcha = new CaptchaSecurityImages($width,$height,$characters);

die;
?>
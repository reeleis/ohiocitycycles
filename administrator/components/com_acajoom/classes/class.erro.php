<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

 class xerr {

	var $file_name;
	var $classes;
	var $fct;
	var $line = 0;
	var $showErr = false;
	var $err = null;
	var $ck = true;
	var $errNb = 0;
	var $warning = false;
	var $mess = '';
	var $data = null;
	var $result = true;


	function xerr($file, $fct, $classes='' ) {
		$this->file_name = $file;
		$this->classes = $classes;
		$this->fct = $fct;
	}


	function E( $line , $errNb, $data='' ) {

		$this->line = $line;
		$this->errNb = $errNb;
		$this->data = $data;
		if (!empty($this->err)) {
			$this->P();
			return false;
		} else {
			return true;
		}

   	}


	function Ertrn( $line , $errNb, $data, $value='' ) {

		$this->line = $line;
		$this->errNb = $errNb;
		$this->data = $data;
		if (!empty($this->err)) {
			$this->P();
			return '';
		} else {
			return $value;
		}

   	}


	function Enod( $line , $errNb ) {

		$this->line = $line;
		$this->errNb = $errNb;
		if (!empty($this->err)) {
			$this->P();
			return false;
		} else {
			return true;
		}

   	}


	function Eck($line, $errNb, $data='' ) {

		$this->line = $line;
		$this->errNb = $errNb;
		$this->data = $data;
		if (!$this->ck) {
//			$this->P();
			return false;
		} else {
			return true;
		}

   	}


	function W( $line , $errNb, $mess='' ) {

		$this->line = $line;
		$this->errNb = $errNb;
		$this->data = $mess;
		$this->warning = true;
		$this->P();

   	}


	function Ecknod($line, $errNb ) {

		$this->line = $line;
		$this->errNb = $errNb;
		if (!$this->ck) {
			$this->P();
			return false;
		} else {
			return true;
		}

   	}


	function P() {

		$this->setResult();
		if ($GLOBALS[ACA.'send_error'] =='1') {
			echo $this->report();
			$this->email();
		}

		if (!$this->warning) {
			if (class_exists('acajoom')) {
				if ($GLOBALS[ACA.'report_error']=='1' AND $GLOBALS['mosConfig_debug']=='1') {
					$this->mess .= acajoom::printM('error', _ACA_ERR_NB.$this->errNb );
				} else {
					$this->mess .= acajoom::printM('red', _ACA_ERROR );
				}
			} else {
				if ($GLOBALS[ACA.'report_error']=='1' AND $GLOBALS['mosConfig_debug']=='1') {
					$this->mess .=  _ACA_ERR_NB.$this->errNb ;
				} else {
					$this->mess .=  _ACA_ERROR ;
				}
			}


			if ($this->showErr) {
				$this->mess ='';
			}
			if ( $GLOBALS[ACA.'admin_debug']==1  ) {
			}
			$this->err = '';
			$this->ck = true;
		} else {
			$this->warning = false;
		}
   	}



	function report() {
		global $version, $database;

	$content = '<img src="' . $GLOBALS[ACA.'report_site'] .
	 	'/index.php?option='.$GLOBALS[ACA.'option'].
		'&act=error' .

		'&errnb=' . $this->errNb .
		 '&soft=' . $GLOBALS[ACA.'component'] .
		 '&type='  . $GLOBALS[ACA.'type'] .
		 '&version=' . $GLOBALS[ACA.'version'] .
		 '&fct=' . $this->fct .
		 '&line=' .$this->line.
		 '&file=' . $this->file_name .
		 '&class=' . $this->classes .
		 //'&joomla=' . $version .
		 '&lang=' . $GLOBALS['mosConfig_lang'] .
		 '&php=' . phpversion() .
		 '&mysql=' . $database->getVersion() .
		 '&magic=' . ini_get("magic_quotes_gpc") .
		 '&debug=' . $GLOBALS['mosConfig_debug'] .
		  '&error=' . print_r($this->err) .
		  '&data=' . print_r($this->data) .
		   '" border="0" width="1" height="1" />';

		return $content;

   	}


	function email() {
		global $version, $database;
		$acaVers = ( class_exists('acajoom') ) ? acajoom::version() : 'test';
		$acaNow = ( class_exists('acajoom') ) ? acajoom::getNow() : time();

		 $safemode = (ini_get("safe_mode") == 0) ? 'off' : 'on';
		 $content = "-----------------------------------\n";
		 $content .= $GLOBALS[ACA.'component']." Configuration: \n";
		 $content .= "-----------------------------------\n\n";
		 $content .= "Component        : ". $acaVers."  \n";
		 $content .= "Language           : " . $GLOBALS['mosConfig_lang'] . "\n";
		 $content .= ' Time of report : ' . $acaNow . "\n\n";
		 $content .= "Send method: " . $GLOBALS[ACA.'emailmethod'] . "\n";
		 if($GLOBALS[ACA.'emailmethod'] == 'smtp'){
			 $auth = ($GLOBALS[ACA.'smtp_auth_required'] == 1) ? 'yes' : 'no';
			 $content .= "Authentication required: " . $auth . "\n";
		 }
		 $content .= "-----------------------------------\n";
		 $content .= " Server configuration: \n";
		 $content .= "-----------------------------------\n\n";
		 $content .= "Joomla Version        : " . $version . "\n";
		 $content .= "Database Version     : " . $database->getVersion() . "\n";
		 $content .= "PHP Version             : " . phpversion() . "\n";
		 $content .= "Zend Version            : " . zend_version() . "\n";
		 $content .= "Magic_quotes_gpc    : " . ini_get("magic_quotes_gpc") . "\n";
		 $content .= "Disable_functions     : " . ini_get("disable_functions") . "\n";
		 $content .= "Max_execution_time : " . ini_get("max_execution_time") . "\n";
		 $content .= "Safe_mode              : " . $safemode . "\n";
		 $content .= "Memory_limit           : " . ini_get("memory_limit") . "\n";
		 $content .= "Software                 : " . $_SERVER['SERVER_SOFTWARE'] . "\n";
		 $content .= "-----------------------------------\n";
		 $content .= " Traces: \n";
		 $content .= "-----------------------------------\n\n";
		 $content .= "Error #       :"._ACA_ERR_NB.$this->errNb."\n\n\n";
		 $content .= "Line            : " . $this->line . "\n";
		 $content .= "Class           : " . $this->classes . "\n";
		 $content .= "Function      : " . $this->fct . "\n";
		 $content .= "File             : " . $this->file_name . "\n";
		 $content .= "\n\n";
		if ($this->err) $content .= "Error raised: " . $this->varDump($this->err) . "\n";
		if ($this->data) $content .= "Data          : " . $this->varDump($this->data) . "\n";
		 $content .= "\n\n";
		 $content .= "\n\n";


   	}




	function show() {
		$this->showErr = true;
	}


	function varDump($mixed = null) {
	  ob_start();
	  var_dump($mixed);
	  $content = ob_get_contents();
	  ob_end_clean();
	  return $content;
	}


	function R() {
		return $this->result;
	}


	function setResult() {
		$this->result = false;
	}

	function setRTrue() {
		$this->result = true;
	}


 }

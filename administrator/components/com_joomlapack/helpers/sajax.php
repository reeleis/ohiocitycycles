<?php
/**
* @package		SAJAX
* @copyright	Copyright (C) 2006 ModernMethod, http://www.modernmethod.com/sajax/
* @version		0.12, patch level JoomlaPack 1.2.1
* @license 	BSD
*
* NOTE: The original SAJAX library has been modified to fit JoomlaPack's needs. This is a
*       derivative version. No license banners were on the original code. No license text
*       was found on their site, except a vague notice on being distributed under a BSD
*       license. I hope this modification is legal.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

global $option;

if (!isset($SAJAX_INCLUDED)) {

	/*
	 * GLOBALS AND DEFAULTS
	 *
	 */
	$GLOBALS['sajax_version'] = '0.12';
	$GLOBALS['sajax_debug_mode'] = 0;
	$GLOBALS['sajax_export_list'] = array();
	$GLOBALS['sajax_request_type'] = 'POST';
	$GLOBALS['sajax_remote_uri'] = '';
	$GLOBALS['sajax_remote_uri_params'] = '';
	$GLOBALS['sajax_failure_redirect'] = '';

	/*
	 * CODE
	 *
	 */

	//
	// Initialize the Sajax library.
	//
	function sajax_init() {
	}

	// Since str_split used in sajax_get_my_uri is only available on PHP 5, we have
	// to provide an alternative for those using PHP 4.x
	if(!function_exists('str_split')){
	   function str_split($string,$split_length=1){
	       $count = strlen($string);
	       if($split_length < 1){
	           return false;
	       } elseif($split_length > $count){
	           return array($string);
	       } else {
	           $num = (int)ceil($count/$split_length);
	           $ret = array();
	           for($i=0;$i<$num;$i++){
	               $ret[] = substr($string,$i*$split_length,$split_length);
	           }
	           return $ret;
	       }
	   }
	}

	//
	// Helper function to return the script's own URI.
	//
	function sajax_get_my_uri() {
		return JoomlapackAbstraction::SiteURI().'/administrator/index2.php';		
		
		/*
		// ---- COPYLIFTED FROM JOOMLA! 1.5.3 --- START
		// Determine if the request was over SSL (HTTPS)
		if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) {
			$https = 's://';
		} else {
			$https = '://';
		}
	
		//
		// Since we are assigning the URI from the server variables, we first need
		// to determine if we are running on apache or IIS.  If PHP_SELF and REQUEST_URI
		// are present, we will assume we are running on apache.
		///
		if (!empty ($_SERVER['PHP_SELF']) && !empty ($_SERVER['REQUEST_URI'])) {
	
			//
			// To build the entire URI we need to prepend the protocol, and the http host
			// to the URI string.
			//
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	
		//
		// Since we do not have REQUEST_URI to work with, we will assume we are
		// running on IIS and will therefore need to work some magic with the SCRIPT_NAME and
		// QUERY_STRING environment variables.
		//
		}
		 else
		 {
			// IIS uses the SCRIPT_NAME variable instead of a REQUEST_URI variable... thanks, MS
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
	
			// If the query string exists append it to the URI string
			if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
				$theURI .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
	
		// Now we need to clean what we got since we can't trust the server var
		$theURI = urldecode($theURI);
		$theURI = str_replace('"', '&quot;',$theURI);
		$theURI = str_replace('<', '&lt;',$theURI);
		$theURI = str_replace('>', '&gt;',$theURI);
		$theURI = preg_replace('/eval\((.*)\)/', '', $theURI);
		$theURI = preg_replace('/[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']/', '""', $theURI);
		// ---- COPYLIFTED FROM JOOMLA! 1.5.3 --- END
		
		$myURI = $theURI;

		$upto = strpos($myURI, "?");
		if (is_numeric($upto)) {
			$myArray = str_split($myURI, $upto);
			$myURI = $myArray[0];
			//FIX 1.0.4: On a host, the AJAX proxy was beggining with double slash (//administrator/...)
			if (strstr($myURI, '//')) {
				$myURI = str_replace('//', '/', $myURI);
				$myURI = str_replace('http:/', 'http://', $myURI); // ...but don't whack the http:// or https:// protocol string!
				$myURI = str_replace('https:/', 'https://', $myURI);
			}
		}
		return $myURI;
		*/
	}
	
	global $sajax_remote_uri, $sajax_remote_uri_params;
	$sajax_remote_uri = sajax_get_my_uri();
	$sajax_remote_uri_params = "option=".JoomlapackAbstraction::getParam('option','com_joomlapack')."&no_html=1&act=ajax";

	/**
	 * Forces SAJAX to user per-page AJAX proxy URLs. Call it to make AJAX calls be processed by the
	 * page class processAJAX() method.
	 *
	 */
	function sajax_force_page_ajax()
	{
		global $sajax_remote_uri_params;
		$option = JoomlapackAbstraction::getParam('option','com_joomlapack');
		$act = JoomlapackAbstraction::getParam('act','ajax');
		$sajax_remote_uri_params = "option=$option&act=$act&no_html=1";
	}
	
	//
	// Helper function to return an eval()-usable representation
	// of an object in JavaScript.
	//
	function sajax_get_js_repr($value) {
		$type = gettype($value);

		if ($type == "boolean") {
			return ($value) ? "Boolean(true)" : "Boolean(false)";
		}
		elseif ($type == "integer") {
			return "parseInt($value)";
		}
		elseif ($type == "double") {
			return "parseFloat($value)";
		}
		elseif ($type == "array" || $type == "object" ) {
			//
			// Arrays with non-numeric indices are not
			// permitted according to ECMAScript, yet everyone
			// uses them.. We'll use an object.
			//
			$s = "{ ";
			if ($type == "object") {
				$value = get_object_vars($value);
			}
			foreach ($value as $k=>$v) {
				$esc_key = sajax_esc($k);
				if (is_numeric($k))
					$s .= "$k: " . sajax_get_js_repr($v) . ", ";
				else
					$s .= "\"$esc_key\": " . sajax_get_js_repr($v) . ", ";
			}
			if (count($value))
				$s = substr($s, 0, -2);
			return $s . " }";
		}
		else {
			$esc_val = sajax_esc($value);
			$s = "'$esc_val'";
			return $s;
		}
	}

	function sajax_handle_client_request( &$object ) {
		global $sajax_export_list;

		$mode = "";

		if (! empty($_GET["rs"]))
			$mode = "get";

		if (!empty($_POST["rs"]))
			$mode = "post";

		if (empty($mode))
			return;

		$target = "";

		ob_clean();

		if ($mode == "get") {
			// Bust cache in the head
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
			header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			// always modified
			header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
			header ("Pragma: no-cache");                          // HTTP/1.0
			$func_name = $_GET["rs"];
			if (! empty($_GET["rsargs"]))
				$args = $_GET["rsargs"];
			else
				$args = array();
		}
		else {
			$func_name = $_POST["rs"];
			if (! empty($_POST["rsargs"]))
				$args = $_POST["rsargs"];
			else
				$args = array();
		}

		if (! in_array($func_name, $sajax_export_list))
			echo "-:$func_name not callable";
		else {
			echo "+:";
			ob_flush();
			if(is_object($object))
			{
				$result = call_user_func_array(array(&$object, $func_name), $args);
			}
			else
			{
				$result = call_user_func_array($func_name, $args);				
			}
			echo "var res = " . trim(sajax_get_js_repr($result)) . "; res;";
			ob_flush();
			flush();
		}
		exit;
	}

	function sajax_get_common_js() {
		global $sajax_debug_mode;
		global $sajax_request_type;
		global $sajax_remote_uri;
		global $sajax_failure_redirect;
		global $sajax_remote_uri_params;

		$t = strtoupper($sajax_request_type);
		if ($t != "" && $t != "GET" && $t != "POST")
			return "// Invalid type: $t.. \n\n";

		ob_start();
		?>

		// remote scripting library
		// (c) copyright 2005 modernmethod, inc
		var sajax_debug_mode = <?php echo $sajax_debug_mode ? "true" : "false"; ?>;
		var sajax_request_type = "<?php echo $t; ?>";
		var sajax_target_id = "";
		var sajax_failure_redirect = "<?php echo $sajax_failure_redirect; ?>";
		var sajax_failed_eval = "";
		var sajax_fail_handle = "";

		function sajax_debug(text) {
			if (sajax_debug_mode)
				alert(text);
		}

 		function sajax_init_object() {
 			sajax_debug("sajax_init_object() called..")

 			var A;

 			var msxmlhttp = new Array(
				'Msxml2.XMLHTTP.5.0',
				'Msxml2.XMLHTTP.4.0',
				'Msxml2.XMLHTTP.3.0',
				'Msxml2.XMLHTTP',
				'Microsoft.XMLHTTP');
			for (var i = 0; i < msxmlhttp.length; i++) {
				try {
					A = new ActiveXObject(msxmlhttp[i]);
				} catch (e) {
					A = null;
				}
			}

			if(!A && typeof XMLHttpRequest != "undefined")
				A = new XMLHttpRequest();
			if (!A)
				sajax_debug("Could not create connection object.");
			return A;
		}

		var sajax_requests = new Array();

		function sajax_cancel() {
			for (var i = 0; i < sajax_requests.length; i++)
				sajax_requests[i].abort();
		}

		function sajax_do_call(func_name, args) {
			var i, x, n;
			var uri;
			var post_data;
			var target_id;

			sajax_debug("in sajax_do_call().." + sajax_request_type + "/" + sajax_target_id);
			target_id = sajax_target_id;
			if (typeof(sajax_request_type) == "undefined" || sajax_request_type == "")
				sajax_request_type = "GET";

			uri = "<?php echo $sajax_remote_uri.'?'.$sajax_remote_uri_params; ?>";
			if (sajax_request_type == "GET") {

				if (uri.indexOf("?") == -1)
					uri += "?rs=" + escape(func_name);
				else
					uri += "&rs=" + escape(func_name);
				uri += "&rst=" + escape(sajax_target_id);
				uri += "&rsrnd=" + new Date().getTime();

				for (i = 0; i < args.length-1; i++)
					uri += "&rsargs[]=" + escape(args[i]);

				post_data = null;
			}
			else if (sajax_request_type == "POST") {
				uri = "<?php echo $sajax_remote_uri; ?>";
				post_data = "<?php echo $sajax_remote_uri_params; ?>"
				post_data += "&rs=" + escape(func_name);
				post_data += "&rst=" + escape(sajax_target_id);
				post_data += "&rsrnd=" + new Date().getTime();

				for (i = 0; i < args.length-1; i++)
					post_data = post_data + "&rsargs[]=" + escape(args[i]);
			}
			else {
				alert("Illegal request type: " + sajax_request_type);
			}

			x = sajax_init_object();
			if (x == null) {
				if (sajax_failure_redirect != "") {
					location.href = sajax_failure_redirect;
					return false;
				} else {
					sajax_debug("NULL sajax object for user agent:\n" + navigator.userAgent);
					return false;
				}
			} else {
				x.open(sajax_request_type, uri, true);
				// window.open(uri);

				sajax_requests[sajax_requests.length] = x;

				if (sajax_request_type == "POST") {
					x.setRequestHeader("Method", "POST " + uri + " HTTP/1.1");
					x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				}

				x.onreadystatechange = function() {
					if (x.readyState != 4)
						return;

					sajax_debug("received " + x.responseText);

					var status;
					var data;
					var txt = x.responseText.replace(/^\s*|\s*$/g,"");
					status = txt.charAt(0);
					data = txt.substring(2);

					if (status == "") {
						// let's just assume this is a pre-response bailout and let it slide for now
					} else if (status == "-")
						alert("Error: " + data);
					else {
						if (target_id != "")
							document.getElementById(target_id).innerHTML = eval(data);
						else {
							try {
								var callback;
								var extra_data = false;
								if (typeof args[args.length-1] == "object") {
									callback = args[args.length-1].callback;
									extra_data = args[args.length-1].extra_data;
								} else {
									callback = args[args.length-1];
								}
								callback(eval(data), extra_data);
							} catch (e) {
								sajax_debug("Caught error " + e + ": Could not eval " + data );
								sajax_failed_eval = data;
								sajax_fail_handle(data);
							}
						}
					}
				}
			}

			sajax_debug(func_name + " uri = " + uri + "/post = " + post_data);
			x.send(post_data);
			sajax_debug(func_name + " waiting..");
			delete x;
			return true;
		}

		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	function sajax_show_common_js() {
		echo sajax_get_common_js();
	}

	// javascript escape a value
	function sajax_esc($val)
	{
		$val = str_replace("\\", "\\\\", $val);
		$val = str_replace("\r", "\\r", $val);
		$val = str_replace("\n", "\\n", $val);
		$val = str_replace("'", "\\'", $val);
		return str_replace('"', '\\"', $val);
	}

	function sajax_get_one_stub($func_name) {
		ob_start();
		?>

		// wrapper for <?php echo $func_name; ?>

		function x_<?php echo $func_name; ?>() {
			sajax_do_call("<?php echo $func_name; ?>",
				x_<?php echo $func_name; ?>.arguments);
		}

		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	function sajax_show_one_stub($func_name) {
		echo sajax_get_one_stub($func_name);
	}

	function sajax_export() {
		global $sajax_export_list;

		$n = func_num_args();
		for ($i = 0; $i < $n; $i++) {
			$sajax_export_list[] = func_get_arg($i);
		}
	}

	$sajax_js_has_been_shown = 0;
	function sajax_get_javascript()
	{
		global $sajax_js_has_been_shown;
		global $sajax_export_list;

		$html = "";
		if (! $sajax_js_has_been_shown) {
			$html .= sajax_get_common_js();
			$sajax_js_has_been_shown = 1;
		}
		foreach ($sajax_export_list as $func) {
			$html .= sajax_get_one_stub($func);
		}
		return $html;
	}

	function sajax_show_javascript()
	{
		echo sajax_get_javascript();
	}


	$SAJAX_INCLUDED = 1;
}
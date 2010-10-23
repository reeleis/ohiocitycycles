<?php
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_jupgrader {
	function showError($message) {
		echo '<p style="color: red; font-weight: bold">'.$message.'</p>';
	}
}	


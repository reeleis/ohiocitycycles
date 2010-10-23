<?php
/**
 * JUpgrader Common Functions
 */

define('JUPDATEMAN_DLMETHOD_FOPEN', 	0);
define('JUPDATEMAN_DLMETHOD_CURL', 		1);

// What began as "1.1" became "1.5", maybe I'll get it in for "1.6" or "1.7"
function downloadFile($url,$target)
{
	juimport('pasamio.downloader.downloader');
	$downloader =& Downloader::getInstance();
	$error_object = new stdClass();

	$params = JComponentHelper::getParams('com_jupdateman');
	$adapter = null;
	switch($params->get('download_method', 0))
	{
		case JUPDATEMAN_DLMETHOD_FOPEN:
		default:
			$adapter = $downloader->getAdapter('fopen');
			break;
		case JUPDATEMAN_DLMETHOD_CURL:
			$adapter = $downloader->getAdapter('curl');
			break;
	}
	
	return $adapter->downloadFile($url, $target, $params);
}

// Generate a nice progress bar
function buildProgressBar($current, $target)
{
	$percent = round($current/$target*100);
	$data  = '<div id="container" style="border: 3px solid black; width: 160px; height: 40px;">';
	$data .= '	<div id="bar" style="float: left; border: 1px solid black; width: 100px; height: 40px; background: black">';
	$data .= '		<div id="greenbit" style="width: <?php echo $percent; ?>px; background: green; height: 40px">&nbsp;</div>';
	$data .= '	</div>';
	$data .= '	<div id="marker" style="float: left; padding: 5px; valign: middle; width: 40px;">'.$percent.'%</div>';
	$data .= '</div>';
	return $data;
}

// Meta Refresh
function metaRefresh($url,$delay=1) {
	return '<meta HTTP-EQUIV="refresh" content="'.$delay.';url='.$url.'">';
}


/**
 * Generate a user agent string
 * @param boolean Mask the user agent as Mozilla or Joomla!
 * @return string a user agent string
 */
function generateUAString($mask=true)
{
	$version = new JVersion();
	$lang =& JFactory::getLanguage();
	$parts = Array();
	if($mask) {
		$parts[] = 'Mozilla/5.0';
	} else {
		$parts[] = 'Joomla!';
	}
	$parts[] = '(Joomla; PHP; '. PHP_OS .'; '. $lang->getTag() .'; rv:1.9.1)';
	$parts[] = 'Joomla/'. $version->getShortVersion();
	$parts[] = 'JUpdateMan/'. getComponentVersion();
	return implode(' ', $parts);
}

function getComponentVersion()
{
	jimport('joomla.application.helper');
	$file = JApplicationHelper::parseXMLInstallFile(JPATH_COMPONENT_ADMINISTRATOR . DS . 'jupdateman.xml');
	if($file) {
		return $file['version'];
	}
	else
	{
		static $warned = false;
		if(!$warned)
		{
			$app =& JFactory::getApplication();
			$app->enqueueMessage('Fallback component version used!');
			$warned = true;
		}
		return '1.5.1'; // fallback call
	}
}

/**
 * Replacement for jimport that falls back to jimport
 */
function juimport($path)
{
	// attempt to load the path locally but...
	// unfortunately 1.5 doesn't check the file exists before including it so we mask it
	$res = JLoader::import( $path, dirname( __FILE__ ).DS.'libraries' );
	if(!$res) {
		// fall back when it doesn't work
		return jimport($path);
	}
	return $res;
}
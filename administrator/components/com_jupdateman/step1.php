<?php
/**
 * Joomla! Upgrade Helper
 * Step 1 - Download XML update file and display download options
 */
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

$v = new JVersion();
$version = $v->getShortVersion();

$url = "http://jsitepoint.com/update/packages/joomla/update.xml";

$config =& JFactory::getConfig();
$tmp_path = $config->getValue('config.tmp_path');

$params =& JComponentHelper::getParams('com_jupdateman');




$target = $tmp_path . DS . 'jupgrader.xml';

$cached_update = $params->get('cached_update', 0);

if($cached_update) {
	if(!file_exists($target)) {
		HTML_jupgrader::showError( 'Missing update file. Please <a href="'. $url .'" target="_blank">download the update definition file</a> and put it into your temporary directory as "jupgrader.xml".<br />Target Path: '. $target);
		return false;
	}
} else {
	$result = downloadFile($url,$target);
	if(is_object( $result )) {
		HTML_jupgrader::showError( 'Download Failed: '. $result->message . '('. $result->number . ')' );
		return false;
	}
}

if(!file_exists($target)) {
	HTML_jupgrader::showError( 'Update file does not exist: '. $target );
}

// Yay! file downloaded! Processing time :(
$xmlDoc = new JSimpleXML();

if (!$xmlDoc->loadFile( $target )) {
	HTML_jupgrader::showError( 'Parsing XML Document Failed!' );
	return false;
}

//$root = &$xmlDoc->documentElement;
$root = &$xmlDoc->document;

if ($root->name() != 'update') {
	HTML_jupgrader::showError( 'Parsing XML Document Failed: Not an update definition file!' );
	return false;
}
$rootattributes = $root->attributes();
$latest = $rootattributes['release'];
if($latest == $version) {
	echo "<p>No updates were found. <a href='index.php?option=com_jupdateman&task=step2&target=full'>Force full update &gt;&gt;&gt;</a></p><br /><br /><p>Please check again later or watch <a href='http://www.joomla.org' target='_blank'>www.joomla.org</a></p>";
	echo '</div>';
	return true;
} elseif(version_compare($latest, $version, '<')) {
	echo "<p>You are running a greater version of Joomla! than what is available for download.</p><br /><br />";
	echo "<p>Please check <a href='http://www.joomla.org' target='_blank'>www.joomla.org</a> for release information.</p>";
	echo '</div>';
	return true;
}

$updater = $root->getElementByPath('updater', 1);
if(!$updater) {
	HTML_jupgrader::showError( 'Failed to get updater element. Possible invalid update!');
	return false;
}

$updater_attributes = $updater->attributes();

$session =& JFactory::getSession();
$session->set('jupdateman_updateurl', $updater->data());

if(version_compare($updater_attributes['minimumversion'], getComponentVersion(), '>')) 
{
	echo '<p>Current updater version is lower than minimum version for this update.</p>';
	echo '<p>Please update this extension. This can be attempted automatically or you can download the update and install it yourself.</p>';
	echo '<ul>';
	echo '<li><a href="index.php?option=com_jupdateman&task=autoupdate">Automatically update &gt;&gt;&gt;</a></li>';
	echo '<li><a target="_blank" href="'. $updater->data() .'">Download package and install manually (new window) &gt;&gt;&gt;</a></li>';
	echo '</ul>';
	return false;
}

if(version_compare($updater_attributes['currentversion'], getComponentVersion(), '>')) 
{
	echo '<p>An update ('. $updater_attributes['currentversion'] .') is available for this extension. You can <a href="index.php?option=com_jupdateman&task=autoupdate">update automatically</a> or <a target="_blank" href="'. $updater->data() .'">manually download</a> and install the update.</p>';
}

echo "<p>You are currently running $version. The latest release is currently $latest. Please select a download:</p>";
$fulldownload = '';
$patchdownload = '';

// Get the full package
$fullpackage  				= $root->getElementByPath( 'fullpackage', 1 );
$fullpackageattr 			= $fullpackage->attributes();
$fulldetails 				= new stdClass();
$fulldetails->url 			= $fullpackageattr['url'];
$fulldetails->filename 		= $fullpackageattr['filename'];
$fulldetails->filesize 		= $fullpackageattr['filesize'];
$fulldetails->md5			= $fullpackageattr['md5'];

// Find the patch package
$patches_root = $root->getElementByPath( 'patches', 1 );
if (!is_null( $patches_root ) ) {
	// Patches :D
	$patches = $patches_root->children();
	if(count($patches)) {
		// Many patches! :D
		foreach($patches as $patch) {
			$patchattr = $patch->attributes();
			if ($patchattr['version'] == $version) {
				$patchdetails->url = $patchattr['url'];
				$patchdetails->filename = $patchattr['filename'];
				$patchdetails->filesize = $patchattr['filesize'];
				$patchdetails->md5		= $patchattr['md5'];
				break;
			}
		}

	}
}

$message_element = $root->getElementByPath('message');
if($message_element) {
	$message = $message_element->data();
	if(strlen($message)) {
		echo '<p style="background: lightblue; padding: 5px; spacing: 5px; border: 1px solid black;"><b>Update Message:</b><br /> '. $message.'</p>';
	}
}
$session->set('jupdateman_fullpackage', $fulldetails);
$session->set('jupdateman_patchpackage', $patchdetails);
?>
<ul>
	<li><a
		href="index.php?option=com_jupdateman&task=step2&target=full">Full
	Package</a> (<?php echo round($fulldetails->filesize/1024/1024,2) ?>MB)<?php
	if($cached_update && !file_exists($tmp_path.DS.$fulldetails->filename)) {
		echo ' - <a href="'. $fulldetails->url .'" target="_blank">Download file and upload to your temporary directory first</a>';
	}
	?></li>
	<?php if($patchdetails) { ?>
	<li><a
		href="index.php?option=com_jupdateman&task=step2&target=patch">Patch
	Package</a> (<?php echo round($patchdetails->filesize/1024/1024,2) ?>MB)<?php
	if($cached_update && !file_exists($tmp_path.DS.$patchdetails->filename)) {
		echo ' - <a href="'. $patchdetails->url .'" target="_blank">Download file and upload to your temporary directory first</a>';
	}
	?></li>
	<?php } ?>
</ul>
<p>Note: Patch package only contains changed files and should be fine
for most upgrades. Major upgrades (e.g. 1.5.x to 1.6) will probably
require a full package.</p>
<?php if($cached_update) : ?>
	<p style="font-weight:bold">Note: You are using cached update mode. You will need to upload the update files to your temporary directory before continuing.</p>
	<p>Your temporary directory: <span style="font-style:italic"><?php echo $tmp_path ?></span></p>
	<?php
endif;

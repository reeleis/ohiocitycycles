<?php
/**
 * JUpdateMan Main Model
 *
 * Main display and listing model
 *
 * PHP4/5
 *
 * Created on Sep 28, 2007
 *
 * @package JUpdateMan
 * @author Sam Moffatt <pasamio@gmail.com>
 * @license GNU/GPL http://www.gnu.org/licenses/gpl.html
 * @copyright 2009 Sam Moffatt
 * @version SVN: $Id:$
 * @see JoomlaCode Project: http://joomlacode.org/gf/project/pasamioprojects
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );
jimport( 'joomla.filesystem.file');
jimport( 'joomla.filesystem.folder');
jimport( 'joomla.installer.helper');
jimport( 'joomla.installer.installer');

/**
 * Main Model
 *
 * @package    JUpdateMan
 */
class JUpdateManModelJUpdateMan extends JModel
{

	function autoupdate() {
		$update = $this->parseXMLFile();
		$config =& JFactory::getConfig();
		$tmp_dest = $config->getValue('config.tmp_path');
		if(!is_object($update)) {
			// parseXMLFile will have set a message hopefully
			//$this->setState('message', 'XML Parse failed');
			return false;
		} else {
			$destination = $tmp_dest.DS.'com_jupdateman_auto.tgz';
			$download = downloadFile($update->updaterurl, $destination);
			if($download !== true) {
				$this->setState('message', $download->error_message);
				return false;
			} else {
				$package = JInstallerHelper::unpack($destination);
				if(!$package) {
					$this->setState('message', 'Unable to find install package');
					return false;
				}
				$installer =& JInstaller::getInstance();

				// Install the package
				if (!$installer->install($package['dir'])) {
					// There was an error installing the package
					$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Error'));
					$result = false;
				} else {
					// Package installed sucessfully
					$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Success'));
					$result = true;
				}

				// Grab the application
				$mainframe =& JFactory::getApplication();
				// Set some model state values
				$mainframe->enqueueMessage($msg);
				$this->setState('name', $installer->get('name'));
				$this->setState('result', $result);
				$this->setState('message', $installer->message);
				$this->setState('extension.message', $installer->get('extension.message'));

				// Cleanup the install files
				if (!is_file($package['packagefile'])) {
					$config =& JFactory::getConfig();
					$package['packagefile'] = $config->getValue('config.tmp_path').DS.$package['packagefile'];
				}

				JInstallerHelper::cleanupInstall($package['packagefile'], $package['extractdir']);

				return $result;
			}
		}
	}

	function getUpdatePackage() {
		$update = $this->parseXMLFile();
		return $update->updaterurl;
	}

	function parseXMLFile($filename=null) {
		static $updates = Array();

		if(array_key_exists($filename, $updates)) {
			return $updates[$filename];
		}

		$v = new JVersion();
		$version = $v->getShortVersion();


		$update = new stdClass();

		// Yay! file downloaded! Processing time :(
		$xmlDoc = new JSimpleXML();

		$config =& JFactory::getConfig();
		$tmp_path = $config->getValue('config.tmp_path');

		if(is_null($filename)) {
			$filename = $tmp_path.DS.'jupgrader.xml';
		}

		if (!$xmlDoc->loadFile( $filename )) {
			$this->setState('message', 'File load failed: '. $filename);
			return false;
		}

		//$root = &$xmlDoc->documentElement;
		$root = &$xmlDoc->document;

		if ($root->name() != 'update') {
			$this->setState('message', 'Parsing XML Document Failed: Not an update definition file!');
			return false;
		}

		$rootattributes = $root->attributes();

		$update->release = $rootattributes['release'];

		$updater = $root->getElementByPath('updater', 1);
		if(!$updater) {
			$this->setState('message', 'Failed to get updater element. Possible invalid update!');
			return false;
		}

		$updater_attributes = $updater->attributes();

		$update->updaterurl = $updater->data();
		$update->minver = $updater_attributes['minimumversion'];
		$update->curver = $updater_attributes['currentversion'];

		// Get the full package
		$fullpackage  				= $root->getElementByPath( 'fullpackage', 1 );
		$fullpackageattr 			= $fullpackage->attributes();
		$fulldetails 				= new stdClass();
		$fulldetails->url 			= $fullpackageattr['url'];
		$fulldetails->filename 		= $fullpackageattr['filename'];
		$fulldetails->filesize 		= $fullpackageattr['filesize'];

		$update->fullpackage = clone($fulldetails);

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
						break;
					}
				}
			}
		}
		
		$update->patchpackage = clone($patchdetails);
		$updates[$filename] = clone($update); // keep an original copy
		return $update;
	}
}


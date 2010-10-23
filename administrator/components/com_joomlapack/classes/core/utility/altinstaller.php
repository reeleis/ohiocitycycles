<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		$Id$
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @since		1.2.1
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE . '/includes/domit/xml_domit_lite_include.php' );

/**
 * Manages the collection of alternative installers. Also gives information on the currently
 * loaded installer.
 */
class JoomlapackAltInstaller {
	/** @var string Short name of the installer */
	var $Name;

	/** @var string Package filename, wihout path */
	var $Package;

	/** @var string List of installer files, to be passed as a fragment to the packer part */
	var $fileList;

	/** @var string Dump mode for the SQL data (split, one) */
	var $SQLDumpMode;

	/** @var string Filename of the unified or table definition dump, relative to installer root */
	var $BaseDump;

	/** @var string Filename of the data dump, relative to installer root */
	var $SampleDump;

	/**
	* Loads a definition file.
	* @param string $file The name of the file you want to load. Relative to 'installers' directory.
	* @return boolean True if it has loaded the file successfuly
	*/
	function loadDefinition( $file ){
		// Instanciate new parser object
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		// Load XML file
		if (!$xmlDoc->loadXML( JPATH_COMPONENT_ADMINISTRATOR.DS.'assets'.DS.'installers'.DS.$file , false, true ))
		{
			return false;
		}
		$root = &$xmlDoc->documentElement;

		// Check if it is a valid description file
		if ($root->getTagName() != 'jpconfig') {
			return false;
		} elseif ($root->getAttribute( 'type' ) != 'installpack' ) {
			return false;
		}

		// Set basic elements
		$e = &$root->getElementsByPath('name', 1);
		$this->Name = $e->getText();
		$e = &$root->getElementsByPath('package', 1);
		$this->Package = $e->getText();
		$sqlDumpRoot = &$root->getElementsByPath('sqldump', 1);
		$this->SQLDumpMode = $sqlDumpRoot->getAttribute( 'mode' );

		// Get SQL filenames
		if ($sqlDumpRoot->hasChildNodes()) {
			$e = $sqlDumpRoot->getElementsByPath('basedump', 1);
			if ( !is_null($e) ) {
				$this->BaseDump = $e->getText();
			} else {
				$this->BaseDump = "";
			}

			$e = $sqlDumpRoot->getElementsByPath('sampledump', 1);
			if ( !is_null($e) ) {
				$this->SampleDump = $e->getText();
			} else {
				$this->SampleDump = "";
			}
		}

		// Get file list
		$this->fileList = array();
		$flRoot = &$root->getElementsByPath('filelist',1);
		if (!is_null($flRoot)) {
			if ($flRoot->hasChildNodes()) {
				$files = $flRoot->childNodes;
				foreach($files as $file){
					$this->fileList[] = $file->getText();
				}
			}
		}

		return true;
	}

	/**
	* Loads all installer definition files
	* @return array An array of the installer names and packages
	*/
	function loadAllDefinitions() {
		jpimport('classes.engine.lister.default');
		$FS = new JoomlapackListerAbstraction;

		$defs = array();

		$fileList = $FS->getDirContents(JPATH_COMPONENT_ADMINISTRATOR.DS.'assets'.DS."installers".DS, "*.xml");
		
		foreach($fileList as $file){
			$baseName = basename( $file );
			if ($this->loadDefinition( $baseName )) {
				$newDef['name'] = $this->Name;
				$newDef['package'] = $this->Package;
				$newDef['meta'] = $baseName;
				$defs[] = $newDef;
			}
		}

		return $defs;
	}
}
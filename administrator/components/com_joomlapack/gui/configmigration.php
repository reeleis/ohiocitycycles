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

if(!defined('JPEXPORTVERSION')) define('JPEXPORTVERSION','1.0');

class JoomlapackPageConfigmigration
{
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageConfigmigration
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageConfigmigration();
		}
		
		return $instance;
	}	
	
	function echoHTML()
	{
		$task = JoomlapackAbstraction::getParam('task', 'panel');
		switch($task)
		{
			case 'export':
				$this->_echoExport();
				break;
				
			case 'import':
				$this->_echoImport();
				break;
				
			case 'upload':
				$this->_echoUpload();
				break;
				
			case 'fix':
				$this->_echoFix();
				break;
				
			default:
			case 'panel':
				$this->_echoPanel();
				break;
		}
	}
	
	function _echoPanel()
	{
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_CONFIGMIGRATE') );
		
		$cpanel = new JoomlapackCPanelHTML();
		$cpanel->addItem( JoomlapackAbstraction::JPLink('configmigrate', 'export', true), 'cmexport', JoomlapackLangManager::_('CONFIGMIGRATE_EXPORT') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('configmigrate', 'import'), 'cmimport', JoomlapackLangManager::_('CONFIGMIGRATE_IMPORT') );
		$cpanel->addItem( JoomlapackAbstraction::JPLink('configmigrate', 'fix'), 'cmfix', JoomlapackLangManager::_('CONFIGMIGRATE_FIXFILTERS') );
		$cpanelHTML = $cpanel->getHTML();
		
		$desc = "<p>".JoomlapackLangManager::_('CONFIGMIGRATE_DESC1')."<br/>" .
				JoomlapackLangManager::_('CONFIGMIGRATE_DESC2')."</p>";
		
		echo <<<ENDSNIPPET
		<table class="adminform">
			<tr>
				<td width="100%" valign="top">
					$cpanelHTML
				</td>
			</tr>
			<tr>
				<td>$desc</td>
			</tr>
			</table>		
ENDSNIPPET;
		
	}
	
	function _echoExport()
	{
		if(!defined('JPCR')) define('JPCR', "\n");

		$db = JoomlapackAbstraction::getDatabase();
		$configuration =& JoomlapackConfiguration::getInstance();
		
		$buffer = '<?xml version="'.JPEXPORTVERSION.'" encoding="utf-8"?>'.JPCR;
		$buffer .= '<jpexport version="1.0">'.JPCR;
		
		// Dump configuration values
		$buffer .= "\t".'<config>'.JPCR;
		$props = $configuration->getProperties();
		foreach($props as $key => $value)
		{
			if( $key == 'AltInstaller' ) continue;
			$buffer .= "\t\t<$key><![CDATA[" . serialize($value) . "]]></$key>\n";
		}
		$buffer .= "\t".'</config>'.JPCR;
		
		// Dump inclusion filters
		$buffer .= "\t".'<inclusion>'.JPCR;
		$sql = 'SELECT * FROM #__jp_inclusion';
		$db->setQuery($sql);
		$data = $db->loadAssocList();
		foreach($data as $entry)
		{
			$buffer .= "\t\t<entry><![CDATA[" . serialize($entry) . "]]></entry>\n";
		}
		$buffer .= "\t".'</inclusion>'.JPCR;
		
		// Dump exclusion filters
		$buffer .= "\t".'<exclusion>'.JPCR;
		$sql = 'SELECT * FROM #__jp_exclusion';
		$db->setQuery($sql);
		$data = $db->loadAssocList();
		foreach($data as $entry)
		{
			$buffer .= "\t\t<entry><![CDATA[" . serialize($entry) . "]]></entry>\n";
		}
		$buffer .= "\t".'</exclusion>'.JPCR;
		
		// Finish up the document
		$buffer .= '</jpexport>'.JPCR;
		
    	@ob_end_clean(); // In case some braindead mambot spits its own HTML despite no_html=1
    	header('Content-type: application/xml');
    	header('Content-Disposition: attachment; filename="joomlapack_configuration.xml"');
    	echo $buffer;
		
	}
	
	function _echoImport()
	{
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_CONFIGMIGRATE') );
		
		$url = JoomlapackAbstraction::JPLink('configmigrate','upload');
		$introduction = "<p>".JoomlapackLangManager::_('CONFIGMIGRATE_IMPORTINTRO').
						"<br/>".JoomlapackLangManager::_('CONFIGMIGRATE_IMPORTWARNING')."</p>";
		
		$prompt = JoomlapackLangManager::_('CONFIGMIGRATE_FILEPROMPT');
		$send = JoomlapackLangManager::_('CONFIGMIGRATE_SEND');
		
		echo <<<ENDSNIPPET
		<form enctype="multipart/form-data" action="$url" method="POST">
			<table class="adminform">
			<tr>
				<td>
					$introduction
				</td>
			</tr>
			<tr>
				<td>
					$prompt<input name="userfile" type="file" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="$send" />
				</td>
			</tr>
		    </table>
		</form>
ENDSNIPPET;
	}
	
	function _echoUpload()
	{
		$jpconfiguration =& JoomlapackConfiguration::getInstance();
		$db = JoomlapackAbstraction::getDatabase();

		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_CONFIGMIGRATE') );
		
		/*
		 * Check for problematic uploads
		 */
		
		if(count($_FILES) == 0)
		{
			// Handle no uploaded file
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_NOUPLOADED').'</p>';
			return;
		}
		
		if(!isset($_FILES['userfile']))
		{
			// Handle illegal upload key
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_ILLEGALKEY').'</p>';
			return;
		}
		
		$fileDescriptor = $_FILES['userfile'];

		if($fileDescriptor['size'] < 1)
		{
			// Handle zero length file
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_ZEROLENGTH').'</p>';
			return;
		}

		if($fileDescriptor['error'] != 0)
		{
			// Handle error in upload
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_UPLOAD').'</p>';
			return;
		}
		
		// Get the file data
		$fileData = file_get_contents($fileDescriptor['tmp_name']);
		
		// Try to get a DOM document instance
		require_once( JPATH_SITE.DS.'includes'.DS.'domit'.DS.'xml_domit_lite_include.php' );
		$domDoc = new DOMIT_Lite_Document();
		$domDoc->resolveErrors( true );		
		if ( !$domDoc->parseXML($fileData, false, true) ) {
			// Handle wrong file type
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_WRONGFORMAT').'</p>';
			return; 
		}
		
		// Check we have a correct XML root node
		$root =& $domDoc->documentElement;
		if($root->nodeName != 'jpexport')
		{
			// Handle wrong XML format
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_WRONGXML').'</p>';
			return;
		}
		
		// Check export version
		$version = $root->attributes['version'];
		if(version_compare(JPEXPORTVERSION, $version) < 0)
		{
			// Handle future version
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_FUTUREVER').'</p>';
			return;
		}
		
		// Check for the existence of the config, incusion and exclusion nodes
		$config		=& $root->getElementsByPath('config', 1);
		$inclusion	=& $root->getElementsByPath('inclusion', 1);
		$exclusion	=& $root->getElementsByPath('inclusion', 1);
		
		if(is_null($config) || is_null($inclusion) || is_null($exclusion))
		{
			echo '<h1>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERROR').'</h1>';
			echo '<p>'.JoomlapackLangManager::_('CONFIGMIGRATE_ERR_NOREQNODES').'</p>';
			return;
		}
		
		// Process configuration
		if($config->hasChildNodes())
		{
			foreach($config->childNodes as $node)
			{
				$key = $node->nodeName;
				$value = unserialize($node->getText());
				$jpconfiguration->set($key, $value);	
			}			
		}
		$jpconfiguration->SaveConfiguration();
		
		// Process inclusion filters
		if($inclusion->hasChildNodes())
		{
			// Nuke old inclusion filters
			$sql = 'TRUNCATE TABLE #__jp_inclusion';
			$db->setQuery($sql);
			if(!$db->query())
			{
				echo $db->ErrorMsg();
				return;
			}
			
			// Import inclusion filters
			foreach($inclusion->childNodes as $node)
			{
				$key = $node->nodeName;
				$data = $node->getText();
				$sql	= 'INSERT INTO #__jp_inclusion ('.
								$db->nameQuote('id').','.
								$db->nameQuote('class').','.
								$db->nameQuote('value').') '.
							'VALUES ('.
								$db->Quote($data['id']).', '.
								$db->Quote($data['class']).', '.
								$db->Quote($data['value']).')';
				$db->setQuery($sql);
				if(!$db->query())
				{
					echo $db->ErrorMsg();
					return;
				}				
				//echo $key . ' => '; var_dump($data); echo "<br/>";	
			}			
		}
		
			// Process exclusion filters
		if($exclusion->hasChildNodes())
		{
			// Nuke old inclusion filters
			$sql = 'TRUNCATE TABLE #__jp_exclusion';
			$db->setQuery($sql);
			if(!$db->query())
			{
				echo $db->ErrorMsg();
				return;
			}
			
			// Import inclusion filters
			foreach($exclusion->childNodes as $node)
			{
				$key = $node->nodeName;
				$data = $node->getText();
				$sql	= 'INSERT INTO #__jp_exclusion ('.
								$db->nameQuote('id').','.
								$db->nameQuote('class').','.
								$db->nameQuote('value').') '.
							'VALUES ('.
								$db->Quote($data['id']).', '.
								$db->Quote($data['class']).', '.
								$db->Quote($data['value']).')';
				$db->setQuery($sql);
				if(!$db->query())
				{
					echo $db->ErrorMsg();
					return;
				}				
				//echo $key . ' => '; var_dump($data); echo "<br/>";	
			}			
		}
		
		echo JoomlapackLangManager::_('CONFIGMIGRATE_IMPORT_OK');
	}
	
	function _echoFix()
	{
		$jpconfiguration =& JoomlapackConfiguration::getInstance();
		$db = JoomlapackAbstraction::getDatabase();

		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_CONFIGMIGRATE') );
		
		// Catch the "nothing to do" case
		if($jpconfiguration->get('siteRoot') == JPATH_SITE)
		{
			echo JoomlapackLangManager::_('CONFIGMIGRATE_NOFIXREQUIRED');
			return;
		}
		
		// Sometimes, it is possible that the siteRoot configuration value is not set
		// (e.g. manually upgrading from an older version, keeping the config xml file).
		// This will fix it
		if(is_null($jpconfiguration->get('siteRoot')))
		{
			echo JoomlapackLangManager::_('CONFIGMIGRATE_NOROOTSTORED');
			$jpconfiguration->set('siteRoot', JPATH_SITE);
			$jpconfiguration->SaveConfiguration();
			return;
		}
		
		// A genuine case of site location mismatch. Let's take a look at it.
		$oldPath = JoomlapackAbstraction::TranslateWinPath($jpconfiguration->get('siteRoot'));
		$newPath = JoomlapackAbstraction::TranslateWinPath(JPATH_SITE);
		
		$sql = 'SELECT * FROM '.$db->nameQuote('#__jp_exclusion');
		$db->setQuery($sql);
		$temparray = $db->loadAssocList();
		foreach($temparray as $row)
		{
			$value = $row['value'];
			if(strstr($value,$oldPath))
			{
				$value = str_replace($oldPath, $newPath, $value);
				$sql = 'UPDATE '.$db->nameQuote('#__jp_exclusion').' SET '.
					$db->nameQuote('value').' = '.$db->Quote($value).
					' WHERE '.$db->nameQuote('id').' = '.$db->Quote($row['id']);
				$db->setQuery($sql);
				$db->query();
			}
		}
		echo JoomlapackLangManager::_('CONFIGMIGRATE_FIXED');
	}
}
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

// Ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

/**
 * Provides common HTML rendering features
 *
 */
class JoomlapackCommonHTML
{
	/**
	 * Returns an administration page header
	 *
	 * @param string $pageTitle The title of the page
	 * @return string
	 */
	function getAdminHeadingHTML( $pageTitle = null )
	{
		$myTitle = JoomlapackLangManager::_('COMMON_JPTITLE');
		if( is_null( $pageTitle ) ) {
			$pageTitle = $myTitle;  		
		}
		
		$homeButton = JoomlapackCommonHTML::getImageURI('home');
		$componentURI = JoomlapackAbstraction::JPLink('main');
		$homeAlt = JoomlapackLangManager::_('CPANEL_HOME');
		
		if( !defined('_JEXEC') )
		{
			// Joomla! 1.0.x-style headings
			$out = <<<ENDMARK
				<table class="adminheading">
					<thead>
						<tr>
							<th class="info" nowrap rowspan="2">
								$pageTitle
							</th>
							<th nowrap align="right" width="40" style="background: none;">
								<a href="$componentURI"><img src="$homeButton" border="0" width="32" height="32" alt="$homeAlt" title="$homeAlt" /></a>
							</th>
							</tr>
					</thead>
				</table>
	
ENDMARK;
		} else {
			// Joomla! 1.5.x-style headings
			$out = <<<ENDMARK
				<table class="adminheading" style="width:100%">
					<tr>
						<td nowrap><h2>$pageTitle</h2>
						<td nowrap align="right" width="40" style="text-align: right;">
							<a href="$componentURI"><img src="$homeButton" border="0" width="32" height="32" alt="$homeAlt" title="$homeAlt" /></a>
						</td>
					</tr>
				</table>
ENDMARK;
		}

		return $out;
	}
	
	/**
	 * Returns HTML for colored (red/green) display of writable status 
	 *
	 * @param mixed $CurrentStatus The current status of the item in question
	 * @param mixed $DesiredStatus The status considered good for the item in question
	 * @param string $goodKey The translation key for the string to display if the status is good
	 * @param string $errorKey The translation key for the string to display if the status is not good
	 * @param string $translationSection The translation section to look for the key in.
	 * @return string
	 */
	function colorizeWriteStatus( $CurrentStatus, $DesiredStatus, $goodKey = 'writable', $errorKey = 'unwritable', $translationSection = 'common' ) {
	
		$isStatusGood = ($CurrentStatus === $DesiredStatus);
		$statusVerbal = $isStatusGood ? JoomlapackLangManager::_(strtoupper($translationSection).'_'.strtoupper($goodKey)) : JoomlapackLangManager::_(strtoupper($translationSection).'_'.strtoupper($errorKey));
		$class = $isStatusGood ? 'statusok' : 'statusnotok';
		$image = $isStatusGood ? 'ok_small' : 'error_small';
		
		$imageURL = JoomlapackCommonHTML::getImageURI( $image );
		
		return '<span class="' . $class . '"><img src="' . $imageURL . '" border="0" width="16" height="16" />' . $statusVerbal . '</span>';
	}
	
	function getImageURI( $imageName )
	{
		return JoomlapackAbstraction::SiteURI() . '/administrator/components/' . JoomlapackAbstraction::getParam('option', 'com_joomlapack') . '/assets/images/' . $imageName . '.png';
	}

}

/**
 * Provides a Control Panel rendering class
 *
 */
class JoomlapackCPanelHTML
{
	/**
	 * The array holding the control panel items
	 *
	 * @var array
	 */
	var $items = array();
	
	/**
	 * Public constructor
	 *
	 * @return JoomlapackCPanelHTML
	 */
	function JoomlapackCPanelHTML()
	{
		
	}
	
	/**
	 * Adds a control panel item to the collection
	 *
	 * @param string $link The URL to visit when clicked
	 * @param string $image The name of the image to display, minus the path and .png extensions
	 * @param string $text The label beneath the image
	 * @param string $onclick A JavaScript command to execute upon clicking (overrides the $link URL)
	 */
	function addItem( $link, $image, $text, $onclick = null )
	{
		$myItem = array(
			'link' => $link,
			'image' => $image,
			'text' => $text,
			'onclick' => $onclick
		);
		
		$this->items[] = $myItem;
	}
	
	function getHTML()
	{
		$out = '<div id="cpanel">';
		foreach( $this->items as $item )
		{
			$out .= $this->_getItemHTML( $item );			
		}
		$out .= "</div>";
		return $out;
	}
	
	function _getItemHTML( $item )
	{
		if( !is_null( $item['onclick'] ) )
		{
			$anchorTags = 'onclick="' . $item['onclick'] . '"';
		} else {
			$anchorTags = 'href="' . $item['link'] . '"';
		}
		
		$imageHTML = JoomlapackCommonHTML::getImageURI($item['image']);
		$imageHTML = '<img src="' . $imageHTML . '" border="0" width="32" height="32" />';
		
		$text = $item['text'];
		
		$out = <<<ENDOFHTML
			<div style="float:left;">
				<div class="icon">
					<a $anchorTags >$imageHTML<br/>
					<span>$text</span>
					</a>
				</div>
			</div>
ENDOFHTML;

		return $out;
	}
}
<?php
defined('_JEXEC') or die;

/**
 * @package	Linkr
 * @copyright	Copyright (C) 2008 Montreal News. All Rights Reserved.
 * @license		GNU/GPL, see LICENSE.php
 */

jimport( 'joomla.plugin.plugin' );

/**
 * Article link button
 *
 * @author Frank <francisamankrah@gmail.com>
 * @package Editors-xtd
 * @since 1.5
 */
class plgButtonLinkr extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param 	object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgButtonLinkr( &$subject, $config ) {
		parent::__construct( $subject, $config );
	}

	/**
	 * Display the button
	 *
	 * @return array A two element array of ( imageName, textToInsert )
	 */
	function onDisplay( $name )
	{
		JHTML::_( 'behavior.modal' );
		
		$doc 		= & JFactory::getDocument();
		$lang		= & JFactory::getLanguage();
		
		// Button image
		$base		= JURI::root();
		$inAdmin	= JString::stristr( $base, 'administrator/' ) !== false;
		$assets		= $inAdmin ? 'components/com_linkr/assets/' : 'administrator/components/com_linkr/assets/';
		$assets		= $base . $assets;
		$button		= $lang->get( 'rtl', 0 ) == 1 ? $assets .'button-rtl.png' : $assets .'button.png';
		$doc->addStyleDeclaration( '.button2-left .linkr{background:url('. $button .') 100% 0 no-repeat;}' );
		
		$link		= 'index.php?option=com_linkr&view=articles&tmpl=component&e_name='. $name;
		$button		= new JObject();
		$button->set( 'modal',	true );
		$button->set( 'link',	$link );
		$button->set( 'text',	JText::_( 'Link Article' ) );
		$button->set( 'name',	'linkr' );
		$button->set( 'options',"{handler:'iframe',size:{x:570,y:350}}" );
		
		return $button;
	}
}
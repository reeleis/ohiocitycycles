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

class TOOLBAR_jpack {
	function _CONFIG() {
		if( !defined('_JEXEC') )
		{
			mosMenuBar::startTable();
			mosMenuBar::save();
			mosMenuBar::spacer();
			mosMenuBar::apply();
			mosMenuBar::spacer();
			mosMenuBar::cancel();
			mosMenuBar::endTable();
		}
		else
		{
			JToolBarHelper::save();
			JToolBarHelper::apply();
			JToolBarHelper::cancel();
		}
	}

	function MULTI_EDIT()
	{
		if( !defined('_JEXEC') )
		{
			mosMenuBar::startTable();
			mosMenuBar::save();
			mosMenuBar::spacer();
			mosMenuBar::cancel();
			mosMenuBar::endTable();
		} else {
			JToolBarHelper::save();
			JToolBarHelper::cancel();
		}
	}
	
	function MULTI_VIEW()
	{
		if( !defined('_JEXEC') )
		{
			mosMenuBar::startTable();
			mosMenuBar::addNew('new');
			mosMenuBar::endTable();
		} else {
			JToolBarHelper::addNew('new');
		}
	}
}
<?php
/**
 * @version 0.9 $Id: router.php 507 2008-01-03 15:48:34Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

function EventListBuildRoute(&$query)
{
	$segments = array();

	if(isset($query['view']))
	{
		$segments[] = $query['view'];
		unset($query['view']);
	}
/*
	if(isset($query['cid']))
	{
		$segments[] = $query['cid'];
		unset($query['cid']);
	};
*/
	if(isset($query['id']))
	{
		$segments[] = $query['id'];
		unset($query['id']);
	};

	if(isset($query['task']))
	{
		$segments[] = $query['task'];
		unset($query['task']);
	};

	if(isset($query['returnid']))
	{
		$segments[] = $query['returnid'];
		unset($query['returnid']);
	};

	if(isset($query['returnview']))
	{
		$segments[] = $query['returnview'];
		unset($query['returnview']);
	};

	return $segments;
}

function EventListParseRoute($segments)
{
	$vars = array();

	//var_dump($segments);

	//Handle View and Identifier
	switch($segments[0])
	{
		case 'categoryevents':
		{
			$id = explode(':', $segments[1]);
			$vars['id'] = $id[0];
			$vars['view'] = 'categoryevents';

			$count = count($segments);
			if($count > 2) {
				$vars['task'] = $segments[2];
			}

		} break;

		case 'details':
		{
			$id = explode(':', $segments[1]);
			$vars['id'] = $id[0];
			$vars['view'] = 'details';

		} break;

		case 'venueevents':
		{
			$id = explode(':', $segments[1]);
			$vars['id'] = $id[0];
			$vars['view'] = 'venueevents';

		} break;

		case 'editevent':
		{
			$count = count($segments);

			if($count == 3) {
				$vars['view'] = 'editevent';
				$vars['id'] = $segments[1];
				$vars['returnid'] = $segments[2];
			} else {
				$vars['view'] = 'editevent';
				$vars['returnview'] = $segments[1];
			}

		} break;

		case 'editvenue':
		{
			$count = count($segments);

			if($count == 3) {

				$vars['view'] = 'editvenue';
				$vars['id'] = $segments[1];
				$vars['returnid'] = $segments[2];

			} else {
				$vars['view'] = 'editvenue';
				$vars['returnview'] = $segments[1];
			}

		} break;

		case 'eventlist':
		{
			$vars['view'] = 'eventlist';

		} break;

		case 'categoriesdetailed':
		{
			$vars['view'] = 'categoriesdetailed';

		} break;

		case 'categories':
		{
			$vars['view'] = 'categories';

			$count = count($segments);
			if($count == 2) {
				$vars['task'] = $segments[1];
			}

		} break;

		case 'venues':
		{
			$vars['view'] = 'venues';

		} break;

	}

	return $vars;
}
?>
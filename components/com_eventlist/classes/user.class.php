<?php
/**
 * @version 0.9 $Id: user.class.php 507 2008-01-03 15:48:34Z schlu $
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

defined('_JEXEC') or die('Restricted access');

/**
 * Holds all authentication logic
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class ELUser {

	/**
	 * Checks access permissions of the user regarding on the groupid
	 *
	 * @author Christoph Lukes
	 * @since 0.9
	 *
	 * @param int $recurse
	 * @param int $level
	 * @return boolean True on success
	 */
	function validate_user ( $recurse, $level )
	{
		$user 		= & JFactory::getUser();

		//only check when user is logged in
		if ($user->get('id')) {

			$acl		= & JFactory::getACL();
			$superuser 	= ELUser::superuser();

			$groupid	= $user->get('gid');

			if ($recurse) {
				$recursec="RECURSE";
			} else {
				$recursec="NO_RECURSE";
			}

			//open for superuser or registered and thats all what is needed
			if ((( $level == -1 ) && ( $groupid > 0 )) || (( $superuser ) && ( $level != -2 ))) {
				return true;

			//if not proceed checking
			} else {

				if( $groupid == $level ) {
					//User has the needed groupid->ok
					return true;

				} else {

					if ($recursec=='RECURSE') {
						//Child group for this level?
						$group_childs=array();
						$group_childs=$acl->get_group_children( $level, 'ARO', $recursec );

						if ( is_array( $group_childs ) && count( $group_childs ) > 0) {

							//Childgroups exists than check if user belongs to one of it
							if ( in_array($groupid, $group_childs) ) {

								//User belongs to one of it -> ok
								return true;
							}
						}
					}
				}
			}
		//end logged in check
		}

		//oh oh, user has no permissions
		return false;
	}

	/**
	 * Checks if the user is allowed to edit an item
	 *
	 * @author Christoph Lukes
	 * @since 0.9
	 *
	 * @param int $allowowner
	 * @param int $ownerid
	 * @param int $recurse
	 * @param int $level
	 * @return boolean True on success
	 */
	function editaccess($allowowner, $ownerid, $recurse, $level)
	{
		$user		= & JFactory::getUser();

		$generalaccess = ELUser::validate_user( $recurse, $level );

		if ($allowowner == 1 && ( $user->get('id') == $ownerid && $ownerid != 0 ) ) {
			return true;
		} elseif ($generalaccess == 1) {
			return true;
		}
		return false;
	}

	/**
	 * Checks if the user is a superuser
	 * A superuser will allways have access if the feature is activated
	 *
	 * @since 0.9
	 */
	function superuser()
	{
		$user 		= & JFactory::getUser();
		$superuser 	= (JString::strtolower($user->get('usertype')) == 'administrator' || JString::strtolower($user->get('usertype')) == 'super administrator' );

		return $superuser;
	}

	/**
	 * Checks if the user has the privileges to use the wysiwyg editor
	 *
	 * We could use the validate_user method instead of this to allow to set a groupid
	 * Not sure if this is a good idea
	 *
	 * @since 0.9
	 */
	function editoruser()
	{
		$user 		= & JFactory::getUser();
		$editoruser = (JString::strtolower($user->get('usertype')) == 'editor' || JString::strtolower($user->get('usertype')) == 'publisher' || JString::strtolower($user->get('usertype')) == 'manager' || JString::strtolower($user->get('usertype')) == 'administrator' || JString::strtolower($user->get('usertype')) == 'super administrator' );

		return $editoruser;
	}

	/**
	 * Checks if the user is the owner of the event/venue
	 *
	 * @since 0.9
	 */
	function isOwner($id, $table)
	{
		//Check if user can edit events
		$db = JFactory::getDBO();
		$id = (int) $id;

		$query = 'SELECT created_by'
				. ' FROM #__eventlist_'.$table
				. ' WHERE id = '.$id
				;
		$db->setQuery( $query );
		$owner = $db->loadResult();

    	return $owner;
	}

	/**
	 * Checks if the user is a maintainer of a category
	 *
	 * @since 0.9
	 */
	function ismaintainer()
	{
		//lets look if the user is a maintainer
		$db 	= JFactory::getDBO();
		$user	= & JFactory::getUser();

		$query = 'SELECT g.group_id'
				. ' FROM #__eventlist_groupmembers AS g'
				. ' WHERE g.member = '.(int) $user->get('id')
				;
		$db->setQuery( $query );

		$catids = $db->loadResultArray();

		//no results, no maintainer
		if (!$catids) {
			return null;
		}

		$categories = implode(' OR c.groupid = ', $catids);

		//count the maintained categories
		$query = 'SELECT COUNT(id)'
				. ' FROM #__eventlist_categories'
				. ' WHERE published = 1'
				. ' AND groupid = '.$categories
				;
		$db->setQuery( $query );

		$maintainer = $db->loadResult();

		return $maintainer;
	}
}
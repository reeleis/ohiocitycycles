<?php
/**
 * @version 0.9 $Id: imagehandler.php 507 2008-01-03 15:48:34Z schlu $
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

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

/**
 * EventList Component Imageselect Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListModelImagehandler extends JModel
{
	function getState($property = null)
	{
		static $set;

		if (!$set) {
			$folder = JRequest::getVar( 'folder' );
			$this->setState('folder', $folder);

			$set = true;
		}
		return parent::getState($property);
	}

	/**
	 * Build imagelist
	 *
	 * @return array $list The imagefiles from a directory to display
	 * @since 0.9
	 */
	function getImages()
	{
		$list = $this->getList();
		return $list;
	}

	/**
	 * Build imagelist
	 *
	 * @return array $list The imagefiles from a directory
	 * @since 0.9
	 */
	function getList()
	{
		static $list;

		// Only process the list once per request
		if (is_array($list)) {
			return $list;
		}

		// Get folder from request
		$folder = $this->getState('folder');

		// Initialize variables
		$basePath = JPATH_SITE.DS.'images'.DS.'eventlist'.DS.$folder;

		$images 	= array ();

		// Get the list of files and folders from the given folder
		$fileList 	= JFolder::files($basePath);

		// Iterate over the files if they exist
		if ($fileList !== false) {
			foreach ($fileList as $file)
			{
				if (is_file($basePath.DS.$file) && substr($file, 0, 1) != '.' && strtolower($file) !== 'index.html') {
					$tmp = new JObject();
					$tmp->name = $file;
					$tmp->path = JPath::clean($basePath.DS.$file);
					$tmp->size = $this->_parseSize(filesize($tmp->path));

					$info = @getimagesize($tmp->path);
					$tmp->width		= @$info[0];
					$tmp->height	= @$info[1];
					//$tmp->type		= @$info[2];
					//$tmp->mime		= @$info['mime'];

					if (($info[0] > 60) || ($info[1] > 60)) {
						$dimensions = $this->_imageResize($info[0], $info[1], 60);
						$tmp->width_60 = $dimensions[0];
						$tmp->height_60 = $dimensions[1];
					} else {
						$tmp->width_60 = $tmp->width;
						$tmp->height_60 = $tmp->height;
					}

					$images[] = $tmp;

				}
			}
		}

		$list = $images;

		return $list;
	}

	/**
	 * Build display size
	 *
	 * @return array width and height
	 * @since 0.9
	 */
	function _imageResize($width, $height, $target)
	{
		//takes the larger size of the width and height and applies the
		//formula accordingly...this is so this script will work
		//dynamically with any size image
		if ($width > $height) {
			$percentage = ($target / $width);
		} else {
			$percentage = ($target / $height);
		}

		//gets the new value and applies the percentage, then rounds the value
		$width = round($width * $percentage);
		$height = round($height * $percentage);

		return array($width, $height);
	}

	/**
	 * Return human readable size info
	 *
	 * @return string size of image
	 * @since 0.9
	 */
	function _parseSize($size)
	{
		if ($size < 1024) {
			return $size . ' bytes';
		}
		else
		{
			if ($size >= 1024 && $size < 1024 * 1024) {
				return sprintf('%01.2f', $size / 1024.0) . ' Kb';
			} else {
				return sprintf('%01.2f', $size / (1024.0 * 1024)) . ' Mb';
			}
		}
	}
}
?>
<?php
/**
 * @version 0.9 $Id: output.class.php 521 2008-01-13 21:36:31Z schlu $
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
 * Holds the logic for all output related things
 *
 * @package Joomla
 * @subpackage EventList
 */
class ELOutput {

	/**
	* Writes footer. Official copyright! Do not remove!
	*
	* @author Christoph Lukes
	* @since 0.9
	*/
	function footer( )
	{
		echo 'EventList powered by <a href="http://www.schlu.net" target="_blank">schlu.net</a>';
	}

	/**
	* Writes Event submission button
	*
	* @author Christoph Lukes
	* @since 0.9
	*
	* @param int $Itemid The Itemid of the Component
	* @param int $dellink Access of user
	* @param array $params needed params
	* @param string $view the view the user will redirected to
	**/
	function submitbutton( $dellink, &$params, $view )
	{
		if ($dellink == 1) {

			JHTML::_('behavior.tooltip');

			if ( $params->get('icons') ) {
				$image = JHTML::_('image', 'components/com_eventlist/assets/images/submitevent.png', JText::_( 'DELIVER NEW EVENT' ) );
			} else {
				$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'DELIVER NEW EVENT' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
			}

			$link 		= 'index.php?view=editevent&returnview='.$view;
			$overlib 	= JText::_( 'SUBMIT EVENT TIP' );
			$output		= '<a href="'.JRoute::_($link).'" class="editlinktip hasTip" title="'.JText::_( 'DELIVER NEW EVENT' ).'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}

		return;
	}

	/**
	* Writes Archivebutton
	*
	* @author Christoph Lukes
	* @since 0.9
	*
	* @param int $oldevent Archive used or not
	* @param array $params needed params
	* @param string $task The current task
	* @param int $categid The cat id
	*/
	function archivebutton( $oldevent, &$params, $task = NULL, $categid = NULL )
	{

		if ( $oldevent == 2 ) {

			JHTML::_('behavior.tooltip');

			switch ($task) {
				case 'archive':

					if ( $params->get('icons') ) {
						$image = JHTML::_('image', 'components/com_eventlist/assets/images/eventlist.png', JText::_( 'SHOW EVENTS' ) );
					} else {
						$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'SHOW EVENTS' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
					}
					$overlib 	= JText::_( 'SHOW EVENTS TIP' );
					$link 		= JRoute::_( 'index.php' );
					$title 		= JText::_( 'SHOW EVENTS' );

					break;

				case 'catarchive':

					if ( $params->get('icons') ) {
						$image = JHTML::_('image', 'components/com_eventlist/assets/images/eventlist.png', JText::_( 'SHOW EVENTS' ) );
					} else {
						$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'SHOW EVENTS' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
					}
					$overlib 	= JText::_( 'SHOW EVENTS TIP' );
					$link 		= JRoute::_( 'index.php?view=categoryevents&id='.$categid );
					$title 		= JText::_( 'SHOW EVENTS' );

					break;

				default:

					if ( $params->get('icons') ) {
						$image = JHTML::_('image', 'components/com_eventlist/assets/images/archive_front.png', JText::_( 'SHOW ARCHIVE' ) );
					} else {
						$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'SHOW ARCHIVE' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
					}
					$overlib 	= JText::_( 'SHOW ARCHIVE TIP' );
					$link		= JRoute::_('index.php?view=categories&task=archive');
					$title 		= JText::_( 'SHOW ARCHIVE' );

					break;
			}
			$output = '<a href="'.$link.'" class="editlinktip hasTip" title="'.$title.'::'.$overlib.'">'.$image.'</a>';

			return $output;

		}
		return;
	}

	/**
	 * Creates the edit button
	 *
	 * @param int $Itemid
	 * @param int $id
	 * @param array $params
	 * @param int $allowedtoedit
	 * @param string $view
	 * @since 0.9
	 */
	function editbutton( $Itemid, $id, &$params, $allowedtoedit, $view)
	{

		if ( $allowedtoedit ) {

			JHTML::_('behavior.tooltip');

			switch ($view)
			{
				case 'editevent':
					if ( $params->get('icons') ) {
						$image = JHTML::_('image', 'components/com_eventlist/assets/images/calendar_edit.png', JText::_( 'EDIT EVENT' ) );
					} else {
						$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'EDIT EVENT' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
					}
					$overlib = JText::_( 'EDIT EVENT TIP' );
					$text = JText::_( 'EDIT EVENT' );
					break;

				case 'editvenue':
					if ( $params->get('icons') ) {
						$image = JHTML::_('image', 'components/com_eventlist/assets/images/calendar_edit.png', JText::_( 'EDIT EVENT' ) );
					} else {
						$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'EDIT VENUE' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
					}
					$overlib = JText::_( 'EDIT VENUE TIP' );
					$text = JText::_( 'EDIT VENUE' );
					break;
			}

			$link 	= 'index.php?view='.$view.'&id='.$id.'&returnid='.$Itemid;
			$output	= '<a href="'.JRoute::_($link).'" class="editlinktip hasTip" title="'.$text.'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}

		return;
	}

	/**
	 * Creates the print button
	 *
	 * @param string $print_link
	 * @param array $params
	 * @since 0.9
	 */	
	function printbutton( $print_link, &$params )
	{
		if ($params->get( 'show_print_icon' )) {

			JHTML::_('behavior.tooltip');

			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

			// checks template image directory for image, if non found default are loaded
			if ( $params->get( 'icons' ) ) {
				$image = JHTML::_('image', 'images/M_images/printButton.png', JText::_( 'Print' ) );
			} else {
				$image = JText::_( 'ICON_SEP' ) .'&nbsp;'. JText::_( 'Print' ) .'&nbsp;'. JText::_( 'ICON_SEP' );
			}

			if (JRequest::getInt('pop')) {
				//button in popup
				$output = '<a href="#" onclick="window.print();return false;">'.$image.'</a>';
			} else {
				//button in view
				$overlib = JText::_( 'PRINT TIP' );
				$text = JText::_( 'Print' );

				$output	= '<a href="'. JRoute::_($print_link) .'" class="editlinktip hasTip" onclick="window.open(this.href,\'win2\',\''.$status.'\'); return false;" title="'.$text.'::'.$overlib.'">'.$image.'</a>';
			}

			return $output;
		}
		return;
	}

	/**
	 * Creates the email button
	 *
	 * @param string $print_link
	 * @param array $params
	 * @since 0.9
	 */
	function mailbutton($params)
	{
		if ($params->get('show_email_icon')) {

			JHTML::_('behavior.tooltip');

			$url 	= 'index.php?option=com_mailto&tmpl=component&link='.base64_encode( JRequest::getURI() );
			$status = 'width=400,height=300,menubar=yes,resizable=yes';

			if ($params->get('icons')) 	{
				$image = JHTML::_('image', 'images/M_images/emailButton.png', JText::_( 'Email' ));
			} else {
				$image = '&nbsp;'.JText::_( 'Email' );
			}

			$overlib = JText::_( 'EMAIL TIP' );
			$text = JText::_( 'Email' );

			$output	= '<a href="'. JRoute::_($url) .'" class="editlinktip hasTip" onclick="window.open(this.href,\'win2\',\''.$status.'\'); return false;" title="'.$text.'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}
		return;
	}

	/**
	 * Creates the map button
	 *
	 * @param obj $data
	 * @param obj $settings
	 *
	 * @since 0.9
	 */
	function mapicon($data, $settings)
	{
		//Link to map
		$mapimage = JHTML::_('image', 'components/com_eventlist/assets/images/mapsicon.png', JText::_( 'MAP' ) );

		//set var
		$output 	= null;
		$attributes = null;

		//stop if disabled
		if (!$data->map) {
			return $output;
		}
		
		$data->country = JString::strtoupper($data->country);

		//google or map24
		switch ($settings->showmapserv)
		{
			case 1:
			{
  				if ($settings->map24id) {

				$url		= 'http://link2.map24.com/?lid='.$settings->map24id.'&amp;maptype=JAVA&amp;width0=2000&amp;street0='.$data->street.'&amp;zip0='.$data->plz.'&amp;city0='.$data->city.'&amp;country0='.$data->country.'&amp;sym0=10280&amp;description0='.$data->venue;
				$output		= '<a class="map" title="'.JText::_( 'MAP' ).'" href="'.$url.'" target="_blank">'.$mapimage.'</a>';

  				}
			} break;

			case 2:
			{
				if($settings->gmapkey) {

					$document 	= & JFactory::getDocument();
					JHTML::_('behavior.mootools');

					//TODO: move map into squeezebox

					$document->addScript($this->baseurl.'/components/com_eventlist/assets/js/gmapsoverlay.js');
					$document->addScript('http://maps.google.com/maps?file=api&v=2&key='.trim($settings->gmapkey));
  					$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/gmapsoverlay.css', 'text/css');

					$url		= 'http://maps.google.com/maps?q='.str_replace(" ", "+", $data->street).', '.$data->plz.' '.str_replace(" ", "+", $data->city).', '.$data->country.'&venue='.$data->venue;
					$attributes = ' rel="gmapsoverlay"';
				} else {

					$url		= 'http://maps.google.com/maps?q='.str_replace(" ", "+", $data->street).', '.$data->plz.' '.str_replace(" ", "+", $data->city).', '.$data->country;
				}

				$output		= '<a class="map" title="'.JText::_( 'MAP' ).'" href="'.$url.'" target="_blank"'.$attributes.'>'.$mapimage.'</a>';

			} break;
		}

		return $output;
	}

	/**
	 * Creates the flyer
	 *
	 * @param obj $data
	 * @param obj $settings
	 * @param array $image
	 * @param string $type
	 *
	 * @since 0.9
	 */
	function flyer( $data, $settings, $image, $type = 'venue' )
	{

		//define the environment based on the type
		if ($type == 'event') {
			$folder		= 'events';
			$imagefile	= $data->datimage;
			$info		= $data->title;
		} else {
			$folder 	= 'venues';
			$imagefile	= $data->locimage;
			$info		= $data->venue;
		}

		//do we have an image?
		if (empty($imagefile)) {

			//nothing to do
			return;

		} else {

			jimport('joomla.filesystem.file');

			//does a thumbnail exist?
			if (JFile::exists(JPATH_SITE.DS.'images'.DS.'eventlist'.DS.$folder.DS.'small'.DS.$imagefile)) {

				if ($settings->lightbox == 0) {

					$url		= '#';
					$attributes	= 'class="modal" onclick="window.open(\''.$this->baseurl.'/'.$image['original'].'\',\'Popup\',\'width='.$image['width'].',height='.$image['height'].',location=no,menubar=no,scrollbars=no,status=no,toolbar=no,resizable=no\')"';

				} else {

					JHTML::_('behavior.modal');

					$url		= $this->baseurl.'/'.$image['original'];
					$attributes	= 'class="modal" title="'.$info.'"';

				}

				$icon	= '<img src="'.$this->baseurl.'/'.$image['thumb'].'" width="'.$image['thumbwidth'].'" height="'.$image['thumbheight'].'" alt="'.$info.'" title="'.JText::_( 'CLICK TO ENLARGE' ).'" />';
				$output	= '<a href="'.$url.'" '.$attributes.'>'.$icon.'</a>';

			//No thumbnail? Then take the in the settings specified values for the original
			} else {

				$output	= '<img class="modal" src="'.$this->baseurl.'/'.$image['original'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$info.'" />';

			}
		}

		return $output;
	}

	/**
	 * Creates the country flag
	 *
	 * @param string $country
	 *
	 * @since 0.9
	 */
	function getFlag($country)
	{
        $country = JString::strtolower($country);

        jimport('joomla.filesystem.file');

        if (JFile::exists(JPATH_COMPONENT_SITE.DS.'assets'.DS.'images'.DS.'flags'.DS.$country.'.gif')) {
        	$countryimg = '<img src="'.$this->baseurl.'/components/com_eventlist/assets/images/flags/'.$country.'.gif" alt="'.JText::_( 'COUNTRY' ).': '.$country.'" width="16" height="11" />';

        	return $countryimg;
        }

        return null;
	}
}
?>
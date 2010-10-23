<?php
/**
 * @version 0.9 $Id: attendees.php 507 2008-01-03 15:48:34Z schlu $
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

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * EventList Component Attendees Controller
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListControllerAttendees extends EventListController
{
	/**
	 * Constructor
	 *
	 *@since 0.9
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Delete attendees
	 *
	 * @return true on sucess
	 * @access private
	 * @since 0.9
	 */
	function remove()
	{
		$cid 	= JRequest::getVar('cid');
		$id 	= JRequest::getInt('id');
		$total 	= count( $cid );

		$model = $this->getModel('attendees');

		if(!$model->remove($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$msg = $total.' '.JText::_( 'REGISTERED USERS DELETED');

		$this->setRedirect( 'index.php?option=com_eventlist&view=attendees&id='.$id, $msg );
	}

	function export()
	{
		global $mainframe;

		$model = $this->getModel('attendees');

		$datas = $model->getData();

		header('Content-Type: text/x-csv');
		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Content-Disposition: attachment; filename=attendees.csv');
		header('Pragma: no-cache');

		$k = 0;
		$export = '';
		$col = array();

		for($i=0, $n=count( $datas ); $i < $n; $i++)
		{
			$data = &$datas[$i];

    		$col[] = str_replace("\"", "\"\"", $data->name);
    		$col[] = str_replace("\"", "\"\"", $data->username);
    		$col[] = str_replace("\"", "\"\"", $data->email);
    		$col[] = str_replace("\"", "\"\"", JHTML::Date( $data->uregdate, JText::_( 'DATE_FORMAT_LC2' ) ));
    		$col[] = str_replace("\"", "\"\"", $data->uid);

   	 		for($j = 0; $j < count($col); $j++)
    		{
        		$export .= "\"" . $col[$j] . "\"";

        		if($j != count($col)-1)
       	 		{
            		$export .= ";";
        		}
    		}
    		$export .= "\r\n";
    		$col = '';

			$k = 1 - $k;
		}

		echo $export;

		$mainframe->close();
	}
}
?>
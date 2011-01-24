<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

jimport('joomla.html.pagination');

class DtPagination extends JPagination{
    
	public $form = 'frmcart';
	function __construct($total, $limitstart, $limit){

        global $mainframe;
        
		if($limit == "")
		$limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );

		parent::__construct($total, $limitstart, $limit);

	}

	function getPagesLinks()

	{

		global $mainframe;

		$lang =& JFactory::getLanguage();

		// Build the page navigation list

		$data = $this->_buildDataObject();

		$list = array();

		$itemOverride = false;

		$listOverride = false;

		// Build the select list

		if ($data->all->base !== null) {

			$list['all']['active'] = true;

			$list['all']['data'] = ($itemOverride) ? pagination_item_active($data->all) : $this->_item_active($data->all);

		} else {

			$list['all']['active'] = false;

			$list['all']['data'] = ($itemOverride) ? pagination_item_inactive($data->all) : $this->_item_inactive($data->all);

		}

		if ($data->start->base !== null) {

			$list['start']['active'] = true;

			$list['start']['data'] = ($itemOverride) ? pagination_item_active($data->start) : $this->_item_active($data->start);

		} else {

			$list['start']['active'] = false;

			$list['start']['data'] = ($itemOverride) ? pagination_item_inactive($data->start) : $this->_item_inactive($data->start);

		}

		if ($data->previous->base !== null) {

			$list['previous']['active'] = true;

			$list['previous']['data'] = ($itemOverride) ? pagination_item_active($data->previous) : $this->_item_active($data->previous);

		} else {

			$list['previous']['active'] = false;

			$list['previous']['data'] = ($itemOverride) ? pagination_item_inactive($data->previous) : $this->_item_inactive($data->previous);

		}

		$list['pages'] = array(); //make sure it exists

		foreach ($data->pages as $i => $page)

		{

			if ($page->base !== null) {

				$list['pages'][$i]['active'] = true;

				$list['pages'][$i]['data'] = ($itemOverride) ? pagination_item_active($page) : $this->_item_active($page);

			} else {

				$list['pages'][$i]['active'] = false;

				$list['pages'][$i]['data'] = ($itemOverride) ? pagination_item_inactive($page) : $this->_item_inactive($page);

			}

		}

		if ($data->next->base !== null) {

			$list['next']['active'] = true;

			$list['next']['data'] = ($itemOverride) ? pagination_item_active($data->next) : $this->_item_active($data->next);

		} else {

			$list['next']['active'] = false;

			$list['next']['data'] = ($itemOverride) ? pagination_item_inactive($data->next) : $this->_item_inactive($data->next);

		}

		if ($data->end->base !== null) {

			$list['end']['active'] = true;

			$list['end']['data'] = ($itemOverride) ? pagination_item_active($data->end) : $this->_item_active($data->end);

		} else {

			$list['end']['active'] = false;

			$list['end']['data'] = ($itemOverride) ? pagination_item_inactive($data->end) : $this->_item_inactive($data->end);

		}

		if($this->total > $this->limit){

			return ($listOverride) ? pagination_list_render($list) : $this->_list_render($list);

		}

		else{

			return '';

		}

	}

	function _item_active(&$item)

	{

		global $mainframe;

		if ($mainframe->isAdmin())

		{

			if($item->base>0)

				return "<a title=\"".$item->text."\" onclick=\"javascript: document.adminForm.limitstart.value=".$item->base."; submitform();return false;\">".$item->text."</a>";

			else

				return "<a title=\"".$item->text."\" onclick=\"javascript: document.adminForm.limitstart.value=0; submitform();return false;\">".$item->text."</a>";

		} else {

			if($item->base>0)

				return "<a title=\"".$item->text."\" href='#' onclick=\"javascript: document.".$this->form.".limitstart.value=".$item->base."; document.".$this->form.".submit();return false;\">".$item->text."</a>";

			else

				return "<a title=\"".$item->text."\" href='#' onclick=\"javascript: document.".$this->form.".limitstart.value=0; document.".$this->form.".submit();return false;\">".$item->text."</a>";

		}

	}

}
?>
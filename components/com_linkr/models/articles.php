<?php
defined('_JEXEC') or die;

// Import librairies
jimport( 'joomla.application.component.model' );

/**
 * Articles model for Linkr component (frontend)
 * 
 * @package	Linkr
 * @author		Frank
 */

class LinkrModelArticles extends JModel
{
	/**
	 * Returns information to link the selected article
	 * (requested with ajax)
	 *
	 * @return	string HTML to return to the edit page.
	 */
	function getArticle()
	{
		$id		= JRequest::getInt( 'aid', 0 );
		
		if ($id > 0)
		{
			$db	= & JFactory::getDBO();
			$q	= 	'SELECT a.id,a.title,a.alias,a.introtext,a.catid,a.sectionid, '.
					'CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS("-",a.id,a.alias) '.
					'ELSE a.id END as slug, '.
					'CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS("-",c.id,c.alias) '.
					'ELSE c.id END as cslug '.
					'FROM #__content AS a '.
					'LEFT JOIN #__categories AS c ON c.id = a.catid '.
					'WHERE a.state = 1 AND a.id = '. $id;
			$db->setQuery( $q );
			$a	= $db->loadObject();
			if ($db->getErrorNum()) {
				return $db->stderr();
			}
			
			$route	= $this->getArticleRoute( $a );
			$html	=	'<h4 style="width:550px;text-align:center;">'.
							'<a id="toggle" href="#">'. JText::_( 'Configure link' ) .'</a>'.
							'&emsp;'.
							'<a onclick="LinkrHelper.link()" href="#">'. JText::_( 'Get link!' ) .'</a>'.
						'</h4>'.
						'<div id="settings" style="border:1px solid;padding:5px;">'.
							'<label for="linkText">&emsp;'. JText::_( 'Text' ) .'</label><br />'.
							'<input type="text" id="linkText" class="inputbox" style="width:500px;" '.
							'value="'. htmlentities( $a->title, ENT_COMPAT ) .'" /><br /><br />'.
							'<label for="linkURL">&emsp;'. JText::_( 'URL' ) .'</label><br />'.
							'<input type="text" id="linkURL" class="inputbox" style="width:500px;" '.
							'value="'. $route .'" /><br /><br />'.
							'<label for="target">&emsp;'. JText::_( 'Page target' ) .'</label><br />'.
							'<select id="target">'.
								'<option value="_self">'. JText::_( 'same page' ) .'</option>'.
								'<option value="_blank">'. JText::_( 'blank page' ) .'</option>'.
							'</select><br /><br />'.
							'<label for="linkTitle">&emsp;'. JText::_( 'Tooltip' ) .'</label><br />'.
							'<input type="text" id="linkTitle" class="inputbox" style="width:500px;" '.
							'value="" /><br /><br />'.
							'<label for="linkClass">&emsp;'. JText::_( 'Class' ) .'</label><br />'.
							'<input type="text" id="linkClass" class="inputbox" style="width:500px;" '.
							'value="" /><br /><br />'.
						'</div>'.
						'<h3>'. $a->title .'</h3>'.
						'<p>'. $a->introtext .'</p>';
			
			return $html;
		}
		
		return JText::_( 'Article id is 0? Pick another article' );
	}
	
	/**
	 * Searches the database for an article
	 * (requested with ajax)
	 *
	 * @return	string Search results
	 */
	function getSearch()
	{
		$txt	= trim( JRequest::getString( 'q', '' ) );
		
		if (strlen( $txt ) > 2)
		{
			$db		= & JFactory::getDBO();
			$txt	= $db->Quote( '%'. $db->getEscaped( $txt, true ) .'%', false );
			$where 	= array();
			$where[] 	= 'LOWER(a.title) LIKE '. $txt;
			$where[] 	= 'LOWER(a.introtext) LIKE '. $txt;
			$where[] 	= 'LOWER(a.`fulltext`) LIKE '. $txt;
			$where[] 	= 'LOWER(a.metakey) LIKE '. $txt;
			$where[] 	= 'LOWER(a.metadesc) LIKE '. $txt;
			$where 	= '('. implode( ') OR (', $where ) .')';
			$q	= 	'SELECT a.id,a.title,a.alias,a.introtext,a.catid,'.
					'a.sectionid,c.title AS category, '.
					'CASE WHEN CHAR_LENGTH(a.alias) '.
					'THEN CONCAT_WS("-",a.id,a.alias) '.
					'ELSE a.id END as slug, '.
					'CASE WHEN CHAR_LENGTH(c.alias) '.
					'THEN CONCAT_WS("-",c.id,c.alias) '.
					'ELSE c.id END as cslug '.
					'FROM #__content AS a '.
					'LEFT JOIN #__categories AS c ON c.id = a.catid '.
					'WHERE a.state = 1 AND '. $where .' '.
					'ORDER BY category,title';
			$db->setQuery( $q );
			$list	= $db->loadObjectList();
			if ($db->getErrorNum()) {
				return $db->stderr();
			} elseif (empty( $list ) || empty( $list[0] )) {
				return '<p>'. JText::_( 'no results found' ) .'</p>';
			}
			
			$html	= '<br /><br />';
			foreach($list as $a)
			{
				$btn	= 	'<input type="button" value="'. JText::_( 'pick' ) .
							'" onclick="LinkrHelper.select('. $a->id .')" />';
				$txt	= $this->snip( $a->category .' - '. $a->title, 60 );
				$html	.= $btn .'&ensp;'. $txt .'<br />';
			}
			
			return $html;
		}
		
		return '<p>'. JText::_( 'Type in at least 2 characters' ) .'</p>';
	}
	
	/**
	 * Returns the article url
	 *
	 * @param object $a The article object.
	 * @return	string The article url.
	 */
	function getArticleRoute( $a )
	{
		$app	= & JFactory::getApplication( 'site' );
		
		// Build route... cant use JRoute
		if ($app->getCfg( 'sef' ))
		{
			$menus	= & $app->getMenu( 'site' );
			$def	= & $menus->getDefault();
			$route	= $def->alias .'/'. $a->cslug .'/'. $a->slug .'/';
			
			if ($app->getCfg( 'sef_rewrite' )) {
				$route	= '/'. $route;
			} else {
				$route	= 'index.php/'. $route;
			}
		}
		
		// No SEF
		else
		{
			require_once( JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php' );
			$route	= ContentHelperRoute::getArticleRoute( $a->slug, $a->catid, $a->sectionid );
		}
		
		return $route;
	}
	
	/**
	 * Returns the html code for the section select list.
	 *
	 * @return	string HTML code for section select list.
	 */
	function getSectionList()
	{
		$db		= & JFactory::getDBO();
		
		// Query
		$where		= array();
		$where[]	= 'published = 1';
		
		// Get sections
		$where 	=	'WHERE ('. implode( ' AND ', $where ) .')';
		$query	=	'SELECT id,title FROM #__sections '.
					$where .' ORDER BY title';
		$db->setQuery( $query );
		$list	= $db->loadObjectList();
		if ($db->getErrorNum()) {
			return $db->stderr();
		}
		
		// Create select objects
		$select		= array();
		$select[]	= JHTML::_( 'select.option', -1, '-- '. JText::_( 'pick a section' ) .' --' );
		$select[]	= JHTML::_( 'select.option', 0, JText::_( 'Uncategorized' ) );
		for ($i = 0, $n = count( $list ); $i < $n; $i++) {
			$title		= $this->snip( $list[$i]->title );
			$select[]	= JHTML::_( 'select.option', $list[$i]->id, $title );
		}
		
		// Create list
		return JHTML::_( 'select.genericlist', $select, 'sectionList', 'class="inputbox" onchange="LinkrHelper.section()"', 'value', 'text', -1 );
	}
	
	/**
	 * Returns the html code for the category select list.
	 * (requested with ajax)
	 *
	 * @return	string HTML code for category select list.
	 */
	function getCategoryList()
	{
		$sectionID	= JRequest::getInt( 'sid', -1 );
		
		// Create query
		// From section
		if ($sectionID > 0) {
			$query	=	' SELECT id,title FROM #__categories'. 
						' WHERE published = 1 AND section = '. $sectionID .
						' ORDER BY title';
		}
		
		// Uncategorized
		elseif ($sectionID == 0) {
			$query	=	' SELECT id,title FROM #__categories'. 
						' WHERE published = 1 AND'.
						' ( section = 0 OR section LIKE "com_%" )'.
						' ORDER BY title';
		}
		
		// Invalid
		else {
			$select	= array();
			$select[]	= JHTML::_( 'select.option', -1, JText::_( 'select a section' ) );
			return JHTML::_( 'select.genericlist', $select, 'categoryList', 'class="inputbox"', 'value', 'text', -1 );
		}
		
		$db		= & JFactory::getDBO();
		$db->setQuery( $query );
		$list	= $db->loadObjectList();
		if ($db->getErrorNum()) {
			return $db->stderr();
		} elseif (empty( $list )) {
			$select	= array(
				JHTML::_( 'select.option', -1, JText::_( 'empty! select another section' ) )
			);
			return JHTML::_( 'select.genericlist', $select, 'categoryList', 'class="inputbox"', 'value', 'text', -1 );
		}
		
		// Create select objects
		$select		= array();
		$select[]	= JHTML::_( 'select.option', -1, '-- '. JText::_( 'pick a category' ) .' --' );
		$select[]	= JHTML::_( 'select.option', 0, JText::_( 'Uncategorized' ) );
		for ($i = 0, $n = count( $list ); $i < $n; $i++) {
			$title		= $this->snip( $list[$i]->title );
			$select[]	= JHTML::_( 'select.option', $list[$i]->id, $title );
		}
		
		// Create list
		return JHTML::_( 'select.genericlist', $select, 'categoryList', 'class="inputbox" onchange="LinkrHelper.category()"', 'value', 'text', -1 );
	}
	
	/**
	 * Returns the html code for the article select list.
	 * (requested with ajax)
	 *
	 * @return	string HTML code for article select list.
	 */
	function getArticleList()
	{
		$categoryID	= JRequest::getInt( 'cid', -1 );
		
		if ($categoryID >= 0)
		{
			$db		= & JFactory::getDBO();
			
			// Query
			$where	= array();
			$where[]	= 'state = 1';
			$where[]	= 'catid = '. $categoryID;
			
			$where 	= 	' WHERE ('. implode( ' AND ', $where ) .')';
			$query	= 	' SELECT id,title FROM #__content '. 
						$where .
						' ORDER BY title';
			
			$db->setQuery( $query );
			$list	= $db->loadObjectList();
			if ($db->getErrorNum()) {
				return $db->stderr();
			} elseif (empty( $list ) || empty( $list[0] )) {
				$select	= array(
					JHTML::_( 'select.option', -1, JText::_( 'empty! select another category' ) )
				);
				return JHTML::_( 'select.genericlist', $select, 'articleList', 'class="inputbox"', 'value', 'text', -1 );
			}
			
			// Create select objects
			$select	= array();
			$select[] = JHTML::_( 'select.option', -1, '-- '. JText::_( 'pick an article' ) .' --' );
			for ($i = 0, $n = count( $list ); $i < $n; $i++) {
				$title		= $this->snip( $list[$i]->title );
				$select[]	= JHTML::_( 'select.option', $list[$i]->id, $title );
			}
			
			// Create list
			return JHTML::_( 'select.genericlist', $select, 'articleList', 'class="inputbox" onchange="LinkrHelper.select(this.value)"', 'value', 'text', -1 );
		}
		
		else {
			$select	= array();
			$select[]	= JHTML::_( 'select.option', -1, JText::_( 'Select a Category' ) );
			return JHTML::_( 'select.genericlist', $select, 'articleList', 'class="inputbox"', 'value', 'text', -1 );
		}
	}
	
	/**
	 * Returns the html code for the requested list.
	 * (for ajax)
	 *
	 * @return	string HTML code for requested select list.
	 */
	function getList()
	{
		$get	= JRequest::getString( 'list' );
		
		switch ( $get )
		{
			case 'article':
				$list	= $this->getArticle();
				break;
			
			case 'articles':
				$list	= $this->getArticleList();
				break;
			
			case 'categories':
				$list	= $this->getCategoryList();
				break;
			
			case 'search':
				$list	= $this->getSearch();
				break;
			
			case 'sections':
			default:
				$list	= $this->getSectionList();
		}
		
		return $list;
	}
	
	function snip( $string, $length = 45 )
	{
		// Some installations are having trouble with this
		//$lang	= & JFactory::getLanguage();
		//$string	= $lang->transliterate( $string );
		
		// JLanguage::transliterate
		$rep	= array( '/&szlig;/', '/&(..)lig;/', '/&([aouAOU])uml;/', '/&(.)[^;]*;/' );
		$with	= array( 'ss', "$1", "$1".'e', "$1" );
		$string	= htmlentities( utf8_decode( $string ), ENT_COMPAT );
		$string	= preg_replace( $rep, $with, $string );
		
		// Truncate
		$string	= html_entity_decode( $string, ENT_COMPAT );
		$string	= (strlen( $string ) > $length) ? substr( $string, 0, $length ) .'...' : $string;
		
		return $string;
	}
}

?>
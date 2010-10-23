<?php
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view' );

class LinkrViewArticles extends JView
{
	function display($tpl = null)
	{
		// Ajax request
		if ($list = JRequest::getString( 'list' ))
		{
			$model	= $this->getModel();
			$list	= $model->getList();
			die( $list );	// There must be a better way... maybe using a different view.. raw view..
		}
		
		// Normal display
		else
		{
			$doc 	= & JFactory::getDocument();
			$url	= linkrAdminPath .'index.php?option=com_linkr&view=articles&list=';
			$load	= '<img src="'. linkrAssetsPath .'loading.gif" alt="..." style="margin:3px;" />';
			$doc->addStyleDeclaration( 'div.hide{display:none;}' );
			$doc->addScript( 'media/system/js/mootools.js' );
			$doc->addScript( 'components/com_linkr/assets/helper.js' );
			$doc->addScriptDeclaration(
				'var loading="'. str_replace( '"', '\"', $load ) .'";'.
				'var url="'. str_replace( '"', '\"', $url ) .'";'.
				'var mTxt="'. JText::_( 'What is the text for your link?', true ) .'";'.
				'var mURL="'. JText::_( 'What is the URL you want to use?', true ) .'";'.
				'LinkrHelper.init(loading,url,mTxt,mURL);'
			);
			
			// References
			$sections	= $this->get( 'SectionList' );
			$categories	= $this->get( 'CategoryList' );
			$articles	= $this->get( 'ArticleList' );
			$this->assignRef( 'sectionList', $sections );
			$this->assignRef( 'categoryList', $categories );
			$this->assignRef( 'articleList', $articles );
			
			parent::display($tpl);
		}
	}
}

?>
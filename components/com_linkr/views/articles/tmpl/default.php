<?php defined('_JEXEC') or die; ?>

<h2><?php echo JText::_( 'Link an article' ); ?></h2>

<span id="sections"><?php echo $this->sectionList; ?></span>&emsp;
<?php echo JText::_( 'or' ); ?>&emsp;
<input type="text" id="search" value="" />
<input type="button" onclick="LinkrHelper.search()"
value="<?php echo JText::_( 'search' ); ?>" /><br /><br />
<span id="categories"><?php echo $this->categoryList; ?></span>&emsp;
<span id="articles"><?php echo $this->articleList; ?></span>
<div id="article"></div>
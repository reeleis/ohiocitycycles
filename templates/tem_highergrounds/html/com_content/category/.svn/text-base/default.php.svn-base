<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if ($this->params->get('show_page_title')) : ?>
	<h2 class="componentheading <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->escape($this->category->title); ?>
	</h2>
<?php endif; ?>
<div class="intro">
	<?php if ($this->category->image) : ?>
		<div class="categoryimage">
		<img src="<?php echo $this->baseurl ?>/images/stories/<?php echo $this->category->image;?>" align="<?php echo $this->category->image_position;?>" hspace="6" alt="<?php echo $this->category->image;?>" />
		</div>
	<?php endif; ?>
	<?php echo $this->category->description; ?>
</div>
<div class="contentpane <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php
		$this->items =& $this->getItems();
		echo $this->loadTemplate('items');
	?>

	<?php if ($this->access->canEdit || $this->access->canEditOwn) :
			echo JHTML::_('icon.create', $this->category  , $this->params, $this->access);
	endif; ?>
</div>
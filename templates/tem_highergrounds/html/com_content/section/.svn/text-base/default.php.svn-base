<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if ($this->params->get('show_page_title')) : ?>
<h2 class="componentheading <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php echo $this->escape($this->section->title); ?>
</h2>
<?php endif; ?>

<div class="intro">
<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
		<img src="<?php echo $this->baseurl ?>/images/stories/<?php echo $this->section->image;?>" align="<?php echo $this->section->image_position;?>" hspace="6" alt="<?php echo $this->section->image;?>" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->section->description) : ?>
		<?php echo $this->section->description; ?>
	<?php endif; ?>
</div>
	<?php if ($this->params->get('show_categories', 1)) : ?>
	<ul class="categories">
	<?php foreach ($this->categories as $category) : ?>
		<?php if (!$this->params->get('show_empty_categories') && !$category->numitems) continue; ?>
		<li>
			<a href="<?php echo $category->link; ?>" class="category">
				<?php echo $category->title;?>
			</a>
			<?php if ($this->params->get('show_cat_num_articles')) : ?>
			&nbsp;
			<span class="small">
				( <?php echo $category->numitems ." ". JText::_( 'items' );?> )
			</span>
			<?php endif; ?>
			<?php if ($this->params->def('show_category_description', 1) && $category->description) : ?>
			<br />
			<?php echo $category->description; ?>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>

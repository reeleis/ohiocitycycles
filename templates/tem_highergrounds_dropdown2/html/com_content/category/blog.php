<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if ($this->params->get('show_page_title')) : ?>
<h2 class="componentheading <?php echo $this->params->get('pageclass_sfx');?>">
	<?php echo $this->escape($this->params->get('page_title')); ?>
</h2>
<?php endif; ?>

<div class="blog <?php echo $this->params->get('pageclass_sfx');?>" cellpadding="0" cellspacing="0">

<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) :?>
<div class="intro">
	<?php if ($this->params->get('show_description_image') && $this->category->image) : ?>
		<img src="<?php echo $this->baseurl ?>/images/stories/<?php echo $this->category->image;?>" align="<?php echo $this->category->image_position;?>" class="catimage" alt="" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
		<?php echo $this->category->description; ?>
	<?php endif; ?>
</div>

<?php endif; ?>

<?php if ($this->params->def('num_leading_articles', 1)) : ?>
	<?php for ($i = $this->pagination->limitstart; $i < ($this->pagination->limitstart + $this->params->get('num_leading_articles')); $i++) : ?>
		<?php if ($i >= $this->total) : break; endif; ?>
		<div class="pagination">
		<?php
			$this->item =& $this->getItem($i, $this->params);
			echo $this->loadTemplate('item');
		?>
		</div>
	<?php endfor; ?>

<?php else : $i = $this->pagination->limitstart; endif; ?>
<?php
$startIntroArticles = $this->pagination->limitstart + $this->params->get('num_leading_articles');
$numIntroArticles = $startIntroArticles + $this->params->get('num_intro_articles', 4);
if (($numIntroArticles != $startIntroArticles) && ($i < $this->total)) : ?>

<div class="item">
		<?php
			for ($z = 0; $z < $this->params->def('num_columns', 2); $z ++) :
			?>
				<?php for ($y = 0; $y < ($this->params->get('num_intro_articles', 4) / $this->params->get('num_columns')); $y ++) :
					if ($i < $this->total && $i < ($numIntroArticles)) :
						$this->item =& $this->getItem($i, $this->params);
						echo $this->loadTemplate('item');
						$i ++;
					endif;
				endfor; ?>
		<?php endfor; ?>
</div>

<?php endif; ?>
<?php if ($this->params->def('num_links', 4) && ($i < $this->total)) : ?>
		<div class="blog_more<?php echo $this->params->get('pageclass_sfx') ?>">
			<?php
				$this->links = array_splice($this->items, $i - $this->pagination->limitstart);
				echo $this->loadTemplate('links');
			?>
		</div>
<?php endif; ?>
<?php if ($this->params->def('show_pagination', 2)) : ?>
<div class="paginate">
<?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php endif; ?>
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<div class="pagecounter">
<?php echo $this->pagination->getPagesCounter(); ?>
</div>
<?php endif; ?>
</div>
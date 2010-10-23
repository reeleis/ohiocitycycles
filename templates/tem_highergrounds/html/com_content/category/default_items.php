<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<script language="javascript" type="text/javascript">

	function tableOrdering( order, dir, task )
	{
		var form = document.adminForm;

		form.filter_order.value 	= order;
		form.filter_order_Dir.value	= dir;
		document.adminForm.submit( task );
	}
</script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">

<?php if ($this->params->get('filter') || $this->params->get('show_pagination_limit')) : ?>

		<div class="filter">
		<?php if ($this->params->get('filter')) : ?>
				<?php echo JText::_('Filter').'&nbsp;'; ?>
				<input type="text" name="filter" value="<?php echo $this->lists['filter'];?>" class="inputbox" onchange="document.adminForm.submit();" />
		<?php endif; ?>

		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<?php
				echo '&nbsp;&nbsp;'.JText::_('Display Num').'&nbsp;';
				echo $this->pagination->getLimitBox();
			?>
		<?php endif; ?>
		</div>

<?php endif; ?>

<div class="category-table">

<?php foreach ($this->items as $item) : ?>
<div class="item">
	<span class="num"><?php echo $this->pagination->getRowOffset( $item->count ); ?>.</span>
	<?php if ($this->params->get('show_title')) : ?>
	<?php if ($item->access <= $this->user->get('aid', 0)) : ?>
	<span class="item-title">
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?></a>
			<?php $this->item = $item; echo JHTML::_('icon.edit', $item, $this->params, $this->access) ?>
	</span>
	<?php else : ?>
	<span class="item-title">
		<?php
			echo $this->escape($item->title).' : ';
			$link = JRoute::_('index.php?option=com_user&task=register');
		?>
		<a href="<?php echo $link; ?>">
			<?php echo JText::_( 'Register to read more...' ); ?>
		</a>
	</span>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_date')) : ?>
	<span class="created">
		<?php echo $item->created; ?>
	</span>
	<?php endif; ?>
	<?php if ($this->params->get('show_author')) : ?>
	<span class="author" >
		by <?php echo $item->created_by_alias ? $item->created_by_alias : $item->author; ?>
	</span>
	<?php endif; ?>
	<?php if ($this->params->get('show_hits')) : ?>
	<span class="hits">
		(<?php echo $item->hits ? $item->hits : '-'; ?> hits)
	</span>
	<?php endif; ?>
</div>
<?php endforeach; ?>

<?php if ($this->params->get('show_pagination')) : ?>
<div class="paginate"><?php echo $this->pagination->getPagesLinks(); ?>
</div>		
<div class="pagecounter"><?php echo $this->pagination->getPagesCounter(); ?></div>
<?php endif; ?>
</div>

<input type="hidden" name="id" value="<?php echo $this->category->id; ?>" />
<input type="hidden" name="sectionid" value="<?php echo $this->category->sectionid; ?>" />
<input type="hidden" name="task" value="<?php echo $this->lists['task']; ?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>

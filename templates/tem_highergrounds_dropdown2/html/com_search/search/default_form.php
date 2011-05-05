<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_search' );?>" method="post" name="searchForm">

	<div class="contentpaneopen <?php echo $this->params->get( 'pageclass_sfx' ); ?>">

			<div class="search">
				<label for="search_searchword">
					<?php echo JText::_( 'Search Keyword' ); ?>:
				</label>
				<input type="text" name="searchword" id="search_searchword" size="30" maxlength="20" value="<?php echo $this->escape($this->searchword); ?>" class="inputbox" />
				<button name="Search" onClick="this.form.submit()" class="button"><?php echo JText::_( 'Search' );?></button>
			</div>
			

				<div class="searchphrase"><?php echo $this->lists['searchphrase']; ?></div>

				<div class="floatleft widleft">
				<label for="ordering">
					<?php echo JText::_( 'Ordering' );?>:
				</label>
				</div>
				<div class="floatright widright">
				<?php echo $this->lists['ordering'];?>
				</div>
	</div>
				<div class="clear"></div>

	<?php if ($this->params->get( 'search_areas', 1 )) : ?>
				<div class="floatleft widleft">
				<?php echo JText::_( 'Search Only' );?>:
				</div>
				<div class="floatright widright">
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array( $this->searchareas['active'] ) && in_array( $val, $this->searchareas['active'] ) ? 'checked="true"' : '';
		?>
		<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area_<?php echo $val;?>" <?php echo $checked;?> />
			<label for="area_<?php echo $val;?>">
				<?php echo JText::_($txt); ?>
			</label>
		<?php endforeach; ?>
			</div>
	<?php endif; ?>
					<div class="clear"></div>

	
	<div class="searchintro<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
			<?php echo JText::_( 'Search Keyword' ) .' <b>'. $this->escape($this->searchword) .'</b>'; ?>
	<br/>
			<?php echo $this->result; ?>
			<a href="http://www.google.com/search?q=<?php echo $this->escape($this->searchword); ?>" target="_blank">
				<?php echo $this->image; ?>
			</a>
</div>

<?php if($this->result > 0) : ?>
<div class="paginate">
	<div style="float: right;">
		<label for="limit">
			<?php echo JText::_( 'Display Num' ); ?>
		</label>
		<?php echo $this->pagination->getLimitBox( ); ?>
	</div>
	<div>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
</div>
<?php endif; ?>

<input type="hidden" name="task"   value="search" />
</form>
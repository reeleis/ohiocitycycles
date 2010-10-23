<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="form2">

<div class="poll">
	<h3><?php echo $poll->title; ?></h3>

			<?php for ($i = 0, $n = count($options); $i < $n; $i ++) : ?>
			<div class="poll-radio">
						<input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id;?>" value="<?php echo $options[$i]->id;?>" alt="<?php echo $options[$i]->id;?>" />
			</div>
			<div class="poll-option">
						<label for="voteid<?php echo $options[$i]->id;?>">
							<?php echo $options[$i]->text; ?>
						</label>
			</div>
				<?php
					$tabcnt = 1 - $tabcnt;
				?>
			<?php endfor; ?>
			<div class="clear"></div>
			<div align="center">
				<input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" />
				&nbsp;
				<input type="button" name="option" class="button" value="<?php echo JText::_('Results'); ?>" onclick="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug".$itemid); ?>'" />
			</div>
</div>
<input type="hidden" name="option" value="com_poll" />
<input type="hidden" name="task" value="vote" />
<input type="hidden" name="id" value="<?php echo $poll->id;?>" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
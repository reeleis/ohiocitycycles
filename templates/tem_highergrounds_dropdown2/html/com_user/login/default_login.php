<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
	<?php JHTML::_('script', 'openid.js'); ?>
<?php endif; ?>
<form action="index.php" method="post" name="login" id="form-login2">

		<?php if ( $this->params->get( 'show_login_title' ) ) : ?>
		<h2 class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
			<?php echo $this->params->get( 'header_login' ); ?>
		</h2>
		<?php endif; ?>
		<div class="login-image">
			<?php echo $this->image; ?>
			<?php if ( $this->params->get( 'description_login' ) ) : ?>
				<?php echo $this->params->get( 'description_login_text' ); ?>
			<?php endif; ?>
		</div>

<fieldset class="input">
	<p id="form-login-username">
		<label for="username"><?php echo JText::_('Username') ?></label><br />
		<input name="username" id="username" type="text" class="inputbox" alt="username" size="18" />
	</p>
	<p id="form-login-password">
		<label for="passwd"><?php echo JText::_('Password') ?></label><br />
		<input type="password" name="passwd" class="inputbox" size="18" alt="password" />
	</p>
	<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
	<p id="form-login-remember">
		<label for="remember"><?php echo JText::_('Remember me') ?></label>
		<input type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
	</p>
	<?php endif; ?>
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
</fieldset>
<ul>
	<li>
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
		<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
		<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?>
		</a>
	</li>
	<?php
	$usersConfig = &JComponentHelper::getParams( 'com_users' );
	if ($usersConfig->get('allowUserRegistration')) : ?>
	<li>
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
			<?php echo JText::_('REGISTER'); ?>
		</a>
	</li>
	<?php endif; ?>
</ul>

<input type="hidden" name="option" value="com_user" />
<input type="hidden" name="task" value="login" />
<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
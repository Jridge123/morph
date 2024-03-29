<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div id="user-login">
	<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
			$lang = &JFactory::getLanguage();
			$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
			$langScript = 	'var JLanguage = {};'.
							' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
							' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
							' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
							' var comlogin = 1;';
			$document = &JFactory::getDocument();
			$document->addScriptDeclaration( $langScript );
			JHTML::_('script', 'openid.js');
	endif; ?>
	<div id="login-wrap">
		<?php if ( $this->params->get( 'show_login_title' ) ) : ?>
		<h1><?php echo $this->params->get( 'header_login' ); ?></h1>
		<?php endif; ?>
		<form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" name="com-login" id="com-form-login">
			<?php echo $this->image; ?>	
			<?php if ( $this->params->get( 'description_login' ) ) : ?>
				<p class="login-description"><?php echo $this->params->get( 'description_login_text' ); ?></p>
			<?php endif; ?>
			
			<fieldset class="input" id="login-form">
			<ul>
				<li id="com-form-login-username" class="label">
					<label for="username"><?php echo JText::_('Username') ?></label>
					<span class="input-wrap"><input name="username" id="username" type="text" class="form-input" alt="username" /></span>
				</li>
				<li id="com-form-login-password" class="label">
					<label for="passwd"><?php echo JText::_('Password') ?></label>
					<span class="input-wrap"><input type="password" id="passwd" name="passwd" class="form-input" size="18" alt="password" /></span>
				</li>
				<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
				<li id="com-form-login-remember">
					<input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
					<label for="remember"><?php echo JText::_('Remember me') ?></label>
				</li>
				<?php endif; ?>
				<li class="login-btn">
					<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
				</li>
			</ul>
			</fieldset>
			<ul id="login-links">
				<li class="forgot-pass">
					<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
					<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
				</li>
				<li class="forgot-user">
					<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
					<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<?php
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				if ($usersConfig->get('allowUserRegistration')) : ?>
				<li class="register-link">
					<a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
						<?php echo JText::_('REGISTER'); ?></a>
				</li>
				<?php endif; ?>
			</ul>
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	</div>
</div>
<?php } ?><!-- close the themelet override check -->
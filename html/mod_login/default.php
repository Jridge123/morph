<?php
/**
 * @version		$Id: mod_login.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

	//JHtml::_('behavior.keepalive');
	?>
	<?php if ($type == 'logout') : ?>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-mod">
	<?php if ($params->get('greeting')) : ?>
		<div class="login-greeting">
		<?php if($params->get('name') == 0) : {
			echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('name'));
		} else : {
			echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('username'));
		} endif; ?>
		</div>
	<?php endif; ?>
		<div class="logout-button">
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.logout" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
	<?php else : ?>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-mod" >
		<?php if ($params->get('pretext')): ?>
			<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
			</div>
		<?php endif; ?>
		
		<ul class="login-form">
			<li class="login-username"><label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
				<span class="input-wrap"><input name="username" id="modlgn-username" type="text" class="form-input" alt="username" /></span>
			</li>
			<li class="login-password"><label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
				<span class="input-wrap"><input type="password" name="passwd" id="modlgn-passwd" class="form-input" alt="password" /></span>
			</li>
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<li class="login-remember">
			    <label for="modlgn-remember">
			        <input type="checkbox" name="remember" id="modlgn-remember" value="yes" alt="Remember Me" /> 
			        <?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?>
			    </label>
			</li>
			<?php endif; ?>
			<li class="login-btn">
				<button class="button" type="submit" name="Submit"><?php echo JText::_('JLOGIN'); ?></button>
			</li>
		</ul>
		
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>

		<ul class="login-links">
			<li class="login-forgot">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
			</li>
			<li class="login-username">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
				<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
			</li>
			<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<li class="login-register">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
			</li>
			<?php endif; ?>
		</ul>
		<?php if ($params->get('posttext')): ?>
			<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
			</div>
		<?php endif; ?>
	</form>
	<?php endif; ?>
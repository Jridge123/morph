<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>
<div id="login-wrap" class="edit-user">
	<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
		<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>
	<form action="<?php echo JRoute::_( 'index.php' ); ?>" method="post" name="userform" autocomplete="off" class="form-validate">
		<ul>
			<li id="form-username" class="label">
				<label for="username"><?php echo JText::_('Username') ?></label>
				<span class="input-wrap"><span class="form-input"><?php echo $this->user->get('username');?></span></span>
			</li>
			<li id="form-name" class="label">
				<label for="name"><?php echo JText::_('Name') ?></label>
				<span class="input-wrap"><input class="form-input required" type="text" id="name" name="name" value="<?php echo $this->user->get('name');?>" size="40" /></span>
			</li>
			<li id="form-email" class="label">
				<label for="email"><?php echo JText::_('Email') ?></label>
				<span class="input-wrap"><input class="form-input required validate-email" type="text" id="email" name="email" value="<?php echo $this->user->get('email');?>" size="40" /></span>
			</li>
			<?php if($this->user->get('password')) : ?>
			<li id="form-password" class="label">
				<label for="password"><?php echo JText::_('Password') ?></label>
				<span class="input-wrap"><input class="form-input validate-password" type="password" id="password" name="password" value="" size="40" /></span>
			</li>
			<li id="form-password2" class="label">
				<label for="password2"><?php echo JText::_('Verify Password') ?></label>
				<span class="input-wrap"><input class="form-input validate-passverify" type="password" id="password2" name="password2" size="40" /></span>
			</li>
			<?php endif; ?>
			<?php if(isset($this->params)) : echo $this->params->render( 'params' ); endif; ?>
			<li class="login-btn">
				<button class="button validate" type="submit" onclick="submitbutton( this.form );return false;">&nbsp;&nbsp;<?php echo JText::_('Save'); ?>&nbsp;&nbsp;</button>
			</li>
		</ul>
		<input type="hidden" name="username" value="<?php echo $this->user->get('username');?>" />
		<input type="hidden" name="id" value="<?php echo $this->user->get('id');?>" />
		<input type="hidden" name="gid" value="<?php echo $this->user->get('gid');?>" />
		<input type="hidden" name="option" value="com_user" />
		<input type="hidden" name="task" value="save" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
</div>
<?php } ?><!-- close the themelet override check -->
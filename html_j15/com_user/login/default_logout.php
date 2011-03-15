<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div id="login-wrap">
	<?php if ( $this->params->get( 'show_logout_title' ) ) : ?>
	<h1><?php echo $this->params->get( 'header_logout' ); ?></h1>
	<?php endif; ?>
	<?php echo $this->image; ?>
	<?php if ($this->params->get('description_logout')) : ?>
		<p class="login-description"><?php echo $this->params->get('description_logout_text'); ?>
	<?php endif; ?>	
	<form action="index.php" method="post" name="login" id="login">

		<input type="hidden" name="option" value="com_user" />
		<input type="hidden" name="task" value="logout" />
		<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
		<span class="login-btn"><button class="button" type="submit" name="Submit" onclick="submitbutton( this.form );return false;">&nbsp;&nbsp;<?php echo JText::_('Logout'); ?>&nbsp;&nbsp;</button></span>
	</form>
</div>
<?php } ?><!-- close the themelet override check -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
<?php endif; ?>

<p class="welcome-msg"><?php echo nl2br($this->params->get('welcome_desc', JText::_( 'WELCOME_DESC' ))); ?></p>
<?php } ?><!-- close the themelet override check -->
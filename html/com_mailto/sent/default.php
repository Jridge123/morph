<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div id="mailto-wrap" class="success-message">
	<h3><?php echo JText::_('EMAIL_SENT'); ?></h3>
	<a href="javascript: void window.close()" class="close-window"><?php echo JText::_('Close Window'); ?></a>
</div>
<?php } ?><!-- close the themelet override check -->
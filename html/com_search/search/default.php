<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
<h1>
	<?php echo $this->params->get( 'page_title' ); ?>
</h1>
<?php endif; ?>
<?php echo $this->loadTemplate('form'); ?>
<?php if(!$this->error && count($this->results) > 0) :
	echo $this->loadTemplate('results');
else :
	echo $this->loadTemplate('error');
endif; ?>
<?php } ?><!-- close the themelet override check -->
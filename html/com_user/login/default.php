<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<?php echo $this->loadTemplate($this->type); ?>
<?php } ?><!-- close the themelet override check -->
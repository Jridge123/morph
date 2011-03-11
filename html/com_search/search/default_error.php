<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div class="searchintro">
	<?php echo $this->escape($this->error); ?>
</div>
<?php } ?><!-- close the themelet override check -->
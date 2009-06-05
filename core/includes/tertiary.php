<?php if($this->countModules('right')) { ?>
<div class="sidenav yui-u" id="tertiary-content">
	<?php if ($this->countMenuChildren()){ ?>
	<jdoc:include type="modules" name="splitright" style="<?php echo $splitleft_chrome ?>" />
	<?php } ?>
	<jdoc:include type="modules" name="topright" style="<?php echo $topright_chrome ?>" />
	<jdoc:include type="modules" name="right" style="<?php echo $right_chrome ?>" />
	<jdoc:include type="modules" name="bottomright" style="<?php echo $btmright_chrome ?>" />
</div>
<?php } ?>
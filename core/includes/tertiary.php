<?php if($this->countModules('right')) { ?>
<div class="sidenav yui-u" id="tertiary-content">
    <?php if ($this->countMenuChildren() || $this->countModules( 'splitright' ) > 0 ) { ?>
	<jdoc:include type="modules" name="splitright" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $splitleft_chrome; } ?>" />
	<?php } ?>
	<jdoc:include type="modules" name="topright" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $topright_chrome; } ?>" />
	<jdoc:include type="modules" name="right" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $right_chrome; } ?>" />
	<jdoc:include type="modules" name="bottomright" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $btmright_chrome; } ?>" />
</div>
<?php } ?>
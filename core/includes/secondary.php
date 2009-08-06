<?php if ($this->countModules( 'splitleft or topleft or left or btmleft' )) { ?>
<div class="sidenav yui-b" id="secondary-content">
 <?php if ( $secondary_inner == 1 ) { ?><div class="secondary-inner"><?php } ?>
    <?php if ($this->countMenuChildren() || $this->countModules( 'splitleft' ) > 0 ) { ?>
    <?php sidebar_module($splitleft_chrome, 'splitleft', $jj_const); ?>
    <?php } ?>
    <?php sidebar_module($topleft_chrome, 'topleft', $jj_const); ?>
	<?php sidebar_module($left_chrome, 'left', $jj_const); ?>
	<?php sidebar_module($btmleft_chrome, 'btmleft', $jj_const); ?>
 </div>
 <?php if ( $secondary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>


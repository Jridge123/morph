<?php if ($this->countModules( 'splitright or topright or right or bottomright' )) { ?>
<div class="sidenav yui-u" id="tertiary-content">
 <?php if ( $tertiary_inner == 1 ) { ?><div class="tertiary-inner"><?php } ?>
    <?php if ($this->countMenuChildren() || $this->countModules( 'splitright' ) > 0 ) { ?>
    <?php sidebar_module($splitright_chrome, 'splitright', $jj_const, $splightright_modfx, $this); ?>
	<?php } ?>
    <?php sidebar_module($topright_chrome, 'topright', $jj_const, $topright_modfx, $this); ?>
	<?php sidebar_module($right_chrome, 'right', $jj_const, $right_modfx, $this); ?>
	<?php sidebar_module($bottomright_chrome, 'bottomright', $jj_const, $bottomright_modfx, $this); ?>
 </div>
 <?php if ( $tertiary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
<?php if ($this->countModules( 'splitright or topright or right or btmright' )) { ?>
<div class="sidenav yui-u" id="tertiary-content">
 <?php if ( $tertiary_inner == 1 ) { ?><div class="tertiary-inner"><?php } ?>
    <?php if ($this->countMenuChildren() || $this->countModules( 'splitright' ) > 0 ) { ?>
    <?php sidebar_module($splitright_chrome, 'splitright', $jj_const); ?>
	<?php } ?>
    <?php sidebar_module($topright_chrome, 'topright', $jj_const); ?>
	<?php sidebar_module($right_chrome, 'right', $jj_const); ?>
	<?php sidebar_module($btmright_chrome, 'btmright', $jj_const); ?>
 </div>
 <?php if ( $tertiary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
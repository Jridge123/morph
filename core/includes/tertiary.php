<?php if ($this->countModules( 'splitright or topright or right or bottomright' ) > 0) { ?>
<div class="sidebar yui-u" id="tertiary-content">
 <?php if ( $tertiary_inner == 1 ) { ?><div class="tertiary-inner"><?php } ?>
    <?php
    if($this->countMenuChildren() || $this->countModules( 'splitright' ) > 0 ) sidebar_module($splitright_chrome, 'splitright', $jj_const, $splitright_modfx, $this, $nojs);
    sidebar_module($topright_chrome, 'topright', $jj_const, $topright_modfx, $this, $nojs);
	sidebar_module($right_chrome, 'right', $jj_const, $right_modfx, $this, $nojs);
	sidebar_module($bottomright_chrome, 'bottomright', $jj_const, $bottomright_modfx, $this, $nojs);
	?>
 </div>
 <?php if ( $tertiary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
<?php if ($this->countModules( 'splitleft or topleft or left or bottomleft' ) > 0) { ?>
<div class="sidebar yui-b" id="secondary-content">
 <?php if ( $secondary_inner == 1 ) { ?><div class="secondary-inner clearer"><?php } ?>
    <?php
    if($this->countMenuChildren() || $this->countModules( 'splitleft' ) > 0 ) sidebar_module($splitleft_chrome, 'splitleft', $jj_const, $splitleft_modfx, $this, $nojs);
    sidebar_module($topleft_chrome, 'topleft', $jj_const, $topleft_modfx, $this, $nojs);
	sidebar_module($left_chrome, 'left', $jj_const, $left_modfx, $this, $nojs);
	sidebar_module($bottomleft_chrome, 'bottomleft', $jj_const, $bottomleft_modfx, $this, $nojs);
	?>
 </div>
 <?php if ( $secondary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>


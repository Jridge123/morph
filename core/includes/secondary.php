<?php if (JDocumentHTML::countModules( 'splitleft or topleft or left or bottomleft' ) > 0) { ?>
<div class="sidebar yui-b" id="secondary-content">
 <?php if ( $secondary_inner == 1 ) { ?><div class="secondary-inner clearer"><?php } ?>
    <?php
    if($this->countMenuChildren() || JDocumentHTML::countModules( 'splitleft' ) > 0 ) sidebar_module($splitleft_chrome, 'splitleft', $jj_const, $splitleft_modfx, $this, $debug_modules, $nojs);
    sidebar_module($topleft_chrome, 'topleft', $jj_const, $topleft_modfx, $this, $debug_modules, $nojs);
	sidebar_module($left_chrome, 'left', $jj_const, $left_modfx, $this, $debug_modules, $nojs);
	sidebar_module($bottomleft_chrome, 'bottomleft', $jj_const, $bottomleft_modfx, $this, $debug_modules, $nojs);
	?>
 </div>
 <?php if ( $secondary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
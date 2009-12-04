<?php if (JDocumentHTML::countModules( 'innersplit or inner1 or inner2 or inner3 or inner4 or inner5' ) > 0) { ?>
<div class="sidebar yui-u" id="tertiary-content">
 <?php if ( $tertiary_inner == 1 ) { ?><div class="tertiary-inner clearer"><?php } ?>
    <?php
    if($this->countMenuChildren() || JDocumentHTML::countModules( 'innersplit' ) > 0 ) sidebar_module($innersplit_chrome, 'innersplit', $jj_const, $innersplit_modfx, $this, $debug_modules, $nojs);
    sidebar_module($inner1_chrome, 'inner1', $jj_const, $inner1_modfx, $this, $debug_modules, $nojs);
    sidebar_module($inner2_chrome, 'inner2', $jj_const, $inner2_modfx, $this, $debug_modules, $nojs);
    sidebar_module($inner3_chrome, 'inner3', $jj_const, $inner3_modfx, $this, $debug_modules, $nojs);
    sidebar_module($inner4_chrome, 'inner4', $jj_const, $inner4_modfx, $this, $debug_modules, $nojs);
    sidebar_module($inner5_chrome, 'inner5', $jj_const, $inner5_modfx, $this, $debug_modules, $nojs);
	?>
 </div>
 <?php if ( $tertiary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
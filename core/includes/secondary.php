<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if (JDocumentHTML::countModules('outer1 or outer2 or outer3 or outer4 or outer5') || ($this->countMenuChildren()) ){ ?>
<div class="sidebar yui-b" id="secondary-content">
 <?php if ( $secondary_inner == 1 ) { ?><div class="secondary-inner clearer"><?php } ?>
    <?php if($MORPH->countModules('outersplit')){ ?>
        <jdoc:include type="modules" name="outersplit" style="split" />
    <?php } ?>
    <?php
    sidebar_module($outer1_chrome, 'outer1', $jj_const, $outer1_modfx, $this, $debug_modules, $nojs);
	sidebar_module($outer2_chrome, 'outer2', $jj_const, $outer2_modfx, $this, $debug_modules, $nojs);
    sidebar_module($outer3_chrome, 'outer3', $jj_const, $outer3_modfx, $this, $debug_modules, $nojs);
	sidebar_module($outer4_chrome, 'outer4', $jj_const, $outer4_modfx, $this, $debug_modules, $nojs);
    sidebar_module($outer5_chrome, 'outer5', $jj_const, $outer5_modfx, $this, $debug_modules, $nojs);
	?>
 </div>
 <?php if ( $secondary_inner == 1 ) { ?></div><?php } ?>
<?php } ?>
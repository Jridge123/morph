<?php if ($this->countModules( 'splitleft or topleft or left or bottomleft' )) { ?>
<div class="sidenav yui-b" id="secondary-content">
 <div class="inner">
    <?php if ($this->countMenuChildren()){ ?>
    <jdoc:include type="modules" name="splitleft" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $splitleft_chrome; } ?>" />
    <?php } ?>
    <jdoc:include type="modules" name="topleft" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $topleft_chrome; } ?>" />
    <jdoc:include type="modules" name="left" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $left_chrome; } ?>" />
    <jdoc:include type="modules" name="bottomleft" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $btmleft_chrome; } ?>" />
 </div>
</div>
<?php } ?>
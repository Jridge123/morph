<?php if($this->countModules('left' )) { ?>
<div class="sidenav yui-b" id="secondary-content">
 <div class="inner">
    <?php if ($this->countMenuChildren()){ ?>
    <jdoc:include type="modules" name="splitleft" style="<?php echo $splitleft_chrome ?>" />
    <?php } ?>
    <jdoc:include type="modules" name="topleft" style="<?php echo $topleft_chrome ?>" />
    <jdoc:include type="modules" name="left" style="<?php echo $left_chrome ?>" />
    <jdoc:include type="modules" name="bottomleft" style="<?php echo $btmleft_chrome ?>" />
 </div>
</div>
<?php } ?>
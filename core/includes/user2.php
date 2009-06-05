<?php if($this->countModules('user2') && $user2_show == 0 ) { ?>
<div id="user2" class="<?php echo $site_width ?> intelli <?php getYuiSuffix('user2', $jj_const); ?> <?php echo $user2_chrome ?>">
	<?php if ( $user2_inner == 1 ) { ?><div id="user2-inner"><?php } ?>
	<jdoc:include type="modules" name="user2" style="<?php echo $user2_chrome ?>" />
	<?php if ( $user2_inner == 1 ) { ?></div><?php } ?>
</div>
<?php } ?>
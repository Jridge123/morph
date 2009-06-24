<?php if($this->countModules('user1') && $user1_show == 0 ) { ?>
<div id="user1" class="intelli <?php getYuiSuffix('user1', $jj_const); ?> <?php echo $user1_chrome ?> modcount<?php echo $user1count ?>">
	<?php if ( $user1_inner == "1" ) { ?><div id="user1-inner"><?php } ?>
	<jdoc:include type="modules" name="user1" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $user1_chrome; } ?>" />
	<?php if ( $user1_inner == "1" ) { ?></div><?php } ?>
</div>
<?php } ?>
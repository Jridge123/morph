<?php if($this->countModules('topshelf') && $topshelf_show == 0 ) { ?>
<?php if ( $topshelf_wrap == 1 ) { ?><div id="topshelf-wrap"><?php } ?>
	<div id="topshelf" class="<?php echo $site_width ?> intelli <?php getYuiSuffix('topshelf', $jj_const); ?> clearer modcount<?php echo $topshelfcount; ?> <?php echo $topshelf_chrome ?> <?php echo $topshelf_modfx; ?>">
		<?php if ( $topshelf_inner == 1 ) { ?><div id="topshelf-inner"><?php } ?>
		<jdoc:include type="modules" name="topshelf" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $topshelf_chrome; } ?>" />
		<?php if ( $topshelf_inner == "1" ) { ?></div><?php } ?>
	</div>
<?php if ( $topshelf_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
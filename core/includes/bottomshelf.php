<?php if($this->countModules('bottomshelf') && $bottomshelf_show == 0 ) { ?>
	<?php if ( $bottomshelf_wrap == 1 ) { ?><div id="bottomshelf-wrap"><?php } ?>
		<div id="bottomshelf" class="<?php echo $site_width ?> intelli <?php getYuiSuffix('bottomshelf', $jj_const); ?> clearer <?php echo $bottomshelf_chrome ?>">
			<?php if ( $bottomshelf_inner == 1 ) { ?><div id="bottomshelf-inner"><?php } ?>	  
			<jdoc:include type="modules" name="bottomshelf" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $bottomshelf_chrome; } ?>" />
			<?php if ( $bottomshelf_inner == 1 ) { ?></div><?php } ?>
		</div>
	<?php if ( $bottomshelf_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
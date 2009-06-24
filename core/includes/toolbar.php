<?php if($this->countModules('toolbar') && $toolbar_show == 0 ) { ?>
	<?php if ( $toolbar_wrap == "1" ) { ?><div id="toolbar-wrap"><?php } ?>
		<div id="toolbar" class="intelli <?php getYuiSuffix('toolbar', $jj_const); ?> <?php echo $site_width ?> <?php echo $toolbar_chrome ?>">
			<jdoc:include type="modules" name="toolbar" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $toolbar_chrome; } ?>" />
		</div>			
	<?php if ( $toolbar_wrap == "1" ) { ?></div><?php } ?>
<?php } ?>
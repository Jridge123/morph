<?php if($this->countModules('subhead') && $subhead_show == 0 ) { ?>
	<?php if ( $subhead_wrap == "1" ) { ?><div id="subhead-wrap"><?php } ?>
	<div id="subhead" class="<?php echo $site_width; ?> clearer">	     <jdoc:include type="modules" name="subhead" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $subhead_chrome; } ?>" />
	</div>
	<?php if ( $subhead_wrap == "1" ) { ?></div><?php } ?>
<?php } ?>
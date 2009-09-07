<?php if ($this->countModules( 'user3 or user4' ) && $topnav_show == 0 ) { ?>
<?php if ( $topnav_wrap == 1 ) { ?><div id="topnav-wrap"<?php if ( $topfish >= 1 ) { ?> class="topfish <?php if ( $subtext_top >= 1 ) { ?> subtext<?php } ?>"<?php } if ( $topdrop >= 1 ) { ?> class="topdrop <?php if ( $subtext_top >= 1 ) { ?> subtext<?php } ?>"<?php } ?>><?php } ?>
	<div id="topnav" class="<?php echo $site_width; if ( $subtext_top >= 1 ) { ?> subtext<?php } if ( $topnav_actionlink >= 1 ) { ?> call-for-action<?php } ?> clearer<?php if ( $topfish >= 1 ) { ?> topfish<?php } if ( $topdrop >= 1 ) { ?> topdrop<?php } ?>">
	  <?php if($this->countModules('user3')) { ?>
	  	<div id="nav" class="clearer">
	     <jdoc:include type="modules" name="user3" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } if($this->countModules('user4')) { ?>
	  	<div>
	     <jdoc:include type="modules" name="user4" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } ?>
	  
	</div>
<?php if ( $topnav_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
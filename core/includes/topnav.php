<?php if (JDocumentHTML::countModules( 'user3 or user4' ) && $topnav_show == 0 ) { ?>

<?php if ( $topnav_wrap == 1 ) { ?>
<div id="topnav-wrap" class="<?php if($subtext_top >= 1){ echo 'subtext'; } if($subtext_top == 0){ echo 'no-subtext'; } 
if($topfish >= 1){ echo ' topfish'; } if($topdrop >= 1){ echo ' topdrop'; } ?>">
<?php } ?>

	<div id="topnav" class="<?php echo $site_width; if($subtext_top >= 1){ echo ' subtext'; } if($subtext_top == 0) { 
	echo ' no-subtext'; } if ( $topnav_actionlink >= 1 ) echo ' call-for-action';  echo ' clearer'; if ( $topfish >= 1 ) { echo ' topfish'; } 
	if ( $topdrop >= 1 ) { echo ' topdrop'; } ?>">
	  <?php if(JDocumentHTML::countModules('user3')) { ?>
	  	<div id="nav" class="clearer">
	     <jdoc:include type="modules" name="user3" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } if(JDocumentHTML::countModules('user4')) { ?>
	  	<div id="nav-side">
	     <jdoc:include type="modules" name="user4" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } ?>
	  
	</div>
    <?php if ( $topnav_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>

<?php if ( $topdrop >= 1 ) { ?>
	<div id="topdrop-bar-wrap"></div>
<?php } ?>
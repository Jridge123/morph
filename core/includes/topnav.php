<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if($global_wrap == 1 && $global_wrap_start == 3){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
<?php if (JDocumentHTML::countModules( 'user3 or user4' ) && $topnav_show == 0 ) { ?>
<?php if ( $topnav_wrap == 1 ) { ?>
<div id="topnav-wrap" class="<?php echo pt_classes(array('subtext' => $subtext, 'topdrop' => $topdrop, 'topfish' => $topfish)); ?>">
<?php } ?>
	<div id="topnav" class="<?php echo pt_classes(array('subtext' => $subtext, 'topnav_actionlink' => $topnav_actionlink, 'topdrop' => $topdrop, 'topfish' => $topfish), $site_width); ?><?php if ( $topnav_wrap == 1 ) { echo ' wrap-on'; } else { echo ' wrap-off'; } ?> primary-nav">
	<?php if ( $topnav_inner == 1 ) { ?><div id="topnav-inner" class="clearer"><?php } ?>
	  <?php if(JDocumentHTML::countModules('user3')) { ?>
	  	<div id="nav" class="clearer">
	     <jdoc:include type="modules" name="user3" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } if(JDocumentHTML::countModules('user4')) { ?>
	  	<div id="nav-side">
	     <jdoc:include type="modules" name="user4" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
	    </div>
	  <?php } ?>
	<?php if ( $topnav_inner == 1 ) { ?></div><?php } ?>
	  </div>

    <?php if ( $topnav_wrap == 1 ) { ?></div><?php } ?>
    <?php if ( $topdrop >= 1 ) { ?>
    	<div id="topdrop-bar-wrap"  class="topnav <?php if ( $topnav_wrap == 0 ) {  echo pt_classes(array(), $site_width); } ?>"></div>
    <?php } ?>
<?php } ?>
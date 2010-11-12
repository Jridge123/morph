<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$morph = Morph::getInstance(); ?>
<?php if(file_exists($inc_topnav)) { include_once($inc_topnav); } else { ?>
	<?php if($morph->global_wrap == 1 && $morph->global_wrap_start == 3 && $morph->topnav_wrap !== 'topnav_inside')){ ?>
		<div id="global-wrap" class="<?php echo $morph->site_width; ?>">
	<?php } ?>
	<?php if (Morph::countModules( 'user3 or user4' ) && $morph->topnav_show == 0 ) { ?>
		<?php if ( $morph->topnav_wrap == 1 ) { ?>
			<div id="topnav-wrap" class="wrap block <?php echo $morph->topnav_blockfx.' '; echo pt_classes(array('subtext' => $morph->subtext, 'topdrop' => $morph->topdrop, 'topfish' => $morph->topfish)); ?>">
		<?php } ?>
	<?php } ?>
		<div id="topnav" class="block <?php echo $morph->topnav_blockfx.' '; echo pt_classes(array('subtext' => $morph->subtext, 'topnav_actionlink' => $topnav_actionlink, 'topdrop' => $morph->topdrop, 'topfish' => $morph->topfish), $morph->site_width); ?><?php if ( $morph->topnav_wrap == 1 ) { echo ' wrap-on'; } else { echo ' wrap-off'; } ?> primary-nav">	
			<?php if ( $morph->topnav_inner == 1 && $morph->topnav_wrap !== 'topnav_inside' ) { ?>
				<div id="topnav-inner" class="inner clearer">
			<?php } ?>
				<?php if(Morph::countModules('user3')) { ?>
					<div id="nav" class="clearer">
						<jdoc:include type="modules" name="user3" style="<?php if( $morph->debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
					</div>
				<?php } ?>
				<?php if($morph->topnav_wrap !== 'topnav_inside') { ?>
					<?php if(Morph::countModules('user4')) { ?>
					<div id="nav-side">
						<jdoc:include type="modules" name="user4" style="<?php if( $morph->debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
					</div>
					<?php } ?>
				<?php } ?>
			<?php if ($morph->topnav_inner == 1 && $morph->topnav_wrap !== 'topnav_inside') { ?>
				</div>
			<?php } ?>
		</div><!-- #nav closing div -->
		<?php if($morph->topnav_wrap !== 'topnav_inside') { ?>
			<?php if ( $morph->topnav_wrap == 1 ) { ?></div><?php } ?>
		<?php } ?>
		<?php if ( $morph->topdrop >= 1 ) { ?><div id="topdrop-bar-wrap"  class="topnav <?php if ( $morph->topnav_wrap == 0 ) {  echo pt_classes(array(), $morph->site_width); } ?>"></div><?php } ?>
	<?php } ?>
<?php } ?>
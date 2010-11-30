<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$morph = Morph::getInstance();
if(file_exists($inc_mastheadnav)) { include_once($inc_mastheadnav); } else { ?>
	<?php if(Morph::countModules('user3')) { ?>
	<div id="topnav" class="mastheadnav <?php echo $morph->topnav_blockfx.' '; echo pt_classes(array('subtext' => $morph->subtext, 'topnav_actionlink' => $morph->topnav_actionlink, 'topdrop' => $morph->topdrop, 'topfish' => $morph->topfish)); ?>">
		<div id="nav" class="clearer">
			<jdoc:include type="modules" name="user3" style="<?php if( $morph->debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
		</div>
	</div>
	<?php } ?>
	<?php if ( $morph->topdrop >= 1 ) { ?><div id="topdrop-bar-wrap"  class="topnav <?php if ( $morph->topnav_wrap == 0 ) {  echo pt_classes(array()); } ?>"></div><?php } ?>
<?php } ?>
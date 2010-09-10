<div id="branding" class="logotype-<?php echo $morph->logo_type; ?><?php if ( $slogan_text !== "" ) { ' slogan'; } ?>">
	<?php if ( $morph->logo_type == 0 ) { ?>
		<!-- h1 text logo -->
		<h1><a href="<?php echo JURI::root() ?>" title="<?php if ($morph->logo_linktitle != ""){ echo $morph->logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
		<?php if ($morph->logo_text != ""){ echo $morph->logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
		</a></h1>
	<?php } ?>

		<?php if ( $morph->logo_type == 1 ) { ?>
		<!-- h1 image logo -->
		<h1><a href="<?php echo JURI::root() ?>" title="<?php if ($morph->logo_linktitle != ""){ echo $morph->logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
		<?php if ($morph->logo_text != ""){ echo $morph->logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
		</a></h1>
	<?php } ?>

		<?php if ( $morph->logo_type == 2 ) { ?>
		<!-- inline image logo -->
		<a class="logo-img" href="<?php echo JURI::root() ?>" title="<?php if ($morph->logo_linktitle != ""){ echo $morph->logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
		<img src="<?php echo $logo; ?>" width="<?php echo $morph->logo_size[0]; ?>" height="<?php echo $morph->logo_size[1]; ?>" alt="<?php if ( $morph->logo_alttext != ""){ echo $morph->logo_alttext; } else { echo $mainframe->getCfg('sitename'); } ?>" border="0" /></a>
	<?php } ?>

		<?php if ( $morph->logo_type == 3 ) { ?>
		<!-- inline image logo -->
		<div id="logo"><jdoc:include type="modules" name="branding" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $masthead_chrome; } ?>" /></div>
	<?php } ?>

	<?php if ( $morph->display_slogan == 1 ) { ?>
		<p class="slogan"><?php echo $morph->slogan_text; ?></p>
	<?php } ?>	
</div>
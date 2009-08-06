<div id="iphone-wrap">
	<a href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
	<img src="morph_assets/logos/<?php echo $logo_image; ?>" width="<?php echo $logo_size[0]; ?>" height="<?php echo $logo_size[1]; ?>" alt="<?php if ( $logo_alttext != ""){ echo $logo_alttext; } else { echo $mainframe->getCfg('sitename'); } ?>" border="0" /></a>
				
	<?php if($this->countModules('iphone1')) { ?>
		<div id="iphone1">
			<jdoc:include type="modules" name="iphone1" style="basic" />
		</div>
	<?php } if($this->countModules('iphone2')) { ?>
		<div id="iphone2">
			<jdoc:include type="modules" name="iphone2" style="basic" />
		</div>
	<?php } ?>
	
	<jdoc:include type="message" />
	<jdoc:include type="component" />
	
	<?php if($this->countModules('iphone3')) { ?>
		<div id="iphone3">
			<jdoc:include type="modules" name="iphone3" style="basic" />
		</div>
	<?php } if($this->countModules('iphone4')) { ?>
		<div id="iphone4">
			<jdoc:include type="modules" name="iphone4" style="basic" />
		</div>
	<?php } ?>
</div>
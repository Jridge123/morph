<div id="iphone-wrap">
	<div id="iphone-header"<?php if($iphone_header){ ?> style="background-image:url(<?php echo $assetspath; ?>/iphone/<?php echo $iphone_header; ?>);"<?php } ?><?php if($iphone_webclip){ ?> class="webclip"<?php } ?>>
	    <?php if($iphone_webclip){ ?><img src="<?php echo $assetspath; ?>/iphone/<?php echo $iphone_webclip; ?>" width="30px" border="0" /><?php } ?>
	    <a href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
		<span><?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?></span>
	</a>
	</div>
	
	<?php if(JDocumentHTML::countModules('iphonenav')) { ?>
	<div id="iphone-nav">
		<jdoc:include type="modules" name="iphonenav" style="basic" />
	</div>
	<?php } ?>	

	<div class="iphone-inner">			
	<?php if(JDocumentHTML::countModules('iphone1')) { ?>
		<div id="iphone1"><jdoc:include type="modules" name="iphone1" style="basic" /></div>
	<?php } if(JDocumentHTML::countModules('iphone2')) { ?>
		<div id="iphone2"><jdoc:include type="modules" name="iphone2" style="basic" /></div>
	<?php } ?>
	<jdoc:include type="message" />
	<jdoc:include type="component" />
	<?php if(JDocumentHTML::countModules('iphone3')) { ?>
		<div id="iphone3"><jdoc:include type="modules" name="iphone3" style="basic" /></div>
	<?php } if(JDocumentHTML::countModules('iphone4')) { ?>
		<div id="iphone4"><jdoc:include type="modules" name="iphone4" style="basic" /></div>
	<?php } ?>
</div>
</div>
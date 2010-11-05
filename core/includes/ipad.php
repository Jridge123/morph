<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div id="top" class="skipto">
    <ul>
        <li><a href="#ipade4">skip to bottom</a></li>
        <li><a href="#content">skip to content</a></li>
    </ul>
</div>
<div id="ipad-wrap">
	<div id="ipad-header"<?php if($ipad_header){ ?> style="background-image:url(<?php echo $assetspath; ?>/ipad/<?php echo $ipad_header; ?>);"<?php } ?><?php if($ipad_webclip){ ?> class="webclip"<?php } ?>>
	    <?php if($ipad_webclip){ ?><img src="<?php echo $assetspath; ?>/ipad/<?php echo $ipad_webclip; ?>" width="30px" border="0" /><?php } ?>
	    <a href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
		<span><?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?></span>
	</a>
	</div>
	
	<?php if(JDocumentHTML::countModules('ipadnav')) { ?>
	<div id="ipad-nav">
		<jdoc:include type="modules" name="ipadnav" style="basic" />
	</div>
	<?php } ?>
	
	<?php if(JDocumentHTML::countModules('ipad1')) { ?>
	<div id="ipad1"><jdoc:include type="modules" name="ipad1" style="basic" /></div>
    <?php } ?>

	<div id="content" class="ipad-inner">			
	    <?php if(JDocumentHTML::countModules('ipad2')) { ?>
		    <div id="ipad2"><jdoc:include type="modules" name="ipad2" style="basic" /></div>
	    <?php } ?>
	        <jdoc:include type="message" />
	        <jdoc:include type="component" />
	    <?php if(JDocumentHTML::countModules('ipad3')) { ?>
		    <div id="ipad3"><jdoc:include type="modules" name="ipad3" style="basic" /></div>
	    <?php } ?>
    </div>

	<?php if(JDocumentHTML::countModules('ipad4')) { ?>
	<div id="ipad4"><jdoc:include type="modules" name="ipad4" style="basic" /></div>
    <?php } ?>

</div>
<div id="bottom" class="skipto">
    <ul>
        <li><a href="#ipad-wrap">back to top</a></li>
        <li><a href="#content">back to content</a></li>
    </ul>
</div>
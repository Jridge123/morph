<?php if ( $masthead_show == 0 ) { ?>
    <?php if($global_wrap == 1 && $global_wrap_start == 1){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
    
    <?php if ( $masthead_wrap == 1 ) { ?><div id="masthead-wrap"><?php } ?>
    <div class="<?php echo $site_width . ' ' . $masthead_gridsplit . ' ' . $masthead_chrome; ?>" id="masthead">
	  <?php if ( $masthead_inner == 1 ) { ?><div id="masthead-inner" class="clearer"><?php } ?>

      <div id="branding" class="logotype-<?php echo $logo_type; ?><?php if ( $slogan_text !== "" ) { ' slogan'; } ?>">
         
   		<?php if ( $logo_type == 0 ) { ?>
			<!-- h1 text logo -->
			<h1><a href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
			<?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
			</a></h1>
		<?php } ?>
  
 		<?php if ( $logo_type == 1 ) { ?>
			<!-- h1 image logo -->
			<h1><a href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
			<?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
			</a></h1>
		<?php } ?>

  		<?php if ( $logo_type == 2 ) { ?>
			<!-- inline image logo -->
			<a class="logo-img" href="<?php echo JURI::root() ?>" title="<?php if ($logo_linktitle != ""){ echo $logo_linktitle; } else { echo $mainframe->getCfg('sitename'); } ?>">
			<img src="<?php echo $logo; ?>" width="<?php echo $logo_size[0]; ?>" height="<?php echo $logo_size[1]; ?>" alt="<?php if ( $logo_alttext != ""){ echo $logo_alttext; } else { echo $mainframe->getCfg('sitename'); } ?>" border="0" /></a>
		<?php } ?>

  		<?php if ( $logo_type == 3 ) { ?>
			<!-- inline image logo -->
			<div id="logo"><jdoc:include type="modules" name="branding" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $masthead_chrome; } ?>" /></div>
		<?php } ?>

		<?php if ( $display_slogan == 1 ) { ?>
			<p class="slogan"><?php echo $slogan_text; ?></p>
		<?php } ?>
		
		<?php if ( $display_skipto == 1 ) { ?>
		<ul id="skipto">
			<?php if (JDocumentHTML::countModules( 'user3' )) : ?>
			<li><a title="Skip to menu" href="<?php JURI::root(); ?>#topnav"><?php echo JText::_('skip to menu'); ?></a></li>
			<?php endif; ?>
			<li><a title="Skip to primary content" href="<?php JURI::root(); ?>#primary-content"><?php echo JText::_('skip to primary content'); ?></a></li>
			<?php if (JDocumentHTML::countModules( 'splitleft or topleft or left or btmleft' )) : ?>
			<li><a title="Skip to secondary content" href="<?php JURI::root(); ?>#secondary-content"><?php echo JText::_('skip to secondary content'); ?></a></li>
			<?php endif; if (JDocumentHTML::countModules( 'splitright or topright or right or btmright' )) : ?>
			<li><a title="Skip to tertiary content" href="<?php JURI::root(); ?>#tertiary-content"><?php echo JText::_('skip to tertiary content'); ?></a></li>
			<?php endif; if (JDocumentHTML::countModules( 'user1 or user2' )) : ?>
			<li><a title="Skip to search" href="<?php JURI::root(); ?>#mod_search_searchword"><?php echo JText::_('skip to search'); ?></a></li>
			<?php endif; ?>
		</ul>
		<?php } ?>
         
      </div>
      <?php if(JDocumentHTML::countModules('top')) { ?>
      <div class="<?php echo pt_classes(array('default_menu' => $default_menu, 'subtext' => $subtext, 'topnav_actionlink' => $topnav_actionlink, 'topdrop' => $topdrop, 'topfish' => $topfish)); ?> primary-nav" id="top">
         <jdoc:include type="modules" name="top" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo $masthead_chrome; } ?>" />
	 </div>
      <?php } ?>
    <?php if ( $masthead_inner == 1 ) { ?></div><?php } ?>
   </div>
   <?php if ( $topdrop >= 1 ) { ?>
   	<div id="topdrop-bar-wrap"></div>
   <?php } ?>
<?php if ( $masthead_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
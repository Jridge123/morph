<?php if ( $masthead_show == 0 ) {
	  if ( $masthead_wrap == 1 ) { ?><div id="masthead-wrap"><?php } ?>
		
   <div class="<?php echo $site_width;?> <?php echo $masthead_gridsplit;?> <?php echo $masthead_chrome; ?>" id="masthead">

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
			<img src="morph_assets/logos/<?php echo $logo_image; ?>" width="<?php echo $logo_size[0]; ?>" height="<?php echo $logo_size[1]; ?>" alt="<?php if ( $logo_alttext != ""){ echo $logo_alttext; } else { echo $mainframe->getCfg('sitename'); } ?>" border="0" /></a>
		<?php } ?>

  		<?php if ( $logo_type == 3 ) { ?>
			<!-- inline image logo -->
			<div id="logo"><jdoc:include type="modules" name="branding" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $masthead_chrome; } ?>" /></div>
		<?php } ?>




		<?php if ( $display_slogan == "1" ) { ?>
			<p class="slogan"><?php echo $slogan_text; ?></p>
		<?php } ?>
		
		<?php if ( $display_skipto == "1" ) { ?>
		<ul id="skipto">
			<?php if ($this->countModules( 'user3' )) : ?>
			<li><a title="Skip to menu" href="<?php JURI::root(); ?>#topnav"><?php echo JText::_('skip to menu'); ?></a></li>
			<?php endif; ?>
			<li><a title="Skip to primary content" href="<?php JURI::root(); ?>#primary-content"><?php echo JText::_('skip to primary content'); ?></a></li>
			<?php if ($this->countModules( 'splitleft or topleft or left or btmleft' )) : ?>
			<li><a title="Skip to secondary content" href="<?php JURI::root(); ?>#secondary-content"><?php echo JText::_('skip to secondary content'); ?></a></li>
			<?php endif; if ($this->countModules( 'splitright or topright or right or btmright' )) : ?>
			<li><a title="Skip to tertiary content" href="<?php JURI::root(); ?>#tertiary-content"><?php echo JText::_('skip to tertiary content'); ?></a></li>
			<?php endif; if ($this->countModules( 'user1 or user2' )) : ?>
			<li><a title="Skip to search" href="<?php JURI::root(); ?>#mod_search_searchword"><?php echo JText::_('skip to search'); ?></a></li>
			<?php endif; ?>
		</ul>
		<?php } ?>
         
      </div>
      <?php if($this->countModules('top')) { ?>
      <div  id="top">
         <jdoc:include type="modules" name="top" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo $masthead_chrome; } ?>" />
	 </div>
      <?php } ?>
   </div>
   
<?php if ( $masthead_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
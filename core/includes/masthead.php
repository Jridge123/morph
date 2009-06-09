<?php if ( $masthead_show == 0 ) { ?>
<?php if ( $masthead_wrap == 1 ) { ?><div id="top-wrap"><?php } ?>

   <div class="<?php echo $site_width ?> <?php echo $masthead_gridsplit ?> <?php echo $masthead_chrome ?>" id="top">

      <div id="branding" class="yui-u first<?php if ( $logo_type == "0" ) { ?> img-logo<?php } if ( $logo_type == "1" ) { ?> txt-logo<?php } if ( $logo_type == "2" ) { ?> h1-logo<?php } if ( $display_slogan == "1" ) { ?> slogan<?php } ?>">
         
         <?php if ( $logo_type == 0 ) { ?>
         <a href="<?php echo JURI::root() ?>" title="<?php if ($slogan_text != ""){ echo $slogan_text; } else { echo $mainframe->getCfg('sitename'); } ?>"><img src="<?php echo $templatepath; ?>/assets/logos/<?php if( isIE6() && $logo_image_ie !== ''){ echo $ie_logo_image; } else { echo $logo_image; } ?>" width="<?php echo $logo_width; ?>" height="<?php echo $logo_height; ?>" alt="<?php if ( $logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>" border="0" /></a>
         
         <?php } if ( $logo_type == 1 ) { ?>
         <a href="<?php echo JURI::root() ?>" title="<?php if ($slogan_text != ""){ echo $slogan_text; } else { echo $mainframe->getCfg('sitename'); } ?>" class="logo">
         <?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
         <?php if ( $display_slogan == 1 ) { ?>
         <span><?php echo $slogan_text; ?></span>
         <?php } ?>
         </a>
         
         <?php } if ( $logo_type == 2 ) { ?>
         <h1><a href="<?php echo JURI::root() ?>" title="<?php if ($slogan_text != ""){ echo $slogan_text; } else { echo $mainframe->getCfg('sitename'); } ?>">
            <?php if ($logo_text != ""){ echo $logo_text; } else { echo $mainframe->getCfg('sitename'); } ?>
            </a></h1>
         <?php } ?>
              
         <?php if ( $logo_type == 3 ) { ?>
         <jdoc:include type="modules" name="branding" style="<?php echo $masthead_chrome ?>" />
         <?php } ?>
       
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
         
      </div>
      <?php if($this->countModules('top')) { ?>
      <div  id="top2" class="yui-u last">
         <jdoc:include type="modules" name="top" style="<?php echo $masthead_chrome ?>" />
      </div>
      <?php } ?>
   </div>
   
<?php if ( $masthead_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>
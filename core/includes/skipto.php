<?php if ( $morph->display_skipto == 1 ) { ?>
<ul id="skipto">
		<?php if (Morph::countModules( 'user3' )) : ?>
		<li><a title="Skip to menu" href="<?php JURI::root(); ?>#topnav"><?php echo JText::_('skip to menu'); ?></a></li>
		<?php endif; ?>
		<li><a title="Skip to primary content" href="<?php JURI::root(); ?>#primary-content"><?php echo JText::_('skip to primary content'); ?></a></li>
		<?php if (Morph::countModules( 'splitleft or topleft or left or btmleft' )) : ?>
		<li><a title="Skip to secondary content" href="<?php JURI::root(); ?>#secondary-content"><?php echo JText::_('skip to secondary content'); ?></a></li>
		<?php endif; if (Morph::countModules( 'splitright or topright or right or btmright' )) : ?>
		<li><a title="Skip to tertiary content" href="<?php JURI::root(); ?>#tertiary-content"><?php echo JText::_('skip to tertiary content'); ?></a></li>
		<?php endif; if (Morph::countModules( 'user1 or user2' )) : ?>
		<li><a title="Skip to search" href="<?php JURI::root(); ?>#mod_search_searchword"><?php echo JText::_('skip to search'); ?></a></li>
		<?php endif; ?>
</ul>
<?php } ?>
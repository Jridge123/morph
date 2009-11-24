<?php 
/*
// JoomlaWorks "Simple RSS Feed Reader" Module for Joomla! 1.5.x - Version 2.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// ***Last update: November 12th, 2009***
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
Here we call the stylesheet style.css from a folder called 'css' and located at the same directory with this template file. If Joomla!'s cache is turned on, we print out the CSS include within a script tag so we're valid and the styling is included properly (it's how Joomla! works unfortunately).
*/
$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));

?>

<div class="srfrContainer <?php echo $moduleclass_sfx; ?>">

	<?php if($feedsBlockPreText): ?>
	<p class="srfrPreText"><?php echo $feedsBlockPreText; ?></p>
	<?php endif; ?>
	
	<ul class="srfrList">
		<?php foreach($output as $key=>$feed): ?>
		<li class="srfrRow<?php echo $key%2; ?>">
			<span class="feedSource"><!--<?php echo $feed->feedTitle; ?> | --><?php echo $feed->itemDate; ?></span>
			<a target="_blank" href="<?php echo $feed->itemLink; ?>">
				<?php echo $feed->itemTitle; ?>
				
				<!-- popup info tooltip -->
				<?php if($feedItemDescription): ?>
				<div>
					<span>
					<?php if($feedItemTitle): ?>
					<h5 class="srfrTitle"><?php echo $feed->itemTitle; ?></h5>
					<?php endif; ?>
				
					<?php if($feed->feedImageSrc): ?>
					<!-- first image on the feed -->
					<img class="srfrImage" src="<?php echo $feed->feedImageSrc; ?>" alt="<?php echo $feed->itemTitle; ?>" />
					<?php endif; ?>
					
					<p><?php echo $feed->itemDescription; ?></p>
					
					<p><strong><?php echo JText::_('Source:'); ?></strong> <?php echo $feed->feedTitle; ?></p>
					<p><strong><?php echo JText::_('Created on:'); ?></strong> <?php echo $feed->itemDate; ?></p>
					</span>
				</div>
				<?php endif; ?>
				<!-- end - popup info tooltip -->
			</a>
		</li>
		<?php endforeach; ?>	
	</ul>
	
	<?php if($feedsBlockPostText): ?>
	<p class="srfrPostText"><?php echo $feedsBlockPostText; ?></p>
	<?php endif; ?>
	
	<?php if($feedsBlockPostLink): ?>
	<p class="srfrPostTextLink"><a href="<?php echo $feedsBlockPostLinkURL; ?>"><?php echo $feedsBlockPostLinkTitle; ?></a></p>
	<?php endif; ?>
</div>

<div class="clr"></div>

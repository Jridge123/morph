<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
?>
<div class="srfrContainer">
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
				<span class="popup-container">
					<span class="inner">
					<?php if($feedItemTitle): ?>
					<span class="srfrTitle"><?php echo $feed->itemTitle; ?></span>
					<?php endif; ?>
					<?php if($feed->feedImageSrc): ?>
					<!-- first image on the feed -->
					<img class="srfrImage" src="<?php echo $feed->feedImageSrc; ?>" alt="<?php echo $feed->itemTitle; ?>" />
					<?php endif; ?>
					<span><?php echo $feed->itemDescription; ?></span>
					<span><strong><?php echo JText::_('Source:'); ?></strong> <?php echo $feed->feedTitle; ?></span>
					<span><strong><?php echo JText::_('Created on:'); ?></strong> <?php echo $feed->itemDate; ?></span>
					</span>
				</span>
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
<?php } ?><!-- close the themelet override check -->
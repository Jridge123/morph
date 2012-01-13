<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div class="newsflash">
	<?php if ($params->get('item_title')) : ?>
		<?php if ($params->get('link_titles') && $item->linkOn != '') : ?>
		<a href="<?php echo $item->linkOn;?>" class="contentpagetitle"><?php echo $item->title;?></a><?php else : ?><?php echo $item->title; ?><?php endif; ?>
	<?php endif; ?>
	<?php if (!$params->get('intro_only')) : echo $item->afterDisplayTitle; endif; ?>
	<?php echo $item->beforeDisplayContent; ?>
	<?php echo $item->text; ?>
	<?php if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) : echo '<a class="readmore" href="'.$item->linkOn.'">'.$item->linkText.'</a>'; endif; ?>
</div>
<?php } ?><!-- close the themelet override check -->
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$view = &JFactory::getDocument();
if($override = Morph::override(__FILE__, $view)) {
   if(file_exists($override)) include $override;
} else { ?>
<div class="bannergroup">
	<?php if ($headerText) : ?><h4><?php echo $headerText ?></h4><?php endif; ?>
	<ul>
		<?php foreach($list as $item) : ?><li><?php echo modBannersHelper::renderBanner($params, $item); ?></li><?php endforeach; ?>
	</ul>
	<?php if ($footerText) : ?><p><?php echo $footerText ?></p><?php endif; ?>
</div>
<?php } ?><!-- close the themelet override check -->
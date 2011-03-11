<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<a href="<?php echo $link ?>"><span>rss</span></a>
<?php } ?><!-- close the themelet override check -->
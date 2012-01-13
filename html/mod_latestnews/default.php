<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<ul class="latestnews">
	<?php foreach ($list as $item) :  ?>
	<li><a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a></li>
	<?php endforeach; ?>
</ul>
<?php } ?><!-- close the themelet override check -->
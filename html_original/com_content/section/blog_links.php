<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<h3><?php echo JText::_('More Articles...'); ?></h3>
<ul id="section-list">
	<?php foreach ($this->links as $link) : ?>
	<li class="blogsection"><a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($link->slug, $link->catslug, $link->sectionid)); ?>"><?php echo $link->title; ?></a></li>
	<?php endforeach; ?>
</ul>
<?php } ?><!-- close the themelet override check -->
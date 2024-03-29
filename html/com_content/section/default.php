<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
$cparams = JComponentHelper::getParams ('com_media');
?>
<?php if ($this->params->get('show_page_title',1)) : ?>
<h1>
	<?php echo $this->escape($this->params->get('page_title')); ?>
</h1>
<?php endif; ?>
<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
<div class="desc">
	<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
	<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path').'/'.$this->section->image; ?>" class="img-<?php echo $this->section->image_position; ?>" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->section->description) :
		echo $this->section->description;
	endif; ?>
	<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
	<div class="wrap_image">&nbsp;</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<?php if ($this->params->def('show_categories', 1) && count($this->categories)) : ?>
<ul id="section-links">
	<?php foreach ($this->categories as $category) :
		if (!$this->params->get('show_empty_categories') && !$category->numitems) :
			continue;
		endif; ?>
	<li class="category">
		<a href="<?php echo $category->link; ?>"><?php echo $category->title; ?></a>
		<?php if ($this->params->get('show_cat_num_articles')) : ?>
		<span class="small">
			( <?php if ($category->numitems==1) {
			echo $category->numitems ." ". JText::_( 'item' );	}
			else {
			echo $category->numitems ." ". JText::_( 'items' );} ?> )
		</span>
		<?php endif; ?>
		<?php if ($this->params->def('show_category_description', 1) && $category->description) : ?>
		<p class="cat-desc"><?php echo $category->description; ?></p>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php } ?><!-- close the themelet override check -->
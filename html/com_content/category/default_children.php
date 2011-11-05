<?php
/**
 * @version		$Id: blog_children.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {

$class = ' first';
?>

<?php if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>
	<ul id="section-links" class="list-reset">
	<?php foreach($this->children[$this->category->id] as $id => $child) : ?>
		<?php
		if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
			if (!isset($this->children[$this->category->id][$id + 1])) :
				$class = ' class="last"';
			endif;
		?>
		<li class="category<?php echo $class; ?>">
			<?php $class = ''; ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
				<?php echo $this->escape($child->title); ?>
				<?php if ( $this->params->get('show_cat_num_articles',1)) : ?><span class="small">( <?php echo $child->getNumItems(true); ?> <?php echo JText::_('Articles') ; ?> )</span><?php endif ; ?>
			</a>
			
			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
				<?php if ($child->description) : ?>
					<p class="cat-desc">
						<?php echo JHtml::_('content.prepare', $child->description); ?>
					</p>
				<?php endif; ?>
            <?php endif; ?>

			<?php if (count($child->getChildren()) > 0):
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				if ($this->maxLevel != 0) :
					echo $this->loadTemplate('children');
				endif;
				$this->category = $child->getParent();
				$this->maxLevel++;
			endif; ?>
		</li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>

<?php } // close the themelet override check ?>
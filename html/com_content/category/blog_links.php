<?php
/**
 * @version		$Id: blog_links.php 21321 2011-05-11 01:05:59Z dextercowley $
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

?>

<h3><?php echo JText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>
<ul>
	<?php foreach ($this->links as $link) : ?>
	<li class="blogsection">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
			<?php echo $item->title; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>

<?php } // close the themelet override check ?>
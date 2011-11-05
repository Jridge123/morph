<?php
/**
 * @version		$Id: default_item.php 21321 2011-05-11 01:05:59Z dextercowley $
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

// Create a shortcut for params.
$params = &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$morph = Morph::getInstance();
?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if (($params->get('show_author')) or ($params->get('show_create_date')) or ($params->get('show_author')) or ($params->get('show_print_icon')) or ($params->get('show_email_icon'))  ) : ?>
<ul class="article-info">		
    <?php if ($params->get('show_publish_date')) : ?>
        <li class="created"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', $morph->date($this->item->publish_up)); ?></li>
    <?php endif; ?>
    <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<li class="author">
	    <?php $author =  $this->item->author; ?>
	    		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
	    			<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
	    				<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
	    				 JHtml::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>
	    			<?php else :?>
	    				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	    			<?php endif; ?>
	</li>
    <?php endif; ?>
	<?php if ($params->get('show_print_icon')) : ?>
    <li class="icons print"><?php echo JHtml::_('icon.print_popup', $this->item, $params); ?></li>
    <?php endif; ?>
	<?php if ($params->get('show_email_icon')) : ?>
    <li class="icons email"><?php echo JHtml::_('icon.email', $this->item, $params); ?></li>
    <?php endif; ?>
    <?php if ($canEdit) : ?>
    <li class="icons edit"><?php echo JHtml::_('icon.edit', $this->item, $params); ?></li>
    <?php endif; ?>
</ul>
<?php endif; ?>


<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
			<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
						    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>

<?php } // close the themelet override check ?>
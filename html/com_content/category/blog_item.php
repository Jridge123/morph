<?php // @version $Id: blog_item.php 11215 2008-10-26 02:25:51Z ian $
defined('_JEXEC') or die('Restricted access');
?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
<div class="contentpaneopen_edit <?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_title')) : ?>
<h2 class="contentheading <?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle <?php echo $this->item->params->get('pageclass_sfx'); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
	<?php else :
		echo $this->escape($this->item->title);
	endif; ?>
</h2>
<?php endif; ?>

<?php if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<ul class="blogview-info">
<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
    <li class="section-cat"><?php if ($this->item->params->get('link_section')) : ?><?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
    <?php endif; ?><?php echo $this->item->section; ?><?php if ($this->item->params->get('link_section')) : ?>
    <?php echo '</a>'; ?><?php endif; ?><?php if ($this->item->params->get('show_category')) : ?><?php echo ' - '; ?><?php endif; ?><?php endif; ?>
    <?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
    <?php if ($this->item->params->get('link_category')) : ?><?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?><?php endif; ?>
    <?php echo $this->item->category; ?><?php if ($this->item->params->get('link_section')) : ?><?php echo '</a>'; ?><?php endif; ?></li>
<?php endif; if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
    <li class="blog-item-author"><?php JText::printf( 'Written by', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author) ); ?></li>
<?php endif; if ($this->item->params->get('show_create_date')) : ?>
    <li class="blogview-date">&nbsp;on <?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?></li>
<?php endif; if ($this->item->params->get('show_url') && $this->item->urls) : ?>
    <li><a href="http://<?php echo $this->item->urls ; ?>" target="_blank"><?php echo $this->item->urls; ?></a></li>
<?php endif; if ($this->item->params->get('show_pdf_icon')) : ?>
    <li class="btn-pdf"><?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?></li>
<?php endif; if ( $this->item->params->get( 'show_print_icon' )) : ?>
    <li class="btn-print"><?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?></li>
<?php endif; if ($this->item->params->get('show_email_icon')) : ?>
    <li class="btn-email"><?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?></li>
<?php endif; ?>
</ul>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
<span class="small">
	<a href="<?php echo $this->item->urls; ?>" target="_blank">
		<?php echo $this->item->urls; ?></a>
</span>
<?php endif; ?>

<?php if (isset ($this->item->toc)) :
	echo $this->item->toc;
endif; ?>

<?php echo JFilterOutput::ampReplace($this->item->text);  ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<p>
	<a href="<?php echo $this->item->readmore_link; ?>" class="readon <?php echo $this->item->params->get('pageclass_sfx'); ?>" title="<?php echo JText::sprintf($this->item->title);; ?>">
		<?php if ($this->item->readmore_register) :
			echo JText::_('Register to read more...');
		elseif ($readmore = $this->item->params->get('readmore')) :
			echo $readmore;
		else :
			echo JText::_('Read More...');
		endif; ?></a>
</p>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent;

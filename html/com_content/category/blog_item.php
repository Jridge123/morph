<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
include_once(JPATH_ROOT.'/templates/morph/html/com_content/icon.php');
$lang =& JFactory::getLanguage();
$lang->load('tpl_morph', JPATH_SITE);
$canEdit = ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
$morph = Morph::getInstance();
?>
<?php if ($this->item->params->get('show_title')) : ?>
<h2 class="contentheading">
	<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
	<a href="<?php echo $this->item->readmore_link; ?>">
		<?php echo $this->escape($this->item->title); ?></a>
	<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
	<?php endif; ?>
</h2>
<?php endif; ?>

<!-- created date and author -->
<?php if ($this->item->params->get('show_author') && ($this->item->author != "") ||	$this->item->params->get('show_create_date') ||	$this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon') || ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'))){ ?>	
<ul class="article-info">		
<?php if ($this->item->params->get('show_create_date')) { ?>
    <li class="created"><?php echo $morph->date($this->item->created); ?></li>
<?php } if (($this->item->params->get('show_author')) && ($this->item->author != "")) { ?>
	<li class="author"><?php JText::printf('Written by', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author)); ?></li>
<?php } if ($this->item->params->get('show_pdf_icon')) { ?>
    <li class="icons"><?php echo articleIcons::pdf($this->item, $this->item->params, $this->access); ?></li>
<?php } if ($this->item->params->get('show_print_icon')) { ?>
    <li class="icons"><?php echo articleIcons::print_popup($this->item, $this->item->params, $this->access); ?></li>
<?php } if ($this->item->params->get('show_email_icon')) { ?>
    <li class="icons"><?php echo articleIcons::email($this->item, $this->item->params, $this->access); ?></li>
<?php } ?>
<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
	<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
<?php endif; ?>
</ul>
<?php } ?>

<!-- section & category -->
<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) { ?>
<p class="filing">
	<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) { ?>		
		<?php if ($this->item->params->get('link_section')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; } ?>
		<span class="article-section"><?php echo $this->item->section; ?></span>
		<?php if ($this->item->params->get('link_section')) { echo '</a>'; } ?>
	<?php } ?>
	<?php if ($this->item->params->get('show_category') && $this->item->catid) { ?>
		<?php if ($this->item->params->get('link_category')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; } ?>
		<span class="article-category"><?php echo $this->item->category; ?></span>
		<?php if ($this->item->params->get('link_category')) { echo '</a>'; } ?>
	<?php } ?>
</p>
<?php } ?>		

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if (isset ($this->item->toc)) :
	echo $this->item->toc;
endif; ?>

<?php echo JFilterOutput::ampReplace($this->item->text);  ?>

	<!-- date modified -->
	<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>.</p>
	<?php endif; ?>

    <?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
    <p class="readon">
    
	<?php if ($morph->article_preview) : ?>
	<a href="<?php echo $this->item->readmore_link; ?>" title="<?php echo JText::sprintf($this->item->title); ?>" rel="article-preview" class="preview-link"><?php echo JText::_('TPL_MORPH_ARTICLE_PREVIEW'); ?></a>
	<?php endif ?>

	<a href="<?php echo $this->item->readmore_link; ?>" title="<?php echo JText::sprintf($this->item->title); ?>">
	<?php if ($this->item->readmore_register) :
		echo JText::_('Register to read more...');
	elseif ($readmore = $this->item->params->get('readmore')) :
		echo $readmore;
	else :
		echo JText::sprintf('READMORE', '<span>', $this->escape($this->item->title), '</span>');
	endif; ?></a>		
		
    </p>
    <?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>
<?php } ?><!-- close the themelet override check -->
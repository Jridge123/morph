<?php // @version $Id: blog_item.php 11215 2008-10-26 02:25:51Z ian $
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');
?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
<div class="contentpaneopen_edit<?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_title')) : ?>
<h1 class="contentheading">
<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
<a href="<?php echo $this->item->readmore_link; ?>"><?php echo $this->escape($this->item->title); ?></a>
<?php else : echo $this->escape($this->item->title); endif; ?></h1>

<?php endif; if (!$this->item->params->get('show_intro')) :
echo $this->item->event->afterDisplayTitle;
endif; echo $this->item->event->beforeDisplayContent; ?>

<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) { ?>
	<ul class="article-options">
	<?php if ($this->item->params->get('show_pdf_icon')) { ?>
		<li><?php echo articleIcons::pdf($this->item, $this->item->params, $this->access); ?></li>
	<?php } ?>
	<?php if ($this->item->params->get('show_print_icon')) { ?>
		<li><?php echo articleIcons::print_popup($this->item, $this->item->params, $this->access); ?></li>
	<?php } ?>
	<?php if ($this->item->params->get('show_email_icon')) { ?>
		<li><?php echo articleIcons::email($this->item, $this->item->params, $this->access); ?></li>
	<?php } ?>
	</ul>
<?php } ?>
	
	<!-- created date and author -->
	<?php if ($this->item->params->get('show_author') && ($this->item->author != "") ||	$this->item->params->get('show_create_date') ||	$this->item->params->get('show_section') && ($this->item->sectionid && isset($this->item->section)) ||	$this->item->params->get('show_category') && $this->item->catid) { ?>
		<p class="article-info">
		
			<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) { ?>
				<span class="author">
					Posted by 
					<strong><?php JText::printf($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author); ?></strong>
				</span>
			<?php } ?>
			
			<?php if (($this->item->params->get('show_author')) && ($this->item->author != "") && ($this->item->params->get('show_create_date'))) { ?>
			on
			<?php } ?>
			<?php if ($this->item->params->get('show_create_date')) { ?>
				<span class="created"><?php echo JHTML::_('date', $this->item->created, JText::_('<strong>%a, %d %B %Y</strong>')); ?></span>.
			<?php } ?>

			<!-- section & category -->
			<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) { ?>
			<span class="filing">
				<?php echo JText::_('Filed under'); ?>
				<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) { ?>		
					<?php if ($this->item->params->get('link_section')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; } ?>
					<strong class="article-section"><?php echo $this->item->section; ?></strong>
					<?php if ($this->item->params->get('link_section')) { echo '</a>'; } ?>
			<?php } if ($this->item->params->get('show_section') && $this->item->params->get('show_category')) { ?>
				 / 
				<?php } if ($this->item->params->get('show_category') && $this->item->catid) { ?>
					<?php if ($this->item->params->get('link_category')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; } ?>
					<strong class="article-category"><?php echo $this->item->category; ?></strong>
					<?php if ($this->item->params->get('link_category')) { echo '</a>'; } ?>
				<?php } ?>
			</span>
			<?php } ?>
		</p>	
	<?php } ?>

<?php if (isset ($this->item->toc)) :
	echo $this->item->toc;
endif; ?>

<?php echo JFilterOutput::ampReplace($this->item->text); ?>

	<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="readon">
			<?php if ($this->item->readmore_register) :
				echo JText::_('Register to read more...');
			elseif ($readmore = $this->item->params->get('readmore')) :
				echo $readmore;
			else :
				//echo JText::sprintf('Read more', '<span>' . $this->item->title . '</span>');
				echo JText::sprintf('<span>Read</span> more');
			endif; ?>
		</a>
	<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent;

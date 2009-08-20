<?php // no direct access
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');

$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>

<!-- filed under -->
	<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
		<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
		<p class="filed-as">
		
			<span class="article-section">
				<?php if ($this->item->params->get('link_section')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
				<?php endif; ?>
				
				<?php echo $this->item->section; ?>
				
				<?php if ($this->item->params->get('link_section')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
			
			</span>
			<?php endif; ?>
			
			<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>	
			<span class="sep">&nbsp;/&nbsp;</span>
			<?php endif; ?>
			
			
			<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
			<span class="article-category">
				<?php if ($this->item->params->get('link_category')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
				<?php endif; ?>
				<?php echo $this->item->category; ?>
				<?php if ($this->item->params->get('link_category')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			
		</p>
	<?php endif; ?>
	
	
<?php if ($this->item->params->get('show_title') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>

<!-- article heading -->
	<?php if ($this->item->params->get('show_title')) : ?>
	<h2 class="contentheading<?php echo $this->item->params->get( ' pageclass_sfx' ); ?>">
		<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
			<a href="<?php echo $this->item->readmore_link; ?>">
				<?php echo $this->escape($this->item->title); ?>
			</a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
	<?php endif; ?>

<!-- article options -->
	<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
	<ul class="article-options">
		<?php if ($this->item->params->get('show_pdf_icon')) : ?>
			<li><?php echo articleIcons::pdf($this->item, $this->item->params, $this->access); ?></li>
		<?php endif; ?>
		<?php if ($this->item->params->get('show_print_icon')) : ?>
			<li><?php echo articleIcons::print_popup($this->item, $this->item->params, $this->access); ?></li>
		<?php endif; ?>
		<?php if ($this->item->params->get('show_email_icon')) : ?>
			<li><?php echo articleIcons::email($this->item, $this->item->params, $this->access); ?></li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>


<?php endif; ?>


<!-- after display title -->
<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<!-- created date and author -->
<?php if ($this->item->params->get('show_author') || $this->item->params->get('show_create_date')) : ?>
	<p class="article-info">
		<?php if ($this->item->params->get('show_create_date')) : ?>
			<span class="created"><?php echo JHTML::_('date', $this->item->created, JText::_('%a, %d %b %y')); ?></span>
		<?php endif; if ($this->item->params->get('show_author') && $this->item->params->get('show_create_date')) : ?>
			<span class="sep">&nbsp;|&nbsp;</span>
		<?php endif; if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
			<span class="author"><?php JText::printf($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author); ?></span>
		<?php endif; ?>
	</p>
<?php endif; ?>


<!-- table of contents -->
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>

<!-- teaser text -->
<?php echo $this->item->text; ?>

<!-- date modified -->
<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
	<p class="modified">
		<?php echo JText::_( 'Last Updated' ); ?>: <?php echo JHTML::_('date', $this->item->modified, JText::_('%a, %d %b %y')); ?>
	</p>
<?php endif; ?>

<!-- readon link -->
<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
	<a href="<?php echo $this->item->readmore_link; ?>" class="readon">
		<?php if ($this->item->readmore_register) :
			echo JText::_('Register to read more...');
		elseif ($readmore = $this->item->params->get('readmore')) :
			echo $readmore;
		else :
			echo JText::sprintf('<span>Read</span> more');
		endif; ?>
	</a>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
<?php echo $this->item->event->afterDisplayContent; ?>
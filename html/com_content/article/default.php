<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="article-page">
<?php $canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')); ?>

<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
	<h1 class="componentheading <?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
<?php endif; ?>
<?php if ($canEdit || $this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
<div class="contentpaneopen article-top <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php if ($this->params->get('show_title')) : ?>
	<h1 class="contentheading <?php echo $this->params->get( 'pageclass_sfx' ); ?>" width="100%">
		<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
		<a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
			<?php echo $this->escape($this->article->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->article->title); ?>
		<?php endif; ?>
	</h1>
	<?php endif; ?>
	
	
	
	
	
	
<!-- start -->		
<?php if (!$this->print) : ?>

    <ul class="article-options">
    
		<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
		<li class="author"><?php JText::printf( 'Written by', ($this->article->created_by_alias ? $this->article->created_by_alias : $this->article->author) ); ?></li>
		<?php endif; ?>
		
		<?php if ($this->params->get('show_create_date')) : ?>
		<li class="created"><?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?></li>
		<?php endif; ?>

		<?php if ($this->params->get('show_pdf_icon')) : ?>
		<li class="pdf"><?php echo JHTML::_('icon.pdf',  $this->article, $this->params, $this->access); ?></li>
		<?php endif; ?>
		
		<?php if ($this->params->get('show_print_icon')) : ?>
		<li class="print"><?php echo JHTML::_('icon.print_popup', $this->article, $this->params, $this->access); ?></li>
		<?php endif; ?>
		
		<?php if ($this->params->get('show_email_icon')) : ?>
		<li class="email "><?php echo JHTML::_('icon.email', $this->article, $this->params, $this->access); ?></li>
		<?php endif; ?>
		
		<?php if ($canEdit) : ?>
		<li class="edit">
		<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
		</li>
		<?php endif; ?>

	</ul>

<!-- middle -->		
<?php else : ?>
		<div class="editor-buttonheading">
        	<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
		</div>
	<?php endif; ?>

</div>
<!-- end -->	
<?php endif; ?>

<?php  if (!$this->params->get('show_intro')) :
	echo $this->article->event->afterDisplayTitle;
endif; ?>
<?php echo $this->article->event->beforeDisplayContent; ?>
<div class="contentpaneopen article-main <?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
<p class="section">
		<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
		<span>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->article->section; ?>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
				<?php if ($this->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
		<span>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->article->category; ?>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
</p>
<?php endif; ?>

<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
<p class="article-link"><a href="http://<?php echo $this->article->urls ; ?>" target="_blank">
<?php echo $this->article->urls; ?></a></p>
<?php endif; ?>

<div class="article-body">
<?php if (isset ($this->article->toc)) : ?>
<?php echo $this->article->toc; ?>
<?php endif; ?>
<?php echo $this->article->text; ?>
</div>

<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
<p class="modified"><?php echo JText::_( 'Last Updated' ); ?> (<?php echo JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2')); ?>)</p>
<?php endif; ?>
		
</div>
<?php echo $this->article->event->afterDisplayContent; ?>
</div>

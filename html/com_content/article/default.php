<?php // no direct access
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');
$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
?>

<div class="article-page">

	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
	<h1 class="article-title">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>

				

	<?php if ($this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>

	<div class="article-top clearer">
	<!-- start article top -->
		<?php if ($this->params->get('show_title')) : ?>
		<h1 class="article-title">
		<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
			<a href="<?php echo $this->article->readmore_link; ?>"><?php echo $this->escape($this->article->title); ?><?php if ($canEdit) : ?><span class="edit"> <?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?></span><?php endif; ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->article->title); ?><?php if ($canEdit) : ?><span class="edit"> <?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?></span><?php endif; ?>
		<?php endif; ?>
		</h1>
		<?php endif; ?>

		<?php if (!$this->print) : ?>
		<?php if ($canEdit || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
		<ul class="article-options">
			<?php if ($this->params->get('show_pdf_icon')) : ?>
			<li><?php echo articleIcons::pdf($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>
			<?php if ($this->params->get('show_print_icon')) : ?>
			<li><?php echo articleIcons::print_popup($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_icon')) : ?>
			<li><?php echo articleIcons::email($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>
		<?php endif; ?>
	
		<?php if (($this->params->get('show_author')) && ($this->article->author != "") or $this->params->get('show_create_date')) : ?>
		<p class="article-info">
			<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
				<span class="author">Written by <strong><?php JText::printf($this->article->created_by_alias ? $this->article->created_by_alias : $this->article->author); ?></strong></span>
			<?php endif; ?>
			<?php if ($this->params->get('show_create_date')) : ?>
				<span class="sep">&nbsp;|&nbsp;</span>
			<?php endif; ?>
			<?php if ($this->params->get('show_create_date')) : ?>
				<span class="created"><?php echo JHTML::_('date', $this->article->created, JText::_('Posted on <strong>%a, %d %b %y</strong>')) ?></span>
			<?php endif; ?>

				<span class="sep">&nbsp;|&nbsp;</span>
				<a href="<?php echo $this->article->readmore_link; ?>|<?php echo $this->escape($this->article->title); ?>" rel="shareit">Share Article</a>
				<span class="sep">&nbsp;|&nbsp;</span><span id="fontsizer"></span>
				
			<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section) or $this->params->get('show_category') && $this->article->catid) : ?>
			<br />Filed under: 
			<?php endif; ?>
			
			<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
			<?php if ($this->params->get('link_section')) : ?><?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?><?php endif; ?>
				<span class="article-section"><strong><?php echo $this->article->section; ?></strong></span>
			<?php if ($this->params->get('link_section')) : ?><?php echo '</a>'; ?><?php endif; ?>
			<?php endif; ?>
			<?php if ($this->params->get('show_category')) : ?>
				<span class="filing-sep">&nbsp;/&nbsp;</span>
			<?php endif; ?>
			<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
				<?php if ($this->params->get('link_category')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
					<?php endif; ?>
					<span class="article-category"><strong><?php echo $this->article->category; ?></strong></span>
					<?php if ($this->params->get('link_category')) : ?>
					<?php echo '</a>'; ?>
					<?php endif; ?>
			<?php endif; ?>
		</p>
		<?php endif; ?>
			
	</div>
	<!-- end article top -->
	<?php endif; ?>

	<!-- intro text -->
	<?php  if (!$this->params->get('show_intro')) :	echo $this->article->event->afterDisplayTitle; endif; ?>

	<!-- article body -->
	<?php echo $this->article->event->beforeDisplayContent; ?>
	<div class="article-body clearer" id="article">
		<?php if (isset ($this->article->toc)) : ?>
		<!-- article table of contents -->
		<div class="article-toc">
			<?php echo $this->article->toc; ?>
		</div>
		<?php endif; ?>
		
		<!-- start content output -->
		<?php echo $this->article->text; ?>

		<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::_( 'Last updated on:' ); ?> <?php echo JHTML::_('date', $this->article->modified, JText::_('%a, %d %b %y')); ?></p>
		<?php endif; ?>
	</div>
	<?php echo $this->article->event->afterDisplayContent; ?>

<div id="shareit-box">
	<div id="shareit-header"></div>
	<div id="shareit-body">
		<div id="shareit-blank"></div>
		<div id="shareit-url"><input type="text" value="" name="shareit-field" id="shareit-field" class="field"/></div>
		<div id="shareit-icon">
		<ul>
			<li class="shareit-mail"><a href="#" rel="shareit-mail" class="shareit-sm">Mail</a></li>
			<li class="shareit-delicious"><a href="#" rel="shareit-delicious" class="shareit-sm">Delicious</a></li>
			<li class="shareit-designfloat"><a href="#" rel="shareit-designfloat" class="shareit-sm">Designfloat</a></li>
			<li class="shareit-digg"><a href="#" rel="shareit-digg" class="shareit-sm">Digg</a></li>
			<li class="shareit-stumbleupon"><a href="#" rel="shareit-stumbleupon" class="shareit-sm">StumbleUpon</a></li>
			<li class="shareit-twitter"><a href="#" rel="shareit-twitter" class="shareit-sm">Twitter</a></li>
		</ul>
		</div>
	</div>
</div>



</div>
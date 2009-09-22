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
			<a href="<?php echo $this->article->readmore_link; ?>"><?php echo $this->escape($this->article->title); ?><?php if ($canEdit) : ?><span class="edit"> 
			<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?></span><?php endif; ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->article->title); ?><?php if ($canEdit) : ?><span class="edit"> <?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
			</span><?php endif; ?>
		<?php endif; ?>
		</h1>
		<?php endif; ?>
	
<!-- created date and author -->
<?php if (
$this->params->get('show_author') && ($this->article->author != "") ||	
$this->params->get('show_create_date') ||	
$this->params->get('show_section') ||	
$this->params->get('show_category') ||
$this->params->get('show_pdf_icon') ||
$this->params->get('show_print_icon') || 
$this->params->get('show_email_icon'))	{ ?>
	
<ul class="article-info">
			
<?php if ($this->params->get('show_create_date')) { ?>
    <li class="created"><?php echo JHTML::_('date', $this->article->created, JText::_('%a, %d %b %y')); ?>
	<?php if ($this->params->get('show_create_date') && $this->params->get('show_author')){ ?>
        <span class="divider">|&nbsp;</span>
    <?php } ?></li>
<?php } ?>

<?php if (($this->params->get('show_author')) && ($this->article->author != "")) { ?>
	<li class="author">Written by <strong><?php JText::printf($this->article->created_by_alias ? $this->article->created_by_alias : $this->article->author); ?></strong></li>
<?php } ?>
	
<li>
				<span class="sep">&nbsp;|&nbsp;</span>
				<a href="<?php echo $this->article->readmore_link; ?>|<?php echo $this->escape($this->article->title); ?>" rel="shareit">Share Article</a>
				<span class="sep">&nbsp;|&nbsp;</span><span id="fontsizer"></span>
</li>

			<?php if ($this->params->get('show_pdf_icon')) : ?>
			<li class="icons"><?php echo articleIcons::pdf($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>
			<?php if ($this->params->get('show_print_icon')) : ?>
			<li class="icons"><?php echo articleIcons::print_popup($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_icon')) : ?>
			<li class="icons"><?php echo articleIcons::email($this->article, $this->params, $this->access); ?></li>
			<?php endif; ?>



</ul>


<?php } ?>	

<!-- section & category -->
<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section) or $this->params->get('show_category') && $this->article->catid) { ?>
<p class="filing">
			<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section) or $this->params->get('show_category') && $this->article->catid) : ?>
			Filed under: 
			<?php endif; ?>
			
			<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
			<?php if ($this->params->get('link_section')) : ?><?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?><?php endif; ?>
				<span class="article-section"><?php echo $this->article->section; ?></span>
			<?php if ($this->params->get('link_section')) : ?><?php echo '</a>'; ?><?php endif; ?>
			<?php endif; ?>
			<?php if ($this->params->get('show_category')) : ?>
				<span class="filing-sep">&nbsp;/&nbsp;</span>
			<?php endif; ?>
			<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
				<?php if ($this->params->get('link_category')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
					<?php endif; ?>
					<span class="article-category"><?php echo $this->article->category; ?></span>
					<?php if ($this->params->get('link_category')) : ?>
					<?php echo '</a>'; ?>
					<?php endif; ?>
			<?php endif; ?>
</p>
<?php } ?>
			
	</div>
	<!-- end article top -->
	<?php endif; ?>

	<!-- intro text -->
	<?php  if (!$this->params->get('show_intro')) :	echo $this->article->event->afterDisplayTitle; endif; ?>

	<!-- article body -->
	<div class="article-body clearer" id="article">
		<?php echo $this->article->event->beforeDisplayContent; ?>

		<?php if (isset ($this->article->toc)) : ?>
		<!-- article table of contents -->
		<?php echo $this->article->toc; ?>
		<?php endif; ?>
		
		<!-- start content output -->
		<div id="article-content">
		<?php echo $this->article->text; ?>
		
		<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::_( 'Last updated on:' ); ?> <?php echo JHTML::_('date', $this->article->modified, JText::_('%a, %d %b %y')); ?></p>
		<?php endif; ?>
		</div>
		
		<?php echo $this->article->event->afterDisplayContent; ?>
	</div>

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
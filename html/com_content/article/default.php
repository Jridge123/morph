<?php // no direct access
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');
$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>

<div class="article-page">

	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
	<h1 class="article-title">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>		

	<?php if ($this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>

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
    <li class="created"><?php echo JHTML::_('date', $this->article->created, JText::_('%d %b %y')); ?></li>
    <?php } ?>
    
    <?php if (($this->params->get('show_author')) && ($this->article->author != "")) { ?>
	<li class="author"><?php JText::printf('Written by', ($this->article->created_by_alias ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author))); ?></li>
    <?php } ?>
    <li class="share"><a href="<?php echo curPageURL(); ?>|<?php echo $this->escape($this->article->title); ?>" rel="shareit"><?php echo JText::_('Share Article'); ?></a></li>
    <li class="fontsize"><span class="fontsize-label"><?php echo JText::_('Text Size'); ?>: </span><span id="fontsizer"></span></li>
    
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

<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
<p class="filing">
	<?php if ($this->params->get('show_section') && $this->article->sectionid) : ?>
	<span class="article-section">
		<?php if ($this->params->get('link_section')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->escape($this->article->section); ?>
		<?php if ($this->params->get('link_section')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
		<?php if ($this->params->get('show_category')) : ?>
			<?php echo ' - '; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
	<span class="article-category">
		<?php if ($this->params->get('link_category')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->escape($this->article->category); ?>
		<?php if ($this->params->get('link_category')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
</p>
<?php endif; ?>



	
	<!-- end article top -->
	<?php endif; ?>

	<!-- intro text -->
	<?php  if (!$this->params->get('show_intro')) :	echo $this->article->event->afterDisplayTitle; endif; ?>

	<!-- article body -->
	<div class="article-body clearer<?php if (isset ($this->article->toc)) : ?> toc<?php endif; ?>" id="article">
		<?php echo $this->article->event->beforeDisplayContent; ?>

		<?php if (isset ($this->article->toc)) : ?>
		<!-- article table of contents -->
		<?php echo $this->article->toc; ?>
		<?php endif; ?>
		
		<!-- start content output -->
		<div id="article-content">
		<?php echo $this->article->text; ?>

	<!-- date modified -->
		<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>.</p>
	    <?php endif; ?>
		

		<div id="shareit-box">
        	<div id="shareit-header"></div>
        	<div id="shareit-body">
        		<div id="shareit-blank"></div>
        		<div id="shareit-url"><input type="text" value="" name="shareit-field" id="shareit-field" class="field"/></div>
        		<div id="shareit-icon">
        		<ul>
        			<li class="shareit-facebook"><a href="#" rel="shareit-facebook" class="shareit-sm">Facebook</a></li>
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
		
		<?php echo $this->article->event->afterDisplayContent; ?>
	</div>
</div>
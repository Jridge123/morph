<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
include_once(JPATH_ROOT.'/templates/morph/html/com_content/icon.php');
$lang =& JFactory::getLanguage();
$lang->load('tpl_morph', JPATH_SITE);
$canEdit = ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
$morph = Morph::getInstance();
$document = &JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
$option = array('style' => 'xhtml');
//$article1_chrome = array('style' => $morph->article_article1_chrome);
//$article1_chrome = array('style' => $morph->article_article2_chrome);
//$article1_chrome = array('style' => $morph->article_article3_chrome);
//gets the data from a URL  
function get_tiny_url($url){  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}
$current_url = JURI::getInstance()->toString();
$tiny_url = get_tiny_url($current_url);
?>
<div class="article-page">
	<?php echo $renderer->render('article1', $option, null); ?>
	
	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<div class="page-title">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>		
    
    <!-- start article top -->
    <?php if ($this->params->get('show_title')) : ?>
	    <?php if ($morph->article_title) : ?>
			<h1 class="article-title">
				<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
					<a href="<?php echo $this->article->readmore_link; ?>"><?php echo $this->escape($this->article->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->article->title); ?>
				<?php endif; ?>
			</h1>
	    <?php endif; ?>
	    
    <?php endif; ?>
    <?php if ($this->print) :
    	echo '<span class="print-icon">' . JHTML::_('icon.print_screen', $this->article, $this->params, $this->access) . '</span>';
    elseif ($this->params->get('show_author') || $this->params->get('show_create_date') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon') || ($morph->fontsizer_enabled) || ($morph->shareit_enabled) || ($canEdit)) : ?>
    <ul class="article-info">		
        <?php if ($this->params->get('show_create_date')) { ?>
   		<li class="created"><?php echo $morph->date($this->article->created); ?></li>
        <?php } ?>
        <?php if (($this->params->get('show_author')) && ($this->article->author != "")) { ?>
    	<li class="author"><?php JText::printf('Written by', ($this->article->created_by_alias ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author))); ?></li>
        <?php } ?>
        <?php if ($morph->shareit_enabled) : ?>
        <li class="share"><a href="<?php echo $tiny_url; ?>" title="<?php echo $this->escape($this->article->title); ?>" rel="shareit"><?php echo JText::_('TPL_MORPH_SHARE_ARTICLE'); ?></a></li>
        <?php endif; ?>
        <?php if ($morph->shorturl_enabled) : ?>
        <li class="shorturl"><a href="<?php echo $tiny_url; ?>">Short URL</a></li>
        <?php endif; ?>
        <?php if ($morph->fontsizer_enabled) : ?>
        <li class="fontsize"><span class="fontsize-label"><?php echo JText::_('TPL_MORPH_TEXT_SIZE'); ?>: </span><span id="fontsizer"></span></li>
        <?php endif; ?>
    	<?php if ($this->params->get('show_pdf_icon')) : ?>
    	<li class="icons pdf"><?php echo articleIcons::pdf($this->article, $this->params, $this->access); ?></li>
    	<?php endif; ?>
    	<?php if ($this->params->get('show_print_icon')) : ?>
    	<li class="icons print"><?php echo articleIcons::print_popup($this->article, $this->params, $this->access); ?></li>
    	<?php endif; ?>
    	<?php if ($this->params->get('show_email_icon')) : ?>
    	<li class="icons email"><?php echo articleIcons::email($this->article, $this->params, $this->access); ?></li>
    	<?php endif; ?>
    	<?php if ($canEdit) : ?><li class="icons edit"><span class="edit"><?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?></span></li><?php endif; ?>
    </ul>
	<?php endif; ?>
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
	<!-- intro text -->
	<?php echo $renderer->render('article2', $option, null); ?>
	<?php if (!$this->params->get('show_intro')) : echo $this->article->event->afterDisplayTitle; endif; ?>
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
		<?php echo $renderer->render('article3', $option, null); ?>
		<!-- date modified -->
		<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>.</p>
	    <?php endif; ?>
		<?php if ($morph->shareit_enabled) : ?>
		<div id="shareit-box">
        	<div id="shareit-header"></div>
        	<div id="shareit-body">
        		<div id="shareit-blank"></div>
        		<div id="shareit-url"><input type="text" value="" name="shareit-field" id="shareit-field" class="field"/></div>
        		<div id="shareit-icon">
        		<ul>
        			<li class="shareit-facebook"><a href="#" rel="shareit-facebook" class="shareit-sm" title="Facebook">Facebook</a></li>
        			<li class="shareit-delicious"><a href="#" rel="shareit-delicious" class="shareit-sm" title="Delicious">Delicious</a></li>
        			<li class="shareit-designfloat"><a href="#" rel="shareit-designfloat" class="shareit-sm" title="Designfloat">Designfloat</a></li>
        			<li class="shareit-digg"><a href="#" rel="shareit-digg" class="shareit-sm" title="Digg">Digg</a></li>
        			<li class="shareit-stumbleupon"><a href="#" rel="shareit-stumbleupon" class="shareit-sm" title="StumbleUpon">StumbleUpon</a></li>
        			<li class="shareit-twitter"><a href="#" rel="shareit-twitter" class="shareit-sm" title="Twitter">Twitter</a></li>
        		</ul>
        		</div>
        	</div>
        </div>
        <?php endif; ?>
		</div> 
		<?php echo $renderer->render('article4', $option, null); ?>
		<?php echo $this->article->event->afterDisplayContent; ?>
	</div>
</div>
<?php } ?><!-- close the themelet override check -->
<?php
/**
 * @version		$Id: default.php 21518 2011-06-10 21:38:12Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

if($override = Morph::override(__FILE__, $this)) :
	if(file_exists($override)) : include $override; endif;
else :

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
include_once(JPATH_ROOT.'/templates/morph/html/com_content/icon.php');

$lang =& JFactory::getLanguage();
if ( $lang->getTag() != 'en-GB' ) {
 $lang->load( 'tpl_morph', JPATH_SITE, 'en-GB' );
}
$lang->load( 'tpl_morph', JPATH_SITE, null, 1 );

$morph = Morph::getInstance();
$document = &JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
$option = array('style' => 'xhtml');
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();

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

<div class="article-page<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1 class="article-title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<?php if ($params->get('show_title')) : ?>
		<h2>
		<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
			<a href="<?php echo $this->item->readmore_link; ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
		</h2>
	<?php endif; ?>

	<?php if (
		$params->get('show_create_date') || 
		$params->get('show_author') || 
		$morph->shareit_enabled || 
		$morph->shorturl_enabled || 
		$morph->fontsizer_enabled || 
		$params->get('show_print_icon') || 
		$params->get('show_email_icon') || 
		$canEdit
	) : ?>

	<ul class="article-info">		
	    <?php if ($params->get('show_create_date')) : ?>
			<li class="created"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', $morph->date($this->item->publish_up)); ?></li>
	    <?php endif; ?>
	    <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
			<li class="author"><?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
			<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
			<?php
				$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
				$item = JSite::getMenu()->getItems('link', $needle, true);
				$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
			?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
			<?php else: ?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?></li>
	    <?php endif; ?>
	    <?php if (!$this->print) : ?>
	    	<?php if ($morph->shareit_enabled) : ?>
	    		<li class="share"><a href="<?php echo $tiny_url; ?>" title="<?php echo $this->escape($this->item->title); ?>" rel="shareit"><?php echo JText::_('TPL_MORPH_SHARE_ARTICLE'); ?></a></li>
	    	<?php endif; ?>
	    	<?php if ($morph->shorturl_enabled) : ?>
	    		<li class="shorturl"><a href="<?php echo $tiny_url; ?>">Short URL</a></li>
	    	<?php endif; ?>
	    	<?php if ($morph->fontsizer_enabled) : ?>
	    		<li class="fontsize"><span class="fontsize-label"><?php echo JText::_('TPL_MORPH_TEXT_SIZE'); ?>: </span><span id="fontsizer"></span></li>
	    	<?php endif; ?>
			<?php if ($params->get('show_print_icon')) : ?>
				<li class="icons print"><?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?></li>
			<?php endif; ?>
			<?php if ($params->get('show_email_icon')) : ?>
				<li class="icons email"><?php echo JHtml::_('icon.email',  $this->item, $params); ?></li>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
				<li class="icons edit"><span class="edit"><?php echo JHtml::_('icon.edit', $this->item, $params); ?></span></li>
			<?php endif; ?>
		<?php else : ?>
			<?php if ($params->get('show_print_icon')) : ?>
				<li class="icons print"><?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?></li>
			<?php endif; ?>
		<?php endif; ?>	
	</ul>
<?php endif; ?>	

<?php if( ($params->get('show_category')) OR ($params->get('show_parent_category')) ) : ?>
<p class="filing">
	<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
	<span class="article-parent-category">
		<?php $title = $this->escape($this->item->parent_title);
		$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
		<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
			<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
		<?php else : ?>
			<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php if ($params->get('show_category')) : ?>
	<span class="article-category">
		<?php $title = $this->escape($this->item->category_title);
		$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
		<?php if ($params->get('link_category') AND $this->item->catslug) : ?>
			<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
		<?php else : ?>
			<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
</p>
<?php endif; ?>


<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php echo $renderer->render('article2', $option, null); ?>

	<div class="article-body clearer<?php if (isset ($this->item->toc)) : ?> toc<?php endif; ?>" id="article">
	
		<?php if (isset ($this->item->toc)) : ?>
			<?php echo $this->item->toc; ?>
		<?php endif; ?>
	
		<div id="article-content">	
	
			<?php if ($params->get('access-view')):?>
				<?php echo $this->item->text; ?>
			<?php //optional teaser intro text for guests ?>
			<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
				<?php echo $this->item->introtext; ?>
				<?php //Optional link to let them register to see the whole article. ?>
				<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
					$link1 = JRoute::_('index.php?option=com_users&view=login');
					$link = new JURI($link1);?>
					<p class="readmore">
						<a href="<?php echo $link; ?>">
						<?php $attribs = json_decode($this->item->attribs);  ?>
						<?php
						if ($attribs->alternative_readmore == null) :
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
			<?php endif; ?>
		
			<?php echo $renderer->render('article3', $option, null); ?>
		
			<?php if ($params->get('show_modify_date')) : ?>
				<p class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?></p>
			<?php endif; ?>
			
			<?php if ($params->get('show_publish_date')) : ?>
				<p class="published"><?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHtml::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?></p>
			<?php endif; ?>
			
			<?php if ($params->get('show_hits')) : ?>
				<p class="hitsß"><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?></p>
			<?php endif; ?>
		</div>
		<?php echo $renderer->render('article4', $option, null); ?>
		<?php echo $this->item->event->afterDisplayContent; ?>
	</div>
</div>
<?php // close the themelet override check 
endif; ?>
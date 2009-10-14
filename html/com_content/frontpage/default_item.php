<?php
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');

$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
	
	<!-- article heading -->
	<?php if ($this->item->params->get('show_title')) : ?>
	<h2 class="contentheading">
		<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
			<a href="<?php echo $this->item->readmore_link; ?>"><?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
    	<?php if ($canEdit) : ?>
    		<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
    	<?php endif; ?>
	</h2>

	<?php endif; ?>

    <!-- created date and author -->
    <?php if ($this->item->params->get('show_author') && ($this->item->author != "") ||	$this->item->params->get('show_create_date') ||	$this->item->params->get('show_section') ||	$this->item->params->get('show_category') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) { ?>
    <ul class="article-info">		
        <?php if ($this->item->params->get('show_create_date')) { ?>
        <li class="created"><?php echo JHTML::_('date', $this->item->created, JText::_('%a, %d %b %y')); ?>
    	<?php if ($this->item->params->get('show_create_date') && $this->item->params->get('show_author')){ ?>
            <span class="divider">|&nbsp;</span>
        <?php } ?></li>
        <?php } ?>
        <?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) { ?>
    	<li class="author"><?php JText::printf('Written by', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author)); ?></li>
        <?php } ?>
        <?php if ($this->item->params->get('show_pdf_icon')) { ?><li class="icons"><?php echo articleIcons::pdf($this->item, $this->item->params, $this->access); ?></li><?php } ?>
        <?php if ($this->item->params->get('show_print_icon')) { ?><li class="icons"><?php echo articleIcons::print_popup($this->item, $this->item->params, $this->access); ?></li><?php } ?>
        <?php if ($this->item->params->get('show_email_icon')) { ?><li class="icons"><?php echo articleIcons::email($this->item, $this->item->params, $this->access); ?></li><?php } ?>
    </ul>
    <?php } ?>
        <!-- section & category -->
        <?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) { ?>
        <p class="filing">
    	<?php echo JText::_('Filed under'); ?>
    	<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) { ?>		
    		<?php if ($this->item->params->get('link_section')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; } ?>
    		<strong class="article-section"><?php echo $this->item->section; ?></strong>
    		<?php if ($this->item->params->get('link_section')) { echo '</a>'; } ?>
    	<?php } if (($this->item->params->get('show_section') && $this->item->sectionid) && ($this->item->params->get('show_category') && $this->item->catid)) { ?>	
    	 / 
    	<?php } if ($this->item->params->get('show_category') && $this->item->catid) { ?>
    		<?php if ($this->item->params->get('link_category')) { echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; } ?>
    		<strong class="article-category"><?php echo $this->item->category; ?></strong>
    		<?php if ($this->item->params->get('link_category')) { echo '</a>'; } ?>
    	<?php } ?>
        </p>
        <?php } ?>	

	<!-- after display title -->
	<?php  if (!$this->item->params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	
	<!-- table of contents -->
	<?php if (isset ($this->item->toc)) : ?>
		<?php echo $this->item->toc; ?>
	<?php endif; ?>
	
	<!-- teaser text -->
	<?php echo $this->item->text; ?>
	
	<!-- date modified -->
	<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
		<p class="modified"><?php echo JText::_( 'Last updated on ' ); ?><?php echo JHTML::_('date', $this->item->modified, JText::_('%a, %d %b %y')); ?>.</p>
	<?php endif; ?>
	

    <?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
    <p class="readon"><a href="<?php echo $this->item->readmore_link; ?>" title="<?php echo JText::sprintf($this->item->title); ?>">
    	<?php if ($this->item->readmore_register) :
    		echo JText::_('Register to read more...');
    	elseif ($readmore = $this->item->params->get('readmore')) :
    		echo $readmore;
    	else :
    		echo JText::_('Continue reading<span> "' . JText::sprintf($this->item->title). '"</span>');
    	endif; ?></a>
    </p>
    <?php endif; ?>


<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
<?php echo $this->item->event->afterDisplayContent; ?>
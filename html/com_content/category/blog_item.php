<?php // @version $Id: blog_item.php 11215 2008-10-26 02:25:51Z ian $
defined('_JEXEC') or die('Restricted access');
?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
<div class="contentpaneopen_edit <?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_title') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
	
	<?php if ($this->item->params->get('show_title')) : ?>
	<h2 class="contentheading <?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
		<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle <?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
    <ul class="article-options">
    	<?php if ($this->item->params->get('show_pdf_icon')) : ?>
    		<li class="article-pdf"><?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?></li>
    	<?php endif; ?>
    	<?php if ($this->item->params->get('show_print_icon')) : ?>
    		<li class="article-print"><?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?></li>
    	<?php endif; ?>
    	<?php if ($this->item->params->get('show_email_icon')) : ?>
    		<li class="article-email"><?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?></li>
    	<?php endif; ?>
    </ul>
	<?php endif; ?>
	
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
<span class="small">
	<a href="<?php echo $this->item->urls; ?>" target="_blank">
		<?php echo $this->item->urls; ?></a>
</span>
<?php endif; ?>

<?php if (isset ($this->item->toc)) :
	echo $this->item->toc;
endif; ?>

<?php echo JFilterOutput::ampReplace($this->item->text);  ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<p>
	<a href="<?php echo $this->item->readmore_link; ?>" class="readon <?php echo $this->item->params->get('pageclass_sfx'); ?>" title="<?php echo JText::sprintf($this->item->title);; ?>">
		<?php if ($this->item->readmore_register) :
			echo JText::_('Register to read more...');
		elseif ($readmore = $this->item->params->get('readmore')) :
			echo $readmore;
		else :
			echo JText::_('Read More...');
		endif; ?></a>
</p>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent;

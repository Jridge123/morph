<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="poll" id="poll">
	<?php if ($this->params->get( 'show_page_title', 1)) : ?>
	<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif; ?>
	<div class="select-poll">
		<label for="id">
			<?php echo JText::_('Select Poll'); ?>
			<?php echo $this->lists['polls']; ?>
		</label>
	</div>
	<div class="poll-graph">
	<?php echo $this->loadTemplate('graph'); ?>
	</div>
</form>

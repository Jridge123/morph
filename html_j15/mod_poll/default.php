<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="form2" class="polls">
<h4><?php echo $poll->title; ?></h4>
<ul>
<?php for ($i = 0, $n = count($options); $i < $n; $i ++) : ?>
<li class="<?php echo $tabclass_arr[$tabcnt]; ?>">
<label for="voteid<?php echo $options[$i]->id;?>">
<input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id;?>" value="<?php echo $options[$i]->id;?>" alt="<?php echo $options[$i]->id;?>" />
<?php echo $options[$i]->text; ?>
</label>
</li>
<?php $tabcnt = 1 - $tabcnt; ?>
<?php endfor; ?>
</ul>
<div align="center">
<input type="submit" name="task_button" class="button poll-vote" value="<?php echo JText::_('Vote'); ?>" />
&nbsp;
<input type="button" name="option" class="button poll-results" value="<?php echo JText::_('Results'); ?>" onclick="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug".$itemid); ?>'" />
</div>
	<input type="hidden" name="option" value="com_poll" />
	<input type="hidden" name="task" value="vote" />
	<input type="hidden" name="id" value="<?php echo $poll->id;?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
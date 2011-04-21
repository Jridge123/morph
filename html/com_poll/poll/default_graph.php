<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<table class="polls" cellspacing="0" cellpadding="0" border="0">
<thead>
	<tr>
		<th colspan="3" class="sectiontableheader">
			<?php echo $this->escape($this->poll->title); ?>
		</th>
	</tr>
</thead>
<tbody>
<?php foreach($this->votes as $vote) : ?>
	<tr class="sectiontableentry<?php echo $vote->odd; ?>">
		<td width="100%" colspan="3">
			<?php echo $vote->text; ?>
		</td>
	</tr>
	<tr class="sectiontableentry<?php echo $vote->odd; ?>">
		<td align="right" width="25">
			<strong><?php echo $this->escape($vote->hits); ?></strong>&nbsp;
		</td>
		<td width="30" >
			<?php echo $this->escape($vote->percent); ?>%
		</td>
		<td width="300" >
			<div class="<?php echo $vote->class; ?>" style="height:<?php echo $vote->barheight; ?>px;width:<?php echo $vote->percent; ?>%"></div>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<ul class="list-reset polls-summary">
	<li><strong><?php echo JText::_( 'Number of Voters' ); ?></strong> <?php if(isset($this->votes[0])) echo $this->votes[0]->voters; ?></li>
	<li><strong><?php echo JText::_( 'First Vote' ); ?></strong> <?php echo $this->escape($this->first_vote); ?></li>
	<li><strong><?php echo JText::_( 'Last Vote' ); ?></strong> <?php echo $this->escape($this->last_vote); ?></li>
</ul>
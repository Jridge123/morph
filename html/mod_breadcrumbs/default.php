<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<ul class="breadcrumbs pathway">
<?php for ($i = 0; $i < $count; $i ++) :
	$linktext = explode(' # ',$list[$i]->name);
	
	if ($i < $count -1) {
		if(!empty($list[$i]->link)) {
			echo '<li><a href="'.$list[$i]->link.'">'.$linktext[0].'</a></li>';
		} else {
			echo '<li>'.$linktext[0].'</li>';
		}
	}  else if ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
	    echo '<li class="pathway-current">'.$linktext[0].'</li>';
	}
endfor; ?>
</ul>

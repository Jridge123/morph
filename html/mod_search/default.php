<?php // no direct access
defined('_JEXEC') or die('Restricted access');
//$view = &JFactory::getDocument();
//changed by manoj for j25
//changed for - Strict Standards: Only variables should be assigned by reference in /morph/html/mod_search/default.php on line 3
$view = JFactory::getDocument();
if($override = Morph::override(__FILE__, $view)) {
   if(file_exists($override)) include $override;
} else { ?>
<form action="index.php" method="post">
	<div class="search<?php if ( $button == 1 ) { ?> button-active<?php } ?>">
		<?php
		    $output = '<input name="searchword" id="mod_search_searchword" maxlength="'.$maxlength.'" alt="'.$button_text.'" class="search-input" type="text" size="'.$width.'" value="'.$text.'"  onblur="if(this.value==\'\') this.value=\''.$text.'\';" onfocus="if(this.value==\''.$text.'\') this.value=\'\';" />';
			if ($button) :
			    if ($imagebutton) :
			        $button = '<input type="image" value="'.$button_text.'" class="search-btn" src="'.$img.'" onclick="this.form.searchword.focus();" />';
			    else :
			        $button = '<input type="submit" value="'.$button_text.'" class="search-btn" onclick="this.form.searchword.focus();" />';
			    endif;
			endif;
			switch ($button_pos) :
			    case 'top' :
				    $button = $button.'<br />';
				    $output = $button.$output;
				    break;
			    case 'bottom' :
				    $button = '<br />'.$button;
				    $output = $output.$button;
				    break;
			    case 'right' :
				    $output = $output.$button;
				    break;
			    case 'left' :
			    default :
				    $output = $button.$output;
				    break;
			endswitch;
			echo $output;
		?>
	</div>
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>
<?php } ?>

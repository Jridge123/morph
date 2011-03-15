<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
function minify($str){
	return str_replace(array("\n", "\t", ' ', "\r"), '', $str);
}
ob_start('minify');
?>
(function($){
	var id      = '#k2ModuleBox<?php echo $module->id; ?>',
		spinner = 'k2CalendarLoader';
	$(document).ready(function(){
	    $('a.calendarNavLink').live('click', function(e){
	        e.preventDefault();
	        $(id).empty().addClass(spinner).load($(this).attr('href'), function(){ $(id).removeClass(spinner); });
	        return false;
	    });
	    
	});
})(jQuery);
<?php $this->_doc->addScriptDeclaration(str_replace(array('  ', '   ', "\n", "\t", "\r"), array(' ', ' ', ''), ob_get_clean())) ?>
<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2CalendarBlock <?php echo $params->get('moduleclass_sfx'); ?>">
	<?php echo $calendar; ?>
	<div class="clr"></div>
</div>
<?php } ?><!-- close the themelet override check -->
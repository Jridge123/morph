<?php
/**
 * @version		$Id: calendar.php 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
ob_start();
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
<?php $this->_doc->addScriptDeclaration(ob_get_clean()) ?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2CalendarBlock <?php echo $params->get('moduleclass_sfx'); ?>">
	<?php echo $calendar; ?>
	<div class="clr"></div>
</div>

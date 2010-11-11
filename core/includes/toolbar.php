<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($global_wrap == 1 && $global_wrap_end == 0){ echo '<div id="global-wrap" class="'.$site_width.'">'; }
$position = 'toolbar'; 
$action->do_action ('toolbar_before');
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules); 
$action->do_action ('toolbar_after');
?>
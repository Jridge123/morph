<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$position = 'bottomshelf1'; 
$action->do_action($position.'_before');
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules); 
if($global_wrap == 1 && $global_wrap_end == 1){ echo '</div>'; }
$action->do_action($position.'_after');
?>
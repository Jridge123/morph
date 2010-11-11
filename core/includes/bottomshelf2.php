<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php 
$position = 'bottomshelf2'; 
$action->do_action($position.'_before');
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules); 
if($global_wrap == 1 && $global_wrap_end == 2){ echo '</div>'; }
$action->do_action($position.'_after');
?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($global_wrap == 1 && $global_wrap_end == 1){ echo '<div id="global-wrap" class="'.$site_width.'">'; }
$position = 'masthead'; 
$action->do_action($position.'_before');
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules); 
$action->do_action($position.'_after');
?>
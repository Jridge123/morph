<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php 
$position = 'bottomshelf1'; 
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules); 
if($global_wrap == 1 && $global_wrap_end == 1){ echo '</div>'; }
?>
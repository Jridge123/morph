<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$position = 'user1'; 
$action->do_action($position.'_before');
include ($blockclassespath); 
echo blocks($position, $this, $jj_const, $classes, '', $debug_modules); 
$action->do_action($position.'_after');
?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$position = 'user1';
include ($blockclassespath);
echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs);
?>
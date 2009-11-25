<?php 
$position = 'user2';
include dirname(__FILE__) .DS.'..'.DS.'morphBlockClasses.php';
echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs);
?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if($global_wrap == 1 && $global_wrap_start == 4){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
<?php 
$position = 'topshelf1'; 
include ($blockclassespath); echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs);
?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if(file_exists($inc_toolbar)) { include_once($inc_toolbar); } else { ?>
<?php if($global_wrap == 1 && $global_wrap_start == 0){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
<?php 
$position = 'toolbar';
include ($blockclassespath);
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules, $nojs); ?>
<?php } ?>
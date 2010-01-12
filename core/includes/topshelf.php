<?php if($global_wrap == 1 && $global_wrap_start == 4){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
<?php 
$position = 'topshelf';
include dirname(__FILE__).DS.'..'.DS.'morphBlockClasses.php';
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules, $nojs);
?>
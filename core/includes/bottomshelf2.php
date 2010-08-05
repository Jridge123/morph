<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$position = 'bottomshelf2';
include dirname(__FILE__).'/../morphBlockClasses.php';
echo blocks($position, $this, $jj_const, $classes, $site_width, $debug_modules, $nojs);
?>
<?php if($global_wrap_end == 1){ ?></div><?php } ?>
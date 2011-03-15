<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
srand((double) microtime() * 1000000);
$flashnum	= rand(0, $items -1);
$item		= $list[$flashnum];
modNewsFlashHelper::renderItem($item, $params, $access);
?>
<?php } ?><!-- close the themelet override check -->
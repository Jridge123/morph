<?php
$themelet = $_GET['01'];
$superfish = $_GET['02'];
$superdrop = $_GET['03'];
$direction = $_GET['04'];
$tabscount = $_GET['05'];
$gzip_compression = $_GET['06'];

header("content-type: text/css; charset: UTF-8");
if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}
include('../../../../css/yui.css');
if ( $direction == 'rtl' ) {
include('../../../../template_rtl.css');
}
include('layout.css');
include('joomla.css');
include('modules.css');
include('typo.css');
if ( $tabscount >= 1 ) {
include('tabs.css');
}
include('chromes.css');
include('menus.css');
if ( $superfish >= 1 or $superdrop >= 1 ) {	
include('superfish.css');
}
if ( $superdrop >= 1 ) {
include('superdrop.css');
}
if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
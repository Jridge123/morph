<?php
header("content-type: text/css; charset: UTF-8");
$themelet = $_GET['01'];
$topfish = $_GET['03'];
$topdrop = $_GET['04'];
$direction = $_GET['05'];
$tabscount = $_GET['06'];
$gzip_compression = $_GET['07'];

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

if ( $topfish >= 1) {	
include('topnav-topfish.css');
}
if ( $topdrop >= 1) {	
include('topnav-topdrop.css');
}
if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
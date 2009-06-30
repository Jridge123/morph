<?php
header("content-type: text/css; charset: UTF-8");
$themelet = $_GET['A01'];
$direction = $_GET['A02'];

$topfish = $_GET['B01'];
$topdrop = $_GET['B02'];
$topnav_count = $_GET['B03'];
$sidenav_count = $_GET['B04'];

$tabscount = $_GET['C01'];

$gzip_compression = $_GET['Z01'];

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

if ( $topnav_count >= 1) {	
include('topnav-default.css');
}
if ( $topfish >= 1) {	
include('topnav-topfish.css');
}
if ( $topdrop >= 1) {	
include('topnav-topdrop.css');
}
if ( $sidenav_count >= 1) {	
include('sidenav-default.css');
}
if ( $sidefish >= 1) {	
include('sidenav-sidefish.css');
}

if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
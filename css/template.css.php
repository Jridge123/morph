<?php
header("content-type: text/css; charset: UTF-8");
$themelet = $_GET['A01'];
$direction = $_GET['A02'];
$assetspath = $_GET['A03'];
$topfish = $_GET['B01'];
$topdrop = $_GET['B02'];
$topnav_count = $_GET['B03'];
$sidenav_count = $_GET['B04'];
$sidefish = $_GET['B05'];
$tabscount = $_GET['C01'];
$gzip_compression = $_GET['Z01'];
if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}
include($assetspath.'/themelets/'.$themelet.'/css/themelet.css');
include('yui.css');
include('joomla.css');
include('modules.css');
include('typo.css');

if ( $tabscount >= 1 ) {
include('tabs.css');
}
if ( $topfish >= 1) {	
include('topnav-topfish.css');
}
if ( $topdrop >= 1) {	
include('topnav-topdrop.css');
}
if ( $topnav_count >= 1) {	
include('topnav-default.css');
}
if ( $sidefish >= 1) {	
include('sidenav-sidefish.css');
}
if ( $sidenav_count >= 1) {	
include('sidenav-default.css');
}
if ( $direction == 'rtl' ) {
include('rtl.css');
}
if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
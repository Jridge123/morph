<?php
$jquery_core = $_GET['A01'];

$topfish = $_GET['B01'];
$sidefish = $_GET['B02'];
$topdrop = $_GET['B03'];
$topnav_supersubs = $_GET['B04'];
$topnav_hoverintent = $_GET['B05'];

$toolbar_slider = $_GET['C01'];
$topshelf_slider = $_GET['C02'];
$bottomshelf_slider = $_GET['C03'];

$topshelf_equalize = $_GET['D01'];
$bottomshelf_equalize = $_GET['D02'];
$user1_equalize = $_GET['D03'];
$user2_equalize = $_GET['D04'];

$tabscount = $_GET['E01'];

$image_captions = $_GET['F01'];
$rounded_corners = $_GET['F02'];

$gzip_compression = $_GET['Z01'];

header("content-type: text/javascript; charset: UTF-8");
if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}

if ( $jquery_core == 1 ) {
include('jquery-1.3.2.min.js');
}
if ( $tabscount >= 1 ) {
include('jquery.ui.core.js');
include('jquery.ui.tabs.js');
}
if ( $tabscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1  ) {
include('jquery.cookie.js');
}
if ( $rounded_corners == 1 ) { 
include('jquery.corners.js');
}
if ( $topnav_hoverintent == 1 ) { 
include("jquery.superfish.hoverintent.js");
}
//if ( $superfish >= 1 or $superdrop >= 1  ) { 
if ( $sidefish >= 1 or $topfish >= 1 or $topdrop >= 1  ) { 	
include('jquery.superfish.js');
}
if ( $topnav_supersubs == 1 ) { 
include("jquery.superfish.supersubs.js");
}
if ( $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 ) {
include('jquery.slider.js');
}
if ( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  ) {
include('jquery.equalheights.js');
}
if ( $image_captions == 1 ) {
include('jquery.captify.js');
}
if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
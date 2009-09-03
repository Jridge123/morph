<?php
include '../cssvars.php';
if ( $gzip_compression == 1 ) {
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}else{
		ob_start();
	}
	header("cache-control: must-revalidate");	$offset = 60 * 10000;	$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";	header($expire);
}
header("content-type: text/css; charset: UTF-8");
define('JPATH', str_replace('templates/morph/core/css', '', dirname(__FILE__)) . '/' );

if( $pack_css == 1 ){

	if(file_exists($css_yui)){echo 'themelet yui'."\n";	} else { echo 'template yui'."\n"; }
	if( $tabscount >= 1 && $count_left >= 1 ) {	echo 'tabs'."\n"; }
	if( $accordionscount >= 1 && $count_left >= 1 ) { echo 'accordion'."\n"; }
	if( $topnav_count >= 1 ) { echo 'topnav default'."\n"; }
	if( $topfish >= 1 ) { echo 'topfish'."\n"; }
	if( $topdrop >= 1 ) { echo 'topdrop'."\n"; }
	if( $sidenav_count >= 1 ) { echo 'sidenav default'."\n"; }
	if( $sidefish >= 1 ) { echo 'sidefish'."\n"; }
	if( $simpleticker == 1 ) { echo 'simpleticker'."\n"; }
	if( $direction == 'rtl' && file_exists($css_rtl)){ echo 'rtl themelet'."\n";	} elseif ($direction == 'rtl') { echo 'rtl template'."\n"; }
	if( $custom_css == 1 ) { echo 'custom'."\n"; }
	if( $lcbrowser == 'firefox' && file_exists($css_firefox)) {	echo 'firefox'."\n"; }
	if( $lcbrowser == 'safari' && file_exists($css_safari)) { echo 'safari'."\n"; }
	if( $lcbrowser == 'opera' && file_exists($css_opera)) { echo 'opera'."\n"; }
	if( $lcbrowser == 'chrome' && file_exists($css_chrome)) { echo 'chrome'."\n";}
	if( $lcbrowser == 'internetexplorer' && file_exists($css_ie)) {	echo 'ie'."\n";	}
	if(file_exists($css_browsers)){	echo 'browsers'."\n"; }
	
?><?php } if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
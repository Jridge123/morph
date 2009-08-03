<?php
include '../cssvars.php';
if ( $gzip_compression == 1 ) {
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}else{
		ob_start();
	}
header("cache-control: must-revalidate");$offset = 60 * 10000;$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";header($expire);
}
header("content-type: text/css; charset: UTF-8");
define('JPATH', str_replace('templates/morph/core/css', '', dirname(__FILE__)) . '/' );

if( $pack_css == 1 ){
	if(file_exists($css_yui) && is_readable($css_yui)){
		include($_SERVER['DOCUMENT_ROOT'] . '/' . $themeletpath.'/css/yui.css');
	} else {
		include('yui.css');
	}

//	if(file_exists($css_rtl) && is_readable($css_rtl) ){
//		include($_SERVER['DOCUMENT_ROOT'] . '/' . $themeletpath . '/css/rtl.css');
//	} else {
//		include('rtl.css');
//	}
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/themelet.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/modfx.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/joomla.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/modules.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/typo.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/tabs.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/accordions.css');
	if( $topnav_count >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-default.css');}
	if( $topfish >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-topfish.css');}
	if( $topdrop >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-topdrop.css');}
	if( $sidenav_count >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/sidenav-default.css');}
	if( $sidefish >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/sidenav-sidefish.css');}
}
?>
<?php if ( $bg_image !== "Use themelets background") { ?>
html body{<?php if ( $bg_color && $bg_color !== "#default" ) { ?>background-color:<?php echo $bg_color; ?>;<?php }; if ( $bg_image !== "default") { ?>background-image:url(../../../../morph_assets/backgrounds/<?php echo $bg_image; ?>);<?php } ?>background-repeat:<?php echo $bg_repeat; ?>;background-position:<?php echo $bg_position; ?>;background-attachment:<?php echo $bg_attachment; ?>;}
<?php } ?>
<?php if ( $logo_type == 0 ) { ?>
#branding h1,#branding h1 a{margin:0;padding:0;}
#branding h1 a{
	font-family:<?php echo $logo_fontfamily; ?>;
	font-size:<?php echo $logo_fontsize; ?>;
	<?php if ( $logo_textcolor !== "#default" ) { ?>color:<?php echo $logo_textcolor; ?>;<?php } ?>
	padding:.6em 0 0 0;
	display:block;
	font-weight:bold;
}
<?php } ?>

<?php if ( $logo_type == 1 ) { ?>
#branding h1,#branding h1 a{margin:0;padding:0;width:<?php echo $logo_width; ?>px;height:<?php echo $logo_height; ?>px;}
#branding h1 a{background:transparent url(<?php echo $logo; ?>) no-repeat 0;display:block;text-indent:-7998em;}
<?php } if ( $logo_type == 2 ) { ?>
#branding.logotype-2 a{
<?php if ( $logo_fontfamily !== "" ) { ?>
	font-family:<?php echo $logo_fontfamily; ?>;
<?php } if ( $logo_fontsize !== "" ) { ?>
	font-size:<?php echo $logo_fontsize; ?>;
<?php } if ( $logo_textcolor && $logo_textcolor !== "default" ) { ?>
	color:<?php echo $logo_textcolor; ?>;<?php } ?>
}
<?php } ?>

<?php if ( $display_slogan == 1 ) { ?>
#branding .slogan{<?php if ( $slogan_fontfamily !== "" ) { ?>font-family:<?php echo $slogan_fontfamily; ?>;<?php } if ( $slogan_fontsize !== "" ) { ?>font-size:<?php echo $slogan_fontsize; ?>;<?php } if ( $slogan_textcolor && $slogan_textcolor !== "#default" ) { ?>color:<?php echo $slogan_textcolor; ?>;<?php } ?>}
<?php } if ( $toolbar_slider == 1 ) { ?>
#toolbar-wrap{position:absolute;top:0;width:100%;}
#toolbar{position:relative;top:0;height:100%;}
<?php } if ( $color_links && $color_links !== "#default" ) { ?>
body a:link,body a:visited,body a:active{color:<?php echo $color_links; ?>;}
<?php } if ( $color_linkshover && $color_linkshover !== "#default" ) { ?>
body a:hover{color:<?php echo $color_linkshover; ?>;}
<?php } if ( $color_linksvisited && $color_linksvisited !== "#default" ) { ?>
body a:visited{color:<?php echo $color_linksvisited; ?>;}
<?php } if ( $color_h1 && $color_h1 !== "#default" ) { ?>#primary-content h1{color:<?php echo $color_h1; ?>}
<?php } if ( $color_h2 && $color_h2 !== "#default" ) { ?>#primary-content h2{color:<?php echo $color_h2; ?>}
<?php } if ( $color_h3 && $color_h3 !== "#default" ) { ?>#primary-content h3{color:<?php echo $color_h3; ?>}
<?php } if ( $color_h4 && $color_h4 !== "#default" ) { ?>#primary-content h4{color:<?php echo $color_h4; ?>}
<?php } if ( $color_h5 && $color_h5 !== "#default" ) { ?>#primary-content h5{color:<?php echo $color_h5; ?>}
<?php } if ( $color_bodytext && $color_bodytext !== "#default" ) { ?>
body{color: <?php echo $color_bodytext; ?>;}
<?php } if ( $footer_textcolor && $footer_textcolor !== "#default" ) { ?>#footer{color:<?php echo $footer_textcolor; ?>}
<?php } if ( $footer_linkscolor && $footer_linkscolor !== "#default" ) { ?>#footer a,#footer a:link,#footer a:visited{color:<?php echo $footer_linkscolor; ?>}
<?php } if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
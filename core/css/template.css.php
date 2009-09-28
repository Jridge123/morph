<?php
include '../cssvars.php';
header("content-type: text/css; charset: UTF-8");
if ( $gzip_compression == 1 ) {
if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
if(!ob_start("ob_gzhandler")) ob_start();
}else{
ob_start();
}
header("cache-control: must-revalidate");
$offset = 60 * 10000;
$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}
define('JPATH', str_replace('templates/morph/core/css', '', dirname(__FILE__)) . '/' );
if( $pack_css == 1 ){
    if(file_exists($css_yui)){ include($css_yui); } else { include('yui.css'); }
    if( $topnav_count >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-default.css'); }
    if( $topfish >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-topfish.css'); }
    if( $topdrop >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/topnav-topdrop.css'); }
    if( $sidenav_count >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/sidenav-default.css'); }
    if( $sidefish >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/sidenav-sidefish.css'); }
	if( $tabscount >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/tabs.css'); }
    if( $accordionscount >= 1 ) { include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/accordions.css'); }
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/typo.css');
	include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/joomla.css');
    include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/modules.css');
    include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/modfx.css');
    include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/themelet.css');
   	if( $simpleticker == 1 ) { include(JPATH . 'modules/mod_simpleticker/simpleticker/simpleticker.css'); }
} ?>

body{<?php if ( $bg_color && $bg_color !== "default" ) { ?>background-color:#<?php echo $bg_color; ?>;<?php }; if ( $bg_image !== "default") { ?>background-image:url(../../../../morph_assets/backgrounds/<?php echo $bg_image; ?>);<?php } ?>background-repeat:<?php echo $bg_repeat; ?>;background-position:<?php echo $bg_position; ?>;background-attachment:<?php echo $bg_attachment; ?>;}
<?php if ( $masthead_height ) { ?>
body #masthead{
height:<?php echo $masthead_height; ?>;
}
<?php } if ( $logo_type == 0 ) { ?>
#branding h1{
position:absolute;
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
margin:0;
padding:0;
width:<?php echo $logo_width; ?>px;
height:<?php echo $logo_height; ?>px;
font-weight:bold;
}
#branding h1 a{
font-family:<?php echo $logo_fontfamily; ?>;
font-size:<?php echo $logo_fontsize; ?>;
<?php if ( $logo_textcolor !== "#default" ) { ?>color:<?php echo $logo_textcolor; ?>;<?php } ?>
display:block;
}
<?php } if ( $logo_type == 1 ) { ?>
#branding h1{
position:absolute;
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
margin:0;
padding:0;
}
#branding h1 a{
width:<?php echo $logo_width; ?>px;
height:<?php echo $logo_height; ?>px;
display:block;
background:transparent url(<?php echo $logo; ?>) no-repeat 0;
display:block;
text-indent:-7998em;
}
<?php } if ( $logo_type == 2 ) { ?>
#branding.logotype-2 a.logo-img{
position:absolute;
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
}
<?php } if ( $logo_type == 3 ) { ?>
#branding #logo{
position:absolute;
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
}
<?php } if ( $display_slogan == 1 ) { ?>
#branding .slogan{
<?php if ( $slogan_fontfamily !== "" ) { ?>font-family:<?php echo $slogan_fontfamily; ?>;
<?php } if ( $slogan_fontsize !== "" ) { ?>font-size:<?php echo $slogan_fontsize; ?>;
<?php } if ( $slogan_textcolor && $slogan_textcolor !== "#default" ) { ?>color:<?php echo $slogan_textcolor; ?>;<?php } ?>
position:absolute;
top:<?php echo $slogan_top; ?>;
left:<?php echo $slogan_left; ?>;
z-index:<?php echo $slogan_stack; ?>;
margin:0;
}
<?php } if ( $color_links && $color_links !== "#default" ) { ?>
body a:link,body a:visited,body a:active{color:#<?php echo $color_links; ?>;}
<?php } if ( $color_linkshover && $color_linkshover !== "#default" ) { ?>
body a:hover{color:#<?php echo $color_linkshover; ?>;}
<?php } if ( $color_linksvisited && $color_linksvisited !== "#default" ) { ?>
body a:visited{color:#<?php echo $color_linksvisited; ?>;}
<?php } if ( $color_h1 && $color_h1 !== "#default" ) { ?>h1{color:#<?php echo $color_h1; ?>}
<?php } if ( $color_h2 && $color_h2 !== "#default" ) { ?>h2{color:#<?php echo $color_h2; ?>}
<?php } if ( $color_h3 && $color_h3 !== "#default" ) { ?>h3{color:#<?php echo $color_h3; ?>}
<?php } if ( $color_h4 && $color_h4 !== "#default" ) { ?>h4{color:#<?php echo $color_h4; ?>}
<?php } if ( $color_h5 && $color_h5 !== "#default" ) { ?>h5{color:#<?php echo $color_h5; ?>}
<?php } if ( $color_bodytext && $color_bodytext !== "#default" ) { ?>
body{color:#<?php echo $color_bodytext; ?>;}
<?php } if ( $footer_textcolor && $footer_textcolor !== "#default" ) { ?>#footer{color:<?php echo $footer_textcolor; ?>}
<?php } if ( $footer_linkscolor && $footer_linkscolor !== "#default" ) { ?>#footer a,#footer a:link,#footer a:visited{color:<?php echo $footer_linkscolor; ?>}
<?php } if ( $captions_enabled ) { ?>
.caption-top,.caption-bottom{background:<?php echo $captions_bgcolor; ?>;color:<?php echo $captions_textcolor; ?>;}
.caption-top{border-bottom:<?php echo $captions_borderheight; ?> solid <?php echo $captions_bordercolor; ?>;}
.caption-bottom{border-top:<?php echo $captions_borderheight; ?> solid <?php echo $captions_bordercolor; ?>;}
<?php } if( $pack_css == 1 ){
    if( $direction == 'rtl' && file_exists($css_rtl)){ include($css_rtl); } elseif ($direction == 'rtl') { include('rtl.css'); }
	if($custom_css == 1){ include(JPATH . 'morph_assets/themelets/'.$themelet.'/css/custom.css'); }
    include('browsers.css');
	// browser specific
	if(file_exists($css_browsers)) include($css_browsers);
    if($lcbrowser == 'firefox' && file_exists($css_firefox)) include($css_firefox);
    if($lcbrowser == 'safari' && file_exists($css_safari)) include($css_safari);
    if($lcbrowser == 'opera' && file_exists($css_opera)) include($css_opera);
    if($lcbrowser == 'chrome' && file_exists($css_chrome)) include($css_chrome);
    if($lcbrowser == 'internetexplorer' && file_exists($css_internetexplorer)) include($css_internetexplorer);
	if(preg_match('/MSIE 8/i', $_SERVER['HTTP_USER_AGENT']) && file_exists($css_ie8)) include($css_ie8);
	if(preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT']) && file_exists($css_ie7)) include($css_ie7);
	if(preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT']) && file_exists($css_ie6)) include($css_ie6);
}
if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
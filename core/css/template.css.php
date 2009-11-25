<?php
define ('DS', DIRECTORY_SEPARATOR);
include '..'.DS.'cssvars.php';
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
define('JPATH', str_replace('templates'.DS.'morph'.DS.'core'.DS.'css', '', dirname(__FILE__)) );
if( $pack_css == 1 ){
if(file_exists($css_yui)){ include($css_yui); } else { include('yui.css'); }
if( $topnav_count >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'topnav-default.css'); }
if( $topfish >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'topnav-topfish.css'); }
if( $topdrop >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'topnav-topdrop.css'); }
if( $sidenav_count >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'sidenav-default.css'); }
if( $sidefish >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'sidenav-sidefish.css'); }
if( $tabscount >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'tabs.css'); }
if( $accordionscount >= 1 ) { include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'accordions.css'); }
include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'typo.css');
include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'joomla.css');
include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'modules.css');
include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'modfx.css');
include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'themelet.css');
if( $simpleticker == 1 ) {include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'simpleticker.css'); }
if( $simpletweet == 1 ) {include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'simpletweet.css'); }
if( $simplecontact == 1 ) {include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'simplecontact.css'); }
if( $simplesocial == 1 ) {include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'simplesocial.css'); }
}?>
html{
background-color:#<?php echo $html_bg_color; ?>;
<?php if ( $use_html_bg_image == 1 ) { ?>
background-image:url(../../../../morph_assets/backgrounds/<?php echo $html_bg_image; ?>);
background-repeat:<?php echo $html_bg_repeat; ?>;
background-position:<?php echo $html_bg_position; ?>;
background-attachment:<?php echo $html_bg_attachment; ?>;
<?php } ?>
}
body{
background-color:#<?php echo $body_bg_color; ?>;
<?php if ( $use_body_bg_image == 1 ) { ?>
background-image:url(../../../../morph_assets/backgrounds/<?php echo $body_bg_image; ?>);
background-repeat:<?php echo $body_bg_repeat; ?>;
background-position:<?php echo $body_bg_position; ?>;
background-attachment:<?php echo $body_bg_attachment; ?>;
<?php } ?>
}
<?php if ( $masthead_height ) { ?>
#masthead{
height:<?php echo $masthead_height; ?>;
}
<?php } if ( $logo_type == 0 ) { ?>
#branding h1{
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
<?php if ($logo_width !== 'null') { ?>
width:<?php echo $logo_width; ?>px;
<?php } if ($logo_height !== 'null') { ?>
height:<?php echo $logo_height; ?>px;
<?php } ?>
font-size:<?php echo $logo_fontsize; ?>;
}
#branding h1 a{
font-family:<?php echo $logo_fontfamily; ?>;
color:<?php echo $logo_textcolor; ?>;
}
<?php } if ( $logo_type == 1 ) { ?>
#branding h1{
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
}
#branding h1 a{
<?php if($logo_width !== 'null') { ?>
width:<?php echo $logo_width; ?>px;
<?php } if($logo_height !== 'null') { ?>
height:<?php echo $logo_height; ?>px;
<?php } ?>
background-image: url(<?php echo $logo; ?>);
}
<?php } if ( $logo_type == 2 ) { ?>
#branding.logotype-2 a.logo-img{
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
}
<?php } if ( $logo_type == 3 ) { ?>
#branding #logo{
top:<?php echo $logo_top; ?>;
left:<?php echo $logo_left; ?>;
z-index:<?php echo $logo_stack; ?>;
}
<?php } if ( $display_slogan == 1 ) { ?>
#branding .slogan{
font-family:<?php echo $slogan_fontfamily; ?>;
font-size:<?php echo $slogan_fontsize; ?>;
color:<?php echo $slogan_textcolor; ?>;
top:<?php echo $slogan_top; ?>;
left:<?php echo $slogan_left; ?>;
z-index:<?php echo $slogan_stack; ?>;
}
<?php } ?>

a:link,a:visited,a:active{color:#<?php echo $color_links; ?>;}
a:hover{color:#<?php echo $color_linkshover; ?>;}
a:visited{color:#<?php echo $color_linksvisited; ?>;}
h1,.componentheading{color:#<?php echo $color_h1; ?>;}
h2,.contentheading{color:#<?php echo $color_h2; ?>;}
h3{color:#<?php echo $color_h3; ?>;}
h4{color:#<?php echo $color_h4; ?>;}
h5{color:#<?php echo $color_h5; ?>;}
body{color:#<?php echo $color_bodytext; ?>;}
<?php if($footer_textcolor !== 'default') { ?>
#footer{color:<?php echo $footer_textcolor; ?>}
<?php } if($footer_linkscolor !== 'default') { ?>
#footer a,#footer a:link,#footer a:visited{color:<?php echo $footer_linkscolor; ?>}
<?php } ?>

<?php if ( $captions_enabled ) { ?>
.caption-top,.caption-bottom{background:<?php echo $captions_bgcolor; ?>;color:<?php echo $captions_textcolor; ?>;}
.caption-top{border-bottom:<?php echo $captions_borderheight; ?> solid <?php echo $captions_bordercolor; ?>;}
.caption-bottom{border-top:<?php echo $captions_borderheight; ?> solid <?php echo $captions_bordercolor; ?>;}
<?php } if( $pack_css == 1 ){
if($developer_toolbar == 1) { include('devbar.css'); }
if( $direction == 'rtl' && file_exists($css_rtl)){ include($css_rtl); } elseif ($direction == 'rtl') { include('rtl.css'); }
if($custom_css == 1){ include(JPATH . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'css'.DS.'custom.css.php'); }
include('browsers.css');
if(preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) include('ie6.css');
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
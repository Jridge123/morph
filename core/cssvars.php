<?php
$themelet = $_GET['A01'];
$direction = $_GET['A02'];
$tabscount = $_GET['A03'];
$lcbrowser = $_GET['A04'];
$accordionscount = $_GET['A05'];
$logo_type = $_GET['B01'];
$logo = stripslashes(urldecode($_GET['B02']));
$logo_width = $_GET['B03'];
$logo_height = $_GET['B04'];
$logo_textcolor = stripslashes(urldecode($_GET['B05']));
$logo_fontfamily = stripslashes(urldecode($_GET['B06']));
$logo_fontsize = $_GET['B07'];
$logo_top = $_GET['B08'];
$logo_left = $_GET['B09'];
$logo_stack = $_GET['B10'];
$display_ie_logo = $_GET['B11'];
$logo_image_ie = $_GET['B12'];
$masthead_height = $_GET['B13'];
$slogan_textcolor = stripslashes(urldecode($_GET['C01']));
$slogan_fontfamily = stripslashes(urldecode($_GET['C02']));
$slogan_fontsize = $_GET['C03'];
$display_slogan = $_GET['C04'];
$slogan_top = $_GET['C05'];
$slogan_left = $_GET['C06'];
$slogan_stack = $_GET['C07'];
$html_bg_color = stripslashes(urldecode($_GET['D01']));
$use_html_bg_image = $_GET['D02'];
$html_bg_image = $_GET['D03'];
$html_bg_repeat = $_GET['D04'];
$html_bg_position = urldecode($_GET['D05']);
$html_bg_attachment = $_GET['D06'];
$body_bg_color = stripslashes(urldecode($_GET['D07']));
$use_body_bg_image = $_GET['D08'];
$body_bg_image = $_GET['D09'];
$body_bg_repeat = $_GET['D10'];
$body_bg_position = urldecode($_GET['D11']);
$body_bg_attachment = $_GET['D12'];
$color_h1 = stripslashes(urldecode($_GET['E01']));
$color_h2 = stripslashes(urldecode($_GET['E02']));
$color_h3 = stripslashes(urldecode($_GET['E03']));
$color_h4 = stripslashes(urldecode($_GET['E04']));
$color_h5 = stripslashes(urldecode($_GET['E05']));
$color_links = stripslashes(urldecode($_GET['E06']));
$color_linkshover = stripslashes(urldecode($_GET['E07']));
$color_linksvisited = stripslashes(urldecode($_GET['E08']));
$color_bodytext = stripslashes(urldecode($_GET['E09']));
$footer_textcolor = stripslashes(urldecode($_GET['F01']));
$footer_linkscolor 	= stripslashes(urldecode($_GET['F02']));
$topfish = $_GET['G01'];
$topdrop = $_GET['G02'];
$topnav_count = $_GET['G03'];
$sidenav_count = $_GET['G04'];
$sidefish = $_GET['G05'];
$toolbar_slider = $_GET['H01'];
$count_left = $_GET['I01'];
$captions_enabled = $_GET['J01'];
$captions_bgcolor = $_GET['J02'];
$captions_bordercolor = $_GET['J03'];
$captions_borderheight = $_GET['J04'];
$captions_textcolor = $_GET['J05'];
$lightbox_enabled = $_GET['J06'];
$simpleticker = $_GET['K01'];
$simpletweet = $_GET['K02'];
$simplecontact = $_GET['K03'];
$simplesocial = $_GET['K04'];
$lightbox_enabled = $_GET['L01'];
$gzip_compression = $_GET['Z01'];
$pack_css = $_GET['Z02'];
$custom_css = $_GET['Z03'];
$developer_toolbar = $_GET['Z04'];
$themeletpath = dirname(__FILE__).DS.'..'.DS.'..'.DS.'..'.DS.'morph_assets'.DS.'themelets'.DS.$themelet;
$css_yui = $themeletpath.DS.'css'.DS.'yui.css';
$css_joomla = $themeletpath.DS.'css'.DS.'joomla.css';
$css_modules = $themeletpath.DS.'css'.DS.'modules.css';
$css_typo = $themeletpath.DS.'css'.DS.'typo.css';
$css_tabs = $themeletpath.DS.'css'.DS.'tabs.css';
$css_tnav_default = $themeletpath.DS.'css'.DS.'topnav-default.css';
$css_tnav_topfish = $themeletpath.DS.'css'.DS.'topnav-topfish.css';
$css_tnav_topdrop = $themeletpath.DS.'css'.DS.'topnav-topdrop.css';
$css_snav_default = $themeletpath.DS.'css'.DS.'sidenav-default.css';
$css_snav_sidefish = $themeletpath.DS.'css'.DS.'sidenav-sidefish.css';
$css_rtl = $themeletpath.DS.'css'.DS.'rtl.css';
$css_browsers = $themeletpath.DS.'css'.DS.'browsers.css';
$css_safari = $themeletpath.DS.'css'.DS.'safari.css';
$css_opera = $themeletpath.DS.'css'.DS.'opera.css';
$css_firefox = $themeletpath.DS.'css'.DS.'firefox.css';
$css_chrome = $themeletpath.DS.'css'.DS.'chrome.css';
$css_webkit = $themeletpath.DS.'css'.DS.'webkit.css';
$css_internetexplorer = $themeletpath.DS.'css'.DS.'ie.css';
$css_ie8 = $themeletpath.DS.'css'.DS.'ie8.css';
$css_ie7 = $themeletpath.DS.'css'.DS.'ie7.css';
$css_ie6 = $themeletpath.DS.'css'.DS.'ie6.css';
?>
<?php
$themelet = $_GET['A01'];
$direction = $_GET['A02'];
$tabscount = $_GET['A03'];
$lcbrowser = $_GET['A04'];
$accordionscount = $_GET['A05'];
$logo_type = $_GET['B01'];
$logo = $_GET['B02'];
$logo_width = $_GET['B03'];
$logo_height = $_GET['B04'];
$logo_textcolor = stripslashes(urldecode($_GET['B05']));
$logo_fontfamily = stripslashes(urldecode($_GET['B06']));
$logo_fontsize = $_GET['B07'];
$logo_top = $_GET['B08'];
$logo_left = $_GET['B09'];
$masthead_height = $_GET['B10'];
$logo_stack = $_GET['B11'];
$slogan_textcolor = stripslashes(urldecode($_GET['C01']));
$slogan_fontfamily = stripslashes(urldecode($_GET['C02']));
$slogan_fontsize = $_GET['C03'];
$display_slogan = $_GET['C04'];
$slogan_top = $_GET['C05'];
$slogan_left = $_GET['C06'];
$slogan_stack = $_GET['C07'];
$bg_color = stripslashes(urldecode($_GET['D01']));
$bg_image = $_GET['D02'];
$bg_repeat = $_GET['D03'];
$bg_position = urldecode($_GET['D04']);
$bg_attachment = $_GET['D05'];
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
$gzip_compression = $_GET['Z01'];
$pack_css = $_GET['Z02'];
$custom_css = $_GET['Z03'];
$simpleticker = $_GET['Z04'];
define ('DS', '/');
$themeletpath 				= dirname(__FILE__) . '/../../../morph_assets'.DS.'themelets'.DS.$themelet;
$css_yui					= $themeletpath . "/css/yui.css";
$css_joomla 				= $themeletpath . "/css/joomla.css";
$css_modules 				= $themeletpath . "/css/modules.css";
$css_typo 					= $themeletpath . "/css/typo.css";
$css_tabs 					= $themeletpath . "/css/tabs.css";
$css_tnav_default 			= $themeletpath . "/css/topnav-default.css";
$css_tnav_topfish 			= $themeletpath . "/css/topnav-topfish.css";
$css_tnav_topdrop 			= $themeletpath . "/css/topnav-topdrop.css";
$css_snav_default 			= $themeletpath . "/css/sidenav-default.css";
$css_snav_sidefish 			= $themeletpath . "/css/sidenav-sidefish.css";
$css_rtl					= $themeletpath . "/css/rtl.css";
$css_browsers				= $themeletpath . "/css/browsers.css";
$css_safari					= $themeletpath . "/css/safari.css";
$css_opera					= $themeletpath . "/css/opera.css";
$css_firefox				= $themeletpath . "/css/firefox.css";
$css_chrome					= $themeletpath . "/css/chrome.css";
$css_internetexplorer		= $themeletpath . "/css/ie.css";
?>
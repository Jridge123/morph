<?php
$themelet = $_GET['A01'];
$direction = $_GET['A02'];
$tabscount = $_GET['C03'];
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
$gzip_compression = $_GET['Z01'];
$pack_css = $_GET['Z02'];
$custom_css = $_GET['Z03'];
$simpleticker = $_GET['Z04'];
define ('DS', '/');
$themeletpath 				= 'morph_assets'.DS.'themelets'.DS.$themelet;
$css_yui					= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/yui.css";
$css_joomla 				= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/joomla.css";
$css_modules 				= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/modules.css";
$css_typo 					= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/typo.css";
$css_tabs 					= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/tabs.css";
$css_tnav_default 			= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/topnav-default.css";
$css_tnav_topfish 			= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/topnav-topfish.css";
$css_tnav_topdrop 			= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/topnav-topdrop.css";
$css_snav_default 			= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/sidenav-default.css";
$css_snav_sidefish 			= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/sidenav-sidefish.css";
$css_rtl					= $_SERVER['DOCUMENT_ROOT'] . $themeletpath . "/css/rtl.css";
?>
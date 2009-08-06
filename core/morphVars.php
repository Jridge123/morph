<?php
if ( $logo_type == 1 or $logo_type == 3 ) {
	if( isIE6() && $logo_image_ie !== ''){ 
		$logo = $assetspath.'/logos/'.$ie_logo_image; 
		if($logo_autodimensions == 1) {
			$logo_size = getimagesize($assetsroot.'/logos/'.$ie_logo_image);
		}else{
			$logo_size[0] = $logo_width;
			$logo_size[1] = $logo_height;
		}	
	} else { 
		$logo = $assetspath.'/logos/'.$logo_image; 
		if($logo_autodimensions == 1) {
			$logo_size = getimagesize($assetsroot.'/logos/'.$logo_image);
		}else{
			$logo_size[0] = $logo_width;
			$logo_size[1] = $logo_height;
		}
	}
} else {
	$logo_size[0] = 'null';
	$logo_size[1] = 'null';
	$logo = 'null';
}

$db=& JFactory::getDBO();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'tabs' ";
$db->setQuery( $query ); $tabscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'accordion' ";
$db->setQuery( $query ); $accordionscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=rounded%' ";
$db->setQuery( $query ); $roundedcount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=topdrop%' OR `position` = 'user3' AND `params` LIKE '% topdrop%'";
$db->setQuery( $query ); $topdrop = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=topfish%' OR `position` = 'user3' AND `params` LIKE '% topfish%'";
$db->setQuery( $query ); $topfish = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=subtext%' OR `position` = 'user3' AND `params` LIKE '% subtext%'";
$db->setQuery( $query ); $subtext_top = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=animate%' OR `position` = 'user3' AND `params` LIKE '% animate%'";
$db->setQuery( $query ); $animate_top = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=sidefish%' OR `params` LIKE '%sidefish%'";
$db->setQuery( $query ); $sidefish = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'left' AND `module` = 'mod_mainmenu' OR `position` = 'right' AND `module` = 'mod_mainmenu'";
$db->setQuery( $query ); $sidenav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `module` = 'mod_mainmenu'";
$db->setQuery( $query ); $topnav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'left' AND `params` LIKE '%moduleclass_sfx=animate%' OR `position` = 'left' AND  `params` LIKE '% animate%'";
$db->setQuery( $query ); $animate_left = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simpleticker' AND `published` = '1'";
$db->setQuery( $query ); $simpleticker = $db->loadResult();

(file_exists($customjs) && is_readable($customjs)) ? $custom_js = 1 : $custom_js = 0;
(file_exists($customcss) && is_readable($customcss)) ? $custom_css = 1 : $custom_css = 0;

// JS Variables
$packed_js_vars = array();
$packed_js_vars["A01"]=$jquery_core;
$packed_js_vars["B01"]=$topfish;
$packed_js_vars["B02"]=$sidefish;
$packed_js_vars["B03"]=$topdrop;
$packed_js_vars["B04"]=$topnav_supersubs;
$packed_js_vars["B05"]=$topnav_hoverintent;
$packed_js_vars["B06"]=$topnav_hoverfocus;
$packed_js_vars["B07"]=$topnav_minwidth;
$packed_js_vars["B08"]=$topnav_maxwidth;
$packed_js_vars["B09"]=$topnav_delay;
$packed_js_vars["B10"]=$topnav_animation;
$packed_js_vars["B11"]=$animate_left;
$packed_js_vars["C01"]=$toolbar_slider;
$packed_js_vars["C02"]=$topshelf_slider;
$packed_js_vars["C03"]=$bottomshelf_slider;
$packed_js_vars["C04"]=$toolbar_slider_text;
$packed_js_vars["C05"]=$topshelf_slider_text;
$packed_js_vars["C06"]=$bottomshelf_slider_text;
$packed_js_vars["D01"]=$topshelf_equalize;
$packed_js_vars["D02"]=$bottomshelf_equalize;
$packed_js_vars["D03"]=$user1_equalize;
$packed_js_vars["D04"]=$user2_equalize;
$packed_js_vars["E01"]=$tabscount;
$packed_js_vars["E02"]=$topshelfcount;
$packed_js_vars["E03"]=$btmshelfcount;
$packed_js_vars["E04"]=$user1count;
$packed_js_vars["E05"]=$user2count;
$packed_js_vars["E06"]=$roundedcount;
$packed_js_vars["E07"]=$rounded_corners;
$packed_js_vars["E08"]=$rounded_amount;
$packed_js_vars["E09"]=$accordionscount;
$packed_js_vars["F01"]=$plugin_scrollto;
$packed_js_vars["F02"]=$rounded_corners;
$packed_js_vars["Z01"]=$gzip_compression;
$packed_js_vars["Z02"]=$pack_js;
$packed_js_vars["Z03"]=$custom_js;

$packed_js = '';
foreach($packed_js_vars as $key => $val){
	($key == 'A01') ? $sep = '?' : $sep = '&amp;';
	$packed_js .= $sep.$key.'='.$val; 
}

// CSS Variables
if ($bg_image == "" ) $bg_image = "default";

$packed_css_vars = array();
$packed_css_vars["A01"]=$themelet;
$packed_css_vars["A02"]=$direction;
$packed_css_vars["B01"]=$logo_type;
$packed_css_vars["B02"]=$logo;
$packed_css_vars["B03"]=$logo_size[0];
$packed_css_vars["B04"]=$logo_size[1];
$packed_css_vars["B05"]=urlencode($logo_textcolor);
$packed_css_vars["B06"]=urlencode($logo_fontfamily);
$packed_css_vars["B07"]=$logo_fontsize;
$packed_css_vars["C01"]=urlencode($slogan_textcolor);
$packed_css_vars["C02"]=urlencode($slogan_fontfamily);
$packed_css_vars["C03"]=$slogan_fontsize;
$packed_css_vars["C04"]=$display_slogan;
$packed_css_vars["D01"]=urlencode($bg_color);
$packed_css_vars["D02"]=$bg_image;
$packed_css_vars["D03"]=$bg_repeat;
$packed_css_vars["D04"]=urlencode($bg_position);
$packed_css_vars["D05"]=$bg_attachment;
$packed_css_vars["E01"]=urlencode($color_h1);
$packed_css_vars["E02"]=urlencode($color_h2);
$packed_css_vars["E03"]=urlencode($color_h3);
$packed_css_vars["E04"]=urlencode($color_h4);
$packed_css_vars["E05"]=urlencode($color_h5);
$packed_css_vars["E06"]=urlencode($color_links);
$packed_css_vars["E07"]=urlencode($color_linkshover);
$packed_css_vars["E08"]=urlencode($color_linksvisited);
$packed_css_vars["E09"]=urlencode($color_bodytext);
$packed_css_vars["F01"]=urlencode($footer_textcolor);
$packed_css_vars["F02"]=urlencode($footer_linkscolor);
$packed_css_vars["G01"]=$topfish;
$packed_css_vars["G02"]=$topdrop;
$packed_css_vars["G03"]=$topnav_count;
$packed_css_vars["G04"]=$sidenav_count;
$packed_css_vars["G05"]=$sidefish;
$packed_css_vars["H01"]=$toolbar_slider;
$packed_css_vars["Z01"]=$gzip_compression;
$packed_css_vars["Z02"]=$pack_css;
$packed_css_vars["Z03"]=$custom_css;

$packed_css = '';
foreach($packed_css_vars as $key => $val){
	($key == 'A01') ? $sep = '?' : $sep = '&amp;';
	$packed_css .= $sep.$key.'='.$val; 
}
?>
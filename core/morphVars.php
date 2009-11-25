<?php

if ( $logo_type == 1 or $logo_type == 2 ) {
	if( isIE6() && $logo_image_ie !== ''){ 
		$logo = $assetspath.DS.'logos'.DS.$logo_image_ie; 
		if($logo_autodimensions == 1) {
			$logo_size = getimagesize($assetsroot.DS.'logos'.DS.$logo_image_ie);
		}else{
			$logo_size[0] = $logo_width;
			$logo_size[1] = $logo_height;
		}	
	} else{ 
		$logo = $assetspath.'/logos/'.$logo_image; 
		if($logo_autodimensions == 1) {
			$logo_size = getimagesize($assetsroot.DS.'logos'.DS.$logo_image);
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

// css and js packing variables
(isset($_COOKIE['unpackjs'])) ? $pack_js = 0 : $pack_js = $pack_js;
(isset($_COOKIE['unpackcss'])) ? $pack_css = 0 : $pack_css = $pack_css;

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

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'splitleft' AND `module` = 'mod_mainmenu' OR `position` = 'topleft' AND `module` = 'mod_mainmenu' OR `position` = 'left' AND `module` = 'mod_mainmenu' OR `position` = 'bottomleft' AND `module` = 'mod_mainmenu' OR `position` = 'splitright' AND `module` = 'mod_mainmenu' OR `position` = 'topright' AND `module` = 'mod_mainmenu' OR `position` = 'right' AND `module` = 'mod_mainmenu' OR `position` = 'bottomright' AND `module` = 'mod_mainmenu'" ;
$db->setQuery( $query ); $sidenav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `module` = 'mod_mainmenu' OR `position` = 'top' AND `module` = 'mod_mainmenu'  OR `position` = 'toolbar' AND `module` = 'mod_mainmenu'";
$db->setQuery( $query ); $topnav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'left' AND `params` LIKE '%moduleclass_sfx=animate%' OR `position` = 'left' AND  `params` LIKE '% animate%'";
$db->setQuery( $query ); $animate_left = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simpleticker' AND `published` = '1'";
$db->setQuery( $query ); $simpleticker = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simpletweet' AND `published` = '1'";
$db->setQuery( $query ); $simpletweet = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simplecontact' AND `published` = '1'";
$db->setQuery( $query ); $simplecontact = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simplesocial' AND `published` = '1'";
$db->setQuery( $query ); $simplesocial = $db->loadResult();

if(file_exists($themeletjs)){ $themelet_js = 1; }else{ $themelet_js = 0; }
if(file_exists($customjs)){ $custom_js = 1; }else{ $custom_js = 0; }
if(file_exists($customcss)){ $custom_css = 1; }else{ $custom_css = 0; }

$pt_mod = getModuleParams('mod_simpleticker');

// JS Variables
$packed_js_vars = array();
$packed_js_vars["A01"]=$jquery_core;
$packed_js_vars["A02"]=$themelet;
$packed_js_vars["A03"]=$google_analytics;
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
$packed_js_vars["D01"]=$toolbar_equalize;
$packed_js_vars["D02"]=$masthead_equalize;
$packed_js_vars["D03"]=$subhead_equalize;
$packed_js_vars["D04"]=$topnav_equalize;
$packed_js_vars["D05"]=$topshelf_equalize;
$packed_js_vars["D06"]=$bottomshelf_equalize;
$packed_js_vars["D07"]=$user1_equalize;
$packed_js_vars["D08"]=$user2_equalize;
$packed_js_vars["D09"]=$inset1_equalize;
$packed_js_vars["D10"]=$inset2_equalize;
$packed_js_vars["D11"]=$inset3_equalize;
$packed_js_vars["D12"]=$inset4_equalize;
$packed_js_vars["D13"]=$splitleft_equalize;
$packed_js_vars["D14"]=$topleft_equalize;
$packed_js_vars["D15"]=$left_equalize;
$packed_js_vars["D16"]=$bottomleft_equalize;
$packed_js_vars["D17"]=$splitright_equalize;
$packed_js_vars["D18"]=$topright_equalize;
$packed_js_vars["D19"]=$right_equalize;
$packed_js_vars["D20"]=$bottomright_equalize;
$packed_js_vars["D21"]=$footer_equalize;
$packed_js_vars["E01"]=$tabscount;
$packed_js_vars["E02"]=$accordionscount;
$packed_js_vars["E03"]=$toolbar_count;
$packed_js_vars["E04"]=$masthead_count;
$packed_js_vars["E05"]=$subhead_count;
$packed_js_vars["E06"]=$topnav_count;
$packed_js_vars["E07"]=$topshelf_count;
$packed_js_vars["E08"]=$bottomshelf_count;
$packed_js_vars["E09"]=$user1_count;
$packed_js_vars["E10"]=$user2_count;
$packed_js_vars["E11"]=$inset1_count;
$packed_js_vars["E12"]=$inset2_count;
$packed_js_vars["E13"]=$inset3_count;
$packed_js_vars["E14"]=$inset4_count;
$packed_js_vars["E15"]=$splitleft_count;
$packed_js_vars["E16"]=$topleft_count;
$packed_js_vars["E17"]=$left_count;
$packed_js_vars["E18"]=$bottomleft_count;
$packed_js_vars["E19"]=$splitright_count;
$packed_js_vars["E20"]=$topright_count;
$packed_js_vars["E21"]=$right_count;
$packed_js_vars["E22"]=$bottomright_count;
$packed_js_vars["E23"]=$footer_count;
$packed_js_vars["E24"]=$roundedcount;
$packed_js_vars["E25"]=$rounded_corners;
$packed_js_vars["E26"]=$rounded_amount;
$packed_js_vars["F01"]=$plugin_scrollto;
$packed_js_vars["F02"]=$rounded_corners;
$packed_js_vars["G01"]=$captions_enabled;
$packed_js_vars["G02"]=$captions_speedover;
$packed_js_vars["G03"]=$captions_speedout;
$packed_js_vars["G04"]=$captions_delay;
$packed_js_vars["G05"]=$captions_animation;
$packed_js_vars["G06"]=$captions_prefix;
$packed_js_vars["G07"]=$captions_opacity;
$packed_js_vars["G08"]=$captions_position;
$packed_js_vars["H01"]=$simpleticker;
$packed_js_vars["H02"]=$simpletweet;
$packed_js_vars["Z01"]=$gzip_compression;
$packed_js_vars["Z02"]=$pack_js;
$packed_js_vars["Z03"]=$custom_js;
$packed_js_vars["Z04"]=$themelet_js;
$packed_js_vars["Z05"]=$developer_toolbar;

if(!empty($pt_mod)){
	$packed_js_vars["Z05"]=$pt_mod['pt_delay'];
}

$packed_js = '';
foreach($packed_js_vars as $key => $val){
	($key == 'A01') ? $sep = '?' : $sep = '&amp;';
	$packed_js .= $sep.$key.'='.$val; 
}
$packed_css_vars = array();
$packed_css_vars["A01"]=$themelet;
$packed_css_vars["A02"]=$this->direction;
$packed_css_vars["A03"]=$tabscount;
$packed_css_vars["A04"]=$lcbrowser;
$packed_css_vars["A05"]=$accordionscount;
$packed_css_vars["B01"]=$logo_type;
$packed_css_vars["B02"]=urlencode($logo);
$packed_css_vars["B03"]=$logo_size[0];
$packed_css_vars["B04"]=$logo_size[1];
$packed_css_vars["B05"]=urlencode($logo_textcolor);
$packed_css_vars["B06"]=urlencode($logo_fontfamily);
$packed_css_vars["B07"]=$logo_fontsize;
$packed_css_vars["B08"]=$logo_top;
$packed_css_vars["B09"]=$logo_left;
$packed_css_vars["B10"]=$logo_stack;
$packed_css_vars["B11"]=$display_ie_logo;
$packed_css_vars["B12"]=$logo_image_ie;
$packed_css_vars["B13"]=$masthead_height;
$packed_css_vars["C01"]=urlencode($slogan_textcolor);
$packed_css_vars["C02"]=urlencode($slogan_fontfamily);
$packed_css_vars["C03"]=$slogan_fontsize;
$packed_css_vars["C04"]=$display_slogan;
$packed_css_vars["C05"]=$slogan_top;
$packed_css_vars["C06"]=$slogan_left;
$packed_css_vars["C07"]=$slogan_stack;
$packed_css_vars["D01"]=urlencode($html_bg_color);
$packed_css_vars["D02"]=$use_html_bg_image;
$packed_css_vars["D03"]=$html_bg_image;
$packed_css_vars["D04"]=$html_bg_repeat;
$packed_css_vars["D05"]=urlencode($html_bg_position);
$packed_css_vars["D06"]=$html_bg_attachment;
$packed_css_vars["D07"]=urlencode($body_bg_color);
$packed_css_vars["D08"]=$use_body_bg_image;
$packed_css_vars["D09"]=$body_bg_image;
$packed_css_vars["D10"]=$body_bg_repeat;
$packed_css_vars["D11"]=urlencode($body_bg_position);
$packed_css_vars["D12"]=$body_bg_attachment;
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
$packed_css_vars["I01"]=JDocumentHTML::countModules('left');
$packed_css_vars["J01"]=$captions_enabled;
$packed_css_vars["J02"]=urlencode($captions_bgcolor);
$packed_css_vars["J03"]=urlencode($captions_bordercolor);
$packed_css_vars["J04"]=$captions_borderheight;
$packed_css_vars["J05"]=urlencode($captions_textcolor);
$packed_css_vars["K01"]=$simpleticker;
$packed_css_vars["K02"]=$simpletweet;
$packed_css_vars["K03"]=$simplecontact;
$packed_css_vars["K04"]=$simplesocial;
$packed_css_vars["Z01"]=$gzip_compression;
$packed_css_vars["Z02"]=$pack_css;
$packed_css_vars["Z03"]=$custom_css;
$packed_css_vars["Z04"]=$developer_toolbar;
$packed_css = '';
foreach($packed_css_vars as $key => $val){
	($key == 'A01') ? $sep = '?' : $sep = '&amp;';
	$packed_css .= $sep.$key.'='.$val; 
}
?>
<?php

defined('_JEXEC') or die('Restricted access');

// initiate morph
include_once('templates/morph/core/morphLoader.php');
include_once('templates/morph/core/morphParams.php');
require_once('templates/morph/core/browser.php');

// set the various paths:
$templatepath = JURI::root() . 'templates/' . $this->template;
$themeletpath = JURI::root() . 'templates/' . $this->template . '/assets/themelets/' . $themelet;
$absolutepath = JPATH_SITE.DS.'templates'.DS.$this->template.DS.'assets'.DS.'themelets'.DS.$themelet;

// set the document parameters with what morph found:
$MORPH_paramlist = get_object_vars($MORPH);
$new_params = '';
foreach( $MORPH_paramlist as $key=>$value ) {
    $new_params .= $key."=".$value."\n";
}
$this->params 				= new JParameter( $new_params );
$option 					= JRequest::getCmd('option');
$task 						= JRequest::getCmd('task');
$view 						= JRequest::getCmd('view');
$layout 					= JRequest::getCmd('layout');
$page 						= JRequest::getCmd('page');
$secid 						= JRequest::getCmd('secid');
$catid 						= JRequest::getCmd('catid');
$itemid 					= JRequest::getCmd('Itemid');
$pageclass   				= "";
$document 					= &Jfactory::getDocument();  
$menus      				= &JSite::getMenu();
$menu      					= $menus->getActive();
if (is_object( $menu )) :
$params 					= new JParameter( $menu->params );
$pageclass 					= $params->get( 'pageclass_sfx' );
endif;
$user 						=& JFactory::getUser();
$user1count 				= $this->countModules('user1');
$user2count 				= $this->countModules('user2');
$topshelfcount 				= $this->countModules('topshelf');
$btmshelfcount 				= $this->countModules('btmshelf');
$stylelink 					= '';
$direction  				= $this->direction;
$ied 						= "$absolutepath/css/ie.css";
$ie6 						= "$absolutepath/css/ie6.css";
$ie7 						= "$absolutepath/css/ie7.css";
$ie8 						= "$absolutepath/css/ie8.css";
$customcss					= "$absolutepath/css/custom.css";
$customjs					= "$absolutepath/js/custom.js";
$themeletfunctions			= "$absolutepath/custom.php";
$browser 					= new Browser();
$thebrowser 				= ereg_replace("[^A-Za-z]", "", $browser->getBrowser());
$ver 						= $browser->getVersion();
$dots 						= ".";
$dashes 					= "";
$mod_chrome					= "";
$ver 						= str_replace($dots , $dashes , $ver);
$lcbrowser 					= strtolower($thebrowser);

if($option !== 'com_user') {
	if($user->get('guest') == 1 or $user->usertype == 'Registered' && $load_mootools == "0") {
		$headerstuff = $this->getHeadData();
		unset($headerstuff['scripts'][$this->baseurl.'/media/system/js/mootools.js']);
		$this->setHeadData($headerstuff);
	}
}

if($user->get('guest') == 1 or $user->usertype == 'Registered' && $load_caption == "0") {
	$headerstuff = $this->getHeadData();
	unset($headerstuff['scripts'][$this->baseurl.'/media/system/js/caption.js']);
	$this->setHeadData($headerstuff);
}

if ( $remove_generator == 1 ) {
$this->setGenerator(null);
}

if(file_exists($themeletfunctions) && is_readable($themeletfunctions)){
include_once($absolutepath.'/custom.php');
}
function debug_chrome($pt_debug, $pt_mod_chrome){	if( $pt_debug == 1 ){ 		return 'outline'; 	} else { 		return $pt_mod_chrome; 	}}

if( isIE6() && $logo_image_ie !== ''){ $logo = $templatepath.'/assets/logos/'.$ie_logo_image; } else { $logo = $templatepath.'/assets/logos/'.$logo_image; }
$logo_size = getimagesize($logo);

$db=& JFactory::getDBO();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'tabs' ";
$db->setQuery( $query );
$tabscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=rounded%' ";
$db->setQuery( $query );
$roundedcount = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND params LIKE '%moduleclass_sfx=topdrop%' OR position = 'user3' AND params LIKE '% topdrop%'";
$db->setQuery( $query );
$topdrop = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND params LIKE '%moduleclass_sfx=topfish%' OR position = 'user3' AND params LIKE '% topfish%'";
$db->setQuery( $query );
$topfish = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND params LIKE '%moduleclass_sfx=subtext%' OR position = 'user3' AND params LIKE '% subtext%'";
$db->setQuery( $query );
$subtext_top = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND params LIKE '%moduleclass_sfx=animate%' OR position = 'user3' AND params LIKE '% animate%'";
$db->setQuery( $query );
$animate_top = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE params LIKE '%moduleclass_sfx=sidefish%' OR params LIKE '%sidefish%'";
$db->setQuery( $query );
$sidefish = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'left' AND module = 'mod_mainmenu' OR position = 'right' AND module = 'mod_mainmenu'";
$db->setQuery( $query );
$sidenav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND module = 'mod_mainmenu'";
$db->setQuery( $query );
$topnav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'left' AND params LIKE '%moduleclass_sfx=animate%' OR position = 'left' AND  params LIKE '% animate%'";
$db->setQuery( $query );
$animate_left = $db->loadResult();

$packed_js = 
"A01=$jquery_core" . '&amp;' . 
"B01=$topfish" . '&amp;' . 
"B02=$sidefish" . '&amp;' . 
"B03=$topdrop" . '&amp;' . 
"B04=$topnav_supersubs" . '&amp;' . 
"B05=$topnav_hoverintent" . '&amp;' . 
"C01=$toolbar_slider" . '&amp;' . 
"C02=$topshelf_slider". '&amp;' . 
"C03=$bottomshelf_slider" . '&amp;' . 
"D01=$topshelf_equalize". '&amp;' . 
"D02=$bottomshelf_equalize". '&amp;' . 
"D03=$user1_equalize" . '&amp;' . 
"D04=$user2_equalize". '&amp;' . 
"E01=$tabscount" . '&amp;' . 
"F01=$image_captions". '&amp;' . 
"F02=$rounded_corners" . '&amp;' . 
"Z01=$gzip_compression";

$dynamic_js = 
"A01=$topshelf_equalize" . '&amp;' . 
"A02=$bottomshelf_equalize" . '&amp;' . 
"A03=$user1_equalize" . '&amp;' . 
"A04=$user2_equalize" . '&amp;' .
"B01=$topshelfcount" . '&amp;' . 
"B02=$btmshelfcount" . '&amp;' . 
"B03=$user1count". '&amp;' . 
"B04=$user2count" . '&amp;' . 
"B05=$tabscount" . '&amp;' . 
"B06=$roundedcount" . '&amp;' . 
"C01=$rounded_corners" . '&amp;' . 
"C02=$rounded_amount" . '&amp;' . 
"D01=$toolbar_slider" . '&amp;' . 
"D02=$toolbar_slider_text" . '&amp;' . 
"D03=$topshelf_slider" . '&amp;' . 
"D04=$topshelf_slider_text" . '&amp;' . 
"D05=$bottomshelf_slider" . '&amp;' . 
"D06=$bottomshelf_slider_text" . '&amp;' . 
"E01=$image_captions" . '&amp;' . 
"F01=$topnav_hoverfocus" . '&amp;' . 
"F02=$topnav_supersubs" . '&amp;' . 
"F03=$topnav_minwidth" . '&amp;' . 
"F04=$topnav_maxwidth" . '&amp;' . 
"F05=$topnav_delay" . '&amp;' . 
"F06=$topnav_animation" . '&amp;' . 
"F07=$topnav_hoverintent" . '&amp;' . 
"F08=$topfish" . '&amp;' . 
"F09=$sidefish" . '&amp;' . 
"F10=$animate_left" . '&amp;' . 
"Z01=$gzip_compression";

$packed_css = 
"A01=$themelet" . '&amp;' . 
"A02=$direction" . '&amp;' . 
"B01=$topfish" . '&amp;' . 
"B02=$topdrop" . '&amp;' . 
"B03=$topnav_count" . '&amp;' . 
"B04=$sidenav_count" . '&amp;' . 
"C01=$tabscount" . '&amp;' .
"Z01=$gzip_compression";

if ($bg_image == "" ) { $bg_image = "default"; }

$dynamic_css = 
"A01=$toolbar_slider" . '&amp;' . 
"B01=$logo_type" . '&amp;' . 
"B02=$logo" . '&amp;' . 
"B03=$logo_size[0]" . '&amp;' . 
"B04=$logo_size[1]" . '&amp;' . 
"B05=$logo_textcolor" . '&amp;' . 
"B06=".urlencode($logo_fontfamily) . '&amp;' . 
"B07=$logo_fontsize" . '&amp;' . 
"C01=$slogan_textcolor" . '&amp;' . 
"C02=$slogan_fontfamily" . '&amp;' . 
"C03=$slogan_fontsize" . '&amp;' . 
"C04=$display_slogan" . '&amp;' . 
"D01=$bg_color" . '&amp;' . 
"D02=$bg_image" . '&amp;' . 
"D03=$bg_repeat" . '&amp;' . 
"D04=".urlencode($bg_position) . '&amp;' . 
"D05=$bg_attachment" . '&amp;' . 
"E01=$color_h1" . '&amp;' . 
"E02=$color_h2" . '&amp;' . 
"E03=$color_h3" . '&amp;' . 
"E04=$color_h4" . '&amp;' . 
"E05=$color_h5" . '&amp;' . 
"E06=$color_links" . '&amp;' . 
"E07=$color_linkshover" . '&amp;' . 
"E08=$color_linksvisited" . '&amp;' . 
"E09=$color_bodytext" . '&amp;' . 
"F01=$footer_textcolor" . '&amp;' . 
"F02=$footer_linkscolor" . '&amp;' . 
"Z01=$gzip_compression";

if ( $pack_js == 1 ) {
	$document->addScript($templatepath .'/js/template.js.php?'.$packed_js);
	$document->addScript($templatepath .'/js/dynamic.js.php?'.$dynamic_js);
	if(file_exists($customjs) && is_readable($customjs)){
	$document->addScript($themeletpath .'/js/custom.js');
	}
} else {
	if ( $jquery_core == 1 ) {
	$document->addScript($templatepath .'/js/jquery-1.3.2.min.js');
	}
	if ( $tabscount >= 1 ) {
	$document->addScript($templatepath .'/js/jquery.ui.core.js');
	$document->addScript($templatepath .'/js/jquery.ui.tabs.js');
	}
	if ( $tabscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1  ) {
	$document->addScript($templatepath .'/js/jquery.cookie.js');
	}
	if ( $topfish >= 1 && $topnav_hoverintent == 1 ) {
	$document->addScript($templatepath .'/js/jquery.superfish.hoverintent.js');
	}
	if ( $sidefish >= 1 or $topfish >= 1  ) { 	
	$document->addScript($templatepath .'/js/jquery.superfish.js');
	}
	if ( $topfish >= 1 && $topnav_supersubs == 1 ) {
	$document->addScript($templatepath .'/js/jquery.superfish.supersubs.js');
	}
	if ( $rounded_corners == 1 or $roundedcount !== 0 ) {
	$document->addScript($templatepath .'/js/jquery.corners.js');
	}
	if ( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  ) {
	$document->addScript($templatepath .'/js/jquery.equalheights.js');
	}
	if ( $image_captions == 1 ) {
	$document->addScript($templatepath .'/js/jquery.captify.js');
	}
	if(file_exists($customjs) && is_readable($customjs)){
	$document->addScript($themeletpath .'/js/custom.js');
	}
	$document->addScript($templatepath .'/js/dynamic.js.php?'.$dynamic_js);
}
if ( $pack_css == 1 ) {
	$document->addStyleSheet($themeletpath .'/css/template.css.php?'.$packed_css);
	$document->addStyleSheet($themeletpath .'/css/dynamic.css.php?'.$dynamic_css);
	if(file_exists($customcss) && is_readable($customcss)){
	$document->addStyleSheet($themeletpath .'/css/custom.css');
	}
} else {
	$document->addStyleSheet($templatepath .'/css/yui.css');
	
	// old menus.css reference - needs to be removed.
	//$document->addStyleSheet($themeletpath .'/css/menus.css');
	
	// top navigation	
	if ( $topnav_count >= 1 ) {
	$document->addStyleSheet($themeletpath .'/css/topnav-default.css');
	}
	if ( $topfish >= 1 ) {	
	$document->addStyleSheet($themeletpath .'/css/topnav-topfish.css');
	}
	if ( $topdrop >= 1 ) {	
	$document->addStyleSheet($themeletpath .'/css/topnav-topdrop.css');
	}
	// side navigation
	if ( $sidenav_count >= 1 ) {
	$document->addStyleSheet($themeletpath .'/css/sidenav-default.css');
	}
	if ( $sidefish >= 1 ) {	
	$document->addStyleSheet($themeletpath .'/css/sidenav-sidefish.css');
	}
	$document->addStyleSheet($themeletpath .'/css/layout.css');
	$document->addStyleSheet($themeletpath .'/css/joomla.css');
	$document->addStyleSheet($themeletpath .'/css/modules.css');
	$document->addStyleSheet($themeletpath .'/css/typo.css');
	$document->addStyleSheet($themeletpath .'/css/tabs.css');
	$document->addStyleSheet($themeletpath .'/css/chromes.css');
	$document->addStyleSheet($themeletpath .'/css/dynamic.css.php?'.$dynamic_css);	
	if($this->direction == 'rtl') {
	$document->addStyleSheet($templatepath .'/css/template_rtl.css');
	}
	if(file_exists($customcss) && is_readable($customcss)){
	$document->addStyleSheet($themeletpath .'/css/custom.css');
	}
}
function isIE6(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(strpos($user_agent, 'MSIE 6 ')){
		return true;
	} else {
		return false;
	}
}

$ua = $_SERVER['HTTP_USER_AGENT'];
switch($ua){
	case strpos($ua, 'MSIE'):
		if(file_exists($ie) && is_readable($ie)){
			echo $document->addStyleSheet($ie);
		}
	break;
	case (strpos($ua, 'MSIE 6')):
		echo 'test';
		if(file_exists($ie6) && is_readable($ie6)){
			echo $document->addStyleSheet($ie6);
		}
	break;
	case strpos($ua, 'MSIE 7'):
		if(file_exists($ie7) && is_readable($ie7)){
			echo $document->addStyleSheet($ie7);
		}
	break;
	case strpos($ua, 'MSIE 8'):
		if(file_exists($ie8) && is_readable($ie8)){
			echo $document->addStyleSheet($ie8);
		}
	break;
}
	
// get layout functions
include_once('InnerLayout.php');
include_once('OuterLayout.php');

if (!$this->countModules('right')) $CurrentInnerScheme = 'no-grid';
if (!$this->countModules('user4')) $no_search = 'no_search';

// intelli mods array
$jj_const = array(
	"yui_suffix" => array(
		0				=> "",			// no suffix since no modules present
		1				=> "no-grid",	// no-grid since only 1 module present
		2				=> "yui-g",		// yui-g for 2 blocks in a grid
		3				=> "yui-gb"		// yui-gb for 3 blocks in a grid
		),
	"mod_suffix" => array(
		"toolbar"		=>$this->params->get('toolbar_gridsplit'),	
		"top"			=>$this->params->get('top_gridsplit'),
		"topnav"		=>$this->params->get('topnav_gridsplit'),
		"user1"			=>$this->params->get('topshelf_gridsplit'),
		"inset1"		=>$this->params->get('inset1_gridsplit'),
		"inset2"		=>$this->params->get('inset2_gridsplit'),
		"inset3"		=>$this->params->get('inset3_gridsplit'),
		"inset4"		=>$this->params->get('inset4_gridsplit'),
		"user1"			=>$this->params->get('user1_gridsplit'),
		"user2"			=>$this->params->get('user2_gridsplit'),
		"bottomshelf"	=>$this->params->get('bottomshelf_gridsplit'),
		"footer"		=>$this->params->get('footer_gridsplit'),
		)
	);

function getYuiSuffix ($moduleName, $jj_const){
	$myJdoc = new JDocumentHTML();
	$moduleCount = $myJdoc->countModules($moduleName); 
	if ($moduleCount == 2) {
		$yuiModuleSuffix = $jj_const["mod_suffix"][$moduleName];
	} else {
		$yuiModuleSuffix = $jj_const["yui_suffix"][$moduleCount];
	}
	echo $yuiModuleSuffix;
}

?>
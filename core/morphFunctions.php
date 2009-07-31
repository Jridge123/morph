<?php
defined('_JEXEC') or die('Restricted access');
if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
	if(!ob_start("ob_gzhandler")) ob_start();
}else{
	ob_start();
}
// initiate morph
include_once('templates/morph/core/morphLoader.php');
include_once('templates/morph/core/morphParams.php');
require_once('templates/morph/core/browser.php');

// set the various paths:
$templatepath = JURI::root() . 'templates/' . $this->template;
$themeletpath = JURI::root() . 'morph_assets/themelets/' . $themelet;
$assetspath = JURI::root() . 'morph_assets';
$assetsroot = JPATH_SITE.DS.'morph_assets';
$imagespath = JURI::root() . 'morph_assets/themelets/' . $themelet.'/images/';
$absolutepath = JPATH_SITE.DS.'morph_assets'.DS.'themelets'.DS.$themelet;

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
$document 					= Jfactory::getDocument();  
$menus      				= JSite::getMenu();
$menu      					= $menus->getActive();
if (is_object( $menu )) :
$params 					= new JParameter( $menu->params );
$pageclass 					= $params->get( 'pageclass_sfx' );
endif;
$user 						= JFactory::getUser();
$user1count 				= JDocumentHTML::countModules('user1');
$user2count 				= JDocumentHTML::countModules('user2');
$topshelfcount 				= JDocumentHTML::countModules('topshelf');
$btmshelfcount 				= JDocumentHTML::countModules('bottomshelf');
$stylelink 					= '';

$direction  				= $this->direction;
// Browser info
$browser 					= new Browser();
$thebrowser 				= ereg_replace("[^A-Za-z]", "", $browser->getBrowser());
$ver 						= $browser->getVersion();
$dots 						= ".";
$dashes 					= "";
$mod_chrome					= "";
$ver 						= str_replace($dots , $dashes , $ver);
$lcbrowser 					= strtolower($thebrowser);
$css_yui					= $absolutepath."/css/yui.css";
$css_joomla 				= $absolutepath."/css/joomla.css";
$css_modules 				= $absolutepath."/css/modules.css";
$css_typo 					= $absolutepath."/css/typo.css";
$css_tabs 					= $absolutepath."/css/tabs.css";
$css_accordions				= $absolutepath."/css/accordions.css";
$css_tnav_default 			= $absolutepath."/css/topnav_default.css";
$css_tnav_topfish 			= $absolutepath."/css/topnav_topfish.css";
$css_tnav_topdrop 			= $absolutepath."/css/topnav_topdrop.css";
$css_snav_default 			= $absolutepath."/css/sidenav_default.css";
$css_snav_sidefish 			= $absolutepath."/css/sidenav_sidefish.css";
$ie 						= $absolutepath."/css/ie.css";
$ie6 						= $absolutepath."/css/ie6.css";
$ie7 						= $absolutepath."/css/ie7.css";
$ie8 						= $absolutepath."/css/ie8.css";
$customcss					= $absolutepath."/css/custom.css";
$customjs					= $absolutepath."/js/custom.js";
$themeletfunctions			= $absolutepath."/custom.php";

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
}function debug_chrome($pt_debug, $pt_mod_chrome){	if( $pt_debug == 1 ){ 		return 'outline'; 	} else { 		return $pt_mod_chrome; 	}}

include 'morphVars.php';

if(file_exists($themeletfunctions) && is_readable($themeletfunctions)){
include_once($absolutepath.'/custom.php');
}

// CSS and JS URL Packing
$curr_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if($pack_js == 1){
	if(isset($_GET['unpackjs'])){
		setcookie('unpackjs', 'true', 0);
		header('Location: ' . str_replace(array('?unpackjs','&unpackjs'), '', $curr_url));
	}elseif(isset($_GET['packjs'])){
		setcookie('unpackjs', 'true', time()-3600);
		header('Location: ' . str_replace(array('?packjs','&packjs'), '', $curr_url));
	}
}else{
	if( isset($_GET['unpackjs']) || isset($_GET['packjs']) ){
		header('Location: ' . str_replace(array('?unpackjs','&unpackjs','?packjs','&packjs'), '', $curr_url));
	}
}
if($pack_css == 1){
	if(isset($_GET['unpackcss'])){
		setcookie('unpackcss', 'true', 0);
		header('Location: ' . str_replace(array('?unpackcss','&unpackcss'), '', $curr_url));
	}elseif(isset($_GET['packcss'])){
		setcookie('unpackcss', 'true', time()-3600);
		header('Location: ' . str_replace(array('?packcss','&packcss'), '', $curr_url));
	}
}else{
	if(isset($_GET['unpackcss']) || isset($_GET['packcss'])){
		header('Location: ' . str_replace(array('?unpackcss','&unpackcss','?packcss','&packcss'), '', $curr_url));
	}
}

// JS Packing
if ( isset($_COOKIE['unpackjs']) && $pack_js == 1 || isset($_COOKIE['unpackjs']) && $pack_js == 0 || !isset($_COOKIE['unpackjs']) && $pack_js == 0 ) {
	if ( $jquery_core == 1 ) { $document->addScript($templatepath .'/core/js/jquery-1.3.2.min.js'); }
	if ( $tabscount >= 1 ) {
		$document->addScript($templatepath .'/core/js/jquery.ui.core.js');
		$document->addScript($templatepath .'/core/js/jquery.ui.tabs.js');
	}
	if ( $accordionscount >= 1 ) {
		$document->addScript($templatepath .'/core/js/jquery.ui.core.js');
		$document->addScript($templatepath .'/core/js/jquery.ui.accordion.js');
	}
	if( $tabscount >= 1 or $accordionscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 ) { 
	$document->addScript($templatepath .'/core/js/jquery.cookie.js'); 
	}
	if( $topfish >= 1 && $topnav_hoverintent == 1 ) { $document->addScript($templatepath .'/core/js/jquery.superfish.hoverintent.js');}
	if( $sidefish >= 1 or $topfish >= 1  ) { $document->addScript($templatepath .'/core/js/jquery.superfish.js');	}
	if( $topfish >= 1 && $topnav_supersubs == 1 ) { $document->addScript($templatepath .'/core/js/jquery.superfish.supersubs.js'); }
	if( $rounded_corners == 1 or $roundedcount !== 0 ) { $document->addScript($templatepath .'/core/js/jquery.corners.js');	}
	if( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  ) { 
	$document->addScript($templatepath .'/core/js/jquery.equalheights.js'); 
	}
	if ( $plugin_scrollto == 1 ) { 
	$document->addScript($templatepath .'/js/jquery.scrollTo-1.4.2-min.js');
	}
	$document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
	if( $custom_js == 1 ){ $document->addScript($themeletpath .'/js/custom.js'); }
}else{
	$document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
	if( $custom_js == 1 ){ $document->addScript($themeletpath .'/js/custom.js'); }
}

// CSS Packing
if ( isset($_COOKIE['unpackcss']) && $pack_css == 1 || isset($_COOKIE['unpackcss']) && $pack_css == 0 || !isset($_COOKIE['unpackcss']) && $pack_css == 0 ) {

	$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);

	if(file_exists($css_yui) && is_readable($css_yui)){
		$document->addStyleSheet($themeletpath .'/core/css/yui.css');
	} else {
		$document->addStyleSheet($templatepath .'/core/css/yui.css');
	}
	if($this->direction == 'rtl' ){
		$document->addStyleSheet($themeletpath .'/core/css/rtl.css');
	}	
	$document->addStyleSheet($themeletpath .'/css/joomla.css');
	$document->addStyleSheet($themeletpath .'/css/modules.css');
	$document->addStyleSheet($themeletpath .'/css/typo.css');
	$document->addStyleSheet($themeletpath .'/css/tabs.css');
	$document->addStyleSheet($themeletpath .'/css/accordions.css');
	if($topnav_count >= 1 ){
		$document->addStyleSheet($themeletpath .'/css/topnav-default.css');
	}
	if($topfish >= 1 ){
		$document->addStyleSheet($themeletpath .'/css/topnav-topfish.css');
	}
	if($topdrop >= 1 ){
		$document->addStyleSheet($themeletpath .'/css/topnav-topdrop.css');
	}
	if($sidenav_count >= 1 ){
		$document->addStyleSheet($themeletpath .'/css/sidenav-default.css');
	}
	if($sidefish >= 1 ){
		$document->addStyleSheet($themeletpath .'/css/sidenav-sidefish.css');
	}

	if( $custom_css == 1 ){ $document->addStyleSheet($themeletpath .'/css/custom.css');	}
	$document->addStyleSheet($themeletpath .'/css/themelet.css');
	$document->addStyleSheet($themeletpath .'/css/modfx.css');	

}else{
	$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);
	if( $custom_css == 1 ){ $document->addStyleSheet($themeletpath .'/css/custom.css');	}
}

function isIE6(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(strpos($user_agent, 'MSIE 6 ')){
		return true;
	} else {
		return false;
	}
}

switch($_SERVER['HTTP_USER_AGENT']){
	case strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'):
	if(file_exists($ie) && is_readable($ie)) $document->addStyleSheet($ie);
	break;
	case (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')):
	if(file_exists($ie6) && is_readable($ie6)) $document->addStyleSheet($ie6);
	break;
	case strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7'):
	if(file_exists($ie7) && is_readable($ie7)) $document->addStyleSheet($ie7);
	break;
	case strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8'):
	if(file_exists($ie8) && is_readable($ie8)) $document->addStyleSheet($ie8);
	break;
}

// get layout functions
include_once('InnerLayout.php');
include_once('OuterLayout.php');

if (!JDocumentHTML::countModules('right')) $CurrentInnerScheme = 'no-grid';
if (!JDocumentHTML::countModules('user4')) $no_search = 'no_search';

// intelli mods array
$jj_const = array(
	"yui_suffix" => array(
		0				=> "",			// no suffix since no modules present
		1				=> "no-grid",	// no-grid since only 1 module present
		2				=> "yui-g",		// yui-g for 2 blocks in a grid
		3				=> "yui-gb",		// yui-gb for 3 blocks in a grid
		4				=> "yui-g4",		// yui-gb for 4 blocks in a grid
		5				=> "yui-g5"		// yui-gb for 5 blocks in a grid
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
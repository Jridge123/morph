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

$db=& JFactory::getDBO();

$query = "SELECT COUNT(*) FROM `#__morph` WHERE `param_value` = 'tabs' ";
$db->setQuery( $query );
$tabscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=rounded%' ";
$db->setQuery( $query );
$roundedcount = $db->loadResult();

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'user3' AND params LIKE '%moduleclass_sfx=superdrop%' OR position = 'user3' AND params LIKE '% superdrop%'";
$db->setQuery( $query );
$superdrop = $db->loadResult();

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

$query = "SELECT COUNT(*) FROM #__modules WHERE position = 'left' AND params LIKE '%moduleclass_sfx=animate%' OR position = 'left' AND  params LIKE '% animate%'";
$db->setQuery( $query );
$animate_left = $db->loadResult();

$js_vars1 = "01=$jquery_core" . '&amp;' . "02=$topfish" . '&amp;' . "03=$superdrop" . '&amp;' . "04=$topnav_supersubs" . '&amp;' . "05=$topnav_hoverintent" . '&amp;' . "06=$toolbar_slider" . '&amp;' . "07=$topshelf_slider". '&amp;' . "08=$bottomshelf_slider" . '&amp;' . "09=$topshelf_equalize". '&amp;' . "10=$bottomshelf_equalize". '&amp;' . "11=$user1_equalize" . '&amp;' . "12=$user2_equalize". '&amp;' . "13=$tabscount" . '&amp;' . "14=$image_captions". '&amp;' . "15=$rounded_corners" . '&amp;' . "16=$gzip_compression" . '&amp;' . "17=$topnav_type";

$js_vars2 = "01=$topshelf_equalize" . '&amp;' . "02=$bottomshelf_equalize" . '&amp;' . "03=$user1_equalize" . '&amp;' . "04=$user2_equalize" . '&amp;' . "05=$topshelfcount" . '&amp;' . "06=$btmshelfcount" . '&amp;' . "07=$user1count". '&amp;' . "08=$user2count" . '&amp;' . "09=$sidefish" . '&amp;' . "10=$animate_left" . '&amp;' . "12=$rounded_corners" . '&amp;' . "13=$toolbar_slider" . '&amp;' . "14=$toolbar_slider_text" . '&amp;' . "15=$topshelf_slider" . '&amp;' . "16=$topshelf_slider_text" . '&amp;' . "17=$bottomshelf_slider" . '&amp;' . "18=$bottomshelf_slider_text" . '&amp;' . "19=$image_captions" . '&amp;' . "20=$topnav_hoverfocus" . '&amp;' . "21=$rounded_amount" . '&amp;' . "22=$gzip_compression" . '&amp;' . "23=$tabscount" . '&amp;' . "24=$topnav_type" . '&amp;' . "25=$topnav_supersubs" . '&amp;' . "26=$topnav_minwidth" . '&amp;' . "27=$topnav_maxwidth" . '&amp;' . "28=$topnav_delay" . '&amp;' . "29=$topnav_animation";

$css_vars1 = "01=$themelet" . '&amp;' . "02=$topnav_type" . '&amp;' . "03=$topfish" . '&amp;' . "04=$topdrop" . '&amp;' . "05=$direction" . '&amp;' . "06=$tabscount" . '&amp;' . "06=$gzip_compression";

if ($themelet_bgimage == "" ) { $themelet_bgimage = "default"; }

$css_vars2 = "01=$logo_type" . '&amp;' . "02=$logo_width" . '&amp;' . "03=$logo_height" . '&amp;' . "04=$logo_image" . '&amp;' . "05=$logo_image_ie" . '&amp;' . "06=$toolbar_slider" . '&amp;' . "07=$themelet_bgcolor" . '&amp;' . "08=$themelet_bgimage" . '&amp;' . "09=$themelet_bgrepeat" . '&amp;' . "10=$themelet_bgposition" . '&amp;' . "11=$color_h1" . '&amp;' . "12=$color_h2" . '&amp;' . "13=$color_h3" . '&amp;' . "14=$color_h4" . '&amp;' . "15=$color_h5" . '&amp;' . "16=$color_links" . '&amp;' . "17=$color_linkshover" . '&amp;' . "18=$color_bodytext" . '&amp;' . "19=$gzip_compression";

if ( $pack_js == 1 ) {
	$document->addScript($templatepath .'/js/template.js.php?'.$js_vars1);
	$document->addScript($templatepath .'/js/dynamic.js.php?'.$js_vars2);
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
	if ( $topnav_hoverintent == 1 ) {
	$document->addScript($templatepath .'/js/jquery.superfish.hoverintent.js');
	}
	if ( $topnav_type = 1 or $topnav_type = 2 or $sidefish >= 1 or $topfish >= 1  ) { 	
	$document->addScript($templatepath .'/js/jquery.superfish.js');
	}
	if ( $topnav_supersubs == 1 ) {
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
	$document->addScript($templatepath .'/js/dynamic.js.php?'.$js_vars2);
}
if ( $pack_css == 1 ) {
	$document->addStyleSheet($themeletpath .'/css/template.css.php?'.$css_vars1);
	$document->addStyleSheet($themeletpath .'/css/dynamic.css.php?'.$css_vars2);
	if(file_exists($customcss) && is_readable($customcss)){
	$document->addScript($themeletpath .'/css/custom.css');
	}
} else {
	$document->addStyleSheet($templatepath .'/css/yui.css');
	$document->addStyleSheet($themeletpath .'/css/menus.css');
	if ( $topnav_type = 1 or $topfish >= 1 ) {	
	$document->addStyleSheet($themeletpath .'/css/topnav-topfish.css');
	}
	if ( $topnav_type = 2 or $topdrop >= 1 ) {	
	$document->addStyleSheet($themeletpath .'/css/topnav-topdrop.css');
	}
	$document->addStyleSheet($themeletpath .'/css/layout.css');
	$document->addStyleSheet($themeletpath .'/css/joomla.css');
	$document->addStyleSheet($themeletpath .'/css/modules.css');
	$document->addStyleSheet($themeletpath .'/css/typo.css');
	$document->addStyleSheet($themeletpath .'/css/tabs.css');
	$document->addStyleSheet($themeletpath .'/css/chromes.css');
	$document->addStyleSheet($themeletpath .'/css/dynamic.css.php?'.$css_vars2);	
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
if (!$this->countModules('left')) $no_left = 'no-left';
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
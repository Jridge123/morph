<?php
defined('_JEXEC') or die('Restricted access');

// initiate morph
include_once('templates/morph/core/morphLoader.php');
include_once('templates/morph/core/morphParams.php');
require_once('templates/morph/core/browser.php');
if ( $gzip_compression == 1 ) {
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}else{
		ob_start();
	}
}
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
$toolbar_count 				= JDocumentHTML::countModules('toolbar');
$masthead_count 			= JDocumentHTML::countModules('masthead');
$subhead_count 				= JDocumentHTML::countModules('subhead');
$topnav_count 				= JDocumentHTML::countModules('topnav');
$topshelf_count 			= JDocumentHTML::countModules('topshelf');
$bottomshelf_count 			= JDocumentHTML::countModules('bottomshelf');
$user1_count 				= JDocumentHTML::countModules('user1');
$user2_count 				= JDocumentHTML::countModules('user2');
$inset1_count 				= JDocumentHTML::countModules('inset1');
$inset2_count 				= JDocumentHTML::countModules('inset2');
$inset3_count 				= JDocumentHTML::countModules('inset3');
$inset4_count 				= JDocumentHTML::countModules('inset4');
$splitleft_count 			= JDocumentHTML::countModules('splitleft');
$topleft_count 				= JDocumentHTML::countModules('topleft');
$left_count 				= JDocumentHTML::countModules('left');
$bottomleft_count 			= JDocumentHTML::countModules('bottomleft');
$splitright_count 			= JDocumentHTML::countModules('splitright');
$topright_count 			= JDocumentHTML::countModules('topright');
$right_count 				= JDocumentHTML::countModules('right');
$bottomright_count 			= JDocumentHTML::countModules('bottomright');
$footer_count 				= JDocumentHTML::countModules('footer');
$stylelink 					= '';
$direction  				= $this->direction;
$browser 					= new Browser();
$thebrowser 				= ereg_replace("[^A-Za-z]", "", $browser->getBrowser());
$ver 						= $browser->getVersion();
$dots 						= ".";
$dashes 					= "";
$mod_chrome					= "";
$ver 						= str_replace($dots , $dashes , $ver);
$lcbrowser 					= strtolower($thebrowser);
$css_yui					= $absolutepath."/css/yui.css";
$css_iphone					= $absolutepath."/css/iphone.css";
$ie 						= $absolutepath."/css/ie.css";
$ie6 						= $absolutepath."/css/ie6.css";
$ie7 						= $absolutepath."/css/ie7.css";
$ie8 						= $absolutepath."/css/ie8.css";
$customcss					= $absolutepath."/css/custom.css";
$customjs					= $absolutepath."/js/custom.js";
$themeletfunctions			= $absolutepath."/custom.php";
$toolbar_override			= $absolutepath."/html/toolbar.php";
$masthead_override			= $absolutepath."/html/masthead.php";
$subhead_override			= $absolutepath."/html/subhead.php";
$topnav_override			= $absolutepath."/html/topnav.php";
$topshelf_override			= $absolutepath."/html/topshelf.php";
$bottomshelf_override		= $absolutepath."/html/bottomshelf.php";
$user1_override				= $absolutepath."/html/user1.php";
$user2_override				= $absolutepath."/html/user2.php";
$iphone_override			= $absolutepath."/html/iphone.php";
$main_override				= $absolutepath."/html/main.php";
$secondary_override			= $absolutepath."/html/secondary.php";
$tertiary_override			= $absolutepath."/html/tertiary.php";
$foot_override				= $absolutepath."/html/foot.php";

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
if(isset($_GET['unpackjs'])){
	setcookie('unpackjs', 'true', 0);
	header('Location: ' . str_replace(array('?unpackjs','&unpackjs'), '', $curr_url));
}elseif(isset($_GET['packjs'])){
	setcookie('unpackjs', 'true', time()-3600);
	header('Location: ' . str_replace(array('?packjs','&packjs'), '', $curr_url));
}
if(isset($_GET['unpackcss'])){
	setcookie('unpackcss', 'true', 0);
	header('Location: ' . str_replace(array('?unpackcss','&unpackcss'), '', $curr_url));
}elseif(isset($_GET['packcss'])){
	setcookie('unpackcss', 'true', time()-3600);
	header('Location: ' . str_replace(array('?packcss','&packcss'), '', $curr_url));
}

if($nojs == 0) {
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
		if( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  or $topleft_equalize == 1  ) { 
		$document->addScript($templatepath .'/core/js/jquery.equalheights.js'); 
		}
		if ( $plugin_scrollto == 1 ) { 
		$document->addScript($templatepath .'/core/js/jquery.scrollTo-1.4.2-min.js');
		}
		if ( $simpleticker == 1 ) { 
		$document->addScript($templatepath .'/core/js/jquery.innerfade.js');
		}
		$document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
		if( $custom_js == 1 ){ $document->addScript($themeletpath .'/js/custom.js'); }
	}else{
		$document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
	}
}else{
	if(isIE6()){ 
		$document->addScript($templatepath .'/core/js/ie6.js');
	}
}


if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) {
	if(file_exists($css_iphone) && is_readable($css_iphone)){
		$document->addStyleSheet($themeletpath .'/css/iphone.css');
	} else {
		$document->addStyleSheet($templatepath .'/core/css/iphone.css');
	}	
} else {
	// CSS Packing
	if ( isset($_COOKIE['unpackcss']) && $pack_css == 1 || isset($_COOKIE['unpackcss']) && $pack_css == 0 || !isset($_COOKIE['unpackcss']) && $pack_css == 0 ) {
	
		$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);
	
		if(file_exists($css_yui) && is_readable($css_yui)){
			$document->addStyleSheet($themeletpath .'/css/yui.css');
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
		$document->addStyleSheet($themeletpath .'/css/themelet.css');
		$document->addStyleSheet($themeletpath .'/css/modfx.css');	
		if( $custom_css == 1 ){ $document->addStyleSheet($themeletpath .'/css/custom.css');	}
	}else{
		$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);
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
      	"topshelf"      =>$this->params->get('topshelf_gridsplit'), 
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
	),
	"left_right_pos" => array(
		"splitleft", 
		"topleft", 
		"left", 
		"bottomleft", 
		"splitright", 
		"topright", 
		"right", 
		"bottomright"
	)
);

function getYuiSuffix ($moduleName, $jj_const){
	$myJdoc = new JDocumentHTML();
	$moduleCount = $myJdoc->countModules($moduleName); 
	if(in_array($moduleName, $jj_const['left_right_pos'])){
		$yuiModuleSuffix = $jj_const["yui_suffix"][$moduleCount];
	}else{
		if ($moduleCount == 2) {
			$yuiModuleSuffix = $jj_const["mod_suffix"][$moduleName];
		} else {
			$yuiModuleSuffix = $jj_const["yui_suffix"][$moduleCount];
		}
	}
	echo $yuiModuleSuffix;
}

function sidebar_module($chrome, $position, $jj_const, $modfx, $glob, $nojs){
	global $debug_modules;
	if($glob->countModules($position) > 0){
		if($chrome === 'basic' or $chrome === 'outline' or $chrome === ''){ 
			if ($modfx){ ?>
			<div class="<?php echo $modfx ?>">
		<?php 
			}
		} elseif($chrome === 'grid'){ ?>
			<div id="<?php echo $position; ?>-grid" class="intelli <?php getYuiSuffix($position, $jj_const); ?> <?php echo $chrome; if ($modfx){ echo ' '. $modfx; } ?>">
		<?php } ?>
		<?php if($chrome === 'tabs' or $chrome === 'accordion' ){ ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif($isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo $chrome; } ?>" />
			<?php } else { ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo $chrome; } ?>" />
			<?php } ?>
	<?php 
		if($chrome === 'basic' or $chrome === 'outline' or $chrome === ''){ 
			if ($modfx){ ?>
			</div>
		<?php 
			}
		} elseif($chrome === 'grid'){ ?>
			</div>
		<?php 
		} 
		
	}
}

function codeComments($position, $comment, $location='', $linenumber='', $show_comments) {
	$haslocation = '';
   	$haslinenumber = '';
	if ($location !== '') $haslocation = ' | ' . $location;
	if ($linenumber !== '') $haslinenumber = ' | '.$linenumber;

	if ( $show_comments == '1' ){
	   if ( $position == 's' ) {
	       return "<!-- START: $comment | Located in: $location | Starting on line: $linenumber -->\n"; 
	   } else {
	       return "<!-- END: $comment$haslocation$haslinenumber -->\n";
	   }
	}
}

function getModuleParams($mod_name){
	$db = JFactory::getDBO();
	$query = "select params from jos_modules where module = '".$mod_name."'";
	$db->setQuery( $query ); 
	$params = explode("\n", $db->loadResult());
	$param = array();

	foreach($params as $pm){ $p[] = explode("=", $pm); }
	foreach ($p as $n){
		if(!empty($n[0])){
			$param[$n[0]] = $n[1];
		}
	}
	return $param;
}

function blocks($position, $glob, $jj_const, $classes, $site_width, $debug_modules, $nojs=''){
	
	foreach($classes as $key => $val){
		${$key} = $val;
	}
	
	if($glob->countModules($position) && ${$position.'_show'} == 0 ){
		if ( ${$position.'_wrap'} == 1 ) { ?><div id="<?php echo $position; ?>-wrap"><?php } ?>
			<div id="<?php echo $position; ?>" class="<?php echo $site_width ?> <?php getYuiSuffix($position, $jj_const); ?> clearer modcount<?php echo ${$position . '_count'}.' '.${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }?>">
			<?php if ( ${$position.'_inner'} == 1 ) { ?><div id="<?php echo $position; ?>-inner"><?php } ?>
			<?php if(${$position . '_chrome'} === 'tabs' or ${$position . '_chrome'} === 'accordion' ){ ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif($isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } else { ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } ?>
			<?php if ( ${$position.'_inner'} == 1 ) { ?></div><?php } ?>
			</div>
		<?php if ( ${$position.'_wrap'} == 1 ) { ?></div><?php }
	}
}

?>
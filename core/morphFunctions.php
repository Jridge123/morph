<?php
defined('_JEXEC') or die('Restricted access');
// initiate morph
include('templates'.DS.'morph'.DS.'core'.DS.'morphLoader.php');
include('templates'.DS.'morph'.DS.'core'.DS.'morphParams.php');
require('templates'.DS.'morph'.DS.'core'.DS.'browser.php');

if(isset($_COOKIE['nogzip'])){
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '0'){
		$path = JPATH_CONFIGURATION.DS.'configuration.php';
		JPath::setPermissions($path, '0777');
		if(file_exists($path) && is_writable($path)){			
			$str = file_get_contents($path);
			$line = str_replace('var $gzip = \'1\';', 'var $gzip = \'0\';', $str);
			file_put_contents($path, $line);
		}		
		JPath::setPermissions($path, '0644');
	}
	$gzip_compression = 0;
}
if(isset($_COOKIE['debug_modules'])){ $debug_modules = 1; }
if(isset($_COOKIE['morph_developer_toolbar'])){ $developer_toolbar = 1; }
if(isset($_COOKIE['nojs'])){ $nojs = 1; }

// enable/disable GZIP compression
if ( $gzip_compression == 1 ) {
	// set Joomla's GZIP to on if not set.
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '1'){
		$path = JPATH_CONFIGURATION.DS.'configuration.php';
		JPath::setPermissions($path, '0777');
		if(file_exists($path) && is_writable($path)){			
			$str = file_get_contents($path);
			$line = str_replace('var $gzip = \'0\';', 'var $gzip = \'1\';', $str);
			file_put_contents($path, $line);
		}		
		JPath::setPermissions($path, '0644');
	}
	// enable GZIP if the PHP ZLIB extension is loaded and output_compression is not enabled, else enable output buffering
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}
}
// set the various paths:
$templatepath = JURI::root() . 'templates'.DS.$this->template;
$themeletpath = JURI::root() . 'morph_assets'.DS.'themelets'.DS.$themelet;
$assetspath = JURI::root() . 'morph_assets';
$assetsroot = JPATH_SITE.DS.'morph_assets';
$imagespath = JURI::root() . 'morph_assets'.DS.'themelets'.DS.$themelet.DS.'images'.DS;
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
$css_firefox				= $absolutepath.DS.'css'.DS.'firefox.css';
$css_safari					= $absolutepath.DS.'css'.DS.'safari.css';
$css_opera					= $absolutepath.DS.'css'.DS.'opera.css';
$css_chrome					= $absolutepath.DS.'css'.DS.'chrome.css';
$css_ie					    = $absolutepath.DS.'css'.DS.'ie.css';
$css_ie6				    = $absolutepath.DS.'css'.DS.'ie6.css';
$css_ie7				    = $absolutepath.DS.'css'.DS.'ie7.css';
$css_ie8				    = $absolutepath.DS.'css'.DS.'ie8.css';
$css_browsers				= $absolutepath.DS.'css'.DS.'browsers.css';
$css_yui					= $absolutepath.DS.'css'.DS.'yui.css';
$css_iphone					= $absolutepath.DS.'css'.DS.'iphone.css';
$customcss					= $absolutepath.DS.'css'.DS.'custom.css';
$customjs					= $absolutepath.DS.'js'.DS.'custom.js';
$themeletjs					= $absolutepath.DS.'js'.DS.'themelet.js';
$customfunctions			= $absolutepath.DS.'custom.php';
$themeletfunctions			= $absolutepath.DS.'themelet.php';
$foot_override				= $absolutepath.DS.'html'.DS.'foot.php';
$footer_script				= $absolutepath.DS.'script.php';

if($load_mootools == 0) {
    $headnomootools = $this->getHeadData();
    $headoriginal = $this->getHeadData();
    if($user->get('guest') == 1 or $user->usertype == 'Registered'){
        switch($option){
            default:
            unset($headnomootools['scripts'][$this->baseurl.'/media/system/js/mootools.js']);
    		$this->setHeadData($headnomootools);
            break;
            case 'com_user':
            case 'com_contact':
            case 'com_k2':
            case 'com_myblog':
            case 'com_jevents':
            $this->setHeadData($headoriginal);
            break;
        }
	}
}

$headoriginal = $this->getHeadData();
if (!$user->authorize('com_content', 'edit', 'content', 'all')) {
    unset($headoriginal['scripts'][$this->baseurl.'/media/system/js/caption.js']);
	$this->setHeadData($headoriginal);
}else{
    $this->setHeadData($headoriginal);
}

if ( $remove_generator == 1 ) {
$this->setGenerator(null);
}
function debug_chrome($pt_debug, $pt_mod_chrome){
	if( $pt_debug == 1 ){ 
		return 'outline'; 
	} else { 
		return $pt_mod_chrome; 
	}
}

include 'morphVars.php';

if(file_exists($themeletfunctions) && is_readable($themeletfunctions)){
include_once($absolutepath.DS.'themelet.php');
}
if(file_exists($customfunctions) && is_readable($customfunctions)){
include_once($absolutepath.DS.'custom.php');
}

// gzip compression frontend switch - required for toolbar to work correctly
$curr_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if(isset($_GET['gzip']) && $_GET['gzip'] == 'on'){
	setcookie('nogzip', '', time()-3600);
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '1'){
		$path = JPATH_CONFIGURATION.DS.'configuration.php';
		JPath::setPermissions($path, '0777');
		if(file_exists($path) && is_writable($path)){			
			$str = file_get_contents($path);
			$line = str_replace('var $gzip = \'0\';', 'var $gzip = \'1\';', $str);
			file_put_contents($path, $line);
		}		
		JPath::setPermissions($path, '0644');
	}
	header('Location: ' . str_replace(array('?gzip=on','&gzip=on'), '', $curr_url));
}

// developer toolbar frontend switch
if(isset($_GET['show_devbar'])){
	setcookie('morph_developer_toolbar', 'enabled', 0);
	header('Location: ' . str_replace(array('?show_devbar','&show_devbar'), '', $curr_url));
}
if(isset($_GET['hide_devbar'])){
	setcookie('morph_developer_toolbar', null, time()-3600);
	header('Location: ' . str_replace(array('?hide_devbar','&hide_devbar'), '', $curr_url));
}
if(isset($_GET['nojs']) && $_GET['nojs'] == 'off'){
	setcookie('nojs', null, time()-3600);
	header('Location: ' . str_replace(array('?nojs=off','&nojs=off'), '', $curr_url));
}
if ( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) {
//	$document->addScript($templatepath .'/core/js/jquery.js');	
//	$document->addScript($templatepath .'/core/js/jqtouch.js');
//	$document->addScript($templatepath .'/core/js/iphone.js');
} else {
    if($nojs !== 1) {
    	if ( isset($_COOKIE['unpackjs']) && $pack_js == 1 || isset($_COOKIE['unpackjs']) && $pack_js == 0 || !isset($_COOKIE['unpackjs']) && $pack_js == 0 ) {
    		if( $jquery_core == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/jquery.js');
    		}
    		if( $tabscount >= 1 or $accordionscount >= 1 ) {
    		    $document->addScript($templatepath .'/core/js/ui.js');
    		}
    		if( $tabscount >= 1 ) {
    			$document->addScript($templatepath .'/core/js/tabs.js');
    		}
    		if( $accordionscount >= 1 ) {
    			$document->addScript($templatepath .'/core/js/accordion.js');
    		}
    		if( $tabscount >= 1 or $accordionscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 or $developer_toolbar == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/cookie.js'); 
    		}
    		if( $topfish >= 1 && $topnav_hoverintent == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/hoverintent.js');
    		}
    		if( $sidefish >= 1 or $topfish >= 1  ) { 
    		    $document->addScript($templatepath .'/core/js/superfish.js');
    		}
    		if( $topfish >= 1 && $topnav_supersubs == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/supersubs.js');
    		}
    		if( $rounded_corners == 1 or $roundedcount !== 0 ) { 
    		    $document->addScript($templatepath .'/core/js/corners.js');
    		}
    		if( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  or $topleft_equalize == 1  ) { 
    		    $document->addScript($templatepath .'/core/js/equalheights.js'); 
    		}
    		if( $plugin_scrollto == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/scrollto.js');
    		}
    		if( $simpleticker == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/innerfade.js');
    		}
    		if( $captions_enabled == 1 ) { 
    		    $document->addScript($templatepath .'/core/js/captify.js');
    		}
    		if( $google_analytics !== '' ) { 
    		    $document->addScript($templatepath .'/core/js/googleanalytics.js');
    		}
    		    $document->addScript($templatepath .'/core/js/fontsizer.js');
    		    $document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
    	}else{
    		$document->addScript($templatepath .'/core/js/template.js.php'.$packed_js);
    	}
    
    }else{
    	if(isIE6()){ 
    		$document->addScript($templatepath .'/core/js/ie6.js');
    	}
    }
}

// enable/disble firebug lite
if(isset($_GET['show_firebug'])){
	setcookie('firebug', 'enabled', 0);
	header('Location: ' . str_replace(array('?show_firebug','&show_firebug'), '', $curr_url));
}
if(isset($_GET['hide_firebug'])){
	setcookie('firebug', null, time()-3600);
	header('Location: ' . str_replace(array('?hide_firebug','&hide_firebug'), '', $curr_url));
}

if( $browser->getBrowser() == Browser::PLATFORM_IPHONE && $iphone_mode == 1 ){
	if ( file_exists($css_iphone)) { $document->addStyleSheet($css_iphone); } else { $document->addStyleSheet($templatepath .'/core/css/iphone.css'); }	
//	if ( file_exists($css_iphone)) { $document->addStyleSheet($css_iphone); } else { $document->addStyleSheet($templatepath .'/core/css/jqtouch.css'); }	
} else {
	if ( isset($_COOKIE['unpackcss']) && $pack_css == 1 || isset($_COOKIE['unpackcss']) && $pack_css == 0 || !isset($_COOKIE['unpackcss']) && $pack_css == 0 ) {
		if ( file_exists($css_yui)) { $document->addStyleSheet($css_yui); } else { $document->addStyleSheet($templatepath .'/core/css/yui.css'); }
		if ( $topnav_count >= 1 ) { $document->addStyleSheet($themeletpath .'/css/topnav-default.css'); }
		if ( $topfish >= 1 ) { $document->addStyleSheet($themeletpath .'/css/topnav-topfish.css'); }
		if ( $topdrop >= 1 ) { $document->addStyleSheet($themeletpath .'/css/topnav-topdrop.css'); }
		if ( $sidenav_count >= 1 ) { $document->addStyleSheet($themeletpath .'/css/sidenav-default.css'); }
		if ( $sidefish >= 1 ) { $document->addStyleSheet($themeletpath .'/css/sidenav-sidefish.css'); }
		if ( $tabscount >= 1 ) { $document->addStyleSheet($themeletpath .'/css/tabs.css'); }
		if ( $accordionscount >= 1 ) { $document->addStyleSheet($themeletpath .'/css/accordions.css'); }
		$document->addStyleSheet($themeletpath .'/css/typo.css');
		$document->addStyleSheet($themeletpath .'/css/joomla.css');
		$document->addStyleSheet($themeletpath .'/css/modules.css');
		$document->addStyleSheet($themeletpath .'/css/modfx.css');	
		$document->addStyleSheet($themeletpath .'/css/themelet.css');
		if ( $simpleticker == 1 ) { $document->addStyleSheet($themeletpath .'/css/simpleticker.css'); }
		if ( $simpletweet == 1 ) { $document->addStyleSheet($themeletpath .'/css/simpletweet.css'); }
		if ( $simplecontact == 1 ) { $document->addStyleSheet($themeletpath .'/css/simplecontact.css'); }
		if ( $simplesocial == 1 ) { $document->addStyleSheet($themeletpath .'/css/simplesocial.css'); }
		$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);
		if($developer_toolbar == 1) { $document->addStyleSheet($templatepath .'/core/css/devbar.css'); }
		if ( $direction == 'rtl' && file_exists($css_rtl)){ $document->addStyleSheet($css_rtl); } elseif ($direction == 'rtl') { $document->addStyleSheet($themeletpath .'/core/css/rtl.css'); }
		if ( file_exists($customcss)) { $document->addStyleSheet($themeletpath .'/css/custom.css'); }
		// core browser specific
		$document->addStyleSheet($templatepath .'/core/css/browsers.css');
		if(preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) $document->addStyleSheet($templatepath .'/core/css/ie6.css');
		// themelet browser specific
		if (file_exists($css_browsers)) $document->addStyleSheet($themeletpath .'/css/browsers.css');
		if ($lcbrowser == 'firefox' && file_exists($css_firefox)) $document->addStyleSheet($themeletpath .'/css/firefox.css'); 
		if ($lcbrowser == 'safari' && file_exists($css_safari)) $document->addStyleSheet($themeletpath .'/css/safari.css');
		if ($lcbrowser == 'opera' && file_exists($css_opera)) $document->addStyleSheet($themeletpath .'/css/opera.css');
		if ($lcbrowser == 'chrome' && file_exists($css_chrome)) $document->addStyleSheet($themeletpath .'/css/chrome.css');
		if ($lcbrowser == 'internetexplorer' && file_exists($css_ie)) $document->addStyleSheet($themeletpath .'/css/ie.css');
		// ie specific
		if(file_exists($css_ie6) && preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) $document->addStyleSheet($themeletpath .'/css/ie6.css');
		if(file_exists($css_ie7) && preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT'])) $document->addStyleSheet($themeletpath .'/css/ie7.css');
		if(file_exists($css_ie8) && preg_match('/MSIE 8/i', $_SERVER['HTTP_USER_AGENT'])) $document->addStyleSheet($themeletpath .'/css/ie8.css');
	} else {
		$document->addStyleSheet($templatepath .'/core/css/template.css.php'.$packed_css);
	}
}

function isIE6($string=''){
	$user_agent = $string;
	if($string == '') $user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/MSIE 6/i', $user_agent)){
		return true;
	} else {
		return false;
	}
}

// get layout functions
include_once('InnerLayout.php');
include_once('OuterLayout.php');

if (!JDocumentHTML::countModules('splitleft or topleft or left or bottomleft')) $CurrentOuterScheme = '';
if (!JDocumentHTML::countModules('splitright or topright or right or bottomright')) $CurrentInnerScheme = '';
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

function sidebar_module($chrome, $position, $jj_const, $modfx, $glob, $debug_modules, $nojs){
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
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo $chrome; } ?>" />
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

function codeComments($position, $comment, $location='', $linenumber='', $show_comments, $relatedcss='') {
	$haslocation = '';
   	$haslinenumber = '';
   	$hasrelatedcss = '';

	if ($location !== '') $haslocation = ' | ' . $location;
	if ($linenumber !== '') $haslinenumber = ' | '.$linenumber;
	if ($relatedcss !== '') $hasrelatedcss = ' | '.$relatedcss;

	if ( $show_comments == 1 ){
	   if ( $position == 's' ) {
	       return "<!-- START: $comment | Located in: $location | Starting on line: $linenumber | Related css files: $relatedcss -->\n"; 
	   } else {
	       return "<!-- END: $comment$haslocation$haslinenumber$hasrelatedcss -->\n";
	   }
	}
}

function getModuleParams($mod_name){
	$db = JFactory::getDBO();
	$query = "select params from #__modules where module = '".$mod_name."'";
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
	$position_class = str_replace(array(1,2,3,4,5,6,7,8,9,10), '', $position);
	
	if($glob->countModules($position) && ${$position.'_show'} == 0 ){
		if ( ${$position.'_wrap'} == 1 ) { ?><div id="<?php echo $position; ?>-wrap"><?php } ?>
			<?php if ( ${$position.'_chrome'} == 'grid' ) { ?>
			<div id="<?php echo $position; ?>" class="<?php echo $position_class; ?> <?php echo $site_width ?> <?php getYuiSuffix($position, $jj_const); ?> clearer modcount<?php echo ${$position . '_count'}.' '.${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }?>">
			<?php } else { ?>	
			<div id="<?php echo $position; ?>" class="<?php echo $position_class; ?> <?php echo $site_width ?> clearer modcount<?php echo ${$position . '_count'}.' '.${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }?>">
			<?php } ?>
			<?php if ( ${$position.'_inner'} == 1 ) { ?><div id="<?php echo $position; ?>-inner" class="clearer"><?php } ?>
			<?php if(${$position . '_chrome'} === 'tabs' or ${$position . '_chrome'} === 'accordion' ){ ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } else { ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } ?>
			<?php if ( ${$position.'_inner'} == 1 ) { ?></div><?php } ?>
			</div>
		<?php if ( ${$position.'_wrap'} == 1 ) { ?></div><?php }
	}
}

function pt_body_classes($menu, $view, $themelet){
	$classes = 'class="';
	$ids = '';  
	$devbar = '';
	$pageclass = '';
	$view = $menu->query['view'];
	$component = $menu->query['option'];
	
	$browser = new Browser();
	$platform = ' '.strtolower($browser->getPlatform());
	$thebrowser = ' '.strtolower(ereg_replace("[^A-Za-z]", "", $browser->getBrowser()));
	$ver = $browser->getVersion();
	$ver = str_replace('.', '', $ver);
	
	$params = new JParameter($menu->params);
	$pageclass = $params->get('pageclass_sfx');
	
	if(isset($_COOKIE['morph_developer_toolbar'])){ $devbar = ' devbar'; }
	if($pageclass !== ''){ $pageclass = ' '.$pageclass; }
	if($view !== ''){ $view = ' '.$view; }
	if($component !== ''){ $component = ' '.$component; }
	if($themelet !== ''){ $ids = ' id="'.$themelet.'"'; }
	
	
	$classes .= 'js-disabled morph'.$thebrowser.$thebrowser.$ver.$platform.$pageclass.$view.$component.$devbar.'"';
	
	return $classes.' '.$ids ;
}

function pt_classes($classes, $sitewidth=''){
	$c = '';
	if($sitewidth !== ''){ $c .= $sitewidth.' clearer '; }
	
	if(is_array($classes)){
		foreach($classes as $classname => $p){
			switch($classname){
				
				case 'subtext_top':
				if($p >= 1){ $c .= 'subtext'; }else{ $c .= 'no-subtext'; }
				break;
				case 'topnav_actionlink':
				if($p >= 1){ $c .= ' call-for-action'; }
				break;
				case 'topfish':
				if($p >= 1){ $c .= ' topfish'; }
				break;
				case 'topdrop':
				if($p >= 1){ $c .= ' topdrop'; }
				break;
			}
		}
	}
	
	return $c;
}

?>
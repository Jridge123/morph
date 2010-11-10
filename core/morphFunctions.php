<?php defined( '_JEXEC' ) or die( 'Restricted access' );
// initiate morph
require_once JPATH_ROOT . '/templates/morph/core/morphLoader.php';
$MORPH = Morph::getInstance();
//require_once('templates/morph/core/phphooks.class.php');
require_once('templates/morph/core/morphParams.php');
require_once('templates/morph/core/browser.php');

//create instance of class
//$hook = new morphhooks();
//function do_action($tag, $args) {
//	global $hook;
//	$hook->execute_hook ($tag, $args);
//}

//function add_action($tag, $function, $priority = 10) {
//	global $hook;
//	$hook->add_hook ( $tag, $function, $priority );
//}

//function has_action($tag) {
//	global $hook;
//	if ($hook->hook_exist ($tag)) {
//		return true;
//	} else {
//		return false;
//	}
//}
//$hook->add_hook ('a_hook');
//echo '<pre>';
//print_r($hook);
//echo '</pre>';

if(isset($_COOKIE['nogzip'])){
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '0'){
		$path = JPATH_CONFIGURATION.'/configuration.php';
		if(JFile::exists($path)) {
			JPath::setPermissions($path, '0644');
			$search  = JFile::read($path);
			$replace = str_replace('var $gzip = \'1\';', 'var $gzip = \'0\';', $search);
			JFile::write($path, $replace);
			JPath::setPermissions($path, '0444');
		}
	}
	$gzip_compression = 0;
}
if(isset($_COOKIE['debug_modules']) && $_COOKIE['debug_modules'] == 'true'){ $debug_modules = 1; }elseif(isset($_COOKIE['debug_modules']) && $_COOKIE['debug_modules'] == 'false'){ $debug_modules = 0; }else{ $debug_modules = $debug_modules; }
//if(isset($_COOKIE['morph_developer_toolbar'])){ $MORPH->developer_toolbar = 1; }
if(isset($_COOKIE['nojs'])){ $nojs = 1; }

$document = JFactory::getDocument();

// enable/disable GZIP compression
if ( $gzip_compression == 1 ) {
	// set Joomla's GZIP to on if not set.
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '1'){
		$path = JPATH_CONFIGURATION.'/configuration.php';
		if(JFile::exists($path)) {
			JPath::setPermissions($path, '0644');
			$search  = JFile::read($path);
			$replace = str_replace('var $gzip = \'0\';', 'var $gzip = \'1\';', $search);
			JFile::write($path, $replace);
			JPath::setPermissions($path, '0444');
		}
	}
}
// set the various paths:
// @TODO drop this later
$templatepath = JURI::root(1) . '/templates/morph';
// new path
$templatepath = '/templates/morph';

// @TODO drop this later
$themeletpath = JURI::root(1) . '/morph_assets/themelets/'.$themelet;
// new path
$themeletpath = '/morph_assets/themelets/'.$themelet;
$assetspath = JURI::root() . 'morph_assets';
$assetsroot = JPATH_SITE.'/morph_assets';
$imagespath = JURI::root() . 'morph_assets/themelets/'.$themelet.'/images/';
$absolutepath = JPATH_SITE.'/morph_assets/themelets/'.$themelet;
$includespath = JPATH_SITE.'/templates/morph/core/includes/';
$blockclassespath = JPATH_SITE.'/templates/morph/core/morphBlockClasses.php';

// set the document parameters with what morph found:
$params	= new JParameter(null);
$params->loadObject($MORPH);
$document->params = $params;
$document 					= Jfactory::getDocument();  
$menus      				= JSite::getMenu();
$user 						= JFactory::getUser();
$menu      					= $menus->getActive();
$option 					= JRequest::getCmd('option');
$task 						= JRequest::getCmd('task');
$view 						= JRequest::getCmd('view');
$layout 					= JRequest::getCmd('layout');
$page 						= JRequest::getCmd('page');
$secid 						= JRequest::getCmd('secid');
$catid 						= JRequest::getCmd('catid');
$itemid 					= JRequest::getCmd('Itemid');
$pageclass   				= "";
$cache						= $MORPH->cache ? '&cache='.$MORPH->cachetime : false;
$gzip						= $MORPH->gzip_compression ? '&gzip='.$MORPH->gzip_compression : false;
if (is_object( $menu )) :
$params 					= new JParameter( $menu->params );
$pageclass 					= $params->get( 'pageclass_sfx' );
endif;
$toolbar_count 				= $MORPH->countModules('toolbar');
$masthead_count 			= $MORPH->countModules('masthead');
$subhead_count 				= $MORPH->countModules('subhead');
$topnav_count 				= $MORPH->countModules('topnav');
$topshelf1_count 			= $MORPH->countModules('topshelf1');
$topshelf2_count 			= $MORPH->countModules('topshelf2');
$topshelf3_count 			= $MORPH->countModules('topshelf3');
$bottomshelf1_count			= $MORPH->countModules('bottomshelf1');
$bottomshelf2_count 		= $MORPH->countModules('bottomshelf2');
$bottomshelf3_count 		= $MORPH->countModules('bottomshelf3');
$user1_count 				= $MORPH->countModules('user1');
$user2_count 				= $MORPH->countModules('user2');
$inset1_count 				= $MORPH->countModules('inset1');
$inset2_count 				= $MORPH->countModules('inset2');
$inset3_count 				= $MORPH->countModules('inset3');
$inset4_count 				= $MORPH->countModules('inset4');
$outersplit_count 			= $MORPH->countModules('outersplit');
$outer1_count 				= $MORPH->countModules('outer1');
$outer2_count 				= $MORPH->countModules('outer2');
$outer3_count 			    = $MORPH->countModules('outer3');
$outer4_count 				= $MORPH->countModules('outer4');
$outer5_count 			    = $MORPH->countModules('outer5');
$innersplit_count 			= $MORPH->countModules('innersplit');
$inner1_count 				= $MORPH->countModules('inner1');
$inner2_count 				= $MORPH->countModules('inner2');
$inner3_count 			    = $MORPH->countModules('inner3');
$inner4_count 				= $MORPH->countModules('inner4');
$inner5_count 			    = $MORPH->countModules('inner5');
$footer_count 				= $MORPH->countModules('footer');
$stylelink 					= '';
$direction  				= $document->direction;
$browser 					= new MBrowser();
$thebrowser 				= preg_replace("/[^A-Za-z]/i", "", $browser->getBrowser());
$ver 						= $browser->getVersion();
$dots 						= ".";
$dashes 					= "";
$mod_chrome					= "";
$ver 						= str_replace($dots , $dashes , $ver);
$lcbrowser 					= strtolower($thebrowser);
$css_firefox				= $absolutepath.'/css/firefox.css';
$css_safari					= $absolutepath.'/css/safari.css';
$css_opera					= $absolutepath.'/css/opera.css';
$css_chrome					= $absolutepath.'/css/chrome.css';
$css_webkit				    = $absolutepath.'/css/webkit.css';
$css_ie					    = $absolutepath.'/css/ie.css';
$css_ie6				    = $absolutepath.'/css/ie6.css';
$css_ie7				    = $absolutepath.'/css/ie7.css';
$css_ie8				    = $absolutepath.'/css/ie8.css';
$css_browsers				= $absolutepath.'/css/browsers.css';
$css_yui					= $absolutepath.'/css/yui.css';
$css_rtl					= $absolutepath.'/css/rtl.css';
$css_iphone					= $absolutepath.'/css/iphone.css';
$css_ipod					= $absolutepath.'/css/ipod.css';
$css_ipad					= $absolutepath.'/css/ipad.css';
$css_blackberry				= $absolutepath.'/css/blackberry.css';
$css_android				= $absolutepath.'/css/android.css';
$customcss					= $absolutepath.'/css/custom.css.php';
$customjs					= $absolutepath.'/js/custom.js.php';
$custom_css_file    		= $absolutepath.'/css/custom.css';
$custom_js_file				= $absolutepath.'/js/custom.js';
$themeletjs					= $absolutepath.'/js/themelet.js';
$customfunctions			= $absolutepath.'/custom.php';
$themeletfunctions			= $absolutepath.'/themelet.php';
$foot_override				= $absolutepath.'/html/foot.php';
$footer_script				= $absolutepath.'/script.php';

// Overriding includes via the themelet:
$inc_bottomshelf1			= $absolutepath.'/includes/bottomshelf1.php';
$inc_bottomshelf2			= $absolutepath.'/includes/bottomshelf2.php';
$inc_bottomshelf3			= $absolutepath.'/includes/bottomshelf3.php';
$inc_footer					= $absolutepath.'/includes/foot.php';
$inc_iphone					= $absolutepath.'/includes/iphone.php';
$inc_logo					= $absolutepath.'/includes/logo.php';
$inc_main					= $absolutepath.'/includes/main.php';
$inc_masthead				= $absolutepath.'/includes/masthead.php';
$inc_secondary				= $absolutepath.'/includes/secondary.php';
$inc_skiptop				= $absolutepath.'/includes/skipto.php';
$inc_subhead				= $absolutepath.'/includes/subhead.php';
$inc_tertiary				= $absolutepath.'/includes/tertiary.php';
$inc_toolbar				= $absolutepath.'/includes/toolbar.php';
$inc_topnav					= $absolutepath.'/includes/topnav.php';
$inc_topshelf1				= $absolutepath.'/includes/topshelf1.php';
$inc_topshelf2				= $absolutepath.'/includes/topshelf2.php';
$inc_topshelf3				= $absolutepath.'/includes/topshelf3.php';
$inc_user1					= $absolutepath.'/includes/user1.php';
$inc_user2					= $absolutepath.'/includes/user2.php';

$moo = JFactory::getConfig()->getValue('debug') ? '-uncompressed.js' : '.js';
$mtu = JURI::base(true).'/plugins/system/mtupgrade/mootools'.$moo;
$moo = JURI::base(true).'/media/system/js/mootools'.$moo;
$option = JRequest::getCmd('option');
$load_com_mootools = $load_mootools;
if(property_exists($MORPH, 'load_mootools_'.$option)) $load_com_mootools = $MORPH->{'load_mootools_'.$option};

if($load_mootools == 0 && $load_com_mootools == 0)
{
    if($user->get('guest') == 1 or $user->usertype == 'Registered')
    {
    	$moolist = array(
			'com_user',
			'com_contact',
			'com_myblog',
			'com_jevents'
		);
    	if(!in_array($option, $moolist))
    	{
    		if (isset($document->_scripts[$moo])) {
    		    unset($document->_scripts[$moo]);
    		}
    		if (isset($document->_scripts[$mtu])) {
    		    unset($document->_scripts[$mtu]);
    		}
    	}
	}
}
if (isset($document->_scripts[$moo])) {
    unset($document->_scripts[$moo]);
    $MORPH->addScript(str_replace(JURI::base(true), '', $moo));
}
if (isset($document->_scripts[$mtu])) {
    unset($document->_scripts[$mtu]);
    $MORPH->addScript(str_replace(JURI::base(true), '', $mtu));
}

if ( $remove_generator == 1 ) {
$document->setGenerator(null);
}
function debug_chrome($pt_debug, $pt_mod_chrome){
	if( $pt_debug == 1 ){ 
		return 'outline'; 
	} else { 
		return $pt_mod_chrome; 
	}
}

if ( $remove_outline == 1 ) {
JRequest::setVar('tp',0);
}

include 'morphVars.php';

// gzip compression frontend switch - required for toolbar to work correctly
$curr_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if(isset($_GET['gzip']) && $_GET['gzip'] == 'on'){
	setcookie('nogzip', '', time()-3600);
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '1'){
		$path = JPATH_CONFIGURATION.'/configuration.php';
		if(JFile::exists($path)) {
			JPath::setPermissions($path, '0644');
			$search  = JFile::read($path);
			$replace = str_replace('var $gzip = \'0\';', 'var $gzip = \'1\';', $search);
			JFile::write($path, $replace);
			JPath::setPermissions($path, '0444');
		}
	}
}

// developer toolbar frontend switch
if($MORPH->debug || $MORPH->developer_toolbar)
{
	$uri = JFactory::getURI();
	if(isset($_GET['show_devbar'])||isset($_GET['showdev'])){
		$_GET['morph']['developer_toolbar'] = true;
		$uri->delVar('show_devbar');
		$uri->delVar('showdev');
		setcookie('morph_developer_toolbar', 'enabled', 0);
		$MORPH->addStyleSheetAfter($templatepath .'/core/css/devbar.css');
		
		jimport('joomla.filesystem.folder');
		
		$path = JPATH_CACHE.'/morph';
		if(JFolder::exists($path)) JFolder::delete($path);
		
		$MORPH->updateJDocument();
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['hide_devbar'])||isset($_GET['hidedev'])){
		$uri->delVar('hide_devbar');
		$uri->delVar('hidedev');
		$_GET['morph']['developer_toolbar'] = false;
		
		jimport('joomla.filesystem.folder');
		
		$path = JPATH_CACHE.'/morph';
		if(JFolder::exists($path)) JFolder::delete($path);
	
		$MORPH->updateJDocument();
		setcookie('morph_developer_toolbar', '', time()-3600);
		setcookie('debug_modules', null, time()-3600);
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['json'])){
		$_GET['morph']['nojs'] = 0;
		$MORPH->nojs = 0;
		$uri->delVar('json');
		setcookie('nojs', null, time()-3600);
		$MORPH->cache();
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['jsoff'])){
		$_GET['morph']['nojs'] = 1;
		$MORPH->nojs = 1;
		$uri->delVar('jsoff');
		setcookie('nojs', 'enabled', time()-3600);
		$MORPH->cache();
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['unpack_js'])||isset($_GET['unpackjs'])){
		$MORPH->pack_js = false;
		$uri->delVar('unpack_js');
		$uri->delVar('unpackjs');
		$_GET['morph']['pack_js'] = false;
		
		$MORPH->cache();
		//setcookie('packjs', 'unpack', 0);
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['pack_js'])||isset($_GET['packjs'])){
		$MORPH->pack_js = true;
		$uri->delVar('pack_js');
		$uri->delVar('packjs');
		$_GET['morph']['pack_js'] = true;
		
		$MORPH->cache();
		//setcookie('packjs', null, time()-3600);
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['unpack_css'])||isset($_GET['unpackcss'])){
		$MORPH->pack_css = false;
		$uri->delVar('unpack_css');
		$uri->delVar('unpackcss');
		$_GET['morph']['pack_css'] = false;
		
		$MORPH->cache();
		//setcookie('packcss', 'unpack', 0);
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['pack_css'])||isset($_GET['packcss'])){
		$MORPH->pack_css = true;
		$uri->delVar('pack_css');
		$uri->delVar('packcss');
		$_GET['morph']['pack_css'] = true;
		
		$MORPH->cache();
		//setcookie('packcss', null, time()-3600);
		//header('Location: ' . $uri->toString());
	}
	if(isset($_GET['jqueryoff'])){
		$MORPH->jquery_core = false;
		$uri->delVar('jqueryoff');
		$_GET['morph']['jquery_core'] = false;
		
		$MORPH->cache();
	}
	if(isset($_GET['jqueryon'])){
		$MORPH->jquery_core = true;
		$uri->delVar('jqueryon');
		$_GET['morph']['jquery_core'] = true;
		
		$MORPH->cache();
	}
	if(isset($_GET['mootoolsoff'])){
		$MORPH->load_mootools = false;
		$uri->delVar('mootoolsoff');
		$_GET['morph']['load_mootools'] = false;
		
		$MORPH->cache();
	}
	if(isset($_GET['mootoolson'])){
		$MORPH->jquery_core = true;
		$uri->delVar('mootoolson');
		$_GET['morph']['load_mootools'] = true;
		
		$MORPH->cache();
	}
	if(isset($_GET['flushcache'])){
		$uri->delVar('flushcache');
		//This is to make morph do the redirect
		$_GET['morph']['void'] = null;
		
		jimport('joomla.filesystem.folder');
		
		$path = JPATH_CACHE.'/morph';
		if(JFolder::exists($path)) JFolder::delete($path);
		
		$MORPH->cache();
	}
} else {
	$used = array();
	$vars = array('show_devbar','showdev','hide_devbar','hidedev','json','jsoff','unpack_js','unpackjs','pack_js','packjs','unpack_css','unpackcss','pack_css','packcss','jqueryoff','jqueryon','mootoolsoff','mootoolson','flushcache');
	foreach($vars as $var)
	{
		if(!isset($_GET[$var])) continue;
		$used[] = $var;
	}
	 
	if($used) JError::raiseNotice(0, '
	You are trying to use Morph\'s url switches, but you have not enabled the debug mode option in Configurator.
	You can do so by setting the "<strong>Enable debug mode</strong>" option in the <em>General > Debugging</em> tab of Configurator.');
}

// include the reusable arrays
include 'morphArrays.php';

$isiPhone		= $browser->getBrowser() == MBrowser::PLATFORM_IPHONE && $iphone_mode == 1;
$isiPad			= $browser->getBrowser() == MBrowser::PLATFORM_IPAD;
$isiPod			= $browser->getBrowser() == MBrowser::PLATFORM_IPOD;
$isBlackberry	= $browser->getBrowser() == MBrowser::PLATFORM_BLACKBERRY;
$isAndroid		= $browser->getBrowser() == MBrowser::PLATFORM_ANDROID;
$iPhoneCookie	= isset($_COOKIE['iPhone']) ? $_COOKIE['iPhone'] == 'normal' : false;
$isComWP		= (bool)JComponentHelper::isEnabled('com_wordpress', true);
$isModUtilWP	= JModuleHelper::isEnabled('wordpress_utility');
$isModWidgWP	= JModuleHelper::isEnabled('wordpress_widgetmod');
$isModFlickr	= JModuleHelper::isEnabled('simpleflickr');

if ( $isiPhone && !$iPhoneCookie ) {
//	$document->addScript($templatepath .'/core/js/jquery.js');	
//	$document->addScript($templatepath .'/core/js/jqtouch.js');
//	$document->addScript($templatepath .'/core/js/iphone.js');
} else {
    if(!$MORPH->nojs) {
    	//if (!$pack_js) {
    		if(in_array(1, $js_jquery)) { $MORPH->addScript($templatepath .'/core/js/jquery.js'); }
    		if(in_array(1, $js_jqueryui)) { $MORPH->addScript($templatepath .'/core/js/ui.js'); }
    		if (isset($document->_scripts[JURI::base(true).'/media/system/js/caption.js'])) {
    		    unset($document->_scripts[JURI::base(true).'/media/system/js/caption.js']);
    		    if(!$MORPH->captions_enabled) $MORPH->addScript($templatepath.'/core/js/caption.js');
    		}
    		if(in_array(1, $js_cookie)) { $MORPH->addScript($templatepath .'/core/js/cookie.js'); }
    		if(in_array(1, $js_equalize)) { $MORPH->addScript($templatepath .'/core/js/equalheights.js');}
    		if(in_array(1, $js_slider)) { $MORPH->addScript($templatepath .'/core/js/slider.js');}
    		if( $tabscount >= 1 ) { $MORPH->addScript($templatepath .'/core/js/tabs.js'); }
    		if( $accordionscount >= 1 ) { $MORPH->addScript($templatepath .'/core/js/accordion.js'); }
    		if( $topfish >= 1 && $topnav_hoverintent == 1 ) { $MORPH->addScript($templatepath .'/core/js/hoverintent.js'); }
    		if( $sidefish >= 1 or $topfish >= 1 or $topdrop >= 1  ) { $MORPH->addScript($templatepath .'/core/js/superfish.js'); }
    		if( $topfish >= 1 && $topnav_supersubs == 1 ) { $MORPH->addScript($templatepath .'/core/js/supersubs.js'); }
    		if( $plugin_scrollto == 1 ) { $MORPH->addScript($templatepath .'/core/js/scrollto.js'); }
    		if( $simpleticker == 1 ) { $MORPH->addScript($templatepath .'/core/js/innerfade.js');}
    		if( $simpletweet == 1 ) { $MORPH->addScript('/modules/mod_simpletweet/js/simpletweet.js'); }
    		if( $google_analytics !== '' ) { $MORPH->addScript($templatepath .'/core/js/googleanalytics.js');}
    		if( $lazyload_enabled == 1 ) { $MORPH->addScript($templatepath .'/core/js/lazyload.js'); }
    		if( $captions_enabled == 1 ) { $MORPH->addScript($templatepath .'/core/js/captify.js'); }
    		if( $lightbox_enabled == 1 ) { $MORPH->addScript($templatepath .'/core/js/colorbox.js');}
    		if( $fontsizer_enabled == 1 ) { $MORPH->addScript($templatepath .'/core/js/fontsizer.js');}
    		if( $preloader_enabled == 1 ) { $MORPH->addScript($templatepath .'/core/js/preloader.js');}
    		if( $modernizr == 1 ) { $MORPH->addScript($templatepath .'/core/js/modernizr.js');}    		
    		if(file_exists(JPATH_ROOT.$themeletpath .'/js/themelet.js')) $MORPH->addScriptAfter($themeletpath .'/js/themelet.js');
    		if(file_exists(JPATH_ROOT.$themeletpath .'/js/custom.js')) $MORPH->addScriptAfter($themeletpath .'/js/custom.js');
    		
			if($isModUtilWP || $isComWP){
				$wp_images_js = '/images/wordpress/themes/morph/js/images.js';
				$wp_theme_js = '/images/wordpress/themes/morph/js/theme.js';
				$wp_jqtools_js = '/images/wordpress/themes/morph/js/jquery-tools.js';
				if(file_exists(JPATH_ROOT.$wp_jqtools_js)) $MORPH->addScriptAfter($wp_jqtools_js);
				if(file_exists(JPATH_ROOT.$wp_images_js)) $MORPH->addScriptAfter($wp_images_js);
				// only load if its the wordpress component/wptheme
				if(JRequest::getVar('option') == 'com_wordpress'){ 
					if(file_exists(JPATH_ROOT.$wp_theme_js)) $MORPH->addScriptAfter($wp_theme_js); 
				}
			}
    }else{
    	if(isIE6()){ 
    		$MORPH->addScript($templatepath .'/core/js/ie6.js');
    	}
    }
}

// Facile Forms / Breezing Forms fix
if(isset($document->_scripts[$breeze = JURI::root(1).'/components/com_breezingforms/libraries/jquery/jquery.min.js'])) unset($document->_scripts[$breeze]);

if(isset($document->_scripts[JURI::root().'components/com_k2/js/k2.js'])){
	unset($document->_scripts[JURI::root().'components/com_k2/js/k2.js']);
	if(isset($document->_scripts[JURI::base(true).'/media/system/js/modal.js'])) unset($document->_scripts[JURI::base(true).'/media/system/js/modal.js']);
	if(isset($document->_styleSheets[JURI::base(true).'/media/system/css/modal.css'])) unset($document->_styleSheets[JURI::base(true).'/media/system/css/modal.css']);
	if(isset($document->_scripts[JURI::base(true).'/media/system/js/mootools.js'])) unset($document->_scripts[JURI::base(true).'/media/system/js/mootools.js']);
	$MORPH->addScript($templatepath .'/core/js/k2.js');
	$MORPH->addScript($templatepath .'/core/js/colorbox.js');
	$MORPH->addStyleSheet($templatepath .'/core/css/colorbox.css');
	$document->_script['text/javascript'] = str_replace("\n\t\twindow.addEvent('domready', function() {\n\n\t\t\tSqueezeBox.initialize({});\n\n\t\t\t$$('a.modal').each(function(el) {\n\t\t\t\tel.addEvent('click', function(e) {\n\t\t\t\t\tnew Event(e).stop();\n\t\t\t\t\tSqueezeBox.fromElement(el);\n\t\t\t\t});\n\t\t\t});\n\t\t});", '(function($){$(document).ready(function(){$(\'a.modal\').colorbox({width:\'80%\', height:\'80%\', iframe:true});});})(jQuery);', $document->_script['text/javascript']);

	if(isset($document->_styleSheets[JURI::root().'components/com_k2/css/k2.css'])) unset($document->_styleSheets[JURI::root().'components/com_k2/css/k2.css']);
	$MORPH->addStyleSheet($templatepath .'/core/css/k2.css');
}

if(file_exists($themeletfunctions) && is_readable($themeletfunctions)){
	include_once($absolutepath.'/themelet.php');
}
if(file_exists($customfunctions) && is_readable($customfunctions)){
	include_once($absolutepath.'/custom.php');
}

// Firebug lite
if(isset($_GET['show_firebug'])){
	setcookie('firebug', 'enabled', 0);
	header('Location: ' . str_replace(array('?show_firebug','&show_firebug'), '', $curr_url));
}
if(isset($_GET['hide_firebug'])){
	setcookie('firebug', null, time()-3600);
	header('Location: ' . str_replace(array('?hide_firebug','&hide_firebug'), '', $curr_url));
}

// Activate rtl for testing
// $direction = 'rtl';
if(  $isiPhone && !$iPhoneCookie  ){
	if ( file_exists($css_iphone)) { $MORPH->addStyleSheet($themeletpath .'/css/iphone.css'); } else { $MORPH->addStyleSheet($templatepath .'/core/css/iphone.css'); }
	
	$MORPH->updateJDocument();
//	if ( file_exists($css_iphone)) { $document->addStyleSheet($css_iphone); } else { $document->addStyleSheet($templatepath .'/core/css/jqtouch.css'); }	
} else {
	//if (!$pack_css) {
		if ( file_exists($css_yui)) { $MORPH->addStyleSheet($themeletpath .'/css/yui.css'); } else { $MORPH->addStyleSheet($templatepath .'/core/css/yui.css'); }
		if ( $topnav_count >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/topnav-default.css'); }
		if ( $topfish >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/topnav-topfish.css'); }
		if ( $topdrop >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/topnav-topdrop.css'); }
		if ( $sidenav_count >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/sidenav-default.css'); }
		if ( $sidefish >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/sidenav-sidefish.css'); }
		if ( $tabscount >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/tabs.css'); }
		if ( $accordionscount >= 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/accordions.css'); }
		$MORPH->addStyleSheet($themeletpath .'/css/typo.css');
		$MORPH->addStyleSheet($themeletpath .'/css/joomla.css');
		$MORPH->addStyleSheet($themeletpath .'/css/modules.css');
		$MORPH->addStyleSheet($themeletpath .'/css/themelet.css');
		$MORPH->addStyleSheet($themeletpath .'/css/modfx.css');	
		if ( $simpleticker == 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/simpleticker.css'); }
		if ( $simpletweet == 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/simpletweet.css'); }
		if ( $simplecontact == 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/simplecontact.css'); }
		if ( $simplesocial == 1 ) { $MORPH->addStyleSheet($themeletpath .'/css/simplesocial.css'); }
		if ( $googlefonts == 1 ) { $doc->addStyleSheet('http://fonts.googleapis.com/css?family='.str_replace(" ", "+", $heading_font)); }
		
		// add css for simple flickr module
		$morphflickr_css = $themeletpath .'/css/simpleflickr.css';
		$defaultflickr_css = '/modules/mod_simpleflickr/css/simpleflickr.css';
		if(file_exists(JPATH_ROOT.$morphflickr_css)) {$MORPH->addStylesheet($morphflickr_css);}
		else if ($isModFlickr) {$MORPH->addStylesheet($defaultflickr_css);}
		if( $lightbox_enabled == 1 ) { $MORPH->addStyleSheet($templatepath .'/core/css/colorbox_'. $colorbox_style .'.css'); }
		// add CSS to Morph for WP for Joomla
		// first if there is no wordpress component loading we still need the supporting files if the module is being used
		if($isModUtilWP || $isModWidgWP || $isComWP){
			$wp_images_css = '/images/wordpress/themes/morph/css/images.css';
			$wp_theme_css = '/images/wordpress/themes/morph/css/theme.css';
			$wp_modules_css = '/images/wordpress/themes/morph/css/modules.css';
			$wp_widgets_css = '/images/wordpress/themes/morph/css/widgets.css';
			
			// load if module or wordpress component
			if(file_exists(JPATH_ROOT.$wp_images_css)) $MORPH->addStylesheet($wp_images_css); 
			// load if module is loaded
			if($isModUtilWP && file_exists(JPATH_ROOT.$wp_modules_css)) $MORPH->addStylesheet($wp_modules_css);
			// load if widget module is used
			if($isModWidgWP && file_exists(JPATH_ROOT.$wp_widgets_css)) $MORPH->addStylesheet($wp_widgets_css);
			// only load if its the wordpress component/wptheme
			if(JRequest::getVar('option') == 'com_wordpress' && file_exists(JPATH_ROOT.$wp_theme_css)) $MORPH->addStylesheet($wp_theme_css); 
		}
				
		if($MORPH->developer_toolbar == 1) { $MORPH->addStyleSheetAfter($templatepath .'/core/css/devbar.css'); }
		if ( $direction == 'rtl' && file_exists($css_rtl)){ $MORPH->addStyleSheetAfter($themeletpath .'/css/rtl.css'); } elseif ($direction == 'rtl') { $MORPH->addStyleSheetAfter($templatepath .'/core/css/rtl.css'); }
		if ( file_exists($custom_css_file)){ $MORPH->addStyleSheetAfter($themeletpath .'/css/custom.css'); }
		// core browser specific
		$MORPH->addStyleSheetAfter($templatepath .'/core/css/browsers.css');
		if(preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) $MORPH->addStyleSheetAfter($templatepath .'/core/css/ie6.css');
		// themelet browser specific
		if (file_exists($css_browsers)) $MORPH->addStyleSheetAfter($themeletpath .'/css/browsers.css');
		if ($lcbrowser == 'firefox' && file_exists($css_firefox)) $MORPH->addStyleSheetAfter($themeletpath .'/css/firefox.css'); 
		if ($lcbrowser == 'safari' && file_exists($css_safari)) $MORPH->addStyleSheetAfter($themeletpath .'/css/safari.css');
		if ($lcbrowser == 'opera' && file_exists($css_opera)) $MORPH->addStyleSheetAfter($themeletpath .'/css/opera.css');
		if ($lcbrowser == 'chrome' && file_exists($css_chrome)) $MORPH->addStyleSheetAfter($themeletpath .'/css/chrome.css');
		if (($lcbrowser == 'chrome' || $lcbrowser == 'safari') && file_exists($css_webkit)) $MORPH->addStyleSheetAfter($themeletpath .'/css/webkit.css');
		if ($lcbrowser == 'internetexplorer' && file_exists($css_ie)) $MORPH->addStyleSheetAfter($themeletpath .'/css/ie.css');
		// ie specific
		if(file_exists($css_ie6) && preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) $MORPH->addStyleSheetAfter($themeletpath .'/css/ie6.css');
		if(file_exists($css_ie7) && preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT'])) $MORPH->addStyleSheetAfter($themeletpath .'/css/ie7.css');
		if(file_exists($css_ie8) && preg_match('/MSIE 8/i', $_SERVER['HTTP_USER_AGENT'])) $MORPH->addStyleSheetAfter($themeletpath .'/css/ie8.css');		
		if($isiPad){ 
			if(file_exists($css_ipad)){ 
				$MORPH->addStyleSheet($themeletpath .'/css/ipad.css');
			}
		}
		if($isiPod){ 
			if(file_exists($css_ipod)){
				$MORPH->addStyleSheet($themeletpath .'/css/ipod.css');
			}
		}
		if($isBlackberry){ 
			if(file_exists($css_blackberry)){ 
				$MORPH->addStyleSheet($themeletpath .'/css/blackberry.css'); 
			}
		}
		if($isAndroid){
			if(file_exists($css_android)){ 
				$MORPH->addStyleSheet($themeletpath .'/css/android.css');
			}
		}
		$MORPH->addStyleSheet($templatepath .'/core/css/print.css');
		
	//} else {
	//	$document->addStyleSheet(JRoute::_('&render=css'.$cache.$gzip));
	//}
	
	//Sends Morphs scripts to JDocument, loading them at the top to avoid issues with missing jQuery in JomSocial and such.
	$MORPH->updateJDocument();
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

ob_start();
	if($googlefonts == 1) echo "#$themelet h1, #$themelet h2 {font-family: '".$heading_font."', Arial, Helvetica, sans-serif;}";
$doc->addStyleDeclaration(ob_get_clean());


// get layout functions
include_once('InnerLayout.php');
include_once('OuterLayout.php');

$document = JFactory::getDocument();
if (!$MORPH->countModules('outersplit or outer1 or outer2 or outer3 or outer4 or outer5')) $CurrentOuterScheme = '';
if (!$MORPH->countModules('innersplit or inner1 or inner2 or inner3 or inner4 or inner5')) $CurrentInnerScheme = '';
if (!$MORPH->countModules('user4')) $no_search = 'no_search';

// intelli mods array
$jj_const = array(
	"yui_suffix" => array(
		0				=> "",			// no suffix since no modules present
		1				=> "no-grid",	// no-grid since only 1 module present
		2				=> "yui-g",		// yui-g for 2 blocks in a grid
		3				=> "yui-gb",	// yui-gb for 3 blocks in a grid
		4				=> "yui-g4",	// yui-gb for 4 blocks in a grid
		5				=> "yui-g5"		// yui-gb for 5 blocks in a grid
	),
	"mod_suffix" => array(
		"toolbar"		=>$document->params->get('toolbar_gridsplit'),
		"top"			=>$document->params->get('top_gridsplit'),
		"topnav"		=>$document->params->get('topnav_gridsplit'),
		"subhead" 		=>$document->params->get('subhead_gridsplit'),
	  	"topshelf1"      =>$document->params->get('topshelf1_gridsplit'), 
	  	"topshelf2"      =>$document->params->get('topshelf2_gridsplit'), 
	  	"topshelf3"      =>$document->params->get('topshelf3_gridsplit'), 
		"user1"			=>$document->params->get('user1_gridsplit'),
		"inset1"		=>$document->params->get('inset1_gridsplit'),
		"inset2"		=>$document->params->get('inset2_gridsplit'),
		"inset3"		=>$document->params->get('inset3_gridsplit'),
		"inset4"		=>$document->params->get('inset4_gridsplit'),
		"user2"			=>$document->params->get('user2_gridsplit'),
		"bottomshelf1"	=>$document->params->get('bottomshelf1_gridsplit'),
		"bottomshelf2"	=>$document->params->get('bottomshelf2_gridsplit'),
		"bottomshelf3"	=>$document->params->get('bottomshelf3_gridsplit'),
		"footer"		=>$document->params->get('footer_gridsplit'),
	),
	"outer_inner_pos" => array(
		"outersplit", 
		"outer1", 
		"outer2", 
		"outer3", 
		"outer4", 
		"outer5", 
		"innersplit", 
		"inner1", 
		"inner2", 
		"inner3",
		"inner4", 
		"inner5"
	)
);

// This code needs to be reviewed as its preventing the grids class from being set.
//////////////////////////////////////////////////////////////////////////////////
//function getYuiSuffix ($moduleName, $jj_const){
//	$document = JFactory::getDocument();
//	$moduleCount = method_exists('countModules', $document) ? $document->countModules($moduleName) : 0; 
//	if(in_array($moduleName, $jj_const['outer_inner_pos'])){
//		$yuiModuleSuffix = $jj_const["yui_suffix"][$moduleCount];
//	}else{
//		if ($moduleCount == 2) {
//			$yuiModuleSuffix = $jj_const["mod_suffix"][$moduleName];
//		} else {
//			$yuiModuleSuffix = $jj_const["yui_suffix"][$moduleCount];
//		}
//	}
//	echo $yuiModuleSuffix;
//}
//////////////////////////////////////////////////////////////////////////////////

function getYuiSuffix ($moduleName, $jj_const){
	$document					= JFactory::getDocument();
	$moduleCount = $document->countModules($moduleName); 
	if(in_array($moduleName, $jj_const['outer_inner_pos'])){
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
	if(Morph::countModules($position) > 0){
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
	
	global $mainframe;
	$morph = Morph::getInstance();
	if ($morph->logo_block == $position.'_logo') {$logo_show = 1;}
	if($glob->countModules($position) && ${$position.'_show'} == 0 || $logo_show == 1 ){
		if ( ${$position.'_wrap'} == 1 ) { ?><div id="<?php echo $position; ?>-wrap" class="block wrap modcount<?php ${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }if(${$position.'_blockfx'} !== ''){ echo ' '.${$position.'_blockfx'}; }?>"><?php } ?>
			<?php if ( ${$position.'_chrome'} == 'grid' ) { ?>
			<div id="<?php echo $position; ?>" class="block <?php if ( $logo_show == 1 ) { echo 'logo-active '; } ?> <?php echo $position_class; ?> <?php echo $site_width ?> <?php getYuiSuffix($position, $jj_const); ?> clearer modcount<?php echo ${$position . '_count'}.' '.${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }if(${$position.'_blockfx'} !== ''){ echo ' '.${$position.'_blockfx'}; }?>">
			<?php } else { ?>	
			<div id="<?php echo $position; ?>" class="block <?php if ( $logo_show == 1 ) { echo 'logo-active '; } ?> <?php echo $position_class; ?> <?php echo $site_width ?> clearer modcount<?php echo ${$position . '_count'}.' '.${$position . '_chrome'};if(${$position.'_modfx'} !== ''){ echo ' '.${$position.'_modfx'}; }if(${$position.'_blockfx'} !== ''){ echo ' '.${$position.'_blockfx'}; }?>">
			<?php } ?>
			<?php if ( ${$position.'_inner'} == 1 ) { ?><div id="<?php echo $position; ?>-inner" class="inner clearer"><?php } ?>
			<?php if ( $logo_show == 1 ) { ?>
			<?php include 'includes/logo.php'; ?>
			<?php } ?>
			<?php if ($logo_show == 1 ) { ?>
				<div id="branding-secondary">
			<?php } ?>
			<?php if(${$position . '_chrome'} === 'tabs' or ${$position . '_chrome'} === 'accordion' ){ ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } else { ?>
				<jdoc:include type="modules" name="<?php echo $position; ?>" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo ${$position.'_chrome'}; } ?>" />
			<?php } ?>
			<?php if ( ${$position.'_inner'} == 1 ) { ?></div><?php } ?>
			</div>
			<?php if ($logo_show == 1 ) { ?></div><?php } ?>
		<?php if ( ${$position.'_wrap'} == 1 ) { ?></div><?php }
	}
}

function pt_body_classes($menu, $view, $themelet){

	$morph = Morph::getInstance();
	$params = new JParameter($menu->params);
	$pageclass = $params->get('pageclass_sfx');
	$user = JFactory::getUser();
	$lang = JFactory::getLanguage();
	$browser = new MBrowser();
	$engine = strtolower(preg_replace("/[^A-Za-z]/i", "", $browser->getBrowser()));
	$version = $engine.str_replace('.', '', $browser->getVersion());

	$classes = array(
		'js-disabled',
		'morph',
		$engine,
		$version,
		strtolower($browser->getPlatform()),
		$params->get('pageclass_sfx'),
		$view,
		$lang->getTag(),
		Morph::getTimeofday(),
		$morph->custom_body_sfx
	);
	if($menu->query['option'] !== '') $classes[] = $menu->query['option'];
	if(isset($_COOKIE['morph_developer_toolbar'])) $classes[] = 'devbar';
	
	//Classes based on user state and user type
	if($user->guest) $classes[] = 'user-guest';
	if($user->usertype) $classes[] = 'user-registered usertype-' . str_replace(array(' '), array('-'), strtolower($user->usertype));
	
	//Controller task
	if($task = JRequest::getCmd('task', false)) $classes[] = 'task-' . $task;
	
	return 'class="' . implode(' ', array_filter($classes)) . '" ' . ( $themelet ? 'id="' . $themelet . '"' : null );
}

function pt_classes($classes, $sitewidth=''){
	$c = '';
	if($sitewidth !== ''){ $c .= $sitewidth.' clearer '; }
	
	if(is_array($classes)){
		foreach($classes as $classname => $p){
			switch($classname){
				case 'subtext':
				$p >= 2 ? $c .= 'subtext' : $c .= 'no-subtext';
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
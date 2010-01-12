<?php
/**
*** Morph is a commercial template framework from JoomlaJunkie.com
*** @author    JoomlaJunkie
*** @copyright (C) 2009 by JoomlaJunkie
*** @license   Commercial
**/
defined( '_JEXEC' ) or die( 'Restricted index access' );
include_once(JPATH_ROOT.'/'.'templates'.'/'.$this->template.'/'.'core'.'/'.'morphFunctions.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<?php
if(isset($_COOKIE['firebug']) && $_COOKIE['firebug'] == 'enabled'){
	$enable_fb = 1;
	$document->addScript($templatepath .'/core/js/firebug-lite.js');
	$mainframe->addCustomHeadTag('
		<script type="text/javascript">
			firebug.env.height = 200;
			firebug.env.css = "'.$templatepath.'/core/css/firebug-lite.css";
		</script>
	');
}
if ( $google_analytics !== "" ) { ?>
<script type="text/javascript">
$.trackPage('<?php echo $google_analytics; ?>')
</script>
<?php } if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) { ?>
<meta name="viewport" content="width=320" />
<link rel="apple-touch-icon" href="<?php echo $assetspath; ?>/iphone/<?php echo $iphone_webclip; ?>" />
<?php } ?>
<?php if(isIE6() && $hide_ie6toolbar == 1 ){ ?><meta http-equiv="imagetoolbar" content="no" /><?php } ?>
<?php if( $browser->getBrowser() == Browser::BROWSER_IE && $chrome_frame == 1 ) {
	$document->setMetaData('X-UA-Compatible', 'chrome=1', true);
} ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/morph/core/css/print.css" type="text/css" media="Print" />
</head>
<?php if ($error_reporting == 0) { error_reporting(E_ALL ^ E_NOTICE); } ?>
<body <?php echo pt_body_classes($menu, $view, $themelet); ?>>
<?php
if($developer_toolbar == 1 or isset($_COOKIE['morph_developer_toolbar'])){
include_once('core/includes/devbar.php');
}
// check if google chrome frame is installed on the browser, if not show a info box
if( $browser->getBrowser() == Browser::BROWSER_IE && $chrome_frame == 1 ) { 
	if(!preg_match('/chromeframe/i', $_SERVER['HTTP_USER_AGENT'])){
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>';
		echo '<div id="gcf_placeholder" style="z-index:99999;"></div>';
		echo '<script>CFInstall.check({ node: "gcf_placeholder" });</script>'; 
	}
}
if( $browser->getBrowser() == Browser::PLATFORM_IPHONE && $iphone_mode == 1 ){
include_once('core'.'/'.'includes'.'/'.'iphone.php');
} else{
if(isIE6() && $ie6_upgrade == 1){ include_once('core'.'/'.'includes'.'/'.'ie6upgrade.php');}
if($this->countModules('advert1')){'<div id="advert1"><jdoc:include type="modules" name="advert1" style="none" /></div>';}
if($toolbar_position == 0){include_once('core'.'/'.'includes'.'/'.'toolbar.php');}
if($topnav_position == 0){include_once('core'.'/'.'includes'.'/'.'topnav.php');}
include_once('core'.'/'.'includes'.'/'.'masthead.php');
if($toolbar_position == 1){include_once('core'.'/'.'includes'.'/'.'toolbar.php');}
if($topnav_position == 1){include_once('core'.'/'.'includes'.'/'.'topnav.php');}
include_once('core'.'/'.'includes'.'/'.'subhead.php');
if($toolbar_position == 2){include_once('core'.'/'.'includes'.'/'.'toolbar.php');}	
if($topnav_position == 2){include_once('core'.'/'.'includes'.'/'.'topnav.php');}
include_once('core'.'/'.'includes'.'/'.'topshelf.php');
if($toolbar_position == 3){include_once('core'.'/'.'includes'.'/'.'toolbar.php');}	
if($topnav_position == 3){include_once('core'.'/'.'includes'.'/'.'topnav.php');}
include_once('core'.'/'.'includes'.'/'.'main.php');
include_once('core'.'/'.'includes'.'/'.'bottomshelf.php');
if(file_exists($foot_override) && is_readable($foot_override)){
	 include_once('morph_assets'.'/'.'themelets'.'/'.$themelet.'/'.'html'.'/'.'foot.php');
} else {
	 include_once('core'.'/'.'includes'.'/'.'foot.php');
}
if($this->countModules('advert2')) {'<div id="advert2"><jdoc:include type="modules" name="advert2" style="none" /></div>';}
?>
<jdoc:include type="modules" name="debug" />
<?php include_once('core'.'/'.'includes'.'/'.'ga-code.php'); ?>
<?php if ( $plugin_scrollto == 1 && $browser->getBrowser() !== Browser::PLATFORM_IPHONE ) { ?><a href="#top" id="top-link"><?php echo JText::_('Back to Top'); ?></a><?php } ?>

<?php } 
if(file_exists($footer_script) && is_readable($footer_script)){
	 include_once('morph_assets'.'/'.'themelets'.'/'.$themelet.'/'.'script.php');
} ?>
</body>
</html>
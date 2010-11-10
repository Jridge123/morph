<?php
/**
*** Morph is a commercial template framework from JoomlaJunkie.com
*** @author    JoomlaJunkie
*** @copyright (C) 2009 by JoomlaJunkie
*** @license   Commercial
**/
defined( '_JEXEC' ) or die( 'Restricted index access' );
include_once(JPATH_ROOT.'/templates/'.$this->template.'/core/morphFunctions.php'); ?>
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
jQuery.trackPage('<?php echo $google_analytics; ?>')
</script>
<?php } if( $browser->getBrowser() == MBrowser::PLATFORM_IPHONE && $iphone_viewport ) { 
if ($iphone_scalable) { $content = "user-scalable=yes"; } else { $content = "user-scalable=no"; }
if ($iphone_width) { $content .= ", width=" . $iphone_width; }
if ($iphone_height) { $content .= ", height=" . $iphone_height; }
if ($iphone_scale) { $content .= ", initial-scale=" . $iphone_scale; } ?>
<meta name="viewport" content="<?php echo($content); ?>" />
<?php } if(isIE6() && $hide_ie6toolbar == 1 ){ ?><meta http-equiv="imagetoolbar" content="no" /><?php } ?>
<?php if( $browser->getBrowser() == MBrowser::BROWSER_IE && $chrome_frame == 1 ) {
	$document->setMetaData('X-UA-Compatible', 'chrome=1', true);
} 
include_once('core/includes/ga-code.php'); ?>
</head>
<?php if ($error_reporting == 0) { error_reporting(E_ALL ^ E_NOTICE); } ?>
<body <?php echo pt_body_classes($menu, $view, $themelet); ?>>
<?php
if($developer_toolbar == 1) { include_once('core/includes/devbar.php'); } 

// check if google chrome frame is installed on the browser, if not show a info box
if( $browser->getBrowser() == MBrowser::BROWSER_IE && $chrome_frame == 1 ) { 
	if(!preg_match('/chromeframe/i', $_SERVER['HTTP_USER_AGENT'])){
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>';
		echo '<div id="gcf_placeholder" style="z-index:99999;"></div>';
		echo '<script>CFInstall.check({ node: "gcf_placeholder" });</script>'; 
	}
}
$isiPhone = $browser->getBrowser() == MBrowser::PLATFORM_IPHONE && $iphone_mode == 1;
$iPhoneCookie = isset($_COOKIE['iPhone']) ? $_COOKIE['iPhone'] == 'normal' : false;
if($isiPhone && !$iPhoneCookie) {
	if (file_exists($inc_iphone)) { include_once($inc_iphone); } else { include_once('core/includes/iphone.php'); }
	if (file_exists($inc_iphonefooter)) { include_once($inc_iphonefooter); } else { include_once('core/includes/iphone_footer.php'); }
} else {
	if(isIE6() && ($ie6_upgrade == 1)) { include_once('core/includes/ie6upgrade.php'); }
	include_once('core/includes/skipto.php');
	if($this->countModules('advert1')) { ?><jdoc:include type="modules" name="advert1" style="none" /><?php } ?>
	<?php 
	if($topnav_position == 0) { include_once('core/includes/topnav.php'); }
	if($toolbar_position == 0) { include_once('core/includes/toolbar.php'); }
	if($topnav_position == 1) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_masthead)) { include_once($inc_masthead); } else { include_once('core/includes/masthead.php'); }
	if($toolbar_position == 1) { include_once('core/includes/toolbar.php'); }
	if($topnav_position == 2) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_subhead)) { include_once($inc_subhead); } else { include_once('core/includes/subhead.php'); }
	if($toolbar_position == 2) { include_once('core/includes/toolbar.php'); }
	if($topnav_position == 3) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_topshelf1)) { include_once($inc_topshelf1); } else { include_once('core/includes/topshelf1.php'); }
	if($topnav_position == 4) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_topshelf2)) { include_once($inc_topshelf2); } else { include_once('core/includes/topshelf2.php'); }
	if($topnav_position == 5) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_topshelf3)) { include_once($inc_topshelf3); } else { include_once('core/includes/topshelf3.php'); }
	if($toolbar_position == 3) { include_once('core/includes/toolbar.php'); }
	if($topnav_position == 6) { include_once('core/includes/topnav.php'); }
	if(file_exists($inc_main)) { include_once($inc_main); } else { include_once('core/includes/main.php'); }
	if(file_exists($inc_bottomshelf1)) { include_once($inc_bottomshelf1); } else { include_once('core/includes/bottomshelf1.php'); }
	if(file_exists($inc_bottomshelf2)) { include_once($inc_bottomshelf2); } else { include_once('core/includes/bottomshelf2.php'); }
	if(file_exists($inc_bottomshelf3)) { include_once($inc_bottomshelf3); } else { include_once('core/includes/bottomshelf3.php'); }
	if(file_exists($inc_footer)) { include_once($inc_footer); } else { include_once('core/includes/foot.php'); }
	if($isiPhone && file_exists($inc_iphonefooter)) { include_once($inc_iphonefooter); } else { include_once('core/includes/iphone_footer.php'); } ?>
	<jdoc:include type="modules" name="debug" />
	<?php if($this->countModules('advert2')) { ?><jdoc:include type="modules" name="advert2" style="none" /><?php } ?>
	<?php if ( $plugin_scrollto == 1 && !$isiPhone ) { ?>
		<a href="#top" id="top-link"><?php echo JText::_('Back to top'); ?></a>
	<?php } ?>
<?php }
	if(file_exists($footer_script)) { include_once($footer_script); }
	if($preloader_enabled == 1) { include_once('core/includes/preloader.php'); } ?>
</body>
</html>
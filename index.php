<?php
/**
*** Morph is a comemrcial template framework from JoomlaJunkie.com
*** @author    JoomlaJunkie
*** @version   0.01
*** @copyright (C) 2009 by JoomlaJunkie
*** @license   Commercial
**/
defined( '_JEXEC' ) or die( 'Restricted index access' );
include_once(JPATH_ROOT . "/templates/" . $this->template . '/core/morphFunctions.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<?php if ( $google_analytics !== "" ) { ?>
<script type="text/javascript">
$.trackPage('<?php echo $google_analytics; ?>')
</script>
<?php } ?>
<?php if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) { ?>
<meta name="viewport" content="width=320" />
<link rel="apple-touch-icon" href="<?php echo $assetspath; ?>/iphone/<?php echo $iphone_webclip; ?>" />
<?php } ?>
<?php if(isIE6() && $hide_ie6toolbar == 1 ){ ?><meta http-equiv="imagetoolbar" content="no" /><?php } ?>
<?php if( $browser->getBrowser() == Browser::BROWSER_IE && $chrome_frame == 1 ) { ?>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<?php }	?>

</head>
<?php if ($error_reporting == 0) error_reporting(E_ALL ^ E_NOTICE); ?>
<body class="js-disabled morph <?php echo "$lcbrowser $lcbrowser$ver"; if ($pageclass != ""){ echo ' '.$pageclass; } ?>"<?php if ($themelet != ""){ echo ' id="'.$themelet.'"'; } ?>>
<?php 
// check if Google Chrome Frame is installed on the browser, if not show a info box
if( $browser->getBrowser() == Browser::BROWSER_IE && $chrome_frame == 1 ) { 
	if(!preg_match('/chromeframe/i', $_SERVER['HTTP_USER_AGENT'])){
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>';
		echo '<div id="gcf_placeholder" style="z-index:99999;"></div>';
		echo '<script>CFInstall.check({ node: "gcf_placeholder" });</script>'; 
	}
}
if( $browser->getBrowser() == Browser::PLATFORM_IPHONE && $iphone_mode == 1 ){
include_once('core/includes/iphone.php');
} else{
if(isIE6() && $ie6_upgrade == 1){ include_once('core/includes/ie6upgrade.php');}
>>>>>>> 62b9e7b61a0e564652ff785fadcfdd3d5b8d7ffe:index.php
if($this->countModules('advert1')){'<div id="advert1"><jdoc:include type="modules" name="advert1" style="none" /></div>';}
if($toolbar_position == 0){include_once('core/includes/toolbar.php');}
if($topnav_position == 0){include_once('core/includes/topnav.php');}
include_once('core/includes/masthead.php');
if($toolbar_position == 1){include_once('core/includes/toolbar.php');}
if($topnav_position == 1){include_once('core/includes/topnav.php');}
include_once('core/includes/subhead.php');
if($toolbar_position == 2){include_once('core/includes/toolbar.php');}	
if($topnav_position == 2){include_once('core/includes/topnav.php');}
include_once('core/includes/topshelf.php');
if($toolbar_position == 3){include_once('core/includes/toolbar.php');}	
if($topnav_position == 3){include_once('core/includes/topnav.php');}
include_once('core/includes/main.php');
include_once('core/includes/bottomshelf.php');
include_once('core/includes/foot.php');
if($this->countModules('advert2')) {'<div id="advert2"><jdoc:include type="modules" name="advert2" style="none" /></div>';}
?>
<jdoc:include type="modules" name="debug" />
<?php include_once("core/includes/ga-code.php"); ?>
<?php if ( $plugin_scrollto == 1 && $browser->getBrowser() !== Browser::PLATFORM_IPHONE ) { ?><a href="#top" id="top-link">Top of Page</a><?php } ?>
<?php } ?>
</body>
</html>
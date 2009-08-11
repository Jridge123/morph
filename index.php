<?php
/**
*** Morph is a comemrcial template framework from JoomlaJunkie.com
*** @author    JoomlaJunkie
*** @version   0.01
*** @copyright (C) 2009 by JoomlaJunkie
*** @license   Commercial
**/
defined( '_JEXEC' ) or die( 'Restricted index access' );
include_once(JPATH_ROOT . "/templates/" . $this->template . '/core/morphFunctions.php');
if ($error_reporting == 0) { 
error_reporting(E_ALL ^ E_NOTICE); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<?php if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) { ?>
<meta name="viewport" content="width=320" />
<?php } ?>
</head>
<body class="js-disabled morph <?php echo "$lcbrowser $lcbrowser$ver"; if ($pageclass != ""){ echo ' '.$pageclass; } ?>"<?php if ($themelet != ""){ echo ' id="'.$themelet.'"'; } ?>>
<?php 
if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) {
	include_once("core/includes/iphone.php");
} else {
	if ( isIE6() && $ie6_upgrade == 1 ) include_once("core/includes/ie6upgrade.php");
		if($this->countModules('advert1')) { '<div id="advert1"><jdoc:include type="modules" name="advert1" style="none" /></div>';
	}
	if(file_exists($toolbar_overrides) && is_readable($toolbar_overrides) && $toolbar_position == 0){
		 include_once("morph_assets/themelets/'.$themelet.'/html/toolbar.php");
	} else {
		 include_once("core/includes/toolbar.php");
	}
	if(file_exists($topnav_overrides) && is_readable($topnav_overrides) && $topnav_position == 0){
		 include_once("morph_assets/themelets/'.$themelet.'/html/topnav.php");
	} else {
		 include_once("core/includes/topnav.php");
	}
	if(file_exists($masthead_overrides) && is_readable($masthead_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/masthead.php");
	} else {
		 include_once("core/includes/masthead.php");
	}
	if(file_exists($toolbar_overrides) && is_readable($toolbar_overrides) && $toolbar_position == 1){
		 include_once("morph_assets/themelets/'.$themelet.'/html/toolbar.php");
	} else {
		 include_once("core/includes/toolbar.php");
	}
	if(file_exists($topnav_overrides) && is_readable($topnav_overrides) && $topnav_position == 1){
		 include_once("morph_assets/themelets/'.$themelet.'/html/topnav.php");
	} else {
		 include_once("core/includes/topnav.php");
	}
	if(file_exists($subhead_overrides) && is_readable($subhead_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/subhead.php");
	} else {
		 include_once("core/includes/subhead.php");
	}
	if(file_exists($toolbar_overrides) && is_readable($toolbar_overrides) && $toolbar_position == 2){
		 include_once("morph_assets/themelets/'.$themelet.'/html/toolbar.php");
	} else {
		 include_once("core/includes/toolbar.php");
	}	
	if(file_exists($topnav_overrides) && is_readable($topnav_overrides) && $topnav_position == 2){
		 include_once("morph_assets/themelets/'.$themelet.'/html/topnav.php");
	} else {
		 include_once("core/includes/topnav.php");
	}
	if(file_exists($topshelf_overrides) && is_readable($topshelf_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/topshelf.php");
	} else {
		 include_once("core/includes/topshelf.php");
	}
	if(file_exists($toolbar_overrides) && is_readable($toolbar_overrides) && $toolbar_position == 3){
		 include_once("morph_assets/themelets/'.$themelet.'/html/toolbar.php");
	} else {
		 include_once("core/includes/toolbar.php");
	}	
	if(file_exists($topnav_overrides) && is_readable($topnav_overrides) && $topnav_position == 3){
		 include_once("morph_assets/themelets/'.$themelet.'/html/topnav.php");
	} else {
		 include_once("core/includes/topnav.php");
	}
	if(file_exists($main_overrides) && is_readable($main_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/main.php");
	} else {
		 include_once("core/includes/main.php");
	}
	if(file_exists($bottomshelf_overrides) && is_readable($bottomshelf_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/bottomshelf.php");
	} else {
		 include_once("core/includes/bottomshelf.php");
	}
	if(file_exists($foot_overrides) && is_readable($foot_overrides)){
		 include_once("morph_assets/themelets/'.$themelet.'/html/foot.php");
	} else {
		 include_once("core/includes/foot.php");
	}
	?>
	<?php if($this->countModules('advert2')) { ?><div id="advert2"><jdoc:include type="modules" name="advert2" style="none" /></div><?php } ?>
	<jdoc:include type="modules" name="debug" />
	<?php include_once("core/includes/ga-code.php"); ?>
	<?php if ( $plugin_scrollto == 1 ) { ?><a href="#top" id="top-link">Top of Page</a><?php } ?>

<?php } ?>
</body>
</html>
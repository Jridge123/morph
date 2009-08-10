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
<?php if( $browser->getBrowser() == Browser::PLATFORM_IPHONE ) {
	include_once("core/includes/iphone.php");
} else { ?>
	<?php if ( isIE6() && $ie6_upgrade == 1 ) include_once("core/includes/ie6upgrade.php"); ?>
	<?php if($this->countModules('advert1')) { ?><div id="advert1"><jdoc:include type="modules" name="advert1" style="none" /></div><?php } ?>
	<?php
	// toolbar + topnav after toolbar
	if ( $toolbar_position == 0 ) include_once("core/includes/toolbar.php");
	if ( $topnav_position == 0 ) include_once("core/includes/topnav.php");
	
	include_once("core/includes/masthead.php");
	
	// toolbar + topnav after master head
	if ( $toolbar_position == 1 ) include_once("core/includes/toolbar.php");
	if ( $topnav_position == 1 ) include_once("core/includes/topnav.php");
	
	include_once("core/includes/subhead.php");
	
	// toolbar + topnav after sub head
	if ( $toolbar_position == 2 ) include_once("core/includes/toolbar.php");
	if ( $topnav_position == 2 ) include_once("core/includes/topnav.php");
	
	include_once("core/includes/topshelf.php");
	
	// toolbar + topnav after topshelf
	if ( $toolbar_position == 3 ) include_once("core/includes/toolbar.php");
	if ( $topnav_position == 3 ) include_once("core/includes/topnav.php");
	
	include_once("core/includes/main.php");
	include_once("core/includes/bottomshelf.php");
	include_once("core/includes/foot.php");
	?>
	<?php if($this->countModules('advert2')) { ?><div id="advert2"><jdoc:include type="modules" name="advert2" style="none" /></div><?php } ?>
	<jdoc:include type="modules" name="debug" />
	<?php include_once("core/includes/ga-code.php"); ?>
	<?php if ( $plugin_scrollto == 1 ) { ?><a href="#top" id="top-link">Top of Page</a><?php } ?>

<?php } ?>
</body>
</html>
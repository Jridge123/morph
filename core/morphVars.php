<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$morph = Morph::getInstance();
$db=& JFactory::getDBO();
$doc =& JFactory::getDocument();
jimport('joomla.application.module.helper');

/* tabs count
*******************************************************/
$tabscount = $morph->tabscount();

/* accordion count
*******************************************************/
$accordionscount = $morph->accordionscount();

if ($morph->countModules('user3')) {
// use module helper to check for menu suffixes
$get_topnav = JModuleHelper::getModules( 'user3' );
$getParams = $get_topnav[0]->params;

//topdrop
$topdrop = strstr($getParams, 'topdrop') ? 1 : false;
$morph->topdrop = strstr($getParams, 'topdrop') ? 1 : false;

//topfish
$topfish = strstr($getParams, 'topfish') ? 1 : false;
$morph->topfish = strstr($getParams, 'topfish') ? 1 : false;

//subtext
$subtext = strstr($getParams, 'subtext') ? 1 : false;
$morph->subtext = strstr($getParams, 'subtext') ? 1 : false;

} else {
	$topdrop = false;
	$subtext = false;
	$topfish = false;
}

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=sidefish%' OR `params` LIKE '%sidefish%'";
$db->setQuery( $query ); $sidefish = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'outersplit' AND `module` = 'mod_mainmenu' OR `position` = 'outer1' AND `module` = 'mod_mainmenu' OR `position` = 'outer2' AND `module` = 'mod_mainmenu' OR `position` = 'outer3' AND `module` = 'mod_mainmenu' OR `position` = 'outer4' AND `module` = 'mod_mainmenu' OR `position` = 'outer5' AND `module` = 'mod_mainmenu' OR `position` = 'innersplit' AND `module` = 'mod_mainmenu' OR `position` = 'inner1' AND `module` = 'mod_mainmenu' OR `position` = 'inner2' AND `module` = 'mod_mainmenu' OR `position` = 'inner3' AND `module` = 'mod_mainmenu' OR `position` = 'inner4' AND `module` = 'mod_mainmenu' OR `position` = 'inner5' AND `module` = 'mod_mainmenu'" ;
$db->setQuery( $query ); $sidenav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `module` = 'mod_mainmenu' OR `position` = 'masthead' AND `module` = 'mod_mainmenu'  OR `position` = 'toolbar' AND `module` = 'mod_mainmenu'";
$db->setQuery( $query ); $topnav_count = $db->loadResult();

$simpleticker = JModuleHelper::isEnabled( 'simpleticker' );
$simpletweet = JModuleHelper::isEnabled( 'simpletweet' );
$simplecontact = JModuleHelper::isEnabled( 'simplecontact' );
$simplesocial = JModuleHelper::isEnabled( 'simplesocial' );
$aidanews = JModuleHelper::isEnabled( 'aidanews' );

// Let's pass session variables to the js and css views so we only have to run the sql queries once.
$counts = array('tabscount', 'accordionscount', 'topdrop', 'topfish', 'subtext', 'sidefish', 'sidenav_count', 'topnav_count', 'simpleticker', 'simpletweet', 'simplecontact', 'simplesocial');
foreach($counts as $count)
{
	$_SESSION[$count] = $$count;
}

if(file_exists($themeletjs)){ $themelet_js = 1; }else{ $themelet_js = 0; }
if(file_exists($customjs)){ $custom_js = 1; }else{ $custom_js = 0; }
if(file_exists($customcss)){ $custom_css = 1; }else{ $custom_css = 0; }
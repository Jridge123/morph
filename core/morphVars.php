<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$morph = Morph::getInstance();
$db=& JFactory::getDBO();
$doc =& JFactory::getDocument();
jimport('joomla.application.module.helper');

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'tabs' ";
$db->setQuery( $query ); $tabscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'accordion' ";
$db->setQuery( $query ); $accordionscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=rounded%' ";
$db->setQuery( $query ); $roundedcount = $db->loadResult();

// use module helper to check for menu suffixes
$modules = JModuleHelper::getModules( 'user3' );

//topdrop
$hasTopdrop = $modules[0]->params;
$topdrop = strstr($hasTopdrop, 'topdrop') ? 1 : false;
$morph->topdrop = strstr($hasTopdrop, 'topdrop') ? 1 : false;

//topfish
$hasTopfish = $modules[0]->params;
$topfish = strstr($hasTopfish, 'topfish') ? 1 : false;
$morph->topfish = strstr($hasTopfish, 'topfish') ? 1 : false;

//subtext
$hasSubtext = $modules[0]->params;
$subtext = strstr($hasSubtext, 'subtext') ? 1 : false;
$morph->subtext = strstr($hasSubtext, 'subtext') ? 1 : false;

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=animate%' OR `position` = 'user3' AND `params` LIKE '% animate%'";
$db->setQuery( $query ); $animate_top = $db->loadResult();

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
$counts = array('tabscount', 'accordionscount', 'roundedcount', 'topdrop', 'topfish', 'subtext', 'animate_top', 'sidefish', 'sidenav_count', 'topnav_count', 'simpleticker', 'simpletweet', 'simplecontact', 'simplesocial');
foreach($counts as $count)
{
	$_SESSION[$count] = $$count;
}

if(file_exists($themeletjs)){ $themelet_js = 1; }else{ $themelet_js = 0; }
if(file_exists($customjs)){ $custom_js = 1; }else{ $custom_js = 0; }
if(file_exists($customcss)){ $custom_css = 1; }else{ $custom_css = 0; }
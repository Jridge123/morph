<?php defined( '_JEXEC' ) or die( 'Restricted access' );

$db=& JFactory::getDBO();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'tabs' ";
$db->setQuery( $query ); $tabscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'accordion' ";
$db->setQuery( $query ); $accordionscount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=rounded%' ";
$db->setQuery( $query ); $roundedcount = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3'  AND published = '1' AND `params` LIKE '%moduleclass_sfx=topdrop%' OR `position` = 'user3' AND published = '1' AND `params` LIKE '% topdrop%' OR `position` = 'top' AND published = '1' AND `params` LIKE '%moduleclass_sfx=topdrop%' OR `position` = 'top' AND published = '1' AND `params` LIKE '% topdrop%'";
$db->setQuery( $query ); $topdrop = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND published = '1' AND `params` LIKE '%moduleclass_sfx=topfish%' OR `position` = 'user3' AND published = '1' AND `params` LIKE '% topfish%' OR `position` = 'top' AND published = '1' AND `params` LIKE '%moduleclass_sfx=topfish%' OR `position` = 'top' AND published = '1' AND `params` LIKE '% topfish%'";
$db->setQuery( $query ); $topfish = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND published = '1' AND `params` LIKE '%moduleclass_sfx=subtext%' OR `position` = 'user3' AND published = '1' AND `params` LIKE '% subtext%' OR `position` = 'top' AND published = '1' AND `params` LIKE '%moduleclass_sfx=subtext%' OR `position` = 'top' AND published = '1' AND `params` LIKE '% subtext%'";
$db->setQuery( $query ); $subtext = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `params` LIKE '%moduleclass_sfx=animate%' OR `position` = 'user3' AND `params` LIKE '% animate%'";
$db->setQuery( $query ); $animate_top = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `params` LIKE '%moduleclass_sfx=sidefish%' OR `params` LIKE '%sidefish%'";
$db->setQuery( $query ); $sidefish = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'outersplit' AND `module` = 'mod_mainmenu' OR `position` = 'outer1' AND `module` = 'mod_mainmenu' OR `position` = 'outer2' AND `module` = 'mod_mainmenu' OR `position` = 'outer3' AND `module` = 'mod_mainmenu' OR `position` = 'outer4' AND `module` = 'mod_mainmenu' OR `position` = 'outer5' AND `module` = 'mod_mainmenu' OR `position` = 'innersplit' AND `module` = 'mod_mainmenu' OR `position` = 'inner1' AND `module` = 'mod_mainmenu' OR `position` = 'inner2' AND `module` = 'mod_mainmenu' OR `position` = 'inner3' AND `module` = 'mod_mainmenu' OR `position` = 'inner4' AND `module` = 'mod_mainmenu' OR `position` = 'inner5' AND `module` = 'mod_mainmenu'" ;
$db->setQuery( $query ); $sidenav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `position` = 'user3' AND `module` = 'mod_mainmenu' OR `position` = 'top' AND `module` = 'mod_mainmenu'  OR `position` = 'toolbar' AND `module` = 'mod_mainmenu'";
$db->setQuery( $query ); $topnav_count = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simpleticker' AND `published` = '1'";
$db->setQuery( $query ); $simpleticker = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simpletweet' AND `published` = '1'";
$db->setQuery( $query ); $simpletweet = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simplecontact' AND `published` = '1'";
$db->setQuery( $query ); $simplecontact = $db->loadResult();

$query = "SELECT COUNT(*) FROM `#__modules` WHERE `module` = 'mod_simplesocial' AND `published` = '1'";
$db->setQuery( $query ); $simplesocial = $db->loadResult();

//Let's pass session variables to the js and css views so we only have to run the sql queries once.
$counts = array('tabscount', 'accordionscount', 'roundedcount', 'topdrop', 'topfish', 'subtext', 'animate_top', 'sidefish', 'sidenav_count', 'topnav_count', 'simpleticker', 'simpletweet', 'simplecontact', 'simplesocial');
foreach($counts as $count)
{
	$_SESSION[$count] = $$count;
}

if(file_exists($themeletjs)){ $themelet_js = 1; }else{ $themelet_js = 0; }
if(file_exists($customjs)){ $custom_js = 1; }else{ $custom_js = 0; }
if(file_exists($customcss)){ $custom_css = 1; }else{ $custom_css = 0; }
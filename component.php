<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once(JPATH_ROOT.DS.'templates'.DS.'morph'.DS.'core'.DS.'morphFunctions.php');
ob_start();
$db = JFactory::getDBO();
$db->setQuery("select contents from #__configurator_customfiles where filename='".basename(__FILE__)."'");
$res = stripslashes($db->loadResult());
eval("?>".$res);
?>
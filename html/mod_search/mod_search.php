<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$view = &JFactory::getDocument();
if($override = Morph::override(__FILE__, $view)) {
   if(file_exists($override)) include $override;
} else {

// Include the syndicate functions only once
require_once( dirname(__FILE__).'/helper.php' );
$button			 = $params->get('button', '');
$imagebutton	 = $params->get('imagebutton', '');
$button_pos		 = $params->get('button_pos', 'left');
$button_text	 = $params->get('button_text', JText::_('Search'));
$width			 = intval($params->get('width', 20));
$maxlength		 = $width > 20 ? $width : 20;
$text			 = $params->get('text', JText::_('search...'));
$set_Itemid		 = intval($params->get('set_itemid', 0));
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
if ($imagebutton) {
    $img = modSearchHelper::getSearchImage( $button_text );
}
require(JModuleHelper::getLayoutPath('mod_search'));
} // close the themelet override check
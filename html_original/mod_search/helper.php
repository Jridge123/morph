<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
class modSearchHelper {
    function getSearchImage($button_text) {
	    $img = JHTML::_('image.site', 'searchButton.gif', '/images/M_images/', NULL, NULL, $button_text, null, 0);
		return $img;
	}
}
} // close the themelet override check
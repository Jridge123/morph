<?php defined('_JEXEC') or die('Restricted access');

// Transforms $MORPH->variable into $variable
extract((array)$MORPH, EXTR_SKIP);

//    Do not edit this line.
$sideBarsScheme = array (
    'default'=>      'content-sidebar'
);
$morph_settings = get_object_vars($MORPH);
foreach($morph_settings as $key=>$value) {
    if(substr($key,0,4)=='com_') $sideBarsScheme[$key] = $value;
}
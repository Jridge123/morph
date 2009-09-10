<?php

// This is used to configure your inner layout defaults per component. 
// YUI CSS uses percentages to determine the ratio between the Inner Layout
// and the Primary Content. The first value is the width of the content and 
// the second is the Inner Layout (right sidebar).

/* Options Explained:
**************************************************/
// g   = 50/50 Split.
// gc  = 66/33 Split.
// gd  = 33/66 Split - Not Recommended.
// ge  = 75/25 Split.
// gf  = 25/75 Split - Not Recommended.

/* Global default - Set within configurator:
**************************************************/
	$innerScheme = array (
	'default'=>     	 	"$inner_default",

/* Example Usage:
**************************************************/
//	'com_frontpage'=>		'g',
//	'com_wrapper'=>			'ge',
//	'com_fireboard'=>		'gd',
//	'com_content'=>			'ge',
//	'com_newsfeeds'=>		'gd',
//	'com_weblinks'=>		'gh',
//	'com_user'=>			'gf',
//	'com_contact'=>			'ge',
//	'com_search'=>			'gh',
);

/* Do not modify anything below this line:
**************************************************/
if ($option && isset($innerScheme[$option]) && trim($innerScheme[$option])!= false){
	$CurrentInnerScheme = trim($innerScheme[$option]);
} 
else {
	$CurrentInnerScheme = $innerScheme['default'];
}
$innerPageSuffix = array (
    '0' => 'none',
	'1' => 'yui-g',
	'2' => 'yui-gc',
	'3' => 'yui-ge',
	'4' => 'yui-gi',
	'5' => 'yui-gh'
	);
$innerSfxArr = (explode("inner",$pageclass));
if (array_key_exists(1,$innerSfxArr)) {
	$CurrentInnerScheme = $innerPageSuffix[substr($innerSfxArr[1],0,1)];
}
?>
<?php

// This is used to configure your outer layout defaults per component. 

/* Options Explained:
**************************************************/
// t1  = 160px sidebar on the left.
// t2  = 180px sidebar on the left.
// t3  = 300px sidebar on the left.
// t4  = 180px sidebar on the right.
// t5  = 240px sidebar on the right.
// t6  = 300px sidebar on the right.
// t7  = Not available, as it is handled dynamically by Joomla.
// t8  = 200px sidebar on the left (custom).
// t9  = 200px sidebar on the right (custom).

/* Global default - Set within configurator:
**************************************************/
$OuterScheme = array (
	'default'=>     	 "$outer_default",

/* Example Usage:
**************************************************/
//	'com_frontpage' => 	'5',
//	'com_fireboard'=>  	'6',
//	'com_content'=>    	'6',
//	'com_newsfeeds'=>	'1',
//	'com_weblinks'=>	'8',
//	'com_user'=>		'3',
//	'com_newsfeeds'=>	'5',
//	'com_contact'=>		'9',
//	'com_poll'=>		'4',
//	'com_search'=>		'2',
//	'com_portfolio'=>	'8',
//	'com_wordpress'=>	'9'
	'com_wrapper'=>  	'2',
);

/* Do not modify anything below this line:
**************************************************/
if ($option && isset($OuterScheme[$option]) && trim($OuterScheme[$option])!= false){
	$CurrentOuterScheme = trim($OuterScheme[$option]);
} else {
	$CurrentOuterScheme = $OuterScheme['default'];
}
$innerSfxArr = (explode("outer",$pageclass));
if (array_key_exists(1,$innerSfxArr)) {
	$CurrentOuterScheme = substr($innerSfxArr[1],0,1);
}
?>
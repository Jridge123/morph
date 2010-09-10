<?php
$innerPageSuffix = array (
    '0' => 'none',
	'1' => 'yui-g',
	'2' => 'yui-gc',
	'3' => 'yui-ge',
	'4' => 'yui-gi',
	'5' => 'yui-gh'
);

if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
	$innerScheme = array ('default'=>$inner_default);	
	foreach($MORPH as $k => $v){
 		if(preg_match('/id_/i', $k)){
 			$k = str_replace('id_', '', $k);
 			$innerScheme[$k] = $v;
 		}
 	}

	if($option && isset($innerScheme[$option]) && trim($innerScheme[$option])!= 'default'){
		$CurrentInnerScheme = $innerPageSuffix[trim($innerScheme[$option])];
	}else{
		$CurrentInnerScheme = $innerScheme['default'];
	}
};

if(isset($pageclass)){
	$innerSfxArr = (explode("inner",$pageclass));
	if(array_key_exists(1,$innerSfxArr)) {
		$CurrentInnerScheme = $innerPageSuffix[substr($innerSfxArr[1],0,1)];
	}
}
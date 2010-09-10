<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$outerPageSuffix = array (
	'0' => 'yui-t0',
	'1' => 'yui-t1',
	'2' => 'yui-t2',
	'3' => 'yui-t3',
	'4' => 'yui-t4',
	'5' => 'yui-t5',
	'6' => 'yui-t6',
	'7' => 'yui-t8',
	'8' => 'yui-t9'
);

if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
	$OuterScheme = array ('default'=>"$outer_default");
	foreach($MORPH as $k => $v){
 		if(preg_match('/od_/i', $k)){
 			$k = str_replace('od_', '', $k);
 			$OuterScheme[$k] = $v;
 		}
 	}

	if ($option && isset($OuterScheme[$option]) && trim($OuterScheme[$option])!= 'default'){
		$CurrentOuterScheme = $outerPageSuffix[trim($OuterScheme[$option])];
	}else{
		$CurrentOuterScheme = $OuterScheme['default'];
	}
};

if(isset($pageclass)){
	$outerSfxArr = (explode("outer",$pageclass));
	if (array_key_exists(1,$outerSfxArr)) {
		$CurrentOuterScheme = $outerPageSuffix[substr($outerSfxArr[1],0,1)];
	}
}
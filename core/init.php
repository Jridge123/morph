<?php

//include PHP HOOKS Class
include_once "phphooks.class.php";


//create instance of class
$hook = new morphhooks ( );

//now, this is a workaround because plugins, when included, can't access $hook variable, so we
//as developers have to basically redefine functions which can be called from plugin files

function do_action($tag, $args) {
	global $hook;
	$hook->execute_hook ($tag, $args);
}

function add_action($tag, $function, $priority = 10) {
	global $hook;
	$hook->add_hook ( $tag, $function, $priority );
}

function has_action($tag) {
	global $hook;
	if ($hook->hook_exist ($tag)) {
		return true;
	} else {
		return false;
	}
}
?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if(!isset(${$position.'_wrap'})){ ${$position.'_wrap'} = ''; }else{ ${$position.'_wrap'} = ${$position.'_wrap'}; }
if(!isset(${$position.'_show'})){ ${$position.'_show'} = ''; }else{ ${$position.'_show'} = ${$position.'_show'}; }
if(!isset(${$position.'_inner'})){ ${$position.'_inner'} = ''; }else{ ${$position.'_inner'} = ${$position.'_inner'}; }
if(!isset(${$position.'_count'})){ ${$position.'_count'} = ''; }else{ ${$position.'_count'} = ${$position.'_count'}; }
if(!isset(${$position.'_chrome'})){ ${$position.'_chrome'} = ''; }else{ ${$position.'_chrome'} = ${$position.'_chrome'}; }
if(!isset(${$position.'_modfx'})){ ${$position.'_modfx'} = ''; }else{ ${$position.'_modfx'} = ${$position.'_modfx'}; }
if(!isset(${$position.'_logo'})){ ${$position.'_logo'} = ''; }else{ ${$position.'_logo'} = ${$position.'_logo'}; }
if(!isset(${$position.'_blockfx'})){ ${$position.'_blockfx'} = ''; }else{ ${$position.'_blockfx'} = ${$position.'_blockfx'}; }
$classes = array(
	$position.'_wrap' 	=> ${$position.'_wrap'},
	$position.'_show' 	=> ${$position.'_show'}, 
	$position.'_inner' 	=> ${$position.'_inner'}, 
	$position.'_count' 	=> ${$position.'_count'}, 
	$position.'_chrome' => ${$position.'_chrome'}, 
	$position.'_modfx'	=> ${$position.'_modfx'},
	$position.'_logo'	=> ${$position.'_logo'},
	$position.'_blockfx'	=> ${$position.'_blockfx'}
);
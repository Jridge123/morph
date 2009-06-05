<?php
header("content-type: text/css; charset: UTF-8");
$logo_type = $_GET['01'];
$logo_width = $_GET['02'];
$logo_height = $_GET['03'];
$logo_image = $_GET['04'];
$logo_image_ie = $_GET['05'];
$toolbar_slider = $_GET['06'];
$themelet_bgcolor = '#'.$_GET['07'];
$themelet_bgimage = $_GET['08'];
$themelet_bgrepeat = $_GET['09'];
$themelet_bgposition = $_GET['10'];
$themelet_primary = '#'.$_GET['11'];
$themelet_secondary = '#'.$_GET['12'];
$themelet_links = '#'.$_GET['13'];
$gzip_compression = $_GET['14'];

if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}

function isIE6(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(strpos($user_agent, 'MSIE 6 ')){
		return true;
	} else {
		return false;
	}
}
?>
body{<?php if ( $themelet_bgcolor && $themelet_bgcolor !== "default" ) { ?>background-color: <?php echo $themelet_bgcolor; ?>;<?php } if ( $themelet_bgimage && $themelet_bgimage !== "default" ) { ?>background-image: <?php echo $themelet_bgimage; ?>;<?php } if ( $themelet_bgrepeat && $themelet_bgrepeat !== "default" ) { ?>background-repeat: <?php echo $themelet_bgrepeat; ?>;<?php } if ( $themelet_bgposition && $themelet_bgposition !== "default" ) { ?>background-position: <?php echo $themelet_bgposition; ?>;<?php } ?>}
<?php if ( $themelet_links && $themelet_links !== "default" ) { ?>
body a:link,body a:visited,body a:active{color: <?php echo $themelet_links; ?>;}
<?php } if ( $logo_type == "2" ) { ?>
#branding h1{width:<?php echo $logo_width; ?>;}
#branding h1 a{width:<?php echo $logo_width; ?>;height:<?php echo $logo_height; ?>;background:transparent url(../../../logos/<?php if( isIE6() && $logo_image_ie !== ''){ echo $ie_logo_image; } else { echo $logo_image; } ?>) no-repeat 0;}
<?php } if ( $toolbar_slider == 1 ) { ?>
#toolbar-wrap{position:absolute;top:0;width:100%;}
#toolbar{position:relative;top:0;height:100%;}
<?php } if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
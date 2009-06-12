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
$color_h1 = '#'.$_GET['11'];
$color_h2 = '#'.$_GET['12'];
$color_h3 = '#'.$_GET['13'];
$color_h4 = '#'.$_GET['14'];
$color_h5 = '#'.$_GET['15'];
$color_links = '#'.$_GET['16'];
$color_linkshover = '#'.$_GET['17'];
$color_bodytext = '#'.$_GET['18'];
$gzip_compression = $_GET['19'];

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
body{
<?php if ( $themelet_bgcolor && $themelet_bgcolor !== "#default" ) { ?>background-color: <?php echo $themelet_bgcolor; ?>;
<?php } if ( $themelet_bgimage && $themelet_bgimage !== "default" ) { ?>background-image: url(../../../backgrounds/<?php echo $themelet_bgimage; ?>);
<?php } if ( $themelet_bgrepeat && $themelet_bgrepeat !== "default" ) { ?>background-repeat: <?php echo $themelet_bgrepeat; ?>;
<?php } if ( $themelet_bgposition && $themelet_bgposition !== "default" ) { ?>background-position: <?php echo $themelet_bgposition; ?>;<?php } ?>}
<?php if ( $logo_type == 2 ) { ?>
#branding h1{width:<?php echo $logo_width; ?>px;height:<?php echo $logo_height; ?>px;}
#branding h1 a{width:<?php echo $logo_width; ?>px;height:<?php echo $logo_height; ?>px;background:transparent url(../../../logos/<?php if( isIE6() && $logo_image_ie !== ''){ echo $ie_logo_image; } else { echo $logo_image; } ?>) no-repeat 0;}
<?php }
if ( $toolbar_slider == 1 ) { ?>
#toolbar-wrap{position:absolute;top:0;width:100%;}
#toolbar{position:relative;top:0;height:100%;}
<?php } ?>
<?php if ( $color_links && $color_links !== "#default" ) { ?>
body a:link,body a:visited,body a:active{color: <?php echo $color_links; ?>;}
<?php } ?>
<?php if ( $color_linkshover && $color_linkshover !== "#default" ) { ?>
body a:hover{color: <?php echo $color_linkshover; ?>;}
<?php } ?>
<?php if ( $color_h1 && $color_h1 !== "#default" ) { ?>#primary-content h1{color:<?php echo $color_h1; ?>}<?php } ?>
<?php if ( $color_h2 && $color_h2 !== "#default" ) { ?>#primary-content h2{color:<?php echo $color_h2; ?>}<?php } ?>
<?php if ( $color_h3 && $color_h3 !== "#default" ) { ?>#primary-content h3{color:<?php echo $color_h3; ?>}<?php } ?>
<?php if ( $color_h4 && $color_h4 !== "#default" ) { ?>#primary-content h4{color:<?php echo $color_h4; ?>}<?php } ?>
<?php if ( $color_h5 && $color_h5 !== "#default" ) { ?>#primary-content h5{color:<?php echo $color_h5; ?>}<?php } ?>
<?php if ( $color_bodytext && $color_bodytext !== "#default" ) { ?>
body{color: <?php echo $color_bodytext; ?>;}
<?php } ?>
<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
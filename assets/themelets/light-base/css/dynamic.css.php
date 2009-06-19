<?php
header("content-type: text/css; charset: UTF-8");

$toolbar_slider = $_GET['A01'];

$logo_type = $_GET['B01'];
$logo = $_GET['B02'];
$logo_width = $_GET['B03'];
$logo_height = $_GET['B04'];
$logo_textcolor = '#'.$_GET['B05'];
$logo_fontfamily = stripslashes(urldecode($_GET['B06']));
$logo_fontsize = $_GET['B07'];

$slogan_textcolor = '#'.$_GET['C01'];
$slogan_fontfamily = stripslashes(urldecode($_GET['C02']));
$slogan_fontsize = $_GET['C03'];

$bg_color = '#'.$_GET['D01'];
$bg_image = $_GET['D02'];
$bg_repeat = $_GET['D03'];
$bg_position = urldecode($_GET['D04']);
$bg_attachment = $_GET['D05'];

$color_h1 = '#'.$_GET['E01'];
$color_h2 = '#'.$_GET['E02'];
$color_h3 = '#'.$_GET['E03'];
$color_h4 = '#'.$_GET['E04'];
$color_h5 = '#'.$_GET['E05'];
$color_links = '#'.$_GET['E06'];
$color_linkshover = '#'.$_GET['E07'];
$color_linksvisited = '#'.$_GET['E08'];
$color_bodytext = '#'.$_GET['E09'];

$footer_textcolor = '#'.$_GET['F01'];
$footer_linkscolor = '#'.$_GET['F02'];
 
$gzip_compression = $_GET['Z01'];

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

// 0 Linked inline image
// 1 Linked plain text
// 2 Linked h1 text replacement
// 3 Module position (branding)
?>
body{
<?php if ( $bg_color && $bg_color !== "#default" ) { ?>
background-color: <?php echo $bg_color; ?>;
<?php } ?>
background-image: url(../../../backgrounds/<?php echo $bg_image; ?>);
background-repeat: <?php echo $bg_repeat; ?>;
background-position: <?php echo $bg_position; ?>;
background-attachment: <?php echo $bg_attachment; ?>;
}
<?php if ( $logo_type == 2 ) { ?>
#branding h1,#branding h1 a{
width:<?php echo $logo_width; ?>px;
height:<?php echo $logo_height; ?>px;
}
#branding h1 a{
background:transparent url(<?php echo $logo; ?>) no-repeat 0;
}
<?php } if ( $logo_type == 1 ) { ?>
#branding.txt-logo a{
<?php if ( $logo_fontfamily !== "" ) { ?>
	font-family:<?php echo $logo_fontfamily; ?>;
<?php } if ( $logo_fontsize !== "" ) { ?>
	font-size:<?php echo $logo_fontsize; ?>;
<?php } if ( $logo_textcolor && $logo_textcolor !== "#default" ) { ?>
	color:<?php echo $logo_textcolor; ?>;
<?php } ?>
}
<?php } ?>

#branding.slogan .slogan{
<?php if ( $slogan_fontfamily !== "" ) { ?>
	font-family:<?php echo $slogan_fontfamily; ?>;
<?php } ?>

<?php if ( $slogan_fontsize !== "" ) { ?>
	font-size:<?php echo $slogan_fontsize; ?>;
<?php } ?>
	
<?php if ( $slogan_textcolor && $slogan_textcolor !== "#default" ) { ?>
	color:<?php echo $slogan_textcolor; ?>;
<?php } ?>
}
p.slogan{
clear:both;
margin:0;
padding:0;
margin: 0 0 .5em 0;
line-height: 1;
}
<?php if ( $toolbar_slider == 1 ) { ?>
#toolbar-wrap{position:absolute;top:0;width:100%;}
#toolbar{position:relative;top:0;height:100%;}
<?php } ?>

<?php if ( $color_links && $color_links !== "#default" ) { ?>
body a:link,body a:visited,body a:active{color:<?php echo $color_links; ?>;}
<?php } ?>

<?php if ( $color_linkshover && $color_linkshover !== "#default" ) { ?>
body a:hover{color:<?php echo $color_linkshover; ?>;}
<?php } ?>

<?php if ( $color_linksvisited && $color_linksvisited !== "#default" ) { ?>
body a:visited{color:<?php echo $color_linksvisited; ?>;}
<?php } ?>

<?php if ( $color_h1 && $color_h1 !== "#default" ) { ?>#primary-content h1{color:<?php echo $color_h1; ?>}<?php } ?>
<?php if ( $color_h2 && $color_h2 !== "#default" ) { ?>#primary-content h2{color:<?php echo $color_h2; ?>}<?php } ?>
<?php if ( $color_h3 && $color_h3 !== "#default" ) { ?>#primary-content h3{color:<?php echo $color_h3; ?>}<?php } ?>
<?php if ( $color_h4 && $color_h4 !== "#default" ) { ?>#primary-content h4{color:<?php echo $color_h4; ?>}<?php } ?>
<?php if ( $color_h5 && $color_h5 !== "#default" ) { ?>#primary-content h5{color:<?php echo $color_h5; ?>}<?php } ?>
<?php if ( $color_bodytext && $color_bodytext !== "#default" ) { ?>
body{color: <?php echo $color_bodytext; ?>;}
<?php } ?>
<?php if ( $footer_textcolor && $footer_textcolor !== "#default" ) { ?>#footer{color:<?php echo $footer_textcolor; ?>}<?php } ?>
<?php if ( $footer_linkscolor && $footer_linkscolor !== "#default" ) { ?>#footer a,#footer a:link,#footer a:visited{color:<?php echo $footer_linkscolor; ?>}<?php } ?>

<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
html{
background-color:<?php echo $this->css->html_bg_color; ?>;
<?php if ( $this->css->use_html_bg_image == 1 ) { ?>
background-image:url(<?php echo JURI::root(1) ?>/morph_assets/backgrounds/<?php echo $this->css->html_bg_image; ?>);
background-repeat:<?php echo $this->css->html_bg_repeat; ?>;
background-position:<?php echo $this->css->html_bg_position; ?>;
background-attachment:<?php echo $this->css->html_bg_attachment; ?>;
<?php } ?>
}
body{
background-color:<?php echo $this->css->body_bg_color; ?>;
<?php if ( $this->css->use_body_bg_image == 1 ) { ?>
background-image:url(<?php echo JURI::root(1) ?>/morph_assets/backgrounds/<?php echo $this->css->body_bg_image; ?>);
background-repeat:<?php echo $this->css->body_bg_repeat; ?>;
background-position:<?php echo $this->css->body_bg_position; ?>;
background-attachment:<?php echo $this->css->body_bg_attachment; ?>;
<?php } ?>
}

<?php if ( $this->css->logowrap_height ) { ?>
#branding {
height:<?php echo $this->css->logowrap_height; ?>;
}
<?php } ?>

<?php 
//set dynamic width on branding-secondary div
if ($this->css->site_width == 'doc') {
	$site_width = 750;
}
else if ($this->css->site_width == 'doc2') {
	$site_width = 950;
}
//doc3 cant wont as its 100% and cant detect browser width with php..??? testing suggests nothing is needed for this to work with doc3 100%
//else if ($this->css->site_width == 'doc3') {
//	$site_width = 100;
//}
else if ($this->css->site_width == 'doc4') {
	$site_width = 974;
}

?>

<?php if ( $this->css->masthead_height ) { ?>
#masthead{
height:<?php echo $this->css->masthead_height; ?>;
}
<?php } if ( $this->css->logo_type == 0 ) { ?>
<?php $branding_secwidth = $site_width - 30 - $this->css->logo_width; ?>
.branding-secondary  {
	width: <?php echo $branding_secwidth; ?>px;
}
#branding h1{
top:<?php echo $this->css->logo_top; ?>;
left:<?php echo $this->css->logo_left; ?>;
z-index:<?php echo $this->css->logo_stack; ?>;
font-size:<?php echo $this->css->logo_fontsize; ?>;
}
#branding h1 a{
font-family:<?php echo $this->css->logo_fontfamily; ?>;
color:<?php echo $this->css->logo_textcolor; ?>;
}
<?php } if ( $this->css->logo_type == 1 ) { ?>
<?php $branding_secwidth = $site_width - 30 - $this->css->logo_size[0];?>
.branding-secondary  {
	width: <?php echo $branding_secwidth; ?>px;
}
#branding h1{
top:<?php echo $this->css->logo_top; ?>;
left:<?php echo $this->css->logo_left; ?>;
z-index:<?php echo $this->css->logo_stack; ?>;
}
#branding h1 a{
<?php if(!empty($this->css->logo_size[0])) { ?>
width:<?php echo $this->css->logo_size[0]; ?>px;
<?php } if(!empty($this->css->logo_size[1])) { ?>
height:<?php echo $this->css->logo_size[1]; ?>px;
<?php } ?>
background-image: url(<?php echo $this->css->logo; ?>);
}
<?php } if ( $this->css->logo_type == 2 ) { ?>
#branding.logotype-2 a.logo-img{
top:<?php echo $this->css->logo_top; ?>;
left:<?php echo $this->css->logo_left; ?>;
z-index:<?php echo $this->css->logo_stack; ?>;
}
<?php } if ( $this->css->logo_type == 3 ) { ?>
#branding #logo{
top:<?php echo $this->css->logo_top; ?>;
left:<?php echo $this->css->logo_left; ?>;
z-index:<?php echo $this->css->logo_stack; ?>;
}
<?php } if ( $this->css->display_slogan == 1 ) { ?>
#branding .slogan{
font-family:<?php echo $this->css->slogan_fontfamily; ?>;
font-size:<?php echo $this->css->slogan_fontsize; ?>;
color:<?php echo $this->css->slogan_textcolor; ?>;
top:<?php echo $this->css->slogan_top; ?>;
left:<?php echo $this->css->slogan_left; ?>;
z-index:<?php echo $this->css->slogan_stack; ?>;
}
<?php } if ( $this->css->preloader_enabled == 1 ) { ?>
.QOverlay{
background-color:<?php echo $this->css->preloader_background; ?>;
z-index: 9999;
}
.QLoader{
background-color:<?php echo $this->css->preloader_foreground; ?>;
height:<?php echo $this->css->preloader_height; ?>;
}
<?php } ?>
a:link,a:visited,a:active{color:<?php echo $this->css->color_links; ?>;}
a:hover{color:<?php echo $this->css->color_linkshover; ?>;}
a:visited{color:<?php echo $this->css->color_linksvisited; ?>;}
h1,.componentheading{color:<?php echo $this->css->color_h1; ?>;}
h2,.contentheading{color:<?php echo $this->css->color_h2; ?>;}
h3{color:<?php echo $this->css->color_h3; ?>;}
h4{color:<?php echo $this->css->color_h4; ?>;}
h5{color:<?php echo $this->css->color_h5; ?>;}
body{color:<?php echo $this->css->color_bodytext; ?>;}
<?php if($this->css->footer_textcolor !== 'default') { ?>
#footer{color:<?php echo $this->css->footer_textcolor; ?>}
<?php } if($this->css->footer_linkscolor !== 'default') { ?>
#footer a,#footer a:link,#footer a:visited{color:<?php echo $this->css->footer_linkscolor; ?>}
<?php } ?>

<?php if ( $this->css->captions_enabled ) { ?>
.caption-top,.caption-bottom{background:<?php echo $this->css->captions_bgcolor; ?>;color:<?php echo $this->css->captions_textcolor; ?>;}
.caption-top{border-bottom:<?php echo $this->css->captions_borderheight; ?> solid <?php echo $this->css->captions_bordercolor; ?>;}
.caption-bottom{border-top:<?php echo $this->css->captions_borderheight; ?> solid <?php echo $this->css->captions_bordercolor; ?>;}
<?php } ?>
<?php /* use Morph::getInstance()->addStyleDeclaration() to output here */ ?>
<?php echo $this->css->styleDeclarations ?>
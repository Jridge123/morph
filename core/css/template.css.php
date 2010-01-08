html{
background-color:<?php echo $this->css->html_bg_color; ?>;
<?php if ( $this->css->use_html_bg_image == 1 ) { ?>
background-image:url(../../../../morph_assets/backgrounds/<?php echo $this->css->html_bg_image; ?>);
background-repeat:<?php echo $this->css->html_bg_repeat; ?>;
background-position:<?php echo $this->css->html_bg_position; ?>;
background-attachment:<?php echo $this->css->html_bg_attachment; ?>;
<?php } ?>
}
body{
background-color:<?php echo $this->css->body_bg_color; ?>;
<?php if ( $this->css->use_body_bg_image == 1 ) { ?>
background-image:url(../../../../morph_assets/backgrounds/<?php echo $this->css->body_bg_image; ?>);
background-repeat:<?php echo $this->css->body_bg_repeat; ?>;
background-position:<?php echo $this->css->body_bg_position; ?>;
background-attachment:<?php echo $this->css->body_bg_attachment; ?>;
<?php } ?>
}
<?php if ( $this->css->masthead_height ) { ?>
#masthead{
height:<?php echo $this->css->masthead_height; ?>;
}
<?php } if ( $this->css->logo_type == 0 ) { ?>
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
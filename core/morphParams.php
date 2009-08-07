<?php
defined('_JEXEC') or die('Restricted access');

// general settings
$site_width = $MORPH->site_width;
$themelet = $MORPH->themelet;

// customization settings
$bg_image = $MORPH->bg_image;
$bg_color = str_replace('#','',$MORPH->bg_color);
$bg_repeat = $MORPH->bg_repeat;
$bg_position = $MORPH->bg_position;
$bg_attachment = $MORPH->bg_attachment;

$color_h1 = str_replace('#','',$MORPH->color_h1);
$color_h2 = str_replace('#','',$MORPH->color_h2);
$color_h3 = str_replace('#','',$MORPH->color_h3);
$color_h4 = str_replace('#','',$MORPH->color_h4);
$color_h5 = str_replace('#','',$MORPH->color_h5);
$color_links = str_replace('#','',$MORPH->color_links);
$color_linkshover = str_replace('#','',$MORPH->color_linkshover);
$color_linksvisited = str_replace('#','',$MORPH->color_linksvisited);
$color_bodytext = str_replace('#','',$MORPH->color_bodytext);

$logo_type = $MORPH->logo_type;
$logo_image = $MORPH->logo_image;
$logo_autodimensions = $MORPH->logo_autodimensions;
$logo_width = $MORPH->logo_width;
$logo_height = $MORPH->logo_height;
$display_ie_logo = $MORPH->display_ie_logo;
$logo_image_ie = $MORPH->logo_image_ie;
$logo_text = $MORPH->logo_text;
$logo_alttext = $MORPH->logo_alttext;
$logo_linktitle = $MORPH->logo_linktitle;
$logo_textcolor = $MORPH->logo_textcolor;
$logo_fontfamily = $MORPH->logo_fontfamily;
$logo_fontsize = $MORPH->logo_fontsize;

$display_slogan = $MORPH->display_slogan;
$slogan_text = $MORPH->slogan_text;
$slogan_textcolor = $MORPH->slogan_textcolor;
$slogan_fontfamily = $MORPH->slogan_fontfamily;
$slogan_fontsize = $MORPH->slogan_fontsize;

// progressive enhancements
$rounded_corners = $MORPH->rounded_corners;
$rounded_amount = $MORPH->rounded_amount;
$equal_heights = $MORPH->equal_heights;
$plugin_scrollto = $MORPH->plugin_scrollto;

// menu settings
$topnav_supersubs = $MORPH->topnav_supersubs;
$topnav_hoverintent = $MORPH->topnav_hoverintent;
$topnav_hoverfocus = $MORPH->topnav_hoverfocus;
$topnav_actionlink = $MORPH->topnav_actionlink;
$topnav_minwidth = $MORPH->topnav_minwidth;
$topnav_maxwidth = $MORPH->topnav_maxwidth;
$topnav_delay = $MORPH->topnav_delay;
$topnav_animation = $MORPH->topnav_animation;

// iphone settings
$iphone_mode = $MORPH->iphone_mode;
$iphone_header = $MORPH->iphone_header;
$iphone_webclip = $MORPH->iphone_webclip;

// performance
$pack_css = $MORPH->pack_css;
$pack_js = $MORPH->pack_js;
$gzip_compression = $MORPH->gzip_compression;
$load_mootools = $MORPH->load_mootools;
$load_caption = $MORPH->load_caption;

// Advanced Options
$code_comments = $MORPH->code_comments;
$remove_generator = $MORPH->remove_generator;
$error_reporting = $MORPH->error_reporting;
$jquery_core = $MORPH->jquery_core;
$debug_modules = $MORPH->debug_modules;
$ie6_upgrade = $MORPH->ie6_upgrade;
$google_analytics = $MORPH->google_analytics;

// top block
$toolbar_wrap = $MORPH->toolbar_wrap;
$toolbar_inner = $MORPH->toolbar_inner;
$toolbar_chrome = $MORPH->toolbar_chrome;
$toolbar_gridsplit = $MORPH->toolbar_gridsplit;
$toolbar_position = $MORPH->toolbar_position;
$toolbar_slider = $MORPH->toolbar_slider;
$toolbar_slider_text = $MORPH->toolbar_slider_text;
$toolbar_show = $MORPH->toolbar_show;

// masthead block
$masthead_wrap = $MORPH->masthead_wrap;
$masthead_inner = $MORPH->masthead_inner;
$masthead_chrome = $MORPH->masthead_chrome;
$masthead_gridsplit = $MORPH->masthead_gridsplit;
$display_skipto = $MORPH->display_skipto;
$masthead_show = $MORPH->masthead_show;

// subhead block
$subhead_wrap = $MORPH->subhead_wrap;
$subhead_inner = $MORPH->subhead_inner;
$subhead_gridsplit = $MORPH->subhead_gridsplit;
$subhead_chrome = $MORPH->subhead_chrome;
$subhead_show = $MORPH->subhead_show;

// navigation block
$topnav_wrap = $MORPH->topnav_wrap;
$topnav_inner = $MORPH->topnav_inner;
$topnav_gridsplit = $MORPH->topnav_gridsplit;
$topnav_position = $MORPH->topnav_position;
$topnav_chrome = $MORPH->topnav_chrome;
$topnav_show = $MORPH->topnav_show;

// topshelf block
$topshelf_wrap = $MORPH->topshelf_wrap;
$topshelf_inner = $MORPH->topshelf_inner;
$topshelf_chrome = $MORPH->topshelf_chrome;
$topshelf_equalize = $MORPH->topshelf_equalize;
$topshelf_gridsplit = $MORPH->topshelf_gridsplit;
$topshelf_slider = $MORPH->topshelf_slider;
$topshelf_slider_text = $MORPH->topshelf_slider_text;
$topshelf_show = $MORPH->topshelf_show;

// bottom shelf block
$bottomshelf_inner = $MORPH->bottomshelf_inner;
$bottomshelf_wrap = $MORPH->bottomshelf_wrap;
$bottomshelf_chrome = $MORPH->bottomshelf_chrome;
$bottomshelf_equalize = $MORPH->bottomshelf_equalize;
$bottomshelf_gridsplit = $MORPH->bottomshelf_gridsplit;
$bottomshelf_slider = $MORPH->bottomshelf_slider;
$bottomshelf_slider_text = $MORPH->bottomshelf_slider_text;
$bottomshelf_show = $MORPH->bottomshelf_show;

// user1 block
$user1_inner = $MORPH->user1_inner;
$user1_chrome = $MORPH->user1_chrome;
$user1_gridsplit = $MORPH->user1_gridsplit;
$user1_equalize = $MORPH->user1_equalize;
$user1_show = $MORPH->user1_show;

// user2 block
$user2_inner = $MORPH->user2_inner;
$user2_chrome = $MORPH->user2_chrome;
$user2_gridsplit = $MORPH->user2_gridsplit;
$user2_equalize = $MORPH->user2_equalize;
$user2_show = $MORPH->user2_show;

// inset blocks
$inset1_chrome = $MORPH->inset1_chrome;
$inset1_gridsplit = $MORPH->inset1_gridsplit;
$inset2_chrome = $MORPH->inset2_chrome;
$inset2_gridsplit = $MORPH->inset2_gridsplit;
$inset3_chrome = $MORPH->inset3_chrome;
$inset3_gridsplit = $MORPH->inset3_gridsplit;
$inset4_chrome = $MORPH->inset4_chrome;
$inset4_gridsplit = $MORPH->inset4_gridsplit;

// main block
$main_wrap = $MORPH->main_wrap;
$main_inner = $MORPH->main_inner;

// secondary content
$outer_default = $MORPH->outer_default;
$secondary_inner = $MORPH->secondary_inner;
$splitleft_chrome = $MORPH->splitleft_chrome;
$splitleft_chrome_inner = $MORPH->splitleft_chrome_inner;
$topleft_chrome = $MORPH->topleft_chrome;
$topleft_chrome_inner = $MORPH->topleft_chrome_inner;
$topleft_equalize = $MORPH->topleft_equalize;
$left_chrome = $MORPH->left_chrome;
$left_chrome_inner = $MORPH->left_chrome_inner;
$btmleft_chrome = $MORPH->btmleft_chrome;
$btmleft_chrome_inner = $MORPH->btmleft_chrome_inner;

// tertiary content
$inner_default = $MORPH->inner_default;
$tertiary_inner = $MORPH->tertiary_inner;
$splitright_chrome = $MORPH->splitright_chrome;
$splitright_chrome_inner = $MORPH->splitright_chrome_inner;
$topright_chrome = $MORPH->topright_chrome;
$topright_chrome_inner = $MORPH->topright_chrome_inner;
$right_chrome = $MORPH->right_chrome;
$right_chrome_inner = $MORPH->right_chrome_inner;
$btmright_chrome = $MORPH->btmright_chrome;
$btmright_chrome_inner = $MORPH->btmright_chrome_inner;

// Footer Block
$footer_wrap = $MORPH->footer_wrap;
$footer_chrome = $MORPH->footer_chrome;
$footer_gridsplit = $MORPH->footer_gridsplit;
$footer_type = $MORPH->footer_type;
$footer_credits = $MORPH->footer_credits;
$footer_copyright = $MORPH->footer_copyright;
$footer_swish = $MORPH->footer_swish;
$footer_morphlink = $MORPH->footer_morphlink;
$footer_xhtml = $MORPH->footer_xhtml;
$footer_css = $MORPH->footer_css;
$footer_rss = $MORPH->footer_rss;
$footer_show = $MORPH->footer_show;
$footer_textcolor = $MORPH->footer_textcolor;
$footer_linkscolor = $MORPH->footer_linkscolor;

//    Do not edit this line.
$sideBarsScheme = array (
    'default'=>      'content-sidebar'
);
$morph_settings = get_object_vars($MORPH);
foreach($morph_settings as $key=>$value) {
    if(substr($key,0,4)=='com_') $sideBarsScheme[$key] = $value;
}
?>
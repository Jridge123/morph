<?php
defined('_JEXEC') or die('Restricted access');

// general settings
$site_width = $MORPH->site_width;
$themelet = $MORPH->themelet;
$nojs = $MORPH->nojs;
$hide_ie6toolbar = $MORPH->hide_ie6toolbar;
$global_wrap = $MORPH->global_wrap;
$remove_outline = $MORPH->remove_outline;

// customization settings
$html_bg_color = str_replace('#','',$MORPH->html_bg_color);
$use_html_bg_image = $MORPH->use_html_bg_image;
$html_bg_image = $MORPH->html_bg_image;
$html_bg_repeat = $MORPH->html_bg_repeat;
$html_bg_position = $MORPH->html_bg_position;
$html_bg_attachment = $MORPH->html_bg_attachment;
$body_bg_color = str_replace('#','',$MORPH->body_bg_color);
$use_body_bg_image = $MORPH->use_body_bg_image;
$body_bg_image = $MORPH->body_bg_image;
$body_bg_repeat = $MORPH->body_bg_repeat;
$body_bg_position = $MORPH->body_bg_position;
$body_bg_attachment = $MORPH->body_bg_attachment;

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
$logo_top = $MORPH->logo_top;
$logo_left = $MORPH->logo_left;
$logo_stack = $MORPH->logo_stack;
$display_slogan = $MORPH->display_slogan;
$slogan_text = $MORPH->slogan_text;
$slogan_textcolor = $MORPH->slogan_textcolor;
$slogan_fontfamily = $MORPH->slogan_fontfamily;
$slogan_fontsize = $MORPH->slogan_fontsize;
$slogan_top = $MORPH->slogan_top;
$slogan_left = $MORPH->slogan_left;
$slogan_stack = $MORPH->slogan_stack;

// progressive enhancements
$rounded_corners = $MORPH->rounded_corners;
$rounded_amount = $MORPH->rounded_amount;
$equal_heights = $MORPH->equal_heights;
$plugin_scrollto = $MORPH->plugin_scrollto;
$chrome_frame = $MORPH->chrome_frame;

$captions_enabled = $MORPH->captions_enabled;
$captions_speedover = $MORPH->captions_speedover;
$captions_speedout = $MORPH->captions_speedout;
$captions_delay = $MORPH->captions_delay;
$captions_animation = $MORPH->captions_animation;
$captions_prefix = $MORPH->captions_prefix;
$captions_opacity = $MORPH->captions_opacity;
$captions_position = $MORPH->captions_position;
$captions_bgcolor = $MORPH->captions_bgcolor;
$captions_bordercolor = $MORPH->captions_bordercolor;
$captions_borderheight = $MORPH->captions_borderheight;
$captions_textcolor = $MORPH->captions_textcolor;

// lazy load
$lazyload_enabled = $MORPH->lazyload_enabled;

// colorbox lightbox
$lightbox_enabled = $MORPH->lightbox_enabled;

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

// debugging
$code_comments = $MORPH->code_comments;
$remove_generator = $MORPH->remove_generator;
$error_reporting = $MORPH->error_reporting;
$jquery_core = $MORPH->jquery_core;
$debug_modules = $MORPH->debug_modules;
$ie6_upgrade = $MORPH->ie6_upgrade;
$google_analytics = $MORPH->google_analytics;
$developer_toolbar = $MORPH->developer_toolbar;

// top block
$toolbar_wrap = $MORPH->toolbar_wrap;
$toolbar_inner = $MORPH->toolbar_inner;
$toolbar_chrome = $MORPH->toolbar_chrome;
$toolbar_module_inner = $MORPH->toolbar_module_inner;
$toolbar_gridsplit = $MORPH->toolbar_gridsplit;
$toolbar_equalize = $MORPH->toolbar_equalize;
$toolbar_position = $MORPH->toolbar_position;
$toolbar_slider = $MORPH->toolbar_slider;
$toolbar_slider_text = $MORPH->toolbar_slider_text;
$toolbar_show = $MORPH->toolbar_show;
$toolbar_modfx = $MORPH->toolbar_modfx;

// masthead block
$masthead_wrap = $MORPH->masthead_wrap;
$masthead_inner = $MORPH->masthead_inner;
$masthead_height = $MORPH->masthead_height;
$masthead_chrome = $MORPH->masthead_chrome;
$masthead_module_inner = $MORPH->masthead_module_inner;
$masthead_gridsplit = $MORPH->masthead_gridsplit;
$masthead_equalize = $MORPH->masthead_equalize;
$display_skipto = $MORPH->display_skipto;
$masthead_modfx = $MORPH->masthead_modfx;
$masthead_show = $MORPH->masthead_show;

// subhead block
$subhead_wrap = $MORPH->subhead_wrap;
$subhead_inner = $MORPH->subhead_inner;
$subhead_chrome = $MORPH->subhead_chrome;
$subhead_module_inner = $MORPH->subhead_module_inner;
$subhead_gridsplit = $MORPH->subhead_gridsplit;
$subhead_equalize = $MORPH->subhead_equalize;
$subhead_modfx = $MORPH->subhead_modfx;
$subhead_show = $MORPH->subhead_show;

// navigation block
$topnav_wrap = $MORPH->topnav_wrap;
$topnav_inner = $MORPH->topnav_inner;
$topnav_chrome = $MORPH->topnav_chrome;
$topnav_module_inner = $MORPH->topnav_module_inner;
$topnav_gridsplit = $MORPH->topnav_gridsplit;
$topnav_equalize = $MORPH->topnav_equalize;
$topnav_modfx = $MORPH->topnav_modfx;
$topnav_position = $MORPH->topnav_position;
$topnav_show = $MORPH->topnav_show;

// topshelf block
$topshelf_wrap = $MORPH->topshelf_wrap;
$topshelf_inner = $MORPH->topshelf_inner;
$topshelf_chrome = $MORPH->topshelf_chrome;
$topshelf_module_inner = $MORPH->topshelf_module_inner;
$topshelf_gridsplit = $MORPH->topshelf_gridsplit;
$topshelf_equalize = $MORPH->topshelf_equalize;
$topshelf_slider = $MORPH->topshelf_slider;
$topshelf_slider_text = $MORPH->topshelf_slider_text;
$topshelf_modfx = $MORPH->topshelf_modfx;
$topshelf_show = $MORPH->topshelf_show;

// bottom shelf block
$bottomshelf_wrap = $MORPH->bottomshelf_wrap;
$bottomshelf_inner = $MORPH->bottomshelf_inner;
$bottomshelf_chrome = $MORPH->bottomshelf_chrome;
$bottomshelf_module_inner = $MORPH->bottomshelf_module_inner;
$bottomshelf_gridsplit = $MORPH->bottomshelf_gridsplit;
$bottomshelf_equalize = $MORPH->bottomshelf_equalize;
$bottomshelf_slider = $MORPH->bottomshelf_slider;
$bottomshelf_slider_text = $MORPH->bottomshelf_slider_text;
$bottomshelf_show = $MORPH->bottomshelf_show;
$bottomshelf_modfx = $MORPH->bottomshelf_modfx;

// user1 block
$user1_inner = $MORPH->user1_inner;
$user1_chrome = $MORPH->user1_chrome;
$user1_module_inner = $MORPH->user1_module_inner;
$user1_gridsplit = $MORPH->user1_gridsplit;
$user1_equalize = $MORPH->user1_equalize;
$user1_show = $MORPH->user1_show;
$user1_modfx = $MORPH->user1_modfx;

// user2 block
$user2_inner = $MORPH->user2_inner;
$user2_chrome = $MORPH->user2_chrome;
$user2_module_inner = $MORPH->user2_module_inner;
$user2_gridsplit = $MORPH->user2_gridsplit;
$user2_equalize = $MORPH->user2_equalize;
$user2_show = $MORPH->user2_show;
$user2_modfx = $MORPH->user2_modfx;

// inset blocks
$inset1_chrome = $MORPH->inset1_chrome;
$inset1_module_inner = $MORPH->inset1_module_inner;
$inset1_gridsplit = $MORPH->inset1_gridsplit;
$inset1_equalize = $MORPH->inset1_equalize;
$inset1_modfx = $MORPH->inset1_modfx;

$inset2_chrome = $MORPH->inset2_chrome;
$inset2_module_inner = $MORPH->inset2_module_inner;
$inset2_gridsplit = $MORPH->inset2_gridsplit;
$inset2_equalize = $MORPH->inset2_equalize;
$inset2_modfx = $MORPH->inset2_modfx;

$inset3_chrome = $MORPH->inset3_chrome;
$inset3_module_inner = $MORPH->inset3_module_inner;
$inset3_gridsplit = $MORPH->inset3_gridsplit;
$inset3_equalize = $MORPH->inset3_equalize;
$inset3_modfx = $MORPH->inset3_modfx;

$inset4_chrome = $MORPH->inset4_chrome;
$inset4_module_inner = $MORPH->inset4_module_inner;
$inset4_gridsplit = $MORPH->inset4_gridsplit;
$inset4_equalize = $MORPH->inset4_equalize;
$inset4_modfx = $MORPH->inset4_modfx;

// main block
$main_wrap = $MORPH->main_wrap;
$main_inner = $MORPH->main_inner;
$pathway_text_show = $MORPH->pathway_text_show;
$pathway_text = $MORPH->pathway_text;

// secondary content
$outer_default = $MORPH->outer_default;
$secondary_inner = $MORPH->secondary_inner;

$outersplit_chrome = $MORPH->outersplit_chrome;
$outersplit_module_inner = $MORPH->outersplit_module_inner;
$outersplit_equalize = $MORPH->outersplit_equalize;
$outersplit_modfx = $MORPH->outersplit_modfx;

$outer1_chrome = $MORPH->outer1_chrome;
$outer1_module_inner = $MORPH->outer1_module_inner;
$outer1_equalize = $MORPH->outer1_equalize;
$outer1_modfx = $MORPH->outer1_modfx;

$outer2_chrome = $MORPH->outer2_chrome;
$outer2_module_inner = $MORPH->outer2_module_inner;
$outer2_equalize = $MORPH->outer2_equalize;
$outer2_modfx = $MORPH->outer2_modfx;

$outer3_chrome = $MORPH->outer3_chrome;
$outer3_module_inner = $MORPH->outer3_module_inner;
$outer3_equalize = $MORPH->outer3_equalize;
$outer3_modfx = $MORPH->outer3_modfx;

$outer4_chrome = $MORPH->outer4_chrome;
$outer4_module_inner = $MORPH->outer4_module_inner;
$outer4_equalize = $MORPH->outer4_equalize;
$outer4_modfx = $MORPH->outer4_modfx;

$outer5_chrome = $MORPH->outer5_chrome;
$outer5_module_inner = $MORPH->outer5_module_inner;
$outer5_equalize = $MORPH->outer5_equalize;
$outer5_modfx = $MORPH->outer5_modfx;

// tertiary content
$inner_default = $MORPH->inner_default;
$tertiary_inner = $MORPH->tertiary_inner;

$innersplit_chrome = $MORPH->innersplit_chrome;
$innersplit_module_inner = $MORPH->innersplit_module_inner;
$innersplit_equalize = $MORPH->innersplit_equalize;
$innersplit_modfx = $MORPH->innersplit_modfx;

$inner1_chrome = $MORPH->inner1_chrome;
$inner1_module_inner = $MORPH->inner1_module_inner;
$inner1_modfx = $MORPH->inner1_modfx;
$inner1_equalize = $MORPH->inner1_equalize;

$inner2_chrome = $MORPH->inner2_chrome;
$inner2_module_inner = $MORPH->inner2_module_inner;
$inner2_modfx = $MORPH->inner2_modfx;
$inner2_equalize = $MORPH->inner2_equalize;

$inner3_chrome = $MORPH->inner3_chrome;
$inner3_module_inner = $MORPH->inner3_module_inner;
$inner3_modfx = $MORPH->inner3_modfx;
$inner3_equalize = $MORPH->inner3_equalize;

$inner4_chrome = $MORPH->inner4_chrome;
$inner4_module_inner = $MORPH->inner4_module_inner;
$inner4_modfx = $MORPH->inner4_modfx;
$inner4_equalize = $MORPH->inner4_equalize;

$inner5_chrome = $MORPH->inner5_chrome;
$inner5_module_inner = $MORPH->inner5_module_inner;
$inner5_modfx = $MORPH->inner5_modfx;
$inner5_equalize = $MORPH->inner5_equalize;

// Footer Block
$footer_wrap = $MORPH->footer_wrap;
$footer_type = $MORPH->footer_type;
$footer_chrome = $MORPH->footer_chrome;
$footer_module_inner = $MORPH->footer_module_inner;
$footer_gridsplit = $MORPH->footer_gridsplit;
$footer_equalize = $MORPH->footer_equalize;
$footer_modfx = $MORPH->footer_modfx;
$footer_credits_show = $MORPH->footer_credits_show;
$footer_credits = $MORPH->footer_credits;
$footer_copyright_show = $MORPH->footer_copyright_show;
$footer_copyright = $MORPH->footer_copyright;
$footer_morphlink = $MORPH->footer_morphlink;
$footer_validation = $MORPH->footer_validation;
$footer_textcolor = $MORPH->footer_textcolor;
$footer_linkscolor = $MORPH->footer_linkscolor;
$footer_show = $MORPH->footer_show;

//    Do not edit this line.
$sideBarsScheme = array (
    'default'=>      'content-sidebar'
);
$morph_settings = get_object_vars($MORPH);
foreach($morph_settings as $key=>$value) {
    if(substr($key,0,4)=='com_') $sideBarsScheme[$key] = $value;
}
?>
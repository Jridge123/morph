<?php defined( '_JEXEC' ) or die( 'Restricted access' );

// javascript arrays
$js_jquery = array($jquery_core, (bool)$tabscount, (bool)$accordionscount, $lazyload_enabled, $captions_enabled, $lightbox_enabled, $fontsizer_enabled, $shareit_enabled);
$js_jqueryui = array((bool)$tabscount, (bool)$accordionscount);
$js_cookie = array((bool)$tabscount, (bool)$accordionscount, $toolbar_slider, $topshelf1_slider, $topshelf2_slider, $topshelf3_slider, $bottomshelf1_slider, $bottomshelf2_slider, $bottomshelf3_slider, $developer_toolbar);
$js_slider = array($toolbar_slider, $topshelf1_slider, $topshelf2_slider, $topshelf3_slider, $bottomshelf1_slider, $bottomshelf2_slider, $bottomshelf3_slider);
$js_equalize = array($toolbar_equalize, $masthead_equalize, $subhead_equalize, $topnav_equalize, $topshelf1_equalize, $topshelf2_equalize, $topshelf3_equalize, $bottomshelf1_equalize, $bottomshelf2_equalize, $bottomshelf3_equalize, $user1_equalize, $user2_equalize, $inset1_equalize, $inset2_equalize, $inset3_equalize, $inset4_equalize, $outer1_equalize, $outer2_equalize, $outer3_equalize, $outer4_equalize, $outer5_equalize, $inner1_equalize, $inner2_equalize, $inner3_equalize, $inner4_equalize, $inner5_equalize, $footer_equalize);
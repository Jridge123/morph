<?php
$jquery_core = $_GET['A01'];
$topfish = $_GET['B01'];
$sidefish = $_GET['B02'];
$topdrop = $_GET['B03'];
$topnav_supersubs = $_GET['B04'];
$topnav_hoverintent = $_GET['B05'];
$topnav_hoverfocus = $_GET['B06'];
$topnav_minwidth = $_GET['B07'];
$topnav_maxwidth = $_GET['B08'];
$topnav_delay = $_GET['B09'];
$topnav_animation = $_GET['B10'];
$animate_left = $_GET['B11'];
$toolbar_slider = $_GET['C01'];
$topshelf_slider = $_GET['C02'];
$bottomshelf_slider = $_GET['C03'];
$toolbar_slider_text = $_GET['C04'];
$topshelf_slider_text = $_GET['C05'];
$bottomshelf_slider_text = $_GET['C06'];
$topshelf_equalize = $_GET['D01'];
$bottomshelf_equalize = $_GET['D02'];
$user1_equalize = $_GET['D03'];
$user2_equalize = $_GET['D04'];
$tabscount = $_GET['E01'];
$topshelfcount = $_GET['E02'];
$btmshelfcount = $_GET['E03'];
$user1count = $_GET['E04'];
$user2count = $_GET['E05'];
$roundedcount = $_GET['E06'];
$rounded_corners = $_GET['E07'];
$rounded_amount = $_GET['E08'];
$image_captions = $_GET['F01'];
$rounded_corners = $_GET['F02'];
$gzip_compression = $_GET['Z01'];
header("content-type: text/javascript; charset: UTF-8");
if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}
if ( $jquery_core == 1 ) { include('jquery-1.3.2.min.js'); }
if ( $tabscount >= 1 ) { include('jquery.ui.core.js'); include('jquery.ui.tabs.js'); }
if ( $tabscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1  ) { include('jquery.cookie.js'); }
if ( $rounded_corners == 1 ) { include('jquery.corners.js'); }
if ( $topnav_hoverintent == 1 ) { include("jquery.superfish.hoverintent.js"); }
if ( $sidefish >= 1 or $topfish >= 1 or $topdrop >= 1  ) { include('jquery.superfish.js'); }
if ( $topnav_supersubs == 1 ) { include("jquery.superfish.supersubs.js"); }
if ( $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 ) { include('jquery.slider.js'); }
if ( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1  ) { include('jquery.equalheights.js'); }
if ( $image_captions == 1 ) { include('jquery.captify.js'); }
include('template.js');
?>
(function($) {
	$(document).ready(function(){
<?php if ( $topshelf_equalize == 1 ) { ?>
		$(function(){ $('#topshelf .mod-grid').equalHeights(); });
<?php } if ( $bottomshelf_equalize == 1 ) { ?>
		$(function(){ $('#bottomshelf .mod-grid').equalHeights(); });
<?php } if ( $user1count > 1 && $user1_equalize == 1 ) { ?>
		$(function(){ $('#user1 .modinner').equalHeights(); });
<?php } if ( $user2count > 1 && $user2_equalize == 1 ) { ?>
		$(function(){ $('#user2 .mod').equalHeights(); });
<?php } if ( $topshelfcount > 1 && $topshelf_equalize == 1 ) { ?>
		$(function(){ $('#topshelf .modinner').equalHeights(); });
<?php } if ( $btmshelfcount > 1 && $bottomshelf_equalize == 1 ) { ?>
		$(function(){ $('#topshelf .mod').equalHeights(); });
<?php } if ( $rounded_corners == 1 or $roundedcount !== '0' ) { ?>
		$('.rounded h3').corners("10px top");
		$('blockquote.rounded').corners("<?php echo $rounded_amount; ?>");
		$('.mod.rounded').corners("<?php echo $rounded_amount; ?>");
		$('.mod.rounded div').corners("<?php echo $rounded_amount; ?>");
		$('.mod.rounded').corners("<?php echo $rounded_amount; ?>");
		$('.mod.rounded-top').corners("<?php echo $rounded_amount; ?> top");
		$('.mod.rounded-right').corners("<?php echo $rounded_amount; ?> right");
		$('.mod.rounded-bottom').corners("<?php echo $rounded_amount; ?> bottom");
		$('.mod.rounded-left').corners("<?php echo $rounded_amount; ?> left");
		$('.mod.rounded-top-left').corners("<?php echo $rounded_amount; ?> top left");
		$('.mod.rounded-top-right').corners("<?php echo $rounded_amount; ?> top right");
		$('.mod.rounded-bottom-left').corners("<?php echo $rounded_amount; ?> bottom left");
		$('.mod.rounded-bottom-right').corners("<?php echo $rounded_amount; ?> bottom");
		$('.left-pullquote').corners("10px");
		$('.right-pullquote').corners("10px");
		$('.quote-author').corners("10px bottom");
		$('.readon').corners("5px");
<?php } if ( $topfish >= 1  ) { ?>
		$("#nav .menu")<?php if ($topnav_supersubs == 1 ) { ?>.supersubs({
		 minWidth: <?php echo $topnav_minwidth; ?>,
		 maxWidth: <?php echo $topnav_maxwidth; ?>,
		 extraWidth: 1
		})<?php } ?>.superfish({
		 delay: <?php echo $topnav_delay; ?>,
		 animation: {opacity:'show'},
		 speed: '<?php echo $topnav_animation; ?>',
		 autoArrows: true,
		 dropShadows: false,
		 hoverClass: 'sfHover',
		 <?php if ($topnav_hoverintent == 0 ) { ?>disableHI: true<?php } else { ?>disableHI: false<?php } ?>
		 });
<?php } if ( $topdrop >= 1 ) { ?>
		$("#nav .menu").superfish({
			pathClass:  'current'
		});
<?php } ?>
<?php if ( $animate_left == 1 ) { ?>	
		$('#secondary-content ul.menu.slide li:not(.active) a, #tertiary-content ul.menu.slide li:not(.active) a').hoverIntent(function() { //mouse in  
		    $(this).animate({backgroundColor: "#fff"}, 100).animate({ paddingLeft: '18px' }, "normal");
			}, function() { // mouse out  
		     $(this).animate({ paddingLeft: '10px' }, "normal").animate({ backgroundColor: "#000" }, "slow");  
		  });
<?php } if ( $sidefish >= 1 ) { ?> 
	        $(".mod.sidefish ul.menu").superfish({ 
	            animation: {height:'show'},   // slide-down effect without fade-in 
	            delay:     1200               // 1.2 second delay on mouseout 
	        });    
<?php } if ( $toolbar_slider == 1 ) { ?>
   		initSlider('#toolbar', '<?php echo $toolbar_slider_text; ?>'); 
<?php } if ( $topshelf_slider == 1 ) { ?>
   		initSlider('#topshelf', '<?php echo $topshelf_slider_text; ?>');
<?php } if ( $bottomshelf_slider == 1 ) { ?>
	    initSlider('#bottomshelf', '<?php echo $bottomshelf_slider_text; ?>');	
<?php } if ( $topnav_hoverfocus == 1 ) { ?>
		$('#nav ul.menu ul').hover(
			function(){
				$('#user1').fadeTo("fast", "0.1");
			},
			function(){
				$('#user1').fadeTo("fast", "1");
			}
		);
<?php } if ( $image_captions == 1 ) { ?>
		$('img.captify').captify({});
<?php } if ( $toolbar_slider or $topshelf_slider or $bottomshelf_slider ) {
		include('jquery.slider.js'); ?>
<?php } if ( $tabscount > 0 ) { 
		for($n=1; $n <= $tabscount; $n++){
		echo "\n\t\t$('#tabs$n').tabs({fx: {opacity: 'toggle', duration: 1}, cookie: {expires: 7, path: '/'}});";
		}
} ?>
    })
})(jQuery);
<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
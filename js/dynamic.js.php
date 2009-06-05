<?php
$topshelf_equalize = $_GET['01'];
$bottomshelf_equalize = $_GET['02'];
$user1_equalize = $_GET['03'];
$user2_equalize = $_GET['04'];
$topshelfcount = $_GET['05'];
$btmshelfcount = $_GET['06'];
$user1count = $_GET['07'];
$user2count = $_GET['08'];
$sidefish = $_GET['09'];
$animate_left = $_GET['10'];
$rounded_corners = $_GET['12'];
$toolbar_slider = $_GET['13'];
$toolbar_slider_text = $_GET['14'];
$topshelf_slider = $_GET['15'];
$topshelf_slider_text = $_GET['16'];
$bottomshelf_slider = $_GET['17'];
$bottomshelf_slider_text = $_GET['18'];
$image_captions = $_GET['19'];
$topnav_hoverfocus = $_GET['20'];
$rounded_amount = $_GET['21'];
$gzip_compression = $_GET['22'];
$tabs_count = $_GET['23'];
$topnav_type = $_GET['24'];
$topnav_supersubs = $_GET['25'];
$topnav_minwidth = $_GET['26'];
$topnav_maxwidth = $_GET['27'];
$topnav_delay = $_GET['28'];
$topnav_animation = $_GET['29'];

header("content-type: text/javascript; charset: UTF-8");
if ( $gzip_compression == 1 ) {
ob_start("ob_gzhandler");
header("cache-control: must-revalidate");
$offset = 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header($expire);
}
?>
(function($) {
	$(document).ready(function(){
		$("#nav .menu li:last").addClass("action-link");
		$("#topnav.call-for-action li:last").prev("li").addClass("second-last")
		$("body").removeClass("js-disabled").addClass("js-enabled"); 
		$("input, textarea", $("form")).focus(function(){
	    $(this).addClass("focus");
	    $(this).parents(".form-field").addClass("cur");
		});
		$("input, textarea", $("form")).blur(function(){
		    $(this).removeClass("focus");
		    $(this).parents(".form-field").removeClass("cur");
		});
		$(".article-body p:first").addClass("teaser");
		$("#nav li:first").addClass("first");

		$(".sidenav li:first-child").each(function(){
			$(this).addClass("first");
		});
		$(".sidenav li:last-child").each(function(){
			$(this).addClass("last");
		});

		$("#secondary-content .module:first").addClass("firstmodule");
		$("#secondary-content .module:last").addClass("lastmodule");
		$("#tertiary-content .module:first").addClass("firstmodule");
		$(".article_separator:last").addClass("last");
		$('img[align*=right]').addClass("img-right");
		$('img[align*=left]').addClass("img-left");
		$("table tr:even").addClass("alt");
		
		$("#user1 .modinner").wrapInner("<div class='extra-border'></div>");
		$(".ui-tabs-panel").wrapInner("<div class='extra-box-border'></div>");		$(".ui-tabs-nav li").wrapInner("<span class='extra-tab-border'></span>");		$("input#mod_search_searchword").wrapInner("<div class='extra-search-border'></div>");
		
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
		
<?php } if ( $rounded_corners == 1 ) { ?>
		$('.mod.rounded h3').corners("10px top");
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
		$('.mod.rounded-bottom').corners("<?php echo $rounded_amount; ?> bottom");
		$('.left-pullquote').corners("10px");
		$('.right-pullquote').corners("10px");
		$('.quote-author').corners("10px bottom");
		$('.readon').corners("5px");

<?php } if ( $topnav_type == 1 or 2 ) { ?>	

		$("#nav .menu")<?php if ($topnav_supersubs == "1" ) { ?>.supersubs({
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
         disableHI: false
        })

<?php } if ( $animate_left == 1 ) { ?>	
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
		$('#nav ul.menu li.parent').hover(
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
		
<?php } if ( $tabs_count > 0 ) { 
		for($n=1; $n <= $tabs_count; $n++){
		echo "\n\t\t$('#tabs$n').tabs({fx: {opacity: 'toggle', duration: 1}, cookie: {expires: 7, path: '/'}});";
		}
} ?>

		$("#footer-links .fl-left li:last").addClass("fl-last");
		$("#footer-links .fl-right li:last").addClass("fl-last");	
    })
})(jQuery);
<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
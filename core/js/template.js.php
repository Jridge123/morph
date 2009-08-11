<?php
include '../jsvars.php';if ( $gzip_compression == 1 ) {
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}else{
		ob_start();
	}
	header("cache-control: must-revalidate");	$offset = 60 * 10000;	$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";	header($expire);
}
header("content-type: text/javascript; charset: UTF-8");
if($pack_js == 1){
	if ( $jquery_core == 1 ) { include('jquery-1.3.2.min.js'); }
	if ( $tabscount >= 1 or $accordionscount >= 1 ) { include('jquery.ui.core.js'); }
	if ( $tabscount >= 1 ) { include('jquery.ui.tabs.js'); }
	if ( $accordionscount >= 1 ) { include('jquery.ui.accordion.js'); }
	if ( $tabscount >= 1 or $accordionscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1  ) { include('jquery.cookie.js'); }
	if ( $rounded_corners == 1 or $roundedcount !== '0' ) { include('jquery.corners.js'); }
	if ( $topnav_hoverintent == 1 ) { include("jquery.superfish.hoverintent.js"); }
	if ( $sidefish >= 1 or $topfish >= 1 or $topdrop >= 1  ) { include('jquery.superfish.js'); }
	if ( $topnav_supersubs == 1 ) { include("jquery.superfish.supersubs.js"); }
	if ( $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 ) { include('jquery.slider.js'); }
	if ( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1 or $topleft_equalize == 1 ) { include('jquery.equalheights.js'); }
	if ( $plugin_scrollto == 1 ) { include('jquery.scrollTo-1.4.2-min.js'); }
	if ( $simpleticker == 1 ) { include('jquery.innerfade.js'); }
}
?>
jQuery.noConflict();
(function($) {
	$(document).ready(function(){
		$("#topnav.call-for-action li:last").addClass("action-link");
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
		$(".module-previews .mod:odd").addClass("alt");		
		$("#nav li:first").addClass("first");
		$(".sidenav li:first-child").each(function(){ $(this).addClass("first"); });
		$(".sidenav li:last-child").each(function(){ $(this).addClass("last"); });
		$("#secondary-content .module:first").addClass("firstmodule");
		$("#secondary-content .module:last").addClass("lastmodule");
		$("#tertiary-content .module:first").addClass("firstmodule");
		$(".article_separator:last").addClass("last");
		$('img[align*=right]').addClass("img-right");
		$('img[align*=left]').addClass("img-left");
		$("table tr:even").addClass("alt");
		$("#user1 .modinner").wrapInner("<div class='extra-border'></div>");
		$(".ui-tabs-panel").wrapInner("<div class='extra-box-border'></div>");
		$(".ui-tabs-nav li").wrapInner("<span class='extra-tab-border'></span>");
		$("input#mod_search_searchword").wrapInner("<div class='extra-search-border'></div>");
		$("#footer-links .fl-left li:last").addClass("fl-last");
		$("#footer-links .fl-right li:last").addClass("fl-last");	
	<?php if ( $plugin_scrollto == 1 ) { ?>
		$.fn.topLink = function(settings) {
			settings = jQuery.extend({
				min: 1,
				fadeSpeed: 200
			}, settings);
			
			return this.each(function() {
				//listen for scroll
				var el = $(this);
				el.hide(); //in case the user forgot
				$(window).scroll(function() {
					if($(window).scrollTop() >= settings.min) {
						el.fadeIn(settings.fadeSpeed);
					}else{
						el.fadeOut(settings.fadeSpeed);
					}
				});
			});
		};
		//usage w/ smoothscroll
		$('#top-link').topLink({ min: 400, fadeSpeed: 500 });
		$('#top-link').click(function(e){ $.scrollTo(0,300); return false; });
		
		<?php } if ( $topshelf_equalize == 1 ) { ?>
		$('#topshelf .mod-grid').equalHeights();
		
		<?php } if ( $bottomshelf_equalize == 1 ) { ?>
		$('#bottomshelf .mod-grid').equalHeights();
		
		<?php } if ( $user1count > 1 && $user1_equalize == 1 ) { ?>
		$('#user1 .modinner').equalHeights();
		
		<?php } if ( $user2count > 1 && $user2_equalize == 1 ) { ?>
		$('#user2 .modinner').equalHeights();
		
		<?php } if ( $topshelfcount > 1 && $topshelf_equalize == 1 ) { ?>
		$('#topshelf .modinner').equalHeights();
		
		<?php } if ( $btmshelfcount > 1 && $bottomshelf_equalize == 1 ) { ?>
		$('#btmshelf .modinner').equalHeights();
		
		<?php } if ( $topleft_equalize == 1 ) { ?>
		$('#topleft-grid div.modinner').equalHeights();
		
		<?php } if ( $rounded_corners == 1 or $roundedcount !== 0 ) { ?>
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
		})<?php } ?>
		.superfish({
			delay: <?php echo $topnav_delay; ?>,
			animation: {opacity:'show'},
			speed: '<?php echo $topnav_animation; ?>',
			autoArrows: true,
			dropShadows: false,
			hoverClass: 'sfHover',
 			<?php if ($topnav_hoverintent == 0 ) { ?>disableHI: true<?php } else { ?>disableHI: false<?php } ?>
		});
		<?php } if ( $topdrop >= 1 ) { ?>
		$("#nav .menu").superfish({ pathClass:  'active' });
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
	    
	    <?php } if ( $simpleticker == 1 ) { ?>
	    <!--$("#news").newsTicker('<?php echo $tickerdelay; ?>');-->
	     $('#news').innerfade({ animationtype: 'slide', speed: 750, timeout: 2000, type: 'random', containerheight: '1em' }); 
	    
		<?php } if ( $toolbar_slider == 1 ) { ?>
   		initSlider('#toolbar', '<?php echo $toolbar_slider_text; ?>'); 
		<?php } if ( $topshelf_slider == 1 ) { ?>
   		initSlider('#topshelf', '<?php echo $topshelf_slider_text; ?>');
		<?php } if ( $bottomshelf_slider == 1 ) { ?>
	    initSlider('#bottomshelf', '<?php echo $bottomshelf_slider_text; ?>');	
		<?php } if ( $topnav_hoverfocus == 1 ) { ?>
		$('#nav ul.menu ul').hover( function(){ $('#user1').fadeTo("fast", "0.1");},function(){	$('#user1').fadeTo("fast", "1"); } );
		<?php } if ( $toolbar_slider or $topshelf_slider or $bottomshelf_slider ) {
		include('jquery.slider.js'); ?>
		<?php } if ( $tabscount > 0 ) { 
		for($n=1; $n <= $tabscount; $n++){
		echo "\n\t\t$('#tabs$n').tabs({fx: {opacity: 'toggle', duration: 1}, cookie: {expires: 7, path: '/'}});";
		}
		} if ( $accordionscount > 0 ) { 
		for($n=1; $n <= $accordionscount; $n++){
			//echo "\n\t\t$('#accordions$n').accordion({fx: {opacity: 'toggle', duration: 1}});";
			echo "\n\t\t".'
			var index'.$n.' = $.cookie("accordion'.$n.'");
        	var active'.$n.';
        	if (index'.$n.' !== undefined) {
                active'.$n.' = $("#accordions'.$n.'").find("h3:eq(" + index'.$n.' + ")");
        	}			
			$("#accordions'.$n.'").accordion({
			    header: "h3",
			    active: active'.$n.',
			    change: function(event, ui) {
		            var index'.$n.' = $(this).find("h3").index ( ui.newHeader[0] );
		           	$.cookie("accordion1", index'.$n.');
			    }
			}); '; 
		}
		}?>
    })
})(jQuery);
<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
<?php
define('DS', DIRECTORY_SEPARATOR);
include '../jsvars.php';
if ( $gzip_compression == 1 ) {
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}else{
		ob_start();
	}
	header("cache-control: must-revalidate");
	$offset = 60 * 10000;
	$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
	header($expire);
}
header("content-type: text/javascript; charset: UTF-8");
define('JPATH', str_replace('templates'.DS.'morph'.DS.'core'.DS.'js', '', dirname(__FILE__)).DS);

if($pack_js == 1){
	if ( $jquery_core == 1 ) { include('jquery.js');echo"\n"; }
	if ( $tabscount >= 1 or $accordionscount >= 1 ) { include('ui.js');echo"\n"; }
	if ( $tabscount >= 1 ) { include('tabs.js');echo"\n"; }
	if ( $accordionscount >= 1 ) { include('accordion.js');echo"\n"; }
	if ( $tabscount >= 1 or $accordionscount >= 1 or $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 or $developer_toolbar == 1  ) { include('cookie.js');echo"\n"; }
	if ( $rounded_corners == 1 or $roundedcount !== '0' ) { include('corners.js');echo"\n"; }
	if ( $topnav_hoverintent == 1 ) { include("hoverintent.js");echo"\n"; }
	if ( $sidefish >= 1 or $topfish >= 1 or $topdrop >= 1  ) { include('superfish.js');echo"\n"; }
	if ( $topnav_supersubs == 1 ) { include("supersubs.js");echo"\n"; }
	if ( $toolbar_slider == 1 or $topshelf_slider == 1 or $bottomshelf_slider == 1 ) { include('slider.js');echo"\n"; }
	if ( $topshelf_equalize == 1  or $bottomshelf_equalize == 1  or $user1_equalize == 1  or $user2_equalize == 1 or $topleft_equalize == 1 ) { include('equalheights.js');echo"\n"; }
	if ( $plugin_scrollto == 1 ) { include('scrollto.js');echo"\n"; }
	if ( $simpleticker == 1 ) { include('innerfade.js');echo"\n"; }
	if ( $simpletweet == 1 ) { include('..'.DS.'..'.DS.'..'.DS.'..'.DS.'modules'.DS.'mod_simpletweet'.DS.'js'.DS.'simpletweet.js');echo"\n"; }
	if ( $google_analytics !== '' ) { include('googleanalytics.js');echo"\n";}
	if ( $captions_enabled == 1 ) { include('captify.js');echo"\n";}
	include('fontsizer.js');
}
?>
jQuery.noConflict();
(function($) {
	$(document).ready(function(){
		$('#gcf_placeholder').css('z-index','9999');
		$("#topnav.call-for-action li:last").addClass("action-link");
		$("#topnav.call-for-action li:last").prev("li").addClass("second-last");
		
		$("body").removeClass("js-disabled").addClass("js-enabled");
		
		$("input, textarea", $("form")).focus(function(){
			$(this).addClass("focus");
			$(this).parents(".form-field").addClass("cur");
		});
		$("input, textarea", $("form")).blur(function(){
		    $(this).removeClass("focus");
		    $(this).parents(".form-field").removeClass("cur");
		});
		
		$(".search-results li:odd").addClass("alt");
				
		$("#article-content p:first").addClass("teaser");
		
		$(".module-previews .mod:odd").addClass("alt");		
		$("#nav li:first").addClass("first");
		$(".sidebar li:first-child").each(function(){ $(this).addClass("first"); });
		$(".sidebar li:last-child").each(function(){ $(this).addClass("last"); });

		$("#footer-links .fl-left li:last").addClass("fl-last");
		$("#footer-links .fl-right li:first").addClass("fl-first");		
		$("#footer-links .fl-right li:last").addClass("fl-last");		
		
		$(".ui-tabs-nav li:first-child").each(function(){ $(this).addClass("first"); });
		
		$("#secondary-content.sidebar .mod:first").addClass("firstmodule");
		$("#tertiary-content.sidebar .mod:first").addClass("firstmodule");

		$("#secondary-content.sidebar .mod:last").addClass("lastmodule");
		$("#tertiary-content.sidebar .mod:last").addClass("lastmodule");

		$(".article_separator:last").addClass("last");
		
		$('img[align*=right]').addClass("img-right");
		$('img[align*=left]').addClass("img-left");
		
		$("table tr:even").addClass("alt"); 
    
    	<?php if ( $captions_enabled == 1 ) { ?>
    	$('img.caption').captify({
    		speedOver: '<?php echo $captions_speedover; ?>',
    		speedOut: '<?php echo $captions_speedout; ?>',
    		hideDelay: '<?php echo $captions_delay; ?>',	
    		animation: '<?php echo $captions_animation; ?>',		
    		opacity: '<?php echo $captions_opacity; ?>',					
    		position: '<?php echo $captions_position; ?>',
    		spanWidth: '100%'
    		<?php if($captions_prefix) { ?>prefix: '<?php echo $captions_prefix; ?>',<?php } ?>});
    	$('.caption-wrapper img[align*=right]').removeAttr('align').parent().addClass('img-right').css('float','right');
		$('.caption-wrapper img[align*=left]').removeAttr('align').parent().addClass('img-left').css('float','left');
		<?php } ?>			
		
	//grab all the anchor tag with rel set to shareit
	$('a[rel=shareit], #shareit-box').mouseenter(function() {		
		
		//get the height, top and calculate the left value for the sharebox
		var height = $(this).height();
		var top = $(this).offset().top;
		
		//get the left and find the center value
		var left = $(this).offset().left + ($(this).width() /2) - ($('#shareit-box').width() / 2);		
		
		//grab the href value and explode the bar symbol to grab the url and title
		//the content should be in this format url|title
		var value = $(this).attr('href').split('|');
		
		//assign the value to variables and encode it to url friendly
		var field = value[0];
		var url = encodeURIComponent(value[0]);
		var title = encodeURIComponent(value[1]);
		
		//assign the height for the header, so that the link is cover
		$('#shareit-header').height(height);
		
		//display the box
		$('#shareit-box').show();
		
		//set the position, the box should appear under the link and centered
		$('#shareit-box').css({'top':top, 'left':left});
		
		//assign the url to the textfield
		$('#shareit-field').val(field);
		
		//make the bookmark media open in new tab/window
		$('a.shareit-sm').attr('target','_blank');
				
		//Setup the bookmark media url and title
		$('a[rel=shareit-facebook]').attr('href', 'http://www.facebook.com/sharer.php?u=' + url);
		$('a[rel=shareit-delicious]').attr('href', 'http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url=' + url + '&title=' + title);
		$('a[rel=shareit-designfloat]').attr('href', 'http://www.designfloat.com/submit.php?url='  + url + '&amp;title=' + title);
		$('a[rel=shareit-digg]').attr('href', 'http://digg.com/submit?phase=2&amp;url=' + url + '&amp;title=' + title);
		$('a[rel=shareit-stumbleupon]').attr('href', 'http://www.stumbleupon.com/submit?url=' + url + '&title=' + title);
		$('a[rel=shareit-twitter]').attr('href', 'http://twitter.com/home?status=' + url + '%20-%20' + title);
		
	});

	//onmouse out hide the shareit box
	$('#shareit-box').mouseleave(function () {
		$('#shareit-field').val('');
		$(this).hide();
	});
	
	//hightlight the textfield on click event
	$('#shareit-field').click(function () {
		$(this).select();
	});
		
		
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
		$('#top-link').topLink({ min: 400, fadeSpeed: 500 }); // fade in link
		$('#top-link').click(function(e){ $.scrollToTop(0,300); e.preventDefault(); return false; });
	<?php } ?>	
		
	    fontSize("#fontsizer", "#article", 9, 12, 20);

		<?php if ( $toolbar_equalize == 1 ) { ?>$('#toolbar .modinner').equalHeights();
		<?php } if ( $masthead_equalize == 1 ) { ?>$('#masthead .modinner').equalHeights();
		<?php } if ( $subhead_equalize == 1 ) { ?>$('#subhead .modinner').equalHeights();
		<?php } if ( $topnav_equalize == 1 ) { ?>$('#topnav .modinner').equalHeights();
		<?php } if ( $topshelf_equalize == 1 ) { ?>$('#topshelf .modinner').equalHeights();
		<?php } if ( $bottomshelf_equalize == 1 ) { ?>$('#bottomshelf .modinner').equalHeights();
		<?php } if ( $user1_equalize == 1 ) { ?>$('#user1 .modinner').equalHeights();
		<?php } if ( $user2_equalize == 1 ) { ?>$('#user2 .modinner').equalHeights();
		<?php } if ( $inset1_equalize == 1 ) { ?>$('#inset1 .modinner').equalHeights();
		<?php } if ( $inset2_equalize == 1 ) { ?>$('#inset2 .modinner').equalHeights();
		<?php } if ( $inset3_equalize == 1 ) { ?>$('#inset3 .mod-grid').equalHeights();
		<?php } if ( $inset4_equalize == 1 ) { ?>$('#inset4 .mod-grid').equalHeights();
		<?php } if ( $splitleft_equalize == 1 ) { ?>$('#splitleft-grid div.modinner').equalHeights();
		<?php } if ( $topleft_equalize == 1 ) { ?>$('#topleft-grid div.modinner').equalHeights();
		<?php } if ( $left_equalize == 1 ) { ?>$('#left-grid div.modinner').equalHeights();
		<?php } if ( $bottomleft_equalize == 1 ) { ?>$('#bottomleft-grid div.modinner').equalHeights();
		<?php } if ( $splitright_equalize == 1 ) { ?>$('#splitright-grid div.modinner').equalHeights();
		<?php } if ( $topright_equalize == 1 ) { ?>$('#topright-grid div.modinner').equalHeights();
		<?php } if ( $right_equalize == 1 ) { ?>$('#right-grid div.modinner').equalHeights();
		<?php } if ( $bottomright_equalize == 1 ) { ?>$('#bottomright-grid div.modinner').equalHeights();
		<?php } if ( $footer_equalize == 1 ) { ?>$('#footer-grid div.modinner').equalHeights();
		
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
		$("#nav .menu").superfish({ pathClass: 'active' });
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
	     $('#news').innerfade({ animationtype: 'fade', speed: 750, timeout: 9000, type: 'random', containerheight: '1em' }); 
	    
		<?php } if ( $toolbar_slider == 1 ) { ?>
   		initSlider('#toolbar', '<?php echo $toolbar_slider_text; ?>'); 
		<?php } if ( $topshelf_slider == 1 ) { ?>
   		initSlider('#topshelf', '<?php echo $topshelf_slider_text; ?>');
		<?php } if ( $bottomshelf_slider == 1 ) { ?>
	    initSlider('#bottomshelf', '<?php echo $bottomshelf_slider_text; ?>');	
		<?php } if ( $topnav_hoverfocus == 1 ) { ?>
		$('#nav ul.menu ul').hover( function(){ $('#user1').fadeTo("fast", "0.1");},function(){	$('#user1').fadeTo("fast", "1"); } );
		<?php } if ( $toolbar_slider or $topshelf_slider or $bottomshelf_slider ) {
		include('slider.js'); ?>
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
			    collapsible: true,
			    active: active'.$n.',
			    change: function(event, ui) {
		            var index'.$n.' = $(this).find("h3").index ( ui.newHeader[0] );
		           	$.cookie("accordion1", index'.$n.');
			    }
			}); '; 
		    }
		}
		if($themelet_js == 1){
		    include('..'.DS.'..'.DS.'..'.DS.'..'.DS.'morph_assets'.DS.'themelets'.DS.$themelet.DS.'js'.DS.'themelet.js');echo"\n";
		} 
		if($custom_js == 1){
		    include('..'.DS.'..'.DS.'..'.DS.'..'.DS.'morph_assets'.DS.'themelets'.DS.$themelet.DS.'js'.DS.'custom.js');echo"\n";
		} ?>
		<?php if($developer_toolbar==1){ ?>
			$('#dev-toolbar a').click(function(){ return false; });
			$('#dev-toolbar li strong.tool-label').each(function(){
				$this = $(this);
				$this.mouseover(function(){
					$(this).next().fadeIn();
				})
				.mouseout(function(){
					$(this).next().fadeOut();
				});
			})
			$('#dev-toolbar li.dev-css a').click(function(){
				if($(this).hasClass('dev-unpack-css')){ $.cookie('unpackcss', 'true'); window.location.reload(true); }
				if($(this).hasClass('dev-pack-css')){ $.cookie('unpackcss', null); window.location.reload(true); }
			});
			$('#dev-toolbar li.dev-js a').click(function(){
				if($(this).hasClass('dev-unpack-js')){ $.cookie('unpackjs', 'true'); window.location.reload(true); }
				if($(this).hasClass('dev-pack-js')){ $.cookie('unpackjs', null); window.location.reload(true); }
			});
			$('#dev-toolbar li.dev-modules a').click(function(){
				if($(this).hasClass('dev-debug-mods-on')){ $.cookie('debug_modules', 'true'); window.location.reload(true); }
				if($(this).hasClass('dev-debug-mods-off')){ $.cookie('debug_modules', null); window.location.reload(true); }
			});
			$('#dev-toolbar li.dev-gzip a').click(function(){
				if($(this).hasClass('dev-gzip-off')){ $.cookie('nogzip', 'off'); window.location.reload(true); }
				if($(this).hasClass('dev-gzip-on')){ 
					$.cookie('nogzip', null);
					var thisUrl = location.href;
					var q = '';
					if(thisUrl.indexOf('?')!=-1){ q='&'; }else{ q='?'; }
					$.ajax({
						url: thisUrl+q+'gzip=on',
						success: function(){
							window.location.reload(true);
							return true;
						}
					});
				}
			});
			$('#dev-toolbar li.dev-fb a').click(function(){
				if($(this).hasClass('dev-fb-on')){ $.cookie('firebug', 'enabled'); window.location.reload(true); }
				if($(this).hasClass('dev-fb-off')){ $.cookie('firebug', null); window.location.reload(true); }
			});
		<?php }?>
    });
})(jQuery);
<?php if ( $gzip_compression == 1 ) { ob_end_flush(); } ?>
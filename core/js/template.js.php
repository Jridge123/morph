<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
/**
 * Prevent errors from Mootools scripts
 * 
 * Whenever we replace stuff like joomlas core tooltips,
 * or tabs and like, scripts added to the head by joomla is unesseccary and can cause errors.
 * The following code will only execute if MooTools isn't loaded,
 * and will prevent the most common errors.
 *
 */
if(typeof MooTools == 'undefined')
{
	var $lambda = function(){};
	window.addEvent = Class = Events = Options = $lambda;
	Class.prototype.implement = $lambda;
}

(function(){
	
	var rscript = /<script(.|\s)*?\/script>/gi,
		rselectTextarea = /select|textarea/i,
		rinput = /color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week/i,
		jsre = /=\?(&|$)/,
		rquery = /\?/,
		rts = /(\?|&)_=.*?(&|$)/,
		rurl = /^(\w+:)?\/\/([^\/?#]+)/,
		r20 = /%20/g,
	
		// Keep a copy of the old load method
		_load = jQuery.fn.load;

	/**
	 * Fixing error in .load when MooTools is loaded
	 * 
	 * jQuery("<div />").append(res.responseText.replace(rscript, "")).find(selector)
	 * fails because MooTools replaces Element.getElementById and others,
	 * And calls them on the document object instead internally.
	 * Since the html is in a variable and not in the document,
	 * the .find(selector) will fail terribly and return nothing.
	 * The fix is to call jQuery("<div />").hide().appendTo(document.body).append(res.responseText.replace(rscript, "")).find(selector)
	 * .hide() makes sure the ajax fetched content are invisible,
	 * and .append(document.body) makes sure the html elements are inside the document.
	 * That way it works, even when MooTools overrides those methods.
	 *
	 */
	jQuery.fn.extend({
		load: function( url, params, callback ) {
			if ( typeof url !== "string" ) {
				return _load.call( this, url );
		
			// Don't do a request if no elements are being requested
			} else if ( !this.length ) {
				return this;
			}
		
			var off = url.indexOf(" ");
			if ( off >= 0 ) {
				var selector = url.slice(off, url.length);
				url = url.slice(0, off);
			}
		
			// Default to a GET request
			var type = "GET";
		
			// If the second parameter was provided
			if ( params ) {
				// If it's a function
				if ( jQuery.isFunction( params ) ) {
					// We assume that it's the callback
					callback = params;
					params = null;
		
				// Otherwise, build a param string
				} else if ( typeof params === "object" ) {
					params = jQuery.param( params, jQuery.ajaxSettings.traditional );
					type = "POST";
				}
			}
		
			var self = this;
		
			// Request the remote document
			jQuery.ajax({
				url: url,
				type: type,
				dataType: "html",
				data: params,
				complete: function( res, status ) {
					// If successful, inject the HTML into all the matched elements
					if ( status === "success" || status === "notmodified" ) {
						// See if a selector was specified
						self.html( selector ? jQuery("<div />").hide().appendTo(document.body).append(res.responseText.replace(rscript, "")).find(selector) : res.responseText );
					}
		
					if ( callback ) {
						self.each( callback, [res.responseText, status, res] );
					}
				}
			});
		
			return this;
		}
	});
})();

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
		
		$(".search-results li:odd, .module-previews .mod:odd, table tr:even").addClass("alt");
		
		<?php if ( $this->js->teaser_enabled == 1 ) { ?>	
		$("#article-content p:first").addClass("teaser");
		<?php } ?>
		
		$("#nav li:first, .sidebar li:first-child, .ui-tabs-nav li:first-child").addClass("first");
		$(".sidebar li:last-child, .article_separator:last").addClass("last");

		$("#footer-links .fl-left li:last, #footer-links .fl-right li:last").addClass("fl-last");
		$("#footer-links .fl-right li:first").addClass("fl-first");		
				
		$("#secondary-content.sidebar .mod:first, #tertiary-content.sidebar .mod:first").addClass("firstmodule");

		$("#secondary-content.sidebar .mod:last, #tertiary-content.sidebar .mod:last").addClass("lastmodule");
		
		$('img[align*=right]').addClass("img-right");
		$('img[align*=left]').addClass("img-left");
		
    	<?php if ( $this->js->captions_enabled == 1 ) { ?>
    	$('img.caption').captify(<?php echo json_encode(array_filter(array(
    		'speedOver' => $this->js->captions_speedover,
    		'speedOut' => $this->js->captions_speedout,
    		'hideDelay' => $this->js->captions_delay,
    		'animation' => $this->js->captions_animation,
    		'opacity' => $this->js->captions_opacity,
    		'position' => $this->js->captions_position,
    		'spanWidth' => '100%',
    		'prefix' => $this->js->captions_prefix
    	))) ?>);
		$('#primary-content img.img-left.caption').parent('span').css({'margin-right' : '20px', 'float' : 'left'});
		$('#primary-content img.img-right.caption').parent('span').css({'margin-left' : '20px', 'float' : 'right'});		
    	<?php } if ( $this->js->lazyload_enabled == 1 ) { ?>
    	if (!navigator.userAgent.toLowerCase().match('ipad')) {   	
		$("#primary-content img").lazyload(<?php echo json_encode(array(
			'placeholder' => 'img/grey.gif',
			'effect' => 'fadeIn'
		)) ?>);
		}
		
    	<?php } if ( $this->js->lightbox_enabled == 1 ) { ?>
        
        	$("a[rel='lightbox']").colorbox();
			$(".video").colorbox(<?php echo json_encode(array('iframe' => true, 'innerWidth' => 425, 'innerHeight' => 344)) ?>); 
		
			<?php if ( $this->js->disable_scrollbar == 1 ) { ?>
			$().bind('cbox_open', function(){
			    $('body').css({overflow:'hidden'});
			}).bind('cbox_closed', function(){
			    $('body').css({overflow:'auto'});
			}); 
			<?php } ?>
			
			<?php if ( $this->js->article_preview == 1 ) { ?>
			$("#primary-content p.readon a.preview-link").removeClass("preview-disabled").addClass("preview-enabled");
			$("#primary-content a[rel='article-preview']").click(function(){
			    var url = $(this).attr('href');
			     $.fn.colorbox({href: url + " div.article-page", width:700, height:600});
			    return false;
			});
			<?php } ?>
			   
        <?php } ?>
        
    
    <?php if ( $this->js->shareit_enabled == 1 ) { ?>    		
	//grab all the anchor tag with rel set to shareit
	$('a[rel=shareit]').mouseenter(function() {		
		
		//get the height, top and calculate the left value for the sharebox
		var height = $(this).height();
		var top = $(this).offset().top;
		
		//get the left and find the center value
		var left = $(this).offset().left + ($(this).width() /2) - ($('#shareit-box').width() / 2);		
		
		//grab the href value and explode the bar symbol to grab the url and title
		//the content should be in this format url|title
		var value = [$(this).attr('href'), $(this).attr('title')];
		
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
	<?php } ?>
		
		
	<?php if ( $this->js->plugin_scrollto == 1 ) { ?>
	$.fn.topLink=function(s){s=jQuery.extend({min:400,fadeSpeed:500},s);return this.each(function(){var e=$(this).hide().click(function(){$.scrollToTop(0,300);return false;})
	$(window).scroll(function(){if($(window).scrollTop()>=s.min){e.fadeIn(s.fadeSpeed);}else{e.fadeOut(s.fadeSpeed);}});});};
	$('#top-link').topLink();
	<?php } ?>	
		
		<?php if ( $this->js->fontsizer_enabled == 1 ) { ?>
		fontSize("#fontsizer", "#article", 9, 12, 20);
		<?php } ?>
	    <?php 
	    	$js_equalizers = array('toolbar', 'masthead', 'subhead', 'topnav', 'topshelf1', 'topshelf2', 'topshelf3', 'bottomshelf1', 'bottomshelf2', 'bottomshelf3', 'user1', 'user2', 'inset1', 'inset2', 'inset3', 'inset4', 'outer1-grid', 'outer2-grid', 'outer3-grid', 'outer4-grid', 'outer5-grid', 'inner1-grid', 'inner2-grid', 'inner3-grid', 'inner4-grid', 'inner5-grid', 'footer-grid');
	    	$equalizers = array();
	    	foreach($js_equalizers as $equalize)
	    	{
	    		$name = str_replace('-grid', '', $equalize);
	    		if(!$this->js->{$name.'_equalize'}) continue;
	    		$in_array = in_array($equalize, array('inset3', 'inset4'));
	    		$child = !$in_array ? 'modinner' : 'mod-grid';
	    		$equalizers[] = '$(\'#'.$equalize.' .'.$child.'\').equalHeights();';
	    	}
	    ?>
		<?php echo implode($equalizers) ?>
		<?php if ( $this->js->topfish >= 1  ) { ?>
		$("#topnav .menu, #masthead .menu")<?php if ($this->js->topnav_supersubs == 1 ) { ?>.supersubs({
			minWidth: <?php echo $this->js->topnav_minwidth; ?>,
		 	maxWidth: <?php echo $this->js->topnav_maxwidth; ?>,
		 	extraWidth: 1
		})<?php } ?>
		.superfish({
			<?php if($this->js->topnav_delay != ''){ ?>delay:<?php echo $this->js->topnav_delay; ?>,<?php } ?>
			animation: {opacity:'show'},
			<?php if($this->js->topnav_animation != ''){ ?>speed: '<?php echo $this->js->topnav_animation; ?>',<?php } ?>
			autoArrows: true,
			dropShadows: false,
			hoverClass: 'sfHover',
 			disableHI: <?php echo json_encode(!$this->js->topnav_hoverintent) ?>
		});
		<?php } if ( $this->js->topdrop >= 1 ) { ?>
		$("#topnav .menu, #masthead .menu").superfish({pathClass:'active'});
		<?php } if ( $this->js->sidefish >= 1 ) { ?> 
	    $(".mod.sidefish ul.menu").superfish({ 
	    	animation: {height:'show'},   // slide-down effect without fade-in 
	    	delay:     1200               // 1.2 second delay on mouseout 
	    });
	    
	    <?php } if ( $this->js->simpleticker == 1 ) { ?>
	    <?php /* $("#news").newsTicker('<?php echo $this->js->tickerdelay; ?>');*/ ?>
	     $('#news').innerfade({ animationtype: 'fade', speed: 750, timeout: 9000, type: 'random', containerheight: '1em' }); 
	    
		<?php } if ( $this->js->toolbar_slider == 1 ) { ?>
   		initSlider('#toolbar', '<?php echo $this->js->toolbar_slider_text; ?>'); 
		<?php } if ( $this->js->topshelf1_slider == 1 ) { ?>
   		initSlider('#topshelf1', '<?php echo $this->js->topshelf1_slider_text; ?>');
   		<?php } if ( $this->js->topshelf2_slider == 1 ) { ?>
   		initSlider('#topshelf2', '<?php echo $this->js->topshelf2_slider_text; ?>');
   		<?php } if ( $this->js->topshelf3_slider == 1 ) { ?>
   		initSlider('#topshelf3', '<?php echo $this->js->topshelf2_slider_text; ?>');
		<?php } if ( $this->js->bottomshelf1_slider == 1 ) { ?>
	    initSlider('#bottomshelf1', '<?php echo $this->js->bottomshelf1_slider_text; ?>');	
		<?php } if ( $this->js->bottomshelf1_slider == 1 ) { ?>
		initSlider('#bottomshelf2', '<?php echo $this->js->bottomshelf2_slider_text; ?>');	
		<?php } if ( $this->js->bottomshelf3_slider == 1 ) { ?>
		initSlider('#bottomshelf3', '<?php echo $this->js->bottomshelf3_slider_text; ?>');	
		<?php } if ( $this->js->topnav_hoverfocus == 1 ) { ?>		
		$('#nav ul.menu ul').hover( function(){ $('#<?php echo $this->js->topnav_hoverfocus_block; ?>').fadeTo("fast", "0.1");},function(){	$('#<?php echo $this->js->topnav_hoverfocus_block; ?>').fadeTo("fast", "1"); } );
		<?php } if ( $this->js->tabscount > 0 ) { ?>
		var taboptions = {fx:{opacity:'toggle',duration: 1},cookie:{expires:7,path:'/'}};
		<?php foreach(range(1, $this->js->tabscount) as $n){ ?>
		$('#tabs<?php echo $n ?>').tabs(taboptions);
		<?php }
		} if ( $this->js->accordionscount > 0 ) {  ?>
		
		<?php foreach(range(1, $this->js->accordionscount) as $n){ ?>
		var index<?php echo $n ?> = $.cookie("accordion<?php echo $n ?>") || 0,
			active<?php echo $n ?> = (index<?php echo $n ?> !== undefined) ? $("#accordions<?php echo $n ?>").find("h3:eq(" + index<?php echo $n ?> + ")") : false;
		$("#accordions<?php echo $n ?>").accordion({
			header: "h3",
			autoHeight: false,
			collapsible: true,
			active: active<?php echo $n ?>,
			change: function(event, ui) {
				index<?php echo $n ?> = $(this).find("h3").index ( ui.newHeader[0] );
				$.cookie("accordion1", index<?php echo $n ?>);
			}
		});
		<?php }
		} ?>
		<?php if($this->js->developer_toolbar == 1){ ?>
			$('#dev-toolbar a').click(function(){ return false; });
			$('#dev-toolbar li strong.tool-label').each(function(){
				$this = $(this);
				$this.mouseover(function(){
					$(this).next().next().fadeIn();
				})
				.mouseout(function(){
					$(this).next().next().fadeOut();
				});
			})
			$('#dev-toolbar li.dev-css a').click(function(){
				$.get('', {'morph[pack_css]': $(this).hasClass('dev-pack-css') ? 1 : 0}, function(){window.location.reload(true);} );
			});
			$('#dev-toolbar li.dev-js a').click(function(){
				$.get('', {'morph[pack_js]': $(this).hasClass('dev-pack-js') ? 1 : 0}, function(){window.location.reload(true);} );
			});
			$('#dev-toolbar li.dev-modules a').click(function(){
				if($(this).hasClass('dev-debug-mods-on')){ $.cookie('debug_modules', 'true'); window.location.reload(true); }
				if($(this).hasClass('dev-debug-mods-off')){ $.cookie('debug_modules', 'false'); window.location.reload(true); }
			});
			$('#dev-toolbar li.dev-gzip a').click(function(){
				
				$.get('', {'morph[gzip_compression]': $(this).hasClass('dev-gzip-on') ? 1 : 0}, function(){window.location.reload(true);} );
			});
			$('#dev-toolbar li.dev-fb a').click(function(){
				if($(this).hasClass('dev-fb-on')){ $.cookie('firebug', 'enabled'); window.location.reload(true); }
				if($(this).hasClass('dev-fb-off')){ $.cookie('firebug', null); window.location.reload(true); }
			});
			$('#dev-toolbar li.dev-cache a').click(function(){
				$.ajax({
					data: {empty:'cache'},
					success: function(){
						window.location.reload(true);
						return true;
					}
				});
			});
			$('#dev-toolbar li.dev-nojs a').click(function(){
				if($(this).hasClass('dev-nojs-on')){ $.cookie('nojs', 'enabled'); }
				if($(this).hasClass('dev-nojs-off')){ $.cookie('nojs', null); }
				$.get('', {'jsoff': 1}, function(){window.location.reload(true);} );
			});
			$('#dev-toolbar li.dev-close a').click(function(){
			 	$.get('', {'hidedev': 0}, function(){window.location.reload(true);} );
			});
		<?php }?>
<?php
if($this->js->custom_js)
{
	echo PHP_EOL.'/* @group Custom Themelet JS */'.PHP_EOL;
	echo $this->js->custom_js;
	echo PHP_EOL.' /* @end */ '.PHP_EOL;
}
foreach($this->js->scriptsAfter as $js => $type)
{
	echo file_get_contents(JPATH_ROOT.$js);
} ?>
	});
})(jQuery);
<?php /* use Morph::getInstance()->addScriptDeclaration() to output here */ ?>
<?php echo $this->js->scriptDeclarations ?>
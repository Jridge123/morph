/**
 * @version		$Id: k2.js 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		MegaMenu, for the Morph Template framework
 * @author      ProThemer http://prothemer.com
 * @copyright	Copyright (c) 2010 ProThemer. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function($){
	$.fn.megamenu = function(container, options){

		if(!container.jquery) var container = $(container);

		
		var self = this, prev = container.prev(), sandbox;
		//Get the previous item, in case it's also a sibling megamenu panel
		if(prev.length && prev.data('megamenu')) {
			sandbox = prev;
		} else {
			sandbox = $('<div />', {css: {position: 'relative'}}).data('megamenu', true);
		}
		
		//Our nice animation requires a sandbox
		container.replaceWith(sandbox).appendTo(sandbox);
		
		//This should be done by pure css, it's to avoid jumpy animations caused by children padding
		container.css('overflow', 'hidden');
		
		container.bind('toggleMegaMenu', function(){
			if(container.data('activeMegaMenu')) {
				container.trigger('closeMegaMenu').data('activeMegaMenu', false);
			} else {
				var siblings = container.siblings('.active');
				if(siblings.length) {
					//sandbox.css('height', sandbox.height());
					sandbox.animate({height: container.height()}, 'slow', function(){
						sandbox.css('height', '');
					});
					var offset = siblings.offset();
					siblings.css({
						position: 'absolute',
						left: offset.left,
						top: 0
					}).trigger('fadeOutMegaMenu').data('activeMegaMenu', false);
					
					container.trigger('fadeInMegaMenu').data('activeMegaMenu', true);
				} else {
					container.trigger('openMegaMenu').data('activeMegaMenu', true);
				}
			}
		});
		container.bind('openMegaMenu', function(){
			self.addClass('active');
			container.addClass('active').animate({
				height: 'show',
				opacity: 'show'
			}, 'slow');
		});
		container.bind('closeMegaMenu', function(){
			self.removeClass('active');
			container.removeClass('active').animate({
				height: 'hide',
				opacity: 'hide'
			}, 'slow', function(){
				container.css('position', 'static');
			});
		});
		container.bind('fadeInMegaMenu', function(){
			self.addClass('active');
			container.addClass('active').animate({
				opacity: 'show'
			}, 'slow');
		});
		container.bind('fadeOutMegaMenu', function(){
			self.removeClass('active');
			container.removeClass('active').animate({
				opacity: 'hide'
			}, 'slow', function(){
				container.css('position', 'static');
			});
		});
		
		
		
		this.click(function(event){
			event.preventDefault();
			
			container.trigger('toggleMegaMenu');
		});

		return this;
	};
})(jQuery);
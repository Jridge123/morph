/**
 * @version		$Id: k2.js 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		MegaMenu, for the Morph Template framework
 * @author      ProThemer http://prothemer.com
 * @copyright	Copyright (c) 2010 ProThemer. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function($){

	$.extend($.easing,
	{
		easeInQuad: function (x, t, b, c, d) {
			return c*(t/=d)*t + b;
		},
		easeOutQuad: function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		}
	});

	$.fn.megamenu = function(container, options){

		var settings = {
			namespace: 'mega',
			persistent: true,
			effects: {
				openMegaMenu: {
					properties: {
						height: ['show', 'easeOutQuad'],
						opacity: 'show'
					},
					duration: 'slow'
				},
				closeMegaMenu: {
					properties: {
						height: ['hide', 'easeInQuad'],
						opacity: 'hide'
					},
					duration: 'slow'
				},
				fadeInMegaMenu: {
					properties: {
						opacity: ['show', 'easeInQuad']
					},
					duration: 'slow'
				},
				fadeOutMegaMenu: {
					properties: {
						opacity: ['hide', 'easeOutQuad']
					},
					duration: 'slow'
				}
			},
			closeButton: {
				text: 'Close',
				title: ''
			}
		};
		$.extend(settings, options);

		if(!container.jquery) var container = $(container);

		
		var self = this, prev = container.prev(), sandbox;
		//Get the previous item, in case it's also a sibling megamenu panel
		if(prev.length && prev.data('megamenu')) {
			sandbox = prev;
		} else {
			sandbox = $('<div />', {id: 'mega-wrap', css: {position: 'relative'}}).data('megamenu', true);
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
					sandbox.animate({height: container.height()}, 'slow', 'swing', function(){
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
			self.parent().find('.active').removeClass('active');
			self.addClass('active');
			container.addClass('active').animate(settings.effects.openMegaMenu.properties, settings.effects.openMegaMenu.duration);
		});
		container.bind('closeMegaMenu', function(){
			self.removeClass('active');
			container.removeClass('active').animate(settings.effects.closeMegaMenu.properties, settings.effects.closeMegaMenu.duration, function(){
				container.css('position', 'static');
			});
		});
		container.bind('fadeInMegaMenu', function(){
			self.addClass('active');
			container.addClass('active').animate(settings.effects.fadeInMegaMenu.properties, settings.effects.fadeInMegaMenu.duration);
		});
		container.bind('fadeOutMegaMenu', function(){
			self.removeClass('active');
			container.removeClass('active').animate(settings.effects.fadeOutMegaMenu.properties, settings.effects.fadeOutMegaMenu.duration, function(){
				container.css('position', 'static');
			});
		});
		
		
		
		this.click(function(event){
			event.preventDefault();
			
			container.trigger('toggleMegaMenu');
		});
		
		//Allowing styling to target mega menu links
		this.addClass('mega-item');
		
		if(settings.closeButton) {
			var closeButton = $('<a />', {href: '#', title: settings.closeButton.title || settings.closeButton.text})
									.text(settings.closeButton.text);
			container.append(closeButton);
			
			closeButton.click(function(event){
				event.preventDefault();
				
				container.trigger('toggleMegaMenu');
			});
		}

		if(settings.persistent && ($.fn.cookie || window.localStorage)){
			var storage, namespace = settings.namespace+'-selected', index = sandbox.children().index(container);
			
			if(window.localStorage) {
				storage = {
					set: function(value){
						localStorage[namespace] = value;
					},
					get: function(){
						return localStorage[namespace];
					}
				};
			} else {
				storage = {
					set: function(value){
						$.cookie(namespace, value);
					},
					get: function(){
						return $.cookie(namespace);
					}
				};
			}
			
			container.bind('toggleMegaMenu', function(){
				var selected = sandbox.children().index(container);
				
				storage.set(container.data('activeMegaMenu') ? selected : '');
			});
			
			if(storage.get() === index.toString()) {
				container.trigger('toggleMegaMenu');
			}
		}

		return this;
	};
})(jQuery);
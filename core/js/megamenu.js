/**
 * @version		$Id: k2.js 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		MegaMenu, for the Morph Template framework
 * @author      ProThemer http://prothemer.com
 * @copyright	Copyright (c) 2010 ProThemer. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function($){
	$.fn.megamenu = function(container, options){

		if(typeof container == 'string') var container = $('#'+container);

		this.click(function(event){
			event.preventDefault();
			
			this.toggleClass('active');
			container.slideToggle('slow');
		});

		return this;
	};
})(jQuery);
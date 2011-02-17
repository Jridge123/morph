/**
 * @version		$Id: k2.js 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		MegaMenu, for the Morph Template framework
 * @author      ProThemer http://prothemer.com
 * @copyright	Copyright (c) 2010 ProThemer. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function($){

	$.fn.megamenu = function(container, options){

		console.log(this, container);
	
		$(this).each(function(){
			//Do stuff here
		});
		
		//$(this).find('a').click(alert);
		$($(this).find('a')[0]).click(function(event){
			event.preventDefault();
			
			$('#products').toggle('slow');
		});
		console.warn();
	
		return this;
	};

})(jQuery);
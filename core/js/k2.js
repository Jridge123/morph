/**
 * @version		$Id: k2.js 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		K2
 * @author      ProThemer http://prothemer.com
 * @copyright	Copyright (c) 2010 ProThemer. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

jQuery.noConflict(); 
(function($) {
	$(document).ready(function(){
		
		// Comments
		$('#comment-form').submit(function(e){
			e.preventDefault;
			$('#formLog').empty().addClass('formLogLoading');
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data){
					console.log(data);
					$('#formLog').html(data).removeClass('formLogLoading');
					if(typeof(Recaptcha) != "undefined"){ 
						Recaptcha.reload();
					}
					if (data.substr(13, 7) == 'success') {
						window.location.reload();
					}
				}
			);
			return false;
		});
  
		// Text Resizer
		$('#fontDecrease').click(function(){
			$('.itemFullText').removeClass('largerFontSize');
			$('.itemFullText').addClass('smallerFontSize');
			return false;
		});
		$('#fontIncrease').click(function(){
			$('.itemFullText').removeClass('smallerFontSize');
			$('.itemFullText').addClass('largerFontSize');
			return false;
		});
  
	  	// Smooth Scroll
		$('#k2Container a[href*=#]').click(function(){
			if(!this.hash) return;
			$.scrollToTop($(this.hash),500);
			return false;
		});
    	
		// Rating
		$('.itemRatingForm a').click(function(e){
			var itemID = $(this).attr('rel'),
				log    = $('#itemRatingLog' + itemID).empty().addClass('formLogLoading'),
				rating = $(this).text(),
				url = "index.php?option=com_k2&view=item&task=vote&user_rating=" + rating + "&itemID=" + itemID;
			$.get(
				'index.php', 
				{
					option: 'com_k2',
					view: 'item',
					task: 'vote',
					user_rating: rating,
					itemID: itemID
				},
				function(data){	
					log.html(data).removeClass('formLogLoading');
					$.get(
						'index.php', 
						{
							option: 'com_k2',
							view: 'item',
							task: 'getVotesPercentage',
							itemID: itemID
						},
						function(percentage){
							$('#itemCurrentRating' + itemID).css('width', percentage + "%");
							setTimeout(function(){
								log.load("?option=com_k2&view=item&task=getVotesNum&itemID=" + itemID);
							}, 2000);
						}
					);
				}
			);
			return false;
		});
	
		$('a.classicPopup').click(function(event){
			var options = eval('(' + $(this).attr('rel') + ')');
			window.open($(this).attr('href'),'K2PopUpWindow','width='+options.x+',height='+options.y+',menubar=yes,resizable=yes');
			return false;
		});

		// Equal block heights for the "default" view
		if($().equalHeights){
			$('.subcategories .article-row').each(function(column){
				$('.article-column', column).equalHeights();
			});
		}
	
	});
})(jQuery);
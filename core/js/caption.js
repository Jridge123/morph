jQuery(function($){
	$('img.caption').load(function(){
		if(!$(this).attr('title')) return this;

		var container = $('<div></div>', {
			'class': 'img_caption '+$(this).attr('align'),
			'css': {
				'float': $(this).attr('align'),
				'width': $(this).width()
			}
		});
		
		$(this).after($('<p class="img_caption">'+$(this).attr('title')+'</p>')).wrap(container);
	});
});
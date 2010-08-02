jQuery(function($){
	$('img.caption').load(function(){
		if(!$(this).attr('title')) return this;

		var container = $('<span></span>', {
			'class': 'caption-wrap img-'+$(this).attr('align'),
			'css': {
				'width': $(this).width(),
				'height': $(this).height()
			}
		});
		$(this).after($('<strong>'+$(this).attr('title')+'</strong>'));
		$(this).wrap(container);
	});
});
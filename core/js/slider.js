(function($){
	function initSlider(elid, linktext) {
	    $(elid).hide();
	    var elid_class = elid.replace('#', '');
	    var openclose = linktext.split(',');
	    var opentext = openclose[0];
	    if (typeof openclose[1] == 'undefined') {
	        var closetext = openclose[0]
	    } else {
	        var closetext = openclose[1]
	    }
	    var showTop = $.cookie('showTop-' + elid_class);
	    if (showTop == 'collapsed' || showTop == null) {
	        var btn = $('<div class="slider-' + elid_class + '"><a href="#">' + opentext + "</a></div>").attr('href', '#');
	        $(elid).after(btn);
	        $(elid).fadeTo('fast', 0);
	        $(elid).hide();
	        $('.slider-' + elid_class).addClass('slider-open')
	    } else {
	        var btn = $('<div class="slider-' + elid_class + '"><a>' + closetext + "</a></div>").attr('href', '#');
	        $(elid).after(btn);
	        $(elid).show();
	        $('.slider-' + elid_class).addClass('slider-close')
	    };
	    $('.slider-' + elid_class).click(function () {
	        if ($(elid).is(':hidden')) {
	            $(elid).slideDown('slow', function () {
	                $(this).fadeTo('fast', 1)
	            });
	            $(this).addClass('slider-close').removeClass('slider-open');
	            $.cookie('showTop-' + elid_class, 'expanded');
	            $('.slider-' + elid_class + ' > a').text(closetext);
	            return false
	        } else {
	            $(elid).fadeTo('fast', 0, function () {
	                $(this).slideUp('slow')
	            });
	            $(this).addClass('slider-open').removeClass('slider-close');
	            $.cookie('showTop-' + elid_class, 'collapsed');
	            $('.slider-' + elid_class + ' > a').text(opentext);
	            return false
	        }
	    })
	}
	this.initSlider = initSlider;
})(jQuery);
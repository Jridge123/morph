(function($) {
	$(document).ready(function(){
		$("#topnav.call-for-action li:last").addClass("action-link");
		$("#topnav.call-for-action li:last").prev("li").addClass("second-last")
		$("body").removeClass("js-disabled").addClass("js-enabled"); 
		$("input, textarea", $("form")).focus(function(){
		$(this).addClass("focus");
		$(this).parents(".form-field").addClass("cur");
		});
		$("input, textarea", $("form")).blur(function(){
		    $(this).removeClass("focus");
		    $(this).parents(".form-field").removeClass("cur");
		});
		$(".article-body p:first").addClass("teaser");
		$(".module-previews .mod:odd").addClass("alt");		
		$("#nav li:first").addClass("first");
		$(".sidenav li:first-child").each(function(){
			$(this).addClass("first");
		});
		$(".sidenav li:last-child").each(function(){
			$(this).addClass("last");
		});
		$("#secondary-content .module:first").addClass("firstmodule");
		$("#secondary-content .module:last").addClass("lastmodule");
		$("#tertiary-content .module:first").addClass("firstmodule");
		$(".article_separator:last").addClass("last");
		$('img[align*=right]').addClass("img-right");
		$('img[align*=left]').addClass("img-left");
		$("table tr:even").addClass("alt");
		$("#user1 .modinner").wrapInner("<div class='extra-border'></div>");
		$(".ui-tabs-panel").wrapInner("<div class='extra-box-border'></div>");
		$(".ui-tabs-nav li").wrapInner("<span class='extra-tab-border'></span>");
		$("input#mod_search_searchword").wrapInner("<div class='extra-search-border'></div>");
		$("#footer-links .fl-left li:last").addClass("fl-last");
		$("#footer-links .fl-right li:last").addClass("fl-last");
    })
})(jQuery);
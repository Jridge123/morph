(function($){var pageTracker;$.trackPage=function(account_id,options){var host=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");var script;var settings=$.extend({},{onload:true,status_code:200},options);var src=host+'google-analytics.com/ga.js';function init_analytics(){if(typeof _gat!=undefined){debug('Google Analytics loaded');pageTracker=_gat._getTracker(account_id);if(settings.status_code==null||settings.status_code==200){pageTracker._trackPageview();}else{debug('Tracking error '+settings.status_code);pageTracker._trackPageview("/"+settings.status_code+".html?page="+document.location.pathname+document.location.search+"&from="+document.referrer);}
if($.isFunction(settings.callback)){settings.callback();}}
else{throw"_gat is undefined";}}
load_script=function(){$.ajax({type:"GET",url:src,success:function(){init_analytics();},dataType:"script",cache:true});}
if(settings.onload==true||settings.onload==null){$(window).load(load_script);}else{load_script();}}
$.trackEvent=function(category,action,label,value){if(typeof pageTracker=='undefined'){debug('FATAL: pageTracker is not defined');}else{pageTracker._trackEvent(category,action,label,value);}};$.fn.track=function(options){return this.each(function(){var element=$(this);if(element.hasClass('tracked')){return false;}else{element.addClass('tracked');}
var settings=$.extend({},$.fn.track.defaults,options);var category=evaluate(element,settings.category);var action=evaluate(element,settings.action);var label=evaluate(element,settings.label);var value=evaluate(element,settings.value);var event_name=evaluate(element,settings.event_name);var message="category:'"+category+"' action:'"+action+"' label:'"+label+"' value:'"+value+"'";debug('Tracking '+event_name+' '+message);element.bind(event_name+'.track',function(){var skip=settings.skip_internal&&(element[0].hostname==location.hostname);if(!skip){$.trackEvent(category,action,label,value);debug('Tracked '+message);}else{debug('Skipped '+message);}
return true;});});function evaluate(element,text_or_function){if(typeof text_or_function=='function'){text_or_function=text_or_function(element);}
return text_or_function;};};function debug(message){if(typeof console!='undefined'&&typeof console.debug!='undefined'&&$.fn.track.defaults.debug){console.debug(message);}};$.fn.track.defaults={category:function(element){return(element[0].hostname==location.hostname)?'internal':'external';},action:'click',label:function(element){return element.attr('href');},value:null,skip_internal:true,event_name:'click',debug:false};})(jQuery);
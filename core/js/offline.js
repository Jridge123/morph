$(document).ready(function() {
    $(document).mouseup(function() {
    	$("#loginform").mouseup(function() {
    		return false
    	});
    	
    	$("a.close").click(function(e){
    		e.preventDefault();
    		$("#loginform").hide();
            $(".lock").fadeIn();
    	});
    	
        if ($("#loginform").is(":hidden"))
        {
            $(".lock").fadeOut();
        } else {
            $(".lock").fadeIn();
        }				
    	$("#loginform").toggle();
    });
    
    // This is example of other button
    $("input#cancel_submit").click(function(e) {
    		$("#loginform").hide();
            $(".lock").fadeIn();
    });
});
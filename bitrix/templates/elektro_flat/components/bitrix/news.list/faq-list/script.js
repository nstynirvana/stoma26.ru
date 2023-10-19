$(document).ready(function() {

	$("body").on("click", ".qa-element-holder a", function(){
    	if($(this).hasClass("active")){
			$(this).parent().children(".qa-element-contents").slideUp(300);
	    	$(this).removeClass("active");
    	}else{
    		$(this).parent().children(".qa-element-contents").slideDown(300);
	    	$(this).addClass("active");
    	}
    	return false;
    });
});
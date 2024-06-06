jQuery(window).load(function(){
	
	if (!Cookies.get("fbs_show")) { // popup not set, show after 60 seconds
		setTimeout(function(){
			Cookies.set('fbs_show', 'true');
			jQuery(".fbs-buttons fbs-primary").fadeIn(500);
			jQuery(".fbs-container").fadeIn(500);
		}, 60000);
		
	} else if (Cookies.get("fbs_show") == 'false') { // popup has been hidden
		var count = Cookies.get('fbs_show_count');
		count++;
		Cookies.set('fbs_show_count', count);
		if (count >= 10) {
			Cookies.set('fbs_show', 'true'); // show next time if it has been hidden 10 times
		}
	} else { // popup has been shown before, show right away
		jQuery(".fbs-container").fadeIn(500);
		jQuery(".fbs-buttons fbs-primary").fadeIn(500);
	}

});

jQuery(document).ready(function() {

	jQuery(document).on("click", ".fbs_close", function(e){
		e.preventDefault();
		jQuery(".fbs-container").fadeOut();
		jQuery(".fbs-buttons fbs-primary").fadeOut();
		Cookies.set('fbs_show', 'false');
		Cookies.set('fbs_show_count', 1);
	});	
	
});

jQuery(document).on("click", ".fbs-buttons.fbs-secondary", function(){
    var id = jQuery(this).data("id");
    jQuery(".fbs-box[data-id='"+ id +"']").fadeIn(500);
    jQuery(".fbs-container").fadeOut();
});

jQuery(document).on("click", ".fbs-clickshow", function(){
    var id = jQuery(this).data("id");
    jQuery(".fbs-box[data-id='"+ id +"']").fadeIn(500);
    jQuery(".fbs-container").fadeOut();
});

jQuery(document).on("click", ".fbs-box-hide", function(){
    var id = jQuery(this).data("id");
    jQuery(".fbs-box[data-id='"+ id +"']").fadeOut();
    jQuery(".fbs-container").fadeIn(500);
});
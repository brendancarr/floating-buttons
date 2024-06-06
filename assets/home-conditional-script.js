
jQuery(window).load(function(){
	jQuery(document).on("click", ".fbs-buttons.fbs-primary", function(){
		jQuery(".fbs-container").toggleClass("fbs-active");
	});
});

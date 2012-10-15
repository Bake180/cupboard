jQuery(document).ready(function(){
	//Hide everything
	jQuery("#manager-form").hide();
	//Form trigger
	jQuery("a#add-new, #close-form").click(function(e){
		var manager_form = jQuery("#manager-form");
		//Toggle form behavior
		if (manager_form.hasClass("show")) jQuery("#manager-form").slideUp("normal").removeClass("show");
		else jQuery("#manager-form").slideDown("normal").addClass("show");
		e.preventDefault();
	});

	jQuery("#cupboard-delete-button").click(function(e) {
		e.preventDefault();
		var item = jQuery(this).attr("href").replace(/#/, '');
	});

	jQuery("#cupboard-edit-button").click(function(e) {
		e.preventDefault();
		var manager_form = jQuery("#manager-form");
		var item = jQuery(this).attr("href").replace(/#/, '');
		//Toggle form behavior
		if (manager_form.hasClass("show")) jQuery("#manager-form").slideUp("normal").removeClass("show");
		else jQuery("#manager-form").slideDown("normal").addClass("show");
	});
});
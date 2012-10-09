jQuery(document).ready(function(){
	//Hide everything
	jQuery("#manager-form, .alert").hide();
	//Form trigger
	jQuery("a#add-new, #close-form").click(function(e){
		var manager_form = jQuery("#manager-form");
		//Toggle form behavior
		if (manager_form.hasClass("show")) jQuery("#manager-form").slideUp("normal").removeClass("show");
		else jQuery("#manager-form").slideDown("normal").addClass("show");
		e.preventDefault();
	});
	//Process submit
	jQuery(".submit-cupboard").click(function(e){
		e.preventDefault();
		var manager_form = jQuery("#manager-form");
		manager_form.slideUp("normal").removeClass("hide");
		jQuery(".alert-success").slideDown("normal");
	});
});
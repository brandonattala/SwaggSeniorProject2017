window.formChanged = false;
window.isFormSubmit = false;

window.onbeforeunload = function(e) {
	if(window.formChanged && !window.isFormSubmit) {
		return "Any un-saved data will be lost.  Continue?";
	}
};

$(function() {
	$("input,select,textarea", "form").change(function() {
		window.formChanged = true;
		window.isFormSubmit = false;
	});

	$("a").not(".submit").click(function() {
		window.isFormSubmit = false;
	});

	$("form").submit(function() {
		window.isFormSubmit = true;
	});

});

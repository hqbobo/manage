(function($) {
	$('.default').each(function() {
		//alert($(this).attr('default_text'));
		$(this).val($(this).attr('default_text'));		
	});
	$('.default').focus(function() {
		if ($(this).val() == $(this).attr('default_text')) {
			$(this).val("");
		}
	});
	$('.default').blur(function() {
		if ($(this).val() == "") {
			$(this).val($(this).attr('default_text'));

		}
	});
	
	$('.default_pass').each(function() {
		//alert($(this).attr('default_text'));
		$(this).attr('type',"text");
		$(this).val($(this).attr('default_text'));		
	});
	$('.default_pass').focus(function() {
		if ($(this).val() == $(this).attr('default_text')) {
			$(this).attr('type',"password");
			$(this).val("");
		}
	});
	$('.default_pass').blur(function() {
		if ($(this).val() == "") {
			$(this).val($(this).attr('default_text'));
			$(this).attr('type',"text");

		}
	});
})(jQuery);
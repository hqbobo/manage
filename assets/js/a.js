/**
 * 
 */
(function($) {
	$.public = {
			mask:function(flag){
				if(flag){
					$('#mask').show();
				}else{
					$('#mask').hide();
				}
			},
		};
})(jQuery);
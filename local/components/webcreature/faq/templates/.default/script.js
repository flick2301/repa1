$(document).ready(function() {
	$(document).on('click', '.faq__name', function() {
		var answer = $(this).parent().children('.faq__desc');
		if (answer.is(':visible')) var open = false;
		else var open = true;
		$('.faq__desc').slideUp(300);
		if (open) answer.slideDown(300);		
	});
});
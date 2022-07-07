$(document).ready(function() {
	$('.faq__name').click(function() {
		var answer = $(this).parent().children('.faq__desc');
		if (answer.is(":visible")) var open = false;
		else var open = true;
		$('.faq__desc').hide(300);
		if (open) answer.show(300);		
	});
});